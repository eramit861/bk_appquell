@php
$dataSubscriptionId = $dataSubscriptionId ?? '';
$showButtons = $showButtons ?? true;
$options = $options ?? '';
@endphp

<div class="d-flex align-items-center ">
    <!-- HOVER WRAPPER -->
    <div class="client-{{ $dataFor }}-wrapper d-flex align-items-center w-100" id="client-{{ $dataFor }}-wrapper-{{ $clientId }}">

        <div class="client-{{ $dataFor }}-hover d-flex-ai-center " onclick="event.stopPropagation();">
            @if($dataFor == 'clientType')
                {!! '<i class="bi bi-person-fill no-width-opacity"></i><small class="text-muted me-2">Client&nbsp;Type:</small>' !!}
            @endif
            @if($dataFor == 'paralegal')
                {!! '<i class="bi bi-person-fill no-width-opacity"></i><small class="text-muted me-2">Paralegal:</small>' !!}
            @endif
            @if($dataFor == 'lawFirm')
                {!! '<i class="bi bi-person-fill no-width-opacity"></i><small class="text-muted me-2">Law&nbsp;Firm:</small>' !!}
            @endif

            <!-- INFO -->
            <h3 class="client-{{ $dataFor }} datalabel m-0 me-2" id="client-{{ $dataFor }}-{{ $clientId }}">
                {{ $dataLabel }}
            </h3>


            <!-- EDIT BUTTON (hidden via opacity) -->
            @if($showButtons)
                <button class="btn btn-primary-custom btn-custom my-0 me-0 ms-2 edit_{{ $dataFor }}_btn edit d-none"
                    style="opacity: 0; transition: opacity 0.3s;"
                    onclick="editClienInfo('{{ $clientId }}', '{{ $dataFor }}')"
                    id="edit-btn-{{ $dataFor }}-{{ $clientId }}"
                    title="Click to edit client {{ $dataFor }}">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            @endif
        </div>

        <!-- SELECT INPUT (shown on edit) -->
        <select name="edit_client_type"
            class="form-control-none w-100 border-bottom-gray d-none {{ $dataFor }}"
            id="edit-input-{{ $dataFor }}-{{ $clientId }}" onclick="event.stopPropagation();">
            @if($dataFor == 'clientType')
                {!! ArrayHelper::getClientTypeSelection($dataValue) !!}
            @endif
            @if($dataFor == 'paralegal')
                {!! '<option value="">Select Paralegal</option>' !!}
                {!! Helper::getParalegalSelection($dataValue) !!}
            @endif
            @if($dataFor == 'lawFirm')
                {!! $options !!}
            @endif
        </select>

        <!-- SAVE BUTTON -->
        @if($showButtons)
            <span onclick="updateSelectInfoFn(this, '{{ $dataFor }}', '{{ $clientId }}','{{ $dataValue }}','{{ $dataSubscriptionId }}');event.stopPropagation();"
                class="btn btn-success-custom btn-custom submit edit d-none ms-2 edit_{{ $dataFor }}_submit_{{ $clientId }}"
                id="save-btn-{{ $dataFor }}-{{ $clientId }}">
                <i class="bi bi-floppy2"></i> Save
            </span>
        @endif
    </div>
</div>