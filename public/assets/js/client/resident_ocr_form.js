// Resident OCR Form JavaScript

isCurrentAddress = function(selected_value) {
    if (selected_value == 'yes') {
        $(".new_address_div").addClass("hide-data");
    }
    if (selected_value == 'no') {
        $(".new_address_div").removeClass("hide-data");
    }
}

isMortgageThreeMonth = function(selected_value) {
    if (selected_value == 'no') {
        $(".three_months_div").addClass("hide-data");
    }
    if (selected_value == 'yes') {
        $(".three_months_div").removeClass("hide-data");
    }
}

$(function() {
    $("#dl_autoloan_confirm").validate({
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

    $(".date_month_year").each(function() {
        var value = $(this).val();
        var inputValue = value.replace(/[^0-9]/g, "");
        var formattedValue = formatInputValue(inputValue);
        $(this).val(formattedValue);
    });

    $(".date_month_year").on("input", function() {
        var value = $(this).val();
        var inputValue = value.replace(/[^0-9]/g, "");
        var formattedValue = formatInputValue(inputValue);
        $(this).val(formattedValue);
    });
});

function formatInputValue(inputValue) {
    var formattedValue = "";

    if (inputValue.length >= 2) {
        var month = inputValue.substr(0, 2);
        var year = inputValue.substr(2, 4);
        if (parseInt(month) >= 1 && parseInt(month) <= 12) {
            if (inputValue.length == 2) {
                formattedValue = month + "/";
            } else {
                formattedValue = month + "/" + year;
            }
        } else {
            formattedValue = inputValue.substr(0, 2);
        }
    } else {
        formattedValue = inputValue;
    }

    return formattedValue;
}

submitAjaxForm = function() {
    var form1 = $("#dl_autoloan_confirm");
    var dataString1 = $(form1).serialize();
    $.ajax({
        type: "POST",
        url: window.__residentOcrRoutes.setupScannedResident,
        data: dataString1,
        async: true,
        success: function() {
            // Success callback
        }
    });
}

$(document).on('input', ".ocr_creditor_name", function(e) {
    $(this).autocomplete({
        'classes': {
            "ui-autocomplete": "custom-ui-autocomplete"
        },
        'source': function(request, response) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: window.__residentOcrRoutes.mortgageSearch,
                data: {
                    keyword: encodeURIComponent(request['term'])
                },
                dataType: 'json',
                type: 'post',
                success: function(json) {
                    json = json.data;
                    response($.map(json, function(ritem) {
                        return {
                            label: ritem['placeholder'],
                            value: ritem['value'],
                            address: ritem['address'],
                            city: ritem['city'],
                            state: ritem['state'],
                            zip: ritem['zip'],
                        };
                    }));
                },
            });
        },
        select: function(event, ui) {
            $(this).val(ui.item.label);
            var ani = $(this).attr('name');
            var index = ani.slice(-3);
            index = index.replace('[', '');
            index = index.replace(']', '');
            index = parseInt(index);
            $("#creditor_name").val(ui.item.label);
            $("#creditor_name_addresss").val(ui.item.address);
            $("#creditor_city").val(ui.item.city);
            $("#creditor_state").val(ui.item.state);
            $("#creditor_zip").val(ui.item.zip);
        }
    });
});
