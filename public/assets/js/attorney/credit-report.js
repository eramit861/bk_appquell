/**
 * Credit Report Management JavaScript
 * Optimized and separated from Blade template for better performance
 * 
 * @author BK Assistant
 * @version 1.0.0
 */

class CreditReportManager {
    constructor(config) {
        this.config = {
            routes: {
                deleteCreditor: config.routes.deleteCreditor || '',
                importSchedule: config.routes.importSchedule || '',
                manualImport: config.routes.manualImport || '',
                csvImport: config.routes.csvImport || '',
                cinReport: config.routes.cinReport || '',
                cinReview: config.routes.cinReview || '',
                importUnsecured: config.routes.importUnsecured || '',
                saveDateIncurred: config.routes.saveDateIncurred || ''
            },
            clientId: config.clientId || null,
            messages: {
                noCreditorSelected: 'No Creditor selected.',
                deleteSingle: 'Are you sure you want to delete the selected creditor?',
                deleteMultiple: 'Are you sure you want to delete the selected creditors?',
                importConfirm: 'Are you sure you want to import this creditor to',
                importUnsecuredConfirm: 'Are you sure you want to import these creditors to Unsecured Debts?',
                dateImportConfirm: 'Are you sure you want to import date to this creditor?'
            }
        };
        
        this.init();
    }

    /**
     * Initialize the credit report manager
     */
    init() {
        this.bindEvents();
        this.initDropdown();
        this.setupGlobalFunctions();
    }

    /**
     * Bind all event handlers
     */
    bindEvents() {
        // Document ready events
        $(document).ready(() => {
            this.initDropdown();
        });
    }

    /**
     * Initialize dropdown functionality
     */
    initDropdown() {
        const $input = $('#credit_type');
        const $dropdown = $('#timeDropdown');
        const $form = $input.closest('form');

        if ($input.length === 0 || $dropdown.length === 0) {
            return; // Elements not found
        }

        // Show dropdown on input focus or click
        $input.on('focus click', () => {
            $dropdown.show();
        });

        // Hide dropdown when clicking outside
        $(document).on('click', (e) => {
            if (!$(e.target).closest('#credit_type, #timeDropdown').length) {
                $dropdown.hide();
            }
        });

        // Submit form on checkbox change
        $dropdown.on('change', '.credit-checkbox', () => {
            $form.submit();
        });
    }

    /**
     * Setup global functions for backward compatibility
     */
    setupGlobalFunctions() {
        // Make functions globally available
        window.toggleSelectAll = (selectAllCheckbox) => this.toggleSelectAll(selectAllCheckbox);
        window.deleteSelected = (clientId) => this.deleteSelected(clientId);
        window.importToSchedule = (id, clientId, obj) => this.importToSchedule(id, clientId, obj);
        window.manualImportPopup = (clientId) => this.manualImportPopup(clientId);
        window.csvImportPopup = (clientId) => this.csvImportPopup(clientId);
        window.importCinReport = (clientId) => this.importCinReport(clientId);
        window.reviewCINData = (clientId) => this.reviewCINData(clientId);
        window.importUnsecuredToClient = (clientId) => this.importUnsecuredToClient(clientId);
        window.saveDateIncurred = (element, clientId, recordId) => this.saveDateIncurred(element, clientId, recordId);
    }

    /**
     * Toggle select all checkboxes
     */
    toggleSelectAll(selectAllCheckbox) {
        const isChecked = selectAllCheckbox.checked;
        const checkboxes = document.querySelectorAll('.select-row');

        checkboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    }

    /**
     * Delete selected creditors
     */
    deleteSelected(clientId) {
        const selectedIds = Array.from(document.querySelectorAll('.select-row:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            this.showAlert(this.config.messages.noCreditorSelected);
            return;
        }

        const message = selectedIds.length > 1 
            ? this.config.messages.deleteMultiple 
            : this.config.messages.deleteSingle;

        if (!confirm(message)) {
            return;
        }

        this.ajaxRequest(this.config.routes.deleteCreditor, {
            client_id: clientId,
            ids: selectedIds
        }, (response) => {
            const res = JSON.parse(response);
            if (res.status === 1) {
                this.showSuccessMessage(res.msg);
                selectedIds.forEach(id => {
                    const row = document.querySelector('.row-' + id);
                    if (row) {
                        row.remove();
                    }
                });
            } else {
                this.showErrorMessage(res.msg);
            }
        });
    }

    /**
     * Import creditor to schedule
     */
    importToSchedule(id, clientId, obj) {
        const importType = obj.value;
        
        if (!importType) {
            return false;
        }

        if (!confirm(`${this.config.messages.importConfirm} ${importType}?`)) {
            obj.value = '';
            return;
        }

        this.ajaxRequest(this.config.routes.importSchedule, {
            id: id,
            import_type: importType,
            client_id: clientId
        }, (response) => {
            if (this.isJson(response)) {
                const res = JSON.parse(response);
                if (res.status === 1) {
                    this.showSuccessMessage(res.msg);
                    $.facebox.close();
                    $(`.row-${id}`).addClass('drop-green').removeClass('drop-red');
                } else {
                    this.showErrorMessage(res.msg);
                }
            } else {
                laws.updateFaceboxContent(response, 'medium-fb-width');
            }
        });
    }

    /**
     * Show manual import popup
     */
    manualImportPopup(clientId) {
        this.showPopup(this.config.routes.manualImport, { client_id: clientId }, 'xlarge-fb-width p-0');
    }

    /**
     * Show CSV import popup
     */
    csvImportPopup(clientId) {
        this.showPopup(this.config.routes.csvImport, { client_id: clientId }, 'small-fb-width p-0 questions_popup_div max-width-unset');
    }

    /**
     * Import CIN report
     */
    importCinReport(clientId) {
        this.showPopup(this.config.routes.cinReport, { client_id: clientId }, 'small-fb-width p-0 questions_popup_div max-width-unset');
    }

    /**
     * Review CIN data
     */
    reviewCINData(clientId) {
        this.showPopup(this.config.routes.cinReview, { client_id: clientId }, 'medium-fb-width');
    }

    /**
     * Import unsecured creditors to client
     */
    importUnsecuredToClient(clientId) {
        if (!confirm(this.config.messages.importUnsecuredConfirm)) {
            return;
        }

        this.ajaxRequest(this.config.routes.importUnsecured, { client_id: clientId }, (response) => {
            if (this.isJson(response)) {
                const res = JSON.parse(response);
                if (res.status === 1) {
                    this.showSuccessMessage(res.msg);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    this.showErrorMessage(res.msg);
                }
            }
        });
    }

    /**
     * Save date incurred for creditor
     */
    saveDateIncurred(element, clientId, recordId) {
        showConfirmation(this.config.messages.dateImportConfirm, (confirmation) => {
            if (confirmation) {
                const dateValue = $(`#date_input_${recordId}`).val();
                
                this.ajaxRequest(this.config.routes.saveDateIncurred, {
                    client_id: clientId,
                    dateValue: dateValue,
                    recordId: recordId
                }, (response) => {
                    if (this.isJson(response)) {
                        const res = JSON.parse(response);
                        if (res.status === 1) {
                            this.showSuccessMessage(res.msg);
                            $(element).closest('td').html(`<span>${dateValue}</span>`);
                        } else {
                            this.showErrorMessage(res.msg);
                        }
                    }
                });
            }
        });
    }

    /**
     * Show popup with AJAX content
     */
    showPopup(url, data, className) {
        this.ajaxRequest(url, data, (response) => {
            if (this.isJson(response)) {
                const res = JSON.parse(response);
                if (res.status === 1) {
                    this.showSuccessMessage(res.msg);
                    $.facebox.close();
                } else {
                    this.showErrorMessage(res.msg);
                }
            } else {
                laws.updateFaceboxContent(response, className);
            }
        });
    }

    /**
     * Make AJAX request
     */
    ajaxRequest(url, data, callback) {
        if (typeof laws !== 'undefined' && laws.ajax) {
            laws.ajax(url, data, callback);
        } else {
            // Fallback to jQuery AJAX
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: callback,
                error: (xhr, status, error) => {
                    console.error('AJAX Error:', error);
                    this.showErrorMessage('An error occurred while processing your request.');
                }
            });
        }
    }

    /**
     * Check if string is valid JSON
     */
    isJson(str) {
        try {
            JSON.parse(str);
            return true;
        } catch (e) {
            return false;
        }
    }

    /**
     * Show success message
     */
    showSuccessMessage(message) {
        if (typeof $.systemMessage === 'function') {
            $.systemMessage(message, 'alert--success', true);
        } else {
            alert(message);
        }
    }

    /**
     * Show error message
     */
    showErrorMessage(message) {
        if (typeof $.systemMessage === 'function') {
            $.systemMessage(message, 'alert--danger', true);
        } else {
            alert(message);
        }
    }

    /**
     * Show alert message
     */
    showAlert(message) {
        alert(message);
    }

    /**
     * Update configuration
     */
    updateConfig(newConfig) {
        this.config = { ...this.config, ...newConfig };
    }

    /**
     * Get current configuration
     */
    getConfig() {
        return this.config;
    }
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = CreditReportManager;
}

// Make available globally
window.CreditReportManager = CreditReportManager;

