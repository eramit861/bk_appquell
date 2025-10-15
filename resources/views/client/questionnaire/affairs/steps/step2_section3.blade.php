<!-- Listing -->
<input type="hidden" id="list_all_financial_accounts_yes" name="list_all_financial_accounts"
    value="{{ Helper::validate_key_value('list_all_financial_accounts', $finacial_affairs, 'radio') }}">

@if(!empty($finacial_affairs['list_all_financial_accounts_data']['institution_name']) && is_array($finacial_affairs['list_all_financial_accounts_data']['institution_name']))
    @for($i = 0; $i < count($finacial_affairs['list_all_financial_accounts_data']['institution_name']); $i++)
        @include("client.questionnaire.affairs.list_all_financial_accounts_hidden", ['finacial_affairs' => $finacial_affairs['list_all_financial_accounts_data'], $i])
    @endfor
@else
    @include("client.questionnaire.affairs.list_all_financial_accounts_hidden", ['i' => 0])
@endif

<!-- within the last year have you had, any safe deposit box or other depository containing securities, cash, or other valuables -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            Do you currently have, or have you had in the past year, any safe deposit box or other storage containing money, stocks, or other valuables?
            <!-- Example Label -->
            <p class="text-bold mb-0">
                <span class="text-c-blue">This includes: Bank safe deposit boxes, Home safes or vaults, Any place where you keep cash, jewelry, stocks, bonds, or other valuable items</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="list-safe-deposit_yes" class="d-none" name="list_safe_deposit" required {{ Helper::validate_key_toggle('list_safe_deposit', $finacial_affairs, 1) }} value="1">
            <label for="list-safe-deposit_yes"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('list_safe_deposit', $finacial_affairs, 1) }}"
                onclick="getSafeDepositData('yes');">Yes</label>

            <input type="radio" id="list-safe-deposit_no" class="d-none" name="list_safe_deposit" required {{ Helper::validate_key_toggle('list_safe_deposit', $finacial_affairs, 0) }} value="0">
            <label for="list-safe-deposit_no"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('list_safe_deposit', $finacial_affairs, 0) }}"
                onclick="getSafeDepositData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('list_safe_deposit', $finacial_affairs) }}"
    id="list-safe-deposit-data">
    @include("client.questionnaire.affairs.common.parent_list_safe_deposit")
</div>

<!-- Listing -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the past year, have you stored any property in a storage unit or any place other than your home?
            <!-- Example Label -->
            <p class="text-bold mb-0">
                <span class="text-c-blue">This includes: Self-storage units, Storage facilities, A friend's or relative's property storage, Any place outside your home where you keep belongings</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="list-storage-unit_yes" class="d-none" name="other_storage_unit" required {{ Helper::validate_key_toggle('other_storage_unit', $finacial_affairs, 1) }} value="1">
            <label for="list-storage-unit_yes"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('other_storage_unit', $finacial_affairs, 1) }}"
                onclick="getStorageUnitData('yes');">Yes</label>

            <input type="radio" id="list-storage-unit_no" class="d-none" name="other_storage_unit" required {{ Helper::validate_key_toggle('other_storage_unit', $finacial_affairs, 0) }} value="0">
            <label for="list-storage-unit_no"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('other_storage_unit', $finacial_affairs, 0) }}"
                onclick="getStorageUnitData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('other_storage_unit', $finacial_affairs) }}"
    id="list-storage-unit-data">
    @include("client.questionnaire.affairs.common.parent_other_storage_unit")
</div>

<!-- Listing -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            Do you have possession or control of any property that belongs to someone else?
            <!-- Example Label -->
            <p class="text-bold mb-0">
                <span class="text-c-blue">This is anybody else's property you own, possess, or use.</span></br>
                <span class="text-danger">(If you are borrowing and/or regularly driving a car owned by someone else, it must be listed here. Including a family member, spouse and/or friend.)</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="list-property-you-hold_yes" class="d-none" name="list_property_you_hold" required
                {{ Helper::validate_key_toggle('list_property_you_hold', $finacial_affairs, 1) }} value="1">
            <label for="list-property-you-hold_yes"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('list_property_you_hold', $finacial_affairs, 1) }}"
                onclick="getPropertyHoldData('yes');">Yes</label>

            <input type="radio" id="list-property-you-hold_no" class="d-none" name="list_property_you_hold" required
                {{ Helper::validate_key_toggle('list_property_you_hold', $finacial_affairs, 0) }} value="0">
            <label for="list-property-you-hold_no"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('list_property_you_hold', $finacial_affairs, 0) }}"
                onclick="getPropertyHoldData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('list_property_you_hold', $finacial_affairs) }}"
    id="list-property-you-hold-data">
    @include("client.questionnaire.affairs.common.parent_list_property_you_hold")
</div>

<div class="col-12">
   <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('sofa_section_storage')">
      No to all of the above
   </button>
</div>