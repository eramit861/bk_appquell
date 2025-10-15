<div class="d-flex align-items-center">
    <!-- HOVER WRAPPER -->
    <div class="client-{{ $dataFor }}-wrapper d-flex align-items-center w-100"
        id="client-{{ $dataFor }}-wrapper-{{ $clientId }}">

        <div class="client-{{ $dataFor }}-hover d-flex-ai-center " onclick="event.stopPropagation();">
            @if ($dataFor == 'email')
                {!! '<i class="bi bi-envelope-fill me-2 client-' . $dataFor . '"></i>' !!}
            @endif
            @if ($dataFor == 'phone')
                {!! '<i class="bi bi-telephone-fill me-2 client-' . $dataFor . '"></i>' !!}
            @endif

            <!-- INFO -->
            <h3 class="client-{{ $dataFor }} datalabel m-0 me-2" id="client-{{ $dataFor }}-{{ $clientId }}">
                {{ $dataLabel }}
            </h3>

            <!-- EDIT BUTTON (hidden via opacity) -->
            <button class="btn btn-primary-custom btn-custom my-0 me-0 ms-2 edit_{{ $dataFor }}_btn edit d-none"
                style="opacity: 0; transition: opacity 0.3s;"
                onclick="editClienInfo('{{ $clientId }}', '{{ $dataFor }}'); event.stopPropagation();"
                id="edit-btn-{{ $dataFor }}-{{ $clientId }}"
                title="Click to edit client {{ $dataFor }}">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>

        <!-- INPUT (shown on edit) -->
        <input type="text"
            class="form-control-none w-100 border-bottom-gray d-none {{ $dataFor }} {{ $dataFor == 'name' ? 'input_capitalize' : '' }} {{ $dataFor == 'phone' ? 'phone-field' : '' }} {{ $dataFor == 'email' ? 'email-field' : '' }}"
            id="edit-input-{{ $dataFor }}-{{ $clientId }}" value="{{ $dataLabel }}"
            onclick="event.stopPropagation();">

        <!-- SAVE BUTTON -->
        <span
            onclick="updateInfoFn(this, '{{ $dataFor }}', '{{ $clientId }}','{{ $dataLabel }}'); event.stopPropagation();"
            class="btn btn-success-custom btn-custom submit edit d-none ms-2 edit_{{ $dataFor }}_submit_{{ $clientId }}"
            id="save-btn-{{ $dataFor }}-{{ $clientId }}">
            <i class="bi bi-floppy2"></i> Save
        </span>

    </div>
</div>
