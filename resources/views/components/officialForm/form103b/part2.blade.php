<div class="row align-items-center">
    <div class="col-md-12">
        <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
            <h2 class="font-lg-18">{{ __('Tell the Court About Your Monthly Expenses') }}</h2>
        </div>
    </div>
</div>
<div class="form-border mb-3">
    <div class="row">
        <div class="col-md-9">
            <div class="d-flex">
                <strong>6.</strong>
                <strong>
                &nbsp; {{ __('Estimate your average monthly expenses.') }}
                </strong>
            </div>
            <p class="pt-2" style="padding-left: 10px;">
                {{ __('Include amounts paid by any government assistance that you reported on line 2.') }}
            </p>
            <p class="" style="padding-left: 10px;">
            {{ __('If you have already filled out') }} <i>{{ __('Schedule J, Your Expenses') }}</i>{{ __(', copy line 22 from that form') }}
            </p>
        </div>

        <div class="col-md-3">
            <div class="input-group pt-3 d-flex">
                <div class="input-group-append">
                    <span class="input-group-text " id="basic-addon2">$</span>
                </div>
                <p>
                    <input name="{{ base64_encode('undefined_7') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                </p>
            </div>
        </div>
        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>7.</strong>
                <strong>
                &nbsp; {{ __('Do these expenses cover anyone who is not included in your family as reported in line 1?') }}
                </strong>
            </div>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 7') }}" value="On">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 7') }}" value="yes">
                        <label>{{ __('Yes.') }}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group horizontal_dotted_line">
                        <label>{{ __('Identify who') }}</label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group" style="border: 1px solid black;">
                                <textarea name="{{ base64_encode('undefined_8') }}" value="" class="form-control" rows="2" cols=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>8.</strong>
                <p>
                    <strong>
                    &nbsp; {{ __('Does anyone other than you regularly pay any of these expenses?') }}
                    </strong>
                    {{ __('If you have already filled out') }}
                    <i>{{ __('Schedule I: Your Income') }}</i>{{ __(', copy the total from line 11.') }}
                </p>
            </div>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 8') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 8') }}" value="yes">
                        <label>{{ __('Yes.') }}</label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="">
                        <p>
                            How much do you regularly receive as contributions? $
                            <input name="{{ base64_encode('Yes How much do you regularly receive as contributions') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" style="width: 150px;" class="price-field form-control" placeholder="$">
                            {{ __('monthly') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 pb-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>9.</strong>
                <strong>
                &nbsp; {{ __('Do you expect your average monthly expenses to increase or decrease by more than 10% during the next 6 months?') }}
                </strong>
            </div>
        </div>
        <div class="col-md-9 pt-3 pb-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 9') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Check 9') }}" value="yes">
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
                                <textarea name="{{ base64_encode('undefined_10') }}" value="" class="form-control" rows="2" cols=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
