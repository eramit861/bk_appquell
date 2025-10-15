<div class="col-12">
    <div class="employer-card border-1px-tab-link-color mb-4 ">
        <div class="employer-header row accordian-with-docs-employer-header" data-bs-toggle="collapse" data-bs-target="#secured_debt_section_{{ str_replace(" ", "_", $securedObjKey) }}" aria-expanded="true">
            <div class="col-12 col-md-11 d-flex align-items-center">
                <h3 class="mb-0 text-start fs-1-25rem fs-mob-1rem">
                    {{ Helper::validate_key_value($securedObjKey, $allDocNames) }}
                </h3>
            </div>
            <div class="col-12 col-md-1 d-flex align-items-center toggle-icon">
                <i class="bi bi-chevron-down fs-5 ml-auto"></i>
            </div>
        </div>
    </div>

    <div class="collapse {{ isset($expandableDiv) && $expandableDiv ? 'collapse show' : '' }} secured-docs-section mb-3" id="secured_debt_section_{{ str_replace(" ", "_", $securedObjKey) }}">
        <div class="card-body">
            <form id="{{$securedObjKey}}" class="main_form_{{$securedObjKey}}" data-parentKey="{{$key}}"
                action="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $securedObjKey, 'employer_id' => null]) }}"
                method="GET">
                @include('attorney.uploaded_doc_view.docSecuredColFormData')
            </form>
        </div>
    </div>
</div>