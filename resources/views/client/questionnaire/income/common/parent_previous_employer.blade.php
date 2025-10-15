<div class="outline-gray-border-area mt-2">
    @if (!empty($previousEmployerData) && count($previousEmployerData) > 0)
        @foreach ($previousEmployerData as $i => $data)
            @include('client.questionnaire.income.common.previous_employer', ['debType' => $debType])
        @endforeach
    @else
        @php
            $i = 0;
            $data = [];
        @endphp
        @include('client.questionnaire.income.common.previous_employer', [
            'debType' => $debType,
            'isEmpty' => true,
        ])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2"
            onclick="addMorePreviousEmployer('previous_employer_div_{{ $debType }}'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Previous Employer(s)
        </button>
    </div>
</div>
