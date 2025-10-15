<div class="row-cols-custom light-gray-div border-0 p-0 <?php echo (!empty($client) && count($client) > 0) ? '' : 'mb-0'; ?>" id="clientContainer">
    <?php if (!empty($client) && count($client) > 0) { ?>
        <?php
        $notAvailiable = 'Not Included';
        foreach ($client as $val) {
            $clientsSettings = $val->clientsSettings;
            $is_case_filed = '';
            $caseFiledTime = '';
            if (isset($clientsSettings->is_case_filed)) {
                $case_filed_timestamp = $clientsSettings->case_filed_timestamp ?? '';
                $is_case_filed = Helper::validate_key_value('is_case_filed', $clientsSettings, 'radio');
                if (!empty($case_filed_timestamp) && $is_case_filed == 1) {
                    $caseFiledReminder = DateTime::createFromFormat('Y-m-d H:i:s', $case_filed_timestamp);
                    if ($caseFiledReminder !== false) {
                        $caseFiledTime = $caseFiledReminder->format('l jS \of F Y');
                    }
                }
            }

            $documentProgress = $documentCompleteness[$val['id']] ?? [];

            $notIn = ['document_sign', 'signed_document'];
            $unreadDocument = \App\Models\ClientDocumentUploaded::where(['client_id' => $val['id'], 'is_viewed_by_attorney' => 0])->whereNotIn('document_type', $notIn)->count();
            $seen_by_admin = $val['seen_by_admin'];
            $activate = '';
            $inprogress = 'hide-data';
            $doneClass = 'hide-data';
            if (isset($val['concierge_service_status']) && $val['concierge_service_status'] == 0) {
                $activate = '';
                $doneClass = 'hide-data';
            }
            if (isset($val['concierge_service_status']) && $val['concierge_service_status'] == 1) {
                $activate = 'hide-data';
                $doneClass = '';
            }
            if (isset($val['concierge_service_status']) && $val['concierge_service_status'] == 1) {
                $activate = 'hide-data';
                $doneClass = '';
                $inprogress = '';
            }

            $date = date_create($val['created_at']);
            $formated_DATETIME = date_format($date, 'M dS, Y');
            $formated_last_login = !empty($val['last_login_at']) ? DateTimeHelper::dbDateToDisplay($val['last_login_at'], true) : '';

            $client_id = $val['id'];
            $client_name = $val['name'];
            $client_phone = $val['phone_no'];
            $client_type = $val['client_type'];
            $client_type_label = ArrayHelper::getClientTypeLabelArray($client_type);

            $client_subscription_id = $val['client_subscription'];
            $email = Helper::validate_key_value('email', $val);

            ?>
            <input type="hidden" id="retainer_agreement_box<?php echo $val['id'] ?>" value="<?php echo $val['retainer_agreement_box'] ?>">
            <div class="client-card  client-<?php echo $val['id']; ?>" onclick="redirectToURL('<?php echo route('attorney_form_submission_view', ['id' => $val['id']]); ?>')">
                <div class="client-card-body p-3">
                    <?php if ($val['concierge_service'] == 1 && $val['concierge_service_status'] == 0) { ?>
                        <img class="pending_client" src="{{ asset('assets/img/cs-person.png') }}" alt="" />
                    <?php } ?>
                    <?php if ($val['concierge_service'] == 1 && $val['concierge_service_status'] == 1) { ?>
                        <img class="done_client" src="{{ asset('assets/img/cs-person.png') }}" alt="" />
                    <?php } ?>
                    <div class="row details-collapsible-body">
                        <div class="col-md-3">
                            @include('admin.client_management.info')
                        </div>
                        <div class="col-md-3">
                            @include('admin.client_management.subscription')
                        </div>
                        <div class="col-md-3">
                            <div class="progress-td progress-td-{{ $val['id'] }}"></div>
                            <div class="clandely_msg clandely_msg-{{ $val['id'] }}" onclick="event.stopPropagation();"></div>
                        </div>
                        <div class="col-md-3">
                            @include('admin.client_management.status')
                        </div>
                        <div class="col-md-12">
                            @include('admin.client_management.action')
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        } else { ?>
        <div class="client-card mb-0">
            <div class="client-card-body p-3">
                <p class="mb-0 text-center">
                    No Record Found.
                </p>
            </div>
        </div>
    <?php } ?>
</div>