<div class="outline-gray-border-area">
    @php
    $i = 0;
    @endphp
    @if(!empty($bank['description']) && is_array($bank['description']))
        @php $account_type_count = 0; @endphp
        @for($i = 0; $i < count($bank['description']); $i++)
            @include("client.questionnaire.property.financial.bank",['bank'=>$bank,'i'=>$i, 'account_type_count'=>$account_type_count])
        @endfor
    @else
        @include("client.questionnaire.property.financial.bank",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="bank-addmore-button" class="btn-new-ui-default py-1 px-2 bank-add-more-btn" data-transaction-enabled='{{ $transaction_pdf_enabled }}' onclick="bank_addmore('{{ $transaction_pdf_enabled }}'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Bank Account(s)
        </button>
    </div>
</div>