<div class="row">

    <div class="col-md-12">
        <h3 class="text-center">
        **Send to creditors - DO NOT FILE WITH COURT**
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <label class="text_italic">{{ __('Attorney or Debtor Name, Address, Phone, Fax, Email:') }}</label>
        <textarea name="<?php echo base64_encode('Filer');?>" class="form-control " rows="9">{{$attorney_name}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorneyFax}}
{{$attorney_email}}</textarea>
    </div>
    <div class="col-md-3 border_1px p-3 br-0 text-center">
        <img src="{{ asset('assets/img/dist_of_hawaii_logo.jpg')}}" alt="logo" />
        <p class="text-bold">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('DISTRICT OF HAWAII') }}<br>
            1132 Bishop Street, Suite 250<br>
            {{ __('Honolulu, Hawaii 96813') }}
        </p>
    </div>
    <div class="col-md-3 border_1px p-3 bl-0">
        <label class="float_right">{{ __('hib_1009-2b (11/16)') }}</label>
    </div>

    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Debtor:') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Debtor');?>" class="form-control" value="{{$onlyDebtor}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Case No.:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Case Number');?>" class="form-control" value="{{$caseno}}">
    </div>
    
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">Joint Debtor:<br>{{ __('(if any)') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Joint Debtor');?>" class="form-control" value="{{$spousename}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Chapter:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <select name="<?php echo base64_encode('Chapter');?>" class="form-control w-auto">
            <option value=""></option>
            <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
            <option value="11">11</option>
            <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
            <option value="12">12</option>
            
        </select>
    </div>
    
    <div class="col-md-12 border_1px p-3 bt-0">
        <h3 class="text-center">
            {{ __('NOTICE OF CORRECTED SOCIAL SECURITY NUMBER') }}
        </h3>
    </div>
    <div class="col-md-12 border_1px p-3 bt-0">
        <p class=" p_justify">
            [<span class="text_italic">{{ __('Instructions to debtor(s):') }}</span> {{ __('If the Social Security Number (SSN) or Individual Taxpayer Identification Number
            (ITIN) provided to the court with your petition was incorrect, you must submit an amended B121
            – Statement of SSN or ITIN. You must also send this notice to all creditors and parties in interest, the
            trustee, the Office of the United States Trustee, and the credit reporting agencies listed at the bottom of
            this form.') }} <span class="text-bold">{{ __('DO NOT FILE this document with the court') }}</span> {{ __('– file only a certificate of service showing the
            names and addresses of parties served this notice.]') }}
        </p>
        <p>
            {{ __('NOTICE IS HEREBY GIVEN:') }}
        </p>
        <p class=" p_justify">
            {{ __('The Social Security Number (SSN) or Individual Taxpayer Identification Number (ITIN) of the Debtor or the
            Joint Debtor originally provided to the court for giving notice of the bankruptcy case, meeting of creditors,
            and certain deadlines was incorrect. The correct information is stated below.') }}
        </p>
        <div class=" table_sect table_sect_head_border mb-3">
            <table class="w-100">
                <tr>
                    <th class="p-2">{{ __('Name of Debtor/Joint Debtor') }}</th>
                    <th class="p-2">{{ __('Full (9-digit) SSN / Full ITIN') }}</th>
                </tr>
                <tr>
                    <td class="p-1">
                        <textarea name="<?php echo base64_encode('hib_1009-2b_1');?>" class="form-control" rows="3">{{$both_name}}</textarea>
                    </td>
                    <td class="p-1">
                        <textarea name="<?php echo base64_encode('hib_1009-2b_2');?>" class="form-control" rows="3">{{$both_ssn}}</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <p>
            {{ __('The undersigned declares under penalty of perjury that the foregoing is true and correct.') }}
        </p>
        <div class="row">
            <div class="col-md-4">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="hib_1009-2b_3"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
            <div class="col-md-4">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Signature of Debtor/Joint Debtor"
                    inputFieldName="TextBox0"
                    inputValue={{$debtor_sign}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 text-center">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Printed Name"
                    inputFieldName="hib_1009-2b_4"
                    inputValue={{$onlyDebtor}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
        <p>
            {{ __('Notice must be sent to the following credit reporting agencies:') }}
        </p>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-0">
                    EQUIFAX<br>
                    {{ __('P.O. Box 740256') }}<br>
                    {{ __('Atlanta, GA 30374') }}
                </p>
            </div>
            <div class="col-md-4">
                <p class="mb-0">
                    TRANSUNION<br>
                    {{ __('Consumer Dispute Center') }}<br>
                    P.O. Box 2000<br>
                    {{ __('Chester, PA 19016') }}
                </p>
            </div>
            <div class="col-md-4">
                <p class="mb-0">
                    EXPERIAN<br>
                    {{ __('P.O. Box 4500') }}<br>
                    {{ __('Allen, TX 75013') }}
                </p>
            </div>
        </div>
    </div>

    
</div>