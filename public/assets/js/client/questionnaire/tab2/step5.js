/**
 * Tab 2 - Step 5: Business Assets
 * Business-related property and assets
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 5 - Auto-click radio buttons if no data
 */
function initializePropertyStep5() {
    var pstatus = (window.tab2Data && window.tab2Data.businessAssetsStatus) ? window.tab2Data.businessAssetsStatus : 0;
    if (pstatus == 0) {
        $("#property-part-e input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

/**
 * Initialize Property Step 5 Continue
 */
function initializePropertyStep5Continue() {
    var pstatus = (window.tab2Data && window.tab2Data.businessAssetsStatus) ? window.tab2Data.businessAssetsStatus : 0;
    if (pstatus == 0) {
        $("#property-part-e input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

// ==================== ALIMONY/PROPERTY FUNCTIONS ====================

/**
 * Property unknown checkbox handler
 */
function propertyUnkown(thisobj) {
    if (thisobj.checked == true) {
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').val('');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').removeClass('required');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').prop('disabled', true);
    } else {
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').val('');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').addClass('required');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').prop('disabled', false);
    }
};


// ==================== EVENT HANDLERS ====================

/**
 * Income/Profit-Loss Calculation
 * Used for business profit/loss calculations
 */
$(document).on("keyup", ".income-price-field", function (evt) {
    var incomesum = 0;
    $(".income").each(function () {
        incomesum += +$(this).val();
    });

    var expensesum = 0;
    $(".expense").each(function () {
        expensesum += +$(this).val();
    });

    $(".total-expense").val(parseFloat(expensesum).toFixed(2));
    $(".total-profit-loss").val(parseFloat(incomesum - expensesum).toFixed(2));
});

// ==================== BUSINESS ASSET TOGGLE FUNCTIONS ====================

function getAccountsReceivableItems(value) {
    if (value == "yes") {
        document
            .getElementById("account_receivable_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("account_receivable_data")
            .classList.add("hide-data");
    }
}

function getOfficeEquipmentItems(value) {
    if (value == "yes") {
        document
            .getElementById("office_equipment_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("office_equipment_data")
            .classList.add("hide-data");
    }
}

function getMachineryTradeItems(value) {
    if (value == "yes") {
        document
            .getElementById("machinery_trade_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("machinery_trade_data")
            .classList.add("hide-data");
    }
}

function getBusinessInventoryItems(value) {
    if (value == "yes") {
        document
            .getElementById("business_inventory_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("business_inventory_data")
            .classList.add("hide-data");
    }
}

function getInterestsPartnershipsItems(value) {
    if (value == "yes") {
        document.getElementById("interests_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("interests_data").classList.add("hide-data");
    }
}

function getCustomerMailingItems(value) {
    if (value == "yes") {
        document
            .getElementById("customer_mailing_lists_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("customer_mailing_lists_data")
            .classList.add("hide-data");
    }
}

function getOtherBusimessItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_business_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other_business_data")
            .classList.add("hide-data");
    }
}

// Export functions for backward compatibility
window.initializePropertyStep5 = initializePropertyStep5;
window.initializePropertyStep5Continue = initializePropertyStep5Continue;
window.propertyUnkown = propertyUnkown;
window.getAccountsReceivableItems = getAccountsReceivableItems;
window.getOfficeEquipmentItems = getOfficeEquipmentItems;
window.getMachineryTradeItems = getMachineryTradeItems;
window.getBusinessInventoryItems = getBusinessInventoryItems;
window.getInterestsPartnershipsItems = getInterestsPartnershipsItems;
window.getCustomerMailingItems = getCustomerMailingItems;
window.getOtherBusimessItems = getOtherBusimessItems;

