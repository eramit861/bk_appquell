<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}
            <br>
            {{ __('NORTHERN DISTRICT OF ILLINOIS') }}
            <br>
            <select name="<?php echo base64_encode("Combo Box2"); ?>" class="form-control w-auto">
                <option value="EASTERN DIVISION">{{ __('EASTERN DIVISION') }}</option>
                <option value="WESTERN DIVISION">{{ __('WESTERN DIVISION') }}</option>
            </select>
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode("Text3"); ?>" value="" class="form-control" rows="4" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            <label class="float_right">{{ __('Debtor.') }}</label>
        </div>
        <select name="<?php echo base64_encode("Combo Box49"); ?>" class="form-control w-auto mt-3">
            <option value=""></option>
            <option value="AMENDED">{{ __('AMENDED') }}</option>
        </select>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Bankruptcy No."
                casenoNameField="Text4"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text5"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3 class="">{{ __('COVER SHEET FOR APPLICATION FOR PROFESSIONAL COMPENSATION') }}<br>{{ __('(IN CASES UNDER CHAPTERS 7, 11 AND 12)') }}</h3>
    </div>

    <div class="col-md-12 mt-3 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Name of Applicant:"
            inputFieldName="Text6"
            inputValue="{{$attorney_name}}"
        ></x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-12 mt-1 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Authorized to Provide Professional Services to:"
            inputFieldName="Text7"
            inputValue=""
        ></x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-12 mt-1 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Date of Order Authorizing Employment:"
            inputFieldName="Text8"
            inputValue=""
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-12 mt-1 pt-2">
        <label for="">{{ __('Period for Which Compensation is Sought:') }}</label>
    </div>

    <div class="col-md-1 mt-1 pt-2">
        <label for="">{{ __('From') }}</label>
    </div>
    <div class="col-md-3 mt-1">
        <p><input type="text" name="<?php echo base64_encode("Text9"); ?>" class="form-control width_90percent">,</p>
    </div>
    <div class="col-md-2 mt-1">
        <input type="text" name="<?php echo base64_encode("Text10"); ?>" class="form-control">
    </div>
    <div class="col-md-1 mt-1 pt-2">
        <label for="">{{ __('through') }}</label>
    </div>
    <div class="col-md-3 mt-1">
        <p><input type="text" name="<?php echo base64_encode("Text11"); ?>" class="form-control width_90percent">,</p>
    </div>
    <div class="col-md-2 mt-1">
        <input type="text" name="<?php echo base64_encode("Text12"); ?>" class="form-control">
    </div>

    <div class="col-md-4 mt-1 pt-2">
        <label for="">{{ __('Amount of Fees Sought:') }}</label><label class="float_right">$</label>
    </div>
    <div class="col-md-8 mt-1">
        <input type="text" name="<?php echo base64_encode("Text13"); ?>" class="form-control">
    </div>

    <div class="col-md-4 mt-1 pt-2">
        <label for="">{{ __('Amount of Expense Reimbursement Sought:') }}</label><label class="float_right">$</label>
    </div>
    <div class="col-md-8 mt-1">
        <input type="text" name="<?php echo base64_encode("Text14"); ?>" class="form-control">
    </div>

    <div class="col-md-2 mt-1 pt-2">
        <p class="mb-0 mt-2" >{{ __('This is an:') }}</p>
    </div>
    <div class="col-md-4 mt-1 pt-2">
        <p class="mb-0 mt-2" >Interim Application <input type="checkbox" name="<?php echo base64_encode("Check Box15"); ?>" value="Yes" class="form-control w-auto height_fit_content"></p>
    </div>
    <div class="col-md-1 mt-1 pt-2">
    </div>
    <div class="col-md-4 mt-1 pt-2">
        <p class="mb-0 mt-2" >Final Application <input type="checkbox" name="<?php echo base64_encode("Check Box16"); ?>" value="Yes" class="form-control w-auto height_fit_content"></p>
    </div>
    <div class="col-md-1 mt-1 pt-2">
    </div>

    <div class="col-md-12 mt-3 ">
        <p>{{ __('If this is') }} <span class="text_italic">not</span> {{ __('the first application filed herein by this professional, disclose as to all prior fee applications:') }}</p>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border">
        <table class="w-100">
            <tr>
                <th class="p-2">Date<br>{{ __('Filed') }}</th>
                <th class="p-2">Period<br>{{ __('Covered') }}</th>
                <th class="p-2">Total Requested<br>{{ __('(Fees & Expenses)') }}</th>
                <th class="p-2">Total Allowed<br>{{ __('(Fees & Expenses)') }}</th>
                <th class="p-2">Fees & Expenses<br>{{ __('Previously Paid') }}</th>
            </tr>
            <?php
                for ($k = 1 ; $k <= 6; $k++) {
                    ?>
                <tr>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode("A".$k); ?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode("B".$k); ?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode("C".$k); ?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode("D".$k); ?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode("E".$k); ?>" class="form-control">
                    </td>                    
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
    
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text47"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.signVertical
            labelText="(Counsel)"
            signNameField="Text48"
            sign="{{$attorny_sign}}"
        ></x-officialForm.signVertical>
    </div>

</div>