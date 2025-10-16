/**
 * Tab 4 - Step 2: Debtor Income Information
 * Monthly income, deductions, overtime, bonuses for debtor
 */

// ==================== INCOME TOGGLE FUNCTIONS ====================

/**
 * Show/hide overtime section for debtor
 */
window.showOvertime = function(value, spouse = false) {
    var debtor = 'debtor';
    if (spouse) {
        debtor = 'codebtor';
    }
    if (value == 'yes') {
        $('.' + debtor + '-recieve-overtime').removeClass("hide-data");
    }
    if (value == 'no') {
        $('.' + debtor + '-recieve-overtime').addClass("hide-data");
    }
};

/**
 * Show/hide DSO (Domestic Support Obligation) section
 */
window.showDSO = function(value, spouse = false) {
    var debtor = 'debtor';
    if (spouse) {
        debtor = 'codebtor';
    }
    if (value == 'yes') {
        $('.' + debtor + '-dso').removeClass("hide-data");
    }
    if (value == 'no') {
        $('.' + debtor + '-dso').addClass("hide-data");
    }
};

/**
 * Show/hide other deductions section for debtor
 */
window.GetotherDeductions11 = function(value) {
    if (value == 'yes') {
        $('#otherDeductions11_data').removeClass('hide-data');
    } else {
        $('#otherDeductions11_data').addClass('hide-data');
    }
};

// ==================== DEDUCTION CHANGE FUNCTION ====================

/**
 * Handle deduction type change
 */
window.deductionChange = function(inputIndex, spouse = false) {
    var debtor = '';
    if (spouse) {
        debtor = 'joints_';
    }
    var type = $('.' + debtor + 'other_deduction_type_' + inputIndex + ' option:selected').val();
    if (type == 16) {
        $('.' + debtor + 'other_deduction_specify_' + inputIndex).removeClass("hide-data");
    } else {
        $('.' + debtor + 'other_deduction_specify_' + inputIndex).addClass("hide-data");
    }
};

// Export functions for backward compatibility
window.initializeStep2 = function() {
    // Step 2 specific initialization
};

