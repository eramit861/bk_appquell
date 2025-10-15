<tr
    class="this_year_spouse_second {{ empty(Helper::validate_key_value('other_amount_spouse_this_year_income_second', $finacial_affairs)) ? 'hide-data' : '' }}">
    <td data="Period">
        <div class="form-group">
            <label>{{ Helper::validate_key_value(0, $taxYears) }}</label>
        </div>
    </td>
    <td data="Period">
        <div class="form-group">
            <strong class="text-c-blue border-dotted">YTD:</strong>
        </div>
    </td>
    <td data="Source of income">
        <div class="amount-this-year form-group">
            @php $sourceOfIncomeThisYear_second = Helper::validate_key_value('other_income_received_spouse_this_year_second',$finacial_affairs); @endphp
            <select class="form-control  spouse_this_year_second_select required convert-text-for-other"
                name="other_income_received_spouse_this_year_second">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeThisYear_second) !!}

            </select>
            @php $other_income_received_spouse_this_year_text_second = Helper::validate_key_value('other_income_received_spouse_this_year_text_second',$finacial_affairs); @endphp

            <div
                class="spouse_this_year_second_other_income {{ $sourceOfIncomeThisYear_second != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_spouse_this_year_text_second"
                    value="{{ $other_income_received_spouse_this_year_text_second }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control price-field spouse_this_year_second_income required"
                name="other_amount_spouse_this_year_income_second"
                value="{{ Helper::validate_key_value('other_amount_spouse_this_year_income_second', $finacial_affairs) }}">
        </div>
        </div>

        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_spouse_this_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue this_year_spouse_third_add_more "
            onclick="$('.this_year_spouse_third').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash  text-right text-danger cursor-pointer"
            onclick="$('.this_year_spouse_second').addClass('hide-data');$('.this_year_spouse_second_add_more').removeClass('hide-data');$('.spouse_this_year_second_income').val('');$('.spouse_this_year_second_select').val(11);$('.spouse_this_year_second_other_income').addClass('hide-data');$('.spouse_this_year_second_other_income').find('input').val('');"></i>
    </td>
</tr>
