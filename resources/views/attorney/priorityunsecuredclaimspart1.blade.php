<div class="row align-items-center mt-3">
<div class="col-md-12">
	<div class="part-form-title mb-3">
		<span>{{ __('Part 1') }}</span>
		<h2 class="font-lg-18">{{ __('Your PRIORITY Unsecured Claims ─ Continuation Page') }}
		</h2>
	</div>
</div>
</div>
<div class="form-border <?php if (isset($isfirst) && $isfirst == false) {
    echo 'bt-none';
} ?> <?php if (isset($last) && $last == true) {
    echo 'mb-3';
} ?>">
<div class="row column-heading pl-0 pr-0">
<?php $class = '';
$index = 1;
$part1fieldName = [];
foreach ($taxes as $item) {
    $part1fieldName = LocalFormHelper::SchdEFPage2($index);
    // print_r($index);
    $no = $item['sq_no'];
    $pageno = '2';
    $item['subject_to_offset'] = 0;
    if (isset($part1fieldName['noBox'])) {
        ?>		
				<div class="col-md-7">
							<input type="hidden" name="<?php echo base64_encode('fill_27.1.0')?>" value="2">
							<input type="hidden" name="<?php echo base64_encode('fill_27.1.1')?>" value="{{$totalefCountPages}}">
							
							
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
						</div>
						
						<div class="col-md-12 mt-3">
						<input name="<?php echo base64_encode($part1fieldName['noBox']); ?>" readonly class="square" value="2.<?php echo $item['sq_no']; ?>"> 
						
							<div class="input-group">
								<label>{{ __('Priority Creditor’s Name') }} </label>
								<input name="<?php echo base64_encode($part1fieldName['creditorName']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['creditorName'])] ?? (isset($item['creditor_name']) ? $item['creditor_name'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-12">
							<div class="input-group">
								<label>{{ __('Address') }}</label>
								<input name="<?php echo base64_encode($part1fieldName['addressLineA']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['addressLineA'])] ?? (isset($item['address_line1']) ? $item['address_line1'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-12">
							<div class="input-group">
								<label>{{ __('Address 2') }}</label>
								<input name="<?php echo base64_encode($part1fieldName['addressLineB']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['addressLineB'])] ?? (isset($item['address_line2']) ? $item['address_line2'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<label>{{ __('City') }}</label>
								<input name="<?php echo base64_encode($part1fieldName['city']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['city'])] ?? (isset($item['city']) ? $item['city'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<label>{{ __('State') }}</label>
								<input name="<?php echo base64_encode($part1fieldName['state']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['state'])] ?? (isset($item['state']) ? $item['state'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<label>{{ __('Zip Code') }}</label>
								<input name="<?php echo base64_encode($part1fieldName['zip']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['zip'])] ?? (isset($item['zip']) ? $item['zip'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<label><strong>{{ __('Last 4 digits of acct #') }}</strong> </label>
								<input name="<?php echo base64_encode($part1fieldName['last4Digits']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['last4Digits'])] ?? (isset($item['last4Digits']) ? $item['last4Digits'] : ''); ?>" class="form-control"> </div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<label><strong>{{ __('When debt incurred?:') }}</strong> </label>
								<input name="<?php echo base64_encode($part1fieldName['whenDebtIncurred']); ?>" type="text" value="<?php echo $efMain[base64_encode($part1fieldName['whenDebtIncurred'])] ?? $item['year'];?>" class="form-control"> </div>
						</div>
						<div class="col-md-12">
							<div class="input-group">
								<label><strong>{{ __('Type of PRIORITY unsecured claim:') }}</strong> </label>
							</div>
							<?php
                                $c1 = $efMain[base64_encode($part1fieldName['priorityTypeA'])] ?? null;
        $c2 = $efMain[base64_encode($part1fieldName['priorityTypeB'])] ?? null;
        $c3 = $efMain[base64_encode($part1fieldName['priorityTypeC'])] ?? null;
        $c4 = $efMain[base64_encode($part1fieldName['priorityTypeD'])] ?? null;
        $dbvalues = [$c1,$c2,$c3,$c4];
        if (!empty(array_filter($dbvalues))) {
            unset($item['claim_type']);
        }
        $check1 = isset($efMain[base64_encode($part1fieldName['priorityTypeA'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['priorityTypeA']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $item, 1);
        $check2 = isset($efMain[base64_encode($part1fieldName['priorityTypeB'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['priorityTypeB']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $item, 2);
        $check3 = isset($efMain[base64_encode($part1fieldName['priorityTypeC'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['priorityTypeC']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $item, 3);
        $check4 = isset($efMain[base64_encode($part1fieldName['priorityTypeD'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['priorityTypeD']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $item, 4);
        ?>
							<div class="input-group">
								<?php //print_r($efMain);?>
								<input name="<?php echo base64_encode($part1fieldName['priorityTypeA']); ?>" class="ef_domestic_support_obligation" value="On" type="checkbox" <?php echo $check1;?>>
								<label>{{ __('Domestic support obligations') }} </label>
							</div>
							<div class="input-group">
								<input name="<?php echo base64_encode($part1fieldName['priorityTypeB']); ?>" class="ef_taxes_other_debts" value="On" type="checkbox" <?php echo $check2;?>>
								<label>{{ __('Taxes and certain other debts you owe the government') }} </label>
							</div>
							<div class="input-group">
								<input name="<?php echo base64_encode($part1fieldName['priorityTypeC']); ?>" class="ef_death_personal_claim" value="On" type="checkbox" <?php echo $check3;?>>
								<label>{{ __('Claims for death or personal injury while you were intoxicated') }} </label>
							</div>
							<div class="input-group">
								<input name="<?php echo base64_encode($part1fieldName['priorityTypeD']); ?>" value="On"  type="checkbox" <?php echo $check4;?>>
								<label>{{ __('Other. Specify') }} </label>
								<input  name="<?php echo base64_encode($part1fieldName['priorityTypeOtherText']); ?>"  type="text" class="form-control l-w" value="<?php echo $efMain[base64_encode($part1fieldName['priorityTypeOtherText'])] ?? $item['other_specify'];?>"> </div>
						</div>
						</div>
					</div>
				

		<div class="col-md-5 ml-0 pl-0">

			<div class="row">
			<?php if (isset($index) && $index == 1) { ?>	
			<div class="col-md-4 bg-dgray mr-0 pr-0"><strong>{{ __('Total claim') }}</strong></div>
			<div class="col-md-4  bg-dgray mr-0 pr-0"><strong>{{ __('Priority amount') }}</strong></div>
			<div class="col-md-4 bg-dgray mr-0 pr-0"><strong>{{ __('Nonpriority amount') }}</strong></div>
			<?php } ?>

				<div class="col-md-4  mr-0 pr-0 mt-3">
					<div class="input-group d-flex ">
						<input name="<?php echo base64_encode($part1fieldName['totalClaim']); ?>" type="text" value="<?php  echo Helper::priceFormtWithComma($efMain[base64_encode($part1fieldName['totalClaim'])] ?? $item['total_claim']);?>" class="price-field form-control" placeholder="$">
					</div>
				</div>
				<div class="col-md-4  mr-0 pr-0 mt-3">
					<div class="input-group d-flex ">
						<input name="<?php echo base64_encode($part1fieldName['priorityAmount']); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($efMain[base64_encode($part1fieldName['priorityAmount'])] ?? $item['priority_amount']);?>" class="price-field form-control" placeholder="$">
					</div>
				</div>
				<div class="col-md-4  mr-0 pr-0 mt-3">
					<div class="input-group d-flex ">
						<input name="<?php echo base64_encode($part1fieldName['nonpriorityAmount']); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($efMain[base64_encode($part1fieldName['nonpriorityAmount'])] ?? $item['unpariority_amount']);?>" class="price-field form-control" placeholder="$">
					</div>
				</div>


			<div class="col-md-12">
					<div class="input-group">
						<label><strong>{{ __('Who incurred the debt?') }}</strong> {{ __('Check
							one.') }}</label>
					</div>
					<?php
                        $c1 = $efMain[base64_encode($part1fieldName['debtor'])] ?? null;
        $c2 = $efMain[base64_encode($part1fieldName['debtor'])] ?? null;
        $c3 = $efMain[base64_encode($part1fieldName['debtor'])] ?? null;
        $c4 = $efMain[base64_encode($part1fieldName['debtor'])] ?? null;
        $dbvalues = [$c1,$c2,$c3,$c4];
        if (!empty(array_filter($dbvalues))) {
            unset($item['who_ensured_debt']);
        }
        $check1 = isset($efMain[base64_encode($part1fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['debtor']), $efMain, $part1fieldName['debtorA']) : Helper::validate_key_toggle('who_ensured_debt', $item, 1);
        $check2 = isset($efMain[base64_encode($part1fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['debtor']), $efMain, $part1fieldName['debtorB']) : Helper::validate_key_toggle('who_ensured_debt', $item, 2);
        $check3 = isset($efMain[base64_encode($part1fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['debtor']), $efMain, $part1fieldName['debtorAandB']) : Helper::validate_key_toggle('who_ensured_debt', $item, 3);
        $check4 = isset($efMain[base64_encode($part1fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['debtor']), $efMain, $part1fieldName['debtorOneOrAnother']) : Helper::validate_key_toggle('who_ensured_debt', $item, 4);
        ?>
					<div class="input-group">
						<input name="<?php echo base64_encode($part1fieldName['debtor']); ?>" type="checkbox" id="Debtor1" name="Debtor1" value="<?php echo($part1fieldName['debtorA']); ?>" <?php echo $check1;?>>
						<label for="Debtor1">{{ __('Debtor 1 only') }} </label>
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($part1fieldName['debtor']); ?>"  type="checkbox" id="Debtor2" name="Debtor2" value="<?php echo($part1fieldName['debtorB']); ?>" <?php echo $check2;?>>
						<label for="Debtor2">{{ __('Debtor 2 only') }} </label>
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($part1fieldName['debtor']); ?>"  type="checkbox" id="Debtor12" name="Debtor12" value="<?php echo($part1fieldName['debtorAandB']); ?>" <?php echo $check3;?>>
						<label for="Debtor12">{{ __('Debtor 1 and Debtor 2 only') }} </label>
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($part1fieldName['debtor']); ?>"  type="checkbox" id="another" name="another" value="<?php echo($part1fieldName['debtorOneOrAnother']); ?>" <?php echo $check4;?>>
						<label for="another">{{ __('At least one of the debtors and another') }} </label>
					</div>

					<div class="input-group">
						<input name="<?php echo base64_encode($part1fieldName['checkIfThisClaim']); ?>"  type="checkbox" id="claim" <?php echo isset($efMain[base64_encode($part1fieldName['checkIfThisClaim'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['checkIfThisClaim']), $efMain, 'On') : '';?><?php echo Helper::validate_key_toggle('is_community_debt', $item, 1);?> name="claim" value="On">
						<label for="claim">{{ __('Check if this claim relates to a
						community debt') }} </label>
					</div>

					<div class="input-group">
						<label><strong>{{ __('Is the claim subject to offset?') }} </strong></label><br>
						<input id="<?php echo($part1fieldName['claimSubjectToOffset']); ?>" name="<?php echo base64_encode($part1fieldName['claimSubjectToOffset']); ?>" value="no" type="checkbox" <?php echo isset($efMain[base64_encode($part1fieldName['claimSubjectToOffset'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['claimSubjectToOffset']), $efMain, 'no') : Helper::validate_key_toggle('subject_to_offset', $item, 0);?> >
						<label>{{ __('No') }}</label>
					</div>
					<div class="input-group">
						@php
						$part1fieldToOffset_yes_seleted =   isset($efMain[base64_encode($part1fieldName['claimSubjectToOffset'])])? Helper::validate_key_toggle(base64_encode($part1fieldName['claimSubjectToOffset']),$efMain,'yes'):Helper::validate_key_toggle('subject_to_offset',$item,1);
						@endphp
				 		<x-checkbox 
							type="checkbox" 
							name="{{  base64_encode($part1fieldName['claimSubjectToOffset']) }}" 
							id="{{ $part1fieldName['claimSubjectToOffset'] }}"  
							label="Yes" value="yes" 
							selected="{{  $part1fieldToOffset_yes_seleted }}">
						</x-checkbox>
					</div>




			<div class="input-group">
				<label><strong>{{ __('As of the date you file, the claim is:') }}</strong>  {{ __('Check
					all
					that apply.') }}</label>
			</div>
			<div class="input-group">
				<input name="<?php echo base64_encode($part1fieldName['contingent']); ?>" value="On" type="checkbox" <?php echo isset($efMain[base64_encode($part1fieldName['contingent'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['contingent']), $efMain, 'On') : '';?><?php echo Helper::validate_key_toggle('on_date_file_claim_is', $item, 1);?>>
				<label>{{ __('Contingent') }} </label>
			</div>
			<div class="input-group">
				<input name="<?php echo base64_encode($part1fieldName['unliquidated']); ?>" value="On" type="checkbox" <?php echo isset($efMain[base64_encode($part1fieldName['unliquidated'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['unliquidated']), $efMain, 'On') : '';?><?php echo Helper::validate_key_toggle('on_date_file_claim_is', $item, 2);?>>
				<label>{{ __('Unliquidated') }} </label>
			</div>
			<div class="input-group">
				<input name="<?php echo base64_encode($part1fieldName['disputed']); ?>" value="On" type="checkbox" <?php echo isset($efMain[base64_encode($part1fieldName['disputed'])]) ? Helper::validate_key_toggle(base64_encode($part1fieldName['disputed']), $efMain, 'On') : '';?><?php echo Helper::validate_key_toggle('on_date_file_claim_is', $item, 3);?>>
				<label>{{ __('Disputed') }} </label>
			</div>

			</div>

			</div>

		</div>

		<?php $index++;
    }
} ?>

		

	</div>
	<h3 style="text-align:right;">Page 2 of {{$totalefCountPages}} </h3>
	</div>