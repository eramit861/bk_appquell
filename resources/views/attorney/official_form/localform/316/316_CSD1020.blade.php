<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('1020Name'); ?>"  class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
            </div>
            <div class="col-md-6 mt-3" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center" style="border-top:3px solid #000;">
                <label><strong>{{ __('UNITED STATES BANKRUPTCY COURT') }}</strong></label><br>
                <label>{{ __('SOUTHERN DISTRICT OF CALIFORNIA') }}</label><br>
                <label>{{ __('325 West F Street, San Diego, California 92101-6991') }}</label>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="border-top:3px solid #000; border-bottom:3px solid #000;">
                <label>{{ __('In Re') }}</label>
                <textarea style="margin-right:40px" name="<?php echo base64_encode('1020Debtor'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                <div class="row">
                    <div class="col-md-8">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('Debtor.') }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000; border-top:3px solid #000; border-bottom:3px solid #000;">
                <div class="input-group d-flex mt-20">
                    <label>{{ __('BANKRUPTCY NO.') }}</label>
                    <input name="<?php echo base64_encode('1020CaseNo'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('APPLICATION TO PAY FILING FEES IN INSTALLMENTS') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            <strong>{{ __('Part A. Family Size and Income') }}</strong>
        </p>
    </div>

    <!-- row 1 -->
    <div class="row mt-3">            
            <p style="width:20px;">1.</p>
        <div class="row col-md-12 input-group d-flex">
            <div class="col-md-3 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <p class = "mt-3">
                    <strong>{{ __('What is the size of your family?') }}</strong>
                </p>
                <p>
                    <i>{{ __('Your family') }}</i> {{ __('includes you, your spouse,and any dependents listed on Schedule J: Your Expenses (Official Form 106J)') }}
                </p>
            </div>
            <div class="col-md-3 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <p class = "mt-3">
                        <i>{{ __('Check all that apply:') }}</i>
                </p>
                <div class="input-group d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize1'); ?>" value="Yes" type="checkbox"> 
                    {{ __('You') }}<br>
                </div>
                <div class="input-group d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize2'); ?>" value="Yes" type="checkbox"> 
                    {{ __('Your spouse') }}<br>
                </div>
                <div class="input-group d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize3'); ?>" value="Yes" type="checkbox"> 
                    {{ __('Your dependents') }}<br>
                </div>
            </div>
            <div class="col-md-3 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <div class="input-group d-flex mt-3">
                    <div class="col-md-6">
                        {{ __('How many dependents:') }} 
                    </div>
                    <div class="col-md-6">
                        <input name="<?php echo base64_encode('1020DepNo'); ?>" value="" type="number" class="form-control"> 
                    </div>
                    <br>
                </div>
            </div>
            <div class="col-md-3 input-group mt-3" style="border:2px solid #000;">
                <div class="input-group d-flex mt-3">
                    <div class="col-md-6">
                        {{ __('Total number of people:') }}
                    </div>
                    <div class="col-md-6">
                        <input name="<?php echo base64_encode('1020TotalNo'); ?>" value="" type="number" class="form-control"> 
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- row 2 -->
    <div class="row mt-3">            
            <p style="width:20px;">2.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="6" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>{{ __('Fill in your family’s average monthly income.') }}</strong>
                    </p>
                    <p>
                        {{ __('Include your spouse’s income if your spouse is living with you,even if your spouse is not filing.') }}
                    </p>
                    <p>
                        {{ __('Do not include your spouse’s income if you are separated and your spouse is not filing with you.') }}
                    </p>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Add your income and your spouse’s income. Include the value (if known) of any non-cash governmental assistance that you receive, such as food stamps (benefits under the Supplemental Nutrition Assistance Program) or housing subsidies.') }}
                    </p>
                </td>
                <td rowspan="2" style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 horizontal_dotted_line">
                        {{ __('You') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('That person’s average monthly net income (take-home pay)') }}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Income1'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
           <tr>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                    {{ __('If you have already filled out') }} <i>{{ __('Schedule I: Your Income') }}</i>{{ __(', see line 10 of that schedule.') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 horizontal_dotted_line">
                        {{ __('Your Spouse      +') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Income2'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                       
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 horizontal_dotted_line">
                        {{ __('Subtotal') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Income3'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Subtract any non-cash governmental assistance that you included above.') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 horizontal_dotted_line">
                        {{ __('(minus)      -') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Income4'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; spadding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        <strong>{{ __('Your family’s average monthly net income') }}</strong>
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 horizontal_dotted_line">
                        {{ __('Total') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Income5'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 3 -->
    <div class="row mt-3">            
            <p style="width:20px;">3.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>{{ __('Do you receive non-cash governmental assistance?') }}</strong>
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize4'); ?>" value="1" type="checkbox"> 
                        {{ __('No') }}<br>
                    </div>
                    
                </td>
                <td style="vertical-align:top; padding: 10px; width:50%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                        <input name="<?php echo base64_encode('1020BoxSize4'); ?>" value="2" type="checkbox"> 
                        {{ __('Yes. Describe') }}<br>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                    {{ __('Type of Assistance') }}:<br><textarea name="<?php echo base64_encode('1020Q3'); ?>" value="" class="form-control" rows="2" cols="100" style="padding-right:5px;"></textarea>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 4 -->
    <div class="row mt-3">            
            <p style="width:20px;">4.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>{{ __('Do you expect your family’s average monthly net income to increase or decrease by more than 10% during the next 6 months?') }}</strong>
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize5'); ?>" value="1" type="checkbox"> 
                        {{ __('No') }}<br>
                    </div>
                    
                </td>
                <td style="vertical-align:top; padding: 10px; width:50%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                        <input name="<?php echo base64_encode('1020BoxSize5'); ?>" value="2" type="checkbox"> 
                        {{ __('Yes. Explain') }}<br>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        <textarea name="<?php echo base64_encode('1020Q4'); ?>" value="" class="form-control" rows="2" cols="100" style="padding-right:5px;"></textarea>
                    </p>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- row 5 -->
    <div class="row mt-3">            
            <p style="width:20px;">5.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000; border-bottom:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('Tell the court why you are unable to pay the filing fee in installments within 30 days.') }} 
                        </strong>
                        {{ __('If you have some additional circumstances that cause you to not be able to pay your filing fee in installments, explain them.') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        <textarea name="<?php echo base64_encode('1020Q5'); ?>" value="" class="form-control" rows="5" cols="100" style="padding-right:5px;"></textarea>
                    </p>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="input-group">
            <strong>{{ __('Part B. Monthly Expenses') }}</strong>
        </p>
    </div>

    <!-- row 6 -->
    <div class="row mt-3">            
            <p style="width:20px;">6.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:70%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('Estimate your average monthly expenses.') }}
                        </strong>
                            {{ __('Include amounts paid by any government assistance that you reported on line 2.') }}
                    </p>
                    <p class = "mt-3" >
                        {{ __('If you have already filled out Schedule J, Your Expenses, copy line 22 from that form.') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = " d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Q6'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 7 -->
    <div class="row mt-3">            
            <p style="width:20px;">7.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>{{ __('Do these expenses cover anyone who is not included in your family as reported in line 1?') }}</strong>
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize7'); ?>" value="1" type="checkbox"> 
                        {{ __('No') }}<br>
                    </div>
                    
                </td>
                <td style="vertical-align:top; padding: 10px; width:50%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                        <input name="<?php echo base64_encode('1020BoxSize7'); ?>" value="2" type="checkbox"> 
                        {{ __('Yes. Identify who') }} <br>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        <textarea name="<?php echo base64_encode('1020Q7'); ?>" value="" class="form-control" rows="2" cols="100" style="padding-right:5px;"></textarea>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 8 -->
    <div class="row mt-3">            
        <p style="width:20px;">8.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('Does anyone other than you regularly pay any of these expenses?') }}
                        </strong>
                        {{ __('If you have already filled out') }}
                        <i>{{ __('Schedule I: Your Income') }}</i>{{ __(',copy the total from line 11.') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:40%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize8'); ?>" value="1" type="checkbox"> 
                        {{ __('No') }}<br>
                    </div>
                    
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                        <input name="<?php echo base64_encode('1020BoxSize8'); ?>" value="2" type="checkbox"> 
                        {{ __('Yes. How much do you regularly receive as contributions?') }} <br>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Q8'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> {{ __('monthly') }}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 9 -->
    <div class="row mt-3">            
        <p style="width:20px;">9.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>{{ __('Do you expect your family’s average monthly expenses to increase or decrease by more than 10% during the next 6 months?') }}</strong>
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize9'); ?>" value="1" type="checkbox"> 
                        {{ __('No') }}<br>
                    </div>
                    
                </td>
                <td style="vertical-align:top; padding: 10px; width:50%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                        <input name="<?php echo base64_encode('1020BoxSize9'); ?>" value="2" type="checkbox"> 
                        {{ __('Yes. Explain') }} <br>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        <textarea name="<?php echo base64_encode('1020Q9'); ?>" value="" class="form-control" rows="2" cols="100" style="padding-right:5px;"></textarea>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            <strong>{{ __('Part C. Real and Personal Property') }}</strong>
        </p>
    </div>

    <!-- row 10 -->
    <div class="row mt-3">            
        <p style="width:20px;">10.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td style="width:70%; vertical-align:top; padding: 10px; margin-left: 3px; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('How much cash do you have?') }}
                        </strong>
                    </p>
                    <p class = "mt-3" >
                        <i>{{ __('Examples:') }}</i> {{ __('Money you have in your wallet, in your home, and on hand when you file this application.') }}
                    </p>
                </td>
                <td style="width:30%; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                    <span class="pt-2">{{ __('Cash') }}:&nbsp$</span><input name="<?php echo base64_encode('1020Q10'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 11 -->
    <div class="row mt-3">            
            <p style="width:20px;">11.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="6" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>{{ __('Bank accounts and other deposits of money?') }}</strong>
                    </p>
                    <p>
                        <i>{{ __('Examples:') }}</i> {{ __('Checking, savings, money market, or other financial accounts; certificates of deposit; shares in banks, credit unions, brokerage houses, and other similar institutions. If you have more than one account with the same institution, list each. Do not include 401(k) or IRA accounts.') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3"></p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Institution name:') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Amount') }}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        {{ __('Checking account:') }}
                    </p>
                </td>
                <td style="padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        <textarea name="<?php echo base64_encode('1020Acct11a'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </p>
                </td>
                <td style="padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Q11a'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
           <tr>
                <td style="padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Savings account:') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 ">
                        <textarea name="<?php echo base64_encode('1020Acct11b'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Q11b'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                    {{ __('Other financial accounts:') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 ">
                        <textarea name="<?php echo base64_encode('1020Acct11c'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Q11c'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Other financial accounts:') }}
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        <textarea name="<?php echo base64_encode('1020Acct11d'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </p>
                </td>
                <td style="padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Q11d'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 12 -->
    <div class="row mt-3">            
        <p style="width:20px;">12.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('Your home?') }}
                        </strong>
                        {{ __('(if you own it outright or are purchasing it)') }}
                    </p>
                    <p class = "mt-3" >
                        <i>
                            {{ __('Examples:') }}
                        </i>
                         {{ __('House, condominium, manufactured home, or mobile home') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group mt-3">
                        <input name="<?php echo base64_encode('1020Q12a'); ?>" value="" type="text" class="form-control"> 
                        <p class = "d-flex">
                            <br>{{ __('Number') }} &nbsp;&nbsp;&nbsp;&nbsp; {{ __('Street') }}
                        </p>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Current value:') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt12a'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <input name="<?php echo base64_encode('1020Q12b'); ?>" value="" type="text" class="form-control"> 
                    <p class = "d-flex">
                        <br>{{ __('City') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('State') }}  &nbsp;&nbsp;&nbsp;&nbsp; {{ __('ZIP Code') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        {{ __('Amount you owe on mortgage and liens:') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt12b'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 13 -->
    <div class="row mt-3">            
        <p style="width:20px;">13.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('Other real estate?') }}
                        </strong>
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group mt-3">
                        <input name="<?php echo base64_encode('1020Q13a'); ?>" value="" type="text" class="form-control"> 
                        <p class = "d-flex">
                            <br>{{ __('Number') }} &nbsp;&nbsp;&nbsp;&nbsp; {{ __('Street') }}
                        </p>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Current value:') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt13a'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <input name="<?php echo base64_encode('1020Q13b'); ?>" value="" type="text" class="form-control"> 
                    <p class = "d-flex">
                        <br>{{ __('City') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('State') }}  &nbsp;&nbsp;&nbsp;&nbsp; {{ __('ZIP Code') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "d-flex mt-3">
                        {{ __('Amount you owe on mortgage and liens:') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt13b'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
        </table>
    </div>

     <!-- row 14 -->
     <div class="row mt-3">            
        <p style="width:20px;">14.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="8" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('The vehicles you own?') }}
                        </strong>
                    </p>
                    <p class = "mt-3" >
                        <i>{{ __('Examples:') }}</i> {{ __('Cars, vans, trucks, sports utility vehicles, motorcycles, tractors, boats') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Make:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14a'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Current value:') }}
                    </p>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt14a'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Model:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14b'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Year:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14c'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Amount you owe on liens:') }}</p>
                    </div>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt14b'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Mileage:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14d'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Make:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14e'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Current value:') }}
                    </p>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt14c'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Model:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14f'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Year:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14g'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Amount you owe on liens:') }}</p>
                    </div>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt14d'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Mileage:') }} </p>
                        <input name="<?php echo base64_encode('1020Q14h'); ?>" value="" type="text" class="form-control"> 
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000;  border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- row 15 -->
    <div class="row mt-3">            
        <p style="width:20px;">15.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="2" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('Other assets?') }}
                        </strong>
                    </p>
                    <p class = "mt-3" >
                        {{ __('Do not include household items and clothing.') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p><strong>{{ __('Describe the other assets:') }} </strong></p>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3">
                        {{ __('Current value:') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt15a'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <textarea name="<?php echo base64_encode('1020Q15'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>{{ __('Amount you owe on liens:') }}</p>
                    </div>
                </td>
                <td rowspan="2" style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        $<input name="<?php echo base64_encode('1020Amt15b'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </p>
                </td>
            </tr>
        </table>
    </div>

     <!-- row 16 -->
     <div class="row mt-3">            
        <p style="width:20px;">16.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="3" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                            {{ __('Money or property due you?') }}
                        </strong>
                    </p>
                    <p class = "mt-3" >
                        <i>{{ __('Examples:') }}</i> {{ __('Tax refunds, past due or lump sum alimony, spousal support, child support, maintenance, divorce or property settlements, Social Security benefits, Workers’ compensation, personal injury recovery') }}
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <p>
                            <strong>{{ __('Who owes you the money or property?') }}
                            </strong>
                            {{ __('Enter the names in the below boxes.') }}
                        </p>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3">
                        <strong>
                            {{ __('How much is owed?') }}
                        </strong>
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        {{ __('Do you believe you will likely receive payment in the next 180 days?') }}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <textarea name="<?php echo base64_encode('1020Q16a'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Amt16a'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize10'); ?>" value="1" type="checkbox"> 
                        {{ __('No') }}<br>
                    </div>
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize10'); ?>" value="2" type="checkbox"> 
                        {{ __('Yes. Explain in the box below') }}<br>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <textarea name="<?php echo base64_encode('1020Q16b'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Amt16b'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control">
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                    <p class = "mt-3 d-flex">
                        <textarea name="<?php echo base64_encode('1020Q16c'); ?>" value="" class="form-control" rows="2" cols="" style="padding-right:5px;"></textarea>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            <strong>{{ __('Part D. Additional Information') }}</strong>
        </p>
    </div>

    <!-- row 17 -->
    <div class="row mt-3">            
        <p style="width:20px;">17.</p>
        <div class="row col-md-12 input-group d-flex">
            <div class="col-md-3 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <p class = "mt-3">
                    <strong>{{ __('Have you paid anyone for services for this case, including filling out this application, the bankruptcy filing package, or the schedules?') }}</strong>
                </p>
            </div>
            <div class="col-md-2 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <div class="input-group d-flex mt-3">
                    <input name="<?php echo base64_encode('1020BoxSize11'); ?>" value="1" type="checkbox"> 
                    {{ __('No') }}<br>
                </div>
                <div class="input-group d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize11'); ?>" value="2" type="checkbox"> 
                    {{ __('Yes') }}<br>
                </div>
            </div>
            <div class="col-md-4 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <div class="input-group mt-3 d-flex">
                        <p>
                            <strong>
                                {{ __('Whom did you pay?') }}
                            </strong>
                            {{ __('Check all that apply:') }}
                        </p>
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize12'); ?>" value="yes" type="checkbox"> 
                    {{ __('An attorney') }}
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize13'); ?>" value="yes" type="checkbox"> 
                    {{ __('A bankruptcy petition preparer, paralegal, or typing service') }}
                </div>
                <div class="input-group mt-3 mb-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize14'); ?>" value="yes" type="checkbox"> 
                    {{ __('Someone else:') }}
                    <input name="<?php echo base64_encode('1020Q17'); ?>" value="" type="text" class="form-control"> 
                </div>
                
            </div>
            <div class="col-md-3 input-group mt-3" style="border:2px solid #000;">
                <div class="input-group mt-3">
                    <p>
                        <strong>
                            {{ __('How much did you pay?') }}
                        </strong>
                    </p>
                    <div class="d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Amt17'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- row 18 -->
    <div class="row mt-3">            
        <p style="width:20px;">18.</p>
        <div class="row col-md-12 input-group d-flex">
            <div class="col-md-3 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <p class = "mt-3">
                    <strong>{{ __('Have you promised to pay or do you expect to pay someone for services for your bankruptcy case?') }}</strong>
                </p>
            </div>
            <div class="col-md-2 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <div class="input-group d-flex mt-3">
                    <input name="<?php echo base64_encode('1020BoxSize15'); ?>" value="1" type="checkbox"> 
                    {{ __('No') }}<br>
                </div>
                <div class="input-group d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize15'); ?>" value="2" type="checkbox"> 
                    {{ __('Yes') }}<br>
                </div>
            </div>
            <div class="col-md-4 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <div class="input-group mt-3 d-flex">
                        <p>
                            <strong>
                                {{ __('Whom did you expect to pay?') }}
                            </strong>
                            {{ __('Check all that apply:') }}
                        </p>
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize16'); ?>" value="yes" type="checkbox"> 
                        {{ __('An attorney') }}
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize17'); ?>" value="yes" type="checkbox"> 
                        {{ __('A bankruptcy petition preparer, paralegal, or typing service') }}
                </div>
                <div class="input-group mt-3 mb-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize18'); ?>" value="yes" type="checkbox"> 
                    {{ __('Someone else:') }}
                    <input name="<?php echo base64_encode('1020Q18'); ?>" value="" type="text" class="form-control"> 
                </div>
            </div>
            <div class="col-md-3 input-group mt-3" style="border:2px solid #000;">
                <div class="input-group mt-3">
                    <p>
                        <strong>
                            {{ __('How much do you expect to pay?') }}
                        </strong>
                    </p>
                    <div class="d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Amt18'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- row 19 -->
    <div class="row mt-3">            
        <p style="width:20px;">19.</p>
        <div class="row col-md-12 input-group d-flex">
            <div class="col-md-3 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <p class = "mt-3">
                    <strong>{{ __('Has anyone paid someone on your behalf for services for this case?') }}</strong>
                </p>
            </div>
            <div class="col-md-4 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <div class="input-group d-flex mt-3">
                    <input name="<?php echo base64_encode('1020BoxSize19'); ?>" value="1" type="checkbox"> 
                    {{ __('No') }}<br>
                </div>
                <div class="input-group d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize19'); ?>" value="2" type="checkbox"> 
                    {{ __('Yes') }} <br> 
                        <p>
                            <strong>
                            &nbsp;&nbsp; {{ __('Who was paid on your behalf?') }}
                            </strong>
                            {{ __('Check all that apply:') }}
                        </p>
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize19a'); ?>" value="yes" type="checkbox"> 
                        {{ __('An attorney') }}
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize20'); ?>" value="yes" type="checkbox"> 
                        {{ __('A bankruptcy petition preparer, paralegal, or typing service') }}
                </div>
                <div class="input-group mt-3 mb-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize21'); ?>" value="yes" type="checkbox"> 
                        {{ __('Someone else:') }}
                </div>
                <div class="input-group mt-3 mb-3 d-flex">
                    <input name="<?php echo base64_encode('1020Q19a'); ?>" value="" type="text" class="form-control"> 
                </div>
            </div>
            <div class="col-md-3 input-group mt-3" style="border-left:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                <div class="input-group mt-3 d-flex">
                        <p>
                            <strong>
                                {{ __('Who paid?') }}
                            </strong>
                            {{ __('Check all that apply:') }}
                        </p>
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize22'); ?>" value="yes" type="checkbox"> 
                        {{ __('Parent') }}
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize23'); ?>" value="yes" type="checkbox"> 
                        {{ __('Brother or sister') }}
                </div>
                <div class="input-group mt-3 mb-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize24'); ?>" value="yes" type="checkbox"> 
                        {{ __('Friend') }}
                </div>
                <div class="input-group mt-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize25'); ?>" value="yes" type="checkbox"> 
                        {{ __('Pastor or clergy') }}
                </div>
                <div class="input-group mt-3 mb-3 d-flex">
                    <input name="<?php echo base64_encode('1020BoxSize26'); ?>" value="yes" type="checkbox"> 
                        {{ __('Someone else:') }}
                </div>
                <div class="input-group mt-3 mb-3 d-flex">
                    <input name="<?php echo base64_encode('1020Q19b'); ?>" value="" type="text" class="form-control"> 
                </div>
            </div>
            <div class="col-md-2 input-group mt-3" style="border:2px solid #000;">
                <div class="input-group mt-3">
                    <p>
                        <strong>
                            {{ __('How much did someone else pay?') }}
                        </strong>
                    </p>
                    <div class="d-flex mt-3">
                        $<input name="<?php echo base64_encode('1020Amt19'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>" type="text" class="price-field form-control"> 
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- row 20 -->
    <div class="row mt-3">            
        <p style="width:20px;">20.</p>
        <table style="width:97%; border-collapse: collapse; ">
            <tr>
                <td rowspan="5" style="vertical-align:top; padding: 10px; margin-left: 3px; width:30%; border:2px solid #000;" >
                    <p class = "mt-3" >
                        <strong>
                        {{ __('Have you filed for bankruptcy within the last 8 years?') }}
                        </strong>
                    </p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:30%; border-top:2px solid #000; border-right:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                        <input name="<?php echo base64_encode('1020BoxSize27'); ?>" value="1" type="checkbox"> 
                        {{ __('No') }}<br>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3"></p>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-top:2px solid #000; border-right:2px solid #000;">
                    <p class = "mt-3 d-flex"></p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex">
                        <input name="<?php echo base64_encode('1020BoxSize27'); ?>" value="2" type="checkbox"> 
                        {{ __('Yes') }}<br>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3"></div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group d-flex mt-3"></div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                    {{ __('District') }}:<input name="<?php echo base64_encode('1020Q20a'); ?>" value="" type="text" class="form-control">
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="d-flex">
                        <div class="input-group mt-3">
                            {{ __('When:') }}
                        </div>
                        <div class="input-group mt-3">
                            <input name="<?php echo base64_encode('1020Q20d'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"><br>
                        </div>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group mt-3">
                    {{ __('Case Number:') }}<br><input name="<?php echo base64_encode('1020Q20g'); ?>" value="" type="number" class="form-control">
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                    {{ __('District') }}:<input name="<?php echo base64_encode('1020Q20b'); ?>" value="" type="text" class="form-control">
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="d-flex">
                        <div class="input-group mt-3">
                            {{ __('When:') }}
                        </div>
                        <div class="input-group mt-3">
                            <input name="<?php echo base64_encode('1020Q20e'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"><br>
                        </div>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group mt-3">
                    {{ __('Case Number') }}:<br><input name="<?php echo base64_encode('1020Q20h'); ?>" value="" type="number" class="form-control">
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="input-group d-flex mt-3">
                    {{ __('District') }}:<input name="<?php echo base64_encode('1020Q20c'); ?>" value="" type="text" class="form-control">
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
                    <div class="d-flex">
                        <div class="input-group mt-3">
                            {{ __('When:') }}
                        </div>
                        <div class="input-group mt-3">
                            <input name="<?php echo base64_encode('1020Q20f'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control"><br>
                        </div>
                    </div>
                </td>
                <td style="vertical-align:top; padding: 10px; width:20%; border-right:2px solid #000; border-top:2px solid #000; border-bottom:2px solid #000;">
                    <div class="input-group mt-3">
                    {{ __('Case Number') }}:<br><input name="<?php echo base64_encode('1020Q20i'); ?>" value="" type="number" class="form-control">
                    </div>
                </td>
            </tr>
            
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            <strong>{{ __('Part E. Sign Below') }}</strong>
        </p>
    </div>

    
    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I (we) declare under penalty of perjury that I (we) cannot currently afford to pay the filing fee in full or in installments and that the foregoing information is true and correct.') }}
        </p>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('Dated:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1020Date1'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label>{{ __('Signed:') }}</label>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input name="<?php echo base64_encode('1020DbSignature'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
                    <label>{{ __('Signature of Debtor') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('Dated:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1020Date2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label>{{ __('Signed:') }}</label>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input name="<?php echo base64_encode('1020JtDbSignature'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
                    <label>{{ __('Signature of Co-Debtor') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
         
    </div>

</div>