<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\Helper as HelperAlias;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attorney\ClientUpdateRequest;
use App\Http\Controllers\StripeController;
use App\Models\AttorneySubscription;
use App\Models\ClientParalegal;
use App\Models\User;
use App\Models\SubscriptionToclient;
use App\Services\AttorneyClientService;
use App\Helpers\Helper;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\ClientSettings;
use App\Services\Client\CacheBasicInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public AttorneyClientService $service;

    public function __construct(AttorneyClientService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            Log::info('ClientController@store: Starting client creation process', [
                'attorney_id' => Helper::getCurrentAttorneyId(),
                'email' => $request->input('email')
            ]);

            $request->validate([
                'client_subscription' => 'required',
                'client_type' => 'required',
                'client_payroll_assistant' => 'required',
                'first_name' => 'required|alpha_dash_space',
                'last_name' => 'required|alpha_dash_space',
                'email' => 'required|email|unique:App\Models\User,email',
                'hide_questionnaire' => 'nullable',
                'onepage_questionnaire_request_id' => 'nullable',
                'phone_no' => 'required',
                'client_bank_statements' => 'required',
                'client_profit_loss_assistant' => 'required',
                'client_credit_report' => 'required'
            ]);

            Log::info('ClientController@store: Validation passed');

            $input = $request->all();
            $type = !empty(Auth::user()->parent_attorney_id) ? 'assigned_to_me' : 'active';
            if (Helper::validate_key_value('client_send_invite', $input) === '2') {
                $spouseEmail = Helper::validate_key_value('spouse_email', $input);
                if (!empty(User::where('email', '=', $spouseEmail)->first())) {
                    Log::warning('ClientController@store: Spouse email already exists', [
                        'spouse_email' => $spouseEmail
                    ]);

                    return redirect()->route('attorney_client_management', $type)->with('error', 'Primary e-mail already used by existing user, please use another email.');
                }
            }

            Log::info('ClientController@store: Starting database transaction');
            DB::beginTransaction();
            try {
                $client_type = $input['client_type'];
                $docli1 = isset($input['doc_list_1']) && is_array($input['doc_list_1']) ? $input['doc_list_1'] : [];
                $docli2 = isset($input['doc_list_2']) && is_array($input['doc_list_2']) ? $input['doc_list_2'] : [];
                $docli3 = isset($input['doc_list_3']) && is_array($input['doc_list_3']) ? $input['doc_list_3'] : [];
                $docsToExcludeJson = "";
                if (Auth::user()->invite_document_selection) {
                    switch ($client_type) {
                        case '1':
                            $docsToExcludeJson = $this->getDocsToExcludeList($client_type, $docli1);
                            break;
                        case '2':
                            $docsToExcludeJson = $this->getDocsToExcludeList($client_type, $docli2);
                            break;
                        case '3':
                            $docsToExcludeJson = $this->getDocsToExcludeList($client_type, $docli3);
                            break;
                    }
                }

                $input['docsToExcludeJson'] = $docsToExcludeJson;
                $attorney_id = Helper::getCurrentAttorneyId();
                $attorney = User::find($attorney_id);
                $input['detailed_property'] = is_null($request->detailed_property) ? "0" : $request->detailed_property;
                $input['concierge_service'] = is_null($request->concierge_service) ? "0" : $request->concierge_service;
                $input['allen_report_included'] = is_null($request->allen_report_included) ? 0 : (int) $request->allen_report_included;
                $input['additional_joint_package'] = AttorneySubscription::selectJointPackage($input['client_subscription'], $client_type);
                $clientSubscription = (int)$input['client_subscription'];
                if (in_array($clientSubscription, [AttorneySubscription::BLACK_LABEL_SUBSCRIPTION, AttorneySubscription::ULTIMATE_SUBSCRIPTION, AttorneySubscription::ULTIMATE_PLUS_SUBSCRIPTION, AttorneySubscription::PREMIUM_SUBSCRIPTION, AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION])) {
                    $input['concierge_service'] = 1;
                }
                if ($clientSubscription !== AttorneySubscription::FREE_PACKAGE) {
                    $returnerror = $this->validatePurchasePackageRequest($input, $attorney);
                    if (!empty($returnerror)) {
                        Log::error('ClientController@store: Package validation failed', [
                            'error' => $returnerror,
                            'attorney_id' => $attorney_id,
                            'client_subscription' => $input['client_subscription']
                        ]);
                        DB::rollBack();

                        return redirect()->route('attorney_client_management', $type)->with('error', $returnerror);
                    }
                }

                $input['free_package_unpaid'] = 0;

                $client_bank_statements = $input['client_bank_statements'];
                $is_bankassistantPremium = 0;
                if (str_contains($client_bank_statements, '_')) {
                    $is_bankassistantPremium = 1;
                    $client_bank_statements = explode('_', $client_bank_statements);
                    if (isset($client_bank_statements[0]) && $client_bank_statements[0] == 'premium') {
                        $client_bank_statements = $client_bank_statements[1];
                    }
                }
                if ($is_bankassistantPremium) {
                    $input['client_bank_statements_premium'] = $client_bank_statements;
                }

                Log::info('ClientController@store: Creating client', [
                    'email' => $input['email'],
                    'client_type' => $client_type,
                    'client_subscription' => $input['client_subscription']
                ]);

                $this->service->createClient($input);

                Log::info('ClientController@store: Client created successfully', [
                    'email' => $input['email']
                ]);

                if (isset($input['onepage_questionnaire_request_id']) && $input['onepage_questionnaire_request_id'] > 0) {
                    Log::info('ClientController@store: Importing questionnaire data', [
                        'onepage_questionnaire_request_id' => $input['onepage_questionnaire_request_id']
                    ]);

                    \App\Models\OnePageQuestionnaireRequest::importClientData($input['onepage_questionnaire_request_id']);

                    Log::info('ClientController@store: Questionnaire data imported successfully');
                    Log::info('ClientController@store: Committing transaction (with questionnaire)');

                    DB::commit();

                    return redirect()->route('questionnaire_index', ['active' => 1])->with('success', 'User has been added successfully.');
                }

                Log::info('ClientController@store: Committing transaction');
                DB::commit();

                Log::info('ClientController@store: Client creation completed successfully', [
                    'email' => $input['email']
                ]);

                return redirect()->route('attorney_client_management', $type)->with('success', 'User has been added successfully.');

            } catch (QueryException $th) {
                Log::error('ClientController@store: QueryException occurred', [
                    'error' => $th->getMessage(),
                    'code' => $th->getCode(),
                    'email' => $input['email'] ?? 'N/A',
                    'trace' => $th->getTraceAsString()
                ]);
                DB::rollBack();
                Log::info('ClientController@store: Transaction rolled back due to QueryException');

                return back()->withError($th->getMessage())->withInput();
            } catch (Exception $th) {
                Log::error('ClientController@store: Exception occurred', [
                    'error' => $th->getMessage(),
                    'code' => $th->getCode(),
                    'email' => $input['email'] ?? 'N/A',
                    'trace' => $th->getTraceAsString()
                ]);
                DB::rollBack();
                Log::info('ClientController@store: Transaction rolled back due to Exception');

                return back()->withError($th->getMessage())->withInput();
            }
        }
    }

    public function getDiscountPrice($discountPercentage, $packagePriceTotal)
    {
        return number_format($packagePriceTotal * ($discountPercentage / 100), 3);
    }

    public function getPackageName($package_id)
    {
        return AttorneySubscription::allPackageNameWithParamForTransactionArray($package_id);
    }

    private function getDocsToExcludeList($type, $doc_list = [])
    {
        $list = Helper::getDocuments($type, false, 1, 1, 0, 0, Helper::getCurrentAttorneyId());
        $list = $list + Helper::getMiscDocs();

        $list = self::unsetDocTypeFromList($list);

        $difference = array_diff_key($list, $doc_list);

        $difference = array_keys($difference);
        $listOfDifference = '';
        if (!empty($difference)) {
            $listOfDifference = json_encode($difference);
        }

        return $listOfDifference;
    }

    private function unsetDocTypeFromList($list)
    {
        $keyToUnset = [
            'Debtor_Creditor_Report',
            'Co_Debtor_Creditor_Report',
            'Current_Auto_Loan_Statement',
            'Current_Auto_Loan_Statement_1',
            'Current_Auto_Loan_Statement_2',
            'Current_Auto_Loan_Statement_3',
            'Current_Auto_Loan_Statement_4',
            'Other_Loan_Statement_1',
            'Other_Loan_Statement_2',
            'Current_Mortgage_Statement',
            'Current_Mortgage_Statement_1_1',
            'Current_Mortgage_Statement_2_1',
            'Current_Mortgage_Statement_3_1',
            'Current_Mortgage_Statement_1_2',
            'Current_Mortgage_Statement_2_2',
            'Current_Mortgage_Statement_3_2',
            'Current_Mortgage_Statement_1_3',
            'Current_Mortgage_Statement_2_3',
            'Current_Mortgage_Statement_3_3',
            'Current_Mortgage_Statement_1_4',
            'Current_Mortgage_Statement_2_4',
            'Current_Mortgage_Statement_3_4',
            'Current_Mortgage_Statement_1_5',
            'Current_Mortgage_Statement_2_5',
            'Current_Mortgage_Statement_3_5'
        ];

        foreach ($keyToUnset as $key) {
            if (array_key_exists($key, $list)) {
                unset($list[$key]);
            }
        }

        return $list;
    }

    public function checkPackagesAvailablity(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $attorney = User::find($attorney_id);
        if ($attorney->demo_attorney == 0) {
            $clientType = $request->input('client_type');
            $subscription_package = $request->input('package_id');
            $client_payroll_assistant = $request->input('client_payroll_assistant');
            $client_credit_report = $request->input('client_credit_report');

            $NotAvailablePackages = AttorneySubscription::checkFinishedPackageArray($attorney, $subscription_package, $clientType, $client_payroll_assistant, $request->input('client_bank_statements'), $request->input('client_profit_loss_assistant'), $client_credit_report);
            $availabePackages = AttorneySubscription::getAttorneySubscriptions($attorney);
            if (!empty($NotAvailablePackages)) {
                return view('attorney.un_available_packages', ['availabePackages' => $availabePackages, 'notAvailablePackages' => $NotAvailablePackages]);
            }
        }
    }

    private function validatePurchasePackageRequest($input, $attorney)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $NotAvailablePackages = AttorneySubscription::checkFinishedPackageArray($attorney, $input['client_subscription'], $input['client_type'], $input['client_payroll_assistant'], $input['client_bank_statements'], $input['client_profit_loss_assistant'], $input['client_credit_report']);
        if (isset($input['concierge_service']) && $input['concierge_service'] == 1) {
            if ($input['client_subscription'] == AttorneySubscription::BASIC_SUBSCRIPTION) {
                $pId = AttorneySubscription::STANDARD_CONCIERGE_SERVICE_PACKAGE;
                array_push($NotAvailablePackages, ['id' => $pId, 'name' => AttorneySubscription::allPackageNameArray($pId), 'unit' => 1]);
            }
        }
        if (isset($input['concierge_service']) && $input['concierge_service'] == 1) {
            if ($input['client_subscription'] == AttorneySubscription::BASIC_PLUS_SUBSCRIPTION) {
                $pId = AttorneySubscription::STANDARD_PLUS_CONCIERGE_SERVICE_PACKAGE;
                array_push($NotAvailablePackages, ['id' => $pId, 'name' => AttorneySubscription::allPackageNameArray($pId), 'unit' => 1]);
            }
        }


        $packagePriceTotal = 0;
        $packageDesc = '';
        $nameArray = [];
        $inde = 1;

        foreach ($NotAvailablePackages as $packageId) {
            $thisPackageName = AttorneySubscription::allPackageNameArray($packageId['id']) . " (" . $packageId['unit'] . " questionnaire)";
            $thisPackagePrice = AttorneySubscription::allPackagePriceArray($packageId['id']);
            $key = (string) $inde . '. $' . ((float) $thisPackagePrice * (int) $packageId['unit']);
            $nameArray[$key] = (string) $thisPackageName;
            $packageDesc = $packageDesc . $thisPackageName;
            $packagePriceTotal += ((float) $thisPackagePrice * (float) $packageId['unit']);
            $inde++;
        }

        $product_id = '';
        if ($attorney->demo_attorney == 0 && $packagePriceTotal > 0) {
            $discountPercentage = $attorney->subscription_discount_percent ?? 0;
            if ($discountPercentage > 0) {
                $discountAmount = (float) $packagePriceTotal * ((float) $discountPercentage / 100);
                $key = (string) $inde . '. -$' . intval(round($discountAmount));
                $nameArray[$key] = "Applied " . $discountPercentage . '% discount on this purchase';
                $packageDesc = $packageDesc . '-$' . intval(round($discountAmount)) . " Applied " . $discountPercentage . '% discount on this purchase';
            }
            $stripe = new StripeController();

            $result = $stripe->attorney_subscription_in_bulk($attorney, $packagePriceTotal, $packageDesc, $nameArray);
            if (isset($result['status']) && $result['status'] == 0) {
                return $result['msg'];
            }
            if (isset($result['status']) && $result['status'] == 1) {
                $product_id = $result['id'] ?? '';
            }
            if (empty($product_id)) {
                return "Error while making payment, please update your card.";
            }
        }

        foreach ($NotAvailablePackages as $packageId) {
            $price = AttorneySubscription::allPackagePriceArray($packageId['id']);
            AttorneySubscription::addSubscriptionRecord($attorney_id, $packageId['id'], $price, $packageId['unit'], $product_id);
        }

    }


    public function add_package_to_client(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $package_id = $request->input('package_id');
        $package_type = $request->input('package_type') ?? '';
        $quantity = 1;
        if ($package_type == 3) {
            $quantity = 2;
        }

        $isExists = SubscriptionToclient::where(['client_id' => $client_id, 'package_id' => $package_id, 'attorney_id' => $attorney_id])->exists();
        if ($isExists) {
            return redirect()->back()->with('error', 'Package is already assigned to this client.');
        }
        $perPackagePrice = 0.00;
        $discountPercentage = 0.00;
        $attorney = User::find($attorney_id);
        $discountPercentage = $attorney->subscription_discount_percent ?? 0;
        $perPackagePrice = AttorneySubscription::allPackagePriceArray($package_id);
        $discountedAmount = $this->getDiscountPrice($discountPercentage, $perPackagePrice);
        $packageName = $this->getPackageName($package_id);
        if (!$isExists) {
            $insertData = [
                'client_id' => $client_id,
                'package_id' => $package_id,
                'attorney_id' => $attorney_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'quantity' => $quantity,
                'per_package_price' => $perPackagePrice,
                'discount_percentage' => $discountPercentage,
                'discounted_price' => $discountedAmount,
                'package_name' => $packageName
            ];
            SubscriptionToclient::create($insertData);
            AttorneySubscription::addPackageToUserTable($client_id, $package_id, $package_type);
        }

        return redirect()->back()->with('success', 'Record updated successfully');
    }

    public function update(ClientUpdateRequest $request)
    {
        if ($this->service->updateClient($request->validated() + ['retainer_agreement_box'], auth()->id())) {
            return redirect()->route('attorney_client_management', 'active')->with(
                'success',
                'User has been updated successfully.'
            );
        }

        return redirect()->route('attorney_client_management', 'active')->with(
            'error',
            'Record has not been saved, Please check.'
        );
    }

    public function show($id)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $attorney = User::find($attorney_id);
        if ($attorney->id != 1 && $attorney->subscriptions[0]->type == AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_paystub', ['id' => $id, 'type' => 'paystub']);
        }

        return view(
            'attorney.client.view',
            $this->service->getClientForShow($id)
        );
    }

    public function delete(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        DB::beginTransaction();
        try {
            User::where('id', $client_id)
                ->update([
                    'date_marked_delete' => now()->toDateString(),
                    'user_status' => Helper::REMOVED,
                ]);
            DB::commit();

            return response()->json(Helper::renderJsonSuccess("Client Marked Deleted Successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        // if ($this->service->deleteClient($client_id)) {
        //     return response()->json(Helper::renderJsonSuccess('Client Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        // }
    }

    public function changeStatus(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = Helper::getCurrentAttorneyId();
        $status = $request->input('status');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if (!AttorneyClientService::clientExist($client_id)) {
            return response()->json(Helper::renderJsonError('Invalid Request1'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        if (!in_array($status, [HelperAlias::ACTIVE, HelperAlias::INACTIVE])) {
            return response()->json(Helper::renderJsonError('Invalid Request2'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $newStatus = HelperAlias::ACTIVE;

        if ($status == HelperAlias::ACTIVE) {
            $newStatus = HelperAlias::INACTIVE;
        }

        $data = ['user_status' => $newStatus];

        User::where("id", $client_id)->update($data);

        return response()->json(Helper::renderJsonSuccess("Status updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function changeCaseFiledPreviewPopup(Request $request)
    {
        $returnHTML = ClientSettings::getCaseFiledPopupReturnHTML($request, 'attorney_client_case_filed', true, 'attorney_client_case_filed_not_available');

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function changeCaseFiledPopup(Request $request)
    {
        $returnHTML = ClientSettings::getCaseFiledPopupReturnHTML($request, 'attorney_client_case_filed', false, 'attorney_client_case_filed_not_available');

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function changeCaseFiled(Request $request)
    {
        $client_id = $request->input('client_id', '');
        $attorney_id = Helper::getCurrentAttorneyId();
        $caseNo = $request->input('caseNo', '');
        $caseInfo = $request->input('caseInfo', '');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->back()->with('error', 'Invalid Request');
        }

        DB::beginTransaction();
        try {
            ClientSettings::updateCaseFiledStatus($request);
            if (!empty($caseInfo) && !empty($caseNo)) {
                ClientSettings::sendStatusMailAndText($request);
            }
            DB::commit();

            return redirect()->back()->with('success', 'Case Filed status updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Invalid Request ' . $e->getMessage());
        }
    }

    public function changeCaseFiledNotAvailable(Request $request)
    {
        $client_id = $request->input('client_id', '');
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->back()->with('error', 'Invalid Request');
        }
        DB::beginTransaction();
        try {
            ClientSettings::updateCaseFiledNotAvailableStatus($request);
            DB::commit();

            return redirect()->back()->with('success', 'Case Filed Not Available status updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Invalid Request ' . $e->getMessage());
        }
    }

    public function reSendInvite(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($request->input('client_id'), $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if (!$this->service->resendEmailToClient($request->input('client_id'))) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(Helper::renderJsonSuccess("Invite re-sent successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function update_name(Request $request)
    {
        $input = $request->all();

        $client_id = $input['client_id'];
        $attorney_id = Helper::getCurrentAttorneyId();

        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $new_name = $input['new_name'];

        User::where('id', $client_id)->update(['name' => $new_name]);

        $name_parts = explode(' ', trim($new_name));
        $name_count = count($name_parts);

        $first_name = '';
        $middle_name = '';
        $last_name = '';

        if ($name_count === 1) {
            $first_name = $name_parts[0];
        } elseif ($name_count === 2) {
            $first_name = $name_parts[0];
            $last_name = $name_parts[1];
        } elseif ($name_count >= 3) {
            $first_name = $name_parts[0];
            $middle_name = $name_parts[1];
            $last_name = implode(' ', array_slice($name_parts, 2));
        }

        \App\Models\ClientBasicInfoPartA::where('client_id', $client_id)->update([
            'name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name
        ]);

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

        return response()->json(Helper::renderJsonSuccess("Record updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }


    public function update_email(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $attorney_id = Helper::getCurrentAttorneyId();

        $emailOK = Validator::make($request->all(), [
            'new_email' => 'required|email',
        ]);

        if ($emailOK->fails()) {
            return response()->json(Helper::renderJsonError($emailOK->errors()->first('new_email')))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $userEmailExists = User::where('email', $input['new_email'])->exists();
        if ($userEmailExists == true) {
            return response()->json(Helper::renderJsonError("Email already exists."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        User::where('id', $client_id)->update(['email' => $input['new_email']]);
        \App\Models\ClientAnyOtherNameData::where('client_id', $client_id)->update(['email' => $input['new_email']]);

        if (!$this->service->resendEmailToClient($request->input('client_id'))) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

        return response()->json(Helper::renderJsonSuccess("Invite re-sent successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function update_phone(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $userPhoneExists = User::where('phone_no', str_replace(['-', '(', ')', ' '], '', $input['new_phone']))->exists();
        if ($userPhoneExists == true) {
            return response()->json(Helper::renderJsonError("Phone number already exists."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        User::where('id', $client_id)->update(['phone_no' => $input['new_phone']]);
        \App\Models\ClientAnyOtherNameData::where('client_id', $client_id)->update(['home' => $input['new_phone']]);

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

        return response()->json(Helper::renderJsonSuccess("Record updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }




    public function update_client_type(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $client_type_id = $input['client_type_id'];
        $package_id = $input['package_id'];
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_type_id != 3) {
            User::where('id', $client_id)->update(['client_type' => $client_type_id]);
        }
        // 100 is for standard subscription
        if ($client_type_id == 3 && $package_id == 100) {
            User::where('id', $client_id)->update(['client_type' => $client_type_id]);
        }
        if ($client_type_id == 3 && $package_id != 100) {
            $packageName = "Married BOTH Spouses Filing";
            $needPackage = '';
            if (in_array($package_id, [AttorneySubscription::PREMIUM_SUBSCRIPTION, AttorneySubscription::BLACK_LABEL_SUBSCRIPTION])) {
                $needPackage = AttorneySubscription::JOINT_DEBTOR_ADDITIONAL;
            }
            if (in_array($package_id, [AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION])) {
                $needPackage = AttorneySubscription::JOINT_DEBTOR_PREMIUM_PLUS_ADDITIONAL;
            }
            if ($package_id == AttorneySubscription::ULTIMATE_SUBSCRIPTION) {
                $needPackage = AttorneySubscription::JOINT_DEBTOR_ULTIMATE_ADDITIONAL;
            }
            if ($package_id == AttorneySubscription::ULTIMATE_PLUS_SUBSCRIPTION) {
                $needPackage = AttorneySubscription::JOINT_DEBTOR_ULTIMATE_PLUS_ADDITIONAL;
            }
            if ($package_id == AttorneySubscription::BASIC_PLUS_SUBSCRIPTION) {
                $needPackage = AttorneySubscription::JOINT_DEBTOR_BASIC_PLUS_ADDITIONAL;
            }
            $availableCount = AttorneySubscription::getAvailablePackage(Auth::user(), $needPackage);

            return view('attorney.official_form.buy_subscription_popup', ['packageName' => $packageName, 'client_id' => $client_id, 'availableCount' => $availableCount, 'needPackage' => $needPackage]);
        }

        return response()->json(Helper::renderJsonSuccess("Record successfully updated."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function update_client_associate(Request $request)
    {
        $input = $request->all();
        $client_id = Helper::validate_key_value('client_id', $input, 'radio');
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');
        if (!empty($associate_id)) {
            ClientsAssociate::where('client_id', $client_id)->delete();
            ClientsAssociate::create([
                'client_id' => $client_id,
                'associate_id' => $associate_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return response()->json(Helper::renderJsonSuccess("Record successfully updated."))->header('Content-Type: application/json;', 'charset=utf-8');

    }

    public function update_client_paralegal(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'] ?? "";
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $paralegalId = $request->get('paralegal_id');

        $data = [
            'client_id' => $request->get('client_id')
        ];
        $UpdateData = [
            'client_id' => $request->get('client_id'),
            'paralegal_id' => $paralegalId,
        ];
        ClientParalegal::updateOrCreate($data, $UpdateData);

        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company : [];

        $user = User::where('id', $client_id)->first();
        $email = $user->email ?? '';
        $paralegal = User::where('id', $paralegalId)->first();
        $paralegal = User::where(['users.role' => User::ATTORNEY, 'users.id' => $paralegalId])
            ->leftJoin(
                'tbl_paralegal_settings',
                'users.id',
                '=',
                'tbl_paralegal_settings.paralegal_id'
            )
            ->orderBy('users.id', 'DESC')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.phone_no',
                'tbl_paralegal_settings.appointment_link',
            )->first();


        try {

            $pName = $paralegal->name ?? '';

            $splitName = Helper::splitName($pName);
            $pFirstName = !empty($splitName[0]) ? $splitName[0] : "";

            $data = [
                'logo' => url($attorney_company->company_logo),
                'client_name' => $user->name,
                'paralegal_name' => $pName,
                'paralegal_first_name' => $pFirstName,
                'paralegal_email' => $paralegal->email ?? '',
                'paralegal_phone' => $paralegal->phone_no ?? '',
                'paralegal_link' => $paralegal->appointment_link ?? '',
            ];
            if (AttorneySettings::isEmailEnabled($attorney_id, 'client_paralegal_assigned_mail', $client_id)) {
                Mail::to($email)->send(new \App\Mail\ParalegalAssignedNotification($data));
            }
        } catch (\Exception $e) {


        }

        return response()->json(Helper::renderJsonSuccess("Record successfully updated."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function helpPopup(Request $request)
    {
        $input = $request->all();
        $popupFor = $input['popup_for'] ?? '';
        $title = "";
        $subTitle = "";
        $body = "";
        switch ($popupFor) {
            case 'client_subscription':
                $title = "Questionnaire Features:";
                $body = "<div class='row'>
                            <div class='col-12'>
                                <p class='text-bold mb-0 fs-16px underline'>Standard Questionnaire Features:</p>
                                <p class=''>(Core Features)</p>
                            </div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Dynamic, Interactive Questionnaire</p>
								<p>Accessible via Web and Mobile App for a seamless user experience.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Integration with Petition Software</p>
								<p>Seamless data imports into Best Case and Jubilee Pro systems.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Mobile App Access</p>
								<p>Full functionality on both Apple and Google Play platforms.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>All Client App Features Included</p>
								<p>Full suite of tools designed to simplify client onboarding and communication.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Automated Document Collection</p>
								<p>Smart prompts guide clients to upload required documents efficiently.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Text Messaging</p>
								<p>Text messaging between you and your clients.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Revolutionary Follow-Up System</p>
								<p>Built-in automation to remind, follow up, and track client progress.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Common Creditor List</p>
								<p>Common Creditor List with Auto Address Complete just like your preparation system.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Bilingual Questionnaires</p>
								<p>Are available in both English and Spanish.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Attorney/Client Document Portal</p>
								<p>Send and receive doc(s) from clients such as petitions and other various documents.</p>
							</div>

                            <div class='col-12'>
                                <p class='text-bold mb-0 fs-16px underline'>ALL Plus Questionnaire Features:</p>
                                <p class='mb-0'>(Enhanced Features)</p>
                                <p class=''>Includes everything in the <span class='text-bold'>Standard Questionnaires</span>, plus</p>
                            </div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 '>Integrated Credit Report Retrieval</p>
								<p>Secure access to all three major credit bureaus (Through free annual credit report.com).</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 '>Auto-Populated Debts</p>
								<p>Debts are automatically imported from credit reports into the questionnaire, saving time and improving accuracy.</p>
							</div>

                            <div class='col-12'>
                                <p class='text-bold mb-0 fs-16px underline'>Premium Questionnaire Features:</p>
                                <p class=''>Includes everything in the <span class='text-bold'>Standard Questionnaires</span>, plus</p>
                            </div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Concierge Service</p>
								<p>We review the questionnaire with your clients and request any documents you require, except bank statements.</p>
							</div>
							<div class='col-12 col-md-6'>
								<p class='text-bold mb-0 underline'>Storage of Client Data & Docs</p>
								<p>Are saved for a total of 3 Years (2 years with Standard).</p>
							</div>
                        </div>";
                break;
            case 'detailed_property':
                $title = "Detailed Property Tab:";
                $body = "<span >Details personal property by item</span>";
                break;
            case 'client_type':
                $title = "Client Type:";
                $body = "<span ><strong>Single Not Married</strong>: Single Debtor Filing Individually</span> </br>
                         <span ><strong>Married Not Filing with Spouse</strong>: Married Client Filing individually</span> </br>
                         <span ><strong>Joint Married</strong>: Married Filing a Joint Case</span>";
                break;
            case 'concierge_service':
                $title = "Concierge Service:";
                $subTitle = "(Additional $50.00 Per Case)";
                $body = '<span >Your client can setup an appointment on our calendly links.</span>
                        <div class="d-flex">
                            <span >1. </span>
                            <span class=" w-100">We will review the questionnaire with them to make sure they have filled out what is needed to prepare thier case.</span>
                        </div>
                        <div class="d-flex">
                            <span >2. </span>
                            <span class=" w-100">We will help them and guide them to upload documents and as to where to get them.</span>
                        </div>
                        <p class="mb-0 text-danger mt-3">Note: This service does not include completing the Profit/Loss section in the system or uploading bank statements unless you have opted for the Profit/Loss Assistant and/or Bank Statement Assistant, <u>both of which are additional add-ons</u></p>';
                break;
            case 'payroll_assistant':
                $title = "Payroll Assistant:";
                $body = '<span >Payroll Assistant gets:</span>
                        <ul class="mb-0">
                            <li >All CMI pay stubs</li>
                            <li >Calculates All CMI Pay stubs into the system for Means Test & Schedule I</li>
                            <li >The System keeps track of all missing/required pay stubs</li>
                        </ul>';
                break;
            case 'bank_statement':
                $title = "Bank Statement Assistant:";
                $body = '<p class="  ">BKQ with concierge service will get either 3 months or 6 months of bank statements for all bank accounts, listed in the questionnaire by your client(s)</p>
                        <p class="  text-bold mt-2">Bank Statement Assistant Standard:</p>
                        <p class="  ">We get 3 months of bank statements for all bank accounts listed in the questionnaire</p>
                        <p class="  text-bold mt-2">Bank Statement Assistant Premium:</p>
                        <p class="  ">We get 6 months of bank statements for all bank accounts listed in the questionnaire</p>';
                break;
            case 'profit_loss':
                $title = "Profit Loss Assistant:";
                $body = "";
                break;
            case 'phone_no':
                $title = "Mobile #:";
                $body = "<span >Mobile no of the Debtor 1 (to send invite text)</span>";
                break;
            case 'second_client_phone_no':
                $title = "Mobile #:";
                $body = "<span >Mobile no of the Debtor 2 (to send invite text)</span>";
                break;
        }

        return view('attorney.help_popup_data', ['title' => $title, 'subTitle' => $subTitle, 'body' => $body]);
    }

    public function enable_detail_property(Request $request)
    {
        $client_id = $request->input('client_id');
        $detailed_property = $request->input('detailed_property');

        $data = ['detailed_property' => $detailed_property];

        User::where("id", $client_id)->update($data);

        return response()->json(Helper::renderJsonSuccess("Record updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }
}
