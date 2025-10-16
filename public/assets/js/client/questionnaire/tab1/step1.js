/**
 * Tab 1 - Step 1: Debtor Information
 * Form validation and functionality for debtor's basic information
 */

$(function() {
    // Initialize form validation for Step 1
    initializeStep1Validation();
});

/**
 * Initialize form validation for Debtor Info forms
 */
function initializeStep1Validation() {
    const formSelectors = [
        "#client_basic_info_step1",
        "#client_basic_info_step4" // Part A additional forms
    ];

    formSelectors.forEach(function(selector) {
        if ($(selector).length) {
            $(selector).validate({
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
                },
            });
        }
    });
}

// ==================== TOGGLE FUNCTIONS ====================

/**
 * Show/hide "other names used in last 8 years" section
 */
function getHiddenData(value) {
    if (value == "yes") {
        document.getElementById("condition-data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("condition-data").classList.add("hide-data");
    }
};

/**
 * Add another "other name" form (max 3)
 */
function addOther_names() {
    var clnln = $(document).find(".other_name_frm").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    }

    var itm = $(document).find(".other_name_frm").last();
    var index_val = clnln; // Use clnln directly for the next index
    var cln = $(itm).clone();

    // Update class and delete button for new index
    cln.removeClass(function (index, className) {
        return (className.match(/other_name_frm_\d+/g) || []).join(' ');
    }).addClass("other_name_frm_" + index_val);

    cln.find(".delete-div").attr("onclick", "remove_div_common('other_name_frm', " + index_val + ")");

    // Update input fields with the correct name attributes
    cln.find(".circle-number-div").html(index_val + 1);

    cln.find(".any_other_fname").attr("name", "part1[any_other_name][name][" + index_val + "]").val("");
    cln.find(".any_other_mname").attr("name", "part1[any_other_name][middle_name][" + index_val + "]").val("");
    cln.find(".any_other_lname").attr("name", "part1[any_other_name][last_name][" + index_val + "]").val("");
    cln.find(".any_other_suffix").attr("name", "part1[any_other_name][suffix][" + index_val + "]").val("");

    // Clear text, number inputs, and selects
    cln.find('input[type="text"], input[type="number"]').val("");
    cln.find("select").val("");

    // Insert after last element
    $(itm).after(cln);
    
    if(typeof reinitTooltips === 'function') {
        reinitTooltips();
    }
};

/**
 * Show/hide "list every address" section
 * Used in Step 1
 */
function getListEveryAddressData(value) {

    if (value == "no") {
        document
            .getElementById("list-every-address-data")
            .classList.remove("hide-data");
    } else if (value == "yes") {
        document
            .getElementById("list-every-address-data")
            .classList.add("hide-data");
    }
};

/**
 * Show/hide "living with domestic partner" section
 * Used in Step 1
 */
function getLivingDomesticPartnerData(value) {
    if (value == "yes") {
        document
            .getElementById("living-domestic-partner-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("living-domestic-partner-data")
            .classList.add("hide-data");
    }
};

/**
 * Add previous address form (max 5)
 * Used in Step 1 - "List every address where you have lived"
 */
function addEveryAddressForm() {
    
    var clnln = $(document).find(".list_every_addresses").length;
    if (clnln > 4) {
        $.systemMessage('You can only insert 5 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".list_every_addresses").last();

        var remove_btn_index = itm
            .find("button.remove_list_every_addresses_clone")
            .data("index");
        if (remove_btn_index > 0) {
            itm.find("button.remove_list_every_addresses_clone").hide();
        }

        var index_val = $(itm).index();
        var cln = $(itm).clone().find("input").val("").end();
        var creditor_name = cln.find(".creditor_name");
        var creditor_street = cln.find(".creditor_street");
        var creditor_city = cln.find(".creditor_city");
        var creditor_state = cln.find(".creditor_state");
        var creditor_zip = cln.find(".creditor_zip");
        var prev_address_from = cln.find(".prev_address_from");
        var prev_address_to = cln.find(".prev_address_to");
        var live_debtor = cln.find(".live_debtor");

        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/list_every_addresses_\d+/g) || []).join(' ');
        }).addClass("list_every_addresses_" + index_val);

        cln.find(".delete-div").attr("onclick", "remove_div_common('list_every_addresses', " + index_val + ")");

        
        cln.find(".circle-number-div").html(index_val+1);


        $(creditor_name).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_name][" + index_val + "]"
            );
        });

        $(creditor_city).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_city][" + index_val + "]"
            );
        });

        $(creditor_state).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_state][" + index_val + "]"
            );
        });

        $(creditor_zip).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_zip][" + index_val + "]"
            );
        });

        $(creditor_street).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_street][" + index_val + "]"
            );
        });
        $(prev_address_from).each(function () {
            $(this).attr("name", "prev_address[from][" + index_val + "]");
            $(this).removeClass("hasDatepicker").attr("id", "");
            $(this).attr("data-startinputname", "prev_address[from][" + index_val + "]");
            $(this).attr("data-endinputname", "prev_address[to][" + index_val + "]");
        });
        $(prev_address_to).each(function () {
            $(this).attr("name", "prev_address[to][" + index_val + "]");
            $(this).removeClass("hasDatepicker").attr("id", "");
            $(this).attr("data-startinputname", "prev_address[from][" + index_val + "]");
            $(this).attr("data-endinputname", "prev_address[to][" + index_val + "]");
        });
        $(live_debtor).each(function () {
            $(this).attr("name", "prev_address[debtor][" + index_val + "]");
        });

        var new_index_val = index_val + 1;
        cln.find("button.remove_list_every_addresses_clone").attr(
            "data-index",
            new_index_val
        );
        cln.find("button.remove_list_every_addresses_clone").show();

        $(itm).after(cln);
        
        if(typeof initializeDatepicker === 'function') {
            initializeDatepicker();
        }
        if(typeof reinitTooltips === 'function') {
            reinitTooltips();
        }
    }
};

/**
 * Add Name/Address for Spouse/Domestic Partner (max 10)
 * Used in Step 1 - Living with domestic partner section
 */
async function addNameAddressSpouseForm() {
    const canEdit = await is_editable('can_edit_sofa');
    if (!canEdit) {
        return false;
    }
    var clnln = $(document).find(".living_domestic_partners").length;

    const status = await seperate_save('living_domestic_partner','living_domestic_partners', 'living-domestic-partner-data', 'parent_living_domestic_partner', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 9) {
            alert("You can add only 10 entries.");
            return false;
        } else {
            var itm = $(document).find(".living_domestic_partners").last();
            var index_val = $(itm).index();
            index_val = index_val + 1
            var prev_index = index_val - 1;

            var remove_btn_index = itm
                .find("button.remove_living_domestic_partners_clone")
                .data("index");
            if (remove_btn_index > 0) {
                itm.find("button.remove_living_domestic_partners_clone").hide();
            }

            var cln = $(itm).clone();

            let divclass = "living_domestic_partners";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('living_domestic_partner','living_domestic_partners', 'living-domestic-partner-data', 'parent_living_domestic_partner', " + index_val + ")");

            cln.find("label").removeClass("active");
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            var community_property_state = cln.find(".community_property_state");
            var domestic_partner = cln.find(".domestic_partner");
            var domestic_partner_street_address = cln.find(
                ".domestic_partner_street_address"
            );
            var domestic_partner_city = cln.find(".domestic_partner_city");
            var domestic_partner_state = cln.find(".domestic_partner_state");
            var domestic_partner_zip = cln.find(".domestic_partner_zip");
            var domestic_partner_living = cln.find(".domestic_partner_living");
            var spouse_live_section_div = cln.find(
                ".spouse-live-section-" + prev_index
            );

            $(domestic_partner_street_address).each(function () {
                $(this).attr( "name", "domestic_partner_street_address[" + index_val + "]" );
            });
            $(domestic_partner_city).each(function () {
                $(this).attr("name", "domestic_partner_city[" + index_val + "]");
            });
            $(domestic_partner_state).each(function () {
                $(this).attr("name", "domestic_partner_state[" + index_val + "]");
            });
            $(domestic_partner_zip).each(function () {
                $(this).attr("name", "domestic_partner_zip[" + index_val + "]");
            });
            $(domestic_partner_living).each(function () {
                $(this).attr("name", "domestic_partner_living[" + index_val + "]");
                if ($(this).val() == "1") {
                    $(this).next('label').attr( "onclick", 'didSpouseLiveWithYou( 1 ,"' + index_val + '");' );
                    $(this).attr( "id", "domestic_partner_living_yes_" + index_val );
                    $(this).next("label") .attr( "for", "domestic_partner_living_yes_" + index_val );
                }
                if ($(this).val() == "0") {
                    $(this).next('label').attr( "onclick", 'didSpouseLiveWithYou( 0 ,"' + index_val + '");' );
                    $(this).attr( "id", "domestic_partner_living_no_" + index_val );
                    $(this).next("label").attr( "for", "domestic_partner_living_no_" + index_val );
                }
                $(this).prop("checked", false);
            });
            $(community_property_state).each(function () {
                $(this).attr("name", "community_property_state[" + index_val + "]");
            });
            $(domestic_partner).each(function () {
                $(this).attr("name", "domestic_partner[" + index_val + "]");
            });
            $(spouse_live_section_div).each(function () {
                $(this).removeClass("spouse-live-section-" + prev_index);
                $(this).addClass("spouse-live-section-" + index_val).addClass('hide-data');
            });

            cln.find("input[type=radio]").prop("checked", false);
            cln.find("input[type=text]").val("");
            cln.find("select").val("");
            $(itm).after(cln);
        }
    }, 500);
};

// Export functions to global scope for backward compatibility
window.initializeStep1Validation = initializeStep1Validation;
window.getHiddenData = getHiddenData;
window.addOther_names = addOther_names;
window.getListEveryAddressData = getListEveryAddressData;
window.getLivingDomesticPartnerData = getLivingDomesticPartnerData;
window.addEveryAddressForm = addEveryAddressForm;
window.addNameAddressSpouseForm = addNameAddressSpouseForm;

