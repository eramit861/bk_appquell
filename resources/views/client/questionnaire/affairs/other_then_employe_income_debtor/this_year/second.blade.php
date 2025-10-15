<tr
    class="debtor_income_row this_year_second {{ empty(Helper::validate_key_value('other_amount_this_year_income_second', $finacial_affairs)) ? 'hide-data' : '' }}">
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

            @php $sourceOfIncomeThisYear = Helper::validate_key_value('other_income_received_this_year_second',$finacial_affairs); @endphp

            <select class="form-control second_select required convert-text-for-other"
                name="other_income_received_this_year_second">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeThisYear) !!}

            </select>
            @php $other_income_received_this_year_text_second = Helper::validate_key_value('other_income_received_this_year_text_second',$finacial_affairs); @endphp

            <div class="second_select_other_income {{ $sourceOfIncomeThisYear != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_this_year_text_second"
                    value="{{ $other_income_received_this_year_text_second }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-right">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control second_income_input price-field required"
                name="other_amount_this_year_income_second"
                value="{{ Helper::validate_key_value('other_amount_this_year_income_second', $finacial_affairs) }}">
        </div>
        </div>
        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_this_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue add_more_third"
            onclick="$('.this_year_third').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash  text-right text-danger cursor-pointer"
            onclick="$('.this_year_second').addClass('hide-data');$('.this_year_second_add_more').removeClass('hide-data');$('.second_income_input').val('');$('.second_select').val(11);$('.second_select_other_income').addClass('hide-data');$('.second_select_other_income').find('input').val('');"></i>
    </td>
</tr>
