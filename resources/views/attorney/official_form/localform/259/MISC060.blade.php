<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF TENNESSEE') }}</h3>
    </div>

    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h3>{{ __('Tax Return Cover Sheet') }}</h3>
        <p >{{ __('consistent with 11 U.S.C. Sec. 521(e) and (f)') }}</p>
    </div>
    <div class="col-md-4"></div>


    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <label>{{ __('Chapter 7') }}</label>          
        </div>          
    </div>
    
    <div class="col-md-12 mt-3">
        <label class="text_italic">{{ __('Please Check the Appropriate Box.') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <label class="text-bold">{{ __('For Debtor:') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-12">
                <p>(<input name="<?php echo base64_encode('Check Box2')?>" value="Yes" type="checkbox" class="form-control width_auto mr-1">{{ __(') Tax Returns are attached.') }}</p>
            </div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Number of Pages attached:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input name="<?php echo base64_encode('Number of Pagesattached')?>" type="text" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Tax Year Covered:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input name="<?php echo base64_encode('Tax Year Covered')?>" type="text" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-12 mt-3">
                <p>(<input name="<?php echo base64_encode('Check Box3')?>" value="Yes" type="checkbox" class="form-control width_auto mr-1">{{ __(') No Tax Returns are attached (the debtor was not required to file a tax return for the 2 years prior to filing the bankruptcy petition).') }}</p>
            </div>

            <div class="col-md-12">
                <p>(<input name="<?php echo base64_encode('Check Box4')?>" value="Yes" type="checkbox" class="form-control width_auto mr-1">{{ __(') No Tax Returns are attached for other reason, or pages to the tax returns are missing.') }}</p>
            </div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('(please explain):') }}</label>
            </div>
            <div class="col-md-7 mt-1">
                <input name="<?php echo base64_encode('please explain')?>" type="text" class="form-control">
            </div>
            <div class="col-md-1 mt-1">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <label class="text-bold">{{ __('For Joint Debtor, if applicable:') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-12">
                <p>(<input name="<?php echo base64_encode('Check Box5')?>" value="Yes" type="checkbox" class="form-control width_auto mr-1">{{ __(') Tax Returns are attached.') }}</p>
            </div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Number of Pages attached:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input name="<?php echo base64_encode('Number of Pagesattached_2')?>" type="text" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Tax Year Covered:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input name="<?php echo base64_encode('Tax Year Covered_2')?>" type="text" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-12 mt-3">
                <p>(<input name="<?php echo base64_encode('Check Box6')?>" value="Yes" type="checkbox" class="form-control width_auto mr-1">{{ __(') No Tax Returns are attached (the debtor was not required to file a tax return for the 2 years prior to filing the bankruptcy petition).') }}</p>
            </div>

            <div class="col-md-12">
                <p>(<input name="<?php echo base64_encode('Check Box7')?>" value="Yes" type="checkbox" class="form-control width_auto mr-1">{{ __(') No Tax Returns are attached for other reason, or pages to the tax returns are missing.') }}</p> 
            </div>
            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('(please explain):') }}</label>
            </div>
            <div class="col-md-7 mt-1">
                <input name="<?php echo base64_encode('please explain_2')?>" type="text" class="form-control">
            </div>
            <div class="col-md-1 mt-1">
            </div>

            <div class="col-md-12 mt-3">
                <p>{{ __('I declare under penalty of perjury that the statements in this Tax Return Cover Sheet are true and correct to the best of my knowledge, information and belief.') }}</p>
            </div>

            <div class="col-md-8 mt-3">
                <x-officialForm.debtorSignVertical
                    labelContent="Signature of Debtor:"
                    inputFieldName="Text8"
                    inputValue={{$debtor_sign}}>
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="col-md-4 mt-3">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>

            <div class="col-md-8 mt-3">
                <x-officialForm.debtorSignVertical
                    labelContent="Signature of Joint Debtor:"
                    inputFieldName="Text9"
                    inputValue={{$debtor2_sign}}>
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="col-md-4 mt-3">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date_2"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>
    </div>

</div>
