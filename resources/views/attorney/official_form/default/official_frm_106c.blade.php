<section class="page-section official-form-106c padd-20" id="official-form-106c">

    <form name="official_frm_106c" id="official_frm_106c" class="official_frm_106c_first save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
        @csrf
        <input type="hidden" name="form_id" value="106c">
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
        <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b_106c.pdf'; ?>">
        <input type="hidden" name="clientPDFName" value="<?php echo $client_id . '_b_106c.pdf'; ?>">
        <input type="hidden" name="<?php echo base64_encode('B_106-Case number'); ?>" value="<?php echo $caseno; ?>">
        <input type="hidden" name="<?php echo base64_encode('B_106-Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
        <input type="hidden" name="<?php echo base64_encode('B_106-Debtor 2'); ?>" value="<?php echo $spousename; ?>">
        <?php $cMain = isset($dynamicPdfData['106c']) && !empty($dynamicPdfData['106c']) ? json_decode($dynamicPdfData['106c'], 1) : null;
        ?>
        <div class="frm106c container pl-2 pr-0">
            <div class="row">
                <div class="frm106c col-md-7">
                    <div class="frm106c section-box">
                        <div class="frm106c section-header bg-back text-white">
                            <p class="frm106c font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                        </div>
                        <div class="frm106c section-body padd-20">
                            <div class="row">
                                    <div class="frm106c col-md-12">
                                    <div class="frm106c input-group">
                                        <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                        <select class="frm106c form-control district-select" name="<?php echo base64_encode('B_106-Bankruptcy District Information'); ?>" id="district_name"> @foreach ($district_names as $district_name)
                                            <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach
                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="frm106c col-md-5">
                    <div class="frm106c amended">
                        <input type="checkbox" name="<?php echo base64_encode('B_106-Check if this is an'); ?>" <?php echo isset($cMain[base64_encode('B_106-Check if this is an')]) ? Helper::validate_key_toggle(base64_encode('B_106-Check if this is an'), $cMain, 'On') : '';?>>
                        <label>{{ __('Check if this is an amended filing') }}</label>
                    </div>
                </div>
            </div>
            <div class="row padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Schedule C') }}</h4>
                        <!-- <h4>{{ __('Official Form 106C') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Schedule C: The Property You Claim as Exempt') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14">{{ __('Be as complete and accurate as possible. If two married people are filing together, both are equally responsible for supplying correct information. Using the property you listed on Schedule A/B: Property (Official Form 106A/B) as your source, list the property that you claim as exempt. If more space is needed, fill out and attach to this page as many copies of Part 2: Additional Page as necessary. On the top of any additional pages, write your name and case number (if known).') }} </p>
                        <p class="font-lg-14"><strong>{{ __('For each item of property you claim as exempt,
                                you
                                must specify the amount of the exemption you claim. One way of doing
                                so
                                is to state a
                                specific dollar amount as exempt. Alternatively, you may claim the
                                full
                                fair market value of the property being exempted up to the amount
                                of any applicable statutory limit. Some exemptions—such as those for
                                health aids, rights to receive certain benefits, and tax-exempt
                                retirement funds—may be unlimited in dollar amount. However, if you
                                claim an exemption of 100% of fair market value under a law that
                                limits the exemption to a particular dollar amount and the value of
                                the
                                property is determined to exceed that amount, your exemption
                                would be limited to the applicable statutory amount.') }} </strong> </p>
                    </div>
                </div>
            </div>

            <!-- Part 1 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                        <h2 class="font-lg-18">{{ __('Identify the Property You Claim as Exempt') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <!-- Row 1 -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group d-inline-block">
                            <label for=""> <strong class="d-block">{{ __('1. Which set of exemptions are you claiming?') }}
                                </strong> {{ __('Check one only, even if your spouse is filing with you.') }} </label>
                        </div>
                        <div class="input-group">
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_106-check 1'); ?>" value="state and federal" type="checkbox" <?php echo isset($cMain[base64_encode('B_106-check 1')]) ? Helper::validate_key_toggle(base64_encode('B_106-check 1'), $cMain, 'state and federal') : '';?>>
                                <label>{{ __('You are claiming state and federal nonbankruptcy exemptions. 11 U.S.C. § 522(b)(3)') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_106-check 1'); ?>" value="federal" type="checkbox" <?php echo isset($cMain[base64_encode('B_106-check 1')]) ? Helper::validate_key_toggle(base64_encode('B_106-check 1'), $cMain, 'federal') : '';?>>
                                <label>{{ __('You are claiming federal exemptions. 11 U.S.C. § 522(b)(2)') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 2 -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group">
                                <label><strong class="d-block">{{ __('2. For any property you list on
                                        Schedule
                                        A/B that you claim as exempt, fill in the information
                                        below.') }}</strong></label>
                            </div>
                        </div>
                    </div>
                    <table class="table custom-table">
                        <tr class="column-heading">
                            <td style="width:20%;">
                                <div class="input-group"> <strong>{{ __('Brief description of the property and line on
                                        Schedule A/B that lists this property') }}</strong> </div>
                            </td>
                            <td style="width:20%;">
                                <div class="input-group"> <strong>{{ __('Current value of the
                                        portion you own') }}</strong>
                                    <p>{{ __('Copy the value from Schedule A/B') }}</p>
                                </div>
                            </td>
                            <td style="width:20%;">
                                <div class="input-group"> <strong>{{ __('Amount of the exemption you claim') }}</strong> <i>{{ __('Check only one box for each exemption') }}</i> </div>
                            </td>
                            <td style="width:40%;">
                                <div class="input-group"> <strong>{{ __('Specific laws that allow exemption') }}</strong> </div>
                            </td>
                        </tr>

                        <tbody>

                        <?php
                       $scheduleC = [];

        if (!empty($propertyresident)) {
            foreach ($propertyresident as $residence) {
                if (!empty($residence['currently_lived'])) {
                    $address = Helper::validate_key_value('Address', $BasicInfoPartA);
                    if ($residence['not_primary_address'] == 1) {
                        $address = $residence["mortgage_address"];
                    }
                    $thisresidence = [];
                    $thisresidence['description'] = $address;
                    $thisresidence['form_ab_line_no'] = $residence['form_ab_line_no'];
                    $thisresidence['property_value'] = $residence['estimated_property_value'];
                    array_push($scheduleC, $thisresidence);
                }
            }
        }

        if (!empty($propertyvehicle)) {
            foreach ($propertyvehicle as $vehicle) {
                if ($vehicle['own_any_property'] == 1) {
                    $thisvehicle = [];
                    $thisvehicle['description'] = $vehicle['property_make'].' '.$vehicle['property_model'].' '.$vehicle['property_mileage'];
                    $thisvehicle['form_ab_line_no'] = $vehicle['form_ab_line_no'];
                    $thisvehicle['property_value'] = $vehicle['property_estimated_value'];
                    array_push($scheduleC, $thisvehicle);
                }
            }
        }





        if (!empty($commercial_assets) && $commercial_assets['is_farm_property']) {
            $ab_line = '';
            foreach ($commercial_assets as $k => $commercial) {
                if ($commercial['type'] != 'is_farm_property') {
                    if ($ab_line == '') {
                        $ab_line = ($commercial['form_ab_line_no'] != '') ? $commercial['form_ab_line_no'] : '47'  ;
                    }
                    $thiscommercial = [];
                    $thiscommercial['description'] = array_key_exists("description", $commercial) ? $commercial['description'] : '';
                    $thiscommercial['form_ab_line_no'] = ($commercial['form_ab_line_no'] != '') ? $commercial['form_ab_line_no'] : $ab_line;
                    $thiscommercial['property_value'] = array_key_exists("property_value", $commercial) ? $commercial['property_value'] : 0;
                    array_push($scheduleC, $thiscommercial);
                    $ab_line++;
                }
            }
        }



        array_push($scheduleC, $household_goods);
        array_push($scheduleC, $electronics);
        array_push($scheduleC, $collectibles);
        array_push($scheduleC, $sports);
        array_push($scheduleC, $firearms);
        array_push($scheduleC, $clothing);
        array_push($scheduleC, $jewelry);
        array_push($scheduleC, $pets);
        array_push($scheduleC, $health_aids);


        if (!empty($financial_assests)) {
            foreach ($financial_assests as $k => $financial) {
                $ab_line_no = '';
                if (isset($financial['description'])) {
                    if (!is_array($financial['description'])) {
                        $thisfinancial = [];
                        $thisfinancial['description'] = $financial['description'];
                        $thisfinancial['form_ab_line_no'] = $financial['form_ab_line_no'];
                        $thisfinancial['property_value'] = !empty($financial['property_value']) && is_array($financial['property_value'] && isset($financial['property_value'][0])) ? $financial['property_value'][0] ?? '' : '';
                        array_push($scheduleC, $thisfinancial);
                    } else {
                        foreach ($financial['description'] as $key => $value) {
                            $ab_line_no = $ab_line_no == '' ? ((float)$financial['form_ab_line_no'] + .1) : ((float)$ab_line_no + .1);
                            $thisfinancial = [];
                            $thisfinancial['description'] = $value;
                            $thisfinancial['form_ab_line_no'] = (float)$ab_line_no;
                            $thisfinancial['property_value'] = !empty($financial['property_value']) && is_array($financial['property_value'] && isset($financial['property_value'][$key])) ? (float)$financial['property_value'][$key] ?? '' : '';
                            array_push($scheduleC, $thisfinancial);
                        }
                    }
                }
            }
        }
        $count = count($scheduleC);
        $page1C = array_slice($scheduleC, 0, 3);
        $page2C = array_slice($scheduleC, 3, $count);

        $page21C = !empty($page2C) && count($page2C) > 12 ? array_slice($page2C, 0, 12) : $page2C;
        $page22C = !empty($page2C) && count($page2C) > 12 ? array_slice($page2C, 12, count($page2C)) : [];

        $schGroup = array_chunk($page22C, 12);
        $totalCountPages = count($schGroup);
        if ($totalCountPages > 0) {
            $totalCountPages = $totalCountPages + 2;
        }


        ?>

                    <?php
            $ins = 1;
        foreach ($page1C as $schc) {
            $schName = LocalFormHelper::schedule_c_part1($ins);
            ?>
                    <tr>
                        <td style="width:20%;">
                            <div class="input-group">
                                <label class="font-lg-14">{{ __('Brief description:') }}</label>
                                <div class="input-group">
                                <textarea name="<?php echo base64_encode($schName['description']); ?>"  cols="15" rows="3" class="form-control"><?php echo $cMain[base64_encode($schName['description'])] ?? Helper::validate_key_value('description', $schc);?></textarea>
                                   </div>
                            </div>
                            <div class="input-group d-flex">
                                <label class="font-lg-14 align-center-scc">{{ __('Line from Schedule A/B:') }}</label>
                                <div class="input-group size-boxscc">
                                    <input name="<?php echo base64_encode($schName['line']); ?>" type="text" value="<?php echo $cMain[base64_encode($schName['line'])] ?? (isset($schc['form_ab_line_no']) ? $schc['form_ab_line_no'] : ''); ?>" class="form-control"> </div>
                            </div>
                        </td>
                        <td style="width:20%;">
                            <div class="input-group d-flex">
                                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                <input data-pricecurrent = "<?php echo Helper::validate_key_value('form_ab_line_no', $schc);?>" name="<?php echo base64_encode($schName['currentValue']); ?>" type="text" value="<?php echo $cMain[base64_encode($schName['currentValue'])] ?? (isset($schc['property_value']) ? $schc['property_value'] : ''); ?>" class="price-field form-control"> </div>
                        </td>
                        <td style="width:20%;">
                            <div class="input-group d-flex">
                                <input name="<?php echo base64_encode($schName['claimCheckbox']); ?>" checked="checked" value="On" type="checkbox" <?php echo isset($cMain[base64_encode($schName['claimCheckbox'])]) ? Helper::validate_key_toggle(base64_encode($schName['claimCheckbox']), $cMain, 'On') : '';?>>
                                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                <input data-priceclaim = "<?php echo Helper::validate_key_value('form_ab_line_no', $schc);?>"  name="<?php echo base64_encode($schName['claimValue']); ?>" type="text" value="<?php echo $cMain[base64_encode($schName['claimValue'])] ?? (isset($schc['property_value']) ? $schc['property_value'] : ''); ?>" class="price-field form-control"> </div>
                            <div class="input-group d-flex">
                                <input name="<?php echo base64_encode($schName['claimCheckbox']); ?>" value="fair market" type="checkbox" <?php echo isset($cMain[base64_encode($schName['claimCheckbox'])]) ? Helper::validate_key_toggle(base64_encode($schName['claimCheckbox']), $cMain, 'fair market') : '';?>>
                                <label for=""> {{ __('100% of fair market value, up to any applicable statutory limit') }} </label>
                            </div>
                        </td>
                        <td style="width:40%;">
                            <div class="input-group myclass" >
                                <div data-pagefrom="1" class="exemp_select linefromdb_<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schc));?> linefrom_<?php echo floor(Helper::validate_key_value('form_ab_line_no', $schc, 'float'));?>" data-linefrom = "<?php echo Helper::validate_key_value('form_ab_line_no', $schc);?>"   data-lineufrom = "<?php echo str_replace(".", "_", Helper::validate_key_value('form_ab_line_no', $schc));?>"  data-optionid="<?php echo Helper::validate_key_value('property_value', $schc, 'comma');?>"></div>
                                @include("components.exemtionPopup")
                                <textarea data-exemption = "<?php echo Helper::validate_key_value('form_ab_line_no', $schc);?>" name="<?php echo base64_encode($schName['law']); ?>"  cols="15" rows="4" class="form-control exemption-by-attorney <?php echo('law_'.floor(Helper::validate_key_value('form_ab_line_no', $schc, 'float')));?>"><?php echo $cMain[base64_encode($schName['law'])] ?? '';?></textarea>
                                <input type="hidden" name="linefrom_<?php echo Helper::validate_key_value('form_ab_line_no', $schc);?>" value="<?php echo $cMain["linefrom_".Helper::validate_key_value('form_ab_line_no', $schc)] ?? ''; ?>">
                               <?php
                        $string = "hiddenlinefrom_".str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schc));
            $linefromdb = $cMain[$string] ?? '';
            ?>
                               
                                <input data-lval="{{$linefromdb}}" data-line="<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schc)); ?>" type="hidden" data-linefrom="<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $schc));?>" class="sc_c_description" name="{{$string}}" value="<?php echo $linefromdb; ?>">

                            </div>
                        </td>
                    </tr>
                    <?php $ins++;
        } ?>
                    
                    </tbody>
                </table>
            </div>
            <!-- Row 3 -->
           
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="input-group">
                        <label><strong class="d-block">{{ __('3. Are you claiming a homestead exemption
                                of more than $170,350?') }}</strong>{{ __('(Subject to adjustment on 4/01/22 and every 3 years after that for cases filed on or after the date of adjustment.)') }}</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <input  name="<?php echo base64_encode('B_106-check 3'); ?>" value="no" type="checkbox" <?php echo isset($cMain[base64_encode('B_106-check 3')]) ? Helper::validate_key_toggle(base64_encode('B_106-check 3'), $cMain, 'no') : '';?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group">
                        <input  name="<?php echo base64_encode('B_106-check 3'); ?>" value="yes" type="checkbox" <?php echo isset($cMain[base64_encode('B_106-check 3')]) ? Helper::validate_key_toggle(base64_encode('B_106-check 3'), $cMain, 'yes') : '';?>>
                        <label>{{ __('Yes. Did you acquire the property covered by the exemption within 1,215 days before you filed this case?') }} </label>
                    </div>
                </div>
                <div class="col-md-12 pl-4">
                    <div class="input-group ml-3">
                        <input  name="<?php echo base64_encode('B_106-check 3-1'); ?>" value="no" type="checkbox" <?php echo isset($cMain[base64_encode('B_106-check 3-1')]) ? Helper::validate_key_toggle(base64_encode('B_106-check 3-1'), $cMain, 'no') : '';?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group ml-3">
                        <input  name="<?php echo base64_encode('B_106-check 3-1'); ?>" value="yes" type="checkbox" <?php echo isset($cMain[base64_encode('B_106-check 3-1')]) ? Helper::validate_key_toggle(base64_encode('B_106-check 3-1'), $cMain, 'yes') : '';?>>
                        <label>{{ __('Yes') }} </label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="<?php echo base64_encode("B_106-page"); ?>" value="{{$totalCountPages}}" >
            <h3 style="text-align:right;">Page 1 of {{$totalCountPages}} </h3>
        </div>

        
            <?php if (!empty($page21C)) {?>

                        <!-- Part 2 -->
                        <div class="part2106c row align-items-center">
                            <div class="part2106c col-md-12">
                                <div class="part2106c part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                                    <h2 class="part2106c font-lg-18">{{ __('Additional Page') }}
                                    </h2> </div>
                            </div>
                        </div>
                        <div class="part2106c form-border pr-0 pl-0 mb-3">
                            <table class="part2106c table custom-table">
                                <tr class="part2106c column-heading">
                                    <td style="width:20%;">
                                        <div class="part2106c input-group"> <strong>{{ __('Brief description of the property and line on
                                                Schedule A/B that lists this property') }}</strong> </div>
                                    </td>

                                    <td style=" width:20%;">
                                        <div class="part2106c input-group"> <strong>{{ __('Current value of the
                                                portion you own') }}</strong>
                                            <p>{{ __('Copy the value from Schedule A/B') }}</p>
                                        </div>
                                    </td>
                                    <td style=" width:20%;">
                                        <div class="part2106c input-group"> <strong>{{ __('Amount of the exemption you claim') }}</strong> <i>{{ __('Check only one box for each exemption') }}</i> </div>
                                    </td>

                                    <td style="width:40%;">
                                        <div class="part2106c input-group"> <strong>{{ __('Specific laws that allow exemption') }}</strong> </div>
                                    </td>
                                </tr>

                                <?php $ins2 = 1;
                foreach ($page21C as $page1schc) {

                    $sch2Name = LocalFormHelper::schedule_c_part2($ins2);
                    ?>
                              
                                    <tr>

                                        <td style="width:20%;">
                                            <div class="part2106c input-group">
                                                 <label class="part2106c font-lg-14">{{ __('Brief description:') }}</label>
                                                <div class="part2106c input-group">
                                                <textarea name="<?php echo base64_encode($sch2Name['description']); ?>"  cols="15" rows="3" class="form-control"><?php echo $cMain[base64_encode($sch2Name['description'])] ?? Helper::validate_key_value('description', $page1schc);?></textarea>
                                                 </div>
                                            </div>
                                            <div class="part2106c input-group d-flex">
                                                 <label class="part2106c font-lg-14 align-center-scc">{{ __('Line from Schedule A/B:') }}</label>
                                                <div class="part2106c input-group size-boxscc">
                                                    <input name="<?php echo base64_encode($sch2Name['line']); ?>" type="text" value="<?php echo $cMain[base64_encode($sch2Name['line'])] ?? (isset($page1schc['form_ab_line_no']) ? $page1schc['form_ab_line_no'] : ''); ?>" class="form-control"> </div>
                                            </div>
                                        </td>
                                        <td style="width:20%;">
                                            <div class="part2106c input-group d-flex">
                                                 <div class="part2106c input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input  data-pricecurrent = "<?php echo Helper::validate_key_value('form_ab_line_no', $page1schc);?>" name="<?php echo base64_encode($sch2Name['currentValue']); ?>" type="text" value="<?php echo $cMain[base64_encode($sch2Name['currentValue'])] ?? (isset($page1schc['property_value']) ? $page1schc['property_value'] : ''); ?>" class="price-field form-control"> </div>
                                        </td>
                                        <td style="width:20%;">
                                            <div class="part2106c input-group d-flex">
                                                 <input name="<?php echo base64_encode($sch2Name['claimCheckbox']); ?>" checked="checked" value="On" type="checkbox" <?php echo isset($cMain[base64_encode($sch2Name['claimCheckbox'])]) ? Helper::validate_key_toggle(base64_encode($sch2Name['claimCheckbox']), $cMain, 'On') : '';?>>
                                                 <div class="part2106c input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                 <input data-priceclaim = "<?php echo Helper::validate_key_value('form_ab_line_no', $page1schc);?>" name="<?php echo base64_encode($sch2Name['claimValue']); ?>" type="text" value="<?php echo $cMain[base64_encode($sch2Name['currentValue'])] ?? (isset($page1schc['property_value']) ? $page1schc['property_value'] : ''); ?>" class="price-field form-control"> </div>
                                            <div class="part2106c input-group d-flex">
                                                 <input name="<?php echo base64_encode($sch2Name['claimCheckbox']); ?>" value="fair market" type="checkbox" <?php echo isset($cMain[base64_encode($sch2Name['claimCheckbox'])]) ? Helper::validate_key_toggle(base64_encode($sch2Name['claimCheckbox']), $cMain, 'fair market') : '';?>>
                                                 <label for=""> {{ __('100% of fair market value, up to any applicable statutory limit') }} </label>
                                            </div>

                                        </td>

                                        <td style="width:40%;">
                                            <div class="part2106c input-group" >
                                                <div data-pagefrom="2" class="part2106c exemp_select linefromdb_<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $page1schc));?>  linefrom_<?php echo floor(Helper::validate_key_value('form_ab_line_no', $page1schc, 'float'));?>" data-lineufrom = "<?php echo str_replace(".", "_", Helper::validate_key_value('form_ab_line_no', $page1schc));?>" data-linefrom = "<?php echo Helper::validate_key_value('form_ab_line_no', $page1schc);?>" data-optionid="<?php echo Helper::validate_key_value('property_value', $page1schc, 'comma');?>"></div>
                                                @include("components.exemtionPopup")
                                                <textarea data-exemption = "<?php echo Helper::validate_key_value('form_ab_line_no', $page1schc);?>"  name="<?php echo base64_encode($sch2Name['law']); ?>"  cols="15" rows="4" class="form-control part2106c exemption-by-attorney <?php echo('law_'.floor(Helper::validate_key_value('form_ab_line_no', $page1schc, 'float'))); ?>"><?php echo $cMain[base64_encode($sch2Name['law'])] ?? '';?></textarea>
                                                <input type="hidden" name="linefrom_<?php echo floor(Helper::validate_key_value('form_ab_line_no', $page1schc, 'float'));?>" value="0">
                                                <?php
                                    $string = "hiddenlinefrom_".str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $page1schc));
                    $linefromdb = $cMain[$string] ?? '';
                    ?>

                                                <input data-lval="{{$linefromdb}}" type="hidden" data-linefrom="<?php echo str_replace('.', '_', Helper::validate_key_value('form_ab_line_no', $page1schc));?>" class="sc_c_description" name="{{$string}}" value="<?php echo $linefromdb; ?>">
                                            </div>
                                        </td>

                                    </tr>
                                <?php $ins2++;
                } ?>
                              
                               
                                
                                <!-- Row end -->
                                </tbody>
                            </table>

                            <input type="hidden" name="<?php echo base64_encode('1.B_106-page 2')?>" value="2">
                            <input type="hidden" id="schc_tot_pages" name="<?php echo base64_encode("1.B_106-page"); ?>" value="{{$totalCountPages}}" >
                            <h3 style="text-align:right;">Page 2 of {{$totalCountPages}} </h3>
                        </div>
                    <?php } ?>
            </div>
    </form>


               	
    <?php
   $j = 2;
        $pageno = 3;
        $codeCount = $j;
        $borderClass = '';
        $itretion = 2;
        foreach ($schGroup as $listSch) {
            if (!empty($listSch)) {
                if ($codeCount != $j) {
                    $codeCount = $codeCount + 11;
                }

                ?>
 @include("attorney.official_form.default.official_frm_106c_add",['inSch' => $listSch,'index' => $codeCount,'part' => $itretion,'totalpages' => ($totalCountPages),'pageno' => $pageno])
	<?php $itretion++;
                $pageno++;
                $codeCount++;
            }
        } ?>

    <div class="row align-items-center avoid-this" style="margin-left:1px;">
        <div class="form-title mb-9" style="margin-top:15px;">
            <button type="submit" onclick="generateIndividualPDF('official_frm_106c_first','official_frm_106c')" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2 print-hide">
                <span class="card-title-text">{{ __('Generate Schedule C (Exemptions) PDF') }}</span>
            </button>
        </div>
        <div class="form-title mb-9" style="margin-top:15px;">
            <a id="generate_combined_pdf" onclick="printDocument('coles_official-form-106c')" href="javascript:void(0)">
                <button type="button" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2  generate_combined">
                    <span class="card-title-text">{{ __('print')}}</span>
                </button>
            </a>
        </div>
    </div>
</section>

<style>
    table.table.custom-table tbody {
        position: relative;
    }

    .exemp-sel-options {
        position: absolute;
        background: #fff;
        left: 12px;
        right: 12px;
        border: 1px solid #000;
        top: 47px;
        z-index: 1;
        display: none;
    }

    .exemp-sel-options .row {
        margin: 0;
    }

    .table-head-cs>div {
        background: #EDEEF0;
        color:#000;
    }

    .exemp-sel-options .table-head-cs h3 {
        padding: .2rem 0;
        /* color: #414141; */
        font-weight: 600;
    }

    .table-body-cs-inner>div {
        padding-top: 5px;
        padding-bottom: 5px;
        border-bottom: 1px solid #eaeaea;
    }

    .table-body-cs-inner p {
        margin: 0;
        color: #414141;
        font-weight: normal;
        font-size: 13px;
    }

    .table-body-cs-inner.row:hover {
        background: #0a95ff;
    }

    .table-body-cs-inner.row:hover * {
        color: #fff;
    }

    table.table.custom-table tbody tr {
        position: relative;
    }

    .table-body-cs-inner.row {
        cursor: pointer;
    }



    button.btn.btn-primary.exemption-sel {
        border-radius: 5px;
        position: relative;
        padding-right: 25px;
        padding-left:  5px;
        padding-top:2px;
        padding-bottom:0px;
        min-height: 35px;
        width: 100%;
        text-overflow: ellipsis;
        display: -webkit-box !important;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 35px;
        font-size: 13px;
        text-align:left;
    }

    .exemp-red {
        border: 1px solid #f00;
    }

    .exemp-green {
        border: 1px solid #388711;
    }

    button.btn.btn-primary.exemption-sel:after {
        content: "";
        height: 10px;
        width: 10px;
        border-style: solid;
        border-color: #000;
        border-width: 0px 1.5px 1.5px 0px;
        transform: rotate(45deg);
        transition: border-width 150ms ease-in-out;
        position: absolute;
        right: 10px;
        top: 9px;
    }
</style>