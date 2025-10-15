document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input');

    function updateActiveClass() {
        document.querySelectorAll('.btn-toggle').forEach(label => {
            label.classList.remove('active');
        });

        radios.forEach(radio => {
            if (radio.checked) {
                const label = document.querySelector(`label[for="${radio.id}"]`);
                if (label) {
                    label.classList.add('active');
                }
            }
        });
    }

    radios.forEach(radio => {
        radio.addEventListener('change', updateActiveClass);
    });

    updateActiveClass();

    const addMoreBtn = document.getElementById('add-more-btn');
    if (addMoreBtn) {
        addMoreBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const radios = document.querySelectorAll('input');

            function updateActiveClass() {
                document.querySelectorAll('.btn-toggle').forEach(label => {
                    label.classList.remove('active');
                });

                radios.forEach(radio => {
                    if (radio.checked) {
                        const label = document.querySelector(`label[for="${radio.id}"]`);
                        if (label) {
                            label.classList.add('active');
                        }
                    }
                });
            }

            radios.forEach(radio => {
                radio.addEventListener('change', updateActiveClass);
            });


            updateActiveClass();
        });
    }

    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        todayHighlight: true
    });

});

function intakeFormCheckboxClick(labelEl) {
    const $label = $(labelEl);
    const $checkbox = $label.find('input[type="checkbox"]');

    // toggle the checkbox state manually
    $checkbox.prop('checked', !$checkbox.prop('checked'));

    // update active class
    if ($checkbox.prop('checked')) {
        $label.addClass("active");
    } else {
        $label.removeClass("active");
    }
}

function otherClicked( labelEl, sectionID ) {
    setTimeout(function () {
        const $label = $(labelEl);

        if ($label.hasClass('active')) {
            $('.'+sectionID).removeClass("hide-data");
        } else {
            $('.'+sectionID).addClass("hide-data");
        }
    }, 100); 
}


// run once on page load in case option 14 is pre-checked
document.addEventListener("DOMContentLoaded", function () {
    const otherCheckbox = document.querySelector('input[name="emergency_check[14]"]');
    const notesSection = document.getElementById("emergency_notes_section");

    if(notesSection) {
        if (otherCheckbox && otherCheckbox.checked) {
            notesSection.classList.remove("hide-data");
        } else {
            notesSection.classList.add("hide-data");
        }
    }
});

function initFormValidation() {
    const $form = $("#one_page_questionnaire");

    if (!$form.data('validator')) {
        $form.validate({
            ignore: ':hidden:not([type=radio]), .hide-data :hidden',
            errorPlacement: function (error, element) {
                const $formGroup = element.closest('.form-group');

                if (element.attr("type") === "radio") {
                    // Highlight related .btn-toggle labels
                    $(`input[name="${element.attr('name')}"]`).each(function () {
                        $(`label[for="${this.id}"]`).addClass('error-radio');
                    });

                    // Place error label after the form group (as you wanted earlier)
                    if ($formGroup.next('label.error').length === 0) {
                        $formGroup.after(error);
                    }
                } else {
                    $formGroup.append(error);
                }
            },

            success: function (label, element) {
                const $formGroup = $(element).closest('.form-group');

                if ($(element).attr('type') === 'radio') {
                    $formGroup.next('label.error').remove();

                    // Remove .error from related .btn-toggle labels
                    $(`input[name="${$(element).attr('name')}"]`).each(function () {
                        $(`label[for="${this.id}"]`).removeClass('error-radio');
                    });
                } else {
                    $formGroup.find('label.error').remove(); // remove inside form-group
                }
            },

            highlight: function (element) {
                const $el = $(element);
                const $formGroup = $el.closest('.form-group');

                if ($el.attr('type') === 'radio') {
                    $(`input[name="${$el.attr('name')}"]`).addClass('error');
                } else {
                    $el.addClass('error');
                }

                $formGroup.addClass('has-error');
            },

            unhighlight: function (element) {
                const $el = $(element);
                const $formGroup = $el.closest('.form-group');

                if ($el.attr('type') === 'radio') {
                    $(`input[name="${$el.attr('name')}"]`).removeClass('error');
                } else {
                    $el.removeClass('error');
                }

                $formGroup.removeClass('has-error');
            },

            focusInvalid: true,

            invalidHandler: function (form, validator) {
                if (validator.numberOfInvalids()) {
                    const firstErrorElement = $(validator.errorList[0].element);
                    $('html, body').animate({
                        scrollTop: firstErrorElement.offset().top - 100
                    }, 500, function () {
                        firstErrorElement.focus();
                    });
                }
            }
        });
    }

    return $form.valid();
}




function showConfirmation(message, callback) {
    // Create custom modal HTML
    const modalHtml = `
            <div id="customConfirm" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;justify-content:center;align-items:center;">
                <div style="background:white;padding:20px;border-radius:5px;max-width:80%;">
                    <p>${message}</p>
                    <div style="display:flex;justify-content:space-around;margin-top:20px;">
                        <button id="confirmYes" class="btn-new-ui-default ms-auto me-2">Yes</button>
                        <button id="confirmNo" class="btn-new-ui-default me-auto ms-2">No</button>
                    </div>
                </div>
            </div>
        `;

    // Add to body
    $('body').append(modalHtml);

    // Handle clicks
    $('#confirmYes').on('click', function () {
        $('#customConfirm').remove();
        callback(true);
    });

    $('#confirmNo').on('click', function () {
        $('#customConfirm').remove();
        callback(false);
    });
}

$(document).on('input', ".allow-5digit", function (e) {
    var firstFive = this.value.substring(0, 5);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if ((e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
    if (this.value.length > 5) {
        this.value = firstFive;
    }
});

$(document).on("input", ".is_ssn", function (evt) {

    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    self.val(self.val().replace(/(\d{3})\-?(\d{2})\-?(\d{4})/, '$1-$2-$3'));
    var first10 = $(this).val().substring(0, 11);
    if (this.value.length > 11) {
        this.value = first10;
    }

});

function checkYear(str, max) {
    if (str.charAt(0) !== '0' || str == '00') {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = CurrentYear;
        str = num > parseInt(max.toString().charAt(0)) && num.toString().length == CurrentYear ? '0' + num : num
            .toString();
    };
    return str;
};

function checkValue(str, max) {
    if (str.charAt(0) !== '0' || str == '00') {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = 1;
        str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
    };
    return str;
};

$(document).ready(function () {

    $(document).on("blur", '.input_capitalize', function () {
        let value = $(this).val();
        let capitalizedValue = value.replace(/\b\w/g, function (char) {
            return char.toUpperCase();
        });
        $(this).val(capitalizedValue);
    });

    // timer js
    // Set the target time 2 hours from now
    var targetTime = new Date().getTime() + (2 * 60 * 60 * 1000);

    // Update the timer every second
    var timerInterval = setInterval(function () {
        // Get the current time
        var currentTime = new Date().getTime();

        // Calculate the remaining time
        var remainingTime = targetTime - currentTime;

        // Check if the timer has reached 0
        if (remainingTime <= 0) {
            clearInterval(timerInterval);
            $('.hours').text('00');
            $('.minutes').text('00');
            $('.seconds').text('00');
            // You can perform any action here when the timer reaches 0
        } else {
            // Convert remaining time to hours, minutes, and seconds
            var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);


            var finalhours = ('0' + hours).slice(-2)
            var finalminutes = ('0' + minutes).slice(-2)
            var finalseconds = ('0' + seconds).slice(-2)

            $('.hours').text(finalhours);
            $('.minutes').text(finalminutes);
            $('.seconds').text(finalseconds);
            // Format the time as HH:MM:SS
            // var formattedTime =  + 'H:' +  + 'MM:' + +'S';

            // $('#countdown').text(formattedTime);
        }
    }, 1000);


    $("input.date_filed").bind("paste", function (e) { //also changed the binding too
        e.preventDefault();
    });
    $("input.date_filed_mm_yyyy").bind("paste", function (e) { //also changed the binding too
        e.preventDefault();
    });
});

$(document).on('input', ".date_filed", function (e) {

    this.type = 'text';
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split('/').map(function (v) {
        return v.replace(/\D/g, '')
    });
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1]) values[1] = checkValue(values[1], 31);
    var output = values.map(function (v, i) {
        return v.length == 2 && i < 2 ? v + '/' : v;
    });
    this.value = output.join('').substr(0, 10);
});

$(document).on('input', ".date_filed_mm_yyyy", function (e) {
    this.type = 'text';
    var input = this.value;
    input = input.replace(/\D/g, '').substr(0, 6);
    var values = input.match(/(\d{1,2})?(\d{1,4})?/).slice(1);
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1] && values[1].length > 4) values[1] = values[1].substr(0, 4);
    this.value = values.map(function (v, i) {
        return v && i === 0 ? v + '/' : v;
    }).join('').substr(0, 7);
});

$(document).on('blur', ".date_filed", function (e) {

    this.type = 'text';
    var input = this.value;
    var values = input.split('/').map(function (v, i) {
        return v.replace(/\D/g, '')
    });
    var output = '';

    if (values.length == 3) {
        var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
        var month = parseInt(values[0]) - 1;
        var day = parseInt(values[1]);
        var d = new Date(year, month, day);
        if (!isNaN(d)) {
            var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
            output = dates.map(function (v) {
                v = v.toString();
                return v.length == 1 ? '0' + v : v;
            }).join('/');
        };
    };
    this.value = output;
});

$(document).on('blur', ".date_filed_mm_yyyy", function (e) {
    this.type = 'text';
    var input = this.value;
    var values = input.split('/').map(function (v, i) {
        return v.replace(/\D/g, '');
    });
    var output = '';

    if (values.length === 2) {
        var month = parseInt(values[0]) - 1; // Subtract 1 to match JavaScript month numbering (0-11).
        var year = parseInt(values[1]);
        if (!isNaN(month) && !isNaN(year)) {
            // Create a new Date object with the month and year.
            var d = new Date(year, month);
            if (!isNaN(d)) {
                // Format the date as "MM/YYYY."
                output = (d.getMonth() + 1).toString().padStart(2, '0') + '/' + d.getFullYear();
            }
        }
    }
    this.value = output;
});

$(document).ready(function () {

    updateD2InfoClasses = function (msValue) {
        if (msValue == "0" || msValue == "3" || msValue == "4") {
            $(".d2_info").addClass("hide-data");
            $(".d2_info").addClass("hide-data");

            $(".d2_info .summary-div").removeClass("hide-data");
            $(".d2_info .edit-div").addClass("hide-data");
            $(".d2_info .intake-edit-div a.edit").removeClass("hide-data");

        }
        if (msValue == "1" || msValue == "2") {
            $(".d2_info").removeClass("hide-data");

            $(".d2_info .summary-div").addClass("hide-data");
            $(".d2_info .edit-div").removeClass("hide-data");
            $(".d2_info .intake-edit-div a.edit").addClass("hide-data");

        }
    }

    filedBankruptcyCase = function (msValue) {
        if (msValue == "1") {
            $(".past_8_year_section").addClass("hide-data");
        }
        if (msValue == "0") {
            $(".past_8_year_section").removeClass("hide-data");
        }
    }

    commonShowHide = function (divToShow, status) {
        if (status == "0") {
            $("." + divToShow).addClass('hide-data');
        }
        if (status == "1") {
            $("." + divToShow).removeClass('hide-data');
        }
    }

    rentOrOwnChange = function (msValue) {
        if (msValue == "0") {
            $(".own_div_1").addClass("hide-data");
            $(".rent_div_1").removeClass("hide-data");
            $(".additional_loans").addClass("hide-data");
        }
        if (msValue == "1") {
            $(".own_div_1").removeClass("hide-data");
            $(".rent_div_1").addClass("hide-data");
            // $(".additional_loans").removeClass("hide-data");
        }
    }

    loanOwnProperty1Change = function (msValue) {
        if (msValue == "0") {
            $(".loan_div").removeClass("hide-data");
            $(".additional_loans").removeClass("hide-data");
        }
        if (msValue == "1") {
            $(".loan_div").addClass("hide-data");
            $(".additional_loans").addClass("hide-data");
            $("#additional_loans_no_2").trigger("click");
            $("#additional_loans_no_2").prop('checked', false);
            $("#additional_loans_no_1").trigger("click");
            $("#additional_loans_no_1").prop('checked', false);
        }
    }

    loanOwnProperty2Change = function (msValue) {
        if (msValue == "0") {
            $(".additional_loans_div").addClass("hide-data");
            // $(".additional_loans").addClass("hide-data");
        }
        if (msValue == "1") {
            $(".additional_loans_div").removeClass("hide-data");
            $(".additional_loans").removeClass("hide-data");
        }
    }

    loanOwnProperty3Change = function (msValue) {
        if (msValue == "0") {
            $(".additional_loans_div_2").addClass("hide-data");
        }
        if (msValue == "1") {
            $(".additional_loans_div_2").removeClass("hide-data");
        }
    }

    forclosurePropertyChange = function (msValue) {
        if (msValue == "1") {
            $(".forecloser_section").addClass("hide-data");
            $(".forecloser_date_section").addClass("hide-data");
            $("#foreclosure_date_no").trigger('click');
        }
        if (msValue == "0") {
            $(".forecloser_section").removeClass("hide-data");
        }
    }

    forclosureDateChange = function (msValue) {
        if (msValue == "1") {
            $(".forecloser_date_section").addClass("hide-data");
        }
        if (msValue == "0") {
            $(".forecloser_date_section").removeClass("hide-data");
        }
    }

    // Primary Residence Address Show/Hide Function
    not_primary_address_property = function (value, element) {
        if (value == 'no') {
            // Not primary residence - show address fields and property data section
            $(".payment_not_primary_address_data").removeClass("d-none");
            $(".property-type-section").removeClass("d-none");
            
            // Show property-data-section immediately when "No" is selected
            $(".property-data-section").removeClass("d-none");
        }
        if (value == 'yes') {
            // Is primary residence - hide address fields, show property data section
            $(".payment_not_primary_address_data").addClass("d-none");
            $(".property-type-section").removeClass("d-none");
            
            // Show property-data-section immediately when "Yes" is selected
            $(".property-data-section").removeClass("d-none");
        }
    }

    // Property Type Show/Hide Function
    showHidePropertySizeDiv = function (element, value) {
        var valueInt = parseInt(value);
        var arr1 = [1, 2, 3, 4];  // Single family, Duplex, Condo, Mobile home
        var arr2 = [5, 6];         // Land, Investment
        
        var parentDiv = $(element).closest('.property-data-section');
        var descriptionDiv = parentDiv.find('.description-div');
        var descriptionAndLotSizeDiv = parentDiv.find('.description-and-lot-size-div');
        var descriptionAndOtherNameDiv = parentDiv.find('.description-and-other-name-div');
        var propertyValueSection = parentDiv.find('.property-value-section');
        var propertyOwnedBySection = parentDiv.find('.property-owned-by-section');
        
        if (arr1.includes(valueInt)) {
            descriptionDiv.removeClass('d-none');      // Show bedrooms/bathrooms/sq ft
            descriptionAndLotSizeDiv.addClass('d-none'); // Hide lot size
            descriptionAndOtherNameDiv.addClass('d-none'); // Hide other name
            
            // Check if all three fields are filled
            var bedrooms = parentDiv.find('.bedroom').val();
            var bathrooms = parentDiv.find('.bathroom').val();
            var sqFt = parentDiv.find('.home_sq_ft').val();
            
            if (bedrooms && bathrooms && sqFt) {
                propertyValueSection.removeClass('d-none'); // Show if all filled
                
                // Check if estimated property value is filled to show property-owned-by-section
                var propertyValue = parentDiv.find('.estimated_property_value').val();
                if (propertyValue) {
                    propertyOwnedBySection.removeClass('d-none');
                } else {
                    propertyOwnedBySection.addClass('d-none');
                }
            } else {
                propertyValueSection.addClass('d-none');    // Hide if not all filled
                propertyOwnedBySection.addClass('d-none');  // Also hide owned by section
            }
        } else if (arr2.includes(valueInt)) {
            descriptionAndLotSizeDiv.removeClass('d-none'); // Show lot size
            descriptionDiv.addClass('d-none');              // Hide bedrooms/bathrooms/sq ft
            descriptionAndOtherNameDiv.addClass('d-none'); // Hide other name
            
            // Check if lot size is filled
            var lotSize = parentDiv.find('.lot_size_acres').val();
            
            if (lotSize) {
                propertyValueSection.removeClass('d-none'); // Show if filled
                
                // Check if estimated property value is filled to show property-owned-by-section
                var propertyValue = parentDiv.find('.estimated_property_value').val();
                if (propertyValue) {
                    propertyOwnedBySection.removeClass('d-none');
                } else {
                    propertyOwnedBySection.addClass('d-none');
                }
            } else {
                propertyValueSection.addClass('d-none');    // Hide if not filled
                propertyOwnedBySection.addClass('d-none');  // Also hide owned by section
            }
        } else if (valueInt === 7) {
            // Timeshare - hide all description divs
            descriptionAndLotSizeDiv.addClass('d-none');
            descriptionDiv.addClass('d-none');
            descriptionAndOtherNameDiv.addClass('d-none');
            
            propertyValueSection.removeClass('d-none'); // Show property value section for Timeshare
            
            // Check if estimated property value is filled to show property-owned-by-section
            var propertyValue = parentDiv.find('.estimated_property_value').val();
            if (propertyValue) {
                propertyOwnedBySection.removeClass('d-none');
            } else {
                propertyOwnedBySection.addClass('d-none');
            }
        } else if (valueInt === 8) {
            // Other - show other name input
            descriptionDiv.addClass('d-none');              // Hide bedrooms/bathrooms/sq ft
            descriptionAndLotSizeDiv.addClass('d-none');    // Hide lot size
            descriptionAndOtherNameDiv.removeClass('d-none'); // Show other name
            
            // Check if property other name is filled
            var propertyOtherName = parentDiv.find('.property_other_input').val();
            
            if (propertyOtherName) {
                propertyValueSection.removeClass('d-none'); // Show if filled
                
                // Check if estimated property value is filled to show property-owned-by-section
                var propertyValue = parentDiv.find('.estimated_property_value').val();
                if (propertyValue) {
                    propertyOwnedBySection.removeClass('d-none');
                } else {
                    propertyOwnedBySection.addClass('d-none');
                }
            } else {
                propertyValueSection.addClass('d-none');    // Hide if not filled
                propertyOwnedBySection.addClass('d-none');  // Also hide owned by section
            }
        }
    }

    // Property Square Feet Input Validation (max 90,000 sq ft, 2 decimals)
    $(document).on('input', '.description-div-input', function() {
        var inputValue = $(this).val();
        
        if (/^\d+(\.\d{0,2})?$/.test(inputValue)) {
            var dotIndex = inputValue.indexOf('.');
            if (dotIndex !== -1) {
                var integerPart = inputValue.substring(0, dotIndex);
                var decimalPart = inputValue.substring(dotIndex + 1, dotIndex + 3);
                var newValue = integerPart + '.' + decimalPart;
                $(this).val(newValue);
            }
            if (parseFloat(inputValue) > 90000) {
                var newValue = inputValue.slice(0, -1);
                $(this).val(newValue);
            }    
        } else if (/^\d+(\.\d{3})?$/.test(inputValue)) {
            var newValue = inputValue.slice(0, -1);
            $(this).val(newValue);
        } else {
            $(this).val('');
        }
    });

    // Property Lot Size Input Validation (max 200,000 acres, 2 decimals)
    $(document).on('input', '.lot-size-div-input', function() {
        var inputValue = $(this).val();

        if (/^\d+(\.\d{0,2})?$/.test(inputValue)) {
            var dotIndex = inputValue.indexOf('.');
            if (dotIndex !== -1) {
                var integerPart = inputValue.substring(0, dotIndex);
                var decimalPart = inputValue.substring(dotIndex + 1, dotIndex + 3);
                var newValue = integerPart + '.' + decimalPart;
                $(this).val(newValue);
            }
            if (parseFloat(inputValue) > 200000) {
                var newValue = inputValue.slice(0, -1);
                $(this).val(newValue);
            }    
        } else if (/^\d+(\.\d{3})?$/.test(inputValue)) {
            var newValue = inputValue.slice(0, -1);
            $(this).val(newValue);
        } else {
            $(this).val('');
        }    
    });

    ownVehicleChange = function (msValue) {
        if (msValue == "0") {
            $(".own_vehicle").addClass("hide-data");
        }
        if (msValue == "1") {
            $(".own_vehicle").removeClass("hide-data");
        }
    }

    addLiensChange = function (msValue) {
        if (msValue == "0") {
            $(".additional_liens_section").addClass("hide-data");
        }
        if (msValue == "1") {
            $(".additional_liens_section").removeClass("hide-data");
        }
    }

    oweIRSChange = function (msValue) {
        if (msValue == "1") {
            $(".irs_section").removeClass("hide-data");
        }
        if (msValue == "0") {
            $(".irs_section").addClass("hide-data");
        }
    }

    oweBackTaxChange = function (msValue) {
        if (msValue == "1") {
            $(".back_taxes_owed_section").removeClass("hide-data");
        }
        if (msValue == "0") {
            $(".back_taxes_owed_section").addClass("hide-data");
        }
    }

    childSuppAndAlimonyChange = function (msValue) {
        if (msValue == "0") {
            $(".child_supp_or_alimony_section").removeClass("hide-data");
        }
        if (msValue == "1") {
            $(".child_supp_or_alimony_section").addClass("hide-data");
        }
    }

    currSuppObligChange = function (msValue) {
        if (msValue == "1") {
            $(".current_on_your_support_obligation_section").removeClass("hide-data");
        }
        if (msValue == "0") {
            $(".current_on_your_support_obligation_section").addClass("hide-data");
        }
    }


    $(".hamburger").click(function () {
        $(this).toggleClass("is-active");
        $(".nav_bar").toggleClass("active_ham");
    });

    chooseType = function (thisrequest) {
        if (thisrequest.value == "0") {
            $(".ssn_no").removeClass("hide-data");
            $(".itin_no").addClass("hide-data");
        }
        if (thisrequest.value == "1") {
            $(".ssn_no").addClass("hide-data");
            $(".itin_no").removeClass("hide-data");
        }
    }
    chooseTypeD2 = function (thisrequest) {
        if (thisrequest.value == "0") {
            $(".ssn_no_spouse").removeClass("hide-data");
            $(".itin_no_spouse").addClass("hide-data");
        }
        if (thisrequest.value == "1") {
            $(".ssn_no_spouse").addClass("hide-data");
            $(".itin_no_spouse").removeClass("hide-data");
        }
    }


});

function vehicle_loan_show(index, val) {
    if (val == 'yes') {
        $(".vehicle_loan_div_" + index).removeClass("hide-data");
        // Add active class to Yes label, remove from No label
        $("#type_yes_vehicle_" + index).next('label').addClass('active');
        $("#type_no_vehicle_" + index).next('label').removeClass('active');
    }
    if (val == 'no') {
        $(".vehicle_loan_div_" + index).addClass("hide-data");
        // Add active class to No label, remove from Yes label
        $("#type_no_vehicle_" + index).next('label').addClass('active');
        $("#type_yes_vehicle_" + index).next('label').removeClass('active');
    }
}

function showDebtSection(index, msValue) {
    if (msValue == "1" || msValue == "3") {
        $(".additional_liens_debt_section_" + index).addClass("hide-data");
    }
    if (msValue == "2" || msValue == "4") {
        $(".additional_liens_debt_section_" + index).removeClass("hide-data");
    }
}

function addMoreDebtSection(index) {
    var nextIndex = 1 + index;
    if (index == 3) {
        alert('You can only insert 4 properties.');
    }
    if (index != 3) {
        $(".additional_section_" + nextIndex).removeClass("hide-data");
        $(".additional_addmore_section_" + index).addClass("hide-data");
    }
}

function removeDebtSection(index) {
    var prevIndex = index - 1;
    $(".additional_addmore_section_" + prevIndex).removeClass("hide-data");
    $(".additional_addmore_section_" + index).addClass("hide-data");
    $(".additional_section_" + index).addClass("hide-data");
}

function change_vehicle(sobj, indexese) {

    var $select = $(sobj);
    var val = $select.val();
    var $row = $select.closest('.single-vehicle-form');

    // Count totals across all selects after this change
    var cars = $('.property_type').filter(function () { return $(this).val() == '1'; }).length;
    var recreational = $('.property_type').filter(function () { return $(this).val() == '6'; }).length;

    // Enforce limits and toggle hint within this row
    if (val == '1' && cars > 4) {
        $select.val('6');
        $row.find('.reccreational-vehicle').removeClass('hide-data');
        alert('You can not add more than 4 vehicles.');
        return false;
    }
    if (val == '6' && recreational > 2) {
        $select.val('1');
        $row.find('.reccreational-vehicle').addClass('hide-data');
        alert('You can not add more than 2 Recreational vehicles.');
        return false;
    }

    // Update labels within this row
    if (val == '1') {
        $row.find('.vtype_name').first().text('Vehicle');
        $row.find('.vehicleno').first().text(cars);
        $row.find('.reccreational-vehicle').addClass('hide-data');
    }
    if (val == '6') {
        $row.find('.vtype_name').first().text('Recreational');
        $row.find('.vehicleno').first().text(recreational);
        $row.find('.reccreational-vehicle').removeClass('hide-data');
    }

}

function addMoreVehicleFn() {
    var clnln = $(document).find(".single-vehicle-form").length;
    if (clnln > 5) {
        alert("You can only insert 6 properties.");
        $(".remove-btn").addClass("hide-data");
    } else {

        var itm = $(document).find(".single-vehicle-form").last();
        var index_val = clnln;
        var cln = $(itm).clone();

        var property_type = cln.find('.property_type');
        var property_estimated_value = cln.find('.property_estimated_value');
        var property_year = cln.find('.property_year');
        var property_make = cln.find('.property_make');
        var property_model = cln.find('.property_model');
        var property_mileage = cln.find('.property_mileage');
        var property_other_info = cln.find('.property_other_info');
        var vehicle_car_loan_monthly_payment = cln.find('.vehicle_car_loan_monthly_payment');
        var vehicle_car_loan_past_due_amount = cln.find('.vehicle_car_loan_past_due_amount');
        var vehicle_car_loan_amount_own = cln.find('.vehicle_car_loan_amount_own');
        var vehicle_creditor_name = cln.find('.vehicle_creditor_name');
        var vehicle_creditor_name_addresss = cln.find('.vehicle_creditor_name_addresss');
        var vehicle_creditor_city = cln.find('.vehicle_creditor_city');
        var vehicle_creditor_state = cln.find('.vehicle_creditor_state');
        var vehicle_creditor_zip = cln.find('.vehicle_creditor_zip');
        var vehicle_loan_on_property = cln.find('.vehicle_loan_on_property');
        var vehicle_file_upload = cln.find('.vehicle_file_upload');

        var cars = 0;
        var recreational = 0;

        // Count only checked property_type radios (not all radios)
        $(".property_type:checked").each(function () {
            if ($(this).val() == 1) {
                cars = cars + 1;
            }
            if ($(this).val() == 6) {
                recreational = recreational + 1;
            }
        });

        var vehiclename = 'Vehicle';
        var number = cars + 1;
        
        // If we've reached the vehicle limit, default to recreational
        if (cars >= 4) {
            vehiclename = 'Recreational';
            number = recreational + 1;
        }

        cln.find('.vtype_name').text(vehiclename);
        cln.find('.vehicleno').text(number);

        cln.find(".doc-card").text("Current Auto Loan Statement " + (index_val + 1));

        cln.find(".o-doc-card").text("Other Loan Statement " + (index_val + 1));

        // Update property_type radio buttons for chip-style-tab
        $(property_type).each(function () {
            $(this).attr('name', 'property_vehicle[property_type][' + index_val + ']');
            $(this).attr('onclick', 'changeVehicleIntake(this, ' + index_val + ')');
            $(this).prop('checked', false);
        });
        
        // Update property_type_name hidden field
        cln.find('.property_type_name').attr('name', 'property_vehicle[property_type_name][' + index_val + ']').val('');
        
        // Update VIN number field
        cln.find('.vin_number').attr('name', 'property_vehicle[vin_number][' + index_val + ']')
            .attr('id', 'vin_' + index_val)
            .val('').prop('disabled', false);
        
        // Update VIN import button
        cln.find('.link_vin').attr('id', 'link_vin_' + index_val);
        
        // Update unknown VIN checkbox
        cln.find('.unknown_vin').attr('onclick', 'checkUnknownVin(this, ' + index_val + ')')
            .removeClass('unknown_vin_' + (index_val - 1))
            .addClass('unknown_vin_' + index_val)
            .prop('checked', false);
        
        // Update vehicle file upload
        $(vehicle_file_upload).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_property_value_document][' + index_val + ']');
            $(this).attr('id', 'vehicle_file_' + index_val);
            $(this).val('');
        });
        
        // Update vehicle-detail-section class
        cln.find('.vehicle-detail-section')
            .removeClass('vehicle-detail-section-' + (index_val - 1))
            .addClass('vehicle-detail-section-' + index_val)
            .addClass('hide-data');
        
        // Update vehicle-data-section class
        cln.find('.vehicle-data-section-' + (index_val - 1))
            .removeClass('vehicle-data-section-' + (index_val - 1))
            .addClass('vehicle-data-section-' + index_val)
            .addClass('d-none');
        
        // Remove all active classes from chip-tabs
        cln.find('.chip-tab').removeClass('active');
        $(property_estimated_value).each(function () {
            $(this).attr('name', 'property_vehicle[property_estimated_value][' + index_val + ']');
        });
        $(property_year).each(function () {
            $(this).attr('name', 'property_vehicle[property_year][' + index_val + ']');
        });
        $(property_make).each(function () {
            $(this).attr('name', 'property_vehicle[property_make][' + index_val + ']');
        });
        $(property_model).each(function () {
            $(this).attr('name', 'property_vehicle[property_model][' + index_val + ']');
        });
        $(property_mileage).each(function () {
            $(this).attr('name', 'property_vehicle[property_mileage][' + index_val + ']');
        });
        $(property_other_info).each(function () {
            $(this).attr('name', 'property_vehicle[property_other_info][' + index_val + ']');
        });
        $(vehicle_car_loan_monthly_payment).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][monthly_payment][' + index_val + ']');
        });
        $(vehicle_car_loan_past_due_amount).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][past_due_amount][' + index_val + ']');
        });
        $(vehicle_car_loan_amount_own).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][amount_own][' + index_val + ']');
        });
        $(vehicle_creditor_name).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_name][' + index_val + ']');
        });
        $(vehicle_creditor_name_addresss).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_name_addresss][' + index_val + ']');
        });
        $(vehicle_creditor_city).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_city][' + index_val + ']');
        });
        $(vehicle_creditor_state).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_state][' + index_val + ']');
        });
        $(vehicle_creditor_zip).each(function () {
            $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_zip][' + index_val + ']');
        });
        $(vehicle_loan_on_property).each(function () {
            $(this).attr('name', 'property_vehicle[loan_own_type_property][' + index_val + ']');
            var msValue = $(this).val();
            if (msValue == "0") { //yes
                $(this).attr('id', 'type_yes_vehicle_' + index_val);
                $(this).attr('onclick', "vehicle_loan_show('" + index_val + "','yes')");
                $(this).next("label.yes").attr('for', 'type_yes_vehicle_' + index_val).removeClass('active');
            }
            if (msValue == "1") { //no
                $(this).attr('id', 'type_no_vehicle_' + index_val);
                $(this).attr('onclick', "vehicle_loan_show('" + index_val + "','no')");
                $(this).next("label.no").attr('for', 'type_no_vehicle_' + index_val).removeClass('active');
            }
        });
        
        // Update loan section class outside the radio button loop
        var prevIndex = index_val - 1;
        var loan_sect = cln.find(".vehicle_loan_section");
        loan_sect.removeClass('vehicle_loan_div_' + prevIndex);
        loan_sect.addClass('vehicle_loan_div_' + index_val);
        loan_sect.addClass('hide-data');
        
        // Clear all input values
        cln.find('input[type="text"]').val('');
        cln.find('input[type="radio"]').prop('checked', false);
        cln.find('select').val('');
        cln.find('textarea').val('');

        $(itm).after(cln);
        $(".remove-btn").removeClass("hide-data");

    }
}

$(document).on("change", "#debtor_state", function (evt) {
    statecounty('debtor_state', 'state_based_county');
});

$(document).on("change", "#property_state", function (evt) {
    statecounty('property_state', 'property_county');
});

// Check property description fields (bedrooms, bathrooms, sq ft) to show/hide property-value-section
$(document).on("change blur input", ".property-data-section .bedroom, .property-data-section .bathroom, .property-data-section .home_sq_ft", function() {
    // Get the selected property type
    var selectedPropertyType = $("input[name='property_own_data[property_type]']:checked").val();
    
    // Only check for property types 1-4 (Single family, Duplex, Condo, Mobile home)
    if (selectedPropertyType && [1, 2, 3, 4].includes(parseInt(selectedPropertyType))) {
        var parentDiv = $(this).closest('.property-data-section');
        var bedrooms = parentDiv.find('.bedroom').val();
        var bathrooms = parentDiv.find('.bathroom').val();
        var sqFt = parentDiv.find('.home_sq_ft').val();
        var propertyValueSection = parentDiv.find('.property-value-section');
        
        // If all three fields are filled, show property-value-section, otherwise hide it
        if (bedrooms && bathrooms && sqFt) {
            propertyValueSection.removeClass('d-none');
        } else {
            propertyValueSection.addClass('d-none');
        }
    }
});

// Check lot size field to show/hide property-value-section
$(document).on("change blur input", ".property-data-section .lot_size_acres", function() {
    // Get the selected property type
    var selectedPropertyType = $("input[name='property_own_data[property_type]']:checked").val();
    
    // Only check for property types 5-6 (Land, Investment)
    if (selectedPropertyType && [5, 6].includes(parseInt(selectedPropertyType))) {
        var parentDiv = $(this).closest('.property-data-section');
        var lotSize = parentDiv.find('.lot_size_acres').val();
        var propertyValueSection = parentDiv.find('.property-value-section');
        
        // If lot size is filled, show property-value-section, otherwise hide it
        if (lotSize) {
            propertyValueSection.removeClass('d-none');
        } else {
            propertyValueSection.addClass('d-none');
        }
    }
});

// Check property other name field to show/hide property-value-section
$(document).on("change blur input", ".property-data-section .property_other_input", function() {
    // Get the selected property type
    var selectedPropertyType = $("input[name='property_own_data[property_type]']:checked").val();
    
    // Only check for property type 8 (Other)
    if (selectedPropertyType && parseInt(selectedPropertyType) === 8) {
        var parentDiv = $(this).closest('.property-data-section');
        var propertyOtherName = parentDiv.find('.property_other_input').val();
        var propertyValueSection = parentDiv.find('.property-value-section');
        
        // If property other name is filled, show property-value-section, otherwise hide it
        if (propertyOtherName) {
            propertyValueSection.removeClass('d-none');
        } else {
            propertyValueSection.addClass('d-none');
        }
    }
});

// Check estimated property value field to show/hide property-owned-by-section
$(document).on("change blur input", ".property-data-section .estimated_property_value", function() {
    var parentDiv = $(this).closest('.property-data-section');
    var propertyValue = $(this).val();
    var propertyOwnedBySection = parentDiv.find('.property-owned-by-section');
    
    // If property value is filled, show property-owned-by-section, otherwise hide it
    if (propertyValue) {
        propertyOwnedBySection.removeClass('d-none');
    } else {
        propertyOwnedBySection.addClass('d-none');
    }
});

// Check property owned by selection to show/hide mortgage-section
$(document).on("change", "input[name='property_own_data[property_owned_by]']", function() {
    var selectedValue = $("input[name='property_own_data[property_owned_by]']:checked").val();
    
    // If any option is selected, show mortgage-section, otherwise hide it
    if (selectedValue) {
        $(".mortgage-section").removeClass('d-none');
    } else {
        $(".mortgage-section").addClass('d-none');
    }
});

$(document).on("input", ".phone-field", function (evt) {

    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
    var first10 = $(this).val().substring(0, 14);
    if (this.value.length > 14) {
        this.value = first10;
    }


});

function remove_clone_box(box_class) {
    var clnln = $(document).find("." + box_class).length;
    if (clnln <= 1) {
        alert("You can delete because min 1 entries require.");
        return false;
    } else {
        $(document).find("." + box_class).last().remove();
        var itm = $(document).find("." + box_class).last();
        var remove_btn_index = itm.find('button.remove_clone').data('index');
        if (remove_btn_index > 0) {
            itm.find('button.' + button_class).show();
        }
    }
}


$(document).on('input', ".allow-5digit", function (e) {
    var firstFive = this.value.substring(0, 5);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if ((e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
    if (this.value.length > 5) {
        this.value = firstFive;
    }
});

function redirectToURL(url) {
    $('#page_loader').show();
    window.location.href = url;
}

function toggleReviewsButton(value) {
    const reviewsButtonContainer = document.getElementById('reviews-button-container');
    if (value == 0) {
        reviewsButtonContainer.classList.remove('hide-data');
    } else {
        reviewsButtonContainer.classList.add('hide-data');
    }
}

// Run on page load so old value is respected
document.addEventListener('DOMContentLoaded', function () {
    const yesRadio = document.getElementById('google_reviews_yes');
    const noRadio = document.getElementById('google_reviews_no');

    if (noRadio || yesRadio) {
        if (noRadio.checked) {
            toggleReviewsButton(0);
        } else if (yesRadio.checked) {
            toggleReviewsButton(1);
        }
    }
});


const maxCases = 3; // maximum allowed cases

function addMorePrevCaseSection(currentIndex) {
    const totalSections = document.querySelectorAll('.additional_case_section').length;

    if (totalSections >= maxCases) {
        alert("You can only add up to " + maxCases + " cases.");
        return;
    }

    const newIndex = totalSections; // next index
    const templateSelect = document.querySelector(
        'select[name^="any_bankruptcy_filed_before_data[district_if_known]"]'
    );
    let statesOptions = templateSelect ? templateSelect.innerHTML : '';

    // ensure first option is reset
    statesOptions = statesOptions.replace(/selected/gi, "");

    const newSection = `
    <div class="row gx-3 additional_case_section additional_case_section_${newIndex} m-0">
        <div class="light-gray-div mt-2">
            <h2>Previous Case ${newIndex + 1}:</h2>
            <div class="row gx-3">

                <!-- Case Name -->
                <div class="col-md-4">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">Case Name</label>
                            <input type="text" 
                                class="input_capitalize form-control required"
                                name="any_bankruptcy_filed_before_data[case_name][${newIndex}]"
                                placeholder="Case Name" value="">
                        </div>
                    </div>
                </div>

                <!-- Date Filed -->
                <div class="col-md-3">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">Date Filed</label>
                            <input type="text" 
                                class="input_capitalize form-control date_filed required date-filed-input"
                                name="any_bankruptcy_filed_before_data[data_field][${newIndex}]"
                                placeholder="MM/DD/YYYY" value="">
                            <div class="form-check">
                                <input class="form-check-input date-filed-unknown" type="checkbox"
                                    id="date_filed_unknown_${newIndex}"
                                    name="any_bankruptcy_filed_before_data[data_field_unsure][${newIndex}]"
                                    onclick="toggleRequired('date-filed-input', this)">
                                <label class="form-check-label form-label"
                                    for="date_filed_unknown_${newIndex}"><small>Unsure</small></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Case Number -->
                <div class="col-md-2">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">Case Number</label>
                            <input type="text" 
                                class="input_capitalize form-control required case-number-input"
                                name="any_bankruptcy_filed_before_data[case_numbers][${newIndex}]"
                                placeholder="Case Number" value="">
                            <div class="form-check">
                                <input class="form-check-input case-number-unknown" type="checkbox"
                                    id="case_number_unknown_${newIndex}"
                                    name="any_bankruptcy_filed_before_data[case_numbers_unknown][${newIndex}]"
                                    onclick="toggleRequired('case-number-input', this)">
                                <label class="form-check-label form-label"
                                    for="case_number_unknown_${newIndex}"><small>Unknown</small></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- District -->
                <div class="col-md-3">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">District if (known)</label>
                            <select name="any_bankruptcy_filed_before_data[district_if_known][${newIndex}]" required class="form-control required">
                                ${statesOptions}
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="d-flex align-items-center additional_case_section_${newIndex} additional_addmore_section_${newIndex} prev-case-addmore">
        <button type="button"
            class="vehicle-action-btn add-btn shadow-2 rounded-0 w-auto label save-btn mx-ht im-action btn-new-ui-default m-0 py-2 d-inline-block"
            onclick="addMorePrevCaseSection(${newIndex});">
            <i class="bi bi-plus-lg mr-1"></i> Add More
        </button>

        <button type="button"
            class="vehicle-action-btn delete-btn delete-div trash-btn ms-auto d-inline-block"
            title="Delete"
            onclick="removePrevCaseSection(${newIndex});">
            <i class="bi bi-trash3 mr-1 remove-btn cursor-pointer float_right remove_clone"></i>Delete
        </button>
    </div>`;

    const lastAddMoreRow = document.querySelector(`.additional_addmore_section_${currentIndex}`);
    lastAddMoreRow.insertAdjacentHTML("afterend", newSection);

    // Hide old Add & Delete buttons so only latest block has them
    const oldAdd = lastAddMoreRow.querySelector("button.add-btn");
    if (oldAdd) {
        oldAdd.classList.remove("d-inline-block");
        oldAdd.classList.add("hide-data");
    }

    const oldDelete = lastAddMoreRow.querySelector("button.delete-btn");
    if (oldDelete) {
        oldDelete.classList.remove("d-inline-block");
        oldDelete.classList.add("hide-data");
    }

    // Hide add if max reached
    if (newIndex + 1 >= maxCases) {
        const newAdd = document.querySelector(`.additional_addmore_section_${newIndex} button.add-btn`);
        if (newAdd) {
            newAdd.classList.remove("d-inline-block");
            newAdd.classList.add("hide-data");
        }
    }
}

function removePrevCaseSection(index) {
    const sections = document.querySelectorAll('.additional_case_section');
    const totalSections = sections.length;

    if (totalSections <= 1) {
        alert("At least one case must remain.");
        return;
    }

    // Remove selected case + its button row
    document.querySelectorAll(`.additional_case_section_${index}`).forEach(el => el.remove());
    document.querySelectorAll(`.additional_addmore_section_${index}`).forEach(el => el.remove());

    // Find new last index
    const newLastIndex = document.querySelectorAll('.additional_case_section').length - 1;
    const lastRow = document.querySelector(`.additional_addmore_section_${newLastIndex}`);
    if (lastRow) {
        const addBtn = lastRow.querySelector("button.add-btn");
        if (addBtn) {
            addBtn.classList.toggle("hide-data", newLastIndex + 1 >= maxCases);
            addBtn.classList.toggle("d-inline-block", newLastIndex + 1 < maxCases);
        }

        const delBtn = lastRow.querySelector("button.delete-btn");
        if (delBtn) {
            delBtn.classList.toggle("hide-data", newLastIndex === 0);
            delBtn.classList.toggle("d-inline-block", newLastIndex > 0);
        }
    }
}

function toggleRequired(inputClass, checkbox) {
    var parent = checkbox.closest('.form-group');
    var input = parent.querySelector('input.' + inputClass);
    if (checkbox.checked) {
        input.classList.remove('required');
        input.required = false;
        input.value = '';
    } else {
        input.classList.add('required');
        input.required = true;
    }
}

// Property Details GraphQL Function for Intake Form
function getPropertyDetailsForIntakeForm(element) {
    const $element = $(element);
    const isCheckedNo = $('#payment_not_primary_address_no').is(':checked');
    const isCheckedYes = $('#payment_not_primary_address_yes').is(':checked');

    let address = "";

    if (isCheckedNo) {
        const $streetInput = $('input[name="property_own_data[property_address]"]');
        const street = $streetInput.val() || '';
        const city = $('input[name="property_own_data[property_city]"]').val() || '';
        const state = $('#property_state option:selected').val() || '';
        const zip = $('input[name="property_own_data[property_zip]"]').val() || '';

        address = street;
        address += city ? ', ' + city : '';
        address += state ? ', ' + state : '';
        address += zip ? ', ' + zip : '';

        if (!address.trim()) {
            $.systemMessage("Kindly enter your residence address before accessing the property details.", 'alert--danger', true);
            $streetInput.focus();
            return;
        }
    }

    if (isCheckedYes) {
        // Get primary address from data attribute
        address = $element.data('primary-address') || '';
        if (!address.trim()) {
            $.systemMessage("Primary address not found. Please enter your address in the Step 1: Debtor's Information section.", 'alert--danger', true);
            return;
        }
    }

    if (!isCheckedNo && !isCheckedYes) {
        $.systemMessage("Kindly select your primary residence type before accessing the property details.", 'alert--danger', true);
        return;
    }

    if (address && address.trim()) {
        const clientId = $element.data('client-id');
        const graphqlUrl = $element.data('graphql-url');
        fetchPropertyDetailsForIntakeForm(address, clientId, graphqlUrl, $element);
    } else {
        $.systemMessage("Please select your primary residence type and enter address before generating property details", 'alert--danger', true);
    }
}

function fetchPropertyDetailsForIntakeForm(address, clientId, graphqlUrl, $button) {
    // Show loading state on button
    var originalText = $button.html();
    $button.html('<i class="bi bi-hourglass-split"></i> Loading...').prop('disabled', true);
    
    // Show loading message
    if (typeof $.systemMessage === 'function') {
        $.systemMessage("Grabbing Property Details. Hold Please.", 'alert--process');
    }

    $.ajax({
        url: graphqlUrl,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            address: address,
            client_id: clientId,
            form_type: 'intake_form'
        },
        dataType: 'json',
        success: function(response) {
            // Restore button state
            $button.html(originalText).prop('disabled', false);
            
            if (response.status === 1 && response.finalData) {
                const finalData = response.finalData;
                
                // Set property type by clicking the appropriate radio button
                $('input[name="property_own_data[property_type]"]').each(function() {
                    const isMatch = $(this).val() == finalData.property_type;
                    if (isMatch) {
                        const id = $(this).attr('id');
                        $('label[for="' + id + '"]').trigger('click');
                    }
                });
                
                // Set property value
                $('input[name="mortgage_property_value_1"]').val(finalData.price).trigger('input');
                
                // Set bedrooms
                $('select[name="property_own_data[property_bedrooms]"]').val(finalData.beds).trigger('change');
                
                // Set bathrooms
                $('select[name="property_own_data[property_bathrooms]"]').val(finalData.baths).trigger('change');
                
                // Set home sq ft
                $('input[name="property_own_data[property_home_sq_ft]"]').val(finalData.lot_size).trigger('input');
                
                // Close loading message and show success
                if (typeof $.systemMessage === 'function') {
                    $.systemMessage.close();
                    $.systemMessage("Property details added successfully.", "alert--success", true);
                } else {
                    $.systemMessage("Property details added successfully.", "alert--success", true);
                }
            } else {
                const errorMsg = response.msg || "Failed to fetch property details";
                $.systemMessage(errorMsg, 'alert--danger', true);               
            }
        },
        error: function(xhr, status, error) {
            // Restore button state
            $button.html(originalText).prop('disabled', false);
            
            console.error('AJAX Error:', xhr, status, error);
            const errorMsg = "Error fetching property details: " + error;
            $.systemMessage(errorMsg, 'alert--danger', true);
           
        }
    });
}

// Show/hide property detail button when primary residence selection changes
$(document).on('change', 'input[name="property_own_data[not_primary_address]"]', function() {
    const isCheckedNo = $('#payment_not_primary_address_no').is(':checked');
    const isCheckedYes = $('#payment_not_primary_address_yes').is(':checked');
    
    if (isCheckedNo || isCheckedYes) {
        $('.property-detail-div').removeClass('d-none');
    } else {
        $('.property-detail-div').addClass('d-none');
    }
});

// Show property detail button when all address fields are filled (for "No" option)
$(document).on('blur', 'input[name="property_own_data[property_address]"], input[name="property_own_data[property_city]"], input[name="property_own_data[property_zip]"], #property_state', function() {
    const isCheckedNo = $('#payment_not_primary_address_no').is(':checked');
    
    if (isCheckedNo) {
        const street = $('input[name="property_own_data[property_address]"]').val();
        const city = $('input[name="property_own_data[property_city]"]').val();
        const state = $('#property_state').val();
        const zip = $('input[name="property_own_data[property_zip]"]').val();
        
        if (street && city && state && zip) {
            $('.property-detail-div').removeClass('d-none');
        }
    }
});
