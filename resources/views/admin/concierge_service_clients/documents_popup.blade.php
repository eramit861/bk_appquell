<?php
$video['en'] = '';
$video['sp'] = '';
$videos = VideoHelper::getAdminVideos();
$tutorial = $videos[Helper::INVITE_DOCUMENT_REQUEST_POPUP] ?? [];
$video = VideoHelper::getVideos($tutorial);

$list = @$docsUploadInfo['list'];
$documentuploaded = @$docsUploadInfo['documentuploaded'];

$attorneydocuments = @$docsUploadInfo['attorneydocuments'];
$bankDocuments = @$docsUploadInfo['bankDocuments'];
$venmoPaypalCash = @$docsUploadInfo['venmoPaypalCash'];
$brokerageAccount = @$docsUploadInfo['brokerageAccount'];
$lifeInsuranceDocuments = @$docsUploadInfo['lifeInsuranceDocuments'];
$retirement_pension = @$docsUploadInfo['retirement_pension'];
$adminDocuments = @$docsUploadInfo['adminDocuments'];
$bankDocsBussinessKeys = @$docsUploadInfo['bankDocsBussinessKeys'];

$acceptdTaxReturnDocs = array_filter($list, function ($doc) {
    $validTypes = [
        'Last_Year_Tax_Returns',
        'Prior_Year_Tax_Returns',
        'Prior_Year_Two_Tax_Returns',
        'Prior_Year_Three_Tax_Returns'
    ];

    return in_array($doc['document_type'], $validTypes) && ($doc['document_status'] == 1 || $doc['added_by_attorney']);
});

$acceptdTaxReturnDocs = array_column($acceptdTaxReturnDocs, 'document_type');
;
$hidebtn = @$docsUploadInfo['hidebtn'];



$documentTypes = @$docsUploadInfo['documentTypes'];
$attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();


$ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
$settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney->attorney_id;
$is_associate = !empty($ClientsAssociateId) ? 1 : 0;
$documentTypes = array_merge($documentTypes, $vehicleRegisterationDocs);
$documentTypes = array_merge($documentTypes, ['Insurance_Documents' => 'Proof of Auto Insurance']);

$excludeDocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->first();
$excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];
$alldocKeys = array_column($documentuploaded, 'document_type');
$updatedList = [];
if (!empty($excludeDocs)) {

    foreach ($excludeDocs as $index => $excludeKey) {
        if (array_key_exists($excludeKey, $documentTypes)) {
            unset($documentTypes[$excludeKey]);
        }

        if ($excludeKey == 'Vehicle_Registration') {
            foreach ($documentTypes as $key => $doc) {
                if (str_starts_with($key, 'Vehicle_Registration_')) {
                    unset($documentTypes[$key]);
                }
            }
        }

    }
}
$AttorneyExcludeDocsPerClient = \App\Models\AttorneyExcludeDocsPerClient::where(['attorney_id' => $settingsAttorneyId, 'client_id' => $client_id])->first();
$AttorneyExcludeDocsPerClient = !empty($AttorneyExcludeDocsPerClient) ? $AttorneyExcludeDocsPerClient->toArray() : [];
$docJsonPerClient = Helper::validate_key_value('doc_type_json', $AttorneyExcludeDocsPerClient);
$docJsonPerClient = json_decode($docJsonPerClient) ?? [];
$mergedArray = array_merge($excludeDocs, $docJsonPerClient);
$excludeDocs = array_unique($mergedArray);

$i = 1;

$clientPropertyData = \App\Services\Client\CacheProperty::getPropertyData($client_id);
$clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
$clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

$clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty, false, true);
$mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
$clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($client_id);
$vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
$documentTypes = array_merge($documentTypes, $mortgageUpdatedNames);
$documentTypes = array_merge($documentTypes, $vehicleUpdatedNames);

$isPending = false;
?>

<div class="modal-content modal-content-div conditional-ques requested_client_documents">
    
    <div class="modal-header align-items-center py-2">
        <div class="row w-100 m-0">
            <div class="row col-9 m-0 p-0 group-1">
                <div class="col-12 col-md-6 invitemodalLabel">
                    <h5 class="modal-title d-flex" id="invitemodalLabel">
                        Requested Client Document(s)
                    </h5>
                </div>
                <div class="col-12 col-md-6 upload_labels">
                    <div class="d-flex align-items-center px-0">
                        <label class="text-center text-bold px-4 py-2 mb-0 w-100" style="font-style: italic;">
                            <span class="text-danger notes-popup-att-video p-2">Not Uploaded*</span>
                            <span class="ml-2 text-success notes-popup-att-video p-2">Uploaded*</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-3 group-2">
                <a href="javascript:void(0)" class="close-modal btn-new-ui-default bg-white att-video py-1 me-2 float-right" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="<?php echo $video['en']; ?>" data-video2="<?php echo $video['sp']; ?>">
                    <img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" alt="Video Logo" style="height: 26px;">
                </a>
            </div>
        </div>
    </div>

    <div class="modal-body p-0">
        <div class="card-body b-0-i">
            @include('attorney.client_document_request_list_request_form1',['documentList' => $documentTypes, 'doc_list_name' => 'request_doc_list','lifeInsuranceDocuments' => $lifeInsuranceDocuments, 'retirement_pension' => $retirement_pension,'bankDocuments'=>$bankDocuments,'unpaid_wages' => $unpaid_wages, 'excludeDocs' => $excludeDocs])                

            <?php if (isset($adminNotes) && !empty($adminNotes)) {?>
            <div class="row requestPopup">
                <div class="col-12">
                    <div class="light-gray-div mt-3 mb-2 pb-3">
                        <h2>Notes</h2>
                        <div class="row gx-3 w-100">	
                            <div class="col-12 body bg-unset p-0">
                                <div class="card listing-card bg-unset mb-0 b-0-i">
                                    <?php $i = 1;
                foreach ($adminNotes as $key => $data) { ?>
                                        <div class="row adminMessage <?php echo ($i == 1) ? '' : 'mt-3' ?>">
                                            <div class="col-0 col-sm-1 p-0"></div>
                                            <div class="col-10">
                                                <div class="messageBubble">
                                                    <p class="message_no_<?php echo $i;?> hidden m-0 messageBody"><?php echo nl2br($data['note']); ?> </p>
                                                </div>
                                                <p class="w-100 mb-0"><i><span class="addedOn addedOnRight">{{DateTimeHelper::dbDateToDisplay($data['created_at'],true)}}</span></i></p>
                                                <div class="tail"></div>
                                            </div>
                                            <div class="col-1">
                                                <label class="profileBubble"><?php echo substr('Y', 0, 1); ?></label>
                                            </div>
                                        </div>
                                    <?php $i++;
                } ?>     
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>                
            </div>
            <?php } ?>

            <div class="row requestPopup foot py-3">
                <div class="col-12">
                    <div class="light-gray-div mt-3 mb-2 pb-3">
                        <h2></h2>
                        <div class="gx-3">	
                            <div class=" mb-0 px-0">
                                <div class="row">
                                    <div class="col-12 col-sm-2 p-1">
                                        <div class="sendSectionIcon">
                                            <label class="profileBubble mx-auto"><?php echo substr('Y', 0, 1); ?></label>   
                                            <button class="print-hide add-new-btn mb-3 p-1 translateButton cursor-pointer btn-new-ui-default w-100" style="max-width: 100%" onclick="translateTextareaText(this)" data-translateto="es">
                                                <span class="fs-10px">Translate Email to Spanish</span> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
                                                    <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z"/>
                                                    <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31"/>
                                                </svg>
                                            </button>             
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-10 col-md-8 p-1">
                                        <div class="w-100 label-div mb-0">
                                            <div class="form-group mb-0">
                                                <div class="input-group mb-0 bg-unset">
                                                    <textarea rows="8" class="form-control h-unset" name="notify_message" data-message="Dear {{$client->name}},<?= PHP_EOL ?>You are requested to submit the following documents in order to complete your questionnaire:" id="notifyMessage">Dear {{$client->name}},<?= PHP_EOL ?>You are requested to submit the following documents in order to complete your questionnaire:
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 p-1">
                                        <div class=" text-center ">
                                            <button type="submit" class="print-hide mx-auto submitButton cursor-pointer btn-new-ui-default p-2 w-100 float-right" style="max-width: 200px" onclick="notifyClient()">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="pl-3 selected_doc_list hide-data mb-0"></ul>                       
                        </div>
                    </div>
                </div>                
            </div>

        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('textarea[name="notify_message"]').on("input", function() {
            var message = $(this).val();
            var previewList = $("#previewList");
            var listItem = previewList.find("li");
            if (message.trim() === '') {
                $('.preview_text_section').addClass('hide-data');
                listItem.remove();
                
            } else {
                if (listItem.length === 0) {
                    listItem = $("<li></li>");
                    previewList.append(listItem);
                    
                }
                $('.preview_text_section').removeClass('hide-data');
                listItem.text(message);
                
            }
        });

        $('input[name="admin_document"]').keyup(function() {
            var docName = $(this).val();
            if (docName.trim() !== '') {
                $(this).removeClass('error');
            } else {
                $(this).addClass('error');
            }
        });

    });

    selectAll = function ( ) {
        const uncheckedNonAcceptedDocs = document.querySelectorAll('.request-popup-<?php echo $client_id; ?> .not-accepted:not(:checked)');
        uncheckedNonAcceptedDocs.forEach(doc => {
            doc.click();
        });

        $('.select-all-span').addClass('hide-data');
        $('.deselect-all-span').removeClass('hide-data');

    };

    deselectAll = function ( ) {
        const checkedNonAcceptedDocs = document.querySelectorAll('.request-popup-<?php echo $client_id; ?> .not-accepted:checked');
        checkedNonAcceptedDocs.forEach(doc => {
            doc.click();
        });

        $('.select-all-span').removeClass('hide-data');
        $('.deselect-all-span').addClass('hide-data');

    };


    var requestedDocs = {};

    function appendTextToNotificationMessage() {
        var defaultText = $('#notifyMessage').attr('data-message');
        let selectedList = '\n';
        $('.selected_doc_list li').each(function(index, li) {
            selectedList += (index + 1) + ". " + $(li).text() + "\n";
        });
        $('#notifyMessage').val(defaultText + selectedList).trigger('change');
    }

    updateAllCheckedState = function(){
        const selectors = [
            '.request_doc_list .notify_doc:not(:checked)',
            '.request_doc_list .notify_admin_doc:not(:checked)',
            '.request_doc_list .notify_ad_doc:not(:checked)'
        ];

        // Check if any document remains unchecked
        const anyUnchecked = selectors.some(selector => document.querySelector(selector));

        if (anyUnchecked) {
            $('.select-all-span').removeClass('hide-data'); // Show "Select All"
            $('.deselect-all-span').addClass('hide-data');  // Hide "Deselect All"
        } else {
            $('.select-all-span').addClass('hide-data');    // Hide "Select All"
            $('.deselect-all-span').removeClass('hide-data'); // Show "Deselect All"
        }
    }

    addToPreview = function(list, index, addVideo = 0, paystubType = '') {
        updateAllCheckedState();
        var isChecked, key, docname, name, newHtml, videoHtml = '';
        if (list == 'main') {
            isChecked = $('input[name="notify_doc_' + index + '"]').is(':checked');
            key = $('input[name="notify_doc_' + index + '"]').data('key');
            docname = $('input[name="notify_doc_' + index + '"]').data('docname');
            var checkboxElem = $('input[name="notify_doc_' + index + '"]');
            if (isChecked) {
                requestedDocs[key] = docname;
                name = $('.name_main_' + index).html();
                if(addVideo){
                    videoHtml = getVideoHtml(key);
                }
                newHtml = '<li class="selected_main_' + index + '">' + name + videoHtml + '</li>';
                $('.selected_doc_list').append(newHtml);
                checkboxElem.closest('.item-card').addClass('selected');
                checkboxElem.closest('.item-card').removeClass('no-selected');
            } else {
                $('.selected_doc_list li.selected_main_' + index).remove();
                delete requestedDocs[key];
                checkboxElem.closest('.item-card').removeClass('selected');
                checkboxElem.closest('.item-card').addClass('no-selected');
            }
        }       
        if (list == 'add') {
            isChecked = $('input[name="notify_ad_doc_' + index + '"]').is(':checked');
            key = $('input[name="notify_ad_doc_' + index + '"]').data('key');
            docname = $('input[name="notify_ad_doc_' + index + '"]').data('docname');
            var checkboxElem = $('input[name="notify_ad_doc_' + index + '"]');
            if (isChecked) {
                requestedDocs[key] = docname;
                name = $('.name_ad_' + index).html();
                newHtml = '<li class="selected_add_' + index + '">' + name + '</li>';
                $('.selected_doc_list').append(newHtml);
                checkboxElem.closest('.item-card').addClass('selected');
                checkboxElem.closest('.item-card').removeClass('no-selected');
            } else {
                $('.selected_doc_list li.selected_add_' + index).remove();
                delete requestedDocs[key];
                checkboxElem.closest('.item-card').removeClass('selected');
                checkboxElem.closest('.item-card').addClass('no-selected');
                
            }
        }
        if (list == 'admin') {
            isChecked = $('input[name="notify_admin_doc_' + index + '"]').is(':checked');
            key = $('input[name="notify_admin_doc_' + index + '"]').data('key');
            docname = $('input[name="notify_admin_doc_' + index + '"]').data('docname');
            var checkboxElem = $('input[name="notify_admin_doc_' + index + '"]');
            if (isChecked) {
                requestedDocs[key] = docname;
                name = $('.name_admin_' + index).html();
                newHtml = '<li class="selected_admin_' + index + '">' + name + '</li>';
                $('.selected_doc_list').append(newHtml);
                
                checkboxElem.closest('.item-card').addClass('selected');
                checkboxElem.closest('.item-card').removeClass('no-selected');
            } else {
                $('.selected_doc_list li.selected_admin_' + index).remove();
                delete requestedDocs[key];
                checkboxElem.closest('.item-card').removeClass('selected');
                checkboxElem.closest('.item-card').addClass('no-selected');
                
            }
        }
        appendTextToNotificationMessage();
    }

    addPaystubToPreview = function (docType, empKey, dateKey, empName, isBussiness = false) {
        updateAllCheckedState();
        var isChecked, key, displayDate, formattedDate, name, newHtml = '';
        var checkboxElem = $('input[name="notify_doc_' + docType + '-' + empKey + '-' + dateKey + '"]');
        
        isChecked = checkboxElem.is(':checked');
        key = checkboxElem.data('key');
        formattedDate = checkboxElem.data('docname');

        if (isBussiness) {
            docType = "bussiness_profit_loss";
            empName = empName + ' Profit/Loss:';
        }

        // Ensure docType exists in requestedDocs
        if (!requestedDocs[docType]) {
            requestedDocs[docType] = {};
        }
        
        // Ensure empKey exists under the specified docType, initialize with an empty array if not
        if (!requestedDocs[docType][empKey]) {
            requestedDocs[docType][empKey] = [];
        }
        
        var datesArray = requestedDocs[docType][empKey];
        
        if (isChecked) {
            // Add the formatted date to requestedDocs if not already present
            if (!datesArray.includes(formattedDate)) {
                datesArray.push(formattedDate);
            }
            
            // Sort dates in ascending order for storage
            datesArray.sort();
            
            var displayDates = getDisplayDates(datesArray, isBussiness );
            
            console.log('displayDates', displayDates);
            console.log('datesArray', datesArray);
            // Construct name with the display dates
            name = empName + " (" + displayDates.join('; ') + ")";
            
            // Update the selected_doc_list
            var existingListItem = $('.selected_doc_list li.selected_main_' + key);
            if (existingListItem.length > 0) {
                existingListItem.html(name);
            } else {
                newHtml = '<li class="selected_main_' + key + '">' + name + '</li>';
                $('.selected_doc_list').append(newHtml);
            }
            
            checkboxElem.closest('.item-card').addClass('selected');
            checkboxElem.closest('.item-card').removeClass('no-selected');
        } else {
            // Remove the date if unchecked
            datesArray = datesArray.filter(d => d !== formattedDate);
            
            if (datesArray.length > 0) {
                requestedDocs[docType][empKey] = datesArray;
                var remainingDisplayDates = getDisplayDates(datesArray, isBussiness );
                name = empName + " (" + remainingDisplayDates.join('; ') + ")";                
                $('.selected_doc_list li.selected_main_' + key).html(name);
            } else {
                delete requestedDocs[docType][empKey];
                $('.selected_doc_list li.selected_main_' + key).remove();
            }
            
            checkboxElem.closest('.item-card').removeClass('selected');
            checkboxElem.closest('.item-card').addClass('no-selected');
        }
        appendTextToNotificationMessage();
    }

    getDisplayDates = function ( datesArray, isBussiness ) {
        var DisplayDates = [];
        datesArray.forEach(d => {
            var [year, month, day] = d.split('-');
            var date = new Date(d);
            date.setTime(date.getTime() + date.getTimezoneOffset() * 60 * 1000);
            // Format date based on isBussiness flag
            var formattedDate = isBussiness 
                ? date.toLocaleString('en-US', { month: 'long', year: 'numeric' })  // "December, 2024"
                : date.toLocaleString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });  // "Dec 01, 2024"

            DisplayDates.push(formattedDate);
        });
        return DisplayDates;
    }


    function getVideoHtml(key) {
        let videoHtml = '';

        if (key.includes('paypal_account')) {
            videoHtml = " See how to get statements Android: " + "<?php echo Helper::validate_key_value('en', $paypalVideos['android']); ?>" +
                        " Apple: " + "<?php echo Helper::validate_key_value('en', $paypalVideos['iphone']); ?>" +
                        " Desktop: " + "<?php echo Helper::validate_key_value('en', $paypalVideos['desktop_laptop']); ?>";
        } else if (key.includes('venmo_account')) {
            videoHtml = " See how to get statements Android: " + "<?php echo Helper::validate_key_value('en', $venmoVideos['android']); ?>" +
                        " Apple: " + "<?php echo Helper::validate_key_value('en', $venmoVideos['iphone']); ?>" +
                        " Desktop: " + "<?php echo Helper::validate_key_value('en', $venmoVideos['desktop_laptop']); ?>";
        } else if (key.includes('cash_account')) {
            videoHtml = " See how to get statements Android: " + "<?php echo Helper::validate_key_value('en', $cashAppVideos['android']); ?>" +
                        " Apple: " + "<?php echo Helper::validate_key_value('en', $cashAppVideos['iphone']); ?>" +
                        " Desktop: " + "<?php echo Helper::validate_key_value('en', $cashAppVideos['desktop_laptop']); ?>";
        }

        return videoHtml;
    }

    notifyClient = function() {
        var ajaxurl = "<?php echo $notifyClientRoute; ?>";
        var listHtml = $('.selected_doc_list').html();
        var category = '';
        var message = $('textarea[name="notify_message"]').val();
        if (message == '') {
            $.systemMessage("Message is Required.", 'alert--danger', true);
            return false;
        }
        if (window.confirm("Are you sure you want to send a notification to the client?")) {
            var requestData = {
                requestedDocs: requestedDocs,
                list: listHtml,
                category: category,
                message: message,
                client_id: '<?php echo $client_id; ?>',
                attorney_id: '<?php echo $attorney_id; ?>'
            };
            
            laws.ajax(ajaxurl, requestData, function(response) {
                var res = JSON.parse(response);
                if (res.status == 0) {
                    $.systemMessage(res.msg, 'alert--danger', true);
                } else {
                    $.systemMessage(res.msg, 'alert--success', true);
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                }
            });
        }
    }

    addNewAdminDocument = function() {
        if ($('div.admin-document').hasClass('hide-data')) {
            $('div.admin-document').removeClass('hide-data');
        }
        $('div.new-admin-document').removeClass('hide-data');
        $('.add-btn').addClass('hide-data');
        $('.save-btn').removeClass('hide-data');
    }

    saveNewAdminDocument = function() {
        var docName = $('input[name="admin_document"]').val();
        if (docName.trim() === '') {
            $.systemMessage("Document name should not be empty.", 'alert--danger', true);
            $('input[name="admin_document"]').addClass('error').focus();
            return;
        }
        if (window.confirm("Are you sure you want to add new document to the client?")) {
            var ajaxurl = "<?php echo $saveDocRoute; ?>";

            var requestData = {
                admin_document: docName,
                client_id: '<?php echo $client_id; ?>',
            };
            laws.ajax(ajaxurl, requestData, function(response) {
                var res = JSON.parse(response);
                if (res.status == 0) {
                    $.systemMessage(res.msg, 'alert--danger', true);
                    var docListLength = $('.admin-document-list').length;
                    if (docListLength == '0') {
                        $('.admin-document-list').addClass('hide-data');
                        $('.admin-document').addClass('hide-data');
                        $('.new-admin-document').addClass('hide-data');
                        $('.add-btn').removeClass('hide-data');
                        $('.save-btn').addClass('hide-data');
                    }
                    $('input[name="admin_document"]').val('')
                } else {
                    $.systemMessage(res.msg, 'alert--success', true);
                    $('.admin-document-list').removeClass('hide-data');
                    $('.new-admin-document').addClass('hide-data');
                    $('.add-btn').removeClass('hide-data');
                    $('.save-btn').addClass('hide-data');
                    $('input[name="admin_document"]').val('');
                    addToList(docName);
                }
            });
        }

    }
    $(".only_alphanumeric").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });

    addToList = function(docName) {
        var docKey = docName.replace(/ /g, '_');
        var lastListItem = $('.admin-document-list').find('input').last();
        var smallComma = "'";
        if (lastListItem.length == '0') {
            var newListItem = $('<div class="col-3 mt-1 admin-document-list list-item-0">\
                    <div class="card item-card not-uploaded-border " data-label="">\
                        <div class="card-body p-1">\
                            <label class="w-100 d-flex mb-0" for="request_admin_doc_doc_list' + docKey + '">\
                                <span class="d-status font-color-fail"><i class="fa fa-cloud-upload-alt" aria-hidden="true"></i></span>\
                                <span class="doc-card w-100 name_admin_0 font-color-fail">' + docName + '</span>\
                                <input type="checkbox" \
                                    class="float_right mt-1 d-none notify_admin_doc not-accepted" \
                                    id="request_admin_doc_doc_list' + docKey + '" \
                                    name="notify_admin_doc_0"\
                                    value="1"\
                                    onclick="addToPreview('+smallComma+'admin'+smallComma+','+smallComma+'0'+smallComma+')"\
                                    data-key="' + docKey + '"\
                                    data-docname="' + docName + '">\
                            </label>\
                        </div>\
                    </div> \
                </div>');

        } else {
            var newIndex = $('.admin-document-list').length;
            var newListItem = $('<div class="col-3 mt-1 admin-document-list list-item-' + newIndex + '">\
                    <div class="card item-card not-uploaded-border " data-label="">\
                        <div class="card-body p-1">\
                            <label class="w-100 d-flex mb-0" for="request_admin_doc_doc_list' + docKey + '">\
                                <span class="d-status font-color-fail"><i class="fa fa-cloud-upload-alt" aria-hidden="true"></i></span>\
                                <span class="doc-card w-100 name_admin_' + newIndex + ' font-color-fail">' + docName + '</span>\
                                <input type="checkbox" \
                                    class="float_right mt-1 d-none notify_admin_doc not-accepted" \
                                    id="request_admin_doc_doc_list' + docKey + '" \
                                    name="notify_admin_doc_' + newIndex + '"\
                                    value="1"\
                                    onclick="addToPreview('+smallComma+'admin'+smallComma+','+smallComma+'' + newIndex + ''+smallComma+')"\
                                    data-key="' + docKey + '"\
                                    data-docname="' + docName + '">\
                            </label>\
                        </div>\
                    </div> \
                </div>');
        }

        var lastDocDiv = $('.admin-document-list').last();
        if (lastDocDiv.length == '0') {
            $('.admin-document').last().after(newListItem);
        } else {
            lastDocDiv.after(newListItem);
        }

    }

    function translateTextareaText(element) {
        const textToTranslate = $('#notifyMessage').val();
        var ajaxurl = "<?php echo route('translate_to_spanish'); ?>";
        var translateTo = $(element).data('translateto');
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                text: textToTranslate,
                to: translateTo,
                _token: '{{ csrf_token() }}'
            },
            success: function(translatedText) {
                $('#notifyMessage').val(translatedText);

                if (translateTo === 'es') {
                    $(element).data('translateto', 'en');
                    $(element).find('span').html('Translate Email to English');
                } else if (translateTo === 'en') {
                    $(element).data('translateto', 'es');
                    $(element).find('span').html('Translate Email to Spanish');
                }
            },
            error: function(error) {
                console.error('Error translating text:', error);
            }
        });
    }

   
</script>
<style>
    .select-all-button{
        cursor: pointer;
    }
    .bg-default{
        background: #ebf2fc;
    }
    .font-color-sucess {
        color: #28a745 ;
    }
    .font-color-fail {
        color: #dc3545 ;
    }
    .font-color-accept  {
        color: #28a745 ;
    }
    .font-color-decline{
        color: #ffa600;
    }
    .d-status i{
        padding: 0px !important;
        display: inline-block;
        width: 24px;
        font-size: unset !important;
    }

    a.font-color-sucess,
    a.font-color-fail {
        padding: 0px !important;
    }

    .list_con_doc {
        list-style: none;
        padding: 0px;
    }

    #facebox .content.fbminwidth {
        min-width: 1200px;
        min-height: 400px;
        padding: 0px;
    }

    .notesTable th {
        border-top: 1px solid #eaeaea;
        border-bottom: 1px solid #eaeaea;
        color: #414141;
    }

    .notesTable table thead {
        background-color: #EDEEF0;
    }

    .notesTable table thead th {
        padding: 5px 10px 5px 10px;
    }

    .notesTable table tbody td {
        padding: 5px 10px 5px 10px;
    }

    .notesTable table tbody td {
        border-top: 1px solid #eaeaea;
    }

    .add-new-btn {
        background: #0e42df;
        color: #ffffff;
        border: none;
        border-radius: 0.3rem;
        padding: 6px 12px;
        font-weight: 400;
        font-size: 14px;
        text-decoration: none;
        transition: 0.3s all ease-in-out;
    }
    #video_modal{
        z-index:9999;
    }

    .add-new-btn:hover {
        background: #0e42df;
        color: #ffffff;
        box-shadow: 0px 0px 12px 3px rgba(0, 0, 0, 0.17);
        transition: 0.3s all ease-in-out;
    }

    .error {
        border-color: red !important;
    }

    .error:focus {
        box-shadow: 0 0 0 0.25rem rgb(253 13 13 / 25%);
    }

    
    .head, .foot {
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
        z-index: 1000;
        /* border-bottom: 1px solid #eaeaea; */
    }
    .head {
        top: 0;
    }
    .foot {
        bottom: 0;
        
    }

    [data-theme="dark"] {
        &  .head, .foot {
                background-color: var(--bs-white);
            }
    }

</style>
