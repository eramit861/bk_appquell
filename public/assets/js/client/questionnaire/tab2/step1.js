getSecurityDepositsItems/**
 * Tab 2 - Step 1: Residence/Real Estate
 * Property residence functions including GraphQL property details
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 1 - Auto-click radio buttons if no data
 */
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

// ==================== PROPERTY DETAILS BY GRAPHQL ====================

/**
 * Get property residence details by GraphQL
 */
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
            $.systemMessage("Kindly enter your residence address before accessing the property details.", 'alert--danger', true);
            $streetInput.focus();
            return;
        }
    }

    if (isCheckedYes) {
        address = window.tab2Data?.BasicInfoPartAAddress || '';
    }

    if (!isCheckedNo && !isCheckedYes) {
        $.systemMessage("Kindly select your primary residence type before accessing the property details.", 'alert--danger', true);
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
};

/**
 * Save property and generate screenshot
 */
function savePropertyAndGenerateScreenshot(client_id, address, index) {
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
        dataType: 'json',
        async: true,
        timeout: 30000,
        success: function (response) {
            var res = response;

            if (res.status === 1) {
                $.systemMessage("Property saved. Generating screenshot...", 'alert--process');

                // Add or update the property_id input without changing the form mode
                var $propertyIdInput = $('input[name="property_resident[id][' + index + ']"]');
                if ($propertyIdInput.length === 0) {
                    var propertyIdInput = '<input type="hidden" name="property_resident[id][' + index + ']" value="' + res.property_id + '">';
                    $('#client_property_step1').append(propertyIdInput);
                } else {
                    $propertyIdInput.val(res.property_id);
                }

                // Keep the form in edit mode
                $('.residence_form_' + index).removeClass('hide-data');
                $('.residence_form_summary_' + index).addClass('hide-data');

                var property_id = res.property_id || $('input[name="property_resident[id][' + index + ']"]').val();
                generatePropertyScreenshot(client_id, address, property_id, index);
            } else {
                $.systemMessage(res.msg || "Failed to save property", 'alert--danger', true);
            }
        },
        error: function (xhr, status, error) {
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
};

/**
 * Generate property screenshot using GraphQL
 */
function generatePropertyScreenshot(client_id, address, property_id, index) {
    $.systemMessage("Grabbing Property Details. Hold Please.", 'alert--process');

    var url = window.tab2Data?.graphqlurl || null;
    laws.ajax(url, {
        client_id: client_id,
        address: address,
        property_id: property_id
    }, function (response, status) {
        var res = JSON.parse(response);
        if (res.status === 1 && res.finalData) {
            const finalData = res.finalData;
            const extraData = res.extraData;
            $('.poperty-type-div-' + index).removeClass('hide-data');

            // Find the radio input that matches the property type value
            $('input.property[type="radio"][data-index="' + index + '"]').each(function () {
                const isMatch = $(this).val() == finalData.property_type;
                if (isMatch) {
                    const id = $(this).attr('id');
                    $('label[for="' + id + '"]').trigger('click');
                }
            });

            // Set property values
            $('.estimated_property_value[data-index="' + index + '"]').val(finalData.price);
            $('.bedroom[data-index="' + index + '"]').val(finalData.beds);
            $('.bathroom[data-index="' + index + '"]').val(finalData.baths);
            $('.home_sq_ft[data-index="' + index + '"]').val(finalData.lot_size);

            $.systemMessage.close();
            $('.estimated-value-div-' + index).removeClass('hide-data');
            $.systemMessage("Property details added successfully.", "alert--success", true);
        } else {
            $.systemMessage(res.msg, 'alert--danger', true);
        }
        $('.poperty-type-div-' + index + ' .property_mortgage_section').removeClass('hide-data');
    });
};

// ==================== LOAN DIV FUNCTIONS ====================

function showLoanDiv(index) {
    var btnStatus = checkAllFieldsFilledForLoanDiv(index);
    if (btnStatus) {
        $('.loan-div-' + index).removeClass('hide-data');
    }
};

$(document).on("click", ".loan-2-div .btn-toggle", function () {
    var inputId = $(this).attr("for");
    var $input = $('#' + inputId);

    if ($input.length && $input.is(':radio')) {
        showLoan3Div($input[0]);
    }
});

function showLoan3Div(obj) {
    var objIndex = $(obj).attr("data-index");
    var btnStatus = checkAllFieldsFilledForLoan2Div(objIndex);
    if (btnStatus) {
        $('.loan-3-main-div-' + objIndex).removeClass('hide-data');
    }
};

$(document).on("input change", ".loan-1-div :input:visible", function () {
    showLoan2Div(this);
});

$(document).on("click", ".loan-1-div .btn-toggle", function () {
    var inputId = $(this).attr("for");
    var $input = $('#' + inputId);

    if ($input.length && $input.is(':radio')) {
        showLoan2Div($input[0]);
    }
});

function showLoan2Div(obj) {
    var objIndex = $(obj).attr("data-index");
    var btnStatus = checkAllFieldsFilledForLoan1Div(objIndex);
    if (btnStatus) {
        $('.loan-2-main-div-' + objIndex).removeClass('hide-data');
    }
};

// ==================== UTILITY FUNCTIONS ====================

function downloadJson(jsonData) {
    try {
        const parsedJson = JSON.parse(jsonData);
        const formattedJson = JSON.stringify(parsedJson, null, 2);

        const blob = new Blob([formattedJson], {
            type: 'text/plain'
        });

        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'response.txt';

        document.body.appendChild(a);
        a.click();

        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    } catch (e) {
        console.error('Invalid JSON:', e);
        alert('Error: Invalid JSON data');
    }
};

// ==================== ADD MORE RESIDENCE FUNCTIONS (FROM QUESTIONARRIE.JS) ====================

/**
 * Toggle eviction pending data visibility
 * @param {string} value - 'yes' or 'no'
 * @param {number} index - Property index
 */
function get_eviction_pending(value, index) {
    if (value == "yes") {
        $(".eviction_pending_data_" + index).removeClass("hide-data");
    } else if (value == "no") {
        $(".eviction_pending_data_" + index).addClass("hide-data");
    }
};

/**
 * Check pending eviction and show/hide fields
 * @param {string} value - 'yes' or 'no'
 * @param {number} index - Property index
 */
function checkPendingEviction(value, index) {
    if (value == "yes") {
        $(".eviction_pending_radio_" + index).removeClass("hide-data");
    } else if (value == "no") {
        $(".eviction_pending_radio_" + index).addClass("hide-data");
        $('input[name="property_resident[eviction_pending][' + index + ']"][value="0"]').prop("checked", true);
        $(".eviction_pending_data_" + index).addClass("hide-data");
    }
};

/**
 * Add new residence form (clones last residence and updates all field names/IDs)
 * This is a LARGE function that handles form cloning for adding multiple properties
 * Extracted from questionarrie.js (originally line 1289)
 * 
 * @param {boolean} saveFromAttorney - Whether saving from attorney side
 */
async function addResidenceForm(saveFromAttorney = false) {
    var saveData = await saveResident(true, {}, false, saveFromAttorney);
    if (saveData == false) {
        return false;
    }
    var clnln = $(document).find(".residence_property_main_div").length;
    if (clnln > 4) {
        $.systemMessage('You can only insert 5 properties.', "alert--danger", true);
        return false;
    } else {
        var itm = $(document).find(".residence_property_main_div").last();
        var index_val = clnln;

        prevIndex = index_val - 1;
        nextIndex = index_val + 1;
        var cln = $(itm).clone();

        let parentDivClass = 'residence_property_main_div';
        cln.removeClass(function (index, className) {
            return (className.match(parentDivClass + "_\\d+", "g") || []).join(' ');
        }).addClass(parentDivClass + "_" + index_val);
        cln.find(".circle-number-div").html(index_val + 1);
        cln.find(".client-edit-button").attr("onclick", "display_resident_div('" + index_val + "', )");

        let security_deposit_circle_no = cln.find(".circle-number-div.security_deposit");
        $(security_deposit_circle_no).each(function (index) {
            $(this).html(index + 1);
        });

        cln.find("label").removeClass("active");

        $(document)
            .find(".residence_form_summary_" + index_val)
            .removeClass("hide-data");
        $(".residence_form" + index_val).addClass("hide-data");
        cln.find(".residence_form_summary").addClass("hide-data");
        cln.find(".residence_form").removeClass("hide-data");
        if (index_val > 0) {
            cln.find(".important-r").addClass("hide-data");
        }
        var owned_by = cln.find(".property_owned_by");
        var address = cln.find(".address");
        var mortgage_name = cln.find(".mortgage_name");
        var not_primary_address = cln.find(".not_primary_address");
        var mortgage_address = cln.find(".mortgage_address");
        var mortgage_city = cln.find(".mortgage_city");
        var mortgage_state = cln.find(".mortgage_state");
        var mortgage_zip = cln.find(".mortgage_zip");
        var mortgage_county = cln.find(".mortgage_county");
        var mortgage_loan = cln.find(".mortgage_loan");
        var mortgage_loan_rate = cln.find(".mortgage_loan_rate");
        var payments_left = cln.find(".payments_left");
        var estimated_property_value = cln.find(".estimated_property_value");

        var bedroom = cln.find(".bedroom");
        var bathroom = cln.find(".bathroom");
        var home_sq_ft = cln.find(".home_sq_ft");
        var lot_size_acres = cln.find(".lot_size_acres");
        var property_other_input = cln.find(".property_other_input");

        var saveBtn = cln.find(".save-btn");
        var trashBtn = cln.find(".trash-btn");
        var residence_property_main_div = cln.find(".residence_property_main_div");
        var residence_form_summary = cln.find(".residence_form_summary");
        var residence_form = cln.find(".residence_form");
        var property_mortgage_section = cln.find(".property_mortgage_section");
        // div
        var main_property_section = cln.find(".main-property-section");

        $(main_property_section).each(function () {
            $(this).removeClass("main-property-section-" + prevIndex)
                .addClass("main-property-section-" + index_val);
        });

        cln.find(".currently_lived_data").addClass(" hide-data ");
        cln.find(".resident_rent_data").addClass(" hide-data ");

        cln.find(".poperty-type-div-" + prevIndex)
            .removeClass("poperty-type-div-" + prevIndex)
            .addClass("poperty-type-div-" + index_val + " hide-data ");
        cln.find(".description-div-" + prevIndex)
            .removeClass("description-div-" + prevIndex)
            .addClass("description-div-" + index_val + " d-none ");
        cln.find(".description-and-lot-size-div-" + prevIndex)
            .removeClass("description-and-lot-size-div-" + prevIndex)
            .addClass("description-and-lot-size-div-" + index_val + " d-none ");
        cln.find(".estimated-value-div-" + prevIndex)
            .removeClass("estimated-value-div-" + prevIndex)
            .addClass("estimated-value-div-" + index_val + " hide-data ");
        cln.find(".loan-div-" + prevIndex)
            .removeClass("loan-div-" + prevIndex)
            .addClass("loan-div-" + index_val + " hide-data ");
        cln.find(".loan-1-div-" + prevIndex)
            .removeClass("loan-1-div-" + prevIndex)
            .addClass("loan-1-div-" + index_val);
        cln.find(".loan-2-div-" + prevIndex)
            .removeClass("loan-2-div-" + prevIndex)
            .addClass("loan-2-div-" + index_val);
        cln.find(".loan-2-main-div-" + prevIndex)
            .removeClass("loan-2-main-div-" + prevIndex)
            .addClass("loan-2-main-div-" + index_val + " hide-data ");
        cln.find(".loan-3-main-div-" + prevIndex)
            .removeClass("loan-3-main-div-" + prevIndex)
            .addClass("loan-3-main-div-" + index_val + " hide-data ");
        cln.find(".payment_not_primary_address_data").addClass(" hide-data ");
        cln.find(".property_codebtor_cosigner_data").addClass(" hide-data ");
        cln.find(".loan_own_type_property_sec").addClass(" hide-data ");
        cln.find(".section_additional_loan").addClass(" hide-data ");
        cln.find(".section_additional_loan_second").addClass(" hide-data ");

        cln.find(".eviction_pending_radio_" + prevIndex).removeClass("eviction_pending_radio_" + prevIndex).addClass("eviction_pending_radio_" + index_val + " hide-data ");
        cln.find(".eviction_pending_data_" + prevIndex).removeClass("eviction_pending_data_" + prevIndex).addClass("eviction_pending_data_" + index_val + " hide-data ");

        var rented_residence_cc = cln.find(".rented_residence_cc");
        var eviction_pending_cc = cln.find(".eviction_pending_cc");

        var ep_data_name = cln.find('.ep_data_name');
        var ep_data_address = cln.find('.ep_data_address');
        var ep_data_city = cln.find('.ep_data_city');
        var ep_data_state = cln.find('.ep_data_state');
        var ep_data_zip = cln.find('.ep_data_zip');

        var get_property_residence_details_by_graphql = cln.find(".get-property-details-by-graphql");

        $(get_property_residence_details_by_graphql).attr('onclick', "getPropertyResidenceDetailsByGraphQL(" + index_val + ")");

        $(rented_residence_cc).each(function () {
            $(this).attr('name', 'property_resident[rented_residence][' + index_val + ']');
            if ($(this).val() == "0") {
                $(this).attr('onchange', "checkPendingEviction('no', '" + index_val + "')");
            }
            if ($(this).val() == "1") {
                $(this).attr('onchange', "checkPendingEviction('yes', '" + index_val + "')");
            }
        });

        $(eviction_pending_cc).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending][' + index_val + ']');

            if ($(this).val() == "0") {
                $(this).attr("id", "eviction-pending-no-" + index_val);
                $(this).next("label").attr("for", "eviction-pending-no-" + index_val).attr('onclick', "get_eviction_pending('no', '" + index_val + "')");
            }

            if ($(this).val() == "1") {
                $(this).attr("id", "eviction-pending-yes-" + index_val);
                $(this).next("label").attr("for", "eviction-pending-yes-" + index_val).attr('onclick', "get_eviction_pending('yes', '" + index_val + "')");
            }
        });

        $(ep_data_name).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data][' + index_val + '][Name]');
        });

        $(ep_data_address).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data][' + index_val + '][Address]');
        });

        $(ep_data_city).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data][' + index_val + '][City]');
        });

        $(ep_data_state).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data][' + index_val + '][State]');
        });

        $(ep_data_zip).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data][' + index_val + '][Zip]');
        });


        $(residence_property_main_div).each(function () {
            $(this).removeClass("residence_property_main_div_" + prevIndex)
                .addClass("residence_property_main_div_" + index_val);

        });

        $(residence_form_summary).each(function () {
            $(this).removeClass("residence_form_summary_" + prevIndex)
                .addClass("residence_form_summary_" + index_val);
        });
        $(residence_form).each(function () {
            $(this).removeClass("residence_form_" + prevIndex)
                .addClass("residence_form_" + index_val);
        });

        $(saveBtn).each(function () {
            if (!saveFromAttorney) {
                $(this).attr(
                    "onclick",
                    'saveResident(true,this,true,false);'
                );
            } else {
                $(this).attr(
                    "onclick",
                    'saveResident(true,this,true,true);'
                );
            }

        });

        $(trashBtn).each(function () {
            if (!saveFromAttorney) {
                $(this).attr(
                    "onclick",
                    "remove_resident_div(" + (index_val) + ", false);"
                );
            } else {
                $(this).attr(
                    "onclick",
                    "remove_resident_div(" + (index_val) + ", true);"
                );
            }
        });

        $(bedroom).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                index_val +
                "][bedroom]"
            );
            $(this).attr("data-index", index_val);
        });
        $(bathroom).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                index_val +
                "][bathroom]"
            );
            $(this).attr("data-index", index_val);
        });
        $(home_sq_ft).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                index_val +
                "][home_sq_ft]"
            );
            $(this).attr("data-index", index_val);
        });
        $(lot_size_acres).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                index_val +
                "][lot_size_acres]"
            );
            $(this).attr("data-index", index_val);
        });



        var monthly_payment = cln.find(".monthly_payment");
        var property = cln.find(".property");
        var taxes_insurance = cln.find(".taxes_insurance");
        var currently_lived = cln.find(".currently_lived").addClass("required"); /// added to show validation error on property tab

        var retain_above_property = cln.find(".retain_above_property");

        var doclink1 = cln.find(".loan1-d-link");
        var doclink2 = cln.find(".loan2-d-link");
        var doclink3 = cln.find(".loan3-d-link");

        var doccard1 = cln.find(".loan1-d-card");
        var doccard2 = cln.find(".loan2-d-card");
        var doccard3 = cln.find(".loan3-d-card");

        $(doccard1).each(function () {
            $(this).text("Current Mortgage Statement 1 of " + (index_val + 1));
        });
        $(doccard2).each(function () {
            $(this).text("Current Mortgage Statement 2 of " + (index_val + 1));
        });
        $(doccard3).each(function () {
            $(this).text("Current Mortgage Statement 3 of " + (index_val + 1));
        });

        $(doclink1).each(function () {
            $(this).attr(
                "title",
                "Current_Mortgage_Statement_1_" + (index_val + 1)
            );
        });
        $(doclink2).each(function () {
            $(this).attr(
                "title",
                "Current_Mortgage_Statement_2_" + (index_val + 1)
            );
        });
        $(doclink3).each(function () {
            $(this).attr(
                "title",
                "Current_Mortgage_Statement_3_" + (index_val + 1)
            );
        });

        //home loan section
        var loan_own_type_property = cln.find(".loan_own_type_property");
        var vehicle_amount_own = cln.find(".vehicle_amount_own");
        var vehicle_account_number = cln.find(".vehicle_account_number");
        var vehicle_debt_incurred_date = cln.find(
            ".vehicle_debt_incurred_date"
        );
        var vehicle_creditor_name = cln.find(".mortgage_vehicle_creditor_name");
        var vehicle_creditor_name_addresss = cln.find(
            ".vehicle_creditor_name_addresss"
        );
        var vehicle_creditor_city = cln.find(".vehicle_creditor_city");
        var vehicle_creditor_state = cln.find(".vehicle_creditor_state");
        var vehicle_creditor_zip = cln.find(".vehicle_creditor_zip");
        var vehicle_payment_tax_insurance = cln.find(
            ".vehicle_payment_tax_insurance"
        );
        var vehicle_monthly_payment = cln.find(".vehicle_monthly_payment");
        var vehicle_payment_remaining = cln.find(".vehicle_payment_remaining");
        var vehicle_debt_owned_by = cln.find(".vehicle_debt_owned_by");
        var vehicle_codebtor = cln.find(".vehicle_codebtor");
        var vehicle_codebtor_info = cln.find(".vehicle_codebtor_info");
        var vehicle_due_payment = cln.find(".vehicle_due_payment");
        var vehicle_current_interest_rate = cln.find(
            ".vehicle_current_interest_rate"
        );

        var three_month_mortgage_1 = cln.find(".three_month_mortgage_1");
        var three_month_mortgage_2 = cln.find(".three_month_mortgage_2");
        var three_month_mortgage_3 = cln.find(".three_month_mortgage_3");
        var three_months_div = cln.find(".three_months_div");
        var additional_three_months_div = cln.find(
            ".additional_three_months_div"
        );
        var second_additional_three_months_div = cln.find(
            ".second_additional_three_months_div"
        );

        var payment_1_of_1 = cln.find(".payment_1_of_1");
        var payment_2_of_1 = cln.find(".payment_2_of_1");
        var payment_3_of_1 = cln.find(".payment_3_of_1");
        var payment_1_of_2 = cln.find(".payment_1_of_2");
        var payment_2_of_2 = cln.find(".payment_2_of_2");
        var payment_3_of_2 = cln.find(".payment_3_of_2");
        var payment_1_of_3 = cln.find(".payment_1_of_3");
        var payment_2_of_3 = cln.find(".payment_2_of_3");
        var payment_3_of_3 = cln.find(".payment_3_of_3");
        var payment_dates_1_of_1 = cln.find(".payment_dates_1_of_1");
        var payment_dates_2_of_1 = cln.find(".payment_dates_2_of_1");
        var payment_dates_3_of_1 = cln.find(".payment_dates_3_of_1");
        var payment_dates_1_of_2 = cln.find(".payment_dates_1_of_2");
        var payment_dates_2_of_2 = cln.find(".payment_dates_2_of_2");
        var payment_dates_3_of_2 = cln.find(".payment_dates_3_of_2");
        var payment_dates_1_of_3 = cln.find(".payment_dates_1_of_3");
        var payment_dates_2_of_3 = cln.find(".payment_dates_2_of_3");
        var payment_dates_3_of_3 = cln.find(".payment_dates_3_of_3");
        var total_amount_paid_1_of_1 = cln.find(".total_amount_paid_1_of_1");
        var total_amount_paid_1_of_2 = cln.find(".total_amount_paid_1_of_2");
        var total_amount_paid_1_of_3 = cln.find(".total_amount_paid_1_of_3");

        var loan_property_owned_by = cln.find(".loan_property_owned_by");
        var loan_cosigner_vehicle_creditor_name = cln.find(
            ".loan_cosigner_vehicle_creditor_name"
        );
        var loan_cosigner_vehicle_creditor_name_addresss = cln.find(
            ".loan_cosigner_vehicle_creditor_name_addresss"
        );
        var loan_cosigner_vehicle_creditor_city = cln.find(
            ".loan_cosigner_vehicle_creditor_city"
        );
        var loan_cosigner_vehicle_creditor_state = cln.find(
            ".loan_cosigner_vehicle_creditor_state"
        );
        var loan_cosigner_vehicle_creditor_zip = cln.find(
            ".loan_cosigner_vehicle_creditor_zip"
        );

        var loan2_property_owned_by = cln.find(".loan2_property_owned_by");
        var loan2_cosigner_vehicle_creditor_name = cln.find(
            ".loan2_cosigner_vehicle_creditor_name"
        );
        var loan2_cosigner_vehicle_creditor_name_addresss = cln.find(
            ".loan2_cosigner_vehicle_creditor_name_addresss"
        );
        var loan2_cosigner_vehicle_creditor_city = cln.find(
            ".loan2_cosigner_vehicle_creditor_city"
        );
        var loan2_cosigner_vehicle_creditor_state = cln.find(
            ".loan2_cosigner_vehicle_creditor_state"
        );
        var loan2_cosigner_vehicle_creditor_zip = cln.find(
            ".loan2_cosigner_vehicle_creditor_zip"
        );

        var loan3_property_owned_by = cln.find(".loan3_property_owned_by");
        var loan3_cosigner_vehicle_creditor_name = cln.find(
            ".loan3_cosigner_vehicle_creditor_name"
        );
        var loan3_cosigner_vehicle_creditor_name_addresss = cln.find(
            ".loan3_cosigner_vehicle_creditor_name_addresss"
        );
        var loan3_cosigner_vehicle_creditor_city = cln.find(
            ".loan3_cosigner_vehicle_creditor_city"
        );
        var loan3_cosigner_vehicle_creditor_state = cln.find(
            ".loan3_cosigner_vehicle_creditor_state"
        );
        var loan3_cosigner_vehicle_creditor_zip = cln.find(
            ".loan3_cosigner_vehicle_creditor_zip"
        );

        var loan2_vehicle_amount_own = cln.find(".loan2_vehicle_amount_own");
        var loan2_vehicle_account_number = cln.find(
            ".loan2_vehicle_account_number"
        );
        var loan2_vehicle_debt_incurred_date = cln.find(
            ".loan2_vehicle_debt_incurred_date"
        );
        var loan2_vehicle_monthly_payment = cln.find(
            ".loan2_vehicle_monthly_payment"
        );
        var loan2_vehicle_creditor_name = cln.find(
            ".loan2_vehicle_creditor_name"
        );
        var loan2_vehicle_creditor_name_addresss = cln.find(
            ".loan2_vehicle_creditor_name_addresss"
        );
        var loan2_vehicle_creditor_city = cln.find(
            ".loan2_vehicle_creditor_city"
        );
        var loan2_vehicle_creditor_state = cln.find(
            ".loan2_vehicle_creditor_state"
        );
        var loan2_vehicle_creditor_zip = cln.find(
            ".loan2_vehicle_creditor_zip"
        );
        var loan2_vehicle_payment_remaining = cln.find(
            ".loan2_vehicle_payment_remaining"
        );
        var loan2_vehicle_payment_tax_insurance = cln.find(
            ".loan2_vehicle_payment_tax_insurance"
        );
        var additional_loan1 = cln.find(".additional_loan1");
        var loan2_vehicle_due_payment = cln.find(".loan2_vehicle_due_payment");
        var loan2_vehicle_current_interest_rate = cln.find(
            ".loan2_vehicle_current_interest_rate"
        );

        var loan3_vehicle_amount_own = cln.find(".loan3_vehicle_amount_own");
        var loan3_vehicle_account_number = cln.find(
            ".loan3_vehicle_account_number"
        );
        var loan3_vehicle_debt_incurred_date = cln.find(
            ".loan3_vehicle_debt_incurred_date"
        );
        var loan3_vehicle_monthly_payment = cln.find(
            ".loan3_vehicle_monthly_payment"
        );
        var loan3_vehicle_creditor_name = cln.find(
            ".loan3_vehicle_creditor_name"
        );
        var loan3_vehicle_creditor_name_addresss = cln.find(
            ".loan3_vehicle_creditor_name_addresss"
        );
        var loan3_vehicle_creditor_city = cln.find(
            ".loan3_vehicle_creditor_city"
        );
        var loan3_vehicle_creditor_state = cln.find(
            ".loan3_vehicle_creditor_state"
        );
        var loan3_vehicle_creditor_zip = cln.find(
            ".loan3_vehicle_creditor_zip"
        );
        var loan3_vehicle_payment_remaining = cln.find(
            ".loan3_vehicle_payment_remaining"
        );
        var loan3_vehicle_payment_tax_insurance = cln.find(
            ".loan3_vehicle_payment_tax_insurance"
        );
        var additional_loan2 = cln.find(".additional_loan2");

        var loan3_vehicle_current_interest_rate = cln.find(
            ".loan3_vehicle_current_interest_rate"
        );
        var loan3_vehicle_due_payment = cln.find(".loan3_vehicle_due_payment");

        var residence_rent = cln.find(".residence_rent");

        $(residence_rent).each(function () {
            $(this).attr("name", "property_resident[rent][" + index_val + "]");
        });

        $(loan2_vehicle_payment_tax_insurance).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][payment_tax_insurance][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr(
                    "id",
                    "loan2_vehicle_payment_tax_insurance_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "loan2_vehicle_payment_tax_insurance_no_" + index_val
                    );
            }
            if ($(this).val() == "2") {
                $(this).attr(
                    "id",
                    "loan2_vehicle_payment_tax_insurance_yes_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "loan2_vehicle_payment_tax_insurance_yes_" + index_val
                    );
            }
        });
        $(loan2_vehicle_monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][monthly_payment][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_payment_remaining).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][payment_remaining][" +
                index_val +
                "]"
            );
        });

        $(loan2_vehicle_amount_own).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][amount_own][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_vehicle_account_number).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][account_number][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_debt_incurred_date).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][debt_incurred_date][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
            $(this).removeClass("hasDatepicker").attr("id", "");
        });
        $(loan2_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_name][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_name_addresss][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_city][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_state][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_zip][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_current_interest_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][current_interest_rate][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_due_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][due_payment][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan3_vehicle_payment_tax_insurance).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][payment_tax_insurance][" +
                index_val +
                "]"
            );
            if ($(this).val() == "1") {
                $(this).attr("id", "loan3_vehicle_payment_tax_insurance_no_" + index_val);
                $(this).next("label").attr("for", "loan3_vehicle_payment_tax_insurance_no_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "loan3_vehicle_payment_tax_insurance_yes_" + index_val);
                $(this).next("label").attr("for", "loan3_vehicle_payment_tax_insurance_yes_" + index_val);
            }
        });
        $(loan3_vehicle_monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][monthly_payment][" +
                index_val +
                "]"
            );
        });
        $(loan3_vehicle_payment_remaining).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][payment_remaining][" +
                index_val +
                "]"
            );
        });

        $(loan3_vehicle_amount_own).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][amount_own][" +
                index_val +
                "]"
            );
        });

        $(loan3_vehicle_account_number).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][account_number][" +
                index_val +
                "]"
            );
        });
        $(loan3_vehicle_debt_incurred_date).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][debt_incurred_date][" +
                index_val +
                "]"
            );
            $(this).removeClass("hasDatepicker").attr("id", "");
        });
        $(loan3_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_name][" +
                index_val +
                "]"
            );
        });
        $(loan3_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_name_addresss][" +
                index_val +
                "]"
            );
        });
        $(loan3_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_city][" +
                index_val +
                "]"
            );
        });
        $(loan3_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_state][" +
                index_val +
                "]"
            );
        });
        $(loan3_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_zip][" +
                index_val +
                "]"
            );
        });

        $(loan3_vehicle_current_interest_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][current_interest_rate][" +
                index_val +
                "]"
            );
        });
        $(loan3_vehicle_due_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][due_payment][" +
                index_val +
                "]"
            );
        });

        $(property).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[property][" + index_val + "]"
            );

            $(this).next("label").attr("for", $(this).attr("id"));
            $(this).attr("data-index", index_val);
        });
        $(property_other_input).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_other_name][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
            if (!$(this).hasClass("d-none")) {
                $(this).addClass("d-none");
            }
        });
        $(address).each(function () {
            $(this).attr(
                "name",
                "property_resident[address][" + index_val + "]"
            );
        });
        $(mortgage_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_name][" + index_val + "]"
            );
        });
        $(not_primary_address).each(function () {
            $(this).attr(
                "name",
                "property_resident[not_primary_address][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr(
                    "id",
                    "payment_not_primary_address_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr("for", "payment_not_primary_address_no_" + index_val)
                    .attr("data-index", index_val);
            }
            if ($(this).val() == "0") {
                $(this).attr(
                    "id",
                    "payment_not_primary_address_yes_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "payment_not_primary_address_yes_" + index_val
                    )
                    .attr("data-index", index_val);
            }
        });
        $(retain_above_property).each(function () {
            $(this).attr(
                "name",
                "property_resident[retain_above_property][" + index_val + "]"
            );
            if ($(this).val() == "1") {
                $(this).attr("id", "retain_above_property_yes_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "retain_above_property_yes_" + index_val);
            }
            if ($(this).val() == "0") {
                $(this).attr("id", "retain_above_property_no_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "retain_above_property_no_" + index_val);
            }
        });
        $(mortgage_address).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_address][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(mortgage_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_city][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(mortgage_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_state][" + index_val + "]"
            );
            $(this).attr("id", "mortgage_state_" + index_val);
            $(this).attr("data-countyid", "mortgage_county_" + index_val);
            $(this).attr("data-index", index_val);
        });
        $(mortgage_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_zip][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(mortgage_county).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_county][" + index_val + "]"
            );
            $(this).attr("id", "mortgage_county_" + index_val);
            $(this).attr("data-index", index_val);
        });
        $(mortgage_loan).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_loan][" + index_val + "]"
            );
        });
        $(mortgage_loan_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_loan_rate][" + index_val + "]"
            );
        });
        $(monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[monthly_payment][" + index_val + "]"
            );
        });
        $(payments_left).each(function () {
            $(this).attr(
                "name",
                "property_resident[payments_left][" + index_val + "]"
            );
        });
        $(estimated_property_value).each(function () {
            $(this).attr(
                "name",
                "property_resident[estimated_property_value][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(taxes_insurance).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[taxes_insurance][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(currently_lived).each(function () {
            $(this).attr("id", $(this).attr("id") + "_" + index_val);
            $(this).attr(
                "name",
                "property_resident[currently_lived][" + index_val + "]"
            );
            $(this).attr("checked", false); /// added to show validation error on property tab
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(owned_by).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[property_owned_by][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        //Home loan
        cln.find('input[type="text"]').val("");
        cln.find('input[type="radio"]').prop("checked", false);
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");

        $(vehicle_amount_own).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][amount_own][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_account_number).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][account_number][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_debt_incurred_date).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][debt_incurred_date][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
            $(this).removeClass("hasDatepicker").attr("id", "");
        });
        $(vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_name][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_name_addresss][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_city][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_state][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_zip][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_current_interest_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][current_interest_rate][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_due_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][due_payment][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        // for loan 1
        $(three_month_mortgage_1).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][is_mortgage_three_months][" +
                index_val +
                "]"
            );
            if ($(this).val() == "1") {
                $(this).next('label').attr(
                    "onclick",
                    "isThreeMonthsCommon('yes','three_months_div_" + index_val + "'); isMortgageThreeMonth('yes'," + index_val + ")"
                );
                $(this).attr("id", "is_mortgage_three_months_yes_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "is_mortgage_three_months_yes_" + index_val);
            }
            if ($(this).val() == "0") {
                $(this).next('label').attr(
                    "onclick",
                    "isThreeMonthsCommon('no','three_months_div_" + index_val + "'); isMortgageThreeMonth('no'," + index_val + ")"
                );
                $(this).attr("id", "is_mortgage_three_months_no_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "is_mortgage_three_months_no_" + index_val);
            }
            $(this).attr("data-index", index_val);
        });
        $(payment_1_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_1][" + index_val + "]"
        );
        $(payment_1_of_1).attr("data-index", index_val);
        $(payment_2_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_2][" + index_val + "]"
        );
        $(payment_2_of_1).attr("data-index", index_val);
        $(payment_3_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_3][" + index_val + "]"
        );
        $(payment_3_of_1).attr("data-index", index_val);
        $(payment_dates_1_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_dates_1][" +
            index_val +
            "]"
        );
        $(payment_dates_2_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_dates_2][" +
            index_val +
            "]"
        );
        $(payment_dates_3_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_dates_3][" +
            index_val +
            "]"
        );
        $(total_amount_paid_1_of_1).attr(
            "name",
            "property_resident[home_car_loan][total_amount_paid][" +
            index_val +
            "]"
        );
        // for loan 2
        $(three_month_mortgage_2).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][is_mortgage_three_months][" +
                index_val +
                "]"
            );
            if ($(this).val() == "1") {
                $(this).next('label').attr("onclick", "isThreeMonthsCommon('yes','additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional1('yes'," + index_val + ")");
                $(this).attr(
                    "id",
                    "additional_is_mortgage_three_months_yes_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "additional_is_mortgage_three_months_yes_" + index_val
                    );
            }
            if ($(this).val() == "0") {
                $(this).next('label').attr("onclick", "isThreeMonthsCommon('no','additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional1('no'," + index_val + ")");
                $(this).attr(
                    "id",
                    "additional_is_mortgage_three_months_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "additional_is_mortgage_three_months_no_" + index_val
                    );
            }
            $(this).attr("data-index", index_val);
        });
        $(payment_1_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_1][" + index_val + "]"
        );
        $(payment_1_of_2).attr("data-index", index_val);
        $(payment_2_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_2][" + index_val + "]"
        );
        $(payment_2_of_2).attr("data-index", index_val);
        $(payment_3_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_3][" + index_val + "]"
        );
        $(payment_3_of_2).attr("data-index", index_val);
        $(payment_dates_1_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_dates_1][" +
            index_val +
            "]"
        );
        $(payment_dates_2_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_dates_2][" +
            index_val +
            "]"
        );
        $(payment_dates_3_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_dates_3][" +
            index_val +
            "]"
        );
        $(total_amount_paid_1_of_2).attr(
            "name",
            "property_resident[home_car_loan2][total_amount_paid][" +
            index_val +
            "]"
        );
        // for loan 3
        $(three_month_mortgage_3).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][is_mortgage_three_months][" +
                index_val +
                "]"
            );
            if ($(this).val() == "1") {
                $(this).next('label').attr("onclick", "isThreeMonthsCommon('yes','second_additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional2('yes'," + index_val + ")");
                $(this).attr(
                    "id",
                    "second_additional_is_mortgage_three_months_yes_" +
                    index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "second_additional_is_mortgage_three_months_yes_" +
                        index_val
                    );
            }
            if ($(this).val() == "0") {
                $(this).next('label').attr("onclick", "isThreeMonthsCommon('no','second_additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional2('no'," + index_val + ")");
                $(this).attr(
                    "id",
                    "second_additional_is_mortgage_three_months_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "second_additional_is_mortgage_three_months_no_" +
                        index_val
                    );
            }
        });
        $(payment_1_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_1][" + index_val + "]"
        );
        $(payment_1_of_3).attr("data-index", index_val);
        $(payment_2_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_2][" + index_val + "]"
        );
        $(payment_2_of_3).attr("data-index", index_val);
        $(payment_3_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_3][" + index_val + "]"
        );
        $(payment_3_of_3).attr("data-index", index_val);
        $(payment_dates_1_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_dates_1][" +
            index_val +
            "]"
        );
        $(payment_dates_2_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_dates_2][" +
            index_val +
            "]"
        );
        $(payment_dates_3_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_dates_3][" +
            index_val +
            "]"
        );
        $(total_amount_paid_1_of_3).attr(
            "name",
            "property_resident[home_car_loan3][total_amount_paid][" +
            index_val +
            "]"
        );

        $(three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this)
                .removeClass("three_months_div_" + prev_index)
                .addClass("three_months_div_" + index_val + " hide-data");
        });
        $(additional_three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this)
                .removeClass("additional_three_months_div_" + prev_index)
                .addClass(
                    "additional_three_months_div_" + index_val + " hide-data"
                );
        });
        $(second_additional_three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this)
                .removeClass("second_additional_three_months_div_" + prev_index)
                .addClass(
                    "second_additional_three_months_div_" +
                    index_val +
                    " hide-data"
                );
        });

        $(loan_property_owned_by).each(function () {
            $(this).attr("name", "property_resident[home_car_loan][property_owned_by][" + index_val + "]");
            $(this).attr("data-index", index_val);

            if ($(this).val() == "1") {
                $(this).attr("id", "owned_by_you_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_you_loan1_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "owned_by_spouse_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_spouse_loan1_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "owned_by_joint_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_joint_loan1_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "owned_by_other_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_other_loan1_" + index_val);
            }
        });

        $(loan_cosigner_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_name][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_name_addresss][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_city][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_state][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_zip][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_property_owned_by).each(function () {
            $(this).attr("name", "property_resident[home_car_loan2][property_owned_by][" + index_val + "]");
            $(this).attr("data-index", index_val);

            if ($(this).val() == "1") {
                $(this).attr("id", "owned_by_you_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_you_loan2_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "owned_by_spouse_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_spouse_loan2_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "owned_by_joint_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_joint_loan2_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "owned_by_other_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_other_loan2_" + index_val);
            }
        });

        $(loan2_cosigner_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_name][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_name_addresss][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_city][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_state][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_zip][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan3_property_owned_by).each(function () {
            $(this).attr("name", "property_resident[home_car_loan3][property_owned_by][" + index_val + "]");
            $(this).attr("data-index", index_val);

            if ($(this).val() == "1") {
                $(this).attr("id", "owned_by_you_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_you_loan3_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "owned_by_spouse_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_spouse_loan3_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "owned_by_joint_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_joint_loan3_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "owned_by_other_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_other_loan3_" + index_val);
            }
        });

        $(loan3_cosigner_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_name][" +
                index_val +
                "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_name_addresss][" +
                index_val +
                "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_city][" +
                index_val +
                "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_state][" +
                index_val +
                "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_zip][" +
                index_val +
                "]"
            );
        });

        $(vehicle_payment_tax_insurance).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][payment_tax_insurance][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr(
                    "id",
                    "vehicle_payment_tax_insurance_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "vehicle_payment_tax_insurance_no_" + index_val
                    );
            }
            if ($(this).val() == "2") {
                $(this).attr(
                    "id",
                    "vehicle_payment_tax_insurance_yes" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "vehicle_payment_tax_insurance_yes" + index_val
                    );
            }
        });
        $(vehicle_monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][monthly_payment][" +
                index_val +
                "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_payment_remaining).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][payment_remaining][" +
                index_val +
                "]"
            );
        });
        $(vehicle_debt_owned_by).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan][debt_owned_by][" +
                index_val +
                "]"
            );
            $(this).next("label").attr("for", $(this).attr("id")).attr('onclick', 'showLoanDiv(' + index_val + ')');
            $(this).attr("data-index", index_val);
        });
        $(vehicle_codebtor).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(vehicle_codebtor_info).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_info][" +
                index_val +
                "]"
            );
        });
        $(loan_own_type_property).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[loan_own_type_property][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(additional_loan1).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][additional_loan1][" +
                index_val +
                "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(additional_loan2).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][additional_loan2][" +
                index_val +
                "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });

        var security_deposit_yes_no = cln.find(".security_deposit_div .security_deposit_yes_no");
        $(security_deposit_yes_no).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr("name", "security_deposits[" + index_val + "][type_value]");
            $(this).next("label").attr("for", $(this).attr("id"));

            if ($(this).val() == 1) {
                $(this).next("label").attr("onclick", "getSecurityDepositsItems('yes', '" + index_val + "');");
            }
            if ($(this).val() == 0) {
                $(this).attr("onclick", "getSecurityDepositsItems('no', '" + index_val + "'); openFlagPopup('security-deposits-popup', 'No');");
                if (!saveFromAttorney) {
                    $(this).attr("onclick", "getSecurityDepositsItems('no', '" + index_val + "'); openFlagPopup('security-deposits-popup', 'No', true, false);");
                } else {
                    $(this).attr("onclick", "getSecurityDepositsItems('no', '" + index_val + "'); openFlagPopup('security-deposits-popup', 'No', true, true);");
                }
            }
        });

        var oldIndex = (index_val - 1);

        var security_deposit_data_div = cln.find(".security_deposit_data_div");
        $(security_deposit_data_div).addClass("hide-data");
        $(security_deposit_data_div).attr("id", "security_deposits_data_" + index_val);

        var security_deposit_data_div_add_more_btn = security_deposit_data_div.find('.add-more-div-bottom button')
        security_deposit_data_div_add_more_btn.attr("onclick", `common_financial_addmore_with_limit('security_deposits_${index_val}',9,'security-deposits-mutisec-${index_val}', 'security_deposits[${index_val}]'); return false;`)

        var security_deposits_mutisec = cln.find(".security_deposits_" + oldIndex + "_mutisec");
        security_deposits_mutisec.slice(1).remove();
        $(security_deposits_mutisec).removeClass('security_deposits_' + oldIndex + '_mutisec').removeClass(`rent_sec_deposit${oldIndex}`).removeClass(`rent_sec_deposit${oldIndex}_0`);
        $(security_deposits_mutisec).addClass('security_deposits_' + index_val + '_mutisec').addClass(`rent_sec_deposit${index_val}`).addClass(`rent_sec_deposit${index_val}_0`);
        var security_deposits_type_of_account = $(security_deposits_mutisec).find(".security_deposits_type_of_account");
        $(security_deposits_type_of_account).removeClass('security_deposits_' + oldIndex + '_type_of_account');
        $(security_deposits_type_of_account).addClass('security_deposits_' + index_val + '_type_of_account');
        $(security_deposits_type_of_account).attr("name", "security_deposits[" + index_val + "][data][type_of_account][0]");
        $(security_deposits_type_of_account).attr("value", "");

        var security_deposits_description = $(security_deposits_mutisec).find(".security_deposits_description");
        $(security_deposits_description).removeClass('security_deposits_' + oldIndex + '_description');
        $(security_deposits_description).addClass('security_deposits_' + index_val + '_description');
        $(security_deposits_description).attr("name", "security_deposits[" + index_val + "][data][description][0]");
        $(security_deposits_description).attr("value", "");

        var security_deposits_property_value = $(security_deposits_mutisec).find(".security_deposits_property_value");
        $(security_deposits_property_value).removeClass('security_deposits_' + oldIndex + '_property_value');
        $(security_deposits_property_value).addClass('security_deposits_' + index_val + '_property_value');
        $(security_deposits_property_value).attr("name", "security_deposits[" + index_val + "][data][property_value][0]");
        $(security_deposits_property_value).attr("value", "");

        var security_deposit_add_more = cln.find(".security_deposit_data_div .add-more-btn button");
        $(security_deposit_add_more).attr("onclick", "common_financial_addmore_with_limit('security_deposits_" + index_val + "',9,'security-deposits-mutisec-" + index_val + "', 'security_deposits[" + index_val + "]'); return false;");

        var security_deposit_remove = cln.find(".security_deposit_data_div .add-more-btn i");
        $(security_deposit_remove).removeClass('remove-security-deposits-mutisec-' + oldIndex);
        $(security_deposit_remove).addClass('remove-security-deposits-mutisec-' + index_val);
        $(security_deposit_remove).attr("onclick", "removeButton('.security_deposits_" + index_val + "_mutisec', '.remove-security-deposits-mutisec-" + index_val + "');");

        $(property_mortgage_section).addClass('hide-data');

        $(itm).after(cln);
        $(".save-button-section button").prop("disabled", true);
        initializeDatepicker();
        checkAllFieldsFilled(); /// added to show validation error on property tab
    }
}

// ==================== FORM VALIDATION ====================

/**
 * Validate form by ID
 * @param {string} formId - Form ID to validate
 */
function validateFormIds(formId) {
    const $form = $('#' + formId);
    if ($form.length) {
        if (!$form.data('validator')) {
            $form.validate({
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
    }
}

// ==================== CURRENTLY LIVED PROPERTY ====================

/**
 * Toggle property ownership/rental UI
 * @param {string} value - 'yes' for own, 'no' for rent
 * @param {object} element - The clicked element
 * @param {number} ownRent - 1 for own, 0 for rent
 * @param {number} loanId - Loan ID
 * @param {string} route - Route URL for AJAX
 */
function currently_lived_property(value, element, ownRent, loanId, route) {
    var index = $(element).data('index');

    if (value == 'yes') {
        // Own
        $('.currently_lived_data').removeClass('hide-data');
        $('.resident_rent_data').addClass('hide-data');
        $("#add-more-residence-form").show();

        // Show own-specific sections
        $('.own-save-div').removeClass('hide-data');
    } else if (value == 'no') {
        // Rent
        $('.currently_lived_data').addClass('hide-data');
        $('.resident_rent_data').removeClass('hide-data');
        $("#add-more-residence-form").hide();

        // Hide own-specific sections
        $('.own-save-div').addClass('hide-data');
    }
}

/**
 * Toggle primary/non-primary address fields
 * @param {string} value - 'yes' if primary, 'no' if non-primary
 * @param {object} element - The clicked element
 */
function not_primary_address_property(value, element) {
    var index = $(element).data('index');

    if (value == 'yes') {
        // Primary residence - hide address fields (use BasicInfoPartA address)
        $('.payment_not_primary_address_data').addClass('hide-data');
        $('.property-detail-div').removeClass('hide-data');
    } else if (value == 'no') {
        // Non-primary residence - show address input fields
        $('.payment_not_primary_address_data').removeClass('hide-data');
        $('.property-detail-div').removeClass('hide-data');
    }
}

/**
 * Toggle security deposit fields
 * @param {string} value - 'yes' or 'no'
 * @param {number} index - Property index
 */
function getSecurityDepositsItems(value, index) {
    if (value == "yes") {
        $("#security_deposits_data_" + index).removeClass("hide-data");
    } else if (value == "no") {
        $("#security_deposits_data_" + index).addClass("hide-data");
    }
}

// ==================== RESIDENT FORM TOGGLE FUNCTIONS ====================

/**
 * Display resident edit form (show edit, hide summary)
 * @param {number} index - Residence index
 * @param {boolean} saveFromAttorney - Whether saving from attorney side
 */
function display_resident_div(index, saveFromAttorney = false) {
    $('.residence_form_' + index).removeClass('hide-data');
    $('.residence_form_summary_' + index).addClass('hide-data');
}

/**
 * Remove resident form
 * @param {number} index - Residence index  
 * @param {boolean} saveFromAttorney - Whether deleting from attorney side
 */
async function remove_resident_div(index, saveFromAttorney = false) {
    const canEdit = await is_editable('can_edit_property');
    if (!canEdit) {
        return false;
    }

    if (confirm('Are you sure you want to delete this residence?')) {
        $('.residence_property_main_div_' + index).remove();

        // Renumber remaining forms
        $('.residence_property_main_div').each(function (i) {
            $(this).find('.circle-number-div').text(i + 1);
        });
    }
}

/**
 * Save resident form
 * @param {boolean} showSummary - Whether to show summary after save
 * @param {object} buttonObj - Button object that triggered save
 * @param {string} extraParam - Extra parameter (unused)
 * @param {boolean} saveFromAttorney - Whether saving from attorney side
 */
async function saveResident(showSummary = true, buttonObj = null, extraParam = '', saveFromAttorney = false) {
    const canEdit = await is_editable('can_edit_property');
    if (!canEdit) {
        return false;
    }

    // Get the index from button's data-saveid
    var index = $(buttonObj).data('saveid');

    // Validate the form before proceeding
    validateFormIds('client_property_step1');
    var isValid = $("#client_property_step1").validate().form();

    if (!isValid) {
        $.systemMessage("Please fill all required fields.", 'alert--danger', true);
        return false;
    }

    if (showSummary) {
        // Hide edit form and show summary
        $('.residence_form_' + index).addClass('hide-data');
        $('.residence_form_summary_' + index).removeClass('hide-data');
    }

    return true;
}

// ==================== ADDITIONAL PROPERTY UTILITY FUNCTIONS ====================

/**
 * Show/hide property ownership data
 * @param {string} value - 'yes' or 'no'
 */
function getOwnTypeProperty(value) {
    if (value == "yes") {
        document
            .getElementById("own_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("own_property_data").classList.add("hide-data");
    }
}

/**
 * Show/hide property size divs based on property type
 * @param {HTMLElement} element - Radio button element
 * @param {string} value - Property type value
 */
function showHidePropertySizeDiv(element, value) {
    var valueInt = parseInt(value);
    var arr1 = [1, 2, 3, 4];
    var arr2 = [5, 6];
    var arr3 = [7, 8];
    
    var parentDiv = $(element).closest('.main-property-section');
    var descriptionDiv = parentDiv.find('.description-div');
    var descriptionAndLotSizeDiv = parentDiv.find('.description-and-lot-size-div');
    var propertyOtherInput = parentDiv.find('.property_other_input');
    
    if (arr1.includes(valueInt)) {
        descriptionDiv.removeClass('d-none');
        descriptionAndLotSizeDiv.addClass('d-none');
        propertyOtherInput.addClass('d-none');
    } else if (arr2.includes(valueInt)) {
        descriptionAndLotSizeDiv.removeClass('d-none');
        descriptionDiv.addClass('d-none');
        propertyOtherInput.addClass('d-none');
    } else if (arr3.includes(valueInt)) {
        descriptionAndLotSizeDiv.addClass('d-none');
        descriptionDiv.addClass('d-none');
        
        // Show property_other_input only when value is 8 (Other)
        if (valueInt === 8) {
            propertyOtherInput.removeClass('d-none');
        } else {
            propertyOtherInput.addClass('d-none');
        }
    }
}

/**
 * Show/hide property loan section
 * @param {string} value - 'yes' or 'no'
 * @param {HTMLElement} obj - Element that triggered the change
 */
function showHidePropertyLoan(value, obj) {
    var parent = $(obj).parents(".laon_property_obj_data");
    var loanPropertySec = parent.next(".loan_own_type_property_sec");
    var sectionAdditionalLoan = loanPropertySec.find(
        ".section_additional_loan"
    );
    var additionalLoan1 = loanPropertySec.find(
        ".additional_loan_obj .additional_loan1"
    );

    if (value === "yes") {
        loanPropertySec.removeClass("hide-data");
    } else if (value === "no") {
        loanPropertySec.addClass("hide-data");
    }

    additionalLoan1.removeAttr("checked");
    sectionAdditionalLoan.addClass("hide-data");

    $(obj).closest('.currently_lived_data').find('.own-save-div').removeClass('hide-data');

}

/**
 * Show/hide loan property object section
 * @param {string} value - 'yes' or 'no'
 * @param {HTMLElement} obj - Element that triggered the change
 */
function laon_property_obj(value, obj) {
    if (value == "yes") {
        $(obj)
            .parents(".laon_property_obj_data")
            .next(".loan_own_type_property_sec")
            .removeClass("hide-data");
        $(obj)
            .parents(".laon_property_obj_data")
            .next("div")
            .next(".loan_own_type_property_sec")
            .removeClass("hide-data");
        $(".additional_loan1").removeAttr("checked");
        $(".additional_loan2").removeAttr("checked");
        $(".section_additional_loan").addClass("hide-data");
        $(".section_additional_loan").addClass("hide-data");
        $("#additional_loan1").attr("checked", true);
        $("#additional_loan2_no").attr("checked", true);
    } else if (value == "no") {
        $(obj)
            .parents(".laon_property_obj_data")
            .next(".loan_own_type_property_sec")
            .addClass("hide-data");
        $(obj)
            .parents(".laon_property_obj_data")
            .next("div")
            .next(".loan_own_type_property_sec")
            .addClass("hide-data");
    }
    $(obj).closest('.vehicle-info-div').find('.vehicle-save-div').removeClass('hide-data')
}

/**
 * Show/hide vehicle page listing based on ownership
 * @param {string} value - 'yes' or 'no'
 * @param {HTMLElement} obj - Element that triggered the change
 * @param {number} isemptyVehicle - Whether vehicle is empty (0 or 1)
 * @param {number} ocrId - OCR ID (unused parameter for compatibility)
 * @param {string} ajaxurl - AJAX URL (unused parameter for compatibility)
 */
function getOwnTypeProperty_obj(
    value,
    obj,
    isemptyVehicle = 0,
    ocrId = 0,
    ajaxurl = ""
) {
    if (value == 'yes') {
        $(".vehicle-btn-section").removeClass('hide-data');
        if(isemptyVehicle==0){
            $('vehicle_summary_0').addClass('hide-data');
            $('.vehicle_form_0').removeClass('hide-data');
        }
        document.getElementById('vehicle_page_listing_div').classList.remove("hide-data");
    } else if (value == 'no') {
        $("#vehicle_page_listing_div")
        .find("input")
        .val("")
        .end()
        .find("textarea")
        .val("")
        .end()
        .find("select")
        .val("")
        .end();
        $(".vehicle-btn-section").addClass('hide-data');
        if(isemptyVehicle==0){
            $('.vehicle_form_0').addClass('hide-data');
            
            $('vehicle_summary_0').removeClass('hide-data');
        }
        document.getElementById('vehicle_page_listing_div').classList.add("hide-data");
    }
}

/**
 * Validate resident count and navigate if valid
 * @param {string} url - URL to navigate to
 * @param {boolean} saveFromAttorney - Whether saving from attorney side
 */
function checkResidentSelection(url, saveFromAttorney=false) {
    var form_id = "property_step1_modal_save";
    if(!saveFromAttorney){
        form_id = "client_property_step1";
    }

    hasError = revalidateFormWithMonthYear(form_id,true,saveFromAttorney,true);
    if(!hasError && !saveFromAttorney){
        window.location.href = url;
    } 
}

// Export functions for backward compatibility
window.initializePropertyStep1 = initializePropertyStep1;
window.validateFormIds = validateFormIds;
window.currently_lived_property = currently_lived_property;
window.not_primary_address_property = not_primary_address_property;
window.getSecurityDepositsItems = getSecurityDepositsItems;
window.getPropertyResidenceDetailsByGraphQL = getPropertyResidenceDetailsByGraphQL;
window.savePropertyAndGenerateScreenshot = savePropertyAndGenerateScreenshot;
window.generatePropertyScreenshot = generatePropertyScreenshot;
window.showLoanDiv = showLoanDiv;
window.downloadJson = downloadJson;
window.showLoan2Div = showLoan2Div;
window.showLoan3Div = showLoan3Div;
window.get_eviction_pending = get_eviction_pending;
window.checkPendingEviction = checkPendingEviction;
window.addResidenceForm = addResidenceForm;
window.display_resident_div = display_resident_div;
window.remove_resident_div = remove_resident_div;
window.saveResident = saveResident;
window.getOwnTypeProperty = getOwnTypeProperty;
window.showHidePropertySizeDiv = showHidePropertySizeDiv;
window.showHidePropertyLoan = showHidePropertyLoan;
window.laon_property_obj = laon_property_obj;
window.getOwnTypeProperty_obj = getOwnTypeProperty_obj;
window.checkResidentSelection = checkResidentSelection;

