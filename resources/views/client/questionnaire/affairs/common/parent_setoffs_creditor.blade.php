<div class="outline-gray-border-area">
    @if (
        !empty($finacial_affairs['setoffs_creditor_data']['creditors_address']) &&
            is_array($finacial_affairs['setoffs_creditor_data']['creditors_address']))
        @for ($i = 0; $i < count($finacial_affairs['setoffs_creditor_data']['creditors_address']); $i++)
            @include('client.questionnaire.affairs.setoffs_creditor', [
                'finacial_affairs' => $finacial_affairs['setoffs_creditor_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.setoffs_creditor', ['i' => 0, 'isEmpty' => true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addSetoffsCreditorForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>
