<tr
    class="debtor_income_row this_year_six {{ empty(Helper::validate_key_value('other_amount_this_year_income_six', $finacial_affairs)) ? 'hide-data' : '' }}">
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

            @php $sourceOfIncomeThisYear = Helper::validate_key_value('other_income_received_this_year_six',$finacial_affairs); @endphp

            <select class="form-control six_select required convert-text-for-other"
                name="other_income_received_this_year_six">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeThisYear) !!}

            </select>
            @php $other_income_received_this_year_text_six = Helper::validate_key_value('other_income_received_this_year_text_six',$finacial_affairs); @endphp

            <div class="six_select_other_income {{ $sourceOfIncomeThisYear != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_this_year_text_six"
                    value="{{ $other_income_received_this_year_text_six }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-center">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control six_income_input price-field required"
                name="other_amount_this_year_income_six"
                value="{{ Helper::validate_key_value('other_amount_this_year_income_six', $finacial_affairs) }}">
        </div>
        </div>

        <i class="fas fa-trash float-right  text-danger cursor-pointer"
            onclick="$('.this_year_six').addClass('hide-data');$('.add_more_six').removeClass('hide-data');$('.six_income_input').val('');$('.six_select').val(11);$('.six_select_other_income').addClass('hide-data');$('.six_select_other_income').find('input').val('');"></i>
    </td>
</tr>
