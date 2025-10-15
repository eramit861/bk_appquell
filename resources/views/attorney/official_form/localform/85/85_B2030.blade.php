<div class="row">

    
<div class="col-md-12">
    <div class="row">
    <div class="col-md-12 border_1px bb-0 p-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}</h3>
        <p class="text-center mb-0">{{ __('EASTERN DISTRICT OF CALIFORNIA') }}</p>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-grpup w-100">
            <label>{{ __('In re') }}</label>
            <textarea name="<?php echo base64_encode('title'); ?>" value="" class="form-control" rows="3" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
         </div>
         <div class="input-grpup text-right">
            <label> {{ __('Debtor(s)') }}</label>
         </div>
    </div>
    
    <div class="col-md-6 border_1px pt-3 pb-3 pl-0 pr-0">
        <div class="pl-3 pr-3"> 
            <x-officialForm.caseNo
            labelText="{{ __('Case Number:') }}"
            casenoNameField="case"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
        </div>
       
        <div class="border_top_1px mt-3 pt-3">
            <h3 class="text-center">{{ __('DISCLOSURE OF COMPENSATION') }}<br> {{ __('OF ATTORNEY FOR DEBTOR') }}</h3>
        </div>
    </div>

</div>
</div>

<div class="col-md-12 mt-3">
    <p>{{ __('1. Pursuant to 11 U.S.C. § 329(a) and Bankruptcy Rule 2016(b), I certify that I am the attorney for the above-named debtor(s) and that compensation paid to me within one year before the filing of the petition in bankruptcy, or agreed to be paid to me, for services rendered or to be rendered on behalf of the debtor(s) in contemplation of or in connection with the bankruptcy case is as follow:') }}</p>
</div>

<div class="col-md-12">
<div class="row align_center sub-child">
    <div class="col-md-9">
        <div class="input-group horizontal_dotted_line">
            <label>{{ __('For legal services, I have agreed to accept') }}</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group d-flex">
        <div class="input-group-append"> <span class="input-group-text ">$</span> </div>
            <p><input name="<?php echo base64_encode('ag1'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>"  type="text" value="" class="price-field form-control"></p> </div>
    </div>
</div>
</div>
<div class="col-md-12">
<div class="row align_center sub-child">
    <div class="col-md-9">
        <div class="input-group horizontal_dotted_line">
            <label>{{ __('Prior to the filing of this statement I have received') }}</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group d-flex">
        <div class="input-group-append"> <span class="input-group-text ">$</span> </div>
            <p><input name="<?php echo base64_encode('ag2'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>"  type="text" value="" class="price-field form-control"></p> </div>
    </div>
</div>
</div>
<div class="col-md-12">
<div class="row align_center sub-child">
    <div class="col-md-9">
        <div class="input-group horizontal_dotted_line">
            <label>{{ __('Balance Due') }}</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group d-flex">
        <div class="input-group-append"> <span class="input-group-text ">$</span> </div>
            <p><input name="<?php echo base64_encode('ag3'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>"  type="text" value="" class="price-field form-control"></p> </div>
    </div>
</div>
</div>

<div class="col-md-12">
<p>{{ __('2. The source of the compensation paid to me was:') }}</p>
<div class="d-flex">
<div class="input-group" style="width:100px;">
    <input name="<?php echo base64_encode('agcb1'); ?>" value="On" type="checkbox"><label>{{ __('Debtor') }}</label>
</div>

<div class="input-group" >
    <input name="<?php echo base64_encode('agcb2'); ?>" value="On" type="checkbox"><label>{{ __('Other (specify)') }}</label>
</div>
</div>
</div>

<div class="col-md-12">
<p>{{ __('3. The source of compensation to be paid to me is:') }}</p>
<div class="d-flex">
<div class="input-group" style="width:100px;">
    <input name="<?php echo base64_encode('agcb3'); ?>" value="On" type="checkbox"><label>{{ __('Debtor') }}</label>
</div>

<div class="input-group" >
    <input name="<?php echo base64_encode('agcb4'); ?>" value="On" type="checkbox"><label>{{ __('Other (specify)') }}</label>
</div>
</div>
</div>

<div class="col-md-12 mt-3">
<div class="input-group">
<p>4. <input name="<?php echo base64_encode('agcb5'); ?>" value="On" type="checkbox"> {{ __('I have not agreed to share the above-disclosed compensation with any other person unless they are members and associates of my law firm.') }}<br>

<input name="<?php echo base64_encode('agcb6'); ?>" value="On" class="ml-10" type="checkbox"> {{ __('I have not agreed to share the above-disclosed compensation with any other person unless they are members and associates of my law firm.') }}</p>
</div>

</div>

<div class="col-md-12 mt-3">
    <p>{{ __('5. In return for the above-disclosed fee, I have agreed to render legal service for all aspects of the bankruptcy case, including:') }}</p>
    <p class="ml-10">{{ __('a. Analysis of the debtor’s financial situation, and rendering advice to the debtor in determining whether to file a petition in bankruptcy;') }}</p>
    <p class="ml-10"> {{ __('b. Preparation and filing of any petition, schedules, statement of affairs and plan which may be required;') }}</p>
    <p class="ml-10"> {{ __('c. Representation of the debtor at the meeting of creditors and confirmation hearing, and any adjourned hearings thereof;') }}</p>
    <p class="ml-10"> {{ __('d. Representation of the debtor in contested bankruptcy matters;') }}</p>
    <p class="ml-10"> {{ __('e. [Other provisions as needed]') }}</p>

    <table style="width:100%;">
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ag4'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ag5'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
</table>
</div>

<div class="col-md-10 mt-3">
<p>{{ __('6. By agreement with the debtor(s), the above-disclosed fee does not include the following services, insofar as these services are
not mandated by Local Rule 2017-1 of the Eastern District of California.') }}</p>
<table style="width:100%;">
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ah2'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ah3'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ah4'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ah5'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ah6'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
    <tr>
        <td style="height:30px;border:1px solid yellow;">
            <textarea name="<?php echo base64_encode('ah7'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </td>
    </tr>
</table>
</div>


<div class="col-md-12 mt-3" >
    <div style="border:1px solid;padding:10px;">
 <h3 class="mt-3 text-center">{{ __('CERTIFICATION') }}</h3>
 <p>{{ __('I certify that the foregoing is a complete statement of any agreement or arrangement for payment to me for representation of the debtor(s) in this bankruptcy proceeding.') }}</p>

 <div class="input-group d-flex">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ __('Date:') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input name="<?php echo base64_encode('ah8'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                    </div>
                </div>
                <label></label>
            </div>
            <div class="col-md-6">
                <input readonly="" name="<?php echo base64_encode('signature1'); ?>" value="{{$attorny_sign}}" type="text" class="form-control">
                <label>{{ __('Signature of Attorney') }}</label>

                <input readonly="" name="<?php echo base64_encode('ah9'); ?>" value="{{$atroneyName}}" type="text" class="form-control">
                <label>{{ __('Name of Law Firm') }}</label>
            </div>

        </div>

        </div>

</div>

</div>