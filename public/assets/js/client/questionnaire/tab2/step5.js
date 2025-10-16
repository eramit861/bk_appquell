/**
 * Tab 2 - Step 5: Business Assets
 * Business-related property and assets
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 5 - Auto-click radio buttons if no data
 */
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

/**
 * Initialize Property Step 5 Continue
 */
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

// ==================== ALIMONY/PROPERTY FUNCTIONS ====================

/**
 * Property unknown checkbox handler
 */
window.propertyUnkown = function(thisobj) {
    if (thisobj.checked == true) {
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').val('');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').removeClass('required');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').prop('disabled', true);
    } else {
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').val('');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').addClass('required');
        $(thisobj).parent("div").next('.input-group').find('.alimony_property_value').prop('disabled', false);
    }
};

/**
 * Check for unique account numbers
 */
window.checkUnique = function(thisobj) {
    var samecount = 0;
    $(".alimony_property_account").each(function () {
        if (thisobj.value != '' && $(this).val() != '' && $(this).val() == thisobj.value) {
            samecount = samecount + 1;
        }
        if (samecount > 1) {
            thisobj.value = '';
        }
    });
};

/**
 * Store previous value for validation
 */
window.storePreviousValue = function(thisObj) {
    $(thisObj).attr('data-previousvalue', $(thisObj).val());
};

/**
 * Store previous alimony value
 */
window.storePreviousAlimonyValue = function(thisObj) {
    $(thisObj).attr('data-previousvalue', $(thisObj).val());
};

// Export functions for backward compatibility
window.initializePropertyStep5 = initializePropertyStep5;
window.initializePropertyStep5Continue = initializePropertyStep5Continue;

