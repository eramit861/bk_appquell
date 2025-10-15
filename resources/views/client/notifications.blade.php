<div class="dropwrap">
    <div class="head">Notificat222ions</div>
    <div style="max-height: 280px; overflow-y: auto;">
        <ul class="columlist">
            @if ($notifications->total() > 0)
                @foreach ($notifications as $item)
                    <li
                        class="row-{{ $item['id'] }} {{ isset($item['unotification_is_read']) && $item['unotification_is_read'] == 0 ? 'unread-notification' : '' }}">
                        <a href="javascript:void(0)" onclick="markNotificationRead('{{ $item['id'] }}')">
                            <span class="grid">
                                <span
                                    class="row-bold-{{ $item['id'] }} desc {{ isset($item['unotification_is_read']) && $item['unotification_is_read'] == 0 ? 'font-weight-bold' : '' }}">
                                    {!! str_replace('_', ' ', $item['unotification_body']) !!}
                                </span>
                                <span class="notification-date">{{ $item['unotification_date'] }}</span>
                            </span>
                        </a>
                    </li>
                @endforeach
            @else
                <span class="grid">
                    <span>
                        Oops, You don't have any noticiation to read.
                    </span>
                </span>
            @endif
        </ul>
    </div>
</div>

@push('tab_scripts')
    <script>
        window.__notificationsRoutes = {
            readUserNotifications: "{{ route('read_user_notifications') }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/notifications.js') }}"></script>
@endpush
