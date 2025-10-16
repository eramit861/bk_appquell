<!-- Tab 4 -->
<!-- include("client.questionnaire.topbar") -->
<link rel="stylesheet" href="{{ asset('assets/css/client/tab4.css') }}">
@php
$documentuploaded = $docsUploadInfo['documentuploaded'] ?? null;
$attorneydocuments = $docsUploadInfo['attorneydocuments'] ?? null;
$hidebtn = $docsUploadInfo['hidebtn'] ?? null;
$client = $docsUploadInfo['client'] ?? null;
$attorney = \App\Models\ClientsAttorney::where("client_id", $authUser->id)->first();
$documentTypes = Helper::getDocuments($authUser->client_type, 0, 0, 0, 0, 0, $attorney->attorney_id);
$tab4_percentage_by_steps = !empty($progress['tab4_percentage_by_steps']) ? $progress['tab4_percentage_by_steps'] : '';
$attorney_edit = isset($attorney_edit) && $attorney_edit == true ? true : false;
@endphp

@php
    // Extract step data
    $step1TabData = !empty($tab4_percentage_by_steps['step1']) ? $tab4_percentage_by_steps['step1'] : '';
    $step1PercentDone = !empty($step1TabData['percentDone']) ? (int)$step1TabData['percentDone'] : 0;
    $step1PercentTotal = !empty($step1TabData['percentTotal']) ? (int)$step1TabData['percentTotal'] : 0;
    $step1TabClass = !empty($step1TabData['tabClass']) ? $step1TabData['tabClass'] : '';
    
    $step2TabData = !empty($tab4_percentage_by_steps['step2']) ? $tab4_percentage_by_steps['step2'] : '';
    $step2PercentDone = !empty($step2TabData['percentDone']) ? (int)$step2TabData['percentDone'] : 0;
    $step2PercentTotal = !empty($step2TabData['percentTotal']) ? (int)$step2TabData['percentTotal'] : 0;
    $step2TabClass = !empty($step2TabData['tabClass']) ? $step2TabData['tabClass'] : '';
    
    $step3TabData = !empty($tab4_percentage_by_steps['step3']) ? $tab4_percentage_by_steps['step3'] : '';
    $step3PercentDone = !empty($step3TabData['percentDone']) ? (int)$step3TabData['percentDone'] : 0;
    $step3PercentTotal = !empty($step3TabData['percentTotal']) ? (int)$step3TabData['percentTotal'] : 0;
    $step3TabClass = !empty($step3TabData['tabClass']) ? $step3TabData['tabClass'] : '';
    
    $step4TabData = !empty($tab4_percentage_by_steps['step4']) ? $tab4_percentage_by_steps['step4'] : '';
    $step4PercentDone = !empty($step4TabData['percentDone']) ? (int)$step4TabData['percentDone'] : 0;
    $step4PercentTotal = !empty($step4TabData['percentTotal']) ? (int)$step4TabData['percentTotal'] : 0;
    $step4TabClass = !empty($step4TabData['tabClass']) ? $step4TabData['tabClass'] : '';
@endphp

<!-- Tab Navigation Component -->
<x-client.tab-navigation
    :tabData="[
        'step1' => [
            'percentDone' => $step1PercentDone,
            'percentTotal' => $step1PercentTotal,
            'tabClass' => $step1TabClass,
            'routeName' => 'client_income',
            'icon' => '👨‍💼',
            'label' => $debtorTabName . ' Employer Info',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step2' => [
            'percentDone' => $step2PercentDone,
            'percentTotal' => $step2PercentTotal,
            'tabClass' => $step2TabClass,
            'routeName' => 'client_income_step2',
            'icon' => '💰',
            'label' => $debtorTabName . ' Income',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step3' => [
            'percentDone' => $step3PercentDone,
            'percentTotal' => $step3PercentTotal,
            'tabClass' => $step3TabClass,
            'routeName' => 'client_income_step1',
            'icon' => '👩‍💼',
            'label' => $spouseTabText . ' Employer Info',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client',
            'condition' => $authUser->client_type == 2 || $authUser->client_type == 3
        ],
        'step4' => [
            'percentDone' => $step4PercentDone,
            'percentTotal' => $step4PercentTotal,
            'tabClass' => $step4TabClass,
            'routeName' => 'client_income_step3',
            'icon' => '💰',
            'label' => $spouseTabText . ' Income',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client',
            'condition' => $authUser->client_type == 2 || $authUser->client_type == 3
        ]
    ]"
    :debtorTabName="$debtorname"
    :codebtorTabName="$spousename"
    :authUser="$authUser" />
<div class="card-body border-top-left-radius-none">
    <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
        <div class="tab-pane fade show active" @if(isset($web_view) && $web_view) style="padding-left:10px;" @endif id="section4" role="tabpanel" aria-labelledby="section4-tab" tabindex="0">
            <!-- Current Income Part A -->
            
            @if($step1)
                <div id="current-income-part-a" class="{{ !$step1 ? 'hidestep' : '' }} light-gray-border-div">
                    @include("client.questionnaire.income.steps.debtor_employer",$incomedebtoremployer)
                </div>
            @endif
            <!-- Current Income Part B -->
            @if($step2)
                <div id="current-income-part-b" class="{{ !$step2 ? 'hidestep' : '' }} light-gray-border-div">
                    @include("client.questionnaire.income.steps.debtor_spouse_employer",$debtorspouseemployer)
                </div>
            @endif
            <!-- Current Income Part C -->
            @if($step3)
                <div id="current-income-part-c" class="{{ !$step3 ? 'hidestep' : '' }} light-gray-border-div">
                    @include("client.questionnaire.income.steps.debtor_monthly_income",['debtormonthlyincome' => $debtormonthlyincome, 'plIsImportedDebtor' => $plIsImportedDebtor, 'plIsImportedCodebtor' => $plIsImportedCodebtor])
                </div>
            @endif
            <!-- Current Income Part D -->
            @if($step4)
                <div id="current-income-part-d" class="{{ !$step4 ? 'hidestep' : '' }} light-gray-border-div">
                    @include("client.questionnaire.income.steps.debtor_spouse_monthly_income",['debtorspousemonthlyincome' => $debtorspousemonthlyincome])
                </div>
            @endif

            <div class="hide-data no-profit-loss-popup">
                <div class="d-flex">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-exclamation-triangle fs-24px text-danger blink mb-0" aria-hidden="true"></i>
                    </div>
                    <div class="d-flex align-items-center w-100">
                        <p class="text-danger text-center w-100 mb-0">
                            It looks like you missed the Profit/Loss section.</br>
                            Please fill it out before moving on
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-exclamation-triangle fs-24px text-danger blink mb-0" aria-hidden="true"></i>
                    </div>
                </div>

            </div>

            <div id="appendhere" class="hide-data">
                <div id="htmlfor"></div>
            </div>
        </div>
    </div>
</div>

@include('client.uploaddoc_mode', ['max_size' => 200, 'isManual' => false])
@push('tab_scripts')
    {{-- Load Tab 4 Common utilities (always loaded) --}}
    <script src="{{ asset('assets/js/client/questionnaire/tab4/common.js') }}?v=1.01"></script>
    
    {{-- Load step-specific JavaScript based on active step --}}
    @if($step1)
        <script src="{{ asset('assets/js/client/questionnaire/tab4/step1.js') }}?v=1.01"></script>
    @endif
    
    @if($step2)
        <script src="{{ asset('assets/js/client/questionnaire/tab4/step2.js') }}?v=1.01"></script>
    @endif
    
    @if($step3)
        <script src="{{ asset('assets/js/client/questionnaire/tab4/step3.js') }}?v=1.01"></script>
    @endif
    
    @if($step4)
        <script src="{{ asset('assets/js/client/questionnaire/tab4/step4.js') }}?v=1.01"></script>
    @endif
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/tab4.css') }}">
@endpush





<!-- Tab 4 End-->