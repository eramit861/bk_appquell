<div class="info-section">
    <div class="info-section-title">
        <span onclick="event.stopPropagation();">Status</span>
        @if ($is_case_filed == 1)
            <button class="btn btn-outline-custom btn-custom mt-1 ms-2" title="Preview Hearing Info" onclick="clientCaseFiledInfoPreviewPopup({{ $val['id'] }}, '{{ route('attorney_client_case_filed_preview_popup') }}', '{{ $type }}'); event.stopPropagation();">
                <i class="bi bi-info-circle-fill"></i> Hearing Info
            </button>
        @endif
    </div>
    
    @if (!empty($caseFiledTime))
        <div class="document-submission-info mb-2 mt-0" onclick="event.stopPropagation();">
            <span class="submission-timestamp">Case Filed on: {{ $caseFiledTime }}</span>
        </div>
    @endif
    
    @if ($is_case_filed != 1)
        <div class="d-flex align-items-center mb-2">
            <small class="me-3" onclick="event.stopPropagation();">Case Status:</small>
            <div class="property-tab-pills" 
                data-client-id="{{ $val['id'] }}" 
                data-current-status="{{ $is_case_filed }}" 
                data-popup-url="{{ route('attorney_client_case_filed_popup') }}">
                
                <button class="property-pill disabled {{ $is_case_filed == 0 || $is_case_filed == null ? 'active' : '' }}" 
                        onclick="handleCaseStatusPillClick(this, 0); event.stopPropagation();">
                    Case Not Filed
                </button>
                
                <button class="property-pill enabled {{ $is_case_filed == 1 ? 'active' : '' }}" 
                        onclick="handleCaseStatusPillClick(this, 1); event.stopPropagation();">
                    Filed Case
                </button>
            </div>
        </div>
    @endif
    
    @if (!empty($attorney_detailed_property_enabled) && $val['client_subscription'] != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
        <div class="d-flex align-items-center">
            <small class="me-3" onclick="event.stopPropagation();">Detailed Property Tab:</small>
            <div class="property-tab-pills" data-client-id="{{ $val['id'] }}" data-current-status="{{ $val['detailed_property'] }}">
                <button class="property-pill disabled {{ $val['detailed_property'] == 0 ? 'active' : '' }}" onclick="addDetailProperty(this, false); event.stopPropagation();">Disabled</button>
                <button class="property-pill enabled {{ $val['detailed_property'] == 1 ? 'active' : '' }}" onclick="addDetailProperty(this, true); event.stopPropagation();">Enabled</button>
            </div>
        </div>
    @endif
</div>