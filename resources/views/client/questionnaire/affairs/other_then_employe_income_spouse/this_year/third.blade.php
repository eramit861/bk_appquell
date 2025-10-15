<tr
    class="this_year_spouse_third  {{ empty(Helper::validate_key_value('other_amount_spouse_this_year_income_third', $finacial_affairs)) ? 'hide-data' : '' }}">
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
            @php $sourceOfIncomeThisYear_third = Helper::validate_key_value('other_income_received_spouse_this_year_third',$finacial_affairs); @endphp
            <select class="form-control required this_year_spouse_third_select convert-text-for-other"
                name="other_income_received_spouse_this_year_third">
                {!! Helper::getSourceOfIncomeSelection($sourceOfIncomeThisYear_third) !!}

            </select>
            @php $other_income_received_spouse_this_year_text_third = Helper::validate_key_value('other_income_received_spouse_this_year_text_third',$finacial_affairs); @endphp

            <div
                class="this_year_spouse_third_other_income {{ $sourceOfIncomeThisYear_third != -1 ? 'hide-data' : '' }}">
                <input type="text" class="input_capitalize form-control required"
                    name="other_income_received_spouse_this_year_text_third"
                    value="{{ $other_income_received_spouse_this_year_text_third }}">
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-center">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control this_year_spouse_third_income price-field required"
                name="other_amount_spouse_this_year_income_third"
                value="{{ Helper::validate_key_value('other_amount_spouse_this_year_income_third', $finacial_affairs) }}">
        </div>
        </div>
        <i class="fas fa-trash float-right  text-danger cursor-pointer"
            onclick="$('.this_year_spouse_third').addClass('hide-data');$('.this_year_spouse_third_add_more').removeClass('hide-data');$('.this_year_spouse_third_income').val('');$('.this_year_spouse_third_select').val(11);$('.this_year_spouse_third_other_income').addClass('hide-data');$('.this_year_spouse_third_other_income').find('input').val('');"></i>
    </td>
</tr>
