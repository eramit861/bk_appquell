@if (isset($popup_label) && !empty($popup_label))
    <div class="col-12 attorney_edit head">
        <div class="row w-100 mx-0">
            <div class="col-12 d-flex align-items-center px-0">
                <h4 class="py-3 mb-0 w-100 text-c-white">{{ $popup_label }}</h4>
                <a href="javascript:void(0)" class="float-right att-edit-close-btn" onClick="$.facebox.close();">
                    <h4 class=" mb-0 w-100 text-c-white">Close</h4>
                </a>
            </div>
        </div>
    </div>
@endif
<div class="px-3 pb-1">
    @include("client.questionnaire.tab1",$info)
</div>