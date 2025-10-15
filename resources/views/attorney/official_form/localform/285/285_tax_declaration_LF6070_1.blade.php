<div class="row">

    <div class="col-md-3 mt-1 pt-2">
        <label for="">{{ __('Submitting Attorney (Utah State Bar No.)') }}</label>
    </div>
    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('6070-1_Bar Number'); ?>" value="{{$attorney_state_bar_no}}" class="form-control">
    </div>
    
    <div class="col-md-3 mt-1 pt-2">
        <label for="">{{ __('Address') }}</label>
    </div>
    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('6070-1_HeaderAddress'); ?>" value="{{$attonryAddress1}}, {{$attonryAddress2}}, {{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" class="form-control">
    </div>
    
    <div class="col-md-3 mt-1 pt-2">
        <label for="">{{ __('Telephone No.') }}</label>
    </div>
    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('6070-1_HeaderTelephone Number'); ?>" value="{{$attorneyPhone}}" class="form-control width_30percent">
    </div>
    
    <div class="col-md-3 mt-1 pt-2">
        <label for="">{{ __('Facsimile No. (Optional)') }}</label>
    </div>
    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('6070-1_HeaderFax Number'); ?>" value="{{$attorneyFax}}" class="form-control width_30percent">
    </div>
    
    <div class="col-md-3 mt-1 pt-2">
        <label for="">{{ __('E-Mail Address (Recommended)') }}</label>
    </div>
    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('6070-1_Header_Email Address'); ?>" value="{{$attorney_email}}" class="form-control">
    </div>

    <div class="col-md-3 mt-1 pt-2">
        <label for="">{{ __('Attorney for') }}</label>
    </div>
    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('6070-1_Header_Attorney For'); ?>" value="Debtor(s)" class="form-control">
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF UTAH') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('6070-1_Debtor1'); ?>" class=" form-control" rows="2" style="padding-right:5px;">{{$debtorname}}</textarea>
        </div>
        <p class="text-center">
            {{ __('Debtor(s)') }} 
        </p>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Bankruptcy No."
                casenoNameField="6070-1_Case Number"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="6070-1_Chapter"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div>    
        <div class="mt-3">
            <div class="row">
                <div class="col-md-3 pt-2">
                    <label>{{ __('Hon.') }}</label>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('6070-1_Judge Name');?>" type="text" value="" class="form-control">
                </div>
            </div>
        </div>    
    </div>

    <div class="col-md-12 mt-3 text-center border_bottom_1px">
        <h3 class="mb-3">
            {{ __('DECLARATION REGARDING TAX RETURNS') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <div class="">
                <label class="float_right">1.</label>
            </div>
            <div class=" w-100 pl-4">
                <p>{{ __('I/we, the undersigned debtor(s), declare under penalty of perjury that either') }}: (<span class="text_italic">{{ __('check one') }}</span>)</p>
                <p class="mb-0">
                    <!-- checked by default -->
                    <input type="radio" class="form-control w-auto mr-3 height_fit_content" name="<?php echo base64_encode('6070-1Group7');?>" value="Choice1" checked="checked">
                     {{ __('a. All federal and state tax returns for taxable periods ending during the four-year
                    period before the filing of the petition have been filed.') }}
                </p>
                <p class="mb-0">{{ __('OR') }}</p>
                <p class="mb-0">
                    <input type="radio" class="form-control w-auto mr-3 height_fit_content" name="<?php echo base64_encode('6070-1Group7');?>" value="Choice2">
                    {{ __('b. The following tax returns for taxable periods ending during the four-year period
                    before the filing of the petition have not been filed.') }}
                </p>
            </div>
        </div>
        <div class=" table_sect table_sect_head_border mt-3">
            <table class="w-100">
                <tr>
                    <th class="p-2">{{ __('Taxing Agency') }}</th>
                    <th class="p-2">{{ __('Type of Tax Return') }}</th>
                    <th class="p-2">{{ __('Tax Years') }}</th>
                </tr>
                <?php
                for ($k = 1 ; $k <= 4; $k++) {
                    ?>
                    <tr>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Taxing AgencyRow'.$k);?>" class="form-control">
                        </td>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Type of Tax ReturnRow'.$k);?>" class="form-control">
                        </td>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Tax YearsRow'.$k);?>" class="form-control">
                        </td>                
                    </tr>
                <?php
                }
        ?>
            </table>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label class="float_right">2.</label>
            </div>
            <div class=" w-100 pl-4">
                <p class="mb-0">{{ __('Complete for any tax return filed after the filing of the bankruptcy petition.') }}</p>
            </div>
        </div>
        <p class="mt-2">
            <span class="pl-4"></span>
            {{ __('On or before') }} [
            <input type="text" name="<?php echo base64_encode('6070-1Text23');?>" class="form-control w-auto">    
            {{ __('], the above-named debtor(s) delivered the following copies
            of tax returns to the Insolvency Unit of the Internal Revenue Service and/or the Bankruptcy
            Unit of the Utah State Tax Commission and that such returns disclosed the following
            liabilities and/or refunds:') }}
        </p>
        <div class=" table_sect table_sect_head_border mt-3">
            <table class="w-100">
                <tr>
                    <th class="p-2">{{ __('Federal or State') }}</th>
                    <th class="p-2">{{ __('Tax Years') }}</th>
                    <th class="p-2">{{ __('Type of Tax/Form No.') }}</th>
                    <th class="p-2">{{ __('Tax Liability') }}</th>
                    <th class="p-2">{{ __('Tax Refund') }}</th>
                </tr>
                <?php
        for ($k = 1 ; $k <= 3; $k++) {
            ?>
                    <tr>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Federal or StateRow'.$k);?>" class="form-control">
                        </td>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Tax YearRow'.$k);?>" class="form-control">
                        </td>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Type of TaxForm NoRow'.$k);?>" class="form-control">
                        </td>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Tax LiabilityRow'.$k);?>" class="form-control">
                        </td>
                        <td class="p-1">
                            <input type="text" name="<?php echo base64_encode('6070-1Tax RefundRow'.$k);?>" class="form-control">
                        </td>    
                    </tr>
                <?php
        }
        ?>
            </table>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label class="float_right">3.</label>
            </div>
            <div class=" w-100 pl-4">
                <p class="mb-0">{{ __('I/we acknowledge that the court will not confirm any Chapter 13 Plan and the
                case may be dismissed at or before the confirmation hearing unless all tax returns have been
                filed.') }}</p>
            </div>
        </div>
        
        <div class="d-flex mt-3">
            <div class="">
                <label class="float_right">4.</label>
            </div>
            <div class=" w-100 pl-4">
                <p class="mb-0">{{ __('I/we further acknowledge that I/we will file and serve on the trustee an amended
                declaration if further required tax returns are filed with the taxing authorities after the date
                indicated in paragraph 1 above.') }}</p>
            </div>
        </div>
        <p>
        {{ __('Dated this') }}
            <input type="text" name="<?php echo base64_encode('6070-1-Day'); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('6070-1-Month'); ?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('6070-1-Year'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            .
        </p>
    </div>



    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor"
                inputFieldName="6070-1_Signature of Debtor1"
                inputValue="{{$onlyDebtor}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor"
                inputFieldName="6070-1_signature of Debtor2"
                inputValue="{{$spousename}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor(s)’ Counsel"
                inputFieldName="6070-1-Debtor's counsel"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor's Counsel Address and Telephone Number"
                inputFieldName="6070-1-Debtor's counsel Address and Phone Number"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}, {{$attorneyPhone}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>

