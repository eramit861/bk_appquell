/**
 * Tab 2 - Step 4: Financial Assets
 * Bank accounts, retirement, tax refunds, VPC accounts, etc.
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 4 - Auto-click radio buttons if no data
 */
function initializePropertyStep4() {
    var pstatus = (window.tab2Data && window.tab2Data.financialAssetsStatus) ? window.tab2Data.financialAssetsStatus : 0;
    if (pstatus == 0) {
        $("#property-part-d input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

/**
 * Initialize Property Step 4 Continue
 */
function initializePropertyStep4Continue() {
    var pstatus = (window.tab2Data && window.tab2Data.financialAssetsStatus) ? window.tab2Data.financialAssetsStatus : 0;
    if (pstatus == 0) {
        $("#property-part-d input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

// ==================== BUSINESS ACCOUNT FUNCTIONS ====================

/**
 * Show/hide business name div based on account type
 */
window.showHideBusinessNameDiv = function(element, index) {
    const targetDiv = $('.bank_business_name_div_' + index);
    const selectedValue = $(element).val();
    if (selectedValue === "1") {
        targetDiv.addClass('hide-data');
    } else {
        targetDiv.removeClass('hide-data');
    }
};

window.setBusinessValue = function(value) {
    if (value == 2) {
        hasValueTwo = true;
    }
};

window.handleS4ContinueSubmit = function(hasAnyBusiness, event) {
    event.preventDefault();
    let hasValueTwo = false;
    if (hasAnyBusiness) {
        $('.bank_personal_business_account').each(function () {
            if ($(this).val() == 2) {
                hasValueTwo = true;
                return false;
            }
        });

        if (!hasValueTwo) {
            $('html, body').animate({
                scrollTop: $('#checking_account_items_data_question').offset().top
            }, 500);
            openFlagPopup2('hasAnyBusiness-popup', 'No', true);
        } else {
            $('#client_property_step4_continue').submit();
        }
    } else {
        $('#client_property_step4_continue').submit();
    }
};

// ==================== RETIREMENT ACCOUNT FUNCTIONS ====================

/**
 * Check unknown retirement checkbox
 */
window.checkUnknownRetirement = function(thisobj, index) {
    if (thisobj.checked == true) {
        $('.retirement_pension_property_value_is_unknown_' + index).removeClass('required');
        $('.retirement_pension_property_value_is_unknown_' + index).prop('disabled', true);
        $('.retirement_pension_property_value_is_unknown_' + index).val('');
    } else {
        $('.retirement_pension_property_value_is_unknown_' + index).addClass('required');
        $('.retirement_pension_property_value_is_unknown_' + index).prop('disabled', false);
        $('.retirement_pension_property_value_is_unknown_' + index).val('');
    }
};

// ==================== TAX REFUND FUNCTIONS ====================

/**
 * Select all / deselect all years
 */
window.setSelectAll = function(thisObj, index) {
    var inputName = $(thisObj).data('inputname');
    var inputFor = $(thisObj).data('inputfor');
    if ($(thisObj).is(':checked')) {
        $('.option').prop('checked', true);
        $(".select-text-" + index).html('Deselect');
    } else {
        $('.option').prop('checked', false);
        $(".select-text-" + index).html('Select');
    }
    setSpaceSeperatedString(inputName, inputFor);
};

/**
 * Handle individual year selection
 */
window.setJustOne = function(thisObj, index) {
    var inputName = $(thisObj).data('inputname');
    var inputFor = $(thisObj).data('inputfor');
    var a = $("input[type='checkbox'].justone");
    if (a.length == a.filter(":checked").length) {
        $('.selectall').prop('checked', true);
        $(".select-text-" + index).html(' Deselect');
    } else {
        $('.selectall').prop('checked', false);
        $(".select-text-" + index).html(' Select');
    }
    setSpaceSeperatedString(inputName, inputFor);
};

/**
 * Set space-separated string of selected years
 */
window.setSpaceSeperatedString = function(inputName, inputFor) {
    var checkedYears = [];
    $("input[type='checkbox'].justone." + inputFor + ":checked").each(function () {
        checkedYears.push($(this).val());
    });
    checkedYears.sort((a, b) => b - a);
    var spaceSeparatedString = checkedYears.join(" ");
    $("input[name='" + inputName + "']").val(spaceSeparatedString);
};

/**
 * Select tax refund type - prevent duplicates
 */
window.selectTaxRefundType = function(thisObj) {
    var selectedValue = $(thisObj).find(":selected").val();
    var selectedValueText = $(thisObj).find(":selected").text();
    var type = $('#tax_refunds_MainRow .tax_refunds_description');
    var isDuplicate = false;

    $(type).each(function () {
        if (this !== thisObj && $(this).find(":selected").val() === selectedValue) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        var previousValue = $(thisObj).data('previousvalue');
        $(thisObj).val(previousValue);
        $(thisObj).change();
    }
};

// ==================== VPC ACCOUNT FUNCTIONS ====================

/**
 * Select VPC account type - prevent duplicates
 */
window.selectVPCAccount = function(thisObj) {
    var selectedValue = $(thisObj).find(":selected").val();
    var selectedValueText = $(thisObj).find(":selected").text();
    var account_type = $('#account_items_data .account_type');
    var isDuplicate = false;

    $(account_type).each(function () {
        if (this !== thisObj && $(this).find(":selected").val() === selectedValue) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        var previousValue = $(thisObj).data('previousvalue');
        $(thisObj).val(previousValue);
        $(thisObj).change();
    } else {
        var index = $(thisObj).data('index');
        showHideGuideVidDiv(index, selectedValue);
    }
};

/**
 * Select VPC alimony account - prevent duplicates
 */
window.selectVPCAAlimonyccount = function(thisObj) {
    var selectedValue = $(thisObj).find(":selected").val();
    var selectedValueText = $(thisObj).find(":selected").text();
    var account_type = $('#alimony_child_data .account_type');
    var isDuplicate = false;

    $(account_type).each(function () {
        if (this !== thisObj && $(this).find(":selected").val() === selectedValue) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        var previousValue = $(thisObj).data('previousvalue');
        $(thisObj).val(previousValue);
        $(thisObj).change();
    }
};

// Export functions for backward compatibility
window.initializePropertyStep4 = initializePropertyStep4;
window.initializePropertyStep4Continue = initializePropertyStep4Continue;

