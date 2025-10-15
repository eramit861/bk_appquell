@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header d-flex">
			<span><h4>Attorney Details</h4></span>
			
			</div>
			<div class="card-block">
				<div class="row">
				<div class="col-xl-4 col-md-6">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control {{ $errors->has('name') ? 'btn-outline-danger' : '' }}" placeholder="Name " name="name" value="<?php echo (!empty($User['name'])) ? $User['name'] : "";?>" readonly>					
					</div>
					</div>
					<div class="col-xl-4 col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email " name="email" value="<?php echo (!empty($User['email'])) ? $User['email'] : "";?>" readonly>					
					</div>
					</div>
					<div class="col-xl-4 col-md-6">
					<div class="form-group">
						<label>Company Name</label>
						<input type="text" class="form-control {{ $errors->has('company') ? 'btn-outline-danger' : '' }}" placeholder="Company Name " name="company" value="<?php echo (!empty($User['company'])) ? $User['company'] : "";?>" readonly>					
					</div>	
					</div>
					
					
				</div>					
			</div>

			<div class="card-header row">
				<div class="col-md-6">
					<span><h4>Attorney Subscriptions</h4></span>
				</div>
				<div class="col-md-6">
					<div class="float-right ">
						<a href="#" style=""class=" mr-3  btn font-weight-bold border-blue f-12" data-bs-toggle="modal"
							data-bs-target="#add_subscription"><i class="feather icon-plus"></i> <span
							class="card-title-text">Add Subscription</span></a>
						<a href="#" style=""class="  mr-3 btn font-weight-bold border-blue f-12" data-bs-toggle="modal"
							data-bs-target="#add_payroll"><i class="feather icon-plus"></i> <span
							class="card-title-text">Add Payroll Assistant</span></a>
					</div>
				</div>   
			</div>

			<div class="card-block px-0 py-0">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>{{ __('Questionnaire type/add-on') }}</th>
								<th>{{ __('Transaction Details') }}</th> 
								<th>{{ __('# Units') }}</th> 
								<th>{{ __('Payment Details') }}</th> 
							
							</tr>
						</thead>
						<tbody>
						
						<?php if (!empty($attorney_transactions) && count($attorney_transactions) > 0) {?>
						<?php foreach ($attorney_transactions as $val) {?>

							<?php


                                $amountPaid = '0.00';
						    $val->no_of_questionnaire = $val->no_of_questionnaire;
						    if ($val->payment_status == 1) {
						        $amountPaid = $val->no_of_questionnaire > 0 ? ($val->no_of_questionnaire * $val->amount) : $val->amount;
						    }
						    $trnsId = $val->stripe_subscription_id;
						    ?>
							<tr class="unread">
								<td><span><?php echo $val->package_name; ?></span></td>
								<td>
									<?php if ($val->credit_by_admin == 1) {?> <strong>{{ __('Credited By Admin') }}</strong> <?php } ?><br>
									<span>Id: {{$trnsId}}</span><br>Status: <span class="text_<?php echo $val->payment_status == 1 ? 'success' : 'failed'; ?>">{{ArrayHelper::getPaymentStatusArray($val->payment_status)}}</span>
								
								<?php
						        $formated_DATETIME = DateTimeHelper::dbDateToDisplay($val->created_on, true);

						    ?>
									<br><span>Transaction Time: {{$formated_DATETIME}}</span>
							</td>
						
								<td><span>{{$val->no_of_questionnaire}}</span></td>
								<td><span>{{ __('Total Amount:') }} <span>${{$val->amount}}*{{$val->no_of_questionnaire}} = ${{$val->no_of_questionnaire>0 ? ($val->no_of_questionnaire*$val->amount) : $val->amount}}</span></span><br>
								<span>Discount: <span style="visibility:hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${{$val->amount}}*{{$val->no_of_questionnaire}} </span><span>- <?php echo $val->discount_amount > 0 ? '$'.$val->discount_amount.'('.$val->discount_percentage.'%)' : '$0.00'; ?></span></span><br>
								<span>Amount Paid: <strong style="visibility:hidden;">&nbsp;${{$val->amount}}*{{$val->no_of_questionnaire}} </strong> = <strong>${{$val->total_paid}}</strong></span><br>
							
							</td>
								
								
								
							</tr>
						<?php }
						} else {?>
							<tr class="unread">
								<td colspan="6">{{ __('No Record Found.') }}</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
					<?php if (!empty($attorney_transactions) && count($attorney_transactions) > 0) {?>
					{{ $attorney_transactions->links() }}
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<!--[ Recent Users ] end-->
</div>


<!-- Modal -->
<div id="add_subscription" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Subscription</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<form id="add_subscription_form" name="add_subscription_form" action="{{route('add_subscription_to_attorney')}}" method="post" novalidate>
			@csrf			
			<div class="modal-body">
				<div class="row ">
				<div class="col-sm-12">
					<div class="form-group">
					<label> Choose a Questionnaire:</label>
                    <select required class="form-control required mb-4" name="package_id" id="package_id">
                        <option value="">Choose a Questionnaire</option>
                        <?php echo AddressHelper::getSubscriptionSelection(old('package_id')); ?>
                    </select>
				    </div>
					@if ($errors->has('package_id'))
                        <p class="help-block text-danger">{{ $errors->first('package_id') }}</p>
                    @endif
                </div>
					<div class="col-sm-12">
					<div class="form-group">
						<input required type="number" class="form-control mb-4 {{ $errors->has('no_of_questionnaire') ? 'btn-outline-danger' : '' }}" placeholder="No Of Questionnaire " name="no_of_questionnaire" value="{{ old('no_of_questionnaire') }}">
</div>
						@if ($errors->has('no_of_questionnaire'))
						<p class="help-block text-danger">{{ $errors->first('no_of_questionnaire') }}</p>
					@endif
					</div>
					<div class="col-sm-12">
					<div class="form-group">
						<input required type="text" class="form-control mb-4 {{ $errors->has('payment_remark') ? 'btn-outline-danger' : '' }}" placeholder="Payment Remark " name="payment_remark" value="{{ old('payment_remark') }}">
					</div>
						@if ($errors->has('payment_remark'))
						<p class="help-block text-danger">{{ $errors->first('payment_remark') }}</p>
					@endif
					</div>

					<input type="hidden" value="{{$User['id']}}" name="attorney_id">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-theme-black">Submit</button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
			</div>
			</form>
		</div>

	</div>
</div>

<!-- Modal -->
<div id="add_payroll" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Payroll Assistant</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<form id="add_payroll_form" name="add_payroll_form" action="{{route('add_payroll_to_attorney')}}" method="post" novalidate>
			@csrf			
			<div class="modal-body">
				<div class="row ">
					
					<div class="col-sm-12">
						<div class="form-group">
							<label> Choose Payroll Assistant for</label>
							<select required class="form-control required mb-4" name="payroll_type" id="payroll_type">
								<option value="">None</option>
								<?php
						            $payrolls = \App\Models\AttorneySubscription::payrollNameArray();
						foreach ($payrolls as $key => $value) { ?>
									<option value="{{$key}}">{{$value}} ( ${{\App\Models\AttorneySubscription::payrollPriceArray($key)}} )</option>
								<?php } ?>
							</select>
						</div>
						@if ($errors->has('payroll_type'))
							<p class="help-block text-danger">{{ $errors->first('payroll_type') }}</p>
						@endif
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<input required type="number" class="form-control mb-4 {{ $errors->has('no_of_payroll_assistant') ? 'btn-outline-danger' : '' }}" placeholder="No Of Payroll Assistant " name="no_of_payroll_assistant" value="{{ old('no_of_payroll_assistant') }}">
						</div>
						@if ($errors->has('no_of_payroll_assistant'))
							<p class="help-block text-danger">{{ $errors->first('no_of_payroll_assistant') }}</p>
						@endif						
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<input required type="text" class="form-control mb-4 {{ $errors->has('payment_remark') ? 'btn-outline-danger' : '' }}" placeholder="Payment Remark " name="payment_remark" value="{{ old('payment_remark') }}">
						</div>
						@if ($errors->has('payment_remark'))
							<p class="help-block text-danger">{{ $errors->first('payment_remark') }}</p>
						@endif
					</div>
					<input type="hidden" value="{{$User['id']}}" name="attorney_id">					
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-theme-black">Submit</button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
			</div>
			</form>
		</div>

	</div>
</div>

<style>
label.error {
    color: red;
    font-style: italic;
}
</style>
<script>
	$(document).ready(function(){

		var arrayIDs = ["#add_payroll_form", "#add_subscription_form"];

		arrayIDs.forEach(IDs => {
			$(IDs).validate({
			
			errorPlacement: function (error, element) {
				if($(element).parents(".form-group").next('label').hasClass('error')){
					
					$(element).parents(".form-group").next('label').remove();
					$(element).parents(".form-group").after($(error)[0].outerHTML);
				}else{
					
					$(element).parents(".form-group").after($(error)[0].outerHTML);
				}
			},
			success: function(label,element) {
				label.parent().removeClass('error');
				
				$(element).parents(".form-group").next('label').remove();
			},
		});
		});

		});

		</script>

<!-- [ Main Content ] end -->
@endsection