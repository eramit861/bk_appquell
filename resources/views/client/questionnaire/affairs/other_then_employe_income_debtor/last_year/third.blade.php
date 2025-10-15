<tr
    class="last_year_third {{ empty(Helper::validate_key_value('other_amount_last_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }}">
    <td data="Period">
        <div class="form-group">
            <label>{{ Helper::validate_key_value(1, $taxYears) }}</label>
        </div>
    </td>
    <td data="Period">

    </td>
    <td data="Source of income">
        <div class="amount-last-year form-group">
            @php $sourceOfIncomeLastYear = Helper::validate_key_value('other_income_received_last_year_third',$finacial_affairs); @endphp

            <select class="form-control required last_year_third_select convert-text-for-other"
                name="other_income_received_last_year_third">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastYear) !!}

            </select>
            @php $other_income_received_last_year_text_third = Helper::validate_key_value('other_income_received_last_year_text_third',$finacial_affairs); @endphp
            <div class="last_year_third_other_income {{ $sourceOfIncomeLastYear != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_last_year_text_third"
                    value="{{ $other_income_received_last_year_text_third }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control last_year_third_income_input price-field required"
                name="other_amount_last_year_income_third"
                value="{{ Helper::validate_key_value('other_amount_last_year_income_third', $finacial_affairs) }}">
        </div>
        </div>
        <i class="fas fa-trash  text-danger cursor-pointer"
            onclick="$('.last_year_third').addClass('hide-data');$('.last_year_third_add_more').removeClass('hide-data');$('.last_year_third_income_input').val('');$('.last_year_third_select').val(11);$('.last_year_third_other_income').addClass('hide-data');$('.last_year_third_other_income').find('input').val('');"></i>
    </td>
</tr>