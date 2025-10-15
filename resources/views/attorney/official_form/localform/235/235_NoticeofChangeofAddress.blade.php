<div class="row">

    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Western District of Oklahoma') }}</h3>
    </div>
    <div class="col-md-6 border_1px bb-0 p-3">
        <div class="input-group">
            <label for="">{{ __('IN RE:') }}</label>
            <input type="text" name="<?php echo base64_encode('IN RE'); ?>" value="{{$onlyDebtor}}" class="form-control mt-1">
            <input type="text" name="<?php echo base64_encode('Debtor name'); ?>" value="{{$spousename}}" class="form-control mt-1">
            <label class="float_right">{{ __('Debtor(s)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px bb-0 bl-0 p-3">
        <div class="row">
            <div class="col-md-3">
                <label class="text-bold">{{ __('Case number') }}<br>{{ __('(If known):') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Case No'); ?>" type="text" value="{{$caseno}}" class="w-auto form-control">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-3">
                <label class="text-bold">{{ __('Case number') }}<br>{{ __('(If known):') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Chapter'); ?>" type="text" value="{{$chapterNo}}" class="w-auto form-control">
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="d-flex">
            <div class="">
                <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box2');?>" value="Yes">
            </div>
            <div class="w-100 text-bold">
                <p class="mb-0">
                    {{ __('Check if address should also be 
                    changed in an adversary proceeding
                    (list all that apply)') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px bl-0 p-3">
        <div class="row">
            <div class="col-md-3 text-bold pt-2 pr-0">
                <label>{{ __('Adversary No. and Title:') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Adversary No and Title 1')?>" type="text" value="" class=" form-control">
                <input name="<?php echo base64_encode('Adversary No and Title 2')?>" type="text" value="" class=" form-control mt-1">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline">{{ __('NOTICE OF CHANGE OF ADDRESS') }}</h3>
    </div>
    
    <div class="col-md-2 pt-2">
        <label class="text-bold">{{ __('OLD ADDRESS:') }}</label>
    </div>
    <div class="col-md-10">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Name)"
                inputFieldName="Name"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Street Address or P.O. Box)"
                inputFieldName="Street Address or PO Box"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(City, State, Zip Code)"
                inputFieldName="City State Zip Code"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    
    <div class="col-md-2 pt-2 mt-3">
        <label class="text-bold">{{ __('NEW ADDRESS:') }}</label>
    </div>
    <div class="col-md-10 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Name)"
                inputFieldName="Name_2"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Street Address or P.O. Box)"
                inputFieldName="Street Address or P O Box"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(City, State, Zip Code)"
                inputFieldName="City State Zip Code_2"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor or Debtor’s Attorney"
            inputFieldName="Signature"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <input type="text" name="<?php echo base64_encode('text1'); ?>" value="{{$attorney_name}}" class="form-control ">
        <input type="text" name="<?php echo base64_encode('text2'); ?>" value="State Bar No: {{$attorney_state_bar_no}}" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('text3'); ?>" value="{{$attonryAddress1}}, {{$attonryAddress2}}" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('text4'); ?>" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('text5'); ?>" value="{{$attorneyPhone}}" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('text6'); ?>" value="{{$attorney_email}}" class="form-control mt-1">
        <label for="">{{ __('Name/OBA#/Address/Telephone #/Email') }}</label>
    </div>

</div>