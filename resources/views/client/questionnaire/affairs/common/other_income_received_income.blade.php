@php
    $sourceOfIncomeList = Helper::getSourceOfIncomeArray();

    $currentYearArray = Helper::validate_key_value('other_amount_this_year_income', $finacial_affairs);
    $currentYearCount =
        is_array($currentYearArray) && !empty($currentYearArray) ? count(array_filter($currentYearArray)) : 1;

    $lastYearArray = Helper::validate_key_value('other_amount_last_year_income', $finacial_affairs);
    $lastYearCount = is_array($lastYearArray) && !empty($lastYearArray) ? count(array_filter($lastYearArray)) : 1;

    $lastBeforeYearArray = Helper::validate_key_value('other_amount_lastbefore_year_income', $finacial_affairs);
    $lastBeforeYearCount =
        is_array($lastBeforeYearArray) && !empty($lastBeforeYearArray) ? count(array_filter($lastBeforeYearArray)) : 1;
@endphp


<div class="light-gray-div mt-2 mb-3 ytd_other_income_debtor_div ytd_other_income_debtor_div_0">
    <div class="light-gray-box-form-area">
        <h2 class="h2-border-heading">{{ $debtorname }} Income Details</h2>

        <a href="javascript:void(0)" class="client-edit-button"
            onclick="edit_div_common('ytd_other_income_debtor_div', 0); updateDeleteIcons();">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>

        <div
            class="row gx-3 summary_section {{ !empty(Helper::validate_key_value('other_income_received_this_year', $finacial_affairs)) ? '' : 'hide-data' }}">

            <div class="col-12 col-md-2 col-lg-2">
                <label class="font-weight-bold">Year:</label>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <label class="font-weight-bold">Source of income:</label>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <label class="font-weight-bold">Income:</label>
            </div>
            @for ($i = 0; $i < $currentYearCount; $i++)
                @php $sourceOfIncomeThisYear=Helper::validate_key_loop_value('other_income_received_this_year', $finacial_affairs, $i); @endphp
                @if (isset($sourceOfIncomeList[$sourceOfIncomeThisYear]) || $currentYearCount == 1)
                    <div class="col-12 col-md-2 col-lg-2">
                        <label class="font-weight-bold"><span
                                class="font-weight-normal">{{ Helper::validate_key_value(0, $taxYears) }}</span></label>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <label class="font-weight-bold">
                            <span class="font-weight-normal">
                                {{ Helper::getSourceOfIncomeArray($sourceOfIncomeThisYear) }}
                                @if ($sourceOfIncomeThisYear == -1)
                                    ({{ Helper::validate_key_loop_value('other_income_received_this_year_text', $finacial_affairs, $i) }})
                                @endif
                            </span>
                        </label>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <label class="font-weight-bold"><span class="font-weight-normal">$
                                {{ !empty((float) Helper::validate_key_loop_value('other_amount_this_year_income', $finacial_affairs, $i)) ? (float) Helper::validate_key_loop_value('other_amount_this_year_income', $finacial_affairs, $i) : '0.00' }}</span></label>
                    </div>
                @endif
            @endfor

            @for ($j = 0; $j < $lastYearCount; $j++)
                @php $sourceOfIncomeLastYear=Helper::validate_key_loop_value('other_income_received_last_year', $finacial_affairs, $j); @endphp
                @if (isset($sourceOfIncomeList[$sourceOfIncomeLastYear]) || $lastYearCount == 1)
                    <!-- Last Year -->
                    <div class="col-12 col-md-2 col-lg-2">
                        <label class="font-weight-bold"><span
                                class="font-weight-normal">{{ Helper::validate_key_value(1, $taxYears) }}</span></label>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <label class="font-weight-bold">
                            <span class="font-weight-normal">
                                {{ Helper::getSourceOfIncomeArray($sourceOfIncomeLastYear) }}
                                @if ($sourceOfIncomeLastYear == -1)
                                    ({{ Helper::validate_key_loop_value('other_income_received_last_year_text', $finacial_affairs, $j) }})
                                @endif
                            </span>
                        </label>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <label class="font-weight-bold"><span class="font-weight-normal">$
                                {{ !empty((float) Helper::validate_key_loop_value('other_amount_last_year_income', $finacial_affairs, $j)) ? (float) Helper::validate_key_loop_value('other_amount_last_year_income', $finacial_affairs, $j) : '0.00' }}</span></label>
                    </div>
                @endif
            @endfor

            @for ($k = 0; $k < $lastBeforeYearCount; $k++)
                @php $sourceOfIncomeLastBeforeYear=Helper::validate_key_loop_value('other_income_received_lastbefore_year', $finacial_affairs, $k); @endphp
                @if (isset($sourceOfIncomeList[$sourceOfIncomeLastBeforeYear]) || $lastBeforeYearCount == 1)
                    <!-- Last Year Before -->
                    <div class="col-12 col-md-2 col-lg-2">
                        <label class="font-weight-bold"><span
                                class="font-weight-normal">{{ Helper::validate_key_value(2, $taxYears) }}</span></label>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <label class="font-weight-bold">
                            <span class="font-weight-normal">
                                {{ Helper::getSourceOfIncomeArray($sourceOfIncomeLastBeforeYear) }}
                                @if ($sourceOfIncomeLastBeforeYear == -1)
                                    ({{ Helper::validate_key_loop_value('other_income_received_lastbefore_year_text', $finacial_affairs, $k) }})
                                @endif
                            </span>
                        </label>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <label class="font-weight-bold"><span class="font-weight-normal">$
                                {{ !empty((float) Helper::validate_key_loop_value('other_amount_lastbefore_year_income', $finacial_affairs, $k)) ? (float) Helper::validate_key_loop_value('other_amount_lastbefore_year_income', $finacial_affairs, $k) : '0.00' }}</span></label>
                    </div>
                @endif
            @endfor

        </div>

        <div
            class="row gx-3 edit_section {{ !empty(Helper::validate_key_value('other_income_received_this_year', $finacial_affairs)) ? 'hide-data' : '' }}">
            <div class="col-12">
                <!-- Current Year -->
                <strong class="subtitle pb-0 mb-3 subtitle-mt-3-mobile">Income This Year</strong>
                @include('client.questionnaire.affairs.common.ytd_current_income_debtor.ytd_current_income_current_year')
                <!-- Last Year -->
                <strong class="subtitle pb-0 mb-3">Income Last Year</strong>
                @include('client.questionnaire.affairs.common.ytd_current_income_debtor.ytd_current_income_last_year')
                <!-- Year Before last Year -->
                <strong class="subtitle pb-0 mb-3">Income Year Before last</strong>
                @include('client.questionnaire.affairs.common.ytd_current_income_debtor.ytd_current_income_before_last_year')
            </div>
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    data-url="{{ route('sofa_seperate_save') }}"
                    onclick="seperate_save('ytd_other_income_debtor_div','ytd_other_income_debtor_div', 'other-income-received-income-data', 'parent_ytd_other_source_income', 0)">Save</a>
            </div>
        </div>

    </div>
</div>
