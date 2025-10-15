@if (isset($operationBusiness) && $operationBusiness == 1 && !empty($companyName))
    @php
        $plEmpty = empty($incomeProfitLoss) ? true : false;
        $client_id = $clientId;
        $profitType = 1;
        $total6month = 0;
        $avgexpense = 0;
        $debtorTotalOperatingExpense = 0;
        $totalgross = 0;
        $debtorGrossAvg = 0;

        if (!empty($incomeProfitLoss)) {
            if (isset($incomeProfitLoss[0]['profit_loss_type'])) {
                $profitType = 2;
            }
        }

        $plData = [];
        if ($profitType == 1) {
            $plData = DateTimeHelper::createSixDuplicateObject($incomeProfitLoss, $attProfitLossMonths);
        } elseif ($profitType == 2) {
            $plData = DateTimeHelper::getIncomeDescArray($incomeProfitLoss);
        }

        $monthsArray = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);
        $i = 1;

        $bgRed = empty($plData) ? 'pl-bg-red' : '';
        $emptyText = empty($plData)
            ? ' <small class="text-danger text-bold float_right">(P/L not filled out for this month)</small>'
            : '';
    @endphp

    <!-- &&  !empty($incomeProfitLoss) &&  is_array($incomeProfitLoss) && count($incomeProfitLoss) > 0 -->
    <div class="row">
        <div class="col-md-12 pt-2">
            <p class="section-part-title mb-2">
                <span class="text-c-blue border-bottom-light-blue font-weight-bold">
                    Company {{ !empty($additional) ? $additional : '1' }} : {{ $companyName }}
                </span>
            </p>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach ($monthsArray as $key => $monthYear)
                    @php
                        $plValue = 0;
                        $plMonth = $key;
                        $totalExpense = 0;
                        $grossIncome = 0;
                        $bgRed = 'pl-bg-red';
                        $emptyText =
                            ' <small class="text-danger text-bold float_right">(P/L not filled out for this month)</small>';

                        foreach ($plData as $data) {
                            if (isset($data['profit_loss_month']) && $data['profit_loss_month'] == $key) {
                                $plValue = (float) Helper::validate_key_value('total_profit_loss', $data, 'float');
                                $totalExpense = (float) Helper::validate_key_value('total_expense', $data, 'float');
                                $grossIncome = (float) Helper::validate_key_value(
                                    'gross_business_income',
                                    $data,
                                    'float',
                                );
                                $plMonth = $data['profit_loss_month'];
                                $bgRed = '';
                                $emptyText = '';
                                break;
                            }
                        }

                        // Accumulate total values for calculation after the loop
                        $debtorTotalOperatingExpense += $totalExpense;
                        $totalgross += $grossIncome;
                        $total6month += $plValue;

                        $routeUrl = 'client_profit_loss_popup_download';
                        if ($clientType == 'spouse') {
                            $routeUrl = 'client_spouse_profit_loss_popup_download';
                        }
                    @endphp

                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label class="d-block">Month
                                {{ $i }}:&nbsp;{{ $monthYear }}<strong>:&nbsp;{{ $plValue >= 0 ? '$' . number_format($plValue, 2, '.', ',') : '-$' . number_format(abs($plValue), 2, '.', ',') }}
                                </strong>
                                @if (empty($emptyText))
                                    <a
                                        href="{{ route($routeUrl, [
                                            'id' => $client_id,
                                            'for_month' => $plMonth,
                                            'onchange' => 1,
                                            'existing_type' => 2,
                                            'additional' => $additional,
                                            'profitType' => $profitType,
                                        ]) }}">
                                        <i style="font-size:20px;" class="fa fa-file-pdf" aria-hidden="true"></i>
                                    </a>
                                @else
                                    {!! $emptyText !!}
                                @endif
                            </label>
                        </div>
                    </div>

                    @php
                        $i++;
                    @endphp
                @endforeach

                @php
                    // Calculate averages after the loop
                    $debtorGrossAvg =
                        $totalgross > 0 ? number_format((float) ($totalgross / ($i - 1)), 2, '.', '') : 0.0;
                    $avgexpense =
                        $debtorTotalOperatingExpense > 0
                            ? number_format((float) ($debtorTotalOperatingExpense / ($i - 1)), 2, '.', '')
                            : 0.0;
                    $average = $total6month > 0 ? number_format((float) ($total6month / ($i - 1)), 2, '.', '') : 0.0;

                    $downloadLink = route('client_profit_loss_popup_zip_download', [
                        'id' => $client_id,
                        'clientType' => $clientType,
                        'additional' => $additional,
                    ]);
                @endphp
            </div>
        </div>

        <div class="col-md-12">
            <div class="d-flexs">
                <a href="{{ $downloadLink }}" class="btn font-weight-bold f-12 download_zip">Download Profit/Loss <img
                        class="" width="24" src="/assets/img/zip-file-format.png" alt="Zip File"></a>
            </div>
        </div>

        <div class="col-md-12">
            <hr class="mt-0">
        </div>
        <div class="col-md-4 pr-0">
            <span class="font-weight-normal">Avg. Gross Income: <span
                    class="text-c-black">${{ Helper::priceFormtWithComma($debtorGrossAvg) }}</span>
            </span>
        </div>
        <div class="col-md-4">
            <label class="font-weight-normal mb-0">Avg. Expenses: <span
                    class="text-c-red">${{ Helper::priceFormtWithComma($avgexpense) }}</span>
            </label>
        </div>
        <div class="col-md-4">
            <label class="font-weight-normal mb-0">Avg. Net Income: <span
                    class="text-c-blue">${{ Helper::priceFormtWithComma($average) }}</span>
            </label>
        </div>
        <div class="col-md-12">
            <hr class="mb-3">
        </div>
    </div>
@endif
