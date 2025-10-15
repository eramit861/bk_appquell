
   <div class="text-center"> 
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}</h3> 
        <p><strong>{{ __('Southern District of Georgia') }}</strong></p> 
    </div>
    <div class="row mt-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <div>
                <label>{{ __('In the matter of:') }}</label>
                <input name="<?php echo base64_encode('form1[0].#subform[0].TextField1[0]'); ?>" type="text" value="{{$debtorname}}" class="form-control mt-2">
            </div>
            <div class="mt-2">
                <label>vs.</label>
                <textarea name="<?php echo base64_encode('form1[0].#subform[0].TextField1[1]'); ?>" type="text" value="" class="form-control mt-2" row="3"></textarea>
            </div>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div class="row mt-2">
                <div class="col-md-4 pt-3">
                    <div class="float_right">
                        <label>{{ __('Chapter:') }}</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <select name="<?php echo base64_encode('form1[0].#subform[0].DropDownList2[0]'); ?>" class="form-control width_auto mt-2">
                        <option value=""></option>
                        <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                        <option value="9">9</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                        <option value="15">15</option>
                    </select>
                </div>
               </div>
            <div class="row mt-2">
                <div class="col-md-4 pt-3">
                    <div class="float_right">
                        <label class="pl-3">{{ __('Case No.:') }}</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <input name="<?php echo base64_encode('form1[0].#subform[0].TextField4[0]'); ?>" type="text" value="{{$caseno}}" class="form-control mt-2 pl-2">
                </div>
                <div class="col-md-4  pt-3">
                    <div class="float_right">
                        <label class=" pl-3">{{ __('Adversary Proceeding No.:') }}</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <input name="<?php echo base64_encode('form1[0].#subform[0].TextField4[1]'); ?>" type="text" value="" class="form-control mt-2 pl-2">
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-3 mb-3"> 
        <h3>{{ __('DISCLOSURE STATEMENT') }}<br>{{ __('S.D. Ga LR 7.1.1') }}</h3>
    </div>
    <div>
        <p>{{ __('The undersigned, counsel of record for') }}<input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[18]'); ?>" type="text" value="{{$debtorname}}" class="form-control width_50percent">{{ __('certifies that the following is a full and complete list of the parties in this action:') }}</p>
    </div>
    <div class="row pl-4">
        <div class="col-md-6 pl-4">
            <label class="underline">{{ __('Name') }}</label>
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[22]'); ?>" type="text" value="" class=" form-control mt-2">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[19]'); ?>" type="text" value="" class=" form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[20]'); ?>" type="text" value="" class=" form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[21]'); ?>" type="text" value="" class=" form-control mt-1">
        </div>
        <div class="col-md-6">
            <label class="underline">{{ __('Identification and Relationship') }}</label>
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[3]'); ?>" type="text" value="" class="form-control mt-2">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[5]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[4]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[6]'); ?>" type="text" value="" class="form-control mt-1">
        </div>
    </div>
    <div class="mt-4 mb-4">
        <span>{{ __('The undersigned further certifies that the following is a full and complete list of officers, directors, or trustees of the above-identified parties:') }}</span>
    </div>
    <div class="row pl-4">
        <div class="col-md-6 pl-4">
            <label class="underline">{{ __('Name') }}</label>
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[0]'); ?>" type="text" value="" class="form-control mt-2">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[17]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[16]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[15]'); ?>" type="text" value="" class="form-control mt-1">
        </div>
        <div class="col-md-6">
            <label class="underline">{{ __('Identification and Relationship') }}</label>
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[7]'); ?>" type="text" value="" class="form-control mt-2">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[8]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[9]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[10]'); ?>" type="text" value="" class="form-control mt-1">
        </div>
    </div>
    <div class="mt-4 mb-4">
        <span> {{ __("The undersigned further certifies that the following is a full and complete list of other persons, firms, partnerships, corporations, or organizations that have a financial interest in, or another interest which could be substantially affected by, 
        the outcome of this case (including a relationship as parent or holding company or any publicly-held corporation that holds 10% or more of a party's stock):") }}</span>
    </div>
    <div class="row pl-4">
        <div class="col-md-6 pl-4">
            <label class="underline">{{ __('Name') }}</label>
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[14]'); ?>" type="text" value="" class="form-control mt-2">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[1]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[2]'); ?>" type="text" value="" class="form-control mt-1">
        </div>
        <div class="col-md-6">
            <label class="underline">{{ __('Identification and Relationship') }}</label>
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[11]'); ?>" type="text" value="" class="form-control mt-2">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[12]'); ?>" type="text" value="" class="form-control mt-1">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField6[13]'); ?>" type="text" value="" class="form-control mt-1">
        </div>
    </div>
    <div class="row mt-3 ">
        <div class="col-md-5">
        <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="form1[0].#subform[0].DateTimeField1[0]"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-1 p-2 pl-3">
        </div>
        <div class="col-md-6 pl-4">
            <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                    labelContent="By:"
                    inputFieldName="form1[0].#subform[0].TD[0].Normal[0].AttorneyName[1]"
                    inputValue="{{$attorny_sign}}">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 pl-4">
                <x-officialForm.debtorSignVertical
                    labelContent="Attorney Name:"
                    inputFieldName="form1[0].#subform[0].TD[0].Normal[0].AttorneyName[0]"
                    inputValue="{{$attorney_name}}">
                </x-officialForm.debtorSignVertical>
                </div>
                <div class="col-md-12 mt-2">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Address"
                        inputFieldName="form1[0].#subform[0].TD[0].Normal[0].AddressLine2[0]"
                        inputValue="{{$attonryAddress1}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-5">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="City"
                        inputFieldName="form1[0].#subform[0].TD[0].Normal[0].City[0]"
                        inputValue="{{$attorney_city}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-2">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="State"
                        inputFieldName="form1[0].#subform[0].TD[0].Normal[0].State[0]"
                        inputValue="{{$attorney_state}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-5">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Zip Code"
                        inputFieldName="form1[0].#subform[0].TD[0].Normal[0].ZipCode[0]"
                        inputValue="{{$attorney_zip}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Telephone"
                        inputFieldName="form1[0].#subform[0].TD[0].Normal[0].Phone[0]"
                        inputValue="{{$attorneyPhone}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-6">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Bar ID"
                        inputFieldName="form1[0].#subform[0].TD[0].Normal[0].BarID[0]"
                        inputValue="{{$attorney_state_bar_no}}">
                    </x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
        </div>
    </div>
