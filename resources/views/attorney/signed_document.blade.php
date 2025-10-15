@extends('layouts.attorney', ['video' => $video])
@section('content')
@include('layouts.flash')
@php
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
        $loggedInUserName = ($loggedInUser->role == 1) ? 'BKQ Admin' : $loggedInUser->name ;
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

    $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['attorney_enabled_bank_statment'])->first();
    $attorney_enabled_bank_statment = !empty($attorneySettings) ? $attorneySettings->attorney_enabled_bank_statment : 1;
    $formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $val['id']])->first();
    $payrollRoute = route('client_paystub', ['id' => $val['id'], 'type' => 'paystub']);
    if ($val['client_payroll_assistant'] == 2) {
        $payrollRoute = route('client_paystub_partner', ['id' => $val['id'], 'type' => 'paystub']);
    }
@endphp

<div class="row doc_portal_tab">
	<!-- @include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type]) -->
	@include('attorney.client.manage.common_client_description')

    <div class="col-12">
        <div class="card information-area mt-3">
			
			@include('attorney.client.manage.common_tab_links')
            
            <div class="card-body border-top-left-radius-none">
                <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">

                        <div class="light-gray-div mt-3">
                            <h2>Upload Documents to Client - (File should be a PDF) (File size up to 500 MB)</h2>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="upload-documents-wrapper mb-3">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12">
                                                <div class=" upload-border mx-auto">
                                                    @include('client.upload_doc_form',['route' => route('save_signed_document', $client_id), 'max_size' => 500, 'signedDoc' => true])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 doc_send_to_client">
                                <div class="light-gray-div mt-3">
                                    <h2>Documents sent to client:</h2>
                                    <div class="row gx-3 px-2">
                                        @php $i = 1; @endphp
                                        @foreach ($uploadedFiles as $key => $file)
                                            <div class="w-20 uploaded_files_card">

                                                <p class="w-100 mb-0 text-c-green" style="font-size: 9px;font-weight: bold;font-style: italic;">
                                                    @if (isset($file['viewed_at']) && !empty($file['viewed_at']))
                                                        Client opened file:
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </p>
                                                <p class="w-100 mb-0 text-c-green" style="font-size: 9px;font-weight: bold;font-style: italic;">
                                                    @if (isset($file['viewed_at']) && !empty($file['viewed_at']))
                                                        {{ \Carbon\Carbon::createFromTimestamp($file['viewed_at'])->format('m/d/Y H:i:s') }}
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </p>
                                                <div class="logoWrap m-0">
                                                    <a title="click here to download" target="_blank" href="{{ \Storage::disk('s3')->temporaryUrl($file['path'], now()->addDays(2)) }}"
                                                        download>
                                                    
                                                        <div class="logothumb">
                                                            <img src="{{ url('assets/img/pdf-icon.svg') }}" width="60" title="" alt="pdf icon">
                                                        </div>
                                                    </a>
                                                    <span class="fix_delete"><a onclick="confirmDeleteDoc(this)"
                                                            href="javascript:void(0)" id="{{ route('attorney_delete_signed_doc', ['id' => $User->id, 'file_name' => $file['name']]) }}"><i
                                                                class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title=""
                                                                data-original-title="Delete"></i></a></span>
                                                </div>
                                                <p style="font-size:10px;width:100%;text-align:center;word-wrap:break-word;">
                                                    <strong>{{ $file['name'] }}</strong>
                                                </p>

                                            </div>
                                        @php $i++; @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-6 doc_received_by_client">
                                <div class="light-gray-div mt-3">
                                    <h2>Documents received by client:</h2>
                                    <div class="row gx-3 px-2">
                                        @php $i = 1; @endphp
                                        @foreach ($client_doc_list as $key => $file)
                                            <div class="w-20 client_uploaded_files_card">
                                                <small style="font-size: 9px;font-weight: bold;font-style: italic;">
                                                @php $date = \Storage::disk('s3')->lastModified($file['path']); @endphp
                                                {{ \Carbon\Carbon::createFromTimestamp($date)->format('m/d/Y H:i:s') }}
                                                </small>
                                                <div class="recieved_doc logoWrap m-0">
                                                    <a title="click here to download" onclick="markreadurl({{$client_id}},'{{ $file['path'] }}')" target="_blank" href="{{ \Storage::disk('s3')->temporaryUrl($file['path'], now()->addDays(2)) }}"
                                                        download>
                                                        <div class="recieved_doc logothumb">
                                                            <img src="{{ url('assets/img/pdf-icon.svg') }}" width="60" title="" alt="pdf icon">
                                                        </div>
                                                    </a>
                                                </div>
                                                <p style="font-size:10px;width:100%;text-align:center;word-wrap:break-word;">
                                                    <strong>{{ $file['name'] }}</strong>
                                                </p>

                                            </div>
                                        @php $i++; @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-right pt-2">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@push('styles')
<!-- Include optimized CSS using Laravel standard stack -->
<link href="{{ asset('css/signed-document.css') }}" rel="stylesheet">
@endpush
    <script src="{{ asset('assets/js/upload-document.js') }}?v=10.0"></script>
    <script>
        submitForm = function() {
            $.systemMessage("Uploading documents..", 'alert--process');
            $("#form-both").submit();
        }

        markreadurl = function(client_id, doc_url){
            var requesturl = '{{ route("mark_signed_doc_read") }}';
		laws.ajax(requesturl, {client_id: client_id,doc_url: doc_url}, function(response) {
			var res = JSON.parse(response);
			
		});
        }
        confirmDeleteDoc = function(sobj) {
            var url = sobj.id;
            if (!confirm(langLbl.confirmDelete)) {
                return;
            }
            window.location = url;
        }

        jQuery(document).ready(function() {
            $("#file-1").on('change', function(data) {
                var imageFile = data.target.files[0];
                var type = data.target.files[0].type;
                var name = data.target.files[0].name;

                var reader = new FileReader();
                reader.readAsDataURL(imageFile);
                reader.onload = function(evt) {
                    $("#drop_file_name").html(name + " has been selected");
                    $("#drop_file_name").show();
                }
            });
        });
    </script>
@endsection
