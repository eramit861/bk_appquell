@for ($j = 0; $j < $lastYearCount; $j++)
    @php $sourceOfIncomeLastYear=Helper::validate_key_loop_value('other_income_received_last_year', $finacial_affairs, $j); @endphp
    @if (isset($sourceOfIncomeList[$sourceOfIncomeLastYear]) || $lastYearCount == 1)
        <!-- Last Year -->
        <div class="light-gray-div mt-2 last_year_row last-year-row-{{ Helper::validate_key_value(1, $taxYears) }}">
            <div class="light-gray-box-form-area">
                <h2>&nbsp;&nbsp;<strong
                        class="text-c-blue ms-2 me-2">{{ Helper::validate_key_value(1, $taxYears) }}</strong><strong>Last
                        Years Income</strong></h2>
                <button type="button" class="delete-div delete-icon" title="Delete"
                    onclick="deleteIncomeRow(this , 'last_year_row');">
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
                            <div class="amount-last-year form-group">
                                @php $sourceOfIncomeLastYear = Helper::validate_key_loop_value('other_income_received_last_year', $finacial_affairs, $j); @endphp
                                <select class="form-control required convert-text-for-other"
                                    name="other_income_received_last_year[{{ $j }}]">
                                    {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastYear) !!}
                                </select>
                                @php $last_year_income_text = Helper::validate_key_loop_value('other_income_received_last_year_text', $finacial_affairs, $j); @endphp
                                <div class="other_income {{ $sourceOfIncomeLastYear != -1 ? 'hide-data' : '' }}">
                                    <input type="text" class="input_capitalize form-control required"
                                        name="other_income_received_last_year_text[{{ $j }}]"
                                        value="{{ $last_year_income_text }}">
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
                                        name="other_amount_last_year_income[{{ $j }}]"
                                        value="{{ (float) Helper::validate_key_loop_value('other_amount_last_year_income', $finacial_affairs, $j) }}">
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
        onclick="addMoreIncomeRow('last_year_row', 'other_income_received_last_year')">
        <i class="bi bi-plus-lg"></i>
        Add More Income Last Year
    </button>
</div>
