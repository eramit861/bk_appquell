<div class="col-12">
    <div class="mcard">
        <div class="mcard-body">
            <div class="card-title-header">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-sm-4">
                        <h4>
                            <i class="bi bi-person-circle tab-link-color"></i> 
                            <span class="tab-link-color">Client {{ isset($val['name']) ? '- '.$val['name'] : '' }}</span>
                        </h4>
                    </div>
                    <div class="col-lg-8 col-md-4 col-sm-8 col-12 float_right">
                        <a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()" ><img alt="AI" src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px"> See AI Processed Docs Status</a>
                    </div>
                </div>
            </div>

            <div class="row py-1 w-100 m-0">
                <div class="col-12 col-xl-9 col-md-8 col-sm-12 label-spac d-flex align-items-center">
                    <div class="row w-100">
                        <h4 class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-0 card-title pb-0 bb-0-i"><span class="tab-link-color">Client Id: {{ $val['id'] }}</span></h4>
                        <h4 class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-0 card-title pb-0 bb-0-i"><span class="tab-link-color">Date: {{ $formated_DATETIME }}</span></h4>
                        <h4 class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-0 card-title pb-0 bb-0-i"><span class="tab-link-color">Client Type: {{ ($val['client_type'] > 0) ? \App\Helpers\ArrayHelper::getClientTypeLabelArray($val['client_type']) : '' }}</span></h4>
                        <h4 class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-0 card-title pb-0 bb-0-i "><span class="tab-link-color">Status: {{ \App\Helpers\ArrayHelper::getActiveInactiveArray($val['user_status']) }}</span></h4>
                    </div>
                </div>
                @if (env('ENABLED_CREDIT_COUNCELING', false) == true)
                    <div class="col-12 col-xl-3 col-md-4 col-sm-12 pr-0">
                        <div class="float_right d-flex">
                        <a class="btn border-blue-big  f-12 btn-new-ui-default ml-3 mb-0" onclick="creditCounselingRequest({{ $val['id'] }})" href="javascript:void(0)">
                                <span>
                                    Credit Counseling popup
                                </span>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="col-12 col-xl-12 col-md-12 col-sm-12 pr-0">
                    <div class="float_right edit-que-div edit-que-div-kr">
                        <button class="accordion-button collapsed btn-new-ui-default" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                            <span class="w-100 text-center">Allow client to edit questionnaire</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 pl-0 pr-0">
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="" >
                        <div class="accordion-body w-100 mt-3">
                            <div class="card-body w-100 p-0 b-none">
                                <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
                                        <div class="table-responsive">
                                            @include('attorney.client.edit_que_accordian_data')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <h4 class="card-title"></h4>

            @if ($type == 'view')
                <div class="w-100 row justify-content-end align-items-center submission_header_buttons m-0 ">
                    <div class="col-3 col-md-2 header_button_20 pl-1 pr-1">
                        <div class="light-gray-div p-0 m-0 b-0-i w-100">
                            <div class="label-div m-0 b-0-i">
                                <select name="export" style="width:100%;" class="form-control border-1px-green tab-link-color m-0" data-popup-route="{{ route('free_package_purchase_popup') }}" data-payment-pending="{{ $val['free_package_unpaid'] ?? 0 }}" onchange="exportreport(this)">
                                    <option value="0">Export Questionnaire to:</option>
                                    <option value="1">Jubilee Pro</option>
                                    <option value="2">CSV (BCI)</option>
                                    <option value="3">BK Pro Creditor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-md-1 header_button_20 pl-1 pr-1">
                        <div class="light-gray-div p-0 m-0 b-0-i w-100">
                            <div class="label-div m-0 b-0-i">
                                <select style="width:100%;" name="print" class="form-control border-1px-tab-link-color tab-link-color m-0" onchange="printreport(this)">
                                    <option value="0">Print:</option>
                                    <option value="1">Entire Questionnaire</option>
                                    <option value="2">Asset Report</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3 col-md-2 header_button_20 pl-1 pr-1">
                        <a class="btn border-blue-big f-12 btn-new-ui-default m-0 w-100" href="javascript:void(0)" onclick="paralegalCheckPopup()">
                            <span>Paralegal Check</span>
                        </a>
                    </div>

                    <div class="col-3 col-md-2 header_button_20 pl-1 pr-1">
                        <a onclick="show_notes()" class="back-btn btn btn-new-ui-default print-hide m-0 w-100">
                            Client Case Notes
                        </a>
                    </div>
                </div>

                <h4 class="card-title"></h4>
            @endif
        </div>
    </div>
</div>
<style>
    .large-fb-width{min-width: 90vw !important;}
</style>

<style>
    .edit-que-div-kr {
        margin-top: 8px;
    }
	@media only screen and (max-width: 1024px) {
		#facebox .content.fbminwidth{
			min-width: 100% !important;
		}

		#facebox{
			left: unset !important;
			max-width: 100% !important;
			width: 100% !important;
		}

		#facebox .popup{
			max-width: 100%;
			width: 100%;
		}
	}
</style>

@push('scripts')
<script>
    window.CommonClientDescriptionConfig = {
        clientId: {{ $val['id'] }},
        creditCounselingPopupRoute: "{{ route('credit_counseling_popup') }}",
        allowClientEditQuesRoute: "{{ route('allow_client_edit_ques') }}",
        formSubmissionViewRoute: "{{ route('attorney_form_submission_view', ['id' => $val['id']]) }}"
    };
</script>
<script src="{{ asset('js/common-client-description.js') }}"></script>
@endpush