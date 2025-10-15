@php
    $form_route_step_4_continuted = $attorney_edit ? $save_route : route('client_property_step4_continue');
    $transaction_pdf_enabled = isset($transaction_pdf_enabled) ? $transaction_pdf_enabled : 0;
    $final = [];
    
    if (!empty($financialassets)) {
        foreach ($financialassets as $financial) {
            $f_type_data = json_decode($financial['type_data'], 1);
            if (!empty($f_type_data)) {
                // TypeOfAccount is only used for property->retirement
                $financial['type_of_account'] = $f_type_data['type_of_account'] ?? '';
                $financial['description'] = $f_type_data['description'] ?? '';
                $financial['last_4_digits'] = $f_type_data['last_4_digits'] ?? '';
                $financial['property_value'] = $f_type_data['property_value'] ?? '';
                $financial['account_type'] = $f_type_data['account_type'] ?? '';
                $financial['owned_by'] = $f_type_data['owned_by'] ?? '';
                $financial['property_value_unknown'] = $f_type_data['property_value_unknown'] ?? '';
                
                if ($financial['type'] == "mutual_funds" || $financial['type'] == "retirement_pension") {
                    $financial['unknown'] = $f_type_data['unknown'] ?? '';
                }
                
                if ($financial['type'] == "tax_refunds") {
                    $financial['year'] = $f_type_data['year'] ?? '';
                }
                
                if ($financial['type'] == "bank") {
                    $financial['personal_business_account'] = $f_type_data['personal_business_account'] ?? '';
                    $financial['business_name'] = $f_type_data['business_name'] ?? '';
                    $financial['transaction'] = $f_type_data['transaction'] ?? '';
                    $financial['transaction_data'] = $f_type_data['transaction_data'] ?? '';
                }
                
                if ($financial['type'] == "venmo_paypal_cash") {
                    $financial['debtor_type'] = $f_type_data['debtor_type'] ?? '';
                }
            }
            unset($financial['type_data']);
            $final[$financial['type']] = $financial;
        }
    }
    
    $cash = (!empty($final['cash'])) ? $final['cash'] : [];
    $bank = (!empty($final['bank'])) ? $final['bank'] : [];
    $venmo_paypal_cash = (!empty($final['venmo_paypal_cash'])) ? $final['venmo_paypal_cash'] : [];
    $brokerage_account = (!empty($final['brokerage_account'])) ? $final['brokerage_account'] : [];
    $savings_account = (!empty($final['savings_account'])) ? $final['savings_account'] : [];
    $certificate_deposit = (!empty($final['certificate_deposit'])) ? $final['certificate_deposit'] : [];
    $other_financial_account = (!empty($final['other_financial_account'])) ? $final['other_financial_account'] : [];
    $mutual_funds = (!empty($final['mutual_funds'])) ? $final['mutual_funds'] : [];
    $traded_stocks = (!empty($final['traded_stocks'])) ? $final['traded_stocks'] : [];
    $government_corporate_bonds = (!empty($final['government_corporate_bonds'])) ? $final['government_corporate_bonds'] : [];
    $retirement_pension = (!empty($final['retirement_pension'])) ? $final['retirement_pension'] : [];
    $security_deposits = (!empty($final['security_deposits'])) ? $final['security_deposits'] : [];
    $prepayments = (!empty($final['prepayments'])) ? $final['prepayments'] : [];
    $annuities = (!empty($final['annuities'])) ? $final['annuities'] : [];
    $education_ira = (!empty($final['education_ira'])) ? $final['education_ira'] : [];
    $trusts_life_estates = (!empty($final['trusts_life_estates'])) ? $final['trusts_life_estates'] : [];
    $patents_copyrights = (!empty($final['patents_copyrights'])) ? $final['patents_copyrights'] : [];
    $licenses_franchises = (!empty($final['licenses_franchises'])) ? $final['licenses_franchises'] : [];
    $tax_refunds = (!empty($final['tax_refunds'])) ? $final['tax_refunds'] : [];
    
    $isOnRent = false;
    if (!empty($propertyresident)) {
        $isOnRent = $propertyresident->contains(function ($resident) {
            return isset($resident['currently_lived']) && $resident['currently_lived'] == 0;
        });
    }
@endphp


<form name="client_property_step4_continue" id="client_property_step4_continue"
    action="{{ $form_route_step_4_continuted }}" method="post" novalidate style="width: 100%">
    @csrf

    <div class="blinking-red-notice mt-0">
        <span><strong><u>IMPORTANT</u></strong> you need to list any and <strong>ALL</strong> assets here. <u>Even if
                the value is zero</u>. Your required to list ALL Assets for <strong><u>Value</u></strong> and
            <strong><u>Disclosure</u></strong>. Meaning if the value is zero it still must be listed.</span>
    </div>

    <div class="light-gray-div mt-4">
        <h2>Financial Assets 1</h2>
        <div class="light-gray-div mt-2 mb-3">
            <h2 class="text-dark fw-bold">If married, do you or your spouse have any of the assets listed below?</h2>
            <div class="row gx-3">
                @if(!empty($financialassets) && count($financialassets) > 0)
                    @include("client.questionnaire.property.financial_assets_1", $financialassets)
                @else
                    @include("client.questionnaire.property.financial_assets_1")
                @endif
            </div>
        </div>
    </div>



    <div class="light-gray-div mt-4">
        <h2>Financial Assets 2</h2>
        <div class="light-gray-div mt-2 mb-3">
            <h2 class="text-dark fw-bold">If married, do you or your spouse have any of the assets listed below?</h2>
            <div class="row gx-3">
                @if(!empty($financialassets) && count($financialassets) > 0)
                    @include("client.questionnaire.property.financial_assets_2", $financialassets)
                @else
                    @include("client.questionnaire.property.financial_assets_2")
                @endif
            </div>
        </div>
    </div>



    <div class="light-gray-div mt-4">
        <h2>Financial Assets 3</h2>
        <div class="light-gray-div mt-2 mb-3">
            <h2 class="text-dark fw-bold">If married, do you or your spouse have any of the assets listed below?</h2>
            <div class="row gx-3">
                @if(!empty($financialassets) && count($financialassets) > 0)
                    @include("client.questionnaire.property.financial_assets_3", $financialassets)
                @else
                    @include("client.questionnaire.property.financial_assets_3")
                @endif
            </div>
        </div>
    </div>


    <div class="bottom-btn-div">
        @if(!$attorney_edit)
            <a href="{{ route('client_property_step2') }}" class="btn-new-ui-default me-2">Back to Previous
                Page</a>
        @endif
        <button type="submit" class="btn-new-ui-default" {{-- onclick="handleS4ContinueSubmit('{{ isset($hasAnyBussiness) ? $hasAnyBussiness : '' }}', event)" --}}
            >{{ ($attorney_edit) ? 'Save' : 'Save & Next' }}</button>
    </div>
</form>
<div class="hide-data hasAnyBusiness-popup">
    <p class="text-center text-danger"><i class="fa fa-exclamation-triangle fs-18px text-danger blink"
            aria-hidden="true"></i> You entered you have an open Business.</p>
    <p class="text-center text-c-blue mb-2">
        Your required to show 6 months of business bank statements for any open
        business you currently have. This is what the Court uses to determine your
        business income, even though your not filing a business bankruptcy.
    </p>
    <p class="text-center text-danger">Are you sure you don't have any business bank accounts? <span
            class="fs-25px">&#128561;</span></p>
</div>

<div class="hide-data bank-account-popup">
    <p>
        Are you sure you don't have any bank account? This isn't normal. &#128563;
    </p>
</div>

<div class="hide-data venmo-account-popup">
    <p>
        Are you sure you and/or your spouse if applicable don't have any <br /> Cash App, Venmo and/or Cash Apps on your
        phones? &#128563;
    </p>
</div>
<div class="hide-data mutual-fund-popup">
    These investments include stocks & bonds held individually or as part of a mutual fund. Money market accounts must
    also be revealed.
    Individual stocks should be identified by the company name valued on the New York Stock Exchange valuations as of
    the petition date.
    (Another-wards the retail value of the stock and/or the stock price multiplied by how many shares you own.)
</div>

<div class="hide-data government-corporate-bonds-popup">
    This requires you to disclose all government and corporate bonds and other negotiable and non-negotiable
    instruments.
    Negotiable instruments include personal checks, cashiers; checks, promissory notes, and money orders.
    Non-negotiable instruments: instruments that a person/individual cannot transfer to someone by signing or tendering
    them
</div>
<div class="hide-data retirement-pension">
    Examples: interests in any IRA, ERISA, Keogh, 401(k), 403(b), thrift savings accounts, government pensions and
    corporate pensions
</div>

<div class="popup_url"></div>
<div id="spinner" style='display:none'> </div>

<div class="hide-data business-account-unknown-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        <!-- add popup text here -->
    </p>
</div>