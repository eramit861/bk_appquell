@php
    $isUnsecuredPage = isset($isUnsecuredPage) ? $isUnsecuredPage : false;
    $isAttorneyDocPage = isset($isAttorneyDocPage) ? $isAttorneyDocPage : false;
    $route = (isset($route) && !empty($route)) ? $route : route('client_document_uploads');
@endphp

<div class="modal fade documents-modal" id="both_document_upload_modal" tabindex="-1" role="dialog" aria-labelledby="driving-licenceTitle" aria-hidden="true">    
    <div class="modal-dialog" style="max-width: 800px !important">
        <div class="modal-content">
            @include('client.upload_doc_form',['route' => $route, 'max_size' => isset($max_size) ? $max_size: 200])
        </div>
    </div>
</div>