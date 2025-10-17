/**
 * Tab 2 - Step 6: Farm/Commercial Property
 * Farm and commercial real estate
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 6 - Auto-click radio buttons if no data
 */
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


function getAdditionalLoan(value, obj) {

    var parentDiv = $(obj).closest(".loan_own_type_property_sec");
    var targetDiv = parentDiv.find(".section_additional_loan");
    if (value == "yes") {
        targetDiv.removeClass("hide-data");
        
    } else if (value == "no") {
        targetDiv.addClass("hide-data");
    }
}


function getSecondAdditionalLoan(value, obj) {

    var parentDiv = $(obj).closest(".loan_own_type_property_sec");
    var targetDiv = parentDiv.find(".section_additional_loan_second");
    if (value == "yes") {
        targetDiv.removeClass("hide-data");
        
    } else if (value == "no") {
        targetDiv.addClass("hide-data");
    }
}

function getboname(value, obj) {
    if (value == "yes") {
        $(obj)
            .parents(".have_access_of_box")
            .next(".have-access-box")
            .removeClass("hide-data");
        // document.getElementById('own_property_data').classList.remove("hide-data");
    } else if (value == "no") {
        $(obj)
            .parents(".have_access_of_box")
            .next(".have-access-box")
            .addClass("hide-data");
        // document.getElementById('own_property_data').classList.add("hide-data");
    }
}

function getotherboname(value, obj) {
    if (value == "yes") {
        $(obj)
            .parents(".other_have_access_of_box")
            .next(".other-have-access-box")
            .removeClass("hide-data");
        // document.getElementById('own_property_data').classList.remove("hide-data");
    } else if (value == "no") {
        $(obj)
            .parents(".other_have_access_of_box")
            .next(".other-have-access-box")
            .addClass("hide-data");
        // document.getElementById('own_property_data').classList.add("hide-data");
    }
}

// Export functions for backward compatibility
window.initializePropertyStep6 = initializePropertyStep6;

window.getAdditionalLoan = getAdditionalLoan;
window.getSecondAdditionalLoan = getSecondAdditionalLoan;
window.getboname = getboname;
window.getotherboname = getotherboname;



