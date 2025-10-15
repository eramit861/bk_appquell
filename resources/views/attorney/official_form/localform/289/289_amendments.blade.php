<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF VIRGINIA') }}<br>
        <select name="<?php echo base64_encode('Division'); ?>" class="form-control w-auto">
            <option value="Select Division" selected="true">{{ __('Select Division') }}</option>
            <option value="Alexandria">{{ __('Alexandria') }}</option>
            <option value="Newport News">{{ __('Newport News') }}</option>
            <option value="Norfolk">{{ __('Norfolk') }}</option>
            <option value="Richmond">{{ __('Richmond') }}</option>
        </select>
        {{ __('Division') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In re') }}</label>
        <input type="text" name="<?php echo base64_encode('case@cs_short_name1'); ?>" class="form-control" value="{{$onlyDebtor}}">
        <div class="mt-1">
            <input type="text" name="<?php echo base64_encode('case@cs_short_name2'); ?>" class="form-control" value="{{$spousename}}">
            <p class="text-center mb-0">{{ __('Debtor(s)') }}</p>  
        </div>
    </div> 
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="case@cs_case_number"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="case@cs_chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('AMENDMENT COVER SHEET') }}</h3>
        <p class="mt-3">
            {{ __('Amendment(s) to the following petition, list(s), schedule(s) or statement(s) are transmitted herewith:') }}
        </p>
    </div>
    
    <div class="col-md-12 pl-4">
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('VOL PET'); ?>" class="form-control height_fit_content mt-2 w-auto">
            <div class="w-100">
                <p class="mb-2">
                {{ __('Involuntary/Voluntary Petition') }} 
                    <span class="text_italic">
                    {{ __('[Specify reason for amendment') }}:
                        <input type="text" name="<?php echo base64_encode('REASON FOR AMENDMENT'); ?>" class="form-control width_50percent mr-0">]
                        <br>
                        {{ __('Check if applicable:') }}</span>
                        <input type="checkbox" value="On" name="<?php echo base64_encode('CRED ADD'); ?>" class="form-control w-auto">
                        {{ __('Soc. Sec. No. amended.') }} 
                        <span class="text-bold">
                        {{ __('[If applicable: An original, signed Official Form 121 was
                            mailed/hand-delivered to the Clerk’s Office on') }}
                            <input type="text" name="<?php echo base64_encode('dte'); ?>" class="form-control w-auto mr-0">
                            .*]
                        </span>
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box3'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Summary of Your Assets and Liabilities (and Certain Statistical Information - Individuals Only)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH SUM'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Declaration (Individuals - Form 106Dec) (Non-Individuals - Form 202)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH A'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Schedule A/B - Property') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box1'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Schedule C - The Property You Claim as Exempt') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH B'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Schedule D - Creditors Who Hold Claims Secured by Property (See LBR 1009-1)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH C'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                {{ __('Schedule E/F Creditors Who Have Unsecured Claims (See LBR 1009-1)') }}
                    <br>
                    <span class="text-bold text_italic">
                        {{ __('( $32.00 fee required if adding or deleting pre-petition creditors, changing amounts owed or classification of
                        debt.)') }} 
                    </span>
                    <span class="text-bold">
                    {{ __('Check applicable statement(s)') }}:
                        <br>
                        <input type="checkbox" value="On" name="<?php echo base64_encode('SCH D'); ?>" class="form-control w-auto ml-4">
                        {{ __('Creditor(s) added') }}
                        <input type="checkbox" value="On" name="<?php echo base64_encode('NO CRED ADD'); ?>" class="form-control w-auto ml-4">
                        {{ __('Creditor(s) deleted') }}
                        <br>
                        <input type="checkbox" value="On" name="<?php echo base64_encode('SCH I'); ?>" class="form-control w-auto ml-4">
                        {{ __('Change in amounts owed or classification of debt') }}
                        <br>
                        <input type="checkbox" value="On" name="<?php echo base64_encode('SCH J'); ?>" class="form-control w-auto ml-4">
                        {{ __('No pre-petition creditors added/deleted, or amounts owed or classification of debt
                        changed.') }}
                    </span>
                    {{ __('[Docket:') }}
                    <span class="text-bold">
                    {{ __('Amended Schedule(s) and/or Statement(s), List(s)-NO
                    FEE)') }}
                    <br>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box2'); ?>" class="form-control w-auto ml-4">
                        {{ __('Post-petition creditors added (Schedule of Unpaid Debts)') }}
                        <br>
                        {{ __('REMINDER:') }} 
                        <span class="underline">
                        {{ __('Conversion of Chapter 13 to Chapter 7') }}
                        </span>
                         {{ __('- only file Schedule of Unpaid Debts.') }}
                    </span>
                    
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH E'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Schedule G - Executory Contracts and Unexpired Leases') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH F'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Schedule H - Your Codebtors') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH G'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Schedule I - Your Income') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('SCH H'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="">
                    {{ __('Schedule J - Your Expenses') }}
                </p>
            </div>
        </div>
        
        <p class=" p_justify text-bold">
        {{ __("[NOTE: The form “NOTICE TO CREDITOR(S) (RE AMENDMENT)” is still required when adding or deleting creditors.
            *Amendment of debtor(s) Social Security Number requires that this cover sheet together with a completed Official Form 121
            - Statement About Your Social Security Numbers be electronically filed or submitted to the Clerk's Office for “restricted”
            entry of the amended Social Security Number into the case record.]") }}
        </p>

        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('STMT FIN AFF'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Statement of Financial Affairs') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('STMT INT'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Statement of Intention for Individuals Filing Under Chapter 7') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('EQ SEC HLD'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Chapter 11 List of Equity Security Holders') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('LST 20 LGST UNSEC CLMS'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Chapter 11: The List of Creditors Who Have the 20 Largest Unsecured Claims Against You Who Are Not Insiders') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('DISCL COMP ATTY DBTR'); ?>" class="form-control height_fit_content w-auto">
            <div class="w-100">
                <p class="mb-2">
                    {{ __('Attorney’s Disclosure of Compensation') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" value="On" name="<?php echo base64_encode('OTHER'); ?>" class="form-control height_fit_content w-auto mt-2">
            <div class="w-100">
                <p class="">
                {{ __('Other') }}: 
                    <input type="text" name="<?php echo base64_encode('DESCRIPTION OF OTHER PLEADING'); ?>" class="form-control width_50percent mr-0">
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <h3 class="text-center">{{ __('NOTICE OF AMENDMENT(S) TO AFFECTED PARTIES') }}</h3>
        <p class="mt-3">
        {{ __('Pursuant to Federal Rule of Bankruptcy Procedure 1009(a) and Local Rule 1009-1, I certify that notice of the filing of the
            amendment(s) checked above has been given this date to the United States Trustee, the trustee in this case, and to any and all entities
            affected by the amendment as follows') }}:
            <input type="text" name="<?php echo base64_encode('PARTIES AFFECTED1'); ?>" class="form-control width_50percent">
            <input type="text" name="<?php echo base64_encode('PARTIES AFFECTED2'); ?>" class="form-control">

        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="DTE"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div>
            <input type="text" name="<?php echo base64_encode('ATTYSIG'); ?>" value="{{$attorney_name}}" class="form-control">
            <label for=""> {{ __('Attorney for Debtor(s) [or') }} <span class="text_italic">{{ __('Pro Se') }}</span> {{ __('Debtor(s)]') }}</label>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="State Bar No.:"
                inputFieldName="ST BAR #"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <div class="row">
                <div class="col-md-4 p-2">
                    <label>{{ __('Mailing Address:') }}</label>
                </div>
                <div class="col-md-8">
                    <textarea name="<?php echo base64_encode('ADDR LINE1'); ?>" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Telephone No.:"
                inputFieldName="TELE #"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>