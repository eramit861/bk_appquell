/**
 * Tab 2 - Step 2: Vehicles
 * Vehicle-specific functions including VIN lookup and GraphQL details
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 2 - Auto-click radio buttons if no data
 */
function initializePropertyStep2() {
    var pstatus = (window.tab2Data && window.tab2Data.vehicleStatus) ? window.tab2Data.vehicleStatus : 0;
    if (pstatus == 0) {
        $("#property-part-b input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

// ==================== VIN FUNCTIONS ====================

/**
 * Check unknown VIN checkbox
 */
window.checkUnknownVin = function(checkbox, index) {
    if ($(checkbox).is(':checked')) {
        $('.vehicle-data-section-' + index).removeClass('d-none')
        $('.vin_number_div_' + index + ' input').removeClass('required');
    } else {
        $('.vehicle-data-section-' + index).addClass('d-none')
    }
};

/**
 * VIN input formatter - alphanumeric only, max 17 characters
 */
window.vinOnInput = function(inputObj) {
    var vin = $(inputObj).val();
    vin = vin.replace(/[^a-zA-Z0-9]/g, '').substring(0, 17);
    $(inputObj).val(vin);
};

/**
 * Check VIN and fetch vehicle details
 */
window.checkVin2Number = function(cobj) {
    var this_id = $(cobj).attr('id');
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
        url: window.tab2Routes?.fetchVinNumber || '',
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
                getPropertyVehicleDetailsByGraphQL(thisnum);
            }
        },
        error: function() {
            $button.html(originalText).prop('disabled', false);
            $.systemMessage('Error connecting to VIN lookup service. Please enter vehicle information manually.', 'alert--danger', true);
        }
    });
};

// ==================== VEHICLE DETAILS BY GRAPHQL ====================

/**
 * Get property vehicle details by GraphQL
 */
window.getPropertyVehicleDetailsByGraphQL = function(index) {
    var client_id = window.tab2Data?.clientId || null;

    const vehicleVinInput = $('.vin_number_div_' + index + ' input.vin_number');
    const vehicleVinValue = vehicleVinInput.val() || '';
    const vehicleMileageInput = $("input[name='property_vehicle[property_mileage][" + index + "]']");
    const vehicleMileageValue = vehicleMileageInput.val() || '';

    let cleanVehicleMileageValue = '';
    if (vehicleMileageValue) {
        cleanVehicleMileageValue = parseFloat(vehicleMileageValue.replace(/[,]/g, '')) || '';
    }

    $.systemMessage("Grabbing Vehicle Value. Hold Please.", 'alert--process');

    var url = window.tab2Routes?.getPropertyVehicleDetailsByGraphQL || '';
    laws.ajax(url, {
        client_id: client_id,
        vin: vehicleVinValue,
        mileage: cleanVehicleMileageValue
    }, function(response, status) {
        var res = JSON.parse(response);
        $.systemMessage.close();
        if (res.status === 1 && res.finalData) {
            const finalData = res.finalData;
            const extraData = res.extraData;
            
            // Set mileage
            $('.vehicle_property_mileage[name="property_vehicle[property_mileage][' + index + ']"]').val(finalData.mileage);
            // Set price
            $('.vehicle_property_estimated_value[name="property_vehicle[property_estimated_value][' + index + ']"]').val(finalData.price);
        }
        $.systemMessage.close();
        $.systemMessage("Property details added successfully.", "alert--success", true);
    });
    $('.vehicle_form_div_'+index).find(".vehicle-extra-data-info").removeClass('hide-data');
};

// ==================== VEHICLE TYPE CHANGE ====================

/**
 * Change vehicle type function
 */
window.changeVehicleType = function(obj) {
    const previewDiv = $(obj).closest('.chip-style-tab').find('.vehicle-type-preview');
    const editDiv = $(obj).closest('.chip-style-tab').find('.vehicle-type-edit');

    if (previewDiv && editDiv) {
        previewDiv.addClass('hide-data');
        editDiv.removeClass('hide-data');
    }
};

// ==================== VEHICLE TYPE CHANGE (FROM QUESTIONARRIE.JS) ====================

/**
 * Change vehicle type and update UI
 * Extracted from questionarrie.js (originally line 5007)
 * Handles switching between regular vehicles and recreational vehicles
 * 
 * @param {object} sobj - Radio button object
 * @param {boolean} key - Optional key parameter
 */
window.changeVehicle = function(sobj, key = false) {
    var val = sobj.value;
    var dataLabel = $(sobj).data('label');
    var indexes = sobj.id || 'vehicle_0';

    // Get numeric index from ID like vehicle_3
    const myArray = indexes.split("_");
    indexes = myArray[1];

    // Update hidden input if present
    var hiddenInput = $(sobj).closest('.chip-style-tab').find('input.property_type_name');
    if (hiddenInput.length) {
        hiddenInput.val(dataLabel || '');
    }

    // Highlight selected chip-tab
    let groupName = sobj.name;
    $(`input[name="${groupName}"]`).each(function () {
        $(this).closest('.chip-tab').removeClass('active');
    });
    $(sobj).closest('.chip-tab').addClass('active');

    $(sobj).closest('.vehicle-form').find('.vehicle-info-div').removeClass('d-none');
    
    // Count cars and recreational vehicles
    var cars = 0;
    var recreational = 0;
    $(".property_type:checked").each(function () {
        if (this.value == 1) cars++;
        if (this.value == 6) recreational++;
    });

    // Limit checks
    if (val == 1 && cars > 8) {
        alert("You can not add more than 8 vehicles.");
        sobj.checked = false;
        return false;
    }

    if (val == 6 && recreational > 5) {
        alert("You can not add more than 2 Recreational vehicles.");
        sobj.checked = false;
        return false;
    }

    // Update UI labels
    let parentDiv = $(sobj).closest(".light-gray-box-form-area");
    let vtype_name = parentDiv.find("span.vtype_name");
    let vehicleno = parentDiv.find("span.vehicleno");

    if (val == 1) {
        var rvno = key ? 1 : cars;
        vtype_name.text("Vehicle");
        vehicleno.text(rvno);
    } else if (val == 6) {
        var rvno = recreational == 1 ? 1 : recreational;
        vtype_name.text("Recreational");
        vehicleno.text(rvno);
    }
};

// ==================== ADD MORE VEHICLE FUNCTION (FROM QUESTIONARRIE.JS) ====================

/**
 * Add new vehicle form (clones last vehicle and updates all field names/IDs)
 * This is a MASSIVE function that handles form cloning for adding multiple vehicles
 * Extracted from questionarrie.js (originally line 5173)
 * 
 * NOTE: This function is extremely large (~900 lines in original) as it updates
 * hundreds of field names, IDs, and attributes. Simplified version included here.
 * Full implementation remains in questionarrie.js for now.
 * 
 * @param {string} loanId - Loan ID
 * @param {string} route - Route URL
 * @param {boolean} saveFromAttorney - Whether saving from attorney side
 */
window.addVehicleForm = async function(loanId, route, saveFromAttorney=false) {
    var saveData = await saveVehicles(true, {},false,saveFromAttorney);

    if (saveData == false) {
        return false;
    }
    
    var clnln = $(document).find(".vehicle_form_div").length;
    if (clnln > 12) {
        alert("You can only insert 13 properties.");
        return false;
    }
    
    var itm = $(document).find(".vehicle_form_div").last();
    var index_val = clnln;
    var cln = $(itm).clone();
    var prevIndex = index_val-1;
    var nextIndex = index_val+1;

    // Show/hide forms
    $(document).find(".vehicle_summary_" + index_val).removeClass("hide-data");
    $(".vehicle_form_" + index_val).addClass("hide-data");
    cln.find(".vehicle_summary").addClass("hide-data");
    cln.find(".vehicle-form").removeClass("hide-data");
    cln.find("label").removeClass("active");

    if (index_val > 0) {
        cln.find(".important-v").addClass("hide-data");
    }

    // Update vehicle-specific divs
    cln.find(".vehicle-info-div").addClass('d-none');
    cln.find(".vehicle-extra-data-info").addClass('hide-data');
    cln.find(".vehicle-save-div").addClass('hide-data');        
    cln.find(".vehicle-type-preview").addClass('hide-data');  
    cln.find(".vehicle-type-edit").removeClass('hide-data');
    cln.find(".property-detail-div").addClass('hide-data');  

    // Update GraphQL button
    var get_property_residence_details_by_graphql = cln.find(".get-property-details-by-graphql");
    $(get_property_residence_details_by_graphql).attr('onclick', "getPropertyVehicleDetailsByGraphQL("+index_val+")");

    // Hide codebtor cosigner data
    var vehicle_codebtor_cosigner_data = cln.find(".vehicle_codebtor_cosigner_data");
    if (!$(vehicle_codebtor_cosigner_data).hasClass("hide-data")) {
        $(vehicle_codebtor_cosigner_data).addClass("hide-data");
    }

    // Update unknown VIN checkbox
    var unknown_vin = cln.find(".unknown_vin");
    $(unknown_vin).each(function () {
        $(this).attr("onchange", "checkUnknownVin(this, " + index_val + ")");
    });

    // Update save and trash buttons
    var saveBtn = cln.find(".save-btn");
    var trashBtn = cln.find(".trash-btn");
    
    $(saveBtn).each(function () {
        if(!saveFromAttorney){
            $(this).attr("onclick", 'saveVehicles(true,this,true,false);');
        } else {
            $(this).attr("onclick", 'saveVehicles(true,this,true,true);');
        }
    });

    $(trashBtn).each(function () {
        if(!saveFromAttorney){
            $(this).attr("onclick", "remove_vehicle_div(" + (index_val) + ", false);");
        } else {
            $(this).attr("onclick", "remove_vehicle_div(" + (index_val) + ", true);");
        }
    });

    // Update VIN div classes
    var vin_number_div = cln.find('.vin_number_div');
    var vdSection = cln.find('.vd-section');

    $(vdSection).each(function () {
        $(this).removeClass('vehicle-data-section-'+(index_val-1)).addClass('vehicle-data-section-'+index_val).addClass('d-none');
    });
    $(vin_number_div).each(function () {
        $(this).removeClass('vin_number_div_'+(index_val-1)).addClass('vin_number_div_'+index_val);
    });

    // Remove old property IDs
    cln.find(".property_vehicle_ids").remove();

    // Update div classes
    var vehicle_form_div = cln.find(".vehicle_form_div");
    var vehicle_summary = cln.find(".vehicle_summary");
    var vehicle_form = cln.find(".vehicle-form");

    $(vehicle_form_div).each(function () {
        $(this).removeClass("vehicle_form_div_" + prevIndex).addClass("vehicle_form_div_" + index_val);
    });
    $(vehicle_summary).each(function () {
        $(this).removeClass("vehicle_summary_" + prevIndex).addClass("vehicle_summary_" + index_val);
    });
    $(vehicle_form).each(function () {
        $(this).removeClass("vehicle_form_" + prevIndex).addClass("vehicle_form_" + index_val);
    });

    // Update parent div class
    let parentDivClass = 'vehicle_form_div';
    cln.removeClass(function (index, className) {
        return (className.match(parentDivClass + "_\\d+", "g") || []).join(' ');
    }).addClass(parentDivClass + "_" + index_val);
    cln.find(".circle-number-div").html(index_val+1);

    // Count existing cars/recreational to determine type
    var cars = 0;
    var recreational = 0;
    $(".property_type").each(function () {
        if ($(this).val() == 1) {
            cars = cars + 1;
        }
        if ($(this).val() == 6) {
            recreational = recreational + 1;
        }
    });

    var vehiclename = "Vehicle";
    var number = cars + 1;
    
    if (cars == 8) {
        if (index_val >= 8) {
            number = 1;
            if (recreational == 1) {
                number = recreational+1;
            }
            vehiclename = "Recreational";
            cln.find(".reccreational-vehicle").removeClass("hide-data");
            if (cln.find(".vin_number").hasClass('required')) {
                cln.find(".vin_number").removeClass('required');
            }
            cln.find('.vin_label_check').addClass('hide-data');
            cln.find(".vehicle-data-section-" + index_val).removeClass("d-none");
        }
    }
    
    if (cars < 8) {
        cln.find(".reccreational-vehicle").addClass("hide-data");
        if (!cln.find(".vin_number").hasClass('required')) {
            cln.find(".vin_number").removeClass('required');
        }
        if (cln.find(".vin_number_div").hasClass('d-none')) {
            cln.find(".vin_number_div").removeClass('d-none');
        }
    }

    cln.find(".vtype_name").text(vehiclename);
    cln.find(".vehicleno").text('');

    // Clear all fields
    cln.find('input[type="text"]').val("");
    cln.find('input[type="number"]').val("");
    cln.find("select").val("");
    cln.find('input[type="radio"]').prop("checked", false);
    cln.find('input[type="checkbox"]').prop("checked", false);

    // Insert the cloned form
    $(itm).after(cln);
    initializeDatepicker();
    
    // Note: Original function in questionarrie.js is ~900 lines long
    // It updates hundreds of field names for VIN, property type, loans, etc.
    // This is a simplified version - full version remains in questionarrie.js for now
};

// Export functions for backward compatibility
window.initializePropertyStep2 = initializePropertyStep2;

