@extends('layouts.client')

@section('dashboard_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection

@section('content')
    @include('layouts.flash')

    @php
        // Expecting all required data precomputed by service/controller:
        // $session, $progress, $documents, $labels, $names, $route, $user

        // Fallback defaults for robust rendering if any key is missing
        $session = isset($session) && is_array($session) ? $session : [];
    
        $progress =
            isset($progress) && is_array($progress)
                ? $progress
                : ['all_percentage' => 0, 'class' => '', 'message' => '0%', 'width' => 100];
               
        $documents = isset($documents) && is_array($documents) ? $documents : ['signed_sent' => false];
        $labels =
            isset($labels) && is_array($labels)
                ? $labels
                : ['debtor_tab_name' => 'Debtor', 'codebtor_tab_name' => 'Co-Debtor', 'spouse_tab_text' => 'Co-Debtor'];
        $names =
            isset($names) && is_array($names)
                ? $names
                : ['debtor' => "Debtor's", 'spouse' => "Co-Debtor's", 'part_a' => [], 'part_b' => []];

        // User meta (fallback to auth user to avoid undefined vars)

    @endphp

    @unless (isset($user) && is_array($user))
        @php
            $u = auth()->user();
            $user = [
                'id' => $u?->id,
                'name' => $u?->name,
                'client_type' => $u?->client_type,
                'client_subscription' => $u?->client_subscription,
                'phone_no' => $u?->phone_no,
                'email' => $u?->email,
                'hide_questionnaire' => $u?->hide_questionnaire,
            ];
        @endphp
    @endunless

    @php
        $web_view = !empty($session['web_view']);
        $userJustLogin = !empty($session['user_just_login']);

        $progress_percentage = (int) ($progress['all_percentage'] ?? 0);
        $class = (string) ($progress['class'] ?? '');
        $msg = (string) ($progress['message'] ?? $progress_percentage . '%');
        $width = (int) ($progress['width'] ?? ($progress_percentage === 0 ? 100 : $progress_percentage));

        $debtorTabName = $labels['debtor_tab_name'] ?? 'Debtor';
        $codebtorTabName = $labels['codebtor_tab_name'] ?? 'Co-Debtor';
        $spouseTabText = $labels['spouse_tab_text'] ?? 'Co-Debtor';
        $signeddocuments = !empty($documents['signed_sent']);

        // Commonly referenced convenience vars (backward compatibility)
        $client_subscription = $user['client_subscription'] ?? null;
        $client_type = $user['client_type'] ?? null;
        $authUserHideQuestionnaire = (int) ($user['hide_questionnaire'] ?? 0);
        // Backward-compat convenience variables for partials/sub-views
        $authUser = isset($authUser) ? $authUser : Auth::user();
        $client_id = $user['id'] ?? ($authUser?->id ?? null);
        $client_subscription = $user['client_subscription'] ?? ($authUser?->client_subscription ?? null);
        $client_type = $user['client_type'] ?? ($authUser?->client_type ?? null);
        $phone_no = $user['phone_no'] ?? ($authUser?->phone_no ?? null);
        $email = $user['email'] ?? ($authUser?->email ?? null);

        // Safe defaults for include payloads to prevent undefined variable notices
        $info = isset($info) ? $info : [];
        $resident = isset($resident) ? $resident : [];
        $debts = isset($debts) ? $debts : [];
        $income = isset($income) ? $income : [];
        $expenses = isset($expenses) ? $expenses : [];
        $averagePriceList = isset($averagePriceList) ? $averagePriceList : [];
        $tab = isset($tab) ? $tab : $route['tab'] ?? null;
        $step = isset($step) ? $step : $route['step'] ?? null;
    @endphp



    <div class="row">

        @if ($web_view)
            <div
                class="d-flex align-items-center col-md-12 col-sm-12 col-lg-12 col-xl-12 mb-2 {{ $web_view ? '' : 'mt-4' }}">
                <a href="{{ route('pre_client_dashboard') }}" class="btn-new-ui-default me-2 btn-primary">
                    <i class="fa fa-arrow-left mr-1"></i>Back To Dashboard</a>
                <div class="google-translate-div ml-auto">
                    <div class="language-select">
                        <div id="google_translate_element">

                        </div>
                    </div>
                </div>
            </div>
        @endif
        @unless ($web_view)
            <div class=" hide-on-desktop show-on-mobile align-items-center col-md-12 col-sm-12 col-lg-12 col-xl-12 pb-2 mb-2">
                <a href="{{ route('pre_client_dashboard') }}" class="btn-new-ui-default me-2 btn-primary">
                    <i class="fa fa-arrow-left mr-1"></i>Back To Dashboard</a>

            </div>
        @endunless

        @php $requestedDocuments = isset($docsUploadInfo["requestedDocuments"]) ? $docsUploadInfo["requestedDocuments"] : []; @endphp
        @if (!$web_view && !empty($requestedDocuments))
            <div class="col-md-12 mb-2 hide-on-web show-on-mobile">
                <a style="background-color:#fff;border-radius: var(--border-radius);" class="nav-link  blinking"
                    href="{{ route('list_uploaded_documents') }}">
                    <h5 class="text-c-blue mb-0 p-2">Click to see requested Docs <i
                            class="fa text-c-red blink fa-exclamation-triangle mb-0" aria-hidden="true"></i></h5>
                </a>
            </div>
        @endif

        <div class="col-12">

            @php
                $debtorname = $names['debtor'] ?? "Debtor's";
                $spousename = $names['spouse'] ?? "Co-Debtor's";
            @endphp

            @if (
                $client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION &&
                    $authUserHideQuestionnaire == 0)
                @if ($tab == 'tab1')
                    @include('client.questionnaire.tab1', $info)
                @endif
                @if ($tab == 'tab2')
                    @include(
                        'client.questionnaire.tab2',
                        array_merge($resident, [
                            'debtorname' => $names['debtor'] ?? "Debtor's",
                            'spousename' => $names['spouse'] ?? "Co-Debtor's",
                        ]))
                @endif
                @if ($tab == 'tab3')
                    @if ($step == 'step1')
                        @include('client.questionnaire.tab3', $debts)
                    @endif
                    @if ($step == 'step2')
                        @include(
                            'client.questionnaire.debt.debt_step2',
                            array_merge($debts, [
                                'debtorname' => $names['debtor'] ?? "Debtor's",
                                'spousename' => $names['spouse'] ?? "Co-Debtor's",
                            ]))
                    @endif
                @endif
            @endif

            @if ($tab == 'tab4')
                @include(
                    'client.questionnaire.tab4',
                    array_merge($income, [
                        'debtorname' => $names['debtor'] ?? "Debtor's",
                        'spousename' => $names['spouse'] ?? "Co-Debtor's",
                        'spouseTabText' => $labels['spouse_tab_text'] ?? 'Co-Debtor',
                    ]))
            @endif

            @if (
                $client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION &&
                    $authUserHideQuestionnaire == 0)
                @if ($tab == 'tab5')
                    @include('client.questionnaire.tab5', [$expenses, $averagePriceList, $client_type])
                @endif
                @if ($tab == 'tab6')
                    @include('client.questionnaire.tab6')
                @endif
                @if ($tab == 'tab7')
                    @include('client.questionnaire.tab7', [$averagePriceList, $client_type])
                @endif
            @endif

        </div>
    </div>

    @include('modal.client.signed_document')

    <x-client.welcome />
    
    <!-- Modal -->
    @include('modal.common.questionnaire_confirmation_prompt')
    @include('modal.common.property_notice_prompt')

@endsection

@section('dasbhoard_scripts')
    <script>
        window.userJustLogin = @json($userJustLogin ? true : false);
        window.web_view = @json($web_view ? true : false);
        window.update_attorney_doc_view_status_url = "{{ route('update_attorney_doc_view_status') }}";
    </script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
