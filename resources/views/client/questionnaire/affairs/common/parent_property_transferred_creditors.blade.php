<div class="outline-gray-border-area">
    @if (
        !empty($finacial_affairs['property_transferred_creditors_data']['person_paid_address']) &&
            is_array($finacial_affairs['property_transferred_creditors_data']['person_paid_address']))
        @for ($i = 0; $i < count($finacial_affairs['property_transferred_creditors_data']['person_paid_address']); $i++)
            @include('client.questionnaire.affairs.property_transferred_creditors', [
                'finacial_affairs' => $finacial_affairs['property_transferred_creditors_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.property_transferred_creditors', [
            'i' => 0,
            'isEmpty' => true,
        ])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addPropertyTransferredCreditorsForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>
