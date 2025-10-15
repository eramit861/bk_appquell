/**
 * Common Client Description JavaScript Module
 * Handles credit counseling requests and client edit questionnaire functionality
 */

window.BK = window.BK || {};
window.BK.CommonClientDescription = (function() {
    'use strict';

    // Configuration object
    const config = window.CommonClientDescriptionConfig || {};

    /**
     * Credit Counseling Request
     * Opens credit counseling popup for the specified client
     * @param {number} clientId - The client ID
     */
    function creditCounselingRequest(clientId) {
        const url = config.creditCounselingPopupRoute;
        
        laws.ajax(url, { client_id: clientId }, function(response) {
            const res = JSON.parse(response);
            if (res.success === true) {
                laws.updateFaceboxContent(res.html, 'large-fb-width');
            }
        });
    }

    /**
     * Allow Client Edit Questionnaire
     * Handles permission changes for client questionnaire editing
     * @param {string} types - The type of permission being changed
     */
    function allowClientEditQues(types) {
        const clientId = config.clientId;
        const url = config.allowClientEditQuesRoute;

        // Permission type configurations
        const permissionConfigs = {
            'can_edit_basic_info': {
                enableMessage: "Are you sure you want client to edit Basic information?",
                disableMessage: "Are you sure you want client not to edit Basic information?",
                variable: 'can_edit_basic_info'
            },
            'can_edit_property': {
                enableMessage: "Are you sure you want client to edit Property Information?",
                disableMessage: "Are you sure you want client not to edit Property information?",
                variable: 'can_edit_property'
            },
            'can_edit_debts': {
                enableMessage: "Are you sure you want client to edit Debts Information?",
                disableMessage: "Are you sure you want client not to edit Debts information?",
                variable: 'can_edit_debts'
            },
            'can_edit_income': {
                enableMessage: "Are you sure you want client to edit Income Information?",
                disableMessage: "Are you sure you want client not to edit Income information?",
                variable: 'can_edit_income'
            },
            'can_edit_expenase': {
                enableMessage: "Are you sure you want client to edit Expenase Information?",
                disableMessage: "Are you sure you want client not to edit Expenase information?",
                variable: 'can_edit_expenase'
            },
            'can_edit_sofa': {
                enableMessage: "Are you sure you want client to edit SOFA Information?",
                disableMessage: "Are you sure you want client not to edit SOFA information?",
                variable: 'can_edit_sofa'
            }
        };

        const permissionConfig = permissionConfigs[types];
        if (!permissionConfig) {
            console.error('Unknown permission type:', types);
            return;
        }

        const checkbox = $("#" + types);
        const isChecked = checkbox.prop('checked');

        // Show confirmation dialog
        const confirmMessage = isChecked ? permissionConfig.enableMessage : permissionConfig.disableMessage;
        
        if (!confirm(confirmMessage)) {
            checkbox.prop('checked', !isChecked);
            return;
        }

        // Set global variable (maintaining backward compatibility)
        window[permissionConfig.variable] = isChecked ? 1 : 0;

        // Prepare form data
        const formData = {
            for_tab: types,
            can_edit_basic_info: $("#can_edit_basic_info").prop('checked') ? 1 : 0,
            can_edit_property: $("#can_edit_property").prop('checked') ? 1 : 0,
            can_edit_debts: $("#can_edit_debts").prop('checked') ? 1 : 0,
            can_edit_income: $("#can_edit_income").prop('checked') ? 1 : 0,
            can_edit_expenase: $("#can_edit_expenase").prop('checked') ? 1 : 0,
            can_edit_sofa: $("#can_edit_sofa").prop('checked') ? 1 : 0,
            client_id: clientId
        };

        // Submit AJAX request
        laws.ajax(url, formData, function(response) {
            const res = JSON.parse(response);
            
            if (res.status === 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status === 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.href = config.formSubmissionViewRoute;
                }, 300);
            }
        });
    }

    /**
     * Initialize the module
     */
    function init() {
        // Expose functions globally for backward compatibility
        window.creditCounselingRequest = creditCounselingRequest;
        window.allowClientEditQues = allowClientEditQues;
    }

    // Public API
    return {
        init: init,
        creditCounselingRequest: creditCounselingRequest,
        allowClientEditQues: allowClientEditQues
    };

})();

// Initialize when DOM is ready
$(document).ready(function() {
    window.BK.CommonClientDescription.init();
});

