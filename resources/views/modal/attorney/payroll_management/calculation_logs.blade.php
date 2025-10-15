<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100">
            Calculation Logs
        </h5>
    </div>

    <div class="modal-body p-1">
        <div class="card-body b-0-i">
            <div class="light-gray-div mt-3">
                <h2>Logs</h2>
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="table-responsive paystb paychecks-section">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col">Version</th>
                                        <th scope="col">Total Tax Amount</th>
                                        <th scope="col">Tax Json</th>
                                        <th scope="col">Total Deduction Amount</th>
                                        <th scope="col">Deduction Json</th>
                                        <th scope="col">Imported By</th>
                                        <th scope="col">Imported On</th>
                                        <th scope="col"></th>
                                    </tr>
                                    @php
                                        $calculationLogs = $paystub->calculation_logs;
                                    @endphp
                                    @if (!empty($calculationLogs) && is_array(json_decode($calculationLogs, true)))
                                        @php
                                            $calculationLogs = json_decode($calculationLogs, true);
                                            $i = 1;
                                        @endphp
                                        @foreach ($calculationLogs as $key => $log)
                                            @php
                                                $calculation = Helper::validate_key_value('calculation', $log, 'array');
                                                $about = Helper::validate_key_value('about', $log, 'array');
                                                $imported_at = Helper::validate_key_value('imported_at', $about);
                                                $cnfmPaystubDate =
                                                    date('F d, Y', strtotime($paystub->pay_date)) . ' Pay Stub';
                                                $cnfmPaystubName = $paystub['employer_name'] ?? '';
                                                $cnfmsg =
                                                    'Are you sure you want to import this calculation to ' .
                                                    $cnfmPaystubDate .
                                                    '?';
                                            @endphp
                                            <tr>
                                                <td scope="col">{{ $i }}</td>
                                                <td scope="col">
                                                    {{ Helper::formatPrice(Helper::validate_key_value('total_taxes', $calculation)) }}
                                                </td>
                                                <td scope="col">
                                                    @php
                                                        $taxes = json_decode(
                                                            Helper::validate_key_value('taxes', $calculation),
                                                            true,
                                                        );
                                                    @endphp

                                                    @if (!empty($taxes))
                                                        <table
                                                            class="table-auto border border-collapse border-gray-300 w-full">
                                                            <thead>
                                                                <tr>
                                                                    <th class="border px-2 py-1">Name</th>
                                                                    <th class="border px-2 py-1">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($taxes as $tax)
                                                                    <tr>
                                                                        <td class="border px-2 py-1">
                                                                            {{ $tax['name'] ?? '' }}</td>
                                                                        <td class="border px-2 py-1">
                                                                            {{ $tax['amount'] ?? '' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No taxes found.</p>
                                                    @endif
                                                </td>
                                                <td scope="col">
                                                    {{ Helper::formatPrice(Helper::validate_key_value('total_deductions', $calculation)) }}
                                                </td>
                                                <td scope="col">
                                                    @php
                                                        $deductions = json_decode(
                                                            Helper::validate_key_value('deductions', $calculation),
                                                            true,
                                                        );
                                                    @endphp

                                                    @if (!empty($deductions))
                                                        <table
                                                            class="table-auto border border-collapse border-gray-300 w-full">
                                                            <thead>
                                                                <tr>
                                                                    <th class="border px-2 py-1">Name</th>
                                                                    <th class="border px-2 py-1">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($deductions as $tax)
                                                                    <tr>
                                                                        <td class="border px-2 py-1">
                                                                            {{ $tax['name'] ?? '' }}</td>
                                                                        <td class="border px-2 py-1">
                                                                            {{ $tax['amount'] ?? '' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No deductions found.</p>
                                                    @endif
                                                </td>
                                                <td scope="col">
                                                    {{ Helper::validate_key_value('imported_by', $about) }}</td>
                                                <td scope="col">{{ $imported_at }}</td>
                                                <td scope="col">
                                                    <button type="button" class="delete-div resend"
                                                        onclick="importCalculationToPayStub('{{ $key }}', '{{ $paystub->id }}', '{{ $client_id }}', '{{ $cnfmsg }}')" >
                                                        <i class="bi bi-box-arrow-in-down"></i>
                                                        Import
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>