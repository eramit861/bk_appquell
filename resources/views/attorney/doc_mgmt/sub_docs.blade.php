<?php  $data = isset($dit) ? $dit : $data;
$acceptType = ".heic,.jpeg,.png,.jpg,.pdf,.doc,.docx,.xltx,.vsdx,.dxf,.dot,.eml,.odt,.psd,.xlsx,.msg,.ppsx,.rtf,.numbers,.svg,.vsd,.eps,.md,.tiff,.ico,.json,.webp,.oxps,.pptx,.dwfx,.djvu,.dwf,.odp,.mobi,.xps,.ps,.xls,.dwg,.bmp,.csv,.html,.xlsb,.pages,.ods,.pps,.epub,.htm,.gif,.potx,.odg";?>
                    <?php if ($doc_page_open) { ?>  <form id="{{$data['document_type']}}"
                        action="<?php echo route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $data['document_type']]); ?>"
                        style="position: relative;"
                        method="GET">
                      <table width="100%" class="uploaded_documents_pagelist" id="pageList_<?php echo str_replace(" ", "_", $data['document_type']); ?>" ><?php } ?>
                        <?php if (isset($data['multiple']) && !empty($data['multiple'])) {
                            $paystubs = [];
                            foreach ($data['multiple'] as $payst) {
                                $thisdate = 1;
                                $dates = explode(".", $payst['updated_name']);
                                if (isset($dates[0]) && isset($dates[1]) && isset($dates[2])) {
                                    $month = $dates[0];
                                    $day = $dates[1];
                                    $year = $dates[2];
                                    $thisdate = $year.'/'. $month.'/'.$day;
                                    $thisdate = strtotime($thisdate);
                                }
                                $payst['compare_date'] = $thisdate;
                                $paystubs[] = $payst;
                            }
                            $data['multiple'] = $paystubs;
                            usort($data['multiple'], function ($a, $b) {
                                return $b['compare_date'] <=> $a['compare_date'];
                            });

                        }  ?>
                        <?php

                        if (in_array($data['document_type'], array_keys($clientDocs)) || in_array($data['document_type'], array_keys($venmoPaypalCash)) || in_array($data['document_type'], array_keys($brokerageAccount))) {
                            $monthdates = [];
                            if (isset($data['multiple']) && !empty($data['multiple'])) {
                                foreach ($data['multiple'] as $payst) {
                                    $thisdate = 1;
                                    $dates = explode("-", $payst['document_month']);
                                    if (isset($dates[0]) && isset($dates[1])) {
                                        $month = $dates[0];
                                        $year = $dates[1];
                                        $thisdate = $year.'/'. $month.'/01';
                                        $thisdate = strtotime($thisdate);

                                    }
                                    $payst['compare_month_date'] = $thisdate;
                                    $monthdates[] = $payst;
                                }

                                $data['multiple'] = $monthdates;
                                usort($data['multiple'], function ($a, $b) {
                                    return $a['sort_order'] <=> $b['sort_order'];
                                });
                                usort($data['multiple'], function ($a, $b) {
                                    return $b['compare_month_date'] <=> $a['compare_month_date'];
                                });


                            }
                        } ?>
                        <?php if ($data['document_type'] == "Debtor_Pay_Stubs") {
                            $route = (isset($route) && !empty($route)) ? $route : route('client_document_uploads');
                            $prevDocData = $data['multiple'] ?? [];
                            $filteredPrevDocData = [];
                            if (!empty($prevDocData)) {
                                $filteredPrevDocData = array_filter($prevDocData, function ($doc) use ($paystubAssignedDocIdsSelf) {
                                    return !in_array($doc['id'], $paystubAssignedDocIdsSelf);
                                });
                                $filteredPrevDocData = array_values($filteredPrevDocData);
                            }
                            $prevDocData = $filteredPrevDocData;
                            $client_type = 1;
                            $response = \App\Models\ClientDocuments::pay_check_calculation($client_id, $client_type);
                            if (!empty($response['debtorPayCheckData'])) {
                                ?>
                                @include('attorney.client.pay_check_calculation_without_accordian', ["documentuploaded" => $prevDocData, 'payCheckData' => $response['debtorPayCheckData'], 'completeList' => $response['debtorCompleteList'], 'isUploadedScreen' => true ])
                            <?php } ?>
                        <?php } elseif ($data['document_type'] == "Co_Debtor_Pay_Stubs") {
                            $route = (isset($route) && !empty($route)) ? $route : route('client_document_uploads');
                            $prevDocData = $data['multiple'] ?? [];
                            $filteredPrevDocData = [];
                            if (!empty($prevDocData)) {
                                $filteredPrevDocData = array_filter($prevDocData, function ($doc) use ($paystubAssignedDocIdsSpouse) {
                                    return !in_array($doc['id'], $paystubAssignedDocIdsSpouse);
                                });
                                $filteredPrevDocData = array_values($filteredPrevDocData);
                            }
                            $prevDocData = $filteredPrevDocData;
                            $client_type = 2;
                            $response = \App\Models\ClientDocuments::pay_check_calculation($client_id, $client_type);
                            if (!empty($response['codebtorPayCheckData'])) {
                                ?>
                                @include('attorney.client.pay_check_calculation_without_accordian', ["documentuploaded" => $data['multiple']??[], 'payCheckData' => $response['codebtorPayCheckData'], 'completeList' => $response['codebtorCompleteList'], 'isUploadedScreen' => true ])
                            <?php }?>
                        <?php }
                        if ($doc_page_open) {  ?>
                        <?php if (in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {?>
                            <tr style="border-bottom:1px solid #50cbcb"><td colspan='4'>
                          
                            <a class="float-right  view_client_btn delete_doc_btn p4px hide-data" data-item="{{$data['document_type']}}" data-url="<?php echo route('delete_bulk_documents', ['id' => $val['id'], 'type' => $data['document_type']]);?>" id="bulkdelete_{{$data['document_type']}}" href="javascript:void(0)" ><i class="fa fa-file-trash fa-lg" aria-hidden="true"></i> Delete Selected</a>
                                            <?php if (($doc_page_open == true && $multiplecount > 0) || in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) { ?>
                                            <input class="ml-2 parent_<?php echo $data['document_type']; ?>" type="checkbox" onclick="checkChildCheckboxes(this,'<?php echo $data['document_type']; ?>')" value="1" id="label_for_{{$data['document_type']}}"> <label for="label_for_{{$data['document_type']}}" class="click_all_docs">Click to Select All Doc(s) </label> 
                                        <?php } ?>
                                        
                                    </td></tr>
                            <?php } ?>
                            <?php if ($doc_page_open) { ?>
                            <tr><td colspan="6" class="p-0 m-0"> <a class="float-right mr-1 mt-1<?php echo empty($combinedForm) ? 'd-none' : '';?> p-0 view_client_btn p4px reorder_doc_btn" data-url="<?php echo route('get_document_for_combine', ['id' => $val['id'], 'type' => $data['document_type']]);?>" id="combined_{{$data['document_type']}}" href="javascript:void(0)" ><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i> <?php if ($data['document_type'] == 'Debtor_Pay_Stubs') {
                                echo "Combined Debtor's all Employment Paystubs";
                            } elseif ($data['document_type'] == 'Co_Debtor_Pay_Stubs') {
                                echo "Combined Co-Debtor's all Employment Paystubs";
                            } else {
                                echo "Combine Doc(s)/Reorder";
                            } ?></a></td></tr>
                            <?php } ?>
                            @include("attorney.client_uploaded_multiple_document",["documentuploaded" => $data['multiple']??[], "bank_statement_months" => $bank_statement_months])
                        <?php } ?>
                        <?php if ($doc_page_open) { ?> </table> 
                         
                    </form><?php } ?>
