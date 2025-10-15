<div class="row">
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="row">
            <div class="col-md-9">
                <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField1[0]');?>" type="text" value="{{$debtorname}}" class="form-control">
            </div>
            <div class="col-md-3 pt-2">
                <label>{{ __('Debtor(s)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="topmostSubform[0].Page1[0].TextField1[1]"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="">{{ __('CURRENT BUSINESS INCOME AND EXPENSES') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="mb-1">
        {{ __('Please provide figures for the full calendar month preceding the date of petition to the date of petition.
            Bank book balance and cash on hand at') }} <span class="text_italic">{{ __('beginning of full calendar month preceding filing') }}</span>
        </p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField2[0]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-10"></div>
    
    <div class="col-md-12">
        <p>{{ __('RECEIPTS & OTHER FUNDING:') }}</p>
    </div>
    
    <div class="col-md-6 pt-2">
        <label for=""><span class="pl-4"></span>1.<span class="pl-3"></span> {{ __('Sales/Receipts') }}</label>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField2[1]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-6 mt-1 pt-2">
        <label for=""><span class="pl-4"></span>2.<span class="pl-3"></span> {{ __('Accounts Receivable Collections') }}</label>
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[0].LI[1].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-4 mt-1"></div>

    <div class="col-md-6 mt-1 pt-2">
        <label for=""><span class="pl-4"></span>3.<span class="pl-3"></span> {{ __('Loans/Financing') }}</label>
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[0].LI[2].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-4 mt-1"></div>
    <div class="col-md-6 mt-1 pt-2">
        <label for=""><span class="pl-4"></span>4.<span class="pl-3"></span> {{ __('Capital Contributions') }}</label>
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[0].LI[3].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-4 mt-1"></div>
    <div class="col-md-6 mt-1 pt-2">
        <label for=""><span class="pl-4"></span>5.<span class="pl-3"></span> {{ __('Other Receipts (describe below)') }}</label>
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[0].LI[4].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-4 pl-4">
        <div class="ml-4 pl-4 ">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField1[0]');?>" type="text" value="" class="form-control">
        </div>
        <div class="ml-4 pl-4 mt-2">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField1[2]');?>" type="text" value="" class="form-control">
        </div>
        <div class="ml-4 pl-4 mt-2">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField1[1]');?>" type="text" value="" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField2[2]');?>" type="text" value="" class="price-field form-control">
        </div>
        <div class="input-group d-flex mt-2">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField2[3]');?>" type="text" value="" class="price-field form-control">
        </div>
        <div class="input-group d-flex mt-2">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField2[4]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-6"></div>

    <div class="col-md-8 pt-2 mt-3">
        <p class="mb-0"><span class="text-bold">{{ __('I. TOTAL RECEIPTS & FUNDING') }}</span> {{ __('(sum of lines 1-5)') }}</p>
        <p>{{ __('EXPENDITURES:') }}</p>
    </div>
    <div class="col-md-2 mt-3">
        <div class="input-group d-flex">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField2[5]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-2 mt-3"></div>
    
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>6.<span class="pl-3"></span> {{ __('Inventory Purchases') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].TextField2[6]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>7.<span class="pl-3"></span> {{ __('Taxes') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[2].LI[1].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class="mb-2"><span class="pl-4"></span>8.<span class="pl-3"></span> {{ __('PAYROLL') }}</p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-1"></div>    
    <div class="col-md-5 pt-2">
        <div class="pl-4 pt-1">
            <p class="mb-0">a.<span class="pl-3"></span> {{ __('Compensation of Insiders') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[2].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-1"></div>
    <div class="col-md-5 pt-2">
        <div class="pl-4 pt-1">
            <p class="mb-0">b.<span class="pl-3"></span> {{ __('Salaries & Wages') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[2].TextField2[1]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-1"></div>
    <div class="col-md-5 pt-2">
        <div class="pl-4 pt-1">
            <p class="mb-0">c.<span class="pl-3"></span> {{ __('Outside Labor') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[2].LI[5].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>9.<span class="pl-3"></span> {{ __('Payments to Professionals') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[0].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>10.<span class="pl-3"></span> {{ __('Insurance') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[1].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>11.<span class="pl-3"></span> {{ __('Real Property Rent Payments') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[2].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>12.<span class="pl-3"></span> {{ __('Equipment Lease Payments') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[3].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>13.<span class="pl-3"></span> {{ __('Mortgage Payments') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[4].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>14.<span class="pl-3"></span> {{ __('Utilities/Telephone') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[5].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>15.<span class="pl-3"></span> {{ __('Supplies') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[6].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>16.<span class="pl-3"></span> {{ __('Repairs & Maintenance') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>17.<span class="pl-3"></span> {{ __('Travel & Entertainment') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Sect[0].L[3].LI[7].LBody[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-6 pt-2">
        <p class=""><span class="pl-4"></span>18.<span class="pl-3"></span> {{ __('Other Expenses (describe below)') }}</p>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].TextField2[0]');?>" type="text" value="" class="price-field form-control mt-1">
        </div>
    </div>
    <div class="col-md-4"></div>

    
    <div class="col-md-4 pl-4">
        <div class="ml-4 pl-4 ">
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField1[0]');?>" type="text" value="" class="form-control">
        </div>
        <div class="ml-4 pl-4 mt-2">
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField1[1]');?>" type="text" value="" class="form-control">
        </div>
        <div class="ml-4 pl-4 mt-2">
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField1[2]');?>" type="text" value="" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField2[4]');?>" type="text" value="" class="price-field form-control">
        </div>
        <div class="input-group d-flex mt-2">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField2[3]');?>" type="text" value="" class="price-field form-control">
        </div>
        <div class="input-group d-flex mt-2">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField2[2]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-6"></div>

    
    <div class="col-md-8 pt-2 mt-3">
        <p class="mb-0"><span class="text-bold">{{ __('II. TOTAL EXPENDITURES') }}</span> {{ __('(sum of lines 6-18)') }}</p>
    </div>
    <div class="col-md-2 mt-3">
        <div class="input-group d-flex">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField2[1]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-2 mt-3"></div>
         
    <div class="col-md-8 pt-2 mt-1">
        <p class="mb-0"><span class="text-bold">{{ __('NET CASH FLOW') }}</span> {{ __('(Total Receipts less Total Expenditures)') }}</p>
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField2[0]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-2 mt-1"></div>
 
    <div class="col-md-8 pt-2 mt-1">
        <p class="mb-0">Bank book balance and cash on hand at <span class="text_italic">{{ __('date of filing') }}</span></p>
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].P[1].TextField2[0]');?>" type="text" value="" class="price-field form-control">
        </div>
    </div>
    <div class="col-md-2 mt-1"></div>
    
    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('(Note: Declaration required if form is filed separately from other schedules.)') }}</p>
        <p>{{ __('I/We declare under the penalty of perjury that the information provided in this form is true and correct.') }}</p>
    </div>

    <div class="col-md-5 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="topmostSubform[0].Page2[0].Sect[0].P[4].DateTimeField1[0]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-7 mt-3">
        <div class="row">
            <div class="col-md-8">
                <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].TextField1[3]');?>" value="{{$debtor_sign}}" type="text" class="form-control">
            </div>
            <div class="col-md-4 p-2">
                <label class="text_italic">{{ __('(Signature of Debtor)') }}</label>
            </div>
            
            <div class="col-md-8 mt-1">
                <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].P[5].TextField1[0]');?>" value="{{$onlyDebtor}}" type="text" class="form-control">
            </div>
            <div class="col-md-4 mt-1 p-2">
                <label class="text_italic">{{ __('(Printed Name of Debtor)') }}</label>
            </div>
            
            <div class="col-md-8 mt-1">
                <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].P[6].TextField1[0]');?>" value="{{$debtor2_sign}}" type="text" class="form-control">
            </div>
            <div class="col-md-4 mt-1 p-2">
                <label class="text_italic">{{ __('(Signature of Joint Debtor, if any)') }}</label>
            </div>
            
            <div class="col-md-8 mt-1">
                <input name="<?php echo base64_encode('topmostSubform[0].Page2[0].Sect[0].P[7].TextField1[0]');?>" value="{{$spousename}}" type="text" class="form-control">
            </div>
            <div class="col-md-4 mt-1 p-2">
                <label class="text_italic">{{ __('(Printed Name of Joint Debtor, if any)') }}</label>
            </div>
        </div>
        
    </div>

</div>