/**
 * Tab 3 - Common Debt Utilities
 * Shared functions for all debt steps
 */

// ==================== FORM VALIDATION ====================

/**
 * Initialize form validation for all debt forms
 */
function initializeFormValidation() {
    const debtForms = [
        "client_debts",
        "client_debts_step2_unsecured", 
        "client_debts_step2_back_taxes", 
        "client_debts_step2_irs", 
        'client_debts_step2_dso', 
        'client_debts_step2_al'
    ];

    $.each(debtForms, function(index, value) {
        if ($("#" + value).length) {
            $("#" + value).validate({
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

// ==================== FORM SUBMISSION ====================

/**
 * Submit multiple debt forms with validation
 */
window.submitdebtForms = function(formName, formName2 = '', formName3 = '', formName4 = '') {
    var debtFormName = [formName]
    if (formName2 != '') {
        debtFormName.push(formName2)
    }
    if (formName3 != '') {
        debtFormName.push(formName3)
    }
    if (formName4 != '') {
        debtFormName.push(formName4)
    }
    
    var errorheld = false;
    $.each(debtFormName, function(index, formId) {
        validateFormIds(formId);
        $("#" + formId).validate().form();
        if (!$("#" + formId).valid()) {
            $('html, body').animate({
                scrollTop: ($('.error:visible').offset().top - 60)
            }, 500);
            errorheld = true;
        }
    });
    
    if (errorheld == false) {
        $.each(debtFormName, function(index, formId) {
            $.systemMessage('Saving Debts..', 'alert--process', true);
            setTimeout(function() {
                var formElement = document.getElementById(formId);
                var formData = new FormData(formElement);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $("#" + formId).attr('action'),
                    contentType: false,
                    data: formData,
                    processData: false,
                    type: 'POST',
                    async: false,
                    success: function(data) {
                        if (data.status == 1) {
                            $("#" + data.display_id).html(data.html);
                            $.systemMessage(data.msg, 'alert--success', true);
                            if (data.next_route) {
                                setTimeout(function() {
                                    window.location.href = data.next_route;
                                }, 50);
                            }
                        } else {
                            errorheld = true;
                            $.systemMessage(data.msg, 'alert--danger', true);
                        }
                    }
                });
            }, 50 * index);
        });
    }
};

// ==================== AUTOCOMPLETE FUNCTIONS ====================

/**
 * Initialize autocomplete functionality
 */
function initializeAutocomplete() {
    // Debt creditor name autocomplete
    $(document).on('input', ".debt_creditor_name, .debt_second_creditor_name", function(e) {
        var thisHasClass = $(this).hasClass('second_creditor_name');
        var debtIndex = $(this).data('index');
        var debtType = $(".cards_collections_" + debtIndex + " option:selected").val();
        
        $(this).autocomplete({
            'classes': {
                "ui-autocomplete": "custom-ui-autocomplete"
            },
            'source': function(request, response) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: window.__debtStep2Routes?.masterCreditSearchByCategory || '',
                    data: {
                        keyword: encodeURIComponent(request['term']),
                        debtType: debtType
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(json) {
                        json = json.data;
                        response($.map(json, function(item) {
                            return {
                                label: item['placeholder'],
                                value: item['value'],
                                address: item['address'],
                                city: item['city'],
                                state: item['state'],
                                zip: item['zip'],
                            };
                        }));
                    },
                });
            },
            select: function(event, ui) {
                var specialStrings = ["Mortgage Address", "Auto Loan Address", "Credit Card Address", "Collection Accounts/Other Main Addresses"];
                if (specialStrings.includes(ui.item.label)) {
                    event.preventDefault();
                    return false;
                }
                $(this).val(ui.item.label);
                var n = $(this).attr('name');
                var index = n.slice(-3);
                index = index.replace('[', '');
                index = index.replace(']', '');
                index = parseInt(index);
                if (thisHasClass) {
                    $("input[name='debt_tax[second_creditor_name][" + index + "]']").val(ui.item.label);
                    $("input[name='debt_tax[second_creditor_information][" + index + "]']").val(ui.item.address);
                    $("input[name='debt_tax[second_creditor_city][" + index + "]']").val(ui.item.city);
                    $("select[name='debt_tax[second_creditor_state][" + index + "]']").val(ui.item.state);
                    $("input[name='debt_tax[second_creditor_zip][" + index + "]']").val(ui.item.zip);
                } else {
                    $("input[name='debt_tax[creditor_name][" + index + "]']").val(ui.item.label);
                    $("input[name='debt_tax[creditor_information][" + index + "]']").val(ui.item.address);
                    $("input[name='debt_tax[creditor_city][" + index + "]']").val(ui.item.city);
                    $("select[name='debt_tax[creditor_state][" + index + "]']").val(ui.item.state);
                    $("input[name='debt_tax[creditor_zip][" + index + "]']").val(ui.item.zip);
                }
                setLawsuitTitle(debtType, index, ui.item.value)
            }
        });
        setLawsuitTitle(debtType, debtIndex-1)
    });

    // Additional liens domestic support name autocomplete
    $(document).on('input', ".al_domestic_support_name", function(e) {
        $(this).autocomplete({
            'classes': {
                "ui-autocomplete": "custom-ui-autocomplete"
            },
            'source': function(request, response) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: window.__debtStep2Routes?.masterCreditSearch || '',
                    data: {
                        keyword: encodeURIComponent(request['term'])
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(json) {
                        json = json.data;
                        response($.map(json, function(item) {
                            return {
                                label: item['placeholder'],
                                value: item['value'],
                                address: item['address'],
                                city: item['city'],
                                state: item['state'],
                                zip: item['zip'],
                            };
                        }));
                    },
                });
            },
            select: function(event, ui) {
                $(this).val(ui.item.label);
                var n = $(this).attr('name');
                var index = n.slice(-3);
                index = index.replace('[', '');
                index = index.replace(']', '');
                index = parseInt(index);
                $("input[name='additional_liens_data[domestic_support_name][" + index + "]']").val(ui.item.label);
                $("input[name='additional_liens_data[domestic_support_address][" + index + "]']").val(ui.item.address);
                $("input[name='additional_liens_data[domestic_support_city][" + index + "]']").val(ui.item.city);
                $("select[name='additional_liens_data[creditor_state][" + index + "]']").val(ui.item.state);
                $("input[name='additional_liens_data[domestic_support_zipcode][" + index + "]']").val(ui.item.zip);
            }
        });
    });

    // Domestic support name autocomplete
    $(document).on('input', ".domestic_support_name", function(e) {
        $(this).autocomplete({
            'classes': {
                "ui-autocomplete": "custom-ui-autocomplete"
            },
            'source': function(request, response) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: window.__debtStep2Routes?.masterCreditSearch || '',
                    data: {
                        keyword: encodeURIComponent(request['term'])
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(json) {
                        json = json.data;
                        response($.map(json, function(item) {
                            return {
                                label: item['placeholder'],
                                value: item['value'],
                                address: item['address'],
                                city: item['city'],
                                state: item['state'],
                                zip: item['zip'],
                            };
                        }));
                    },
                });
            },
            select: function(event, ui) {
                $(this).val(ui.item.label);
                var n = $(this).attr('name');
                var index = n.slice(-3);
                index = index.replace('[', '');
                index = index.replace(']', '');
                index = parseInt(index);
                $("input[name='domestic_tax[domestic_support_name][" + index + "]']").val(ui.item.label);
                $("input[name='domestic_tax[domestic_support_address][" + index + "]']").val(ui.item.address);
                $("input[name='domestic_tax[domestic_support_city][" + index + "]']").val(ui.item.city);
                $("select[name='domestic_tax[creditor_state][" + index + "]']").val(ui.item.state);
                $("input[name='domestic_tax[domestic_support_zipcode][" + index + "]']").val(ui.item.zip);
            }
        });
    });

    // Agency location autocomplete
    $(document).on('input', ".agency_location_autocomplete", function(e) {
        $(this).autocomplete({
            'classes': {
                "ui-autocomplete": "custom-ui-autocomplete"
            },
            'source': function(request, response) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: window.__debtStep2Routes?.courthousesSearch || '',
                    data: {
                        keyword: encodeURIComponent(request['term'])
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(json) {
                        json = json.data;
                        response($.map(json, function(item) {
                            return {
                                label: item['placeholder'],
                                value: item['value'],
                                address: item['address'],
                                city: item['city'],
                                state: item['state'],
                                zip: item['zip'],
                            };
                        }));
                    },
                });
            },
            select: function(event, ui) {
                $(this).val(ui.item.label);
                var n = $(this).attr('name');
                var index = n.slice(-3);
                index = index.replace('[', '');
                index = index.replace(']', '');
                index = parseInt(index);
                $("input[name='debt_tax[list_lawsuits_data][agency_location][" + index + "]']").val(ui.item.label);
                $("input[name='debt_tax[list_lawsuits_data][agency_street][" + index + "]']").val(ui.item.address);
                $("input[name='debt_tax[list_lawsuits_data][agency_city][" + index + "]']").val(ui.item.city);
                $("select[name='debt_tax[list_lawsuits_data][agency_state][" + index + "]']").val(ui.item.state);
                $("input[name='debt_tax[list_lawsuits_data][agency_zip][" + index + "]']").val(ui.item.zip);
            }
        });
    });

    // Custom autocomplete widget for highlighting
    $.widget("custom.autocomplete", $.ui.autocomplete, {
        _renderItem: function(ul, item) {
            var specialStrings = ["Mortgage Address", "Auto Loan Address", "Credit Card Address", "Collection Accounts/Other Main Addresses"];
            
            function highlightText(text) {
                specialStrings.forEach(function(specialString) {
                    var regex = new RegExp('(' + specialString + ')', 'gi');
                    text = text.replace(regex, '<strong>$1</strong>');
                });
                return text;
            }
            
            var labelText = highlightText(item.label);
            return $("<li>")
                .append($("<div>").html(labelText))
                .appendTo(ul);
        }
    });
}

// ==================== PAYMENT CALCULATIONS ====================

/**
 * Initialize payment calculations for all debt types
 */
function initializePaymentCalculations() {
    // Payment calculations for regular payments
    $(document).on('input', ".payment_1, .payment_2, .payment_3", function(e) {
        var dataIndex = $(e.target).data('index');
        var dataMainarray = $(e.target).data('mainarray');
        var pay1 = parseFloat($("input[name='" + dataMainarray + "[payment_1][" + dataIndex + "]']").val()) || 0.00;
        var pay2 = parseFloat($("input[name='" + dataMainarray + "[payment_2][" + dataIndex + "]']").val()) || 0.00;
        var pay3 = parseFloat($("input[name='" + dataMainarray + "[payment_3][" + dataIndex + "]']").val()) || 0.00;
        var total = parseFloat(pay1 + pay2 + pay3);
        var convertedValue = parseFloat(total).toFixed(2);

        if (convertedValue < 600) {
            $('.amount_not_saved_' + dataIndex).removeClass('d-none')
        } else {
            $('.amount_not_saved_' + dataIndex).addClass('d-none')
        }

        $("input[name='" + dataMainarray + "[total_amount_paid][" + dataIndex + "]']").val(convertedValue);
    });

    // Payment calculations for IRS payments
    $(document).on('input', ".payment_1_irs, .payment_2_irs, .payment_3_irs", function(e) {
        var pay1 = parseFloat($("input[name='tax_irs[payment_1]']").val()) || 0.00;
        var pay2 = parseFloat($("input[name='tax_irs[payment_2]']").val()) || 0.00;
        var pay3 = parseFloat($("input[name='tax_irs[payment_3]']").val()) || 0.00;
        var total = parseFloat(pay1 + pay2 + pay3);
        var convertedValue = parseFloat(total).toFixed(2);
        $("input[name='tax_irs[total_amount_paid]']").val(convertedValue);
    });
}

// ==================== EVENT HANDLERS ====================

/**
 * Initialize event handlers
 */
function initializeEventHandlers() {
    // License file preview handler
    $("#both-licence").on('change', function(data) {
        var imageFile = data.target.files[0];
        var type = data.target.files[0].type;
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function(evt) {
            $('#both__preview__DL').removeClass('hide_img_preview');
            if (type == 'application/pdf') {
                $('#both-licence-imagePreview').hide();
                $('#pdfboth-licence-imagePreview').attr('src', evt.target.result);
                $('#pdfboth-licence-imagePreview').hide();
                $('#pdfboth-licence-imagePreview').fadeIn(650);
            } else {
                $('#pdfboth-licence-imagePreview').hide();
                $('#both-licence-imagePreview').attr('src', evt.target.result);
                $('#both-licence-imagePreview').hide();
                $('#both-licence-imagePreview').fadeIn(650);
            }
        }
    });

    // Dropdown menu click handler
    $(document).on("click", ".dropdown-menu, .justone-label, .justone-li, .justone-a", function(e) {
        e.stopPropagation();
    });

    // Check input debt handler
    $('input[name="checkinputdebt"]').click(function() {
        if ($(this).prop("checked") == true) {
            $("#second_step_debt_div").removeClass("hide-data");
        } else if ($(this).prop("checked") == false) {
            $("#second_step_debt_div").addClass("hide-data");
        }
    });

    // Run card collection check on page load
    $('.cards_collections').each(function() {
        let selectedVal = $(this).val();
        let index = $(this).attr('name').match(/\[(\d+)\]/)[1];
        if (selectedVal == 6) {
            $('.law_suit_div_' + index).removeClass('hide-data');
        }
    });
}

// ==================== CHECKBOX SELECTION FUNCTIONS ====================

window.setSelectAll = function(thisObj) {
    var inputName = $(thisObj).data('inputname');
    var inputFor = $(thisObj).data('inputfor');
    if ($(thisObj).is(':checked')) {
        $('.option').prop('checked', true);
        $(".select-text").html('Deselect');
    } else {
        $('.option').prop('checked', false);
        $(".select-text").html('Select');
    }
    setSpaceSeperatedString(inputName, inputFor);
};

window.setJustOne = function(thisObj) {
    var inputName = $(thisObj).data('inputname');
    var inputFor = $(thisObj).data('inputfor');

    var a = $("input[type='checkbox'].justone");

    if (a.length == a.filter(":checked").length) {
        $('.selectall').prop('checked', true);
        $(".select-text").html(' Deselect');
    } else {
        $('.selectall').prop('checked', false);
        $(".select-text").html(' Select');
    }
    setSpaceSeperatedString(inputName, inputFor);
};

window.setSpaceSeperatedString = function(inputName, inputFor) {
    var checkedYears = [];
    $("input[type='checkbox'].justone." + inputFor + ":checked").each(function() {
        checkedYears.push($(this).val());
    });
    checkedYears.sort((a, b) => b - a);
    var spaceSeparatedString = checkedYears.join(" ");
    $("input[name='" + inputName + "']").val(spaceSeparatedString);
};

// ==================== UTILITY FUNCTIONS ====================

window.replaceAll = function(str, term, replacement) {
    return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
};

window.escapeRegExp = function(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
};

// ==================== INITIALIZATION ====================

$(function() {
    // Initialize all common functionality
    initializeFormValidation();
    initializePaymentCalculations();
    initializeAutocomplete();
    initializeEventHandlers();
});

// Export functions for backward compatibility
window.initializeFormValidation = initializeFormValidation;
window.initializeAutocomplete = initializeAutocomplete;
window.initializePaymentCalculations = initializePaymentCalculations;
window.initializeEventHandlers = initializeEventHandlers;
window.submitdebtForms = submitdebtForms;
window.setSelectAll = setSelectAll;
window.setJustOne = setJustOne;
window.setSpaceSeperatedString = setSpaceSeperatedString;
window.unknownChecked = unknownChecked;
window.liensUnknownChecked = liensUnknownChecked;
window.getTaxowned = getTaxowned;
window.checkAC = checkAC;
window.getTaxowned_IRS = getTaxowned_IRS;
window.getAnotherDebts = getAnotherDebts;
window.removeDomesticForm = removeDomesticForm;
window.removeAdditionalLiensForm = removeAdditionalLiensForm;
window.getAddress = getAddress;
window.getDomesticAddress = getDomesticAddress;
window.getirsAddress = getirsAddress;
window.isThreeMonthsCommon = isThreeMonthsCommon;
window.isThreeMonthAddLiens = isThreeMonthAddLiens;
window.cardCollectionChanged = cardCollectionChanged;
window.setLawsuitTitle = setLawsuitTitle;
window.openGraphqlComfirmPopup = openGraphqlComfirmPopup;
window.confirmAllAIPendingToInclude = confirmAllAIPendingToInclude;
window.confirmCreditor = confirmCreditor;
window.opengetReportPopup = opengetReportPopup;
window.videoPreviewFunction = videoPreviewFunction;
window.replaceAll = replaceAll;
window.escapeRegExp = escapeRegExp;
window.openFreeReportGuide = openFreeReportGuide;
window.creditReportUploadBtnClick = creditReportUploadBtnClick;
window.creditReportUploadBtnSelect = creditReportUploadBtnSelect;

