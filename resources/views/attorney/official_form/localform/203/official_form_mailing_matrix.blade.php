<div class="row">
    
    <div class="district203 col-md-6">
        <div class="input-group mb-3">
            <textarea name="<?php echo base64_encode('Email'); ?>>"  class="form-control" rows="7" cols="" style="padding-right:5px;"><?php echo $attorneydetails; ?></textarea>
            <p>{{ __('Name, Address, Telephone No., Bar Number, Fax No. & E-mail address') }}</p>
        </div>
    </div>
    <div class="col-md-4"></div>

    <div class="district203 col-md-12 mb-3">
        <h2 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('DISTRICT OF NEVADA') }} </h2>
    </div>
    <div class="district203 col-md-12 border_1px">
        <div class="row">
            <div class="district203 col-md-6 p-3 border_right_1px">
                <div class="input-group">
                    <label>{{ __('In re:') }} </label><label class="text_italic"> (Name of Debtor)</label>
                    <textarea name="<?php echo base64_encode('Debtor'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p class="p-text-end mb-0">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district203 col-md-6 p-3">
                <x-officialForm.caseNo
                    labelText="BK"
                    casenoNameField="Casenum"
                    caseno={{$caseno}}>
                </x-officialForm.caseNo>
                <div class="row mt-3">
                    <div class="district203 col-md-3 pt-2">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="district203 col-md-9">
                        <select name="<?php echo base64_encode('Chapter'); ?>" id="" class="form-control w-auto">
                            <option value="7">7</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="district203 col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3> 
        <p class="pl-3">{{ __('The above named Debtor hereby verifies that the attached list of creditors is true and correct to to the best of his/her knowledge.') }}</p>
    </div>
            
    <div class="district203 col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="1district203 col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature"
            inputFieldName="Signature"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>
    
    <div class="district203 col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date2"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="district203 col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature"
            inputFieldName="Signature2"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>   

</div>
