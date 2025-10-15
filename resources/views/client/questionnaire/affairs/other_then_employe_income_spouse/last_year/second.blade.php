<tr
    class="last_year_spouse_second {{ empty(Helper::validate_key_value('other_amount_spouse_last_year_income_second', $finacial_affairs)) ? 'hide-data' : '' }}">
    <x-period_income label1="{{ Helper::validate_key_value(1, $taxYears) }}" />
    <td data="Period">

    </td>
    <td data="Source of income">

        <div class="amount-last-year form-group">
            @php $sourceOfIncomeLastYear_second = Helper::validate_key_value('other_income_received_spouse_last_year_second',$finacial_affairs); @endphp

            <select class="form-control required last_year_spouse_second_select convert-text-for-other"
                name="other_income_received_spouse_last_year_second">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastYear_second) !!}

            </select>
            @php $other_income_received_spouse_last_year_text_second = Helper::validate_key_value('other_income_received_spouse_last_year_text_second',$finacial_affairs); @endphp

            <div
                class="last_year_spouse_second_other_income {{ $sourceOfIncomeLastYear_second != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize other form-control required"
                    name="other_income_received_spouse_last_year_text_second"
                    value="{{ $other_income_received_spouse_last_year_text_second }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control price-field required"
                name="other_amount_spouse_last_year_income_second"
                value="{{ Helper::validate_key_value('other_amount_spouse_last_year_income_second', $finacial_affairs) }}">
        </div>
        </div>
        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_spouse_last_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue last_year_spouse_second_add_more "
            onclick="$('.last_year_spouse_third').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash  text-right text-danger cursor-pointer"
            onclick="$('.last_year_spouse_second ').addClass('hide-data');$('.last_year_spouse_second_add_more').removeClass('hide-data');$('.last_year_second_income_input').val('');$('.last_year_spouse_second_select').val(11);$('.last_year_spouse_second_other_income').addClass('hide-data');$('.last_year_spouse_second_other_income').find('input').val('');"></i>
    </td>
</tr>
