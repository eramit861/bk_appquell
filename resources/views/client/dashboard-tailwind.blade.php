@extends('layouts.client-tailwind')

@section('content')
    @php
        // Expecting all required data precomputed by service/controller
        $session = isset($session) && is_array($session) ? $session : [];
        $progress = isset($progress) && is_array($progress) ? $progress : ['all_percentage' => 0, 'class' => '', 'message' => '0%', 'width' => 100];
        $documents = isset($documents) && is_array($documents) ? $documents : ['signed_sent' => false];
        $labels = isset($labels) && is_array($labels) ? $labels : ['debtor_tab_name' => 'Debtor', 'codebtor_tab_name' => 'Co-Debtor', 'spouse_tab_text' => 'Co-Debtor'];
        $names = isset($names) && is_array($names) ? $names : ['debtor' => "Debtor's", 'spouse' => "Co-Debtor's", 'part_a' => [], 'part_b' => []];
        
        // Set authUser first for compatibility
        $authUser = auth()->user();
        
        $user = $user ?? [
            'id' => $authUser?->id,
            'name' => $authUser?->name,
            'client_type' => $authUser?->client_type,
            'client_subscription' => $authUser?->client_subscription,
            'phone_no' => $authUser?->phone_no,
            'email' => $authUser?->email,
            'hide_questionnaire' => $authUser?->hide_questionnaire,
        ];

        $web_view = !empty($session['web_view']);
        $userJustLogin = !empty($session['user_just_login']);
        $progress_percentage = (int) ($progress['all_percentage'] ?? 0);
        
        // Get tab from request, route, or default to tab1
        $tab = request()->get('tab') ?? ($tab ?? $route['tab'] ?? 'tab1');
        $step = request()->get('step') ?? ($step ?? $route['step'] ?? 'step1');
        $client_subscription = $user['client_subscription'] ?? null;
        $client_type = $user['client_type'] ?? null;
        $authUserHideQuestionnaire = (int) ($user['hide_questionnaire'] ?? 0);
        $client_id = $authUser?->id;
        
        // Additional variables for tab compatibility
        $info = $info ?? [];
        $resident = $resident ?? [];
        $debts = $debts ?? [];
        $income = $income ?? [];
        $expenses = $expenses ?? [];
        $averagePriceList = $averagePriceList ?? [];
        $route = $route ?? ['tab' => $tab, 'step' => $step];
        
        // Step flags (for sub-navigation within tabs)
        $step1 = $step1 ?? false;
        $step2 = $step2 ?? false;
        $step3 = $step3 ?? false;
        $step4 = $step4 ?? false;
        $step5 = $step5 ?? false;
        $step6 = $step6 ?? false;
    @endphp

    <!-- Progress Bar -->
    <!--div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-semibold text-gray-900">Your Progress</h2>
            <span class="text-2xl font-bold text-primary-600">{{ $progress_percentage }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-gradient-to-r from-primary-500 to-secondary-500 h-3 rounded-full transition-all duration-500" 
                 style="width: {{ $progress_percentage }}%"></div>
        </div>
        <p class="mt-2 text-sm text-gray-600">{{ $progress['message'] ?? $progress_percentage . '% Complete' }}</p>
    </div-->

    <!-- Questionnaire Tabs Navigation -->
    <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="border-b border-gray-200">
            <nav class="flex flex-wrap -mb-px overflow-x-auto" role="tablist">
                @if ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0)
                <!-- Tab 1: Basic Information -->
                <a href="{{ route('client_dashboard') }}" 
                   class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap
                          {{ $tab == 'tab1' ? 'border-primary-500 text-primary-600 bg-primary-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-user {{ $tab == 'tab1' ? 'text-primary-500' : 'text-gray-400' }} mr-2"></i>
                    Basic Info
                </a>
                
                <!-- Tab 2: Property -->
                <a href="{{ route('client_property_step1') }}" 
                   class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap
                          {{ $tab == 'tab2' ? 'border-primary-500 text-primary-600 bg-primary-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-home {{ $tab == 'tab2' ? 'text-primary-500' : 'text-gray-400' }} mr-2"></i>
                    Property
                </a>
                
                <!-- Tab 3: Debts -->
                <a href="{{ route('client_debts_step2_unsecured') }}" 
                   class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap
                          {{ $tab == 'tab3' ? 'border-primary-500 text-primary-600 bg-primary-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-credit-card {{ $tab == 'tab3' ? 'text-primary-500' : 'text-gray-400' }} mr-2"></i>
                    Debts
                </a>
                @endif
                
                <!-- Tab 4: Income -->
                <a href="{{ route('client_income_step1') }}" 
                   class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap
                          {{ $tab == 'tab4' ? 'border-primary-500 text-primary-600 bg-primary-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-dollar-sign {{ $tab == 'tab4' ? 'text-primary-500' : 'text-gray-400' }} mr-2"></i>
                    Income
                </a>
                
                @if ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0)
                <!-- Tab 5: Expenses -->
                <a href="{{ route('client_expenses') }}" 
                   class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap
                          {{ $tab == 'tab5' ? 'border-primary-500 text-primary-600 bg-primary-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-receipt {{ $tab == 'tab5' ? 'text-primary-500' : 'text-gray-400' }} mr-2"></i>
                    Expenses
                </a>
                
                <!-- Tab 6: Additional Info -->
                <a href="{{ route('client_financial_affairs') }}" 
                   class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap
                          {{ $tab == 'tab6' ? 'border-primary-500 text-primary-600 bg-primary-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-clipboard-list {{ $tab == 'tab6' ? 'text-primary-500' : 'text-gray-400' }} mr-2"></i>
                    Additional
                </a>
                
                <!-- Tab 7: Review -->
                <a href="{{ route('client_financial_affairs3') }}" 
                   class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap
                          {{ $tab == 'tab7' ? 'border-primary-500 text-primary-600 bg-primary-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-check-circle {{ $tab == 'tab7' ? 'text-primary-500' : 'text-gray-400' }} mr-2"></i>
                    Review
                </a>
                @endif
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6 md:p-8">
            <!-- Temporary: Show which tab is active -->
            @if(!isset($info) && !isset($resident) && !isset($debts) && !isset($income) && !isset($expenses))
            <!-- Placeholder when no data is passed -->
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-6">
                    <i class="fas fa-clipboard-check text-primary-600 text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ ucfirst(str_replace('tab', 'Section ', $tab)) }}</h2>
                <p class="text-gray-600 mb-8">This section is being loaded. The questionnaire tabs will appear here.</p>
                
                <!-- Tab Description -->
                <div class="max-w-2xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                    @if($tab == 'tab1')
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-user text-primary-500 mr-2"></i>Basic Information
                        </h3>
                        <p class="text-sm text-gray-600">Personal details, address, contact information</p>
                    </div>
                    @elseif($tab == 'tab2')
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-home text-primary-500 mr-2"></i>Property Information
                        </h3>
                        <p class="text-sm text-gray-600">Real estate, vehicles, personal property</p>
                    </div>
                    @elseif($tab == 'tab3')
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-credit-card text-primary-500 mr-2"></i>Debt Information
                        </h3>
                        <p class="text-sm text-gray-600">Creditors, loans, credit cards, medical bills</p>
                    </div>
                    @elseif($tab == 'tab4')
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-dollar-sign text-primary-500 mr-2"></i>Income Information
                        </h3>
                        <p class="text-sm text-gray-600">Employment, wages, benefits, other income</p>
                    </div>
                    @elseif($tab == 'tab5')
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-receipt text-primary-500 mr-2"></i>Expense Information
                        </h3>
                        <p class="text-sm text-gray-600">Monthly expenses, utilities, insurance</p>
                    </div>
                    @elseif($tab == 'tab6')
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-clipboard-list text-primary-500 mr-2"></i>Additional Information
                        </h3>
                        <p class="text-sm text-gray-600">Financial accounts, legal matters, transfers</p>
                    </div>
                    @elseif($tab == 'tab7')
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-check-circle text-primary-500 mr-2"></i>Review & Submit
                        </h3>
                        <p class="text-sm text-gray-600">Review your information and submit</p>
                    </div>
                    @endif
                </div>

                <!-- Info Card -->
                <div class="mt-8 max-w-2xl mx-auto bg-info-50 border border-info-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-info-500 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-info-900 mb-2">Converting to Modern Design</h4>
                            <p class="text-sm text-info-800">
                                This questionnaire section is being converted to the new Tailwind design. 
                                The forms and content will be styled beautifully once the conversion is complete.
                            </p>
                            <p class="text-sm text-info-800 mt-2">
                                <strong>Current Tab:</strong> {{ ucfirst(str_replace('tab', 'Section ', $tab)) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- When data exists, render only the ACTIVE tab -->
            <div class="prose max-w-none">
                {{-- Only show content for the currently active tab --}}
                
                @if ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0 && $tab == 'tab1')
                    <div class="tailwind-wrapper">
                        @php
                            // Prepare all data for tab1
                            $tab1Data = array_merge($info, [
                                'step1' => $step1,
                                'step2' => $step2,
                                'step3' => $step3,
                                'step4' => $step4,
                                'step5' => $step5,
                                'step6' => $step6,
                                'authUser' => $authUser,
                                'debtorname' => $names['debtor'] ?? "Debtor's",
                                'spousename' => $names['spouse'] ?? "Co-Debtor's",
                                'phone_no' => $authUser->phone_no ?? '',
                                'email' => $authUser->email ?? '',
                                'progress' => $progress ?? [],
                                'route' => $route ?? [],
                                'web_view' => $web_view,
                                'attorney_edit' => $attorney_edit ?? false,
                                'save_route' => $save_route ?? '#',
                            ]);
                        @endphp
                        @include('client.questionnaire.tab1', $tab1Data)
                    </div>
                @elseif ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0 && $tab == 'tab2')
                    <div class="tailwind-wrapper">
                        @include('client.questionnaire.tab2', array_merge($resident, [
                            'debtorname' => $names['debtor'] ?? "Debtor's",
                            'spousename' => $names['spouse'] ?? "Co-Debtor's",
                        ]))
                    </div>
                @elseif ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0 && $tab == 'tab3')
                    <div class="tailwind-wrapper">
                        @if ($step == 'step1')
                            @include('client.questionnaire.tab3', $debts)
                        @elseif ($step == 'step2')
                            @include('client.questionnaire.debt.debt_step2', array_merge($debts, [
                                'debtorname' => $names['debtor'] ?? "Debtor's",
                                'spousename' => $names['spouse'] ?? "Co-Debtor's",
                            ]))
                        @endif
                    </div>
                @elseif ($tab == 'tab4')
                    <div class="tailwind-wrapper">
                        @include('client.questionnaire.tab4', array_merge($income, [
                            'debtorname' => $names['debtor'] ?? "Debtor's",
                            'spousename' => $names['spouse'] ?? "Co-Debtor's",
                            'spouseTabText' => $labels['spouse_tab_text'] ?? 'Co-Debtor',
                        ]))
                    </div>
                @elseif ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0 && $tab == 'tab5')
                    <div class="tailwind-wrapper">
                        @include('client.questionnaire.tab5', [$expenses, $averagePriceList ?? [], $client_type ?? null])
                    </div>
                @elseif ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0 && $tab == 'tab6')
                    <div class="tailwind-wrapper">
                        @include('client.questionnaire.tab6')
                    </div>
                @elseif ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUserHideQuestionnaire == 0 && $tab == 'tab7')
                    <div class="tailwind-wrapper">
                        @include('client.questionnaire.tab7', [$averagePriceList ?? [], $client_type ?? null])
                    </div>
                @else
                    {{-- Default message if no tab matches --}}
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <i class="fas fa-info-circle text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-600">Select a tab above to view the questionnaire section.</p>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Modals (if they exist) -->
    @if(View::exists('modal.client.signed_document'))
        @include('modal.client.signed_document')
    @endif
    
    @if(View::exists('modal.common.questionnaire_confirmation_prompt'))
        @include('modal.common.questionnaire_confirmation_prompt')
    @endif
    
    @if(View::exists('modal.common.property_notice_prompt'))
        @include('modal.common.property_notice_prompt')
    @endif

@endsection

@push('styles')
<style>
    /* Prevent Tailwind from resetting Bootstrap styles inside forms */
    .tailwind-wrapper * {
        all: revert;
    }
    
    /* Re-apply some Tailwind utilities we want to keep */
    .tailwind-wrapper {
        font-family: 'Inter var', ui-sans-serif, system-ui, sans-serif;
        line-height: 1.5;
    }
    
    /* Ensure Bootstrap components work properly */
    .tailwind-wrapper .nav-pills {
        display: flex !important;
        flex-wrap: wrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    
    .tailwind-wrapper .nav-link {
        display: block;
        padding: 0.5rem 1rem;
        text-decoration: none;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
    }
    
    .tailwind-wrapper .nav-pills .nav-link.active {
        background-color: rgb(99 102 241);
        color: white;
    }
    
    /* Bootstrap Grid System - Complete Implementation */
    .tailwind-wrapper .row {
        display: flex !important;
        flex-wrap: wrap !important;
        margin-left: -0.75rem !important;
        margin-right: -0.75rem !important;
    }
    
    /* Bootstrap 5 Gap Utilities */
    .tailwind-wrapper .gx-1 { margin-left: -0.25rem !important; margin-right: -0.25rem !important; }
    .tailwind-wrapper .gx-1 > [class*="col-"] { padding-left: 0.25rem !important; padding-right: 0.25rem !important; }
    
    .tailwind-wrapper .gx-2 { margin-left: -0.5rem !important; margin-right: -0.5rem !important; }
    .tailwind-wrapper .gx-2 > [class*="col-"] { padding-left: 0.5rem !important; padding-right: 0.5rem !important; }
    
    .tailwind-wrapper .gx-3 { margin-left: -0.75rem !important; margin-right: -0.75rem !important; }
    .tailwind-wrapper .gx-3 > [class*="col-"] { padding-left: 0.75rem !important; padding-right: 0.75rem !important; }
    
    .tailwind-wrapper .gx-4 { margin-left: -1rem !important; margin-right: -1rem !important; }
    .tailwind-wrapper .gx-4 > [class*="col-"] { padding-left: 1rem !important; padding-right: 1rem !important; }
    
    .tailwind-wrapper .gx-5 { margin-left: -1.5rem !important; margin-right: -1.5rem !important; }
    .tailwind-wrapper .gx-5 > [class*="col-"] { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
    
    /* Base: All columns have padding and start at 100% (mobile first) */
    .tailwind-wrapper [class*="col-"] {
        position: relative !important;
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
        box-sizing: border-box !important;
    }
    
    /* Default col-12 on mobile (before breakpoints kick in) */
    .tailwind-wrapper .col-12 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }
    
    .tailwind-wrapper .col-1 { flex: 0 0 8.333333% !important; max-width: 8.333333% !important; }
    .tailwind-wrapper .col-2 { flex: 0 0 16.666667% !important; max-width: 16.666667% !important; }
    .tailwind-wrapper .col-3 { flex: 0 0 25% !important; max-width: 25% !important; }
    .tailwind-wrapper .col-4 { flex: 0 0 33.333333% !important; max-width: 33.333333% !important; }
    .tailwind-wrapper .col-5 { flex: 0 0 41.666667% !important; max-width: 41.666667% !important; }
    .tailwind-wrapper .col-6 { flex: 0 0 50% !important; max-width: 50% !important; }
    .tailwind-wrapper .col-7 { flex: 0 0 58.333333% !important; max-width: 58.333333% !important; }
    .tailwind-wrapper .col-8 { flex: 0 0 66.666667% !important; max-width: 66.666667% !important; }
    .tailwind-wrapper .col-9 { flex: 0 0 75% !important; max-width: 75% !important; }
    .tailwind-wrapper .col-10 { flex: 0 0 83.333333% !important; max-width: 83.333333% !important; }
    .tailwind-wrapper .col-11 { flex: 0 0 91.666667% !important; max-width: 91.666667% !important; }
    
    /* Small screens (≥ 576px) */
    @media (min-width: 576px) {
        .tailwind-wrapper .col-sm-1 { flex: 0 0 8.333333% !important; max-width: 8.333333% !important; }
        .tailwind-wrapper .col-sm-2 { flex: 0 0 16.666667% !important; max-width: 16.666667% !important; }
        .tailwind-wrapper .col-sm-3 { flex: 0 0 25% !important; max-width: 25% !important; }
        .tailwind-wrapper .col-sm-4 { flex: 0 0 33.333333% !important; max-width: 33.333333% !important; }
        .tailwind-wrapper .col-sm-5 { flex: 0 0 41.666667% !important; max-width: 41.666667% !important; }
        .tailwind-wrapper .col-sm-6 { flex: 0 0 50% !important; max-width: 50% !important; }
        .tailwind-wrapper .col-sm-7 { flex: 0 0 58.333333% !important; max-width: 58.333333% !important; }
        .tailwind-wrapper .col-sm-8 { flex: 0 0 66.666667% !important; max-width: 66.666667% !important; }
        .tailwind-wrapper .col-sm-9 { flex: 0 0 75% !important; max-width: 75% !important; }
        .tailwind-wrapper .col-sm-10 { flex: 0 0 83.333333% !important; max-width: 83.333333% !important; }
        .tailwind-wrapper .col-sm-11 { flex: 0 0 91.666667% !important; max-width: 91.666667% !important; }
        .tailwind-wrapper .col-sm-12 { flex: 0 0 100% !important; max-width: 100% !important; }
    }
    
    /* Medium screens (≥ 768px) */
    @media (min-width: 768px) {
        .tailwind-wrapper .col-md-1 { flex: 0 0 8.333333% !important; max-width: 8.333333% !important; }
        .tailwind-wrapper .col-md-2 { flex: 0 0 16.666667% !important; max-width: 16.666667% !important; }
        .tailwind-wrapper .col-md-3 { flex: 0 0 25% !important; max-width: 25% !important; }
        .tailwind-wrapper .col-md-4 { flex: 0 0 33.333333% !important; max-width: 33.333333% !important; }
        .tailwind-wrapper .col-md-5 { flex: 0 0 41.666667% !important; max-width: 41.666667% !important; }
        .tailwind-wrapper .col-md-6 { flex: 0 0 50% !important; max-width: 50% !important; }
        .tailwind-wrapper .col-md-7 { flex: 0 0 58.333333% !important; max-width: 58.333333% !important; }
        .tailwind-wrapper .col-md-8 { flex: 0 0 66.666667% !important; max-width: 66.666667% !important; }
        .tailwind-wrapper .col-md-9 { flex: 0 0 75% !important; max-width: 75% !important; }
        .tailwind-wrapper .col-md-10 { flex: 0 0 83.333333% !important; max-width: 83.333333% !important; }
        .tailwind-wrapper .col-md-11 { flex: 0 0 91.666667% !important; max-width: 91.666667% !important; }
        .tailwind-wrapper .col-md-12 { flex: 0 0 100% !important; max-width: 100% !important; }
    }
    
    /* Large screens (≥ 992px) */
    @media (min-width: 992px) {
        .tailwind-wrapper .col-lg-1 { flex: 0 0 8.333333% !important; max-width: 8.333333% !important; }
        .tailwind-wrapper .col-lg-2 { flex: 0 0 16.666667% !important; max-width: 16.666667% !important; }
        .tailwind-wrapper .col-lg-3 { flex: 0 0 25% !important; max-width: 25% !important; }
        .tailwind-wrapper .col-lg-4 { flex: 0 0 33.333333% !important; max-width: 33.333333% !important; }
        .tailwind-wrapper .col-lg-5 { flex: 0 0 41.666667% !important; max-width: 41.666667% !important; }
        .tailwind-wrapper .col-lg-6 { flex: 0 0 50% !important; max-width: 50% !important; }
        .tailwind-wrapper .col-lg-7 { flex: 0 0 58.333333% !important; max-width: 58.333333% !important; }
        .tailwind-wrapper .col-lg-8 { flex: 0 0 66.666667% !important; max-width: 66.666667% !important; }
        .tailwind-wrapper .col-lg-9 { flex: 0 0 75% !important; max-width: 75% !important; }
        .tailwind-wrapper .col-lg-10 { flex: 0 0 83.333333% !important; max-width: 83.333333% !important; }
        .tailwind-wrapper .col-lg-11 { flex: 0 0 91.666667% !important; max-width: 91.666667% !important; }
        .tailwind-wrapper .col-lg-12 { flex: 0 0 100% !important; max-width: 100% !important; }
    }
    
    /* Extra large screens (≥ 1200px) */
    @media (min-width: 1200px) {
        .tailwind-wrapper .col-xl-1 { flex: 0 0 8.333333% !important; max-width: 8.333333% !important; }
        .tailwind-wrapper .col-xl-2 { flex: 0 0 16.666667% !important; max-width: 16.666667% !important; }
        .tailwind-wrapper .col-xl-3 { flex: 0 0 25% !important; max-width: 25% !important; }
        .tailwind-wrapper .col-xl-4 { flex: 0 0 33.333333% !important; max-width: 33.333333% !important; }
        .tailwind-wrapper .col-xl-5 { flex: 0 0 41.666667% !important; max-width: 41.666667% !important; }
        .tailwind-wrapper .col-xl-6 { flex: 0 0 50% !important; max-width: 50% !important; }
        .tailwind-wrapper .col-xl-7 { flex: 0 0 58.333333% !important; max-width: 58.333333% !important; }
        .tailwind-wrapper .col-xl-8 { flex: 0 0 66.666667% !important; max-width: 66.666667% !important; }
        .tailwind-wrapper .col-xl-9 { flex: 0 0 75% !important; max-width: 75% !important; }
        .tailwind-wrapper .col-xl-10 { flex: 0 0 83.333333% !important; max-width: 83.333333% !important; }
        .tailwind-wrapper .col-xl-11 { flex: 0 0 91.666667% !important; max-width: 91.666667% !important; }
        .tailwind-wrapper .col-xl-12 { flex: 0 0 100% !important; max-width: 100% !important; }
    }
    
    .tailwind-wrapper .form-group {
        margin-bottom: 1rem;
    }
    
    .tailwind-wrapper .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.375rem;
        transition: all 0.15s ease-in-out;
    }
    
    /* Hide class helper */
    .tailwind-wrapper .hidestep {
        display: none !important;
    }
    
    /* Yes/No Toggle Button Styles */
    .tailwind-wrapper .btn-toggle {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        margin: 0 0.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-align: center;
        border: 2px solid #d1d5db;
        border-radius: 0.5rem;
        background-color: white;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    
    .tailwind-wrapper .btn-toggle:hover {
        border-color: rgb(99 102 241);
        color: rgb(99 102 241);
        background-color: rgb(99 102 241 / 0.05);
    }
    
    .tailwind-wrapper .btn-toggle.active,
    .tailwind-wrapper .btn-toggle.active-yes,
    .tailwind-wrapper .btn-toggle.active-no {
        background-color: rgb(99 102 241);
        border-color: rgb(99 102 241);
        color: white;
        font-weight: 600;
    }
    
    /* Question label area */
    .tailwind-wrapper .question-area label {
        display: block;
        width: 100%;
        margin-bottom: 0.75rem;
        font-weight: 500;
        color: #1f2937;
    }
    
    .tailwind-wrapper .custom-radio-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    /* Hide the actual radio inputs */
    .tailwind-wrapper input[type="radio"].d-none {
        display: none !important;
    }
    
    /* Delete buttons - right align */
    .tailwind-wrapper .text-end,
    .tailwind-wrapper .text-right {
        text-align: right !important;
    }
    
    /* Row alignment fixes */
    .tailwind-wrapper .d-flex {
        display: flex !important;
    }
    
    .tailwind-wrapper .justify-content-end {
        justify-content: flex-end !important;
    }
    
    .tailwind-wrapper .justify-content-between {
        justify-content: space-between !important;
    }
    
    .tailwind-wrapper .align-items-center {
        align-items: center !important;
    }
    
    .tailwind-wrapper .ms-auto,
    .tailwind-wrapper .ml-auto {
        margin-left: auto !important;
    }
    
    /* Add More button positioning */
    .tailwind-wrapper .outline-gray-border-area {
        position: relative;
        padding-bottom: 4rem; /* Space for button */
    }
    
    .tailwind-wrapper .add-more-button,
    .tailwind-wrapper [onclick*="addOther"],
    .tailwind-wrapper [onclick*="add_"] {
        margin-top: 1rem;
        display: block;
        width: auto;
    }
    
    /* Delete icon right align */
    .tailwind-wrapper .delete-icon,
    .tailwind-wrapper .fa-trash,
    .tailwind-wrapper .fa-trash-alt,
    .tailwind-wrapper [onclick*="delete"],
    .tailwind-wrapper [onclick*="remove"] {
        float: right;
        margin-left: auto;
    }
    
    /* Section with delete button */
    .tailwind-wrapper .other-names-section,
    .tailwind-wrapper .added-section,
    .tailwind-wrapper [id*="other_name"] {
        position: relative;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }
    
    /* Delete button in section header */
    .tailwind-wrapper .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .tailwind-wrapper .section-header .delete-btn,
    .tailwind-wrapper .section-header i.fa-trash {
        margin-left: auto;
        cursor: pointer;
        color: #ef4444;
    }
    
    .tailwind-wrapper .section-header i.fa-trash:hover {
        color: #dc2626;
    }
    
    /* Edit/Delete button styles */
    .tailwind-wrapper .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .tailwind-wrapper .btn-danger {
        background-color: #ef4444;
        color: white;
        border-color: #ef4444;
    }
    
    .tailwind-wrapper .btn-danger:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }
    
    .tailwind-wrapper .btn-primary {
        background-color: rgb(99 102 241);
        color: white;
        border-color: rgb(99 102 241);
    }
    
    .tailwind-wrapper .btn-primary:hover {
        background-color: rgb(79 70 229);
        border-color: rgb(79 70 229);
    }
</style>
@endpush

@section('dashboard_scripts')
    <script>
        window.userJustLogin = @json($userJustLogin ?? false);
        window.web_view = @json($web_view ?? false);
        window.update_attorney_doc_view_status_url = "{{ route('update_attorney_doc_view_status') ?? '#' }}";
        
        // Redirect function for tab navigation
        function redirectToURL(url) {
            if (url) {
                window.location.href = url;
            }
        }
        
        // Placeholder for change password modal
        function openChangePasswordModal() {
            alert('Change password functionality will be integrated soon.\nPlease use the old interface for now or contact support.');
        }
        
        // Google Translate initialization (if needed)
        function googleTranslateElementInit() {
            if (typeof google !== 'undefined' && google.translate) {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'en,es',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            }
        }
        
        // Helper to ensure toggle buttons work
        $(document).ready(function() {
            // Fix for toggle buttons - ensure active class switches properly
            $('.btn-toggle').on('click', function() {
                // Remove active from siblings
                $(this).siblings('.btn-toggle').removeClass('active active-yes active-no');
                
                // Add active to clicked button
                $(this).addClass('active');
                
                // Trigger the associated radio button
                var radioId = $(this).attr('for');
                if (radioId) {
                    $('#' + radioId).prop('checked', true).trigger('change');
                }
            });
        });
    </script>
    
    <!-- Google Translate -->
    @if($web_view)
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    @endif
    
    <!-- Dashboard JS -->
    @if(file_exists(public_path('assets/js/dashboard.js')))
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @endif
    
    <!-- Questionnaire JS -->
    <script src="{{ asset('assets/js/questionarrie.js') }}"></script>
    
    <!-- Additional JS libraries if needed -->
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
@endsection
