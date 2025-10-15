<div class="row padd-20">
    <div class="ch703b col-md-12 mb-3">
        <div class="form-title">
            <h2 class="font-lg-22">
                {{ __('Order on the Application to Have the Chapter 7 Filing Fee Waived') }}
            </h2>
        </div>
    </div>
    <div class="form-border pt-3">
        <div class="row">
            <div class="ch703b col-md-12 mt-3">
                <p>
                    {{ __('After considering the debtor’s Application to Have the Chapter 7 Filing Fee Waived (Official Form 103B), the court orders that the application is:') }}
                </p>
            </div>

            <div class="ch703b col-md-2 mt-3">
                <input type="checkbox" name="{{ base64_encode('Application.Fee.Amt.1st.When') }}" value="WithPetition">
                <label style="font-weight:bold;">{{ __('Granted.') }}</label>
            </div>
            <div class="ch703b col-md-10 mt-3">
                <p>
                    {{ __('However, the court may order the debtor to pay the fee in the future if developments in administering the bankruptcy case show that the waiver was unwarranted.') }}
                </p>
            </div>

            <div class="ch703b col-md-2 mt-3">
                <input type="checkbox" name="{{ base64_encode('Application.Fee.Amt.1st.When') }}" value="OtherDate">
                <label style="font-weight:bold;">{{ __('Denied.') }}</label>
            </div>
            <div class="ch703b col-md-10 mt-3">
                <p>
                    {{ __('The debtor must pay the filing fee according to the following terms:') }}
                </p>
            </div>

            <div class="ch703b col-md-3 ch703b"></div>
            <div class="ch703b col-md-3">
                <div class=" ch703b input-group ">
                    <p style="ch703b border-bottom: 2px solid black;" >
                        <strong>{{ __('You must pay…') }}</strong>
                    </p>
                </div>
            </div>
            <div class="ch703b col-md-3">
                <div class="ch703b input-group ">
                    <p style="border-bottom: 2px solid black;" >
                        <strong>{{ __('On or before this date…') }}</strong>
                    </p>
                </div>
            </div>
            <div class="ch703b col-md-3"></div>

            <div class="ch703b col-md-3"></div>
            <div class="ch703b col-md-3">
                <div class="input-group text-center">
                    <div class="input-group-append">
                        <span class="input-group-text " id="basic-addon2">$</span>
                        <p>
                            <input name="{{ base64_encode('Application.Fee.Amt.Install.1') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
            <div class="ch703b col-md-3">
                <div class="input-group">
                    <input name="{{ base64_encode('Application.Fee.Amt.1st.Date') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="ch703b col-md-3"></div>

            <div class="ch703b col-md-3"></div>
            <div class="ch703b col-md-3">
                <div class="input-group text-center">
                    <div class="input-group-append">
                        <span class="input-group-text " id="basic-addon2">$</span>
                        <p>
                            <input name="{{ base64_encode('Application.Fee.Amt.Install.2') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
            <div class="ch703b col-md-3">
                <div class="input-group">
                    <input name="{{ base64_encode('Application.Fee.Amt.2nd.Date') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="ch703b col-md-3"></div>

            <div class="ch703b col-md-3"></div>
            <div class="ch703b col-md-3">
                <div class="input-group text-center">
                    <div class="input-group-append">
                        <span class="input-group-text " id="basic-addon2">$</span>
                        <p>
                            <input name="{{ base64_encode('Application.Fee.Amt.Install.3') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
            <div class="ch703b col-md-3">
                <div class="input-group">
                    <input name="{{ base64_encode('Application.Fee.Amt.3rd.Date') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="ch703b col-md-3"></div>

            <div class="ch703b col-md-3">
                <p style="text-align: right; font-size:large;">+</p>
            </div>
            <div class="ch703b col-md-3">
                <div class="input-group text-center">
                    <div class="input-group-append">
                        <span class="input-group-text " id="basic-addon2">$</span>
                        <p>
                            <input name="{{ base64_encode('Application.Fee.Amt.Install.4') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
            <div class="ch703b col-md-3">
                <div class="input-group">
                    <input name="{{ base64_encode('Application.Fee.Amt.4th.Date') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="ch703b col-md-3"></div>

            <div class="ch703b col-md-3">
                <p style="text-align: right; font-weight: bold;">{{ __('Total') }}</p>
            </div>
            <div class="ch703b col-md-3">
                <div class="input-group text-center">
                    <div class="input-group-append" style="border: 2px solid black;">
                        <p>
                            <input name="{{ base64_encode('Application.Fee.Amt.Ttl') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                        </p>
                    </div>
                </div>
            </div>
            <div class="ch703b col-md-3">
                <div class="input-group text-center">
                </div>
            </div>
            <div class="ch703b col-md-3"></div>

            <div class="ch703b col-md-2 mt-3"></div>
            <div class="ch703b col-md-10 mt-3">
                <p>
                    {{ __('If the debtor would like to propose a different payment timetable, the debtor must file a
                    motion promptly with a payment proposal. The debtor may use') }} <i>{{ __('Application for Individuals to
                        Pay the Filing Fee in Installments') }} </i>{{ __('(Official Form 103A) for this purpose. The court will
                    consider it.') }}
                </p>
                <p>
                    {{ __('The debtor must pay the entire filing fee before making any more payments or transferring any
                    more property to an attorney, bankruptcy petition preparer, or anyone else in connection with the
                    bankruptcy case. The debtor must also pay the entire filing fee to receive a discharge. If the
                    debtor does not make any payment when it is due, the bankruptcy case may be dismissed and
                    the debtor’s rights in future bankruptcy cases may be affected.') }}
                </p>
            </div>

            <div class="ch703b col-md-12 mt-3">
                <input type="checkbox" name="{{ base64_encode('Hearing') }}" value="yes">
                <label style="font-weight:bold;">{{ __('Scheduled for hearing.') }}</label>
            </div>

            <div class="ch703b col-md-2 mt-3"></div>
            <div class="ch703b col-md-10 mt-3">
                <p>
                    {{ __('A hearing to consider the debtor’s application will be held') }}
                </p>
                <div class="row">
                    <div class="ch703b col-md-1">
                        <p>on</p>
                    </div>
                    <div class="ch703b col-md-2">
                        <input name="{{ base64_encode('Hearing date') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                    </div>
                    <div class="ch703b col-md-1">
                        <p>at</p>
                    </div>
                    <div class="ch703b col-md-2">
                        <input name="{{ base64_encode('Hearing time') }}" id="" type="text" value="" class="form-control">
                    </div>
                    <div class="ch703b col-md-2">
                        <p>{{ __('AM / PM at') }}</p>
                    </div>
                    <div class="ch703b col-md-4">
                        <div class="input-group">
                            <input name="{{ base64_encode('Address of hearing') }}" id="" style="" type="text" value="" class="form-control">
                            <label>{{ __('Address of courthouse') }} </label>
                        </div>
                    </div>
                </div>
                <p>
                    {{ __('If the debtor does not appear at this hearing, the court may deny the application.') }}
                </p>
            </div>
            <div class="ch703b col-md-2"></div>
            <div class="ch703b col-md-10">
                <div class="row">
                    <div class="ch703b col-md-3">
                        <div class="input-group">
                            <input name="{{ base64_encode('Judge date') }}" style="width:150px;" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                        </div>
                    </div>
                    <div class="ch703b col-md-2">
                        <p style="text-align: right; font-weight: bold;">{{ __('By the court:') }}</p>
                    </div>
                    <div class="ch703b col-md-4">
                        <div class="input-group">
                            <input name="{{ base64_encode('Judge Sig') }}" id="" style="" type="text" value="" class="form-control">
                            <label>{{ __('United States Bankruptcy Judge') }}</label>
                        </div>
                    </div>
                    <div class="ch703b col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
