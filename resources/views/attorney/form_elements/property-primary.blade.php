@php
$loan1 = json_decode($resident['home_car_loan'], 1);
$loan2 = json_decode($resident['home_car_loan2'], 1);
$loan3 = json_decode($resident['home_car_loan3'], 1);
$home_car_loan = json_decode($resident['home_car_loan'], 1);
$loans = ['loan1' => $loan1];
if (!empty($loan2) && !empty($loan2['additional_loan1'])) {
    $loans['loan2'] = $loan2;
}

if (!empty($loan3) && !empty($loan3['additional_loan2'])) {
    $loans['loan3'] = $loan3;
}
@endphp

@if($resident['currently_lived'] == 0)
    <div class="col-12 outline-gray-border-area ">
        <label class="subtitle pb-1">Property Description:</label>
    </div>
    <div class="col-md-2">
        <label class="font-weight-bold property_main-info">Residence Type:
            <span class="font-weight-normal">Rent</span></label>
    </div>
    <div class="col-md-2">
        <label class="font-weight-bold property_main-info">Rent Amount:
            <span class="font-weight-normal">${{ number_format((float)Helper::validate_key_value('rent', $resident), 2, '.', ',') }}</span></label>
    </div>
    <div class="col-md-6 {{ @$hide_docs == true ? "hide-data" : "" }}">
        <label class="font-weight-bold text-danger ">Client Rents Principle Residence</label>
    </div>
    @php
        $rented_residence = Helper::validate_key_value('rented_residence', $resident, 'radio');
        $eviction_pending = Helper::validate_key_value('eviction_pending', $resident, 'radio');
        $rrYesNoColorClass = 'text-danger';
        $epYesNoColorClass = 'text-danger';
        if ($rented_residence == 1) {
            $rrYesNoColorClass = 'text-success';
        }
        if ($eviction_pending == 1) {
            $epYesNoColorClass = 'text-success';
        }
        $eviction_pending_data = Helper::validate_key_value('eviction_pending_data', $resident);
        $epData = (isset($eviction_pending_data) && !empty($eviction_pending_data)) ? json_decode($eviction_pending_data, 1) : [];
    @endphp

    <div class="col-md-4 ">
        <label class="font-weight-bold ">Do you have an eviction pending against you:
            <span class="font-weight-normal {{ $epYesNoColorClass }}">{{ Helper::key_display('eviction_pending', $resident) }}</span></label>
    </div>

    <div class="col-12 outline-gray-border-area {{ Helper::key_hide_show_v('eviction_pending', $resident) }}">
        <label class="subtitle mt-2 pb-1">Landlord Information:</label>
    </div>
    <div class="col-md-3 {{ Helper::key_hide_show_v('eviction_pending', $resident) }}">
        <label class="font-weight-bold ">Name:
            <span class="font-weight-normal">{{ Helper::validate_key_value('Name', $epData) }}</span></label>
    </div>
    <div class="col-md-3 {{ Helper::key_hide_show_v('eviction_pending', $resident) }}">
        <label class="font-weight-bold ">Address:
            <span class="font-weight-normal">{{ Helper::validate_key_value('Address', $epData) }}</span></label>
    </div>
    <div class="col-md-2 {{ Helper::key_hide_show_v('eviction_pending', $resident) }}">
        <label class="font-weight-bold ">City:
            <span class="font-weight-normal">{{ Helper::validate_key_value('City', $epData) }}</span></label>
    </div>
    <div class="col-md-2 {{ Helper::key_hide_show_v('eviction_pending', $resident) }}">
        <label class="font-weight-bold ">State:
            <span class="font-weight-normal">{{ Helper::validate_key_value('State', $epData) }}</span></label>
    </div>
    <div class="col-md-2 {{ Helper::key_hide_show_v('eviction_pending', $resident) }}">
        <label class="font-weight-bold ">Zip:
            <span class="font-weight-normal">{{ Helper::validate_key_value('Zip', $epData) }}</span></label>
    </div>
    @php
        $security_deposits = Helper::validate_key_value('security_deposits', $resident);
        $security_deposits = !empty($security_deposits) ? json_decode($security_deposits, true) : [];
        $securityDepositStatus = Helper::validate_key_value('type_value', $security_deposits, 'radio');
        $sdYesNoColorClass = $securityDepositStatus == 1 ? 'text-success' : 'text-danger';
        $securityDepositData = !empty(Helper::validate_key_value('data', $security_deposits)) ? Helper::validate_key_value('data', $security_deposits) : [];
    @endphp
    <div class="col-md-12 ">
        <label class="font-weight-bold ">Do you or your spouse, if applicable, have any security deposits or prepaid amounts with any individual or organization:
            <span class="font-weight-normal {{ $sdYesNoColorClass }}">{{ Helper::key_display('type_value', $security_deposits) }}</span></label>
    </div>
    @if($securityDepositStatus == 1 && !empty($securityDepositData))
        @php
            $securityDepositAccountType = !empty(Helper::validate_key_value('type_of_account', $securityDepositData)) ? Helper::validate_key_value('type_of_account', $securityDepositData) : [];
            $securityDepositDescription = !empty(Helper::validate_key_value('description', $securityDepositData)) ? Helper::validate_key_value('description', $securityDepositData) : [];
            $securityDepositPropertyValue = !empty(Helper::validate_key_value('property_value', $securityDepositData)) ? Helper::validate_key_value('property_value', $securityDepositData) : [];
        @endphp
        <div class="col-12">
            <div class="row ">
                <div class="col-12 col-md-3 hide-on-mobile"><label class="font-weight-bold ">For:</label></div>
                <div class="col-12 col-md-4 hide-on-mobile"><label class="font-weight-bold ">Institution and/or landlord:</label></div>
                <div class="col-12 col-md-5 hide-on-mobile"><label class="font-weight-bold ">Total amount of security deposit:</label></div>
                @foreach($securityDepositAccountType as $index => $obj)
                <!-- for desktop -->
                <div class="col-12 col-md-3 hide-on-mobile"><label class="font-weight-bold "><span class="font-weight-normal">{{ ArrayHelper::securityDepositedArray(Helper::validate_key_loop_value('type_of_account', $securityDepositData, $index)) }}</span></label></div>
                <div class="col-12 col-md-4 hide-on-mobile"><label class="font-weight-bold "><span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $securityDepositData, $index) }}</span></label></div>
                <div class="col-12 col-md-5 hide-on-mobile"><label class="font-weight-bold "><span class="font-weight-normal">${{ number_format((float)Helper::validate_key_loop_value('property_value', $securityDepositData, $index), 2, '.', ',') }}</span></label></div>
                <!-- for mobile -->
                <div class="col-12 col-md-3 hide-on-desktop"><label class="font-weight-bold ">For: <span class="font-weight-normal">{{ ArrayHelper::securityDepositedArray(Helper::validate_key_loop_value('type_of_account', $securityDepositData, $index)) }}</span></label></div>
                <div class="col-12 col-md-4 hide-on-desktop"><label class="font-weight-bold ">Institution and/or landlord: <span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $securityDepositData, $index) }}</span></label></div>
                <div class="col-12 col-md-5 hide-on-desktop"><label class="font-weight-bold ">Total amount of security deposit: <span class="font-weight-normal">${{ number_format((float)Helper::validate_key_loop_value('property_value', $securityDepositData, $index), 2, '.', ',') }}</span></label></div>
                @endforeach
            </div>
        </div>
    @endif
@else
    @php
        $propertyDescription = Helper::validate_key_value('property_description', $resident) ?? '';
        $propertyDescription = json_decode($propertyDescription, 1) ?? [];
        $propertyType = Helper::validate_key_value('property', $resident);
        $arr1 = [1, 2, 3, 4];
        $arr2 = [5, 6];
        $descriptionDiv = 'd-none';
        $descriptionAndLotSizeDiv = 'd-none';
        if (in_array($propertyType, $arr1)) {
            $descriptionDiv = '';
            $descriptionAndLotSizeDiv = 'd-none';
        }
        if (in_array($propertyType, $arr2)) {
            $descriptionAndLotSizeDiv = '';
        }
    @endphp
    <div class="col-md-12">
        <div class="row ">
            <div class="col-12 outline-gray-border-area ">
                <label class="subtitle pb-1">Property Description:</label>
            </div>
            <div class="col-md-2 pt-1 {{ $descriptionDiv }} {{ empty(Helper::validate_key_value('bedroom', $propertyDescription)) ? 'd-none' : '' }}">
                <label class="font-weight-bold">Bedrooms:
                    <span class="font-weight-normal">{{ Helper::validate_key_value('bedroom', $propertyDescription) }}</span>
                </label>
            </div>
            <div class="col-md-2 pt-1 {{ $descriptionDiv }} {{ empty(Helper::validate_key_value('bathroom', $propertyDescription)) ? 'd-none' : '' }}">
                <label class="font-weight-bold">Bathrooms:
                    <span class="font-weight-normal">{{ Helper::validate_key_value('bathroom', $propertyDescription) }}</span>
                </label>
            </div>
            <div class="col-md-3 pt-1 {{ $descriptionDiv }} {{ empty(Helper::validate_key_value('home_sq_ft', $propertyDescription)) ? 'd-none' : '' }}">
                <label class="font-weight-bold">Square Feet of home:
                    <span class="font-weight-normal">{{ Helper::validate_key_value('home_sq_ft', $propertyDescription) }}  sq ft</span>
                </label>
            </div>
            <div class="col-md-3 pt-1 {{ $descriptionAndLotSizeDiv }} {{ empty(Helper::validate_key_value('lot_size_acres', $propertyDescription)) ? 'd-none' : '' }}">
                <label class="font-weight-bold">Lot Size in Acres:
                    <span class="font-weight-normal">{{ Helper::validate_key_value('lot_size_acres', $propertyDescription) }} Acre</span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label class="font-weight-bold property_main-info">Type of property:
            <span class="font-weight-normal">{{ (!empty($resident['property'])) ? $property[$resident['property']] : "" }} {{ $resident['property'] == 8 ? (isset($resident['property_other_name']) ?  "(" . ($resident['property_other_name'] ?? '') . ")" : '') : "" }}</span></label>
    </div>
    <div class="col-md-3">
        <label class="font-weight-bold ">Owned by:
            <span class="font-weight-normal">
                @php
                    $OwnedByCheck = Helper::validate_key_value('debt_owned_by', $home_car_loan);
                    if (isset($OwnedByCheck)) {
                        if ($OwnedByCheck == 1) {
                            echo 'Self';
                        } elseif ($OwnedByCheck == 2) {
                            echo 'Spouse';
                        } elseif ($OwnedByCheck == 3) {
                            echo 'Joint';
                        } elseif ($OwnedByCheck == 4) {
                            echo 'Other';
                        } elseif ($OwnedByCheck == 5) {
                            echo 'Possessory interest only';
                        }
                    }
                @endphp
            </span>
        </label>
    </div>
    <div class="col-md-3">
        <span class="bb-1px-black font-weight-bold">Property Value:</span>
        <span class="font-weight-normal text-success">${{ number_format((float)Helper::validate_key_value('estimated_property_value', $resident), 2, '.', ',') }}</span>
        @php
            $propertyId = Helper::validate_key_value('id', $resident, 'radio');
            $clientUploadedDocumentKeys = isset($client_uoloaded_documents) ? array_keys($client_uoloaded_documents) : [];
            $keyToCheck = 'Mortgage_property_value_'.$propertyId;
            $propValue = @$hide_docs == false && isset($client_uoloaded_documents[$keyToCheck]) ? $client_uoloaded_documents[$keyToCheck] : [];
        @endphp
        @if(!empty($propValue))
            <div class="font-weight-normal display-inline bradly-heading fs-18px">
                <label class="fs-18px">&nbsp;</label>
                <a href="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $keyToCheck]) }}" class="" title="Download {{ $propValue['title'] }}">
                    <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i>
                </a>
            </div>
        @endif
    </div>
    @if(!$hide_docs && !empty($resident) && isset($resident['loan_own_type_property']) && $resident['loan_own_type_property'] == 0)
    <div class="col-md-3">
        <label class="font-weight-bold text-danger ">Client selected no Mortgage Loans</label>
    </div>
    @endif
    @if(!empty($resident['not_primary_address']))
    <div class="col-md-12">
        <label class="font-weight-bold property_main-info">Address:
            <span class="font-weight-normal">{{ (!empty($resident['mortgage_address'])) ? $resident['mortgage_address'] : "" }}</span></label>
    </div>
    <div class="col-md-2">
        <label class="font-weight-bold property_main-info">City:
            <span class="font-weight-normal">{{ (!empty($resident['mortgage_city'])) ? $resident['mortgage_city'] : "" }}</span></label>
    </div>
    <div class="col-md-1">
        <label class="font-weight-bold property_main-info">State:
            <span class="font-weight-normal">{{ (!empty($resident['mortgage_state'])) ? $resident['mortgage_state'] : "" }}</span></label>
    </div>
    <div class="col-md-1">
        <label class="font-weight-bold property_main-info">Zip:
            <span class="font-weight-normal">{{ (!empty($resident['mortgage_zip'])) ? $resident['mortgage_zip'] : "" }}</span></label>
    </div>
    <div class="col-md-2"></div>
    @endif

    <div class="col-md-12 loan-information-section">
        <div class="row {{ Helper::key_hide_show_v('loan_own_type_property', $resident) }}">
            @php
                $j = 1;
            @endphp
            @foreach($loans as $key => $loan)
                @if(!empty($loan))
                    @php
                        $l1 = [];
                        if (@$hide_docs == false && isset($client_uoloaded_documents['Current_Mortgage_Statement_' . $j . '_' . $i])) {
                            $l1 = $client_uoloaded_documents['Current_Mortgage_Statement_' . $j . '_' . $i];
                        }
                    @endphp

                    @if($j > 1)
                        @php
                            if ($j == 2) {
                                $additional_loan = 'additional_loan1';
                            }
                            if ($j == 3) {
                                $additional_loan = 'additional_loan2';
                            }
                        @endphp
                        <div class="col-md-12 mt-1"></div>
                    @endif

                    <div class="col-12 outline-gray-border-area">
                        <label class="subtitle mt-1 pb-1 ">Mortgage Loan {{ $j }}: {{ Helper::validate_key_value('creditor_name', $loan) }}</label>
                    </div>




                    <div class="col-md-3">
                        <label class="font-weight-bold ">Account #:
                            <span class="font-weight-normal">{{ Helper::validate_key_value('account_number', $loan) }}</span>
                        </label>
                    </div>

                    <div class="col-md-3 ">
                        <label class="font-weight-bold ">Amount Owed :
                            <span class="font-weight-normal text-danger">${{ number_format((float)Helper::validate_key_value('amount_own', $loan, 'float'), 2, '.', ',') }}</span></label>
                    </div>

                    <div class="col-md-6">
                        <label class="font-weight-bold ">Address:
                            <span class="font-weight-normal">{{ Helper::validate_key_value('creditor_name_addresss', $loan) }}</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight-bold ">Interest rate:
                            <span class="font-weight-normal">{{ number_format((float)Helper::validate_key_value('current_interest_rate', $loan, 'float'), 2, '.', ',') }}%</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight-bold property_main-info">Date Incurred:
                            <span class="font-weight-normal">
                                {{ (!empty($loan['debt_incurred_date'])) ? $loan['debt_incurred_date'] : "" }}
                            </span>
                        </label>
                    </div>


                    <div class="col-md-2">
                        <label class="font-weight-bold ">City:
                            <span class="font-weight-normal">{{ Helper::validate_key_value('creditor_city', $loan) }}</span></label>
                    </div>
                    <div class="col-md-1">
                        <label class="font-weight-bold ">State:
                            <span class="font-weight-normal">{{ Helper::validate_key_value('creditor_state', $loan) }}</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight-bold ">Zip:
                            <span class="font-weight-normal">{{ Helper::validate_key_value('creditor_zip', $loan) }}</span></label>
                    </div>

                    <div class="col-md-3">
                        <label class="font-weight-bold ">Arrears:
                            <span class="font-weight-normal text-danger">${{ number_format((float)Helper::validate_key_value('due_payment', $loan, 'float'), 2, '.', ',') }}</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight-bold ">Payment:
                            <span class="font-weight-normal section-title bg-unset border-0 " style="display: contents;">${{ number_format((float)Helper::validate_key_value('monthly_payment', $loan, 'float'), 2, '.', ',') }}</span></label>
                    </div>
                    @php
                    $payment_tax_insurance = Helper::validate_key_value('payment_tax_insurance', $loan, 'radio');
                    $yesNoColorClass = 'text-danger';
                    if ($payment_tax_insurance == 2) {
                        $yesNoColorClass = 'text-success';
                    }
                    @endphp
                    <div class="col-md-6">
                        <label class="font-weight-bold ">Do your payments include taxes and/or insurance:
                            <span class="font-weight-normal {{ $yesNoColorClass }}">{{ ($payment_tax_insurance == 2) ? 'Yes' : 'No' }}</span></label>
                    </div>
                    <div class="col-md-6">
                        @if (!$hide_docs && isset($l1) && !empty($l1))
                            <span class="font-weight-normal bradly-heading fs-18px"><span class="bb-1px-black">{{$l1['title']}}:</span> <a href="{{ route('client_doc_download', ['id' => $l1['document_id']]) }}" class="ml-2 text-c-blue" title="Download {{ $l1['title'] }}"> <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i></a></span>
                        @endif
                    </div>


                    @php
                    $is_mortgage_three_months_loan = Helper::validate_key_value('is_mortgage_three_months', $loan);
                    $is_mortgage_three_months_show_hide = "hide-data";
                    if ($is_mortgage_three_months_loan == 1) {
                        $is_mortgage_three_months_show_hide = "";
                    }
                    @endphp
                    <div class="col-md-9">
                        <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                            <span class="font-weight-normal">{{ Helper::key_display('is_mortgage_three_months', $loan) }}</span></label>
                    </div>
                    <div class="col-md-6 {{ $is_mortgage_three_months_show_hide }}">
                        @php
                        $payments = "<span class='text-success'>$" . number_format((float)Helper::validate_key_value('payment_1', $loan), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_1', $loan) . ")";
                        $payments .= ", <span class='text-success'>$" . number_format((float)Helper::validate_key_value('payment_2', $loan), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_2', $loan) . ")";
                        $payments .= ", <span class='text-success'>$" . number_format((float)Helper::validate_key_value('payment_3', $loan), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_3', $loan) . ")";
                        @endphp
                        <label class="font-weight-bold ">Payments:
                            <span class="font-weight-normal">{!! $payments !!}</span></label>
                    </div>
                    <div class="col-md-3 {{ $is_mortgage_three_months_show_hide }}">
                        <label class="font-weight-bold ">Total Amount Paid:
                            <span class="font-weight-normal text-success">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $loan), 2, '.', ',') }}</span></label>
                    </div>
                    <div class="col-md-3">
                        @php $colorClass = '';
                        if (isset($resident['retain_above_property']) && $resident['retain_above_property'] == 1) {
                            $colorClass = 'text-c-blue';
                        }
                        if (isset($resident['retain_above_property']) && $resident['retain_above_property'] == 0) {
                            $colorClass = 'text-danger';
                        }
                        @endphp
                        <label class="font-weight-bold">Retain Property:
                            <span class="font-weight-normal {{ $colorClass }}">
                                {{ Helper::key_display('retain_above_property', $resident) }}
                            </span>
                        </label>
                    </div>
                    @if(isset($loan['property_owned_by']) && in_array($loan['property_owned_by'], Helper::OWNBY_FORM_VALUES))
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <span class="section-title font-weight-bold font-lg-12 text-lightblue bg-unset border-0">Co-Debtor Information:</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold ">Codebtor Name:
                                        <span class="font-weight-normal">{{ Helper::validate_key_value('codebtor_creditor_name', $loan) }}</span></label>
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold ">Street Address:
                                        <span class="font-weight-normal">{{ Helper::validate_key_value('codebtor_creditor_name_addresss', $loan) }}</span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">City:
                                        <span class="font-weight-normal">{{ Helper::validate_key_value('codebtor_creditor_city', $loan) }}</span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">State:
                                        <span class="font-weight-normal">{{ Helper::validate_key_value('codebtor_creditor_state', $loan) }}</span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">Zip:
                                        <span class="font-weight-normal">{{ Helper::validate_key_value('codebtor_creditor_zip', $loan) }}</span></label>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php $j++; @endphp
                @endif
            @endforeach
        </div>
    </div>
@endif