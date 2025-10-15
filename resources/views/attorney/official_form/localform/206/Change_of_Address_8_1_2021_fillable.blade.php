<div class="row">
    <div class="col-md-6 border_1px p-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW JERSEY') }}</h3>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6 border_1px p-3 bt-0">
        <div class="input-grpup ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('tx1'); ?>" value="" class="form-control" rows="7" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        </div> 
    </div>
    <div class="col-md-6 p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No.:"
                casenoNameField="tx2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Adversary No.:"
                casenoNameField="tx3"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="tx4"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Judge:"
                casenoNameField="tx5"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CHANGE OF ADDRESS') }}</h3>
        <p class="p_justify">
        {{ __('Under D. N.J. LBR 2002-1(b) this form must be used by a party to change its address during a case or
            proceeding.') }} <span class="text-bold">{{ __('NOTE:') }}</span> {{ __('A separate form must be filed in each main case and adversary proceeding where
            the address of the party needs to be updated. A debtor who wishes to change the address of a creditor
            previously included on their Schedules may also use this form.') }}
        </p>
    </div>

    <div class="col-md-3 p-2 pl-3">
        <label>{{ __("Party's name/type:") }}</label>
    </div>
    <div class="col-md-9">
        <input type="text" name="<?php echo base64_encode('tx6');?>" class="form-control">
    </div>

    <div class="col-md-12">
        <p>{{ __('(Example: John Smith, creditor)') }}</p>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-2 p-2">
        <label>{{ __('Old address:') }}</label>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('tx7');?>" class="form-control" value="{{$debtoraddress}}">
        <input type="text" name="<?php echo base64_encode('tx8');?>" class="form-control mt-1" value="">
        <input type="text" name="<?php echo base64_encode('tx9');?>" class="form-control mt-1" value="{{$debtorCity}} {{$debtorState}},  {{$debtorzip}}">
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-2 mt-3"></div>
    <div class="col-md-2 mt-3 p-2">
        <label>{{ __('New address:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('tx10');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('tx11');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('tx12');?>" class="form-control mt-1">
    </div>
    <div class="col-md-4 mt-3"></div>
    
    <div class="col-md-2 mt-3"></div>
    <div class="col-md-2 mt-3 p-2">
        <label>{{ __('New phone no.:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('tx13');?>" class="form-control">
    </div>
    <div class="col-md-4 mt-3"></div>

    <div class="col-md-2"></div>
    <div class="col-md-6 p-2">
        <label>{{ __('(if debtor is filing and their phone number has changed).') }}</label>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-12">
        <p>
            {{ __('I hereby certify under penalty of perjury that the above information is true. If a debtor, I understand that
            it is my responsibility to notify the Trustee and any affected party of my change of address.') }}
        </p>
    </div>

    <div class="col-md-6 ">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="tx14"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="tx15"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
</div>