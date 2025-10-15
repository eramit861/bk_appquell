<form id="reorder_form">
    <div id="gallery">
        @foreach ($documents as $document)
            @if (!empty($document['temporary_thumnail_url_arr']))
                @if (count($document['temporary_thumnail_url_arr']) == 1)
                    <div class="gallery-item">
                        <img class="gallary-image cursor-pointer" src="{{ $document['temporary_thumnail_url_arr'][0] }}" alt="Image 1">
                        <input type="hidden" name="document_order[]" value="{{ $document['id'] }}">
                        <div class="text-center reorder_pdf_title" >
                            {{ $document['updated_name'] }}
                        </div>
                    </div>
                @elseif(count($document['temporary_thumnail_url_arr']) > 1)
                    <!-- folder-toggle and folder-content are separate, but linked by a shared folder id -->
                    <div class="folder-toggle" data-folder-id="folder-{{ $document['id'] }}"
                        onclick="toggleGroup(this, 'folder-{{ $document['id'] }}')">
                        <div class="folder-title">Click here to <span class="font-weight-bold folder_hide_show_text" data-document-id="{{ $document['id'] }}">show</span> the <br> PDF pages. ({{ count($document['temporary_thumnail_url_arr']) }} pages)</div>
                        <img src="{{$document['temporary_thumnail_url_arr'][0]}}" alt="thumbnail" height="204px" width="100%">
                        <input type="hidden" name="document_order[]" value="{{ $document['id'] }}">
                        <div class="text-center reorder_pdf_title" >
                            {{ $document['updated_name'] }}
                        </div>
                    </div>

                    <div class="folder-content" id="folder-{{ $document['id'] }}">
                        @foreach ($document['temporary_thumnail_url_arr'] as $key => $url)
                            <div class="gallery-item">
                                <img class="gallary-image cursor-pointer" src="{{ $url }}" alt="Sub {{ $key + 1 }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            @elseif(in_array($document['is_generated_thumbnails'], [0,1,3]))
                <div class="gallery-item">
                    <div class="thumbnail-not-generated d-flex align-items-center justify-content-center w-100" style="height: 250px">
                        Thumbnails not generated
                    </div>
                    <div class="text-center reorder_pdf_title" >
                        {{ $document['updated_name'] }}
                    </div>
                    <input type="hidden" name="document_order[]" value="{{ $document['id'] }}">
                </div>
            @endif
        @endforeach
    </div>
</form>


<script>
    function toggleGroup(elem, id) {
        $('.folder-content').not('#' + id).removeClass('folder-open');
        $('#' + id).toggleClass('folder-open');
        var hide_show_elem = $(".folder_hide_show_text",elem)
        $(".folder_hide_show_text:not(.folder_hide_show_text[data-document-id='" + hide_show_elem.data('document-id') + "'])").text("show")
        hide_show_elem.text(hide_show_elem.text() == "show" ? "hide" : "show")
    }

    var previous_order = JSON.stringify($("input[name='document_order[]']").map(function() {
        return $(this).val();
    }).get());

    var timeout;
    $('.folder-toggle, #gallery > .gallery-item').on('mousedown', function(e) {
        if(timeout){
            clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
            hide_all_folders();
        }, 200);
    });

    function hide_all_folders() {
        $('.folder-content').removeClass('folder-open');
    }
    $('.folder-toggle,.gallery-item').on('mouseup', function(e) {
        clearTimeout(timeout);
    })

    new Sortable(document.getElementById('gallery'), {
        animation: 150,
        ghostClass: 'sortable-ghost',

        onMove: function(evt) {
            $('.folder-content.folder-open').removeClass('folder-open');
        },

        onEnd: function(evt) {
            var draggedItem = evt.item;
            // Check if the dragged element is a folder-toggle that has a related folder-content.

            var current_order = JSON.stringify($("input[name='document_order[]']").map(function() {
                return $(this).val();
            }).get());

            if(previous_order != current_order) {
                previous_order = current_order
                $('.folder-toggle').each(function() {
                    var folderId = $(this).data('folder-id');
                    var $folderContent = $('#' + folderId);
                    if ($folderContent.length) {
                        // Only move if folder-content isn’t already right after folder-toggle
                        if (!$folderContent.prev().is(this)) {
                            $folderContent.detach().insertAfter(this);
                        }
                    }
                });
                // Now, update the order via Ajax.
                let form_data = new FormData($("#reorder_form")[0]);
                $.ajax({
                    url: "{{ route('save_document_order') }}",
                    method: 'POST',
                    data: form_data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 1) {
                            $.systemMessage(response.msg, 'alert--success', true);
                        } else {
                            $.systemMessage(response.msg, 'alert--danger', true);
                        }
                    }
                });
            }
        }
    });

    $('.gallery-item .gallary-image').on('click', function(e) {
        var src = $(this).attr("src")
        $("#image_preview .modal-body img").attr("src",src)
        $("#image_preview").modal("show")
    })
</script>
