<!-- Bonds, mutual funds, and publicly traded stocks account -->
@if (Helper::validate_key_value('mutual_funds',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $mutual_funds) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you own any government or company bonds, savings bonds, annuities, or other certificates/papers that promise to pay you money in the future?
         <p class="text-bold mb-0">
            <span class="text-danger">This includes things like: U.S. savings bonds, Government or corporate bonds, Annuities, Certificates of deposit, Any paper or account where you put in money now and get paid back later.</span></br>
            <span class="text-c-blue">List only if they are outside of a retirement or investment account.</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="mutual_funds[id]"
            value="{{ Helper::validate_key_value('id', $mutual_funds) }}">
         <input type="hidden" name="mutual_funds[type]" value="mutual_funds">

         <input type="radio" id="bonds_mutual_funds_items_yes" class="d-none" name="mutual_funds[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $mutual_funds, 1) !!} value="1">
         <label for="bonds_mutual_funds_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $mutual_funds, 1) }}"
            onclick="getMutualFundsItems('yes');">Yes</label>

         <input type="radio" id="bonds_mutual_funds_items_no" class="d-none" name="mutual_funds[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $mutual_funds, 0) !!} value="0">
         <label for="bonds_mutual_funds_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $mutual_funds, 0) }}"
            onclick="getMutualFundsItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $mutual_funds) }}"
   id="bonds_mutual_funds_items_data">
   @include("client.questionnaire.property.financial.common.parent_mutual_funds")
</div>
@else
<input type="hidden" name="mutual_funds[type_value]" value="0">
@endif

<!-- education IRA -->
@if (Helper::validate_key_value('education_ira',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $education_ira) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse, if applicable, have any Education IRAS, ABLE accounts, or state tuition savings
         accounts?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
            data-bs-original-title="(The Educational IRA is another name for the Coverdell Education Savings Account (ESA) or a 529 plan. These are accounts are setup for education purposes only and can only be used for educational purposes only.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <p class="text-bold mb-0">
            <span class="text-c-blue">These are special accounts used to save money for school or for disability
               expenses.</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="education_ira[id]"
            value="{{ Helper::validate_key_value('id', $education_ira) }}">
         <input type="hidden" name="education_ira[type]" value="education_ira">

         <input type="radio" id="education_ira_yes" class="d-none" name="education_ira[type_value]" required {!! Helper::validate_key_toggle('type_value', $education_ira, 1) !!} value="1">
         <label for="education_ira_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $education_ira, 1) }}"
            onclick="getEducationIRAItems('yes');">Yes</label>

         <input type="radio" id="education_ira_no" class="d-none" name="education_ira[type_value]" required {!! Helper::validate_key_toggle('type_value', $education_ira, 0) !!} value="0">
         <label for="education_ira_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $education_ira, 0) }}"
            onclick="getEducationIRAItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $education_ira) }}"
   id="education_IRA_data">
   @include("client.questionnaire.property.financial.common.parent_education_ira")
</div>
@else
<input type="hidden" name="education_ira[type_value]" value="0">
@endif


<!-- trust, inheritance and/or equitable interest in any property -->
 @if (Helper::validate_key_value('trusts_life_estates',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $trusts_life_estates) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse, if applicable, have any financial interests or legal rights in property that you don't
         fully own but still benefit from, such as a trust, inheritance, or equitable interest?
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="trusts_life_estates[id]"
            value="{{ Helper::validate_key_value('id', $trusts_life_estates) }}">
         <input type="hidden" name="trusts_life_estates[type]" value="trusts_life_estates">

         <input type="radio" id="trusts_life_estates_yes" class="d-none" name="trusts_life_estates[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $trusts_life_estates, 1) !!} value="1">
         <label for="trusts_life_estates_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $trusts_life_estates, 1) }}"
            onclick="getInterestPropertyItems('yes');">Yes</label>

         <input type="radio" id="trusts_life_estates_no" class="d-none" name="trusts_life_estates[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $trusts_life_estates, 0) !!} value="0">
         <label for="trusts_life_estates_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $trusts_life_estates, 0) }}"
            onclick="getInterestPropertyItems('no');">No</label>
      </div>

      <p class="text-bold mb-0">
         <span class="text-c-blue">(<u>Trusts</u>: A legal setup where one person (the trustee) manages assets for
            someone else (the beneficiary))</span>
         <br>
         <span class="text-c-blue">(<u>Inheritances</u>: Are assets, property, or money that a person receives from
            someone who has passed away. Such as: cash, real estate, personal belongings, and investments.)</span>
         <br>
         <span class="text-c-blue">(<u>Equitable interest in any property</u>: Means that you have a legal right or
            claim to property, even though it isn't officially in your name. This can occur in situations like trusts or
            partnerships, where you might not own the property outright but still have a stake in it.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $trusts_life_estates) }}"
   id="interestin_property_data">
   @include("client.questionnaire.property.financial.common.parent_trusts_life_estates")
</div>
@else
<input type="hidden" name="trusts_life_estates[type_value]" value="0">
@endif

<!-- sofa question-area -->
  @if (Helper::validate_key_value('all_property_transfer_10_year',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('all_property_transfer_10_year', $finacial_affairs) == 1)
<!-- transfer any property into a self-settled trust or a similar arrangement in which you are a beneficiary -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the last 10 years, did you transfer any property into a trust or similar arrangement where you are a beneficiary?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(This question is asking if you placed any of your assets into a trust or a similar legal entity that benefits you, which could be relevant in bankruptcy proceedings as it may involve asset protection strategies.)">
                <i class="bi bi-question-circle"></i>
            </div>            
            <p class="text-bold mb-0">
                <span class="text-c-blue">This means if you put money, property, or other assets into a trust or similar setup that you control or benefit from.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="list-all-property_transfer_yes" class="d-none" name="all_property_transfer_10_year" required {!! Helper::validate_key_toggle('all_property_transfer_10_year', $finacial_affairs, 1) !!} value="1">
            <label for="list-all-property_transfer_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('all_property_transfer_10_year', $finacial_affairs, 1) }}" onclick="getAllTransferPropertyData('yes');">Yes</label>

            <input type="radio" id="list-all-property_transfer_no" class="d-none" name="all_property_transfer_10_year" required {!! Helper::validate_key_toggle('all_property_transfer_10_year', $finacial_affairs, 0) !!} value="0">
            <label for="list-all-property_transfer_no" class="btn-toggle {{ Helper::validate_key_toggle_active('all_property_transfer_10_year', $finacial_affairs, 0) }}" onclick="getAllTransferPropertyData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('all_property_transfer_10_year', $finacial_affairs) }}" id="list-all-property_transfer-data">
    @include("client.questionnaire.affairs.common.parent_all_property_transfer_10_year")
</div>
@else
<input type="hidden" name="all_property_transfer_10_year" value="0">
@endif

<!-- Patents, Copyrights, Trademarks, Trade Secrets -->
  @if (Helper::validate_key_value('patents_copyrights',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $patents_copyrights) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse, if applicable, have any <span class="text-c-blue">Patents</span>, <span
            class="text-c-blue">Copyrights</span>, <span class="text-c-blue">Trademarks</span>, <span
            class="text-c-blue">Trade Secrets</span>, and/or any <span class="text-c-blue">Other Intellectual
            Property</span>?
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="patents_copyrights[id]"
            value="{{ Helper::validate_key_value('id', $patents_copyrights) }}">
         <input type="hidden" name="patents_copyrights[type]" value="patents_copyrights">

         <input type="radio" id="patents_copyrights_yes" class="d-none" name="patents_copyrights[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $patents_copyrights, 1) !!} value="1">
         <label for="patents_copyrights_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $patents_copyrights, 1) }}"
            onclick="getintellectualPropertyItems('yes');">Yes</label>

         <input type="radio" id="patents_copyrights_no" class="d-none" name="patents_copyrights[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $patents_copyrights, 0) !!} value="0">
         <label for="patents_copyrights_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $patents_copyrights, 0) }}"
            onclick="getintellectualPropertyItems('no');">No</label>
      </div>

      <p class="text-bold mb-0">
         <span class="text-c-blue">(<u>Patents</u> protect inventions or new processes, Copyrights cover original works
            like books, music, and art, Trademarks protect brand names, logos, and slogans.)</span>
         <br>
         <span class="text-c-blue">(<u>Other Intellectual Property</u>: Internet domains, websites, logos etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $patents_copyrights) }}"
   id="intellectual_property_data">
   @include("client.questionnaire.property.financial.common.parent_patents_copyrights")
</div>
@else
<input type="hidden" name="patents_copyrights[type_value]" value="0">
@endif

@php
$i = 0;
if (!empty($traded_stocks['description']) && is_array($traded_stocks['description'])) {
@endphp
@for ($i = 0; $i < count($traded_stocks['description']); $i++)
@include("client.questionnaire.property.financial.traded_stocks", ['traded_stocks' => $traded_stocks, 'i' => $i, 'hiddenInputs' => true])
@endfor
@php
} else {
@endphp
@include("client.questionnaire.property.financial.traded_stocks", ['hiddenInputs' => true])
@php
}
@endphp

<!-- government and/or corporate Bonds or instruments -->
<input type="hidden" name="government_corporate_bonds[id]"
            value="{{ Helper::validate_key_value('id', $government_corporate_bonds) }}">
<input type="hidden" name="government_corporate_bonds[type]" value="government_corporate_bonds">
<input type="hidden" name="government_corporate_bonds[type_value]" value="0">


<input type="hidden" name="security_deposits[id]"
   value="{{ Helper::validate_key_value('id', $security_deposits, 'radio') }}">
<input type="hidden" name="security_deposits[type]" value="security_deposits">
<input type="hidden" name="security_deposits[type_value]"
   value="{{ empty(Helper::validate_key_value('type_value', $security_deposits)) ? 0 : Helper::validate_key_value('type_value', $security_deposits) }}">

@php
$i = 0;
if (!empty($security_deposits['description']) && is_array($security_deposits['description'])) {
    for ($i = 0; $i < count($security_deposits['description']); $i++) {
@endphp
<input type="hidden" name="security_deposits[data][type_of_account][{{ $i }}]"
   value="{{ Helper::validate_key_loop_value('type_of_account', $security_deposits, $i) }}">
<input type="hidden" name="security_deposits[data][description][{{ $i }}]"
   value="{{ Helper::validate_key_loop_value('description', $security_deposits, $i) }}">
<input type="hidden" name="security_deposits[data][property_value][{{ $i }}]"
   value="{{ Helper::validate_key_loop_value('property_value', $security_deposits, $i) }}">
@php
    }
} else {
@endphp
<input type="hidden" name="security_deposits[data][type_of_account][{{ $i }}]"
   value="{{ Helper::validate_key_loop_value('type_of_accounts', $security_deposits, $i) }}">
<input type="hidden" name="security_deposits[data][description][{{ $i }}]"
   value="{{ Helper::validate_key_loop_value('descriptions', $security_deposits, $i) }}">
<input type="hidden" name="security_deposits[data][property_value][{{ $i }}]"
   value="{{ Helper::validate_key_loop_value('property_value', $security_deposits, $i) }}">
@php
}
@endphp

<!-- Annuities -->
<input type="hidden" name="annuities[id]" value="{{ Helper::validate_key_value('id', $annuities) }}">
<input type="hidden" name="annuities[type]" value="annuities">
<input type="hidden" name="annuities[type_value]" value="0">

<div class="col-12">
   <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('financial_assets_3')">
      No to all of the above
   </button>
</div>