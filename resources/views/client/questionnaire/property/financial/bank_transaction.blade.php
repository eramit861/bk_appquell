<div class="light-gray-div transaction-div 
            bank_account_transaction_{{ $i }} 
            bank_account_transaction_{{ $i }}_{{ $k }} 
            transaction-div-{{ $i }} 
            {{ (Helper::validate_key_value($i, $transaction, 'radio') == 1) ? '' : 'hide-data' }}
            ">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $k + 1 }}</div> Transaction Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('bank_account_transaction_{{ $i }}', {{ $k }},'',false)">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-md-6">
                <div class="label-div">
                    <div class="form-group">
                        <label>Description of what the funds were used for:</label>
                        <input type="text" name="bank[data][transaction_data][{{ $i }}][{{ $k }}][description]"
                            data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="input_capitalize form-control bank-acc-input required alphanumericInput transaction-description"
                            placeholder="Description" value="{{ Helper::validate_key_value('description', $data) }}">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Transaction amount:</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="bank[data][transaction_data][{{ $i }}][{{ $k }}][value]"
                                data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="price-field form-control bank-acc-input required transaction-value"
                                placeholder="Transaction amount" value="{{ Helper::validate_key_value('value', $data) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Date of transaction:</label>
                        <input type="text" name="bank[data][transaction_data][{{ $i }}][{{ $k }}][sample]"
                            data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="date_filed form-control bank-acc-input required transaction-sample"
                            placeholder="MM/DD/YYYY" value="{{ Helper::validate_key_value('sample', $data) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>