<div class="outline-gray-border-area">
    @if (
        !empty($finacial_affairs['transfers_property_data']['creditor_address_transfers_property']) &&
            is_array($finacial_affairs['transfers_property_data']['creditor_address_transfers_property']))
        @for ($i = 0; $i < count($finacial_affairs['transfers_property_data']['creditor_address_transfers_property']); $i++)
            @include('client.questionnaire.affairs.transfers_property', [
                'finacial_affairs' => $finacial_affairs['transfers_property_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.transfers_property', ['i' => 0, 'isEmpty' => true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addTransfersPropertyForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Insider Payments
        </button>
    </div>
</div>
