<div class="light-gray-div list_every_addresses last_three_year list_every_addresses_{{ $i }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Address
            Details
        </h2>
        <button type="button" class="delete-div" title="Delete"
            onclick="remove_div_common('list_every_addresses', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-lg-4 col-md-8 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Street Address</label>
                        <input type="text" class="input_capitalize form-control required creditor_street"
                            placeholder="Street Address" name="prev_address[creditor_street][{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('creditor_street', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required creditor_city"
                            name="prev_address[creditor_city][{{ $i }}]" placeholder="City"
                            value="{{ Helper::validate_key_loop_value('creditor_city', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required creditor_state 1"
                            name="prev_address[creditor_state][{{ $i }}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesList(@$finacial_affairs['creditor_state'][$i]) !!}
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>ZIP Code</label>
                        <input type="number" class="form-control allow-5digit required creditor_zip"
                            name="prev_address[creditor_zip][{{ $i }}]" placeholder="Zip"
                            value="{{ Helper::validate_key_loop_value('creditor_zip', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-lg-4  col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>From Date</label>
                        <input type="text" placeholder="From Date MM/YYYY"
                            class="form-control date-validate-mm-yyyy-format required prev_address_from date_month_year_custom"
                            name="prev_address[from][{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('from', $finacial_affairs, $i) }}"
                            data-startinputname="prev_address[from][{{ $i }}]"
                            data-endinputname="prev_address[to][{{ $i }}]">
                        <div class="error-msg italic-text text-danger small mt-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-lg-4  col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>To Date</label>
                        <input type="text" placeholder="To Date MM/YYYY"
                            class="form-control date-validate-mm-yyyy-format required prev_address_to date_month_year_custom"
                            name="prev_address[to][{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('to', $finacial_affairs, $i) }}"
                            data-startinputname="prev_address[from][{{ $i }}]"
                            data-endinputname="prev_address[to][{{ $i }}]">
                        <div class="error-msg italic-text text-danger small mt-1"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none">
                <div class="label-div question-area">
                    <label>Add in:</label>
                    <div class="custom-radio-group">
                        <input type="radio" id="debtor_1" class="live_debtor d-none" value="debtor 1"
                            @if ($client_type == Helper::CLIENT_TYPE_JOINT_MARRIED) checked @endif
                            name="prev_address[debtor][{{ $i }}]" required
                            {{ Helper::validate_key_loop_toggle('debtor', $finacial_affairs, 'debtor 1', $i) }}>
                        <label for="debtor_1"
                            class="btn-toggle {{ Helper::validate_key_loop_toggle_active('debtor', $finacial_affairs, 'debtor 1', $i) }}">Debtor</label>
                        @if ($client_type == Helper::CLIENT_TYPE_JOINT_MARRIED)
                            <input type="radio" id="debtor_2" class="live_debtor d-none" value="debtor 2"
                                name="prev_address[debtor][{{ $i }}]" required
                                {{ Helper::validate_key_loop_toggle('debtor', $finacial_affairs, 'debtor 2', $i) }}>
                            <label for="debtor_2"
                                class="btn-toggle {{ Helper::validate_key_loop_toggle_active('debtor', $finacial_affairs, 'debtor 2', $i) }}">Spouse</label>
                            <input type="radio" id="debtor_both" class="live_debtor d-none" value="both"
                                name="prev_address[debtor][{{ $i }}]" required
                                {{ Helper::validate_key_loop_toggle('debtor', $finacial_affairs, 'both', $i) }}>
                            <label for="debtor_both"
                                class="btn-toggle {{ Helper::validate_key_loop_toggle_active('debtor', $finacial_affairs, 'both', $i) }}">Both</label>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
