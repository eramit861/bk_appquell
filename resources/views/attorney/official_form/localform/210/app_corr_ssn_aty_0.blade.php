<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF NEW YORK') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('In re'); ?>" value="" class=" form-control" rows="5"><?php echo $debtorname ?? ''; ?></textarea>
            <select name="<?php echo base64_encode('Roletype'); ?>" class="form-control float_right width_auto mt-2">
                <option value=""></option>
                <option value="Debtor">{{ __('Debtor') }}</option>
                <option selected value="Debtor(s)">{{ __('Debtor(s)') }}</option>
            </select>
        </div> 
        
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case Number"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="row">
            <div class="col-md-3 pt-2">
                <label>{{ __('Chapter') }}</label>
            </div>
            
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Ch.Chapter top'); ?>" class="form-control width_auto mt-2">
                    <option value=""></option>
                    <option <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?> value="7">7</option>
                    <option value="9">9</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>  value="13">13</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('APPLICATION TO CORRECT') }}<br>{{ __('SOCIAL SECURITY NUMBER(S)') }}</h3>
        <p class="text_italic text-center">{{ __('(or other Individual Taxpayer Identification Number(s) (ITIN(s)))') }}</p>
    </div>
    <div class="col-md-12 mt-3">
        <p>To the Hon.
            <select name="<?php echo base64_encode('Judge Selection'); ?>" class="form-control width_auto mt-2">
                <option value=""></option>
                <option value="Carla E. Craig">{{ __('Carla E. Craig') }}</option>
                <option value="Elizabeth S. Stong">{{ __('Elizabeth S. Stong') }}</option>
                <option value="Nancy Hershey Lord">{{ __('Nancy Hershey Lord') }}</option>
                <option value="Robert E. Grossman">{{ __('Robert E. Grossman') }}</option>
                <option value="Alan S. Trust">{{ __('Alan S. Trust') }}</option>
                <option value="Louis A. Scarcella">{{ __('Louis A. Scarcella') }}</option>
            </select>
            {{ __('Bankruptcy Judge:') }}
        </p>
    </div>
    <div class="col-md-12 mt-3">
        <p><label class="pl-4">&nbsp;</label>
            <input type="text" name="<?php echo base64_encode('attorney for the abovenamed Debtors applies to the'); ?>" value="{{$atroneyName}}" class="width_auto form-control">
            {{ __(', attorney for the above-named Debtor(s), applies to the
            Court for an order directing that the official record in this case be modified to reflect the correct
            Social Security Number of the Debtor (and/or Joint Debtor, if applicable). The attorney states the
            following in support of its application:') }}
        </p>
        <p><label class="pl-4">&nbsp;</label>
            1. {{ __('This case was commenced by the filing of a petition under Chapter') }}
            <select name="<?php echo base64_encode('Ch.Chapter main'); ?>" class="form-control width_auto mt-2">
                <option value=""></option>
                <option <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?> value="7">7</option>
                <option value="9">9</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?> value="13">13</option>
                <option value="15">15</option>
            </select>
            {{ __('of the Code on') }}
            <input type="text" name="<?php echo base64_encode('File Date');?>" class="width_auto date_filed  form-control">
            .
        </p>
        <p><label class="pl-4">&nbsp;</label>
            {{ __('2. Due to the below-noted filing omission or clerical error, the correct Social Security
            Number of the Debtor (and/or Joint Debtor, if applicable) was not provided to the Court:') }}
        </p>
        <p><input type="checkbox" name="<?php echo base64_encode('Check Box9');?>" value="Yes"><span class="pl-3">{{ __('Official Form 121, Statement About Your Social Security Number(s) was not submitted at
            the time of filing of the petition.') }}</span></p>
        <p><input type="checkbox" name="<?php echo base64_encode('Check Box10');?>" value="Yes"><span class="pl-3">{{ __('The Social Security Number of the Debtor (and/or Joint Debtor, if applicable) was
            incorrectly stated on the Official Form 121, Statement About Your Social Security
            Number(s), which accompanied the petition.') }}</span></p>
        <p><input type="checkbox" name="<?php echo base64_encode('Check Box11');?>" value="Yes"><span class="pl-3">{{ __('The Social Security Number of the Debtor (and/or Joint Debtor, if applicable) was
            incorrectly entered into the Court record by the Attorney for the Debtor(s) at the
            time of filing of the petition over the Internet.') }}</span></p>
            
    </div>

    <div class="col-md-12 mt-3">
        <p><span class="pl-4 text-bold">{{ __('WHEREFORE') }}</span>
            {{ __(', attorney for the Debtor(s) prays for an order directing correction of the
            Social Security Number(s) of the Debtor(s), and for such further relief as the Court deems just.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Dated" 
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-12">
        <div class="float_right text_italic text-bold">
            <x-officialForm.signVertical
                labelText="Attorney for Debtor(s)"
                signNameField="s"
                sign={{$attorny_sign}}
            ></x-officialForm.signVertical>
        </div>
    </div>

</div>