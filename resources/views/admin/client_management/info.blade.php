<div class="info-section">

    <div class="d-flex align-items-center">
        <span class="client-id-badge cursor-default" title="View Client Details" onclick="redirectToURL('<?php echo route('attorney_form_submission_view', ['id' => $client_id]); ?>'); event.stopPropagation();">#<?php echo $client_id ?></span>

        <div class="doc-recieved-div-<?php echo $client_id; ?>"  onclick="event.stopPropagation();">
            <?php if (isset($newDocUploaded[$client_id]) && $newDocUploaded[$client_id] > 0) { ?>
                <span class="client-new-doc-badge blink">New Document(s) Received</span>
            <?php } ?>
        </div>

        <?php if ($type == '2') { ?>
                <span class="client-new-doc-badge activate-btn-<?php echo $val['id'] ?> <?php echo $activate; ?>" onclick="event.stopPropagation();">New</span>
        <?php } else { ?>
                <span class="status-badge status-premium activate-btn-<?php echo $val['id'] ?> <?php echo $activate; ?>" style="margin-bottom: 10px; margin-left: 0.5rem; font-weight:600;" onclick="event.stopPropagation();">In Progress</span>
        <?php } ?>
        
        <span class="client-id-badge done-btn-<?php echo $val['id'] ?> <?php echo $doneClass; ?>"  style="margin-bottom: 10px; margin-left: 0.5rem; font-weight:600; background: var(--success-color);" onclick="event.stopPropagation();">Done</span>
    </div>

    <!-- Name -->
    <x-admin.client_management.infoText
        :clientId="$client_id"
        :dataLabel="$client_name"
        dataFor="name" />

    <!-- Email -->
    <x-admin.client_management.infoText
        :clientId="$client_id"
        :dataLabel="$email"
        dataFor="email" />

    <!-- Phone no -->
    <?php if (!empty($val['phone_no'])) { ?>
        <x-admin.client_management.infoText
            :clientId="$client_id"
            :dataLabel="$client_phone"
            dataFor="phone" />
    <?php } ?>

    <!-- Started & Last Login dates-->
    <div class="client-dates">
        <span onclick="event.stopPropagation();" class="mb-1"><i class="fas fa-calendar-plus mr-1"></i> Started: {{$formated_DATETIME}}</span>
        <?php if (!empty($formated_last_login)) { ?>
            <div class="">
                <span onclick="event.stopPropagation();" class="text-success mb-1"><i class="fas fa-clock mr-1"></i> Last Login: {{$formated_last_login}}</span>
            </div>
        <?php } ?>
    </div>

    <!-- Document Submission Info -->
    <?php if (!empty($val['case_submitted_to_attorney_on'])) { ?>
        <div class="document-submission-info" >
            <span class="submission-timestamp" onclick="event.stopPropagation();">Submitted to Attorney on: {{ DateTimeHelper::dbDateToDisplay($val['case_submitted_to_attorney_on'], true) }}</span>
        </div>
    <?php } ?>
    <div class="submitted-on-div-{{ $client_id }}" onclick="event.stopPropagation();">
    </div>
</div>

