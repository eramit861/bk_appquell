<div class="outline-gray-border-area">
    @if(!empty($finacial_affairs['all_property_transfer_10_year_data']['trust_name']) && is_array($finacial_affairs['all_property_transfer_10_year_data']['trust_name']))
        @for($i = 0; $i < count($finacial_affairs['all_property_transfer_10_year_data']['trust_name']); $i++)
            @include("client.questionnaire.affairs.list_all_property_transfer_data",['finacial_affairs'=>$finacial_affairs['all_property_transfer_10_year_data'],$i])
        @endfor
    @else
        @include("client.questionnaire.affairs.list_all_property_transfer_data", ['i' => 0, 'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2" onclick="addListAllPropertyTransferForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>