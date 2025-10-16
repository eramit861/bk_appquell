/**
 * Tab 1 - Step 3: Bankruptcy Cases and Business Information
 * Form validation and radio button initialization for Parts D & E
 */

$(function() {
    // Initialize form validation for Step 3
    initializeStep3Validation();
    
    // Initialize radio buttons after a short delay
    setTimeout(function() {
        initializeBasicInfoParts();
    }, 500);
});

/**
 * Initialize form validation for BK Cases/Business forms
 */
function initializeStep3Validation() {
    const formSelectors = [
        "#client_basic_info_step3",
        "#client_basic_info_step6" // Part C, D, E forms
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

/**
 * Initialize radio buttons for basic info parts D and E
 * Automatically clicks first radio button if no data exists
 */
function initializeBasicInfoParts() {
    // Part D initialization (Bankruptcy cases)
    var pstatus = window.__tab1Data?.basicInfoPartRest ? 1 : 0;
    if (pstatus == 0) {
        $("#basic-info-part-d input:radio").each(function() {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
    
    // Part E initialization (Business information)
    var pstatusE = window.__tab1Data?.basicInfoPartRestD ? 1 : 0;
    if (pstatusE == 0) {
        $("#basic-info-part-e input:radio").each(function() {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
};

// ==================== EVENT HANDLERS ====================

/**
 * EIN Formatting (XX-XXXXXXX)
 * Auto-formats EIN as user types
 */
$(document).on("input", ".eiin", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ""));
    self.val(self.val().replace(/(\d{2})\-?(\d{7})/, "$1-$2"));
    var first10 = $(this).val().substring(0, 10);
    if (this.value.length > 10) {
        this.value = first10;
    }
});

/**
 * Bankruptcy Date Filed Formatting (MM/DD/YYYY)
 */
$(document).on("input", ".date_filed", function (e) {
    this.type = "text";
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split("/").map(function (v) {
        return v.replace(/\D/g, "");
    });
    if (values[0]) values[0] = window.checkValue(values[0], 12);
    if (values[1]) values[1] = window.checkValue(values[1], 31);
    var output = values.map(function (v, i) {
        return v.length == 2 && i < 2 ? v + "/" : v;
    });
    this.value = output.join("").substr(0, 10);
});

$(document).on("blur", ".date_filed", function (e) {
    this.type = "text";
    var input = this.value;
    var values = input.split("/").map(function (v, i) {
        return v.replace(/\D/g, "");
    });
    var output = "";

    if (values.length == 3) {
        var year =
            values[2].length !== 4
                ? parseInt(values[2]) + 2000
                : parseInt(values[2]);
        var month = parseInt(values[0]) - 1;
        var day = parseInt(values[1]);
        var d = new Date(year, month, day);
        if (!isNaN(d)) {
            var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
            output = dates
                .map(function (v) {
                    v = v.toString();
                    return v.length == 1 ? "0" + v : v;
                })
                .join("/");
        }
    }
    this.value = output;
});

// ==================== BUSINESS TOGGLE FUNCTIONS ====================

/**
 * Show/hide business EIN section
 */
function get_used_business_ein(value) {
    if (value == "yes") {
        document
            .getElementById("get_used_business_ein")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("get_used_business_ein")
            .classList.add("hide-data");
    }
};

// ==================== ADD BANKRUPTCY FORMS ====================

/**
 * Add current bankruptcy case form (max 3)
 */
function addOther_bankruptcy_clone() {
    var clnln = $(document).find(".bankruptcy_clone").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        $(".remove_bankruptcy_clone").show();
        var itm = $(document).find(".bankruptcy_clone").last();
        var index_val = $(itm).index() + 1;

        var remove_btn_index = itm
            .find("button.remove_bankruptcy_clone")
            .data("index");
        if (remove_btn_index > 0) {
            itm.find("button.remove_bankruptcy_clone").hide();
        }

        var cln = $(itm).clone();
        var case_filed_state = cln.find(".case_filed_state");
        var case_number = cln.find(".case_number");
        var case_date_filed = cln.find(".case_date_filed");
        var is_case_dismissed = cln.find(".is_case_dismissed_option");
        var filed_case_dismissed_data = cln.find(".dismiss_data_class");
        
        cln.find(".circle-number-div").html(index_val+1);
        cln.find("button.remove_bankruptcy_clone").attr("data-index", index_val);
        cln.find("button.remove_bankruptcy_clone").show();

        $(filed_case_dismissed_data).each(function () {
            $(this).removeAttr("id");
            $(this).attr("id", "filed_case_dismissed_data" + index_val);
        });

        $(case_filed_state).each(function () {
            $(this).attr("name", "part3[case_filed_state][" + index_val + "]");
        });
        $(case_number).each(function () {
            $(this).attr("name", "part3[case_number][" + index_val + "]");
        });
        $(case_date_filed).each(function () {
            $(this).attr("name", "part3[date_filed][" + index_val + "]");
        });
        $(is_case_dismissed).each(function () {
            $(this).attr("name", "part3[is_case_dismissed][" + index_val + "]");
            $(this).prop("checked", false);

            if ($(this).val() == "0") {
                $(this).attr( "id", "is_case_dismissed_no_" + index_val );
                $(this).next("label").attr( "for", "is_case_dismissed_no_" + index_val );
            }

            if ($(this).val() == "1") {
                $(this).attr( "id", "is_case_dismissed_yes_" + index_val );
                $(this).next("label").attr( "for", "is_case_dismissed_yes_" + index_val );
            }
        });

        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/bankruptcy_clone_\d+/g) || []).join(' ');
        }).addClass("bankruptcy_clone_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('bankruptcy_clone', " + index_val + ")");

        cln.find('input[type="text"]').val("");
        cln.find("input[type=radio]").prop("checked", false);
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        cln.find("label").removeClass("active");
        $(itm).after(cln);
    }
};

/**
 * Add previous bankruptcy case form (max 3)
 */
function addOther_bankruptcybefore_clone() {
    var clnln = $(document).find(".any_bankruptcy_filed_before_data").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".any_bankruptcy_filed_before_data").last();
        var index_val = $(itm).index() + 1;

        var remove_btn_index = itm
            .find("button.bankruptcybefore_clone")
            .data("index");
        if (remove_btn_index > 0) {
            itm.find("button.bankruptcybefore_clone").hide();
        }

        var cln = $(itm).clone();
        var case_name = cln.find(".case_name");
        var case_numbers = cln.find(".case_numbers");
        var any_case_date_filed = cln.find(".any_case_date_filed");
        var date_discharged = cln.find(".date_discharged");
        var district_if_known = cln.find(".district_if_known");
        var filed_case_dismissed_data = cln.find(".dismiss_data_class");

        cln.find("button.bankruptcybefore_clone").attr("data-index", index_val);
        cln.find("button.bankruptcybefore_clone").show();

        $(filed_case_dismissed_data).each(function () {
            $(this).removeAttr("id");
            $(this).attr("id", "filed_case_dismissed_data" + index_val);
        });
        
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        
        $(case_name).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_filed_before_data][case_name][" + index_val + "]");
        });
        $(case_numbers).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_filed_before_data][case_numbers][" + index_val + "]");
        });
        $(any_case_date_filed).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_filed_before_data][data_field][" + index_val + "]");
        });
        $(date_discharged).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_filed_before_data][date_discharged][" + index_val + "]");
        });
        $(district_if_known).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_filed_before_data][district_if_known][" + index_val + "]");
        });
        
        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/any_bankruptcy_filed_before_data_\d+/g) || []).join(' ');
        }).addClass("any_bankruptcy_filed_before_data_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('any_bankruptcy_filed_before_data', " + index_val + ")");
        cln.find(".circle-number-div").html(index_val+1);
        $(itm).after(cln);
        $(".remove_bankruptcybefore_clone").show();
    }
};

/**
 * Add pending bankruptcy case form (max 3)
 */
function addOther_bankruptcypending_clone() {
    var clnln = $(document).find(".addOther_bankruptcypending_clone").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".addOther_bankruptcypending_clone").last();
        var index_val = $(itm).index() + 1;

        var remove_btn_index = itm.find("button.stepfourdelete").data("index");
        if (remove_btn_index > 0) {
            itm.find("button.remove_bankruptcypending_clone").hide();
        }

        var cln = $(itm).clone();
        var debtor_name = cln.find(".debtor_name");
        var relationship = cln.find(".relanship");
        var case_number = cln.find(".case_nmbr");
        var any_case_date_filed = cln.find(".pending_cae_file_date");
        var distrct = cln.find(".dsitrct");
        
        cln.find(".circle-number-div").html(index_val+1);
        cln.find("button.remove_bankruptcypending_clone").attr("data-index", index_val);
        cln.find("button.remove_bankruptcypending_clone").show();

        $(debtor_name).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_cases_pending_data][debator_name][" + index_val + "]");
        });
        $(relationship).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_cases_pending_data][your_relationship][" + index_val + "]");
        });
        $(case_number).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_cases_pending_data][partner_case_number][" + index_val + "]");
        });
        $(any_case_date_filed).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_cases_pending_data][partner_date_filed][" + index_val + "]");
        });
        $(distrct).each(function () {
            $(this).attr("name", "part3[any_bankruptcy_cases_pending_data][district][" + index_val + "]");
        });

        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/addOther_bankruptcypending_clone_\d+/g) || []).join(' ');
        }).addClass("addOther_bankruptcypending_clone_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('addOther_bankruptcypending_clone', " + index_val + ")");
        
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(itm).after(cln);
        $(".remove_bankruptcypending_clone").show();
    }
};

/**
 * Add business form (max 6)
 */
function stepfour() {
    let indexR = 1;
    var clnln = $(document).find(".stepfour_clone").length;
    
    if (clnln > 5) {
        $.systemMessage('You can only insert 6 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".stepfour_clone").last();
        var index_val = clnln;
        var cln = $(itm).clone();
        var businessname = cln.find(".own_business_name");
        var nature_of_business = cln.find(".nature_of_business");
        var case_number = cln.find(".own_ein_no");
        var doesntHaveEin = cln.find(".doesntHaveEin");
        var business_still_open = cln.find(".business_still_open");
        var own_business_selection = cln.find(".own_business_selection");
        var street_number = cln.find(".street_number");
        var city = cln.find(".city");
        var state = cln.find(".state");
        var zip = cln.find(".zip");
        var operation_date = cln.find(".operation_date");
        var operation_date2 = cln.find(".operation_date2");
        var bussiness_type = cln.find(".bussiness_type");
        var business_still_open_data = cln.find(".business_still_open_data");
        var traded_stocks_type_of_account = cln.find(".traded_stocks_type_of_account_step");
        var traded_stocks_property_value = cln.find(".traded_stocks_property_value_step");
        var bsDescDiv = cln.find(".bsDescDiv");
        var beinDiv = cln.find(".beinDiv");
        var bsDesc = cln.find(".des_cbussiness_type");
        
        cln.find("select").val("");
        
        $(traded_stocks_type_of_account).each(function () {
            $(this).attr("name", "used_business_ein_data[type_of_account][" + index_val + "]");
        });
        $(traded_stocks_property_value).each(function () {
            $(this).attr("name", "used_business_ein_data[property_value][" + index_val + "]");
        });
        $(bussiness_type).each(function () {
            $(this).attr("name", "used_business_ein_data[type][" + index_val + "]");
            $(this).attr("onchange", "updateDsDescDivShowHide('" + index_val + "', 'bsDescDiv_" + index_val + "', 'beinDiv_" + index_val + "')");
        });

        $(bsDescDiv).each(function () {
            var prev_val = (index_val-1);
            $(this).removeClass("bsDescDiv_" + prev_val).addClass("bsDescDiv_" + index_val + " hide-data");
        });
        $(beinDiv).each(function () {
            var prev_val = (index_val-1);
            $(this).removeClass("beinDiv_" + prev_val).addClass("beinDiv_" + index_val + "");
        });

        $(business_still_open_data).each(function () {
            var prev_val = (index_val-1);
            $(this).removeClass("business_still_open_data_" + prev_val).addClass("business_still_open_data_" + index_val + " hide-data");
        });

        $(bsDesc).each(function () {
            $(this).attr('name', 'used_business_ein_data[businessDescription][' + index_val + ']');
        });

        $(businessname).each(function () {
            $(this).attr("name", "used_business_ein_data[own_business_name][" + index_val + "]");
        });

        $(nature_of_business).each(function () {
            $(this).attr("name", "used_business_ein_data[nature_of_business][" + index_val + "]");
        });

        $(street_number).each(function () {
            $(this).attr("name", "used_business_ein_data[street_number][" + index_val + "]");
        });

        $(city).each(function () {
            $(this).attr("name", "used_business_ein_data[city][" + index_val + "]");
        });

        $(state).each(function () {
            $(this).attr("name", "used_business_ein_data[state][" + index_val + "]");
        });

        $(zip).each(function () {
            $(this).attr("name", "used_business_ein_data[zip][" + index_val + "]");
        });

        $(operation_date).each(function () {
            $(this).attr("name", "used_business_ein_data[operation_date][" + index_val + "]");
            $(this).removeClass("hasDatepicker").attr("id", "");
        });

        $(operation_date2).each(function () {
            $(this).attr("name", "used_business_ein_data[operation_date2][" + index_val + "]");
            $(this).removeClass("hasDatepicker").attr("id", "");
        });

        $(doesntHaveEin).each(function () {
            $(this).attr("name", "used_business_ein_data[doesntHaveEin][" + index_val + "]");
        });

        $(business_still_open).each(function () {
            $(this).attr("name", "used_business_ein_data[business_still_open][" + index_val + "]");
            $(this).attr("onchange", "checkBizend(this," + index_val + ")");
        });

        $(own_business_selection).each(function () {
            $(this).attr("name", "used_business_ein_data[own_business_selection][" + index_val + "]");
        });
        
        $(case_number).each(function () {
            $(this).attr("name", "used_business_ein_data[own_ein_no][" + index_val + "]");
        });
        
        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/stepfour_clone_\d+/g) || []).join(' ');
        }).addClass("stepfour_clone_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('stepfour_clone', " + index_val + ")");
        cln.find(".circle-number-div").html(index_val+1);
        cln.find('input[type="text"]').val("");
        cln.find('input[type="checkbox"]').prop("checked", false);
        cln.find('input[type="number"]').val("");
        cln.find('input[type="text"]').prop("disabled", false);
        $(itm).after(cln);
        
        if(typeof initializeDatepicker === 'function') {
            initializeDatepicker();
        }
        indexR++;
    }
};

/**
 * Helper function for business description show/hide
 */
function updateDsDescDivShowHide(index, divClass, beinDiv) {
    var selectedValue = $(`select[name="used_business_ein_data[type][${index}]"]`).val();
    var $divElement = $('.' + divClass);
    var $eindivElement = $('.' + beinDiv);

    if (selectedValue == 2) {
        $divElement.removeClass('hide-data');
        $eindivElement.addClass('hide-data');
    } else {
        $divElement.addClass('hide-data');
        $eindivElement.removeClass('hide-data');
    }
};

/**
 * Check if business is still open/closed
 * Original version from questionarrie.js
 */
function checkBizend(thisobj, index) {
    let parentDiv = $(thisobj).closest(".businessEnded");
    let inputText = parentDiv.find(".operation_date2");

    inputText.prop("disabled", thisobj.checked);

    if (thisobj.checked) {
        inputText.removeClass("required");
        inputText.val("");
        $('.business_still_open_data_'+index).removeClass('hide-data');
    } else {
        inputText.addClass("required");
        inputText.val("");
        $('.business_still_open_data_'+index).addClass('hide-data');
    }
};

/**
 * Check EIN checkbox - disable/enable EIN input
 * Original version from questionarrie.js (line 14921)
 */
function checkEin(thisobj) {
    let parentDiv = $(thisobj).closest(".beinDiv");
    let einInput = parentDiv.find(".eiin");

    einInput.prop("disabled", thisobj.checked);

    if (thisobj.checked) {
        einInput.val("");
        einInput.removeClass("required");
    } else {
        einInput.addClass("required");
        einInput.val("");
    }
};

// ==================== REMOVE EVENT HANDLERS ====================

// Remove current bankruptcy clone
$(document).on("click", ".remove_bankruptcy_clone", function () {
    var clnln = $(".bankruptcy_clone").length;
    if (clnln > 1) {
        $(".bankruptcy_clone").last().remove();
    }
    if (clnln == 2) {
        $(".remove_bankruptcy_clone").hide();
    }
});

// Remove previous bankruptcy clone
$(document).on("click", ".remove_bankruptcybefore_clone", function () {
    var clnln = $(".any_bankruptcy_filed_before_data").length;
    if (clnln > 1) {
        $(".any_bankruptcy_filed_before_data").last().remove();
    }
    if (clnln == 2) {
        $(this).hide();
    }
});

// Remove pending bankruptcy clone
$(document).on("click", ".remove_bankruptcypending_clone", function () {
    var clnln = $(".addOther_bankruptcypending_clone").length;
    var itm = $(document).find(".addOther_bankruptcypending_clone").last();
    if (clnln > 1) {
        itm.remove();
    }
    if (clnln == 2) {
        $(".remove_bankruptcypending_clone").hide();
    }
});

// Remove business (step 4) clone
$(document).on("click", ".stepfourdelete", function () {
    var clnln = $(".stepfour_child_div").length;
    var itm = $(document).find(".stepfour_child_div").last();
    if (clnln > 1) {
        itm.remove();
    }
    if (clnln == 2) {
        $(".stepfourdelete").hide();
    }
});

// Export functions to global scope for backward compatibility
window.initializeStep3Validation = initializeStep3Validation;
window.initializeBasicInfoParts = initializeBasicInfoParts;
window.get_used_business_ein = get_used_business_ein;
window.addOther_bankruptcy_clone = addOther_bankruptcy_clone;
window.addOther_bankruptcybefore_clone = addOther_bankruptcybefore_clone;
window.addOther_bankruptcypending_clone = addOther_bankruptcypending_clone;
window.stepfour = stepfour;
window.updateDsDescDivShowHide = updateDsDescDivShowHide;
window.checkBizend = checkBizend;
window.checkEin = checkEin;

