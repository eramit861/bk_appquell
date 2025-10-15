<div id="ai-modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="aiProcessModalLabel">
            <i class="bi bi-cpu-fill me-2" style="color: #8c198c;"></i>AI Process Requests
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-0">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="pl-4" scope="col">Client Name</th>
                        <th scope="col">Attorney</th>
                        <th scope="col">Report Type</th>
                        <th scope="col">Reference #</th>
                        <th scope="col">Status</th>
                        <th scope="col">Requested On</th>
                        <th scope="col">Updated On</th>
                        <th class="pr-4" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $list = $requests;
                        $count = 0;
                        if (!empty($list)) {
                            $count = count($list);
                        }
                    @endphp
                    
                    @forelse($list as $val)
                        <tr class="unread row-{{ $val->id }} {{ \App\Models\PdfToJson::colorCode($val->status) }}">
                            <td class="pl-4"><strong>{{ $val->client_name }}</strong></td>
                            <td>{{ $val->attorney_name }}</td>
                            <td class="report-type">{{ $val->request_type }}</td>
                            <td class="reference-id">
                                <p style="margin:auto;font-size: 10px; max-width: 150px; word-break: break-word; white-space: normal;">{{ $val->refrence_id }}</p>
                            </td>
                            <td>
                                <span class="status-badge status_{{ $val->id }}">
                                    {!! \App\Models\PdfToJson::getStatusBadge($val->status) !!}

                                    @if ($val->status == \App\Models\PdfToJson::STATUS_FAILED)
                                        <a class="btn btn-primary retry-btn retry_btn_{{ $val->id }}" onclick="reTryAi('{{ $val->id }}')" href="javascript:void(0)">
                                            <i class="bi bi-arrow-clockwise"></i> Retry
                                        </a>
                                    @endif
                                </span>
                            </td>
                            <td class="datetime">{{ DateTimeHelper::dbDateToDisplay($val->created_at, true) }}</td>
                            <td class="datetime">{{ DateTimeHelper::dbDateToDisplay($val->updated_at, true) }}</td>
                            <td class="pr-4 action-buttons">
                                @if (isset($val->document_id) && $val->document_id > 0)
                                    <a href="{{ route('client_doc_download', ['id' => $val->document_id]) }}" download class="btn-outline-danger ai-action-btn"> <i class="fa fa-file-pdf" aria-hidden="true"></i> PDF</a>
                                @endif
                                <span class="json-data btn-outline-secondary ai-action-btn download-icon" data-json='{{ $val->json }}' title="View JSON">
                                    <i class="bi bi-filetype-json" style="cursor: pointer;"></i> JSON
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr class="unread text-center">
                            <td colspan="8">{{ __('No Record Found.') }}</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <div class="me-auto">
            <small class="text-muted">
                <i class="bi bi-info-circle"></i>
                @if ($count > 0)
                    Showing {{ $count }} AI process requests
                @else
                    No AI Process Requests yet
                @endif
            </small>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.download-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            // Get the JSON from the data-json attribute of the parent td
            const jsonData = this.closest('.json-data').dataset.json;

            try {
                // Parse the JSON (this also validates it)
                const parsedJson = JSON.parse(jsonData);
                const formattedJson = JSON.stringify(parsedJson, null, 2); // Pretty-print

                // Create a Blob (file-like object)
                const blob = new Blob([formattedJson], {
                    type: 'text/plain'
                });

                // Create a temporary download link
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'data.txt'; // File name

                // Trigger download
                document.body.appendChild(a);
                a.click();

                // Clean up
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            } catch (e) {
                console.error('Invalid JSON:', e);
                alert('Error: Invalid JSON data');
            }
        });
    });

    reTryAi = function(id) {
        var url = "{{ route('resend_ai_request') }}";
        laws.ajax(url, {
            id: id
        }, function(response) {
            if (isJson(response)) {
                var res = JSON.parse(response);
                if (res.status == 'success') {
                    $.systemMessage(res.message, 'alert--success', true);
                    $('.retry_btn_' + id).addClass('hide-data');
                    $('.status_' + id).text('In-Progress');
                } else {
                    $.systemMessage(res.message, 'alert--danger', true);
                    $('.retry_btn_' + id).removeClass('hide-data');
                    $('.status_' + id).text('Failed');
                }
            }
        });
    }
</script>