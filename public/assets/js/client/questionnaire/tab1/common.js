/**
 * Tab 1 - Common Utility Functions
 * Shared functions for Basic Info (Debtor, Co-Debtor, BK Cases)
 */

// ==================== UTILITY FUNCTIONS ====================

/**
 * Number key validation - allows only numbers, decimal, and negative
 */
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode != 45 && charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
};

/**
 * Open information popup
 */
function openPopup(divclass) {
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
function statecounty(divId, targetdiv) {

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
function chooseType(thisrequest) {  
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
function chooseTypeSpouse(thisrequest) {
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
 * Show/hide non-publicly traded items section
 */
function getNonPubliclyItems(value) {
    if (value === 'yes') {
        $('#non_publicly_items_data').removeClass('hide-data').addClass('show-data');
    } else {
        $('#non_publicly_items_data').removeClass('show-data').addClass('hide-data');
    }
};

// ==================== EVENT HANDLERS ====================

/**
 * Phone Number Formatting ((XXX) XXX-XXXX)
 * Auto-formats phone number as user types
 * Used in Step 1 and Step 2
 */
$(document).on("input", ".phone-field", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ""));
    self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
    var first10 = $(this).val().substring(0, 14);
    if (this.value.length > 14) {
        this.value = first10;
    }
});

/**
 * SSN Input Formatting (XXX-XX-XXXX)
 * Auto-formats SSN as user types
 * Used in Step 1 (Debtor SSN) and Step 2 (Co-Debtor SSN)
 */
$(document).on("input", ".is_ssn", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ""));
    self.val(self.val().replace(/(\d{3})\-?(\d{2})\-?(\d{4})/, "$1-$2-$3"));
    var first10 = $(this).val().substring(0, 11);
    if (this.value.length > 11) {
        this.value = first10;
    }
});

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

// Export all functions to window for backward compatibility
window.isNumberKey = isNumberKey;
window.openPopup = openPopup;
window.statecounty = statecounty;
window.chooseType = chooseType;
window.chooseTypeSpouse = chooseTypeSpouse;
window.getNonPubliclyItems = getNonPubliclyItems;

