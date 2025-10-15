<div class="modal-content modal-content-div requestPopup conditional-ques">
    <div class="modal-header align-items-center py-2">
        <div class="row w-100 m-0">
            <div class="col-12">
                <h5 class="modal-title d-flex">
                    Subscription/AddOn(s)
                </h5>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <div class="card-body light-gray-div mt-2 mb-1">
            <h2>Subscription and Add-Ons</h2>
            <div class="row">
                <!-- Concierge Service -->
                <div class="col-12 col-md-12">
                    <div class="label-div">
                        <label>Concierge Service:
                            @if ($val['concierge_service'] == 1)
                                <strong class='ms-2 status uploaded '>Yes</strong>
                            @else
                                <a href="javascript:void(0)"
                                    onclick="servicePurchase('{{ $val['client_subscription'] }}', '{{ $val['id'] }}', '{{ route('purchase_concierge_service_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                    <i class="bi bi-plus-lg"></i> Add
                                </a>
                            @endif
                        </label>
                    </div>
                </div>
                <!-- Payroll Assistant -->
                <div class="col-12 col-md-12">
                    <div class="label-div">
                        <label>Payroll Assistant:
                            @if (!Auth::user()->enable_free_payroll_assistant)
                                @if ($val['client_payroll_assistant'] > 0)
                                    <strong class="ms-2 status uploaded ">{{ ArrayHelper::getPayrollAssistantArray($val['client_payroll_assistant']) }}</strong>
                                @endif
                            @endif
                            @if ($val['client_subscription'] == \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION || Auth::user()->enable_free_payroll_assistant)
                                <strong class="ms-2 status uploaded ">Included</strong>
                            @elseif ($val['client_payroll_assistant'] == 0)
                                <a href="javascript:void(0)" onclick="payrollPurchasePopup(1, '{{ $val['id'] }}', '{{ route('payroll_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                    <i class="bi bi-plus-lg"></i> Debtor
                                </a>
                                <a href="javascript:void(0)" onclick="payrollPurchasePopup(2, '{{ $val['id'] }}', '{{ route('payroll_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                    <i class="bi bi-plus-lg"></i> Co-Debtor
                                </a>
                                @if ($val['client_type'] == 3)
                                    <a href="javascript:void(0)" onclick="payrollPurchasePopup(3, '{{ $val['id'] }}', '{{ route('payroll_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                        <i class="bi bi-plus-lg"></i> Both
                                    </a>
                                @endif
                            @endif
                        </label>
                    </div>
                </div>
                
                @php
                    $petition_prepration_package = $val['petition_prepration_package'];
                    $client_bank_statements = $val['client_bank_statements'];
                    $client_profit_loss = $val['client_profit_loss_assistant'];
                    $client_bank_statements_premium = $val['client_bank_statements_premium'];
                    $client_credit_report = $val['client_credit_report'];
                @endphp
                
                @if ($val['client_subscription'] != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                    <!-- Petition Preparation -->
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <label>Petition Preparation:
                                @if ($petition_prepration_package > 0 || in_array($val['client_subscription'], [\App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION, \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION]))
                                    @if ($val['client_subscription'] == \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION)
                                        <strong class="ms-2 status uploaded ">Included</strong>
                                    @else
                                        <strong class="ms-2 status uploaded ">Yes</strong>
                                    @endif
                                @elseif ($petition_prepration_package == 0)
                                    <a href="javascript:void(0)" onclick="packagePurchasePopup('petition', '{{ $val['id'] }}', '{{ route('package_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                        <i class="bi bi-plus-lg"></i> Add
                                    </a>
                                @endif
                            </label>
                        </div>
                    </div>
                    <!-- Paralegal Check -->
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <label>Paralegal Check:
                                @php
                                    $peralegal_check_package = $val['peralegal_check_package'];
                                @endphp
                                @if ($peralegal_check_package > 0 || in_array($val['client_subscription'], [\App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION, \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION]))
                                    @if ($val['client_subscription'] == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                                        <strong class="ms-2 status uploaded ">N/A</strong>
                                    @elseif ($val['client_subscription'] == \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION)
                                        <strong class="ms-2 status uploaded ">Included</strong>
                                    @else
                                        <strong class="ms-2 status uploaded ">Yes</strong>
                                    @endif
                                @elseif ($peralegal_check_package == 0)
                                    <a href="javascript:void(0)" onclick="packagePurchasePopup('paralegal', '{{ $val['id'] }}', '{{ route('package_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                        <i class="bi bi-plus-lg"></i> Add
                                    </a>
                                @endif
                            </label>
                        </div>
                    </div>
                    <!-- Bank Statement Assistant -->
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <label>Bank Statement Assistant:
                                @if ($val['client_subscription'] == \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION)
                                    <strong class="ms-2 status uploaded ">Included</strong>
                                @elseif ($val['client_subscription'] == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                                    <strong class="ms-2 status uploaded ">N/A</strong>
                                @else
                                    @if ($client_bank_statements > 0)
                                        <strong class="ms-2 status uploaded ">
                                            {{ Helper::getBankStatementsArray($client_bank_statements) }}
                                        </strong>
                                    @endif
                                    @if ($client_bank_statements == 0 && $val['client_subscription'] != 103)
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(1, '{{ $val['id'] }}', '{{ route('bank_assistant_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Debtor
                                        </a>
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(2, '{{ $val['id'] }}', '{{ route('bank_assistant_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Co-Debtor
                                        </a>
                                        @if ($val['client_type'] == 3)
                                            <a href="javascript:void(0)" onclick="payrollPurchasePopup(3, '{{ $val['id'] }}', '{{ route('bank_assistant_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                                <i class="bi bi-plus-lg"></i> Both
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </label>
                        </div>
                    </div>
                    <!-- Bank Statement Assistant Premium -->
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <label>Bank Statement Assistant Premium:
                                @if ($val['client_subscription'] == \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION)
                                    <strong class="ms-2 status uploaded ">Included</strong>
                                @elseif ($val['client_subscription'] == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                                    <strong class="ms-2 status uploaded ">N/A</strong>
                                @else
                                    @if ($client_bank_statements_premium != null)
                                        <strong class="ms-2 status uploaded ">
                                            {{ Helper::getBankStatementsArray($client_bank_statements_premium) }}
                                        </strong>
                                    @endif
                                    @if ($client_bank_statements_premium == null && $val['client_subscription'] != 103)
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(1, '{{ $val['id'] }}', '{{ route('bank_assistant_premium_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Debtor
                                        </a>
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(2, '{{ $val['id'] }}', '{{ route('bank_assistant_premium_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Co-Debtor
                                        </a>
                                        @if ($val['client_type'] == 3)
                                            <a href="javascript:void(0)" onclick="payrollPurchasePopup(3, '{{ $val['id'] }}', '{{ route('bank_assistant_premium_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                                <i class="bi bi-plus-lg"></i> Both
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </label>
                        </div>
                    </div>
                    <!-- Profit Loss Assistant -->
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <label class="mb-0">Profit Loss Assistant:
                                @if ($val['client_subscription'] == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                                    <strong class="ms-2 status uploaded ">N/A</strong>
                                @else
                                    @if ($client_profit_loss > 0)
                                        <strong class="ms-2 status uploaded ">
                                            {{ Helper::getProfitLossAssistantArray($client_profit_loss) }}
                                        </strong>
                                    @endif
                                    @if ($client_profit_loss == 0 && $val['client_subscription'] != 103)
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(1, '{{ $val['id'] }}', '{{ route('profit_loss_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Debtor
                                        </a>
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(2, '{{ $val['id'] }}', '{{ route('profit_loss_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Co-Debtor
                                        </a>
                                        @if ($val['client_type'] == 3)
                                            <a href="javascript:void(0)" onclick="payrollPurchasePopup(3, '{{ $val['id'] }}', '{{ route('profit_loss_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                                <i class="bi bi-plus-lg"></i> Both
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </label>
                        </div>
                    </div>

                    <!-- Credit Report -->
                    <div class="col-12 col-md-12">
                        <div class="label-div ">
                            <label class="mb-0">Credit Report:
                                @if ($val['client_subscription'] == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                                    <strong class="ms-2 status uploaded">N/A</strong>
                                @else
                                    @if ($client_credit_report > 0)
                                        <strong class="ms-2 status uploaded">
                                            {{ Helper::getCreditReportArray($client_credit_report) }}
                                        </strong>
                                    @endif
                                    @if ($client_credit_report == 0 && $val['client_subscription'] != 103)
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(1, '{{ $val['id'] }}', '{{ route('credit_report_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Debtor
                                        </a>
                                        <a href="javascript:void(0)" onclick="payrollPurchasePopup(2, '{{ $val['id'] }}', '{{ route('credit_report_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                            <i class="bi bi-plus-lg"></i> Co-Debtor
                                        </a>
                                        @if ($val['client_type'] == 3)
                                            <a href="javascript:void(0)" onclick="payrollPurchasePopup(3, '{{ $val['id'] }}', '{{ route('credit_report_purchase_popup') }}')" class="delete-div add-sub-common text-bold ms-2">
                                                <i class="bi bi-plus-lg"></i> Both
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>