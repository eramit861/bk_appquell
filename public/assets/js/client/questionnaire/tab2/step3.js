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

// Export functions for backward compatibility
window.initializePropertyStep3 = initializePropertyStep3;

