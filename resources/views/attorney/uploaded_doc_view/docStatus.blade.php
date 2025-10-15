@php
$accepted = 'Accepted';
$declined = "Declined";

if (in_array($document_type, $adminDocs)) {
    $accepted = 'Completed';
    $declined = "Not Completed";
}
@endphp

@if (isset($doc['document_status']) && $doc['document_status'] == 2)
    <div class="ms-2 {{ ($accepted == 'Accepted' || $accepted == 'Completed') ? 'status missing border-dotted-1px' : '' }} {{ !empty($declineText) ? 'w-max-content' : '' }}">
        <span class="view_client_text declined ">({{$declined}})
            @if (!empty($declineText))
                <small class="decline_reasons" style="font-weight: 800;"> (Reason: {{$declineText}}) </small>
            @endif
        </span>
    </div>
    <a 
        onclick="requestForReuploadDoc('{{ $document_type }}','{{ route('client_document_enable_reupload') }}','1', '{{ $client_id }}', this, '{{ $doc['document_file'] }}','{{ $doc['document_status'] }}')" 
        class="view_client_btn ms-2 p4px resubmitdocrequest btn-new-ui-default p-1 py-2 d-block-ruby"
        title="Enable Re-upload">
        <i class="fa fa-retweet fa-lg" aria-hidden="true"></i> 
    </a>
@endif

@if ((isset($doc['document_status']) && $doc['document_status'] == 1) || (isset($doc['document_status']) && $doc['document_status'] !== 2 && isset($doc['added_by_attorney']) && ($doc['added_by_attorney'] == 1)))
    <div class="ms-2 {{ ($accepted == 'Accepted' || $accepted == 'Completed') ? 'status uploaded border-dotted-1px' : '' }}">
        <span class="view_client_text accepted ">({{$accepted}})</span>
    </div>
@endif