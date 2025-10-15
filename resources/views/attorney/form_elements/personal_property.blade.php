@php

use App\Helpers\ClientHelper;

$propertyresident = $property_info['propertyresident']->toArray();

$propertyvehicle = $property_info['propertyvehicle']->toArray();

$propertyhousehold = $property_info['propertyhousehold'];

$financialassets = $property_info['financialassets'];

$businessassets = $property_info['businessassets'];

$farmcommercial = $property_info['farmcommercial'];

$miscellaneous = $property_info['miscellaneous'];

$isFACEditButtonShown = false;

$detailed_tab_items_popup_route = route('detailed_tab_items_popup_att_edit');

$household_items = [ 
    "household_goods_furnishings" => "Household Goods and Furnishings (Major appliances, furniture, linens, china, kitchenware, etc.)",
    "electronics" => "Electronics (TVs, stereos, computers, game consoles, tablets, iPods, mobile phones, etc.)" ,
    "collectibles" => "Collectibles of value (art, paintings, prints, memorabilia, antiques, stamp/coin/card collections, etc.)" ,
    "sports" => "Sports, photo, exercise, and other hobby equipment; musical instruments" ,
    "firearms" => "Firearms, ammunition, and related equipment" ,
    "clothing" => "Clothing (everyday clothes, furs, leather coats, designer wear, shoes, accessories)" ,
    "jewelry" => "Jewelry" ,
    "pets" => "Pets/non-farm animals" ,
    "health_aids" => "Health aids and all other household items not listed" ];


if (isset($personalHouseholdSettings) && !empty($personalHouseholdSettings) && $detailed_property == 0) {
    foreach ($personalHouseholdSettings as $key => $value) {
        if (isset($value['parent_label']) && !empty($value['parent_label'])) {
            $household_items[$key] = $value['parent_label'];
        }
    }
}    
@endphp

<div class="outline-gray-border-area">
    <div class="section-title-div mt-3 mb-4">
        <h3 class="">Personal and Household Items</h3>
        <div class="section-edit-div">
            <x-attorney.attorneyEditButton 
                :route="route('property_step3_modal')" 
                :isEdited="$isPropertyHouseholdEdited"
                extraClass="text-bold"
            />
            <x-attorney.attorneyEditReviewed 	
                :reviewedData="$isPropertyHouseholdEdited"
                extraClass="ml-3"
            />
        </div>
    </div>
</div>

<div class="part-a outline-gray-border-area">
    <?php
        if (!empty($propertyhousehold)) {
            $countindex = 6;
            foreach ($propertyhousehold as $key => $household) {
                ?>
        <div class="light-gray-div">
            <div class="light-gray-box-form-area">
                <h2 class="font-weight-bold align-items-center <?php echo @$hide_docs == true ? "hide-data" : "";  ?>">
                    <span class="item-label">Item </span>
                    <div class="ml-2 circle-number-div"><?php echo $countindex; ?></div>
                    <span class="item-label questionaire-label">{{$household_items[$household['type']]}} </span>                    
                    <span class="lable-sub-section text-danger item-label"><?php echo Helper::keyDisplayRemoveYes('type_value', $household)?></span> 
                </h2>
                <div class="row gx-3 set-mobile-col">
                    

                    <div class="row col-md-12 <?php echo Helper::key_hide_show_v('type_value', $household)?>">
                    
                        <?php if (is_array(json_decode($household['type_data'], 1))) {
                            $household_data = json_decode($household['type_data'], 1);
                            $description = $household_data[0] ?? '';
                            $descriptionValue = isset($household_data[1]) ? number_format((float)$household_data[1], 2, '.', ',') : '0.00';
                            $indexArray = [6,7,8,9,12];
                            $itemsListArray = [
                                6 => 'getHouseholdItemsList',
                                7 => 'getElectronicItemsList',
                                8 => 'getCollectiblesList',
                                9 => 'getHobbyEquipmentsList',
                                12 => 'getJewelryItemsList'
                            ];

                            if (in_array($countindex, $indexArray) && $detailed_property == 1) {
                                $i = 0;
                                if (is_array($household_data) && array_keys($household_data) === range(0, count($household_data) - 1)) {
                                    ?>
                           
                            <div class="col-8 col-md-9">
                                <label class="font-weight-bold lable-main-section">Description:</label>
                            </div>
                            <div class="col-4 col-md-3">
                                <label class="font-weight-bold lable-main-section">Property Value:</label>
                            </div>
                            <div class="col-8 col-md-9">
                                <span class="font-weight-normal lable-sub-section <?php echo 'detailed_description_'.$household['type']; ?>"><?php echo Helper::validate_key_value(0, $household_data); ?></span>
                            </div>
                            <div class="col-4 col-md-3">
                                <label class="font-weight-bold lable-main-section">
                                    <span class="font-weight-normal lable-sub-section text-success <?php echo 'detailed_amount_'.$household['type']; ?>">$<?php echo Helper::validate_key_value(1, $household_data)?></span>
                                </label>
                            </div>
                        <?php
                                } else {
                                    foreach ($household_data as $key => $value) {
                                        $listName = $itemsListArray[$countindex];
                                        $description = ArrayHelper::$listName($key);
                                        $description = is_array($description) ? '' : $description;
                                        $descriptionValue = array_values($household_data)[$i];
                                        ?>
                                                <div class="col-md-9">
                                                    <label class="font-weight-bold lable-main-section">
                                                        <span class="font-weight-normal lable-sub-section"><?php echo $description ?? ''; ?></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="font-weight-bold lable-main-section">
                                                        <span class="font-weight-normal lable-sub-section text-success px-2">$<?php echo $descriptionValue ?? ''; ?></span>
                                                    </label>
                                                </div>
                                            <?php $i++;
                                    }
                                }
                            } else {
                                ?>
                       
                            <div class="col-8 col-md-9">
                                <label class="font-weight-bold lable-main-section">Description:</label>
                            </div>
                            <div class="col-4 col-sm-3">
                                <label class="font-weight-bold lable-main-section">Property Value:</label>
                            </div>
                            <div class="col-8 col-sm-9">
                                <span class="font-weight-normal lable-sub-section"><?php echo $description; ?></span>
                            </div>
                            <div class="col-4 col-sm-3">
                                <label class="font-weight-bold lable-main-section">
                                    <span class="font-weight-normal lable-sub-section text-success">$<?php echo $descriptionValue;?></span>
                                </label>
                            </div>
                        <?php   }
                        }
                ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
                $countindex++;
            }
        }
    ?>
</div>

<?php

    $countindex = 16;
    $financial_assets = AddressHelper::financial_assets_array();

    $life_insurance = [];
    $life_insurance = array_filter($financialassets, function ($item) {
        if ($item['type'] === 'life_insurance') {
            return $item['type'] === 'life_insurance';
        }

        return [];
    });
    $life_insurance = !empty($life_insurance) ? array_shift($life_insurance) : [];
    $financialassets = array_filter($financialassets, function ($item) {
        return $item['type'] !== 'life_insurance';
    });
    ?>

<div class="outline-gray-border-area">
    <div class="section-title-div mt-3 mb-4">
        <h3 class="">Financial Assets</h3>
        <div class="section-edit-div">
            <x-attorney.attorneyEditButton 
                :route="route('property_step4_modal')" 
                :isEdited="$isPropertyFinancialAssetEdited"
                extraClass="ml-3 text-bold"
            />
            <x-attorney.attorneyEditReviewed 	
                :reviewedData="$isPropertyFinancialAssetEdited"
                extraClass="ml-3"
            />
        </div>
    </div>
</div>

<div class="part-a outline-gray-border-area">   
    <?php
        $order = array_keys($financial_assets);
    usort($financialassets, function ($a, $b) use ($order) {
        $pos_a = array_search($a['type'], $order);
        $pos_b = array_search($b['type'], $order);

        return $pos_a - $pos_b;
    });
    if (!empty($financialassets)) {

        $structured_data = [];
        foreach ($financialassets as $item) {
            if ($item['form_ab_line_no'] == '17') {
                $type = $item['type'];
                $type_data = json_decode($item['type_data'], true);
                $structured_data[$type] = $type_data;
            }
        }
        $structured_data_json = json_encode($structured_data);
        $financialassets = array_filter($financialassets, function ($item) {
            $remove_types = ["venmo_paypal_cash", "brokerage_account"];

            return !in_array($item['type'], $remove_types);
        });

        // Reset array indices (optional)
        $financialassets = array_values($financialassets);
        $i = 0;


        foreach ($financialassets as $key => $financial) {
            if ($financial['type'] === "bank") {
                $financial['type_data'] = $structured_data_json;
            }

            $financial_data = json_decode($financial['type_data'], 1);

            if ($financial['type'] === "bank") {

                foreach ($financial_data as $key => &$data) {
                    if (isset($data) && !empty($data)) {
                        $count = count(reset($data)); // Get the count of the first array in the sub-array
                        $data['account_for'] = array_fill(0, $count, $key);
                    }
                }

                $desiredOrder = ["bank", "venmo_paypal_cash", "brokerage_account"];
                uksort($financial_data, function ($keyA, $keyB) use ($desiredOrder) {
                    $posA = array_search($keyA, $desiredOrder);
                    $posB = array_search($keyB, $desiredOrder);

                    return $posA <=> $posB;
                });

                $merged = [];
                foreach ($financial_data as $keyname => $array) {
                    $listCount = 0;
                    if (!empty($array)) {
                        foreach ($array as $key => $values) {
                            if (!isset($merged[$key])) {
                                $merged[$key] = [];
                            }
                            $merged[$key] = array_merge($merged[$key], $values);
                        }
                    }
                }
                $financial_data = $merged;
            }

            $type = $financial['type'];
            $array = ['type_value' => $financial['type_value'],'type' => $financial['type']];
            $index = ArrayHelper::getIndex($array);
            ?>
            <?php   if (in_array($type, Helper::PROPERTY_FINANCIAL_ASSETS_CONTINUTED_QUE_KEYS) && !$isFACEditButtonShown) {?>
                <div class="outline-gray-border-area col-12 px-0">
                    <div class="section-title-div  mb-4">
                        <h3 class="">Financial Assets Continued</h3>
                        <div class="section-edit-div">
                            <x-attorney.attorneyEditButton 
                                :route="route('property_step5_modal')" 
                                :isEdited="$isPropertyFinancialAssetContinuedEdited"
                                extraClass="ml-3 text-bold"
                            />
                            <x-attorney.attorneyEditReviewed 	
                                :reviewedData="$isPropertyFinancialAssetContinuedEdited"
                                extraClass="ml-3"
                            />
                        </div>
                    </div>
                </div>
            <?php
                        $isFACEditButtonShown = true;
            }
            ?>

            <?php if ($array['type'] == 'cash') { ?>
                <div class="light-gray-div">
                    <div class="light-gray-box-form-area">
                        <h2 class="font-weight-bold align-items-center <?php echo @$hide_docs == true ? "hide-data" : "";  ?>">
                            <span class="item-label">Item </span>
                            <div class="ml-2 circle-number-div"><?php echo $countindex; ?></div>
                            <span class="item-label questionaire-label">{{ @$financial_assets[$type] }} </span>                    
                            <span class="lable-sub-section text-danger item-label"><?php echo Helper::keyDisplayRemoveYes('type_value', $financial)?> {{Helper::validate_enable_disable($array['type'],$financialAssetsSettings)}}</span> 
                        </h2>
                        <div class="row gx-3 set-mobile-col">
                            @if($financial['type_value'] ==1)
                                <div class="col-md-9">
                                    <label class="font-weight-bold lable-main-section">
                                        {{ @$financial_assets[$type] }}
                                        <span class=" text-danger"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold lable-main-section">Property Value:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <div class="col-md-9">

                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold lable-main-section">
                                        <span class="font-weight-normal lable-sub-section text-success">
                                            <?php echo "$".number_format((float)Helper::validate_key_loop_value('property_value', $financial_data, 0), 2, '.', ','); ?>
                                        </span>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($array['type'] != 'cash') {?>
                <div class="light-gray-div">
                    @php
                        $overflow_types = ['bank', 'alimony_child_support', 'unpaid_wages',
                        'insurance_policies'];
                    @endphp
                    <div class="light-gray-box-form-area {{in_array($array['type'], $overflow_types) ? 'overflow-y-auto w-100' : ''}}">
                        <h2 class="font-weight-bold align-items-center <?php echo @$hide_docs == true ? "hide-data" : "";  ?>">
                            <span class="item-label">Item </span>
                            <div class="ml-2 circle-number-div"><?php echo $countindex; ?></div>
                            <span class="item-label questionaire-label">{{ @$financial_assets[$type] }} </span>                  
                            <?php if ($type == 'insurance_policies') {
                                if (Helper::validate_key_value('type_value', $financial, 'radio') == 0 && Helper::validate_key_value('type_value', $life_insurance, 'radio') == 0) {
                                    ?>   
                                    
                                <span class="item-label text-danger"> :None  {{Helper::validate_enable_disable($type,$financialAssetsSettings)}}</span>
                            <?php   }
                                ?>
                            <?php } elseif (in_array($type, ['other_financial'])) {?>
                                :<span class="item-label text-danger">
                                    <?php echo 'None'; ?>  {{Helper::validate_enable_disable($type,$financialAssetsSettings)}}
                                </span>
                           <?php   } else { ?>
                                <span class="item-label text-danger">
                                    <?php echo Helper::keyDisplayRemoveYes('type_value', $financial); ?> {{Helper::validate_enable_disable($type,$financialAssetsSettings)}}
                                </span>
                            <?php } ?>  
                        </h2>
                        @php
                        
                            $min_width = 0;
                            switch ($array['type']) {
                                case 'bank':
                                    $min_width = 1400;
                                    break;
                                case 'alimony_child_support':
                                    $min_width = 950;
                                    break;
                                case 'unpaid_wages':
                                    $min_width = 950;
                                    break;
                                case 'insurance_policies':
                                    $min_width = 950;
                                    break;
                                default:
                                    # code...
                                    break;
                            };
                        @endphp
                        <div class="row gx-3 set-mobile-col" style="{{$min_width != 0 ? 'min-width: '.$min_width.'px; margin: 0px;' : ''}}">
                            <?php
                                $showDataDiv = Helper::key_hide_show_v('type_value', $financial);
                if ($type == 'insurance_policies') {
                    $showDataDiv = (Helper::validate_key_value('type_value', $financial, 'radio') == 1 || Helper::validate_key_value('type_value', $life_insurance, 'radio') == 1) ? '' : 'hide-data' ;
                }
                if (in_array($type, ['other_financial'])) {
                    $showDataDiv = 'hide-data';
                }
                ?>
                            <div class="row m-0 <?php echo $showDataDiv; ?>">
                            <?php $p = 1; ?>
                            <?php if ($type == "insurance_policies") { ?>
                                <div class="col-3">
                                    <label class="font-weight-bold lable-main-section">Company name:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <div class="col-1">
                                    <label class="font-weight-bold lable-main-section">Type:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <div class="col-3">
                                    <label class="font-weight-bold lable-main-section">Beneficiary:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <div class="col-2">
                                    <label class="font-weight-bold lable-main-section">Cash/Current Value:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <div class="col-3 ">
                                    <label class="font-weight-bold lable-main-section">Surrender or value of policy:
                                        <span class="font-weight-normal"></span></label>
                                </div>

                                <?php
                        if (!empty($life_insurance)) {
                            $li_type_data = json_decode($life_insurance['type_data'], 1);
                            if (!empty($li_type_data)) {
                                $li_length = count($li_type_data['account_type']);
                                for ($i = 0; $i < $li_length; $i++) {
                                    ?>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">
                                            <span class="font-weight-normal lable-sub-section ">
                                                <?php echo Helper::validate_key_loop_value('type_of_account', $li_type_data, $i); ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-1">
                                        <label class="font-weight-bold lable-main-section">
                                            <span class="font-weight-normal lable-sub-section ">
                                                <?php echo Helper::validate_key_loop_value('account_type', $li_type_data, $i); ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">
                                            <span class="font-weight-normal lable-sub-section ">
                                                <?php echo Helper::validate_key_loop_value('description', $li_type_data, $i); ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">
                                            <?php if (in_array(Helper::validate_key_loop_value('account_type', $li_type_data, $i), ['Term'])) { ?>
                                                <span class="font-weight-normal lable-sub-section text-danger">$ 0.00</span>
                                            <?php } else { ?>
                                                <span class="font-weight-normal lable-sub-section text-success">
                                                    <?php if (in_array(Helper::validate_key_loop_value('account_type', $li_type_data, $i), ['Whole','Universal'])) {
                                                        echo "$ ".number_format((float)Helper::validate_key_loop_value('current_value', $li_type_data, $i), 2, '.', ',');
                                                    } else {
                                                        echo "";
                                                    } ?>
                                                </span>
                                            <?php } ?>                                
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">
                                            <span class="font-weight-normal lable-sub-section text-success">
                                                <?php echo (Helper::validate_key_loop_value('unknown', $li_type_data, $i) == 1) ? "Unknown" : "$".number_format((float)Helper::validate_key_loop_value('property_value', $li_type_data, $i), 2, '.', ','); ?>
                                                
                                            </span>
                                        </label>
                                    </div>
                                            
                                        <?php if (in_array(Helper::validate_key_loop_value('account_type', $li_type_data, $i), ['Whole','Universal'])) {
                                            $toa = Helper::validate_key_loop_value('type_of_account', $li_type_data, $i);
                                            $documentTypeOfAcc = '';
                                            $l1 = [];
                                            if (Helper::validate_key_loop_value('account_type', $li_type_data, $i) === 'Whole') {
                                                $document_type = $toa.': Whole Life Policy';
                                            }
                                            if (Helper::validate_key_loop_value('account_type', $li_type_data, $i) === 'Universal') {
                                                $document_type = $toa.': Universal Life Policy';
                                            }
                                            $document_name = str_replace(" ", "_", $document_type);
                                            $documentTypeOfAcc = Helper::validate_doc_type($document_name, true);

                                            if (@$hide_docs == false && isset($client_uoloaded_documents[$documentTypeOfAcc])) {
                                                $l1 = $client_uoloaded_documents[$documentTypeOfAcc];
                                            }
                                            if (!$hide_docs && isset($l1) && !empty($l1)) {  ?>
                                        <div class="col-12">
                                            <span class="font-weight-normal bradly-heading fs-18px float-right"><span class="bb-1px-black ml-2">Download Stmt:</span> <a href="<?php echo route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $l1['document_type']]);?>" class="ml-1 text-c-blue" title="<?php echo "Download ".$l1['title'];?>"> <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i></a></span>
                                        </div>
                                        <?php }
                                            } ?>
                                <?php   }
                            }
                        } ?>
                            <?php } ?>
                            <?php if (!empty($financial_data['description']) && is_array($financial_data['description'])) { ?>
                                <?php if ($type == "bank") { ?>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Type Of Account:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">Description:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">Business Name:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-1">
                                        <label class="font-weight-bold lable-main-section">Last 4 digits of Acct. #:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">Personal / Business account:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "mutual_funds") { ?>
                                    <div class="col-8 col-md-9">
                                        <label class="font-weight-bold lable-main-section">Institution or Issuer name:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-4 col-md-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "traded_stocks") { ?>
                                    <div class="col-7">
                                        <label class="font-weight-bold lable-main-section">Name Of entity:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-2 ">
                                        <label class="font-weight-bold lable-main-section">% of ownership:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "government_corporate_bonds") { ?>
                                    <div class="col-8 col-md-9">
                                        <label class="font-weight-bold lable-main-section">Issuer name:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-4 col-md-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "retirement_pension") { ?>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Type Of Account:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-6">
                                        <label class="font-weight-bold lable-main-section">Institution name:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "security_deposits") { ?>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Security Deposited For:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-6">
                                        <label class="font-weight-bold lable-main-section">Institution name or individual:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "annuities") { ?>
                                    <div class="col-8 col-md-9">
                                        <label class="font-weight-bold lable-main-section">Issuer name and description:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-4 col-md-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "education_ira") { ?>
                                    <div class="col-8 col-md-9">
                                        <label class="font-weight-bold lable-main-section">Institution name and description:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-4 col-md-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "trusts_life_estates" || $type == "patents_copyrights" || $type == "inheritances" || $type == "other_claims" || $type == "other_financial" || $type == "licenses_franchises") { ?>
                                    <div class="col-8 col-md-9">
                                        <label class="font-weight-bold lable-main-section">Description:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3 col-md-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "tax_refunds") { ?>
                                <div class="col-3">
                                    <label class="font-weight-bold lable-main-section">Type:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <div class="col-6">
                                    <label class="font-weight-bold lable-main-section">For what year or years:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <div class="col-3">
                                    <label class="font-weight-bold lable-main-section">Property Value:
                                        <span class="font-weight-normal"></span></label>
                                </div>
                                <?php } ?>

                                <?php if ($type == "alimony_child_support") { ?>
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">Type of Support:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">Belongs To:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Which State is the Court Order:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    
                                    <div class="col-2">
                                        <label class="font-weight-bold lable-main-section">Amount of Ordered Support:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3 ">
                                        <label class="font-weight-bold lable-main-section">Arrears/Past Due Amount of Support:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php if ($type == "injury_claims") { ?>
                                    <div class="col-8 col-md-9">
                                        <label class="font-weight-bold lable-main-section">Describe of claim:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-4 col-md-3 ">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                <?php } ?>
                                <?php
                        $printed_labels = [
                            'bank' => false,
                            'venmo_paypal_cash' => false,
                            'brokerage_account' => false,
                        ];
                                ?>
                                <?php for ($j = 0;$j < count($financial_data['description']);$j++) {
                                    $type_of_account = '';
                                    $class1 = "font-weight-normal lable-sub-section";
                                    $accountlabel = 'Type Of Account';
                                    $classId = '12';
                                    $classId2 = '12';
                                    $md1 = '3';
                                    $md2 = '3';
                                    $md3 = '3';
                                    $md4 = '3';
                                    switch ($type) {
                                        case 'bank': $md1 = '3';
                                            $md2 = '2';
                                            $md3 = '1';
                                            $md4 = '2';
                                            break;
                                        case 'mutual_funds': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'traded_stocks': $md2 = '7';
                                            $md4 = '3';
                                            break;
                                        case 'government_corporate_bonds': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'retirement_pension': $md1 = '3';
                                            $md2 = '6';
                                            $md4 = '3';
                                            break;
                                        case 'security_deposits': $md1 = '3';
                                            $md2 = '6';
                                            $md4 = '3';
                                            break;
                                        case 'annuities': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'education_ira': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'trusts_life_estates': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'patents_copyrights': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'licenses_franchises': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'tax_refunds': $md2 = '9 d-none';
                                            $md4 = '3';
                                            break;
                                        case 'alimony_child_support':$md1 = '2';
                                            $md2 = '2';
                                            $md3 = '3';
                                            $md4 = '3';
                                            break;
                                            // case 'unpaid_wages': $md2 = '9'; $md4 = '3'; break;
                                        case 'insurance_policies':$md1 = '0 d-none';
                                            $md2 = '6';
                                            $md4 = '3';
                                            break;
                                        case 'inheritances': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'injury_claims': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'other_claims': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                        case 'other_financial': $md2 = '8 col-md-9';
                                            $md4 = '4 col-md-3';
                                            break;
                                    }

                                    $last_4_digits = '';
                                    $business_name = '';
                                    $personal_business_account = '';
                                    $account_for = '';
                                    $documentTypeOfAcc = '';
                                    $showMd1Div = 'hide-data';
                                    /* Display Bank type if section type is bank */
                                    if ($type == "bank") {
                                        $class1 = "section-title";
                                        $type_of_account = Helper::validate_key_loop_value('account_type', $financial_data, $j);
                                        $type_of_account = ArrayHelper::getAccountKeyValue($type_of_account);
                                        $last_4_digits = Helper::validate_key_loop_value('last_4_digits', $financial_data, $j);
                                        $description = Helper::validate_key_loop_value('description', $financial_data, $j);
                                        $business_name = (Helper::validate_key_loop_value('personal_business_account', $financial_data, $j) == 1) ? '' : Helper::validate_key_loop_value('business_name', $financial_data, $j);
                                        $documentTypeOfAcc = Helper::validate_doc_type($description.'_ending_with_'.$last_4_digits, true);
                                        $personal_business_account = Helper::validate_key_loop_value('personal_business_account', $financial_data, $j);
                                        $account_for = Helper::validate_key_loop_value('account_for', $financial_data, $j);
                                        $transaction = Helper::validate_key_loop_value('transaction', $financial_data, $j);

                                    }

                                    if ($type == "retirement_pension") {
                                        $type_of_account = Helper::validate_key_loop_value('type_of_account', $financial_data, $j);
                                        $type_of_account = ArrayHelper::accountTypeArray($type_of_account);
                                    }

                                    if ($type == 'security_deposits') {
                                        $accountlabel = 'Security Deposited For';
                                        $type_of_account = Helper::validate_key_loop_value('type_of_account', $financial_data, $j);
                                        $type_of_account = ArrayHelper::securityDepositedArray($type_of_account);
                                    }

                                    if ($type == 'alimony_child_support') {
                                        $accountlabel = '';
                                        $class1 = "section-title";
                                        $type_of_account = Helper::validate_key_loop_value('account_type', $financial_data, $j);
                                        $type_of_account = is_array(ArrayHelper::getFinancialProp($type_of_account)) ? '' : ArrayHelper::getFinancialProp($type_of_account);
                                    }
                                    if ($type == "insurance_policies") {
                                        $showMd1Div = '';
                                        $accountlabel = 'Company name';
                                        $type_of_account = Helper::validate_key_loop_value('account_type', $financial_data, $j);
                                        $class1 = 'font-weight-normal lable-sub-section';
                                        $classId = 4;
                                        $classId2 = 8;
                                    }
                                    if ($type == "security_deposits") {
                                        $accountlabel = '';
                                    }
                                    ?>
                                            <?php

                                        $added = false;
                                    if (!empty($type_of_account) || $countindex == 17) {
                                        $added = true;
                                        ?>
                                            <?php

                                            if (isset($account_for) && !empty($account_for)) {
                                                if ($account_for == 'bank' && !$printed_labels['bank']) {
                                                    echo '<div class="col-12"><label class="text-u-blue text-bold mt-1">Bank Accounts:</label></div>';
                                                    $printed_labels['bank'] = true;
                                                }
                                                if ($account_for == 'venmo_paypal_cash' && !$printed_labels['venmo_paypal_cash']) {
                                                    echo '<div class="col-12"><label class="text-u-blue text-bold mt-1">PayPal, Cash App, Venmo Accounts:</label></div>';
                                                    $printed_labels['venmo_paypal_cash'] = true;

                                                }
                                                if ($account_for == 'venmo_paypal_cash') {
                                                    $documentTypeOfAcc = Helper::validate_key_loop_value('account_type', $financial_data, $j);
                                                }

                                                if ($account_for == 'brokerage_account' && !$printed_labels['brokerage_account']) {
                                                    echo '<div class="col-12"><label class="text-u-blue text-bold mt-1">Brokerage Accounts:</label></div>';
                                                    $printed_labels['brokerage_account'] = true;
                                                }
                                                if ($account_for == 'brokerage_account') {
                                                    $last_4_digits = Helper::validate_key_loop_value('last_4_digits', $financial_data, $j);
                                                    $description = Helper::validate_key_loop_value('description', $financial_data, $j);
                                                    $documentTypeOfAcc = Helper::validate_doc_type($description.'_ending_with_'.$last_4_digits, true);
                                                }
                                            }

                                        if ($type == 'retirement_pension') {
                                            $description = Helper::validate_key_loop_value('description', $financial_data, $j);
                                            $documentType = Helper::validate_key_loop_value('type_of_account', $financial_data, $j);

                                            //retirement_account_keog_44_retirement_pension
                                            $selectString = ClientHelper::accountTypeArrayForDoc($documentType);

                                            //$documentName = strtolower(Helper::validate_doc_type($selectString).'_'.$descriptionstring.'_'.$type_for);
                                            $documentNames = strtolower(Helper::validate_doc_type($selectString, true).'_'.$description.'_'.$type);

                                            $documentTypeOfAcc = Helper::validate_doc_type(str_replace(' ', '_', $documentNames), true);

                                        }
                                        ?>
                                            
                                            <div class="col-<?php echo $md1; ?>">
                                                <label class="font-weight-bold lable-main-section">
                                                    <?php if ($countindex == 17) { ?>   
                                                        Item
                                                        <span class="section-title"> #<?php echo $countindex.'.'.$p; ?>:</span>
                                                    <?php } ?>
                                                    <?php if (!empty($type_of_account)) {
                                                        $typeNotToShow = [  'bank',
                                                                            'retirement_pension',
                                                                            'security_deposits',
                                                                            'alimony_child_support',
                                                                            'insurance_policies',
                                                                        ] ?>
                                                        <?php if (!in_array($type, $typeNotToShow)) { ?>
                                                            <span class="font-weight-bold "><?php echo $accountlabel; ?>:</span>
                                                        <?php }?>
                                                        <span class="<?php echo $class1; ?>">
                                                            <?php echo !empty($type_of_account) ? $type_of_account : ""; ?>
                                                        </span>
                                                    <?php } ?>
                                                </label>
                                                <?php if ($transaction_pdf_enabled == 1 && $type == "bank" && $transaction == '1') { ?>
                                        </br>
                                        <a href="<?php echo route('download_transaction_pdf', ['client_id' => $client_id, 'attorney_id' => $attorney_id, 'index' => $j]); ?>" 
                                            target="_blank"
                                            class="font-weight-bold lable-main-section" 
                                            >
                                            <span class="text-decoration-underline">Download Transactions</span>  
                                            <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i>
                                        </a>
                                    <?php }?>
                                            </div>
                                            <?php } ?>
                                        <?php
                                        $desc = "Description:";
                                    $value = "Property Value:";
                                    $typeToEmptyLabel = ["mutual_funds",
                                                            "traded_stocks",
                                                            "bank",
                                                            "security_deposits",
                                                            "government_corporate_bonds",
                                                            "retirement_pension",
                                                            "annuities",
                                                            "education_ira",
                                                            "trusts_life_estates",
                                                            "patents_copyrights",
                                                            "alimony_child_support",
                                                        //  "unpaid_wages",
                                                        //  "life_insurance",
                                                            "insurance_policies",
                                                            "inheritances",
                                                            "injury_claims",
                                                            "other_claims",
                                                            "other_financial",
                                                            "licenses_franchises",
                                                        ];

                                    if (in_array($type, $typeToEmptyLabel)) {
                                        $desc = "";
                                        $value = "";
                                    }


                                    if ($type == "cash") {
                                        $desc = "";
                                    }
                                    $states = [];
                                    if ($type == "tax_refunds") {
                                        $value = "";
                                        $states = [0 => "Federal", 1 => "State", 2 => 'Local'];
                                    }
                                    ?>
                                        <?php if ($type == "tax_refunds") { ?>
                                            <div class="col-3">
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section ">
                                                    <?php echo Helper::validate_key_loop_value('description', $financial_data, $j); ?>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-6">
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section ">
                                                    <?php echo Helper::validate_key_loop_value('year', $financial_data, $j); ?>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php }?>
                                        <?php if ($type == "insurance_policies") { ?>
                                            <div class="col-md-3">
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section ">
                                                        <?php echo !empty(Helper::validate_key_loop_value('account_type', $financial_data, $j)) ? Helper::validate_key_loop_value('account_type', $financial_data, $j).' - ' : ''; ?>
                                                        <?php echo Helper::validate_key_loop_value('type_of_account', $financial_data, $j); ?>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php }?>
                                        <?php if ($type == "alimony_child_support") {	?>
                                        <div class="col-2">
                                            <label class="font-weight-bold lable-main-section">
                                                <span class="font-weight-normal">
                                                <?php
                                                $data_for = Helper::validate_key_loop_value('data_for', $financial_data, $j);
                                            if ($val['client_type'] == 1) {
                                                echo ($data_for == 'debtor') ? 'Debtor' : '';
                                            }
                                            if ($val['client_type'] == 2) {
                                                echo ($data_for == 'debtor') ? 'Debtor' : '';
                                                echo ($data_for == 'codebtor') ? 'Non-Filing Spouse' : '';
                                            }
                                            if ($val['client_type'] == 3) {
                                                echo ($data_for == 'debtor') ? 'Debtor' : '';
                                                echo ($data_for == 'codebtor') ? 'Co-Debtor' : '';
                                            }
                                            ?>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-<?php echo $md3; ?>">
                                            <label class="font-weight-bold lable-main-section">
                                                <span class="font-weight-normal"><?php echo Helper::validate_key_loop_value('state', $financial_data, $j); ?></span></label>
                                        </div>
                                        
                                        <div class="col-<?php echo $md2; ?>">
                                            <label class="font-weight-bold lable-main-section">
                                                <span class="font-weight-normal"><?php echo "$ ".number_format((float)Helper::validate_key_loop_value('description', $financial_data, $j), 2, '.', ','); ?></span></label>
                                        </div> 
                                        <?php } else { ?>

                                        
                                        <div class="col-<?php echo $md2; ?>">
                                            <?php if (isset($states[$j])) { ?>
                                            <label class="font-weight-bold lable-main-section">
                                                <span class="lable-main-section"><?php echo $states[$j]; ?>:</span>
                                                <span class="font-weight-normal"><?php echo Helper::validate_key_loop_value('description', $financial_data, $j); ?></span></label>
                                            <?php } else { ?>
                                                <?php if (!empty($desc)) { ?>
                                                <label class="font-weight-bold lable-main-section"><?php echo $desc; ?>
                                                <?php } ?>
                                                <span class="font-weight-normal lable-sub-section <?php echo ($countindex == 17) ? 'text-lightblue' : ''; ?>"><?php echo Helper::validate_key_loop_value('description', $financial_data, $j); ?></span></label>
                                            <?php } ?>
                                        </div> 
                                        <?php } ?>
                                        

                                        <?php if ($type == "traded_stocks") {	 ?>
                                            <div class="col-md-2">
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section ">
                                                    <?php echo Helper::validate_key_loop_value('type_of_account', $financial_data, $j); ?>
                                                    </span>
                                                </label>
                                        </div>
                                        <?php }?>


                                        <?php if ($type == "bank") {	 ?>
                                            <div class="col-2 ">
                                            <?php if (isset($business_name) && !empty($business_name)) { ?>
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section"><?php echo $business_name;  ?></span>
                                                </label>
                                            <?php } ?>
                                            </div>
                                            
                                            <div class="col-<?php echo $md3; ?> ">
                                            <?php if (isset($last_4_digits) && !empty($last_4_digits)) { ?>
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section"><?php echo $last_4_digits; ?></span>
                                                </label>
                                            <?php } ?>
                                            </div>
                                            
                                            <div class="col-2 ">
                                            <?php if (isset($personal_business_account) && !empty($personal_business_account)) { ?>
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section"><?php echo ($personal_business_account == 1) ? 'Personal Account' : '';
                                                echo ($personal_business_account == 2) ? 'Business Account' : ''; ?></span>
                                                </label>
                                            <?php } ?>
                                            </div>
                                        <?php } else {?>
                                            <?php if (isset($last_4_digits) && !empty($last_4_digits)) { ?>
                                            <div class="col-md-<?php echo $md3; ?> ">
                                                <label class="font-weight-bold lable-main-section">
                                                    <span class="font-weight-normal lable-sub-section"><?php echo $last_4_digits; ?></span>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        <?php }?>
                                        <?php $l1 = [];
                                    if (@$hide_docs == false && isset($client_uoloaded_documents[$documentTypeOfAcc])) {
                                        $l1 = $client_uoloaded_documents[$documentTypeOfAcc];
                                    } ?>
                                        <?php //$documentTypeOfAcc?>
                                        <div class="col-<?php echo $md4; ?> ">
                                            <label class="font-weight-bold lable-main-section"><?php echo $value; ?>  
                                            
                                                <span class="font-weight-normal lable-sub-section text-success"><?php echo (Helper::validate_key_loop_value('property_value_unknown', $financial_data, $j) == 1 || Helper::validate_key_loop_value('unknown', $financial_data, $j) == 1) ? "Unknown" : "$".number_format((float)Helper::validate_key_loop_value('property_value', $financial_data, $j), 2, '.', ','); ?></span></label>
                                            </div>
                                                <?php if (!$hide_docs && isset($l1) && !empty($l1)) {  ?>
                                            <div class="col-12">
                                                <span class="font-weight-normal bradly-heading fs-18px float-right"><span class="bb-1px-black ml-1">Download Stmt:</span> <a href="<?php echo route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $l1['document_type']]);?>" class="ml-1 text-c-blue" title="<?php echo "Download ".$l1['title'];?>"> <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i></a></span>
                                            </div>
                                        
                                        <?php } ?>

                                        
                                        
                                        <?php
                                    $p++;
                                }
                            }?>
                            <?php if (!empty($financial_data['owed_type']) && is_array($financial_data['owed_type'])) { ?>
                                <?php if ($type == "unpaid_wages") {  ?>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Owed Type:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Belongs to:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Amount you are paid monthly:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    
                                    <div class="col-3">
                                        <label class="font-weight-bold lable-main-section">Total Amount owed/value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <!-- <div class="col-md-3"></div> -->
                                <?php } ?>
                                <?php for ($j = 0;$j < count($financial_data['owed_type']);$j++) { ?>
                                    <div class="col-3">
                                        <label class="lable-main-section">
                                            <span class="font-weight-normal lable-sub-section"><?php echo ArrayHelper::getPropertyFinancialOwedTypeArray(Helper::validate_key_loop_value('owed_type', $financial_data, $j));?></span></label>
                                    </div>
                                    <div class="col-3">
                                        <label class="lable-main-section">
                                            <span class="font-weight-normal lable-sub-section">
                                                <?php
                                                $documentTypeOfAcc = '';
                                    $data_for = Helper::validate_key_loop_value('data_for', $financial_data, $j);
                                    if ($val['client_type'] == 1) {
                                        echo ($data_for == 'debtor') ? 'Debtor' : '';
                                    }
                                    if ($val['client_type'] == 2) {
                                        echo ($data_for == 'debtor') ? 'Debtor' : '';
                                        echo ($data_for == 'codebtor') ? 'Non-Filing Spouse' : '';
                                    }
                                    if ($val['client_type'] == 3) {
                                        echo ($data_for == 'debtor') ? 'Debtor' : '';
                                        echo ($data_for == 'codebtor') ? 'Co-Debtor' : '';
                                    }
                                    $owed_type = Helper::validate_key_loop_value('owed_type', $financial_data, $j);
                                    if (in_array($owed_type, [7, 8, 10])) {
                                        $name = "";
                                        switch ($owed_type) {
                                            case 7:    $name = "Social Security Annual Award Letter";
                                                break;
                                            case 8:    $name = "VA Benefit Award Letter";
                                                break;
                                            case 10:   $name = "Unemployment Payment History (Last 7 Months)";
                                                break;
                                        }

                                        $document_type = $data_for."_".$name;
                                        $document_name = str_replace(" ", "_", $document_type);
                                        $documentTypeOfAcc = Helper::validate_doc_type($document_name, true);
                                    }
                                    ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-3 ">
                                        <label class="lable-main-section">
                                            <span class="font-weight-normal lable-sub-section "><?php echo "$ ".number_format((float)Helper::validate_key_loop_value('monthly_amount', $financial_data, $j), 2, '.', ','); ?></span></label>
                                    </div>
                                    
                                    <div class="col-3 ">
                                        <label class="lable-main-section">
                                            <span class="font-weight-normal lable-sub-section text-success"><?php echo (Helper::validate_key_loop_value('property_value_unknown', $financial_data, $j) == 1 || Helper::validate_key_loop_value('unknown', $financial_data, $j) == 1) ? "Unknown" : "$".number_format((float)Helper::validate_key_loop_value('property_value', $financial_data, $j), 2, '.', ','); ?></span>
                                        </label>
                                    </div>
                                            <?php $l1 = [];
                                    if (@$hide_docs == false && isset($client_uoloaded_documents[$documentTypeOfAcc])) {
                                        $l1 = $client_uoloaded_documents[$documentTypeOfAcc];
                                    } ?>
                                                <?php if (!$hide_docs && isset($l1) && !empty($l1)) {  ?>
                                                    <div class="col-12">
                                                        <span class="font-weight-normal bradly-heading fs-18px float-right"><span class="bb-1px-black ml-2">Download Stmt:</span> <a href="<?php echo route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $l1['document_type']]);?>" class="ml-1 text-c-blue" title="<?php echo "Download ".$l1['title'];?>"> <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i></a></span>
                                                    </div>
                                        
                                                <?php } ?>
                                    <!-- <div class="col-md-3"></div> -->
                                <?php } ?>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php $i++;
            $countindex++;
        }
    }?>
</div>

<?php
    $business_assets = [
    "Accounts receivable or commissions earned",
    "Office equipment, furnishings, and supplies",
    "Machinery, fixtures, equipment, business supplies, and tools of your trade",
    "Business inventory",
    "Interests in partnerships or joint ventures (name and type of business, % interest)",
    "Customer and mailing lists",
    "Other business-related property not already listed",
    ];
    $order = ['commissions', 'office_equipment','machinery_fixtures','business_inventory','interests','customer_mailing','other_business'];
    $countindex = 38;
    usort($businessassets, function ($a, $b) use ($order) {
        $pos_a = array_search($a['type'], $order);
        $pos_b = array_search($b['type'], $order);

        return $pos_a - $pos_b;
    });
    ?>

<div class="outline-gray-border-area px-0">
    <div class="section-title-div  mb-4">
        <h3 class="">
            Business Related Property
            <?php if (empty($businessassets)) { ?>
                <span class="text-danger text-bold item-label"> :None</span>
            <?php } ?>
        </h3>
        <div class="section-edit-div">
            <x-attorney.attorneyEditButton 
                :route="route('property_step6_modal')" 
                :isEdited="$isPropertyBusinessAssetEdited"
                extraClass="ml-3 text-bold"
            />
            <x-attorney.attorneyEditReviewed 	
                :reviewedData="$isPropertyBusinessAssetEdited"
                extraClass="ml-3"
            />
        </div>
    </div>
</div>

<div class="part-a outline-gray-border-area">
	
	<?php
        if (!empty($businessassets)) {
            $i = 0;
            foreach ($businessassets as $key => $business) {
                ?>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <span class="item-label">Item </span>
                <div class="ml-2 circle-number-div"><?php echo $countindex; ?></div>
                <span class="item-label questionaire-label">{{@$business_assets[$i]}} </span>                    
                <span class="lable-sub-section text-danger item-label"><?php echo Helper::keyDisplayRemoveYes('type_value', $business)?></span> 
            </h2>
            <div class="row gx-3 set-mobile-col">
                <div class="row col-md-12 <?php echo Helper::key_hide_show_v('type_value', $business)?>">
                    <?php if ($countindex == 42) { ?>
                        <div class="col-6">
                            <label class="font-weight-bold lable-main-section">Name Of entity:
                                <span class="font-weight-normal"></span></label>
                        </div>
                        <div class="col-3">
                            <label class="font-weight-bold lable-main-section">% of ownership:
                                <span class="font-weight-normal"></span></label>
                        </div>
                        <div class="col-3">
                            <label class="font-weight-bold lable-main-section">Property Value:
                                <span class="font-weight-normal"></span></label>
                        </div>
                    <?php } else { ?>
                        <div class="col-8 col-md-9">
                            <label class="font-weight-bold lable-main-section">Description:
                                <span class="font-weight-normal"></span></label>
                        </div>
                        <div class="col-4 col-md-3">
                            <label class="font-weight-bold lable-main-section">Property Value:
                                <span class="font-weight-normal"></span></label>
                        </div>
                    <?php } ?>
                    <?php if (is_array(json_decode($business['type_data'], 1))) {
                        $business_data = json_decode($business['type_data'], 1);
                        $p = 1;
                        if (!empty($business_data['description']) && is_array($business_data['description'])) {
                            for ($j = 0;$j < count($business_data['description']);$j++) {
                                $type_of_account = '';
                                $accountlabel = 'Type Of Account';
                                ?>



                            <?php if ($countindex == 42) { ?>
                            <div class="col-6">
                                <label class="font-weight-bold lable-main-section">
                                    <span class="font-weight-normal lable-sub-section"><?php echo Helper::validate_key_loop_value('description', $business_data, $j); ?></span></label>
                            </div>
                            <div class="col-3 ">
                                <label class="font-weight-bold lable-main-section">
                                    <span class="font-weight-normal lable-sub-section"><?php echo Helper::validate_key_loop_value('type_of_account', $business_data, $j); ?>%</span></label>
                            </div>
                            <div class="col-3 ">
                                <label class="font-weight-bold lable-main-section">
                                    <span class="font-weight-normal lable-sub-section text-success">$<?php echo number_format((float)Helper::validate_key_loop_value('property_value', $business_data, $j), 2, '.', ','); ?></span></label>
                            </div>
                                    <?php } else { ?>

                            <div class="col-9">
                                <label class="font-weight-bold lable-main-section">
                                    <span class="font-weight-normal lable-sub-section"><?php echo Helper::validate_key_loop_value('description', $business_data, $j); ?></span></label>
                            </div>
                            <div class="col-2">
                                <label class="font-weight-bold lable-main-section">
                                    <span class="font-weight-normal lable-sub-section text-success">$<?php echo number_format((float)Helper::validate_key_loop_value('property_value', $business_data, $j), 2, '.', ','); ?></span></label>
                            </div>
                            <?php } ?>
                            <?php
                                $p++;
                            }
                        } else {
                            $type_of_account = '';
                            $accountlabel = 'Type Of Account';
                            if ($countindex == 42) { ?>
                                    <div class="col-12">
                                        <label class="font-weight-bold lable-main-section">
                                        <span class=""><?php echo $countindex; ?>: </span>
                                        </label>
                                    </div>
                                <?php
                            }  if (!empty($type_of_account)) {?>
                                <div class="col-12">
                                    <label class="font-weight-bold lable-main-section">
                                        <span class="section-title"><?php echo $accountlabel; ?>:</span>
                                    <span class="font-weight-normal lable-sub-section">
                                    <?php echo !empty($type_of_account) ? $type_of_account : ""; ?>
                                    </span>
                                    </label>
                                </div>
                                <?php } ?>

                                <div class="col-9">
                                    <label class="font-weight-bold lable-main-section">
                                        <span class="font-weight-normal lable-sub-section"><?php echo Helper::validate_key_value('description', $business_data); ?></span></label>
                                </div>
                                <div class="col-3">
                                    <label class="font-weight-bold lable-main-section" >
                                        <span class="font-weight-normal lable-sub-section text-success">$<?php echo number_format((float)Helper::validate_key_value('property_value', $business_data), 2, '.', ','); ?></span></label>
                                </div>

                    <?php }?>


                    <?php }?>
                </div>
            </div>
        </div>
    </div>
	<?php
    $countindex++;
                $i++;
            }
        }?>
</div>

<?php
$farm_assets = [
"Farm animals (livestock, poultry, farm- raised fish, etc.)",
"Crops (growing or harvested)",
"Farm and commercial fishing equipment, implements, machinery, fixtures, and tools of trade",
"Farm and commercial fishing supplies, chemicals, and feed",
"Any farm and commercial fishing-related property not already listed"
];
    ?>

<div class="outline-gray-border-area px-0">
    <div class="section-title-div  mb-4">
        <h3 class="">
            Farm and Commercial Fishing-Related Property
            <?php if (empty($farmcommercial)) { ?>
                <span class="text-danger text-bold item-label"> :None</span>
            <?php } ?>
        </h3>
        <div class="section-edit-div">
            <x-attorney.attorneyEditButton 
                :route="route('property_step7_modal')" 
                :isEdited="$isPropertyFarmCommercialEdited"
                extraClass="ml-3 text-bold"
            />
            <x-attorney.attorneyEditReviewed 	
                :reviewedData="$isPropertyFarmCommercialEdited"
                extraClass="ml-3"
            />
        </div>
    </div>
</div>

<div class="part-a outline-gray-border-area">  
	<?php
        $countindex = 47;
    if (!empty($farmcommercial)) {
        $i = 0;
        foreach ($farmcommercial as $key => $farm) {?>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <span class="item-label">Item </span>
                <div class="ml-2 circle-number-div"><?php echo $countindex; ?></div>
                <span class="item-label questionaire-label">{{@$farm_assets[$i]}} </span>
                <span class="lable-sub-section text-danger item-label"><?php echo Helper::keyDisplayRemoveYes('type_value', $farm)?></span> 
            </h2>
            <div class="row gx-3 set-mobile-col">
                <div class="row col-md-12 <?php echo Helper::key_hide_show_v('type_value', $farm)?>">
                    <?php if (is_array(json_decode($farm['type_data'], 1))) {
                        $farm_data = json_decode($farm['type_data'], 1);
                        ?>
                    <?php
                            $type_of_account = '';
                        $accountlabel = 'Type Of Account';
                        ?>
                        <div class="col-md-12">
                            <?php if (!empty($type_of_account)) {?>
                                <label class="font-weight-bold lable-main-section">
                                <span class="section-title"><?php echo $accountlabel; ?>:</span>
                                <span class="font-weight-normal lable-sub-section">
                                <?php echo !empty($type_of_account) ? $type_of_account : ""; ?>
                                </span>
                                </label>
                            <?php } ?>
                        </div>
                        <div class="col-8 col-md-9">
                            <label class="font-weight-bold lable-main-section">Description:</label>
                        </div>
                        <div class="col-4 col-md-3">
                            <label class="font-weight-bold lable-main-section">Property Value:</label>
                        </div>
                        <div class="col-8 col-md-9">
                            <label class="font-weight-bold lable-main-section">
                                <span class="font-weight-normal lable-sub-section"><?php echo Helper::validate_key_value('description', $farm_data); ?></span></label>
                        </div>
                        <div class="col-4 col-md-3">
                            <label class="font-weight-bold lable-main-section">
                                <span class="font-weight-normal lable-sub-section text-success">$<?php echo number_format((float)Helper::validate_key_value('property_value', $farm_data), 2, '.', ','); ?></span></label>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
	<?php $countindex++;
            $i++;
        }
    }?>
</div>

<?php
    $miscellaneous_assets = [
    "All other property of any kind not previously listed",
    ];
    $emptyMisc = true;
    foreach ($miscellaneous as $key => $value) {
        if ($value['type_value'] == 1) {
            $emptyMisc = false;
        }
    }
    ?>

<div class="outline-gray-border-area px-0">
    <div class="section-title-div  mb-4">
        <h3 class="">
            Miscellaneous
            <?php if (empty($emptyMisc)) { ?>
                <span class="text-danger text-bold item-label"> :None</span>
            <?php } ?>
        </h3>
        <div class="section-edit-div">
            <x-attorney.attorneyEditButton 
                :route="route('property_step7_modal')" 
                :isEdited="$isPropertyFarmCommercialEdited"
                extraClass="ml-3 text-bold"
            />
            <x-attorney.attorneyEditReviewed 	
                :reviewedData="$isPropertyFarmCommercialEdited"
                extraClass="ml-3"
            />
        </div>
    </div>
</div>


<div class="part-a outline-gray-border-area">
	<?php
        $countindex = 53;
    if (!empty($miscellaneous) && !$emptyMisc) {
        $i = 0;
        foreach ($miscellaneous as $key => $miscellaneous) {?>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <span class="item-label">Item </span>
                <div class="ml-2 circle-number-div"><?php echo $countindex; ?></div>
                <span class="item-label questionaire-label">{{@$miscellaneous_assets[$i]}} </span>
                <span class="lable-sub-section text-danger item-label"><?php echo Helper::keyDisplayRemoveYes('type_value', $miscellaneous)?></span> 
            </h2>
            <div class="row gx-3 set-mobile-col">
                <div class="row col-md-12 <?php echo Helper::key_hide_show_v('type_value', $miscellaneous)?>">
                    <?php if (is_array(json_decode($miscellaneous['type_data'], 1))) {
                        $miscellaneous_data = json_decode($miscellaneous['type_data'], 1);
                        $i = 0;
                        if (!empty($miscellaneous_data['description']) && is_array($miscellaneous_data['description'])) {


                            if ($countindex == 53) { ?>
                                    <div class="col-8 col-md-9">
                                        <label class="font-weight-bold lable-main-section">Description:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <label class="font-weight-bold lable-main-section">Property Value:
                                            <span class="font-weight-normal"></span></label>
                                    </div>
                    <?php       }
                            for ($i = 0;$i < count($miscellaneous_data['description']);$i++) {
                                ?>

                    <div class="col-8 col-md-9">
                        <label class="font-weight-bold lable-main-section">
                            <span class="font-weight-normal lable-sub-section"><?php echo Helper::validate_key_loop_value('description', $miscellaneous_data, $i); ?></span>
                        </label>
                    </div>
                    <div class="col-4 col-md-3">
                        <label class="font-weight-bold lable-main-section">
                            <span class="font-weight-normal lable-sub-section text-success">$<?php echo number_format((float)Helper::validate_key_loop_value('property_value', $miscellaneous_data, $i), 2, '.', ','); ?></span>
                        </label>
                    </div>

                    <?php }
                            }
                    }?>
                </div>
            </div>
        </div>
    </div>
	<?php $i++;
        }
    }?>
</div>