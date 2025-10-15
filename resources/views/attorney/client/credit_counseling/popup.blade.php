<div class="container mt-5">

    <form id="credit_counseling_form" action="{{ route('save_credit_counseling') }}" method="post">
        @csrf

        <input type="hidden" name="client_id" value="{{ $client_id }}" >
        
        <div class="row">
            <div class="col-md-12">
            <span>Certificate status:</span>
            @if(isset($responseApi->certificateStatus))
                @php
                    $certStatus = is_string($responseApi->certificateStatus) 
                        ? json_decode($responseApi->certificateStatus) 
                        : $responseApi->certificateStatus;
                @endphp

                <pre>{{ json_encode($certStatus, JSON_PRETTY_PRINT) }}</pre>
            @else
                <p class="text-c-red">Client certificate status not available</p>
            @endif
            </div>
        </div>
        <h4 class="mb-4 mt-4">Create the client record</h4>
        <div class="row">
            <div class="col-md-12">
            <span>Api Reponse:</span>
                <p class="{{ !isset($responseApi->clientRecordDataResponse) ? 'text-c-red' : 'text-c-green' }}">{{ $responseApi->clientRecordDataResponse ?? 'Form data not submitted to api yet' }}</p>
            </div>
        </div>
        @include("attorney.client.credit_counseling.personal")

        <h4 class="mb-4 mt-4">Income And Expense Info</h4>
        <div class="row">
            <div class="col-md-12">
                <span>Api Reponse:</span>
                <p class="{{ !isset($responseApi->clientIncomeExpenseDataResponse) ? 'text-c-red' : 'text-c-green' }}">{{ $responseApi->clientIncomeExpenseDataResponse ?? 'Form data not submitted to api yet' }}</p>
            </div>
        </div>
        @include("attorney.client.credit_counseling.income_expense")

        <h4 class="mb-4 mt-4"> Net Worth Info</h4>
        <div class="row">
            <div class="col-md-12">
                <span>Api Reponse:</span>
                <p class="{{ !isset($responseApi->clientNetWorthDataResponse) ? 'text-c-red' : 'text-c-green' }}">{{ $responseApi->clientNetWorthDataResponse ?? 'Form data not submitted to api yet' }}</p>
            </div>
        </div>
        @include("attorney.client.credit_counseling.net_worth")

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <button type="submit" class="btn btn-primary me-md-2">Submit</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
        </div>

    </form>

</div>
<style>
    .json-output {
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    font-family: monospace;
    white-space: pre-wrap;
    word-wrap: break-word;
}
</style>