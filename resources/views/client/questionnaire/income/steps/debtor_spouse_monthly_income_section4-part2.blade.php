<div class="col-12 mt-2">
    <div class="light-gray-div light-gray-div-kr mt-2">
        <div class="row gx-3">
            <!--Interest, dividends, and royalties.-->
            <div class="col-12 ">
                <div class="label-div question-area">
                    <label>
                        Interest, Dividends, and/or Royalties
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="joints_royalties" id="joints_royalties-no" class="d-none required"
                               value="0" {{ Helper::validate_key_toggle('joints_royalties', $debtorspousemonthlyincome, 0) }}>
                        <label for="joints_royalties-no"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_royalties', $debtorspousemonthlyincome, 0) }}"
                               onclick="isSameJointRoyalties('no');">No</label>

                        <input type="radio" name="joints_royalties" id="joints_royalties-yes" class="d-none required"
                               value="1" {{ Helper::validate_key_toggle('joints_royalties', $debtorspousemonthlyincome, 1) }}>
                        <label for="joints_royalties-yes"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_royalties', $debtorspousemonthlyincome, 1) }}"
                               onclick="isSameJointRoyalties('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('joints_royalties', $debtorspousemonthlyincome) }}"
                 id="joints_royalties">
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
                            <input type="radio" name="joints_same_royalty_income" id="joints_same_royalty_income-no"
                                   class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_same_royalty_income', $debtorspousemonthlyincome, 0) }}>
                            <label for="joints_same_royalty_income-no"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_royalty_income', $debtorspousemonthlyincome, 0) }}"
                                   onclick="GetJointRoyalties('no');">No</label>

                            <input type="radio" name="joints_same_royalty_income" id="joints_same_royalty_income-yes"
                                   class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_same_royalty_income', $debtorspousemonthlyincome, 1) }}>
                            <label for="joints_same_royalty_income-yes"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_royalty_income', $debtorspousemonthlyincome, 1) }}"
                                   onclick="GetJointRoyalties('yes');">Yes</label>
                        </div>
                    </div>

                    @if(Helper::key_hide_show_v2('joints_same_royalty_income', $debtorspousemonthlyincome))
                        <div class="row" id="joints_same_royalty_income">
                            @for ($i = 1; $i <= 1; $i++)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label class="d-block">Average (Per month) </label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control price-field required no_dup_inp"
                                                       name="joints_royalties_month[{{ $i }}]"
                                                       value="{{ Helper::validate_key_loop_value('joints_royalties_month', $debtorspousemonthlyincome, $i) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="row" id="joints_same_royalty_income">
                            @php
                                $currentDate = date('Y-m-d');
                            @endphp
                                // Loop through the last 6 months
                            @for ($i = 1; $i <= 6; $i++)
                                @php
                                    // Calculate the date for the current iteration
                                    $month = date('Y-m', strtotime("-$i months", strtotime($currentDate)));
                                    $year = date('Y', strtotime("-$i months", strtotime($currentDate)));
                                    $month_name = date("F", strtotime("-$i months", strtotime($currentDate)));
                                @endphp
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label class="d-block"> Month
                                                    {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }} </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control price-field required no_dup_inp"
                                                           name="joints_royalties_month[{{ $i }}]"
                                                           value="{{ Helper::validate_key_loop_value('joints_royalties_month', $debtorspousemonthlyincome, $i) }}" />
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
