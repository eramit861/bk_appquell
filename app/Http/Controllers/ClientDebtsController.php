<?php

namespace App\Http\Controllers;

use App\Models\AttorneySettings;
use App\Models\AttorneySubscription;
use App\Models\ClientsAttorney;
use App\Models\DebtsTax;
use App\Models\Expenses;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Helpers\ClientHelper;
use App\Helpers\AddressHelper;
use Illuminate\Http\Request;
use App\Models\FormsStepsCompleted;
use App\Models\Creditors;
use App\Models\CrsCreditReport;
use App\Models\User;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheExpense;
use App\Services\Client\DebtDataService;
use App\Jobs\MoveDebtsToSofa;

class ClientDebtsController extends Controller
{
    protected DebtDataService $debtDataService;

    /**
     * Constructor - inject DebtDataService dependency
     *
     * @param DebtDataService $debtDataService
     */
    public function __construct(DebtDataService $debtDataService)
    {
        $this->debtDataService = $debtDataService;
    }

    /**
     * Get attorney subscription type
     *
     * @param int $attorneyId
     * @return string
     */
    protected function getAttorneySubscriptionType(int $attorneyId): string
    {
        $package = AttorneySubscription::where('attorney_id', $attorneyId)->first();

        return $package->type ?? '';
    }

    /**
     * Check if user has permission to edit section
     * AJAX endpoint to validate edit permissions
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function check_permission(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $section = $input['section'];
            if (!Helper::isTabEditable($section)) {
                return response()->json([
                    'status' => false,
                    'msg' => 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.'
                ], 200);
            }

            // Permission granted
            return response()->json(['status' => true], 200);
        }

        // Invalid request method
        return response()->json(['status' => false, 'msg' => 'Invalid request method'], 400);
    }

    /**
     * Display debts step 2 - Unsecured debts
     * Shows form for entering credit cards, loans, and other unsecured debts
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_debts_step2_unsecured(Request $request)
    {
        $client = Auth::user();

        // Early redirect checks
        if ($this->debtDataService->shouldRedirectToIncome($client)) {
            return redirect()->route('client_income')->with('success', 'Logged in successfully');
        }

        if ($this->debtDataService->shouldRedirectToNoQuestionnaire($client)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'Logged in successfully');
        }

        $attorneyId = ClientsAttorney::where('client_id', $client->id)->value('attorney_id');

        // Prepare view data using service
        $data = $this->debtDataService->getClientDebtsData();
        $creditReportVideos = $this->debtDataService->getCreditReportVideos();
        $debtorNames = $this->debtDataService->getDebtorNames($client->id);

        $data = array_merge($data, [
            'debtorname' => $debtorNames['debtorname'],
            'spousename' => $debtorNames['spousename'],
            'debt_step' => 'unsecured',
            'bank_statement_months' => $this->debtDataService->getBankStatementMonths($attorneyId),
            'attorneySettings' => $this->getAttorneySettings($attorneyId),
            'creditReportVideos' => $creditReportVideos,
        ]);

        return view('client.dashboard', [
            'tab' => 'tab3',
            'step' => 'step2'
        ])->with($data);
    }

    /**
     * Get attorney settings for client
     *
     * @param int $attorneyId
     * @return \App\Models\AttorneySettings|null
     */
    protected function getAttorneySettings(int $attorneyId)
    {
        return AttorneySettings::where('attorney_id', $attorneyId)->first();
    }

    /**
     * Common method to handle debt step views with redirects
     * Reduces code duplication across debt step methods
     *
     * @param string $debtStep
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    private function handleDebtStepView(string $debtStep)
    {
        $user = Auth::user();

        // Early redirect checks
        if ($this->debtDataService->shouldRedirectToIncome($user)) {
            return redirect()->route('client_income')->with('success', 'Logged in successfully');
        }

        if ($this->debtDataService->shouldRedirectToNoQuestionnaire($user)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'Logged in successfully');
        }

        $data = $this->debtDataService->getClientDebtsData();
        $data['debt_step'] = $debtStep;

        return view('client.dashboard', [
            'tab' => 'tab3',
            'step' => 'step2'
        ])->with($data);
    }

    /**
     * Display debts step 2 - Back taxes owed to state
     * Shows form for entering state tax debts
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_debts_step2_back_tax(Request $request)
    {
        return $this->handleDebtStepView('back_tax');
    }

    /**
     * Display debts step 2 - IRS taxes
     * Shows form for entering federal tax debts
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_debts_step2_irs(Request $request)
    {
        return $this->handleDebtStepView('irs');
    }

    /**
     * Display debts step 2 - Domestic support obligations
     * Shows form for entering child support, alimony debts
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_debts_step2_domestic(Request $request)
    {
        return $this->handleDebtStepView('domestic');
    }

    /**
     * Display debts step 2 - Additional liens/secured debts
     * Shows form for entering other secured debt obligations
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_debts_step2_additional(Request $request)
    {
        return $this->handleDebtStepView('secured');
    }

    /**
     * Save unsecured debt data via AJAX
     * Handles saving credit cards, medical bills, personal loans, etc.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function debt_custom_save(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;
        $input = $this->debtDataService->removeNoCreditReportInput($request->all());
        $finalInput = ClientHelper::formatInputJson($input);

        // Early permission check
        if ($request->isMethod('post') && isset($input['does_not_have_additional_creditor'])) {
            if (!Helper::isTabEditable('can_edit_debts')) {
                return response()->json([
                    'status' => false,
                    'msg' => 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.'
                ], 200);
            }

            // Process debt data using service
            $debtFinal = [];

            if (!empty($input['debt_tax'])) {
                $debtFinal = $this->debtDataService->transformDebtData($input['debt_tax']);
            }

            if (isset($input['does_not_have_additional_creditor']) && $input['does_not_have_additional_creditor'] == 0) {
                $debtFinal = [];
            }

            // Save debt information
            $finalInput['debt_tax'] = json_encode($debtFinal, JSON_NUMERIC_CHECK);
            $finalInput['does_not_have_additional_creditor'] = $input['does_not_have_additional_creditor'] ?? 0;
            $finalInput['client_id'] = $clientId;
            DebtsTax::updateOrCreate(['client_id' => $clientId], $finalInput);

            $this->debtDataService->moveLawsuitDataToSofa($debtFinal, $clientId);

            // Clear cache for client debt
            CacheDebt::forgetDebtCache($clientId);

            // Dispatch a job to move debts to sofa asynchronously
            MoveDebtsToSofa::dispatch($clientId);
        }

        // Prepare response data
        $debtsTax = ['debt_tax' => $finalInput['debt_tax']];
        $finalDebtsTax = [];
        if (!empty($debtsTax)) {
            foreach ($debtsTax as $k => $v) {
                if (is_array(json_decode($v, true, 512))) {
                    $finalDebtsTax[$k] = json_decode($v, true, 512);
                } else {
                    $finalDebtsTax[$k] = $v;
                }
            }
        }

        $codebtors = Creditors::geCodebtors($clientId, $user->client_type);
        $stateArray = AddressHelper::getStateListArray();
        $debtorNames = $this->debtDataService->getDebtorNames($clientId);

        $html = view('client.questionnaire.debt.ajax_summary.unsecured', [
            'stateArray' => $stateArray,
            'appservice_codebtors' => $codebtors,
            'debts' => $finalDebtsTax,
            'debtorname' => $debtorNames['debtorname'],
            'spousename' => $debtorNames['spousename'],
            'client_type' => $user->client_type
        ])->render();

        return response()->json([
            'status' => true,
            'msg' => 'Information saved successfully',
            'display_id' => 'unsecured_html',
            'html' => $html,
            'next_route' => route('client_debts_step2_back_tax')
        ]);
    }

    /**
     * Save additional liens/secured debts via AJAX
     * Handles saving judgment liens, secured loans, etc.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function additional_liens_custom_save(Request $request)
    {
        $client = Auth::user();
        $clientId = $client->id;
        $input = $request->all();

        // Early return for permission check
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_debts') && isset($input['additional_liens'])) {
            return response()->json([
                'status' => 0,
                'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."
            ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
        }

        $additionalFinal = [];
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_debts') && isset($input['additional_liens'])) {
            if (!empty($input['additional_liens']) && isset($input['additional_liens_data'])) {
                $checkKeyArray = [
                    'domestic_support_name',
                    'domestic_support_address',
                    'domestic_support_city',
                    'describe_secure_claim',
                    'codebtor_creditor_name',
                    'codebtor_creditor_name_addresss',
                    'codebtor_creditor_city'
                ];

                foreach ($input['additional_liens_data'] as $key => $values) {
                    foreach ($values as $valueIndex => $val) {
                        if ($key === 'additional_liens_date_unknown') {
                            $additionalFinal[$valueIndex][$key] = $val;
                        } elseif (in_array($key, $checkKeyArray)) {
                            $additionalFinal[$valueIndex][$key] = ucwords(strtolower($val));
                        } else {
                            $additionalFinal[$valueIndex][$key] = $val;
                        }
                    }
                }
            }

            // Process expenses
            $expenseData = CacheExpense::getExpenseData($clientId);
            $finalExpenses = User::getSelectedColumnsFromArray($expenseData, ['installmentpayments_value', 'installmentpayments_price', 'installmentpayments_type']);

            $expenseDataToUpdate = [
                'installmentpayments_value' => $finalExpenses['installmentpayments_value'] ?? [],
                'installmentpayments_price' => $finalExpenses['installmentpayments_price'] ?? [],
                'installmentpayments_type' => $finalExpenses['installmentpayments_type'] ?? []
            ];

            if (!empty($additionalFinal)) {
                $expenseDataToUpdate = Helper::updateInstallmentPayments($expenseDataToUpdate, [7]);

                foreach ($additionalFinal as $value) {
                    $expenseDataToUpdate['installmentpayments_value'][] = $value['domestic_support_name'];
                    $expenseDataToUpdate['installmentpayments_price'][] = $value['monthly_payment'];
                    $expenseDataToUpdate['installmentpayments_type'][] = 7;
                }

                $expense = Expenses::where("client_id", $clientId)->first();
                if ($expense) {
                    $expense->update($expenseDataToUpdate);
                } else {
                    $this->debtDataService->createNewExpenseRecord($clientId, $expenseDataToUpdate);
                }
                CacheExpense::forgetExpenseCache($clientId);
            }

            // Update debts tax
            DebtsTax::updateOrCreate(
                ["client_id" => $clientId],
                [
                    'additional_liens_data' => json_encode($additionalFinal, JSON_NUMERIC_CHECK),
                    'client_id' => $clientId,
                    'additional_liens' => $input['additional_liens'] ?? 0
                ]
            );

            // clear cache for client debt
            CacheDebt::forgetDebtCache($clientId);

            FormsStepsCompleted::updateOrCreate(
                ["client_id" => $clientId],
                ['client_id' => $clientId, 'step3' => 1]
            );

            MoveDebtsToSofa::dispatch($clientId);
        }

        // Prepare response data using service
        $viewData = $this->debtDataService->getCommonDebtViewData($clientId, $client);

        return response()->json([
            'status' => 1,
            'msg' => "Information has been saved successfully.",
            'display_id' => 'additional_liens_html',
            'html' => view('client.questionnaire.debt.ajax_summary.additional_liens', $viewData)->render(),
            'next_route' => route('client_income')
        ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }

    /**
     * Save back tax (state taxes) data via AJAX
     * Handles saving state tax debts owed
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function back_tax_custom_save(Request $request)
    {
        $client = Auth::user();
        $clientId = $client->id;
        $input = $request->all();

        // Early permission check
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_debts') && isset($input['tax_owned_state'])) {
            return response()->json([
                'status' => 0,
                'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."
            ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
        }

        // Process data if authorized
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_debts') && isset($input['tax_owned_state'])) {
            $selectedYes = Helper::validate_key_value('tax_owned_state', $input, 'radio');
            $dataToUpdate = [];

            if ($selectedYes == 1) {
                $backdebtFinal = $this->debtDataService->processBackTaxData($input['back_tax_own'] ?? []);
                if (!empty($backdebtFinal)) {
                    $this->debtDataService->moveBackTaxesToCreditorReport($backdebtFinal);
                }
                $dataToUpdate = [
                    'back_tax_own' => json_encode($backdebtFinal, JSON_NUMERIC_CHECK),
                    'client_id' => $clientId,
                    'tax_owned_state' => 1
                ];
            } else {
                $dataToUpdate = [
                    'back_tax_own' => "",
                    'client_id' => $clientId,
                    'tax_owned_state' => 0
                ];
            }

            DebtsTax::updateOrCreate(
                ["client_id" => $clientId],
                $dataToUpdate
            );

            // Clear cache for client debt
            CacheDebt::forgetDebtCache($clientId);

            MoveDebtsToSofa::dispatch($clientId);
            $this->debtDataService->moveIrsBackTaxesAmountToExpense($clientId);
        }

        // Prepare response data using service
        $viewData = $this->debtDataService->getCommonDebtViewData($clientId, $client);

        return response()->json([
            'status' => 1,
            'msg' => "Information has been saved successfully.",
            'display_id' => 'tax-owned-state',
            'html' => view('client.questionnaire.debt.ajax_summary.back_taxes', $viewData)->render(),
        ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }

    /**
     * Save IRS tax debt data via AJAX
     * Handles saving federal tax debts owed to IRS
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function irs_custom_save(Request $request)
    {
        $clientId = Auth::user()->id;
        $input = $request->all();

        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_debts') && isset($input['tax_owned_irs'])) {
            return response()->json([
                'status' => 0,
                'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."
            ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
        }

        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_debts') && isset($input['tax_owned_irs'])) {
            if (isset($input['tax_owned_irs']) && !empty($input['tax_owned_irs'])) {
                $this->debtDataService->moveIRSTaxesToCreditorReport($input);
                $finalInput = $input;
                if (!isset($input['tax_irs_owned_by'])) {
                    $finalInput['tax_irs_owned_by'] = 1;
                }
                if (!isset($input['tax_irs'])) {
                    // Default payment structure for IRS taxes
                    $finalInput['tax_irs'] = json_encode($this->getDefaultIrsPaymentStructure());
                } else {
                    $taxIrs = json_encode(Helper::validate_key_value('tax_irs', $input));
                    $finalInput['tax_irs'] = $taxIrs;
                }
                $finalInput['tax_irs_state'] = 'PA';
            } else {
                $finalInput = $this->getEmptyIrsTaxData($clientId);
            }

            DebtsTax::updateOrCreate(["client_id" => $clientId], $finalInput);

            // Clear cache for client debt
            CacheDebt::forgetDebtCache($clientId);

            MoveDebtsToSofa::dispatch($clientId);
            $this->debtDataService->moveIrsBackTaxesAmountToExpense($clientId);
        }

        // Prepare response data using service
        $viewData = $this->debtDataService->getCommonDebtViewData($clientId, Auth::user());

        return response()->json([
            'status' => 1,
            'msg' => "Information has been saved successfully.",
            'display_id' => 'irs-texes-views',
            'html' => view('client.questionnaire.debt.ajax_summary.irs_taxes', $viewData)->render(),
        ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }

    /**
     * Get default IRS payment structure
     * Extracted to reduce line length and improve maintainability
     *
     * @return array
     */
    private function getDefaultIrsPaymentStructure(): array
    {
        return [
            'is_back_tax_irs_three_months' => 0,
            'payment_1' => null,
            'payment_dates_1' => date('m/Y', strtotime('-3 month')),
            'payment_2' => null,
            'payment_dates_2' => date('m/Y', strtotime('-2 month')),
            'payment_3' => null,
            'payment_dates_3' => date('m/Y', strtotime('-1 month')),
            'total_amount_paid' => null
        ];
    }

    /**
     * Get empty IRS tax data structure
     * Extracted to reduce complexity and improve readability
     *
     * @param int $clientId
     * @return array
     */
    private function getEmptyIrsTaxData(int $clientId): array
    {
        return [
            'client_id' => $clientId,
            'tax_owned_irs' => 0,
            'tax_irs_state' => '',
            'tax_irs_whats_year' => '',
            'tax_irs_total_due' => '',
            'tax_irs_owned_by' => '',
            'tax_irs_codebtor_creditor_name' => '',
            'tax_irs_codebtor_creditor_name_addresss' => '',
            'tax_irs_codebtor_creditor_city' => '',
            'tax_irs_codebtor_creditor_state' => '',
            'tax_irs_codebtor_creditor_zip' => '',
            'tax_irs' => json_encode($this->getDefaultIrsPaymentStructure())
        ];
    }


    /**
     * Save domestic support obligation (DSO) data via AJAX
     * Handles saving child support and alimony debts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dso_custom_save(Request $request)
    {
        $clientId = Auth::user()->id;
        $input = $request->all();

        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_debts') && isset($input['domestic_support'])) {
            return response()->json([
                'status' => 0,
                'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."
            ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
        }

        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_debts') && isset($input['domestic_support'])) {
            $domesticFinal = [];
            if (isset($input['domestic_support']) && $input['domestic_support'] != 0) {
                $checkKeyArray = [
                    'domestic_support_name',
                    'domestic_support_address',
                    'domestic_support_city'
                ];
                foreach ($input['domestic_tax'] as $key => $values) {
                    $i = 0;
                    foreach ($values as $val) {
                        if (in_array($key, $checkKeyArray)) {
                            $domesticFinal[$i][$key] = ucwords(strtolower($val));
                        } else {
                            $domesticFinal[$i][$key] = $val;
                        }
                        $i++;
                    }
                }
            }

            if (!empty($domesticFinal)) {
                $this->debtDataService->moveDomesticToCreditorReport($domesticFinal);
            }

            $finalInput['domestic_tax'] = json_encode($domesticFinal, 1);
            $finalInput['domestic_support'] = isset($input['domestic_support']) ? $input['domestic_support'] : 0;
            $finalInput['client_id'] = $clientId;
            DebtsTax::updateOrCreate(["client_id" => $clientId], $finalInput);

            // clear cache for client debt
            CacheDebt::forgetDebtCache($clientId);

            $this->debtDataService->moveDsoDebtsToSofa($domesticFinal, $clientId);
        }

        // Prepare response data using service
        $viewData = $this->debtDataService->getCommonDebtViewData($clientId, Auth::user());

        return response()->json([
            'status' => 1,
            'msg' => "Information has been saved successfully.",
            'display_id' => 'domestic_div_html',
            'html' => view('client.questionnaire.debt.ajax_summary.dso', $viewData)->render(),
            'next_route' => route('client_debts_step2_additional')
        ], 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }

    /**
     * Confirm credit report creditors
     * Imports approved creditors from credit report into client debts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function confirm_credit_report(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = Auth::user()->id;
            $report_id = $input['report_id'];
            $client_confirm = $input['client_confirm'];
            $confirm_type = $input['confirm_type'] ?? null;
            if (!empty($report_id) && !empty($client_confirm)) {
                CrsCreditReport::where(['id' => $report_id, 'client_id' => $client_id])->update(['client_confirm' => $client_confirm, 'updated_at' => date('Y-m-d H:i:s')]);

                return response()->json(['status' => 1, 'msg' => "Record(s) Updated successfully."])->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $date = date('m/Y');
            $crsObj = new CrsCreditReport();
            $user = User::find($client_id);

            $debt_tax = CacheDebt::getDebtData($client_id);
            $crsids = [];
            $debt_tax = Helper::validate_key_value('debt_tax', $debt_tax, 'array');

            if (empty($report_id) && empty($client_confirm)) {
                if ($confirm_type == 'balanced') {
                    $listofRecord = CrsCreditReport::where(['is_ai_processed' => 1, 'client_id' => $client_id])->where('client_confirm', '!=', CrsCreditReport::PENDING_CLIENT_DECLINED)->where('creditLiabilityPastDueAmount', '>', 0)->get()->toArray();
                }
                if ($confirm_type == 'all') {
                    $listofRecord = CrsCreditReport::where(['is_ai_processed' => 1, 'client_id' => $client_id])->where('client_confirm', '!=', CrsCreditReport::PENDING_CLIENT_DECLINED)->get()->toArray();
                }
                // Ensure $debt_tax is always an array before pushing
                if (!is_array($debt_tax)) {
                    $debt_tax = [];
                }
                foreach ($listofRecord as $debt) {
                    $new_tax = $crsObj->importintoCreditor($client_id, $debt, $date, $debt_tax, $user->client_type);
                    $debt_tax[] = $new_tax;
                    $crsids[] = $debt['id'];
                }

                $serialized = array_map('serialize', $debt_tax);
                // Remove duplicates
                $unique = array_unique($serialized);

                // Unserialize back to original format
                $debt_tax = array_map('unserialize', $unique);
                $row = [];
                $row['debt_tax'] = json_encode($debt_tax);
                $row['client_id'] = $client_id;
                $row['does_not_have_additional_creditor'] = 1;

                DebtsTax::updateOrCreate(['client_id' => $client_id], $row);

                // clear cache for client debt
                CacheDebt::forgetDebtCache($client_id);

                CrsCreditReport::whereIn('id', $crsids)->update(['is_imported' => 1, 'client_confirm' => CrsCreditReport::PENDING_CLIENT_APPROVE, 'updated_at' => date('Y-m-d H:i:s')]);

                return response()->json(['status' => 1, 'msg' => "Record(s) Updated successfully."])->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }
    }

    /**
     * Display credit report confirmation popup
     * Shows list of creditors from credit report for client review
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function confirm_credit_popup(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = Auth::user()->id;
            $creditorsApprovedPending = CrsCreditReport::getAiProcessedClientPendingReviewed($client_id);

            $returnHTML = view('client.questionnaire.debt.creditor_confirm_popup')
                ->with(['creditorsApprovedPending' => $creditorsApprovedPending])
                ->render();

            return response()->json(['success' => true, 'html' => $returnHTML]);
        }

        return response()->json(['success' => false, 'msg' => 'Invalid request'], 400);
    }

    /**
     * Display popup to get credit report
     * Shows instructions and videos for obtaining credit report
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function open_get_report_popup(Request $request)
    {
        if ($request->isMethod('post')) {
            $getCreditReportVideos = $this->debtDataService->getCreditReportVideos();

            $returnHTML = view('client.questionnaire.debt.get_report_popup')
                ->with(['getCreditReportVideos' => $getCreditReportVideos])
                ->render();

            return response()->json(['success' => true, 'html' => $returnHTML]);
        }

        return response()->json(['success' => false, 'msg' => 'Invalid request'], 400);
    }
}
