@extends("layouts.attorney")
@section('content')
@include("layouts.flash")


<?php
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
$unreadcount = \App\Models\SignedDocuments::where(['attorney_id' => Auth::user()->id, 'client_id' => $val['id'],'read_by_attorney' => 0])->whereNotNull('sign_document')->count();
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
$requestParam = '';
if (count($requestUri) > 1) {
    $requestParam = $requestUri[1];
}
$requestUri = $requestUri[0];
$parts = explode("/", $requestUri);
$bankUrl = "/attorney/client/bankstatement/".$client_type."/".$User['id']."/1/".$currentMonthKey;
$activeClass = ($requestUri == $bankUrl) ? 'active' : '';
$borderColor = ($activeClass == 'active') ? '#012CAE' : '#000000';
?>

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

								<div class="card-block px-0 py-0  mcard-body">
									<div class="table-responsive px-2 mt-2">
										<div class="d-flex justify-content-start align-items-cente">
											<a href="{{route('bank_statement',['debtor',$User['id'],$monthNo??'1',$currentMonthKey??''])}}" class="<?php if (strtolower($client_type) == 'debtor' || strtolower($client_type) == 'self') {
											    echo 'is_active';
											} ?> btn btn-new-ui-default mb-0" href="">Debtor Bank Statements</a>
											<?php if ($User['client_type'] == Helper::CLIENT_TYPE_JOINT_MARRIED) { ?>
												<a href="{{route('bank_statement',['codebtor',$User['id'],$monthNo??'1',$currentMonthKey??''])}}" class="<?php if (strtolower($client_type) == 'codebtor' || strtolower($client_type) == 'spouse') {
												    echo 'is_active';
												} ?> btn btn-new-ui-default mb-0"  href="">Co-debtor Bank Statements</a>
											<?php } ?>
											<?php if ($isImported == 1) { ?>
												<a href="javascript:void(0)" onclick="bankStatementImport('<?php echo $isImported; ?>', '<?php echo $User['id']; ?>', '<?php echo $client_type; ?>')" class="btn btn-new-ui-default mb-0 float_right">Import to Client Questionnaire </a>
											<?php } ?>
										</div>

										<div class="mt-3">
											<form id="bankTabForm" action="" method="Get">
												<div class="row w-100">
													<div class="col-md-8">
														<?php if (count($banks) > 0) { ?>
															<input type="hidden" name="institute_id" value="{{ $institute_id }}"/>
															<input type="hidden" name="account_no" value="{{ $account_no }}"/>
															<ul class="nav nav-tabs tab-custom">
																<?php
												                    foreach ($banks as $key => $bank) {
												                        $instituteId = Helper::validate_key_value('institute_id', $bank);
												                        $instituteName = Helper::validate_key_value('institute_name', $bank);
												                        $accNo = Helper::validate_key_value('account_no', $bank);
												                        $accNoLast4 = substr($accNo, -4);
												                        $tabName = $instituteName. ' Acct #'.$accNoLast4;
												                        $currentActive = '';
												                        $style = '';
												                        $borderColor = ($currentActive == 'active') ? '#012CAE' : '#000000';
												                        if ($institute_id == $instituteId && $account_no == $accNo) {
												                            $currentActive = 'active';
												                        }
												                        if ($key == array_key_last($banks)) {
												                            $style = "border-right: 2px solid ".$borderColor." !important";
												                        }
												                        if ($key == array_key_first($banks)) {
												                            $style = "border-left: 2px solid ".$borderColor." !important";
												                        }

												                        ?>
																<li class="nav-item bankTab" data-institute_id="{{$instituteId}}" data-account_no="{{$accNo}}">
																	<label for="id_{{$instituteId}}">
																		<a href="javascript:void(0);" class="nav-link {{ $currentActive }}" style="{{$style??''}}" aria-current="page" >
																			<span><?php echo $tabName; ?></span>
																		</a>
																	</label>
																</li>
																<?php } ?>
															</ul>
														<?php } ?>
													</div>
													<div class="col-md-2">
														<?php if (count($banks) > 0) { ?>
															<select class="form-control w-auto" name="monthYear" onchange="$('#bankTabForm').submit();" id="monthYearSelect">
																<?php
												                            $months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);
														    $i = 1;
														    foreach ($months as $key => $month) {
														        ?>
															<option  value="{{ $key }}" <?php echo ($monthYear == $key) ? 'selected' : '';?>>{{$month}}</option>
														<?php $i++;
														    } ?>
														</select>
														<?php } ?>
													</div>
													<div class="col-md-2 pt-1 pl-0 pr-0">
														<a class="btn btn-new-ui-default mb-0 nav_back_btn float_right w-auto mr-2"
															href="{{route('bank_statement_index',[$client_type,$User['id'],'last-2',$User['client_subscription']])}}">
															<span class="back_img"><i class="bi bi-arrow-left"></i></span>
															&nbsp;Back to Bank Statements
														</a>
													</div>
													<style>
														.bank-dropdown {
															width: 200px;
															border-radius: 6px;
															outline: none;
															height: 30px;
															background: white !important;
															margin-bottom: -4px;
															margin-left:40px;
														}
													</style>
												</div>
											</form>
										</div>

										<h4 class="card-title"></h4>

										<table class="table">
											<tbody>
												<tr>
													<th>Select Below To Change Income/Expenses</th>
													<th>Account #</th>
													<th>Transaction Date</th>
													<th>Transaction Amount</th>
													<th>Status</th>
													<th>Description</th>
													<th>Json&nbsp;response</th>
												</tr>
												@if (empty($statements[0]))
													<tr class="unread text-center">
														<td colspan="13">{{ __('No Record Found.') }}</td>
													</tr>
												@endif
												<?php foreach ($statements as $key => $data) {
												    $borderClass = "";
												    if ($data['is_imported'] == 0) {
												        $borderClass = "border-red";
												    } elseif ($data['is_imported'] == 1) {
												        $borderClass = "border-green";
												    }
												    $categorization = json_decode($data['categorization'], 1);
												    ?>
												<tr>
													<td>
														<?php $expenseType = ArrayHelper::getExpenseTypeArray(); ?>
														<select name="spouse_suffix" class="form-controls w-auto {{$borderClass}} select_{{$data['id']}}" onchange="chooseExpenseType({{$data['id']}})">
															<option value="none" data-id="<?php echo $data['id'];?>">None</option>
															<?php foreach ($expenseType as $key => $val) {?>
																<option
																value="<?php echo $key;?>" data-id="<?php echo $data['id'];?>"
																<?php echo ($data['is_imported_for'] == $key) ? 'selected' : '' ;?>
																><?php echo $val;?></option>
															<?php }?>
														</select>
													</td>
													<td>
														<?php echo $data['account_no'];?>
													</td>
													<td><?php echo date('F j, Y', strtotime($data['transaction_date']));?></td>
													<td><span style="color:<?php echo $data['amount'] < 0 ? 'red' : 'green'; ?>;">$<?php echo Helper::priceFormtWithComma(abs($data['amount']));?></span></td>
													<td><?php echo $data['status'];?></td>
													<td><?php echo $data['description'];?></td>


													<td><span><a href="javascript:void(0)" onclick="showresponse('<?php echo base64_encode($data->transaction_json); ?>')">See response</a></span></td>

												</tr>
												<?php } ?>
											</tbody>
										</table>
										<div class="d-flex justify-content-between align-items-center px-2 paginationb" id="the_table">
											@if ($statements->count())
												<div class="shoing">
													@if ($statements->count())
														Showing {{ $statements->firstItem() }} to {{ $statements->lastItem() }} of {{ $statements->total() }} entries
													@endif
												</div>
												<div>
													{{ $statements->links() }}
												</div>
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
</div>

<style>
	.float-end{float: right;}
	.table-responsive {	overflow-x: unset; }
	.border-red{ border: 2px solid #dc0000 !important; }
	.border-green{ border: 2px solid #56db34 !important; }
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
<script>
	showresponse = function(json_response) {
		laws.updateFaceboxContent(atob(json_response),'mid-width');
	}
	chooseExpenseType = function(id) {
		var id = $(".select_"+id).find(":selected").attr("data-id");
		var monthYear = $("#monthYearSelect").val();
		var value = $(".select_"+id).find(":selected").attr("value")??'';
		if(value == "" && id == "none"){
			var value = "none";
		}
		ajaxurl = "<?php echo route('updateExpenseType'); ?>";
		laws.ajax(ajaxurl,{ id: id, value: value, monthYear: monthYear}, function (response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger');
			}else if(res.status == 1){
				$(".select_"+id).addClass("border-green");
				$.systemMessage(res.msg, 'alert--success');
			}
		});
	}
	$(document).ready(function() {
		$('.bankTab').click(function() {
			var instituteId = $(this).data('institute_id');
			var accountNo = $(this).data('account_no');
			$('input[name="institute_id"]').val(instituteId);
			$('input[name="account_no"]').val(accountNo);
			$('#bankTabForm').submit();
		});
		
	});	

	bankStatementImport = function (isimported, client_id, clientType, selectedMonth="") {
		if(parseInt(isimported) == 1){
			ajaxurl = "<?php echo route('import_client_bank_statement_popup'); ?>";
			laws.ajax(ajaxurl, {client_id:client_id, user_type:clientType, selectedMonth:selectedMonth}, function (response) {
				if(isJson(response)){
					var res = JSON.parse(response);
					if (res.status == 0) {
						$.systemMessage(res.msg, 'alert--danger', true);
					}else if(res.status == 1){
						$.systemMessage(res.msg, 'alert--success', true);
						$.facebox.close();
					}
				} else {
					laws.updateFaceboxContent(response,'large-fb-width');
				}
			});
		}
	}

</script>
@endsection
