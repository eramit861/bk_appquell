<?php if (isset($domestic_tax) && !empty($domestic_tax)) {


    ?>

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
   <?php $efPdfPart = isset($dynamicPdfData[$pdfName]) && !empty($dynamicPdfData[$pdfName]) ? json_decode($dynamicPdfData[$pdfName], 1) : null; ?>
   
   <div class="row align-items-center">
<div class="col-md-12">
<div class="part-form-title mb-3">
   <span>{{ __('Part 3') }}</span>
   <h2 class="font-lg-18">{{ __('List Others to Be Notified About a Debt That You
       Already
       Listed') }}
   </h2> </div>
</div>
</div>
<!-- Row 2 -->
<div class="form-border mb-3 ">
<div class="row">
   <div class="col-md-12 mb-3">
       <div class="input-group"> <strong>{{ __('5. Use this page only if you have others to be notified about
           your
           bankruptcy, for a debt that you already listed in Parts 1 or 2. For
           example, if a collection agency is trying to collect from you for a
           debt
           you owe to someone else, list the original creditor in Parts 1 or
           2, then list the collection agency here. Similarly, if you have more
           than one creditor for any of the debts that you listed in Parts 1 or
           2,
           list the
           additional creditors here. If you do not have additional persons to
           be
           notified for any debts in Parts 1 or 2, do not fill out or submit
           this
           page') }}</strong> </div>
   </div>
</div>

<?php
$i = 1;
    foreach ($domestic_tax as $value) {
        $fieldName = LocalFormHelper::schedule_ef_part_3($i);
        ?>
<div class="row <?php if ($i != count($domestic_tax)) {
    echo "border-bottm-1";
} ?>">
   <input type="hidden" attr="fill_27.1.6" name="<?php echo base64_encode('fill_27.1.6')?>" value="{{$pageno}}">
   <input type="hidden" attr="fill_27.1.7" name="<?php echo base64_encode('fill_27.1.7')?>" value="{{$totalpageno}}">
   <div class="col-md-5">
       <div class="row">
           <div class="col-md-12">
               <div class="input-group">
                   <label>{{ __('Name') }} </label>
                   <input id="<?php echo($i);?>" name="<?php echo base64_encode($fieldName['creditorName']);?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['creditorName'])] ?? Helper::validate_key_value('codebtor_creditor_name', $value);?>" class="form-control"> </div>
               <div class="row">
                   <div class="col-md-12">
                       <div class="input-group">
                           <label>{{ __('Street') }}</label>
                           <input name="<?php echo base64_encode($fieldName['addressLineA']);?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['addressLineA'])] ?? Helper::validate_key_value('codebtor_creditor_name_addresss', $value);?>" class="form-control"> </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-6">
                       <div class="input-group">
                           <label>{{ __('City') }}</label>
                           <input name="<?php echo base64_encode($fieldName['city']);?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['city'])] ?? Helper::validate_key_value('codebtor_creditor_city', $value);?>" class="form-control"> </div>
                   </div>
                   <div class="col-md-6">
                       <div class="input-group">
                           <label>{{ __('State') }}</label>
                           <input name="<?php echo base64_encode($fieldName['state']);?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['state'])] ?? Helper::validate_key_value('codebtor_creditor_state', $value);?>" class="form-control"> </div>
                   </div>
                   <div class="col-md-12">
                       <div class="input-group">
                           <label>{{ __('Zip Code') }}</label>
                           <input name="<?php echo base64_encode($fieldName['zip']);?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['zip'])] ?? Helper::validate_key_value('codebtor_creditor_zip', $value);?>" class="form-control"> </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="col-md-7">
       <div class="input-group">
           <label><strong>{{ __('On which entry in Part 1 or Part 2 did you list the
           original
           creditor?') }} </strong> </label>
       </div>
       <div class="row">
           <div class="col-md-5">
               <div class="input-group">
                   <label>{{ __('Line of (Check one):') }}</label>
                   <input name="<?php echo base64_encode($fieldName['lineOf']);?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['lineOf'])] ?? Helper::validate_key_value('fromLine', $value);?>" class="form-control"> </div>
           </div>
           <div class="col-md-7">
               <?php
                   $c1 = $efPdfPart[base64_encode($fieldName['checkPriority'])] ?? null;
        $c2 = $efPdfPart[base64_encode($fieldName['checkPriority'])] ?? null;
        $dbvalues = [$c1,$c2];
        if (!empty(array_filter($dbvalues))) {
            unset($value['part']);
        }
        $check1 = isset($efPdfPart[base64_encode($fieldName['checkPriority'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['checkPriority']), $efPdfPart, 'Part 1') : Helper::validate_key_toggle('part', $value, 'Part 1');
        $check2 = isset($efPdfPart[base64_encode($fieldName['checkPriority'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['checkPriority']), $efPdfPart, 'yes') : Helper::validate_key_toggle('part', $value, 'yes');
        ?>
               <div class="input-group">
                   <input name="<?php echo base64_encode($fieldName['checkPriority']);?>" type="checkbox" value="Part 1" <?php echo $check1;?>>
                   <label> {{ __('Part 1: Creditors with Priority Unsecured Claims') }}</label>
               </div>
               <div class="input-group">
                   <input name="<?php echo base64_encode($fieldName['checkPriority']);?>" type="checkbox" value="yes" <?php echo $check2;?>>
                   <label>{{ __('Part 2: Creditors with Nonpriority Unsecured Claims') }}</label>
               </div>
           </div>
           <div class="col-md-12">
               <label><strong>{{ __('Last 4 digits of acct #') }}</strong> </label>
               <input name="<?php echo base64_encode($fieldName['last4Digits']);?>" type="text" value="<?php echo $efPdfPart[base64_encode($fieldName['last4Digits'])] ?? Helper::validate_key_value('account_number', $value);?>" class="form-control"> </div>
       </div>
   </div>
</div>
<?php $i++;
    } ?>
<h3 style="text-align:right;">Page {{$pageno}} of {{$totalpageno}} </h3>
</div>
</form>

<?php } ?>