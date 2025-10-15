@php
    $web_view = Session::get('web_view');
    $isPaystub = 0;
    $isStatements = 0;

    $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
    $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

    if (
        $user->client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION &&
        $user->hide_questionnaire == 0
    ) {
        $list = @$docsUploadInfo['list'];
        $documentuploaded = @$docsUploadInfo['documentuploaded'];
        $venmoPaypalCash = @$docsUploadInfo['venmoPaypalCash'];
        $brokerageAccount = @$docsUploadInfo['brokerageAccount'];
        $unpaidWages = @$docsUploadInfo['unpaidWages'];

        $attorneydocuments =
            isset($docsUploadInfo['attorneydocuments']) && is_array($docsUploadInfo['attorneydocuments'])
                ? $docsUploadInfo['attorneydocuments']
                : [];
        $attorney_id = @$docsUploadInfo['attorney_id'];
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;

        $requestedDocuments =
            isset($docsUploadInfo['requestedDocuments']) && is_array($docsUploadInfo['requestedDocuments'])
                ? $docsUploadInfo['requestedDocuments']
                : [];
        $adminDocuments =
            isset($docsUploadInfo['adminDocuments']) && is_array($docsUploadInfo['adminDocuments'])
                ? $docsUploadInfo['adminDocuments']
                : [];

        $hidebtn = @$docsUploadInfo['hidebtn'];
        $clientDocs = @$docsUploadInfo['clientDocs'];
        if (!empty($adminDocuments)) {
            $requestedDocuments = array_merge($requestedDocuments, $adminDocuments);
        }
        if ($isBankStatementEnabled) {
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

        $documentTypes = @$docsUploadInfo['documentTypes'];
        $notOwnedDocs = @$docsUploadInfo['notOwnedDocs'];
        $attorney = \App\Models\ClientsAttorney::where('client_id', $client_id)->first();
        $excludeDocs = \App\Models\AttorneyExcludeDocs::where([
            'attorney_id' => $attorney_id,
            'is_associate' => $is_associate,
        ])->first();
        $excludeDocs =
            !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json)
                ? json_decode($excludeDocs->doc_type_json, 1)
                : [];

        $AttorneyExcludeDocsPerClient = \App\Models\AttorneyExcludeDocsPerClient::where([
            'attorney_id' => $attorney_id,
            'client_id' => $client_id,
        ])->first();
        $AttorneyExcludeDocsPerClient = !empty($AttorneyExcludeDocsPerClient)
            ? $AttorneyExcludeDocsPerClient->toArray()
            : [];
        $docJsonPerClient = Helper::validate_key_value('doc_type_json', $AttorneyExcludeDocsPerClient);
        $docJsonPerClient = json_decode($docJsonPerClient) ?? [];
        $mergedArray = array_merge($excludeDocs, $docJsonPerClient);
        $excludeDocs = array_unique($mergedArray);

        $clientPropertyData = \App\Services\Client\CacheProperty::getPropertyData($client_id);
        $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
        $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

        $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList(
            $clientProperty,
            false,
            true,
        );
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

        $documentTypes = array_merge($documentTypes, $mortgageUpdatedNames);
        $documentTypes = array_merge($documentTypes, $vehicleUpdatedNames);
        array_push($excludeDocs, 'Debtor_Creditor_Report');
        array_push($excludeDocs, 'Co_Debtor_Creditor_Report');

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
    }
    $displayMiddle = false;
    $colclass = 6;
    if ((is_array($attorneydocuments) && !empty($attorneydocuments)) || in_array($client->client_type, [2, 3])) {
        $colclass = 4;
        $displayMiddle = true;
    }

    $isPostSubmissionEnabled = \App\Models\ClientSettings::isPostSubmissionEnabled($client_id);
    $postSubmissionDocumentType = $documentTypes;
    $postSubmissionAttorneydocuments = $attorneydocuments;
    $postSubmissionRequestedDocuments = $requestedDocuments;
    if ($isPostSubmissionEnabled) {
        $postSubmissionDocumentType = [\App\Models\ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents"];
        $postSubmissionAttorneydocuments = [];
        $postSubmissionRequestedDocuments = [];
    }
    $clientPSDocuments = \App\Models\ClientDocuments::getClientPostSubmissionDocumentList($client_id);
    if ($clientPSDocuments) {
        foreach ($clientPSDocuments as $key => $document) {
            $postSubmissionDocumentType[Helper::validate_key_value('document_name', $document)] = Helper::validate_key_value('document_type', $document);
        }
    }

    $attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
@endphp
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-c-blue">Uploaded Document List</h5>
            </div>
            <div class="card-body p-3">
                @include('client.overall_progress.uploaded_list', ['uploadedList' => true])
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-c-blue">Documents Required to Complete/Submit Your Questionnaire</h5>
            </div>
            <div class="card-body p-3">
                <div class="row debtor-docs codebtor-docs attorney-docs requt_docs">
                    @include('client.overall_progress.uploaded_list', [
                        'uploadedList' => false,
                        'documentTypes' => $postSubmissionDocumentType,
                        'attorneydocuments' => $postSubmissionAttorneydocuments,
                        'requestedDocuments' => $postSubmissionRequestedDocuments,
                    ])
                </div>
            </div>
        </div>
    </div>
</div>


@push('tab_scripts')
    <script>
        window.__clientProgressUploadViewRoutes = {
            markNotOwnDocument: "{{ route('mark_not_own_document') }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/client_progress_upload_view.js') }}"></script>
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/client_progress_upload_view.css') }}">
@endpush