<div class="row gx-3">
    @if ($childObjKey == "Debtor_Pay_Stubs" && !empty($response['debtorPayCheckData']))
        <div class="col-12">
            @include('attorney.client.pay_check_calculation_without_accordian', ["parentKey" => $parentKey, "data" => $objData, "dataType"=> $childObjKey, "documentuploaded" => $prevDocData, 'payCheckData' => $response['debtorPayCheckData'], 'completeList' => $response['debtorCompleteList'], 'isUploadedScreen' => true ])
        </div>
    @elseif ($childObjKey == "Co_Debtor_Pay_Stubs" && !empty($response['codebtorPayCheckData']))
        <div class="col-12">
            @include('attorney.client.pay_check_calculation_without_accordian', ["parentKey" => $parentKey, "data" => $objData, "dataType"=> $childObjKey, "documentuploaded" => $subChild['multiple']??[], 'payCheckData' => $response['codebtorPayCheckData'], 'completeList' => $response['codebtorCompleteList'], 'isUploadedScreen' => true ])
        </div>
    @endif
</div>