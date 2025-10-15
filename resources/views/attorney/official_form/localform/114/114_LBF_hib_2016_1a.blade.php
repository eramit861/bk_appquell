<div class=" table_sect table_sect_head_border">
    <table class="w-100">
        <tr>
            <td class="p-2 " colspan="4">
                <label class="mb-0 text_italic">
                    {{ __('Filer’s Name, Address, Phone, Fax, Email:') }}
                </label>
                <textarea name="<?php echo base64_encode('Filer');?>" class="form-control" rows="8">{{$attorney_name}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorneyFax}}
{{$attorney_email}}</textarea>
            </td>
            <td class="p-2  text-center" colspan="2"  style="border-right: none;">
                <img src="{{ asset('assets/img/dist_of_hawaii_logo.jpg')}}" alt="logo" />
                <p class="text-bold mb-0">
                    {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
                    {{ __('DISTRICT OF HAWAII') }}<br>
                    1132 Bishop Street, Suite 250<br>
                    {{ __('Honolulu, Hawaii 96813') }}
                </p>
            </td>
            <td class="p-2 " colspan="2"  style="border-left: none;">
                <label class=" float_right">{{ __('hib_2016-1a (12/09)') }}</label>
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="1" style="border-right: none;">
                <p class="mb-0 text_italic">
                    {{ __('Debtor:') }} 
                </p>
            </td>
            <td class="p-2" colspan="5" style="border-left: none;">
                <input name="<?php echo base64_encode('Debtor');?>" type="text" class="form-control" value="{{$onlyDebtor}}">
            </td>
            <td class="p-2 " colspan="1" style="border-right: none;">
                <p class="mb-0 text_italic">
                    {{ __('Case No.:') }} 
                </p>
            </td>
            <td class="p-2" colspan="1" style="border-left: none;">
                <input name="<?php echo base64_encode('Case Number');?>" type="text" class="form-control" value="{{$caseno}}">
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="1" style="border-right: none;">
                <p class="mb-0 text_italic">
                {{ __('Joint Debtor') }}:<br>
                    {{ __('(if any)') }}  
                </p>
            </td>
            <td class="p-2" colspan="5" style="border-left: none;">
                <input name="<?php echo base64_encode('Joint Debtor');?>" type="text" class="form-control" value="{{$spousename}}">
            </td>
            <td class="p-2 " colspan="1" style="border-right: none;">
                <p class="mb-0 text_italic">
                    {{ __('Chapter:') }} 
                </p>
            </td>
            <td class="p-2" colspan="1" style="border-left: none;">
                <select name="<?php echo base64_encode('Chapter');?>" class="form-control w-auto">
                    <option value=""></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                    <option value="11">11</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                    <option value="12">12</option>
                </select>    
            
            </td>
        </tr>
        <tr>
            <td class="p-2  text-center" colspan="4" style="border-right: none;">
                <h3>{{ __('COMPENSATION SUMMARY SHEET') }}</h3>
            </td>
            <td class="p-2 " colspan="1" style="border-left: none;">
                <p class="mb-0 text-bold">
                    <input name="<?php echo base64_encode('hib_2016-1a-1');?>" value="Yes" type="checkbox" class="form-control w-auto">
                    {{ __('Interim') }}
                </p>
                <p class="mb-0 text-bold">
                    <input name="<?php echo base64_encode('hib_2016-1a-2');?>" value="Yes" type="checkbox" class="form-control w-auto">
                    {{ __('Final') }}
                </p>
            </td>
            <td class="p-2" colspan="1">
                <input name="<?php echo base64_encode('hib_2016-1a_1');?>" type="text" class="form-control">
                <p class="mb-0">
                    {{ __('(1 st, 2 nd, etc.)') }}
                </p>
            </td>
            <td class="p-2" colspan="2">
                <p class="mb-0 text_italic">
                    Related Docket No.:
                    <input name="<?php echo base64_encode('hib_2016-1a_2');?>" type="text" class="form-control w-auto">
                </p>
                <p class="mb-0 text_italic">
                    {{ __('(if application filed separately)') }}
                </p>
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="1">
                <p class="mb-0 text_italic">
                    {{ __('Applicant:') }}
                </p>
            </td>
            <td class="p-2" colspan="7">
                <input name="<?php echo base64_encode('hib_2016-1a_3');?>" type="text" class="form-control">
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="1">
                <p class="mb-0 text_italic">
                    {{ __('Capacity:') }}
                </p>
            </td>
            <td class="p-2" colspan="7">
                <input name="<?php echo base64_encode('hib_2016-1a_4');?>" type="text" class="form-control">
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="4">
                <p class="mb-0 text_italic">
                    {{ __('Date of order authorizing employment:') }}
                </p>
            </td>
            <td class="p-2" colspan="4">
                <input name="<?php echo base64_encode('hib_2016-1a_5');?>" type="text" class="form-control">
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="4">
                <p class="mb-0 text_italic">
                    {{ __('Period for this request (e.g. 1/1/09 -12/31/09):') }}
                </p>
            </td>
            <td class="p-2" colspan="4">
                <input name="<?php echo base64_encode('hib_2016-1a_6');?>" type="text" class="form-control">
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    {{ __('Amount rec’d prepetition:') }}
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    $
                    <input name="<?php echo base64_encode('hib_2016-1a_7');?>" type="text" class="form-control w-auto">
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    {{ __('Client trust acct balance:') }}
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    $
                    <input name="<?php echo base64_encode('hib_2016-1a_8');?>" type="text" class="form-control w-auto">
                </p>
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="4">
                <p class="mb-0 text_italic">
                {{ __('Previous amounts awarded by court:') }}
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    Fees: $
                    <input name="<?php echo base64_encode('hib_2016-1a_9');?>" type="text" class="form-control w-auto">
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    Expenses: $
                    <input name="<?php echo base64_encode('hib_2016-1a_10');?>" type="text" class="form-control w-auto">
                </p>
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="4">
                <p class="mb-0 text_italic">
                    {{ __('Previous amounts received:') }}
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    Fees: $
                    <input name="<?php echo base64_encode('hib_2016-1a_11');?>" type="text" class="form-control w-auto">
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                    Expenses: $
                    <input name="<?php echo base64_encode('hib_2016-1a_12');?>" type="text" class="form-control w-auto">
                </p>
            </td>
        </tr>
        <tr>
            <td class="p-2 " colspan="4">
                <p class="mb-0 text_italic">
                    {{ __('Amount of this request (inclusive of any excise taxes):') }}
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                {{ __('Fees:') }} $
                    <input name="<?php echo base64_encode('hib_2016-1a_13');?>" type="text" class="form-control w-auto">
                </p>
            </td>
            <td class="p-2 " colspan="2">
                <p class="mb-0 text_italic">
                {{ __('Expenses:') }} $
                    <input name="<?php echo base64_encode('hib_2016-1a_14');?>" type="text" class="form-control w-auto">
                </p>
            </td>
        </tr>
        <tr>
            <td class="p-2" colspan="6">
                {{ __('Availability of funds - Applicant believes that there are sufficient funds to pay this request
                and all other accrued and anticipated administrative expenses:') }} 
            </td>
            <td class="p-2" colspan="2">
                <p class="mb-0">
                    <input name="<?php echo base64_encode('hib_2016-1a-3');?>" value="Yes" type="checkbox" class="form-control w-auto">
                    {{ __('Yes') }}
                    <input name="<?php echo base64_encode('hib_2016-1a-4');?>" value="Yes" type="checkbox" class="form-control w-auto ml-3">
                    {{ __('No') }}
                </p>
            </td>
        </tr>
        <tr>
            <th class="p-2" colspan="3">{{ __('Name of Professional') }}</th>
            <th class="p-2" colspan="2">{{ __('Position') }}</th>
            <th class="p-2">{{ __('Hourly rate') }}</th>
            <th class="p-2">{{ __('Hours') }}</th>
            <th class="p-2">{{ __('Fees') }}</th>
        </tr>
        <?php foreach (range(1, 8) as $no) { ?>
            <tr>
                <td class="p-2" colspan="3">
                    <input name="<?php echo base64_encode('A'.$no);?>" type="text" name="" class="form-control ">
                </td>
                <td class="p-2" colspan="2">
                    <input name="<?php echo base64_encode('B'.$no);?>" type="text" name="" class="form-control ">
                </td>
                <td class="p-2">
                    <input name="<?php echo base64_encode('C'.$no);?>" type="text" name="" class="form-control ">
                </td>
                <td class="p-2">
                    <input name="<?php echo base64_encode('D'.$no);?>" type="text" name="" class="form-control ">
                </td>
                <td class="p-2">
                    <input name="<?php echo base64_encode('E'.$no);?>" type="text" name="" class="form-control ">
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="p-2" colspan="8">
                <div class="row">
                    <div class="col-md-12 text_italic">
                        <p>
                            {{ __('[Attach additional sheets as needed.]') }} 
                        </p>
                    </div>
                    <div class="col-md-4">
                        <x-officialForm.dateSingleHorizontal
                            labelText="Dated:"
                            dateNameField="hib_2016-1a_56"
                            currentDate={{$currentDate}}
                        ></x-officialForm.dateSingleHorizontal>
                    </div>
                    <div class="col-md-8 text-center">
                        <input name="<?php echo base64_encode('hib_2016-1a_57');?>" type="text" value="{{$attorny_sign}}" class="form-control">
                        <label class="float_left">{{ __('Applicant') }}</label>
                        <label class="">{{ __('Print name if original signature') }}</label>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>