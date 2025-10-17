/**
 * Tab 2 - Step 3: Personal & Household Property
 * Utility popup for selecting household items with quantities and values
 */

// ==================== INITIALIZATION ====================

$(function() {
    // Initialize utility popup if on step 3
    if (typeof initializeCommonUtilityPopup === 'function') {
        initializeCommonUtilityPopup();
    }
});

/**
 * Initialize property step 3 functionality
 * This step uses the common utility popup for household items selection
 */
function initializePropertyStep3() {
    // Call the common utility popup initialization
    if (typeof initializeCommonUtilityPopup === 'function') {
        initializeCommonUtilityPopup();
    }
}

// ==================== HOUSEHOLD ITEMS TOGGLE FUNCTIONS ====================

function getHouseHoldItems(value) {
    if (value == "yes") {
        document
            .getElementById("household_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("household_items_data")
            .classList.add("hide-data");
    }
}

function getHouseElectronicsItems(value) {
    if (value == "yes") {
        document
            .getElementById("electronics_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("electronics_items_data")
            .classList.add("hide-data");
    }
}

function getHouseCollectiblesItems(value) {
    if (value == "yes") {
        document
            .getElementById("Collectibles_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("Collectibles_items_data")
            .classList.add("hide-data");
    }
}

function getHouseSportsItems(value) {
    if (value == "yes") {
        document
            .getElementById("sports_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("sports_items_data").classList.add("hide-data");
    }
}

function getHouseFirearmsItems(value) {
    if (value == "yes") {
        document
            .getElementById("firearms_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("firearms_items_data")
            .classList.add("hide-data");
    }
}

function getHouseClothingItems(value) {
    if (value == "yes") {
        document
            .getElementById("clothing_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("clothing_items_data")
            .classList.add("hide-data");
    }
}

function getHouseJewelryItems(value) {
    if (value == "yes") {
        document
            .getElementById("jewelry_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("jewelry_items_data")
            .classList.add("hide-data");
    }
}

function getHouseNonFarmAnimalsItems(value) {
    if (value == "yes") {
        document
            .getElementById("non_farm_animals_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("non_farm_animals_items_data")
            .classList.add("hide-data");
    }
}

function getHouseHEathAidItems(value) {
    if (value == "yes") {
        document
            .getElementById("health_aids_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("health_aids_items_data")
            .classList.add("hide-data");
    }
}

// Detailed Tab Items Functions
function openDetailedTabItemsForm(url, type = '', attorneyEdit=false) {
    var previous_data = $('.detailed_tab_items_'+type).val();
    
    laws.ajax(url, { type: type, previous_data: previous_data }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            if(attorneyEdit){
                $("#secondaryModalBs .modal-content").html(res.html);
                $("#secondaryModalBs").modal("show"); 
            } else {
                laws.updateFaceboxContent(res.html);
                $('.check_empty_'+type).removeClass('hide-data');
                initializeSelectedItems(previous_data);
            }
        }
    });
};

// Export functions for backward compatibility
window.initializePropertyStep3 = initializePropertyStep3;
window.getHouseHoldItems = getHouseHoldItems;
window.getHouseElectronicsItems = getHouseElectronicsItems;
window.getHouseCollectiblesItems = getHouseCollectiblesItems;
window.getHouseSportsItems = getHouseSportsItems;
window.getHouseFirearmsItems = getHouseFirearmsItems;
window.getHouseClothingItems = getHouseClothingItems;
window.getHouseJewelryItems = getHouseJewelryItems;
window.getHouseNonFarmAnimalsItems = getHouseNonFarmAnimalsItems;
window.getHouseHEathAidItems = getHouseHEathAidItems;
window.openDetailedTabItemsForm = openDetailedTabItemsForm;

