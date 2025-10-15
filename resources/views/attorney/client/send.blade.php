@extends("layouts.attorney")
@section('content')
@include("layouts.flash")
<div class="row">
	<?php
    $val = $User;
	?>
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
		@include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type])
			</div>
			<div class="card-block px-0 py-0">
				<div class="container ">
                <form action="{{route('attorney_client_application_payment')}}" method="post" novalidate>
			@csrf
				<div class="row ">
					<div class="col-md-7">
						<div class="stripe-crad px-2 pb-3">
							<div class="row g-0">
								<div class="col-md-12">
									<label>{{ __('Card Number') }}</label>
									<?php
	                                if (!empty($attorneycards->last4)) {
	                                    $attorneycards->last4 = 'xxxxxxxxxxxx'.$attorneycards->last4;
	                                }
	?>
									<div class="input-field">
										<input type="text" class="form-control mb-2" value="{{old('card_name',(!empty($attorneycards->last4))?$attorneycards->last4:'')}}"  placeholder="4242 4242 4242">
									</div>
								</div>
								<div class="col-md-12">
									<label>{{ __('Month/Year') }}</label>
									<div class="input-field">
										<input type="text" class="form-control mb-2 " placeholder="{{ __('MM/DD') }} " value="<?php echo @$attorneycards->exp_month." / ".@$attorneycards->exp_year?>">
									</div>
								</div>
								<div class="col-md-12">
									<label>CVC</label>
									<div class="input-field">
										<input type="number" class="form-control" placeholder="CVC">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						<?php
	                        if (!empty(Auth::user()->flat_fee)) {
	                            $payment_settings->payment_charge = Auth::user()->flat_fee;
	                        }
	?>
						<h4 class="">{{ __('Price Details') }}</h4>
						<div class="row pb-3">
							<div class="col-md-6 col-6">
								<span class="text-secondary">{{ __('Total MRP') }}</span>
							</div>
							<div class="col-md-6 col-6">
								<span class="text-right d-block"><?php echo (!empty($payment_settings->payment_charge)) ? "$".$payment_settings->payment_charge : "$45";?></span>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col-md-6 col-6">
								<span class="text-secondary">{{ __('Discount On MRP') }}</span>
							</div>
							<div class="col-md-6 col-6">
								<span class="text-right d-block"><?php echo  (!empty($payment_settings->payment_charge)) ? "$".$payment_settings->payment_charge : "$45";?></span>
							</div>
						</div>
						<!--div class="row pb-3">
							<div class="col-md-12">
								<div class="promo ">
									<div id="promo_code">
										<div class="shadow-none">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="{{ __('Enter a promo code') }}">
												<div class="input-group-append">
													<span class="btn font-weight-bold border-blue-big" id="basic-addon2">{{ __('Apply') }}</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div-->
						<div class="total-amount border-1 border-top pt-2">
							<div class="row">
								<div class="col-md-6 col-6">
									<h4>{{ __('Total Amount') }}</h4>
								</div>
								<div class="col-md-6 col-6">
									<h4 class="text-right d-block"><?php echo (!empty($payment_settings->payment_charge)) ? "$".$payment_settings->payment_charge : "$45";?></h4>
								</div>
							</div>
						</div>
						<input type="hidden" name="amount" value="<?php echo (!empty($payment_settings->payment_charge)) ? $payment_settings->payment_charge : "45";?>">
						<input type="hidden" name="client_id" id="payment_client_id" value="">
						<div class="pay pt-3">
							<button type="submit" class="btn font-weight-bold border-blue-big w-100 font-lg-18">Pay <?php echo (!empty($payment_settings->payment_charge)) ? "$".$payment_settings->payment_charge : "$45";?> </button>
						</div>
					</div>

				</div>
                        </form>
				</div>					
			</div>
		</div>
	</div>
	<!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection