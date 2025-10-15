@php
    $queLabel = Helper::validate_key_value('label', $object);
    switch ($name) {
        case 'collectibles':
            $queLabel = 'Only list items worth over $500!!!';
            break;
        case 'sports':
            $queLabel = 'Only list items worth over $500!!!';
            break;
        case 'jewelry':
            $queLabel = 'Only list items worth over $500!!! This includes engagement and wedding bands!!!';
            break;
    }
    $parent_label = Helper::validate_key_value('parent_label', $object);
    $parent_label = empty($parent_label) ? $label : $parent_label;
@endphp

<div class="light-gray-div mt-3">
    <h2>{!! $label !!}</h2>
    <div class="row gx-3">
        <div class="col-12">
            <div class="label-div">
                <div class="form-group mb-0">
                    <label class="">Main Question Label:</label>
                    <input type="text" class="form-control required" placeholder="Main Question Label:" name="{{ $name }}[parent_label]" value="{{ $parent_label }}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="label-div">
                <div class="form-group mb-0">
                    <label class="">Question Label:</label>
                    <input type="text" class="form-control" placeholder="Question Label:" name="{{ $name }}[label]" value="{{ Helper::validate_key_value('label', $object) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-9">
            <div class="label-div">
                <div class="form-group mb-0">
                    <label class="">Description:</label>
                    <input type="text" class="form-control" placeholder="Description:" name="{{ $name }}[data][0]" value="{{ Helper::validate_key_value('0', $object['data'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="label-div">
                <div class="form-group mb-0">
                    <label class="">Property Value:</label>
                    <input type="number" class="form-control price-field" placeholder="Property Value:" name="{{ $name }}[data][1]" value="{{ Helper::validate_key_value('1', $object['data'] ?? '') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save</span></button>
    </div>
</div>
