<div class="row">

    <div class="col-md-6 border_1px p-3 br-0">
    <textarea name="<?php echo base64_encode("FilingPartyInfo"); ?>" class="form-control" rows="9"></textarea>
        <div class="mt-1 pt-2 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="{{ __('Attorney for:') }}"
                inputFieldName="ATYforPTY"
                inputValue={{$attorney_name}}>
            </x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <p class="p_justify text-c-red">
            {{ __('Please include name, address, and phone number of the submitting party in the box to the left. Attorneys should also include firm name and bar number.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF CALIFORNIA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="DBNameField"
            debtorname={{$debtorname}}
            rows="5">
        </x-officialForm.inReDebtorCustom>
    </div> 
    <div class="col-md-6 border_1px p-3">
        <div class="row mt-1">
            <div class="col-md-4 text-bold pt-2">
                <label class="">{{ __('Bankruptcy Case No.:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input name="<?php echo base64_encode('BKCaseNo'); ?>"  type="text" value="{{$caseno}}" class="w-auto form-control ml-3">
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4 text-bold pt-2">
                <label class="">{{ __('Docket Control Number:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input name="<?php echo base64_encode('BKDCN'); ?>"  placeholder="" type="text" value="" class="w-auto form-control ml-3">
            </div>
        </div>
        <div class="col-md-12 mt-1 pl-0">
            <p class="text-bold">{{ __('Hearing Information') }} <span class="text_italic"> {{ __('(if applicable):') }} </span> </p>
        </div>
        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Hearing Date:') }}"
                inputFieldName="BKHearing"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Hearing Time:') }}"
                inputFieldName="BKHearingTime"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Location:') }}"
                inputFieldName="BKLocation"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Judge:') }}"
                inputFieldName="BKJudge"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    
    <div class="col-md-6 border_1px bt-0 p-3 br-0">
        <div class="input-group">
            <textarea name="<?php echo base64_encode('APP'); ?>" value="" class=" form-control" rows="2" style="padding-right:5px;"></textarea>
            <label class="float_right">{{ __('Plaintiff(s)') }}</label><br>
            <label>vs.</label>
        </div>
        <div class="input-group">
            <textarea name="<?php echo base64_encode('APD'); ?>" value="" class=" form-control" rows="2" style="padding-right:5px;"></textarea>
            <label class="float_right">{{ __('Defendant(s)') }}</label>
        </div>
    </div> 
    <div class="col-md-6 border_1px p-3 bt-0">

        <div class="row mt-1">
            <div class="col-md-4 text-bold ">
            <p class="text-bold">Adversary Proceeding No. <span class="text_italic"> {{ __('(if applicable):') }} </span> </p>
            </div>
            <div class="col-md-8 mt-1">
                <input name="<?php echo base64_encode('APNumber'); ?>"  placeholder="" type="text" value="" class="w-auto form-control ml-3">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 text-bold pt-2">
                <label class="underline">{{ __('Docket Control Number:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input name="<?php echo base64_encode('APDCN'); ?>"  placeholder="" type="text" value="" class="w-auto form-control ml-3">
            </div>
        </div>

        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Hearing Date:') }}"
                inputFieldName="APHearing"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Hearing Time:') }}"
                inputFieldName="APHearingTime"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Location:') }}"
                inputFieldName="APLocation"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-5 mt-1">
        <x-officialForm.debtorSignVertical
                labelContent="{{ __('Judge:') }}"
                inputFieldName="APJudge"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('CERTIFICATE OF SERVICE OF') }}</h3>
    </div>
    <div class="col-md-12 mt-1">
        <textarea name="<?php echo base64_encode("SummaryDocsServed"); ?>" class="form-control" rows="4"></textarea>
        <p class="p_justify text_italic text-c-red mt-2">
        {{ __('Please include a summary of the documents being served in the box under "CERTIFICATE OF SERVICE OF" above, e.g. "Motion for Relief from Stay and Supporting Documents."') }}
        </p>
    </div>
    <div class="col-md-12">
        <p> 
            {{ __('I, the undersigned, certify and declare:') }}
        </p>
        <div class="d-flex">
            <span class="pr-2">1.</span>
            <div class="w-100">
                <p>
                    <span class="text-bold underline">{{ __('Personal knowledge.') }} </span>
                    {{ __('I am over the age of 18 years and not a party to the above-entitled case.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <span class="pr-2 pt-2">2.</span>
            <div class="w-100">
                <p>
                    <span class="text-bold underline">{{ __('Status.') }} </span>
                    {{ __('I am') }} <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box1'); ?>" class=" form-control w-auto height_fit_content">
                    {{ __('an attorney of record in this case/adversary proceeding,') }} <span class="text-bold">{{ __('or') }} </span>
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box2'); ?>" class=" form-control w-auto height_fit_content">
                    {{ __('trustee, or') }} </span>
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box3'); ?>" class=" form-control w-auto height_fit_content">
                    {{ __('my business/employer is') }}
                    <input type="text"  name="<?php echo base64_encode('EmployerName'); ?>" class=" form-control width_30percent ">
                    {{ __('and my') }} 
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4'); ?>" class=" form-control w-auto height_fit_content">
                    {{ __('business address') }} <span class="text-bold">{{ __('or') }} </span>
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5'); ?>" class=" form-control w-auto height_fit_content">
                    {{ __('mailing address if not a business is:') }}
                    <input type="text"  name="<?php echo base64_encode('MailingAddressBus'); ?>" class=" form-control mt-1">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <span class="pr-2">3.</span>
            <div class="w-100">
                <p>
                    <span class="text-bold underline">{{ __('About the Case/Proceeding.') }}</span>
                    <span class="text_italic">{{ __('(Check at least one type of case/proceeding and as many subheadings thereunder as applicable.)') }}</span>
                </p>
            </div>
        </div>
        <div class="row border_1px p-3 ml-1">
            <div class="col-md-6">
                <div class="d-flex">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box6'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                            <span class="text-bold underline">{{ __('Chapter 7 case') }} </span>
                            <span class="text_italic"> {{ __('(Check at least one type of case/proceeding and as many subheadings thereunder as applicable.)') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                 <div class="d-flex">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box7'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                            <span class="text-bold underline">{{ __('Chapter 12 or 13 case') }} </span>
                            <span class="text_italic">{{ __('(indicate below if subject to limited noticing; check all that are applicable.)') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                 <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box8'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                        {{ __('Rule 2002(h) Limited Noticing. Fed. R. Bankr. P. 2002(h); LBR 2002-3.') }}
                            <span class="text_italic">{{ __('(Check all that are applicable.)') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box9'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="p_justify">
                            {{ __('Rule 2002(h) Limited Noticing. This case is subject to limited
                            noticing because at least 70 days have elapsed since the
                            order for relief. Fed. R. Bankr. P. 2002(h); LBR 2002-3.7.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="d-flex pl-5 ml-3">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box10'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="p_justify">
                            {{ __('One of the following applies: (1) This is a voluntary
                            asset case and at least 70 days have elapsed since
                            the order for relief; (2) This is an involuntary asset
                            case and at least 90 days have elapsed since the
                            order for relief; (3) This is a no asset case and at
                            least 90 days have elapsed since the mailing of the
                            notice of time for filing claims under Fed. R. Bankr. P.
                            3002(c)(5)') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box11'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="p_justify">
                            {{ __('Rule 3015(h) Limited Noticing (post-confirmation plan
                            modification only). This case is subject to limited noticing
                            because the debtor(s) has confirmed at least one plan and
                            the modified plan filed herewith neither lengthens the term
                            of, nor diminishes the dividend due general unsecured
                            creditors, from the most recently confirmed plan. Fed. R.
                            Bankr. P. 3015(h); LBR 3015-1(d)(3).') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex pl-5 ml-3">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box12'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="p_justify">
                        {{ __('This case is subject to an order limiting service. Fed.
                            R. Bankr. P. Rule 2002(m). The order limiting service is docketed at ECF no') }}.
                            <input type="text"  name="<?php echo base64_encode('CH7CaseNoEFC'); ?>" class=" form-control w-auto ">.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box13'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="p_justify">
                        {{ __('This case is subject to an order limiting service. Fed. R.
                            Bankr. P. 2002(m). The order limiting service is docketed at ECF no') }}
                            <input type="text"  name="<?php echo base64_encode('CH123CaseNoECF'); ?>" class=" form-control w-auto ">.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box14'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                            <span class="text-bold underline">{{ __('Chapter 9 case') }} </span>
                            <span class="text_italic">{{ __('(indicate below if subject to limited noticing)') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box16'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                            <span class="text-bold underline">{{ __('Chapter 11 case') }} </span>
                            <span class="text_italic">{{ __('(indicate below if subject to limited noticing)') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box15'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="p_justify">
                        {{ __('This case is subject to an order limiting service. Fed. R.
                            Bankr. P. 2002(m). The order limiting service is docketed
                            at ECF no') }}.
                            <input type="text"  name="<?php echo base64_encode('CH9CaseNoECF'); ?>" class=" form-control w-auto ">
                        </p>
                    </div>
                </div>
            </div> 
            
            <div class="col-md-6">
                <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box17'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="p_justify">
                            {{ __('This case is subject to limited noticing because one or more
                            creditors/equity holders committees have been appointed.
                            Fed. R. Bankr. P. 2002(i); LBR 2002-4') }}
                        </p>
                    </div>
                </div>
            </div> 
            <div class="col-md-6"></div>

            <div class="col-md-6">
                <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box18'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                        {{ __('This case is subject to an order limiting service. Fed. R.
                            Bankr. P. 2002(m). The order limiting service is docketed at
                            ECF no') }}.
                            <input type="text"  name="<?php echo base64_encode('CH11CaseNoECF'); ?>" class=" form-control w-auto ">
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box19'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                            <span class="text-bold underline">{{ __('Chapter 15 case') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box20'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p>
                            <span class="text-bold underline">{{ __('Adversary Proceeding') }}</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="d-flex">
                    <span class="pr-2">4.</span>
                    <div class="w-100">
                        <p class="text-bold underline">
                            {{ __('About the Documents Served') }}
                        </p>
                    </div>
                </div>
                <p>
                {{ __('On') }} <input type="text"  name="<?php echo base64_encode('Page2SvceDate'); ?>" class=" form-control w-auto">, 20
                    <input type="text"  name="<?php echo base64_encode('Page2SvceYr'); ?>" class=" form-control width_10percent ">,
                    {{ __('by the method(s) specified below, the following documents were served (list in space provided):') }}
                    <textarea name="<?php echo base64_encode("DocumentsServedTextBox"); ?>" class="form-control  mt-1" rows="4"></textarea>
                    <span class="text-bold underline">{{ __('OR') }}</span>
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box21'); ?>" class=" form-control w-auto height_fit_content">
                    {{ __('those documents described in the list appended hereto and numbered') }} <span class="text-bold text_italic">{{ __('Attachment 4.') }}</span>
                </p> 
                <div class="d-flex">
                    <span class="pr-2 text-bold">5.</span>
                    <div class="w-100">
                        <p class="text-bold underline">
                           {{ __('Who is Being Served') }}
                        </p>
                        <p>
                            {{ __('Unless otherwise indicated below, all indicated parties below have received all documents described in Section 4.') }}
                        </p>
                    </div>
                </div>
                <div class="row border_1px p-3 ml-1 mt-2">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box22'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('Debtor(s)') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box23'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('Debtor’s attorney(s)') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box24'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('Trustee') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box25'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('U.S. Trustee') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box26'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('Attorneys of record who have appeared in the Bankruptcy Case, the Adversary Proceeding, or contested matter.') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box27'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Plaintiff(s)') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box28'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Defendant(s)') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box29'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('All committee members') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box30'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Attorney for committee members') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box31'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('Equity security holders') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box32'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-2">
                                {{ __('Persons who have filed a Request for Notice') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box33'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('All creditors and parties in interest (Notice of Hearing only)') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box34'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                    {{ __('Only creditors that have filed claims (Notice of Hearing only)') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box35'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                   {{ __('All creditors and parties in interest') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box36'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                   Fewer than all creditors 
                                   <span class="text_italic">
                                       {{ __('(check at least one below)') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-4">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box37'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Creditors that have filed claims') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-4">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box38'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Creditors holding allowed secured claims') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-4">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box39'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Creditors holding allowed priority unsecured claims') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-4">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box40'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Creditors holding leases or executory contracts that have been assumed') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-4">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box41'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('20 largest creditors') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box42'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p>
                                {{ __('Administrative claimants') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box43'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-2">
                                  {{ __('Other party(ies) in interest') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="d-flex text-bold">
                    <span class="pr-2">6.</span>
                    <div class="w-100">
                        <p class="underline">
                        {{ __('How Service is Accomplished') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex pl-4">
                    <span class="pr-2">A.</span>
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box44'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="text-bold">
                            Rule 7004 Service.
                            <span class="text_italic">{{ __('(Check at least one, if applicable.)') }}</span>
                        </p>
                    </div>
                </div>
                <div class="pl-4">
                    <div class="d-flex pl-4">
                        <span class="pr-2">1.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box45'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p class="text-bold">
                                 {{ __('First Class Mail') }}
                            </p>
                            <p>
                            {{ __('Service was effected on those persons listed on the attachment by placing a true and correct copy of the
                                document(s) served in a sealed envelope, first class mail, postage prepaid in the United States Postal Service
                                (or in a place designated by the law firm or trustee for outgoing mail prior to the last regular pick up of outgoing
                                mailing for the day) for each of the persons listed below. Fed. R. Bankr. P. 7004(b); 7004(g). A list of the
                                persons served, including their name/capacity to receive service, and address is appended hereto and
                                numbered') }} <span class="text-bold text_italic"> {{ __('Attachment 6A1') }}</span>.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex pl-4">
                        <span class="pr-2">2.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box46'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p class="text-bold">
                            {{ __('Certified Mail') }}
                            </p>
                            <p>
                            {{ __('Service was effected on those persons listed on the attachment by placing a true and correct copy of the
                                document(s) served in a sealed envelope, certified mail, postage prepaid in the United States Postal Service (or
                                in a place designated by the law firm or trustee for outgoing mail prior to the last regular pick up of outgoing
                                mailing for the day) for each of the persons indicated below. Fed. R. Bankr. P. 7004(h). A list of the persons
                                served, including their name/capacity to receive service, and address is appended hereto and numbered') }}
                                <span class="text-bold text_italic"> {{ __('Attachment 6A2') }}</span>.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex pl-4">
                        <span class="pr-2">3.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box47'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p class="text-bold underline">
                                {{ __('Publication') }}
                            </p>
                            <p>
                            {{ __('Service was effected by publication as ordered by the court and docketed at ECF no') }}.
                                <input type="text"  name="<?php echo base64_encode('PublicationDocNo'); ?>" class=" form-control w-auto">. {{ __('Fed. R. Bankr. P.
                                7004(c). Attestation(s) as to the manner and form of such publication is appended hereto and numbered') }}
                                <span class="text-bold text_italic"> {{ __('Attachment 6A3') }}</span>.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="d-flex pl-5">
                    <span class="pr-2">B.</span>
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box48'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="text-bold ">
                        {{ __('Rule 5 and Rules 7005, 9036 Service') }}
                           <span class="text_italic">{{ __('(Check at least one, if applicable.)') }}</span>.
                        </p>
                    </div>
                </div>
                <div class="pl-4">
                    <div class="d-flex pl-5">
                        <span class="pr-2">1.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box49'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p class="text-bold">
                                {{ __('Electronic Service on Registered Users of the Court’s Electronic Filing System.') }}
                            </p>
                            <p>
                            {{ __('Service on those parties in interest, listed below, will be effected by filing those documents, listed above, with
                                the Clerk of the Court. Fed. R. Bankr. P. 9036, 7005; Fed. R. Civ. P. 5(b). Electronic service on registered users
                                of the electronic filing system is not permitted for pleadings or papers that must be served in accordance with
                                Fed. R. Bankr. P. 7004. A copy of the Clerk’s Electronic Service Matrix applicable to this case and/or adversary
                                proceeding is appended hereto and numbered') }}  
                                <span class="text-bold text_italic">{{ __('Attachment 6B1') }}</span>.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex pl-5">
                        <span class="pr-2">2.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box50'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p class="text-bold">
                               {{ __('U.S. Mail') }}
                            </p>
                            <p>
                                {{ __('Service on those parties, listed below, was effected by placing a true and correct copy of the document(s)
                                served in a sealed envelope, first class mail, postage prepaid in the United States Postal Service (or in a place
                                designated by the law firm or trustee for outgoing mail prior to the last regular pick up of outgoing mailing for the
                                day) for each of the persons indicated below. Fed. R. Civ. P. 5(b)(2)(c); Fed. R. Bankr. P. 9014.') }}
                            </p>
                        </div>
                    </div>


                <div class="pl-5">
                    <div class="d-flex pl-5 ml-3">
                        <span class="pr-2">a.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box51'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p class="text-bold">
                               {{ __('Parties in interes') }}
                            </p>
                            <p>
                                <span class="text-bold">{{ __('Clerk’s Matrix of Creditors.') }}</span> {{ __('A copy of the matrix of creditors maintained by the Clerk of the Court as
                                applicable to this case and/or adversary proceeding is appended hereto and numbered') }} 
                                <span class="text-bold text_italic">  {{ __('Attachment 6B2.') }}</span>
                                 {{ __('Such list shall be downloaded not more than seven days prior to the date of filing of the pleadings
                                and other documents and shall reflect the date of downloading. WARNING: If “raw data format” of the
                                Clerk’s Matrix of Creditors is Attachment 6B2, the signer of the Certificate of Service hereby swears
                                that no changes to the matrix have been made except (1) formatting; and/or (2) “X” ing out of person
                                not served. Such list shall be downloaded not more than seven days prior to the date of filing of the
                                pleadings and other documents and shall reflect the date of downloading.') }}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex pl-5 ml-3">
                        <span class="pr-2 pl-2"></span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box52'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p>
                            <span class="text-bold">{{ __('List Other Than the Clerk’s Matrix of Creditors.') }}</span> {{ __('Where service by U.S. Mail is effected on six or
                                fewer parties in interest, parties may (but need not) use a service list. A copy of the custom service list
                                is appended hereto and numbered') }}  <span class="text-bold text_italic">  {{ __('Attachment 6B2.') }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex pl-5 ml-3">
                        <span class="pr-2">b.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box53'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p>
                                <span class="text-bold">{{ __('Request for Special Notice List.') }}</span> 
                                {{ __('A copy of the Clerk of the Court’s matrix of creditors who have filed
                                a Request for Special Notice is appended hereto and numbered') }}  
                                <span class="text-bold text_italic">{{ __('Attachment 6B3') }}</span>   
                            </p>
                        </div>
                    </div>
                    <div class="d-flex pl-5 ml-3">
                        <span class="pr-2">c.</span>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box54'); ?>" class=" form-control w-auto height_fit_content">
                        <div class="w-100">
                            <p>
                                <span class="text-bold">{{ __('Other Parties in Interest Checked in Section 5.') }}</span> 
                                {{ __('A list of the named and addresses of other parties
                                in interest served (if checked in section 5 above) is appended hereto and numbered') }}      
                                <span class="text-bold text_italic">{{ __('Attachment 6B4.') }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                </div>
                <div class="d-flex pl-5">
                    <span class="pr-2 pl-5">3.</span>
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box55'); ?>" class=" form-control w-auto height_fit_content">
                    <div class="w-100">
                        <p class="text-bold">
                            {{ __('U.S. Mail') }}
                        </p>
                        <p>
                            {{ __('Service on those parties, listed below, was effected by placing a true and correct copy of the document(s)
                            served in a sealed envelope, first class mail, postage prepaid in the United States Postal Service (or in a place
                            designated by the law firm or trustee for outgoing mail prior to the last regular pick up of outgoing mailing for the
                            day) for each of the persons indicated below. Fed. R. Civ. P. 5(b)(2)(c); Fed. R. Bankr. P. 9014.') }}
                        </p>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="d-flex text-bold">
                        <span class="pr-2">7.</span>
                        <div class="w-100">
                            <p class="underline">
                            {{ __('Who Accomplished Service') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col-md-6">
                        <div class=" pl-4">
                            <div class="d-flex">
                                <span class="pl-2 pr-2">{{ __('A.') }}</span>
                                <div class="w-100">
                                    <p class="text-bold mb-1">
                                    {{ __('Attorney/Trustee') }}
                                    <span class="text_italic">{{ __('(Check as many as apply)') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="pl-4">
                        <div class="text-bold pl-5">
                            <span class="pr-2 ">{{ __('Rule 7004 Service') }} </span>
                        </div>
                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box56'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                                {{ __('§ 6A(1): First Class Mail') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box57'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                                {{ __('§ 6A(2): Certified Mail') }} 
                                </p>
                            </div>
                        </div>

                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box58'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                                {{ __('§ 6A(3): Publication') }} 
                                </p>
                            </div>
                        </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                      <div class=" pl-4">
                        <div class="text-bold pl-5">
                            <span class="pr-2">{{ __('Rule 5 Service') }}</span>
                        </div>
                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box59'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                                {{ __('§ 6B(1): Elec. Service on Registered e-Filers') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box60'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                                {{ __('§ 6B(2)(a): U.S. Mail') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box61'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                                {{ __('§ 6B(2)(b): Request for Special Notice') }}
                                </p>
                            </div>
                        </div>

                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box62'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                               {{ __('§ 6B(2)(c): Other Parties in Interest § 5') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex pl-5">
                            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box63'); ?>" class=" form-control w-auto height_fit_content">
                            <div class="w-100">
                                <p class="mb-1">
                                {{ __('§ 6B(3): Other Methods of Service') }}
                                </p>
                            </div>
                        </div>
                      </div>
                </div>
                </div>

                   <div class="row w-100 mt-2">
                        <div class="col-md-6">
                    <div class="pl-4">
                           <div class="d-flex">
                               <span class="pl-2 pr-2">{{ __('B.') }}</span>
                                <div class="w-100">
                                    <p class="text-bold mb-1">
                                    Third Party Service Provider 
                                    <span class="text_italic">{{ __('(Check as many as apply)') }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-bold">
                                <span class="pr-2 pl-5">{{ __('Rule 7004 Service') }} </span>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box64'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6A(1): First Class Mail') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box65'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6A(2): Certified Mail') }} 
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box66'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6A(3): Publication') }} 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                       <div class="pl-4">
                            <div class="text-bold mt-2">
                                <span class="pr-2 pl-5">{{ __('Rule 5 Service') }}</span>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box67'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6B(1): Elec. Service on Registered e-Filers') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box68'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6B(2)(a): U.S. Mail') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box69'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6B(2)(b): Request for Special Notice') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box70'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6B(2)(c): Other Parties in Interest § 5') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex pl-5">
                                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box71'); ?>" class=" form-control w-auto height_fit_content">
                                <div class="w-100">
                                    <p class="mb-1">
                                    {{ __('§ 6B(3): Other Methods of Service') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                   </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <p class="text-bold">{{ __('Attorney/Trustee') }} <span class="text_italic">{{ __('(includes regularly employed staff members):') }}</span></p>
                <p>
                  {{ __('I swear under penalty of perjury that: (1) the representations in Sections 1-5 hereof are true and correct; and (2) I served those parties
                  in interest marked in Section 7A in the manner set forth in the referenced portion of Section 6') }}
                </p>
                <div class="row">
                     <div class="col-md-6">
                        <p>
                        {{ __('Executed on') }}  <input type="text"  name="<?php echo base64_encode('Page3Date'); ?>" class=" form-control w-auto">, 20 
                            <input type="text"  name="<?php echo base64_encode('Page3DateYear'); ?>" class=" form-control width_10percent ">{{ __(', at') }} 
                        </p>
                     </div>
                     <div class="col-md-3">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('City') }}"
                            inputFieldName="Page3City"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                     </div>
                     <div class="col-md-3">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('State') }}"
                            inputFieldName="Page3State"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                     </div>
                     <div class="col-md-6">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('Print Name') }}"
                            inputFieldName="Page3NameField"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                     </div>
                     <div class="col-md-6">
                       <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('Signature') }}"
                            inputFieldName="Page3SignatureField"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                     </div>
                </div>
                
            </div>
            <div class="col-md-12 mt-3">
                <p><span class="text-bold">{{ __('Third Party Service Provider') }}</span> {{ __('(if applicable)') }}</p>
                <p>
                    {{ __('I am over the age of 18 years and not a party to the above-entitled case.
                    I swear under penalty of perjury that I served those parties in
                    interest marked in Section 7B in the manner set forth in the referenced portion of Section 6.') }}
                </p>
                <div class="row">
                     <div class="col-md-6">
                        <p>
                        {{ __('Executed on') }}  <input type="text"  name="<?php echo base64_encode('3rdPtyDate'); ?>" class=" form-control w-auto">, 20 
                            <input type="text"  name="<?php echo base64_encode('3rdPtyYear'); ?>" class=" form-control width_10percent ">{{ __(', at') }} 
                        </p>
                     </div>
                     <div class="col-md-3">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('City') }}"
                            inputFieldName="3rdPtyCity"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                     </div>
                     <div class="col-md-3">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('State') }}"
                            inputFieldName="3rdPtyState"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                     </div>
                     <div class="col-md-6 mt-1">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('Name') }} "
                            inputFieldName="3rdPtyNameField"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                        <div class=" mt-1">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('Company Name') }}"
                            inputFieldName="3rdPtyCompanyNameField"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                        </div>
                        <div class=" mt-1">
                        <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('Address') }}"
                            inputFieldName="3rdPtyCompanyAddress"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                        <div class="row">
                            <div class="col-md-4">
                            <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('City') }} "
                            inputFieldName="3rdPtyBusAddCity"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                            </div>
                            <div class="col-md-4">
                            <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('State') }}"
                            inputFieldName="3rdPtyBusAddState"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                            </div>
                            <div class="col-md-4">
                            <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('Zip Code') }}"
                            inputFieldName="3rdPtyZip"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                            </div>
                        </div>
                        </div>
                     </div>
                     <div class="col-md-6 mt-1">
                       <x-officialForm.debtorSignVerticalOpp
                            labelContent="{{ __('Signature') }}"
                            inputFieldName="3rdPtySignatureField"
                            inputValue="">
                        </x-officialForm.debtorSignVerticalOpp>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>