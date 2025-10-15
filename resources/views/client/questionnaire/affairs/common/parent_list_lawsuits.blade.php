<div class="outline-gray-border-area">
    @if(!empty($finacial_affairs['list_lawsuits_data']['case_title']) && is_array($finacial_affairs['list_lawsuits_data']['case_title']))
        @for($i = 0; $i < count($finacial_affairs['list_lawsuits_data']['case_title']); $i++)
            @include("client.questionnaire.affairs.list_lawsuits",['finacial_affairs'=>$finacial_affairs['list_lawsuits_data'],$i])
        @endfor
    @else
        @include("client.questionnaire.affairs.list_lawsuits", ['i'=>0, 'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2" onclick="addListLawsuitsForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Lawsuit(s)
        </button>
    </div>
</div>