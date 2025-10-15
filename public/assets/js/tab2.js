// Tab2 Property Questionnaire JavaScript
// This file contains all JavaScript functionality for the property questionnaire

// Global variables
let showNoticePopup = false;
let hasValueTwo = false;
const selectedItems = new Map();

// Initialize when document is ready
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

    // Initialize property-related functionality
    initializePropertyFunctionality();
});

// Autocomplete functionality for mortgage/vehicle creditor names
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

// Setup autocomplete for creditor names
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

// Initialize form validation
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

// Initialize event handlers
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

    // Property type click handlers
    $(document).on("click", "#loan_own_type_property_no_0, #loan_own_type_property_no_1, #loan_own_type_property_no_2, #loan_own_type_property_no_3, #loan_own_type_property_no_4, #loan_own_type_property_no_12, #loan_own_type_property_no_23, #loan_own_type_property_no_34", function () {
        var forAttorney = $(this).data('attorney_edit');
        let propType = $(this).data('prop-type');
        if (propType == "vehicle") {
            openFlagPopup('no-vehicle-popup', 'No', true, forAttorney);
        } else {
            openFlagPopup('no-mortgage-popup', 'No', true, forAttorney);
        }
    });

    // Form input change handler for step1
    $(document).on('input change', 'form#client_property_step1 :input', function () {
        updateSubmitButtonColor();
    });
}

// Initialize payment calculations
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

// Mortgage three month functions - Optimized
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

// Field validation functions
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

// State/County functionality
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

// Loan validation functions - Optimized
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

// Selected items management
function emptySelectedItems() {
    selectedItems.clear();
}

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

// Item handling functions - Optimized
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

function toggleCardSelection(card, label, quantity, price) {
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
}

function handleCardClick(event) {
    const card = $(event.target).closest('.item-card');
    const label = card.data('label');
    const quantity = card.find('.select').val() || 1;
    const price = card.find('.price-field').val() || 0;

    toggleCardSelection(card, label, quantity, price);
}

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

function handlePriceOnBlur(event) {
    var currentVal = $(event.target).val();
    if (currentVal === "" || isNaN(parseFloat(currentVal))) {
        currentVal = 0;
    }
    $(event.target).val(parseFloat(currentVal).toFixed(2));
}

function customItemInput() {
    const customItem = $('#custom-item').val().trim();
    if (customItem !== "") {
        $('#custom-item-quantity').val(1)
    } else {
        $('#custom-item-quantity').val(0)
    }
}

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
								${Array.from({ length: 31 }, (_, i) => `<option value = "${i}" ${i == quantity ? 'selected' : ''}> ${i} </option>`).join('')}
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

async function handleSaveClick(event, type, attorneyEdit = false) {
    const canEdit = await is_editable('can_edit_property');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }
    event.preventDefault();
    const selectedItemsString = Array.from(selectedItems, ([label, quantity]) => `${quantity}-${label}`).join(';');
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
}

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

function setBusinessValue(value) {
    if (value == 2) {
        hasValueTwo = true;
    }
}

function handleS4ContinueSubmit(hasAnyBusiness, event) {
    event.preventDefault();
    let hasValueTwo = false;
    if (hasAnyBusiness) {
        $('.bank_personal_business_account').each(function () {
            if ($(this).val() == 2) {
                hasValueTwo = true;
                return false; // Break out of the loop
            }
        });

        if (!hasValueTwo) {
            $('html, body').animate({
                scrollTop: $('#checking_account_items_data_question').offset().top
            }, 500); // Adjust the speed (500 ms) as needed
            openFlagPopup2('hasAnyBusiness-popup', 'No', true);
        } else {
            $('#client_property_step4_continue').submit(); // Submit the form if any select has value 2
        }
    } else {
        $('#client_property_step4_continue').submit();
    }
}

function openPopup(divclass) {
    var htmldiv = $("." + divclass).html();
    var html = '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12"><div class="form_colm row px-md-5 py-4"><div class="col-md-12 mb-3"><div class="title-h mt-1 d-flex"><h4><strong>Information: </strong></h4></div></div><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' + htmldiv + '</div></div></div></div></div></div></div></div></div>';
    laws.updateFaceboxContent(html, 'productQuickView quickinfor');
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

function getPropertyResidenceDetailsByGraphQL(index) {
		const isCheckedNo = $('#payment_not_primary_address_no_' + index).is(':checked');
		const isCheckedYes = $('#payment_not_primary_address_yes_' + index).is(':checked');

		let address = "";

		if (isCheckedNo) {
			const $streetInput = $('.mortgage_address[data-index="' + index + '"]');
        	const street = $streetInput.val() || '';
			const city = $('.mortgage_city[data-index="' + index + '"]').val() || '';
			const state = $('.mortgage_state[data-index="' + index + '"] option:selected').val() || '';
			const zip = $('.mortgage_zip[data-index="' + index + '"]').val() || '';

			address = street;
			address += city ? ', ' + city : '';
			address += state ? ', ' + state : '';
			address += zip ? ', ' + zip : '';

			if (!address.trim()) {
				$.systemMessage("Kindly enter your residence address before accessing the property details..", 'alert--danger', true);
				$streetInput.focus();
				return;
			}
		}

		if (isCheckedYes) {
			address =  window.tab2Data?.BasicInfoPartAAddress || '';
		}

		if (!isCheckedNo && !isCheckedYes ) {
			$.systemMessage("Kindly select your primary residence type before accessing the property details..", 'alert--danger', true);
			return;
		}

		 var client_id = window.tab2Data?.clientId || null;

		if (address && address.trim()) {
			// Check if property_id exists, if not save the property first
			var $propertyIdInput = $('input[name="property_resident[id][' + index + ']"]');
			var property_id = null;

			if ($propertyIdInput.length > 0) {
				property_id = $propertyIdInput.val();
				// Property exists, proceed with screenshot
				generatePropertyScreenshot(client_id, address, property_id, index);
			} else {
				// Property doesn't exist, save it first then generate screenshot
				$.systemMessage("Saving property first, then generating screenshot...", 'alert--process');
				savePropertyAndGenerateScreenshot(client_id, address, index);
			}
		} else {
			$.systemMessage("Please select your primary residence type and enter address before generating screenshot", 'alert--danger', true);
		}
	}

	function savePropertyAndGenerateScreenshot(client_id, address, index) {
		// Reuse existing validation logic but with async AJAX
		$.systemMessage("Saving property first, then generating screenshot...", 'alert--process');

		// First validate the form using existing validation
		validateFormIds('client_property_step1');
		$("#client_property_step1").validate().form();

		if (!$("#client_property_step1").valid()) {
			$('html, body').animate({
				scrollTop: ($('.error:visible').offset().top - 60)
			}, 200);
			$.systemMessage("Please fill in all required fields before generating screenshot", 'alert--danger', true);
			return;
		}

		// Use existing AJAX pattern but with async: true for better UX
		var formElement = document.getElementById('client_property_step1');
		if (!formElement) {
			$.systemMessage("Property form not found", 'alert--danger', true);
			return;
		}

		var formData = new FormData(formElement);
		var formAction = $("#client_property_step1").attr('action');

		if (!formAction) {
			$.systemMessage("Form action not found", 'alert--danger', true);
			return;
		}

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: formAction,
			contentType: false,
			data: formData,
			processData: false,
			type: 'POST',
			dataType: 'json', // Expect JSON response
			async: true, // Use async for better UX
			timeout: 30000, // 30 second timeout
			success: function(response) {
				var res = response;

				if (res.status === 1) {
					// Property saved successfully, now generate screenshot
					$.systemMessage("Property saved. Generating screenshot...", 'alert--process');

					// Add or update the property_id input without changing the form mode
					var $propertyIdInput = $('input[name="property_resident[id][' + index + ']"]');
					if ($propertyIdInput.length === 0) {
						// Add the property_id input to the form
						var propertyIdInput = '<input type="hidden" name="property_resident[id][' + index + ']" value="' + res.property_id + '">';
						$('#client_property_step1').append(propertyIdInput);
					} else {
						// Update existing property_id
						$propertyIdInput.val(res.property_id);
					}

					// Keep the form in edit mode by ensuring the form is visible and summary is hidden
					$('.residence_form_' + index).removeClass('hide-data');
					$('.residence_form_summary_' + index).addClass('hide-data');

					// Get the property_id for screenshot generation
					var property_id = res.property_id || $('input[name="property_resident[id][' + index + ']"]').val();

					generatePropertyScreenshot(client_id, address, property_id, index);
				} else {
					$.systemMessage(res.msg || "Failed to save property", 'alert--danger', true);
				}
			},
			error: function(xhr, status, error) {
				console.error('AJAX Error:', xhr, status, error);
				console.error('Response Text:', xhr.responseText);

				if (status === 'timeout') {
					$.systemMessage("Request timed out. Please try again.", 'alert--danger', true);
				} else if (xhr.status === 422) {
					$.systemMessage("Validation error. Please check your input.", 'alert--danger', true);
				} else if (xhr.status === 500) {
					$.systemMessage("Server error. Please try again later.", 'alert--danger', true);
				} else {
					$.systemMessage("Error saving property: " + error, 'alert--danger', true);
				}
			}
		});
	}

	function generatePropertyScreenshot(client_id, address, property_id, index) {
		$.systemMessage("Grabbing Property Details. Hold Please.", 'alert--process');

		var url = window.tab2Data?.graphqlurl || null;
		laws.ajax(url, {
			client_id: client_id,
			address: address,
			property_id: property_id
		}, function(response, status) {
			var res = JSON.parse(response);
			if (res.status === 1 && res.finalData) {
				const finalData = res.finalData;
				const extraData = res.extraData;
				$('.poperty-type-div-'+ index).removeClass('hide-data');
				// Find the radio input that matches the property type value
				$('input.property[type="radio"][data-index="' + index + '"]').each(function() {
					const isMatch = $(this).val() == finalData.property_type;
					if (isMatch) {
						const id = $(this).attr('id');
						$('label[for="' + id + '"]').trigger('click'); // Triggers radio check & onclick
					}
				});

				// set property value
				$('.estimated_property_value[data-index="' + index + '"]').val(finalData.price);
				// bed
				$('.bedroom[data-index="' + index + '"]').val(finalData.beds);
				// bathroom
				$('.bathroom[data-index="' + index + '"]').val(finalData.baths);

				// home sq ft
				$('.home_sq_ft[data-index="' + index + '"]').val(finalData.lot_size);
				$.systemMessage.close();

				$('.estimated-value-div-'+ index ).removeClass('hide-data');

				// var btnStatus = checkAllFieldsFilledForLoanDiv(index);
				// if (btnStatus) {
				// 	$('.loan-div-' + index).removeClass('hide-data');
				// }

				/*if(extraData){
					 downloadJson(extraData);
				}*/

				// Show modal using Bootstrap
				// if (data.url) {
				// 	const modalElement = document.getElementById('prpertyPreviewModal');
				// 	$(modalElement).find('iframe').addClass('d-block').attr('src', data.url);
				// 	const modal = new bootstrap.Modal(modalElement);
				// 	modal.show();
				// }

				$.systemMessage("Property details added successfully.", "alert--success", true);
			} else {
				$.systemMessage(res.msg, 'alert--danger', true);
			}
			$('.poperty-type-div-'+ index +' .property_mortgage_section').removeClass('hide-data');
		});
	}

	function showLoanDiv(index) {
		var btnStatus = checkAllFieldsFilledForLoanDiv(index);
		if (btnStatus) {
			$('.loan-div-' + index).removeClass('hide-data');
		}
	}



	function downloadJson(jsonData) {
		try {
			// Parse the JSON (this also validates it)
			const parsedJson = JSON.parse(jsonData);
			const formattedJson = JSON.stringify(parsedJson, null, 2); // Pretty-print

			// Create a Blob (file-like object)
			const blob = new Blob([formattedJson], {
				type: 'text/plain'
			});

			// Create a temporary download link
			const url = URL.createObjectURL(blob);
			const a = document.createElement('a');
			a.href = url;
			a.download = 'response.txt'; // File name

			// Trigger download
			document.body.appendChild(a);
			a.click();

			// Clean up
			document.body.removeChild(a);
			URL.revokeObjectURL(url);
		} catch (e) {
			console.error('Invalid JSON:', e);
			alert('Error: Invalid JSON data');
		}
	}

    $(document).on("click", ".loan-2-div .btn-toggle", function() {
    var inputId = $(this).attr("for"); // Get the value of the "for" attribute
    var $input = $('#' + inputId); // Get the associated input

    if ($input.length && $input.is(':radio')) {
        showLoan3Div($input[0]); // Pass the DOM element to your function
    }
	});

	function showLoan3Div(obj){
		var objIndex = $(obj).attr("data-index");
		var btnStatus = checkAllFieldsFilledForLoan2Div(objIndex);
		if (btnStatus) {
			$('.loan-3-main-div-' + objIndex).removeClass('hide-data');
		}
	}
	$(document).on("input change", ".loan-1-div :input:visible", function() {
		showLoan2Div(this);
	});

	$(document).on("click", ".loan-1-div .btn-toggle", function() {
		var inputId = $(this).attr("for"); // Get the value of the "for" attribute
		var $input = $('#' + inputId); // Get the associated input

		if ($input.length && $input.is(':radio')) {
			showLoan2Div($input[0]); // Pass the DOM element to your function
		}
	});

	function showLoan2Div(obj){
		var objIndex = $(obj).attr("data-index");
		var btnStatus = checkAllFieldsFilledForLoan1Div(objIndex);
		if (btnStatus) {
			$('.loan-2-main-div-' + objIndex).removeClass('hide-data');
		}
	}
// ===== PROPERTY-RELATED JAVASCRIPT FUNCTIONS =====
// These functions are extracted from the property folder blade files

// Property Step 1 - Residence/Real Estate Functions
function initializePropertyStep1() {
    var pstatus = (window.tab2Data && window.tab2Data.propertyresidentStatus) ? window.tab2Data.propertyresidentStatus : 0;
    if (pstatus == 0) {
        $("#section2 input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

// Property Step 2 - Vehicle Functions
function initializePropertyStep2() {
    var pstatus = (window.tab2Data && window.tab2Data.vehicleStatus) ? window.tab2Data.vehicleStatus : 0;
    if (pstatus == 0) {
        $("#property-part-b input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

function checkUnknownVin(checkbox, index) {
    if ($(checkbox).is(':checked')) {
        $('.vehicle-data-section-' + index).removeClass('d-none')
        $('.vin_number_div_' + index + ' input').removeClass('required');
    } else {
        $('.vehicle-data-section-' + index).addClass('d-none')
    }
}

function vinOnInput(inputObj) {
    var vin = $(inputObj).val();
    vin = vin.replace(/[^a-zA-Z0-9]/g, '').substring(0, 17);
    $(inputObj).val(vin);
}

function checkVin2Number(cobj) {
    var this_id = $(cobj).attr('id');
    var attri = this_id.split('_');
    var thisnum = attri[2];

    const vehicleVinInput = $("input[name='property_vehicle[vin_number][" + thisnum + "]']");
    const vehicleVinValue = vehicleVinInput.val() || '';
    const vehicleMileageInput = $("input[name='property_vehicle[property_mileage][" + thisnum + "]']");
    const vehicleMileageValue = vehicleMileageInput.val() || '';

    if (!vehicleVinValue.trim()) {
        $.systemMessage("Kindly enter your vehicle Vin number before accessing the property details.", 'alert--danger', true);
        vehicleVinInput.focus();
        return;
    }

    if (vehicleVinValue.length !== 17) {
        $.systemMessage("Invalid VIN Number. VIN Number must be 17 characters long.", 'alert--danger', true);
        vehicleVinInput.focus();
        return;
    }

    let cleanVehicleMileageValue = '';
    if (vehicleMileageValue) {
        cleanVehicleMileageValue = parseFloat(vehicleMileageValue.replace(/[,]/g, '')) || '';
    }

    if (cleanVehicleMileageValue == '') {
        $.systemMessage("Kindly enter your vehicle mileage before accessing the property details.", 'alert--danger', true);
        vehicleMileageInput.focus();
        return;
    }

    // Show loading state
    var $button = $(cobj);
    var originalText = $button.html();
    $button.html('<i class="bi bi-hourglass-split"></i> Loading...').prop('disabled', true);

    $.systemMessage("Grabbing Vehicle Details. Hold Please.", 'alert--process');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: window.tab2Routes?.fetchVinNumber || '',
        data: {
            vin_number: vehicleVinValue
        },
        dataType: 'json',
        type: 'post',
        success: function(json) {
            $button.html(originalText).prop('disabled', false);
            if (json.status == false) {
                $.systemMessage.close();
                $.systemMessage(json.message, 'alert--danger', true);
                vehicleVinInput.focus();
                $(".unknown_vin.unknown_vin_" + thisnum).attr('checked', false);
                $(".vehicle-data-section-" + thisnum).addClass('d-none');
            } else {
                $(".unknown_vin.unknown_vin_" + thisnum).attr('checked', true);
                $(".vehicle-data-section-" + thisnum).removeClass('d-none');
                $("input[name='property_vehicle[property_year][" + thisnum + "]']").val(json.data.year);
                $("input[name='property_vehicle[property_make][" + thisnum + "]']").val(json.data.make);
                $("input[name='property_vehicle[property_model][" + thisnum + "]']").val(json.data.model);
                $("input[name='property_vehicle[property_other_info][" + thisnum + "]']").val(json.data.trim);
                $.systemMessage.close();
                getPropertyVehicleDetailsByGraphQL(thisnum);
            }
        },
        error: function() {
            $button.html(originalText).prop('disabled', false);
            $.systemMessage('Error connecting to VIN lookup service. Please enter vehicle information manually.', 'alert--danger', true);
        }
    });
}

// Get Property Vehicle Details by GraphQL
function getPropertyVehicleDetailsByGraphQL(index) {
    var client_id = window.tab2Data?.clientId || null;

    const vehicleVinInput = $('.vin_number_div_' + index + ' input.vin_number');
    const vehicleVinValue = vehicleVinInput.val() || '';
    const vehicleMileageInput = $("input[name='property_vehicle[property_mileage][" + index + "]']");
    const vehicleMileageValue = vehicleMileageInput.val() || '';

    let cleanVehicleMileageValue = '';
    if (vehicleMileageValue) {
        cleanVehicleMileageValue = parseFloat(vehicleMileageValue.replace(/[,]/g, '')) || '';
    }

    $.systemMessage("Grabbing Vehicle Value. Hold Please.", 'alert--process');

    var url = window.tab2Routes?.getPropertyVehicleDetailsByGraphQL || '';
    laws.ajax(url, {
        client_id: client_id,
        vin: vehicleVinValue,
        mileage: cleanVehicleMileageValue
    }, function(response, status) {
        var res = JSON.parse(response);
        $.systemMessage.close();
        if (res.status === 1 && res.finalData) {
            const finalData = res.finalData;
            const extraData = res.extraData;
            // set mileage
            $('.vehicle_property_mileage[name="property_vehicle[property_mileage][' + index + ']"]').val(finalData.mileage);
            // set price
            $('.vehicle_property_estimated_value[name="property_vehicle[property_estimated_value][' + index + ']"]').val(finalData.price);

           /* if(extraData){
                 downloadJson(extraData);
            }	*/
        }
        $.systemMessage.close();
        $.systemMessage("Property details added successfully.", "alert--success", true);
    });
    $('.vehicle_form_div_'+index).find(".vehicle-extra-data-info").removeClass('hide-data');
}

// Change Vehicle Type Function
function changeVehicleType(obj) {
    const previewDiv = $(obj).closest('.chip-style-tab').find('.vehicle-type-preview');
    const editDiv = $(obj).closest('.chip-style-tab').find('.vehicle-type-edit');

    if (previewDiv && editDiv) {
        previewDiv.addClass('hide-data');
        editDiv.removeClass('hide-data');
    }
}

// Property Step 4 - Financial Assets Functions
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

function showHideBusinessNameDiv(element, index) {
    const targetDiv = $('.bank_business_name_div_' + index);
    const selectedValue = $(element).val();
    if (selectedValue === "1") {
        targetDiv.addClass('hide-data');
    } else {
        targetDiv.removeClass('hide-data');
    }
}

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
}

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
}

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
}

function setSpaceSeperatedString(inputName, inputFor) {
    var checkedYears = [];
    $("input[type='checkbox'].justone." + inputFor + ":checked").each(function () {
        checkedYears.push($(this).val());
    });
    checkedYears.sort((a, b) => b - a);
    var spaceSeparatedString = checkedYears.join(" ");
    $("input[name='" + inputName + "']").val(spaceSeparatedString);
}

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
}

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
}

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
    } else {
        var index = $(thisObj).data('index');
        //showHideGuideVidDiv(index, selectedValue);
    }
}

// Property Step 5 - Business Assets Functions
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

// Property Step 6 - Farm Commercial Functions
function initializePropertyStep6() {
    var pstatus = (window.tab2Data && window.tab2Data.farmCommercialStatus) ? window.tab2Data.farmCommercialStatus : 0;
    if (pstatus == 0) {
        $("#property-part-f input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

// Property Step 7 - Miscellaneous Functions
function initializePropertyStep7() {
    var pstatus = (window.tab2Data && window.tab2Data.miscellaneousStatus) ? window.tab2Data.miscellaneousStatus : 0;
    if (pstatus == 0) {
        $("#property-part-g input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

// Property Step 4 Continue Functions
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

// Property Step 5 Continue Functions
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

// Common Utility Popup Functions
function initializeCommonUtilityPopup() {
    const previous_data = (window.tab2Data && window.tab2Data.previousData) ? window.tab2Data.previousData : '';
    initializeSelectedItems(previous_data);
}

// Initialize all property-related functionality
function initializePropertyFunctionality() {
    // Initialize based on current page/route
    if (typeof initializePropertyStep1 === 'function') initializePropertyStep1();
    if (typeof initializePropertyStep2 === 'function') initializePropertyStep2();
    if (typeof initializePropertyStep4 === 'function') initializePropertyStep4();
    if (typeof initializePropertyStep4Continue === 'function') initializePropertyStep4Continue();
    if (typeof initializePropertyStep5 === 'function') initializePropertyStep5();
    if (typeof initializePropertyStep5Continue === 'function') initializePropertyStep5Continue();
    if (typeof initializePropertyStep6 === 'function') initializePropertyStep6();
    if (typeof initializePropertyStep7 === 'function') initializePropertyStep7();
    if (typeof initializeCommonUtilityPopup === 'function') initializeCommonUtilityPopup();
}

// Additional Property Step 5 Functions
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
}

function checkUnique(thisobj) {
    var samecount = 0;
    $(".alimony_property_account").each(function () {
        if (thisobj.value != '' && $(this).val() != '' && $(this).val() == thisobj.value) {
            samecount = samecount + 1;
        }
        if (samecount > 1) {
            thisobj.value = '';
        }
    });
}

function storePreviousValue(thisObj) {
    $(thisObj).attr('data-previousvalue', $(thisObj).val());
}

function storePreviousAlimonyValue(thisObj) {
    $(thisObj).attr('data-previousvalue', $(thisObj).val());
}

// Export functions to global scope for backward compatibility
window.isMortgageThreeMonth = isMortgageThreeMonth;
window.isMortgageThreeMonthAdditional1 = isMortgageThreeMonthAdditional1;
window.isMortgageThreeMonthAdditional2 = isMortgageThreeMonthAdditional2;
window.isThreeMonthVehicle = isThreeMonthVehicle;
window.statecounty = statecounty;
window.emptySelectedItems = emptySelectedItems;
window.initializeSelectedItems = initializeSelectedItems;
window.handleCardClick = handleCardClick;
window.handleQuantityChange = handleQuantityChange;
window.handlePriceChange = handlePriceChange;
window.handlePriceOnBlur = handlePriceOnBlur;
window.customItemInput = customItemInput;
window.handleAddCustomItem = handleAddCustomItem;
window.handleSaveClick = handleSaveClick;
window.setBusinessValue = setBusinessValue;
window.handleS4ContinueSubmit = handleS4ContinueSubmit;
window.openPopup = openPopup;
window.isThreeMonthsCommon = isThreeMonthsCommon;
window.getPropertyResidenceDetailsByGraphQL = getPropertyResidenceDetailsByGraphQL;
window.savePropertyAndGenerateScreenshot = savePropertyAndGenerateScreenshot;
window.generatePropertyScreenshot = generatePropertyScreenshot;
window.showLoanDiv = showLoanDiv;
window.downloadJson = downloadJson;
window.showLoan2Div = showLoan2Div;
window.showLoan3Div = showLoan3Div;
// Export property-related functions to global scope
window.initializePropertyStep1 = initializePropertyStep1;
window.initializePropertyStep2 = initializePropertyStep2;
window.initializePropertyStep4 = initializePropertyStep4;
window.initializePropertyStep4Continue = initializePropertyStep4Continue;
window.initializePropertyStep5 = initializePropertyStep5;
window.initializePropertyStep5Continue = initializePropertyStep5Continue;
window.initializePropertyStep6 = initializePropertyStep6;
window.initializePropertyStep7 = initializePropertyStep7;
window.initializeCommonUtilityPopup = initializeCommonUtilityPopup;
window.checkUnknownVin = checkUnknownVin;
window.vinOnInput = vinOnInput;
window.checkVin2Number = checkVin2Number;
window.getPropertyVehicleDetailsByGraphQL = getPropertyVehicleDetailsByGraphQL;
window.changeVehicleType = changeVehicleType;
window.showHideBusinessNameDiv = showHideBusinessNameDiv;
window.checkUnknownRetirement = checkUnknownRetirement;
window.setSelectAll = setSelectAll;
window.setJustOne = setJustOne;
window.setSpaceSeperatedString = setSpaceSeperatedString;
window.selectTaxRefundType = selectTaxRefundType;
window.selectVPCAccount = selectVPCAccount;
window.selectVPCAAlimonyccount = selectVPCAAlimonyccount;
window.initializePropertyFunctionality = initializePropertyFunctionality;
// Export additional functions to global scope
window.propertyUnkown = propertyUnkown;
window.checkUnique = checkUnique;
window.storePreviousValue = storePreviousValue;
window.storePreviousAlimonyValue = storePreviousAlimonyValue;
