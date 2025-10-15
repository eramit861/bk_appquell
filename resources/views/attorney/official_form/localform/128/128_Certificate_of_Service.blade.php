<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="">{{ __('LOCAL FORM 4') }}</h3>
        <h3 class="mt-2">{{ __('[CASE CAPTION MUST BE INCLUDED IF FILED AS A SEPARATE DOCUMENT.]') }}</h3>
        <h3 class="mt-2">{{ __('CERTIFICATE OF SERVICE TEMPLATE') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"></span>
            {{ __('The following template substantially complies with Local Rule 9007-1. Attorneys may
            devise their own certificates of service in compliance with the Federal Rules of Civil Procedure,
            the Federal Rules of Bankruptcy Procedure and the Local Rules.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('This is to certify that on the') }} 
            <input type="text" name="<?php echo base64_encode('TextBox0');?>" value="{{$currentMonth}}" class="form-control w-auto mt-1">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('TextBox1');?>" value="{{$currentDay}}" class="form-control width_5percent mt-1">
             , 20
            <input type="text" name="<?php echo base64_encode('TextBox2');?>" value="{{$currentYearShort}}" class="form-control width_5percent mt-1">
            , {{ __('a true and correct copy of the
            [insert title of document served], filed on') }} 
            <input type="text" name="<?php echo base64_encode('TextBox3');?>" value="{{$currentMonth}} {{$currentDay}}" class="form-control w-auto mt-1">
            , 20
            <input type="text" name="<?php echo base64_encode('TextBox4');?>" value="{{$currentYearShort}}" class="form-control width_5percent mt-1">
            {{ __('[Doc. No.') }} 
            <input type="text" name="<?php echo base64_encode('TextBox5');?>" value="" class="form-control w-auto mt-1">
             {{ __('], was forwarded
            via U.S. Mail, first class, postage prepaid, to the following:') }}
        </p>
        <p class="mb-0">{{ __('Applied Group Inc., 4615 E. Arizona Street, Phoenix, AZ 85040') }}</p>
        <p class="mb-0">{{ __('Associated Bank, P.O. Box 1919, Wilmington, MD 19850') }}</p>
        <p class="mb-0">{{ __('Atlas Recovery Systems, P.O. Box 2020, Escondido, CA 92046') }}</p>
    </div>

    <div class="col-md-6 mt-3 pt-2">
        <label class=" float_right">s/</label>
    </div>
    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="TextBox6"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2 pl-2 mb-2">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney Name"
                inputFieldName="TextBox7"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <p>{{ __('[full signature block required if certificate of service is filed as a separate document]') }}</p>
    </div>
</div>