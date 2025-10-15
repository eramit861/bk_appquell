@if (!isset($is_main) && !in_array($document_type, $cardsArray))
    @php
        $arrayGroup = ['Current_Mortgage_Statement','Current_Auto_Loan_Statement','bank_statements','type_venmo_paypal_cash','type_brokerage_account','other_income','retirement_docs','requested_documents'];
        $docId = Helper::validate_key_value('id', $doc);
        $docType = $document_type;
    @endphp
    <div class="btn-group ms-2 mb-0 label-div" id="document_{{ $docId }}">
        <button class="form-control dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Move Document to...
        </button>
        <div class="dropdown-menu" 
            data-doc_id='{{$docId}}'
            data-client_id='{{$client_id}}'
            data-prev_selected_value='{{$docType}}'
            data-pay_date='{{ (isset($doc_pay_date) && !empty($doc_pay_date)) ? $doc_pay_date : '' }}'
            data-select_employer_id=''
        >
            @foreach ($documentMoveToList as $key => $option)
                {{-- @if($key == $docType && !in_array($key, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                    @continue
                @endif --}}
                {!! $option !!}
            @endforeach
        </div>
    </div>
@endif