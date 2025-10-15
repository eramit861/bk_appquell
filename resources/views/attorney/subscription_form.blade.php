<form id="sub_form" name="sub_form"  action="{{route('create_payment')}}"  method="post" novalidate class="subscription-form @if (!$errors->any())  @endif">   
@csrf
				<div class="row ">
					<div class="col-md-2"></div>	
                    <div class="col-md-8">
						<div class="stripe-crad px-2 pb-3">
							<div class="row g-0">
                            <div class="col-md-12 d-inline-block pay-header">
									<label class="float-left"><h3 class="font-weight-bold p-10">{{ __('Selected Membership') }}  &nbsp;&nbsp;</h3></label>
									<div class="input-field float-right">
										<h3 class="selected-price"><span id="pname">{{ __('Basic') }}</span> | $<span id="pprice">39.99</span> {{ __('per questionnaire') }}</h3>
									</div>
								</div>
                                
								<div class="col-md-6 mt-4">
									<label>{{ __('Card Holder Name') }}</label>
									<div class="input-field">
										<div class="form-group">
											<input type="text" required class="form-control required mb-2" value="{{ old('card_holder_name') }}" name="card_holder_name" placeholder="{{ __('Card Holder Name') }}">
										</div>    
										@if ($errors->has('card_holder_name'))
						                    <p class="help-block text-danger">{{ $errors->first('card_holder_name') }}</p>
					                    @endif
									</div>
								</div>
                                
                                <div class="col-md-6 mt-4">
									<label>{{ __('Card Number') }}</label>
									<div class="input-field">
										<div class="form-group">
											<input type="text" required class="form-control required mb-2" value="{{ old('card_number') }}" name="card_number" placeholder="{{ __('4242 4242 4242 4242') }}">
										</div>    
											@if ($errors->has('card_number'))
												<p class="help-block text-danger">{{ $errors->first('card_number') }}</p>
											@endif
									</div>
								</div>
								<div class="col-md-4">
									<label>{{ __('Month') }}</label>
									<div class="input-field">
										<div class="form-group">
											<input type="text" required class="form-control required mb-2 " placeholder="MM" name="exp_month" value="{{ old('exp_month') }}">
										</div>
										@if ($errors->has('exp_month'))
						                    <p class="help-block text-danger">{{ $errors->first('exp_month') }}</p>
					                    @endif
									</div>
								</div>
                                <div class="col-md-4">
									<label>{{ __('Year') }}</label>
									<div class="input-field">
										<div class="form-group">
											<input type="text" required class="form-control required mb-2 " placeholder="{{ __('YYYY') }}" name="exp_year" value="{{ old('exp_year') }}">
										</div>
										@if ($errors->has('exp_year'))
						                    <p class="help-block text-danger">{{ $errors->first('exp_year') }}</p>
					                    @endif
									</div>
								</div>
								<div class="col-md-4">
									<label>CVC</label>
									<div class="input-field">
										<div class="form-group">
											<input type="number" required name="cvc" class="required form-control" placeholder="CVC">
										</div>
										@if ($errors->has('cvc'))
						                    <p class="help-block text-danger">{{ $errors->first('cvc') }}</p>
					                    @endif
									</div>
								</div>

                                
                                <!-- <div class="col-md-12 mt-3 align-right" style="border-top:1px solid #aaa;">
									<div class="input-field mt-2">
										<label class="font-weight-bold">Total: <span class="total-price font-weight-normal"></span></label>
									</div>
								</div>
                                <div class="col-md-12 align-right" style="border-top:1px solid #aaa;">
									<div class="input-field mt-2">
										<label class="font-weight-bold">Discount: <span class="discount-price font-weight-normal"></span></label>
                                    </div>
								</div> -->
                                <div class="col-md-12 align-right p-10" style="border-top:1px solid #000;border-bottom:1px solid #000;">
									<div class="input-field mt-2">
                                    	<label class="font-weight-bold">Amount To Pay: <span class="pay-price font-weight-normal"></span></label>
									</div>
								</div>
								
								<div class="col-md-12 " style="border-top:1px solid #aaa;">
									<div class="term_c mt-4">
										<div class="form-group d-inline-block">
										<input required class="required" id="agreement" type="checkbox" name="agreed" value="1"  />
										&nbsp;
										<!-- <div id="demo" style="font-weight:700;color:red"></div> -->
										<label for="agreement">By checking the box, you confirm that you've read and accepted our <a style="text-decoration:underline;" target="_blank" href="<?php echo route('terms_of_services'); ?>">{{ __('Terms of Service') }}</a></label>
										
										@if ($errors->has('agreed'))
						                    <p class="help-block text-danger">{{ $errors->first('agreed') }}</p>
					                    @endif
										<!-- <p class="help-block text-danger" id="demo"></p> -->
										<input type="hidden" name="package_id" id="package_id" value="">
										</div>										
                               			 <div class="form_btn float-right">
							            <button type="submit" class="btn font-weight-bold border-blue-bigfont-lg-18 blue_border sub_form_btn payNowValidtion-js" >{{ __('Pay Now') }} </button>
						            </div>
									</div>
									</div>
								</div>

                                <div class="col-md-12">
        
                                </div>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>	
				</div>
            </form>
            <div id="bottom-form"></div>


