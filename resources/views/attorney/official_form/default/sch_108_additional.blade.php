<?php
if (!empty($intdebtors)) { ?>
<form name="official_frm_108_pdf{{$part}}" class="official_108_form save_official_forms" id="official_frm_108_pdf{{$part}}" action="{{route('generate_official_pdf')}}" method="post">
@csrf    
	<input type="hidden" name="form_id" value="108_pdf{{$part}}">
	<input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b108_pdf'.$part.'.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b108_pdf'.$part.'.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('Case number0-108'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 1-108'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2-108'); ?>" value="<?php echo $spousename; ?>">
   
    <section class="page-section padd-20">
        <div class="container">
        <div class="col-md-12">
			<div class="part-form-title mb-3">
				<span>{{ __('Part 1') }}</span>
				<h2 class="font-lg-18">{{ __('List Your Creditors Who Have Secured Claims - Continuation Page') }} </h2>
			</div>
		</div>
            <div class="form-border mb-3">
            <div class="row  mt-3">
                                <div class="col-md-4 ">
                                    <div class=" column-heading">
                                    <h4>{{ __('Identify the creditor and the property that is collateral') }} </h4> </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class=" column-heading">
                                    <h4>{{ __('What do you intend to do with the property that
                                            secures a debt?') }}</h4> </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class=" column-heading">
                                    <h4>{{ __('Did you claim the property
                                            as exempt on Schedule C?') }}</h4> </div>
                                </div>
                            </div>
    <?php
    $codeCount = $index;
    $i = 1;

    foreach ($intdebtors as $prop) {
        ?>


<div class="col-md-12 border-bottm-1">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <label>{{ __('Creditor’s name:') }}</label>
                <input  name="<?php echo base64_encode('creditor'.$i); ?>" type="text" value="<?php echo Helper::validate_key_value('creditor_name', $prop); ?>" class="form-control"> </div>
            <div class="input-group">
                <label>{{ __('Description of property securing debt') }}</label>
                <textarea name="<?php echo base64_encode('description'.$i); ?>" id="" cols="20" rows="5" class="form-control"><?php echo Helper::validate_key_value('describe_secure_claim', $prop); ?></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input name="<?php echo base64_encode('surrender'.$i); ?>" <?php echo Helper::validate_key_toggle('retain_above_property', $prop, 0) ?> value="Yes" type="checkbox">
                <label>{{ __('Surrender the property') }}</label>
            </div>
            <div class="input-group">
                <input name="<?php echo base64_encode('redeem'.$i); ?>" value="Yes" type="checkbox" <?php echo Helper::validate_key_toggle('retain_above_property', $prop, 1) ?> >
                <label>{{ __('Retain the property and redeem it.') }}</label>
            </div>
            <div class="input-group">
                <input name="<?php echo base64_encode('enter'.$i); ?>" value="Yes"  type="checkbox">
                <label>{{ __('Retain the property and enter into a Reaffirmation Agreement.') }}</label>
            </div>
            <div class="input-group">
                <input name="<?php echo base64_encode('retain'.$i); ?>" value="Yes"  type="checkbox">
                <label>{{ __('Retain the property and [explain]:') }}</label>
                <input name="<?php echo base64_encode('explain'.$i.'_2'); ?>" type="text" value="" class="form-control"> </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input name="<?php echo base64_encode('Radio'.($i - 1)); ?>" value="r1" type="radio">
                <label>{{ __('No') }}</label>
            </div>
            <div class="input-group">
                <input name="<?php echo base64_encode('Radio'.($i - 1)); ?>" value="r2" type="radio">
                <label>{{ __('Yes') }}</label>
            </div>
        </div>
    </div>
</div>
<?php $i++;
        $codeCount++;
    }?>
</div>
</div>
<input type="hidden" name="<?php echo base64_encode('Text1')?>" value="{{$pageno}}">
<input type="hidden" name="<?php echo base64_encode('Text2')?>" value="{{$totalCountPages}}">
<h3 style="text-align:right;">Page {{$pageno}} of {{$totalCountPages}} </h3>					
    </section>
</form>
    <?php } ?>
