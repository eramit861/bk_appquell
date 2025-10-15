<div class="outline-gray-border-area" id="employer_listing_html">
    @php
    $enableEdit = isset($enableEdit) && $enableEdit ? true : false;
    $formId = isset($formId) && $formId ? $formId : '';
    @endphp
    @if (!empty($currentEmployerData) && count($currentEmployerData) > 0)
        @foreach ($currentEmployerData as $key => $value)
            @include("attorney.form_elements.common.income_employer_summary_common_new",[ 'value' => $value, 'enableEdit' => $enableEdit, 'summaryDivId' => 'employer_page_listing_div', 'formId' => $formId ])
        @endforeach
    @else
        @php
        $key = 0;
        $value = [];
        @endphp
        @include("attorney.form_elements.common.income_employer_summary_common_new",[ 'enableEdit' => $enableEdit, 'summaryDivId' => 'employer_page_listing_div', 'formId' => $formId ])
    @endif
    @if ($enableEdit)
        <div class="add-more-div-bottom">
            <button type="button" class="btn-new-ui-default py-1 px-2" onclick="addMoreCurrentEmployer('{{ $formId ?? '' }}'); return false;">
                <i class="bi bi-plus-lg"></i>
                Add Additional Current Employer(s)
            </button>
        </div>
    @endif
</div>