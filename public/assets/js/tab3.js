// Tab3 Debts JavaScript
// This file contains the form validation functionality for the debts questionnaire

// Initialize when document is ready
$(document).ready(function() {
    initializeFormValidation();
});

// Initialize form validation
function initializeFormValidation() {
    $("#client_debts").validate({
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