<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT DISTRICT OF ARIZONA</h3>
    </div>
    <h3 class="text-center col-md-12 underline">SUPPORT FORM</h3>

    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('Case No:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text1');?>" value="{{$caseno}}" class="form-control w-auto">
    </div>

    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('Case Name:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text2');?>" value="" class="form-control w-auto">
    </div>

    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('Chapter:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text3');?>" value="{{$chapterNo}}" class="form-control w-auto">
    </div>

    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('Trustee:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text4');?>" value="{{$selectedTrusteeName}}" class="form-control w-auto">
    </div>

    <p class="col-md-12 mt-3 text-center text-bold">If you are required to pay alimony or child support (Domestic Support Obligations), you MUST complete this form and return to your Trustee.</p>


    <?php
        $domestic_support = Helper::validate_key_value('domestic_support', $final_debtstax, 'radio');

        $has_domestic_tax = true;
        $person_owes_support = '';
        $person_owes_support_address = '';

        $first_employer_name = '';
        $first_employer_address = '';

        $person_owes_support_amount = '';

        if ($domestic_support == 1) {
            $has_domestic_tax = false;
            $domestic_tax = Helper::validate_key_value('domestic_tax', $final_debtstax);
            $first_domestic_tax = !empty($domestic_tax) && is_array($domestic_tax) ? reset($domestic_tax) : [];
            if (!empty($first_domestic_tax)) {
                $person_owes_support = Helper::validate_key_value('domestic_support_name', $first_domestic_tax);
                $person_owes_support_address = Helper::validate_key_value('domestic_support_address', $first_domestic_tax)
                    . ', '. Helper::validate_key_value('domestic_support_city', $first_domestic_tax)
                    . ', '. Helper::validate_key_value('creditor_state', $first_domestic_tax)
                    . ', '. Helper::validate_key_value('domestic_support_zipcode', $first_domestic_tax);
                $person_owes_support_amount = !empty(Helper::validate_key_value('domestic_support_monthlypay', $first_domestic_tax)) ? '$ '.Helper::validate_key_value('domestic_support_monthlypay', $first_domestic_tax) : '';
            }
            $firstEmployer = !empty($currentEmployer) && is_array($currentEmployer) ? reset($currentEmployer) : [];
            if (!empty($firstEmployer)) {
                $first_employer_name = Helper::validate_key_value('employer_name', $firstEmployer);
                $first_employer_address = Helper::validate_key_value('employer_address', $firstEmployer)
                    . ', '. Helper::validate_key_value('employer_city', $firstEmployer)
                    . ', '. Helper::validate_key_value('employer_state', $firstEmployer)
                    . ', '. Helper::validate_key_value('employer_zip', $firstEmployer);
            }
        }
        ?>
    <label class="col-md-12 ">
        <input type="checkbox" name="<?php echo base64_encode('checkbox1');?>" value="Yes" class="form-control w-auto" <?php echo $has_domestic_tax ? 'checked' : ''; ?> >
        I am not required by Court Order to pay a Domestic Support Obligation.
    </label>

    <p class="col-md-12  mt-2">If required, Please Provide the Following information:</p>

     <div class="col-md-12 row">
         <div class="border_1px br-0 bb-0 col-md-6 p-3">
            <p class="mb-0">Name of person you owe support:</p>
            <textarea cols="5" rows="3" name="<?php echo base64_encode('text5');?>" class="form-control">{{ $person_owes_support }}</textarea>
         </div>
         <div class="border_1px bb-0 col-md-6 p-3">
            <p class="mb-0"> Address and phone number of person you owe support:</p>
            <textarea cols="5" rows="3" name="<?php echo base64_encode('text6');?>" class="form-control">{{ $person_owes_support_address }}</textarea>
            <label class="me-2 ">Phone No:</label><input type="text" name="<?php echo base64_encode('text7');?>" value="" class="form-control w-auto mt-2">
         </div>

         <div class="border_1px br-0 bb-0 col-md-6 p-3">
            <p class="mb-0">Your employer's name:</p>
            <textarea cols="5" rows="3" name="<?php echo base64_encode('text8');?>" class="form-control">{{ $first_employer_name }}</textarea>
         </div>
         <div class="border_1px bb-0 col-md-6 p-3">
            <p class="mb-0"> Address and phone number of your employer:</p>
            <textarea cols="5" rows="3" name="<?php echo base64_encode('text9');?>" class="form-control">{{ $first_employer_address }}</textarea>
            <label class="me-2 ">Phone No:</label><input type="text" name="<?php echo base64_encode('text10');?>" value="" class="form-control w-auto mt-2">
         </div>
         <div class="border_1px col-md-12 row ml-0 p-3">
            <p class=" col-md-6 ">Amount of support owed as of petition date:</p>
            <input type="text" name="<?php echo base64_encode('text11');?>" value="{{ $person_owes_support_amount }}" class="form-control w-auto col-md-6">
         </div>
    </div>
    


    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="text12"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="text13"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Printed Name"
            inputFieldName="text14"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <p class="col-md-12 mt-4 text-bold">(Submit this form with all other requested information to your Trustee)</p>

</div>