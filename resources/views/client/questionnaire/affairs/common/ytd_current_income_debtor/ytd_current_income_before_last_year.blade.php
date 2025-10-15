@for ($k = 0; $k < $lastBeforeYearCount; $k++)
    @php $sourceOfIncomeLastBeforeYear=Helper::validate_key_loop_value('other_income_received_lastbefore_year', $finacial_affairs, $k); @endphp
    @if (isset($sourceOfIncomeList[$sourceOfIncomeLastBeforeYear]) || $lastBeforeYearCount == 1)
        <!-- Last Year -->
        <div
            class="light-gray-div mt-2 last_before_year_row last-before-year-row-{{ Helper::validate_key_value(2, $taxYears) }}">
            <div class="light-gray-box-form-area">
                <h2>&nbsp;&nbsp;<strong
                        class="text-c-blue ms-2 me-2">{{ Helper::validate_key_value(2, $taxYears) }}</strong><strong>Year
                        Before Income</strong></h2>
                <button type="button" class="delete-div delete-icon" title="Delete"
                    onclick="deleteIncomeRow(this , 'last_before_year_row');">
                    <i class="bi bi-trash3 mr-1"></i>
                    Delete
                </button>
                <div class="row gx-3">
                    <div class="col-xxl-8 col-xl-6 col-md-8 col-sm-6 col-12">
                        <div class="label-div">
                            <label class="fs-13px" style="width: fit-content;">
                                Source of Income
                                <div class="video-div d-flex ytd-find-this-div align-items-center">
                                    <button type="button" class="video-btn fs-13px p-0"
                                        onclick="openFlagPopup('sofa-irs-popup-image-IRS2', '', false);">
                                        <div>Where do I find this?</div>
                                        <i class="bi bi-patch-question-fill ms-2"></i>
                                    </button>
                                </div>
                            </label>
                            <div class="amount-last-before-year form-group">
                                @php $sourceOfIncomeLastBeforeYear = Helper::validate_key_loop_value('other_income_received_lastbefore_year', $finacial_affairs, $k); @endphp
                                <select class="form-control required convert-text-for-other"
                                    name="other_income_received_lastbefore_year[{{ $k }}]">
                                    {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastBeforeYear) !!}
                                </select>
                                @php $last_before_year_income_text = Helper::validate_key_loop_value('other_income_received_lastbefore_year_text', $finacial_affairs, $k); @endphp
                                <div class="other_income {{ $sourceOfIncomeLastBeforeYear != -1 ? 'hide-data' : '' }}">
                                    <input type="text" class="input_capitalize form-control required"
                                        name="other_income_received_lastbefore_year_text[{{ $k }}]"
                                        value="{{ $last_before_year_income_text }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-6 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label> Income</label>
                                <div class="input-group total_amount_this_year_income">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field mw-unset required"
                                        name="other_amount_lastbefore_year_income[{{ $k }}]"
                                        value="{{ (float) Helper::validate_key_loop_value('other_amount_lastbefore_year_income', $finacial_affairs, $k) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endfor
<div class="add-more-div-bottom">
    <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2 this_year_second_add_more "
        onclick="addMoreIncomeRow('last_before_year_row', 'other_income_received_lastbefore_year')">
        <i class="bi bi-plus-lg"></i>
        Add More Income Year Before Last
    </button>
</div>
