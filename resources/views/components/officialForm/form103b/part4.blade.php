<div class="row align-items-center">
    <div class="col-md-12">
        <div class="part-form-title mb-3"> <span>{{ __('Part 4') }}</span>
            <h2 class="font-lg-18">{{ __('Answer These Additional Questions') }}</h2>
        </div>
    </div>
</div>
<div class="form-border mb-3">
    <div class="row pt-3">
        <div class="col-md-3">
            <div class="d-flex">
                <strong>17.</strong>
                <strong>
                &nbsp; {{ __('Have you paid anyone for services for this case, including filling out this application, the bankruptcy filing package, or the schedules?') }}
                </strong>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_17') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_17') }}" value="yes">
                        <label>{{ __('Yes.') }} <strong>{{ __('Whom did you pay?') }}</strong> <i>{{ __('Check all that apply') }}</i> </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <strong>{{ __('How much did you pay?') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('An attorney') }}" value="On">
                        <label>{{ __('An attorney') }}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="basic-addon2">$</span>
                                </div>
                                <p>
                                    <input name="{{ base64_encode('undefined_31') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('A bankruptcy petition preparer paralegal or typing service') }}" value="On">
                        <label>{{ __('A bankruptcy petition preparer, paralegal, or typing service') }}</label>
                    </div>
                </div>
                <div class="col-md-4"></div>

                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Someone else') }}" value="On">
                        <label>Someone else
                            <input name="{{ base64_encode('undefined_32') }}" id="" style="width:auto;" type="text" value="" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-md-4"></div>

            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>18.</strong>
                <strong>
                &nbsp; {{ __('Have you promised to pay or do you expect to pay someone for services for your bankruptcy case?') }}
                </strong>
            </div>
        </div>

        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_18') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_18') }}" value="yes">
                        <label>{{ __('Yes.') }} <strong>{{ __('Whom do you expect to pay?') }}</strong> <i>{{ __('Check all that apply') }}</i> </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <strong>{{ __('How much do you expect to pay?') }} </strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('An attorney_2') }}" value="On">
                        <label>{{ __('An attorney') }}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="basic-addon2">$</span>
                                </div>
                                <p>
                                    <input name="{{ base64_encode('undefined_33') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('A bankruptcy petition preparer paralegal or typing service_2A bankruptcy petition preparer paralegal or typing service_2') }}" value="On">
                        <label>{{ __('A bankruptcy petition preparer, paralegal, or typing service') }}</label>
                    </div>
                </div>
                <div class="col-md-4"></div>

                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('Someone else_2') }}" value="On">
                        <label>Someone else
                        <input name="{{ base64_encode('undefined_34') }}" id="" style="width:auto;" type="text" value="" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-md-4"></div>

            </div>
        </div>

        <div class="col-md-3 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>19.</strong>
                <strong>
                &nbsp; {{ __('Has anyone paid someone on your behalf for services for this case?') }}
                </strong>
            </div>
        </div>

        <div class="col-md-9 pt-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_19') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_19') }}" value="yes">
                        <label>{{ __('Yes.') }}
                            <strong>{{ __('Who was paid on your behalf?') }}</strong>
                            <br>
                            <i>{{ __('Check all that apply') }}</i>
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <label>
                            <strong>{{ __('Who paid?') }}</strong>
                            <br>
                            <i>{{ __('Check all that apply') }}</i>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <strong>{{ __('How much did someone else pay?') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('An attorney_3') }}" value="On">
                                <label>{{ __('An attorney') }}</label>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('A bankruptcy petition preparer') }}" value="On">
                                <label>{{ __('A bankruptcy petition preparer, paralegal, or typing service') }}</label>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('Someone else_3') }}" value="On">
                                <label>Someone else
                                    <input name="{{ base64_encode('paralegal or typing service') }}" id="" style="width:auto;" type="text" value="" class="form-control">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('Parent') }}" value="On">
                                <label>{{ __('Parent') }}</label>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('Brother or sister') }}" value="On">
                                <label>{{ __('Brother or sister') }}</label>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('Friend') }}" value="On">
                                <label>{{ __('Friend') }}</label>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('Pastor or clergy') }}" value="On">
                                <label>{{ __('Pastor or clergy') }}</label>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="checkbox" name="{{ base64_encode('Someone else_4') }}" value="On">
                                <label>Someone else
                                    <input name="{{ base64_encode('undefined_36') }}" id="" style="width:auto;" type="text" value="" class="form-control">
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="basic-addon2">$</span>
                                </div>
                                <p>
                                    <input name="{{ base64_encode('undefined_35') }}" id="" type="text" value="{{ Helper::priceFormt('') }}" class="price-field form-control" placeholder="$">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3 pb-3 mt-3" style="border-top: 1px solid black;">
            <div class="d-flex">
                <strong>20.</strong>
                <strong>
                &nbsp; {{ __('Have you filed for bankruptcy within the last 8 years?') }}
                </strong>
            </div>
        </div>

        <div class="col-md-9 pt-3 pb-3 mt-3" style="border-top: 1px solid black;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_20') }}" value="no">
                        <label>{{ __('No') }}</label>
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="input-group">
                        <input type="checkbox" name="{{ base64_encode('check_20') }}" value="yes">
                        <label>{{ __('Yes') }}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <label>{{ __('District') }}</label> &nbsp;
                        <input name="{{ base64_encode('undefined_37') }}" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <label for="">{{ __('When') }}</label> &nbsp;
                        <input name="{{ base64_encode('When') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <label>{{ __('Case Number') }}</label> &nbsp;
                        <input name="{{ base64_encode('Case number_2') }}" type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <label>{{ __('District') }}</label> &nbsp;
                        <input name="{{ base64_encode('District') }}" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <label for="">{{ __('When') }}</label> &nbsp;
                        <input name="{{ base64_encode('When_2') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <label>{{ __('Case Number') }}</label> &nbsp;
                        <input name="{{ base64_encode('Case number_3') }}" id="" style="" type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <label>{{ __('District') }}</label> &nbsp;
                        <input name="{{ base64_encode('District_2') }}" id="" style="" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group d-flex">
                        <label for="">{{ __('When') }}</label> &nbsp;
                        <input name="{{ base64_encode('When_3') }}" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <label>{{ __('Case Number') }}</label> &nbsp;
                        <input name="{{ base64_encode('Case number_4') }}" id="" style="" type="text" value="" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
