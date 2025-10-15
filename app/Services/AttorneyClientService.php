<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Helpers\AddressHelper;
use App\Mail\WelcomeAboard;
use App\Models\InviteData;
use App\Models\AttorneySubscription;
use App\Models\ClientsAttorney;
use App\Models\FormsStepsCompleted;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Helpers\VideoHelper;
use App\Models\AttorneySettings;
use App\Models\ClientDocuments;
use App\Models\ClientsAssociate;

class AttorneyClientService
{
    public function createClient(array $input)
    {
        Log::info('AttorneyClientService@createClient: Starting client creation', [
            'email' => $input['email'] ?? 'N/A',
            'client_type' => $input['client_type'] ?? 'N/A'
        ]);

        DB::beginTransaction();
        try {
            $attorney_id = Helper::getCurrentAttorneyId();
            $password = random_int(100000, 999999);
            $postedUser = $input;
            $clientSubscription = (int)Helper::validate_key_value('client_subscription', $input);
            $basicSubscriptionPackageId = AttorneySubscription::BASIC_SUBSCRIPTION;
            if ($clientSubscription == AttorneySubscription::FREE_PACKAGE) {
                $postedUser['client_subscription'] = $basicSubscriptionPackageId;
                $postedUser['free_package_unpaid'] = 1;
            }

            Log::info('AttorneyClientService@createClient: Prepared user data', [
                'attorney_id' => $attorney_id,
                'password_generated' => 'Yes'
            ]);

            if (Helper::validate_key_value('client_send_invite', $input) === '2') {
                $postedUser['name'] = Helper::validate_key_value('spouse_first_name', $input) . ' ' . Helper::validate_key_value('spouse_last_name', $input);
                $postedUser['email'] = Helper::validate_key_value('spouse_email', $input);
                $postedUser['phone_no'] = Helper::validate_key_value('spouse_cell', $input);
            } else {
                // Combine first_name and last_name for the user record
                $postedUser['name'] = Helper::validate_key_value('first_name', $input) . ' ' . Helper::validate_key_value('last_name', $input);
            }

            $user = User::create(
                $postedUser + [
                    'password' => Hash::make($password),
                    'role' => User::CLIENT,
                    'status' => Helper::ACTIVE
                ]
            );

            if ($clientSubscription == AttorneySubscription::FREE_PACKAGE) {
                AttorneySubscription::addSubscriptionRecord($attorney_id, $basicSubscriptionPackageId, AttorneySubscription::FREE_PACKAGE_PLAN_PRICE, 1, $user->id);
            }
            Log::info('AttorneyClientService@createClient: User created successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name
            ]);

            ClientsAttorney::updateOrCreate([
                'client_id' => $user->id,
                'attorney_id' => $attorney_id
            ], [
                'client_id' => $user->id,
                'attorney_id' => $attorney_id
            ]);

            Log::info('AttorneyClientService@createClient: Client-Attorney relationship created', [
                'client_id' => $user->id,
                'attorney_id' => $attorney_id
            ]);

            if ($attorney_id == 55026) {
                //By Default add client to Alona Paralegal for attorney Sheree Cameron(55026)
                $paralegalId = 56118; //Paralegal Alona Id
                // First check if the paralegal exists in the users table
                $paralegalExists = User::where('id', $paralegalId)->exists();
                if ($paralegalExists) {
                    \App\Models\ClientParalegal::updateOrCreate([
                        'client_id' => $user->id,
                        'paralegal_id' => $paralegalId
                    ], [
                        'client_id' => $user->id,
                        'paralegal_id' => $paralegalId
                    ]);

                    Log::info('AttorneyClientService@createClient: Default paralegal assigned', [
                        'client_id' => $user->id,
                        'paralegal_id' => $paralegalId,
                        'attorney_id' => $attorney_id
                    ]);
                }
            }

            $attorney = User::find($attorney_id);
            $discountPercentage = $attorney->subscription_discount_percent ?? 0;
            $user->password = $password;
            $user->pass_flag = true;
            $packagesArray = AttorneySubscription::getSubscriptionArray($attorney_id, $user->id, $input);

            Log::info('AttorneyClientService@createClient: Creating packages', [
                'client_id' => $user->id,
                'package_count' => count($packagesArray),
                'discount_percentage' => $discountPercentage
            ]);

            foreach ($packagesArray as $package) {
                $package_id = $clientSubscription == AttorneySubscription::FREE_PACKAGE ? AttorneySubscription::BASIC_SUBSCRIPTION : $package['package_id'];

                $packageName = $this->getPackageName($package_id);
                $perPackagePrice = AttorneySubscription::allPackagePriceArray($package['package_id']);
                $discountedAmount = $this->getDiscountPrice($discountPercentage, $perPackagePrice);
                $package['package_id'] = $package_id;
                $package['per_package_price'] = $perPackagePrice;
                $package['discount_percentage'] = $discountPercentage;
                $package['discounted_price'] = $discountedAmount;
                $package['package_name'] = $packageName;
                \App\Models\SubscriptionToclient::create($package);
            }

            Log::info('AttorneyClientService@createClient: Packages created successfully', [
                'client_id' => $user->id,
                'package_count' => count($packagesArray)
            ]);

            $clientData = ['client_id' => $user->id];
            // Use separate first_name and last_name fields directly
            $clientData['name'] = Helper::validate_key_value('first_name', $input);
            $clientData['last_name'] = Helper::validate_key_value('last_name', $input);
            \App\Models\ClientBasicInfoPartA::create($clientData);

            Log::info('AttorneyClientService@createClient: Client basic info created', [
                'client_id' => $user->id,
                'first_name' => $clientData['name'],
                'last_name' => $clientData['last_name']
            ]);

            $any_other_data = [
                'email' => Helper::validate_key_value('email', $input),
                'cell' => Helper::validate_key_value('phone_no', $input)
            ];
            $user->clientAnyOtherNameData()->create($any_other_data);

            Log::info('AttorneyClientService@createClient: Client additional data created', [
                'client_id' => $user->id
            ]);

            if (Helper::validate_key_value('client_type', $input) === '3') {
                $spouseData = [
                    'client_id' => $user->id,
                    'part2_phone' => Helper::validate_key_value('spouse_cell', $input),
                    'email' => Helper::validate_key_value('spouse_email', $input),
                    'name' => Helper::validate_key_value('spouse_first_name', $input),
                    'last_name' => Helper::validate_key_value('spouse_last_name', $input)
                ];
                \App\Models\ClientBasicInfoPartB::create($spouseData);

                Log::info('AttorneyClientService@createClient: Spouse data created', [
                    'client_id' => $user->id,
                    'spouse_email' => $spouseData['email']
                ]);
            }

            InviteData::create([
                'client_id' => $user->id,
                'client_hash' => base64_encode($password),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Log::info('AttorneyClientService@createClient: Invite data created', [
                'client_id' => $user->id
            ]);

            Log::info('AttorneyClientService@createClient: Sending email to client', [
                'client_id' => $user->id,
                'email' => $user->email
            ]);

            $this->sendEmailToClient($user, $attorney_id);

            Log::info('AttorneyClientService@createClient: Email sent successfully', [
                'client_id' => $user->id
            ]);

            if (!empty($input['docsToExcludeJson'])) {
                \App\Models\AttorneyExcludeDocsPerClient::create([
                    'client_id' => $user->id,
                    'attorney_id' => $input['client_attorney'],
                    'doc_type_json' => $input['docsToExcludeJson'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                Log::info('AttorneyClientService@createClient: Excluded docs saved', [
                    'client_id' => $user->id
                ]);
            }

            if (!empty($input['new_document']) && is_array($input['new_document'])) {
                $finalArray = array_values(array_unique(array_filter($input['new_document'])));
                if (!empty($finalArray)) {
                    foreach ($finalArray as $document_name) {
                        $document_type = Helper::validate_doc_type(str_replace(' ', '_', $document_name), true);
                        \App\Models\AdminClientDocuments::create([
                            'client_id' => $user->id,
                            'document_name' => $document_name,
                            'document_type' => $document_type,
                            'added_by' => $input['client_attorney'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }

                    Log::info('AttorneyClientService@createClient: Admin documents created', [
                        'client_id' => $user->id,
                        'document_count' => count($finalArray)
                    ]);
                }
            }

            $attorney_common_doc = isset($input['attorney_common_doc']) && is_array($input['attorney_common_doc']) ? $input['attorney_common_doc'] : [];
            if (!empty($attorney_common_doc) && is_array($attorney_common_doc)) {
                foreach ($attorney_common_doc as $type => $name) {
                    ClientDocuments::create([ 'client_id' => $user->id,
                        'document_name' => $type,
                        'document_type' => $name,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'type' => 'attorney_common_doc'
                    ]);
                }

                Log::info('AttorneyClientService@createClient: Attorney common documents created', [
                    'client_id' => $user->id,
                    'document_count' => count($attorney_common_doc)
                ]);
            }

            if (isset($input['onepage_questionnaire_request_id']) && $input['onepage_questionnaire_request_id'] > 0) {
                Log::info('AttorneyClientService@createClient: Importing intake client notes', [
                    'client_id' => $user->id,
                    'questionnaire_id' => $input['onepage_questionnaire_request_id']
                ]);

                $this->importIntakeClientNotes($user->id, $input['onepage_questionnaire_request_id']);

                Log::info('AttorneyClientService@createClient: Intake client notes imported', [
                    'client_id' => $user->id
                ]);
            }

            $associate_from_law_firm = Helper::validate_key_value('associate_from_law_firm', $input, 'radio');

            if (!empty($associate_from_law_firm)) {
                ClientsAssociate::create([
                    'client_id' => $user->id,
                    'associate_id' => $associate_from_law_firm,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                Log::info('AttorneyClientService@createClient: Associate assigned', [
                    'client_id' => $user->id,
                    'associate_id' => $associate_from_law_firm
                ]);
            }

            Log::info('AttorneyClientService@createClient: Committing transaction', [
                'client_id' => $user->id,
                'email' => $user->email
            ]);

            DB::commit();

            Log::info('AttorneyClientService@createClient: Client creation completed successfully', [
                'client_id' => $user->id,
                'email' => $user->email,
                'attorney_id' => $attorney_id
            ]);

        } catch (\Exception $e) {
            Log::error('AttorneyClientService@createClient: Exception occurred', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'email' => $input['email'] ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);

            DB::rollBack();
            Log::info('AttorneyClientService@createClient: Transaction rolled back');

            throw $e;
        }
    }

    public function getDiscountPrice($discountPercentage, $packagePriceTotal)
    {
        return number_format((float)$packagePriceTotal * ((float)$discountPercentage / 100), 3);
    }

    public function getPackageName($package_id)
    {
        return  \App\Models\AttorneySubscription::allPackageNameWithParamForTransactionArray($package_id);
    }

    public function importIntakeClientNotes($client_id, $questionnaire_id)
    {
        $notes = \App\Models\ShortFormNotes::where('questionnaire_id', $questionnaire_id)->orderby('id', 'asc')->get();
        $notes = !empty($notes) ? $notes->toArray() : [];
        foreach ($notes as $data) {
            \App\Models\ConciergeServiceNotes::Create([
                'client_id' => $client_id,
                'added_by_id' => $data['attorney_id'],
                'attachment_file' => '',
                'subject' => $data['subject'],
                'note' => $data['notes'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function getSeperatedName($fullName)
    {
        $nameParts = explode(' ', $fullName);
        $data = [
            "name" => '',
            "middle_name" => '',
            "last_name" => '',
        ];
        if (!empty($nameParts) && is_array($nameParts)) {
            if (count($nameParts) == 1) {
                $data['name'] = $nameParts[0];
                $data['last_name'] = '';
            } elseif (count($nameParts) >= 2) {
                $data['name'] = $nameParts[0];
                $data['last_name'] = end($nameParts);
                if (count($nameParts) > 2) {
                    $data['middle_name'] = implode(' ', array_slice($nameParts, 1, -1));
                }
            } else {
                $data['name'] = $nameParts[0] ?? '';
                $data['last_name'] = is_array($nameParts) ? end($nameParts) : '';
            }
        }

        return $data;
    }

    public function updateClient(array $input, int $user_id): bool
    {
        if (!isset($input["retainer_agreement_box"])) {
            $input["retainer_agreement_box"] = 0;
        }

        return User::where("id", $user_id)->update($input);
    }

    public function getClientForShow(int $user_id): array
    {
        $client = User::select('users.*', 'attorney.name as attorney_name')
            ->where('users.id', $user_id)
            ->leftJoin('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id')
            ->leftJoin('users as attorney', 'attorney.id', '=', 'tbl_clients_attorney.attorney_id')
            ->first();
        $editable = FormsStepsCompleted::select('can_edit')->where('client_id', $user_id)->first();

        $form_completed_clients = FormsStepsCompleted::where('client_id', $user_id)
            ->select('client_id', DB::raw('SUM(step1+step2+step3+step4+step5+step6) as Total'))
            ->groupBy('client_id')
            ->get()
            ->pluck('Total', 'client_id')
            ->toArray();

        $total = $form_completed_clients[$user_id] ?? 0;
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CLIENT_QUESTIONNAIRE_VIDEO);

        return [
            'User' => $client,
            'editable' => $editable->can_edit ?? 0,
            'type' => 'view',
            'totals' => $total,
            'video' => $video
        ];
    }

    public function deleteClient($client_id)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $user = User::where('id', $client_id)->first();

        if ($user && self::clientExist($client_id)) {
            ClientsAttorney::where(['client_id' => $client_id, "attorney_id" => $attorney_id])->delete();
            $this->deleteCleintRelationships($user);

            return $user->delete();
        }

        return false;
    }

    public function deleteCleintRelationships(User $user)
    {
        Message::where('from_user_id', $user->getAttribute('id'))->orWhere(
            'to_user_id',
            $user->getAttribute('id')
        )->delete();
        $user->clientAnyOtherNameData()->delete();
        $user->clientBasicInfoPartA()->delete();
        $user->clientBasicInfoPartB()->delete();
        $user->clientBasicInfoPartC()->delete();
        $user->clientLivedAddressFrom730Data()->delete();
        $user->clientBasicInfoPartRest()->delete();
        $user->clientsPropertyResident()->delete();
        $user->clientsPropertyVehicle()->delete();
        $user->clientsPropertyHousehold()->delete();
        $user->clientsPropertyFinancialAssets()->delete();
        $user->clientsPropertyBusinessAssets()->delete();
        $user->ClientsPropertyFarmCommercial()->delete();
        $user->clientsPropertyMiscellaneous()->delete();

        /* Debts Model Section */
        $user->debts()->delete();
        $user->debtsTax()->delete();

        /* Income Model Section */
        $user->incomeDebtorEmployer()->delete();
        $user->incomeDebtorSpouseEmployer()->delete();
        $user->incomeDebtorMonthlyIncome()->delete();
        $user->incomeDebtorSpouseMonthlyIncome()->delete();

        $user->expenses()->delete();
        $user->spouseExpenses()->delete();

        $user->financialAffairs()->delete();

        $user->clientDocumentUploaded()->delete();
        $user->clientsApplicationPayment()->delete();
        $user->debtsDocuments()->delete();
        $user->signedDocuments()->delete();

        $user->formsStepsCompleted()->delete();
    }

    public function resendEmailToClient($client_id)
    {
        $user = User::find($client_id);
        $attorney_id = Helper::getCurrentAttorneyId();

        if (!$user || !self::clientExist($client_id)) {
            return false;
        }

        DB::beginTransaction();
        if ($user && self::clientExist($client_id)) {
            try {
                $exists = InviteData::where('client_id', $client_id)->exists();
                $password = random_int(100000, 999999);

                $data = [
                        'client_id' => $user->id,
                        'client_hash' => base64_encode($password),
                        'updated_at' => now()
                    ];

                if (!$exists) {
                    $data['created_at'] = now();
                }

                $user->update(["password" => Hash::make($password)]);
                InviteData::updateOrCreate(
                    ['client_id' => $user->id],
                    $data
                );

                $user->password = $password; // reassign password in user object

                $this->sendEmailToClient($user, $attorney_id);

                DB::commit();

                return true;

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Failed to resend client email", [
                    'client_id' => $client_id,
                    'error' => $e->getMessage()
                ]);

                return false;

            }

        }

    }

    private function sendEmailToClient(User $user, $client_attorney)
    {
        $attorney = User::select('users.id', 'tbl_attorney_company.company_name', 'tbl_attorney_company.attorney_phone', 'users.name', 'users.email')
                        ->leftJoin('tbl_attorney_company', 'users.id', '=', 'tbl_attorney_company.attorney_id')
                        ->where('users.id', $client_attorney)
                        ->first();

        $this->sendBothInviteMailAndMessage($user, $user->email, $attorney, $user->phone_no);
    }

    public function sendBothInviteMailAndMessage($user, $email, $attorney, $cellNo = '')
    {
        try {
            $clientLoginUrl = AttorneySettings::getClientLoginUrl($attorney->id);
            Log::info("Invite email sent---".$user->email."&id=".$user->id.'&name='.$user->name.'&email='.$user->email.'&phone='.$user->phone_no.'&password='.$user->password.'&clientLoginUrl='.$clientLoginUrl);
            Mail::to($email)->send(
                new WelcomeAboard($user, false, $attorney, $clientLoginUrl)
            );
        } catch (\Exception $e) {
            Log::error("Error sending email: " . $e->getMessage());
        }
        AddressHelper::sendMobileTextMessage($user, $attorney, $cellNo);
    }

    public static function clientExist($client_id): bool
    {
        $attorney_id = Helper::getCurrentAttorneyId();

        return ClientsAttorney::where(['client_id' => $client_id, "attorney_id" => $attorney_id])->exists();
    }

}
