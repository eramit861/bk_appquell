@php
    $currentMonth = date('d') >= 10 ? date('m/Y') : date('m/Y', strtotime('-1 month'));
    $lastMonth = date('d') >= 10 ? date('m/Y', strtotime('-1 month')) : date('m/Y', strtotime('-2 months'));
    $monthBeforeLast = date('d') >= 10 ? date('m/Y', strtotime('-2 months')) : date('m/Y', strtotime('-3 months'));
    $currentYear = date('Y');
    $last15Years = range($currentYear, $currentYear - 15, -1);
    $alCustomSaveUrl = route('additional_liens_custom_save');
    $tab3_percentage_by_steps = !empty($progress['tab3_percentage_by_steps'])
        ? $progress['tab3_percentage_by_steps']
        : '';
    $creditReportEnabled = App\Models\User::isCreditReportEnabledByClientId($client_id);
    $language = Config::get('app.locale');

    // Extract step data
    $step1TabData = !empty($tab3_percentage_by_steps['step1']) ? $tab3_percentage_by_steps['step1'] : [];
    $step1PercentDone = (int) (!empty($step1TabData['percentDone']) ? $step1TabData['percentDone'] : 0);
    $step1PercentTotal = (int) (!empty($step1TabData['percentTotal']) ? $step1TabData['percentTotal'] : 0);
    $step1TabClass = !empty($step1TabData['tabClass']) ? $step1TabData['tabClass'] : '';

    $step2TabData = !empty($tab3_percentage_by_steps['step2']) ? $tab3_percentage_by_steps['step2'] : [];
    $step2PercentDone = (int) (!empty($step2TabData['percentDone']) ? $step2TabData['percentDone'] : 0);
    $step2PercentTotal = (int) (!empty($step2TabData['percentTotal']) ? $step2TabData['percentTotal'] : 0);
    $step2TabClass = !empty($step2TabData['tabClass']) ? $step2TabData['tabClass'] : '';
    
    $showGraphqlComfirmPopup = false;
    $showGetReportPopup = false;
    if (env('ENABLED_CLIENT_SIDE_CREDIT_REPORT', false) == true && ($creditReportEnabled['debtor'] || $creditReportEnabled['codebtor'])){
        if (!empty($isAiProcessedClientPendingExists) && in_array($crsReportNotCompleted, [0,2,3])){
            $showGraphqlComfirmPopup = true;
        }
        if (empty($crsReportExistsStatus)){
            $showGetReportPopup = true;
        }
    }
@endphp

<!-- Tab Navigation Component -->
<x-client.tab-navigation
    :tabData="[
        'step1' => [
            'percentDone' => $step1PercentDone,
            'percentTotal' => $step1PercentTotal,
            'tabClass' => $step1TabClass,
            'routeName' => 'client_debts_step2_unsecured',
            'icon' => '💳',
            'label' => 'Unsecured Debts',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step2' => [
            'percentDone' => $step2PercentDone,
            'percentTotal' => $step2PercentTotal,
            'tabClass' => $step2TabClass,
            'routeName' => 'client_debts_step2_back_tax',
            'icon' => '💰',
            'label' => 'Priority Debts',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ]
    ]"
    :debtorTabName="$debtorname"
    :codebtorTabName="$spousename" />

<div class="card-body border-top-left-radius-none">
    <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
            <div class="auth-wrapper1 debts-form-main">
                <div class="container1">
                    <div class="px-1 {{ !isset($web_view) || !$web_view ? 'debts-form' : '' }}">

                        {{-- Debt Unsecured Debts --}}
                        @if (isset($debt_step) && $debt_step == 'unsecured')
                            @include('client.questionnaire.debt.steps.unsecured')
                        @endif

                        {{-- Debt State Back Taxes Owed & Debt IRS --}}
                        @if (isset($debt_step) && $debt_step == 'back_tax')
                            @include('client.questionnaire.debt.steps.back_tax')
                            @include('client.questionnaire.debt.steps.irs')
                            @include('client.questionnaire.debt.steps.domestic')
                            @include('client.questionnaire.debt.steps.secured')
                        @endif

                        {{-- Debt Domestic Support Debts --}}
                        @if (isset($debt_step) && $debt_step == 'domestic')
                            {{-- Content for domestic step --}}
                        @endif

                        {{-- Debt Secured Debts --}}
                        @if (isset($debt_step) && $debt_step == 'secured')
                            {{-- Content for secured step --}}
                        @endif

                    </div>

                    <div class="bottom-btn-div">
                        <input type="hidden" id="al_debt_url" value="{{ $alCustomSaveUrl }}">
                        @if (!empty($debts['id']))
                            <input type="hidden" class="debt_tax_ids" name="id"
                                value="{{ !empty($debts['id']) ? $debts['id'] : '' }}">
                        @endif
                        @if (request()->routeIs('client_debts_step2_unsecured'))
                            <a href="javascript:void(0)" onclick="submitdebtForms('client_debts_step2_unsecured')"
                                class="btn-new-ui-default">Save & Next <i
                                    class="feather icon-chevron-right mr-0"></i></a>
                        @endif
                        @if (request()->routeIs('client_debts_step2_back_tax'))
                            <a href="{{ route('client_debts_step2_unsecured') }}"
                                class="btn-new-ui-default mr-2 {{ ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back
                                to Previous Page</a>
                            <a href="javascript:void(0)"
                                onclick="submitdebtForms('client_debts_step2_back_taxes', 'client_debts_step2_irs', 'client_debts_step2_dso', 'client_debts_step2_al')"
                                class="btn-new-ui-default">Save & Next <i
                                    class="feather icon-chevron-right mr-0"></i></a>
                        @endif
                        @if (request()->routeIs('client_debts_step2_additional'))
                            <a href="{{ route('client_debts_step2_back_tax') }}"
                                class="btn-new-ui-default mr-2 {{ ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back
                                to Previous Page</a>
                            @if (isset($is_confirm_prompt_enabled) &&
                                    $is_confirm_prompt_enabled &&
                                    $step1PercentDone == 100 &&
                                    $step2PercentDone == 100 &&
                                    $step3PercentDone == 100)
                                <button type="button" class="btn-new-ui-default"
                                    onclick="showConfirmationPrompt('isDebtTab', 'Debts')">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                                    <i class="feather icon-chevron-right mr-0"></i></button>
                            @else
                                <button type="button" class="btn-new-ui-default"
                                    onclick="submitdebtForms('client_debts_step2_al')">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                                    <i class="feather icon-chevron-right mr-0"></i></button>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/debt_step2.css') }}">
@endpush
@push('tab_scripts')
    <script>
        window.__debtStep2Routes = {
            masterCreditSearchByCategory: "{{ route('master_credit_search_by_category') }}",
            masterCreditSearch: "{{ route('master_credit_search') }}",
            courthousesSearch: "{{ route('courthouses_search') }}",
            confirmCreditPopup: "{{ route('confirm_credit_popup') }}",
            confirmCreditReport: "{{ route('confirm_credit_report') }}",
            openGetReportPopup: "{{ route('open_get_report_popup') }}",
            clientDocumentUploads: "{{ route('client_document_uploads') }}"
        };
        window.__debtStep2Data = {
            addressList: {!! json_encode(AddressHelper::getStateTaxAddress()) !!},
            domesticAddressList: {!! json_encode(AddressHelper::getDomesticAddressStatesList()) !!},
            clientId: "{{ Auth::user()->id }}",
            language: "{{ $language }}",
            client_id: "{{ $client_id ?? '' }}",
            showGraphqlComfirmPopup: @json($showGraphqlComfirmPopup ?? false),
            showGetReportPopup: @json($showGetReportPopup ?? false)
        };
    </script>

    {{-- Load Tab 3 Common utilities (always loaded) --}}
    <script src="{{ asset('assets/js/client/questionnaire/tab3/common.js') }}?v=1.01"></script>
    
    {{-- Load step-specific JavaScript based on active debt step --}}
    @if(isset($debt_step) && $debt_step == 'unsecured')
        <script src="{{ asset('assets/js/client/questionnaire/tab3/step1.js') }}?v=1.01"></script>
    @endif
    
    @if(isset($debt_step) && $debt_step == 'back_tax')
        <script src="{{ asset('assets/js/client/questionnaire/tab3/step2.js') }}?v=1.01"></script>
    @endif
@endpush

@if (isset($web_view) && $web_view)
    <style>
        .mdsoview {
            margin-top: 10px;
        }
    </style>
@endif
