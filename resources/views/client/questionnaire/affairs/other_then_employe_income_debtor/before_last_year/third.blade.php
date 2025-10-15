<tr
    class="before_year_third {{ empty(Helper::validate_key_value('other_amount_lastbefore_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }}">
    <td data="Period">
        <div class="form-group">
            <label>{{ Helper::validate_key_value(2, $taxYears) }}</label>
        </div>
    </td>
    <td data="Period">

    </td>
    <td data="Source of income">
        <div class="amount-last-before-year form-group">
            @php $sourceOfIncomeLastBeforeYear_third = Helper::validate_key_value('other_income_received_lastbefore_year_third',$finacial_affairs); @endphp

            <select class="form-control required before_year_third_select convert-text-for-other"
                name="other_income_received_lastbefore_year_third">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastBeforeYear_third) !!}

            </select>
            @php $other_income_received_lastbefore_year_text_third = Helper::validate_key_value('other_income_received_lastbefore_year_text_third',$finacial_affairs); @endphp

            <div
                class="before_year_third_other_income {{ $sourceOfIncomeLastBeforeYear_third != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_lastbefore_year_text_third"
                    value="{{ $other_income_received_lastbefore_year_text_third }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control lastbefore_year_income_third price-field required"
                name="other_amount_lastbefore_year_income_third"
                value="{{ Helper::validate_key_value('other_amount_lastbefore_year_income_third', $finacial_affairs) }}">
        </div>
        </div>
        <i class="fas fa-trash   text-danger cursor-pointer"
            onclick="$('.before_year_third').addClass('hide-data');$('.before_year_third_add_more').removeClass('hide-data');$('.lastbefore_year_income_third').val('');$('.before_year_third_select').val(11);$('.before_year_third_other_income').addClass('hide-data');$('.before_year_third_other_income').find('input').val('');"></i>
    </td>
</tr>
