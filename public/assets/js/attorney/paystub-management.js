/**
 * Paystub Management JavaScript Module
 * Handles paystub and employer management functionality
 */

window.BK = window.BK || {};
window.BK.PaystubManagement = (function() {
    'use strict';

    // Configuration object
    const config = window.PaystubManagementConfig || {};

    /**
     * Initialize the module
     */
    function init() {
        // Check URL segment to determine initial state
        const lastUrl = config.lastUrlSegment;
        if (lastUrl === 'employer') {
            enableEmployer();
        }

        // Expose functions globally for backward compatibility
        exposeGlobalFunctions();
    }

    /**
     * Enable Paystub Section
     * Shows paystub section and hides employer section
     */
    function enablePaystub() {
        $('.paychecks-section').removeClass('d-none');
        $('.employer-section').addClass('d-none');
        $('.paychecks-btn').addClass('is_active');
        $('.employer-btn').removeClass('is_active');
        $('.new-paychecks-btn').removeClass('d-none');
        $('.new-employer-btn').addClass('d-none');
    }

    /**
     * Enable Employer Section
     * Shows employer section and hides paystub section
     */
    function enableEmployer() {
        $('.employer-section').removeClass('d-none');
        $('.paychecks-section').addClass('d-none');
        $('.employer-btn').addClass('is_active');
        $('.paychecks-btn').removeClass('is_active');
        $('.new-paychecks-btn').addClass('d-none');
        $('.new-employer-btn').removeClass('d-none');
    }

    /**
     * Show Calculation Modal
     * Displays the 6-month CMI calculation popup
     */
    function showCalculation() {
        laws.updateFaceboxContent($(".cal-popip").html(), 'large-fb-width questions_popup_div');
    }

    /**
     * Delete Paystub
     * Deletes a paystub with confirmation
     * @param {string} url - Delete URL
     * @param {string} id - Paystub ID
     * @param {string} name - Paystub name for confirmation
     */
    function deletePaystub(url, id, name) {
        if (!confirm(langLbl.confirmDelete + " " + name + '?')) {
            return;
        }
        
        laws.ajax(url, { paystub_id: id }, function (response) {
            const res = JSON.parse(response);
            if (res.status === 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                $('.paystub-' + id).fadeOut();
            }
        });
    }

    /**
     * Show JSON Response
     * Displays JSON response in a modal
     * @param {string} jsonResponse - Base64 encoded JSON response
     */
    function showResponse(jsonResponse) {
        const sample = $(`
            <div class="modal-content modal-content-div conditional-ques">
                <div class="modal-header align-items-center py-2">
                    <h5 class="modal-title d-flex w-100">
                        JSON Response
                    </h5>
                </div>
                <div class="modal-body p-0">
                    <div class="card-body b-0-i">
                        <div class="light-gray-div mt-3">
                            <h2>JSON Response</h2>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="label-div">
                                        <label style="overflow-x:auto; max-width:850px;">${atob(jsonResponse)}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        laws.updateFaceboxContent(sample, 'xlarge-fb-width questions_popup_div');
    }

    /**
     * Add New Paystub
     * Opens modal to add a new paystub
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function addNewPaystub(clientId, clientType) {
        laws.ajax(config.routes.addNewPaystub, {
            client_id: clientId,
            client_type: clientType
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
        });
    }

    /**
     * New Monthly Pay Popup
     * Opens modal for monthly pay entry
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function newMonthlyPayPopup(clientId, clientType) {
        laws.ajax(config.routes.newMonthlyPay, {
            client_id: clientId,
            client_type: clientType
        }, function(response) {
            if (isJson(response)) {
                const res = JSON.parse(response);
                if (res.status === 0) {
                    $.systemMessage(res.msg, 'alert--danger', true);
                }
            } else {
                laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
            }
        });
    }

    /**
     * Pay Check Popup
     * Opens pay check calculation modal
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type (optional)
     */
    function payCheckPopup(clientId, clientType = null) {
        laws.ajax(config.routes.payCheckCalculation, {
            client_id: clientId
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
        });
    }

    /**
     * Copy Popup
     * Opens modal to copy paystub data
     * @param {string} paystubId - Paystub ID
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function copyPopup(paystubId, clientId, clientType) {
        laws.ajax(config.routes.copyPaystub, {
            paystubId: paystubId,
            client_id: clientId,
            client_type: clientType
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
        });
    }

    /**
     * Clone Popup
     * Opens modal to clone paystub
     * @param {string} paystubId - Paystub ID
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function clonePopup(paystubId, clientId, clientType) {
        laws.ajax(config.routes.clonePaystub, {
            paystubId: paystubId,
            client_id: clientId,
            client_type: clientType
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
        });
    }

    /**
     * Edit Paystub
     * Opens modal to edit paystub
     * @param {string} paystubId - Paystub ID
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function editPaystub(paystubId, clientId, clientType) {
        laws.ajax(config.routes.editPaystub, {
            paystubId: paystubId,
            client_id: clientId,
            client_type: clientType
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
        });
    }

    /**
     * Sync Paystub
     * Synchronizes paystub calculations
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function syncPaystub(clientId, clientType) {
        let cType = 'self';
        if (clientType === 'debtor') { cType = 'self'; }
        if (clientType === 'codebtor') { cType = 'spouse'; }

        laws.ajax(config.routes.showPaystubCalculation, {
            client_id: clientId,
            u_type: cType
        }, function (response) {
            if (isJson(response)) {
                const res = JSON.parse(response);
                if (res.status === 0) {
                    $.systemMessage(res.msg, 'alert--danger', true);
                } else if (res.status === 1) {
                    $.systemMessage(res.msg, 'alert--success', true);
                    $.facebox.close();
                }
            } else {
                laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
            }
        });
    }

    /**
     * Manage Employer
     * Opens modal to manage employer
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function manageEmployer(clientId, clientType) {
        laws.ajax(config.routes.manageEmployer, {
            client_id: clientId,
            client_type: clientType
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
        });
    }

    /**
     * Edit Employer
     * Opens modal to edit employer
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     * @param {string} employerId - Employer ID
     */
    function editEmployer(clientId, clientType, employerId) {
        laws.ajax(config.routes.editEmployer, {
            client_id: clientId,
            client_type: clientType,
            employer_id: employerId
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
        });
    }

    /**
     * Delete Employer
     * Deletes an employer with confirmation
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     * @param {string} empId - Employer ID
     * @param {string} empName - Employer name
     */
    function deleteEmployer(clientId, clientType, empId, empName) {
        if (!confirm("Are you sure you want to delete Employer - " + empName + '?')) {
            return;
        }

        laws.ajax(config.routes.deleteEmployer, {
            client_id: clientId,
            client_type: clientType,
            emp_id: empId
        }, function (response) {
            const res = JSON.parse(response);
            if (res.status === 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                $('.employer-row-' + empId).fadeOut();
            }
        });
    }

    /**
     * Save Paystub Document
     * Saves document association to paystub
     * @param {HTMLElement} thisObj - Select element
     * @param {string} clientId - Client ID
     * @param {string} paystubId - Paystub ID
     */
    function savePaystubDocument(thisObj, clientId, paystubId) {
        const docId = $(thisObj).val();
        
        laws.ajax(config.routes.savePaystubDoc, {
            client_id: clientId,
            paystub_id: paystubId,
            document_id: docId
        }, function (response) {
            const res = JSON.parse(response);
            
            if (res.status === 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status === 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        });
    }

    /**
     * Calculate Upload Button Click For All Employer
     * Processes all payroll documents through AI
     * @param {string} dType - Document type
     * @param {string} dataFor - Data for (Debtor/Co-Debtor)
     */
    function calculateUploadBtnClickForAllEmployer(dType, dataFor) {
        showConfirmation("Are you sure you want to process all payroll documents through Payroll Assistant BKQ AI?", function(confirmation) {
            if (confirmation) {
                $.systemMessage(
                    `BKQ AI is pulling all of the ${dataFor}'s payroll data from the uploaded pay stubs and importing it to Payroll Assistant with AI. Please be patient the magic takes a few minutes.`,
                    'alert--process toast-bg-purple'
                );

                laws.ajax(config.routes.processByGraphqlForAllEmployers, {
                    document_type: dType,
                    client_id: config.clientId,
                    employer_ids: config.employerIds
                }, function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 0) {
                        $.systemMessage(res.msg, 'alert--danger', true);
                    } else {
                        $.systemMessage(res.msg, 'alert--success toast-bg-purple', true);
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                });
            }
        });
    }

    /**
     * Assign Data To Other Paystubs
     * Imports data from one paystub to others
     * @param {string} paystubId - Paystub ID
     * @param {string} clientId - Client ID
     * @param {string} paystubFor - Paystub for (Debtor/Co-Debtor)
     * @param {string} cnfmsg - Confirmation message
     * @param {string} empId - Employer ID
     */
    function assignDataToOtherPaystubs(paystubId, clientId, paystubFor, cnfmsg, empId) {
        showConfirmation(cnfmsg, function(confirmation) {
            if (confirmation) {
                laws.ajax(config.routes.importDataToOtherPaystubs, {
                    paystubId: paystubId,
                    clientId: clientId,
                    paystubFor: paystubFor,
                    empId: empId
                }, function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 0) {
                        $.systemMessage(res.msg, 'alert--danger', true);
                    } else {
                        $.systemMessage(res.msg, 'alert--success', true);
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                });
            }
        });
    }

    /**
     * Calculation Logs Popup
     * Opens modal to show calculation logs
     * @param {string} paystubId - Paystub ID
     * @param {string} clientId - Client ID
     * @param {string} clientType - Client type
     */
    function calculationLogsPopup(paystubId, clientId, clientType) {
        laws.ajax(config.routes.calculationLogsPopup, {
            paystubId: paystubId,
            clientId: clientId
        }, function(response) {
            const res = JSON.parse(response);
            
            if (res.status === 0) {
                $.systemMessage(res.msg, "alert--danger", true);
            }
            if (res.status === true) {
                laws.updateFaceboxContent(res.html, 'bg-unset');
            }
        });
    }

    /**
     * Import Calculation To Pay Stub
     * Imports calculation data to specific paystub
     * @param {string} paystubIndex - Paystub index
     * @param {string} paystubId - Paystub ID
     * @param {string} clientId - Client ID
     * @param {string} cnfmsg - Confirmation message
     */
    function importCalculationToPayStub(paystubIndex, paystubId, clientId, cnfmsg) {
        showConfirmation(cnfmsg, function(confirmation) {
            if (confirmation) {
                laws.ajax(config.routes.importDataToThisPaystubs, {
                    paystubIndex: paystubIndex,
                    paystubId: paystubId,
                    clientId: clientId,
                }, function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 0) {
                        $.systemMessage(res.msg, 'alert--danger', true);
                    } else {
                        $.systemMessage(res.msg, 'alert--success', true);
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                });
            }
        });
    }

    /**
     * Expose functions globally for backward compatibility
     */
    function exposeGlobalFunctions() {
        window.enablePaystub = enablePaystub;
        window.enableEmployer = enableEmployer;
        window.showCalculation = showCalculation;
        window.deletePaystub = deletePaystub;
        window.showresponse = showResponse;
        window.addNewPaystub = addNewPaystub;
        window.newMonthlyPayPopup = newMonthlyPayPopup;
        window.payCheckPopup = payCheckPopup;
        window.copyPopup = copyPopup;
        window.clonePopup = clonePopup;
        window.editPaystub = editPaystub;
        window.syncPaystub = syncPaystub;
        window.manageEmployer = manageEmployer;
        window.editEmployer = editEmployer;
        window.deleteEmployer = deleteEmployer;
        window.savePaystubDocument = savePaystubDocument;
        window.calculateUploadBtnClickForAllEmployer = calculateUploadBtnClickForAllEmployer;
        window.assignDataToOtherPaystubs = assignDataToOtherPaystubs;
        window.calculationLogsPopup = calculationLogsPopup;
        window.importCalculationToPayStub = importCalculationToPayStub;
    }

    // Public API
    return {
        init: init,
        enablePaystub: enablePaystub,
        enableEmployer: enableEmployer,
        showCalculation: showCalculation,
        deletePaystub: deletePaystub,
        showResponse: showResponse,
        addNewPaystub: addNewPaystub,
        newMonthlyPayPopup: newMonthlyPayPopup,
        payCheckPopup: payCheckPopup,
        copyPopup: copyPopup,
        clonePopup: clonePopup,
        editPaystub: editPaystub,
        syncPaystub: syncPaystub,
        manageEmployer: manageEmployer,
        editEmployer: editEmployer,
        deleteEmployer: deleteEmployer,
        savePaystubDocument: savePaystubDocument,
        calculateUploadBtnClickForAllEmployer: calculateUploadBtnClickForAllEmployer,
        assignDataToOtherPaystubs: assignDataToOtherPaystubs,
        calculationLogsPopup: calculationLogsPopup,
        importCalculationToPayStub: importCalculationToPayStub
    };

})();

// Initialize when DOM is ready
$(document).ready(function() {
    window.BK.PaystubManagement.init();
});

