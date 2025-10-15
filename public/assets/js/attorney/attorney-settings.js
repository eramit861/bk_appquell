(function (window, $) {
    'use strict';

    var config = window.AttorneySettingsConfig || {};
    var routes = (config && config.routes) || {};
    var associateContext = {
        is_associate: config.is_associate,
        associate_id: config.associate_id
    };

    var urlPattern = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-]*)*\/?$/;

    function initDatepicker() {
        var date = new Date();
        if ($.fn.datepicker) {
            $("#datepicker").datepicker({
                dateFormat: "mm/dd",
                changeMonth: true,
                minDate: new Date(date.getFullYear(), 0, 1),
                maxDate: new Date(date.getFullYear(), 12, 31)
            });
        }
    }

    function initFormValidation() {
        var $form = $("#attorney_setting_frm");
        if (!$form.length || !$form.validate) return;

        $form.validate({
            errorPlacement: function (error, element) {
                if ($(element).parents(".form-group").next('label').hasClass('error')) {
                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                } else {
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function (label, element) {
                label.parent().removeClass('error');
                $(element).parents(".form-group").next('label').remove();
            }
        });
    }

    function toggleShowHideDiv(show, divClass) {
        var mainDiv = document.querySelector("." + divClass);
        if (!mainDiv) return;
        if (show) {
            mainDiv.classList.remove("hide-data");
        } else {
            mainDiv.classList.add("hide-data");
        }
    }

    function showCreditCounselingForm(checkbox) {
        var type = $(checkbox).is(":checked") ? 'add' : 'remove';
        if (type === 'remove') {
            excludeDocs(checkbox, "Pre_Filing_Bankruptcy_Certificate_CCC");
            return;
        }
        if (!confirm("Are you sure you want to " + type + " document?")) {
            $(checkbox).prop("checked", !$(checkbox).is(":checked"));
            return;
        }
        if ($(checkbox).is(":checked")) {
            var response = $("#credit_counseling_form_div").html();
            if (window.laws && typeof window.laws.updateFaceboxContent === 'function') {
                window.laws.updateFaceboxContent(response, 'medium-fb-width productQuickView');
            }
        }
    }

    function submitCreditCounselingForm(event, form) {
        event.preventDefault();

        var $form = $(form);
        var agency_name = $form.find('input[name="counseling_agency"]').val() || '';
        var agency_link = $form.find('input[name="counseling_agency_site"]').val() || '';
        var attorney_code = $form.find('input[name="attorney_code"]').val() || '';

        if (agency_name.trim() === '') {
            $('input[name="counseling_agency"]').addClass('border-red');
            $.systemMessage && $.systemMessage('All fields are required', 'alert--danger', true);
            return;
        }

        if (agency_link.trim() === '') {
            $('input[name="counseling_agency_site"]').addClass('border-red');
            $.systemMessage && $.systemMessage('All fields are required', 'alert--danger', true);
            return;
        }

        if (!urlPattern.test(agency_link.trim())) {
            $('input[name="counseling_agency_site"]').addClass('border-red');
            $.systemMessage && $.systemMessage('Please enter a valid URL', 'alert--danger', true);
            return;
        }

        $('input[name="counseling_agency"]').removeClass('border-red');
        $('input[name="counseling_agency_site"]').removeClass('border-red');

        var url = routes.setup_certificate_ccc;
        if (window.laws && typeof window.laws.ajax === 'function') {
            window.laws.ajax(url, $form.serialize(), function (response) {
                try {
                    var res = JSON.parse(response);
                    if (res.status === 0) {
                        $.systemMessage && $.systemMessage(res.msg, 'alert--danger', true);
                    } else if (res.status === 1) {
                        $.systemMessage && $.systemMessage(res.msg, 'alert--success', true);
                        $('.popup .close').trigger('click');
                    }
                } catch (e) {
                    // ignore JSON parse errors
                }
            });
        }
    }

    function excludeDocs(checkbox, doc_type) {
        var type = $(checkbox).is(":checked") ? 'add' : 'remove';

        if (!confirm("Are you sure you want to " + type + " document?")) {
            $(checkbox).prop("checked", !$(checkbox).is(":checked"));
            return;
        }

        var url = routes.attorney_exclude_docs;
        var payload = {
            doc_type: doc_type,
            type: type,
            is_associate: associateContext.is_associate,
            associate_id: associateContext.associate_id
        };

        if (window.laws && typeof window.laws.ajax === 'function') {
            window.laws.ajax(url, payload, function (response) {
                try {
                    var res = JSON.parse(response);
                    if (res.status === 0) {
                        $.systemMessage && $.systemMessage(res.msg, 'alert--danger', true);
                    } else if (res.status === 1) {
                        $.systemMessage && $.systemMessage(res.msg, 'alert--success', true);
                    }
                } catch (e) {
                    // ignore JSON parse errors
                }
            });
        }
    }

    $(function () {
        initDatepicker();
        initFormValidation();
    });

    // expose globals for inline handlers already present in markup
    window.toggleShowHideDiv = toggleShowHideDiv;
    window.showCreditCounselingForm = showCreditCounselingForm;
    window.submitCreditCounselingForm = submitCreditCounselingForm;
    window.excludeDocs = excludeDocs;

})(window, jQuery);


