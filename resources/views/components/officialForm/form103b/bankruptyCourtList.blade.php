@php $checkBoxName = $checkBoxName ?? "Check if this is an amended filing"; @endphp
@php $districtName = $districtName ?? "Bankruptcy District Information"; @endphp
<div class="row">
    <x-officialForm.districList :districtNames="$districtNames" :savedData="$savedData"
        name="{{ $districtName }}"></x-officialForm.districList>
    <div class="col-md-5">
        @if (!empty($showCheckBox))
            <div class="amended">
                <input type="checkbox" name="{{ base64_encode($checkBoxName) }}">
                <label>{{ __('Check if this is an amended filing') }}</label>
            </div>
        @endif
    </div>
</div>
