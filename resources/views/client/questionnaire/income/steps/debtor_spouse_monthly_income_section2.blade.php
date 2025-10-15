@php
$client_type = 2;
$response = \App\Models\ClientDocuments::pay_check_calculation(Auth::user()->id, $client_type);
if (!empty($response['codebtorPayCheckData'])) {
@endphp
<div class="col-12">
    <div class="light-gray-div mt-2">
        <h2 class="text-dark fw-bold">Paystub(s) Information</h2>
        <div class="row gx-3">
            <div class="col-12 {{ ($hasEmployerCodebtor) ? 'paystub-upload-section' : 'hide-data' }} border-0 py-0">
                @include(
                    'client.questionnaire.income.common.pay_check_calculation_new',
                    [
                        'client_id' => Auth::user()->id,
                        'dataType' => 'Co_Debtor_Pay_Stubs',
                        "documentuploaded" => [],
                        'payCheckData' => $response['codebtorPayCheckData'],
                        'completeList' => $response['codebtorCompleteList'],
                        'isUploadedScreen' => false,
                        'colSize' => 'col-lg-4 col-md-6 col-12'
                    ]
                )
            </div>
        </div>
    </div>
</div>
@php } @endphp