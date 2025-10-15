<div class="modal invitemodel fade" id="add_attorney" tabindex="-1" aria-labelledby="invitemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-div">
            <div class="modal-header align-items-center py-2">
                <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
                    <i class="bi bi-file-ruled me-2"></i> Add New Template
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body b-0-i">

                    <form id="notification_template_setup_form" action="{{ route('notification_template_setup') }}"
                        method="post" novalidate>
                        @csrf

                        <div class="light-gray-div mt-3">
                            <h2>Template details</h2>
                            <div class="row gx-3">

                                <div class="col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label for="">Subject</label>
                                            <input required name="subject" type="text" id="subject"
                                                value="{{ old('subject') }}"
                                                class="input_capitalize form-control {{ $errors->has('subject') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Subject">
                                        </div>
                                        @if ($errors->has('subject'))
                                            <p class="help-block text-danger">{{ $errors->first('subject') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label for="">Body</label>
                                            <textarea required name="body" id="body"
                                                class=" h-unset form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" rows="5">{{ old('body') }}</textarea>
                                        </div>
                                        @if ($errors->has('body'))
                                            <p class="help-block text-danger">{{ $errors->first('body') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <span class="attribute_bubble" onclick="addAttribute('{client_name}')">Client Name</span>
                                    <span class="attribute_bubble" onclick="addAttribute('{attorney_name}')">Attorney Name</span>
                                </div>

                            </div>
                        </div>

                        <div class="bottom-btn-div">
                            <button type="button"
                                class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit"
                                class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0">Submit</button>
                        </div>

                        <div id="loader" class="spinner">
                            <img style="position: absolute;top: 50%;left: 50%;"
                                src="{{ url('/assets/img/loading2.gif') }}" alt="Loading" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        $(document).ready(function() {
            $("#add_attorney").modal('show');
        });
    </script>
@endif
