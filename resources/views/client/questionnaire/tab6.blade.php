@php
$list = @$docsUploadInfo['list'];
$tab6_percentage_by_steps = Helper::validate_key_value('tab6_percentage_by_steps', $progress);
$hasAnyBussinessP = \App\Models\ClientBasicInfoPartRest::hasAnyBussiness($authUser->id);
@endphp
<!-- include("client.questionnaire.topbar") -->
<link rel="stylesheet" href="{{ asset('assets/css/client/tab6.css') }}">

<ul class="nav nav-pills nav-fill w-100 p-0 with-progress" id="pills-tab" role="tablist">
    @php
    $step1TabData = Helper::validate_key_value('step1', $tab6_percentage_by_steps);
    $step1PercentDone = Helper::validate_key_value('percentDone', $step1TabData, 'radio');
    $step1PercentTotal = Helper::validate_key_value('percentTotal', $step1TabData, 'radio');
    $step1TabClass = Helper::validate_key_value('tabClass', $step1TabData);
    @endphp
    <li class="nav-item nav-item-ui-new {{ request()->routeIs('client_financial_affairs') ? 'mobile-mr-0' : 'hide-tab' }} {{ $step1TabClass }}"
        role="presentation">
        <button
            class="nav-link tab-ui-new {{ request()->routeIs('client_financial_affairs') ? 'active' : '' }}"
            onclick="redirectToURL('{{ route('client_financial_affairs') }}')" id="all-firm-client-tab"
            data-bs-toggle="pill" data-bs-target="#all-firm-client" type="button" role="tab"
            aria-controls="all-firm-client" aria-selected="true">
            <span>&#x1F4C4;</span>
            <span>Page 1</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $step1PercentDone }}"
                aria-valuemin="0" aria-valuemax="{{ $step1PercentTotal }}">
                <div class="progress-bar" style="width:{{ $step1PercentDone ?? 0 }}%">
                    <div class="progress_text_{{ $step1PercentDone ?? 0 }}">
                        {{ $step1PercentDone ?? 0 }}%
                    </div>
                </div>
            </div>
        </button>
    </li>
    @php
    $step2TabData = Helper::validate_key_value('step2', $tab6_percentage_by_steps);
    $step2PercentDone = Helper::validate_key_value('percentDone', $step2TabData, 'radio');
    $step2PercentTotal = Helper::validate_key_value('percentTotal', $step2TabData, 'radio');
    $step2TabClass = Helper::validate_key_value('tabClass', $step2TabData);
    @endphp
    <li class="nav-item nav-item-ui-new {{ request()->routeIs('client_financial_affairs2') ? 'mobile-mr-0' : 'hide-tab' }} {{ $step2TabClass }}"
        role="presentation">
        <button
            class="nav-link tab-ui-new {{ request()->routeIs('client_financial_affairs2') ? 'active' : '' }}"
            onclick="redirectToURL('{{ route('client_financial_affairs2') }}')" id="all-firm-client-tab"
            data-bs-toggle="pill" data-bs-target="#all-firm-client" type="button" role="tab"
            aria-controls="all-firm-client" aria-selected="true">
            <span>&#x1F4C4;</span>
            <span>Page 2</span>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $step2PercentDone }}"
                aria-valuemin="0" aria-valuemax="{{ $step2PercentTotal }}">
                <div class="progress-bar" style="width:{{ $step2PercentDone ?? 0 }}%">
                    <div class="progress_text_{{ $step2PercentDone ?? 0 }}">
         
                    {{ $step2PercentDone ?? 0 }}%
                    </div>
                </div>
            </div>
        </button>
    </li>
    @if($hasAnyBussinessP)
        @php
        $step3TabData = Helper::validate_key_value('step3', $tab6_percentage_by_steps);
        $step3PercentDone = Helper::validate_key_value('percentDone', $step3TabData, 'radio');
        $step3PercentTotal = Helper::validate_key_value('percentTotal', $step3TabData, 'radio');
        $step3TabClass = Helper::validate_key_value('tabClass', $step3TabData);
        @endphp
        <li class="nav-item nav-item-ui-new {{ request()->routeIs('client_financial_affairs3') ? 'mobile-mr-0' : 'hide-tab' }} {{ $step3TabClass }}"
            role="presentation">
            <button
                class="nav-link tab-ui-new {{ request()->routeIs('client_financial_affairs3') ? 'active' : '' }}"
                onclick="redirectToURL('{{ route('client_financial_affairs3') }}')" id="all-firm-client-tab"
                data-bs-toggle="pill" data-bs-target="#all-firm-client" type="button" role="tab"
                aria-controls="all-firm-client" aria-selected="true">
                <span>&#x1F4BC;</span>
                <span>Business Info</span>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $step3PercentDone }}"
                    aria-valuemin="0" aria-valuemax="{{ $step3PercentTotal }}">
                    <div class="progress-bar" style="width:{{ $step3PercentDone ?? 0 }}%">
                        <div class="progress_text_{{ $step3PercentDone ?? 0 }}">
                            {{ $step3PercentDone ?? 0 }}%
                        </div>
                    </div>
                </div>
            </button>
        </li>
    @endif
</ul>
<div class="card-body border-top-left-radius-none">
    <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
            <div class="">
                <div class="tab-pane fade show active" id="section6" role="tabpanel" style="overflow: auto;"
                    aria-labelledby="section6-tab">
                    @if($step1)
                        <form name="client_financial_affairs" id="client_financial_affairs"
                            action="{{route('client_financial_affairs')}}" method="post" novalidate>
                    @endif
                        @if($step2)
                            <form name="client_financial_affairs" id="client_financial_affairs"
                                action="{{route('client_financial_affairs2')}}" method="post" novalidate>
                        @endif
                            @if($step3)
                                <form name="client_financial_affairs" id="client_financial_affairs"
                                    action="{{route('client_financial_affairs3')}}" method="post" novalidate>
                            @endif
                                @csrf

                                @if ($authUser->client_type == 2 || $authUser->client_type == 3)
                                    <div class="blinking-red-notice mt-0 mb-4">
                                        <span>If you are filing jointly with your spouse, include information about both you
                                            and your spouse.</span>
                                    </div>
                                @endif

                                @if($step1)
                                    @php
                                    $i = 0;
                                    $current_marital_Status = $finacial_affairs['current_marital_Status'] ?? '0';
                                    $maritalStatus = '';
                                    if ($current_marital_Status == 0 || $current_marital_Status == 1) {
                                        if ($client_type == 1) {
                                            $maritalStatus = 0;
                                        }
                                        if ($client_type == 2 || $client_type == 3) {
                                            $maritalStatus = 1;
                                        }
                                    }
                                    $idDebtorEmployed = \App\Models\IncomeDebtorEmployer::isDebtorEmployed(Auth::user()->id);
                                    $idSpouseEmployed = \App\Models\IncomeDebtorEmployer::isDebtorEmployed(Auth::user()->id);
                                    $taxYears = DateTimeHelper::getOnlyYearForTaxReturn($attorney_id);

                                    $isCodebtor = 0;
                                    if ($client_type == 3) {
                                        $isCodebtor = 1;
                                    }
                                    @endphp
                                                                <div class="light-gray-div mt-2 mt-4">
                                                                    <h2 class="text-dark fw-bold">Statement of Financial Affairs</h2>
                                                                    <div class="row gx-3">
                                                                        @include('client.questionnaire.affairs.steps.step1', ['finacial_affairs' => $finacial_affairs])
                                                                    </div>
                                                                </div>
                                                                <div class="light-gray-div mt-4">
                                                                    <h2 class="text-dark fw-bold">SOFA - Legal Actions</h2>
                                                                    <div class="light-gray-div mt-2 mb-3">
                                                                        <h2 class="text-dark fw-bold">In the last year, has any legal action been taken against you or your spouse
                                                                            (if married)?</h2>
                                                                        <div class="row gx-3">
                                                                            @include('client.questionnaire.affairs.steps.step1_section1', ['finacial_affairs' => $finacial_affairs])
                                                                        </div>
                                                                    </div>
                                                                </div>
                                @endif

                                @if($step2)
                                    <div class="light-gray-div mt-4">
                                        <h2 class="text-dark fw-bold">SOFA - Recent Gifts, Donations, and Losses</h2>
                                        <div class="row gx-3">
                                            @include('client.questionnaire.affairs.steps.step2_section1', ['finacial_affairs' => $finacial_affairs])
                                        </div>
                                    </div>

                                    <div class="light-gray-div mt-2">
                                        <h2 class="text-dark fw-bold">SOFA - Payments Related to Your Debts /Property Transfers</h2>
                                        <div class="row gx-3">
                                            @include('client.questionnaire.affairs.steps.step2_section2', ['finacial_affairs' => $finacial_affairs])
                                        </div>
                                    </div>

                                    <div class="light-gray-div mt-2">
                                        <h2 class="text-dark fw-bold">SOFA - Storage & Items Not Yours In Your Possession</h2>
                                        <div class="row gx-3">
                                            @include('client.questionnaire.affairs.steps.step2_section3', ['finacial_affairs' => $finacial_affairs])
                                        </div>
                                    </div>
                                @endif



                                @if($step3)
                                    <div class="light-gray-div mt-2 mt-4">
                                        <h2>
                                            Statement of Financial Affairs
                                            {{ \App\Models\ClientBasicInfoPartRest::hasAnyBussiness($client_id) ? ' - Business Info' : '' }}
                                        </h2>
                                        <div class="row gx-3">
                                            @if($step3)
                                                @include('client.questionnaire.affairs.steps.step3', ['finacial_affairs' => $finacial_affairs])
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="bottom-btn-div">
                                    @if(!empty($finacial_affairs['id']))
                                        <input type="hidden" class="property_vehicle_ids" name="id"
                                            value="{{ Helper::validate_value($finacial_affairs['id']) }}">
                                    @endif
                                    @if(!empty($backUrl))
                                        <a href="{{$backUrl}}" class="btn-new-ui-default mr-2">Back to Previous Page</a>
                                    @endif

                                    @if(
                                        (isset($is_confirm_prompt_enabled) && $is_confirm_prompt_enabled && $step1PercentDone == 100 && $step2 && !$hasAnyBussinessP)
                                        || (isset($is_confirm_prompt_enabled) && $is_confirm_prompt_enabled && $step1PercentDone == 100 && $step2PercentDone == 100 && $step3 == 3 && $hasAnyBussinessP)
                                    )
                                        <button type="button" class="btn-new-ui-default"
                                            onclick="showConfirmationPrompt('client_financial_affairs', 'Statement of Financial Affairs')">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}
                                            <i class="feather icon-chevron-right mr-0"></i></button>
                                    @else
                                        <button type="submit"
                                            class="btn-new-ui-default">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}
                                            <i class="feather icon-chevron-right mr-0"></i></button>
                                    @endif
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="hide-data operation-business-income">
    <p class="text-center text-danger mb-0"><i class="fa fa-exclamation-triangle fs-18px text-danger blink"
            aria-hidden="true"></i> You entered you have been employed in the last year.</p>
    <p class="text-center text-danger mb-0">The Court requires you to list your income for:</p>
    <ol class="mx-auto my-2 w-fit-content text-c-blue">
        <li>Current year YTD year to date</li>
        <li>Last calendar year</li>
        <li>The calendar year before</li>
    </ol>
    <p class="text-danger">Are you sure you don't want to fill this out even though the Court requires it? <span
            class="fs-25px">&#128563;</span><span class="fs-25px">&#128561;</span></p>
</div>
<div class="hide-data sofa-irs-popup-image">
    <img class="webkit_fill" alt="IRS" src="{{url('assets/img/sofa-irs-popup-image.png')}}" />
</div>
<div class="hide-data sofa-irs-popup-image-ytd">
    <img class="webkit_fill" alt="YTD" src="{{url('assets/img/sofa_ytd.png')}}" />
</div>
<div class="hide-data sofa-irs-popup-image-IRS2">
    <img class="webkit_fill" alt="IRS" src="{{url('assets/img/IRS2.png')}}" />
</div>

@push('tab_scripts')
    <script>
        window.__tab6Routes = {
            courthouseSearch: "{{ route('courthouses_search') }}",
            creditorSearch: "{{ route('master_credit_search') }}"
        };
        window.__tab6Data = {
            totalAmountIncome: '{{ $finacial_affairs['total_amount_income'] ?? 'null' }}'
        };
    </script>
    
    {{-- Load Tab 6 Common utilities (always loaded) --}}
    <script src="{{ asset('assets/js/client/questionnaire/tab6/common.js') }}?v=1.01"></script>
    
    {{-- Load step-specific JavaScript based on active route --}}
    @if(request()->routeIs('client_financial_affairs'))
        <script src="{{ asset('assets/js/client/questionnaire/tab6/step1.js') }}?v=1.01"></script>
    @endif
    
    @if(request()->routeIs('client_financial_affairs2'))
        <script src="{{ asset('assets/js/client/questionnaire/tab6/step2.js') }}?v=1.01"></script>
    @endif
    
    @if(request()->routeIs('client_financial_affairs3'))
        <script src="{{ asset('assets/js/client/questionnaire/tab6/step3.js') }}?v=1.01"></script>
    @endif
@endpush
