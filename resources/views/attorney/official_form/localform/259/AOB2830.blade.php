
    <div class="row">
        <div class="col-md-12 mb-3">
            <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
                <input name="<?php echo base64_encode('Text3'); ?>" type="text" value="WESTERN" class="form-control width_auto"> 
                {{ __('District Of') }} 
                <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="TENNESSEE" class="form-control width_auto"></p>
            </h3>
        </div>

        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="In re"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>            
        </div>

        <div class="col-md-12 mt-3">
            <div class="text-center">
                <h3>{{ __('CHAPTER 13 DEBTOR’S CERTIFICATIONS REGARDING') }}<br>{{ __('DOMESTIC SUPPORT OBLIGATIONS AND SECTION 522(q)') }}</h3>
            </div>
            <div class="mt-3">
                <span class="text_italic"><strong>{{ __('Part I. Certification Regarding Domestic Support Obligations (check no more than one)') }}</strong></span>
            </div>
            <div class="pl-4 mt-2 ">
                <p>{{ __('Pursuant to 11 U.S.C. Section 1328(a), I certify that:') }}<p>
                <div class="form-check">
                    <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
                    <span>{{ __('I owed no domestic support obligation when I filed my bankruptcy petition, and I
                           have not been required to pay any such obligation since then.') }}</span>
                </div>
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box2'); ?>" value="Yes">
                    <span>{{ __('I am or have been required to pay a domestic support obligation. I have paid all such amounts that my chapter 13 plan required me to pay.
                          I have also paid all such amounts that became due between the filing of my bankruptcy petition and today.') }}</span>
                </div>
            </div>
            <div class="mt-3">
                <span class="text_italic"><strong>{{ __('Part II. If you checked the second box, you must provide the information below.') }}</strong></span>
            </div>
            <div class="pl-4">
                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>{{ __('My current address:') }}</p>
                    </div>
                    <div class="col-md-9">
                        <input name="<?php echo base64_encode('My current address'); ?>" type="text" value="{{$debtoraddress}}, {{$debtorCity}} {{$debtorState}} {{$debtorzip}}" class="form-control">
                    </div>
                </div>
                <div class="row mt-1 mb-3">
                    <div class="col-md-3 mb-0">
                        <p class="mb-0">{{ __('My current employer and my employer’s address:') }}</p>
                    </div>
                    <div class="col-md-9">
                        <?php $income_debtoremployer = $income_info['incomedebtoremployer']?>
                        <input name="<?php echo base64_encode('My current employer and my employers address'); ?>" type="text" value="<?php echo Helper::validate_key_value('employer_name', $income_info['incomedebtoremployer']);?>" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <?php
                            $employerAddressDetails = $income_debtoremployer['name_address_employer'].", ".$income_debtoremployer['employer_address_line'].", ".$income_debtoremployer['employer_city'].", ".$income_debtoremployer['employer_state'].", ".$income_debtoremployer['employer_zip'];
                ?>
                        <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="{{$employerAddressDetails}}" class="form-control mt-1">
                    </div>
                </div>
            </div>
            <span class="text_italic"><strong>{{ __('Part III. Certification Regarding Section 522(q) (check no more than one)') }}</strong></span>
            <div class="pl-4 mt-2">
                <p>{{ __('Pursuant to 11 U.S.C. Section 1328(h), I certify that:') }}</p>
                <div class="form-check">
                    <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
                    <span>{{ __('I have not claimed an exemption pursuant to § 522(b)(3) and state or local law (1) in property that I or a dependent of mine uses as a residence,
                         claims as a homestead, or acquired as a burial plot, as specified in § 522(p)(1), and (2) that exceeds $170,350* in value in the aggregate') }}.</span>
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box7'); ?>" value="Yes">
                    <span>{{ __('I have claimed an exemption in property pursuant to § 522(b)(3) and state or local law (1) that I or a dependent of mine uses as a residence,
                         claims as a homestead, or acquired as a burial plot, as specified in § 522(p)(1), and (2) that exceeds $170,350* in value in the aggregate') }}</span>
                </div>
            </div>
            <div class="mt-4">
                <p>* {{ __('Amounts are subject to adjustment on 4/01/22, and every 3 years thereafter with respect to cases
                commenced on or after the date of adjustment.') }}</p>
            </div>
            <div class="mt-3">
                <span class="text_italic"><strong>{{ __('Part IV. Debtor’s Signature') }}</strong></span>
            </div>
            <div class="pl-4 mt-2">
                <p><span class="pl-4"></span> {{ __('I certify under penalty of perjury that the information provided in these certifications is true and correct to the best of my knowledge and belief.') }}</p>
                <div class="row">
                    <div class="col-md-2 p-2 pl-3">
                        <span>{{ __('Executed on') }}</span>
                    </div>
                    <div class="col-md-5"> 
                        <x-officialForm.dateSingle
                            labelText="Date"
                            dateNameField="Date"
                            currentDate={{$currentDate}}
                        ></x-officialForm.dateSingle>
                    </div>
                    <div class="col-md-5 text-center"> 
                        <x-officialForm.signVertical
                            labelText="Debtor"
                            signNameField="Debtor"
                            sign={{$debtor_sign}}
                        ></x-officialForm.signVertical>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
