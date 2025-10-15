$(function() { 
    // Check if stepData exists and has required properties
    if (!window.__stepData || !window.__stepData.divId) {
        console.warn('common_radio_check: window.__stepData or divId not found');
        return;
    }
    
    var pstatus = window.__stepData.pstatus || 0;
    var divId = window.__stepData.divId;
    
    if (pstatus == 0) {
        var $container = $("#" + divId);
        if ($container.length === 0) {
            console.warn('common_radio_check: Container with ID "' + divId + '" not found');
            return;
        }
        
        $container.find("input:radio").each(function() {
            var $radio = $(this);
            var value = $radio.val();
            
            // Only auto-select radios with values 0 or 1, excluding property_owned_by class
            if ((value == 0 || value == 1) && !$radio.hasClass('property_owned_by')) {
                $radio.trigger('click');
            }
        });
    }
});