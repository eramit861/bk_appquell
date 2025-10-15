<div class="outline-gray-border-area">
    @if (!empty($finacial_affairs['community_property_state']))
        @for ($i = 0; $i < count($finacial_affairs['community_property_state']); $i++)
            @include('client.questionnaire.affairs.common.living_domestic_partner', [$i])
        @endfor
    @else
        @include('client.questionnaire.affairs.common.living_domestic_partner', [
            'i' => 0,
            'isEmpty' => true,
        ])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2"
            onclick="addNameAddressSpouseForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Spouses
        </button>
    </div>
</div>
