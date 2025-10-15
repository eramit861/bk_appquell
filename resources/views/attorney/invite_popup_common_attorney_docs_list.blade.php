@if(isset($commonDocuments) && !empty($commonDocuments))
<div class="col-xl-12 col-lg-12 col-md-12 mt-3 doc_list d-none">
    <div class="employer-card border-1px-tab-link-color mb-4 ">
        <div class="employer-header border-bottom-default p-3 row" data-bs-toggle="collapse" data-bs-target="#attorney_common_doc_section" aria-expanded="true">
            <div class="col-12 col-md-11 d-flex align-items-center">
                <h3 class="fs-5 mb-0 text-start text-success">
                    Common Document List
                </h3>
            </div>
            <div class="col-12 col-md-1 d-flex align-items-center toggle-icon">
                <i class="bi bi-chevron-down fs-5 ml-auto"></i>
            </div>
        </div>
    </div>

    <div class="collapse" id="attorney_common_doc_section">
        <div class="card-body border-0 pt-0">
            <div class="row">
                @php
                    $doc_list_name = 'attorney_common_doc';
                @endphp

                @foreach($commonDocuments as $key => $document)
                    @php
                        $document_name = Helper::validate_key_value('document_name', $document);
                        $document_type = Helper::validate_key_value('document_type', $document);
                        $document_id = Helper::validate_key_value('id', $document);
                        $borderClass = 'not-selected-border';
                        $cardBg = "no-selected";
                        $checkedStatus = false;
                        if (old($doc_list_name . '[' . $key . ']') === '1') {
                            $checkedStatus = true;
                        }
                    @endphp
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="custom-item mt-2">
                            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}" data-label="">
                                <div class="card-body p-0">
                                    <label class="w-100 d-flex mb-0" for="{{ $doc_list_name . $key }}">
                                        <span class="doc-card w-100 name_{{ $key }}">{{ $document_name }}</span>
                                        <input type="checkbox"
                                            id="{{ $doc_list_name . $key }}"
                                            class="float_right d-none mt-1 notify_doc"
                                            name="{{ $doc_list_name }}[{{ $document_type }}]"
                                            value="{{ $document_name }}"
                                            onclick="selectDocument()"
                                            @if($checkedStatus) checked @endif>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif