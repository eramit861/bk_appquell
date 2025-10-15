(function ($) {
    /*$("input:radio").each(function () {
        if(($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))){
        $(this).trigger('click');
        }

     });*/
})(jQuery);

$(document).ready(function () {
    initializeDatepicker();

    $.validator.addMethod("dateMMYYYY", function(value, element) {
        return this.optional(element) || /^(0[1-9]|1[0-2])\/\d{4}$/.test(value);
    }, "Please enter a date in the format MM/YYYY.");

    $.validator.addMethod("fourDigits", function(value, element) {
        return this.optional(element) || /^\d{4}$/.test(value);
    }, "Please enter last 4 digits.");

    $.validator.addMethod("multipleYears", function(value, element) {
        // Split input value by spaces and trim each part
        const years = value.trim().split(/\s+/);

        // Check each year
        for (let i = 0; i < years.length; i++) {
            // Validate format (4 digits) and range (not greater than current year)
            if (!/^\d{4}$/.test(years[i]) || parseInt(years[i], 10) > new Date().getFullYear()) {
                return false;
            }
        }
        return true;
    }, "Please enter valid years separated by spaces, not greater than the current year.");

    if ($("#get_eviction_pending_radio").hasClass("hide-data")) {
        $("#get_eviction_pending").addClass("hide-data");
        $("#eviction-pending-no").attr("checked", true);
    }

    // Format inputs on page load
    $('.date_month_year_custom').each(function() {
        updateMonthYearDateFormatInput($(this));
    });

    // Handle input formatting and validation on user input
    $(document).on("input",'.date_month_year_custom', function() {
        updateMonthYearDateFormatInput($(this));
    });

    // Handle validation on blur event
    $(document).on("blur",'.date_month_year_custom', function() {
        ValidateMonthYearDateInput($(this));
    });

    $('.simple_date_format').on('input', function(e) {
        var input = $(this).val();
        var formattedInput = input.replace(/\D/g, ''); // Remove non-digit characters

        if (formattedInput.length > 2) {
            formattedInput = formattedInput.slice(0, 2) + '/' + formattedInput.slice(2);
        }
        if (formattedInput.length > 5) {
            formattedInput = formattedInput.slice(0, 5) + '/' + formattedInput.slice(5, 9);
        }
        $(this).val(formattedInput);
    });

    $(document).on("blur",'.input_capitalize', function() {
        let value = $(this).val().toLowerCase();
        let capitalizedValue = value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
        $(this).val(capitalizedValue);
    });   
    
    $(document).on('click', '.label-div label.btn-toggle', function () {
        const $label = $(this);
        const radioId = $label.attr('for');
        const $radio = $(`#${radioId}`);
        const name = $radio.attr('name');

        // Remove error from all radios in the group and their labels
        $(`input[name="${name}"]`).each(function () {
            $(this).removeClass('error');
            $(`label[for="${$(this).attr('id')}"]`).removeClass('error').removeClass('isRadioError');
        });
    });


});

$(document).on('input', '.alphanumericInput', function () {
    var sanitizedInput = $(this).val().replace(/[^A-Za-z0-9 ]/g, '');
    $(this).val(sanitizedInput);
 });

 $(document).on('input', '.alphanumericInput_last_4_digits', function () {
    // Remove non-alphanumeric characters and limit to 4 characters
    var sanitizedInput = $(this).val().replace(/[^A-Za-z0-9 ]/g, '').substring(0, 4);
    $(this).val(sanitizedInput);
});

// Event listener for inputs with "date-validate-mm-yyyy-format" class
$(document).on('blur', '.date-validate-mm-yyyy-format', function () {
    const input = $(this);
    const value = input.val().trim();
    const errorMsg = input.closest('.form-group').find('.error-msg');
    
    // Clear previous errors
    errorMsg.text('');
    input.removeClass('error');
    
    // Validate MM/YYYY format
    if (!isValidMMYYYY(value)) {
        errorMsg.text('Please enter the date in MM/YYYY format');
        input.val('');
        input.addClass('error');
        return;
    }

    // Validate future date
    if (!isNotFutureDate(value)) {
        errorMsg.text('Future dates are not allowed');
        input.val('');
        input.addClass('error');
        return;
    }

    // Get related inputs based on data attributes
    const startinputname = input.attr('data-startinputname');
    const endinputname   = input.attr('data-endinputname');
    
    const startDate = $('input[name="'+startinputname+'"]').val().trim();
    const endDate   = $('input[name="'+endinputname+'"]').val().trim();

    if (startDate && endDate) {
        const [startMonth, startYear] = startDate.split('/').map(Number);
        const [endMonth, endYear] = endDate.split('/').map(Number);

        const start = new Date(startYear, startMonth - 1);
        const end = new Date(endYear, endMonth - 1);

        if (start > end) {
            errorMsg.text('"From" date cannot be greater than "To" date.');     
            input.addClass('error');
            input.val('');
            return
        }
    }
    input.removeClass('error');
});

// Function to validate MM/YYYY format
function isValidMMYYYY(date) {
    return /^(0[1-9]|1[0-2])\/\d{4}$/.test(date);
}

// Function to disable future dates
function isNotFutureDate(date) {
    const today = new Date();
    const [month, year] = date.split('/').map(Number);
    const enteredDate = new Date(year, month - 1); // Months are 0-indexed
    return enteredDate <= today;
}



function updateMonthYearDateFormatInput($input) {
    let inputVal = $input.val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    if (inputVal.length > 2) {
        inputVal = inputVal.slice(0, 2) + '/' + inputVal.slice(2);
    }
    if (inputVal.length > 7) {
        inputVal = inputVal.slice(0, 7); // Restrict length to 7 characters
    }
    $input.val(inputVal);
}

function ValidateMonthYearDateInput($input) {
    const inputVal = $input.val().trim();
    const datePattern = /^(0[1-9]|1[0-2])\/\d{4}$/; // Regular expression for mm/yyyy format

    let requireFieldError;
    let name;

    if (inputVal !== '' && datePattern.test(inputVal)) {
        const parts = inputVal.split('/');
        const inputMonth = parseInt(parts[0], 10);
        const inputYear = parseInt(parts[1], 10);

        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1; // getMonth() returns month from 0 to 11
        const currentYear = currentDate.getFullYear();

        const inputDate = new Date(inputYear, inputMonth - 1); // Create a Date object for the input date
        const currentDateObj = new Date(currentYear, currentMonth - 1); // Create a Date object for the current date

        // Calculate the date 30 years ago
        const thirtyYearsAgo = new Date(currentYear - 30, currentMonth - 1);
        // Check if the input year is older than 30 years
        if (inputDate < thirtyYearsAgo) {
            name = $input.attr("name");
            requireFieldError = '<label id="'+ name + '-error" class="error">Please enter a date within the past 30 years, up to today.</label>';
            $input.parent().parent().find("div.validation-error").remove();
            $input.parent().parent().append(requireFieldError);
            $input.addClass("error");
        } 
        // Check if input date is greater than the current date
        else if (inputDate > currentDateObj) {
            name = $input.attr("name");
            requireFieldError = '<label id="'+ name + '-error" class="error">Please enter a date that is not greater than the current date.</label>';
            $input.parent().parent().find("div.validation-error").remove();
            $input.parent().parent().append(requireFieldError);
            $input.addClass("error");
        }

    } else if (inputVal !== '') {
        $input.val('');
        name = $input.attr("name");
        requireFieldError = '<label id="'+ name + '-error" class="error">Please enter valid date in MM/YYYY format.</label>';
        $input.parent().parent().find("div.validation-error").remove();
        $input.parent().parent().append(requireFieldError);
        $input.addClass("error");
    }
}

function initializeDatepicker() {
    $("input.date_filed").bind("paste", function (e) {
        //also changed the binding too
        e.preventDefault();
    });

    // $(".date_filed.my").datepicker({
    //     dateFormat: "mm/yy",
    //     changeMonth: true,
    //     changeYear: true,
    //     maxDate: "0",
    // });
    if ($.fn.mask) {
    $(".date_filed.my").mask("Z9/9999", {
        translation: {
            Z: {
                pattern: /[0-9]/,
                optional: true,
            },
        },
    });

    // $(".date_month_year").datepicker({
    //     dateFormat: "mm/yy",
    //     changeMonth: true,
    //     changeYear: true,
    //     maxDate: "0",
    // });

    $(".date-validate-mm-yyyy-format").mask("Z9/9999", {
        translation: {
            Z: {
                pattern: /[0-9]/,
                optional: true,
            },
        }
    });
    $(".date_month_year").mask("Z9/9999", {
        translation: {
            Z: {
                pattern: /[0-9]/,
                optional: true,
            },
        }
    });
   // $(".date_month_year").mask("00/0000");

    
    // $(".date_filed").datepicker({
    //     dateFormat: "mm/dd/yy",
    //     changeMonth: true,
    //     changeYear: true,
    //     maxDate: "0",
    // });
}
}

var CurrentYear = parseInt(new Date().getFullYear());
var CurrentMonth = parseInt(new Date().getMonth()) + 1;
CurrentMonth = CurrentMonth < 10 ? "0" + CurrentMonth : CurrentMonth;
var CurrentDay = parseInt(new Date().getDate());
CurrentDay = CurrentDay < 10 ? "0" + CurrentDay : CurrentDay;

function submitFormSectionA() {
    document.getElementById("section1-tab").classList.remove("active");
    document.getElementById("section2-tab").classList.add("active");

    document.getElementById("section1").classList.remove("active", "show");
    document.getElementById("section2").classList.add("active", "show");
}
var num = 0;

function changeStep(obj) {
    var marital_status = $('input[name="part1[marital_status]"]:checked').val();
    if (marital_status == 1 || marital_status == 5) {
        var second_parent = $(obj).parents("form").parent().parent().next();
        if ($(second_parent).attr("id") == "basic-info-part-b") {
            $(second_parent).next().removeClass("hidestep");
            $(obj).parents("form").parent().parent().addClass("hidestep");
        } else {
            $(obj)
                .parents("form")
                .parent()
                .parent()
                .next(".hidestep")
                .removeClass("hidestep");
            $(obj).parents("form").parent().parent().addClass("hidestep");
        }
    } else {
        $(obj)
            .parents("form")
            .parent()
            .parent()
            .next(".hidestep")
            .removeClass("hidestep");
        $(obj).parents("form").parent().parent().addClass("hidestep");
    }
}
// Hidden Data
// Section A
function current_employed_obj(value) {
    if (value == "yes") {
        document.getElementById("employer_page_listing_div").classList.remove("hide-data");
        // document.getElementById("current_employed_obj_data_additional").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("employer_page_listing_div").classList.add("hide-data");
        // document.getElementById("current_employed_obj_data_additional").classList.add("hide-data");
    }
}

function toggleHasNotes(value, index, formId) {
    if (value == "yes") {
        document.querySelector('#'+formId+' .has_notes_'+index).classList.remove("hide-data");
    } else if (value == "no") {
        document.querySelector('#'+formId+' .has_notes_'+index).classList.add("hide-data");
    }
}

function payFrequencyChanged(event, index, formId) {
    let selectedValue = $(event).val();
    let input = '';
    let twiceMonthSelection = '';
    if(formId == 'client_income_step1'){
        input = document.querySelector('#' + formId + ' .previous_employer_div_self_'+index+' input.previous_employer_end_date');
        twiceMonthSelection = document.querySelector('#' + formId + ' .previous_employer_div_self_'+index+' .twice-month-selection');
    } else if(formId == 'client_income_step2'){
        input = document.querySelector('#' + formId + ' .previous_employer_div_spouse_'+index+' input.previous_employer_end_date');
        twiceMonthSelection = document.querySelector('#' + formId + ' .previous_employer_div_spouse_'+index+' .twice-month-selection');
    } else {
        input = document.querySelector('#' + formId + ' .debt_creditor_'+index+' input.paystub_paydate_recent');
        twiceMonthSelection = document.querySelector('#' + formId + ' .debt_creditor_'+index+' .twice-month-selection');
    }    

    if (selectedValue == 3) {
        twiceMonthSelection.classList.remove("hide-data");
    } else {
        twiceMonthSelection.classList.add("hide-data");
    }

}

function toggleMonthSelection(selectedValue, index, formId) {

    let input;
    if (formId === 'client_income_step1') {
        input = document.querySelector(`#${formId} .previous_employer_div_self_${index} input.previous_employer_end_date`);
    } else if (formId === 'client_income_step2') {
        input = document.querySelector(`#${formId} .previous_employer_div_spouse_${index} input.previous_employer_end_date`);
    } else {
        input = document.querySelector(`#${formId} .debt_creditor_${index} input.paystub_paydate_recent`);
    }

    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth(); // 0 = January
    const day = today.getDate();
    const lastDayOfMonth = new Date(year, month + 1, 0).getDate();
    let targetDate;

    if (selectedValue === 0) {
        // 1st–14th → next 15th
        // 15th+ → next 1st (of next month)
        if (day >= 1 && day <= 14) {
            targetDate = new Date(year, month, 15);
        } else {
            targetDate = new Date(year, month + 1, 1);
        }
    }

    if (selectedValue === 1) {
        // 15th → second last day of month → next last day of month
        // else (1–14 OR last day) → next 15th
        if (day >= 15 && day < lastDayOfMonth) {
            targetDate = new Date(year, month + 1, 0); // last day of current month
        } else {
            targetDate = new Date(year, month + 1, 15); // next 15th
        }
    }

    if (input && targetDate) {
        const mm = String(targetDate.getMonth() + 1).padStart(2, '0');
        const dd = String(targetDate.getDate()).padStart(2, '0');
        const yyyy = targetDate.getFullYear();
        input.value = `${mm}/${dd}/${yyyy}`;
    }

}


function display_current_employer_edit_section( parentDivId, index ) {
    $('#'+parentDivId).find('#current_employer_summary_div_'+index).addClass('hide-data');
    $('#'+parentDivId).find('#current_employer_edit_div_'+index).removeClass('hide-data');

    $('#'+parentDivId).find('#current_employer_option_div_'+index+' .edit-btn').addClass('hide-data');
    $('#'+parentDivId).find('#current_employer_option_div_'+index+' .save-btn').removeClass('hide-data');
}

function hide_current_employer_edit_section(parentDivId, index) {
    var summaryDiv = $('#' + parentDivId + ' #current_employer_summary_div_' + index);
    var editDiv = $('#' + parentDivId + ' #current_employer_edit_div_' + index);
    var optionDiv = $('#' + parentDivId + ' #current_employer_option_div_' + index);

    // Fetch values from edit form
    var fields = {
        occupation: editDiv.find('.occupation'),
        name: editDiv.find('.name'),
        address_line_1: editDiv.find('.address_line_1'),
        city: editDiv.find('.city'),
        state: editDiv.find('.state'),
        zip: editDiv.find('.zip'),
        paystub_paydate_start: editDiv.find('.paystub_paydate_start'),
        job_period: editDiv.find('.job_period'),
        often_get_paid: editDiv.find('.often_get_paid'),
        paystub_paydate_recent: editDiv.find('.paystub_paydate_recent')
    };

    // Optional fields (can be empty)
    var optionalFields = {
        address_line_2: editDiv.find('.address_line_2'),
        notes: editDiv.find('.notes')
    };

    // Check for empty required fields
    for (var key in fields) {
        if (fields[key].val().trim() === "") {
            fields[key].focus();  // Focus on the first empty field
            console.log( fields[key]);
            return; // Stop execution
        }
    }

    // Update summary section with new values
    summaryDiv.find('.occupation').text(fields.occupation.val());
    summaryDiv.find('.name').text(fields.name.val());
    summaryDiv.find('.address_line_1').text(fields.address_line_1.val());
    summaryDiv.find('.city').text(fields.city.val());
    summaryDiv.find('.state').text(fields.state.val());
    summaryDiv.find('.zip').text(fields.zip.val());
    summaryDiv.find('.paystub_paydate_start').text(fields.paystub_paydate_start.val());
    summaryDiv.find('.job_period').text(fields.job_period.val());
    summaryDiv.find('.often_get_paid').text(fields.often_get_paid.val());
    summaryDiv.find('.paystub_paydate_recent').text(fields.paystub_paydate_recent.val());

    // Update optional fields (if they have a value)
    summaryDiv.find('.address_line_2').text(optionalFields.address_line_2.val() || "");
    summaryDiv.find('.notes').text(optionalFields.notes.val() || "");

    // Toggle visibility
    summaryDiv.removeClass('hide-data');
    editDiv.addClass('hide-data');

    // Update button states
    optionDiv.find('.edit-btn').removeClass('hide-data');
    optionDiv.find('.save-btn').addClass('hide-data');
}


function remove_current_employer_section( parentDivId, index ) {
    var employerLength = $('#'+parentDivId+' .current_employer_div').length;
    if (employerLength > 1) {
        $('#'+parentDivId).find('.current_employer_div').filter('[data-index="' + index + '"]').remove();
    }
    if (employerLength == 1) {
        $.systemMessage(
            "You cannot remove last employer entry.",
            "alert--danger"
        );
    }
}


function current_spouse_employed_obj(value) {
    if (value == "yes") {
        document.getElementById("employer_page_listing_div_spouse").classList.remove("hide-data");
        // document.getElementById("current_employed_obj_data_additional").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("employer_page_listing_div_spouse").classList.add("hide-data");
        // document.getElementById("current_employed_obj_data_additional").classList.add("hide-data");
    }
}



function getHiddenData(value) {
    if (value == "yes") {
        document.getElementById("condition-data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("condition-data").classList.add("hide-data");
    }
}

function getspouse_HiddenData(value) {
    if (value == "yes") {
        document
            .getElementById("spouse-condition-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("spouse-condition-data")
            .classList.add("hide-data");
    }
}

function getHiddenData730Days(value) {
    if (value == "no") {
        document
            .getElementById("least_730_condition_data")
            .classList.remove("hide-data");
    } else if (value == "yes") {
        document
            .getElementById("least_730_condition_data")
            .classList.add("hide-data");
    }
}

function getDiffMailAddress(value) {
    if (value == "yes") {
        document
            .getElementById("different_mailing_addresss")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("different_mailing_addresss")
            .classList.add("hide-data");
    }
}

function get_eviction_pending(value, index) {
    if (value == "yes") {
        $(".eviction_pending_data_"+index).removeClass("hide-data");       
    } else if (value == "no") {
        $(".eviction_pending_data_"+index).addClass("hide-data");       
    }
}

function checkPendingEviction(value, index) {
    if (value == "yes") {
        $(".eviction_pending_radio_"+index).removeClass("hide-data");
    } else if (value == "no") {
        $(".eviction_pending_radio_"+index).addClass("hide-data");
        $('input[name="property_resident[eviction_pending]['+index+']"][value="0"]').prop("checked", true);
        $(".eviction_pending_data_"+index).addClass("hide-data");        
    }
}

function get_used_business_ein(value) {
    if (value == "yes") {
        document
            .getElementById("get_used_business_ein")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("get_used_business_ein")
            .classList.add("hide-data");
    }
}
//// Section B  ////
// Steps
function submitFormSectionB() {
    document.getElementById("section2-tab").classList.remove("active");
    document.getElementById("section3-tab").classList.add("active");

    document.getElementById("section2").classList.remove("active", "show");
    document.getElementById("section3").classList.add("active", "show");
}

var sectionTwoNum = 0;

function changeSectionBStep(obj) {
    // console.log($(obj).parents('form').parent().attr('id'));
    $(obj).parents("form").parent().next(".hidestep").removeClass("hidestep");
    $(obj).parents("form").parent().addClass("hidestep");
}

function addOther_names() {
    var clnln = $(document).find(".other_name_frm").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    }

    var itm = $(document).find(".other_name_frm").last();
    var index_val = clnln; // Use clnln directly for the next index
    var cln = $(itm).clone();

    // Update class and delete button for new index
    cln.removeClass(function (index, className) {
        return (className.match(/other_name_frm_\d+/g) || []).join(' ');
    }).addClass("other_name_frm_" + index_val);

    cln.find(".delete-div").attr("onclick", "remove_div_common('other_name_frm', " + index_val + ")");

    // Update input fields with the correct name attributes
    cln.find(".circle-number-div").html(index_val + 1);

    cln.find(".any_other_fname").attr("name", "part1[any_other_name][name][" + index_val + "]").val("");
    cln.find(".any_other_mname").attr("name", "part1[any_other_name][middle_name][" + index_val + "]").val("");
    cln.find(".any_other_lname").attr("name", "part1[any_other_name][last_name][" + index_val + "]").val("");
    cln.find(".any_other_suffix").attr("name", "part1[any_other_name][suffix][" + index_val + "]").val("");

    // Clear text, number inputs, and selects
    cln.find('input[type="text"], input[type="number"]').val("");
    cln.find("select").val("");

    // Insert after last element
    $(itm).after(cln);
    reinitTooltips()
}

function reindexElements(parentClass) {
    $(document).find("." + parentClass).each(function (newIndex) {

        $(this).removeClass(function (index, className) {
            return (className.match(new RegExp(parentClass + "_\\d+", "g")) || []).join(' ');
        }).addClass(parentClass + "_" + newIndex);

        $(this).find(".circle-number-div").html(newIndex + 1);

        if(parentClass == 'all_dependents_form'){
            $(this).find(".delete-div").attr("onclick", `remove_div_common('${parentClass}', ${newIndex});updateAveragePrice();return false;`);
        }else{
            $(this).find(".delete-div").attr("onclick", `remove_div_common('${parentClass}', ${newIndex})`);
        }        

        $(this).find("input, select, textarea").each(function () {
            let nameAttr = $(this).attr("name");
            if (nameAttr) {
                let updatedName = nameAttr.replace(/\[\d+\]/, `[${newIndex}]`);
                $(this).attr("name", updatedName);
            }

            let idAttr = $(this).attr("id");
            if (idAttr) {
                let updatedId = idAttr.replace(/_\d+$/, `_${newIndex}`);
                $(this).attr("id", updatedId);
            }

            let onchangeAttr = $(this).attr("onchange");
            if (onchangeAttr) {
                let updatedOnchange = onchangeAttr.replace(/\(\d+\)/, `(${newIndex})`);
                $(this).attr("onchange", updatedOnchange);
            }
        });
    });
}

function reindexCircleNoElements(parentClass) {
    $(document).find("." + parentClass).each(function (newIndex) {
        $(this).find(".circle-number-div").html(newIndex + 1);
    });
}

function removeOtherNames() {
    var clnln = $(document).find(".other_name_frm").length;
    if (clnln > 1) {
        $(document).find(".other_name_frm").last().remove();
    }
    if (clnln == 2) {
        $(".remove-btn").hide();
    }
}

function removeOther() {
    var clnln = $(document).find(".spouse_other_name_frm").length;
    if (clnln > 1) {
        $(document).find(".spouse_other_name_frm").last().remove();
    }
    if (clnln == 2) {
        $(".remove-other-names").hide();
    }
}

/*my sumil code*/

function addOther_bankruptcy_clone() {
    var clnln = $(document).find(".bankruptcy_clone").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        $(".remove_bankruptcy_clone").show();
        var itm = $(document).find(".bankruptcy_clone").last();
        var index_val = $(itm).index() + 1;

        var remove_btn_index = itm
            .find("button.remove_bankruptcy_clone")
            .data("index");
        if (remove_btn_index > 0) {
            itm.find("button.remove_bankruptcy_clone").hide();
        }

        var cln = $(itm).clone();
        var case_filed_state = cln.find(".case_filed_state");
        var case_number = cln.find(".case_number");

        var case_date_filed = cln.find(".case_date_filed");
        /*var date_discharge = cln.find('.date_discharge');*/
        var is_case_dismissed = cln.find(".is_case_dismissed_option");
        /*var dismissed_date = cln.find('.dismissed_date');*/

        var filed_case_dismissed_data = cln.find(".dismiss_data_class");
        cln.find(".circle-number-div").html(index_val+1);
        cln.find("button.remove_bankruptcy_clone").attr(
            "data-index",
            index_val
        );
        cln.find("button.remove_bankruptcy_clone").show();

        $(filed_case_dismissed_data).each(function () {
            $(this).removeAttr("id");
            $(this).attr("id", "filed_case_dismissed_data" + index_val);
        });

        $(case_filed_state).each(function () {
            $(this).attr("name", "part3[case_filed_state][" + index_val + "]");
        });
        $(case_number).each(function () {
            $(this).attr("name", "part3[case_number][" + index_val + "]");
        });
        $(case_date_filed).each(function () {
            $(this).attr("name", "part3[date_filed][" + index_val + "]");
        });
        $(is_case_dismissed).each(function () {
            $(this).attr("name", "part3[is_case_dismissed][" + index_val + "]");
            $(this).prop("checked", false);

            if ($(this).val() == "0") {
                $(this).attr( "id", "is_case_dismissed_no_" + index_val );
                $(this).next("label").attr( "for", "is_case_dismissed_no_" + index_val );
            }

            if ($(this).val() == "1") {
                $(this).attr( "id", "is_case_dismissed_yes_" + index_val );
                $(this).next("label").attr( "for", "is_case_dismissed_yes_" + index_val );
            }
        });

        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/bankruptcy_clone_\d+/g) || []).join(' ');
        }).addClass("bankruptcy_clone_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('bankruptcy_clone', " + index_val + ")");

        cln.find('input[type="text"]').val("");
        cln.find("input[type=radio]").prop("checked", false);
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        cln.find("label").removeClass("active");
        $(itm).after(cln);
        //$('input[name="part3[is_case_dismissed][' + index_val + ']"]').trigger('change');
    }
}
// Shahid Code
function addOther_bankruptcybefore_clone() {
    var clnln = $(document).find(".any_bankruptcy_filed_before_data").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".any_bankruptcy_filed_before_data").last();

        var index_val = $(itm).index() + 1;

        var remove_btn_index = itm
            .find("button.bankruptcybefore_clone")
            .data("index");
        if (remove_btn_index > 0) {
            itm.find("button.bankruptcybefore_clone").hide();
        }

        var cln = $(itm).clone();
        var case_name = cln.find(".case_name");
        var case_numbers = cln.find(".case_numbers");
        var any_case_date_filed = cln.find(".any_case_date_filed");
        var date_discharged = cln.find(".date_discharged");
        var district_if_known = cln.find(".district_if_known");
        var dismissed_date = cln.find(".dismissed_date");

        var filed_case_dismissed_data = cln.find(".dismiss_data_class");

        cln.find("button.bankruptcybefore_clone").attr("data-index", index_val);
        cln.find("button.bankruptcybefore_clone").show();

        $(filed_case_dismissed_data).each(function () {
            $(this).removeAttr("id");
            $(this).attr("id", "filed_case_dismissed_data" + index_val);
        });
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(case_name).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_filed_before_data][case_name][" +
                    index_val +
                    "]"
            );
        });
        $(case_numbers).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_filed_before_data][case_numbers][" +
                    index_val +
                    "]"
            );
        });
        $(any_case_date_filed).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_filed_before_data][data_field][" +
                    index_val +
                    "]"
            );
        });
        $(date_discharged).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_filed_before_data][date_discharged][" +
                    index_val +
                    "]"
            );
        });

        $(district_if_known).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_filed_before_data][district_if_known][" +
                    index_val +
                    "]"
            );
        });
        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/any_bankruptcy_filed_before_data_\d+/g) || []).join(' ');
        }).addClass("any_bankruptcy_filed_before_data_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('any_bankruptcy_filed_before_data', " + index_val + ")");
        cln.find(".circle-number-div").html(index_val+1);
        $(itm).after(cln);
        $(".remove_bankruptcybefore_clone").show();
    }
}
// Shahid Code pending
function addOther_bankruptcypending_clone() {
    var clnln = $(document).find(".addOther_bankruptcypending_clone").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".addOther_bankruptcypending_clone").last();

        var index_val = $(itm).index() + 1;

        var remove_btn_index = itm.find("button.stepfourdelete").data("index");
        if (remove_btn_index > 0) {
            itm.find("button.remove_bankruptcypending_clone").hide();
        }

        var cln = $(itm).clone();
        var debtor_name = cln.find(".debtor_name");
        var relationship = cln.find(".relanship");
        var case_number = cln.find(".case_nmbr");
        var any_case_date_filed = cln.find(".pending_cae_file_date");
        var distrct = cln.find(".dsitrct");
        cln.find(".circle-number-div").html(index_val+1);
        cln.find("button.remove_bankruptcypending_clone").attr(
            "data-index",
            index_val
        );
        cln.find("button.remove_bankruptcypending_clone").show();

        $(debtor_name).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_cases_pending_data][debator_name][" +
                    index_val +
                    "]"
            );
        });
        $(relationship).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_cases_pending_data][your_relationship][" +
                    index_val +
                    "]"
            );
        });
        $(case_number).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_cases_pending_data][partner_case_number][" +
                    index_val +
                    "]"
            );
        });
        $(any_case_date_filed).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_cases_pending_data][partner_date_filed][" +
                    index_val +
                    "]"
            );
        });
        $(distrct).each(function () {
            $(this).attr(
                "name",
                "part3[any_bankruptcy_cases_pending_data][district][" +
                    index_val +
                    "]"
            );
        });

        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/addOther_bankruptcypending_clone_\d+/g) || []).join(' ');
        }).addClass("addOther_bankruptcypending_clone_" + index_val);

        cln.find(".delete-div").attr("onclick", "remove_div_common('addOther_bankruptcypending_clone', " + index_val + ")");
        
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(itm).after(cln);
        $(".remove_bankruptcypending_clone").show();
    }
}

// remove_bankruptcy_clone
$(document).on("click", ".remove_bankruptcy_clone", function () {
    var clnln = $(".bankruptcy_clone").length;
    if (clnln > 1) {
        $(".bankruptcy_clone").last().remove();
    }
    if (clnln == 2) {
        $(".remove_bankruptcy_clone").hide();
    }
});

//step2 part3
$(document).on("click", ".remove_bankruptcybefore_clone", function () {
    var clnln = $(".any_bankruptcy_filed_before_data").length;
    if (clnln > 1) {
        $(".any_bankruptcy_filed_before_data").last().remove();
    }
    if (clnln == 2) {
        $(this).hide();
    }
});

//pending fields deleteion

$(document).on("click", ".remove_bankruptcypending_clone", function () {
    var clnln = $(".addOther_bankruptcypending_clone").length;
    var itm = $(document).find(".addOther_bankruptcypending_clone").last();
    if (clnln > 1) {
        itm.remove();
    }
    if (clnln == 2) {
        $(".remove_bankruptcypending_clone").hide();
    }
});

//step 4 code

function updateDsDescDivShowHide(index, divClass,beinDiv) {
    var selectedValue = $(`select[name="used_business_ein_data[type][${index}]"]`).val();
    var $divElement = $('.' + divClass);
    var $eindivElement = $('.' + beinDiv);
    if (selectedValue == '3') {
        $divElement.removeClass('hide-data');
        $eindivElement.addClass('hide-data');

    } else {
        $divElement.addClass('hide-data');
        $eindivElement.removeClass('hide-data');
    }
}

function updateDsDescDivShowHideAffairs(index, divClass,beinDiv) {
    var selectedValue = $(`select[name="list_nature_business_data[type][${index}]"]`).val();
    var $divElement = $('.' + divClass);
    var $eindivElement = $('.' + beinDiv);
    if (selectedValue == '3') {
        $divElement.removeClass('hide-data');
        $eindivElement.addClass('hide-data');

    } else {
        $divElement.addClass('hide-data');
        $eindivElement.removeClass('hide-data');
    }
}


function stepfour() {
    let indexR = 1;
    var clnln = $(document).find(".stepfour_clone").length;
    
    if (clnln > 5) {
        $.systemMessage('You can only insert 6 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".stepfour_clone").last();
        var index_val = clnln;
        var cln = $(itm).clone();
        var businessname = cln.find(".own_business_name");
         var nature_of_business = cln.find(".nature_of_business");
        var case_number = cln.find(".own_ein_no");
        var doesntHaveEin = cln.find(".doesntHaveEin");
        var business_still_open = cln.find(".business_still_open");
        var own_business_selection = cln.find(".own_business_selection");
        var street_number = cln.find(".street_number");
        var city = cln.find(".city");
        var state = cln.find(".state");
        var zip = cln.find(".zip");
        var operation_date = cln.find(".operation_date");
        var operation_date2 = cln.find(".operation_date2");
        var bussiness_type = cln.find(".bussiness_type");
        var business_still_open_data = cln.find(".business_still_open_data");
       
      
        
        var traded_stocks_type_of_account = cln.find(".traded_stocks_type_of_account_step");
        var traded_stocks_property_value = cln.find(".traded_stocks_property_value_step");
        var bsDescDiv = cln.find(".bsDescDiv");
        var beinDiv = cln.find(".beinDiv");
        var bsDesc = cln.find(".des_cbussiness_type");
        cln.find("select").val("");
        $(traded_stocks_type_of_account).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[type_of_account][" + index_val + "]"
            );
        });
        $(traded_stocks_property_value).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[property_value][" + index_val + "]"
            );
        });
        $(bussiness_type).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[type][" + index_val + "]"
            );
            $(this).attr(
                "onchange",
                "updateDsDescDivShowHide('" + index_val + "', 'bsDescDiv_" + index_val + "', 'beinDiv_" + index_val + "')"
            );
        });

        $(bsDescDiv).each(function () {
            var prev_val = (index_val-1);
            $(this).removeClass("bsDescDiv_" + prev_val).addClass("bsDescDiv_" + index_val + " hide-data");
        });
        $(beinDiv).each(function () {
            var prev_val = (index_val-1);
            $(this).removeClass("beinDiv_" + prev_val).addClass("beinDiv_" + index_val + "");
        });

        $(business_still_open_data).each(function () {
            var prev_val = (index_val-1);
            $(this).removeClass("business_still_open_data_" + prev_val).addClass("business_still_open_data_" + index_val + " hide-data");
        });

        $(bsDesc).each(function () {
            
            $(this).attr('name', 'used_business_ein_data[businessDescription][' + index_val + ']');
           
        });

        $(businessname).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[own_business_name][" + index_val + "]"
            );
        });

        $(nature_of_business).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[nature_of_business][" + index_val + "]"
            );
        });

        $(street_number).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[street_number][" + index_val + "]"
            );
        });

        $(city).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[city][" + index_val + "]"
            );
        });

        $(state).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[state][" + index_val + "]"
            );
        });

        $(zip).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[zip][" + index_val + "]"
            );
        });

        $(operation_date).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[operation_date][" + index_val + "]"
            );
            $(this).removeClass("hasDatepicker").attr("id", "");
        });

        $(operation_date2).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[operation_date2][" + index_val + "]"
            );
            $(this).removeClass("hasDatepicker").attr("id", "");
        });

        $(doesntHaveEin).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[doesntHaveEin][" + index_val + "]"
            );
        });

        $(business_still_open).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[business_still_open][" +
                index_val +
                "]"
            );
            $(this).attr("onchange", "checkBizend(this," + index_val + ")");
        });

        $(own_business_selection).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[own_business_selection][" +
                    index_val +
                    "]"
            );
        });
        $(case_number).each(function () {
            $(this).attr(
                "name",
                "used_business_ein_data[own_ein_no][" + index_val + "]"
            );
        });
        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/stepfour_clone_\d+/g) || []).join(' ');
        }).addClass("stepfour_clone_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('stepfour_clone', " + index_val + ")");
        cln.find(".circle-number-div").html(index_val+1);
        cln.find('input[type="text"]').val("");
        cln.find('input[type="checkbox"]').prop("checked", false);
        cln.find('input[type="number"]').val("");
        cln.find('input[type="text"]').prop("disabled", false);
        $(itm).after(cln);
        initializeDatepicker();
        indexR++;
    }
}

var count2 = 3;
$(document).on("click", ".step5-yes", function () {
    $("#stepp5").show();
    $("#stepp5").removeClass("hide-data");
});
$(document).on("click", ".step5-No", function () {
    $("#stepp5").hide();
    $("#stepp5").addClass("hide-data");
});

$(document).on("click", ".step5-yes-step5", function () {
    $("#stepp5-step5").show();
    $("#stepp5-step5").removeClass("hide-data");
});
$(document).on("click", ".step5-No-step5", function () {
    $("#stepp5-step5").hide();
    $("#stepp5-step5").addClass("hide-data");
});

//step4 delete

$(document).on("click", ".stepfourdelete", function () {
    var clnln = $(".stepfour_child_div").length;
    var itm = $(document).find(".stepfour_child_div").last();
    if (clnln > 1) {
        itm.remove();
    }
    if (clnln == 2) {
        $(".stepfourdelete").hide();
    }
});
/*over*/

function spouse_addOther_names() {
    var clnln = $(document).find(".spouse_other_name_frm").length;
    if (clnln > 2) {
        $.systemMessage('You can only insert 3 entries.', 'alert--danger', true);
        return false;
    } else {
        $(".remove-other-names").show();
        var itm = $(document).find(".spouse_other_name_frm").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();
        var spouse_other_name = cln.find(".spouse_other_name");
        var spouse_other_suffix = cln.find(".spouse_other_suffix");
        var spouse_other_middle_name = cln.find(".spouse_other_middle_name");
        var spouse_other_last_name = cln.find(".spouse_other_last_name");
        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/spouse_other_name_frm_\d+/g) || []).join(' ');
        }).addClass("spouse_other_name_frm_" + index_val);

        cln.find(".delete-div").attr("onclick", "remove_div_common('spouse_other_name_frm', " + index_val + ")");

        cln.find(".circle-number-div").html(index_val+1);
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(spouse_other_name).each(function () {
            $(this).attr("name", "part2[spouse_other_name][" + index_val + "]");
        });
        $(spouse_other_suffix).each(function () {
            $(this).attr(
                "name",
                "part2[spouse_other_suffix][" + index_val + "]"
            );
        });
        $(spouse_other_middle_name).each(function () {
            $(this).attr(
                "name",
                "part2[spouse_other_middle_name][" + index_val + "]"
            );
        });
        $(spouse_other_last_name).each(function () {
            $(this).attr(
                "name",
                "part2[spouse_other_last_name][" + index_val + "]"
            );
        });
        $('select[name="part2[spouse_other_suffix][' + index_val + ']"]').val(
            ""
        );
        $(itm).after(cln);
    }
    reinitTooltips()
}


async function addResidenceForm(saveFromAttorney=false) {
    var saveData =  await saveResident(true, {},false,saveFromAttorney);
    if (saveData == false) {
        return false;
    }
    var clnln = $(document).find(".residence_property_main_div").length;
    if (clnln > 4) {
        $.systemMessage('You can only insert 5 properties.', "alert--danger", true);
        return false;
    } else {
        var itm = $(document).find(".residence_property_main_div").last();
        var index_val = clnln;

        prevIndex = index_val-1;
        nextIndex = index_val+1;
        var cln = $(itm).clone();

        let parentDivClass = 'residence_property_main_div';
        cln.removeClass(function (index, className) {
            return (className.match(parentDivClass + "_\\d+", "g") || []).join(' ');
        }).addClass(parentDivClass + "_" + index_val);
        cln.find(".circle-number-div").html(index_val + 1);
        cln.find(".client-edit-button").attr("onclick", "display_resident_div('"+index_val+"', )");     

        let security_deposit_circle_no = cln.find(".circle-number-div.security_deposit");
        $(security_deposit_circle_no).each(function (index) {
            $(this).html(index+1);
        });

        cln.find("label").removeClass("active");

        $(document)
            .find(".residence_form_summary_" + index_val)
            .removeClass("hide-data");
        $(".residence_form" + index_val).addClass("hide-data");
        cln.find(".residence_form_summary").addClass("hide-data");
        cln.find(".residence_form").removeClass("hide-data");
        if (index_val > 0) {
            cln.find(".important-r").addClass("hide-data");
        }
        var owned_by = cln.find(".property_owned_by");
        var address = cln.find(".address");
        var mortgage_name = cln.find(".mortgage_name");
        var not_primary_address = cln.find(".not_primary_address");
        var mortgage_address = cln.find(".mortgage_address");
        var mortgage_city = cln.find(".mortgage_city");
        var mortgage_state = cln.find(".mortgage_state");
        var mortgage_zip = cln.find(".mortgage_zip");
        var mortgage_county = cln.find(".mortgage_county");
        var mortgage_loan = cln.find(".mortgage_loan");
        var mortgage_loan_rate = cln.find(".mortgage_loan_rate");
        var payments_left = cln.find(".payments_left");
        var estimated_property_value = cln.find(".estimated_property_value");

        var bedroom = cln.find(".bedroom");
        var bathroom = cln.find(".bathroom");
        var home_sq_ft = cln.find(".home_sq_ft");
        var lot_size_acres = cln.find(".lot_size_acres");
        var property_other_input = cln.find(".property_other_input");

        var saveBtn = cln.find(".save-btn");
        var trashBtn = cln.find(".trash-btn");
        var residence_property_main_div = cln.find(".residence_property_main_div");
        var residence_form_summary = cln.find(".residence_form_summary");
        var residence_form = cln.find(".residence_form");
        var property_mortgage_section = cln.find(".property_mortgage_section");
        // div
        var main_property_section = cln.find(".main-property-section");

        $(main_property_section).each(function () {
            $(this).removeClass("main-property-section-" + prevIndex)
                .addClass("main-property-section-" + index_val);
        });

        cln.find(".currently_lived_data").addClass(" hide-data ");
        cln.find(".resident_rent_data").addClass(" hide-data ");

        cln.find(".poperty-type-div-" + prevIndex)
            .removeClass("poperty-type-div-" + prevIndex)
            .addClass("poperty-type-div-" + index_val + " hide-data ");
        cln.find(".description-div-" + prevIndex)
            .removeClass("description-div-" + prevIndex)
            .addClass("description-div-" + index_val + " d-none ");
        cln.find(".description-and-lot-size-div-" + prevIndex)
            .removeClass("description-and-lot-size-div-" + prevIndex)
            .addClass("description-and-lot-size-div-" + index_val + " d-none ");
        cln.find(".estimated-value-div-" + prevIndex)
            .removeClass("estimated-value-div-" + prevIndex)
            .addClass("estimated-value-div-" + index_val + " hide-data ");
        cln.find(".loan-div-" + prevIndex)
            .removeClass("loan-div-" + prevIndex)
            .addClass("loan-div-" + index_val + " hide-data ");
        cln.find(".loan-1-div-" + prevIndex)
            .removeClass("loan-1-div-" + prevIndex)
            .addClass("loan-1-div-" + index_val);
        cln.find(".loan-2-div-" + prevIndex)
            .removeClass("loan-2-div-" + prevIndex)
            .addClass("loan-2-div-" + index_val);
        cln.find(".loan-2-main-div-" + prevIndex)
            .removeClass("loan-2-main-div-" + prevIndex)
            .addClass("loan-2-main-div-" + index_val + " hide-data ");
        cln.find(".loan-3-main-div-" + prevIndex)
            .removeClass("loan-3-main-div-" + prevIndex)
            .addClass("loan-3-main-div-" + index_val + " hide-data ");
        cln.find(".payment_not_primary_address_data").addClass(" hide-data ");
        cln.find(".property_codebtor_cosigner_data").addClass(" hide-data ");
        cln.find(".loan_own_type_property_sec").addClass(" hide-data ");
        cln.find(".section_additional_loan").addClass(" hide-data ");
        cln.find(".section_additional_loan_second").addClass(" hide-data ");

        cln.find(".eviction_pending_radio_" + prevIndex).removeClass("eviction_pending_radio_" + prevIndex).addClass("eviction_pending_radio_" + index_val + " hide-data ");
        cln.find(".eviction_pending_data_" + prevIndex).removeClass("eviction_pending_data_" + prevIndex).addClass("eviction_pending_data_" + index_val + " hide-data ");

        var rented_residence_cc = cln.find(".rented_residence_cc");
        var eviction_pending_cc = cln.find(".eviction_pending_cc");

        var ep_data_name = cln.find('.ep_data_name');
        var ep_data_address = cln.find('.ep_data_address');
        var ep_data_city = cln.find('.ep_data_city');
        var ep_data_state = cln.find('.ep_data_state');
        var ep_data_zip = cln.find('.ep_data_zip');

        var get_property_residence_details_by_graphql = cln.find(".get-property-details-by-graphql");

        $(get_property_residence_details_by_graphql).attr('onclick', "getPropertyResidenceDetailsByGraphQL("+index_val+")");

        $(rented_residence_cc).each(function () {
            $(this).attr('name', 'property_resident[rented_residence]['+index_val+']');
            if ($(this).val() == "0") {
                $(this).attr('onchange', "checkPendingEviction('no', '"+index_val+"')");
            }
            if ($(this).val() == "1") {
                $(this).attr('onchange', "checkPendingEviction('yes', '"+index_val+"')");
            }
        });

        $(eviction_pending_cc).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending]['+index_val+']');

            if ($(this).val() == "0") {
                $(this).attr( "id", "eviction-pending-no-" + index_val );
                $(this).next("label").attr( "for", "eviction-pending-no-" + index_val ).attr('onclick', "get_eviction_pending('no', '"+index_val+"')");
            }

            if ($(this).val() == "1") {
                $(this).attr( "id", "eviction-pending-yes-" + index_val );
                $(this).next("label").attr( "for", "eviction-pending-yes-" + index_val ).attr('onclick', "get_eviction_pending('yes', '"+index_val+"')");
            }
        });

        $(ep_data_name).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data]['+index_val+'][Name]');
        });

        $(ep_data_address).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data]['+index_val+'][Address]');
        });

        $(ep_data_city).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data]['+index_val+'][City]');
        });

        $(ep_data_state).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data]['+index_val+'][State]');
        });

        $(ep_data_zip).each(function () {
            $(this).attr('name', 'property_resident[eviction_pending_data]['+index_val+'][Zip]');
        });


        $(residence_property_main_div).each(function () {
            $(this).removeClass("residence_property_main_div_" + prevIndex)
                .addClass("residence_property_main_div_" + index_val);
                
        });

        $(residence_form_summary).each(function () {
            $(this).removeClass("residence_form_summary_" + prevIndex)
                .addClass("residence_form_summary_" + index_val);
        });
        $(residence_form).each(function () {
            $(this).removeClass("residence_form_" + prevIndex)
                .addClass("residence_form_" + index_val);
        });

        $(saveBtn).each(function () {
            if(!saveFromAttorney){
                $(this).attr(
                    "onclick",
                    'saveResident(true,this,true,false);'
                );
            } else {
                $(this).attr(
                    "onclick",
                    'saveResident(true,this,true,true);'
                );
            }
            
        });

        $(trashBtn).each(function () {
            if(!saveFromAttorney){
                $(this).attr(
                    "onclick",
                    "remove_resident_div(" + (index_val) + ", false);"
                );
            } else {
                $(this).attr(
                    "onclick",
                    "remove_resident_div(" + (index_val) + ", true);"
                );
            }
        });

        $(bedroom).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                    index_val +
                    "][bedroom]"
            );
            $(this).attr( "data-index", index_val );
        });
        $(bathroom).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                    index_val +
                    "][bathroom]"
            );
            $(this).attr( "data-index", index_val );
        });
        $(home_sq_ft).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                    index_val +
                    "][home_sq_ft]"
            );
            $(this).attr( "data-index", index_val );
        });
        $(lot_size_acres).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_description][" +
                    index_val +
                    "][lot_size_acres]"
            );
            $(this).attr( "data-index", index_val );
        });



        var monthly_payment = cln.find(".monthly_payment");
        var property = cln.find(".property");
        var taxes_insurance = cln.find(".taxes_insurance");
        var currently_lived = cln.find(".currently_lived").addClass("required"); /// added to show validation error on property tab

        var retain_above_property = cln.find(".retain_above_property");

        var doclink1 = cln.find(".loan1-d-link");
        var doclink2 = cln.find(".loan2-d-link");
        var doclink3 = cln.find(".loan3-d-link");

        var doccard1 = cln.find(".loan1-d-card");
        var doccard2 = cln.find(".loan2-d-card");
        var doccard3 = cln.find(".loan3-d-card");

        $(doccard1).each(function () {
            $(this).text("Current Mortgage Statement 1 of " + (index_val + 1));
        });
        $(doccard2).each(function () {
            $(this).text("Current Mortgage Statement 2 of " + (index_val + 1));
        });
        $(doccard3).each(function () {
            $(this).text("Current Mortgage Statement 3 of " + (index_val + 1));
        });

        $(doclink1).each(function () {
            $(this).attr(
                "title",
                "Current_Mortgage_Statement_1_" + (index_val + 1)
            );
        });
        $(doclink2).each(function () {
            $(this).attr(
                "title",
                "Current_Mortgage_Statement_2_" + (index_val + 1)
            );
        });
        $(doclink3).each(function () {
            $(this).attr(
                "title",
                "Current_Mortgage_Statement_3_" + (index_val + 1)
            );
        });

        //home loan section
        var loan_own_type_property = cln.find(".loan_own_type_property");
        var vehicle_amount_own = cln.find(".vehicle_amount_own");
        var vehicle_account_number = cln.find(".vehicle_account_number");
        var vehicle_debt_incurred_date = cln.find(
            ".vehicle_debt_incurred_date"
        );
        var vehicle_creditor_name = cln.find(".mortgage_vehicle_creditor_name");
        var vehicle_creditor_name_addresss = cln.find(
            ".vehicle_creditor_name_addresss"
        );
        var vehicle_creditor_city = cln.find(".vehicle_creditor_city");
        var vehicle_creditor_state = cln.find(".vehicle_creditor_state");
        var vehicle_creditor_zip = cln.find(".vehicle_creditor_zip");
        var vehicle_payment_tax_insurance = cln.find(
            ".vehicle_payment_tax_insurance"
        );
        var vehicle_monthly_payment = cln.find(".vehicle_monthly_payment");
        var vehicle_payment_remaining = cln.find(".vehicle_payment_remaining");
        var vehicle_debt_owned_by = cln.find(".vehicle_debt_owned_by");
        var vehicle_codebtor = cln.find(".vehicle_codebtor");
        var vehicle_codebtor_info = cln.find(".vehicle_codebtor_info");
        var vehicle_due_payment = cln.find(".vehicle_due_payment");
        var vehicle_current_interest_rate = cln.find(
            ".vehicle_current_interest_rate"
        );

        var three_month_mortgage_1 = cln.find(".three_month_mortgage_1");
        var three_month_mortgage_2 = cln.find(".three_month_mortgage_2");
        var three_month_mortgage_3 = cln.find(".three_month_mortgage_3");
        var three_months_div = cln.find(".three_months_div");
        var additional_three_months_div = cln.find(
            ".additional_three_months_div"
        );
        var second_additional_three_months_div = cln.find(
            ".second_additional_three_months_div"
        );

        var payment_1_of_1 = cln.find(".payment_1_of_1");
        var payment_2_of_1 = cln.find(".payment_2_of_1");
        var payment_3_of_1 = cln.find(".payment_3_of_1");
        var payment_1_of_2 = cln.find(".payment_1_of_2");
        var payment_2_of_2 = cln.find(".payment_2_of_2");
        var payment_3_of_2 = cln.find(".payment_3_of_2");
        var payment_1_of_3 = cln.find(".payment_1_of_3");
        var payment_2_of_3 = cln.find(".payment_2_of_3");
        var payment_3_of_3 = cln.find(".payment_3_of_3");
        var payment_dates_1_of_1 = cln.find(".payment_dates_1_of_1");
        var payment_dates_2_of_1 = cln.find(".payment_dates_2_of_1");
        var payment_dates_3_of_1 = cln.find(".payment_dates_3_of_1");
        var payment_dates_1_of_2 = cln.find(".payment_dates_1_of_2");
        var payment_dates_2_of_2 = cln.find(".payment_dates_2_of_2");
        var payment_dates_3_of_2 = cln.find(".payment_dates_3_of_2");
        var payment_dates_1_of_3 = cln.find(".payment_dates_1_of_3");
        var payment_dates_2_of_3 = cln.find(".payment_dates_2_of_3");
        var payment_dates_3_of_3 = cln.find(".payment_dates_3_of_3");
        var total_amount_paid_1_of_1 = cln.find(".total_amount_paid_1_of_1");
        var total_amount_paid_1_of_2 = cln.find(".total_amount_paid_1_of_2");
        var total_amount_paid_1_of_3 = cln.find(".total_amount_paid_1_of_3");

        var loan_property_owned_by = cln.find(".loan_property_owned_by");
        var loan_cosigner_vehicle_creditor_name = cln.find(
            ".loan_cosigner_vehicle_creditor_name"
        );
        var loan_cosigner_vehicle_creditor_name_addresss = cln.find(
            ".loan_cosigner_vehicle_creditor_name_addresss"
        );
        var loan_cosigner_vehicle_creditor_city = cln.find(
            ".loan_cosigner_vehicle_creditor_city"
        );
        var loan_cosigner_vehicle_creditor_state = cln.find(
            ".loan_cosigner_vehicle_creditor_state"
        );
        var loan_cosigner_vehicle_creditor_zip = cln.find(
            ".loan_cosigner_vehicle_creditor_zip"
        );

        var loan2_property_owned_by = cln.find(".loan2_property_owned_by");
        var loan2_cosigner_vehicle_creditor_name = cln.find(
            ".loan2_cosigner_vehicle_creditor_name"
        );
        var loan2_cosigner_vehicle_creditor_name_addresss = cln.find(
            ".loan2_cosigner_vehicle_creditor_name_addresss"
        );
        var loan2_cosigner_vehicle_creditor_city = cln.find(
            ".loan2_cosigner_vehicle_creditor_city"
        );
        var loan2_cosigner_vehicle_creditor_state = cln.find(
            ".loan2_cosigner_vehicle_creditor_state"
        );
        var loan2_cosigner_vehicle_creditor_zip = cln.find(
            ".loan2_cosigner_vehicle_creditor_zip"
        );

        var loan3_property_owned_by = cln.find(".loan3_property_owned_by");
        var loan3_cosigner_vehicle_creditor_name = cln.find(
            ".loan3_cosigner_vehicle_creditor_name"
        );
        var loan3_cosigner_vehicle_creditor_name_addresss = cln.find(
            ".loan3_cosigner_vehicle_creditor_name_addresss"
        );
        var loan3_cosigner_vehicle_creditor_city = cln.find(
            ".loan3_cosigner_vehicle_creditor_city"
        );
        var loan3_cosigner_vehicle_creditor_state = cln.find(
            ".loan3_cosigner_vehicle_creditor_state"
        );
        var loan3_cosigner_vehicle_creditor_zip = cln.find(
            ".loan3_cosigner_vehicle_creditor_zip"
        );

        var loan2_vehicle_amount_own = cln.find(".loan2_vehicle_amount_own");
        var loan2_vehicle_account_number = cln.find(
            ".loan2_vehicle_account_number"
        );
        var loan2_vehicle_debt_incurred_date = cln.find(
            ".loan2_vehicle_debt_incurred_date"
        );
        var loan2_vehicle_monthly_payment = cln.find(
            ".loan2_vehicle_monthly_payment"
        );
        var loan2_vehicle_creditor_name = cln.find(
            ".loan2_vehicle_creditor_name"
        );
        var loan2_vehicle_creditor_name_addresss = cln.find(
            ".loan2_vehicle_creditor_name_addresss"
        );
        var loan2_vehicle_creditor_city = cln.find(
            ".loan2_vehicle_creditor_city"
        );
        var loan2_vehicle_creditor_state = cln.find(
            ".loan2_vehicle_creditor_state"
        );
        var loan2_vehicle_creditor_zip = cln.find(
            ".loan2_vehicle_creditor_zip"
        );
        var loan2_vehicle_payment_remaining = cln.find(
            ".loan2_vehicle_payment_remaining"
        );
        var loan2_vehicle_payment_tax_insurance = cln.find(
            ".loan2_vehicle_payment_tax_insurance"
        );
        var additional_loan1 = cln.find(".additional_loan1");
        var loan2_vehicle_due_payment = cln.find(".loan2_vehicle_due_payment");
        var loan2_vehicle_current_interest_rate = cln.find(
            ".loan2_vehicle_current_interest_rate"
        );

        var loan3_vehicle_amount_own = cln.find(".loan3_vehicle_amount_own");
        var loan3_vehicle_account_number = cln.find(
            ".loan3_vehicle_account_number"
        );
        var loan3_vehicle_debt_incurred_date = cln.find(
            ".loan3_vehicle_debt_incurred_date"
        );
        var loan3_vehicle_monthly_payment = cln.find(
            ".loan3_vehicle_monthly_payment"
        );
        var loan3_vehicle_creditor_name = cln.find(
            ".loan3_vehicle_creditor_name"
        );
        var loan3_vehicle_creditor_name_addresss = cln.find(
            ".loan3_vehicle_creditor_name_addresss"
        );
        var loan3_vehicle_creditor_city = cln.find(
            ".loan3_vehicle_creditor_city"
        );
        var loan3_vehicle_creditor_state = cln.find(
            ".loan3_vehicle_creditor_state"
        );
        var loan3_vehicle_creditor_zip = cln.find(
            ".loan3_vehicle_creditor_zip"
        );
        var loan3_vehicle_payment_remaining = cln.find(
            ".loan3_vehicle_payment_remaining"
        );
        var loan3_vehicle_payment_tax_insurance = cln.find(
            ".loan3_vehicle_payment_tax_insurance"
        );
        var additional_loan2 = cln.find(".additional_loan2");

        var loan3_vehicle_current_interest_rate = cln.find(
            ".loan3_vehicle_current_interest_rate"
        );
        var loan3_vehicle_due_payment = cln.find(".loan3_vehicle_due_payment");

        var residence_rent = cln.find(".residence_rent");

        $(residence_rent).each(function () {
            $(this).attr("name", "property_resident[rent][" + index_val + "]");
        });

        $(loan2_vehicle_payment_tax_insurance).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][payment_tax_insurance][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr(
                    "id",
                    "loan2_vehicle_payment_tax_insurance_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "loan2_vehicle_payment_tax_insurance_no_" + index_val
                    );
            }
            if ($(this).val() == "2") {
                $(this).attr(
                    "id",
                    "loan2_vehicle_payment_tax_insurance_yes_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "loan2_vehicle_payment_tax_insurance_yes_" + index_val
                    );
            }
        });
        $(loan2_vehicle_monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][monthly_payment][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_payment_remaining).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][payment_remaining][" +
                    index_val +
                    "]"
            );
        });

        $(loan2_vehicle_amount_own).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][amount_own][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_vehicle_account_number).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][account_number][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_debt_incurred_date).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][debt_incurred_date][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
            $(this).removeClass("hasDatepicker").attr("id", "");
        });
        $(loan2_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_name][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_name_addresss][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_city][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_state][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][creditor_zip][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_current_interest_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][current_interest_rate][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(loan2_vehicle_due_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][due_payment][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan3_vehicle_payment_tax_insurance).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][payment_tax_insurance][" +
                    index_val +
                    "]"
            );
            if ($(this).val() == "1") {
                $(this).attr("id", "loan3_vehicle_payment_tax_insurance_no_" + index_val);
                $(this).next("label").attr("for", "loan3_vehicle_payment_tax_insurance_no_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "loan3_vehicle_payment_tax_insurance_yes_" + index_val);
                $(this).next("label").attr("for", "loan3_vehicle_payment_tax_insurance_yes_" + index_val);
            }
        });
        $(loan3_vehicle_monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][monthly_payment][" +
                    index_val +
                    "]"
            );
        });
        $(loan3_vehicle_payment_remaining).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][payment_remaining][" +
                    index_val +
                    "]"
            );
        });

        $(loan3_vehicle_amount_own).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][amount_own][" +
                    index_val +
                    "]"
            );
        });

        $(loan3_vehicle_account_number).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][account_number][" +
                    index_val +
                    "]"
            );
        });
        $(loan3_vehicle_debt_incurred_date).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][debt_incurred_date][" +
                    index_val +
                    "]"
            );
            $(this).removeClass("hasDatepicker").attr("id", "");
        });
        $(loan3_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_name][" +
                    index_val +
                    "]"
            );
        });
        $(loan3_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_name_addresss][" +
                    index_val +
                    "]"
            );
        });
        $(loan3_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_city][" +
                    index_val +
                    "]"
            );
        });
        $(loan3_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_state][" +
                    index_val +
                    "]"
            );
        });
        $(loan3_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][creditor_zip][" +
                    index_val +
                    "]"
            );
        });

        $(loan3_vehicle_current_interest_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][current_interest_rate][" +
                    index_val +
                    "]"
            );
        });
        $(loan3_vehicle_due_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][due_payment][" +
                    index_val +
                    "]"
            );
        });

        $(property).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[property][" + index_val + "]"
            );
           
            $(this).next("label").attr("for", $(this).attr("id"));
            $(this).attr( "data-index", index_val );
        });
        $(property_other_input).each(function () {
            $(this).attr(
                "name",
                "property_resident[property_other_name][" + index_val + "]"
            );
            $(this).attr( "data-index", index_val );
            if (!$(this).hasClass("d-none")) {
                $(this).addClass("d-none");
            }
        });
        $(address).each(function () {
            $(this).attr(
                "name",
                "property_resident[address][" + index_val + "]"
            );
        });
        $(mortgage_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_name][" + index_val + "]"
            );
        });
        $(not_primary_address).each(function () {
            $(this).attr(
                "name",
                "property_resident[not_primary_address][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr(
                    "id",
                    "payment_not_primary_address_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr("for", "payment_not_primary_address_no_" + index_val)
                    .attr("data-index", index_val);
            }
            if ($(this).val() == "0") {
                $(this).attr(
                    "id",
                    "payment_not_primary_address_yes_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "payment_not_primary_address_yes_" + index_val
                    )
                    .attr("data-index", index_val);
            }
        });
        $(retain_above_property).each(function () {
            $(this).attr(
                "name",
                "property_resident[retain_above_property][" + index_val + "]"
            );
            if ($(this).val() == "1") {
                $(this).attr("id", "retain_above_property_yes_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "retain_above_property_yes_" + index_val);
            }
            if ($(this).val() == "0") {
                $(this).attr("id", "retain_above_property_no_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "retain_above_property_no_" + index_val);
            }
        });
        $(mortgage_address).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_address][" + index_val + "]"
            );
            $(this).attr( "data-index", index_val );
        });
        $(mortgage_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_city][" + index_val + "]"
            );
            $(this).attr( "data-index", index_val );
        });
        $(mortgage_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_state][" + index_val + "]"
            );
            $(this).attr("id", "mortgage_state_" + index_val);
            $(this).attr("data-countyid", "mortgage_county_" + index_val);
            $(this).attr( "data-index", index_val );
        });
        $(mortgage_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_zip][" + index_val + "]"
            );
            $(this).attr( "data-index", index_val );
        });
        $(mortgage_county).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_county][" + index_val + "]"
            );
            $(this).attr("id", "mortgage_county_" + index_val);
            $(this).attr( "data-index", index_val );
        });
        $(mortgage_loan).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_loan][" + index_val + "]"
            );
        });
        $(mortgage_loan_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[mortgage_loan_rate][" + index_val + "]"
            );
        });
        $(monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[monthly_payment][" + index_val + "]"
            );
        });
        $(payments_left).each(function () {
            $(this).attr(
                "name",
                "property_resident[payments_left][" + index_val + "]"
            );
        });
        $(estimated_property_value).each(function () {
            $(this).attr(
                "name",
                "property_resident[estimated_property_value][" + index_val + "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(taxes_insurance).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[taxes_insurance][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(currently_lived).each(function () {
            $(this).attr("id", $(this).attr("id") + "_" + index_val);
            $(this).attr(
                "name",
                "property_resident[currently_lived][" + index_val + "]"
            );
            $(this).attr("checked", false); /// added to show validation error on property tab
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(owned_by).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[property_owned_by][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        //Home loan
        cln.find('input[type="text"]').val("");
        cln.find('input[type="radio"]').prop("checked", false);
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");

        $(vehicle_amount_own).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][amount_own][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_account_number).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][account_number][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_debt_incurred_date).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][debt_incurred_date][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
            $(this).removeClass("hasDatepicker").attr("id", "");
        });
        $(vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_name][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_name_addresss][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_city][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_state][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][creditor_zip][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_current_interest_rate).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][current_interest_rate][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_due_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][due_payment][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        // for loan 1
        $(three_month_mortgage_1).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][is_mortgage_three_months][" +
                    index_val +
                    "]"
            );
            if ($(this).val() == "1") {
                $(this).next('label').attr(
                    "onclick",
                    "isThreeMonthsCommon('yes','three_months_div_" + index_val + "'); isMortgageThreeMonth('yes'," + index_val + ")"
                );
                $(this).attr("id", "is_mortgage_three_months_yes_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "is_mortgage_three_months_yes_" + index_val);
            }
            if ($(this).val() == "0") {
                $(this).next('label').attr(
                    "onclick",
                    "isThreeMonthsCommon('no','three_months_div_" + index_val + "'); isMortgageThreeMonth('no'," + index_val + ")"
                );
                $(this).attr("id", "is_mortgage_three_months_no_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "is_mortgage_three_months_no_" + index_val);
            }
            $(this).attr("data-index", index_val);
        });
        $(payment_1_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_1][" + index_val + "]"
        );
        $(payment_1_of_1).attr("data-index", index_val);
        $(payment_2_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_2][" + index_val + "]"
        );
        $(payment_2_of_1).attr("data-index", index_val);
        $(payment_3_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_3][" + index_val + "]"
        );
        $(payment_3_of_1).attr("data-index", index_val);
        $(payment_dates_1_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_dates_1][" +
                index_val +
                "]"
        );
        $(payment_dates_2_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_dates_2][" +
                index_val +
                "]"
        );
        $(payment_dates_3_of_1).attr(
            "name",
            "property_resident[home_car_loan][payment_dates_3][" +
                index_val +
                "]"
        );
        $(total_amount_paid_1_of_1).attr(
            "name",
            "property_resident[home_car_loan][total_amount_paid][" +
                index_val +
                "]"
        );
        // for loan 2
        $(three_month_mortgage_2).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][is_mortgage_three_months][" +
                    index_val +
                    "]"
            );
            if ($(this).val() == "1") {
                $(this).next('label').attr( "onclick", "isThreeMonthsCommon('yes','additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional1('yes'," + index_val + ")" );
                $(this).attr(
                    "id",
                    "additional_is_mortgage_three_months_yes_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "additional_is_mortgage_three_months_yes_" + index_val
                    );
            }
            if ($(this).val() == "0") {
                $(this).next('label').attr( "onclick", "isThreeMonthsCommon('no','additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional1('no'," + index_val + ")" );
                $(this).attr(
                    "id",
                    "additional_is_mortgage_three_months_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "additional_is_mortgage_three_months_no_" + index_val
                    );
            }
            $(this).attr("data-index", index_val);
        });
        $(payment_1_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_1][" + index_val + "]"
        );
        $(payment_1_of_2).attr("data-index", index_val);
        $(payment_2_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_2][" + index_val + "]"
        );
        $(payment_2_of_2).attr("data-index", index_val);
        $(payment_3_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_3][" + index_val + "]"
        );
        $(payment_3_of_2).attr("data-index", index_val);
        $(payment_dates_1_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_dates_1][" +
                index_val +
                "]"
        );
        $(payment_dates_2_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_dates_2][" +
                index_val +
                "]"
        );
        $(payment_dates_3_of_2).attr(
            "name",
            "property_resident[home_car_loan2][payment_dates_3][" +
                index_val +
                "]"
        );
        $(total_amount_paid_1_of_2).attr(
            "name",
            "property_resident[home_car_loan2][total_amount_paid][" +
                index_val +
                "]"
        );
        // for loan 3
        $(three_month_mortgage_3).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][is_mortgage_three_months][" +
                    index_val +
                    "]"
            );
            if ($(this).val() == "1") {
                $(this).next('label').attr( "onclick", "isThreeMonthsCommon('yes','second_additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional2('yes'," + index_val + ")" );
                $(this).attr(
                    "id",
                    "second_additional_is_mortgage_three_months_yes_" +
                        index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "second_additional_is_mortgage_three_months_yes_" +
                            index_val
                    );
            }
            if ($(this).val() == "0") {
                $(this).next('label').attr( "onclick", "isThreeMonthsCommon('no','second_additional_three_months_div_" + index_val + "'); isMortgageThreeMonthAdditional2('no'," + index_val + ")" );
                $(this).attr(
                    "id",
                    "second_additional_is_mortgage_three_months_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "second_additional_is_mortgage_three_months_no_" +
                            index_val
                    );
            }
        });
        $(payment_1_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_1][" + index_val + "]"
        );
        $(payment_1_of_3).attr("data-index", index_val);
        $(payment_2_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_2][" + index_val + "]"
        );
        $(payment_2_of_3).attr("data-index", index_val);
        $(payment_3_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_3][" + index_val + "]"
        );
        $(payment_3_of_3).attr("data-index", index_val);
        $(payment_dates_1_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_dates_1][" +
                index_val +
                "]"
        );
        $(payment_dates_2_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_dates_2][" +
                index_val +
                "]"
        );
        $(payment_dates_3_of_3).attr(
            "name",
            "property_resident[home_car_loan3][payment_dates_3][" +
                index_val +
                "]"
        );
        $(total_amount_paid_1_of_3).attr(
            "name",
            "property_resident[home_car_loan3][total_amount_paid][" +
                index_val +
                "]"
        );

        $(three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this)
                .removeClass("three_months_div_" + prev_index)
                .addClass("three_months_div_" + index_val + " hide-data");
        });
        $(additional_three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this)
                .removeClass("additional_three_months_div_" + prev_index)
                .addClass(
                    "additional_three_months_div_" + index_val + " hide-data"
                );
        });
        $(second_additional_three_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this)
                .removeClass("second_additional_three_months_div_" + prev_index)
                .addClass(
                    "second_additional_three_months_div_" +
                        index_val +
                        " hide-data"
                );
        });

        $(loan_property_owned_by).each(function () {
            $(this).attr( "name", "property_resident[home_car_loan][property_owned_by][" + index_val + "]" );
            $(this).attr("data-index", index_val);

            if ($(this).val() == "1") {
                $(this).attr("id", "owned_by_you_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_you_loan1_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "owned_by_spouse_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_spouse_loan1_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "owned_by_joint_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_joint_loan1_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "owned_by_other_loan1_" + index_val);
                $(this).next("label").attr("for", "owned_by_other_loan1_" + index_val);
            }
        });

        $(loan_cosigner_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_name][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_name_addresss][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_city][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_state][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan_cosigner_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_creditor_zip][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_property_owned_by).each(function () {
            $(this).attr( "name", "property_resident[home_car_loan2][property_owned_by][" + index_val + "]" );
            $(this).attr("data-index", index_val);

            if ($(this).val() == "1") {
                $(this).attr("id", "owned_by_you_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_you_loan2_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "owned_by_spouse_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_spouse_loan2_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "owned_by_joint_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_joint_loan2_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "owned_by_other_loan2_" + index_val);
                $(this).next("label").attr("for", "owned_by_other_loan2_" + index_val);
            }
        });

        $(loan2_cosigner_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_name][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_name_addresss][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_city][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_state][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan2_cosigner_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][codebtor_creditor_zip][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });

        $(loan3_property_owned_by).each(function () {
            $(this).attr( "name", "property_resident[home_car_loan3][property_owned_by][" + index_val + "]" );
            $(this).attr("data-index", index_val);

            if ($(this).val() == "1") {
                $(this).attr("id", "owned_by_you_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_you_loan3_" + index_val);
            }
            if ($(this).val() == "2") {
                $(this).attr("id", "owned_by_spouse_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_spouse_loan3_" + index_val);
            }
            if ($(this).val() == "3") {
                $(this).attr("id", "owned_by_joint_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_joint_loan3_" + index_val);
            }
            if ($(this).val() == "4") {
                $(this).attr("id", "owned_by_other_loan3_" + index_val);
                $(this).next("label").attr("for", "owned_by_other_loan3_" + index_val);
            }
        });

        $(loan3_cosigner_vehicle_creditor_name).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_name][" +
                    index_val +
                    "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_name_addresss][" +
                    index_val +
                    "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_city).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_city][" +
                    index_val +
                    "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_state).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_state][" +
                    index_val +
                    "]"
            );
        });

        $(loan3_cosigner_vehicle_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][codebtor_creditor_zip][" +
                    index_val +
                    "]"
            );
        });

        $(vehicle_payment_tax_insurance).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][payment_tax_insurance][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr(
                    "id",
                    "vehicle_payment_tax_insurance_no_" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "vehicle_payment_tax_insurance_no_" + index_val
                    );
            }
            if ($(this).val() == "2") {
                $(this).attr(
                    "id",
                    "vehicle_payment_tax_insurance_yes" + index_val
                );
                $(this)
                    .next("label")
                    .attr(
                        "for",
                        "vehicle_payment_tax_insurance_yes" + index_val
                    );
            }
        });
        $(vehicle_monthly_payment).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][monthly_payment][" +
                    index_val +
                    "]"
            );
            $(this).attr("data-index", index_val);
        });
        $(vehicle_payment_remaining).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][payment_remaining][" +
                    index_val +
                    "]"
            );
        });
        $(vehicle_debt_owned_by).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan][debt_owned_by][" +
                    index_val +
                    "]"
            );
            $(this).next("label").attr("for", $(this).attr("id")).attr('onclick', 'showLoanDiv('+index_val+')');
            $(this).attr("data-index", index_val);
        });
        $(vehicle_codebtor).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(vehicle_codebtor_info).each(function () {
            $(this).attr(
                "name",
                "property_resident[home_car_loan][codebtor_info][" +
                    index_val +
                    "]"
            );
        });
        $(loan_own_type_property).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[loan_own_type_property][" + index_val + "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(additional_loan1).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan2][additional_loan1][" +
                    index_val +
                    "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });
        $(additional_loan2).each(function () {
            $(this).attr("id", $(this).attr("id") + index_val);
            $(this).attr(
                "name",
                "property_resident[home_car_loan3][additional_loan2][" +
                    index_val +
                    "]"
            );
            $(this).next("label").attr("for", $(this).attr("id"));
        });

        var security_deposit_yes_no = cln.find(".security_deposit_div .security_deposit_yes_no");
        $(security_deposit_yes_no).each(function () {
            $(this).attr( "id", $(this).attr("id") + index_val);
            $(this).attr( "name", "security_deposits["+ index_val +"][type_value]" );
            $(this).next( "label").attr("for", $(this).attr("id"));

            if($(this).val() == 1){
               $(this).next( "label").attr( "onclick", "getSecurityDepositsItems('yes', '"+ index_val +"');" );
            }
            if($(this).val() == 0){
                $(this).attr( "onclick", "getSecurityDepositsItems('no', '"+ index_val +"'); openFlagPopup('security-deposits-popup', 'No');" );
                if(!saveFromAttorney){
                    $(this).attr( "onclick", "getSecurityDepositsItems('no', '"+ index_val +"'); openFlagPopup('security-deposits-popup', 'No', true, false);" );
                } else {
                    $(this).attr( "onclick", "getSecurityDepositsItems('no', '"+ index_val +"'); openFlagPopup('security-deposits-popup', 'No', true, true);" );
                }
            }
        });

        var oldIndex = (index_val - 1);

        var security_deposit_data_div = cln.find(".security_deposit_data_div");
        $(security_deposit_data_div).addClass( "hide-data");
        $(security_deposit_data_div).attr( "id", "security_deposits_data_" + index_val);

        var security_deposit_data_div_add_more_btn = security_deposit_data_div.find('.add-more-div-bottom button')
        security_deposit_data_div_add_more_btn.attr("onclick", `common_financial_addmore_with_limit('security_deposits_${index_val}',9,'security-deposits-mutisec-${index_val}', 'security_deposits[${index_val}]'); return false;` )

        var security_deposits_mutisec = cln.find(".security_deposits_" + oldIndex + "_mutisec");
        security_deposits_mutisec.slice(1).remove();
        $(security_deposits_mutisec).removeClass('security_deposits_'+oldIndex+'_mutisec').removeClass(`rent_sec_deposit${oldIndex}`).removeClass(`rent_sec_deposit${oldIndex}_0`);
        $(security_deposits_mutisec).addClass('security_deposits_'+index_val+'_mutisec').addClass(`rent_sec_deposit${index_val}`).addClass(`rent_sec_deposit${index_val}_0`);
        var security_deposits_type_of_account = $(security_deposits_mutisec).find(".security_deposits_type_of_account");
        $(security_deposits_type_of_account).removeClass('security_deposits_'+oldIndex+'_type_of_account');
        $(security_deposits_type_of_account).addClass('security_deposits_'+index_val+'_type_of_account');
        $(security_deposits_type_of_account).attr( "name", "security_deposits["+ index_val +"][data][type_of_account][0]");
        $(security_deposits_type_of_account).attr( "value", "");

        var security_deposits_description = $(security_deposits_mutisec).find(".security_deposits_description");
        $(security_deposits_description).removeClass('security_deposits_'+oldIndex+'_description');
        $(security_deposits_description).addClass('security_deposits_'+index_val+'_description');
        $(security_deposits_description).attr( "name", "security_deposits["+ index_val +"][data][description][0]");
        $(security_deposits_description).attr( "value", "");

        var security_deposits_property_value = $(security_deposits_mutisec).find(".security_deposits_property_value");
        $(security_deposits_property_value).removeClass('security_deposits_'+oldIndex+'_property_value');
        $(security_deposits_property_value).addClass('security_deposits_'+index_val+'_property_value');
        $(security_deposits_property_value).attr( "name", "security_deposits["+ index_val +"][data][property_value][0]");
        $(security_deposits_property_value).attr( "value", "");
        
        var security_deposit_add_more = cln.find(".security_deposit_data_div .add-more-btn button");
        $(security_deposit_add_more).attr( "onclick", "common_financial_addmore_with_limit('security_deposits_"+ index_val +"',9,'security-deposits-mutisec-"+ index_val +"', 'security_deposits["+ index_val +"]'); return false;");
        
        var security_deposit_remove = cln.find(".security_deposit_data_div .add-more-btn i");
        $(security_deposit_remove).removeClass('remove-security-deposits-mutisec-'+oldIndex);
        $(security_deposit_remove).addClass('remove-security-deposits-mutisec-'+index_val);
        $(security_deposit_remove).attr( "onclick", "removeButton('.security_deposits_"+ index_val +"_mutisec', '.remove-security-deposits-mutisec-"+ index_val +"');");

        $(property_mortgage_section).addClass('hide-data');

        $(itm).after(cln);
        $(".save-button-section button").prop("disabled", true);
        initializeDatepicker();
        checkAllFieldsFilled(); /// added to show validation error on property tab
    }
}



// Hidden Data
function getHiddenOwnedByYou(value) {
    if (value == "you") {
        document.getElementById("condition-data").classList.remove("hide-data");
    } else if (value == "spouse") {
        document.getElementById("condition-data").classList.add("hide-data");
    } else if (value == "joint") {
        document.getElementById("condition-data").classList.add("hide-data");
    } else if (value == "other") {
        document.getElementById("condition-data").classList.add("hide-data");
    }
}

async function addListNatureBusinessForm() {
    var clnln = $(document).find(".list_nature_business_data").length;
    const status = await seperate_save('list_nature_business','list_nature_business_data', 'list-nature-business-data', 'parent_list_nature_business', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 5) {
            alert("You can only insert 6 business.");
            return false;
        } else {
            var itm = $(document).find(".list_nature_business_data").last();
            var index_val = $(itm).index();
            index_val = index_val + 1;
            var cln = $(itm).clone();

            let divclass = "list_nature_business_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_nature_business','list_nature_business_data', 'list-nature-business-data', 'parent_list_nature_business', " + index_val + ")");
            
            var name = cln.find(".name");
            var street_number = cln.find(".street_number");
            var city = cln.find(".city");
            var state = cln.find(".state");

            var zip = cln.find(".zip");
            var business_nature = cln.find(".business_nature");
            var business_accountant = cln.find(".business_accountant");
            var eiin = cln.find(".eiin");
            var operation_date = cln.find(".operation_date");
            var operation_date2 = cln.find(".operation_date2");
            var doesntHaveEin = cln.find(".doesntHaveEin");
            var business_still_open = cln.find(".business_still_open");
            var own_business_selection = cln.find(".own_business_selection");
            var bsDescDiv = cln.find(".bsDescDiv");
            var beinDiv = cln.find(".beinDiv");
            var bussiness_type = cln.find(".bussiness_type");
            var des_cbussiness_type = cln.find(".des_cbussiness_type");
            var businessendDate = cln.find(".businessendDate");

            $(bussiness_type).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[type][" + index_val + "]"
                );
                $(this).attr(
                    "onchange",
                    "updateDsDescDivShowHideAffairs('" + index_val + "', 'bsDescDiv_" + index_val + "', 'beinDiv_" + index_val + "')"
                );
            });

            $(des_cbussiness_type).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[businessDescription][" + index_val + "]"
                );
            });

            $(bsDescDiv).each(function () {
                var prev_val = (index_val-1);
                $(this).removeClass("bsDescDiv_" + prev_val).addClass("bsDescDiv_" + index_val + " hide-data");
            });
            $(beinDiv).each(function () {
                var prev_val = (index_val-1);
                $(this).removeClass("beinDiv_" + prev_val).addClass("beinDiv_" + index_val + "");
            });
            $(name).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[name][" + index_val + "]"
                );
            });

            $(doesntHaveEin).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[doesntHaveEin][" + index_val + "]"
                );
            });
            $(own_business_selection).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[own_business_selection][" + index_val + "]"
                );
            });
            $(business_still_open).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[business_still_open][" +
                        index_val +
                        "]"
                );
                $(this).attr("onchange", "checkBizend(this," + index_val + ")");
            });

            
            $(businessendDate).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[operation_date2][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });

            $(street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[street_number][" + index_val + "]"
                );
            });
            $(city).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[city][" + index_val + "]"
                );
            });
            $(state).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[state][" + index_val + "]"
                );
            });
            $(zip).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[zip][" + index_val + "]"
                );
            });
            $(business_nature).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[business_nature][" + index_val + "]"
                );
            });
            $(business_accountant).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[business_accountant][" +
                        index_val +
                        "]"
                );
            });
            $(eiin).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[eiin][" + index_val + "]"
                );
            });
            $(operation_date).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[operation_date][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(operation_date2).each(function () {
                $(this).attr(
                    "name",
                    "list_nature_business_data[operation_date2][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            cln.find("select").val("");
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find('input[type="checkbox"]').prop("checked", false);
            cln.find('input[type="text"]').prop("disabled", false);
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

function toggleNameToLawSuit(checkbox) {
    const formGroup = checkbox.closest('.form-group');
    const input = formGroup.querySelector('.case_title');
    if (!input) return;

    // Get all checked names in this form group
    const checkedNames = Array.from(
        formGroup.querySelectorAll('.form-check-input:checked')
    ).map(cb => cb.getAttribute('data-name').trim());

    // Extract the base case title (everything before " V.")
    let baseTitle = input.value.split(" V.")[0].trim();

    // Rebuild the title
    if (checkedNames.length > 0) {
        input.value = `${baseTitle} V. ${checkedNames.join(', ')}`;
    } else {
        input.value = baseTitle; // reset to base if no boxes checked
    }
}

// add new debt
function addanotherDebts(url) {
   var unsaved_debtor_len = $(document).find(".unsaved_debtor").length;
    if(unsaved_debtor_len>0){
        var saveData = saveTheseDebts(true);
        if (saveData == false) {
            return false;
        }
    }

    var clnln = $(document).find(".debt_creditor_form").length;
    if (clnln > 124) {
        alert("You can only insert 125 creditors.");
        return false;
    } else {
        var itm = $(document).find(".debt_creditor_form").last();
        var credit_itm = $(document).find(".credit_summ").last();
        var index_val = $(itm).index() + 1;
        /*Values that need to display under summary */
        var debtType = "";
        var last4_number = "";
        var amountOwned = "";
        var creditorName = "";
        var creditorAddress = "";
        var debtIncurredDate = "";
        debtType = $(itm)
            .find(".cards_collections")
            .find("option:selected")
            .data("type");
        last4_number = $(itm).find(".amount_number").val();
        amountOwned = $(itm).find(".amount_owned").val();
        creditorName = $(itm).find(".creditor_name").val();
        creditorAddress = $(itm).find(".creditor_information").val();
        creditorCity = $(itm).find(".creditor_city").val();
        creditorState = $(itm).find(".creditor_state").val();
        creditorZip = $(itm).find(".creditor_zip").val();
        debtIncurredDate = $(itm).find(".debt_date").val();
        var credName2 = $(itm).find(".second_creditor_name").val();
        var credAddress2 = $(itm).find(".second_creditor_information").val();
        var credCity2 = $(itm).find(".second_creditor_city").val();
        var credState2 = $(itm).find(".second_creditor_state").val();
        var credZip2 = $(itm).find(".second_creditor_zip").val();

        var originalCreditor = $(itm).find(".original_creditor:checked").val();

        if (originalCreditor == "1") {
            var summaryAgentOrigional = "";
            var summaryAgentCollection = "d-none";
            var collectionAgentDiv = "d-none";
        } else {
            var summaryAgentOrigional = "d-none";
            var summaryAgentCollection = "";
            var collectionAgentDiv = "";
        }

        var cln = $(itm).clone();

        $(document)
            .find(".creditor_summary_" + index_val)
            .removeClass("hide-data");
        $(".debt_creditor_sub_" + index_val).addClass("hide-data");
        cln.find(".debt_no").html(index_val + 1 + ".");
        cln.find(".credit_summ").addClass("hide-data");
        cln.find(".insider_data").removeClass("hide-data");

      
        cln.find("label").removeClass("active");

        let divclass = "debt_creditor";
        cln.removeClass(function (index, className) {
            return (className.match(divclass + "_\\d+", "g") || []).join(' ');
        }).addClass(divclass + "_" + index_val);
        cln.find(".delete-div").attr('data-saveid', (index_val+1)).attr("onclick", "remove_debt_div("+(index_val+1)+", this)");
        cln.find(".client-edit-button").attr('data-saveid', (index_val+1)).attr("onclick", "display_debt_div(this, "+(index_val+1)+")");
        cln.find(".circle-number-div").html(index_val + 1);
       
        var credit_summ = cln.find(".credit_summ");
        var insider_data = cln.find(".insider_data");

        var cards_collections = cln.find(".cards_collections");
        var creditor_name = cln.find(".creditor_name");
        var creditor_information = cln.find(".creditor_information");
        var creditor_city = cln.find(".creditor_city");
        var creditor_state = cln.find(".creditor_state");
        var creditor_zip = cln.find(".creditor_zip");
        var im_action = cln.find(".im-action");

        var second_creditor_name = cln.find(".second_creditor_name");
        var second_creditor_information = cln.find(
            ".second_creditor_information"
        );
        var second_creditor_city = cln.find(".second_creditor_city");
        var second_creditor_state = cln.find(".second_creditor_state");
        var second_creditor_zip = cln.find(".second_creditor_zip");

        var original_creditor = cln.find(".original_creditor");

        var amount_owned = cln.find(".amount_owned");
        var amount_number = cln.find(".amount_number");
        var credt_owned_by = cln.find(".credt_owned_by");
        cln.find(".debt_tax_codebtor_cosigner_data").addClass("hide-data");
        var debt_date_unknown = cln.find(".debt_date_unknown");
        var debt_date = cln.find(".debt_date");

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
        var debt_second_address = cln.find(
            ".debt_second_address_" + $(itm).index()
        );
        var debt_date_section = cln.find(
            ".debt_date_section_" + $(itm).index()
        );
        var remove_div_icon = cln.find(".remove_div_icon");
        var nextIndex = index_val + 1;

        var debt_months = cln.find(".debt_months");
        var debt_months_label_yes = cln.find(".debt_months_label_yes");
        var debt_months_label_no = cln.find(".debt_months_label_no");
        var debt_months_div = cln
            .find(".debt_months_div")
            .addClass("hide-data");
        var payment_1 = cln.find(".payment_1");
        var payment_2 = cln.find(".payment_2");
        var payment_3 = cln.find(".payment_3");
        var payment_dates_1 = cln.find(".payment_dates_1");
        var payment_dates_2 = cln.find(".payment_dates_2");
        var payment_dates_3 = cln.find(".payment_dates_3");
        var total_amount_paid = cln.find(".total_amount_paid");

        var validate_div = cln.find(".validate_div");
        var validate_msg = cln.find(".validate_msg");
        var saveBtn = cln.find(".save-btn");
        var trashBtn = cln.find(".trash-btn");
        var amount_less_sixhund = cln.find(".amount_less_sixhund");

        var law_suit = cln.find(".law_suit");
        
        $(law_suit).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("law_suit_div_" + prev_index);
            $(this).addClass("law_suit_div_" + index_val);

            $(this).find('.debtor').each(function () {
                let newId = 'add_debtor_' + index_val;
                $(this).attr('id', newId);
                $(this).prop('checked', false)
                $(this).next('label').attr('for', newId);
            });

            $(this).find('.codebtor').each(function () {
                let newId = 'add_codebtor_' + index_val;
                $(this).attr('id', newId);
                $(this).prop('checked', false)
                $(this).next('label').attr('for', newId);
            });

            // update text input names
            $(this).find('.case_title').attr('name', 'debt_tax[list_lawsuits_data][case_title][' + index_val + ']');
            $(this).find('.case_number').attr('name', 'debt_tax[list_lawsuits_data][case_number][' + index_val + ']');
            $(this).find('.agency_location').attr('name', 'debt_tax[list_lawsuits_data][agency_location][' + index_val + ']');
            $(this).find('.agency_street').attr('name', 'debt_tax[list_lawsuits_data][agency_street][' + index_val + ']');
            $(this).find('.agency_city').attr('name', 'debt_tax[list_lawsuits_data][agency_city][' + index_val + ']');
            $(this).find('.agency_state').attr('name', 'debt_tax[list_lawsuits_data][agency_state][' + index_val + ']');
            $(this).find('.agency_zip').attr('name', 'debt_tax[list_lawsuits_data][agency_zip][' + index_val + ']');

            // update radio buttons for disposition
            $(this).find('.disposition').each(function () {
                let val = $(this).val();
                let newId = 'list-lawsuits_disposition_' + 
                    (val == '1' ? 'pending' : val == '2' ? 'appeal' : 'concluded') 
                    + '-' + index_val;
                $(this).attr('id', newId);
                $(this).attr('name', 'debt_tax[list_lawsuits_data][disposition][' + index_val + ']');
                $(this).next('label').attr('for', newId);
            });
        });


        $(amount_less_sixhund).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("amount_not_saved_" + prev_index);
            $(this).addClass("amount_not_saved_" + index_val);
        });
        $(im_action).each(function () {
            $(this).attr("data-saveid", index_val + 1);
        });

        $(saveBtn).each(function () {
            $(this).attr(
                "onclick",
                'saveTheseDebts(true,this,true);'
            );
        });

        $(trashBtn).each(function () {
            $(this).attr(
                "onclick",
                "remove_debt_div(" + (index_val + 1) + ", this);"
            );
        });

        $(debt_months).each(function () {
            $(this).prop("checked", false);
            $(this).attr(
                "name",
                "debt_tax[is_debt_three_months][" + index_val + "]"
            );
            if ($(this).val() == "1") {
                $(this).attr(
                    "onclick",
                    "isThreeMonthsCommon('yes', 'debt_three_months_div_" +
                        index_val +
                        "')"
                );
                $(this).attr("id", "is_debt_three_months_yes_" + index_val);
                $(debt_months_label_yes).attr(
                    "for",
                    "is_debt_three_months_yes_" + index_val
                );
            }
            if ($(this).val() == "0") {
                $(this).attr(
                    "onclick",
                    "isThreeMonthsCommon('no', 'debt_three_months_div_" +
                        index_val +
                        "')"
                );
                $(this).attr("id", "is_debt_three_months_no_" + index_val);
                $(debt_months_label_no).attr(
                    "for",
                    "is_debt_three_months_no_" + index_val
                );
            }
            $(payment_1).each(function () {
                $(this).attr("name", "debt_tax[payment_1][" + index_val + "]");
                $(this).attr("data-index", index_val);
            });
            $(payment_2).each(function () {
                $(this).attr("name", "debt_tax[payment_2][" + index_val + "]");
                $(this).attr("data-index", index_val);
            });
            $(payment_3).each(function () {
                $(this).attr("name", "debt_tax[payment_3][" + index_val + "]");
                $(this).attr("data-index", index_val);
            });
            $(payment_dates_1).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[payment_dates_1][" + index_val + "]"
                );
            });
            $(payment_dates_2).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[payment_dates_2][" + index_val + "]"
                );
            });
            $(payment_dates_3).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[payment_dates_3][" + index_val + "]"
                );
            });
            $(total_amount_paid).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[total_amount_paid][" + index_val + "]"
                );
            });
        });
        $(debt_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("debt_three_months_div_" + prev_index);
            $(this).addClass("debt_three_months_div_" + index_val);
        });

        $(cln).each(function () {
            $(cln)
                .removeClass("unsaved_debtor debt_creditor_" + index_val)
                .addClass("unsaved_debtor debt_creditor_" + nextIndex);
        });

        $(credit_summ).each(function () {
            $(credit_summ)
                .removeClass("creditor_summary_" + index_val)
                .addClass("creditor_summary_" + nextIndex);
        });
        $(insider_data).each(function () {
            $(insider_data)
                .removeClass("debt_creditor_sub_" + index_val)
                .addClass("debt_creditor_sub_" + nextIndex);
        });

        $(validate_div).each(function () {
            var oldInx = index_val - 1;
            $(validate_div).removeClass("validation_msg_div_" + oldInx);
            $(validate_div).addClass("validation_msg_div_" + index_val);
        });
        $(validate_msg).each(function () {
            var oldInx = index_val - 1;
            $(validate_msg)
                .removeClass("validation_msg_" + oldInx)
                .addClass("validation_msg_" + index_val);
        });

        $(debt_tax_codebtor_creditor_name).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_name][" + index_val + "]"
            );
        });

        $(remove_div_icon).each(function () {
            $(this).attr("onclick", "remove_debt_div(" + nextIndex + ")");
        });

        $(debt_tax_codebtor_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_name_addresss][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_city).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_city][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_state).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_state][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_zip][" + index_val + "]"
            );
        });

        $(credt_owned_by).each(function () {
            $(this).prop("checked", false);
            $(this).attr("name", "debt_tax[owned_by][" + index_val + "]");
            let thisRadioId = $(this).attr("id");
            $(this).attr("id", thisRadioId + index_val);
            $(this).next("label").attr("for", thisRadioId + index_val);
        });

        $(cards_collections).each(function () {
            $(this).attr(
                "name",
                "debt_tax[cards_collections][" + index_val + "]"
            );
            $(this)
                .removeClass("cards_collections_" + index_val)
                .addClass("cards_collections_" + (index_val + 1));
        });

        $(creditor_name).each(function () {
            $(this).attr("name", "debt_tax[creditor_name][" + index_val + "]");
            $(this)
                .removeClass("creditor_name_" + index_val)
                .addClass("creditor_name_" + (index_val + 1));
        });
        $(creditor_information).each(function () {
            $(this).attr(
                "name",
                "debt_tax[creditor_information][" + index_val + "]"
            );
            $(this)
                .removeClass("creditor_information_" + index_val)
                .addClass("creditor_information_" + (index_val + 1));
        });
        $(creditor_city).each(function () {
            $(this).attr("name", "debt_tax[creditor_city][" + index_val + "]");
            $(this)
                .removeClass("creditor_city_" + index_val)
                .addClass("creditor_city_" + (index_val + 1));
        });
        $(creditor_state).each(function () {
            $(this).attr("name", "debt_tax[creditor_state][" + index_val + "]");
            $(this)
                .removeClass("creditor_state_" + index_val)
                .addClass("creditor_state_" + (index_val + 1));
        });
        $(creditor_zip).each(function () {
            $(this).attr("name", "debt_tax[creditor_zip][" + index_val + "]");
            $(this)
                .removeClass("creditor_zip_" + index_val)
                .addClass("creditor_zip_" + (index_val + 1));
        });
        $(amount_owned).each(function () {
            $(this).attr("name", "debt_tax[amount_owned][" + index_val + "]");
            $(this)
                .removeClass("amount_owned_" + index_val)
                .addClass("amount_owned_" + (index_val + 1));
        });
        $(amount_number).each(function () {
            $(this).attr("name", "debt_tax[amount_number][" + index_val + "]");
            $(this)
                .removeClass("amount_number_" + index_val)
                .addClass("amount_number_" + (index_val + 1));
        });
        $(debt_date_unknown).each(function () {
            $(this).attr(
                "name",
                "debt_tax[debt_date_unknown][" + index_val + "]"
            );
            $(this).attr("onclick", "unknownChecked(" + index_val + ")");
            $(this).attr("id", "debt_date_unknown_" + index_val);
        });
        $(debt_date).each(function () {
            $(this).attr("name", "debt_tax[debt_date][" + index_val + "]");
            $(this)
                .removeClass("debt_date_" + index_val)
                .addClass("debt_date_" + (index_val + 1));
            $(this).removeClass("hasDatepicker").attr("id", "");
        });

        $(second_creditor_name).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_name][" + index_val + "]"
            );
            $(this).attr(
                "data-index",
                (index_val + 1)
            );
            $(this)
                .removeClass("second_creditor_name_" + index_val)
                .addClass("second_creditor_name_" + (index_val + 1));
        });
        $(second_creditor_information).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_information][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_information_" + index_val)
                .addClass("second_creditor_information_" + (index_val + 1));
        });
        $(second_creditor_city).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_city][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_city_" + index_val)
                .addClass("second_creditor_city_" + (index_val + 1));
        });
        $(second_creditor_state).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_state][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_state_" + index_val)
                .addClass("second_creditor_state_" + (index_val + 1));
        });
        $(second_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_zip][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_city_" + index_val)
                .addClass("second_creditor_city_" + (index_val + 1));
        });

        $(original_creditor).each(function () {
            $(this).attr("name", "debt_tax[original_creditor][" + index_val + "]" );
            $(this).removeClass("original_creditor_" + index_val).addClass("original_creditor_" + (index_val + 1));
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr( "id", "original_creditor_no_" + index_val );
                $(this).next( "label" ).attr( "onclick", "originalCreditorCheck(1," + index_val + ")" );
                $(this).next( "label" ).attr( "for", "original_creditor_no_" + index_val );
            }
            if ($(this).val() == "0") {
                $(this).attr( "id", "original_creditor_yes_" + index_val );
                $(this).next( "label" ).attr( "onclick", "originalCreditorCheck(0," + index_val + ")" );
                $(this).next( "label" ).attr( "for", "original_creditor_yes_" + index_val );
            }
            $(this).prop("checked", false);
        });

        $(debt_second_address).each(function () {
            $(this).removeClass("debt_second_address_" + $(itm).index());
            $(this).addClass("debt_second_address_" + index_val);
        });

        $(debt_date_section).each(function () {
            $(this).removeClass("debt_date_section_" + $(itm).index());
            $(this).addClass("debt_date_section_" + index_val);
        });

        cln.find("select").val("");
        cln.find("select").removeAttr("selected");

        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        initializeDatepicker();
        $(itm).after(cln);
    }
}

function display_debt_div(thisObj, index) {
    var hasError = false;
    $(".unsecured_credit_form").each(function (index) {
        if(!$(this).hasClass('hide-data')){
            hasError = revalidateFormWithMonthYear("client_debts_step2_unsecured",true);
            if(hasError){
                return false;
            }
        }
    });
    if(!hasError){
        $(".debt_creditor_sub_" + index).removeClass("hide-data");
        $(".creditor_summary_" + index).addClass("hide-data");
        var errorDiv = $(".debt_creditor_sub_" + index + ":visible").first();
        var scrollPos = errorDiv.offset().top;
        $(window).scrollTop(scrollPos);
    }
    $(thisObj).addClass('hide-data');
}

function display_irs_form_div(thisObj){
    $("#tax-owned-irs").removeClass('hide-data');
    $("#irs-texes-views").addClass("hide-data");
    $(thisObj).addClass('hide-data');
}

function display_al_debt_div(thisObj, index) {
    var hasError = false;
    $(".additional_liens_credit_form").each(function (index) {
        if(!$(this).hasClass('hide-data')){
            hasError = revalidateFormWithMonthYear("client_debts_step2_al",true);
            if(hasError){
                return false;
            }
        }
    });
    if(!hasError){
        $(".add_liens_creditor_" + index).removeClass("hide-data");
        $(".al_creditor_summary_" + index).addClass("hide-data");
        var errorDiv = $(".add_liens_creditor_" + index + ":visible").first();
        var scrollPos = errorDiv.offset().top;
        $(window).scrollTop(scrollPos);
    }
    $(thisObj).addClass('hide-data');
}

function display_bt_debt_div(thisObj, index) {
    var hasError = false;
    $(".back_taxes_credit_form").each(function (index) {
        if(!$(this).hasClass('hide-data')){
            hasError = revalidateFormWithMonthYear("client_debts_step2_back_taxes",true);
            if(hasError){
                return false;
            }
        }
    });
    if(!hasError){
        $(".back_tax_summary_" + index).addClass("hide-data");
        $(".back_tax_data_" + index).removeClass("hide-data");
        var errorDiv = $(".back_tax_data_" + index + ":visible").first();
        var scrollPos = errorDiv.offset().top;
        $(window).scrollTop(scrollPos);
    }
    $(thisObj).addClass('hide-data');
}

function display_dso_debt_div(thisObj, index) {
    var hasError = false;
    $(".domastic_credit_form").each(function (index) {
        if(!$(this).hasClass('hide-data')){
            hasError = revalidateFormWithMonthYear("client_debts_step2_dso",true);
            if(hasError){
                return false;
            }
        }
    });
    if(!hasError){
        $(".dso_summary_" + index).addClass("hide-data");
        $(".dso_data_" + index).removeClass("hide-data");
        var errorDiv = $(".dso_data_" + index + ":visible").first();
        var scrollPos = errorDiv.offset().top;
        $(window).scrollTop(scrollPos);
    }
    $(thisObj).addClass('hide-data');
}

async function remove_al_debt_div(row_class, thisobj) {
    const canEdit = await is_editable('can_edit_debts');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }
    var cloneLength = $(document).find(".additional_liens_form").length;
    if (cloneLength <= 1) {
        $.systemMessage(
            "You cannot delete because at least 1 entry is required.",
            "alert--danger"
        );
        return false;
    } else {
        var saveId = $(thisobj).attr("data-saveid");
       
        showConfirmation("Do you want to remove this creditor?", function(confirmation) {
        if (confirmation) {
            
            $(".additional_liens_div")
                .find(".addionallines_" + saveId)
                .remove();
            $(".additional_liens_div .row.additional_liens_form").each(
                function (index) {
                    var updatedRowClass = index + 1;
                    $(this)
                        .removeClass("addionallines_" + (index + 2))
                        .addClass("addionallines_" + updatedRowClass);
                    $(this)
                        .find(".debt_no")
                        .text(updatedRowClass + ".");
                    var removeButton = $(this).find(".bg-red-al");
                    removeButton.attr(
                        "onclick",
                        "remove_al_debt_div(" + updatedRowClass + ",this)"
                    );
                }
            );
           alSaveTheseDebts();
        }
    });
    }
}

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

function addAdditionalLiensForm(url) {
    var itm = $(document).find(".additional_liens_form").last();
    var lastIndex = $(itm).index() + 1;

    console.log($(itm).find(".hide-data.al_creditor_summary_"+ lastIndex).html());

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

function changeVehicle(sobj, key = false) {
    var val = sobj.value;
    var dataLabel = $(sobj).data('label');
    var indexes = sobj.id || 'vehicle_0';

    // Get numeric index from ID like vehicle_3
    const myArray = indexes.split("_");
    indexes = myArray[1];

    // Update hidden input if present (inside .form-group)
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
}


// function changeVehicle(sobj, indexese, key = false) {
//     var selectedOption = $(sobj).find('option:selected');
//     var dataLabel = selectedOption.data('label');
    
//     // Find the corresponding hidden input in the same .form-group
//     var hiddenInput = $(sobj).closest('.form-group').find('.property_type_name');

//     // Set the value of the hidden input to data-label
//     hiddenInput.val(dataLabel || '');

//     var val = 1;
//     var indexes = 'vehicle_0';   
//     if(key == false){
//         var val = sobj.value;
//         var indexes = sobj.id;    
//     }
//     const myArray = indexes.split("_");
//     indexes = myArray[1];
//     var cars = 0;
//     var recreational = 0;

//     $(".property_type").each(function (index, element) {
//         if (element.value == 1) {
//             cars = cars + 1;
//         }
//         if (element.value == 6) {
//             recreational = recreational + 1;
//         }
//     });

//     /**** Here code start*/
//     if (val == 1 && cars > 8) {
//         $("#vehicle_" + indexes).val(6);
//         $("#vehicle_" + indexes)
//             .next(".reccreational-vehicle")
//             .removeClass("hide-data");
//         alert("You can not add more than 8 vehicles.");
//         return false;
//     }

//     if (val == 6 && recreational > 5) {
//         $("#vehicle_" + indexes).val(1);
//         $("#vehicle_" + indexes)
//             .next(".reccreational-vehicle")
//             .addClass("hide-data");
//         alert("You can not add more than 2 Recreational vehicles.");
//         return false;
//     }

//     let parentDiv = $(sobj).closest(".light-gray-box-form-area");
//     let vtype_name = parentDiv.find("span.vtype_name");
//     let vehicleno = parentDiv.find("span.vehicleno");

//     if (val == 1) {
//         var rvno = cars;
//         if(key){
//             var rvno = 1;
//         }
//         $("#vehicle_" + indexes).val(1);
//         $("#vehicle_" + indexes)
//             .prevAll(".vtype_name")
//             .first()
//             .text("Vehicle");
//         $("#vehicle_" + indexes)
//             .prevAll(".vehicleno")
//             .first()
//             .text(rvno);
           
//         $("#vehicle_" + indexes)
//             .next(".reccreational-vehicle")
//             .addClass("hide-data");

//         vtype_name.text("Vehicle")
//         vehicleno.text(rvno);
//     }
//     if (val == 6) {
//         $("#vehicle_" + indexes).val(6);

//         var rvno = recreational == 1 ? 1 : 2;

//         $("#vehicle_" + indexes)
//             .prevAll(".vtype_name")
//             .first()
//             .text("Recreational");
//         $("#vehicle_" + indexes)
//             .prevAll(".vehicleno")
//             .first()
//             .text(rvno);
//         $("#vehicle_" + indexes)
//             .next(".reccreational-vehicle")
//             .removeClass("hide-data");
//         vtype_name.text("Recreational")
//         vehicleno.text(rvno);   
//     } 

//     if (val > 2) {
//         $("#ols_" + indexes).removeClass("hide-data");
//         $("#cals_" + indexes).addClass("hide-data");
//     } else {
//         $("#ols_" + indexes).addClass("hide-data");
//         $("#cals_" + indexes).removeClass("hide-data");
//     }
// }

// Part B
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

function getOwnTypeProperty(value) {
    if (value == "yes") {
        document
            .getElementById("own_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("own_property_data").classList.add("hide-data");
    }
}

function currently_lived_property(value, obj, isemptyResident = 0, ocrId = 0, ajaxurl = "") {
    let parentDiv = $(obj).closest(".currently_lived_parents");
    let ownSection = parentDiv.find(".currently_lived_data");
    let rentSection = parentDiv.find(".resident_rent_data");
    let evictionDiv = rentSection.find(".eviction_pending_div");
    let property_mortgage_section = parentDiv.find(".property_mortgage_section");
    
    if (value === "yes") {
        ownSection.removeClass("hide-data");
        rentSection.addClass("hide-data");
        evictionDiv.addClass("hide-data"); 
        property_mortgage_section.removeClass("hide-data"); 
        

    } else if (value === "no") {
        ownSection.addClass("hide-data");
        rentSection.removeClass("hide-data");
        evictionDiv.removeClass("hide-data"); 
        property_mortgage_section.addClass("hide-data"); 
    }
debugger
    // Handle AJAX call if necessary
    if (isemptyResident === 1 && ocrId > 0) {
        laws.ajax(ajaxurl, { ocr_id: ocrId }, function (response) {
            if (response.status === 0) {
                $.systemMessage(response.msg, "alert--danger");
            } else {
                laws.updateFaceboxContent(response, "large-fb-width");
            }
        });
    }
}



 
// $(document).on('change', '.prop_type_radio', function() {
//     var value = parseInt($(this).val());
//     var arr1 = [1, 2, 3, 4];
//     var arr2 = [5, 6];
//     var arr3 = [7, 8];
//     if (arr1.includes(value)) {
//         $(this).parent('div').parent('div').parent('div').find('.description-div').removeClass('d-none');
//         $(this).parent('div').parent('div').parent('div').find('.description-and-lot-size-div').addClass('d-none');
//     }
//     if (arr2.includes(value)) {
       
//         $(this).parent('div').parent('div').parent('div').find('.description-and-lot-size-div').removeClass('d-none');
//         $(this).parent('div').parent('div').parent('div').find('.description-div').addClass('d-none');
//     }
//     if (arr3.includes(value)) {
//         $(this).parent('div').parent('div').parent('div').find('.description-and-lot-size-div').addClass('d-none');
//         $(this).parent('div').parent('div').parent('div').find('.description-div').addClass('d-none');
//     }

// });
function showHidePropertySizeDiv(element, value) {
    var valueInt = parseInt(value);
    var arr1 = [1, 2, 3, 4];
    var arr2 = [5, 6];
    var arr3 = [7, 8];
    
    var parentDiv = $(element).closest('.main-property-section');
    var descriptionDiv = parentDiv.find('.description-div');
    var descriptionAndLotSizeDiv = parentDiv.find('.description-and-lot-size-div');
    var propertyOtherInput = parentDiv.find('.property_other_input');
    
    if (arr1.includes(valueInt)) {
        descriptionDiv.removeClass('d-none');
        descriptionAndLotSizeDiv.addClass('d-none');
        propertyOtherInput.addClass('d-none');
    } else if (arr2.includes(valueInt)) {
        descriptionAndLotSizeDiv.removeClass('d-none');
        descriptionDiv.addClass('d-none');
        propertyOtherInput.addClass('d-none');
    } else if (arr3.includes(valueInt)) {
        descriptionAndLotSizeDiv.addClass('d-none');
        descriptionDiv.addClass('d-none');
        
        // Show property_other_input only when value is 8 (Other)
        if (valueInt === 8) {
            propertyOtherInput.removeClass('d-none');
        } else {
            propertyOtherInput.addClass('d-none');
        }
    }
}

// $(document).on('click', '.prop_type_radio', function() {
//     var value = parseInt($(this).attr("data-value"));    
//     var parentDiv = $(this).closest('.main-property-section');
    
//     var descriptionDiv = parentDiv.find('.description-div');
//     var descriptionAndLotSizeDiv = parentDiv.find('.description-and-lot-size-div');
    
//     if ([1, 2, 3, 4].includes(value)) {
//         descriptionDiv.removeClass('d-none');
//         descriptionAndLotSizeDiv.addClass('d-none');
//     } else if ([5, 6].includes(value)) {
//         descriptionAndLotSizeDiv.removeClass('d-none');
//         descriptionDiv.addClass('d-none');
//     } else if ([7, 8].includes(value)) {
//         descriptionDiv.addClass('d-none');
//         descriptionAndLotSizeDiv.addClass('d-none');
//     }
// });


$('.description-div-input').on('input', function() {
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
    }else if (/^\d+(\.\d{3})?$/.test(inputValue)) {
        var newValue = inputValue.slice(0, -1);
        $(this).val(newValue);
    }
    else{
        $(this).val('');
    }
});

$('.lot-size-div-input').on('input', function() {
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
    }else if (/^\d+(\.\d{3})?$/.test(inputValue)) {
        var newValue = inputValue.slice(0, -1);
        $(this).val(newValue);
    }
    else{
        $(this).val('');
    }    
});


function not_primary_address_property(value, obj) {
    // var objIndex = $(obj).attr("data-index");
    if (value == "no") {
        $(obj)
            .parents(".payment_not_primary_address_parents")
            .next(".payment_not_primary_address_data")
            .removeClass("hide-data");
    } else if (value == "yes") {
        $(obj)
            .parents(".payment_not_primary_address_parents")
            .next(".payment_not_primary_address_data")
            .addClass("hide-data");
    }
    
    $(obj).closest('.currently_lived_data').find('.property-detail-div').removeClass('hide-data');
}

function showHidePropertyLoan(value, obj) {
    var parent = $(obj).parents(".laon_property_obj_data");
    var loanPropertySec = parent.next(".loan_own_type_property_sec");
    var sectionAdditionalLoan = loanPropertySec.find(
        ".section_additional_loan"
    );
    var additionalLoan1 = loanPropertySec.find(
        ".additional_loan_obj .additional_loan1"
    );

    if (value === "yes") {
        loanPropertySec.removeClass("hide-data");
    } else if (value === "no") {
        loanPropertySec.addClass("hide-data");
    }

    additionalLoan1.removeAttr("checked");
    sectionAdditionalLoan.addClass("hide-data");

    $(obj).closest('.currently_lived_data').find('.own-save-div').removeClass('hide-data');

}

function laon_property_obj(value, obj) {
    if (value == "yes") {
        $(obj)
            .parents(".laon_property_obj_data")
            .next(".loan_own_type_property_sec")
            .removeClass("hide-data");
        $(obj)
            .parents(".laon_property_obj_data")
            .next("div")
            .next(".loan_own_type_property_sec")
            .removeClass("hide-data");
        $(".additional_loan1").removeAttr("checked");
        $(".additional_loan2").removeAttr("checked");
        $(".section_additional_loan").addClass("hide-data");
        $(".section_additional_loan").addClass("hide-data");
        $("#additional_loan1").attr("checked", true);
        $("#additional_loan2_no").attr("checked", true);
    } else if (value == "no") {
        $(obj)
            .parents(".laon_property_obj_data")
            .next(".loan_own_type_property_sec")
            .addClass("hide-data");
        $(obj)
            .parents(".laon_property_obj_data")
            .next("div")
            .next(".loan_own_type_property_sec")
            .addClass("hide-data");
    }
    $(obj).closest('.vehicle-info-div').find('.vehicle-save-div').removeClass('hide-data')
}

function getOwnTypeProperty_obj(
    value,
    obj,
    isemptyVehicle = 0,
    ocrId = 0,
    ajaxurl = ""
) {
    if (value == 'yes') {
        $(".vehicle-btn-section").removeClass('hide-data');
        if(isemptyVehicle==0){
            $('vehicle_summary_0').addClass('hide-data');
            $('.vehicle_form_0').removeClass('hide-data');
        }
        document.getElementById('vehicle_page_listing_div').classList.remove("hide-data");
    } else if (value == 'no') {
        $("#vehicle_page_listing_div")
        .find("input")
        .val("")
        .end()
        .find("textarea")
        .val("")
        .end()
        .find("select")
        .val("")
        .end();
        $(".vehicle-btn-section").addClass('hide-data');
        if(isemptyVehicle==0){
            $('.vehicle_form_0').addClass('hide-data');
            
            $('vehicle_summary_0').removeClass('hide-data');
        }
        document.getElementById('vehicle_page_listing_div').classList.add("hide-data");
    }
}
// Part C

function getHouseHoldItems(value) {
    if (value == "yes") {
        document
            .getElementById("household_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("household_items_data")
            .classList.add("hide-data");
    }
}

function getHouseElectronicsItems(value) {
    if (value == "yes") {
        document
            .getElementById("electronics_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("electronics_items_data")
            .classList.add("hide-data");
    }
}

function getHouseCollectiblesItems(value) {
    if (value == "yes") {
        document
            .getElementById("Collectibles_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("Collectibles_items_data")
            .classList.add("hide-data");
    }
}

function getHouseSportsItems(value) {
    if (value == "yes") {
        document
            .getElementById("sports_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("sports_items_data").classList.add("hide-data");
    }
}

function getHouseFirearmsItems(value) {
    if (value == "yes") {
        document
            .getElementById("firearms_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("firearms_items_data")
            .classList.add("hide-data");
    }
}

function getHouseClothingItems(value) {
    if (value == "yes") {
        document
            .getElementById("clothing_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("clothing_items_data")
            .classList.add("hide-data");
    }
}

function getHouseJewelryItems(value) {
    if (value == "yes") {
        document
            .getElementById("jewelry_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("jewelry_items_data")
            .classList.add("hide-data");
    }
}
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
function manauallyFillVin(){
    $(".vd-section").each(function() {
        if($(this).hasClass('d-none')){
            $(this).parent('div').parent('div').find('.vin_number').removeClass('required');
            $(this).removeClass('d-none');
        }
    });
    $.facebox.close();
}

function getHouseNonFarmAnimalsItems(value) {
    if (value == "yes") {
        document
            .getElementById("non_farm_animals_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("non_farm_animals_items_data")
            .classList.add("hide-data");
    }
}

function getHouseHEathAidItems(value) {
    if (value == "yes") {
        document
            .getElementById("health_aids_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("health_aids_items_data")
            .classList.add("hide-data");
    }
}

// Part D
function getCashItems(value) {
    if (value == "yes") {
        document
            .getElementById("cash_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("cash_items_data").classList.add("hide-data");
    }
}

function getCheckingAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("checking_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("checking_account_items_data")
            .classList.add("hide-data");
    }
}

function getAccountItems(value) {
    if (value == "yes") {
        if (
            $(".cashVideo-0").hasClass("hide-data") &&
            $(".paypalVideo-0").hasClass("hide-data") &&
            $(".venmoVideo-0").hasClass("hide-data")
        ) {
            $(".paypalVideo-0").removeClass("hide-data");
        }
        $("#account_items_data").removeClass("hide-data");
    } else if (value == "no") {
        $("#account_items_data").addClass("hide-data");
    }
}

function getBrokerageItems(value) {
    if (value == "yes") {
        $("#brokerage_items_data").removeClass("hide-data");
    } else if (value == "no") {
        $("#brokerage_items_data").addClass("hide-data");
    }
}

function getSavingsAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("savings_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("savings_account_items_data")
            .classList.add("hide-data");
    }
}

function getCertificateDepositeItems(value) {
    if (value == "yes") {
        document
            .getElementById("certificate_of_deposit_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("certificate_of_deposit_items_data")
            .classList.add("hide-data");
    }
}

function getOtherFinacialAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_financial_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other_financial_account_items_data")
            .classList.add("hide-data");
    }
}

function getMutualFundsItems(value) {
    if (value == "yes") {
        document
            .getElementById("bonds_mutual_funds_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("bonds_mutual_funds_items_data")
            .classList.add("hide-data");
    }
}

function getNonPubliclyItems(value) {
    if (value == "yes") {
        document
            .getElementById("non_publicly_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("non_publicly_items_data")
            .classList.add("hide-data");
    }
}

function getGovernmentCoperateItems(value) {
    if (value == "yes") {
        document
            .getElementById("government_corporate_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("government_corporate_data")
            .classList.add("hide-data");
    }
}

function getRetirementPensionItems(value) {
    if (value == "yes") {
        document
            .getElementById("retirement_pension_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("retirement_pension_data")
            .classList.add("hide-data");
    }
}

function getSecurityDepositsItems(value, index) {
    if (value == "yes") {
        document
            .getElementById("security_deposits_data_"+index)
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("security_deposits_data_"+index)
            .classList.add("hide-data");
    }
}

function getPrepaymentsItems(value) {
    if (value == "yes") {
        document
            .getElementById("prepayments_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("prepayments_data").classList.add("hide-data");
    }
}

function getAnnuitiesItems(value) {
    if (value == "yes") {
        document.getElementById("annuities_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("annuities_data").classList.add("hide-data");
    }
}

function getEducationIRAItems(value) {
    if (value == "yes") {
        document
            .getElementById("education_IRA_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("education_IRA_data")
            .classList.add("hide-data");
    }
}

function getInterestPropertyItems(value) {
    if (value == "yes") {
        document
            .getElementById("interestin_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("interestin_property_data")
            .classList.add("hide-data");
    }
}

function getintellectualPropertyItems(value) {
    if (value == "yes") {
        document
            .getElementById("intellectual_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("intellectual_property_data")
            .classList.add("hide-data");
    }
}

function getGeneralIntangiblesItems(value) {
    if (value == "yes") {
        document
            .getElementById("genral_intangibles_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("genral_intangibles_data")
            .classList.add("hide-data");
    }
}

function getTaxRefundsItems(value) {
    if (value == "yes") {
        document
            .getElementById("tax_refunds_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("tax_refunds_data").classList.add("hide-data");
    }
}

function getAlimonyChildItems(value) {
    if (value == "yes") {
        document
            .getElementById("alimony_child_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("alimony_child_data")
            .classList.add("hide-data");
    }
}

function getUnpaidWagesItems(value) {
    if (value == "yes") {
        document
            .getElementById("unpaid_wages_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("unpaid_wages_data").classList.add("hide-data");
    }
}

function getLifeInsuranceItems(value) {
    if (value == "yes") {
        document
            .getElementById("life_insurance_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("life_insurance_data")
            .classList.add("hide-data");
    }
}

function getInsurancePoliciesItems(value) {
    if (value == "yes") {
        document
            .getElementById("insurance_policies_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("insurance_policies_data")
            .classList.add("hide-data");
    }
}

function getInheritancesBenefitsItems(value) {
    if (value == "yes") {
        document
            .getElementById("Inheritances_benefits_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("Inheritances_benefits_data")
            .classList.add("hide-data");
    }
}

function getPersonalInjuryItems(value) {
    if (value == "yes") {
        document
            .getElementById("personal_injury_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("personal_injury_data")
            .classList.add("hide-data");
    }
}

function getLawsuitsItems(value) {
    if (value == "yes") {
        document.getElementById("Lawsuits_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("Lawsuits_data").classList.add("hide-data");
    }
}

function getOtherClaimsItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_claims_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("other_claims_data").classList.add("hide-data");
    }
}

function getFinancialAssetItems(value) {
    if (value == "yes") {
        document
            .getElementById("financial_asset_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("financial_asset_data")
            .classList.add("hide-data");
    }
}

// Part E //
function getAccountsReceivableItems(value) {
    if (value == "yes") {
        document
            .getElementById("account_receivable_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("account_receivable_data")
            .classList.add("hide-data");
    }
}

function getOfficeEquipmentItems(value) {
    if (value == "yes") {
        document
            .getElementById("office_equipment_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("office_equipment_data")
            .classList.add("hide-data");
    }
}

function getMachineryTradeItems(value) {
    if (value == "yes") {
        document
            .getElementById("machinery_trade_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("machinery_trade_data")
            .classList.add("hide-data");
    }
}

function getBusinessInventoryItems(value) {
    if (value == "yes") {
        document
            .getElementById("business_inventory_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("business_inventory_data")
            .classList.add("hide-data");
    }
}

function getInterestsPartnershipsItems(value) {
    if (value == "yes") {
        document.getElementById("interests_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("interests_data").classList.add("hide-data");
    }
}

function getCustomerMailingItems(value) {
    if (value == "yes") {
        document
            .getElementById("customer_mailing_lists_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("customer_mailing_lists_data")
            .classList.add("hide-data");
    }
}

function getOtherBusimessItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_business_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other_business_data")
            .classList.add("hide-data");
    }
}

// Part F //

function getFarmAnimalsItems(value) {
    if (value == "yes") {
        document
            .getElementById("farm_animals_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("farm_animals_data").classList.add("hide-data");
    }
}

function getCropsItems(value) {
    if (value == "yes") {
        document.getElementById("crops_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("crops_data").classList.add("hide-data");
    }
}

function getCommercialFishingEquipmentItems(value) {
    if (value == "yes") {
        document
            .getElementById("commercial_fishing_equipment_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("commercial_fishing_equipment_data")
            .classList.add("hide-data");
    }
}

function getCommercialFishingItems(value) {
    if (value == "yes") {
        document
            .getElementById("commercial_fishing_supplies_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("commercial_fishing_supplies_data")
            .classList.add("hide-data");
    }
}

function getAdditionalLoan(value, obj) {

    var parentDiv = $(obj).closest(".loan_own_type_property_sec");
    var targetDiv = parentDiv.find(".section_additional_loan");
    if (value == "yes") {
        targetDiv.removeClass("hide-data");
        
    } else if (value == "no") {
        targetDiv.addClass("hide-data");
    }
}


function getSecondAdditionalLoan(value, obj) {

    var parentDiv = $(obj).closest(".loan_own_type_property_sec");
    var targetDiv = parentDiv.find(".section_additional_loan_second");
    if (value == "yes") {
        targetDiv.removeClass("hide-data");
        
    } else if (value == "no") {
        targetDiv.addClass("hide-data");
    }
}

function getboname(value, obj) {
    if (value == "yes") {
        $(obj)
            .parents(".have_access_of_box")
            .next(".have-access-box")
            .removeClass("hide-data");
        // document.getElementById('own_property_data').classList.remove("hide-data");
    } else if (value == "no") {
        $(obj)
            .parents(".have_access_of_box")
            .next(".have-access-box")
            .addClass("hide-data");
        // document.getElementById('own_property_data').classList.add("hide-data");
    }
}

function getotherboname(value, obj) {
    if (value == "yes") {
        $(obj)
            .parents(".other_have_access_of_box")
            .next(".other-have-access-box")
            .removeClass("hide-data");
        // document.getElementById('own_property_data').classList.remove("hide-data");
    } else if (value == "no") {
        $(obj)
            .parents(".other_have_access_of_box")
            .next(".other-have-access-box")
            .addClass("hide-data");
        // document.getElementById('own_property_data').classList.add("hide-data");
    }
}

function getCommercialFishingPropertyItems(value) {
    if (value == "yes") {
        document
            .getElementById("commercial_fishing_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("commercial_fishing_property_data")
            .classList.add("hide-data");
    }
}

// Part G

function getPreviouslylistedItems(value) {
    if (value == "yes") {
        document
            .getElementById("previously_listed_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("previously_listed_data")
            .classList.add("hide-data");
    }
}

function GetotherDeductions11(value) {
    if (value == "yes") {
        document
            .getElementById("otherDeductions11_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("otherDeductions11_data")
            .classList.add("hide-data");
    }
}

function GetotherDeductions22(value) {
    if (value == "yes") {
        document
            .getElementById("otherDeductions22_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("otherDeductions22_data")
            .classList.add("hide-data");
    }
}

function getotherInsNotListedSpouse(value) {
    if (value == "yes") {
        document
            .getElementById("other_insurance1")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other_insurance1")
            .classList.add("hide-data");
    }
}

function getPaymentsforadditionaldepSpouse(value) {
    if (value == "yes") {
        document
            .getElementById("PaymentsforadditionaldepSpouse_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("PaymentsforadditionaldepSpouse_data")
            .classList.add("hide-data");
    }
}

function getotherRealPropertyNotAddedSpouse(value) {
    if (value == "yes") {
        document
            .getElementById("otherRealPropertyNotAddedSpouse_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("otherRealPropertyNotAddedSpouse_data")
            .classList.add("hide-data");
    }
}

//// Section C  ////
// Steps
function submitFormSectionC() {
    document.getElementById("section3-tab").classList.remove("active");
    document.getElementById("section4-tab").classList.add("active");

    document.getElementById("section3").classList.remove("active", "show");
    document.getElementById("section4").classList.add("active", "show");
}
var sectionThreeNum = 0;

function changeSectionCStep() {
    sectionThreeNum = sectionThreeNum + 1;
    if (sectionThreeNum == 1) {
        var partA = document.getElementById("debts-part-a");
        var partB = document.getElementById("debts-part-b");
        partA.classList.add("hidestep");
        partB.classList.remove("hidestep");
    }
    // if (sectionThreeNum == 2) {
    //     var partB = document.getElementById("debts-part-b");
    //     var partC = document.getElementById("debts-part-c");
    //     partB.classList.add('hidestep');
    //     partC.classList.remove('hidestep');
    // }
    // if (sectionThreeNum == 3) {
    //     var partC = document.getElementById("debts-part-c");
    //     var partD = document.getElementById("debts-part-d");
    //     partC.classList.add('hidestep');
    //     partD.classList.remove('hidestep');
    // }
    // if (sectionThreeNum == 4) {
    //     var partD = document.getElementById("debts-part-d");
    //     var partE = document.getElementById("debts-part-e");
    //     partD.classList.add('hidestep');
    //     partE.classList.remove('hidestep');
    // }
    // if (sectionThreeNum == 5) {
    //     var partE = document.getElementById("debts-part-e");
    //     var partF = document.getElementById("debts-part-f");
    //     partE.classList.add('hidestep');
    //     partF.classList.remove('hidestep');
    // }
    // if (sectionThreeNum == 6) {
    //     var partE = document.getElementById("debts-part-f");
    //     var partF = document.getElementById("debts-part-g");
    //     partE.classList.add('hidestep');
    //     partF.classList.remove('hidestep');
    // }
}

// Part A
function geCodebtorCosignerItems(value, obj) {
    if (value == "yes") {
        $(obj)
            .parents(".codebtor_cosigner_data_obj")
            .next(".codebtor_cosigner_data")
            .removeClass("hide-data");
        // document.getElementById('own_property_data').classList.remove("hide-data");
    } else if (value == "no") {
        $(obj)
            .parents(".codebtor_cosigner_data_obj")
            .next(".codebtor_cosigner_data")
            .addClass("hide-data");
        // document.getElementById('own_property_data').classList.add("hide-data");
    }
}

function getUnpaidTaxesItems(value) {
    var x = document.getElementById("type_of_debt").value;
    if (x == "8") {
        document
            .getElementById("unpaid_taxes_data")
            .classList.remove("hide-data");
    } else {
        document.getElementById("unpaid_taxes_data").classList.add("hide-data");
    }
}

//// Section D  ////

// Steps

var sectionFourNum = 0;

function changeSectionDStep() {
    sectionFourNum = sectionFourNum + 1;
    if (sectionFourNum == 1) {
        var partA = document.getElementById("current-income-part-a");
        var partB = document.getElementById("current-income-part-b");
        partA.classList.add("hidestep");
        partB.classList.remove("hidestep");
    }
    if (sectionFourNum == 2) {
        var partB = document.getElementById("current-income-part-b");
        var partC = document.getElementById("current-income-part-c");
        partB.classList.add("hidestep");
        partC.classList.remove("hidestep");
    }
    if (sectionFourNum == 3) {
        var partC = document.getElementById("current-income-part-c");
        var partD = document.getElementById("current-income-part-d");
        partC.classList.add("hidestep");
        partD.classList.remove("hidestep");
    }
}

function GetDebtorGrossWages(value) {
    if (value == "yes") {
        document
            .getElementById("debtor-gross-wages")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("debtor-gross-wages")
            .classList.add("hide-data");
    }
}

function GetDebtorOperationBusiness(value) {
    if (value == "yes") {
        document
            .getElementById("operation_business")
            .classList.remove("hide-data");
        $('.DebtorOperationBusiness-radio-div').addClass('pb-3');
    } else if (value == "no") {
        document
            .getElementById("operation_business")
            .classList.add("hide-data");
        $('.DebtorOperationBusiness-radio-div').removeClass('pb-3')
    }
}

function GetDebtorRentalRealProperty(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "same_rent_income",
            "avg",
            "rent_real_property_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_rent_income",
            "multi",
            "rent_real_property_month"
        );
    }
}

function addLastMonthIncomeList(parentId, type, name) {
    var newInputlist = "";
    if (type == "avg") {
        newInputlist =
            `
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">Average (Per month) </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field required no_dup_inp" name="` +
                                    name +
                                    `[` +
                                    1 +
                            `]" value=""/>
                        </div>
                    </div>
                </div>
            </div>
            `;
    } else {
        var currentDate = new Date();
        currentDate.setTime(currentDate.getTime() + currentDate.getTimezoneOffset() * 60 * 1000);
        var monthYears = [];
        var newInputlist = ''; // Initialize newInputlist

        for (let i = 1; i <= 6; i++) {
            let tempDate = new Date(currentDate); // Clone currentDate to avoid mutating it
            tempDate.setMonth(tempDate.getMonth() - i);
            
            let month = tempDate.toLocaleString("default", { month: "long" });
            let year = tempDate.getFullYear();

            monthYears.push({ month: month, year: year });

            newInputlist += `
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2 no_dup_col">
                    <div class="label-div">
                        <div class="form-group">
                            <label class="d-block"> Month ${i}:&nbsp;${month}, ${year} </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control price-field required no_dup_inp" name="${name}[${i}]" value=""/>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

    }

    $("#" + parentId).html(newInputlist);
}

function resetIncomeValue(inputName, isSameInput) {
    var i_count = 6;
    $('input[name="' + isSameInput + '"]').val();
    for (let n = 0; n < i_count; n++) {
        if ($('input[name="' + inputName + "[" + n + ']"]').val()) {
            $('input[name="' + inputName + "[" + n + ']"]').val("");
        } else {
            break;
        }
    }
}

function GetIsDebtorRecievingRentSame(value) {
    if (value == "yes") {
        document
            .getElementById("recieve_same_rent_amount")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue("rent_real_property_month", "same_rent_income");
        document
            .getElementById("recieve_same_rent_amount")
            .classList.add("hide-data");
    }
}

function GetDebtorRoyalties(value) {
    if (value == "yes") {
        addLastMonthIncomeList("same_royalty_income", "avg", "royalties_month");
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_royalty_income",
            "multi",
            "royalties_month"
        );
    }
}

function GetIsDebtorSameRoyalties(value) {
    if (value == "yes") {
        document.getElementById("royalties").classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue("royalties_month", "same_royalty_income");
        document.getElementById("royalties").classList.add("hide-data");
    }
}

function GetDebtorretiRementIncome(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "same_retirement_income",
            "avg",
            "retirement_income_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_retirement_income",
            "multi",
            "retirement_income_month"
        );
    }
}

function GetIsDebtorSameretiRementIncome(value) {
    if (value == "yes") {
        document
            .getElementById("retirement_income")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue("retirement_income_month", "same_retirement_income");
        document.getElementById("retirement_income").classList.add("hide-data");
    }
}

function GetDebtorRegularContributions(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "same_regular_contribution_income",
            "avg",
            "regular_contributions_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_regular_contribution_income",
            "multi",
            "regular_contributions_month"
        );
    }
}

function GetIsDebtorSameRegularContributions(value) {
    if (value == "yes") {
        document
            .getElementById("regular_contributions")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "regular_contributions_month",
            "same_regular_contribution_income"
        );
        document
            .getElementById("regular_contributions")
            .classList.add("hide-data");
    }
}

function GetDebtorUnemploymentCompensation(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "same_unemployement_compensation_income",
            "avg",
            "unemployment_compensation_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_unemployement_compensation_income",
            "multi",
            "unemployment_compensation_month"
        );
    }
}

function GetDebtorIsSameUnemploymentCompensation(value) {
    if (value == "yes") {
        document
            .getElementById("unemployment_compensation")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "unemployment_compensation_month",
            "same_unemployement_compensation_income"
        );
        document
            .getElementById("unemployment_compensation")
            .classList.add("hide-data");
    }
}

function GetDebtorSocialIncome(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "same_social_security_income",
            "avg",
            "social_security_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_social_security_income",
            "multi",
            "social_security_month"
        );
    }
}

function GetIsSameDebtorSocialIncome(value) {
    if (value == "yes") {
        document
            .getElementById("social_security")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "social_security_month",
            "same_social_security_income"
        );
        document.getElementById("social_security").classList.add("hide-data");
    }
}

function GetDebtorGovernmentAssistance(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "same_government_assistance_income",
            "avg",
            "government_assistance_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_government_assistance_income",
            "multi",
            "government_assistance_month"
        );
    }
}

function GetIsSameDebtorGovernmentAssistance(value) {
    if (value == "yes") {
        document
            .getElementById("government_assistance")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "government_assistance_month",
            "same_government_assistance_income"
        );
        document
            .getElementById("government_assistance")
            .classList.add("hide-data");
    }
}

function GetSpouseGovernmentAssistance(value) {
    if (value == "yes") {
        document
            .getElementById("spouse_government_assistance")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "government_assistance_month",
            "joints_same_government_assistance_income"
        );
        document
            .getElementById("spouse_government_assistance")
            .classList.add("hide-data");
    }
}

function IsGetSpouseGovernmentAssistance(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_government_assistance_income",
            "avg",
            "government_assistance_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_government_assistance_income",
            "multi",
            "government_assistance_month"
        );
    }
}

function GetDebtoOtherSource(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "same_other_sources_income",
            "avg",
            "other_sources_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "same_other_sources_income",
            "multi",
            "other_sources_month"
        );
    }
}

function GetIsSameDebtoOtherSource(value) {
    if (value == "yes") {
        document.getElementById("other_sources").classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue("other_sources_month", "same_other_sources_income");
        document.getElementById("other_sources").classList.add("hide-data");
    }
}

// Joint Debuts
function GetJointGrossWages(value) {
    if (value == "yes") {
        document
            .getElementById("Joint-gross-wages")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("Joint-gross-wages").classList.add("hide-data");
    }
}

function GetJointOperationBusiness(value) {
    if (value == "yes") {
        document.getElementById("joint_operation_business").classList.remove("hide-data");
        $('.JointOperationBusiness-radio-div').addClass('pb-3')
    } else if (value == "no") {
        document.getElementById("joint_operation_business").classList.add("hide-data");
        $('.JointOperationBusiness-radio-div').removeClass('pb-3')
    }
}

function GetJointRentalRealProperty(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_rent_income",
            "avg",
            "joints_rent_real_property_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_rent_income",
            "multi",
            "joints_rent_real_property_month"
        );
    }
}

function isSameJointRentalRealProperty(value) {
    if (value == "yes") {
        document
            .getElementById("joints_rent_real_property")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "joints_rent_real_property_month",
            "joints_same_rent_income"
        );
        document
            .getElementById("joints_rent_real_property")
            .classList.add("hide-data");
    }
}

function GetJointRoyalties(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_royalty_income",
            "avg",
            "joints_royalties_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_royalty_income",
            "multi",
            "joints_royalties_month"
        );
    }
}

function isSameJointRoyalties(value) {
    if (value == "yes") {
        document
            .getElementById("joints_royalties")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "joints_royalties_month",
            "joints_same_royalty_income"
        );
        document.getElementById("joints_royalties").classList.add("hide-data");
    }
}

function GetJointretiRementIncome(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_retirement_income",
            "avg",
            "joints_retirement_income_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_retirement_income",
            "multi",
            "joints_retirement_income_month"
        );
    }
}

function isSameJointretiRementIncome(value) {
    if (value == "yes") {
        document
            .getElementById("joints_retirement_income")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "joints_retirement_income_month",
            "joints_same_retirement_income"
        );
        document
            .getElementById("joints_retirement_income")
            .classList.add("hide-data");
    }
}

function GetJointRegularContributions(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_contribution_income",
            "avg",
            "joints_regular_contributions_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_contribution_income",
            "multi",
            "joints_regular_contributions_month"
        );
    }
}

function isSameJointRegularContributions(value) {
    if (value == "yes") {
        document
            .getElementById("joints_regular_contributions")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "joints_regular_contributions_month",
            "joints_same_contribution_income"
        );
        document
            .getElementById("joints_regular_contributions")
            .classList.add("hide-data");
    }
}

function isSameJointUnemploymentCompensation(value) {
    if (value == "yes") {
        document
            .getElementById("joints_unemployment_compensation")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "joints_regular_contributions_month",
            "joints_same_contribution_income"
        );
        document
            .getElementById("joints_unemployment_compensation")
            .classList.add("hide-data");
    }
}

function GetJointUnemploymentCompensation(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_unemployement_compensation",
            "avg",
            "joints_unemployment_compensation_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_unemployement_compensation",
            "multi",
            "joints_unemployment_compensation_month"
        );
    }
}

function isSameJointSocialIncome(value) {
    if (value == "yes") {
        document
            .getElementById("joints_social_security")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "joints_social_security_month",
            "joints_same_social_security_income"
        );
        document
            .getElementById("joints_social_security")
            .classList.add("hide-data");
    }
}

function GetJointSocialIncome(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_social_security_income",
            "avg",
            "joints_social_security_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_social_security_income",
            "multi",
            "joints_social_security_month"
        );
    }
}

function GetJointsOtherSource(value) {
    if (value == "yes") {
        document
            .getElementById("joints_other_sources")
            .classList.remove("hide-data");
    } else if (value == "no") {
        resetIncomeValue(
            "joints_other_sources_month",
            "joints_same_other_sources_income"
        );
        document
            .getElementById("joints_other_sources")
            .classList.add("hide-data");
    }
}

function IsGetJointsOtherSource(value) {
    if (value == "yes") {
        addLastMonthIncomeList(
            "joints_same_other_sources_income",
            "avg",
            "joints_other_sources_month"
        );
    } else if (value == "no") {
        addLastMonthIncomeList(
            "joints_same_other_sources_income",
            "multi",
            "joints_other_sources_month"
        );
    }
}

function getotherInsurance_notListed(value) {
    if (value == "yes") {
        document
            .getElementById("other_insurance1")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("other_insurance1").classList.add("hide-data");
    }
}

function getPaymentforsupport_n(value) {
    if (value == "yes") {
        document
            .getElementById("paymentforsupport_dependents_n1")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("paymentforsupport_dependents_n1")
            .classList.add("hide-data");
    }
}

function getAlimonyMaintenance(value) {
    if (value == "yes") {
        document
            .getElementById("alimony_maintenance_div")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("alimony_maintenance_div")
            .classList.add("hide-data");
    }
}

function getTaxbillNotDeducted(value) {
    if (value == "yes") {
        document
            .getElementById("tax_bill_not_deducted_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("tax_bill_not_deducted_data")
            .classList.add("hide-data");
    }
}

function getOtherExpense(value) {
    if (value == "yes") {
        document
            .getElementById("other_expenses_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other_expenses_data")
            .classList.add("hide-data");
    }
}

function getInstallmentPaymentForCar(value) {
    if (value == "yes") {
        document
            .getElementById("installment_payments1")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("installment_payments1")
            .classList.add("hide-data");
    }
}

//// Section E  ////

// Steps

function addRelationshipForm() {
    var clnln = $(document).find(".all_dependents_form").length;
    if (clnln > 4) {
        $.systemMessage("You can only insert 5 dependents.", 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".all_dependents_form").last();
        var index_val = $(itm).index() + 1;
        var cln = $(itm).clone();

        cln.removeClass(function (index, className) {
            return (className.match(/all_dependents_form_\d+/g) || []).join(' ');
        }).addClass("all_dependents_form_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('all_dependents_form', " + index_val + ");updateAveragePrice();return false");
        cln.find(".circle-number-div").html(index_val+1);

        var dependent_live_with = cln.find(".dependent_live_with");
        var dependent_relationship = cln.find(".dependent_relationship");
        var dependent_age = cln.find(".dependent_age");
        //work only update case
        // cln.find('.property_vehicle_ids').remove();

        $(dependent_relationship).each(function () {
            $(this).attr("name", "dependent_relationship[" + index_val + "]").val('');
        });
        $(dependent_age).each(function () {
            $(this).attr("name", "dependent_age[" + index_val + "]");
        });
        $(dependent_live_with).each(function () {
            $(this).attr("name", "dependent_live_with[" + index_val + "]");
            if ($(this).val() == "0") {
                $(this).attr("id", "dependent_live_with_yes_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "dependent_live_with_yes_" + index_val)
                    .removeClass('active');
            }
            if ($(this).val() == "1") {
                $(this).attr("id", "dependent_live_with_no_" + index_val);
                $(this)
                    .next("label")
                    .attr("for", "dependent_live_with_no_" + index_val)
                    .removeClass('active');
            }
            $(this).attr("checked", false);
        });
        cln.find('input[type="text"]').val("");
        $(itm).after(cln);
    }
}

function addDeductionSection() {
    var clnln = $(document).find(".deduction_section").length;
    if (clnln > 9) {
        alert("You can only insert 10 deductions.");
        return false;
    } else {
        var itm = $(document).find(".deduction_section").last();
        var index_val = $(itm).index() + 1;
        var cln = $(itm).clone();

        let divclass = "deduction_section";
        cln.removeClass(function (index, className) {
            return (className.match(divclass + "_\\d+", "g") || []).join(' ');
        }).addClass(divclass + "_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
        cln.find(".circle-number-div").html(index_val + 1);

        var other_deduction_type = cln.find(".other_deduction_type");
        var other_deduction_specify = cln.find(".other_deduction_specify");
        var other_deduction = cln.find(".other_deduction");

        $(other_deduction_type).each(function () {
            $(this).attr("name", "other_deduction_type[" + index_val + "]");
            $(this)
                .removeClass("other_deduction_type_" + (index_val - 1))
                .addClass("other_deduction_type_" + index_val);
            $(this).attr("onchange", "deductionChange(" + index_val + ")");
            $(this).val("");
        });

        cln.find(".other_deduction_specify_" + (index_val - 1))
            .removeClass("other_deduction_specify_" + (index_val - 1))
            .addClass("other_deduction_specify_" + index_val)
            .addClass("hide-data");

        $(other_deduction_specify).each(function () {
            $(this).attr("name", "other_deduction_specify[" + index_val + "]");
            $(this).val("");
        });
        $(other_deduction).each(function () {
            $(this).attr("name", "other_deduction[" + index_val + "]");
            $(this).val("");
        });
        cln.find("label").removeClass("active");

        $(itm).after(cln);
    }
}

function addAdditionalBusinessSection() {
    var found = false;
    
    // Loop through business sections 1 to 6
    for (var i = 1; i <= 6; i++) {
        if ($(".operation_business.company_" + i).hasClass("hide-data")) {
            $(".operation_business.company_" + i).removeClass("hide-data");
            $('.DebtorOperationBusiness-radio-div').removeClass('pb-3');
            found = true;
            break; // Stop after showing the first hidden section
        }
    }
    
    if (!found) {
        alert("You have already added additional company.");
        return false;
    }
}

function addAdditionalBusinessSectionJoint() {
    var found = false;
    
    // Loop through business sections 1 to 6
    for (var i = 1; i <= 6; i++) {
        if ($(".joint_operation_business.company_" + i).hasClass("hide-data")) {
            $(".joint_operation_business.company_" + i).removeClass("hide-data");
            $('.JointOperationBusiness-radio-div').removeClass('pb-3');
            found = true;
            break; // Stop after showing the first hidden section
        }
    }
    
    if (!found) {
        alert("You have already added additional company.");
        return false;
    }
}

function addSpouseDeductionSection() {
    var clnln = $(document).find(".spouse_deduction_section").length;
    
    if (clnln > 9) {
        alert("You can only insert 10 deductions.");
        return false;
    } else {
        var itm = $(document).find(".spouse_deduction_section").last();
        var index_val = $(itm).index()+1;
        var cln = $(itm).clone();
        let divclass = "spouse_deduction_section";
        cln.removeClass(function (index, className) {
            return (className.match(divclass + "_\\d+", "g") || []).join(' ');
        }).addClass(divclass + "_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
        cln.find(".circle-number-div").html(index_val + 1);
        var joints_other_deduction_type = cln.find(
            ".joints_other_deduction_type"
        );
        var joint_other_deduction_specify = cln.find(
            ".joint_other_deduction_specify"
        );
        
        var joints_other_deduction = cln.find(".joints_other_deduction");
        cln.find(".delete-div").attr("onclick", "remove_div_common('spouse_deduction_section', " + index_val + ")");
        
        cln.find(".circle-number-div").html(index_val + 1);
        $(joints_other_deduction_type).each(function () {
            $(this).attr(
                "name",
                "joints_other_deduction_type[" + index_val + "]"
            );
            $(this)
                .removeClass("joints_other_deduction_type_" + (index_val - 1))
                .addClass("joints_other_deduction_type_" + index_val);
            $(this).attr(
                "onchange",
                "deductionChange(" + index_val + ", true)"
            );
            $(this).val("");
        });
        
       
      

        cln.find(".joints_other_deduction_specify_" + (index_val - 1))
            .removeClass("joints_other_deduction_specify_" + (index_val - 1))
            .addClass("joints_other_deduction_specify_" + index_val)
            .addClass("hide-data");

        $(joint_other_deduction_specify).each(function () {
            $(this).attr("name", "other_deduction_specify[" + index_val + "]");
            $(this).val("");
        });
        $(joints_other_deduction).each(function () {
            $(this).attr("name", "joints_other_deduction[" + index_val + "]");
            $(this).val("");
        });
        cln.find("label").removeClass("active");

        $(itm).after(cln);
    }
}

function addMonthyAmountForm() {
    // var itm2 = document.getElementById("monthly-amount-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("monthly-amount-2").appendChild(cln2);
    var clnln = $(document).find(".monthly_amount").length;
    if (clnln > 4) {
        alert("You can only insert 5 utility bills.");
        return false;
    } else {
        var itm = $(document).find(".monthly_amount").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();

        var monthly_utilities_bills = cln.find(".monthly_utilities_bills");
        var monthly_utilities_value = cln.find(".monthly_utilities_value");

        //work only update case
        // cln.find('.property_vehicle_ids').remove();

        $(monthly_utilities_bills).each(function () {
            $(this).attr("name", "monthly_utilities_bills[" + index_val + "]");
        });
        $(monthly_utilities_value).each(function () {
            $(this).attr("name", "monthly_utilities_value[" + index_val + "]");
        });
        cln.find('input[type="text"]').val("");
        cln.find("textarea").val("");
        $(itm).after(cln);
    }
}

function addOtherInsuranceForm() {
    // var itm2 = document.getElementById("other-insurance-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("other-insurance-2").appendChild(cln2);
    var clnln = $(document).find(".other_insurance").length;
    if (clnln > 4) {
        alert("You can only describe 5 Other insurance.");
        return false;
    } else {
        var itm = $(document).find(".other_insurance").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();

        var other_insurance_value = cln.find(".other_insurance_value");
        var other_insurance_price = cln.find(".other_insurance_price");

        //work only update case
        // cln.find('.property_vehicle_ids').remove();

        $(other_insurance_value).each(function () {
            $(this).attr("name", "other_insurance_value[" + index_val + "]");
        });
        $(other_insurance_price).each(function () {
            $(this).attr("name", "other_insurance_price[" + index_val + "]");
        });
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        $(itm).after(cln);
    }
}

function addTaxbillsForm() {
    // var itm2 = document.getElementById("tax-bills-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("tax-bills-2").appendChild(cln2);
    var clnln = $(document).find(".tax_bills").length;
    if (clnln > 4) {
        alert("You can only describe 5 Other insurance.");
        return false;
    } else {
        var itm = $(document).find(".tax_bills").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();

        var taxbills_value = cln.find(".taxbills_value");
        var taxbills_price = cln.find(".taxbills_price");

        //work only update case
        // cln.find('.property_vehicle_ids').remove();

        $(taxbills_value).each(function () {
            $(this).attr("name", "taxbills_value[" + index_val + "]");
        });
        $(taxbills_price).each(function () {
            $(this).attr("name", "taxbills_price[" + index_val + "]");
        });

        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("textarea").val("");
        $(itm).after(cln);
    }
}

async function addListAllPropertyTransferForm() {
    var clnln = $(document).find(".all_property_transfer_10_year_data").length;
    const status = await seperate_save('all_property_transfer_10_year','all_property_transfer_10_year_data', 'list-all-property_transfer-data', 'parent_all_property_transfer_10_year', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 3) {
            alert("You can add only 4 entries.");
            return false;
        } else {
            var itm = $(document)
                .find(".all_property_transfer_10_year_data")
                .last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "all_property_transfer_10_year_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('all_property_transfer_10_year','all_property_transfer_10_year_data', 'list-all-property_transfer-data', 'parent_all_property_transfer_10_year', " + index_val + ")");
            var trust_name = cln.find(".trust_name");
            var year_property_transfer = cln.find(".10year_property_transfer");
            var year_property_transfer_date = cln.find(
                ".10year_property_transfer_date"
            );
            cln.find("input").val("");
            cln.find("select").val("");
            $(trust_name).each(function () {
                $(this).attr(
                    "name",
                    "all_property_transfer_10_year_data[trust_name][" +
                        index_val +
                        "]"
                );
            });
            $(year_property_transfer).each(function () {
                $(this).attr(
                    "name",
                    "all_property_transfer_10_year_data[10year_property_transfer][" +
                        index_val +
                        "]"
                );
            });
            $(year_property_transfer_date).each(function () {
                $(this).attr(
                    "name",
                    "all_property_transfer_10_year_data[10year_property_transfer_date][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

function addInstallmentPaymentsForm() {
    // var itm2 = document.getElementById("installment-payments-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("installment-payments-2").appendChild(cln2);
    var clnln = $(document).find(".installment_payments").length;
    if (clnln > 10) {
        $.systemMessage("You can only describe 11 Installment Payments.", 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".installment_payments").last();
        var index_val = $(itm).index();
        index_val = index_val + 1;
        var cln = $(itm).clone();
        
        cln.removeClass(function (index, className) {
            return (className.match(/installment_payments_\d+/g) || []).join(' ');
        }).addClass("installment_payments_" + index_val);
        cln.find(".delete-div").attr("onclick", "remove_div_common('installment_payments', " + index_val + ");return false;");
        cln.find(".circle-number-div").html(index_val+1);

        var installmentpayments_price = cln.find(".installmentpayments_price");
        var installmentpayments_value = cln.find(".installmentpayments_value");
        var installmentpayments_type = cln.find(".installmentpayments_type");
        $(installmentpayments_price).each(function () {
            $(this).attr(
                "name",
                "installmentpayments_price[" + index_val + "]"
            );
        });
        $(installmentpayments_value).each(function () {
            $(this).attr(
                "name",
                "installmentpayments_value[" + index_val + "]"
            );
        });
        $(installmentpayments_type).each(function () {
            $(this).attr("name", "installmentpayments_type[" + index_val + "]");
        });
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(itm).after(cln);
    }
}

function addOtherExpensesForm() {
    // var itm2 = document.getElementById("other-expenses-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("other-expenses-2").appendChild(cln2);
    var clnln = $(document).find(".other_expenses").length;
    if (clnln > 4) {
        alert("You can only describe 5 Other insurance.");
        return false;
    } else {
        var itm = $(document).find(".other_expenses").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();

        var additional_expenses_value = cln.find(".additional_expenses_value");
        var additional_expenses_price = cln.find(".additional_expenses_price");

        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(additional_expenses_value).each(function () {
            $(this).attr(
                "name",
                "additional_expenses_value[" + index_val + "]"
            );
        });
        $(additional_expenses_price).each(function () {
            $(this).attr(
                "name",
                "additional_expenses_price[" + index_val + "]"
            );
        });

        $(itm).after(cln);
    }
}

function addPayrollDeductionsForm() {
    // var itm2 = document.getElementById("payroll-deductions-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("payroll-deductions-2").appendChild(cln2);
    var clnln = $(document).find(".payroll_deductions").length;
    if (clnln > 4) {
        alert("You can only describe 5 Other insurance.");
        return false;
    } else {
        var itm = $(document).find(".payroll_deductions").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();

        var payroll_deductions_value = cln.find(".payroll_deductions_value");
        var payroll_deductions_price = cln.find(".payroll_deductions_price");

        //work only update case
        // cln.find('.property_vehicle_ids').remove();
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(payroll_deductions_value).each(function () {
            $(this).attr("name", "payroll_deductions_value[" + index_val + "]");
        });
        $(payroll_deductions_price).each(function () {
            $(this).attr("name", "payroll_deductions_price[" + index_val + "]");
        });

        $(itm).after(cln);
    }
}

function addOrderedPaymentsForm() {
    // var itm2 = document.getElementById("ordered-payments-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("ordered-payments-2").appendChild(cln2);
    var clnln = $(document).find(".ordered_payments").length;
    if (clnln > 4) {
        alert("You can only list 5 Court ordered payments.");
        return false;
    } else {
        var itm = $(document).find(".ordered_payments").last();
        var index_val = $(itm).index() + 1;
        var cln = $(itm).clone();

        var court_payments_value = cln.find(".court_payments_value");
        var court_payments_price = cln.find(".court_payments_price");

        //work only update case
        // cln.find('.property_vehicle_ids').remove();
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(court_payments_value).each(function () {
            $(this).attr("name", "court_payments_value[" + index_val + "]");
        });
        $(court_payments_price).each(function () {
            $(this).attr("name", "court_payments_price[" + index_val + "]");
        });

        $(itm).after(cln);
    }
}

function addRetirementAccountsForm() {
    // var itm2 = document.getElementById("retirement-accounts-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("retirement-accounts-2").appendChild(cln2);
    var clnln = $(document).find(".retirement_accounts").length;
    if (clnln > 4) {
        alert(
            "You can only list 5 non-mandatory contributions to retirement accounts."
        );
        return false;
    } else {
        var itm = $(document).find(".retirement_accounts").last();
        var index_val = $(itm).index();
        var cln = $(itm).clone();

        var retirement_account_value = cln.find(".retirement_account_value");
        var retirement_account_price = cln.find(".retirement_account_price");

        //work only update case
        // cln.find('.property_vehicle_ids').remove();

        $(retirement_account_value).each(function () {
            $(this).attr(
                "name",
                "non_mandatory_contributions_value[" + index_val + "]"
            );
        });
        $(retirement_account_price).each(function () {
            $(this).attr(
                "name",
                "non_mandatory_contributions_price[" + index_val + "]"
            );
        });
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(itm).after(cln);
    }
}

function getAllDependents(value) {
    if (value == "yes") {
        document.getElementById("all_dependents").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("all_dependents").classList.add("hide-data");
    }
}

function getLiveSeparationData(value) {
    if (value == "yes") {
        document
            .getElementById("live_separately_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("live_separately_data")
            .classList.add("hide-data");
    }
}

function getRealEstateTaxData(value) {
    if (value == "yes") {
        document
            .getElementById("real_estate_taxes_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("real_estate_taxes_data")
            .classList.add("hide-data");
    }
}

function getAmountIncludePropertyData(value) {
    if (value == "yes") {
        document
            .getElementById("amount_include_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("amount_include_property_data")
            .classList.add("hide-data");
    }
}

function getAmountIncludehomeData(value) {
    if (value == "yes") {
        document
            .getElementById("amount_include_home_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("amount_include_home_data")
            .classList.add("hide-data");
    }
}

function getAmountIncludeHomeOwnerData(value) {
    if (value == "yes") {
        document
            .getElementById("amount_include_homeowner_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("amount_include_homeowner_data")
            .classList.add("hide-data");
    }
}

function getMortgagePaymentsrData(value) {
    if (value == "no") {
        document
            .getElementById("mortgage_payments_data")
            .classList.remove("hide-data");
    } else if (value == "yes") {
        document
            .getElementById("mortgage_payments_data")
            .classList.add("hide-data");
    }
}

function getUtilityBillsData(value) {
    if (value == "yes") {
        document
            .getElementById("utility_bills_data")
            .classList.remove("hide-data");
            $(".utility-bills-data-div-d1").removeClass('hide-data');
    } else if (value == "no") {
        document
            .getElementById("utility_bills_data")
            .classList.add("hide-data");
            $(".utility-bills-data-div-d1").addClass('hide-data');
    }
}

function getRealPropertyexpenses(value) {
    if (value == "yes") {
        document
            .getElementById("RealPropertyexpenses_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("RealPropertyexpenses_data")
            .classList.add("hide-data");
    }
}

//// Section F  ////

// Steps

function addEveryAddressForm() {
    
    var clnln = $(document).find(".list_every_addresses").length;
    if (clnln > 4) {
        $.systemMessage('You can only insert 5 entries.', 'alert--danger', true);
        return false;
    } else {
        var itm = $(document).find(".list_every_addresses").last();

        var remove_btn_index = itm
            .find("button.remove_list_every_addresses_clone")
            .data("index");
        if (remove_btn_index > 0) {
            itm.find("button.remove_list_every_addresses_clone").hide();
        }

        var index_val = $(itm).index();
        var cln = $(itm).clone().find("input").val("").end();
        var creditor_name = cln.find(".creditor_name");
        var creditor_street = cln.find(".creditor_street");
        var creditor_city = cln.find(".creditor_city");
        var creditor_state = cln.find(".creditor_state");
        var creditor_zip = cln.find(".creditor_zip");
        var prev_address_from = cln.find(".prev_address_from");
        var prev_address_to = cln.find(".prev_address_to");
        var live_debtor = cln.find(".live_debtor");

        // Update class and delete button for new index
        cln.removeClass(function (index, className) {
            return (className.match(/list_every_addresses_\d+/g) || []).join(' ');
        }).addClass("list_every_addresses_" + index_val);

        cln.find(".delete-div").attr("onclick", "remove_div_common('list_every_addresses', " + index_val + ")");

        
        cln.find(".circle-number-div").html(index_val+1);


        $(creditor_name).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_name][" + index_val + "]"
            );
        });

        $(creditor_city).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_city][" + index_val + "]"
            );
        });

        $(creditor_state).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_state][" + index_val + "]"
            );
        });

        $(creditor_zip).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_zip][" + index_val + "]"
            );
        });

        $(creditor_street).each(function () {
            $(this).attr(
                "name",
                "prev_address[creditor_street][" + index_val + "]"
            );
        });
        $(prev_address_from).each(function () {
            $(this).attr("name", "prev_address[from][" + index_val + "]");
            $(this).removeClass("hasDatepicker").attr("id", "");
            $(this).attr("data-startinputname", "prev_address[from][" + index_val + "]");
            $(this).attr("data-endinputname", "prev_address[to][" + index_val + "]");
        });
        $(prev_address_to).each(function () {
            $(this).attr("name", "prev_address[to][" + index_val + "]");
            $(this).removeClass("hasDatepicker").attr("id", "");
            $(this).attr("data-startinputname", "prev_address[from][" + index_val + "]");
            $(this).attr("data-endinputname", "prev_address[to][" + index_val + "]");
        });
        $(live_debtor).each(function () {
            $(this).attr("name", "prev_address[debtor][" + index_val + "]");
        });

        var new_index_val = index_val + 1;
        cln.find("button.remove_list_every_addresses_clone").attr(
            "data-index",
            new_index_val
        );
        cln.find("button.remove_list_every_addresses_clone").show();
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(itm).after(cln);
        initializeDatepicker();
    }
}

async function addNameAddressSpouseForm() {
      const canEdit = await is_editable('can_edit_sofa');
        if (!canEdit) {
            return false; // Stops execution if no permission
        }
    var clnln = $(document).find(".living_domestic_partners").length;

    const status = await seperate_save('living_domestic_partner','living_domestic_partners', 'living-domestic-partner-data', 'parent_living_domestic_partner', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 9) {
            alert("You can add only 10 entries.");
            return false;
        } else {
            var itm = $(document).find(".living_domestic_partners").last();
            var index_val = $(itm).index();
            index_val = index_val + 1
            var prev_index = index_val - 1;

            var remove_btn_index = itm
                .find("button.remove_living_domestic_partners_clone")
                .data("index");
            if (remove_btn_index > 0) {
                itm.find("button.remove_living_domestic_partners_clone").hide();
            }

            var cln = $(itm).clone();

            let divclass = "living_domestic_partners";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('living_domestic_partner','living_domestic_partners', 'living-domestic-partner-data', 'parent_living_domestic_partner', " + index_val + ")");

            cln.find("label").removeClass("active");
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            var community_property_state = cln.find(".community_property_state");
            var domestic_partner = cln.find(".domestic_partner");
            var domestic_partner_street_address = cln.find(
                ".domestic_partner_street_address"
            );
            var domestic_partner_city = cln.find(".domestic_partner_city");
            var domestic_partner_state = cln.find(".domestic_partner_state");
            var domestic_partner_zip = cln.find(".domestic_partner_zip");
            var domestic_partner_living = cln.find(".domestic_partner_living");
            var spouse_live_section_div = cln.find(
                ".spouse-live-section-" + prev_index
            );

            $(domestic_partner_street_address).each(function () {
                $(this).attr( "name", "domestic_partner_street_address[" + index_val + "]" );
            });
            $(domestic_partner_city).each(function () {
                $(this).attr("name", "domestic_partner_city[" + index_val + "]");
            });
            $(domestic_partner_state).each(function () {
                $(this).attr("name", "domestic_partner_state[" + index_val + "]");
            });
            $(domestic_partner_zip).each(function () {
                $(this).attr("name", "domestic_partner_zip[" + index_val + "]");
            });
            $(domestic_partner_living).each(function () {
                $(this).attr("name", "domestic_partner_living[" + index_val + "]");
                if ($(this).val() == "1") {
                    $(this).next('label').attr( "onclick", 'didSpouseLiveWithYou( 1 ,"' + index_val + '");' );
                    $(this).attr( "id", "domestic_partner_living_yes_" + index_val );
                    $(this).next("label") .attr( "for", "domestic_partner_living_yes_" + index_val );
                }
                if ($(this).val() == "0") {
                    $(this).next('label').attr( "onclick", 'didSpouseLiveWithYou( 0 ,"' + index_val + '");' );
                    $(this).attr( "id", "domestic_partner_living_no_" + index_val );
                    $(this).next("label").attr( "for", "domestic_partner_living_no_" + index_val );
                }
                $(this).prop("checked", false);
            });
            $(community_property_state).each(function () {
                $(this).attr("name", "community_property_state[" + index_val + "]");
            });
            $(domestic_partner).each(function () {
                $(this).attr("name", "domestic_partner[" + index_val + "]");
            });
            $(spouse_live_section_div).each(function () {
                $(this).removeClass("spouse-live-section-" + prev_index);
                $(this).addClass("spouse-live-section-" + index_val).addClass('hide-data');
            });

            cln.find("input[type=radio]").prop("checked", false);
            cln.find("input[type=text]").val("");
            cln.find("select").val("");
            $(itm).after(cln);
        }
    }, 500);
}

async function addListPropertyYouHoldForm() {
    var clnln = $(document).find(".list_property_you_hold_data").length;
    const status = await seperate_save('list_property_you_hold','list_property_you_hold_data', 'list-property-you-hold-data', 'parent_list_property_you_hold', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_property_you_hold_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "list_property_you_hold_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_property_you_hold','list_property_you_hold_data', 'list-property-you-hold-data', 'parent_list_property_you_hold', " + index_val + ")");
            
            var name = cln.find(".name");
            var street_number = cln.find(".street_number");
            var city = cln.find(".city");
            var state = cln.find(".state");
            var zip = cln.find(".zip");

            var location_street_number = cln.find(".location_street_number");
            var location_city = cln.find(".location_city");
            var location_state = cln.find(".location_state");
            var location_zip = cln.find(".location_zip");

            var property_desc = cln.find(".property_desc");
            var property_value = cln.find(".property_value");

            $(name).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[name][" + index_val + "]"
                );
            });
            $(street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[street_number][" + index_val + "]"
                );
            });
            $(city).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[city][" + index_val + "]"
                );
            });

            $(zip).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[zip][" + index_val + "]"
                );
            });
            $(state).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[state][" + index_val + "]"
                );
            });

            $(location_street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[location_street_number][" +
                        index_val +
                        "]"
                );
            });
            $(location_city).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[location_city][" + index_val + "]"
                );
            });

            $(location_state).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[location_state][" + index_val + "]"
                );
            });

            $(location_zip).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[location_zip][" + index_val + "]"
                );
            });

            $(property_desc).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[property_desc][" + index_val + "]"
                );
            });

            $(property_value).each(function () {
                $(this).attr(
                    "name",
                    "list_property_you_hold_data[property_value][" + index_val + "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
        }
    }, 500);
}

function addPrimarilyConsumerDebetsForm(
    credamountown = "",
    credcity = "",
    credname = "",
    credname_addresss = "",
    credstate = "",
    credzip = "",
    typeFor = ""
) {
    // var itm2 = document.getElementById("primarily-consumer-debets-1");
    // var cln2 = itm2.cloneNode(true);
    // document.getElementById("primarily-consumer-debets-2").appendChild(cln2);
    if (
        $(
            'input[name="primarily_consumer_debets_data[creditor_address][0]"]'
        ).val() == ""
    ) {
        var creditor_address = $(
            'input[name="primarily_consumer_debets_data[creditor_address][0]"]'
        );
        creditor_address.val(credname);
        var creditor_street = $(
            'input[name="primarily_consumer_debets_data[creditor_street][0]"]'
        );
        creditor_street.val(credname_addresss);

        var creditor_city = $(
            'input[name="primarily_consumer_debets_data[creditor_city][0]"]'
        );
        creditor_city.val(credcity);

        var creditor_state = $(
            'select[name="primarily_consumer_debets_data[creditor_state][0]"]'
        );
        creditor_state.val(credstate);
        creditor_state.prop("selected", true);

        var creditor_zip = $(
            'input[name="primarily_consumer_debets_data[creditor_zip][0]"]'
        );
        creditor_zip.val(credzip);

        var amount_still_owed = $(
            'input[name="primarily_consumer_debets_data[amount_still_owed][0]"]'
        );
        amount_still_owed.val(credamountown);

        var radioname = $(
            'input[name="primarily_consumer_debets_data[creditor_payment_for][0]"]'
        );

        if (typeFor == "Mortgage") {
            $(
                'input[name="primarily_consumer_debets_data[creditor_payment_for][0]"][value="1"]'
            ).prop("checked", true);
        }
        if (typeFor == "Auto") {
            $(
                'input[name="primarily_consumer_debets_data[creditor_payment_for][0]"][value="2"]'
            ).prop("checked", true);
        }
    } else {
        var clnln = $(document).find(".primarily_consumer_debets").length;
        if (clnln > 19) {
            alert("You can add only 20 entries.");
            return false;
        } else {
            var itm = $(document).find(".primarily_consumer_debets").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            var creditor_address = cln.find(".creditor_address");
            var creditor_street = cln.find(".creditor_street");
            var creditor_city = cln.find(".creditor_city");
            var creditor_state = cln.find(".creditor_state");
            var creditor_zip = cln.find(".creditor_zip");
            var payment_dates = cln.find(".payment_dates");
            var payment_dates2 = cln.find(".payment_dates2");
            var payment_dates3 = cln.find(".payment_dates3");
            var payment_1 = cln.find(".payment_1");
            var payment_2 = cln.find(".payment_2");
            var payment_3 = cln.find(".payment_3");
            var total_amount_paid = cln.find(".total_amount_paid");
            var amount_still_owed = cln.find(".amount_still_owed");
            var creditor_payment_for = cln.find(".creditor_payment_for");
            var sr_no = cln.find(".sr_no");

            //work only update case
            // cln.find('.property_vehicle_ids').remove();
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");

            cln.find("select").val("");
            cln.find('input[type="radio"]').prop("checked", false);
            $(creditor_address).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[creditor_address][" +
                        index_val +
                        "]"
                );
                $(this).val(credname);
            });
            $(creditor_street).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[creditor_street][" +
                        index_val +
                        "]"
                );
                $(this).val(credname_addresss);
            });
            $(sr_no).each(function () {
                $(this).html(index_val + 1);
            });
            $(creditor_city).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[creditor_city][" +
                        index_val +
                        "]"
                );
                $(this).val(credcity);
            });
            $(creditor_state).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[creditor_state][" +
                        index_val +
                        "]"
                );
                $(this).val(credstate);
                $(this).prop("selected", true);
            });
            $(creditor_zip).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[creditor_zip][" +
                        index_val +
                        "]"
                );
                $(this).val(credzip);
            });
            $(payment_dates).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[payment_dates][" +
                        index_val +
                        "]"
                );
            });
            $(payment_dates2).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[payment_dates2][" +
                        index_val +
                        "]"
                );
            });
            $(payment_dates3).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[payment_dates3][" +
                        index_val +
                        "]"
                );
            });

            $(payment_1).each(function () {
                $(this).data("index", index_val);
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[payment_1][" +
                        index_val +
                        "]"
                );
            });
            $(payment_2).each(function () {
                $(this).data("index", index_val);
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[payment_2][" +
                        index_val +
                        "]"
                );
            });
            $(payment_3).each(function () {
                $(this).data("index", index_val);
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[payment_3][" +
                        index_val +
                        "]"
                );
            });

            $(total_amount_paid).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[total_amount_paid][" +
                        index_val +
                        "]"
                );
            });
            $(amount_still_owed).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[amount_still_owed][" +
                        index_val +
                        "]"
                );
                $(this).val(credamountown);
            });
            $(creditor_payment_for).each(function () {
                $(this).attr(
                    "name",
                    "primarily_consumer_debets_data[creditor_payment_for][" +
                        index_val +
                        "]"
                );
                if (typeFor == "Mortgage" && $(this).val() == "1") {
                    $(this).prop("checked", true);
                }
                if (typeFor == "Auto" && $(this).val() == "2") {
                    $(this).prop("checked", true);
                }
            });

            $(itm).after(cln);
        }
    }
}

async function addPropertyRepossessedDataForm() {

    var clnln = $(document).find(".property_repossessed_data_form").length;
    const status = await seperate_save('property_repossessed','property_repossessed_data_form', 'property-repossessed-data', 'parent_property_repossessed', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {    
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".property_repossessed_data_form").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            let divclass = "property_repossessed_data_form";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find("label").removeClass("active");
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('property_repossessed','property_repossessed_data_form', 'property-repossessed-data', 'parent_property_repossessed', " + index_val + ")");

            var property_repossessed_address = cln.find(
                ".property_repossessed_address"
            );
            var property_repossessed_creditor_street = cln.find(
                ".property_repossessed_creditor_street"
            );
            var property_repossessed_creditor_city = cln.find(
                ".property_repossessed_creditor_city"
            );
            var property_repossessed_creditor_state = cln.find(
                ".property_repossessed_creditor_state"
            );
            var property_repossessed_creditor_zip = cln.find(
                ".property_repossessed_creditor_zip"
            );
            var property_repossessed_creditor_Property = cln.find(
                ".property_repossessed_creditor_Property"
            );
            var property_repossessed_date = cln.find(".property_repossessed_date");
            var property_repossessed_value = cln.find(
                ".property_repossessed_value"
            );
            var property_repossessed_what_happened = cln.find(
                ".property_repossessed_what_happened"
            );

            //work only update case
            // cln.find('.property_vehicle_ids').remove();
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(property_repossessed_address).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[creditor_address][" + index_val + "]"
                );
            });
            $(property_repossessed_creditor_street).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[creditor_street][" + index_val + "]"
                );
            });
            $(property_repossessed_creditor_city).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[creditor_city][" + index_val + "]"
                );
            });
            $(property_repossessed_creditor_state).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[creditor_state][" + index_val + "]"
                );
            });
            $(property_repossessed_creditor_zip).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[creditor_zip][" + index_val + "]"
                );
            });
            $(property_repossessed_creditor_Property).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[creditor_Property][" +
                        index_val +
                        "]"
                );
            });
            $(property_repossessed_date).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[property_repossessed_date][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });

            $(property_repossessed_value).each(function () {
                $(this).attr(
                    "name",
                    "property_repossessed_data[property_repossessed_value][" +
                        index_val +
                        "]"
                );
            });

            $(property_repossessed_what_happened).each(function () {
                $(this).attr("name", "property_repossessed_data[what_happened][" + index_val + "]");
                if ($(this).val() == "1") {
                    $(this).attr( "id", "property-repossessed-" + index_val );
                    $(this).next("label") .attr( "for", "property-repossessed-" + index_val );
                }
                if ($(this).val() == "2") {
                    $(this).attr( "id", "property-foreclosed-" + index_val );
                    $(this).next("label").attr( "for", "property-foreclosed-" + index_val );
                }
                if ($(this).val() == "3") {
                    $(this).attr( "id", "property-garnished-" + index_val );
                    $(this).next("label") .attr( "for", "property-garnished-" + index_val );
                }
                if ($(this).val() == "4") {
                    $(this).attr( "id", "property-attached-" + index_val );
                    $(this).next("label").attr( "for", "property-attached-" + index_val );
                }
                $(this).prop("checked", false);
            });

            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addlistAllFinancialAccountsForm() {
    var clnln = $(document).find(".list_all_financial_accounts").length;
    const status = await seperate_save('list_all_financial_accounts','list_all_financial_accounts', 'list_all_financial_accounts-data', 'parent_list_all_financial_accounts', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            $.systemMessage('You can only insert 5 entries.', 'alert--danger', true);
            return false;
        } else {
            var itm = $(document).find(".list_all_financial_accounts").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            // Update class and delete button for new index
            cln.removeClass(function (index, className) {
                return (className.match(/list_all_financial_accounts_\d+/g) || []).join(' ');
            }).addClass("list_all_financial_accounts_" + index_val);            
            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('list_all_financial_accounts', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);             
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_all_financial_accounts','list_all_financial_accounts', 'list_all_financial_accounts-data', 'parent_list_all_financial_accounts', " + index_val + ")");
            cln.find("label").removeClass("active");

            var classes = [
                "institution_name",
                "street_number",
                "city",
                "state",
                "zip",
                "account_number",
                "date_account_closed",
                "last_balance",
                "type_of_account",
            ];

            $(classes).each(function (index, value) {
                var field = cln.find("." + value);
                $(field).each(function (i, input) {
                    $(this).attr(
                        "name",
                        "list_all_financial_accounts_data[" +
                            value +
                            "][" +
                            index_val +
                            "]"
                    );

                    if (value == "date_account_closed") {
                        $(this).removeClass("hasDatepicker").attr("id", "");
                    }
                    if (value == "type_of_account") {
                        if ($(this).val() == "1") {
                            $(this).attr(
                                "id",
                                "type-of-account_checking_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account_checking_" + index_val
                                );
                        }
                        if ($(this).val() == "2") {
                            $(this).attr(
                                "id",
                                "type-of-account_savings_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account_savings_" + index_val
                                );
                        }
                        if ($(this).val() == "3") {
                            $(this).attr(
                                "id",
                                "type-of-account-money-market-" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account-money-market-" + index_val
                                );
                        }
                        if ($(this).val() == "4") {
                            $(this).attr(
                                "id",
                                "type-of-account-brokerage-" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account-brokerage-" + index_val
                                );
                        }
                        if ($(this).val() == "5") {
                            $(this).attr(
                                "id",
                                "type-of-account-other-" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr("for", "type-of-account-other-" + index_val);
                        }
                        $(this).attr("checked", false);
                    }
                });
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 200);
}

async function addListSafeDepositForm() {
    var clnln = $(document).find(".list_safe_deposit_data").length;
    const status = await seperate_save('list_safe_deposit','list_safe_deposit_data', 'list-safe-deposit-data', 'parent_list_safe_deposit', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_safe_deposit_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();
            
            let divclass = "list_safe_deposit_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find("label").removeClass("active");
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_safe_deposit','list_safe_deposit_data', 'list-safe-deposit-data', 'parent_list_safe_deposit', " + index_val + ")");

            var classes = [
                "name",
                "street_number",
                "city",
                "state",
                "zip",
                "have_access_of_box",
                "bo_name",
                "bo_street_number",
                "bo_city",
                "bo_state",
                "bo_zip",
                "contents",
                "still_have_safe_deposite",
            ];

            $(classes).each(function (index, name) {
                var sclass = name;
                var field = cln.find("." + sclass);
                $(field).each(function () {
                    $(this).attr(
                        "name",
                        "list_safe_deposit_data[" + name + "][" + index_val + "]"
                    );
                    if (name == "have_access_of_box") {
                        if ($(this).val() == "1") {
                            $(this).attr(
                                "id",
                                "have_access_of_deposit_box_yes_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "have_access_of_deposit_box_yes_" + index_val
                                );
                        }
                        if ($(this).val() == "0") {
                            $(this).attr(
                                "id",
                                "have_access_of_deposit_box_no_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "have_access_of_deposit_box_no_" + index_val
                                );
                        }
                        $(this).attr("checked", false);
                    }
                    if (name == "still_have_safe_deposite") {
                        if ($(this).val() == "1") {
                            $(this).attr(
                                "id",
                                "still_have_safe_deposite_yes_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "still_have_safe_deposite_yes_" + index_val
                                );
                        }
                        if ($(this).val() == "0") {
                            $(this).attr(
                                "id",
                                "still_have_safe_deposite_no_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "still_have_safe_deposite_no_" + index_val
                                );
                        }
                        $(this).attr("checked", false);
                    }
                });
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
        }
    }, 500);
}

async function addOtherStorageUnitForm() {
    var clnln = $(document).find(".other_storage_unit_data").length;
    const status = await seperate_save('other_storage_unit','other_storage_unit_data', 'list-storage-unit-data', 'parent_other_storage_unit', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".other_storage_unit_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            let divclass = "other_storage_unit_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find("label").removeClass("active");
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('other_storage_unit','other_storage_unit_data', 'list-storage-unit-data', 'parent_other_storage_unit', " + index_val + ")");
            var classes = [
                "name",
                "street_number",
                "city",
                "state",
                "zip",
                "have_access_of_box",
                "bd_name",
                "bd_street_number",
                "bd_city",
                "bd_state",
                "bd_zip",
                "contents",
                "still_have_storage_unit",
            ];

            $(classes).each(function (index, name) {
                var sclass = name;
                var field = cln.find("." + sclass);
                $(field).each(function () {
                    $(this).attr(
                        "name",
                        "other_storage_unit_data[" + name + "][" + index_val + "]"
                    );
                    if (name == "have_access_of_box") {
                        if ($(this).val() == "1") {
                            $(this).attr(
                                "id",
                                "have_access_of_box_yes_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr("for", "have_access_of_box_yes_" + index_val);
                        }
                        if ($(this).val() == "0") {
                            $(this).attr(
                                "id",
                                "have_access_of_box_no_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr("for", "have_access_of_box_no_" + index_val);
                        }
                        $(this).attr("checked", false);
                    }
                    if (name == "still_have_storage_unit") {
                        if ($(this).val() == "1") {
                            $(this).attr(
                                "id",
                                "still_have_storage-unit_yes_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "still_have_storage-unit_yes_" + index_val
                                );
                        }
                        if ($(this).val() == "0") {
                            $(this).attr(
                                "id",
                                "still_have_storage-unit_no_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "still_have_storage-unit_no_" + index_val
                                );
                        }
                        $(this).attr("checked", false);
                    }
                });
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
        }
    }, 500);
}

function getListEveryAddressData(value) {
    if (value == "no") {
        document
            .getElementById("list-every-address-data")
            .classList.remove("hide-data");
    } else if (value == "yes") {
        document
            .getElementById("list-every-address-data")
            .classList.add("hide-data");
    }
}

function getLivingDomesticPartnerData(value) {
    if (value == "yes") {
        document
            .getElementById("living-domestic-partner-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("living-domestic-partner-data")
            .classList.add("hide-data");
    }
}

function getTotalAmountIncomeData(value) {
    if (value == "yes") {
        document
            .getElementById("total-amount-income-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("total-amount-income-data")
            .classList.add("hide-data");
    }
}

function getTotalAmountIncomeSpouseData(value) {
    if (value == "yes") {
        document
            .getElementById("total-amount-income-spouse-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("total-amount-income-spouse-data")
            .classList.add("hide-data");
    }
}

function getOtherIncomeRecivedData(value) {
    if (value == "yes") {
        document
            .getElementById("other-income-received-income-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other-income-received-income-data")
            .classList.add("hide-data");
    }
}

function getOtherIncomeSpouseData(value) {
    if (value == "yes") {
        document
            .getElementById("other-income-received-spouse-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other-income-received-spouse-data")
            .classList.add("hide-data");
    }
}

function getPrimarilyConsumerDebetsData(value) {
    if (value == "yes") {
        document
            .getElementById("primarily-consumer-debets-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("primarily-consumer-debets-data")
            .classList.add("hide-data");
    }
}

function getPrimarilyNonConsumerDebetsData(value) {
    if (value == "yes") {
        document
            .getElementById("primarily-non-consumer-debets-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("primarily-non-consumer-debets-data")
            .classList.add("hide-data");
    }
}

function getPaymentPastYearData(value) {
    if (value == "yes") {
        document
            .getElementById("payment-past-one-year-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("payment-past-one-year-data")
            .classList.add("hide-data");
    }
}

function getTransferPropertyData(value) {
    if (value == "yes") {
        document
            .getElementById("transfers-property-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("transfers-property-data")
            .classList.add("hide-data");
    }
}

function getListLawsuitsData(value) {
    if (value == "yes") {
        document
            .getElementById("list-lawsuits-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-lawsuits-data")
            .classList.add("hide-data");
    }
}

function getPropertyRepossessedData(value) {
    if (value == "yes") {
        document
            .getElementById("property-repossessed-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("property-repossessed-data")
            .classList.add("hide-data");
    }
}

function getSetoffsCreditorData(value) {
    if (value == "yes") {
        document
            .getElementById("setoffs_creditor-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("setoffs_creditor-data")
            .classList.add("hide-data");
    }
}

function getListGiftsData(value) {
    if (value == "yes") {
        document
            .getElementById("list-any-gifts-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-any-gifts-data")
            .classList.add("hide-data");
    }
}

function getGiftsCharityData(value) {
    if (value == "yes") {
        document
            .getElementById("gifts-charity-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("gifts-charity-data")
            .classList.add("hide-data");
    }
}

function getLossesFireData(value) {
    if (value == "yes") {
        document
            .getElementById("losses_from_fire-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("losses_from_fire-data")
            .classList.add("hide-data");
    }
}

function getPropertyTransferredData(value) {
    if (value == "yes") {
        document
            .getElementById("property-transferred-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("property-transferred-data")
            .classList.add("hide-data");
    }
}

function getPropertyTransferredCreditorsData(value) {
    if (value == "yes") {
        document
            .getElementById("property-transferred-creditors-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("property-transferred-creditors-data")
            .classList.add("hide-data");
    }
}

function getPropertyallData(value) {
    if (value == "yes") {
        document
            .getElementById("Property_all-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("Property_all-data").classList.add("hide-data");
    }
}

function getAllTransferPropertyData(value) {
    if (value == "yes") {
        document
            .getElementById("list-all-property_transfer-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-all-property_transfer-data")
            .classList.add("hide-data");
    }
}

function getListFinancialAccountsData(value) {
    if (value == "yes") {
        document
            .getElementById("list_all_financial_accounts-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list_all_financial_accounts-data")
            .classList.add("hide-data");
    }
}

function getSafeDepositData(value) {
    if (value == "yes") {
        document
            .getElementById("list-safe-deposit-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-safe-deposit-data")
            .classList.add("hide-data");
    }
}

function getStorageUnitData(value) {
    if (value == "yes") {
        document
            .getElementById("list-storage-unit-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-storage-unit-data")
            .classList.add("hide-data");
    }
}

function getPropertyHoldData(value) {
    if (value == "yes") {
        document
            .getElementById("list-property-you-hold-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-property-you-hold-data")
            .classList.add("hide-data");
    }
}

function getNoticeByGovData(value) {
    if (value == "yes") {
        document
            .getElementById("list-noticeby-gov-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-noticeby-gov-data")
            .classList.add("hide-data");
    }
}

function getEnvironmentLawData(value) {
    if (value == "yes") {
        document
            .getElementById("list-environment_law-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-environment_law-data")
            .classList.add("hide-data");
    }
}

function getJudicialProceedingsData(value) {
    if (value == "yes") {
        document
            .getElementById("list-judicial-proceedings-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-judicial-proceedings-data")
            .classList.add("hide-data");
    }
}

function getNatureOfBussinessData(value) {
    if (value == "yes") {
        document
            .getElementById("list-nature-business-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-nature-business-data")
            .classList.add("hide-data");
    }
}

function getFinancialInstitutionsData(value) {
    if (value == "yes") {
        document
            .getElementById("list-financial-institutions-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list-financial-institutions-data")
            .classList.add("hide-data");
    }
}

function common_toggle_fn(value, id) {
    if (value == "yes") {
        if (id == "pending_pior_cases_div") {
            $("#pending_pior_cases_div").removeClass("hide-data");
        }
        if (id == "any_bankruptcy_cases_pending_data") {
            $("#any_bankruptcy_cases_pending-court").removeClass("hide-data");
        }
        if (id == "any_bankruptcy_filed_before_data") {
            $("#bankruptcy_filed_before-court").removeClass("hide-data");
        }
        if (id == "filed_bankruptcy_case_data") {
            $("#filed_bankruptcy_case_data-court").removeClass("hide-data");
        }
        if (id == "domestic-support") {
            $("#second_step_domestic_debts_div").removeClass("hide-data");
        }
        if (id == "tax-owned-irs") {
            $("#tax-owned-irs").removeClass("hide-data");
        }
        document.getElementById(id).classList.remove("hide-data");
    } else if (value == "no") {
        if (id == "pending_pior_cases_div") {
            $("#pending_pior_cases_div").addClass("hide-data");
        }
        if (id == "any_bankruptcy_cases_pending_data") {
            $("#any_bankruptcy_cases_pending-court").addClass("hide-data");
        }
        if (id == "any_bankruptcy_filed_before_data") {
            $("#bankruptcy_filed_before-court").addClass("hide-data");
        }
        if (id == "filed_bankruptcy_case_data") {
            $("#filed_bankruptcy_case_data-court").addClass("hide-data");
        }
        if (id == "domestic-support") {
            $("#second_step_domestic_debts_div").addClass("hide-data");
        }
        if (id == "tax-owned-irs") {
            $("#irs-texes-views").addClass("hide-data");
        }
        document.getElementById(id).classList.add("hide-data");
    }
}

function originalCreditorCheck(value, index) {
    if (value == 0) {
        // $('.debt_date_section_'+index).addClass('d-none');
        $(".debt_second_address_" + index).removeClass("d-none");
        // $('input[name="debt_tax[debt_date]['+index+']"]').val("");
    }
    if (value == 1) {
        // $('.debt_date_section_'+index).removeClass('d-none');
        $(".debt_second_address_" + index).addClass("d-none");
    }    
    setLawsuitTitle('', index);
}

function common_toggle_own_by(value, obj) {
    var parentDiv = $(obj).closest(".debt_tax_own_by");
    var targetDiv = parentDiv.siblings(".debt_tax_codebtor_cosigner_data");
    if (value == 2 || value == 4) {
        targetDiv.removeClass("hide-data").show();
    } else if (value == 1 || value == 3) {
        targetDiv.addClass("hide-data").hide();
    }

    parentDiv.find("label").removeClass("active");
    $(obj).addClass("active");
}


function property_common_toggle_own_by(value, obj) {
    var parentDiv = $(obj).closest(".property_own_by");
    var targetDiv = parentDiv.siblings(".property_codebtor_cosigner_data");

    if (value == 2 || value == 4) {
        targetDiv.removeClass("hide-data").show();
    } else if (value == 1 || value == 3) {
        targetDiv.addClass("hide-data").hide();
    }

    parentDiv.find("label").removeClass("active");
    $(obj).addClass("active");
}


// function common_toggle_own_by(value, obj) {

//     var parentDiv = $(obj).closest(".debt_tax_own_by");
//     var targetDiv = parentDiv.siblings("#debt_tax_codebtor_cosigner_data");
//     var radioId = $(obj).attr("for");
    
//     var correspondingRadio = parentDiv.find("#" + radioId);
//     if (correspondingRadio.length) {
//         parentDiv.find("input[type='radio']").attr("checked", false);
//         correspondingRadio.attr( "checked", true );
//     }

//     if (value == 2 || value == 4) {
//         targetDiv.removeClass("hide-data").show();
//     } else {
//         targetDiv.addClass("hide-data").hide();
//     }

// }

function property_toggle_own_by(value, obj) {
    if (value == 2 || value == 4) {
        $(obj)
            .parents(".property_own_by")
            .next(".property_codebtor_cosigner_data")
            .removeClass("hide-data");

        // document.getElementById('own_property_data').classList.remove("hide-data");
    } else if (value == 1 || value == 3) {
        $(obj)
            .parents(".property_own_by")
            .next(".property_codebtor_cosigner_data")
            .addClass("hide-data");
        // document.getElementById('own_property_data').classList.add("hide-data");
    }
}

function vehicle_toggle_own_by(value, obj) {
    if (value == 2 || value == 4) {
        $(obj)
            .parents(".vehile_own_by")
            .next(".vehicle_codebtor_cosigner_data")
            .removeClass("hide-data");

        // document.getElementById('own_property_data').classList.remove("hide-data");
    } else if (value == 1 || value == 3) {
        $(obj)
            .parents(".vehile_own_by")
            .next(".vehicle_codebtor_cosigner_data")
            .addClass("hide-data");
        // document.getElementById('own_property_data').classList.add("hide-data");
    }
}

function getExpIncBox(value) {
    if (value == "yes") {
        document
            .getElementById("div_desc_incexp")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("div_desc_incexp").classList.add("hide-data");
    }
}

async function bank_addmore(transaction_pdf_enabled) {
    var clnln = $(document).find(".bank_accounts").length;
    const status = await seperate_save('bank','bank_accounts', 'checking_account_items_data', 'parent_bank', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 17) {
            alert("You can add only 18 entries.");
            return false;
        } else {
            var itm = $(document).find(".bank_accounts").last();
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }
            itm.attr("rowNo", $rowNo);
            var index_val = clnln;
            var cln = $(itm).clone();
            cln.find(".bank_description").val("");
            cln.find(".bank_property_value").val("");

            // Update class and delete button for new index
            cln.removeClass(function (index, className) {
                return (className.match(/bank_accounts_\d+/g) || []).join(' ');
            }).addClass("bank_accounts_" + index_val);

            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('bank_accounts', " + index_val + ")");

            // Update input fields with the correct name attributes
            cln.find(".circle-number-div").html(index_val + 1);
             
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('bank','bank_accounts', 'checking_account_items_data', 'parent_bank', " + index_val + ")");


            cln.find("label").removeClass("active");
            let transaction_enabled = $("#bank-addmore-button").attr('data-transaction-enabled');
            var bank_description = cln.find(".bank_description");
            var bank_property_account = cln.find(".bank_property_account");
            var bank_business_name = cln.find(".bank_business_name");
            var bank_business_name_div = cln.find(".bank_business_name_div");
            var bank_personal_business_account = cln.find(".bank_personal_business_account");
            var last_4_digits = cln.find(".last_4_digits");
            var bank_property_value = cln.find(".bank_property_value");

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            $(bank_description).each(function () {
                $(this).attr("name", "bank[data][description][" + index_val + "]");
            });
            $(last_4_digits).each(function () {
                $(this).attr(
                    "name",
                    "bank[data][last_4_digits][" + index_val + "]"
                );
            });

            $(bank_property_account).each(function () {
                $(this).attr("name", "bank[data][account_type][" + index_val + "]");
            });
            $(bank_personal_business_account).each(function () {
                $(this).attr("name", "bank[data][personal_business_account][" + index_val + "]");
                
                if ($(this).is("[onchange]")) {
                    $(this).attr("onchange", "showHideBusinessNameDiv(this, " + index_val + ")");
                }

            });
            var prev_index = index_val - 1;
            $(bank_business_name_div).each(function () {
                if ($(this).hasClass("bank_business_name_div_" + prev_index)) {
                    $(this)
                        .removeClass("bank_business_name_div_" + prev_index)
                        .addClass("bank_business_name_div_" + index_val);
                }
                if ($(this).hasClass("hide-data")) {
                    $(this).removeClass("hide-data");
                }
            });
            $(bank_business_name).each(function () {
                $(this).attr("name", "bank[data][business_name][" + index_val + "]");
            });
            $(bank_property_value).each(function () {
                $(this).attr(
                    "name",
                    "bank[data][property_value][" + index_val + "]"
                );
            });

            var transaction_radio               = cln.find(".transaction-radio");
            var transaction_div                 = cln.find(".transaction-div");
            var transaction_description         = cln.find(".transaction-description");
            var transaction_sample              = cln.find(".transaction-sample");
            var transaction_value               = cln.find(".transaction-value");
            var transaction_btn_div             = cln.find(".add-more-transaction-btn");
            var transaction_add                 = cln.find(".transaction-add");
            var transaction_radio_yes           = cln.find(".transaction-radio-yes");
            var transaction_radio_no            = cln.find(".transaction-radio-no");
            
            

            $(transaction_radio).each(function () {            
                $(this).prop("checked", false);
                $(this).attr( "name", "bank[data][transaction][" + index_val + "]" );

                if ($(this).val() == "1") {
                    $(this).attr("id", "transaction_" + index_val + "_yes");
                        $(transaction_radio_yes).next('label').attr( "for", "transaction_" + index_val + "_yes" );
                    if(transaction_enabled == 1){
                        $(transaction_radio_yes).next('label').attr( "onclick", "showHideTransactionSection(1, " + index_val + "); setTimeout(() => checkBankAccInputs(), 10)" );
                    }else{
                        $(transaction_radio_yes).next('label').attr( "onclick", "showHideTransactionSection(1, " + index_val + "); " );
                    }
                }
                if ($(this).val() == "0") {
                    $(this).attr("id", "transaction_" + index_val + "_no");
                    $(transaction_radio_no).next('label').attr( "for", "transaction_" + index_val + "_no" );
                    if(transaction_enabled == 1){
                        $(transaction_radio_no).next('label').attr( "onclick", "showHideTransactionSection(0, " + index_val + "); setTimeout(() => checkBankAccInputs(), 10)" );
                    }else{
                        $(transaction_radio_no).next('label').attr( "onclick", "showHideTransactionSection(0, " + index_val + "); " );
                    }
                }
            });

            transaction_div.each(function(index) {
                if (index > 0) {
                    $(this).remove();
                }
                
                $(this)
                    .removeClass(`transaction-div-${prev_index}`).removeClass(`bank_account_transaction_${prev_index}`).removeClass(`bank_account_transaction_${prev_index}_0`)
                    .addClass(`hide-data transaction-div-${index_val}`).addClass(`bank_account_transaction_${index_val}`).addClass(`bank_account_transaction_${index_val}_0`);
                $(this).find('.delete-div').attr( "name", `remove_div_common('bank_account_transaction_${index_val}',0,'',false)`);
                $(this).find('.circle-number-div').html(1);

            });

            $(transaction_description).attr( "name", `bank[data][transaction_data][${index_val}][0][description]`);
            $(transaction_sample).attr( "name", `bank[data][transaction_data][${index_val}][0][sample]`);
            $(transaction_value).attr( "name", `bank[data][transaction_data][${index_val}][0][value]`);
            $(transaction_btn_div).removeClass(`add-more-transaction-btn-${prev_index}`).addClass(`hide-data add-more-transaction-btn-${index_val}`);
            $(transaction_add).attr("onclick", "addMoreBankTransaction(" + index_val + ", "+transaction_pdf_enabled+")");
            
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            $(".remove-bank-mutisec").show();
            if(transaction_pdf_enabled == 1){
                checkBankAccInputs();
            }
        }
    }, 200);
}

async function venmo_paypal_cash_addmore() {
    var divLength = $(document).find(".venmo-paypal-cash-mainsec").length;
    const status = await seperate_save('venmo_paypal_cash','venmo-paypal-cash-mainsec', 'account_items_data', 'parent_venmo_paypal_cash', divLength, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (divLength > 8) {
            $.systemMessage('You can add only 9 accounts.', "alert--danger", true);
            return false;
        } else {
            var alreadySelected = [];
            $(".account_type").each(function () {
                alreadySelected.push($(this).val());
            });

            var lastDiv = $(document).find(".venmo-paypal-cash-mainsec").last();

            var index_val = divLength;
            var cloneDiv = $(lastDiv).clone();
            var prev_index = index_val - 1;

            var account_type = cloneDiv.find(".account_type");
            var description = cloneDiv.find(".description");
            var last_4_digits = cloneDiv.find(".last_4_digits");
            var property_value = cloneDiv.find(".property_value");
            var guideVideoDiv = cloneDiv.find(".guide-video-div");
            
            var newSelectedVal = "";

            let parentDivClass = 'venmo-paypal-cash-mainsec';
            cloneDiv.removeClass(function (index, className) {
                return (className.match(parentDivClass + "_\\d+", "g") || []).join(' ');
            }).addClass(parentDivClass + "_" + index_val);
            cloneDiv.find(".delete-div").attr("onclick", "seperate_remove_div_common('"+parentDivClass+"', " + index_val + ")");
            cloneDiv.find(".circle-number-div").html(index_val + 1);
            
            cloneDiv.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cloneDiv.find(`.edit_section`).removeClass('hide-data');
            cloneDiv.find(`.save-btn`).attr("onclick", "seperate_save('venmo_paypal_cash','venmo-paypal-cash-mainsec', 'account_items_data', 'parent_venmo_paypal_cash', " + index_val + ")");

            $(account_type).each(function () {
                $(this).attr("name", `venmo_paypal_cash[data][account_type][${index_val}]`);
                $(this).attr("data-index", index_val);
                $(this).find("option").each(function () {
                    var optionValue = $(this).val();
                    if ($.inArray(optionValue, alreadySelected) === -1 && newSelectedVal === "") {
                        $(this).prop("selected", true);
                        newSelectedVal = optionValue;
                    }
                });
            });

            $(description).each(function () {
                $(this).attr(
                    "name",
                    "venmo_paypal_cash[data][description][" + index_val + "]"
                );
                $(this)
                    .find("option")
                    .each(function () {
                        if ($(this).text() === "Select Debtor Type") {
                            $(this).prop("selected", true);
                        }
                    });
            });

            $(last_4_digits).each(function () {
                $(this).attr(
                    "name",
                    "venmo_paypal_cash[data][last_4_digits][" + index_val + "]"
                );
            });

            $(property_value).each(function () {
                $(this).attr(
                    "name",
                    "venmo_paypal_cash[data][property_value][" + index_val + "]"
                );
                $(this).val("");
            });
            $(guideVideoDiv).each(function () {
                if ($(this).hasClass("paypalVideo-" + prev_index)) {
                    $(this)
                        .removeClass("paypalVideo-" + prev_index)
                        .addClass("paypalVideo-" + index_val)
                        .addClass("hide-data");
                }
                if ($(this).hasClass("cashVideo-" + prev_index)) {
                    $(this)
                        .removeClass("cashVideo-" + prev_index)
                        .addClass("cashVideo-" + index_val)
                        .addClass("hide-data");
                }
                if ($(this).hasClass("venmoVideo-" + prev_index)) {
                    $(this)
                        .removeClass("venmoVideo-" + prev_index)
                        .addClass("venmoVideo-" + index_val)
                        .addClass("hide-data");
                }
            });
            cloneDiv.find('input[type="text"]').val("");
            cloneDiv.find('input[type="number"]').val("");
            cloneDiv.find("textarea").val("");
            $(lastDiv).after(cloneDiv);
            showHideGuideVidDiv(index_val, newSelectedVal);
            $(".remove_venmo_paypal_cash_sec").show();
        }
    }, 200);
}

function showHideGuideVidDiv(index, selectedValue) {
    var paypal = ["paypal_account_1", "paypal_account_2", "paypal_account_3"];
    var cash = ["cash_account_1", "cash_account_2", "cash_account_3"];
    var venmo = ["venmo_account_1", "venmo_account_2", "venmo_account_3"];
    if (paypal.includes(selectedValue)) {
        $(".paypalVideo-" + index).removeClass("hide-data");
        $(".cashVideo-" + index).addClass("hide-data");
        $(".venmoVideo-" + index).addClass("hide-data");
    }
    if (cash.includes(selectedValue)) {
        $(".cashVideo-" + index).removeClass("hide-data");
        $(".paypalVideo-" + index).addClass("hide-data");
        $(".venmoVideo-" + index).addClass("hide-data");
    }
    if (venmo.includes(selectedValue)) {
        $(".venmoVideo-" + index).removeClass("hide-data");
        $(".paypalVideo-" + index).addClass("hide-data");
        $(".cashVideo-" + index).addClass("hide-data");
    }
}

async function brokerage_account_addmore() {
    var clnln = $(document).find(".brokerage_account_mutisec").length;
    const status = await seperate_save('brokerage_account','brokerage_account_mutisec', 'brokerage_items_data', 'parent_brokerage_account', clnln, true);
    
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 9) {
            $.systemMessage('You can add only 10 entries.', "alert--danger", true);
            return false;
        } else {
            var itm = $(document).find(".brokerage_account_mutisec").last();
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }
            itm.attr("rowNo", $rowNo);
            var index_val = clnln;
            var cln = $(itm).clone();

            // Update class and delete button for new index
            cln.removeClass(function (index, className) {
                return (className.match(/brokerage_account_mutisec_\d+/g) || []).join(' ');
            }).addClass("brokerage_account_mutisec_" + index_val);
            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('brokerage_account_mutisec', " + index_val + ")");
            // Update input fields with the correct name attributes
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('brokerage_account','brokerage_account_mutisec', 'brokerage_items_data', 'parent_brokerage_account', " + index_val + ")");
    
            cln.find(".brokerage_account_description").val("");
            cln.find(".brokerage_account_property_value").val("");
            var brokerage_account_description = cln.find(
                ".brokerage_account_description"
            );
            var brokerage_account_property_account = cln.find(
                ".brokerage_account_property_account"
            );
            var last_4_digits = cln.find(".last_4_digits");
            var brokerage_account_property_value = cln.find(
                ".brokerage_account_property_value"
            );
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            $(brokerage_account_description).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][description][" + index_val + "]"
                );
            });
            $(last_4_digits).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][last_4_digits][" + index_val + "]"
                );
            });

            $(brokerage_account_property_account).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][account_type][" + index_val + "]"
                );
            });
            $(brokerage_account_property_value).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][property_value][" + index_val + "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            $(".remove_brokerage_account_sec").show();
        }    
    }, 200);
}

async function child_addmore() {
    var clnln = $(document).find(".alimony_child_support_mutisec").length;
    const status = await seperate_save('alimony_child_support','alimony_child_support_mutisec', 'alimony_child_data', 'parent_alimony_child_support', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 6) {
            $.systemMessage('You can add only 7 entries.', "alert--danger", true);
            return false;
        } else {
            var itm = $(document).find(".alimony_child_support_mutisec").last();
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }
            var alreadySelected = [];
            $(".alimony_property_account").each(function () {
                alreadySelected.push($(this).val());
            });
            
            itm.attr("rowNo", $rowNo);
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            let parentDivClass = 'alimony_child_support_mutisec';
            cln.removeClass(function (index, className) {
                return (className.match(parentDivClass + "_\\d+", "g") || []).join(' ');
            }).addClass(parentDivClass + "_" + index_val);
            
            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('alimony_child_support_mutisec', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('alimony_child_support','alimony_child_support_mutisec', 'alimony_child_data', 'parent_alimony_child_support', " + index_val + ")");


            cln.find(".alimony_description").val("");
            cln.find(".alimony_property_value").val("");
            var alimony_description = cln.find(".alimony_description");
            var alimony_property_account = cln.find(".alimony_property_account");
            var alimony_property_state = cln.find(".alimony_property_state");
            var alimony_child_support_data_for = cln.find(".alimony_child_support_data_for");
            var alimony_property_value = cln.find(".alimony_property_value");
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");

            cln
            .find("input[type=checkbox]")
            .prop("checked", false)
            .end();

            var unknown = cln.find(".unknown");

            var newSelectedVal = "";

            $(alimony_property_account).each(function () {
                $(this).attr("name", `alimony_child_support[data][account_type][${index_val}]`);
                $(this).attr("data-index", index_val);
                $(this).find("option").each(function () {
                    var optionValue = $(this).val();
                    if ($.inArray(optionValue, alreadySelected) === -1 && newSelectedVal === "") {
                        $(this).prop("selected", true);
                        newSelectedVal = optionValue;
                    }
                });
            });
            $(alimony_child_support_data_for).each(function () {
                $(this).attr("name", `alimony_child_support[data][data_for][${index_val}]`);
            });
            $(unknown).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][property_value_unknown][" + index_val + "]"
                );
                $(this).attr(
                    "onchange",
                    "checkUnknown(this, " + index_val + ",'child')"
                );
                $(this).attr(
                    "checked",
                    false
                );
            });

            $(alimony_description).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][description][" + index_val + "]"
                );
            });
            $(alimony_property_state).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][state][" + index_val + "]"
                );
            });

            
            $(alimony_property_account).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][account_type][" + index_val + "]"
                );
            });
            $(alimony_property_value).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][property_value][" + index_val + "]"
                );
                var previndex = index_val - 1;
                $(this)
                .removeClass(
                    "is_child_unknown_" +
                        previndex
                )
                .addClass(
                    "is_child_unknown_" +
                        index_val
                );
                $(this).removeAttr("disabled");
            });
           
            $(itm).after(cln);
            $(".remove-child-mutisec").show();
        }
    }, 200);
}

async function addListNoticebyGovForm() {
    var clnln = $(document).find(".list_noticeby_gov_data").length;
    const status = await seperate_save('list_noticeby_gov','list_noticeby_gov_data', 'list-noticeby-gov-data', 'parent_list_noticeby_gov', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_noticeby_gov_data").last();
            var index_val = $(itm).index() + 1;

            var cln = $(itm).clone();

            let divclass = "list_noticeby_gov_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_noticeby_gov','list_noticeby_gov_data', 'list-noticeby-gov-data', 'parent_list_noticeby_gov', " + index_val + ")");

            var name = cln.find(".name");
            var street_number = cln.find(".street_number");
            var city = cln.find(".city");
            var state = cln.find(".state");
            var zip = cln.find(".zip");
            var gov_name = cln.find(".gov_name");
            var gov_street_number = cln.find(".gov_street_number");
            var gov_city = cln.find(".gov_city");
            var gov_state = cln.find(".gov_state");
            var gov_zip = cln.find(".gov_zip");
            var environmental_law = cln.find(".environmental_law");
            var notice_date = cln.find(".notice_date");

            $(name).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[name][" + index_val + "]"
                );
            });

            $(street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[street_number][" + index_val + "]"
                );
            });

            $(city).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[city][" + index_val + "]"
                );
            });

            $(state).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[state][" + index_val + "]"
                );
            });

            $(zip).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[zip][" + index_val + "]"
                );
            });

            $(gov_name).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[gov_name][" + index_val + "]"
                );
            });

            $(gov_street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[gov_street_number][" + index_val + "]"
                );
            });

            $(gov_city).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[gov_city][" + index_val + "]"
                );
            });

            $(gov_state).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[gov_state][" + index_val + "]"
                );
            });

            $(gov_zip).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[gov_zip][" + index_val + "]"
                );
            });

            $(environmental_law).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[environmental_law][" + index_val + "]"
                );
            });

            $(notice_date).each(function () {
                $(this).attr(
                    "name",
                    "list_noticeby_gov_data[notice_date][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");

            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addPropertyAllForm() {
    // Property_all_data
    var clnln = $(document).find(".Property_all_data").length;
    const status = await seperate_save('Property_all','Property_all_data', 'Property_all-data', 'parent_Property_all', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".Property_all_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            let divclass = "Property_all_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('Property_all','Property_all_data', 'Property_all-data', 'parent_Property_all', " + index_val + ")");
            var name = cln.find(".name");
            var street_number = cln.find(".street_number");
            var city = cln.find(".city");
            var state = cln.find(".state");
            var zip = cln.find(".zip");
            var property_transfer_value = cln.find(".property_transfer_value");
            var property_exchange = cln.find(".property_exchange");
            var relationship_to_you = cln.find(".relationship_to_you");
            var property_transfer_date = cln.find(".property_transfer_date");

            $(name).each(function () {
                $(this).attr("name", "Property_all_data[name][" + index_val + "]");
            });

            $(street_number).each(function () {
                $(this).attr(
                    "name",
                    "Property_all_data[street_number][" + index_val + "]"
                );
            });

            $(city).each(function () {
                $(this).attr("name", "Property_all_data[city][" + index_val + "]");
            });

            $(state).each(function () {
                $(this).attr("name", "Property_all_data[state][" + index_val + "]");
            });

            $(zip).each(function () {
                $(this).attr("name", "Property_all_data[zip][" + index_val + "]");
            });

            $(property_transfer_value).each(function () {
                $(this).attr(
                    "name",
                    "Property_all_data[property_transfer_value][" + index_val + "]"
                );
            });

            $(property_exchange).each(function () {
                $(this).attr(
                    "name",
                    "Property_all_data[property_exchange][" + index_val + "]"
                );
            });

            $(relationship_to_you).each(function () {
                $(this).attr(
                    "name",
                    "Property_all_data[relationship_to_you][" + index_val + "]"
                );
            });

            $(property_transfer_date).each(function () {
                $(this).attr(
                    "name",
                    "Property_all_data[property_transfer_date][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addListEnvironmentLawForm() {
    var clnln = $(document).find(".list_environment_law_data").length;
    const status = await seperate_save('list_environment_law','list_environment_law_data', 'list-environment_law-data', 'parent_list_environment_law', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_environment_law_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            let divclass = "list_environment_law_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_environment_law','list_environment_law_data', 'list-environment_law-data', 'parent_list_environment_law', " + index_val + ")");
            var name = cln.find(".name");
            var street_number = cln.find(".street_number");
            var city = cln.find(".city");
            var state = cln.find(".state");
            var zip = cln.find(".zip");
            var gov_name = cln.find(".gov_name");
            var gov_street_number = cln.find(".gov_street_number");
            var gov_city = cln.find(".gov_city");
            var gov_state = cln.find(".gov_state");
            var gov_zip = cln.find(".gov_zip");
            var notice_date = cln.find(".notice_date");
            var environment_law_know = cln.find(".environment_law_know");

            $(name).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[name][" + index_val + "]"
                );
            });

            $(street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[street_number][" + index_val + "]"
                );
            });

            $(city).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[city][" + index_val + "]"
                );
            });
            $(state).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[state][" + index_val + "]"
                );
            });
            $(zip).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[zip][" + index_val + "]"
                );
            });
            $(gov_name).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[gov_name][" + index_val + "]"
                );
            });
            $(gov_street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[gov_street_number][" +
                        index_val +
                        "]"
                );
            });
            $(gov_city).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[gov_city][" + index_val + "]"
                );
            });
            $(gov_state).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[gov_state][" + index_val + "]"
                );
            });
            $(gov_zip).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[gov_zip][" + index_val + "]"
                );
            });
            $(notice_date).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[notice_date][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(environment_law_know).each(function () {
                $(this).attr(
                    "name",
                    "list_environment_law_data[environment_law_know][" +
                        index_val +
                        "]"
                );
            });

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addPropertyTransferredCreditorsForm() {
    var clnln = $(document).find(".property_transferred_creditors_data").length;
    const status = await seperate_save('property_transferred_creditors','property_transferred_creditors_data', 'property-transferred-creditors-data', 'parent_property_transferred_creditors', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document)
                .find(".property_transferred_creditors_data")
                .last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            let divclass = "property_transferred_creditors_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('property_transferred_creditors','property_transferred_creditors_data', 'property-transferred-creditors-data', 'parent_property_transferred_creditors', " + index_val + ")");
            var person_paid_address = cln.find(".person_paid_address");
            var person_paid_street = cln.find(".person_paid_street");
            var person_paid_city = cln.find(".person_paid_city");
            var person_paid_state = cln.find(".person_paid_state");
            var person_paid_zip = cln.find(".person_paid_zip");
            var property_transfer_value = cln.find(".property_transfer_value");
            var property_transfer_date = cln.find(".property_transfer_date");
            var property_transfer_amount_payment = cln.find(
                ".property_transfer_amount_payment"
            );

            var property_transfer_date2 = cln.find(".property_transfer_date2");
            var property_transfer_amount_payment2 = cln.find(
                ".property_transfer_amount_payment2"
            );

            $(person_paid_address).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[person_paid_address][" +
                        index_val +
                        "]"
                );
            });
            $(person_paid_street).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[person_paid_street][" +
                        index_val +
                        "]"
                );
            });

            $(person_paid_city).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[person_paid_city][" +
                        index_val +
                        "]"
                );
            });

            $(person_paid_state).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[person_paid_state][" +
                        index_val +
                        "]"
                );
            });
            $(person_paid_zip).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[person_paid_zip][" +
                        index_val +
                        "]"
                );
            });
            $(property_transfer_value).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[property_transfer_value][" +
                        index_val +
                        "]"
                );
            });
            $(property_transfer_date).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[property_transfer_date][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(property_transfer_amount_payment).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[property_transfer_amount_payment][" +
                        index_val +
                        "]"
                );
            });

            $(property_transfer_date2).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[property_transfer_date2][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(property_transfer_amount_payment2).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_creditors_data[property_transfer_amount_payment2][" +
                        index_val +
                        "]"
                );
            });

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");

            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addJointsSocialSecurityForm() {
    //list_judicial_proceedings_data
    var clnln = $(document).find(".list_judicial_proceedings_data").length;
    const status = await seperate_save('list_judicial_proceedings','list_judicial_proceedings_data', 'list-judicial-proceedings-data', 'parent_list_judicial_proceedings', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_judicial_proceedings_data").last();
            var index_val = $(itm).index() + 1;

            var cln = $(itm).clone();

            let divclass = "list_judicial_proceedings_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find("label").removeClass("active");
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_judicial_proceedings','list_judicial_proceedings_data', 'list-judicial-proceedings-data', 'parent_list_judicial_proceedings', " + index_val + ")");
            var case_name = cln.find(".case_name");
            var case_number = cln.find(".case_number");
            var street_number = cln.find(".street_number");
            var name = cln.find(".name");
            var city = cln.find(".city");
            var state = cln.find(".state");
            var zip = cln.find(".zip");
            var case_nature = cln.find(".case_nature");
            var case_status = cln.find(".case_status");

            $(case_number).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[case_number][" + index_val + "]"
                );
            });

            $(case_name).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[case_name][" + index_val + "]"
                );
            });

            $(name).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[name][" + index_val + "]"
                );
            });

            $(street_number).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[street_number][" +
                        index_val +
                        "]"
                );
            });

            $(city).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[city][" + index_val + "]"
                );
            });

            $(state).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[state][" + index_val + "]"
                );
            });

            $(zip).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[zip][" + index_val + "]"
                );
            });

            $(case_nature).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[case_nature][" + index_val + "]"
                );
            });
            $(case_status).each(function () {
                $(this).attr(
                    "name",
                    "list_judicial_proceedings_data[case_status][" + index_val + "]"
                );
                if ($(this).val() == "1") {
                    $(this).attr("id", "Nature-case_pending_yes_" + index_val);
                    $(this)
                        .next("label")
                        .attr("for", "Nature-case_pending_yes_" + index_val);
                }
                if ($(this).val() == "2") {
                    $(this).attr("id", "Nature-case_on_appeal_no_" + index_val);
                    $(this)
                        .next("label")
                        .attr("for", "Nature-case_on_appeal_no_" + index_val);
                }
                if ($(this).val() == "3") {
                    $(this).attr("id", "Nature-case-concluded_no_" + index_val);
                    $(this)
                        .next("label")
                        .attr("for", "Nature-case-concluded_no_" + index_val);
                }
                $(this).attr("checked", false);
            });

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
        }
    }, 500);
}

function savings_account_addmore() {
    var clnln = $(document).find(".savings_account_mutisec").length;
    if (clnln > 4) {
        alert("You can add only 5 entries.");
        return false;
    } else {
        var itm = $(document).find(".savings_account_mutisec").last();
        var index_val = $(itm).index() + 1;
        var cln = $(itm).clone();
        $rowNo = itm.attr("rowNo");
        if (
            $rowNo == undefined ||
            $rowNo == null ||
            $rowNo == NaN ||
            $rowNo == ""
        ) {
            $rowNo = 1;
        } else {
            $rowNo = parseInt($rowNo) + 1;
        }
        itm.attr("rowNo", $rowNo);
        var index_val = $(itm).index() + 1;
        var cln = $(itm).clone();
        cln.find(".savings_account_description").val("");
        cln.find(".savings_account_property_value").val("");
        var savings_account_description = cln.find(
            ".savings_account_description"
        );
        var savings_account_property_value = cln.find(
            ".savings_account_property_value"
        );

        $(savings_account_description).each(function () {
            $(this).attr(
                "name",
                "savings_account[data][description][" + index_val + "]"
            );
        });
        $(savings_account_property_value).each(function () {
            $(this).attr(
                "name",
                "savings_account[data][property_value][" + index_val + "]"
            );
        });
        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        cln.find("select").val("");
        $(itm).after(cln);
        $(".remove-other-names").show();
    }
}

async function common_financial_addmore(element, removebuttonclass) {
    var clnln = $(document).find("." + element + "_mutisec").length;
    let status = false;
    if(element == 'patents_copyrights') {
         status = await seperate_save('patents_copyrights','patents_copyrights_mutisec', 'intellectual_property_data', 'parent_patents_copyrights', clnln, true);
    }
    if(element == 'trusts_life_estates') {
         status = await seperate_save('trusts_life_estates','trusts_life_estates_mutisec', 'interestin_property_data', 'parent_trusts_life_estates', clnln, true);
    }
    if(element == 'government_corporate_bonds') {
         status = await seperate_save('government_corporate_bonds','government_corporate_bonds_mutisec', 'government_corporate_data', 'parent_government_corporate_bonds', clnln, true);
    }
    if(element == 'mutual_funds') {
         status = await seperate_save('mutual_funds','mutual_funds_mutisec', 'bonds_mutual_funds_items_data', 'parent_mutual_funds', clnln, true);
    }
    if(element == 'inheritances') {
         status = await seperate_save('inheritances','inheritances_mutisec', 'Inheritances_benefits_data', 'parent_inheritances', clnln, true);
    }
    if(element == 'other_claims') {
         status = await seperate_save('other_claims','other_claims_mutisec', 'other_claims_data', 'parent_other_claims', clnln, true);
    }
    if(element == 'other_financial') {
        status = await seperate_save('other_financial','other_financial_mutisec', 'financial_asset_data', 'parent_other_financial', clnln, true);
    }
    
    if(!status && ( element == 'patents_copyrights' ||
                    element == 'trusts_life_estates' ||
                    element == 'government_corporate_bonds' ||
                    element == 'mutual_funds' ||
                    element == 'inheritances' ||
                    element == 'other_claims' ||
                    element == 'other_financial' )){
        return;
    }

    setTimeout(function() {
        if (clnln > 2) {
            $.systemMessage('You can add only 3 entries.', "alert--danger", true);
            return false;
        } else {
            var itm = $(document)
                .find("." + element + "_mutisec")
                .last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }
            itm.attr("rowNo", $rowNo);
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();
            cln.find("select").val("");
            cln.removeClass(function (index, className) {
                return (className.match(removebuttonclass + "_\\d+", "g") || []).join(' ');
            }).addClass(removebuttonclass + "_" + index_val);

            cln.find(".circle-number-div").html(index_val + 1);

            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('"+removebuttonclass+"', " + index_val + ")");
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');

            if(element == 'trusts_life_estates') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('trusts_life_estates','trusts_life_estates_mutisec', 'interestin_property_data', 'parent_trusts_life_estates', " + index_val + ")");
            }
            if(element == 'patents_copyrights') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('patents_copyrights','patents_copyrights_mutisec', 'intellectual_property_data', 'parent_patents_copyrights', " + index_val + ")");
            }   
            if(element == 'government_corporate_bonds') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('government_corporate_bonds','government_corporate_bonds_mutisec', 'government_corporate_data', 'parent_government_corporate_bonds', " + index_val + ")");
            }    
            if(element == 'mutual_funds') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('mutual_funds','mutual_funds_mutisec', 'bonds_mutual_funds_items_data', 'parent_mutual_funds', " + index_val + ")");
            }
            if(element == 'inheritances') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('inheritances','inheritances_mutisec', 'Inheritances_benefits_data', 'parent_inheritances', " + index_val + ")");
            }   
            if(element == 'other_claims') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('other_claims','other_claims_mutisec', 'other_claims_data', 'parent_other_claims', " + index_val + ")");
            }     
            if(element == 'other_financial') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('other_financial','other_financial_mutisec', 'financial_asset_data', 'parent_other_financial', " + index_val + ")");
            }     

            cln.find("." + element + "_type_of_account").val("");
            cln.find("." + element + "_description").val("");
            cln.find("." + element + "_property_value").val("");

            var common_type_of_account = cln.find(
                "." + element + "_type_of_account"
            );
            var common_description = cln.find("." + element + "_description");

            var common_property_value = cln.find("." + element + "_property_value");
            if (element == "mutual_funds" || element == "inheritances") {
                var common_unknown = cln.find("." + element + "_unknown");
                $(common_unknown).each(function () {
                    $(this).attr(
                        "name",
                        element + "[data][unknown][" + index_val + "]"
                    );
                    $(this).attr(
                        "onchange",
                        "checkUnknown(this, " + index_val + ",'mutual')"
                    );
                    $(this).removeAttr('checked');
                });
                $(common_property_value).each(function () {
                    $(this).attr(
                        "name",
                        element + "[data][property_value][" + index_val + "]"
                    );
                    var previndex = index_val - 1;
                    $(this)
                        .removeClass("is_mutual_unknown_" + previndex)
                        .addClass("is_mutual_unknown_" + index_val)
                        .addClass("required");
                    $(this).removeAttr('disabled');
                });
            } else {
                $(common_property_value).each(function () {
                    $(this).attr(
                        "name",
                        element + "[data][property_value][" + index_val + "]"
                    );
                });
            }
            $(common_type_of_account).each(function () {
                $(this).attr(
                    "name",
                    element + "[data][type_of_account][" + index_val + "]"
                );
            });
            $(common_description).each(function () {
                $(this).attr(
                    "name",
                    element + "[data][description][" + index_val + "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
           
            cln.find("textarea").val("");
            $(itm).after(cln);
            $(".remove-" + removebuttonclass).show();
        }
    }, 200);
}

async function common_financial_addmore_with_limit(
    element,
    entries_count,
    removebuttonclass,
    inputClass = ''
) {
    var clnln = $(document).find("." + element + "_mutisec").length;
    
    let status = false;
    if(element == 'education_ira') {
        status = await seperate_save('education_ira','education_ira_mutisec', 'education_IRA_data', 'parent_education_ira', clnln, true);
    }
    if(element == 'annuities') {
        status = await seperate_save('annuities','annuities_mutisec', 'annuities_data', 'parent_annuities', clnln, true);
    }
    if(element == 'retirement_pension') {
        status = await seperate_save('retirement_pension','retirement_pension_mutisec', 'retirement_pension_data', 'parent_retirement_pension', clnln, true);
    }
    if(element == 'unpaid_wages') {
        status = await seperate_save('unpaid_wages','unpaid_wages_mutisec', 'unpaid_wages_data', 'parent_unpaid_wages', clnln, true);
    }
    if(element == 'insurance_policies') {
        status = await seperate_save('insurance_policies','insurance_policies_mutisec', 'insurance_policies_data', 'parent_insurance_policies', clnln, true);
    }
    if(element == 'injury_claims') {
        status = await seperate_save('injury_claims','injury_claims_mutisec', 'personal_injury_data', 'parent_injury_claims', clnln, true);
    }
    if(element == 'life_insurance') {
        status = await seperate_save('life_insurance','life_insurance_mutisec', 'life_insurance_data', 'parent_life_insurance', clnln, true);
    }

    if(!status && ( element == 'education_ira' ||
        element == 'annuities' ||
        element == 'retirement_pension' ||
        element == 'unpaid_wages' ||
        element == 'insurance_policies' ||
        element == 'injury_claims' ||
        element == 'life_insurance' ))
    {
        return;
    }

    setTimeout(function() {
        if (clnln > entries_count - 1) {
            $.systemMessage("You can add only " + entries_count + " entries.", "alert--danger", true);
            return false;
        } else {
            var itm = $(document)
                .find("." + element + "_mutisec")
                .last();
            var index_val = $(itm).index() + 1;
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }

            itm.attr("rowNo", $rowNo);
            var index_val = $(itm).index() + 1;
            var cln = $(itm)
                .clone()
                .find("input[type=text]")
                .val("")
                .end()
                .find("input[type=number]")
                .val("")
                .end()
                .find("textarea")
                .val("")
                .end()
                .find("select")
                .val("")
                .end()
                .find("input[type=checkbox]")
                .prop("checked", false)
                .end();

            let divclass = element + "_mutisec";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
        
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find("select").val("");
            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');

            if(element == 'education_ira') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('education_ira','education_ira_mutisec', 'education_IRA_data', 'parent_education_ira', " + index_val + ")");
            }
            if(element == 'retirement_pension') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('retirement_pension','retirement_pension_mutisec', 'retirement_pension_data', 'parent_retirement_pension', " + index_val + ")");
            }
            if(element == 'annuities') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('annuities','annuities_mutisec', 'annuities_data', 'parent_annuities', " + index_val + ")");
            }
            if(element == 'unpaid_wages') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('unpaid_wages','unpaid_wages_mutisec', 'unpaid_wages_data', 'parent_unpaid_wages', " + index_val + ")");
            }
            if(element == 'insurance_policies') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('insurance_policies','insurance_policies_mutisec', 'insurance_policies_data', 'parent_insurance_policies', " + index_val + ")");
            }
            if(element == 'injury_claims') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('injury_claims','injury_claims_mutisec', 'personal_injury_data', 'parent_injury_claims', " + index_val + ")");
            }
            if(element == 'life_insurance') {
                cln.find(`.save-btn`).attr("onclick", "seperate_save('life_insurance','life_insurance_mutisec', 'life_insurance_data', 'parent_life_insurance', " + index_val + ")");
            }
            cln.find("." + element + "_type_of_account").val("");
            cln.find("." + element + "_description").val("");
            cln.find("." + element + "_property_value").val("");
                
            var common_type_of_account = cln.find("." + element + "_type_of_account");
            var common_description = cln.find("." + element + "_description");
            var common_property_value = cln.find("." + element + "_property_value");

            if (element == "retirement_pension") {
                var common_unknown = cln.find("." + element + "_unknown");
                $(common_unknown).each(function () {
                    $(this).attr(
                        "name",
                        element + "[data][unknown][" + index_val + "]"
                    );
                    $(this).attr(
                        "onchange",
                        "checkUnknownRetirement(this, " + index_val + ")"
                    );
                    $(this).removeAttr('checked');
                });
                $(common_property_value).each(function () {
                    $(this).attr(
                        "name",
                        element + "[data][property_value][" + index_val + "]"
                    );
                    var previndex = index_val - 1;
                    $(this)
                        .removeClass(
                            "retirement_pension_property_value_is_unknown_" +
                                previndex
                        )
                        .addClass(
                            "retirement_pension_property_value_is_unknown_" +
                                index_val
                        );
                    $(this).removeAttr('disabled');
                });
            } else if (element == "life_insurance"){
                var account_type = cln.find("." + element + "_account_type");
                var current_value = cln.find("." + element + "_current_value");
                var common_unknown = cln.find("." + element + "_unknown");
                $(account_type).each(function () {
                    $(this).attr( "name", element + "[data][account_type][" + index_val + "]" );
                });
                $(current_value).each(function () {
                    $(this).attr( "name", element + "[data][current_value][" + index_val + "]" );
                });
                $(common_unknown).each(function () {
                    $(this).attr( "name", element + "[data][unknown][" + index_val + "]" );
                    $(this).attr( "onchange", "checkUnknown(this, " + index_val + ", 'life_insu')" );
                    $(this).removeAttr('checked');
                });
                $(common_property_value).each(function () {
                    var previndex = index_val - 1;
                    $(this).attr( "name", element + "[data][property_value][" + index_val + "]" );
                    $(this).removeClass( "is_life_insu_unknown_" + previndex ).addClass( "is_life_insu_unknown_" + index_val );
                    $(this).removeAttr('disabled');
                });
            } else if (element == "insurance_policies"){
                var account_type = cln.find("." + element + "_account_type");
                var common_unknown = cln.find("." + element + "_unknown");
                $(account_type).each(function () {
                    $(this).attr( "name", element + "[data][account_type][" + index_val + "]" );
                });
                $(common_unknown).each(function () {
                    $(this).attr( "name", element + "[data][unknown][" + index_val + "]" );
                    $(this).attr( "onchange", "checkUnknown(this, " + index_val + ", 'insu')" );
                    $(this).removeAttr('checked');
                });
                $(common_property_value).each(function () {
                    var previndex = index_val - 1;
                    $(this).attr( "name", element + "[data][property_value][" + index_val + "]" );
                    $(this).removeClass( "is_insu_unknown_" + previndex ).addClass( "is_insu_unknown_" + index_val );
                    $(this).removeAttr('disabled');
                });
            }  else if (element == "unpaid_wages"){
                var owed_type = cln.find("." + element + "_owed_type");
                var common_unknown = cln.find("." + element + "_unknown");
                var data_for = cln.find("." + element + "_data_for");
                var monthly_amount = cln.find("." + element + "_monthly_amount");
                $(owed_type).each(function () {
                    $(this).attr( "name", element + "[data][owed_type][" + index_val + "]" );
                });
                $(common_unknown).each(function () {
                    $(this).removeAttr('checked');
                    $(this).attr( "name", element + "[data][unknown][" + index_val + "]" );
                    $(this).attr( "onchange", "checkUnknown(this, " + index_val + ", 'unpaid_wages')" );
                });
                $(data_for).each(function () {
                    $(this).attr( "name", element + "[data][data_for][" + index_val + "]" );
                });
                $(common_property_value).each(function () {
                    var previndex = index_val - 1;
                    $(this).attr( "name", element + "[data][property_value][" + index_val + "]" );
                    $(this).removeClass( "is_unpaid_wages_unknown_" + previndex ).addClass( "is_unpaid_wages_unknown_" + index_val );
                    if (!$(this).hasClass("required")) {
                        $(this).addClass("required");
                    }
                    $(this).removeAttr("disabled");
                });
                $(monthly_amount).each(function () {
                    $(this).attr( "name", element + "[data][monthly_amount][" + index_val + "]" );
                });
            } else {
                $(common_property_value).each(function () {
                    if(inputClass){
                        $(this).attr( "name", inputClass + "[data][property_value][" + index_val + "]" );
                    }else{
                        $(this).attr( "name", element + "[data][property_value][" + index_val + "]" );
                    }                
                });
            }
            $(common_type_of_account).each(function () {
                if(inputClass){
                    $(this).attr( "name", inputClass + "[data][type_of_account][" + index_val + "]" );
                }else{
                    $(this).attr( "name", element + "[data][type_of_account][" + index_val + "]" );
                }
            });
            $(common_description).each(function () {
                if(inputClass){
                    $(this).attr( "name", inputClass + "[data][description][" + index_val + "]" );
                }else{
                    $(this).attr( "name", element + "[data][description][" + index_val + "]" );
                }
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            
            cln.find("textarea").val("");
            $(itm).after(cln);
            $(".remove-" + removebuttonclass).show();
            $(".remove-retirement-pension-mutisec").css("display", "unset");
            $(".remove-security-deposits-mutisec").css("display", "unset");
            $(".remove-annuities-mutisec").css("display", "unset");
            $(".remove-education-ira-mutisec").css("display", "unset");
            $(".remove-alimony-child-support-mutisec").css("display", "unset");
        }
    }, 200);
}

function other_financial_addmore(element) {
    var clnln = $(document).find("." + element + "_mutisec").length;
    if (clnln > 4) {
        $.systemMessage("You can add only 5 entries.", "alert--danger", true);
        return false;
    } else {
        var itm = $(document)
            .find("." + element + "_mutisec")
            .last();
        var index_val = clnln;
        var cln = $(itm)
            .clone()
            .find("input")
            .val("")
            .end()
            .find("textarea")
            .val("")
            .end()
            .find("select")
            .val("")
            .end();

        $rowNo = itm.attr("rowNo");
        if (
            $rowNo == undefined ||
            $rowNo == null ||
            $rowNo == NaN ||
            $rowNo == ""
        ) {
            $rowNo = 1;
        } else {
            $rowNo = parseInt($rowNo) + 1;
        }
        itm.attr("rowNo", $rowNo);
        var index_val = $(itm).index() + 1;
        var cln = $(itm).clone();
        cln.find("." + element + "_description").val("");
        cln.find("." + element + "_property_value").val("");

        var common_description = cln.find("." + element + "_description");
        var common_property_value = cln.find("." + element + "_property_value");

        $(common_description).each(function () {
            $(this).attr(
                "name",
                element + "[data][description][" + index_val + "]"
            );
        });
        $(common_property_value).each(function () {
            $(this).attr(
                "name",
                element + "[data][property_value][" + index_val + "]"
            );
        });

        $(itm).after(cln);
        $(".remove-other-financial-account-mutisec").show();
    }
}

async function tax_refund_addmore() {
    var divLength = $(document).find(".tax_refunds_mutisec").length;
    const status = await seperate_save('tax_refunds','tax_refunds_mutisec', 'tax_refunds_MainRow', 'parent_tax_refund', divLength, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        
        if (divLength > 2) {
            $.systemMessage("You can add only 3 entries.", "alert--danger", true);
            return false;
        } else {
            var divLast = $(document).find(".tax_refunds_mutisec").last();

            var index_val = divLength;

            var divClone = $(divLast).clone();

            // Update class and delete button for new index
            divClone.removeClass(function (index, className) {
                return (className.match(/tax_refunds_mutisec_\d+/g) || []).join(' ');
            }).addClass("tax_refunds_mutisec_" + index_val);
            divClone.find(".delete-div").attr("onclick", "seperate_remove_div_common('tax_refunds_mutisec', " + index_val + ")");
            divClone.find(".client-edit-button").attr("onclick", "edit_div_common('tax_refunds_mutisec', " + index_val + ")");
            // Update input fields with the correct name attributes
            divClone.find(".circle-number-div").html(index_val + 1);
            divClone.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            divClone.find(`.edit_section`).removeClass('hide-data');
            divClone.find(`.save-btn`).attr("onclick", "seperate_save('tax_refunds','tax_refunds_mutisec', 'tax_refunds_MainRow', 'parent_tax_refund', " + index_val + ")");

            var type = divClone.find(".tax_refunds_description");
            var selectText = divClone.find(".selectText");
            var selectAll = divClone.find(".selectall");
            var justOne = divClone.find(".justone");
            var year = divClone.find(".refund_whats_year");
            var propertyValue = divClone.find(".tax_refunds_property_value");

            var previousSelectedType = divLast
                .find(".tax_refunds_description")
                .val();

            $(type).each(function () {
                $(this).attr(
                    "name",
                    "tax_refunds[data][description][" + index_val + "]"
                );
                var flagvar = false;

                $(this)
                    .find("option")
                    .each(function () {
                        var optionValue = $(this).val();
                        if (previousSelectedType == optionValue) {
                            flagvar = true;
                        } else {
                            if (flagvar) {
                                $(this).prop("selected", true);
                                flagvar = false;
                            }
                        }
                    });
                    
                $(this).attr("data-previousvalue", "");
            });

        

            $(selectText).each(function () {
                $(this)
                    .removeClass("select-text-" + (index_val - 1))
                    .addClass("select-text-" + index_val);
            });

            $(selectAll).each(function () {
                $(this).attr(
                    "data-inputname",
                    "tax_refunds[data][year][" + index_val + "]"
                );
                $(this).attr("data-inputfor", "refund_" + index_val);
                $(this).attr("onchange", "setSelectAll(this, " + index_val + ")");
                $(this).attr("id", $(this).attr("id") + index_val);
                $(this).parent("label").attr("for", $(this).attr("id"));
                $(this).prop("checked", false);
            });

            $(justOne).each(function () {
                var prev_index = index_val - 1;
                $(this).removeClass("refund_" + prev_index);
                $(this).addClass("refund_" + index_val);
                $(this).attr(
                    "data-inputname",
                    "tax_refunds[data][year][" + index_val + "]"
                );
                $(this).attr("data-inputfor", "refund_" + index_val);
                $(this).attr("onchange", "setJustOne(this, " + index_val + ")");
                $(this).attr("id", $(this).attr("id") + index_val);
                $(this).parent("label").attr("for", $(this).attr("id"));
                $(this).prop("checked", false);
            });

            $(year).each(function () {
                $(this).attr("name", "tax_refunds[data][year][" + index_val + "]");
                $(this)
                    .removeClass("refund_whats_year_" + (index_val - 1))
                    .addClass("refund_whats_year_" + index_val);
            });

            $(propertyValue).each(function () {
                $(this).attr(
                    "name",
                    "tax_refunds[data][property_value][" + index_val + "]"
                );
                $(this).prop("readonly", false);
            });

            divClone.find('input[type="text"]').val("");
            divClone.find('input[type="number"]').val("");
            // divClone.find('select').val('');

            $(divLast).after(divClone);
            $(".remove-tax-refund-mutisec").show();
        }
        
    }, 200);
}

async function remove_debt_div(row_class, thisobj) {
     const canEdit = await is_editable('can_edit_debts');
        if (!canEdit) {
            return false; // Stops execution if no permission
        }
    var cloneLength = $(document).find(".debt_creditor_form").length;
    if (cloneLength <= 1) {
        $.systemMessage(
            "You cannot delete because at least 1 entry is required.",
            "alert--danger"
        );
        return false;
    } else {
        var saveId = $(thisobj).attr("data-saveid");

      
        showConfirmation("Do you want to remove this creditor?", function(confirmation) {
        if (confirmation) {
            $(".second_step_debt")
                .find(".debt_creditor_" + saveId)
                .remove();
            $(".second_step_debt")
                .find(".debt_creditor_sub_" + saveId)
                .remove();

            $(".second_step_debt .row.debt_creditor_form").each(function (
                index
            ) {
                var updatedRowClass = index + 1;
                $(this)
                    .removeClass("debt_creditor_" + (index + 2))
                    .addClass("debt_creditor_" + updatedRowClass);
                $(this)
                    .find(".debt_no")
                    .text(updatedRowClass + ".");
                var removeButton = $(this).find(".fas.fa-trash");
                removeButton.attr(
                    "onclick",
                    "remove_debt_div(" + updatedRowClass + ")"
                );
            });
            var url = $("#debt_url").val();
            saveTheseDebts(url);
        }
    });
    }
}

function remove_additional_debt_div(row_class) {
  
    showConfirmation("Do you want to remove this creditor?", function(confirmation) {
    if (confirmation) {
        $(".additional_liens_div")
            .find(".add_liens_creditor_" + row_class)
            .remove();
        $(".additional_liens_div .row.additional_liens_form").each(function (
            index
        ) {
            var updatedRowClass = index + 1;
            $(this)
                .removeClass("add_liens_creditor_" + (index + 2))
                .addClass("add_liens_creditor_" + updatedRowClass);
            var removeButton = $(this).find(".fas.fa-trash");
            removeButton.attr(
                "onclick",
                "remove_debt_div(" + updatedRowClass + ")"
            );
        });
    }
    });
}

function remove_clone_box(box_class) {
    var clnln = $(document).find("." + box_class).length;
    if (clnln <= 1) {
        alert("You cannot delete because min 1 entries require.");
        return false;
    } else {
        $(document)
            .find("." + box_class)
            .last()
            .remove();
        var itm = $(document)
            .find("." + box_class)
            .last();
        var remove_btn_index = itm.find("button.remove_clone").data("index");
        if (remove_btn_index > 0) {
            itm.find("button." + button_class).show();
        }
    }
}


function remove_div_common(div_class, index, msg = "", reindexAllElements = true) {
    
    var clnln = $(document).find("." + div_class).length;
    if (clnln <= 1) {
        if (msg == "") {
            msg = "You cannot delete because at least 1 entry is required."; 
        }
        $.systemMessage(msg, 'alert--danger', true);
        return false;
    } else {
        $(document)
            .find(`.${div_class}_${index}`)
            .remove();
    }

    if(reindexAllElements){
        reindexElements(div_class);
    }else{
        reindexCircleNoElements(div_class);
    }
    
}

async function seperate_remove_div_common(div_class, index, msg = "") {
    const $target = $(document).find(`.${div_class}_${index}`);
    const clnln = $(document).find("." + div_class).length;
    if (clnln <= 1) {
        if (msg == "") {
            msg = "You cannot delete because at least 1 entry is required."; 
        }
        $.systemMessage(msg, 'alert--danger', true);
        return false;
    } 

    // Clone before removal so we can restore if needed
    const $clone = $target.clone(true, true);

    // Store the parent and index for accurate reinsertion
    const $parent = $target.parent();
    const targetIndex = $parent.children().index($target);

    // Remove the element
   
    
    const configMap = {
        'life_insurance_mutisec': ['life_insurance', 'life_insurance_mutisec', 'life_insurance_data', 'parent_life_insurance'],
        'other_financial_mutisec': ['other_financial', 'other_financial_mutisec', 'financial_asset_data', 'parent_other_financial'],
        'other_claims_mutisec': ['other_claims', 'other_claims_mutisec', 'other_claims_data', 'parent_other_claims'],
        'injury_claims_mutisec': ['injury_claims', 'injury_claims_mutisec', 'personal_injury_data', 'parent_injury_claims'],
        'inheritances_mutisec': ['inheritances', 'inheritances_mutisec', 'Inheritances_benefits_data', 'parent_inheritances'],
        'insurance_policies_mutisec': ['insurance_policies', 'insurance_policies_mutisec', 'insurance_policies_data', 'parent_insurance_policies'],
        'unpaid_wages_mutisec': ['unpaid_wages', 'unpaid_wages_mutisec', 'unpaid_wages_data', 'parent_unpaid_wages'],
        'alimony_child_support_mutisec': ['alimony_child_support', 'alimony_child_support_mutisec', 'alimony_child_data', 'parent_alimony_child_support'],
        'bank_accounts': ['bank', 'bank_accounts', 'checking_account_items_data', 'parent_bank'],
        'venmo-paypal-cash-mainsec': ['venmo_paypal_cash', 'venmo-paypal-cash-mainsec', 'account_items_data', 'parent_venmo_paypal_cash'],
        'brokerage_account_mutisec': ['brokerage_account', 'brokerage_account_mutisec', 'brokerage_items_data', 'parent_brokerage_account'],
        'mutual_funds_mutisec': ['mutual_funds', 'mutual_funds_mutisec', 'bonds_mutual_funds_items_data', 'parent_mutual_funds'],
        'government_corporate_bonds_mutisec': ['government_corporate_bonds', 'government_corporate_bonds_mutisec', 'government_corporate_data', 'parent_government_corporate_bonds'],
        'retirement_pension_mutisec': ['retirement_pension', 'retirement_pension_mutisec', 'retirement_pension_data', 'parent_retirement_pension'],
        'annuities_mutisec': ['annuities', 'annuities_mutisec', 'annuities_data', 'parent_annuities'],
        'education_ira_mutisec': ['education_ira', 'education_ira_mutisec', 'education_IRA_data', 'parent_education_ira'],
        'trusts_life_estates_mutisec': ['trusts_life_estates', 'trusts_life_estates_mutisec', 'interestin_property_data', 'parent_trusts_life_estates'],
        'patents_copyrights_mutisec': ['patents_copyrights', 'patents_copyrights_mutisec', 'intellectual_property_data', 'parent_patents_copyrights'],
        'tax_refunds_mutisec': ['tax_refunds', 'tax_refunds_mutisec', 'tax_refunds_MainRow', 'parent_tax_refund'],
        'list_all_financial_accounts': ['list_all_financial_accounts', 'list_all_financial_accounts', 'list_all_financial_accounts-data', 'parent_list_all_financial_accounts'],
        // sofa step 1
        'living_domestic_partners': ['living_domestic_partner','living_domestic_partners', 'living-domestic-partner-data', 'parent_living_domestic_partner'],
        'payment_past_one_year': ['past_one_year_data','payment_past_one_year', 'payment-past-one-year-data', 'parent_payment_past_one_year'],
        'transfers_property': ['transfers_property','transfers_property', 'transfers-property-data', 'parent_transfers_property'],
        'list_lawsuits': ['list_lawsuits','list_lawsuits', 'list-lawsuits-data', 'parent_list_lawsuits'],
        'property_repossessed_data_form': ['property_repossessed','property_repossessed_data_form', 'property-repossessed-data', 'parent_property_repossessed'],
        'setoffs_creditor_data': ['setoffs_creditor','setoffs_creditor_data', 'setoffs_creditor-data', 'parent_setoffs_creditor'],
        // sofa step 2
        'list_any_gifts_data': ['list_any_gifts','list_any_gifts_data', 'list-any-gifts-data', 'parent_list_any_gifts'],
        'gifts_charity_data': ['gifts_charity','gifts_charity_data', 'gifts-charity-data', 'parent_gifts_charity'],
        'losses_from_fire_data': ['losses_from_fire','losses_from_fire_data', 'losses_from_fire-data', 'parent_losses_from_fire'],
        'property_transferred_data': ['property_transferred','property_transferred_data', 'property-transferred-data', 'parent_property_transferred'],
        'property_transferred_creditors_data': ['property_transferred_creditors','property_transferred_creditors_data', 'property-transferred-creditors-data', 'parent_property_transferred_creditors'],
        'Property_all_data': ['Property_all','Property_all_data', 'Property_all-data', 'parent_Property_all'],
        'all_property_transfer_10_year_data': ['all_property_transfer_10_year','all_property_transfer_10_year_data', 'list-all-property_transfer-data', 'parent_all_property_transfer_10_year'],
        'list_safe_deposit_data': ['list_safe_deposit','list_safe_deposit_data', 'list-safe-deposit-data', 'parent_list_safe_deposit'],
        'other_storage_unit_data': ['other_storage_unit','other_storage_unit_data', 'list-storage-unit-data', 'parent_other_storage_unit'],
        'list_property_you_hold_data': ['list_property_you_hold','list_property_you_hold_data', 'list-property-you-hold-data', 'parent_list_property_you_hold'],
        // sofa step 3
        'list_noticeby_gov_data': ['list_noticeby_gov','list_noticeby_gov_data', 'list-noticeby-gov-data', 'parent_list_noticeby_gov'],
        'list_environment_law_data': ['list_environment_law','list_environment_law_data', 'list-environment_law-data', 'parent_list_environment_law'],
        'list_judicial_proceedings_data': ['list_judicial_proceedings','list_judicial_proceedings_data', 'list-judicial-proceedings-data', 'parent_list_judicial_proceedings'],
        'list_financial_institutions_data': ['list_financial_institutions','list_financial_institutions_data', 'list-financial-institutions-data', 'parent_list_financial_institutions'],
        // previous employer
        'previous_employer_div_self': ['previous_employer_self','previous_employer_div_self', 'data-previous-employer-self', 'parent_previous_employer'],
        'previous_employer_div_spouse': ['previous_employer_spouse','previous_employer_div_spouse', 'data-previous-employer-spouse', 'parent_previous_employer'],
        'list_nature_business_data': ['list_nature_business','list_nature_business_data', 'list-nature-business-data', 'parent_list_nature_business'],
    };  

    if (div_class === 'bank_accounts') {
        let transaction_enabled = $("#bank-addmore-button").attr('data-transaction-enabled');
        if (transaction_enabled == 1) {
            checkBankAccInputs();
        }
    }

    if (configMap.hasOwnProperty(div_class)) {
        $target.remove();
        const [type, divCls, dataKey, parentId] = configMap[div_class];
        const success = await seperate_save(type, divCls, dataKey, parentId, index, true);
        
         
        if (!success) {
            // Reinsert the cloned element at its original position
            if (targetIndex === 0) {
                $parent.prepend($clone);
            } else {
                $parent.children().eq(targetIndex - 1).after($clone);
            }
        }
       
        return success;
    }

    return true;

}

function edit_div_common(div_class, index, msg = "") {
    $(document).find(`.${div_class}_${index} .summary_section, .${div_class}_${index} .client-edit-button`).addClass('hide-data');
    $(document).find(`.${div_class}_${index} .edit_section`).removeClass('hide-data');
    initializeDatepicker();
}

async function seperate_save(type, div_class, parent_id, fileName, index, isDelete = false) {
    const $section =  (isDelete) ? $(`#${parent_id}`) : $(`.${div_class}_${index} .edit_section`);

    const $saveBtn = $section.find('.save-btn'); // find the save button within the section
    const url = $saveBtn.data('url'); // fallback to data-url if not passed directly
    const formData = new FormData();
    let isValid = true;
    let firstInvalidEl = null;
    // Append type to FormData
    formData.append('assetType', type);
    formData.append('fileName', fileName);
    formData.append('isDelete', isDelete);

    $section.find('input, select, textarea').each(function () {
        const $el = $(this);
        const name = $el.attr('name');
        const value = $el.val();
        const isRequired = $el.hasClass('required') || $el.attr('required');
        const isHiddenInput = $el.attr('type') === 'hidden';
        if (isHiddenInput) {
            if (name) {
                formData.append(name, value);
            }
            return;
        }
    
        $el.removeClass('error'); // remove previous error styles
        $(`label[for="${$el.attr('id')}"]`).removeClass('error');

        if ($el.is(':radio')) {
            if ($(`input[name="${name}"]:checked`).length === 0 && isRequired) {
                if ($el.closest('.hide-data').length === 0) {
                    $el.addClass('error');
                    $(`label[for="${$el.attr('id')}"]`).addClass('error');
                    if (!firstInvalidEl) firstInvalidEl = $el;
                    isValid = false;
                }
            } else if ($el.is(':checked') && name) {
                formData.append(name, value);
            }
            return;
        }

        // Validate required fields
        if (isRequired && (!value || value.trim() === '')) {
            if ($el.closest('.hide-data').length === 0) {
                $el.addClass('error');
                if (!firstInvalidEl) {
                    firstInvalidEl = $el;
                }
                isValid = false;                
            }
        } else if (name) {
            if ($el.is(':checkbox')) {
                if ($el.is(':checked')) {
                    formData.append(name, value);
                }else{
                    formData.append(name, '');
                }
                
            } else {
                formData.append(name, value);
            }
        }
    });

    if (!isValid) {
        if (firstInvalidEl) firstInvalidEl.focus();
        $.systemMessage("Please fill out all required fields.", 'alert--danger', true);
        return false;
    }

    if (type == 'list_all_financial_accounts'){
        formData.append('editableTab', 'can_edit_property');
    }

    const returnStatus = await makeSeperateSaveCall(url, formData, parent_id);
    console.log(url);
    return returnStatus;
}

async function makeSeperateSaveCall(url, formData, parent_id) {
    try {
        const response = await $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (response.status) {
            $.systemMessage("Saved successfully.", 'alert--success', true);
            $(`#${parent_id}`).html(response.html);
            return true;
        } else {
            $.systemMessage(response.msg, "alert--danger");
            return false;
        }
    } catch (xhr) {
        $.systemMessage("Something went wrong. Please try again.", "alert--danger");
        console.error(xhr.responseText);
        return false;
    }
}

function removeAdditionalBusinessSection(url) {
    var visibleCount = 0;
    var lastVisibleIndex = 0;
    
    // Find the last visible business section
    for (var i = 1; i <= 6; i++) {
        if (!$(".operation_business.company_" + i).hasClass("hide-data")) {
            visibleCount++;
            lastVisibleIndex = i;
        }
    }
    
    // Only allow deletion if there's more than 1 visible section
    if (visibleCount > 1) {
        $(".operation_business.company_" + lastVisibleIndex).addClass("hide-data");
        laws.ajax(url, {"additional": lastVisibleIndex }, function (response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
            }
        });
    } else {
        $.systemMessage("You can't delete because you have not added any additional Company.", 'alert--danger', true);
        return false;
    }
}
async function removeAdditionalBusinessSectionJoint(url) {
    const canEdit = await is_editable('can_edit_income');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }
    
    var visibleCount = 0;
    var lastVisibleIndex = 0;
    
    // Find the last visible business section
    for (var i = 1; i <= 6; i++) {
        if (!$(".joint_operation_business.company_" + i).hasClass("hide-data")) {
            visibleCount++;
            lastVisibleIndex = i;
        }
    }
    
    // Only allow deletion if there's more than 1 visible section
    if (visibleCount > 1) {
        $(".joint_operation_business.company_" + lastVisibleIndex).addClass("hide-data");
        laws.ajax(url, {"additional": lastVisibleIndex }, function (response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
            }
        });
    } else {
        $.systemMessage("You can't delete because you have not added any additional Company.", 'alert--danger', true);
        return false;
    }
}

function saveTheseDebts(displaymsg = true, thisobj={}, newdiv=false) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_unsecured",displaymsg);
    if(!hasError && !newdiv){
        var cln = $(thisobj).parent('div').parent('div').parent("div").parent("div");
        var debt_creditor_form = cln.find(".debt_creditor_form");
        
        $(debt_creditor_form).each(function () {
           if($(this).find(".credit_summ").hasClass('hide-data')){
                $(this).find(".credit_summ").removeClass('hide-data');
                $(this).find(".insider_data").addClass('hide-data');
            }
        });
    }
    return !hasError;
}

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

function saveBackTaxDebt(displaymsg = true, thisobj={}, newdiv=false) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_back_taxes",displaymsg);
    if(!hasError && !newdiv){
        var cln = $(thisobj).parent('div').parent('div').parent("div").parent("div").parent('div');
        var debt_creditor_form = cln.find(".tax_debt_form");
        $(debt_creditor_form).each(function () {
            if($(this).find(".common_creditor_summary").hasClass('hide-data')){
                $(this).find(".common_creditor_summary").removeClass('hide-data');
                $(this).find(".insider_data").addClass('hide-data');
            }
        });
    }
    return !hasError;
}

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

function saveIRSDebt(displaymsg = true) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_irs",displaymsg);
    if(!hasError){
        $("#tax-owned-irs").addClass('hide-data');
    }else{
        $("#tax-owned-irs").removeClass('hide-data');
    }
    return !hasError;
}


function revalidateFormWithMonthYear(formId,displaymsg=true,saveFromAttorney=false,reloadPage=false) {
    var hasError = false;
    validateFormIds(formId);
    $("#"+ formId).validate().form();
   
    if (!$("#"+ formId).valid()) {
        $('html, body').animate({
            scrollTop: ($('.error:visible').offset().top - 60)
        }, 200);
        hasError = true;
    } else {
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
            success: function ( data ) {
                if(displaymsg == true){
                    if(data.status==1){
                        if(data.display_id == 'irs-texes-views'){
                            $('#irs-texes-views').removeClass('hide-data');
                        }
                        $(document).find("#"+data.display_id).html(data.html);
                        $.systemMessage(data.msg,"alert--success");
                        if(reloadPage && saveFromAttorney ){
                            setTimeout(function() {
                                window.location.href = data.url;
                            }, 2000);
                        }
                    }else{
                        hasError = true;
                        $.systemMessage(data.msg, "alert--danger");
                        return hasError;
                    }
                }
                    
            }
        }); 
    }
    return hasError;
}

function validateFormIds(formId){
    if(formId=='client_property_step2'){
        $(".vd-section").each(function() {
            if($(this).hasClass('d-none')){
                $(this).parent('div').parent('div').find('.vin_number').removeClass('required');
                $(this).removeClass('d-none');
            }
        });
    }
    if(formId == 'date_month_year_custom'){
        let commonRules = {
            required: true,
            dateMMYYYY: true
        };
        $(".date_month_year_custom").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                dateMMYYYY: "Please enter a valid date in the format MM/YYYY."
            };
        });
    }
    if(formId == 'client_debts_step2_unsecured'){
        let commonRules = {
            required: true,
            dateMMYYYY: true
        };
        // Apply rules to all inputs with the class 'dateMMYYYY'
        $(".date_month_year").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                dateMMYYYY: "Please enter a valid date in the format MM/YYYY."
            };
        });
        commonRules = {
            required: true,
            fourDigits: true
        };
        $(".allow-4digit").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                fourDigits: "Please enter last 4 digits."
            };
        });
    }

    if(formId == 'client_debts_step2_back_taxes'){
        commonRules = {
            required: true,
            multipleYears: true
        };
        $(".tax_whats_year").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                fourDigits: "Please enter valid years separated by spaces, not greater than the current year."
            };
        });
    }

    if(formId == 'client_debts_step2_irs'){
        commonRules = {
            required: true,
            multipleYears: true
        };
        $(".tax_irs_whats_year").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                fourDigits: "Please enter valid years separated by spaces, not greater than the current year."
            };
        });
    }

    if(formId == 'client_debts_step2_al'){
        let commonRules = {
            required: true,
            dateMMYYYY: true
        };
        // Apply rules to all inputs with the class 'dateMMYYYY'
        $(".additional_liens_date").each(function() {
            const inputName = $(this).attr('name');
            $("#" + formId).validate().settings.rules[inputName] = commonRules;
            $("#" + formId).validate().settings.messages[inputName] = {
                required: "This field is required.",
                dateMMYYYY: "Please enter a valid date in the format MM/YYYY."
            };
        });
    }

    if(formId=='client_property_step2'){

       
        const form = document.getElementById(formId);

        // Track validity
        let isValid = true;

        // Group radios by name
        const radioGroups = {};
        const radios = form.querySelectorAll('input[type="radio"]');

        radios.forEach(radio => {
            const name = radio.name;
            if (!radioGroups[name]) {
                radioGroups[name] = [];
            }
            radioGroups[name].push(radio);
        });

        // Validate each group
        Object.keys(radioGroups).forEach(groupName => {
            const group = radioGroups[groupName];
            const isGroupChecked = group.some(radio => radio.checked);

            group.forEach(radio => {
                const label = form.querySelector(`label[for="${radio.id}"]`);
                if (label) {
                    label.classList.toggle('isRadioError', !isGroupChecked);
                }
            });

            if (!isGroupChecked) {
                isValid = false;

                // Add error label only if not already added
                const firstRadio = group[0];
                const container = firstRadio.closest('.custom-radio-group');
                const errorId = `${firstRadio.name}-error`;

                if (container && !form.querySelector(`#${CSS.escape(errorId)}`)) {
                    const errorLabel = document.createElement('label');
                    errorLabel.className = 'error';
                    errorLabel.id = errorId;
                    errorLabel.htmlFor = firstRadio.name;
                    errorLabel.textContent = 'This field is required.';

                    container.after(errorLabel); // Place error after the group
                }
            } else {
                // Remove existing error label if group is now valid
                const errorLabel = form.querySelector(`label.error[for="${CSS.escape(groupName)}"]`);
                if (errorLabel) errorLabel.remove();
            }
        });

    } else {
         const form = document.getElementById(formId);

        // Get all groups of radio buttons within the form
        const radioGroups = {};
        const radios = form.querySelectorAll('input[type="radio"]');

        radios.forEach(radio => {
            const name = radio.name;
            if (!radioGroups[name]) {
            radioGroups[name] = [];
            }
            radioGroups[name].push(radio);
        });


        // Check if each group has one checked radio
        Object.keys(radioGroups).forEach(groupName => {
            const group = radioGroups[groupName];
            const isGroupChecked = group.some(radio => radio.checked);

            group.forEach(radio => {
            const label = form.querySelector(`label[for="${radio.id}"]`);
            if (label) {
                label.classList.toggle('isRadioError', !isGroupChecked);
            }
            });

            if (!isGroupChecked) {
            isValid = false;
            }
        });
    }

}

var alreadySavedCodebtor = function (thisObj) {
    var selectedOption      = $(thisObj).find('option:selected');

    var codebtor_name       = selectedOption.data('cname');
    var codebtor_address    = selectedOption.data('address');
    var codebtor_city       = selectedOption.data('city');
    var codebtor_state      = selectedOption.data('state');
    var codebtor_zip        = selectedOption.data('zip');

    var container           = $(thisObj).closest('.codebtor-tab');

    container.find('.cod_name').val(codebtor_name);
    container.find('.cod_address').val(codebtor_address);
    container.find('.cod_city').val(codebtor_city);
    container.find('.cod_state').val(codebtor_state);
    container.find('.cod_zip').val(codebtor_zip);
};


makeCodetorSelected = function(thisObj){
    var selectedOption = $(thisObj).find('option:selected');
    var codebtor_name = selectedOption.data('cname');
    var codebtor_address = selectedOption.data('address');
    var codebtor_city = selectedOption.data('city');
    var codebtor_state = selectedOption.data('state');
    var codebtor_zip = selectedOption.data('zip');
   
    $(thisObj).parent('div').parent('div').parent('div').find('.cod_name').val(codebtor_name);
    $(thisObj).parent('div').parent('div').parent('div').find('.cod_address').val(codebtor_address);
    $(thisObj).parent('div').parent('div').parent('div').find('.cod_city').val(codebtor_city);
    $(thisObj).parent('div').parent('div').parent('div').find('.cod_state').val(codebtor_state);
    $(thisObj).parent('div').parent('div').parent('div').find('.cod_zip').val(codebtor_zip);
}

async function removeBackTaxDebt(url, thisobj) {
 const canEdit = await is_editable('can_edit_debts');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }
    var cloneLength = $(document).find(".tax_debt_form").length;
    if (cloneLength <= 1) {
        $.systemMessage(
            "You cannot delete because at least 1 entry is required.",
            "alert--danger"
        );
        return false;
    } else {
        var saveId = $(thisobj).attr("data-saveid");
       // var confirmation = confirm("Do you want to remove this creditor?");
        showConfirmation("Do you want to remove this creditor?", function(confirmation) {
        if (confirmation) {
            $(".back-taxes-tax-owed")
                .find(".back_tax_data_" + saveId)
                .parent()
                .remove();
            $(".back-taxes-tax-owed")
                .find(".back_tax_summary_" + saveId)
                .parent()
                .remove();

            $(".back-taxes-tax-owed .tax_debt_form").each(function (index) {
                var updatedRowClass = index + 1;
                $(this)
                    .children(".common_creditor_summary")
                    .removeClass(function (index, className) {
                        return (
                            className.match(/\bback_tax_summary_\S+/g) || []
                        ).join(" ");
                    })
                    .addClass("back_tax_summary_" + index);
                $(this)
                    .find(".debt_no")
                    .text(updatedRowClass + ".");
                $(this).find(".remove-button").attr("data-saveid", index);
            });
            saveBackTaxDebt();
        }
    });
    }
}

 function is_editable(section, callback = (result) => {}) {
    return new Promise((resolve) => {
        const formData = new FormData();
        formData.append('section', section);
        
        $.ajax({
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            url: CHECK_PERMISSION_URL,
            contentType: false,
            data: formData,
            processData: false,
            type: 'POST',
            success: function(data) {    
                // Default to true if status is missing/undefined
                const isEditable = data.status !== false; 
                
                if (data.status === false) {
                    $.systemMessage(data.msg || "Editing not allowed", "alert--danger");
                }
                
                callback(isEditable);
                resolve(isEditable);
            },
            error: function() {
                // Default to true on error
                callback(true);
                resolve(true);
            }
        });
    });
}

// Usage:


function displayEmployerEditDiv(index, formId) {
    var hasError = false;
    $(".employer_edit_form").each(function (index) {
        if(!$(this).hasClass('hide-data')){
            hasError = revalidateFormWithMonthYear(formId,true);
            if(hasError){
                return false;
            }
        }
    });
    if(!hasError){
        $(".employer_summary_" + index).addClass("hide-data");
        $(".employer_data_" + index).removeClass("hide-data");
        $("html, body").animate({
            scrollTop: $(".employer_data_" + index).offset().top
        }, 100);
    }
}

function saveCurrentEmployer(displaymsg = true, thisobj={}, newdiv=false, formId='') {
    hasError = revalidateFormWithMonthYear(formId,displaymsg);
    if(!hasError && !newdiv){
        let cln = $('.employer-current-employer');

        if (!$.isEmptyObject(thisobj)) {
            cln = $(thisobj).parent('div').parent('div').parent("div").parent("div").parent('div');
        }

        var employer_form = cln.find(".employer_form");
        $(employer_form).each(function () {
            if($(this).find(".employer_summary").hasClass('hide-data')){
                $(this).find(".employer_summary").removeClass('hide-data');
                $(this).find(".insider_data").addClass('hide-data');
            }
        });
    }
    return !hasError;
}
async function removeCurrentEmployer( thisobj, empId='', formId = '' ) {
     const canEdit = await is_editable('can_edit_income');
        if (!canEdit) {
        return false; // Stops execution if no permission
    }
    var cloneLength = $(document).find("#"+formId+" .employer_form").length;
    if (cloneLength <= 1) {
        $.systemMessage(
            "You cannot delete because at least 1 entry is required.",
            "alert--danger"
        );
        return false;
    } else {
        var saveId = $(thisobj).attr("data-saveid");
        showConfirmation("Do you want to remove this employer?", function(confirmation) {
        if (confirmation) {
            $("#"+formId+" .employer-current-employer")
                .find(".employer_data_" + saveId)
                .parent()
                .remove();
            $("#"+formId+" .employer-current-employer")
                .find(".employer_summary_" + saveId)
                .parent()
                .remove();

            $("#"+formId+" .employer-current-employer .employer_form").each(function (index) {
                $(this)
                    .children(".employer_summary")
                    .removeClass(function (index, className) {
                        return (
                            className.match(/\bemployer_summary_\S+/g) || []
                        ).join(" ");
                    })
                    .addClass("employer_summary_" + index);
                $(this).find(".remove-button").attr("data-saveid", index);
            });
            
            if(empId){
                deleteCurrentEmployerById(formId, empId);
            }

        }
    });
    }
}

function deleteCurrentEmployerById(formId,empId) {

    var formElement = document.getElementById(formId);
    var formData = new FormData(formElement);
    
    formData.append('empIdToDelete', empId);

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
        success: function ( data ) {                
            if(data.status==1){
                $("#"+data.display_id).html(data.html);                        
                $.systemMessage(data.msg,"alert--success");
            }else{
                $.systemMessage(data.msg, "alert--danger");
                return false;
            }
        }
    }); 
}

function getCurrentEmployerLabel(employerLength){
    var sectionTitle = 'Primary Employer:';
    switch (employerLength) {
        case 0: sectionTitle = 'Primary Employer:'; break;
        case 1: sectionTitle = 'Second Employer:'; break;
        case 2: sectionTitle = 'Third Employer:'; break;
        case 3: sectionTitle = 'Fourth Employer:'; break;  
    }
    return sectionTitle;
}

function addMoreCurrentEmployer(formId) {

    var saveData = saveCurrentEmployer(false,{},false,formId);
    if (saveData == false) {
        return false;
    }
    var employerLength = $(`#${formId} .employer_form`).length;
    if (employerLength > 3) {
        $.systemMessage(
            "You can add only 4 employers.",
            "alert--danger"
        );
    } else {
        var divLast = $(document).find(`#${formId} .employer_form`).last();
        var oldIndex = $(divLast).index();

        var divClone = $(divLast).clone();
        var newIndex = oldIndex + 1 ;

        var employer_summary = divClone.find(".employer_summary");
        var insider_data = divClone.find(".insider_data");
        var save_btn_botton = divClone.find(".save-btn-bottom");
        var delete_btn_bottom = divClone.find(".delete-btn-bottom");

        var has_notes_radio = divClone.find('.has_notes_radio');

        var sectionTitle = getCurrentEmployerLabel(employerLength);
        divClone.find('label.section-title').html(sectionTitle);

        let divclass = "debt_creditor";
        divClone.removeClass(function (index, className) {
            return (className.match(divclass + "_\\d+", "g") || []).join(' ');
        }).addClass(divclass + "_" + newIndex);
        divClone.find(".delete-div").attr("data-saveid", newIndex);
        divClone.find(".client-edit-button").attr("data-saveid", newIndex).attr('onclick',"displayEmployerEditDiv("+newIndex+", '"+formId+"');");
        divClone.find(".circle-number-div").html(newIndex + 1);
        divClone.find("label").removeClass("active");
        divClone.find(".insider_data .twice-month-selection").addClass("hide-data");

        // inputs
        divClone.find('.insider_data .employer_id').attr( 'name', `current_employer[${newIndex}][id]`).val('');
        divClone.find('.insider_data .occupation').attr( 'name', `current_employer[${newIndex}][employer_occupation]`).val('');
        divClone.find('.insider_data .name').attr( 'name', `current_employer[${newIndex}][employer_name]`).val('');
        divClone.find('.insider_data .address_line_1').attr( 'name', `current_employer[${newIndex}][employer_address]`).val('');
        divClone.find('.insider_data .city').attr( 'name', `current_employer[${newIndex}][employer_city]`).val('');
        divClone.find('.insider_data .state').attr( 'name', `current_employer[${newIndex}][employer_state]`).prop("checked", false);
        divClone.find('.insider_data .zip').attr( 'name', `current_employer[${newIndex}][employer_zip]`).val('');

        divClone.find('.insider_data .employment_period_year').attr( 'onchange', `updateEmpPeriod(${newIndex},"${formId}")` );
        divClone.find('.insider_data .employment_period_month').attr( 'onchange', `updateEmpPeriod(${newIndex},"${formId}")` );

        divClone.find('.insider_data .paystub_paydate_start').attr( 'name', `current_employer[${newIndex}][start_date]`).attr( 'data-key', `${newIndex}`).val('');
        divClone.find('.insider_data .job_period').attr( 'name', `current_employer[${newIndex}][employment_duration]`).val('');
        divClone.find('.insider_data .often_get_paid').attr( 'name', `current_employer[${newIndex}][frequency]`).attr( 'onchange', `payFrequencyChanged(this, ${newIndex},"${formId}")` ).val('');
        divClone.find('.insider_data .paystub_paydate_recent').attr( 'name', `current_employer[${newIndex}][end_date]`).val('');
        divClone.find('.insider_data .notes').attr( 'name', `current_employer[${newIndex}][notes]`).val('');

        var twice_month_selection_radio = divClone.find('.insider_data .twice_month_selection_radio');
        $(twice_month_selection_radio).each(function () {
            $(this).attr( 'name', `current_employer[${newIndex}][twice_month_selection]`).prop("checked", false);
            if ($(this).val() == "0") {
                $(this).attr("id", "twice_month_selection_yes_" + newIndex);
                $(this).next("label").removeClass('active').attr('onclick', `toggleMonthSelection('0', ${newIndex}, '${formId}' );`).attr('for', "twice_month_selection_yes_" + newIndex);
            }
            if ($(this).val() == "1") {
                $(this).attr("id", "twice_month_selection_no_" + newIndex);
                $(this).next("label").removeClass('active').attr('onclick', `toggleMonthSelection('1', ${newIndex}, '${formId}' );`).attr('for', "twice_month_selection_no_" + newIndex);
            }
            $(this).attr("checked", false);
        });

     
        $(employer_summary).addClass("hide-data");
        $(insider_data).removeClass("hide-data");
        $(save_btn_botton).addClass("employer-save-button");

        $(employer_summary).each(function () {
            $(this).removeClass("employer_summary_" + oldIndex).addClass("employer_summary_" + newIndex);
        });
        $(insider_data).each(function () {
            $(this).removeClass("employer_data_" + oldIndex).addClass("employer_data_" + newIndex);
        });

        $(save_btn_botton).each(function () {
            $(this).attr("data-saveid", newIndex);
            $(this).attr( "onclick", "saveCurrentEmployer(true,this,true,'"+formId+"')" );
        });
        $(delete_btn_bottom).each(function () {
            $(this).attr("data-saveid", newIndex);
            $(this).attr("onclick", "removeCurrentEmployer(this,'','"+formId+"')");
        });
 
        divClone.find('.insider_data .has_notes').removeClass("has_notes_" + oldIndex).addClass("hide-data has_notes_" + newIndex);
        $(has_notes_radio).each(function () {
            $(this).attr( 'name', `current_employer[${newIndex}][has_notes]`).prop("checked", false);;
            if ($(this).val() == "0") {
                $(this).attr("id", "current_employer_no_" + newIndex);
                $(this).next("label").attr('onclick', `toggleHasNotes('no', ${newIndex}, '${formId}' );`).attr('for', "current_employer_no_" + newIndex);
            }
            if ($(this).val() == "1") {
                $(this).attr("id", "current_employer_yes_" + newIndex);
                $(this).next("label").attr('onclick', `toggleHasNotes('yes', ${newIndex}, '${formId}' );`).attr('for', "current_employer_yes_" + newIndex);
            }
            $(this).attr("checked", false);
        });

        $(divClone).find('input[type="text"]').val("");
        $(divClone).find('input[type="number"]').val("");

        // $(divClone).attr("data-index", newIndex);

        $(divLast).after(divClone);

    }

}

function submitIncomeDebtorStep( FormIdA, FormIdB ){
    hasError = revalidateFormWithMonthYear(FormIdA,false);
    if(hasError){
        return;
    }
    $(`#${FormIdB}`).submit();
}


async function removeDSODebt(url, thisobj) {
     const canEdit = await is_editable('can_edit_debts');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }
    var cloneLength = $(document).find(".domestic_form").length;
    if (cloneLength <= 1) {
        $.systemMessage(
            "You cannot delete because at least 1 entry is required.",
            "alert--danger"
        );
        return false;
    } else {
        var saveId = $(thisobj).attr("data-saveid");
        //var confirmation = confirm("Do you want to remove this creditor?");
        showConfirmation("Do you want to remove this creditor?", function(confirmation) {
        if (confirmation) {
            $(".second_step_domestic_debts")
                .find(".dso_data_" + saveId)
                .remove();
            $(".second_step_domestic_debts")
                .find(".dso_summary_" + saveId)
                .remove();

            $(".second_step_domestic_debts .tax_debt_form").each(function (
                index
            ) {
                var updatedRowClass = index + 1;
                $(this)
                    .removeClass("dso_summary_" + (index + 2))
                    .addClass("dso_summary_" + updatedRowClass);
                $(this)
                    .find(".debt_no")
                    .text(updatedRowClass + ".");
                var removeButton = $(this).find(".remove-button");
                removeButton.attr(
                    "onclick",
                    "removeBackTaxDebt(" + updatedRowClass + ")"
                );
            });
            saveDSODebt();
        }
    });
    }
}

async function addPaymentPastOneYearForm() {
    var clnln = $(document).find(".payment_past_one_year").length;

    const status = await seperate_save('past_one_year_data','payment_past_one_year', 'payment-past-one-year-data', 'parent_payment_past_one_year', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".payment_past_one_year").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "payment_past_one_year";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('past_one_year_data','payment_past_one_year', 'payment-past-one-year-data', 'parent_payment_past_one_year', " + index_val + ")");

            var creditor_address_past_one_year = cln.find(
                ".creditor_address_past_one_year"
            );
            var creditor_street_past_one_year = cln.find(
                ".creditor_street_past_one_year"
            );
            var creditor_city_past_one_year = cln.find(
                ".creditor_city_past_one_year"
            );
            var creditor_state_past_one_year = cln.find(
                ".creditor_state_past_one_year"
            );
            var creditor_zip_past_one_year = cln.find(
                ".creditor_zip_past_one_year"
            );
            var past_one_year_payment_dates = cln.find(
                ".past_one_year_payment_dates"
            );
            var past_one_year_payment_dates2 = cln.find(
                ".past_one_year_payment_dates2"
            );
            var past_one_year_payment_dates3 = cln.find(
                ".past_one_year_payment_dates3"
            );
            var past_one_year_total_amount_paid = cln.find(
                ".past_one_year_total_amount_paid"
            );
            var past_one_year_amount_still_owed = cln.find(
                ".past_one_year_amount_still_owed"
            );
            var past_one_year_payment_reason = cln.find(
                ".past_one_year_payment_reason"
            );

            //work only update case
            // cln.find('.property_vehicle_ids').remove();
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(creditor_address_past_one_year).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[creditor_address_past_one_year][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_street_past_one_year).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[creditor_street_past_one_year][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_city_past_one_year).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[creditor_city_past_one_year][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_state_past_one_year).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[creditor_state_past_one_year][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_zip_past_one_year).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[creditor_zip_past_one_year][" +
                        index_val +
                        "]"
                );
            });
            $(past_one_year_payment_dates).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[past_one_year_payment_dates][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(past_one_year_payment_dates2).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[past_one_year_payment_dates2][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(past_one_year_payment_dates3).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[past_one_year_payment_dates3][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(past_one_year_total_amount_paid).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[past_one_year_total_amount_paid][" +
                        index_val +
                        "]"
                );
            });
            $(past_one_year_amount_still_owed).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[past_one_year_amount_still_owed][" +
                        index_val +
                        "]"
                );
            });
            $(past_one_year_payment_reason).each(function () {
                $(this).attr(
                    "name",
                    "past_one_year_data[past_one_year_payment_reason][" +
                        index_val +
                        "]"
                );
            });
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addTransfersPropertyForm() {
    var clnln = $(document).find(".transfers_property").length;
    const status = await seperate_save('transfers_property','transfers_property', 'transfers-property-data', 'parent_transfers_property', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".transfers_property").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "transfers_property";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);

            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('transfers_property','transfers_property', 'transfers-property-data', 'parent_transfers_property', " + index_val + ")");

            var creditor_address_transfers_property = cln.find(
                ".creditor_address_transfers_property"
            );
            var creditor_street_transfers_property = cln.find(
                ".creditor_street_transfers_property"
            );
            var creditor_city_transfers_property = cln.find(
                ".creditor_city_transfers_property"
            );
            var creditor_state_transfers_property = cln.find(
                ".creditor_state_transfers_property"
            );
            var creditor_zip_transfers_property = cln.find(
                ".creditor_zip_transfers_property"
            );
            var payment_dates_transfers_property = cln.find(
                ".payment_dates_transfers_property"
            );
            var payment_dates_transfers_property2 = cln.find(
                ".payment_dates_transfers_property2"
            );
            var payment_dates_transfers_property3 = cln.find(
                ".payment_dates_transfers_property3"
            );
            var total_amount_paid_transfers_property = cln.find(
                ".total_amount_paid_transfers_property"
            );
            var amount_still_owed_transfers_property = cln.find(
                ".amount_still_owed_transfers_property"
            );
            var payment_reason_transfers_property = cln.find(
                ".payment_reason_transfers_property"
            );

            //work only update case
            // cln.find('.property_vehicle_ids').remove();
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(creditor_address_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[creditor_address_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_street_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[creditor_street_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_city_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[creditor_city_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_state_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[creditor_state_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(creditor_zip_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[creditor_zip_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(payment_dates_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[payment_dates_transfers_property][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(payment_dates_transfers_property2).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[payment_dates_transfers_property2][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(payment_dates_transfers_property3).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[payment_dates_transfers_property3][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(total_amount_paid_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[total_amount_paid_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(amount_still_owed_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[amount_still_owed_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(payment_reason_transfers_property).each(function () {
                $(this).attr(
                    "name",
                    "transfers_property_data[payment_reason_transfers_property][" +
                        index_val +
                        "]"
                );
            });
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addListLawsuitsForm() {
    var clnln = $(document).find(".list_lawsuits").length;
    const status = await seperate_save('list_lawsuits','list_lawsuits', 'list-lawsuits-data', 'parent_list_lawsuits', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 7) {
            alert("You can add only 8 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_lawsuits").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").end();

            let divclass = "list_lawsuits";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_lawsuits','list_lawsuits', 'list-lawsuits-data', 'parent_list_lawsuits', " + index_val + ")");

            cln.find("label").removeClass("active");
            var deb_codeb_name = cln.find(".form-check-input");
            var case_title = cln.find(".case_title");
            var case_number = cln.find(".case_number");
            var case_nature = cln.find(".case_nature");
            var agency_location = cln.find(".agency_location");
            var agency_street = cln.find(".agency_street");
            var agency_city = cln.find(".agency_city");
            var agency_state = cln.find(".agency_state");
            var agency_zip = cln.find(".agency_zip");
            var disposition = cln.find(".disposition");
            var related_to = cln.find(".related_to");
            $(deb_codeb_name).each(function () {
                if ($(this).hasClass('debtor')) {
                    let newId = 'add_debtor_' + index_val;
                    $(this).attr('id', newId).prop('checked', false);
                    $(this).next('label').attr('for', newId);
                }

                if ($(this).hasClass('codebtor')) {
                    let newId = 'add_codebtor_' + index_val;
                    $(this).attr('id', newId).prop('checked', false);
                    $(this).next('label').attr('for', newId);
                }
            });
            $(related_to).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[related_to][" + index_val + "]"
                );
            });
            $(case_nature).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[case_nature][" + index_val + "]"
                );
            });
            $(case_title).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[case_title][" + index_val + "]"
                );
            });
            $(case_number).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[case_number][" + index_val + "]"
                );
            });
            $(disposition).each(function () {
                $(this).attr("name", "list_lawsuits_data[disposition][" + index_val + "]");
                if ($(this).val() == "1") {
                    $(this).attr( "id", "list-lawsuits_disposition_pending-" + index_val );
                    $(this).next("label") .attr( "for", "list-lawsuits_disposition_pending-" + index_val );
                }
                if ($(this).val() == "2") {
                    $(this).attr( "id", "list-lawsuits_disposition_appeal-" + index_val );
                    $(this).next("label").attr( "for", "list-lawsuits_disposition_appeal-" + index_val );
                }
                if ($(this).val() == "3") {
                    $(this).attr( "id", "list-lawsuits_disposition_concluded-" + index_val );
                    $(this).next("label") .attr( "for", "list-lawsuits_disposition_concluded-" + index_val );
                }
                $(this).prop("checked", false);
            });
            $(agency_location).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[agency_location][" + index_val + "]"
                );
            });
            $(agency_street).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[agency_street][" + index_val + "]"
                );
            });
            $(agency_street).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[agency_street][" + index_val + "]"
                );
            });
            $(agency_city).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[agency_city][" + index_val + "]"
                );
            });
            $(agency_state).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[agency_state][" + index_val + "]"
                );
            });
            $(agency_zip).each(function () {
                $(this).attr(
                    "name",
                    "list_lawsuits_data[agency_zip][" + index_val + "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("input[type=radio]").prop("checked", false);
            $(itm).after(cln);
        }
    }, 500);
}

async function addSetoffsCreditorForm() {
    var clnln = $(document).find(".setoffs_creditor_data").length;
    const status = await seperate_save('setoffs_creditor','setoffs_creditor_data', 'setoffs_creditor-data', 'parent_setoffs_creditor', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".setoffs_creditor_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "setoffs_creditor_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('setoffs_creditor','setoffs_creditor_data', 'setoffs_creditor-data', 'parent_setoffs_creditor', " + index_val + ")");


            var creditors_address = cln.find(".creditors_address");
            var creditor_street = cln.find(".creditor_street");
            var creditor_city = cln.find(".creditor_city");
            var creditor_state = cln.find(".creditor_state");
            var creditor_zip = cln.find(".creditor_zip");
            var creditors_action = cln.find(".creditors_action");
            var date_action = cln.find(".date_action");
            var account_number = cln.find(".account_number");
            var amount_data = cln.find(".amount_data");

            $(creditors_address).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[creditors_address][" + index_val + "]"
                );
            });
            $(creditor_street).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[creditor_street][" + index_val + "]"
                );
            });
            $(creditor_city).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[creditor_city][" + index_val + "]"
                );
            });
            $(creditor_state).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[creditor_state][" + index_val + "]"
                );
            });
            $(creditor_zip).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[creditor_zip][" + index_val + "]"
                );
            });
            $(creditors_action).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[creditors_action][" + index_val + "]"
                );
            });
            $(date_action).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[date_action][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(account_number).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[account_number][" + index_val + "]"
                );
            });

            $(amount_data).each(function () {
                $(this).attr(
                    "name",
                    "setoffs_creditor_data[amount_data][" + index_val + "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addlistAnyGiftsForm() {
    var clnln = $(document).find(".list_any_gifts_data").length;
    const status = await seperate_save('list_any_gifts','list_any_gifts_data', 'list-any-gifts-data', 'parent_list_any_gifts', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_any_gifts_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "list_any_gifts_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_any_gifts','list_any_gifts_data', 'list-any-gifts-data', 'parent_list_any_gifts', " + index_val + ")");
            var recipient_address = cln.find(".recipient_address");
            var creditor_street = cln.find(".creditor_street");
            var creditor_city = cln.find(".creditor_city");
            var creditor_state = cln.find(".creditor_state");
            var creditor_zip = cln.find(".creditor_zip");
            var relationship = cln.find(".relationship");
            var gifts = cln.find(".gifts");
            var gifts_date_from = cln.find(".gifts_date_from");
            var gifts_date_to = cln.find(".gifts_date_to");
            var gifts_value = cln.find(".gifts_value");
            var gifts_value1 = cln.find(".gifts_value1");

            $(recipient_address).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[recipient_address][" + index_val + "]"
                );
            });
            $(creditor_street).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[creditor_street][" + index_val + "]"
                );
            });
            $(creditor_city).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[creditor_city][" + index_val + "]"
                );
            });
            $(creditor_state).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[creditor_state][" + index_val + "]"
                );
            });
            $(creditor_zip).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[creditor_zip][" + index_val + "]"
                );
            });
            $(relationship).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[relationship][" + index_val + "]"
                );
            });
            $(gifts).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[gifts][" + index_val + "]"
                );
            });
            $(gifts_date_from).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[gifts_date_from][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });

            $(gifts_date_to).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[gifts_date_to][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });

            $(gifts_value).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[gifts_value][" + index_val + "]"
                );
            });
            $(gifts_value1).each(function () {
                $(this).attr(
                    "name",
                    "list_any_gifts_data[gifts_value1][" + index_val + "]"
                );
            });

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addGiftsCharityForm() {
    var clnln = $(document).find(".gifts_charity_data").length;
    const status = await seperate_save('gifts_charity','gifts_charity_data', 'gifts-charity-data', 'parent_gifts_charity', clnln, true);
    if(!status){
            return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".gifts_charity_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "gifts_charity_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('gifts_charity','gifts_charity_data', 'gifts-charity-data', 'parent_gifts_charity', " + index_val + ")");
            
            var charity_address = cln.find(".charity_address");
            var charity_street = cln.find(".charity_street");
            var charity_city = cln.find(".charity_city");
            var charity_state = cln.find(".charity_state");
            var charity_zip = cln.find(".charity_zip");
            var charity_contribution = cln.find(".charity_contribution");
            var charity_contribution_date = cln.find(".charity_contribution_date");
            var charity_contribution_date1 = cln.find(
                ".charity_contribution_date1"
            );
            var charity_contribution_value = cln.find(
                ".charity_contribution_value"
            );
            var charity_contribution_value1 = cln.find(
                ".charity_contribution_value1"
            );

            $(charity_address).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_address][" + index_val + "]"
                );
            });
            $(charity_street).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_street][" + index_val + "]"
                );
            });
            $(charity_city).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_city][" + index_val + "]"
                );
            });
            $(charity_state).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_state][" + index_val + "]"
                );
            });
            $(charity_zip).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_zip][" + index_val + "]"
                );
            });
            $(charity_contribution).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_contribution][" + index_val + "]"
                );
            });
            $(charity_contribution_date).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_contribution_date][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(charity_contribution_date1).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_contribution_date1][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(charity_contribution_value).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_contribution_value][" +
                        index_val +
                        "]"
                );
            });
            $(charity_contribution_value1).each(function () {
                $(this).attr(
                    "name",
                    "gifts_charity_data[charity_contribution_value1][" +
                        index_val +
                        "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addLossesFromFireForm() {
    var clnln = $(document).find(".losses_from_fire_data").length;
    const status = await seperate_save('losses_from_fire','losses_from_fire_data', 'losses_from_fire-data', 'parent_losses_from_fire', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            alert("You can add only 5 entries.");
            return false;
        } else {
            var itm = $(document).find(".losses_from_fire_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "losses_from_fire_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('losses_from_fire','losses_from_fire_data', 'losses_from_fire-data', 'parent_losses_from_fire', " + index_val + ")");

            var loss_description = cln.find(".loss_description");
            var transferred_description = cln.find(".transferred_description");
            var loss_date_payment = cln.find(".loss_date_payment");
            var loss_amount_payment = cln.find(".loss_amount_payment");
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            $(loss_description).each(function () {
                $(this).attr(
                    "name",
                    "losses_from_fire_data[loss_description][" + index_val + "]"
                );
            });
            $(transferred_description).each(function () {
                $(this).attr(
                    "name",
                    "losses_from_fire_data[transferred_description][" +
                        index_val +
                        "]"
                );
            });
            $(loss_date_payment).each(function () {
                $(this).attr(
                    "name",
                    "losses_from_fire_data[loss_date_payment][" + index_val + "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(loss_amount_payment).each(function () {
                $(this).attr(
                    "name",
                    "losses_from_fire_data[loss_amount_payment][" + index_val + "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

async function addPropertyTransferredForm() {
    var clnln = $(document).find(".property_transferred_data").length;
    const status = await seperate_save('property_transferred','property_transferred_data', 'property-transferred-data', 'parent_property_transferred', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 3) {
            alert("You can add only 4 entries.");
            return false;
        } else {
            var itm = $(document).find(".property_transferred_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "property_transferred_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('property_transferred','property_transferred_data', 'property-transferred-data', 'parent_property_transferred', " + index_val + ")");

            var person_paid = cln.find(".person_paid");
            var person_paid_street = cln.find(".person_paid_street");
            var person_paid_address_line2 = cln.find(".person_paid_address_line2");
            var person_email_or_website = cln.find(".person_email_or_website");

            var person_paid_city = cln.find(".person_paid_city");
            var person_paid_state = cln.find(".person_paid_state");
            var person_paid_zip = cln.find(".person_paid_zip");
            var person_made_payment = cln.find(".person_made_payment");
            var property_transferred_value = cln.find(
                ".property_transferred_value"
            );
            var property_transferred_date = cln.find(".property_transferred_date");
            var property_transferred_payment = cln.find(
                ".property_transferred_payment"
            );

            $(person_paid).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_paid][" + index_val + "]"
                );
            });
            $(person_paid_street).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_paid_street][" +
                        index_val +
                        "]"
                );
            });
            $(person_email_or_website).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_email_or_website][" +
                        index_val +
                        "]"
                );
            });
            $(person_paid_address_line2).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_paid_address_line2][" +
                        index_val +
                        "]"
                );
            });
            $(person_paid_city).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_paid_city][" + index_val + "]"
                );
            });
            $(person_paid_state).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_paid_state][" +
                        index_val +
                        "]"
                );
            });
            $(person_paid_zip).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_paid_zip][" + index_val + "]"
                );
            });
            $(person_made_payment).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[person_made_payment][" +
                        index_val +
                        "]"
                );
            });
            $(property_transferred_value).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[property_transferred_value][" +
                        index_val +
                        "]"
                );
            });
            $(property_transferred_date).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[property_transferred_date][" +
                        index_val +
                        "]"
                );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });
            $(property_transferred_payment).each(function () {
                $(this).attr(
                    "name",
                    "property_transferred_data[property_transferred_payment][" +
                        index_val +
                        "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

function removeButton(mainclass, removeclass, transaction_pdf_enabled='') {
    var clnln = $(mainclass).length;
    var itm = $(document).find(mainclass).last();
    if (clnln > 1) {
        itm.remove();
    }
    if (clnln == 2) {
        $(removeclass).hide();
    }

    if(mainclass == ".bank_mutisec"){
        if(transaction_pdf_enabled == 1){
            checkBankAccInputs();
        }
    }
}

function removeVenmoButton(mainclass, removeclass) {
    var clnln = $(mainclass).length;
    var itm = $(document).find(mainclass).last();

    if (clnln > 1) {
        itm.remove();
        $(removeclass).show();
    }
    if (clnln == 2) {
        $(removeclass).hide();
    }
}

/** Kamlesh Changes */
async function addListFinancialInstitutionsForm() {
    var clnln = $(document).find(".list_financial_institutions_data").length;
    const status = await seperate_save('list_financial_institutions','list_financial_institutions_data', 'list-financial-institutions-data', 'parent_list_financial_institutions', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 5) {
            alert("You can add only 6 entries.");
            return false;
        } else {
            var itm = $(document).find(".list_financial_institutions_data").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone().find("input").val("").end();

            let divclass = "list_financial_institutions_data";
            cln.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);
            cln.find(".delete-div").attr("onclick", "remove_div_common('"+divclass+"', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_financial_institutions','list_financial_institutions_data', 'list-financial-institutions-data', 'parent_list_financial_institutions', " + index_val + ")");
            var name = cln.find(".name");
            var street_number = cln.find(".street_number");
            var city = cln.find(".city");
            var state = cln.find(".state");
            var zip = cln.find(".zip");
            var date_issued = cln.find(".date_issued");

            $(name).each(function () {
                $(this).attr( "name", "list_financial_institutions_data[name][" + index_val + "]" );
            });
            $(street_number).each(function () {
                $(this).attr( "name", "list_financial_institutions_data[street_number][" + index_val + "]" );
            });
            $(city).each(function () {
                $(this).attr( "name", "list_financial_institutions_data[city][" + index_val + "]" );
            });

            $(state).each(function () {
                $(this).attr( "name", "list_financial_institutions_data[state][" + index_val + "]" );
            });

            $(zip).each(function () {
                $(this).attr( "name", "list_financial_institutions_data[zip][" + index_val + "]" );
            });

            $(date_issued).each(function () {
                $(this).attr( "name", "list_financial_institutions_data[date_issued][" + index_val + "]" );
                $(this).removeClass("hasDatepicker").attr("id", "");
            });

            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 500);
}

profit_loss_type = function(fieldObj, url, additional = '0', existingType = "1") {
    var selectedvalue = fieldObj.value;
    var firstmonth = $("input[name='firstmonth']").val();
    var lastmonth = $("input[name='lastmonth']").val();

    $(".selected-months").removeClass("hide-data");
    $(".selected-months").addClass("d-block");
    if (selectedvalue == "1") {
        $(".profit-loss-same").removeClass("hide-data");
        $(".profit-loss-months").addClass("hide-data");
    }
    if (selectedvalue == "2") {
        $(".profit-loss-same").addClass("hide-data");
        $(".profit-loss-months").removeClass("hide-data");
    }

    if (existingType == 1 && selectedvalue == 2) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }

    if (existingType == 1 && selectedvalue == 1) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }

    if (existingType == 2 && selectedvalue == 1) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }
    console.log("existing_type 1")

    if (selectedvalue == 2) {
        var data = 'for_month=' + firstmonth + "&onchange=1&existing_type=" + existingType + "&additional=" + additional;
    }
    if (selectedvalue == 1) {
        var data = "for_month=0&onchange=1&existing_type=" + existingType + "&additional=" + additional;
    }
    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html);
        }
    });
}


changeMonth = function(fieldObj, url, additional = "0", existingType = '1') {
    var selectedvalue = fieldObj.value;
    //Already same
    var firstmonth = $("input[name='firstmonth']").val();
    var lastmonth = $("input[name='lastmonth']").val();

    if (existingType == 1) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }
    console.log("existing_type 2")
    var data = 'for_month=' + selectedvalue + "&onchange=1&existing_type=2&additional=" + additional;

    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html);
        }
    });

    /*laws.ajax(url, { 'type': selectedvalue }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html);
        }
    });
    */
};

$(document).on("input", ".phone-field", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ""));
    self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
    var first10 = $(this).val().substring(0, 14);
    if (this.value.length > 14) {
        this.value = first10;
    }
});

$(document).on("input", ".eiin", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ""));
    self.val(self.val().replace(/(\d{2})\-?(\d{7})/, "$1-$2"));
    var first10 = $(this).val().substring(0, 10);
    if (this.value.length > 10) {
        this.value = first10;
    }
});

$(document).on("keyup", ".income-price-field", function (evt) {
    var incomesum = 0;
    $(".income").each(function () {
        incomesum += +$(this).val();
    });

    var expensesum = 0;
    $(".expense").each(function () {
        expensesum += +$(this).val();
    });

    $(".total-expense").val(parseFloat(expensesum).toFixed(2));
    $(".total-profit-loss").val(parseFloat(incomesum - expensesum).toFixed(2));
});

$(document).on("blur", ".price-field", function (evt) {
    evt.target.value = parseFloat(evt.target.value).toFixed(2);
});

faceboxclose = function () {
    $.facebox.close();
};

openProfitForm = function(url, existingType = "1", additional= 0) {
    var firstmonth = $("input[name='firstmonth']").val();
    var lastmonth = $("input[name='lastmonth']").val();
    if (existingType == 1) {
        firstmonth = 0;
    }

    var data = 'for_month=' + firstmonth + "&onchange=0&existing_type=2&additional=" + additional;

    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html, "profitlosspopup-div questions_popup_div");
        }
    });

    //laws.updateFaceboxContent('<form name="proftloss_form" action="" method="post">'+$(".profitpopup").html()+'</form>', 'faceboxWidth profitlosspopup');
    //$("#profit_type_selection").trigger("change");
};

openDetailedTabItemsForm = function(url, type = '', attorneyEdit=false) {
    var previous_data = $('.detailed_tab_items_'+type).val();
    
    laws.ajax(url, { type: type, previous_data: previous_data }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            if(attorneyEdit){
                $("#secondaryModalBs .modal-content").html(res.html);
                $("#secondaryModalBs").modal("show"); 
            } else {
                laws.updateFaceboxContent(res.html);
                $('.check_empty_'+type).removeClass('hide-data');
                initializeSelectedItems(previous_data);
            }
        }
    });
};

verifyHasBussiness = function(url, additional= '0') {
    var bsName = $("input[name='income_profit_loss[name_of_business]']").val();
    if(bsName == ""){
        $.systemMessage("Name of Business can't be empty.", "alert--danger", true);
        $("input[name='income_profit_loss[name_of_business]']").focus();
        return false; 
    }
    saveProfitLoss( url, additional );
}

saveProfitLoss = function(url, additional= '0') {
    var frm = document.proftloss_form;
    data = laws.frmData(frm);
    data = data + "&additional=" + additional;

    laws.ajax(url, data, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger");
        } else {
            $.systemMessage(res.msg, "alert--success");

            var losstype = parseInt(res.profit_loss_type);
            var nextmonth = res.profit_loss_month;

            if (losstype == 1) {
                $.facebox.close();
                window.location.href = window.location.href;
            }
            if (res.profit_loss_month == "") {
                $.facebox.close();
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, 3500);
            }

            if (parseInt(res.profit_loss_type) == 2 && nextmonth != "") {
                requestnext(nextmonth, losstype, res.formurl, additional);
            }
        }
    });
};

requestnext = function(nextmonth, losstype, url, additional= '0') {
    var lastmonth = $("input[name='lastmonth']").val();
    var data = 'for_month=' + nextmonth + "&onchange=1&existing_type=" + losstype;
    data = data + "&additional=" + additional;
    console.log("existing_type 4")

    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html, "profitlosspopup-div");
            if (nextmonth == lastmonth) {
                $("#sbmt-btn").text("Save");
            }
        }
    });
};

openProfitForm_joint = function (url) {
    var firstmonth = $("input[name='firstmonth_joint']").val();
    var lastmonth = $("input[name='lastmonth_joint']").val();
    var existingType = $("input[name='existingType_joint']").val();
    if (existingType == 1) {
        firstmonth = 0;
    }
    var data =
        "for_month=" + firstmonth + "&onchange=0&existing_type=" + existingType;

    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html, "profitlosspopup-div");
        }
    });

    //laws.updateFaceboxContent('<form name="proftloss_form" action="" method="post">'+$(".profitpopup").html()+'</form>', 'faceboxWidth profitlosspopup');
    //$("#profit_type_selection").trigger("change");
};

saveProfitLoss_joint = function (url) {
    var frm = document.proftloss_form;
    data = laws.frmData(frm);
    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        } else {
            $.systemMessage(res.msg, "alert--success", true);

            var losstype = parseInt(res.profit_loss_type);
            var nextmonth = res.profit_loss_month;

            if (losstype == 1) {
                $.facebox.close();
                window.location.href = window.location.href;
            }
            if (res.profit_loss_month == "") {
                $.facebox.close();
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, 3500);
            }
            if (parseInt(res.profit_loss_type) == 2 && nextmonth != "") {
                requestnext_joint(nextmonth, losstype, res.formurl);
            }
        }
    });
};

requestnext_joint = function (nextmonth, losstype, url) {
    var lastmonth = $("input[name='lastmonth_joint']").val();
    var data =
        "for_month=" + nextmonth + "&onchange=1&existing_type=" + losstype;

    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html, "profitlosspopup-div");
            if (nextmonth == lastmonth) {
                $("#sbmt-btn").text("Save");
            }
        }
    });
};

profit_loss_type_joint = function (fieldObj, url) {
    var selectedvalue = fieldObj.value;
    var firstmonth = $("input[name='firstmonth_joint']").val();
    var lastmonth = $("input[name='lastmonth_joint']").val();
    var existingType = $("input[name='existingType_joint']").val();
    $(".selected-months").removeClass("hide-data");
    $(".selected-months").addClass("d-block");
    if (selectedvalue == "1") {
        $(".profit-loss-same").removeClass("hide-data");
        $(".profit-loss-months").addClass("hide-data");
    }
    if (selectedvalue == "2") {
        $(".profit-loss-same").addClass("hide-data");
        $(".profit-loss-months").removeClass("hide-data");
    }

    if (existingType == 1 && selectedvalue == 2) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }

    if (existingType == 1 && selectedvalue == 1) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }

    if (existingType == 2 && selectedvalue == 1) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }

    if (selectedvalue == 2) {
        var data =
            "for_month=" +
            firstmonth +
            "&onchange=1&existing_type=" +
            existingType;
    }
    if (selectedvalue == 1) {
        var data = "for_month=0&onchange=1&existing_type=" + existingType;
    }
    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html, "profitlosspopup-div");
        }
    });
};

changeMonth_joint = function (fieldObj, url) {
    var selectedvalue = fieldObj.value;
    //Already same
    var firstmonth = $("input[name='firstmonth_joint']").val();
    var lastmonth = $("input[name='lastmonth_joint']").val();
    var existingType = $("input[name='existingType_joint']").val();
    if (existingType == 1) {
        $("input[type=text].income").attr("value", "");
        $("input[type=text].expense").attr("value", "");
        $("input[type=text].total-expense").attr("value", "");
        $("input[type=text].total-profit-loss").attr("value", "");
        $("input[type=text].other_expenses").attr("value", "");
    }

    var data =
        "for_month=" +
        selectedvalue +
        "&onchange=1&existing_type=" +
        existingType;

    laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, "alert--danger", true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html, "profitlosspopup-div");
        }
    });

    /*laws.ajax(url, { 'type': selectedvalue }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        }
        if (res.success == true) {
            laws.updateFaceboxContent(res.html);
        }
    });
    */
};

function checkPaymentType(fieldobject) {
    var parentDiv = $(fieldobject).closest(".form-group");
    var priceItemDiv = parentDiv.closest(".col-md-4").nextAll(".installmentpayments_price_item").first();

    if ($(fieldobject).val() == 7) {
        priceItemDiv.removeClass("hide-data");
    } else {
        priceItemDiv.addClass("hide-data");
    }
}

function checkYear(str, max) {
    if (str.charAt(0) !== "0" || str == "00") {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = CurrentYear;
        str =
            num > parseInt(max.toString().charAt(0)) &&
            num.toString().length == CurrentYear
                ? "0" + num
                : num.toString();
    }
    return str;
}

function checkValue(str, max) {
    if (str.charAt(0) !== "0" || str == "00") {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = 1;
        str =
            num > parseInt(max.toString().charAt(0)) &&
            num.toString().length == 1
                ? "0" + num
                : num.toString();
    }
    return str;
}

$(document).on("input", ".max-today-date", function (e) {
    this.type = "text";
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split("/").map(function (v) {
        return v.replace(/\D/g, "");
    });
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1]) values[1] = checkValue(values[1], 31);
    if (values[2]) values[2] = checkYear(values[2], parseInt(CurrentYear));
    if (
        values[2] == CurrentYear &&
        values[0] == CurrentMonth &&
        values[1] > CurrentDay
    ) {
        values[1] = CurrentDay.toString();
    }
    if (values[2] == CurrentYear && values[0] > CurrentMonth) {
        values[1] = CurrentDay.toString();
        values[0] = CurrentMonth.toString();
    }
    var output = values.map(function (v, i) {
        return v.length == 2 && i < 2 ? v + "/" : v;
    });
    this.value = output.join("").substr(0, 10);
});

$(document).on("blur", ".max-today-date", function (e) {
    this.type = "text";
    var input = this.value;
    var values = input.split("/").map(function (v, i) {
        return v.replace(/\D/g, "");
    });
    var output = "";

    if (values.length == 3) {
        var year =
            values[2].length !== 4
                ? parseInt(values[2]) + 2000
                : parseInt(values[2]);
        year = year > CurrentYear ? CurrentYear : year;
        var month = parseInt(values[0]) - 1;
        var day = parseInt(values[1]);
        var d = new Date(year, month, day);
        if (!isNaN(d)) {
            var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
            output = dates
                .map(function (v) {
                    v = v.toString();
                    return v.length == 1 ? "0" + v : v;
                })
                .join("/");
        }
    }
    this.value = output;
});

$(document).on("input", ".date_filed", function (e) {
    this.type = "text";
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split("/").map(function (v) {
        return v.replace(/\D/g, "");
    });
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1]) values[1] = checkValue(values[1], 31);
    var output = values.map(function (v, i) {
        return v.length == 2 && i < 2 ? v + "/" : v;
    });
    this.value = output.join("").substr(0, 10);
});

$(document).on("blur", ".date_filed", function (e) {
    this.type = "text";
    var input = this.value;
    var values = input.split("/").map(function (v, i) {
        return v.replace(/\D/g, "");
    });
    var output = "";

    if (values.length == 3) {
        var year =
            values[2].length !== 4
                ? parseInt(values[2]) + 2000
                : parseInt(values[2]);
        var month = parseInt(values[0]) - 1;
        var day = parseInt(values[1]);
        var d = new Date(year, month, day);
        if (!isNaN(d)) {
            var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
            output = dates
                .map(function (v) {
                    v = v.toString();
                    return v.length == 1 ? "0" + v : v;
                })
                .join("/");
        }
    }
    this.value = output;
});

$(".allow_numeric").on("input", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (evt.which < 48 || evt.which > 57) {
        evt.preventDefault();
    }
});


$(document).on("input", ".is_ssn", function (evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ""));
    self.val(self.val().replace(/(\d{3})\-?(\d{2})\-?(\d{4})/, "$1-$2-$3"));
    var first10 = $(this).val().substring(0, 11);
    if (this.value.length > 11) {
        this.value = first10;
    }
});

//       /^\d{0,7}(,\d{3})*(\.\d{1,2})?$/

// $(document).on("input", ".price_check", function(evt) {
//     var self = $(this);
//     self.val(self.val().replace(/^\d+(,\d{3})*(\.\d{1,2})?$/,$(this)))
// });

$(document).on("wheel", "input[type=number]", function (e) {
    $(this).blur();
});
$(document).on("keydown", ".price-field", function (event) {
    if (event.keyCode === 38 || event.keyCode === 40) {
        event.preventDefault();
    }
});

$(document).on("keyup", ".price-field", function (e) {
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

    if (e.target.value < 0) {
        e.target.value = "";
        return;
    }
    var count = 2;
    if (e.target.value.indexOf(".") == -1 && e.keyCode != 8) {
        if (e.target.value.length >= 7) {
            e.target.value = parseFloat(e.target.value).toFixed(count);
        }
        return;
    }

    if (
        e.target.value.length - e.target.value.indexOf(".") > count &&
        e.keyCode != 8
    ) {
        if (e.target.value.length >= 7) {
            var firstseven = e.target.value.substring(0, 10);
            e.target.value = parseFloat(firstseven).toFixed(count);
        } else {
            e.target.value = parseFloat(e.target.value).toFixed(count);
        }
    }
});

$(".price-field").each(function () {
    var count = 2;
    var convertedValue = parseFloat($(this).val()).toFixed(count);
    $(this).val(convertedValue); // 555.00
});

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

    if (e.target.value < 0) {
        e.target.value = "";
        return;
    }

    var cursorPosition = this.selectionStart; // Save cursor position
    var oldLength = e.target.value.length;

    var count = 2;
    if (e.target.value.indexOf(".") == -1 && e.keyCode != 8) {
        if (e.target.value.length >= 7) {
            e.target.value = numberFormatField(e.target.value);
        }
        return;
    }

    if (
        e.target.value.length - e.target.value.indexOf(".") > count &&
        e.keyCode != 8
    ) {
        if (e.target.value.length >= 7) {
            var firstseven = e.target.value.substring(0, 10);
            e.target.value = numberFormatField(firstseven);
        } else {
            e.target.value = numberFormatField(e.target.value);
        }
    }

    var newLength = e.target.value.length;
    cursorPosition += newLength - oldLength;
    this.setSelectionRange(cursorPosition, cursorPosition);
});

function numberFormatField(number) {
    number = number.replace(/[^0-9.]/g, ""); // Remove all characters except digits and periods

    // Split the number on the decimal point to handle integers and decimals separately
    var parts = number.split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Format the integer part with commas
    return parts.join(".");
}

$(document).on("blur", ".mileage_field", function (evt) {
    evt.target.value = numberFormatField(evt.target.value);
});

$(".mileage_field").each(function () {
    let formattedNumber = numberFormatField($(this).val());
    $(this).val(formattedNumber); // 555.00
});

$(document).on("input", ".allow-3digit", function (e) {
    var firstThree = this.value.substring(0, 3);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
    if (this.value.length > 3) {
        this.value = firstThree;
    }
});

$(document).on("input", ".allow-5digit", function (e) {
    var firstFive = this.value.substring(0, 5);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
    if (this.value.length > 5) {
        this.value = firstFive;
    }
});

$(document).on("input", ".allow-4digit", function (e) {
    var firstFour = this.value.substring(0, 4);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
    if (this.value.length > 4) {
        this.value = firstFour;
    }
});

$(document).on("input", ".allow-4digit-alpha-numeric", function () {
    var self = $(this);
    // Remove non-alphanumeric characters
    var sanitized = self.val().replace(/[^a-zA-Z0-9]/g, '');
    // Trim to the first 4 characters
    self.val(sanitized.substring(0, 4));
});

function Confirm(title, msg, $true, $false, $link, $newWindow = "_blank") {
    /*change*/
    var $content =
        "<div class='dialog-ovelay'>" +
        "<div class='dialog'><header>" +
        " <h3> " +
        title +
        " </h3> " +
        "<i class='fa fa-close'></i>" +
        "</header>" +
        "<div class='dialog-msg'>" +
        " <p> " +
        msg +
        " </p> " +
        "</div>" +
        "<footer>" +
        "<div class='controls'>" +
        " <button class='button button-danger doAction'>" +
        $true +
        "</button> " +
        " <button class='button button-default cancelAction'>" +
        $false +
        "</button> " +
        "</div>" +
        "</footer>" +
        "</div>" +
        "</div>";
    $("body").prepend($content);
    $(".doAction").click(function () {
        window.open($link, "_parent"); /*new*/
        $(this)
            .parents(".dialog-ovelay")
            .fadeOut(500, function () {
                $(this).remove();
            });
    });
    $(".cancelAction, .fa-close").click(function () {
        $(this)
            .parents(".dialog-ovelay")
            .fadeOut(500, function () {
                $(this).remove();
            });
    });
}
jQuery(document).on("change", ".community_property_state", function () {
    var optionSelected = jQuery("option:selected", this);
    var valueSelected = this.value;
    var mainSection = jQuery(this).parent().parent().parent();
    jQuery(mainSection)
        .find(".domestic_partner_state")
        .val(valueSelected)
        .attr("selected", "selected");
});

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

function checkResidentSelection(url, saveFromAttorney=false) {
    var form_id = "property_step1_modal_save";
    if(!saveFromAttorney){
        form_id = "client_property_step1";
    }

    hasError = revalidateFormWithMonthYear(form_id,true,saveFromAttorney,true);
    if(!hasError && !saveFromAttorney){
        window.location.href = url;
    } 
}

function remove_vehicle_form_div(row_class) {
   
    showConfirmation("Do you want to remove this creditor?", function(confirmation) {
    if (confirmation) {
        $(".additional_liens_div")
            .find(".add_liens_creditor_" + row_class)
            .remove();
        $(".additional_liens_div .row.additional_liens_form").each(function (
            index
        ) {
            var updatedRowClass = index + 1;
            $(this)
                .removeClass("add_liens_creditor_" + (index + 2))
                .addClass("add_liens_creditor_" + updatedRowClass);
            var removeButton = $(this).find(".fas.fa-trash");
            removeButton.attr(
                "onclick",
                "remove_debt_div(" + updatedRowClass + ")"
            );
        });
    }
});
}

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

async function remove_resident_div(row_class, saveFromAttorney=false){
  const canEdit = await is_editable('can_edit_property');
    if (!canEdit) {
        return false; // Stops execution if no permission
    }
    var cloneLength = $(document).find(".residence_property_main_div").length;
    if (cloneLength <= 1) {
        $.systemMessage(
            "You cannot delete because at least 1 entry is required.",
            "alert--danger"
        );
        return false;
    } else {
       
        showConfirmation("Do you want to remove this residence?", function(confirmation) {
        if (confirmation) {
            $("#resident_listing_html").find(".residence_form_" + row_class).remove();
            saveResident(true, {},false,saveFromAttorney);
            
        }
        });
    }
}
function display_resident_div(index,saveFromAttorney=false){
    var hasError = false;
    $(".residence_form").each(function (index) {
        if(!$(this).hasClass('hide-data')){
            var form_id = "property_step1_modal_save";
            if(!saveFromAttorney){
                form_id = "client_property_step1";
            }
            hasError = revalidateFormWithMonthYear(form_id,true,saveFromAttorney);
            if(hasError){
                return false;
            }
        }
    });
    if(!hasError){
        $(".residence_form_" + index).removeClass("hide-data");
        $(".residence_form_" + index).find('.property-detail-div').removeClass('hide-data');
        $(".residence_form_" + index).find('.own-save-div').removeClass('hide-data');
        $(".residence_form_summary_" + index).addClass("hide-data");
    }
}

async function saveResident(displaymsg = false, thisobj = {}, newdiv = false, saveFromAttorney = false) {
    try {
        // Check permissions first
        const canEdit = await is_editable('can_edit_property');
        if (!canEdit) {
            return false;
        }

        // Determine form ID
        const form_id = saveFromAttorney ? "property_step1_modal_save" : "client_property_step1";

        // Validate form
        const hasError = revalidateFormWithMonthYear(form_id, true, saveFromAttorney);
        
        // If no errors and not a new div, update UI
        if (!hasError && !newdiv) {
            const cln = $(thisobj).parents('div').eq(3);  // More efficient than chaining parent()
            const residence_property_main_div = cln.find(".residence_property_main_div");
            
            residence_property_main_div.each(function () {
                const summary = $(this).find(".residence_form_summary");
                const form = $(this).find(".residence_form");
                
                if (summary.hasClass('hide-data')) {
                    summary.removeClass('hide-data');
                    form.addClass('hide-data');
                }
            });

            $(".save-button-section button").prop("disabled", false);
        }
        $('#residence_main_div .bottom-section').removeClass('hide-data');
        return !hasError;
    } catch (error) {
        console.error("Error in saveResident:", error);
        return false;
    }
}

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

function checkEin(thisobj) {
    let parentDiv = $(thisobj).closest(".beinDiv");
    let einInput = parentDiv.find(".eiin");

    einInput.prop("disabled", thisobj.checked);

    if (thisobj.checked) {
        einInput.removeClass("required");
    } else {
        einInput.addClass("required");
    }
}

function checkBizend(thisobj, index) {
    let parentDiv = $(thisobj).closest(".businessEnded");
    let inputText = parentDiv.find(".operation_date2");

    inputText.prop("disabled", thisobj.checked);

    if (thisobj.checked) {
        inputText.removeClass("required");
        $('.business_still_open_data_'+index).removeClass('hide-data');
    } else {
        inputText.addClass("required");
        $('.business_still_open_data_'+index).addClass('hide-data');
    }

}

openFlagPopup = function (divclass, noText = "",includeradio=true, attorneyEdit=false, loadnAjax = false, ajaxurl='') {
    if (divclass == "no-popup") {
        return;
    }
    let extraClass = "";
    if( divclass == "venmo-statement-popup" || divclass == "paypal-statement-popup" || divclass == "cash-statement-popup"  || divclass == "credit-report-popup"){
        extraClass = "video-popup-div";
    }

    if( divclass == "no-profit-loss-popup"){
        extraClass = "no-profit-loss-popup-div";
    }
    if(loadnAjax == true){
        laws.ajax(ajaxurl, { divclass: divclass }, function (response) {
            
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                laws.updateFaceboxContent(res.html, `productQuickView quickinfor ${extraClass}`);  
            }
        });
        
    }
    
    if(loadnAjax == false){
    var htmldiv = $("." + divclass).html();
    if (noText == "") {
        var noText = "I do. I just don't know what to put for this item";
    }

    var html = '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12 pr-0 pl-0"><div class="form_colm red-flag row p-4"><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' +
                htmldiv;

    if(includeradio==true){
        var noFunction = ""
        if(attorneyEdit){
            noFunction = "$('#secondaryModalBs').modal('hide');";
        }else{
            noFunction = "$.facebox.close();"
        }

        html +=  '<div class="d-inline radio-primary"><input type="radio" id="popup_yes" name="popup_yes_no" value="1" class="yes-radio" onclick="'+noFunction+'"> <label for="popup_yes">Yes</label></div><div class="d-inline radio-primary"><input type="radio" id="popup_no" name="popup_yes_no" value="0" class="no-radio" onclick="'+noFunction+'"><label for="popup_no">' +
            noText +
            "</label></div>";
    }

    html +="</div></div></div></div></div></div></div></div></div>";

    if(attorneyEdit){
        $("#secondaryModalBs .modal-content").html(html);
        $("#secondaryModalBs").modal("show"); 
    } else {
        laws.updateFaceboxContent(html, `productQuickView quickinfor ${extraClass}`);
    }
}

};

openFlagPopup2 = function (divclass, noText = "",includeradio=true) {
    var htmldiv = $("." + divclass).html();
    if (noText == "") {
        var noText = "I do. I just don't know what to put for this item";
    }

    var html =
        '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12 pr-0 pl-0"><div class="form_colm red-flag row p-4"><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' +
        htmldiv;
        if(includeradio==true){
            html +=  '<div class="d-inline radio-primary"><input type="radio" id="popup_yes" name="popup_yes_no" value="1" class="yes-radio" onclick="setBusinessValue(2)"> <label for="popup_yes">Yes</label></div><div class="d-inline radio-primary"><input type="radio" id="popup_no" name="popup_yes_no" value="0" class="no-radio" onclick="setBusinessValue(2)"><label for="popup_no">' +
                noText +
                "</label></div>";
        }

        html +="</div></div></div></div></div></div></div></div></div>";
    laws.updateFaceboxContent(html, "productQuickView quickinfor");
};

function showRequiredError(selector, inputClass) {

    input = $(selector).find("." + inputClass);
    
    $(selector).find("." + inputClass).removeClass("border-red");
    var requireFieldError =
        '<div class="validation-error text-danger">**Please select one from above.</div>';
        $(this).removeClass("border-red");
        if (input.is("select")) {
        if (input.find("option:selected").val() == "") {
            input.addClass("border-red");
        } 
    } else if (($(input).is(":radio") || $(input).is(":checkbox")) && $(input).prop('required')) {
        var groupName = $(input).attr("name");
        console.log(groupName);
        $(this).parent().parent().find("div.validation-error").remove();
        if (!$('input[name="' + groupName + '"]').is(":checked")) {
            $(input).parent().parent().append(requireFieldError);
        } else {
            $(input).parent().parent().find("div.validation-error").remove();
        }
    } else if ($(input).hasClass("required") || $(input).prop('required')) {
      let value = $(input).val();
      console.log(input,value);
        if(value.trim() === ''){
            $(input).addClass("border-red");
        }
        if($(input).hasClass("hasDatepicker") && $(input).val().length < 7){
            $(selector).find("div.validation-error").remove();
            var dateError = '<div class="validation-error-date text-danger">Please enter a valid date in the format MM/YYYY.</div>';
            $(input).parent().parent().append(dateError);
        }
    }
}

function checkFieldsForError(formElement, fields) {
    $.each(fields, function (key, field) {
        console.log(field)
        showRequiredError(formElement, field);
    });
}

function recievedAnyIncomeShowHide( status, divclass ) {
    if(status == 0){
        $('.'+divclass).addClass('hide-data');
    }
    if(status == 1){
        $('.'+divclass).removeClass('hide-data');
    }
}

function removePreviousEmployer(mainclass) {
    var clnln = $('.'+mainclass).length;
    var itm = $(document).find('.'+mainclass).last();
    if (clnln > 1) {
        itm.remove();
    }
    if (clnln == 1) {
        $.systemMessage(
            "You cannot remove last employer.",
            "alert--danger"
        );
    }
}

async function addMorePreviousEmployer(divclass) {
    var divLength = $(document).find("."+divclass).length;
    let status = false;

    let parentFormId = '';

    if(divclass == 'previous_employer_div_self') {
        status = await seperate_save('previous_employer_self','previous_employer_div_self', 'data-previous-employer-self', 'parent_previous_employer', divLength, true);
        parentFormId = 'client_income_step1';
    }
    if(divclass == 'previous_employer_div_spouse') {
        status = await seperate_save('previous_employer_spouse','previous_employer_div_spouse', 'data-previous-employer-spouse', 'parent_previous_employer', divLength, true);
        parentFormId = 'client_income_step2';
    }

    
    if(!status){
        return;
    }

    setTimeout(function() {
        if (divLength > 3) {
            alert("You can add only 4 employers.");
            return false;
        } else {
            var divLast = $(document).find("."+divclass).last();
            var index_val = divLength;
            var divClone = $(divLast).clone();

            divClone.removeClass(function (index, className) {
                return (className.match(divclass + "_\\d+", "g") || []).join(' ');
            }).addClass(divclass + "_" + index_val);

            divClone.find(".delete-div").attr("onclick", "seperate_remove_div_common('"+divclass+"', " + index_val + ",  'You cannot remove last employer.')");
            divClone.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            divClone.find(`.edit_section`).removeClass('hide-data');
            if(divclass == 'previous_employer_div_self') {
                divClone.find(`.save-btn`).attr("onclick", "seperate_save('previous_employer_self','previous_employer_div_self', 'data-previous-employer-self', 'parent_previous_employer', " + index_val + ")");
            }
            if(divclass == 'previous_employer_div_spouse') {
                divClone.find(`.save-btn`).attr("onclick", "seperate_save('previous_employer_spouse','previous_employer_div_spouse', 'data-previous-employer-spouse', 'parent_previous_employer', " + index_val + ")");
            }

            divClone.find(".circle-number-div").html(index_val + 1);
            divClone.find(".twice-month-selection").addClass("hide-data");

            var pe_id = divClone.find(".previous_employer_id");
            var pe_name = divClone.find(".previous_employer_name");
            var pe_start_date = divClone.find(".previous_employer_start_date");
            var pe_end_date = divClone.find(".previous_employer_end_date");
            var pe_often_get_paid = divClone.find(".previous_employer_often_get_paid");
            var twice_month_selection_radio = divClone.find('.pe_twice_month_selection_radio');
        
            // Clear values
            divClone.find('input[type="hidden"]').val("");
            divClone.find('input[type="text"]').val("");
            divClone.find('input[type="number"]').val("");
            divClone.find('select').val("");
            divClone.find('input[type="radio"]').prop('checked', false);

            // Update name attributes to reflect new index
            pe_id.attr("name", `previous_employer[${index_val}][id]`);
            pe_name.attr("name", `previous_employer[${index_val}][employer_name]`);
            pe_often_get_paid.attr("name", `previous_employer[${index_val}][frequency]`).attr( 'onchange', `payFrequencyChanged(this, ${index_val},'${parentFormId}')` ).val('');

            pe_start_date
                .removeClass("hasDatepicker")
                .removeClass(`previous_employer_start_date_${index_val - 1}`)
                .addClass(`previous_employer_start_date_${index_val}`)
                .attr("id", "")
                .attr("name", `previous_employer[${index_val}][start_date]`);  
            var startType = pe_start_date.attr('data-type');  
            pe_start_date.attr("onchange", `validateStartDate(this, ${index_val}, ${startType})`);

            pe_end_date
                .removeClass("hasDatepicker")
                .removeClass(`previous_employer_end_date_${index_val - 1}`)
                .addClass(`previous_employer_end_date_${index_val}`)
                .attr("id", "")
                .attr("name", `previous_employer[${index_val}][end_date]`);
            var endType = pe_end_date.attr('data-type');  
            pe_end_date.attr("onchange", `validateEndDate(this, ${index_val}, ${endType})`);

            $(twice_month_selection_radio).each(function () {
                $(this).attr( 'name', `previous_employer[${index_val}][twice_month_selection]`).prop("checked", false);
                if ($(this).val() == "0") {
                    $(this).attr("id", "pe_twice_month_selection_yes_" + index_val);
                    $(this).next("label").removeClass('active').attr('for', "pe_twice_month_selection_yes_" + index_val);
                }
                if ($(this).val() == "1") {
                    $(this).attr("id", "pe_twice_month_selection_no_" + index_val);
                    $(this).next("label").removeClass('active').attr('for', "pe_twice_month_selection_no_" + index_val);
                }
                $(this).attr("checked", false);
            });
            
            // Insert the cloned element after the last one
            $(divLast).after(divClone);

            // Initialize datepicker for date fields
            initializeDatepicker();
        }
    }, 200);
}

function validateStartDate(element, index, type) {
    var startDate = $(element).val();
    var endDate = $(document).find(".previous_employer_div_"+type+" .previous_employer_end_date_" + index).val();

    var startDateObj = parseDate(startDate);
    var endDateObj = parseDate(endDate);

    if (endDate && startDateObj >= endDateObj) {
        $(element).addClass("error");
        $.systemMessage("The start date should not be greater than the end date.", 'alert--danger', true);
        $(element).val('').trigger('focus');
    } else {
        $(element).removeClass("error");
    }
}

function validateEndDate(element, index, type) {
    var startDate = $(document).find(".previous_employer_div_"+type+" .previous_employer_start_date_" + index).val();
    var endDate = $(element).val();

    var startDateObj = parseDate(startDate);
    var endDateObj = parseDate(endDate);

    if (endDateObj <= startDateObj) {
        $(element).addClass("error");
        $.systemMessage("The end date should not be less than the start date.", 'alert--danger', true);
        $(element).val('').trigger('focus');
    } else {
        $(element).removeClass("error");
    }
}

function parseDate(dateStr) {
    var parts = dateStr.split('/');
    return new Date(parts[2], parts[0] - 1, parts[1]);
}

function showHideTransactionSection(value, index) {
    let transactionDiv = $(document).find(`.transaction-div-${index}`);
    let transactionAddMoreDiv = $(document).find(`.add-more-transaction-btn-${index}`);

    if (value == '1') {
        transactionDiv.removeClass("hide-data");
        transactionAddMoreDiv.removeClass("hide-data");        
    } else {
        transactionDiv.addClass("hide-data");    
        transactionAddMoreDiv.addClass("hide-data");  
    }
}

function checkBankAccInputs() {

    // const elements = document.querySelectorAll('.bank-acc-input:not(.hide-data .bank-acc-input)');
    const elements = Array.from(document.querySelectorAll('.bank-acc-input')).filter(el => {
        return !el.closest('.hide-data');
    });
    
    let allFilled = true;
    let bankButton = document.querySelector('.bank-add-more-btn');

    let firstEmptyElement = null;
  
    let transaction_enabled = $("#bank-addmore-button").attr('data-transaction-enabled');

    elements.forEach(element => {
        let isEmpty = false;
        if (element.type === 'radio') {
            const radioGroup = document.getElementsByName(element.name);
            const groupChecked = Array.from(radioGroup).some(radio => radio.checked);
            
            radioGroup.forEach(radio => {
                const label = document.querySelector(`label[for="${radio.id}"]`);
                if (!groupChecked) {
                    isEmpty = true;
                    radio.classList.add("error");
                    if (label) label.classList.add("error");
                } else {
                    radio.classList.remove("error");
                    if (label) label.classList.remove("error");
                }
            });
        } else if (element.tagName.toLowerCase() === 'select') {
            if (element.value.trim() === '') {
                isEmpty = true;
            }
        } else {
            if (element.value.trim() === '') {
                isEmpty = true;
            }
        }

        if (isEmpty) {
            allFilled = false;
            element.classList.add("error");
            if (!firstEmptyElement) {
                firstEmptyElement = element;
            }
        } else {
            element.classList.remove("error");
        }
    });

    if (firstEmptyElement) {
        firstEmptyElement.focus();
    }

    if (allFilled) {
        bankButton.classList.remove("bg-gray-imp");
        bankButton.setAttribute("onclick", "bank_addmore("+transaction_enabled+"); return false;");
    } else {
        bankButton.classList.add("bg-gray-imp");
        bankButton.setAttribute("onclick", "handleBankButtonClick(this);");
    }
}

function handleBankButtonClick(event) {
    if (event && event.preventDefault) {
        event.preventDefault();
    } else {
        console.warn("handleBankButtonClick was called without an event.");
    }
}

document.addEventListener('change', function(event) {
    if (event.target.classList.contains('bank-acc-input')) {
        let transaction_pdf_enabled = event.target.getAttribute('data-transaction-enabled') || 
        event.target.closest('[data-transaction-enabled]')?.getAttribute('data-transaction-enabled');
        transaction_pdf_enabled = transaction_pdf_enabled ? parseInt(transaction_pdf_enabled, 10) : null;
        
        if(transaction_pdf_enabled == 1){
            checkBankAccInputs();
        }
    }
});

$(document).on('click', '#checking_account_items_data .btn-toggle', function(event) {
    event.preventDefault(); // Prevents default action if necessary

    let transaction_pdf_enabled = $(this).attr('data-transaction-enabled') || 
        $(this).closest('[data-transaction-enabled]').attr('data-transaction-enabled');

    transaction_pdf_enabled = transaction_pdf_enabled ? parseInt(transaction_pdf_enabled, 10) : null;

    if (transaction_pdf_enabled === 1) {
        checkBankAccInputs();
    }
});


function addMoreBankTransaction( index, transaction_pdf_enabled ) {
    var divLength = $(document).find(`.transaction-div-${index}`).length;
    if (divLength > 9) {
        $.systemMessage('You can add only 10 transactions.', "alert--danger", true);
        return false;
    } else {
        var lastDiv = $(document).find(`.transaction-div-${index}`).last();
        var clonedDiv = $(lastDiv).clone();

        clonedDiv.find('input[type="text"]').val("");
        clonedDiv.find('input[type="number"]').val("");

        let divclass = 'bank_account_transaction_' + index;
        clonedDiv.removeClass(function (index, className) {
            return (className.match(divclass + "_\\d+", "g") || []).join(' ');
        }).addClass(divclass + "_" + divLength);

        clonedDiv.find(".delete-div").attr("onclick", "remove_div_common('bank_account_transaction_"+index+"', " + divLength + ")");

        // Update input fields with the correct name attributes
        clonedDiv.find(".circle-number-div").html(divLength + 1);

        var transaction_description  = clonedDiv.find(".transaction-description");
        var transaction_value        = clonedDiv.find(".transaction-value");
        var transaction_sample       = clonedDiv.find(".transaction-sample");
        
        $(transaction_description).attr( "name", `bank[data][transaction_data][${index}][${divLength}][description]`);
        $(transaction_description).attr( "value", ``);
        $(transaction_sample).attr( "name", `bank[data][transaction_data][${index}][${divLength}][sample]`);
        $(transaction_sample).attr( "value", ``);
        $(transaction_value).attr( "name", `bank[data][transaction_data][${index}][${divLength}][value]`);
        $(transaction_value).attr( "value", ``);

        $(lastDiv).after(clonedDiv);
        if(transaction_pdf_enabled == 1){
            checkBankAccInputs();
        }
    }
}

openUnknownFlagPopup = function (element, attorneyEdit = false) {
    const eValue = $(element).val();
    const parentDiv = $(element).closest('.life_insurance_mutisec');

    // Toggle visibility of sections based on the selected insurance type
    parentDiv.find('.beneficiary_div').toggleClass('hide-data', ['Renters', 'Disability'].includes(eValue));
    parentDiv.find('.cash_current_value').toggleClass('hide-data', !['Whole', 'Universal'].includes(eValue));
    parentDiv.find('.total_term_div').toggleClass('hide-data', !['Renters', 'Disability'].includes(eValue));

    // Handle popups for specific insurance types
    if (eValue === 'Whole') {
        openPopup('life-insurance-unknown-popup', attorneyEdit);
    } else if (eValue === 'Universal') {
        openPopup('universal-insurance-unknown-popup', attorneyEdit);
    }

    // Update label text for "total-span-section"
    if (eValue === 'Renters') {
        parentDiv.find('.total-span-section').html('Refund Value');
    } else if (eValue === 'Disability') {
        parentDiv.find('.total-span-section').html('Total Value of policy');
    }
};

function showConfirmation(message, callback) {
    // Create custom modal HTML
    const modalHtml = `
        <div id="customConfirm" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;justify-content:center;align-items:center;">
            <div style="background:white;padding:20px;border-radius:5px;max-width:80%;">
                <p>${message}</p>
                <div style="display:flex;justify-content:center;margin-top:20px;gap:1rem;">
                    <button id="confirmYes" class="btn-new-ui-default">Yes</button>
                    <button id="confirmNo" class="btn-new-ui-default">No</button>
                </div>
            </div>
        </div>
    `;
    
    // Add to body
    $('body').append(modalHtml);
    
    // Handle clicks
    $('#confirmYes').on('click', function() {
        $('#customConfirm').remove();
        callback(true);
    });
    
    $('#confirmNo').on('click', function() {
        $('#customConfirm').remove();
        callback(false);
    });
}

function checkUnknown(thisobj, index, label = '') {
    if (thisobj.checked == true) {
       $('.is_' + label + '_unknown_' + index).removeClass('required');
       $('.is_' + label + '_unknown_' + index).prop('disabled', true);
       $('.is_' + label + '_unknown_' + index).val('');
    } else {
       $('.is_' + label + '_unknown_' + index).addClass('required');;
       $('.is_' + label + '_unknown_' + index).prop('disabled', false);
       $('.is_' + label + '_unknown_' + index).val('');
    }
}

deletePaystubFromClientSide = function (thisElement, url, thisPaystubId, thisPaystubDocId, PaystubDate, client_id) {
    let confirmMessage = langLbl.confirmDelete + " " + PaystubDate + ' Paystub?';
    showConfirmation(confirmMessage, function(confirmed) {
        if (!confirmed) {
            $("#check_" + document_type).prop("checked", !thisObject.checked); // Toggle checkbox back to original state
            return;
        }
        $.systemMessage("Deleting document..", 'alert--process');

        laws.ajax(url, { client_id: client_id, thisPaystubId: thisPaystubId, thisPaystubDocId: thisPaystubDocId }, function (response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                $(thisElement).addClass('hide-data');
                $(thisElement).siblings('.no-paystub-label').removeClass('hide-data active');
                $(thisElement).siblings('.no-paystub-label input').removeAttr('checked');
                $(thisElement)
                    .closest('.payslip-item')
                    .find('.upload-btn')
                    .html('<i class="bi bi-cloud-arrow-up me-2"></i>&nbsp;Upload&nbsp;Pay&nbsp;Stub');
                
                $(thisElement)
                    .closest('.payslip-item')
                    .find('.status')
                    .removeClass('uploaded').addClass('missing')
                    .text('Missing');    

            }
        });
    });
};

makrnotOwnPaystubClNew = function(client_id, pay_date, employer_id, url, thisObject) {
    var status = thisObject.checked ? 1 : 0;

    var confirmMessage = status === 0 ?
        "Are you sure you want to mark it yes?" :
        "Are you sure you want to mark it no?";

    showConfirmation(confirmMessage, function(confirmed) {
        if (!confirmed) {
            // Revert checkbox state
            thisObject.checked = !thisObject.checked;
            return;
        }

        // Toggle active class on the label
        var label = thisObject.closest("label");
        if (label) {
            label.classList.toggle("active", thisObject.checked);
        }

        // Continue with the AJAX call
        laws.ajax(url, {
            client_id: client_id,
            pay_date: pay_date,
            employer_id: employer_id
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.reload();
                }, 200);
            }
        });
    });
}

function setBorderLabel(element, labelText) {

    const container = element.closest('[class*="residence_property_main_div_"]');

	if (!container) return;

    const labelSpan = container.querySelector('.border-label');

	if (labelSpan) {
		labelSpan.textContent = labelText;
	}
}

function selectNoToAbove( section ) {
    
    let ids = [];

    if(section == 'financial_assets_2') {
        ids = ['brokerage_app_type_no', 'retirement_pension_no', 'tax_refunds_no', 'licenses_franchises_no'];
    }
    if(section == 'financial_assets_3') {
        ids = ['bonds_mutual_funds_items_no', 'education_ira_no', 'trusts_life_estates_no', 'list-all-property_transfer_no',  'patents_copyrights_no'];
    }
    if(section == 'financial_assets_continued_1') {
        ids = ['alimony_child_support_items_no', 'unpaid_wages_items_no', 'life_insurance_items_no', 'insurance_policies_items_no'];
    }
    if(section == 'financial_assets_continued_2') {
        ids = ['inheritances_items_no', 'injury_claims_items_no', 'other_claims_items_no'];
    }
    if(section == 'sofa_section_legal_action') {
        ids = ['list_lawsuits_no', 'property_repossessed_no', 'setoffs_creditor_no', 'court_appointed_no'];
    }
    if(section == 'sofa_section_gifts') {
        ids = ['list_any_gifts_no', 'gifts-charity_no', 'losses_from_fire_no'];
    }
    if(section == 'sofa_section_property_transfer') {
        ids = ['property_transferred_no', 'property-transferred-creditors_no', 'Property_all_no'];
    }
    if(section == 'sofa_section_storage') {
        ids = ['list-safe-deposit_no', 'list-storage-unit_no', 'list-property-you-hold_no'];
    }
    if(section == 'income_section_first') {
        ids = ['operation_business-no', 'rent_real_property-no', 'recieve_same_rent_amount-no', 'royalties-no', 'retirement_income-no', 'regular_contributions-no', 'unemployment_compensation-no', 'social_security-no', 'other_sources-no', 'government_assistance-no'];
    }
    if(section == 'income_section_first_spouse') {
        ids = ['joints_other_sources-no', 'joints_social_security-no', 'joints_unemployment_compensation-no', 'joints_regular_contributions-no', 'joints_retirement_income-no', 'joints_royalties-no', 'joints_rent_real_property-no', 'joint_operation_business-no', 'government_assistance-no'];
    }

    

    ids.forEach(id => {
        const label = document.querySelector(`label[for="${id}"]`);
        if (label) {
            label.click();
        }
    });
}

function potentialClaimTypeChanged(selectElement) {
    let row = selectElement.closest('.edit_section');
    let descriptionInput = row.querySelector('.injury_claims_description');
    let selectedText = selectElement.options[selectElement.selectedIndex].text;
    
    descriptionInput.value = selectedText;
}
