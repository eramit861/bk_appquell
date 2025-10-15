<!-- Tab 7 - SPOUSE EXPENSES -->
@php
    $readOnly = $detailed_property == 1 ? 'readonly' : '';
    $i = 0;
    $tab5_percentage_by_steps = Helper::validate_key_value('tab5_percentage_by_steps', $progress);
@endphp

<ul class="nav nav-pills nav-fill w-100 p-0 with-progress" id="pills-tab" role="tablist">
    @php
        $step1TabData = Helper::validate_key_value('step1', $tab5_percentage_by_steps);
        $step1PercentDone = Helper::validate_key_value('percentDone', $step1TabData, 'radio');
        $step1PercentTotal = Helper::validate_key_value('percentTotal', $step1TabData, 'radio');
        $step1TabClass = Helper::validate_key_value('tabClass', $step1TabData);
    @endphp

    <li class="nav-item nav-item-ui-new {{ request()->routeIs('client_expenses') ? 'mobile-mr-0' : 'hide-tab' }} {{ $step1TabClass }}"
        role="presentation">
        <button class="nav-link tab-ui-new {{ request()->routeIs('client_expenses') ? 'active' : '' }}"
            onclick="redirectToURL('{{ route('client_expenses') }}')" id="all-firm-client-tab" data-bs-toggle="pill"
            data-bs-target="#all-firm-client" type="button" role="tab" aria-controls="all-firm-client"
            aria-selected="true">
            <span>&#x1F3E0;</span>
            <span>Current Household Expenses</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $step1PercentDone }}"
                aria-valuemin="0" aria-valuemax="{{ $step1PercentTotal }}">
                <div class="progress-bar" style="width:{{ $step1PercentDone ?? 0 }}%">
                    <div class="progress_text_{{ $step1PercentDone ?? 0 }}">{{ $step1PercentDone ?? 0 }}%</div>
                </div>
            </div>
        </button>
    </li>
    @php
        $step2TabData = Helper::validate_key_value('step2', $tab5_percentage_by_steps);
        $step2PercentDone = Helper::validate_key_value('percentDone', $step2TabData, 'radio');
        $step2PercentTotal = Helper::validate_key_value('percentTotal', $step2TabData, 'radio');
        $step2TabClass = Helper::validate_key_value('tabClass', $step2TabData);
    @endphp

    <li class="nav-item nav-item-ui-new {{ request()->routeIs('client_spouse_expenses') ? 'mobile-mr-0' : 'hide-tab' }} {{ $step2TabClass }}"
        role="presentation">
        <button class="nav-link tab-ui-new {{ request()->routeIs('client_spouse_expenses') ? 'active' : '' }}"
            onclick="redirectToURL('{{ route('client_spouse_expenses') }}')" id="all-firm-client-tab"
            data-bs-toggle="pill" data-bs-target="#all-firm-client" type="button" role="tab"
            aria-controls="all-firm-client" aria-selected="true">
            <span>&#x1F3D8;&#xFE0F;</span>
            <span>{{ $authUser->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED ? "Non-Filing Spouse's Expenses Separate Household" : 'Spousal Expenses Separate Household' }}</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $step2PercentDone }}"
                aria-valuemin="0" aria-valuemax="{{ $step2PercentTotal }}">
                <div class="progress-bar" style="width:{{ $step2PercentDone ?? 0 }}%">
                    <div class="progress_text_{{ $step2PercentDone ?? 0 }}">{{ $step2PercentDone ?? 0 }}%</div>
                </div>
            </div>
        </button>
    </li>
</ul>
<div class="card-body border-top-left-radius-none">
    <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
            <!-- Current Household Expenses -->
            @include('client.questionnaire.expense.steps.step2')
        </div>
    </div>
</div>
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/tab5.css') }}">
@endpush
@push('tab_scripts')
    <script>
        window.__tab5Data = {
            clientType: "{{ $client_type }}",
            averagePriceList: {!! json_encode($averagePriceList) !!}
        };
    </script>
    <script src="{{ asset('assets/js/tab5.js') }}"></script>
@endpush

@push('utility_scripts')
<script>
    window.__utilityPopupData = {
        type: "2",
        defaultImageUrl: "{{ asset('assets/img/streaming/28.png') }}",
        previousData: $('.utility_text_field_d2').val()
    };
</script>
<script src="{{ asset('assets/js/client/utility_popup.js') }}"></script>
@endpush
<!-- Tab 7 End-->
