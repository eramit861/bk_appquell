@php
$BIData = \App\Services\Client\CacheBasicInfo::getBasicInformationData(Auth::user()->id);
$BasicInfoPartA = \App\Helpers\Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
$securityNumberLastFour = '';
if (!empty($BasicInfoPartA) && !empty($BasicInfoPartA->security_number)) {
    $securityNumberLastFour = substr($BasicInfoPartA->security_number, -4);
}
@endphp

@if(Helper::validate_key_value('tax_owned_irs', $debts) !== 1)
    <span class='fs-16px font-weight-bold text-danger'> None</span>
@endif

@php
$i = 1;
$class = '';
$pastdebt = [];
@endphp

@if(Helper::validate_key_value('tax_owned_irs', $debts) == 1)
    @php
    $statecode = Helper::validate_key_value('tax_irs_state', $debts);
    $item = Helper::irsState($statecode);
    $stateaddress = ($item['address_heading'] ?? '') . '<br>';
    $stateaddress .= (!empty($item['add1']) ? $item['add1'] : $stateaddress) . '<br>';
    $stateaddress = !empty($item['city']) ? $stateaddress . ' ' . $item['city'] : $stateaddress;
    $stateaddress = !empty($statecode) ? $stateaddress . ', ' . $statecode : $stateaddress;
    $stateaddress = !empty($item['zip']) ? $stateaddress . ' ' . $item['zip'] : $stateaddress;
    @endphp

    <div class="light-gray-div mt-2">
        <h2>IRS Details</h2>
        <a href="javascript:void(0)" data-saveid="0" class=" client-edit-button" onclick="display_irs_form_div(this)">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <div class="row gx-3">
            <div class="col-md-8  col-12">
                <div class="row">
                    <div class="col-lg-4 no_dup_col">
                        <label class="font-weight-bold ">Tax years owed:
                            <span class="font-weight-normal">{{ DateTimeHelper::convertYearsToEndOfYear(Helper::validate_key_value('tax_irs_whats_year', $debts)) }}</span></label>
                    </div>
                    <div class="col-lg-4 no_dup_col">
                        <div class="row">
                            <div class="col-md-12">
                                @php $owned_by = [1 => "You", 2 => "Spouse", 3 => "Joint", 4 => "Other"]; @endphp
                                <label class="font-weight-bold ">Who owes the debt:
                                    <span class="font-weight-normal">{{ (!empty($debts['tax_irs_owned_by'])) ? $owned_by[$debts['tax_irs_owned_by']] : "" }}</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 no_dup_col">
                        <label class="font-weight-bold ">Total Amount Owed: <span class="font-weight-normal text-danger">
                                ${{ number_format((float)Helper::validate_key_value('tax_irs_total_due', $debts), 2, '.', ',') }}</span></label>
                    </div>
                </div>

                <div class="row {{ Helper::key_hide_show_ownedby('tax_irs_owned_by', $debts) }}">
                    <div class="col-md-12">
                        <span class="section-title font-weight-bold font-lg-12 text-lightblue">Co-Debtor Information:</span>
                    </div>
                    <div class="col-md-12">
                        <label class="font-weight-bold ">Codebtor Name: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('tax_irs_codebtor_creditor_name', $debts) }}
                            </span></label>
                    </div>
                    <div class="col-md-5">
                        <label class="font-weight-bold ">Street Address: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('tax_irs_codebtor_creditor_name_addresss', $debts) }}
                            </span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight-bold ">City: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('tax_irs_codebtor_creditor_city', $debts) }}
                            </span></label>
                    </div>
                    <div class="col-md-2">
                        <label class="font-weight-bold ">State: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('tax_irs_codebtor_creditor_state', $debts) }}
                            </span></label>
                    </div>
                    <div class="col-md-2">
                        <label class="font-weight-bold ">Zip: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('tax_irs_codebtor_creditor_zip', $debts) }}
                            </span></label>
                    </div>
                </div>
                <div class="row">
                    @php
                        $tax_irs = Helper::validate_key_value('tax_irs', $debts);
                    @endphp
                    @if(isset($tax_irs) && !empty($tax_irs))
                        @php
                        $is_three_months = Helper::validate_key_value('is_back_tax_irs_three_months', $tax_irs);
                        $is_three_months_show_hide = "hide-data";
                        if ($is_three_months == 1) {
                            $is_three_months_show_hide = "";
                        }
                        $payment_dates_1 = Helper::validate_key_value('payment_dates_1', $tax_irs);
                        $payment_dates_2 = Helper::validate_key_value('payment_dates_2', $tax_irs);
                        $payment_dates_3 = Helper::validate_key_value('payment_dates_3', $tax_irs);
                        $payment_dates = !empty($payment_dates_1) ? $payment_dates_1 : '';
                        $payment_dates .= !empty($payment_dates_2) ? ', ' . $payment_dates_2 : '';
                        $payment_dates .= !empty($payment_dates_3) ? ', ' . $payment_dates_3 : '';
                        @endphp
                        <div class="col-md-12">
                            <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                <span class="font-weight-normal">{{ Helper::key_display('is_back_tax_irs_three_months', $tax_irs) }}</span></label>
                        </div>
                        <div class="col-xxl-8 {{ $is_three_months_show_hide . ' ' }}">
                            @php
                            $payments = "<span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_1', $tax_irs), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_1', $tax_irs) . ")";
                            $payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_2', $tax_irs), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_2', $tax_irs) . ")";
                            $payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_3', $tax_irs), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_3', $tax_irs) . ")";
                            @endphp
                            <label class="font-weight-bold ">Payment(s):
                                <span class="font-weight-normal">{!! $payments !!}</span></label>
                        </div>
                        <div class="col-xxl-4 {{ $is_three_months_show_hide }}">
                            <label class="font-weight-bold">Total Amount Paid:
                                <span class="font-weight-normal text-c-green">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $tax_irs), 2, '.', ',') }}</span></label>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-12 no_dup_col">
                <label class="font-weight-bold ">Creditor Address</br>
                    <span class="font-weight-normal">
                        {!! $stateaddress !!}
                    </span>
                </label>
            </div>
        </div>
    </div>
@endif