<section class="page-section official-form-106h padd-20" id="official-form-106h">
							
<form name="official_frm_106h" id="official_frm_106h" class="official_sch_h_form_first save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="form_id" value="106h">
                    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
					<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106h.pdf'; ?>">
					<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106h.pdf'; ?>">
					<input type="hidden" name="<?php echo base64_encode('Case number#0-106H'); ?>" value="<?php echo $caseno; ?>">
					<input type="hidden" name="<?php echo base64_encode('Debtor 1#0-106H'); ?>" value="<?php echo $onlyDebtor; ?>">
					<input type="hidden" name="<?php echo base64_encode('Debtor 2-106H'); ?>" value="<?php echo $spousename; ?>">
					
	<?php $schH = isset($dynamicPdfData['106h']) && !empty($dynamicPdfData['106h']) ? json_decode($dynamicPdfData['106h'], 1) : null;?>
	<div class="container pl-2 pr-0">
								<div class="row">
									<div class="frm106h col-md-7">
										<div class="frm106h section-box">
											<div class="frm106h section-header bg-back text-white">
												<p class="frm106h font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
											</div>
											<div class="section-body padd-20">
												<div class="row">

													<div class="frm106h col-md-12">
														
														<div class="frm106h input-group">
															<label>{{ __('United States Bankruptcy Court for the') }}</label>
															<select name="<?php echo base64_encode('Bankruptcy District Information-106H'); ?>" class="frm106h form-control district-select" id="district_name"> @foreach ($district_names as $district_name)
																<option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>

														</div>
													</div>

												</div>
											</div>
										</div>

									</div>

									<div class="106h col-md-5 frm106h">
										<div class="amended frm106h">
											<input type="checkbox" <?php isset($schH[base64_encode('Check if this is an-106H')]) ? Helper::validate_key_toggle(base64_encode('Check if this is an-106H'), $schH, 'on') : ''; ?> name="<?php echo base64_encode('Check if this is an-106H');?>">
											<label>{{ __('Check if this is an amended filing') }}</label>
											</div>
										</div>
								</div>
								<div class="row padd-20">
									<div class="col-md-12 mb-3">
										<div class="form-title">
											<h4>{{ __('Schedule H') }}</h4>
											<!-- <h4>{{ __('Official Form 106H') }} </h4> -->
											<h2 class="font-lg-22">{{ __('Schedule H: Your Codebtors') }}
										</h2> </div>
									</div>
									<div class="col-md-12">
										<div class="form-subheading">
											<p class="font-lg-14"><strong>{{ __('Codebtors are people or entities who are also
												liable for any debts you may have. Be as complete and accurate as
												possible. If two married people
												are filing together, both are equally responsible for supplying
												correct
												information. If more space is needed, copy the Additional Page, fill
												it
												out,
												and number the entries in the boxes on the left. Attach the
												Additional
												Page to this page. On the top of any Additional Pages, write your
												name
												and
												case number (if known). Answer every question.') }}
											</strong></p>
										</div>
									</div>
								</div>
							</div>
							
									<div class="form-border mb-3 ml-4 mr-4">
										<!-- Row 1 -->
										<div class="row">
											<div class="col-md-12">
												<div class="input-group d-inline-block">
													<label for=""> <strong class="d-block">{{ __('1. Do you have any codebtors? (If you are
													filing
													a
													joint case, do not list either spouse as a codebtor.)') }}
												</strong> </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode('check1#1-106H');?>" value="no" id="codebtor-no--js" <?php echo isset($schH[base64_encode('check1#1-106H')]) ? Helper::validate_key_toggle(base64_encode('check1#1-106H'), $schH, 'no') : ((empty($spousename)) ? "checked" : '');?> type="checkbox">
													<label>{{ __('No.') }}</label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode('check1#1-106H');?>" value="yes" id="codebtor-yes--js" <?php echo isset($schH[base64_encode('check1#1-106H')]) ? Helper::validate_key_toggle(base64_encode('check1#1-106H'), $schH, 'yes') : ((!empty($spousename)) ? "checked" : ''); ?> type="checkbox">
													<label>{{ __('Yes.') }}</label>
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-group d-inline-block">
													<label for=""> <strong class="d-block">{{ __('2. Within the last 8 years, have you lived
													in a
													community property state or territory?') }}
												</strong> {{ __('(Community property states and territories include Arizona, California, Idaho, Louisiana, Nevada, New Mexico, Puerto Rico, Texas, Washington, and Wisconsin.)') }} </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode('check2-106H');?>" value="no" type="checkbox" <?php echo isset($schH[base64_encode('check2-106H')]) ? Helper::validate_key_toggle(base64_encode('check2-106H'), $schH, 'no') : Helper::validate_key_toggle('living_domestic_partner', $financialaffairs_info, 0);?>>
													<label>{{ __('No.') }}</label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode('check2-106H');?>" value="yes" type="checkbox" <?php echo isset($schH[base64_encode('check2-106H')]) ? Helper::validate_key_toggle(base64_encode('check2-106H'), $schH, 'yes') : Helper::validate_key_toggle('living_domestic_partner', $financialaffairs_info, 1);?>>
													<label>{{ __('Yes. Did your spouse, former spouse, or legal equivalent live with you at the time?') }}</label>
												</div>
											</div>
											<?php
                                        if (!empty($financialaffairs_info['community_property_state'])) {
                                            $j = 0;
                                            for ($i = 0;$i < count($financialaffairs_info['community_property_state']);$i++) { ?>
												<div class="col-md-12 <?php if ($i > 0) {?> mt-3 <?php } ?>">
												<?php if ($i == 0) {
												    $j = '';
												}?>
													<div class="row ">
													<div class="col-md-12">
															<div class="row">
																<div class="col-md-12 ml-20">
																	<div class="input-group">
																		<input type="checkbox" name="<?php echo base64_encode('check3#0-106H'.$j);?>" value="no" <?php echo isset($schH[base64_encode('check3#0-106H'.$j)]) ? Helper::validate_key_toggle(base64_encode('check3#0-106H'.$j), $schH, 'no') : (empty(Helper::validate_key_loop_value('domestic_partner_living', $financialaffairs_info, $i)) ? "checked" : '');?>>
																		<label>{{ __('No.') }}</label>
																	</div>
																	<div class="input-group">
																		<input type="checkbox" name="<?php echo base64_encode('check3#0-106H'.$j);?>" value="yes" <?php echo isset($schH[base64_encode('check3#0-106H'.$j)]) ? Helper::validate_key_toggle(base64_encode('check3#0-106H'.$j), $schH, 'yes') : (Helper::validate_key_loop_value('domestic_partner_living', $financialaffairs_info, $i) == 1 ? "checked" : '');?>>
																		<label for="">{{ __('Yes. In which community state or territory did you live?') }}</label> <input name="<?php echo base64_encode('Community state-106H'.$j);?>" type="text" value="<?php echo $schH[base64_encode('Community state-106H'.$j)] ?? Helper::validate_key_loop_value("community_property_state", $financialaffairs_info, $i);?>" class="w100 w-200 form-control"><label>&nbsp;. Fill in the name and current address of that person.</label>
																	</div>
																</div>
															</div>
													</div>
														<div class="col-md-8 mt-4">
															<div class="input-group">
																<label>{{ __('Name of your spouse, former spouse, or legal equivalent') }} </label>
																<input name="<?php echo base64_encode('Spouse Name-106H'.$j);?>" type="text" value="<?php echo $schH[base64_encode('Spouse Name-106H'.$j)] ?? Helper::validate_key_loop_value("domestic_partner", $financialaffairs_info, $i);?>" class="form-control"> </div>
															<div class="row">
																<div class="col-md-12">
																	<div class="input-group">
																		<label>{{ __('Street Address') }}</label>
																		<input name="<?php echo base64_encode('Spouse Street-106H'.$j);?>" type="text" value="<?php echo $schH[base64_encode('Spouse Street-106H'.$j)] ?? Helper::validate_key_loop_value("domestic_partner_street_address", $financialaffairs_info, $i);?>" class="form-control"> </div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-7">
																	<div class="input-group">
																		<label>{{ __('City') }}</label>
																		<input name="<?php echo base64_encode('Spouse City-106H'.$j);?>" type="text" value="<?php echo $schH[base64_encode('Spouse City-106H'.$j)] ?? Helper::validate_key_loop_value("domestic_partner_city", $financialaffairs_info, $i);?>" class="form-control"> </div>
																</div>
																<div class="col-md-2 pr-0 pl-0">
																	<div class="input-group">
																		<label>{{ __('State') }}</label>
																		<input name="<?php echo base64_encode('Spouse State-106H'.$j);?>" type="text" value="<?php echo $schH[base64_encode('Spouse State-106H'.$j)] ?? Helper::validate_key_loop_value("domestic_partner_state", $financialaffairs_info, $i);?>" class="form-control"> </div>
																</div>
																<div class="col-md-3">
																	<div class="input-group">
																		<label>{{ __('Zip Code') }}</label>
																		<input name="<?php echo base64_encode('Spouse Zip-106H'.$j);?>" type="text" value="<?php echo $schH[base64_encode('Spouse Zip-106H'.$j)] ?? Helper::validate_key_loop_value("domestic_partner_zip", $financialaffairs_info, $i);?>" class="form-control"> </div>
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="input-group d-inline-block">
																<label for="">  </label>
															</div>

														</div>
													</div>
												</div>
												<?php $j++;
                                            }
                                        } ?>
										</div>
										<div class="row mt-4">
											<div class="col-md-12 mb-3">
												<label><strong class="mb-0">{{ __('3. In Column 1, list all of your codebtors. Do
												not include your spouse as a codebtor if your spouse is filing with
												you. List the person
												shown in line 2 again as a codebtor only if that person is a
												guarantor or cosigner. Make sure you have listed the creditor on
												Schedule D (Official Form 106D), Schedule E/F (Official Form
												106E/F), or Schedule G (Official Form 106G). Use Schedule D,
												Schedule E/F, or Schedule G to fill out Column 2.') }}</strong> </label>
											</div>
											<div class="106h col-md-7 column-heading">
												<div class="106h input-group ">
													<label><strong class="106h mb-0"><i>{{ __('Column 1') }}</i>{{ __(': Your codebtor') }}</strong> </label>
												</div>
											</div>
											<div class="106h col-md-5 column-heading">
												<div class="106h input-group ">
													<label><strong class="mb-0"><i>{{ __('Column 2') }}</i>{{ __(': The creditor to whom you
													owe
													the
													debt') }}<br>
													{{ __('Check all schedules that apply:') }} </strong> </label>
												</div>
											</div>
										</div>
										<?php


$SchDfromline = 2;
                    $schDlineIndex = 1;
                    $schdDpart2Debtors = [];

                    foreach ($creditors as $schdcreditli) {
                        if (in_array($schdcreditli['debt_owned_by'], Helper::OWNBY_FORM_VALUES)) {
                            $schdcreditli['codebtor']['fromLine'] = $SchDfromline.'.'.$schDlineIndex;
                            array_push($schdDpart2Debtors, $schdcreditli['codebtor']);
                            $schDlineIndex++;
                        }
                    }

                    $backIndex = 1;
                    if (!empty($final_debtstax['tax_owned_state']) && !empty($final_debtstax['back_tax_own']) && count($final_debtstax['back_tax_own']) > 0) {

                        //2.1 only
                        foreach ($final_debtstax['back_tax_own'] as $pastdebth) {
                            if (in_array(Helper::validate_key_value('owned_by', $pastdebth), Helper::OWNBY_FORM_VALUES)) {
                                $taxcodh1 = [
                                    'codebtor_creditor_name' => Helper::validate_key_value('codebtor_creditor_name', $pastdebth),
                                    'codebtor_creditor_name_addresss' => Helper::validate_key_value('codebtor_creditor_name_addresss', $pastdebth),
                                    'codebtor_creditor_city' => Helper::validate_key_value('codebtor_creditor_city', $pastdebth),
                                    'codebtor_creditor_state' => Helper::validate_key_value('codebtor_creditor_state', $pastdebth),
                                    'codebtor_creditor_zip' => Helper::validate_key_value('codebtor_creditor_zip', $pastdebth),
                                    'account_number' => isset($BasicInfoPartA['security_number']) ? Helper::lastchar($BasicInfoPartA['security_number']) : "",
                                    'fromLine' => '1'.'.'.$backIndex,
                                    'part' => '1'
                                    ];
                                array_push($schdDpart2Debtors, $taxcodh1);
                                $backIndex++;
                            }
                        }
                    }

                    if (Helper::validate_key_value('tax_owned_irs', $final_debtstax) == 1 && isset($final_debtstax['tax_irs_state']) && !empty($final_debtstax['tax_irs_state'])) {
                        //2.1 only

                        if (in_array(Helper::validate_key_value('tax_irs_owned_by', $final_debtstax), Helper::OWNBY_FORM_VALUES)) {
                            $taxcodirs = [
                            'codebtor_creditor_name_addresss' => Helper::validate_key_value('tax_irs_codebtor_creditor_name_addresss', $final_debtstax),
                            'codebtor_creditor_name' => Helper::validate_key_value('tax_irs_codebtor_creditor_name', $final_debtstax),
                            'codebtor_creditor_zip' => Helper::validate_key_value('tax_irs_codebtor_creditor_zip', $final_debtstax),
                            'codebtor_creditor_city' => Helper::validate_key_value('tax_irs_codebtor_creditor_city', $final_debtstax),
                            'codebtor_creditor_state' => Helper::validate_key_value('tax_irs_codebtor_creditor_state', $final_debtstax),
                            'account_number' => isset($BasicInfoPartA['security_number']) ? Helper::lastchar($BasicInfoPartA['security_number']) : "",
                            'fromLine' => '1'.'.'.$backIndex,
                            'part' => '2'
                            ];
                            array_push($schdDpart2Debtors, $taxcodirs);
                        }
                    }


                    $debtTaxes = [];
                    if (!empty($final_debtstax['debt_tax']) && count($final_debtstax['debt_tax']) > 0) {
                        $debtTaxes = $final_debtstax['debt_tax'];
                    }
                    $dstIndex = 1;
                    if (!empty($debtTaxes)) {
                        foreach ($debtTaxes as $debttax) {
                            $taxcod = [
                                'codebtor_creditor_name' => Helper::validate_key_value('codebtor_creditor_name', $debttax),
                                'codebtor_creditor_name_addresss' => Helper::validate_key_value('codebtor_creditor_name_addresss', $debttax),
                                'codebtor_creditor_city' => Helper::validate_key_value('codebtor_creditor_city', $debttax),
                                'codebtor_creditor_state' => Helper::validate_key_value('codebtor_creditor_state', $debttax),
                                'codebtor_creditor_zip' => Helper::validate_key_value('codebtor_creditor_zip', $debttax),
                                'account_number' => Helper::validate_key_value('amount_number', $debttax),
                                'fromLine' => '4'.'.'.$dstIndex,
                                'part' => '2'
                                ];
                            if (isset($debttax['owned_by']) && in_array($debttax['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                                array_push($schdDpart2Debtors, $taxcod);
                            }
                            $dstIndex++;
                        }
                    }

                    $count = count($schdDpart2Debtors);
                    $page1Taxes = array_slice($schdDpart2Debtors, 0, 3);
                    $page2Taxes = array_slice($schdDpart2Debtors, 3, $count);
                    $codebtorGroup = array_chunk($page2Taxes, 8);
                    $totalCountPages = count($codebtorGroup);
                    $j = 1;
                    foreach ($page1Taxes as $debt) {
                        if (!empty($debt['codebtor_creditor_name'])) { ?>
					<!-- 3.1 Row -->
					<div class="row border-bottm-1">
						<div class="col-md-9 "> <strong><input type="text" readonly name="<?php echo base64_encode('fill 3.'.$j.'-106H'); ?>" class="square" value="3.<?php echo $j; ?>"></strong> </div>
						<div class="col-md-8">
							<div class="input-group">
								<label>{{ __('Name') }} </label>
								<input name="<?php echo base64_encode('Codebtor Name 3.'.$j.'-106H');?>" type="text" value="<?php echo $schH[base64_encode('Codebtor Name 3.'.$j.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_name', $debt); ?>" class="community_prop_sch_h form-control"> </div>
							<div class="row">
								<div class="col-md-12">
									<div class="input-group">
										<label>{{ __('Street Address') }}</label>
										<input name="<?php echo base64_encode('Codebtor Street 3.'.$j.'-106H');?>" type="text" value="<?php echo $schH[base64_encode('Codebtor Street 3.'.$j.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_name_addresss', $debt); ?>" class="form-control"> </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-7">
									<div class="input-group">
										<label>{{ __('City') }}</label>
										<input name="<?php echo base64_encode('Codebtor City 3.'.$j.'-106H');?>" type="text" value="<?php echo $schH[base64_encode('Codebtor City 3.'.$j.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_city', $debt); ?>" class="form-control"> </div>
								</div>
								<div class="col-md-2 pl-0 pr-0">
									<div class="input-group">
										<label>{{ __('State') }}</label>
										<input name="<?php echo base64_encode('Codebtor State 3.'.$j.'-106H');?>" type="text" value="<?php echo $schH[base64_encode('Codebtor State 3.'.$j.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_state', $debt); ?>" class="form-control"> </div>
								</div>
								<div class="col-md-3">
									<div class="input-group">
										<label>{{ __('Zip Code') }}</label>
										<input name="<?php echo base64_encode('Codebtor Zip 3.'.$j.'-106H');?>" type="text" value="<?php echo $schH[base64_encode('Codebtor Zip 3.'.$j.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_zip', $debt); ?>" class="form-control"> </div>
								</div>
							</div>
						</div>
						<div class="col-md-4 mt-3">
							<div class="input-group d-flex"> 
								<?php
                                   $c1 = $schH[base64_encode('check schedule line D 3.'.$j.'-106H')] ?? null;
                            $c2 = $schH[base64_encode('check schedule line E/F 3.'.$j.'-106H')] ?? null;
                            $c3 = $schH[base64_encode('check schedule line G 3.'.$j.'-106H')] ?? null;
                            $dbvalues = [$c1,$c2,$c3];
                            if (!empty(array_filter($dbvalues))) {
                                unset($debt['part']);
                            }

                            $check1 = isset($schH[base64_encode('check schedule line D 3.'.$j.'-106H')]) ? Helper::validate_key_toggle(base64_encode('check schedule line D 3.'.$j.'-106H'), $schH, 'yes') : Helper::validate_key_toggle('part', $debt, 1);
                            $check2 = isset($schH[base64_encode('check schedule line E/F 3.'.$j.'-106H')]) ? Helper::validate_key_toggle(base64_encode('check schedule line E/F 3.'.$j.'-106H'), $schH, 'yes') : Helper::validate_key_toggle('part', $debt, 2);
                            $check3 = isset($schH[base64_encode('check schedule line G 3.'.$j.'-106H')]) ? Helper::validate_key_toggle(base64_encode('check schedule line G 3.'.$j.'-106H'), $schH, 'yes') : Helper::validate_key_toggle('part', $debt, 3);

                            ?>
								<input name="<?php echo base64_encode('check schedule line D 3.'.$j.'-106H');?>" value="yes" <?php echo $check1; ?> type="checkbox">
								<label for="" class="w100">{{ __('Schedule D, line') }}</label>
								<input name="<?php echo base64_encode('Schedule line D 3.'.$j.'-106H');?>" type="text" class="form-control" value="<?php echo isset($schH[base64_encode('Schedule line D 3.'.$j.'-106H')]) ? $schH[base64_encode('Schedule line D 3.'.$j.'-106H')] : ((Helper::validate_key_value('part', $debt) == 1) ? Helper::validate_key_value('fromLine', $debt) : ''); ?>"/>
							</div>
							<div class="input-group d-flex">
								<input name="<?php echo base64_encode('check schedule line E/F 3.'.$j.'-106H');?>" value="yes" <?php echo $check2; ?> type="checkbox">
								<label for="" class="w100">{{ __('Schedule E/F, line') }}</label>
								<input name="<?php echo base64_encode('Schedule line E/F 3.'.$j.'-106H');?>" type="text" class="form-control" value="<?php  echo isset($schH[base64_encode('Schedule line E/F 3.'.$j.'-106H')]) ? $schH[base64_encode('Schedule line E/F 3.'.$j.'-106H')] : ((Helper::validate_key_value('part', $debt) == 2) ? Helper::validate_key_value('fromLine', $debt) : ''); ?>"/>
							</div>
							<div class="input-group d-flex">
								<input name="<?php echo base64_encode('check schedule line G 3.'.$j.'-106H');?>" value="yes" <?php echo $check3;?> type="checkbox">
								<label for="" class="w100">{{ __('Schedule G, line') }}</label>
								<input name="<?php echo base64_encode('Schedule line G 3.'.$j.'-106H');?>" type="text" class="form-control" value="<?php  echo isset($schH[base64_encode('Schedule line G 3.'.$j.'-106H')]) ? $schH[base64_encode('Schedule line G 3.'.$j.'-106H')] : ((Helper::validate_key_value('part', $debt) == 3) ? Helper::validate_key_value('fromLine', $debt) : ''); ?>"/>
							</div>
						</div>
					</div>
					<input type="hidden" name="<?php echo base64_encode('fill_27.0-106H') ?>" value="<?php echo($totalCountPages + 1); ?>">
					<?php 	$j = $j + 1;
                        }
                    } ?>
			
	</div>
	</form>

	
<?php
$codeCount = $j;
                    $borderClass = '';
                    $itretion = 1;

                    foreach ($codebtorGroup as $listCodebtor) {
                        if (!empty($listCodebtor)) {
                            if ($codeCount != $j) {
                                $codeCount = $codeCount + 7;
                            }

                            ?>
 @include("attorney.official_form.default.sch_h_additional",['hdebtors' => $listCodebtor,'index' => $codeCount,'part' => $itretion,'totalpages' => ($totalCountPages+1),'pageno' => ($itretion+1)])
	<?php $itretion++;
                            $codeCount++;
                        }
                    } ?>
            <div class="row align-items-center avoid-this" style="margin-left:1px;">
                <div class="form-title mb-9" style="margin-top:15px;">

                    <button type="submit" onclick="generateIndividualPDF('official_sch_h_form_first','official_sch_h_form')" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2 print-hide">
                        <span class="card-title-text">{{ __('Generate Schedule H PDF') }}</span>
                    </button>
                </div>
                <div class="form-title mb-9" style="margin-top:15px;">
			        <a id="generate_combined_pdf" onclick="printDocument('coles_official-form-106h')" href="javascript:void(0)">
			            <button type="button" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2  generate_combined">
			                <span class="card-title-text">{{ __('print')}}</span>
			            </button>
			        </a>
			    </div>
            </div>
			
    </section>

