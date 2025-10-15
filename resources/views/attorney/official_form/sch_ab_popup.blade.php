<div class="">
    <form name="sch_ab_popup" action="{{route('save_ab_template')}}" id="sch_ab_popup" method="POST">
        @csrf
        <div class="row">
        <div class="col-md-3 mt-2 text-left"></div>
        <div class="col-md-6 mt-2 text-center"><h3>Schedule A/B Template</h3></div>
            <div class="col-md-3 mt-2 text-right">
                <button type="submit"
                    class="btn text-right font-weight-bold border-blue-big">{{ __('Save Template') }}</button>
            </div>
            <input type="hidden" name="client_id" value="{{$client_id}}">
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('6. Household goods and furnishings') }}</p>
            </div>

            <div class="col-md-10">
                <x-officialForm.inputText name="6 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('6 description-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <x-officialForm.priceFieldInput inputFieldName="6 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('6 description amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('7. Electronics') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="7 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('7 description-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="7 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('7 description amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('8. Collectibles of value') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="8 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('8 description-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="8 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('8 description amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('9. Equipment for sports and hobbies') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="9 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('9 description-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="9 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('9 description amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('10. Firearms') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="10 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('10 description-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="10 description amounT-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('10 description amounT-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('11. Clothes') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="11 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('11 description-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="11 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('11 description amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('12. Jewelry') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="12 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('12 description-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="12 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('12 description amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('13. Non-farm animals') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="13 description-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('13 description-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="13 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('13 description amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('14. Any other personal and household
                    items you did not already list, including any health aids you did not list') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="14 description106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('14 description106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="14 description amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('14 description amount-106AB'), $ab_data); ?>" />
            </div>


            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('16. Cash') }}</p>
            </div>
            <div class="col-md-10 pt-2">
                <p class="mb-0 p-text-end">{{ __("Cash") }}</p>
            </div>
            <div class="col-md-2">
                <x-officialForm.priceFieldInput inputFieldName="16 Cash amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('16 Cash amount-106AB'), $ab_data); ?>" />
            </div>

            <div class="col-md-12">
                <p class="text-bold mb-0">{{ __(" 17. Deposits of money") }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class=""></td>
                        <td class="width_60percent">{{ __("Institution name:") }}</td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.1. Checking account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.1 Checking account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.1 Checking account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.1 Checking amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.1 Checking amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.2. Checking account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.2 Checking account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.2 Checking account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.2 Checking amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.2 Checking amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.3. Savings account ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.3 Checking account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.3 Checking account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.3 Checking amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.3 Checking amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.4. Savings account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.4 Checking account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.4 Checking account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.4 Checking amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.4 Checking amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.5.  Certificates of deposit: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.5 Certificates of deposit account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.5 Certificates of deposit account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.5 Certificates of deposit amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.5 Certificates of deposit amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.6.  Other financial account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.6 Other financial account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.6 Other financial account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.6 Other financial amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.6 Other financial amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.7.  Other financial account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.7 Other financial account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.7 Other financial account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.7 Other financial amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.7 Other financial amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.8.  Other financial account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.8 Other financial account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.8 Other financial account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.8 Other financial amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.8 Other financial amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 17.9.  Other financial account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="17.9 Other financial account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('17.9 Other financial account-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="17.9 Other financial amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('17.9 Other financial amount-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0"> {{ __('18. Bonds, mutual funds, or publicly
                            traded stocks') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">{{ __("Institution or issuer name:") }}</td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="18.1 Institution or issuer name-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('18.1 Institution or issuer name-106AB'), $ab_data); ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput
                                inputFieldName="18.1 Institution or issuer name 1 amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('18.1 Institution or issuer name 1 amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="18.2 Institution or issuer name-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('18.2 Institution or issuer name-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput
                                inputFieldName="18.2 Institution or issuer name amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('18.2 Institution or issuer name amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="18.3 Institution or issuer name-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('18.3 Institution or issuer name-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="18.3 Institution or issuer name amount"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('18.3 Institution or issuer name amount'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __("19. Non-publicly traded stock and
                    interests in incorporated and unincorporated businesses,
                    including an interest in
                    an LLC, partnership, and joint venture") }}
                </p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">{{ __("Name of entity: ") }}</td>
                        <td class="width_15percent">{{ __(" % of ownership: ") }}</td>
                        <td class="width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="19.1 Name of entity-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('19.1 Name of entity-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <div class="d-flex">
                                <div class="">
                                    <x-officialForm.inputText name="19.1 % of ownership-106AB" class=""
                                        value="<?php echo Helper::validate_key_value(base64_encode('19.1 % of ownership-106AB'), $ab_data) ; ?>">
                                    </x-officialForm.inputText>
                                </div>
                                <div class="pt-2">
                                    <p class="mb-0">%</p>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="19.1 amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('19.1 amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="19.2 Name of entity-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('19.2 Name of entity-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <div class="d-flex">
                                <div class="">
                                    <x-officialForm.inputText name="19.2 % of ownership-106AB" class=""
                                        value="<?php echo Helper::validate_key_value(base64_encode('19.2 % of ownership-106AB'), $ab_data) ; ?>">
                                    </x-officialForm.inputText>
                                </div>
                                <div class="pt-2">
                                    <p class="mb-0">%</p>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="19.2 amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('19.2 amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="19.3 Name of entity-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('19.3 Name of entity-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <div class="d-flex">
                                <div class="">
                                    <x-officialForm.inputText name="19.3 % of ownership-106AB" class=""
                                        value="<?php echo Helper::validate_key_value(base64_encode('19.3 % of ownership-106AB'), $ab_data) ; ?>">
                                    </x-officialForm.inputText>
                                </div>
                                <div class="pt-2">
                                    <p class="mb-0">%</p>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="19.3 amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('19.3 amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0"> {{ __('20. Government and corporate bonds
                            and other negotiable and non-negotiable instruments') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">{{ __("Issuer name:") }}</td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="20.1 Issuer name-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('20.1 Issuer name-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="20.1 Issuer name amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('20.1 Issuer name amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="20.2 Issuer name-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('20.2 Issuer name-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="20.2 Issuer name amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('20.2 Issuer name amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="20.3 Issuer name-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('20.3 Issuer name-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="20.3 Issuer name amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('20.3 Issuer name amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0"> {{ __('21. Retirement or pension
                            accounts') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">{{ __("Type of account:") }}</td>
                        <td class="width_60percent">{{ __("Institution name:") }}</td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" 401(k) or similar plan:  ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="21.1 401k or similar plan-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('21.1 401k or similar plan-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="21.1 401k or similar plan amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('21.1 401k or similar plan amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Pension plan: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="21.2 Pension plan-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('21.2 Pension plan-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="21.2 Pension plan amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('21.2 Pension plan amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" IRA: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="21.3 IRA-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('21.3 IRA-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="21.3 IRA amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('21.3 IRA amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Retirement account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="21.4 Retirement account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('21.4 Retirement account-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="21.4 Retirement account amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('21.4 Retirement account amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Keogh: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="21.5 Keogh-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('21.5 Keogh-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="21.5 Keogh amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('21.5 Keogh amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Additional account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="21.6 Additional account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('21.6 Additional account-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="21.6 Additional account amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('21.6 Additional account amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Additional account: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="21.7 Additional account-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('21.7 Additional account-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="21.7 Additional account amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('21.7 Additional account amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('22. Security deposits and
                            prepayments') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class=""></td>
                        <td class="width_60percent">{{ __("Institution name or individual:") }}</td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Electric: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.1 Electric-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.1 Electric-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.1 Electric amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.1 Electric amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Gas: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.2 Gas-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.2 Gas-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.2 Gas amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.2 Gas amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Heating oil: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.3 Heating oil" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.3 Heating oil'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.3 Heating oil amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.3 Heating oil amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Security deposit on rental unit: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.4 Security deposit on rental unit-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.4 Security deposit on rental unit-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput
                                inputFieldName="22.4 Security deposit on rental unit amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.4 Security deposit on rental unit amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Prepaid rent: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.5 Prepaid rent-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.5 Prepaid rent-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.5 Prepaid rent amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.5 Prepaid rent amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Telephone: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.6 Telephone-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.6 Telephone-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.6 Telephone amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.6 Telephone amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Water: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.7 Water-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.7 Water-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.7 Water amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.7 Water amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Rented furniture: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.8 Rented furniture-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.8 Rented furniture-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.8 Rented furniture amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.8 Rented furniture amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">{{ __(" Other: ") }}</td>
                        <td class="">
                            <x-officialForm.inputText name="22.9 Other-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('22.9 Other-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="22.9 Other amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('22.9 Other amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('23. Annuities') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">{{ __("Issuer name and description:") }}</td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="23.1 Annuities-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('23.1 Annuities-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="23.1 Annuities amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('23.1 Annuities amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="23.2 Annuities-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('23.2 Annuities-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="23.2 Annuities amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('23.2 Annuities amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="23.3 Annuities-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('23.3 Annuities-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="23.3 Annuities amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('23.3 Annuities amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0"> {{ __('24. Interests in an education IRA, in an
                            account in a qualified ABLE program, or under a qualified
                            state tuition program') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">
                            {{ __("Institution name and description. Separately file the records of any interests.11 U.S.C. § 521(c):") }}
                        </td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="24.1 Interest in an education IRA#0-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('24.1 Interest in an education IRA#0-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput
                                inputFieldName="24.1 Interest in an education IRA amount-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('24.1 Interest in an education IRA amount-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="24.2 Interest in an education IRA#0-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('24.2 Interest in an education IRA#0-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="24.2 Interest in an education IRA-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('24.2 Interest in an education IRA-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="24.3 Interest in an education IRA#0-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('24.3 Interest in an education IRA#0-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="24.3 Interest in an education IRA-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('24.3 Interest in an education IRA-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('25. Trusts, equitable or future interests
                    in property (other than anything listed in line 1), and
                    rights or powers
                    exercisable for your benefit') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="25 Trusts, equitable or future interests in property-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('25 Trusts, equitable or future interests in property-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput
                    inputFieldName="25 Trusts, equitable or future interests in property amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('25 Trusts, equitable or future interests in property amount-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('26. Patents, copyrights, trademarks,
                    trade secrets, and other intellectual
                    property') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="26 Patents, copyrights, trademarks, trade secrets-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('26 Patents, copyrights, trademarks, trade secrets-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput
                    inputFieldName="26 Patents, copyrights, trademarks, trade secrets amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('26 Patents, copyrights, trademarks, trade secrets amount-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('27. Licenses, franchises, and other
                      general intangibles') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="27 Liscenses, Franchises-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('27 Liscenses, Franchises-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="27 Liscenses, Franchises amount-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('27 Liscenses, Franchises amount-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('28. Tax refunds owed to you') }}
                </p>
            </div>
            <div class="col-md-8 mt-2">
                <x-officialForm.inputTextarea name="28 Tax refunds owed-106AB" class="" row="4"
                    value="<?php echo Helper::validate_key_value(base64_encode('28 Tax refunds owed-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-2 mt-2">
                <p class="pt-2 mb-2">Federal:</p>
                <p class="pt-2 mb-2">State:</p>
                <p class="pt-2 mb-2">Local:</p>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="28 Tax refunds owed amout1-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('28 Tax refunds owed amout1-106AB'), $ab_data) ; ?>" />
                <x-officialForm.priceFieldInput inputFieldName="28 Tax refunds owed amout2-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('28 Tax refunds owed amout2-106AB'), $ab_data) ; ?>" />
                <x-officialForm.priceFieldInput inputFieldName="28 Tax refunds owed amout3-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('28 Tax refunds owed amout3-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('29. Family support') }}
                </p>
            </div>
            <div class="col-md-8 mt-2">
                <x-officialForm.inputTextarea name="29 Family support-106AB" class="" row="7"
                    value="<?php echo Helper::validate_key_value(base64_encode('29 Family support-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-2 mt-2">
                <p class="pt-2 mb-2">Alimony:</p>
                <p class="pt-2 mb-2">Maintenance:</p>
                <p class="pt-2 mb-2">Support:</p>
                <p class="pt-2 mb-2">Divorce settlement:</p>
                <p class="pt-2 mb-2">Property settlement:</p>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="29 Family support amount1-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('29 Family support amount1-106AB'), $ab_data) ; ?>" />
                <x-officialForm.priceFieldInput inputFieldName="29 Family support amount2-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('29 Family support amount2-106AB'), $ab_data) ; ?>" />
                <x-officialForm.priceFieldInput inputFieldName="29 Family support amount3"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('29 Family support amount3'), $ab_data) ; ?>" />
                <x-officialForm.priceFieldInput inputFieldName="29 Family support amount4-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('29 Family support amount4-106AB'), $ab_data); ?>" />
                <x-officialForm.priceFieldInput inputFieldName="29 Family support amount5-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('29 Family support amount5-106AB'), $ab_data) ; ?>" />
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('30.Other amounts someone owes
                            you') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="Info_107-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('Info_107-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="Inform_108-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('Inform_108-106AB'), $ab_data) ; ?>" />
            </div>


            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0"> {{ __('31. Interests in insurance
                            policies') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">{{ __(" Company name: ") }}</td>
                        <td class="width_15percent">{{ __("Beneficiary:") }}</td>
                        <td class="width_15percent pl-2">Surrender or refund value:</td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="Company name 1-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('Company name 1-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.inputText name="Beneficiary 1-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('Beneficiary 1-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Benneficiary_109-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Benneficiary_109-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="Company name 2-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('Company name 2-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.inputText name="Beneficiary 2-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('Beneficiary 2-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Beneficiary_110-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Beneficiary_110-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="Company name 3-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('Company name 3-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.inputText name="Beneficiary 3-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('Beneficiary 3-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Beneficiary_111-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Beneficiary_111-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('32. Any interest in property that is
                    due
                    you from someone who has died') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="32 Interest in property due you from someone who died-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('32 Interest in property due you from someone who died-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="INFORMA_114-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('INFORMA_114-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('33. Claims against third parties,
                    whether or not you have filed a lawsuit or made a demand for
                    payment') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="33-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('33-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="Claim_117-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('Claim_117-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('34. Other contingent and unliquidated
                    claims of every nature, including counterclaims of the
                    debtor
                    and rights
                    to set off claims') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="34-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('34-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="INF_120-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('INF_120-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('35. Any financial assets you did not already list') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="35-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('35-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="undefined_123-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('undefined_123-106AB'), $ab_data) ; ?>" />
            </div>


            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('37. Do you own or have any legal or
                    equitable
                    interest in any business-related property?') }}
                </p>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('38. Accounts receivable or commissions you already earned') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="38 Accounts receivable or commissions already earned-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('38 Accounts receivable or commissions already earned-106AB'), $ab_data); ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="Describe_125-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('Describe_125-106AB'), $ab_data); ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('39. Office equipment, furnishings, and supplies') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="39 Office equipment furnishings and supplies-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('39 Office equipment furnishings and supplies-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="Describe_126-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('Describe_126-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __("40. Machinery, fixtures, equipment,
                    supplies you use in business, and tools of your trade") }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="40 Machinery fixtures equipment and tools of your trade-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('40 Machinery fixtures equipment and tools of your trade-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="Describe_127-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('Describe_127-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('41. Inventory') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="41 Inventory-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('41 Inventory-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="Describe_128-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('Describe_128-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('42. Interests in partnerships or
                    joint
                    ventures') }}
                </p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class="">{{ __("Name of entity:") }}</td>
                        <td class="width_15percent">{{ __(" % of ownership: ") }}</td>
                        <td class="width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="42.1 Name of entity-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('42.1 Name of entity-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <div class="d-flex">
                                <div class="">
                                    <x-officialForm.inputText name="Ownership_130-106AB" class=""
                                        value="<?php echo Helper::validate_key_value(base64_encode('Ownership_130-106AB'), $ab_data) ; ?>">
                                    </x-officialForm.inputText>
                                </div>
                                <div class="pt-2">
                                    <p class="mb-0">%</p>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Dollar_129-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Dollar_129-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="42.2 Name of entity-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('42.2 Name of entity-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <div class="d-flex">
                                <div class="">
                                    <x-officialForm.inputText name="Ownership_131-106AB" class=""
                                        value="<?php echo Helper::validate_key_value(base64_encode('Ownership_131-106AB'), $ab_data) ; ?>">
                                    </x-officialForm.inputText>
                                </div>
                                <div class="pt-2">
                                    <p class="mb-0">%</p>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Dollar_132-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Dollar_132-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-3">
                            <x-officialForm.inputText name="42.3 Name of entity-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('42.3 Name of entity-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <div class="d-flex">
                                <div class="">
                                    <x-officialForm.inputText name="Ownership_133-106AB" class=""
                                        value="<?php echo Helper::validate_key_value(base64_encode('Ownership_133-106AB'), $ab_data) ; ?>">
                                    </x-officialForm.inputText>
                                </div>
                                <div class="pt-2">
                                    <p class="mb-0">%</p>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Dollar_134-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Dollar_134-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('43. Customer lists, mailing lists, or other compilations') }}</p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="43 Identifiable information-106AB" class=""
                    value="<?php echo Helper::validate_key_value(base64_encode('43 Identifiable information-106AB'), $ab_data) ; ?>">
                </x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="Deacribe_135-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('Deacribe_135-106AB'), $ab_data); ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">{{ __('44. Any business-related property you
                                    did
                                    not already list') }}</p>
                <table class="w-100 pl-3">
                    <tr>
                        <td class=""></td>
                        <td class=" width_15percent"></td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="44.1-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('44.1-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Information_137-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Information_137-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="44.2-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('44.2-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Information_138-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Information_138-106AB'), $ab_data); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="44.3-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('44.3-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Information_139-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Information_139-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="44.4-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('44.4-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Information_140-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Information_140-106A'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="44.5-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('44.5-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Information_141-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Information_141-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <x-officialForm.inputText name="44.6-106AB" class=""
                                value="<?php echo Helper::validate_key_value(base64_encode('44.6-106AB'), $ab_data) ; ?>">
                            </x-officialForm.inputText>
                        </td>
                        <td class="">
                            <x-officialForm.priceFieldInput inputFieldName="Information_142-106AB"
                                inputValue="<?php echo Helper::validate_key_value(base64_encode('Information_142-106AB'), $ab_data) ; ?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-9 mt-2">
                <p class="text-bold mb-0">
                    {{ __('45. Add the dollar value of all of your entries
                    from Part 4, including any entries for pages you have attached
                    for Part 4. Write that number here') }}
                </p>
            </div>
            <div class="col-md-1 mt-2">
                <p class="p-text-end mb-0 pt-3">
                    <i class="fa fa-arrow-right"></i>
                </p>
            </div>
            <div class="col-md-2 mt-2 border_1px pt-1 pb-1 width_16percent">
                <x-officialForm.priceFieldInput inputFieldName="DollarValue_143-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('DollarValue_143-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold">{{ __('46. Do you own or have any legal or
                    equitable interest in any farm- or commercial
                    fishing-related
                    property?') }}</p>
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('47. Farm animals') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputTextarea name="47 Farm Animals-106AB" class="" row="2"
                    value="<?php echo Helper::validate_key_value(base64_encode('47 Farm Animals-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="FA_144-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('FA_144-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('48. Crops—either growing or harvested') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputTextarea name="48 Cropseither growing or harvested-106AB" class="" row="2"
                    value="<?php echo Helper::validate_key_value(base64_encode('48 Cropseither growing or harvested-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="undefined_145-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('undefined_145-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('49. Farm and fishing equipment,
                    implements, machinery, fixtures, and tools of trade') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputTextarea name="49-106AB" class="" row="2"
                    value="<?php echo Helper::validate_key_value(base64_encode('49-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="FMoney_148-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('FMoney_148-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('50. Farm and fishing supplies, chemicals, and feed') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputTextarea name="50-106AB" class="" row="2"
                    value="<?php echo Helper::validate_key_value(base64_encode('50-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="FMoney_151-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('FMoney_151-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-12 mt-2">
                <p class="text-bold mb-0">
                    {{ __('51. Any farm- and commercial
                    fishing-related property you did not already list') }}
                </p>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputTextarea name="51-106AB" class="" row="2"
                    value="<?php echo Helper::validate_key_value(base64_encode('51-106AB'), $ab_data) ; ?>" />
            </div>
            <div class="col-md-2 mt-2">
                <x-officialForm.priceFieldInput inputFieldName="FMoney_153-106AB"
                    inputValue="<?php echo Helper::validate_key_value(base64_encode('FMoney_153-106AB'), $ab_data) ; ?>" />
            </div>
            


        </div>
    </form>
</div>
<script>
$(".price-field").on({
    keyup: function() {
        formatCurrency($(this));
    },
    blur: function() {

        formatCurrency($(this), "blur");
    }
});
function formatNumber(n) {

    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function formatCurrency(input, blur) {

    var input_val = input.val();

    if (input_val === "") {
        if (blur === "blur") {
            input.val('0.00');
            return;
        } else {
            return;
        }
    }

    var original_len = input_val.length;
    // initial caret position
    var caret_pos = input.prop("selectionStart");
    // check for decimal
    if (input_val.indexOf(".") >= 0) {
        // get position of first decimal

        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);

        if (blur === "blur") {
            right_side += "00";
        }
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);
        // join number by .
        input_val = left_side + "." + right_side;
    } else {

        input_val = formatNumber(input_val);
        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    // send updated string to input
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}
</script>