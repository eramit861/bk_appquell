<div class="info-section">

    <div class="d-flex align-items-center">
        <span class="client-id-badge cursor-default" title="View Client Details" onclick="redirectToURL('{{ route('attorney_form_submission_view', ['id' => $val['id']]) }}'); event.stopPropagation();">#{{ $val['id'] }}</span>

        @if (empty($type) && ($val['user_status'] == Helper::ACTIVE && $val['logged_in_ever'] == Helper::YES))
            <span class="ms-2 text-bold status-badge status-green" style="margin-bottom:0.625rem;" onclick="event.stopPropagation();">Active</span>
        @elseif (empty($type) && $val['logged_in_ever'] == Helper::NO)
            <span class="ms-2 text-bold status-badge status-blue" style="margin-bottom:0.625rem;" onclick="event.stopPropagation();">Invited</span>
        @elseif (empty($type) && $val['user_status'] == Helper::INACTIVE)
            <span class="ms-2 text-bold status-badge status-red" style="margin-bottom:0.625rem;" onclick="event.stopPropagation();">Archived</span>
        @elseif (empty($type) && $val['user_status'] == Helper::REMOVED)
            <span class="ms-2 text-bold status-badge status-red" style="margin-bottom:0.625rem;" onclick="event.stopPropagation();">Deleted</span>
        @endif

        <div class="doc-recieved-div-{{ $val['id'] }}" onclick="event.stopPropagation();">
            @if (isset($newDocUploaded[$val['id']]) && $newDocUploaded[$val['id']] > 0)
                <span class="client-new-doc-badge blink">New Document(s) Received</span>
            @endif
        </div>
    </div>

    <!-- Name -->
    <x-attorney.client_management.infoText
        :clientId="$client_id"
        :dataLabel="$client_name"
        dataFor="name" />

    <!-- Email -->
    <x-attorney.client_management.infoText
        :clientId="$client_id"
        :dataLabel="$email"
        dataFor="email" />

    <!-- Phone no -->
    @if (!empty($val['phone_no']))
        <x-attorney.client_management.infoText
            :clientId="$client_id"
            :dataLabel="$client_phone"
            dataFor="phone" />
    @endif

    <!-- Started & Last Login dates-->
    <div class="client-dates">
        <span class="mb-1" onclick="event.stopPropagation();"> <i class="fas fa-calendar-plus me-1"></i> Started: {{ $formated_DATETIME }} </span>
        @if (!empty($formated_last_login))
            <div>
                <span class="text-success mb-1" onclick="event.stopPropagation();"> <i class="fas fa-clock me-1"></i> Last Login: {{ $formated_last_login }} </span>
            </div>
        @endif
    </div>

    <!-- Document Submission Info -->
    @if (!empty($val['case_submitted_to_attorney_on']))
        <div class="document-submission-info" onclick="event.stopPropagation();">
            <span class="submission-timestamp">Submitted to Attorney on: {{ DateTimeHelper::dbDateToDisplay($val['case_submitted_to_attorney_on'], true) }}</span>
        </div>
    @endif
    <div class="submitted-on-div-{{ $val['id'] }}" onclick="event.stopPropagation();">
        @if (isset($client_percent[$val['id']]['submitted_to_att_at']) && !empty($client_percent[$val['id']]['submitted_to_att_at']))
            <div class="document-submission-info">
                <span class="submission-timestamp">Submitted By Client on: {{ DateTimeHelper::dbDateToDisplay($client_percent[$val['id']]['submitted_to_att_at'], true) }}</span>
            </div>
        @endif
    </div>

    @if ($type == 'removed' && !empty($val['date_marked_delete']))
        <div class="submitted-on-div-{{ $val['id'] }}" onclick="event.stopPropagation();">
            <div class="document-submission-info-for-removed">
                @php
                    $markedDate = \Carbon\Carbon::parse($val['date_marked_delete']);
                    $deleteAfter = $markedDate->copy()->addDays(60);
                    $daysLeft = now()->diffInDays($deleteAfter, false); // false => can be negative if past
                @endphp
                @if ($daysLeft > 0)
                    <span class="removed-timestamp">
                        <span class="text-bold">{{ $daysLeft }}</span> days left until permanent deletion (on {{ $deleteAfter->format('M d, Y') }})
                    </span>
                @else
                    <span class="removed-timestamp">
                        Eligible for permanent deletion since {{ $deleteAfter->format('M d, Y') }}
                    </span>
                @endif
            </div>
        </div>
 @endif

    @if (isset($clientsSettings) && $clientsSettings->auto_mail_unsubscribed == 1)
        <div class="submitted-on-div-{{ $val['id'] }}" onclick="event.stopPropagation();">
            <div class="document-submission-info-for-removed">
                <span class="removed-timestamp">Client unsubscribed to automated emails</span>
            </div>
        </div>
    @endif
    
</div>