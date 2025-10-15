@for ($i = 0; $i < $currentYearCount; $i++)
    @php $sourceOfIncomeThisYear=Helper::validate_key_loop_value('other_income_received_this_year', $finacial_affairs, $i); @endphp
    @if (isset($sourceOfIncomeList[$sourceOfIncomeThisYear]) || $currentYearCount == 1)
        <!-- Current Year -->
        <div
            class="light-gray-div mt-2 current_year_row debtor-income-row-{{ Helper::validate_key_value(0, $taxYears) }}">
            <div class="light-gray-box-form-area">
                <h2>&nbsp;&nbsp;<strong
                        class="text-c-blue ms-2 me-2">{{ Helper::validate_key_value(0, $taxYears) }}</strong>
                    <strong>Current Year To Date</strong>
                </h2>
                <button type="button" class="delete-div delete-icon" title="Delete"
                    onclick="deleteIncomeRow(this , 'current_year_row');">
                    <i class="bi bi-trash3 mr-1"></i>
                    Delete
                </button>
                <div class="row gx-3">
                    <div class="col-xxl-8 col-xl-6 col-md-8 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="amount-this-year form-group">
                                <label class="fs-13px">Source of Income</label>
                                <select class="form-control required convert-text-for-other"
                                    name="other_income_received_this_year[{{ $i }}]">
                                    {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeThisYear) !!}
                                </select>
                                @php $other_income_text = Helper::validate_key_loop_value('other_income_received_this_year_text', $finacial_affairs, $i); @endphp
                                <div class="other_income {{ $sourceOfIncomeThisYear != -1 ? 'hide-data' : '' }}">
                                    <input type="text" class="input_capitalize form-control required"
                                        name="other_income_received_this_year_text[{{ $i }}]"
                                        value="{{ $other_income_text }}">
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
                                    <input type="number" class="form-control price-field required mw-unset"
                                        name="other_amount_this_year_income[{{ $i }}]"
                                        value="{{ (float) Helper::validate_key_loop_value('other_amount_this_year_income', $finacial_affairs, $i) }}">
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
        onclick="addMoreIncomeRow('current_year_row', 'other_income_received_this_year')">
        <i class="bi bi-plus-lg"></i>
        Add More Income This Year
    </button>
</div>
