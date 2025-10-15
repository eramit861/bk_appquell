/**
 * Client Management Manager
 * Handles all functionality for client management operations
 * 
 * @author BK Assistant
 * @version 1.0.0
 */

class ClientManagementManager {
    constructor(config) {
        this.config = config;
        this.routes = config.routes || {};
        this.jsonClientData = config.jsonClientData || {};
        this.clientIds = config.clientIds || [];
        this.langLbl = config.langLbl || {};
        
        this.init();
    }

    /**
     * Initialize the client management manager
     */
    init() {
        this.hidePageLoader();
        this.processClientData();
        this.bindEvents();
        this.initializeToggleButtons();
    }

    /**
     * Hide page loader
     */
    hidePageLoader() {
        $('#page_loader').hide();
    }

    /**
     * Process client data and apply styling
     */
    processClientData() {
        let classesNoConsider = [];

        if (this.jsonClientData) {
            $.each(this.jsonClientData, (className, html) => {
                $.each(this.clientIds, (index, clientid) => {
                    if (
                        className === 'client-' + clientid ||
                        className === 'clandely_msg-' + clientid ||
                        className === 'event_color_class-' + clientid
                    ) {
                        if (className === 'clandely_msg-' + clientid) {
                            $('.' + className).html(html);
                        } else {
                            $('.' + className).addClass(html);
                        }

                        classesNoConsider.push(className);
                    }
                });

                if (className === 'unreadMsg' && html !== '') {
                    $('.noti_count').removeClass('hide-data');
                    $('.noti_count').html(html);
                }

                if (!classesNoConsider.includes(className) && className !== 'unreadMsg') {
                    $('.' + className).html(html);
                }
            });
        }

        // Add cursor styling for stopPropagation elements
        document.querySelectorAll('#clientTabsContent .client-card *').forEach(el => {
            const onclickCode = el.getAttribute('onclick');
            if (onclickCode && onclickCode.includes('stopPropagation')) {
                el.classList.add('stop-prop-cursor');
            }
        });
    }

    /**
     * Bind all event handlers
     */
    bindEvents() {
        // Form submission handlers
        $(document).on('change', '#per_page, #filter_paralegal, #filter_associate', (e) => {
            document.getElementById('paginationForm').submit();
        });

        // Search form submission
        $(document).on('click', '.input-group-prepend', (e) => {
            document.getElementById('searchForm').submit();
        });

        // Tab navigation handlers
        $(document).on('click', '[onclick*="redirectToURL"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const urlMatch = onclick.match(/redirectToURL\('([^']+)'\)/);
            if (urlMatch) {
                window.location.href = urlMatch[1];
            }
        });

        // Modal handlers
        $(document).on('click', '[onclick*="edit_client"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/edit_client\(this,\s*(\d+),\s*(\d+)\)/);
            if (matches) {
                this.editClient(e.target, matches[1], matches[2]);
            }
        });

        $(document).on('click', '[onclick*="request_msg_modal"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/request_msg_modal\(this,\s*(\d+)\)/);
            if (matches) {
                this.requestMsgModal(e.target, matches[1]);
            }
        });

        $(document).on('click', '[onclick*="file_upload_modal"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/file_upload_modal\((\d+)\)/);
            if (matches) {
                this.fileUploadModal(matches[1]);
            }
        });

        $(document).on('click', '[onclick*="report_edit_modal"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/report_edit_modal\((\d+)\)/);
            if (matches) {
                this.reportEditModal(matches[1]);
            }
        });

        // Info editing handlers
        $(document).on('click', '[onclick*="editClienInfo"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/editClienInfo\((\d+),\s*'([^']+)'\)/);
            if (matches) {
                this.editClientInfo(matches[1], matches[2]);
            }
        });

        $(document).on('click', '[onclick*="updateInfoFn"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/updateInfoFn\(this,\s*'([^']+)',\s*(\d+),\s*'([^']*)'\)/);
            if (matches) {
                this.updateInfoFn(e.target, matches[1], matches[2], matches[3]);
            }
        });

        $(document).on('click', '[onclick*="updateSelectInfoFn"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/updateSelectInfoFn\(this,\s*'([^']+)',\s*(\d+),\s*'([^']*)',\s*'([^']*)'\)/);
            if (matches) {
                this.updateSelectInfoFn(e.target, matches[1], matches[2], matches[3], matches[4]);
            }
        });

        // Property detail handlers
        $(document).on('click', '[onclick*="addDetailProperty"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/addDetailProperty\(this,\s*(\d+)\)/);
            if (matches) {
                this.addDetailProperty(e.target, matches[1]);
            }
        });

        // Popup handlers
        $(document).on('click', '[onclick*="openDocumentsListPopup"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/openDocumentsListPopup\((\d+)\)/);
            if (matches) {
                this.openDocumentsListPopup(matches[1]);
            }
        });

        $(document).on('click', '[onclick*="resendAppointmentReminder"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/resendAppointmentReminder\((\d+)\)/);
            if (matches) {
                this.resendAppointmentReminder(matches[1]);
            }
        });

        $(document).on('click', '[onclick*="getSimpleTextMessages"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/getSimpleTextMessages\((\d+)\)/);
            if (matches) {
                this.getSimpleTextMessages(matches[1]);
            }
        });

        $(document).on('click', '[onclick*="openEditRequestPopup"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/openEditRequestPopup\((\d+)\)/);
            if (matches) {
                this.openEditRequestPopup(matches[1]);
            }
        });

        $(document).on('click', '[onclick*="showSubscriptionAddon"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/showSubscriptionAddon\((\d+)\)/);
            if (matches) {
                this.showSubscriptionAddon(matches[1]);
            }
        });

        $(document).on('click', '[onclick*="clientPasswordReset"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/clientPasswordReset\((\d+)\)/);
            if (matches) {
                this.clientPasswordReset(matches[1]);
            }
        });

        $(document).on('click', '[onclick*="sendParalegalInfoToClient"]', (e) => {
            e.preventDefault();
            const onclick = e.target.getAttribute('onclick');
            const matches = onclick.match(/sendParalegalInfoToClient\((\d+),\s*(\d+),\s*'([^']+)'\)/);
            if (matches) {
                this.sendParalegalInfoToClient(matches[1], matches[2], matches[3]);
            }
        });
    }

    /**
     * Initialize toggle buttons for details
     */
    initializeToggleButtons() {
        const toggleButtons = document.querySelectorAll('.toggle-details-btn');

        toggleButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const targetSelector = btn.getAttribute('data-target');
                const target = document.querySelector(targetSelector);

                if (target) {
                    const isCollapsed = target.classList.contains('collapsed');
                    target.classList.toggle('collapsed');

                    // Change button text/icon
                    btn.innerHTML = isCollapsed ?
                        '<small>Hide Details <i class="bi bi-caret-up-fill"></i></small>' :
                        '<small>View Details <i class="bi bi-caret-down-fill"></i></small>';
                }
            });
        });
    }

    /**
     * Edit client modal
     */
    editClient(obj, id, ctype) {
        const mainParent = $(obj).parents(".unread");
        const clientName = $(mainParent).find('td:eq(0)>span').text();
        const clientEmail = $(mainParent).find('td:eq(1)>span').text();
        
        $("#client_id").val(id);
        $("#client_type").val(ctype);
        $("#client_name").val(clientName);
        $("#client_email").val(clientEmail);
        
        if ($("#retainer_agreement_box" + id).val() == "1") {
            $("#retainer_agreement_box").prop("checked", true);
        } else {
            $("#retainer_agreement_box").prop("checked", false);
        }
        
        $("#edit_client").modal('show');
    }

    /**
     * Request message modal
     */
    requestMsgModal(obj, id) {
        $("#request_msg_modal").find("#client_id").val(id);
        $("#request_msg_modal").modal('show');
    }

    /**
     * File upload modal
     */
    fileUploadModal(clientId) {
        $("#image_document_upload_modal").find("#client_id").val(clientId);
        $("#image_document_upload_modal").modal('show');
    }

    /**
     * Report edit modal
     */
    reportEditModal(clientId) {
        $("#report_edit_modal").find("#client_id").val(clientId);
        $("#report_edit_modal").modal('show');
    }

    /**
     * Get client type options
     */
    getOptions(selectClass, clientTypeId, packageId) {
        const url = this.routes.getClientTypeOption || '';
        this.makeAjaxRequest(url, {
            client_type_id: clientTypeId,
            package_id: packageId
        }, (response) => {
            const res = JSON.parse(response);
            if (res.status == 1) {
                let options = "<option value=''>Choose Client Type</option>";
                options += res.selections;
                $(selectClass).html(options);
            }
        });
    }

    /**
     * Get paralegal options
     */
    getParalegalOptions(selectClass, selectedParalegal) {
        const url = this.routes.getParalegalOption || '';
        this.makeAjaxRequest(url, {
            selectedParalegal: selectedParalegal
        }, (response) => {
            const res = JSON.parse(response);
            if (res.status == 1) {
                let options = "<option value=''>Choose paralegal</option>";
                options += res.selections;
                $(selectClass).html(options);
            }
        });
    }

    /**
     * Update select classes
     */
    updateSelectClasses(id) {
        $(`.edit_client_type_input_${id}`).addClass('form-control-none w-auto border-unset no-arrow p-0');
        $(`.edit_client_type_input_${id}`).removeClass('form-control form-control-custom-padding');
        $(`.edit_client_type_input_${id}`).attr('disabled', true);
        $(`.edit_client_type_edit_${id}`).removeClass('d-none');
        $(`.edit_client_type_submit_${id}`).addClass('d-none');
    }

    /**
     * Update paralegal select classes
     */
    updateParalegalSelectClasses(id) {
        $(`.edit_paralegal_input_${id}`).addClass('form-control-none w-auto border-unset no-arrow p-0');
        $(`.edit_paralegal_input_${id}`).removeClass('form-control form-control-custom-padding');
        $(`.edit_paralegal_input_${id}`).attr('disabled', true);
        $(`.edit_paralegal_edit_${id}`).removeClass('d-none');
        $(`.edit_paralegal_submit_${id}`).addClass('d-none');
    }

    /**
     * Edit client info
     */
    editClientInfo(clientId, infoFor) {
        document.querySelector(`#client-${infoFor}-wrapper-${clientId} .client-${infoFor}.datalabel`).classList.add('d-none');
        const input = document.getElementById(`edit-input-${infoFor}-${clientId}`);
        input.classList.remove('d-none');
        input.focus();
        document.getElementById(`save-btn-${infoFor}-${clientId}`).classList.remove('d-none');
        document.getElementById(`edit-btn-${infoFor}-${clientId}`).classList.add('d-none');
    }

    /**
     * Update info function
     */
    updateInfoFn(element, infoFor, clientId, prevInput) {
        const newInput = $(`#edit-input-${infoFor}-${clientId}`).val();
        const nameEl = document.querySelector(`#client-${infoFor}-wrapper-${clientId} .client-${infoFor}.datalabel`);
        const inputEl = document.getElementById(`edit-input-${infoFor}-${clientId}`);
        const saveBtn = document.getElementById(`save-btn-${infoFor}-${clientId}`);
        const editBtn = document.getElementById(`edit-btn-${infoFor}-${clientId}`);

        if (newInput === "") {
            $(`#edit-input-${infoFor}-${clientId}`).focus();
            let errorMsg = this.capitalizeWords(infoFor) + " cannot be empty!";
            if (infoFor == 'phone') {
                errorMsg = "Phone number cannot be empty!";
            }
            $.systemMessage(errorMsg, 'alert--danger', true);
            return;
        }

        if (prevInput == newInput) {
            nameEl.classList.remove('d-none');
            inputEl.classList.add('d-none');
            saveBtn.classList.add('d-none');
            editBtn.classList.remove('d-none');
            return;
        }

        if (infoFor == 'name') {
            this.showConfirmation(this.langLbl.confirmNameUpdate || 'Do you want to update name?', (confirmed) => {
                if (confirmed) {
                    this.updateName(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn);
                }
            });
        }

        if (infoFor == 'email') {
            const eStatus = this.validateEmail(newInput);
            if (!eStatus) {
                $(`#edit-input-${infoFor}-${clientId}`).focus();
                $.systemMessage('Please enter a valid email address.', 'alert--danger', true);
                return;
            }

            this.showConfirmation(this.langLbl.confirmEmailUpdate || 'Do you want to update email?', (confirmed) => {
                if (confirmed) {
                    this.updateEmail(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn);
                }
            });
        }

        if (infoFor == 'phone') {
            const pStatus = this.validatePhone(newInput);
            if (!pStatus) {
                $(`#edit-input-${infoFor}-${clientId}`).focus();
                $.systemMessage('Please enter a valid phone no.', 'alert--danger', true);
                return;
            }

            this.showConfirmation('Do you want to update phone number?', (confirmed) => {
                if (confirmed) {
                    this.updatePhone(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn);
                }
            });
        }
    }

    /**
     * Update select info function
     */
    updateSelectInfoFn(element, infoFor, clientId, prevInput, subsId = '') {
        const newInput = $(`#edit-input-${infoFor}-${clientId}`).val();
        const selectedOptionHtml = $(`#edit-input-${infoFor}-${clientId}`).find('option:selected').html();

        const nameEl = document.querySelector(`#client-${infoFor}-wrapper-${clientId} .client-${infoFor}.datalabel`);
        const inputEl = document.getElementById(`edit-input-${infoFor}-${clientId}`);
        const saveBtn = document.getElementById(`save-btn-${infoFor}-${clientId}`);
        const editBtn = document.getElementById(`edit-btn-${infoFor}-${clientId}`);

        if (prevInput == newInput) {
            nameEl.classList.remove('d-none');
            inputEl.classList.add('d-none');
            saveBtn.classList.add('d-none');
            editBtn.classList.remove('d-none');
            return;
        }

        if (infoFor == 'clientType') {
            this.showConfirmation('Do you want to update Client type?', (confirmed) => {
                if (confirmed) {
                    this.updateClientType(clientId, newInput, subsId, element, infoFor, nameEl, inputEl, saveBtn, editBtn, selectedOptionHtml);
                }
            });
        }

        if (infoFor == 'paralegal') {
            this.showConfirmation('Do you want to update paralegal assigned?', (confirmed) => {
                if (confirmed) {
                    this.updateParalegal(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn, selectedOptionHtml, subsId);
                }
            });
        }

        if (infoFor == 'lawFirm') {
            this.showConfirmation('Do you want to update law firm assigned?', (confirmed) => {
                if (confirmed) {
                    this.updateLawFirm(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn, selectedOptionHtml, subsId);
                }
            });
        }
    }

    /**
     * Add detail property
     */
    addDetailProperty(button, newStatus) {
        const pillsContainer = button.closest('.property-tab-pills');
        const clientId = pillsContainer.dataset.clientId;
        const currentStatus = parseInt(pillsContainer.dataset.currentStatus);

        if (currentStatus === (newStatus ? 1 : 0)) {
            return;
        }

        const msg = newStatus ?
            'Are you sure you want to enable Detailed Property?' :
            'Are you sure you want to disable Detailed Property?';

        this.showConfirmation(msg, (confirmed) => {
            if (confirmed) {
                const detailUrl = this.routes.enableDetailProperty || '';

                this.makeAjaxRequest(detailUrl, {
                    client_id: clientId,
                    detailed_property: newStatus ? 1 : 0
                }, (res) => {
                    const ans = $.parseJSON(res);
                    if (ans.status == 1) {
                        $.systemMessage(ans.msg, 'alert--success', true);
                        pillsContainer.dataset.currentStatus = newStatus ? '1' : '0';

                        const pills = pillsContainer.querySelectorAll('.property-pill');
                        pills.forEach(p => p.classList.remove('active'));
                        button.classList.add('active');
                    } else {
                        $.systemMessage(ans.msg, 'alert--danger', true);
                    }
                });
            } else {
                const pills = pillsContainer.querySelectorAll('.property-pill');
                pills.forEach(p => p.classList.remove('active'));
                pills[currentStatus].classList.add('active');
            }
        });
    }

    /**
     * Open documents list popup
     */
    openDocumentsListPopup(clientId) {
        const ajaxUrl = this.routes.nonConciergeDocumentsListPopup || '';
        this.makeAjaxRequest(ajaxUrl, {
            client_id: clientId
        }, (response) => {
            laws.updateFaceboxContent(response, 'large-fb-width');
        });
    }

    /**
     * Resend appointment reminder
     */
    resendAppointmentReminder(clientId) {
        const ajaxUrl = this.routes.attorneyResendReminderPopup || '';
        this.makeAjaxRequest(ajaxUrl, {
            client_id: clientId
        }, (response) => {
            laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
        });
    }

    /**
     * Get simple text messages
     */
    getSimpleTextMessages(clientId) {
        $.systemMessage(this.langLbl.processing || 'Processing...', 'alert--process', true);
        const ajaxUrl = this.routes.attorneySimpletextMessages || '';
        this.makeAjaxRequest(ajaxUrl, {
            client_id: clientId
        }, (response) => {
            $.systemMessage.close();
            $('.message-indicator-' + clientId).remove();
            laws.updateFaceboxContent(response, 'large-fb-width p-0');
        });
    }

    /**
     * Open edit request popup
     */
    openEditRequestPopup(clientId) {
        const ajaxUrl = this.routes.editAttorneyRequestPopup || '';
        this.makeAjaxRequest(ajaxUrl, {
            client_id: clientId
        }, (response) => {
            laws.updateFaceboxContent(response, 'large-fb-width');
        });
    }

    /**
     * Show subscription addon
     */
    showSubscriptionAddon(clientId) {
        const divHtml = $(".subscription-addon-" + clientId).html();
        if (divHtml !== '') {
            laws.updateFaceboxContent(divHtml, 'subscription-addon medium-fb-width p-0 bg-unset');
        }
    }

    /**
     * Client password reset
     */
    clientPasswordReset(clientId) {
        const ajaxUrl = this.routes.clientPasswordResetPopupByAttorney || '';
        this.makeAjaxRequest(ajaxUrl, {
            client_id: clientId
        }, (response) => {
            laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
        });
    }

    /**
     * Send paralegal info to client
     */
    sendParalegalInfoToClient(id, paralegalId, ajaxUrl) {
        this.makeAjaxRequest(ajaxUrl, {
            client_id: id,
            paralegal_id: paralegalId
        }, (response) => {
            laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
        });
    }

    /**
     * Update name
     */
    updateName(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn) {
        $.systemMessage('Updating..', 'alert--process');
        const url = this.routes.updateName || '';
        this.makeAjaxRequest(url, {
            client_id: clientId,
            new_name: newInput
        }, (res) => {
            const ans = $.parseJSON(res);
            if (ans.status == 1) {
                nameEl.textContent = newInput;
                $(element).attr('onclick', `updateInfoFn(this, '${infoFor}', '${clientId}','${newInput}')`);
                nameEl.classList.remove('d-none');
                inputEl.classList.add('d-none');
                saveBtn.classList.add('d-none');
                editBtn.classList.remove('d-none');
                $.systemMessage(ans.msg, 'alert--success', true);
            } else {
                $.systemMessage(ans.msg, 'alert--danger', true);
            }
        });
    }

    /**
     * Update email
     */
    updateEmail(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn) {
        $.systemMessage('Updating..', 'alert--process');
        const url = this.routes.updateEmail || '';
        this.makeAjaxRequest(url, {
            client_id: clientId,
            new_email: newInput
        }, (res) => {
            const ans = $.parseJSON(res);
            if (ans.status == 1) {
                nameEl.textContent = newInput;
                $(element).attr('onclick', `updateInfoFn(this, '${infoFor}', '${clientId}','${newInput}')`);
                nameEl.classList.remove('d-none');
                inputEl.classList.add('d-none');
                saveBtn.classList.add('d-none');
                editBtn.classList.remove('d-none');
                $.systemMessage(ans.msg, 'alert--success', true);
            } else {
                $(`#edit-input-${infoFor}-${clientId}`).focus();
                $.systemMessage(ans.msg, 'alert--danger', true);
            }
        });
    }

    /**
     * Update phone
     */
    updatePhone(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn) {
        $.systemMessage('Updating..', 'alert--process');
        const url = this.routes.updatePhone || '';
        this.makeAjaxRequest(url, {
            client_id: clientId,
            new_phone: newInput
        }, (res) => {
            const ans = $.parseJSON(res);
            if (ans.status == 1) {
                nameEl.textContent = newInput;
                $(element).attr('onclick', `updateInfoFn(this, '${infoFor}', '${clientId}','${newInput}')`);
                nameEl.classList.remove('d-none');
                inputEl.classList.add('d-none');
                saveBtn.classList.add('d-none');
                editBtn.classList.remove('d-none');
                $.systemMessage(ans.msg, 'alert--success', true);
            } else {
                $(`#edit-input-${infoFor}-${clientId}`).focus();
                $.systemMessage(ans.msg, 'alert--danger', true);
            }
        });
    }

    /**
     * Update client type
     */
    updateClientType(clientId, newInput, subsId, element, infoFor, nameEl, inputEl, saveBtn, editBtn, selectedOptionHtml) {
        $.systemMessage('Updating..', 'alert--process');
        const url = this.routes.updateClientType || '';
        this.makeAjaxRequest(url, {
            client_id: clientId,
            client_type_id: newInput,
            package_id: subsId
        }, (res) => {
            $.systemMessage.close();
            if (newInput == 3 && subsId != 100) {
                laws.updateFaceboxContent(res);
            } else {
                const ans = $.parseJSON(res);
                if (ans.status == 1) {
                    $.systemMessage(ans.msg, 'alert--success', true);
                    nameEl.textContent = selectedOptionHtml;
                    $(element).attr('onclick', `updateSelectInfoFn(this, '${infoFor}', '${clientId}','${newInput}', '${subsId}')`);
                    nameEl.classList.remove('d-none');
                    inputEl.classList.add('d-none');
                    saveBtn.classList.add('d-none');
                    editBtn.classList.remove('d-none');
                } else {
                    $.systemMessage(ans.msg, 'alert--danger', true);
                }
            }
        });
    }

    /**
     * Update paralegal
     */
    updateParalegal(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn, selectedOptionHtml, subsId) {
        $.systemMessage('Updating..', 'alert--process');
        const url = this.routes.updateClientParalegal || '';
        this.makeAjaxRequest(url, {
            client_id: clientId,
            paralegal_id: newInput
        }, (res) => {
            const ans = $.parseJSON(res);
            if (ans.status == 1) {
                $.systemMessage(ans.msg, 'alert--success', true);
                nameEl.textContent = selectedOptionHtml;
                $(element).attr('onclick', `updateSelectInfoFn(this, '${infoFor}', '${clientId}','${newInput}', '${subsId}')`);
                nameEl.classList.remove('d-none');
                inputEl.classList.add('d-none');
                saveBtn.classList.add('d-none');
                editBtn.classList.remove('d-none');
            } else {
                $.systemMessage(ans.msg, 'alert--danger', true);
            }
        });
    }

    /**
     * Update law firm
     */
    updateLawFirm(clientId, newInput, element, infoFor, nameEl, inputEl, saveBtn, editBtn, selectedOptionHtml, subsId) {
        $.systemMessage('Updating..', 'alert--process');
        const url = this.routes.updateClientAssociate || '';
        this.makeAjaxRequest(url, {
            client_id: clientId,
            associate_id: newInput
        }, (res) => {
            const ans = $.parseJSON(res);
            if (ans.status == 1) {
                $.systemMessage(ans.msg, 'alert--success', true);
                nameEl.textContent = selectedOptionHtml;
                $(element).attr('onclick', `updateSelectInfoFn(this, '${infoFor}', '${clientId}','${newInput}', '${subsId}')`);
                nameEl.classList.remove('d-none');
                inputEl.classList.add('d-none');
                saveBtn.classList.add('d-none');
                editBtn.classList.remove('d-none');
            } else {
                $.systemMessage(ans.msg, 'alert--danger', true);
            }
        });
    }

    /**
     * Validate email
     */
    validateEmail(value) {
        value = $.trim(value);
        return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
    }

    /**
     * Validate phone
     */
    validatePhone(phoneNumber) {
        phoneNumber = phoneNumber.replace(/\s+/g, "");
        return phoneNumber.length > 9 && /^(?:\+?1[-.●]?|1[-.●]?)?\(?([2-9][0-9]{2})\)?[-.●]?([2-9][0-9]{2})[-.●]?([0-9]{4})$/.test(phoneNumber);
    }

    /**
     * Capitalize words
     */
    capitalizeWords(str) {
        return str.replace(/\b\w+/g, function(word) {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });
    }

    /**
     * Show confirmation dialog
     */
    showConfirmation(message, callback) {
        if (typeof showConfirmation === 'function') {
            showConfirmation(message, callback);
        } else if (confirm(message)) {
            callback(true);
        } else {
            callback(false);
        }
    }

    /**
     * Make AJAX request using laws.ajax utility
     */
    makeAjaxRequest(url, data, successCallback, errorCallback) {
        if (typeof laws !== 'undefined' && laws.ajax) {
            laws.ajax(url, data, successCallback);
        } else {
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: successCallback,
                error: errorCallback || (() => {
                    console.error('AJAX request failed');
                })
            });
        }
    }
}

// Global functions for backward compatibility
window.edit_client = function(obj, id, ctype) {
    if (window.clientManagementManager) {
        window.clientManagementManager.editClient(obj, id, ctype);
    }
};

window.request_msg_modal = function(obj, id) {
    if (window.clientManagementManager) {
        window.clientManagementManager.requestMsgModal(obj, id);
    }
};

window.file_upload_modal = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.fileUploadModal(clientId);
    }
};

window.report_edit_modal = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.reportEditModal(clientId);
    }
};

window.get_options = function(selectClass, clientTypeId, packageId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.getOptions(selectClass, clientTypeId, packageId);
    }
};

window.get_paralegal_options = function(selectClass, selectedParalegal) {
    if (window.clientManagementManager) {
        window.clientManagementManager.getParalegalOptions(selectClass, selectedParalegal);
    }
};

window.updateSelectclasses = function(id) {
    if (window.clientManagementManager) {
        window.clientManagementManager.updateSelectClasses(id);
    }
};

window.updateParalegalSelectClasses = function(id) {
    if (window.clientManagementManager) {
        window.clientManagementManager.updateParalegalSelectClasses(id);
    }
};

window.editClienInfo = function(clientId, infoFor) {
    if (window.clientManagementManager) {
        window.clientManagementManager.editClientInfo(clientId, infoFor);
    }
};

window.updateInfoFn = function(element, infoFor, clientId, prevInput) {
    if (window.clientManagementManager) {
        window.clientManagementManager.updateInfoFn(element, infoFor, clientId, prevInput);
    }
};

window.updateSelectInfoFn = function(element, infoFor, clientId, prevInput, subsId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.updateSelectInfoFn(element, infoFor, clientId, prevInput, subsId);
    }
};

window.addDetailProperty = function(button, newStatus) {
    if (window.clientManagementManager) {
        window.clientManagementManager.addDetailProperty(button, newStatus);
    }
};

window.openDocumentsListPopup = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.openDocumentsListPopup(clientId);
    }
};

window.resendAppointmentReminder = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.resendAppointmentReminder(clientId);
    }
};

window.getSimpleTextMessages = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.getSimpleTextMessages(clientId);
    }
};

window.openEditRequestPopup = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.openEditRequestPopup(clientId);
    }
};

window.showSubscriptionAddon = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.showSubscriptionAddon(clientId);
    }
};

window.clientPasswordReset = function(clientId) {
    if (window.clientManagementManager) {
        window.clientManagementManager.clientPasswordReset(clientId);
    }
};

window.sendParalegalInfoToClient = function(id, paralegalId, ajaxUrl) {
    if (window.clientManagementManager) {
        window.clientManagementManager.sendParalegalInfoToClient(id, paralegalId, ajaxUrl);
    }
};

window.validateEmail = function(value) {
    if (window.clientManagementManager) {
        return window.clientManagementManager.validateEmail(value);
    }
    return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test($.trim(value));
};

window.validatePhone = function(phoneNumber) {
    if (window.clientManagementManager) {
        return window.clientManagementManager.validatePhone(phoneNumber);
    }
    phoneNumber = phoneNumber.replace(/\s+/g, "");
    return phoneNumber.length > 9 && /^(?:\+?1[-.●]?|1[-.●]?)?\(?([2-9][0-9]{2})\)?[-.●]?([2-9][0-9]{2})[-.●]?([0-9]{4})$/.test(phoneNumber);
};

window.capitalizeWords = function(str) {
    if (window.clientManagementManager) {
        return window.clientManagementManager.capitalizeWords(str);
    }
    return str.replace(/\b\w+/g, function(word) {
        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
    });
};
