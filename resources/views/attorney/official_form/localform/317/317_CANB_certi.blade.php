<div class="row">
<div class="col-md-12 text-center mb30"><h3>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br>
<i>{{ __('for the') }} </i><br>
{{ __('NORTHERN DISTRICT OF CALIFORNIA') }} <br>
{{ __('OAKLAND, SAN FRANCISCO & SANTA ROSA DIVISIONS') }} </h3></div>

<div class="col-md-6 mt-3">
    <div class="input-group" style="border-right:2px solid black;border-bottom:2px solid black;">
        <label>{{ __('In Re:') }}</label>
        <textarea name="<?php echo base64_encode('Text17'); ?>" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        {{ __('Debtor(s)') }} 
    </div>
</div>
<div class="col-md-6 mt-3">
<div class="d-flex input-group">
        <label style="width:175px;margin-top:7px;">{{ __('CHAPTER 13 CASE:') }}</label>
        <input name="<?php echo base64_encode('Text18'); ?>" class="form-control" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>">
    </div>
   <h3> {{ __('CERTIFICATION OF DOMESTIC') }} <br>
{{ __('SUPPORT OBLIGATION PAYEES') }} </h3>
</div>


<div class="col-md-12">
    <p>{{ __('To Trustee:') }} </p>
    <p class="">
 {{ __('I have been required by a judicial or administrative order, or by statue to pay a domestic support 
 obligation, as defined in 11 U.S.C. §101(14A), whether prior to or after I filed this case.  I certify 
 that  prior  to  the  date  of  this  certification,  I  have  paid  all  amounts  due  under  any  Court  ordered  
 domestic  support  obligation,  as  defined  in  11  U.S.C.  §101(14A).    All  Court  ordered  domestic  
 support obligation payees are as follows:') }}</p>
</div>


<div class="col-md-12">
    <div class="d-flex radio-primary mt-3"> 
        <label>{{ __('Name:') }}</label>	
        <input name="<?php echo base64_encode('Text19'); ?>" placeholder="" type="text" value="" class=" form-control">												
    </div>
</div>
<div class="col-md-12">
    <div class="d-flex radio-primary mt-3"> 
        <label>{{ __('Address:') }}</label>
        <textarea name="<?php echo base64_encode('Text20'); ?>" class="form-control"></textarea>											
    </div>
</div>


<div class="col-md-4">
    <div class="d-flex radio-primary mt-3"> 
        <label>{{ __('Date:') }}</label>
        <input name="<?php echo base64_encode('Text21'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $currentDate;?>" class="date_filed  form-control">												
    </div>
</div>
<div class="col-md-8">
    <div class="d-inline t-primary mt-3"> <label>&nbsp;</label>
         <input name="<?php echo base64_encode('Text22'); ?>" type="text" class="form-control" value="<?php echo $onlyDebtor;?>"><br><p class="text-center">{{ __('Debtor') }}</p>
    </div>
</div>




<div class="col-md-12 mt-3">
 
</div>






</div>