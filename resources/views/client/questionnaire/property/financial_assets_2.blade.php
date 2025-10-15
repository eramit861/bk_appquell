
<!-- Brokerage account -->
 @if (Helper::validate_key_value('brokerage_account',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $brokerage_account) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse, if applicable, have any <span class="text-c-blue">brokerage</span> and/or <span class="text-c-blue">cryptocurrency (crypto)</span> accounts?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(Such as: Robinhood, Charles Schwab, Fidelity Investments etc.)">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="brokerage_account[id]" value="{{ Helper::validate_key_value('id', $brokerage_account) }}">
         <input type="hidden" name="brokerage_account[type]" value="brokerage_account">

         <input type="radio" id="brokerage_app_type_yes" class="d-none" name="brokerage_account[type_value]" required {!! Helper::validate_key_toggle('type_value', $brokerage_account, 1) !!} value="1">
         <label for="brokerage_app_type_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $brokerage_account, 1) }}" onclick="getBrokerageItems('yes');">Yes</label>

         <input type="radio" id="brokerage_app_type_no" class="d-none" name="brokerage_account[type_value]" required {!! Helper::validate_key_toggle('type_value', $brokerage_account, 0) !!} value="0">
         <label for="brokerage_app_type_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $brokerage_account, 0) }}" onclick="getBrokerageItems('no');">No</label>
      </div>

      <p class="text-bold mb-0">
         <span class="text-c-blue">(Brokerage accounts are: allow individuals to buy and sell various financial assets like stocks, bonds, mutual funds, and ETFs.)</span>
         <br>
         <span class="text-c-blue">(Crypto accounts are: used for buying, selling, and holding cryptocurrencies. They can be hosted on exchanges (where you trade crypto) or in wallets.)</span>
         <br><span class="text-danger">These can be found by the Bankruptcy Court (FYI)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $brokerage_account) }}" id="brokerage_items_data">
   @include("client.questionnaire.property.financial.common.parent_brokerage_account")
</div>
@else
<input type="hidden" name="brokerage_account[type_value]" value="0">
@endif


<!-- Retirement accounts -->
@if (Helper::validate_key_value('retirement_pension',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $retirement_pension) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse have any retirement accounts, like 401 (k), IRA, or pension accounts?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(This includes your current employer, previous employer or an account your setup on your own) (Examples of these are: 401(k), Pension plans, 403(b) plans, Thrift Savings Plan (TSP), Deferred compensation plans, Individual Retirement Accounts (IRAs) etc.)">
            <i class="bi bi-question-circle"></i>
         </div>
<br><p class="blink text-danger text-bold mb-0">Please list any and ALL retirement accounts even if they are coming out of your pay checks <i class="fa fa-arrow-down"></i></p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="retirement_pension[id]" value="{{ Helper::validate_key_value('id', $retirement_pension) }}">
         <input type="hidden" name="retirement_pension[type]" value="retirement_pension">

         <input type="radio" id="retirement_pension_yes" class="d-none" name="retirement_pension[type_value]" required {!! Helper::validate_key_toggle('type_value', $retirement_pension, 1) !!} value="1">
         <label for="retirement_pension_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $retirement_pension, 1) }}" onclick="getRetirementPensionItems('yes');">Yes</label>

         <input type="radio" id="retirement_pension_no" class="d-none" name="retirement_pension[type_value]" required {!! Helper::validate_key_toggle('type_value', $retirement_pension, 0) !!} value="0">
         <label for="retirement_pension_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $retirement_pension, 0) }}" onclick="getRetirementPensionItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $retirement_pension) }}" id="retirement_pension_data">
   @include("client.questionnaire.property.financial.common.parent_retirement_pension")
</div>
@else
<input type="hidden" name="retirement_pension[type_value]" value="0">
@endif

<!-- tax refunds/return -->
@if (Helper::validate_key_value('tax_refunds',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $tax_refunds) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse, if applicable, expect any tax refunds in the immediate future?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(Such as from last years tax returns and or this coming year tax returns.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <p class="blink text-success text-bold mb-0 w-100">Please enter any tax refunds you have received from state or federal governments within the past 5 months <i class="fa fa-arrow-down"></i></p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="tax_refunds[id]" value="{{ Helper::validate_key_value('id', $tax_refunds) }}">
         <input type="hidden" name="tax_refunds[type]" value="tax_refunds">

         <input type="radio" id="tax_refunds_yes" class="d-none" name="tax_refunds[type_value]" required {!! Helper::validate_key_toggle('type_value', $tax_refunds, 1) !!} value="1">
         <label for="tax_refunds_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $tax_refunds, 1) }}" onclick="getTaxRefundsItems('yes');">Yes</label>

         <input type="radio" id="tax_refunds_no" class="d-none" name="tax_refunds[type_value]" required {!! Helper::validate_key_toggle('type_value', $tax_refunds, 0) !!} value="0">
         <label for="tax_refunds_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $tax_refunds, 0) }}" onclick="getTaxRefundsItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $tax_refunds) }}" id="tax_refunds_data">
   <div class="outline-gray-border-area" id="tax_refunds_MainRow">
      @include("client.questionnaire.property.financial.common.parent_tax_refund")
   </div>
</div>
@else
<input type="hidden" name="tax_refunds[type_value]" value="0">
@endif

<!-- Patents, Copyrights, Trademarks, Trade Secrets -->
 @if (Helper::validate_key_value('licenses_franchises',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $licenses_franchises) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse (if applicable) hold any professional licenses, have interests in any franchises, or own any general intangible assets?
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="licenses_franchises[id]" value="{{ Helper::validate_key_value('id', $licenses_franchises) }}">
         <input type="hidden" name="licenses_franchises[type]" value="licenses_franchises">

         <input type="radio" id="licenses_franchises_yes" class="d-none" name="licenses_franchises[type_value]" required {!! Helper::validate_key_toggle('type_value', $licenses_franchises, 1) !!} value="1">
         <label for="licenses_franchises_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $licenses_franchises, 1) }}" onclick="getGeneralIntangiblesItems('yes');edit_div_common('licenses_franchises_mutisec', 0);">Yes</label>

         <input type="radio" id="licenses_franchises_no" class="d-none" name="licenses_franchises[type_value]" required {!! Helper::validate_key_toggle('type_value', $licenses_franchises, 0) !!} value="0">
         <label for="licenses_franchises_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $licenses_franchises, 0) }}" onclick="getGeneralIntangiblesItems('no');">No</label>
      </div>

      <p class="text-bold mb-0">
         <span class="text-c-blue">(Examples of professional licenses include: CPA, attorney licenses, teaching certifications, trade licenses (such as electrician or plumber), and real estate licenses, among others.)</span>
         <br>
         <span class="text-c-blue">(Examples: building permits, exclusive licenses, cooperative association holdings, liquor licenses and professional licenses)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $licenses_franchises) }}" id="genral_intangibles_data">
   <div class="outline-gray-border-area">
      @include("client.questionnaire.property.financial.common.parent_licenses_franchises")
   </div>
</div>
@else
<input type="hidden" name="licenses_franchises[type_value]" value="0">
@endif

<div class="col-12">
   <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('financial_assets_2')">
      No to all of the above
   </button>
</div>