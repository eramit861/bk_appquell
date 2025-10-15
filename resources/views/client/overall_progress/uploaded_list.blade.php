
{{-- post submission doc list --}}
@if($uploadedList) <ul class="debtor-docs"> @endif
    @foreach($documentTypes as $key => $name)
        @php
            $isPaystub = 0;
        @endphp
        @if ($key === 'Post_submission_documents' || str_starts_with($key, 'post_submission_doc_'))
            @include('client.overall_progress.list_item', ['isPaystub' => $isPaystub])
        @endif
    @endforeach
@if($uploadedList) </ul> @endif

{{-- debtor doc list --}}
@if($uploadedList) <ul class="debtor-docs"> @endif
    @foreach($documentTypes as $key => $name)
        @php
        $isPaystub = 0;
        if (!in_array($key, ['Debtor_Pay_Stubs','Drivers_License','Social_Security_Card'])) {
            continue;
        }
        if ($key === 'Debtor_Pay_Stubs') {
            $isPaystub = 1;
        }
        @endphp
        @include('client.overall_progress.list_item', ['isPaystub' => $isPaystub])
    @endforeach
@if($uploadedList) </ul> @endif

{{-- codebtor doc list --}}
@php
    $dNoneClass = 'd-none';
$coDebHeading = "Co-Debtor's Document List";
if ($client->client_type == 2) {
    $dNoneClass = '';
    $coDebHeading = "Non-Filing Spouse Pay Stubs";
}
if ($client->client_type == 3) {
    $dNoneClass = '';
}
@endphp
@if($uploadedList) <ul class="codebtor-docs {{ $dNoneClass }}"> @endif
    @foreach($documentTypes as $key => $name)
        @php
        $isPaystub = 0;
        if (!in_array($key, ['Co_Debtor_Pay_Stubs','Co_Debtor_Drivers_License','Co_Debtor_Social_Security_Card'])) {
            continue;
        }
        if ($key === 'Co_Debtor_Pay_Stubs') {
            $isPaystub = 1;
        }
        @endphp
        @include('client.overall_progress.list_item', ['isPaystub' => $isPaystub])
    @endforeach
@if($uploadedList) </ul> @endif

{{-- secured loan doc list --}}
@if($uploadedList) <ul class="codebtor-docs"> @endif
    @php
    $documentlisttoexlude = $mortages;
$documentlisttoexlude1 = array_merge($documentlisttoexlude, $vehicles);
$documentlisttoexlude2 = array_merge($documentlisttoexlude1, []);
@endphp
    @foreach($documentTypes as $key => $name)
        @if(!in_array($key, $documentlisttoexlude2))
            @continue
        @endif
        @include('client.overall_progress.list_item')
    @endforeach
@if($uploadedList) </ul> @endif

{{-- attorney doc list --}}
@if(!empty($attorneydocuments) && is_array($attorneydocuments))
    @if($uploadedList) <ul class="attorney-docs"> @endif
        @foreach($attorneydocuments as $doctype_key => $val)
            @php
            $attorneydocKey = $doctype_key;
            $uploadedClass = "";
            $statusmsg = 'Not Submitted Yet';
            $bgClass = "text-red";
            $docData = Helper::getDocumentImage($key);

            $svgname = Helper::validate_key_value('svg', $docData);
            $svgUrl = asset("assets/img/red_icons/".$svgname);
            // $svg_file = file_get_contents("assets/img/doc_icons/home_loan.svg");
            if (in_array($attorneydocKey, @$documentuploaded)) {
                $doc = Helper::getArrayByKey($attorneydocKey, $list);
                // $uploadedClass="color-yellow";
                $bgClass = "text-yellow";
                $statusmsg = "Submitted Waiting for Approval";
                $svgUrl = asset("assets/img/yellow_icons/".$svgname);
                // $fStatus = '<i class="fas fa-check-circle"></i>';
                if (!empty($doc)) {
                    $renabledupload = $doc['document_enable_reupload'];
                    $declineReason = $doc['document_decline_reason'];
                    $status = $doc['document_status'];
                    if ($status == 1) {
                        $statusmsg = "Accepted";
                        // $uploadedClass="color-green";
                        $bgClass = "text-green";
                        $svgUrl = asset("assets/img/green_icons/".$svgname);
                        // $fStatus = '<i class="fas fa-check-circle"></i>';
                    }
                    if ($status == 2) {
                        $statusmsg = "Declined";
                        // $uploadedClass="color-yellow-decline";
                        $bgClass = "text-red";
                        $svgUrl = asset("assets/img/red_icons/".$svgname);
                        // $fStatus = '<i class="fas fa-ban"></i>';
                    }
                }
            }

            if (in_array($doctype_key, $notOwnedDocs)) {
                $statusmsg = 'Client selected no document available';
                $bgClass = "text-yellow";
                $statusFontColor = "";
                $svgUrl = asset("assets/img/yellow_icons/".$svgname);
            }
            @endphp

            @if($uploadedList && (!empty(Helper::getArrayByKey($doctype_key, $list)) || (in_array($doctype_key, $notOwnedDocs))))
         <li class="{{ $bgClass }} text-center">
                <a href="{{ route('list_uploaded_documents') }}" class="nav-linkf anchor_diable text-left  {{ $uploadedClass }} d-flex"
                    data-bs-toggle="modal" data-type="{{$attorneydocKey}}"
                    >
                    @php $postfix = !empty($statusmsg) ? '&nbsp;<span class="font-weight-bold status-message"> ('.$statusmsg.')</span>' : ''; @endphp
                    <div class="d-status"><img src="{{ $svgUrl }}" class="doc-icon" width="35px" alt="icon">
                    </div>
                    <div class="{{$bgClass}} b-none doc-card">
                        {!! $val.$postfix !!}
                    </div>
                </a>
            </li>
        @endif


            @if(!$uploadedList && ($uploadedDocsProgress != 100) && (empty(Helper::getArrayByKey($doctype_key, $list))) && !in_array($doctype_key, $notOwnedDocs))
            @if(!$uploadedList) <div class="col-md-6"> @endif
          
            <li class="{{ $bgClass }} text-center">
                <a href="{{ route('list_uploaded_documents') }}" class="nav-linkf anchor_diable text-left  {{ $uploadedClass }} d-flex"
                    data-bs-toggle="modal" data-type="{{$attorneydocKey}}"
                    >
                    @php $postfix = !empty($statusmsg) ? '&nbsp;<span class="font-weight-bold status-message"> ('.$statusmsg.')</span>' : ''; @endphp
                    <div class="d-status"><img src="{{ $svgUrl }}" class="doc-icon" width="35px" alt="icon">
                    </div>
                    <div class="{{$bgClass}} b-none doc-card">
                        {!! $val.$postfix !!}
                    </div>
                </a>
            </li>
            @if(!$uploadedList) </div> @endif
        @endif
        @endforeach
    @if($uploadedList) </ul> @endif
@endif


{{-- tax return doc list --}}
@if($uploadedList) <ul class="codebtor-docs"> @endif
    @php
    $documentlisttoexlude = ['Last_Year_Tax_Returns','Prior_Year_Tax_Returns','Prior_Year_Two_Tax_Returns','Prior_Year_Three_Tax_Returns','W2_Last_Year','W2_Year_Before'];
@endphp
    @foreach($documentTypes as $key => $name)
        @if(!in_array($key, $documentlisttoexlude))
            @continue
        @endif
        @include('client.overall_progress.list_item')
    @endforeach
@if($uploadedList) </ul> @endif

{{-- Misc. Doc(s)/Requested Documents doc list --}}
@if($uploadedList) <ul class="attorney-docs requt_docs"> @endif

    @foreach($documentTypes as $key => $name)
        @if(!in_array($key, ['Miscellaneous_Documents', 'Other_Misc_Documents', 'Insurance_Documents']))
            @continue
        @endif
        @include('client.overall_progress.list_item')
    @endforeach
        @php

    $datamultiple = [];
$venmoPaypalCash = @$docsUploadInfo["venmoPaypalCash"];
$brokerageAccount = @$docsUploadInfo["brokerageAccount"];
foreach ($list as $dc) {
    if (in_array($dc['document_type'], array_keys($clientDocs)) || in_array($dc['document_type'], array_keys($venmoPaypalCash)) || in_array($dc['document_type'], array_keys($brokerageAccount))) {
        $datamultiple[] = $dc;
    }
}
@endphp
@if(is_array($requestedDocuments) && !empty($requestedDocuments))
    @php
    $bank_account_documents = \App\Models\ClientDocuments::getClientBankDocumentList($client_id);
    $brokerage_documents = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'brokerage_account');
    @endphp
    @foreach($requestedDocuments as $key => $name)
        @if(in_array($key, ['Debtor_Pay_Stubs','Drivers_License','Social_Security_Card']))
            @continue
        @endif
        @if(in_array($key, ['Co_Debtor_Pay_Stubs','Co_Debtor_Drivers_License','Co_Debtor_Social_Security_Card']))
            @continue
        @endif
        @php
        $bankline = '';
        $textToDisplay = '';
        $isStatements = 0;
        $bank_statement_month_nos = $bank_statement_months;
        if ((in_array($key, array_keys($clientDocs)) || in_array($key, array_keys($venmoPaypalCash))) && !empty($bank_statement_months)) {

            if (isset($bank_account_documents) && !empty($bank_account_documents)) {
                foreach ($bank_account_documents as $docu) {
                    if ($docu['document_name'] === $key) {
                        $bank_statement_month_nos = ($docu['bank_account_type'] == 2) ? ($attProfitLossMonths) : $bank_statement_months;
                        break;
                    }
                }
            }

            $bankline = 'Upload your last '.$bank_statement_month_nos.' months of statements ';
            $isStatements = 1;

            $statement_month_array = DateTimeHelper::getBankStatementShortMonthArray($bank_statement_month_nos);
            $datamultiple = $datamultiple ?? [];
            $matchingObjects = array_filter($datamultiple, function ($item) use ($key) {
                return $item['document_type'] === $key;
            });

            $missing_months = '';
            foreach ($statement_month_array as $month_key => $month_value) {
                $found = false;
                foreach ($matchingObjects as $object) {
                    if ($object['document_month'] === $month_key) {
                        $found = true;
                        $missing_months .= '<span class="text-c-green">'.$month_value.'</span>, ';
                        ;
                        break;
                    }
                }
                if (!$found) {
                    $missing_months .= '<span class="text-c-red">'.$month_value . '</span>, ';
                }
            }
            $missing_months = rtrim($missing_months, ', ');
            if (!empty($missing_months)) {
                $textToDisplay = $missing_months;
            } else {
                $textToDisplay = "<span class='text-c-green font-weight-bold ml-2'>All Uploaded</span>";
            }

            $isBrokerage = 0;
            if (isset($brokerage_documents) && !empty($brokerage_documents)) {
                foreach ($brokerage_documents as $docuType => $docuName) {
                    if ($docuType === $key) {
                        $bankline = 'Upload your last 1 month of statements ';
                        $isStatements = 0;
                        $isBrokerage = 1;
                        break;
                    }
                }
            }

        }
        @endphp
        @include('client.overall_progress.list_item',['bankline' => $bankline, 'isStatements' => $isStatements])
    @endforeach
@endif
@if($uploadedList) </ul> @endif

@if(!$uploadedList && ($uploadedDocsProgress == 100))
    <span class="text-center color-green w-100 text-bold">You have uploaded all requested/required documents <img src="{{asset('assets/img/double_thumbs_up.png')}}" alt="overview" class="w-48px h-48px"></span>
@endif

