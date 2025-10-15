<div class="form-title mb-9 avoid-this" style="margin-top:15px;">
    <button type="submit"
        style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold"
        class="float-right ml-2 print-hide">
        <span class="card-title-text">{{ $title }}</span>
    </button>
</div>
@if (isset($divtitle) != '')
    <div class="form-title mb-9 avoid-this" style="margin-top:15px;">
        <a id="generate_combined_pdf" onclick="printDocument({{ isset($divtitle) ? '"' . $divtitle . '"' : '' }})"
            href="javascript:void(0)">
            <button type="button"
                style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold"
                class="float-right ml-2  generate_combined">
                <span class="card-title-text">{{ __('print') }}</span>
            </button>
        </a>
    </div>
@endif