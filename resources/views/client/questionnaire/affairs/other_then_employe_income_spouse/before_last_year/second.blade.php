<tr
    class="before_year_spouse_second {{ empty(Helper::validate_key_value('other_amount_spouse_lastbefore_year_income_second', $finacial_affairs)) ? 'hide-data' : '' }}">
    <x-period_income label1="{{ Helper::validate_key_value(2, $taxYears) }}" />
    <td data="Period">

    </td>
    <td data="Source of income">
        <div class="amount-last-before-year form-group">
            @php $sourceOfIncomeLastBeforeYear_second = Helper::validate_key_value('other_income_received_spouse_lastbefore_year_second',$finacial_affairs); @endphp

            <select class="form-control before_year_second_select required convert-text-for-other"
                name="other_income_received_spouse_lastbefore_year_second">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeLastBeforeYear_second) !!}

            </select>
            @php $other_income_received_spouse_lastbefore_year_text_second = Helper::validate_key_value('other_income_received_spouse_lastbefore_year_text_second',$finacial_affairs); @endphp

            <div
                class="before_year_second_other_income {{ $sourceOfIncomeLastBeforeYear_second != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_spouse_lastbefore_year_text_second"
                    value="{{ $other_income_received_spouse_lastbefore_year_text_second }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control before_year_second_income_input price-field  required"
                name="other_amount_spouse_lastbefore_year_income_second"
                value="{{ Helper::validate_key_value('other_amount_spouse_lastbefore_year_income_second', $finacial_affairs) }}">
        </div>
        </div>
        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_spouse_lastbefore_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue before_year_spouse_second_add_more"
            onclick="$('.before_year_spouse_third').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash  text-right text-danger cursor-pointer"
            onclick="$('.before_year_spouse_second').addClass('hide-data');$('.before_year_spouse_second_add_more').removeClass('hide-data');$('.before_year_second_income_input').val('');$('.before_year_second_select').val(11);$('.before_year_second_other_income').addClass('hide-data');$('.before_year_second_other_income').find('input').val('');"></i>
    </td>
</tr>
