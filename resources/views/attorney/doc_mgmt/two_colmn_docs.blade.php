
                    <tr id="{{$taxind}}" style="background-color:<?php echo $background; ?>; color:<?php echo $color; ?>">
                    

                    <?php
                    $notOwnedproperty = '';
                    if (in_array($data['document_type'], $notOwned)) {
                        $notOwnedproperty = "Client selected no document available";
                        if (in_array($data['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                            $notOwnedproperty = "Client selected not employed over the last 7 months";
                        }
                    }
                    ?>
                    <td class="no_border">
                        <table>
                            <tr class="<?php if ($doc_page_open) {
                                echo "active";
                            } ?>">
                                <?php if (!in_array($data['document_type'], $autoloankeys) && !in_array($data['document_type'], $mortloankeys)) { ?>

                                    <td style="width:4%">
                                        <?php if ((!in_array($data['document_type'], $valid_document_types) && $displayMainName) || $singleDocs) {
                                            $isW2 = 0;
                                            if (in_array($data['document_type'], ['W2_Last_Year', 'W2_Year_Before'])) {
                                                $isW2 = 1;
                                            }
                                            ?>
                                            <a href="javascript:void(0)" class="upload_doc_line view_client_btn"
                                                onclick="<?php if (in_array($data['document_type'], [\App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB, \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB])) { ?>setDataType('<?php echo $data['document_type']; ?>');<?php } ?>both_upload_modal('<?php echo $data['document_type']; ?>',$(this).data('text'), '', 0 , <?php echo $isStatements; ?> , <?php echo $isPaystub; ?>, <?php echo isset($isW2) && !empty($isW2) ? $isW2 : 0; ?> );"
                                                data-type="<?php echo $data['document_type']; ?>" data-text="<?php echo Helper::removeUnderscores($data['document_name'], false); ?>"> <i class="fa fa-upload" aria-hidden="true"></i></a>
                                        <?php } ?>
                                        <?php
                                                $d_none = 'd-none';
                                    if (($doc_page_open == true && $multiplecount > 0)) {
                                        $d_none = '';
                                    } ?>
                                            <label class="click_all_docs select_all_docs_checkbox {{$d_none}}" data-select-id="{{$data['document_type']}}">
                                                
                                                <input class="ml-2 parent_<?php echo $data['document_type']; ?>" type="checkbox" onclick="checkChildCheckboxes(this,'<?php echo $data['document_type']; ?>')" value="1"> Click to Select All Doc(s) </label></br>
                                                <a href="javascript:void(0)" class="ml-5 view_client_btn p4px accept_all dnpv hide-data" data-item="{{$data['document_type']}}" data-url="<?php echo route('accept_bulk_documents', ['id' => $val['id'], 'type' => $data['document_type']]); ?>" id="bulkaccept_{{$data['document_type']}}" href="javascript:void(0)"> Accept All</a> <a class="ml-1 view_client_btn btn-danger p4px decline_all hide-data" data-item="{{$data['document_type']}}" data-url="<?php echo route('decline_bulk_documents', ['id' => $val['id'], 'type' => $data['document_type']]); ?>" id="bulkdecline_{{$data['document_type']}}" href="javascript:void(0)">Decline All</a>
                                            </label>

                                    </td>
                                <?php } ?>
                                <?php
                                $acceptedCount = 0;
                    $declinedCount = 0;
                    if (isset($data['multiple']) && is_array($data['multiple'])) {

                        foreach ($data['multiple'] as $dic) {
                            if ((isset($dic['document_status']) && $dic['document_status'] == 1) || (isset($dic['added_by_attorney']) && ($dic['added_by_attorney'] == 1))) {
                                $acceptedCount++;
                            }
                            if (isset($dic['document_status']) && $dic['document_status'] == 2) {
                                $declinedCount++;
                            }
                        }
                    } ?>


                                <td style="width:3%;position:relative;padding:4px;">
                                    <?php if ($displayMainName && $multiplecount > 0) { ?>
                                        <a title="Select to view all documents" href="<?php echo route('attorney_client_uploaded_documents', ['id' => $val['id']]) . '?type=' . $data['document_type'] ?>">
                                            <img src="<?php echo @$svgUrl; ?>" class="licence-img " style="height:40px" alt="icon">
                                            <span class="unread-indicator {{$indicator}} ki">New Doc(s) Uploaded</span>
                                        </a>


                                    <?php } else { ?>
                                        <?php if (in_array($data['document_type'], $autoloankeys) || in_array($data['document_type'], $mortloankeys)) { ?>
                                            <a href="javascript:void(0)" class="upload_doc_line view_client_btn"
                                                onclick="both_upload_modal('<?php echo $data['document_type']; ?>',$(this).data('text'), '', 0 , false , false )"
                                                data-type="<?php echo $data['document_type']; ?>" data-text="<?php echo $data['document_name']; ?>"> <i class="fa fa-upload" aria-hidden="true"></i></a>
                                        <?php } ?>
                                        <img src="<?php echo @$svgUrl; ?>" class="licence-img " style="height:40px" alt="icon">
                                        <span class="unread-indicator {{$indicator}} ki">New Doc(s) Uploaded</span>
                                    <?php } ?>

                                </td>
                                <?php $bank_statement_month_nos = $bank_statement_months;
                    $banktypeString = '';
                    if (in_array($data['document_type'], array_keys($clientDocs))) {
                        $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
                        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
                        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
                        $attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

                        foreach ($bank_account_documents as $bnksacc) {
                            if ($bnksacc['document_name'] == $data['document_type'] && $bnksacc['bank_account_type'] == 1) {
                                $banktypeString = "<br/><small class='absolute-tick font-weight-bold text-c-light-blue'>(Personal)&nbsp;</small>";
                            }
                            if ($bnksacc['document_name'] == $data['document_type'] && $bnksacc['bank_account_type'] == 2) {
                                $bank_statement_month_nos = ($bnksacc['bank_account_type'] == 2) ? $attProfitLossMonths : $bank_statement_months;
                                $banktypeString = "</br><small class='absolute-tick font-weight-bold text-c-blue'>(Business)&nbsp;</small>";
                            }
                        }
                    } ?>


                                <?php

                    if (in_array($data['document_type'], $listTaxes) || in_array($data['document_type'], ['W2_Last_Year', 'W2_Year_Before'])) {
                        $data['multiple'] = $data['multiple'] ?? [];
                        if (count($data['multiple']) != 0 && $acceptedCount == count($data['multiple'])) {
                            $color = "green !important";
                        }
                        if (count($data['multiple']) == 0 || $acceptedCount != count($data['multiple'])) {
                            $color = "red !important";
                        }
                    }


                    $documentAndMissingText = '';
                    $missing_months = '';
                    $allbankUploaded = true;
                    $statement_month_array = DateTimeHelper::getBankStatementShortMonthArray($bank_statement_month_nos);

                    $key = $data['document_type'];
                    if (in_array($data['document_type'], array_keys($clientDocs)) || in_array($data['document_type'], array_keys($venmoPaypalCash))) {
                        $data['multiple'] = $data['multiple'] ?? [];
                        $matchingObjects = array_filter($data['multiple'], function ($item) use ($key) {
                            return $item['document_type'] === $key;
                        });


                        foreach ($statement_month_array as $month_key => $month_value) {
                            $found = false;
                            foreach ($matchingObjects as $object) {
                                if ($object['document_month'] === $month_key) {
                                    $found = true;
                                    $missing_months .= '<small class="text-c-green">' . $month_value . '</small>, ';
                                    ;
                                    break;
                                }
                            }
                            if (!$found) {
                                $allbankUploaded = false;
                                $missing_months .= '<small class="text-c-red">' . $month_value . '</small>, ';
                            }
                        }
                        $missing_months = rtrim($missing_months, ', ');
                        if (!empty($missing_months)) {
                            $documentAndMissingText = !empty($banktypeString) ? $banktypeString . $missing_months : '<br/>' . $missing_months;
                        } else {
                            $successString = "<small class='text-c-green font-weight-bold ml-2'>All Uploaded</small>";
                            $documentAndMissingText = !empty($banktypeString) ? $banktypeString . $successString : '<br/>' . $successString;
                        }
                        if (!$allbankUploaded) {
                            $color = "#f00 !important";
                        } else {
                            $color = "green !important";
                        }
                    }  ?>
                                <td style="width:40%;position:relative;">
                                    <?php if ($displayMainName && $multiplecount > 0) { ?>
                                        <a title="Select to view all documents" href="<?php echo route('attorney_client_uploaded_documents', ['id' => $val['id']]) . '?type=' . $data['document_type'] ?>">
                                            <span style="color:{{@$color}}" class="<?php if (in_array($data['document_type'], ['Debtor_Creditor_Report','Co_Debtor_Creditor_Report']) && $data['id'] == 0) {
                                                echo 'red_credit';
                                            } ?>  titleh  <?php if ($displayMainName) { ?> bold-wide<?php } else {
                                                echo "small_font";
                                            } ?>">
                                                <?php echo Helper::removeUnderscores($data['document_name']); ?></span>


                                        </a>

                                        <?php echo !empty($acceptedCount) ? " <small class='ml-1 font-weight-bold text-c-green'>(Accepted:" . $acceptedCount . ")</small>" : ''; ?>
                                        <?php echo !empty($declinedCount) ? " <small class='font-weight-bold text-c-red'>(Declined:" . $declinedCount . ")</small>" : ''; ?>
                                        <?php if (in_array($data['document_type'], array_keys($clientDocs)) || in_array($data['document_type'], array_keys($venmoPaypalCash)) || in_array($data['document_type'], array_keys($brokerageAccount))) { ?>

                                            <button onclick="deleteBankType('<?php echo $data['document_type']; ?>','<?php echo $client_id; ?>', '<?php echo route('delete_bank_type'); ?>')" type="button" class="delete-div" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
                                                    </path>
                                                </svg>
                                                Delete Account
                                            </button>

                                        <?php } ?>
                                        @include("attorney.doc_mgmt.doc_request_flag", ['colored' => 'green'])

                                        <?php if ($data['document_type'] == "Debtor_Pay_Stubs") {  ?>

                                            @include("attorney.doc_mgmt.missing_paystub", ['paystubsarray' => $debtorPaystubStatus, 'type' => 1])
                                        <?php  } ?>
                                        <?php if ($data['document_type'] == "Co_Debtor_Pay_Stubs") {  ?>
                                            @include("attorney.doc_mgmt.missing_paystub", ['paystubsarray' => $coDebtorPaystubStatus, 'type' => 2])
                                        <?php  } ?>
                                        <?php if (!empty($notOwnedproperty)) { ?>
                                            <br /> <span class="small-text-font text-c-red">({{$notOwnedproperty}})</span>
                                        <?php } ?>

                                    <?php } else { ?>
                                        <span style="color:{{@$color}}" class="<?php if (in_array($data['document_type'], ['Debtor_Creditor_Report','Co_Debtor_Creditor_Report']) && $data['id'] == 0) {
                                            echo 'red_credit';
                                        } ?>  titleh long-attorney-text <?php if ($displayMainName) { ?> bold-wide<?php } else {
                                            echo "small_font";
                                        } ?>">
                                            <?php
                                            $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty);
                                        $mortagesData = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
                                        echo isset($mortagesData[$data['document_type']]) ? Helper::removeUnderscores($mortagesData[$data['document_type']]) : Helper::removeUnderscores($data['document_name']);
                                        if ((in_array($data['document_type'], $autoloankeys) || in_array($data['document_type'], $mortloankeys)) && empty($data['id'])) {
                                            echo '<span class="ml-2 text-c-red">Missing</span>';
                                        }
                                        ?>
                                            <?php if (in_array($data['document_type'], $autoloankeys) || in_array($data['document_type'], $mortloankeys)) {
                                                if ((isset($data['document_status']) && $data['document_status'] == 1) || (isset($data['added_by_attorney']) && ($data['added_by_attorney'] == 1))) {
                                                    $colored = 'green';
                                                    ;
                                                }
                                            }  ?>
                                        </span>
                                        @include("attorney.doc_mgmt.doc_request_flag")

                                        <?php echo !empty($acceptedCount) ? " <small class='ml-1 font-weight-bold text-c-green'>(Accepted:" . $acceptedCount . ")</small>" : ''; ?>
                                        <?php echo !empty($declinedCount) ? " <small class='font-weight-bold text-c-red'>(Declined:" . $declinedCount . ")</small>" : ''; ?>
                                        <?php if (!empty($notOwnedproperty)) { ?>
                                            <br><span class="small-text-font text-c-red">({{$notOwnedproperty}})</span>
                                        <?php } ?>

                                    <?php } ?>

                                    <?php echo $documentAndMissingText; ?>

                                    @include("attorney.doc_mgmt.accept_decline_btns")
                                </td>


                                <td style="text-align:left;width:45%;padding:0px;">

                                    @include("attorney.doc_mgmt.document_actions")
                                    <?php if (empty($doclasscs)) { ?>
                                        @include("attorney.doc_mgmt.vehile_reg")
                                    <?php } ?>

                                </td>
                                <td style="text-align:right;width:8%">
                                    <?php if ($displayMainName) {
                                        if ($multiplecount > 0) {
                                            ?>
                                            <a class="text-underline text-underline-hover-black text-c-black toggle-docs" href="javascript:void(0)" onclick="toggleDocPage(this)" data-select-id="{{$data['document_type']}}" data-document-type="<?php echo $data['document_type']; ?>" data-client-id="{{$val['id']}}"> <span class="read-more-less" style="font-size:10px;"> <?php echo $doc_page_open == true ? 'Hide ' : 'Click to Show'; ?> <?php if (in_array($data['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                                                echo "ALL pay stubs";
                                            } else {
                                                echo $multiplecount . 'doc(s)';
                                            } ?> <i class="fa fa-angle-<?php echo $doc_page_open == true ? 'up' : 'down'; ?>" aria-hidden="true"></i></span></a>
                                    <?php }
                                        } ?>
                                </td>

                            </tr>
                            <?php if (in_array($data['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']) || (!in_array($data['document_type'], ["Miscellaneous_Documents", "Other_Misc_Documents"]) && isset($data['multiple']) && is_array($data['multiple']) && !empty($data['multiple']))) { ?>
                                <?php ?>
                                <tr class="sub_docs {{$doc_page_open?"":"d-none"}} document_select" id="select_{{$data['document_type']}}" data-document-type="{{$data['document_type']}}" data-select-id="{{$data['document_type']}}">
                                    <td colspan="5" class="m-0 p-0 pl-1" id="Content_{{$data['document_type']}}">
                                        @if($doc_page_open)
                                            @include("attorney.doc_mgmt.sub_docs")
                                        @endif
                                    </td>
                                </tr>
                            <?php } ?>

                        </table>

                    </td>
                 
                    </tr>