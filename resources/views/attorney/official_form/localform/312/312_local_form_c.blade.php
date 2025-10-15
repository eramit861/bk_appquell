<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF WYOMING') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
                debtorNameField="Text52"
                debtorname={{$debtorname}}
                rows="3">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="Text51"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <label>{{ __('CHAPTER 13') }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('CHAPTER 13 PLAN SUMMARY') }}</h3>
    </div>

    <div class="col-md-12">
        <p class="mb-0">
            <span class="pr-1">{{ __('A.') }}</span>
            {{ __('Total debt provided under the plan and administrative expenses') }}
        </p>
    </div>
    <div class="d-flex col-md-10">
        <div class="pl-4 pt-2">
            <label class="float_right">1.</label>
        </div>
        <div class="w-100 pl-4 pt-2">
            <label>{{ __('Attorney Fees') }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <x-officialForm.priceFieldInput
                inputFieldName="Text1"
                inputValue=""
        ></x-officialForm.priceFieldInput>
    </div>

    <div class="d-flex col-md-10">
        <div class="pl-4 pt-2">
            <label class="float_right">2.</label>
        </div>
        <div class="w-100 pl-4 pt-2">
            <label>{{ __('Mortgage Arrears') }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="Text2" class=" price-field" value=""></x-officialForm.inputText>
        </div>
    </div>
    <div class="d-flex col-md-10">
        <div class=" pl-4 pt-2">
            <label class="float_right">3.</label>
        </div>
        <div class="w-100 pl-4 pt-2">
            <label>{{ __('Secured Claims (including adequate protection payments) (list separately)') }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="Text3" class=" price-field" value=""></x-officialForm.inputText>
        </div>
    </div>
    <div class="d-flex col-md-10">
        <div class="pl-4 pt-2">
            <label class="float_right">4.</label>
        </div>
        <div class=" w-100 pl-4 pt-2">
            <label>{{ __('Priority Claims (list separately)') }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="Text4" class=" price-field" value=""></x-officialForm.inputText>
        </div>
    </div>
    <div class="d-flex col-md-10">
        <div class=" pl-4 pt-2">
            <label class="float_right">5.</label>
        </div>
        <div class=" w-100 pl-4 pt-2">
            <label>{{ __('Separate Class of Unsecured Claims') }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="Text5" class=" price-field" value=""></x-officialForm.inputText>
        </div>
    </div>
    <div class="d-flex col-md-10">
        <div class=" pl-4 pt-2">
            <label class="float_right">6.</label>
        </div>
        <div class=" w-100 pl-4 pt-2">
            <label>{{ __('All other unsecured creditors') }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="Text6" class=" price-field" value=""></x-officialForm.inputText>
        </div>
    </div>

    <div class="col-md-1"></div>
    <div class="col-md-9 pl-0">
        <p class="mt-2">{{ __('Total payments to above creditors') }}</p>
        <p class="mt-3">{{ __('Trustee percentage fee') }}</p>
        <p class="mt-3">{{ __('Total debtor payments to the plan') }}</p>
    </div>
    <div class="col-md-2">
       <x-officialForm.priceFieldInput
                inputFieldName="undefined_7"
                inputValue=""
        ></x-officialForm.priceFieldInput>
        <div class="mt-1">
            <x-officialForm.priceFieldInput
                    inputFieldName="undefined_8"
                    inputValue=""
            ></x-officialForm.priceFieldInput>
        </div>
        <div class="mt-1">
            <x-officialForm.priceFieldInput
                    inputFieldName="undefined_9"
                    inputValue=""
            ></x-officialForm.priceFieldInput>
        </div>
    </div>
    <div class="col-md-12">
        <p class="mb-0">
            <span class="pr-1">{{ __('B.') }}</span>
            {{ __('Reconciliation with Chapter 7') }}
        </p>
    </div>
    <div class="d-flex col-md-4">
        <div class="pl-4 pt-2">
            <label class="float_right">1.</label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="d-flex">
                <div class="pl-3">
                     <span>{{ __('a.') }}</span>
                </div>
                <div class="pl-4">
                    <span>{{ __('Value of real property') }}</span>
                    <p class="mb-0 mt-3 pl-3 pt-1"><span class="pl-4"></span> {{ __('Less secured claims') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <x-officialForm.priceFieldInput
                inputFieldName="undefined"
                inputValue=""
        ></x-officialForm.priceFieldInput>
        <div class="input-group d-flex mt-1">
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">(</span>
            </div>
            <x-officialForm.inputText name="undefined_2" class="" value=""></x-officialForm.inputText>
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">)</span>
            </div>
        </div>
    </div>
    <div class="col-md-6"></div>

    <div class="d-flex col-md-4">
        <div class="pl-4 pt-2">
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="d-flex">
                <div class="pl-4">
                </div>
                <div class="pl-4">
                    <p class="mb-0 mt-2 pl-4"><span class="pl-4"></span> {{ __('Less exemptions') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">(</span>
            </div>
            <x-officialForm.inputText name="undefined_3" class="mr-0" value="">

            </x-officialForm.inputText>
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">)</span>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-2 mt-1">
       <x-officialForm.priceFieldInput
                inputFieldName="undefined_10"
                inputValue=""
        ></x-officialForm.priceFieldInput>
    </div>

    <div class="d-flex col-md-4 mt-2">
        <div class="pl-4 pt-2">
            <label class="float_right"></label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="d-flex">
                <div class="pl-4">
                     <span>{{ __('b.') }}</span>
                </div>
                <div class="pl-4">
                    <span>{{ __('Value of personal property') }}</span>
                    <p class="mb-0 mt-3 pl-3"><span class="pl-4"></span> {{ __('Less secured claims') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 mt-1">
        <x-officialForm.priceFieldInput
                inputFieldName="undefined_4"
                inputValue=""
        ></x-officialForm.priceFieldInput>
        <div class="input-group d-flex mt-1">
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">(</span>
            </div>
            <x-officialForm.inputText name="undefined_5" class="mr-0" value=""></x-officialForm.inputText>
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">)</span>
            </div>
        </div>
    </div>
    <div class="col-md-6"></div>

    <div class="d-flex col-md-4">
        <div class="pl-4 pt-2">
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="d-flex pl-4">
                <div class="pl-4">
                </div>
                <div class="pl-4">
                    <p class="mb-0 mt-2"><span class="pl-4"></span> {{ __('Less exemptions') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
       <div class="input-group d-flex mt-1">
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">(</span>
            </div>
            <x-officialForm.inputText name="undefined_6" class="mr-0" value=""></x-officialForm.inputText>
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">)</span>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-2">
        <x-officialForm.priceFieldInput
                inputFieldName="undefined_11"
                inputValue=""
        ></x-officialForm.priceFieldInput>
    </div>

    <div class="col-md-6 d-flex mt-2">
        <div class="pl-4 pt-2">
            <label class="float_right"></label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="d-flex">
                <div class="pl-4">
                     <span>{{ __('c.') }}</span>
                </div>
                <div class="pl-4">
                    <span>{{ __('Value of avoidable transfers') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-1">
    </div>
    <div class="col-md-2 mt-1">
        <x-officialForm.priceFieldInput
            inputFieldName="undefined_12"
            inputValue=""
        ></x-officialForm.priceFieldInput>
    </div>

    <div class="col-md-6 d-flex mt-2">
        <div class="pl-4 pt-2">
            <label class="float_right"></label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="d-flex">
                <div class="pl-4">
                     <span>{{ __('d.') }}</span>
                </div>
                <div class="pl-4">
                    <span>{{ __('Less unsecured priority claims') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-1">
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="undefined_13" class="" value=""></x-officialForm.inputText>
        </div>
    </div>

    <div class="col-md-6 d-flex mt-2">
        <div class="pl-4 pt-2">
            <label class="float_right"></label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="d-flex">
                <div class="pl-4">
                     <span>{{ __('e.') }}</span>
                </div>
                <div class="pl-4">
                    <span>{{ __('Less estimated chapter 7 administrative expenses and costs') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-1">
    </div>
    <div class="col-md-2 mt-1">
       <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="undefined_14" class="" value=""></x-officialForm.inputText>
        </div>
    </div>

    <div class="col-md-6 d-flex mt-2">
        <div class="pl-4 pt-2">
            <label class="float_right"></label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="pl-4">
                <span>{{ __('Total paid under hypothetical chapter 7 to unsecured creditors') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-1">
    </div>
    <div class="col-md-2 mt-1">
        <x-officialForm.priceFieldInput
            inputFieldName="undefined_15"
            inputValue=""
        ></x-officialForm.priceFieldInput>
    </div>
    <div class="col-md-6 d-flex mt-2">
        <div class="pl-4 pt-2">
            <label class="float_right">2.</label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="pl-3">
                <span>{{ __('Percent of unsecured, non-priority claims paid under the plan') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-1">
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="undefined_16" class="mr-0" value=""></x-officialForm.inputText>
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">%</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex mt-2">
        <div class="pl-4 pt-2">
            <label class="float_right">3.</label>
        </div>
        <div class="w-100 pl-5 pt-2">
            <div class="pl-3">
                <span>{{ __('Estimated percentage of unsecured, non-priority claims paid if chapter 7 were filed') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-1">
    </div>
    <div class="col-md-2 mt-1">
        <div class="input-group d-flex mt-1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">&nbsp;</span>
            </div>
            <x-officialForm.inputText name="undefined_17" class="mr-0" value=""></x-officialForm.inputText>
            <div class="input-group-append pt-2">
                <span class="input-group-text" id="basic-addon2">%</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated:') }}"
            dateNameField="Dated"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Debtor(s)') }}"
            inputFieldName="Debtors"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3 pl-4">
    <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Counsel') }}"
            inputFieldName="Counsel"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    
</div>