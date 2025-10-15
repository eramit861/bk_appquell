<div class="outline-gray-border-area">
    @if (!empty($finacial_affairs['property_repossessed_data']['creditor_address']))
        @for ($i = 0; $i < count($finacial_affairs['property_repossessed_data']['creditor_address']); $i++)
            @include('client.questionnaire.affairs.property_repossessed_data_form', [
                'finacial_affairs' => $finacial_affairs['property_repossessed_data'],
                'i' => $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.property_repossessed_data_form', [
            'i' => 0,
            'isEmpty' => true,
        ])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addPropertyRepossessedDataForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Actions Against You
        </button>
    </div>
</div>
