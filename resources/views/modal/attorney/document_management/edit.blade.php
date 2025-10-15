<div class="modal fade" id="{{ $modelid }}" tabindex="-1" aria-labelledby="invitemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-div">
            <div class="modal-header align-items-center py-2">
                <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
                    <i class="bi bi-files-alt me-2"></i> Edit Document
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body b-0-i">
                    <form action="{{ $route }}" method="post">
                        @csrf
                        <input type="hidden" name="is_associate"
                            value="{{ Helper::validate_key_value('is_associate', $associate_data) }}">
                        <input type="hidden" name="associate_id"
                            value="{{ Helper::validate_key_value('associate_id', $associate_data) }}">
                        <div class="light-gray-div mt-3">
                            <h2>Document detail</h2>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="label-div">
                                        <input type="hidden" class="form-control" id="{{ $modelid == 'edit_document' ? 'document_id' : 'common_document_id' }}"
                                            name="document_id" value="">
                                        <div class="form-group mb-0">
                                            <label for="">Document name</label>
                                            <input type="text"
                                                class="input_capitalize form-control only_alphanumeric {{ $errors->has('name') ? 'btn-outline-danger' : '' }}"
                                                placeholder="{{ __('Name') }} " name="document_name"
                                                id="{{ $modelid == 'edit_document' ? 'document_name' : 'common_document_name' }}" value="" required maxlength="100">
                                            <p class="mb-4"><i><small>Document name must be alphanumeric characters
                                                        only.</small></i></p>
                                        </div>
                                        @if ($errors->has('firstName'))
                                            <p class="help-block text-danger mt-2">{{ $errors->first('firstName') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-btn-div">
                            <button type="button"
                                class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit"
                                class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
