@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")
<script src="{{ asset('assets/js/facebox.js' )}}"></script>


@php
use App\Helpers\Helper;

$val = $User;
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
$unreadcount = \App\Models\SignedDocuments::where(['attorney_id' => Auth::user()->id, 'client_id' => $val['id'], 'read_by_attorney' => 0])->whereNotNull('sign_document')->count();
$notIn = ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs', 'document_sign', 'signed_document'];
$unreadDoccount = \App\Models\ClientDocumentUploaded::where(['client_id' => $val['id'], 'is_viewed_by_attorney' => 0])->whereNotIn('document_type', $notIn)->count();
$date = date_create($val['created_at']);
$formated_DATETIME = date_format($date, 'M dS, Y');
$attorney_id = Helper::getCurrentAttorneyId();
$attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorney_id])->select(['attorney_enabled_bank_statment'])->first();
$attorney_enabled_bank_statment = !empty($attorneySettings) ? $attorneySettings->attorney_enabled_bank_statment : 1;
$formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $val['id']])->first();
$payrollRoute = route('client_paystub', ['id' => $val['id'], 'type' => 'paystub']);
if ($val['client_payroll_assistant'] == 2) {
    $payrollRoute = route('client_paystub_partner', ['id' => $val['id'], 'type' => 'paystub']);
}
$docsMisc = $attorneyDocs;
array_push($docsMisc, 'Miscellaneous_Doucments');
$cardsArray = \App\Models\ClientDocumentUploaded::getCardTypeArray();
$allDocs = $documentuploaded;
$autoloankeys = array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1));
$mortloankeys = array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(1));
@endphp
<div class="row uploaded-docs">

    @include('attorney.client.manage.common_client_description')

    <div class="col-12">
        <div class="card information-area mt-3">

            @include('attorney.client.manage.common_tab_links')

            <div class="card-body border-top-left-radius-none">
                <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
                        <div class="row gx-3 main-title" id="">
                            <div class="col-12">
                                <div class="outline-gray-border-area">
                                    <div class="section-title-div mt-0 mt-xl-3 flex-column flex-xl-row pb-2 align-items-start">
                                        <h3 class="mb-3 mb-xl-0">Documents Uploaded by your Client</h3>
                                        <div class="section-edit-div" onclick="copy()">
                                            <a href="javascript:void(0)" class="text-c-green"> Click the link to send the client directly to the document upload page—no login required:
                                                <span class="text-bold uploaded-docs lh-18px" style="min-width: 80px !important;" id="copy_url">{{$manual_doc_url}}<i class="fas fa-copy ml-2"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                @include("attorney.doc_mgmt.screen_wrapper")
                            </div>

                            @foreach ($mainDocumentTypeStructure as $key => $childObject)
                                @php
                                // set 1 for is statement
                                $isStatements = in_array($key, ['parentPaypalVenmoCashDocuments', 'parentBankDocuments', 'parentBrokerageDocuments']) ? 1 : 0;
                                // set 1 for is paystub
                                $isPaystub = in_array($key, ['parentIncomeDocuments']) ? 1 : 0;

                                $documentStyle = ArrayHelper::getParentDocumentStyle($key);
                                $parentClass = Helper::validate_key_value('class', $documentStyle);
                                $parentIcon = Helper::validate_key_value('icon', $documentStyle);
                                $parentIcon = empty($parentIcon) ? 'assets/img/black_icons/attorney_docs.svg' : $parentIcon;
                                $parentIcon = asset($parentIcon);
                                @endphp
                                <div class="col-12">
                                    <div class="section-title-div {{ $parentClass }} border-0">
                                        <h3 class="d-flex-ai-center">
                                            <img src="{{ $parentIcon }}" class="me-2" style="height:36px" alt="icon">
                                            {{ Helper::validate_key_value($key, $allDocNames) }}
                                        </h3>
                                        @if ($key == 'Post_submission_documents')
                                            {{-- <input type="text" class="form-control input_capitalize save-post-submission-input w-auto ml-auto mr-3" placeholder="Add Client Post Submission Doc">
                                            <button class="upload_doc_line view_client_btn save-post-submission-btn upload-doc-btn p-2 fs-mob-10px" onclick="savePostSubmissionDoc()">Add Client Post Submission Doc</button> --}}
                                            <button class="upload_doc_line view_client_btn upload-doc-btn p-2 fs-mob-10px" onclick="openChoosePostSubmissionModal()">Choose from Existing Docs</button>
                                        @endif
                                    </div>
                                </div>

                                @if (!empty($childObject))
                                    @if (in_array($key, ['parentSecuredDocuments', 'parentUnsecuredDocuments', 'parentMiscAttorneyDocuments']))
                                        @foreach ($childObject as $childObjKey => $subChild)
                                            @if (isset($subChild) && !empty($subChild))
                                                <div class="col-12">
                                                    <div class="parent-light-gray-div mt-3 mb-3 d-block light-gray-div">
                                                        <h2>{!! ($key == 'parentUnsecuredDocuments') ? Helper::validate_key_value($key, $allDocNames) : Helper::validate_key_value($childObjKey, $allDocNames) !!}</h2>
                                                        <div class="row gx-3">
                                                            @if ($key == 'parentSecuredDocuments')
                                                                @foreach ($subChild as $securedObjKey => $securedDocs)
                                                                    @if ($securedObjKey == 'Insurance_Documents')
                                                                        @include('attorney.uploaded_doc_view.docMainColDiv', ['objKey' => $securedObjKey, 'docs' => $securedDocs[$securedObjKey]])
                                                                    @else
                                                                        @include('attorney.uploaded_doc_view.docSecuredDebtColDiv')
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                @foreach ($subChild as $objKey => $docs)
                                                                    @include('attorney.uploaded_doc_view.docMainColDiv')
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @elseif (in_array($key, ['parentIncomeDocuments']))
                                        @php $acceptType = '.heic, .png, .jpg, .jpeg, .pdf,.doc,.docx'; @endphp
                                        @foreach ($childObject as $childObjKey => $subChild)
                                            @include('attorney.uploaded_doc_view.docPayStubColDiv', ['parentKey' => $key])
                                        @endforeach
                                    @elseif (in_array($key, ['parentFormDocuments']))
                                        @if (!empty($totals) && $totals == 6)
                                            @foreach ($childObject as $objKey => $docs)
                                                @include('attorney.uploaded_doc_view.docFormsColDiv')
                                            @endforeach
                                        @endif
                                    @else
                                        @foreach ($childObject as $objKey => $docs)
                                            @include('attorney.uploaded_doc_view.docMainColDiv')
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var selectedFiles = [];

    function replaceAll(str, term, replacement) {
        return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
    }

    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    function calculateUploadBtnClick(dType, dataFor, employer_id) {

        if (!confirm('Are you sure you want to process all payroll documents through Payroll Assistant BKQ AI?')) {
            return;
        }

        $.systemMessage(`BKQ AI is pulling all of the ${dataFor}'s payroll data from the uploaded pay stubs and importing it to Payroll Assistant with AI. Please be patient the magic takes a few minutes.`, 'alert--process toast-bg-purple');

        var client_id = '{{ $client_id ?? '' }}';
        var url = '{{ route('process_by_graphql') }}';
        laws.ajax(url, {
            document_type: dType,
            client_id: client_id,
            employer_id: employer_id
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success toast-bg-purple', true);
            }
		});

    }
    
    function setDataType(type) {
        $('#document_types').val(type);
    }
</script>

<!-- Common Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" style="height: 100vh;">
                <iframe id="pdfViewer" src="" style="width: 100%; height: 90%; border: none; display: block;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Modal content-->
<div id="reorder_pdf" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Reorder PDF <span class="text text-secondary">(Drag and drop to reorder the PDFs)</span></h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
                <div class="modal-spinner d-flex justify-content-center align-items-center">
                    <i class="fa fa-spinner fa-spin"> </i><span class="ml-2">Thumbnails are loading</span>
                </div>
			</div>
			<div class="modal-footer">
				<a type="button" id="reorder_pdf_submit" class="btn btn-primary">Download PDF</a>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="image_preview" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable" style="max-width: 1200px !important">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Preview Image</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<img class="w-100" src="" alt="image">
			</div>
		</div>
	</div>
</div>

@include('client.uploaddoc_mode',['client_id' => $client_id,'route' => route('upload_client_date', ['client_id' => $client_id]), "bank_statement_months" => $bank_statement_months, 'isManual' => false,'max_size' => 20000, 'isAttorneyDocPage' => true])
@include('attorney.doc_mgmt.attorney_doc_script')
@include('modal.attorney.document_management.choose_from_existing_docs')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/attorney/uploaded-document-view.css') }}">
@endpush
@endsection