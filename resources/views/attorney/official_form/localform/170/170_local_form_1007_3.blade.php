<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('FINANCIAL REVIEW OF THE DEBTOR’S BUSINESS') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <p>{{ __('(NOTE: ONLY INCLUDE information directly related to one business operation on each form)') }}</p>
    </div>

    <div class=" col-md-12 mt-3">
        <p>{{ __('Type of business') }} 
            <input type="text" name="<?php echo base64_encode('Type of business');?>" class=" width_30percent form-control">
            {{ __('Business Name') }} 
            <input type="text" name="<?php echo base64_encode('Business Name');?>" class=" width_30percent form-control">
        </p>
        <p class="mb-0">{{ __('PART A - GROSS BUSINESS INCOME FOR PREVIOUS 12 MONTHS:') }}</p>
        <div class="row">
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">1. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Gross Income for 12 Months Prior to Filing') }} </label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('Gross Income for 12 Months Prior to Filing');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
        </div>
        <p class="mb-0 mt-3">{{ __('PART B - ESTIMATED AVERAGE FUTURE GROSS MONTHLY INCOME:') }}</p>
        <div class="row">
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">2. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Gross Monthly Income:') }} </label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
        </div>
        <p class="mb-0 mt-3">{{ __('PART C - ESTIMATED AVERAGE FUTURE MONTHLY EXPENSES:') }}</p>
        <div class="row">
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">3. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Payroll (paid to others)') }}  </label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_2');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">4. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Payroll Taxes') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_3');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">5. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Unemployment Taxes') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_4');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">6. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Worker’s Compensation') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_5');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">7. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Employee Benefits (e.g., pension, medical, etc.)') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_6');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">8. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Other Taxes') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_7');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">9. </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Inventory Purchases (including raw materials)') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_8');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('10.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Purchase of Feed/Fertilizer/Seed/Spray') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_9');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('11.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Rent (Other than debtor’s principal residence)') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_10');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('12.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Utilities') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_11');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('13.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Office Expenses and Supplies') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_12');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('14.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Repairs and Maintenance') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_13');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('15.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Vehicle Expenses') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_14');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('16.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Travel and Entertainment') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_15');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('17.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Advertising and Promotion') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_16');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('18.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Equipment Rental and Leases') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_17');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('19.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Legal/Accounting/Other Professional Fees') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_18');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('20.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Insurance') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_19');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('21.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Payment to Be Made Directly by Debtor to Secured Creditors for Pre-Petition Business Debts (specify)') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_20');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_21');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_22');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('22.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Other (describe)') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_23');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('23.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Total Monthly Expenses (add items 3-22)') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_24');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
        </div>
        <p class="mb-0 mt-3">{{ __('PART D - ESTIMATED AVERAGE NET MONTHLY INCOME:') }}</p>
        <div class="row">
            <div class="col-md-1 pt-2 mt-1">
                <label class="float_right">{{ __('24.') }} </label>
            </div>
            <div class="col-md-8 pt-2 mt-1">
                <label class="">{{ __('Average Net Monthly Income (subtract line 22 from line 2)') }}</label>
                <label class="float_right">$</label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('undefined_25');?>" class=" form-control price-field">
            </div>
            <div class="col-md-1"></div>
            
            <div class="col-md-9 pt-2 mt-1">
                <label class="float_right">Net Monthly Income <span class="pl-4">$</span></label>
            </div>
            <div class="col-md-2 mt-1">
                <input type="text" name="<?php echo base64_encode('Net Monthly Income');?>" class=" form-control price-field">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" p_justify">
            <span class="underline">{{ __('Verification') }}</span>. I, <input type="text" name="<?php echo base64_encode('Verification  I');?>" class=" form-control width_30percent" value="{{$onlyDebtor}}"> , {{ __('the debtor(s) named in the foregoing financial review
            form, declare under penalty of perjury that the foregoing is true and correct according to the best of my
            knowledge, information and belief.') }}
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Executed on:"
            dateNameField="Executed on"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed"
                inputValue="{{$debtor_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Print Name:"
                inputFieldName="Print Name"
                inputValue="{{$onlyDebtor}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Address:"
                inputFieldName="Address 1"
                inputValue="{{$debtoraddress}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent=""
                inputFieldName="Address 2"
                inputValue="{{$debtorCity}} {{$debtorState}} ,{{$debtorzip}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>




</div>