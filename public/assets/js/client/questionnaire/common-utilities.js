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
function showConfirmation(message, callback) {
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
function checkUnknown(thisobj, index, label = '') {
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
function selectNoToAbove(section) {
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
function setBorderLabel(element, labelText) {
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
function potentialClaimTypeChanged(selectElement) {
    let row = selectElement.closest('.edit_section');
    let descriptionInput = row.querySelector('.injury_claims_description');
    let selectedText = selectElement.options[selectElement.selectedIndex].text;
    
    descriptionInput.value = selectedText;
};

// ==================== FORM MANAGEMENT FUNCTIONS ====================

/**
 * Reindex elements after adding/removing forms
 */
function reindexElements(parentClass) {
    $(document).find("." + parentClass).each(function (newIndex) {

        $(this).removeClass(function (index, className) {
            return (className.match(new RegExp(parentClass + "_\\d+", "g")) || []).join(' ');
        }).addClass(parentClass + "_" + newIndex);

        $(this).find(".circle-number-div").html(newIndex + 1);

        if(parentClass == 'all_dependents_form'){
            $(this).find(".delete-div").attr("onclick", `remove_div_common('${parentClass}', ${newIndex});updateAveragePrice();return false;`);
        }else{
            $(this).find(".delete-div").attr("onclick", `remove_div_common('${parentClass}', ${newIndex})`);
        }        

        $(this).find("input, select, textarea").each(function () {
            let nameAttr = $(this).attr("name");
            if (nameAttr) {
                let updatedName = nameAttr.replace(/\[\d+\]/, `[${newIndex}]`);
                $(this).attr("name", updatedName);
            }

            let idAttr = $(this).attr("id");
            if (idAttr) {
                let updatedId = idAttr.replace(/_\d+$/, `_${newIndex}`);
                $(this).attr("id", updatedId);
            }

            let onchangeAttr = $(this).attr("onchange");
            if (onchangeAttr) {
                let updatedOnchange = onchangeAttr.replace(/\(\d+\)/, `(${newIndex})`);
                $(this).attr("onchange", updatedOnchange);
            }
        });
    });
}

/**
 * Reindex only circle numbers (lighter version)
 */
function reindexCircleNoElements(parentClass) {
    $(document).find("." + parentClass).each(function (newIndex) {
        $(this).find(".circle-number-div").html(newIndex + 1);
    });
}

/**
 * Remove form div with reindexing
 */
function remove_div_common(div_class, index, msg = "", reindexAllElements = true) {
    
    var clnln = $(document).find("." + div_class).length;
    if (clnln <= 1) {
        if (msg == "") {
            msg = "You cannot delete because at least 1 entry is required."; 
        }
        $.systemMessage(msg, 'alert--danger', true);
        return false;
    } else {
        $(document)
            .find(`.${div_class}_${index}`)
            .remove();
    }

    if(reindexAllElements){
        reindexElements(div_class);
    }else{
        reindexCircleNoElements(div_class);
    }
    
};

/**
 * Remove form div with separate save (AJAX save after removal)
 */
async function seperate_remove_div_common(div_class, index, msg = "") {
    const $target = $(document).find(`.${div_class}_${index}`);
    const clnln = $(document).find("." + div_class).length;
    if (clnln <= 1) {
        if (msg == "") {
            msg = "You cannot delete because at least 1 entry is required."; 
        }
        $.systemMessage(msg, 'alert--danger', true);
        return false;
    } 

    // Clone before removal so we can restore if needed
    const $clone = $target.clone(true, true);

    // Store the parent and index for accurate reinsertion
    const $parent = $target.parent();
    const targetIndex = $parent.children().index($target);

    // Configuration map for different form types
    const configMap = {
        'life_insurance_mutisec': ['life_insurance', 'life_insurance_mutisec', 'life_insurance_data', 'parent_life_insurance'],
        'other_financial_mutisec': ['other_financial', 'other_financial_mutisec', 'financial_asset_data', 'parent_other_financial'],
        'other_claims_mutisec': ['other_claims', 'other_claims_mutisec', 'other_claims_data', 'parent_other_claims'],
        'injury_claims_mutisec': ['injury_claims', 'injury_claims_mutisec', 'personal_injury_data', 'parent_injury_claims'],
        'inheritances_mutisec': ['inheritances', 'inheritances_mutisec', 'Inheritances_benefits_data', 'parent_inheritances'],
        'insurance_policies_mutisec': ['insurance_policies', 'insurance_policies_mutisec', 'insurance_policies_data', 'parent_insurance_policies'],
        'unpaid_wages_mutisec': ['unpaid_wages', 'unpaid_wages_mutisec', 'unpaid_wages_data', 'parent_unpaid_wages'],
        'alimony_child_support_mutisec': ['alimony_child_support', 'alimony_child_support_mutisec', 'alimony_child_data', 'parent_alimony_child_support'],
        'bank_accounts': ['bank', 'bank_accounts', 'checking_account_items_data', 'parent_bank'],
        'venmo-paypal-cash-mainsec': ['venmo_paypal_cash', 'venmo-paypal-cash-mainsec', 'account_items_data', 'parent_venmo_paypal_cash'],
        'brokerage_account_mutisec': ['brokerage_account', 'brokerage_account_mutisec', 'brokerage_items_data', 'parent_brokerage_account'],
        'mutual_funds_mutisec': ['mutual_funds', 'mutual_funds_mutisec', 'bonds_mutual_funds_items_data', 'parent_mutual_funds'],
        'government_corporate_bonds_mutisec': ['government_corporate_bonds', 'government_corporate_bonds_mutisec', 'government_corporate_data', 'parent_government_corporate_bonds'],
        'retirement_pension_mutisec': ['retirement_pension', 'retirement_pension_mutisec', 'retirement_pension_data', 'parent_retirement_pension'],
        'annuities_mutisec': ['annuities', 'annuities_mutisec', 'annuities_data', 'parent_annuities'],
        'education_ira_mutisec': ['education_ira', 'education_ira_mutisec', 'education_IRA_data', 'parent_education_ira'],
        'trusts_life_estates_mutisec': ['trusts_life_estates', 'trusts_life_estates_mutisec', 'interestin_property_data', 'parent_trusts_life_estates'],
        'patents_copyrights_mutisec': ['patents_copyrights', 'patents_copyrights_mutisec', 'intellectual_property_data', 'parent_patents_copyrights'],
        'tax_refunds_mutisec': ['tax_refunds', 'tax_refunds_mutisec', 'tax_refunds_MainRow', 'parent_tax_refund'],
        'list_all_financial_accounts': ['list_all_financial_accounts', 'list_all_financial_accounts', 'list_all_financial_accounts-data', 'parent_list_all_financial_accounts'],
        // sofa step 1
        'living_domestic_partners': ['living_domestic_partner','living_domestic_partners', 'living-domestic-partner-data', 'parent_living_domestic_partner'],
        'payment_past_one_year': ['past_one_year_data','payment_past_one_year', 'payment-past-one-year-data', 'parent_payment_past_one_year'],
        'transfers_property': ['transfers_property','transfers_property', 'transfers-property-data', 'parent_transfers_property'],
        'list_lawsuits': ['list_lawsuits','list_lawsuits', 'list-lawsuits-data', 'parent_list_lawsuits'],
        'property_repossessed_data_form': ['property_repossessed','property_repossessed_data_form', 'property-repossessed-data', 'parent_property_repossessed'],
        'setoffs_creditor_data': ['setoffs_creditor','setoffs_creditor_data', 'setoffs_creditor-data', 'parent_setoffs_creditor'],
        // sofa step 2
        'list_any_gifts_data': ['list_any_gifts','list_any_gifts_data', 'list-any-gifts-data', 'parent_list_any_gifts'],
        'gifts_charity_data': ['gifts_charity','gifts_charity_data', 'gifts-charity-data', 'parent_gifts_charity'],
        'losses_from_fire_data': ['losses_from_fire','losses_from_fire_data', 'losses_from_fire-data', 'parent_losses_from_fire'],
        'property_transferred_data': ['property_transferred','property_transferred_data', 'property-transferred-data', 'parent_property_transferred'],
        'property_transferred_creditors_data': ['property_transferred_creditors','property_transferred_creditors_data', 'property-transferred-creditors-data', 'parent_property_transferred_creditors'],
        'Property_all_data': ['Property_all','Property_all_data', 'Property_all-data', 'parent_Property_all'],
        'all_property_transfer_10_year_data': ['all_property_transfer_10_year','all_property_transfer_10_year_data', 'list-all-property_transfer-data', 'parent_all_property_transfer_10_year'],
        'list_safe_deposit_data': ['list_safe_deposit','list_safe_deposit_data', 'list-safe-deposit-data', 'parent_list_safe_deposit'],
        'other_storage_unit_data': ['other_storage_unit','other_storage_unit_data', 'list-storage-unit-data', 'parent_other_storage_unit'],
        'list_property_you_hold_data': ['list_property_you_hold','list_property_you_hold_data', 'list-property-you-hold-data', 'parent_list_property_you_hold'],
        // sofa step 3
        'list_noticeby_gov_data': ['list_noticeby_gov','list_noticeby_gov_data', 'list-noticeby-gov-data', 'parent_list_noticeby_gov'],
        'list_environment_law_data': ['list_environment_law','list_environment_law_data', 'list-environment_law-data', 'parent_list_environment_law'],
        'list_judicial_proceedings_data': ['list_judicial_proceedings','list_judicial_proceedings_data', 'list-judicial-proceedings-data', 'parent_list_judicial_proceedings'],
        'list_financial_institutions_data': ['list_financial_institutions','list_financial_institutions_data', 'list-financial-institutions-data', 'parent_list_financial_institutions'],
        // previous employer
        'previous_employer_div_self': ['previous_employer_self','previous_employer_div_self', 'data-previous-employer-self', 'parent_previous_employer'],
        'previous_employer_div_spouse': ['previous_employer_spouse','previous_employer_div_spouse', 'data-previous-employer-spouse', 'parent_previous_employer'],
        'list_nature_business_data': ['list_nature_business','list_nature_business_data', 'list-nature-business-data', 'parent_list_nature_business'],
    };  

    if (div_class === 'bank_accounts') {
        let transaction_enabled = $("#bank-addmore-button").attr('data-transaction-enabled');
        if (transaction_enabled == 1) {
            if(typeof checkBankAccInputs === 'function') {
                checkBankAccInputs();
            }
        }
    }

    if (configMap.hasOwnProperty(div_class)) {
        $target.remove();
        const [type, divCls, dataKey, parentId] = configMap[div_class];
        const success = await seperate_save(type, divCls, dataKey, parentId, index, true);
        
         
        if (!success) {
            // Reinsert the cloned element at its original position
            if (targetIndex === 0) {
                $parent.prepend($clone);
            } else {
                $parent.children().eq(targetIndex - 1).after($clone);
            }
        }
       
        return success;
    }

    return true;

};

/**
 * Edit form div (toggle edit mode)
 */
function edit_div_common(div_class, index, msg = "") {
    $(document).find(`.${div_class}_${index} .summary_section, .${div_class}_${index} .client-edit-button`).addClass('hide-data');
    $(document).find(`.${div_class}_${index} .edit_section`).removeClass('hide-data');
    initializeDatepicker();
};

/**
 * Separate save function (AJAX save with validation)
 */
async function seperate_save(type, div_class, parent_id, fileName, index, isDelete = false) {
    const $section =  (isDelete) ? $(`#${parent_id}`) : $(`.${div_class}_${index} .edit_section`);

    const $saveBtn = $section.find('.save-btn'); // find the save button within the section
    const url = $saveBtn.data('url'); // fallback to data-url if not passed directly
    const formData = new FormData();
    let isValid = true;
    let firstInvalidEl = null;
    // Append type to FormData
    formData.append('assetType', type);
    formData.append('fileName', fileName);
    formData.append('isDelete', isDelete);

    $section.find('input, select, textarea').each(function () {
        const $el = $(this);
        const name = $el.attr('name');
        const value = $el.val();
        const isRequired = $el.hasClass('required') || $el.attr('required');
        const isHiddenInput = $el.attr('type') === 'hidden';
        if (isHiddenInput) {
            if (name) {
                formData.append(name, value);
            }
            return;
        }
    
        $el.removeClass('error'); // remove previous error styles
        $(`label[for="${$el.attr('id')}"]`).removeClass('error');

        if ($el.is(':radio')) {
            if ($(`input[name="${name}"]:checked`).length === 0 && isRequired) {
                if ($el.closest('.hide-data').length === 0) {
                    $el.addClass('error');
                    $(`label[for="${$el.attr('id')}"]`).addClass('error');
                    if (!firstInvalidEl) firstInvalidEl = $el;
                    isValid = false;
                }
            } else if ($el.is(':checked') && name) {
                formData.append(name, value);
            }
            return;
        }

        // Validate required fields
        if (isRequired && (!value || value.trim() === '')) {
            if ($el.closest('.hide-data').length === 0) {
                $el.addClass('error');
                if (!firstInvalidEl) {
                    firstInvalidEl = $el;
                }
                isValid = false;                
            }
        } else if (name) {
            if ($el.is(':checkbox')) {
                if ($el.is(':checked')) {
                    formData.append(name, value);
                }else{
                    formData.append(name, '');
                }
                
            } else {
                formData.append(name, value);
            }
        }
    });

    if (!isValid) {
        if (firstInvalidEl) firstInvalidEl.focus();
        $.systemMessage("Please fill out all required fields.", 'alert--danger', true);
        return false;
    }

    if (type == 'list_all_financial_accounts'){
        formData.append('editableTab', 'can_edit_property');
    }

    const returnStatus = await makeSeperateSaveCall(url, formData, parent_id);
    console.log(url);
    return returnStatus;
}

/**
 * Make AJAX call for separate save
 */
async function makeSeperateSaveCall(url, formData, parent_id) {
    try {
        const response = await $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (response.status) {
            $.systemMessage("Saved successfully.", 'alert--success', true);
            $(`#${parent_id}`).html(response.html);
            return true;
        } else {
            $.systemMessage(response.msg, "alert--danger");
            return false;
        }
    } catch (xhr) {
        $.systemMessage("Something went wrong. Please try again.", "alert--danger");
        console.error(xhr.responseText);
        return false;
    }
}

// ==================== GLOBAL EVENT HANDLERS ====================

/**
 * Price field formatting and validation (ALL TABS)
 */
$(document).on("blur", ".price-field", function (evt) {
    evt.target.value = parseFloat(evt.target.value).toFixed(2);
});

$(document).on("keydown", ".price-field", function (event) {
    if (event.keyCode === 38 || event.keyCode === 40) {
        event.preventDefault();
    }
});

$(document).on("keyup", ".price-field", function (e) {
    var charCode = e.which ? e.which : e.keyCode;
    if (
        charCode > 31 &&
        charCode != 35 &&
        charCode != 36 &&
        charCode != 190 &&
        charCode != 37 &&
        charCode != 38 &&
        charCode != 39 &&
        charCode != 40 &&
        (charCode < 48 || (charCode > 57 && charCode < 96 && charCode > 105))
    )
        e.target.value = "";
    if (e.target.value < 0) {
        e.target.value = "";
        return;
    }

    if (e.target.value < 0) {
        e.target.value = "";
        return;
    }
    var count = 2;
    if (e.target.value.indexOf(".") == -1 && e.keyCode != 8) {
        if (e.target.value.length >= 7) {
            e.target.value = parseFloat(e.target.value).toFixed(count);
        }
        return;
    }

    if (
        e.target.value.length - e.target.value.indexOf(".") > count &&
        e.keyCode != 8
    ) {
        if (e.target.value.length >= 7) {
            var firstseven = e.target.value.substring(0, 10);
            e.target.value = parseFloat(firstseven).toFixed(count);
        } else {
            e.target.value = parseFloat(e.target.value).toFixed(count);
        }
    }
});

// Initialize existing price fields on page load
$(".price-field").each(function () {
    if ($(this).val()) {
        var curval = parseFloat($(this).val()).toFixed(2);
        $(this).val(curval);
    }
});

/**
 * Number formatting helper
 */
function numberFormatField(number) {
    number = number.replace(/[^0-9.]/g, "");
    var parts = number.split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
};

/**
 * Prevent scroll on number inputs
 */
$(document).on("wheel", "input[type=number]", function (e) {
    $(this).blur();
});

/**
 * Numeric only inputs (ALL TABS)
 */
$(".allow_numeric").on("input", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (evt.which < 48 || evt.which > 57) {
        evt.preventDefault();
    }
});

/**
 * Allow 3 digits only
 */
$(document).on("input", ".allow-3digit", function (e) {
    var firstThree = this.value.substring(0, 3);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
    if (this.value.length > 3) {
        this.value = firstThree;
    }
});

/**
 * Allow 4 digits only
 */
$(document).on("input", ".allow-4digit", function (e) {
    var firstFour = this.value.substring(0, 4);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
    if (this.value.length > 4) {
        this.value = firstFour;
    }
});

/**
 * Allow 5 digits only
 */
$(document).on("input", ".allow-5digit", function (e) {
    var firstFive = this.value.substring(0, 5);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
    if (this.value.length > 5) {
        this.value = firstFive;
    }
});

/**
 * Allow 4 alphanumeric characters (VIN last 4)
 */
$(document).on("input", ".allow-4digit-alpha-numeric", function () {
    var self = $(this);
    var sanitized = self.val().replace(/[^a-zA-Z0-9]/g, '');
    self.val(sanitized.substring(0, 4));
});

/**
 * Max today date formatting (MM/DD/YYYY - no future dates)
 */
$(document).on("input", ".max-today-date", function (e) {
    this.type = "text";
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split("/").map(function (v) {
        return v.replace(/\D/g, "");
    });
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1]) values[1] = checkValue(values[1], 31);
    if (values[2]) values[2] = checkYear(values[2], parseInt(CurrentYear));
    if (
        values[2] == CurrentYear &&
        values[0] == CurrentMonth &&
        values[1] > CurrentDay
    ) {
        values[1] = CurrentDay.toString();
    }
    if (values[2] == CurrentYear && values[0] > CurrentMonth) {
        values[1] = CurrentDay.toString();
        values[0] = CurrentMonth.toString();
    }
    var output = values.map(function (v, i) {
        return v.length == 2 && i < 2 ? v + "/" : v;
    });
    this.value = output.join("").substr(0, 10);
});

$(document).on("blur", ".max-today-date", function (e) {
    this.type = "text";
    var input = this.value;
    var values = input.split("/").map(function (v, i) {
        return v.replace(/\D/g, "");
    });
    var output = "";

    if (values.length == 3) {
        var year =
            values[2].length !== 4
                ? parseInt(values[2]) + 2000
                : parseInt(values[2]);
        year = year > CurrentYear ? CurrentYear : year;
        var month = parseInt(values[0]) - 1;
        var day = parseInt(values[1]);
        var d = new Date(year, month, day);
        if (!isNaN(d)) {
            var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
            output = dates
                .map(function (v) {
                    v = v.toString();
                    return v.length == 1 ? "0" + v : v;
                })
                .join("/");
        }
    }
    this.value = output;
});

/**
 * Helper functions for date validation
 */
function checkYear(str, max) {
    if (str.charAt(0) !== "0" || str == "00") {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = 1;
        str =
            num > parseInt(max.toString().charAt(0)) && num.toString().length == 1
                ? "0" + num
                : num.toString();
    }
    return str;
};

function checkValue(str, max) {
    if (str.charAt(0) !== "0" || str == "00") {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = 1;
        str =
            num > parseInt(max.toString().charAt(0)) && num.toString().length == 1
                ? "0" + num
                : num.toString();
    }
    return str;
};

// ==================== PERMISSION CHECK ====================

/**
 * Check if section is editable (permission check)
 */
async function is_editable(section, callback = (result) => {}) {
    return new Promise((resolve) => {
        const formData = new FormData();
        formData.append('section', section);
        
        $.ajax({
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            url: CHECK_PERMISSION_URL,
            contentType: false,
            data: formData,
            processData: false,
            type: 'POST',
            success: function(data) {    
                // Default to true if status is missing/undefined
                const isEditable = data.status !== false; 
                
                if (data.status === false) {
                    $.systemMessage(data.msg || "Editing not allowed", "alert--danger");
                }
                
                callback(isEditable);
                resolve(isEditable);
            },
            error: function() {
                // Default to true on error
                callback(true);
                resolve(true);
            }
        });
    });
};

// ==================== FORM VALIDATION FUNCTIONS ====================

/**
 * Revalidate form with month year
 */
function revalidateFormWithMonthYear(formId,displaymsg=true,saveFromAttorney=false,reloadPage=false) {
    var hasError = false;
    validateFormIds(formId);
    $("#"+ formId).validate().form();
   
    if (!$("#"+ formId).valid()) {
        $('html, body').animate({
            scrollTop: ($('.error:visible').offset().top - 60)
        }, 200);
        hasError = true;
    } else {
        var formElement = document.getElementById(formId);
        var formData = new FormData(formElement);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url: $("#" + formId).attr('action'),
            contentType: false,
            data: formData,
            processData: false,
            type: 'POST',
            async: false,
            success: function ( data ) {
                if(displaymsg == true){
                    if(data.status==1){
                        if(data.display_id == 'irs-texes-views'){
                            $('#irs-texes-views').removeClass('hide-data');
                        }
                        $(document).find("#"+data.display_id).html(data.html);
                        $.systemMessage(data.msg,"alert--success");
                        if(reloadPage && saveFromAttorney ){
                            setTimeout(function() {
                                window.location.href = data.url;
                            }, 2000);
                        }
                    }else{
                        hasError = true;
                        $.systemMessage(data.msg, "alert--danger");
                        return hasError;
                    }
                }
                    
            }
        }); 
    }
    return hasError;
}

/**
 * Validate form ids
 */
function validateFormIds(formId){
    if(formId=='client_property_step2'){
        $(".vd-section").each(function() {
            if($(this).hasClass('d-none')){
                $(this).parent('div').parent('div').find('.vin_number').removeClass('required');
                $(this).removeClass('d-none');
            }
        });
    }
    if(formId == 'date_month_year_custom'){
        let commonRules = {
            required: true,
            dateMMYYYY: true
        };
        $(".date_month_year_custom").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                dateMMYYYY: "Please enter a valid date in the format MM/YYYY."
            };
        });
    }
    if(formId == 'client_debts_step2_unsecured'){
        let commonRules = {
            required: true,
            dateMMYYYY: true
        };
        // Apply rules to all inputs with the class 'dateMMYYYY'
        $(".date_month_year").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                dateMMYYYY: "Please enter a valid date in the format MM/YYYY."
            };
        });
        commonRules = {
            required: true,
            fourDigits: true
        };
        $(".allow-4digit").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                fourDigits: "Please enter last 4 digits."
            };
        });
    }

    if(formId == 'client_debts_step2_back_taxes'){
        commonRules = {
            required: true,
            multipleYears: true
        };
        $(".tax_whats_year").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                fourDigits: "Please enter valid years separated by spaces, not greater than the current year."
            };
        });
    }

    if(formId == 'client_debts_step2_irs'){
        commonRules = {
            required: true,
            multipleYears: true
        };
        $(".tax_irs_whats_year").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                fourDigits: "Please enter valid years separated by spaces, not greater than the current year."
            };
        });
    }

    if(formId == 'client_debts_step2_al'){
        let commonRules = {
            required: true,
            dateMMYYYY: true
        };
        // Apply rules to all inputs with the class 'dateMMYYYY'
        $(".additional_liens_date").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                dateMMYYYY: "Please enter a valid date in the format MM/YYYY."
            };
        });
    }

    if(formId=='client_property_step2'){

       
        const form = document.getElementById(formId);

        // Track validity
        let isValid = true;

        // Group radios by name
        const radioGroups = {};
        const radios = form.querySelectorAll('input[type="radio"]');

        radios.forEach(radio => {
            const name = radio.name;
            if (!radioGroups[name]) {
                radioGroups[name] = [];
            }
            radioGroups[name].push(radio);
        });

        // Validate each group
        Object.keys(radioGroups).forEach(groupName => {
            const group = radioGroups[groupName];
            const isGroupChecked = group.some(radio => radio.checked);

            group.forEach(radio => {
                const label = form.querySelector(`label[for="${radio.id}"]`);
                if (label) {
                    label.classList.toggle('isRadioError', !isGroupChecked);
                }
            });

            if (!isGroupChecked) {
                isValid = false;

                // Add error label only if not already added
                const firstRadio = group[0];
                const container = firstRadio.closest('.custom-radio-group');
                const errorId = `${firstRadio.name}-error`;

                if (container && !form.querySelector(`#${CSS.escape(errorId)}`)) {
                    const errorLabel = document.createElement('label');
                    errorLabel.className = 'error';
                    errorLabel.id = errorId;
                    errorLabel.htmlFor = firstRadio.name;
                    errorLabel.textContent = 'This field is required.';

                    container.after(errorLabel); // Place error after the group
                }
            } else {
                // Remove existing error label if group is now valid
                const errorLabel = form.querySelector(`label.error[for="${CSS.escape(groupName)}"]`);
                if (errorLabel) errorLabel.remove();
            }
        });

    } else {
         const form = document.getElementById(formId);

        // Get all groups of radio buttons within the form
        const radioGroups = {};
        const radios = form.querySelectorAll('input[type="radio"]');

        radios.forEach(radio => {
            const name = radio.name;
            if (!radioGroups[name]) {
            radioGroups[name] = [];
            }
            radioGroups[name].push(radio);
        });


        // Check if each group has one checked radio
        Object.keys(radioGroups).forEach(groupName => {
            const group = radioGroups[groupName];
            const isGroupChecked = group.some(radio => radio.checked);

            group.forEach(radio => {
            const label = form.querySelector(`label[for="${radio.id}"]`);
            if (label) {
                label.classList.toggle('isRadioError', !isGroupChecked);
            }
            });

            if (!isGroupChecked) {
            isValid = false;
            }
        });
    }

}

// Codebtor Functions
/**
 * Already saved codebtor
 */
function alreadySavedCodebtor(thisObj) {
    var selectedOption      = $(thisObj).find('option:selected');
    var codebtor_name       = selectedOption.data('cname');
    var codebtor_address    = selectedOption.data('address');
    var codebtor_city       = selectedOption.data('city');
    var codebtor_state      = selectedOption.data('state');
    var codebtor_zip        = selectedOption.data('zip');

    var container           = $(thisObj).closest('.codebtor-tab');

    container.find('.cod_name').val(codebtor_name);
    container.find('.cod_address').val(codebtor_address);
    container.find('.cod_city').val(codebtor_city);
    container.find('.cod_state').val(codebtor_state);
    container.find('.cod_zip').val(codebtor_zip);
};

// Bank Account Functions
/**
 * Check bank account inputs
 */
function checkBankAccInputs() {

    // const elements = document.querySelectorAll('.bank-acc-input:not(.hide-data .bank-acc-input)');
    const elements = Array.from(document.querySelectorAll('.bank-acc-input')).filter(el => {
        return !el.closest('.hide-data');
    });
    
    let allFilled = true;
    let bankButton = document.querySelector('.bank-add-more-btn');
    let firstEmptyElement = null;  
    let transaction_enabled = $("#bank-addmore-button").attr('data-transaction-enabled');

    elements.forEach(element => {
        let isEmpty = false;
        if (element.type === 'radio') {
            const radioGroup = document.getElementsByName(element.name);
            const groupChecked = Array.from(radioGroup).some(radio => radio.checked);
            
            radioGroup.forEach(radio => {
                const label = document.querySelector(`label[for="${radio.id}"]`);
                if (!groupChecked) {
                    isEmpty = true;
                    radio.classList.add("error");
                    if (label) label.classList.add("error");
                } else {
                    radio.classList.remove("error");
                    if (label) label.classList.remove("error");
                }
            });
        } else if (element.tagName.toLowerCase() === 'select') {
            if (element.value.trim() === '') {
                isEmpty = true;
            }
        } else {
            if (element.value.trim() === '') {
                isEmpty = true;
            }
        }

        if (isEmpty) {
            allFilled = false;
            element.classList.add("error");
            if (!firstEmptyElement) {
                firstEmptyElement = element;
            }
        } else {
            element.classList.remove("error");
        }
    });

    if (firstEmptyElement) {
        firstEmptyElement.focus();
    }

    if (allFilled) {
        bankButton.classList.remove("bg-gray-imp");
        bankButton.setAttribute("onclick", "bank_addmore("+transaction_enabled+"); return false;");
    } else {
        bankButton.classList.add("bg-gray-imp");
        bankButton.setAttribute("onclick", "handleBankButtonClick(this);");
    }
}

/**
 * Store previous value for validation
 */
/**
 * Store previous value
 */
function storePreviousValue(thisObj) {
    $(thisObj).attr('data-previousvalue', $(thisObj).val());
};

/**
 * Check if three months common
 */
function isThreeMonthsCommon(selected_value, class_name) {
    if (selected_value == 'no') {
        $("." + class_name).addClass("hide-data");
        $("." + class_name).find(".price-field").each(function () {
            $(this).val("");
        });
    }
    if (selected_value == 'yes') {
        $("." + class_name).removeClass("hide-data");
    }
}

/**
 * Common toggle own by
 */
function common_toggle_own_by(value, obj) {
    var parentDiv = $(obj).closest(".debt_tax_own_by");
    var targetDiv = parentDiv.siblings(".debt_tax_codebtor_cosigner_data");
    if (value == 2 || value == 4) {
        targetDiv.removeClass("hide-data").show();
    } else if (value == 1 || value == 3) {
        targetDiv.addClass("hide-data").hide();
    }

    parentDiv.find("label").removeClass("active");
    $(obj).addClass("active");
}

/**
 * Toggle name to law suit
 */
function toggleNameToLawSuit(checkbox) {
    const formGroup = checkbox.closest('.form-group');
    const input = formGroup.querySelector('.case_title');
    if (!input) return;

    // Get all checked names in this form group
    const checkedNames = Array.from(
        formGroup.querySelectorAll('.form-check-input:checked')
    ).map(cb => cb.getAttribute('data-name').trim());

    // Extract the base case title (everything before " V.")
    let baseTitle = input.value.split(" V.")[0].trim();

    // Rebuild the title
    if (checkedNames.length > 0) {
        input.value = `${baseTitle} V. ${checkedNames.join(', ')}`;
    } else {
        input.value = baseTitle; // reset to base if no boxes checked
    }
}

/**
 * Common toggle function for showing/hiding elements
 * @param {string} value - 'yes' or 'no'
 * @param {string} elementId - Element ID to toggle
 */
function common_toggle_fn(value, elementId) {
    if (value === 'yes') {
        $('#' + elementId).removeClass('hide-data').addClass('show-data');
    } else {
        $('#' + elementId).removeClass('show-data').addClass('hide-data');
    }
};

// Export functions for backward compatibility
window.updateMonthYearDateFormatInput = updateMonthYearDateFormatInput;
window.ValidateMonthYearDateInput = ValidateMonthYearDateInput;
window.isValidMMYYYY = isValidMMYYYY;
window.isNotFutureDate = isNotFutureDate;
window.initializeDatepicker = initializeDatepicker;
window.showConfirmation = showConfirmation;
window.checkUnknown = checkUnknown;
window.selectNoToAbove = selectNoToAbove;
window.setBorderLabel = setBorderLabel;
window.potentialClaimTypeChanged = potentialClaimTypeChanged;
window.reindexElements = reindexElements;
window.reindexCircleNoElements = reindexCircleNoElements;
window.remove_div_common = remove_div_common;
window.seperate_remove_div_common = seperate_remove_div_common;
window.edit_div_common = edit_div_common;
window.seperate_save = seperate_save;
window.makeSeperateSaveCall = makeSeperateSaveCall;
window.numberFormatField = numberFormatField;
window.checkYear = checkYear;
window.checkValue = checkValue;
window.is_editable = is_editable;
window.revalidateFormWithMonthYear = revalidateFormWithMonthYear;
window.validateFormIds = validateFormIds;
window.alreadySavedCodebtor = alreadySavedCodebtor;
window.checkBankAccInputs = checkBankAccInputs;
window.storePreviousValue = storePreviousValue;
window.isThreeMonthsCommon = isThreeMonthsCommon;
window.common_toggle_own_by = common_toggle_own_by;
window.toggleNameToLawSuit = toggleNameToLawSuit;
window.common_toggle_fn = common_toggle_fn;