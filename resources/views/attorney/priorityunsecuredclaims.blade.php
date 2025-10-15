<?php if (!empty($taxes)) { ?>
<form class="official_ef_forms save_official_forms" name="official_frm_106ef_{{$partname}}" id="official_frm_106ef_{{$partname}}" action="{{route('generate_official_pdf')}}" method="post">
	@csrf
		<input type="hidden" name="form_id" value="106ef_{{$partname}}">
		<input type="hidden" name="client_id" value="<?php echo $client_id;?>">
		<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106ef_'.$partname.'.pdf'; ?>">
		<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106ef_'.$partname.'.pdf'; ?>">
		<input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
		<input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
		<input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
		<?php $pdfName = "106ef_".$partname; ?>
		<!-- Use below variable to fill values -->
		<div class="row align-items-center mt-3">
        <div class="col-md-12">
            <div class="part-form-title mb-3">
                <span>{{ __('Part 1') }}</span>
                <h2 class="font-lg-18">{{ __('Your PRIORITY Unsecured Claims ─ Continuation Page') }}
                </h2>
            </div>
		</div>
		</div>
		<?php $efPdfPart = isset($dynamicPdfData[$pdfName]) && !empty($dynamicPdfData[$pdfName]) ? json_decode($dynamicPdfData[$pdfName], 1) : null; ?>

<div class="form-border <?php if (isset($isfirst) && $isfirst == false) {
    echo 'bt-none';
} ?> <?php if (isset($last) && $last == true) {
    echo 'mb-3';
} ?>">
<div class="row column-heading pl-0 pr-0">
			
<?php $class = '';
    $index = 1;
    $fieldName = [];
    $pageno = $pagees;
    foreach ($taxes as $item) {
        $fieldName = LocalFormHelper::SchdEFPage2($index);
        $no = $item['sq_no'];

        $item['subject_to_offset'] = 0;

        if (isset($fieldName['noBox'])) {
            ?>		
				<div class="col-md-7">
							<input type="hidden" attr= "fill_27.1.0" name="<?php echo base64_encode('fill_27.1.0')?>" value="{{$pagees}}">
							<input type="hidden" attr="fill_27.1.1" name="<?php echo base64_encode('fill_27.1.1')?>" value="{{$totalefCountPages}}">
							
					<div class="row">
					<div class="col-md-12">
						<?php if (isset($index) && $index == 1) { ?>
						<div class="input-group pl-3 gray-row d-inline-block">
								<label><strong class="mb-0">{{ __('After listing any entries on this page,
										number
										them beginning with 2.3, followed by 2.4, and so forth.') }} </strong>
								</label>
							</div>
							<?php } ?>
							<input name="<?php echo base64_encode($fieldName['noBox']); ?>" readonly class="square" value="2.<?php echo $item['sq_no']; ?>"> 
						
						</div>
						
						<div class="col-md-12 mt-3">
						
							<div class="input-group">
								 


								@php

							    $priority_value = $efPdfPart[base64_encode($fieldName['creditorName'])]??(isset($item['creditor_name']) ? $item['creditor_name'] : '');

							    @endphp	
								
								<x-labelinput label="{{ __('Priority Creditor’s Name') }}" type="text"  name="<?php echo base64_encode($fieldName['creditorName']); ?>"  value="{{$priority_value}}"  ></x-labelinput>






							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group">


								 

								@php

							    $address_value = $efPdfPart[base64_encode($fieldName['addressLineA'])]??(isset($item['address_line1']) ? $item['address_line1'] : '');

							    @endphp	
								
								<x-labelinput label="{{ __('Address')}}" type="text"  name="<?php echo base64_encode($fieldName['addressLineA']); ?>"  value="{{$address_value}}"  ></x-labelinput>






							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group">
								 




								@php

							    $address2_value = $efPdfPart[base64_encode($fieldName['addressLineB'])]??(isset($item['address_line2']) ? $item['address_line2'] : '');

							    @endphp	
								
								<x-labelinput label="{{ __('Address 2')}}" type="text"  name="<?php echo base64_encode($fieldName['addressLineB']); ?>"  value="{{$address2_value}}"  ></x-labelinput>



								 </div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								 




								@php

							    $city_value = $efPdfPart[base64_encode($fieldName['city'])]??(isset($item['city']) ? $item['city'] : '');

							    @endphp	
								
								<x-labelinput label="{{ __('City')}}" type="text"  name="<?php echo base64_encode($fieldName['city']); ?>"  value="{{$city_value}}"  ></x-labelinput>



							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								 


								@php

							    $state_value = $efPdfPart[base64_encode($fieldName['state'])]??(isset($item['state']) ? $item['state'] : '');

							    @endphp	
								
								<x-labelinput label="{{ __('State')}}" type="text"  name="<?php echo base64_encode($fieldName['state']); ?>"  value="{{$state_value}}"  ></x-labelinput>




							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								 



								@php

							    $zip_value = $efPdfPart[base64_encode($fieldName['zip'])]??(isset($item['zip']) ? $item['zip'] : '');

							    @endphp	
								
								<x-labelinput label="{{ __('Zip Code')}}" type="text"  name="<?php echo base64_encode($fieldName['zip']); ?>"  value="{{$zip_value}}"  ></x-labelinput>






							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								 



								@php

							    $acct4digit_value = $efPdfPart[base64_encode($fieldName['last4Digits'])]??(isset($item['last4Digits']) ? $item['last4Digits'] : '');

							    @endphp	
								
								<x-stronglabelinput label="{{ __('Last 4 digits of acct #')}}" type="text"  name="<?php echo base64_encode($fieldName['last4Digits']); ?>"  value="{{$acct4digit_value}}"  ></x-stronglabelinput>



								 </div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<label><strong>{{ __('When debt incurred?:') }}</strong> </label>
								<input name="<?php echo base64_encode($fieldName['whenDebtIncurred']); ?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['whenDebtIncurred'])] ?? (isset($item['year']) ? $item['year'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-12">
							<div class="input-group">
								<label><strong>{{ __('Type of PRIORITY unsecured claim:') }}</strong> </label>
							</div>
							<?php
                                    $c1 = $efPdfPart[base64_encode($fieldName['priorityTypeA'])] ?? null;
            $c2 = $efPdfPart[base64_encode($fieldName['priorityTypeB'])] ?? null;
            $c3 = $efPdfPart[base64_encode($fieldName['priorityTypeC'])] ?? null;
            $c4 = $efPdfPart[base64_encode($fieldName['priorityTypeD'])] ?? null;
            $dbvalues = [$c1,$c2,$c3,$c4];
            if (!empty(array_filter($dbvalues))) {
                unset($item['claim_type']);
            }
            $check1 = isset($efPdfPart[base64_encode($fieldName['priorityTypeA'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeA']), $efPdfPart, 'On') : Helper::validate_key_toggle('claim_type', $item, 1);
            $check2 = isset($efPdfPart[base64_encode($fieldName['priorityTypeB'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeB']), $efPdfPart, 'On') : Helper::validate_key_toggle('claim_type', $item, 2);
            $check3 = isset($efPdfPart[base64_encode($fieldName['priorityTypeC'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeC']), $efPdfPart, 'On') : Helper::validate_key_toggle('claim_type', $item, 3);
            $check4 = isset($efPdfPart[base64_encode($fieldName['priorityTypeD'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeD']), $efPdfPart, 'On') : Helper::validate_key_toggle('claim_type', $item, 4);
            ?>
							<div class="input-group">
								<input name="<?php echo base64_encode($fieldName['priorityTypeA']); ?>" class="ef_domestic_support_obligation" value="On" type="checkbox" <?php echo $check1;?>>
								<label>{{ __('Domestic support obligations') }} </label>
							</div>
							<div class="input-group">
								<input name="<?php echo base64_encode($fieldName['priorityTypeB']); ?>" class="ef_taxes_other_debts" value="On" type="checkbox" <?php echo $check2;?>>
								<label>{{ __('Taxes and certain other debts you owe the government') }} </label>
							</div>
							<div class="input-group">
								<input name="<?php echo base64_encode($fieldName['priorityTypeC']); ?>" class="ef_death_personal_claim" value="On" type="checkbox" <?php echo $check3;?>>
								<label>{{ __('Claims for death or personal injury while you were intoxicated') }} </label>
							</div>
							<div class="input-group">
								<input name="<?php echo base64_encode($fieldName['priorityTypeD']); ?>" value="On"  type="checkbox" attr="{{$fieldName['priorityTypeD']}}" <?php echo $check4;?>>
								<label>{{ __('Other. Specify') }} </label>
								<input name="<?php echo base64_encode($fieldName['priorityTypeOtherText']); ?>"  type="text" class="form-control l-w" value="<?php echo $efPdfPart[base64_encode($fieldName['priorityTypeOtherText'])] ?? (isset($item['other_specify']) ? $item['other_specify'] : ''); ?>"> </div>
						</div>
						</div>
					</div>
				

		<div class="col-md-5">

			<div class="row">
			<?php if (isset($index) && $index == 1) { ?>	
			<div class="col-md-4  bg-dgray mr-0 pr-0"><strong>{{ __('Total claim') }}</strong></div>
			<div class="col-md-4 bg-dgray mr-0 pr-0"><strong>{{ __('Priority amount') }}</strong></div>
			<div class="col-md-4 bg-dgray mr-0 pr-0"><strong>{{ __('Nonpriority amount') }}</strong></div>
			<?php } ?>

				<div class="col-md-4  mr-0 pr-0 mt-3">
					<div class="input-group d-flex ">
						<input name="<?php echo base64_encode($fieldName['totalClaim']); ?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['totalClaim'])] ?? (isset($item['total_claim']) ? Helper::priceFormtWithComma($item['total_claim']) : ''); ?>" class="price-field form-control" placeholder="$">
					</div>
				</div>
				<div class="col-md-4  mr-0 pr-0 mt-3">
					<div class="input-group d-flex ">
						<input name="<?php echo base64_encode($fieldName['priorityAmount']); ?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['priorityAmount'])] ?? (isset($item['priority_amount']) ? Helper::priceFormtWithComma($item['priority_amount']) : ''); ?>" class="price-field form-control" placeholder="$">
					</div>
				</div>
				<div class="col-md-4  mr-0 pr-0 mt-3">
					<div class="input-group d-flex ">
						<input name="<?php echo base64_encode($fieldName['nonpriorityAmount']); ?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['nonpriorityAmount'])] ?? (isset($item['unpariority_amount']) ? Helper::priceFormtWithComma($item['unpariority_amount']) : ''); ?>" class="price-field form-control" placeholder="$">
					</div>
				</div>


			<div class="col-md-12">
					<div class="input-group">
						<label><strong>{{ __('Who incurred the debt?') }}</strong> {{ __('Check
							one.') }}</label>
						
					</div>
					<?php
                        $c1 = $efPdfPart[base64_encode($fieldName['debtor'])] ?? null;
            $c2 = $efPdfPart[base64_encode($fieldName['debtor'])] ?? null;
            $c3 = $efPdfPart[base64_encode($fieldName['debtor'])] ?? null;
            $c4 = $efPdfPart[base64_encode($fieldName['debtor'])] ?? null;
            $dbvalues = [$c1,$c2,$c3,$c4];
            if (!empty(array_filter($dbvalues))) {
                unset($item['who_ensured_debt']);
            }
            $check1 = isset($efPdfPart[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efPdfPart, $fieldName['debtorA']) : Helper::validate_key_toggle('who_ensured_debt', $item, 1);
            $check2 = isset($efPdfPart[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efPdfPart, $fieldName['debtorB']) : Helper::validate_key_toggle('who_ensured_debt', $item, 2);
            $check3 = isset($efPdfPart[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efPdfPart, $fieldName['debtorAandB']) : Helper::validate_key_toggle('who_ensured_debt', $item, 3);
            $check4 = isset($efPdfPart[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efPdfPart, $fieldName['debtorOneOrAnother']) : Helper::validate_key_toggle('who_ensured_debt', $item, 4);
            ?>
					<div class="input-group">
						<input name="<?php echo base64_encode($fieldName['debtor']); ?>" type="checkbox" id="Debtor1" name="Debtor1" value="<?php echo($fieldName['debtorA']); ?>" <?php echo $check1;?>>
						<label for="Debtor1">{{ __('Debtor 1 only') }} </label>
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($fieldName['debtor']); ?>"  type="checkbox" id="Debtor2" name="Debtor2" value="<?php echo($fieldName['debtorB']); ?>" <?php echo $check2;?>>
						<label for="Debtor2">{{ __('Debtor 2 only') }} </label>
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($fieldName['debtor']); ?>"  type="checkbox" id="Debtor12" name="Debtor12" value="<?php echo($fieldName['debtorAandB']); ?>" <?php echo $check3;?>>
						<label for="Debtor12">{{ __('Debtor 1 and Debtor 2 only') }} </label>
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($fieldName['debtor']); ?>"  type="checkbox" id="another" name="another" value="<?php echo($fieldName['debtorOneOrAnother']); ?>" <?php echo $check4;?>>
						<label for="another">{{ __('At least one of the debtors and another') }} </label>{{ __('debtor') }}
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($fieldName['checkIfThisClaim']); ?>"  type="checkbox" id="claim" <?php echo isset($efPdfPart[base64_encode($fieldName['checkIfThisClaim'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['checkIfThisClaim']), $efPdfPart, 'On') : Helper::validate_key_toggle('is_community_debt', $item, 1);?> name="claim" value="On">
						<label for="claim">{{ __('Check if this claim relates to a
						community debt') }} </label>
					</div>

					<div class="input-group">
						<label><strong>{{ __('Is the claim subject to offset?') }} </strong></label><br>
						<input name="<?php echo base64_encode($fieldName['claimSubjectToOffset']); ?>" value="no" type="checkbox" <?php echo isset($efPdfPart[base64_encode($fieldName['claimSubjectToOffset'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['claimSubjectToOffset']), $efPdfPart, 'no') : Helper::validate_key_toggle('subject_to_offset', $item, 0);?> >
						<label>{{ __('No') }}</label>
					</div>
					<div class="input-group">
						 




						@php

						$claimSubjectToOffset_yes_seleted =   isset($efPdfPart[base64_encode($fieldName['claimSubjectToOffset'])])? Helper::validate_key_toggle(base64_encode($fieldName['claimSubjectToOffset']),$efPdfPart,'yes'):Helper::validate_key_toggle('subject_to_offset',$item,1);

						@endphp


				 		<x-checkbox type="checkbox"   name="<?php echo base64_encode($fieldName['claimSubjectToOffset']); ?>" id=""  label="{{ __('Yes')}}"   value="yes" selected="{{$claimSubjectToOffset_yes_seleted}}"></x-checkbox>






					</div>




			<div class="input-group">
				<label><strong>{{ __('As of the date you file, the claim is:') }}</strong>  {{ __('Check
					all
					that apply.') }}</label>
			</div>
			<div class="input-group">
				<input name="<?php echo base64_encode($fieldName['contingent']); ?>" value="On" type="checkbox" <?php echo isset($efPdfPart[base64_encode($fieldName['contingent'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['contingent']), $efPdfPart, 'On') : Helper::validate_key_toggle('on_date_file_claim_is', $item, 1);?>>
				<label>{{ __('Contingent') }} </label>
			</div>
			<div class="input-group">
				<input name="<?php echo base64_encode($fieldName['unliquidated']); ?>" value="On" type="checkbox" <?php echo isset($efPdfPart[base64_encode($fieldName['unliquidated'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['unliquidated']), $efPdfPart, 'On') : Helper::validate_key_toggle('on_date_file_claim_is', $item, 2);?>>
				<label>{{ __('Unliquidated') }} </label>
			</div>
			<div class="input-group">
				<input name="<?php echo base64_encode($fieldName['disputed']); ?>" value="On" type="checkbox" <?php echo isset($efPdfPart[base64_encode($fieldName['disputed'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['disputed']), $efPdfPart, 'On') : Helper::validate_key_toggle('on_date_file_claim_is', $item, 3);?>>
				<label>{{ __('Disputed') }} </label>
			</div>

			</div>

			</div>

		</div>

		<?php $index++;
        }
    } ?>
	</div>
	<h3 style="text-align:right;">Page {{$pagees}} of {{$totalefCountPages}} </h3>
	</div>	
	</form>
	<?php } ?>
	