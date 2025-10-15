<tr class="in_extra_1 {{ empty(Helper::validate_key_value('total_amount_this_year_income_extra', $finacial_affairs)) ? 'hide-data' : '' }}">
    <td data="Period">
        <div class="form-group">
            {{ Helper::validate_key_value(0, $taxYears) }}
        </div>
    </td>
    <td data="Period">
        <div class="form-group">
            <strong class="text-c-blue border-dotted">YTD:</strong>
        </div>
    </td>

    <td data="Source of income">
        <div class="d-block text-left"><a href="javascript:void(0)" onclick="openFlagPopup('sofa-irs-popup-image-ytd', '', false);" class="text-c-blue small-font">Where do I find this? <img alt="Quick Tip" src="{{url('assets/img/quick-tip.jpg')}}" width="28px" /></a></div>
        <div class="amount-this-year d-flex  form-group">
            <div class="d-inline radio-primary ">
                <input type="radio" onchange="allowNegativeValue(this)" id="total_amount_this_year_extra_yes" class="total_amount_this_year_extra_radio"
                    name="total_amount_this_year_extra" value="1" required
                    {{ Helper::validate_key_toggle('total_amount_this_year_extra', $finacial_affairs, 1) }}>
                <label for="total_amount_this_year_extra_yes" class="cr text-c-black ">Wages</label>
            </div>

            <div class="d-inline radio-primary ">
                <input type="radio" onchange="allowNegativeValue(this)" id="total_amount_this_year_extra_no" class="total_amount_this_year_extra_radio"
                    name="total_amount_this_year_extra" value="0" required
                    {{ Helper::validate_key_toggle('total_amount_this_year_extra', $finacial_affairs, 0) }}>
                <label for="total_amount_this_year_extra_no" class="cr text-c-black">Business</label>
            </div>
        </div>
    </td>
    <td data="Gross income" class="text-center p-relative">
        <div class="total_amount_this_year_income form-group">
            <x-dsmi />
            <input type="number" class="form-control {{ Helper::validate_key_negative_class('total_amount_this_year_extra', $finacial_affairs, 0) }}  extra_in_input required"
                name="total_amount_this_year_income_extra"
                value="{{ Helper::validate_key_value('total_amount_this_year_income_extra', $finacial_affairs) }}">

        </div>
        </div>
        <i class="fas absolution-income-icon  fa-trash float-right  text-danger cursor-pointer"
            onclick="$('.in_extra_1').addClass('hide-data');$('.to_in_first').removeClass('hide-data');$('.extra_in_input').val('');$('.total_amount_this_year_extra_radio').attr('checked',false);"></i>
    </td>
</tr>