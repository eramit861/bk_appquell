<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('SOUTHERN DISTRICT OF WEST VIRGINIA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <label for="">{{ __('IN') }}&nbsp;{{ __('RE:') }}</label>
        <textarea name="<?php echo base64_encode('Text1');?>" class="form-control" rows="3"><?php echo $debtorname ?? ''; ?></textarea>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No.:"
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Text3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <label class="">{{ __('Judge: B. McKay Mignault') }}</label>
        </div>
            
            
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('STATEMENT UNDER PENALTY OF PERJURY CONCERNING') }}<br>{{ __('PAYMENT ADVICES DUE PURSUANT TO 11 U.S.C. SECTION 521(a)(1)(B)(iv)') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify">
            <span class="pl-4"></span>
            I*,
            <input type="text" name="<?php echo base64_encode('Text4');?>" value="{{$onlyDebtor}}" class="form-control w-auto"> 
            {{ __("(Debtor's name), state that I did not file copies of all payment advices
            or other evidence of payment received within 60 days before the date of the filing of the petition, by me from any
            employer because:") }}
        </p>
    </div>

    <div class="col-md-1 pr-0">
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="form-control w-auto not_payment_received">
            {{ __('.(1)') }}
        </p>
    </div>
    <div class="col-md-11">
        <p>
        {{ __('I was not employed during the period immediately preceding the filing of the above-referenced case') }}
            <input type="text" name="<?php echo base64_encode('Text5');?>" value="" class="form-control w-auto ">{{ __('(state the dates that you were not employed);') }}
        </p>
    </div>
    
    <div class="col-md-1 pr-0">
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control w-auto payment_received">
            {{ __('.(2)') }}
        </p>
    </div>
    <div class="col-md-11">
        <p class="p_justify">
                {{ __('I was employed during the period immediately preceding the filing of the above referenced case but did
                not receive any payment advices or other evidence of payment from my employer within 60 days before
                the filing of the petition;') }}
        </p>
    </div>
    
    <div class="col-md-1 pr-0">
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('Check Box8');?>" value="Yes" class="form-control w-auto">
            {{ __('.(3)') }}
        </p>
    </div>
    <div class="col-md-11">
        <p class="p_justify">
            {{ __('I am self employed and do not receive any evidence of payment;') }}
        </p>
    </div>
    
    <div class="col-md-1 pr-0">
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('Check Box9');?>" value="Yes" class="form-control w-auto">
            {{ __('.(4)') }}
        </p>
    </div>
    <div class="col-md-11">
        <p class="p_justify">
            {{ __('Other (please explain)') }}
        </p>
        <input type="text" name="<?php echo base64_encode('Text10');?>" class="form-control">
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            <span class="pl-4"></span>
            {{ __('I declare under penalty of perjury that I have read the foregoing statements and that they are true and accurate
            to the best of my knowledge, information and belief.') }}
        </p>
    </div>

    <div class="col-md-12">
        <p class="">
            <span class="pl-4"></span>
            {{ __('Dated this') }} 
            <input type="text" name="<?php echo base64_encode('Text11');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('Text12');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text13');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            .
        </p>
    </div>

    <div class="col-md-12">
        <p class="">
            <span class="pl-4"></span>
            <input type="text" name="<?php echo base64_encode('Text14');?>" class="form-control width_30percent" value="{{$debtor_sign}}">
            {{ __('(Signature of Debtor)') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            * {{ __('A separate form must be filed for each Debtor') }}
        </p>
    </div>



</div>