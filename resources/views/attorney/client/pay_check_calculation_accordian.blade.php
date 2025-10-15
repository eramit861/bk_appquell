<div class="light-gray-div mx-3 d-block">
    <h2>{{ $accHeading }}</h2>
    <div class="row gx-3">
        <div class="col-12 ">
            <div class="card information-area calculation mb-3">
                <div class="table-responsive" style="overflow-x: hidden;">
                    <div class="accordian" role="tablist" aria-live="polite">
                        @foreach ($payCheckData as $key => $value)
                            @php
                                $emp_data = Helper::validate_key_value('emp_data', $value);
                                $employer_id = Helper::validate_key_value('id', $emp_data);
                                $pay_dates = Helper::validate_key_value('pay_dates', $value);
                                $pay_dates = !empty($pay_dates) ? array_reverse($pay_dates) : [];

                                $pay_dates_list = Helper::validate_key_value('pay_dates_list', $value);
                                $overrideCount = Helper::validate_key_value('overrideCount', $value);
                                $countFalse = 0;
                                $title = 'Employer';
                                $subTitle = '';
                                if (!empty($emp_data)) {
                                    $title = '<span class="text-bold">' . Helper::validate_key_value('employer_name', $emp_data) . '</span> ';
                                    $subTitle = '<span class="text-c-blue">(Pay Dates based upon: <span class="text-bold text_underline">' . $value['clientFrequency'] . '</span> frequency)</span> ';
                                }
                                $datesCount = count($pay_dates);

                                $countFalse = count(array_filter($pay_dates, function ($pd) { return !$pd['exists']; }));
                                $countFalse = ($countFalse - (int) $overrideCount);
                                $missingCount = '<span class="text-danger text-bold ">Missing: ' . $countFalse . '</span>';
                            @endphp
                            <div id="tab{{ $key }}" tabindex="{{ $key }}" class="section-title" aria-controls="panel{{ $key }}" role="tab">
                                <div class="p-point75">
                                    <span class="text-bold border-bottom-light-blue">{{ ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)) }}:</span>
                                    {!! $title !!}
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="">
                                                {!! $subTitle !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <div class="">
                                                @if (!empty($countFalse))
                                                    {!! $missingCount !!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4">

                                            @if (!empty((int) $overrideCount))
                                                <span class="text-success text-bold ">Overridden: {{ $overrideCount }}</span>
                                            @endif


                                            <div class="float_right ">
                                                <span class=" text_underline">Show {{ $datesCount }} pay dates data</span> <i class="arrow-icon  fa fa-angle-down" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapsing-section table-responsive" id="panel{{ $key }}" aria-labelledby="tab{{ $key }}" role="tabpanel" style="display: none;">
                                <table class="table table-hover table-responsive d-table">
                                    @if (!empty($pay_dates))
                                        <tbody>
                                            <tr>
                                                <th>Pay date</th>
                                                <th>Status</th>
                                                <th>Gross Pay</th>
                                                <th>Net Pay</th>
                                                <th class="w-18">Override</th>
                                            </tr>
                                            @php $pay_date = ''; @endphp
                                            @foreach ($pay_dates as $pdKey => $data)
                                                @php
                                                    $overrideString = "";
                                                    $pay_date = Helper::validate_key_value('pay_date', $data);
                                                    $exists = Helper::validate_key_value('exists', $data);
                                                    $existsData = Helper::validate_key_value('existsData', $data);
                                                    $overrideData = [];
                                                    $overrideData = Helper::searchForOverrideDate($pay_date, $completeList, $employer_id);
                                                    $status = " <span class='text-bold text-danger'>Missing</span>";
                                                    $showOverrideSelect = true;
                                                    if ($exists) {
                                                        $status = " <span class='text-bold text-success'>Entered</span>";
                                                        $showOverrideSelect = false;
                                                    }

                                                    $grossPay = '-';
                                                    $netPay = '-';

                                                    if (!empty($existsData) && is_array($existsData)) {
                                                        $grossPay = array_sum(array_map('floatval', array_column($existsData, 'gross_pay_amount')));
                                                        $netPay = array_sum(array_map('floatval', array_column($existsData, 'net_pay_amount')));
                                                        $grossPay = '$' . $grossPay;
                                                        $netPay = '$' . $netPay;
                                                    }

                                                    if (!empty($overrideData)) {
                                                        $status = " <span class='text-bold text-success'>Entered</span>";
                                                        $showOverrideSelect = false;
                                                        $grossPay = '$ ' . Helper::validate_key_value('gross_pay_amount', $overrideData);
                                                        $netPay = '$ ' . Helper::validate_key_value('net_pay_amount', $overrideData);
                                                        $overPayDate = Helper::validate_key_value('pay_date', $overrideData);
                                                        $overrideString = "<small class='text-bold text-success'>Overridden with " . date("F d, Y", strtotime($overPayDate)) . "</small>";
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ date("F d, Y", strtotime($pay_date)) }}</td>
                                                    <td>{!! $status !!}</td>
                                                    <td>{!! $grossPay !!}</td>
                                                    <td>{!! $netPay !!}</td>
                                                    <td>
                                                        {!! $overrideString !!}
                                                        @if (!empty($pay_dates_list) && $showOverrideSelect)
                                                            @php $formattedDate = date("F d, Y", strtotime($pay_date)); @endphp
                                                            <div class="label-div mb-0">
                                                                <select name="override_{{ $pdKey }}" class="form-control w-auto short-select" onchange="overridePayDate(this, '{{ $pay_date }}', '{{ $formattedDate }}' )">
                                                                    <option value="">Select Paystub</option>
                                                                    @foreach ($pay_dates_list as $listKey => $listVal)
                                                                        <option value="{{ $listVal['id'] }}">{{ date("F d, Y", strtotime($listVal['pay_date'])) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>