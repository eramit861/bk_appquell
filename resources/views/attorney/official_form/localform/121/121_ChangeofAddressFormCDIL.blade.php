<div class="row">

    <div class="col-md-12 table_sect">
        <table class="w-100">
            <tr>
                <td class="p-3 w-50">
                    <textarea name="<?php echo base64_encode('Text74');?>" class="form-control" rows="7"></textarea>
                </td>
                <td class="p-3 w-50">{{ __('FOR COURT USE ONLY') }}</td>
            </tr>
            <tr>
                <td class="p-3" colspan="2">
                    <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('CENTRAL DISTRICT OF ILLINOIS') }}</h3>
                </td>
            </tr>
            <tr>
                <td class="p-3" rowspan="2">
                {{ __('Name of Debtor(s) listed on the bankruptcy case') }}:
                    <textarea name="<?php echo base64_encode('Name of Debtor(s)');?>" class="form-control" rows="7"></textarea>
                </td>
                <td class="p-3">
                    <x-officialForm.caseNo
                        labelText="CASE NO.:"
                        casenoNameField="Case Number"
                        caseno="{{$caseno}}"
                    ></x-officialForm.caseNo>
                    <div class="mt-2">
                        <x-officialForm.caseNo
                            labelText="CHAPTER:"
                            casenoNameField="Chapter"
                            caseno={{$chapterNo}}
                        ></x-officialForm.caseNo> 
                    </div>
                </td>
            </tr>
            <tr>
                <td class="p-3">
                    <h3 class="text-center">{{ __('CHANGE OF MAILING ADDRESS') }}</h3>
                </td>
            </tr>
        </table>
    </div>


    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-4">
                <p>
                {{ __('This change of mailing address is requested by') }}:
                    <span class="pl-4"></span>
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box3');?>" value="Yes">
                    {{ __('Debtor') }}
                    <span class="pl-4"></span>
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box4');?>" value="Yes">
                    {{ __('Joint-Debtor') }}
                    <span class="pl-4"></span>
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box5');?>" value="Yes">
                    {{ __('Creditor') }}
                </p>
                <p>{{ __('Attorneys who wish to make a change of mailing address must use CM/ECF.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="text-bold">
                    {{ __('Old Address:') }}
                </p>
                <div class=" pl-2">
                    <x-officialForm.debtorSignVertical
                        labelContent="Name(s):"
                        inputFieldName="Text6"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class=" pl-2 mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="Mailing Address:"
                        inputFieldName="OLD mailing address"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class=" pl-2 mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="City, State, Zip Code:"
                        inputFieldName="OLD City State Zip"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="text-bold">
                    {{ __('New Address:') }}
                </p>
                <div class=" pl-2">
                    <x-officialForm.debtorSignVertical
                        labelContent="Mailing Address:"
                        inputFieldName="NEW mailing address"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class=" pl-2 mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="City, State, Zip Code:"
                        inputFieldName="NEW City State Zip"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-4">
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box6');?>" value="Yes">
                    </div>
                    <div class="w-100 pl-3">
                        <p>{{ __('Check here if you are a Debtor or a Joint Debtor and you receive court orders and notices by email through the
                            Debtor Electronic Bankruptcy Noticing program (DeBN) rather than by U.S. mail to your mailing address. Please
                            provide your DeBN account number below (DeBN account numbers can be located in the subject title of all
                            emailed court orders and notices).') }}</p>
                        <div class=" pl-2 width_60percent">
                            <x-officialForm.debtorSignVertical
                                labelContent="Debtor’s DeBN account number "
                                inputFieldName="Debtor DeBN number"
                                inputValue=""
                            ></x-officialForm.debtorSignVertical>
                        </div>
                        <div class=" pl-2 mt-1 width_60percent">
                            <x-officialForm.debtorSignVertical
                                labelContent="Joint Debtor’s DeBN account number "
                                inputFieldName="Joint Debtor DeBN number"
                                inputValue=""
                            ></x-officialForm.debtorSignVertical>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-7 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent=" Requestor’s printed name(s) "
            inputFieldName="Requestor's printed name"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=" Requestor’s signature(s) "
                inputFieldName=""
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=" Title (if applicable, of corporate officer, partner, or agent) "
                inputFieldName="Title of requestor"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>