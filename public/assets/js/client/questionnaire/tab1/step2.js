/**
 * Tab 1 - Step 2: Co-Debtor/Spouse Information
 * Form validation and functionality for co-debtor's basic information
 */

$(function() {
    // Initialize form validation for Step 2
    initializeStep2Validation();
});

/**
 * Initialize form validation for Co-Debtor Info forms
 */
function initializeStep2Validation() {
    const formSelectors = [
        "#client_basic_info_step2",
        "#client_basic_info_step5" // Part B additional forms
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
window.initializeStep2Validation = initializeStep2Validation;

