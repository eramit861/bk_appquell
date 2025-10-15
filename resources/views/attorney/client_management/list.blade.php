<div class="row-cols-custom light-gray-div border-0 p-0 {{ (!empty($client) && count($client) > 0) ? '' : 'mb-0' }}" id="clientContainer">
    @if (!empty($client) && count($client) > 0)
        @foreach ($client as $val)
            @php
                // Client data extraction
                $clendlyData = $client_clendly[$val['id']] ?? [];
                $documentProgress = $documentCompleteness[$val['id']] ?? [];

                $displayEvent = false;
                if (isset($clendlyData['scheduled_event_end_time']) && !empty($clendlyData['scheduled_event_end_time']) && $clendlyData['scheduled_event_end_time'] > date("Y-m-d\TH:i:s\Z", strtotime('now'))) {
                    $displayEvent = true;
                }
                
                $notIn = ['document_sign', 'signed_document'];
                $unreadDocument = \App\Models\ClientDocumentUploaded::where(['client_id' => $val['id'], 'is_viewed_by_attorney' => 0])->whereNotIn('document_type', $notIn)->count();
                
                $rowClass = '';
                if (($val['concierge_service'] == 1 && $val['concierge_service_status'] == 1) || ($val['concierge_service'] == 0 && !empty($client_percent[$val['id']]['submitted_to_att_at']))) {
                    $rowClass = 'statuc_concierge_service_done';
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

                $simpleTextWebhookMessages = $val->simpleTextWebhookMessages;
                $clientsParalegal = $val->clientsParalegal;
                $clientsAssociate = $val->clientsAssociate;
                $formsStepsCompleted = $val->formsStepsCompleted;
                $clientsAppointmentReminder = $val->clientsAppointmentReminder;
                $clientsSettings = $val->clientsSettings;

                $seen_by_attorney = $simpleTextWebhookMessages ? $simpleTextWebhookMessages->seen_by_attorney : '';
                $paralegalId = $clientsParalegal ? $clientsParalegal->paralegal_id : '';
                $associateId = $clientsAssociate ? $clientsAssociate->associate_id : '';
                $request_edit_access = $formsStepsCompleted ? $formsStepsCompleted->request_edit_access : 0;

                $reminderSentClass = '';
                $reminderTime = '';
                $reminderLocation = '';
                if (isset($clientsAppointmentReminder->last_send) && !empty($clientsAppointmentReminder->last_send)) {
                    $reminderSentClass = 'bg-reminder-sent';
                    $reminder_time = $clientsAppointmentReminder->reminder_time ?? '';
                    if (!empty($reminder_time)) {
                        $dateReminder = DateTime::createFromFormat('m/d/Y h:i A', $reminder_time);
                        if ($dateReminder !== false) {
                            $reminderTime = $dateReminder->format('l jS \of F Y h:i A');
                        }
                    }
                    $reminderLocation = $clientsAppointmentReminder->reminder_location ?? '';
                }
                
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
                
                // Labels and options
                $paralegalLabel = ArrayHelper::getParalegalLlabel($paralegalId);
                $associateLabel = 'Choose Law Firm';
                $associateOptions = '<option value="">Choose Law Firm</option>';
                
                if (!empty($associates)) {
                    foreach ($associates as $key => $associate) {
                        if ($associateId == $associate['id']) {
                            $associateLabel = $associate['firstName'] . ' ' . $associate['lastName'];
                        }
                        $associateOptions .= '<option value="' . $associate['id'] . '" ' . 
                            ($associateId == $associate['id'] ? 'selected' : '') . '>' . 
                            $associate['firstName'] . ' ' . $associate['lastName'] . '</option>';
                    }
                }
            @endphp
            <input type="hidden" id="retainer_agreement_box{{ $val['id'] }}" value="{{ $val['retainer_agreement_box'] }}">
            <div class="client-card client-{{ $val['id'] }} {{ $reminderSentClass }}" onclick="redirectToURL('{{ route('attorney_form_submission_view', ['id' => $val['id']]) }}')">
                <div class="client-card-body p-3">
                    @if ($val['concierge_service'] == 1 && $val['concierge_service_status'] == 0)
                        <img class="pending_client" src="{{ asset('assets/img/cs-person.png') }}" alt="" />
                    @endif
                    @if ($val['concierge_service'] == 1 && $val['concierge_service_status'] == 1)
                        <img class="done_client" src="{{ asset('assets/img/cs-person.png') }}" alt="" />
                    @endif
                    <div class="row details-collapsible-body">
                        <div class="col-md-3">
                            @include('attorney.client_management.info')
                        </div>
                        <div class="col-md-3">
                            @include('attorney.client_management.subscription')
                        </div>
                        <div class="col-md-3">
                            <div class="progress-td progress-td-{{ $val['id'] }}">
                                @include('attorney.client_management.progress')
                            </div>
                            @include('attorney.client_management.appointment')
                        </div>
                        <div class="col-md-3">
                            @include('attorney.client_management.status')
                        </div>
                        <div class="col-md-12">
                            @include('attorney.client_management.action')
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="client-card mb-0">
            <div class="client-card-body p-3">
                <p class="mb-0 text-center">
                    No Record Found.
                </p>
            </div>
        </div>
    @endif
</div>