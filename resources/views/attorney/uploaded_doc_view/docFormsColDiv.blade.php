@php
$docsCount = count($docs);
@endphp

<div class="col-12">
    <form id="{{ $objKey }}" class="main_form_{{ $objKey }}" data-parentKey="{{ $key }}"
        action="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $objKey, 'employer_id' => null]) }}"
        method="GET">

        <div class="employer-card border-1px-tab-link-color mb-4  ">
            <div class="employer-header row accordian-with-docs-employer-header " data-bs-toggle="collapse"
                data-bs-target="#common_doc_section_{{ str_replace(' ', '_', $objKey) }}" aria-expanded="true">
                <div class="col-12 col-md-8 d-flex-ai-center">
                    <h3 class="fs-5 mb-0 text-start w-100 d-flex-ai-center">
                        {{ Helper::validate_key_value($objKey, $allDocNames) }}
                    </h3>
                    @php
                    $editorCh = isset($savedData->data) && !empty(json_decode($savedData->data)->editor_chepter) ? json_decode($savedData->data)->editor_chepter : '';
                    $selectedTrusteeID = isset($savedData->data) && !empty(json_decode($savedData->data)->trustee) ? json_decode($savedData->data)->trustee : '';
                    $selectedTrusteeID = !empty($selected_trustee) ? $selected_trustee : $selectedTrusteeID;
                    @endphp
                    @if ($objKey == 'TrusteeForms' && $editorCh !== 'chapter13' && isset($trustees) && !empty($trustees) && (in_array($parentAttorneyId, [54695, 53145, 55270]) || in_array(env('APP_ENV'), ['local', 'development'])))
                    <div class="light-gray-div border-0 m-0 p-0" data-bs-toggle="none" onclick="event.stopPropagation();">
                        <div class="label-div m-0 d-flex-ai-center">
                            <label class="mb-0">Trustee:</label>
                            <select class="form-control mr-1 ms-2 w-100"
                                onchange="changeTrustee(this, {{ $client_id }})">
                                <option value="">Choose Trustee</option>
                                @foreach ($trustees as $trustee)
                                <option value="{{ Helper::validate_key_value('id', $trustee, 'radio') }}" {{ $selectedTrusteeID == Helper::validate_key_value('id', $trustee, 'radio') ? 'selected' : '' }}>{{ Helper::validate_key_value('trustee_name', $trustee) }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-12 col-md-4 d-flex-ai-center">
                    <div class="ml-auto d-flex-ai-center">
                        @if ($docsCount > 0)
                        <label
                            class="fs-13px mb-0 me-2 text-success text-bold accordian-with-docs">{{ 'Click to Show ' . $docsCount . ($docsCount > 1 ? ' doc(s)' : ' doc') }}</label>
                        @endif
                        <div class="toggle-icon">
                            <i class="bi bi-chevron-down fs-5 "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="light-gray-div mt-3 mb-3 doc-parent-div align-items-unset collapse {{ isset($expandableDiv) && $expandableDiv ? ' show' : '' }}"
            id="common_doc_section_{{ str_replace(' ', '_', $objKey) }}">
            <div class="row gx-3">
                @if (!empty($docs))
                    @foreach ($docs as $doc)
                        @php
                        $formName = Helper::validate_key_value('form_name', $doc);
                        $formTabDescription = Helper::validate_key_value('form_tab_description', $doc);
                        $document_type = '';
                        @endphp
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="py-1">
                                <div class="document-div">
                                    <div class=" d-flex align-items-center">
                                        <!-- |logo  -->
                                        @include('attorney.uploaded_doc_view.docSvgLogo')
                                        <!-- |rename btn  -->
                                        <span class="small_title w-100 text-bold ms-2 align-items-center d-md-flex">
                                            {{ $formName }}
                                            @if (!empty($formTabDescription))
                                            <span class="ms-1 text-bold">({{ $formTabDescription }})</span>
                                            @endif
                                        </span>
                                        <!-- |download  -->
                                        <a href="javascript:void(0)"
                                            onclick="openWindow('{{ route('attorney_offical_form', ['id' => $client_id]) }}?download={{ $doc['form_tab_content'] }}')"
                                            class="text-danger p-sm-1 ms-2 me-1 red-pdf-icon" title="">
                                            <i class="bi bi-file-earmark-pdf-fill pdf-icon-inside" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </form>
</div>