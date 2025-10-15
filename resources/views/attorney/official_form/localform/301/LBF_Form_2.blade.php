<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('FOR THE WESTERN DISTRICT OF WASHINGTON') }} <br> www.wawb.uscourts.gov <br><br><span class="underline">{{ __('AMENDMENT COVER SHEET') }}</span></h3>
    </div>
    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-2 pt-2">
                <label>{{ __('DEBTOR(S) LAST NAME') }}</label>
            </div>
            <div class="col-md-10">
            <input name="<?php echo base64_encode('DEBTORS LAST NAME'); ?>" type="text" value="{{$debtorLastName}}" class="form-control">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2 pt-2">
                <label class="pt-2">{{ __('CASE NUMBER') }}</label>
            </div>
            <div class="col-md-4">
            <input name="<?php echo base64_encode('CASE NUMBER'); ?>" type="text" value="{{$caseno}}" class="form-control w-auto">
            </div>
            <div class="col-md-2 pt-2">
                <label class="pt-2">{{ __('CHAPTER') }}</label>
            </div>
            <div class="col-md-4">
                <input name="<?php echo base64_encode('CHAPTER'); ?>" type="text" value="{{$chapterNo}}" class="form-control w-auto">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2 pt-2">
                <label class="pt-2">{{ __('ATTORNEY FOR DEBTOR') }}</label>
            </div>
            <div class="col-md-4">
            <input name="<?php echo base64_encode('ATTORNEY FOR DEBTOR'); ?>" type="text" value="{{$attorney_name}}" class="form-control">
            </div>
            <div class="col-md-2 pt-2">
                <label class="pt-2">{{ __('PHONE') }}</label>
            </div>
            <div class="col-md-4">
            <input name="<?php echo base64_encode('PHONE'); ?>" type="text" value="{{$attorneyPhone}}" class="form-control w-auto">
            </div>
        </div>
        <p class="text_italic mt-3">See <span class="text-bold underline">{{ __('Local Rule of Bankruptcy Procedure 1009-1: Amendments to Petition, Lists, Schedules and Statements') }} </span> {{ __('for additional information and noticing requirements.') }}</p>
    </div>

    <div class="col-md-12 mt-3 mb-4 text-center">
        <h3>{{ __('PLEASE CHECK WHAT IS BEING AMENDED') }}</h3>
    </div>
    <div class="col-md-12 mt-3 pl-0">
        <p class="text-bold">
        {{ __('*ONLY ONE $32 FEE IS REQUIRED IF AN AMENDMENT CONTAINS MORE THAN ONE CHANGE TOTHE SCHEDULES AND LIST OF CREDITORS. SUBMIT ORIGINAL ONLY – NO COPIES REQUIRED') }}
        </p>

        <div class="d-flex mt-2 pl-4">
            <span class="pr-2 text-bold">1.</span>
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('PETITION Change a debtors name requires Ex Parte Motion  Order No fee required'); ?>" value="On">
            <div>
                <p class="mb-1">
                   <span class="text-bold">{{ __('PETITION') }}</span> {{ __('- Change a debtor(s) name requires Ex Parte Motion & Order (No fee required)') }}
                </p>
            </div>
        </div>
        <div class="mt-2 pl-4">
            <p class="text-bold mb-1">
                <span class="pr-2">2.</span>
                {{ __('MAILING MATRIX (LIST OF CREDITORS):') }}
            </p>
        </div>
        <div class="d-flex mt-2 pl-3">
            <span class="pl-4"></span>
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Adding Deleting Creditors Requires 32 Fee'); ?>" value="On">
            <div>
                <p class="mb-1 text-bold">
                    {{ __('Adding, Deleting Creditors (Requires $32 Fee)') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-2 pl-3">
            <span class="pl-4"></span>
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Changing the address of a creditor or an attorney for a creditor listed on the'); ?>" value="On">
            <div>
                <p class="mb-1 text-bold">
                    {{ __('Changing the address of a creditor or an attorney for a creditor listed on theschedules or to adding the name
                    and address of an attorney for a listed creditor.(No fee required)') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-2 pl-3">
            <span class="pl-4"></span>
            <div>
                <p class="mb-1">
                    <span class="text-bold"> When submitting an amended matrix, send matrix with <span class="alert-red underline ">{{ __('ONLY') }}</span> {{ __('the amended creditors.') }}</span>ECF filers are required to upload additional creditors into ECF by selecting Bankruptcy, Creditor Maintenance.
                </p>
            </div>
        </div>
    </div>
    <div class="d-flex mt-2 pl-4">
        <span class="pr-2 text-bold">3.</span>
        <div>
            <span class="text-bold"> {{ __('SCHEDULES:') }} </span> A declaration is required with <span class="text-bold"> all </span>amended schedules. Form 106Dec-DeclarationAbout an Individual Debtor's Schedules (individuals) <span class="text-bold underline"> or </span>{{ __('Form 202-Declaration Under Penalty ofPerjury for Non-Individual Debtors (businesses)') }}
        </div>
    </div>
    <div class="d-flex mt-2 pl-3 w-100">
        <span class="pl-4"></span>
        <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('D EF Requires 32 fee A fee is charged to add creditors delete creditors change'); ?>" value="On">
        <div>
            <p class="mb-1 text-bold">
            {{ __('D, E/F (Requires $32 fee) - A fee is charged to add creditors, delete creditors, changethe amount of a debt, or change the classification of a debt.') }}
            </p>
        </div>
    </div>
    <div class="d-flex mt-2 pl-3  w-100">
            <span class="pl-4"></span>
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('AB C G H I J J2 No fee required'); ?>" value="On">
        <div>
            <p class="mb-1 text-bold">
                {{ __('A/B, C, G, H, I, J, J-2 (No fee required)') }}
            </p>
        </div>
    </div>
    <div class="mt-2 pl-4">
        <p class="text-bold mb-1">
            <span class="pr-2">4.</span>
                {{ __('AMENDING AMOUNTS/TOTALS OF SCHEDULES:') }}
        </p>
    </div>
    <div class="d-flex mt-2 pl-3  w-100">
        <span class="pl-4"></span>
        <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('D EF Requires 32 fee'); ?>" value="On">
        <div>
            <p class="mb-1 text-bold">
            {{ __('D, E/F (Requires $32 fee)') }}
            </p>
        </div>
    </div>
    <div class="d-flex mt-2 pl-3  w-100">
        <span class="pl-4"></span>
        <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('AB C G H I J J2 No fee required_2'); ?>" value="On">
        <div>
            <p class="mb-1 text-bold">
            {{ __('A/B, C, G, H, I, J, J-2 (No fee required)') }}
            </p>
        </div>
    </div>
    <div class="d-flex mt-2 pl-4">
        <span class="pr-2 text-bold">5.</span>
        <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('STATEMENT OF FINANCIAL AFFAIRS No fee required'); ?>" value="On">
        <div>
            <p class="mb-1 text-bold">
              {{ __('STATEMENT OF FINANCIAL AFFAIRS (No fee required)') }}
            </p>
        </div>
    </div>
</div>