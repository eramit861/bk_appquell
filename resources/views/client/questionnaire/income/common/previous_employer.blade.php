@php
    $parentId = '';

    if ($debType == 'self') {
        $parentId = 'data-previous-employer-self';
    }
    if ($debType == 'spouse') {
        $parentId = 'data-previous-employer-spouse';
    }
@endphp

<div
    class="light-gray-div previous_employer_div_{{ $debType }}_{{ $i }} previous_employer_div_{{ $debType }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div>
            Previous Employer Details
        </h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete "
            onclick="edit_div_common('previous_employer_div_{{ $debType }}', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete"
            onclick="seperate_remove_div_common('previous_employer_div_{{ $debType }}', {{ $i }}, 'You cannot remove last employer.')">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-12 col-md-6 col-lg-3">
                <label class="font-weight-bold">
                    Name of Employer:
                    <span class="font-weight-normal">{{ Helper::validate_key_value('employer_name', $data) }}</span>
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <label class="font-weight-bold">
                    Start Date:
                    <span class="font-weight-normal">{{ Helper::validate_key_value('start_date', $data) }}</span>
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <label class="font-weight-bold">
                    End Date:
                    <span class="font-weight-normal">{{ Helper::validate_key_value('end_date', $data) }}</span>
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <label class="font-weight-bold">
                    Pay Frequency:
                    <span
                        class="font-weight-normal">{{ Helper::getPayFrequencyLabel(Helper::validate_key_value('frequency', $data)) }}</span>
                </label>
            </div>
            @php
                $frequency = Helper::validate_key_value('frequency', $data, 'radio');
                $twice_month_selection = Helper::validate_key_value('twice_month_selection', $data);
            @endphp
            <div
                class="col-12 col-md-6 col-lg-3 {{ $frequency == 3 && isset($twice_month_selection) ? '' : 'hide-data' }}">
                <label class="font-weight-bold ">Pay Schedule:
                    <span class="font-weight-normal often_get_paid">
                        {{ Helper::validate_key_value('twice_month_selection', $data, 'radio') == 0 ? '1st & 15th of month' : '' }}
                        {{ Helper::validate_key_value('twice_month_selection', $data, 'radio') == 1 ? '15th & last day (' . date('jS', strtotime('last day of this month')) . ') of the month' : '' }}
                    </span>
                </label>
            </div>

        </div>

        <div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="label-div">
                    <input type="hidden" class="previous_employer_id"
                        name="previous_employer[{{ $i }}][id]"
                        value="{{ Helper::validate_key_value('id', $data) }}">
                    <div class="form-group">
                        <label class="d-block">What was the name of your previous employer?</label>
                        <input type="text" name="previous_employer[{{ $i }}][employer_name]"
                            id="" class="input_capitalize form-control required previous_employer_name"
                            value="{{ Helper::validate_key_value('employer_name', $data) }}" />
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Your Start Date:</label>
                        <input type="text" data-type="{{ $debType }}"
                            class="form-control date_filed required previous_employer_start_date previous_employer_start_date_{{ $i }}"
                            onChange="validateStartDate(this, {{ $i }}, '{{ $debType }}')"
                            name="previous_employer[{{ $i }}][start_date]" placeholder="MM/DD/YYYY"
                            value="{{ Helper::validate_key_value('start_date', $data) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Your End Date: </label>
                        <input type="text" data-type="{{ $debType }}"
                            class="form-control date_filed required previous_employer_end_date previous_employer_end_date_{{ $i }}"
                            onChange="validateEndDate(this, {{ $i }}, '{{ $debType }}')"
                            name="previous_employer[{{ $i }}][end_date]" placeholder="MM/DD/YYYY"
                            value="{{ Helper::validate_key_value('end_date', $data) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">How often did you get paid?</label>
                        <select name="previous_employer[{{ $i }}][frequency]"
                            class="form-control  required previous_employer_often_get_paid"
                            onchange="payFrequencyChanged(this, '{{ $i }}', '{{ $form_id ?? '' }}')">
                            <option value="">Select Pay Frequency</option>
                            @foreach (Helper::getPayFrequencyLabel() as $key => $label)
                                <option value="{{ $key }}"
                                    {{ Helper::validate_key_value('frequency', $data) == $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div
                class="col-12 twice-month-selection {{ Helper::validate_key_value('frequency', $data, 'radio') == 3 ? '' : 'hide-data' }}">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px mb-1">Select your pay schedule:</label>
                    <div class="custom-radio-group form-group multi-input-radio-group btn-small">
                        <input type="radio" id="pe_twice_month_selection_yes_{{ $i }}"
                            name="previous_employer[{{ $i }}][twice_month_selection]" value="0"
                            class="required d-none pe_twice_month_selection_radio" required
                            {{ Helper::validate_key_value('twice_month_selection', $data, 'radio') == 0 ? 'checked' : '' }} />
                        <label for="pe_twice_month_selection_yes_{{ $i }}"
                            class="btn-toggle {{ Helper::validate_key_value('twice_month_selection', $data, 'radio') == 0 ? 'active' : '' }}">1st
                            & 15th of month</label>

                        <input type="radio" id="pe_twice_month_selection_no_{{ $i }}"
                            name="previous_employer[{{ $i }}][twice_month_selection]" value="1"
                            class="required d-none pe_twice_month_selection_radio" required
                            {{ Helper::validate_key_value('twice_month_selection', $data, 'radio') == 1 ? 'checked' : '' }} />
                        <label for="pe_twice_month_selection_no_{{ $i }}"
                            class="btn-toggle {{ Helper::validate_key_value('twice_month_selection', $data, 'radio') == 1 ? 'active' : '' }}">15th
                            & last day ({{ date('jS', strtotime('last day of this month')) }}) of the month</label>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right my-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    data-url="{{ route('income_employer_seperate_save') }}"
                    onclick="seperate_save('previous_employer_{{ $debType }}','previous_employer_div_{{ $debType }}', '{{ $parentId }}', 'parent_previous_employer', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>
