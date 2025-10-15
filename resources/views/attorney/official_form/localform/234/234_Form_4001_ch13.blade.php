<div class="row">

    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="TextBox0"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="TextBox1"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="TextBox2"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3>{{ __('CERTIFICATION') }}</h3>
        <h3 class="underline">{{ __('AND REQUEST FOR ISSUANCE OF DISCHARGE') }}</h3>
    </div>

    <div class="col-md-12">
        <p class="p_justify">{{ __('Debtor(s) hereby certify under penalty of perjury that the following statements are true and correct:') }}</p>
        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify">{{ __('The Chapter 13 Trustee has filed a Notice of Plan Completion or Notice of Early Plan
                Completion stating that the Debtor(s) paid sufficient funds to the Trustee to meet all
                obligations required by the plan or to pay all claims in full even though the term of the
                plan has not expired, or a Motion for Entry of Discharge under 11 U.S.C. §1328(b).') }}</p>
            </div>
        </div>
        <p class="text-bold p_justify">(<span class="text_italic">{{ __('Select One') }}</span>)</p>
        <div class="d-flex">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-4">
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('CheckBox0');?>" value="YES" class=" form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="p_justify">{{ __("The Debtor(s) completed, after the filing of this case, the Personal Financial
                        Management course required by 11 U.S.C. § 1328(g)(1) and filed the requisite
                        certification (Official Form 423: Debtor's Certification of Completion of Instructional
                        Course Concerning Personal Financial Management).") }}</p>
                        <p class="p_justify">{{ __('OR') }}</p>
                    </div>
                </div>
                <div class="d-flex ">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('CheckBox1');?>" value="YES" class=" form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="mb-1 p_justify">{{ __('The Debtor(s) are not able to complete the requirements set forth above because of
                        incapacity, disability, or active military duty in a military combat zone. Specify:') }}</p>
                        <input type="text" name="<?php echo base64_encode('TextBox4');?>" class=" form-control width_50percent">
                    </div>
                </div>
            </div>
        </div>
        <p class="text-bold p_justify mt-3">(<span class="text_italic">{{ __('Select One') }}</span>)</p>
        <div class="d-flex">
            <div class="">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-4">
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('CheckBox2');?>" value="YES" class=" form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="p_justify">{{ __('Debtor(s) have not been required by a judicial or administrative order, or by statute, to
                        pay any domestic support obligation, as defined in 11 U.S.C. § 101(14A), either prior
                        to the date the petition was filed or any time after the petition date.') }}</p>
                        <p class="p_justify">{{ __('OR') }}</p>
                    </div>
                </div>
                <div class="d-flex ">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('CheckBox3');?>" value="YES" class=" form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="p_justify mb-1">{{ __('Prior to the date of this certification, Debtor(s) paid all amounts due under a domestic
                        support obligation, as defined in 11 U.S.C. § 101(14A) and required by a judicial or
                        administrative order, or by statute (including amounts due before the petition was filed,
                        but only to the extent provided for by the Plan) in accordance with 11 U.S.C. § 1328(a).') }}</p>
                        <p class="p_justify text_italic">{{ __('If you checked the second box, you must provide the information below.') }}</p>
                        <div class="pl-2">
                            <x-officialForm.debtorSignVertical
                                labelContent="My current address:"
                                inputFieldName="TextBox5"
                                inputValue=""
                            ></x-officialForm.debtorSignVertical>
                        </div>
                        <div class="pl-2 mt-1">
                            <x-officialForm.debtorSignVertical
                                labelContent="My current employer and my employer's address:"
                                inputFieldName="TextBox6"
                                inputValue=""
                            ></x-officialForm.debtorSignVertical>
                        </div>
                            <input type="text" name="<?php echo base64_encode('TextBox7');?>" class=" form-control mt-1">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify">{{ __('If the Debtor(s) claim a homestead exemption in excess of the dollar amount listed in 11
                U.S.C. § 522(q)(1)* at the time of commencement of the case, there is no proceeding
                pending in which the Debtor(s) may be found guilty of a felony of the kind described in 11
                U.S.C. § 522(q)(1)(A) or liable for a debt of the kind described in 11 U.S.C. § 522(q)(1)(B)') }}.</p>
            </div>
        </div>
        <p class="p_justify">{{ __('Debtor(s) declare under penalty of perjury that the foregoing statements are true and correct to the
        best of my/our knowledge, information and belief, and that the Court may rely on the truth of each
        statement in determining whether to grant a discharge in this case. Debtor(s) further
        understand(s) that the Court may revoke the discharge if such order of discharge was procured by
        fraud.') }}</p>
    </div>

    
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="TextBox8"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6"></div>

    <div class="col-md-6 pt-2">
        <label class="float_right">s/</label>
    </div>
    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('TextBox9');?>" value="{{$debtor_sign}}" class=" form-control mt-1">
    </div>    
    <div class="col-md-6 pt-2">
        <label class="float_right">{{ __('Debtor') }}</label>
    </div>
    <div class="col-md-6"></div>

    <div class="col-md-6 pt-2">
        <label class="float_right">s/</label>
    </div>
    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('TextBox10');?>" value="{{$debtor2_sign}}" class=" form-control mt-1">
    </div>    
    <div class="col-md-6 pt-2">
        <label class="float_right">{{ __('Debtor') }}</label>
    </div>
    <div class="col-md-6"></div>

    <div class="col-md-12 mt-3">
        <h3 class="underline text-center">{{ __('NOTICE OF OPPORTUNITY TO OBJECT') }}</h3>
        <p class=" p_justify mt-3" >
            <span class="pl-4"></span>
            {{ __('Any objections to the accuracy of the Certification must be filed within fourteen (14) days
            of the date of filing of this document. If no objections are filed, the Court will consider entering
            the discharge in this case without further notice or hearing.') }}
        </p>
    </div>

    <div class="col-md-6 pt-2">
        <label class="float_right">s/</label>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor or Debtor’s Attorney"
            inputFieldName="TextBox11"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        <textarea name="<?php echo base64_encode('TextBox12');?>" class="form-control mt-1" rows="6"></textarea>
        <label for="">{{ __('Name/OBA#/Address/Telephone #/Email') }}</label>
    </div>
    
    <div class="col-md-12 mt-3">
        <p>* {{ __('Dollar amounts are adjusted on April 1 every third year, and the adjusted dollar amount applies
        to cases commenced on or after the date of adjustment.') }}</p>
    </div>

</div>