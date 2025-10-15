<!-- cash -->
@if (Helper::validate_key_value('cash',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $cash) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse keep any cash on hand (not in a bank)?
         <p class="blink text-success text-bold mb-0 w-100">If you have any cash or change in your wallet, pocket, purse, car's center console, or a change drawer at home, select 'Yes'. <i class="fa fa-arrow-down"></i></p>         
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="cash[id]" value="{{ Helper::validate_key_value('id', $cash) }}">
         <input type="hidden" name="cash[type]" value="cash">

         <input type="radio" id="cash_items_yes" class="d-none" name="cash[type_value]" required {!! Helper::validate_key_toggle('type_value', $cash, 1) !!} value="1">
         <label for="cash_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $cash, 1) }}" onclick="getCashItems('yes');">Yes</label>

         <input type="radio" id="cash_items_no" class="d-none" name="cash[type_value]" required {!! Helper::validate_key_toggle('type_value', $cash, 0) !!} value="0">
         <label for="cash_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $cash, 0) }}" onclick="getCashItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $cash) }}" id="cash_items_data">
   @include("client.questionnaire.property.financial.common.parent_cash")
</div>
@else
<input type="hidden" name="cash[type_value]" value="0">
@endif

<!-- Bank Accounts -->
@if (Helper::validate_key_value('bank',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $bank) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}" id="checking_account_items_data_question">
   <div class="label-div question-area">
      <label>
         Do you or your spouse have any bank accounts (checking, savings, credit union) or CDs?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(Such as Checking Savings, and/or Certificates of Deposit with any banks, Credit Unions or any other financial institutions.) (List any and all accounts even if they have zero balances, and make sure to upload statements as requested.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <br><p class="blink text-danger text-bold mb-0">Please list all bank accounts, regardless of the balance, even if they are overdrawn or have a zero balance. <i class="fa fa-arrow-down"></i></p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="bank[id]" value="{{ Helper::validate_key_value('id', $bank) }}">
         <input type="hidden" name="bank[type]" value="bank">

         <input type="radio" id="checking_account_items_yes" class="d-none" name="bank[type_value]" required {!! Helper::validate_key_toggle('type_value', $bank, 1) !!} value="1">
         <label for="checking_account_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $bank, 1) }}" onclick="getCheckingAccountItems('yes');">Yes</label>

         <input type="radio" id="checking_account_items_no" class="d-none" name="bank[type_value]" required {!! Helper::validate_key_toggle('type_value', $bank, 0) !!} value="0">
         <label for="checking_account_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $bank, 0) }}" onclick="getCheckingAccountItems('no'); openFlagPopup('bank-account-popup', 'No', true, {{ $attorney_edit }});">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $bank) }}" id="checking_account_items_data">
   @include("client.questionnaire.property.financial.common.parent_bank")
</div>
@else
<input type="hidden" name="bank[type_value]" value="0">
@endif

<!-- Venmo, PayPal, and/or Cash App accounts -->
 @if (Helper::validate_key_value('venmo_paypal_cash',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('type_value', $venmo_paypal_cash) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse, if applicable, have any <strong>Venmo</strong>, <span class="font-weight-bold text-c-blue">PayPal</span>, <span class="text-success font-weight-bold">Cash App</span>, or <strong>Apple Pay</strong> accounts?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(Although the average person may not consider or use them as such, the Court recognizes and classifies these accounts as bank accounts.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <br><p class="blink text-danger text-bold mb-0">If you have any of these on your phones or ipads/tablets select yes <i class="fa fa-arrow-down"></i></p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="venmo_paypal_cash[id]" value="{{ Helper::validate_key_value('id', $venmo_paypal_cash) }}">
         <input type="hidden" name="venmo_paypal_cash[type]" value="venmo_paypal_cash">

         <input type="radio" id="app_type_yes" class="d-none" name="venmo_paypal_cash[type_value]" required {!! Helper::validate_key_toggle('type_value', $venmo_paypal_cash, 1) !!} value="1">
         <label for="app_type_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $venmo_paypal_cash, 1) }}" onclick="getAccountItems('yes');">Yes</label>

         <input type="radio" id="app_type_no" class="d-none" name="venmo_paypal_cash[type_value]" required {!! Helper::validate_key_toggle('type_value', $venmo_paypal_cash, 0) !!} value="0">
         <label for="app_type_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $venmo_paypal_cash, 0) }}" onclick="getAccountItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $venmo_paypal_cash) }}" id="account_items_data">
   @include("client.questionnaire.property.financial.common.parent_venmo_paypal_cash")
</div>
@else
<input type="hidden" name="venmo_paypal_cash[type_value]" value="0">
@endif

<!-- Closed Accounts -->
@if (Helper::validate_key_value('list_all_financial_accounts',$financialAssetsSettings) == 1 || empty($financialAssetsSettings) || Helper::validate_key_value('list_all_financial_accounts', $finacial_affairs) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         In the past 12 months, did you or a financial institution close, sell, move, or transfer any bank or investment accounts in your name or for your benefit?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(Most common example: You or your bank closed your account(s) or transfered it to another account for some reason such as fraud) (If you or your banking institution closed the account for any reason, you must list the details here.)">
            <i class="bi bi-question-circle"></i>
         </div>
        <br> <p class="blink text-danger text-bold mb-0">Please list any and all closed bank accounts <i class="fa fa-arrow-down"></i></p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="radio" id="list_all_financial_accounts_yes" class="d-none" name="list_all_financial_accounts" required {!! Helper::validate_key_toggle('list_all_financial_accounts', $finacial_affairs, 1) !!} value="1">
         <label for="list_all_financial_accounts_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('list_all_financial_accounts', $finacial_affairs, 1) }}" onclick="getListFinancialAccountsData('yes');">Yes</label>

         <input type="radio" id="list_all_financial_accounts_no" class="d-none" name="list_all_financial_accounts" required {!! Helper::validate_key_toggle('list_all_financial_accounts', $finacial_affairs, 0) !!} value="0">
         <label for="list_all_financial_accounts_no" class="btn-toggle {{ Helper::validate_key_toggle_active('list_all_financial_accounts', $finacial_affairs, 0) }}" onclick="getListFinancialAccountsData('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('list_all_financial_accounts', $finacial_affairs) }}" id="list_all_financial_accounts-data">
   @include("client.questionnaire.affairs.common.parent_list_all_financial_accounts")
</div>
@else
<input type="hidden" name="list_all_financial_accounts" value="0">
@endif