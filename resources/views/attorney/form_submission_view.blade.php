@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash",['auto_close' => false])

@php
    $val = $User;
    $BasicInfoPartA = $basic_info['BasicInfoPartA'] ?? '';
    $BasicInfoPartB = $basic_info['BasicInfoPartB'] ?? '';
    $BasicInfo_PartRestD = Helper::validate_key_value('BasicInfo_PartRestD', $basic_info);
    $businessEIN = Helper::key_display('used_business_ein', $BasicInfo_PartRestD);
    $ssn1 = (Helper::validate_key_value('has_security_number', $BasicInfoPartA) != '1') ? Helper::validate_key_value('security_number', $BasicInfoPartA) : '';
    $usedbizdata = [];
    if (!empty($BasicInfo_PartRestD['used_business_ein_data'])) {
        $usedbizdata = !empty($BasicInfo_PartRestD['used_business_ein_data']) ? $BasicInfo_PartRestD['used_business_ein_data'] : [];
    }

    $client_type = $val['client_type'];
    $BIData = \App\Services\Client\CacheBasicInfo::getBasicInformationData($val['id']);
    $clientBasicInfoPartA = \App\Helpers\Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
    $clientBasicInfoPartB = \App\Helpers\Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
    $debtorname = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor's");
    $spousename = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor's");
    
    if ($User->client_type == 2) {
        $spousename = "Non-Filing Spouse's";
    }

    $loggedInUserName = 'BKQ Admin';
    if (!empty($loggedInUser)) {
        $loggedInUserName = ($loggedInUser->role == 1) ? 'BKQ Admin' : $loggedInUser->name;
    }

    $attorney_id = Helper::getCurrentAttorneyId();
    $unreadcount = \App\Models\SignedDocuments::where(['attorney_id' => $attorney_id, 'client_id' => $val['id'],'read_by_attorney' => 0])->whereNotNull('sign_document')->count();
    $notIn = ['document_sign','signed_document'];
    $unreadDoccountArray = (new \App\Models\ClientDocumentUploadedData())->getClientUploadDocData($val['id'], $attorney_id);
    $unreadDoccount = isset($unreadDoccountArray['unreadDocuments']) && is_array($unreadDoccountArray['unreadDocuments']) ? count($unreadDoccountArray['unreadDocuments']) : 0;
    $date = date_create($val['created_at']);
    $formated_DATETIME = date_format($date, 'M dS, Y');
    $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($val['id']);
    $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
    $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
    $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId,'is_associate' => $is_associate])->select(['attorney_enabled_bank_statment'])->first();
    $attorney_enabled_bank_statment = !empty($attorneySettings) ? $attorneySettings->attorney_enabled_bank_statment : 1;
    $formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $val['id']])->first();
    $payrollRoute = route('client_paystub', ['id' => $val['id'], 'type' => 'paystub']);
    if ($val['client_payroll_assistant'] == 2) {
        $payrollRoute = route('client_paystub_partner', ['id' => $val['id'], 'type' => 'paystub']);
    }
    $assetSaveRoute = route('update_property_asset_att_side');
@endphp

<div class="row">
	 {{-- @include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type]) --}}
	@include('attorney.client.manage.common_client_description')

    <div class="col-12">
        <div class="card information-area mt-3">
			
			@include('attorney.client.manage.common_tab_links')
            
            <div class="card-body border-top-left-radius-none ">
                <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
                    <div class="tab-pane fade show active mcard-body " id="active" role="tabpanel" aria-labelledby="" tabindex="0">
						<div class="grid-tab-container" id="pills-tab" role="tablist">
								<button class="btn-new-ui-default w-100 active" id="preview-view-all-tab" data-bs-toggle="pill" data-bs-target="#preview-view-all" type="button" role="tab" aria-controls="preview-view-all" aria-selected="true">View Entire Questionnaire</button>
								<button class="btn-new-ui-default w-100" id="preview-basic-information-tab" data-bs-toggle="pill" data-bs-target="#preview-basic-information" type="button" role="tab" aria-controls="preview-basic-information" aria-selected="true">Basic Information</button>
								<button class="btn-new-ui-default w-100" id="preview-real-property-tab" data-bs-toggle="pill" data-bs-target="#preview-real-property" type="button" role="tab" aria-controls="preview-real-property" aria-selected="true">Real Property</button>
								<button class="btn-new-ui-default w-100" id="preview-vehicles-tab" data-bs-toggle="pill" data-bs-target="#preview-vehicles" type="button" role="tab" aria-controls="preview-vehicles" aria-selected="true">Vehicles</button>
								<button class="btn-new-ui-default w-100" id="preview-personal-property-tab" data-bs-toggle="pill" data-bs-target="#preview-personal-property" type="button" role="tab" aria-controls="preview-personal-property" aria-selected="true">Client Property</button>
								<button class="btn-new-ui-default w-100" id="preview-scroll-debts-tab" data-bs-toggle="pill" data-bs-target="#preview-scroll-debts" type="button" role="tab" aria-controls="preview-scroll-debts" aria-selected="true">Debts</button>
								<button class="btn-new-ui-default w-100" id="preview-current-income-tab" data-bs-toggle="pill" data-bs-target="#preview-current-income" type="button" role="tab" aria-controls="preview-current-income" aria-selected="true">Income</button>
								<button class="btn-new-ui-default w-100" id="preview-current-expenses-tab" data-bs-toggle="pill" data-bs-target="#preview-current-expenses" type="button" role="tab" aria-controls="preview-current-expenses" aria-selected="true">Expenses</button>
								<button class="btn-new-ui-default w-100" id="preview-financial-affairs-tab" data-bs-toggle="pill" data-bs-target="#preview-financial-affairs" type="button" role="tab" aria-controls="preview-financial-affairs" aria-selected="true">Financial Affairs</button>
						</div>
						<h4 class="card-title"></h4>
						<div class="card-body border-top-left-radius-none b-none px-0">
							<div class="tab-content bg-unset p-0 box-shadow-unset" >
                                @if($is_confirm_prompt_enabled == 1)
                                    @include('attorney.client.preview.defaultWithPrompt')
                                @else
                                    @include('attorney.client.preview.default')
                                @endif
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="secondaryModalBs" tabindex="-1" aria-labelledby="secondaryModalBsLabel" aria-hidden="true" style="z-index: 9999; background-color: rgba(0, 0, 0, 0.7);">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="secondaryModalBsLabel">Dynamic Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="secondaryModalBsBody">
                <!-- Content will be injected here -->
            </div>
        </div>
    </div>
</div>

@php
    // Calculate total monthly expenses
    $Total_monthly_expenses_list_toShow = App\Helpers\ClientHelper::getTotalExpense($expenses_info);
    $Total_monthly_expenses_list_spouse = 0;
    if (!empty($expenses_info['live_separately'])) {
        $Total_monthly_expenses_list_spouse = App\Helpers\ClientHelper::getTotalExpense($spouse_expenses_info, true);
    }
    $Total_monthly_expenses_list_toShow = ((float)str_replace(',', '', $Total_monthly_expenses_list_toShow) + (float)str_replace(',', '', $Total_monthly_expenses_list_spouse));
    $Total_monthly_expenses_list_toShow = number_format($Total_monthly_expenses_list_toShow, 2, '.', ',');

    // Calculate net income
    $debtorNetIncome = \App\Models\IncomeDebtorMonthlyIncome::getNetIncome($income_info['debtormonthlyincome']);
    $spouseNetIncome = !empty($income_info['debtorspousemonthlyincome']) ? \App\Models\IncomeDebtorSpouseMonthlyIncome::getNetIncome($income_info['debtorspousemonthlyincome']) : 0;
@endphp
<style>
	#facebox{width:90%;margin-left: 5%;}
</style>

@push('scripts')
<script>
    window.FormSubmissionViewConfig = {
        clientId: '{{ $client_id }}',
        valId: '{{ $val['id'] }}',
        totalMonthlyExpenses: '{{ $Total_monthly_expenses_list_toShow }}',
        assetSaveRoute: "{{ $assetSaveRoute }}",
        routes: {
            downloadJublieeImportPopup: "{{ route('download_jubliee_import_popup', ['id' => $client_id]) }}",
            downloadAttorneyBciPopup: "{{ route('download_attorney_bci_popup', ['id' => $client_id]) }}",
            downloadClientCreditorsXls: "{{ route('download_client_creditors_xls', ['id'=> $client_id])}}",
            checkForNotes: "{{ route('check_for_notes') }}",
            addProfitLossToClientZip: "{{ route('add_profit_loss_to_client_zip') }}",
            meanTestPopup: "{{ route('mean_test_popup') }}",
            updateReviewStatus: "{{ route('update_review_status') }}"
        }
    };
</script>
<script src="{{ asset('assets/js/attorney/form-submission-view.js') }}"></script>
@endpush

@if($detailed_property == 1)
@push('scripts')
<script>
    window.FormSubmissionViewConfig.detailedPropertyEnabled = true;
</script>
@endpush
@endif

@endsection

@if(session('download_url'))
    <script>
        window.onload = function() {
            const link = document.createElement('a');
            link.href = "{{ session('download_url') }}";
            link.setAttribute('download', '');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };
    </script>
@endif