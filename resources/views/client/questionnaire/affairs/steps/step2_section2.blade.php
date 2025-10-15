<!-- property transferred -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the past 12 months, have you given any money or property to a lawyer or advisor <span
                class="text-c-blue">(other than your current lawyer)</span> for help with bankruptcy?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="Include any attorneys, bankruptcy petition preparers, or credit counseling agencies for services required in your bankruptcy.">
                <i class="bi bi-question-circle"></i>
            </div>
            <p class="text-bold mb-0">
                <span class="text-c-blue">This includes any money or property given to someone for bankruptcy help,
                    excluding your current lawyer.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="property_transferred_yes" class="d-none" name="property_transferred" required
                {{ Helper::validate_key_toggle('property_transferred', $finacial_affairs, 1) }} value="1">
            <label for="property_transferred_yes"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('property_transferred', $finacial_affairs, 1) }}"
                onclick="getPropertyTransferredData('yes');">Yes</label>

            <input type="radio" id="property_transferred_no" class="d-none" name="property_transferred" required
                {{ Helper::validate_key_toggle('property_transferred', $finacial_affairs, 0) }} value="0">
            <label for="property_transferred_no"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('property_transferred', $finacial_affairs, 0) }}"
                onclick="getPropertyTransferredData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('property_transferred', $finacial_affairs) }}"
    id="property-transferred-data">
    @include('client.questionnaire.affairs.common.parent_property_transferred')
</div>

<!-- property transferred creditors -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the past 12 months, did you or anyone acting for you give money or property to someone who promised to
            help with your debts or creditors?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="You would list people and/or companies that you paid to settle debts, consolidate debts and/or any debt settlement companies you paid. Do not include any payment or transfer that you listed on the above question. (It important you list any debt settlement companies as you may be entitled to a refund. Consult your attorney about this.)">
                <i class="bi bi-question-circle"></i>
            </div>
            <p class="text-bold mb-0">
                <span class="text-c-blue">Any money or property given to someone to help with your debts or creditors in
                    the last year.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="property-transferred-creditors_yes" class="d-none"
                name="property_transferred_creditors" required
                {{ Helper::validate_key_toggle('property_transferred_creditors', $finacial_affairs, 1) }}
                value="1">
            <label for="property-transferred-creditors_yes"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('property_transferred_creditors', $finacial_affairs, 1) }}"
                onclick="getPropertyTransferredCreditorsData('yes');">Yes</label>

            <input type="radio" id="property-transferred-creditors_no" class="d-none"
                name="property_transferred_creditors" required
                {{ Helper::validate_key_toggle('property_transferred_creditors', $finacial_affairs, 0) }}
                value="0">
            <label for="property-transferred-creditors_no"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('property_transferred_creditors', $finacial_affairs, 0) }}"
                onclick="getPropertyTransferredCreditorsData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('property_transferred_creditors', $finacial_affairs) }}"
    id="property-transferred-creditors-data">
    @include('client.questionnaire.affairs.common.parent_property_transferred_creditors')
</div>

<!-- Listing -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            Within the last 2 years, did you sell, trade, or give away any property (such as cars, homes, or a business) to anyone or any entity?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title='(Did you gave away or transferred any property in a way that wasn’t part of your usual business transactions (for example, selling equipment as part of your business would be "ordinary course," but giving a piece of land to a relative might not be.)) (This is important because such transfers could be scrutinized to see if they were made to hide assets or favor certain people before filing for bankruptcy.)'>
                <i class="bi bi-question-circle"></i>
            </div>
            <p class="text-bold mb-0">
                <span class="text-c-blue">(Typically this is cars, homes and businesses but could be other items valued greater than $2,000.00)</span></br>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="Property_all_yes" class="d-none" name="Property_all" required
                {{ Helper::validate_key_toggle('Property_all', $finacial_affairs, 1) }} value="1">
            <label for="Property_all_yes"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('Property_all', $finacial_affairs, 1) }}"
                onclick="getPropertyallData('yes');">Yes</label>

            <input type="radio" id="Property_all_no" class="d-none" name="Property_all" required
                {{ Helper::validate_key_toggle('Property_all', $finacial_affairs, 0) }} value="0">
            <label for="Property_all_no"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('Property_all', $finacial_affairs, 0) }}"
                onclick="getPropertyallData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('Property_all', $finacial_affairs) }}" id="Property_all-data">
    @include('client.questionnaire.affairs.common.parent_Property_all')
</div>

<div class="col-12">
    <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('sofa_section_property_transfer')">
        No to all of the above
    </button>
</div>
