/**
 * Attorney Document Management Script
 * Extracted from attorney_doc_script.blade.php
 */

// Global configuration object
window.AttorneyDocScriptConfig = window.AttorneyDocScriptConfig || {};

// Initialize the module
window.BK = window.BK || {};
window.BK.AttorneyDocScript = (function() {
    'use strict';

    // Private variables
    let morgageLoanStatements = [];
    let autoLoanStatements = [];

    // Initialize configuration
    function init() {
        morgageLoanStatements = window.AttorneyDocScriptConfig.morgageLoanStatements || [];
        autoLoanStatements = window.AttorneyDocScriptConfig.autoLoanStatements || [];
        
        // Initialize document ready functions
        $(document).ready(function() {
            initializeDocumentReady();
        });
    }

    // Document ready initialization
    function initializeDocumentReady() {
        // Initialize sortable containers
        initializeSortableContainers();

        // Set timeout for viewed by attorney update
        setTimeout(function() {
            const url = window.AttorneyDocScriptConfig.routes.updateViewedByAttorney;
            const client_id = window.AttorneyDocScriptConfig.clientId;
            laws.ajax(url, {
                client_id: client_id
            }, function(response) {});
        }, 5000);

        // OCR button click handler
        jQuery('.btn-ocr').on('click', function() {
            let filename = $(this).data('filename');
            let url = $(this).data('ocrurl') + "/debts/" + filename;

            $('#page_loader').show();
            $.post(url, function(response) {
                $('#page_loader').hide();
                $("#ocr_output .ocr-content").html(JSON.stringify(response));
                $("#ocr_output").modal('show');
            });
        });

        // Window resize handler
        $(window).on("resize", resize);
        resize();

        // Accordion handlers
      document.querySelectorAll(".accordian-with-docs-employer-header").forEach(function(header) {
    let targetId = header.getAttribute("data-bs-target").replace(/['"]+/g, ''); // Remove quotes
    const collapseEl = document.querySelector(targetId);
    const toggleText = header.querySelector(".accordian-with-docs");
    const toggleIcon = header.querySelector(".toggle-icon");

    let docsCount = '';
    if (toggleText) {
        docsCount = parseInt(toggleText.textContent.match(/\d+/));
        collapseEl.addEventListener('shown.bs.collapse', function() {
            toggleText.innerHTML = `Click to Hide ${docsCount} doc${docsCount > 1 ? '(s)' : ''}`;
        });

        collapseEl.addEventListener('hidden.bs.collapse', function() {
            toggleText.innerHTML = `Click to Show ${docsCount} doc${docsCount > 1 ? '(s)' : ''}`;
        });
    }

    if (toggleIcon) {
        collapseEl.addEventListener('shown.bs.collapse', function() {
            toggleIcon.innerHTML = `<i class="bi bi-chevron-up fs-5 ml-auto"></i>`;
        });

        collapseEl.addEventListener('hidden.bs.collapse', function() {
            toggleIcon.innerHTML = `<i class="bi bi-chevron-down fs-5 ml-auto"></i>`;
        });
    }
});


        // Hide accordion content initially
        $(".accordion-content").hide();
        
        // Handle document type selection
        const select_doc = window.AttorneyDocScriptConfig.selectedDocType || '';
        if (select_doc != '') {
            let select_doc_id = escapeSelector('select_' + select_doc);
            $('html, body').animate({
                scrollTop: $("#" + select_doc_id).offset().top
            }, 100);
        }

        // Event handlers for document management
        setupDocumentEventHandlers();
    }

    // Setup document event handlers
    function setupDocumentEventHandlers() {
        // Reorder document button click
        $(document).on("click", ".reorder_doc_btn", function(e) {
            e.preventDefault();
            $("#reorder_pdf").modal('show');

            var formId = this.id.replace(/^common_doc_(section|combine_btn)_/, '');
            var action_url = $(this).data('url');
            var combineType = $(this).data('ptype');
            const form = document.getElementById(formId);

            if (!form) {
                console.error("Form not found for ID:", formId);
                return;
            }

            const checkboxes = form.querySelectorAll('input[type="checkbox"].checked_docs');
            let selected = Array.from(checkboxes).filter(cb => cb.checked);

            let values;
            if (selected.length === 0) {
                values = Array.from(checkboxes).map(cb => cb.value);
            } else {
                values = selected.map(cb => cb.value);
            }

            const form_data = new FormData();
            form_data.delete('pdf_id[]');
            values.forEach(value => form_data.append('pdf_id[]', value));

            $.ajax({
                url: action_url,
                method: 'POST',
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == "1" && "reorder_view" in response && "pdf_download_url" in response) {
                        $("#reorder_pdf_submit").attr("href", response.pdf_download_url);
                        $("#reorder_pdf .modal-body").html(response.reorder_view);
                    } else {
                        $.systemMessage(response.msg, 'alert--danger', true);
                    }
                }
            });
        });

        // Reorder PDF modal hidden handler
        $("#reorder_pdf").on("hidden.bs.modal", function() {
            $("#reorder_pdf .modal-body").html(
                '<div class="modal-spinner d-flex justify-content-center align-items-center"><i class="fa fa-spinner fa-spin"> </i><span class="ml-2">Thumbnails are loading</span></div>'
            );
        });

        // Thumbnail generation status check
        const time_interval = setInterval(function() {
            const pending_thumbnail_docs = $($(".thumbnails_generate_pending")).map(function() {
                return $(this).data('document-id');
            }).get();
            
            if (pending_thumbnail_docs.length <= 0) {
                clearInterval(time_interval);
                return;
            }
            
            $.ajax({
                url: window.AttorneyDocScriptConfig.routes.getThumbnailGenerateStatus,
                method: 'POST',
                dataType: 'json',
                data: {
                    document_ids: pending_thumbnail_docs
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status && response.pending_ones) {
                        const class_list = {
                            "0": {
                                "class": "warning",
                                "label": "thumbnails generate pending",
                            },
                            "1": {
                                "class": "primary",
                                "label": "thumbnails generate in progress",
                            }
                        };
                        
                        $.each(response.pending_ones, function(key, value) {
                            const is_generated_thumbnails = value.is_generated_thumbnails.toString();
                            const elem = $(".thumbnails_generate_pending[data-document-id=" + value.id + "]");
                            
                            if (["0", "1"].includes(is_generated_thumbnails)) {
                                if (!elem.hasClass("label-" + class_list[is_generated_thumbnails].class)) {
                                    elem.html(class_list[is_generated_thumbnails].label);
                                    elem.removeClass("label-warning label-primary");
                                    elem.addClass("label-" + class_list[is_generated_thumbnails].class);
                                }
                            } else {
                                elem.removeClass("thumbnails_generate_pending");
                                elem.addClass("d-none");
                            }
                        });
                    }
                }
            });
        }, 1000);

        // Delete document button click
        $(document).on("click", ".delete_doc_btn", function(e) {
            e.preventDefault();

            if (!confirm("Are you sure you want to delete selected documents?")) {
                return;
            }

            $.systemMessage("Deleting selected document(s)..", 'alert--process');

            var formId = $(this).attr('id').replace('bulkdelete_', '');
            var action_url = $(this).attr('data-url');
            var doc_type = $(this).attr('data-item');
            var $form = $("#" + formId);
            $form.attr('action', action_url);

            let form_data = new FormData($form[0]);

            if (doc_type == 'Debtor_Pay_Stubs' || doc_type == 'Co_Debtor_Pay_Stubs') {
                formId = 'unassigned_paystub_section_Debtor_Pay_Stubs';
                if (doc_type == 'Co_Debtor_Pay_Stubs') {
                    formId = 'unassigned_paystub_section_Co_Debtor_Pay_Stubs';
                }

                const form = document.getElementById(formId);
                if (!form) {
                    console.error("Form not found for ID:", formId);
                    return;
                }

                const checkboxes = form.querySelectorAll('input[type="checkbox"].checked_docs');
                let selected = Array.from(checkboxes).filter(cb => cb.checked);
                let values = selected.map(cb => cb.value);

                form_data.delete('pdf_id[]');
                values.forEach(value => form_data.append('pdf_id[]', value));
            }

            formId = $(this).attr('id').replace('bulkdelete_', '');
            $.ajax({
                url: action_url,
                type: 'POST',
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 1) {
                        updateUploadedDocsHtml(formId, window.AttorneyDocScriptConfig.clientId);
                        $.systemMessage(response.msg, 'alert--success', true);
                    }
                    if (response.status == 0) {
                        $.systemMessage(response.msg, 'alert--danger', true);
                    }
                },
                error: function(response) {
                    console.log("error", response.status, response.msg);
                }
            });
        });

        // Accept all documents
        $(document).on("click", ".accept_all", function(e) {
            e.preventDefault();
            if (!confirm("Are you sure you want to accept selected documents?")) {
                return;
            }
            $.systemMessage("Updating Status..", 'alert--process');
            var formId = $(this).attr('id').replace('bulkaccept_', '');
            var action_url = $(this).attr('data-url');
            var $form = $("#" + formId);
            $form.attr('action', action_url);

            var formData = new FormData($form[0]);

            $.ajax({
                url: action_url,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 1) {
                        updateUploadedDocsHtml(formId, window.AttorneyDocScriptConfig.clientId);
                        $.systemMessage(response.msg, 'alert--success', true);
                    }
                    if (response.status == 0) {
                        $.systemMessage(response.msg, 'alert--danger', true);
                    }
                },
                error: function(response) {
                    console.log("error", response.status, response.msg);
                }
            });
        });

        // Decline all documents
        $(document).on("click", ".decline_all", function(e) {
            e.preventDefault();
            if (!confirm("Are you sure you want to decline selected documents?")) {
                return;
            }
            $.systemMessage("Updating Status..", 'alert--process');
            var formId = $(this).attr('id').replace('bulkdecline_', '');
            var action_url = $(this).attr('data-url');
            var $form = $("#" + formId);
            $form.attr('action', action_url);

            var formData = new FormData($form[0]);

            $.ajax({
                url: action_url,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 1) {
                        updateUploadedDocsHtml(formId, window.AttorneyDocScriptConfig.clientId);
                        $.systemMessage(response.msg, 'alert--success', true);
                    }
                    if (response.status == 0) {
                        $.systemMessage(response.msg, 'alert--danger', true);
                    }
                },
                error: function(response) {
                    console.log("error", response.status, response.msg);
                }
            });
        });

        // Checkbox change handler
        $(document).on("change", ".checked_docs", function() {
            var class_item = $(this).attr('data-item');
            var isChecked = $(`.checked_docs[data-item="${class_item}"]:checked`).length > 0;

            $("#bulkdelete_" + class_item).toggleClass('hide-data', !isChecked);
            $("#bulkdecline_" + class_item).toggleClass('hide-data', !isChecked);
            $("#bulkaccept_" + class_item).toggleClass('hide-data', !isChecked);

            var unchecked = document.querySelectorAll(`.checked_docs[data-item="${class_item}"]:not(:checked)`);
            var parentCheckbox = document.querySelector(`.parent_${class_item}`);
            if (parentCheckbox) parentCheckbox.checked = unchecked.length === 0;
        });
    }

    // Window resize function
    function resize() {
        if ($(window).width() <= 1440) {
            $('.br_span').html('<br>');
            $('.push_notification').removeClass('ml-4');
            $('.download_section').removeClass('d-flex');
            $('.download_zip').addClass('w-100');
            $('.ios_btn').removeClass('w-150px');
            $('.ios_btn').addClass('w-140px');
            $('.android_btn').removeClass('w-150px');
            $('.android_btn').addClass('w-140px');
        }
        if ($(window).width() > 1440) {
            $('.br_span').html('');
            $('.push_notification').addClass('ml-4');
            $('.download_section').addClass('d-flex');
            $('.download_zip').removeClass('w-100');
            $('.ios_btn').removeClass('w-140px');
            $('.ios_btn').removeClass('w-120px');
            $('.ios_btn').addClass('w-150px');
            $('.android_btn').removeClass('w-140px');
            $('.android_btn').removeClass('w-120px');
            $('.android_btn').addClass('w-150px');
        }
        if ($(window).width() <= 1024) {
            $('.ios_btn').removeClass('w-140px');
            $('.ios_btn').addClass('w-120px');
            $('.android_btn').removeClass('w-140px');
            $('.android_btn').addClass('w-120px');
        }
    }

    // Escape selector function
    function escapeSelector(id) {
        return id.replace(/([ #;&,.+*~':"!^$[\]()=>|\/@])/g, '\\$1');
    }

    // Update uploaded docs HTML
    function updateUploadedDocsHtml(type, client_id, emp_id = '') {
        const startsWithMortgageLoanPropertyValue = type.startsWith('Mortgage_property_value');
        const startsWithCurrentMortgageLoanStatement = type.startsWith('Current_Mortgage_Statement');
        if (startsWithMortgageLoanPropertyValue || startsWithCurrentMortgageLoanStatement) {
            type = getTypeForSecuredTypeDocs(type, morgageLoanStatements);
        }

        const startsWithAutoLoanPropertyValue = type.startsWith('Autoloan_property_value');
        const startsWithCurrentAutoLoanStatement = type.startsWith('Current_Auto_Loan_Statement');
        const startsWithVehicleRegistration = type.startsWith('Vehicle_Registration');
        const startsWithOtherAutoLoanStatement = type.startsWith('Other_Loan_Statement');
        const startsWithValidYear = /^\d{4}/.test(type) && (function() {
            const year = parseInt(type.slice(0, 4), 10);
            return year >= 1900 && year <= new Date().getFullYear() + 1;
        })();

        if (startsWithAutoLoanPropertyValue || startsWithCurrentAutoLoanStatement || 
            startsWithVehicleRegistration || startsWithOtherAutoLoanStatement || startsWithValidYear) {
            type = getTypeForSecuredTypeDocs(type, autoLoanStatements);
        }

        var typeString = type;
        var parentForm = $('.main_form_' + typeString + '#' + typeString);
        var formData = new FormData();
        const parentKey = $('.main_form_' + typeString + '#' + typeString).data('parentkey');
        
        formData.append('isAttorneyDocPage', true);
        formData.append('parentKey', parentKey);
        formData.append('document_type', type);
        formData.append('client_id', client_id);
        if (emp_id) {
            formData.append('employer_id', emp_id);
        }

        const moveToList = window.AttorneyDocScriptConfig.documentMoveToList || [];
        formData.append('documentMoveToList', JSON.stringify(moveToList));

        var ajaxURL = window.AttorneyDocScriptConfig.routes.getUpdatedDocViewHtml;
        $.ajax({
            url: ajaxURL,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 1) {
                    parentForm.html(response.html);
                    initializeSortableContainers();
                    if (response.unassignedDocIds !== '' && response.unassignedDocIds >= 0) {
                        bindUnassignedCollapseHandlers(type, response.unassignedDocIds);
                    }
                }
                if (response.status == 0) {
                    console.log("Response error: ", response.status, response.msg);
                    $.systemMessage(response.msg, 'alert--danger', true);
                }
            },
            error: function(response) {
                console.log("error", response.status, response.msg);
            }
        });
    }

    // Get type for secured type docs
    function getTypeForSecuredTypeDocs(type, securedTypeData) {
        for (const parentKey in securedTypeData) {
            if (securedTypeData.hasOwnProperty(parentKey)) {
                const documentGroup = securedTypeData[parentKey];
                for (const docType in documentGroup) {
                    if (docType === type) {
                        return parentKey;
                    }
                }
            }
        }
        return type;
    }

    // Change trustee function
    function changeTrustee(selectElement, clientId) {
        const selectedOptionValue = selectElement.value;
        if (!selectedOptionValue) return;
        var formData = new FormData();

        formData.append('client_id', window.AttorneyDocScriptConfig.clientId);
        formData.append('trustee_id', selectedOptionValue);
        var ajaxURL = window.AttorneyDocScriptConfig.routes.assignTrustee;
        $.ajax({
            url: ajaxURL,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 1) {
                    const baseUrl = window.AttorneyDocScriptConfig.routes.attorneyClientUploadedDocuments;
                    const url = `${baseUrl}?selected_trustee=${encodeURIComponent(selectedOptionValue)}`;
                    redirectToURL(url);
                }
                if (response.status == 0) {
                    $.systemMessage(response.msg, 'alert--danger', true);
                }
            },
            error: function(response) {
                console.log("error", response.status, response.msg);
            }
        });
    }

    // Open window function
    function openWindow(href) {
        var htmltoload = '<img class="center-loader" alt="loading" style="width:30px;" src="' + 
            window.AttorneyDocScriptConfig.assets.loadingGif + '" /><iframe id="frame" src="' +
            href + '" width="10" height="10"></iframe>';
        laws.updateFaceboxContent(htmltoload, 'local_form_popup');
        setTimeout(function() {
            $.facebox.close();
        }, 4000);
        return false;
    }

    // PDF click handler
    function setupPdfClickHandler() {
        document.addEventListener("click", function(e) {
            if (e.target.closest(".openPdf")) {
                const anchor = e.target.closest(".openPdf");
                let pdfUrl = anchor.getAttribute("data-url");
                document.getElementById("pdfViewer").src = pdfUrl;
                $("#pdfModal").modal("show");
                let docId = anchor.getAttribute("data-docid");
                let documenttype = anchor.getAttribute("data-documenttype");
                let clientId = anchor.getAttribute("data-clientid");
                if (docId && clientId) {
                    var url = window.AttorneyDocScriptConfig.routes.markDocumentSeen;
                    laws.ajax(url, {
                        docId: docId,
                        clientId: clientId
                    }, function(response) {
                        var res = JSON.parse(response);
                        if (res.status == 1) {
                            updateUploadedDocsHtml(documenttype, clientId);
                        }
                    });
                }
            }
        });
    }

    // Enable notification function
    function enableNotification(types, clientId, checkboxElement) {
        const isChecked = checkboxElement.checked;
        if (types == 'email') {
            if (!confirm("Are you sure you want to update Email notification settings?")) {
                checkboxElement.checked = !isChecked;
                return;
            }
        }
        if (types == 'push') {
            if (!confirm("Are you sure you want to update Push notification settings?")) {
                checkboxElement.checked = !isChecked;
                return;
            }
        }
        var document_email_notification = 0;
        if ($('#document_email_notification').prop('checked')) {
            document_email_notification = 1;
        }
        var document_pushed_notification = 0;
        if ($('#document_pushed_notification').prop('checked')) {
            document_pushed_notification = 1;
        }

        var url = window.AttorneyDocScriptConfig.routes.updateNotificationType;
        laws.ajax(url, {
            document_email_notification: document_email_notification,
            document_pushed_notification: document_pushed_notification,
            client_id: clientId
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.href = window.AttorneyDocScriptConfig.routes.attorneyClientUploadedDocumentsWithUser;
                }, 200);
            }
        });
    }

    // Enable post submission function
    function enablePostSub(clientId) {
        if (!confirm("Are you sure you want to update document setting?")) {
            return;
        }

        var post_submission_documents_enabled = 0;
        if ($('#post_submission_documents_enabled').prop('checked')) {
            post_submission_documents_enabled = 1;
        }

        var url = window.AttorneyDocScriptConfig.routes.postSubmissionDocumentsEnabled;
        laws.ajax(url, {
            post_submission_documents_enabled: post_submission_documents_enabled,
            client_id: clientId
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.href = window.AttorneyDocScriptConfig.routes.attorneyClientUploadedDocumentsWithUser;
                }, 200);
            }
        });
    }

    // Change relate to registration function
    function changeRelateToRegistration(registration_id, auto_loan_id, client_id, url) {
        if (registration_id == '') {
            return false;
        }
        laws.ajax(url, {
            client_id: client_id,
            registration_id: registration_id,
            auto_loan_id: auto_loan_id
        }, function(res) {
            var ans = $.parseJSON(res);
            if (ans.status == 1) {
                $.systemMessage(ans.msg, 'alert--success', true);
                setTimeout(function() {
                    location.reload(true);
                }, 800);
            } else {
                $.systemMessage(ans.msg, 'alert--danger', true);
            }
        });
    }

    // Rename document function
    function renameDocument(client_id, id, element, type) {
        var new_date = $(element).find('option:selected').val();
        if (new_date != '') {
            var url = window.AttorneyDocScriptConfig.routes.updateDocDate;
            laws.ajax(url, {
                client_id: client_id,
                doc_id: id,
                new_date: new_date
            }, function(res) {
                var ans = $.parseJSON(res);
                if (ans.status == 1) {
                    var bank_doc_type = window.AttorneyDocScriptConfig.bankDocTypes || [];
                    if (bank_doc_type.includes(type)) {
                        updateFileNameInDB(type, window.AttorneyDocScriptConfig.routes.updateBankNameAfterOrder);
                        $.systemMessage(ans.msg, 'alert--success', true);
                        updateUploadedDocsHtml(type, client_id);
                    }
                    $('#page_loader').hide();
                    $.systemMessage(ans.msg, 'alert--success', true);
                } else {
                    $('#page_loader').hide();
                    $.systemMessage(ans.msg, 'alert--danger', true);
                }
            });
        }
    }

    // Change document type function
    function changeDocType(doc_type, clientId) {
        var download_support_format = 0;
        if (doc_type == 'png') {
            if (!confirm("Are you sure you want to keep PNG format?")) {
                return;
            }
        }
        if (doc_type == 'pdf') {
            var download_support_format = 1;
            if (!confirm("Are you sure you want to convert into PDF format?")) {
                return;
            }
        }
        var url = window.AttorneyDocScriptConfig.routes.clientDocDownloadFormat;
        laws.ajax(url, {
            download_support_format: download_support_format,
            client_id: clientId
        }, function(response) {});
    }

    // Edit document name function
    function edit_doc_name(id) {
        if ($(".edit_doc_name_input_" + id).hasClass("form-control-none") == true) {
            $(".edit_doc_name_" + id).removeClass('d-flex');
            $(".edit_doc_name_div_" + id).removeClass('d-none');
            $(".edit_doc_name_input_" + id).removeClass('form-control-none');
            $(".edit_doc_name_input_" + id).removeClass('d-none');
            $(".edit_doc_name_input_" + id).addClass('form-control');
            $(".edit_doc_name_input_" + id).addClass('mr-2');
            $(".edit_doc_name_input_" + id).addClass('form-control-custom-padding');
            $(".edit_doc_name_input_" + id).attr('readonly', false);
            $(".edit_doc_name_" + id).addClass('d-none');
            $(".edit_doc_name_" + id).removeClass('d-inline-grid-mobile');
            $(".edit_doc_name_submit_" + id).removeClass('d-none');
            $(".edit_doc_name_submit_" + id).addClass('pt-2');
            $(".edit_doc_name_label_" + id).addClass('pt-1');
            $(".edit_doc_name_btn_" + id).addClass('d-none');
        }
    }

    // Update document function
    function update_doc_fn(id, document_type, prev_name, client_id, document_file = '') {
        var url = window.AttorneyDocScriptConfig.routes.updateDocName;
        var new_name = $(".edit_doc_name_input_" + id).val();
        if (prev_name == new_name) {
            updateclasses(id);
            return;
        }

        if (!confirm("Are you sure you want to update document name?")) {
            return;
        }

        $.systemMessage("Updating Status..", 'alert--process');
        laws.ajax(url, {
            client_id: client_id,
            doc_id: id,
            new_name: new_name,
            document_file: document_file
        }, function(res) {
            var ans = $.parseJSON(res);
            if (ans.status == 1) {
                updateUploadedDocsHtml(document_type, client_id);
                $.systemMessage(ans.msg, 'alert--success', true);
            } else {
                $.systemMessage(ans.msg, 'alert--danger', true);
            }
        });
    }

    // Move document to function
    function move_this_document_to(element) {
        const parentDiv = element.closest('.dropdown-menu');
        if (!parentDiv) return;

        const doc_id = parentDiv.getAttribute('data-doc_id');
        const client_id = parentDiv.getAttribute('data-client_id');
        const prev_selected_value = parentDiv.getAttribute('data-prev_selected_value');
        let pay_date = parentDiv.getAttribute('data-pay_date');
        const select_employer_id = parentDiv.getAttribute('data-select_employer_id');

        var url = window.AttorneyDocScriptConfig.routes.moveDocumentTo;
        var new_selected_value = $(element).data('value');
        var new_doc_name = $(element).html();
        var emp_id = '';

        if (new_selected_value === 'Debtor_Pay_Stubs' || new_selected_value === 'Co_Debtor_Pay_Stubs') {
            emp_id = $(element).data('empid');

            let payDates = window.AttorneyDocScriptConfig.payDates || {};

            $('#payDateSelect').html(payDates[emp_id] || "<option value=''>Select Pay Date</option>");
            $('#payDateInput').val('');
            $('#payDateError').hide();

            let payDateModal = new bootstrap.Modal(document.getElementById('payDateModal'));
            payDateModal.show();

            $('#submitPayDate').off('click').on('click', function() {
                let selected = $('#payDateSelect').val().trim();
                let input = selected !== '' ? selected : $('#payDateInput').val().trim();

                if (!input) {
                    $('#payDateError').text("Pay date is required.").show();
                    return;
                }

                if (!isValidMMDDYYYY(input)) {
                    $('#payDateError').text("Invalid format. Use MM/DD/YYYY.").show();
                    return;
                }

                let parts = input.split('/');
                let enteredDate = new Date(parseInt(parts[2]), parseInt(parts[0]) - 1, parseInt(parts[1]));

                let today = new Date();
                let eightMonthsAgo = new Date();
                eightMonthsAgo.setMonth(today.getMonth() - 8);
                let eightMonthsLater = new Date();
                eightMonthsLater.setMonth(today.getMonth() + 8);

                if (enteredDate < eightMonthsAgo || enteredDate > eightMonthsLater) {
                    $('#payDateError').text("Pay date must be within 8 months before or after today.").show();
                    return;
                }
                payDateModal.hide();
                pay_date = input.replace(/\//g, '.');
                
                $('#page_loader').show();
                laws.ajax(url, {
                    client_id: client_id,
                    doc_id: doc_id,
                    new_selected_value: new_selected_value,
                    pre_document_type: prev_selected_value,
                    emp_id: emp_id,
                    pay_date: pay_date
                }, function(res) {
                    var ans = $.parseJSON(res);
                    $('#page_loader').hide();
                    if (ans.status == 1) {
                        $.systemMessage(ans.msg, 'alert--success', true);
                        updateUploadedDocsHtml(prev_selected_value, client_id, select_employer_id);
                        updateUploadedDocsHtml(new_selected_value, client_id, emp_id);
                    } else {
                        $.systemMessage(ans.msg, 'alert--danger', true);
                    }
                });
            });

            return;
        }

        showConfirmation("Are you sure you want to move document to " + new_doc_name + "?", function(confirmed) {
            if (!confirmed) {
                return;
            }

            $('#page_loader').show();
            laws.ajax(url, {
                client_id: client_id,
                doc_id: doc_id,
                new_selected_value: new_selected_value,
                pre_document_type: prev_selected_value,
                emp_id: emp_id,
                select_employer_id: select_employer_id,
                pay_date: pay_date
            }, function(res) {
                var ans = $.parseJSON(res);
                $('#page_loader').hide();
                if (ans.status == 1) {
                    $.systemMessage(ans.msg, 'alert--success', true);
                    updateUploadedDocsHtml(prev_selected_value, client_id, select_employer_id);
                    updateUploadedDocsHtml(new_selected_value, client_id, emp_id);
                } else {
                    $.systemMessage(ans.msg, 'alert--danger', true);
                }
            });
        });
    }

    // Check zip progress function
    function checkZipProgress(client_id) {
        var url = window.AttorneyDocScriptConfig.routes.checkZipStatus;
        laws.ajax(url, {
            client_id: client_id
        }, function(res) {
            var ans = $.parseJSON(res);
            if (ans.status == 1) {
                if (ans.data.completion_percentage == 100) {
                    setTimeout(function() {
                        location.reload(true);
                    }, 800);
                } else {
                    if (ans.data.completion_percentage > 0) {
                        $('.progress-sm').removeClass('hide-data');
                        $('.progress-sm').html(
                            '<div class="progress-bar" role="progressbar" style="width: ' + ans.data.completion_percentage + '" aria-valuenow="' + ans.data.completion_percentage + '" aria-valuemin="0" aria-valuemax="100"></div>');
                    }
                }
            }
        });
    }

    // Validate MM/DD/YYYY format
    function isValidMMDDYYYY(dateString) {
        const regex = /^(0[1-9]|1[0-2])\/(0[1-9]|[12]\d|3[01])\/\d{4}$/;
        if (!regex.test(dateString)) {
            return false;
        }

        const parts = dateString.split('/');
        const month = parseInt(parts[0], 10);
        const day = parseInt(parts[1], 10);
        const year = parseInt(parts[2], 10);

        const date = new Date(year, month - 1, day);

        return (
            date.getFullYear() === year &&
            date.getMonth() === month - 1 &&
            date.getDate() === day
        );
    }

    // Update creditors to doc function
    function update_creditors_to_doc(doc_id, prev_selected_value, client_id) {
        var url = window.AttorneyDocScriptConfig.routes.updateCreditorsToDoc;
        var new_selected_value = $('.document_creditor_' + doc_id).val();
        if (prev_selected_value == new_selected_value) {
            return;
        }

        showConfirmation("Are you sure you want to update Creditor?", function(confirmation) {
            if (confirmation) {
                $.systemMessage('Processing..', 'alert--process', true);
                laws.ajax(url, {
                    client_id: client_id,
                    doc_id: doc_id,
                    new_selected_value: new_selected_value
                }, function(res) {
                    var ans = $.parseJSON(res);
                    if (ans.status == 1) {
                        $(`.document_creditor_${doc_id}`).addClass(`d-none`);
                        let creditorType = new_selected_value.replace(/_/g, ' ');
                        let creditorName = $('.document_creditor_' + doc_id + ' option:selected').text();
                        let relatedToHtml = `
                            <span class="text-center w-100">Related to ${creditorType}: ${creditorName}</span>
                            <i onclick="edit_creditors_to_doc('${doc_id}')" class="fas fa-pencil-square-o edit ms-1 related_section_${doc_id}"></i>
                        `;
                        $(`.related_section_${doc_id}`).removeClass(`d-none`).html(relatedToHtml);
                        $.systemMessage(ans.msg, 'alert--success', true);
                    } else {
                        $.systemMessage(ans.msg, 'alert--danger', true);
                    }
                });
            }
        });
    }

    // Edit creditors to doc function
    function edit_creditors_to_doc(id) {
        if ($(".document_creditor_" + id).hasClass("d-none") == true) {
            $(".document_creditor_" + id).removeClass("d-none");
            $(".related_section_" + id).addClass('d-none');
        }
    }

    // Update classes function
    function updateclasses(id) {
        $(".edit_doc_name_input_" + id).removeClass('form-control');
        $(".edit_doc_name_input_" + id).removeClass('mr-2');
        $(".edit_doc_name_input_" + id).removeClass('form-control-custom-padding');
        $(".edit_doc_name_" + id).removeClass('d-none');
        $(".edit_doc_name_submit_" + id).removeClass('pt-2');
        $(".edit_doc_name_label_" + id).removeClass('pt-1');
        $(".edit_doc_name_input_" + id).addClass('form-control-none');
        $(".edit_doc_name_submit_" + id).addClass('d-none');
        $(".edit_doc_name_div_" + id).addClass('d-none');
        $(".edit_doc_name_input_" + id).attr('readonly', true);
        $(".edit_doc_name_btn_" + id).removeClass('d-none');
    }

    // Copy function
    function copy() {
        var copyText = $("#copy_url");
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(copyText).text()).select();
        document.execCommand("copy");
        $temp.remove();
        $.systemMessage("Client Document Upload Link copied. ", 'alert--success', true);
    }

    // Initialize sortable containers
    function initializeSortableContainers() {
        $(".sortable-container").each(function() {
            const $container = $(this);

            if ($container.hasClass("ui-sortable")) {
                $container.sortable("destroy");
            }

            $container.sortable({
                handle: ".dragHandle",
                items: ".sortable-item",
                placeholder: "sortable-placeholder",
                forcePlaceholderSize: true,

                update: function(event, ui) {
                    const container = $(this);
                    const containerId = container.attr("id") || "";

                    if (!containerId.startsWith("common_doc_section_")) return;

                    const elem = containerId.replace("common_doc_section_", "");
                    const orderedIds = container.sortable("toArray");

                    const formData = new FormData();
                    orderedIds.forEach(id => {
                        formData.append(`${elem}[]`, id);
                    });

                    $.ajax({
                        url: window.AttorneyDocScriptConfig.routes.saveDocumentOrder,
                        method: "POST",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.status == 1) {
                                const documentTypes = ['Last_Year_Tax_Returns', 'Prior_Year_Tax_Returns', 'Prior_Year_Two_Tax_Returns', 'Prior_Year_Three_Tax_Returns'];
                                const bank_doc_type = window.AttorneyDocScriptConfig.bankDocTypes || [];

                                if (documentTypes.includes(elem)) {
                                    updateFileNameInDB(elem, window.AttorneyDocScriptConfig.routes.updateTaxNameAfterOrder);
                                    $.systemMessage(res.msg, 'alert--success', true);
                                    setTimeout(() => location.reload(true), 1500);
                                }

                                if (bank_doc_type.includes(elem)) {
                                    updateFileNameInDB(elem, window.AttorneyDocScriptConfig.routes.updateBankNameAfterOrder);
                                }

                                $.systemMessage(res.msg, 'alert--success', true);
                            } else {
                                $.systemMessage(res.msg, 'alert--danger', true);
                            }
                        },
                        error: function() {
                            $.systemMessage("Something went wrong with the request.", 'alert--danger', true);
                        }
                    });
                }
            });
        });
    }

    // Update file name in DB
    function updateFileNameInDB(type, url) {
        var client_id = window.AttorneyDocScriptConfig.clientId;
        var attorney_id = window.AttorneyDocScriptConfig.userId;

        laws.ajax(url, {
            client_id: client_id,
            attorney_id: attorney_id,
            type: type
        }, function(res) {});
    }

    // Pay check popup function
    function payCheckPopup(client_id, client_type = null) {
        ajaxurl = window.AttorneyDocScriptConfig.routes.payCheckCalculation;
        laws.ajax(ajaxurl, {
            client_id: client_id,
            client_type: client_type
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width');
        });
    }

    // Remove from not own function
    function rmeoveFromNotOwn(client_id, document_type) {
        if (!confirm("Are you sure you want to mark it yes?")) {
            return;
        }
        var url = window.AttorneyDocScriptConfig.routes.markOwnDocument;
        laws.ajax(url, {
            client_id: client_id,
            document_type: document_type
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.reload();
                }, 200);
            }
        });
    }

    // Decline document popup function
    function declineDocumentPopUp(key, url, dstatus, clientId, ele, file_url, doc_id = 0, label = 'Decline') {
        laws.ajax(url, {
            document_type: key,
            document_status: dstatus,
            client_id: clientId,
            file_url: file_url,
            doc_id: doc_id,
            label: label
        }, function(response) {
            $(ele).parent().parent().addClass("ready-for-not-uploaded");
            $(ele).addClass("append_decline_text");
            laws.updateFaceboxContent(response, 'medium-fb-width');
        });
    }

    // Open documents list popup function
    function openDocumentsListPopup(client_id) {
        var ajaxurl = window.AttorneyDocScriptConfig.routes.nonConciergeDocumentsListPopup;
        laws.ajax(ajaxurl, {
            client_id: client_id
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width');
        });
    }

    // Check child checkboxes function
    function checkChildCheckboxes(parentCheckbox, documentType, employerId = 0) {
        const isChecked = parentCheckbox.checked;
        let childCheckboxes;

        if (employerId > 0) {
            childCheckboxes = document.querySelectorAll(`.checked_docs[data-item="${employerId}_${documentType}"]`);
        } else {
            childCheckboxes = document.querySelectorAll(`.checked_docs[data-item="${documentType}"]`);
        }

        childCheckboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
        });

        $.each(["#bulkdelete_", "#bulkdecline_", "#bulkaccept_"], function(index, item) {
            var button = $(document).find(item + documentType);
            if (employerId != 0) {
                var button = $(document).find(item + employerId + '_' + documentType);
            }
            if (isChecked) {
                button.removeClass('hide-data');
            } else {
                button.addClass('hide-data');
            }
        });
    }

    // Create post submission form function
    function createPostSubmissionForm(documentType, clientId) {
        var targetSection = $('h3:contains("Debtor(s) ID Information")').closest('.col-12');
        
        if (targetSection.length === 0) {
            console.warn('Target section not found');
            return;
        }
        
        var baseUrl = window.AttorneyDocScriptConfig.routes.combineAndDownloadTaxReturn;
        var formAction = baseUrl.replace('CLIENT_ID', clientId).replace('DOC_TYPE', documentType);
        
        var formHtml = `
            <div class="col-12">
                <form id="${documentType}" class="main_form_${documentType}" data-parentKey="Post_submission_documents"
                    action="${formAction}"
                    method="GET">
                </form>
            </div>
        `;
        
        $(formHtml).insertBefore(targetSection);
    }

    // Save post submission doc function
    function savePostSubmissionDoc() {
        var docName = $('.save-post-submission-input').val().trim();

        if (!docName) {
            $.systemMessage('Please enter a document name', 'alert--danger', true);
            return;
        }

        showConfirmation('Are you sure you want to add "' + docName + '" as a Post Submission Document?', function(confirmation) {
            if (confirmation) {
                $.systemMessage('Adding Post Submission Document...', 'alert--process');

                var url = window.AttorneyDocScriptConfig.routes.postSubmissionDocumentAdd;
                var clientId = window.AttorneyDocScriptConfig.clientId;

                laws.ajax(url, {
                    client_id: clientId,
                    document_name: docName
                }, function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 1) {
                        $.systemMessage(res.msg, 'alert--success', true);
                        $('.save-post-submission-input').val('');
                        createPostSubmissionForm(res.document_type, clientId);
                        updateUploadedDocsHtml(res.document_type, clientId);
                    } else {
                        $.systemMessage(res.msg, 'alert--danger', true);
                    }
                });
            }
        });
    }

    // Open choose post submission modal function
    function openChoosePostSubmissionModal() {
        $('#choosePostSubmissionModal').modal('show');
    }

    // Setup table drag and drop
    function setupTableDragAndDrop() {
        $('#pageList_Other_Misc_Documents').tableDnD({
            onDrop: function(table, row) {
                var order = $.tableDnD.serialize('id');
                laws.ajax(window.AttorneyDocScriptConfig.routes.saveDocumentOrder, order, function(res) {
                    var ans = $.parseJSON(res);
                    if (ans.status == 1) {
                        $.systemMessage(ans.msg, 'alert--success', true);
                    } else {
                        $.systemMessage(ans.msg, 'alert--danger', true);
                    }
                });
            },
            dragHandle: ".dragHandle",
        });

        $('#pageList_Miscellaneous_Documents').tableDnD({
            onDrop: function(table, row) {
                var order = $.tableDnD.serialize('id');
                laws.ajax(window.AttorneyDocScriptConfig.routes.saveDocumentOrder, order, function(res) {
                    var ans = $.parseJSON(res);
                    if (ans.status == 1) {
                        $.systemMessage(ans.msg, 'alert--success', true);
                    } else {
                        $.systemMessage(ans.msg, 'alert--danger', true);
                    }
                });
            },
            dragHandle: ".dragHandle",
        });

        $(".uploaded_documents_pagelist").each(function() {
            const elem = $(this).attr('id').split('pageList_')[1];
            $('#pageList_' + elem).tableDnD({
                onDrop: function(table, row) {
                    var order = $.tableDnD.serialize('id');
                    laws.ajax(window.AttorneyDocScriptConfig.routes.saveDocumentOrder, order, function(res) {
                        var ans = $.parseJSON(res);
                        if (ans.status == 1) {
                            let documentTypes = ['Last_Year_Tax_Returns', 'Prior_Year_Tax_Returns', 'Prior_Year_Two_Tax_Returns', 'Prior_Year_Three_Tax_Returns'];
                            if (documentTypes.includes(elem)) {
                                updateFileNameInDB(elem, window.AttorneyDocScriptConfig.routes.updateTaxNameAfterOrder);
                                $.systemMessage(ans.msg, 'alert--success', true);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1500);
                            }
                            var bank_doc_type = window.AttorneyDocScriptConfig.bankDocTypes || [];
                            if (bank_doc_type.includes(elem)) {
                                updateFileNameInDB(elem, window.AttorneyDocScriptConfig.routes.updateBankNameAfterOrder);
                            }
                            $.systemMessage(ans.msg, 'alert--success', true);
                        } else {
                            $.systemMessage(ans.msg, 'alert--danger', true);
                        }
                    });
                },
                dragHandle: ".dragHandle",
            });
        });
    }

    // Public API
    return {
        init: init,
        updateUploadedDocsHtml: updateUploadedDocsHtml,
        changeTrustee: changeTrustee,
        openWindow: openWindow,
        enableNotification: enableNotification,
        enablePostSub: enablePostSub,
        changeRelateToRegistration: changeRelateToRegistration,
        renameDocument: renameDocument,
        changeDocType: changeDocType,
        edit_doc_name: edit_doc_name,
        update_doc_fn: update_doc_fn,
        move_this_document_to: move_this_document_to,
        checkZipProgress: checkZipProgress,
        isValidMMDDYYYY: isValidMMDDYYYY,
        update_creditors_to_doc: update_creditors_to_doc,
        edit_creditors_to_doc: edit_creditors_to_doc,
        updateclasses: updateclasses,
        copy: copy,
        initializeSortableContainers: initializeSortableContainers,
        updateFileNameInDB: updateFileNameInDB,
        payCheckPopup: payCheckPopup,
        rmeoveFromNotOwn: rmeoveFromNotOwn,
        declineDocumentPopUp: declineDocumentPopUp,
        openDocumentsListPopup: openDocumentsListPopup,
        checkChildCheckboxes: checkChildCheckboxes,
        createPostSubmissionForm: createPostSubmissionForm,
        savePostSubmissionDoc: savePostSubmissionDoc,
        openChoosePostSubmissionModal: openChoosePostSubmissionModal,
        setupTableDragAndDrop: setupTableDragAndDrop,
        setupPdfClickHandler: setupPdfClickHandler
    };
})();

// Initialize when DOM is ready
$(document).ready(function() {
    window.BK.AttorneyDocScript.init();
    window.BK.AttorneyDocScript.setupPdfClickHandler();
    window.BK.AttorneyDocScript.setupTableDragAndDrop();
});

// Expose functions globally for backward compatibility
window.updateUploadedDocsHtml = window.BK.AttorneyDocScript.updateUploadedDocsHtml;
window.changeTrustee = window.BK.AttorneyDocScript.changeTrustee;
window.openWindow = window.BK.AttorneyDocScript.openWindow;
window.enableNotification = window.BK.AttorneyDocScript.enableNotification;
window.enablePostSub = window.BK.AttorneyDocScript.enablePostSub;
window.changeRelateToRegistration = window.BK.AttorneyDocScript.changeRelateToRegistration;
window.renameDocument = window.BK.AttorneyDocScript.renameDocument;
window.changeDocType = window.BK.AttorneyDocScript.changeDocType;
window.edit_doc_name = window.BK.AttorneyDocScript.edit_doc_name;
window.update_doc_fn = window.BK.AttorneyDocScript.update_doc_fn;
window.move_this_document_to = window.BK.AttorneyDocScript.move_this_document_to;
window.checkZipProgress = window.BK.AttorneyDocScript.checkZipProgress;
window.isValidMMDDYYYY = window.BK.AttorneyDocScript.isValidMMDDYYYY;
window.update_creditors_to_doc = window.BK.AttorneyDocScript.update_creditors_to_doc;
window.edit_creditors_to_doc = window.BK.AttorneyDocScript.edit_creditors_to_doc;
window.updateclasses = window.BK.AttorneyDocScript.updateclasses;
window.copy = window.BK.AttorneyDocScript.copy;
window.initializeSortableContainers = window.BK.AttorneyDocScript.initializeSortableContainers;
window.updateFileNameInDB = window.BK.AttorneyDocScript.updateFileNameInDB;
window.payCheckPopup = window.BK.AttorneyDocScript.payCheckPopup;
window.rmeoveFromNotOwn = window.BK.AttorneyDocScript.rmeoveFromNotOwn;
window.declineDocumentPopUp = window.BK.AttorneyDocScript.declineDocumentPopUp;
window.openDocumentsListPopup = window.BK.AttorneyDocScript.openDocumentsListPopup;
window.checkChildCheckboxes = window.BK.AttorneyDocScript.checkChildCheckboxes;
window.createPostSubmissionForm = window.BK.AttorneyDocScript.createPostSubmissionForm;
window.savePostSubmissionDoc = window.BK.AttorneyDocScript.savePostSubmissionDoc;
window.openChoosePostSubmissionModal = window.BK.AttorneyDocScript.openChoosePostSubmissionModal;
