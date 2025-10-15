<form class="official_ef_forms save_official_forms" name="official_frm_106ef_part2" id="official_frm_106ef_part2" action="{{route('generate_official_pdf')}}" method="post">
	@csrf
		<input type="hidden" name="form_id" value="106ef_part2">
		<input type="hidden" name="client_id" value="<?php echo $client_id;?>">
		<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106ef_part2.pdf'; ?>">
		<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106ef_part2.pdf'; ?>">
		<input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
		<input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
		<input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
		<!-- Use below variable to fill values -->
		<?php $efPdfPart2 = isset($dynamicPdfData['106ef_part2']) && !empty($dynamicPdfData['106ef_part2']) ? json_decode($dynamicPdfData['106ef_part2'], 1) : null; ?>
<!-- Part 2 -->
<div class="row align-items-center">
								<div class="col-md-12">
									<div class="part-form-title mb-3">
										<span>{{ __('Part 2') }}</span>
										<h2 class="font-lg-18">{{ __('List All of Your NONPRIORITY Unsecured Claims') }}
										</h2>
									</div>
								</div>
							</div>
							<!-- Row 4.1 -->
							<div class="form-border">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group d-inline-block">
											<label for="">
												<strong class="d-block">{{ __('3. Do any creditors have nonpriority
													unsecured
													claims against you?') }}
												</strong> </label>
											</div>
											<?php
                                                $c1 = $efPdfPart2[base64_encode('check7')] ?? null;
		$c2 = $efPdfPart2[base64_encode('check7')] ?? null;
		$dbvalues = [$c1, $c2];
		if (!empty(array_filter($dbvalues))) {
		    unset($efPdfPart2['check7']);
		}
		$check1 = isset($efPdfPart2[base64_encode('check7')]) ? Helper::validate_key_toggle(base64_encode('check7'), $efPdfPart2, 'no') : '';
		$check2 = isset($efPdfPart2[base64_encode('check7')]) ? Helper::validate_key_toggle(base64_encode('check7'), $efPdfPart2, 'yes') : '';
		?>
											<div class="input-group">
												<input name="<?php echo base64_encode('check7'); ?>" value="no" type="checkbox" <?php echo $check1;?>>
												<label>{{ __('No. You have nothing to report in this part. Submit this form to the court with your other schedules.') }}</label>
											</div>
											<div class="input-group">
												<input name="<?php echo base64_encode('check7'); ?>" value="yes" type="checkbox" <?php echo $check2;?>>
												<label>{{ __('Yes') }}</label>
											</div>
										</div>
									</div>
									<div class="row ">
										<div class="col-md-12 column-heading">
											<div class="input-group d-inline-block gray-row d-inline-block">
												<label><strong class="mb-0">{{ __('4. List all of your nonpriority unsecured
													claims
													in the alphabetical order of the creditor who holds each claim.') }}
												</strong> {{ __('If a creditor has more than one nonpriority unsecured claim, list the creditor separately for each claim. For each claim listed, identify what type of claim it is. Do not list claims already included in Part 1. If more than one creditor holds a particular claim, list the other creditors in Part 3.If you have more than three nonpriority unsecured claims fill out the Continuation Page of Part 2.') }} </label>
											</div>
											</br>
										</div>
									</div>
										

<div class=" <?php if (isset($isfirst) && $isfirst == false) {
    echo 'bt-none';
} ?>">
<?php if (isset($isfirst) && $isfirst == true) { ?>
<div class="row column-heading pl-0">
	<div class="col-md-10">
		<div class="input-group gray-row d-inline-block">
			
		</div>
	</div>
	<div class="col-md-2 f10 bg-dgray">
	<label><x-stronglabel class="mb-0" label="{{ __('Total Claim')}}" />
	</label>
		 
	</div>
</div>
<?php } ?>

<div class="row pl-0 column-heading">

<?php

    $cards_collections = ArrayHelper::getDebtCardSelectionsForAttorney();
		$inde = 1;
		foreach ($debts as $debt) {
		    $studentCheckbox = Helper::validate_key_value('cards_collections', $debt);
		    $studentChecked = '';
		    $otherChecked = '';
		    $otherValue = '';
		    if ($studentCheckbox == 5) {
		        $studentChecked = "checked";
		    } else {
		        $otherChecked = 'checked';
		        $otherValue = $cards_collections[$studentCheckbox];
		    }

		    $debt['subject_to_offset'] = 0;
		    $fieldName = LocalFormHelper::schedule_ef_part2_page1($inde);
		    $pageno = '5';
		    ?>
            
											<div class="col-md-12">
											<input type="hidden" name="<?php echo base64_encode($fieldName['page_no']); ?>" attr="{{$fieldName['page_no']}}" value="{{$pagees}}">
											<input type="hidden" name="<?php echo base64_encode($fieldName['total_page']); ?>" attr="{{$fieldName['total_page']}}" value="{{$totalefCountPages}}">
											
												<input name="<?php echo base64_encode($fieldName['box_no']); ?>" class="form-control- square" type="text" value="4.<?php echo $index;?>" readonly=""> </div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group">
															<label>{{ __('Nonpriority Creditor’s Name') }} </label>
															<input name="<?php echo base64_encode($fieldName['name']); ?>" type="text" value="<?php echo $efPdfPart2[base64_encode($fieldName['name'])] ?? Helper::validate_key_value('creditor_name', $debt);?>" class="form-control"> </div>
														<div class="row">
															<!--  -->
															<div class="col-md-12">
																<div class="input-group">
																	<label>{{ __('Street') }}</label>
																	<input name="<?php echo base64_encode($fieldName['street']); ?>" type="text" value="<?php echo $efPdfPart2[base64_encode($fieldName['name'])] ?? Helper::validate_key_value('creditor_information', $debt);?>" class="form-control"> </div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-4">
																<div class="input-group">
																	<label>{{ __('City') }}</label>
																	<input name="<?php echo base64_encode($fieldName['city']); ?>" type="text" value="<?php echo $efPdfPart2[base64_encode($fieldName['city'])] ?? Helper::validate_key_value('creditor_city', $debt);?>" class="form-control"> </div>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<label>{{ __('State') }}</label>
																	<input name="<?php echo base64_encode($fieldName['state']); ?>" type="text" value="<?php echo $efPdfPart2[base64_encode($fieldName['state'])] ?? Helper::validate_key_value('creditor_state', $debt);?>" class="form-control"> </div>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<label>{{ __('Zip Code') }}</label>
																	<input name="<?php echo base64_encode($fieldName['zip']); ?>" type="text" value="<?php echo $efPdfPart2[base64_encode($fieldName['zip'])] ?? Helper::validate_key_value('creditor_zip', $debt);?>" class="form-control"> </div>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="input-group">
															<label><strong>{{ __('Who incurred the debt?') }}</strong> {{ __('Check one.') }}</label>
														</div>
														<?php
		                                                    $c1 = $efPdfPart2[base64_encode($fieldName['debtor_radio'])] ?? null;
		    $c2 = $efPdfPart2[base64_encode($fieldName['debtor_radio'])] ?? null;
		    $c3 = $efPdfPart2[base64_encode($fieldName['debtor_radio'])] ?? null;
		    $c4 = $efPdfPart2[base64_encode($fieldName['debtor_radio'])] ?? null;
		    $dbvalues = [$c1,$c2,$c3,$c4];
		    if (!empty(array_filter($dbvalues))) {
		        unset($debt['owned_by']);
		    }
		    $check1 = isset($efPdfPart2[base64_encode($fieldName['debtor_radio'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']), $efPdfPart2, $fieldName['debtor_A']) : Helper::validate_key_toggle('owned_by', $debt, 1);
		    $check2 = isset($efPdfPart2[base64_encode($fieldName['debtor_radio'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']), $efPdfPart2, $fieldName['debtor_B']) : Helper::validate_key_toggle('owned_by', $debt, 2);
		    $check3 = isset($efPdfPart2[base64_encode($fieldName['debtor_radio'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']), $efPdfPart2, $fieldName['debtor_A_and_B']) : Helper::validate_key_toggle('owned_by', $debt, 3);
		    $check4 = isset($efPdfPart2[base64_encode($fieldName['debtor_radio'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']), $efPdfPart2, $fieldName['debtor_one_or_another']) : Helper::validate_key_toggle('owned_by', $debt, 4);
		    ?>
														<div class="input-group">
															<input name="<?php echo base64_encode($fieldName['debtor_radio']); ?>" type="checkbox" id="Debtor1"  value="<?php echo($fieldName['debtor_A']); ?>" <?php echo $check1;?>>
															<label for="Debtor1">{{ __('Debtor 1 only') }} </label>
														</div>
														<div class="input-group">
															<input name="<?php echo base64_encode($fieldName['debtor_radio']); ?>" type="checkbox" id="Debtor2"  value="<?php echo($fieldName['debtor_B']); ?>" <?php echo $check2;?>>
															<label for="Debtor2">{{ __('Debtor 2 only') }} </label>
														</div>
														<div class="input-group">
															<input name="<?php echo base64_encode($fieldName['debtor_radio']); ?>" type="checkbox" id="Debtor12"  value="<?php echo($fieldName['debtor_A_and_B']); ?>" <?php echo $check3;?>>
															<label for="Debtor12">{{ __('Debtor 1 and Debtor 2 only') }} </label>
														</div>
														<div class="input-group">
															<input name="<?php echo base64_encode($fieldName['debtor_radio']); ?>" type="checkbox" id="another"  value="<?php echo($fieldName['debtor_one_or_another']); ?>" <?php echo $check4;?>>
															<label for="another">{{ __('At least one of the debtors and another') }} </label>
														</div>
														<div class="input-group">
															<input name="<?php echo base64_encode($fieldName['check_if_this_clain_checkbox']); ?>" type="checkbox" id="claim"  value="On" <?php echo isset($efPdfPart2[base64_encode($fieldName['check_if_this_clain_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['check_if_this_clain_checkbox']), $efPdfPart2, 'On') : '';?>>
															<label for="claim">{{ __('Check if this claim relates to a community debt') }} </label>
														</div>
														<div class="input-group">
															<label><strong>{{ __('Is the claim subject to offset?') }} </strong></label>
															<br>
															<input name="<?php echo base64_encode($fieldName['claim_subject_radio']); ?>" value="<?php echo($fieldName['value_no']); ?>" type="checkbox" <?php echo isset($efPdfPart2[base64_encode($fieldName['claim_subject_radio'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['claim_subject_radio']), $efPdfPart2, $fieldName['value_no']) : Helper::validate_key_toggle('subject_to_offset', $debt, 0);?>>
															<label>{{ __('No') }}</label>
														</div>
														<div class="input-group">
															<input name="<?php echo base64_encode($fieldName['claim_subject_radio']); ?>" value="<?php echo($fieldName['value_yes']); ?>" type="checkbox" <?php echo isset($efPdfPart2[base64_encode($fieldName['claim_subject_radio'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['claim_subject_radio']), $efPdfPart2, $fieldName['value_yes']) : Helper::validate_key_toggle('subject_to_offset', $debt, 1);?>>
															<label>{{ __('Yes') }}</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4  ml-0 pl-0">
												<div class="input-group">
													<label><x-stronglabel label="{{ __('Last 4 digits of acct #')}}" /> </label>
													<input name="<?php echo base64_encode($fieldName['last_4_digits']); ?>" type="text" value="<?php echo $efPdfPart2[base64_encode($fieldName['last_4_digits'])] ?? Helper::lastchar($debt['amount_number'] ?? '');?> " class="form-control"> </div>
												<div class="input-group">
													<label><strong>{{ __('When debt incurred?:') }}</strong> </label>
													<?php $debt_incurred = $efPdfPart2[base64_encode($fieldName['debt_incurred'])] ?? Helper::validate_key_value('debt_date', $debt);
		    if (strtotime($debt_incurred) != false && strlen($debt_incurred) > 7) {
		        $debt_incurred = date('m/Y', strtotime($debt_incurred));
		    }
		    ?>
													<input name="<?php echo base64_encode($fieldName['debt_incurred']); ?>" type="text" value="<?php echo $debt_incurred;?>" class="form-control"> </div>
												<div class="input-group">
													<label><x-stronglabel label="{{ __('As of the date you file, the claim is:')}}" /> {{ __('Check all that apply.') }}</label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode($fieldName['contingent_checkbox']); ?>" value="On" type="checkbox" <?php echo isset($efPdfPart2[base64_encode($fieldName['contingent_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['contingent_checkbox']), $efPdfPart2, 'On') : '';?>>
													<label>{{ __('Contingent') }} </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode($fieldName['unliquidated_checkbox']); ?>" value="On" type="checkbox" <?php echo isset($efPdfPart2[base64_encode($fieldName['unliquidated_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['unliquidated_checkbox']), $efPdfPart2, 'On') : '';?>>
													<label>{{ __('Unliquidated') }} </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode($fieldName['disputed_checkbox']); ?>" value="On" type="checkbox" <?php echo isset($efPdfPart2[base64_encode($fieldName['disputed_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['disputed_checkbox']), $efPdfPart2, 'On') : '';?>>
													<label>{{ __('Disputed') }} </label>
												</div>
												<div class="input-group">
													<label><strong>{{ __('Type of NONPRIORITY unsecured claim:') }}</strong> </label>
												</div>
												<?php
		    $c1 = $efPdfPart2[base64_encode($fieldName['student_checkbox'])] ?? null;
		    $c2 = $efPdfPart2[base64_encode($fieldName['obligations_checkbox'])] ?? null;
		    $c3 = $efPdfPart2[base64_encode($fieldName['debt_checkbox'])] ?? null;
		    $c4 = $efPdfPart2[base64_encode($fieldName['other_checkbox'])] ?? null;
		    $dbvalues = [$c1,$c2,$c3,$c4];
		    if (!empty(array_filter($dbvalues))) {
		        $studentChecked = "";
		        $otherChecked = "";
		    }

		    $check1 = isset($efPdfPart2[base64_encode($fieldName['student_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['student_checkbox']), $efPdfPart2, $fieldName['value_on']) : $studentChecked;
		    $check2 = isset($efPdfPart2[base64_encode($fieldName['obligations_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['obligations_checkbox']), $efPdfPart2, $fieldName['value_on']) : '';
		    $check3 = isset($efPdfPart2[base64_encode($fieldName['debt_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debt_checkbox']), $efPdfPart2, $fieldName['value_on']) : '';
		    $check4 = isset($efPdfPart2[base64_encode($fieldName['other_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['other_checkbox']), $efPdfPart2, $fieldName['value_on']) : $otherChecked;
		    ?>
												<div class="input-group">
													<input class="ef_student_loan" name="<?php echo base64_encode($fieldName['student_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox" <?php echo $check1;?>>
													<label>{{ __('Student loans') }} </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode($fieldName['obligations_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox" <?php echo $check2;?>>
													<label>{{ __('Obligations arising out of a separation agreement or divorce that you did not report as priority claims') }} </label>
												</div>
												<div class="input-group">
													<input class="ef_pension_or_profit" name="<?php echo base64_encode($fieldName['debt_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox" <?php echo $check3;?>>
													<label>{{ __('Debts to pension or profit-sharing plans, and other similar debts') }} </label>
												</div>
												<div class="input-group">
													<input attr="{{$fieldName['other_checkbox']}}" <?php echo $otherChecked;?> name="<?php echo base64_encode($fieldName['other_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox" <?php echo $check4;?>>
													<label>{{ __('Other. Specify') }} </label>
													<input  name="<?php echo base64_encode($fieldName['other_textbox']); ?>" type="text" class="form-control l-w" value="<?php echo $efPdfPart2[base64_encode($fieldName['other_textbox'])] ?? (isset($otherValue) ? $otherValue : ''); ?>"> </div>
											</div>
											<div class="col-md-2  ml-0 pl-0">
												<div class="row">
													<div class="col-md-12  mr-0 pr-0">
														<div class="input-group"> <label><x-stronglabel label="{{ __('Total claim')}}" /></label>
															<input name="<?php echo base64_encode($fieldName['total_claim']); ?>" type="text" value="<?php echo $efPdfPart2[base64_encode($fieldName['total_claim'])] ?? (isset($debt['amount_owned']) ? Helper::priceFormtWithComma($debt['amount_owned']) : ''); ?>" class="price-field form-control" placeholder="$"> </div>
													</div>
												</div>
											</div>
											<?php $index++;
		    $inde++;
		} ?>
										</div>
										<h3 style="text-align:right;">Page {{$pagees}} of {{$totalefCountPages}} </h3>
								</div>		
</form>		
</div>	
