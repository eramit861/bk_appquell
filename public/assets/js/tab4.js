// Tab4 Income Questionnaire JavaScript
// This file contains all JavaScript functionality for the income questionnaire

$(function() {
    // Initialize form validation for all income steps
    initializeFormValidation();

    // Initialize event handlers
    initializeEventHandlers();
});

// Initialize form validation
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

// Initialize event handlers
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

// Utility functions
function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth();
    months += d2.getMonth();
    return months <= 0 ? 0 : months;
}

// Employment period update function
function updateEmpPeriod(key, formId) {
    var classFor2nd = '';

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
}

// Date validation functions
function isDateWithinRange(selectedDate, years, months) {
    var today = new Date();
    var pastDate = new Date();

    pastDate.setFullYear(today.getFullYear() - years);
    pastDate.setMonth(today.getMonth() - months);

    return selectedDate >= pastDate && selectedDate <= today;
}

function validateEmploymentDate(inputSelector, yearSelector, monthSelector, errorLabelSelector) {
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
}

// Overtime display functions
function showOvertime(value, spouse = false) {
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
}

// DSO display functions
function showDSO(value, spouse = false) {
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
}

// Deduction change function
function deductionChange(inputIndex, spouse = false) {
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
}

// Additional income-related functions from Blade files
function current_employed_obj(value) {
    if (value == 'yes') {
        $('#employer_page_listing_div').removeClass('hide-data');
    } else {
        $('#employer_page_listing_div').addClass('hide-data');
    }
}

function current_spouse_employed_obj(value) {
    if (value == 'yes') {
        $('#employer_page_listing_div_spouse').removeClass('hide-data');
    } else {
        $('#employer_page_listing_div_spouse').addClass('hide-data');
    }
}


function GetotherDeductions11(value) {
    if (value == 'yes') {
        $('#otherDeductions11_data').removeClass('hide-data');
    } else {
        $('#otherDeductions11_data').addClass('hide-data');
    }
}

function GetotherDeductions22(value) {
    if (value == 'yes') {
        $('#otherDeductions22_data').removeClass('hide-data');
    } else {
        $('#otherDeductions22_data').addClass('hide-data');
    }
}

// Initialize additional event handlers
$(document).ready(function() {
    // Handle debtor login link trigger - only when condition is met
    if (window.__debtorEmployerCondition && $(".debtorlogin-link").length) {
        $(".debtorlogin-link").trigger('click');
    }

    // Handle codebtor login link trigger - only when condition is met
    if (window.__spouseEmployerCondition && $(".codebtorlogin-link").length) {
        $(".codebtorlogin-link").trigger('click');
    }

    // Hide selected months on page load
    $(".selected-months").addClass('hide-data');
});

// Export functions to global scope for backward compatibility
window.monthDiff = monthDiff;
window.updateEmpPeriod = updateEmpPeriod;
window.isDateWithinRange = isDateWithinRange;
window.validateEmploymentDate = validateEmploymentDate;
window.showOvertime = showOvertime;
window.showDSO = showDSO;
window.deductionChange = deductionChange;
window.current_employed_obj = current_employed_obj;
window.current_spouse_employed_obj = current_spouse_employed_obj;
window.GetotherDeductions11 = GetotherDeductions11;
window.GetotherDeductions22 = GetotherDeductions22;
