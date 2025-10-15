<div class="row align-items-center">
    <div class="col-md-12">
        <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
            <h2 class="font-lg-18">{{ __('Tell the Court About Your Family and Your Family’s Income') }}</h2>
        </div>
    </div>
</div>
<div class="form-border mb-3">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex">
                <strong>1.</strong>
                <strong>
                &nbsp; {{ __('What is the size of your family?') }}
                </strong>
            </div>
            <p class="mt-3" style="padding-left: 10px;">
                <i>{{ __('Your family') }}</i> {{ __('includes you, your spouse, and any dependents listed on') }} <i>{{ __('Schedule J: Your Expenses') }}</i>
                {{ __('(Official Form 106J).') }}
            </p>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <p>
                    {{ __('Check all that apply:') }}
                </p>
                <input type="checkbox" name="{{ base64_encode('You') }}" value="On">
                <label>{{ __('You') }}</label><br>
                <input type="checkbox" name="{{ base64_encode('Your spouse') }}" value="On">
                <label>{{ __('Your spouse') }}</label><br>
                <input type="checkbox" name="{{ base64_encode('Your dependents') }}" value="On">
                <label>{{ __('Your dependents') }}</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('How many dependents') }}" value="" type="text" placeholder="" class="form-control">
                        <label>{{ __('How many dependents?') }}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('Total number of people') }}" value="" type="text" placeholder="" class="form-control">
                        <label>{{ __('How many dependents?') }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3" style="border-top: 1px solid black; margin-top:15px; ">
            <div class="d-flex">
                <strong>2.</strong>
                <strong>
                &nbsp; {{ __('Fill in your family’s average monthly income.') }}
                </strong>
            </div>
            <p class="mt-3" style="padding-left: 10px;">
                {{ __('Include your spouse’s income if your spouse is living with you, even if your spouse is not filing.') }}
            </p>
            <p class="mt-3" style="padding-left: 10px;">
                {{ __('Do not include your spouse’s income if you are separated and your spouse is not filing with you.') }}
            </p>
        </div>
        <div class="col-md-9 pt-3" style="border-top: 1px solid black; margin-top:15px;">
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <div class="input-group gray-box column-heading d-inline-block" style="float: right;">
                        <strong class="d-block">
                            {{ __('That person’s average monthly net income (take-home pay)') }}
                        </strong>
                    </div>
                </div>
                <div class="col-md-5 pt-2">
                    <div class="input-group">
                        <p>
                            {{ __('Add your income and your spouse’s income. Include the value (if known) of any non-cash governmental assistance that you receive, such as food stamps (benefits under the Supplemental Nutrition Assistance Program) or housing subsidies.') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3 pt-2">
                    <div class="input-group horizontal_dotted_line">
                        <label style="font-weight:bold;">You</label>
                    </div>
                </div>
                <div class="col-md-1 pt-2">
                    <div class="input-group">
                        <label style="font-size: large;"></label>
                    </div>
                </div>
                <div class="col-md-3 pt-2">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_2') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group">
                        <p>
                            {{ __('If you have already filled out') }} <i>{{ __('Schedule I: Your Income') }}</i>{{ __(', see line 10 of that schedule.') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group horizontal_dotted_line">
                        <label style="font-weight:bold;">Your spouse</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="input-group">
                        <label style="font-size: large;">+</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_3') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="input-group">
                        <p>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group horizontal_dotted_line">
                        <label>{{ __('Subtotal') }}</label>
                    </div>
                </div>

                <div class="col-md-1" style="border: 2px solid black; border-right:none; padding-top: 5px;">
                    <div class="input-group">
                        <label style="font-size: large;"></label>
                    </div>
                </div>

                <div class="col-md-3" style="border: 2px solid black; border-left:none; padding-top: 5px;">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_4') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-5 mt-3">
                    <div class="input-group">
                        <p>
                            {{ __('Subtract any non-cash governmental assistance that you included above.') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="input-group ">
                        <label style="font-weight:bold;"></label>
                    </div>
                </div>
                <div class="col-md-1 mt-3">
                    <div class="input-group">
                        <label style="font-size: large;">-</label>
                    </div>
                </div>

                <div class="col-md-3 mt-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_5') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="input-group">
                        <p style="font-weight:bold;">
                            {{ __('Your family’s average monthly net income') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group horizontal_dotted_line">
                        <label>{{ __('Total') }}</label>
                    </div>
                </div>

                <div class="col-md-1" style="border: 2px solid black; border-right:none; padding-top: 5px;">
                    <div class="input-group">
                        <label style="font-size: large;"></label>
                    </div>
                </div>

                <div class="col-md-3" style="border: 2px solid black; border-left:none; padding-top: 5px;">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_6') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>3.</strong>
                <strong>
                &nbsp; {{ __('Do you receive non-cash governmental assistance?') }}
                </strong>
            </div>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check 3') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <label style="font-weight:bold;">{{ __('Type of assistance') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check 3') }}" value="yes">
                        <label>{{ __('Yes.') }}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group horizontal_dotted_line">
                        <label>{{ __('Describe') }}</label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group" style="border: 1px solid black;">
                                <textarea name="{{ base64_encode('3 type') }}" value="" class="form-control" rows="2" cols=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>4.</strong>
                <strong>
                &nbsp; {{ __('Do you expect your family’s average monthly net income to increase or decrease by more than 10% during the next 6 months?') }}
                </strong>
            </div>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 4') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 4') }}" value="yes">
                        <label>{{ __('Yes.') }}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group horizontal_dotted_line">
                        <label>{{ __('Explain') }}</label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group" style="border: 1px solid black;">
                                <textarea name="{{ base64_encode('4 type') }}" value="" class="form-control" rows="2" cols=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>5.</strong>
                <p>
                    <strong>
                    &nbsp; {{ __('Tell the court why you are unable to pay the filing fee in installments within 120 days.') }}
                    </strong>
                    {{ __('If you have some additional circumstances that cause you to not be able to pay your filing fee in installments, explain them.') }}
                </p>
            </div>
        </div>
        <div class="col-md-6 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="input-group" style="border: 1px solid black;">
                <textarea name="{{ base64_encode('5 Type') }}" value="" class="form-control" rows="2" cols=""></textarea>
            </div>
        </div>
    </div>
</div>
