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
function showHideBusinessNameDiv(element, index) {
    const targetDiv = $('.bank_business_name_div_' + index);
    const selectedValue = $(element).val();
    if (selectedValue === "1") {
        targetDiv.addClass('hide-data');
    } else {
        targetDiv.removeClass('hide-data');
    }
};

function setBusinessValue(value) {
    if (value == 2) {
        hasValueTwo = true;
    }
};

function handleS4ContinueSubmit(hasAnyBusiness, event) {
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
function checkUnknownRetirement(thisobj, index) {
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
function setSelectAll(thisObj, index) {
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
function setJustOne(thisObj, index) {
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
function setSpaceSeperatedString(inputName, inputFor) {
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
function selectTaxRefundType(thisObj) {
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
function selectVPCAccount(thisObj) {
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
function selectVPCAAlimonyccount(thisObj) {
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

// ==================== FINANCIAL ASSET TOGGLE FUNCTIONS ====================

function getCashItems(value) {
    if (value == "yes") {
        document
            .getElementById("cash_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("cash_items_data").classList.add("hide-data");
    }
}

function getCheckingAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("checking_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("checking_account_items_data")
            .classList.add("hide-data");
    }
}

function getAccountItems(value) {
    if (value == "yes") {
        if (
            $(".cashVideo-0").hasClass("hide-data") &&
            $(".paypalVideo-0").hasClass("hide-data") &&
            $(".venmoVideo-0").hasClass("hide-data")
        ) {
            $(".paypalVideo-0").removeClass("hide-data");
        }
        $("#account_items_data").removeClass("hide-data");
    } else if (value == "no") {
        $("#account_items_data").addClass("hide-data");
    }
}

function getBrokerageItems(value) {
    if (value == "yes") {
        $("#brokerage_items_data").removeClass("hide-data");
    } else if (value == "no") {
        $("#brokerage_items_data").addClass("hide-data");
    }
}

function getSavingsAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("savings_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("savings_account_items_data")
            .classList.add("hide-data");
    }
}

function getCertificateDepositeItems(value) {
    if (value == "yes") {
        document
            .getElementById("certificate_of_deposit_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("certificate_of_deposit_items_data")
            .classList.add("hide-data");
    }
}

function getOtherFinacialAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_financial_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other_financial_account_items_data")
            .classList.add("hide-data");
    }
}

function getMutualFundsItems(value) {
    if (value == "yes") {
        document
            .getElementById("bonds_mutual_funds_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("bonds_mutual_funds_items_data")
            .classList.add("hide-data");
    }
}

function getGovernmentCoperateItems(value) {
    if (value == "yes") {
        document
            .getElementById("government_corporate_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("government_corporate_data")
            .classList.add("hide-data");
    }
}

function getRetirementPensionItems(value) {
    if (value == "yes") {
        document
            .getElementById("retirement_pension_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("retirement_pension_data")
            .classList.add("hide-data");
    }
}

function getPrepaymentsItems(value) {
    if (value == "yes") {
        document
            .getElementById("prepayments_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("prepayments_data").classList.add("hide-data");
    }
}

function getAnnuitiesItems(value) {
    if (value == "yes") {
        document.getElementById("annuities_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("annuities_data").classList.add("hide-data");
    }
}

function getEducationIRAItems(value) {
    if (value == "yes") {
        document
            .getElementById("education_IRA_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("education_IRA_data")
            .classList.add("hide-data");
    }
}

function getInterestPropertyItems(value) {
    if (value == "yes") {
        document
            .getElementById("interestin_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("interestin_property_data")
            .classList.add("hide-data");
    }
}

function getintellectualPropertyItems(value) {
    if (value == "yes") {
        document
            .getElementById("intellectual_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("intellectual_property_data")
            .classList.add("hide-data");
    }
}

function getGeneralIntangiblesItems(value) {
    if (value == "yes") {
        document
            .getElementById("genral_intangibles_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("genral_intangibles_data")
            .classList.add("hide-data");
    }
}

function getTaxRefundsItems(value) {
    if (value == "yes") {
        document
            .getElementById("tax_refunds_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("tax_refunds_data").classList.add("hide-data");
    }
}

function getAlimonyChildItems(value) {
    if (value == "yes") {
        document
            .getElementById("alimony_child_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("alimony_child_data")
            .classList.add("hide-data");
    }
}

function getUnpaidWagesItems(value) {
    if (value == "yes") {
        document
            .getElementById("unpaid_wages_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("unpaid_wages_data").classList.add("hide-data");
    }
}

function getLifeInsuranceItems(value) {
    if (value == "yes") {
        document
            .getElementById("life_insurance_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("life_insurance_data")
            .classList.add("hide-data");
    }
}

function getInsurancePoliciesItems(value) {
    if (value == "yes") {
        document
            .getElementById("insurance_policies_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("insurance_policies_data")
            .classList.add("hide-data");
    }
}

function getInheritancesBenefitsItems(value) {
    if (value == "yes") {
        document
            .getElementById("Inheritances_benefits_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("Inheritances_benefits_data")
            .classList.add("hide-data");
    }
}

function getPersonalInjuryItems(value) {
    if (value == "yes") {
        document
            .getElementById("personal_injury_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("personal_injury_data")
            .classList.add("hide-data");
    }
}

function getLawsuitsItems(value) {
    if (value == "yes") {
        document.getElementById("Lawsuits_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("Lawsuits_data").classList.add("hide-data");
    }
}

function getOtherClaimsItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_claims_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("other_claims_data").classList.add("hide-data");
    }
}

function getFinancialAssetItems(value) {
    if (value == "yes") {
        document
            .getElementById("financial_asset_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("financial_asset_data")
            .classList.add("hide-data");
    }
}

// Export functions for backward compatibility
window.initializePropertyStep4 = initializePropertyStep4;
window.initializePropertyStep4Continue = initializePropertyStep4Continue;
window.showHideBusinessNameDiv = showHideBusinessNameDiv;
window.setBusinessValue = setBusinessValue;
window.handleS4ContinueSubmit = handleS4ContinueSubmit;
window.checkUnknownRetirement = checkUnknownRetirement;
window.setSelectAll = setSelectAll;
window.setJustOne = setJustOne;
window.setSpaceSeperatedString = setSpaceSeperatedString;
window.selectTaxRefundType = selectTaxRefundType;
window.selectVPCAccount = selectVPCAccount;
window.selectVPCAAlimonyccount = selectVPCAAlimonyccount;
window.getCashItems = getCashItems;
window.getCheckingAccountItems = getCheckingAccountItems;
window.getAccountItems = getAccountItems;
window.getBrokerageItems = getBrokerageItems;
window.getSavingsAccountItems = getSavingsAccountItems;
window.getCertificateDepositeItems = getCertificateDepositeItems;
window.getOtherFinacialAccountItems = getOtherFinacialAccountItems;
window.getMutualFundsItems = getMutualFundsItems;
window.getGovernmentCoperateItems = getGovernmentCoperateItems;
window.getRetirementPensionItems = getRetirementPensionItems;
window.getPrepaymentsItems = getPrepaymentsItems;
window.getAnnuitiesItems = getAnnuitiesItems;
window.getEducationIRAItems = getEducationIRAItems;
window.getInterestPropertyItems = getInterestPropertyItems;
window.getintellectualPropertyItems = getintellectualPropertyItems;
window.getGeneralIntangiblesItems = getGeneralIntangiblesItems;
window.getTaxRefundsItems = getTaxRefundsItems;
window.getAlimonyChildItems = getAlimonyChildItems;
window.getUnpaidWagesItems = getUnpaidWagesItems;
window.getLifeInsuranceItems = getLifeInsuranceItems;
window.getInsurancePoliciesItems = getInsurancePoliciesItems;
window.getInheritancesBenefitsItems = getInheritancesBenefitsItems;
window.getPersonalInjuryItems = getPersonalInjuryItems;
window.getLawsuitsItems = getLawsuitsItems;
window.getOtherClaimsItems = getOtherClaimsItems;
window.getFinancialAssetItems = getFinancialAssetItems;

