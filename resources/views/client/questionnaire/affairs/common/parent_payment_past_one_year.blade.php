<div class="outline-gray-border-area">
    @if (
        !empty($finacial_affairs['past_one_year_data']['creditor_address_past_one_year']) &&
            is_array($finacial_affairs['past_one_year_data']['creditor_address_past_one_year']))
        @for ($i = 0; $i < count($finacial_affairs['past_one_year_data']['creditor_address_past_one_year']); $i++)
            @include('client.questionnaire.affairs.payment_past_one_year', [
                'finacial_affairs' => $finacial_affairs['past_one_year_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.payment_past_one_year', ['i' => 0, 'isEmpty' => true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addPaymentPastOneYearForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Insider Payments
        </button>
    </div>
</div>
