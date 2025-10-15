@php
$docsCount = count($subChild);
$objData = [
    'document_type' => $childObjKey,
    'document_name' => Helper::validate_key_value($childObjKey, $allDocNames),
    'multiple' => $subChild,
];

$route = (isset($route) && !empty($route)) ? $route : route('client_document_uploads');
$prevDocData = $subChild['multiple'] ?? [];
$filteredPrevDocData = [];
$paystubAssignedDocIds = [];
if ($childObjKey == 'Debtor_Pay_Stubs') {
    $client_type = 1;
    $paystubAssignedDocIds = $paystubAssignedDocIdsSelf;
}
if ($childObjKey == 'Co_Debtor_Pay_Stubs') {
    $client_type = 2;
    $paystubAssignedDocIds = $paystubAssignedDocIdsSpouse;
}

if (!empty($prevDocData)) {
    $filteredPrevDocData = array_filter($prevDocData, function ($doc) use ($paystubAssignedDocIds) {
        return !in_array($doc['id'], $paystubAssignedDocIds);
    });
    $filteredPrevDocData = array_values($filteredPrevDocData);
}
$prevDocData = $filteredPrevDocData;
$response = \App\Models\ClientDocuments::pay_check_calculation($client_id, $client_type);
@endphp

@if (($childObjKey == 'Debtor_Pay_Stubs' && !empty($response['debtorPayCheckData'])) || ($childObjKey == 'Co_Debtor_Pay_Stubs' && !empty($response['codebtorPayCheckData'])))
    <div class="col-12">
        <div class="parent-light-gray-div light-gray-div mt-3 mb-3">
            <h2>{!! Helper::validate_key_value($childObjKey, $allDocNames) !!}</h2>
            <form id="{{ $childObjKey }}" class="main_form_{{ $childObjKey }}" data-parentKey="{{ $parentKey }}"
                action="{{ route('get_document_for_combine', ['id' => $val['id'], 'type' => $childObjKey]) }}"
                method="GET">
                @include('attorney.uploaded_doc_view.docPayStubMainFormData')
            </form>
        </div>
    </div>
@endif