<div class="light-gray-div mx-3 pl-0 pr-0">
    <h2>{{ !empty($title) ? $title : 'Payroll Calculation' }}</h2>
    <div class="row gx-3 m-0 p-0 w-100">
        <div class="col-12 ">
            <div class="card information-area calculation">
                <div class="table-responsive">
                    <table class="table table-responsive d-table">
                        <tbody>
                            <tr>
                                <th class="bg-gray-custom text-bold">Month</th>
                                <th class="text-bold">Gross pay</th>
                                <th class="text-bold">Total Taxes</th>
                                <th class="text-bold">Total deductions</th>
                                <th class="text-bold">Net Income</th>
                            </tr>
                            @php
                            $totalGrossPay = 0;
                            $totalTaxes = 0;
                            $totalDeduction = 0;
                            $totalnetAmount = 0;
                            $montYears = DateTimeHelper::getMonthYearArray();
                            foreach ($montYears as $m => $v) {
                            if (!in_array($m, array_column($allReport, 'pay_period_end'))) {
                            array_push($allReport, ['pay_period_end' => $m, 'gross_pay_amount' => 0, 'total_taxes' => 0,
                            'total_deductions' => 0]);
                            }
                            }
                            if (!empty($allReport[0])) {
                            usort($allReport, function ($a, $b) {
                            return $b['pay_period_end'] <=> $a['pay_period_end'];
                                });
                                $dateWisePaystub = [];
                                foreach ($allReport as $pays) {
                                $dateWisePaystub[$pays['pay_period_end']] = [
                                'gross_pay_amount' => $pays['gross_pay_amount'],
                                'total_taxes' => $pays['total_taxes'],
                                'total_deductions' => $pays['total_deductions'],
                                'gross_pay_amount' => $pays['gross_pay_amount'],
                                ];
                                }
                                }
                                @endphp

                                @if(!empty($allReport[0]))
                                @foreach($montYears as $key => $val)
                                @php
                                $report = $dateWisePaystub[$key] ?? [];
                                $totalGrossPay += $report['gross_pay_amount'] ?? 0;
                                $totalTaxes += $report['total_taxes'] ?? 0;
                                $totalDeduction += $report['total_deductions'] ?? 0;
                                $totalnetAmount += isset($report['gross_pay_amount']) ?
                                (float)$report['gross_pay_amount'] - (float)$report['total_taxes'] -
                                (float)$report['total_deductions'] : 0;
                                @endphp
                                <tr>
                                    <td class="bg-gray-custom text-bold">{{ $val }}</td>
                                    <td>{{ Helper::formatPrice($report['gross_pay_amount']) }}</td>
                                    <td>{{ Helper::formatPrice($report['total_taxes']) }}</td>
                                    <td>{{ Helper::formatPrice($report['total_deductions']) }}</td>
                                    <td>{{ Helper::formatPrice($report['gross_pay_amount'] - $report['total_taxes'] -
                                        $report['total_deductions']) }}</td>
                                </tr>
                                @endforeach
                                @endif

                                <tr style=" background-color: rgba(4, 169, 245, 0.05)">
                                    <td class="bg-gray-custom text-bold"><strong>6 Month Average</strong></td>
                                    <td><strong>{{ $totalGrossPay > 0 ? Helper::formatPrice($totalGrossPay / 6) : '$0'
                                            }}</strong></td>
                                    <td><strong>{{ $totalTaxes > 0 ? Helper::formatPrice($totalTaxes / 6) : '$0'
                                            }}</strong></td>
                                    <td><strong>{{ $totalDeduction > 0 ? Helper::formatPrice($totalDeduction / 6) : '$0'
                                            }}</strong></td>
                                    <td><strong>{{ $totalnetAmount > 0 ? Helper::formatPrice($totalnetAmount / 6) : '$0'
                                            }}</strong></td>
                                </tr>
                        </tbody>
                    </table>
                    <label class="float_right"><i class="float_right">Net Income is based on formula: Net income =
                            (Gross pay amount - total taxes - total deductions)</i></label>
                </div>
            </div>
        </div>
    </div>
</div>

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/common_calculation_popup.css') }}">
@endpush