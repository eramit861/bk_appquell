/**
 * Tab 1 - Step 1: Debtor Information
 * Form validation and functionality for debtor's basic information
 */

$(function() {
    // Initialize form validation for Step 1
    initializeStep1Validation();
});

/**
 * Initialize form validation for Debtor Info forms
 */
function initializeStep1Validation() {
    const formSelectors = [
        "#client_basic_info_step1",
        "#client_basic_info_step4" // Part A additional forms
    ];

    formSelectors.forEach(function(selector) {
        if ($(selector).length) {
            $(selector).validate({
                errorPlacement: function(error, element) {
                    if ($(element).parents(".form-group").next('label').hasClass('error')) {
                        $(element).parents(".form-group").next('label').remove();
                        $(element).parents(".form-group").after($(error)[0].outerHTML);
                    } else {
                        $(element).parents(".form-group").after($(error)[0].outerHTML);
                    }
                },
                success: function(label, element) {
                    label.parent().removeClass('error');
                    $(element).parents(".form-group").next('label').remove();
                },
            });
        }
    });
}

// Export functions to global scope for backward compatibility
window.initializeStep1Validation = initializeStep1Validation;

