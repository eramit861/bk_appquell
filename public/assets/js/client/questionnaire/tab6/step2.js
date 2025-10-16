/**
 * Tab 6 - Step 2: Financial Affairs Page 2
 * Income sections - YTD income for current year, last year, year before
 */

// ==================== NEGATIVE VALUE FUNCTIONS ====================

/**
 * Allow negative value in income fields
 */
window.allowNegativeValue = function(element) {
    if ($(element).is(':checked') && $(element).val() == 0) {
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").removeClass('price-field');
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").addClass('negative-price-field');
    } else {
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").addClass('price-field');
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").removeClass('negative-price-field');
    }
};

/**
 * Allow negative value for YTD income
 */
window.allowNegativeValueYTD = function(element, elementValue) {
    const $input = $(element).closest('.row').find("input[type='number']");

    if (elementValue == 0) {
        $input.removeClass('price-field').addClass('negative-price-field');
    } else {
        $input.removeClass('negative-price-field').addClass('price-field');
    }
};

// ==================== INCOME ROW MANAGEMENT ====================

/**
 * Add more income row
 */
window.addMoreIncomeRow = function(rowClass, incomeType) {
    const rowCount = $(`.${rowClass}`).length;
    if (rowCount >= 6) {
        alert("You can only add a maximum of 6 income rows for this type.");
        return;
    }

    const $lastRow = $(`.${rowClass}:last`);

    if ($lastRow.length) {
        const $newRow = $lastRow.clone();
        $newRow.find('input, select').each(function() {
            const $element = $(this);
            const name = $element.attr('name');

            if (name) {
                const match = name.match(/\[(\d+)\]/);
                if (match) {
                    const currentIndex = parseInt(match[1], 10);
                    const newIndex = currentIndex + 1;

                    const newName = name.replace(/\[(\d+)\]/, `[${newIndex}]`);
                    $element.attr('name', newName);

                    if ($element.is('input')) {
                        $element.val('');
                    } else if ($element.is('select')) {
                        $element.val('11');
                        $element.next("div.other_income").addClass("hide-data");
                    }
                }
            }
        });

        $lastRow.after($newRow);
        updateDeleteIcons();
    }
};

/**
 * Delete income row
 */
window.deleteIncomeRow = function(element, rowClass = '') {
    if (rowClass !== '') {
        $(element).closest('.' + rowClass).remove();
    } else {
        $(element).closest('tr').remove();
    }

    resetRowIndices('current_year_row');
    resetRowIndices('last_year_row');
    resetRowIndices('last_before_year_row');
    resetRowIndices('spouse_current_year_row');
    resetRowIndices('spouse_last_year_row');
    resetRowIndices('spouse_last_before_year_row');

    updateDeleteIcons();
};

/**
 * Update delete icons visibility
 */
function updateDeleteIcons() {
    $('.current_year_row').each(function() {
        const sectionRows = $('.current_year_row');
        toggleDeleteIcon(sectionRows);
    });
    $('.last_year_row').each(function() {
        const sectionRows = $('.last_year_row');
        toggleDeleteIcon(sectionRows);
    });
    $('.last_before_year_row').each(function() {
        const sectionRows = $('.last_before_year_row');
        toggleDeleteIcon(sectionRows);
    });
    $('.spouse_current_year_row').each(function() {
        const sectionRows = $('.spouse_current_year_row');
        toggleDeleteIcon(sectionRows);
    });
    $('.spouse_last_year_row').each(function() {
        const sectionRows = $('.spouse_last_year_row');
        toggleDeleteIcon(sectionRows);
    });
    $('.spouse_last_before_year_row').each(function() {
        const sectionRows = $('.spouse_last_before_year_row');
        toggleDeleteIcon(sectionRows);
    });
}

/**
 * Toggle delete icon based on row count
 */
function toggleDeleteIcon(rows) {
    if (rows.length <= 1) {
        rows.find('.delete-icon').hide();
    } else {
        rows.find('.delete-icon').show();
    }
}

/**
 * Reset row indices after deletion
 */
function resetRowIndices(rowClass) {
    $(`.${rowClass}`).each(function(index) {
        $(this).find('input, select').each(function() {
            const name = $(this).attr('name');
            if (name) {
                $(this).attr('name', name.replace(/\[\d+\]/, `[${index}]`));
            }
        });
    });
}

/**
 * Initialize income management
 */
function initializeIncomeManagement() {
    updateDeleteIcons();
    
    var total_amount_income = (window.__tab6Data && window.__tab6Data.totalAmountIncome) ? window.__tab6Data.totalAmountIncome : 'null';
    if (total_amount_income == 'null') {
        $("#total-amount-income_yes").trigger("click");
        $("#total-amount-income-data").removeClass('hide-data');
    }
}

// ==================== INITIALIZATION ====================

$(function() {
    // Initialize form validation
    initializeFormValidation();
    
    // Initialize event handlers
    initializeEventHandlers();
    
    // Initialize payment calculations
    initializePaymentCalculations();
    
    // Initialize income management
    initializeIncomeManagement();
});

// Export functions for backward compatibility
window.initializeFormValidation = initializeFormValidation;
window.initializeEventHandlers = initializeEventHandlers;
window.initializePaymentCalculations = initializePaymentCalculations;
window.initializeIncomeManagement = initializeIncomeManagement;
window.updateDeleteIcons = updateDeleteIcons;
window.resetRowIndices = resetRowIndices;
window.toggleDeleteIcon = toggleDeleteIcon;

