<tr
    class="debtor_income_row this_year_forth {{ empty(Helper::validate_key_value('other_amount_this_year_income_forth', $finacial_affairs)) ? 'hide-data' : '' }}">
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

            @php $sourceOfIncomeThisYear = Helper::validate_key_value('other_income_received_this_year_forth',$finacial_affairs); @endphp

            <select class="form-control forth_select required convert-text-for-other"
                name="other_income_received_this_year_forth">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeThisYear) !!}

            </select>
            @php $other_income_received_this_year_text_forth = Helper::validate_key_value('other_income_received_this_year_text_forth',$finacial_affairs); @endphp

            <div class="forth_select_other_income {{ $sourceOfIncomeThisYear != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_this_year_text_forth"
                    value="{{ $other_income_received_this_year_text_forth }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-center">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control forth_income_input price-field required"
                name="other_amount_this_year_income_forth"
                value="{{ Helper::validate_key_value('other_amount_this_year_income_forth', $finacial_affairs) }}">
        </div>
        </div>
        <a href="javascript:void(0)"
            class="{{ !empty(Helper::validate_key_value('other_amount_this_year_income_five', $finacial_affairs)) ? 'hide-data' : '' }} border-bottom-light-blue add_more_five"
            onclick="$('.this_year_five').removeClass('hide-data');$(this).addClass('hide-data');"><i
                class="feather icon-plus mr-0"></i>Add More Income This Year</a>
        <i class="fas fa-trash float-right  text-danger cursor-pointer"
            onclick="$('.this_year_forth').addClass('hide-data');$('.add_more_forth').removeClass('hide-data');$('.forth_income_input').val('');$('.forth_select').val(11);$('.forth_select_other_income').addClass('hide-data');$('.forth_select_other_income').find('input').val('');"></i>
    </td>
</tr>
