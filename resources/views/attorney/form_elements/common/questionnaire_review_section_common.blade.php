@php
    $forKey = $forKey ?? '';
    $forLabel = $forLabel ?? '';
@endphp

@if (!empty($loggedInUser))
    @php
        $isChecked = false;
        $name = '';
        $time = '';
        if (array_key_exists($forKey, $rwData)) {
            $biData = Helper::validate_key_value($forKey, $rwData);
            if (Helper::validate_key_value('status', $biData, 'radio') == 1) {
                $isChecked = true;
                $name = Helper::validate_key_value('name', $biData);
                $time = Helper::validate_key_value('time', $biData);
            }
        }
        $bubbleClasses = 'bubble-danger reviewed-sec-'.$forKey;
        if ($isChecked) {
            $bubbleClasses = 'bubble-success reviewed-sec-'.$forKey;
        }
        $loggedInUserName = ($loggedInUser->role == 1) ? 'BKQ Admin' : $loggedInUser->name;
    @endphp

    <div class="att-edit-div reviewed-parent p-0 {{ $isChecked ? '' : 'not-reviewed' }} {{ 'reviewed-'.$forKey }}">
        <div class="reviewed-section">
            <div class="row input-group m-0 review-input-group f-12 d-flex align-items-center px-2 {{ $bubbleClasses }}" style="max-width: 450px"
                onclick="showHideReviewedInput('{{ $isChecked ? 'success' : 'danger' }}', '{{ $forKey }}')"
            >
                <!-- Success Label -->
                <div class="{{ $isChecked ? 'col-8' : 'hide-data' }} p-0">
                    <label class="float-right font-weight-bold mb-0 success-label-{{ $forKey }} {{ $isChecked ? '' : 'hide-data' }}">Reviewed By: {{ $name }} on: Date {{ $time }}</label>
                </div>
                <!-- Danger Label-->
                <label class="mb-0 font-weight-bold danger-label-{{ $forKey }} {{ $isChecked ? 'hide-data' : '' }}">{{ $forLabel }} </label>
                <small class="danger-small-{{ $forKey }} {{ $isChecked ? 'hide-data' : '' }}">(not reviewed)</small>

                <div class="col-8 label-div m-0 hide-data {{ $forKey }}_reviewed_by p-0">
                    <input type="text" class="form-control review mx-2" value="{{ $isChecked ? $loggedInUserName : '' }}" placeholder="If by someone else, enter here" style="height: 26px; padding:8px !important; border-radius: 4px !important;">
                </div>
                <div class=" col-4 table-responsive w-auto p-0">
                    <button onclick="updateReviewStatus(this, {{ $loggedInUser->id }}, '{{ $forKey }}', '{{ $forLabel }}', '{{ $loggedInUserName }}')" class="hide-data ml-2 view_client_btn save-icon-{{ $forKey }}">Select Reviewed</button>
                    <button class="{{ $isChecked ? '' : 'hide-data' }} ml-2 view_client_btn reviewed-icon-{{ $forKey }}">Select to Re-review</button>
                </div>
            </div>
        </div>
    </div>
@endif