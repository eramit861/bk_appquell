<form name="template_data_save" id="template_data_save" action="{{route('template_data_save')}}" method="post" novalidate>
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="household_goods_furnishings[type_value]" value="1">
    <input type="hidden" name="electronics[type_value]" value="1">
    <input type="hidden" name="collectibles[type_value]" value="1">
    <input type="hidden" name="sports[type_value]" value="1">
    <input type="hidden" name="firearms[type_value]" value="1">
    <input type="hidden" name="clothing[type_value]" value="1">
    <input type="hidden" name="jewelry[type_value]" value="1">
    <input type="hidden" name="pets[type_value]" value="1">
    <input type="hidden" name="health_aids[type_value]" value="1">
    @php
    $household_goods_furnishings = Helper::validate_key_value('household_goods_furnishings', $templateData);
    $electronics = Helper::validate_key_value('electronics', $templateData);
    $collectibles = Helper::validate_key_value('collectibles', $templateData);
    $sports = Helper::validate_key_value('sports', $templateData);
    $firearms = Helper::validate_key_value('firearms', $templateData);
    $clothing = Helper::validate_key_value('clothing', $templateData);
    $jewelry = Helper::validate_key_value('jewelry', $templateData);
    $pets = Helper::validate_key_value('pets', $templateData);
    $health_aids = Helper::validate_key_value('health_aids', $templateData);
    @endphp
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any household goods and/or furnishings?"
        name="household_goods_furnishings"
        :object="$household_goods_furnishings" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any electronics?"
        name="electronics"
        :object="$electronics" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any Collectibles?"
        name="collectibles"
        :object="$collectibles" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any Equipment for sports and hobbies?"
        name="sports"
        :object="$sports" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any Firearms, ammunition, and related equipment?"
        name="firearms"
        :object="$firearms" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any Clothing?"
        name="clothing"
        :object="$clothing" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any Jewelry?"
        name="jewelry"
        :object="$jewelry" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any Non-farm animals?"
        name="pets"
        :object="$pets" />
    <x-attorney.template_management.defaultQue
        label="Do you own or possess any other personal and/or household items you haven't already listed above?"
        name="health_aids"
        :object="$health_aids" />
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save</span></button>
    </div>
</form>