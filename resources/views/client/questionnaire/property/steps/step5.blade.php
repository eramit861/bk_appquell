@php
    $form_route_step_4 = $attorney_edit ? $save_route : route('client_property_step4');
    $final = [];
    
    if (!empty($financialassets)) {
        foreach ($financialassets as $financials) {
            $f_type_data = json_decode($financials['type_data'], 1);
            if (!empty($f_type_data)) {
                // TypeOfAccount is only used for property->retirement
                $financials['type_of_account'] = Helper::validate_key_value('type_of_account', $f_type_data);
                $financials['description'] = Helper::validate_key_value('description', $f_type_data);
                $financials['property_value'] = Helper::validate_key_value('property_value', $f_type_data);
                $financials['account_type'] = Helper::validate_key_value('account_type', $f_type_data);
                $financials['owned_by'] = Helper::validate_key_value('owned_by', $f_type_data);
                $financials['state'] = Helper::validate_key_value('state', $f_type_data);
                $financials['unknown'] = Helper::validate_key_value('unknown', $f_type_data);
                $financials['property_value_unknown'] = Helper::validate_key_value('property_value_unknown', $f_type_data);
                
                if ($financials['type'] == 'alimony_child_support') {
                    $financials['data_for'] = Helper::validate_key_value('data_for', $f_type_data);
                }
                
                if ($financials['type'] == 'life_insurance') {
                    $financials['current_value'] = Helper::validate_key_value('current_value', $f_type_data);
                }
                
                if ($financials['type'] == 'unpaid_wages') {
                    $financials['owed_type'] = Helper::validate_key_value('owed_type', $f_type_data);
                    $financials['data_for'] = Helper::validate_key_value('data_for', $f_type_data);
                    $financials['monthly_amount'] = Helper::validate_key_value('monthly_amount', $f_type_data);
                }
            }
            unset($financials['type_data']);
            $final[$financials['type']] = $financials;
        }
    }
    
    $alimony_child_support = (!empty($final['alimony_child_support'])) ? $final['alimony_child_support'] : [];
    $unpaid_wages = (!empty($final['unpaid_wages'])) ? $final['unpaid_wages'] : [];
    $life_insurance = (!empty($final['life_insurance'])) ? $final['life_insurance'] : [];
    $insurance_policies = (!empty($final['insurance_policies'])) ? $final['insurance_policies'] : [];
    $inheritances = (!empty($final['inheritances'])) ? $final['inheritances'] : [];
    $inheritances = (!empty($final['inheritances'])) ? $final['inheritances'] : [];
    $injury_claims = (!empty($final['injury_claims'])) ? $final['injury_claims'] : [];
    $lawsuits = (!empty($final['lawsuits'])) ? $final['lawsuits'] : [];
    $other_claims = (!empty($final['other_claims'])) ? $final['other_claims'] : [];
    $other_financial = (!empty($final['other_financial'])) ? $final['other_financial'] : [];
@endphp
<form name="client_property_step4" id="client_property_step4" action="{{ $form_route_step_4 }}" method="post"
    novalidate style="width: 100%">
    @csrf
    <div class="blinking-red-notice mt-0">
        <span><strong><u>IMPORTANT</u></strong> you need to list any and <strong>ALL</strong> assets here. <u>Even if
                the value is zero</u>. Your required to list ALL Assets for <strong><u>Value</u></strong> and
            <strong><u>Disclosure</u></strong>. Meaning if the value is zero it still must be listed.</span>
    </div>
    <div class="light-gray-div mt-2">
        <h2>Money or Property Owed To You 1</h2>
        <div class="light-gray-div mt-2 mb-3">
            <h2 class="text-dark fw-bold">If married, are you or your spouse owed any of the items listed below?</h2>

            <div class="row gx-3">
                @if(!empty($financialassets) && count($financialassets) > 0)
                    @include("client.questionnaire.property.financial_assets_continued_1", $financialassets)
                @else
                    @include("client.questionnaire.property.financial_assets_continued_1")
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div mt-2 mb-3">
        <h2>Money or Property Owed To You 2</h2>
        <div class="light-gray-div mt-2 mb-3">
            <h2 class="text-dark fw-bold">If married, are you or your spouse owed any of the items listed below?</h2>
            <div class="row gx-3">
                @if(!empty($financialassets) && count($financialassets) > 0)
                    @include("client.questionnaire.property.financial_assets_continued_2", $financialassets)
                @else
                    @include("client.questionnaire.property.financial_assets_continued_2")
                @endif
            </div>
        </div>
    </div>

    <div class="row gx-3">
        @include("client.questionnaire.property.financial_assets_continued_3")
    </div>
</form>

<div class="bottom-btn-div">
    @if(!$attorney_edit)
        <a href="{{ route('client_property_step3') }}" class="btn-new-ui-default me-2">Back to Previous Page</a>
    @endif
    <button type="button" class="btn-new-ui-default conti"
        onclick="financialContinutedSubmit('client_property_step4', {{ (isset($is_confirm_prompt_enabled) && $is_confirm_prompt_enabled && $step1PercentDone == 100 && $step2PercentDone == 100 && $step3PercentDone == 100 && $step4PercentDone == 100) ? 'true' : 'false' }})">{{ ($attorney_edit) ? 'Save' : 'Save & Next' }}</button>
</div>

<div class="hide-data life-insurance-unknown-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        Whole life Insurance builds value throughout the policy.<br />
        Its called cash/surrender value.<br />
        <span class="text-danger">This is an asset, the Trustee on your case will want to see a copy of the policy make
            sure you upload a copy of the policy</span><br />
        <span class="text-c-blue">If you don't this will delay your attorney filing your case and/or your case once
            filed.</span>
    </p>
</div>
<div class="hide-data universal-insurance-unknown-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        Universal life Insurance builds value throughout the policy.<br />
        Its called cash/surrender value.<br />
        <span class="text-danger">This is an asset, the Trustee on your case will want to see a copy of the policy make
            sure you upload a copy of the policy</span><br />
        <span class="text-c-blue">If you don't this will delay your attorney filing your case and/or your case once
            filed.</span>
    </p>
</div>
<div class="hide-data life-insurance-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        You must get a copy of your policy if you don't it is highly likely you will loose this and still have to pay
        your policy to the Court Trustee for the life of the policy.<br />
        <i class="que_text text-danger">(If you don't list ALL of your interest in these items you could lose them)</i>
    </p>
    <p>&#128563; Did you double-check your pay stubs?</p>
</div>
<div class="hide-data insurance-policies-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        Most people have life insurance. Double-check your pay stubs.<br />
        <i class="que_text text-danger">(If you don’t list any of these items you could loose them)</i>
    </p>
    <p>&#128563; Did you double-check your pay stubs?</p>
</div>
<div class="hide-data other-claim-popup">
    "Contingent" and "Unliquidated" both mean the amount is undetermined. You are supposed to enter an estimate of the
    amount you think the claim will be, even if the amount will be determined in an adversary proceeding.
</div>
