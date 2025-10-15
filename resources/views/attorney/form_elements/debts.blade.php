@php
    // Extract security number last four digits
    $securityNumberLastFour = '';
    if (!empty($basic_info) && !empty($basic_info['BasicInfoPartA']) && !empty($basic_info['BasicInfoPartA']->security_number)) {
        $securityNumberLastFour = substr($basic_info['BasicInfoPartA']->security_number, -4);
    }
@endphp

<!-- State Tax -->
<div class="outline-gray-border-area">
    <div class="section-title-div d-block mt-3 mb-4">
        <div class="row">
            <div class="col-12 col-md-5">
                <h3 class="">
                    Taxes Owed to Any State Entity:
                    @if(Helper::validate_key_value('tax_owned_state', $debts, 'radio') !== 1)
                        <span class='text-danger text-bold item-label'> None</span>
                    @endif
                </h3>
            </div>
            @if(isset($allTotal) && !empty($allTotal))
            <div class="col-12 col-md-7">
                <div class="section-edit-div">
                    <span class="float_right text-bold text-c-blue">{{ implode(', ', $allTotal) }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="part-a outline-gray-border-area">
    @php
        $i = 1;
        $class = '';
        $pastdebt = [];
    @endphp
    
    @if(!empty($debts['tax_owned_state']) && !empty($debts['back_tax_own']) && count($debts['back_tax_own']) > 0)
        @foreach($debts['back_tax_own'] as $pastdebt)
            @php
                $statecode = Helper::validate_key_value('debt_state', $pastdebt);
                $item = AddressHelper::getStateTaxAddress($statecode);
                $stateaddress = '';
                if (!empty($item) && isset($item['address_heading'])) {
                    $stateaddress = $item['address_heading'].'<br>';
                    $stateaddress .= !empty($item['add1']) ? $item['add1'].'<br>' : $stateaddress;
                    $stateaddress = !empty($item['city']) ? $stateaddress.' '.$item['city'] : $stateaddress;
                    $stateaddress = !empty($statecode) ? $stateaddress.', '.$statecode : $stateaddress;
                    $stateaddress = !empty($item['zip']) ? $stateaddress.' '.$item['zip'] : $stateaddress;
                }
            @endphp
        <div class="light-gray-div">
            <div class="light-gray-box-form-area">
                <h2 class="font-weight-bold label-heading align-items-center ">
                    <span class="item-label">State taxes owed to: </span>                    
                </h2>
                <div class="row gx-3 set-mobile-col">
                    <div class="row col-md-12 ">
                        <div class="col-md-8 no_dup_col">
                            <div class="row">
                                
                                <div class="col-md-4 no_dup_col">
                                    <label class="font-weight-bold ">Tax years owed:
                                        <span class="font-weight-normal">{{ DateTimeHelper::convertYearsToEndOfYear(Helper::validate_key_value('tax_whats_year', $pastdebt)) }}</span>
                                    </label>
                                </div>

                                <div class="col-md-4 no_dup_col">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php $owned_by = [1 => "You",2 => "Spouse",3 => "Joint",4 => "Other"]; @endphp
                                            <label class="font-weight-bold ">Who owes the debt:
                                                <span class="font-weight-normal">{{ (!empty($pastdebt['owned_by'])) ? $owned_by[$pastdebt['owned_by']] : "" }}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="font-weight-bold ">Acct #: <span class="font-weight-normal">{{ $securityNumberLastFour }}</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Total Amount Owed:<span class="font-weight-normal text-danger">
                                            ${{ number_format((float)Helper::validate_key_value('tax_total_due', $pastdebt), 2, '.', ',') }}</span></label>
                                </div>
                            </div>

                            <div class="row {{ Helper::key_hide_show_ownedby('owned_by', $pastdebt) }}">
                                <div class="col-md-12">
                                    <span class="section-title font-weight-bold font-lg-12 text-lightblue ">Co-Debtor
                                        Information:</span>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Codebtor Name: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('codebtor_creditor_name', $pastdebt) }}
                                        </span></label>
                                </div>
                                <div class="col-md-5">
                                    <label class="font-weight-bold">Street Address: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('codebtor_creditor_name_addresss', $pastdebt) }}
                                        </span></label>
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold">City: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('codebtor_creditor_city', $pastdebt) }}
                                        </span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">State: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('codebtor_creditor_state', $pastdebt) }}
                                        </span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Zip: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('codebtor_creditor_zip', $pastdebt) }}
                                        </span></label>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $is_three_months = Helper::validate_key_value('is_back_tax_state_three_months', $pastdebt);
                                    $tax_irs = Helper::validate_key_value('tax_irs', $pastdebt);
                                @endphp
                                
                                @if(isset($tax_irs) && !empty($tax_irs))
                                    @php
                                        $is_three_months_show_hide = "hide-data";
                                        if ($is_three_months == 1) {
                                            $is_three_months_show_hide = "";
                                        }
                                        $payment_dates_1 = Helper::validate_key_value('payment_dates_1', $pastdebt);
                                        $payment_dates_2 = Helper::validate_key_value('payment_dates_2', $pastdebt);
                                        $payment_dates_3 = Helper::validate_key_value('payment_dates_3', $pastdebt);
                                        $payment_dates = !empty($payment_dates_1) ? $payment_dates_1 : '';
                                        $payment_dates .= !empty($payment_dates_2) ? ', '.$payment_dates_2 : '';
                                        $payment_dates .= !empty($payment_dates_3) ? ', '.$payment_dates_3 : '';
                                    @endphp
                                    
                                    <div class="col-md-12">
                                        <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                            <span class="font-weight-normal">{{ Helper::key_display('is_back_tax_state_three_months', $pastdebt) }}</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 {{ $is_three_months_show_hide }}">
                                        @php
                                            $payments = "<span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_1', $pastdebt), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_1', $pastdebt).")";
                                            $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_2', $pastdebt), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_2', $pastdebt).")";
                                            $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_3', $pastdebt), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_3', $pastdebt).")";
                                        @endphp
                                        <label class="font-weight-bold ">Payment(s):
                                            <span class="font-weight-normal">{!! $payments !!}</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4 {{ $is_three_months_show_hide }}">
                                        <label class="font-weight-bold">Total Amount Paid:
                                            <span class="font-weight-normal text-c-green">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $pastdebt), 2, '.', ',') }}</span>
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 no_dup_col">
                            <span class="font-weight-bold sec-heading-font fs-14px">
                                Creditor Address
                            </span>

                            <div class="franchise_tax_board domestic_head_text">
                                <p>{!! $stateaddress !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php $i++; @endphp
        @endforeach
    @endif
</div>

<!-- IRS -->
<div class="outline-gray-border-area">
    <div class="section-title-div mt-3 mb-4">
        <h3 class="">
            Taxes Owed To The Internal Revenue Service (IRS):
            @if(Helper::validate_key_value('tax_owned_irs', $debts, 'radio') !== 1)
                <span class='text-danger text-bold item-label'> None</span>
            @endif
        </h3>
    </div>
</div>
<div class="part-a outline-gray-border-area">
    @if(Helper::validate_key_value('tax_owned_irs', $debts) == 1 && isset($debts['tax_irs_state']) && !empty($debts['tax_irs_state']))
        @php
            $statecode = Helper::validate_key_value('tax_irs_state', $debts);
            $item = Helper::irsState($statecode);
            $stateaddress = ($item['address_heading'] ?? '').'<br>';
            $stateaddress .= (!empty($item['add1']) ? $item['add1'] : $stateaddress).'<br>';
            $stateaddress = !empty($item['city']) ? $stateaddress.' '.$item['city'] : $stateaddress;
            $stateaddress = !empty($statecode) ? $stateaddress.', '.$statecode : $stateaddress;
            $stateaddress = !empty($item['zip']) ? $stateaddress.' '.$item['zip'] : $stateaddress;
        @endphp
        <div class="light-gray-div">
            <div class="light-gray-box-form-area">
                <h2 class="font-weight-bold label-heading align-items-center ">
                    <span class="item-label">Taxes Owed To The IRS: </span>                    
                </h2>
                <div class="row gx-3 set-mobile-col">
                    <div class="row col-md-12 ">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 no_dup_col">
                                    <label class="font-weight-bold ">Tax years owed:
                                        <span class="font-weight-normal">{{ DateTimeHelper::convertYearsToEndOfYear(Helper::validate_key_value('tax_irs_whats_year', $debts)) }}</span>
                                    </label>
                                </div>
                                <div class="col-md-4 no_dup_col">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php $owned_by = [1 => "You",2 => "Spouse",3 => "Joint",4 => "Other"]; @endphp
                                            <label class="font-weight-bold ">Who owes the debt:
                                                <span class="font-weight-normal">{{ (!empty($debts['tax_irs_owned_by'])) ? $owned_by[$debts['tax_irs_owned_by']] : "" }}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="font-weight-bold ">Acct #: <span class="font-weight-normal">{{ $securityNumberLastFour }}</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no_dup_col">
                                    <label class="font-weight-bold ">Total Amount Owed: <span class="font-weight-normal text-danger">${{ number_format((float)Helper::validate_key_value('tax_irs_total_due', $debts), 2, '.', ',') }}</span></label>
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
                                        $payment_dates .= !empty($payment_dates_2) ? ', '.$payment_dates_2 : '';
                                        $payment_dates .= !empty($payment_dates_3) ? ', '.$payment_dates_3 : '';
                                    @endphp
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                        <span class="font-weight-normal">{{ Helper::key_display('is_back_tax_irs_three_months', $tax_irs) }}</span>
                                    </label>
                                </div>
                                <div class="col-md-8 {{ $is_three_months_show_hide }}">
                                    @php
                                        $payments = "<span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_1', $tax_irs), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_1', $tax_irs).")";
                                        $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_2', $tax_irs), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_2', $tax_irs).")";
                                        $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_3', $tax_irs), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_3', $tax_irs).")";
                                    @endphp
                                    <label class="font-weight-bold ">Payment(s):
                                        <span class="font-weight-normal">{!! $payments !!}</span>
                                    </label>
                                </div>
                                <div class="col-md-4 {{ $is_three_months_show_hide }}">
                                    <label class="font-weight-bold">Total Amount Paid:
                                        <span class="font-weight-normal text-c-green">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $tax_irs), 2, '.', ',') }}</span>
                                    </label>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 no_dup_col">
                            <span class="font-weight-bold sec-heading-font fs-14px ">
                                Creditor Address
                            </span>

                            <div class="franchise_tax_board domestic_head_text">
                                <p>{!! $stateaddress !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>            

<!-- Additional Liens --> 
@php
    // Initialize creditors array for additional liens
    $creditors = [];
    $additionaCreditor = [];
    $additional_liens = $debts['additional_liens_data'] ?? [];
    
    if (Helper::validate_key_value('additional_liens', $debts) == 1 && !empty($additional_liens)) {
        foreach ($additional_liens as $additional) {
            $additionaCreditor = [
                'creditor_name' => $additional['domestic_support_name'] ?? '',
                'creditor_name_addresss' => $additional['domestic_support_address'] ?? '',
                'creditor_city' => $additional['domestic_support_city'] ?? '',
                'creditor_state' => $additional['creditor_state'] ?? '',
                'creditor_zip' => $additional['domestic_support_zipcode'] ?? '',
                'account_number' => $additional['additional_liens_account'] ?? '',
                'debt_incurred_date_unknown' => $additional['additional_liens_date_unknown'] ?? '',
                'debt_incurred_date' => $additional['additional_liens_date'] ?? '',
                'debt_amount_due' => $additional['additional_liens_due'] ?? '',
                'monthly_payment' => $additional['monthly_payment'] ?? '',
                'describe_secure_claim' => $additional['describe_secure_claim'] ?? '',
                'debt_owned_by' => $additional['owned_by'] ?? '',
                'codebtor_creditor_name' => $additional['codebtor_creditor_name'] ?? '',
                'codebtor_creditor_name_addresss' => $additional['codebtor_creditor_name_addresss'] ?? '',
                'codebtor_creditor_city' => $additional['codebtor_creditor_city'] ?? '',
                'codebtor_creditor_state' => $additional['codebtor_creditor_state'] ?? '',
                'codebtor_creditor_zip' => $additional['codebtor_creditor_zip'] ?? '',
                'is_add_liens_three_months' => $additional['is_add_liens_three_months'] ?? '',
                'payment_dates_1' => $additional['payment_dates_1'] ?? '',
                'payment_dates_2' => $additional['payment_dates_2'] ?? '',
                'payment_dates_3' => $additional['payment_dates_3'] ?? '',
                'payment_1' => $additional['payment_1'] ?? '',
                'payment_2' => $additional['payment_2'] ?? '',
                'payment_3' => $additional['payment_3'] ?? '',
                'total_amount_paid' => $additional['total_amount_paid'] ?? '',
            ];
            $creditors[] = $additionaCreditor;
        }
    }
@endphp
<div class="outline-gray-border-area">
    <div class="section-title-div mt-3 mb-4">
        <h3 class="">
            Additional Liens Secured By Real or Personal Property Not Already Listed:
            @if(Helper::validate_key_value('additional_liens', $debts, 'radio') !== 1)
                <span class='text-danger text-bold item-label'> None</span>
            @endif
        </h3>
    </div>
</div>
<div class="part-a outline-gray-border-area">
    @foreach($creditors as $item)
        @php
            $address_string = ($item['creditor_name'] ?? '').'<br>';
            $address_string .= ($item['creditor_name_addresss'] ?? '').'<br>';
            if (!empty($item['creditor_city'])) {
                $address_string = $address_string . ' '.$item['creditor_city'] . ", ";
            }
            if (!empty($item['creditor_state'])) {
                $address_string = $address_string . ''.$item['creditor_state'] . " ";
            }
            if (!empty($item['creditor_zip'])) {
                $address_string = $address_string . ''.$item['creditor_zip'];
            }
        @endphp
        <div class="light-gray-div">
            <div class="light-gray-box-form-area">
                <h2 class="font-weight-bold label-heading align-items-center ">
                    <span class="item-label">Additional Liens: </span>                    
                </h2>
                <div class="row gx-3 set-mobile-col">
                    <div class="row col-md-12 ">
                        <div class="col-md-3 no_dup_col">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="font-weight-bold sec-heading-font fs-14px">
                                        Creditor Address
                                    </span>

                                    <div class="franchise_tax_board domestic_head_text">
                                        <p class="mb-2">{!! $address_string !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Describe the property: <span class="font-weight-normal">{{ Helper::validate_key_value('describe_secure_claim', $item) }}</span></label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-9">
                            <div class="row">

                                @php
                                    $debtDateUnknown = Helper::validate_key_value('debt_incurred_date_unknown', $item);
                                    $debtDate = Helper::validate_key_value('debt_incurred_date', $item);
                                    if (strtotime($debtDate) != false && strlen($debtDate) > 7) {
                                        $debtDate = date('m/Y', strtotime($debtDate));
                                    }
                                    if ($debtDateUnknown == 1) {
                                        $debtDate = 'Unknown';
                                    }
                                    $is_add_liens_three_months = Helper::validate_key_value('is_add_liens_three_months', $item);
                                    $is_add_liens_three_months_show_hide = "hide-data";
                                    if ($is_add_liens_three_months == 1) {
                                        $is_add_liens_three_months_show_hide = "";
                                    }
                                @endphp

                                <div class="col-md-4 no_dup_col">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-weight-bold ">Acct #: <span class="font-weight-normal">{{ Helper::validate_key_value('account_number', $item) }}</span></label>
                                        </div>
                                        <div class="col-md-12">
                                            @php $owned_by = [1 => "You",2 => "Spouse",3 => "Joint",4 => "Other"]; @endphp
                                            <label class="font-weight-bold ">Who owes the debt:
                                                <span class="font-weight-normal">{{ (!empty($item['debt_owned_by'])) ? $owned_by[$item['debt_owned_by']] : "" }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-weight-bold ">Amount due: <span class="font-weight-normal text-danger">${{ Helper::validate_key_value('debt_amount_due', $item) }}</span></label>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="font-weight-bold ">Incurred Date: <span class="font-weight-normal">{{ $debtDate }}</span></label>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="font-weight-bold ">Monthly Payment: <span class="font-weight-normal text-c-green">${{ Helper::validate_key_value('monthly_payment', $item) }}</span></label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12 {{ $is_add_liens_three_months_show_hide }}">
                                            <label class="font-weight-bold ">Total Amount Paid:
                                                <span class="font-weight-normal text-success">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $item), 2, '.', ',') }}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                                <span class="font-weight-normal">{{ Helper::key_display('is_add_liens_three_months', $item) }}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-12 {{ $is_add_liens_three_months_show_hide }}">
                                            @php
                                                $payments = "<span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_1', $item), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_1', $item).")";
                                                $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_2', $item), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_2', $item).")";
                                                $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_3', $item), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_3', $item).")";
                                            @endphp
                                            <label class="font-weight-bold ">Payment(s):
                                                <span class="font-weight-normal">{!! $payments !!}</span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 {{ Helper::key_hide_show_ownedby('debt_owned_by', $item) }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="section-title text-c-light-blue font-weight-bold font-lg-12 ">Co-Debtor
                                        Information:</span>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Codebtor Name: <span class="font-weight-normal">
                                            {{ $item['codebtor_creditor_name'] ?? '' }}
                                        </span></label>
                                </div>

                                <div class="col-md-3">
                                    <label class="font-weight-bold ">Street Address: <span class="font-weight-normal">
                                            {{ $item['codebtor_creditor_name_addresss'] ?? '' }}
                                        </span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">City: <span class="font-weight-normal">
                                            {{ $item['codebtor_creditor_city'] ?? '' }}
                                        </span></label>
                                </div>
                                <div class="col-md-1">
                                    <label class="font-weight-bold ">State: <span class="font-weight-normal">
                                            {{ $item['codebtor_creditor_state'] ?? '' }}
                                        </span></label>
                                </div>
                                <div class="col-md-1">
                                    <label class="font-weight-bold ">Zip: <span class="font-weight-normal">
                                            {{ $item['codebtor_creditor_zip'] ?? '' }}
                                        </span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- DSO -->
<div class="outline-gray-border-area">
    <div class="section-title-div mt-3 mb-4">
        <h3 class="">
            Domestic Support Debts:
            @if(Helper::validate_key_value('domestic_support', $debts, 'radio') !== 1)
                <span class='text-danger text-bold item-label'> None</span>
            @endif
        </h3>
    </div>
</div>
<div class="part-a outline-gray-border-area">
    @if(Helper::validate_key_value('domestic_support', $debts) == 1 && !empty($debts['domestic_tax']) && count($debts['domestic_tax']) > 0)
        @foreach($debts['domestic_tax'] as $domestic)
            @php
                $statecode = Helper::validate_key_value('domestic_address_state', $domestic);
                $domesticAddresses = current(AddressHelper::getDomesticAddressStatesList($statecode, false));
            @endphp
        <div class="light-gray-div">
            <div class="light-gray-box-form-area">
                <h2 class="font-weight-bold label-heading align-items-center ">
                    <span class="item-label">Domestic Support Debt: </span>                    
                </h2>
                <div class="row gx-3 set-mobile-col">
                    <div class="row col-md-12">
                        <div class="col-md-7">
                            <div class="row">

                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Creditor Name: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('domestic_support_name', $domestic) }}
                                        </span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Address: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('domestic_support_address', $domestic) }}
                                            </span></label>
                                    </div>
                                    <div class="col-md-3">
                                    <label class="font-weight-bold ">City: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('domestic_support_city', $domestic) }}
                                            </span></label>
                                    </div>
                                    <div class="col-md-2">
                                    <label class="font-weight-bold ">State: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('creditor_state', $domestic) }}
                                            </span></label>
                                    </div>
                                    <div class="col-md-7">
                                    <label class="font-weight-bold ">Zip: <span class="font-weight-normal">
                                            {{ Helper::validate_key_value('domestic_support_zipcode', $domestic) }}
                                            </span></label>
                                    </div>

                                <div class="col-md-3">
                                    <label class="font-weight-bold ">Acct #: <span class="font-weight-normal">{{ Helper::validate_key_value('domestic_support_account', $domestic) }}</span></label>
                                </div>

                                <div class="col-md-5">
                                    <label class="font-weight-bold ">Current monthly payment: <span class="section-title font-weight-normal text-success">${{ number_format((float)Helper::validate_key_value('domestic_support_monthlypay', $domestic), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Past due amount: <span class="font-weight-normal text-danger">${{ number_format((float)Helper::validate_key_value('domestic_support_past_due', $domestic), 2, '.', ',') }}</span></label>
                                </div>
                                @php
                                    $is_three_months = Helper::validate_key_value('is_domestic_support_three_months', $domestic);
                                @endphp
                                @if(isset($is_three_months) && !empty($is_three_months))
                                    @php
                                        $is_three_months_show_hide = "hide-data";
                                        if ($is_three_months == 1) {
                                            $is_three_months_show_hide = "";
                                        }
                                        $payment_dates_1 = Helper::validate_key_value('payment_dates_1', $domestic);
                                        $payment_dates_2 = Helper::validate_key_value('payment_dates_2', $domestic);
                                        $payment_dates_3 = Helper::validate_key_value('payment_dates_3', $domestic);
                                        $payment_dates = !empty($payment_dates_1) ? $payment_dates_1 : '';
                                        $payment_dates .= !empty($payment_dates_2) ? ', '.$payment_dates_2 : '';
                                        $payment_dates .= !empty($payment_dates_3) ? ', '.$payment_dates_3 : '';
                                    @endphp
                                    
                                    <div class="col-md-12">
                                        <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                            <span class="font-weight-normal">{{ Helper::key_display('is_domestic_support_three_months', $domestic) }}</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 {{ $is_three_months_show_hide }}">
                                        @php
                                            $payments = "<span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_1', $domestic), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_1', $domestic).")";
                                            $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_2', $domestic), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_2', $domestic).")";
                                            $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_3', $domestic), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_3', $domestic).")";
                                        @endphp
                                        <label class="font-weight-bold ">Payment(s):
                                            <span class="font-weight-normal">{!! $payments !!}</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4 {{ $is_three_months_show_hide }}">
                                        <label class="font-weight-bold">Total Amount Paid:
                                            <span class="font-weight-normal text-c-green">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $domestic), 2, '.', ',') }}</span>
                                        </label>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-5">

                            <div class="row {{ (!isset($domesticAddresses['notify_address_name']) || $domesticAddresses['notify_address_name'] == '') ? 'hide-data' : '' }}">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="font-weight-bold fs-14px sec-heading-font ">
                                                Domestic Address
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="franchise_tax_board domestic_head_text">
                                                <p class="mb-0">
                                                    {{ isset($domesticAddresses['address_name']) ? $domesticAddresses['address_name'] : '' }}
                                                </p>
                                                @php
                                                    $address = "";
                                                    if (isset($domesticAddresses['address_street']) && !empty(trim($domesticAddresses['address_street']))) {
                                                        $address .= $domesticAddresses['address_street'].'<br>';
                                                    }
                                                    if (isset($domesticAddresses['address_line2']) && !empty(trim($domesticAddresses['address_line2']))) {
                                                        $address .= $domesticAddresses['address_line2'].'<br>';
                                                    }
                                                    if (isset($domesticAddresses['address_city'])) {
                                                        $address .= $domesticAddresses['address_city'].', '.$domesticAddresses['address_state'].' '.$domesticAddresses['address_zip'].'<br>';
                                                    }
                                                @endphp
                                                <p>{!! $address !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="font-weight-bold fs-14px sec-heading-font">
                                                BK Service Address
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="franchise_tax_board notify_domestic_head_text">
                                                <p class="mb-0">
                                                    {{ isset($domesticAddresses['notify_address_name']) ? $domesticAddresses['notify_address_name'] : '' }}
                                                </p>
                                                @php
                                                    $address = "";
                                                    if (isset($domesticAddresses['notify_address_street']) && !empty(trim($domesticAddresses['notify_address_street']))) {
                                                        $address .= $domesticAddresses['notify_address_street'].'<br>';
                                                    }
                                                    if (isset($domesticAddresses['notify_address_line2']) && !empty(trim($domesticAddresses['notify_address_line2']))) {
                                                        $address .= $domesticAddresses['notify_address_line2'].'<br>';
                                                    }
                                                    if (isset($domesticAddresses['notify_address_city']) && !empty($domesticAddresses['notify_address_city'])) {
                                                        $address .= $domesticAddresses['notify_address_city'].', '.$domesticAddresses['notify_address_zip'].'<br>';
                                                    }
                                                @endphp
                                                <p>{!! $address !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
<!-- Unsecured -->
<div class="outline-gray-border-area">
    <div class="section-title-div mt-3 mb-4">
        <h3 class="">
            Unsecured Debts:
            @if(Helper::validate_key_value('does_not_have_additional_creditor', $debts, 'radio') !== 1)
                <span class='text-danger text-bold item-label'> None</span>
            @endif
        </h3>
    </div>
</div>
<div class="part-a outline-gray-border-area">
    @php
        $home_loan_mortgage = ArrayHelper::getDebtCardSelectionsForAttorney();
        if (!empty($debts['debt_tax'])) {
            usort($debts['debt_tax'], function ($a, $b) {
                $aName = isset($a['creditor_name']) ? $a['creditor_name'] : '';
                $bName = isset($b['creditor_name']) ? $b['creditor_name'] : '';
                return strnatcasecmp($aName, $bName);
            });
        }
    @endphp
    
    @if(isset($debts['debt_tax']) && $debts['debt_tax'])
        @php $i = 1; @endphp
        @foreach($debts['debt_tax'] as $key => $debt)
            @php
                $originalCreditor = $debt['original_creditor'] ?? '';
                $classGreenText = 'd-none';
                $collectionAgent = 'd-none';
                if ($originalCreditor == 0) {
                    $collectionAgent = '';
                }
                if ($originalCreditor == 1) {
                    $classGreenText = 'text-success';
                }
            @endphp
        <div class="light-gray-div">
            <div class="light-gray-box-form-area">
                <h2 class="font-weight-bold align-items-center">
                    <div class=" circle-number-div">{{ $i }}</div>
                    <span class="item-label">Type of Debt: </span>     
                    <span class="item-label ml-2 font-weight-normal">
                        {{ (!empty($debt['cards_collections']) && $debt['cards_collections'] != '1') ? $home_loan_mortgage[$debt['cards_collections']] : "" }}
                    </span>               
                </h2>
                <div class="row gx-3 set-mobile-col">
                    <div class="row col-12">
                        <div class="col-md-5">
                            <label class="font-weight-bold ">
                                <span class="{{ $classGreenText }}">Original Creditor:</span>
                                <span class="section-title font-lg-12 text-danger {{ $collectionAgent }}">Collection Agent:</span>
                                <span class="section-title"> {{ Helper::validate_key_value('creditor_name', $debt) }}</span>
                            </label>
                        </div>
                        @php
                            $debtDateUnknown = Helper::validate_key_value('debt_date_unknown', $debt);
                            $debtDate = Helper::validate_key_value('debt_date', $debt);
                            if (strtotime($debtDate) != false && strlen($debtDate) > 7) {
                                $debtDate = date('m/Y', strtotime($debtDate));
                            }
                            if ($debtDateUnknown == 1) {
                                $debtDate = 'Unknown';
                            }
                        @endphp
                        <div class="col-md-3">
                            <label class="font-weight-bold ">Acct #:
                                <span class="font-weight-normal">{{ Helper::validate_key_value('amount_number', $debt) }}</span>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="font-weight-bold ">Amount Owed:
                                <span class="font-weight-normal text-danger">${{ number_format((float)Helper::validate_key_value('amount_owned', $debt), 2, '.', ',') }}</span>
                            </label>
                        </div>

                        <div class="col-md-5">
                            <label class="font-weight-bold ">Address: <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('creditor_information', $debt) }}<br>
                                </span></label>
                        </div>
                        <div class="col-md-3">
                            @php $owned_by = [1 => "You",2 => "Spouse",3 => "Joint",4 => "Other"]; @endphp
                            <label class="font-weight-bold ">Who owes the debt:
                                <span class="font-weight-normal">{{ (!empty($debt['owned_by'])) ? $owned_by[$debt['owned_by']] : "" }}</span>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="font-weight-bold ">Date/range debt was incurred:
                                <span class="font-weight-normal">{{ $debtDate }}</span>
                            </label>
                        </div>

                        <div class="col-md-2">
                            <label class="font-weight-bold ">City:
                                <span class="font-weight-normal">{{ Helper::validate_key_value('creditor_city', $debt) }}</span>
                            </label>
                        </div>
                        <div class="col-md-1">
                            <label class="font-weight-bold ">State:
                                <span class="font-weight-normal">{{ Helper::validate_key_value('creditor_state', $debt) }}</span>
                            </label>
                        </div>
                        <div class="col-md-1">
                            <label class="font-weight-bold ">Zip:
                                <span class="font-weight-normal">{{ Helper::validate_key_value('creditor_zip', $debt) }}</span>
                            </label>
                        </div>

                    </div>
                    <div class="row col-12 {{ Helper::key_hide_show_ownedby('owned_by', $debt) }} mt-2">
                        <div class="col-md-12">
                            <label class="font-weight-bold ">
                                <span class="section-title font-lg-12 text-lightblue">Co-Debtor Name:</span>
                                <span class="font-weight-bold text-c-blue">
                                    {{ Helper::validate_key_value('codebtor_creditor_name', $debt) }}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="font-weight-bold ">Address: <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('codebtor_creditor_name_addresss', $debt) }}
                                </span></label>
                        </div>
                        <div class="col-md-2">
                            <label class="font-weight-bold ">City: <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('codebtor_creditor_city', $debt) }}
                                </span></label>
                        </div>
                        <div class="col-md-1">
                            <label class="font-weight-bold ">State: <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('codebtor_creditor_state', $debt) }}
                                </span></label>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold ">Zip: <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('codebtor_creditor_zip', $debt) }}
                                </span></label>
                        </div>
                    </div>
                    <div class="row col-12 {{ $collectionAgent }} mt-2">
                        <div class="col-md-12">
                            <label class="font-weight-bold ">
                                <span class="section-title font-lg-12 text-success">Original Creditor:</span>
                                <span class="text-c-blue">{{ Helper::validate_key_value('second_creditor_name', $debt) }}</span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="font-weight-bold ">Address: <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('second_creditor_information', $debt) }}
                                </span></label>
                        </div>
                        <div class="col-md-2">

                            <label class="font-weight-bold ">City:
                                <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('second_creditor_city', $debt) }}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-1">
                            <label class="font-weight-bold">State:
                                <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('second_creditor_state', $debt) }}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">Zip:
                                <span class="font-weight-normal">
                                    {{ Helper::validate_key_value('second_creditor_zip', $debt) }}
                                </span>
                            </label>
                        </div>
                    </div>
                    @php
                        $is_three_months = Helper::validate_key_value('is_debt_three_months', $debt);
                        $tax_irs = Helper::validate_key_value('tax_irs', $debt);
                    @endphp
                    
                    @if(isset($tax_irs) && !empty($tax_irs))
                        @php
                            $is_three_months_show_hide = "hide-data";
                            if ($is_three_months == 1) {
                                $is_three_months_show_hide = "";
                            }
                            $payment_dates_1 = Helper::validate_key_value('payment_dates_1', $debt);
                            $payment_dates_2 = Helper::validate_key_value('payment_dates_2', $debt);
                            $payment_dates_3 = Helper::validate_key_value('payment_dates_3', $debt);
                            $payment_dates = !empty($payment_dates_1) ? $payment_dates_1 : '';
                            $payment_dates .= !empty($payment_dates_2) ? ', '.$payment_dates_2 : '';
                            $payment_dates .= !empty($payment_dates_3) ? ', '.$payment_dates_3 : '';
                        @endphp
                        
                        <div class="row col-12">
                            <div class="col-md-12">
                                <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                    <span class="font-weight-normal">{{ Helper::key_display('is_debt_three_months', $debt) }}</span>
                                </label>
                            </div>
                            <div class="col-md-5 {{ $is_three_months_show_hide }}">
                                @php
                                    $totalAmountPaid = ((float)Helper::validate_key_value('payment_1', $debt)) + ((float)Helper::validate_key_value('payment_2', $debt)) + ((float)Helper::validate_key_value('payment_3', $debt));
                                    $payments = "<span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_1', $debt), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_1', $debt).")";
                                    $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_2', $debt), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_2', $debt).")";
                                    $payments .= ", <span class='text-c-green'>$".number_format((float)Helper::validate_key_value('payment_3', $debt), 2, '.', ',')."</span> (".Helper::validate_key_value('payment_dates_3', $debt).")";
                                @endphp
                                <label class="font-weight-bold ">Payment(s):
                                    <span class="font-weight-normal">{!! $payments !!}</span>
                                </label>
                            </div>
                            <div class="col-md-7 {{ $is_three_months_show_hide }}">
                                <label class="font-weight-bold">Total Amount Paid:
                                    <span class="font-weight-normal text-c-green">${{ number_format($totalAmountPaid, 2, '.', ',') }}</span>
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @php $i++; @endphp
        @endforeach
    @endif
</div>