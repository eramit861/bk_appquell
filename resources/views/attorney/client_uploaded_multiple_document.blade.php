
            <?php

               $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
            $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
            $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
            $attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

            foreach ($documentuploaded as $key => $data) {
                if (isset($documentsAddedForThisEmployer) && !in_array($data['id'], $documentsAddedForThisEmployer)) {
                    continue;
                }
                $docData = Helper::getDocumentImage($data['document_type']);
                if (empty($docData)) {
                    $ottype = \App\Models\ClientDocumentUploaded::OTHER_MISC_DOCUMENTS;
                    $docData = Helper::getDocumentImage($ottype);
                }
                $checkbox = false;
                if ($data['mime_type'] == 'application/pdf') {
                    $checkbox = true;
                }
                $doclasscs = 'not-uploaded';
                if ($data['id'] > 0) {
                    $doclasscs = '';
                }
                $declineText = '';
                $showResubmitDoc = false;
                $docActiveChildClass = "";

                if (!empty($data['id'])) {
                    if ($data['document_status'] == 2) {
                        $declineText = $data['document_decline_reason'];
                    }
                    if ($data['document_status'] == 1) {
                        $showResubmitDoc = true;
                        $docActiveChildClass = '';
                    }

                    $enableAction = 0;
                    if (in_array($data['document_status'], [0,1,2])) {
                        $enableAction = 1;
                    }
                }
                $indicator = "d-none";
                if ($data['is_viewed_by_attorney'] == 0 && in_array($data['document_type'], $unreadDocuments)) {
                    $indicator = "";
                }
                $formultiples = false;

                if (in_array($data['document_type'], ['Co_Debtor_Pay_Stubs','Debtor_Pay_Stubs', 'W2_Last_Year', 'W2_Year_Before', 'Insurance_Documents'])
                    || in_array($data['document_type'], ['Miscellaneous_Documents','Other_Misc_Documents', 'Vehicle_Registration', 'Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'])
                    || in_array($data['document_type'], array_keys($clientDocs))
                    || in_array($data['document_type'], array_keys($venmoPaypalCash))
                    || in_array($data['document_type'], array_keys($brokerageAccount))
                    || in_array($data['document_type'], $adminDocs)
                    || in_array($data['document_type'], $docsMisc)
                    || in_array($data['document_type'], \App\Models\ClientDocumentUploaded::getTaxDocumentById())
                    || in_array($data['document_type'], ['debtor_Social_Security_Annual_Award_Letter','debtor_VA_Benefit_Award_Letter','debtor_Unemployment_Payment_History_Last_7_Months'])
                    || in_array($data['document_type'], ['codebtor_Social_Security_Annual_Award_Letter','codebtor_VA_Benefit_Award_Letter','codebtor_Unemployment_Payment_History_Last_7_Months'])
                ) {
                    $formultiples = true;
                }

                ?>
            <?php /*if($ind2%2==1){ echo "<tr>"; }?>
            <td class="no_border" width="50%"><table width="100%"> <?php */ ?>

         <tr id="<?php echo $data['id']; ?>">
            <td width="1%" class="dragHandle text-center"><i class="feather icon-move"></i><br>Reorder</td>
               <td width="1%">
               <?php if ($checkbox) {?>
                 <?php
                  $data_item = $data['document_type'];
                   if (@$employer_id > 0) {
                       $data_item = $employer_id."_".$data['document_type'];
                   } ?> <input type="checkbox" class="checked_docs" data-item="{{$data_item}}" name="pdf_id[]" value="{{$data['id']}}">&nbsp;
               <?php }?>
               </td>
               <td width="1%" style="position:relative;padding:4px;">
                  <?php
                       $svgname = Helper::validate_key_value('svg', $docData);
                $svgname = empty($svgname) ? 'attorney_docs.svg' : $svgname;
                $svgUrl = asset("assets/img/black_icons/".$svgname); ?>

                    <?php

                    if (in_array($data['document_type'], array_keys($clientDocs))) {
                        $svgname = 'bank_doc.svg';
                        $svgUrl = asset("assets/img/black_icons/".$svgname);
                    }
                if (in_array($data['document_type'], array_keys($venmoPaypalCash))) {
                    $svgname = 'bank_doc.svg';
                    $svgUrl = asset("assets/img/black_icons/".$svgname);
                }
                if (in_array($data['document_type'], array_keys($brokerageAccount))) {
                    $svgname = 'bank_doc.svg';
                    $svgUrl = asset("assets/img/black_icons/".$svgname);
                }
                if (in_array($data['document_type'], $attorneyDocs)) {
                    $svgname = 'attorney_docs.svg';
                    $svgUrl = asset("assets/img/black_icons/".$svgname);
                }
                if (in_array($data['document_type'], $adminDocs)) {
                    $svgname = 'requested_doc.svg';
                    $svgUrl = asset("assets/img/black_icons/".$svgname);
                } ?>
                     <img src="<?php echo @$svgUrl; ?>" class="licence-img " style="height:40px" alt="icon">
                     <span class="unread-indicator {{$indicator}}">New Doc(s) Uploaded</span>
               </td>

                 <?php $docId = $data['id'];
                $docname = !empty($data['updated_name']) ? $data['updated_name'] : $data['document_name'];
                $document_file = $data['document_file'];

                if ($formultiples) {
                    $filedocname = str_replace("documents/".$client_id."/", "", $document_file);
                    $show = '';
                }
                ?>
                 <td <?php if ($checkbox) {?>width="37%" <?php } else {?> width="53%" <?php } ?>>
                  <div class="doc-type d-flex">
                        <span class="small_title text-bold edit_doc_name_{{$docId}} long-attorney-text  bold-wide"><?php echo $docname; ?> </span>
                        <?php if ($formultiples) { ?>
                            <input type="text" name="" id="" class="form-control-none only_alphanumeric edit_doc_name_input_{{$docId}} " value="<?php echo $docname; ?>" readonly="true" >
                              <span class="ml-1 text-bold edit edit_doc_name_{{$docId}}" onclick="edit_doc_name('{{$docId}}')">
                                 Rename Document
                                 <i class="fas fa-pencil-square-o"></i>
                              </span>
                            <a href="javascript:void(0)"
                               onclick='update_doc_fn("{{$docId}}","{{$filedocname}}","{{$client_id}}","{{$document_file}}")'
                               class=" ml-1 submit edit_doc_name_submit_{{$docId}} d-none view_client_btn">Save</a>
                        <?php } ?>


                     <?php if (in_array($data['document_type'], array_keys($clientDocs)) || in_array($data['document_type'], array_keys($venmoPaypalCash)) || in_array($data['document_type'], array_keys($brokerageAccount))) {
                         $months = 3;
                         if (!empty($val['client_bank_statements_premium']) || $val['client_subscription'] == \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION) {
                             $months = 6;
                         }
                         $bank_statement_month_nos = $bank_statement_months;
                         if (isset($bank_account_documents) && !empty($bank_account_documents)) {

                             foreach ($bank_account_documents as $docu) {
                                 if ($docu['document_name'] === $data['document_type']) {
                                     $bank_statement_month_nos = ($docu['bank_account_type'] == 2) ? ($attProfitLossMonths) : $bank_statement_months;
                                     break;
                                 }
                             }
                         }
                         $hideSelect = '';
                         if (isset($brokerageAccount) && !empty($brokerageAccount)) {
                             foreach ($brokerageAccount as $key => $name) {
                                 if ($key === $data['document_type']) {
                                     $hideSelect = 'hide-data';
                                     break;
                                 }
                             }
                         }
                         $statement_month_array = DateTimeHelper::getBankStatementMonthArray($bank_statement_month_nos);
                         $doc_type = $data['document_type'];
                         ?>
                        &nbsp;<select class="float-right <?php echo $hideSelect; ?>" onchange="renameDocument('<?php echo $client_id; ?>', '<?php echo $data['id']; ?>', this, '<?php echo $doc_type; ?>')">
                            <option value="">Choose name</option>
                           <?php foreach ($statement_month_array as $month => $name) { ?>
                              <option value="{{$month}}" <?php echo $data['document_month'] == $month ? 'selected' : '';?> > {{$name}}</option>
                        <?php } ?>
                        </select>
                        <?php } ?>
                      @include("attorney.doc_mgmt.accept_decline_btns")
                    </div>
                  </td>



            <td width="30%">
               @include("attorney.doc_mgmt.btn_actions")
            </td>
            <td width="15%">
               <!-- creditor selectbox -->
               <?php
                  if (in_array($data['document_type'], ['Miscellaneous_Documents','Other_Misc_Documents'])) {
                      $debt_tax = Helper::validate_key_value('debt_tax', $final_debts);
                      $back_tax_own = Helper::validate_key_value('back_tax_own', $final_debts);
                      $domestic_tax = Helper::validate_key_value('domestic_tax', $final_debts);
                      $additional_liens_data = Helper::validate_key_value('additional_liens_data', $final_debts);
                      $creditor_value = $data['creditor_value'] ?? '';
                      $select_show = '';
                      if (!empty($creditor_value)) {
                          $creditorType = substr($creditor_value, 0, -2);
                          $creditorTypeIndex = substr($creditor_value, -1) - 1;
                          $creditorName = '';
                          $select_show = 'd-none';
                          switch ($creditorType) {
                              case 'Debt':
                                  $debt_d = Helper::validate_key_value($creditorTypeIndex, $debt_tax);
                                  $creditorName = Helper::validate_key_value('creditor_name', $debt_d);
                                  break;
                              case 'Back_Taxes':
                                  $Back_Taxes_d = Helper::validate_key_value($creditorTypeIndex, $back_tax_own);
                                  $Back_Taxes_item = AddressHelper::getStateTaxAddress(Helper::validate_key_value('debt_state', $Back_Taxes_d));
                                  $creditorName = Helper::validate_key_value('address_heading', $Back_Taxes_item);
                                  break;
                              case 'IRS':
                                  $creditorName = 'Internal Revenue Service';
                                  break;
                              case 'DSO':
                                  $dso_d = Helper::validate_key_value($creditorTypeIndex, $domestic_tax);
                                  $creditorName = Helper::validate_key_value('domestic_support_name', $dso_d);
                                  break;
                              case 'Additonal_liens':
                                  $additional_liens_d = Helper::validate_key_value($creditorTypeIndex, $additional_liens_data);
                                  $creditorName = Helper::validate_key_value('domestic_support_name', $additional_liens_d);
                                  break;
                              default:
                                  $creditorName = '';
                                  break;
                          }
                          $creditorType = str_replace('_', ' ', $creditor_value);
                          ?>
                  <span class="related_section_{{$docId}}">Related to <?php echo $creditorType;?>: <?php echo $creditorName; ?></span>
                  <i onclick="edit_creditors_to_doc('{{$docId}}')" class="fas fa-pencil-square-o ml-2 edit related_section_{{$docId}} pt-1 "></i>
                  <?php }?>
                     <select class="form-control move-to-select height-unset select-custom-padding document_creditor_<?php echo $docId;
                      echo ' '.$select_show; ?>" onchange="update_creditors_to_doc('{{$docId}}','{{$creditor_value}}','{{$client_id}}')" id="creditor" name="document_creditor">
                        <option disabled selected>Choose Creditor</option>
                        <!-- debt taxes -->
                        <?php if (!empty($debt_tax)) {?>
                        <optgroup label="Unsecured Debts"></optgroup>
                        <?php $i = 1;
                            foreach ($debt_tax as $debt_data) { ?>
                           <option value="Debt_<?php echo $i;?>" <?php if ($creditor_value == 'Debt_'.$i) {
                               echo 'selected';
                           }?>><?php echo $i.'. '. Helper::validate_key_value('creditor_name', $debt_data); ?></option>
                        <?php $i++;
                            }
                        }  ?>
                        <!-- back taxes -->
                        <?php if (!empty($back_tax_own)) {?>
                        <optgroup label="State Back Taxes"></optgroup>
                        <?php $i = 1;
                            foreach ($back_tax_own as $bt_data) {
                                $item = AddressHelper::getStateTaxAddress(Helper::validate_key_value('debt_state', $bt_data)); ?>
                           <option value="Back_Taxes_<?php echo $i;?>" <?php if ($creditor_value == 'Back_Taxes_'.$i) {
                               echo 'selected';
                           }?>><?php echo Helper::validate_key_value('address_heading', $item); ?></option>
                        <?php $i++;
                            }
                        } ?>
                        <!-- irs -->
                        <optgroup label="IRS"></optgroup>
                        <option value="IRS_1" <?php if ($creditor_value == 'IRS_1') {
                            echo 'selected';
                        }?>><?php echo 'Internal Revenue Service';?></option>
                        <!-- domestic support -->
                        <?php if (!empty($domestic_tax)) {?>
                        <optgroup label="Domestic Support Debts"></optgroup>
                        <?php $i = 1;
                            foreach ($domestic_tax as $dt_data) { ?>
                           <option value="DSO_<?php echo $i;?>" <?php if ($creditor_value == 'DSO_'.$i) {
                               echo 'selected';
                           }?>><?php echo Helper::validate_key_value('domestic_support_name', $dt_data); ?></option>
                        <?php $i++;
                            }
                        } ?>
                        <!-- additional liens -->
                        <?php if (!empty($additional_liens_data)) {?>
                        <optgroup label="Additional Liens"></optgroup>
                        <?php $i = 1;
                            foreach ($additional_liens_data as $al_data) { ?>
                           <option value="Additonal_liens_<?php echo $i;?>" <?php if ($creditor_value == 'Additonal_liens_'.$i) {
                               echo 'selected';
                           }?>><?php echo Helper::validate_key_value('domestic_support_name', $al_data); ?></option>
                        <?php $i++;
                            }
                        } ?>
                     </select>
                  <?php } ?>
               </td>



            </tr>

            <?php /*
                </table></td>
            <?php  $ind2 = $ind2+1; if($ind2%2==1){ echo "</tr>"; } */ ?>


 <?php }?>


