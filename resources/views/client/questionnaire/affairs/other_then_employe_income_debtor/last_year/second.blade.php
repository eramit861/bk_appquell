<tr
    class="last_year_second {{ empty(Helper::validate_key_value('other_amount_last_year_income_second', $finacial_affairs)) ? 'hide-data' : '' }}">
    <td data="Period">
        <div class="form-group">
            <label>{{ Helper::validate_key_value(1, $taxYears) }}</label>
        </div>
    </td>
    <td data="Period">

    </td>
    <td data="Source of income">
        <div class="amount-last-year form-group">
            @php $sourceOfIncomeLastYearSecond = Helper::validate_key_value('other_income_received_last_year_second',$finacial_affairs); @endphp

            <select class="form-control required last_year_second_select convert-text-for-other"
                name="other_income_received_last_year_second">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastYearSecond) !!}

            </select>
            @php $other_income_received_last_year_text_second = Helper::validate_key_value('other_income_received_last_year_text_second',$finacial_affairs); @endphp
            <div class="last_year_second_other_income {{ $sourceOfIncomeLastYearSecond != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_last_year_text_second"
                    value="{{ $other_income_received_last_year_text_second }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control last_year_second_income_input price-field required"
                name="other_amount_last_year_income_second"
                value="{{ Helper::validate_key_value('other_amount_last_year_income_second', $finacial_affairs) }}">
        </div>
        </div>
        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_last_year_income_second', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue last_year_third_add_more"
            onclick="$('.last_year_third').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash  text-right text-danger cursor-pointer"
            onclick="$('.last_year_second').addClass('hide-data');$('.last_year_second_add_more').removeClass('hide-data');$('.last_year_second_income_input').val('');$('.last_year_second_select').val(11);$('.last_year_second_other_income').addClass('hide-data');$('.last_year_second_other_income').find('input').val('');"></i>
    </td>
</tr>