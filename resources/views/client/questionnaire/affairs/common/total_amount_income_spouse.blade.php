<div class="light-gray-div mt-2 ytd_spouse_div ytd_spouse_div_0">
    <div class="light-gray-box-form-area">
        <h2 class="h2-border-heading">{{ $spousename }} Income Details</h2>

        <a href="javascript:void(0)" class="client-edit-button" onclick="edit_div_common('ytd_spouse_div', 0)">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>

        <div
            class="row gx-3 summary_section {{ !empty(Helper::validate_key_value('total_amount_spouse_this_year_income', $finacial_affairs)) ? '' : 'hide-data' }}">
            <div class="col-12 col-md-2 col-lg-2">
                <label class="font-weight-bold">Year:</label>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <label class="font-weight-bold">Source of income:</label>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <label class="font-weight-bold">Gross income:</label>
            </div>

            <div class="col-12 col-md-2 col-lg-2">
                <label class="font-weight-bold"><span
                        class="font-weight-normal">{{ Helper::validate_key_value(0, $taxYears) }}</span></label>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <label class="font-weight-bold">
                    <span class="font-weight-normal">
                        @if (Helper::validate_key_value('total_amount_spouse_this_year', $finacial_affairs, 'radio') == 1)
                            Wages
                        @elseif(Helper::validate_key_value('total_amount_spouse_this_year', $finacial_affairs, 'radio') == 0)
                            Business
                        @endif
                    </span>
                </label>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <label class="font-weight-bold"><span class="font-weight-normal">$
                        {{ !empty(Helper::validate_key_value('total_amount_spouse_this_year_income', $finacial_affairs)) ? Helper::validate_key_value('total_amount_spouse_this_year_income', $finacial_affairs) : '0.00' }}</span></label>
            </div>

            @if (!empty(Helper::validate_key_value('total_amount_spouse_this_year_income_extra', $finacial_affairs)))
                <div class="col-12 col-md-2 col-lg-2">
                    <label class="font-weight-bold"><span
                            class="font-weight-normal">{{ Helper::validate_key_value(0, $taxYears) }}</span></label>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <label class="font-weight-bold">
                        <span class="font-weight-normal">
                            @if (Helper::validate_key_value('total_amount_spouse_this_year_extra', $finacial_affairs, 'radio') == 1)
                                Wages
                            @elseif(Helper::validate_key_value('total_amount_spouse_this_year_extra', $finacial_affairs, 'radio') == 0)
                                Business
                            @endif
                        </span>
                    </label>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <label class="font-weight-bold"><span class="font-weight-normal">$
                            {{ !empty(Helper::validate_key_value('total_amount_spouse_this_year_income_extra', $finacial_affairs)) ? Helper::validate_key_value('total_amount_spouse_this_year_income_extra', $finacial_affairs) : '0.00' }}</span></label>
                </div>
            @endif

            <div class="col-12 col-md-2 col-lg-2">
                <label class="font-weight-bold"><span
                        class="font-weight-normal">{{ Helper::validate_key_value(1, $taxYears) }}</span></label>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <label class="font-weight-bold">
                    <span class="font-weight-normal">
                        @if (Helper::validate_key_value('total_amount_spouse_last_year', $finacial_affairs, 'radio') == 1)
                            Wages
                        @elseif(Helper::validate_key_value('total_amount_spouse_last_year', $finacial_affairs, 'radio') == 0)
                            Business
                        @endif
                    </span>
                </label>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <label class="font-weight-bold"><span class="font-weight-normal">$
                        {{ !empty(Helper::validate_key_value('total_amount_spouse_last_year_income', $finacial_affairs)) ? Helper::validate_key_value('total_amount_spouse_last_year_income', $finacial_affairs) : '0.00' }}</span></label>
            </div>

            @if (!empty(Helper::validate_key_value('total_amount_spouse_last_year_income_extra', $finacial_affairs)))
                <div class="col-12 col-md-2 col-lg-2">
                    <label class="font-weight-bold"><span
                            class="font-weight-normal">{{ Helper::validate_key_value(1, $taxYears) }}</span></label>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <label class="font-weight-bold">
                        <span class="font-weight-normal">
                            @if (Helper::validate_key_value('total_amount_spouse_last_year_extra', $finacial_affairs, 'radio') == 1)
                                Wages
                            @elseif(Helper::validate_key_value('total_amount_spouse_last_year_extra', $finacial_affairs, 'radio') == 0)
                                Business
                            @endif
                        </span>
                    </label>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <label class="font-weight-bold"><span class="font-weight-normal">$
                            {{ !empty(Helper::validate_key_value('total_amount_spouse_last_year_income_extra', $finacial_affairs)) ? Helper::validate_key_value('total_amount_spouse_last_year_income_extra', $finacial_affairs) : '0.00' }}</span></label>
                </div>
            @endif

            <div class="col-12 col-md-2 col-lg-2">
                <label class="font-weight-bold"><span
                        class="font-weight-normal">{{ Helper::validate_key_value(2, $taxYears) }}</span></label>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <label class="font-weight-bold">
                    <span class="font-weight-normal">
                        @if (Helper::validate_key_value('total_amount_spouse_lastbefore_year', $finacial_affairs, 'radio') == 1)
                            Wages
                        @elseif(Helper::validate_key_value('total_amount_spouse_lastbefore_year', $finacial_affairs, 'radio') == 0)
                            Business
                        @endif
                    </span>
                </label>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <label class="font-weight-bold"><span class="font-weight-normal">$
                        {{ !empty(Helper::validate_key_value('total_amount_spouse_lastbefore_year_income', $finacial_affairs)) ? Helper::validate_key_value('total_amount_spouse_lastbefore_year_income', $finacial_affairs) : '0.00' }}</span></label>
            </div>

            @if (!empty(Helper::validate_key_value('total_amount_spouse_lastbefore_year_income_extra', $finacial_affairs)))
                <div class="col-12 col-md-2 col-lg-2">
                    <label class="font-weight-bold"><span
                            class="font-weight-normal">{{ Helper::validate_key_value(2, $taxYears) }}</span></label>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <label class="font-weight-bold">
                        <span class="font-weight-normal">
                            @if (Helper::validate_key_value('total_amount_spouse_lastbefore_year_extra', $finacial_affairs, 'radio') == 1)
                                Wages
                            @elseif(Helper::validate_key_value('total_amount_spouse_lastbefore_year_extra', $finacial_affairs, 'radio') == 0)
                                Business
                            @endif
                        </span>
                    </label>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <label class="font-weight-bold"><span class="font-weight-normal">$
                            {{ !empty(Helper::validate_key_value('total_amount_spouse_lastbefore_year_income_extra', $finacial_affairs)) ? Helper::validate_key_value('total_amount_spouse_lastbefore_year_income_extra', $finacial_affairs) : '0.00' }}</span></label>
                </div>
            @endif

        </div>

        <div
            class="row gx-3 edit_section {{ !empty(Helper::validate_key_value('total_amount_spouse_this_year_income', $finacial_affairs)) ? 'hide-data' : '' }}">
            <div class="col-12">
                <!-- Current Year -->
                <strong class="subtitle pb-0 mb-3 subtitle-mt-3-mobile">Income This Year</strong>
                @include('client.questionnaire.affairs.common.ytd_spouse.ytd_gross_income_current_year')
                <!-- Last Year -->
                <strong class="subtitle pb-0 mb-3">Income Last Year</strong>
                @include('client.questionnaire.affairs.common.ytd_spouse.ytd_gross_income_last_year')
                <!-- Year Before last Year -->
                <strong class="subtitle pb-0 mb-3">Income Year Before last</strong>
                @include('client.questionnaire.affairs.common.ytd_spouse.ytd_gross_income_before_last_year')
            </div>
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    data-url="{{ route('sofa_seperate_save') }}"
                    onclick="seperate_save('ytd_spouse_div','ytd_spouse_div', 'total-amount-income-data', 'parent_ytd_gross_income', 0)">Save</a>
            </div>
        </div>
    </div>
</div>
