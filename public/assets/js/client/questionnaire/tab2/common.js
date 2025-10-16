/**
 * Tab 2 - Common Property Utilities
 * Shared functions for all property steps
 */

// ==================== GLOBAL VARIABLES ====================

let showNoticePopup = false;
let hasValueTwo = false;
const selectedItems = new Map();

// ==================== INITIALIZATION ====================

$(function () {
    // Show notice popup if needed
    if (showNoticePopup == '1') {
        let noticeModal = document.getElementById('propertyNoticePromptModal');
        var propertyNoticeModal = new bootstrap.Modal(noticeModal);
        propertyNoticeModal.show();
    }

    // Initialize autocomplete for mortgage vehicle creditor names
    initializeMortgageAutocomplete();

    // Initialize form validation
    initializeFormValidation();

    // Initialize event handlers
    initializeEventHandlers();

    // Initialize payment calculations
    initializePaymentCalculations();
});

// ==================== AUTOCOMPLETE FUNCTIONS ====================

/**
 * Initialize mortgage/loan autocomplete
 */
function initializeMortgageAutocomplete() {
    // First loan autocomplete
    $(document).on('input', ".mortgage_vehicle_creditor_name", function (e) {
        setupAutocomplete($(this), 'property_resident[home_car_loan]');
    });

    // Second loan autocomplete
    $(document).on('input', ".loan2_vehicle_creditor_name", function (e) {
        setupAutocomplete($(this), 'property_resident[home_car_loan2]');
    });

    // Third loan autocomplete
    $(document).on('input', ".loan3_vehicle_creditor_name", function (e) {
        setupAutocomplete($(this), 'property_resident[home_car_loan3]');
    });

    // Vehicle creditor name autocomplete
    $(document).on('input', ".vehicle_creditor_name", function (e) {
        $(this).autocomplete({
            'classes': {
                "ui-autocomplete": "custom-ui-autocomplete"
            },
            'source': function (request, response) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: window.tab2Routes?.loanCompanySearch || '',
                    data: {
                        keyword: encodeURIComponent(request['term'])
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (json) {
                        json = json.data;
                        response($.map(json, function (item) {
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
            select: function (event, ui) {
                $(this).val(ui.item.label);
                var n = $(this).attr('name');
                var index = n.slice(-3);
                index = index.replace('[', '');
                index = index.replace(']', '');
                index = parseInt(index);
                $("input[name='property_vehicle[vehicle_car_loan][creditor_name][" + index + "]']").val(ui.item.label);
                $("input[name='property_vehicle[vehicle_car_loan][creditor_name_addresss][" + index + "]']").val(ui.item.address);
                $("input[name='property_vehicle[vehicle_car_loan][creditor_city][" + index + "]']").val(ui.item.city);
                $("select[name='property_vehicle[vehicle_car_loan][creditor_state][" + index + "]']").val(ui.item.state);
                $("input[name='property_vehicle[vehicle_car_loan][creditor_zip][" + index + "]']").val(ui.item.zip);
            }
        });
    });
}

/**
 * Setup autocomplete for creditor names
 */
function setupAutocomplete(element, baseName) {
    element.autocomplete({
        'classes': {
            "ui-autocomplete": "custom-ui-autocomplete"
        },
        'source': function (request, response) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: window.tab2Routes?.mortgageSearch || '',
                data: {
                    keyword: encodeURIComponent(request['term'])
                },
                dataType: 'json',
                type: 'post',
                success: function (json) {
                    json = json.data;
                    response($.map(json, function (item) {
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
        select: function (event, ui) {
            $(this).val(ui.item.label);
            var n = $(this).attr('name');
            var index = n.slice(-3);
            index = index.replace('[', '');
            index = index.replace(']', '');
            index = parseInt(index);
            $("input[name='" + baseName + "[creditor_name][" + index + "]']").val(ui.item.label);
            $("input[name='" + baseName + "[creditor_name_addresss][" + index + "]']").val(ui.item.address);
            $("input[name='" + baseName + "[creditor_city][" + index + "]']").val(ui.item.city);
            $("select[name='" + baseName + "[creditor_state][" + index + "]']").val(ui.item.state);
            $("input[name='" + baseName + "[creditor_zip][" + index + "]']").val(ui.item.zip);
        }
    });
}

// ==================== FORM VALIDATION ====================

/**
 * Initialize form validation
 */
function initializeFormValidation() {
    const formSelectors = [
        "#client_property_step1",
        "#client_property_step2",
        "#client_property_step3",
        "#client_property_step4",
        "#client_property_step4_continue",
        "#client_property_step5",
        "#client_property_step6",
        "#client_property_step7"
    ];

    formSelectors.forEach(function (selector) {
        if ($(selector).length) {
            $(selector).validate({
                errorPlacement: function (error, element) {
                    if ($(element).parents(".form-group").next('label').hasClass('error')) {
                        $(element).parents(".form-group").next('label').remove();
                        $(element).parents(".form-group").after($(error)[0].outerHTML);
                    } else {
                        $(element).parents(".form-group").after($(error)[0].outerHTML);
                    }
                },
                success: function (label, element) {
                    label.parent().removeClass('error');
                    $(element).parents(".form-group").next('label').remove();
                },
            });
        }
    });
}

// ==================== EVENT HANDLERS ====================

/**
 * Initialize event handlers
 */
function initializeEventHandlers() {
    // Remove button functionality
    $('body').on('click', '.removeThis', function () {
        $(this).parents('.removeDiv').remove();
    });

    // Currently lived checkbox functionality
    $('.currently_lived').each(function (i) {
        if ($(this).is(':checked') && $(this).val() == '1') {
            $("#add-more-residence-form").show();
        }
    });

    // Mortgage state change handler
    $(document).on("change", ".mortgage_state", function (evt) {
        statecounty($(this).attr('id'), $(this).attr('data-countyid'));
    });

    // Property value and loan handlers - Optimized
    const loanHandlers = [
        { selector: ".estimated_property_value, .vehicle_debt_owned_by", validator: checkAllFieldsFilledForLoanDiv, targetClass: "loan-div" },
        { selector: ".loan-1-div :input:visible", validator: checkAllFieldsFilledForLoan1Div, targetClass: "loan-2-main-div" },
        { selector: ".loan-2-div :input:visible", validator: checkAllFieldsFilledForLoan2Div, targetClass: "loan-3-main-div" },
        { selector: ".main-property-section :input:visible", validator: checkAllFieldsFilledForMainSection, targetClass: "estimated-value-div" }
    ];

    loanHandlers.forEach(function (handler) {
        $(document).on("input change", handler.selector, function () {
            var objIndex = $(this).attr("data-index");
            var btnStatus = handler.validator(objIndex);
            if (btnStatus) {
                $('.' + handler.targetClass + '-' + objIndex).removeClass('hide-data');
            }
        });
    });

    // Form input change handler for step1
    $(document).on('input change', 'form#client_property_step1 :input', function () {
        updateSubmitButtonColor();
    });
}

// ==================== PAYMENT CALCULATIONS ====================

/**
 * Initialize payment calculations
 */
function initializePaymentCalculations() {
    $(document).on('input', ".payment_1, .payment_2, .payment_3, .payment_1_of_1, .payment_2_of_1, .payment_3_of_1, .payment_1_of_2, .payment_2_of_2, .payment_3_of_2, .payment_1_of_3, .payment_2_of_3, .payment_3_of_3", function (e) {
        var dataIndex = $(e.target).data('index');
        var dataKey = $(e.target).data('key');
        var dataMainarray = $(e.target).data('mainarray');
        var pay1 = parseFloat($("input[name='" + dataMainarray + "[" + dataKey + "][payment_1][" + dataIndex + "]']").val()) || 0.00;
        var pay2 = parseFloat($("input[name='" + dataMainarray + "[" + dataKey + "][payment_2][" + dataIndex + "]']").val()) || 0.00;
        var pay3 = parseFloat($("input[name='" + dataMainarray + "[" + dataKey + "][payment_3][" + dataIndex + "]']").val()) || 0.00;
        var total = parseFloat(pay1 + pay2 + pay3);
        var convertedValue = parseFloat(total).toFixed(2);
        $("input[name='" + dataMainarray + "[" + dataKey + "][total_amount_paid][" + dataIndex + "]']").val(convertedValue);
    });

    updateSubmitButtonColor();
}

// ==================== MORTGAGE THREE MONTH FUNCTIONS ====================

/**
 * Clear form fields in container
 */
function clearFormFields(containerSelector) {
    const $container = $(document).find(containerSelector);
    $container.find("select").val("");
    $container.find('input[type="text"]').val("");
    $container.find('input[type="number"]').val("");
    $container.find('input[type="checkbox"]').prop("checked", false);
}

function isMortgageThreeMonth(selected_value, index) {
    clearFormFields(".three_months_div_" + index);
}

function isMortgageThreeMonthAdditional1(selected_value, index) {
    clearFormFields(".additional_three_months_div_" + index);
}

function isMortgageThreeMonthAdditional2(selected_value, index) {
    clearFormFields(".second_additional_three_months_div_" + index);
}

function isThreeMonthVehicle(selected_value, index) {
    clearFormFields(".vehicle_three_months_div_" + index);
}

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

// ==================== STATE/COUNTY FUNCTIONS ====================

function statecounty(stateId, countyId) {
    var statename = $("#" + stateId + " option:selected").text();
    var ajaxurl = window.tab2Routes?.countyByStateName || '';
    laws.ajax(ajaxurl, {
        state_name: statename
    }, function (response) {
        var res = JSON.parse(response);
        document.getElementById(countyId).innerHTML = "";
        $("#" + countyId).append($("<option></option>").attr("value", '').text("Choose County"));
        $.each(res.countyList, function (key, value) {
            $("#" + countyId).append($("<option></option>").attr("value", value.id).text(value.county_name));
        });
    });
}

// ==================== FIELD VALIDATION FUNCTIONS ====================

/**
 * Check if all fields are filled in the form
 */
function checkAllFieldsFilled() {
    var allFilled = true;
    var requireFieldError = '<div class="validation-error text-danger">**Please select one from above.</div>';
    $('form#client_property_step1 :input:visible:not(.hide-data :input)').each(function () {
        if (!$(this).is('button')) {
            if (($(this).is(':radio') || $(this).is(':checkbox')) && $(this).hasClass('required')) {
                var groupName = $(this).attr('name');
                $(this).parent().parent().find('div.validation-error').remove();
                if (!$('input[name="' + groupName + '"]').is(':checked')) {
                    $(this).parent().parent().append(requireFieldError);
                    allFilled = false;
                } else {
                    $(this).parent().parent().find('div.validation-error').remove();
                }
            } else if ($(this).is('select')) {
                if ($(this).find('option:selected').val() == '' && $(this).hasClass('required')) {
                    $(this).addClass('border-red');
                    allFilled = false;
                } else {
                    $(this).removeClass('border-red');
                }
            } else if ($(this).val().trim() === '' && $(this).hasClass('required')) {
                $(this).addClass('border-red');
                allFilled = false;
            } else {
                $(this).removeClass('border-red');
            }
        }
    });
    return allFilled;
}

function updateSubmitButtonColor() {
    var btnStatus = checkAllFieldsFilled();
    if (btnStatus) {
        $('.save-button-section button').prop('disabled', false);
    }
    if (!btnStatus) {
        $('.save-button-section button').prop('disabled', true);
    }
}

/**
 * Validate form fields in container
 */
function validateFormFields(containerSelector, includeSelectValidation = false) {
    var allFilled = true;
    $(containerSelector + ' :input:visible').each(function () {
        if (($(this).is(':radio') || $(this).is(':checkbox')) && $(this).hasClass('required')) {
            var groupName = $(this).attr('name');
            if (!$('input[name="' + groupName + '"]').is(':checked')) {
                allFilled = false;
                return false;
            }
        } else if (includeSelectValidation && $(this).is('select') && $(this).hasClass('required')) {
            if ($(this).find('option:selected').val() == '') {
                allFilled = false;
                return false;
            }
        } else if ($(this).val().trim() === '' && $(this).hasClass('required')) {
            allFilled = false;
            return false;
        }
    });
    return allFilled;
}

function checkAllFieldsFilledForLoanDiv(objIndex) {
    return validateFormFields('.estimated-value-div-' + objIndex);
}

function checkAllFieldsFilledForLoan1Div(objIndex) {
    return validateFormFields('.loan-1-div-' + objIndex, true);
}

function checkAllFieldsFilledForLoan2Div(objIndex) {
    return validateFormFields('.loan-2-div-' + objIndex, true);
}

function checkAllFieldsFilledForMainSection(objIndex) {
    return validateFormFields('.main-property-section-' + objIndex, true);
}

// ==================== POPUP FUNCTIONS ====================

function openPopup(divclass) {
    var htmldiv = $("." + divclass).html();
    var html = '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12"><div class="form_colm row px-md-5 py-4"><div class="col-md-12 mb-3"><div class="title-h mt-1 d-flex"><h4><strong>Information: </strong></h4></div></div><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' + htmldiv + '</div></div></div></div></div></div></div></div></div>';
    laws.updateFaceboxContent(html, 'productQuickView quickinfor');
}

/**
 * Open flag popup (red flag warning popups)
 * Used across all Tab 2 steps for showing warning/info popups
 * @param {string} divclass - Class of the div containing popup content
 * @param {string} noText - Text for "No" radio button
 * @param {boolean} includeradio - Whether to include Yes/No radio buttons
 * @param {boolean} attorneyEdit - Whether editing from attorney side
 * @param {boolean} loadnAjax - Whether to load content via AJAX
 * @param {string} ajaxurl - AJAX URL if loadnAjax is true
 */
function openFlagPopup(divclass, noText = "", includeradio = true, attorneyEdit = false, loadnAjax = false, ajaxurl = '') {
    if (divclass == "no-popup") {
        return;
    }
    
    let extraClass = "";
    if (divclass == "venmo-statement-popup" || divclass == "paypal-statement-popup" || 
        divclass == "cash-statement-popup" || divclass == "credit-report-popup") {
        extraClass = "video-popup-div";
    }

    if (divclass == "no-profit-loss-popup") {
        extraClass = "no-profit-loss-popup-div";
    }
    
    if (loadnAjax == true) {
        laws.ajax(ajaxurl, { divclass: divclass }, function (response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                laws.updateFaceboxContent(res.html, `productQuickView quickinfor ${extraClass}`);  
            }
        });
    } else {
        var htmldiv = $("." + divclass).html();
        if (noText == "") {
            noText = "I do. I just don't know what to put for this item";
        }

        var html = '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12 pr-0 pl-0"><div class="form_colm red-flag row p-4"><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' +
            htmldiv;

        if (includeradio == true) {
            var noFunction = "";
            if (attorneyEdit) {
                noFunction = "$('#secondaryModalBs').modal('hide');";
            } else {
                noFunction = "$.facebox.close();"
            }

            html += '<div class="d-inline radio-primary"><input type="radio" id="popup_yes" name="popup_yes_no" value="1" class="yes-radio" onclick="'+noFunction+'"> <label for="popup_yes">Yes</label></div><div class="d-inline radio-primary"><input type="radio" id="popup_no" name="popup_yes_no" value="0" class="no-radio" onclick="'+noFunction+'"><label for="popup_no">' +
                noText +
                "</label></div>";
        }

        html += "</div></div></div></div></div></div></div></div></div>";

        if (attorneyEdit) {
            $("#secondaryModalBs .modal-content").html(html);
            $("#secondaryModalBs").modal("show"); 
        } else {
            laws.updateFaceboxContent(html, `productQuickView quickinfor ${extraClass}`);
        }
    }
}

// ==================== UTILITY POPUP - HOUSEHOLD ITEMS ====================

/**
 * Empty selected items
 */
function emptySelectedItems() {
    selectedItems.clear();
}

/**
 * Initialize selected items from previous data
 */
function initializeSelectedItems(previousData) {
    if (!previousData) return;

    const previousItems = previousData.split(';').map(item => item.trim());

    previousItems.forEach(item => {
        const parts = item.split(' ');
        let quantity = 1;
        let price = '';
        let label = '';

        if (!isNaN(parts[0])) {
            quantity = parseInt(parts.shift(), 10);
        }

        if (parts[parts.length - 1].includes('$')) {
            price = parts.pop();
            price = price.replace('$', '');
        }

        label = parts.join(' ').trim();
        var currentPrice = 0;
        if (price > 0) {
            currentPrice = price
        }

        selectedItems.set(label, {
            quantity: quantity,
            price: parseFloat(currentPrice).toFixed(2)
        });

        let itemFound = false;

        $('.item-card').each(function () {
            if ($(this).data('label') === label) {
                $(this).addClass('selected');
                $(this).find('select').val(quantity);
                $(this).find('input.price-field').val(currentPrice);
                itemFound = true;
                return false;
            }
        });

        if (!itemFound && label !== undefined && currentPrice !== undefined) {
            addCustomItem(label, quantity, currentPrice);
        }
    });

    updateSelectedItemsList();
}

/**
 * Update selected items list display
 */
function updateSelectedItemsList() {
    if (selectedItems.size > 0) {
        const itemsArray = Array.from(selectedItems, ([label, {
            quantity,
            price
        }]) => {
            var currentPrice = parseFloat(0).toFixed(2);
            if (price > 0) {
                currentPrice = price
            }
            if (quantity === 1) {
                return `${label} $${currentPrice}`;
            } else {
                return `${quantity} ${label} $${currentPrice}`;
            }
        });
        $('#selected-items-list').text(itemsArray.join('; '));
    } else {
        $('#selected-items-list').text('None');
    }
}

/**
 * Update item in selected items
 */
function updateItemInSelectedItems(label, quantity, price) {
    if (quantity > 0) {
        selectedItems.set(label, {
            quantity: quantity,
            price: parseFloat(price).toFixed(2)
        });
    } else {
        selectedItems.delete(label);
    }
    updateSelectedItemsList();
}

/**
 * Handle card click
 */
function handleCardClick(event) {
    const card = $(event.target).closest('.item-card');
    const label = card.data('label');
    const quantity = card.find('.select').val() || 1;
    const price = card.find('.price-field').val() || 0;

    if (card.hasClass('selected')) {
        card.removeClass('selected');
        card.find('select').val(0);
        card.find('input').val(0);
        selectedItems.delete(label);
    } else {
        const currentQuantity = quantity > 1 ? quantity : 1;
        const currentPrice = price > 0 ? price : 0;

        card.addClass('selected');
        card.find('select').val(quantity);
        card.find('input').val(0);
        updateItemInSelectedItems(label, currentQuantity, currentPrice);
    }
    updateSelectedItemsList();
}

/**
 * Handle quantity change
 */
function handleQuantityChange(event) {
    const card = $(event.target).closest('.item-card');
    const label = card.data('label');
    const currentQuantity = parseInt(event.target.value) || 0;
    const currentPrice = card.find('.price-field').val() || 0;

    if (currentQuantity > 0) {
        card.addClass('selected');
    } else {
        card.removeClass('selected');
    }

    updateItemInSelectedItems(label, currentQuantity, currentPrice);
}

/**
 * Handle price change
 */
function handlePriceChange(event) {
    const input = $(event.target);
    const card = input.closest('.item-card');
    const label = card.data('label');
    const currentQuantity = selectedItems.get(label) ? selectedItems.get(label).quantity : 1;
    const price = input.val();

    if (currentQuantity > 0) {
        if (!card.hasClass('selected')) {
            card.addClass('selected');
        }
        card.find('select').val(currentQuantity);
        updateItemInSelectedItems(label, currentQuantity, price);
    }
}

/**
 * Handle price on blur
 */
function handlePriceOnBlur(event) {
    var currentVal = $(event.target).val();
    if (currentVal === "" || isNaN(parseFloat(currentVal))) {
        currentVal = 0;
    }
    $(event.target).val(parseFloat(currentVal).toFixed(2));
}

/**
 * Custom item input
 */
function customItemInput() {
    const customItem = $('#custom-item').val().trim();
    if (customItem !== "") {
        $('#custom-item-quantity').val(1)
    } else {
        $('#custom-item-quantity').val(0)
    }
}

/**
 * Handle add custom item
 */
function handleAddCustomItem() {
    const customItem = $('#custom-item').val().trim();
    const customQuantity = parseInt($('#custom-item-quantity').val()) || 0;
    const customPrice = parseFloat($('#custom-item-price').val()) || 0;

    if (customItem && customQuantity > 0) {
        updateItemInSelectedItems(customItem, customQuantity, customPrice);
        addCustomItem(customItem, customQuantity, customPrice);
        $('#custom-item').val('');
        $('#custom-item-quantity').val(0);
        $('#custom-item-price').val(0);
    }
}

/**
 * Add custom item card
 */
function addCustomItem(label, quantity, price) {
    const newCardHtml = `
        <div class="col-md-3 custom-item">
            <div class="card item-card selected" data-label="${label}">
                <div class="card-body p-0">
					<h6 class="card-title mb-0 w-100 p-2"><span onclick="handleCardClick(event)">${label}</span>&nbsp;<span onclick="handleCardClick(event)"></span></h6>
					<div class="d-flex">
						<div class="p-2 pt-0 w-100">
							<small>Quantity:</small>
							<select class="form-control-custom-select" onchange="handleQuantityChange(event)">
								${Array.from({ length: 31 }, (_, i) => `<option value="${i}" ${i == quantity ? 'selected' : ''}> ${i} </option>`).join('')}
							</select>
						</div>
						<div class="p-2 pt-0" >
							<small>Total&nbsp;Value&nbsp;of&nbsp;Item(s):</small>
							<input type="text" class="form-control-custom-input price-field w-price-size" value="${price}" oninput="handlePriceChange(event)" onblur="handlePriceOnBlur(event)" / >
						</div>
					</div>
				</div>
			</div>
		</div>`;

    if ($('.add-more-item-card').hasClass('hide-data')) {
        $('.add-more-item-card').removeClass('hide-data');
    }

    $(newCardHtml).insertBefore($('.bottom-empty-div'));
}

/**
 * Handle save click for utility popup
 */
async function handleSaveClick(event, type, attorneyEdit = false) {
    const canEdit = await is_editable('can_edit_property');
    if (!canEdit) {
        return false;
    }
    event.preventDefault();
    const itemsArray = Array.from(selectedItems, ([label, {
        quantity,
        price
    }]) => {
        if (quantity === 1) {
            return `${label} $${price}`;
        } else {
            return `${quantity} ${label} $${price}`;
        }
    });
    var descriptionText = itemsArray.join('; ');
    $('.detailed_tab_items_' + type).val(descriptionText);

    const totalPrice = Array.from(selectedItems.values())
        .reduce((sum, {
            price
        }) => sum + parseFloat(price), 0)
        .toFixed(2);
    $('.detailed_tab_items_' + type + '_value').val(totalPrice);

    var data = [descriptionText, totalPrice];
    var client_id = window.tab2Data?.clientId || null;
    updatePropertyAssetToDB(client_id, type, data);

    emptySelectedItems();

    if (attorneyEdit) {
        $('#secondaryModalBs').modal('hide');
    } else {
        $.facebox.close();
    }
};

/**
 * Update property asset to DB
 */
function updatePropertyAssetToDB(client_id, type, data) {
    var url = window.tab2Data?.assetSaveRoute || '';

    laws.ajax(url, {
        client_id: client_id,
        type: type,
        data: data
    }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            $.systemMessage(res.msg, "alert--success", true);
        }
    });
}

/**
 * Initialize common utility popup
 */
function initializeCommonUtilityPopup() {
    const previous_data = (window.tab2Data && window.tab2Data.previousData) ? window.tab2Data.previousData : '';
    initializeSelectedItems(previous_data);
};

// ==================== PROPERTY FUNCTIONALITY INITIALIZATION ====================

/**
 * Initialize all property-related functionality
 * Calls step-specific initialization functions if they exist
 */
function initializePropertyFunctionality() {
    if (typeof initializePropertyStep1 === 'function') initializePropertyStep1();
    if (typeof initializePropertyStep2 === 'function') initializePropertyStep2();
    if (typeof initializePropertyStep3 === 'function') initializePropertyStep3();
    if (typeof initializePropertyStep4 === 'function') initializePropertyStep4();
    if (typeof initializePropertyStep4Continue === 'function') initializePropertyStep4Continue();
    if (typeof initializePropertyStep5 === 'function') initializePropertyStep5();
    if (typeof initializePropertyStep5Continue === 'function') initializePropertyStep5Continue();
    if (typeof initializePropertyStep6 === 'function') initializePropertyStep6();
    if (typeof initializePropertyStep7 === 'function') initializePropertyStep7();
    if (typeof initializeCommonUtilityPopup === 'function') initializeCommonUtilityPopup();
};

// Call initialization when document is ready
$(function() {
    initializePropertyFunctionality();
});

// Export functions for backward compatibility
window.initializePropertyFunctionality = initializePropertyFunctionality;
window.initializeCommonUtilityPopup = initializeCommonUtilityPopup;
window.setupAutocomplete = setupAutocomplete;
window.initializeMortgageAutocomplete = initializeMortgageAutocomplete;
window.initializeFormValidation = initializeFormValidation;
window.initializeEventHandlers = initializeEventHandlers;
window.initializePaymentCalculations = initializePaymentCalculations;
window.clearFormFields = clearFormFields;
window.isMortgageThreeMonth = isMortgageThreeMonth;
window.isMortgageThreeMonthAdditional1 = isMortgageThreeMonthAdditional1;
window.isMortgageThreeMonthAdditional2 = isMortgageThreeMonthAdditional2;
window.isThreeMonthVehicle = isThreeMonthVehicle;
window.isThreeMonthsCommon = isThreeMonthsCommon;
window.statecounty = statecounty;
window.checkAllFieldsFilled = checkAllFieldsFilled;
window.updateSubmitButtonColor = updateSubmitButtonColor;
window.validateFormFields = validateFormFields;
window.checkAllFieldsFilledForLoanDiv = checkAllFieldsFilledForLoanDiv;
window.checkAllFieldsFilledForLoan1Div = checkAllFieldsFilledForLoan1Div;
window.checkAllFieldsFilledForLoan2Div = checkAllFieldsFilledForLoan2Div;
window.checkAllFieldsFilledForMainSection = checkAllFieldsFilledForMainSection;
window.openPopup = openPopup;
window.openFlagPopup = openFlagPopup;
window.emptySelectedItems = emptySelectedItems;
window.initializeSelectedItems = initializeSelectedItems;
window.updateSelectedItemsList = updateSelectedItemsList;
window.updateItemInSelectedItems = updateItemInSelectedItems;
window.handleCardClick = handleCardClick;
window.handleQuantityChange = handleQuantityChange;
window.handlePriceChange = handlePriceChange;
window.handlePriceOnBlur = handlePriceOnBlur;
window.customItemInput = customItemInput;
window.handleAddCustomItem = handleAddCustomItem;
window.addCustomItem = addCustomItem;
window.handleSaveClick = handleSaveClick;
window.updatePropertyAssetToDB = updatePropertyAssetToDB;

