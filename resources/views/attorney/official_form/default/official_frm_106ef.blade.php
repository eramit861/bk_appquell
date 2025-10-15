<section class="page-section official-form-106e-f padd-20" id="official-form-106e_and_f">
    <div class="container pl-2 pr-0">
    <form name="official_frm_106ef" class="official_ef_form_first save_official_forms" id="official_frm_106ef" action="{{route('generate_official_pdf')}}" method="post">
        @csrf
        <input type="hidden" name="form_id" value="106ef">
        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
        
            <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106ef.pdf'; ?>">
            <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106ef.pdf'; ?>">
            <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
        <!-- Use below variable to fill values -->
        <?php $efMain = isset($dynamicPdfData['106ef']) && !empty($dynamicPdfData['106ef']) ? json_decode($dynamicPdfData['106ef'], 1) : null; ?>
		<div class="row">
            <div class="frm106ef col-md-7">
                <div class="section-box">
                    <div class="frm106ef section-header bg-back text-white">
                        <p class="frm106ef font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                    </div>
                    <div class="frm106ef section-body padd-20">
                        <div class="frm106ef col-md-12">
                           
                            <div class="frm106ef col-md-12">
                                <div class="frm106ef input-group">
                                    <label>{{ __('United States Bankruptcy Court for the District Of') }}</label>
                                    <select name="<?php echo base64_encode('Bankruptcy District Information'); ?>" class="form-control district-select" id="district_name">
                                        @foreach ($district_names as $district_name)
                                        <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="frm106ef col-md-5">
                <div class="frm106ef amended">
                    <input type="checkbox" name="<?php echo base64_encode('Check if this is an');?>" value="On" <?php echo isset($efMain[base64_encode('Check if this is an')]) ? Helper::validate_key_toggle(base64_encode('Check if this is an'), $efMain, 'On') : '';?>>
                    <label>{{ __('Check if this is an amended filing') }}</label>
                </div>
            </div>

        </div>

        <?php
        $totalTaxesAmountOtherThanDSO = 0;
        $backtaxIndex = 1;
        $efDebtrs = [];
        $taxes = [];
        if (!empty($final_debtstax['tax_owned_state']) && !empty($final_debtstax['back_tax_own']) && count($final_debtstax['back_tax_own']) > 0) {

            //2.1 only
            foreach ($final_debtstax['back_tax_own'] as $backtaxowned) {
                $statecode = Helper::validate_key_value('debt_state', $backtaxowned);
                if (!empty($statecode)) {

                    $btitem = AddressHelper::getStateTaxAddress($statecode);
                    $eftaxcod = [];
                    if (in_array(Helper::validate_key_value('owned_by', $backtaxowned), Helper::OWNBY_FORM_VALUES)) {
                        $eftaxcod = [
                        'codebtor_creditor_name' => Helper::validate_key_value('codebtor_creditor_name', $backtaxowned),
                        'codebtor_creditor_name_addresss' => Helper::validate_key_value('codebtor_creditor_name_addresss', $backtaxowned),
                        'codebtor_creditor_city' => Helper::validate_key_value('codebtor_creditor_city', $backtaxowned),
                        'codebtor_creditor_state' => Helper::validate_key_value('codebtor_creditor_state', $backtaxowned),
                        'codebtor_creditor_zip' => Helper::validate_key_value('codebtor_creditor_zip', $backtaxowned),
                        'account_number' => isset($BasicInfoPartA['security_number']) ? Helper::lastchar($BasicInfoPartA['security_number']) : "",
                        'fromLine' => '1'.'.'.$backtaxIndex,
                        'part' => 'Part 1'
                        ];
                    }
                    $totalTaxesAmountOtherThanDSO += Helper::validate_key_value('tax_total_due', $backtaxowned, 'float');
                    $tax = [
                        'sq_no' => $backtaxIndex,
                        'address_line2' => $btitem['add2'] ?? '',
                        'address_line1' => $btitem['add1'] ?? '',
                        'creditor_name' => $btitem['address_heading'] ?? '',
                        'state' => $statecode,
                        'city' => $btitem['city'] ?? '',
                        'zip' => $btitem['zip'] ?? '',
                        'last4Digits' => isset($BasicInfoPartA['security_number']) ? Helper::lastchar($BasicInfoPartA['security_number']) : "",
                        'year' => Helper::validate_key_value('tax_whats_year', $backtaxowned),
                        'claim_type' => 2,
                        'other_specify' => '',
                        'total_claim' => Helper::validate_key_value('tax_total_due', $backtaxowned, 'float'),
                        'priority_amount' => Helper::validate_key_value('tax_total_due', $backtaxowned, 'float'),
                        'unpariority_amount' => Helper::validate_key_value('tax_total_due', $backtaxowned, 'float'),
                        'who_ensured_debt' => Helper::validate_key_value('owned_by', $backtaxowned),
                        'is_community_debt' => '',
                        'subject_to_offset' => '',
                        'on_date_file_claim_is' => '',
                        'codebtor' => $eftaxcod
                        ];
                    array_push($taxes, $tax);
                    $backtaxIndex++;
                }
            }
        }


        if (Helper::validate_key_value('tax_owned_irs', $final_debtstax) == 1 && isset($final_debtstax['tax_irs_state']) && !empty($final_debtstax['tax_irs_state'])) {
            //2.1 only
            $statecode = Helper::validate_key_value('tax_irs_state', $final_debtstax);
            $btitem = Helper::irsState($statecode);
            $eftaxcod = [];
            if (in_array(Helper::validate_key_value('tax_irs_owned_by', $final_debtstax), Helper::OWNBY_FORM_VALUES)) {
                $eftaxcod = [
                    'codebtor_creditor_name_addresss' => Helper::validate_key_value('tax_irs_codebtor_creditor_name_addresss', $final_debtstax),
                    'codebtor_creditor_city' => Helper::validate_key_value('tax_irs_codebtor_creditor_city', $final_debtstax),
                    'codebtor_creditor_name' => Helper::validate_key_value('tax_irs_codebtor_creditor_name', $final_debtstax),
                    'account_number' => isset($BasicInfoPartA['security_number']) ? Helper::lastchar($BasicInfoPartA['security_number']) : "",
                    'codebtor_creditor_zip' => Helper::validate_key_value('tax_irs_codebtor_creditor_zip', $final_debtstax),
                    'codebtor_creditor_state' => Helper::validate_key_value('tax_irs_codebtor_creditor_state', $final_debtstax),
                    'fromLine' => '1'.'.'.$backtaxIndex,
                    'part' => 'Part 1'
                ];
            }
            $totalTaxesAmountOtherThanDSO += Helper::validate_key_value('tax_irs_total_due', $final_debtstax, 'float');
            $tax = [
                 'sq_no' => $backtaxIndex,
                 'creditor_name' => $btitem['address_heading'] ?? '',
                 'address_line1' => $btitem['add1'] ?? '',
                 'address_line2' => $btitem['add2'] ?? '',
                 'city' => $btitem['city'] ?? '',
                 'state' => $statecode,
                 'zip' => $btitem['zip'] ?? '',
                 'last4Digits' => isset($BasicInfoPartA['security_number']) ? Helper::lastchar($BasicInfoPartA['security_number']) : "",
                 'year' => Helper::validate_key_value('tax_irs_whats_year', $final_debtstax),
                 'claim_type' => 2,
                 'other_specify' => '',
                 'total_claim' => Helper::validate_key_value('tax_irs_total_due', $final_debtstax, 'float'),
                 'priority_amount' => Helper::validate_key_value('tax_irs_total_due', $final_debtstax, 'float'),
                 'unpariority_amount' => Helper::validate_key_value('tax_irs_total_due', $final_debtstax, 'float'),
                 'who_ensured_debt' => Helper::validate_key_value('tax_irs_owned_by', $final_debtstax),
                 'is_community_debt' => '',
                 'subject_to_offset' => '',
                 'on_date_file_claim_is' => '' ,
                 'codebtor' => $eftaxcod
                ];
            array_push($taxes, $tax);
            $backtaxIndex++;
        }


        $totalClaimDomestic = 0;
        $domesticAddresses = [];
        $domesticAddressList = [];
        if (Helper::validate_key_value('domestic_support', $final_debtstax) == 1 && !empty($final_debtstax['domestic_tax']) && count($final_debtstax['domestic_tax']) > 0) {
            //2.1 only
            foreach ($final_debtstax['domestic_tax'] as $efdomestic) {
                $totalClaimDomestic += Helper::validate_key_value('domestic_support_monthlypay', $efdomestic, 'float');
                $statecode = Helper::validate_key_value('domestic_address_state', $efdomestic);
                $domesticAddresses = AddressHelper::getDomesticAddressStatesList($statecode, false);
                foreach ($domesticAddresses as $btitem) {
                    $btitem['domestic_support_account'] = Helper::validate_key_value('domestic_support_account', $efdomestic);
                    $btitem['ref_index'] = '2.'.$backtaxIndex;
                    array_push($domesticAddressList, $btitem);
                }

                $tax = [
                     'sq_no' => $backtaxIndex,
                     'creditor_name' => Helper::validate_key_value('domestic_support_name', $efdomestic),
                     'address_line1' => Helper::validate_key_value('domestic_support_address', $efdomestic),
                     'address_line2' => '',
                     'city' => Helper::validate_key_value('domestic_support_city', $efdomestic),
                     'state' => Helper::validate_key_value('creditor_state', $efdomestic),
                     'zip' => Helper::validate_key_value('domestic_support_zipcode', $efdomestic),
                     'last4Digits' => isset($BasicInfoPartA['security_number']) ? Helper::lastchar($BasicInfoPartA['security_number']) : "",
                     'year' => Helper::validate_key_value('tax_whats_year', $efdomestic),
                     'claim_type' => 1,
                     'other_specify' => '',
                     'total_claim' => Helper::validate_key_value('domestic_support_past_due', $efdomestic, 'float'),
                     'priority_amount' => Helper::validate_key_value('domestic_support_monthlypay', $efdomestic, 'float'),
                     'unpariority_amount' => Helper::validate_key_value('domestic_support_monthlypay', $efdomestic, 'float'),
                     'who_ensured_debt' => Helper::validate_key_value('owned_by', $efdomestic),
                     'is_community_debt' => '',
                     'subject_to_offset' => '',
                     'on_date_file_claim_is' => ''
                    ];
                array_push($taxes, $tax);
                $backtaxIndex++;
            }
        }


        ?>
        <div class="row padd-20">
            <div class="col-md-12 mb-3">
                <div class="form-title">
                    <h4>{{ __('Schedule E/F') }}</h4>
                    <!-- <h4>{{ __('Official Form 106E/F') }} </h4> -->
                    <h2 class="font-lg-22">{{ __('Schedule E/F: Creditors Who Have Unsecured Claims') }}
                    </h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-subheading">
                    <p class="font-lg-14"><strong>{{ __('Be as complete and accurate as possible. Use
                        Part
                        1 for creditors with PRIORITY claims and Part 2 for creditors with
                        NONPRIORITY claims.
                        List the other party to any executory contracts or unexpired leases
                        that
                        could result in a claim. Also list executory contracts on Schedule
                        A/B: Property (Official Form 106A/B) and on Schedule G: Executory
                        Contracts and Unexpired Leases (Official Form 106G). Do not include
                        any
                        creditors with partially secured claims that are listed in Schedule
                        D:
                        Creditors Who Have Claims Secured by Property. If more space is
                        needed, copy the Part you need, fill it out, number the entries in
                        the
                        boxes on the left. Attach the Continuation Page to this page. On the
                        top
                        of
                        any additional pages, write your name and case number (if known).') }}
                        </strong>
                    </p>
                </div>
            </div>
        </div>
        <!-- Part 1.1 -->
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="part-form-title mb-3">
                    <span>{{ __('Part 1') }}</span>
                    <h2 class="font-lg-18">{{ __('List All of Your PRIORITY Unsecured Claims') }}
                    </h2>
                </div>
            </div>
        </div>
        <!-- Row 1 -->
        <div class="form-border">
            <!-- Row 1 -->
            <div class="row column-heading">
                <div class="col-md-12">
                    <div class="input-group d-inline-block">
                        <label for=""> <strong class="d-block">{{ __('1. Do any creditors have priority unsecured
                        claims against you?') }}
                        </strong> </label>
                    </div>
                    <div class="input-group">
                        <input <?php if (empty($taxes)) {
                            echo "checked";
                        } ?> name="<?php echo base64_encode('check1'); ?>" <?php echo isset($efMain[base64_encode('check1')]) ? Helper::validate_key_toggle(base64_encode('check1'), $efMain, 'no') : '';?> value="no" type="checkbox">
                        <label>{{ __('No. Go to Part 2') }}</label>
                    </div>
                    <div class="input-group">
                        <input <?php if (!empty($taxes)) {
                            echo "checked";
                        } ?>  name="<?php echo base64_encode('check1'); ?>" <?php echo isset($efMain[base64_encode('check1')]) ? Helper::validate_key_toggle(base64_encode('check1'), $efMain, 'yes') : '';?> value="yes" type="checkbox">
                        <label>{{ __('Yes') }}</label>
                    </div>
                </div>
            </div>
            <div class="row column-heading">
                <div class="col-md-12 column-heading">
                    <div class="input-group d-inline-block">
                        <label><strong class="mb-0">{{ __("2. List all of your priority unsecured
                        claims.
                        If a creditor has more than one priority unsecured claim, list
                        the
                        creditor separately for each claim. For
                        each claim listed, identify what type of claim it is. If a claim
                        has
                        both priority and nonpriority amounts, list that claim here and
                        show
                        both priority and
                        nonpriority amounts. As much as possible, list the claims in
                        alphabetical order according to the creditor’s name. If you have
                        more than two priority
                        unsecured claims, fill out the Continuation Page of Part 1. If
                        more
                        than one creditor holds a particular claim, list the other
                        creditors
                        in Part 3.
                        (For an explanation of each type of claim, see the instructions
                        for
                        this form in the instruction booklet.)") }}</strong> </label>
                    </div>
                </div>
            </div>
            <div class="row column-heading">
                <?php
                    $efpart1Codebtors = [];
        $class = '';
        $count = count($taxes);
        $page1Taxes = array_slice($taxes, 0, 2);
        $page2Taxes = array_slice($taxes, 2, $count);
        $i = 1;


        $array1 = !empty($page2Taxes) && count($page2Taxes) > 3 ? array_slice($page2Taxes, 0, 3) : $page2Taxes;
        $array2 = !empty($page2Taxes) && count($page2Taxes) > 3 ? array_slice($page2Taxes, 3, count($page2Taxes)) : [];

        $pagees = 1;
        $totalefCountPages = 0;
        $schehroup = array_chunk($array2, 3);
        $totalefCountPages = is_array($schehroup) ? count($schehroup) : 0;
        $totalefCountPages = $totalefCountPages + 3;



        /**Non Prioritysecured claims start*/
        $debtTaxes = [];
        if (!empty($final_debtstax['debt_tax']) && count($final_debtstax['debt_tax']) > 0) {
            $debtTaxes = $final_debtstax['debt_tax'];
        }
        $dtIndex = 1;
        if (!empty($debtTaxes)) {
            foreach ($debtTaxes as $efdebttax) {
                $eftaxcod = [
                    'codebtor_creditor_name' => Helper::validate_key_value('codebtor_creditor_name', $efdebttax),
                    'codebtor_creditor_name_addresss' => Helper::validate_key_value('codebtor_creditor_name_addresss', $efdebttax),
                    'codebtor_creditor_city' => Helper::validate_key_value('codebtor_creditor_city', $efdebttax),
                    'codebtor_creditor_state' => Helper::validate_key_value('codebtor_creditor_state', $efdebttax),
                    'codebtor_creditor_zip' => Helper::validate_key_value('codebtor_creditor_zip', $efdebttax),
                    'account_number' => Helper::validate_key_value('amount_number', $efdebttax),
                    'fromLine' => '4'.'.'.$dtIndex,
                    'part' => 'yes'
                    ];
                if (isset($efdebttax['owned_by']) && in_array($efdebttax['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                    array_push($efpart1Codebtors, $eftaxcod);
                }
                $dtIndex++;
            }

        }

        $unsecuredGroup = array_chunk($debtTaxes, 3);
        $totalefCountPages = $totalefCountPages + (is_array($unsecuredGroup) ? count($unsecuredGroup) : 0);


        /** Non priority secured claim end */


        $froi = 1;
        foreach ($taxes as $btitem) {
            if (isset($btitem['who_ensured_debt']) && in_array($btitem['who_ensured_debt'], Helper::OWNBY_FORM_VALUES)) {
                if (isset($btitem['codebtor']) && !empty($btitem['codebtor'])) {
                    $btitem['codebtor']['fromLine'] = '2.'.$froi;
                    array_push($efpart1Codebtors, $btitem['codebtor']);
                }
            }
            $froi++;
        }

        foreach ($domesticAddressList as $dom) {
            if (isset($dom['address_name']) && !empty($dom['address_name'])) {
                $dos = [
                    'codebtor_creditor_name' => $dom['address_name'],
                    'codebtor_creditor_name_addresss' => $dom['address_street']. ' '.$dom['address_line2'],
                    'codebtor_creditor_city' => $dom['address_city'] ?? '',
                    'codebtor_creditor_state' => $dom['address_state'],
                    'codebtor_creditor_zip' => $dom['address_zip'],
                    'account_number' => $dom['domestic_support_account'],
                    'fromLine' => $dom['ref_index'],
                    'part' => 'yes'
                ];
                array_push($efpart1Codebtors, $dos);
            }

            if (isset($dom['notify_address_name']) && !empty($dom['notify_address_name'])) {
                $dos = ['codebtor_creditor_name' => $dom['notify_address_name'],
                    'codebtor_creditor_name_addresss' => $dom['notify_address_street']. ' '.$dom['notify_address_line2'],
                    'codebtor_creditor_city' => $dom['notify_address_city'] ?? '',
                    'codebtor_creditor_state' => $dom['address_state'],
                    'codebtor_creditor_zip' => $dom['notify_address_zip'],
                    'account_number' => $dom['domestic_support_account'],
                    'fromLine' => $dom['ref_index'],
                    'part' => 'yes'
                ];
                array_push($efpart1Codebtors, $dos);
            }
        }

        $codebtorGroup = array_chunk($efpart1Codebtors, 7);
        $totalefCountPages = $totalefCountPages + (is_array($codebtorGroup) ? count($codebtorGroup) : 0);


        foreach ($page1Taxes as $btitem) {
            $fieldName = LocalFormHelper::getEFPage1($i);
            $btitem['subject_to_offset'] = 0;
            ?>
                <div class="col-md-12">
                    <input name="<?php echo base64_encode($fieldName['noBox']); ?>" readonly class="square" value="2.<?php echo $i; ?>">
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <label>{{ __("Priority Creditor’s Name") }} </label>
                                <input name="<?php echo base64_encode($fieldName['creditorName']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['creditorName'])] ?? (isset($btitem['creditor_name']) ? $btitem['creditor_name'] : ''); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group">
                                <label>{{ __('Address') }}</label>
                                <input name="<?php echo base64_encode($fieldName['addressLineA']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['addressLineA'])] ?? (isset($btitem['address_line1']) ? $btitem['address_line1'] : ''); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group">
                                <label>{{ __('Address 2') }}</label>
                                <input name="<?php echo base64_encode($fieldName['addressLineB']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['addressLineB'])] ?? (isset($btitem['address_line2']) ? $btitem['address_line2'] : ''); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label>{{ __('City') }}</label>
                                <input name="<?php echo base64_encode($fieldName['city']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['city'])] ?? (isset($btitem['city']) ? $btitem['city'] : ''); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label>{{ __('State') }}</label>
                                <input name="<?php echo base64_encode($fieldName['state']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['state'])] ?? (isset($btitem['state']) ? $btitem['state'] : ''); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label>{{ __('Zip Code') }}</label>
                                <input name="<?php echo base64_encode($fieldName['zip']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['zip'])] ?? (isset($btitem['zip']) ? $btitem['zip'] : ''); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label><strong>{{ __('Last 4 digits of acct #') }}</strong> </label>
                                <input name="<?php echo base64_encode($fieldName['last4Digits']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['last4Digits'])] ?? (isset($btitem['last4Digits']) ? $btitem['last4Digits'] : ''); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label><strong>{{ __('When debt incurred?:') }}</strong> </label>
                                <input name="<?php echo base64_encode($fieldName['whenDebtIncurred']); ?>" type="text" value="<?php echo $efMain[base64_encode($fieldName['whenDebtIncurred'])] ?? $btitem['year'];?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group">
                                <label><strong>{{ __('Type of PRIORITY unsecured claim:') }}</strong> </label>
                            </div>
                            <?php
                        $c1 = $efMain[base64_encode($fieldName['priorityTypeA'])] ?? null;
            $c2 = $efMain[base64_encode($fieldName['priorityTypeB'])] ?? null;
            $c3 = $efMain[base64_encode($fieldName['priorityTypeC'])] ?? null;
            $c4 = $efMain[base64_encode($fieldName['priorityTypeD'])] ?? null;
            $dbvalues = [$c1,$c2,$c3,$c4];
            if (!empty(array_filter($dbvalues))) {
                unset($btitem['claim_type']);
            }
            $check1 = isset($efMain[base64_encode($fieldName['priorityTypeA'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeA']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $btitem, 1);
            $check2 = isset($efMain[base64_encode($fieldName['priorityTypeB'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeB']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $btitem, 2);
            $check3 = isset($efMain[base64_encode($fieldName['priorityTypeC'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeC']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $btitem, 3);
            $check4 = isset($efMain[base64_encode($fieldName['priorityTypeD'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['priorityTypeD']), $efMain, 'On') : Helper::validate_key_toggle('claim_type', $btitem, 4);
            ?>
                            <div class="ef input-group">
                                <input name="<?php echo base64_encode($fieldName['priorityTypeA']); ?>" class="ef ef_domestic_support_obligation" value="On" type="checkbox" <?php echo $check1;?>>
                                <label>{{ __('Domestic support obligations') }} </label>
                            </div>
                            <div class="ef input-group">
                                <input name="<?php echo base64_encode($fieldName['priorityTypeB']); ?>" class="ef ef_taxes_other_debts" value="On" type="checkbox" <?php echo $check2;?>>
                                <label>{{ __('Taxes and certain other debts you owe the government') }} </label>
                            </div>
                            <div class="ef input-group">
                                <input name="<?php echo base64_encode($fieldName['priorityTypeC']); ?>" class="ef ef_death_personal_claim" value="On" type="checkbox" <?php echo $check3;?>>
                                <label>{{ __('Claims for death or personal injury while you were intoxicated') }} </label>
                            </div>
                            <div class="ef input-group">
                                <input name="<?php echo base64_encode($fieldName['priorityTypeD']); ?>" class="ef" value="On"  type="checkbox" <?php echo $check4;?>>
                                <label>{{ __('Other. Specify') }} </label>
                                <input name="<?php echo base64_encode($fieldName['priorityTypeOtherText']); ?>"  class="ef" type="text" class="form-control l-w" value="<?php echo $efMain[base64_encode($fieldName['priorityTypeOtherText'])] ?? $btitem['other_specify'];?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 ml-0 pl-0">
                    <div class="row">
                        <div class="col-md-4  mr-0 pr-0">
                            <strong>{{ __('Total claim') }}</strong>
                        </div>
                        <div class="col-md-4  mr-0 pr-0">
                            <strong>{{ __('Priority
                            amount') }}</strong>
                        </div>
                        <div class="col-md-4  mr-0 pr-0">
                            <strong>{{ __('Nonpriority
                            amount') }}</strong>
                        </div>
                        <div class="col-md-4  mr-0 pr-0">
                            <div class="input-group d-flex ">
                                <input name="<?php echo base64_encode($fieldName['totalClaim']); ?>" type="text" class="form-control price-field" value="<?php  echo isset($efMain[base64_encode($fieldName['totalClaim'])]) ? Helper::priceFormtWithComma($efMain[base64_encode($fieldName['totalClaim'])]) : Helper::priceFormtWithComma($btitem['total_claim']);?>" placeholder="$">
                            </div>
                        </div>
                        <div class="col-md-4  mr-0 pr-0">
                            <div class="input-group d-flex ">
                                <input name="<?php echo base64_encode($fieldName['priorityAmount']); ?>" type="text" value="<?php echo isset($efMain[base64_encode($fieldName['priorityAmount'])]) ? Helper::priceFormtWithComma($efMain[base64_encode($fieldName['priorityAmount'])]) : Helper::priceFormtWithComma($btitem['priority_amount']);?>" class=" price-field form-control" placeholder="$">
                            </div>
                        </div>
                        <div class="col-md-4  mr-0 pr-0">
                            <div class="input-group d-flex ">
                                <input name="<?php echo base64_encode($fieldName['nonpriorityAmount']); ?>" type="text" value="<?php echo isset($efMain[base64_encode($fieldName['nonpriorityAmount'])]) ? Helper::priceFormtWithComma($efMain[base64_encode($fieldName['nonpriorityAmount'])]) : Helper::priceFormtWithComma($btitem['unpariority_amount']);?>" class="price-field form-control" placeholder="$">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group">
                                <label><strong>{{ __('Who incurred the debt?') }}</strong> {{ __('Check
                                one.') }}</label>
                            </div>
                            <?php
                $c1 = $efMain[base64_encode($fieldName['debtor'])] ?? null;
            $c2 = $efMain[base64_encode($fieldName['debtor'])] ?? null;
            $c3 = $efMain[base64_encode($fieldName['debtor'])] ?? null;
            $c4 = $efMain[base64_encode($fieldName['debtor'])] ?? null;
            $dbvalues = [$c1,$c2,$c3,$c4];
            if (!empty(array_filter($dbvalues))) {
                unset($btitem['who_ensured_debt']);
            }
            $check1 = isset($efMain[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efMain, $fieldName['debtorA']) : Helper::validate_key_toggle('who_ensured_debt', $btitem, 1);
            $check2 = isset($efMain[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efMain, $fieldName['debtorB']) : Helper::validate_key_toggle('who_ensured_debt', $btitem, 2);
            $check3 = isset($efMain[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efMain, $fieldName['debtorAandB']) : Helper::validate_key_toggle('who_ensured_debt', $btitem, 3);
            $check4 = isset($efMain[base64_encode($fieldName['debtor'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtor']), $efMain, $fieldName['debtorOneOrAnother']) : Helper::validate_key_toggle('who_ensured_debt', $btitem, 4);
            ?>
                            <div class="ef input-group">
                                <input class="ef" name="<?php echo base64_encode($fieldName['debtor']); ?>" type="checkbox" id="Debtor1" value="<?php echo($fieldName['debtorA']); ?>" <?php echo $check1;?>>
                                <label for="Debtor1">{{ __('Debtor 1 only') }} </label>
                            </div>
                            <div class="ef input-group">
                                <input class="ef" name="<?php echo base64_encode($fieldName['debtor']); ?>"  type="checkbox" id="Debtor2" value="<?php echo($fieldName['debtorB']); ?>" <?php echo $check2;?>>
                                <label for="Debtor2">{{ __('Debtor 2 only') }} </label>
                            </div>
                            <div class="ef input-group">
                                <input class="ef" name="<?php echo base64_encode($fieldName['debtor']); ?>"  type="checkbox" id="Debtor12" value="<?php echo($fieldName['debtorAandB']); ?>" <?php echo $check3;?>>
                                <label for="Debtor12">{{ __('Debtor 1 and Debtor 2 only') }} </label>
                            </div>
                            <div class="ef input-group">
                                <input class="ef" name="<?php echo base64_encode($fieldName['debtor']); ?>"  type="checkbox" id="another" value="<?php echo($fieldName['debtorOneOrAnother']); ?>" <?php echo $check4;?>>
                                <label for="another">{{ __('At least one of the debtors and another') }} </label>
                            </div>
                            <div class="ef input-group">
                                <input class="ef" name="<?php echo base64_encode($fieldName['checkIfThisClaim']); ?>"  type="checkbox" id="claim" <?php echo isset($efMain[base64_encode($fieldName['checkIfThisClaim'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['checkIfThisClaim']), $efMain, "On") : Helper::validate_key_toggle('is_community_debt', $btitem, 1);?> name="claim" value="On">
                                <label for="claim">{{ __('Check if this claim relates to a
                                community debt') }} </label>
                            </div>
                            <div class="input-group">
                                <label><strong>{{ __('Is the claim subject to offset?') }} </strong></label><br>
                                <input name="<?php echo base64_encode($fieldName['claimSubjectToOffset']); ?>" value="no" type="checkbox" <?php echo isset($efMain[base64_encode($fieldName['claimSubjectToOffset'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['claimSubjectToOffset']), $efMain, 'no') : Helper::validate_key_toggle('subject_to_offset', $btitem, 0);?> >
                                <label>{{ __('No') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode($fieldName['claimSubjectToOffset']); ?>" value="yes" type="checkbox"  <?php echo isset($efMain[base64_encode($fieldName['claimSubjectToOffset'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['claimSubjectToOffset']), $efMain, 'yes') : Helper::validate_key_toggle('subject_to_offset', $btitem, 1);?> >
                                <label>{{ __('Yes') }}</label>
                            </div>
                            <div class="input-group">
                                <label><strong>{{ __('As of the date you file, the claim is:') }}</strong>  {{ __('Check
                                all
                                that apply.') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode($fieldName['contingent']); ?>" value="On" type="checkbox" <?php echo isset($efMain[base64_encode($fieldName['contingent'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['contingent']), $efMain, 'On') : Helper::validate_key_toggle('on_date_file_claim_is', $btitem, 1);?>>
                                <label>{{ __('Contingent') }} </label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode($fieldName['unliquidated']); ?>" value="On" type="checkbox" <?php echo isset($efMain[base64_encode($fieldName['unliquidated'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['unliquidated']), $efMain, 'On') : Helper::validate_key_toggle('on_date_file_claim_is', $btitem, 2);?>>
                                <label>{{ __('Unliquidated') }} </label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode($fieldName['disputed']); ?>" value="On" type="checkbox" <?php echo isset($efMain[base64_encode($fieldName['disputed'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['disputed']), $efMain, 'On') : Helper::validate_key_toggle('on_date_file_claim_is', $btitem, 3);?>>
                                <label>{{ __('Disputed') }} </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php $i++;
        } ?>
            </div>
            <input type="hidden" name="<?php echo base64_encode('fill_27.0')?>" value="{{$totalefCountPages}}">
           <?php $pagees = 1; ?>
        <h3 style="text-align:right;">Page {{$pagees}} of {{$totalefCountPages}} </h3>
        <?php $pagees++;?>
        </div>
     
        <!-- Part 1.2 page 2-->
        <!-- Row 1 -->
        @include("attorney.priorityunsecuredclaimspart1",['isfirst'=>true,'pagees' => $pagees,'totalefCountPages'=>$totalefCountPages,'taxes' => $array1,'efMain' => $efMain])
        <?php $pagees++;?>
    </form>

<?php

    $page1 = 1;
        foreach ($schehroup as $listSch) {
            if (!empty($listSch)) {
                $pagen = 'part1_pdf'.$page1;

                ?>
     @include("attorney.priorityunsecuredclaims",['isfirst'=>true,'taxes' => $listSch,'pagees'=> $pagees,'totalefCountPages'=>$totalefCountPages,'partname' => $pagen,'allowempty' => 1])
    <?php $pagees++;
                $page1++;
            }
        } ?>



 <!-- Part 1 Priority secured claim end -->

 <!-- Non Priority secured claim started -->



    <?php

        $efpdf1 = 1;
        foreach ($unsecuredGroup as $unseclist) {
            if (!empty($unseclist)) {
                $pagen = 'part2_pdf'.$efpdf1;
                if ($efpdf1 == 1) {
                    $pagen = 'part2';

                    ?>
    @include("attorney.nonpriorityunsecuredclaims1",['isfirst'=>true, 'totalefCountPages'=>$totalefCountPages,'index' => 1, 'debts' => $unseclist,'pagees' => $pagees,'partname' => $pagen])
  <?php } else {
      $ifndex = 4;
      ?>
    @include("attorney.nonpriorityunsecuredclaims",['isfirst'=>true, 'totalefCountPages'=>$totalefCountPages,'index' => $ifndex, 'debts' => $unseclist,'pagees' => $pagees,'partname' => $pagen])
    <?php   } $pagees++;
                $efpdf1++;
            }
        } ?>
    <!-- Part 3 -->


    <?php
$codeb = 1;
        foreach ($codebtorGroup as $unseclist) {
            if (!empty($unseclist)) {
                $pagen = 'part3_pdf'.$codeb;
                ?>
@include("attorney.official_form.sch_ef_part3",['isfirst'=>true, 'domestic_tax' => $unseclist,'partname' => $pagen , 'pageno' => $pagees, 'totalpageno' => $totalefCountPages])
<?php $codeb++;
                $pagees++;
            }
        } ?>

  
    <form class="official_ef_forms save_official_forms" name="official_frm_106ef_part4" id="official_frm_106ef_part4" action="{{route('generate_official_pdf')}}" method="post">
        @csrf
        <input type="hidden" name="form_id" value="106ef_part4">
        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
        <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106ef_part4.pdf'; ?>">
            <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106ef_part4.pdf'; ?>">
            <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
        <!-- Use below variable to fill values -->
        <?php $efPart4 = isset($dynamicPdfData['106ef_part4']) && !empty($dynamicPdfData['106ef_part4']) ? json_decode($dynamicPdfData['106ef_part4'], 1) : null; ?>
        <!-- Row 2 -->
        <!-- Part 3.1 -->
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="part-form-title mb-3">
                    <span>{{ __('Part 4') }}</span>
                    <h2 class="font-lg-18">{{ __('Add the Amounts for Each Type of Unsecured Claim') }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="form-border mb-3 ">
            <input type="hidden" name="<?php echo base64_encode('fill_27.1.8')?>" value="{{$pagees}}">
            <input type="hidden" name="<?php echo base64_encode('fill_27.1.7')?>" value="{{$totalefCountPages}}">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="input-group">
                        <strong>{{ __('6. Total the amounts of certain types of unsecured claims. This
                        information is for statistical reporting purposes only. 28 U.S.C. §
                        159.
                        Add the amounts for each type of unsecured claim.') }}</strong>
                    </div>
                </div>
            </div>
            <!-- Row part 3.1 -->
            <div class="row mb-3">
                <div class="col-md-6"></div>
                <div class="ef col-md-6 column-heading text-center ">
                    <strong class="ef padd-10 d-block">{{ __('Total claim') }}</strong>
                </div>
                <div class="ef col-md-12">
                    <div class="row">
                        <div class="col-md-1 column-heading">
                            <div class="ef input-group">
                                <label>{{ __('Total claims from Part 1') }} </label>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-6  mb-3">
                                    <div class="input-group">
                                        <label> <strong>{{ __('6a. Domestic support obligations') }}</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <label>{{ __('6a.') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Total_6a');?>" id="ef_Domestic_support_obligations" type="text" value="<?php echo $efPart4[base64_encode('Total_6a')] ?? Helper::priceFormtWithComma($totalClaimDomestic); ?>" class="price-field form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6  mb-3">
                                    <div class="input-group ">
                                        <label> <strong>{{ __('6b. Taxes and certain other debts you owe the
                                        government') }} </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <label>{{ __('6b.') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Total_6b');?>" id="ef_Taxes_and_certain" type="text" value="<?php echo $efPart4[base64_encode('Total_6b')] ?? Helper::priceFormtWithComma($totalTaxesAmountOtherThanDSO); ?>" class="price-field form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6  mb-3">
                                    <div class="input-group">
                                        <label> <strong>{{ __('6c. Claims for death or personal injury while
                                        you
                                        were
                                        intoxicated') }}</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <label>{{ __('6c.') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Total_6c');?>" id="ef_claims_for_death"  type="text" value="<?php echo isset($efPart4[base64_encode('Total_6c')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6c')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <label> <strong>{{ __('6d. Other') }}</strong> {{ __('Add all other priority
                                        unsecured
                                        claims.
                                        Write that amount here.') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <label>{{ __('6d.') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Total_6d');?>" type="text" value="<?php echo isset($efPart4[base64_encode('Total_6d')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6d')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <label> <strong>{{ __('6e. Total') }}</strong> {{ __('Add lines 6a through 6d.') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <label>6e.</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
										<?php
                                                $totalTaxes = $efMain[base64_encode('Total_6a')] ?? $totalClaimDomestic;
        $totalTaxes += $efMain[base64_encode('Total_6b')] ?? $totalTaxesAmountOtherThanDSO;
        $totalTaxes += $efMain[base64_encode('Total_6c')] ?? Helper::priceFormtWithComma('');
        $totalTaxes += $efMain[base64_encode('Total_6d')] ?? Helper::priceFormtWithComma('');
        ?>
                                        <input name="<?php echo base64_encode('Total_6e');?>" id="e_f_total_claims_part1"  type="text" value="<?php echo isset($efPart4[base64_encode('Total_6e')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6e')]) : Helper::priceFormtWithComma($totalTaxes);?>" class="price-field fi_schedule_ef_priority_unsecured_claims form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row part 3.1 -->

				<?php
                $studentLoans = 0;
        $otherDebtsAmount = 0;
        $cards_collections = ArrayHelper::getDebtCardSelectionsForAttorney();
        $inde = 1;
        foreach ($debtTaxes as $debt) {
            $studentCheckbox = Helper::validate_key_value('cards_collections', $debt);
            $studentChecked = '';
            $otherChecked = '';
            $otherValue = '';
            if ($studentCheckbox == 5) {
                $studentChecked = "checked";
                $studentLoans += Helper::validate_key_value('amount_owned', $debt, 'float');
            } else {
                $otherDebtsAmount += Helper::validate_key_value('amount_owned', $debt, 'float');
                $otherChecked = 'checked';
                $otherValue = $cards_collections[$studentCheckbox];
            }

        }

        ?>


<div class="col-md-12">
                <div class="row ">
                    <div class="col-md-6 ef"></div>
                    <div class="col-md-6 column-heading text-center ef">
                        <strong class="padd-10 d-block">{{ __('Total claim') }}</strong>
                    </div>
                    <div class="col-md-12 ef">
                        <div class="row">
                            <div class="col-md-1 column-heading ef">
                                <div class="ef input-group">
                                    <label>{{ __('Total claims from Part 2') }}  </label>
                                </div>
                            </div>
							<div class="col-md-11">
								<div class="row">
									<div class="col-md-6">
									<div class="input-group mb-3">
										<label> <strong>{{ __('6f. Student loans') }}</strong>
										</label>
									</div>
									</div>

									<div class="col-md-1">
										<div class="input-group">
											<label>{{ __('6f.') }}
											</label>
										</div>
									</div>

									<div class="col-md-5">
										<div class="input-group d-flex ">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">$</span>
											</div>
											<input name="<?php echo base64_encode('Total_6f');?>" type="text" id="ef_student_loan" value="<?php echo isset($efPart4[base64_encode('Total_6f')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6f')]) : Helper::priceFormtWithComma($studentLoans);?>" class="price-field form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="input-group mb-3">
										<label> <strong>{{ __('6g. Obligations arising out of a separation agreement
										or divorce that you did not report as priority
										claims') }}  </strong>
										</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="input-group">
											<label>{{ __('6g.') }}
											</label>
										</div>
                            		</div>

									<div class="col-md-5">
										<div class="input-group d-flex ">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">$</span>
											</div>
											<input name="<?php echo base64_encode('Total_6g');?>" id="ef_obligation_arising" type="text" value="<?php echo isset($efPart4[base64_encode('Total_6g')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6g')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
										</div>
									</div>
								</div>

								<div class="row">
								<div class="col-md-6">
								<div class="input-group mb-3">
                                    <label> <strong>{{ __('6h. Debts to pension or profit-sharing plans, and other
                                    similar debts') }}</strong>
                                    </label>
                                </div>
								</div>
								<div class="col-md-1">
								<div class="input-group">
                                    <label>{{ __('6h.') }}
                                    </label>
                                </div>
                            	</div>
								<div class="col-md-5">
									<div class="input-group d-flex ">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">$</span>
										</div>
										<input name="<?php echo base64_encode('Total_6h');?>" id="ef_debts_to_pension" type="text" value="<?php echo isset($efPart4[base64_encode('Total_6h')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6h')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
									</div>
								</div>
								</div>

								<div class="row">
									<div class="col-md-6">
									<div class="input-group mb-3">
                                    <label> <strong>{{ __('6i. Other') }}</strong> {{ __('Add all other nonpriority unsecured claims.
                                    Write that amount here.') }}
                                    </label>
                                </div>
									</div>
									<div class="col-md-1">
										<div class="input-group">
										<label>{{ __('6i.') }}
										</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="input-group d-flex ">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">$</span>
										</div>
										<input name="<?php echo base64_encode('Total_6i');?>" type="text" value="<?php echo isset($efPart4[base64_encode('Total_6i')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6i')]) : Helper::priceFormtWithComma($otherDebtsAmount);?>" class="price-field form-control">
									</div>
									</div>

								</div>

								<div class="row">
									<div class="col-md-6">
									<div class="input-group mb-3">
                                    <label> <strong>{{ __('6j. Total') }}</strong> {{ __('Add lines 6f through 6i.') }}
                                    </label>
									</div>
									</div>
									<div class="col-md-1">
										<div class="input-group">
										<label>{{ __('6j.') }}
										</label>
										</div>
									</div>
									<?php
                            $totalStudentLoans = 0;
        $totalStudentLoans += $efMain[base64_encode('Total_6f')] ?? $studentLoans;
        $totalStudentLoans += $efMain[base64_encode('Total_6g')] ?? Helper::priceFormtWithComma('');
        $totalStudentLoans += $efMain[base64_encode('Total_6h')] ?? Helper::priceFormtWithComma('');
        $totalStudentLoans += $efMain[base64_encode('Total_6i')] ?? $otherDebtsAmount;
        ?>
									<div class="col-md-5">
										<div class="input-group d-flex ">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">$</span>
										</div>
										<input name="<?php echo base64_encode('Total_6j');?>" type="text" id="e_f_total_claims_part2" value="<?php echo isset($efPart4[base64_encode('Total_6j')]) ? Helper::priceFormtWithComma($efPart4[base64_encode('Total_6j')]) : Helper::priceFormtWithComma($totalStudentLoans);?>" class="price-field fi_schedule_ef_nonpriority_unsecured_claims form-control">
										</div>
									</div>
								</div>

							</div>


                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <h3 style="text-align:right;">Page {{$pagees}} of {{$totalefCountPages}} </h3>
            </div>
    </form>

    <div  class="row align-items-center avoid-this" style="margin-left:1px;">
    <div class="form-title mb-9" style="margin-top:15px;">
    <button type="submit" href="javascript:void(0)" onclick="generateEFPDF()" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2 print-hide">
    <span class="card-title-text">{{ __('Generate Schedule E/F PDF') }}</span>
    </button>
    </div>
    <div class="form-title mb-9" style="margin-top:15px;">
        <a id="generate_combined_pdf" onclick="printDocument('coles_official-form-106e_and_f')" href="javascript:void(0)">
            <button type="button" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2  generate_combined">
                <span class="card-title-text">{{ __('print')}}</span>
            </button>
        </a>
    </div>
    </div>

    </div>
</section>
