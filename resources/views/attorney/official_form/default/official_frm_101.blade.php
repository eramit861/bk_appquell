<form name="official_frm_101" id="official_frm_101" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
                        @csrf
                        <input type="hidden" name="form_id" value="101">
                        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
						<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b_101.pdf'; ?>">
						<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b_101.pdf'; ?>">
						<input type="hidden" name="<?php echo base64_encode('Case number1'); ?>" value="<?php echo $caseno; ?>">
						<input type="hidden" name="<?php echo base64_encode('Form101-Debtor1.Name'); ?>" value="<?php echo $onlyDebtor; ?>">
						
						<input type="hidden" name="<?php echo base64_encode('Form101-Case number1'); ?>" value="<?php echo $caseno; ?>">
						<?php $volPetData = isset($dynamicPdfData['vol_petition_data']) && !empty($dynamicPdfData['vol_petition_data']) ? json_decode($dynamicPdfData['vol_petition_data'], 1) : null;

                        ?>
					<section class="page-section official-form-101 padd-20" id="official-form-101">
						<div class="frm101 container pl-2 pr-0">
							<div class="row">
								<div class="frm101 col-md-7">
									<div class="section-box">
										<div class="frm101 section-header bg-back text-white">
											<p class="frm101 font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
										</div>
										<div class="section-body padd-20">
											<div class="row">
												<div class="frm101 col-md-12">
													<label>{{ __('United States Bankruptcy Court for the:') }}</label>
												</div>
												<div class="frm101 col-md-12">
													<div class="input-group">
														<select class="frm101 form-control district-select" name="<?php echo base64_encode('Form101-Bankruptcy District Information');?>" id="district_name"> @foreach ($district_names as $district_name)
															<option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>
													</div>
												</div>


												<div class="col-md-12">
													<div class="frm101 input-group">
														<label>{{ __('Chapter you are filing under:') }}</label>
														<div class="checkbox-cust">
															<input class="chapter7 vol_pet_ch_select" name="<?php echo base64_encode('Form101-Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter7'); ?> value="Chapter 7" type="checkbox">
															<label>{{ __('Chapter 7') }}</label>
														</div>
														<div class="checkbox-cust">
															<input class="chapter11 vol_pet_ch_select" type="checkbox" name="<?php echo base64_encode('Form101-Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter11'); ?> value="Chapter 11">
															<label>{{ __('Chapter 11') }}</label>
														</div>
														<div class="checkbox-cust">
															<input class="chapter12 vol_pet_ch_select" type="checkbox" name="<?php echo base64_encode('Form101-Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter12'); ?> value="Chapter 12">
															<label>{{ __('Chapter 12') }}</label>
														</div>
														<div class="checkbox-cust">
															<input  class="chapter13 vol_pet_ch_select" type="checkbox" name="<?php echo base64_encode('Form101-Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter13'); ?> value="Chapter 13">
															<label>{{ __('Chapter 13') }}</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5">

											<div class="amended">
												<input type="checkbox"  class="vol_pet_is_amended" name="<?php echo base64_encode('Form101-Check Box2');?>" value="On" <?php echo isset($volPetData[base64_encode('Form101-Check Box2')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box2'), $volPetData, 'On') : '';?>>
												<label>{{ __('Check if this is an amended filing') }}</label>

									</div>
								</div>
							</div>
							<div class="row padd-20">
								<div class="col-md-12 mb-3 float-left" >
									<div class="form-title">
										<h4>{{ __('Vol Petition') }}</h4>
										<!-- <h4>{{ __('Official Form 101') }}</h4> -->
										<h2 class="font-lg-22">{{ __('Voluntary Petition for Individuals Filing for Bankruptcy') }}
										</h2> </div>
								</div>

								<div class="col-md-12">
									<div class="form-subheading">
										<p class="font-lg-14">{{ __('The bankruptcy forms use you and Debtor 1 to refer to a debtor filing alone. A married couple may file a bankruptcy case together—called a joint case—and in joint cases, these forms use you to ask for information from both debtors. For example, if a form asks, “Do you own a car,” the answer would be yes if either debtor owns a car. When information is needed about the spouses separately, the form uses Debtor 1 and Debtor 2 to distinguish between them. In joint cases, one of the spouses must report information as Debtor 1 and the other as Debtor 2. The same person must be Debtor 1 in all of the forms. Be as complete and accurate as possible. If two married people are filing together, both are equally responsible for supplying correct information. If more space is needed, attach a separate sheet to this form. On the top of any additional pages, write your name and case number (if known). Answer every question.') }}</p>
									</div>
								</div>
							</div>
							<!-- Part 1 -->
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
										<h2 class="font-lg-18">{{ __('Identify Yourself') }}</h2> </div>
								</div>
							</div>
							<div class="form-border">
								<div class="row ">
									<div class="col-md-2 mt-4">
										<div class="input-group"> <strong>{{ __('1. Your name') }}</strong>
											<p>{{ __('Write the name that is on your government-issued picture identification (for example, your driver’s license or passport). Bring your picture identification to your meeting with the trustee.') }}</p>
										</div>
									</div>
									
									<div class="col-md-5">
										
										<p class="column-heading text-center">{{ __('About Debtor 1:') }} </p>
										<div class="input-group">
											<label>{{ __('First Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor1.First name');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.First name')] ?? Helper::validate_key_value('name', $BasicInfoPartA);?>" class="form-control fi_first_name vol_pet_debtor_fname">
										</div>
										<div class="input-group">
											<label>{{ __('Middle Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor1.Middle name');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.Middle name')] ?? Helper::validate_key_value('middle_name', $BasicInfoPartA);?>" class="form-control fi_middle_name vol_pet_debtor_mname">
										</div>
										<div class="input-group">
											<label>{{ __('Last Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor1.Last name');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.Last name')] ?? Helper::validate_key_value('last_name', $BasicInfoPartA);?>" class="form-control fi_last_name vol_pet_debtor_lname">
										</div>
										<div class="input-group">
											<label> {{ __('Suffix') }} </label>
											<?php $suffixArray = ArrayHelper::getSuffixArray();

                        ?>
											<div class="form-group">
												<select name="<?php echo base64_encode('Form101-Debtor1.Suffix Sr Jr II III');?>" class="form-control fi_generation vol_pet_debtor_suffix">
													<option value="">{{ __('None') }}</option>
													<?php foreach ($suffixArray as $key => $val) {

													    ?>
														<option value="<?php echo $val;?>" <?php  if ($val == (Helper::validate_key_value(base64_encode("Form101-Debtor1.Suffix Sr Jr II III"), $volPetData))) {
														    echo "selected";
														} else {
														    echo ($key == Helper::validate_key_value('suffix', $BasicInfoPartA)) ? 'selected' : '';
														} ?> ><?php echo $val;?></option>
													<?php }?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<p class="column-heading text-center">{{ __('About Debtor 2 (Spouse Only in a Joint Case):') }} </p>
										<div class="input-group">
											<label>{{ __('First Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor2.First name');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.First name')] ?? Helper::validate_key_value('name', $BasicInfoPartB);?>" class="form-control vol_pet_spouse_fname">
										</div>
										<div class="input-group">
											<label>{{ __('Middle Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor2.Middle name_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.Middle name_2')] ?? Helper::validate_key_value('middle_name', $BasicInfoPartB);?>" class="form-control vol_pet_spouse_mname">
										</div>
										<div class="input-group">
											<label>{{ __('Last Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor2.Last name');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.Last name')] ?? Helper::validate_key_value('last_name', $BasicInfoPartB);?>" class="form-control vol_pet_spouse_lname">
										</div>
										<div class="input-group">
											<label> {{ __('Suffix') }}</label>
											<?php $suffixArray = ArrayHelper::getSuffixArray(); ?>
											<div class="form-group">
												<select name="<?php echo base64_encode('Form101-Suffix Sr Jr II III_2');?>" class="form-control vol_pet_spouse_suffix">
												<option value="">{{ __('None') }}</option>
													<?php foreach ($suffixArray as $key => $val) {?>
														<option value="<?php echo $val;?>" <?php if ($val == (Helper::validate_key_value(base64_encode("Form101-Suffix Sr Jr II III_2"), $volPetData))) {
														    echo "selected";
														} else {
														    echo ($key == Helper::validate_key_value('suffix', $BasicInfoPartB)) ? 'selected' : '';
														} ?> ><?php echo $val;?></option>
													<?php }?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
                            //echo $any_other_name;
                                $BasicInfo_AnyOtherName101 = $basic_info['BasicInfo_AnyOtherName'];
                        $final_BasicInfo_AnyOtherName = [];
                        if (!empty($BasicInfo_AnyOtherName101)) {
                            foreach ($BasicInfo_AnyOtherName101->toArray() as $key => $val) {
                                if (is_array(json_decode($val, 1))) {
                                    $adata[$key] = json_decode($val, 1);
                                    $final_BasicInfo_AnyOtherName[$key] = $adata[$key];
                                } else {
                                    $final_BasicInfo_AnyOtherName[$key] = $val;
                                }
                            }
                        }
                        $BasicInfo_AnyOtherName101 = $final_BasicInfo_AnyOtherName;
                        ?>

							<input type="hidden" value="{{$BasicInfo_AnyOtherName101['home']}}" class="fi_phone">
							<input type="hidden" value="{{$BasicInfoPartA['security_number']}}" class="fi_ssn_itin">
							<input type="hidden" value="{{Helper::validate_key_value('client_type', $clentData)}}" class="fi_marital_status">
							
								<div class="form-border">
									<div class="row mb-3">
										<div class="col-md-2 ">
											<div class="input-group"> <strong>2. {{ __('All other names you have used in the last 8 years') }}</strong>
												<p>{{ __('Include your married or maiden names and any assumed, trade names and') }}
													<i>{{ __('doing business') }}</i> {{ __('as names.') }}</p>
													<p>
													{{ __('Do NOT list the name of any separate legal entity such as a corporation, partnership, or LLC that is not filing this petition.') }}</p>
											</div>
									  </div>
									<div class="col-md-5">
									<?php
                                if ($any_other_name == 'Yes') {
                                    $k = 0;
                                    if (!empty($BasicInfo_AnyOtherName101['name']) && is_array($BasicInfo_AnyOtherName101['name'])) {
                                        if (count($BasicInfo_AnyOtherName101['name']) > 0) {
                                            $fieldId = 3;
                                            for ($k = 0;$k < count($BasicInfo_AnyOtherName101['name']);$k++) {

                                                ?>
										<div class="input-group">
											<label>{{ __('First Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor1.First name_'.$fieldId);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.First name_'.$fieldId)] ?? Helper::validate_key_loop_value('name', $BasicInfo_AnyOtherName101, $k);?>" class="form-control vol_pet_other_firstname_<?php echo $k; ?>">
										</div>
										<div class="input-group">
											<label>{{ __('Middle Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor1.Middle name_'.$fieldId);?>" type="text" value="<?php echo  $volPetData[base64_encode('Form101-Debtor1.Middle name_'.$fieldId)] ?? Helper::validate_key_loop_value('middle_name', $BasicInfo_AnyOtherName101, $k);?>" class="form-control vol_pet_other_middlename_<?php echo $k; ?>">
										</div>
										<?php
                                                    $suffix = '';
                                                $suffix = Helper::validate_key_value(base64_encode('Form101-suffix_in8years_'.$fieldId), $volPetData) ?? Helper::validate_key_loop_value('suffix', $BasicInfo_AnyOtherName101, $k, $key);
                                                ?>
										<div class="input-group">
											<label>{{ __('Last Name') }}</label>
											<input name="<?php echo base64_encode('Form101-_Debtor1.Last name_'.$fieldId);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-_Debtor1.Last name_'.$fieldId)] ?? Helper::validate_key_loop_value('last_name', $BasicInfo_AnyOtherName101, $k);?>" class="form-control vol_pet_other_lastname_<?php echo $k; ?>">
											<input name="<?php echo base64_encode('Form101-Debtor1.Last name_'.$fieldId);?>" type="hidden" value="<?php echo $volPetData[base64_encode('Form101-_Debtor1.Last name_'.$fieldId)] ?? Helper::validate_key_loop_value('last_name', $BasicInfo_AnyOtherName101, $k);?><?php echo !empty($suffix) ? ", ".$suffix : ''; ?>" class="form-control vol_pet_other_lastname_<?php echo $k; ?>">
										</div>
										<div class="input-group">
										<label> {{ __('Suffix') }}</label>
										<?php $suffixArray = ArrayHelper::getSuffixArray();

                                                ?>


										<div class="form-group">
											<select name="<?php echo base64_encode('Form101-suffix_in8years_'.$fieldId);?>" class="form-control vol_pet_other_suffix_<?php echo $k; ?>">
											<option value="">{{ __('None') }}</option>
												<?php foreach ($suffixArray as $key => $val) {?>
													<option value="<?php echo $val;?>" <?php if ($val == (Helper::validate_key_value(base64_encode('Form101-suffix_in8years_'.$fieldId), $volPetData))) {
													    echo "selected";
													} else {
													    echo Helper::validate_key_option_loop('suffix', $BasicInfo_AnyOtherName101, $k, $key);
													} ?> ><?php echo $val;?></option>
												<?php }?>
											</select>
										</div>
										</div>
										<?php 	$fieldId = $fieldId + 2;
                                            }
                                        }
                                    }
                                } else {
                                    echo "No";
                                } ?>

										<?php
                                    $debtor = [];
                        $spouse = [];
                        $BasicInfo_PartRest101 = $basic_info['BasicInfo_PartRest'];
                        if (Helper::validate_key_value('used_business_ein', $BasicInfo_PartRest101) == 1) {
                            $used_business_data = [];


                            if (!empty($BasicInfo_PartRest101['used_business_ein_data'])) {

                                $used_business_dta_info = json_decode($BasicInfo_PartRest101['used_business_ein_data'], 1);

                                $used_business_data = (!empty($used_business_dta_info) && is_array($used_business_dta_info)) ? $used_business_dta_info : [];

                            }
                            if (!empty($used_business_data) && is_array($used_business_data['own_business_name'])) {
                                for ($j = 0;$j < (is_countable($used_business_data['own_business_name']));$j++) {
                                    if (!empty($used_business_data) && is_array($used_business_data['own_business_name'])) {
                                        for ($j = 0; $j < count($used_business_data['own_business_name']); $j++) {
                                            if (isset($used_business_data['own_business_selection'][$j]) && $used_business_data['own_business_selection'][$j] == 0 && isset($used_business_data['own_business_name'][$j])) {
                                                $debtor['business_name'][] = $used_business_data['own_business_name'][$j];
                                                $debtor['own_ein_no'][] = $used_business_data['own_ein_no'][$j] ?? '';
                                            } else {
                                                $spouse['business_name'][] = isset($used_business_data['own_business_name'][$j]) ? $used_business_data['own_business_name'][$j] : '';
                                                $spouse['own_ein_no'][] = isset($used_business_data['own_ein_no'][$j]) ? $used_business_data['own_ein_no'][$j] : '';
                                            }
                                        }
                                    }


                                    $businessCount = 1;
                                    if (isset($debtor['business_name'])) {
                                        $index = '';
                                        foreach ($debtor['business_name'] as $name) {
                                            if ($businessCount == 1) {
                                                $index = '01';
                                            }
                                            if ($businessCount == 2) {
                                                $index = "03";
                                            }
                                            ?>
													<div class="input-group"><?php ?>
														<label>{{ __('Business name') }}</label>
														<input name="<?php echo base64_encode('Form101-Business Name.'.$index);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Business Name.'.$index)] ?? $name;?>" class="form-control businessname vol_pet_business_name_<?php echo $businessCount; ?>">
													</div>
												<?php
                                                $businessCount++;
                                        }
                                    }

                                }
                            }
                        } ?>

									</div>
									<div class="col-md-5">
									<?php
                                    $j = 0;
                        if (Helper::validate_key_value('spouse_any_other_name', $BasicInfoPartB) == 1) {
                            if (!empty($BasicInfoPartB['spouse_other_name']) && is_array($BasicInfoPartB['spouse_other_name'])) {
                                if (count($BasicInfoPartB['spouse_other_name']) > 0) {
                                    $fieldId = 4;
                                    for ($j = 0;$j < count($BasicInfoPartB['spouse_other_name']);$j++) {

                                        ?>
										<div class="input-group">
											<label>{{ __('First Name') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor2.First name_'.$fieldId);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.First name_'.$fieldId)] ?? Helper::validate_key_loop_value('spouse_other_name', $BasicInfoPartB, $j);?>" class="form-control vol_pet_spouse_other_name_<?php echo $j; ?>">
										</div>
										<div class="input-group">
											<label>{{ __('Middle Name') }}</label>
											<input name="<?php echo base64_encode('Debtor2.Middle name_'.$fieldId);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.Middle name_'.$fieldId)] ?? Helper::validate_key_loop_value('spouse_other_middle_name', $BasicInfoPartB, $j);?>" class="form-control vol_pet_spouse_other_mname_<?php echo $j; ?>">
										</div>
										<?php
                                            $suffix = '';
                                        $suffix = Helper::validate_key_value(base64_encode('Form101-debtor2_suffix_in8years_'.$fieldId), $volPetData) ?? Helper::validate_key_loop_value('spouse_other_suffix', $BasicInfoPartB, $j, $key);
                                        ?>
										<div class="input-group">
											<label>{{ __('Last Name') }}</label>
											<input name="<?php echo base64_encode('Form101-_Debtor2.Last name_'.$fieldId);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-_Debtor2.Last name_'.$fieldId)] ?? Helper::validate_key_loop_value('spouse_other_last_name', $BasicInfoPartB, $j);?>" class="form-control vol_pet_spouse_other_lname_<?php echo $j; ?>">
											<input name="<?php echo base64_encode('Form101-Debtor2.Last name_'.$fieldId);?>" type="hidden" value="<?php echo $volPetData[base64_encode('Form101-_Debtor2.Last name_'.$fieldId)] ?? Helper::validate_key_loop_value('spouse_other_last_name', $BasicInfoPartB, $j);?><?php echo !empty($suffix) ? ", ".$suffix : '';?>" class="form-control vol_pet_spouse_other_lname_<?php echo $j; ?>">
										</div>
										<div class="input-group">
										<label> {{ __('Suffix') }}</label>
										<?php $suffixArray = ArrayHelper::getSuffixArray(); ?>
										<div class="form-group">
											<select  name="<?php echo base64_encode('Form101-debtor2_suffix_in8years_'.$fieldId);?>" class="form-control vol_pet_spouse_other_suffix_<?php echo $j; ?>">
											<option value="">{{ __('None') }}</option>
												<?php foreach ($suffixArray as $key => $val) {?>
													<option value="<?php echo $val;?>" <?php if ($val == (Helper::validate_key_value(base64_encode('Form101-debtor2_suffix_in8years_'.$fieldId), $volPetData))) {
													    echo "selected";
													} else {
													    echo Helper::validate_key_option_loop('spouse_other_suffix', $BasicInfoPartB, $j, $key);
													} ?> ><?php echo $val;?></option>
												<?php }?>
											</select>
										</div>
										</div>
										<?php  $fieldId = $fieldId + 2;
                                    }
                                }
                            }
                        } ?>
										<?php if (Helper::validate_key_value('used_business_ein', $BasicInfo_PartRest101) == 1) { ?>
										<?php if (isset($spouse['business_name'])) {
										    $index = '';
										    $deb2BusinessCount = 3;
										    foreach ($spouse['business_name'] as $name) {
										        if ($deb2BusinessCount == 3) {
										            $index = '02';
										        }
										        if ($deb2BusinessCount == 4) {
										            $index = '04';
										        }
										        if ($deb2BusinessCount > 4) {
										            $index = '';
										        }
										        ?>
												<div class="input-group"><?php ?>
													<label>{{ __('Business name') }}</label>
													<input name="<?php echo base64_encode('Form101-Business Name.'.$index);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Business Name.'.$index)] ?? $name;?>" class="form-control businessname vol_pet_spouse_business_name<?php echo $deb2BusinessCount; ?>">
												</div>
										<?php
										        $deb2BusinessCount++;
										    }
										}
										}?>
									</div>
								</div>
							
								</div>

								<div class="form-border">
									<div class="row">
										<div class="col-md-2">
											<div class="input-group"> <strong>3. {{ __('Only the last 4 digits of your Social Security number or federal Individual Taxpayer Identification number (ITIN)') }}</strong> </div>
										</div>
										<?php
										$ditin = '';
                        $dssn = '';

                        if (Helper::validate_key_value('has_security_number', $BasicInfoPartA) == 1) {
                            $ditin = Helper::validate_key_value('itin', $BasicInfoPartA);
                            $ditin = $volPetData[base64_encode('Form101-Debtor1 Tax Payer IDNum')] ?? $ditin;
                            $ditin = substr($ditin, -4);
                        }

                        if (Helper::validate_key_value('has_security_number', $BasicInfoPartA) != 1) {
                            $dssn = Helper::validate_key_value('security_number', $BasicInfoPartA);
                            $dssn = $volPetData[base64_encode('Form101-Debtor1.SSNum')] ?? $dssn;
                            $dssn = substr($dssn, -4);
                        }

                        ?>
									<div class="col-md-5">
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Debtor1.SSNum');?>" type="text" value="<?php echo $dssn;?>" class="form-control vol_pet_ssn">
										</div>
										<div class="or input-group text-center">
											<h4>{{ __('OR') }}</h4>
										</div>
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Debtor1 Tax Payer IDNum');?>" type="text" value="<?php echo $ditin;?>" class="form-control vol_pet_itin">
										</div>
									</div>
									<?php $ditin2 = '';
                        $dssn2 = '';

                        if (Helper::validate_key_value('has_security_number', $BasicInfoPartB) == 1) {
                            $ditin2 = Helper::validate_key_value('itin', $BasicInfoPartB);
                            $ditin2 = $volPetData[base64_encode('Form101-Debtor2.Tax Payer IDNum')] ?? $ditin2;
                            $ditin2 = substr($ditin2, -4);
                        }

                        if (Helper::validate_key_value('has_security_number', $BasicInfoPartB) != 1) {
                            $dssn2 = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
                            $dssn2 = $volPetData[base64_encode('Form101-Debtor2 SSNum')] ?? $dssn2;
                            $dssn2 = substr($dssn2, -4);
                        }
                        ?>
									<div class="col-md-5">
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Debtor2 SSNum');?>" type="text" value="<?php echo $dssn2;?>" class="form-control vol_pet_spouse_ssn">
										</div>
										<div class="or input-group text-center">
											<h4>{{ __('OR') }}</h4>
										</div>
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Debtor2.Tax Payer IDNum');?>" type="text" value="<?php echo $ditin2;?>" class="form-control vol_pet_spouse_itin">
										</div>
									</div>

								</div>
								</div>


								<?php
                            $BasicInfo_PartRest1012 = $basic_info['BasicInfo_PartRest'];
                        $used_business_data = [];

                        if (!empty($BasicInfo_PartRest1012['used_business_ein_data'])) {
                            $used_business_dta_info1012 = json_decode($BasicInfo_PartRest1012['used_business_ein_data'], 1);
                            $used_business_data = (!empty($used_business_dta_info1012) && is_array($used_business_dta_info1012)) ? $used_business_dta_info1012 : [];
                        }
                        if (!empty($used_business_data) && is_array($used_business_data['own_business_name'])) {
                            for ($j = 0;$j < (is_countable($used_business_data['own_business_name']));$j++) { ?>
									<div class="form-border">
										<div class="row">
											<div class="col-md-2">
												<div class="input-group"> <strong>4. {{ __('Your Employer Identification Number (EIN), if any.') }}</strong>
													
												</div>
											</div>
											<div class="col-md-5">
										<p class="column-heading text-center">{{ __('About Debtor 1:') }}</p>
										

										<?php if (isset($debtor['own_ein_no'])) {
										    $deb1einCount = 1;
										    $index = '';
										    foreach ($debtor['own_ein_no'] as $no) {
										        if ($deb1einCount == 1) {
										            $index = '';
										        }
										        if ($deb1einCount == 2) {
										            $index = "_3";
										        }
										        ?>
											<div class="input-group">
												<label>EIN</label>
												<input name="<?php echo base64_encode('Form101-Debtor1.Business name'.$index);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.Employer Identification Number'.$deb1einCount)] ?? $no;?>" class="form-control  fi_tax_id_ein vol_pet_business_ein_<?php echo $deb1einCount; ?>">
											</div>
										<?php $deb1einCount++;
										    }
										} ?>
									</div>

									<div class="col-md-5">
										<p class="column-heading text-center">{{ __('About Debtor 2 (Spouse Only in a Joint Case):') }}
										</p>
									

										<?php if (isset($spouse['own_ein_no'])) {
										    $deb3einCount = 1;
										    $index = '';
										    foreach ($spouse['own_ein_no'] as $no) {
										        if ($deb3einCount == 1) {
										            $index = '';
										        }
										        if ($deb3einCount == 2) {
										            $index = '_4';
										        }?>
											<div class="input-group">
												<label>EIN</label>
												<input name="<?php echo base64_encode('Form101-Debtor2.Business name'.$index);?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.Employer Identification Number'.$deb3einCount)] ?? $no;?>" class="form-control  vol_pet_spouse_business_ein<?php echo $deb3einCount; ?>">
											</div>
										<?php $deb3einCount++;
										    }
										} ?>
									</div>
								</div>
							</div>
							<?php }
                            } ?>

										<div class="form-border">
											<div class="row mb-3">
												<div class="col-md-2">
													<div class="input-group"> <strong>{{ __('5. Where you live') }}</strong> </div>
												</div>
												<div class="col-md-5">
													<p class="mb-3">.</p>
													<div class="row">
														<!-- <div class="col-md-4">
												<div class="input-group">
													<label>{{ __('Number') }}</label>
													<input type="text" value="" class="form-control">
												</div>
											</div> -->
											<div class="col-md-12">
												<div class="input-group">
													<label>{{ __('Street') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.Street');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.Street')] ?? Helper::validate_key_value('Address', $BasicInfoPartA);?>" class="form-control fi_address_1 vol_pet_where_u_live_street">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('City') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.City');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.City')] ?? Helper::validate_key_value('City', $BasicInfoPartA);?>" class="form-control fi_city vol_pet_where_u_live_city">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('State') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.State');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.State')] ?? Helper::validate_key_value('state', $BasicInfoPartA);?>" class="form-control fi_state vol_pet_where_u_live_state">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('Zip Code') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.ZIP Code');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.ZIP Code')] ?? Helper::validate_key_value('zip', $BasicInfoPartA);?>" class="form-control fi_zip vol_pet_where_u_live_zip">
												</div>
											</div>
										</div>
										<div class="input-group">
											<label>{{ __('County') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor1.County');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.County')] ?? Helper::validate_key_value('country', $BasicInfoPartA);?>" class="form-control fi_county vol_pet_where_u_live_county">
										</div>
										<div class="frm101 input-group">
											<label class="frm101" for=""><strong>{{ __('If your mailing address is different from the one above, fill it in here.') }}</strong> {{ __('Note that the court will send any notices to you at this mailing address.') }}</label>
										</div>
										<div class="row">
											<div class="frm101 col-md-12">
												<div class="frm101 input-group">
													<label>{{ __('Street') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.Street_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.Street_2')] ?? '';?>" class="form-control frm101 ma-address vol_pet_mail_address">
												</div>
											</div>
										</div>
										<div class="input-group">
											<label>{{ __('P.O. Box') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor1.PO Box');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.PO Box')] ?? '';?>" class="form-control vol_pet_mail_po_box">
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('City') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.City_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.City_2')] ?? '';?>" class="ma-city form-control vol_pet_mail_city">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('State') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.State_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor1.State_2')] ?? '';?>" class="ma-state form-control vol_pet_mail_state">
												</div>
											</div>

											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('Zip Code') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor1.ZIP Code_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor.ZIP Code_2')] ?? '' ?>" class="ma-zip form-control vol_pet_mail_zip">
												</div>
											</div>
										</div>
									</div>
									<?php
                                            $BasicInfoPartB['City'] = (!empty($BasicInfoPartB['spouse_different_address'])) ? $BasicInfoPartB['City'] : $BasicInfoPartA['City'];

                        $BasicInfoPartB['Address'] = (!empty($BasicInfoPartB['spouse_different_address'])) ? $BasicInfoPartB['Address'] : $BasicInfoPartA['Address'];

                        $BasicInfoPartB['state'] = (!empty($BasicInfoPartB['spouse_different_address'])) ? $BasicInfoPartB['state'] : $BasicInfoPartA['state'];

                        $BasicInfoPartB['zip'] = (!empty($BasicInfoPartB['spouse_different_address'])) ? $BasicInfoPartB['zip'] : $BasicInfoPartA['zip'];

                        $BasicInfoPartB['country'] = (!empty($BasicInfoPartB['spouse_different_address'])) ? \App\Models\CountyFipsData::get_county_name_by_id($BasicInfoPartB['country']) : \App\Models\CountyFipsData::get_county_name_by_id($BasicInfoPartA['country']);
                        ?>
									<div class="col-md-5">
										<p class="mb-3">.</p>
										<div class="row">

										<!-- <div class="col-md-4">
												<div class="input-group">
													<label>{{ __('Number') }}</label>
													<input type="text" value="" class="form-control">
												</div>
											</div> -->

											<div class="col-md-12">
												<div class="input-group">
													<label>{{ __('Street') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor2.Street');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.Street')] ?? Helper::validate_key_value('Address', $BasicInfoPartB);?>" class="form-control vol_pet_where_u_live_street2">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('City') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor2.City');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.City')] ?? Helper::validate_key_value('City', $BasicInfoPartB);?>" class="form-control vol_pet_where_u_live_city2">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('State') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor2.State');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.State')] ?? Helper::validate_key_value('state', $BasicInfoPartB);?>" class="form-control vol_pet_where_u_live_state2">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('Zip Code') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor2.ZIP');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.ZIP')] ?? Helper::validate_key_value('zip', $BasicInfoPartB);?>" class="form-control vol_pet_where_u_live_zip2">
												</div>
											</div>
										</div>
										<?php
                        ?>
										<div class="input-group">
											<label>{{ __('County') }}</label>
											<input name="<?php echo base64_encode('Form101-County_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-County_2')] ?? Helper::validate_key_value('country', $BasicInfoPartB);?>" class="form-control vol_pet_where_u_live_county2">
										</div>
										<div class="input-group">
											<label for=""><strong>{{ __('If your mailing address is different from the one above, fill it in here.') }}</strong> {{ __('Note that the court will send any notices to you at this mailing address.') }}</label>
										</div>
										<div class="row">
											<!-- <div class="col-md-4">
												<div class="input-group">
													<label>{{ __('Number') }}</label>
													<input type="text" value="" class="form-control">
												</div>
											</div> -->
											<div class="col-md-12">
												<div class="input-group">
													<label>{{ __('Street') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor2.Street_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.Street_2')] ?? '';?>" class="ma-address form-control vol_pet_mail_address2">
												</div>
											</div>
										</div>
										<div class="input-group">
											<label>{{ __('P.O. Box') }}</label>
											<input name="<?php echo base64_encode('Form101-Debtor2.PO Box');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.PO Box')] ?? '';?>" class="form-control vol_pet_mail_po_box2">
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('City') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor2.City_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.City_2')] ?? '';?>" class="ma-city form-control vol_pet_mail_city2">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('State') }}</label>
													<input name="<?php echo base64_encode('Form101-Debtor2.State_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.State_2')] ?? '';?>" class="ma-state form-control vol_pet_mail_state2">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('Zip Code') }}</label>
													<input name="<?php echo base64_encode('Form101-ZIP Code_4');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Debtor2.ZIP Code_4')] ?? '';?>" class="ma-zip form-control vol_pet_mail_zip2">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>




										<div class="form-border">
											<div class="row">
												<div class="col-md-2">
													<div class="input-group"> <strong>{{ __('6. Why you are choosing this district to file for bankruptcy') }} </strong> </div>
												</div>
												<div class="col-md-5">
													<p class="column-heading">{{ __('Check one:') }}</p>
													<div class="input-group">
														<input name="<?php echo base64_encode('Form101-Check Box5');?>" class="vol_pet_why_district" type="checkbox" value="Lived in this district" <?php echo isset($volPetData[base64_encode('Form101-Check Box5')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box5'), $volPetData, 'Lived in this district') : 'checked';?>>
														<label for="">{{ __('Over the last 180 days before filing this petition, I have lived in this district longer than in any other district.') }}</label>
													</div>
													<div class="input-group">
														<input type="checkbox"  class="vol_pet_why_district_another_reason" <?php echo isset($volPetData[base64_encode('Form101-Check Box5')]) && $volPetData[base64_encode('Form101-Check Box5')] == 'Other' ? "checked" : ""; ?> name="<?php echo base64_encode('Form101-Check Box5');?>" value="Other">
														<label for="">{{ __('I have another reason. Explain. (See 28 U.S.C. § 1408.)') }}</label>
													</div>
													<div class="input-group">
														<textarea name="<?php echo base64_encode('Form101-Debtor1.See 28 USC  1408 1');?>" cols="5" rows="5" class="form-control vol_pet_why_district_expain_reason"><?php echo $volPetData[base64_encode('Form101-Debtor1.See 28 USC  1408 1')] ?? ''; ?></textarea>
													</div>
												</div>
												<div class="col-md-5">
													<p class="column-heading">{{ __('Check one:') }} </p>
													<div class="input-group">
														<input name="<?php echo base64_encode('Form101-Check Box6');?>" class="vol_pet_spouse_why_district" type="checkbox"  value="Lived in this district" <?php echo isset($volPetData[base64_encode('Form101-Check Box6')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box6'), $volPetData, 'Lived in this district') : 'checked';?>>
														<label for="">{{ __('Over the last 180 days before filing this petition, I have lived in this district longer than in any other district.') }}</label>
													</div>
													<div class="input-group">
														<input type="checkbox"  name="<?php echo base64_encode('Form101-Check Box6');?>" class="vol_pet_spouse_why_district_another_reason" <?php echo isset($volPetData[base64_encode('Form101-Check Box6')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box6'), $volPetData, 'Other') : ''; ?> value="Other">
														<label for="">{{ __('I have another reason. Explain. (See 28 U.S.C. § 1408.)') }}</label>
													</div>
													<div class="input-group">
														<textarea name="<?php echo base64_encode('Form101-Debtor2.See 28 USC  1408 1_2');?>" cols="5" rows="5" class="form-control vol_pet_spouse_why_district_expain_reason"><?php echo $volPetData[base64_encode('Form101-Debtor2.See 28 USC  1408 1_2')] ?? ''; ?></textarea>
													</div>
												</div>
											</div>
										</div>

							<!-- Part 2 -->
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="part-form-title my-3">
										<span>{{ __('Part 2') }}</span>
										<h2 class="font-lg-18">{{ __('Tell the Court About Your Bankruptcy Case') }}</h2>
									</div>
								</div>
							</div>
							<div class="form-border">
								<div class="row">
									<div class="col-md-2">
										<div class="input-group">
											<strong>{{ __('7. The chapter of the Bankruptcy Code you are choosing to file under') }}</strong> </div>
												</div>
												<div class="col-md-10">
													<div class="input-group">
														<label for=""><i class="text-black text-bold"> {{ __('Check one. (For a brief description of each, see Notice Required by 11 U.S.C. § 342(b) for Individuals Filing for Bankruptcy (Form 2010)). Also, go to the top of page 1 and check the appropriate box.') }}</i></label>
													</div>
													<div class="checkbox-cust">
														<input name="<?php echo base64_encode('Form101-Check Box1');?>"  class="vol_pet_ques7_ch chapter7" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box1')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box1'), $volPetData, 'Chapter 7') : Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter7'); ?> value="Chapter 7">
														<label>{{ __('Chapter 7') }}</label>
													</div>
													<div class="checkbox-cust">
														<input name="<?php echo base64_encode('Form101-Check Box1');?>"  class="vol_pet_ques7_ch" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box1')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box1'), $volPetData, 'Chapter 11') : Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter11'); ?> value="Chapter 11">
														<label>{{ __('Chapter 11') }}</label>
													</div>
													<div class="checkbox-cust">
														<input name="<?php echo base64_encode('Form101-Check Box1');?>"  class="vol_pet_ques7_ch" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box1')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box1'), $volPetData, 'Chapter 12') : Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter12'); ?> value="">
														<label>{{ __('Chapter 12') }}</label>
													</div>
													<div class="checkbox-cust">
														<input name="<?php echo base64_encode('Form101-Check Box1');?>"  class="vol_pet_ques7_ch chapter13" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box1')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box1'), $volPetData, 'Chapter 13') : Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter13'); ?> value="Chapter 13">
														<label>{{ __('Chapter 13') }}</label>
													</div>
												</div>
											</div>
										</div>


							<div class="form-border">
								<div class="row">
									<div class="col-md-2">
										<div class="input-group">
											<strong>{{ __('8. How you will pay the fee') }}</strong>
										</div>
									</div>
									<div class="col-md-10">
										<div class="checkbox-cust font-lg-14">
                                            <input name="<?php echo base64_encode('Form101-Check Box7');?>" checked="checked" type="checkbox" value="Pay entirely" <?php echo isset($volPetData[base64_encode('Form101-Check Box7')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box7'), $volPetData, 'Pay entirely') : '';?>>
											<label><strong>{{ __('I will pay the entire fee when I file my petition.') }}</strong>
												{{ __('Please check with the clerk’s office in your local court for more details about how you may pay. Typically, if you are paying the fee yourself, you may pay with cash, cashier’s check, or money order. If your attorney is submitting your payment on your behalf, your attorney may pay with a credit card or check with a pre-printed address.') }}</label>
										</div>
										<div class="checkbox-cust my-3 font-lg-14">
                                            <input name="<?php echo base64_encode('Form101-Check Box7');?>"  type="checkbox" value="Pay in installments" <?php echo isset($volPetData[base64_encode('Form101-Check Box7')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box7'), $volPetData, 'Pay in installments') : '';?>>
											<label><strong>{{ __('I need to pay the fee in installments.') }}</strong>{{ __('If you choose this option,sign and attach the') }}
												<i class="text-black text-bold">{{ __('Application for Individuals to Pay The Filing Fee in Installments') }} </i>{{ __('(Official Form 103A).') }}</label>
													</div>
													<div class="checkbox-cust font-lg-14">
														<input type="checkbox">
														<label><strong>{{ __('I request that my fee be waived') }} </strong> {{ __('(You may request this option only if you are filing for Chapter 7. By law, a judge may, but is not required to, waive your fee, and may do so only if your income is less than 150% of the official poverty line that applies to your family size and you are unable to pay the fee in installments). If you choose this option, you must fill out the Application to Have the Chapter 7 Filing Fee Waived (Official Form 103B) and file it with your petition.') }}</label>
													</div>
												</div>
											</div>
										</div>
										<?php
                            $BasicInfo_PartC = $basic_info['BasicInfo_PartC'];
                        $final_BasicInfo_PartC = [];
                        if (!empty($BasicInfo_PartC)) {
                            foreach ($BasicInfo_PartC->toArray() as $k => $v) {
                                if (is_array($v)) {
                                    $data[$k] = $v;
                                    if (!empty($data[$k])) {
                                        foreach ($data[$k] as $kkey => $vv) {
                                            $final_BasicInfo_PartC[$kkey] = $vv;
                                        }
                                    }
                                } else {
                                    $final_BasicInfo_PartC[$k] = $v;
                                }
                            }
                        }


                        $pending = [];
                        if (!empty($BasicInfo_PartC)) {
                            foreach ($BasicInfo_PartC->toArray() as $k => $v) {
                                if (is_array($v)) {
                                    $adata[$k] = $v;
                                    $pending[$k] = $adata[$k];
                                } else {
                                    $pending[$k] = $v;
                                }
                            }
                        }


                        // for($j=0;$j<count($final_BasicInfo_PartC);$j++){
                        ?>
											<div class="form-border">
												<div class="row mb-3">
													<div class="col-md-2">
														<div class="input-group"> <strong>{{ __('9. Have you filed for bankruptcy within the last 8 years?') }}</strong>
										</div>
									</div>

									<div class="col-md-10">

										<div class="checkbox-cust font-lg-14">
											<input class="prior_case_9_no" name="<?php echo base64_encode('Form101-Check Box8');?>" value="No" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box8')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box8'), $volPetData, 'No') : Helper::validate_key_toggle('filed_bankruptcy_case_last_8years', $BasicInfo_PartC, 0);?>>
											<label>{{ __('No') }}</label>
										</div>
										<div class="checkbox-cust font-lg-14">
											<input class="prior_case_9_yes" name="<?php echo base64_encode('Form101-Check Box8');?>" value="Yes" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box8')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box8'), $volPetData, 'Yes') : Helper::validate_key_toggle('filed_bankruptcy_case_last_8years', $BasicInfo_PartC, 1);?>>
											<label>{{ __('Yes') }}</label>
										</div>
										<?php if (isset($pending['case_filed_state']) && is_array($pending['case_filed_state'])) {  ?>
											<?php $lastyrIndex = 1; ?>
										<?php for ($j = 0;$j < count($pending['case_filed_state']);$j++) {
										    $district = 'Form101-District';
										    $when = 'Form101-When';
										    $caseNumber = 'Form101-Case number';

										    if ($lastyrIndex > 1) {
										        $district = $district.'_'.$lastyrIndex;
										        $when = $when.'_'.$lastyrIndex;
										        $caseNumber = $caseNumber.'_'.$lastyrIndex;
										    }
										    ?>
										<div class="row">
											<div class="col-md-8">
												<div class="input-group">
													<label>{{ __('In which district of which state was the case filed?') }}</label>
													<input name="<?php echo base64_encode($district);?>" type="text" value="<?php echo $volPetData[base64_encode($district)] ?? Helper::validate_key_loop_value('case_filed_state', $pending, $j);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-4">
												<div class="input-group">
													<label>{{ __('When') }}</label>
													<input name="<?php echo base64_encode($when);?>" type="text" value="<?php echo $volPetData[base64_encode($when)] ?? Helper::validate_key_loop_value('date_filed', $pending, $j);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-4">
												<div class="input-group">
													<label>{{ __('Case number') }}</label>
													<input name="<?php echo base64_encode($caseNumber);?>" type="text" value="<?php echo $volPetData[base64_encode($caseNumber)] ?? Helper::validate_key_loop_value('case_number', $pending, $j);?>" class="form-control">
												</div>
											</div>

										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="input-group">
													{{ __('Was the case dismissed in the last year?') }}
												</div>
											</div>
											<div class="col-md-12">
												<div class="checkbox-cust font-lg-14">
													<input type="checkbox" name ="<?php echo base64_encode('Form101-Check Box07'); ?>" <?php echo isset($volPetData[base64_encode('Form101-Check Box07')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box07'), $volPetData, 'No') : Helper::validate_key_loop_toggle('is_case_dismissed', $pending, 0, $j); ?> value="No">
													<label>{{ __('No') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14">
													<input type="checkbox" name ="<?php echo base64_encode('Form101-Check Box07'); ?>" <?php echo isset($volPetData[base64_encode('Form101-Check Box07')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box07'), $volPetData, 'Yes') : Helper::validate_key_loop_toggle('is_case_dismissed', $pending, 1, $j); ?> value="Yes">
													<label>{{ __('Yes') }}</label>
												</div>
											</div>


										</div>
										<?php
                        $lastyrIndex++;
										}
										}
                        ?>



									</div>
								</div>

							</div>



											<div class="form-border">
												<div class="row mb-3">
													<div class="col-md-2">
														<div class="input-group"> <strong>{{ __('10. Are any bankruptcy cases pending or being filed by a spouse who is not filing this case with you, or by a business partner, or by an affiliate?') }}</strong>
										</div>
									</div>
									<div class="col-md-10">
										<div class="checkbox-cust font-lg-14">
											<input class="prior_case_10_no" name="<?php echo base64_encode('Form101-Check Box9');?>" value="No" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box9')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box9'), $volPetData, 'No') : Helper::validate_key_toggle('any_bankruptcy_cases_pending', $final_BasicInfo_PartC, 0);?>>
											<label>{{ __('No') }}</label>
										</div>
										<div class="checkbox-cust font-lg-14">
											<input class="prior_case_10_yes" name="<?php echo base64_encode('Form101-Check Box9');?>" value="Yes"  type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box9')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box9'), $volPetData, 'Yes') : Helper::validate_key_toggle('any_bankruptcy_cases_pending', $BasicInfo_PartC, 1);?>>
											<label>{{ __('Yes') }}</label>
										</div>

										<?php if (!empty($final_BasicInfo_PartC['debator_name']) && is_array($final_BasicInfo_PartC['debator_name'])) {
										    $lastyrIndex = 1;
										    for ($i = 0; $i < count($final_BasicInfo_PartC['debator_name']); $i++) {
										        $debtor = 'Form101-Debtor';
										        $relationshipToYou = 'Form101-Relationship to you';
										        $district = 'Form101-District_4';
										        $when = 'Form101-When_4';
										        $caseNumber = 'Form101-Case number if known_3';
										        if ($lastyrIndex > 1 && $lastyrIndex < 3) {
										            $debtor = 'Form101-Debtor_'.$lastyrIndex;
										            $relationshipToYou = 'Form101-Relationship to you_'.$lastyrIndex;
										            $district = 'Form101-District_5';
										            $when = 'Form101-When_5';
										            $caseNumber = 'Form101-Case number if known_4';
										        }
										        if ($lastyrIndex > 2) {
										            $debtor = '';
										            $relationshipToYou = '';
										            $district = '';
										            $when = '';
										            $caseNumber = '';
										        }
										        ?>
                                                <div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('Name of debtor') }}</label>
													<input name="<?php echo base64_encode($debtor);?>" type="text" value="<?php echo $volPetData[base64_encode($debtor)] ?? Helper::validate_key_loop_value('debator_name', $final_BasicInfo_PartC, $i);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('Relationship to you') }}</label>
													<input name="<?php echo base64_encode($relationshipToYou);?>" type="text" value="<?php echo $volPetData[base64_encode($relationshipToYou)] ?? Helper::validate_key_loop_value('your_relationship', $final_BasicInfo_PartC, $i);?>" class="form-control">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="input-group">
													<label>{{ __('District') }}</label>
													<input name="<?php echo base64_encode($district);?>" type="text" value="<?php echo $volPetData[base64_encode($district)] ?? Helper::validate_key_loop_value('district', $final_BasicInfo_PartC, $i);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<label>{{ __('When') }}</label>
													<input name="<?php echo base64_encode($when);?>" type="text" value="<?php echo $volPetData[base64_encode($when)] ?? Helper::validate_key_loop_value('partner_date_filed', $final_BasicInfo_PartC, $i);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label> {{ __('Case Number if (known):') }}</label>
													<input name="<?php echo base64_encode($caseNumber);?>" type="text" value="<?php echo $volPetData[base64_encode($caseNumber)] ?? Helper::validate_key_loop_value('partner_case_number', $final_BasicInfo_PartC, $i);?>" class="form-control">
												</div>
											</div>
										</div>

										<?php $lastyrIndex++;
										    }
										} ?>

									</div>
								</div>
								</div>
								<div class="form-border">
							<div class="row mb-3">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('11. Do you rent your residence?') }}</strong> </div>
								</div>
								<div class="col-md-10">
									<div class="col-md-10">
										<div class="checkbox-cust font-lg-14">
											<input name="<?php echo base64_encode('Form101-Check Box10');?>" value="No" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box10')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box10'), $volPetData, 'No') : Helper::validate_key_toggle('rented_residence', $BasicInfo_PartRest1012, 0);?>>
											<label>{{ __('No.') }} &nbsp;&nbsp;&nbsp;&nbsp;{{ __('Go to line 12') }}</label>
										</div>
										<div class="checkbox-cust font-lg-14">
											<input name="<?php echo base64_encode('Form101-Check Box10');?>" value="Yes" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box10')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box10'), $volPetData, 'Yes') : Helper::validate_key_toggle('rented_residence', $BasicInfo_PartRest1012, 1);?>>
											<label>{{ __('Yes.') }} &nbsp;&nbsp;&nbsp;{{ __('Has your Landloard obtained an eviction judgment againest you?') }}</label>
										</div>
										<div class="mt-10"></div>
										<div class="row">
										<div class="col-md-1">

										</div>
											<div class="col-md-11 ml-40">
											<div class="checkbox-cust font-lg-14">
												<input name="<?php echo base64_encode('Form101-Check Box11');?>" value="No" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box11')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box11'), $volPetData, 'No') : Helper::validate_key_toggle('rented_residence', $BasicInfo_PartRest1012, 0);?> <?php echo isset($volPetData[base64_encode('Form101-Check Box11')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box11'), $volPetData, 0) : Helper::validate_key_toggle('eviction_pending', $BasicInfo_PartRest1012, 0);?>>
												<label>{{ __('No.') }} &nbsp;&nbsp;&nbsp;{{ __('Go to line 12') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14 d-flex">
													<input name="<?php echo base64_encode('Form101-Check Box11');?>" value="Yes" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box11')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box11'), $volPetData, 'Yes') : Helper::validate_key_toggle('eviction_pending', $BasicInfo_PartRest1012, 1);?>>
													<label>{{ __('Yes.') }} &nbsp;&nbsp;{{ __('Fill out initial Statement About an Eviction Judgment Againest You (Form 101A) and file it as part of this bankruptcy petition.') }}</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
							<!-- Part 3 -->
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="part-form-title my-3">
										<span>{{ __('Part 3') }}</span>
										<h2 class="font-lg-18">{{ __('Report About Any Businesses You Own as a Sole Proprietor') }}
										</h2>
									</div>
								</div>
							</div>

							<div class="form-border">
								<div class="row">
									<div class="col-md-2">
										<div class="input-group">
											<strong>{{ __('12. Are you a sole proprietor of any full- or part-time business?') }}</strong>

										<p>{{ __('A sole proprietorship is a business you operate as an individual, and is not a separate legal entity such as a corporation, partnership, or LLC. If you have more than one sole proprietorship, use a separate sheet and attach it to this petition.') }} </p>

									</div>
								</div>

									<div class="col-md-10">
										<div class="checkbox-cust font-lg-14">
											<input name="<?php echo base64_encode('Form101-Check Box12');?>" value="No" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box12')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box12'), $volPetData, 'No') : Helper::validate_key_toggle('proprietor_status', $BasicInfo_PartRest1012, 0);?>>
											<label>{{ __('No') }}</label>
										</div>
										<div class="checkbox-cust font-lg-14">
											<input name="<?php echo base64_encode('Form101-Check Box12');?>" value="Yes" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box12')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box12'), $volPetData, 'Yes') : Helper::validate_key_toggle('proprietor_status', $BasicInfo_PartRest1012, 1);?>>
											<label>{{ __('Yes') }}</label>
										</div>
										@if(Helper::key_display('proprietor_status',$BasicInfo_PartRest1012) == 'Yes')
										<?php
										$business = $basic_info['BasicInfo_PartRest'];
                        $busin = Helper::validate_key_value('any_proprietor_status_data', $business);
                        $data = json_decode($busin, 1);
                        $select = Helper::validate_key_value('describe_of_business', $data);
                        $array_checkbox = !empty($select) && is_array($select) ? current($select) : '';
                        ?>
										<div class="row">
											<div class="col-md-12">
												<div class="input-group">
													<label>{{ __('Name of business, if any') }}</label>
													<input name="<?php echo base64_encode('Form101-Name of business if any');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Name of business if any')] ?? Helper::validate_key_value('name_of_business', $data);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-group">
													<label>{{ __('Street') }} </label>
													<input name="<?php echo base64_encode('Form101-Business Street address');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Business Street address')] ?? Helper::validate_key_value('number_of_business', $data);?>"  class="form-control">
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-group">
													<label>{{ __('Address 2') }}</label>
													<input name="<?php echo base64_encode('Form101-Business Street address2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Business Street address2')] ?? Helper::validate_key_value('street_of_business', $data);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('City') }}</label>
													<input name="<?php echo base64_encode('Form101-Business City');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Business City')] ?? Helper::validate_key_value('city_of_business', $data);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
														<div class="input-group">
															<label>{{ __('State') }}</label>
															<input name="<?php echo base64_encode('Form101-Business State');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Business State')] ?? Helper::validate_key_value('state_of_business', $data);?>" class="form-control">
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group">
															<label>{{ __('ZIP Code') }}</label>
															<input name="<?php echo base64_encode('Form101-ZIP Code_5');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-ZIP Code_5')] ?? Helper::validate_key_value('zip_of_business', $data);?>" class="form-control">
														</div>
													</div>
												</div>
											</div>
										</div>
										@endif
										@if(Helper::key_display('proprietor_status',$BasicInfo_PartRest1012) == 'Yes')
										
										
									<div class="col-md-12">
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Check Box13');?>" value="Health Care Business" <?php if (isset($volPetData[base64_encode('Form101-Check Box13')]) && !empty($volPetData[base64_encode('Form101-Check Box13')]) && $volPetData[base64_encode('Form101-Check Box13')] == "Health Care Business") {
											    echo "checked";
											} elseif ('health_care_business' == $array_checkbox) {
											    echo "checked";
											} ?> type="radio">
											<label>{{ __('Health Care Business (as defined in 11 U.S.C. § 101(27A))') }}</label>
										</div>
									</div>
									<div class="col-md-12">
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Check Box13');?>" value="Single asset real estate"  <?php if (isset($volPetData[base64_encode('Form101-Check Box13')]) && !empty($volPetData[base64_encode('Form101-Check Box13')]) && $volPetData[base64_encode('Form101-Check Box13')] == "Single asset real estate") {
											    echo "checked";
											} elseif ('single_asset_real_estate' == $array_checkbox) {
											    echo "checked";
											} ?>  type="radio">
											<label> {{ __('Single Asset Real Estate (as defined in 11 U.S.C. § 101(51B))') }}</label>
										</div>
									</div>
									<div class="col-md-12">
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Check Box13');?>" value="Stockbroker"  <?php if (isset($volPetData[base64_encode('Form101-Check Box13')]) && !empty($volPetData[base64_encode('Form101-Check Box13')]) && $volPetData[base64_encode('Form101-Check Box13')] == "Stockbroker") {
											    echo "checked";
											} elseif ('stockbroker' == $array_checkbox) {
											    echo "checked";
											} ?> type="radio">
											<label>{{ __('Stockbroker (as defined in 11 U.S.C. § 101(53A))') }}</label>
										</div>
									</div>
									<div class="col-md-12">
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Check Box13');?>" value="Commodity Broker"  <?php if (isset($volPetData[base64_encode('Form101-Check Box13')]) && !empty($volPetData[base64_encode('Form101-Check Box13')]) && $volPetData[base64_encode('Form101-Check Box13')] == "Commodity Broker") {
											    echo "checked";
											} elseif ('commodity_broker' == $array_checkbox) {
											    echo "checked";
											} ?> type="radio">
											<label>{{ __('Commodity Broker (as defined in 11 U.S.C. § 101(6))') }}</label>
										</div>
									</div>
									<div class="col-md-12">
										<div class="input-group">
											<input name="<?php echo base64_encode('Form101-Check Box13');?>" value="None of above"  <?php if (isset($volPetData[base64_encode('Form101-Check Box13')]) && !empty($volPetData[base64_encode('Form101-Check Box13')]) && $volPetData[base64_encode('Form101-Check Box13')] == "None of above") {
											    echo "checked";
											} elseif ('none' == $array_checkbox) {
											    echo "checked";
											} ?>  type="radio">
											<label>{{ __('None of the above') }}</label>
										</div>
									</div>
								</div>
								@endif
								</div>
							</div>
						</div>
						<div class="form-border">
							<div class="row">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('13. Are you filing under Chapter 11 of the Bankruptcy Code, and are you a small business debtor or a debtor as defined by 11 U.S. C. § 1182(1)?') }}</strong>
										<p>{{ __('For a definition of small business debtor, see 11 U.S.C. § 101(51D).') }} </p>
									</div>
								</div>
								<div class="col-md-10">
									<p><i class="text-bold">{{ __('If you are filing under Chapter 11, the court must know whether you are a small business debtor or a debtor choosing to proceed under Subchapter V so that it can set appropriate deadlines.') }}</i> {{ __('If you indicate that you are a small business debtor or you are choosing to proceed under Subchapter V, you must attach your most recent balance sheet, statement of operations, cash-flow statement, and federal income tax return or if any of these documents do not exist, follow the procedure in 11 U.S.C. § 1116(1)(B)') }}</p>
									<div class="row">
										<div class="col-md-12">
										<div class="input-group d-flex">
										<div class="col-md-1"><input checked="checked" name="<?php echo base64_encode('Form101-Check Box14');?>" value="Not filing under Chapter 11" type="radio"></div>
										<div class="col-md-11"><label>{{ __('No.') }}   &nbsp;&nbsp;{{ __('I am not filing under Chapter 11.') }}</label>
										</div>
										</div>
										<div class="input-group d-flex">
										<div class="col-md-1"><input name="<?php echo base64_encode('Form101-Check Box14');?>" value="Filing under Chapter 11 but not small business" type="radio"></div>
										<div class="col-md-11"><label>{{ __('No.') }} &nbsp;&nbsp;{{ __('I am filing under Chapter 11, but I am NOT a small business debtor according to the definition in the Bankruptcy Code.') }}</label>
										</div>	</div>

										<div class="input-group d-flex">
										<div class="col-md-1"><input name="<?php echo base64_encode('Form101-Check Box14');?>" value="Yes filling under chapter" type="radio"></div>
										<div class="col-md-11"><label>{{ __('Yes.') }} &nbsp;&nbsp;{{ __('I am filing under Chapter 11, I am a small business debtor according to the definition in the Bankruptcy Code, and I do not choose to proceed under Subchapter V of Chapter 11.') }}</label>
										</div></div>

										<div class="input-group d-flex">
										<div class="col-md-1"><input name="<?php echo base64_encode('Form101-Check Box14');?>" value="Yes filing under Chapter 11 but not small business" type="radio"></div>
										<div class="col-md-11"><label>{{ __('Yes.') }} &nbsp;&nbsp;{{ __('I am filing under Chapter 11, I am a debtor according to the definition in § 1182(1) of the Bankruptcy Code, and I choose to proceed under Subchapter V of Chapter 11.') }}</label>
										</div></div>


										</div>
										</div>


									</div>
								</div>
							</div>





							<!-- Part 4 -->
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="part-form-title my-3">
										<span>{{ __('Part 4') }}</span>
										<h2 class="font-lg-18">{{ __('Report if You Own or Have Any Hazardous Property or Any Property That Needs Immediate Attention') }}</h2> </div>
							</div>
						</div>
						<div class="form-border">
							<div class="row mb-3">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('14. Do you own or have any property that poses or is alleged to pose a threat of imminent and identifiable hazard to public health or safety? Or do you own any property that needs immediate attention?') }}</strong>
										<p>{{ __('For example, do you own perishable goods, or livestock that must be fed, or a building that needs urgent repairs?') }} </p>
									</div>
									</div>
									<div class="col-md-10">
										<div class="checkbox-cust font-lg-14">
											<input name="<?php echo base64_encode('Form101-Check Box15');?>" value="No" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box15')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box15'), $volPetData, 'No') : Helper::validate_key_toggle('hazardous_property', $BasicInfo_PartRest1012, 0);?>>
											<label>{{ __('No') }}</label>
										</div>
										<div class="checkbox-cust font-lg-14">
											<input name="<?php echo base64_encode('Form101-Check Box15');?>" value="Yes" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box15')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box15'), $volPetData, 'Yes') : Helper::validate_key_toggle('hazardous_property', $BasicInfo_PartRest1012, 1);?>>
											<label>{{ __('Yes') }}</label>
										</div>
										@if(Helper::key_display('hazardous_property',$BasicInfo_PartRest1012) == 'Yes')
										<div class="row">
											<div class="col-md-12">
												<div class="input-group">
														
												<?php
											            $BasicInfo_PartRest1012 = $basic_info['BasicInfo_PartRest'];
                        $hazardous_property_data = $BasicInfo_PartRest1012['hazardous_property_data'];
                        $hazardous_property_data = json_decode($hazardous_property_data, 1);
                        ?>

													<label>{{ __('What is the hazard?') }}</label>
													<input name="<?php echo base64_encode('Form101-What is the hazard1');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-What is the hazard1')] ?? Helper::validate_key_value('what_is_hazard', $hazardous_property_data);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-group">
													<label>{{ __('If immediate attention is needed, why is it needed?') }}</label>
													<input name="<?php echo base64_encode('Form101-If immediate attention is needed why is it needed1');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-If immediate attention is needed why is it needed1')] ?? Helper::validate_key_value('attention_needed', $hazardous_property_data);?>" class="form-control">
												</div>
											</div>

											<div class="col-md-12">
												<div class="row">



													<div class="col-md-12">
														<div class="input-group">
															<label>{{ __('Street') }}</label>
															<input name="<?php echo base64_encode('Form101-Street_6');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Street_6')] ?? Helper::validate_key_value('hazard_street_of_business', $hazardous_property_data);?>" class="form-control">
														</div>
														</div>
													</div>
												</div>

											<div class="col-md-6">
												<div class="input-group">
													<label>{{ __('City') }}</label>
													<input name="<?php echo base64_encode('Form101-City_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-City_2')] ?? Helper::validate_key_value('hazard_city_of_business', $hazardous_property_data);?>" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
														<div class="input-group">
															<label>{{ __('State') }}</label>
															<input name="<?php echo base64_encode('Form101-State_6');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-State_6')] ?? Helper::validate_key_value('hazard_state', $hazardous_property_data);?>" class="form-control">
														</div>
														</div>
													<div class="col-md-6">
														<div class="input-group">
															<label>{{ __('ZIP Code') }}</label>
															<input name="<?php echo base64_encode('Form101-ZIP Code_6');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-ZIP Code_6')] ?? Helper::validate_key_value('hazard_zip_of_business', $hazardous_property_data);?>" class="form-control">
														</div>

													</div>
												</div>
											</div>
										</div>
										@endif
									</div>
								</div>
								</div>

						<!-- Part 5 -->
						<div class="row align-items-center">
							<div class="col-md-12">
								<div class="part-form-title my-3"> <span>{{ __('Part 5') }}</span>
									<h2 class="font-lg-18">{{ __('Explain Your Efforts to Receive a Briefing About Credit Counseling') }}
										</h2> </div>
							</div>
						</div>
						<div class="form-border">
							<div class="row mb-3">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('15.Tell the court whether you have received a briefing about credit counseling') }}</strong>
											<p>{{ __('The law requires that you receive a briefing about credit
												counseling before you file for
												bankruptcy. You must
												truthfully check one of the
												following choices. If you
												cannot do so, you are not
												eligible to file.
												If you file anyway, the court
												can dismiss your case, you
												will lose whatever filing fee
												you paid, and your creditors
												can begin collection activities
												again') }}
											</p>
										</div>
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-6">
												<div class="col-md-12">
													<p class="column-heading text-center">{{ __('About Debtor 1:') }}</p>
													<p><i class="text-bold">{{ __('You must check one:') }}</i></p>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box16');?>" value="1"  type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box16')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box16'), $volPetData, '1') : 'checked';?>>
													<label><strong>{{ __('I received a briefing from an approved credit
															counseling agency within the 180 days before I
															filed this bankruptcy petition, and I received a
															certificate of completion.') }}</strong><br>
														{{ __('Attach a copy of the certificate and the payment
														plan, if any, that you developed with the agency') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box16');?>" value="2" type="radio"<?php echo isset($volPetData[base64_encode('Form101-Check Box16')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box16'), $volPetData, '2') : '';?>>
													<label><strong>{{ __('I received a briefing from an approved credit
															counseling agency within the 180 days before I
															filed this bankruptcy petition, but I do not have a
															certificate of completion.') }}</strong><br>
														{{ __('Within 14 days after you file this bankruptcy petition,
														you MUST file a copy of the certificate and payment
														plan, if any.') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box16');?>" value="On" type="radio"<?php echo isset($volPetData[base64_encode('Form101-Check Box16')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box16'), $volPetData, 'On') : '';?>>
													<label><strong> {{ __('certify that I asked for credit counseling
															services from an approved agency, but was
															unable to obtain those services during the 7
															days after I made my request, and exigent
															circumstances merit a 30-day temporary waiver
															of the requirement.') }}</strong><br>
														{{ __('To ask for a 30-day temporary waiver of the
														requirement, attach a separate sheet explaining
														what efforts you made to obtain the briefing, why
														you were unable to obtain it before you filed for
														bankruptcy, and what exigent circumstances
														required you to file this case.
														Your case may be dismissed if the court is
														dissatisfied with your reasons for not receiving a
														briefing before you filed for bankruptcy.
														If the court is satisfied with your reasons, you must
														still receive a briefing within 30 days after you file.
														You must file a certificate from the approved
														agency, along with a copy of the payment plan you
														developed, if any. If you do not do so, your case
														may be dismissed.
														Any extension of the 30-day deadline is granted
														only for cause and is limited to a maximum of 15
														days.') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box16');?>" value="4" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box16')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box16'), $volPetData, 4) : '';?>>
													<label class="mb-3"><strong> {{ __('I am not required to receive a
															briefing
															about
															credit counseling because of:') }}</strong>
														<div class="checkbox-cust font-lg-14 mb-3">
															<input name="<?php echo base64_encode('Form101-Check Box16A');?>" value="Incapacity" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box16A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box16A'), $volPetData, 'Incapacity') : '';?>>
															<label><strong> {{ __('Incapacity') }}</strong> &nbsp;{{ __('I have a
																mental
																illness or a
																mental
																deficiency that makes me
																incapable of realizing or making
																rational decisions about finances.') }}
															</label>
														</div>
														<div class="checkbox-cust font-lg-14 mb-3">
															<input name="<?php echo base64_encode('Form101-Check Box16A');?>" value="Disability" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box16A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box16A'), $volPetData, 'Disability') : '';?>>
															<label><strong> {{ __('Disability') }}</strong> &nbsp;{{ __('My physical
																disability causes me
																to be unable to participate in a
																briefing in person, by phone, or
																through the internet, even after I
																reasonably tried to do so.') }}
															</label>
														</div>
														<div class="checkbox-cust font-lg-14 mb-3">
															<input name="<?php echo base64_encode('Form101-Check Box16A');?>" value="Active duty" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box16A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box16A'), $volPetData, 'Active duty') : '';?>>
															<label><strong> {{ __('Active duty') }}</strong> &nbsp; {{ __('I am
																currently
																on active
																military
																duty in a military combat zone.') }}
															</label>
														</div>
														{{ __('If you believe you are not required to receive a
														briefing about credit counseling, you must file a
														motion for waiver of credit counseling with the court.') }}

													</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="col-md-12">
													<p class="column-heading text-center">{{ __('About Debtor 2 (Spouse
														Only in
														a
														Joint Case):') }}
													</p>
													<p><i class="text-bold">{{ __('You must check one:') }}</i></p>
												</div>

												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box17');?>" value="1"  type="radio"<?php echo isset($volPetData[base64_encode('Form101-Check Box17')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box17'), $volPetData, 1) : (!empty($spousename) ? 'checked' : '');?>>
													<label><strong>{{ __('I received a briefing from an approved credit
															counseling agency within the 180 days before I
															filed this bankruptcy petition, and I received a
															certificate of completion.') }}</strong><br>
														{{ __('Attach a copy of the certificate and the payment
														plan, if any, that you developed with the agency') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box17');?>" value="2" type="radio"<?php echo isset($volPetData[base64_encode('Form101-Check Box17')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box17'), $volPetData, 2) : '';?>>
													<label><strong>{{ __('I received a briefing from an approved credit
															counseling agency within the 180 days before I
															filed this bankruptcy petition, but I do not have a
															certificate of completion.') }}</strong><br>
														{{ __('Within 14 days after you file this bankruptcy petition,
														you MUST file a copy of the certificate and payment
														plan, if any.') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box17');?>" value="On" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box17')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box17'), $volPetData, 'On') : '';?>>
													<label><strong> {{ __('certify that I asked for credit counseling
															services from an approved agency, but was
															unable to obtain those services during the 7
															days after I made my request, and exigent
															circumstances merit a 30-day temporary waiver
															of the requirement.') }}</strong><br>
														{{ __('To ask for a 30-day temporary waiver of the
														requirement, attach a separate sheet explaining
														what efforts you made to obtain the briefing, why
														you were unable to obtain it before you filed for
														bankruptcy, and what exigent circumstances
														required you to file this case.
														Your case may be dismissed if the court is
														dissatisfied with your reasons for not receiving a
														briefing before you filed for bankruptcy.
														If the court is satisfied with your reasons, you must
														still receive a briefing within 30 days after you file.
														You must file a certificate from the approved
														agency, along with a copy of the payment plan you
														developed, if any. If you do not do so, your case
														may be dismissed.
														Any extension of the 30-day deadline is granted
														only for cause and is limited to a maximum of 15
														days.') }}</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box17');?>" value="4" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box17')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box17'), $volPetData, 4) : '';?>>
													<label class="mb-3"><strong> {{ __('I am not required to receive a
															briefing
															about
															credit counseling because of:') }}</strong>
														<div class="checkbox-cust font-lg-14 mb-3">
															<input name="<?php echo base64_encode('Form101-Check Box17A');?>" value="Incapacity" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box17A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box17A'), $volPetData, 'Incapacity') : '';?>>
															<label><strong> {{ __('Incapacity') }}</strong> &nbsp;{{ __('I have a
																mental
																illness or a
																mental
																deficiency that makes me
																incapable of realizing or making
																rational decisions about finances.') }}
															</label>
														</div>
														<div class="checkbox-cust font-lg-14 mb-3">
															<input name="<?php echo base64_encode('Form101-Check Box17A');?>" value="Disability" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box17A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box17A'), $volPetData, 'Disability') : '';?>>
															<label><strong> {{ __('Disability') }}</strong> &nbsp;{{ __('My physical
																disability causes me
																to be unable to participate in a
																briefing in person, by phone, or
																through the internet, even after I
																reasonably tried to do so.') }}
															</label>
														</div>
														<div class="checkbox-cust font-lg-14 mb-3">
															<input name="<?php echo base64_encode('Form101-Check Box17A');?>" value="Active duty" type="radio" <?php echo isset($volPetData[base64_encode('Form101-Check Box17A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box17A'), $volPetData, 'Active duty') : '';?>>
															<label><strong> {{ __('Active duty') }}</strong> &nbsp; {{ __('I am
																currently
																on active
																military
																duty in a military combat zone.') }}
															</label>
														</div>
														{{ __('If you believe you are not required to receive a
														briefing about credit counseling, you must file a
														motion for waiver of credit counseling with the court.') }}

													</label>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>


	<!-- Part 6 -->
						<div class="row align-items-center">
							<div class="col-md-12">
								<div class="part-form-title my-3"> <span>{{ __('Part 6') }}</span>
									<h2 class="font-lg-18">{{ __('Answer These Questions for Reporting Purposes') }}</h2> </div>
							</div>
						</div>
						<div class="form-border">
							<div class="row mb-3">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('16. What kind of debts do
												you have?') }}</strong> </div>
								</div>
								<div class="col-md-10">
									<div class="row">
											<div class="col-md-12">
												<div class="checkbox-cust font-lg-14 mb-3">
													<label class=" mb-3"><strong>{{ __('16a. Are your debts primarily
															consumer
															debts?') }} </strong>
														{{ __('Consumer debts are defined in 11 U.S.C. § as “incurred by an
														individual
														primarily
														for a personal, family, or household purpose.”') }}
													</label><br>
													<div class="checkbox-cust font-lg-14">

														<input name="<?php echo base64_encode('Form101-Check Box18');?>" <?php echo isset($volPetData[base64_encode('Form101-Check Box18')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box18'), $volPetData, 'No') : Helper::validate_key_toggle('debtbtextvalue', $savedData, 0); ?>  class="consumer_no" value="No" type="checkbox" >
														<label class=" mb-3">{{ __('No') }}</label>
													</div>
													<div class="checkbox-cust font-lg-14">
														<input  name="<?php echo base64_encode('Form101-Check Box18');?>" <?php echo isset($volPetData[base64_encode('Form101-Check Box18')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box18'), $volPetData, 'Yes') : Helper::validate_key_toggle('debtbtextvalue', $savedData, 1); ?> class="consumer_yes" value="Yes" type="checkbox" >
														<label class=" mb-3">{{ __('Yes') }}</label>
													</div>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<label class=" mb-3"><strong>{{ __('16b. Are your debts primarily
															business
															debts?') }}</strong>
														{{ __('Business debts are debts that you incurred to obtain
														money for a business or investment or through the operation
														of
														the
														business or
														investment.
														101(8)') }}</label><br>
														<div class="checkbox-cust font-lg-14">
														<input name="<?php echo base64_encode('Form101-Check Box19');?>" <?php echo isset($volPetData[base64_encode('Form101-Check Box19')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box19'), $volPetData, 'No') : Helper::validate_key_toggle('debtbtextvalue', $savedData, 0); ?> class="business_no" value="No" type="checkbox">
														<label class=" mb-3">{{ __('No') }}</label>
													</div>
													<div class="checkbox-cust font-lg-14">
														<input name="<?php echo base64_encode('Form101-Check Box19');?>" <?php echo isset($volPetData[base64_encode('Form101-Check Box19')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box19'), $volPetData, 'Yes') : Helper::validate_key_toggle('debtbtextvalue', $savedData, 1); ?> class="business_yes" value="Yes" type="checkbox">
														<label class=" mb-3">{{ __('Yes') }}</label>
													</div>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<label class=" mb-3"><strong>{{ __('16c.') }}</strong> {{ __('State the type of
														debts
														you
														owe that are
														not
														consumer debts or
														business debts.') }}</label><br>
													<div class="input-group">
														<input name="<?php echo base64_encode('Form101-16c State the type of debts you owe that are not consumer debts or business debts');?>"  type="text" value="<?php if (Helper::validate_key_value('debtbtextvalue', $savedData) != 1) {
														    echo  $volPetData[base64_encode('Form101-16c State the type of debts you owe that are not consumer debts or business debts')] ?? "Trade Debts";
														} ?>" class="form-control">
													</div>
												</div>


											</div>
										</div>
									</div>
								</div>
							</div>


						
						
						<div class="form-border">
							<div class="row mb-3">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('17. Are you filing under
												Chapter 7?') }}<br><br>
												{{ __('Do you estimate that after
												any exempt property is
												excluded and
												administrative expenses
												are paid that funds will be
												available for distribution
												to unsecured creditors?') }}</strong>
										</div>
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-12">

												<div class="checkbox-cust font-lg-14 mb-3">
													<div class="checkbox-cust font-lg-14">
														<input name="<?php echo base64_encode('Form101-Check Box20');?>" value="No" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box20')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box20'), $volPetData, 'No') : '';?>><label class=" mb-3">{{ __('No. I am not
															filing
															under Chapter 7.
															Go to line 18.') }}
														</label>
													</div>
													<div class="checkbox-cust font-lg-14">
														<input name="<?php echo base64_encode('Form101-Check Box20');?>" value="Yes" type="checkbox" checked <?php echo isset($volPetData[base64_encode('Form101-Check Box20')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box20'), $volPetData, 'Yes') : '';?>>
														<label class=" mb-3">{{ __('Yes. I am filing under Chapter 7. Do
															you
															estimate that
															after any exempt property is excluded and
															administrative expenses are paid that funds will be
															available to
															distribute
															to unsecured creditors?') }}
														</label>
														<div class="checkbox-cust font-lg-14">
															<input name="<?php echo base64_encode('Form101-Check Box20A');?>" value="No" type="checkbox" checked <?php echo isset($volPetData[base64_encode('Form101-Check Box20A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box20A'), $volPetData, 'No') : '';?>><label class=" mb-3">{{ __('No') }}
															</label>
														</div>
														<div class="checkbox-cust font-lg-14">
															<input name="<?php echo base64_encode('Form101-Check Box20A');?>" value="Yes" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box20A')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box20A'), $volPetData, 'Yes') : '';?>><label class=" mb-3">{{ __('Yes') }}
															</label>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						<div class="form-border">
							<div class="row mb-3">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('18. How many creditors do
												you estimate that you
												owe?') }}</strong> </div>
								</div>
									<div class="col-md-10">
										<div class="row">

											<div class="col-md-4">
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="1-49" <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '1-49') : (($totalCreditor >= 1 && $totalCreditor <= 49) ? "checked" : ''); ?> type="checkbox"><label>{{ __('1-49') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="50-99" <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '50-99') : (($totalCreditor >= 50 && $totalCreditor <= 99) ? "checked" : ''); ?> type="checkbox" ><label>
														{{ __('50-99') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="100-199" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '100-199') : (($totalCreditor >= 100 && $totalCreditor <= 199) ? "checked" : ''); ?> ><label>
														{{ __('100-199') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="200-999" type="checkbox"  <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '200-999') : (($totalCreditor >= 200 && $totalCreditor <= 999) ? "checked" : ''); ?>><label>
														{{ __('200-999') }}
													</label>
												</div>

											</div>
											<div class="col-md-4">
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="1000-5000" type="checkbox"  <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '1000-5000') : (($totalCreditor >= 1000 && $totalCreditor <= 5000) ? "checked" : ''); ?>><label>{{ __('1,000-5,000') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="5001-10000" type="checkbox"  <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '5001-10000') : (($totalCreditor >= 5001 && $totalCreditor <= 10000) ? "checked" : ''); ?>><label>
														{{ __('5,001-10,000') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="10001-25000" type="checkbox"  <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '10001-25000') : (($totalCreditor >= 10001 && $totalCreditor <= 25000) ? "checked" : ''); ?>><label>
														{{ __('10,001-25,000') }}
													</label>
												</div>
											</div>
											<div class="col-md-4">
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="25001-50000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '25001-50000') : (($totalCreditor >= 25001 && $totalCreditor <= 50000) ? "checked" : ''); ?>><label>{{ __('25,001-50,000') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="50001-100000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, '50001-100000') : (($totalCreditor >= 50001 && $totalCreditor <= 100000) ? "checked" : ''); ?>><label>
														{{ __('50,001-100,000') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box21');?>" value="More than 100000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box21')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box21'), $volPetData, 'More than 100000') : (($totalCreditor >= 100001 && $totalCreditor <= 99999999999) ? "checked" : ''); ?>><label>
														{{ __('More than 100,000') }}
													</label>
												</div>
											</div>

										</div>

									</div>

								</div>
						</div>
						<div class="form-border">
							<div class="row mb-3">
								<div class="col-md-2">
									<div class="input-group"> <strong>{{ __('19. How much do you
												estimate your assets to
												be worth?') }}</strong> </div>
								</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-4">
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="0-50000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '0-50000') : (($totalAssetsYouOwn > 0 && $totalAssetsYouOwn <= 50000) ? "checked" : '');?>><label>{{ __('$0-$50,000') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="50001-100000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '50001-100000') : (($totalAssetsYouOwn > 50001 && $totalAssetsYouOwn <= 100000) ? "checked" : '');?>><label>
														{{ __('$50,001-$100,000') }}

													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="100001-500000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '100001-500000') : (($totalAssetsYouOwn > 100001 && $totalAssetsYouOwn <= 500000) ? "checked" : '');?>><label>
														{{ __('$100,001-$500,000') }}

													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="500001-1000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '500001-1000000') : (($totalAssetsYouOwn > 500001 && $totalAssetsYouOwn <= 1000000) ? "checked" : '');?>><label>
														{{ __('$500,001-$1 million') }}
													</label>
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="1000001-10000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '1000001-10000000') : (($totalAssetsYouOwn > 1000001 && $totalAssetsYouOwn <= 10000000) ? "checked" : '');?>><label>{{ __('$1,000,001-$10 million') }}

													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="10000001-50000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '10000001-50000000') : (($totalAssetsYouOwn > 10000001 && $totalAssetsYouOwn <= 50000000) ? "checked" : '');?>>
													<label>
														{{ __('$10,000,001-$50 million') }}

													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="50000001-100000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '50000001-100000000') : (($totalAssetsYouOwn > 50000001 && $totalAssetsYouOwn <= 100000000) ? "checked" : '');?>><label>
														{{ __('$50,000,001-$100 million') }}

													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="100000000-500000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '100000000-500000000') : (($totalAssetsYouOwn > 100000000 && $totalAssetsYouOwn <= 500000000) ? "checked" : '');?>><label>
														{{ __('$100,000,001-$500 million') }}

													</label>
												</div>
											</div>
											<div class="col-md-4">
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="500000001-1000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '500000001-1000000000') : (($totalAssetsYouOwn > 500000001 && $totalAssetsYouOwn <= 1000000000) ? "checked" : '');?>><label>{{ __('$500,000,001-$1 billion') }}

													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="1000000001-10000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '1000000001-10000000000') : (($totalAssetsYouOwn > 1000000001 && $totalAssetsYouOwn <= 10000000000) ? "checked" : '');?>><label>
														{{ __('$1,000,000,001-$10 billion') }}

													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="10000000001-50000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, '10000000001-50000000000') : (($totalAssetsYouOwn > 10000000001 && $totalAssetsYouOwn <= 50000000000) ? "checked" : '');?>><label>
														{{ __('$10,000,000,001-$50 billion') }}
													</label>
												</div>
												<div class="checkbox-cust font-lg-14 mb-3">
													<input name="<?php echo base64_encode('Form101-Check Box22');?>" class="liabilities" value="More than 50000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box22')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box22'), $volPetData, 'More than 50000000000') : (($totalAssetsYouOwn > 50000000000 && $totalAssetsYouOwn <= 9999999999999999) ? "checked" : '');?>><label>
														{{ __('More than $50 billion') }}
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-border ">
								<div class="row">
									<div class="col-md-2">
										<div class="input-group">
											<strong>{{ __('20. How much do you
												estimate your liabilities
												to be?') }}</strong>
										</div>
									</div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="0-50000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '0-50000') : '';?>><label>{{ __('$0-$50,000') }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="50001-100000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '50001-100000') : '';?>><label>
                                                        {{ __('$50,001-$100,000') }}

                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="100001-500000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '100001-500000') : '';?>><label>
                                                        {{ __('$100,001-$500,000') }}

                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="500001-1000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '500001-1000000') : '';?>><label>
                                                        {{ __('$500,001-$1 million') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="1000001-10000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '1000001-10000000') : '';?>><label>{{ __('$1,000,001-$10 million') }}

                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="10000001-50000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '10000001-50000000') : '';?>><label>
                                                        {{ __('$10,000,001-$50 million') }}

                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="50000001-100000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '50000001-100000000') : '';?>><label>
                                                        {{ __('$50,000,001-$100 million') }}

                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="100000001-500000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '100000001-500000000') : '';?>><label>
                                                        {{ __('$100,000,001-$500 million') }}

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="500000001-1000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '500000001-1000000000') : '';?>><label>{{ __('$500,000,001-$1 billion') }}

                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="1000000001-10000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '1000000001-10000000000') : '';?>><label>
                                                        {{ __('$1,000,000,001-$10 billion') }}

                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>" class="liabilities2" value="10000000001-50000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, '10000000001-50000000000') : '';?>><label>
                                                        {{ __('$10,000,000,001-$50 billion') }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-cust font-lg-14 mb-3">
                                                    <input name="<?php echo base64_encode('Form101-Check Box23');?>"  class="liabilities2" value="More than 50000000000" type="checkbox" <?php echo isset($volPetData[base64_encode('Form101-Check Box23')]) ? Helper::validate_key_toggle(base64_encode('Form101-Check Box23'), $volPetData, 'More than 50000000000') : '';?>><label>
                                                        {{ __('More than $50 billion') }}
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
								</div>
							</div>
								<div class="row">
									<div class="col-md-12">
										<div class="part-form-title mb-3 mt-3"> <span>{{ __('Part 7') }}</span>
											<h2 class="font-lg-18">{{ __('Sign Below') }}</h2> 
										</div>
									</div>
								

							<div class="form-border ml-3 mr-3" style="border-bottom:0px;">
								<div class="row">
									<div class="col-md-2"> <strong>{{ __('For You') }}</strong> </div>
									<div class="col-md-10">
										<div class="input-group">
											<p>{{ __('I have examined this petition, and I declare under penalty of perjury that the information provided is true and correct. If I have chosen to file under Chapter 7, I am aware that I may proceed, if eligible, under Chapter 7, 11,12, or 13 of title 11, United States Code. I understand the relief available under each chapter, and I choose to proceed under Chapter 7. If no attorney represents me and I did not pay or agree to pay someone who is not an attorney to help me fill out this document, I have obtained and read the notice required by 11 U.S.C. § 342(b). I request relief in accordance with the chapter of title 11, United States Code, specified in this petition. I understand making a false statement, concealing property, or obtaining money or property by fraud in connection with a bankruptcy case can result in fines up to $250,000, or imprisonment for up to 20 years, or both. 18 U.S.C. §§ 152, 1341, 1519, and 3571.') }}</p>
										</div>
										<div class="row">
											<div class="col-md-6">
													<div class="input-group signature-field">
														<p>{{ __('Signature of Debtor 1') }}</p> 
														<span> <input name="<?php echo base64_encode('Form101-Debtor1.signature'); ?>"  type="text" value="{{$debtor_sign}}" class="form-control"></span>
													</div>
													<div class="input-group signature-field">
														<label for="">{{ __('Executed on') }}</label>
														<input placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control" name="<?php echo base64_encode('Form101-Executed on'); ?>"> </div>
												</div>

												<div class="col-md-6">
													<div class="input-group signature-field">
														<p>{{ __('Signature of Debtor 2') }}</p> 
														<span> <input name="<?php echo base64_encode('Form101-Debtor2.signature'); ?>"  type="text" value="{{$debtor2_sign}}" class="form-control"></span>
														<div class="input-group signature-field">
															<label for="">{{ __('Executed on') }}</label>
															<input placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control" name="<?php echo base64_encode('Form101-Debtor2.Executed on'); ?>"> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							

 
							<div class="form-border"  style="border-top:0px;">
								<div class="row">
									<div class="col-md-2">
										<div class="input-group"> <strong>{{ __('For your attorney, if you are
													represented by one
													If you are not represented
													by an attorney, you do not
													need to file this page.') }}</strong> </div>
									</div>
										<div class="col-md-10">
											<div class="input-group">
												<p>{{ __('I, the attorney for the debtor(s) named in this petition, declare
													that I
													have
													informed
													the debtor(s) about eligibility
													to proceed under Chapter 7, 11, 12, or 13 of title 11, United States
													Code,
													and have
													explained the relief
													available under each chapter for which the person is eligible. I
													also
													certify that I
													have delivered to the debtor(s)
													the notice required by 11 U.S.C. § 342(b) and, in a case in which §
													707(b)(4)(D)
													applies, certify that I have no
													knowledge after an inquiry that the information in the schedules
													filed
													with
													the petition
													is incorrect.') }} </p>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group">
														<label for="">{{ __('Signature of Attorney for Debtor') }}</label>
														<span> <input name="<?php echo base64_encode('Form101-Attorney.Sig'); ?>"  type="text" value="{{$attorny_sign}}" class="form-control"></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group">
														<label for="">{{ __('Date') }}</label>
														<input placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Date signed')] ?? $currentDate; ?>" class="date_filed form-control" name="<?php echo base64_encode('Form101-Attorney.Date signed');?>">
													</div>
												</div>
												<div class="col-md-12">
													<div class="input-group">
														<label for="">{{ __('Printed name') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Printed name');?>"  type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Printed name')] ?? Auth::user()->name; ?>" class="form-control">
													</div>
												</div>
												<div class="col-md-12">
													<div class="input-group">
														<label for="">{{ __('Firm name') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Firm name');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Firm name')] ?? Helper::validate_key_value('company_name', $attorney_company);?>" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
											
												<div class="col-md-12">
													<div class="input-group">
														<label>{{ __('Address 1') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Street address_2');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Street address_2')] ?? Helper::validate_key_value('attorney_address', $attorney_company);?>"" class="form-control">
													</div>
												</div>
												<div class="col-md-12 ">
													<div class="input-group ">
														<label>{{ __('Address 2') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Street address_3');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Street address_3')] ?? Helper::validate_key_value('attorney_address2', $attorney_company);?>"" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group">
														<label>{{ __('City') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.City');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.City')] ?? Helper::validate_key_value('attorney_city', $attorney_company);?>"" class="form-control">
													</div>
												</div>
												<div class="col-md-3 ">
													<div class="input-group ">
														<label>{{ __('State') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.State');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.State')] ?? Helper::validate_key_value('attorney_state', $attorney_company);?>"" class="form-control">
													</div>
												</div>
												<div class="col-md-3">
													<div class="input-group">
														<label>{{ __('Zip Code') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Zip');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Zip')] ?? Helper::validate_key_value('attorney_zip', $attorney_company);?>"" class="form-control">
													</div>
												</div>
											</div>
											<?php ?>
											<div class="row ">
												<div class="col-md-6 ">
													<div class="input-group ">
														<label>{{ __('Contact phone') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.phone');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.phone')] ?? Helper::validate_key_value('attorney_phone', $attorney_company);?>" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group">
														<label>{{ __('Email address') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Email address');?>" type="email" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Email address')] ?? Auth::user()->email; ?>" class="form-control">
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group">
														<label>{{ __('Bar number') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Bar number');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Bar number')] ?? Helper::validate_key_value('state_bar', $attorney_company);?>" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group">
														<label>{{ __('State') }}</label>
														<input name="<?php echo base64_encode('Form101-Attorney.Bar State');?>" type="text" value="<?php echo $volPetData[base64_encode('Form101-Attorney.Bar State')] ?? Helper::validate_key_value('attorney_state', $attorney_company);?>" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row 101frm align-items-center avoid-this" style="margin-left:1px;">
						<div class="form-title 101frm mb-9" style="margin-top:15px;">
							<button type="submit" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right vp-101 ml-2 print-hide">
								<span class="101frm card-title-text">{{ __('Generate VOL Petition PDF') }}</span>
							</button>
						</div>
						<div class="form-title mb-9" style="margin-top:15px;">
			                <a id="generate_combined_pdf" onclick="printDocument('coles_official-form-101')" href="javascript:void(0)">
			                    <button type="button" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2  generate_combined">
			                        <span class="card-title-text">{{ __('print')}}</span>
			                    </button>
			                </a>
			            </div>
					</div>
							
								
							
                            

							
						


					</section>
                    </form>