<div class="info-section mb-0">
    <div class="action-buttons mt-1">

        <div class="">
            <button class="btn btn-outline-custom btn-custom" onclick="openDocumentsPopup(<?php echo $val['id']; ?>); event.stopPropagation();">
                <i class="bi bi-file-earmark-arrow-up-fill"></i> Send Doc(s) Request
            </button>
        </div>

        <div class="">
            <button class="btn btn-primary-custom btn-custom" onclick="openNotesPopup(<?php echo $val['id']; ?>); event.stopPropagation();">
                <i class="bi bi-chat-quote-fill"></i> Notes
            </button>
        </div>

        <div class="">
            <button class="btn btn-warning-custom btn-custom activate-btn-<?php echo $val['id'] ?> <?php echo $activate; ?>" onclick="conciergeServiceStatus(<?php echo $val['id']; ?>, <?php echo $val->ClientsAttorneybyclient->getuserattorney->id ?? ''; ?>, '<?php echo route('admin_activate_concierge_service'); ?>'); event.stopPropagation();">
                <i class="bi bi-check-circle-fill"></i> Mark as done
            </button>
        </div>

        <div class="">
            <button class="btn btn-warning-custom btn-custom <?php echo $val['id'] ?> <?php echo $inprogress; ?>" onclick="conciergeServiceInprogress(<?php echo $val['id']; ?>, <?php echo $val->ClientsAttorneybyclient->getuserattorney->id ?? ''; ?>, '<?php echo route('mark_inprogress'); ?>'); event.stopPropagation();">
                <i class="bi bi-arrow-clockwise"></i> Mark In Progress
            </button>
        </div>

        <div class="">
            <button class="btn <?php echo ($val['disable_concierge_mail'] == 1) ? 'btn-success-custom' : 'btn-danger-custom'; ?>  btn-custom" onclick="toggleConciergeNotification(<?php echo $client_id; ?>, <?php echo $val->ClientsAttorneybyclient->getuserattorney->id ?? ''; ?>, '<?php echo $val['name']; ?>', '<?php echo $val['disable_concierge_mail']; ?>'); event.stopPropagation();">
                <?php if ($val['disable_concierge_mail'] == 1) { ?>
                    <i class="bi bi-check-circle-fill"></i> Start Email & Message
                <?php } else { ?>
                    <i class="bi bi-x-square-fill"></i> Stop Email & Message
                <?php } ?>
            </button>
        </div>
        <div class="">
            <?php if ($type == '0' || $type == '4') { ?>
                <button class="btn btn-warning-custom btn-custom" onclick="toggleToQueue(<?php echo $client_id; ?>, <?php echo $val->ClientsAttorneybyclient->getuserattorney->id ?? ''; ?>, '<?php echo $val['name']; ?>', '<?php echo $val['in_queue']; ?>'); event.stopPropagation();">
                    <?php if ($val['in_queue'] == 1) { ?>
                        <i class="bi bi-x-square-fill"></i> Remove from Queue
                    <?php } else { ?>
                        <i class="bi <?php echo $type == '0' ? 'bi-plus-square-fill' : 'bi-x-square-fill'; ?>"></i> <?php echo $type == '0' ? 'Move to Queue' : 'Remove from Queue'; ?>
                    <?php } ?>
                </button>
            <?php } ?>
        </div>

        <?php
        $msg = "Click here to activate";
            if ($val['user_status'] == 1) {
                $msg = "Click here to de-activate";
            }
            if ($val['user_status'] == 0) { ?>
            <div class="">
                <button class="btn btn-outline-custom btn-custom" title="<?php echo $msg; ?>" onclick="clientChangeStatus(<?php echo $val['id']; ?>, <?php echo $val['user_status']; ?>,'<?php echo route('admin_client_status'); ?>', true); event.stopPropagation();">
                    <i class="bi bi-check-circle-fill"></i> Activate
                </button>
            </div>
        <?php }
            if ($val['user_status'] == 1) { ?>
            <div class="">
                <button class="btn btn-outline-custom btn-custom" title="<?php echo $msg; ?>" onclick="clientChangeStatus(<?php echo $val['id']; ?>, <?php echo $val['user_status']; ?>,'<?php echo route('admin_client_status'); ?>', true); event.stopPropagation();">
                    <i class="bi bi-archive-fill"></i> Archive
                </button>
            </div>
        <?php } ?>

        <div class=" position-relative">
            <button class="btn btn-primary-custom btn-custom" onclick="getSimpleTextMessages('<?php echo $val['id']; ?>'); event.stopPropagation();">
                <i class="bi bi-chat-fill"></i> Text Messages
                <?php if (isset($seen_by_admin) && $seen_by_admin == '0') { ?>
                    <span class="message-unread-indicator message-indicator-<?php echo $val['id']; ?>"></span>
                <?php } ?>
            </button>
        </div>

        <a class="btn btn-success-custom btn-custom login-to-client" href="<?php echo route("admin_client_login", ['id' => $val["id"]]); ?>" onclick="event.stopPropagation();" title="Login into your client dashboard"><i class="bi bi-box-arrow-in-right"></i> Login as Client</a>
    </div>
</div>