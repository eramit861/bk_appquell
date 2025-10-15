@extends("layouts.attorney")
@section('content')
@include("layouts.flash")
@php
$val = $User;
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
$currentMonthKey = $submonth = date("n-Y", strtotime('-1 month')) ;
$currentMonthName = date("F Y", strtotime('-1 month'));
$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = explode('?', $requestUri);
$requestUri = $requestUri[0];
$parts = explode("/", $requestUri);
$bankUrl = "/attorney/client/bankstatement/".$val['client_type']."/".$User['id']."/1/".$currentMonthKey;
$activeClass = ($requestUri == $bankUrl) ? 'active' : '';
$borderColor = ($activeClass == 'active') ? '#012CAE' : '#000000';
@endphp

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
							<!--[ Recent Users ] start-->
							<div class="col-xl-12 col-md-12">
								<div class="card listing-card">
									@include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $User, 'type' => $type])
								</div>

								<div class="card-block px-0 py-0 paystb">
									<div class="table-responsive px-2 mt-2">
										<div class="d-flex justify-content-start align-items-center">
											<a href="{{route('bank_statement_index',['debtor',$User['id'],$monthNo??'1',$currentMonthKey??'',$User['client_subscription']])}}" class="{{ (strtolower($client_type) == 'self' || strtolower($client_type) == 'debtor') ? 'is_active ' : '' }}btn btn-new-ui-default mb-0">Debtor Bank Statements</a>
											@if ($User['client_type'] == Helper::CLIENT_TYPE_JOINT_MARRIED)
												<a href="{{route('bank_statement_index',['codebtor',$User['id'],$monthNo??'1',$currentMonthKey??'',$User['client_subscription']])}}" class="{{ (strtolower($client_type) == 'spouse' || strtolower($client_type) == 'codebtor') ? 'is_active ' : '' }}btn btn-new-ui-default mb-0">Co-debtor Bank Statements</a>
											@endif
										</div>

										<div class="d-flex justify-content-start align-items-center mt-3">
											<a
												class=" btn btn-new-ui-default mb-0 download_zip"
												href="{{ route('download_pdf_all_new', $User['id']) }}">
												<span class="">Download Statements</span>
												<i class="bi bi-file-earmark-zip"></i>
											</a>
											@php $currentMonthKey = $submonth = date('n-Y', strtotime('-1 month')); @endphp
											<a class="btn btn-new-ui-default mb-0" href="{{route('bank_statement',[$client_type,$User['id'],'1',$currentMonthKey??''])}}">
												<span class=""> Profit/Loss Data </span>
											</a>
										</div>

										<h4 class="card-title"></h4>

										<table class="table">
											<tbody>
												<tr>
													<th>Download PDF</th>
													<th>Bank Name</th>
													<th>Account No</th>
													<th>Statement Month</th>
													<th>Transaction Details</th>
												</tr>
												@if (empty($downloadedStatements[0]))
													<tr class="unread text-center">
														<td colspan="5">{{ __('No Record Found.') }}</td>
													</tr>
												@endif

											@foreach ($orderedStatementList as $key => $subList)
													<tr>
													<th colspan="5">{{ $key }}</th>
													</tr>
												@foreach ($subList as $key => $data)
													@php
												    $is_success = Helper::validate_key_value('is_success', $data);
												    $month_year = Helper::validate_key_value('month_year', $data);
												    $client_subscription = Helper::validate_key_value('client_subscription', $data);
												    @endphp
													<tr>
														<td class="blue-color">
															<a class="d-flex ml-3"
															@if ($is_success)
																href="{{route('download_pdf_new',['statement_id'=>$data['id'],'client_id'=>$data['client_id']])}}"
															@endif
															>
																<i style="font-size:28px;" class="fa fa-file-pdf" aria-hidden="true"></i>
															@if ($is_success)
																<span class="ml-2 pt-1">Download Statement</span>
															@else
																<span class="ml-2 pt-1 text-danger">Statement Not Available</span>
															@endif
															</a>
														</td>
													<td>{{ Helper::validate_key_value('institute_name', $data) }}</td>
													<td>********{{ Helper::validate_key_value('bank_last_digit', $data) }}</td>
														<td>
														@if ($month_year)
															@php
															    $date = implode('-', array_reverse(explode('-', $month_year)));
															    $formattedMonth = date('F Y', strtotime($date));
															@endphp
															{{ $formattedMonth }}
														@else
															N/A
														@endif
														</td>
														<td>
														@if ($client_subscription == 121)
															<a href="{{route('bank_statement',[$client_type,$User['id'],'1',date('n-Y',strtotime($date))??''])}}?institute_id={{ $data['institute_id'] }}&account_no={{ explode('*',$data['bank_last_digit'])[0] }}">
																<i class="fa fa-arrow-right" aria-hidden="true"></i>
															</a>
														@endif
														</td>
													</tr>
													<!-- date('F j, Y', strtotime($data['transaction_date'])) $data['month_year'] -->
												@endforeach
											@endforeach
											</tbody>
										</table>
									</div>
									<div class="pagination px-2">
										@if (!empty($downloadedStatements) && count($downloadedStatements) > 0)
										{{ $downloadedStatements->links() }}
										@endif
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
<style>
	.blue-color{color:#012CAE;}
	.table-responsive {	overflow-x: unset; }
	.card{margin-bottom: 0px;}
	.negative-record{background-color: rgb(241, 224, 224) !important;}
	.mid-width{width:70% !important;}
	.start{ border-left: 2px solid #000 !important; }
	.end{ border-left: 2px solid #000 !important; }
	.tab-custom a.active{
    background: #012CAE !important;
	border: 2px solid #012CAE !important;
    color: white !important;
    font-weight: bold;
	}
	.tab-custom a:hover{
		box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
	}
	.paystb .table-responsive tbody tr td{
		padding:0.75rem !important;
	}
	.tab-custom a{
		border-top: 2px solid #000000 !important;
		border-left: 1px solid #000000 !important;
		border-right: 1px solid #000000 !important;
		border-bottom: none !important;
	}
	.tab-custom.nav-tabs .nav-link{
		color:#012CAE;
		font-weight: bold;
	}
	.download-button{
		background: #012CAE !important;
		border: 2px solid #012CAE !important;
		color: white !important;
		font-weight: bold;
		border-radius: 5px;
	}
</style>
@endsection
