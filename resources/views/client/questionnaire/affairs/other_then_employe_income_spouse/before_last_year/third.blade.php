<tr
    class="before_year_spouse_third  {{ empty(Helper::validate_key_value('other_amount_spouse_lastbefore_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }}">
    <x-period_income label1="{{ Helper::validate_key_value(2, $taxYears) }}" />
    <td data="Period">

    </td>
    <td data="Source of income">
        <div class="amount-last-before-year form-group">
            @php $sourceOfIncomeLastBeforeYear_third = Helper::validate_key_value('other_income_received_spouse_lastbefore_year_third',$finacial_affairs); @endphp

            <select class="form-control required before_year_spouse_thrid_select convert-text-for-other"
                name="other_income_received_spouse_lastbefore_year_third">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastBeforeYear_third) !!}

            </select>
            @php $other_income_received_spouse_lastbefore_year_text_third = Helper::validate_key_value('other_income_received_spouse_lastbefore_year_text_third',$finacial_affairs); @endphp

            <div
                class="before_year_spouse_thrid_other_income {{ $sourceOfIncomeLastBeforeYear_third != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_spouse_lastbefore_year_text_third"
                    value="{{ $other_income_received_spouse_lastbefore_year_text_third }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-center">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control price-field before_year_spouse_thrid_income required"
                name="other_amount_spouse_lastbefore_year_income_third"
                value="{{ Helper::validate_key_value('other_amount_spouse_lastbefore_year_income_third', $finacial_affairs) }}">
        </div>
        </div>
        <i class="fas fa-trash float-right  text-danger cursor-pointer"
            onclick="$('.before_year_spouse_third').addClass('hide-data');$('.before_year_spouse_second_add_more').removeClass('hide-data');$('.before_year_spouse_thrid_income').val('');$('.before_year_spouse_thrid_select').val(11);$('.before_year_spouse_thrid_other_income').addClass('hide-data');$('.before_year_spouse_thrid_other_income').find('input').val('');"></i>
    </td>
</tr>
