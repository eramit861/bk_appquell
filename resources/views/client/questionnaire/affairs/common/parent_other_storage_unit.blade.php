<div class="outline-gray-border-area">
    @if (
        !empty($finacial_affairs['other_storage_unit_data']['name']) &&
            is_array($finacial_affairs['other_storage_unit_data']['name']))
        @for ($i = 0; $i < count($finacial_affairs['other_storage_unit_data']['name']); $i++)
            @include('client.questionnaire.affairs.other_storage_unit', [
                'finacial_affairs' => $finacial_affairs['other_storage_unit_data'],
                $i,
            ])
        @endfor
    @else
        @include('client.questionnaire.affairs.other_storage_unit', ['i' => 0, 'isEmpty' => true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addOtherStorageUnitForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>
