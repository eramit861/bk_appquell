/**
 * Common Questionnaire Utilities
 * Shared functions used across ALL questionnaire tabs
 * This file should be loaded BEFORE any tab-specific files
 */

// ==================== GLOBAL VARIABLES ====================

var CurrentYear = parseInt(new Date().getFullYear());
var CurrentMonth = parseInt(new Date().getMonth()) + 1;
var CurrentDay = parseInt(new Date().getDate());
CurrentMonth = CurrentMonth < 10 ? "0" + CurrentMonth : CurrentMonth;
CurrentDay = CurrentDay < 10 ? "0" + CurrentDay : CurrentDay;

// ==================== CUSTOM JQUERY VALIDATORS ====================

$(document).ready(function () {
    // Date MM/YYYY validator
    $.validator.addMethod("dateMMYYYY", function(value, element) {
        return this.optional(element) || /^(0[1-9]|1[0-2])\/\d{4}$/.test(value);
    }, "Please enter a date in the format MM/YYYY.");

    // Four digits validator
    $.validator.addMethod("fourDigits", function(value, element) {
        return this.optional(element) || /^\d{4}$/.test(value);
    }, "Please enter last 4 digits.");

    // Multiple years validator
    $.validator.addMethod("multipleYears", function(value, element) {
        const years = value.trim().split(/\s+/);
        for (let i = 0; i < years.length; i++) {
            if (!/^\d{4}$/.test(years[i]) || parseInt(years[i], 10) > new Date().getFullYear()) {
                return false;
            }
        }
        return true;
    }, "Please enter valid years separated by spaces, not greater than the current year.");
});

// ==================== DATE INPUT FORMATTING ====================

/**
 * Format month/year date input (MM/YYYY)
 */
function updateMonthYearDateFormatInput($input) {
    let inputVal = $input.val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    if (inputVal.length > 2) {
        inputVal = inputVal.slice(0, 2) + '/' + inputVal.slice(2);
    }
    if (inputVal.length > 7) {
        inputVal = inputVal.slice(0, 7); // Restrict length to 7 characters
    }
    $input.val(inputVal);
}

/**
 * Validate month/year date input
 */
function ValidateMonthYearDateInput($input) {
    const inputVal = $input.val().trim();
    const datePattern = /^(0[1-9]|1[0-2])\/\d{4}$/; // Regular expression for mm/yyyy format

    let requireFieldError;
    let name;

    if (inputVal !== '' && datePattern.test(inputVal)) {
        const parts = inputVal.split('/');
        const inputMonth = parseInt(parts[0], 10);
        const inputYear = parseInt(parts[1], 10);

        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1;
        const currentYear = currentDate.getFullYear();

        const inputDate = new Date(inputYear, inputMonth - 1);
        const currentDateObj = new Date(currentYear, currentMonth - 1);

        // Calculate the date 30 years ago
        const thirtyYearsAgo = new Date(currentYear - 30, currentMonth - 1);
        
        // Check if the input year is older than 30 years
        if (inputDate < thirtyYearsAgo) {
            name = $input.attr("name");
            requireFieldError = '<label id="'+ name + '-error" class="error">Please enter a date within the past 30 years, up to today.</label>';
            $input.parent().parent().find("div.validation-error").remove();
            $input.parent().parent().append(requireFieldError);
            $input.addClass("error");
        } 
        // Check if input date is greater than the current date
        else if (inputDate > currentDateObj) {
            name = $input.attr("name");
            requireFieldError = '<label id="'+ name + '-error" class="error">Please enter a date that is not greater than the current date.</label>';
            $input.parent().parent().find("div.validation-error").remove();
            $input.parent().parent().append(requireFieldError);
            $input.addClass("error");
        }

    } else if (inputVal !== '') {
        $input.val('');
        name = $input.attr("name");
        requireFieldError = '<label id="'+ name + '-error" class="error">Please enter valid date in MM/YYYY format.</label>';
        $input.parent().parent().find("div.validation-error").remove();
        $input.parent().parent().append(requireFieldError);
        $input.addClass("error");
    }
}

/**
 * Check if date is in valid MM/YYYY format
 */
function isValidMMYYYY(date) {
    return /^(0[1-9]|1[0-2])\/\d{4}$/.test(date);
}

/**
 * Check if date is not in the future
 */
function isNotFutureDate(date) {
    const today = new Date();
    const [month, year] = date.split('/').map(Number);
    const enteredDate = new Date(year, month - 1);
    return enteredDate <= today;
}

// ==================== DATE PICKER INITIALIZATION ====================

/**
 * Initialize all date pickers and masks
 */
function initializeDatepicker() {
    $("input.date_filed").bind("paste", function (e) {
        e.preventDefault();
    });

    if ($.fn.mask) {
        $(".date_filed.my").mask("Z9/9999", {
            translation: {
                Z: {
                    pattern: /[0-9]/,
                    optional: true,
                },
            },
        });

        $(".date-validate-mm-yyyy-format").mask("Z9/9999", {
            translation: {
                Z: {
                    pattern: /[0-9]/,
                    optional: true,
                },
            }
        });

        $(".date_month_year").mask("Z9/9999", {
            translation: {
                Z: {
                    pattern: /[0-9]/,
                    optional: true,
                },
            }
        });
    }
}

// ==================== INPUT SANITIZERS ====================

$(document).ready(function() {
    // Initialize datepicker
    initializeDatepicker();

    // Format date inputs on page load
    $('.date_month_year_custom').each(function() {
        updateMonthYearDateFormatInput($(this));
    });

    // Handle date input formatting
    $(document).on("input", '.date_month_year_custom', function() {
        updateMonthYearDateFormatInput($(this));
    });

    // Handle date validation on blur
    $(document).on("blur", '.date_month_year_custom', function() {
        ValidateMonthYearDateInput($(this));
    });

    // Simple date format (MM/DD/YYYY)
    $('.simple_date_format').on('input', function(e) {
        var input = $(this).val();
        var formattedInput = input.replace(/\D/g, '');

        if (formattedInput.length > 2) {
            formattedInput = formattedInput.slice(0, 2) + '/' + formattedInput.slice(2);
        }
        if (formattedInput.length > 5) {
            formattedInput = formattedInput.slice(0, 5) + '/' + formattedInput.slice(5, 9);
        }
        $(this).val(formattedInput);
    });

    // Capitalize first letter of each word
    $(document).on("blur", '.input_capitalize', function() {
        let value = $(this).val().toLowerCase();
        let capitalizedValue = value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
        $(this).val(capitalizedValue);
    });

    // Alphanumeric input sanitizer
    $(document).on('input', '.alphanumericInput', function () {
        var sanitizedInput = $(this).val().replace(/[^A-Za-z0-9 ]/g, '');
        $(this).val(sanitizedInput);
    });

    // Alphanumeric input with 4 digit limit
    $(document).on('input', '.alphanumericInput_last_4_digits', function () {
        var sanitizedInput = $(this).val().replace(/[^A-Za-z0-9 ]/g, '').substring(0, 4);
        $(this).val(sanitizedInput);
    });

    // MM/YYYY format validation on blur
    $(document).on('blur', '.date-validate-mm-yyyy-format', function () {
        const input = $(this);
        const value = input.val().trim();
        const errorMsg = input.closest('.form-group').find('.error-msg');
        
        errorMsg.text('');
        input.removeClass('error');
        
        if (!isValidMMYYYY(value)) {
            errorMsg.text('Please enter the date in MM/YYYY format');
            input.val('');
            input.addClass('error');
            return;
        }

        if (!isNotFutureDate(value)) {
            errorMsg.text('Future dates are not allowed');
            input.val('');
            input.addClass('error');
            return;
        }

        const startinputname = input.attr('data-startinputname');
        const endinputname   = input.attr('data-endinputname');
        
        const startDate = $('input[name="'+startinputname+'"]').val().trim();
        const endDate   = $('input[name="'+endinputname+'"]').val().trim();

        if (startDate && endDate) {
            const [startMonth, startYear] = startDate.split('/').map(Number);
            const [endMonth, endYear] = endDate.split('/').map(Number);

            const start = new Date(startYear, startMonth - 1);
            const end = new Date(endYear, endMonth - 1);

            if (start > end) {
                errorMsg.text('"From" date cannot be greater than "To" date.');     
                input.addClass('error');
                input.val('');
                return
            }
        }
        input.removeClass('error');
    });

    // Remove error class from radio button labels when clicked
    $(document).on('click', '.label-div label.btn-toggle', function () {
        const $label = $(this);
        const radioId = $label.attr('for');
        const $radio = $(`#${radioId}`);
        const name = $radio.attr('name');

        $(`input[name="${name}"]`).each(function () {
            $(this).removeClass('error');
            $(`label[for="${$(this).attr('id')}"]`).removeClass('error').removeClass('isRadioError');
        });
    });
});

// ==================== CONFIRMATION DIALOG ====================

/**
 * Show custom confirmation dialog
 */
window.showConfirmation = function(message, callback) {
    const modalHtml = `
        <div id="customConfirm" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;justify-content:center;align-items:center;">
            <div style="background:white;padding:20px;border-radius:5px;max-width:80%;">
                <p>${message}</p>
                <div style="display:flex;justify-content:center;margin-top:20px;gap:1rem;">
                    <button id="confirmYes" class="btn-new-ui-default">Yes</button>
                    <button id="confirmNo" class="btn-new-ui-default">No</button>
                </div>
            </div>
        </div>
    `;
    
    $('body').append(modalHtml);
    
    $('#confirmYes').on('click', function() {
        $('#customConfirm').remove();
        callback(true);
    });
    
    $('#confirmNo').on('click', function() {
        $('#customConfirm').remove();
        callback(false);
    });
};

// ==================== COMMON TOGGLE FUNCTIONS ====================

/**
 * Toggle "unknown" checkbox functionality
 */
window.checkUnknown = function(thisobj, index, label = '') {
    if (thisobj.checked == true) {
       $('.is_' + label + '_unknown_' + index).removeClass('required');
       $('.is_' + label + '_unknown_' + index).prop('disabled', true);
       $('.is_' + label + '_unknown_' + index).val('');
    } else {
       $('.is_' + label + '_unknown_' + index).addClass('required');;
       $('.is_' + label + '_unknown_' + index).prop('disabled', false);
       $('.is_' + label + '_unknown_' + index).val('');
    }
};

/**
 * Bulk select "No" for radio buttons in a section
 */
window.selectNoToAbove = function(section) {
    let ids = [];

    if(section == 'financial_assets_2') {
        ids = ['brokerage_app_type_no', 'retirement_pension_no', 'tax_refunds_no', 'licenses_franchises_no'];
    }
    if(section == 'financial_assets_3') {
        ids = ['bonds_mutual_funds_items_no', 'education_ira_no', 'trusts_life_estates_no', 'list-all-property_transfer_no',  'patents_copyrights_no'];
    }
    if(section == 'financial_assets_continued_1') {
        ids = ['alimony_child_support_items_no', 'unpaid_wages_items_no', 'life_insurance_items_no', 'insurance_policies_items_no'];
    }
    if(section == 'financial_assets_continued_2') {
        ids = ['inheritances_items_no', 'injury_claims_items_no', 'other_claims_items_no'];
    }
    if(section == 'sofa_section_legal_action') {
        ids = ['list_lawsuits_no', 'property_repossessed_no', 'setoffs_creditor_no', 'court_appointed_no'];
    }
    if(section == 'sofa_section_gifts') {
        ids = ['list_any_gifts_no', 'gifts-charity_no', 'losses_from_fire_no'];
    }
    if(section == 'sofa_section_property_transfer') {
        ids = ['property_transferred_no', 'property-transferred-creditors_no', 'Property_all_no'];
    }
    if(section == 'sofa_section_storage') {
        ids = ['list-safe-deposit_no', 'list-storage-unit_no', 'list-property-you-hold_no'];
    }
    if(section == 'income_section_first') {
        ids = ['operation_business-no', 'rent_real_property-no', 'recieve_same_rent_amount-no', 'royalties-no', 'retirement_income-no', 'regular_contributions-no', 'unemployment_compensation-no', 'social_security-no', 'other_sources-no', 'government_assistance-no'];
    }
    if(section == 'income_section_first_spouse') {
        ids = ['joints_other_sources-no', 'joints_social_security-no', 'joints_unemployment_compensation-no', 'joints_regular_contributions-no', 'joints_retirement_income-no', 'joints_royalties-no', 'joints_rent_real_property-no', 'joint_operation_business-no', 'government_assistance-no'];
    }

    ids.forEach(id => {
        const label = document.querySelector(`label[for="${id}"]`);
        if (label) {
            label.click();
        }
    });
};

/**
 * Set border label text
 */
window.setBorderLabel = function(element, labelText) {
    const container = element.closest('[class*="residence_property_main_div_"]');
    if (!container) return;

    const labelSpan = container.querySelector('.border-label');
    if (labelSpan) {
        labelSpan.textContent = labelText;
    }
};

/**
 * Update claim type description
 */
window.potentialClaimTypeChanged = function(selectElement) {
    let row = selectElement.closest('.edit_section');
    let descriptionInput = row.querySelector('.injury_claims_description');
    let selectedText = selectElement.options[selectElement.selectedIndex].text;
    
    descriptionInput.value = selectedText;
};

// Export functions for backward compatibility
window.initializeDatepicker = initializeDatepicker;
window.updateMonthYearDateFormatInput = updateMonthYearDateFormatInput;
window.ValidateMonthYearDateInput = ValidateMonthYearDateInput;
window.isValidMMYYYY = isValidMMYYYY;
window.isNotFutureDate = isNotFutureDate;

