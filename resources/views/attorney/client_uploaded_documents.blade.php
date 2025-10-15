@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")
<script src="{{ asset('assets/js/facebox.js' )}}"></script>


<?php
 $localForms = [];
foreach ($tabData as $disdata) {
    if ($disdata['type'] == 'local' && $disdata['chapter_type'] != 13) {
        array_push($localForms, $disdata);
    }
}
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

$ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($val['id']);
$settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
$is_associate = !empty($ClientsAssociateId) ? 1 : 0;
$attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($settingsAttorneyId, $is_associate);

$unreadcount = \App\Models\SignedDocuments::where(['attorney_id' => $attorney_id, 'client_id' => $val['id'],'read_by_attorney' => 0])->whereNotNull('sign_document')->count();
$notIn = ['document_sign','signed_document'];

//$unreadDoccount = \App\Models\ClientDocumentUploaded::where(['client_id' => $val['id'],'is_viewed_by_attorney'=>0])->whereNotIn('document_type',$notIn)->count();
$unreadDoccountArray = (new \App\Models\ClientDocumentUploadedData())->getClientUploadDocData($val['id'], $attorney_id);

$unreadDoccount = isset($unreadDoccountArray['unreadDocuments']) ? count($unreadDoccountArray['unreadDocuments']) : 0;
$date = date_create($val['created_at']);
$formated_DATETIME = date_format($date, 'M dS, Y');

$attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['attorney_enabled_bank_statment'])->first();
$attorney_enabled_bank_statment = !empty($attorneySettings) ? $attorneySettings->attorney_enabled_bank_statment : 1;
$formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $val['id']])->first();
$payrollRoute = route('client_paystub', ['id' => $val['id'], 'type' => 'paystub']);
if ($val['client_payroll_assistant'] == 2) {
    $payrollRoute = route('client_paystub_partner', ['id' => $val['id'], 'type' => 'paystub']);
}
?>

<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<!-- [ Main Content ] start -->
<div class="row">
	<!-- @include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type]) -->
	@include('attorney.client.manage.common_client_description')

    <div class="col-12">
        <div class="card information-area mt-3">
			
			@include('attorney.client.manage.common_tab_links')
            
            <div class="card-body border-top-left-radius-none">
                <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
                        <div class="row">
                            <div class="col-md-12">
                                @include("attorney.doc_mgmt.screen_wrapper")
                                <div class="container-1140">
                                    <div class="upload-documents-wrapper">
                                        <?php

                                            $autoloankeysWithoutMaster = array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(0));
$mortloankeysWithoutMaster = array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(0));
$clientPropertyData = \App\Services\Client\CacheProperty::getPropertyData($client_id);
$clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
$clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];
$cardsArray = \App\Models\ClientDocumentUploaded::getCardTypeArray();
$listTaxes = \App\Models\ClientDocumentUploaded::getTaxYearArray();
$alldocKeys = array_column($documentuploaded, 'document_type');
$allDocs = $documentuploaded;
$docsMisc = $attorneyDocs;
array_push($docsMisc, 'Miscellaneous_Doucments');
$doc_page_open = false;
$route = route('upload_client_date', ['client_id' => @$client_id]);
$refreenceParent = Session::get('refrence_parent');
$refreenceAdmin = Session::get('refrence_admin');

?>
                                    
                                            <section class="">
                                            <?php if (in_array('Post_submission_documents', $alldocKeys)) {
                                                $autoloankeys = $mortloankeys = [];

                                                $combinedForm = true;
                                                $data = $documentuploaded[0] ?? [];
                                                if (isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] == $data['document_type'] && !in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
                                                    $doc_page_open = true;
                                                }
                                                $indicator = "d-none";


                                                if (in_array('Post_submission_documents', $unreadDocuments)) {
                                                    $indicator = "";
                                                }

                                                $multiplecount = isset($data['multiple']) ? count($data['multiple']) : 0;

                                                ?>
                                            <div class="row mb-0 pb-0">
                                                <div class="col-md-12">
                                                <table class="table w-100 mb-2">
                                                    <tbody>
                                                        <tr style="background-color:#ffb0ab; color:#000000;">
                                                        <td style="width:4%">
                                                                <a href="javascript:void(0)" class="upload_doc_line view_client_btn" onclick="both_upload_modal('<?php echo $data['document_type']; ?>',$(this).data('text'), '', 0 , 0,0 )" data-type="<?php echo $data['document_type']; ?>" data-text="<?php echo $data['document_name']; ?>"> <i class="fa fa-upload" aria-hidden="true"></i> Click to Upload File(s)</a>
                                                                
                                                                </td>
                                                                <td style="width:3%">
                                                                <img src="{{asset('assets/img/black_icons/misc_docs.svg')}}" class="licence-img " alt="Doc Icon" style="height:40px">
                                                                <span class="unread-indicator {{$indicator}} ki">New Doc(s) Uploaded</span>
                                                                </td>

                                                            <td style="width:40%;position:relative;">
                                                            <?php if (isset($data['multiple']) && count($data['multiple']) > 0) { ?>
                                                                <a title="Select to view all documents" href="<?php echo route('attorney_client_uploaded_documents', ['id' => $val['id']]).'?type='.$data['document_type'] ?>">
                                                            <span style="color:{{@$color}}" class="titleh  bold-wide">
                                                                <?php echo $data['document_name']; ?>
                                                            
                                                            </span>
                                                        
                                                            </a>
                                                            <?php echo !empty($acceptedCount) ? " <small class='ml-1 font-weight-bold text-c-green'>(Completed:".$acceptedCount.")</small>" : '';?>
                                                            <?php echo !empty($declinedCount) ? " <small class='font-weight-bold text-c-red'>(Not Completed:".$declinedCount.")</small>" : '';?>
                                                            
                                                            @include("attorney.doc_mgmt.doc_request_flag")

                                                            <?php } else {

                                                                ?>
                                                                <span style="color:{{@$color}}" class="<?php if (!in_array($data['document_name'], ["Current Auto Loan Statements","Current Mortgage Statements"])) {
                                                                    echo "doc_heading_title";
                                                                } if (in_array($data['document_type'], ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report']) && $data['id'] == 0) {
                                                                    echo 'red_credit';
                                                                } ?>  titleh   bold-wide">
                                                                    <?php echo $data['document_name']; ?>
                                                                    @include("attorney.doc_mgmt.doc_request_flag")
                                                                    
                                                                    <?php if (!empty($notOwnedproperty)) { ?> 
                                                                        <br><span style="text-decoration:none !important;" class="small-text-font text-left text-c-red">({{$notOwnedproperty}})</span> 
                                                                    <!-- <a href="javascript:void(0)" class="view_client_btn" onclick="rmeoveFromNotOwn('<?php echo $client_id; ?>','<?php echo $keyNotOwn;?>')">To allow Client click here</a> -->
                                                                <?php } ?>
                                                                </span>
                                                                
                                                                <?php }?>
                                                                <?php
                                                                $acceptedCount = 0;
                                                $declinedCount = 0;
                                                if (isset($data['multiple']) && is_array($data['multiple'])) {
                                                    foreach ($data['multiple'] as $dic) {
                                                        if ((isset($dic['document_status']) && $dic['document_status'] == 1) || (isset($dic['added_by_attorney']) && ($dic['added_by_attorney'] == 1))) {
                                                            $acceptedCount++;
                                                        }
                                                        if (isset($dic['document_status']) && $dic['document_status'] == 2) {
                                                            $declinedCount++;
                                                        }

                                                    }

                                                } ?>
                                                                <?php echo !empty($acceptedCount) ? " <small class='ml-1 font-weight-bold text-c-green'>(Accepted:".$acceptedCount.")</small>" : '';?>
                                                                <?php echo !empty($declinedCount) ? " <small class='font-weight-bold text-c-red'>(Declined:".$declinedCount.")</small>" : '';?>
                                                            
                                                            </td>
                                                            <td style="width:45%">
                                                                <?php if ($multiplecount > 0) { ?>
                                                            @include("attorney.doc_mgmt.document_actions",['is_main' => 1])
                                                            <?php } ?>
                                                            </td>
                                                            <td style="text-align:right;width:8%">
                                                            <?php
                                                        if ($multiplecount > 0 && !in_array($data['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                                                            ?>
                                                            <a class="text-underline text-c-black toggle-docs" href="javascript:void(0)" onclick="toggleDocPage(this)" data-select-id="{{$data['document_type']}}" data-document-type="<?php echo $data['document_type']; ?>" data-client-id="{{$val['id']}}"> <span style="font-size:10px;"> <?php echo $doc_page_open == true ? 'Hide ' : 'Show'; ?> {{$multiplecount}} doc(s) <i class="fa fa-angle-<?php echo $doc_page_open == true ? 'up' : 'down';?>" aria-hidden="true"></i></span></a>
                                                        <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php   if (isset($data['multiple']) && is_array($data['multiple']) && !empty($data['multiple']) && !in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) { ?>
                                                            <tr class="sub_docs {{$doc_page_open?"":"d-none"}} document_select" id="select_{{$data['document_type']}}" data-document-type="{{$data['document_type']}}" data-select-id="{{$data['document_type']}}">
                                                                <td colspan="5" class="m-0 p-0 pl-1" id="Content_{{$data['document_type']}}">
                                                                    @if($doc_page_open)
                                                                        @include("attorney.doc_mgmt.sub_docs")
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        <?php  }  unset($documentuploaded[0]);
                                                $doc_page_open = false;
                                                $acceptedCount = 0;
                                                $declinedCount = 0; ?>
                                                        </tbody>
                                                        </table>
                                                </div> </div>
                                                <?php }
                                            ?>
                                                <div class="row">
                                                <div class="col-md-12 mb-2">
                                                <table style="width:100%;">
                                                        <tr style="background-color:#d3cece; color:#000000;">
                                                        <td style="width:4%">
                                                                <td style="width:3%;position:relative;padding:4px 4px 4px 0px;">
                                                                    <img src="{{asset('assets/img/black_icons/license.svg')}}" class="licence-img " alt="License" style="height:40px">
                                                                    <span class="unread-indicator d-none ki">New Doc(s) Uploaded</span>
                                                                </td>
                                                            <td style="width:40%">
                                                                <span style="color:#000000;" class="doc_heading_title  titleh  small_font">
                                                                Debtor(s) ID Information:</span>
                                                            </td>
                                                            <td style="width:46%">
                                                            
                                                            </td>
                                                            <td style="text-align:right;width:8%"></td>
                                                        </tr>
                                                        </table>
                                                </div> </div>
                                                <div class="row">
                                                    <?php
                                                    $basicDocumentList = $cardsArray;

$ind = 1;?>
                                                    @foreach($documentuploaded as $key => $data)
                                                    @if(!empty($data['document_type']) && in_array($data['document_type'], $basicDocumentList))
                                                        @php
                                                        $docData = Helper::getDocumentImage($data['document_type']??'');
                                                        if(empty($docData)){
                                                            $otype = \App\Models\ClientDocumentUploaded::OTHER_MISC_DOCUMENTS;
                                                            $docData = Helper::getDocumentImage($otype);
                                                        }
                                                        $doclasscs = 'not-uploaded';
                                                        if($data['id'] > 0){
                                                            $doclasscs = '';
                                                        }
                                                        $displayMainName = false;

                                                        $indicator = "d-none";
                                                        if(in_array($data['document_type'],$unreadDocuments)) {
                                                            $indicator = "";
                                                        }
                                                        

                                                        $valid_document_types = ['bank_statements', 'other_income','retirement_docs','type_venmo_paypal_cash','type_brokerage_account','requested_documents'];

                                                        $declineText = '';
                                                        $showResubmitDoc = false;
                                                        $docActiveChildClass= "";
                                                        if (!empty($data['id'])) {
                                                            if($data['document_status'] == 2) {
                                                                $declineText = $data['document_decline_reason'];
                                                            }

                                                            if($data['document_status'] == 1) {
                                                                $showResubmitDoc = true;
                                                                $docActiveChildClass = '';
                                                            }
                                                        }

                                                        $autoloankeys = array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1));
                                                        $mortloankeys = array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(1));
                                                        $mu = \App\Models\ClientDocumentUploaded::MULTIPLE_DOC_ALLOWED_FOR;
                                                        $mu = array_merge($mu,$attorneyDocs);
                                                        $mu = array_merge($mu,array_keys($clientDocs));
                                                        $mu = array_merge($mu,array_keys($venmoPaypalCash));
                                                        $mu = array_merge($mu,array_keys($brokerageAccount));
                                                        $mu = array_merge($mu,array_keys($unpaid_wages));
                                                        $mu = array_merge($mu,array_keys($retirement_pension));
                                                        
                                                        $mu = array_merge($mu,$adminDocs);
                                                        if(in_array($data['document_type'],$mu)){
                                                            $displayMainName = true;

                                                        }
                                                        $clasforli = '';


                                                        array_shift($autoloankeys);
                                                        array_shift($mortloankeys);
                                                        if(in_array($data['document_type'],$autoloankeys) || in_array($data['document_type'],$mortloankeys)){
                                                            $clasforli =  ' p-l-20 p-r-20 ';
                                                        }

                                                        // $autoloankeys


                                                        $notOwnedproperty = '';
                                                        $keyNotOwn = $data['document_type'];
                                                        

                                                        $svgname = Helper::validate_key_value('svg',$docData);
                                                        $svgname = empty($svgname)?'attorney_docs.svg':$svgname;
                                                        $svgUrl = asset("assets/img/black_icons/".$svgname);
                                                        $keyNotOwn = $data['document_type'];
                                                    
                                                        if (in_array($data['document_type'], $notOwned)) {
                                                            $notOwnedproperty = "Client selected no document available";
                                                        }
                                                        @endphp
                                                        
                                                    
                                                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-2">
                                                            <div class="box-size-box">
                                                                <div class="text-center main-box-1">
                                                                    <img src="{{$svgUrl}}" alt="icon">
                                                                <!--<span class="unread-indicator {{$indicator}}"></span>-->
                                                                </div>

                                                                <div class="text-center main-box-1">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                        
                                                                            @include("attorney.doc_mgmt.accept_decline_btns")
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="fw-bold"><?php echo $data['document_name'] ?? "";
$colorreq = 'red';
if ((isset($data['document_status']) && $data['document_status'] == 1) || (isset($data['added_by_attorney']) && ($data['added_by_attorney'] == 1))) {
    $colorreq = 'green';
}
?>
                                                                    @include("attorney.doc_mgmt.doc_request_flag", ['colored' => $colorreq])
                                                                <?php if (!empty($notOwnedproperty)) { ?>
                                                                    <br> <span class="small-text-font text-c-red">({{$notOwnedproperty}})</span>
                                                                    <?php } ?>
                                                                    </h5>
                                                                </div>
                                                                <div class="text-center main-box-1 pt-2 pb-2">
                                                                    <a href="javascript:void(0)" class="upload_doc_line view_client_btn"
                                                                    onclick="both_upload_modal('<?php echo $data['document_type']; ?>',$(this).data('text'))" data-type="<?php echo $data['document_type']; ?>"
                                                                    title="Select to Upload Document"
                                                                    data-text="<?php echo $data['document_name']; ?>">
                                                                        <i class="fa fa-upload" aria-hidden="true"></i>  Click to Upload File(s)
                                                                    </a>
                                                                </div>

                                                            
                                                                <div class="mt-2">
                                                                    <?php if (empty($doclasscs)) { ?>
                                                                    @include("attorney.doc_mgmt.btn_actions")
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            @php unset($documentuploaded[$key]) @endphp
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </section>

                                            
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                <table style="width:100%;">
                                                        <tr style="background-color:#d3cece; color:#000000">
                                                        <td style="width:4%">
                                                                <td style="width:3%;position:relative;padding:4px 4px 4px 0px;">
                                                                    <img src="{{asset('assets/img/black_icons/license.svg')}}" class="licence-img " style="height:40px" alt="License">
                                                                    <span class="unread-indicator d-none ki">New Doc(s) Uploaded</span>
                                                                </td>
                                                            <td style="width:40%">
                                                                <span style="color:#000000" class=" doc_heading_title titleh  small_font">
                                                                Secured Debts:</span>
                                                            </td>
                                                            <td style="width:46%">
                                                                
                                                            </td>
                                                            <td style="text-align:right;width:8%"></td>
                                                        </tr>
                                                        </table>
                                                </div> </div>


                                        <table class="table table-full-width w-100 h-100" style="display: block; overflow-x: auto;">

                                            <?php
                                            $checkbox = false;
$ind = 1;
$ind3 = 1;
$taxind = 1;
$w2ind = 1;
$cdocind = 1;
$miscdocind = 1;
$paystind = 1;
$autlindx = 1;
$mortindx = 1;
$vehicleIns = 1;
$miscattdoc = 1;
$unsecdebtindx = 1;
$venmoPaypalCashindx = 1;
$brokerageAccountindx = 1;

$twocolsDocs = [];
$twocolsDocs = array_merge($twocolsDocs, $listTaxes);
$twocolsDocs = array_merge($twocolsDocs, ['W2_Last_Year','W2_Year_Before']);
$twocolsDocs = array_merge($twocolsDocs, array_keys($clientDocs));
$twocolsDocs = array_merge($twocolsDocs, array_keys($venmoPaypalCash));
$twocolsDocs = array_merge($twocolsDocs, array_keys($brokerageAccount));

//$twocolsDocs =  array_merge($twocolsDocs,["Miscellaneous_Documents","Other_Misc_Documents"]);
// $twocolsDocs = array_merge($twocolsDocs,["Debtor_Pay_Stubs","Co_Debtor_Pay_Stubs"]);
$twocolsDocs = array_merge($twocolsDocs, $autoloankeysWithoutMaster);
$twocolsDocs = array_merge($twocolsDocs, $mortloankeysWithoutMaster);
$twocolsDocs = array_merge($twocolsDocs, ['Insurance_Documents','Vehicle_Registration']);
$twocolsDocs = array_merge($twocolsDocs, ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report']);
$twocolsDocs = array_merge($twocolsDocs, $attorneyDocs);
$notOwnedproperty = '';
foreach ($documentuploaded as $data) {
    $missing_months_array = [];
    if (in_array($data['document_type'], $notOwned)) {
        $notOwnedproperty = "Client selected no document available";
    }
    $docData = Helper::getDocumentImage($data['document_type'] ?? '');
    if (empty($docData)) {
        $otype = \App\Models\ClientDocumentUploaded::OTHER_MISC_DOCUMENTS;
        $docData = Helper::getDocumentImage($otype);
        //  print_r($otype);
    }
    $doclasscs = 'not-uploaded';
    if ($data['id'] > 0) {
        $doclasscs = '';
    }
    $displayMainName = false;

    $combinedForm = true;
    $singleDocs = false;
    $cardsArray = \App\Models\ClientDocumentUploaded::getCardTypeArray();
    if (in_array($data['document_type'], $cardsArray)) {
        $combinedForm = false;
        $singleDocs = true;
    }

    if (!isset($data['multiple']) || empty($data['multiple'])) {
        $combinedForm = false;
    }

    $declineText = '';
    $showResubmitDoc = false;
    $docActiveChildClass = "";
    if (!empty($data['id'])) {
        if ($data['document_status'] == 2) {
            $declineText = $data['document_decline_reason'];
        }

        if ($data['document_status'] == 1) {
            $showResubmitDoc = true;
            $docActiveChildClass = '';
        }
    }

    $autoloankeys = array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1));
    $mortloankeys = array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(1));
    $mu = \App\Models\ClientDocumentUploaded::MULTIPLE_DOC_ALLOWED_FOR;
    $mu = array_merge($mu, $attorneyDocs);
    $mu = array_merge($mu, array_keys($clientDocs));
    $mu = array_merge($mu, array_keys($venmoPaypalCash));
    $mu = array_merge($mu, array_keys($brokerageAccount));
    $mu = array_merge($mu, array_keys($unpaid_wages));
    $mu = array_merge($mu, array_keys($retirement_pension));


    $mu = array_merge($mu, $adminDocs);
    if (in_array($data['document_type'], $mu)) {
        $displayMainName = true;

    }
    $clasforli = '';


    array_shift($autoloankeys);
    array_shift($mortloankeys);
    if (in_array($data['document_type'], $autoloankeys) || in_array($data['document_type'], $mortloankeys)) {
        $clasforli = ' p-l-20 p-r-20 ';
    }

    // $autoloankeys


    $notOwnedproperty = '';
    $keyNotOwn = $data['document_type'];


    if ($data['document_type'] == 'Debtor_Pay_Stubs') {
        if (in_array('Debtor_Pay_Stubs', $notOwned)) {
            $notOwnedproperty = Helper::DOCTYPE_NOT_OWN_ATTORNEY[$data['document_type']];
        }
    }
    if ($data['document_type'] == 'Co_Debtor_Pay_Stubs') {
        if (in_array('Co_Debtor_Pay_Stubs', $notOwned)) {
            $notOwnedproperty = Helper::DOCTYPE_NOT_OWN_ATTORNEY[$data['document_type']];
        }
    }
    $indicator = "d-none";
    if (in_array($data['document_type'], $unreadDocuments)) {
        $indicator = "io ". $data['document_type'].json_encode($unreadDocuments);
    }


    if (in_array($data['document_type'], $notOwned)) {
        $notOwnedproperty = "Client selected no document available";
        // $notOwnedproperty = "Client selected no ".$data['document_name'];
    }

    $enableEdit = false;
    if (in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs','Miscellaneous_Documents','Other_Misc_Documents']) || in_array($data['document_type'], array_keys($clientDocs)) || in_array($data['document_type'], array_keys($venmoPaypalCash)) || in_array($data['document_type'], array_keys($brokerageAccount)) || in_array($data['document_type'], array_keys($unpaid_wages)) || in_array($data['document_type'], array_keys($retirement_pension)) || in_array($data['document_type'], $adminDocs) || in_array($data['document_type'], \App\Models\ClientDocumentUploaded::getTaxDocumentById())) {
        $enableEdit = true;
    }

    $isPaystub = 0;
    if (in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
        $isPaystub = 1;
    }
    $valid_document_types = ['bank_statements', 'type_venmo_paypal_cash','type_brokerage_account','other_income','retirement_docs','requested_documents'];
    $bsGreenClass = in_array($data['document_type'], ['bank_statements','type_venmo_paypal_cash','type_brokerage_account','other_income','retirement_docs']) ? 'bank_statements' : '';
    $rdGreenClass = $data['document_type'] == 'requested_documents' ? 'requested_documents' : '';

    $ppath = '';
    if ($data['document_type'] == 'Debtor_Pay_Stubs' && (((Auth::user()->enable_free_payroll_assistant && $User['client_type'] == 1) || $User['client_payroll_assistant'] == 1) || ((Auth::user()->enable_free_payroll_assistant && $User['client_type'] == 3) || $User['client_payroll_assistant'] == 3))) {
        $ppath = route("client_paystub", ['id' => $client_id, 'type' => 'paystub']);
    }

    if ((((Auth::user()->enable_free_payroll_assistant && $User['client_type'] == 2) || $User['client_payroll_assistant'] == 2) || ((Auth::user()->enable_free_payroll_assistant && $User['client_type'] == 3) || $User['client_payroll_assistant'] == 3)) && $data['document_type'] == 'Co_Debtor_Pay_Stubs') {
        $ppath = route("client_paystub_partner", ['id' => $client_id, 'type' => 'paystub']);
    }

    $displayUpload = false;
    if (!in_array($data['document_type'], $autoloankeys) && !in_array($data['document_type'], $mortloankeys) && !in_array($data['document_type'], ['bank_statements','type_venmo_paypal_cash','type_brokerage_account','other_income','retirement_docs']) && $data['document_type'] != 'requested_documents') {
        $displayUpload = true;
    }




    $multiplecount = isset($data['multiple']) && is_array($data['multiple']) ? count($data['multiple']) : 0;

    if (!in_array($data['document_type'], $cardsArray)) {
        $svgname = Helper::validate_key_value('svg', $docData);
        $svgname = empty($svgname) ? 'attorney_docs.svg' : $svgname;
        $svgUrl = asset("assets/img/black_icons/".$svgname);
        $background = 'transparent';
        $color = '#012cae';
        $isStatements = 0;
        $isPaystub = 0;

        if ($data['document_type'] == 'bank_statements') {
            $svgname = 'bank_doc.svg';
            $svgUrl = asset("assets/img/blue_icons/".$svgname);
            $background = '#00b0f0'; //"#27d06 8 78"
            $color = '#000';
        }
        if ($data['document_type'] == 'other_income') {
            $svgname = 'bank_doc.svg';
            $svgUrl = asset("assets/img/blue_icons/".$svgname);
            $background = '#90EE90'; //"#27d06 8 78"
            $color = '#000';
        }
        if ($data['document_type'] == 'retirement_docs') {
            $svgname = 'bank_doc.svg';
            $svgUrl = asset("assets/img/blue_icons/".$svgname);
            $background = '#DECFB7'; //"#27d06 8 78"
            $color = '#000';
        }
        if ($data['document_type'] == 'type_venmo_paypal_cash') {
            $svgname = 'bank_doc.svg';
            $svgUrl = asset("assets/img/white_icons/".$svgname);
            $background = '#012cae'; //"#27d06 8 78"
            $color = '#efefef !important';
        }
        if ($data['document_type'] == 'type_brokerage_account') {
            $svgname = 'bank_doc.svg';
            $svgUrl = asset("assets/img/white_icons/".$svgname);
            $background = '#000'; //"#27d06 8 78"
            $color = '#efefef !important';
        }

        if ($data['document_type'] == 'requested_documents') {
            $svgname = 'requested_doc_white.svg';
            $svgUrl = asset("assets/img/blue_icons/".$svgname);
            $background = '#ff0000db';
            $color = '#fff !important';
        }
        if ($data['document_type'] == 'Unsecured_Debts') {
            $svgname = 'credit_report.svg';
            $svgUrl = asset("assets/img/black_icons/".$svgname);
            $background = '#d3cece';
            $color = '#000';
        }
        if ($data['document_type'] == 'Income_Docs_For_Debtor') {
            $svgname = 'paystub.svg';
            $svgUrl = asset("assets/img/white_icons/".$svgname);
            $background = 'green';
            $color = '#ffffff !important';
        }
        if ($data['document_type'] == 'Debtor_Taxes') {
            $svgname = 'tax_return.svg';
            $svgUrl = asset("assets/img/black_icons/".$svgname);
            $background = '#a8e3f8';
            $color = '#000000';
        }


        if (in_array($data['document_type'], array_keys($venmoPaypalCash)) || in_array($data['document_type'], array_keys($clientDocs))) {
            if (in_array($data['document_type'], array_keys($venmoPaypalCash))) {
                $svgname = 'bank_doc.svg';
                $svgUrl = asset("assets/img/black_icons/".$svgname);
                $isStatements = 1;
            }
            if (in_array($data['document_type'], array_keys($clientDocs))) {
                $svgname = 'bank_doc.svg';
                $svgUrl = asset("assets/img/black_icons/".$svgname);
                $isStatements = 1;
            }

            $datamultiple = Helper::validate_key_value('multiple', $data);
            $dataType = $data['document_type'];

            $bank_statement_month_nos = $bank_statement_months;
            if (isset($bank_account_documents) && !empty($bank_account_documents)) {
                foreach ($bank_account_documents as $docu) {
                    if ($docu['document_name'] === $dataType) {
                        $bank_statement_month_nos = ($docu['bank_account_type'] == 2) ? $attProfitLossMonths : $bank_statement_months;
                        break;
                    }
                }
            }

            $statement_month_array = DateTimeHelper::getBankStatementShortMonthArray($bank_statement_month_nos);
            foreach ($statement_month_array as $month_key => $month_value) {
                $found = false;
                if (!empty($datamultiple)) {
                    foreach ($datamultiple as $object) {
                        if ($object['document_month'] === $month_key) {
                            $found = true;
                            break;
                        }
                    }
                }
                if (!$found) {
                    $missing_months_array[] = $month_key;
                }
            }
            if (!empty($missing_months_array)) {
                echo '<input type="hidden" id="'.$dataType.'_missing_month" value='.json_encode($missing_months_array).'>';
            }
        }

        if (in_array($data['document_type'], array_keys($brokerageAccount))) {
            $svgname = 'bank_doc.svg';
            $svgUrl = asset("assets/img/black_icons/".$svgname);
            $isStatements = 1;
        }

        if (in_array($data['document_type'], $attorneyDocs)) {
            $svgname = 'attorney_docs.svg';
            $svgUrl = asset("assets/img/black_icons/".$svgname);

        }

        if (in_array($data['document_type'], $adminDocs)) {
            $svgname = 'requested_doc.svg';
            $svgUrl = asset("assets/img/black_icons/".$svgname);

        }
        if (in_array($data['document_name'], ["Current Mortgage Statements", "Current Auto Loan Statements"])) {
            $background = '#efefef';
            // $svgUrl = asset("assets/img/black_icons/".$svgname);
        }
        if ($data['document_type'] == 'misc_attorney_docs') {
            $svgname = 'attorney_docs.svg';
            $svgUrl = asset("assets/img/black_icons/".$svgname);
            $background = '#d3cece';
            $color = '#000000';
        }
        $doc_page_open = false;
        if (isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] == $data['document_type'] && !in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
            $doc_page_open = true;
        }


        if (in_array($data['document_type'], $listTaxes)) {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $taxind])
                                <?php $taxind = $taxind + 1;
        } elseif (in_array($data['document_type'], ['W2_Last_Year','W2_Year_Before'])) {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $w2ind])
                                <?php $w2ind = $w2ind + 1;
        } elseif (in_array($data['document_type'], array_keys($clientDocs))) {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $cdocind])
                                <?php $cdocind = $cdocind + 1;
        } elseif (in_array($data['document_type'], array_keys($venmoPaypalCash))) {  ?>
                                @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $venmoPaypalCashindx])
                                <?php $venmoPaypalCashindx = $venmoPaypalCashindx + 1;
        } elseif (in_array($data['document_type'], array_keys($brokerageAccount))) {
            $isStatements = 0;
            ?>
                                @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $brokerageAccountindx])
                                <?php $brokerageAccountindx = $brokerageAccountindx + 1;
        } elseif (in_array($data['document_type'], $autoloankeysWithoutMaster) && trim($data['document_name']) != 'Current Auto Loan Statements') {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $autlindx])
                                <?php $autlindx = $autlindx + 1;
        } elseif (in_array($data['document_type'], $mortloankeysWithoutMaster) && trim($data['document_name']) != 'Current Mortgage Statements') {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $mortindx])
                                <?php $mortindx = $mortindx + 1;
        } elseif (in_array($data['document_type'], ['Vehicle_Registration','Insurance_Documents'])) {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $vehicleIns])
                                <?php $vehicleIns = $vehicleIns + 1;
        } elseif (in_array($data['document_type'], $docsMisc)) {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $miscattdoc])
                                <?php $miscattdoc = $miscattdoc + 1;
        } elseif (in_array($data['document_type'], ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report','Other_Misc_Documents'])) {  ?>
                                    @include("attorney.doc_mgmt.two_colmn_docs",['taxind' => $unsecdebtindx])
                                <?php $unsecdebtindx = $unsecdebtindx + 1;
        } else {
            $doc_page_open = false;
            if (isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] == $data['document_type'] && !in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
                $doc_page_open = true;
            }

            ?>
                                    @include("attorney.doc_mgmt.single_column_docs")
                                <?php }
        } ?>
                                <?php $ind2 = 1;  ?>
                            
                                <?php if (in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs']) || (!in_array($data['document_type'], $twocolsDocs)) && !in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs']) && isset($data['multiple']) && is_array($data['multiple']) && !empty($data['multiple'])) { ?>
                                    <tr class="sub_docs {{(in_array($data['document_type'],['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs']))?"dont_hide":(($doc_page_open && !in_array($data['document_type'],['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs']))?"":"d-none")}} document_select" id="select_{{$data['document_type']}}" data-document-type="{{$data['document_type']}}" data-select-id="{{$data['document_type']}}">
                                        <td colspan="5" class="m-0 p-0 pl-1" id="{{in_array($data['document_type'],['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])?"":"Content_".$data['document_type']}}">
                                            @if($doc_page_open || in_array($data['document_type'],['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs']))
                                                @include("attorney.doc_mgmt.sub_docs")
                                            @endif
                                        </td>
                                    </tr>
                                <?php  }
}  ?>

                                    
                                    <?php if ((!empty($totals) && $totals == 6) && !empty($localForms)) { ?>
                                    @include("attorney.doc_mgmt.local_forms")
                                    <?php } ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<!-- [ Main Content ] start -->

<!-- [ Main Content ] end -->
</div>
<style>
    .main-box-1 h5 span{
        width: 100%;
        display: block;
    }
    .view_client_btn{
        border-radius: 4px;
        background: #00b0f0;
        padding: 10px;
        opacity: 0.9;
        color: #fff;
        font-size: 12px;
        font-weight: 400;
        line-height: 130%;
    }
    .view_client_btn:hover{
        color: #fff;
    }
    .text-custom-added{
        text-decoration: underline;
    }
    .paystub-accept-decline-section .view_client_btn{
        display: none;
    }
    .paystub-accept-decline-section i{
        font-size: 20px !important;
    }
    .select-custom-padding-paystub {
        padding: 1px 6px !important;
        max-width: 180px;
    }
    .employer-date-uploaded-doc{
        padding: 1px 6px !important;
        max-width: 130px;
    }
    .p-point75{
        background: #efefef;
        padding: 10px 10px 10px 10px;
    }
    .text-align-left{
        text-align: left;
    }
    .w-10{
        width: 10%;
    }
    .w-15{
        width: 15%;
    }
    .w-40{
        width: 40%;
    }
    .w-50{
        width: 50%;
    }
    .w-85{
        width: 85%;
    }
    .fs-14px{
        font-size: 14px;
        font-weight: 400;
        font-family: "Titillium Web", sans-serif;
    }
    .border-bottom-light-blue {
        border-bottom: 2px solid #00b0f0 !important;
    }
    .text-bold {
        font-weight: bold;
    }
    .view_client_btn {
        cursor: pointer;
        font-weight: bold;
        border-radius: 4px;
        background: #00b0f0;
        padding: 10px;
        opacity: 0.9;
        color: #fff;
        line-height: 130%;
    }
    .recent-pay-date{
        margin-left: 0.5rem;
    }

    .employer-custom-pay-date{
        float: right;
    }
    .employer-custom-upload-btn{
        margin-left: 0.5rem;
    }
    .pay-date-span{
        text-align: left;
    }

    @media (max-width: 768px) {
        .recent-pay-date{
            margin-left: 0rem;
            display: block;
            margin-top: 0.25rem;
        }
        .employer-custom-upload-btn{
            margin-top: 0.25rem;
            margin-left: 0rem !important;
        }
        .index-span{
            width: 15% !important;
        }
        .pay-date-span{
            text-align: left;
            width: 85% !important;
        }
        /* .paystub-status-span{
            float: right;
        }  */
    }
    @media (max-width: 490px) {       
        .employer-custom-upload-btn{
            display: block !important;
        }
    }
    @media (max-width: 414px) {       
        .index-span{
            width: 20% !important;
        }
        .pay-date-span{
            text-align: left;
            width: 80% !important;
        }
        .employer-upload-btn{
            margin-left: 0rem !important;
        }
        
    }
    @media (max-width: 380px) {
        .employer-upload-btn{
            text-align: center;
        }
        .paystub-status-span{
            /* display: inline-grid !important; */
            /* float: unset; */
            /* padding-left: 1.5rem; */
        }

    }
    .table>:not(caption)>*>*{background-color: inherit !important;}
    .upload-documents-wrapper section .box-size-box {
        padding: 0px 0px;
    }
    .doc_heading_title{font-size:14px;text-decoration: underline;}
    .table td, .table th{border-top:none !important;}

    .doc-request-btn.package-desc{
        padding-top: 26px !important;
    }

    .doc-radio-btn.radio-btn{
        border: 2px solid black !important;
        height: 94px !important;
    }

.p4px{padding:4px !important;}
    .doc-request-btn.package-desc i{
        color: green !important;
        font-size: 16px !important;  
    }
    .highlight_btn_requested.green{
        background-color: green;
    }
    .highlight_btn_requested.red{
        background-color: red !important;
    }
    .highlight_btn_requested{
        color: #fff;
    padding: 2px;
    font-size: 8px;
    border-radius: 2px;
   
    font-weight: bold;
    }
  
    
    .doc-request-btn.package-desc i.text-c-light-blue{
        color: #00b0f0 !important; 
    }
   

</style>

<script>
    var selectedFiles = [];
    function replaceAll(str, term, replacement) {
        return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
    }

    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    function calculateUploadBtnClick (dType, dataFor, employer_id) {
        // let fileInput = $('#' + input_id);
        // $('#'+input_id).click();  // Trigger the hidden file input

        if (!confirm('Are you sure you want to process all payroll documents through Payroll Assistant BKQ AI?')) {
            return;
        }

        $.systemMessage(`BKQ AI is pulling all of the ${dataFor}'s payroll data from the uploaded pay stubs and importing it to Payroll Assistant with AI. Please be patient the magic takes a few minutes.`, 'alert--process toast-bg-purple');
        
        var client_id = '<?php echo @$client_id; ?>';
        var url = '<?php echo route('process_by_graphql');?>';
		laws.ajax(url, { document_type: dType, 
            client_id: client_id,
            employer_id: employer_id 
        }, function (response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
			} else {
				$.systemMessage(res.msg, 'alert--success toast-bg-purple', true);
			}
		});

    }

   

    function setDataType(type){
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
				<img class="w-100" src="" alt="preview">
			</div>
		</div>
	</div>
</div>



<style>
    .local_form_popup{
        width:50px !important;
        min-width:50px !important;
        height:50px !important;
        min-height:50px !important
    }
    .local_form_popup + .close.close--white{
        display: none !important;
    }
    </style>
<script>
    $(document).ready(function(){
        openWindow = function(href) {
            var htmltoload = '<img class="center-loader" style="width:30px;" src="<?php echo url('assets/img/loading.gif'); ?>" alt="loading" /><iframe id="frame" src="'+href+'" width="10" height="10"></iframe>';
            laws.updateFaceboxContent(htmltoload, 'local_form_popup');
            setTimeout(function() {
                $.facebox.close();
            }, 4000);
            return false;
        }
    });
    </script>

<!-- Bootstrap CSS & JS -->

<!-- JavaScript to Dynamically Load PDF -->
<script>
    $(document).on('click', '.openPdf', function() {
        let pdfUrl = this.getAttribute("data-url");
        document.getElementById("pdfViewer").src = pdfUrl;
        $("#pdfModal").modal("show");
    })
</script>
@include('client.uploaddoc_mode', [
    'client_id' => $client_id,
    'route' => route('upload_client_date', ['client_id' => $client_id]),
    "bank_statement_months" => $bank_statement_months,
    'isManual' => false,
    'max_size' => 20000
])
@include('attorney.doc_mgmt.attorney_doc_script')
@endsection
