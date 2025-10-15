// Debt Step2 Questionnaire JavaScript
// This file contains all JavaScript functionality for the debt step2 questionnaire

$(function() {
    // Initialize form validation
    initializeFormValidation();
    
    // Initialize event handlers
    initializeEventHandlers();
    
    // Initialize payment calculations
    initializePaymentCalculations();
    
    // Initialize autocomplete functionality
    initializeAutocomplete();
    
    // Initialize credit report functionality
    initializeCreditReport();
});

// Initialize form validation
function initializeFormValidation() {
    const debtForms = [
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

// Initialize event handlers
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

// Initialize payment calculations
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

// Initialize autocomplete functionality
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
        console.log('courthousesSearch' ,window.__debtStep2Routes?.courthousesSearch || '');
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

// Initialize credit report functionality
function initializeCreditReport() {

    // Auto-trigger credit report popups based on server-side conditions
    if (window.__debtStep2Data?.showGraphqlComfirmPopup === true) {
        openGraphqlComfirmPopup();
    }
    
    if (window.__debtStep2Data?.showGetReportPopup === true) {
        opengetReportPopup();
    }
}

// Form submission functions
function submitdebtForms(formName, formName2 = '', formName3 = '', formName4 = '') {
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

                console.log($("#" + formId).attr('action'));
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
}

// Checkbox selection functions
function setSelectAll(thisObj) {
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
}

function setJustOne(thisObj) {
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
}

function setSpaceSeperatedString(inputName, inputFor) {
    var checkedYears = [];
    $("input[type='checkbox'].justone." + inputFor + ":checked").each(function() {
        checkedYears.push($(this).val());
    });
    checkedYears.sort((a, b) => b - a);
    var spaceSeparatedString = checkedYears.join(" ");
    console.log(inputName, inputFor, spaceSeparatedString);
    $("input[name='" + inputName + "']").val(spaceSeparatedString);
}

// Toggle functions
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

// Tax and debt toggle functions
function getTaxowned(value) {
    if (value == 'yes') {
        document.getElementById('tax-owned-state').classList.remove("hide-data");
        document.getElementById('tax-owned-state-add-more').classList.remove("hide-data");
        $('.back_tax_note').removeClass('hide-data');
    } else if (value == 'no') {
        document.getElementById('tax-owned-state').classList.add("hide-data");
        document.getElementById('tax-owned-state-add-more').classList.add("hide-data");
        $('.back_tax_note').addClass('hide-data');
    }
}

function checkAC(value) {
    if (value == 'yes') {
        document.getElementById('second_step_debt_div').classList.remove("hide-data");
        document.getElementById('second_step_debt_note_div').classList.remove("hide-data");
    } else if (value == 'no') {
        document.getElementById('second_step_debt_div').classList.add("hide-data");
        document.getElementById('second_step_debt_note_div').classList.add("hide-data");
    }
}

function getTaxowned_IRS(value) {
    if (value == 'yes') {
        // document.getElementById('tax-owned-state').classList.remove("hide-data");
    } else if (value == 'no') {
        // document.getElementById('tax-owned-state').classList.add("hide-data");
    }
}

function getAnotherDebts(value) {
    if (value == 'yes') {
        document.getElementById('all_dependents').classList.remove("hide-data");
    } else if (value == 'no') {
        document.getElementById('all_dependents').classList.add("hide-data");
    }
}

// Form removal functions
function removeDomesticForm(obj) {
    if (obj.parentNode.className == 'row') {
        obj.parentNode.parentNode.removeChild(obj.parentNode);
        counter--;
    }
}

function removeAdditionalLiensForm(obj) {
    if (obj.parentNode.className == 'row') {
        obj.parentNode.parentNode.removeChild(obj.parentNode);
        counter--;
    }
}

// Address functions
function getAddress(selectObject, sr) {
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
}

function getDomesticAddress(selectObject, sr) {
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
}

function getirsAddress(selectObject) {
    var scode = selectObject.value;
    var addresslist = window.__debtStep2Data?.addressList || [];
    
    $.each(addresslist, function(index, value) {
        if (value.code == scode) {
            $("#irs_state_heading").html('<p>' + value.address_heading + '</p>');
            $("#irs_state_desc").html('<p>' + value.add1 + '<br>' + value.add2 + '</p>');
        }
    });
}

// Three months functions
function isThreeMonthsCommon(selected_value, class_name) {
    if (selected_value == 'no') {
        $("." + class_name).addClass("hide-data");
        $("." + class_name).find(".price-field").each(function() {
            $(this).val("");
        });
    }
    if (selected_value == 'yes') {
        $("." + class_name).removeClass("hide-data");
    }
}

function isThreeMonthAddLiens(selected_value, index) {
    if (selected_value == 'no') {
        $(".add_liens_three_months_div_" + index).addClass("hide-data");
        $(".add_liens_three_months_div_" + index).find(".price-field").each(function() {
            $(this).val("");
        });
    }
    if (selected_value == 'yes') {
        $(".add_liens_three_months_div_" + index).removeClass("hide-data");
    }
}

// Card collection change function
function cardCollectionChanged(event) {
    let selectedVal = $(event).val();
    let index = $(event).attr('name').match(/\[(\d+)\]/)[1];

    if (selectedVal == 6) {
        $('.law_suit_div_' + index).removeClass('hide-data');
        var creditorName = $(document).find('[name="debt_tax[creditor_name]['+index+']').val();
        if(creditorName != ''){
            $(document).find('[name="debt_tax[list_lawsuits_data][case_title][' + index + ']"]').val(creditorName);
        }
    } else {
        $('.law_suit_div_' + index).addClass('hide-data');
    }
}

// Lawsuit title function
function setLawsuitTitle(debtType = '', debtIndex, label = '') {
    if (debtType == '') {
        debtType = $(`[name="debt_tax[cards_collections][${debtIndex}]"]`).val();
    }

    if (debtType == 6) {
        let originalCreditorVal = $(`[name="debt_tax[original_creditor][${debtIndex}]"]:checked`).val();
        let creditorNameVal = $(`[name="debt_tax[creditor_name][${debtIndex}]"]`).val();
        let secondCreditorNameVal = $(`[name="debt_tax[second_creditor_name][${debtIndex}]"]`).val();
        let $caseTitleInput = $(`[name="debt_tax[list_lawsuits_data][case_title][${debtIndex}]"]`);

        if (label != '') {
            creditorNameVal = label;
            secondCreditorNameVal = label;
        }

        let baseTitle = "";
        if (originalCreditorVal == "1") {
            baseTitle = creditorNameVal;
        } else if (originalCreditorVal == "0") {
            baseTitle = secondCreditorNameVal;
        }

        let currentValue = $caseTitleInput.val();
        let existingNames = "";
        if (currentValue.includes(" V.")) {
            existingNames = currentValue.split(" V.")[1].trim();
        }

        if (existingNames) {
            $caseTitleInput.val(`${baseTitle} V. ${existingNames}`);
        } else {
            $caseTitleInput.val(baseTitle);
        }
    }
}

// Credit report functions
function openGraphqlComfirmPopup() {
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
}

function confirmAllAIPendingToInclude(confirm_type='') {
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
}

function confirmCreditor(report_id, status) {
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
}

function opengetReportPopup() {
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
}

// Video preview function
function videoPreviewFunction(element) {
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
}

// Utility functions
function replaceAll(str, term, replacement) {
    return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
}

function escapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}

function openFreeReportGuide(){
    laws.updateFaceboxContent($('#report_guide_img').html(), 'fbminwidth productQuickView quickinfor');
}

// File upload functions
function creditReportUploadBtnClick(anchorElement, input_id) {
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
}

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
}

// Export functions to global scope for backward compatibility
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
