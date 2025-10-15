<?php if (isset($debts) && !empty($debts)) { ?>
<form class="official_ef_forms save_official_forms" name="official_frm_106ef_{{$partname}}" id="official_frm_106ef_{{$partname}}" action="{{route('generate_official_pdf')}}" method="post">
	@csrf
		<input type="hidden" name="form_id" value="106ef_{{$partname}}">
		<input type="hidden" name="client_id" value="<?php echo $client_id;?>">
		<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106ef_'.$partname.'.pdf'; ?>">
		<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106ef_'.$partname.'.pdf'; ?>">
		<input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
		<input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
		<input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">

		<?php $formIds = "106ef_".$partname; ?>
		<!-- Use below variable to fill values -->
		<?php $efPdf = isset($dynamicPdfData[$formIds]) && !empty($dynamicPdfData[$formIds]) ? json_decode($dynamicPdfData[$formIds], 1) : null; ?>
<?php if (isset($isfirst) && $isfirst == true) { ?>
	<div class="row align-items-center mt-3">
	<div class="col-md-12">
		<div class="part-form-title">
			<span>{{ __('Part 2') }}</span>
			<h2 class="font-lg-18">{{ __('Your NONPRIORITY Unsecured Claims ─ Continuation Page') }}
			</h2>
		</div>
	</div>
</div>
<?php } ?>
<div class="form-border  <?php if (isset($isfirst) && $isfirst == false) {
    echo 'bt-none';
} ?>">
<?php if (isset($isfirst) && $isfirst == true) { ?>
<div class="row column-heading pl-0">
	<div class="col-md-10">
		<div class="input-group gray-row d-inline-block">
			<label><strong class="mb-0">{{ __('After listing any entries on this page,
					number
					them beginning with 4.4, followed by 4.5, and so forth.') }}</strong>
			</label>
		</div>
	</div>
	<div class="col-md-2 f10 bg-dgray ">
	<label><strong class="mb-0">
		{{ __('Total Claim') }}
		</strong>
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

        $fieldName = LocalFormHelper::schedule_ef_part2($inde);
        $no = $index;

        $debt['subject_to_offset'] = 0;
        ?>
											<input type="hidden" att="fill_27.1.4" name="<?php echo base64_encode('fill_27.1.4')?>" value="{{$pagees}}">
											<input type="hidden" att="fill_27.1.5" name="<?php echo base64_encode('fill_27.1.5')?>" value="{{$totalefCountPages}}">
										
											<div class="col-md-12">
												<input name="<?php echo base64_encode($fieldName['box_no']); ?>" class="form-control- square" type="text" value="4.<?php echo $index;?>" readonly=""> </div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group">
															 

															@php

														    $nonpriority_value = $efPdf[base64_encode($fieldName['name'])]??Helper::validate_key_value('creditor_name',$debt);

														    @endphp	
															
															<x-labelinput label="{{ __('Nonpriority Creditor’s Name')}}" type="text"  name="<?php echo base64_encode($fieldName['name']); ?>"  value="{{$nonpriority_value}}"  ></x-labelinput>





														</div>
														<div class="row">
															<!--  -->
														 




												 		@php

												            $street_value = $efPdf[base64_encode($fieldName['street'])]??Helper::validate_key_value('creditor_information',$debt);

												        @endphp	

														 <x-input type="text" divClass="col-md-12" name="<?php echo base64_encode($fieldName['street']); ?>" placeholder="{{ __('Street') }}" label="{{ __('Street')}}" inputClass=" " value="{{$street_value}}"></x-input>



														</div>
														<div class="row">
														 

														@php

												            $city_value = $efPdf[base64_encode($fieldName['city'])]??Helper::validate_key_value('creditor_city',$debt);

												        @endphp	
												        
														 <x-input type="text" divClass="col-md-4" name="<?php echo base64_encode($fieldName['city']); ?>" placeholder="{{ __('City') }}" label="{{ __('City') }}" inputClass=" " value="{{$city_value}}"></x-input>


														 @php

												            $state_value = $efPdf[base64_encode($fieldName['state'])]??Helper::validate_key_value('creditor_state',$debt);

												        @endphp	
												        
														 <x-input type="text" divClass="col-md-4" name="<?php echo base64_encode($fieldName['state']); ?>" placeholder="{{ __('State') }}" label="{{ __('State') }}" inputClass=" " value="{{$state_value}}"></x-input>


 

															 @php

												            $zipcode_value = $efPdf[base64_encode($fieldName['zip'])]??Helper::validate_key_value('creditor_zip',$debt);

												        	@endphp	
												        
														 <x-input type="text" divClass="col-md-4" name="<?php echo base64_encode($fieldName['zip']); ?>" placeholder="{{ __('Zip Code') }}" label="{{ __('Zip Code') }}" inputClass=" " value="{{$zipcode_value}}"></x-input>






														</div>
													</div>
													<div class="col-md-12">
														<div class="input-group">
															<label><strong>{{ __('Who incurred the debt?') }}</strong> {{ __('Check one.') }}</label>
														</div>
														<div class="input-group">
														 


													 @php

														$debtor1_checkbox_seleted = isset($efPdf[base64_encode($fieldName['debtor_radio'])])? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']),$efPdf,$fieldName['debtor_A']):Helper::validate_key_toggle('owned_by',$debt,1);

														@endphp


												 		<x-checkbox type="checkbox"   name="{{  base64_encode($fieldName['debtor_radio']) }}" id="Debtor1"  label="{{ __('Debtor 1 only')}}"   value="{{ ($fieldName['debtor_A']) }}" selected="{{$debtor1_checkbox_seleted}}"></x-checkbox>




														</div>
														<div class="input-group">


															@php

														$debtor2_checkbox_seleted =  isset($efPdf[base64_encode($fieldName['debtor_radio'])])? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']),$efPdf,$fieldName['debtor_B']):Helper::validate_key_toggle('owned_by',$debt,2);

														@endphp


												 		<x-checkbox type="checkbox"   name="{{ base64_encode($fieldName['debtor_radio']) }}" id="Debtor2"  label="{{ __('Debtor 2 only')}}"   value="{{ $fieldName['debtor_B'] }}" selected="{{$debtor2_checkbox_seleted}}"></x-checkbox>





															 
														</div>
														<div class="input-group">
															 

															@php

														$debtor12_checkbox_seleted =   isset($efPdf[base64_encode($fieldName['debtor_radio'])])? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']),$efPdf,$fieldName['debtor_A_and_B']):Helper::validate_key_toggle('owned_by',$debt,3);

														@endphp


												 		<x-checkbox type="checkbox"   name="{{ base64_encode($fieldName['debtor_radio']) }}" id="Debtor12"  label="{{ __('Debtor 1 and Debtor 2 only')}}"   value="{{ $fieldName['debtor_A_and_B'] }}" selected="{{$debtor12_checkbox_seleted}}"></x-checkbox>








														</div>
														<div class="input-group">
															 





																@php

														$another_checkbox_seleted =   isset($efPdf[base64_encode($fieldName['debtor_radio'])])? Helper::validate_key_toggle(base64_encode($fieldName['debtor_radio']),$efPdf,$fieldName['debtor_one_or_another']):Helper::validate_key_toggle('owned_by',$debt,4);

														@endphp


												 		<x-checkbox type="checkbox"   name="{{ base64_encode($fieldName['debtor_radio']) }}" id="another"  label="{{ __('At least one of the debtors and another')}} "   value="{{ $fieldName['debtor_one_or_another'] }}" selected="{{$another_checkbox_seleted}}"></x-checkbox>






														</div>
														<div class="input-group">
															 


															@php

														$claim_checkbox_seleted =   isset($efPdf[base64_encode($fieldName['check_if_this_clain_checkbox'])])? Helper::validate_key_toggle(base64_encode($fieldName['check_if_this_clain_checkbox']),$efPdf,$fieldName['value_on']):'';

														@endphp


												 		<x-checkbox type="checkbox"   name="{{ base64_encode($fieldName['check_if_this_clain_checkbox']) }}" id="claim"  label="{{ __('Check if this claim relates to a community debt')}} "   value="{{ $fieldName['value_on'] }}" selected="{{$claim_checkbox_seleted}}"></x-checkbox>











														</div>
														<div class="input-group">
															<label><strong>{{ __('Is the claim subject to offset?') }} </strong></label>
															<br>
															 


																@php

														$claim_subject_radio_seleted =   isset($efPdf[base64_encode($fieldName['claim_subject_radio'])])? Helper::validate_key_toggle(base64_encode($fieldName['claim_subject_radio']),$efPdf,$fieldName['value_no']):Helper::validate_key_toggle( 'subject_to_offset',$debt,0);

														@endphp


												 		<x-checkbox type="checkbox"   name="{{ base64_encode($fieldName['claim_subject_radio']) }}" id=""  label="{{ __('No')}}"   value="{{ $fieldName['value_no'] }}" selected="{{$claim_subject_radio_seleted}}"></x-checkbox>










														</div>
														<div class="input-group">
														 


													 	@php

														$claim_subject_radio_yes_seleted =   isset($efPdf[base64_encode($fieldName['claim_subject_radio'])])? Helper::validate_key_toggle(base64_encode($fieldName['claim_subject_radio']),$efPdf,$fieldName['value_yes']):Helper::validate_key_toggle( 'subject_to_offset',$debt,1);

														@endphp


												 		<x-checkbox type="checkbox"   name="{{ base64_encode($fieldName['claim_subject_radio']) }}" id=""  label="{{ __('Yes')}}"   value="{{ $fieldName['value_yes'] }}" selected="{{$claim_subject_radio_yes_seleted}}"></x-checkbox>







														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4  ml-0 pl-0">
												<div class="input-group">
													<label><strong>{{ __('Last 4 digits of acct #') }}</strong> </label>
													<input name="<?php echo base64_encode($fieldName['last_4_digits']); ?>" type="text" value="<?php echo $efPdf[base64_encode($fieldName['last_4_digits'])] ?? (isset($debt['amount_number']) ? Helper::lastchar($debt['amount_number']) : '');?>" class="form-control"> </div>
												<div class="input-group">
													<label><strong>{{ __('When debt incurred?:') }}</strong> </label>
													<input name="<?php echo base64_encode($fieldName['debt_incurred']); ?>" type="text" value="<?php echo $efPdf[base64_encode($fieldName['debt_incurred'])] ?? Helper::validate_key_value('debt_date', $debt);?>" class="form-control"> </div>
												<div class="input-group">
													<label><strong>{{ __('As of the date you file, the claim is:') }}</strong> {{ __('Check all that apply.') }}</label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode($fieldName['contingent_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox" <?php echo isset($efPdf[base64_encode($fieldName['contingent_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['contingent_checkbox']), $efPdf, $fieldName['value_on']) : '';?>>
													<label>{{ __('Contingent') }} </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode($fieldName['unliquidated_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox" <?php echo isset($efPdf[base64_encode($fieldName['unliquidated_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['unliquidated_checkbox']), $efPdf, $fieldName['value_on']) : '';?>>
													<label>{{ __('Unliquidated') }} </label>
												</div>
												<div class="input-group">
													<input name="<?php echo base64_encode($fieldName['disputed_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox" <?php echo isset($efPdf[base64_encode($fieldName['disputed_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['disputed_checkbox']), $efPdf, $fieldName['value_on']) : '';?>>
													<label>{{ __('Disputed') }} </label>
												</div>
												<div class="input-group">
													<label><strong>{{ __('Type of NONPRIORITY unsecured claim:') }}</strong> </label>
												</div>
												<?php
                                                        $c1 = $efPdf[base64_encode($fieldName['student_checkbox'])] ?? null;
        $c2 = $efPdf[base64_encode($fieldName['obligations_checkbox'])] ?? null;
        $c3 = $efPdf[base64_encode($fieldName['debt_checkbox'])] ?? null;
        $c4 = $efPdf[base64_encode($fieldName['other_checkbox'])] ?? null;
        $dbvalues = [$c1,$c2,$c3,$c4];
        if (!empty(array_filter($dbvalues))) {
            $studentChecked = "";
            $otherChecked = "";
        }

        $check1 = isset($efPdf[base64_encode($fieldName['student_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['student_checkbox']), $efPdf, $fieldName['student_checkbox']) : $studentChecked;
        $check2 = isset($efPdf[base64_encode($fieldName['obligations_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['obligations_checkbox']), $efPdf, $fieldName['obligations_checkbox']) : '';
        $check3 = isset($efPdf[base64_encode($fieldName['debt_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debt_checkbox']), $efPdf, $fieldName['debt_checkbox']) : '';
        $check4 = isset($efPdf[base64_encode($fieldName['other_checkbox'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['other_checkbox']), $efPdf, $fieldName['value_on']) : $otherChecked;
        ?>
												<div class="input-group">
													<input class="ef_student_loan" <?php echo $check1 ; ?> name="<?php echo base64_encode($fieldName['student_checkbox']); ?>" value="<?php echo($fieldName['student_checkbox']); ?>" type="checkbox">
													<label>{{ __('Student loans') }} </label>
												</div>
												<div class="input-group">
													<input class="" <?php echo $check2 ;?> name="<?php echo base64_encode($fieldName['obligations_checkbox']); ?>" value="<?php echo($fieldName['obligations_checkbox']); ?>" type="checkbox">
													<label>{{ __('Obligations arising out of a separation agreement or divorce that you did not report as priority claims') }} </label>
												</div>
												<div class="input-group">
													<input class="ef_pension_or_profit" <?php echo $check3 ;?> name="<?php echo base64_encode($fieldName['debt_checkbox']); ?>" value="<?php echo($fieldName['debt_checkbox']); ?>" type="checkbox">
													<label>{{ __('Debts to pension or profit-sharing plans, and other similar debts') }} </label>
												</div>
												<div class="input-group">
													<input attr="{{$fieldName['other_checkbox']}}" <?php echo $check4 ;?> name="<?php echo base64_encode($fieldName['other_checkbox']); ?>" value="<?php echo($fieldName['value_on']); ?>" type="checkbox">
													<label>{{ __('Other. Specify') }} </label>
													<input  name="<?php echo base64_encode($fieldName['other_textbox']); ?>" type="text" class="form-control l-w" value="<?php echo $efPdf[base64_encode($fieldName['other_textbox'])] ?? $otherValue;?> "> </div>
											</div>
											<div class="col-md-2  ml-0 pl-0">
												<div class="row">
													<div class="col-md-12  mr-0 pr-0">
														<div class="input-group"> <strong><label>{{ __('Total claim') }}</label></strong>
															<input name="<?php echo base64_encode($fieldName['total_claim']); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($efPdf[base64_encode($fieldName['total_claim'])] ?? Helper::validate_key_value('amount_owned', $debt, 'float'));?>" class="price-field form-control" placeholder="$"> </div>
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
<?php } ?>	
