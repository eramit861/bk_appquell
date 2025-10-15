@php
$hideAdd = 'hide-data';
$hideAddButton = '';
$name = '';
$address = '';
$city = '';
$state = '';
$zip = '';
$frequency = '';
$twice_month_selection = '';
$duration = '';
$occupation = '';
$start_date = '';
$end_date = '';
$debtorEmployer = $debtorEmployer ?? [];
$employer = $employer ?? [];
$employer_type = '';
if ($employer) {
    $name = Helper::validate_key_value('employer_name', $employer);
    $address = Helper::validate_key_value('employer_address', $employer);
    $city = Helper::validate_key_value('employer_city', $employer);
    $state = Helper::validate_key_value('employer_state', $employer);
    $zip = Helper::validate_key_value('employer_zip', $employer);
    $frequency = Helper::validate_key_value('frequency', $employer, 'radio');
    $twice_month_selection = Helper::validate_key_value('twice_month_selection', $employer, 'radio');
    $duration = Helper::validate_key_value('employment_duration', $employer);
    $occupation = Helper::validate_key_value('employer_occupation', $employer);
    $start_date = Helper::validate_key_value('start_date', $employer);
    $end_date = Helper::validate_key_value('end_date', $employer);
    $employer_type = Helper::validate_key_value('employer_type', $employer, 'radio');
}

$show_start_date_div = 'hide-data';
$show_duration_div = '';

if (!empty($duration) && preg_match('/(\d+)\sYear(?:s)?\s(\d+)\sMonth(?:s)?/', $duration, $matches)) {
    $years = (int) $matches[1];
    $months = (int) $matches[2];

    $total_months = ($years * 12) + $months;

    if ($total_months <= 7) {
        $show_start_date_div = '';
    }
}


$label = "Add New Employer:";
$addressSectionShowHide = "";
$end_date_label = "Recent Pay Date:";
if (in_array($employer_type, [2])) {
    $addressSectionShowHide = "hide-data";
    $end_date_label = "End Date:";
    $show_start_date_div = '';
    $show_duration_div = 'hide-data';
}
if ($edit) {
    $label = "Edit " . ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $employer, 'radio'));
}
@endphp


<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100">
            {{ $label }}
        </h5>
    </div>
    <form id="payroll_employer_form" action="{{route('save_employer')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client_id }}">
        <input type="hidden" name="client_type" value="{{ $client_type == 'codebtor' ? 2 : 1 }}">
        <input type="hidden" name="employer_id"
            value="{!! Helper::validate_key_value('id', $employer) ?? '' !!}">

        <div class="light-gray-div mt-4 mx-3 d-block">
            <h2>Employment Details:</h2>
            <div class="row gx-3">

                @if ($edit && !empty($employer_type))
                <input type="hidden" name="employer_type"
                    value="{!! Helper::validate_key_value('employer_type', $employer, 'radio') ?? '' !!}">
                @else
                <div class="col-6 col-sm-4">
                    <div class="label-div">
                        <div class="form-group ">
                            <label for="employer_type">Employer Type:</label>
                            <select class="form-control required" name="employer_type"
                                onchange="handleEmployerTypeChange(this)">
                                <option value="">Select Employer Type</option>
                                @foreach ($employerTypeArray as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-6 col-sm-4 address-section {{ $addressSectionShowHide }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label for="employer_occupation">Occupation:</label>
                            <input type="text" name="employer_occupation" class="form-control input_capitalize "
                                placeholder="Name:" value="{{ $occupation }}">
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4">
                    <div class="label-div">
                        <div class="form-group">
                            <label for="employer_frequency">Frequency:</label>
                            <select class="form-control required" name="employer_frequency"
                                onchange="payFrequencyChanged(this, {{ $employer_type }})">
                                <option value="">Select Frequency</option>
                                <option {{ $frequency == 1 ? 'selected' : '' }} value="1">Once a week</option>
                                <option {{ $frequency == 2 ? 'selected' : '' }} value="2">Every two weeks
                                </option>
                                <option {{ $frequency == 3 ? 'selected' : '' }} value="3">Twice a month</option>
                                <option {{ $frequency == 4 ? 'selected' : '' }} value="4">Once a Month</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 twice-month-selection {{ $frequency == 3 ? '' : 'hide-data' }}">
                    <div class="label-div question-area b-0-i pb-0">
                        <label class="fs-13px mb-1">Select your pay schedule:</label>
                        <div class="custom-radio-group form-group multi-input-radio-group btn-small">
                            <input type="radio" id="twice_month_selection_yes" name="twice_month_selection" value="0"
                                class="required d-none twice_month_selection_radio" required {{ ($twice_month_selection == 0) ? 'checked' : '' }} />
                            <label for="twice_month_selection_yes"
                                class="btn-toggle {{ ($twice_month_selection == 0) ? 'active' : '' }}"
                                @if ($employer_type != 2) onclick="toggleMonthSelection(0)" @endif>1st & 15th of month</label>

                            <input type="radio" id="twice_month_selection_no" name="twice_month_selection" value="1"
                                class="required d-none twice_month_selection_radio" required {{ ($twice_month_selection == 1) ? 'checked' : '' }} />
                            <label for="twice_month_selection_no"
                                class="btn-toggle {{ ($twice_month_selection == 1) ? 'active' : '' }}"
                                @if ($employer_type != 2) onclick="toggleMonthSelection(1)" @endif>15th & last day
                                ({{ date("jS", strtotime("last day of this month")) }}) of the month</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 employment_duration_parent_div {{ $show_duration_div }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label class="d-block">How long you been employed at this job:</label>
                            <div class=" d-inline-flex w-100">
                                <select class="form-control col-4 employment_period_year" onchange="updateEmpPeriod()">
                                    <option value="0" selected>Select Years</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ ($i === 1) ? 'Year' : 'Years' }}</option>
                                    @endfor
                                </select>
                                <select class="form-control col-4 ml-3 employment_period_month"
                                    onchange="updateEmpPeriod()">
                                    <option value="0" selected>Select Months</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ ($i === 1) ? 'Month' : 'Months' }}
                                    </option>
                                    @endfor
                                </select>
                                <input type="text" readonly name="employment_duration" id="employment_duration"
                                    data-oldString="{{ $duration }}"
                                    class="de_job_period form-control required w-100 ml-3"
                                    value="{{ $duration }}">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-4 employer_start_date_parent_div {{ $show_start_date_div }}">
                    <div class="label-div">
                        <div class=" form-group ">
                            <label for="start_date">Start Date: <small>(MM/DD/YYYY)</small></label>
                            <input type="text" class="form-control date_filed required employer_start_date"
                                onchange="validateEmployerStartDate(this)" name="start_date" placeholder="MM/DD/YYYY"
                                value="{{ $start_date }}">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="label-div">
                        <div class=" form-group ">
                            <label for="end_date"><span class="end-date-label">{{ $end_date_label }}</span>
                                <small>(MM/DD/YYYY)</small></label>
                            <input type="text" class="form-control date_filed required employer_end_date"
                                onchange="validateEmployerEndDate(this); calculateAndPopulateStartDate();"
                                name="end_date" placeholder="MM/DD/YYYY" value="{{ $end_date }}">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="light-gray-div mt-4 mx-3 d-block">
            <h2>Employer Details:</h2>
            <div class="row gx-3">
                <div class="col-6">
                    <div class="label-div">
                        <div class="form-group">
                            <label for="employer_name">Employer Name:</label>
                            <input type="text" name="employer_name" class="input_capitalize required form-control "
                                placeholder="Employer Name:" value="{{ $name }}">
                        </div>
                    </div>
                </div>

                <div class="col-6 address-section {{ $addressSectionShowHide }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label for="employer_address">Address:</label>
                            <input type="text" name="employer_address" class="form-control input_capitalize "
                                placeholder="Address:" value="{{ $address }}">
                        </div>
                    </div>
                </div>
                <div class="col-4 address-section {{ $addressSectionShowHide }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label for="employer_city">City:</label>
                            <input type="text" name="employer_city" class="form-control input_capitalize "
                                placeholder="City:" value="{{ $city }}">
                        </div>
                    </div>
                </div>
                <div class="col-4 address-section {{ $addressSectionShowHide }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label for="employer_state">State:</label>
                            <select class="form-control" name="employer_state">
                                <option value="">Please Select State</option>
                                {!! AddressHelper::getStatesList($state) !!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-4 address-section {{ $addressSectionShowHide }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label for="employer_zip">Zipcode:</label>
                            <input type="text" name="employer_zip" class="allow-5digit form-control "
                                placeholder="Zipcode:" value="{{ $zip }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-btn-div mx-3 mb-3 w-auto">
            <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default"><span
                    class="">Save</span></button>
        </div>
    </form>
</div>

@push('styles')
<!-- Include optimized CSS using Laravel standard stack -->
<link href="{{ asset('css/employer-management.css') }}" rel="stylesheet">
@endpush

<script>

    $(document).ready(function () {
        $("#payroll_employer_form").validate({
            errorPlacement: function (error, element) {
                if ($(element).parents(".form-group").next('label').hasClass('error')) {
                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").removeClass('mb-1');
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                } else {
                    $(element).parents(".form-group").addClass('mb-1');
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function (label, element) {
                label.parent().removeClass('error');
                $(element).parents(".form-group").next('label').remove();
                $(element).parents(".form-group").removeClass('mb-1');
            },
        });
    });

    function handleEmployerTypeChange(element) {
        const selectedOption = $(element).val();

        if (selectedOption == 1) {
            $('.end-date-label').text('Recent Pay Date:');
            $('.address-section').removeClass('hide-data');
        } else if (selectedOption == 2) {
            $('.end-date-label').text('End Date:');
            $('.employer_start_date_parent_div').removeClass('hide-data');
            $('.employment_duration_parent_div').addClass('hide-data');
            $('.address-section').addClass('hide-data');
        } else {
            $('.end-date-label').text('Recent Pay Date:');
            $('.address-section').removeClass('hide-data');
        }

        // --- NEW PART: toggle MonthSelection handlers based on employer type ---
        let type = selectedOption;
        let freqSelect = document.querySelector('#payroll_employer_form select[name="employer_frequency"]');
        let labelYes = document.querySelector('label[for="twice_month_selection_yes"]');
        let labelNo = document.querySelector('label[for="twice_month_selection_no"]');

        if (freqSelect && freqSelect.value == "3") { // only relevant if "Twice a month"
            if (type != 2) {
                labelYes.onclick = () => toggleMonthSelection(0);
                labelNo.onclick = () => toggleMonthSelection(1);
            } else {
                labelYes.onclick = null;
                labelNo.onclick = null;
            }
        }
    }

    function validateEmployerStartDate(element) {
        var startDate = $(element).val();
        var endDate = $(document).find(".employer_end_date").val();

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

    function validateEmployerEndDate(element) {
        var startDate = $(document).find(".employer_start_date").val();
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

    function calculateDuration(startDateObj, endDateObj) {
        var years = endDateObj.getFullYear() - startDateObj.getFullYear();
        var months = endDateObj.getMonth() - startDateObj.getMonth();

        // Adjust if end date's month is before the start date's month
        if (months < 0) {
            years--;
            months += 12;
        }

        return {
            years: years,
            months: months
        };
    }

    function updateEmpPeriod() {

        var years = '';
        var year = $(".employment_period_year option:selected").val()
        if (year <= 1) {
            years = year + ' Year ';
        } else {
            years = year + ' Years ';
        }

        var months = '';
        var month = $(".employment_period_month option:selected").val()
        if (month <= 1) {
            months = month + ' Month';
        } else {
            months = month + ' Months';
        }

        if (year == 0 && month <= 7) {
            $('.employer_start_date_parent_div').removeClass('hide-data');
        } else {
            $('.employer_start_date_parent_div').addClass('hide-data');
        }
        var finalString = years + months;
        $('.de_job_period').attr('data-oldString', finalString);
        $('.de_job_period').val(finalString);
        calculateAndPopulateStartDate()
    }


    function calculateAndPopulateStartDate() {
        const endDateInput = document.querySelector('.employer_end_date');
        const durationInput = document.querySelector('#employment_duration');
        const startDateInput = document.querySelector('.employer_start_date');

        // Get values
        const endDateValue = endDateInput.value.trim();
        const durationValue = durationInput.value.trim();

        // Ensure end date and duration are valid
        if (!endDateValue || !durationValue) {
            startDateInput.value = '';
            return;
        }

        // Parse end date
        const endDate = new Date(endDateValue);
        if (isNaN(endDate)) {
            startDateInput.value = '';
            return;
        }

        // Extract years and months from duration
        const durationMatch = durationValue.match(/(\d+)\s*Years?\s*(\d+)?\s*Months?/i);
        if (!durationMatch) {
            startDateInput.value = '';
            return;
        }

        const years = parseInt(durationMatch[1] || 0, 10);
        const months = parseInt(durationMatch[2] || 0, 10);

        // Calculate start date
        const startDate = new Date(endDate);
        startDate.setFullYear(startDate.getFullYear() - years);
        startDate.setMonth(startDate.getMonth() - months);

        // Format the date (MM/DD/YYYY)
        const formattedStartDate = startDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
        });

        // Populate the start date field
        startDateInput.value = formattedStartDate;
    }

    function payFrequencyChanged(event, type = '') {
        // If type not passed, try hidden input or select
        if (type === '') {
            let employerTypeInput = document.querySelector('#payroll_employer_form [name="employer_type"]');
            if (employerTypeInput) {
                type = employerTypeInput.value;
            }
        }

        let selectedValue = $(event).val();
        let twiceMonthSelection = document.querySelector('#payroll_employer_form .twice-month-selection');

        let labelYes = document.querySelector('label[for="twice_month_selection_yes"]');
        let labelNo = document.querySelector('label[for="twice_month_selection_no"]');

        if (selectedValue == 3) {
            twiceMonthSelection.classList.remove("hide-data");

            // Attach click handlers only if employer type != 2
            if (type != 2) {
                labelYes.onclick = () => toggleMonthSelection(0);
                labelNo.onclick = () => toggleMonthSelection(1);
            } else {
                labelYes.onclick = null;
                labelNo.onclick = null;
            }
        } else {
            twiceMonthSelection.classList.add("hide-data");
        }
    }

    function toggleMonthSelection(selectedValue) {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth(); // 0 = January
        const day = today.getDate();

        let input = document.querySelector('#payroll_employer_form .employer_end_date');

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
</script>