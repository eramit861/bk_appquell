@if (in_array($key, ['parentIdDocuments', 'parentSecuredDocuments']) && $document_type !== 'Insurance_Documents')
    <a 
        onclick="deleteDocDocument('{{ $document_type }}','{{ route('client_document_delete') }}','{{ $client_id }}', this, '','{{ $doc['id'] }}')"
        href="javascript:void(0)" class="ms-2 me-1 view_client_btn delete btn-new-ui-default doc-delete-padding delete-border-none">
        <i class="fas fa-trash fa-lg" title="Select to Delete" ></i>
    </a>
@endif