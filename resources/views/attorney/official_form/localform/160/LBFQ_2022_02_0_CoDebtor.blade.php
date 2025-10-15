<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}
            <br>
            {{ __('FOR THE DISTRICT OF MARYLAND') }}
            <br>
            {{ __('at') }}
            <select name="<?php echo base64_encode("Dropdown1"); ?>" class="form-control w-auto">
                <option value="Baltimore Division">{{ __('Baltimore Division') }}</option>
                <option value="Greenbelt Division" selected>{{ __('Greenbelt Division') }}</option>
                <option value="Salisbury Division">{{ __('Salisbury Division') }}</option>
            </select>
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group">
            <label>{{ __('IN RE:') }}</label>
            <textarea name="<?php echo base64_encode("Text4"); ?>" value="" class=" form-control" rows="3" style="padding-right:5px;">{{$debtorname ?? ''}}</textarea>
            <label>{{ __('Debtor') }}</label>
        </div> 
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={!!$caseno!!}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <?php $chap = $chapterName;
            $nochapter = str_replace("Chapter ", "", $chap); ?>
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={!!$nochapter!!}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3>{{ __('STATEMENT UNDER PENALTY OF PERJURY CONCERNING PAYMENT ADVICES') }} <br> {{ __('DUE PURSUANT TO 11 USC § 521(a(1)(B)(iv)') }}</h3>
        <p class="mt-2">{{ __('***IN JOINT FILINGS, A SEPARATE STATEMENT MUST BE COMPLETED BY EACH DEBTOR***') }}</p>
    </div>

    <div class="col-md-12 p_justify">
        <p>
            I, 
            <input type="text" name="<?php echo base64_encode('I');?>" value="{{$spousename}}" class="form-control width_50percent">
            {{ __('(co-debtor’s name), state that I did not
            provide copies of all payment advices or other evidence of payment received within 60 days
            before the date of the filing of the petition, by me from any employer because:') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('1 I was not employed during the period immediately preceding the filing of the');?>" value="On" class="form-control w-auto spouse_not_payment_received">
            (1) {{ __('I was not employed during the period immediately preceding the filing of the
            above-referenced case') }} 
            <input type="text" name="<?php echo base64_encode('abovereferenced case');?>" value="" class="form-control w-auto">
            {{ __('(state the dates that you
            were not employed);') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('2 I was employed during the period immediately preceding the filing of the above');?>" value="On" class="form-control w-auto spouse_payment_received">
            {{ __('(2) I was employed during the period immediately preceding the filing of the above-
            referenced case but did not receive any payment advices or other evidence of payment
            from my employer within 60 days before filing of the petition;') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('3 I am self employed and do not receive any evidence of payment');?>" value="On" class="form-control w-auto">
            {{ __('(3) I am self employed and do not receive any evidence of payment;') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('4 Other please explain');?>" value="On" class="form-control w-auto">
            (4) {{ __('Other (please explain)') }}
            <input type="text" name="<?php echo base64_encode('undefined');?>" class="form-control width_80percent">
        </p>
        <p>
            {{ __('I declare under penalty of perjury that I have read the foregoing statements and that they are true
            and accurate to the best of my knowledge, information and belief.') }}
        </p>
        <p>
        {{ __('Dated this') }} 
            <input type="text" name="<?php echo base64_encode('Dated this 1');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('day of');?>" value="{{$currentDay}}" class="form-control width_5percent">
             , 20
            <input type="text" name="<?php echo base64_encode('TextBox0');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            .
        </p>
    </div>

    <div class="col-md-6 mt-3">
    <x-officialForm.debtorSignVerticalOpp
            labelContent="(Signature of co-debtor)"
            inputFieldName="Text5"
            inputValue="{{$debtor2_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <p>{{ __('Co-Debtor') }}</p>
    </div>
    <div class="col-md-6 mt-3"></div>
    
</div>