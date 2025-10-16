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

// Export functions for backward compatibility
window.initializePropertyStep6 = initializePropertyStep6;

