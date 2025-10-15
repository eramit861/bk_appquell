(function (window, $) {
    'use strict';

    function editParalegal(ajaxurl, extraClass) {
        if (window.laws && typeof window.laws.ajax === 'function') {
            window.laws.ajax(ajaxurl, {}, function(response) {
                if (isJson(response)) {
                    var res = JSON.parse(response);
                    if (res.status == 0) {
                        $.systemMessage && $.systemMessage(res.msg, 'alert--danger', true);
                    } else if (res.status == 1) {
                        $.systemMessage && $.systemMessage(res.msg, 'alert--success', true);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                } else {
                    if (window.laws && typeof window.laws.updateFaceboxContent === 'function') {
                        window.laws.updateFaceboxContent(response, extraClass + ' questions_popup_div');
                    }
                }
            });
        }
    }

    function copy(event) {
        const fullUrl = event.getAttribute('data-full-url');
        if (!fullUrl) return;

        // Create a temporary input element
        const tempInput = document.createElement('input');
        tempInput.value = fullUrl;
        document.body.appendChild(tempInput);
        tempInput.select();
        
        try {
            document.execCommand('copy');
            $.systemMessage && $.systemMessage('URL copied to clipboard', 'alert--success', true);
        } catch (err) {
            // Fallback for modern browsers
            if (navigator.clipboard) {
                navigator.clipboard.writeText(fullUrl).then(function() {
                    $.systemMessage && $.systemMessage('URL copied to clipboard', 'alert--success', true);
                });
            }
        }
        
        document.body.removeChild(tempInput);
    }

    function initModalHandlers() {
        // Handle edit modal display based on session data
        if (window.ParalegalConfig && window.ParalegalConfig.showEditModal) {
            $(document).ready(function() {
                $("#add_attorney").modal('show');
                
                if (window.ParalegalConfig.editId > 0) {
                    const modalTitle = document.getElementById('invitemodalLabel');
                    if (modalTitle) {
                        modalTitle.innerHTML = '<i class="bi bi-person-plus-fill me-2"></i> Edit Paralegal';
                    }
                    $("#add_attorney").modal('show');
                    
                    if (window.ParalegalConfig.editRoute) {
                        $("#add_attorny_form").attr('action', window.ParalegalConfig.editRoute);
                    }
                }
            });
        }
    }

    // Initialize when DOM is ready
    $(function() {
        initModalHandlers();
    });

    // Expose functions globally for inline handlers
    window.editParalegal = editParalegal;
    window.copy = copy;

})(window, jQuery);

