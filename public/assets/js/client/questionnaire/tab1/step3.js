/**
 * Tab 1 - Step 3: Bankruptcy Cases and Business Information
 * Form validation and radio button initialization for Parts D & E
 */

$(function() {
    // Initialize form validation for Step 3
    initializeStep3Validation();
    
    // Initialize radio buttons after a short delay
    setTimeout(function() {
        initializeBasicInfoParts();
    }, 500);
});

/**
 * Initialize form validation for BK Cases/Business forms
 */
function initializeStep3Validation() {
    const formSelectors = [
        "#client_basic_info_step3",
        "#client_basic_info_step6" // Part C, D, E forms
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

/**
 * Initialize radio buttons for basic info parts D and E
 * Automatically clicks first radio button if no data exists
 */
window.initializeBasicInfoParts = function() {
    // Part D initialization (Bankruptcy cases)
    var pstatus = window.__tab1Data?.basicInfoPartRest ? 1 : 0;
    if (pstatus == 0) {
        $("#basic-info-part-d input:radio").each(function() {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
    
    // Part E initialization (Business information)
    var pstatusE = window.__tab1Data?.basicInfoPartRestD ? 1 : 0;
    if (pstatusE == 0) {
        $("#basic-info-part-e input:radio").each(function() {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
};

// Export functions to global scope for backward compatibility
window.initializeStep3Validation = initializeStep3Validation;

