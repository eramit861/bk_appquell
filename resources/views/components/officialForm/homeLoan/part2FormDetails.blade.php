<div class="row mt-3">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-12">
                <input name="{{ base64_encode($fieldName['noBox']) }}" class="square" readonly value="2.{{ ($i > 1) ? $i : 1 }}">
                <div class="input-group">
                    <label>{{ __('Name') }} </label>
                    <input name="{{ base64_encode($fieldName['name']) }}" type="text" value="{{ $partDpart2add[base64_encode($fieldName['name'])] ?? Helper::validate_key_array_value('codebtor_creditor_name', $codebtor1List, $k) }}" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <label>{{ __('Street') }}</label>
                            <input name="{{ base64_encode($fieldName['street']) }}" type="text" value="{{ $partDpart2add[base64_encode($fieldName['street'])] ?? Helper::validate_key_array_value('codebtor_creditor_name_addresss', $codebtor1List, $k) }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="input-group">
                            <label>{{ __('City') }}</label>
                            <input name="{{ base64_encode($fieldName['city']) }}" type="text" value="{{ $partDpart2add[base64_encode($fieldName['city'])] ?? Helper::validate_key_array_value('codebtor_creditor_city', $codebtor1List, $k) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2 pl-0 pr-0">
                        <div class="input-group">
                            <label>{{ __('State') }}</label>
                            <input name="{{ base64_encode($fieldName['state']) }}" type="text" value="{{ $partDpart2add[base64_encode($fieldName['state'])] ?? Helper::validate_key_array_value('codebtor_creditor_state', $codebtor1List, $k) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <label>{{ __('Zip Code') }}</label>
                            <input name="{{ base64_encode($fieldName['zip']) }}" type="text" value="{{ $partDpart2add[base64_encode($fieldName['zip'])] ?? Helper::validate_key_array_value('codebtor_creditor_zip', $codebtor1List, $k) }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 mt-4">
        <div class="input-group">
            <label for="">{{ __('On which line in Part 1 did you enter the creditor?') }}</label>
            <input name="{{ base64_encode($fieldName['lineCreditor']) }}" type="text" value="{{ $partDpart2add[base64_encode($fieldName['lineCreditor'])] ?? Helper::validate_key_array_value('fromLine', $codebtor1List, $k) }}" class="form-control">
        </div>
        <div class="input-group">
            <label for="">{{ __('Last 4 digits of acct #') }}</label>
            <input name="{{ base64_encode($fieldName['Last4Digit']) }}" type="text" value="{{ $partDpart2add[base64_encode($fieldName['Last4Digit'])] ?? Helper::validate_key_array_value('account_number', $codebtor1List, $k) }}" class="form-control">
        </div>
    </div>
</div>
