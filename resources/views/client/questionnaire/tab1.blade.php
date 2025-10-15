<!-- Tab 1 - Basic Information (Optimized) -->


@php
use App\Services\Client\Tab1DataService;

// Move PHP logic to service, but keep all variables exactly as they were
$tab1Service = app(Tab1DataService::class);
$tab1Data = $tab1Service->processTab1Logic([
    'step1' => $step1 ?? false,
    'step2' => $step2 ?? false,
    'client_type' => $authUser->client_type ?? null,
    'client_id' => $authUser->id ?? null,
    'debtorname' => $debtorname ?? "Debtor's",
    'spousename' => $spousename ?? "Co-Debtor's",
    'BasicInfoPartA' => $BasicInfoPartA ?? [],
    'BasicInfoPartB' => $BasicInfoPartB ?? [],
    'BasicInfo_AnyOtherName' => $BasicInfo_AnyOtherName ?? [],
    'BasicInfo_PartRest' => $BasicInfo_PartRest ?? [],
    'BasicInfo_PartRestD' => $BasicInfo_PartRestD ?? [],
    'phone_no' => $phone_no ?? '',
    'email' => $email ?? '',
    'progress' => $progress ?? [],
]);

// Extract all variables to maintain compatibility with child includes
$title = $tab1Data['title'];
$debtorAddressConfirmed = $tab1Data['debtorAddressConfirmed'];
$codebtorAddressConfirmed = $tab1Data['codebtorAddressConfirmed'];
$any_other_name_phone_no = $tab1Data['any_other_name_phone_no'];
$any_other_name_email = $tab1Data['any_other_name_email'];
$usa_states = $tab1Data['usa_states'];
$suffixArray = $tab1Data['suffixArray'];
$tab1_percentage_by_steps = $tab1Data['tab1_percentage_by_steps'];
$step1TabData = $tab1Data['step1TabData'];
$step1PercentDone = $tab1Data['step1PercentDone'];
$step1PercentTotal = $tab1Data['step1PercentTotal'];
$step1TabClass = $tab1Data['step1TabClass'];
$step2TabData = $tab1Data['step2TabData'];
$step2PercentDone = $tab1Data['step2PercentDone'];
$step2PercentTotal = $tab1Data['step2PercentTotal'];
$step2TabClass = $tab1Data['step2TabClass'];
$step3TabData = $tab1Data['step3TabData'];
$step3PercentDone = $tab1Data['step3PercentDone'];
$step3PercentTotal = $tab1Data['step3PercentTotal'];
$step3TabClass = $tab1Data['step3TabClass'];
$debtorTabName = $tab1Data['debtorTabName'];
$codebtorTabName = $tab1Data['codebtorTabName'];
$BasicInfo_PartRest = $tab1Data['BasicInfo_PartRest'];
$BasicInfo_PartRestD = $tab1Data['BasicInfo_PartRestD'];
@endphp

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/tab1.css') }}">
@endpush
<!-- Tab Navigation Component -->
<x-client.tab-navigation
    :tabData="[
        'step1' => [
            'percentDone' => $step1PercentDone,
            'percentTotal' => $step1PercentTotal,
            'tabClass' => $step1TabClass,
            'routeName' => 'client_dashboard',
            'icon' => '👨',
            'label' => $debtorTabName . ' Info',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step2' => [
            'percentDone' => $step2PercentDone,
            'percentTotal' => $step2PercentTotal,
            'tabClass' => $step2TabClass,
            'routeName' => 'client_basic_info_step1',
            'icon' => '👩',
            'label' => $codebtorTabName . ' Info',
            'tabId' => 'clients-assigned-to-me-tab',
            'targetId' => 'clients-assigned-to-me',
            'condition' => $authUser && $authUser->client_type == 3
        ],
        'step3' => [
            'percentDone' => $step3PercentDone,
            'percentTotal' => $step3PercentTotal,
            'tabClass' => $step3TabClass,
            'routeName' => 'client_basic_info_step2',
            'icon' => '💼',
            'label' => 'BK Cases/Businesses',
            'tabId' => 'clients-assigned-to-me-tab',
            'targetId' => 'clients-assigned-to-me'
        ]
    ]"
    :debtorTabName="$debtorTabName"
    :codebtorTabName="$codebtorTabName"
    :authUser="$authUser"
/>

<div class="card-body border-top-left-radius-none">
    <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
        <div class="tab-pane fade {{ (!empty($tab) && $tab == 'tab1') ? 'active show' : '' }}" id="section1" role="tabpanel" aria-labelledby="section1-tab" tabindex="0">
            <div class="table-responsive">
                <!-- Basic Info Steps -->
                @includeWhen($step1, 'client.questionnaire.basic.steps.step1')
                @includeWhen($step2, 'client.questionnaire.basic.steps.step2')
                @includeWhen($step3, 'client.questionnaire.basic.steps.step3')

                <!-- Step 4: Traded Stocks Section -->
                <x-client.steps.step4-traded-stocks
                    :step4="$step4"
                    :tradedStocks="$traded_stocks"
                    :webView="$web_view ?? false"
                    :basicInfoPartRest="$BasicInfo_PartRest ?? []"
                    :attorneyEdit="$attorney_edit ?? ''"
                />

                <!-- Step 5/6: Proprietor and Hazardous Property Section -->
                <x-client.steps.step5-6-proprietor-hazardous
                    :step5="$step5"
                    :step6="$step6"
                    :basicInfoPartRest="$BasicInfo_PartRest ?? []"
                    :basicInfoPartRestD="$BasicInfo_PartRestD ?? []"
                    :usaStates="$usa_states"
                    :attorneyEdit="$attorney_edit ?? ''"
                />


            </div>
        </div>
    </div>
</div>


@push('tab_scripts')
    <script>
        window.__tab1 = {
            debtorCounty: "{{ Helper::validate_key_value('country', $BasicInfoPartA) }}",
            debtor2County: "{{ Helper::validate_key_value('country', $BasicInfoPartB) }}",
        };
        window.__tab1Routes = {
            countyByStateName: "{{ route('county_by_state_name') }}"
        };
        window.__tab1Data = {
            basicInfoPartRest: {{ isset($BasicInfo_PartRest) && !empty($BasicInfo_PartRest) ? 'true' : 'false' }},
            basicInfoPartRestD: {{ isset($BasicInfo_PartRestD) && !empty($BasicInfo_PartRestD) ? 'true' : 'false' }}
        };
    </script>
    <script src="{{ asset('assets/js/tab1.js') }}?v=1.00"></script>
@endpush

{{-- Styles moved to resources/css/client/tab1.css --}}
<!-- Tab 1 End-->