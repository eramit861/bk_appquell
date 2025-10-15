<div class="row">
    <div class="col-md-12 mt-3 text-center">
        <h3>{{ __('CHAPTER 7 DEBTOR QUESTIONNAIRE') }}</h3>
    </div>
    <div class="col-md-12 mt-3 text-bold">
        <p class="p_justify">
            <span class="pl-4"></span>
            {{ __('All debtors must complete this Questionnaire and send it to their Chapter 7 trustee. Unless
            the Chapter 7 trustee requests otherwise, the completed Questionnaire shall be sent via U.S. Mail,
            postmarked no later than 14 days before the date set for the Meeting of Creditors/341 Hearing
            Date. If represented by an attorney, debtors should discuss their responses with their attorneys
            prior to sending their competed questionnaire to the Chapter 7 trustee.') }}
        </p>
    </div>
    <div class="col-md-4">
        <label class="text-bold">{{ __('DEBTOR 1 NAME:') }}</label>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="<?php echo base64_encode('Debtor Name'); ?>" value="{{$onlyDebtor}}" class="form-control">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Phone:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('Phone'); ?>" class="form-control" value="{{$debtorPhoneHome}}">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Email:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('Email'); ?>" class="form-control" value="">
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-4 mt-3">
        <label for=""><span class="text-bold">{{ __('DEBTOR 2 NAME') }}</span> {{ __('(if applicable):') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="<?php echo base64_encode('Debtor 2 Name if applicable'); ?>" value="{{$spousename}}" class="form-control">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Phone:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('Debtor 2 Phone'); ?>" class="form-control" value="{{$spousePhoneHome}}">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Email:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('Debtor 2 Email'); ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-3"></div>


    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('CASE NUMBER:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('Case Number'); ?>" value="{{$caseno}}" class="form-control w-auto">
    </div>
    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('341 HEARING DATE:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('341 Hearing Date'); ?>" class="form-control w-auto">
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex pl-4">
            <div>
                <label for="">1.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you reviewed your Petition, Schedules, and Statement of Financial Affairs and do you
                    understand the information contained in them?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box1'
                    yesValue='Yes'
                    noFieldName='Check Box2'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">2.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you reviewed the Bankruptcy Information Sheet and do you understand the information
                    contained in it?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box3'
                    yesValue='Yes'
                    noFieldName='Check Box4'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">3.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('For those filing individually, are you presently married?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box5'
                    yesValue='Yes'
                    noFieldName='Check Box6'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
                <p class="mb-2">
                    {{ __('If you answered yes to this question, please provide the following information:') }}
                </p>
                <div class="row">
                    <div class="col-md-4 pt-2">
                        <label for="">{{ __('(a) Date married:') }}</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="<?php echo base64_encode('Date married'); ?>" class="form-control w-auto">
                    </div>

                    <div class="col-md-4 pt-2 mt-1">
                        <label for="">{{ __('(b) Name of spouse:') }}</label>
                    </div>
                    <div class="col-md-8 mt-1">
                        <input type="text" name="<?php echo base64_encode('Name of spouse'); ?>" class="form-control w-auto">
                    </div>
                </div>
                <p class=" p_justify mb-1 mt-2">
                    {{ __('(c) Are all of your, your spouse’s and your marital community’s assets listed on your schedules?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box7'
                    yesValue='Yes'
                    noFieldName='Check Box8'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">4.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you been divorced in the 2 years prior to your bankruptcy filing?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box9'
                    yesValue='Yes'
                    noFieldName='Check Box10'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">5.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you own any bitcoin or other cryptocurrency?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box11'
                    yesValue='Yes'
                    noFieldName='Check Box12'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">6.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you involved in any lawsuit in which you are seeking to recover money or property from a
                    person or entity (such as a personal injury claim, automobile accident claim, or class action
                    claim)?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box13'
                    yesValue='Yes'
                    noFieldName='Check Box14'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
                <p class="mb-2">
                    {{ __('If you answered yes to this question, please provide the following information:') }}
                </p>
                <p class="mb-2">
                    {{ __('(a) Nature of the lawsuit (example: personal injury/auto accident, class action, etc.):') }}
                </p>
                <input type="text" name="<?php echo base64_encode('Nature of the lawsuit'); ?>" class="form-control ">
                <input type="text" name="<?php echo base64_encode('Nature of the lawsuit - continued'); ?>" class="form-control mt-1">
                <div class="row">
                    <div class="col-md-4 pt-2 mt-1">
                        <label for="">{{ __('(b) Case number:') }}</label>
                    </div>
                    <div class="col-md-8 mt-1">
                        <input type="text" name="<?php echo base64_encode('Case number of lawsuit'); ?>" class="form-control w-auto">
                    </div>
                </div>
                <p class=" p_justify mb-1 mt-2">
                    {{ __('(c) Name and telephone number of the attorney handling that lawsuit:') }}
                </p>
                <input type="text" name="<?php echo base64_encode('Name and telephone number of attorney handling that'); ?>" class="form-control ">
            </div>
        </div>
        <div class="d-flex pl-4 mt-3">
            <div>
                <label for="">7.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you aware of any') }} <span class=" text-bold text_italic">{{ __('potential') }}</span> {{ __('claim or right to payment that you may have against any person
                    or entity (such as personal injury claims, automobile accident claims, class action claims or
                    settlements)?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box15'
                    yesValue='Yes'
                    noFieldName='Check Box16'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
                <p class="mb-2">
                    {{ __('If you answered yes to this question, please provide the following information:') }}
                </p>
                <div class="row">
                    <div class="col-md-4 pt-2 mt-1">
                        <label for="">{{ __('(a) Nature of your claim or right to payment:') }} </label>
                    </div>
                    <div class="col-md-7 mt-1">
                        <input type="text" name="<?php echo base64_encode('Nature of your claim or right to payment'); ?>" class="form-control ">
                    </div>
                </div>
                <p class=" p_justify mb-1 mt-2">
                    {{ __('(b) Name and telephone number of the attorney handling that claim, if any') }}
                </p>
                <input type="text" name="<?php echo base64_encode('Name and telephone number of attorney handling that claim if any'); ?>" class="form-control ">
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">8.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you entitled to receive a death benefit under a will or insurance policy where the person has
                    already died?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box17'
                    yesValue='Yes'
                    noFieldName='Check Box18'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">9.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that you must report any rights to an inheritance or life insurance proceeds
                    that arise within 180 days after your bankruptcy filing by notifying your trustee and by filing
                    amended Schedules A/B and C with the court?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box19'
                    yesValue='Yes'
                    noFieldName='Check Box20'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">10.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you the beneficiary of any estates or trusts?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box21'
                    yesValue='Yes'
                    noFieldName='Check Box22'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">11.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you the trustee or settlor of any trusts?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box23'
                    yesValue='Yes'
                    noFieldName='Check Box24'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">12.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you filed federal and state income tax returns for the 2 years before your bankruptcy filing?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box25'
                    yesValue='Yes'
                    noFieldName='Check Box26'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">13.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that any tax refunds due to you at the time of your bankruptcy filing may be
                    required to be turned over to your Chapter 7 trustee?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box27'
                    yesValue='Yes'
                    noFieldName='Check Box28'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">14.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that you must provide your Chapter 7 trustee with a copy of your federal and
                    state tax returns for the tax year that includes the date of your bankruptcy filing? (Example: If
                    you filed your bankruptcy petition on February 2, 2022, you must provide copies of your 2022
                    federal and state tax returns when you file them in 2023)') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box29'
                    yesValue='Yes'
                    noFieldName='Check Box30'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">15.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that any tax refund due to you for the year that includes the date of your
                    bankruptcy filing may be required to be turned over to your Chapter 7 trustee? Your trustee will
                    return to you any portion of the refund to which you are entitled.') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box31'
                    yesValue='Yes'
                    noFieldName='Check Box32'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">16.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('In the 12 months before filing your bankruptcy petition, did you fully or partially repay any
                    family members, friends, or relatives on any loans?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box33'
                    yesValue='Yes'
                    noFieldName='Check Box34'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">17.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('In the 12 months before filing your bankruptcy petition, did you transfer any assets or money to
                    family members, friends, or relatives?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box35'
                    yesValue='Yes'
                    noFieldName='Check Box36'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">18.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you purchased a vehicle or refinanced a vehicle loan in the 6 months prior to your
                    bankruptcy filing?') }}
                </p>
                <x-officialForm.localFormCheckbox
                    yesFieldName='Check Box37'
                    yesValue='Yes'
                    noFieldName='Check Box38'
                    noValue='Yes'></x-officialForm.localFormCheckbox>
                <p class="mt-3 text-bold">{{ __('I declare under penalty of perjury that the above information is true and correct.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-1 mt-3">
        <label class="mt-2">{{ __('Debtor 1:') }}</label>
    </div>
    <div class="col-md-5 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="[Signature]"
            inputFieldName="Text1"
            inputValue={{$debtor_sign}}></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text3"
            currentDate={{$currentDate}}></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-1 mt-2">
        <label class="mt-2">{{ __('Debtor 2:') }}</label>
    </div>
    <div class="col-md-5 mt-2 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="[Signature]"
            inputFieldName="Text2"
            inputValue={{$debtor2_sign}}></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-2">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text4"
            currentDate={{$currentDate}}></x-officialForm.dateSingleHorizontal>
    </div>
</div>