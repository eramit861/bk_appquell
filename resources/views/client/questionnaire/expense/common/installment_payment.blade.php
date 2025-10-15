<div class="light-gray-div installment_payments_{{ $i }} installment_payments @if ($i == 0) mt-2 @endif"
    id="installment_payments_div">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div>
            Installment Details
        </h2>
        <button type="button" class="delete-div" title="Delete"
            onclick="remove_div_common('installment_payments', {{ $i }});return false;">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-md-4 col-sm-12 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Type</label>
                        <select onchange="checkPaymentType(this)" class="form-control installmentpayments_type required"
                            name="installmentpayments_type[{{ $i }}]">
                            <option disabled="">Please Select Type</option>
                            {!! ArrayHelper::installmentPaymentSelection(Helper::validate_key_loop_value('installmentpayments_type', $expenses, $i)) !!}
                        </select>
                    </div>
                </div>
            </div>
            @php
                $show_hide_div = 'hide-data';
                if (Helper::validate_key_loop_value('installmentpayments_type', $expenses, $i) == 7) {
                    $show_hide_div = '';
                }
            @endphp
            <div class="col-md-4 col-sm-12 col-12 installmentpayments_price_item {{ $show_hide_div }}">
                <div class="label-div">
                    <div class="form-group">
                        <label>Specify</label>
                        <input type="text" placeholder="Specify"
                            class="input_capitalize form-control required installmentpayments_value"
                            name="installmentpayments_value[{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('installmentpayments_value', $expenses, $i) }}" />
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label for="">Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                class="form-control price-field expense_prices required installmentpayments_price"
                                name="installmentpayments_price[{{ $i }}]"
                                value="{{ Helper::validate_key_loop_value('installmentpayments_price', $expenses, $i) }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
