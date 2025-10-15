// Tab6 Financial Affairs Questionnaire JavaScript
// This file contains all JavaScript functionality for the financial affairs questionnaire

$(function() {
    // Initialize form validation
    initializeFormValidation();
    
    // Initialize event handlers
    initializeEventHandlers();
    
    // Initialize autocomplete functionality
    initializeAutocomplete();
    
    // Initialize payment calculations
    initializePaymentCalculations();
    
    // Initialize income management
    initializeIncomeManagement();
});

// Initialize form validation
function initializeFormValidation() {
    if ($("#client_financial_affairs").length) {
        $("#client_financial_affairs").validate({
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

// Initialize event handlers
function initializeEventHandlers() {
    // Agency location autocomplete
    $(document).on('input', ".agency_location", function(e) {
        setupCourthouseAutocomplete($(this), 'list_lawsuits_data');
    });

    // Agency location autocomplete (alternative)
    $(document).on('input', ".agency_location_autocomplete", function(e) {
        setupCourthouseAutocomplete($(this), 'list_lawsuits_data');
    });

    // Property repossession address autocomplete
    $(document).on('input', ".property_repossessed_address", function(e) {
        setupCreditorAutocomplete($(this), 'property_repossessed_data');
    });

    // Setoffs creditor address autocomplete
    $(document).on('input', ".setoffs_creditor_address", function(e) {
        setupCreditorAutocomplete($(this), 'setoffs_creditor_data');
    });
}

// Initialize autocomplete functionality
function initializeAutocomplete() {
    // This is handled in initializeEventHandlers
}

// Initialize payment calculations
function initializePaymentCalculations() {
    $(document).on('input', ".payment_1, .payment_2, .payment_3", function(e) {
        var dataIndex = $(e.target).data('index');
        var pay1 = parseFloat($("input[name='primarily_consumer_debets_data[payment_1][" + dataIndex + "]']").val()) || 0.00;
        var pay2 = parseFloat($("input[name='primarily_consumer_debets_data[payment_2][" + dataIndex + "]']").val()) || 0.00;
        var pay3 = parseFloat($("input[name='primarily_consumer_debets_data[payment_3][" + dataIndex + "]']").val()) || 0.00;
        var total = parseFloat(pay1 + pay2 + pay3);
        var convertedValue = parseFloat(total).toFixed(2);
        $("input[name='primarily_consumer_debets_data[total_amount_paid][" + dataIndex + "]']").val(convertedValue);
    });
}

// Initialize income management
function initializeIncomeManagement() {
    updateDeleteIcons();
    
    var total_amount_income = (window.__tab6Data && window.__tab6Data.totalAmountIncome) ? window.__tab6Data.totalAmountIncome : 'null';
    if (total_amount_income == 'null') {
        $("#total-amount-income_yes").trigger("click");
        $("#total-amount-income-data").removeClass('hide-data');
    }
}

// Show tax paying popup
function showTaxPayingPopup(url) {
    laws.ajax(url, '', function(response) {
        laws.updateFaceboxContent(response, 'productQuickView');
    });
}

// Add loans popup
function addLoansPopup(url, type) {
    laws.ajax(url, {
        type: type
    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width');
    });
}

// Did spouse live with you function
function didSpouseLiveWithYou(checkValue, index) {
    if (checkValue == 1) {
        $('.spouse-live-section-' + index).removeClass('hide-data');
    }
    if (checkValue == 0) {
        $('.spouse-live-section-' + index).addClass('hide-data');
    }
}

// Allow negative value function
function allowNegativeValue(element) {
    if ($(element).is(':checked') && $(element).val() == 0) {
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").removeClass('price-field');
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").addClass('negative-price-field');
    } else {
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").addClass('price-field');
        $(element).parent('div').parent('div').parent('td').parent('tr').find("input[type='number']").removeClass('negative-price-field');
    }
}

// Allow negative value YTD function
function allowNegativeValueYTD(element, elementValue) {
    const $input = $(element).closest('.row').find("input[type='number']");

    if (elementValue == 0) {
        $input.removeClass('price-field').addClass('negative-price-field');
    } else {
        $input.removeClass('negative-price-field').addClass('price-field');
    }
}

// Add more income row function
function addMoreIncomeRow(rowClass, incomeType) {
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
}

// Delete income row function
function deleteIncomeRow(element, rowClass = '') {
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
}

// Update delete icons function
function updateDeleteIcons() {
    // Hide or show delete icons based on row count in each section
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

// Toggle delete icon function
function toggleDeleteIcon(rows) {
    if (rows.length <= 1) {
        rows.find('.delete-icon').hide();
    } else {
        rows.find('.delete-icon').show();
    }
}

// Reset row indices function
function resetRowIndices(rowClass) {
    $(`.${rowClass}`).each(function(index) {
        $(this).find('input, select').each(function() {
            const name = $(this).attr('name');
            if (name) {
                // Update the name attribute to reflect the new index
                $(this).attr('name', name.replace(/\[\d+\]/, `[${index}]`));
            }
        });
    });
}

// Setup courthouse autocomplete
function setupCourthouseAutocomplete(element, baseName) {
    element.autocomplete({
        'classes': {
            "ui-autocomplete": "custom-ui-autocomplete"
        },
        'source': function(request, response) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: window.__tab6Routes?.courthouseSearch || '',
                data: {
                    keyword: encodeURIComponent(request['term'])
                },
                dataType: 'json',
                type: 'post',
                success: function(json) {
                    json = json.data;
                    response($.map(json, function(item) {
                        return {
                            label: item['placeholder'],
                            value: item['value'],
                            address: item['address'],
                            city: item['city'],
                            state: item['state'],
                            zip: item['zip'],
                        };
                    }));
                },
            });
        },
        select: function(event, ui) {
            $(this).val(ui.item.label);
            var n = $(this).attr('name');
            var index = n.slice(-3);
            index = index.replace('[', '');
            index = index.replace(']', '');
            index = parseInt(index);
            $("input[name='" + baseName + "[agency_location][" + index + "]']").val(ui.item.label);
            $("input[name='" + baseName + "[agency_street][" + index + "]']").val(ui.item.address);
            $("input[name='" + baseName + "[agency_city][" + index + "]']").val(ui.item.city);
            $("select[name='" + baseName + "[agency_state][" + index + "]']").val(ui.item.state);
            $("input[name='" + baseName + "[agency_zip][" + index + "]']").val(ui.item.zip);
        }
    });
}

// Setup creditor autocomplete
function setupCreditorAutocomplete(element, baseName) {
    element.autocomplete({
        'classes': {
            "ui-autocomplete": "custom-ui-autocomplete"
        },
        'source': function(request, response) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: window.__tab6Routes?.creditorSearch || '',
                data: {
                    keyword: encodeURIComponent(request['term'])
                },
                dataType: 'json',
                type: 'post',
                success: function(json) {
                    json = json.data;
                    response($.map(json, function(item) {
                        return {
                            label: item['placeholder'],
                            value: item['value'],
                            address: item['address'],
                            city: item['city'],
                            state: item['state'],
                            zip: item['zip'],
                        };
                    }));
                },
            });
        },
        select: function(event, ui) {
            $(this).val(ui.item.label);
            var n = $(this).attr('name');
            var index = n.slice(-3);
            index = index.replace('[', '');
            index = index.replace(']', '');
            index = parseInt(index);
            
            // Handle different base names
            if (baseName === 'property_repossessed_data') {
                $("input[name='" + baseName + "[creditor_address][" + index + "]']").val(ui.item.label);
                $("input[name='" + baseName + "[creditor_street][" + index + "]']").val(ui.item.address);
                $("input[name='" + baseName + "[creditor_city][" + index + "]']").val(ui.item.city);
                $("select[name='" + baseName + "[creditor_state][" + index + "]']").val(ui.item.state);
                $("input[name='" + baseName + "[creditor_zip][" + index + "]']").val(ui.item.zip);
            } else if (baseName === 'setoffs_creditor_data') {
                $("input[name='" + baseName + "[creditors_address][" + index + "]']").val(ui.item.label);
                $("input[name='" + baseName + "[creditor_street][" + index + "]']").val(ui.item.address);
                $("input[name='" + baseName + "[creditor_city][" + index + "]']").val(ui.item.city);
                $("select[name='" + baseName + "[creditor_state][" + index + "]']").val(ui.item.state);
                $("input[name='" + baseName + "[creditor_zip][" + index + "]']").val(ui.item.zip);
            }
        }
    });
}

// Export functions to global scope for backward compatibility
window.showTaxPayingPopup = showTaxPayingPopup;
window.addLoansPopup = addLoansPopup;
window.didSpouseLiveWithYou = didSpouseLiveWithYou;
window.allowNegativeValue = allowNegativeValue;
window.allowNegativeValueYTD = allowNegativeValueYTD;
window.addMoreIncomeRow = addMoreIncomeRow;
window.deleteIncomeRow = deleteIncomeRow;
