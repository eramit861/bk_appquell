@php
$currentEmployerData = !empty($income['currentEmployer']) ? $income['currentEmployer'] : [];
$previousEmployerData = !empty($income['previousEmployer']) ? $income['previousEmployer'] : [];
@endphp


<div class="light-gray-div mt-2">
    <h2>{{ $debtorname }} Employer Information</h2>
    <form name="income_step1_employer" id="income_step1_employer" action="{{route('current_employer_custom_save')}}" method="post" style="width: 100%" novalidate>
        @csrf
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Is {{ $debtorname }} currently employed?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Indicates whether {{ $debtorname }} is currently employed or not.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="current_employed" id="current_employed_no" class="d-none required current_employed" value="0" {{ count($currentEmployerData) == 0 ? 'checked' : '' }}>
                        <label for="current_employed_no" class="btn-toggle {{ count($currentEmployerData) == 0 ? 'active' : '' }}" onclick="current_employed_obj('no'); openFlagPopup('no-current-employer-popup', '', false);">No</label>

                        <input type="radio" name="current_employed" id="current_employed_yes" class="d-none required current_employed_yes" value="1" {{ count($currentEmployerData) > 0 ? 'checked' : '' }}>
                        <label for="current_employed_yes" class="btn-toggle {{ count($currentEmployerData) > 0 ? 'active' : '' }}" onclick="current_employed_obj('yes');">Yes</label>
                    </div>
                    <div class="hide-data no-current-employer-popup">
                        <p><i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i> Selecting 'No' will remove any saved current employers.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ count($currentEmployerData) == 0 ? 'hide-data' : '' }} employer-current-employer" id="employer_page_listing_div">
                <div class="outline-gray-border-area" id="employer_listing_html">
                    @if(!empty($currentEmployerData) && count($currentEmployerData) > 0)
                        @foreach($currentEmployerData as $key => $value)
                            @include("attorney.form_elements.common.income_employer_summary_common_new",[ 'value' => $value, 'enableEdit' => true, 'summaryDivId' => 'employer_page_listing_div', 'formId' => 'income_step1_employer', 'debtorname' => $debtorname ])
                        @endforeach
                    @else
                        @php
                        $key = 0;
                        $value = [];
                        @endphp
                        @include("attorney.form_elements.common.income_employer_summary_common_new",[ 'enableEdit' => true, 'summaryDivId' => 'employer_page_listing_div', 'formId' => 'income_step1_employer', 'debtorname' => $debtorname ])
                    @endif
                    <div class="add-more-div-bottom">
                        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="addMoreCurrentEmployer('income_step1_employer'); return false;">
                            <i class="bi bi-plus-lg"></i>
                            Add Additional Current Employer(s)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form name="client_income_step1" id="client_income_step1" action="{{route('client_income_step1')}}" method="post" style="width: 100%" novalidate>
        @csrf
        <div class="row gx-3" id="current_employed_obj_data_income">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Have you received any income from other jobs in <span class="text-danger">the past 7 months</span>, aside from those listed above?  
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Your employment history from the past 7 months is crucial for Bankruptcy Court. Please ensure that you complete this section accurately, if applicable.">
                            <i class="bi bi-question-circle"></i>
                        </div>                      
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="recieved_any_income" id="recieved-any-income-no" class="d-none required" value="0" {{ count($previousEmployerData) == 0 ? 'checked' : '' }}>
                        <label for="recieved-any-income-no" class="btn-toggle {{ count($previousEmployerData) == 0 ? 'active' : '' }}" onclick="recievedAnyIncomeShowHide(0, 'recieved_any_income_div'); openFlagPopup('no-previous-employer-popup', '', false);">No</label>

                        <input type="radio" name="recieved_any_income" id="recieved-any-income-yes" class="d-none required" value="1" {{ count($previousEmployerData) > 0 ? 'checked' : '' }}>
                        <label for="recieved-any-income-yes" class="btn-toggle {{ count($previousEmployerData) > 0 ? 'active' : '' }}" onclick="recievedAnyIncomeShowHide(1, 'recieved_any_income_div');">Yes</label>
                    </div>
                    <div class="hide-data no-previous-employer-popup">
                        <p><i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i> Selecting 'No' will remove any saved previous employers.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ count($previousEmployerData) == 0 ? 'hide-data' : '' }} recieved_any_income_div" id="data-previous-employer-self">
                @include("client.questionnaire.income.common.parent_previous_employer", ['debType' => 'self', 'form_id' => 'client_income_step1'])
            </div>

        </div>
    </form>
</div>

<div class="bottom-btn-div">
    @if(!empty($incomedebtoremployer['id']))
        <input type="hidden" class="property_vehicle_ids" name="id" value="{{ !empty($incomedebtoremployer['id']) ? $incomedebtoremployer['id'] : '' }}">
        <button type="button" class="btn-new-ui-default" onclick="submitIncomeDebtorStep('income_step1_employer', 'client_income_step1')" >Save & Next <i class="feather icon-chevron-right mr-0"></i></button>
    @else
        <button type="submit" class="btn-new-ui-default" onclick="submitIncomeDebtorStep('income_step1_employer', 'client_income_step1')">Save & Next <i class="feather icon-chevron-right mr-0"></i></button>
    @endif
</div>     

@if(Route::currentRouteName() == 'client_income' && (Auth::user()->client_subscription == \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION || (in_array(Auth::user()->client_payroll_assistant, [Helper::PAYROLL_ASSISTANT_TYPE_DEBTOR, Helper::PAYROLL_ASSISTANT_TYPE_BOTH]))))
    <script>
        window.__debtorEmployerCondition = true;
    </script>
@endif
