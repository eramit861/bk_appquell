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
function checkUnknownVin(checkbox, index) {
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
function vinOnInput(inputObj) {
    var vin = $(inputObj).val();
    vin = vin.replace(/[^a-zA-Z0-9]/g, '').substring(0, 17);
    $(inputObj).val(vin);
};

/**
 * Check VIN and fetch vehicle details
 */
function checkVin2Number(cobj) {
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
function getPropertyVehicleDetailsByGraphQL(index) {
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
function changeVehicleType(obj) {
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
function changeVehicle(sobj, key = false) {
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
async function addVehicleForm(loanId, route, saveFromAttorney=false) {
    var saveData = await saveVehicles(true, {},false,saveFromAttorney);

    if (saveData == false) {
        return false;
    }
    var clnln = $(document).find(".vehicle_form_div").length;
    if (clnln > 12) {
        alert("You can only insert 13 properties.");
        return false;
    } else {
        var itm = $(document).find(".vehicle_form_div").last();
        var index_val = clnln;
        var cln = $(itm).clone();
        prevIndex = index_val-1;
        nextIndex = index_val+1;

        $(document)
            .find(".vehicle_summary_" + index_val)
            .removeClass("hide-data");
        $(".vehicle_form_" + index_val).addClass("hide-data");
        cln.find(".vehicle_summary").addClass("hide-data");
        cln.find(".vehicle-form").removeClass("hide-data");

       

        cln.find("label").removeClass("active");

        if (index_val > 0) {
            cln.find(".important-v").addClass("hide-data");
        }
        var mainrow0 = cln.find(".main-row-0");
        var getOwnTypeProperty_obj_data = cln.find(
            ".getOwnTypeProperty_obj_data"
        );
        var own_any_property = cln.find(".own_any_property");
        var own_by_property = cln.find(".own_by_property");

        var vehicle_property_type = cln.find(".property_type");
        var vehicle_property_year = cln.find(".vehicle_property_year");
        var vehicle_property_make = cln.find(".vehicle_property_make");
        var vehicle_property_model = cln.find(".vehicle_property_model");
        var vehicle_property_mileage = cln.find(".vehicle_property_mileage");
        var vehicle_property_other_info = cln.find(
            ".vehicle_property_other_info"
        );
        var vehicle_property_estimated_value = cln.find(
            ".vehicle_property_estimated_value"
        );
        //car loan section
        var loan_own_type_property = cln.find(".loan_own_type_property");
        var vehicle_amount_own = cln.find(".vehicle_amount_own");
        var vehicle_account_number = cln.find(".vehicle_account_number");
        var vehicle_debt_incurred_date = cln.find(
            ".vehicle_debt_incurred_date"
        );
        var vehicle_creditor_name_addresss = cln.find(
            ".vehicle_creditor_name_addresss"
        );
        var vehicle_creditor_name = cln.find(".vehicle_creditor_name");
        var vehicle_creditor_city = cln.find(".vehicle_creditor_city");
        var vehicle_creditor_state = cln.find(".vehicle_creditor_state");
        var vehicle_creditor_zip = cln.find(".vehicle_creditor_zip");

        var codebtor_vehicle_creditor_name = cln.find(
            ".cosigner_vehicle_creditor_name"
        );
        var codebtor_vehicle_creditor_name_addresss = cln.find(
            ".cosigner_vehicle_creditor_name_addresss"
        );
        var codebtor_vehicle_creditor_city = cln.find(
            ".cosigner_vehicle_creditor_city"
        );
        var codebtor_vehicle_creditor_state = cln.find(
            ".cosigner_vehicle_creditor_state"
        );
        var codebtor_vehicle_creditor_zip = cln.find(
            ".cosigner_vehicle_creditor_zip"
        );

        var is_vehicle_three_months = cln.find(".is_vehicle_three_months");
        var vehicle_three_months_div = cln.find(".vehicle_three_months_div");
        var payment_1 = cln.find(".payment_1");
        var payment_2 = cln.find(".payment_2");
        var payment_3 = cln.find(".payment_3");
        var payment_dates_1 = cln.find(".payment_dates_1");
        var payment_dates_2 = cln.find(".payment_dates_2");
        var payment_dates_3 = cln.find(".payment_dates_3");
        var total_amount_paid = cln.find(".total_amount_paid");

        var vehicle_monthly_payment = cln.find(".vehicle_monthly_payment");
        var vehicle_payment_remaining = cln.find(".vehicle_payment_remaining");
        var vehicle_debt_owned_by = cln.find(".vehicle_debt_owned_by");
        var vehicle_codebtor = cln.find(".vehicle_codebtor");
        var vehicle_codebtor_info = cln.find(".vehicle_codebtor_info");
        var vin_number = cln.find(".vin_number");
        var link_vin = cln.find(".link_vin");
        var retain_above_property = cln.find(".retain_above_property");
        var past_due_amount = cln.find(".past_due_amount");
        var saveBtn = cln.find(".save-btn");
        var trashBtn = cln.find(".trash-btn");
        var cals = cln.find(".cals");
        var ols = cln.find(".ols");

        var vehicle_form_div = cln.find(".vehicle_form_div");
        var vehicle_summary = cln.find(".vehicle_summary");
        var vehicle_form = cln.find(".vehicle-form");
        var unknown_vin = cln.find(".unknown_vin");
        var chip_tab = cln.find(".chip-tab");
        cln.find(".vehicle-info-div").addClass('d-none');
        cln.find(".vehicle-extra-data-info").addClass('hide-data');
        cln.find(".vehicle-save-div").addClass('hide-data');        
        cln.find(".vehicle-type-preview").addClass('hide-data');  
        cln.find(".vehicle-type-edit").removeClass('hide-data');
        cln.find(".property-detail-div").addClass('hide-data');  

        var get_property_residence_details_by_graphql = cln.find(".get-property-details-by-graphql");

        $(get_property_residence_details_by_graphql).attr('onclick', "getPropertyVehicleDetailsByGraphQL("+index_val+")");

        var vehicle_codebtor_cosigner_data = cln.find(".vehicle_codebtor_cosigner_data");
        if (!$(vehicle_codebtor_cosigner_data).hasClass("hide-data")) {
            $(vehicle_codebtor_cosigner_data).addClass("hide-data");
        }        
        
         $(unknown_vin).each(function () {
            $(this).attr("onchange", "checkUnknownVin(this, " + index_val + ")");
        });

        $(saveBtn).each(function () {
            if(!saveFromAttorney){
                $(this).attr(
                    "onclick",
                    'saveVehicles(true,this,true,false);'
                );
            } else {
                $(this).attr(
                    "onclick",
                    'saveVehicles(true,this,true,true);'
                );
            }
        });

        $(trashBtn).each(function () {
            if(!saveFromAttorney){
                $(this).attr(
                    "onclick",
                    "remove_vehicle_div(" + (index_val) + ", false);"
                );
            } else {
                $(this).attr(
                    "onclick",
                    "remove_vehicle_div(" + (index_val) + ", true);"
                );
            }
        });

        var vin_number_div = cln.find('.vin_number_div');
        var vdSection = cln.find('.vd-section');

        $(vdSection).each(function () {
            $(this).removeClass('vehicle-data-section-'+(index_val-1)).addClass('vehicle-data-section-'+index_val).addClass('d-none');
        });
        $(vin_number_div).each(function () {
            $(this).removeClass('vin_number_div_'+(index_val-1)).addClass('vin_number_div_'+index_val);
        });

        //work only update case
        cln.find(".property_vehicle_ids").remove();
    
        $(vehicle_form_div).each(function () {
            $(this).removeClass("vehicle_form_div_" + prevIndex)
                .addClass("vehicle_form_div_" + index_val);
                
        });

        $(vehicle_summary).each(function () {
            $(this).removeClass("vehicle_summary_" + prevIndex)
                .addClass("vehicle_summary_" + index_val);
        });
        $(vehicle_form).each(function () {
            $(this).removeClass("vehicle_form_" + prevIndex)
                .addClass("vehicle_form_" + index_val);
        });
       

        var uploadd = cln.find(".nav-link");
        $(uploadd).each(function () {
            $(this).attr(
                "title",
                "Current_Auto_Loan_Statement_" + (index_val + 1)
            );
        });

        var ouploadd = cln.find(".o-nav-link");
        $(ouploadd).each(function () {
            $(this).attr("title", "Other_Loan_Statement_" + (index_val + 1));
        });
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
                var vehiclename = "Recreational";
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
                cln.find(".vin_label_check")
            }
        }

        cln.find(".vtype_name").text(vehiclename);
        cln.find(".vehicleno").text('');

        let parentDivClass = 'vehicle_form_div';
        cln.removeClass(function (index, className) {
            return (className.match(parentDivClass + "_\\d+", "g") || []).join(' ');
        }).addClass(parentDivClass + "_" + index_val);
        cln.find(".circle-number-div").html(index_val+1);
        
        cln.find(".doc-card").text(
            "Current Auto Loan Statement " + (index_val + 1)
        );

        cln.find(".o-doc-card").text("Other Loan Statement " + (index_val + 1));

        $(mainrow0).each(function () {
            $(this).attr("class", "row main-row-" + index_val);
        });

        $(getOwnTypeProperty_obj_data).each(function () {
            $(this).addClass("hide-data");
            $(this).closest(".initial").addClass("additional");
        });

        $(own_any_property).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_vehicle[own_any_property][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(own_by_property).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_vehicle[own_by_property][" + index_val + "]"
            );
            if ($(this).val() == "1") {
                $(this).attr("id", "owned_by_vehicle_you_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "owned_by_vehicle_spouse_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "owned_by_vehicle_joint_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "owned_by_vehicle_other_" + index_val);
            }
            $(this).next("label").attr("for", $(this).attr("id"));
            $(this).prop("checked", false);
           
        });
        $(retain_above_property).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_vehicle[retain_above_property][" + index_val + "]"
            );
            if ($(this).val() == "1") {
                $(this).attr("id", "retain_above_property_yes_" + index_val);
            }
            if ($(this).val() == "0") {
                $(this).attr("id", "retain_above_property_no_" + index_val);
            }
          
            $(this).next("label").attr("for", $(this).attr("id"));
            
            $(this).prop("checked", false);
        });

        $(vin_number).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vin_number][" + index_val + "]"
            );
            $(this).attr("id", "vin_" + index_val);
            $(this).attr("id", "link_vin_" + index_val);
        });
        $(vin_number).each(function () {
            $(this).addClass( "required");
           
        });
        $(link_vin).each(function () {
            $(this).attr("id", "link_vin_" + index_val);
        });

        $(codebtor_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[codebtor_creditor_name][" + index_val + "]"
            );
        });

        $(codebtor_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[codebtor_creditor_name_addresss][" +
                    index_val +
                    "]"
            );
        });

        $(codebtor_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[codebtor_creditor_city][" + index_val + "]"
            );
        });

        $(codebtor_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[codebtor_creditor_state][" + index_val + "]"
            );
        });

        $(codebtor_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[codebtor_creditor_zip][" + index_val + "]"
            );
        });

        $(is_vehicle_three_months).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][is_vehicle_three_months][" +
                    index_val +
                    "]"
            );
            if ($(this).val() == "1") {
                $(this).attr("id", "is_vehicle_three_months_yes_" + index_val);
                $(this).next('label').attr( "onclick", "isThreeMonthsCommon('yes','vehicle_three_months_div_" + index_val + "'); isThreeMonthVehicle('yes'," + index_val + ")" );
            }
            if ($(this).val() == "0") {
                $(this).attr("id", "is_vehicle_three_months_no_" + index_val);
                $(this).next('label').attr( "onclick", "isThreeMonthsCommon('no','vehicle_three_months_div_" + index_val + "'); isThreeMonthVehicle('no'," + index_val + ")" );
            }
           
          
            $(this).next("label").attr("for", $(this).attr("id"));
            $(this).prop("checked", false);
        });

        $(payment_1).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][payment_1][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(payment_2).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][payment_2][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(payment_3).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][payment_3][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(payment_dates_1).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][payment_dates_1][" +
                    index_val +
                    "]"
            );
        });
        $(payment_dates_2).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][payment_dates_2][" +
                    index_val +
                    "]"
            );
        });
        $(payment_dates_3).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][payment_dates_3][" +
                    index_val +
                    "]"
            );
        });
        $(total_amount_paid).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][total_amount_paid][" +
                    index_val +
                    "]"
            );
        });

        $(vehicle_three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("vehicle_three_months_div_" + prev_index);
            $(this).addClass("vehicle_three_months_div_" + index_val);
            $(this).addClass("hide-data");
        });

        $(chip_tab).each(function () {
            $(this).removeClass('active');
        });


        $(vehicle_property_type).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_type][" + index_val + "]"
            );
            $(this).removeAttr('checked');
        });

       

        $(vehicle_property_year).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_year][" + index_val + "]"
            );
        });
        $(vehicle_property_make).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_make][" + index_val + "]"
            );
        });
        $(vehicle_property_model).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_model][" + index_val + "]"
            );
        });
        $(vehicle_property_mileage).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_mileage][" + index_val + "]"
            );
        });
        $(vehicle_property_other_info).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_other_info][" + index_val + "]"
            );
        });
        $(vehicle_property_estimated_value).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_estimated_value][" + index_val + "]"
            );
        });
        //car loan
        $(vehicle_amount_own).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][amount_own][" +
                    index_val +
                    "]"
            );
        });
        $(past_due_amount).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][past_due_amount][" +
                    index_val +
                    "]"
            );
        });

        $(vehicle_account_number).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][account_number][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_debt_incurred_date).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][debt_incurred_date][" +
                    index_val +
                    "]"
            );
            $(this).removeClass("hasDatepicker").attr("id", "");
        });
        $(vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][creditor_name][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][creditor_name_addresss][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][creditor_city][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][creditor_state][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][creditor_zip][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][monthly_payment][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_payment_remaining).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][payment_remaining][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_debt_owned_by).each(function () {

            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][debt_owned_by][" +
                    index_val +
                    "]"
            );

            if ($(this).val() == "1") {
                $(this).attr("id", "who_owes_the_debt_you_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "who_owes_the_debt_spouse_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "who_owes_the_debt_joint_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "who_owes_the_debt_other_" + index_val);
            }
            if ($(this).val() == "5") {
                $(this).attr("id", "who_owes_the_debt_possessory_" + index_val);
            }
            $(this).next("label").attr("for", $(this).attr("id"));
            $(this).attr("checked", false);

        });
        $(vehicle_codebtor).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][codebtor][" +
                    index_val +
                    "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(vehicle_codebtor_info).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[vehicle_car_loan][codebtor_info][" +
                    index_val +
                    "]"
            );
        });

        $(loan_own_type_property).each(function () {
            var checkboxValue = $(this).val();
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_vehicle[loan_own_type_property][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));

            $(this).prop("checked", false);
        });
        
        var property_type_name = cln.find(".property_type_name");
        $(property_type_name).each(function () {
            $(this).attr(
                "name",
                "property_vehicle[property_type_name][" +
                    index_val +
                    "]"
            );
        });
        var selectedo = 1;
        if (cars == 8) {
            selectedo = 6;
        }

        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val(selectedo);
        cln.find("textarea").val("");
        // $(
        //     'select[name="property_vehicle[property_type][' + index_val + '"]'
        // ).val("");
       
        $(itm).after(cln);
        // resetVehicleno(cln,index_val);
        initializeDatepicker();
        setTimeout(function () {
            getOwnTypeProperty_obj("yes", this, 1, loanId, route);            
        }, 50);
    }
}

// ==================== EVENT HANDLERS ====================

/**
 * Mileage Field Formatting (with commas)
 * Auto-formats vehicle mileage as user types
 */
$(document).on("keyup", ".mileage_field", function (e) {
    var charCode = e.which ? e.which : e.keyCode;
    if (
        charCode > 31 &&
        charCode != 35 &&
        charCode != 36 &&
        charCode != 190 &&
        charCode != 37 &&
        charCode != 38 &&
        charCode != 39 &&
        charCode != 40 &&
        (charCode < 48 || (charCode > 57 && charCode < 96 && charCode > 105))
    )
        e.target.value = "";
    if (e.target.value < 0) {
        e.target.value = "";
        return;
    }

    var cursorPosition = this.selectionStart;
    var oldLength = e.target.value.length;

    var count = 2;
    if (e.target.value.indexOf(".") == -1 && e.keyCode != 8) {
        if (e.target.value.length >= 7) {
            e.target.value = window.numberFormatField(e.target.value);
        }
        return;
    }

    if (
        e.target.value.length - e.target.value.indexOf(".") > count &&
        e.keyCode != 8
    ) {
        if (e.target.value.length >= 7) {
            var firstseven = e.target.value.substring(0, 10);
            e.target.value = window.numberFormatField(firstseven);
        } else {
            e.target.value = window.numberFormatField(e.target.value);
        }
    }

    var newLength = e.target.value.length;
    cursorPosition += newLength - oldLength;
    this.setSelectionRange(cursorPosition, cursorPosition);
});

$(document).on("blur", ".mileage_field", function (evt) {
    evt.target.value = window.numberFormatField(evt.target.value);
});

// Initialize existing mileage fields on page load
$(".mileage_field").each(function () {
    let formattedNumber = window.numberFormatField($(this).val());
    $(this).val(formattedNumber);
});

// ==================== VEHICLE UTILITY FUNCTIONS ====================

/**
 * Reset vehicle numbering
 */
function resetVehicleno(){
    var cars = 0;
    var recreational = 0;
    $(".property_type").each(function () {
        if ($(this).val() == 1) {
            cars = cars + 1;
            $(this).parent('div').find('.vehicleno').text('');
            
        }
        if ($(this).val() == 6) {
            recreational = recreational + 1;
            $(this).parent('div').find('.vehicleno').text('');
        }
    });
    
}

/**
 * Switch to auto-fill VIN mode
 */
function autoFillVin(){
    $(".vd-section").each(function() {
        if(!$(this).hasClass('d-none')){
            $(this).parent('div').parent('div').find('.vin_number').addClass('required');
            $(this).addClass('d-none');
        }
    });
    $(".vin_number").focus();
    $.facebox.close();
}

/**
 * Switch to manual VIN entry mode
 */
function manauallyFillVin(){
    $(".vd-section").each(function() {
        if($(this).hasClass('d-none')){
            $(this).parent('div').parent('div').find('.vin_number').removeClass('required');
            $(this).removeClass('d-none');
        }
    });
    $.facebox.close();
}

/**
 * Count vehicles by type
 * @param {string} vtype - Vehicle type ('1' for car, '6' for recreational)
 * @returns {number} Count of vehicles
 */
function getVehicleFormDropdown(vtype) {
    var totalVehicleAllowed = 0;
    jQuery(document)
        .find(".vehicle-drop-down")
        .each(function () {
            var selectedvalue = jQuery(this).val();
            if (selectedvalue === vtype) {
                totalVehicleAllowed = totalVehicleAllowed + parseInt(1);
            }
        });

    return totalVehicleAllowed;
}

/**
 * Validate vehicle count and navigate if valid
 * @param {string} url - URL to navigate to
 * @param {boolean} saveFromAttorney - Whether saving from attorney side
 */
function checkVehicleSelection(url, saveFromAttorney=false) {
    var totalVehicleAllowed = getVehicleFormDropdown("1");
    var totalRecreationalAllowed = getVehicleFormDropdown("6");
    
    if (totalVehicleAllowed > "8") {
        alert("You can only insert 8 vehicle properties.");
    } else if (totalRecreationalAllowed > "5") {
        alert("You can only insert 5 Recreational properties.");
    } else {
        var form_id = "property_step2_modal_save";
        if(!saveFromAttorney){
            form_id = "client_property_step2";
        }
        hasError = revalidateFormWithMonthYear(form_id,true,saveFromAttorney,true);
        if(!hasError && !saveFromAttorney){
            window.location.href = url;
        }
    }
}

/**
 * Save vehicles and toggle form/summary view
 * @param {boolean} displaymsg - Whether to display message
 * @param {object} thisobj - Button object that triggered save
 * @param {boolean} newdiv - Whether this is a new div
 * @param {number} saveFromAttorney - 0 or 1
 * @returns {boolean} Success status
 */
async function saveVehicles(displaymsg=false, thisobj={},newdiv=false, saveFromAttorney=0){
    const canEdit = await is_editable('can_edit_property');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }
    var form_id = "property_step2_modal_save";
    if(!saveFromAttorney){
        form_id = "client_property_step2";
    }
    
    hasError = revalidateFormWithMonthYear(form_id,displaymsg);
    if(!hasError && !newdiv){
        var cln = $(thisobj).parent('div').parent('div').parent("div").parent("div");
        var vehicle_form_div = cln.find(".vehicle_form_div");
        $(vehicle_form_div).each(function () {
           if($(this).find(".vehicle_summary").hasClass('hide-data')){
                $(this).find(".vehicle_summary").removeClass('hide-data');
                $(this).find(".vehicle-form").addClass('hide-data');
            }
        });
    }
    return !hasError;
}

// ==================== VEHICLE FORM TOGGLE FUNCTIONS ====================

/**
 * Remove vehicle form
 * @param {number} row_class - Vehicle index
 * @param {number} saveFromAttorney - 0 or 1
 */
async function remove_vehicle_div(row_class, saveFromAttorney=0){
    var cloneLength = $(document).find(".vehicle_form_div").length;
    const canEdit = await is_editable('can_edit_property');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }

    
   // var confirmation = confirm("Do you want to remove this vehicle?");
    showConfirmation("Do you want to remove this vehicle?", function(confirmation) {
    if (confirmation) {
        if(cloneLength ==1){
            $('input[name="do_you_own_vehicle"][value="0"]').prop('checked', true);
                $('label[for^="own_type_property_no_"]').addClass('active');
                $('label[for^="own_type_property_yes_"]').removeClass('active');
            $("#vehicle_page_listing_div").remove();
           
        }
        $("#vehicle_listing_html").find(".vehicle_form_" + row_class).remove();
        saveVehicles(true, {},false,saveFromAttorney);
    }
});
}

/**
 * Display vehicle edit form (show edit, hide summary)
 * @param {number} index - Vehicle index
 * @param {boolean} saveFromAttorney - Whether saving from attorney side
 */
function display_vehicle_div(index,saveFromAttorney=false) {
    var hasError = false;
    $(".vehicle-form").each(function (index) {
        if(!$(this).hasClass('hide-data')){
            var form_id = "property_step2_modal_save";
            if(!saveFromAttorney){
                form_id = "client_property_step2";
            }
            hasError = revalidateFormWithMonthYear(form_id,true,saveFromAttorney);
            if(hasError){
                return false;
            }
        }
    });
    if(!hasError){
        $(".vehicle_form_" + index).removeClass("hide-data");
        $(".vehicle_summary_" + index).addClass("hide-data");
    }
}

// Export functions for backward compatibility
window.initializePropertyStep2 = initializePropertyStep2;
window.checkUnknownVin = checkUnknownVin;
window.vinOnInput = vinOnInput;
window.checkVin2Number = checkVin2Number;
window.getPropertyVehicleDetailsByGraphQL = getPropertyVehicleDetailsByGraphQL;
window.changeVehicleType = changeVehicleType;
window.changeVehicle = changeVehicle;
window.addVehicleForm = addVehicleForm;
window.resetVehicleno = resetVehicleno;
window.autoFillVin = autoFillVin;
window.manauallyFillVin = manauallyFillVin;
window.getVehicleFormDropdown = getVehicleFormDropdown;
window.checkVehicleSelection = checkVehicleSelection;
window.saveVehicles = saveVehicles;
window.remove_vehicle_div = remove_vehicle_div;
window.display_vehicle_div = display_vehicle_div;
