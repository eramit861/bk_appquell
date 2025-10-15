<div class="row">
    
    <div class="col-md-12 text-center">
        <h3 class="">{{ __('LOCAL FORM 4') }}</h3>
        <h3 class="mt-3">{{ __('[CASE CAPTION MUST BE INCLUDED IF FILED AS A SEPARATE DOCUMENT.]') }}</h3>
        <h3 class="mt-3">{{ __('CERTIFICATE OF SERVICE TEMPLATE') }}</h3>
    </div>

    <div class="col-md-12">
        <p>
            <span class="pl-4"></span>
            {{ __('The following template substantially complies with Local Rule 9007-1. Attorneys may
            devise their own certificates of service in compliance with the Federal Rules of Civil Procedure,
            the Federal Rules of Bankruptcy Procedure and the Local Rules.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('This is to certify that on the') }} 
            <input type="text" name="<?php echo base64_encode('TextBox0'); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('TextBox1'); ?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('TextBox2'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            , {{ __('a true and correct copy of the
            [insert title of document served], filed on') }} 
            <input type="text" name="<?php echo base64_encode('TextBox3'); ?>" value="{{$currentMonth}} {{$currentDay}}" class="form-control w-auto">
            , 20
            <input type="text" name="<?php echo base64_encode('TextBox4'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            {{ __('[Doc. No.') }} 
            <input type="text" name="<?php echo base64_encode('TextBox5'); ?>" value="" class="form-control width_5percent">
            {{ __('], was forwarded
            via U.S. Mail, first class, postage prepaid, to the following') }}
        </p>
        <p>
            {{ __('Applied Group Inc., 4615 E. Arizona Street, Phoenix, AZ 85040') }}<br>
            {{ __('Associated Bank, P.O. Box 1919, Wilmington, MD 19850') }}<br>
            {{ __('Atlas Recovery Systems, P.O. Box 2020, Escondido, CA 92046') }}
        </p>
    </div>

    <div class="col-md-6 pt-2 mt-3">
        <label class="float_right">s/</label>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney Name"
            inputFieldName="TextBox6"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <p>
            {{ __('[full signature block required if certificate of
            service is filed as a separate document]') }}
        </p>
    </div>    
</div>