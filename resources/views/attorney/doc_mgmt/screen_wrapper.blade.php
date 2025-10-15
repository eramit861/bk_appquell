<div class="questionnaire-wrapper-content">
    <div class="questionnaire-main-title pt-0">
        <div class="row attorney-listing dis_client">

            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center align-item-center w-100">
                            <label class="custom-card package package-101 mt-2 w-100">
                                <input onchange="enableNotification('email','{{ $client_id }}',this)"
                                    data-r="{{$User['document_email_notification']}}" type="checkbox"
                                    class="w-auto email_notification" id="document_email_notification"
                                    name="document_email_notification" value="1"
                                    {{ $User['document_email_notification'] == 1 ? 'checked' : '' }}>
                                <span class="radio-btn notification-btn" style="width: 100% !important">
                                    <i class="fas fa-check"></i>
                                    <div class="package-desc">
                                        <p class="text-bold ">Email Notification <small class="text-bold">(every
                                                upload)</small></p>
                                    </div>
                                </span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-center align-item-center w-100">
                            <label class="custom-card package package-101 w-100">
                                <input {{ $User['document_pushed_notification'] == 1 ? 'checked' : '' }}
                                    type="checkbox" id="document_pushed_notification"
                                    onchange="enableNotification('push','{{ $client_id }}',this)"
                                    name="document_pushed_notification" value="1" class="w-auto  push_notification">
                                <span class="radio-btn notification-btn" style="width: 100% !important">
                                    <i class="fas fa-check"></i>
                                    <div class="package-desc">
                                        <p class="text-bold ">Push Notification <small class="text-bold">(every
                                                upload)</small></p>
                                    </div>
                                </span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-center align-item-center w-100">
                            <label class="custom-card package package-101 mb-0 w-100">
                                <input onchange="enablePostSub('{{ $client_id }}')"
                                    data-r="{{$post_submission_documents_enabled}}" type="checkbox"
                                    class="w-auto post_submission_documents_enabled" id="post_submission_documents_enabled"
                                    name="post_submission_documents_enabled" value="1"
                                    {{ $post_submission_documents_enabled == 1 ? 'checked' : '' }}>


                                <span class="radio-btn" style="width: 100% !important">
                                    <i class="fas fa-check"></i>
                                    <div class="package-desc">
                                        <p class="text-bold ">Post Submission Documents <br /><small class="text-bold">(This allows your client to only use this to upload Docs)</small></p>
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-6 col-12">
                <div class="row h-100">

                    <div class="col-lg-4 col-md-6 col-sm-12 mt-1 d-flex  align-items-center w-100">
                      
                @if (Auth::user()->role == 1)
                <a class="green loginas height-max-content link-unerline w-100" href="{{ route('admin_client_login', ['id' => $val['id']]) }}">Login as client <i class="fas fa-sign-in-alt fa-lg" title="Login into your client dashboard"></i></a>
                @endif
                @if (Auth::user()->role == 2)
                <a class="green loginas height-max-content link-unerline w-100" href="{{ route('attorney_client_login', ['id' => $val['id']]) }}">Login as client <i class="fas fa-sign-in-alt fa-lg" title="Login into your client dashboard"></i></a>
                @endif
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-1 w-100  d-flex justify-content-center align-items-center flex-column">

                        <label class="custom-card package package-101 m-0 w-100" onclick="openDocumentsListPopup({{ $val['id'] }})">
                            <span class="doc-radio-btn radio-btn m-0 w-100 d-flex justify-content-center align-items-center" style="width: 100% !important">
                                <div class="doc-request-btn">
                                    <p class="text-bold px-1 text-c-light-blue "> <i title="Documents" class="fas fa-file-alt mr-2 text-c-light-blue"></i>Send Client Document(s) Request</p>
                                </div>
                            </span>
                        </label>

                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 m-0 d-flex justify-content-center align-items-center flex-column">
                        <div class="w-100">
                            <label class="custom-card mt-1 package package-101 w-100">
                                <a class="text-bold radio-btn notification-btn w-100" href="{{route('document_checklist', ['id' => $User['id']])}}">
                                    <span class="text-dark package-desc">
                                        Download Document Checklist
                                    </span>
                                </a>
                            </label>
                        </div>
                        <div id="download-docs-container" class="w-100 mt-1">
                            <a id="generate-zip" href="javascript:void(0)">
                                <div id="progress-bar"></div>
                                <span id="zip-download-main-text">
                                    <span style="display: inline-block">Click here to Download</span>
                                    <span style="display: inline-block">Client Doc(s)</span>
                                </span>
                                <span id="zip-download-progress-text">

                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Include optimized JavaScript using Laravel standard stack -->
<script src="{{ asset('assets/js/attorney/document-management.js') }}" defer></script>
<script>
    // Initialize Document Management Manager
    document.addEventListener('DOMContentLoaded', function() {
        window.documentManagementClientId = {{ $client_id }};
        window.documentManagementCsrfToken = '{{ csrf_token() }}';
        window.documentManagementGenerateZipUrl = '/generate-zip';
        window.documentManagementProgressUrl = '/progress';
    });
</script>
@endpush

@push('styles')
<!-- Include optimized CSS using Laravel standard stack -->
<link href="{{ asset('assets/css/attorney/document-management.css') }}" rel="stylesheet">
@endpush