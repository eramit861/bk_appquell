/**
 * JavaScript Loading Test Script
 * Add this temporarily to test if all separated JS files are loading correctly
 */

(function() {
    console.log('%c=== JavaScript Loading Test ===', 'color: #4CAF50; font-weight: bold; font-size: 16px;');
    
    // Test if common utilities loaded
    const commonUtilitiesLoaded = typeof window.initializeDatepicker === 'function';
    console.log(
        `%c✓ Common Utilities: ${commonUtilitiesLoaded ? 'LOADED' : 'MISSING'}`,
        `color: ${commonUtilitiesLoaded ? '#4CAF50' : '#f44336'}`
    );
    
    // Check current page
    const currentUrl = window.location.pathname;
    console.log(`%cCurrent Page: ${currentUrl}`, 'color: #2196F3');
    
    // Tab 1 Functions
    if (currentUrl.includes('basic-info')) {
        console.log('%c--- Tab 1 (Basic Info) ---', 'color: #FF9800; font-weight: bold;');
        console.log('isNumberKey:', typeof window.isNumberKey === 'function' ? '✓' : '✗');
        console.log('statecounty:', typeof window.statecounty === 'function' ? '✓' : '✗');
        console.log('chooseType:', typeof window.chooseType === 'function' ? '✓' : '✗');
    }
    
    // Tab 2 Functions
    if (currentUrl.includes('property')) {
        console.log('%c--- Tab 2 (Property) ---', 'color: #FF9800; font-weight: bold;');
        console.log('initializeFormValidation:', typeof window.initializeFormValidation === 'function' ? '✓' : '✗');
        console.log('setupAutocomplete:', typeof window.setupAutocomplete === 'function' ? '✓' : '✗');
        
        if (currentUrl.includes('property-step2')) {
            console.log('vinOnInput:', typeof window.vinOnInput === 'function' ? '✓' : '✗');
        }
    }
    
    // Tab 3 Functions
    if (currentUrl.includes('debt')) {
        console.log('%c--- Tab 3 (Debts) ---', 'color: #FF9800; font-weight: bold;');
        console.log('initializeAutocomplete:', typeof window.initializeAutocomplete === 'function' ? '✓' : '✗');
        console.log('initializeCreditReport:', typeof window.initializeCreditReport === 'function' ? '✓' : '✗');
    }
    
    // Tab 4 Functions
    if (currentUrl.includes('income')) {
        console.log('%c--- Tab 4 (Income) ---', 'color: #FF9800; font-weight: bold;');
        console.log('updateEmpPeriod:', typeof window.updateEmpPeriod === 'function' ? '✓' : '✗');
        console.log('validateEmploymentDate:', typeof window.validateEmploymentDate === 'function' ? '✓' : '✗');
        console.log('showOvertime:', typeof window.showOvertime === 'function' ? '✓' : '✗');
    }
    
    // Tab 5 Functions
    if (currentUrl.includes('expense')) {
        console.log('%c--- Tab 5 (Expenses) ---', 'color: #FF9800; font-weight: bold;');
        console.log('updateAveragePrice:', typeof window.updateAveragePrice === 'function' ? '✓' : '✗');
        console.log('sumexpesnes:', typeof window.sumexpesnes === 'function' ? '✓' : '✗');
        console.log('formatNumberToPrice:', typeof window.formatNumberToPrice === 'function' ? '✓' : '✗');
    }
    
    // Tab 6 Functions
    if (currentUrl.includes('financial-affairs')) {
        console.log('%c--- Tab 6 (Financial Affairs) ---', 'color: #FF9800; font-weight: bold;');
        console.log('setupCourthouseAutocomplete:', typeof window.setupCourthouseAutocomplete === 'function' ? '✓' : '✗');
        console.log('setupCreditorAutocomplete:', typeof window.setupCreditorAutocomplete === 'function' ? '✓' : '✗');
        
        if (currentUrl.includes('financial-affairs2')) {
            console.log('addMoreIncomeRow:', typeof window.addMoreIncomeRow === 'function' ? '✓' : '✗');
            console.log('deleteIncomeRow:', typeof window.deleteIncomeRow === 'function' ? '✓' : '✗');
        }
    }
    
    console.log('%c=== Test Complete ===', 'color: #4CAF50; font-weight: bold; font-size: 16px;');
})();

