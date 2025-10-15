<?php

namespace App\Models;

use App\Helpers\DocumentHelper;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OnePageQuestionnaireRequest extends Model
{
    protected $table = 'tbl_one_page_questionnaire_request';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'attorney_id',
        'session_id',
        'martial_status',
        'name',
        'middle_name',
        'last_name',
        'suffix',
        'home',
        'cell',
        'work',
        'date_of_birth',
        'email',
        'Address',
        'City',
        'state',
        'zip',
        'country',
        'has_security_number',
        'security_number',
        'itin',
        'lived_address_from_180',
        'filed_in_last_8_yrs',
        'chapter',
        'spouse_name',
        'spouse_middle_name',
        'spouse_last_name',
        'spouse_suffix',
        'spouse_work',
        'spouse_date_of_birth',
        'spouse_email',
        'spouse_cell',
        'spouse_has_security_number',
        'spouse_security_number',
        'spouse_itin',
        'spouse_lived_at_this_address',
        'spouse_diff_address',
        'spouse_address',
        'spouse_city',
        'd2_state',
        'spouse_zip',
        'spouse_country',
        'family_members',
        'income_paid_1',
        'income_avg_paycheck',
        'income_spouse_avg_paycheck',
        'income_paid_2',
        'income_rpmo',
        'income_net_profit',
        'income_other_income',
        'income_notes',
        'rent_or_own',
        'loan_on_property',
        'mortgage_rent_1',
        'mortgage_own_1',
        'mortgage_past_payment_1',
        'mortgage_amount_owned_1',
        'mortgage_property_value_1',
        'mortgages_creditor_name_1',
        'mortgages_creditor_address_1',
        'mortgages_creditor_city_1',
        'mortgages_creditor_state_1',
        'mortgages_creditor_zipcode_1',
        'mortgage_additional_loans',
        'mortgage_rent_2',
        'mortgage_own_2',
        'mortgage_past_payment_2',
        'mortgage_amount_owned_2',
        'mortgages_creditor_name_2',
        'mortgages_creditor_address_2',
        'mortgages_creditor_city_2',
        'mortgages_creditor_state_2',
        'mortgages_creditor_zipcode_2',
        'mortgage_additional_loans_2',
        'mortgage_rent_3',
        'mortgage_own_3',
        'mortgage_past_payment_3',
        'mortgage_amount_owned_3',
        'mortgages_creditor_name_3',
        'mortgages_creditor_address_3',
        'mortgages_creditor_city_3',
        'mortgages_creditor_state_3',
        'mortgages_creditor_zipcode_3',
        'mortgage_foreclosure_property',
        'mortgage_foreclosure_date',
        'mortgage_foreclosure_date_scheduled',
        'mortgage_notes',
        'taxes_internal_revenue_year',
        'taxes_irs_taxes_due',
        'taxes_tax_state',
        'taxes_franchise_tax_board',
        'taxes_state_tax_due',
        'taxes_child_support_state',
        'taxes_child_support_due',
        'taxes_alimony_state',
        'taxes_alimony_due',
        'credit_crd_debt',
        'medical_debt',
        'student_loans',
        'law_suit',
        'personal_loans',
        'credit_union_loans',
        'family_loans',
        'made_purchases',
        'used_one_card',
        'checking_account',
        'created_at',
        'updated_at',
        'vehicle_details',
        'is_imported',
        'date_filed',
        'employee_type_1',
        'employee_type_2',
        'income_net_profit_spouse',
        'ss_income',
        'child_supp_or_alimony',
        'own_any_vehicle',
        'additional_liens',
        'additional_liens_data',
        'last_5_year_taxes',
        'misc_loans',
        'concierge_question',
        'current_on_your_support_obligation',
        'debtor_income_data',
        'codebtor_income_data',
        'tax_owned_irs',
        'back_taxes_owed',
        'being_sued',
        'wages_being_garnished',
        'extra_notes',
        'step_completed',
        'emergency_check',
        'emergency_notes',
        'find_us',
        'google_reviews',
        'zoom_exp',
        'step_1_submited',
        'step_2_submited',
        'step_3_submited',
        'any_bankruptcy_filed_before_data',
        'spouse_filing_with_you',
        'chapter_13_filed_info',
        'lived_in_nc_month',
        'lived_in_nc_year',
        'find_us_referred_by',
        'debtor_job_title',
        'debtor_total_family_income',
        'debtor_bussiness_name',
        'debtor_bussiness_type',
        'debtor_bussiness_nature',
        'debtor_money_owed_by_anyone',
        'debtor_future_large_amount',
        'debtor_last_6_month_large_amount',
        'debtor_sued_details',
        'debtor_retirement_life_insurance_date',
        'debtor_retirement_life_insurance',
        'spouse_job_title',
        'spouse_total_family_income',
        'spouse_bussiness_name',
        'spouse_bussiness_type',
        'spouse_bussiness_nature',
        'spouse_money_owed_by_anyone',
        'spouse_future_large_amount',
        'spouse_last_6_month_large_amount',
        'spouse_sued_details',
        'spouse_retirement_life_insurance',
        'spouse_retirement_life_insurance_date',
        'other_property_let_go_item',
        'other_property_new_stuff',
        'other_property_valued_possession',
        'vehicle_repoed_date',
        'borrowed_and_paid_back',
        'joint_debt',
        'total_unsecured_loan',
        'total_utility_debt',
        'tolls_tickets_fines_owed',
        'eviction_or_back_rent',
        'foreclosure_debt',
        'repo_debt',
        'money_you_have',
        'property_own_data'
    ];

    public static function importClientData($requestId)
    {
        try {
            Log::info('OnePageQuestionnaireRequest@importClientData: Starting import process', [
                'questionnaire_request_id' => $requestId
            ]);

            // Validate input
            if (empty($requestId)) {
                Log::error('OnePageQuestionnaireRequest@importClientData: Invalid request ID');

                return ['success' => false, 'error' => 'Invalid request ID'];
            }

            // Begin database transaction for data consistency
            DB::beginTransaction();

            $user = \App\Models\User::where('onepage_questionnaire_request_id', $requestId)->select(['id', 'client_type'])->first();

            if (!$user) {
                Log::error('OnePageQuestionnaireRequest@importClientData: User not found', [
                    'questionnaire_request_id' => $requestId
                ]);
                DB::rollBack();

                return ['success' => false, 'error' => 'User not found'];
            }

            Log::info('OnePageQuestionnaireRequest@importClientData: User found', [
                'user_id' => $user->id,
                'client_type' => $user->client_type,
                'questionnaire_request_id' => $requestId
            ]);

            // Fetch questionnaire with error handling
            $questionRecord = OnePageQuestionnaireRequest::where('id', $requestId)->first();
            if (!$questionRecord) {
                Log::error('OnePageQuestionnaireRequest@importClientData: Questionnaire not found', [
                    'questionnaire_request_id' => $requestId
                ]);
                DB::rollBack();

                return ['success' => false, 'error' => 'Questionnaire not found'];
            }

            $question = $questionRecord->toArray();
            $question['client_id'] = $user->id;

            $sessionId = $question['session_id'] ?? '';

            Log::info('OnePageQuestionnaireRequest@importClientData: Questionnaire data retrieved', [
                'user_id' => $user->id,
                'session_id' => $sessionId
            ]);

            $dateTime = date("Y-m-d H:i:s");

            // Import Basic Info with safe array access
            $basicinfo = [
                'client_id' => $user->id,
                'marital_status' => $question['martial_status'] ?? '',
                "name" => $question['name'] ?? '',
                "middle_name" => $question['middle_name'] ?? '',
                "last_name" => $question['last_name'] ?? '',
                "suffix" => $question['suffix'] ?? '',
                "has_security_number" => (empty($question['security_number']) ? '' : 0),
                "security_number" => $question['security_number'] ?? '',
                "Address" => $question['Address'] ?? '',
                "City" => $question['City'] ?? '',
                "state" => $question['state'] ?? '',
                "zip" => $question['zip'] ?? '',
                "country" => $question['country'] ?? '',
                "lived_address_from_180" => $question['lived_address_from_180'] ?? '',
            ];
            $anyother = [
                'client_id' => $user->id,
                "home" => $question['home'] ?? '',
                "cell" => $question['cell'] ?? '',
                "work" => $question['work'] ?? '',
                "date_of_birth" => $question['date_of_birth'] ?? '',
                "email" => $question['email'] ?? '',
            ];

            \App\Models\ClientAnyOtherNameData::updateOrCreate(['client_id' => $user->id], $anyother);
            \App\Models\ClientBasicInfoPartA::updateOrCreate(['client_id' => $user->id], $basicinfo);

            Log::info('OnePageQuestionnaireRequest@importClientData: Basic info and contact data created', [
                'user_id' => $user->id
            ]);

            // Import Bankruptcy History
            if (Helper::validate_key_value('filed_in_last_8_yrs', $question, 'radio') == 0) {
                $basicinfoPartC = [
                    'pending_pior_cases' => 1,
                    'bankruptcy_filed_before' => 1,
                    'any_bankruptcy_filed_before_data' => Helper::validate_key_value('any_bankruptcy_filed_before_data', $question),
                    'created_on' => $dateTime,
                    'updated_on' => $dateTime,
                ];
                \App\Models\ClientBasicInfoPartC::updateOrCreate(['client_id' => $user->id], $basicinfoPartC);

                Log::info('OnePageQuestionnaireRequest@importClientData: Bankruptcy history data created', [
                    'user_id' => $user->id
                ]);
            }

            // Decode JSON income data with error handling
            $debtor_income_data = [];
            $codebtor_income_data = [];

            $debtor_income_json = Helper::validate_key_value('debtor_income_data', $question);
            if (!empty($debtor_income_json)) {
                $debtor_income_data = json_decode($debtor_income_json, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('OnePageQuestionnaireRequest@importClientData: Invalid debtor income JSON', [
                        'user_id' => $user->id,
                        'json_error' => json_last_error_msg()
                    ]);
                    $debtor_income_data = [];
                }
            }

            $codebtor_income_json = Helper::validate_key_value('codebtor_income_data', $question);
            if (!empty($codebtor_income_json)) {
                $codebtor_income_data = json_decode($codebtor_income_json, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('OnePageQuestionnaireRequest@importClientData: Invalid codebtor income JSON', [
                        'user_id' => $user->id,
                        'json_error' => json_last_error_msg()
                    ]);
                    $codebtor_income_data = [];
                }
            }

            // Import Business EIN Data
            $partRestData = [];
            $usedBussinessData = json_encode(['client_id' => $user->id, 'created_on' => $dateTime, 'updated_on' => $dateTime]);
            if (!empty($debtor_income_data) && Helper::validate_key_value('self_employment_inc_debtor', $debtor_income_data, 'radio') == 1) {
                $usedBussinessData = self::getUsedBusinessEinData($usedBussinessData, $question, 0, Helper::validate_key_value('income_net_profit', $debtor_income_data));
                $partRestData = [
                    'used_business_ein' => 1,
                    'used_business_ein_data' => $usedBussinessData,
                ];
            }
            if (!empty($codebtor_income_data) && Helper::validate_key_value('self_employment_inc_spouse', $codebtor_income_data, 'radio') == 1) {
                $usedBussinessData = self::getUsedBusinessEinData($usedBussinessData, $question, 1, Helper::validate_key_value('income_net_profit_spouse', $codebtor_income_data));
                if (empty($partRestData)) {
                    $partRestData = [
                        'used_business_ein' => 1,
                        'used_business_ein_data' => $usedBussinessData,
                    ];
                } else {
                    $partRestData['used_business_ein_data'] = $usedBussinessData;
                }
            }

            if (!empty($partRestData)) {
                \App\Models\ClientBasicInfoPartRest::updateOrCreate(['client_id' => $user->id], $partRestData);

                Log::info('OnePageQuestionnaireRequest@importClientData: Business EIN data created', [
                    'user_id' => $user->id
                ]);
            }

            // Import Spouse Data for Joint Clients
            if ($user->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED) {
                Log::info('OnePageQuestionnaireRequest@importClientData: Processing spouse data', [
                    'user_id' => $user->id,
                    'client_type' => $user->client_type
                ]);
                $spouseData = [
                    'client_id' => $user->id,
                    "name" => $question['spouse_name'] ?? '',
                    "middle_name" => $question['spouse_middle_name'] ?? '',
                    "last_name" => $question['spouse_last_name'] ?? '',
                    "suffix" => $question['spouse_suffix'] ?? '',
                    'has_security_number' => (empty($question['spouse_security_number']) ? '' : 0),
                    'social_security_number' => $question['spouse_security_number'] ?? '',
                    "part2_dob" => $question['spouse_date_of_birth'] ?? '',
                    "part2_phone" => $question['spouse_cell'] ?? '',
                    'part2_driving_license' => $question['spouse_work'] ?? '',
                    "lived_address_from_180" => $question['spouse_lived_at_this_address'] ?? '',
                    "spouse_different_address" => $question['spouse_diff_address'] ?? '',
                    "Address" => $question['spouse_address'] ?? '',
                    "City" => $question['spouse_city'] ?? '',
                    "state" => $question['d2_state'] ?? '',
                    "zip" => $question['spouse_zip'] ?? '',
                    "country" => $question['spouse_country'] ?? '',
                    "email" => $question['spouse_email'] ?? '',
                ];
                \App\Models\ClientBasicInfoPartB::updateOrCreate(['client_id' => $user->id], $spouseData);
                $spouse_gross_wages = 0;
                $spouse_operation_business = 0;
                $spouse_business = '';
                $spouse_oftengetpaid = '';
                $spouse_grosswages = '';
                if (isset($question['employee_type_2']) && $question['employee_type_2'] == 0) {
                    $spouse_gross_wages = 1;
                    $spouse_oftengetpaid = $question['income_paid_2'] ?? '';
                    $spouse_grosswages = json_encode([1 => $question['income_spouse_avg_paycheck'] ?? 0]);
                } else {
                    $spouse_operation_business = 1;
                    $spouse_business = json_encode([
                        'profit_loss_type' => 1,
                        'gross_business_income' => $question['income_net_profit_spouse'] ?? 0,
                        'total_profit_loss' => $question['income_net_profit_spouse'] ?? 0
                    ]);
                }
                $spouseincome = [
                    'client_id' => $user->id,
                    'joints_debtor_gross_wages' => $spouse_gross_wages,
                    'joints_often_get_paid' => $spouse_oftengetpaid,
                    'joints_debtor_gross_wages_month' => $spouse_grosswages,
                    'joints_operation_business' => $spouse_operation_business,
                    'income_profit_loss' => $spouse_business
                ];

                if (!empty($codebtor_income_data)) {
                    $codebtor_income_profit_loss = self::getIncomeProfitLossData($question, $codebtor_income_data, 2, !empty($codebtor_income_data));
                    $spouseincome = [
                        'client_id' => $user->id,
                        // Are you currently employed:
                        'joints_debtor_gross_wages' => (isset($codebtor_income_data['joints_debtor_gross_wages']) && !empty($codebtor_income_data['joints_debtor_gross_wages'])) ? 1 : 0,
                        'joints_debtor_gross_wages_month' => json_encode([1 => Helper::validate_key_value('joints_debtor_gross_wages_month', $codebtor_income_data)]),
                        // Have you had any Self Employment Income:
                        'joints_operation_business' => (isset($codebtor_income_data['self_employment_inc_spouse']) && !empty($codebtor_income_data['self_employment_inc_spouse'])) ? 1 : 0,
                        'profit_loss_business_name' => Helper::validate_key_value('spouse_bussiness_name', $question),
                        'income_profit_loss' => json_encode($codebtor_income_profit_loss),
                        // Rent and other real property income:
                        'joints_rent_real_property' => (isset($codebtor_income_data['rental_inc_spouse']) && !empty($codebtor_income_data['rental_inc_spouse'])) ? 1 : 0,
                        'joints_same_rent_income' => (isset($codebtor_income_data['rental_inc_spouse']) && ($codebtor_income_data['rental_inc_spouse']) == 1) ? 1 : '',
                        'joints_rent_real_property_month' => json_encode([1 => Helper::validate_key_value('rental_inc_amt_spouse', $codebtor_income_data)]),
                        // Interest, dividends, and royalties:
                        'joints_royalties' => (isset($codebtor_income_data['royality_inc_spouse']) && !empty($codebtor_income_data['royality_inc_spouse'])) ? 1 : 0,
                        'joints_same_royalty_income' => (isset($codebtor_income_data['royality_inc_spouse']) && ($codebtor_income_data['royality_inc_spouse']) == 1) ? 1 : '',
                        'joints_royalties_month' => json_encode([1 => Helper::validate_key_value('royality_inc_amt_spouse', $codebtor_income_data)]),
                        // Pension and retirement income (NOT Social Security) (Retirement Income):
                        'joints_retirement_income' => (isset($codebtor_income_data['retirement_inc_spouse']) && !empty($codebtor_income_data['retirement_inc_spouse'])) ? 1 : 0,
                        'joints_same_retirement_income' => (isset($codebtor_income_data['retirement_inc_spouse']) && ($codebtor_income_data['retirement_inc_spouse']) == 1) ? 1 : '',
                        'joints_retirement_income_month' => json_encode([1 => Helper::validate_key_value('retirement_inc_amt_spouse', $codebtor_income_data)]),
                        // Regular contributions from others to the household expenses, including child support:
                        'joints_regular_contributions' => (isset($codebtor_income_data['regular_contributions_inc_spouse']) && !empty($codebtor_income_data['regular_contributions_inc_spouse'])) ? 1 : 0,
                        'joints_same_contribution_income' => (isset($codebtor_income_data['regular_contributions_inc_spouse']) && ($codebtor_income_data['regular_contributions_inc_spouse']) == 1) ? 1 : '',
                        'joints_regular_contributions_month' => json_encode([1 => Helper::validate_key_value('regular_contributions_inc_amt_spouse', $codebtor_income_data)]),
                        // Unemployment Compensation:
                        'joints_unemployment_compensation' => (isset($codebtor_income_data['unemployment_compensation_inc_spouse']) && !empty($codebtor_income_data['unemployment_compensation_inc_spouse'])) ? 1 : 0,
                        'joints_same_unemployement_compensation' => (isset($codebtor_income_data['unemployment_compensation_inc_spouse']) && ($codebtor_income_data['unemployment_compensation_inc_spouse']) == 1) ? 1 : '',
                        'joints_unemployment_compensation_month' => json_encode([1 => Helper::validate_key_value('unemployment_compensation_inc_amt_spouse', $codebtor_income_data)]),
                        // Social Security income. (SSI Income):
                        'joints_social_security' => (isset($codebtor_income_data['social_security_inc_spouse']) && !empty($codebtor_income_data['social_security_inc_spouse'])) ? 1 : 0,
                        'joints_same_social_security_income' => (isset($codebtor_income_data['social_security_inc_spouse']) && ($codebtor_income_data['social_security_inc_spouse']) == 1) ? 1 : '',
                        'joints_social_security_month' => json_encode([1 => Helper::validate_key_value('social_security_inc_amt_spouse', $codebtor_income_data)]),
                        // Other government assistance you receive regularly:
                        'government_assistance' => (isset($codebtor_income_data['government_assistance_inc_spouse']) && !empty($codebtor_income_data['government_assistance_inc_spouse'])) ? 1 : 0,
                        'joints_same_government_assistance_income' => (isset($codebtor_income_data['government_assistance_inc_spouse']) && ($codebtor_income_data['government_assistance_inc_spouse']) == 1) ? 1 : '',
                        'government_assistance_month' => json_encode([1 => Helper::validate_key_value('government_assistance_inc_amt_spouse', $codebtor_income_data)]),
                        // Other sources of income not already mentioned:
                        'joints_other_sources' => (isset($codebtor_income_data['other_sources_inc_spouse']) && !empty($codebtor_income_data['other_sources_inc_spouse'])) ? 1 : 0,
                        'joints_same_other_sources_income' => (isset($codebtor_income_data['other_sources_inc_spouse']) && ($codebtor_income_data['other_sources_inc_spouse']) == 1) ? 1 : '',
                        'joints_other_sources_month' => json_encode([1 => Helper::validate_key_value('other_sources_inc_amt_spouse', $codebtor_income_data)]),
                    ];

                    if (Helper::validate_key_value("joints_debtor_gross_wages", $codebtor_income_data, 'radio') == 1) {
                        \App\Models\IncomeDebtorSpouseEmployer::create([
                            'client_id' => $user->id,
                            'current_employed' => 1,
                            'created_on' => $dateTime,
                            'updated_on' => $dateTime,
                        ]);
                        \App\Models\AttorneyEmployerInformationToClient::create([
                            'employer_name' => Helper::validate_key_value('spouse_job_title', $question),
                            'employer_type' => 1,
                            'client_type' => 2,
                            'client_id' => $user->id,
                            'attorney_id' => $question['attorney_id'] ?? null,
                            'created_on' => $dateTime,
                            'updated_on' => $dateTime,
                        ]);
                    }

                }

                \App\Models\IncomeDebtorSpouseMonthlyIncome::updateOrCreate(['client_id' => $user->id], $spouseincome);

                Log::info('OnePageQuestionnaireRequest@importClientData: Spouse data and income created', [
                    'user_id' => $user->id
                ]);
            }

            // Import Debtor Income Data
            $debtor_gross_wages = 0;
            $operation_business = 0;
            $business = '';
            $oftengetpaid = null;
            $grosswages = '';

            if (isset($question['employee_type_1']) && $question['employee_type_1'] == 0) {
                $debtor_gross_wages = 1;
                $oftengetpaid = $question['income_paid_1'] ?? null;
                $grosswages = json_encode([1 => $question['income_avg_paycheck'] ?? 0]);
            } else {
                $operation_business = 1;
                $business = json_encode([
                    'profit_loss_type' => 1,
                    'gross_business_income' => $question['income_net_profit'] ?? 0,
                    'total_profit_loss' => $question['income_net_profit'] ?? 0
                ]);
            }
            $debtorincome = [
                'client_id' => $user->id,
                'debtor_gross_wages' => $debtor_gross_wages,
                'often_get_paid' => $oftengetpaid,
                'debtor_gross_wages_month' => $grosswages,
                'retirement_income' => 1,
                'social_security' => (!empty($question['ss_income']) ? 1 : 0),
                'social_security_month' => json_encode([1 => $question['ss_income'] ?? 0]),
                'retirement_income_month' => json_encode([1 => $question['income_rpmo'] ?? 0]),
                'other_sources' => 1,
                'other_options_income' => $question['income_notes'] ?? '',
                'other_sources_month' => json_encode([1 => $question['income_other_income'] ?? 0]),
                'operation_business' => $operation_business,
                'income_profit_loss' => $business
            ];


            if (!empty($debtor_income_data)) {

                if (Helper::validate_key_value("debtor_gross_wages", $debtor_income_data, 'radio') == 1) {
                    \App\Models\IncomeDebtorEmployer::create([
                        'client_id' => $user->id,
                        'current_employed' => 1,
                        'created_on' => $dateTime,
                        'updated_on' => $dateTime,
                    ]);
                    \App\Models\AttorneyEmployerInformationToClient::create([
                        'employer_name' => Helper::validate_key_value('debtor_job_title', $question),
                        'employer_type' => 1,
                        'client_type' => 1,
                        'client_id' => $user->id,
                        'attorney_id' => $question['attorney_id'] ?? null,
                        'created_on' => $dateTime,
                        'updated_on' => $dateTime,
                    ]);
                }

                $income_profit_loss = self::getIncomeProfitLossData($question, $debtor_income_data, 1, !empty($codebtor_income_data));

                $debtorincome = [
                    'client_id' => $user->id,
                    // Are you currently employed:
                    'debtor_gross_wages' => (isset($debtor_income_data['debtor_gross_wages']) && !empty($debtor_income_data['debtor_gross_wages'])) ? 1 : 0,
                    'debtor_gross_wages_month' => json_encode([1 => Helper::validate_key_value('debtor_gross_wages_month', $debtor_income_data)]),
                    // Have you had any Self Employment Income:
                    'operation_business' => (isset($debtor_income_data['self_employment_inc_debtor']) && !empty($debtor_income_data['self_employment_inc_debtor'])) ? 1 : 0,
                    'profit_loss_business_name' => Helper::validate_key_value('debtor_bussiness_name', $question),
                    'income_profit_loss' => json_encode($income_profit_loss),
                    // Rent and other real property income:
                    'rent_real_property' => (isset($debtor_income_data['rental_inc_debtor']) && !empty($debtor_income_data['rental_inc_debtor'])) ? 1 : 0,
                    'same_rent_income' => (isset($debtor_income_data['rental_inc_debtor']) && ($debtor_income_data['rental_inc_debtor']) == 1) ? 1 : '',
                    'rent_real_property_month' => json_encode([1 => Helper::validate_key_value('rental_inc_amt_debtor', $debtor_income_data)]),
                    // Interest, dividends, and royalties:
                    'royalties' => (isset($debtor_income_data['royality_inc_debtor']) && !empty($debtor_income_data['royality_inc_debtor'])) ? 1 : 0,
                    'same_royalty_income' => (isset($debtor_income_data['royality_inc_debtor']) && ($debtor_income_data['royality_inc_debtor']) == 1) ? 1 : '',
                    'royalties_month' => json_encode([1 => Helper::validate_key_value('royality_inc_amt_debtor', $debtor_income_data)]),
                    // Pension and retirement income (NOT Social Security) (Retirement Income):
                    'retirement_income' => (isset($debtor_income_data['retirement_inc_debtor']) && !empty($debtor_income_data['retirement_inc_debtor'])) ? 1 : 0,
                    'same_retirement_income' => (isset($debtor_income_data['retirement_inc_debtor']) && ($debtor_income_data['retirement_inc_debtor']) == 1) ? 1 : '',
                    'retirement_income_month' => json_encode([1 => Helper::validate_key_value('retirement_inc_amt_debtor', $debtor_income_data)]),
                    // Regular contributions from others to the household expenses, including child support:
                    'regular_contributions' => (isset($debtor_income_data['regular_contributions_inc_debtor']) && !empty($debtor_income_data['regular_contributions_inc_debtor'])) ? 1 : 0,
                    'same_regular_contribution_income' => (isset($debtor_income_data['regular_contributions_inc_debtor']) && ($debtor_income_data['regular_contributions_inc_debtor']) == 1) ? 1 : '',
                    'regular_contributions_month' => json_encode([1 => Helper::validate_key_value('regular_contributions_inc_amt_debtor', $debtor_income_data)]),
                    // Unemployment Compensation:
                    'unemployment_compensation' => (isset($debtor_income_data['unemployment_compensation_inc_debtor']) && !empty($debtor_income_data['unemployment_compensation_inc_debtor'])) ? 1 : 0,
                    'same_unemployement_compensation_income' => (isset($debtor_income_data['unemployment_compensation_inc_debtor']) && ($debtor_income_data['unemployment_compensation_inc_debtor']) == 1) ? 1 : '',
                    'unemployment_compensation_month' => json_encode([1 => Helper::validate_key_value('unemployment_compensation_inc_amt_debtor', $debtor_income_data)]),
                    // Social Security income. (SSI Income):
                    'social_security' => (isset($debtor_income_data['social_security_inc_debtor']) && !empty($debtor_income_data['social_security_inc_debtor'])) ? 1 : 0,
                    'same_social_security_income' => (isset($debtor_income_data['social_security_inc_debtor']) && ($debtor_income_data['social_security_inc_debtor']) == 1) ? 1 : '',
                    'social_security_month' => json_encode([1 => Helper::validate_key_value('social_security_inc_amt_debtor', $debtor_income_data)]),
                    // Other government assistance you receive regularly:
                    'government_assistance' => (isset($debtor_income_data['government_assistance_inc_debtor']) && !empty($debtor_income_data['government_assistance_inc_debtor'])) ? 1 : 0,
                    'same_government_assistance_income' => (isset($debtor_income_data['government_assistance_inc_debtor']) && ($debtor_income_data['government_assistance_inc_debtor']) == 1) ? 1 : '',
                    'government_assistance_month' => json_encode([1 => Helper::validate_key_value('government_assistance_inc_amt_debtor', $debtor_income_data)]),
                    // Other sources of income not already mentioned:
                    'other_sources' => (isset($debtor_income_data['other_sources_inc_debtor']) && !empty($debtor_income_data['other_sources_inc_debtor'])) ? 1 : 0,
                    'same_other_sources_income' => (isset($debtor_income_data['other_sources_inc_debtor']) && ($debtor_income_data['other_sources_inc_debtor']) == 1) ? 1 : '',
                    'other_sources_month' => json_encode([1 => Helper::validate_key_value('other_sources_inc_amt_debtor', $debtor_income_data)]),
                ];
            }

            \App\Models\IncomeDebtorMonthlyIncome::updateOrCreate(['client_id' => $user->id], $debtorincome);

            Log::info('OnePageQuestionnaireRequest@importClientData: Debtor income data created', [
                'user_id' => $user->id
            ]);

            // Import Property/Residence Data
            $redidence = [
                'loan_own_type_property' => 0,
                'home_car_loan' => '',
                'home_car_loan2' => '',
                'home_car_loan3' => '',
                'currently_lived' => 0,
            ];

            if (isset($question['rent_or_own']) && $question['rent_or_own'] == 1) {
                $loanYesNo = 1;
                if (isset($question['loan_on_property']) && $question['loan_on_property'] == 1) {
                    $loanYesNo = 0;
                }

                $property_own_json = Helper::validate_key_value('property_own_data', $question);
                $property_own_data = !empty($property_own_json) ? json_decode($property_own_json, true) : [];

                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('OnePageQuestionnaireRequest@importClientData: Invalid property_own_data JSON', [
                        'user_id' => $user->id,
                        'json_error' => json_last_error_msg()
                    ]);
                    $property_own_data = [];
                }
                $not_primary_address = Helper::validate_key_value('not_primary_address', $property_own_data, 'radio');
                $property_address = Helper::validate_key_value('property_address', $property_own_data);
                $property_city = Helper::validate_key_value('property_city', $property_own_data);
                $property_state = Helper::validate_key_value('property_state', $property_own_data);
                $property_zip = Helper::validate_key_value('property_zip', $property_own_data);
                $property_county = Helper::validate_key_value('property_county', $property_own_data);
                $property_type = Helper::validate_key_value('property_type', $property_own_data, 'radio');
                $property_bedrooms = Helper::validate_key_value('property_bedrooms', $property_own_data);
                $property_bathrooms = Helper::validate_key_value('property_bathrooms', $property_own_data);
                $property_home_sq_ft = Helper::validate_key_value('property_home_sq_ft', $property_own_data);
                $property_lot_size_acres = Helper::validate_key_value('property_lot_size_acres', $property_own_data);
                $property_owned_by = Helper::validate_key_value('property_owned_by', $property_own_data, 'radio');
                $property_other_name = Helper::validate_key_value('property_other_name', $property_own_data);
                $redidence = [
                    'loan_own_type_property' => $loanYesNo,
                    'home_car_loan' => json_encode([
                        'amount_own' => $question['mortgage_amount_owned_1'] ?? '',
                        'due_payment' => $question['mortgage_past_payment_1'] ?? '',
                        'monthly_payment' => $question['mortgage_own_1'] ?? '',
                        'creditor_name' => $question['mortgages_creditor_name_1'] ?? '',
                        'creditor_name_addresss' => $question['mortgages_creditor_address_1'] ?? '',
                        'creditor_city' => $question['mortgages_creditor_city_1'] ?? '',
                        'creditor_state' => $question['mortgages_creditor_state_1'] ?? '',
                        'creditor_zip' => $question['mortgages_creditor_zipcode_1'] ?? '',
                        'debt_owned_by' => $property_owned_by
                    ]),
                    'property_other_name' => $property_other_name
                ];

                if (isset($question['mortgage_additional_loans']) && $question['mortgage_additional_loans'] == 1) {
                    $redidence['home_car_loan2'] = json_encode([
                        'additional_loan1' => 1,
                        'amount_own' => $question['mortgage_amount_owned_2'] ?? '',
                        'due_payment' => $question['mortgage_past_payment_2'] ?? '',
                        'monthly_payment' => $question['mortgage_own_2'] ?? '',
                        'creditor_name' => $question['mortgages_creditor_name_2'] ?? '',
                        'creditor_name_addresss' => $question['mortgages_creditor_address_2'] ?? '',
                        'creditor_city' => $question['mortgages_creditor_city_2'] ?? '',
                        'creditor_state' => $question['mortgages_creditor_state_2'] ?? '',
                        'creditor_zip' => $question['mortgages_creditor_zipcode_2'] ?? ''
                    ]);
                }

                if (isset($question['mortgage_additional_loans_2']) && $question['mortgage_additional_loans_2'] == 1) {
                    $redidence['home_car_loan3'] = json_encode([
                        'additional_loan2' => 1,
                        'amount_own' => $question['mortgage_amount_owned_3'] ?? '',
                        'due_payment' => $question['mortgage_past_payment_3'] ?? '',
                        'monthly_payment' => $question['mortgage_own_3'] ?? '',
                        'creditor_name' => $question['mortgages_creditor_name_3'] ?? '',
                        'creditor_name_addresss' => $question['mortgages_creditor_address_3'] ?? '',
                        'creditor_city' => $question['mortgages_creditor_city_3'] ?? '',
                        'creditor_state' => $question['mortgages_creditor_state_3'] ?? '',
                        'creditor_zip' => $question['mortgages_creditor_zipcode_3'] ?? ''
                    ]);
                }
                $redidence['currently_lived'] = 1;
                $redidence['estimated_property_value'] = $question['mortgage_property_value_1'] ?? '';

                $redidence['not_primary_address'] = $not_primary_address;
                $redidence['mortgage_address'] = $property_address;
                $redidence['mortgage_city'] = $property_city;
                $redidence['mortgage_state'] = $property_state;
                $redidence['mortgage_zip'] = $property_zip;
                $redidence['mortgage_county'] = $property_county;
                $redidence['property'] = $property_type;

                $property_description = [];
                if (!empty($property_bedrooms)) {
                    $property_description['bedroom'] = $property_bedrooms;
                }
                if (!empty($property_bathrooms)) {
                    $property_description['bathroom'] = $property_bathrooms;
                }
                if (!empty($property_home_sq_ft)) {
                    $property_description['home_sq_ft'] = $property_home_sq_ft;
                }
                if (!empty($property_lot_size_acres)) {
                    $property_description['lot_size_acres'] = $property_lot_size_acres;
                }
                $redidence['property_description'] = json_encode($property_description);
            }


            $propertyRecord = \App\Models\ClientsPropertyResident::updateOrCreate(['client_id' => $user->id], $redidence);

            $propertyRecordId = $propertyRecord->id;

            Log::info('OnePageQuestionnaireRequest@importClientData: Property residence data created', [
                'user_id' => $user->id,
                'property_record_id' => $propertyRecordId,
                'rent_or_own' => $question['rent_or_own'] ?? null
            ]);

            // Handle property documents from S3
            if (!empty($sessionId) && isset($question['rent_or_own']) && $question['rent_or_own'] == 1) {
                try {
                    $mortgagePropertyAddress = null;
                    if ($not_primary_address == 1) {
                        $mortgagePropertyAddress = $question['Address'] ?? '';
                        $mortgagePropertyAddress .= isset($question['City']) && $question['City'] ? ', ' . $question['City'] : '';
                        $mortgagePropertyAddress .= isset($question['state']) && $question['state'] ? ', ' . $question['state'] : '';
                        $mortgagePropertyAddress .= isset($question['zip']) && $question['zip'] ? ', ' . $question['zip'] : '';
                    } else {
                        $mortgagePropertyAddress = $property_address;
                        $mortgagePropertyAddress .= $property_city ? ', ' . $property_city : '';
                        $mortgagePropertyAddress .= $property_state ? ', ' . $property_state : '';
                        $mortgagePropertyAddress .= $property_zip ? ', ' . $property_zip : '';
                    }

                    $address_as_dir = DocumentHelper::sanitizeDirectoryName($mortgagePropertyAddress);
                    $s3storePath = 'intake_form_residence_value/' . $sessionId . '/' . $address_as_dir;
                    if (Storage::disk('s3')->exists($s3storePath)) {
                        $files = Storage::disk('s3')->files($s3storePath);
                        if (!empty($files)) {
                            Log::info('OnePageQuestionnaireRequest@importClientData: Processing property documents', [
                                'user_id' => $user->id,
                                'file_count' => count($files),
                                'property_address' => $mortgagePropertyAddress
                            ]);

                            self::processPropertyDocuments($files, $user->id, $requestId, $mortgagePropertyAddress, $propertyRecordId);
                        }
                    }
                } catch (\Exception $e) {
                    Log::error('OnePageQuestionnaireRequest@importClientData: Failed to process property documents', [
                        'user_id' => $user->id,
                        'error' => $e->getMessage()
                    ]);
                    // Continue with import even if documents fail
                }
            }

            // Import Vehicle Data
            Log::info('OnePageQuestionnaireRequest@importClientData: Starting vehicle import', [
                'user_id' => $user->id
            ]);

            ClientsPropertyVehicle::where(['client_id' => $user->id])->delete();

            if (isset($question['vehicle_details']) && !empty($question['vehicle_details'])) {
                $vehicleDetails = json_decode($question['vehicle_details'], true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('OnePageQuestionnaireRequest@importClientData: Invalid vehicle_details JSON', [
                        'user_id' => $user->id,
                        'json_error' => json_last_error_msg()
                    ]);
                } elseif (is_array($vehicleDetails)) {
                    foreach ($vehicleDetails as $index => $car) {
                        try {
                            Log::info('OnePageQuestionnaireRequest@importClientData: Processing vehicle', [
                                'user_id' => $user->id,
                                'vehicle_index' => $index,
                                'vehicle_details' => $car
                            ]);

                            $carLoanYesNo = 1;
                            $car_loan_own_type_property = $car['loan_own_type_property'] ?? '';
                            if ($car_loan_own_type_property == 1) {
                                $carLoanYesNo = 0;
                            }

                            $cloan = [
                                'loan_own_type_property' => $carLoanYesNo,
                                'client_id' => $user->id,
                                'own_any_property' => 1,
                                "property_type" => $car['property_type'] ?? 1,
                                "property_estimated_value" => $car['property_estimated_value'] ?? '',
                                "property_year" => $car['property_year'] ?? '',
                                "property_make" => $car['property_make'] ?? '',
                                "property_model" => $car['property_model'] ?? '',
                                "property_mileage" => $car['property_mileage'] ?? '',
                                "property_other_info" => $car['property_other_info'] ?? '',
                                "vehicle_car_loan" => $car['vehicle_car_loan'] ?? ''
                            ];

                            $vehicleRecord = ClientsPropertyVehicle::create($cloan);
                            $vehicleRecordId = $vehicleRecord->id;

                            // Check for vehicle documents in S3
                            try {
                                $vehicleDocumentPath = "intakeForm/{$requestId}/vehicle/{$index}/";

                                if (Storage::disk('s3')->exists($vehicleDocumentPath)) {
                                    $files = Storage::disk('s3')->files($vehicleDocumentPath);
                                    if (!empty($files)) {
                                        self::processVehicleDocuments($files, $user->id, $requestId, $index, $vehicleRecordId, $car);
                                    }
                                }
                            } catch (\Exception $e) {
                                Log::error('OnePageQuestionnaireRequest@importClientData: Failed to process vehicle documents', [
                                    'user_id' => $user->id,
                                    'vehicle_index' => $index,
                                    'error' => $e->getMessage()
                                ]);
                                // Continue processing other vehicles
                            }

                            Log::info('OnePageQuestionnaireRequest@importClientData: Vehicle created', [
                                'user_id' => $user->id,
                                'vehicle_index' => $index,
                                'vehicle_record_id' => $vehicleRecordId
                            ]);
                        } catch (\Exception $e) {
                            Log::error('OnePageQuestionnaireRequest@importClientData: Failed to process vehicle', [
                                'user_id' => $user->id,
                                'vehicle_index' => $index,
                                'error' => $e->getMessage()
                            ]);
                            // Continue with next vehicle
                        }
                    }
                }
            }

            Log::info('OnePageQuestionnaireRequest@importClientData: All vehicles processed', [
                'user_id' => $user->id,
                'vehicle_count' => isset($question['vehicle_details']) && !empty($question['vehicle_details']) ? count(json_decode($question['vehicle_details'], true)) : 0
            ]);

            // Import Expense Data
            $expense = [];

            if (isset($question['rent_or_own']) && $question['rent_or_own'] != 1) {
                $expense['client_id'] = $user->id;
                $expense['rent_home_mortage'] = $question['mortgage_rent_1'] ?? '';
            }
            if (isset($question['rent_or_own']) && $question['rent_or_own'] == 1) {
                $expense['client_id'] = $user->id;
                $expense['rent_home_mortage'] = $question['mortgage_own_1'] ?? '';
            }

            if (!empty($expense)) {
                \App\Models\Expenses::updateOrCreate(['client_id' => $user->id], $expense);

                Log::info('OnePageQuestionnaireRequest@importClientData: Expense data created', [
                    'user_id' => $user->id
                ]);
            }

            // Import Debts/Tax Data
            $debts = [];

            if (isset($question['taxes_internal_revenue_year']) && $question['taxes_internal_revenue_year'] != '') {
                $debts['tax_owned_irs'] = 1;
                $debts['tax_irs_total_due'] = $question['taxes_irs_taxes_due'] ?? '';
                $debts['tax_irs_whats_year'] = $question['taxes_internal_revenue_year'];
            }

            if (isset($question['taxes_franchise_tax_board']) && $question['taxes_franchise_tax_board'] != '') {
                $debts['tax_owned_state'] = 1;
                $debts['back_tax_own'] = json_encode([
                    [
                        'debt_state' => $question['taxes_tax_state'] ?? '',
                        'tax_whats_year' => $question['taxes_franchise_tax_board'],
                        'tax_total_due' => $question['taxes_state_tax_due'] ?? ''
                    ]
                ]);
            }

            if (isset($question['child_supp_or_alimony']) && $question['child_supp_or_alimony'] == 0) {
                $alomeny = Helper::validate_key_value('taxes_child_support_due', $question, 'float') + Helper::validate_key_value('taxes_alimony_due', $question, 'float');
                $debts['checkinputdebt'] = 1;
                $debts['domestic_support'] = 1;
                $debts['domestic_tax'] = json_encode([
                    [
                        'domestic_support_monthlypay' => $alomeny,
                        'domestic_address_state' => $question['taxes_child_support_state'] ?? ''
                    ]
                ]);
                $debts['creditor_state'] = $question['taxes_child_support_state'] ?? '';
            }

            if (isset($question['additional_liens']) && $question['additional_liens'] == 1) {
                $debts['additional_liens'] = $question['additional_liens'];
                $debts['additional_liens_data'] = $question['additional_liens_data'] ?? '';
            }

            if (!empty($debts)) {
                \App\Models\DebtsTax::updateOrCreate(['client_id' => $user->id], $debts);

                Log::info('OnePageQuestionnaireRequest@importClientData: Debt/tax data created', [
                    'user_id' => $user->id
                ]);
            }

            OnePageQuestionnaireRequest::where('id', $requestId)->update(['is_imported' => 1]);

            // Commit transaction
            DB::commit();

            Log::info('OnePageQuestionnaireRequest@importClientData: Import completed successfully', [
                'user_id' => $user->id,
                'questionnaire_request_id' => $requestId
            ]);

            return ['success' => true, 'message' => 'Client data imported successfully', 'user_id' => $user->id];

        } catch (\Exception $e) {
            // Rollback transaction on any error
            DB::rollBack();

            Log::error('OnePageQuestionnaireRequest@importClientData: Import failed with exception', [
                'questionnaire_request_id' => $requestId,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public static function dataToSaveArrayStepWise($input, $attorney_id, $stepNo)
    {

        switch ($stepNo) {
            case 1:
                $dataToSave = self::getStep1Data($input);
                break;

            case 2:
                $dataToSave = self::getStep2Data($input);
                break;

            case 3:
                $dataToSave = self::getStep3Data($input);
                break;

        }

        if (!empty($dataToSave) && is_array($dataToSave)) {
            $dataToSave = self::removeCommaFromData($dataToSave);
        }
        $dataToSave['attorney_id'] = $attorney_id;
        $dataToSave['step_completed'] = $stepNo;
        $dataToSave['is_imported'] = '';

        return $dataToSave;
    }

    private static function getIncomeProfitLossData($question, $income_data, $isDebtor, $hasCodebtor)
    {
        $income_profit_loss = [];

        if (
            isset($income_data['debtor_gross_wages']) && !empty($income_data['debtor_gross_wages']) && $income_data['debtor_gross_wages'] == 1 ||
            isset($income_data['joints_debtor_gross_wages']) && !empty($income_data['joints_debtor_gross_wages']) && $income_data['joints_debtor_gross_wages'] == 1
        ) {
            if ($isDebtor == 1) {
                // Extract business name and income from question
                $debtor_bussiness_name = Helper::validate_key_value('debtor_bussiness_name', $question);
                $income_net_profit = Helper::validate_key_value('income_net_profit', $income_data);
            }
            if ($isDebtor == 2) {
                $debtor_bussiness_name = Helper::validate_key_value('spouse_bussiness_name', $question);
                $income_net_profit = Helper::validate_key_value('income_net_profit_spouse', $income_data);
            }


            // Get debtor names for signatures
            $debtor1_name = trim(Helper::validate_key_value('name', $question) . ' ' .
                Helper::validate_key_value('middle_name', $question) . ' ' .
                Helper::validate_key_value('last_name', $question));

            // Check if spouse exists (married joint)
            $codebtor_name = '';
            if (!empty($question['spouse_name']) && $hasCodebtor) {
                $codebtor_name = trim(Helper::validate_key_value('spouse_name', $question) . ' ' .
                    Helper::validate_key_value('spouse_middle_name', $question) . ' ' .
                    Helper::validate_key_value('spouse_last_name', $question));
            }

            // Current date for signatures
            $current_date = date('m/d/Y');

            // Generate last 6 months in format "n-Y" (month-year without leading zero)
            foreach (range(1, 6) as $val) {
                $month_year = date("n-Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")));

                $income_profit_loss[] = [
                    'profit_loss_type' => '2',
                    'name_of_business' => $debtor_bussiness_name,
                    'profit_loss_month' => $month_year,
                    'gross_business_income' => number_format((float) $income_net_profit, 2, '.', ''),
                    'cost_of_goods_sold' => '0.00',
                    'advertising_expense' => '0.00',
                    'subcontractor_pay' => '0.00',
                    'professional_service' => '0.00',
                    'cc_expense' => '0.00',
                    'equipment_rental_expense' => '0.00',
                    'insurance_expense' => '0.00',
                    'licenses_expense' => '0.00',
                    'office_supplies_expense' => '0.00',
                    'postage_expense' => '0.00',
                    'rent_office_expense' => '0.00',
                    'bank_fee_and_interest' => '0.00',
                    'software_and_subscription' => '0.00',
                    'supplies_material_expense' => '0.00',
                    'travel_expense' => '0.00',
                    'utility_expense' => '0.00',
                    'vehicle_expense' => '0.00',
                    'other_expense_name1' => 'Other Expense 1',
                    'other_1' => '0.00',
                    'other_expense_name2' => 'Other Expense 2',
                    'other_2' => '0.00',
                    'other_expense_name3' => 'Other Expense 3',
                    'other_3' => '0.00',
                    'other_expense_name4' => null,
                    'other_4' => '0.00',
                    'total_expense' => '0.00',
                    'total_profit_loss' => number_format((float) $income_net_profit, 2, '.', ''),
                    'debtor1_sign' => $debtor1_name,
                    'debtor1_sign_date' => $current_date,
                    'debtor2_sign' => $codebtor_name,
                    'debtor2_sign_date' => $current_date
                ];
            }

        }

        return $income_profit_loss;
    }

    private static function getStep1Data($input)
    {
        $data = $input->all() ?? [];
        if (empty($data)) {
            return [];
        }
        unset($data['_token']);
        unset($data['a_token']);
        unset($data['consent']);
        $data['has_security_number'] = '';
        $data['itin'] = '';
        $data['spouse_has_security_number'] = '';
        $data['spouse_itin'] = '';
        $data['any_bankruptcy_filed_before_data'] = json_encode($input->any_bankruptcy_filed_before_data ?? []);
        $data['emergency_check'] = json_encode($input->emergency_check ?? []);
        $data['find_us'] = json_encode($input->find_us ?? []);
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");

        return $data;
    }

    private static function getStep2Data($input)
    {
        $data = $input->all() ?? [];
        if (empty($data)) {
            return [];
        }
        unset($data['_token']);
        unset($data['a_token']);
        unset($data['consent']);
        unset($data['property_vehicle']);
        unset($data['debtor_gross_wages']);
        unset($data['debtor_gross_wages_month']);
        unset($data['other_inc_debtor']);
        unset($data['self_employment_inc_debtor']);
        unset($data['income_net_profit']);
        unset($data['rental_inc_debtor']);
        unset($data['rental_inc_amt_debtor']);
        unset($data['royality_inc_debtor']);
        unset($data['royality_inc_amt_debtor']);
        unset($data['retirement_inc_debtor']);
        unset($data['retirement_inc_amt_debtor']);
        unset($data['regular_contributions_inc_debtor']);
        unset($data['regular_contributions_inc_amt_debtor']);
        unset($data['unemployment_compensation_inc_debtor']);
        unset($data['unemployment_compensation_inc_amt_debtor']);
        unset($data['social_security_inc_debtor']);
        unset($data['social_security_inc_amt_debtor']);
        unset($data['government_assistance_inc_debtor']);
        unset($data['government_assistance_inc_amt_debtor']);
        unset($data['other_sources_inc_debtor']);
        unset($data['other_sources_inc_amt_debtor']);
        unset($data['joints_debtor_gross_wages']);
        unset($data['joints_debtor_gross_wages_month']);
        unset($data['self_employment_inc_spouse']);
        unset($data['income_net_profit_spouse']);
        unset($data['rental_inc_spouse']);
        unset($data['rental_inc_amt_spouse']);
        unset($data['royality_inc_spouse']);
        unset($data['royality_inc_amt_spouse']);
        unset($data['retirement_inc_spouse']);
        unset($data['retirement_inc_amt_spouse']);
        unset($data['regular_contributions_inc_spouse']);
        unset($data['regular_contributions_inc_amt_spouse']);
        unset($data['unemployment_compensation_inc_spouse']);
        unset($data['unemployment_compensation_inc_amt_spouse']);
        unset($data['social_security_inc_spouse']);
        unset($data['social_security_inc_amt_spouse']);
        unset($data['government_assistance_inc_spouse']);
        unset($data['government_assistance_inc_amt_spouse']);
        unset($data['other_sources_inc_spouse']);
        unset($data['other_sources_inc_amt_spouse']);
        $data['updated_at'] = date("Y-m-d H:i:s");
        $property_vehicle_final = [];
        $property_vehicle_final = self::updatePropertyVehicle($input, $property_vehicle_final);
        $property_vehicle_final = self::updatePropertyVehicleCarLoan($input, $property_vehicle_final);
        $data['vehicle_details'] = json_encode($property_vehicle_final);

        $debtor_income_data = self::getIncomeData($input, 1);
        $codebtor_income_data = self::getIncomeData($input, 2);
        $data['debtor_income_data'] = json_encode($debtor_income_data);
        $data['codebtor_income_data'] = json_encode($codebtor_income_data);
        $data['property_own_data'] = json_encode($data['property_own_data']);

        return $data;
    }

    private static function getStep3Data($input)
    {
        $data = $input->all() ?? [];
        if (empty($data)) {
            return [];
        }
        unset($data['_token']);
        unset($data['a_token']);
        unset($data['consent']);

        $additional_liens_data = [];
        $additional_liens_data = self::getAdditionalLiensData($input, $additional_liens_data);
        $data['additional_liens_data'] = json_encode($additional_liens_data);
        $data['concierge_question'] = json_encode($input->concierge_question);
        $data['updated_at'] = date("Y-m-d H:i:s");

        return $data;
    }

    private static function removeCommaFromData($data)
    {
        foreach ($data as $key => $value) {
            if (in_array($key, ['income_avg_paycheck', 'income_spouse_avg_paycheck', 'income_rpmo', 'income_net_profit', 'income_other_income', 'mortgage_rent_1', 'mortgage_own_1', 'mortgage_past_payment_1', 'mortgage_amount_owned_1', 'mortgage_property_value_1', 'mortgage_rent_2', 'mortgage_own_2', 'mortgage_past_payment_2', 'mortgage_amount_owned_2', 'mortgage_rent_3', 'mortgage_own_3', 'mortgage_past_payment_3', 'mortgage_amount_owned_3', 'taxes_irs_taxes_due', 'taxes_state_tax_due', 'taxes_child_support_due', 'taxes_alimony_due', 'credit_crd_debt', 'medical_debt', 'student_loans', 'law_suit', 'personal_loans', 'credit_union_loans', 'family_loans', 'income_net_profit_spouse', 'ss_income', 'misc_loans'])) {
                $data[$key] = str_replace(',', '', $value);
            }
        }

        return $data;
    }


    private static function updatePropertyVehicle($input, $property_vehicle_final)
    {
        if (!empty($input['property_vehicle'])) {
            foreach ($input['property_vehicle'] as $key => $values) {
                $i = 0;
                if ($key == "vehicle_car_loan" || $key == "vehicle_property_value_document") {
                    continue;
                }
                foreach ($values as $val) {
                    if ($key == 'property_estimated_value') {
                        $val = str_replace(',', '', $val);
                    }
                    $property_vehicle_final[$i][$key] = (isset($val)) ? $val : "";
                    $i++;
                }
            }
        }

        return $property_vehicle_final;
    }


    private static function updatePropertyVehicleCarLoan($input, $property_vehicle_final)
    {
        $vehicle_car_loan_final = [];
        if (!empty($input['property_vehicle']['vehicle_car_loan'])) {
            foreach ($input['property_vehicle']['vehicle_car_loan'] as $key => $values) {
                $i = 0;
                foreach ($values as $val) {
                    if ($key == 'monthly_payment' || $key == 'past_due_amount' || $key == 'amount_own') {
                        $val = str_replace(',', '', $val);
                    }
                    $vehicle_car_loan_final[$i][$key] = (isset($val)) ? $val : "";
                    $property_vehicle_final[$i]['vehicle_car_loan'] = json_encode($vehicle_car_loan_final[$i]);
                    $i++;
                }
            }
        }

        return $property_vehicle_final;
    }

    private static function getAdditionalLiensData($input, $additional_liens_data)
    {
        if (!empty($input['additional_liens_data'])) {
            foreach ($input['additional_liens_data'] as $key => $values) {
                $i = 0;
                foreach ($values as $val) {
                    if (!empty($val)) {
                        if (in_array($key, ['additional_liens_due', 'monthly_payment'])) {
                            $val = str_replace(',', '', $val);
                        }
                        $additional_liens_data[$i][$key] = (isset($val)) ? $val : "";
                    }
                    $i++;
                }
            }
        }

        return $additional_liens_data;
    }

    private static function getIncomeData($input, $debtor)
    {
        $income_data = [];
        $debtorInputs = self::getDebtorInputs($debtor);
        if (!empty($debtorInputs)) {
            foreach ($debtorInputs as $index => $key) {
                $income_data[$key] = isset($input[$key]) ? str_replace(',', '', $input[$key]) : '';
            }
        }

        return $income_data;
    }

    private static function getDebtorInputs($debtor)
    {
        $inputs = [];
        if ($debtor == 1) {
            $inputs = [
                'debtor_gross_wages',
                'debtor_gross_wages_month',
                'other_inc_debtor',
                'self_employment_inc_debtor',
                'income_net_profit',
                'rental_inc_debtor',
                'rental_inc_amt_debtor',
                'royality_inc_debtor',
                'royality_inc_amt_debtor',
                'retirement_inc_debtor',
                'retirement_inc_amt_debtor',
                'regular_contributions_inc_debtor',
                'regular_contributions_inc_amt_debtor',
                'unemployment_compensation_inc_debtor',
                'unemployment_compensation_inc_amt_debtor',
                'social_security_inc_debtor',
                'social_security_inc_amt_debtor',
                'government_assistance_inc_debtor',
                'government_assistance_inc_amt_debtor',
                'other_sources_inc_debtor',
                'other_sources_inc_amt_debtor'
            ];
        }
        if ($debtor == 2) {
            $inputs = [
                'joints_debtor_gross_wages',
                'joints_debtor_gross_wages_month',
                'self_employment_inc_spouse',
                'income_net_profit_spouse',
                'rental_inc_spouse',
                'rental_inc_amt_spouse',
                'royality_inc_spouse',
                'royality_inc_amt_spouse',
                'retirement_inc_spouse',
                'retirement_inc_amt_spouse',
                'regular_contributions_inc_spouse',
                'regular_contributions_inc_amt_spouse',
                'unemployment_compensation_inc_spouse',
                'unemployment_compensation_inc_amt_spouse',
                'social_security_inc_spouse',
                'social_security_inc_amt_spouse',
                'government_assistance_inc_spouse',
                'government_assistance_inc_amt_spouse',
                'other_sources_inc_spouse',
                'other_sources_inc_amt_spouse'
            ];
        }

        return $inputs;
    }

    public static function willSendMail($userId, $attorney_id, $stepNo)
    {
        $columnName = 'step_' . $stepNo . '_submited';
        $record = self::where('id', $userId)->where('attorney_id', $attorney_id)->select($columnName)->first();
        if (!empty($record) && $record->$columnName == 1) {
            return false;
        } else {
            return true;
        }
    }

    public static function dataToSaveArrayStepWiseForAttorney($input, $dataFor)
    {
        unset($input['_token']);
        unset($input['fOutMode']);
        unset($input['fIsAjax']);

        switch ($dataFor) {
            case 'debtor-basic-info':
                $input['any_bankruptcy_filed_before_data'] = json_encode($input['any_bankruptcy_filed_before_data'] ?? []);
                break;
            case 'emergency-info':
                $input['emergency_check'] = json_encode($input['emergency_check'] ?? []);
                break;
            case 'discover-us-info':
                $input['find_us'] = json_encode($input['find_us'] ?? []);
                break;
            case 'debtor-income-info':
                $incomeD1Data = self::getIncomeData($input, 1);
                unset($input['debtor_gross_wages']);
                unset($input['debtor_gross_wages_month']);
                unset($input['other_inc_debtor']);
                unset($input['self_employment_inc_debtor']);
                unset($input['income_net_profit']);
                unset($input['rental_inc_debtor']);
                unset($input['rental_inc_amt_debtor']);
                unset($input['royality_inc_debtor']);
                unset($input['royality_inc_amt_debtor']);
                unset($input['retirement_inc_debtor']);
                unset($input['retirement_inc_amt_debtor']);
                unset($input['regular_contributions_inc_debtor']);
                unset($input['regular_contributions_inc_amt_debtor']);
                unset($input['unemployment_compensation_inc_debtor']);
                unset($input['unemployment_compensation_inc_amt_debtor']);
                unset($input['social_security_inc_debtor']);
                unset($input['social_security_inc_amt_debtor']);
                unset($input['government_assistance_inc_debtor']);
                unset($input['government_assistance_inc_amt_debtor']);
                unset($input['other_sources_inc_debtor']);
                unset($input['other_sources_inc_amt_debtor']);
                $input['debtor_income_data'] = json_encode($incomeD1Data ?? []);

                break;
            case 'spouse-income-info':
                $incomeD2Data = self::getIncomeData($input, 2);
                unset($input['joints_debtor_gross_wages']);
                unset($input['joints_debtor_gross_wages_month']);
                unset($input['self_employment_inc_spouse']);
                unset($input['income_net_profit_spouse']);
                unset($input['rental_inc_spouse']);
                unset($input['rental_inc_amt_spouse']);
                unset($input['royality_inc_spouse']);
                unset($input['royality_inc_amt_spouse']);
                unset($input['retirement_inc_spouse']);
                unset($input['retirement_inc_amt_spouse']);
                unset($input['regular_contributions_inc_spouse']);
                unset($input['regular_contributions_inc_amt_spouse']);
                unset($input['unemployment_compensation_inc_spouse']);
                unset($input['unemployment_compensation_inc_amt_spouse']);
                unset($input['social_security_inc_spouse']);
                unset($input['social_security_inc_amt_spouse']);
                unset($input['government_assistance_inc_spouse']);
                unset($input['government_assistance_inc_amt_spouse']);
                unset($input['other_sources_inc_spouse']);
                unset($input['other_sources_inc_amt_spouse']);
                $input['codebtor_income_data'] = json_encode($incomeD2Data ?? []);
                break;
            case 'vehicles-info':
                $property_vehicle_final = self::updatePropertyVehicle($input, []);
                $property_vehicle_final = self::updatePropertyVehicleCarLoan($input, $property_vehicle_final);
                unset($input['property_vehicle']);
                $input['vehicle_details'] = json_encode($property_vehicle_final);
                break;
            case 'secured-loan-info':
                $additional_liens_data = [];
                $additional_liens_data = self::getAdditionalLiensData($input, $additional_liens_data);
                $input['additional_liens_data'] = json_encode($additional_liens_data);
                break;
            case 'attorney-ques-info':
                $input['concierge_question'] = json_encode($input['concierge_question']);
                break;
            default:
                break;
        }

        return $input;
    }

    public static function getReturnHtmlForAttorney($dataFor, $intakeFormId)
    {
        $details = OnePageQuestionnaireRequest::where('id', $intakeFormId)->first();
        $finalDetails = \App\Services\CreditorsService::calculateTax($details);
        $details = !empty($details) ? $details->toArray() : [];
        $concierge_question_details = json_decode($details['concierge_question'], 1) ?? [];
        $concierge_questions = [];
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!empty($concierge_question_details)) {
            foreach ($concierge_question_details as $index => $value) {
                $question = \App\Models\ConciergeAttorneyQuestions::where('attorney_id', $attorney_id)->where('id', $index)->first();
                $questionObject = ['question' => $question['question'], 'value' => $value];
                array_push($concierge_questions, $questionObject);
            }
        }

        $attQuestions = \App\Models\ConciergeAttorneyQuestions::where(['attorney_id' => $attorney_id, 'is_deleted' => '0'])->orderby('id', 'asc')->get();
        $attQuestions = !empty($attQuestions) ? $attQuestions->toArray() : [];

        $conditionalQuestions = \App\Models\ShortFormConditionalFields::where('attorney_id', $attorney_id)->first();
        $question_to_show = $conditionalQuestions['question_to_show'] ?? '';
        $question_to_show = !empty($question_to_show) ? json_decode($question_to_show, 1) : [];

        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->select(['short_name', 'district_name', 'id'])->get();

        $spouseClass = "hide-data";
        if ($details['martial_status'] == 1 || $details['martial_status'] == 2) {
            $spouseClass = "";
        }
        $debtor_income_data = Helper::validate_key_value('debtor_income_data', $details);
        $debtor_income_data = json_decode($debtor_income_data, 1);
        $codebtor_income_data = Helper::validate_key_value('codebtor_income_data', $details);
        $codebtor_income_data = json_decode($codebtor_income_data, 1);
        $showDebtorSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'debtor_ssn');
        $showDebtorDL = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'licence_or_id');
        $showSpouseSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'codebtor_ssn');
        $showEmergencySection = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'emergency_checks');
        $showDiscoverUsSection = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'discover_us');
        $intakeFormID = Helper::validate_key_value('id', $details, 'radio');

        $historyLog = IntakeFormUpdateLogs::where('form_id', $intakeFormId)->get();
        $historyLog = !empty($historyLog) ? $historyLog->toArray() : [];

        $view = '';

        switch ($dataFor) {
            case 'debtor-basic-info':
                $view = 'modal.attorney.client_intake_management.preview.basic_info_debtor';
                break;
            case 'marital-info':
                $view = 'modal.attorney.client_intake_management.preview.marital_status';
                break;
            case 'spouse-basic-info':
                $view = 'modal.attorney.client_intake_management.preview.basic_info_spouse';
                break;
            case 'emergency-info':
                $view = 'modal.attorney.client_intake_management.preview.emergency_checks';
                break;
            case 'discover-us-info':
                $view = 'modal.attorney.client_intake_management.preview.discover_us';
                break;
            case 'debtor-income-info':
                $view = 'modal.attorney.client_intake_management.preview.monthly_income_debtor';
                break;
            case 'spouse-income-info':
                $view = 'modal.attorney.client_intake_management.preview.monthly_income_spouse';
                break;
            case 'mortgage-info':
                $view = 'modal.attorney.client_intake_management.preview.mortgage';
                break;
            case 'vehicles-info':
                $view = 'modal.attorney.client_intake_management.preview.vehicles';
                break;
            case 'other-property-info':
                $view = 'modal.attorney.client_intake_management.preview.other_property';
                break;
            case 'secured-loan-info':
                $view = 'modal.attorney.client_intake_management.preview.secured_loan';
                break;
            case 'back-tax-info':
                $view = 'modal.attorney.client_intake_management.preview.back_tax';
                break;
            case 'other-debt-info':
                $view = 'modal.attorney.client_intake_management.preview.other_debt';
                break;
            case 'attorney-ques-info':
                $view = 'modal.attorney.client_intake_management.preview.att_que';
                break;

            default:
                break;
        }

        return view($view)
            ->with([
                'is_print' => 0,
                'historyLog' => $historyLog,
                'details' => $details,
                'finalDetails' => $finalDetails,
                'formData' => $finalDetails,
                'district_names' => $district_names,
                'concierge_questions' => $concierge_questions,
                'conditionalQuestions' => $question_to_show,
                'questions' => $attQuestions,
                'attorney_company' => $attorney_company,
                'spouseClass' => $spouseClass,
                'debtor_income_data' => $debtor_income_data,
                'codebtor_income_data' => $codebtor_income_data,
                'showDebtorSSN' => $showDebtorSSN,
                'showDebtorDL' => $showDebtorDL,
                'showSpouseSSN' => $showSpouseSSN,
                'showEmergencySection' => $showEmergencySection,
                'showDiscoverUsSection' => $showDiscoverUsSection,
                'intakeFormID' => $intakeFormID,
            ])
            ->render();

    }

    public static function getNotesForQuesId($quesId)
    {
        $notes = \App\Models\ShortFormNotes::where('questionnaire_id', $quesId)
            ->select([
                'id',
                'questionnaire_id',
                'attorney_id as added_by_id',
                'subject',
                'notes as note',
                'created_at',
                'updated_at',
            ])
            ->orderby('id', 'asc')
            ->get();

        return !empty($notes) ? $notes->toArray() : [];
    }

    public static function getSelectedSavedDataJSON($input, $intakeFormId, $dataFor)
    {
        $details = OnePageQuestionnaireRequest::where('id', $intakeFormId)->first();
        $details = !empty($details) ? $details->toArray() : [];

        $data = [];
        foreach ($input as $key => $value) {
            $data[$key] = isset($details[$key]) ? $details[$key] : '';
        }
        if ($dataFor == 'debtor-income-info') {
            $data['debtor_income_data'] = $details['debtor_income_data'];
        } elseif ($dataFor == 'spouse-income-info') {
            $data['codebtor_income_data'] = $details['codebtor_income_data'];
        } elseif ($dataFor == 'vehicles-info') {
            $data['vehicle_details'] = $details['vehicle_details'];
        }

        unset($data['_token']);
        unset($data['fOutMode']);
        unset($data['fIsAjax']);

        return json_encode($data);
    }

    private static function getUsedBusinessEinData($usedBussinessData, $question, $debtor, $value)
    {
        $result = !empty($usedBussinessData) ? json_decode($usedBussinessData, true) : [
            "own_business_name" => [],
            "type" => [],
            "own_business_selection" => [],
            "nature_of_business" => [],
            "business_still_open" => [],
            "property_value" => [],
        ];
        if ($debtor === 0) {
            $result["own_business_name"][] = Helper::validate_key_value('debtor_bussiness_name', $question);
            $result["type"][] = Helper::validate_key_value('debtor_bussiness_type', $question);
            $result["own_business_selection"][] = 0;
            $result["nature_of_business"][] = Helper::validate_key_value('debtor_bussiness_nature', $question);
            $result["business_still_open"][] = 1;
            $result["property_value"][] = $value;
        }
        if ($debtor === 1) {
            $result["own_business_name"][] = Helper::validate_key_value('spouse_bussiness_name', $question);
            $result["type"][] = Helper::validate_key_value('spouse_bussiness_type', $question);
            $result["own_business_selection"][] = 1;
            $result["nature_of_business"][] = Helper::validate_key_value('spouse_bussiness_nature', $question);
            $result["business_still_open"][] = 1;
            $result["property_value"][] = $value;
        }

        return json_encode($result);
    }

    private static function processVehicleDocuments($files, $clientId, $requestId, $vehicleIndex, $vehicleRecordId, $car)
    {
        $documentType = 'Autoloan_property_value_' . $vehicleRecordId;
        $documentName = 'Property Value For ' . $car['property_year'] . ' ' . $car['property_make'] . ' ' . $car['property_model'];

        foreach ($files as $file) {
            try {
                // Download the file from S3 to temporary location
                $tempFile = tempnam(sys_get_temp_dir(), 'vehicle_doc_');
                $fileContent = Storage::disk('s3')->get($file);
                file_put_contents($tempFile, $fileContent);

                // Create a fake UploadedFile object for storeClientSideDocument function
                $filename = basename($file);
                $originalExtension = pathinfo($filename, PATHINFO_EXTENSION);
                $mimeType = Storage::disk('s3')->mimeType($file) ?: 'application/octet-stream';

                $fakeUploadedFile = new \Illuminate\Http\UploadedFile(
                    $tempFile,
                    $filename,
                    $mimeType,
                    null,
                    true
                );


                // Use the existing storeClientSideDocument function
                $result = \App\Models\ClientDocumentUploaded::storeClientSideDocument(
                    $clientId,
                    $fakeUploadedFile,
                    $documentType,
                    $documentName,
                    1, // added_by_attorney (files from intake form are attorney-added)
                    0, // defaultStatus
                    $originalExtension,
                    false, // ignoreValidation
                    '', // document_month
                    '', // document_paystub_date
                    ''  // selected_debtor
                );

                // Clean up temp file
                unlink($tempFile);

                // Check if the result is successful
                if (is_numeric($result)) {
                    // Success - result is the document ID
                    Log::info("Successfully processed vehicle document", [
                        'original_file' => $file,
                        'document_id' => $result,
                        'client_id' => $clientId,
                        'vehicle_record_id' => $vehicleRecordId,
                        'vehicle_index' => $vehicleIndex
                    ]);
                } else {
                    // Error - result is an array with status and message
                    Log::error("Failed to process vehicle document", [
                        'original_file' => $file,
                        'error' => $result['message'] ?? 'Unknown error',
                        'client_id' => $clientId,
                        'vehicle_record_id' => $vehicleRecordId
                    ]);
                }

            } catch (\Exception $e) {
                Log::error("Exception processing vehicle document", [
                    'file' => $file,
                    'error' => $e->getMessage(),
                    'client_id' => $clientId,
                    'vehicle_record_id' => $vehicleRecordId
                ]);

                // Clean up temp file if it exists
                if (isset($tempFile) && file_exists($tempFile)) {
                    unlink($tempFile);
                }
            }
        }

        Log::info("Processed vehicle documents for client {$clientId}, request {$requestId}, vehicle {$vehicleIndex}", [
            'files_count' => count($files),
            'vehicle_record_id' => $vehicleRecordId,
            'files' => $files
        ]);
    }

    private static function processPropertyDocuments($files, $clientId, $requestId, $mortgagePropertyAddress, $propertyId)
    {
        $documentType = 'Mortgage_property_value_' . $propertyId;
        $documentName = 'Property Value For: ' . $mortgagePropertyAddress;

        foreach ($files as $file) {
            try {
                // Download the file from S3 to temporary location
                $tempFile = tempnam(sys_get_temp_dir(), 'property_doc_');
                $fileContent = Storage::disk('s3')->get($file);
                file_put_contents($tempFile, $fileContent);

                // Create a fake UploadedFile object for storeClientSideDocument function
                $filename = basename($file);
                $originalExtension = pathinfo($filename, PATHINFO_EXTENSION);
                $mimeType = Storage::disk('s3')->mimeType($file) ?: 'application/octet-stream';

                $fakeUploadedFile = new \Illuminate\Http\UploadedFile(
                    $tempFile,
                    $filename,
                    $mimeType,
                    null,
                    true
                );

                // Use the existing storeClientSideDocument function
                $result = \App\Models\ClientDocumentUploaded::storeClientSideDocument(
                    $clientId,
                    $fakeUploadedFile,
                    $documentType,
                    $documentName,
                    1, // added_by_attorney (files from intake form are attorney-added)
                    0, // defaultStatus
                    $originalExtension,
                    false, // ignoreValidation
                    '', // document_month
                    '', // document_paystub_date
                    ''  // selected_debtor
                );

                // Clean up temp file
                unlink($tempFile);

                // Check if the result is successful
                if (is_numeric($result)) {
                    // Success - result is the document ID
                    Log::info("Successfully processed property document", [
                        'original_file' => $file,
                        'document_id' => $result,
                        'client_id' => $clientId,
                        'property_address' => $mortgagePropertyAddress,
                        'request_id' => $requestId
                    ]);
                } else {
                    // Error - result is an array with status and message
                    Log::error("Failed to process property document", [
                        'original_file' => $file,
                        'error' => $result['message'] ?? 'Unknown error',
                        'client_id' => $clientId,
                        'property_address' => $mortgagePropertyAddress
                    ]);
                }

            } catch (\Exception $e) {
                Log::error("Exception processing property document", [
                    'file' => $file,
                    'error' => $e->getMessage(),
                    'client_id' => $clientId,
                    'property_address' => $mortgagePropertyAddress
                ]);

                // Clean up temp file if it exists
                if (isset($tempFile) && file_exists($tempFile)) {
                    unlink($tempFile);
                }
            }
        }

        Log::info("Processed property documents for client {$clientId}, request {$requestId}", [
            'files_count' => count($files),
            'property_address' => $mortgagePropertyAddress,
            'files' => $files
        ]);
    }


}
