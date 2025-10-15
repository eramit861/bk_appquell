<div class="row align-items-center">
    <div class="col-md-12">
        <div class="part-form-title mb-3"> <span>{{ __('Part 3') }}</span>
            <h2 class="font-lg-18">{{ __('Tell the Court About Your Property') }}</h2>
        </div>
    </div>
</div>
<div class="form-border mb-3">
    <div class="row">
        <div class="col-md-12">
            <strong>
                {{ __('If you have already filled out Schedule A/B: Property (Official Form 106A/B) attach copies to this application and go to Part 4.') }}
            </strong>
        </div>
        <div class="col-md-3 pt-3">
            <div class="d-flex">
                <strong>10.</strong>
                <strong>
                &nbsp; {{ __('How much cash do you have?') }}
                </strong>
            </div>
        </div>
        <div class="col-md-9 pt-3"></div>

        <div class="col-md-3 pt-2">
            <div class="d-flex">
                <p style="padding-left: 15px;">
                    {{ __('Examples: Money you have in your wallet, in your home, and on hand when you file this application') }}
                </p>
            </div>
        </div>
        <div class="col-md-3 pt-2">
            <p>
                {{ __('Cash:') }}
            </p>
        </div>
        <div class="col-md-6 pt-2">
            <div class="input-group d-flex">
                <div class="input-group-append">
                    <span class="input-group-text " id="basic-addon2">$</span>
                </div>
                <p>
                    <input name="{{ base64_encode('undefined_11') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                </p>
            </div>
        </div>
        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>11.</strong>
                <strong>
                &nbsp; {{ __('Bank accounts and other deposits of money?') }}
                </strong>
            </div>
            <p class="pt-2" style="padding-left: 15px;">
                {{ __('Examples: Checking, savings,
                money market, or other financial
                accounts; certificates of deposit;
                shares in banks, credit unions,
                brokerage houses, and other
                similar institutions. If you have
                more than one account with the
                same institution, list each. Do not
                include 401(k) and IRA accounts.') }}
            </p>
        </div>



        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="input-group">
                        <p style="border-bottom: 2px solid black;">
                            {{ __('Institution name:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <p style="border-bottom: 2px solid black;">
                            {{ __('Amount:') }}
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Checking account:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('Institution name') }}" id="" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_12') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Savings account:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('undefined_13') }}" id="" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_14') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Other financial account:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('Other financial accounts') }}" id="" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_15') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Other financial account:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('Other financial accounts_2') }}" id="" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_16') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>12.</strong>
                <p>
                    <strong>
                    &nbsp; {{ __('Your home?') }}
                    </strong>
                    {{ __('(if you own it outright or are purchasing it)') }}
                </p>
            </div>
            <p style="padding-left:15px;">
                <i>{{ __('Examples:') }}</i> {{ __('House, condominium, manufactured home, or mobile home') }}
            </p>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('12 Your home if you own it outright or') }}" id="" type="text" value="" class="form-control">
                        <label>
                            {{ __('Number') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('Street') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Current value:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_17') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('Examples House condominium') }}" id="" type="text" value="" class="form-control">
                        <label>
                            {{ __('City') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('State') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('Zip') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Amount you owe on mortgage and liens:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_18') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>13.</strong>
                <p>
                    <strong>
                    &nbsp; {{ __('Other real estate?') }}
                    </strong>
                </p>
            </div>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('13 Other real estate') }}" id="" type="text" value="" class="form-control">
                        <label>
                            {{ __('Number') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('Street') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Current value:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_19') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('13 Other real estate city sate13 Other real estate city sate') }}" id="" type="text" value="" class="form-control">
                        <label>
                        {{ __('City') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('State') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('Zip') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Amount you owe on mortgage and liens:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_20') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>14.</strong>
                <p>
                    <strong>
                    &nbsp; {{ __('The vehicles you own?') }}
                    </strong>
                    {{ __('(if you own it outright or are purchasing it)') }}
                </p>
            </div>
            <p style="padding-left:15px;">
                <i>{{ __('Examples:') }}</i> {{ __('Cars, vans, trucks, sports utility vehicles, motorcycles, tractors, boats') }}
            </p>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4">
                            <p>{{ __('Make:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Make') }}" id="" type="text" value="" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <p>{{ __('Model:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Model') }}" id="" type="text" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Current value:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_21') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4">
                            <p>{{ __('Year:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Year') }}" id="" type="text" value="" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <p>{{ __('Mileage:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Mileage') }}" id="" type="text" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Amount you owe on liens:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_22') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-5 pt-2">
                    <div class="row">
                        <div class="col-md-4">
                            <p>{{ __('Make:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Make_2') }}" id="" type="text" value="" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <p>{{ __('Model:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Model_2') }}" id="" type="text" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-1 pt-2"></div>
                <div class="col-md-3 pt-2">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Current value:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3 pt-2">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_23') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4">
                            <p>{{ __('Year:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Year_2') }}" id="" type="text" value="" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <p>{{ __('Mileage:') }}</p>
                        </div>
                        <div class="col-md-8">
                            <input name="{{ base64_encode('Mileage_2') }}" id="" type="text" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Amount you owe on liens:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_24') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>15.</strong>
                <p>
                    <strong>
                    &nbsp; {{ __('Other assets?') }}
                    </strong>
                </p>
            </div>
            <p style="padding-left:15px;">
                {{ __('Do not include household items and clothing') }}
            </p>
        </div>
        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <strong>{{ __('Describe the other assets:') }}</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Current value:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_25') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group" style="border: 1px solid black;">
                        <textarea name="{{ base64_encode('Amount you owe') }}" value="" class="form-control" rows="2" cols=""></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group pt-2">
                        <p>
                            {{ __('Amount you owe on mortgage and liens:') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_26') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>16.</strong>
                <p>
                    <strong>
                    &nbsp; {{ __('Money or property due you?') }}
                    </strong>
                </p>
            </div>
            <p style="padding-left:15px;">
                <i>{{ __('Examples:') }}</i> {{ __("Tax refunds, past due or lump sum alimony, spousal support, child support, maintenance, divorce or property settlements, Social Security benefits, workers' compensation, personal injury recovery") }}
            </p>
        </div>
        <div class="col-md-9 pt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group">
                        <strong>{{ __('Who owes you the money or property?') }}</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <strong>{{ __('How much is owed?') }}</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <p>{{ __('Do you believe you will likely receive payment in the next 180 days?') }} </p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="input-group">
                        <input name="{{ base64_encode('undefined_27') }}" id="" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_28') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('16 check') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="input-group">
                        <input name="{{ base64_encode('maintenance divorce or property') }}" id="" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text " id="basic-addon2">$</span>
                        </div>
                        <p>
                            <input name="{{ base64_encode('undefined_29') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('16 check') }}" value="yes">
                        <label>{{ __('Yes. Explain') }}</label>
                    </div>
                </div>

                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <div class="input-group" style="border: 1px solid black;">
                        <textarea name="{{ base64_encode('undefined_30') }}" value="" class="form-control" rows="2" cols=""></textarea>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
