<div class="col-12">
    <div class="light-gray-div">
        <h2 class="text-dark fw-bold">Installment payments</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Do you have any monthly installment payments such as: car, furniture, etc.?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Please list only payments you will continue making after your case is filed.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="installment_payment_for_car" id="installment_payment_for_car_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('installment_payment_for_car', $expenses, 1) }}>
                        <label for="installment_payment_for_car_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('installment_payment_for_car', $expenses, 1) }}"
                            onclick="getInstallmentPaymentForCar('yes');">Yes</label>

                        <input type="radio" name="installment_payment_for_car" id="installment_payment_for_car_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('installment_payment_for_car', $expenses, 0) }}>
                        <label for="installment_payment_for_car_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('installment_payment_for_car', $expenses, 0) }}"
                            onclick="getInstallmentPaymentForCar('no');">No</label>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ Helper::key_hide_show_v('installment_payment_for_car', $expenses) }}"
                id="installment_payments1">
                <div class="outline-gray-border-area">
                    @if (!empty($expenses['installmentpayments_price']))
                        @for ($i = 0; $i < count($expenses['installmentpayments_price']); $i++)
                            @include('client.questionnaire.expense.common.installment_payment')
                        @endfor
                    @else
                        @php $i = 0; @endphp
                        @include('client.questionnaire.expense.common.installment_payment')
                    @endif
                    <div class="add-more-div-bottom">
                        <button type="button" class="btn-new-ui-default py-1 px-2"
                            onclick="addInstallmentPaymentsForm();return false;">
                            <i class="bi bi-plus-lg"></i>
                            Add Additional Installment(s)
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Enter how much you pay per month for <span class="text-c-blue">alimony,
                            maintenance and/or child support</span>:
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Don't list these here if the payments are already being deducted from your pay.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="alimony_maintenance" id="alimony_maintenance_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('alimony_maintenance', $expenses, 1) }}>
                        <label for="alimony_maintenance_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('alimony_maintenance', $expenses, 1) }}"
                            onclick="getAlimonyMaintenance('yes');">Yes</label>

                        <input type="radio" name="alimony_maintenance" id="alimony_maintenance_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('alimony_maintenance', $expenses, 0) }}>
                        <label for="alimony_maintenance_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('alimony_maintenance', $expenses, 0) }}"
                            onclick="getAlimonyMaintenance('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 other_insurance {{ Helper::key_hide_show_v('alimony_maintenance', $expenses) }}"
                id="alimony_maintenance_div">
                <div class="label-div">
                    <div class="form-group">
                        <label for="">Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="alimony_price"
                                value="{{ Helper::validate_key_value('alimony_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Payments for support of additional dependents not living at your home:
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="paymentforsupport_dependents_n"
                            id="paymentforsupport_dependents_n_yes" class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('paymentforsupport_dependents_n', $expenses, 1) }}>
                        <label for="paymentforsupport_dependents_n_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('paymentforsupport_dependents_n', $expenses, 1) }}"
                            onclick="getPaymentforsupport_n('yes');">Yes</label>

                        <input type="radio" name="paymentforsupport_dependents_n"
                            id="paymentforsupport_dependents_n_no" class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('paymentforsupport_dependents_n', $expenses, 0) }}>
                        <label for="paymentforsupport_dependents_n_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('paymentforsupport_dependents_n', $expenses, 0) }}"
                            onclick="getPaymentforsupport_n('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 other_insurance {{ Helper::key_hide_show_v('paymentforsupport_dependents_n', $expenses) }}"
                id="paymentforsupport_dependents_n1">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="">Specify</label>
                                <input type="text" class="input_capitalize form-control required"
                                    placeholder="Specify" name="payments_dependents_value"
                                    value="{{ Helper::validate_key_value('payments_dependents_value', $expenses) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="">Value</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="payments_dependents_price"
                                        value="{{ Helper::validate_key_value('payments_dependents_price', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
