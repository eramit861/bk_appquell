@php
$accept = 'Accept';
$decline = "Decline";
if (in_array($document_type, $adminDocs)) {
    $accept = 'Completed';
    $decline = "Not Completed";
}
@endphp

@if ($document_type != "requested_documents" && ($added_by_attorney == 0 && ((isset($document_status) && $document_status == 0) || ($doc['id'] > 0 && empty($document_status)))))
    <a 
        onclick="acceptDocument('{{ $document_type }}','{{ route('client_document_status') }}','1', '{{ $client_id }}', this, '', '{{ $doc['id'] }}')" 
        href="javascript:void(0)" 
        class="ms-2 p4px view_client_btn btn-accept"
    >{{$accept}}</a>
    <a 
        onclick="declineDocumentPopUp('{{ $document_type }}','{{ route('client_decline_docs_popup') }}','2', '{{ $client_id }}',this, '{{ $doc['document_file'] }}', '{{ $doc['id'] }}','{{ $decline }}')" 
        href="javascript:void(0)" 
        class="ms-2 mr-1 p4px view_client_btn btn-decline mw-fit-content"
    >{{$decline}}</a>
@endif