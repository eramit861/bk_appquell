<div class="form-border">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group d-inline-block">
                <label for="">
                    <strong class="d-block">{{ __('1. Do you and Debtor 1 maintain separate households?') }}
                    </strong>
                </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check1a') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check1a')])
                    ? Helper::validate_key_toggle(base64_encode('check1a'), $partJ, 'no')
                    : Helper::validate_key_toggle('live_separately', $expensesInfo, 0) !!}>
                <label>{{ __('No. Do not complete this form.') }}</label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check1a') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check1a')])
                    ? Helper::validate_key_toggle(base64_encode('check1a'), $partJ, 'yes')
                    : Helper::validate_key_toggle('live_separately', $expensesInfo, 1) . (isset($expensesInfo) ? 'checked' : '') !!}>
                <label>{{ __('Yes.') }} </label>
            </div>
        </div>
    </div>
</div>
<div class="form-border">
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="input-group ">
                <label><x-stronglabel class="mb-0" label="2. Do you have dependents?" />
                </label>{{ __('Do not list Debtor 1 but list all other dependents of Debtor 2 regardless of whether listed as a dependent of Debtor 1 on Schedule J.') }}
                <br>{{ __('Do not state the dependents’') }}<br>{{ __('names.') }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <input name="{{ base64_encode('check2') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check2')])
                    ? Helper::validate_key_toggle(base64_encode('check2'), $partJ, 'no')
                    : Helper::validate_key_toggle('any_dependents', $expensesInfo, 0) !!}>
                <label>No </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check2') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check2')])
                    ? Helper::validate_key_toggle(base64_encode('check2'), $partJ, 'yes')
                    : Helper::validate_key_toggle('any_dependents', $expensesInfo, 1) !!}>
                <label>{{ __('Yes.') }} </label>
                <div class="input-group">
                    <label>{{ __('Fill out this information for each dependent') }}</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group column-heading">
                        <label>
                            <strong
                                class="mb-0">{{ __('Dependent’s relationship to Debtor 1 or Debtor 2') }}</strong>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group column-heading">
                                <label>
                                    <strong class="mb-0 font-lg-10">{{ __('Dependent’s age') }}</strong>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group column-heading">
                                <label>
                                    <strong class="mb-0 font-lg-10">{{ __('Does dependent live with you?') }}</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (!empty($expensesInfo['dependent_relationship']))
                    @for ($i = 0; $i < count($expensesInfo['dependent_relationship']); $i++)
                        @php
                            $dependent = '';
                            if ($i == 0) {
                                $dependent = 'a';
                            } elseif ($i == 1) {
                                $dependent = 'b';
                            } elseif ($i == 2) {
                                $dependent = 'c';
                            } elseif ($i == 3) {
                                $dependent = 'd';
                            } elseif ($i == 4) {
                                $dependent = 'e';
                            }
                        @endphp
                        <div class="col-md-6">
                            <div class="input-group">
                                <input name="{{ base64_encode('Dependant Relation 2' . $dependent) }}" type="text"
                                    value="{{ $partJ[base64_encode('Dependant Relation 2' . $dependent)] ?? $expensesInfo['dependent_relationship'][$i] }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input name="{{ base64_encode('Dependant age 2' . $dependent) }}"
                                            type="text"
                                            value="{{ $partJ[base64_encode('Dependant age 2' . $dependent)] ?? $expensesInfo['dependent_age'][$i] }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="{{ base64_encode('check2' . $dependent) }}" value="no"
                                            type="checkbox" {!! isset($partJ[base64_encode('check2')])
                                                ? Helper::validate_key_toggle(base64_encode('check2'), $partJ, 'no')
                                                : Helper::validate_key_loop_toggle('dependent_live_with', $expensesInfo, 0, $i) !!}>
                                        <label for="">{{ __('No') }}</label>
                                    </div>
                                    <div class="input-group">
                                        <input name="{{ base64_encode('check2' . $dependent) }}" value="yes"
                                            type="checkbox" {!! isset($partJ[base64_encode('check2')])
                                                ? Helper::validate_key_toggle(base64_encode('check2'), $partJ, 'yes')
                                                : Helper::validate_key_loop_toggle('dependent_live_with', $expensesInfo, 1, $i) !!}>
                                        <label for="">{{ __('Yes') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-border mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group d-inline-block">
                <label for=""><x-stronglabel class="d-block"
                        label="3. Do your expenses include expenses of people other than yourself and your dependents?" />
                </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check3') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check3')])
                    ? Helper::validate_key_toggle(base64_encode('check3'), $partJ, 'no')
                    : 'checked' !!}>
                <label>No </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check3') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check3')])
                    ? Helper::validate_key_toggle(base64_encode('check3'), $partJ, 'yes')
                    : '' !!}>
                <label>{{ __('Yes.') }} </label>
            </div>
        </div>
    </div>
</div>
