<tr
    class="debtor_income_row this_year_third {{ empty(Helper::validate_key_value('other_amount_this_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }}">
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

            @php $sourceOfIncomeThisYear = Helper::validate_key_value('other_income_received_this_year_third',$finacial_affairs); @endphp

            <select class="form-control third_select required convert-text-for-other"
                name="other_income_received_this_year_third">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeThisYear) !!}

            </select>
            @php $other_income_received_this_year_text_third = Helper::validate_key_value('other_income_received_this_year_text_third',$finacial_affairs); @endphp

            <div class="third_select_other_income {{ $sourceOfIncomeThisYear != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_this_year_text_third"
                    value="{{ $other_income_received_this_year_text_third }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-center">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control third_income_input price-field required"
                name="other_amount_this_year_income_third"
                value="{{ Helper::validate_key_value('other_amount_this_year_income_third', $finacial_affairs) }}">
        </div>
        </div>
        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_this_year_income_forth', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue add_more_forth"
            onclick="$('.this_year_forth').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash float-right  text-danger cursor-pointer"
            onclick="$('.this_year_third').addClass('hide-data');$('.add_more_third').removeClass('hide-data');$('.third_income_input').val('');$('.third_select').val(11);$('.third_select_other_income').addClass('hide-data');$('.third_select_other_income').find('input').val('');"></i>
    </td>
</tr>