<?php

namespace App\Http\Controllers;

use App\Models\OnePageQuestionnaireRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\OnePageQuesRequest;
use App\Mail\OnePageQuesRequestSuccessToClient;
use App\Models\AttorneySettings;
use App\Models\DocumentUploadedData;
use App\Models\User;
use App\Models\ZipCode;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OnePageQuestionnaireRequestController extends Controller
{
    public function questionnaire(Request $request)
    {
        $token = '';
        $questions = [];
        $district_names = [];
        $conditionalQuestions = [];
        $attorney_company = '';
        if ($request->has('token')) {
            $token = $request->input('token');
            // $attorney_id = Crypt::decryptString($token);
            try {
                $attorney_id = base64_decode($token);
            } catch (DecryptException $e) {
                return redirect()->back()->withInput($request->all())->with('error', 'Invalid token.');
            }
            $questions = \App\Models\ConciergeAttorneyQuestions::where(['attorney_id' => $attorney_id, 'is_deleted' => '0' ])->orderby('id', 'asc')->get();
            $questions = !empty($questions) ? $questions->toArray() : [];
            $checkedQuestions = \App\Models\ShortFormConditionalFields::where('attorney_id', $attorney_id)->first();
            $conditionalQuestions = $checkedQuestions['question_to_show'] ?? '';
            $conditionalQuestions = json_decode($conditionalQuestions, 1);
            $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->select(['company_logo', 'attorney_appointment_url', 'attorney_phone','attorney_review_url'])->first();
            $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->select(['short_name','district_name','id' ])->get();
        }

        return view('questionnaire', ['district_names' => $district_names, 'attorney_company' => $attorney_company, 'token' => $token, 'questions' => $questions, 'conditionalQuestions' => $conditionalQuestions]);
    }

    public function check_email(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            if (empty($email)) {
                return response()->json(Helper::renderApiError("E-Mail Id is required."));
            }

            $userTblEmails = \App\Models\User::where('email', $email)->exists();
            $onePageTblEmails = OnePageQuestionnaireRequest::where('email', $email)->exists();

            if ($userTblEmails || $onePageTblEmails) {
                return response()->json(Helper::renderApiError("E-Mail Id already exists."));
            }

            return response()->json(["message" => "", "status" => true, "data" => null ]);
        }

        return response()->json(Helper::renderApiError("Invalid request method."));
    }

    public function questionnaire_update(Request $request)
    {
        if (!$request->isMethod('post')) {
            return Helper::renderJsonError("Invalid request");
        }

        DB::beginTransaction();
        try {
            if (empty($request->a_token)) {
                return redirect()->back()->withInput()->with('error', 'Invalid token.');
            }

            $attorney_id = base64_decode($request->a_token) ?? '';
            $attorney = User::find($attorney_id);
            if (!$attorney) {
                return redirect()->back()->withInput()->with('error', 'Invalid token');
            }

            $clientEmail = $request->email;
            $emailExists = User::where('email', $clientEmail)->exists() || OnePageQuestionnaireRequest::where('email', $clientEmail)->exists();

            if ($emailExists) {
                return redirect()->back()->withInput()->with('error', 'E-Mail Id already exists.');
            }

            $dataToSave = $this->dataToSaveArray($request, $attorney_id);
            $questionnaireRecord = OnePageQuestionnaireRequest::Create($dataToSave);
            $dataID = $questionnaireRecord->id;

            // Handle vehicle property value document uploads
            $propertyVehicle = $request->property_vehicle ?? [];
            if (!empty($propertyVehicle)) {
                $vehicle_property_value_document = $propertyVehicle['vehicle_property_value_document'] ?? [];
                // Reset the array indexes for vehicle_property_value_document to ensure sequential numeric keys
                if (!empty($vehicle_property_value_document) && is_array($vehicle_property_value_document)) {
                    $vehicle_property_value_document = array_values($vehicle_property_value_document);
                    DocumentUploadedData::uploadVehiclePropertyValueDocument($vehicle_property_value_document, $dataID);
                }
            }

            $clientname = trim(collect([
                $request->name,
                $request->middle_name,
                $request->last_name
            ])->filter()->implode(' '));

            try {
                // Mail to Attorney
                if (AttorneySettings::isEmailEnabled($attorney_id, 'attorney_onepage_que_submit_mail')) {
                    $mail = Helper::getAttorneyEmailArray($attorney_id);
                    Mail::to($mail)->send(
                        new OnePageQuesRequest($clientname, $clientEmail, $attorney->name)
                    );
                }
            } catch (\Exception $e) {
                Log::error('Email failed to send to attorney.', ['error' => $e->getMessage()]);
            }

            try {
                // Mail to Client
                Mail::to($clientEmail)->send(
                    new OnePageQuesRequestSuccessToClient($clientname)
                );
            } catch (\Exception $e) {
                Log::error('Email failed to send to client.', ['error' => $e->getMessage()]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Record has been added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while submitting request.', ['error' => $e->getMessage()]);
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    private function updatePropertyVehicle($input, $property_vehicle_final)
    {
        if (!empty($input['property_vehicle'])) {
            foreach ($input['property_vehicle'] as $key => $values) {
                $i = 0;
                if ($key == "vehicle_car_loan") {
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


    private function updatePropertyVehicleCarLoan($input, $property_vehicle_final)
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


    private function getAdditionalLiensData($input, $additional_liens_data)
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

    private function getIncomeData($input, $debtor)
    {
        $income_data = [];
        $debtorInputs = $this->getDebtorInputs($debtor);
        if (!empty($debtorInputs)) {
            foreach ($debtorInputs as $index => $key) {
                $income_data[$key] = str_replace(',', '', $input[$key]);
            }
        }

        return $income_data;
    }

    private function getDebtorInputs($debtor)
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
                'other_sources_inc_amt_debtor' ];
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
                'other_sources_inc_amt_spouse' ];
        }

        return $inputs;
    }

    private function dataToSaveArray($input, $attorney_id)
    {
        $property_vehicle_final = [];
        $property_vehicle_final = $this->updatePropertyVehicle($input, $property_vehicle_final);
        $property_vehicle_final = $this->updatePropertyVehicleCarLoan($input, $property_vehicle_final);

        $vehicle_details = json_encode($property_vehicle_final);
        $is_imported = '';
        $additional_liens_data = [];
        $additional_liens_data = $this->getAdditionalLiensData($input, $additional_liens_data);
        $additional_liens_data = json_encode($additional_liens_data);

        $debtor_income_data = $this->getIncomeData($input, 1);
        $codebtor_income_data = $this->getIncomeData($input, 2);

        $dataToSave = [
            'session_id' => $input->session_id,
            'attorney_id' => $attorney_id,
            'martial_status' => $input->martial_status,
            'name' => $input->name,
            'middle_name' => $input->middle_name,
            'last_name' => $input->last_name,
            'suffix' => $input->suffix,
            'home' => $input->home,
            'cell' => $input->cell,
            'work' => $input->work,
            'date_of_birth' => $input->date_of_birth,
            'email' => $input->email,
            'Address' => $input->Address,
            'City' => $input->City,
            'state' => $input->state,
            'zip' => $input->zip,
            'country' => $input->country,
            'has_security_number' => '',
            'security_number' => $input->security_number,
            'itin' => '',
            'lived_address_from_180' => $input->lived_address_from_180,
            'filed_in_last_8_yrs' => $input->filed_in_last_8_yrs,
            'chapter' => $input->chapter,
            'spouse_name' => $input->spouse_name,
            'spouse_middle_name' => $input->spouse_middle_name,
            'spouse_last_name' => $input->spouse_last_name,
            'spouse_suffix' => $input->spouse_suffix,
            'spouse_work' => $input->spouse_work,
            'spouse_date_of_birth' => $input->spouse_date_of_birth,
            'spouse_email' => $input->spouse_email,
            'spouse_cell' => $input->spouse_cell,
            'spouse_has_security_number' => '',
            'spouse_security_number' => $input->spouse_security_number,
            'spouse_itin' => '',
            'spouse_lived_at_this_address' => $input->spouse_lived_at_this_address,
            'spouse_diff_address' => $input->spouse_diff_address,
            'spouse_address' => $input->spouse_address,
            'spouse_city' => $input->spouse_city,
            'd2_state' => $input->d2_state,
            'spouse_zip' => $input->spouse_zip,
            'spouse_country' => $input->spouse_country,
            'family_members' => $input->family_members,
            'income_paid_1' => $input->income_paid_1,
            'income_avg_paycheck' => str_replace(',', '', $input->income_avg_paycheck),
            'income_spouse_avg_paycheck' => str_replace(',', '', $input->income_spouse_avg_paycheck),
            'income_paid_2' => $input->income_paid_2,
            'income_rpmo' => str_replace(',', '', $input->income_rpmo),
            'income_net_profit' => str_replace(',', '', $input->income_net_profit),
            'income_other_income' => str_replace(',', '', $input->income_other_income),
            'income_notes' => $input->income_notes,
            'rent_or_own' => $input->rent_or_own,
            'loan_on_property' => $input->loan_on_property,
            'mortgage_rent_1' => str_replace(',', '', $input->mortgage_rent_1),
            'mortgage_own_1' => str_replace(',', '', $input->mortgage_own_1),
            'mortgage_past_payment_1' => str_replace(',', '', $input->mortgage_past_payment_1),
            'mortgage_amount_owned_1' => str_replace(',', '', $input->mortgage_amount_owned_1),
            'mortgage_property_value_1' => str_replace(',', '', $input->mortgage_property_value_1),
            'mortgages_creditor_name_1' => $input->mortgages_creditor_name_1,
            'mortgages_creditor_address_1' => $input->mortgages_creditor_address_1,
            'mortgages_creditor_city_1' => $input->mortgages_creditor_city_1,
            'mortgages_creditor_state_1' => $input->mortgages_creditor_state_1,
            'mortgages_creditor_zipcode_1' => $input->mortgages_creditor_zipcode_1,
            'mortgage_additional_loans' => $input->mortgage_additional_loans,
            'mortgage_rent_2' => str_replace(',', '', $input->mortgage_rent_2),
            'mortgage_own_2' => str_replace(',', '', $input->mortgage_own_2),
            'mortgage_past_payment_2' => str_replace(',', '', $input->mortgage_past_payment_2),
            'mortgage_amount_owned_2' => str_replace(',', '', $input->mortgage_amount_owned_2),
            'mortgages_creditor_name_2' => $input->mortgages_creditor_name_2,
            'mortgages_creditor_address_2' => $input->mortgages_creditor_address_2,
            'mortgages_creditor_city_2' => $input->mortgages_creditor_city_2,
            'mortgages_creditor_state_2' => $input->mortgages_creditor_state_2,
            'mortgages_creditor_zipcode_2' => $input->mortgages_creditor_zipcode_2,
            'mortgage_additional_loans_2' => $input->mortgage_additional_loans_2,
            'mortgage_rent_3' => str_replace(',', '', $input->mortgage_rent_3),
            'mortgage_own_3' => str_replace(',', '', $input->mortgage_own_3),
            'mortgage_past_payment_3' => str_replace(',', '', $input->mortgage_past_payment_3),
            'mortgage_amount_owned_3' => str_replace(',', '', $input->mortgage_amount_owned_3),
            'mortgages_creditor_name_3' => $input->mortgages_creditor_name_3,
            'mortgages_creditor_address_3' => $input->mortgages_creditor_address_3,
            'mortgages_creditor_city_3' => $input->mortgages_creditor_city_3,
            'mortgages_creditor_state_3' => $input->mortgages_creditor_state_3,
            'mortgages_creditor_zipcode_3' => $input->mortgages_creditor_zipcode_3,
            'mortgage_foreclosure_property' => $input->mortgage_foreclosure_property,
            'mortgage_foreclosure_date' => $input->mortgage_foreclosure_date,
            'mortgage_foreclosure_date_scheduled' => $input->mortgage_foreclosure_date_scheduled,
            'mortgage_notes' => $input->mortgage_notes,
            'taxes_internal_revenue_year' => $input->taxes_internal_revenue_year,
            'taxes_irs_taxes_due' => str_replace(',', '', $input->taxes_irs_taxes_due),
            'taxes_tax_state' => $input->taxes_tax_state,
            'taxes_franchise_tax_board' => $input->taxes_franchise_tax_board,
            'taxes_state_tax_due' => str_replace(',', '', $input->taxes_state_tax_due),
            'child_supp_or_alimony' => $input->child_supp_or_alimony,
            'taxes_child_support_state' => $input->taxes_child_support_state,
            'taxes_child_support_due' => str_replace(',', '', $input->taxes_child_support_due),
            'current_on_your_support_obligation' => $input->current_on_your_support_obligation,
            'taxes_alimony_due' => str_replace(',', '', $input->taxes_alimony_due),
            'credit_crd_debt' => str_replace(',', '', $input->credit_crd_debt),
            'medical_debt' => str_replace(',', '', $input->medical_debt),
            'student_loans' => str_replace(',', '', $input->student_loans),
            'law_suit' => str_replace(',', '', $input->law_suit),
            'personal_loans' => str_replace(',', '', $input->personal_loans),
            'credit_union_loans' => str_replace(',', '', $input->credit_union_loans),
            'family_loans' => str_replace(',', '', $input->family_loans),
            'made_purchases' => $input->made_purchases,
            'used_one_card' => $input->used_one_card,
            'checking_account' => $input->checking_account,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'vehicle_details' => $vehicle_details,
            'is_imported' => $is_imported,
            'date_filed' => $input->date_filed,
            'employee_type_1' => $input->employee_type_1,
            'employee_type_2' => $input->employee_type_2,
            'income_net_profit_spouse' => str_replace(',', '', $input->income_net_profit_spouse),
            'ss_income' => str_replace(',', '', $input->ss_income),
            'own_any_vehicle' => $input->own_any_vehicle,
            'additional_liens' => $input->additional_liens,
            'additional_liens_data' => $additional_liens_data,
            'last_5_year_taxes' => $input->last_5_year_taxes,
            'misc_loans' => str_replace(',', '', $input->misc_loans),
            'concierge_question' => json_encode($input->concierge_question),
            'debtor_income_data' => json_encode($debtor_income_data),
            'codebtor_income_data' => json_encode($codebtor_income_data),
            'tax_owned_irs' => $input->tax_owned_irs,
            'back_taxes_owed' => $input->back_taxes_owed,
            'being_sued' => $input->being_sued,
            'wages_being_garnished' => $input->wages_being_garnished,
            'extra_notes' => $input->extra_notes,
            "any_bankruptcy_filed_before_data" => json_encode($input->any_bankruptcy_filed_before_data ?? []),
            "emergency_check" => json_encode($input->emergency_check ?? []),
            "emergency_notes" => $input->emergency_notes,
            "find_us" => json_encode($input->find_us ?? []),
            "google_reviews" => $input->google_reviews,
            "zoom_exp" => $input->zoom_exp,
            "find_us_referred_by" => $input->find_us_referred_by,
            "property_own_data" => json_encode($input->property_own_data ?? []),
        ];

        return $dataToSave;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = \App\Models\ShortLink::where('code', $code)->first();

        if (!$find) {
            abort(404, 'Short link not found.');
        }

        return redirect($find->link);
    }


}
