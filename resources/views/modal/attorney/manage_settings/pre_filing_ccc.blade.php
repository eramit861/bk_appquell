<div class="modal fade" id="credit_counseling_form_div" tabindex="-1" aria-labelledby="credit_counseling_form_label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg m-0">
        <div class="modal-content modal-content-div">
            <div class="modal-header align-items-center py-2">
                <h5 class="modal-title d-flex w-100" id="credit_counseling_form_label">
                    Pre-Filing Bankruptcy Certificate CCC
                </h5>
            </div>
            <div class="modal-body p-0">
                <div class="card-body b-0-i">
                    <form id="credit_counseling_form" action="{{ route('setup_attorney_certificate_ccc') }}"
                        onsubmit="submitCreditCounselingForm(event, this)" method="post">
                        @csrf
                        <input type="hidden" name="is_associate"
                            value="{{ Helper::validate_key_value('is_associate', $associate_data, 'radio') }}">
                        <input type="hidden" name="associate_id"
                            value="{{ Helper::validate_key_value('associate_id', $associate_data, 'radio') }}">
                        <div class="light-gray-div mt-3">
                            <h2>Credit Counseling agency details</h2>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="label-div">
                                        <input type="hidden" class="form-control" id="document_id" name="document_id"
                                            value="">
                                        <div class="form-group mb-0">
                                            <label for="">Enter name of credit counseling agency</label>
                                            <input name="counseling_agency" type="text" id="counseling_agency"
                                                value="{{ Helper::validate_key_value('counseling_agency', $attorneySettings) }}"
                                                class="input_capitalize form-control"
                                                placeholder="Enter name of credit counseling agency:">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="label-div">
                                        <input type="hidden" class="form-control" id="document_id" name="document_id"
                                            value="">
                                        <div class="form-group mb-0">
                                            <label for="">Enter link to credit counseling agency site</label>
                                            <input name="counseling_agency_site" type="text"
                                                id="counseling_agency_site"
                                                value="{{ Helper::validate_key_value('counseling_agency_site', $attorneySettings) }}"
                                                class="form-control"
                                                placeholder="Enter link to credit counseling agency site:">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="label-div">
                                        <input type="hidden" class="form-control" id="document_id" name="document_id"
                                            value="">
                                        <div class="form-group mb-0">
                                            <label for="">Enter your attorney code (if applicable)</label>
                                            <input name="attorney_code" type="text" id="attorney_code"
                                                value="{{ Helper::validate_key_value('attorney_code', $attorneySettings) }}"
                                                class="form-control"
                                                placeholder="Enter your attorney code (if applicable):">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-btn-div">
                            <button type="submit"
                                class="btn-new-ui-default submitButton cursor-pointer mb-0">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
