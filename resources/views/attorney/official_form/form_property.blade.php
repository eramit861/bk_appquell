<form name="official_frm_106a_and_b" class="save_official_forms official_frm_106a_and_b" id="official_frm_106a_and_b" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="106a_and_b">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106ab.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106ab.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('Case number#0-106AB'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 1#1-106AB'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2-106AB'); ?>" value="<?php echo $spousename; ?>">
     <!-- use below varibale for Part AB -->
    <?php
        $partAB = isset($dynamicPdfData['106a_and_b']) && !empty($dynamicPdfData['106a_and_b']) ? json_decode($dynamicPdfData['106a_and_b'], 1) : null;
    ?>
<section class="page-section official-form-106a_and_b padd-20" id="official-form-106a_and_b">
    <div class="container pl-2 pr-0">
        <x-officialForm.form103b.bankruptyCourtList
            :districtNames="$district_names"
            :savedData="$savedData"
            checkBoxName="Check 1-106AB"
            showCheckBox="true"
        ></x-officialForm.form103b.bankruptyCourtList>
        <div class="row padd-20">
            <div class="col-md-12 mb-3">
                <div class="form-title">
                    <h4>{{ __('Schedule A/B') }}</h4>
                    <h2 class="font-lg-22">{{ __('Schedule A/B: Property') }}
                    </h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-subheading">
                    <p class="font-lg-14">{{ __('In each category, separately list and describe items.
                        List
                        an asset only once. If an asset fits in more than one category, list the
                        asset in the
                        category where you think it fits best. Be as complete and accurate as
                        possible. If two married people are filing together, both are equally
                        responsible for supplying correct information. If more space is needed,
                        attach a separate sheet to this form. On the top of any additional
                        pages,
                        write your name and case number (if known). Answer every question') }}</p>
                </div>
            </div>
        </div>
        <x-officialForm.partTitle
            title="{{ __('Part 1') }}"
            subTitle="{{ __('Describe Each Residence, Building, Land, or Other Real Estate You Own or Have an Interest In') }}"
        ></x-officialForm.partTitle>

        <?php
        $totalResidentValue = 0;
    $propertyresident = $property_info['propertyresident']->toArray();
    // dump($propertyresident);
    $currently_lived_flag = false;
    ?>
        <div class="form-border mb-3">
            <div class="row mt-10">
                <div class="col-md-12">
                    <div class="input-group d-inline-block">
                        <strong class="d-block">{{ __('1. Do you own or have any legal or equitable
                            interest in any residence, building, land, or similar property?') }}
                        </strong>
                    </div>
                    <div class="input-group">
                        <?php
                        $c1 = $partAB[base64_encode('Check 2#0-106AB')] ?? null;
    $dbvalues = [$c1];
    if (!empty(array_filter($dbvalues))) {
        unset($currently_lived_flag);
    }
    $check1 = isset($partAB[base64_encode('Check 2#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 2#0-106AB'), $partAB, 'On') : (($currently_lived_flag != true) ? "checked" : '');
    $check2 = isset($partAB[base64_encode('Check 2#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 2#0-106AB'), $partAB, 'yes') : (($currently_lived_flag == true) ? "checked" : '');
    ?>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('Check 2#0-106AB'); ?>" value="On" type="checkbox"
                                <?php echo $check1;?>
                            >
                            <label>{{ __('No. Go to Part 2.') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('Check 2#0-106AB'); ?>" value="yes" type="checkbox"
                                <?php echo $check2;?>
                            >
                            <label>{{ __('Yes. Where is the property?') }}</label>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Heavy Form -->
            <?php
            $i = 1;
    if (!empty($propertyresident)) {?>
            <?php foreach ($propertyresident as $propertyval) {
                if (!empty($propertyval['currently_lived'])) {
                    $currently_lived_flag = true;
                } else {
                    $currently_lived_flag = false;
                }
                ?>
            <?php if ($i != 1) {
                ?>

            <?php if ($i > 1 && $i < 3) {?>
            <div class="col-md-12 mb-3">{{ __('If you own or have more than one, list here:') }}</div>
            <?php } else {?>
                <div style="margin-top:30px;"></div>
            <?php } ?>


            <?php

            } ?>


		<?php if (!empty($propertyval['currently_lived'])) {

		    $address = Helper::validate_key_value('Address', $BasicInfoPartA);
		    $city = Helper::validate_key_value('City', $BasicInfoPartA);
		    $state = Helper::validate_key_value('state', $BasicInfoPartA);
		    $zip = Helper::validate_key_value('zip', $BasicInfoPartA);
		    $county = Helper::validate_key_value('country', $BasicInfoPartA);

		    if ($propertyval['not_primary_address'] == 1) {
		        $address = $propertyval["mortgage_address"];
		        $city = $propertyval["mortgage_city"];
		        $state = $propertyval["mortgage_state"];
		        $zip = $propertyval["mortgage_zip"];
		        $county = $propertyval["mortgage_county"];
		    }
		    $num = '';
		    $check_1 = '';
		    $space = '';
		    $undifine = '';

		    if ($i == 1) {
		        $num = '1 1';
		        $undifine = 1;
		        $addressField = '1 1-106AB';
		        $cityField = 'City-106AB';
		        $stateField = 'State-106AB';
		        $zipField = 'ZIP Code-106AB';
		        $countyField = 'County-106AB';
		        $singleFamilyField = 'Singlefamily home-106AB';
		        $duplexField = 'Duplex or multiunit building-106AB';
		        $condominiumField = 'Condominium or cooperative-106AB';
		        $manufacturedField = 'Manufactured or mobile home-106AB';
		        $landField = 'Land-106AB';
		        $investmentField = 'Investment property-106AB';
		        $timeshareField = 'Timeshare-106AB';
		        $otherField = 'Other-106AB';
		        $textField = 'Other2_4-106AB';
		        $whoHasInterestInPropertyField = 'Who has interest in property#0-106AB';
		        $whoHasInterestInPropertyOtherField = 'property identification number-106AB';
		        $currentValueOfTheEntirePropertyField = 'Other3_2-106AB';
		        $currentValueOfThePortionYouOwnField = 'Other4_3-106AB';
		        $natureOfOwnershipField = 'the entireties or a life estate if known-106AB';
		        $checkIfThisCommunityPropertyField = 'Check if this is community property-106AB';
		        $debtor1Value = 'Debtor 1';
		        $debtor2Value = 'Debtor 2';
		        $debtor1And2Value = 'Debtor 1 and 2';
		        $oneOfDebtorAndAnotherValue = 'One of debtors and another';
		        $Field = '';
		    } elseif ($i == 2) {
		        $num = 12;
		        $check_1 = "_".$i;
		        $space = ' '.$i;
		        $undifine = 5;
		        $addressField = '12-106AB';
		        $cityField = 'City_2-106AB';
		        $stateField = 'State_2-106AB';
		        $zipField = 'ZIP Code_2-106AB';
		        $countyField = 'County_2-106AB';
		        $singleFamilyField = 'Singlefamily home_2-106AB';
		        $duplexField = 'Duplex or multiunit building_2-106AB';
		        $condominiumField = 'Condominium or cooperative_2-106AB';
		        $manufacturedField = 'Manufactured or mobile home_2-106AB';
		        $landField = 'Land_2-106AB';
		        $investmentField = 'Investment property_2-106AB';
		        $timeshareField = 'Timeshare_2-106AB';
		        $otherField = 'Other_2-106AB';
		        $textField = 'Other_8-106AB';
		        $whoHasInterestInPropertyField = 'Who has interest in property 2#0-106AB';
		        $whoHasInterestInPropertyOtherField = 'property identification number_2-106AB';
		        $currentValueOfTheEntirePropertyField = 'Current_6-106AB';
		        $currentValueOfThePortionYouOwnField = 'Current_7-106AB';
		        $natureOfOwnershipField = 'Who has an interest in the property Check one-106AB';
		        $checkIfThisCommunityPropertyField = 'Check if this is community property_2-106AB';
		        $debtor1Value = 'Debtor 1';
		        $debtor2Value = 'Dentor 2';
		        $debtor1And2Value = 'Debtor 1 and 2';
		        $oneOfDebtorAndAnotherValue = 'One of debtors and another';
		    } elseif ($i == 3) {
		        $num = 13;
		        $check_1 = "_".$i;
		        $space = ' '.$i;
		        $undifine = 9;
		        $addressField = '13-106AB';
		        $cityField = 'City_3-106AB';
		        $stateField = 'State_3-106AB';
		        $zipField = 'ZIP Code_3-106AB';
		        $countyField = 'County_3-106AB';
		        $singleFamilyField = 'Singlefamily home_3-106AB';
		        $duplexField = 'Duplex or multiunit building_3-106AB';
		        $condominiumField = 'Condominium or cooperative_3-106AB';
		        $manufacturedField = 'Manufactured or mobile home_3-106AB';
		        $landField = 'Land_3-106AB';
		        $investmentField = 'Investment property_3-106AB';
		        $timeshareField = 'Timeshare_3-106AB';
		        $otherField = 'Other_3-106AB';
		        $textField = 'Address_12-106AB';
		        $whoHasInterestInPropertyField = 'Who has interest in property 3#0-106AB#0-106AB';
		        $whoHasInterestInPropertyOtherField = 'property identification number_3-106AB';
		        $currentValueOfTheEntirePropertyField = 'CurrentValue_10-106AB';
		        $currentValueOfThePortionYouOwnField = 'CurrentVal_11-106AB';
		        $natureOfOwnershipField = 'Who has an interest in the property Check one_2-106AB';
		        $checkIfThisCommunityPropertyField = 'Check if this is community property_3-106AB';
		        $debtor1Value = 'Debtor1';
		        $debtor2Value = 'Debtor 2';
		        $debtor1And2Value = 'Debtor 1 and 2';
		        $oneOfDebtorAndAnotherValue = 'On';
		    }
		    $totalResidentValue += (float)Helper::validate_key_value('estimated_property_value', $propertyval);
		    ?>
            <div class="row">
                <div class="col-md-4 d-flex mt-3">
                    <label for="">&nbsp;&nbsp;<?php echo "1.".$i;?></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input name="<?php echo base64_encode($addressField); ?>" type="text" value="<?php echo $partAB[base64_encode($addressField)] ?? $address;?>" class="form-control">
                                <label for="">{{ __('Street address, if available, or other description') }}</label>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode($cityField); ?>" type="text" value="<?php echo $partAB[base64_encode($cityField)] ?? $city;?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode($stateField); ?>" type="text" value="<?php echo $partAB[base64_encode($stateField)] ?? $state;?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode($zipField); ?>" type="number" value="<?php echo $partAB[base64_encode($zipField)] ?? $zip;?>" class="form-control">
                                        <label for="">{{ __('ZIP Code') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="">{{ __('County') }}</label>
                                <input name="<?php echo base64_encode($countyField); ?>" type="text" value="<?php echo $partAB[base64_encode($countyField)] ?? $county;?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="property">
                        <div class="input-group">
                            <p>
                                <strong>{{ __('What is the property?') }} </strong>
                                {{ __('Check all that apply.') }}
                            </p>
                        </div>
                        <?php
		                    $c1 = $partAB[base64_encode($singleFamilyField)] ?? null;
		    $c2 = $partAB[base64_encode($duplexField)] ?? null;
		    $c3 = $partAB[base64_encode($condominiumField)] ?? null;
		    $c4 = $partAB[base64_encode($manufacturedField)] ?? null;
		    $c5 = $partAB[base64_encode($landField)] ?? null;
		    $c6 = $partAB[base64_encode($investmentField)] ?? null;
		    $c7 = $partAB[base64_encode($timeshareField)] ?? null;
		    $c8 = $partAB[base64_encode($otherField)] ?? null;
		    $dbvalues = [$c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8];
		    if (!empty(array_filter($dbvalues))) {
		        unset($propertyval['property']);
		    }
		    $check1 = isset($partAB[base64_encode($singleFamilyField)]) ? Helper::validate_key_toggle(base64_encode($singleFamilyField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 1);
		    $check2 = isset($partAB[base64_encode($duplexField)]) ? Helper::validate_key_toggle(base64_encode($duplexField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 2);
		    $check3 = isset($partAB[base64_encode($condominiumField)]) ? Helper::validate_key_toggle(base64_encode($condominiumField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 3);
		    $check4 = isset($partAB[base64_encode($manufacturedField)]) ? Helper::validate_key_toggle(base64_encode($manufacturedField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 4);
		    $check5 = isset($partAB[base64_encode($landField)]) ? Helper::validate_key_toggle(base64_encode($landField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 5);
		    $check6 = isset($partAB[base64_encode($investmentField)]) ? Helper::validate_key_toggle(base64_encode($investmentField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 6);
		    $check7 = isset($partAB[base64_encode($timeshareField)]) ? Helper::validate_key_toggle(base64_encode($timeshareField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 7);
		    $check8 = isset($partAB[base64_encode($otherField)]) ? Helper::validate_key_toggle(base64_encode($otherField), $partAB, 'On') : Helper::validate_key_toggle('property', $propertyval, 8);
		    ?>
                        <div class="input-group mt-2 mb-0">
                            <input name="<?php echo base64_encode($singleFamilyField); ?>" value="On" type="checkbox" <?php echo $check1;?>>
                            <label>{{ __('Single-family home') }}</label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($duplexField); ?>" value="On" type="checkbox" <?php echo $check2;?>>
                            <label>{{ __('Duplex or multi-unit building') }}</label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($condominiumField); ?>" value="On" type="checkbox" <?php echo $check3;?>>
                            <label>{{ __('Condominium or cooperative') }}
                            </label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($manufacturedField); ?>" value="On" type="checkbox" <?php echo $check4;?>>
                            <label>{{ __('Manufactured or mobile home') }}
                            </label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($landField); ?>" value="On" type="checkbox" <?php echo $check5;?>>
                            <label>{{ __('Land') }}
                            </label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($investmentField); ?>" value="On" type="checkbox" <?php echo $check6;?>>
                            <label> {{ __('Investment property') }}</label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($timeshareField); ?>" value="On" type="checkbox" <?php echo $check7;?>>
                            <label>{{ __('Timeshare') }}</label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($otherField); ?>" value="On"  type="checkbox" <?php echo $check8;?>>
                            <label>{{ __('Other') }}</label>
                            <input name="<?php echo base64_encode($textField); ?>" type="text" value="<?php echo $partAB[base64_encode($textField)] ?? ''?>" class="form-control">
                        </div>
                    </div>
                    <div class="interest-property mt-3">
                        <div class="input-group">
                            <p>
                                <strong>{{ __('Who has an interest in the property?') }}</strong>
                                 {{ __('Check one.') }}
                            </p>
                        </div>
                        <?php
		        $c1 = $partAB[base64_encode($whoHasInterestInPropertyField)] ?? null;
		    $dbvalues = [$c1];
		    if (!empty(array_filter($dbvalues))) {
		        unset($propertyval['property_owned_by']);
		    }
		    $check1 = isset($partAB[base64_encode($whoHasInterestInPropertyField)]) ? Helper::validate_key_toggle(base64_encode($whoHasInterestInPropertyField), $partAB, $debtor1Value) : Helper::validate_key_toggle('property_owned_by', $propertyval, 1);
		    $check2 = isset($partAB[base64_encode($whoHasInterestInPropertyField)]) ? Helper::validate_key_toggle(base64_encode($whoHasInterestInPropertyField), $partAB, $debtor2Value) : Helper::validate_key_toggle('property_owned_by', $propertyval, 2);
		    $check3 = isset($partAB[base64_encode($whoHasInterestInPropertyField)]) ? Helper::validate_key_toggle(base64_encode($whoHasInterestInPropertyField), $partAB, $debtor1And2Value) : Helper::validate_key_toggle('property_owned_by', $propertyval, 3);
		    $check4 = isset($partAB[base64_encode($whoHasInterestInPropertyField)]) ? Helper::validate_key_toggle(base64_encode($whoHasInterestInPropertyField), $partAB, $oneOfDebtorAndAnotherValue) : Helper::validate_key_toggle('property_owned_by', $propertyval, 4);



		    ?>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($whoHasInterestInPropertyField); ?>" value="<?php echo($debtor1Value); ?>" type="checkbox" <?php echo $check1;?>>
                            <label>{{ __('Debtor 1 only') }}</label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($whoHasInterestInPropertyField); ?>" value="<?php echo($debtor2Value); ?>" type="checkbox" <?php echo $check2;?>>
                            <label>{{ __('Debtor 2 only') }}</label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($whoHasInterestInPropertyField); ?>" value="<?php echo($debtor1And2Value); ?>" type="checkbox" <?php echo $check3;?>>
                            <label>{{ __('Debtor 1 and Debtor 2 only') }}
                            </label>
                        </div>
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode($whoHasInterestInPropertyField); ?>" value="<?php echo($oneOfDebtorAndAnotherValue); ?>" type="checkbox" <?php echo $check4;?>>
                            <label>{{ __('At least one of the debtors and another') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="bg-dgray">
                        <span>{{ __('Do not deduct secured claims or exemptions.
                            Put
                            the amount of any secured claims on') }}
                            <i>{{ __('Schedule D:
                            Creditors Who Have Claims Secured by Property.') }}</i>
                        </span>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label>
                                    <strong>{{ __('Current value of the
                                        entire property?') }} </strong></label>
                                <input name="<?php echo base64_encode($currentValueOfTheEntirePropertyField); ?>" type="text" value="<?php echo isset($partAB[base64_encode($currentValueOfTheEntirePropertyField)]) ? Helper::priceFormtWithComma($partAB[base64_encode($currentValueOfTheEntirePropertyField)]) : Helper::validate_key_value('estimated_property_value', $propertyval, 'comma');?>" class="price-field form-control" placeholder="$">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label>
                                    <strong>{{ __('Current value of the
                                        portion you own?') }} </strong></label>
                                <input name="<?php echo base64_encode($currentValueOfThePortionYouOwnField); ?>" type="text" value="<?php echo isset($partAB[base64_encode($currentValueOfThePortionYouOwnField)]) ? Helper::priceFormtWithComma($partAB[base64_encode($currentValueOfThePortionYouOwnField)]) : Helper::validate_key_value('estimated_property_value', $propertyval, 'comma');?>" class="price-field form-control" placeholder="$">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <label for=""><strong>{{ __('Describe the nature of your ownership
                                        interest (such as fee simple, tenancy by
                                        the entireties, or a life estate), if
                                        known.') }}</strong></label>
                                <select name="<?php echo base64_encode($natureOfOwnershipField); ?>" class="form-control">
                                    <option value="Equitable interest">{{ __('Equitable interest') }}</option>
                                    <option value="Fee simple" selected>{{ __('Fee simple') }}</option>
                                    <option value="Future interest">{{ __('Future interest') }}</option>
                                    <option value="Joint tenant">{{ __('Joint tenant') }}</option>
                                    <option value="Life Estate">{{ __('Life Estate') }}</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="input-group">
                                <input name="<?php echo base64_encode($checkIfThisCommunityPropertyField); ?>" value="On" type="checkbox" <?php echo isset($partAB[base64_encode($checkIfThisCommunityPropertyField)]) ? Helper::validate_key_toggle(base64_encode($checkIfThisCommunityPropertyField), $partAB, 'On') : ''; ?>>
                                <label for="">{{ __('Check if this is community property
                                    (see instructions)') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <div class="input-group mb-0">
                        <strong>{{ __('Other information you wish to add about this item, such as
                            local
                            property identification number') }}</strong>
                        <input name="<?php echo base64_encode($whoHasInterestInPropertyOtherField); ?>" type="text" value="<?php echo $partAB[base64_encode($whoHasInterestInPropertyOtherField)] ?? '';?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-2"></div>

            </div>
            <?php }?>
            <?php $i++;
            }?>
            <?php }?>
            <x-officialForm.abSchedule.partTotalValueBox
                questionNumber="2"
                question="{{  __('Add the dollar value of the portion you own for all of your entries from Part 1, including any entries for pages you have attached for Part 1. Write that number here.') }}"
                name="<?php echo base64_encode('DollarAmt_13-106AB'); ?>"
                value="<?php echo isset($partAB[base64_encode('DollarAmt_13-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('DollarAmt_13-106AB')]) : Helper::priceFormtWithComma($totalResidentValue); ?>"
            ></x-officialForm.abSchedule.partTotalValueBox>
        </div>
        <x-officialForm.partTitle
            title="{{ __('Part 2') }}"
            subTitle="{{ __('Describe Your Vehicles') }}"
        ></x-officialForm.partTitle>

        <?php
        $propertyvehicle = $property_info['propertyvehicle']->toArray();
    $cartruck = false;
    $cartruckCount = 1;
    foreach ($propertyvehicle as $vehicle) {
        if ($vehicle['own_any_property'] == 1 && $vehicle['property_type'] == Helper::VEHICLE_CARS_TK) {
            $cartruck = true;
            $cartruckCount + 1;
        }
    }
    ?>
        <div class="form-border mb-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-inline-block mt-2">
                        <label for=""><strong class="d-block">{{ __('Do you own, lease, or have legal
                                or
                                equitable
                                interest in any vehicles, whether they are registered or
                                not?') }}</strong> {{ __('Include
                            any vehicles
                            you own that someone else drives. If you lease a vehicle, also
                            report it
                            on Schedule G: Executory Contracts and Unexpired Leases') }}
                        </label>
                    </div>
                    <div class="input-group mt-3">
                        <div class="input-group">
                            <label><strong>{{ __('3. Cars, vans, trucks, tractors, sport utility
                                    vehicles,
                                    motorcycles') }}</strong></label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('Check 3#0-106AB'); ?>" value="no" type="checkbox"
                                <?php echo isset($partAB[base64_encode('Check 3#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 3#0-106AB'), $partAB, 'no') : (($cartruck == false) ? "checked" : '');?>
                            >
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('Check 3#0-106AB'); ?>" value="yes" type="checkbox"
                                <?php echo isset($partAB[base64_encode('Check 3#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 3#0-106AB'), $partAB, 'yes') : (($cartruck == true) ? "checked" : '');?>
                            >
                            <label>{{ __('Yes') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        $i = 1;
    $totalVehiclePrice = 0;
    foreach ($propertyvehicle as $vehicle) {
        if ($vehicle['property_type'] == 1) {
            $totalVehiclePrice += (float)Helper::validate_key_value('property_estimated_value', $vehicle, 'float');
            if ($i == 1) {
                $make = '3 1-106AB';
                $model = '3 2-106AB';
                $year = '3 3-106AB';
                $mileage = '3 4-106AB';
                $otherInformation = 'Other information-106AB';
                $interestInTheProperty = 'Who has interest in property 4#1-106AB';
                $seeInstruction = 'Check if this is community property see-106AB';
                $currentValueA = 'CurrVal_14-106AB';
                $currentValueB = 'CurrValue_15-106AB';
                $debtor1Value = 'Debtor 1';
                $debtor2Value = 'Debtor 2';
                $debtor1And2Value = 'Debtor 1 and 2';
                $oneOfDebtorAndAnotherValue = 'One of Debtors and another';
            }
            if ($i == 2) {
                $make = 'If you own or have more than one describe here-106AB';
                $model = '1_2-106AB';
                $year = '2_2-106AB';
                $mileage = 'Approximate mileage_2-106AB';
                $otherInformation = 'Other information_2-106AB';
                $interestInTheProperty = 'Who has interest in property 5#0-106AB';
                $seeInstruction = 'Check if this is community property see_2-106AB';
                $currentValueA = 'CurVal_16-106AB';
                $currentValueB = 'CurVal_17-106AB';
                $debtor1Value = 'Debtor 1';
                $debtor2Value = 'Debtor 2';
                $debtor1And2Value = 'Debtor 1 and 2';
                $oneOfDebtorAndAnotherValue = 'One of Debtors and another';

            }
            if ($i == 3) {
                $make = '1_3-106AB';
                $model = '2_3-106AB';
                $year = '3_2-106AB';
                $mileage = 'Approximate mileage_3-106AB';
                $otherInformation = 'Other information_3-106AB';
                $interestInTheProperty = 'Who has interest in property 6#0-106AB';
                $seeInstruction = 'Check if this is community property see_3-106AB';
                $currentValueA = 'CuVa_18-106AB';
                $currentValueB = 'CuVa_19-106AB';
                $debtor1Value = 'Debtor 1';
                $debtor2Value = 'Debtor 2';
                $debtor1And2Value = 'Debtor 1 and 2';
                $oneOfDebtorAndAnotherValue = 'One of Debtors and another';

            }
            if ($i == 4) {
                $make = '1_4-106AB';
                $model = '2_4-106AB';
                $year = '3_3-106AB';
                $mileage = 'Approximate mileage_4-106AB';
                $otherInformation = 'Other information_4-106AB';
                $interestInTheProperty = 'Who has interest in property 7#0-106AB';
                $seeInstruction = 'Check if this is community property see_4-106AB';
                $currentValueA = 'CurreV_20-106AB';
                $currentValueB = 'CurreV_21-106AB';
                $debtor1Value = 'Debtor 1';
                $debtor2Value = 'Debtor 2';
                $debtor1And2Value = 'Debtor 1 and 2';
                $oneOfDebtorAndAnotherValue = 'On';

            }

            ?>
                <!-- First Row -->


            <div class="row mt-3">
                <x-officialForm.abSchedule.VehiclePropertyRow
                    q="3"
                    :i="$i"
                    :make="$make"
                    :model="$model"
                    :year="$year"
                    :mileage="$mileage"
                    :otherInformation="$otherInformation"
                    :partAB="$partAB"
                    :vehicle="$vehicle"
                    :interestInTheProperty="$interestInTheProperty"
                    :seeInstruction="$seeInstruction"
                    :debtor1Value="$debtor1Value"
                    :debtor2Value="$debtor2Value"
                    :debtor1And2Value="$debtor1And2Value"
                    :oneOfDebtorAndAnotherValue="$oneOfDebtorAndAnotherValue"
                    :currentValueA="$currentValueA"
                    :currentValueB="$currentValueB"
                ></x-officialForm.abSchedule.VehiclePropertyRow>
            </div>

            <?php if ($i == 1 && $cartruckCount > 1) { ?>
                <div class="input-group">
                    <label>{{ __('If you own or have more than one, describe here:') }} </label>
                </div>
            <?php } ?>
            <?php
            $i++;
        }
    } ?>

            <?php
    $anotherCount = 1;
    $anotherType = false;
    foreach ($propertyvehicle as $vehicle) {
        if ($vehicle['property_type'] != 1) {
            $anotherCount + 1;
            $anotherType = true;

        }
    }
    ?>

            <!-- Duplicate Row -->
            <div class="row mt-3">
                <div class="col-md-12">

                    <div class="input-group">
                        <div class="input-group">
                            <label><strong>{{ __('4. Watercraft, aircraft, motor homes, ATVs and other
                                    recreational vehicles, other vehicles, and
                                    accessories') }}</strong> &nbsp;{{ __('Examples: Boats, trailers, motors,
                                personal
                                watercraft, fishing vessels, snowmobiles, motorcycle accessories') }}
                            </label>
                        </div>
                        <div class="input-group">
                            <?php
                        $checkname = 'Examples Boats trailers motors personal watercraft fishing vessels snowmobiles motorcycle accessories-106AB';
    ?>
                            <input name="<?php echo base64_encode($checkname) ?>" value="No_2" type="checkbox"
                                <?php echo isset($partAB[base64_encode($checkname)]) ? Helper::validate_key_toggle(base64_encode($checkname), $partAB, 'No_2') : (($anotherType == false) ? "checked" : '');?>
                            >
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode($checkname) ?>" value="Yes_2" type="checkbox"
                                <?php echo isset($partAB[base64_encode($checkname)]) ? Helper::validate_key_toggle(base64_encode($checkname), $partAB, 'Yes_2') : (($anotherType == true) ? "checked" : '');?>
                            >
                            <label>{{ __('Yes') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- First Row -->
            <?php $i = 1;
    foreach ($propertyvehicle as $vehicle) {
        if ($vehicle['property_type'] != 1) {
            $totalVehiclePrice += (float)Helper::validate_key_value('property_estimated_value', $vehicle, 'float');

            if ($i == 1) {
                $make = 'Make-106AB';
                $model = 'Model-106AB';
                $year = 'Year-106AB';
                $otherInformation = 'Other information_5-106AB';
                $interestInTheProperty = 'Who has interest in property 8#0-106AB';
                $seeInstruction = 'Check if this is community property see_5-106AB';
                $currentValueA = 'CVAL_22-106AB';
                $currentValueB = 'CVAL_23-106AB';
                $debtor1Value = 'Debtor 1';
                $debtor2Value = 'Debtor 2';
                $debtor1And2Value = 'Debtor 1 and 2';
                $oneOfDebtorAndAnotherValue = 'One of Debtors and another';

            }
            if ($i == 2) {
                $make = 'Make_2-106AB';
                $model = 'Model_2-106AB';
                $year = 'Year_2-106AB';
                $otherInformation = 'Other information_6-106AB';
                $interestInTheProperty = 'Who has interest in property 9#1-106AB';
                $seeInstruction = 'Check if this is community property see_6-106AB';
                $currentValueA = 'CurV_24-106AB';
                $currentValueB = 'CurV_25-106AB';
                $debtor1Value = 'Debtor1';
                $debtor2Value = 'Debtor 2';
                $debtor1And2Value = 'Debtor 1 and 2';
                $oneOfDebtorAndAnotherValue = 'On';

            }
            $emptyVariable = "";
            ?>

            <div class="row mt-3">
                <x-officialForm.abSchedule.VehiclePropertyRow
                     q="4"
                    :i="$i"
                    :make="$make"
                    :model="$model"
                    :year="$year"
                    :mileage="$emptyVariable"
                    :otherInformation="$otherInformation"
                    :partAB="$partAB"
                    :vehicle="$vehicle"
                    :interestInTheProperty="$interestInTheProperty"
                    :seeInstruction="$emptyVariable"
                    :debtor1Value="$debtor1Value"
                    :debtor2Value="$debtor2Value"
                    :debtor1And2Value="$debtor1And2Value"
                    :oneOfDebtorAndAnotherValue="$oneOfDebtorAndAnotherValue"
                    :currentValueA="$currentValueA"
                    :currentValueB="$currentValueB"
                ></x-officialForm.abSchedule.VehiclePropertyRow>
            </div>

            <?php if ($i == 1 && $anotherCount > 1) { ?>
            <div class="input-group">
                <label>{{ __('If you own or have more than one, describe here:') }} </label>
            </div>
            <?php } ?>
            <?php $i++;
        }
    } ?>
            <x-officialForm.abSchedule.partTotalValueBox
                questionNumber="5"
                name="<?php echo base64_encode('CURV_26-106AB'); ?>"
                question="{{ __('Add the dollar value of the portion you own for all of your entries from Part 2, including any entries for pages you have attached for Part 2. Write that number here') }}"
                value="<?php echo isset($partAB[base64_encode('CURV_26-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('CURV_26-106AB')]) : Helper::priceFormtWithComma($totalVehiclePrice); ?>"
            ></x-officialForm.abSchedule.partTotalValueBox>
        </div>
        <x-officialForm.partTitle
            title="{{ __('Part 3') }}"
            subTitle="{{ __('Describe Your Personal and Household Items') }}"
        ></x-officialForm.partTitle>

        <div class="form-border mb-3">
            <div class="row align-items-center column-heading mb-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <strong>
                            {{ __('Do you own or have any legal or equitable interest in any of the
                            following
                            items?') }}
                        </strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <strong>{{ __('Current value of the portion you own?') }}</strong>
                        <p>{{ __('Do not deduct secured claims
                            or exemptions') }}</p>
                        </strong>
                    </div>
                </div>
            </div>
            
            <?php $checkBoxName = "6 check#0-106AB";
    $descriptionName = "6 description-106AB";
    $descriptionAmount = "6 description amount-106AB"?>
            <div class="row">
                <div class="col-md-12">
                    <strong class="d-block">{{ __('6. Household goods and furnishings') }}</strong>
                    <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Major  appliances, furniture, linens, china, kitchenware')}}
                    <div class="input-group">
                        <input name="{{ base64_encode($checkBoxName) }}" value="no" type="checkbox" {{ isset($partAB[base64_encode($checkBoxName)])? Helper::validate_key_toggle(base64_encode($checkBoxName),$partAB,'no'):Helper::validate_key_toggle('type_value',$household_goods,0) }}>
                        <label>{{ __('No') }}</label>
                    </div>
                    <?php
            $exportValue = "yes";
    if ($checkBoxName == 'check 47#0-106AB' || $checkBoxName == 'check 51#0-106AB') {
        $exportValue = "On";
    }?>
                    <div class="input-group">
                        <input name="<?php echo base64_encode($checkBoxName); ?>" value="{{$exportValue}}" type="checkbox" <?php echo isset($partAB[base64_encode($checkBoxName)]) ? Helper::validate_key_toggle(base64_encode($checkBoxName), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $household_goods, 1);?>>
                
                        <?php if (!empty($describe)) { ?>
                            <label>{{$describe}}</label>
                        <?php } else {?>
                            <label>{{ __('Yes Describe') }}</label>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <?php
            $description = "";
    $descriptionValue = 0;

    $description = Helper::validate_key_value('description', $household_goods) ?? '';
    $descriptionValue = Helper::validate_key_value('property_value', $household_goods, 'comma') ?? 0;


    ?>
                            <textarea name="<?php echo base64_encode($descriptionName); ?>" class="noadjust ab_question form-control" rows="2"><?php echo $partAB[base64_encode($descriptionName)] ?? Helper::validate_key_value('description', $household_goods);?></textarea>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex ">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode($descriptionAmount); ?>" type="text" value="<?php echo isset($partAB[base64_encode($descriptionAmount)]) ? Helper::priceFormtWithComma($partAB[base64_encode($descriptionAmount)]) : Helper::priceFormtWithComma($descriptionValue);?>" class="price-field ab_question form-control">
                    </div>
                </div>
            </div>



            <!-- <x-officialForm.abSchedule.part3Question
                checkBoxName="7 check#0-106AB" :partAB="$partAB" :household_goods="$electronics"
                descriptionName="7 description-106AB"
                descriptionAmount="7 description amount-106AB"
            >
                <strong class="d-block">{{ __('7. Electronics') }}</strong>
                <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Televisions and radios; audio, video, stereo, and digital equipment; computers, printers, scanners;  music collections; electronic devices including cell phones, cameras, media players, games')}}
            </x-officialForm.abSchedule.part3Question> -->

             
            <?php $checkBoxName = "7 check#0-106AB";
    $descriptionName = "7 description-106AB";
    $descriptionAmount = "7 description amount-106AB"?>
            <div class="row">
                <div class="col-md-12">
                    <strong class="d-block">{{ __('7. Electronics') }}</strong>
                    <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Televisions and radios; audio, video, stereo, and digital equipment; computers, printers, scanners;  music collections; electronic devices including cell phones, cameras, media players, games')}}
                    <div class="input-group">
                        <input name="{{ base64_encode($checkBoxName) }}" value="no" type="checkbox" {{ isset($partAB[base64_encode($checkBoxName)])? Helper::validate_key_toggle(base64_encode($checkBoxName),$partAB,'no'):Helper::validate_key_toggle('type_value',$electronics,0) }}>
                        <label>{{ __('No') }}</label>
                    </div>
                    <?php
            $exportValue = "yes";
    if ($checkBoxName == 'check 47#0-106AB' || $checkBoxName == 'check 51#0-106AB') {
        $exportValue = "On";
    }?>
                    <div class="input-group">
                        <input name="<?php echo base64_encode($checkBoxName); ?>" value="{{$exportValue}}" type="checkbox" <?php echo isset($partAB[base64_encode($checkBoxName)]) ? Helper::validate_key_toggle(base64_encode($checkBoxName), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $electronics, 1);?>>
                
                        <?php if (!empty($describe)) { ?>
                            <label>{{$describe}}</label>
                        <?php } else {?>
                            <label>{{ __('Yes Describe') }}</label>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <?php
            $description = "";
    $descriptionValue = 0;

    $description = Helper::validate_key_value('description', $electronics) ?? '';
    $descriptionValue = Helper::validate_key_value('property_value', $electronics, 'comma') ?? 0;


    ?>
                            <textarea name="<?php echo base64_encode($descriptionName); ?>" class="noadjust ab_question form-control" rows="2"><?php echo $partAB[base64_encode($descriptionName)] ?? Helper::validate_key_value('description', $electronics);?></textarea>
                       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex ">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode($descriptionAmount); ?>" type="text" value="<?php echo isset($partAB[base64_encode($descriptionAmount)]) ? Helper::priceFormtWithComma($partAB[base64_encode($descriptionAmount)]) : Helper::priceFormtWithComma($descriptionValue);?>" class="price-field ab_question form-control">
                    </div>
                </div>
            </div>

            <x-officialForm.abSchedule.part3Question
                checkBoxName="8 check#0-106AB" :partAB="$partAB" :household_goods="$collectibles"
                descriptionName="8 description-106AB"
                descriptionAmount="8 description amount-106AB"
            >
                <strong class="d-block">{{ __('8. Collectibles of value') }}</strong>
                <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Antiques and figurines; paintings, prints, or other artwork; books, pictures, or other art objects; stamp, coin, or baseball card collections; other collections, memorabilia, collectibles')}}
            </x-officialForm.abSchedule.part3Question>
            <x-officialForm.abSchedule.part3Question
                checkBoxName="9 check#0-106AB" :partAB="$partAB" :household_goods="$sports"
                descriptionName="9 description-106AB"
                descriptionAmount="9 description amount-106AB"
            >
                <strong class="d-block">{{ __('9. Equipment for sports and hobbies') }}</strong>
                <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Sports, photographic, exercise, and other hobby equipment; bicycles, pool tables, golf clubs, skis; canoes and kayaks; carpentry tools; musical instruments') }}
            </x-officialForm.abSchedule.part3Question>
            <x-officialForm.abSchedule.part3Question
                checkBoxName="10 check#0-106AB" :partAB="$partAB" :household_goods="$firearms"
                descriptionName="10 description-106AB"
                descriptionAmount="10 description amounT-106AB"
            >
                <strong class="d-block">{{ __('10. Firearms') }}</strong>
                <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Examples: Pistols, rifles, shotguns, ammunition, and related equipment') }}
            </x-officialForm.abSchedule.part3Question>
            <x-officialForm.abSchedule.part3Question
                checkBoxName="11 check#0-106AB" :partAB="$partAB" :household_goods="$clothing"
                descriptionName="11 description-106AB"
                descriptionAmount="11 description amount-106AB"
            >
                <strong class="d-block">{{ __('11. Clothes') }}</strong>
                <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Everyday clothes, furs,leather coats, designer wear, hoes, accessories') }}
            </x-officialForm.abSchedule.part3Question>

            <?php $checkBoxName = "12 check#0-106AB";
    $descriptionName = "12 description-106AB";
    $descriptionAmount = "12 description amount-106AB"?>
            <div class="row">
                <div class="col-md-12">
                    <strong class="d-block">{{ __('12. Jewelry') }}</strong>
                    <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Everyday jewelry, costume jewelry, engagement rings, wedding rings, heirloom jewelry,watches,gems,gold, silver') }}
                    <div class="input-group">
                        <input name="{{ base64_encode($checkBoxName) }}" value="no" type="checkbox" {{ isset($partAB[base64_encode($checkBoxName)])? Helper::validate_key_toggle(base64_encode($checkBoxName),$partAB,'no'):Helper::validate_key_toggle('type_value',$jewelry,0) }}>
                        <label>{{ __('No') }}</label>
                    </div>
                    <?php
            $exportValue = "yes";
    if ($checkBoxName == 'check 47#0-106AB' || $checkBoxName == 'check 51#0-106AB') {
        $exportValue = "On";
    }?>
                    <div class="input-group">
                        <input name="<?php echo base64_encode($checkBoxName); ?>" value="{{$exportValue}}" type="checkbox" <?php echo isset($partAB[base64_encode($checkBoxName)]) ? Helper::validate_key_toggle(base64_encode($checkBoxName), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $jewelry, 1);?>>
                
                        <?php if (!empty($describe)) { ?>
                            <label>{{$describe}}</label>
                        <?php } else {?>
                            <label>{{ __('Yes Describe') }}</label>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <?php
            $description = "";
    $descriptionValue = 0;
    $description = Helper::validate_key_value('description', $jewelry) ?? '';
    $descriptionValue = Helper::validate_key_value('property_value', $jewelry, 'comma') ?? 0;


    ?>
                            <textarea name="<?php echo base64_encode($descriptionName); ?>" class="noadjust ab_question form-control" rows="2"><?php echo $partAB[base64_encode($descriptionName)] ?? Helper::validate_key_value('description', $jewelry);?></textarea>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex ">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode($descriptionAmount); ?>" type="text" value="<?php echo isset($partAB[base64_encode($descriptionAmount)]) ? Helper::priceFormtWithComma($partAB[base64_encode($descriptionAmount)]) : Helper::priceFormtWithComma($descriptionValue);?>" class="price-field ab_question form-control">
                    </div>
                </div>
            </div>

            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 13#1-106AB" :partAB="$partAB" :household_goods="$pets"
                descriptionName="13 description-106AB"
                descriptionAmount="13 description amount-106AB"
            >
                <strong class="d-block">{{ __('13. Non-farm animals') }}</strong>
                <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Dogs, cats, birds, horses') }}
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 14 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 14#0-106AB" :partAB="$partAB" :household_goods="$health_aids"
                descriptionName="14 description106AB"
                descriptionAmount="14 description amount-106AB"
            >
                <strong class="d-block">{{ __('14. Any other personal and household
                    items you did not already list, including any health aids you did not list') }}</strong>
                <i class="text-bold">{{ __('Examples') }}</i>: {{ __('Dogs, cats, birds, horses') }}
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 15 -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('15. Add the dollar value of all of
                                    your
                                    entries from Part 3, including any entries for pages you
                                    have
                                    attached
                                    for Part 3. Write that number here') }}</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group d-flex ">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('15 amount-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('15 amount-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('15 amount-106AB')]) : Helper::priceFormtWithComma($finanicalTotal); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>
        </div>
        <!-- Part 4 -->
        <x-officialForm.partTitle
            title="{{ __('Part 4') }}"
            subTitle="{{ __('Describe Your Financial Assets') }}"
        ></x-officialForm.partTitle>
        <?php
        $financialassets = $property_info['financialassets'];
    // dump($financialassets);
    $final = [];
    if (!empty($financialassets)) {
        foreach ($financialassets as $financial) {
            //echo "<pre>"; print_r($financial);
            $f_type_data = json_decode($financial['type_data'], 1);
            if (!empty($f_type_data)) {
                //insurance_policies
                $financial['type_of_account'] = $f_type_data['type_of_account'] ?? '';
                $financial['description'] = (!empty($f_type_data['description'])) ? $f_type_data['description'] : "";
                $financial['property_value'] = (!empty($f_type_data['property_value'])) ? $f_type_data['property_value'] : "";
                $financial['account_type'] = (!empty($f_type_data['account_type'])) ? $f_type_data['account_type'] : "";
                $financial['owned_by'] = (!empty($f_type_data['owned_by'])) ? $f_type_data['owned_by'] : "";
                //print_r($f_type_data);
            }
            unset($financial['type_data']);
            $final[$financial['type']] = $financial;
        }
    }
    $totalFinanicalAssTotal = 0;

    $cash = (!empty($final['cash'])) ? $final['cash'] : [];

    $bank = (!empty($final['bank'])) ? $final['bank'] : [];

    $savings_account = (!empty($final['savings_account'])) ? $final['savings_account'] : [];

    $certificate_deposit = (!empty($final['certificate_deposit'])) ? $final['certificate_deposit'] : [];

    $other_financial_account = (!empty($final['other_financial_account'])) ? $final['other_financial_account'] : [];

    $mutual_funds_part4 = (!empty($final['mutual_funds'])) ? $final['mutual_funds'] : [];

    $traded_stocks_part4 = (!empty($final['traded_stocks'])) ? $final['traded_stocks'] : [];

    $government_corporate_bonds_part4 = (!empty($final['government_corporate_bonds'])) ? $final['government_corporate_bonds'] : [];

    $retirement_pension_part4 = (!empty($final['retirement_pension'])) ? $final['retirement_pension'] : [];

    $security_deposits_part4 = (!empty($final['security_deposits'])) ? $final['security_deposits'] : [];

    $prepayments_part4 = (!empty($final['prepayments'])) ? $final['prepayments'] : [];

    $annuities_part4 = (!empty($final['annuities'])) ? $final['annuities'] : [];

    $education_ira_part4 = (!empty($final['education_ira'])) ? $final['education_ira'] : [];

    $trusts_life_estates_part4 = (!empty($final['trusts_life_estates'])) ? $final['trusts_life_estates'] : [];

    $patents_copyrights_part4 = (!empty($final['patents_copyrights'])) ? $final['patents_copyrights'] : [];

    $licenses_franchises_part4 = (!empty($final['licenses_franchises'])) ? $final['licenses_franchises'] : [];

    $tax_refunds_part4 = (!empty($final['tax_refunds'])) ? $final['tax_refunds'] : [];

    $alimony_child_support_part4 = (!empty($final['alimony_child_support'])) ? $final['alimony_child_support'] : [];

    $unpaid_wages_part4 = (!empty($final['unpaid_wages'])) ? $final['unpaid_wages'] : [];

    $insurance_policies = (!empty($final['insurance_policies'])) ? $final['insurance_policies'] : [];

    $inheritances = (!empty($final['inheritances'])) ? $final['inheritances'] : [];

    $inheritances = (!empty($final['inheritances'])) ? $final['inheritances'] : [];

    $injury_claims = (!empty($final['injury_claims'])) ? $final['injury_claims'] : [];

    $lawsuits = (!empty($final['lawsuits'])) ? $final['lawsuits'] : [];

    $other_claims = (!empty($final['other_claims'])) ? $final['other_claims'] : [];

    $other_financial = (!empty($final['other_financial'])) ? $final['other_financial'] : [];
    ?>

        <div class="form-border mb-3">
            <div class="row bg-dgray align-items-center column-heading mb-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <strong>
                            {{ __('Do you own or have any legal or equitable interest in any of the
                            following?') }}
                        </strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <strong>{{ __('Current value of the portion you own?') }}</strong>
                        <label>Do not deduct secured claims
                            or exemptions</label>
                    </div>
                </div>
            </div>
            <!-- Row 16 -->
            <div class="row">
                <div class="col-md-12">
                    <label><strong class="d-block">{{ __('16. Cash') }}</strong>
                        <i class="text-bold">{{ __('Examples') }}</i>{{ __(': Money you have in your
                        wallet, in
                        your home, in a safe deposit box, and on hand when you file your
                        petition') }}
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('Check 16#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('Check 16#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 16#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $cash, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('Check 16#0-106AB'); ?>" value="yes" style="margin-right: 10px; align-self: flex-start;" type="checkbox" <?php echo isset($partAB[base64_encode('Check 16#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 16#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $cash, 1);?>>
                            {{ __('Yes') }}
                        </label>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="input-group hr_dotted">
                        <label>{{ __('Cash:') }}</label>
                    </div>
                </div>




            <?php
        $i = 0;
    if (!empty($cash['property_value']) && is_array($cash['property_value'])) {

        for ($i = 0;$i < count($cash['property_value']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $cash, $i);
            ?>

                <div class="col-md-3">
                    <div class="input-group d-flex ">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('16 Cash amount-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('16 Cash amount-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('16 Cash amount-106AB')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $cash, $i));?>" class="price-field ab_question form-control">
                    </div>
                </div>
            </div>

            <?php }
        } ?>
                <!-- Row 17  -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">{{ __('17. Deposits of money') }}</strong>
                        <i class="text-bold">{{ __('Examples') }}</i>{{ __(': Checking, savings, or other
                        financial accounts; certificates of deposit; shares in credit
                        unions, brokerage houses,
                        and other similar institutions. If you have multiple accounts
                        with
                        the same institution, list each.') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('Check 17#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('Check 17#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 17#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $bank, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('Check 17#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px; align-self: flex-start;" <?php echo isset($partAB[base64_encode('Check 17#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 17#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $bank, 1);?>>
                            {{ __('Yes') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php $i = 0;
    if (!empty($bank['description']) && is_array($bank['description'])) {
        $checking = 1;
        $saving = 1;
        $oterf = 1;
        $amount = '';
        for ($i = 0;$i < count($bank['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $bank, $i);
            $type_of_account = Helper::validate_key_loop_value('account_type', $bank, $i);
            $sub_label_17 = '';

            if ($checking == 1 && in_array($type_of_account, [Helper::CHECKING_ACNT,Helper::CHECKING_SAVING_ACNT])) {
                $checking = $checking + 1;
                $name = '17.1 Checking account-106AB';
                $amount = '17.1 Checking amount-106AB';
                $sub_label_17 = __("Institution name");
            } elseif ($checking > 1 && in_array($type_of_account, [Helper::CHECKING_ACNT,Helper::CHECKING_SAVING_ACNT])) {
                $name = '17.2 Checking account-106AB';
                $amount = '17.2 Checking amount-106AB';
                $sub_label_17 = '';
            } elseif ($saving == 1 && $type_of_account == Helper::SAVING_ACNT) {
                $name = '17.3 Checking account-106AB';
                $amount = '17.3 Checking amount-106AB';
                $sub_label_17 = '';
                $saving = $saving + 1;
            } elseif ($saving > 1 && $type_of_account == Helper::SAVING_ACNT) {
                $name = '17.4 Checking account-106AB';
                $amount = '17.4 Checking amount-106AB';
                $sub_label_17 = '';
            } elseif ($type_of_account == Helper::CERTIF_DEPT) {
                $name = '17.5 Certificates of deposit account-106AB';
                $amount = '17.5 Certificates of deposit amount-106AB';
                $sub_label_17 = '';
            } elseif ($oterf == 1 && in_array($type_of_account, [Helper::BROKERAGE_ACCOUNT, Helper::CREDIT_UNION,Helper::OTHER_FINANCIAL])) {
                $name = '17.6 Other financial account-106AB';
                $amount = '17.6 Other financial amount-106AB';
                $sub_label_17 = '';
                $oterf = 2;
            } elseif ($oterf == 2 && in_array($type_of_account, [Helper::BROKERAGE_ACCOUNT, Helper::CREDIT_UNION,Helper::OTHER_FINANCIAL])) {
                $name = '17.7 Other financial account-106AB';
                $amount = '17.7 Other financial amount-106AB';
                $sub_label_17 = '';
                $oterf = 3;
            } elseif ($oterf == 3 && in_array($type_of_account, [Helper::BROKERAGE_ACCOUNT, Helper::CREDIT_UNION,Helper::OTHER_FINANCIAL])) {
                $name = '17.8 Other financial account-106AB';
                $amount = '17.8 Other financial amount-106AB';
                $sub_label_17 = '';
                $oterf = 4;
            } elseif ($oterf == 4 && in_array($type_of_account, [Helper::BROKERAGE_ACCOUNT, Helper::CREDIT_UNION,Helper::OTHER_FINANCIAL])) {
                $name = '17.9 Other financial account-106AB';
                $amount = '17.9 Other financial amount-106AB';
                $sub_label_17 = '';
            }

            ?>
                    
                        <div class="row mb-1">
                            <div class="col-md-3"></div>
                            <div class="col-md-5">
                                <?php echo $sub_label_17;?>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <label for="">17.<?php echo $i + 1; ?> <?php echo ArrayHelper::getAccountKeyValue(Helper::validate_key_loop_value('account_type', $bank, $i)); ?>:</label>
                                </div>
                            </div>
                           
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-5" :textName="$name" :partAB="$partAB" :dataArray="$bank" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                           
                        </div>
                    <?php }
        } ?>
                </div>
            </div>

                <!-- Row 18 -->
                <!-- style="margin-right: 10px;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('18. Bonds, mutual funds, or publicly
                            traded stocks') }}</strong>
                            <i class="text-bold">{{ __('Examples') }}</i>{{ __(': Bond funds, investment
                            accounts with brokerage firms, money market accounts') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('Check 18#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('Check 18#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 18#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $mutual_funds_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('Check 18#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px; align-self: flex-start;" <?php echo isset($partAB[base64_encode('Check 18#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('Check 18#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $mutual_funds_part4, 1);?>>
                            {{ __('Yes') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $i = 0;
    if (!empty($mutual_funds_part4['description']) && is_array($mutual_funds_part4['description'])) {

        for ($i = 0;$i < count($mutual_funds_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $mutual_funds_part4, $i);
            $label_title = '';

            if ($i == 0) {
                $name = '18.1 Institution or issuer name-106AB';
                $amount = '18.1 Institution or issuer name 1 amount-106AB';
                $label_title = 'Institution or issuer name:';
            }
            if ($i == 1) {
                $name = '18.2 Institution or issuer name-106AB';
                $amount = '18.2 Institution or issuer name amount-106AB';
                $label_title = '';
            }
            if ($i == 2) {
                $name = '18.3 Institution or issuer name-106AB';
                $amount = '18.3 Institution or issuer name amount';
                $label_title = '';
            }
            ?>
                        <div class="row mb-1">
                            <div class="col-md-8">
                                <?php echo $label_title;?>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row mb-1">
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$mutual_funds_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>


                <!-- Row 19 -->
            <!-- style="margin-right: 10px;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('19. Non-publicly traded stock and
                            interests in incorporated and unincorporated businesses,
                            including an interest in
                            an LLC, partnership, and joint venture') }}</strong>
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-2 mt-2">
                    <div class="input-group">
                        <label>
                        <input name="<?php echo base64_encode('check 19#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 19#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 19#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $traded_stocks_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('Check 19#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px; align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 19#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 19#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $mutual_funds_part4, 1);?>>
                            {{ __('Yes. Give specific information about them') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10 mt-2">
                    <?php
        $i = 0;
    if (!empty($traded_stocks_part4['description']) && is_array($traded_stocks_part4['description'])) {

        for ($i = 0;$i < count($traded_stocks_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $traded_stocks_part4, $i);
            $label_eternity = '';
            $label_percentage = '';
            if ($i == 0) {
                $name = '19.1 Name of entity-106AB';
                $interest = '19.1 % of ownership-106AB';
                $amount = '19.1 amount-106AB';
                $label_eternity = 'Name of entity:';
                $label_percentage = '% of ownership:';
            }
            if ($i == 1) {
                $name = '19.2 Name of entity-106AB';
                $interest = '19.2 % of ownership-106AB';
                $amount = '19.2 amount-106AB';
                $label_eternity = '';
                $label_percentage = '';
            }
            if ($i == 2) {
                $name = '19.3 Name of entity-106AB';
                $interest = '19.3 % of ownership-106AB';
                $amount = '19.3 amount-106AB';
                $label_eternity = '';
                $label_percentage = '';
            }
            ?>
                    <div class="row mb-1">
                        <div class="col-md-6">
                            <?php echo $label_eternity;?>
                        </div>
                        <div class="col-md-2">

                            <?php echo $label_percentage;?>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input name="<?php echo base64_encode($name); ?>" type="text" value="<?php echo $partAB[base64_encode($name)] ?? Helper::validate_key_loop_value('description', $traded_stocks_part4, $i);?>" class="ab_question form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group d-flex">
                                <input name="<?php echo base64_encode($interest); ?>" type="number" value="<?php echo $partAB[base64_encode($interest)] ?? Helper::validate_key_loop_value('type_of_account', $traded_stocks_part4, $i);?>" class="ab_question form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input name="<?php echo base64_encode($amount); ?>" type="text" value="<?php echo isset($partAB[base64_encode($amount)]) ? Helper::priceFormtWithComma($partAB[base64_encode($amount)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $traded_stocks_part4, $i));?>" class="price-field ab_question form-control">
                            </div>
                        </div>
                    </div>
                    <?php  }
    } ?>
                </div>
            </div>


                <!-- Row 20 -->

            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('20. Government and corporate bonds
                            and other negotiable and non-negotiable instruments') }}
                        </strong>
                        <i>{{ __('Negotiable instruments') }}</i> {{ __('include personal checks, cashiers’
                        checks,
                        promissory notes, and money orders.') }}<br>
                        <i>{{ __('Non-negotiable instruments') }}</i> {{ __('are those you cannot transfer to
                        someone
                        by signing or delivering them.') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 20#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 20#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 20#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $government_corporate_bonds_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 20#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px; align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 20#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 20#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $government_corporate_bonds_part4, 1);?>>
                            {{ __('Yes. Give specific information about them') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
    $i = 0;
    if (!empty($government_corporate_bonds_part4['description']) && is_array($government_corporate_bonds_part4['description'])) {

        for ($i = 0;$i < count($government_corporate_bonds_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $government_corporate_bonds_part4, $i);
            $label_title = '';
            if ($i == 0) {
                $label_title = 'Issuer name:';
            }
            if ($i == 1) {
                $label_title = '';
            }
            if ($i == 2) {
                $label_title = '';
            }
            ?>
                        <x-officialForm.abSchedule.part4QuestionLabelTitle
                            class="col-md-8" class1="col-md-0" :label_title="$label_title"
                        >
                        </x-officialForm.abSchedule.part4QuestionLabelTitle>
                        <div class="row mb-1">
                            @php
                            $name = '20.'.($i+1).' Issuer name-106AB';
                            $amount = '20.'.($i+1).' Issuer name amount-106AB';
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$government_corporate_bonds_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>
            <!-- Row 21 -->

            <!-- style="margin-right: 10px; align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('21. Retirement or pension
                            accounts') }}
                        </strong>
                        <i>{{ __('Examples:') }}</i> {{ __('Interests in IRA, ERISA, Keogh, 401(k), 403(b), thrift
                        savings accounts, or other pension or profit-sharing
                        plans') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 21#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 21#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 21#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $retirement_pension_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 21#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px; align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 21#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 21#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $retirement_pension_part4, 1);?>>
                            {{ __('Yes. List each account separately') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $i = 0;
    $additional = 0;
    if (!empty($retirement_pension_part4['description']) && is_array($retirement_pension_part4['description'])) {

        for ($i = 0;$i < count($retirement_pension_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $retirement_pension_part4, $i);
            $label_title = '';
            $typeOfAccount = Helper::validate_key_loop_value('type_of_account', $retirement_pension_part4, $i);
            if ($i == 0) {
                $label_title = 'Institution name:';
            }
            if ($typeOfAccount == Helper::ACT_TYPE_401K) {
                $name = '21.1 401k or similar plan-106AB';
                $amount = '21.1 401k or similar plan amount-106AB';
                $label_title = '';
            }
            if ($typeOfAccount == Helper::ACT_TYPE_PENSION_PLAN) {
                $name = '21.2 Pension plan-106AB';
                $amount = '21.2 Pension plan amount-106AB';
                $label_title = '';
            }
            if ($typeOfAccount == Helper::ACT_TYPE_IRA) {
                $name = '21.3 IRA-106AB';
                $amount = '21.3 IRA amount-106AB';
                $label_title = '';
            }
            if ($typeOfAccount == Helper::ACT_TYPE_RETIREMENT) {
                $name = '21.4 Retirement account-106AB';
                $amount = '21.4 Retirement account amount-106AB';
                $label_title = '';
            }
            if ($typeOfAccount == Helper::ACT_TYPE_KEOGH) {
                $name = '21.5 Keogh-106AB';
                $amount = '21.5 Keogh amount-106AB';
                $label_title = '';
            }
            if ($typeOfAccount == Helper::ACT_TYPE_ADDITIONAL && $additional == 1) {
                $name = '21.6 Additional account-106AB';
                $amount = '21.6 Additional account amount-106AB';
                $label_title = '';
                $additional = $additional + 1;
            }
            if ($additional > 1 && $typeOfAccount == Helper::ACT_TYPE_ADDITIONAL) {
                $name = '21.7 Additional account-106AB';
                $amount = '21.7 Additional account amount-106AB';
                $label_title = '';
            }
            ?>
                        <x-officialForm.abSchedule.part4QuestionLabelTitle
                            class="col-md-5" class1="col-md-3" :label_title="$label_title"
                        >
                        </x-officialForm.abSchedule.part4QuestionLabelTitle>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <label for="">
                                        <?php
                                $selected = isset($retirement_pension_part4['type_of_account']) && isset($retirement_pension_part4['type_of_account'][$i]) ? $retirement_pension_part4['type_of_account'][$i] : '';
            echo ArrayHelper::accountTypeArray($selected);
            ?>:
                                    </label>
                                </div>
                            </div>
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-5" :textName="$name" :partAB="$partAB" :dataArray="$retirement_pension_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>






                <!-- Row 22 -->


            <!-- style="margin-right: 10px; align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">{{ __('22. Security deposits and
                            prepayments') }}
                        </strong>
                        {{ __('Your share of all unused deposits you have made so that you may
                        continue service or use from a company') }}<br>
                        <i>{{ __('Examples:') }}</i> {{ __('Agreements with landlords, prepaid rent, public
                        utilities
                        (electric, gas, water), telecommunications
                        companies, or others') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                        <input name="<?php echo base64_encode('check 22#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 22#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 22#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $security_deposits_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                        <input name="<?php echo base64_encode('check 22#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px; align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 22#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 22#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $security_deposits_part4, 1);?>>
                            {{ __('Yes') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $i = 0;
    if (!empty($security_deposits_part4['description']) && is_array($security_deposits_part4['description'])) {

        for ($i = 0;$i < count($security_deposits_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $security_deposits_part4, $i);
            $label_title = '';
            $accountType = Helper::validate_key_loop_value('type_of_account', $security_deposits_part4, $i);
            if ($accountType == 1) {
                $name = '22.1 Electric-106AB';
                $amount = '22.1 Electric amount-106AB';
                $label_title = 'Institution name or individual:';
            }
            if ($accountType == 2) {
                $name = '22.2 Gas-106AB';
                $amount = '22.2 Gas amount-106AB';
                $label_title = '';
            }
            if ($accountType == 8) {
                $name = '22.3 Heating oil';
                $amount = '22.3 Heating oil amount-106AB';
                $label_title = '';
            }
            if ($accountType == 3) {
                $name = '22.4 Security deposit on rental unit-106AB';
                $amount = '22.4 Security deposit on rental unit amount-106AB';
                $label_title = '';
            }
            if ($accountType == 4) {
                $name = '22.5 Prepaid rent-106AB';
                $amount = '22.5 Prepaid rent amount-106AB';
                $label_title = '';
            }
            if ($accountType == 5) {
                $name = '22.6 Telephone-106AB';
                $amount = '22.6 Telephone amount-106AB';
                $label_title = '';
            }
            if ($accountType == 6) {
                $name = '22.7 Water-106AB';
                $amount = '22.7 Water amount-106AB';
                $label_title = '';
            }
            if ($accountType == 7) {
                $name = '22.8 Rented furniture-106AB';
                $amount = '22.8 Rented furniture amount-106AB';
                $label_title = '';
            }
            if ($accountType == 9) {
                $name = '22.9 Other-106AB';
                $amount = '22.9 Other amount-106AB';
                $label_title = '';
            }
            ?>
                        <x-officialForm.abSchedule.part4QuestionLabelTitle
                            class="col-md-5" class1="col-md-3" :label_title="$label_title"
                        >
                        </x-officialForm.abSchedule.part4QuestionLabelTitle>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <label for="">
                                        <?php
                                $selected = isset($security_deposits_part4['type_of_account']) && isset($security_deposits_part4['type_of_account'][$i]) ? $security_deposits_part4['type_of_account'][$i] : '';
            echo ArrayHelper::securityDepositedArray($selected);
            ?>: </label>
                                </div>
                            </div>
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-5" :textName="$name" :partAB="$partAB" :dataArray="$security_deposits_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>

                <!-- Row 23 -->


            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('23. Annuities') }}
                        </strong>
                        {{ __('(A contract for a periodic payment of money to you, either for
                        life or for a number of years)') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 23#0106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 23#0106AB')]) ? Helper::validate_key_toggle(base64_encode('check 23#0106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $annuities_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 23#0106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px; align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 23#0106AB')]) ? Helper::validate_key_toggle(base64_encode('check 23#0106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $annuities_part4, 1);?>>
                            {{ __('Yes') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
            $i = 0;
    if (!empty($annuities_part4['description']) && is_array($annuities_part4['description'])) {

        for ($i = 0;$i < count($annuities_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $annuities_part4, $i);
            $label_title = '';
            if ($i == 0) {
                $label_title = 'Institution name or individual:';
            }
            if ($i == 1) {
                $label_title = '';
            }
            if ($i == 2) {
                $label_title = '';
            }
            ?>
                        <div class="row mb-1">
                            <div class="col-md-8">
                                <?php echo $label_title;?>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row mb-1">
                            @php
                                $name = '23.'.($i+1).' Annuities-106AB';
                                $amount = '23.'.($i+1).' Annuities amount-106AB';
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$annuities_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>




                <!-- Row 24 -->

            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('24. Interests in an education IRA, in an
                            account in a qualified ABLE program, or under a qualified
                            state tuition program') }}
                        </strong>
                        {{ __('26 U.S.C. §§ 530(b)(1), 529A(b), and 529(b)(1).') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 24#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 24#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 24#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $education_ira_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                        <input name="<?php echo base64_encode('check 24#0-106AB'); ?>" value="yes"  type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 24#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 24#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $education_ira_part4, 1);?>>
                            {{ __('Yes') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                <?php
                    $i = 0;
    if (!empty($education_ira_part4['description']) && is_array($education_ira_part4['description'])) {

        for ($i = 0;$i < count($education_ira_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $education_ira_part4, $i);
            $label_title = '';
            if ($i == 0) {
                $name = '24.1 Interest in an education IRA#0-106AB';
                $amount = '24.1 Interest in an education IRA amount-106AB';
                $label_title = 'Institution name and description. Separately file the
                                            records of any interests.11 U.S.C. § 521(c):';
            }
            if ($i == 1) {
                $name = '24.2 Interest in an education IRA#0-106AB';
                $amount = '24.2 Interest in an education IRA-106AB';
            }
            if ($i == 2) {
                $name = '24.3 Interest in an education IRA#0-106AB';
                $amount = '24.3 Interest in an education IRA-106AB';
            }
            ?>
                    <div class="row mb-1">
                        <div class="col-md-8">
                            <?php echo $label_title;?>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row mb-1">
                        <x-officialForm.abSchedule.part4QuestionCommon
                            class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$education_ira_part4" :i="$i" :amountName="$amount"
                        >
                        </x-officialForm.abSchedule.part4QuestionCommon>
                    </div>
                <?php }
        }?>
                </div>
            </div>



                <!-- Row 25 -->

            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('25. Trusts, equitable or future interests
                            in property (other than anything listed in line 1), and
                            rights or powers
                            exercisable for your benefit') }}
                        </strong>
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 25#1-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 25#1-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 25#1-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $trusts_life_estates_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 25#1-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 25#1-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 25#1-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $trusts_life_estates_part4, 1);?>>
                            {{ __('Yes Give specific information about them') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
            $i = 0;
    if (!empty($trusts_life_estates_part4['description']) && is_array($trusts_life_estates_part4['description'])) {

        for ($i = 0;$i < count($trusts_life_estates_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $trusts_life_estates_part4, $i);
            ?>
                        <div class="row mb-1">
                            @php
                                $name = '25 Trusts, equitable or future interests in property-106AB';
                                $amount = '25 Trusts, equitable or future interests in property amount-106AB';
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$trusts_life_estates_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>

                <!-- Row 26 -->
            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('26. Patents, copyrights, trademarks,
                            trade secrets, and other intellectual
                            property') }}
                        </strong>
                        <i>{{ __('Examples:') }}</i>
                        {{ __('Internet domain names, websites, proceeds from royalties and
                        licensing agreements') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 26#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 26#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 26#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $patents_copyrights_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 26#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 26#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 26#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $patents_copyrights_part4, 1);?>>
                            {{ __('Yes. Give specific information about them.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $i = 0;
    if (!empty($patents_copyrights_part4['description']) && is_array($patents_copyrights_part4['description'])) {

        for ($i = 0;$i < count($patents_copyrights_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $patents_copyrights_part4, $i);
            ?>
                        <div class="row mb-1">
                            @php
                                $name = '26 Patents, copyrights, trademarks, trade secrets-106AB';
                                $amount = '26 Patents, copyrights, trademarks, trade secrets amount-106AB';
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$patents_copyrights_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>


                <!-- Row 27 -->

            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('27. Licenses, franchises, and other
                            general intangibles') }}
                        </strong>
                        <i>{{ __('Examples:') }}</i>
                            {{ __('Building permits, exclusive licenses, cooperative
                            association holdings, liquor licenses, professional
                            licenses') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 27#0106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 27#0106AB')]) ? Helper::validate_key_toggle(base64_encode('check 27#0106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $licenses_franchises_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 27#0106AB'); ?>" value="On" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 27#0106AB')]) ? Helper::validate_key_toggle(base64_encode('check 24#0106AB'), $partAB, 'On') : Helper::validate_key_toggle('type_value', $licenses_franchises_part4, 1);?>>
                            {{ __('Yes. Give specific information about them.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row mb-1">
                        <div class="col-md-8">
                            <div class="input-group mb-0">
                                <div class="input-group mb-0">
                                    <textarea name="<?php echo base64_encode('27 Liscenses, Franchises-106AB'); ?>" class="noadjust ab_question form-control" rows="2"><?php echo $partAB[base64_encode('27 Liscenses, Franchises-106AB')] ?? Helper::validate_key_loop_value('description', $licenses_franchises_part4, $i);?></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input  name="<?php echo base64_encode('27 Liscenses, Franchises amount-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('27 Liscenses, Franchises amount-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('27 Liscenses, Franchises amount-106AB')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $licenses_franchises_part4, $i));?>" class="price-field ab_question form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Money or property owed to you? -->
            <div class="row align-items-center column-heading mt-3 mb-3 bg-dgray">
                <div class="col-md-8">
                    <div class="input-group">
                            <strong style="align-self: flex-start;">
                                {{ __('Money or property owed to you?') }}
                            </strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <strong>{{ __('Current value of the portion you own?') }}</strong>
                        <label>Do not deduct secured claims
                            or exemptions</label>
                    </div>
                </div>
            </div>
            <!-- Row 28 -->

            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('28. Tax refunds owed to you') }}
                        </strong>
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 28#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 28#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 28#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $tax_refunds_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 28#0-106AB'); ?>" value="On" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 28#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 28#0-106AB'), $partAB, 'On') : Helper::validate_key_toggle('type_value', $tax_refunds_part4, 1);?>>
                            {{ __('Yes. Give specific information
                            about them, including whether
                            you already filed the returns
                            and the tax years') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row mb-1">
                        <div class="col-md-6 mb-1">
                            <div class="input-group mb-0">
                                <textarea maxlength="500" name="<?php echo base64_encode('28 Tax refunds owed-106AB'); ?>" class="noadjust ab_question form-control" rows="5"><?php
                        if (isset($partAB[base64_encode('28 Tax refunds owed-106AB')]) && !empty($partAB[base64_encode('28 Tax refunds owed-106AB')])) {
                            echo $partAB[base64_encode('28 Tax refunds owed-106AB')];
                        } else {
                            echo Helper::validate_key_loop_value('description', $tax_refunds_part4, 0)."\r\n";
                            echo Helper::validate_key_loop_value('description', $tax_refunds_part4, 1)."\r\n";
                            echo Helper::validate_key_loop_value('description', $tax_refunds_part4, 2)."\r\n";
                        }
    ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('Federal:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('28 Tax refunds owed amout1-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('28 Tax refunds owed amout1-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('28 Tax refunds owed amout1-106AB')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $tax_refunds_part4, 0));?>" class="price-field ab_question form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('State:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('28 Tax refunds owed amout2-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('28 Tax refunds owed amout2-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('28 Tax refunds owed amout2-106AB')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $tax_refunds_part4, 1));?>" class="price-field ab_question form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('Local:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('28 Tax refunds owed amout3-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('28 Tax refunds owed amout3-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('28 Tax refunds owed amout3-106AB')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $tax_refunds_part4, 2));?>" class="price-field ab_question form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Row 29 -->


            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('29. Family support') }}
                        </strong>
                        <i>{{ __('Examples:') }}</i>
                        {{ __('Past
                        due or lump sum alimony, spousal support, child support,
                        maintenance, divorce settlement, property settlement') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 29#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 29#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 29#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $alimony_child_support_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 29#0-106AB'); ?>" value="On" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 29#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 29#0-106AB'), $partAB, 'On') : Helper::validate_key_toggle('type_value', $alimony_child_support_part4, 1);?>>
                            {{ __('Yes. Give specific information') }}
                        </label>
                    </div>
                </div>

                <div class="col-md-10">
                                        <?php
        $alomeny = [];
    if (isset($alimony_child_support_part4['account_type']) && is_array($alimony_child_support_part4['account_type'])) {
        foreach ($alimony_child_support_part4['account_type'] as $key => $val) {
            $alomeny[$val] = ['type' => $val, 'desc' => $alimony_child_support_part4['description'][$key], 'property_value' => $alimony_child_support_part4['property_value'][$key] ?? 'Unknown' ];
        }
    }

    $finalAlmoy = [];
    foreach (array_keys(ArrayHelper::getFinancialPropArray()) as $tpe) {
        $finalAlmoy[$tpe] = $alomeny[$tpe] ?? ['type' => $tpe, 'desc' => '', 'property_value' => ''];

    }


    ?>


                    <div class="row mb-1">
                        <div class="col-md-6 mb-1">
                            <div class="input-group mb-0">
                                <textarea maxlength="500" name="<?php echo base64_encode('29 Family support-106AB'); ?>" class="noadjust ab_question form-control" rows="9"><?php
                                if (isset($partAB[base64_encode('29 Family support-106AB')]) && !empty($partAB[base64_encode('29 Family support-106AB')])) {
                                    echo $partAB[base64_encode('29 Family support-106AB')];
                                } else {
                                    foreach ($finalAlmoy as $val) {
                                        echo ArrayHelper::getFinancialProp($val['type']).' - '.(!empty($val['desc']) ? $val['desc'].';' : '')."\r\n";
                                    }

                                }?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('Alimony:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('29 Family support amount1-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('29 Family support amount1-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('29 Family support amount1-106AB')]) : ($finalAlmoy[1]['property_value'] == 'Unknown' ? $finalAlmoy[1]['property_value'] : Helper::priceFormtWithComma($finalAlmoy[1]['property_value']));?>" class="price-field1 ab_question form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('Maintenance:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('29 Family support amount2-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('29 Family support amount2-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('29 Family support amount2-106AB')]) : ($finalAlmoy[2]['property_value'] == 'Unknown' ? $finalAlmoy[2]['property_value'] : Helper::priceFormtWithComma($finalAlmoy[2]['property_value']));?>" class="price-field2 ab_question form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('Support:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('29 Family support amount3'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('29 Family support amount3')]) ? Helper::priceFormtWithComma($partAB[base64_encode('29 Family support amount3')]) : ($finalAlmoy[3]['property_value'] == 'Unknown' ? $finalAlmoy[3]['property_value'] : Helper::priceFormtWithComma($finalAlmoy[3]['property_value']));?>" class="price-field2 ab_question form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('Divorce settlement:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('29 Family support amount4-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('29 Family support amount4-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('29 Family support amount4-106AB')]) : ($finalAlmoy[4]['property_value'] == 'Unknown' ? $finalAlmoy[4]['property_value'] : Helper::priceFormtWithComma($finalAlmoy[4]['property_value']));?>" class="price-field2 ab_question form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-1">
                                    <div class="input-group mb-0">
                                        <label>{{ __('Property settlement:') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-1">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('29 Family support amount5-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('29 Family support amount5-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('29 Family support amount5-106AB')]) : ($finalAlmoy[5]['property_value'] == 'Unknown' ? $finalAlmoy[5]['property_value'] : Helper::priceFormtWithComma($finalAlmoy[5]['property_value']));?>" class="price-field2 ab_question form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Row 30 -->


            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('30.Other amounts someone owes
                            you') }}
                        </strong>
                        <i>{{ __('Examples:') }}</i>
                        {{ __('Unpaid wages, disability insurance payments, disability
                        benefits,
                        sick pay, vacation pay, workers’ compensation,
                        Social Security benefits; unpaid loans you made to someone
                        else') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 30#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 30#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 30#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $unpaid_wages_part4, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 30#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 30#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 30#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $unpaid_wages_part4, 1);?>>
                            {{ __('Yes. Give specific information.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
                        $i = 0;
    if (isset($unpaid_wages_part4['description']) && !empty($unpaid_wages_part4['description']) && is_array($unpaid_wages_part4['description'])) {

        for ($i = 0;$i < count($unpaid_wages_part4['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $unpaid_wages_part4, $i);
            ?>
                        <div class="row mb-1">
                            @php
                                $name = "Info_107-106AB";
                                $amount = "Inform_108-106AB";
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$unpaid_wages_part4" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>

                    <?php }
        } ?>
                </div>
            </div>



                <!-- Row 31 -->

            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('31. Interests in insurance
                            policies') }}
                        </strong>
                        <i>{{ __('Examples:') }}</i> {{ __('Health, disability, or life insurance; health savings
                        account (HSA); credit, homeowner’s, or renter’s
                        insurance') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input  name="<?php echo base64_encode('check 31#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 31#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 31#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $insurance_policies, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input  name="<?php echo base64_encode('check 31#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 31#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 31#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $insurance_policies, 1);?>>
                            {{ __('Yes. Give specific information.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $j = 0;
    $companyName = '';
    $benneficiaryName = '';
    $amount = '';
    if (isset($insurance_policies['description']) && !empty($insurance_policies['description']) && is_array($insurance_policies['description'])) {

        for ($i = 0;$i < count($insurance_policies['description']);$i++) {

            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $insurance_policies, $i);
            if ($i == 0) {
                $companyName = 'Company name 1-106AB';
                $benneficiaryName = 'Beneficiary 1-106AB';
                $amount = 'Benneficiary_109-106AB';
            }
            if ($i == 1) {
                $companyName = 'Company name 2-106AB';
                $benneficiaryName = 'Beneficiary 2-106AB';
                $amount = 'Beneficiary_110-106AB';
            }
            if ($i == 2) {
                $companyName = 'Company name 3-106AB';
                $benneficiaryName = 'Beneficiary 3-106AB';
                $amount = 'Beneficiary_111-106AB';
            }
            ?>
                        <div class="row mb-1">

                            <div class="col-md-4">
                                <div class="input-group">
                                <?php if ($i == 0) {?>
                                    <div class="mb-1">
                                        <label class="mb-1" for="">{{ __('Company name:') }} </label>
                                    </div>
                                    <?php } ?>
                                    <input name="<?php echo base64_encode($companyName) ?>" type="text" value="<?php echo $partAB[base64_encode($companyName)] ?? Helper::validate_key_loop_value('type_of_account', $insurance_policies, $i);?>" class="ab_question form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group">
                                <?php if ($i == 0) {?>
                                    <div class="mb-1">
                                        <label class="mb-1" for="">{{ __('Beneficiary:') }} </label>
                                    </div>
                                    <?php } ?>
                                    <input name="<?php echo base64_encode($benneficiaryName)?>" type="text" value="<?php echo $partAB[base64_encode($benneficiaryName)] ?? Helper::validate_key_loop_value('description', $insurance_policies, $i);?>" class="ab_question form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-0">
                                <?php if ($i == 0) {?>
                                    <div class="mb-1">
                                        <label class="mb-1" for="">{{ __('Surrender or refund value:') }}</label>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="input-group d-flex">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>

                                    <input name="<?php echo base64_encode($amount) ?>" type="text" value="<?php echo isset($partAB[base64_encode($amount)]) ? Helper::priceFormtWithComma($partAB[base64_encode($amount)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $insurance_policies, $i));?>" class="price-field form-control">
                                </div>
                            </div>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>




                <!-- Row 32 -->

                <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('32. Any interest in property that is
                            due
                            you from someone who has died') }}
                        </strong>
                        {{ __('If you are the
                        beneficiary
                        of a living trust, expect proceeds from a life insurance policy,
                        or
                        are currently entitled to receive
                        property because someone has died.') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 32#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 32#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 32#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $inheritances, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 32#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 32#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 32#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $inheritances, 1);?>>
                            {{ __('Yes. Give specific information.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $i = 0;
    if (!empty($inheritances['description']) && is_array($inheritances['description'])) {

        for ($i = 0;$i < count($inheritances['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $inheritances, $i);
            ?>
                        <div class="row mb-1">
                            @php
                                $name = "32 Interest in property due you from someone who died-106AB";
                                $amount = "INFORMA_114-106AB";
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$inheritances" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>




                <!-- Row 33 -->
                <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('33. Claims against third parties,
                            whether or not you have filed a lawsuit or made a demand for
                            payment') }}
                        </strong>
                        <i>{{ __('Examples:') }}</i> {{ __('Accidents, employment disputes,
                        insurance claims, or rights to sue') }}
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 33#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 33#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 33#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $injury_claims, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 33#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 33#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 33#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $injury_claims, 1);?>>
                            {{ __('Yes. Describe each claim.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $i = 0;
    if (!empty($injury_claims['description']) && is_array($injury_claims['description'])) {

        for ($i = 0;$i < count($injury_claims['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $injury_claims, $i);
            ?>
                        <div class="row mb-1">
                            @php
                                $name = "33-106AB";
                                $amount = "Claim_117-106AB";
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$injury_claims" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>

                <!-- Row 34 -->
            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('34. Other contingent and unliquidated
                            claims of every nature, including counterclaims of the
                            debtor
                            and rights
                            to set off claims') }}
                        </strong>
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                        <input  name="<?php echo base64_encode('check 34#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 34#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 34#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $other_claims, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                        <input  name="<?php echo base64_encode('check 34#0-106AB'); ?>" value="On" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 34#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 34#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $other_claims, 1);?>>
                            {{ __('Yes. Describe each claim.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
        $i = 0;
    if (!empty($other_claims['description']) && is_array($other_claims['description'])) {

        for ($i = 0;$i < count($other_claims['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $other_claims, $i);
            ?>
                        <div class="row">
                            @php
                                $name = "34-106AB";
                                $amount = "INF_120-106AB";
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$other_claims" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>


                <!-- Row 35 -->

            <!-- style="margin-right: 10px;  align-self: flex-start;" -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label>
                        <strong class="d-block">
                            {{ __('35. Any financial assets you did not already list') }}
                        </strong>
                    </label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label>
                            <input name="<?php echo base64_encode('check 35#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 35#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 35#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $other_financial, 0);?>>
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <label class="hr_dotted">
                            <input name="<?php echo base64_encode('check 35#0-106AB'); ?>" value="yes" type="checkbox" style="margin-right: 10px;  align-self: flex-start;" <?php echo isset($partAB[base64_encode('check 35#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 35#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $other_financial, 1);?>>
                            {{ __('Yes. Give specific information.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                   <?php
        $i = 0;
    if (!empty($other_financial['description']) && is_array($other_financial['description'])) {

        for ($i = 0;$i < count($other_financial['description']);$i++) {
            $totalFinanicalAssTotal += (float)Helper::validate_key_loop_value('property_value', $other_financial, $i);
            ?>
                        <div class="row">
                            @php
                                $name = "35-106AB";
                                $amount = "undefined_123-106AB";
                            @endphp
                            <x-officialForm.abSchedule.part4QuestionCommon
                                class="col-md-8" :textName="$name" :partAB="$partAB" :dataArray="$other_financial" :i="$i" :amountName="$amount"
                            >
                            </x-officialForm.abSchedule.part4QuestionCommon>
                        </div>
                    <?php }
        } ?>
                </div>
            </div>
            <x-officialForm.abSchedule.partTotalValueBox
                questionNumber="36"
                question="{{ __('Add the dollar value of all of  your  entries from Part 4, including any entries for pages you have attached for Part 4. Write that number here') }}"
                name="<?php echo base64_encode('DollarValue_124-106AB'); ?>"
                value="{{ isset($partAB[base64_encode('DollarValue_124-106AB')])
                    ? Helper::priceFormtWithComma($partAB[base64_encode('DollarValue_124-106AB')])
                    : Helper::priceFormtWithComma($totalFinanicalAssTotal) }}"
            ></x-officialForm.abSchedule.partTotalValueBox>
        </div>

        <x-officialForm.partTitle
            title="{{ __('Part 5') }}"
            subTitle="{{ __('Describe Any Business-Related Property You Own or Have an Interest In. List any real estate in Part 1.') }}"
        ></x-officialForm.partTitle>
        <?php
        $businessassets = $property_info['businessassets'];
    // dump($businessassets);
    $final = [];
    if (!empty($businessassets)) {
        foreach ($businessassets as $business) {
            $b_type_data = json_decode($business['type_data'], 1);
            if (!empty($b_type_data)) {
                $business['description'] = (!empty($b_type_data['description'])) ? $b_type_data['description'] : "";
                $business['property_value'] = (!empty($b_type_data['property_value'])) ? $b_type_data['property_value'] : "";
                $business['owned_by'] = (!empty($b_type_data['owned_by'])) ? $b_type_data['owned_by'] : "";
                $business['type_of_account'] = (!empty($b_type_data['type_of_account'])) ? $b_type_data['type_of_account'] : "";

            }
            unset($business['type_data']);
            $final[$business['type']] = $business;
        }
    }
    // echo "<pre>{{ __('";print_r($final);echo"') }}</pre>";
    $totalBRProperty = 0;
    $commissions = (!empty($final['commissions'])) ? $final['commissions'] : [];
    if (Helper::validate_key_value('type_value', $commissions)) {
        $totalBRProperty += (float)Helper::validate_key_value('property_value', $commissions);
    }
    $office_equipment = (!empty($final['office_equipment'])) ? $final['office_equipment'] : [];
    if (Helper::validate_key_value('type_value', $office_equipment)) {
        $totalBRProperty += (float)Helper::validate_key_value('property_value', $office_equipment);
    }
    $machinery_fixtures = (!empty($final['machinery_fixtures'])) ? $final['machinery_fixtures'] : [];
    if (Helper::validate_key_value('type_value', $machinery_fixtures)) {
        $totalBRProperty += (float)Helper::validate_key_value('property_value', $machinery_fixtures);
    }
    $business_inventory = (!empty($final['business_inventory'])) ? $final['business_inventory'] : [];
    if (Helper::validate_key_value('type_value', $business_inventory)) {
        $totalBRProperty += (float)Helper::validate_key_value('property_value', $business_inventory);
    }
    $interests = (!empty($final['interests'])) ? $final['interests'] : [];

    $customer_mailing = (!empty($final['customer_mailing'])) ? $final['customer_mailing'] : [];
    if (Helper::validate_key_value('type_value', $customer_mailing)) {
        $totalBRProperty += (float)Helper::validate_key_value('property_value', $customer_mailing);
    }
    $other_business = (!empty($final['other_business'])) ? $final['other_business'] : [];

    $value_yes_38_part_5 = Helper::validate_key_value('type_value', $commissions);
    $value_yes_39_part_5 = Helper::validate_key_value('type_value', $office_equipment);
    $value_yes_40_part_5 = Helper::validate_key_value('type_value', $machinery_fixtures);
    $value_yes_41_part_5 = Helper::validate_key_value('type_value', $business_inventory);
    $value_yes_42_part_5 = Helper::validate_key_value('type_value', $interests);
    $value_yes_43_part_5 = Helper::validate_key_value('type_value', $customer_mailing);
    $value_yes_44_part_5 = Helper::validate_key_value('type_value', $other_business);

    $value_yes_part_5 = ($value_yes_38_part_5 || $value_yes_39_part_5 || $value_yes_40_part_5 || $value_yes_41_part_5 || $value_yes_42_part_5 || $value_yes_43_part_5 || $value_yes_44_part_5);
    $value_yes_37_part_5 = '';
    $value_no_37_part_5 = '';
    if ($value_yes_part_5 == 1) {
        $value_yes_37_part_5 = "checked='checked'";
        $value_no_37_part_5 = "";
    }
    if ($value_yes_part_5 == 0) {
        $value_yes_37_part_5 = "";
        $value_no_37_part_5 = "checked='checked'";
    }

    //miscellaneous
    ?>


        <div class="form-border mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('37. Do you own or have any legal or
                                    equitable
                                    interest in any business-related property?') }}</strong>
                            </label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 37#0-106AB'); ?>" value="no" <?php echo isset($partAB[base64_encode('check 37#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 37#0-106AB'), $partAB, 'no') : $value_no_37_part_5; ?> type="checkbox">
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 37#0-106AB'); ?>" value="yes" <?php echo isset($partAB[base64_encode('check 37#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 37#0-106AB'), $partAB, 'yes') : $value_yes_37_part_5; ?> type="checkbox" >
                            <label>{{ __('Yes') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row 38 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 38#0-106AB" :partAB="$partAB" :household_goods="$commissions"
                descriptionName="38 Accounts receivable or commissions already earned-106AB"
                descriptionAmount="Describe_125-106AB"
            >
                <strong class="d-block">{{ __('38. Accounts receivable or commissions you already earned') }}</strong>
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 39 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="39#0-106AB" :partAB="$partAB" :household_goods="$office_equipment"
                descriptionName="39 Office equipment furnishings and supplies-106AB"
                descriptionAmount="Describe_126-106AB"
            >
                <strong class="d-block">{{ __('39. Office equipment, furnishings, and supplies') }}</strong>
                {{ __('Examples: Business-related computers, software, modems, printers, copiers, fax machines, rugs, telephones, desks,chairs,electronic devices') }}
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 40 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 40#0-106AB" :partAB="$partAB" :household_goods="$machinery_fixtures"
                descriptionName="40 Machinery fixtures equipment and tools of your trade-106AB"
                descriptionAmount="Describe_127-106AB"
            >
                <strong class="d-block">{{ __('40. Machinery, fixtures, equipment,
                    supplies you use in business, and tools of your trade') }}
                </strong>
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 41 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 41#0-106AB" :partAB="$partAB" :household_goods="$business_inventory"
                descriptionName="41 Inventory-106AB"
                descriptionAmount="Describe_128-106AB"
            >
                <strong class="d-block">{{ __('41. Inventory') }}</strong>
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 42 -->
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('42. Interests in partnerships or
                                    joint
                                    ventures') }}
                                </strong></label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 42#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 42#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 42#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $interests, 0);?>>
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 42#0-106AB'); ?>" value="yes" type="checkbox" <?php echo isset($partAB[base64_encode('check 42#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 42#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $interests, 1);?>>
                            <label>{{ __('Yes. Describe.') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        $j = 0;
    if (!empty($interests['description']) && is_array($interests['description'])) {

        for ($i = 0;$i < count($interests['description']);$i++) {
            $Interests = '';
            $Interests_1 = '';
            if ($i == 0) {
                $entityName = '42.1 Name of entity-106AB';
                $Interests = 'Ownership_130-106AB';
                $Interests_1 = 'Dollar_129-106AB';
            } elseif ($i == 1) {
                $entityName = '42.2 Name of entity-106AB';
                $Interests = 'Ownership_131-106AB';
                $Interests_1 = 'Dollar_132-106AB';
            } elseif ($i == 2) {
                $entityName = '42.3 Name of entity-106AB';
                $Interests = 'Ownership_133-106AB';
                $Interests_1 = 'Dollar_134-106AB';
            }
            if (Helper::validate_key_value('type_value', $interests)) {
                $totalBRProperty += (float)Helper::validate_key_loop_value('property_value', $interests, $i);
            }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="">{{ __('Name of entity:') }} </label>
                        <input name="<?php echo base64_encode($entityName); ?>" type="text" value="<?php echo $partAB[base64_encode($entityName)] ?? Helper::validate_key_loop_value('description', $interests, $i);?>" class="ab_question form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group mb-0">
                        <label for="">{{ __('% of ownership:') }}</label>
                    </div>
                    <div class="input-group d-flex">
                        <input name="<?php echo base64_encode($Interests); ?>" type="number" value="<?php echo $partAB[base64_encode($Interests)] ?? Helper::validate_key_loop_value('type_of_account', $interests, $i);?>" class="ab_question form-control">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex mt-4">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode($Interests_1); ?>" type="text" value="<?php echo isset($partAB[base64_encode($Interests_1)]) ? Helper::priceFormtWithComma($partAB[base64_encode($Interests_1)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $interests, $i));?>" class="price-field ab_question form-control">
                    </div>
                </div>
            </div>
            <?php }
        } ?>

            <!-- Row 43 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 43_1#0-106AB" :partAB="$partAB" :household_goods="$customer_mailing"
                descriptionName="43 Identifiable information-106AB"
                descriptionAmount="Deacribe_135-106AB"
            >
                <strong class="d-block">{{ __('43. Customer lists, mailing lists, or other compilations') }}</strong>
            </x-officialForm.abSchedule.part3Question>

            <!-- Row 44 -->
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('44. Any business-related property you
                                    did
                                    not already list') }}
                                </strong></label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 44#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 44#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 44#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $other_business, 0);?>>
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 44#0-106AB'); ?>" value="yes" type="checkbox" <?php echo isset($partAB[base64_encode('check 44#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 44#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $other_business, 1);?>>
                            <label>{{ __('Yes. Give specific
                                information') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        $i = 0;
    if (!empty($other_business['description']) && is_array($other_business['description'])) {

        for ($i = 0;$i < count($other_business['description']);$i++) {
            if (Helper::validate_key_value('type_value', $other_business)) {
                $totalBRProperty += (float)Helper::validate_key_loop_value('property_value', $other_business, $i);
            }
            ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-0">
                        <div class="input-group mb-0">
                            <input name="<?php echo base64_encode('44.'.($i + 1).'-106AB'); ?>" type="text" value="<?php echo $partAB[base64_encode('44.'.($i + 1).'-106AB')] ?? Helper::validate_key_loop_value('description', $other_business, $i);?>" class="ab_question form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('Information_'.($i + 137).'-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('Information_'.($i + 137).'-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('Information_'.($i + 137).'-106AB')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $other_business, $i));?>" class="price-field  ab_question form-control">
                    </div>
                </div>
            </div>
            <?php }
        } ?>

                <!-- Row 45 -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="input-group d-inline-block">
                        <strong class="d-block">{{ __('45. Add the dollar value of all of your entries
                            from Part 4, including any entries for pages you have attached
                            for Part 4. Write that number here') }}
                        </strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('DollarValue_143-106AB'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($totalBRProperty); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>

        </div>

        <x-officialForm.partTitle
            title="{{ __('Part 6') }}"
            subTitle="{{ __('Describe Any Farm- and Commercial Fishing-Related Property You Own or Have an Interest In.If you own or have an interest in farmland, list it in Part 1.') }}"
        ></x-officialForm.partTitle>
        <?php
        $farmcommercial = $property_info['farmcommercial'];

    $final = [];
    if (!empty($farmcommercial)) {
        foreach ($farmcommercial as $farm) {
            $fr_type_data = json_decode($farm['type_data'], 1);
            if (!empty($fr_type_data)) {
                $farm['description'] = (!empty($fr_type_data['description'])) ? $fr_type_data['description'] : "";
                $farm['property_value'] = (!empty($fr_type_data['property_value'])) ? $fr_type_data['property_value'] : "";
                $farm['owned_by'] = (!empty($fr_type_data['owned_by'])) ? $fr_type_data['owned_by'] : "";
            }
            unset($farm['type_data']);
            $final[$farm['type']] = $farm;
        }
    }
    // echo "<pre>{{ __('";print_r($final);echo"') }}</pre>";
    $totalFarmProperty = 0;
    $farm_animals = (!empty($final['farm_animals'])) ? $final['farm_animals'] : [];
    if (Helper::validate_key_value('type_value', $farm_animals)) {
        $totalFarmProperty += (float)Helper::validate_key_value('property_value', $farm_animals);
    }
    $crops = (!empty($final['crops'])) ? $final['crops'] : [];
    if (Helper::validate_key_value('type_value', $crops)) {
        $totalFarmProperty += (float)Helper::validate_key_value('property_value', $crops);
    }
    $fishing_equipment = (!empty($final['fishing_equipment'])) ? $final['fishing_equipment'] : [];
    if (Helper::validate_key_value('type_value', $fishing_equipment)) {
        $totalFarmProperty += (float)Helper::validate_key_value('property_value', $fishing_equipment);
    }
    $fishing_supplies = (!empty($final['fishing_supplies'])) ? $final['fishing_supplies'] : [];
    if (Helper::validate_key_value('type_value', $fishing_supplies)) {
        $totalFarmProperty += (float)Helper::validate_key_value('property_value', $fishing_supplies);
    }
    $fishing_property = (!empty($final['fishing_property'])) ? $final['fishing_property'] : [];
    if (Helper::validate_key_value('type_value', $fishing_property)) {
        $totalFarmProperty += (float)Helper::validate_key_value('property_value', $fishing_property);
    }

    $value_yes_47_part_6 = Helper::validate_key_value('type_value', $farm_animals);
    $value_yes_48_part_6 = Helper::validate_key_value('type_value', $crops);
    $value_yes_49_part_6 = Helper::validate_key_value('type_value', $fishing_equipment);
    $value_yes_50_part_6 = Helper::validate_key_value('type_value', $fishing_supplies);
    $value_yes_51_part_6 = Helper::validate_key_value('type_value', $fishing_property);

    $value_yes_part_6 = ($value_yes_47_part_6 || $value_yes_48_part_6 || $value_yes_49_part_6 || $value_yes_50_part_6 || $value_yes_51_part_6);
    $value_yes_46_part_6 = '';
    $value_no_46_part_6 = '';
    if ($value_yes_part_6 == 1) {
        $value_yes_46_part_6 = "checked='checked'";
        $value_no_46_part_6 = "";
    }
    if ($value_yes_part_6 == 0) {
        $value_yes_46_part_6 = "";
        $value_no_46_part_6 = "checked='checked'";
    }

    //miscellaneous
    ?>
        <div class="form-border mb-3">
            <!-- Row 46 -->
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('46. Do you own or have any legal or
                                    equitable interest in any farm- or commercial
                                    fishing-related
                                    property?') }}
                                </strong></label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 46#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 46#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 46#0-106AB'), $partAB, 'no') : $value_no_46_part_6; ?> >
                            <label>{{ __('No. Go to Part 7.') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 46#0-106AB'); ?>" value="yes" type="checkbox" <?php echo isset($partAB[base64_encode('check 46#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 46#0-106AB'), $partAB, 'yes') : $value_yes_46_part_6; ?> >
                            <label>{{ __('Yes. Go to line 47.') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row 47 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 47#0-106AB" :partAB="$partAB" :household_goods="$farm_animals"
                descriptionName="47 Farm Animals-106AB"
                descriptionAmount="FA_144-106AB" textarea="true" describe="{{ __('Yes Describe') }}"
            >
                <strong class="d-block">{{ __('47. Farm animals') }}</strong>
                {{ __('Examples: Livestock, poultry, farm-raised fish') }}
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 48 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 48#0-106AB" :partAB="$partAB" :household_goods="$crops"
                descriptionName="48 Cropseither growing or harvested-106AB"
                descriptionAmount="undefined_145-106AB" textarea="true" describe="{{ __('Yes. Give specific information') }}"
            >
                <strong class="d-block">{{ __('48. Crops—either growing or harvested') }}</strong>
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 49 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 49#0-106AB" :partAB="$partAB" :household_goods="$fishing_equipment"
                descriptionName="49-106AB"
                descriptionAmount="FMoney_148-106AB" textarea="true" describe="{{ __('Yes.') }}"
            >
                <strong class="d-block">{{ __('49. Farm and fishing equipment,
                    implements, machinery, fixtures, and tools of trade') }}</strong>
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 50 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 50#0-106AB" :partAB="$partAB" :household_goods="$fishing_supplies"
                descriptionName="50-106AB"
                descriptionAmount="FMoney_151-106AB" textarea="true" describe="{{ __('Yes.') }}"
            >
                <strong class="d-block">{{ __('50. Farm and fishing supplies, chemicals, and feed') }}</strong>
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 51 -->
            <x-officialForm.abSchedule.part3Question
                checkBoxName="check 51#0-106AB" :partAB="$partAB" :household_goods="$fishing_property"
                descriptionName="51-106AB"
                descriptionAmount="FMoney_153-106AB" textarea="true" describe="{{ __('Yes. Give specific information') }}"
            >
                <strong class="d-block">{{ __('51. Any farm- and commercial
                    fishing-related property you did not already list') }}</strong>
            </x-officialForm.abSchedule.part3Question>
            <!-- Row 52 -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('52. Add the dollar value of all of
                                    your
                                    entries from Part 6, including any entries for pages you
                                    have
                                    attached
                                    for Part 6. Write that number here .') }}</strong>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('DollarAmount_154-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('DollarAmount_154-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('DollarAmount_154-106AB')]) : Helper::priceFormtWithComma($totalFarmProperty); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>






        </div>



        <!-- Part 7 -->
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="part-form-title mb-3 two-line-tittle">
                    <span>{{ __('Part 7') }} </span>
                    <h2 class="font-lg-18">{{ __('Describe All Property You Own or Have an Interest in
                        That
                        You Did Not List Above') }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="form-border mb-3">
            <?php
        $miscellaneous = Helper::getMiscellaneousData($miscellaneous);
    ?>
            <!-- Row 53 -->
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('53. Do you have other property of any
                                    kind
                                    you did not already list') }}
                                </strong>{{ __('Examples: Season tickets, country club
                                membership') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 53#0-106AB'); ?>" value="no" type="checkbox" <?php echo isset($partAB[base64_encode('check 53#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 53#0-106AB'), $partAB, 'no') : Helper::validate_key_toggle('type_value', $miscellaneous, 0);?>>
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('check 53#0-106AB'); ?>" value="On" type="checkbox" <?php echo isset($partAB[base64_encode('check 53#0-106AB')]) ? Helper::validate_key_toggle(base64_encode('check 53#0-106AB'), $partAB, 'yes') : Helper::validate_key_toggle('type_value', $miscellaneous, 1);?>>
                            <label>{{ __('Yes. Give specific information.') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
    $miscPropertyTotal = 0;
    $i = 0;
    if (!empty($miscellaneous['description']) && is_array($miscellaneous['description'])) {
        $name = '53TextBox';

        ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <textarea name="<?php echo base64_encode($name); ?>" class="noadjust form-control" rows="5"><?php
                        echo $partAB[base64_encode($name)] ?? Helper::validate_key_loop_value('description', $miscellaneous, 0)."\r\n";
        echo $partAB[base64_encode($name)] ?? Helper::validate_key_loop_value('description', $miscellaneous, 1)."\r\n";
        echo $partAB[base64_encode($name)] ?? Helper::validate_key_loop_value('description', $miscellaneous, 2)."\r\n";
        ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php
        for ($i = 0;$i < count($miscellaneous['description']);$i++) {
            if ($i == 0) {
                $amount = 'OtherProp_155-106AB';
            }
            if ($i == 1) {
                $amount = 'OtherProp_156-106AB';
            }
            if ($i == 2) {
                $amount = 'OtherProp_157-106AB';
            }?>
                            <div class="input-group d-flex mt-1">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                            <?php  $miscPropertyTotal += (float)Helper::validate_key_loop_value('property_value', $miscellaneous, $i); ?>
                                <input name="<?php echo base64_encode($amount); ?>" type="text" value="<?php echo isset($partAB[base64_encode($amount)]) ? Helper::priceFormtWithComma($partAB[base64_encode($amount)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $miscellaneous, $i));?>" class="price-field ab_question form-control">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('54. Add the dollar value of all of
                                    your
                                    entries from Part 7. Write that number here') }}
                                </strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">+$</span>
                        </div>
                        <input name="<?php echo base64_encode('DollarV_158-106AB'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($miscPropertyTotal); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>


        </div>


        <!-- Part 8 -->
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="part-form-title mb-3 two-line-tittle">
                    <span>{{ __('Part 8') }} </span>
                    <h2 class="font-lg-18">{{ __('List the Totals of Each Part of this Form') }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="form-border mb-3">
            <!-- Row 55 -->
            <div class="row">
                <div class="col-md-10">
                    <div class="input-group horizontal_dotted_line">

                            <label><strong class="d-block">{{ __('55. Part 1: Total real estate, line 2') }}
                                </strong></label>

                    </div>
                </div>

                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex b-dotted b-top-none">
                        <div class="input-group-append">
                        <i class="fa fa-arrow-right mt-5"></i> <span class="input-group-text" id="basic-addon2"> $</span>
                        </div>
                        <input name="<?php echo base64_encode('RealEstate_159-106AB'); ?>" id="ab_total_real_estate" type="text" value="<?php echo isset($partAB[base64_encode('RealEstate_159-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('RealEstate_159-106AB')]) : Helper::priceFormtWithComma($totalResidentValue); ?>" class="price-field fi_schedule_ab_real_estate form-control">
                    </div>
                </div>
            </div>
            <!-- Row 56 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('56. Part 2: Total vehicles, line 5') }}
                                </strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('Vehicles_160-106AB'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($totalVehiclePrice); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>
            <!-- Row 57 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('57. Part 3: Total personal and
                                    household
                                    items, line 15') }}
                                </strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('Personal_161-106AB'); ?>"  type="text" value="<?php echo isset($partAB[base64_encode('Personal_161-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('Personal_161-106AB')]) : Helper::priceFormtWithComma($finanicalTotal); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>
            <!-- Row 58 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('58. Part 4: Total financial assets,
                                    line
                                    36') }}
                                </strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('Assets_162-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('Assets_162-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('Assets_162-106AB')]) : Helper::priceFormtWithComma($totalFinanicalAssTotal);?>" class="price-field form-control">
                    </div>
                </div>
            </div>
            <!-- Row 59 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('59. Part 5: Total business-related
                                    property, line 45') }}
                                </strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('Business_163-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('Business_163-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('Business_163-106AB')]) : Helper::priceFormtWithComma($totalBRProperty); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>
            <!-- Row 60 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('60. Part 6: Total farm- and
                                    fishing-related property, line 52') }}
                                </strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('FandF_164-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('FandF_164-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('FandF_164-106AB')]) : Helper::priceFormtWithComma($totalFarmProperty); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>
            <!-- Row 61 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group">
                            <label><strong class="d-block">{{ __('61. Part 7: Total other property not
                                    listed, line 54') }}
                                </strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">+$</span>
                        </div>
                        <input name="<?php echo base64_encode('OtherProperty_165-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('OtherProperty_165-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('OtherProperty_165-106AB')]) : Helper::priceFormtWithComma($miscPropertyTotal); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>
            <!-- Row 62 -->
            <div class="row">
                <div class="col-md-6 pr-0">
                    <div class="input-group">
                        <div class="input-group horizontal_dotted_line">
                            <label><strong>{{ __('62. Total personal property.') }}
                                </strong> {{ __('Add lines 56 through 61') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex b-dotted">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>

                        <input name="<?php echo base64_encode('PersProp_166#0-106AB'); ?>" id="ab_total_personal_property" type="text" value="<?php echo isset($partAB[base64_encode('PersProp_166#0-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('PersProp_166#0-106AB')]) : Helper::priceFormtWithComma($miscPropertyTotal + $totalFarmProperty + $totalBRProperty + $totalFinanicalAssTotal + $finanicalTotal + $totalVehiclePrice); ?>" class="pl-0 pr-0 price-field fi_schedule_ab_personal_property form-control">
                    </div>
                </div>
                <div class="pl- pr-0 col-md-2">
                    <div class="input-group">
                        <span class="mt-5" style="font-size:10px;">Copy personal property total<i class="fa fa-arrow-right mt-5"></i></span>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex b-dotted">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">+$</span>
                        </div>
                        <input name="<?php echo base64_encode('PersProp_166#0-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('PersProp_166#0-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('PersProp_166#0-106AB')]) : Helper::priceFormtWithComma($miscPropertyTotal + $totalFarmProperty + $totalBRProperty + $totalFinanicalAssTotal + $finanicalTotal + $totalVehiclePrice); ?>" class=" pr-0 price-field form-control">
                    </div>
                </div>
            </div>
            <!-- Row 63 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group horizontal_dotted_line">
                            <label><strong class="">{{ __('63. Total of all property on Schedule
                                    A/B') }}
                                </strong> {{ __('Add line 55 + line 62') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>

                        <input name="<?php echo base64_encode('ScheduleAB_167-106AB'); ?>" id="ab_total_all_property-old" type="text" value="<?php echo isset($partAB[base64_encode('ScheduleAB_167-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('ScheduleAB_167-106AB')]) : Helper::priceFormtWithComma($totalResidentValue + $miscPropertyTotal + $totalFarmProperty + $totalBRProperty + $totalFinanicalAssTotal + $finanicalTotal + $totalVehiclePrice); ?>" class="price-field form-control">
                    </div>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-2 pl-0 pr-0">
                    <div class="input-group d-flex border-solid">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="<?php echo base64_encode('ScheduleAB_167-106AB'); ?>" type="text" value="<?php echo isset($partAB[base64_encode('ScheduleAB_167-106AB')]) ? Helper::priceFormtWithComma($partAB[base64_encode('ScheduleAB_167-106AB')]) : Helper::priceFormtWithComma($totalResidentValue + $miscPropertyTotal + $totalFarmProperty + $totalBRProperty + $totalFinanicalAssTotal + $finanicalTotal + $totalVehiclePrice); ?>" class="price-field form-control">
                    </div>
                </div>
            </div>
        </div>
        <x-officialForm.generatePdfButton
            title="Generate Schedule A/B: (Property) PDF" divtitle="coles_official-form-106a_and_b"
        ></x-officialForm.generatePdfButton>
    </div>


</section>
</form>
<script>
    var total =  $('#ab_total_real_estate').val()+$('#ab_total_personal_property').val();
    $('#ab_total_all_property').val( total ) ;
</script>