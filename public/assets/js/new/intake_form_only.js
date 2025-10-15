$(document).on('keyup', ".price-field", function (event) {
    var inputValue = $(this).val();
    var dotCount = inputValue.split('.').length - 1;
    if (dotCount >= 2) {
        if (inputValue.endsWith('.')) {
            // Remove the last character (dot) from the input value
            inputValue = inputValue.slice(0, -1);

            // Update the input field with the modified value
            $(this).val(inputValue);
        }
        return;
    }

    var kCd = event.keyCode || event.which;
    if (kCd == 0 || kCd == 229) { //for android chrome keycode fix
        kCd = getKeyCode(this.value);
    }
    charCode = kCd;
    if (event.target.value.length >= 15) {
        var firstseven = event.target.value.substring(0, 15);
        event.target.value = firstseven;
    }

    if (charCode == 9) {
        return;
    }
    if (charCode == 46 || (charCode >= 48 && charCode <= 57) || (charCode >= 96 && charCode <= 105) || charCode == 188 || charCode == 190 || charCode == 37 || charCode == 39 || charCode == 8 || charCode == 110) {
        $(this).val(function (index, value) {

            value = value.replace(/,/g, '');
            // Limit to two digits after the dot
            var dotIndex = value.indexOf('.');
            if (dotIndex !== -1 && value.length - dotIndex > 2) {
                value = value.slice(0, dotIndex + 3);
            }
            //return value;
            return numberWithCommas(value);
        });
    } else {
        event.target.value = '';
    }
});

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

var getKeyCode = function (str) {
    return str.charCodeAt(str.length - 1);
}

// VIN Number Input Handler - Limits to 17 alphanumeric characters
function vinOnInput(inputObj) {
    var vin = $(inputObj).val();
    vin = vin.replace(/[^a-zA-Z0-9]/g, '').substring(0, 17);
    $(inputObj).val(vin);
}

// Unknown VIN Checkbox Handler
function checkUnknownVin(checkbox, index) {
    if ($(checkbox).is(':checked')) {
        $('.vehicle-data-section-' + index).removeClass('d-none')
        $('.vin_number_div_' + index + ' input').removeClass('required');
    } else {
        $('.vehicle-data-section-' + index).addClass('d-none')
    }
}

// Auto Import Vehicle Info from VIN
function checkVin2Number(cobj) {
    var fetchUrl = $(cobj).data('fetch-url');
    var this_id = $(cobj).attr('id');
    var propertyFetchUrl = $(cobj).data('property-fetch-url');
    var intakeFormID = $(cobj).data('intake-form-id');
    var attri = this_id.split('_');
    var thisnum = attri[2];
    const vehicleVinInput = $("input[name='property_vehicle[vin_number][" + thisnum + "]']");
    const vehicleVinValue = vehicleVinInput.val() || '';
    const vehicleMileageInput = $("input[name='property_vehicle[property_mileage][" + thisnum + "]']");
    const vehicleMileageValue = vehicleMileageInput.val() || '';

    if (!vehicleVinValue.trim()) {
        $.systemMessage("Kindly enter your vehicle Vin number before accessing the property details.", 'alert--danger', true);
        vehicleVinInput.focus();
        return;
    }

    if (vehicleVinValue.length !== 17) {
        $.systemMessage("Invalid VIN Number. VIN Number must be 17 characters long.", 'alert--danger', true);
        vehicleVinInput.focus();
        return;
    }

    let cleanVehicleMileageValue = '';
    if (vehicleMileageValue) {
        cleanVehicleMileageValue = parseFloat(vehicleMileageValue.replace(/[,]/g, '')) || '';
    }

    if (cleanVehicleMileageValue == '') {
        $.systemMessage("Kindly enter your vehicle mileage before accessing the property details.", 'alert--danger', true);
        vehicleMileageInput.focus();
        return;
    }

    // Show loading state
    var $button = $(cobj);
    var originalText = $button.html();
    $button.html('<i class="bi bi-hourglass-split"></i> Loading...').prop('disabled', true);

    $.systemMessage("Grabbing Vehicle Details. Hold Please.", 'alert--process');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: fetchUrl,
        data: {
            vin_number: vehicleVinValue
        },
        dataType: 'json',
        type: 'post',
        success: function(json) {
            $button.html(originalText).prop('disabled', false);
            if (json.status == false) {
                $.systemMessage.close();
                $.systemMessage(json.message, 'alert--danger', true);
                vehicleVinInput.focus();
                $(".unknown_vin.unknown_vin_" + thisnum).attr('checked', false);
                $(".vehicle-data-section-" + thisnum).addClass('d-none');
            } else {
                $(".unknown_vin.unknown_vin_" + thisnum).attr('checked', true);
                $(".vehicle-data-section-" + thisnum).removeClass('d-none');
                $("input[name='property_vehicle[property_year][" + thisnum + "]']").val(json.data.year);
                $("input[name='property_vehicle[property_make][" + thisnum + "]']").val(json.data.make);
                $("input[name='property_vehicle[property_model][" + thisnum + "]']").val(json.data.model);
                $("input[name='property_vehicle[property_other_info][" + thisnum + "]']").val(json.data.trim);
                $.systemMessage.close();
                getPropertyVehicleDetailsByGraphQL(thisnum, intakeFormID, propertyFetchUrl);
            }
        },
        error: function() {
            $button.html(originalText).prop('disabled', false);
            $.systemMessage.close();
            $.systemMessage('Error connecting to VIN lookup service. Please enter vehicle information manually.', 'alert--danger', true);
        }
    });
}

// Get Property Vehicle Details by GraphQL
function getPropertyVehicleDetailsByGraphQL(index, intakeFormID, propertyFetchUrl) {
    var client_id = intakeFormID || null;

    const vehicleVinInput = $('.vin_number_div_' + index + ' input.vin_number');
    const vehicleVinValue = vehicleVinInput.val() || '';
    const vehicleMileageInput = $("input[name='property_vehicle[property_mileage][" + index + "]']");
    const vehicleMileageValue = vehicleMileageInput.val() || '';

    let cleanVehicleMileageValue = '';
    if (vehicleMileageValue) {
        cleanVehicleMileageValue = parseFloat(vehicleMileageValue.replace(/[,]/g, '')) || '';
    }

    $.systemMessage("Grabbing Vehicle Value. Hold Please.", 'alert--process');
    var url = propertyFetchUrl || '';
    laws.ajax(url, {
        client_id: client_id,
        vin: vehicleVinValue,
        mileage: cleanVehicleMileageValue
    }, function(response) {
        var res = JSON.parse(response);
        $.systemMessage.close();
        if (res.status === 1 && res.finalData) {
            const finalData = res.finalData;
            const extraData = res.extraData;
            // set mileage
            $('.property_mileage[name="property_vehicle[property_mileage][' + index + ']"]').val(finalData.mileage);
            // set price
            $('.property_estimated_value[name="property_vehicle[property_estimated_value][' + index + ']"]').val(finalData.price);
   
           /* if(extraData){
                 downloadJson(extraData);
            }	*/
        }
        $.systemMessage.close();
        $.systemMessage("Property details added successfully.", "alert--success", true);
    });
    $('.vehicle_form_div_'+index).find(".vehicle-extra-data-info").removeClass('hide-data');
}

// Vehicle Intake Form - Chip Style Tab Handler
function changeVehicleIntake(radioElement, index) {
    var $radio = $(radioElement);
    var dataLabel = $radio.attr('data-label');
    var val = $radio.val();
    var $row = $radio.closest('.single-vehicle-form');
    
    // Update the hidden property_type_name field
    $row.find('.property_type_name').val(dataLabel);
    
    // Remove active class from all chip-tabs in this row
    $row.find('.chip-tab').removeClass('active');
    
    // Add active class to the clicked label
    $radio.closest('.chip-tab').addClass('active');
    
    // Show vehicle detail section when a type is selected
    $row.find('.vehicle-detail-section').removeClass('hide-data');
    
    // Count totals across all forms
    var cars = 0;
    var recreational = 0;
    
    $('.property_type').each(function() {
        if ($(this).is(':checked')) {
            if ($(this).val() == '1') {
                cars++;
            } else if ($(this).val() == '6') {
                recreational++;
            }
        }
    });
    
    // Enforce limits
    if (val == '1' && cars > 4) {
        $.systemMessage('You can not add more than 4 vehicles.', 'alert--danger', true);
        $radio.prop('checked', false);
        $radio.closest('.chip-tab').removeClass('active');
        // Hide detail section again if selection failed
        $row.find('.vehicle-detail-section').addClass('hide-data');
        return false;
    }
    
    if (val == '6' && recreational > 2) {
        $.systemMessage('You can not add more than 2 Recreational vehicles.', 'alert--danger', true);
        $radio.prop('checked', false);
        $radio.closest('.chip-tab').removeClass('active');
        // Hide detail section again if selection failed
        $row.find('.vehicle-detail-section').addClass('hide-data');
        return false;
    }
    
    // Update header labels
    if (val == '1') {
        $row.find('.vtype_name').first().text('Vehicle');
        $row.find('.vehicleno').first().text(cars);
    }
    if (val == '6') {
        $row.find('.vtype_name').first().text('Recreational');
        $row.find('.vehicleno').first().text(recreational);
    }
}