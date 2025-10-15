<tr
    class="last_year_spouse_third {{ empty(Helper::validate_key_value('other_amount_spouse_last_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }}">
    <x-period_income label1="{{ Helper::validate_key_value(1, $taxYears) }}" />
    <td data="Period">

    </td>
    <td data="Source of income">

        <div class="amount-last-year form-group">
            @php $sourceOfIncomeLastYear_third = Helper::validate_key_value('other_income_received_spouse_last_year_third',$finacial_affairs); @endphp

            <select class="form-control last_yr_third_select required convert-text-for-other"
                name="other_income_received_spouse_last_year_third">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastYear_third) !!}

            </select>
            @php $other_income_received_spouse_last_year_text_third = Helper::validate_key_value('other_income_received_spouse_last_year_text_third',$finacial_affairs); @endphp

            <div class="last_yr_third_other_income {{ $sourceOfIncomeLastYear_third != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize other form-control required"
                    name="other_income_received_spouse_last_year_text_third"
                    value="{{ $other_income_received_spouse_last_year_text_third }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-center">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control last_yr_third_income price-field required"
                name="other_amount_spouse_last_year_income_third"
                value="{{ Helper::validate_key_value('other_amount_spouse_last_year_income_third', $finacial_affairs) }}">
        </div>
        </div>
        <i class="fas fa-trash float-right  text-danger cursor-pointer"
            onclick="$('.last_year_spouse_third').addClass('hide-data');$('.last_year_spouse_second_add_more').removeClass('hide-data');$('.last_yr_third_income').val('');$('.last_yr_third_select').val(11);$('.last_yr_third_other_income').addClass('hide-data');$('.last_yr_third_other_income').find('input').val('');"></i>
    </td>
</tr>
