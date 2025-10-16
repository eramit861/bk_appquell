/**
 * Tab 5 & Tab 7 - Common Expense Utilities
 * Shared functions for household and spouse expenses
 */

// ==================== FORM VALIDATION ====================

/**
 * Initialize form validation
 */
function initializeFormValidation() {
    if ($("#client_expenses").length) {
        $("#client_expenses").validate({
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
                $(element).parents(".input-group").next('label').remove();
            },
        });
    }
}

// ==================== EVENT HANDLERS ====================

/**
 * Initialize event handlers
 */
function initializeEventHandlers() {
    // Remove installment payments form (Tab5)
    $('.removeInstallmentPaymentsForm').click(function() {
        let x = $(document).find(".installment_payments").length;
        if (x < 2) {
            alert("You can't remove last element")
        } else {
            $(document).find(".installment_payments").last().remove();
        }
    });

    // Remove installment payments form (Tab7)
    $('.removeInstallmentPaymentsForm11').click(function() {
        let x = $(document).find(".installment_payments").length;
        if (x < 2) {
            alert("You can't remove last element")
        } else {
            $(document).find(".installment_payments").last().remove();
        }
    });

    // Remove tax bills form
    $('.removeTaxbillsForm').click(function() {
        let x = $(document).find(".tax_bills").length;
        if (x < 2) {
            alert("You can't remove last element")
        } else {
            $('#tax_bills1').remove();
        }
    });

    // Remove other insurance form
    $('.removeOtherInsuranceForm').click(function() {
        let x = $(document).find(".other_insurance").length;
        if (x < 2) {
            alert("You can't remove last element")
        } else {
            $('#other_insurance1').remove();
        }
    });

    // Remove monthly amount form
    $('.removeMonthyAmountForm').click(function() {
        let x = $(document).find(".monthly_amount").length;
        if (x < 2) {
            alert("You can't remove last element")
        } else {
            $('#monthly_amount1').remove();
        }
    });

    // Expense prices keyup handler
    $(document).on("keyup", ".expense_prices", function(evt) {
        sumexpesnes();
    });

    // Radio button change handler
    $(document).on("change", "input[type=radio]", function(evt) {
        sumexpesnes();
    });
}

// ==================== CALCULATIONS ====================

/**
 * Initialize calculations
 */
function initializeCalculations() {
    updateAveragePrice();
    sumexpesnes();
}

/**
 * Remove relationship form
 */
window.removeRelationshipForm = function() {
    let x = $(document).find(".all_dependents_form").length;
    if (x < 2) {
        alert("You can't remove last element")
    } else {
        $(document).find(".all_dependents_form").last().remove();
    }
};

/**
 * Update average price calculation based on household size
 */
window.updateAveragePrice = function(no = '') {
    var client_type = (window.__tab5Data && window.__tab5Data.clientType) ? window.__tab5Data.clientType : '';
    var averagePriceListJSON = (window.__tab5Data && window.__tab5Data.averagePriceList) ? window.__tab5Data.averagePriceList : [];
    
    var defaultUsers, foodHouseCost, apparelCost, personalCareCost, otherExpenseCost, moreTimes;

    var count = $('.all_dependents_form').length;
    if (no === '1') {
        count = 0;
    }
    if ($("#all_dependents").hasClass('hide-data')) {
        count = 0;
    }

    // Fetching objects from averagePriceListJSON
    var foodObject = averagePriceListJSON.find(obj => obj.Expense_Type === 'Food ');
    var housekeepingObject = averagePriceListJSON.find(obj => obj.Expense_Type === 'Housekeeping supplies');
    var apparelObject = averagePriceListJSON.find(obj => obj.Expense_Type === 'Apparel & services');
    var personalCareObject = averagePriceListJSON.find(obj => obj.Expense_Type === 'Personal care products & services');
    var miscExpenseObject = averagePriceListJSON.find(obj => obj.Expense_Type === 'Miscellaneous');

    // Determine defaultUsers
    if (client_type === '1') {
        defaultUsers = 1 + count;
    } else if (client_type === '2' || client_type === '3') {
        defaultUsers = 2 + count;
    }

    switch (defaultUsers) {
        case 1:
            foodHouseCost = foodObject['OnePersonCost'] + housekeepingObject['OnePersonCost'];
            apparelCost = apparelObject['OnePersonCost'];
            personalCareCost = personalCareObject['OnePersonCost'];
            otherExpenseCost = miscExpenseObject['OnePersonCost'];
            break;
        case 2:
            foodHouseCost = foodObject['TwoPersonCost'] + housekeepingObject['TwoPersonCost'];
            apparelCost = apparelObject['TwoPersonCost'];
            personalCareCost = personalCareObject['TwoPersonCost'];
            otherExpenseCost = miscExpenseObject['TwoPersonCost'];
            break;
        case 3:
            foodHouseCost = foodObject['ThreePersonCost'] + housekeepingObject['ThreePersonCost'];
            apparelCost = apparelObject['ThreePersonCost'];
            personalCareCost = personalCareObject['ThreePersonCost'];
            otherExpenseCost = miscExpenseObject['ThreePersonCost'];
            break;
        case 4:
            foodHouseCost = foodObject['FourPersonCost'] + housekeepingObject['FourPersonCost'];
            apparelCost = apparelObject['FourPersonCost'];
            personalCareCost = personalCareObject['FourPersonCost'];
            otherExpenseCost = miscExpenseObject['FourPersonCost'];
            break;
    }

    if (defaultUsers > 4) {
        moreTimes = (defaultUsers - 4);
        var foodCost = foodObject['FourPersonCost'] + (moreTimes * foodObject['AdditionalPersonCost']);
        var houseCost = housekeepingObject['FourPersonCost'] + (moreTimes * housekeepingObject['AdditionalPersonCost']);

        foodHouseCost = foodCost + houseCost;
        apparelCost = apparelObject['FourPersonCost'] + (moreTimes * apparelObject['AdditionalPersonCost']);
        personalCareCost = personalCareObject['FourPersonCost'] + (moreTimes * personalCareObject['AdditionalPersonCost']);
        otherExpenseCost = miscExpenseObject['FourPersonCost'] + (moreTimes * miscExpenseObject['AdditionalPersonCost']);
    }

    // Set HTML content
    $('.food_housekeeping_average_price').html(formatNumberToPrice(foodHouseCost));
    $('.apparel_average_price').html(formatNumberToPrice(apparelCost));
    $('.personal_care_average_price').html(formatNumberToPrice(personalCareCost));
    $('.other_expense_average_price').html(formatNumberToPrice(otherExpenseCost));
};

/**
 * Format number to price with commas
 */
window.formatNumberToPrice = function(data) {
    return data.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
};

/**
 * Sum all visible expenses
 */
window.sumexpesnes = function() {
    var expensesum = 0;
    $(".expense_prices").each(function() {
        if ($(this).is(":visible")) {
            expensesum += +$(this).val();
        }
    });
    $("#total_expenses").html(formatNumberToPrice(expensesum));
};

// ==================== INITIALIZATION ====================

$(function() {
    // Initialize form validation
    initializeFormValidation();
    
    // Initialize event handlers
    initializeEventHandlers();
    
    // Initialize calculations
    initializeCalculations();
});

// Export functions for backward compatibility
window.initializeFormValidation = initializeFormValidation;
window.initializeEventHandlers = initializeEventHandlers;
window.initializeCalculations = initializeCalculations;

