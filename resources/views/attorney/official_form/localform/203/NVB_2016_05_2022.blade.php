<div class="row">

    <div class="col-md-12 text-center mt-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEVADA') }}</h3>
    </div>

    <div class="col-md-4">
        <x-officialForm.caseNo
            labelText="Case No.:"
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>
    <div class="col-md-4">
        <x-officialForm.caseNo
            labelText="Chapter:"
            casenoNameField="Chapter"
            caseno={{$chapterName}}
        ></x-officialForm.caseNo>
    </div>
    <div class="col-md-4">
        <x-officialForm.caseNo
            labelText="Hearing Date/Time:"
            casenoNameField="Hearing DateTime"
            caseno=""
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-2 pt-2 mt-1">
        <label for="">{{ __('Debtor:') }}</label>
    </div>
    <div class="col-md-10 mt-1">
        <input type="text" name="<?php echo base64_encode('Debtor');?>" class="form-control " value="{{$onlyDebtor}}">
    </div>

    <div class="col-md-2 pt-2 mt-1">
        <label for="">{{ __('Applicant:') }}</label>
    </div>
    <div class="col-md-10 mt-1">
        <input type="text" name="<?php echo base64_encode('Applicant');?>" class="form-control ">
    </div>

    <div class="col-md-2 pt-2 mt-1">
        <label for="">{{ __('Date of Employment:') }}</label>
    </div>
    <div class="col-md-10 mt-1">
        <input type="text" name="<?php echo base64_encode('Date of Employment');?>" class="form-control ">
    </div>
    
    <div class="col-md-2 pt-2 mt-1">
        <label for="">{{ __('Interim Fee Application No:') }}</label>
    </div>
    <div class="col-md-4 mt-1">
        <input type="text" name="<?php echo base64_encode('Interim Fee Application No');?>" class="form-control ">
    </div>
    <div class="col-md-1 pt-2 mt-1 text-center">
        <label for="">{{ __('OR') }}</label>
    </div>
    <div class="col-md-2 pt-2 mt-1">
        <label for="">{{ __('Final Fee Application') }}</label>
    </div>
    <div class="col-md-3 mt-1">
        <input type="text" name="<?php echo base64_encode('Final Fee Application');?>" class="form-control ">
    </div>

    <div class="col-md-7 pt-2 mt-3 mb-3">
        <p class=" text-bold">{{ __('Amounts Requested:') }} </p>
    </div>
    <div class="col-md-5 mt-3 mb-3">
        <p class=" text-bold">
        {{ __('Client Approval') }}: 
            <input type="radio" value="Yes" name="<?php echo base64_encode('Group1');?>" class="form-control w-auto">
            {{ __('Yes') }} 
            <input type="radio" value="No" name="<?php echo base64_encode('Group1');?>" class="form-control w-auto">
            {{ __('No') }}
        </p>
    </div>

    <div class="col-md-2 pt-2">
        <label class="text-bold">{{ __('Fees:') }}</label>
        <label class="float_right">$</label>
    </div>
    <div class="col-md-3">
        <input type="text" name="<?php echo base64_encode('fees');?>" class="form-control price-field">
    </div>
    <div class="col-md-7"></div>

    <div class="col-md-2 pt-2 mt-1">
        <label class="text-bold">{{ __('Expenses:') }}</label>
        <label class="float_right">$</label>
    </div>
    <div class="col-md-3 mt-1">
        <input type="text" name="<?php echo base64_encode('Expenses');?>" class="form-control price-field">
    </div>
    <div class="col-md-7 mt-1"></div>

    <div class="col-md-2 pt-2 mt-1">
        <label class="text-bold">{{ __('Total:') }}</label>
        <label class="float_right">$</label>
    </div>
    <div class="col-md-3 mt-1">
        <input type="text" name="<?php echo base64_encode('undefined_2');?>" class="form-control price-field">
    </div>
    <div class="col-md-7 mt-1"></div>

    <div class="col-md-2 pt-2 mt-1">
        <label class="text-bold">{{ __('Hours:') }}</label>
    </div>
    <div class="col-md-3 mt-1">
        <input type="text" name="<?php echo base64_encode('Hours');?>" class="form-control ">
    </div>
    <div class="col-md-1 mt-1"></div>
    <div class="col-md-2 pt-2 mt-1">
        <p class="float_right"><span class="text-bold pr-3">{{ __('Blended Rate:') }}</span> $</p>
    </div>
    <div class="col-md-3 mt-1">
        <input type="text" name="<?php echo base64_encode('Blended Rate');?>" class="form-control price-field">
    </div>
    <div class="col-md-1 mt-1"></div>
    
    <div class="col-md-2 pt-2 ">
        <label class="text-bold">{{ __('Fees Previously Requested:') }}</label>
        <label class="float_right">$</label>
    </div>
    <div class="col-md-3 ">
        <input type="text" name="<?php echo base64_encode('Fees Previously Requested');?>" class="form-control price-field">
    </div>
    <div class="col-md-1 "></div>
    <div class="col-md-2 pt-2 ">
        <p class="float_right"><span class="text-bold pr-3">{{ __('Awarded:') }}</span> $</p>
    </div>
    <div class="col-md-3 ">
        <input type="text" name="<?php echo base64_encode('Awarded');?>" class="form-control price-field">
    </div>
    <div class="col-md-1 "></div>
    
    <div class="col-md-2 pt-2  pr-0">
        <label class="text-bold">{{ __('Expenses Previously Requested:') }}</label>
        <label class="float_right">$</label>
    </div>
    <div class="col-md-3 ">
        <input type="text" name="<?php echo base64_encode('Expenses Previously Requested');?>" class="form-control price-field">
    </div>
    <div class="col-md-1 "></div>
    <div class="col-md-2 pt-2 ">
        <p class="float_right"><span class="text-bold pr-3">{{ __('Awarded:') }}</span> $</p>
    </div>
    <div class="col-md-3 ">
        <input type="text" name="<?php echo base64_encode('Awarded_2');?>" class="form-control price-field">
    </div>
    <div class="col-md-1 "></div>
    
    <div class="col-md-2 pt-2 ">
        <label class="text-bold">{{ __('Total Previously Requested:') }}</label>
        <label class="float_right">$</label>
    </div>
    <div class="col-md-3 ">
        <input type="text" name="<?php echo base64_encode('Total Previously Requested');?>" class="form-control price-field">
    </div>
    <div class="col-md-1 "></div>
    <div class="col-md-2 pt-2 ">
        <p class="float_right"><span class="text-bold pr-3">{{ __('Awarded:') }}</span> $</p>
    </div>
    <div class="col-md-3 ">
        <input type="text" name="<?php echo base64_encode('Awarded_3');?>" class="form-control price-field">
    </div>
    <div class="col-md-1 "></div>
    
    <div class="col-md-2 pt-2 ">
        <label class="text-bold">{{ __('Total Amount Paid:') }}</label>
        <label class="float_right">$</label>
    </div>
    <div class="col-md-3 ">
        <input type="text" name="<?php echo base64_encode('Total Amount Paid');?>" class="form-control price-field">
    </div>
    <div class="col-md-7 "></div>

    <div class="col-md-12 mt-3">
        <p class=" text-bold underline">{{ __('Chapter 13 Cases ONLY:') }} </p>
        <p>
            <span class=" text-bold">
            {{ __('Yes') }} 
                <input type="radio" value="Yes" name="<?php echo base64_encode('presumptive');?>" class="form-control w-auto mr-3">
                {{ __('No') }}
                <input type="radio" value="No" name="<?php echo base64_encode('presumptive');?>" class="form-control w-auto">
            </span>
            {{ __('Elected to accept the Chapter 13 Presumptive Fee pursuant to LR 2016.2, and
            filed the “Notice of Election to Accept the Presumptive Fee” on') }} 
            <input type="text" name="<?php echo base64_encode('Date filed');?>" class="form-control w-auto">
            .
        </p>
        <p>
            <span class=" text-bold">
            {{ __('Yes') }} 
                <input type="radio" value="Yes" name="<?php echo base64_encode('mmm');?>" class="form-control w-auto mr-3">
                {{ __('No') }}
                <input type="radio" value="No" name="<?php echo base64_encode('mmm');?>" class="form-control w-auto">
            </span>
            {{ __('Participated in the Mortgage Mediation Program') }}: <span class=" text-bold">{{ __('If yes') }}</span>, {{ __('amount received') }}: $ 
            <input type="text" name="<?php echo base64_encode('Text3');?>" class="form-control w-auto price-field">
        </p>
        <p>{{ __('I certify under penalty of perjury that the above is true.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName=""
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

</div>