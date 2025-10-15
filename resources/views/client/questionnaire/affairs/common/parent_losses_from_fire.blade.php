<div class="outline-gray-border-area">
    @if (
        !empty($finacial_affairs['losses_from_fire_data']['loss_description']) &&
            is_array($finacial_affairs['losses_from_fire_data']['loss_description']))
        @for ($i = 0; $i < count($finacial_affairs['losses_from_fire_data']['loss_description']); $i++)
            @include('client.questionnaire.affairs.losses_from_fire', [
                'finacial_affairs' => $finacial_affairs['losses_from_fire_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.losses_from_fire', ['i' => 0, 'isEmpty' => true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addLossesFromFireForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>
