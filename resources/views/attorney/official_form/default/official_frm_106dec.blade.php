<form name="official_frm_106dec"  class="save_official_forms"   id="official_frm_106dec" action="{{route('generate_official_pdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="form_id" value="106dec">
                    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_106dec.pdf'; ?>">
                    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_106dec.pdf'; ?>">
                    <input type="hidden" name="<?php echo base64_encode('Case number-106DEC'); ?>" value="<?php echo $caseno; ?>">
                    <input type="hidden" name="<?php echo base64_encode('Debtor 1-106DEC'); ?>" value="<?php echo $onlyDebtor; ?>">
                    <input type="hidden" name="<?php echo base64_encode('Debtor 2-106DEC'); ?>" value="<?php echo $spousename; ?>">
					 <!-- use below varibale for Part AB -->
    <?php
        $partDEC = isset($dynamicPdfData['106dec']) && !empty($dynamicPdfData['106dec']) ? json_decode($dynamicPdfData['106dec'], 1) : null;
                    ?>
						<section class="page-section official-form-106dec padd-20" id="official-form-106dec">
								<div class="frm106dec container pl-2 pr-0">
									<div class="row">
										<div class="frm106dec col-md-7">
											<div class="frm106dec section-box">
												<div class="section-header bg-back text-white">
													<p class="frm106dec font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
												</div>
												<div class="frm106dec section-body padd-20">
													<div class="row">



													<div class="frm106dec col-md-12">
                                                <div class="frm106dec input-group">
                                                    <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                                    <select class="form-control 106desc district-select" name="<?php echo base64_encode('Bankruptcy District Information-106DEC'); ?>" id="district_name"> @foreach ($district_names as $district_name)
                                                            <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>

														</div>
													</div>

													</div>
												</div>
											</div>
										</div>

										<div class="frm106dec col-md-5">
								<div class="frm106dec amended">
									<input type="checkbox" name="<?php echo base64_encode('Check if this is an-106DEC');?>">
									<label>{{ __('Check if this is an amended filing') }}</label>
								</div>
							</div>

									</div>
									<div class="row padd-20">
										<div class="col-md-12 mb-3">
											<div class="form-title">
												<h4>{{ __('Declaration of Sch.') }}</h4>
												<!-- <h4>{{ __('Official Form 106Dec') }} </h4> -->
												<h2 class="font-lg-22">{{ __('Declaration About an Individual Debtor’s Schedules') }}
										</h2> </div>
										</div>
										<div class="col-md-12">
											<div class="form-subheading">
												<p class="font-lg-14"><strong>{{ __('If two married people are filing together,
												both
												are equally responsible for supplying correct information.
												You must file this form whenever you file bankruptcy schedules or
												amended schedules. Making a false statement, concealing property, or
												obtaining money or property by fraud in connection with a bankruptcy
												case can result in fines up to $250,000, or imprisonment for up to
												20
												years, or both. 18 U.S.C. §§ 152, 1341, 1519, and 3571.') }}
											</strong></p>
											</div>
										</div>
									</div>
									<!-- Part 1 -->
									<div class="row frm106dec align-items-center">
										<div class="col-md-12">
											<div class="frm106dec part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
												<h2 class="frm106dec font-lg-18">{{ __('Sign Below') }}</h2> </div>
										</div>
									</div>
									<!-- Row 1 -->
									<div class="form-border">
										<div class="row">
											<div class="col-md-12">
												<div class="input-group d-inline-block">
													<label for=""> <strong class="d-block">{{ __('Did you pay or agree to pay someone who is
													NOT
													an attorney to help you fill out bankruptcy forms?') }}
												</strong> </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode('check1#1-106DEC');?>" value="no" type="checkbox"
														<?php echo isset($partDEC[base64_encode('check1#1-106DEC')]) ? Helper::validate_key_toggle(base64_encode('check1#1-106DEC'), $partDEC, 'no') : 'checked';?>
													>
													<label>{{ __('No Go to line 2.') }}</label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode('check1#1-106DEC');?>" value="yes" type="checkbox"
														<?php echo isset($partDEC[base64_encode('check1#1-106DEC')]) ? Helper::validate_key_toggle(base64_encode('check1#1-106DEC'), $partDEC, 'yes') : '';?>
													>
													<label>{{ __('Yes. Name of person') }}</label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode('Name of person payed to help file-106DEC');?>" type="text" value="<?php echo $partDEC[base64_encode('Name of person payed to help file-106DEC')] ?? '';?>" class="form-control">
													<label>{{ __('Attach Bankruptcy Petition Preparer’s Notice, Declaration, and Signature (Official Form 119).') }}</label>
												</div>
											</div>
											<div class="col-md-12 mt-3">
												<div class="input-group d-inline-block">
													<label for=""> <strong class="d-block">{{ __('Under penalty of perjury, I declare that I
													have
													read the summary and schedules filed with this declaration and
													that they are true and correct.') }}
												</strong> </label>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="input-group signature-field">
															<p>{{ __('Signature of Debtor 1') }}</p>
															<span> <input name="<?php echo base64_encode('Debtor1.signature-106DEC'); ?>"  type="text" value="{{$debtor_sign}}" class="form-control"></span>
															<label for="">{{ __('You do not have a Social Security number.') }}</label>
														</div>
														<div class="input-group">
															<label>{{ __('Date') }}</label>
															<input name="<?php echo base64_encode('Executed on-106DEC'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"> </div>
													</div>
													<div class="col-md-6 106desc">
														<div class="input-group 106desc signature-field">
															<p>{{ __('Signature of Debtor 2') }}</p>
															<span> 
																<input name="<?php echo base64_encode('Debtor2.signature-106DEC'); ?>"  type="text" value="{{$debtor2_sign}}" class="form-control"></span>
															<label for="">{{ __('You do not have a Social Security number.') }}</label>
														</div>
														<div class="106desc input-group">
															<label>{{ __('Date') }}</label>
															<input name="<?php echo base64_encode('Debtor2.Executed on-106DEC'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"> </div>
													</div>

												</div>

											</div>

										</div>
									</div>
								</div>
                            <x-officialForm.generatePdfButton
                                title="Generate PDF" divtitle="coles_official-form-106dec"
                            ></x-officialForm.generatePdfButton>

							</section>
</form>
