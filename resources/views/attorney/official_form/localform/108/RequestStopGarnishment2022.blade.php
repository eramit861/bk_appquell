
    <div class="text-center"> 
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}</h3> 
        <p><strong>{{ __('Southern District of Georgia') }}</strong></p> 
    </div>
    <div class="row mt-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Debtor Name"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
                <x-officialForm.caseNo
                    labelText="Case No."
                    casenoNameField="Text2"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            <div class="row mt-2">
                <div class="col-md-3 pt-3">
                    <label>{{ __('Chapter:') }}</label>
                </div>
                <div class="col-md-9">
                <select name="<?php echo base64_encode('Dropdown3'); ?>" class="form-control width_auto mt-2">
                    <option value=""></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                </select>
            </div>
            </div>
        </div>
    </div>
    <div class="text-center underline mt-3">
        <h3>{{ __('REQUEST FOR STOP GARNISHMENT') }}</h3>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 p-2 pl-3">
            <label class="pt-3">{{ __('Garnishee:') }}</label>
        </div>
        <div class="col-md-10">
        <textarea name="<?php echo base64_encode('garnishee'); ?>" type="text" value="" class="form-control" rows="5"></textarea>
         </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 p-2 pl-3">
            <label class="pt-3">{{ __('Garnishor:') }}</label>
        </div>
        <div class="col-md-10">
        <textarea name="<?php echo base64_encode('garnishor'); ?>" type="text" value="" class="form-control" rows="5"></textarea>
         </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 p-2 pl-3">
            <label class="pt-3">{{ __('Issuing Court:') }}</label>
        </div>
        <div class="col-md-10">
             <textarea name="<?php echo base64_encode('Issuing Court'); ?>" type="text" value="" class="form-control" rows="5"></textarea>
         </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 p-2 pl-3">
            <label class="pt-3">{{ __('Issuing Court:') }}</label>
        </div>
        <div class="col-md-10">
        <input name="<?php echo base64_encode('Garnishment No'); ?>" type="text" value="" class="form-control">
         </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Date4_af_date"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
            </div> 
        <div class="col-md-6">
            <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                    labelContent="By:"
                    inputFieldName="By"
                    inputValue="{{$attorny_sign}}">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="row mt-2">
                <div class="col-md-9">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Name"
                    inputFieldName="Name"
                    inputValue="{{$attorney_name}}">
                </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-3">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Title"
                    inputFieldName="Title"
                    inputValue="Debtor Attorney">
                </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-12 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                        labelContent="Address"
                        inputFieldName="Address"
                        inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="City"
                        inputFieldName="City"
                        inputValue="{{$attorney_city}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-5">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="State"
                        inputFieldName="State"
                        inputValue="{{$attorney_state}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-3">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Zip Code"
                        inputFieldName="Zip Code"
                        inputValue="{{$attorney_zip}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-9">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Telephone"
                        inputFieldName="Telephone No"
                        inputValue="{{$attorneyPhone}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-3">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Bar ID"
                        inputFieldName="Bar ID"
                        inputValue="{{$attorney_state_bar_no}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
        </div>
    </div>