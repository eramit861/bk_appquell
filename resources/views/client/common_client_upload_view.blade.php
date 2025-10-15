@php
$isUnsecuredPage = isset($isUnsecuredPage) ? $isUnsecuredPage : false;
$documentuploadedImages = ArrayHelper::getHelpDocumentUrls();
$web_view = Session::get('web_view');
$isRequestedType = false;
$isPaystub = 0;
$isStatements = 0;
$hideDownload = false;
$manul_url_document_type = '';
if (isset($isManualPage) && $isManualPage) {
    $hideDownload = true;
    $manul_url_document_type = $url_document_type ?? '';
}

$quickTipUrl = url('assets/img/quick-tip.jpg');

$BIData = \App\Services\Client\CacheBasicInfo::getBasicInformationData($client_id);
$clientBasicInfoPartA = \App\Helpers\Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
$clientBasicInfoPartB = \App\Helpers\Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

$debtorname = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor's");
$spousename = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor's");
if ($user->client_type == 2) {
    $spousename = 'Non-Filing Spouse';
}

$ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
$is_associate = !empty($ClientsAssociateId) ? 1 : 0;
$addCurrentMonthToDate = false;
@endphp

@if ($user->client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $user->hide_questionnaire == 0)
@php
    $list = @$docsUploadInfo['list'];
    $lifeInsuDocs = @$docsUploadInfo['lifeInsuDocs'];
    $retirement_pension = @$docsUploadInfo['retirement_pension'];

    $retirement_pension_key = array_keys($retirement_pension);

    $venmoPaypalCash = @$docsUploadInfo['venmoPaypalCash'];
    $brokerageAccount = @$docsUploadInfo['brokerageAccount'];
    $unpaidWages = @$docsUploadInfo['unpaidWages'];
    $documentuploaded = @$docsUploadInfo['documentuploaded'];

    $attorneydocuments = isset($docsUploadInfo['attorneydocuments']) && is_array($docsUploadInfo['attorneydocuments']) ? $docsUploadInfo['attorneydocuments'] : [];
    $attorneydocuments = array_merge($attorneydocuments, ['Miscellaneous_Documents' => 'Additional or Unlisted Documents']);
    $client_attorney_id = @$docsUploadInfo["attorney_id"];

    $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $client_attorney_id;

    $addCurrentMonthToDate = App\Models\AttorneySettings::isCurrentPartialMonthEnabled($attorney_id);

    $requestedDocuments = isset($docsUploadInfo['requestedDocuments']) && is_array($docsUploadInfo['requestedDocuments']) ? $docsUploadInfo['requestedDocuments'] : [];
    $adminDocuments = isset($docsUploadInfo['adminDocuments']) && is_array($docsUploadInfo['adminDocuments']) ? $docsUploadInfo['adminDocuments'] : [];

    $hidebtn = @$docsUploadInfo['hidebtn'];
    $clientDocs = @$docsUploadInfo['clientDocs'];

    if (!empty($adminDocuments)) {
        $requestedDocuments = array_merge($requestedDocuments, $adminDocuments);
    }

    if (isset($isBankStatementEnabled) && $isBankStatementEnabled) {
        if (!empty($clientDocs)) {
            $requestedDocuments = array_merge($requestedDocuments, $clientDocs);
        }
        if (!empty($venmoPaypalCash)) {
            $requestedDocuments = array_merge($requestedDocuments, $venmoPaypalCash);
        }
    }

    if (!empty($brokerageAccount)) {
        $requestedDocuments = array_merge($requestedDocuments, $brokerageAccount);
    }
    if (!empty($unpaidWages)) {
        $requestedDocuments = array_merge($requestedDocuments, $unpaidWages);
    }

    $client = @$docsUploadInfo['client'];
    $notOwnedDocs = @$docsUploadInfo['notOwnedDocs'];
    $documentTypes = @$docsUploadInfo['documentTypes'];
    $attorney = \App\Models\ClientsAttorney::where('client_id', $client_id)->first();
    $excludeDocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate])->first();
    $excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];

    $AttorneyExcludeDocsPerClient = \App\Models\AttorneyExcludeDocsPerClient::where(['attorney_id' => $attorney_id, 'client_id' => $client_id])->first();
    $AttorneyExcludeDocsPerClient = !empty($AttorneyExcludeDocsPerClient) ? $AttorneyExcludeDocsPerClient->toArray() : [];
    $docJsonPerClient = Helper::validate_key_value('doc_type_json', $AttorneyExcludeDocsPerClient);
    $docJsonPerClient = json_decode($docJsonPerClient) ?? [];
    $mergedArray = array_merge($excludeDocs, $docJsonPerClient);
    $excludeDocs = array_unique($mergedArray);

    $clientPropertyData = \App\Services\Client\CacheProperty::getPropertyData($client_id);
    $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
    $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

    $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate])
        ->select(['counseling_agency', 'counseling_agency_site', 'attorney_code'])
        ->first();

    $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty, false, true);
    $mortages = $clientDebtorResidentDocumentList['clientDocumentList'] ?? [];
    $notOwnedDocsClientDebtorResident = $clientDebtorResidentDocumentList['notOwnedDocs'] ?? [];
    $notOwnedDocs = array_merge($notOwnedDocs, $notOwnedDocsClientDebtorResident);
    $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];

    array_push($mortages, 'Current_Mortgage_Statement');
    $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($client_id);
    $vehicles = $clientDebtorVehiclesDocumentList['vehiclesDocumentList'] ?? [];
    $notOwnedDocsClientDebtorVehicles = $clientDebtorVehiclesDocumentList['notOwnedDocs'] ?? [];
    $notOwnedDocs = array_merge($notOwnedDocs, $notOwnedDocsClientDebtorVehicles);
    $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];

    $incomeData = \App\Services\Client\CacheIncome::getIncomeData($user->id);
    $D1Data = \App\Helpers\Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
    $D2Data = \App\Helpers\Helper::validate_key_value('debtorspouseemployer', $incomeData, 'array');

    $hasDebtorEmployer = \App\Helpers\ClientHelper::getEmployerStatus($D1Data, 1);
    $hasCodebtorEmployer = \App\Helpers\ClientHelper::getEmployerStatus($D2Data, 2);

    if ($hasDebtorEmployer) {
        $excludeDocs = array_filter($excludeDocs, function ($item) {
            return $item !== 'Debtor_Pay_Stubs';
        });
        $excludeDocs = array_values($excludeDocs);
    }
    if ($hasCodebtorEmployer) {
        $excludeDocs = array_filter($excludeDocs, function ($item) {
            return $item !== 'Co_Debtor_Pay_Stubs';
        });
        $excludeDocs = array_values($excludeDocs);
    }

    if ($notOwnedDocs) {
        if (!empty(array_intersect($excludeDocs, $vehicles))) {
            foreach ($vehicles as $vr) {
                unset($documentTypes[$vr]);
            }
        }

        if (!empty(array_intersect($excludeDocs, $mortages))) {
            foreach ($mortages as $mr) {
                unset($documentTypes[$mr]);
            }
        }
        if (in_array('Debtor_Pay_Stubs', $excludeDocs)) {
            unset($documentTypes['Debtor_Pay_Stubs']);
        }
        if (in_array('Co_Debtor_Pay_Stubs', $excludeDocs)) {
            unset($documentTypes['Co_Debtor_Pay_Stubs']);
        }

        if (in_array('Post_submission_documents', $excludeDocs)) {
            unset($documentTypes['Post_submission_documents']);
        }
    }

    $alldocKeys = array_column($documentuploaded, 'document_type');
    $updatedList = [];
    if (!empty($excludeDocs)) {
        foreach ($documentTypes as $key => $doc) {
            if (in_array($key, $excludeDocs)) {
                unset($documentTypes[$key]);
            }
        }
    }
@endphp
@php
$displayMiddle = false;
$colclass = 6;
if ((is_array($attorneydocuments) && !empty($attorneydocuments)) || in_array($client->client_type, [2, 3])) {
    $colclass = 4;
    $displayMiddle = true;
}

$isPostSubmissionEnabled = \App\Models\ClientSettings::isPostSubmissionEnabled($client_id);
if ($isPostSubmissionEnabled && !$isUnsecuredPage) {
    $documentTypes = [\App\Models\ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents"];
    $clientPSDocuments = \App\Models\ClientDocuments::getClientPostSubmissionDocumentList($client_id);
    if ($clientPSDocuments) {
        foreach ($clientPSDocuments as $key => $document) {
            $documentTypes[Helper::validate_key_value('document_name', $document)] = Helper::validate_key_value('document_type', $document);
        }
    }
    $attorneydocuments = [];
    $requestedDocuments = [];
}
$attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

$validTypeGroups = [
    'debtor_VA_Benefit_Award_Letter' => ['debtor_VA_Benefit_Award_Letter', 'codebtor_VA_Benefit_Award_Letter'],
    'debtor_Social_Security_Annual_Award_Letter' => ['debtor_Social_Security_Annual_Award_Letter', 'codebtor_Social_Security_Annual_Award_Letter'],
    'debtor_Unemployment_Payment_History_Last_7_Months' => ['debtor_Unemployment_Payment_History_Last_7_Months', 'codebtor_Unemployment_Payment_History_Last_7_Months'],
    'Current_Mortgage_Statement' => array_keys($mortgageUpdatedNames),
    'Current_Auto_Loan_Statement' => array_keys($vehicleUpdatedNames),
];
@endphp
@endif


@if (request()->routeIs('attorney_edit_client_report'))

<div class="col-12 col-xl-4 col-lg-5 col-md-6 col-sm-12 pl-1 pr-1">
    <a href="javascript:void(0);" class="pl-2 pr-2 btn btn-new-ui-default m-0 w-100" data-bs-toggle="modal"
        data-type="Debtor_Creditor_Report"
        onclick='both_upload_modal("Debtor_Creditor_Report"," Import Debtor Annual Credit Report")'>Import Debtor's
        Annual Credit Report</a>
</div>

@if ($client->client_type == 3)
<div class="col-12 col-xl-4 col-lg-5 col-md-6 col-sm-12 pl-1 pr-1">
    <a href="javascript:void(0);" class="pl-2 pr-2 btn btn-new-ui-default m-0 w-100" data-bs-toggle="modal"
        data-type="Co_Debtor_Creditor_Report"
        onclick='both_upload_modal("Co_Debtor_Creditor_Report"," Import Co-Debtor Annual Credit Report")'>Import
        Co-Debtor's Annual Credit Report</a>
</div>

@endif
@endif

@if (request()->routeIs('client_debts_step2_unsecured'))
@php
    $unsecured_page = 'unsecured_page';
@endphp
@foreach ($documentTypes as $key => $name)
@php
    $checkArray = ['Debtor_Creditor_Report'];

    if ($client->client_type == 3) {
        $checkArray = ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'];
    }

    if (!in_array($key, $checkArray)) {
        continue;
    }
    $isPaystub = 0;
    $sampleName = 'credit-report-popup';
    $samplePopupLabel = '<span class="text-success">How to get my credit reports? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
    $ulClass = $key == 'Co_Debtor_Creditor_Report' ? 'co' : '';
@endphp
<div class="col-12 col-xl-4 col-xxl-3">
    <ul class="{!! $ulClass . 'debtor-docs' !!}">
        @include('client.document_list_item', [
            'isPaystub' => $isPaystub,
            'unsecured_page' => $unsecured_page,
        ])
    </ul>
</div>
@endforeach
@endif

@if (!request()->routeIs('client_debts_step2_unsecured') && !request()->routeIs('attorney_edit_client_report'))
@php
    $unsecured_page = '';
@endphp
<div class="row">
    <div class="col-xl-{{ $colclass }} col-sm-12 col-xs-12">

        <div class="card {{ !isset($documentTypes['Post_submission_documents']) ? 'hide-data' : '' }}">
            <div class="card-header text-center">
                <h5 class="text-c-blue">Post submission documents</h5>
            </div>
            <div class="card-body border-0 p-3">
                <ul class="debtor-docs">
                    @foreach ($documentTypes as $key => $name)
                        @if (! (str_starts_with($key, 'post_submission_doc_') || in_array($key, ['Post_submission_documents'])))
                            @continue
                        @endif
                        @include('client.document_list_item')
                    @endforeach
                </ul>

            </div>
        </div>
        @if (empty($manul_url_document_type) || (!empty($manul_url_document_type) && (in_array($manul_url_document_type, ['Debtor_Pay_Stubs', 'Drivers_License', 'Social_Security_Card'])) && in_array($manul_url_document_type, array_keys($documentTypes))))
        <div class="card {{ !isset($documentTypes['Post_submission_documents']) ? '' : 'hide-data' }}">
            <div class="card-header text-center">
                <h5 class="text-c-blue">{{ $debtorname }} Document List</h5>
            </div>
            <div class="card-body border-0 p-3">
                <ul class="debtor-docs">
                    @foreach ($documentTypes as $key => $name)
                        @php
                        $isPaystub = 0;
                        if (!in_array($key, ['Debtor_Pay_Stubs', 'Drivers_License', 'Social_Security_Card', 'Debtor_Creditor_Report'])) {
                            continue;
                        }
                        $sampleName = '';
                        $samplePopupLabel = '';
                        if ($key === 'Debtor_Pay_Stubs') {
                            $isPaystub = 1;
                            // $sampleName = 'popup-paystub';
                            $sampleName = 'no-popup';
                            $samplePopupLabel = '<span class="text-success">Once you click on the upload the required pay dates will be listed</span>';
                        }
                        if ($key === 'Drivers_License') {
                            // $sampleName = 'popup-drivers-license';
                            $sampleName = 'no-popup';
                            $samplePopupLabel = '<span class="text-success">Only upload the front of your license</span>';
                        }
                        if ($key === 'Social_Security_Card') {
                            // $sampleName = 'popup-ss-card';
                            $sampleName = 'no-popup';
                            $samplePopupLabel = '<span class="text-success">Only upload the front of your SSN card</span>';
                        }
                        if (in_array($key, ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'])) {
                            $sampleName = 'credit-report-popup';
                            $samplePopupLabel = '<span class="text-success">How to get my credit reports? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                        }

                        foreach ($documentuploadedImages as $guide) {
                            if ($guide['type'] == $key && !empty($guide['image'])) {
                                $sampleName = $guide['type'];
                            }
                        }
                        @endphp
                        @include('client.document_list_item', ['isPaystub' => $isPaystub])
                    @endforeach
                </ul>

            </div>
        </div>
        @endif
        @php
        $documentlisttoexlude = $mortages;
        $documentlisttoexlude1 = array_merge($documentlisttoexlude, $vehicles);
        $documentlisttoexlude2 = array_merge($documentlisttoexlude1, []);

        $documentTypes = array_merge($documentTypes, $mortgageUpdatedNames);
        $documentTypes = array_merge($documentTypes, $vehicleUpdatedNames);
        \Log::info('Document Types', [
            'excludeDocs' => $excludeDocs
        ]);
        $sampleName = '';
        $samplePopupLabel = '';
        $sampleAnchorLabel = '';
        $sampleAnchorLink = '';
        @endphp

        @if (empty($manul_url_document_type) || (!empty($manul_url_document_type) && (in_array($manul_url_document_type, $documentlisttoexlude2)) && in_array($manul_url_document_type, array_keys($documentTypes))))

        <div class="card {{ !isset($documentTypes['Post_submission_documents']) ? '' : 'hide-data' }}">
            <div class="card-header text-center">
                <h5 class="text-c-blue">Secured Loan Documents</h5>
            </div>
            <div class="card-body border-0 p-3">
                <ul class="codebtor-docs">
                    @foreach ($documentTypes as $key => $name)
                        @if (!in_array($key, $documentlisttoexlude2))
                            @continue
                        @endif

                        @if (in_array($key, $excludeDocs))
                            @continue
                        @endif
                        @php
                        $securedLoankeys = array_merge($mortgageUpdatedNames, $vehicleUpdatedNames);

                        if (array_key_exists($key, $securedLoankeys)) {
                            $sampleAnchorLabel = '<span class="text-success">Upload your most current statement</span>';
                            $sampleAnchorLink = "javascript:void(0)";
                        }

                        $sampleName = '';
                        $samplePopupLabel = '';
                        foreach ($documentuploadedImages as $guide) {
                            $type = $guide['type'] ?? null;
                            $image = $guide['image'] ?? null;

                            $isMatch = (
                                (isset($validTypeGroups[$type]) && in_array($key, $validTypeGroups[$type])) ||
                                $type === $key
                            );

                            if ($isMatch && !empty($image)) {
                                $sampleName = $type;
                                $samplePopupLabel = '<span class="text-success">What is this document? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                            }
                        }
                        @endphp
                        @include('client.document_list_item')
                    @endforeach
                    @php
                    $sampleName = '';
                    $samplePopupLabel = '';
                    $sampleAnchorLabel = '';
                    $sampleAnchorLink = '';
                    @endphp
                </ul>
            </div>
        </div>
        @endif

    </div>

    <div class="{{ $displayMiddle == false ? 'hide-data' : '' }} col-xl-{{ $colclass }} col-sm-12 col-xs-12 {{ !isset($documentTypes['Post_submission_documents']) ? '' : 'hide-data' }}">
        @php
        $dNoneClass = 'd-none';
        $coDebHeading = $spousename . ' Document List';
        if ($client->client_type == 2) {
            $dNoneClass = '';
            $coDebHeading = 'Non-Filing Spouse Pay Stubs';
        }
        if ($client->client_type == 3) {
            $dNoneClass = '';
        }
        @endphp
        @if (empty($manul_url_document_type) || (!empty($manul_url_document_type) && (in_array($manul_url_document_type, ['Co_Debtor_Pay_Stubs', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card'])) && in_array($manul_url_document_type, array_keys($documentTypes))))

        <div class="card {{ $dNoneClass }}">
            <div class="card-header text-center">
                <h5 class="text-c-blue">{{ $coDebHeading }}</h5>
            </div>
            <div class="card-body border-0 p-3">
                <ul class="codebtor-docs">
                    @php
                    $spoceArray = ['Co_Debtor_Pay_Stubs', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card'];
                    if ($client->client_type == 3) {
                        $spoceArray = ['Co_Debtor_Pay_Stubs', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card', 'Co_Debtor_Creditor_Report'];
                    }
                    @endphp
                    @foreach ($documentTypes as $key => $name)
                        @php
                        $isPaystub = 0;
                        if (!in_array($key, $spoceArray)) {
                            continue;
                        }

                        $sampleName = '';
                        $samplePopupLabel = '';
                        if ($key === 'Co_Debtor_Pay_Stubs') {
                            $isPaystub = 1;
                            // $sampleName = 'popup-paystub';
                            $sampleName = 'no-popup';
                            $samplePopupLabel = '<span class="text-success">Once you click on the upload the required pay dates will be listed</span>';
                        }
                        if ($key === 'Co_Debtor_Drivers_License') {
                            // $sampleName = 'popup-drivers-license';
                            $sampleName = 'no-popup';
                            $samplePopupLabel = '<span class="text-success">Only upload the front of your license</span>';
                        }
                        if ($key === 'Co_Debtor_Social_Security_Card') {
                            // $sampleName = 'popup-ss-card';
                            $sampleName = 'no-popup';
                            $samplePopupLabel = '<span class="text-success">Only upload the front of your SSN card</span>';
                        }
                        if (in_array($key, ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'])) {
                            $sampleName = 'credit-report-popup';
                            $samplePopupLabel = '<span class="text-success">How to get my credit reports? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                        }
                        foreach ($documentuploadedImages as $guide) {
                            $type = $guide['type'] ?? null;
                            $image = $guide['image'] ?? null;

                            $isMatch = (
                                (isset($validTypeGroups[$type]) && in_array($key, $validTypeGroups[$type])) ||
                                $type === $key
                            );

                            if ($isMatch && !empty($image)) {
                                $sampleName = $type;
                            }
                        }
                        @endphp
                        @include('client.document_list_item', ['isPaystub' => $isPaystub])
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        @include('client.document_upload.attorney_doc_uploader')
    </div>


    <div class="col-xl-{{ $colclass }} col-sm-12 col-xs-12 {{ !isset($documentTypes['Post_submission_documents']) ? '' : 'hide-data' }}">
        @php
        $documentlisttoexlude = ['Last_Year_Tax_Returns', 'Prior_Year_Tax_Returns', 'Prior_Year_Two_Tax_Returns', 'Prior_Year_Three_Tax_Returns', 'W2_Last_Year', 'W2_Year_Before'];
        @endphp
        @if (empty($manul_url_document_type) || (!empty($manul_url_document_type) && in_array($manul_url_document_type, $documentlisttoexlude) && in_array($manul_url_document_type, array_keys($documentTypes))))

        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-c-blue">Tax Returns</h5>
                <span class="d-block mt-2 text-c-red blink font-weight-bold mb-0">You must upload Copies of your Federal
                    (IRS) AND State Filed Tax Returns</span>
            </div>
            <div class="card-body border-0 p-3">
                <ul class="codebtor-docs">
                    @foreach ($documentTypes as $key => $name)
                        @if (!in_array($key, $documentlisttoexlude))
                            @continue
                        @endif
                        @php
                        $sampleName = '';
                        $samplePopupLabel = '';

                        $isW2 = 0;
                        if (in_array($key, ['W2_Last_Year', 'W2_Year_Before'])) {
                            $isW2 = 1;
                        }

                        foreach ($documentuploadedImages as $guide) {
                            $type = $guide['type'] ?? null;
                            $image = $guide['image'] ?? null;

                            $isMatch = (
                                (isset($validTypeGroups[$type]) && in_array($key, $validTypeGroups[$type])) ||
                                $type === $key
                            );

                            if ($isMatch && !empty($image)) {
                                $sampleName = $type;
                                $samplePopupLabel = '<span class="text-success">Click here to see the easiest quickest way to get these uploaded <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                            }
                        }
                        @endphp
                        @include('client.document_list_item')
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        @php
        $excludeRequestsd = array_merge(array_keys($requestedDocuments), ['Other_Misc_Documents']);
        @endphp
        @if (empty($manul_url_document_type) || (!empty($manul_url_document_type) && in_array($manul_url_document_type, $excludeRequestsd)))

        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-c-blue"><i class="fa text-c-red blink mb-0 fa-exclamation-triangle pr-0"
                        aria-hidden="true"></i> Requested Documents <i
                        class="fa text-c-red blink mb-0 fa-exclamation-triangle" aria-hidden="true"></i></h5>
            </div>
            <div class="card-body border-0 p-3">
                <ul class="attorney-docs requt_docs">

                    @php
                    $isRequestedType = true;
                    $bank_account_documents = \App\Models\ClientDocuments::getClientBankDocumentList($client_id);
                    $brokerage_documents = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'brokerage_account');
                    @endphp
                    @foreach ($documentTypes as $key => $name)
                        @if (!in_array($key, $excludeRequestsd))
                            @continue
                        @endif
                        @php
                        $sampleName = '';
                        $samplePopupLabel = '';
                        $sampleAnchorLabel = '';
                        $sampleAnchorLink = '';
                        if ($key === 'Other_Misc_Documents') {

                            $samplePopupLabel = '<span class="text-success">What is a collection notice? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                            $sampleAnchorLabel = '<span class="text-success">You should upload any collection notice(s) so you have proof you listed this creditor in your case.</span>';
                            $sampleAnchorLink = "javascript:void(0)";
                        }

                        foreach ($documentuploadedImages as $guide) {
                            $type = $guide['type'] ?? null;
                            $image = $guide['image'] ?? null;

                            $isMatch = (
                                (isset($validTypeGroups[$type]) && in_array($key, $validTypeGroups[$type])) ||
                                $type === $key
                            );

                            if ($isMatch && !empty($image)) {
                                $sampleName = $type;
                            }
                        }
                        @endphp
                        @include('client.document_list_item')
                    @endforeach
                    @php
                    $textToDisplay = '';
                    $datamultiple = [];
                    $missing_months_array = [];

                    foreach ($list as $dc) {
                        if (in_array($dc['document_type'], array_keys($clientDocs)) || in_array($dc['document_type'], array_keys($venmoPaypalCash)) || in_array($dc['document_type'], array_keys($brokerageAccount))) {
                            $datamultiple[] = $dc;
                        }
                    }
                    @endphp
                    @if (is_array($requestedDocuments) && !empty($requestedDocuments))
                        @foreach ($requestedDocuments as $key => $name)
                            @php
                            $bankline = '';
                            $textToDisplay = '';
                            $isStatements = 0;
                            $hideDownload = false;
                            if (in_array($key, array_keys($clientDocs)) || in_array($key, array_keys($venmoPaypalCash)) || in_array($key, array_keys($brokerageAccount))) {
                                $bank_statement_month_nos = $bank_statement_months;
                                $missing_months_array = [];
                                if (!empty($bank_statement_months)) {
                                    if (isset($bank_account_documents) && !empty($bank_account_documents)) {
                                        foreach ($bank_account_documents as $docu) {
                                            if ($docu['document_name'] === $key) {
                                                $bank_statement_month_nos = ($docu['bank_account_type'] == 2) ? $attProfitLossMonths : $bank_statement_months;
                                                break;
                                            }
                                        }
                                    }

                                    $brokerageMonths = null;
                                    if (isset($brokerage_documents) && !empty($brokerage_documents) && array_key_exists($key, $brokerage_documents)) {
                                        $brokerageMonths = $brokerage_months;
                                        $bank_statement_month_nos = $brokerage_months;
                                        $addCurrentMonthToDate = false;
                                    }

                                    $statement_month_array = DateTimeHelper::getBankStatementShortMonthArray($bank_statement_month_nos, null, $addCurrentMonthToDate, $brokerageMonths);
                                    $datamultiple = $datamultiple ?? [];
                                    $matchingObjects = array_filter($datamultiple, function ($item) use ($key) {
                                        return $item['document_type'] === $key;
                                    });

                                    $missing_months = '<span class="text-dark">Uploaded Statements:</span> ';
                                    foreach ($statement_month_array as $month_key => $month_value) {
                                        $found = false;
                                        foreach ($matchingObjects as $object) {
                                            if ($object['document_month'] === $month_key) {
                                                $found = true;
                                                $missing_months .= '<span class="text-c-green">' . $month_value . '</span>, ';
                                                break;
                                            }
                                        }
                                        if (!$found) {
                                            $missing_months .= '<span class="text-c-red">' . $month_value . '</span>, ';
                                            $missing_months_array[] = $month_key;
                                        }
                                    }
                                    if (!empty($missing_months_array)) {
                                        echo '<input type="hidden" id="' . $key . '_missing_month" value=' . json_encode($missing_months_array) . '>';
                                    }
                                    $missing_months = rtrim($missing_months, ', ');
                                    if (!empty($missing_months)) {
                                        $textToDisplay = $missing_months;
                                    } else {
                                        $textToDisplay = "<span class='text-c-green font-weight-bold ml-2'>All Uploaded</span>";
                                    }


                                    $bankline = 'Upload your last ' . $bank_statement_month_nos . ' months of statements ';

                                    $isStatements = 1;
                                    $isBrokerage = 0;
                                    if (isset($brokerage_documents) && !empty($brokerage_documents)) {
                                        foreach ($brokerage_documents as $docuType => $docuName) {
                                            if ($docuType === $key) {
                                                $bankline = $brokerage_months == 1 ? 'Upload your last ' . $brokerage_months . ' month of statements ' : 'Upload your last ' . $brokerage_months . ' months of statements ';
                                                $isBrokerage = 1;
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                            $sampleName = '';
                            $samplePopupLabel = '';
                            $sampleAnchorLabel = '';
                            $sampleAnchorLink = '';
                            if (in_array($key, ['debtor_VA_Benefit_Award_Letter', 'codebtor_VA_Benefit_Award_Letter'])) {
                                $samplePopupLabel = '<span class="text-success">What is this document? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                                $sampleAnchorLabel = '<span class="text-success">Click here to see where to get my VA benefit</span>';
                                $sampleAnchorLink = "https://www.va.gov/records/download-va-letters/";
                            }
                            if (in_array($key, ['debtor_Social_Security_Annual_Award_Letter', 'codebtor_Social_Security_Annual_Award_Letter'])) {
                                $samplePopupLabel = '<span class="text-success">What is this document? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                                $sampleAnchorLabel = '<span class="text-success">Click here to see where to get my SSI/SSDI</span>';
                                $sampleAnchorLink = "https://www.ssa.gov/manage-benefits/get-benefit-letter";
                            }
                            if (in_array($key, ['debtor_Unemployment_Payment_History_Last_7_Months', 'codebtor_Unemployment_Payment_History_Last_7_Months'])) {
                                $samplePopupLabel = '<span class="text-success">What is required for this document? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                                $sampleAnchorLabel = '<span class="text-success">Unemployment payment history: go to your state website under payment/claim history</span>';
                                $sampleAnchorLink = "javascript:void(0)";
                            }
                            if (in_array($key, ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'])) {
                                $sampleName = 'credit-report-popup';
                                $samplePopupLabel = '<span class="text-success">How to get my credit reports? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                            }
                            if (in_array($key, ['venmo_account_1', 'venmo_account_2', 'venmo_account_3'])) {
                                $sampleName = 'venmo-statement-popup';
                                $samplePopupLabel = '<span class="text-success">How do I get these statements? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                            }
                            if (in_array($key, ['paypal_account_1', 'paypal_account_2', 'paypal_account_3'])) {
                                $sampleName = 'paypal-statement-popup';
                                $samplePopupLabel = '<span class="text-success">How do I get these statements? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                            }
                            if (in_array($key, ['cash_account_1', 'cash_account_2', 'cash_account_3'])) {
                                $sampleName = 'cash-statement-popup';
                                $samplePopupLabel = '<span class="text-success">How do I get these statements? <img alt="Quick Tip" src="' . $quickTipUrl . '" width="18px" /></span>';
                            }
                            if (array_key_exists($key, $lifeInsuDocs)) {
                                $sampleAnchorLabel = '<span class="text-success">Click here to see what you need to upload here</span>';
                                $sampleAnchorLink = "javascript:void(0)";
                            }
                            if (array_key_exists($key, $retirement_pension)) {
                                $sampleName = 'retirement_pension';
                                $samplePopupLabel = '<span class="text-success">Click here to see what you need to upload here</span>';
                            }

                            foreach ($documentuploadedImages as $guide) {
                                $type = $guide['type'] ?? null;
                                $image = $guide['image'] ?? null;

                                $isMatch = (
                                    (isset($validTypeGroups[$type]) && in_array($key, $validTypeGroups[$type])) ||
                                    $type === $key
                                );

                                if ($isMatch && !empty($image)) {
                                    $sampleName = $type;
                                }
                            }
                            @endphp
                            @include('client.document_list_item', [
                                'bankline' => $bankline,
                                'isStatements' => $isStatements,
                                'textToDisplay' => $textToDisplay,
                                'hideDownload' => $hideDownload,
                            ])
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        @endif

    </div>

    <!-- POPUPS -->
    <div class="hide-data va-benefit-letter">
        <img alt="Va Benefit Letter" class="webkit_fill" src="{{ url('assets/img/va-benefit-letter.png') }}" />
    </div>
    <div class="hide-data ss-annual-award-letter">
        <img alt="SS Annual Award Letter" class="webkit_fill"
            src="{{ url('assets/img/ss-annual-award-letter.png') }}" />
    </div>
    <div class="hide-data unmp-payment-history">
        <img alt="Unmployment Payment History" class="webkit_fill"
            src="{{ url('assets/img/unmp-payment-history.png') }}" />
    </div>
    <div class="hide-data ccc-certificate">
        <img alt="CCC Certificate" class="webkit_fill" src="{{ url('assets/img/ccc-certificate.png') }}" />
    </div>
    <div class="hide-data popup-paystub">
        <span>Paystub Popup</span>
    </div>
    <div class="hide-data popup-drivers-license">
        <span>Drivers License Popup</span>
    </div>
    <div class="hide-data popup-ss-card">
        <span>Social Security Card Popup</span>
    </div>
    <div class="hide-data popup-tax-return">
        <h5 class="text-c-blue">How to get Tax Returns quick and easy:</h5>
        <span class="text-danger fs-12px ">
            Note: It's faster and easier to request digital copies from your tax preparer, <u>even if you have paper
                copies on hand</u>. Avoid the
            hassle of printing and scanning each page. If you already have digital copies in your email or stored on a
            computer, you can
            quickly upload them directly into the system.
        </span>
        <p class="mt-2">
            <span class="text-c-blue">Online Access: </span>
            Download from Your Tax Filing Software
        </p>
        <p>If you filed Online using tax software like Turbo Tax, Block, or similar platforms, log into your account:
        </p>
        <ol class=" fs-16px mb-3">
            <li>Go to the filing year's dashboard.</li>
            <li>Download the return as a PDF. This is usually the fastest way if you used software to file.</li>
        </ol>
        <p class=" ">
            <span class="text-c-blue">Tax Preparer: </span>
            If a professional prepared your taxes, they generally keep a copy of them for up to 8 years.
            Contact them and ask for copies of the files tax returns. If you forgot who you filed them though. Look
            on the bottom of page two of your IRS tax return.
        </p>
        <p class=" ">
            <span class="text-c-blue">IRS Website: </span>
            The IRS can provide you with a tax transcript (a summary) or a full copy of your return.
            For a Transcript (Free)
        </p>
        <p class="mb-0">Online:</p>
        <p class="mb-0">&nbsp;&nbsp;Visit the IRS Get Transcript Online tool.
            <a href="https://www.irs.gov/individuals/get-transcript" target="_blank"
                class="text-c-blue ">https://www.irs.gov/individuals/get-transcript</a>
        </p>
        <ol class=" fs-16px">
            <li>Log in or create an account.</li>
            <li>Download your transcript instantly.</li>
        </ol>
    </div>

    <div class="hide-data popup-vehicle-registration">
        <img class="webkit_fill" alt="Vehicle Registration"
            src="{{ url('assets/img/popup-vehicle-registration.png') }}" />
    </div>
    <div class="hide-data popup-insurance-documents">
        <img class="webkit_fill" alt="Insurance Documents"
            src="{{ url('assets/img/popup-insurance-documents.png') }}" />
    </div>
    <div class="hide-data popup-miscellaneous-doucments">
        <p><strong>Additional or Unlisted Documents:</strong>&nbsp;This upload is for any and all documents your unsure
            of where they might go.
            You can upload any document here and your attorney will be able to see it and they can easily move it into
            any category they need it to go.</p>
    </div>
    <div class="hide-data venmo-statement-popup">
        <h5 class="">How to get Venmo statements:</h5>
        <div class="d-flex">
            @if (isset($venmoVideos) && !empty($venmoVideos))
                @foreach ($venmoVideos as $key => $value)
                    @php
                        $path = 'assets/img/' . $key . '.png';
                    @endphp
                    <div class="guide-video-div form-group text-center {{ $key }}">
                        <label class="w-100 mb-0 fs-12px">Tap/select:</label>
                        <a href="javascript:void(0)" class="download-forms " title="Venmo {{ $key }} Guide Video"
                            data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                            data-video="{{ Helper::validate_key_value('en', $value) }}" data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                            <img alt="icon" src="{{ url($path) }}" width="{{ $key == 'desktop_laptop' ? '55px' : '40px' }}">
                            <br /><small>{!! VideoHelper::getVideoButtonLabel($key) !!}</small>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="hide-data paypal-statement-popup">
        <h5 class="">How to get PayPal statements:</h5>
        <div class="d-flex guide-video-div paypalVideo">
            @if (isset($paypalVideos) && !empty($paypalVideos))
                @foreach ($paypalVideos as $key => $value)
                    @php
                        $path = 'assets/img/' . $key . '.png';
                    @endphp
                    <div class="guide-video-div form-group w-auto text-center paypal_div paypalVideo">
                        <label class="w-100 mb-0 fs-12px">Tap/select:</label>
                        <a href="javascript:void(0)" class="download-forms " title="Paypal {{ $key }} Video"
                            data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                            data-video="{{ Helper::validate_key_value('en', $value) }}" data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                            <img alt="icon" src="{{ url($path) }}" width="{{ $key == 'desktop_laptop' ? '55px' : '40px' }}">
                            <br /><small>{!! VideoHelper::getVideoButtonLabel($key) !!}</small>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="hide-data cash-statement-popup">
        <h5 class="">How to get Cash App statements:</h5>
        <div class="d-flex guide-video-div cashVideo">
            @if (isset($cashAppVideos) && !empty($cashAppVideos))
                @foreach ($cashAppVideos as $key => $value)
                    @php
                        $path = 'assets/img/' . $key . '.png';
                    @endphp
                    <div class="guide-video-div cash_app_div cashVideo form-group w-auto text-center">
                        <label class="w-100 mb-0 fs-12px">Tap/select:</label>
                        <a href="javascript:void(0)" class="download-forms " title="Cashapp {{ $key }} Guide Video"
                            data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                            data-video="{{ Helper::validate_key_value('en', $value) }}" data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                            <img alt="icon" src="{{ url($path) }}" width="{{ $key == 'desktop_laptop' ? '55px' : '40px' }}">
                            <br /><small>{!! VideoHelper::getVideoButtonLabel($key) !!}</small>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endif

<!-- Credit report popup for all -->
<div class="hide-data credit-report-popup">
    <h5 class="">How to get Credit Report statements:</h5>
    <div class="d-flex">
        @if (isset($creditReportVideos) && !empty($creditReportVideos))
            @foreach ($creditReportVideos as $key => $value)
                @php
                    $path = 'assets/img/' . $key . '.png';
                @endphp
                <div class="guide-video-div form-group text-center {{ $key }}">
                    <label class="w-100 mb-0 fs-12px">Tap/select:</label>
                    <a href="javascript:void(0)" class="download-forms " title="Venmo {{ $key }} Guide Video"
                        data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                        data-video="{{ Helper::validate_key_value('en', $value) }}" data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                        <img alt="icon" src="{{ url($path) }}" width="{{ $key == 'desktop_laptop' ? '55px' : '40px' }}">
                        <br /><small>{!! VideoHelper::getVideoButtonLabel($key) !!}</small>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/common_client_upload_view.css') }}?v=2.12">
@endpush
@push('tab_scripts')
    <script>
        window.__commonClientUploadRoutes = {
            markNotOwnDocument: "{{ route('mark_not_own_document') }}",
            markNotOwnPaystub: "{{ route('mark_not_own_paystub') }}",
            clientDocumentsDownloadPopup: "{{ route('client_documents_download_popup') }}",
            clientDocumentsDownloadPopupSingleDelete: "{{ route('client_documents_download_popup_single_delete') }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/common_client_upload_view.js') }}"></script>
@endpush