<div class="info-section">
    <div class="info-section-title">
        <span onclick="event.stopPropagation();">Status</span>
        <?php if ($is_case_filed == 1) { ?>
            <button class="btn btn-outline-custom btn-custom mt-1 ms-2" title="Preview Hearing Info" onclick="clientCaseFiledInfoPreviewPopup(<?php echo $val['id']; ?>, '<?php echo route('admin_client_case_filed_preview_popup'); ?>', '<?php echo $type; ?>'); event.stopPropagation();">
                <i class="bi bi-info-circle-fill"></i> Hearing Info
            </button>
        <?php } ?>
    </div>
    <?php if (!empty($caseFiledTime)) { ?>
        <div class="document-submission-info mb-2 mt-0" onclick="event.stopPropagation();">
            <span class="submission-timestamp">Case Filed on: {{ $caseFiledTime }}</span>
        </div>
    <?php } ?>
    <?php if ($is_case_filed == 1) { ?>
    <?php } else { ?>
        <div class="d-flex align-items-center mb-2">
            <small class="mr-3" onclick="event.stopPropagation();">Case Status:</small>
            <div class="property-tab-pills"
                data-client-id="<?php echo $val['id']; ?>"
                data-current-status="<?php echo $is_case_filed; ?>"
                data-popup-url="<?php echo route('admin_client_case_filed_popup'); ?>" onclick="event.stopPropagation();">

                <button class="property-pill disabled <?php echo $is_case_filed == 0 || $is_case_filed == null ? 'active' : ''; ?>"
                    onclick="handleCaseStatusPillClick(this, 0);">
                    Case Not Filed
                </button>

                <button class="property-pill enabled <?php echo $is_case_filed == 1 ? 'active' : ''; ?>"
                    onclick="handleCaseStatusPillClick(this, 1);">
                    Filed Case
                </button>
            </div>
        </div>
    <?php } ?>    
</div>