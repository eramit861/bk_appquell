<?php
if (!empty($inSch)) { ?>
<form name="official_frm_106c_add_{{$part}}" class="106c_add official_frm_106c save_official_forms" id="official_frm_106c_add_{{$part}}" action="{{route('generate_official_pdf')}}" method="post">
@csrf    
	<input type="hidden" name="form_id" value="106c_add_{{$part}}">
	<input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b_106c_add_'.$part.'.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b_106c_add_'.$part.'.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_106-Case number'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_106-Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_106-Debtor 2'); ?>" value="<?php echo $spousename; ?>">
<section class="106c_add page-section padd-20">
<?php $cAddMain = isset($dynamicPdfData['106c_add_'.$part]) && !empty($dynamicPdfData['106c_add_'.$part]) ? json_decode($dynamicPdfData['106c_add_'.$part], 1) : null;?>

<div class="106c_add container">
        <div class="106c_add row align-items-center">
                <div class="106c_add col-md-12">
                    <div class="106c_add part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                        <h2 class="106c_add font-lg-18">{{ __('Additional Page') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="106c_add form-border pl-0 pr-0 mb-3 {{count($inSch)}}">
                <table class="106c_add table custom-table">
                    <tr class="106c_add column-heading">
                        <td style="width:20%;">
                            <div class="106c_add input-group"> <strong>{{ __('Brief description of the property and line on
                                    Schedule A/B that lists this property') }}</strong> </div>
                        </td>
                        <td style="width:20%;">
                            <div class="106c_add input-group"> <strong>{{ __('Current value of the
                                    portion you own') }}</strong>
                                <p>{{ __('Copy the value from Schedule A/B') }}</p>
                            </div>
                        </td>
                        <td style="width:20%;">
                            <div class="106c_add input-group"> <strong>{{ __('Amount of the exemption you claim') }}</strong> <i>{{ __('Check only one box for each exemption') }}</i> </div>
                        </td>
                        <td style="width:40%;">
                            <div class="106c_add input-group"> <strong>{{ __('Specific laws that allow exemption') }}</strong> </div>
                        </td>
                    </tr>
                    <tbody>
        <?php
        $page = 1;

    $codeCount = $index;
    $iy = 1;
    foreach ($inSch as $schcadd) {
        $sch2Name = LocalFormHelper::schedule_c_part2($iy);
        ?>

<tr>
        <td style="width:20%;">
            <div class="106c_add input-group">
                    <label class="106c_add font-lg-14">{{ __('Brief description:') }}</label>
                <div class="106c_add input-group">
                    <textarea name="<?php echo base64_encode($sch2Name['description']); ?>"  cols="15" rows="3" class="106c_add form-control"><?php echo $cAddMain[base64_encode($sch2Name['description'])] ?? Helper::validate_key_value('description', $schcadd);?></textarea>
                </div>
            </div>
            <div class="106c_add input-group d-flex">
                    <label class="106c_add font-lg-14 align-center-scc">{{ __('Line from Schedule A/B:') }}</label>
                <div class="106c_add input-group size-boxscc">
                    <input name="<?php echo base64_encode($sch2Name['line']); ?>" type="text" value="<?php echo $cAddMain[base64_encode($sch2Name['line'])] ?? (Helper::validate_key_value('form_ab_line_no', $schcadd)); ?>" class="106c_add form-control"> </div>
            </div>
        </td>
        <td style="width:20%;"> 
            <div class="106c_add input-group d-flex">
                    <div class="106c_add input-group-append"> <span class="106c_add input-group-text" id="basic-addon2">$</span> </div>
                <input data-pricecurrent = "<?php echo Helper::validate_key_value('form_ab_line_no', $schcadd);?>" name="<?php echo base64_encode($sch2Name['currentValue']); ?>" type="text" value="<?php echo $cAddMain[base64_encode($sch2Name['currentValue'])] ?? (isset($schcadd['property_value']) ? $schcadd['property_value'] : ''); ?>" class="106c_add price-field form-control"> </div>
        </td>
        <td style="width:20%;">
            <div class="106c_add input-group d-flex">
                    <input name="<?php echo base64_encode($sch2Name['claimCheckbox']); ?>" checked="checked" value="On" type="checkbox" <?php echo isset($cAddMain[base64_encode($sch2Name['claimCheckbox'])]) ? Helper::validate_key_toggle(base64_encode($sch2Name['claimCheckbox']), $cAddMain, 'On') : '';?>>
                    <div class="106c_add input-group-append"> <span class="106c_add input-group-text" id="basic-addon2">$</span> </div>
                    <input data-priceclaim = "<?php echo Helper::validate_key_value('form_ab_line_no', $schcadd);?>" name="<?php echo base64_encode($sch2Name['claimValue']); ?>" type="text" value="<?php echo $cAddMain[base64_encode($sch2Name['claimValue'])] ?? (isset($schcadd['property_value']) ? $schcadd['property_value'] : ''); ?>" class="106c_add price-field form-control"> </div>
            <div class="106c_add input-group d-flex">
                    <input name="<?php echo base64_encode($sch2Name['claimCheckbox']); ?>" value="fair market" type="checkbox" <?php echo isset($cAddMain[base64_encode($sch2Name['claimCheckbox'])]) ? Helper::validate_key_toggle(base64_encode($sch2Name['claimCheckbox']), $cAddMain, 'fair market') : '';?>>
                    <label for=""> {{ __('100% of fair market value, up to any applicable statutory limit') }} </label>
            </div>
        </td>
        <td style="width:40%;">
            <div class="106c_add input-group" >
                <div data-cs="<?php echo Helper::validate_key_value('form_ab_line_no', $schcadd); ?>" data-pagefrom="{{$pageno}}" class="106c_add exemp_select linefromdb_<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schcadd));?> linefrom_<?php echo floor(Helper::validate_key_value('form_ab_line_no', $schcadd, 'float'));?>"  data-linefrom = "<?php echo Helper::validate_key_value('form_ab_line_no', $schcadd);?>" data-lineufrom = "<?php echo str_replace(".", "_", Helper::validate_key_value('form_ab_line_no', $schcadd));?>"  data-optionid="<?php echo Helper::validate_key_value('property_value', $schcadd, 'comma');?>"></div>
                @include("components.exemtionPopup")
                <textarea data-exemption = "<?php echo Helper::validate_key_value('form_ab_line_no', $schcadd);?>"  name="<?php echo base64_encode($sch2Name['law']); ?>"  cols="15" rows="4" class="106c_add form-control exemption-by-attorney <?php echo('law_'.floor(Helper::validate_key_value('form_ab_line_no', $schcadd, 'float')));?>"><?php echo $cAddMain[base64_encode($sch2Name['law'])] ?? '';?></textarea>
                <input type="hidden" name="linefrom_<?php echo floor(Helper::validate_key_value('form_ab_line_no', $schcadd, 'float'));?>" value="0">
            <?php
            $string = "hiddenlinefrom_".str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schcadd));
        $linefromdb = $cAddMain[$string] ?? '';

        ?>
           
                <input data-lval="{{$linefromdb}}" data-line="<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schcadd)); ?>" type="hidden" data-linefrom="<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schcadd));?>" class="106c_add sc_c_description" name="{{$string}}" value="<?php echo $linefromdb; ?>">

            </div>
        </td>
    </tr>
    <?php $iy++;
        $codeCount++;
    } ?>
    <input type="hidden" name="<?php echo base64_encode('B_106-page 2'); ?>" value="{{$pageno}}">
    <input type="hidden" name="<?php echo base64_encode('B_106-page') ?>" value="{{$totalpages}}">
        </tbody>
        </table>
        <h3 style="text-align:right;">Page {{$pageno}} of {{$totalpages}} </h3>
</div>
</section>
</form>
    <?php } ?>
