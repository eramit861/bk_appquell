<tr
    class="before_year_second {{ empty(Helper::validate_key_value('other_amount_lastbefore_year_income_second', $finacial_affairs)) ? 'hide-data' : '' }}">
    <td data="Period">
        <div class="form-group">
            <label>{{ Helper::validate_key_value(2, $taxYears) }}</label>
        </div>
    </td>
    <td data="Period">

    </td>
    <td data="Source of income">
        <div class="amount-last-before-year form-group">
            @php $sourceOfIncomeLastBeforeYear = Helper::validate_key_value('other_income_received_lastbefore_year_second',$finacial_affairs); @endphp

            <select class="form-control required lastbefore_year_second_select convert-text-for-other"
                name="other_income_received_lastbefore_year_second">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastBeforeYear) !!}

            </select>
            @php $other_income_received_lastbefore_year_text_second = Helper::validate_key_value('other_income_received_lastbefore_year_text_second',$finacial_affairs); @endphp

            <div
                class="lastbefore_year_second_other_income {{ $sourceOfIncomeLastBeforeYear != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_lastbefore_year_text_second"
                    value="{{ $other_income_received_lastbefore_year_text_second }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control lastbefore_year_income_second price-field required"
                name="other_amount_lastbefore_year_income_second"
                value="{{ Helper::validate_key_value('other_amount_lastbefore_year_income_second', $finacial_affairs) }}">
        </div>
        </div>
        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_lastbefore_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue before_year_third_add_more"
            onclick="$('.before_year_third').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash  text-right text-danger cursor-pointer"
            onclick="$('.before_year_second').addClass('hide-data');$('.before_year_second_add_more').removeClass('hide-data');$('.lastbefore_year_income_second').val('');$('.lastbefore_year_second_select').val(11);$('.lastbefore_year_second_other_income').addClass('hide-data');$('.lastbefore_year_second_other_income').find('input').val('');"></i>
    </td>
</tr>
