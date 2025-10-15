<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="section-box">
                <div class="section-header bg-back text-white">
                    <p class="font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                </div>
                <div class="section-body padd-20">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <label>{{ __('United States Bankruptcy Court') }}<br>{{ __('Western District of Wisconsin') }}</label>
                            <div class="row mt-2">
                                <div class="col-md-5 pt-2">
                                    <label>{{ __('Case Number (If known):') }} </label>
                                </div>
                                <div class="col-md-7">
                                    <input name="<?php echo base64_encode('Case number If known'); ?>" placeholder="" type="text" value="{{$caseno}}" class="w-auto form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 padd-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-title mb-3">
                        <h4>{{ __('WIWB Official Form 121') }}</h4>
                        <!-- <h4>{{ __('Official Form 121') }}</h4> -->
                        <div>
                            <label class="float_right pt-2">{{ __('Revised 2/18') }}</label>
                            <h2 class="font-lg-22">{{ __('Statement About Your Social Security Numbers') }}</h2> 
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14">{{ __('Use this form to tell the court about any Social Security or federal Individual Taxpayer Identification numbers you have used. Do not file this
                        form as part of the public case file. This form must be submitted separately and must not be included in the court’s public electronic records.
                        Please consult local court procedures for submission requirements.') }}</p>
                        <p class="font-lg-14">{{ __('To protect your privacy, the court will not make this form available to the public. You should not include a full Social Security Number or
                        Individual Taxpayer Number on any other document filed with the court. The court will make only the last four digits of your numbers known
                        to the public. However, the full numbers will be available to your creditors, the U.S. Trustee or bankruptcy administrator, and the trustee
                        assigned to your case.') }}</p>
                        <p class="font-lg-14 mb-0">{{ __('Making a false statement, concealing property, or obtaining money or property by fraud in connection with a bankruptcy case can result in
                        fines up to $250,000, or imprisonment for up to 20 years, or both. 18 U.S.C. §§ 152, 1341, 1519, and 3571.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row align-items-center mb-3">

                <div class="col-md-12">
                    <div class="part-form-title mb-3"> 
                        <span>{{ __('Part 1:') }}</span>
                        <h2 class="font-lg-18">{{ __('Tell the Court About Yourself and Your spouse if Your Spouse is Filing With You') }}</h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <p class="p-2 mb-0 gray-box ">
                                {{ __('For Debtor 1:') }} 
                            </p>
                        </div>
                        <div class="col-md-5">
                            <p class="p-2 mb-0 gray-box ">
                                {{ __('For Debtor 2 (Only If Spouse Is Filing):') }} 
                            </p>
                        </div>

                        <div class="col-md-2 mt-2">
                            <p class="p-2 mb-0 text-bold">
                                {{ __('1. Your name') }}
                            </p>
                        </div>
                        <div class="col-md-5 mt-2">
                            <input type="text" name="<?php echo base64_encode('Debtor 1 First name');?>" value="{{$debtorFirstName}}" class="form-control">
                            <label for="">{{ __('First name') }}</label>
                            <input type="text" name="<?php echo base64_encode('Debtor 1 Middle name');?>" value="{{$debtorMiddleName}}" class="form-control mt-1">
                            <label for="">{{ __('Middle name') }}</label>
                            <input type="text" name="<?php echo base64_encode('Debtor 1 Last name');?>" value="{{$debtorLastName}}" class="form-control mt-1">
                            <label for="">{{ __('Last name') }}</label>
                        </div>
                        <div class="col-md-5 mt-2">
                            <input type="text" name="<?php echo base64_encode('Debtor 2 First Name');?>" value="{{$spouseFirstName}}" class="form-control">
                            <label for="">{{ __('First name') }}</label>
                            <input type="text" name="<?php echo base64_encode('Debtor 2 Middle Name');?>" value="{{$spouseMiddleName}}" class="form-control mt-1">
                            <label for="">{{ __('Middle name') }}</label>
                            <input type="text" name="<?php echo base64_encode('Debtor 2 Last Name');?>" value="{{$spouseLastName}}" class="form-control mt-1">
                            <label for="">{{ __('Last name') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mt-3">

                <div class="col-md-12">
                    <div class="part-form-title mb-3"> 
                        <span>{{ __('Part 2:') }}</span>
                        <h2 class="font-lg-18">{{ __('Tell the Court About all of Your Social Security or Federal Individual Taxpayer Identification Numbers') }}</h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-2 mt-2">
                            <p class="p-2 mb-0 text-bold">
                                {{ __('2. All Social Security and all federal Individual Taxpayer Identification Numbers (ITIN) you have used') }}
                            </p>
                        </div>
                        <?php
                            $ditin = '';
                                    $dssn = '';
                                    $dssnArray[] = "";
                                    $ditinArray[] = "";
                                    if (Helper::validate_key_value('has_security_number', $BasicInfoPartA) == 1) {
                                        $ditin = Helper::validate_key_value('itin', $BasicInfoPartA);
                                        if (preg_match('/-/', $ditin) != 1) {
                                            $ditinArray[0] = substr($ditin, 0, 3);
                                            $ditinArray[1] = substr($ditin, 3, 2);
                                            $ditinArray[2] = substr($ditin, 5, 4);
                                        } else {
                                            $ditinArray = explode('-', $ditin);
                                        }
                                    }
                                    if (Helper::validate_key_value('has_security_number', $BasicInfoPartA) != 1) {
                                        $dssn = Helper::validate_key_value('security_number', $BasicInfoPartA);
                                        if (preg_match('/-/', $dssn) != 1) {
                                            $dssnArray[0] = substr($dssn, 0, 3);
                                            $dssnArray[1] = substr($dssn, 3, 2);
                                            $dssnArray[2] = substr($dssn, 5, 4);
                                        } else {
                                            $dssnArray = explode('-', $dssn);
                                        }
                                    }

                                    $ssnCheck1 = "";
                                    if (empty($dssn)) {
                                        $ssnCheck1 = "checked";
                                    }
                                    $ditinCheck1 = "";
                                    if (empty($ditin)) {
                                        $ditinCheck1 = "checked";
                                    }

                                    ?>
                        <div class="col-md-5 mt-2">
                            <p>
                                <input type="text" name="<?php echo base64_encode('SSN1A');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($dssnArray[0]) ? $dssnArray[0] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('SSN1B');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($dssnArray[1]) ? $dssnArray[1] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('SSN1C');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($dssnArray[2]) ? $dssnArray[2] : "";?>">
                            </p> 
                            <p>
                                <input type="text" name="<?php echo base64_encode('SSN2A');?>" class="form-control width_30percent mr-0" >
                                -
                                <input type="text" name="<?php echo base64_encode('SSN2B');?>" class="form-control width_30percent mr-0" >
                                -
                                <input type="text" name="<?php echo base64_encode('SSN2C');?>" class="form-control width_30percent mr-0" >
                            </p>
                            <p>
                                <input type="checkbox" name="<?php echo base64_encode('Check Box1');?>" value="Yes" class=" w-auto form-control" <?php echo $ssnCheck1;?>>
                                {{ __('You do not have a Social Security number.') }}
                            </p>
                            <p class="text-bold">
                                9
                                <input type="text" name="<?php echo base64_encode('ITIN1A');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($ditinArray[0]) ? $ditinArray[0] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN1B');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($ditinArray[1]) ? $ditinArray[1] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN1C');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($ditinArray[2]) ? $ditinArray[2] : "";?>">
                            </p>
                            <p class="text-bold">
                                9
                                <input type="text" name="<?php echo base64_encode('ITIN2A');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN2B');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN2C');?>" class="form-control width_30percent mr-0">
                            </p>
                            <p>
                                <input type="checkbox" name="<?php echo base64_encode('Check Box2');?>" value="Yes" class=" w-auto form-control" <?php echo $ditinCheck1;?>>
                                {{ __('You do not have an ITIN.') }}
                            </p>
                        </div>
                        <?php
                                    $ditin2 = '';
                                    $dssn2 = '';
                                    $dssn2Array[] = "";
                                    $ditin2Array[] = "";
                                    if (Helper::validate_key_value('has_security_number', $BasicInfoPartB) == 1) {
                                        $ditin2 = Helper::validate_key_value('itin', $BasicInfoPartB);
                                        if (preg_match('/-/', $ditin2) != 1) {
                                            $ditin2Array[0] = substr($ditin2, 0, 3);
                                            $ditin2Array[1] = substr($ditin2, 3, 2);
                                            $ditin2Array[2] = substr($ditin2, 5, 4);
                                        } else {
                                            $ditin2Array = explode('-', $ditin2);
                                        }
                                    }
                                    if (Helper::validate_key_value('has_security_number', $BasicInfoPartB) != 1) {
                                        $dssn2 = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
                                        if (preg_match('/-/', $dssn2) != 1) {
                                            $dssn2Array[0] = substr($dssn2, 0, 3);
                                            $dssn2Array[1] = substr($dssn2, 3, 2);
                                            $dssn2Array[2] = substr($dssn2, 5, 4);
                                        } else {
                                            $dssn2Array = explode('-', $dssn2);
                                        }
                                    }

                                    $ssnCheck2 = "";
                                    if (empty($dssn2)) {
                                        $ssnCheck2 = "checked";
                                    }
                                    $ditinCheck2 = "";
                                    if (empty($ditin2)) {
                                        $ditinCheck2 = "checked";
                                    }
                                    ?>
                        <div class="col-md-5 mt-2">
                            <p>
                                <input type="text" name="<?php echo base64_encode('SSN3A');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($dssn2Array[0]) ? $dssn2Array[0] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('SSN3B');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($dssn2Array[1]) ? $dssn2Array[1] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('SSN3C');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($dssn2Array[2]) ? $dssn2Array[2] : "";?>">
                            </p> 
                            <p>
                                <input type="text" name="<?php echo base64_encode('SSN4A');?>" class="form-control width_30percent mr-0" >
                                -
                                <input type="text" name="<?php echo base64_encode('SSN4B');?>" class="form-control width_30percent mr-0" >
                                -
                                <input type="text" name="<?php echo base64_encode('SSN4C');?>" class="form-control width_30percent mr-0" >
                            </p>
                            <p>
                                <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class=" w-auto form-control" <?php echo $ssnCheck2;?>>
                                {{ __('You do not have a Social Security number.') }}
                            </p>
                            <p class="text-bold">
                                9
                                <input type="text" name="<?php echo base64_encode('ITIN3A');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($ditin2Array[0]) ? $ditin2Array[0] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN3B');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($ditin2Array[1]) ? $ditin2Array[1] : "";?>">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN3C');?>" class="form-control width_30percent mr-0" value="<?php echo !empty($ditin2Array[2]) ? $ditin2Array[2] : "";?>">
                            </p>
                            <p class="text-bold">
                                9
                                <input type="text" name="<?php echo base64_encode('ITIN4A');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN4B');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN4C');?>" class="form-control width_30percent mr-0">
                            </p>
                            <p>
                                <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class=" w-auto form-control" <?php echo $ditinCheck2;?>>
                                {{ __('You do not have an ITIN.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-3">

                <div class="col-md-12">
                    <div class="part-form-title mb-3"> 
                        <span>{{ __('Part 3:') }}</span>
                        <h2 class="font-lg-18">{{ __('Tell the Court About Your Non-Debtor Spouse') }}</h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <p class="text-bold">
                            {{ __('Name') }}:
                                <br>
                                {{ __('Last, First, Middle') }}
                            </p>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="<?php echo base64_encode('Nondebtor Spouse Name');?>" class="form-control">
                        </div>
                        <div class="col-md-5"></div>

                        <div class="col-md-2">
                            <p class="text-bold">
                                {{ __('Address:') }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="<?php echo base64_encode('Nondebtor Spouse Address 1');?>" class="form-control">
                            <input type="text" name="<?php echo base64_encode('Nondebtor Spouse Address 2');?>" class="form-control mt-1">
                        </div>
                        <div class="col-md-2">
                            <p class="text-bold">
                                {{ __('Social Security and
                                federal Individual
                                Taxpayer Identification
                                Numbers (ITIN) they have
                                used') }} 
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <input type="text" name="<?php echo base64_encode('SSN5A');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('SSN5B');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('SSN5C');?>" class="form-control width_30percent mr-0">
                            </p>
                            <p>
                                <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class=" w-auto form-control">
                                {{ __('You do not have a Social Security number.') }}
                            </p>
                            <p class="text-bold">
                                9
                                <input type="text" name="<?php echo base64_encode('ITIN5A');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN5B');?>" class="form-control width_30percent mr-0">
                                -
                                <input type="text" name="<?php echo base64_encode('ITIN5C');?>" class="form-control width_30percent mr-0">
                            </p>
                            <p>
                                <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class=" w-auto form-control">
                                {{ __('You do not have an ITIN.') }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-3">

                <div class="col-md-12">
                    <div class="part-form-title mb-3"> 
                        <span>{{ __('Part 4:') }}</span>
                        <h2 class="font-lg-18">{{ __('Sign Below') }}</h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <p>
                                {{ __('Under penalty of perjury, I declare that the information I have provided in this form is true and correct') }}
                            </p>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-5">
                            <div class="">
                                <x-officialForm.debtorSignVertical
                                    labelContent="Signature of Debtor:"
                                    inputFieldName=""
                                    inputValue={{$debtor_sign}}
                                ></x-officialForm.debtorSignVertical>
                            </div>
                            <div class="mt-1">
                                <x-officialForm.debtorSignVertical
                                    labelContent="Signature of Joint Debtor:"
                                    inputFieldName=""
                                    inputValue={{$debtor2_sign}}
                                ></x-officialForm.debtorSignVertical>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="">
                                <x-officialForm.dateSingleHorizontal
                                    labelText="Date:"
                                    dateNameField="Debtor 1 Date"
                                    currentDate={{$currentDate}}
                                ></x-officialForm.dateSingleHorizontal>
                                <label class="">{{ __('MM/DD/YYYY') }}</label>
                            </div>
                            <div class="mt-2">
                                <x-officialForm.dateSingleHorizontal
                                    labelText="Date:"
                                    dateNameField="Debtor 2 Date"
                                    currentDate={{$currentDate}}
                                ></x-officialForm.dateSingleHorizontal>
                                <label class="">{{ __('MM/DD/YYYY') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>