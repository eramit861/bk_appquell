@php
    $domestic_partner_living = Helper::validate_key_loop_toggle('domestic_partner_living', $finacial_affairs, 1, $i);
    $showSection = '';
    if (empty($domestic_partner_living)) {
        $showSection = 'hide-data';
    }
@endphp

<div class="light-gray-div living_domestic_partners living_domestic_partners_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Location Details
        </h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete "
            onclick="edit_div_common('living_domestic_partners', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete"
            onclick="seperate_remove_div_common('living_domestic_partners', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                <label class="font-weight-bold">
                    Community Property State or Territory:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('community_property_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-xl-8">
                <label class="font-weight-bold">
                    Did you live and/or reside with a spouse or legal equivalent at any time in this state:
                    <span class="font-weight-normal">
                        @if (Helper::validate_key_loop_value_radio('domestic_partner_living', $finacial_affairs, $i) == 1)
                            Yes
                        @elseif(Helper::validate_key_loop_value_radio('domestic_partner_living', $finacial_affairs, $i) == 0)
                            No
                        @endif
                    </span>
                </label>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 {{ $showSection }}">
                <label class="font-weight-bold">
                    Name:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3 {{ $showSection }}">
                <label class="font-weight-bold">
                    Address:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_street_address', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 {{ $showSection }}">
                <label class="font-weight-bold">
                    City:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 {{ $showSection }}">
                <label class="font-weight-bold">
                    State:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 {{ $showSection }}">
                <label class="font-weight-bold">
                    Zip code:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 codebtor-tab edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="label-div">
                    <div class="form-group">
                        <label>Community Property State or Territory</label>
                        <select class="form-control required community_property_state"
                            name="community_property_state[{{ $i }}]">
                            <option value="">Please Select State or Territory</option>
                            {!! AddressHelper::getSelectedStatesList(@$finacial_affairs['community_property_state'][$i]) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="label-div question-area border-0 pb-0">
                    <label class="fs-13px">Did you live and/or reside with a spouse or legal equivalent at any time in
                        this state?</label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group  multi-input-radio-group">
                        <input type="radio" id="domestic_partner_living_yes_{{ $i }}"
                            class="d-none domestic_partner_living" name="domestic_partner_living[{{ $i }}]"
                            required
                            {{ Helper::validate_key_loop_toggle('domestic_partner_living', $finacial_affairs, 1, $i) }}
                            value="1">
                        <label for="domestic_partner_living_yes_{{ $i }}"
                            class="btn-toggle {{ Helper::validate_key_loop_toggle_active('domestic_partner_living', $finacial_affairs, 1, $i) }}"
                            onclick="didSpouseLiveWithYou(1, '{{ $i }}');">Yes</label>

                        <input type="radio" id="domestic_partner_living_no_{{ $i }}"
                            class="d-none domestic_partner_living" name="domestic_partner_living[{{ $i }}]"
                            required
                            {{ Helper::validate_key_loop_toggle('domestic_partner_living', $finacial_affairs, 0, $i) }}
                            value="0">
                        <label for="domestic_partner_living_no_{{ $i }}"
                            class="btn-toggle {{ Helper::validate_key_loop_toggle_active('domestic_partner_living', $finacial_affairs, 0, $i) }}"
                            onclick="didSpouseLiveWithYou(0, '{{ $i }}');">No</label>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 spouse-live-section-{{ $i }} {{ $showSection }}">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of spouse/legal equivalent you live with</label>
                        <input type="text" name="domestic_partner[{{ $i }}]"
                            class="input_capitalize cod_name form-control required domestic_partner"
                            placeholder="Name of your Spouse, former spouse, or Legal equivalent"
                            value="{{ @$finacial_affairs['domestic_partner'][$i] }}">
                        @if (isset($appservice_codebtors) && !empty($appservice_codebtors))
                            <select class="cod_opt form-control col-12 col-md-6" onchange="alreadySavedCodebtor(this)">
                                <option class="form-control" value="">Choose Already Saved Codebtor</option>
                                @foreach ($appservice_codebtors as $codebtor)
                                    <option data-cname="{{ $codebtor['codebtor_creditor_name'] }}"
                                        data-address="{{ $codebtor['codebtor_creditor_name_addresss'] }}"
                                        data-city="{{ $codebtor['codebtor_creditor_city'] }}"
                                        data-state="{{ $codebtor['codebtor_creditor_state'] }}"
                                        data-zip="{{ $codebtor['codebtor_creditor_zip'] }}">
                                        {{ $codebtor['codebtor_creditor_name'] }},
                                        {{ $codebtor['codebtor_creditor_name_addresss'] }},
                                        {{ $codebtor['codebtor_creditor_city'] }},
                                        {{ $codebtor['codebtor_creditor_state'] }},
                                        {{ $codebtor['codebtor_creditor_zip'] }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3 spouse-live-section-{{ $i }} {{ $showSection }}">
                <div class="label-div">
                    <div class="form-group ">
                        <label>
                            Address: you both lived at
                        </label>
                        <input type="text" name="domestic_partner_street_address[{{ $i }}]"
                            class="input_capitalize cod_address form-control required domestic_partner_street_address"
                            placeholder="Street Address"
                            value="{{ @$finacial_affairs['domestic_partner_street_address'][$i] }}">
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 spouse-live-section-{{ $i }} {{ $showSection }}">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text"
                            class="input_capitalize cod_city form-control required domestic_partner_city"
                            name="domestic_partner_city[{{ $i }}]" placeholder="City"
                            value="{{ @$finacial_affairs['domestic_partner_city'][$i] }}">
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 spouse-live-section-{{ $i }} {{ $showSection }}">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required cod_state domestic_partner_state"
                            name="domestic_partner_state[{{ $i }}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesList(@$finacial_affairs['domestic_partner_state'][$i]) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 spouse-live-section-{{ $i }} {{ $showSection }}">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="number" class="form-control allow-5digit required cod_zip domestic_partner_zip"
                            name="domestic_partner_zip[{{ $i }}]" placeholder="Zip code"
                            value="{{ @$finacial_affairs['domestic_partner_zip'][$i] }}">
                    </div>
                </div>
            </div>

            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    data-url="{{ route('sofa_seperate_save') }}"
                    onclick="seperate_save('living_domestic_partner','living_domestic_partners', 'living-domestic-partner-data', 'parent_living_domestic_partner', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>
