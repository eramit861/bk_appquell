/**
 * Tab 1 - Step 2: Co-Debtor/Spouse Information
 * Form validation and functionality for co-debtor's basic information
 */

$(function() {
    // Initialize form validation for Step 2
    initializeStep2Validation();
});

/**
 * Initialize form validation for Co-Debtor Info forms
 */
function initializeStep2Validation() {
    const formSelectors = [
        "#client_basic_info_step2",
        "#client_basic_info_step5" // Part B additional forms
    ];

    formSelectors.forEach(function(selector) {
        if ($(selector).length) {
            $(selector).validate({
                errorPlacement: function(error, element) {
                    if ($(element).parents(".form-group").next('label').hasClass('error')) {
                        $(element).parents(".form-group").next('label').remove();
                        $(element).parents(".form-group").after($(error)[0].outerHTML);
                    } else {
                        $(element).parents(".form-group").after($(error)[0].outerHTML);
                    }
                },
                success: function(label, element) {
                    label.parent().removeClass('error');
                    $(element).parents(".form-group").next('label').remove();
                },
            });
        }
    });
}

// ==================== TOGGLE FUNCTIONS ====================

/**
 * Show/hide spouse "other names used in last 8 years" section
 */
function getspouse_HiddenData(value) {
    if (value == "yes") {
        document
            .getElementById("spouse-condition-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("spouse-condition-data")
            .classList.add("hide-data");
    }
};

/**
 * Add another "other name" form for spouse (max 3)
 * Used in Step 2 - Co-Debtor/Spouse other names section
 */
function spouse_addOther_names() {
    var clnln = $(document).find(".spouse_other_name_frm").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        $(".remove-other-names").show();
        var itm = $(document).find(".spouse_other_name_frm").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();
        var spouse_other_name = cln.find(".spouse_other_name");
        var spouse_other_suffix = cln.find(".spouse_other_suffix");
        var spouse_other_middle_name = cln.find(".spouse_other_middle_name");
        var spouse_other_last_name = cln.find(".spouse_other_last_name");
        
        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/spouse_other_name_frm_\d+/g) || []).join(' ');
        }).addClass("spouse_other_name_frm_" + index_val);

        cln.find(".delete-div").attr("onclick", "remove_div_common('spouse_other_name_frm', " + index_val + ")");

        cln.find(".circle-number-div").html(index_val+1);
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        
        $(spouse_other_name).each(function () {
            $(this).attr("name", "part2[spouse_other_name][" + index_val + "]");
        });
        $(spouse_other_suffix).each(function () {
            $(this).attr("name", "part2[spouse_other_suffix][" + index_val + "]");
        });
        $(spouse_other_middle_name).each(function () {
            $(this).attr("name", "part2[spouse_other_middle_name][" + index_val + "]");
        });
        $(spouse_other_last_name).each(function () {
            $(this).attr("name", "part2[spouse_other_last_name][" + index_val + "]");
        });
        
        $('select[name="part2[spouse_other_suffix][' + index_val + ']"]').val("");
        $(itm).after(cln);
    }
}

// Export functions to global scope for backward compatibility
window.initializeStep2Validation = initializeStep2Validation;
window.getspouse_HiddenData = getspouse_HiddenData;
window.spouse_addOther_names = spouse_addOther_names;

