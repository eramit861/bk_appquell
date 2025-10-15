
   <div class="text-center"> 
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('Southern District of Georgia') }}</h3> 
    </div>
    <div class="row mt-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Text1"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="Case No.:"
                    casenoNameField="Text2"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
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
    <div class="text-center underline mt-3 mb-3"> 
        <h3>{{ __('REPORT OF NEW DEBTOR ADDRESS') }}</h3> 
    </div>
    <div class="row mt-2">
        <div class="col-md-2">
            <div class="float_right">
                <label>{{ __('Debtor Name:') }}</label>
            </div>
        </div>
        <div class="col-md-3">
            <input name="<?php echo base64_encode('Last Name'); ?>" type="text" value="{{$debtorFirstName}}" class="form-control">
        </div>
        <div class="col-md-3">
            <input name="<?php echo base64_encode('First Name'); ?>" type="text" value="{{$debtorLastName}}" class="form-control">
        </div>
        <div class="col-md-3">
            <input name="<?php echo base64_encode('Middle Initial'); ?>" type="text" value="{{$suffix_d1}}" class="form-control">
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row mt-2">
        <div class="col-md-2">
            <div class="float_right">
                <label>{{ __('Joint Debtor Name:') }}</label>
            </div>
        </div>
        <div class="col-md-3">
        <input name="<?php echo base64_encode('LastName2'); ?>" type="text" value="{{$spouseFirstName}}" class="form-control">
        </div>
        <div class="col-md-3">
        <input name="<?php echo base64_encode('First Name2'); ?>" type="text" value="{{$spouseLastName}}" class="form-control">
        </div>
        <div class="col-md-3">
        <input name="<?php echo base64_encode('Middle Initial 2'); ?>" type="text" value="{{$suffix_d2}}" class="form-control">
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row mt-2">
        <div class="col-md-2">
            <div class="float_right add1_ch">
                <label>{{ __('Previous Address:') }}</label>
            </div>
        </div>
        <div class="col-md-9 add1_ch">
            <input name="<?php echo base64_encode('Text10'); ?>" type="text" value="{{$debtoraddress}}" class="add1_ch form-control">
        </div>
        <div class="col-md-1 add1_ch"></div>
    </div>
    <div class="row mt-2 add1_ch">
        <div class="col-md-2 add1_ch">
        </div>
        <div class="col-md-9 add1_ch">
            <input name="<?php echo base64_encode('Text11'); ?>" type="text" value="" class="add1_ch form-control">
        </div>
        <div class="add1_ch col-md-1"></div>
    </div>
    <div class="row mt-2 add1_ch">
        <div class="col-md-2 add1_ch">
        </div>
        <div class="col-md-3 add1_ch">
            <input name="<?php echo base64_encode('City1'); ?>" type="text" value="{{$debtorCity}}" class="form-control add1_ch">
        </div>
        <div class="col-md-3 add1_ch">
            <input name="<?php echo base64_encode('State1'); ?>" type="text" value="{{$debtorState}}" class="form-control add1_ch">
        </div>
        <div class="col-md-3 add1_ch">
            <input name="<?php echo base64_encode('Zip Code1'); ?>" type="text" value="{{$debtorzip}}" class="form-control add1_ch">
        </div>
        <div class="col-md-1 add1_ch"></div>
    </div>
    <div class="row mt-2 add1_ch">
        <div class="col-md-2 add1_ch">
            <div class="float_right">
                <label>{{ __('New Address:') }}</label>
            </div>
        </div>
        <div class="col-md-9">
            <input name="<?php echo base64_encode('Text13'); ?>" type="text" value="" class="form-control">
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row mt-2">
        <div class="col-md-2">
        </div>
        <div class="col-md-9">
            <input name="<?php echo base64_encode('Text16'); ?>" type="text" value="" class="form-control">
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row mt-2">
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <input name="<?php echo base64_encode('City2'); ?>" type="text" value="" class="form-control">
        </div>
        <div class="col-md-3">
            <input name="<?php echo base64_encode('State2'); ?>" type="text" value="" class="form-control">
        </div>
        <div class="col-md-3">
            <input name="<?php echo base64_encode('Zip Code2'); ?>" type="text" value="" class="form-control">
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-5">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Date"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div> 
        <div class="col-md-6">
            <div class=" pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent="By"
                    inputFieldName="By"
                    inputValue="{{$attorny_sign}}">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="row mt-2">
                <div class="col-md-9">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Name "
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
                        inputFieldName="City3"
                        inputValue="{{$attorney_city}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-4">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="State"
                        inputFieldName="State3"
                        inputValue="{{$attorney_state}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-4">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Zip Code "
                    inputFieldName="Zip Code3"
                    inputValue="{{$attorney_zip}}"
                ></x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-9">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Telephone"
                    inputFieldName="Telephone No"
                    inputValue="{{$attorneyPhone}}"
                ></x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-3">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Bar ID "
                    inputFieldName="Bar ID"
                    inputValue="{{$attorney_state_bar_no}}"
                ></x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
