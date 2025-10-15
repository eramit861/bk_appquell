@php
$client_type = 1;
$response = \App\Models\ClientDocuments::pay_check_calculation(Auth::user()->id, $client_type);
@endphp

@if(!empty($response['debtorPayCheckData']))
<div class="col-12">
    <div class="light-gray-div mt-2">
        <h2 class="text-dark fw-bold">Paystub(s) Information</h2>
        <div class="row gx-3">
            <div class="col-12 {{ ($hasEmployer) ? 'paystub-upload-section' : 'hide-data' }} border-0 py-0">
                @include(
                    'client.questionnaire.income.common.pay_check_calculation_new',
                    [
                        'client_id' => Auth::user()->id,
                        'dataType' => 'Debtor_Pay_Stubs',
                        'documentuploaded' => [],
                        'payCheckData' => $response['debtorPayCheckData'],
                        'completeList' => $response['debtorCompleteList'],
                        'isUploadedScreen' => false,
                        'colSize' => ' col-md-6 col-xl-4 col-12'
                    ]
                )
            </div>
        </div>
    </div>
</div>
@endif