@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header">
				<h4>Payment Settings</h4>
			</div>
			<div class="card-block">				
				<form id="edit_payment" action="{{route('admin_payment_settings')}}" method="post" novalidate>
				@csrf	
				<div class="container ">
					<div class="form-group">
						<label>Payment Charge</label>
						<input required type="number" 
								class="price-field form-control {{ $errors->has('payment_charge') ? 'btn-outline-danger' : '' }}" 
								placeholder="Payment Charge" 
								name="payment_charge" 
								value="<?php echo (!empty($payment_settings->payment_charge)) ? $payment_settings->payment_charge : "40";?>"
								>
						@if ($errors->has('payment_charge'))
							<p class="help-block text-danger">{{ $errors->first('payment_charge') }}</p>
						@endif
					</div>
					<div class="form-group">
						<label>Discount Percentage</label>
						<input required type="number" 
								class="form-control price-field {{ $errors->has('discount_percentage') ? 'btn-outline-danger' : '' }}" 
								placeholder="Discount Percentage" 
								name="discount_percentage" max="100"
								value="<?php echo (!empty($payment_settings->discount_percentage)) ? $payment_settings->discount_percentage : "";?>" 
								>
						@if ($errors->has('discount_percentage'))
						<p class="help-block text-danger">{{ $errors->first('discount_percentage') }}</p>
						@endif
					</div>	
					<input type="hidden" name="setting_id" value="<?php echo (!empty($payment_settings->id)) ? $payment_settings->id : "";?>">					
					<!-- <a href="{{route('admin_attorney_list')}}" class="btn btn-theme-black">Back</a> -->
					<br>
					<button type="submit" class="btn btn-theme-black">Submit</button>
				</div>			
				</form>							
			</div>
			<style>
				label.error {
					color: red;
					font-style: italic;
				}
			</style>
			<script>
				$(document).ready(function(){
					
					$("#edit_payment").validate({
						
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
			</script>
		</div>
	</div>
	<!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection