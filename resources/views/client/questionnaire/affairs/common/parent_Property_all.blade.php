<div class="outline-gray-border-area">
    @if (!empty($finacial_affairs['Property_all_data']['name']) && is_array($finacial_affairs['Property_all_data']['name']))
        @for ($i = 0; $i < count($finacial_affairs['Property_all_data']['name']); $i++)
            @include('client.questionnaire.affairs.Property_all', [
                'finacial_affairs' => $finacial_affairs['Property_all_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.Property_all', ['i' => 0, 'isEmpty' => true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addPropertyAllForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>
