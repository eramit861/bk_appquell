@push('tab_scripts')
    <script>
        window.__commonLandingData = {
            shouldShowPasswordPopup: {{ Auth::user()->recommned_password_update == 1 ? 'true' : 'false' }}
        };
        window.__commonLandingRoutes = {
            changePasswordPopup: "{{ route('change_password_popup') }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/commonlanding.js') }}"></script>
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/commonlanding.css') }}">
@endpush