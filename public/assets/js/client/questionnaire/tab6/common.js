/**
 * Tab 6 - Common Financial Affairs Utilities
 * Shared functions for all SOFA (Statement of Financial Affairs) steps
 */

// ==================== FORM VALIDATION ====================

/**
 * Initialize form validation
 */
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

// ==================== EVENT HANDLERS ====================

/**
 * Initialize event handlers
 */
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

// ==================== AUTOCOMPLETE FUNCTIONS ====================

/**
 * Setup courthouse autocomplete
 */
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

/**
 * Setup creditor autocomplete
 */
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

// ==================== PAYMENT CALCULATIONS ====================

/**
 * Initialize payment calculations
 */
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

// ==================== SPOUSE FUNCTIONS ====================

/**
 * Did spouse live with you toggle
 */
window.didSpouseLiveWithYou = function(checkValue, index) {
    if (checkValue == 1) {
        $('.spouse-live-section-' + index).removeClass('hide-data');
    }
    if (checkValue == 0) {
        $('.spouse-live-section-' + index).addClass('hide-data');
    }
};

// ==================== POPUP FUNCTIONS ====================

/**
 * Show tax paying popup
 */
window.showTaxPayingPopup = function(url) {
    laws.ajax(url, '', function(response) {
        laws.updateFaceboxContent(response, 'productQuickView');
    });
};

/**
 * Add loans popup
 */
window.addLoansPopup = function(url, type) {
    laws.ajax(url, {
        type: type
    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width');
    });
};

// ==================== INITIALIZATION ====================

$(function() {
    // Initialize form validation
    initializeFormValidation();
    
    // Initialize event handlers
    initializeEventHandlers();
    
    // Initialize payment calculations
    initializePaymentCalculations();
});

// Export functions for backward compatibility
window.initializeFormValidation = initializeFormValidation;
window.initializeEventHandlers = initializeEventHandlers;
window.initializePaymentCalculations = initializePaymentCalculations;
window.setupCourthouseAutocomplete = setupCourthouseAutocomplete;
window.setupCreditorAutocomplete = setupCreditorAutocomplete;

