@php
    $checked_no = '';
    $checked_yes = '';
    if ($clentData['client_type'] == Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED || $clentData['client_type'] == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) {
        $checked_no = 'checked';
    }
    if ($clentData['client_type'] == Helper::CLIENT_TYPE_JOINT_MARRIED) {
        $checked_yes = 'checked';
    }
@endphp
<div class="form-border">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group d-inline-block">
                <label for="">
                    <strong class="d-block">{{ __('1. Is this a joint case?') }}
                    </strong>
                </label>
            </div>
            <div class="input-group">
                <input {!! isset($partJ[base64_encode('check1#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check1#0-106J'), $partJ, 'no') : $checked_no !!} name="{{ base64_encode('check1#0-106J') }}" value="no" type="checkbox">
                <label>{{ __('No Go to line 2.') }}</label>
            </div>
            <div class="input-group">
                <input {!! isset($partJ[base64_encode('check1#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check1#0-106J'), $partJ, 'yes') : $checked_yes !!} name="{{ base64_encode('check1#0-106J') }}" value="yes" type="checkbox">
                <label>{{ __('Yes.') }} </label>
            </div>
            <div class="input-group">
                {{ __('Does Debtor 2 live in a separate household?') }}
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check1a#0-106J') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check1a#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check1a#0-106J'), $partJ, 'no') : Helper::validate_key_toggle('live_separately', $expensesInfo, 0) !!}>
                <label>{{ __('No') }}</label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check1a#0-106J') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check1a#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check1a#0-106J'), $partJ, 'yes') : Helper::validate_key_toggle('live_separately', $expensesInfo, 1) !!}>
                <label>{{ __('Yes. Debtor 2 must file Official Form 106J-2, Expenses for
                    Separate
                    Household of Debtor 2') }}</label>
            </div>
        </div>
    </div>
</div>
<div class="form-border">
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="input-group ">
                <label><x-stronglabel class="mb-0" label="2. Do you have dependents?" />
                </label>{{ __('Do not list Debtor 1 and') }}<br>
                {{ __('Debtor 2.') }}<br>
                Do not state the dependents’<br>
                {{ __('names.') }}
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <input name="{{ base64_encode('check2#0-106J') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check2#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check2#0-106J'), $partJ, 'no') : Helper::validate_key_toggle('any_dependents', $expensesInfo, 0) !!}>
                <label>No </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check2#0-106J') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check2#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check2#0-106J'), $partJ, 'yes') : Helper::validate_key_toggle('any_dependents', $expensesInfo, 1) !!}>
                <label>{{ __('Yes.') }} </label>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-6 col-xxl-6">
                    <div class="input-group column-heading">
                        <label><strong class="mb-0">{{ __('Dependent’s relationship to
                                Debtor 1 or Debtor 2') }}
                            </strong>
                        </label>
                    </div>
                </div>

                <div class="col-md-6 col-xxl-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group column-heading">
                                <label><strong class="mb-0 font-lg-10">{{ __('Dependent’s
                                        age') }}
                                    </strong>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group column-heading">
                                <label><strong class="mb-0 font-lg-10">{{ __('Does dependent live
                                        with you?') }}
                                    </strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                @if(!empty($expensesInfo['dependent_relationship']))
                    @for($i = 0; $i < count($expensesInfo['dependent_relationship']); $i++)
                        @php
                            if ($i == 0) {
                                $add = 'a';
                            } elseif ($i == 1) {
                                $add = 'b';
                            } elseif ($i == 2) {
                                $add = 'c';
                            } elseif ($i == 3) {
                                $add = 'd';
                            } elseif ($i == 4) {
                                $add = 'e';
                            }
                        @endphp


                <div class="col-md-6 col-xxl-6">
                    <div class="input-group">
                        <input name="{{ base64_encode('Dependant Relation 2' . $add . '-106J') }}" style="width:auto;" type="text" value="{{ $partJ[base64_encode('Dependant Relation 2' . $add . '-106J')] ?? $expensesInfo['dependent_relationship'][$i] }}" class="form-control w-100">
                    </div>
                </div>
                <div class="col-md-6 col-xxl-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input name="{{ base64_encode('Dependant age 2' . $add . '-106J') }}" style="width:60px;" type="text" value="{{ $partJ[base64_encode('Dependant age 2' . $add . '-106J')] ?? $expensesInfo['dependent_age'][$i] }}" class="form-control w-100">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <input name="{{ base64_encode('check2' . $add . '#0-106J') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check2' . $add . '#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check2' . $add . '#0-106J'), $partJ, 'no') : Helper::validate_key_loop_toggle('dependent_live_with', $expensesInfo, 0, $i) !!}>
                                <label for="">{{ __('No') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="{{ base64_encode('check2' . $add . '#0-106J') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check2' . $add . '#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check2' . $add . '#0-106J'), $partJ, 'yes') : Helper::validate_key_loop_toggle('dependent_live_with', $expensesInfo, 1, $i) !!}>
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
                <label for=""><x-stronglabel class="d-block" label="3. Do your expenses include
                        expenses of people other than
                        yourself and your dependents?" />
                </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check3#1-106J') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check3#1-106J')]) ? Helper::validate_key_toggle(base64_encode('check3#1-106J'), $partJ, 'no') : Helper::validate_key_toggle('live_separately', $expensesInfo, 0) !!}>
                <label>No </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check3#1-106J') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check3#1-106J')]) ? Helper::validate_key_toggle(base64_encode('check3#1-106J'), $partJ, 'yes') : Helper::validate_key_toggle('live_separately', $expensesInfo, 1) !!}>
                <label>{{ __('Yes.') }} </label>
            </div>
        </div>
    </div>
</div>
