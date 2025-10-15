<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('THE EASTERN DISTRICT OF MICHIGAN') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text144"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="demo1"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="demo2"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo> 
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Hon"
                casenoNameField="demo3"
                caseno="">
            </x-officialForm.caseNo> 
        </div>
    </div>
 
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-3">{{ __('STATEMENT OF ATTORNEY FOR DEBTOR(S)') }}<br>{{ __('PURSUANT TO F.R. BANKR.P. 2016(b)') }}</h3>
        <p class="">{{ __('The undersigned, pursuant to F.R.Bankr.P. 2016(b), states that:') }}</p>
        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('The undersigned is the attorney for the Debtor(s) in this case.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('The compensation paid or agreed to be paid by the Debtor(s) to the undersigned is: [Check one]') }}</p>
                <div class="d-flex">
                    <div class="">
                        <x-officialForm.inputCheckbox name="Check Box1" class="" value="Yes" />
                    </div>
                    <div class="w-100 pl-3">
                        <p class="text-bold underline">{{ __('FLAT FEE') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="pt-2">
                        <label for="">A.</label>
                    </div>
                    <div class="row w-100 pl-3">
                        <div class="col-md-8 pt-2">
                            <p class="mb-0">{{ __('For legal services rendered in contemplation of and in connection with this case, exclusive of the filing fee paid') }}</p>
                        </div>
                        <div class=" col-md-4">
                            <x-officialForm.inputText name="Text145" class="w-auto price-field" value="" />
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="pt-2">
                        <label for="">B.</label>
                    </div>
                    <div class="row w-100 pl-3">
                        <div class="col-md-8 pt-2">
                            <p class="mb-0">{{ __('Prior to filing this statement, received') }}</p>
                        </div>
                        <div class=" col-md-4">
                            <x-officialForm.inputText name="Text146" class="w-auto price-field" value="" />
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="pt-2">
                        <label for="">C.</label>
                    </div>
                    <div class="row w-100 pl-3">
                        <div class="col-md-8 pt-2">
                            <p class="mb-0">{{ __('The unpaid balance due and payable is') }}</p>
                        </div>
                        <div class=" col-md-4">
                            <x-officialForm.inputText name="Text147" class="w-auto price-field" value="" />
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <div class="">
                        <x-officialForm.inputCheckbox name="Check Box2" class="" value="Yes" />
                    </div>
                    <div class="w-100 pl-3">
                        <p class="text-bold underline">{{ __('RETAINER') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="pt-2">
                        <label for="">A.</label>
                    </div>
                    <div class="row w-100 pl-3">
                        <div class="col-md-8 pt-2">
                            <p class="mb-0">{{ __('Amount of retainer received') }}</p>
                        </div>
                        <div class=" col-md-4">
                            <x-officialForm.inputText name="Text150" class="w-auto price-field" value="" />
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="pt-2">
                        <label for="">B.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">{{ __('The undersigned shall bill against the retainer at an hourly rate of') }} $ 
                            <x-officialForm.inputText name="The undersigned shall bill against the retainer at an hourly rate of" class="w-auto price-field" value="" />
                            {{ __('[Or attach firm hourly rate schedule.] Debtor(s)
                            have agreed to pay all Court approved fees and expenses exceeding the amount of the retainer.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="pt-2                                                                                                    ">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-3">
                <p>$ <x-officialForm.inputText name="undefined_2" class="w-auto price-field" value="" /> {{ __('of the filing fee has been paid.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('In return for the above-disclosed fee, I have agreed to render legal service for all aspects of the bankruptcy case, including: [Cross out any that do not apply.]') }}</p>
                <div class="d-flex mt-1">
                    <div class="">
                        <label for="">A.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            {{ __('Analysis of the debtor\'s financial situation, and rendering advice to the debtor in determining whether to file a petition in bankruptcy;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="">
                        <label for="">B.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            {{ __('Preparation and filing of any petition, schedules, statement of affairs and plan which may be required;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="">
                        <label for="">C.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            {{ __('Representation of the debtor at the meeting of creditors and confirmation hearing, and any adjourned hearings thereof;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="">
                        <label for="">D.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            {{ __('Representation of the debtor in adversary proceedings and other contested bankruptcy matters;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="">
                        <label for="">E.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            {{ __('Reaffirmations;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="">
                        <label for="">F.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            {{ __('Redemptions;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="pt-2">
                        <label for="">G.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                        {{ __('Other') }}:
                            <x-officialForm.inputText name="Other" class=" width_70percent" value="" /> 
                        </p>
                    </div>
                </div>
            </div>          
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('By agreement with the debtor(s), the above-disclosed fee does not include the following services:') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">6.</label>
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('The source of payments to the undersigned was from:') }}</p>
                <div class="d-flex mt-1">
                    <div class="">
                        <label for="">A.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            <x-officialForm.inputCheckbox name="Check Box148" class="" value="Yes" />
                            {{ __('Debtor(s)’ earnings, wages, compensation for services performed') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-1">
                    <div class="pt-2">
                        <label for="">B.</label>
                    </div>
                    <div class=" w-100 pl-3">
                        <p class="mb-0">
                            <x-officialForm.inputCheckbox name="Check Box149" class="" value="Yes" />
                            {{ __('Other (describe, including the identity of payor)') }}
                            <x-officialForm.inputText name="Other describe including the identity of payor" class=" width_30percent" value="" /> 
                        </p>
                    </div>
                </div>
            </div>          
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">7.</label>
            </div>
            <div class="w-100 pl-3">
                <p>{{ __("The undersigned has not shared or agreed to share, with any other person, other than with members of the undersigned's law firm or
                corporation, any compensation paid or to be paid except as follows:") }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-1 pt-2">
        <label for="">{{ __('Dated:') }}</label>
    </div>
    <div class="col-md-5">
        <input name="<?php echo base64_encode('Dated');?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for the Debtor(s)" 
            inputFieldName="Attorney for the Debtors" 
            inputValue="{{$attorny_sign}}" 
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-1 pt-2">
        <label for="">{{ __('Agreed:') }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor" 
            inputFieldName="Agreed" 
            inputValue="{{$debtor_sign}}" 
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor" 
            inputFieldName="undefined_3" 
            inputValue="{{$debtor2_sign}}" 
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

</div>    