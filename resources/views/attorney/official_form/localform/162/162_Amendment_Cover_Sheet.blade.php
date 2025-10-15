<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('EASTERN DISTRICT OF MICHIGAN') }}
        </h3>
        <h3 class="text-center underline">{{ __('COVER SHEET FOR AMENDMENTS') }}</h3>
    </div>
    <div class="col-md-6 border_1px br-0 p-3 text-bold">
        <x-officialForm.debtorSignVertical
            labelContent="Case Name: "
            inputFieldName=""
            inputValue="">
        </x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
        <x-officialForm.caseNo
            labelText="Case No.:"
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>
    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3 underline">{{ __('DESCRIBE INFORMATION BEING AMENDED BY CHECKING APPLICABLE BOX(ES) BELOW') }}</h3>

        <p class="pl-4 mb-1">
            <input type="checkbox" name="<?php echo base64_encode('Amendment to Petition');?>" value="On" class="form-control w-auto height_width_content">
            <span class="text-bold  ">{{ __('Amendment to Petition:') }}</span>
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Name');?>" value="On" class="form-control w-auto height_width_content">{{ __('Name') }}
            <span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Debtors Mailing Address');?>" value="On" class="form-control w-auto height_width_content">{{ __('Debtor(s) Mailing Address') }}
            <span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Alias');?>" value="On" class="form-control w-auto height_width_content">{{ __('Alias') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Signature');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Signature') }}
            <span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Complying with Order Directing the Filing of Official Forms');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Complying with Order Directing the Filing of Official Form(s)') }}
        </p>
        <p class="pl-4 mb-1">
            <input type="checkbox" name="<?php echo base64_encode('Summary of Your Assets and Liabilities and Certain Statistical Information');?>" value="On" class="form-control w-auto height_width_content">
            <span class="text-bold">Summary of Your Assets and Liabilities and Certain Statistical Information</span>
        </p>
        <p class="pl-4 mb-1">
            <input type="checkbox" name="<?php echo base64_encode('Statement of Financial Affairs');?>" value="On" class="form-control w-auto height_width_content">
            <span class="text-bold">{{ __('Statement of Financial Affairs') }}</span>
        </p>

        <p class="pl-4 mb-1">
            <input type="checkbox" name="<?php echo base64_encode('Schedules and List of Creditors');?>" value="On" class="form-control w-auto height_width_content">
            <span class="text-bold">{{ __('Schedules and List of Creditors:') }}</span>
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule AB');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Schedule A/B') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule C');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Schedule C') }}
            <span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Debtor 2 Schedule C');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Debtor 2 Schedule C') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('List of Creditors');?>" value="On" class="form-control w-auto height_width_content"> {{ __('List of Creditors') }}
            <span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule D');?>" value="On" class="form-control w-auto height_width_content">{{ __('Schedule D') }}
            <span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule EF and');?>" value="On" class="form-control w-auto height_width_content">{{ __('Schedule E/F and') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4 ml-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Add creditors provide address of creditor already on the List of Creditors change amount or');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Add creditor(s), provide address of creditor already on the List of Creditors, change amount or classification of debt ‐') }}
            <span class="text-bold"> {{ __('$32.00 Fee Required') }}, </span>
        </p>
        <p class="pl-4 mb-1"><span class="pl-4 ml-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Change address of a creditor already on the List of Creditors  No Fee Required');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Change address of a creditor already on the List of Creditors –') }}
            <span class="text-bold"> {{ __('No Fee Required') }} </span>
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule G');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Schedule G') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule H');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Schedule H') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule I');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Schedule I') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule J');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Schedule J') }}
        </p>
        <p class="pl-4 mb-1"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Schedule J2');?>" value="On" class="form-control w-auto height_width_content">
            {{ __('Schedule J‐2') }}
        </p>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <p class="text-bold pl-4 bg-dgray p-2">{{ __('NOTE: Use Page 2 for any corrections or additions to the List of Creditors') }}</p>
        <div class="row border_1px p-3">
            <div class="col-md-3 pt-2 pl-0">
                <label class="text-bold">{{ __('Additional Details of Amendment(s):') }}</label>
            </div>
            <div class="col-md-9 pl-0 pr-0">
            <input type="text" name="<?php echo base64_encode('undefined');?>" value="" class="form-control mt-1">
            </div>
            <div class="col-md-12 pl-0 pr-0">
            <input type="text" name="<?php echo base64_encode('undefined_2');?>" value="" class="form-control mt-1">
            </div>
        </div>
    </div>
    <div class="col-md-12 table_sect pl-0 pr-0">
        <table class="w-100">
            <tr class="text-bold">
                <td class="p-2"><i class="fas fa-arrow-right"></i></td>
                <td class="p-2" colspan="2"><span class="underline"> {{ __('DECLARATION OF ATTORNEY:') }}</span>
                    {{ __('I declare that the above information contained on this cover sheet may be
                    relied upon by the Clerk of the Court as a complete and accurate summary of the information contained in
                    the documents attached.') }}
                </td>
            </tr>
            <tr class="text-bold">
                <td class="p-2" colspan="2">
                    <label>{{ __('Date') }}</label>
                    <input name="<?php echo base64_encode('Date'); ?>" placeholder="MM/DD/YYYY" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
                </td>
                <td class="p-2" >
                    <label for="">{{ __('Signature') }}</label>
                    <input type="text" name="<?php echo base64_encode('Signature_2');?>" value="" class="form-control">
                </td>
            </tr>
            <tr class="text-bold">
            <td class="p-2"><i class="fas fa-arrow-right"></i></td>
                <td class="p-2" colspan="2">
                    {{ __('AFFIRMATION OF DEBTOR(S): I declare under penalty of perjury that I have read this cover sheet and the
                   attached schedules, lists, statements, etc., and that they are true and correct to the best of my knowledge, information and belief.') }}</td>
            </tr>
            <tr class="text-bold">
                <td class="p-2" colspan="2"> 
                    <label>{{ __('Date') }}</label>
                    <input name="<?php echo base64_encode('Date_2'); ?>" placeholder="MM/DD/YYYY" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
                </td>
                <td class="p-2" >
                    <label for="">{{ __('Signature') }}</label>
                    <input type="text" name="<?php echo base64_encode('Signature_3');?>" value="" class="form-control">
                </td>
            </tr>
            <tr class="text-bold">
                <td class="p-2" colspan="2">
                    <label>{{ __('Date') }}</label>
                    <input name="<?php echo base64_encode('Date_3'); ?>" placeholder="MM/DD/YYYY" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
                </td>
                <td class="p-2">
                    <label for="">{{ __('Signature') }}</label>
                    <input type="text" name="<?php echo base64_encode('Signature_4');?>" value="" class="form-control">
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('CORRECTIONS TO THE LIST OF CREDITORS') }}</h3>
        <p class="text-bold mb-0">{{ __('Use this section to make corrections to the name(s) and address(es) of any creditor(s) listed on the current schedules and List of Creditors.') }}</p>
    </div>
    <div class="col-md-6">
        <?php
            for ($i = 1; $i <= 3; $i++) {
                ?>
        <p class="text-bold mb-0 mt-3">{{ __('PREVIOUS NAME/ADDRESS OF CREDITOR:') }}</p>
        <input type="text" name="<?php echo base64_encode('PREVIOUS NAMEADDRESS OF CREDITOR 1_'.$i);?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('PREVIOUS NAMEADDRESS OF CREDITOR 2_'.$i);?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('PREVIOUS NAMEADDRESS OF CREDITOR 3_'.$i);?>" value="" class="form-control mt-1">
        <?php } ?>
    </div>
    <div class="col-md-6">
        <?php
                    for ($i = 1; $i <= 3; $i++) {
                        ?>
        <p class="text-bold mb-0 mt-3">{{ __('PLEASE CHANGE TO:') }}</p>
        <input type="text" name="<?php echo base64_encode('PLEASE CHANGE TO 1_'.$i);?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('PLEASE CHANGE TO 2_'.$i);?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('PLEASE CHANGE TO 3_'.$i);?>" value="" class="form-control mt-1">
        <?php } ?>
    </div>
    <div class="col-md-12 mt-3">
    <h3 class="text-center mb-3 underline">{{ __('ADDITIONS TO THE LIST OF CREDITORS') }}</h3>
    <p class="text-bold mb-0">{{ __('Use this section to identify creditors added to the schedules and List of Creditors.') }}</p>
    </div>

    <?php
                        for ($i = 1; $i <= 3; $i++) {
                            ?>
    <div class="col-md-2 mt-3">
        <p class="text-bold mb-2 pt-2">{{ __('NAME OF CREDITOR:') }}</p>
        <p class="text-bold mb-0 pt-2">{{ __('ADDRESS:') }}</p>
    </div>
    <div class="col-md-8 mt-3">
        <input type="text" name="<?php echo base64_encode('A1_'.$i);?>" value="" class="form-control ">
        <input type="text" name="<?php echo base64_encode('A2_'.$i);?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('A3_'.$i);?>" value="" class="form-control mt-1">
    </div>
    <div class="col-md-2 mt-3"></div>
    <?php } ?>
    <div class="col-md-12 mt-3 bg-dgray p-2">
        <p class="text-bold text-center underline pt-1 mb-1">{{ __('FOR ADDITIONAL CORRECTIONS/ADDITIONS, COPY THIS SHEET AND CONTINUE') }}</p>
    </div>
</div>
