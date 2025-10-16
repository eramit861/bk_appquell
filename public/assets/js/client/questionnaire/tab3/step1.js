/**
 * Tab 3 - Step 1: Unsecured Debts
 * Credit cards, collection accounts, medical bills, etc.
 */

// ==================== CARD COLLECTION FUNCTIONS ====================

/**
 * Card collection type changed - show/hide lawsuit section
 */
window.cardCollectionChanged = function(event) {
    let selectedVal = $(event).val();
    let index = $(event).attr('name').match(/\[(\d+)\]/)[1];

    if (selectedVal == 6) {
        $('.law_suit_div_' + index).removeClass('hide-data');
        var creditorName = $(document).find('[name="debt_tax[creditor_name]['+index+']').val();
        if(creditorName != ''){
            $(document).find('[name="debt_tax[list_lawsuits_data][case_title][' + index + ']"]').val(creditorName);
        }
    } else {
        $('.law_suit_div_' + index).addClass('hide-data');
    }
};

/**
 * Set lawsuit title based on creditor selection
 */
window.setLawsuitTitle = function(debtType = '', debtIndex, label = '') {
    if (debtType == '') {
        debtType = $(`[name="debt_tax[cards_collections][${debtIndex}]"]`).val();
    }

    if (debtType == 6) {
        let originalCreditorVal = $(`[name="debt_tax[original_creditor][${debtIndex}]"]:checked`).val();
        let creditorNameVal = $(`[name="debt_tax[creditor_name][${debtIndex}]"]`).val();
        let secondCreditorNameVal = $(`[name="debt_tax[second_creditor_name][${debtIndex}]"]`).val();
        let $caseTitleInput = $(`[name="debt_tax[list_lawsuits_data][case_title][${debtIndex}]"]`);

        if (label != '') {
            creditorNameVal = label;
            secondCreditorNameVal = label;
        }

        let baseTitle = "";
        if (originalCreditorVal == "1") {
            baseTitle = creditorNameVal;
        } else if (originalCreditorVal == "0") {
            baseTitle = secondCreditorNameVal;
        }

        let currentValue = $caseTitleInput.val();
        let existingNames = "";
        if (currentValue.includes(" V.")) {
            existingNames = currentValue.split(" V.")[1].trim();
        }

        if (existingNames) {
            $caseTitleInput.val(`${baseTitle} V. ${existingNames}`);
        } else {
            $caseTitleInput.val(baseTitle);
        }
    }
};

/**
 * Check if any unsecured debts exist
 */
window.checkAC = function(value) {
    if (value == 'yes') {
        document.getElementById('second_step_debt_div').classList.remove("hide-data");
        document.getElementById('second_step_debt_note_div').classList.remove("hide-data");
    } else if (value == 'no') {
        document.getElementById('second_step_debt_div').classList.add("hide-data");
        document.getElementById('second_step_debt_note_div').classList.add("hide-data");
    }
};

// Export functions for backward compatibility
window.initializeStep1 = function() {
    // Step 1 specific initialization if needed
};