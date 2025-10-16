/**
 * Tab 3 - Step 2: Priority Debts
 * Back taxes, IRS, Domestic support, Additional liens
 */

// ==================== TOGGLE FUNCTIONS ====================

/**
 * Toggle back taxes section
 */
window.getTaxowned = function(value) {
    if (value == 'yes') {
        document.getElementById('tax-owned-state').classList.remove("hide-data");
        document.getElementById('tax-owned-state-add-more').classList.remove("hide-data");
        $('.back_tax_note').removeClass('hide-data');
    } else if (value == 'no') {
        document.getElementById('tax-owned-state').classList.add("hide-data");
        document.getElementById('tax-owned-state-add-more').classList.add("hide-data");
        $('.back_tax_note').addClass('hide-data');
    }
};

/**
 * Toggle IRS taxes section
 */
window.getTaxowned_IRS = function(value) {
    if (value == 'yes') {
        // IRS section show logic
    } else if (value == 'no') {
        // IRS section hide logic
    }
};

/**
 * Toggle domestic support debts section
 */
window.getAnotherDebts = function(value) {
    if (value == 'yes') {
        document.getElementById('all_dependents').classList.remove("hide-data");
    } else if (value == 'no') {
        document.getElementById('all_dependents').classList.add("hide-data");
    }
};

// ==================== UNKNOWN CHECKBOX FUNCTIONS ====================

/**
 * Toggle unknown date for back taxes
 */
window.unknownChecked = function(index) {
    if ($("#debt_date_unknown_" + index).is(':checked')) {
        $("input[name='debt_tax[debt_date][" + index + "]']").val('');
        $("input[name='debt_tax[debt_date][" + index + "]']").attr('readonly', 'readonly');
        $("input[name='debt_tax[debt_date][" + index + "]']").removeClass('required');
    } else {
        $("input[name='debt_tax[debt_date][" + index + "]']").val('');
        $("input[name='debt_tax[debt_date][" + index + "]']").removeAttr('readonly');
        $("input[name='debt_tax[debt_date][" + index + "]']").addClass('required');
    }
};

/**
 * Toggle unknown date for additional liens
 */
window.liensUnknownChecked = function(index) {
    if ($("#additional_liens_date_unknown_" + index).is(':checked')) {
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").val('');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").attr('readonly', 'readonly');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").removeClass('required');
    } else {
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").val('');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").removeAttr('readonly');
        $("input[name='additional_liens_data[additional_liens_date][" + index + "]']").addClass('required');
    }
};

// ==================== THREE MONTHS PAYMENT TOGGLE ====================

/**
 * Toggle three months payment section for additional liens
 */
window.isThreeMonthAddLiens = function(selected_value, index) {
    if (selected_value == 'no') {
        $(".add_liens_three_months_div_" + index).addClass("hide-data");
        $(".add_liens_three_months_div_" + index).find(".price-field").each(function() {
            $(this).val("");
        });
    }
    if (selected_value == 'yes') {
        $(".add_liens_three_months_div_" + index).removeClass("hide-data");
    }
};

// ==================== FORM REMOVAL FUNCTIONS ====================

/**
 * Remove domestic support form
 */
window.removeDomesticForm = function(obj) {
    if (obj.parentNode.className == 'row') {
        obj.parentNode.parentNode.removeChild(obj.parentNode);
        counter--;
    }
};

/**
 * Remove additional liens form
 */
window.removeAdditionalLiensForm = function(obj) {
    if (obj.parentNode.className == 'row') {
        obj.parentNode.parentNode.removeChild(obj.parentNode);
        counter--;
    }
};

// ==================== ADDRESS LOOKUP FUNCTIONS ====================

/**
 * Get address for back taxes by state
 */
window.getAddress = function(selectObject, sr) {
    var scode = selectObject.value;
    var ids = selectObject.id;
    var rrs = ids.split('_');
    var addresslist = window.__debtStep2Data?.addressList || [];
    
    $.each(addresslist, function(index, value) {
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
};

/**
 * Get address for domestic support by state
 */
window.getDomesticAddress = function(selectObject, sr) {
    var scode = selectObject.value;
    var ids = selectObject.id;
    var rrs = ids.split('_');
    var domesticaddresslist = window.__debtStep2Data?.domesticAddressList || [];
    
    $.each(domesticaddresslist, function(index, value) {
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
};

/**
 * Get IRS address by state
 */
window.getirsAddress = function(selectObject) {
    var scode = selectObject.value;
    var addresslist = window.__debtStep2Data?.addressList || [];
    
    $.each(addresslist, function(index, value) {
        if (value.code == scode) {
            $("#irs_state_heading").html('<p>' + value.address_heading + '</p>');
            $("#irs_state_desc").html('<p>' + value.add1 + '<br>' + value.add2 + '</p>');
        }
    });
};

// ==================== CREDIT REPORT FUNCTIONS ====================

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
 * Open GraphQL confirm popup
 */
window.openGraphqlComfirmPopup = function() {
    var url = window.__debtStep2Routes?.confirmCreditPopup || '';
    laws.ajax(url, { client_id: 'null' }, function(response) {
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
};

/**
 * Confirm all AI pending to include
 */
window.confirmAllAIPendingToInclude = function(confirm_type='') {
    var url = window.__debtStep2Routes?.confirmCreditReport || '';
    laws.ajax(url, {
        report_id: null,
        client_confirm: null,
        confirm_type: confirm_type
    }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            $.systemMessage(res.msg, 'alert--success', true);
            if(confirm_type != ''){
                window.location.reload();
            }
        }
    });
};

/**
 * Confirm individual creditor
 */
window.confirmCreditor = function(report_id, status) {
    var url = window.__debtStep2Routes?.confirmCreditReport || '';
    laws.ajax(url, {
        report_id: report_id,
        client_confirm: status
    }, function(response) {
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
};

/**
 * Open get report popup
 */
window.opengetReportPopup = function() {
    var url = window.__debtStep2Routes?.openGetReportPopup || '';
    laws.ajax(url, {
        client_id: 'null'
    }, function(response) {
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
};

/**
 * Video preview function for credit report guide
 */
window.videoPreviewFunction = function(element) {
    const language = window.__debtStep2Data?.language || 'en';
    const videoEn = $(element).data('video');
    const videoSp = $(element).data('video2');
    const videoSrc = language === 'en' ? videoEn : videoSp;
    
    $('iframe.rumble').attr('src', videoSrc);
    $('.video-btn-div').addClass('d-none');
    $('.video-preview-div').removeClass('d-none');

    setTimeout(function() {
        $('.report_video_link').css({
            'pointer-events': 'auto',
            'background': ''
        }).addClass('text-bold');
        $('.must_watch_text').addClass('hide-data');
        $('.report_video_link').addClass('text-c-white');
        $('.copy_cc_r').addClass('blink');
        $('.copy_cc_r').addClass('text-c-red');
    }, 40000);
};

/**
 * Open free report guide
 */
window.openFreeReportGuide = function(){
    laws.updateFaceboxContent($('#report_guide_img').html(), 'fbminwidth productQuickView quickinfor');
};

/**
 * Credit report upload button click
 */
window.creditReportUploadBtnClick = function(anchorElement, input_id) {
    if (!$(anchorElement).hasClass('upload-active')) {
        $(anchorElement).addClass('upload-active');
    }

    let fileInput = $('#' + input_id);
    $('#' + input_id).click();

    setTimeout(function() {
        if (!fileInput[0].files.length) {
            $(anchorElement).removeClass('upload-active');
        }
    }, 3000);
};

/**
 * Credit report upload file selected
 */
window.creditReportUploadBtnSelect = function(event, document_type, dataFor) {
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
        success: function(response) {
            if (response.status == 1) {
                $.systemMessage(response.msg, 'alert--success', true);
            }
            if (response.status == 0) {
                $.systemMessage(response.msg, 'alert--danger', true);
            }
        },
        error: function(response) {
            console.log("error", response.status, response.msg);
        }
    });
};

// ==================== INITIALIZATION ====================

$(function() {
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

// Export functions for backward compatibility
window.initializeStep2 = initializeCreditReport;
window.initializeCreditReport = initializeCreditReport;

