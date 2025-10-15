<div class="row">
    <div class="col-md-12">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('EASTERN DISTRICT OF TEXAS') }}
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group">
            <label for="">{{ __('IN RE:') }}</label>
            <textarea rows="3" name="<?php echo base64_encode('Text7'); ?>" class="form-control"><?php echo $debtorname ?? ''; ?></textarea>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Bankruptcy Case Number"
                casenoNameField="Text8"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('NOTICE OF CHANGE IN SCHEDULE OF CREDITORS') }}
        </h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="pl-4">
            {{ __('In accordance with LBR 1007(b)7, the attached amended schedule is filed for the following
            reason (check only one):') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box9'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Add Creditor(s) [requires $32.00 filing fee]') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box10'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Delete Creditor(s) [requires $32.00 filing fee]') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box12'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Change the Amount of a Debt [requires $32.00 filing fee]') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box13'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Change the Classification of a Debt [requires $32.00 filing fee]') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box14'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Change address of Creditor(s) or add an Attorney for a Creditor (no fee required)') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box15'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Amendment to Schedule C - Property Claimed as Exempt') }} <span class="text-c-red">{{ __('[requires service on matrix]') }}<span>
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box16'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Amendment to Schedule I - Current Income of Individual Debtor(s)') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box17'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Amendment to Schedule J - Current Expenditures of Individual Debtor(s)') }}
        </p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check Box18'); ?>" class="w-auto form-control" value="Yes">
            {{ __('Initial Amended Schedules due to Chapter Conversion') }}
        </p>
    </div>

    <div class="col-md-12 p-3 border_1px">
        <p class="p_justify mb-0">
        {{ __('Instructions: A separate Notice of Change is required when both adding and deleting creditors. An
            amended (partial) matrix is require to add or delete creditors.') }} <span class="text-bold"> {{ __('ANNOTATE CLEARLY SO CHANGES
            ARE EASILY UNDERSTANDABLE.') }}</span> <span class="underline">{{ __('Do Not Refile A Complete New Matrix.') }}</span> {{ __('Only those creditors
            affected by the amended schedule should be shown on the matrix. If the $32.00 filing fee is
            required, multiple filings of a Notice of Change filed') }} <span class="underline">{{ __('in the same case at the same time') }}</span> {{ __('require only
            a single $32.00 fee. Adding or deleting creditors at different times require a fee each time.') }}
        </p>
    </div>

    <div class="col-md-12 p-3 border_1px mt-3">
        <p class="p_justify mb-0">
            {{ __('I, or each of us, declare under penalty of perjury that I/we have read the changes in the List
            of Creditors (Master Mailing List (matrix)) and to the schedules and statements as attached
            hereto and that they are correct to the best of my/our knowledge, information and belief.') }}
        </p>
        <div class="row mt-3">
            <div class="col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Text19"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
            <div class="col-md-6">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Debtor Signature"
                    inputFieldName="Text20"
                    inputValue={{$debtor_sign}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-6 mt-2">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Text21"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
            <div class="col-md-6 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Joint Debtor Signature"
                    inputFieldName="Text22"
                    inputValue={{$debtor2_sign}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
    </div>
    



    
</div>