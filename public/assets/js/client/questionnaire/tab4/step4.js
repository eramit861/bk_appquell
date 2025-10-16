/**
 * Tab 4 - Step 4: Spouse/Co-Debtor Income Information
 * Monthly income, deductions, overtime, bonuses for spouse/co-debtor
 */

// ==================== INCOME TOGGLE FUNCTIONS ====================

/**
 * Show/hide other deductions section for spouse
 */
window.GetotherDeductions22 = function(value) {
    if (value == 'yes') {
        $('#otherDeductions22_data').removeClass('hide-data');
    } else {
        $('#otherDeductions22_data').addClass('hide-data');
    }
};

// Note: showOvertime, showDSO, and deductionChange are in common.js
// and work for both debtor and spouse with the spouse parameter

// Export functions for backward compatibility
window.initializeStep4 = function() {
    // Step 4 specific initialization
};

