<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
        {{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF VIRGINIA') }}<br>
            <input type="text" name="<?php echo base64_encode('DIV'); ?>" class="form-control w-auto mr-1">
            {{ __('Division') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In re') }}</label>
        <input type="text" name="<?php echo base64_encode('DEBTORNAME1'); ?>" class="form-control" value="{{$onlyDebtor}}">
        <div class="text-center">
            <input type="text" name="<?php echo base64_encode('DEBTORNAME2'); ?>" class="form-control mt-1" value="{{$spousename}}">
            <label>{{ __('Debtor(s)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="CASENO"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="CHP"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('COVER SHEET FOR LIST OF CREDITORS') }}</h3>
    </div>
    
    <div class="col-md-12">
        <p>
            <span class="pl-4"></span>
            {{ __('I hereby certify under penalty of perjury that the master mailing list of creditors
            submitted either on flash drive or by a typed hard copy in scannable format, with
            Request for Waiver attached, is a true, correct and complete listing to the best of my
            knowledge.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('I further acknowledge that (1) the accuracy and completeness in preparing the
            creditor listing are the shared responsibility of the debtor and the debtor’s attorney, (2)
            the court will rely on the creditor listing for all mailings, and (3) that the various
            schedules and statements required by the Bankruptcy Rules are not used for mailing
            purposes.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('Master mailing list of creditors submitted via:') }}
        </p>
    </div>

    <div class="col-md-1"></div>
    <div class="col-md-11">
        <p>
            (a) 
            <input type="checkbox" name="<?php echo base64_encode('BOX1'); ?>" class="form-control height_fit_content w-auto" value="Yes">
            {{ __('flash drive listing a total of') }} 
            <input type="text" name="<?php echo base64_encode('BOX2'); ?>" class="form-control w-auto">
            {{ __('creditors; or') }}
        </p>
        <p>
            (b) 
            <input type="checkbox" name="<?php echo base64_encode('BOX3'); ?>" class="form-control height_fit_content w-auto" value="Yes">
            {{ __('scannable hard copy, with Request for Waiver attached,
            consisting of') }} 
            <input type="text" name="<?php echo base64_encode('BOX4'); ?>" class="form-control w-auto">
            {{ __('pages, listing a total of') }} 
            <input type="text" name="<?php echo base64_encode('BOX5'); ?>" class="form-control w-auto">
            {{ __('creditors') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <div class="text-center">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor"
                inputFieldName="db"
                inputValue={{$onlyDebtor}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="text-center">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor"
                inputFieldName="jdb"
                inputValue={{$spousename}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="DTE"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <p>
            <span class="text_italic">{{ __('[Check if applicable]') }} </span>
            <input type="checkbox" name="<?php echo base64_encode('FORIN'); ?>" class="form-control height_fit_content w-auto" value="Yes">
            {{ __('Creditor(s) with
            foreign addresses included on flash drive/hard
            copy.') }}
        </p>
    </div>

</div>