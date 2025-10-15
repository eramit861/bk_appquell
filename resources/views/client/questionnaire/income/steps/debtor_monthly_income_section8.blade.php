<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <h2 class="text-dark fw-bold"></h2>
        <div class="row gx-3">
            <!--Other sources not already mentioned.Describe:.-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label> Any Other Sources of Income not previously mentioned <br> <span  class="text-c-blue">(Any other money you receive from work, property, or other sources)</span></label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="other_sources" id="other_sources-no" class="d-none required"
                            value="0" {{ Helper::validate_key_toggle('other_sources', $debtormonthlyincome, 0) }}>
                        <label for="other_sources-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('other_sources', $debtormonthlyincome, 0) }}"
                            onclick="GetIsSameDebtoOtherSource('no');">No</label>

                        <input type="radio" name="other_sources" id="other_sources-yes" class="d-none required"
                            value="1" {{ Helper::validate_key_toggle('other_sources', $debtormonthlyincome, 1) }}>
                        <label for="other_sources-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('other_sources', $debtormonthlyincome, 1) }}"
                            onclick="GetIsSameDebtoOtherSource('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('other_sources', $debtormonthlyincome) }}" id="other_sources">
                <div class="main-other-sources">
                <div class="label-div question-area border-0">
                    <label>
                        Do you receive the same amount each month for this income?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Determines if your income remains the same each month or varies.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="same_other_sources_income" id="same_other_sources-no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('same_other_sources_income', $debtormonthlyincome, 0) }}>
                        <label for="same_other_sources-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_other_sources_income', $debtormonthlyincome, 0) }}"
                            onclick="GetDebtoOtherSource('no');">No</label>

                        <input type="radio" name="same_other_sources_income" id="same_other_sources-yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('same_other_sources_income', $debtormonthlyincome, 1) }}>
                        <label for="same_other_sources-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_other_sources_income', $debtormonthlyincome, 1) }}"
                            onclick="GetDebtoOtherSource('yes');">Yes</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="label-div">
                            <div class="form-group">
                                <label class="d-block">Source of income</label>
                                <div class="input-group ">
                                    <input placeholder="Source of income" type="text"
                                        class="input_capitalize form-control no_dup_inp" name="other_options_income"
                                        value="{{ Helper::validate_key_value('other_options_income', $debtormonthlyincome) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Helper::key_hide_show_v2('same_other_sources_income', $debtormonthlyincome))
                    <div class="row" id="same_other_sources_income">
                        @for ($i = 1; $i <= 1; $i++)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <x-singlelabel class="d-block" label="Average (Per month)"></x-singlelabel>
                                        <div class="input-group ">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required"
                                                name="other_sources_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('other_sources_month', $debtormonthlyincome, $i) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @else
                    <div class="row " id="same_other_sources_income">
                        @php
                            $currentDate = date('Y-m-d');
                        @endphp
                        @for ($i = 1; $i < 7; $i++)
                            @php
                                // Calculate the date for the current iteration
                                $month = date('Y-m', strtotime("-$i months", strtotime($currentDate)));
                                $year = date('Y', strtotime("-$i months", strtotime($currentDate)));
                                $month_name = date('F', strtotime("-$i months", strtotime($currentDate)));
                            @endphp
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block"> Month
                                            {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }} </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required no_dup_inp"
                                                name="other_sources_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('other_sources_month', $debtormonthlyincome, $i) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>
