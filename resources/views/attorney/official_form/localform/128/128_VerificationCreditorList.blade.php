<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Southern District of Indiana') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('TextBox0');?>" class=" form-control" rows="2" style="padding-right:5px;">{{$debtorname}}</textarea>
        </div> 
        <label class="text_italic">
            {{ __('[Name of Debtor(s)]') }} 
        </label>
        <input type="text" value="" name="<?php echo base64_encode('TextBox1');?>" class=" form-control">
        <label class="float_right">
            {{ __('Debtor(s)') }} 
        </label>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="TextBox2"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>        
    </div>

    <div class="col-md-8"></div>
    <div class="col-md-4">
        <div class="d-flex mt-3">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('CheckBox0');?>" value="YES" class=" form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <label class=""> {{ __('Check if this form is submitted with an amended creditor list.') }}</label>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class=" underline">
            {{ __('VERIFICATION OF CREDITOR LIST') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" p_justify">{{ __('(I/We) declare under penalty of perjury that all entities included or to be included in Schedules D, E/F, G, and H are listed in the creditor list submitted with this verification. This includes all creditors, parties to leases and executory contracts, and codebtors.') }}</p>
        <p class=" p_justify">{{ __('(I/We) declare that the names and addresses of the listed entities are true and correct to the best of (my/our) knowledge.') }}</p>
        <p class=" p_justify">{{ __('(I/We) understand that (I/we) must file an amended creditor list and pay an amendment fee if there are entities listed on (my/our) schedules that are not included in the creditor list submitted with this verification.') }}</p>
    </div>
    
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="TextBox3"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent=" Signature of Debtor "
            inputFieldName="TextBox4"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=" Signature of Joint Debtor "
                inputFieldName="TextBox5"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-12 text-bold">
        <p>
            {{ __('(Note: Certificate of Service not required.)') }}
        </p>
    </div>

</div>