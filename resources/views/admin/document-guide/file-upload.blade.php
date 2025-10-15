@extends("layouts.admin")
@section('content')
@include("layouts.flash")

<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card mb-0">
            <div class="card-header p-2">
                <div class="search-list">
                    <div class="col-md-12 p-0">						
                        <div class="row">
                            <div class="col-md-12 pl-0">
                                <h4 class="m-0">Document upload guide</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-12 col-md-12 p-1">
        <div class="row">
            @foreach($fileTypes as $key => $label)
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body p-2">
                        <h5 class="card-title">{{ $label }}</h5>
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-2 document-container" data-type="{{ $key }}">
                                @if(isset($existingDocuments[$key]))
                                    @php
                                        $document = $existingDocuments[$key];
                                        $url = Storage::disk('s3')->temporaryUrl(
                                            $document->s3_path,
                                            now()->addDays(2),
                                            ['ResponseContentDisposition' => 'attachment;filename=' . rawurlencode($document->original_name)]
                                        );
                                    @endphp
                                    <a href="{{ $url }}" class="btn btn-primary btn-sm mr-2" download>
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                    <button class="btn btn-danger btn-sm delete-document-btn" 
                                        data-id="{{ $document->id }}" 
                                        data-type="{{ $key }}">
                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                </button>
                                @else
                                    <span class="text-muted mr-2">No document uploaded</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center">
                                <form class="document-upload-form mb-0" data-type="{{ $key }}">
                                    <div class="form-group mb-0 d-flex align-items-center">
                                        <label for="file-{{ $key }}" class="btn btn-sm btn-outline-primary mb-0 mr-2" style="cursor: pointer;">
                                            <i class="fas fa-upload mr-1"></i> Upload
                                            <input type="file" id="file-{{ $key }}" name="document" class="d-none" accept=".pdf,.jpg,.jpeg,.png" required>
                                        </label>
                                        
                                        <input type="hidden" name="document_type" value="{{ $key }}">
                                    </div>
                                    <div class="progress mt-2" style="height: 5px; display: none;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
    // File upload handling
    $('input[type="file"]').on('change', function(e) {
        let fileInput = $(this);
        let form = fileInput.closest('.document-upload-form');
        let progressBar = form.find('.progress');
        let progressBarInner = form.find('.progress-bar');
        let type = form.data('type');
        let documentContainer = $(`.document-container[data-type="${type}"]`);
        
        // Show progress bar
        progressBar.show();
        
        let formData = new FormData(form[0]);
        
        $.ajax({
            url: '<?php echo route('admin_documents_upload');?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = (evt.loaded / evt.total) * 100;
                        progressBarInner.css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                progressBar.hide();
                progressBarInner.css('width', '0%');
                
                if(response.success) {
                    $.systemMessage('File uploaded successfully!', 'alert--success', true);
                    // Update the download link without reloading the page
                    documentContainer.html(`
                        <a href="${response.url}" class="btn btn-primary btn-sm mr-2" download>
                            <i class="fas fa-download mr-1"></i> Download
                        </a>
                    `);
                } else {
                    $.systemMessage(response.message, 'alert--danger', true);
                }
            },
            error: function(xhr) {
                progressBar.hide();
                progressBarInner.css('width', '0%');
                
                let errorMsg = 'An error occurred';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
              
                $.systemMessage(errorMsg, 'alert--danger', true);
            }
        });
    });


    $('.delete-document-btn').on('click', function () {
        if (!confirm('Are you sure you want to delete this document?')) {
            return;
        }

        const button = $(this);
        const docId = button.data('id');
        const type = button.data('type');
        const container = $(`.document-container[data-type="${type}"]`);

        $.ajax({
            url: '{{ route("admin_guide_documents_delete") }}',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: docId,
                type: type
            },
            success: function (response) {
                if (response.success) {
                    $.systemMessage('Document deleted successfully!', 'alert--success', true);
                    container.html('<span class="text-muted mr-2">No document uploaded</span>');
                } else {
                    $.systemMessage(response.message || 'Delete failed', 'alert--danger', true);
                }
            },
            error: function () {
                $.systemMessage('Server error during delete', 'alert--danger', true);
            }
        });
    });


});



</script>
@endsection