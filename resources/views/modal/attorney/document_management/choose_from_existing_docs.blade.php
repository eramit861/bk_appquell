<div class="modal fade" id="choosePostSubmissionModal" tabindex="-1" aria-labelledby="choosePostSubmissionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-div conditional-ques requested_client_documents">

            <div class="modal-header d-flex-ai-center">
                <h5 class="modal-title" id="choosePostSubmissionModalLabel">Choose From Existing Docs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @php
                $allAttorneyPSDocNames = isset($allAttorneyPSDocNames) ? $allAttorneyPSDocNames : [];
                $allClientPSDocuments = isset($allClientPSDocuments) ? $allClientPSDocuments : [];
                $allPSDocNames = array_merge($allAttorneyPSDocNames, $allClientPSDocuments);
                $allPSDocNames = array_unique($allPSDocNames);
            @endphp
            <div class="modal-body p-0">
                <div class="card-body b-0-i">
                    <form action="{{ route('post_submission_document_add') }}" method="post">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $client_id }}">
                        <div class="light-gray-div mt-3 doc_list" id="post_submission_docs_list">
                            <h2>Post Submission Documents</h2>
                            <div class="row gx-3">
                                @foreach ($allPSDocNames as $key => $label)
                                    @php
                                        $borderClass = 'not-selected-border';
                                        $cardBg = 'no-selected';
                                        $checkedStatus = false;
                                        if (array_key_exists($key, $allClientPSDocuments)) {
                                            $cardBg = 'selected';
                                            $checkedStatus = true;
                                        }
                                    @endphp
                                    <div class="col-4">
                                        <div class="custom-item mb-2">
                                            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}"
                                                data-label="">
                                                <div class="card-body p-0">
                                                    <label class="w-100 d-flex mb-0"
                                                        for="post_submission_doc_{{ $key }}">
                                                        <span
                                                            class="doc-card w-100 name_{{ $key }}">{{ $label }}</span>
                                                        <input type="checkbox"
                                                            id="post_submission_doc_{{ $key }}"
                                                            class="float_right d-none mt-1 notify_doc"
                                                            name="post_submission_docs[{{ $key }}]"
                                                            value="{{ $label }}" onclick="selectDocument(this)"
                                                            @if ($checkedStatus) checked="true" @endif>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="light-gray-div mt-3 doc_list">
                            <h2>Additional Client Post Submission Documents</h2>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="label-div mb-2">
                                        <div class="form-group mb-0 ">
                                            <label class="mb-0">Document Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0 d-flex align-items-center">
                                            <input name="document_name" type="text" id="document_name" value=""
                                                class="form-control input_capitalize save-post-submission-input mr-3"
                                                placeholder="Add Client Post Submission Doc">
                                             <button type="button"
                                                 class="upload_doc_line view_client_btn save-post-submission-btn upload-doc-btn p-2 fs-mob-10px"
                                                 onclick="addClientPostSubmissionDocToList()">Add&nbsp;Client&nbsp;Post&nbsp;Submission&nbsp;Doc</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bottom-btn-div">
                            <button type="button"
                                class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit"
                                class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0"
                                onclick="">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/choose-post-submission-modal.js') }}"></script>
@endpush