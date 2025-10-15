<form name="official_frm_121" id="official_frm_121" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
                       @csrf
					<!-- Official Form 121 -->
                        <input type="hidden" name="form_id" value="121">
                        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
						<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b121.pdf'; ?>">
						<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_SSN.pdf'; ?>">
						<input type="hidden" name="<?php echo base64_encode('Case number1'); ?>" value="<?php echo $caseno; ?>">

						<section class="page-section Official-Form-121 padd-20" id="official-form-121">
						

							<div class="container mt-3 pl-2 pr-0">
							<div class="row">
								<div class="frm121 col-md-6">
									<div class="frm121 section-box">
										<div class="frm121 section-header bg-back text-white">
											<p class="frm121 font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
										</div>
										<div class="frm121 section-body padd-20">
											<div class="row">
												
												<div class="frm121 col-md-12">
													<label>{{ __('District Of') }}</label>
													<div class="frm121 input-group">
														<select class="frm121 form-control district-select" id="district_name" name="<?php echo base64_encode('Bankruptcy District Information')?>"> @foreach ($district_names as $district_name)
															<option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12 padd-20">
									<div class="row">
										<div class="col-md-12">
											<div class="form-title mb-3">
												<h4>{{ __('SSN Statement') }}</h4>
												<!-- <h4>{{ __('Official Form 121') }}</h4> -->
												<h2 class="font-lg-22">{{ __('Statement About Your Social Security Numbers') }}
												</h2> </div>
										</div>
										<div class="col-md-12">
											<div class="form-subheading">
												<p class="font-lg-14">{{ __('Use this form to tell the court about any Social Security or federal Individual Taxpayer Identification numbers you have used. Do not file this form as part of the public case file. This form must be submitted separately and must not be included in the court’s public electronic records. Please consult local court procedures for submission requirements. To protect your privacy, the court will not make this form available to the public. You should not include a full Social Security Number or Individual Taxpayer Number on any other document filed with the court. The court will make only the last four digits of your numbers known to the public. However, the full numbers will be available to your creditors, the U.S. Trustee or bankruptcy administrator, and the trustee assigned to your case. Making a false statement, concealing property, or obtaining money or property by fraud in connection with a bankruptcy case can result in fines up to $250,000, or imprisonment for up to 20 years, or both. 18 U.S.C. §§ 152, 1341, 1519, and 3571.') }}</p>
											</div>
										</div>
									</div>
								</div>
								<!-- Part 1 -->


									<div class="row align-items-center">
										<div class="col-md-12">
											<div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
												<h2 class="font-lg-18">{{ __('Tell the Court About Yourself and Your spouse
													if
													Your
													Spouse is
													Filing
													With You') }}</h2> </div>
										</div>
										<div class="col-md-2">
											<div class="input-group"> <strong>{{ __('1. Your name') }}</strong> </div>
										</div>
										<div class="col-md-5">
											<p class="column-heading text-center">{{ __('For Debtor 1:') }}</p>
											<div class="input-group">
												<label>{{ __('First Name') }}</label>
												<input name="<?php echo base64_encode('Debtor1.First name');?>" type="text" value="<?php echo Helper::validate_key_value('name', $BasicInfoPartA);?>" class="form-control">
											</div>
											<div class="input-group">
												<label>{{ __('Middle Name') }}</label>
												<input name="<?php echo base64_encode('Debtor1.Middle name');?>" type="text" value="<?php echo Helper::validate_key_value('middle_name', $BasicInfoPartA);?>" class="form-control">
											</div>
											<div class="input-group">
												<label>{{ __('Last Name') }}</label>
												<input name="<?php echo base64_encode('Debtor1.Last name');?>" type="text" value="<?php echo Helper::validate_key_value('last_name', $BasicInfoPartA);?>" class="form-control">
											</div>
										</div>
										<div class="col-md-5">
											<p class="column-heading text-center">{{ __('For Debtor 2 (Only If Spouse Is Filing):') }} </p>
											<div class="input-group">
												<label>{{ __('First Name') }}</label>
												<input name="<?php echo base64_encode('Debtor2.First name');?>" type="text" value="<?php echo Helper::validate_key_value('name', $BasicInfoPartB);?>" class="form-control">
											</div>
											<div class="input-group">
												<label>{{ __('Middle Name') }}</label>
												<input name="<?php echo base64_encode('Debtor2.Middle name_2');?>" type="text" value="<?php echo Helper::validate_key_value('middle_name', $BasicInfoPartB);?>" class="form-control">
											</div>
											<div class="input-group">
												<label>{{ __('Last Name') }}</label>
												<input name="<?php echo base64_encode('Debtor2.Last name');?>" type="text" value="<?php echo Helper::validate_key_value('last_name', $BasicInfoPartB);?>" class="form-control">
											</div>
										</div>
									</div>
									<!-- Part 2 -->
									<div class="row border-bottm-1 mb-3">
										<div class="col-md-12">
											<div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
												<h2 class="font-lg-18">{{ __('Tell the Court About all of Your Social
													Security
													or
													Federal
													Individual
													Taxpayer Identification Numbers') }}</h2> </div>
										</div>
										<div class="col-md-2">
											<div class="input-group"> <strong>{{ __('2. All Social Security
													Numbers you have
													used') }}</strong> </div>
										</div>
										<div class="col-md-5">
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor1a.SSNum');?>" type="text" value="<?php echo empty(Helper::validate_key_toggle('has_security_number', $BasicInfoPartA, 1)) ? Helper::validate_key_value('security_number', $BasicInfoPartA) : "";?>" class="form-control ssn_full_debtor">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor1b.SSNum');?>" type="text" value="" class="form-control">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Check Box1');?>" type="checkbox" <?php echo Helper::validate_key_toggle('has_security_number', $BasicInfoPartA, 1);?>>
												<label for="">{{ __('You do not have a Social Security number.') }}</label>
											</div>
										</div>
										<div class="col-md-5">
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor2a SSNum');?>" type="text" value="<?php echo empty(Helper::validate_key_toggle('has_security_number', $BasicInfoPartB, 1)) ? Helper::validate_key_value('social_security_number', $BasicInfoPartB) : ""?>" class="form-control">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor2b SSNum');?>" type="text" value="" class="form-control">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Check Box2');?>" type="checkbox" <?php echo Helper::validate_key_toggle('has_security_number', $BasicInfoPartB, 1);?>>
												<label for="">{{ __('You do not have a Social Security number.') }}</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="input-group"> <strong>{{ __('3. All federal Individual
													Taxpayer
													Identification
													Numbers (ITIN) you
													have used') }}</strong> </div>
										</div>
										<div class="col-md-5">
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor1a.ITINNum');?>" type="text" value="<?php echo empty(Helper::validate_key_toggle('has_security_number', $BasicInfoPartA, 0)) ? Helper::validate_key_value('itin', $BasicInfoPartA) : "";?>" class="form-control itin_full_debtor">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor1b.ITINNum');?>" type="text" value="" class="form-control">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Check Box3');?>" type="checkbox" <?php echo Helper::validate_key_toggle('has_security_number', $BasicInfoPartA, 0);?>>
												<label for="">{{ __('You do not have an ITIN.') }}</label>
											</div>
										</div>
										<div class="col-md-5">
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor2a ITINNum');?>" type="text" value="<?php echo empty(Helper::validate_key_toggle('has_security_number', $BasicInfoPartB, 0)) ? Helper::validate_key_value('itin', $BasicInfoPartB) : "";?>" class="form-control">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Debtor2b ITINNum');?>" type="text" value="" class="form-control">
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('Check Box4');?>" type="checkbox" <?php echo Helper::validate_key_toggle('has_security_number', $BasicInfoPartB, 0);?>>
												<label for="">{{ __('You do not have an ITIN.') }}</label>
											</div>
										</div>
									</div>
									<!-- Part 3 -->
									<div class="row align-items-center">
										<div class="col-md-12">
											<div class="part-form-title mb-3"> <span>{{ __('Part 3') }}</span>
												<h2 class="font-lg-18">{{ __('Sign Below') }}</h2> </div>
										</div>
										<div class="col-md-2"> </div>
										<div class="col-md-5">
											<p class="column-heading text-center">{{ __('Under penalty of perjury, I declare that the information I have provided in this form is true and correct.') }} </p>
											<div class="input-group signature-field">
												<p>{{ __('Signature of Debtor 1') }}</p> <span> <input name="<?php echo base64_encode('Debtor1.signature'); ?>"  type="text" value="{{$debtor_sign}}" class="form-control"></span>
												<label for="">{{ __('You do not have a Social Security number.') }}</label>
											</div>
											<div class="input-group">
												<label>{{ __('Date') }}</label>
												<input name="<?php echo base64_encode('Executed on'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"> </div>
										</div>
										<div class="col-md-5">
											<p class="column-heading text-center">{{ __('Under penalty of perjury, I declare that the information I have provided in this form is true and correct.') }} </p>
											<div class="input-group signature-field">
												<p>{{ __('Signature of Debtor 2') }}</p> <span> <input name="<?php echo base64_encode('Debtor2.signature'); ?>"  type="text" value="{{$debtor2_sign}}" class="form-control"></span>
												<label for="">{{ __('You do not have a Social Security number.') }}</label>
											</div>
											<div class="input-group">
												<label>{{ __('Date') }}</label>
												<input name="<?php echo base64_encode('Debtor2.Executed on'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"> </div>
										</div>
									</div>
								<x-officialForm.generatePdfButton title="Generate SSN Statement PDF" divtitle="coles_official-form-121"></x-officialForm.generatePdfButton>
							</div>
                        </div>
					</section>
                    </form>