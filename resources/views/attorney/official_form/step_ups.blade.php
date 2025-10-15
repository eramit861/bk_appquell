<div class="chapter13 col-md-4 steup_from">
                <div class="chapter13 popup-in my-4">
                    <div class="chapter13 pop-up d-flex align-items-center mb-2">
                        <div class="chapter13 dolor">
                            <label>Step up # <span class="stepup_count">{{$k+1}}</span> - </label>
                        </div>
                        <div class="chapter13 input-group d-flex">
                            <div class="chapter13 input-group-append">
                                <span class="input-group-in d-flex align-items-center" id="basic-addon2">$</span>
                            </div>
                            <input name="stepup_price[{{$k}}]" type="text" onkeyup="formatCurrency($(this))" value="<?php echo Helper::validate_key_loop_value('stepup_price', $chapterPlanData, $k);?>" class="price-field stepup_price form-control text-line">
                            <span class="steptext"></span>
                           
                        </div>
                    </div>
                    <div class="chapter13 d-flex align-items-center">
                        <label>{{ __('Reason:') }} </label>
                        <div class="chapter13 select-box">
                            <select class="form-control stepup_reason" id="sel1" name="stepup_reason[{{$k}}]">
                                <option value="9"  <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 9); ?>>{{ __('Mortgage Loan Pay Off') }}</option>
                                <option value="0" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 0); ?>>{{ __('Vehicle 1 Paid Off') }}</option>
                                <option value="1" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 1); ?>>{{ __('Vehicle 2 Paid Off') }}</option>
                                <option value="2" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 2); ?>>{{ __('Vehicle 3 Paid Off') }}</option>
                                <option value="3" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 3); ?>>{{ __('Vehicle 4 Paid Off') }}</option>
                                <option value="4" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 4); ?>>{{ __('Recreational 1 Paid Off') }}</option>
                                <option value="5" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 5); ?>>{{ __('Recreational 2 Paid Off') }}</option>
                                <option value="6" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 6); ?>>{{ __('Vehicles Paid Off') }}</option>
                                <option value="6" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 10); ?>>{{ __('Mortgages and Vehicles Paid Off') }}</option>
                                <option value="7" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 7); ?>>{{ __('Other Debt Paid Off') }}</option>
                                <option value="8" <?php echo Helper::validate_key_option_loop('stepup_reason', $chapterPlanData, $k, 8); ?>>{{ __('Retirement Loan Pay Off') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            