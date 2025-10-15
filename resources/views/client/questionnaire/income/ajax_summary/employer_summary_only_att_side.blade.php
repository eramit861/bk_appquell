<div class="col-md-12 outline-gray-border-area" id="employer_listing_html">
    @foreach ($currentEmployerData as $key => $value)
        @php
            $sectionTitle = 'Primary Employer:';
            switch ($key) {
                case 0:
                    $sectionTitle = 'Primary Employer:';
                    break;
                case 1:
                    $sectionTitle = 'Second Employer:';
                    break;
                case 2:
                    $sectionTitle = 'Third Employer:';
                    break;
                case 3:
                    $sectionTitle = 'Fourth Employer:';
                    break;
            }
        @endphp
        <div class="light-gray-div">
            <div class="light-gray-box-form-area">
                <h2 class="font-weight-bold label-heading align-items-center mb-0"
                    id="current_employer_summary_label_div_{{ $key }}">
                    <label class="item-label mb-0">{{ $sectionTitle }}</label>
                </h2>
                <div class=" set-mobile-col employer_form w-100 align-items-unset employer_summary {{ empty($value) ? 'hide-data' : '' }}  employer_summary_{{ $key }}"
                    id="current_employer_summary_div_{{ $key }}">
                    <div class="row">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="font-weight-bold ">Name of Employer: <span
                                    class="font-weight-normal name">{{ Helper::validate_key_value('employer_name', $value) }}</span></label>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-12">
                            <label class="font-weight-bold ">Street Address: <span
                                    class="font-weight-normal address_line_1">{{ Helper::validate_key_value('employer_address', $value) }}</span></label>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4">
                            <label class="font-weight-bold ">City: <span
                                    class="font-weight-normal city">{{ Helper::validate_key_value('employer_city', $value) }}</span></label>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4">
                            <label class="font-weight-bold ">State: <span
                                    class="font-weight-normal state">{{ Helper::validate_key_value('employer_state', $value) }}</span></label>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4">
                            <label class="font-weight-bold ">Zip: <span
                                    class="font-weight-normal zip">{{ Helper::validate_key_value('employer_zip', $value) }}</span></label>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                            <label class="font-weight-bold ">Job Title: <span
                                    class="font-weight-normal occupation">{{ Helper::validate_key_value('employer_occupation', $value) }}</span></label>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6">
                            <label class="font-weight-bold ">How long employed here:
                                <span
                                    class="font-weight-normal job_period">{{ Helper::validate_key_value('employment_duration', $value) }}</span>
                            </label>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <label
                                class="font-weight-bold text-c-light-blue paystub_paydate_start_parent {{ !empty(Helper::validate_key_value('start_date', $value)) ? '' : 'hide-data' }} ">Start
                                Date:
                                <span
                                    class="font-weight-normal paystub_paydate_start">{{ Helper::validate_key_value('start_date', $value) }}</span>
                            </label>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                            <label class="font-weight-bold ">Pay Frequency:

                                <span
                                    class="font-weight-normal often_get_paid">{{ Helper::getPayFrequencyLabel(Helper::validate_key_value('frequency', $value)) }}</span>
                            </label>
                        </div>
                        <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-6">
                            <label class="font-weight-bold ">Recent Paystub Pay Date:
                                <span
                                    class="font-weight-normal paystub_paydate_recent">{{ Helper::validate_key_value('end_date', $value) }}</span>
                            </label>
                        </div>
                        @php
                            $note = Helper::validate_key_value('notes', $value);
                        @endphp
                        @if (!empty($note))
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label class="font-weight-bold w-100 mb-0">Notes:
                                    <span class="font-weight-normal notes">{{ $note }}</span></label>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    @endforeach
</div>