<!-- Last Year -->
<div class="light-gray-div mt-2">
    <div class="light-gray-box-form-area">
        <h2>&nbsp;&nbsp;<strong
                class="text-c-blue ms-2 me-2">{{ Helper::validate_key_value(1, $taxYears) }}</strong><strong>Last Years
                Income</strong></h2>
        <div class="row gx-3">
            <div class="col-xxl-8 col-xl-6  col-md-8 col-sm-6 col-12">
                <div class="label-div question-area border-0 pb-0">
                    <label class="fs-13px">
                        Source of Income
                        <div class="video-div d-flex ytd-find-this-div align-items-center">
                            <button type="button" class="video-btn fs-13px"
                                onclick="openFlagPopup('sofa-irs-popup-image', '', false);">
                                <div>Where do I find this?</div>
                                <i class="bi bi-patch-question-fill ms-2"></i>
                            </button>
                        </div>
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                        <input type="radio" id="total_amount_last_year_yes" class="d-none"
                            name="total_amount_last_year" required
                            {{ Helper::validate_key_toggle('total_amount_last_year', $finacial_affairs, 1) }}
                            value="1">
                        <label for="total_amount_last_year_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('total_amount_last_year', $finacial_affairs, 1) }}"
                            onclick="allowNegativeValueYTD(this, 1);">Wages</label>

                        <input type="radio" id="total_amount_last_year_no" class="d-none"
                            name="total_amount_last_year" required
                            {{ Helper::validate_key_toggle('total_amount_last_year', $finacial_affairs, 0) }}
                            value="0">
                        <label for="total_amount_last_year_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('total_amount_last_year', $finacial_affairs, 0) }}"
                            onclick="allowNegativeValueYTD(this, 0);">Business</label>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-6 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label> Income</label>
                        <div class="input-group total_amount_this_year_income">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                class="form-control mw-unset {{ Helper::validate_key_negative_class('total_amount_last_year', $finacial_affairs, 0) }} required"
                                name="total_amount_last_year_income"
                                value="{{ Helper::validate_key_value('total_amount_last_year_income', $finacial_affairs) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="add-more-div-bottom">
    <button type="button" id="add-more-residence-form"
        class="btn-new-ui-default py-1 px-2 last_yr_in_first {{ !empty(Helper::validate_key_value('total_amount_last_year_income_extra', $finacial_affairs)) ? 'hide-data' : '' }}"
        onclick="$('.last_year_extra').removeClass('hide-data');$(this).addClass('hide-data');">
        <i class="bi bi-plus-lg"></i>
        Add More Income For This Year
    </button>
</div>

<!-- Last Year Additional -->
<div
    class="light-gray-div last_year_extra {{ empty(Helper::validate_key_value('total_amount_last_year_income_extra', $finacial_affairs)) ? 'hide-data' : '' }}">
    <div class="light-gray-box-form-area">
        <h2>&nbsp;&nbsp;<strong
                class="text-c-blue ms-2 me-2">{{ Helper::validate_key_value(1, $taxYears) }}</strong><strong>Last Year
                Income</strong></h2>
        <button type="button" class="delete-div" title="Delete"
            onclick="
                $('.last_year_extra').addClass('hide-data');
                $('.last_yr_in_first').removeClass('hide-data');
                $('.last_extra_in_input').val('');
                $('#total_amount_last_year_extra_yes').attr('checked',false);
                $('#total_amount_last_year_extra_no').attr('checked',false);
                $(`label.btn-toggle[for='total_amount_last_year_extra_yes']`).removeClass('active');
                $(`label.btn-toggle[for='total_amount_last_year_extra_no']`).removeClass('active');
            ">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-xxl-8 col-xl-6  col-md-8 col-sm-6 col-12">
                <div class="label-div question-area border-0 pb-0">
                    <label class="fs-13px">
                        Source of Income
                        <div class="video-div d-flex ytd-find-this-div align-items-center">
                            <button type="button" class="video-btn fs-13px"
                                onclick="openFlagPopup('sofa-irs-popup-image', '', false);">
                                <div>Where do I find this?</div>
                                <i class="bi bi-patch-question-fill ms-2"></i>
                            </button>
                        </div>
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                        <input type="radio" id="total_amount_last_year_extra_yes" class="d-none"
                            name="total_amount_last_year_extra" required
                            {{ Helper::validate_key_toggle('total_amount_last_year_extra', $finacial_affairs, 1) }}
                            value="1">
                        <label for="total_amount_last_year_extra_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('total_amount_last_year_extra', $finacial_affairs, 1) }}"
                            onclick="allowNegativeValueYTD(this, 1);">Wages</label>

                        <input type="radio" id="total_amount_last_year_extra_no" class="d-none"
                            name="total_amount_last_year_extra" required
                            {{ Helper::validate_key_toggle('total_amount_last_year_extra', $finacial_affairs, 0) }}
                            value="0">
                        <label for="total_amount_last_year_extra_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('total_amount_last_year_extra', $finacial_affairs, 0) }}"
                            onclick="allowNegativeValueYTD(this, 0);">Business</label>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-6 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label> Income</label>
                        <div class="input-group total_amount_this_year_income">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                class="form-control last_extra_in_input mw-unset {{ Helper::validate_key_negative_class('total_amount_last_year_extra', $finacial_affairs, 0) }} required"
                                name="total_amount_last_year_income_extra"
                                value="{{ Helper::validate_key_value('total_amount_last_year_income_extra', $finacial_affairs) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
