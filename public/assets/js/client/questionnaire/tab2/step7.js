/**
 * Tab 2 - Step 7: Miscellaneous Property
 * Other miscellaneous property items
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 7 - Auto-click radio buttons if no data
 */
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

// ==================== MISCELLANEOUS TOGGLE FUNCTIONS ====================

function getPreviouslylistedItems(value) {
    if (value == "yes") {
        document
            .getElementById("previously_listed_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("previously_listed_data")
            .classList.add("hide-data");
    }
}

// Export functions for backward compatibility
window.initializePropertyStep7 = initializePropertyStep7;
window.getPreviouslylistedItems = getPreviouslylistedItems;

