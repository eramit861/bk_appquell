<div class="outline-gray-border-area">
    @if(!empty($finacial_affairs['list_any_gifts_data']['recipient_address']) && is_array($finacial_affairs['list_any_gifts_data']['recipient_address']))
        @for($i = 0; $i < count($finacial_affairs['list_any_gifts_data']['recipient_address']); $i++)
            @include("client.questionnaire.affairs.list_any_gifts",['finacial_affairs'=>$finacial_affairs['list_any_gifts_data'],$i])
        @endfor
    @else
        @include("client.questionnaire.affairs.list_any_gifts", ['i'=>0, 'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2" onclick="addlistAnyGiftsForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>