// Property OCR Form JavaScript

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
});

propertyVehicleImport = function(propertyIndex, vehiclename) {
    if (!confirm('Are you sure you want to import this creditor to ' + vehiclename + '?')) {
        $("input[type=radio]").prop("checked", false);
        return;
    }
    var ocr_id = window.__propertyOcrData.ocrId;
    var url = window.__propertyOcrRoutes.importScheduleDVehicle;
    laws.ajax(url, {
        ocr_id: ocr_id
    }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            $.systemMessage(res.msg, 'alert--success', true);
            $.facebox.close();
        }
    });
}

function checkVinNumber(cobj) {
    var vin_number = $("#v_vin_number").val();
    if (vin_number == '') {
        alert("VIN Number is required");
        return false;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: window.__propertyOcrRoutes.fetchVinNumber,
        data: {
            vin_number: vin_number
        },
        dataType: 'json',
        type: 'post',
        success: function(res) {
            if (res.status == false) {
                alert(res.message);
            } else {
                $("#vehicle_year").val(res.data.year);
                $("#vehicle_make").val(res.data.make);
                $("#vehicle_model").val(res.data.model);
                $("#vehicle_style").val(res.data.trim);
            }
        },
    });
}

$(document).on('input', "#loan_company", function(e) {
    $(this).autocomplete({
        'classes': {
            "ui-autocomplete": "custom-ui-autocomplete"
        },
        'source': function(request, response) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: window.__propertyOcrRoutes.loanCompanySearch,
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
            var n = $(this).attr('name');
            var index = n.slice(-3);
            index = index.replace('[', '');
            index = index.replace(']', '');
            index = parseInt(index);
            $("#loan_company").val(ui.item.label);
            $("#address").val(ui.item.address);
            $("#city").val(ui.item.city);
            $("#state").val(ui.item.state);
            $("#zip").val(ui.item.zip);
        }
    });
});
