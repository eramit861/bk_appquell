/**
 * Tab 4 - Common Income Utilities
 * Shared functions for all income steps
 */

// ==================== FORM VALIDATION ====================

/**
 * Initialize form validation for all income steps
 */
function initializeFormValidation() {
    const formSelectors = [
        "#client_income_step1",
        "#client_income_step2",
        "#client_income_step3",
        "#client_income_step4"
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

// ==================== UTILITY FUNCTIONS ====================

/**
 * Calculate month difference between two dates
 */
window.monthDiff = function(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth();
    months += d2.getMonth();
    return months <= 0 ? 0 : months;
};

// ==================== EMPLOYMENT PERIOD FUNCTIONS ====================

/**
 * Update employment period display
 */
window.updateEmpPeriod = function(key, formId) {
    var years = '';
    var year = $(document).find("#" + formId + " .employer_data_" + key + " .employment_period_year option:selected").val()
    if (year <= 1) {
        years = year + ' Year ';
    } else {
        years = year + ' Years ';
    }

    var months = '';
    var month = $(document).find("#" + formId + " .employer_data_" + key + " .employment_period_month option:selected").val()
    if (month <= 1) {
        months = month + ' Month';
    } else {
        months = month + ' Months';
    }

    if (year == 0 && month <= 7) {
        $(document).find('#' + formId + ' .employer_data_' + key + ' .start-date-main-div').removeClass('hide-data');
        $(document).find('#' + formId + ' .employer_data_' + key + ' .employment_period_date').val('');
        $(document).find('#' + formId + ' .employer_data_' + key + ' .employment_period_date').removeClass('hide-data is-invalid').addClass('required');
        $(document).find('#' + formId + ' .employer_summary_' + key + ' .paystub_paydate_start_parent').removeClass('hide-data');
        $(document).find('#' + formId + ' .employer_data_' + key + ' .employment_period_date_error').html('');
    } else {
        $(document).find('#' + formId + ' .employer_data_' + key + ' .start-date-main-div').addClass('hide-data');
        $(document).find('#' + formId + ' .employer_data_' + key + ' .employment_period_date').val('').addClass('hide-data');
        $(document).find('#' + formId + ' .employer_summary_' + key + ' .paystub_paydate_start_parent').addClass('hide-data');
    }

    var finalString = years + months;
    $(document).find('#' + formId + ' .employer_data_' + key + ' .de_job_period').attr('data-oldString', finalString);
    $(document).find('#' + formId + ' .employer_data_' + key + ' .de_job_period').val(finalString);
};

// ==================== DATE VALIDATION ====================

/**
 * Check if date is within range
 */
window.isDateWithinRange = function(selectedDate, years, months) {
    var today = new Date();
    var pastDate = new Date();

    pastDate.setFullYear(today.getFullYear() - years);
    pastDate.setMonth(today.getMonth() - months);

    return selectedDate >= pastDate && selectedDate <= today;
};

/**
 * Validate employment date
 */
window.validateEmploymentDate = function(inputSelector, yearSelector, monthSelector, errorLabelSelector) {
    var selectedDate = new Date($('input[name="' + inputSelector + '"]').val());

    var selectedYears = parseInt($(yearSelector).val()) || 0;
    var selectedMonths = parseInt($(monthSelector).val()) || 0;

    if (!isNaN(selectedDate) && (!isNaN(selectedYears) || !isNaN(selectedMonths))) {
        if (isDateWithinRange(selectedDate, selectedYears, selectedMonths)) {
            $('input[name="' + inputSelector + '"]').removeClass('is-invalid');
            $(errorLabelSelector).text('')
        } else {
            $('input[name="' + inputSelector + '"]').addClass('is-invalid');
            if (selectedMonths == 0) {
                $(errorLabelSelector).text('Please select Year(s) / Month(s).');
            } else {
                $(errorLabelSelector).text('Start date must be within the last ' + selectedMonths + ' month(s).');
            }
        }
    }
};

// ==================== EVENT HANDLERS ====================

/**
 * Initialize event handlers
 */
function initializeEventHandlers() {
    // Remove deduction section functionality
    $('.removeDeductionSection').click(function() {
        let x = $(document).find(".deduction_section").length;
        if (x < 2) {
            alert("You can't remove last element")
        } else {
            $(document).find(".deduction_section").last().remove();
        }
    });

    // Remove spouse deduction section functionality
    $('.removeSpouseDeductionSection').click(function() {
        let x = $(document).find(".spouse_deduction_section").length;
        if (x < 2) {
            alert("You can't remove last element")
        } else {
            $(document).find(".spouse_deduction_section").last().remove();
        }
    });

    // Employment date validation on input
    $(document).on('input', '.employer-current-employer .employment_period_date', function() {
        let $this = $(this);
        let inputName = $this.attr('name');
        let key = $this.data('key');

        validateEmploymentDate(
            inputName,
            `.employer_data_${key} .employment_period_year`,
            `.employer_data_${key} .employment_period_month`,
            `.employer_data_${key} .error-message`
        );
    });
}

// ==================== INITIALIZATION ====================

$(function() {
    // Initialize form validation for all income steps
    initializeFormValidation();

    // Initialize event handlers
    initializeEventHandlers();

    // Hide selected months on page load
    $(".selected-months").addClass('hide-data');
});

// Export functions for backward compatibility
window.initializeFormValidation = initializeFormValidation;
window.initializeEventHandlers = initializeEventHandlers;

