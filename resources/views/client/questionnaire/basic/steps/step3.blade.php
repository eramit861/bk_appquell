<div class="light-gray-border-div {{ !$step3 ? 'hidestep' : '' }}" id="basic-info-part-c">
    @push('tab_scripts')
        <script>
            window.__stepData = {
                pstatus: {{ isset($BasicInfo_PartC) && !empty($BasicInfo_PartC) ? 1 : 0 }},
                divId: 'basic-info-part-c'
            };
        </script>
        <script src="{{ asset('assets/js/client/common_radio_check.js') }}"></script>
    @endpush
    @php $form_route_step_3 = isset($attorney_edit) && $attorney_edit == true ? $save_route : route('client_basic_info_step3'); @endphp
    <form name="client_basic_info_step3" id="client_basic_info_step3" action="{{ $form_route_step_3 }}" method="post"
        novalidate>
        @csrf
        <div class="light-gray-div mt-2">
            <h2 class="text-bold">Prior and/or Pending Bankruptcy Cases</h2>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="label-div question-area">
                        <label for="bankruptcy_filed">Have you or your spouse/partner ever
                            filed for bankruptcy before?
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Indicate whether you or your spouse/partner have ever filed for bankruptcy. This includes any past or pending bankruptcy cases, regardless of their outcome. Providing accurate information ensures proper legal processing.">
                                <i class="bi bi-question-circle"></i>
                            </div>
                        </label>
                        <!-- Radio Buttons -->
                        <div class="custom-radio-group form-group">
                            <input type="radio" id="pending_pior_cases_no" class="d-none"
                                name="part3[pending_pior_cases]" required
                                {{ Helper::validate_key_toggle('pending_pior_cases', $BasicInfo_PartC, 0) }}
                                value="0">
                            <label for="pending_pior_cases_no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('pending_pior_cases', $BasicInfo_PartC, 0) }}"
                                onclick="common_toggle_fn('no','pending_pior_cases_div');">No</label>

                            <input type="radio" id="pending_pior_cases_yes" class="d-none"
                                name="part3[pending_pior_cases]" required
                                {{ Helper::validate_key_toggle('pending_pior_cases', $BasicInfo_PartC, 1) }}
                                value="1">
                            <label for="pending_pior_cases_yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('pending_pior_cases', $BasicInfo_PartC, 1) }}"
                                onclick="common_toggle_fn('yes','pending_pior_cases_div');">Yes</label>
                        </div>
                    </div>
                </div>


                <div id="pending_pior_cases_div"
                    class="col-12 {{ Helper::key_hide_show_v('pending_pior_cases', $BasicInfo_PartC) }}">
                    <div class="row gx-3">
                        <div class="col-12">
                            <div class="label-div question-area">
                                <label for="business_ein_used">
                                    Have you filed any bankruptcy cases within the last 8 Years?
                                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title=""
                                        data-bs-original-title="Indicate whether you have filed for bankruptcy in the last 8 years. If applicable, you may need to provide details of the case, including dates and court information.">
                                        <i class="bi bi-question-circle"></i>
                                    </div>
                                </label>

                                <!-- Radio Buttons -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" id="bankruptcy-no" class="d-none"
                                        name="part3[filed_bankruptcy_case_last_8years]" required
                                        {{ Helper::validate_key_toggle('filed_bankruptcy_case_last_8years', $BasicInfo_PartC, 0) }}
                                        value="0">
                                    <label for="bankruptcy-no"
                                        class="btn-toggle {{ Helper::validate_key_toggle_active('filed_bankruptcy_case_last_8years', $BasicInfo_PartC, 0) }}"
                                        onclick="common_toggle_fn('no','filed_bankruptcy_case_data');">No</label>

                                    <input type="radio" id="bankruptcy-yes" class="d-none"
                                        name="part3[filed_bankruptcy_case_last_8years]" required
                                        {{ Helper::validate_key_toggle('filed_bankruptcy_case_last_8years', $BasicInfo_PartC, 1) }}
                                        value="1">
                                    <label for="bankruptcy-yes"
                                        class="btn-toggle {{ Helper::validate_key_toggle_active('filed_bankruptcy_case_last_8years', $BasicInfo_PartC, 1) }}"
                                        onclick="common_toggle_fn('yes','filed_bankruptcy_case_data');">Yes</label>
                                </div>
                            </div>
                        </div>


                        <div id="filed_bankruptcy_case_data"
                            class="col-12 {{ Helper::key_hide_show_v('filed_bankruptcy_case_last_8years', $BasicInfo_PartC) }}">
                            <p class="mb-3">
                                Court locator link:
                                <a target="_blank" class="ex-link"
                                    href="https://www.uscourts.gov/federal-court-finder/search">https://www.uscourts.gov/federal-court-finder/search</a>
                            </p>
                            <div class="light-gray-box-tittle-div ">
                                <h2>Bankruptcy Case (Last 8 Years)</h2>
                            </div>
                            <div class="outline-gray-border-area">
                                @if (!empty($BasicInfo_PartC['case_filed_state']) && is_array($BasicInfo_PartC['case_filed_state']))
                                    @for ($j = 0; $j < count($BasicInfo_PartC['case_filed_state']); $j++)
                                        @include(
                                            'client.questionnaire.basic.common.bankruptcy_case_last_8_year',
                                            $BasicInfo_PartC)
                                    @endfor
                                @else
                                    @php $j = 0; @endphp
                                    @include(
                                        'client.questionnaire.basic.common.bankruptcy_case_last_8_year',
                                        $BasicInfo_PartC)
                                @endif
                                <div class="add-more-div-bottom">
                                    <button type="button" class="btn-new-ui-default py-1 px-2"
                                        onclick="addOther_bankruptcy_clone(); return false;">
                                        <i class="bi bi-plus-lg"></i>
                                        Add Additional Cases Filed
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="label-div question-area">
                                <label for="business_ein_used"> Are any current bankruptcy cases pending or being filed
                                    by your spouse, a business partner, or an affiliate?
                                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title=""
                                        data-bs-original-title="Indicate if there are any ongoing or upcoming bankruptcy cases involving your spouse, business partner, or an affiliated entity. Additional details may be required if applicable.">
                                        <i class="bi bi-question-circle"></i>
                                    </div>
                                </label>
                                <!-- Radio Buttons -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" id="any_bankruptcy_cases_pending-no"
                                        name="part3[any_bankruptcy_cases_pending]" required class="d-none"
                                        {{ Helper::validate_key_toggle('any_bankruptcy_cases_pending', $BasicInfo_PartD, 0) }}
                                        value="0">
                                    <label for="any_bankruptcy_cases_pending-no"
                                        class="btn-toggle {{ Helper::validate_key_toggle_active('any_bankruptcy_cases_pending', $BasicInfo_PartD, 0) }}"
                                        onclick="common_toggle_fn('no','any_bankruptcy_cases_pending_data');">No</label>

                                    <input type="radio" name="part3[any_bankruptcy_cases_pending]"
                                        id="any_bankruptcy_cases_pending-yes" required class="d-none"
                                        {{ Helper::validate_key_toggle('any_bankruptcy_cases_pending', $BasicInfo_PartD, 1) }}
                                        value="1">
                                    <label for="any_bankruptcy_cases_pending-yes"
                                        class="btn-toggle {{ Helper::validate_key_toggle_active('any_bankruptcy_cases_pending', $BasicInfo_PartD, 1) }}"
                                        onclick="common_toggle_fn('yes','any_bankruptcy_cases_pending_data');">Yes</label>
                                </div>
                            </div>
                        </div>

                        <div id="any_bankruptcy_cases_pending_data"
                            class="col-12 {{ Helper::key_hide_show_v('any_bankruptcy_cases_pending', $BasicInfo_PartD) }}">
                            <div class="outline-gray-border-area">
                                <p class="mb-3">
                                    Court locator link:
                                    <a target="_blank" class="ex-link"
                                        href="https://www.uscourts.gov/federal-court-finder/search">https://www.uscourts.gov/federal-court-finder/search</a>
                                </p>
                                <div class="light-gray-box-tittle-div ">
                                    <h2>Bankruptcy Case</h2>
                                </div>
                                <div class="outline-gray-border-area">
                                    @if (!empty($BasicInfo_PartD['debator_name']) && is_array($BasicInfo_PartD['debator_name']))
                                        @for ($i = 0; $i < count($BasicInfo_PartD['debator_name']); $i++)
                                            @include(
                                                'client.questionnaire.basic.common.bankruptcy_case_pending',
                                                $BasicInfo_PartD)
                                        @endfor
                                    @else
                                        @php $i = 0; @endphp
                                        @include(
                                            'client.questionnaire.basic.common.bankruptcy_case_pending',
                                            $BasicInfo_PartD)
                                    @endif
                                    <div class="add-more-div-bottom">
                                        <button type="button" class="btn-new-ui-default py-1 px-2"
                                            onclick="addOther_bankruptcypending_clone(); return false;">
                                            <i class="bi bi-plus-lg"></i>
                                            Add Additional Cases
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div question-area">
                                <label for="business_ein_used">
                                    Have you or your spouse ever filed a bankruptcy before? (Not within the last 8
                                    years)
                                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title=""
                                        data-bs-original-title="Indicate whether you or your spouse have ever filed for bankruptcy at any point in time, excluding the last 8 years.">
                                        <i class="bi bi-question-circle"></i>
                                    </div>
                                </label>

                                <!-- Radio Buttons -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" name="part3[bankruptcy_filed_before]" class="d-none"
                                        id="bankruptcy_filed_before-no" required
                                        {{ Helper::validate_key_toggle('bankruptcy_filed_before', $BasicInfo_PartD, 0) }}
                                        value="0">
                                    <label for="bankruptcy_filed_before-no"
                                        class="btn-toggle {{ Helper::validate_key_toggle_active('bankruptcy_filed_before', $BasicInfo_PartD, 0) }}"
                                        onclick="common_toggle_fn('no','any_bankruptcy_filed_before_data');">No</label>

                                    <input type="radio" name="part3[bankruptcy_filed_before]" class="d-none"
                                        id="bankruptcy_filed_before-yes" required
                                        {{ Helper::validate_key_toggle('bankruptcy_filed_before', $BasicInfo_PartD, 1) }}
                                        value="1">
                                    <label for="bankruptcy_filed_before-yes"
                                        class="btn-toggle {{ Helper::validate_key_toggle_active('bankruptcy_filed_before', $BasicInfo_PartD, 1) }}"
                                        onclick="common_toggle_fn('yes','any_bankruptcy_filed_before_data');">Yes</label>
                                </div>
                            </div>
                        </div>


                        <div id="any_bankruptcy_filed_before_data"
                            class="col-12 {{ Helper::key_hide_show_v('bankruptcy_filed_before', $BasicInfo_PartD) }}">
                            <div class="outline-gray-border-area">
                                <p class="mb-3">
                                    Court locator link:
                                    <a target="_blank" class="ex-link"
                                        href="https://www.uscourts.gov/federal-court-finder/search">https://www.uscourts.gov/federal-court-finder/search</a>
                                </p>
                                <div class="light-gray-box-tittle-div ">
                                    <h2>Previous Bankruptcy Cases</h2>
                                </div>
                                <div class="outline-gray-border-area">
                                    @if (!empty($BasicInfo_PartD['case_name']) && is_array($BasicInfo_PartD['case_name']))
                                        @for ($j = 0; $j < count($BasicInfo_PartD['case_name']); $j++)
                                            @include(
                                                'client.questionnaire.basic.common.any_bankruptcy_filed',
                                                $BasicInfo_PartD)
                                        @endfor
                                    @else
                                        @php $j = 0; @endphp
                                        @include(
                                            'client.questionnaire.basic.common.any_bankruptcy_filed',
                                            $BasicInfo_PartD)
                                    @endif
                                    <div class="add-more-div-bottom">
                                        <button type="button" class="btn-new-ui-default py-1 px-2"
                                            onclick="addOther_bankruptcybefore_clone(); return false;">
                                            <i class="bi bi-plus-lg"></i>
                                            Add More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="light-gray-div">
            <h2 class="text-bold">Businesses Owned by Debtor</h2>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="label-div question-area">
                        <label for="bankruptcy_filed">Have you or your spouse used any Business
                            names and/or EIN #'s in last 8 years?
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                title=""
                                data-bs-original-title="Indicate whether you or your spouse have used any business names or EINs in the past 8 years.">
                                <i class="bi bi-question-circle"></i>
                            </div>
                        </label>
                        <!-- Radio Buttons -->
                        <div class="custom-radio-group form-group">
                            <input type="radio" id="used_business-no" class="d-none"
                                name="part_rest[used_business_ein]" required
                                {{ Helper::validate_key_toggle('used_business_ein', $BasicInfo_PartRest, 0) }}
                                value="0">
                            <label for="used_business-no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('used_business_ein', $BasicInfo_PartRest, 0) }}"
                                onclick="get_used_business_ein('no');">No</label>

                            <input type="radio" id="used_business-yes" class="d-none"
                                name="part_rest[used_business_ein]" required
                                {{ Helper::validate_key_toggle('used_business_ein', $BasicInfo_PartRest, 1) }}
                                value="1">
                            <label for="used_business-yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('used_business_ein', $BasicInfo_PartRest, 1) }}"
                                onclick="get_used_business_ein('yes');">Yes</label>
                        </div>
                    </div>
                </div>

                <div id="get_used_business_ein"
                    class="col-12 {{ Helper::key_hide_show_v('used_business_ein', $BasicInfo_PartRest) }}">
                    @php
                        $used_business_data = [];
                        if (!empty($BasicInfo_PartRest['used_business_ein_data'])) {
                            $used_business_dta_info = json_decode($BasicInfo_PartRest['used_business_ein_data'], 1);
                            $used_business_data =
                                !empty($used_business_dta_info) && is_array($used_business_dta_info)
                                    ? $used_business_dta_info
                                    : [];
                        }
                    @endphp
                    <div class="outline-gray-border-area">
                        <div class="light-gray-box-tittle-div ">
                            <h2>Business Name</h2>
                        </div>
                        @if (!empty($used_business_data) && is_array($used_business_data['own_business_name']))
                            @for ($j = 0; $j < count($used_business_data['own_business_name']); $j++)
                                @include(
                                    'client.questionnaire.basic.common.own_business_names',
                                    $used_business_data)
                            @endfor
                        @else
                            @include(
                                'client.questionnaire.basic.common.own_business_names',
                                $used_business_data)
                        @endif
                        <div class="add-more-div-bottom">
                            <button type="button" class="btn-new-ui-default py-1 px-2"
                                onclick="stepfour(); return false;">
                                <i class="bi bi-plus-lg"></i>
                                Add Additional Businesses
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Hazardous Property - hidden field --}}
                @php
                    $hazardous_property = Helper::validate_key_value('hazardous_property', $BasicInfo_PartRest, 'radio');
                    $hazardous_property = !empty($hazardous_property) ? $hazardous_property : 0;
                    if ( is_array(Helper::validate_key_value('describe_of_business', $BasicInfo_PartRestD)) ) {
                        $array_checkbox = Helper::validate_key_value( 'describe_of_business', $BasicInfo_PartRestD,
                        );
                    } else {
                        $array_checkbox = [];
                    }
                @endphp
                <input type="hidden" name="part_rest[hazardous_property]" value="{{ $hazardous_property }}">
                <input type="hidden" name="part_rest[hazardous_property_data][what_is_hazard]" value="{{ Helper::validate_key_value('what_is_hazard', $BasicInfo_PartRestD) }}">
                <input type="hidden" name="part_rest[hazardous_property_data][attention_needed]" value="{{ Helper::validate_key_value('attention_needed', $BasicInfo_PartRestD) }}">
                <input type="hidden" name="part_rest[hazardous_property_data][hazard_street_of_business]" value="{{ Helper::validate_key_value('hazard_street_of_business', $BasicInfo_PartRestD) }}">
                <input type="hidden" name="part_rest[hazardous_property_data][hazard_city_of_business]" value="{{ Helper::validate_key_value('hazard_city_of_business', $BasicInfo_PartRestD) }}">
                <input type="hidden" name="part_rest[hazardous_property_data][hazard_state]" value="{{ Helper::validate_key_value('hazard_state', $BasicInfo_PartRestD) }}">
                <input type="hidden" name="part_rest[hazardous_property_data][hazard_zip_of_business]" value="{{ Helper::validate_key_value('hazard_zip_of_business', $BasicInfo_PartRestD) }}">
            </div>
        </div>

        <div class="bottom-btn-div">
            @if (!empty($BasicInfo_PartC['id']))
                <input type="hidden" name="basicinfo_partc_id"
                    value="{{ Helper::validate_key_value('id', $BasicInfo_PartC) }}">
                @if (!empty($redirect))
                    <a href="{{ route('client_dashboard') }}"
                        class="btn-new-ui-default mr-2 {{ App\Helpers\ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back
                        to Previous Page</a>
                @else
                    <a href="{{ route('client_basic_info_step1') }}"
                        class="btn-new-ui-default mr-2 {{ App\Helpers\ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back
                        to Previous Page</a>
                @endif
            @endif
            @php
                $stepsHundredPercent =
                    $authUser->client_type == 3
                        ? $step1PercentDone == 100 && $step2PercentDone == 100
                        : $step1PercentDone == 100;
            @endphp
            @if (isset($is_confirm_prompt_enabled) && $is_confirm_prompt_enabled && $stepsHundredPercent)
                <button type="button" class="btn-new-ui-default"
                    onclick="showConfirmationPrompt('client_basic_info_step3', 'Basic Information')">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                    <i class="feather icon-chevron-right mr-0"></i></button>
            @else
                <button type="submit"
                    class="btn-new-ui-default">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                    <i class="feather icon-chevron-right mr-0"></i></button>
            @endif
        </div>

    </form>
</div>
