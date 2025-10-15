@extends("layouts.admin")
@section('content')
<!-- [ Main Content ] start -->
<div class="row">
	<div class="col-md-6 col-xl-3">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h6 class="mb-4"><?php echo $details['client_count'];?></h6>
				<span class="card-icon"><i class="feather icon-bar-chart"></i></span>
				<div class="row">
					<div class="col-12">
						<h4 class="f-w-500 m-b-0">
							Total number of clients </h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h6 class="mb-4"><?php echo $details['attorney_count'];?></h6>
				<span class="card-icon"><i class="feather icon-users"></i></span>
				<div class="row">
					<div class="col-12">
						<h4 class="f-w-500 m-b-0">
							Total number of Attorney </h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h6 class="mb-4"><?php echo $details['signed_documents'];?></h6>
				<span class="card-icon"><i class="feather icon-package"></i></span>
				<div class="row">
					<div class="col-12">
						<h4 class="f-w-500 m-b-0">
							Total Singed document </h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h6 class="mb-4"><?php echo $details['pending_documents'];?></h6>
				<span class="card-icon"><i class="feather icon-package"></i></span>
				<div class="row">
					<div class="col-12">
						<h4 class="f-w-500 m-b-0">
							Total Pending Document </h4>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 col-xl-12">
		<div class="w-auto p-3 card mb-0">
			<div class="row">
				<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 "><div class="pt-2"><h4 class="m-b-0 text-bold text-c-blue">Purchase History</h4></div></div>
				<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-12 ">
					<form action="{{route('admin_dashboard', 2)}}" method="GET">
						<div class="row">
							<?php if (!empty($all_attorney) && count($all_attorney) > 0) { ?>
								<div class="col-xxl-4 col-xl-0 col-lg-7 col-md-5 col-sm-6 px-0"></div>
								<div class="col-xxl-3 col-xl-4 col-lg-5 col-md-7 col-sm-6 ">
									<div class="form-group mb-0">
										<div class=" form-floating ">
											<select class="form-control bg-white w-auto" onchange="this.form.submit()" name="allAttorney">
													<option value="">All</option>
												<?php foreach ($all_attorney as $key => $data) { ?>
													<option value="<?php echo $key; ?>" <?php if (!empty($selectedAttorney) && $selectedAttorney == $key) {
													    echo 'selected';
													}?>><?php echo $data; ?></option>
												<?php  } ?>
											</select>
											<label for="allAttorney">Choose Attorney:</label>
										</div>
									</div>
								</div>
							<?php  } ?>
							
							<div class="col-xxl-0 col-xl-0 col-lg-4 col-md-1 col-sm-2 px-0"></div>
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-4 mt-custom">
								<div class="form-group mb-0">
									<div class=" form-floating ">
										<input type="date" name="fromDate" class="form-control bg-white w-auto"value="<?php echo $fromDate;?>">
										<label for="fromDate">From:</label>
									</div>
								</div>

							</div>
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-4 mt-custom">
								<div class="form-group mb-0">
									<div class=" form-floating ">
										<input type="date" name="toDate" class="form-control bg-white w-auto"value="<?php echo $toDate;?>">
										<label for="toDate">To:</label>
									</div>
								</div>
							</div>
							<div class="col-xxl-1 col-xl-2 col-lg-2 col-md-3 col-sm-2 mt-custom">
								<Button type="submit" class="float-right btn font-weight-bold border-blue f-12 mb-0 mr-0">
									<span class="card-title-text">Search</span>
								</Button>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
		
		<div class="card-block px-0 py-0">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Attorney</th>
								<th>{{ __('Questionnaire type/add-on') }}</th>
								<th class="text-left">Transaction Details</th> 
								<th># Units</th> 
								<th>Payment Details</th> 
								
							</tr>
						</thead>
						<tbody>
							<?php
                            $allpackageNames = \App\Models\AttorneySubscription::allPackageNameWithParamForTransactionArray();
				?>
						<?php if (!empty($listing) && count($listing) > 0) {?>
						<?php foreach ($listing as $val) {?>

							<?php
				    $type = $val->package_id;
						    $thisPrice = \App\Models\AttorneySubscription::allPackagePriceArray($type);
						    $packageString = $allpackageNames[$type] ?? '';
						    ?>
							<tr class="unread"> 
								<td><span><?php echo $all_attorney[$val->attorney_id] ?? ''; ?></span></td>
								<td><span><?php echo $packageString; ?></span></td>
								<td class="text-left">
									<span><a title="Click here to view client details" href="<?php echo route('attorney_form_submission_view', ['id' => $val->client_id]);?>"> {{$val->name}} (Client Id: {{$val->client_id}})</a></span><br>
								<span> Status:</span> <span class="text-c-green">Success</span> <br>
								<span>Transaction Time: <strong><?php echo DateTimeHelper::dbDateToDisplay($val->created_at, true); ?></strong></span>
								</td>
								<td><span>{{$val->quantity}}</span>
								<td>
								<span>{{ __('Total Amount:') }} <span>${{(float)$thisPrice}}*{{(float)$val->quantity}} = ${{(float)$thisPrice*(float)$val->quantity}}</span></span><br>
								<span>Discount: $0.00</span><br>
								<span>Amount Paid: <strong>${{(float)$thisPrice*(float)$val->quantity}}</strong></span><br>
								</td>
								
									
							
							</span></td>
								
							</tr>
						<?php }
						} else {?>
							<tr class="unread">
									<td colspan="4">{{ __('No Record Found.') }}</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
				<?php if (!empty($listing)) {?>
                        {{ $listing->appends(['fromDate' => $fromDate, 'toDate' => $toDate, 'selectedAttorney' => $selectedAttorney])->links() }}
                        <?php }?>
				</div>
			</div>
	</div>
</div>
<!-- [ Main Content ] end -->
@endsection
   

