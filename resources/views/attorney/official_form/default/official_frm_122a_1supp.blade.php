<form name="official_frm_122a─1supp" class="save_official_forms" id="official_frm_122a_1supp" action="{{route('generate_official_pdf')}}"
    method="post">
    @csrf
    <input type="hidden" name="form_id" value="122a_1supp">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b122a_1supp.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b122a_1supp.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('Case number1-122a-1supp'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('Name-122a-1supp'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('Name2-122a-1supp'); ?>" value="<?php echo $spousename; ?>">
    <section class="page-section official-form-122a─1supp padd-20" id="official-form-122a─1supp">
        <div class="container pl-2 pr-0">
            <div class="row">
                <div class="frm122a_1supp col-md-7">
                    <div class="frm122a_1supp section-box">
                        <div class="frm122a_1supp section-header bg-back text-white">
                            <p class="frm122a_1supp font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                        </div>

                        <div class="frm122a_1supp section-body padd-20">
                            <div class="row">
                                <div class="frm122a_1supp col-md-12">
                                    <div class="input-group">
                                        <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                        <select
                                            name="<?php echo base64_encode('Bankruptcy District Information-122a-1supp'); ?>"
                                            class="form-control frm122a_1supp district-select" id="district_name">
                                            @foreach ($district_names as $district_name)
                                            <option
                                                <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?>
                                                value="{{$district_name->district_name}}" class="form-control">
                                                {{$district_name->district_name}}</option> @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="frm122a_1supp col-md-5">
                    <div class="frm122a_1supp amended">
                        <input type="checkbox" name="<?php echo base64_encode('CheckBox1-122a-1supp');?>">
                        <label>{{ __('Check if this is an amended filing') }}</label>
                    </div>
                </div>
            </div>

            <div class="row padd-20 frm122a_1supp">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Means Test – Exemption') }}</h4>
                        <!-- <h4>{{ __('Official Form 122A─1Supp') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Statement of Exemption from Presumption of Abuse
                            Under §
                            707(b)(2)') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <div class="input-group"> <strong>
                                {{ __('File this supplement together with Chapter 7 Statement of Your
                                Current
                                Monthly Income (Official Form 122A-1), if you believe that you are
                                exempted from a presumption of abuse. Be as complete and accurate as
                                possible. If two married people are filing together, and any of the
                                exclusions in this statement applies to only one of you, the other
                                person should complete a separate Form 122A-1 if you believe that
                                this
                                is
                                required by 11 U.S.C. § 707(b)(2)(C).') }}
                            </strong> </div>
                    </div>
                </div>
            </div>
            <!-- Part 1 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                        <h2 class="font-lg-18">{{ __('Identify the Kind of Debts You Have') }}</h2>
                    </div>
                </div>
            </div>
            <!-- Row 1 -->
            <div class="form-border mb-3">
                <label for=""> <strong>{{ __('1. Are your debts primarily consumer debts?') }}</strong> {{ __('Consumer debts are defined
                    in 11 U.S.C. § 101(8) as “incurred by an individual primarily for a personal, family, or household
                    purpose.” Make sure that your answer is consistent with the answer you gave at line 16 of the
                    Voluntary Petition for Individuals Filing for Bankruptcy (Official Form 101).') }} </label>
                <div class="input-group">
                    <input class="fi_line1_non_consumer_debt" name="<?php echo  base64_encode('CheckBox2-122a-1supp')?>"
                        value="no" type="radio">
                    <label for="">{{ __('No. Go to Form 122A-1; on the top of page 1 of that form, check box 1, There is no
                        presumption of abuse, and sign Part 3. Then submit this supplement with the signed Form
                        122A-1.') }}</label>
                </div>
                <div class="input-group">
                    <input class="fi_line1_non_consumer_debt" name="<?php echo  base64_encode('CheckBox2-122a-1supp')?>"
                        value="Yes" type="radio">
                    <label for="">{{ __('Yes. Go to Part 2.') }} </label>
                </div>
            </div>
            <!-- Part 2 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                        <h2 class="font-lg-18">{{ __('Determine Whether Military Service Provisions Apply
                            to
                            You') }}</h2>
                    </div>
                </div>
            </div>
            <!-- Row 1 -->
            <div class="form-border mb-3">
                <!-- Row 2 -->
                <div class="row">
                    <div class="col-md-12">
                        <label for=""> <strong>{{ __('2. Are you a disabled veteran (as defined in 38 U.S.C. §
                                3741(1))?') }}
                            </strong> </label>
                        <div class="input-group">
                            <input class="fi_line2_disable_veteran"
                                name="<?php echo base64_encode('CheckBox3-122a-1supp')?>" value="no" type="radio">
                            <label for="">{{ __('No. Go to line 3.') }}</label>
                        </div>
                        <div class="input-group">
                            <input class="fi_line2_disable_veteran"
                                name="<?php echo  base64_encode('CheckBox3-122a-1supp')?>" value="Yes" type="radio">
                            <label for="">{{ __('Yes. Did you incur debts mostly while you were on active duty or while you
                                were performing a homeland defense activity? 10 U.S.C. § 101(d)(1); 32 U.S.C. § 901(1).') }}
                            </label>
                        </div>
                        <div class="pl-3">
                            <div class="input-group">
                                <input name="<?php echo  base64_encode('CheckBox4-122a-1supp')?>" value="no"
                                    type="radio">
                                <label for="">{{ __('No. Go to line 3') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo  base64_encode('CheckBox4-122a-1supp')?>" value="Yes"
                                    type="radio">
                                <label for="">{{ __('Yes. Go to Form 122A-1; on the top of page 1 of that form, check box 1,
                                    There is no presumption of abuse, and sign Part 3. Then submit this supplement with
                                    the signed Form 122A-1') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 3 -->
                <div class="row">
                    <div class="col-md-12">
                        <label for=""> <strong>{{ __('3. Are you or have you been a Reservist or member of the
                                National
                                Guard?') }}
                            </strong> </label>
                        <div class="input-group">
                            <input name="<?php echo  base64_encode('CheckBox5-122a-1supp')?>" value="no" type="radio">
                            <label for="">{{ __('No. Complete Form 122A-1. Do not submit this supplement.') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo  base64_encode('CheckBox5-122a-1supp')?>" value="Yes" type="radio">
                            <label for="">{{ __('Yes. Were you called to active duty or did you perform a homeland defense
                                activity? 10 U.S.C. § 101(d)(1); 32 U.S.C. § 901(1)') }} </label>
                        </div>
                        <div class="pl-3">
                            <div class="input-group">
                                <input name="<?php echo  base64_encode('CheckBox6-122a-1supp')?>" value="no"
                                    type="radio">
                                <label for="">{{ __('No. Complete Form 122A-1. Do not submit this supplement') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo  base64_encode('CheckBox6-122a-1supp')?>" value="Yes"
                                    type="radio">
                                <label for="">{{ __('Yes. Check any one of the following categories that applies:') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pl-3">
                                <div class="input-group">
                                    <input name="<?php echo  base64_encode('CheckBox7-122a-1supp')?>" value="1"
                                        type="radio">
                                    <label for=""><strong>{{ __('I was called to active duty after
                                            September
                                            11, 2001,') }}</strong> {{ __('for at least 90 days and remain on active duty.') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo  base64_encode('CheckBox7-122a-1supp')?>" value="2"
                                        type="radio">
                                    <label for=""><strong>I was called to active duty after
                                            September
                                            11, 2001,</strong>{{ __(', for at least 90 days and was released from active duty
                                        on') }}</label>
                                    <input name="<?php echo  base64_encode('Date1-122a-1supp')?>" type="text" value=""
                                        class="form-control">
                                    <label for="">{{ __('which is fewer than 540 days before I file this bankruptcy
                                        case.') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo  base64_encode('CheckBox7-122a-1supp')?>" value="3"
                                        type="radio">
                                    <label for=""><strong>{{ __('I am performing a homeland defense
                                            activity
                                            for at least 90 days') }}</strong></label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo  base64_encode('CheckBox7-122a-1supp')?>" value="4"
                                        type="radio">
                                    <label for=""><strong>{{ __('I performed a homeland defense activity
                                            for at
                                            least 90 days') }}</strong>{{ __(',ending on') }}</label>
                                    <input name="<?php echo  base64_encode('Date2-122a-1supp')?>" type="text" value=""
                                        class="form-control">
                                    <label for="">{{ __('which is fewer than 540 days before I file this bankruptcy
                                        case.') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="column-heading">
                                <p>{{ __('If you checked one of the categories to the left, go to Form 122A-1. On the top of
                                    page 1 of Form 122A-1, check box 3, The Means Test does not apply now, and sign Part
                                    3. Then submit this supplement with the signed Form 122A-1. You are not required to
                                    fill out the rest of Official Form 122A-1 during the exclusion period. The exclusion
                                    period means the time you are on active duty or are performing a homeland defense
                                    activity, and for 540 days afterward. 11 U.S.C. § 707(b)(2)(D)(ii). If your
                                    exclusion period ends before your case is closed, you may have to file an amended
                                    form later') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center" style="margin-left:1px;">
                <x-officialForm.generatePdfButtonlocal title="Generate Means Test – Exemption (122A-1 SUPP) PDF" divtitle="official_frm_122a_1supp">
                </x-officialForm.generatePdfButtonlocal>
            </div>
        </div>
    </section>
</form>