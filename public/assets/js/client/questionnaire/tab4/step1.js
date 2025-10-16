/**
 * Tab 4 - Step 1: Debtor Employer Information
 * Current employer and previous employers for debtor
 */

// ==================== EMPLOYER TOGGLE FUNCTIONS ====================

/**
 * Toggle current employed section for debtor
 */
window.current_employed_obj = function(value) {
    if (value == 'yes') {
        $('#employer_page_listing_div').removeClass('hide-data');
    } else {
        $('#employer_page_listing_div').addClass('hide-data');
    }
};

// ==================== INITIALIZATION ====================

$(document).ready(function() {
    // Handle debtor login link trigger - only when condition is met
    if (window.__debtorEmployerCondition && $(".debtorlogin-link").length) {
        $(".debtorlogin-link").trigger('click');
    }
});

// Export functions for backward compatibility
window.initializeStep1 = function() {
    // Step 1 specific initialization
};

