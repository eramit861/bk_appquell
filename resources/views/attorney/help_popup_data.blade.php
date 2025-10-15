<div class="modal-content modal-content-div">
    @if(!empty($title))
        <div class="modal-header align-items-center py-2">
            <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
                {{ $title }}
                @if(!empty($subTitle))
                    <span class="">
                        {{ $subTitle }}
                    </span>
                @endif
            </h5>
        </div>
    @endif
    
    @if(!empty($body))
        <div class="modal-body">
            {!! $body !!}
        </div>
    @endif
</div>