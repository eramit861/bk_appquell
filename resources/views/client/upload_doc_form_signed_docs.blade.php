@php
    $acceptType =
        '.heic,.jpeg,.png,.jpg,.pdf,.doc,.docx,.xltx,.vsdx,.dxf,.dot,.eml,.odt,.psd,.xlsx,.msg,.ppsx,.rtf,.numbers,.svg,.vsd,.eps,.md,.tiff,.ico,.json,.webp,.oxps,.pptx,.dwfx,.djvu,.dwf,.odp,.mobi,.xps,.ps,.xls,.dwg,.bmp,.csv,.html,.xlsb,.pages,.ods,.pps,.epub,.htm,.gif,.potx,.odg';
    $bank_statement_month_nos = $bank_statement_months ?? '';
@endphp
<form name="form-both" id="form-both" action="{{ $route }}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="modal-content modal-content-div conditional-ques b-0-i">
        <div class="modal-body p-0">
            <div class="card-body b-0-i p-0">

                <div class="light-gray-div">
                    <h2>Document upload Area</h2>
                    <div class="row gx-3 form_bgp">
                        <div class="col-12">
                            <input type="hidden" name="autoloan_id" value='0' id="autoloan_id">
                            <div class="fix-boxp px-3">
                                <div class="row">
                                    <input type="hidden" name="document_type" id="signed_document_types"
                                        value="">
                                    <div class="col-12 signed_other_than_paystubs mb-3 px-0">
                                        <div class="upload-area1 background_img">
                                            <div class="upload-area__header desktop">
                                                <h4 class="text-c-white upload-area__title f-w-500 font-lg-20">CLICK
                                                    HERE TO SELECT DOCUMENTS TO UPLOAD <br>OR
                                                    <br>DRAG/DROP YOUR DOCUMENT(S) HERE
                                                </h4>
                                            </div>
                                            <div class="upload-area__header mobile">
                                                <h4 class="text-c-white upload-area__title f-w-500 font-lg-20">CLICK
                                                    HERE TO SELECT DOCUMENTS TO UPLOAD OR DRAG/DROP YOUR DOCUMENT(S)
                                                    HERE</h4>
                                            </div>
                                            <div class="upload-area__footer">
                                                <p class="upload-area__paragraph text-center">
                                                    <span class="font-weight-normal text-c-white font-lg-18">A list of
                                                        files with their names will display below that will be
                                                        uploaded</span><br>
                                                </p>
                                            </div>
                                            <div class="upload-area__drop-zoons drop-zoon">
                                                <div class="doc-upload">
                                                    <span class="drop-zoon__icon"></span>
                                                    <div class="doc-edit">
                                                        <input type="hidden" name="document_type"
                                                            id="signed_document_type" value="">
                                                        <input type='file' required class="required" multiple
                                                            name="document_file[]" id="signed-both-licence"
                                                            accept="{{ $acceptType }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label id="signed_input_file_error_label" class="d-none">Please upload the
                                            file.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="light-gray-div mt-3 signed_other_than_paystubs">
                    <h2>Attached documents to upload</h2>
                    <div class="row gx-3">
                        <div class="col-12 signed-doc-name-sec">

                            <div class="sec-border hide-data">

                            </div>
                        </div>
                    </div>
                </div>

                @if (isset($client_id) && !empty($client_id))
                    <input type="hidden" name="client_id" value="{{ $client_id }}">
                @endif

                <div class="bottom-btn-div">
                    <button type="button" class="btn-new-ui-default" class="close"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="uploadbtn_att" class="signed_other_than_paystubs btn-new-ui-default ml-2"
                        onclick="signedSubmitUploadDoc()"> Click to upload & send docs to Attorney </button>
                </div>

            </div>
        </div>

    </div>
</form>

@push('tab_scripts')
    <script>
        window.__uploadDocSignedRoutes = {
            getStatementMonthOption: "{{ route('get_statement_month_option') }}",
            clientDocumentUploads: "{{ route('client_document_uploads') }}"
        };
        window.__uploadDocSignedData = {
            bankStatementMonthNos: "{{ $bank_statement_month_nos }}",
            clientId: "{{ $client_id ?? '' }}",
            maxSize: {{ $max_size ?? 200 }},
            route: "{{ $route ?? '' }}",
            assetUrl: "{{ url('assets/img/insurance_report.png') }}",
            bigDocLinkImage: "{{ asset('assets/img/big_doc_link.jpg') }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/upload_doc_form_signed_docs.js') }}"></script>
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/upload_doc_form_signed_docs.css') }}">
@endpush
