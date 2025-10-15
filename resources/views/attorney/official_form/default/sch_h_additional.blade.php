<?php
if (!empty($hdebtors)) { ?>
<form name="official_frm_106h_pdf{{$part}}" class="official_sch_h_form save_official_forms" id="official_frm_106h_pdf{{$part}}" action="{{route('generate_official_pdf')}}" method="post">
@csrf    
	<input type="hidden" name="form_id" value="106h_pdf{{$part}}">
	<input type="hidden" name="client_id" value="<?php echo $client_id;?>">
	
	<input type="hidden" name="sourcePDFName" value="<?php echo 'form_106h_pdf'.$part.'.pdf'; ?>">
	<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_106h_pdf'.$part.'.pdf'; ?>">
	<input type="hidden" name="<?php echo base64_encode('Case number#0-106H'); ?>" value="<?php echo $caseno; ?>">
	<input type="hidden" name="<?php echo base64_encode('Debtor 1#0-106H'); ?>" value="<?php echo $onlyDebtor; ?>">
	<input type="hidden" name="<?php echo base64_encode('Debtor 2-106H'); ?>" value="<?php echo $spousename; ?>">
	<?php $schaddH = isset($dynamicPdfData['106h_pdf'.$part]) && !empty($dynamicPdfData['106h_pdf'.$part]) ? json_decode($dynamicPdfData['106h_pdf'.$part], 1) : null;?>
		<div class="col-md-12">
			<div class="part-form-title mb-3">
				<span>&nbsp;</span>
				<h2 class="font-lg-18">{{ __('Additional Page to List More Codebtors') }} </h2>
			</div>
		</div>

	<div class="form-border mb-3">

		<div class="col-md-7 column-heading">
			<div class="input-group ">
				<label><strong class="mb-0"><i>{{ __('Column 1') }}</i>{{ __(': Your codebtor') }}</strong> </label>
			</div>
		</div>
		<div class="col-md-5 column-heading">
			<div class="input-group ">
				<label><strong class="mb-0"><i>{{ __('Column 2') }}</i>{{ __(': The creditor to whom you
				owe
				the
				debt') }}<br>
				{{ __('Check all schedules that apply:') }} </strong> </label>
			</div>
		</div>

	<!-- 3.1 Row -->
    <?php
    $codeCount = $index;
    $its = 4;
    foreach ($hdebtors as $debt) {
        $borderClass = 'border-bottm-1';
        ?>
	<div class="<?php echo $borderClass;?>">
		<div class="row">
		<div class="col-md-9"> <strong><input type="text" readonly name="<?php echo base64_encode('fill 3.'.$its.'-106H'); ?>"  class="square" value="3.<?php echo $codeCount; ?>">
		<input type="hidden" name="<?php echo base64_encode('fill 3.'.$its.'-106H'); ?>"  class="square" value="<?php echo $codeCount; ?>">
	</strong> </div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<label>{{ __('Name') }} </label>
						<input name="<?php echo base64_encode('Codebtor Name 3.'.$its.'-106H');?>" type="text" value="<?php echo $schaddH[base64_encode('Codebtor Name 3.'.$its.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_name', $debt); ?>" class="form-control"> </div>
				</div>
				<div class="col-md-12">
					<div class="input-group">
						<label>{{ __('Street Address') }}</label>
						<input name="<?php echo base64_encode('Codebtor Street 3.'.$its.'-106H');?>" type="text" value="<?php echo $schaddH[base64_encode('Codebtor Street 3.'.$its.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_name_addresss', $debt); ?>" class="form-control"> </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<div class="input-group">
						<label>{{ __('City') }}</label>
						<input name="<?php echo base64_encode('Codebtor City 3.'.$its.'-106H');?>" type="text" value="<?php echo $schaddH[base64_encode('Codebtor City 3.'.$its.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_city', $debt); ?>" class="form-control"> </div>
				</div>
				<div class="col-md-2 pl-0 pr-0">
					<div class="input-group">
						<label>{{ __('State') }}</label>
						<input name="<?php echo base64_encode('Codebtor State 3.'.$its.'-106H');?>" type="text" value="<?php echo $schaddH[base64_encode('Codebtor State 3.'.$its.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_state', $debt); ?>" class="form-control"> </div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<label>{{ __('Zip Code') }}</label>
						<input name="<?php echo base64_encode('Codebtor Zip 3.'.$its.'-106H');?>" type="text" value="<?php echo $schaddH[base64_encode('Codebtor Zip 3.'.$its.'-106H')] ?? Helper::validate_key_value('codebtor_creditor_zip', $debt); ?>" class="form-control"> </div>
				</div>
			</div>
		</div>
		<?php
            $c1 = $schaddH[base64_encode('check schedule line D 3.'.$its.'-106H')] ?? null;
        $c2 = $schaddH[base64_encode('check schedule line E/F 3.'.$its.'-106H')] ?? null;
        $c3 = $schaddH[base64_encode('check schedule line G 3.'.$its.'-106H')] ?? null;
        $dbvalues = [$c1,$c2,$c3];
        if (!empty(array_filter($dbvalues))) {
            unset($debt['part']);
        }
        $check1 = isset($schaddH[base64_encode('check schedule line D 3.'.$its.'-106H')]) ? Helper::validate_key_toggle(base64_encode('check schedule line D 3.'.$its.'-106H'), $schaddH, 'yes') : Helper::validate_key_toggle('part', $debt, 1);
        $check2 = isset($schaddH[base64_encode('check schedule line E/F 3.'.$its.'-106H')]) ? Helper::validate_key_toggle(base64_encode('check schedule line E/F 3.'.$its.'-106H'), $schaddH, 'yes') : Helper::validate_key_toggle('part', $debt, 2);
        $check3 = isset($schaddH[base64_encode('check schedule line G 3.'.$its.'-106H')]) ? Helper::validate_key_toggle(base64_encode('check schedule line G 3.'.$its.'-106H'), $schaddH, 'yes') : Helper::validate_key_toggle('part', $debt, 3);
        ?>
		<div class="col-md-4 mt-3">
			<div class="input-group d-flex">
				<input name="<?php echo base64_encode('check schedule line D 3.'.$its.'-106H');?>" value="yes" <?php echo $check1?> type="checkbox">
				<label for="" class="w100">{{ __('Schedule D, line') }}</label>
				<input name="<?php echo base64_encode('Schedule line D 3.'.$its.'-106H');?>"  type="text" class="form-control" value="<?php  echo isset($schaddH[base64_encode('Schedule line D 3.'.$its.'-106H')]) ? $schaddH[base64_encode('Schedule line D 3.'.$its.'-106H')] : ((Helper::validate_key_value('part', $debt) == 1) ? Helper::validate_key_value('fromLine', $debt) : ''); ?>" /> </div>
			<div class="input-group d-flex">
				<input name="<?php echo base64_encode('check schedule line E/F 3.'.$its.'-106H');?>" value="yes"  <?php echo $check2?> type="checkbox">
				<label for="" class="w100">{{ __('Schedule E/F, line') }}</label>
				<input name="<?php echo base64_encode('Schedule line E/F 3.'.$its.'-106H');?>"  type="text" class="form-control" value="<?php  echo isset($schaddH[base64_encode('Schedule line E/F 3.'.$its.'-106H')]) ? $schaddH[base64_encode('Schedule line E/F 3.'.$its.'-106H')] : ((Helper::validate_key_value('part', $debt) == 2) ? Helper::validate_key_value('fromLine', $debt) : ''); ?>" /> </div>
			<div class="input-group d-flex">
				<input name="<?php echo base64_encode('check schedule line G 3.'.$its.'-106H');?>" value="yes" <?php echo $check3?> type="checkbox">
				<label for="" class="w100">{{ __('Schedule G, line') }}</label>
				<input name="<?php echo base64_encode('Schedule line G 3.'.$its.'-106H');?>"  type="text" class="form-control" value="<?php  echo isset($schaddH[base64_encode('Schedule line G 3.'.$its.'-106H')]) ? $schaddH[base64_encode('Schedule line G 3.'.$its.'-106H')] : ((Helper::validate_key_value('part', $debt) == 3) ? Helper::validate_key_value('fromLine', $debt) : ''); ?>" /> </div>
		</div>
	</div>
	</div>
	<input type="hidden" name="<?php echo base64_encode('fill_27.1.0-106H'); ?>" value="<?php echo $pageno;?>">
				<input type="hidden" name="<?php echo base64_encode('fill_27.1.1-106H'); ?>" value="<?php echo $totalpages;?>">
        <?php $its++;
        $codeCount++;
    }?>
	
	</div>
</form>
    <?php } ?>
	
