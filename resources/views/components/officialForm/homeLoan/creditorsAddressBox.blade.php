<div class="row">
    <div class="col-md-12">
        <div class="input-group">
            <label>{{ __('Creditor’s Name') }} </label>
            <input name="{{ base64_encode('Creditors Name' . ($k == 1 ? '' : '_' . $k)) }}" type="text" value="{{ $partDpart1add1[base64_encode('Creditors Name' . ($k == 1 ? '' : '_' . $k))] ?? Helper::validate_key_value('creditor_name', $creditor) }}" class="form-control">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <label>{{ __('Address') }}</label>
                    <input name="{{ base64_encode('Street' . ($k == 1 ? '' : '_' . $k)) }}" type="text" value="{{ $partDpart1add1[base64_encode('Street' . ($k == 1 ? '' : '_' . $k))] ?? Helper::validate_key_value('creditor_name_addresss', $creditor) }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group">
                    <label>{{ __('City') }}</label>
                    <input name="{{ base64_encode('2' . ($k == 1 ? '' : '_' . $k)) }}" type="text" value="{{ $partDpart1add1[base64_encode('2' . ($k == 1 ? '' : '_' . $k))] ?? Helper::validate_key_value('creditor_city', $creditor) }}" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <label>{{ __('State') }}</label>
                    <input name="{{ base64_encode('3' . ($k == 1 ? '' : '_' . $k)) }}" type="text" value="{{ $partDpart1add1[base64_encode('3' . ($k == 1 ? '' : '_' . $k))] ?? Helper::validate_key_value('creditor_state', $creditor) }}" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <label>{{ __('Zip Code') }}</label>
                    <input name="{{ base64_encode('4' . ($k == 1 ? '' : '_' . $k)) }}" type="text" value="{{ $partDpart1add1[base64_encode('4' . ($k == 1 ? '' : '_' . $k))] ?? Helper::validate_key_value('creditor_zip', $creditor) }}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label><strong>{{ __('Date debt was incurred') }} </strong></label>
                    @php
                        $debt_incurred_sec = $partDpart1add1[base64_encode('Date debt was incurred' . ($i == 1 ? '' : '_' . $i) . $formType)] ?? Helper::validate_key_value('debt_incurred_date', $creditor);
                        if (strtotime($debt_incurred_sec) != false && strlen($debt_incurred_sec) > 7) {
                            $debt_incurred_sec = date('m/Y', strtotime($debt_incurred_sec));
                        }
                    @endphp
                    <input name="{{ base64_encode('Date debt was incurred' . ($i == 1 ? '' : '_' . $i) . $formType) }}" type="text" value="{{ $debt_incurred_sec }}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label><strong>{{ __('Last 4 digits of acct #') }}</strong> </label>
                    <input name="{{ base64_encode($nameArray['last4Digits']) }}" type="text" value="{{ $partDpart1add1[base64_encode($nameArray['last4Digits'])] ?? Helper::validate_key_value('account_number', $creditor) }}" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-group">
                    <label><strong>{{ __('Nature of lien:') }}</strong> {{ __(': Chec Check all that apply') }}</label>
                </div>
                <div class="input-group">
                    <input name="{{ base64_encode($nameArray['anAgreementYouMade']) }}" value="On" type="checkbox" {!! isset($partDpart1add1[base64_encode($nameArray['anAgreementYouMade'])]) ? Helper::validate_key_toggle(base64_encode($nameArray['anAgreementYouMade']), $partDpart1add1, 'On') : Helper::validate_key_toggle('property_type', $creditor, 'd') !!}>
                    <label>{{ __('An agreement you made (such as mortgage or secured car loan)') }} </label>
                </div>
                <div class="input-group">
                    <input name="{{ base64_encode($nameArray['statutoryLien']) }}" value="On" type="checkbox" {!! isset($partDpart1add1[base64_encode($nameArray['statutoryLien'])]) ? Helper::validate_key_toggle(base64_encode($nameArray['statutoryLien']), $partDpart1add1, 'On') : '' !!}>
                    <label>{{ __('Statutory lien (such as tax lien, mechanic’s lien)') }} </label>
                </div>
                <div class="input-group">
                    <input name="{{ base64_encode($nameArray['judgementLien']) }}" value="On" type="checkbox" {!! isset($partDpart1add1[base64_encode($nameArray['judgementLien'])]) ? Helper::validate_key_toggle(base64_encode($nameArray['judgementLien']), $partDpart1add1, 'On') : '' !!}>
                    <label>{{ __('Judgment lien from a lawsuit') }} </label>
                </div>
                <div class="input-group">
                    <input name="{{ base64_encode($nameArray['otherRightToOffset']) }}" value="On" type="checkbox" {!! isset($partDpart1add1[base64_encode($nameArray['otherRightToOffset'])]) ? Helper::validate_key_toggle(base64_encode($nameArray['otherRightToOffset']), $partDpart1add1, 'On') : '' !!}>
                    <label>{{ __('Other (including a right to offset)') }}</label>
                    <input name="{{ base64_encode($nameArray['otherTextField']) }}" type="text" value="{{ $partDpart1add1[base64_encode($nameArray['otherTextField'])] ?? '' }}" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
