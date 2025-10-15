<div class="row">
    <div class="col-md-12">
        <div class="card listing-card mb-0">
            <div class="card-block">
                <table class="list_con_doc w-100">
                    <tr>
                        <td><h4>List of Documents</h4></td>
                    </tr>
                    <?php
                    $list = @$docsUploadInfo['list'];
                    $documentuploaded = @$docsUploadInfo['documentuploaded'];

                    $attorneydocuments = @$docsUploadInfo['attorneydocuments'];
                    $hidebtn = @$docsUploadInfo['hidebtn'];



                    //$documentTypes = Helper::getDocuments($client->client_type,0,0);
                    $documentTypes = @$docsUploadInfo['documentTypes'];
                    $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();

                    $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
                    $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney->attorney_id;
                    $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

                    $excludeDocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->first();
                    $excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];
                    $alldocKeys = array_column($documentuploaded, 'document_type');
                    //documentTypes
                    $updatedList = [];
                    if (!empty($excludeDocs)) {
                        foreach ($documentTypes as $key => $doc) {
                            if (in_array($key, $excludeDocs)) {
                                unset($documentTypes[$key]);
                            }
                        }
                    }
                    $i = 1;
                    foreach ($documentTypes as $key => $name) {
                        $autoloankeys = array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1));
                        $mortloankeys = array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(1));
                        array_shift($autoloankeys);
                        array_shift($mortloankeys);
                        $notOwnedproperty = '';
                        $missingauto = Helper::findMissing($autoloankeys, $alldocKeys, count($autoloankeys), count($alldocKeys));
                        if ($key == 'Current_Auto_Loan_Statement') {
                            $key = current($missingauto);
                        }

                        $missingmortgage = Helper::findMissing($mortloankeys, $alldocKeys, count($mortloankeys), count($alldocKeys));
                        if ($key == 'Current_Mortgage_Statement') {
                            $key = current($missingmortgage);

                        }
                        $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
                        $uploadedClass = "font-color-fail";
                        $renabledupload = false;
                        $declineReason = '';
                        $status = 0;
                        $reason = '';
                        $statusmsg = '';
                        $showHideCheck = "";
                        if (in_array($key, ['W2_Last_Year','W2_Year_Before','Insurance_Documents','Other_Misc_Documents'])) {
                            continue;
                        }


                        if (in_array($key, ['Co_Debtor_Pay_Stubs',
                        'Debtor_Pay_Stubs']) && ($client->client_payroll_assistant == Helper::PAYROLL_ASSISTANT_TYPE_BOTH)) {
                            // continue;
                        }
                        if (in_array($key, @$documentuploaded)) {
                            $uploadedClass = "font-color-sucess";
                            $showHideCheck = "hide-data";
                            $doc = Helper::getArrayByKey($key, $list);
                            if (!empty($doc)) {
                                $renabledupload = $doc['document_enable_reupload'];
                                $declineReason = $doc['document_decline_reason'];
                                $status = $doc['document_status'];

                                if ($status == 1) {
                                    $statusmsg = "Accepted";
                                    $uploadedClass = "font-color-accept";
                                    $fStatus = '<i class="fas fa-check-circle"></i>';
                                }
                                if ($status == 2) {
                                    $statusmsg = "Declined";
                                    $uploadedClass = "font-color-decline";
                                    $fStatus = '<i class="fas fa-ban"></i>';
                                }
                            }
                        } ?>
                            <!-- top list -->
                            <tr>
                                <td>
                                    <a  style="cursor:auto;" title="<?php echo $statusmsg; ?>" href="javascript:void(0);" class="nav-linkf text-left <?php echo $uploadedClass; ?> d-flex">
                                        <div class="d-status"><?php echo $fStatus; ?></div>
                                        <?php $postfix = !empty($statusmsg) ? '&nbsp;<span class="font-weight-bold"> ('.$statusmsg.')</span>' : ''; ?>
                                        <div class="doc-card name_<?php echo $i;?>"><?php echo $name.$postfix; ?></div>
                                    </a>
                                </td>
                            </tr>
                        <?php $i++;
                    }
                    $attorneydocuments = !empty($attorneydocuments) ? json_decode($attorneydocuments, true) : [];
                    if (!empty($attorneydocuments) && is_array($attorneydocuments)) {
                        ?>
                        <tr>
                            <td><h4 class="mt-3">Additional Documents</h4></td>
                        </tr>
        
                    <?php $j = 1;
                        foreach ($attorneydocuments as $val) {
                            $showHideCheckAdd = "";
                            $attorneydocKey = Helper::validate_doc_type($val['document_name']);
                            $uploadedClass = "font-color-fail";
                            $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
                            if (in_array($attorneydocKey, @$documentuploaded)) {
                                $uploadedClass = "font-color-sucess";
                                $doc = Helper::getArrayByKey($key, $list);
                                $showHideCheckAdd = "hide-data";
                                if (!empty($doc)) {
                                    $renabledupload = $doc['document_enable_reupload'];
                                    $declineReason = $doc['document_decline_reason'];
                                    $status = $doc['document_status'];
                                    if ($status == 1) {
                                        $statusmsg = "Accepted";
                                        $uploadedClass = "font-color-accept";
                                        $fStatus = '<i class="fas fa-check-circle"></i>';
                                    }
                                    if ($status == 2) {
                                        $statusmsg = "Declined";
                                        $uploadedClass = "font-color-decline";
                                        $fStatus = '<i class="fas fa-ban"></i>';
                                    }
                                }
                            }?>
                        <!-- bottom list -->
                        <tr>
                            <td>
                                <a style="cursor:auto;" href="javascript:void(0);" class="nav-linkf text-left  <?php echo $uploadedClass; ?> d-flex" >
                                    <div class="d-status"><?php echo $fStatus; ?></div>
                                    <div class="doc-card name_ad_<?php echo $j;?>"><?php echo $val['document_name']; ?></div>
                                </a>
                            </td>
                        </tr>
                    <?php $j++;
                        }
                    } ?>
                    <tr>
                        <td>
                            <label class="mt-3 float_right" style="font-style: italic;">
                                <span class=" text-danger">Not Uploaded*</span><span class="ml-3 text-success">Uploaded*</span>
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .w-10{width: 20%;}
    a.font-color-sucess,a.font-color-fail{padding:0px !important;}
    .list_con_doc{list-style:none;padding:0px;}
    #facebox .content.fbminwidth {min-width: 500px; min-height: 400px; }
</style>
