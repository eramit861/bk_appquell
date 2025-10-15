<div class="sign_up_bgs">
    <div class="container-fluid">
        <div class="row py-0 page-flex">
            <div class="col-md-12">
                <div class="form_colm row py-4">
                    <div class="col-md-12 mb-3">
                        <div class="title-h mt-1 d-flex">
                            @php
                                $propertyTypes = Helper::getResidence() + [
                                    'Current_Mortgage_Statement' => 'Current Mortgage Statement',
                                ];
                                $propertyresident = $resident['propertyresident'];
                            @endphp
                            <h4><strong>Confirm {{ $propertyTypes[$data['document_type']] ?? '' }} details: </strong>
                            </h4>
                        </div>
                    </div>

                    @php
                        $routeUrl = route('setup_scanned_resident');
                        $documentType = $data['document_type'];
                        $ocr = !empty($data['data']) ? json_decode($data['data'], 1) : [];

                        if (isset($ocr['regular_payment_amount'])) {
                            $ocr['regular_payment_amount'] = str_replace(',', '', $ocr['regular_payment_amount']);
                            $ocr['regular_payment_amount'] = str_replace('$', '', $ocr['regular_payment_amount']);
                            $ocr['regular_payment_amount'] = number_format(
                                (float) $ocr['regular_payment_amount'],
                                2,
                                '.',
                                '',
                            );
                        }

                        if (isset($ocr['monthly_payment'])) {
                            $ocr['monthly_payment'] = str_replace(',', '', $ocr['monthly_payment']);
                            $ocr['monthly_payment'] = str_replace('$', '', $ocr['monthly_payment']);
                            $ocr['regular_payment_amount'] = number_format((float) $ocr['monthly_payment'], 2, '.', '');
                        }

                        if (isset($ocr['total_due'])) {
                            $ocr['total_due'] = str_replace(',', '', $ocr['total_due']);
                            $ocr['total_due'] = str_replace('$', '', $ocr['total_due']);
                            $ocr['total_due'] = number_format((float) $ocr['total_due'], 2, '.', '');
                        }

                        if (isset($ocr['loan_total_amount'])) {
                            $ocr['loan_total_amount'] = str_replace(',', '', $ocr['loan_total_amount']);
                            $ocr['loan_total_amount'] = str_replace('$', '', $ocr['loan_total_amount']);
                            $ocr['total_due'] = number_format((float) $ocr['loan_total_amount'], 2, '.', '');
                        }

                        if (isset($ocr['loan_total_amount'])) {
                            $ocr['loan_total_amount'] = str_replace(',', '', $ocr['loan_total_amount']);
                            $ocr['loan_total_amount'] = str_replace('$', '', $ocr['loan_total_amount']);
                            $ocr['total_due'] = number_format((float) $ocr['loan_total_amount'], 2, '.', '');
                        }

                        if (!isset($ocr['total_due'])) {
                            $ocr['amount_own'] = str_replace(',', '', $ocr['amount_own']);
                            $ocr['amount_own'] = str_replace('$', '', $ocr['amount_own']);
                            $ocr['total_due'] = number_format((float) $ocr['amount_own'], 2, '.', '');
                        }

                        if (isset($ocr['interest_rate'])) {
                            $ocr['interest_rate'] = str_replace(',', '', $ocr['interest_rate']);
                            $ocr['interest_rate'] = str_replace('%', '', $ocr['interest_rate']);
                            $ocr['interest_rate'] = number_format((float) $ocr['interest_rate'], 2, '.', '');
                        }

                        if (isset($ocr['principal_due'])) {
                            $ocr['principal_due'] = str_replace(',', '', $ocr['principal_due']);
                            $ocr['principal_due'] = str_replace('$', '', $ocr['principal_due']);
                            $ocr['principal_due'] = number_format((float) $ocr['principal_due'], 2, '.', '');
                        }

                        if (isset($ocr['past_due_amount'])) {
                            $ocr['past_due_amount'] = str_replace(',', '', $ocr['past_due_amount']);
                            $ocr['past_due_amount'] = str_replace('$', '', $ocr['past_due_amount']);
                            $ocr['past_due_amount'] = number_format((float) $ocr['past_due_amount'], 2, '.', '');
                        }

                        if (isset($ocr['principal_balance'])) {
                            $ocr['principal_balance'] = str_replace(',', '', $ocr['principal_balance']);
                            $ocr['principal_balance'] = str_replace('$', '', $ocr['principal_balance']);
                            $ocr['principal_balance'] = number_format((float) $ocr['principal_balance'], 2, '.', '');
                        }

                        /*final one*/
                        if (isset($ocr['principal_balance'])) {
                            $ocr['principal_balance'] = str_replace(',', '', $ocr['principal_balance']);
                            $ocr['principal_balance'] = str_replace('$', '', $ocr['principal_balance']);
                            $ocr['principal_balance'] = number_format((float) $ocr['principal_balance'], 2, '.', '');
                        }

                        if (isset($ocr['servicer_name'])) {
                            $ocr['servicer_name'] = str_replace("\n", ' ', @$ocr['servicer_name']);
                        }

                        if (isset($ocr['Mortgage Company'])) {
                            $ocr['servicer_name'] = str_replace("\n", ' ', @$ocr['Mortgage Company']);
                        }

                        if (isset($ocr['mortgage_company'])) {
                            $ocr['servicer_name'] = str_replace("\n", ' ', @$ocr['mortgage_company']);
                        }

                        /*final one*/
                        if (isset($ocr['loan_company'])) {
                            $ocr['servicer_name'] = str_replace("\n", ' ', @$ocr['loan_company']);
                        }

                        $addressItems = [];
                        $creditorAddress = '';
                        $creditorCity = '';
                        $creditorstate = '';
                        $creditorzip = '';
                        if (isset($ocr['servicer_address'])) {
                            $addressItems = explode(',', @$ocr['servicer_address']);
                            if (!empty($addressItems)) {
                                $addressandCity = explode("\n", $addressItems[0]);
                                $creditorAddress = $addressandCity[0] ?? '';
                                $creditorCity = $addressandCity[1] ?? '';
                                $stateandzip = array_filter(explode(' ', $addressItems[1]));
                                $creditorstate = is_array($stateandzip) ? current($stateandzip) : '';
                                $creditorzip = is_array($stateandzip) ? end($stateandzip) : '';
                                $zipArray = explode('-', $creditorzip);
                                $creditorzip = $zipArray[0] ?? '';
                            }
                        } else {
                            $creditorAddress = $ocr['address'] ?? '';
                            $creditorCity = $ocr['city'] ?? '';
                            $creditorstate = $ocr['state'] ?? '';
                            $creditorzip = $ocr['zip'] ?? '';
                            $zipa = explode('-', $creditorzip);
                            $creditorzip = $zipa[0] ?? '';
                        }
                    @endphp
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="align-left">
                                    <form method="POST" id="dl_autoloan_confirm" name="dl_autoloan_confirm"
                                        action="{{ $routeUrl }}" novalidate>
                                        <div>
                                            @csrf
                                            <div class="row form_bgp">


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Is this your primary address?</label><br>
                                                        <div class="d-inline radio-primary">
                                                            <input type="radio" onclick="isCurrentAddress('yes')"
                                                                id="is_this_primary_address_yes"
                                                                name="is_this_primary_address" value="1"
                                                                class="required is_this_primary_address" required />
                                                            <label for="is_this_primary_address_yes"
                                                                class="cr">Yes</label>
                                                        </div>
                                                        <div class="d-inline radio-primary">
                                                            <input type="radio" onclick="isCurrentAddress('no')"
                                                                id="is_this_primary_address_no"
                                                                name="is_this_primary_address" value="0"
                                                                class="required is_this_primary_address" required />
                                                            <label for="is_this_primary_address_no"
                                                                class="cr">No</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row new_address_div hide-data">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Street Address</label>
                                                                <div class="input-group mb-4">
                                                                    <input id="mortgage_address" required
                                                                        placeholder= "Address" type="text"
                                                                        class="form-control" value=""
                                                                        name="mortgage_address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <div class="input-group mb-4">
                                                                    <input id="mortgage_city" placeholder= "City"
                                                                        required type="text" class="form-control"
                                                                        value="" name="mortgage_city">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <div class="input-group mb-4">
                                                                    <select class="form-control required" required
                                                                        name="mortgage_state">
                                                                        <option value="">Please Select State
                                                                        </option>
                                                                        {!! AddressHelper::getStatesList() !!}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Zip</label>
                                                                <div class="input-group mb-4">
                                                                    <input id="mortgage_zip" required placeholder= "Zip"
                                                                        type="text" class="allow-5digit form-control"
                                                                        value="" name="mortgage_zip">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>County</label>
                                                                <div class="input-group mb-4">
                                                                    <input id="mortgage_county" required
                                                                        placeholder= "County" type="text"
                                                                        class="form-control" value=""
                                                                        name="mortgage_county">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Creditor Name</label>
                                                        <div class="input-group mb-3">
                                                            <input id="creditor_name" required
                                                                placeholder= "Creditor Name" type="text"
                                                                class="form-control ocr_creditor_name"
                                                                name="creditor_name"
                                                                value="{{ $ocr['servicer_name'] ?? '' }}" autofocus>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <div class="input-group mb-4">
                                                            <input id="creditor_name_addresss" placeholder= "Address"
                                                                type="text" class="form-control"
                                                                value="{{ $creditorAddress ?? '' }}"
                                                                name="creditor_name_addresss">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <div class="input-group mb-4">
                                                            <input id="creditor_city" required placeholder= "City"
                                                                type="text" class="form-control"
                                                                value="{{ $creditorCity ?? '' }}"
                                                                name="creditor_city">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <div class="input-group mb-4">
                                                            <select id="creditor_state" class="form-control required"
                                                                required name="creditor_state">
                                                                <option value="">Please Select State</option>
                                                                {!! AddressHelper::getStatesList($creditorstate ?? '') !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Zip</label>
                                                        <div class="input-group mb-4">
                                                            <input id="creditor_zip" required placeholder= "Zip"
                                                                type="text" class="allow-5digit form-control"
                                                                value="{{ $creditorzip ?? '' }}" name="creditor_zip">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Interest rate</label>
                                                        <div class="input-group mb-4">

                                                            <input id="current_interest_rate" required
                                                                placeholder= "Interest rate" type="number"
                                                                class="price-field form-control"
                                                                value="{{ $ocr['interest_rate'] ?? '' }}"
                                                                name="current_interest_rate">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Amount Owed</label>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">$</span>
                                                            </div>
                                                            <input id="amount_own" required placeholder= "Amount Own"
                                                                type="number" class="price-field form-control"
                                                                value="{{ $ocr['total_due'] ?? '' }}"
                                                                name="amount_own">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Monthly payment amount:</label>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">$</span>
                                                            </div>
                                                            <input id="monthly_payment" required
                                                                placeholder= "Monthly Payment" type="number"
                                                                class="price-field form-control"
                                                                value="{{ $ocr['regular_payment_amount'] ?? '' }}"
                                                                name="monthly_payment">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Past due payment:</label>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">$</span>
                                                            </div>
                                                            <input id="due_payment" required
                                                                placeholder= "Past due payment" type="number"
                                                                class="price-field form-control"
                                                                value="{{ $ocr['past_due_amount'] ?? '' }}"
                                                                name="due_payment">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Account Number</label>
                                                        <div class="input-group mb-4">
                                                            <input id="account_number" required
                                                                placeholder= "Account number" type="text"
                                                                class="form-control"
                                                                value="{{ $ocr['account_number'] ?? '' }}"
                                                                name="account_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Date when debt was incurred</label>
                                                        <div class="input-group mb-4">
                                                            <input id="debt_incurred_date" required
                                                                placeholder="MM/DD/YYYY" type="text"
                                                                class="date_filed form-control" value=""
                                                                name="debt_incurred_date">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Have you made any payments on this mortgage in the last 3
                                                            months?</label><br>
                                                        <div class="d-inline radio-primary">
                                                            <input type="radio"
                                                                onclick="isMortgageThreeMonth('yes')"
                                                                id="is_mortgage_three_months_yes"
                                                                name="is_mortgage_three_months" value="1"
                                                                class="required is_mortgage_three_months" required />
                                                            <label for="is_mortgage_three_months_yes"
                                                                class="cr">Yes</label>
                                                        </div>
                                                        <div class="d-inline radio-primary">
                                                            <input type="radio" onclick="isMortgageThreeMonth('no')"
                                                                id="is_mortgage_three_months_no"
                                                                name="is_mortgage_three_months" value="0"
                                                                class="required is_mortgage_three_months" required />
                                                            <label for="is_mortgage_three_months_no"
                                                                class="cr">No</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row three_months_div hide-data">

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Date of Payment</label>
                                                                <div class="input-group mb-4">
                                                                    <input id="payment_dates_1" required
                                                                        placeholder="MM/YYYY" type="text"
                                                                        class="date_month_year form-control"
                                                                        value="" name="payment_dates_1">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Date of Payment</label>
                                                                <div class="input-group mb-4">
                                                                    <input id="payment_dates_2" required
                                                                        placeholder="MM/YYYY" type="text"
                                                                        class="date_month_year form-control"
                                                                        value="" name="payment_dates_2">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Date of Payment</label>
                                                                <div class="input-group mb-4">
                                                                    <input id="payment_dates_3" required
                                                                        placeholder="MM/YYYY" type="text"
                                                                        class="date_month_year form-control"
                                                                        value="" name="payment_dates_3">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Total Amount Paid</label>
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon1">$</span>
                                                                    </div>
                                                                    <input id="total_amount_paid" required
                                                                        placeholder= "Monthly Payment" type="number"
                                                                        class="price-field form-control"
                                                                        value="" name="total_amount_paid">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Amount Still Owed</label>
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon1">$</span>
                                                                    </div>
                                                                    <input id="amount_still_owed" required
                                                                        placeholder= "Monthly Payment" type="number"
                                                                        class="price-field form-control"
                                                                        value="" name="amount_still_owed">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="ocr_id"
                                                    value="{{ $data['id'] ?? '' }}">
                                                <input type="hidden" name="borrower_address"
                                                    value="{{ $ocr['borrower_address'] ?? '' }}">
                                                <input type="hidden" name="borrower_name"
                                                    value="{{ $ocr['borrower_name'] ?? '' }}">

                                                <div class="col-md-12 mb-3">
                                                    <div class="title-h mt-1 d-flex">
                                                        <h5><strong>Select Mortgage in which you want to import:
                                                            </strong></h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach ($propertyresident as $ocrval)
                                                                    @php
                                                                        $propertName = '';
                                                                        if ($ocrval['not_primary_address'] == 0) {
                                                                            $propertName = $clientAddress;
                                                                        } else {
                                                                            $propertName .= $ocrval['mortgage_address'];
                                                                            $propertName .=
                                                                                ', ' . $ocrval['mortgage_city'];
                                                                            $propertName .=
                                                                                ', ' . $ocrval['mortgage_state'];
                                                                            $propertName .=
                                                                                ', ' . $ocrval['mortgage_zip'];
                                                                        }

                                                                        $loan1 = '';
                                                                        $loan2 = '';
                                                                        $loan3 = '';
                                                                        if (
                                                                            isset($ocrval['currently_lived']) &&
                                                                            $ocrval['currently_lived'] &&
                                                                            $ocrval['loan_own_type_property'] == 1
                                                                        ) {
                                                                            $loan1 = json_decode(
                                                                                $ocrval['home_car_loan'],
                                                                                1,
                                                                            );
                                                                            if (!empty($ocrval['home_car_loan2'])) {
                                                                                $loan2 = json_decode(
                                                                                    $ocrval['home_car_loan2'],
                                                                                    1,
                                                                                );
                                                                                if (
                                                                                    isset($loan2['additional_loan1']) &&
                                                                                    $loan2['additional_loan1'] == 0
                                                                                ) {
                                                                                    $loan2 = '';
                                                                                }
                                                                            }

                                                                            if (!empty($ocrval['home_car_loan3'])) {
                                                                                $loan3 = json_decode(
                                                                                    $ocrval['home_car_loan3'],
                                                                                    1,
                                                                                );
                                                                                if (
                                                                                    isset($loan3['additional_loan2']) &&
                                                                                    $loan3['additional_loan2'] == 0
                                                                                ) {
                                                                                    $loan3 = '';
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <h6 class="d-block">
                                                                                <strong>{{ $i }}). Property
                                                                                    Address:</strong>
                                                                                {{ $propertName }}</h6>
                                                                            <div class="d-inline radio-primary">
                                                                                @php $id = !empty($ocrval['id']) ? $ocrval['id'] : 0; @endphp
                                                                                <input
                                                                                    id="mortgage1-{{ $i }}"
                                                                                    required class=""
                                                                                    type="radio"
                                                                                    name="import_into_property"
                                                                                    value="1_{{ $i }}-{{ $id }}">
                                                                                <label
                                                                                    for="mortgage1-{{ $i }}"
                                                                                    class="cr">Mortgage 1</label>
                                                                            </div>
                                                                            @if (!empty($loan1))
                                                                                <div class="d-inline radio-primary">
                                                                                    <input
                                                                                        id="mortgage2-{{ $i }}"
                                                                                        required class=""
                                                                                        type="radio"
                                                                                        name="import_into_property"
                                                                                        value="2_{{ $i }}-{{ $id }}">
                                                                                    <label
                                                                                        for="mortgage2-{{ $i }}"
                                                                                        class="cr">Mortgage
                                                                                        2</label>
                                                                                </div>
                                                                            @endif
                                                                            @if (!empty($loan2))
                                                                                <div class="d-inline radio-primary">
                                                                                    <input
                                                                                        id="mortgage3-{{ $i }}"
                                                                                        required type="radio"
                                                                                        class=""
                                                                                        name="import_into_property"
                                                                                        value="3_{{ $i }}-{{ $id }}">
                                                                                    <label
                                                                                        for="mortgage3-{{ $i }}"
                                                                                        class="cr">Mortgage
                                                                                        3</label>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @php $i++; @endphp
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div style="display:inline-flex;"
                                                                    class="radio-primary">
                                                                    @php $id = 0; @endphp
                                                                    <input id="loan-0" class="" required
                                                                        type="radio" name="import_into_property"
                                                                        value="new">
                                                                    <label for="loan-0" class="cr">Import to new
                                                                        property</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="col-md-12 align-right login-btn">
                                                    <button type="submit"
                                                        class="btn btn-primary shadow-2 mb-4">Import</button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@push('tab_scripts')
    <script>
        window.__residentOcrRoutes = {
            setupScannedResident: "{{ route('setup_scanned_resident') }}",
            mortgageSearch: "{{ route('mortgage_search') }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/resident_ocr_form.js') }}"></script>
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/resident_ocr_form.css') }}">
@endpush
