<div class="outline-gray-border-area">
    @if(!empty($finacial_affairs['gifts_charity_data']['charity_street']) && is_array($finacial_affairs['gifts_charity_data']['charity_street']))
        @for($i = 0; $i < count($finacial_affairs['gifts_charity_data']['charity_street']); $i++)
            @include("client.questionnaire.affairs.gifts_charity",['finacial_affairs'=>$finacial_affairs['gifts_charity_data'],$i])
        @endfor
    @else
        @include("client.questionnaire.affairs.gifts_charity", ['i'=>0, 'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2" onclick="addGiftsCharityForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>