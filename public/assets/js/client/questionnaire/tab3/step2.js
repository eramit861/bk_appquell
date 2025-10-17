/**
 * Tab 3 - Step 2: Priority Debts
 * Back taxes, IRS, Domestic support, Additional liens
 */

// ==================== TOGGLE FUNCTIONS ====================

/**
 * Toggle back taxes section
 */
function getTaxowned(value) {
    const taxOwnedState = document.getElementById('tax-owned-state');
    const taxOwnedStateAddMore = document.getElementById('tax-owned-state-add-more');

    if (value == 'yes') {
        if (taxOwnedState) taxOwnedState.classList.remove("hide-data");
        if (taxOwnedStateAddMore) taxOwnedStateAddMore.classList.remove("hide-data");
        $('.back_tax_note').removeClass('hide-data');
    } else if (value == 'no') {
        if (taxOwnedState) taxOwnedState.classList.add("hide-data");
        if (taxOwnedStateAddMore) taxOwnedStateAddMore.classList.add("hide-data");
        $('.back_tax_note').addClass('hide-data');
    }
}

/**
 * Toggle domestic support debts section
 */
function getAnotherDebts(value) {
    const allDependents = document.getElementById('all_dependents');

    if (value == 'yes') {
        if (allDependents) allDependents.classList.remove("hide-data");
    } else if (value == 'no') {
        if (allDependents) allDependents.classList.add("hide-data");
    }
}

// ==================== UNKNOWN CHECKBOX FUNCTIONS ====================

/**
 * Toggle unknown date for back taxes
 */
function unknownChecked(index) {
    if ($("#debt_date_unknown_" + index).is(':checked')) {
        $("input[name='debt_tax[debt_date][" + index + "]']").val('');
        $("input[name='debt_tax[debt_date][" + index + "]']").attr('readonly', 'readonly');
        $("input[name='debt_tax[debt_date][" + index + "]']").removeClass('required');
    } else {
        $("input[name='debt_tax[debt_date][" + index + "]']").val('');
        $("input[name='debt_tax[debt_date][" + index + "]']").removeAttr('readonly');
        $("input[name='debt_tax[debt_date][" + index + "]']").addClass('required');
    }
}

/**
 * Toggle unknown date for additional liens
 */
function liensUnknownChecked(index) {
    if ($("#additional_liens_date_unknown_" + index).is(':checked')) {
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").val('');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").attr('readonly', 'readonly');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").removeClass('required');
    } else {
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").val('');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").removeAttr('readonly');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").addClass('required');
    }
}

// ==================== THREE MONTHS PAYMENT TOGGLE ====================

/**
 * Toggle three months payment section for additional liens
 */
function isThreeMonthAddLiens(selected_value, index) {
    if (selected_value == 'no') {
        $(".add_liens_three_months_div_" + index).addClass("hide-data");
        $(".add_liens_three_months_div_" + index).find(".price-field").each(function () {
            $(this).val("");
        });
    }
    if (selected_value == 'yes') {
        $(".add_liens_three_months_div_" + index).removeClass("hide-data");
    }
}

// ==================== FORM REMOVAL FUNCTIONS ====================

/**
 * Remove domestic support form
 */
function removeDomesticForm(obj) {
    if (obj.parentNode.className == 'row') {
        obj.parentNode.parentNode.removeChild(obj.parentNode);
        counter--;
    }
}

/**
 * Remove additional liens form
 */
function removeAdditionalLiensForm(obj) {
    if (obj.parentNode.className == 'row') {
        obj.parentNode.parentNode.removeChild(obj.parentNode);
        counter--;
    }
}

// ==================== ADDRESS LOOKUP FUNCTIONS ====================

/**
 * Get address for back taxes by state
 */
function getAddress(selectObject, sr) {
    var scode = selectObject.value;
    var ids = selectObject.id;
    var rrs = ids.split('_');
    var addresslist = window.__debtStep2Data?.addressList || [];

    $.each(addresslist, function (index, value) {
        if (value.code == scode) {
            $("#tax_address_div_" + rrs[1]).removeClass("hide-data");
            $("#head_" + rrs[1]).html('<p>' + value.address_heading + '</p>');
            var addline3 = '';
            if (value.add3 != undefined && value.add3 != "") {
                addline3 = value.add3 + '<br>';
            }
            var addline2 = '';
            if (value.add3 != undefined && value.add2 != "") {
                addline2 = value.add2 + '<br>';
            }
            $("#address_" + rrs[1]).html('<p>' + value.add1 + '<br>' + addline2 + addline3 + value.city + ', ' + value.code + ', ' + value.zip + '</p>');
        }
    });
}

/**
 * Get address for domestic support by state
 */
function getDomesticAddress(selectObject, sr) {
    var scode = selectObject.value;
    var ids = selectObject.id;
    var rrs = ids.split('_');
    var domesticaddresslist = window.__debtStep2Data?.domesticAddressList || [];

    $.each(domesticaddresslist, function (index, value) {
        if (value.address_state == scode) {
            $("#domestic_saddress_div_" + rrs[1]).removeClass("hide-data");
            $("#domesic_head_" + rrs[1]).html('<p>' + value.address_name + '</p>');
            $("#domestic_address_" + rrs[1]).html('<p>' + value.address_street + '<br>' + value.address_city + ', ' + value.address_state + ', ' + value.address_zip + '</p>');

            $("#notify_domesic_head_" + rrs[1]).html('');
            $("#notify_domesic_head_" + rrs[1]).html('<p>' + value.notify_address_name + '</p>');
            $("#notify_domestic_address_" + rrs[1]).html('');

            if (value.notify_address_zip != '') {
                $("#notify_domestic_address_" + rrs[1]).html('<p>' + value.notify_address_street + '<br>' + value.notify_address_city + ', ' + value.address_state + ', ' + value.notify_address_zip + '</p>');
            }
        }
    });
}

/**
 * Get IRS address by state
 */
function getirsAddress(selectObject) {
    var scode = selectObject.value;
    var addresslist = window.__debtStep2Data?.addressList || [];

    $.each(addresslist, function (index, value) {
        if (value.code == scode) {
            $("#irs_state_heading").html('<p>' + value.address_heading + '</p>');
            $("#irs_state_desc").html('<p>' + value.add1 + '<br>' + value.add2 + '</p>');
        }
    });
}

// ==================== CREDIT REPORT FUNCTIONS ====================

/**
 * Open GraphQL confirm popup
 */
function openGraphqlComfirmPopup() {
    var url = window.__debtStep2Routes?.confirmCreditPopup || '';
    laws.ajax(url, { client_id: 'null' }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            var modalContainer = document.createElement('div');
            modalContainer.innerHTML = res.html;
            document.body.appendChild(modalContainer);

            var modalElement = modalContainer.querySelector('.modal');
            if (modalElement) {
                var submitModal = new bootstrap.Modal(modalElement);
                submitModal.show();
            } else {
                console.error('Modal element not found in response HTML.');
            }
        }
    });
}

/**
 * Confirm all AI pending to include
 */
function confirmAllAIPendingToInclude(confirm_type = '') {
    var url = window.__debtStep2Routes?.confirmCreditReport || '';
    laws.ajax(url, {
        report_id: null,
        client_confirm: null,
        confirm_type: confirm_type
    }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            $.systemMessage(res.msg, 'alert--success', true);
            if (confirm_type != '') {
                window.location.reload();
            }
        }
    });
}

/**
 * Confirm individual creditor
 */
function confirmCreditor(report_id, status) {
    var url = window.__debtStep2Routes?.confirmCreditReport || '';
    laws.ajax(url, {
        report_id: report_id,
        client_confirm: status
    }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            $.systemMessage(res.msg, 'alert--success', true);
            $('#display_cr_mobile' + report_id).addClass('hide-data');
            $('#display_cr_desktop' + report_id).addClass('hide-data');
            $('.mobile-radio-label-' + report_id).addClass('hide-data');
            if (status == 1) {
                $('.accept_label_' + report_id).removeClass('hide-data');
            }
            if (status == 2) {
                $('.decline_label_' + report_id).removeClass('hide-data');
            }
        }
    });
}

/**
 * Open get report popup
 */
function opengetReportPopup() {
    var url = window.__debtStep2Routes?.openGetReportPopup || '';
    laws.ajax(url, {
        client_id: 'null'
    }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            var modalContainer = document.createElement('div');
            modalContainer.innerHTML = res.html;
            document.body.appendChild(modalContainer);

            var modalElement = modalContainer.querySelector('.modal');
            if (modalElement) {
                var submitModal = new bootstrap.Modal(modalElement);
                submitModal.show();
            } else {
                console.error('Modal element not found in response HTML.');
            }
        }
    });
}

/**
 * Video preview function for credit report guide
 */
function videoPreviewFunction(element) {
    const language = window.__debtStep2Data?.language || 'en';
    const videoEn = $(element).data('video');
    const videoSp = $(element).data('video2');
    const videoSrc = language === 'en' ? videoEn : videoSp;

    $('iframe.rumble').attr('src', videoSrc);
    $('.video-btn-div').addClass('d-none');
    $('.video-preview-div').removeClass('d-none');

    setTimeout(function () {
        $('.report_video_link').css({
            'pointer-events': 'auto',
            'background': ''
        }).addClass('text-bold');
        $('.must_watch_text').addClass('hide-data');
        $('.report_video_link').addClass('text-c-white');
        $('.copy_cc_r').addClass('blink');
        $('.copy_cc_r').addClass('text-c-red');
    }, 40000);
}

/**
 * Open free report guide
 */
function openFreeReportGuide() {
    laws.updateFaceboxContent($('#report_guide_img').html(), 'fbminwidth productQuickView quickinfor');
}

/**
 * Credit report upload button click
 */
function creditReportUploadBtnClick(anchorElement, input_id) {
    if (!$(anchorElement).hasClass('upload-active')) {
        $(anchorElement).addClass('upload-active');
    }

    let fileInput = $('#' + input_id);
    $('#' + input_id).click();

    setTimeout(function () {
        if (!fileInput[0].files.length) {
            $(anchorElement).removeClass('upload-active');
        }
    }, 3000);
}

/**
 * Credit report upload file selected
 */
function creditReportUploadBtnSelect(event, document_type, dataFor) {
    var formData = new FormData();
    formData.append('document_type', document_type);

    var client_id = window.__debtStep2Data?.clientId || '';
    formData.append('client_id', client_id);
    var selectedFiles = event.target.files;

    if (selectedFiles.length === 1) {
        var imageFile = selectedFiles[0];
        var newName = replaceAll(imageFile.name, "_", " ");
        formData.append('document_file[]', imageFile, newName);
    }

    $.systemMessage(`BKQ AI is pulling all of the ${dataFor}'s credit report from the uploaded file and importing it to Credit reports with AI. Please be patient the magic takes a few minutes.`, 'alert--process');
    var ajaxURL = window.__debtStep2Routes?.clientDocumentUploads || '';

    $.ajax({
        url: ajaxURL,
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 1) {
                $.systemMessage(response.msg, 'alert--success', true);
            }
            if (response.status == 0) {
                $.systemMessage(response.msg, 'alert--danger', true);
            }
        },
        error: function (response) {
            console.log("error", response.status, response.msg);
        }
    });
}

// ==================== INITIALIZATION ====================

$(function () {
    // Initialize credit report functionality on step 2
    if (typeof initializeCreditReport === 'function') {
        initializeCreditReport();
    }
});

/**
 * Initialize credit report functionality
 */
function initializeCreditReport() {
    // Auto-trigger credit report popups based on server-side conditions
    if (window.__debtStep2Data?.showGraphqlComfirmPopup === true) {
        openGraphqlComfirmPopup();
    }

    if (window.__debtStep2Data?.showGetReportPopup === true) {
        opengetReportPopup();
    }
}

/**
 * Save back tax debt
 */
function saveBackTaxDebt(displaymsg = true, thisobj = {}, newdiv = false) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_back_taxes", displaymsg);
    if (!hasError && !newdiv) {
        var cln = $(thisobj).parent('div').parent('div').parent("div").parent("div").parent('div');
        var debt_creditor_form = cln.find(".tax_debt_form");
        $(debt_creditor_form).each(function () {
            if ($(this).find(".common_creditor_summary").hasClass('hide-data')) {
                $(this).find(".common_creditor_summary").removeClass('hide-data');
                $(this).find(".insider_data").addClass('hide-data');
            }
        });
    }
    return !hasError;
}

/**
 * Add back taxes
 */
function addbackTaxes(url) {
    var saveData = saveBackTaxDebt(true);
    if (saveData == false) {
        return false;
    }

    var clnln = $(document).find(".tax_debt_form").length;
    if (clnln > 5) {
        alert("You can only insert 6 business.");
        return false;
    } else {
        var itm = $(document).find(".tax_debt_form").last();
        var index_val = $(itm).index();
        var nextIndex = index_val + 1;
        var index_val = nextIndex;

        /*Values that need to display under summary */

        var state = $(itm).find(".debt_state").val();
        var year = $(itm).find(".tax_whats_year").val();
        var total = $(itm).find(".tax_total_due").val();

        var htmlfile = "";

        htmlfile +=
            "<div class='row'><div class='col-md-2'><strong class='debt_no'>" +
            (index_val + 1) +
            ". </strong><strong>State: </strong><span class='summary-state-" +
            index_val +
            "'>" +
            state +
            "</span></div>";
        htmlfile +=
            "<div class='col-md-5'><strong>For what year or years: </strong><span class='summary-years-" +
            index_val +
            " '>" +
            year +
            "</span></div>";
        htmlfile +=
            "<div class='col-md-3'><strong>Total Due: </strong><span class='summary-total-due-" +
            index_val +
            " text-danger'>$" +
            total +
            "</span></div>";

        var deleteUrl = '"' + url + '"';
        htmlfile +=
            "<div class='col-md-2'> <a href='javascript:void(0)' data-saveid='" +
            index_val +
            "' class='label mx-ht btn text-white f-12  float_right remove-button delte-icon  delete-btn-top ' onclick='removeBackTaxDebt(" +
            deleteUrl +
            ",this);'><i class='fa fa-lg fa-trash'></i></a> <a href='javascript:void(0)' data-saveid='" +
            index_val +
            "' class='label btn  mx-ht lightblue-bg text-white f-12 float_right' onclick='display_bt_debt_div(" +
            index_val +
            ")'>Edit</a> </div></div>";

        /*Values that need to display under summary */

        var cln = $(itm).clone();
        cln.find(".debt_no").html(nextIndex + 1 + ".");
        cln.find(".common_creditor_summary").addClass("hide-data");
        cln.find(".insider_data").removeClass("hide-data");

        cln.find(".common_creditor_summary").html("");
        if (state != "") {
            cln.find(".common_creditor_summary").html(htmlfile);
        }

        cln.find(".circle-number-div").html(nextIndex);
        cln.find(".delete-div").attr("data-saveid", index_val);
        cln.find(".client-edit-button").attr("data-saveid", index_val).attr("onclick", "display_bt_debt_div(this, "+index_val+")");

        cln.find("label").removeClass("active");
        var credit_summ = cln.find(".common_creditor_summary");
        var insider_data = cln.find(".insider_data");

        var save_btn_bottom = cln
            .find(".save-btn-bottom")
            .addClass("tax-save-button");
        var delete_btn_bottom = cln.find(".delete-btn-bottom");

        var debt_state = cln.find(".debt_state");
        var tax_whats_year = cln.find(".tax_whats_year");
        var tax_total_due = cln.find(".tax_total_due");

        var head_text = cln.find(".head_text");
        var desc_text = cln.find(".desc_text");
        var tax_debt_div = cln.find(".tax_debt_div");

        var pasttax_owned_by = cln.find(".pasttax_owned_by");
        var debt_tax_codebtor_creditor_name = cln.find(
            ".debt_tax_codebtor_creditor_name"
        );
        var debt_tax_codebtor_creditor_name_addresss = cln.find(
            ".debt_tax_codebtor_creditor_name_addresss"
        );
        var debt_tax_codebtor_creditor_city = cln.find(
            ".debt_tax_codebtor_creditor_city"
        );
        var debt_tax_codebtor_creditor_state = cln.find(
            ".debt_tax_codebtor_creditor_state"
        );
        var debt_tax_codebtor_creditor_zip = cln.find(
            ".debt_tax_codebtor_creditor_zip"
        );

        var back_tax_state_months = cln.find(".back_tax_state_months");
        var back_tax_state_months_yes = cln.find(".back_tax_state_months_yes");
        var back_tax_state_months_no = cln.find(".back_tax_state_months_no");
        cln.find(".debt_tax_codebtor_cosigner_data").addClass("hide-data");
        var back_tax_state_months_div = cln
            .find(".back_tax_state_months_div")
            .addClass("hide-data");
        var payment_1 = cln.find(".payment_1");
        var payment_2 = cln.find(".payment_2");
        var payment_3 = cln.find(".payment_3");
        var payment_dates_1 = cln.find(".payment_dates_1");
        var payment_dates_2 = cln.find(".payment_dates_2");
        var payment_dates_3 = cln.find(".payment_dates_3");
        var total_amount_paid = cln.find(".total_amount_paid");

        var prev_index = index_val - 1;

        var selectall = cln.find(".selectall");
        var justone = cln.find(".justone");

        var validate_div = cln.find(".al_valid_div");
        var validate_msg = cln.find(".al_valid_msg");

        $(back_tax_state_months).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[is_back_tax_state_three_months][" + index_val + "]"
            );
            if ($(this).val() == "1") {                        
                $(this).attr("id", "is_back_tax_state_three_months_yes_" + index_val);
                $(this).next("label").attr( "for", "is_back_tax_state_three_months_yes_" + index_val);
                $(this).next("label").attr( "onclick", "isThreeMonthsCommon('yes', 'back_tax_state_three_months_div_" + index_val + "')" );      
            }
            if ($(this).val() == "0") {                
                $(this).attr("id", "is_back_tax_state_three_months_no_" + index_val);
                $(this).next("label").attr( "for", "is_back_tax_state_three_months_no_" + index_val);
                $(this).next("label").attr( "onclick", "isThreeMonthsCommon('no', 'back_tax_state_three_months_div_" + index_val + "')" );    
            }
            $(this).prop("checked", false);
            $(payment_1).each(function () {
                $(this).attr(
                    "name",
                    "back_tax_own[payment_1][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_2).each(function () {
                $(this).attr(
                    "name",
                    "back_tax_own[payment_2][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_3).each(function () {
                $(this).attr(
                    "name",
                    "back_tax_own[payment_3][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_dates_1).each(function () {
                $(this).attr(
                    "name",
                    "back_tax_own[payment_dates_1][" + index_val + "]"
                );
            });
            $(payment_dates_2).each(function () {
                $(this).attr(
                    "name",
                    "back_tax_own[payment_dates_2][" + index_val + "]"
                );
            });
            $(payment_dates_3).each(function () {
                $(this).attr(
                    "name",
                    "back_tax_own[payment_dates_3][" + index_val + "]"
                );
            });
            $(total_amount_paid).each(function () {
                $(this).attr(
                    "name",
                    "back_tax_own[total_amount_paid][" + index_val + "]"
                );
            });
        });
        $(back_tax_state_months_div).each(function () {
            $(this).removeClass(
                "back_tax_state_three_months_div_" + prev_index
            );
            $(this).addClass("back_tax_state_three_months_div_" + index_val);
        });

        $(pasttax_owned_by).each(function () {
            $(this).attr("name", "back_tax_own[owned_by][" + index_val + "]");
            $(this).prop("checked", false);
            let thisRadioId = $(this).attr("id");
            $(this).attr("id", thisRadioId + index_val);
            $(this).next("label").attr("for", thisRadioId + index_val);
        });

        $(debt_tax_codebtor_creditor_name).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[codebtor_creditor_name][" + index_val + "]"
            );
        });

        // $(remove_div_icon).each(function() {
        //     $(this).attr('onclick', 'remove_debt_div(' + nextIndex + ')');
        // });

        $(debt_tax_codebtor_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[codebtor_creditor_name_addresss][" +
                    index_val +
                    "]"
            );
        });

        $(debt_tax_codebtor_creditor_city).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[codebtor_creditor_city][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_state).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[codebtor_creditor_state][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[codebtor_creditor_zip][" + index_val + "]"
            );
        });

        $(tax_debt_div).each(function () {
            $(this).attr("id", "tax_address_div_" + index_val);
        });
        $(head_text).each(function () {
            $(this).attr("id", "head_" + index_val);
        });

        $(desc_text).each(function () {
            $(this).attr("id", "address_" + index_val);
        });

        $(debt_state).each(function () {
            $(this).attr("name", "back_tax_own[debt_state][" + index_val + "]");
            $(this).attr("id", "state_" + index_val);
            $(this).attr("onchange", "getAddress(this," + index_val + ")");
            $(this)
                .removeClass("debt_state_" + (index_val - 1))
                .addClass("debt_state_" + index_val);
        });

        $(tax_whats_year).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[tax_whats_year][" + index_val + "]"
            );
            $(this)
                .removeClass("tax_whats_year_" + (index_val - 1))
                .addClass("tax_whats_year_" + index_val);
        });
        $(tax_total_due).each(function () {
            $(this).attr(
                "name",
                "back_tax_own[tax_total_due][" + index_val + "]"
            );
            $(this)
                .removeClass("tax_total_due_" + (index_val - 1))
                .addClass("tax_total_due_" + index_val);
        });
        $(selectall).each(function () {
            $(this).attr(
                "data-inputname",
                "back_tax_own[tax_whats_year][" + index_val + "]"
            );
            $(this).attr("data-inputfor", "state_tax_" + index_val);
        });
        $(justone).each(function () {
            $(this).removeClass("state_tax_" + prev_index);
            $(this).addClass("state_tax_" + index_val);
            $(this).attr(
                "data-inputname",
                "back_tax_own[tax_whats_year][" + index_val + "]"
            );
            $(this).attr("data-inputfor", "state_tax_" + index_val);

            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).parent("label").attr("for", $(this).attr("id"));
            $(this).prop("checked", false);
        });

        $(validate_div).each(function () {
            var oldInx = index_val - 1;
            al_validation_msg_;
            $(validate_div).removeClass("al_validation_msg_div_" + oldInx);
            $(validate_div).addClass("al_validation_msg_div_" + index_val);
        });
        $(validate_msg).each(function () {
            var oldInx = index_val - 1;
            $(validate_msg)
                .removeClass("al_validation_msg_" + oldInx)
                .addClass("al_validation_msg_" + index_val);
        });
        $(credit_summ).each(function () {
            $(this)
                .removeClass("back_tax_summary_" + (index_val - 1))
                .addClass("back_tax_summary_" + nextIndex);
        });
        $(insider_data).each(function () {
            $(this)
                .removeClass("back_tax_data_" + (index_val - 1))
                .addClass("back_tax_data_" + nextIndex);
        });

        $(save_btn_bottom).each(function () {
            $(this).attr("data-saveid", index_val);
            $(this).attr(
                "onclick",
                "saveBackTaxDebt(true,this,true)"
            );
        });
        $(delete_btn_bottom).each(function () {
            $(this).attr("data-saveid", index_val);
            $(this).attr("onclick", "removeBackTaxDebt('" + url + "', this)");
        });

        cln.find("select").val("");
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("input[type=radio]").prop("checked", false);
        $(itm).after(cln);
        $("#tax_address_div_" + index_val).addClass("hide-data");
    }
}

/**
 * Save IRS debt
 */
function saveIRSDebt(displaymsg = true) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_irs",displaymsg);
    if(!hasError){
        $("#tax-owned-irs").addClass('hide-data');
    }else{
        $("#tax-owned-irs").removeClass('hide-data');
    }
    return !hasError;
}

/**
 * Save DSO debt
 */
function saveDSODebt(displaymsg = true, thisobj={},newdiv=false) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_dso",displaymsg);
    if(!hasError && !newdiv){
        var cln = $(thisobj).parent('div').parent('div').parent("div").parent("div").parent('div');
        var debt_creditor_form = cln.find(".domestic_form");
        $(debt_creditor_form).each(function () {
            if($(this).find(".common_creditor_summary").hasClass('hide-data')){
                $(this).find(".common_creditor_summary").removeClass('hide-data');
                $(this).find(".insider_data").addClass('hide-data');
            }
        });
    }
    return !hasError;
}

/**
 * Add another domestic form
 */
function addAnotherDomesticForm(url) {
    var saveData = saveDSODebt(true);

    if (saveData == false) {
        return false;
    }

    var clnln = $(document).find(".domestic_form").length;
    if (clnln > 4) {
        alert("You can only insert 5 domestic debts.");
        return false;
    } else {
        var itm = $(document).find(".domestic_form").last();
        var index_val = "";
        $(document)
            .find(".domestic_form")
            .each(function (index) {
                index_val = index;
            });
        index_val = index_val + 1;

        /*Values that need to display under summary */

        var sumSecState = $(itm).find(".domestic_address_state").val();

        var htmlfile = "";

        htmlfile +=
            "<div class='col-md-5'><strong class='debt_no'>" +
            index_val +
            ". </strong><strong>The Court Order is from: </strong><span class='summary-state-" +
            index_val +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-7'><strong>Name of person owed the support: </strong><span class='summary-name-" +
            index_val +
            "'></span></div>";
        htmlfile += "<div class='col-md-5'><div class='row'>";
        htmlfile +=
            "<div class='col-md-12'><strong>Street address of person: </strong><span class='summary-address-" +
            index_val +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-5'><strong>City: </strong><span class='summary-city-" +
            index_val +
            "'></span> </div>";
        htmlfile +=
            "<div class='col-md-3'><strong>State: </strong><span class='summary-state-" +
            index_val +
            "'></span> </div>";
        htmlfile +=
            "<div class='col-md-4'><strong>Zip: </strong><span class='summary-zip-" +
            index_val +
            "'></span> </div>";
        htmlfile += "</div></div>";
        htmlfile +=
            "<div class='col-md-7'> <div class='row'> <div class='col-md-7'><strong>Acct.# (Last 4 digits): </strong><span class='summary-account-" +
            index_val +
            "'></span> </div>";
        htmlfile +=
            "<div class='col-md-5'><strong>Amount owned: </strong><span class='summary-owed-" +
            index_val +
            " text-danger'>$</span> </div> </div> </div>";
        htmlfile +=
            "<div class='col-md-10'></div> <div class='col-md-2 text-right'> <a href='javascript:void(0)' data-saveid='" +
            index_val +
            "' class='label mx-ht btn lightblue-bg text-white f-12 edit-btn-top ' onclick='display_dso_debt_div(" +
            index_val +
            ")'>Edit</a>";
        htmlfile +=
            "<a href='javascript:void(0)' data-saveid='" +
            index_val +
            "' class='label mx-ht text-white f-12 delte-icon remove-button  delete-btn-top ' onclick='removeDSODebt('" +
            url +
            "',this);'><i class='fa fa-lg fa-trash'></i></a> </div>";

        /*Values that need to display under summary */

        var cln = $(itm).clone();

        cln.find(".debt_no").html(index_val + 1 + ".");
        cln.find(".common_creditor_summary").addClass("hide-data");
        cln.find(".insider_data").removeClass("hide-data");
        cln.find(".circle-number-div").html(index_val+1);
        cln.find(".delete-div").attr("data-saveid", index_val);
        cln.find(".client-edit-button").attr("data-saveid", index_val).attr("onclick", "display_dso_debt_div(this, "+index_val+")");
        cln.find("label").removeClass("active");
        cln.find(".common_creditor_summary").html("");
        if (sumSecState != "") {
            cln.find(".common_creditor_summary").html(htmlfile);
        }

        var credit_summ = cln.find(".common_creditor_summary");
        var insider_data = cln.find(".insider_data");

        var save_btn_bottom = cln.find(".save-btn-bottom");
        var delete_btn_bottom = cln.find(".delete-btn-bottom");

        var validate_div = cln.find(".dso_validate_div");
        var validate_msg = cln.find(".dso_validate_msg");

        var head_text = cln.find(".domestic_head_text");
        var desc_text = cln.find(".domestic_desc_text");
        var domestic_div = cln.find(".domestic_div");
        var notifiy_head_text = cln.find(".notify_domestic_head_text");
        var notifiy_desc_text = cln.find(".notifiy_domestic_desc_text");
        var notify_domestic_div = cln.find(".notify_domestic_div");

        $(notifiy_head_text).each(function () {
            $(this).attr("id", "notify_domesic_head_" + index_val);
        });
        $(notifiy_desc_text).each(function () {
            $(this).attr("id", "notify_domestic_address_" + index_val);
        });
        $(notify_domestic_div).each(function () {
            $(this).attr("id", "domestic_address_div_" + index_val);
        });
        $(desc_text).each(function () {
            $(this).attr("id", "domestic_address_" + index_val);
        });
        $(domestic_div).each(function () {
            $(this).attr("id", "domestic_saddress_div_" + index_val);
        });

        var domestic_support_name = cln.find(".domestic_support_name");
        var domestic_support_address = cln.find(".domestic_support_address");
        var domestic_support_city = cln.find(".domestic_support_city");
        var domestic_support_zipcode = cln.find(".domestic_support_zipcode");
        var domestic_support_monthlypay = cln.find(
            ".domestic_support_monthlypay"
        );
        var domestic_support_past_due = cln.find(".domestic_support_past_due");
        var creditor_state = cln.find(".creditor_state");
        var domestic_owned_by = cln.find(".domestic_owned_by");
        var domestic_address_state = cln.find(".domestic_address_state");
        var domestic_support_account = cln.find(".domestic_support_account");
        var domestic_support_months = cln.find(".domestic_support_months");
        var domestic_support_months_yes = cln.find(
            ".domestic_support_months_yes"
        );
        var domestic_support_months_no = cln.find(
            ".domestic_support_months_no"
        );
        var domestic_support_months_div = cln
            .find(".domestic_support_months_div")
            .addClass("hide-data");
        var payment_1 = cln.find(".payment_1");
        var payment_2 = cln.find(".payment_2");
        var payment_3 = cln.find(".payment_3");
        var payment_dates_1 = cln.find(".payment_dates_1");
        var payment_dates_2 = cln.find(".payment_dates_2");
        var payment_dates_3 = cln.find(".payment_dates_3");
        var total_amount_paid = cln.find(".total_amount_paid");

        $(domestic_support_months).each(function () {
            $(this).prop("checked", false);
            $(this).attr(
                "name",
                "domestic_tax[is_domestic_support_three_months][" +
                    index_val +
                    "]"
            );
            if ($(this).val() == "1") {
                $(this).attr(
                    "onclick",
                    "isThreeMonthsCommon('yes', 'domestic_support_three_months_div_" +
                        index_val +
                        "')"
                );
                $(this).attr(
                    "id",
                    "is_domestic_support_three_months_yes_" + index_val
                );
                $(domestic_support_months_yes).attr(
                    "for",
                    "is_domestic_support_three_months_yes_" + index_val
                );
            }
            if ($(this).val() == "0") {
                $(this).attr(
                    "onclick",
                    "isThreeMonthsCommon('no', 'domestic_support_three_months_div_" +
                        index_val +
                        "')"
                );
                $(this).attr(
                    "id",
                    "is_domestic_support_three_months_no_" + index_val
                );
                $(domestic_support_months_no).attr(
                    "for",
                    "is_domestic_support_three_months_no_" + index_val
                );
            }
            $(payment_1).each(function () {
                $(this).attr(
                    "name",
                    "domestic_tax[payment_1][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_2).each(function () {
                $(this).attr(
                    "name",
                    "domestic_tax[payment_2][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_3).each(function () {
                $(this).attr(
                    "name",
                    "domestic_tax[payment_3][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_dates_1).each(function () {
                $(this).attr(
                    "name",
                    "domestic_tax[payment_dates_1][" + index_val + "]"
                );
            });
            $(payment_dates_2).each(function () {
                $(this).attr(
                    "name",
                    "domestic_tax[payment_dates_2][" + index_val + "]"
                );
            });
            $(payment_dates_3).each(function () {
                $(this).attr(
                    "name",
                    "domestic_tax[payment_dates_3][" + index_val + "]"
                );
            });
            $(total_amount_paid).each(function () {
                $(this).attr(
                    "name",
                    "domestic_tax[total_amount_paid][" + index_val + "]"
                );
            });
        });
        $(domestic_support_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass(
                "domestic_support_three_months_div_" + prev_index
            );
            $(this).addClass("domestic_support_three_months_div_" + index_val);
        });

        $(domestic_support_name).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_support_name][" + index_val + "]"
            );
            $(this)
                .removeClass("domestic_support_name_" + (index_val - 1))
                .addClass("domestic_support_name_" + index_val);
        });
        $(domestic_support_address).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_support_address][" + index_val + "]"
            );
            $(this)
                .removeClass("domestic_support_address_" + (index_val - 1))
                .addClass("domestic_support_address_" + index_val);
        });

        $(domestic_support_city).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_support_city][" + index_val + "]"
            );
            $(this)
                .removeClass("domestic_support_city_" + (index_val - 1))
                .addClass("domestic_support_city_" + index_val);
        });
        $(domestic_support_zipcode).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_support_zipcode][" + index_val + "]"
            );
            $(this)
                .removeClass("domestic_support_zipcode_" + (index_val - 1))
                .addClass("domestic_support_zipcode_" + index_val);
        });
        $(domestic_support_monthlypay).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_support_monthlypay][" + index_val + "]"
            );
        });
        $(domestic_support_past_due).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_support_past_due][" + index_val + "]"
            );
            $(this)
                .removeClass("domestic_support_past_due_" + (index_val - 1))
                .addClass("domestic_support_past_due_" + index_val);
        });
        $(creditor_state).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[creditor_state][" + index_val + "]"
            );
            $(this)
                .removeClass("creditor_state_" + (index_val - 1))
                .addClass("creditor_state_" + index_val);
        });

        $(domestic_owned_by).each(function () {
            $(this).attr("name", "domestic_tax[owned_by][" + index_val + "]");
        });
        $(domestic_address_state).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_address_state][" + index_val + "]"
            );
            $(this).attr("id", "domesticstate_" + index_val);
            $(this).attr(
                "onchange",
                "getDomesticAddress(this," + index_val + ")"
            );
            $(this)
                .removeClass("domestic_address_state_" + (index_val - 1))
                .addClass("domestic_address_state_" + index_val);
        });

        $(domestic_support_account).each(function () {
            $(this).attr(
                "name",
                "domestic_tax[domestic_support_account][" + index_val + "]"
            );
            $(this)
                .removeClass("domestic_support_account_" + (index_val - 1))
                .addClass("domestic_support_account_" + index_val);
        });

        $(validate_div).each(function () {
            $(validate_div)
                .removeClass("dso_validation_msg_div_" + (index_val - 1))
                .addClass("dso_validation_msg_div_" + index_val);
        });
        $(validate_msg).each(function () {
            var oldInx = index_val - 1;
            $(validate_msg)
                .removeClass("dso_validation_msg_" + oldInx)
                .addClass("dso_validation_msg_" + index_val);
        });
        $(credit_summ).each(function () {
            $(this)
                .removeClass("dso_summary_" + (index_val - 1))
                .addClass("dso_summary_" + index_val);
            $(this)
                .find(".debt_no")
                .html(index_val + 1 + ".");
        });
        $(insider_data).each(function () {
            $(this)
                .removeClass("dso_data_" + (index_val - 1))
                .addClass("dso_data_" + index_val);
            $(this)
                .find(".dso_valid_div")
                .removeClass("dso_validation_msg_div_" + (index_val - 1))
                .addClass("dso_validation_msg_div_" + index_val);
            $(this)
                .find(".dso_valid_msg")
                .removeClass("dso_validation_msg_" + (index_val - 1))
                .addClass("dso_validation_msg_" + index_val);
        });

        $(save_btn_bottom).each(function () {
            $(this).attr("data-saveid", index_val);
            $(this).attr(
                "onclick",
                "saveDSODebt(true,this,true)"
            );
        });
        $(delete_btn_bottom).each(function () {
            $(this).attr("data-saveid", index_val);
            $(this).attr("onclick", "removeDSODebt('" + url + "', this)");
        });

        cln.find("select").val("");
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        $(itm).after(cln);

        $("#domestic_saddress_div_" + index_val).addClass("hide-data");
    }
}

/**
 * Save additional liens
 */
function alSaveTheseDebts(displaymsg = true, thisobj={}, newdiv = false) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_al",displaymsg);
    if(!hasError && !newdiv){
        var cln = $(thisobj).parent('div').parent('div').parent("div").parent("div");
        var debt_creditor_form = cln.find(".additional_liens_form");
        $(debt_creditor_form).each(function () {
            if($(this).find(".common_creditor_summary").hasClass('hide-data')){
                $(this).find(".common_creditor_summary").removeClass('hide-data');
                $(this).find(".add_inside_al").addClass('hide-data');
            }
        });
    }
    return !hasError;
}

/**
 * Add additional liens
 */
function addAdditionalLiensForm(url) {
    var itm = $(document).find(".additional_liens_form").last();
    var saveData = alSaveTheseDebts(true);

    if (saveData == false) {
        return false;
    }

    var clnln = $(document).find(".additional_liens_form").length;
    if (clnln > 4) {
        alert("You can only insert 5 domestic debts.");
        return false;
    } else {
        var itm = $(document).find(".additional_liens_form").last();
        var index_val = $(itm).index() + 1;

        /*Values that need to display under summary */
        var creditorName = $(itm).find(".al_domestic_support_name").val();

        var htmlfile = "";

        htmlfile += "<div class='col-md-5'><div class='row'>";
        htmlfile +=
            "<div class='col-md-12'><strong class='debt_no'>" +
            (index_val + 1) +
            ". </strong><strong>Secure creditor name: </strong><span class='summary-name-" +
            (index_val + 1) +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-12'><strong>Secure creditor address: </strong><span class='summary-address-" +
            (index_val + 1) +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-5'><strong>City: </strong><span class='summary-city-" +
            (index_val + 1) +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-3'><strong>State: </strong><span class='summary-state-" +
            (index_val + 1) +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-4'><strong>Zip: </strong><span class='summary-zip-" +
            (index_val + 1) +
            "'></span></div>";
        htmlfile += "</div></div>";
        htmlfile += "<div class='col-md-7'><div class='row'>";
        htmlfile +=
            "<div class='col-md-6'><strong>Acct.# (Last 4 digits): </strong><span class='summary-acc-no-" +
            (index_val + 1) +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-6'><strong>Amount owned: </strong><span class='summary-owed-" +
            (index_val + 1) +
            " text-danger'>$</span></div>";
        htmlfile +=
            "<div class='col-md-6'><strong>Incurred date: </strong><span class='summary-date-" +
            (index_val + 1) +
            "'></span></div>";
        htmlfile +=
            "<div class='col-md-6'><strong>Monthly Payment: </strong><span class='summary-mpayment-" +
            (index_val + 1) +
            "'>$</span></div>";
        htmlfile += "</div></div>";
        htmlfile +=
            "<div class='col-md-10'></div><div class='col-md-2 text-right mb-2'>";
        htmlfile +=
            "<a href='javascript:void(0)' data-saveid='" +
            (index_val + 1) +
            "' class='label mx-ht btn lightblue-bg text-white f-12' onclick='display_al_debt_div(" +
            (index_val + 1) +
            ")'>Edit</a>";
        htmlfile +=
            "<a href='javascript:void(0)' data-saveid='" +
            (index_val + 1) +
            "' class='label mx-ht text-white delte-icon f-12  bg-red-al' onclick='remove_al_debt_div(" +
            (index_val + 1) +
            ",this);'><i class='fa fa-lg fa-trash'></i></a></div>";

        var cln = $(itm).clone();
        cln.find("label").removeClass("active");
        $(document)
            .find(".al_creditor_summary_" + index_val)
            .removeClass("hide-data");
        $(".add_liens_creditor_" + index_val).addClass("hide-data");
        cln.find(".debt_no").html(index_val + 1 + ".");
        cln.find(".common_creditor_summary").addClass("hide-data");
        cln.find(".add_liens_creditor_" + index_val).removeClass("hide-data");
        cln.find(".al_creditor_summary_" + index_val).html("");
        cln.find(".circle-number-div").html(index_val+1);
        cln.find(".delete-div").attr("data-saveid", (index_val+1)).attr("onclick", "remove_al_debt_div("+(index_val+1)+", this)");
        cln.find(".client-edit-button").attr("data-saveid", (index_val+1)).attr("onclick", "display_al_debt_div(this, "+(index_val+1)+")");
        
        var im_action = cln.find(".im-action");
        var al_valid_msg = cln.find(".al_valid_msg");
        var al_valid_div = cln.find(".al_valid_div");

        var common_creditor_summary = cln.find(".common_creditor_summary");
        var add_inside_al = cln.find(".add_inside_al");
        var domestic_support_name = cln.find(".al_domestic_support_name");
        var domestic_support_address = cln.find(".domestic_support_address");
        var domestic_support_city = cln.find(".domestic_support_city");

        var domestic_support_zipcode = cln.find(".domestic_support_zipcode");
        var additional_liens_due = cln.find(".additional_liens_due");
        var monthly_payment = cln.find(".monthly_payment");
        var additional_liens_account = cln.find(".additional_liens_account");
        var additional_liens_date_unknown = cln.find(
            ".additional_liens_date_unknown"
        );
        var additional_liens_date = cln.find(".additional_liens_date");
        var creditor_state = cln.find(".creditor_state");
        var describe_secure_claim = cln.find(".describe_secure_claim");

        var additionalliens_owned_by = cln.find(".additionalliens_owned_by");
       
        var add_liens_three_months = cln.find(".add_liens_three_months");
        var add_liens_three_months_div = cln.find(
            ".add_liens_three_months_div"
        );
        var payment_1 = cln.find(".payment_1");
        var payment_2 = cln.find(".payment_2");
        var payment_3 = cln.find(".payment_3");
        var payment_dates_1 = cln.find(".payment_dates_1");
        var payment_dates_2 = cln.find(".payment_dates_2");
        var payment_dates_3 = cln.find(".payment_dates_3");
        var total_amount_paid = cln.find(".total_amount_paid");

        var debt_tax_codebtor_creditor_name = cln.find(
            ".debt_tax_codebtor_creditor_name"
        );
        var debt_tax_codebtor_creditor_name_addresss = cln.find(
            ".debt_tax_codebtor_creditor_name_addresss"
        );
        var debt_tax_codebtor_creditor_city = cln.find(
            ".debt_tax_codebtor_creditor_city"
        );
        var debt_tax_codebtor_creditor_state = cln.find(
            ".debt_tax_codebtor_creditor_state"
        );
        var debt_tax_codebtor_creditor_zip = cln.find(
            ".debt_tax_codebtor_creditor_zip"
        );

        var add_liens_remove_div_icon = cln.find(".add_liens_remove_div_icon");
        var nextIndex = index_val + 1;

        $(common_creditor_summary).each(function () {
            $(common_creditor_summary)
                .removeClass("al_creditor_summary_" + index_val)
                .addClass("al_creditor_summary_" + nextIndex);
        });
        $(add_inside_al).each(function () {
            $(add_inside_al)
                .removeClass("add_liens_creditor_" + index_val)
                .addClass("add_liens_creditor_" + nextIndex);
        });
        $(im_action).each(function () {
            $(this).attr("data-saveid", index_val + 1);
        });

        $(al_valid_div).each(function () {
            var oldInx = index_val - 1;
            $(al_valid_div)
                .removeClass("al_validation_msg_div_" + oldInx)
                .addClass("al_validation_msg_div_" + index_val);
        });
        $(al_valid_msg).each(function () {
            var oldInx = index_val - 1;
            $(al_valid_msg)
                .removeClass("al_validation_msg_" + oldInx)
                .addClass("al_validation_msg_" + index_val);
        });
        $(cln).each(function () {
            $(cln)
                .removeClass("addionallines_" + index_val)
                .addClass("addionallines_" + nextIndex);
        });

        $(add_liens_remove_div_icon).each(function () {
            $(this).attr(
                "onclick",
                "remove_additional_debt_div(" + nextIndex + ")"
            );
        });

        $(add_liens_three_months).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[is_add_liens_three_months][" +
                    index_val +
                    "]"
            );
                      
            if ($(this).val() == "1") {                        
                $(this).attr("id", "is_add_liens_three_months_yes_" + index_val);
                $(this).next("label").attr( "for", "is_add_liens_three_months_yes_" + index_val);
                $(this).next("label").attr( "onclick", "isThreeMonthAddLiens('yes', " + index_val + ")" );
            }
            if ($(this).val() == "0") {                
                $(this).attr("id", "is_add_liens_three_months_no_" + index_val);
                $(this).next("label").attr( "for", "is_add_liens_three_months_no_" + index_val);
                $(this).next("label").attr( "onclick", "isThreeMonthAddLiens('no', " + index_val + ")" );
            }

            $(payment_1).each(function () {
                $(this).attr(
                    "name",
                    "additional_liens_data[payment_1][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_2).each(function () {
                $(this).attr(
                    "name",
                    "additional_liens_data[payment_2][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_3).each(function () {
                $(this).attr(
                    "name",
                    "additional_liens_data[payment_3][" + index_val + "]"
                );
                $(this).attr("data-index", index_val);
            });
            $(payment_dates_1).each(function () {
                $(this).attr(
                    "name",
                    "additional_liens_data[payment_dates_1][" + index_val + "]"
                );
            });
            $(payment_dates_2).each(function () {
                $(this).attr(
                    "name",
                    "additional_liens_data[payment_dates_2][" + index_val + "]"
                );
            });
            $(payment_dates_3).each(function () {
                $(this).attr(
                    "name",
                    "additional_liens_data[payment_dates_3][" + index_val + "]"
                );
            });
            $(total_amount_paid).each(function () {
                $(this).attr(
                    "name",
                    "additional_liens_data[total_amount_paid][" +
                        index_val +
                        "]"
                );
            });
        });
        $(add_liens_three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("add_liens_three_months_div_" + prev_index);
            $(this).addClass("add_liens_three_months_div_" + index_val);
        });

        $(debt_tax_codebtor_creditor_name).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[codebtor_creditor_name][" +
                    index_val +
                    "]"
            );
        });

        $(debt_tax_codebtor_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[codebtor_creditor_name_addresss][" +
                    index_val +
                    "]"
            );
        });

        $(debt_tax_codebtor_creditor_city).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[codebtor_creditor_city][" +
                    index_val +
                    "]"
            );
        });

        $(debt_tax_codebtor_creditor_state).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[codebtor_creditor_state][" +
                    index_val +
                    "]"
            );
        });

        $(debt_tax_codebtor_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[codebtor_creditor_zip][" +
                    index_val +
                    "]"
            );
        });

        $(domestic_support_name).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[domestic_support_name][" +
                    index_val +
                    "]"
            );
            $(this)
                .removeClass("al_domestic_support_name_" + index_val)
                .addClass("al_domestic_support_name_" + (index_val + 1));
        });
        $(domestic_support_address).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[domestic_support_address][" +
                    index_val +
                    "]"
            );
            $(this)
                .removeClass("al_domestic_support_address_" + index_val)
                .addClass("al_domestic_support_address_" + (index_val + 1));
        });

        $(domestic_support_zipcode).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[domestic_support_zipcode][" +
                    index_val +
                    "]"
            );
            $(this)
                .removeClass("al_domestic_support_zipcode_" + index_val)
                .addClass("al_domestic_support_zipcode_" + (index_val + 1));
        });

        $(domestic_support_city).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[domestic_support_city][" +
                    index_val +
                    "]"
            );
            $(this)
                .removeClass("al_domestic_support_city_" + index_val)
                .addClass("al_domestic_support_city_" + (index_val + 1));
        });
        $(additional_liens_due).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[additional_liens_due][" + index_val + "]"
            );
            $(this)
                .removeClass("additional_liens_due_" + index_val)
                .addClass("additional_liens_due_" + (index_val + 1));
        });
        $(monthly_payment).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[monthly_payment][" + index_val + "]"
            );
            $(this)
                .removeClass("al_monthly_payment_" + index_val)
                .addClass("al_monthly_payment_" + (index_val + 1));
        });
        $(additional_liens_account).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[additional_liens_account][" +
                    index_val +
                    "]"
            );
            $(this)
                .removeClass("additional_liens_account_" + index_val)
                .addClass("additional_liens_account_" + (index_val + 1));
        });
        $(additional_liens_date).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[additional_liens_date][" +
                    index_val +
                    "]"
            );
            $(this).removeClass("hasDatepicker").attr("id", "");
            $(this)
                .removeClass("additional_liens_date_" + index_val)
                .addClass("additional_liens_date_" + (index_val + 1));
        });
        $(additional_liens_date_unknown).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[additional_liens_date_unknown][" +
                    index_val +
                    "]"
            );
            $(this).attr("onclick", "liensUnknownChecked(" + index_val + ")");
            $(this).attr("id", "additional_liens_date_unknown_" + index_val);
        });
        $(creditor_state).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[creditor_state][" + index_val + "]"
            );
            $(this)
                .removeClass("al_creditor_state_" + index_val)
                .addClass("al_creditor_state_" + (index_val + 1));
        });

        $(additionalliens_owned_by).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[owned_by][" + index_val + "]"
            );            
            let thisRadioId = $(this).attr("id");
            $(this).attr("id", thisRadioId + index_val);
            $(this).next("label").attr("for", thisRadioId + index_val);

        });

        $(describe_secure_claim).each(function () {
            $(this).attr(
                "name",
                "additional_liens_data[describe_secure_claim][" +
                    index_val +
                    "]"
            );
        });
        var ad_lines_add_more = cln.find(".ad_lines_add_more");
                    $(ad_lines_add_more).each(function () {
                        $(this).attr(
                            "onclick",
                            "alSaveTheseDebts(true,this,true)"
                        );
                    });

        cln.find("select").val("");
        cln.find("textarea").val("");
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("input[type=radio]").prop("checked", false);
        $(itm).after(cln);
        initializeDatepicker();
    }
}


// Export functions for backward compatibility
window.getTaxowned = getTaxowned;
window.getAnotherDebts = getAnotherDebts;
window.unknownChecked = unknownChecked;
window.liensUnknownChecked = liensUnknownChecked;
window.isThreeMonthAddLiens = isThreeMonthAddLiens;
window.removeDomesticForm = removeDomesticForm;
window.removeAdditionalLiensForm = removeAdditionalLiensForm;
window.getAddress = getAddress;
window.getDomesticAddress = getDomesticAddress;
window.getirsAddress = getirsAddress;
window.initializeCreditReport = initializeCreditReport;
window.openGraphqlComfirmPopup = openGraphqlComfirmPopup;
window.confirmAllAIPendingToInclude = confirmAllAIPendingToInclude;
window.confirmCreditor = confirmCreditor;
window.opengetReportPopup = opengetReportPopup;
window.videoPreviewFunction = videoPreviewFunction;
window.openFreeReportGuide = openFreeReportGuide;
window.creditReportUploadBtnClick = creditReportUploadBtnClick;
window.creditReportUploadBtnSelect = creditReportUploadBtnSelect;
window.saveBackTaxDebt = saveBackTaxDebt;
window.addbackTaxes = addbackTaxes;
window.saveIRSDebt = saveIRSDebt;
window.saveDSODebt = saveDSODebt;
window.addAnotherDomesticForm = addAnotherDomesticForm;
window.alSaveTheseDebts = alSaveTheseDebts;
window.addAdditionalLiensForm = addAdditionalLiensForm;