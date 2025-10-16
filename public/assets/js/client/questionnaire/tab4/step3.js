/**
 * Tab 4 - Step 3: Spouse/Co-Debtor Employer Information
 * Current employer and previous employers for spouse/co-debtor
 */

// ==================== EMPLOYER TOGGLE FUNCTIONS ====================

/**
 * Toggle current employed section for spouse
 */
window.current_spouse_employed_obj = function(value) {
    if (value == 'yes') {
        $('#employer_page_listing_div_spouse').removeClass('hide-data');
    } else {
        $('#employer_page_listing_div_spouse').addClass('hide-data');
    }
};

// ==================== INITIALIZATION ====================

$(document).ready(function() {
    // Handle codebtor login link trigger - only when condition is met
    if (window.__spouseEmployerCondition && $(".codebtorlogin-link").length) {
        $(".codebtorlogin-link").trigger('click');
    }
});

// Export functions for backward compatibility
window.initializeStep3 = function() {
    // Step 3 specific initialization
};

