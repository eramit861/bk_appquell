<div class="outline-gray-border-area">
    @if (
        !empty($finacial_affairs['property_transferred_data']['person_paid']) &&
            is_array($finacial_affairs['property_transferred_data']['person_paid']))
        @for ($i = 0; $i < count($finacial_affairs['property_transferred_data']['person_paid']); $i++)
            @include('client.questionnaire.affairs.property_transferred', [
                'finacial_affairs' => $finacial_affairs['property_transferred_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.property_transferred', ['i' => 0, 'isEmpty' => true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addPropertyTransferredForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>
