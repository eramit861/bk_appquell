@php
use App\Helpers\ClientHelper;

$title = "Employer Information";
if (Auth::user()->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED || Auth::user()->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) {
    $title = $spousename . " Employer Information";
}

$currentEmployerData = !empty($income['currentEmployer']) ? $income['currentEmployer'] : [];
$previousEmployerData = !empty($income['previousEmployer']) ? $income['previousEmployer'] : [];
@endphp

<div class="light-gray-div mt-2">
    <h2>{{ $title }}</h2>
    <form name="income_step2_employer" id="income_step2_employer" action="{{route('current_employer_custom_save_spouse')}}" method="post" style="width: 100%" novalidate>
        @csrf
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>Is {{ $spousename }} currently employed?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Indicates whether {{ $spousename }} is currently employed or not.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>    
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="current_employed" id="current_spouse_employed_no" class="d-none required current_employed" value="0" {{ count($currentEmployerData) == 0 ? 'checked' : '' }}>
                        <label for="current_spouse_employed_no" class="btn-toggle {{ count($currentEmployerData) == 0 ? 'active' : '' }}" onclick="current_spouse_employed_obj('no');">No</label>

                        <input type="radio" name="current_employed" id="current_spouse_employed_yes" class="d-none required current_employed_yes" value="1" {{ count($currentEmployerData) > 0 ? 'checked' : '' }}>
                        <label for="current_spouse_employed_yes" class="btn-toggle {{ count($currentEmployerData) > 0 ? 'active' : '' }}" onclick="current_spouse_employed_obj('yes');">Yes</label>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ count($currentEmployerData) == 0 ? 'hide-data' : '' }} employer-current-employer" id="employer_page_listing_div_spouse">
                <div class="outline-gray-border-area" id="employer_listing_html">
                    @if(!empty($currentEmployerData) && count($currentEmployerData) > 0)
                        @foreach($currentEmployerData as $key => $value)
                            @include("attorney.form_elements.common.income_employer_summary_common_new",[ 'value' => $value, 'enableEdit' => true, 'summaryDivId' => 'employer_page_listing_div_spouse', 'formId' => 'income_step2_employer', 'debtorname' => $spousename ])
                        @endforeach
                    @else
                        @php
                        $key = 0;
                        $value = [];
                        @endphp
                        @include("attorney.form_elements.common.income_employer_summary_common_new",[ 'enableEdit' => true, 'summaryDivId' => 'employer_page_listing_div_spouse', 'formId' => 'income_step2_employer', 'debtorname' => $spousename ])
                    @endif
                    <div class="add-more-div-bottom">
                        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="addMoreCurrentEmployer('income_step2_employer'); return false;">
                            <i class="bi bi-plus-lg"></i>
                            Add Additional Current Employer(s)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form name="client_income_step2" id="client_income_step2" action="{{route('client_income_step2')}}" method="post" style="width: 100%" novalidate>
        @csrf
        <div class="row gx-3" id="current_spouse_employed_obj_data_income">
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
                        <label for="recieved-any-income-no" class="btn-toggle {{ count($previousEmployerData) == 0 ? 'active' : '' }}" onclick="recievedAnyIncomeShowHide(0, 'recieved_any_income_div_spouse');">No</label>

                        <input type="radio" name="recieved_any_income" id="recieved-any-income-yes" class="d-none required" value="1" {{ count($previousEmployerData) > 0 ? 'checked' : '' }}>
                        <label for="recieved-any-income-yes" class="btn-toggle {{ count($previousEmployerData) > 0 ? 'active' : '' }}" onclick="recievedAnyIncomeShowHide(1, 'recieved_any_income_div_spouse');">Yes</label>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ count($previousEmployerData) == 0 ? 'hide-data' : '' }} recieved_any_income_div_spouse" id="data-previous-employer-spouse">
                @include("client.questionnaire.income.common.parent_previous_employer", ['debType' => 'spouse', 'form_id' => 'client_income_step2'])
            </div>

        </div>
    </form>
</div>

<div class="bottom-btn-div">
    @if(!empty($debtorspouseemployer['id']))
        <input type="hidden" class="property_vehicle_ids" name="id" value="{{ !empty($debtorspouseemployer['id']) ? $debtorspouseemployer['id'] : '' }}">
        <a href="{{ route('client_income_step2') }}" class="btn-new-ui-default mr-2 {{ ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back to Previous Page</a>
        <button type="button" class="btn-new-ui-default" onclick="submitIncomeDebtorStep('income_step2_employer', 'client_income_step2')" >Save & Next <i class="feather icon-chevron-right mr-0"></i></button>
    @else
        <a href="{{ route('client_income_step2') }}" class="btn-new-ui-default mr-2 {{ ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back to Previous Page</a>
        <button type="button" class="btn-new-ui-default" onclick="submitIncomeDebtorStep('income_step2_employer', 'client_income_step2')">Save & Next <i class="feather icon-chevron-right mr-0"></i></button>
    @endif
</div>

@if(Route::currentRouteName() == 'client_income_step1' && (Auth::user()->client_subscription == \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION || (in_array(Auth::user()->client_payroll_assistant, [Helper::PAYROLL_ASSISTANT_TYPE_CODEBTOR, Helper::PAYROLL_ASSISTANT_TYPE_BOTH]))))
    <script>
        window.__spouseEmployerCondition = true;
    </script>
@endif
