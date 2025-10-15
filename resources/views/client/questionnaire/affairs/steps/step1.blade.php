<!-- Total amount of income received -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            Have you earned or received any income from wages, employment, or operating a business in the last three years, even if the business incurred a loss?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="If you have received any income, W-2s, or filed taxes based on received income and/or incurred losses from the operation of a business, the answer to this question should be YES.">
                <i class="bi bi-question-circle"></i>
            </div>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="total-amount-income_yes" class="d-none" name="total_amount_income" required {{ !empty($finacial_affairs) ? Helper::validate_key_toggle('total_amount_income', $finacial_affairs, 1) : ($idDebtorEmployed == 1 ? 'checked' : '') }} value="1">
            <label for="total-amount-income_yes" class="btn-toggle  {{ !empty($finacial_affairs) ? Helper::validate_key_toggle_active('total_amount_income', $finacial_affairs, 1) : ($idDebtorEmployed == 1 ? 'active' : '') }}" onclick="getTotalAmountIncomeData('yes');">Yes</label>

            <input type="radio" id="total-amount-income_no" class="d-none" name="total_amount_income" required {{ Helper::validate_key_toggle('total_amount_income', $finacial_affairs, 0) }} value="0">
            <label for="total-amount-income_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('total_amount_income', $finacial_affairs, 0) }}" onclick="getTotalAmountIncomeData('no'); openFlagPopup('operation-business-income', 'No', true);">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="table_list_col col-12 {{ !empty($finacial_affairs) ? Helper::key_hide_show_v('total_amount_income', $finacial_affairs) : ($idDebtorEmployed == 1 ? 'checked' : '') }}" id="total-amount-income-data">
    @include("client.questionnaire.affairs.common.parent_ytd_gross_income")
</div>

<!-- Other amount of income received -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            List any income that you received other than from employment or operation of business?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Examples of other income are alimony; child support; Social Security, unemployment, and other public benefit payments; pensions; rental income; interest; dividends; money collected from lawsuits; royalties; gambling & lottery winnings. If you are filing a joint case and you have income that you received together, list it only once under Debtor 1.">
                <i class="bi bi-question-circle"></i>
            </div>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="other_income_received_income_yes" class="d-none" name="other_income_received_income" required {{ Helper::validate_key_toggle('other_income_received_income', $finacial_affairs, 1) }} value="1">
            <label for="other_income_received_income_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('other_income_received_income', $finacial_affairs, 1) }}" onclick="getOtherIncomeRecivedData('yes');">Yes</label>

            <input type="radio" id="other_income_received_income_no" class="d-none" name="other_income_received_income" required {{ Helper::validate_key_toggle('other_income_received_income', $finacial_affairs, 0) }} value="0">
            <label for="other_income_received_income_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('other_income_received_income', $finacial_affairs, 0) }}" onclick="getOtherIncomeRecivedData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="table_list_col col-12 {{ Helper::key_hide_show_v('other_income_received_income', $finacial_affairs) }}" id="other-income-received-income-data">
    @include("client.questionnaire.affairs.common.parent_ytd_other_source_income")
</div>

<!-- Payments that you made within the past 1 year -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            List all payments or transfers of money or property you made within the past year to any ‘insider’ (such as a relative, friend, or business associate).
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(Insiders include your relatives; any business partners; relatives of any business partners; corporations of which you are an officer, or owner of 20% or more; including one for a business you operate as a sole proprietor.) (Include payments you made for domestic support obligations, such as child support and alimony.)">
                <i class="bi bi-question-circle"></i>
            </div>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="payment_past_one_year_yes" class="d-none" name="payment_past_one_year" required {{ Helper::validate_key_toggle('payment_past_one_year', $finacial_affairs, 1) }} value="1">
            <label for="payment_past_one_year_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('payment_past_one_year', $finacial_affairs, 1) }}" onclick="getPaymentPastYearData('yes');">Yes</label>

            <input type="radio" id="payment_past_one_year_no" class="d-none" name="payment_past_one_year" required {{ Helper::validate_key_toggle('payment_past_one_year', $finacial_affairs, 0) }} value="0">
            <label for="payment_past_one_year_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('payment_past_one_year', $finacial_affairs, 0) }}" onclick="getPaymentPastYearData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('payment_past_one_year', $finacial_affairs) }}" id="payment-past-one-year-data">
    @include("client.questionnaire.affairs.common.parent_payment_past_one_year")
</div>

<!-- Listing -->
<input type="hidden" name="living_domestic_partner"
    value="{{ Helper::validate_key_value('living_domestic_partner', $finacial_affairs, 'radio') }}">

@if(!empty($finacial_affairs['community_property_state']))
    @for($i = 0; $i < count($finacial_affairs['community_property_state']); $i++)
        @include("client.questionnaire.affairs.common.living_domestic_partner_hidden",[$i])
    @endfor
@else
    @include("client.questionnaire.affairs.common.living_domestic_partner_hidden", ['i' => 0, 'isEmpty'=>true])
@endif

<input type="hidden" name="transfers_property" value="0">
