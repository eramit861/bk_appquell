<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bankruptcy</title>
    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js' )}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}?v=3.10">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v=2.12" />
    <link rel="stylesheet" href="{{ asset('assets/css/client/guide_mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>

<body>    
    <div class="questionnaire-wrapper ">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="questionnaire-wrapper-content">
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <div class="col-md-12 ml-0 pr-0 mr-0 pl-0">
                            <h5 class="text-bold">Welcome, {{ auth()->user()->name }} to your Online Bankruptcy Questionnaire</h5>
                        </div>
                        <div class="col-md-12 ml-0 pr-0 mr-0 pl-0 d-flex justify-content-center">
                        @php
                            $videos = VideoHelper::getAdminVideos();
                            $mainTutorial = $videos[Helper::MAIN_DOCUMENT_TUTORIAL_VIDEO] ?? [];
                        @endphp
                            <iframe class=" mt-2 guide_video" src="{{ $mainTutorial['english_video'] ?? '' }}" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                        <div class="col-md-12 ml-0 pr-0 mr-0 pl-0">
                            <h4 class="mt-3 text-c-blue f-w-800">Please upload your documents first to access the questionnaire.</h4>
                            <p class="text-bold mb-2 mt-3">The below list lets you know which documents have been uploaded and which documents still need to be uploaded to continue to the questionnaire:</p>
                            <small class="text-bold text-c-gray">If any documents are listed in red go to the <u>Documents Tab</u> and upload them there.</small>
                            <ul class=" list-unstyled mt-3">
                                @php
                                    $list = $docsUploadInfo['list'] ?? null;
                                    $documentuploaded = $docsUploadInfo['documentuploaded'] ?? [];
                                    $attorneydocuments = $docsUploadInfo['attorneydocuments'] ?? null;
                                    $hidebtn = $docsUploadInfo['hidebtn'] ?? null;
                                    $client = $docsUploadInfo['client'] ?? null;
                                    $client_id = Auth::user()->id;
                                    $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();

                                    $documentTypes = Helper::getDocuments(Auth::user()->client_type, 0, 0, 0, 0, 0, $attorney->attorney_id);

                                    $residenceType = array_keys(Helper::getResidence());
                                    $vehicleType = array_keys(Helper::getVehicle());

                                    $residence = \App\Models\NotOwnDocuments::where('client_id', $client_id)->whereIn('document_type', $residenceType)->exists();
                                    $vehicle = \App\Models\NotOwnDocuments::where('client_id', $client_id)->whereIn('document_type', $vehicleType)->exists();

                                    $uploadedresidence = \App\Models\ClientDocumentUploaded::where('client_id', $client_id)->whereIn('document_type', $residenceType)->exists();
                                    $uploadedvehicle = \App\Models\ClientDocumentUploaded::where('client_id', $client_id)->whereIn('document_type', $vehicleType)->exists();

                                    $residenceUploaded = false;
                                    if ($residence == true || $uploadedresidence == true) {
                                        $residenceUploaded = true;
                                    }
                                    $vehicleUploaded = false;
                                    if ($vehicle == true || $uploadedvehicle == true) {
                                        $vehicleUploaded = true;
                                    }
                                @endphp

                                @foreach ($documentTypes as $key => $name)
                                    @if ($key != 'Miscellaneous_Documents')
                                        @php
                                            $fStatus = '';
                                            $uploadedClass = "font-color-fail";
                                            $renabledupload = false;
                                            $declineReason = '';
                                            $status = 0;
                                            $reason = '';
                                            $statusmsg = '';
                                            $documentStatus = ' (Not Uploaded) ';

                                            if (in_array($key, ['Co_Debtor_Pay_Stubs', 'Debtor_Pay_Stubs']) && (Auth::user()->client_payroll_assistant == Helper::PAYROLL_ASSISTANT_TYPE_BOTH)) {
                                                // continue;
                                            }

                                            if (in_array($key, $documentuploaded)) {
                                                $uploadedClass = "font-color-sucess";
                                                $documentStatus = ' (Uploaded) ';
                                            }
                                        @endphp

                                        <li>
                                            <div class="d-flex nav-linkf text-left {{ $uploadedClass }}">
                                                <div class="d-status">{!! $fStatus !!}</div>
                                                @php $postfix = !empty($statusmsg) ? '&nbsp;<span class="font-weight-bold"> ('.$statusmsg.')</span>' : ''; @endphp
                                                <div class="doc-card f-w-500">{!! $name.$documentStatus.$postfix !!}</div>
                                            </div>
                                        </li>

                                        @php
                                            $fStatus = '';
                                            $uploadedClass = "font-color-fail";
                                            $renabledupload = false;
                                            $declineReason = '';
                                            $status = 0;
                                            $reason = '';
                                            $statusmsg = '';
                                            $documentStatus = ' (Not Uploaded) ';
                                            $next = next($documentTypes);

                                            if (key($documentTypes) == 'Vehicle_Registration') {
                                                $name = 'Current Mortgage Statement';
                                                if ($residenceUploaded == true) {
                                                    $uploadedClass = "font-color-sucess";
                                                    $documentStatus = ' (Uploaded) ';
                                                    $fStatus = '';
                                                }
                                            }
                                        @endphp

                                        @if (key($documentTypes) == 'Vehicle_Registration')
                                            <li>
                                                <div class="d-flex nav-linkf text-left {{ $uploadedClass }}">
                                                    <div class="d-status">{!! $fStatus !!}</div>
                                                    @php $postfix = !empty($statusmsg) ? '&nbsp;<span class="font-weight-bold"> ('.$statusmsg.')</span>' : ''; @endphp
                                                    <div class="doc-card f-w-500">{!! $name.$documentStatus.$postfix !!}</div>
                                                </div>
                                            </li>

                                            @php
                                                $fStatus = '';
                                                $uploadedClass = "font-color-fail";
                                                $renabledupload = false;
                                                $declineReason = '';
                                                $status = 0;
                                                $reason = '';
                                                $statusmsg = '';
                                                $documentStatus = ' (Not Uploaded) ';
                                                $name = 'Current Auto Loan Statement';
                                                if ($vehicleUploaded == true) {
                                                    $uploadedClass = "font-color-sucess";
                                                    $documentStatus = ' (Uploaded) ';
                                                    $fStatus = '';
                                                }
                                            @endphp

                                            <li>
                                                <div class="d-flex nav-linkf text-left {{ $uploadedClass }}">
                                                    <div class="d-status">{!! $fStatus !!}</div>
                                                    @php $postfix = !empty($statusmsg) ? '&nbsp;<span class="font-weight-bold"> ('.$statusmsg.')</span>' : ''; @endphp
                                                    <div class="doc-card f-w-500">{!! $name.$documentStatus.$postfix !!}</div>
                                                </div>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

