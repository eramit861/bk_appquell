<div class="info-section mb-0">
    <div class="action-buttons mt-1">
        <div class="">
            <button class="btn btn-outline-custom btn-custom" onclick="openDocumentsListPopup({{ $val['id'] }}); event.stopPropagation();">
                <i class="bi bi-file-earmark-arrow-up-fill"></i> Send Doc(s) Request
            </button>
        </div>

        @if (isset($request_edit_access) && $request_edit_access == 1)
            <div class="">
                <button class="btn btn-danger-custom btn-custom blink" title="Client Edit Request" onclick="openEditRequestPopup({{ $val['id'] }}); event.stopPropagation();">
                    <i class="bi-card-text"></i> Client Edit Request
                </button>
            </div>
        @endif

        <div class="">
            <button class="btn btn-primary-custom btn-custom" title="Click to resend appointment reminder" onclick="resendAppointmentReminder({{ $val['id'] }}); event.stopPropagation();">
                <i class="bi bi-calendar-check-fill"></i> Appointment
            </button>
        </div>

        @if ($paralegalId > 0)
            <div class="">
                <button class="btn btn-success-custom btn-custom" title="Click to resend appointment reminder" onclick="sendParalegalInfoToClient({{ $val['id'] }}, {{ $paralegalId }}, '{{ route('send_paralegal_info_to_client_popup_by_attorney') }}'); event.stopPropagation();">
                    <i class="bi bi-info-circle-fill"></i> Send Paralegal Info
                </button>
            </div>
        @endif

        <div class="">
            <button class="btn btn-warning-custom btn-custom" title="Click here to resend invite" onclick="resendInvite({{ $val['id'] }},'{{ route('attorney_client_resend_invite') }}'); event.stopPropagation();">
                <i class="bi bi-send-fill"></i> Resend Invite
            </button>
        </div>

        @if ($type != "invited")
            @php
                $msg = "Click here to activate";
                if ($val['user_status'] == 1) {
                    $msg = "Click here to de-activate";
                }
            @endphp
            
            @if ($val['user_status'] == 0)
                <div class="">
                    <button class="btn btn-outline-custom btn-custom" title="{{ $msg }}" onclick="clientChangeStatus({{ $val['id'] }}, {{ $val['user_status'] }},'{{ route('attorney_client_status') }}'); event.stopPropagation();">
                        <i class="bi bi-check-circle-fill"></i> Activate
                    </button>
                </div>
            @endif
            
            @if ($val['user_status'] == 1)
                <div class="">
                    <button class="btn btn-outline-custom btn-custom" title="{{ $msg }}" onclick="clientChangeStatus({{ $val['id'] }}, {{ $val['user_status'] }},'{{ route('attorney_client_status') }}'); event.stopPropagation();">
                        <i class="bi bi-archive-fill"></i> Archive
                    </button>
                </div>
            @endif
        @endif

        @if (empty($val['date_marked_delete']) && $val['user_status'] != Helper::REMOVED)
            <div class="">
                <button class="btn btn-danger-custom btn-custom" title="Delete" data-id="{{ route('attorney_client_delete') }}" onclick='deleteClient("{{ route('attorney_client_delete') }}",{{ $val['id'] }},"{{ $val['name'] }}"); event.stopPropagation();'>
                    <i class="bi bi-trash3-fill"></i> Delete
                </button>
            </div>
        @endif

        <div class="position-relative">
            <button class="btn btn-primary-custom btn-custom" onclick="getSimpleTextMessages('{{ $val['id'] }}'); event.stopPropagation();">
                <i class="bi bi-chat-fill"></i> Text Messages
                @if (isset($seen_by_attorney) && $seen_by_attorney == '0')
                    <span class="message-unread-indicator message-indicator-{{ $val['id'] }}"></span>
                @endif
            </button>
        </div>

        <a class="btn btn-success-custom btn-custom login-to-client" href="{{ route('attorney_client_login', ['id' => $val['id']]) }}" onclick="event.stopPropagation();"><i class="bi bi-box-arrow-in-right"></i> Login as Client
        </a>
    </div>
</div>