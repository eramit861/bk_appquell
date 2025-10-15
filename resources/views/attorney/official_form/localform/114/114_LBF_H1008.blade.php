<div class="row">


    <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor;?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename;?>">
    <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : '';?>">
    <div class="row padd-20">
        <div class=" col-md-6">
            <div class=" section-box">
                <div class=" section-header bg-back text-white">
                    <p class=" font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                </div>
                <div class="section-body padd-20">
                    <div class="row">
                        <div class=" col-md-12">
                            <label>{{ __('District Of') }}</label>
                            <div class=" input-group">
                                <select class="form-control district-select" id="district_name" name="<?php echo base64_encode('Bankruptcy District Information')?>"> @foreach ($district_names as $district_name)
                                    <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-md-6"></div>
        <div class=" col-md-12 mb-3 mt-3">
            <h4>{{ __('Local Form H1008 (8/22)') }}</h4>
            <div class=" form-title">
                <h2 class="font-lg-22">{{ __('Declaration re: Electronic Filing') }}</h2>
            </div>
        </div>
        <div class=" col-md-12">
            <div class="form-subheading">
                <p class=" p_justify">
                    <span class="text-bold">{{ __('Important!') }}</span> This form is required when certain documents are filed electronically by your attorney. Signing this
                    form means that you are declaring, under penalty of perjury, that the information in the documents checked
                    below is true and correct. <span class="underline">{{ __('Do not sign this declaration unless you have read the documents and they are
                    complete and accurate.') }}</span> {{ __('You or your attorney must mail or deliver this declaration to the court within 7 days
                    after the documents are filed or the court may dismiss your case and/or sanction your attorney. You must also
                    sign the original documents that must be retained by your attorney. This declaration concerns the following:') }}
                </p>

                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box1');?>" value="Yes" class="form-control w-auto">
                            {{ __('Petition') }}
                        </p>
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box2');?>" value="Yes" class="form-control w-auto">
                            {{ __('Verification of Creditor Lists') }}
                        </p>
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class="form-control w-auto">
                            Schedules A-J or 
                            <input type="text" name="<?php echo base64_encode('Schedules AJ or');?>" class="form-control w-auto"> 
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control w-auto">
                            {{ __('Authorization for Non-Individual Entity to File Petition') }}
                        </p>
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box8');?>" value="Yes" class="form-control w-auto">
                            {{ __('List of 20 Largest Unsecured Creditors') }}
                        </p>
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box9');?>" value="Yes" class="form-control w-auto">
                            {{ __('Chapter 13 Plan') }}
                        </p>
                    </div>

                    <div class="col-md-12">
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class="form-control w-auto">
                            {{ __('Statement of Financial Affairs') }}
                        </p>
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class="form-control w-auto">
                            {{ __('Statement of Current Monthly Income/Means Test Calculation/Disposable Income Calculation (Form 122s)') }}
                        </p>
                    </div>

                    <div class="col-md-2">
                        <p>
                            <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="form-control w-auto">
                            {{ __('Other:') }}
                        </p>
                    </div>
                    <div class="col-md-10">
                        <textarea name="<?php echo base64_encode('Text2');?>" id="" class=" form-control " rows="2"></textarea>
                    </div>
                </div>

                <p class="text_italic">
                    {{ __('(See reverse side if this is an involuntary or chapter 15 case)') }}
                </p>
                <p class=" p_justify">
                    <span class="pl-4"></span>
                    <span class="text-bold">{{ __('Declaration by Individual(s).') }}</span> <span class="text-bold">I declare under penalty of perjury</span> {{ __('that the information provided in the
                    document(s) identified above is true and correct to the best of my knowledge, information, and belief. If the
                    document is a petition and my debts are primarily consumer debts and I have chosen to file under chapter 7, I
                    am aware that I may proceed under chapter 7, 11, 12 or 13 of title 11, United States Code, understand the
                    relief available under each chapter, and choose to proceed under chapter 7. I request relief in accordance with
                    the chapter of title 11, United States Code, specified in my electronically filed petition. If this filing includes a
                    chapter 13 plan, I certify that the plan has been proposed in good faith, that the information provided in the
                    plan is true and correct, and that I will be able to make all plan payments and otherwise comply with provisions
                    of the plan. I declare under penalty of perjury that the Social Security Number or Individual Taxpayer
                    Identification Number transmitted with my petition is true and correct.') }}
                </p>
                <p class=" p_justify">
                    <span class="pl-4"></span>
                    <span class="text-bold">{{ __('Declaration by Non-Individual Debtor (Corporation/LLC). I') }} </span> <span class="text-bold">I declare under penalty of perjury</span> {{ __('hat the
                    information provided in the document(s) noted above is true and correct to the best of my knowledge,
                    information, and belief, and that I have been authorized to file the petition on behalf of the debtor. I request
                    relief in accordance with the chapter of title 11, United States Code, specified in the electronically filed petition.
                    [When signing below, indicate position or relationship to Debtor.]') }}
                </p>
                <p class="text_italic">
                    {{ __('Sign and submit on paper to court. Registered ECF Users may scan the signed declaration and file online.') }}
                </p>
                <p class="">
                    {{ __('Signature(s) of Debtor(s) or Authorized Individual:') }}
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor 1"
                inputFieldName=""
                inputValue={{$debtor_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
            <div class="mt-2">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>
        <div class="col-md-6">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor 2"
                inputFieldName=""
                inputValue={{$debtor2_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
            <div class="mt-2">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date_2"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>

        <div class="col-md-12 text-center mt-3">
            <h3 class="">{{ __('DECLARATION re: ELECTRONIC FILING') }}<br>{{ __('of Petition and Related Documents') }}</h3>
            <p class="text_italic">
                {{ __('(Sign this side if this concerns an involuntary petition or chapter 15 case)') }}
            </p>
        </div>

        <div class="col-md-12">
            <p class=" p_justify">
                <span class="pl-4"></span>
                <span class="text-bold">{{ __('Involuntary Petition - Declaration of Petitioning Creditor(s).') }}</span> {{ __('I declare under penalty of perjury that
                the information in the electronically filed involuntary petition is true and correct according to the best of my
                knowledge, information, and belief. The undersigned requests that an order for relief be entered against the
                debtor under the chapter of title 11, United States Code, specified in the petition.') }}
            </p>
            <p class=" p_justify">
                <span class="pl-4"></span>
                <span class="text-bold">{{ __('Declaration of Foreign Representative.') }} </span> {{ __('I declare under penalty of perjury that the information
                provided in the electronically filed petition is true and correct to the best of my knowledge, information, and
                belief, that I am the foreign representative of a debtor in a foreign proceeding, and that I am authorized to file
                the petition. I request relief in accordance with chapter 15, United States Code, or with the chapter of title 11
                specified in the petition.') }}
            </p>
            <p class=" ">
                {{ __('Sign and print name and title') }}
            </p>
        </div>

        <div class="col-md-4">
            <input type="text" name="<?php echo base64_encode('');?>" class="form-control bg-none" disabled>
            <input type="text" name="<?php echo base64_encode('Date_3');?>" class="form-control mt-1 mb-1">
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="Date_3"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-4">
            <input type="text" name="<?php echo base64_encode('');?>" class="form-control bg-none" disabled>
            <input type="text" name="<?php echo base64_encode('2_2');?>" class="form-control mt-1 mb-1">
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="Date_4"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-4">
            <input type="text" name="<?php echo base64_encode('');?>" class="form-control bg-none" disabled>
            <input type="text" name="<?php echo base64_encode('2_3');?>" class="form-control mt-1 mb-1">
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="Date_5"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>

    </div>
    

</div>
