<div class="d-flex align-items-center" onclick="event.stopPropagation();">
    <!-- HOVER WRAPPER -->
    <div class="d-flex align-items-center w-100">

        <div class="client-{{ $dataFor }}-hover d-flex-ai-center">
            @if($dataFor == 'email')
                <i class="bi bi-envelope-fill mr-2 client-{{ $dataFor }}" onclick="event.stopPropagation();"></i>
            @endif
            @if($dataFor == 'phone')
                <i class="bi bi-telephone-fill mr-2 client-{{ $dataFor }}" onclick="event.stopPropagation();"></i>
            @endif
            <!-- INFO -->
            <h3 class="client-{{ $dataFor }} datalabel m-0 me-2" onclick="event.stopPropagation();">
                {!! $dataLabel !!}
            </h3>
        </div>
    </div>
</div>