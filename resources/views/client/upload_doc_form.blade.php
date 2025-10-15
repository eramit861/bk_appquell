@php
    $isAttorneyDocPage = $isAttorneyDocPage ?? '';
    $isUnsecuredPage = $isUnsecuredPage ?? '';
    $isManual = $isManual ?? '';
    $isclintSide = (Auth::check() && auth()->user()->role == \App\Models\User::CLIENT) || $isManual ? 1 : 0;
    $signedDoc = $signedDoc ?? false;
    $acceptType =
        '.heic,.jpeg,.png,.jpg,.pdf,.doc,.docx,.xltx,.vsdx,.dxf,.dot,.eml,.odt,.psd,.xlsx,.msg,.ppsx,.rtf,.numbers,.svg,.vsd,.eps,.md,.tiff,.ico,.json,.webp,.oxps,.pptx,.dwfx,.djvu,.dwf,.odp,.mobi,.xps,.ps,.xls,.dwg,.bmp,.csv,.html,.xlsb,.pages,.ods,.pps,.epub,.htm,.gif,.potx,.odg';

    $bank_statement_month_nos = $bank_statement_months ?? '';

    $statement_month_array = !$signedDoc ? DateTimeHelper::getBankStatementMonthArray($bank_statement_month_nos) : 0;

    $missing_months_array = isset($missing_months_array) && !empty($missing_months_array) ? $missing_months_array : [];
    $isDebtorPayCheckData = 'false';
    $isCodebtorPayCheckData = 'false';

    $client_id = !isset($client_id) ? Auth::user()->id : $client_id;
    $user_client_type = \App\Models\User::getClientType($client_id);
    $debtorPaystubStatus = \App\Models\AttorneyEmployerInformationToClient::getMissingPaystubList($client_id, 'debtor');
    $coDebtorPaystubStatus = \App\Models\AttorneyEmployerInformationToClient::getMissingPaystubList(
        $client_id,
        'codebtor',
    );
    $debtorEmployerRoute = route('client_paystub', ['id' => $client_id, 'type' => 'employer']);
    $codebtorEmployerRoute = route('client_paystub_partner', ['id' => $client_id, 'type' => 'employer']);
    if (Auth::check() && auth()->user()->role == 3) {
        $debtorEmployerRoute = route('client_income');
        $codebtorEmployerRoute = route('client_income_step1');
    }

    $debtorEmployerLink = '<span class="text-c-blue"><a target="_blank" href="' . $debtorEmployerRoute . '">';
    $codebtorEmployerLink = '<span class="text-c-blue"><a target="_blank" href="' . $codebtorEmployerRoute . '">';

    if ($isManual) {
        $debtorEmployerLink = '<span class="text-c-blue"><a href="javascript:void(0)">';
        $codebtorEmployerLink = '<span class="text-c-blue"><a href="javascript:void(0)">';
    }

    $noEmployerTextD1 =
        '<p class="text-center mb-0">
        You haven\'t filled out the ' .
        $debtorEmployerLink .
        'Current Income</a></span> in the questionnaire yet ' .
        $debtorEmployerLink .
        '(Step 1)</a></span>. </br>
        In order to upload pay stubs you must fill out the ' .
        $debtorEmployerLink .
        'Current Income</a></span> in the questionnaire ' .
        $debtorEmployerLink .
        '(Step 1)</a></span> first. 
        This way the system can determine what pay stubs you will need to upload for the Court.</br>
        <span class="text-danger">Please fill out the Current Income section first and then upload your pay stubs.</span> ' .
        $debtorEmployerLink .
        ' Click here to go to the Current Income Tab.</a></span>
    </p>';

    $noEmployerTextD2 =
        '<p class="text-center mb-0">
        You haven\'t filled out the ' .
        $codebtorEmployerLink .
        'Current Income</a></span> in the questionnaire yet ' .
        $codebtorEmployerLink .
        '(Step 3)</a></span>. </br>
        In order to upload pay stubs you must fill out the ' .
        $codebtorEmployerLink .
        'Current Income</a></span> in the questionnaire ' .
        $codebtorEmployerLink .
        '(Step 3)</a></span> first. 
        This way the system can determine what pay stubs you will need to upload for the Court.</br>
        <span class="text-danger">Please fill out the Current Income section first and then upload your pay stubs.</span> ' .
        $codebtorEmployerLink .
        ' Click here to go to the Current Income Tab.</a></span>
    </p>';
@endphp
<form name="form-both" id="form-both" action="{{ $route }}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="modal-content modal-content-div conditional-ques b-0-i">
        @if (!$signedDoc)
            <div class="modal-header align-items-center py-2">
                <h5 id="doc_name_uploaded" class="modal-title document_name d-flex w-100">
                    Debtor's Paystub Calculation
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
        @endif
        <div class="modal-body">
            <div class="card-body b-0-i p-0">

                <div class="light-gray-div">
                    <h2>Document upload Area</h2>
                    <div class="row gx-3 form_bgp">
                        <div class="col-12">
                            <input type="hidden" name="autoloan_id" value='0' id="autoloan_id">
                            <div class="fix-boxp px-3">
                                <div class="row">
                                    @php
                                        $response = \App\Models\ClientDocuments::pay_check_calculation($client_id, 1);
                                    @endphp
                                    @if (!empty($response['debtorPayCheckData']))
                                        @php
                                            $isDebtorPayCheckData = 'true';
                                        @endphp
                                        <div class="d-none" id="debtor-employer-select">
                                            <div class="btn-group w-100 label-div mb-0">
                                                <button
                                                    class="form-control pay-date-select-button dropdown-toggle emp-btn pl-4"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" aria-label="Select Employer">
                                                    <span class="ml-2">Select Employer</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="addCustomSelectEmployer(this)">Select Employer</a>
                                                    @foreach ($response['debtorPayCheckData'] as $key => $data)
                                                        @php
                                                            $employerNameLabel =
                                                                $data['emp_data']['employer_name'] ?? 'Employer';
                                                            $employerId = $data['emp_data']['id'] ?? '';
                                                        @endphp
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="addCustomSelectEmployer(this)"
                                                            data-employerid="{{ $employerId }}"
                                                            data-employer="{{ $employerNameLabel }}">{{ $employerNameLabel }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none" id="debtor-pay-date-select">
                                            <div class="btn-group ml-3 label-div">
                                                <button class="form-control pay-date-select-button dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" aria-label="Select Pay Date">
                                                    Select Pay Date
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="removeCustomSelectPayDate()">Select Pay Date</a>
                                                    @foreach ($response['debtorPayCheckData'] as $key => $data)
                                                        @php
                                                            $employerNameLabel =
                                                                $data['emp_data']['employer_name'] ?? 'Employer';
                                                            $employerId = $data['emp_data']['id'] ?? '';
                                                        @endphp
                                                        <div class="employer-paydates"
                                                            data-employer-id="{{ $employerId }}">
                                                            <div class="dropdown-divider m-0"></div>
                                                            @foreach ($data['pay_dates'] as $dates)
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    onclick="addCustomSelectPayDate()"
                                                                    data-employerid="{{ $employerId }}"
                                                                    data-employer="{{ $employerNameLabel }}"
                                                                    data-date="{{ $dates['pay_date'] }}">{{ $dates['display_date'] }}</a>
                                                            @endforeach
                                                            <div class="dropdown-divider m-0"></div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $response = \App\Models\ClientDocuments::pay_check_calculation($client_id, 2);
                                    @endphp
                                    @if (!empty($response['codebtorPayCheckData']))
                                        @php
                                            $isCodebtorPayCheckData = 'true';
                                        @endphp
                                        <div class="d-none" id="codebtor-employer-select">
                                            <div class="btn-group w-100 label-div mb-0">
                                                <button
                                                    class="form-control pay-date-select-button emp-btn dropdown-toggle pl-4"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" aria-label="Select Employer">
                                                    <span class="ml-2">Select Employer</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="addCustomSelectEmployer(this)">Select Employer</a>
                                                    @foreach ($response['codebtorPayCheckData'] as $key => $data)
                                                        @php
                                                            $employerNameLabel =
                                                                $data['emp_data']['employer_name'] ?? 'Employer';
                                                            $employerId = $data['emp_data']['id'] ?? '';
                                                        @endphp
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="addCustomSelectEmployer(this)"
                                                            data-employerid="{{ $employerId }}"
                                                            data-employer="{{ $employerNameLabel }}">{{ $employerNameLabel }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none" id="codebtor-pay-date-select">
                                            <div class="btn-group ml-3 label-div">
                                                <button class="form-control pay-date-select-button dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" aria-label="Select Pay Date">
                                                    Select Pay Date
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="removeCustomSelectPayDate()">Select Pay Date</a>
                                                    @foreach ($response['codebtorPayCheckData'] as $key => $data)
                                                        @php
                                                            $employerNameLabel =
                                                                $data['emp_data']['employer_name'] ?? 'Employer';
                                                            $employerId = $data['emp_data']['id'] ?? '';
                                                        @endphp
                                                        <div class="employer-paydates"
                                                            data-employer-id="{{ $employerId }}">
                                                            <div class="dropdown-divider m-0"></div>
                                                            @foreach ($data['pay_dates'] as $dates)
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    onclick="addCustomSelectPayDate()"
                                                                    data-employerid="{{ $employerId }}"
                                                                    data-employer="{{ $employerNameLabel }}"
                                                                    data-date="{{ $dates['pay_date'] }}">{{ $dates['display_date'] }}</a>
                                                            @endforeach
                                                            <div class="dropdown-divider m-0"></div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="hidden" name="document_type" id="document_types"
                                        class="document_types_class" value="">

                                    <div class="col-12 px-0 client_Debtor_Pay_Stubs hide-data">
                                        @php
                                            $client_type = 1;
                                            $response = \App\Models\ClientDocuments::pay_check_calculation(
                                                $client_id,
                                                $client_type,
                                            );
                                        @endphp
                                        @if (!empty($response['debtorPayCheckData']))
                                            @include(
                                                'client.questionnaire.income.common.pay_check_calculation_new',
                                                [
                                                    'dataType' => 'Debtor_Pay_Stubs',
                                                    'documentuploaded' => [],
                                                    'payCheckData' => $response['debtorPayCheckData'],
                                                    'completeList' => $response['debtorCompleteList'],
                                                    'isUploadedScreen' => false,
                                                    'isClientDocPage' => true,
                                                ]
                                            )
                                        @else
                                            {!! $noEmployerTextD1 !!}
                                        @endif
                                    </div>
                                    <div class="col-12 px-0 client_Co_Debtor_Pay_Stubs hide-data">
                                        @php
                                            $client_type = 2;
                                            $response = \App\Models\ClientDocuments::pay_check_calculation(
                                                $client_id,
                                                $client_type,
                                            );
                                        @endphp
                                        @if (!empty($response['codebtorPayCheckData']))
                                            @include(
                                                'client.questionnaire.income.common.pay_check_calculation_new',
                                                [
                                                    'dataType' => 'Co_Debtor_Pay_Stubs',
                                                    'documentuploaded' => [],
                                                    'payCheckData' => $response['codebtorPayCheckData'],
                                                    'completeList' => $response['codebtorCompleteList'],
                                                    'isUploadedScreen' => false,
                                                    'isClientDocPage' => true,
                                                ]
                                            )
                                        @else
                                            {!! $noEmployerTextD2 !!}
                                        @endif
                                    </div>
                                    <div class="col-12 other_than_paystubs mb-3 px-0">
                                        <div class="upload-area1 background_img">
                                            <div class="upload-area__header desktop">
                                                <h4 class="text-c-white upload-area__title f-w-500 font-lg-20">
                                                    CLICK HERE TO SELECT DOCUMENTS TO UPLOAD <br>OR
                                                    <br>DRAG/DROP YOUR DOCUMENT(S) HERE
                                                </h4>
                                            </div>
                                            <div class="upload-area__header mobile">
                                                <h4 class="text-c-white upload-area__title f-w-500 font-lg-20">
                                                    CLICK HERE TO SELECT DOCUMENTS TO UPLOAD OR DRAG/DROP YOUR
                                                    DOCUMENT(S) HERE</h4>
                                            </div>
                                            <div class="upload-area__footer">
                                                <p class="upload-area__paragraph text-center">
                                                    <span class="font-weight-normal text-c-white font-lg-18">A list
                                                        of files with their names will display below that will be
                                                        uploaded</span><br>
                                                </p>
                                            </div>
                                            <div class="upload-area__drop-zoons drop-zoon">
                                                <div class="doc-upload">
                                                    <span class="drop-zoon__icon"></span>
                                                    <div class="doc-edit">
                                                        <input type="hidden" name="document_type" id="document_type"
                                                            value="">
                                                        <input type='file' required class="required"
                                                            @if (isset($isUnsecuredPage) && !$isUnsecuredPage) multiple @endif
                                                            name="document_file[]" id="both-licence"
                                                            accept="{{ $acceptType }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label id="input_file_error_label" class="d-none">Please upload the file.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="light-gray-div mt-3 other_than_paystubs">
                    <h2>Attached documents to upload</h2>
                    <div class="row gx-3">
                        <div class="col-12 mb-0 collection_agent_label hide-data label-div">
                            <label class="mb-2" style="font-size: 14px !important;">Please enter creditor/collection
                                agent name to upload Document(s):</label>
                        </div>
                        <div class="col-12 doc-name-sec">

                            <div class="sec-border hide-data">

                            </div>
                        </div>
                    </div>
                    <span class="progress-status-span"></span>
                </div>

                @if (isset($client_id) && !empty($client_id))
                    <input type="hidden" name="client_id" value="{{ $client_id }}">
                @endif


                <div class="bottom-btn-div">
                    <button type="button" class="btn-new-ui-default" class="close"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="uploadbtn_att" class="other_than_paystubs btn-new-ui-default ml-2"
                        onclick="submitUploadDoc()">
                        @if ($signedDoc)
                            Click to upload & send docs to Client(s)
                        @else
                            Click to upload listed document(s)
                        @endif
                    </button>
                </div>

            </div>
        </div>

    </div>
</form>

@push('tab_scripts')
    <script>
        window.__uploadDocFormRoutes = {
            getStatementMonthOption: "{{ route('get_statement_month_option') }}",
            clientDocumentUploads: "{{ route('client_document_uploads') }}"
        };
        window.__uploadDocFormData = {
            bankStatementMonthNos: "{{ $bank_statement_month_nos }}",
            clientId: "{{ $client_id ?? '' }}",
            maxSize: {{ $max_size ?? 200 }},
            route: "{{ $route ?? '' }}",
            assetUrl: "{{ url('assets/img/insurance_report.png') }}",
            isUnsecuredPage: {{ $isUnsecuredPage == 1 ? 'true' : 'false' }},
            isAttorneyDocPage: {{ $isAttorneyDocPage == 1 ? 'true' : 'false' }},
            isclintSide: "{{ $isclintSide }}",
            isDebtorIncomePage: "{{ !request()->routeIs('client_income_step2') ? '1' : '0' }}",
            isCoDebtorIncomePage: "{{ !request()->routeIs('client_income_step3') ? '1' : '0' }}",
            isCodebtorPayCheckData: "{{ $isCodebtorPayCheckData }}",
            isDebtorPayCheckData: "{{ $isDebtorPayCheckData }}",
            userClientType: "{{ $user_client_type }}",
            retirementPensionDocs: {!! json_encode(array_keys(\App\Models\ClientDocuments::getClientDocumentList(@$client_id, 'retirement_pension'))) !!}
        };
    </script>
    <script src="{{ asset('assets/js/client/upload_doc_form.js') }}"></script>
@endpush

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/upload_doc_form.css') }}">
@endpush
