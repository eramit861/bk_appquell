@php
if (!isset($finacial_affairs['list_nature_business_data']['name'])) {
    $einArray = json_decode($BasicInfo_PartRest['used_business_ein_data'], 1);
    $businesses = $einArray['own_business_selection'];
    $businesnames = $einArray['own_business_name'];
    $einnos = $einArray['own_ein_no'] ?? [];
    $einBusiness = [];
    $name = [];
    $ein = [];
    foreach ($businesses as $key => $business) {
        $name[] = $businesnames[$key];
        $ein[] = $einnos[$key] ?? '';
    }
    $finacial_affairs['list_nature_business_data'] = ['name' => $name, 'eiin' => $ein];
}
@endphp
<div class="outline-gray-border-area">
    @if (!empty($finacial_affairs['list_nature_business_data']['name']) && is_array($finacial_affairs['list_nature_business_data']['name']))
        @for ($i = 0; $i < count($finacial_affairs['list_nature_business_data']['name']); $i++)
            @include("client.questionnaire.affairs.list_nature_business",['finacial_affairs'=>$finacial_affairs['list_nature_business_data'],$i])
        @endfor
    @else
        @include("client.questionnaire.affairs.list_nature_business", ['i' => 0,'businessdata' => $BasicInfo_PartRest['used_business_ein_data'], 'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" id="add-more-residence-form" class="btn-new-ui-default py-1 px-2" onclick="addListNatureBusinessForm(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Businesses
        </button>
    </div>
</div>