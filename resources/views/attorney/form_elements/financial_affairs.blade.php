@php
    $current_marital_Status = Helper::validate_key_value('current_marital_Status', $financialaffairs_info, 'radio');
    $maritalStatus = '';
    if ($current_marital_Status == 0 || $current_marital_Status == 1) {
        if ($client_type == 1) {
            $maritalStatus = 0;
        }
        if ($client_type == 2 || $client_type == 3) {
            $maritalStatus = 1;
        }
    }
@endphp

<div class="part-a outline-gray-border-area">
    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center ">
                <div class="circle-number-div">1</div>
                <span class="item-label questionaire-label">What is your current Marital Status: </span>
                <span
                    class="lable-sub-section ml-2 item-label">{{ isset($financialaffairs_info['current_marital_Status']) ? ArrayHelper::getMarriedArray($maritalStatus) : 'None' }}</span>
            </h2>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center ">
                <div class="circle-number-div">2</div>
                <span class="item-label questionaire-label">During the last <span class="text-c-blue">3 years</span>,
                    have you lived anywhere other than where you live now: </span>
                <span class="lable-sub-section ml-2 item-label">{!! Helper::key_display_none_type_reverse('list_every_address', $financialaffairs_info) !!}</span>
            </h2>
            <div class="row gx-3 set-mobile-col">
                {{-- Previous Addresses Section --}}
                @if (empty(Helper::validate_key_value('list_every_address', $financialaffairs_info)) &&
                        !empty($financialaffairs_info['prev_address']['creditor_street']))
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <div class="colum-heading-main">
                                    <span class="section-title font-weight-bold font-lg-12"> Previous Address(s):</span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="colum-heading-main">
                                    <span class="section-title font-weight-bold font-lg-12">Dates lived there:</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @for ($i = 0; $i < count($financialaffairs_info['prev_address']['creditor_street']); $i++)
                        <div class="col-md-12 ">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{ $i + 1 }}. <span class="font-weight-bold">Street
                                                    Address:</span>
                                                <span
                                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_street', $financialaffairs_info['prev_address'], $i) }}
                                                </span> </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="font-weight-bold ">City:
                                                <span
                                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_city', $financialaffairs_info['prev_address'], $i) }}
                                                </span> </label>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <label class="font-weight-bold ">State:
                                                <span
                                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_state', $financialaffairs_info['prev_address'], $i) }}
                                                </span> </label>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <label class="font-weight-bold ">Zip Code:
                                                <span
                                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_zip', $financialaffairs_info['prev_address'], $i) }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label class="font-weight-bold ">From:
                                        @php
                                            $dateFrom = Helper::validate_key_loop_value(
                                                'from',
                                                $financialaffairs_info['prev_address'],
                                                $i,
                                            );
                                            if (strtotime($dateFrom) != false && strlen($dateFrom) > 7) {
                                                $dateFrom = date('m/Y', strtotime($dateFrom));
                                            }
                                        @endphp
                                        <span class="font-weight-normal">{{ $dateFrom }}</span>
                                    </label>
                                    <label class="font-weight-bold ">To:
                                        @php
                                            $dateTo = Helper::validate_key_loop_value(
                                                'to',
                                                $financialaffairs_info['prev_address'],
                                                $i,
                                            );
                                            if (strtotime($dateTo) != false && strlen($dateTo) > 7) {
                                                $dateTo = date('m/Y', strtotime($dateTo));
                                            }
                                        @endphp
                                        <span class="font-weight-normal">{{ $dateTo }}</span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center w-95">
                <div class="circle-number-div">3</div>
                <span class="item-label questionaire-label">Within the last 8 years, did you ever live with a spouse or
                    legal equivalent in a community property state or territory?
                    <span class="text-c-blue">(Community property states and territories include Arizona, California,
                        Idaho, Louisiana, Nevada, New Mexico, Puerto Rico, Texas, Washington, and Wisconsin.): </span>
                    <span class="lable-sub-section ml-2 text-danger item-label">
                        {!! Helper::key_display_attorney_ques('living_domestic_partner', $financialaffairs_info) !!}
                    </span>
                </span>
            </h2>
            <div
                class="row gx-3 set-mobile-col  {{ Helper::key_hide_show_v('living_domestic_partner', $financialaffairs_info) }}">
                {{-- Community Property State Section --}}
                @php
                    $count = 0;
                @endphp

                @if (!empty($financialaffairs_info['community_property_state']))
                    @for ($i = 0; $i < count($financialaffairs_info['community_property_state']); $i++)
                        @php $count = $count + 1; @endphp
                        <div class="col-md-5 ">
                            <div class="row mt-2">
                                <div class="col-md-12 ">
                                    <div class="colum-heading-main">
                                        {{ $count }}.
                                        <label class="font-weight-bold ">Community Property State or Territory:
                                            <span
                                                class="font-weight-normal">{{ Helper::validate_key_loop_value('community_property_state', $financialaffairs_info, $i) }}
                                            </span> </label>
                                    </div>
                                    @php
                                        $yesNoQue = $financialaffairs_info['domestic_partner_living'][$i] ?? '';
                                        $showDiv = 'd-none';
                                        if (isset($yesNoQue) && $yesNoQue == 1) {
                                            $showDiv = '';
                                        }
                                    @endphp
                                </div>

                                <div class="col-md-12 {{ $showDiv }}">
                                    <label class="font-weight-bold ">Name:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner', $financialaffairs_info, $i) }}
                                        </span> </label>
                                </div>
                                <div class="col-md-12 {{ $showDiv }}">
                                    <label class="font-weight-bold">Street Address:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_street_address', $financialaffairs_info, $i) }}
                                        </span> </label>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-4 {{ $showDiv }}">
                                    <label class="font-weight-bold ">City:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_city', $financialaffairs_info, $i) }}
                                        </span> </label>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-2 {{ $showDiv }}">
                                    <label class="font-weight-bold ">State:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_state', $financialaffairs_info, $i) }}
                                        </span> </label>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6 {{ $showDiv }}">
                                    <label class="font-weight-bold ">Zip:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('domestic_partner_zip', $financialaffairs_info, $i) }}</span>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Did your spouse or legal equivalent live with you
                                        at the time:
                                        <span class="font-weight-normal">
                                            @php
                                                $arrayOfYes = [1 => 'Yes', 0 => 'No'];
                                                $key = $financialaffairs_info['domestic_partner_living'][$i] ?? null;
                                            @endphp
                                            {{ $arrayOfYes[$key] ?? '' }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">4</div>
                <span class="item-label questionaire-label">Did you have any income from employment or from operating a
                    business during this year or the two previous calendar years?</span>
                @php
                    $questionname = Helper::key_display_attorney_ques_plain(
                        'total_amount_income',
                        $financialaffairs_info,
                    );
                @endphp
                @if (isset($questionname))
                    @php $color = $questionname == 'None' ? 'red text-bold' : 'green font-weight-normal'; @endphp
                    <span
                        class="lable-sub-section ml-2 item-label text-c-{{ $color }}">{{ $questionname }}</span>
                @endif
            </h2>
            <div class="row gx-3 set-mobile-col ">
                <div
                    class="row col-lg-12 col-xl-6 sec_merger {{ Helper::key_hide_show_v('total_amount_income', $financialaffairs_info) }}">
                    <x-listAmountOfIncome spouse="" :financialaffairs_info="$financialaffairs_info"></x-listAmountOfIncome>
                </div>
                <!--Spouse-->
                <div
                    class="row col-lg-12 col-xl-6 sec_merger {{ Helper::key_hide_show_v('total_amount_income', $financialaffairs_info) }}">
                    <x-listAmountOfIncome spouse="spouse_" :financialaffairs_info="$financialaffairs_info">
                    </x-listAmountOfIncome>
                </div>
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">5</div>
                <span class="item-label questionaire-label">Did you receive any other income during this year or the two
                    previous calendar years?</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('other_income_received_income', $financialaffairs_info) !!}</span>

            </h2>
            <div class="row gx-3 set-mobile-col ">
                <div
                    class="col-lg-12 col-xl-6 sec_merger pl-4 {{ Helper::key_hide_show_v('other_income_received_income', $financialaffairs_info) }}">
                    <div class="row">
                        <x-sofaOtherIncomeListDebtor :mainData='$financialaffairs_info' />
                    </div>
                </div>
                <div
                    class="col-lg-12 col-xl-6 sec_merger pl-4 {{ Helper::key_hide_show_v('other_income_received_income', $financialaffairs_info) }}">
                    <div class="row">
                        <x-sofaOtherIncomeListCoDebtor :mainData="$financialaffairs_info" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">6</div>
                <span class="item-label questionaire-label">Did you make any
                    payments on any of your debts in the last 90 days: <span class='text-c-blue'>(List ALL mortgage
                        payments, car payments credit card payments etc.):</span>
                    <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('primarily_consumer_debets', $financialaffairs_info) !!}</span>

            </h2>
            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('primarily_consumer_debets', $financialaffairs_info) }}">
                @if (!empty($financialaffairs_info['primarily_consumer_debets_data']))
                    @for ($i = 0; $i < count($financialaffairs_info['primarily_consumer_debets_data']['creditor_address']); $i++)
                        @if (
                            (float) Helper::validate_key_loop_value(
                                'total_amount_paid',
                                @$financialaffairs_info['primarily_consumer_debets_data'],
                                $i) >= 600)
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <x-financialAddressWithKey nameLabel="Name" nameKey="creditor_address"
                                                addressLabel="Address" addressKey="creditor_street" cityLabel="City"
                                                cityKey="creditor_city" stateLabel="State" stateKey="creditor_state"
                                                zipLabel="Zip" zipKey="creditor_zip" :finacial_affairst="@$financialaffairs_info['primarily_consumer_debets_data']"
                                                :i="$i">
                                            </x-financialAddressWithKey>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-8">
                                                @php
                                                    $payment_for_status = [
                                                        1 => 'Mortgage',
                                                        2 => 'Car',
                                                        3 => 'Credit card',
                                                        4 => 'Loan repayment',
                                                        5 => 'Suppliers or vendor',
                                                        6 => 'Other',
                                                    ];
                                                @endphp
                                                <label class="font-weight-bold ">Payment(s) where for: <span
                                                        class="font-weight-normal text-c-blue">
                                                        @if (isset($financialaffairs_info['primarily_consumer_debets_data']['creditor_payment_for'][$i]))
                                                            {{ !empty($financialaffairs_info['primarily_consumer_debets_data']['creditor_payment_for']) ? $payment_for_status[$financialaffairs_info['primarily_consumer_debets_data']['creditor_payment_for'][$i]] : '' }}
                                                        @endif
                                                    </span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="font-weight-bold ">Amount Still Owed: <span
                                                        class="font-weight-normal text-danger">${{ number_format((float) Helper::validate_key_loop_value('amount_still_owed', @$financialaffairs_info['primarily_consumer_debets_data'], $i), 2, '.', ',') }}</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                @php
                                                    $payments =
                                                        " <span class='text-c-green'>$" .
                                                        number_format(
                                                            (float) Helper::validate_key_loop_value(
                                                                'payment_1',
                                                                $financialaffairs_info[
                                                                    'primarily_consumer_debets_data'
                                                                ],
                                                                $i,
                                                            ),
                                                            2,
                                                            '.',
                                                            ',',
                                                        ) .
                                                        '</span> (' .
                                                        Helper::validate_key_loop_value(
                                                            'payment_dates',
                                                            $financialaffairs_info['primarily_consumer_debets_data'],
                                                            $i,
                                                        ) .
                                                        ')';
                                                    $payments .=
                                                        ", <span class='text-c-green'>$" .
                                                        number_format(
                                                            (float) Helper::validate_key_loop_value(
                                                                'payment_2',
                                                                $financialaffairs_info[
                                                                    'primarily_consumer_debets_data'
                                                                ],
                                                                $i,
                                                            ),
                                                            2,
                                                            '.',
                                                            ',',
                                                        ) .
                                                        '</span> (' .
                                                        Helper::validate_key_loop_value(
                                                            'payment_dates2',
                                                            $financialaffairs_info['primarily_consumer_debets_data'],
                                                            $i,
                                                        ) .
                                                        ')';
                                                    $payments .=
                                                        ", <span class='text-c-green'>$" .
                                                        number_format(
                                                            (float) Helper::validate_key_loop_value(
                                                                'payment_3',
                                                                $financialaffairs_info[
                                                                    'primarily_consumer_debets_data'
                                                                ],
                                                                $i,
                                                            ),
                                                            2,
                                                            '.',
                                                            ',',
                                                        ) .
                                                        '</span> (' .
                                                        Helper::validate_key_loop_value(
                                                            'payment_dates3',
                                                            $financialaffairs_info['primarily_consumer_debets_data'],
                                                            $i,
                                                        ) .
                                                        ')';
                                                @endphp
                                                <label class="font-weight-bold ">Payment(s):
                                                    <span
                                                        class="font-weight-normal">{!! $payments !!}</span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="font-weight-bold ">Total Amount Paid: <span
                                                        class="font-weight-normal section-title text-success">${{ number_format((float) Helper::validate_key_loop_value('total_amount_paid', @$financialaffairs_info['primarily_consumer_debets_data'], $i), 2, '.', ',') }}</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">7</div>
                <span class="item-label questionaire-label">Within 1 year before you filed for bankruptcy, did you make
                    a payment on a debt you owed anyone who was an insider?</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('payment_past_one_year', $financialaffairs_info) !!}</span>

            </h2>
            <div
                class="row gx-3 set-mobile-col  {{ Helper::key_hide_show_v('payment_past_one_year', $financialaffairs_info) }}">
                @if (!empty($financialaffairs_info['past_one_year_data']['creditor_address_past_one_year']))
                    @for ($i = 0; $i < count($financialaffairs_info['past_one_year_data']['creditor_address_past_one_year']); $i++)
                        @php $finacial_affairspast = $financialaffairs_info['past_one_year_data']; @endphp
                        <div class="col-md-12 mt-1">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <x-financialAddressWithKey nameLabel="Name"
                                            nameKey="creditor_address_past_one_year" addressLabel="Street Address"
                                            addressKey="creditor_street_past_one_year" cityLabel="City"
                                            cityKey="creditor_city_past_one_year" stateLabel="State"
                                            stateKey="creditor_state_past_one_year" zipLabel="Zip"
                                            zipKey="creditor_zip_past_one_year" :finacial_affairst="$finacial_affairspast" :i="$i">
                                        </x-financialAddressWithKey>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="font-weight-bold ">Reason for payment: <span
                                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('past_one_year_payment_reason', $finacial_affairspast, $i) }}</span></label>
                                        </div>
                                        <div class="col-md-4">

                                            <label class="font-weight-bold ">Amount Still Owed: <span
                                                    class="font-weight-normal text-danger">${{ number_format((float) Helper::validate_key_loop_value('past_one_year_amount_still_owed', $finacial_affairspast, $i), 2, '.', ',') }}</span></label>

                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                $date1 = Helper::validate_key_loop_value(
                                                    'past_one_year_payment_dates',
                                                    $finacial_affairspast,
                                                    $i,
                                                );
                                                if (strtotime($date1) != false && strlen($date1) > 7) {
                                                    $date1 = date('m/Y', strtotime($date1));
                                                }
                                                $date2 = Helper::validate_key_loop_value(
                                                    'past_one_year_payment_dates2',
                                                    $finacial_affairspast,
                                                    $i,
                                                );
                                                if (strtotime($date2) != false && strlen($date2) > 7) {
                                                    $date2 = date('m/Y', strtotime($date2));
                                                }
                                                $date3 = Helper::validate_key_loop_value(
                                                    'past_one_year_payment_dates3',
                                                    $finacial_affairspast,
                                                    $i,
                                                );
                                                if (strtotime($date3) != false && strlen($date3) > 7) {
                                                    $date3 = date('m/Y', strtotime($date3));
                                                }
                                            @endphp
                                            <label class="font-weight-bold ">Dates of Payment:
                                                <span class="font-weight-normal">
                                                                    @php
                                                        $payment_1 = Helper::validate_key_loop_value('past_one_year_payment_1', $finacial_affairspast, $i);
                                                        $payment_2 = Helper::validate_key_loop_value('past_one_year_payment_2', $finacial_affairspast, $i);
                                                        $payment_3 = Helper::validate_key_loop_value('past_one_year_payment_3', $finacial_affairspast, $i);
                                                        $paymentOutput = '';
                                                        if (!empty($payment_1) || !empty($payment_2) || !empty($payment_3)) {
                                                            $paymentOutput .= "<span class='text-c-green'>$" . number_format((float) $payment_1, 2, '.', ',') . "</span> ($date1), ";
                                                            $paymentOutput .= "<span class='text-c-green'>$" . number_format((float) $payment_2, 2, '.', ',') . "</span> ($date2), ";
                                                            $paymentOutput .= "<span class='text-c-green'>$" . number_format((float) $payment_3, 2, '.', ',') . "</span> ($date3)";
                                                        } else {
                                                            $paymentOutput .= $date1;
                                                            $paymentOutput .= !empty($date2) ? ', ' . $date2 : '';
                                                            $paymentOutput .= !empty($date3) ? ', ' . $date3 : '';
                                                        }
                                                    @endphp
                                                    {!! $paymentOutput !!}

                                                </span>
                                            </label>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="font-weight-bold ">Total Amount Paid: <span
                                                    class="font-weight-normal section-title text-success">${{ number_format((float) Helper::validate_key_loop_value('past_one_year_total_amount_paid', $finacial_affairspast, $i), 2, '.', ',') }}</span></label>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">8</div>
                <span class="item-label questionaire-label">List all payments or transfers of property that you made
                    within the past 1 year that benefitted an "insider":</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('transfers_property', $financialaffairs_info) !!}</span>
            </h2>
            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('transfers_property', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['transfers_property_data']['creditor_address_transfers_property']))
                    @for($i = 0; $i < count($financialaffairs_info['transfers_property_data']['creditor_address_transfers_property']); $i++)
                        @php $finacial_affairstrans = $financialaffairs_info['transfers_property_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <x-financialAddressWithKey nameLabel="Name"
                                    nameKey="creditor_address_transfers_property" addressLabel="Street Address"
                                    addressKey="creditor_street_transfers_property" cityLabel="City"
                                    cityKey="creditor_city_transfers_property" stateLabel="State"
                                    stateKey="creditor_state_transfers_property" zipLabel="Zip"
                                    zipKey="creditor_zip_transfers_property" :finacial_affairst="$finacial_affairstrans"
                                    :i="$i"></x-financialAddressWithKey>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Reason for payment: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('payment_reason_transfers_property', $finacial_affairstrans, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Amount Still Owed: <span
                                            class="font-weight-normal text-danger">${{ number_format((float) Helper::validate_key_loop_value('amount_still_owed_transfers_property', $finacial_affairstrans, $i), 2, '.', ',') }}</span></label>
                                </div>

                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Dates of Payment: <span
                                            class="font-weight-normal">
                                            {{ Helper::validate_key_loop_value('payment_dates_transfers_property', $finacial_affairstrans, $i) }}
                                            {{ !empty(Helper::validate_key_loop_value('payment_dates_transfers_property2', $finacial_affairstrans, $i)) ? ', ' . Helper::validate_key_loop_value('payment_dates_transfers_property2', $finacial_affairstrans, $i) : '' }}
                                            {{ !empty(Helper::validate_key_loop_value('payment_dates_transfers_property3', $finacial_affairstrans, $i)) ? ', ' . Helper::validate_key_loop_value('payment_dates_transfers_property3', $finacial_affairstrans, $i) : '' }}
                                        </span></label>
                                </div>


                                <div class="col-md-4">
                                    <label class="font-weight-bold">Total Amount Paid: <span
                                            class="font-weight-normal text-success">${{ number_format((float) Helper::validate_key_loop_value('total_amount_paid_transfers_property', $finacial_affairstrans, $i), 2, '.', ',') }}</span></label>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">9</div>
                <span class="item-label questionaire-label">Within 1 year before you filed for bankruptcy, were you a
                    party in any lawsuit, court action, or administrative proceeding?</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_lawsuits', $financialaffairs_info) !!}</span>
            </h2>
            @php $states = [1 => 'Pending', 2 => 'On Appeal', 3 => 'Concluded']; @endphp
            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_lawsuits', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_lawsuits_data']['case_title']))
                    @for($i = 0; $i < count($financialaffairs_info['list_lawsuits_data']['case_title']); $i++)
                        @php $finacial_affairstrans = $financialaffairs_info['list_lawsuits_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">

                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Case Title: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('case_title', $finacial_affairstrans, $i) }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Case Number: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('case_number', $finacial_affairstrans, $i) }}</span></label>
                                </div>
                                <x-financialAddressWithKey nameLabel="Court or Agency" nameKey="agency_location"
                                    addressLabel="Street Address" addressKey="agency_street" cityLabel="City"
                                    cityKey="agency_city" stateLabel="State" stateKey="agency_state" zipLabel="Zip"
                                    zipKey="agency_zip" :finacial_affairst="$finacial_affairstrans" :i="$i">
                                </x-financialAddressWithKey>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Nature of the Case: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('case_nature', $finacial_affairstrans, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Status or Disposition: <span
                                            class="font-weight-normal">{{ isset($states[Helper::validate_key_loop_value('disposition', $finacial_affairstrans, $i)]) ? $states[Helper::validate_key_loop_value('disposition', $finacial_affairstrans, $i)] : '' }}</span></label>
                                </div>
                                @if(!empty($lawsuitDebts))
                                <div class="col-md-12">
                                    @php
                                        $relatedTo = Helper::validate_key_loop_value_radio('related_to', $finacial_affairstrans, $i);
                                        $credName = isset($lawsuitDebts[$relatedTo]['creditor_name']) ? $lawsuitDebts[$relatedTo]['creditor_name'] : '';
                                    @endphp
                                    <label class="font-weight-bold ">
                                        <span class="text-success">Related to Debt: </span>
                                        <span class="font-weight-normal">
                                            {{ (int) $relatedTo + 1 . '. ' . $credName }}
                                        </span>
                                    </label>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">10</div>
                <span class="item-label questionaire-label">Have you had any property <span
                        class="text-c-blue">Repossessed</span>, <span class="text-c-blue">Foreclosed</span>, <span
                        class="text-c-blue">Garnishments</span>, <span class="text-c-blue">Seized</span>, and/or <span
                        class="text-c-blue">Levied</span> in the 12 months:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('property_repossessed', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('property_repossessed', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['property_repossessed_data']))
                    @for($i = 0; $i < count($financialaffairs_info['property_repossessed_data']['creditor_address']); $i++)
                        @php $repossessed_data = $financialaffairs_info['property_repossessed_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <x-financialAddressWithKey nameLabel="Creditor's Name" nameKey="creditor_address"
                                    addressLabel="Street Address" addressKey="creditor_street" cityLabel="City"
                                    cityKey="creditor_city" stateLabel="State" stateKey="creditor_state"
                                    zipLabel="Zip" zipKey="creditor_zip" :finacial_affairst="$repossessed_data" :i="$i">
                                </x-financialAddressWithKey>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Description of Property: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_Property', @$financialaffairs_info['property_repossessed_data'], $i) }}</span></label>
                                </div>

                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Property Value: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('property_repossessed_value', @$financialaffairs_info['property_repossessed_data'], $i), 2, '.', ',') }}</span></label>
                                </div>



                                <div class="col-md-8">
                                    @php
                                        $what_happened = [1 => 'Property was repossessed', 2 => 'Property was foreclosed', 3 => 'Property was garnished', 4 => 'Property was attached, seized, or levied'];
                                        $value = Helper::validate_key_loop_value('what_happened', @$financialaffairs_info['property_repossessed_data'], $i);
                                    @endphp
                                    <label class="font-weight-bold ">Explain what happened: <span
                                            class="font-weight-normal">
                                            {{ isset($what_happened[$value]) ? $what_happened[$value] : '' }}</span>
                                    </label>
                                </div>
                                <div class="col-md-4">

                                    <label class="font-weight-bold ">Date: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_repossessed_date', @$financialaffairs_info['property_repossessed_data'], $i) }}</span></label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">11</div>
                <span class="item-label questionaire-label">Within 90 days before you filed for bankruptcy, did any
                    creditor, including a bank or financial institution, set off any amounts from your accounts or
                    refuse to make a payment because you owed a debt?</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('setoffs_creditor', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('setoffs_creditor', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['setoffs_creditor_data']['creditors_address']))
                    @for($i = 0; $i < count($financialaffairs_info['setoffs_creditor_data']['creditors_address']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['setoffs_creditor_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <x-financialAddressWithKey nameLabel="Creditor's Name" nameKey="creditors_address"
                                    addressLabel="Street Address" addressKey="creditor_street" cityLabel="City"
                                    cityKey="creditor_city" stateLabel="State" stateKey="creditor_state"
                                    zipLabel="Zip" zipKey="creditor_zip" :finacial_affairst="$finacial_affairst" :i="$i">
                                </x-financialAddressWithKey>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Last 4 Digits of Acct#: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('account_number', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Amount and Data: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('amount_data', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Action taken by creditor: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('creditors_action', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Date Action Taken: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('date_action', @$finacial_affairst, $i) }}</span></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">12</div>
                <span class="item-label questionaire-label">Within the past 1 years , was any of your property in the
                    possession of an assignee for the benefit of creditors, a court-appointed receiver, a custodian, or
                    another official:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('court_appointed', $financialaffairs_info) !!}</span>
            </h2>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">13</div>
                <span class="item-label questionaire-label">Have you <span class='text-c-blue'>Given</span> any <span
                        class='text-c-blue'>Gifts</span> with a total value of more than <span
                        class='text-c-blue'>$600 Per Person</span> within the past 2 years:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('court_appointed', $financialaffairs_info) !!}</span>
            </h2>
            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_any_gifts', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_any_gifts_data']['recipient_address']))
                    @for($i = 0; $i < count($financialaffairs_info['list_any_gifts_data']['recipient_address']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['list_any_gifts_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">

                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Person to Whom You Gave the Gift: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('recipient_address', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Street Address: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_street', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">City: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_city', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">State: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_state', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold ">Zip: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_zip', @$finacial_affairst, $i) }}</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">


                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Date you gave the Gifts: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('gifts_date_from', @$finacial_affairst, $i) }}</span></label>
                                </div>


                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Value of Gifts: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('gifts_value', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Date you gave the Gifts: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('gifts_date_to', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Value of Gifts: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('gifts_value1', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Description of Gifts: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('gifts', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Relationship to You: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('relationship', @$finacial_affairst, $i) }}</span></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">14</div>
                <span class="item-label questionaire-label">Have you <span class='text-c-blue'>Given any Gifts</span>
                    and/or <span class='text-c-blue'>Contributions</span> with a total value of more than <span
                        class='text-c-blue'>$600 to any Charity</span> within the past 2 years: </span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('gifts_charity', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('gifts_charity', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['gifts_charity_data']['charity_address']))
                    @for($i = 0; $i < count($financialaffairs_info['gifts_charity_data']['charity_address']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['gifts_charity_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <x-financialAddressWithKey nameLabel="Name and Address of Charity"
                                    nameKey="charity_address" addressLabel="Street Address"
                                    addressKey="charity_street" cityLabel="City" cityKey="charity_city"
                                    stateLabel="State" stateKey="charity_state" zipLabel="Zip" zipKey="charity_zip"
                                    :finacial_affairst="$finacial_affairst" :i="$i">
                                </x-financialAddressWithKey>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Contribution Date: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_contribution_date', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Value: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('charity_contribution_value', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Contribution Date: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_contribution_date1', @$finacial_affairst, $i) }}</span></label>
                                </div>

                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Value: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('charity_contribution_value1', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Description of Contribution: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_contribution', @$finacial_affairst, $i) }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    @endfor
                @endif
            </div>
        </div>
    </div>
    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">15</div>
                <span class="item-label questionaire-label">Within the last 12 months did you lose anything because of
                    theft, fire, other disaster, or gambling: </span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('losses_from_fire', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('losses_from_fire', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['losses_from_fire_data']['loss_description']))
                    @for($i = 0; $i < count($financialaffairs_info['losses_from_fire_data']['loss_description']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['losses_from_fire_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Describe the property you lost and how the loss
                                        occured: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('loss_description', @$finacial_affairst, $i) }}</span></label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Date of loss: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('loss_date_payment', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Value of Property: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('loss_amount_payment', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold ">Description and value of any property transferred:
                                <span
                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('transferred_description', @$finacial_affairst, $i) }}</span></label>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">16</div>
                <span class="item-label questionaire-label">In the past 12 months, did you or anyone acting on your
                    behalf pay or transfer any property to anyone you consulted or received legal advice from regarding
                    bankruptcy or preparing a bankruptcy petition?</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('property_transferred', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('property_transferred', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['property_transferred_data']['person_paid']))
                    @for($i = 0; $i < count($financialaffairs_info['property_transferred_data']['person_paid']); $i++)
                        @php
                            $finacial_affairst = $financialaffairs_info['property_transferred_data'];
                            $address = Helper::validate_key_loop_value("person_paid_street", @$finacial_affairst, $i);
                            $address .= !empty($address) ? ', '.Helper::validate_key_loop_value("person_paid_address_line2", @$finacial_affairst, $i) : '';
                        @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Person Who Was Paid: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Street Address: <span
                                            class="font-weight-normal">{{ $address }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">City: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_city', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">State: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_state', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold ">Zip: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_zip', @$finacial_affairst, $i) }}</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Date of Payment or Transfer: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transferred_date', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Amount of Payment: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('property_transferred_payment', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Person Who Made the Payment, if Not You: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_made_payment', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Email or website address: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_email_or_website', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Description and Value of Any Property Transferred:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transferred_value', @$finacial_affairst, $i) }}</span></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">17</div>
                <span class="item-label questionaire-label">In the past 12 months, did you or anyone else acting on
                    your behalf pay or transfer any property to anyone who promised to help you deal with your creditors
                    or to make payments to your creditors?</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('property_transferred_creditors', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('property_transferred_creditors', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['property_transferred_creditors_data']['person_paid_address']))
                    @for($i = 0; $i < count($financialaffairs_info['property_transferred_creditors_data']['person_paid_address']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['property_transferred_creditors_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Person Who Was Paid: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_address', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Street: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_street', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">City: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_city', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">State: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_state', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold ">Zip Code: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_zip', @$finacial_affairst, $i) }}</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Date payment or transfer was made: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transfer_date', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Amount of payment: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('property_transfer_amount_payment', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Date payment or transfer was made: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transfer_date2', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Amount of payment: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('property_transfer_amount_payment2', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Description and value of any property transferred:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transfer_value', @$finacial_affairst, $i) }}</span></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">18</div>
                <span class="item-label questionaire-label">Have you transferred or sold any property within the last
                    <span class='text-c-blue'>2 Years</span>? <span class='text-c-blue'>(Examples: Home, Land, Car,
                        etc.)</span>
                    <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('Property_all', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('Property_all', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['Property_all_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['Property_all_data']['name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['Property_all_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Person Who Received Transfer: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('name', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <x-financialAddress :finacial_affairst="$finacial_affairst" :i="$i"></x-financialAddress>

                            </div>
                        </div>
                        <div class="col-md-7">

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Description and value of property transferred:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transfer_value', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Describe any property or payments received or
                                        debts
                                        paid in exchange: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_exchange', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Person's relationship to you: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('relationship_to_you', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Date transfer was made: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transfer_date', @$finacial_affairst, $i) }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">19</div>
                <span class="item-label questionaire-label">List all property you transferred within the past 10 years
                    to a self-settled trust or a similar device of which you are a beneficiary.:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('all_property_transfer_10_year', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('all_property_transfer_10_year', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['all_property_transfer_10_year_data']['trust_name']))
                    @for($i = 0; $i < count($financialaffairs_info['all_property_transfer_10_year_data']['trust_name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['all_property_transfer_10_year_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Name of trust: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('trust_name', @$finacial_affairst, $i) }}</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Description and value of the property transferred:
                                        <span class="font-weight-normal">{{ Helper::validate_key_loop_value('10year_property_transfer', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Date transfer was made: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('10year_property_transfer_date', @$finacial_affairst, $i) }}</span></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">20</div>
                <span class="item-label questionaire-label">Within 1 year were any financial accounts or instruments
                    held in your name, or for your benefit, closed, sold, moved, or transferred?</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_all_financial_accounts', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_all_financial_accounts', $financialaffairs_info) }}">
                @php $accounts = [1 => 'Checking', 2 => 'Savings', 3 => 'Money market', 4 => 'Brokerage', 5 => 'Other']; @endphp

                @if(!empty($financialaffairs_info['list_all_financial_accounts_data']['institution_name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_all_financial_accounts_data']['institution_name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['list_all_financial_accounts_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold ">Name of Financial Institution: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('institution_name', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <x-financialAddress :finacial_affairst="$finacial_affairst" :i="$i"></x-financialAddress>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="font-weight-bold "> Last 4 Digits of Acc#: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('account_number', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold ">Date account was closed, sold, moved, or
                                        transferred :
                                        <span class="font-weight-normal">{{ Helper::validate_key_loop_value('date_account_closed', @$finacial_affairst, $i) }}</span></label>
                                </div>

                                @php $typeac = Helper::validate_key_loop_value('type_of_account', @$finacial_affairst, $i); @endphp
                                <div class="col-md-6">
                                    <label class="font-weight-bold "> Type of Acc. or Instrument: <span
                                            class="font-weight-normal">{{ isset($accounts[$typeac]) ? $accounts[$typeac] : '' }}</span></label>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold ">Last balance before closing or transfer: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('last_balance', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">21</div>
                <span class="item-label questionaire-label">Do you currently have, within the last year have you had,
                    any safe deposit box or other depository containing securities, cash, or other valuables:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_safe_deposit', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_safe_deposit', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_safe_deposit_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_safe_deposit_data']['name']); $i++)
                        @php
                            $finacial_affairst = $financialaffairs_info['list_safe_deposit_data'];
                            $depositValue = Helper::validate_key_loop_value("still_have_safe_deposite", $finacial_affairst, $i);
                            $depositeAmount = ArrayHelper::getYesNoArray($depositValue);
                        @endphp
                <x-financialListDeposit noneType="1" nameLabel="Name of Financial Institution" nameKey="bo_name"
                    streetKey="bo_street_number" cityKey="bo_city" stateKey="bo_state" zipKey="bo_zip"
                    depositeAmount="{{ $depositeAmount }}" :finacial_affairst="$finacial_affairst" :i="$i">
                </x-financialListDeposit>

                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">22</div>
                <span class="item-label questionaire-label">Have you stored property in a storage unit or any other
                    place other than your home within 1 year:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('other_storage_unit', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('other_storage_unit', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['other_storage_unit_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['other_storage_unit_data']['name']); $i++)
                        @php
                            $finacial_affairst = $financialaffairs_info['other_storage_unit_data'];
                            $depositeAmount = ArrayHelper::getYesNoArray(Helper::validate_key_loop_value("still_have_storage_unit", @$finacial_affairst, $i));
                        @endphp
                <x-financialListDeposit nameLabel="Name of Storage Facility" nameKey="bd_name"
                    streetKey="bd_street_number" cityKey="bd_city" stateKey="bd_state" zipKey="bd_zip"
                    depositeAmount="{{ $depositeAmount }}" :finacial_affairst="$finacial_affairst"
                    :i="$i"></x-financialListDeposit>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">23</div>
                <span class="item-label questionaire-label">Do you have possession or control of any property owned by
                    someone else:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_property_you_hold', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_property_you_hold', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_property_you_hold_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_property_you_hold_data']['name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['list_property_you_hold_data']; @endphp
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold "><span
                                            class="font-weight-normal">{{ ($i + 1).'. ' }}</span>Owner's Name:
                                        <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('name', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <x-financialAddress :finacial_affairst="$finacial_affairst" :i="$i"></x-financialAddress>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold"> Description of Property: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('property_desc', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Value: <span
                                            class="font-weight-normal section-title">${{ number_format((float) Helper::validate_key_loop_value('property_value', @$finacial_affairst, $i), 2, '.', ',') }}</span></label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold"> <span
                                            class="section-title font-weight-bold font-lg-12 pr-3">Location of
                                            Property:</label>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold">Street Address: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('location_street_number', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">City: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('location_city', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold ">State: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('location_state', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold ">Zip: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('location_zip', @$finacial_affairst, $i) }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">24</div>
                <span class="item-label questionaire-label">Has any governmental unit notified you that you may be
                    liable or potentially liable under or in violation of an environmental law.:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_noticeby_gov', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_noticeby_gov', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_noticeby_gov_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_noticeby_gov_data']['name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['list_noticeby_gov_data']; @endphp
                <x-financialListNotice environmentKey="environmental_law" :finacial_affairst="$finacial_affairst" :i="$i">
                </x-financialListNotice>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">25</div>
                <span class="item-label questionaire-label">List the name and address of every site for which you have
                    notified a governmental unit of a hazardous material release. Include the name and address of the
                    governmental unit to which the notice was sent, the date of the notice, and, if know, the
                    environment law.:
                    <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_environment_law', $financialaffairs_info) !!}</span>
                </span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_environment_law', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_environment_law_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_environment_law_data']['name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['list_environment_law_data']; @endphp
                <x-financialListNotice environmentKey="environment_law_know" :finacial_affairst="$finacial_affairst"
                    :i="$i"></x-financialListNotice>
                    @endfor
                @endif
            </div>
        </div>
    </div>


    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">26</div>
                <span class="item-label questionaire-label">List all judicial or administrative proceedings, including
                    settlements and orders, under any environmental law to which you have been a party. Include the case
                    title and the case number, the court or agency, the nature of the case, and the status.:
                    <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_judicial_proceedings', $financialaffairs_info) !!}</span>
                </span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_judicial_proceedings', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_judicial_proceedings_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_judicial_proceedings_data']['name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['list_judicial_proceedings_data']; @endphp
                <div class="col-md-5 mt-1">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="font-weight-bold "><span
                                    class="font-weight-normal">{{ ($i + 1).'. ' }}</span>Case title: <span
                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('case_name', @$finacial_affairst, $i) }}</span></label>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold ">Case Number: <span
                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('case_number', @$finacial_affairst, $i) }}</span></label>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold">Court Name: <span
                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('name', @$finacial_affairst, $i) }}</span></label>
                        </div>
                        <x-financialAddress :finacial_affairst="$finacial_affairst" :i="$i"></x-financialAddress>
                    </div>
                </div>
                <div class="col-md-7 mt-1">
                    <div class="row">
                        @php
                            $casetypes = [1 => 'Pending', 2 => 'On appeal', 3 => 'Concluded'];
                            $status = Helper::validate_key_loop_value('case_status', @$finacial_affairst, $i);
                        @endphp
                        <div class="col-md-8">
                            <label class="font-weight-bold">Nature of the case: <span
                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('case_nature', @$finacial_affairst, $i) }}</span></label>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold "> Status of the Case: <span
                                    class="font-weight-normal">{{ isset($casetypes[$status]) ? $casetypes[$status] : '' }}</span></label>
                        </div>
                    </div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">27</div>
                <span class="item-label questionaire-label">List the name and address, nature of
                    business, name of accountant or bookkeeper, Employer Identification Number (EIN), and dates of
                    operation
                    of every business you owned or with which you had any of the following connections within the past 4
                    years.:
                </span>
            </h2>

            <div class="row gx-3 set-mobile-col ">
                @if(!empty($financialaffairs_info['list_nature_business_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_nature_business_data']['name']); $i++)
                        @php
                            $finacial_affairst = $financialaffairs_info['list_nature_business_data'];
                            $stillOpen = Helper::validate_key_loop_value("business_still_open", @$finacial_affairst, $i);
                        @endphp
                        @if(!empty(Helper::validate_key_loop_value("name", @$finacial_affairst, $i)))
                        <div class="col-md-12 mt-1">
                    <div class="row">

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="font-weight-bold "><span
                                            class="font-weight-normal">{{ ($i + 1).'. ' }}</span>Business Name: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('name', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    @if(!empty(Helper::validate_key_loop_value("type", @$finacial_affairst, $i)))
                                    <label class="font-weight-bold ">Type:
                                        <span class="font-weight-normal">{{ ArrayHelper::getBasicInfoBussinessTypeArray(Helper::validate_key_loop_value('type', @$finacial_affairst, $i)) }}</span></label>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Debtor Type:
                                        <span class="font-weight-normal">
                                            {{ Helper::validate_key_loop_value_radio('own_business_selection', $finacial_affairst, $i) == 0 ? 'Debtor' : '' }}
                                            {{ Helper::validate_key_loop_value_radio('own_business_selection', $finacial_affairst, $i) == 1 && $client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED ? 'Non-Filing Spouse' : '' }}
                                            {{ Helper::validate_key_loop_value_radio('own_business_selection', $finacial_affairst, $i) == 1 && $client_type == Helper::CLIENT_TYPE_JOINT_MARRIED ? 'Spouse' : '' }}
                                        </span>
                                    </label>
                                </div>
                                <x-financialAddress :finacial_affairst="$finacial_affairst" :i="$i"></x-financialAddress>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <label class="font-weight-bold"> Nature of Business: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('business_nature', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-8">
                                    <label class="font-weight-bold ">Name of Accountant or Bookkeeper: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('business_accountant', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">EIN: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('eiin', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold">Dates business started: <span
                                            class="font-weight-normal">{{ Helper::validate_key_loop_value('operation_date', @$finacial_affairst, $i) }}</span></label>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold ">Dates business ended/dissolved: <span
                                            class="font-weight-normal">{{ empty($stillOpen) ? Helper::validate_key_loop_value('operation_date2', @$finacial_affairst, $i) : 'Still opened' }}</span></label>
                                </div>

                            </div>
                        </div>
                        @if(Helper::validate_key_loop_value("type", @$finacial_affairst, $i) == 3)
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!empty(Helper::validate_key_loop_value("type", @$finacial_affairst, $i)))
                                    <label class="font-weight-bold ">Describe your business:</label>
                                    @foreach(ArrayHelper::getBasicInfoBussinessDescriptionArray() as $key => $label)
                                    <p class="mb-1">
                                        <input type="checkbox" id="checkbox_{{ $key }}"
                                            class="disabled-blue-color" readonly disabled {{ ($key == Helper::validate_key_loop_value('businessDescription', @$finacial_affairst, $i)) ? 'checked' : '' }}>
                                        <label for="checkbox_{{ $key }}"
                                            class="custom-checkbox mb-0">{{ $label }}</label>
                                    </p>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                            </div>
                        </div>
                        @endif
                    @endfor
                @endif
            </div>
        </div>
    </div>

    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="font-weight-bold align-items-center">
                <div class="circle-number-div">28</div>
                <span class="item-label questionaire-label">List all financial institutions, creditors, or other
                    parties to which you gave a financial statement about your business within the past 2 years:</span>
                <span class="lable-sub-section ml-2 item-label ">{!! Helper::key_display_attorney_ques('list_financial_institutions', $financialaffairs_info) !!}</span>
            </h2>

            <div
                class="row gx-3 set-mobile-col {{ Helper::key_hide_show_v('list_financial_institutions', $financialaffairs_info) }}">
                @if(!empty($financialaffairs_info['list_financial_institutions_data']['name']))
                    @for($i = 0; $i < count($financialaffairs_info['list_financial_institutions_data']['name']); $i++)
                        @php $finacial_affairst = $financialaffairs_info['list_financial_institutions_data']; @endphp
                <div class="col-md-5 mt-1">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="font-weight-bold "><span
                                    class="font-weight-normal">{{ ($i + 1).'. ' }}</span>Name: <span
                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('name', @$finacial_affairst, $i) }}</span></label>
                        </div>
                        <x-financialAddress :finacial_affairst="$finacial_affairst" :i="$i"></x-financialAddress>
                    </div>
                </div>
                <div class="col-md-7 mt-1">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="font-weight-bold">Date: <span
                                    class="font-weight-normal">{{ Helper::validate_key_loop_value('date_issued', @$finacial_affairst, $i) }}</span></label>
                        </div>
                    </div>
                </div>

                    @endfor
                @endif
            </div>
        </div>
    </div>

</div>

<style>
    span.No {
        color: red;
    }

    span.None,
    span.Yes {
        color: green;
    }
</style>
