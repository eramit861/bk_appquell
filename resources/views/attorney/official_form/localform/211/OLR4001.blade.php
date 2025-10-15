<div class="row">
    <div class="col-md-12 mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF NEW YORK') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="topmostSubform[0].Page1[0].TextField1[0]"
            debtorname={{$debtorname}}
            rows="3">
        </x-officialForm.inReDebtorCustom>
        <div class="row mt-2">
            <div class="col-md-7 pt-2 pr-0">
                <label>{{ __('Employer’s Tax Identification No(s). [if any]') }}</label>
            </div>
            <div class="col-md-5 pl-0">
                <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[0]');?>" placeholder="" type="text" value="" class="w-auto form-control">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-7 pt-2 pr-0">
                <label>{{ __('Last four digits of Social Security No(s):') }}</label>
            </div>
            <div class="col-md-5 pl-0">
                <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[1]');?>" placeholder="" type="text" value="{{$last_4_ssn_d1}}" class="w-auto form-control">
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case Number."
                casenoNameField="topmostSubform[0].Page1[0].TextField2[2]"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="topmostSubform[0].Page1[0].TextField2[3]"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <h3 class="text-center">
        {{ __('CERTIFICATION OF PAYMENT HISTORY ON THE NOTE AND MORTGAGE') }}<br>
        {{ __('DATED') }}
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].DateTimeField1[0]');?>" type="text" class="form-control width_auto">
            {{ __('AND RELATED INFORMATION') }}
        </h3>
        <p class="mt-3">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[4]');?>" type="text" class="form-control width_auto">
            {{ __('of full age, employed as') }}            
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[5]');?>" type="text" class="form-control width_auto">
            {{ __('by') }}
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[6]');?>" type="text" class="form-control width_auto">
            {{ __(', hereby certifies the following information:') }}
        </p>
        <p class="">
        {{ __('Mortgage Recorded on') }}: 
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].DateTimeField2[0]');?>" type="text" class="form-control width_auto">
            , {{ __('in') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[7]');?>" type="text" class="form-control width_auto">
            {{ __('County, in Book') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[8]');?>" type="text" class="form-control width_auto">
            {{ __('at Page') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[9]');?>" type="text" class="form-control width_auto">
        </p>
    </div>

    <div class="col-md-4 p-2 pl-3">
        <label for="">{{ __('Property Address:') }}</label>
    </div>
    <div class="col-md-8">
        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[10]');?>" type="text" class="form-control">
    </div>
    
    <div class="col-md-4 p-2 pl-3 mt-1">
        <label class="">{{ __('Mortgage Holder:') }}</label>
    </div>
    <div class="col-md-8 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[11]');?>" type="text" class="form-control">
    </div>
    
    <div class="col-md-4 p-2 pl-3 mt-1">
        <label class="">{{ __('Movant’s relationship to Mortgage Holder:') }}</label>
    </div>
    <div class="col-md-8 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[12]');?>" type="text" class="form-control">
    </div>
    
    <div class="col-md-4 p-2 pl-3 mt-1">
        <label class="">{{ __('Mortgagor(s)/Debtor(s):') }}</label>
    </div>
    <div class="col-md-8 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[13]');?>" type="text" class="form-control">
    </div>
    
    <div class="col-md-4 p-2 pl-3 mt-1">
        <label class="">{{ __('Bankruptcy Petition filed on:') }}</label>
    </div>
    <div class="col-md-8 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[14]');?>" type="text" class="form-control">
    </div>
    
    <div class="col-md-4 p-2 pl-3 mt-1">
        <label class="">{{ __('First Post-Petition Mortgage Payment Due:') }}</label>
    </div>
    <div class="col-md-8 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[15]');?>" type="text" class="form-control">
    </div>

    <div class="col-md-12 mt-3">
        <h3>{{ __('POST-PETITION PAYMENT HISTORY:') }}</h3>
    </div>

    <div class="col-md-12 mt-3 table_sect table_sect_head_border">
        <table class="w-100">
            <tr>
                <th class="p-2"></th>
                <th class="p-2">{{ __('Amount Due') }}</th>
                <th class="p-2">{{ __('Date Payment Was Due') }}</th>
                <th class="p-2">{{ __('How Payment was Applied (Mo./Yr.)') }}</th>
                <th class="p-2">{{ __('Amount Received') }}</th>
                <th class="p-2">{{ __('Date Payment Received') }}</th>
                <th class="p-2">{{ __('Check or Money Order Number') }}</th>
            </tr>
            <?php
                for ($i = 1 ; $i <= 8; $i++) {
                    ?>
                <tr>
                    <td class="pl-2 pr-2">{{$i}}.</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].AmountDue'.$i.'[0]');?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].B'.$i);?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].C'.$i);?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].AmountRcvd'.$i.'[0]');?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].E'.$i);?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].F'.$i);?>" class="form-control"></td>
                </tr>
            <?php
                }
                ?>
            
            <?php
                    for ($i = 9 ; $i <= 24; $i++) {
                        ?>
                <tr>
                    <td class="pl-2 pr-2">{{$i}}.</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].AmountDue'.$i.'[0]');?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].B'.$i);?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].C'.$i);?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].AmountRcvd'.$i.'[0]');?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].E'.$i);?>" class="form-control"></td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].F'.$i);?>" class="form-control"></td>
                </tr>
            <?php
                    }
                ?>
            <tr>
                <td class="p-2">{{ __('TOTAL') }}</td>
                <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].Total1');?>" class="form-control bg-none" disabled></td>
                <td class="bg_table_cell"></td>
                <td class="bg_table_cell"></td>
                <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].Total2');?>" class="form-control bg-none" disabled></td>
                <td class="bg_table_cell"></td>
                <td class="bg_table_cell"></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <h3>{{ __('MONTHLY POST-PETITION PAYMENTS PAST DUE:') }}</h3>
    </div>

    <div class="col-md-12 mt-2">
        <p>
        {{ __('Number of Payments Past Due]') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[7]');?>" type="text" class="form-control width_auto mt-1">
            {{ __('multiplied by [Monthly Payment Amount, Exclusive of
            Late Charges and Other Charges]') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[0]');?>" type="text" class="form-control width_auto mt-1">
            = 
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[1]');?>" type="text" class="form-control width_auto mt-1" disabled>
            {{ __('Due as of') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].DateTimeField2[32]');?>" type="text" class="form-control width_auto mt-1">
            .
        </p>
        <p>
            {{ __('Itemize Past-Due Late Charges and Other Additional Charges Below. Attach a separate sheet, if
            necessary.') }}
        </p>
    </div>

    <div class="col-md-12 mt-1 table_sect table_sect_head_border">
        <table class="w-100">
            <tr>
                <th class="p-2">{{ __('Type of Charge') }}</th>
                <th class="p-2">{{ __('Date Incurred') }}</th>
                <th class="p-2">{{ __('Relative to Payment Due On') }}</th>
                <th class="p-2">{{ __('Amount') }}</th>
            </tr>
            <?php
                    for ($i = 1 ; $i <= 6; $i++) {
                        ?>
                <tr>
                    <td class="p-1"><input name="<?php echo base64_encode('topmostSubform[0].Page2[0].A'.$i);?>" type="text" class="form-control"></td>
                    <td class="p-1"><input name="<?php echo base64_encode('topmostSubform[0].Page2[0].B'.$i);?>" type="text" class="form-control"></td>
                    <td class="p-1"><input name="<?php echo base64_encode('topmostSubform[0].Page2[0].C'.$i);?>" type="text" class="form-control"></td>
                    <td class="p-1"><input name="<?php echo base64_encode('topmostSubform[0].Page2[0].D'.$i);?>" type="text" class="form-control"></td>
                </tr>
            <?php
                    }
                ?>
            <tr>
                <td class="p-2">{{ __('Total Additional Charges Amount Due') }}</td>
                <td class="p-2 bg_table_cell"></td>
                <td class="p-2 bg_table_cell"></td>
                <td class="p-1"><input type="text" name="<?php echo base64_encode('topmostSubform[0].Page2[0].TotalAmount[0]');?>" class="form-control bg-none" disabled></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <h3>{{ __('EACH CURRENT MONTHLY PAYMENT IS COMPRISED OF:') }}</h3>
    </div>

    <div class="col-md-3 p-2 pl-3 mt-2">
        <div class="horizontal_dotted_line">
            <label>{{ __('Principal') }}</label>
        </div>
    </div>
    <div class="col-md-3 mt-2">
        <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[2]');?>" type="text" class="form-control width_auto">
    </div>
    <div class="col-md-6 mt-2"></div>
    
    <div class="col-md-3 p-2 pl-3 mt-1">
        <div class="horizontal_dotted_line">
            <label>{{ __('Interest') }}</label>
        </div>
    </div>
    <div class="col-md-3 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[3]');?>" type="text" class="form-control width_auto">
    </div>
    <div class="col-md-6 mt-1"></div>
    
    <div class="col-md-3 p-2 pl-3 mt-1">
        <div class="horizontal_dotted_line">
            <label>{{ __('R.E. Taxes') }}</label>
        </div>
    </div>
    <div class="col-md-3 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[4]');?>" type="text" class="form-control width_auto">
    </div>
    <div class="col-md-6 mt-1"></div>
    
    <div class="col-md-3 p-2 pl-3 mt-1">
        <div class="horizontal_dotted_line">
            <label>{{ __('Insurance') }}</label>
        </div>
    </div>
    <div class="col-md-3 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[5]');?>" type="text" class="form-control width_auto">
    </div>
    <div class="col-md-6 mt-1"></div>
    
    <div class="col-md-3 p-2 pl-3 mt-1">
        <div class="horizontal_dotted_line">
            <label>{{ __('Late Charge') }}</label>
        </div>
    </div>
    <div class="col-md-3 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].NumericField1[6]');?>" type="text" class="form-control width_auto">
    </div>
    <div class="col-md-6 mt-1"></div> 
    
    <div class="col-md-3 p-2 pl-3 mt-1">
        <div class="horizontal_dotted_line">
            <label>{{ __('Other') }}</label>
        </div>
    </div>
    <div class="col-md-3 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].NumericField1[0]');?>" type="text" class="form-control width_auto">
    </div>
    <div class="col-md-2 p-2 pl-3 mt-1">
        <label>{{ __('(Specify)') }}</label>
    </div>
    <div class="col-md-4 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].TextField2[0]');?>" type="text" class="form-control">
    </div>
    
    <div class="col-md-3 p-2 pl-3 mt-1">
        <div class="horizontal_dotted_line">
            <label>TOTAL</label>
        </div>
    </div>
    <div class="col-md-3 mt-1">
        <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].NumericField1[1]');?>" type="text" class="form-control width_auto">
    </div>
    <div class="col-md-6 mt-1"></div> 

    <div class="col-md-12 mt-3">
        <p>{{ __('If the monthly payment has changed during the pendency of the case, please explain (attach a
        separate sheet, if necessary):') }}</p>
    </div>  

    <div class="col-md-12 mt-3">
        <h3>{{ __('MONTHLY PRE-PETITION PAYMENTS PAST DUE:') }}</h3>
    </div>

    <div class="col-md-12 mt-2">
        <p>{{ __('[Number of Payments Past Due] [From Date] [To Date] multiplied by [Monthly Payment
        Amount Inclusive of Late Charges and Other Charges]') }}</p>
        <p> 
            <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].NumericField1[2]');?>" type="text" class="form-control width_auto">
            = 
            <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].NumericField1[3]');?>" type="text" class="form-control width_auto">
            {{ __('Due as of') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].DateTimeField2[0]');?>" type="text" class="form-control width_auto">
            .
        </p>
        <h3 class="text-center">{{ __('REQUIRED ATTACHMENTS TO MOTION') }}</h3>
    </div> 

    <div class="col-md-12 mt-3">
        <p>
            {{ __('Please attach the following documents to your motion and indicate the exhibit number associated
            with the documents.') }}
        </p>
        <div class="row">
            <div class="col-md-1">
                <label class="float_right">(1)</label>
            </div>
            <div class="col-md-11 p_justify">
                <p> 
                {{ __('Copies of documents that indicate Movant’s interest in the subject property. For
                    purposes of example only, a complete and legible copy of the promissory note or
                    other debt instrument together with the complete and legible copy of the mortgage
                    and any assignments of the note and mortgage in the chain of title from the original
                    mortgagee to the current moving party') }}. (Exhibit 
                    <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].TextField2[1]');?>" type="text" class="form-control width_auto">
                    .)
                </p>
            </div> 
            
            <div class="col-md-1">
                <label class="float_right">(2)</label>
            </div>
            <div class="col-md-11 p_justify">
                <p> 
                {{ __('Copies of documents establishing that Movant’s interest in the real property or
                    cooperative apartment was perfected. For the purposes of example only, a complete
                    and legible copy of the Financing Statement (UCC-1) filed with either the Clerk’s
                    Office of the Register of the county the property or cooperative apartment is located
                    in') }}. (Exhibit 
                    <input name="<?php echo base64_encode('topmostSubform[0].Page3[0].TextField2[2]');?>" type="text" class="form-control width_auto">
                    .)
                </p>
            </div>
        </div>
        <h3 class="text-center">{{ __('CERTIFICATION FOR BUSINESS RECORDS') }}</h3>
        <p class="p_justify mt-3"> 
            {{ __('I CERTIFY THAT THE INFORMATION PROVIDED IN THIS FORM AND/OR ANY
            EXHIBITS ATTACHED TO THIS FORM (OTHER THAN THE TRANSACTIONAL
            DOCUMENTS ATTACHED AS REQUIRED BY PARAGRAPHS 1 AND 2 IMMEDIATELY
            ABOVE) IS DERIVED FROM RECORDS KEPT IN THE COURSE OF REGULARLY
            CONDUCTED ACTIVITY, MADE AT OR NEAR THE TIME OF THE OCCURRENCE OF
            THE MATTERS SET FORTH BY OR FROM INFORMATION TRANSMITTED BY, A
            PERSON WITH KNOWLEDGE OF THOSE MATTERS, AND WERE MADE BY
            REGULARLY CONDUCTED ACTIVITYAS REGULAR PRACTICE.') }}
        </p>
        <p class="p_justify mt-3">
        {{ __('I FURTHER CERTIFY THAT THE COPIES OF ANY TRANSACTIONAL DOCUMENTS
            ATTACHED TO THE MOTION AS REQUIRED BY PARAGRAPHS 1 AND 2
            IMMEDIATELY ABOVE, ARE TRUE AND ACCURATE COPIES OF THE ORIGINAL
            DOCUMENTS THAT ARE IN THE POSSESSION OF THE MOVANT, EXCEPT AS
            FOLLOWS') }}:
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[0]');?>" type="text" class="form-control width_auto">
            .
        </p>
        <p class="p_justify mt-3">
            I,
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[1]');?>" type="text" class="form-control width_auto"> 
            {{ __('(NAME AND TITLE) OF') }}
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[2]');?>" type="text" class="form-control width_auto">
            {{ __('(NAME OF MOVANT), DECLARE (OR CERTIFY,
            VERIFY, OR STATE) UNDER PENALTY OF PERJURY THAT THE FOREGOING IS TRUE
            AND CORRECT.') }}
        </p>
        <p class="p_justify mt-3">
        {{ __('EXECUTED AT') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[3]');?>" type="text" class="form-control width_auto"> 
            {{ __('(CITY/TOWN)') }}, 
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[4]');?>" type="text" class="form-control width_auto"> 
            {{ __('(STATE) ON THIS') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[5]');?>" type="text" class="form-control width_5percent" value="{{$currentDay}}">
            {{ __('DAY OF') }} 
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[6]');?>" type="text" class="form-control width_auto" value="{{$currentMonth}}"> 
            , 20
            <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[7]');?>" type="text" class="form-control width_5percent" value="{{$currentYearShort}}"> 
            .
        </p>
    </div> 

    <div class="col-md-6"></div>
    <div class="col-md-6">
        <input name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[8]');?>" type="text" class="form-control" value="{{$attorney_name}}"> 
        <label for="">{Print Name, Title, Name of Movant, Movant’s
        Street Address, City, State, and Zip Code Below}</label>
        <textarea name="<?php echo base64_encode('topmostSubform[0].Page4[0].TextField2[9]');?>" class="form-control" rows="10">{{$attorneydetails}}</textarea>
    </div>
</div>