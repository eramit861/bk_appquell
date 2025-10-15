<div class="d-flex align-items-center">
    <!-- HOVER WRAPPER -->
    <div class="d-flex align-items-center w-100" onclick="event.stopPropagation();">
        <div class="d-flex-ai-center">
            @if($dataFor == 'clientType')
                <i class="bi bi-person-fill no-width-opacity"></i><small class="text-muted mr-2">Client&nbsp;Type:</small>
            @endif
            @if($dataFor == 'attorney')
                <i class="bi bi-person-fill no-width-opacity"></i><small class="text-muted mr-2">Attorney:</small>
            @endif
            <!-- INFO -->
            <h3 class="client-{{ $dataFor }} datalabel m-0 mr-2">
                {!! $dataLabel !!}
            </h3>
        </div>
    </div>
</div>