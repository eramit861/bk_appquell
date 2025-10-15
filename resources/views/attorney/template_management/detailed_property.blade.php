@php
    $subTypeData = \App\Helpers\Helper::validate_key_value($subType, $templateData);
@endphp
<form name="detailed_property_template_data_save" id="detailed_property_template_data_save" action="{{route('detailed_property_template_data_save')}}" method="post" novalidate>
    @csrf
    <input type="hidden" name="subType" value="{{ $subType }}">
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill w-100 p-0 shadow-none mb-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="btn-new-ui-default {{ $subType == 'data_household_goods_furnishings_items' ? 'active' : '' }}" id="preview_data_household_goods_furnishings_items" type="button" onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property', 'subType' => 'data_household_goods_furnishings_items']) }}')">
                        {{ \App\Helpers\UtilityHelper::getDetailedPropertyKeyNameForTemplate('data_household_goods_furnishings_items') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn-new-ui-default {{ $subType == 'data_electronics_items' ? 'active' : '' }}" id="preview_data_electronics_items" type="button" onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property', 'subType' => 'data_electronics_items']) }}')">
                        {{ \App\Helpers\UtilityHelper::getDetailedPropertyKeyNameForTemplate('data_electronics_items') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn-new-ui-default {{ $subType == 'data_collectibles_items' ? 'active' : '' }}" id="preview_data_collectibles_items" type="button" onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property', 'subType' => 'data_collectibles_items']) }}')">
                        {{ \App\Helpers\UtilityHelper::getDetailedPropertyKeyNameForTemplate('data_collectibles_items') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn-new-ui-default {{ $subType == 'data_sports_items' ? 'active' : '' }}" id="preview_data_sports_items" type="button" onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property', 'subType' => 'data_sports_items']) }}')">
                        {{ \App\Helpers\UtilityHelper::getDetailedPropertyKeyNameForTemplate('data_sports_items') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn-new-ui-default {{ $subType == 'data_firearms_items' ? 'active' : '' }}" id="preview_data_firearms_items" type="button" onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property', 'subType' => 'data_firearms_items']) }}')">
                        {{ \App\Helpers\UtilityHelper::getDetailedPropertyKeyNameForTemplate('data_firearms_items') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn-new-ui-default {{ $subType == 'data_everyday_clothing_items' ? 'active' : '' }}" id="preview_data_everyday_clothing_items" type="button" onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property', 'subType' => 'data_everyday_clothing_items']) }}')">
                        {{ \App\Helpers\UtilityHelper::getDetailedPropertyKeyNameForTemplate('data_everyday_clothing_items') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn-new-ui-default {{ $subType == 'data_everyday_and_fine_jewelry_items' ? 'active' : '' }}" id="preview_data_everyday_and_fine_jewelry_items" type="button" onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property', 'subType' => 'data_everyday_and_fine_jewelry_items']) }}')">
                        {{ \App\Helpers\UtilityHelper::getDetailedPropertyKeyNameForTemplate('data_everyday_and_fine_jewelry_items') }}
                    </button>
                </li>
            </ul>
        </div>

        <div class="col-12">
            <strong class="text-danger mb-2 text-center w-100 d-block">Click <i class="bi bi-arrows-move"></i> on any label to reorder them.</strong>
        </div>
        <div class="col-12 ">
            <div id="categories-container">
                @if (!empty($subTypeData))
                    @php $catIndex = 0; @endphp
                    @foreach ($subTypeData as $category => $catData)
                        <div class="light-gray-div category-div {{ 'category-div-no-' . $catIndex }}">
                            <h2 class="dragable-h2"><i class="bi bi-arrows-move text-bold me-2"></i>{{ $category }} </h2>
                            <button type="button" class="template delete-div" title="Delete" onclick="removeDetailedPropertyCategory('{{ 'category-div-no-' . $catIndex }}')">
                                <i class="bi bi-trash3 mr-1"></i>
                                Delete
                            </button>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label class="">Category Label:</label>
                                            <input type="text" class="form-control required" placeholder="Question Label:" name="{{ $category }}[category]" value="{{ $category }}">
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($catData))
                                    @foreach ($catData as $index => $data)
                                        @php $hint = \App\Helpers\Helper::validate_key_value('hint', $data); @endphp
                                        <div class="col-12 col-md-2 item-div">
                                            <div class="label-div">
                                                <div class="form-group mb-0">
                                                    <span class="d-flex align-items-center justify-content-between">
                                                        <label class="w-100 dragable-h2"><i class="bi bi-arrows-move text-bold me-2"></i><span>Label:</span> </label>
                                                        <button type="button" class="delete-div float-end px-2" title="Delete" onclick="removeDetailedPropertyItem(this, '{{ 'category-div-no-' . $catIndex }}')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </span>
                                                    <input type="text" class="form-control required" placeholder="Label:" name="{{ $category }}[data][{{ $index }}][key]" value="{{ \App\Helpers\Helper::validate_key_value('key', $data) }}">
                                                    @if (!empty($hint))
                                                        <small class="text-c-blue hint">{{ $hint }}<i class="bi bi-pencil-square hide-data ml-2"></i></small>
                                                    @else
                                                        <small class="text-c-blue hint">Add Description<i class="bi bi-plus-square hide-data ml-2"></i></small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="label-div hint-div hide-data">
                                                <div class="form-group mb-0">
                                                    <label class="">Description:</label>
                                                    <input type="text" class="form-control" placeholder="Description:" name="{{ $category }}[data][{{ $index }}][hint]" value="{{ $hint }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-12 col-md-2 add-new-item-div">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label class="">&nbsp</label>
                                            <button type="button" class="btn border-blue-big m-0 btn-new-ui-default py-2 px-3 btn-green" onClick="addNewDetailedPropertyItem('{{ 'category-div-no-' . $catIndex }}')">
                                                <span class=""><i class="bi bi-plus-lg"></i> Add New Item</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $catIndex++; @endphp
                    @endforeach
                @endif
            </div>
            <div class="add-more-div-bottom">
                <button type="button" class="btn-new-ui-default py-1 px-2" onclick="addNewDetailedPropertyCategory();">
                    <i class="bi bi-plus-lg"></i>
                    Add Additional Category(s)
                </button>
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save</span></button>
    </div>
</form>