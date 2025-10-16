/**
 * Tab 1 - Common Utility Functions
 * Shared functions for Basic Info (Debtor, Co-Debtor, BK Cases)
 */

// ==================== UTILITY FUNCTIONS ====================

/**
 * Number key validation - allows only numbers, decimal, and negative
 */
window.isNumberKey = function(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode != 45 && charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
};

/**
 * Open information popup
 */
window.openPopup = function(divclass) {
    var htmldiv = $("." + divclass).html();
    var html = '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12"><div class="form_colm row px-md-5 py-4"><div class="col-md-12 mb-3"><div class="title-h mt-1 d-flex"><h4><strong>Information: </strong></h4></div></div><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' + htmldiv + '</div></div></div></div></div></div></div></div></div>';
    laws.updateFaceboxContent(html, 'productQuickView quickinfor');
};

// ==================== STATE/COUNTY FUNCTIONS ====================

/**
 * Populate county dropdown based on selected state
 * @param {string} divId - State select element ID
 * @param {string} targetdiv - County select element ID
 */
window.statecounty = function(divId, targetdiv) {
    var statename = $("#" + divId + " option:selected").text();
    var ajaxurl = (window.__tab1Routes && window.__tab1Routes.countyByStateName) ? window.__tab1Routes.countyByStateName : '';
    
    laws.ajax(ajaxurl, { state_name: statename }, function(response) {
        try {
            var res = JSON.parse(response);
            // Clear the target dropdown
            document.getElementById(targetdiv).innerHTML = "";
            $("#" + targetdiv).append($("<option></option>").attr("value", '').text("Choose County"));
            
            $.each(res.countyList, function(key, value) {
                $("#" + targetdiv).append($("<option></option>").attr("value", value.id).text(value.county_name));
            });
            
            // Set the pre-selected county value after counties are loaded
            setTimeout(function() {
                var debtorcounty = (window.__tab1 && window.__tab1.debtorCounty) ? window.__tab1.debtorCounty : '';
                var debtor2county = (window.__tab1 && window.__tab1.debtor2County) ? window.__tab1.debtor2County : '';
                
                if (targetdiv === 'state_based_county' && debtorcounty) {
                    $("#state_based_county").val(debtorcounty);
                }
                if (targetdiv === 'state_based_county2' && debtor2county) {
                    $("#state_based_county2").val(debtor2county);
                }
            }, 100);
        } catch (error) {
            // Fallback: show error message
        }
    });
};

// ==================== SSN/ITIN TOGGLE FUNCTIONS ====================

/**
 * Toggle between SSN and ITIN for Debtor
 */
window.chooseType = function(thisrequest) {
    if (thisrequest.value == "0") {
        $(".ssn_no").removeClass("hide-data");
        $(".itin_no").addClass("hide-data");
    }
    if (thisrequest.value == "1") {
        $(".ssn_no").addClass("hide-data");
        $(".itin_no").removeClass("hide-data");
    }
};

/**
 * Toggle between SSN and ITIN for Spouse/Co-Debtor
 */
window.chooseTypeSpouse = function(thisrequest) {
    if (thisrequest.value == "0") {
        $(".ssn_no_spouse").removeClass("hide-data");
        $(".itin_no_spouse").addClass("hide-data");
    }
    if (thisrequest.value == "1") {
        $(".ssn_no_spouse").addClass("hide-data");
        $(".itin_no_spouse").removeClass("hide-data");
    }
};

// ==================== TOGGLE FUNCTIONS ====================

/**
 * Common toggle function for showing/hiding elements
 * @param {string} value - 'yes' or 'no'
 * @param {string} elementId - Element ID to toggle
 */
window.common_toggle_fn = function(value, elementId) {
    if (value === 'yes') {
        $('#' + elementId).removeClass('hide-data').addClass('show-data');
    } else {
        $('#' + elementId).removeClass('show-data').addClass('hide-data');
    }
};

/**
 * Show/hide non-publicly traded items section
 */
window.getNonPubliclyItems = function(value) {
    if (value === 'yes') {
        $('#non_publicly_items_data').removeClass('hide-data').addClass('show-data');
    } else {
        $('#non_publicly_items_data').removeClass('show-data').addClass('hide-data');
    }
};

// ==================== INITIALIZATION ====================

$(function() {
    // Initialize state/county dropdowns on page load
    statecounty('debtor_state', 'state_based_county');
    statecounty('debtor2_state', 'state_based_county2');
    
    // Event handlers for state changes
    $(document).on("change", "#debtor_state", function() {
        statecounty('debtor_state', 'state_based_county');
    });
    
    $(document).on("change", "#debtor2_state", function() {
        statecounty('debtor2_state', 'state_based_county2');
    });
    
    // Initialize county selection on page load if state is already selected
    $(document).ready(function() {
        if ($("#debtor_state").val()) {
            statecounty('debtor_state', 'state_based_county');
        }
        if ($("#debtor2_state").val()) {
            statecounty('debtor2_state', 'state_based_county2');
        }
    });
});

