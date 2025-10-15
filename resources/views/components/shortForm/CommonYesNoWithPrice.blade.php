<div class="mt-2 {{ $mainDivClass ?? '' }}">
    <div class="col-12 p-0 {{ $mainDivClass ?? '' }}">
        <div class="label-div question-area">
            <label class="">{!! $label !!}</label>
            <!-- <div class="pl-3 float-r"> -->
            <div class="custom-radio-group form-group">
                <input type="radio" required name="{{ $radioName }}" class="d-none" id="{{ $radioName }}_1" onclick="commonShowHide('{{ $radioName }}_section', 1)" {{ old($radioName) === 1 ? 'checked' : '' }} value="1">
                <label for="{{ $radioName }}_1" class="btn-toggle">Yes</label>

                <input type="radio" required name="{{ $radioName }}" class="d-none" id="{{ $radioName }}_0" onclick="commonShowHide('{{ $radioName }}_section', 0)" {{ old($radioName) === 0 ? 'checked' : '' }} value="0">
                <label for="{{ $radioName }}_0" class="btn-toggle form-check-label">No</label>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <div class="col-12 p-0 {{ $radioName }}_section hide-data ">
        @if (!empty($amountName))
            <div class="label-div">
                <div class="form-group {{ $radioName }}_section hide-data">
                    <label class=" w-100">{{ $placeholder ?? 'Avg. Monthly Inc.' }}</label>
                    <div class="d-flex input-group w-fit-content  pt-0">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" required name="{{ $amountName }}"
                            class="w-auto form-control price-field custom_corner_input" placeholder="{{ $placeholder ?? 'Avg. Monthly Inc.' }}"
                            value="{{ old($amountName) }}">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>