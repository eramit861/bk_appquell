<div class="row">
    <div class=" col-md-12 text-center mb-3">
        <h3 class="underline">{{ __('LOCAL BANKRUPTCY FORM 3015-3(b)') }}</h3>
        <h3 class="mt-3">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE MIDDLE DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtors"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="CHAPTER"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <div class="row">
                <div class="col-md-3 pt-2">
                    <label>{{ __('CASE NO.') }}</label>
                </div>
                <div class="col-md-9">
                    <p>
                        <input type="text"  name="<?php echo base64_encode('Office Number'); ?>" class="form-control width_10percent">
                        -
                        <input type="text" name="<?php echo base64_encode('Text4'); ?>" class="form-control width_20percent">
                        -bk-
                        <input type="text" name="<?php echo base64_encode('Case Number'); ?>" class="form-control w-auto" value="{{$caseno}}">
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class=" col-md-12 text-center mb-3 mt-3">
        <h3 class="">{{ __('CERTIFICATION REGARDING') }}<br>{{ __('DOMESTIC SUPPORT OBLIGATION(S)') }}</h3>
    </div>
    
    <div class=" col-md-12 ">
        <p class=" p_justify">
            <span class="pl-4"></span>
            {{ __('If there are domestic support obligation claims in a case, the Bankruptcy Abuse Prevention and
            Consumer Protection Act of 2005 requires the trustee to provide written notice to the holder of the claim and
            to the applicable state child support enforcement agency. In order for the trustee to comply with the Act, the
            Debtor/Obligor must complete the following information and verify the information is true and correct by
            signing at the bottom of this form.') }}
        </p>
        <div class="d-flex pl-2">
            <label class="pl-2">1.</label>
            <div class="pl-2 w-100 row">
                <div class="col-md-12">
                    <p class="mb-0">
                        {{ __('Name of Person Entitled to Receive Domestic Support (“Recipient”):') }}
                    </p>
                </div>
                <div class="col-md-3 pt-2">
                    <label for="">{{ __('Claim Holder') }}</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="<?php echo base64_encode('Claim holder name'); ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                </div>
                <div class="col-md-3 text-center">
                    <label for="">{{ __('Last Name') }}</label>
                </div>
                <div class="col-md-3 text-center">
                    <label for="">{{ __('First') }}</label>
                </div>
                <div class="col-md-3 text-center">
                    <label for="">{{ __('Middle Initial') }}</label>
                </div>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="pl-2">2.</label>
            <div class="pl-2 w-100 row">
                <div class="col-md-12">
                    <p class="mb-0">
                        {{ __('Address of Domestic Support Recipient:') }}
                    </p>
                </div>
                <div class="col-md-3 pt-2">
                    <label for="">{{ __('Claim Holder') }}</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="<?php echo base64_encode('Claim holder address line 1'); ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                </div>
                <div class="col-md-5 text-center">
                    <label for="">{{ __('Street') }}</label>
                </div>
                <div class="col-md-4 text-center">
                    <label for="">{{ __('City') }}</label>
                </div>
                <div class="col-md-3 pt-2">
                    <label for=""></label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="<?php echo base64_encode('Claim holder address line 2'); ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                </div>
                <div class="col-md-3 text-center">
                    <label for="">{{ __('Country') }}</label>
                </div>
                <div class="col-md-3 text-center">
                    <label for="">{{ __('State') }}</label>
                </div>
                <div class="col-md-3 text-center">
                    <label for="">Zip</label>
                </div>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="pl-2">3.</label>
            <div class="pl-2 w-100 row">
                <div class="col-md-12">
                    <p class="mb-0">
                        {{ __('Telephone Number of Domestic Support Recipient:') }}
                    </p>
                </div>
                <div class="col-md-3 pt-2">
                    <label for="">{{ __('Claim Holder') }}</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="<?php echo base64_encode('Claim holder phone number'); ?>" class="form-control">
                </div>
                <div class="col-md-3"></div>

                <div class="col-md-3"></div>
                <div class="col-md-6 text-center">
                    <label for="">{{ __('(Area Code) Phone Number') }}</label>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="pl-2">4.</label>
            <div class="pl-2 w-100 row">
                <div class="col-md-12">
                    <p class="mb-0">
                        {{ __('If you are paying a Domestic Support Obligation pursuant to a Court Order, provide the following:') }}
                    </p>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="text" name="<?php echo base64_encode('Name of Court'); ?>" class="form-control">
                    <label for="">{{ __('Name of Court') }}</label>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="text" name="<?php echo base64_encode('Address of Court'); ?>" class="form-control">
                    <label for="">{{ __('Address of Court') }}</label>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="text" name="<?php echo base64_encode('Docket Number and PACSES Number'); ?>" class="form-control">
                    <label for="">{{ __('Docket Number') }}</label>
                    <label class=" float_right">{{ __('PACSES Number') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            {{ __('The undersigned hereby certifies that the foregoing statements are true and correct under penalty of perjury.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="DATED:"
            dateNameField="Dated"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <div class="input-group d-flex">
            <label class="pt-2">BY:</label>
            <div class="pl-3 w-100">
                <input  name="<?php echo base64_encode('Debtor'); ?>" value="{{$debtor_sign}}" type="text" class="form-control">
            </div>
        </div>
        <div class="text-center">
            <label>{{ __('Debtor') }}</label>
        </div>
    </div>
</div>