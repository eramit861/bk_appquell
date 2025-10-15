@php
    $client_id = Helper::validate_key_value('client_id', $data);
    $client_name = Helper::validate_key_value('client_name', $data);
    $status = Helper::validate_key_value('status', $data);
    $label = Helper::validate_key_value('label', $data);
    $route = Helper::validate_key_value('route', $data);
    $notAvailableRoute = Helper::validate_key_value('notAvailableRoute', $data);
    $showNotAvailableData = Helper::validate_key_value('showNotAvailableData', $data);
    $isPreview = Helper::validate_key_value('isPreview', $data);
    $caseNo = Helper::validate_key_value('caseNo', $data);
    $hearingDate = Helper::validate_key_value('hearingDate', $data);
    $hearingTime = Helper::validate_key_value('hearingTime', $data);
    $zoomLink = Helper::validate_key_value('zoomLink', $data);
    $info = Helper::validate_key_value('info', $data);
    $times = Helper::validate_key_value('times', $data);
@endphp

<div class="modal-content modal-content-div requestPopup ">

    <div class="modal-header align-items-center py-2">
        <div class="row w-100 m-0">
            <div class="col-12">
                <h5 class="modal-title d-flex">
                    {{ $label }}
                </h5>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <form id="add_hearing_info_form" name="add_hearing_info_form" action="{{ $route }}" method="post"
            novalidate>
            @csrf
            <input type="hidden" name="client_id" value="{{ $client_id }}">
            <input type="hidden" name="status" value="{{ $status }}">
            <div class="card-body light-gray-div mt-2 ">
                <h2>Details</h2>
                <div class="row ">
                    <div class="col-12 col-md-4">
                        <div class="label-div form-group">
                            <label>Case No:</label>
                            <input type="text" class="form-control required" name="caseNo"
                                id="case_no_{{ $client_id }}" value="{{ $isPreview ? $caseNo : '' }}"
                                placeholder="Enter Case No">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="label-div form-group">
                            <label>Hearing Date:</label>
                            <input type="text" class="date_filed form-control required" name="hearingDate"
                                id="hearing_date_{{ $client_id }}" value="{{ $isPreview ? $hearingDate : '' }}"
                                placeholder="MM/DD/YYYY">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 position-relative">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label>Time of 341a Hearing:</label>
                                <input name="hearingTime" type="text" id="hearing_time_{{ $client_id }}"
                                    value="{{ $isPreview ? $hearingTime : '' }}" class="form-control required"
                                    placeholder="Time" autocomplete="off" readonly>

                                <!-- Custom dropdown -->
                                <ul class="custom-time-dropdown" id="hearingTimeDropdown">
                                    <li class="dropdown-option">Choose Time</li>
                                    @foreach ($times as $time)
                                        <li class="dropdown-option">{{ $time }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="label-div form-group">
                            <label>Zoom link:</label>
                            <input type="text" class="form-control required" name="zoomLink"
                                id="zoom_link_{{ $client_id }}" value="{{ $isPreview ? $zoomLink : '' }}"
                                placeholder="Enter Zoom Link">
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="label-div form-group">
                            <label>Hearing Information:</label>
                            <textarea class="form-control required" name="caseInfo" id="case_info_{{ $client_id }}" rows="6">{{ $isPreview ? $info : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-btn-div g-3">
                @if ($showNotAvailableData)
                    <button type="button" class="btn-new-ui-default print-hide cursor-pointer mb-0 btn-red"
                        onclick="$('#not_filed_form').submit()">341 Hearing Info Not Available</button>
                @endif
                <button type="button" class="btn-new-ui-default print-hide cursor-pointer mb-0"
                    onclick="$.facebox.close();clientCaseStatusSelectReset({{ $client_id }});">Close</button>
                <button type="submit" class="btn-new-ui-default print-hide cursor-pointer mb-0">Send Hearing Info to
                    Client</button>
            </div>
        </form>
        @if ($showNotAvailableData)
            <form id="not_filed_form" name="not_filed_form" action="{{ $notAvailableRoute }}" method="post"
                novalidate>
                @csrf
                <input type="hidden" name="client_id" value="{{ $client_id }}">
            </form>
        @endif
    </div>
</div>

<script>
    $(document).ready(function() {

        const $input = $('#hearing_time_{{ $client_id }}');
        const $dropdown = $('#hearingTimeDropdown');

        // Show dropdown on input focus/click
        $input.on('focus click', function() {
            $dropdown.show();
        });

        // Set input value when an option is clicked
        $dropdown.on('click', '.dropdown-option', function() {
            if ($(this).text() == 'Choose Time') {
                $input.val('');
            } else {
                $input.val($(this).text());
            }

            $dropdown.hide();
            // Update textarea when time is selected
            updateHearingInfo();
        });

        // Hide dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#hearing_time_{{ $client_id }}, #hearingTimeDropdown')
                .length) {
                $dropdown.hide();
            }
        });

        // Function to update hearing info textarea
        function updateHearingInfo() {
            const clientName = "{{ $client_name }}"; // You may want to get this dynamically
            const hearingDate = $('#hearing_date_{{ $client_id }}').val().trim();
            const hearingTime = $('#hearing_time_{{ $client_id }}').val().trim();
            const zoomLink = $('#zoom_link_{{ $client_id }}').val().trim();
            const $textArea = $('#case_info_{{ $client_id }}');

            let hearingInfo = `Hello ${clientName},\n`;

            // Build hearing date/time part
            let hearingSchedule = "";
            if (hearingDate && hearingTime) {
                hearingSchedule = `${hearingDate} & ${hearingTime}`;
            } else if (hearingDate) {
                hearingSchedule = hearingDate;
            } else if (hearingTime) {
                hearingSchedule = hearingTime;
            }

            if (hearingSchedule) {
                hearingInfo += `\nYour 341a Court hearing is: ${hearingSchedule},`;
            }

            // Add zoom link if provided
            if (zoomLink) {
                hearingInfo += "\nThe Zoom link information is:\n" + zoomLink;
            }

            // Update textarea
            $textArea.val(hearingInfo);
        }

        // Bind change events to inputs
        $('#hearing_date_{{ $client_id }}').on('change input', function() {
            updateHearingInfo();
        });

        $('#hearing_time_{{ $client_id }}').on('change input', function() {
            updateHearingInfo();
        });

        $('#zoom_link_{{ $client_id }}').on('change input', function() {
            updateHearingInfo();
        });

        // Validation rules
        validateForm('add_hearing_info_form');

    });
</script>
