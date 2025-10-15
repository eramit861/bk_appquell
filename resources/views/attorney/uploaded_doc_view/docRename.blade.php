<span class="small_title w-100 text-bold ms-2 edit_doc_name_{{$docId}} align-items-center text-break d-inline-grid-mobile d-flex flex-wrap">
    <span class="doc-name fs-mob-12px">
        {{-- {{ substr($docname, 0, 50) }} --}}
        {{ $docname }}
    </span>
    <span class="document-status highlight_btn_requested fs-10px red blink text-bold font-italic {{$indicator}} ms-2 " style="white-space: nowrap;">
        New Doc(s) Awaiting Approval
    </span>
</span>
@if ($formultiples)
    <div class="label-div mb-0 ms-2 w-100 d-none edit_doc_name_div_{{$docId}} doc-input-div">
        <input type="text" name="" id="" class="form-control-none d-none only_alphanumeric edit_doc_name_input_{{$docId}} " value="{{ $docname }}" readonly="true">
    </div>
@endif