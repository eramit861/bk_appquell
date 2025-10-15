<div class="modal fade" id="previewQuestionsModal" tabindex="-1" aria-labelledby="previewQuestionsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-xxl">
        <div class="modal-content modal-content-div ">
@php
$spouseClass = "hide-data d2_info";
if ($details['martial_status'] == 1 || $details['martial_status'] == 2) {
    $spouseClass = " d2_info";
}

$showDebtorSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'debtor_ssn');
$showDebtorDL = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'licence_or_id');
$showSpouseSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'codebtor_ssn');
$showEmergencySection = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'emergency_checks');
$showDiscoverUsSection = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'discover_us');
$intakeFormID = Helper::validate_key_value('id', $details, 'radio');
$step_1_submited = Helper::validate_key_value('step_1_submited', $details, 'radio');
$step_2_submited = Helper::validate_key_value('step_2_submited', $details, 'radio');
$step_3_submited = Helper::validate_key_value('step_3_submited', $details, 'radio');

$isShortForm = Helper::validate_key_value('step_completed', $details, 'radio');
$showOtherPropertySection = '';
if (empty($details['other_property_let_go_item']) && empty($details['other_property_new_stuff']) && empty($details['other_property_valued_possession'])) {
    $showOtherPropertySection = 'd-none';
}
@endphp
            <div class="modal-header align-items-center">
                <h5 class="modal-title w-100" id="previewQuestionsModalLabel">Initial Client Intake Details:</h5>
                <!-- <a href="javascript:void(0)" onclick="openHistoryLogsModal('', {{ $intakeFormID }})"
                    class="btn m-0 close-modal bg-white btn-new-ui-default font-weight-bold border-blue-big f-12 float-right print-btn mr-2 {{ !empty($historyLog) ? '' : 'hide-data' }}"> --}}
                    <i class="bi bi-clock-history"></i>
                    <span class="card-title-text">History</span>
                </a>  -->
                @if($is_print == 0)
                <a href="javascript:void(0)" onclick="printDiv('printableArea')"
                    class="btn m-0 close-modal bg-white btn-new-ui-default font-weight-bold border-blue-big f-12 float-right print-btn">
                    <i class="bi bi-printer"></i>
                    <span class="card-title-text">Print</span>
                </a>
                @endif
                <button type="button" class="btn-close white-btn pt-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light-gray" id="printableArea">
                <div class="row gx-3 ">
                    <div class="col-12 col-md-8 data-div scrollable-div">

                        <div class="debtor-basic-info parent">
                            @include('modal.attorney.client_intake_management.preview.basic_info_debtor')
                        </div>
                        <div class="marital-info parent">
                            @include('modal.attorney.client_intake_management.preview.marital_status')
                        </div>
                        <div class="spouse-basic-info parent">
                            @include('modal.attorney.client_intake_management.preview.basic_info_spouse')
                        </div>
                        <div class="emergency-info parent {{ $showEmergencySection }}">
                            @include('modal.attorney.client_intake_management.preview.emergency_checks')
                        </div>
                        <div class="discover-us-info parent {{ $showDiscoverUsSection }}">
                            @include('modal.attorney.client_intake_management.preview.discover_us')
                        </div>
                        @if(($step_1_submited == 1 && $step_2_submited == 1) || ($isShortForm == 0))
                        <div class="debtor-income-info parent row">
                            @include('modal.attorney.client_intake_management.preview.monthly_income_debtor')
                        </div>
                        <div class="spouse-income-info parent row">
                            @include('modal.attorney.client_intake_management.preview.monthly_income_spouse')
                        </div>
                        <div class="mortgage-info parent">
                            @include('modal.attorney.client_intake_management.preview.mortgage')
                        </div>
                        <div class="vehicles-info parent">
                            @include('modal.attorney.client_intake_management.preview.vehicles')
                        </div>
                        <div class="other-property-info parent {{ $showOtherPropertySection }}">
                            @include('modal.attorney.client_intake_management.preview.other_property')
                        </div>
                        @endif
                        @if(($step_1_submited == 1 && $step_2_submited == 1 && $step_3_submited == 1) || ($isShortForm == 0))
                        <div class="secured-loan-info parent">
                            @include('modal.attorney.client_intake_management.preview.secured_loan')
                        </div>
                        <div class="back-tax-info parent">
                            @include('modal.attorney.client_intake_management.preview.back_tax')
                        </div>
                        <div class="other-debt-info parent">
                            @include('modal.attorney.client_intake_management.preview.other_debt')
                        </div>
                        <div class="attorney-ques-info parent">
                            @include('modal.attorney.client_intake_management.preview.att_que')
                        </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-4 pt-3 px-3 notes-section">
                        {!! $notesForm !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
