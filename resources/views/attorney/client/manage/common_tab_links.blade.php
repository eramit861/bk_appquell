<ul class="nav nav-pills nav-fill w-100 p-0 client_qiestioner_tabs 123" id="pills-tab" role="tablist">
    @if ($val['client_subscription']=="103")
    <li class="nav-item" role="presentation">
        <button class="nav-link text-bold {{ in_array($type, ['paystub','paystub_partner']) ? 'active' : 'tab-link-color' }}"  onclick="redirectToURL('{{ route('client_paystub', ['id' => $User['id'], 'type' => 'paystub']) }}')"
            id="payroll-assistant-tab" data-bs-toggle="pill" data-bs-target="#payroll-assistant" type="button" role="tab" aria-controls="payroll-assistant" aria-selected="true">Payroll Assistant</button>
    </li>
    @else
    <li class="nav-item" role="presentation">
        <button class="nav-link text-bold {{ $type == 'view' ? 'active' : 'tab-link-color' }}"  onclick="redirectToURL('{{ route('attorney_form_submission_view', ['id' => $val['id']]) }}')"
            id="client-questionnaire-tab" data-bs-toggle="pill" data-bs-target="#client-questionnaire" type="button" role="tab" aria-controls="client-questionnaire" aria-selected="true">Client Questionnaire</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-bold {{ $type == 'documents' ? 'active' : 'tab-link-color' }}"  onclick="redirectToURL('{{ route('attorney_client_uploaded_documents', ['id' => $val['id']]) }}')"
            id="uploaded-docs-tab" data-bs-toggle="pill" data-bs-target="#uploaded-docs" type="button" role="tab" aria-controls="uploaded-docs" aria-selected="true">
            Uploaded Client Documents
        </button>
        @if (isset($unreadDoccount) && $unreadDoccount > 0)
            <span class="noti_count blink text-c-white">New Document(s) Received</span>
        @endif
    </li>

    @php
        $dt = request()->route('dType') == 2 ? 2 : 1;
        $dtReport = \App\Models\CrsCreditReport::getIsAllCreditorsImportedCount($val['id'], $dt);
        $totalCount = (int)Helper::validate_key_value('totalCount', $dtReport, 'radio');
        $dtCount = (int)Helper::validate_key_value('report', $dtReport, 'radio');
        $allImportedClass = empty($dtCount) ? 'red-tab mb-0' : 'green-tab mb-0';
        $activeClass = request()->routeIs('attorney_edit_client_report') ? 'active' : 'tab-link-color';
    @endphp

    <li class="nav-item" role="presentation">
        <button class="nav-link {{$allImportedClass}} text-bold {{ $activeClass }} {{ $activeClass != 'active' && !empty($dtCount) ? 'blink' : '' }}" onclick="redirectToURL('{{ route('attorney_edit_client_report', ['id' => $val['id'], 'dType' => 1]) }}')"
            id="uploaded-docs-tab" data-bs-toggle="pill" data-bs-target="#uploaded-docs" type="button" role="tab" aria-controls="uploaded-docs" aria-selected="true">Current Creditors
        {{ $totalCount > 0 ? '(' . $totalCount . ')' : '' }}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-bold {{ in_array($type, ['paystub','paystub_partner']) ? 'active' : 'tab-link-color' }}"  onclick="redirectToURL('{{ $payrollRoute }}')"
            id="uploaded-docs-tab" data-bs-toggle="pill" data-bs-target="#uploaded-docs" type="button" role="tab" aria-controls="uploaded-docs" aria-selected="true">
            Employer/Payroll Management

        </button>
        @php
            $pFlagClass = 'flag-blue';
            $pFlagText = 'Income Calculated';
            if (isset($payStubAIStatus) && $payStubAIStatus['in_progress'] > 0) {
                $pFlagClass = 'flag-purple';
                $pFlagText = 'Calculating Income';
            }
            if (isset($payStubAIStatus) && $payStubAIStatus['need_attention']) {
                $pFlagClass = '';
                $pFlagText = 'Attention Needed';
            }
            if (isset($payStubAIStatus) && $payStubAIStatus['paystub_ai_started'] == false) {
                $pFlagClass = '';
                $pFlagText = 'Income Not Calculated';
            }
            if (isset($payStubAIStatus) && $payStubAIStatus['no_paystub_uploaded_yet']) {
                $pFlagClass = '';
                $pFlagText = '';
            }
        @endphp
        <span class="noti_count {{ $pFlagClass }}">{{ $pFlagText }}</span>
        @if ((isset($val['argyle_invalid_credential_self']) && !empty($val['argyle_invalid_credential_self'])) || (isset($val['argyle_invalid_credential_spouse']) && !empty($val['argyle_invalid_credential_spouse'])))
            <span class="noti_count">{{ __('Invalid Credentials') }}</span>
        @endif
    </li>
    @if ($attorney_enabled_bank_statment == 1 && (Auth::user()->enable_free_bank_statements || ((in_array($val['client_bank_statements'], [Helper::BANK_STATEMENTS_DEBTOR,Helper::BANK_STATEMENTS_BOTH]) || in_array($val['client_profit_loss_assistant'], [Helper::PROFIT_LOSS_ASSISTANT_TYPE_DEBTOR,Helper::PROFIT_LOSS_ASSISTANT_TYPE_BOTH])) || (in_array($val['client_bank_statements'], [Helper::BANK_STATEMENTS_CODEBTOR,Helper::BANK_STATEMENTS_BOTH]) || in_array($val['client_profit_loss_assistant'], [Helper::PROFIT_LOSS_ASSISTANT_TYPE_CODEBTOR,Helper::PROFIT_LOSS_ASSISTANT_TYPE_BOTH])))) )
        <li class="nav-item" role="presentation">
            <button class="nav-link text-bold {{ $type == 'bank-statement' ? 'active' : 'tab-link-color' }}"  onclick="redirectToURL('{{ route('bank_statement_index', ['debtor',$val['id'],'last-2',$val['client_subscription']]) }}')"
                id="uploaded-docs-tab" data-bs-toggle="pill" data-bs-target="#uploaded-docs" type="button" role="tab" aria-controls="uploaded-docs" aria-selected="true">Bank Statements</button>
        </li>
    @endif
    @if (!empty($totals) && $totals == 6)
    <li class="nav-item" role="presentation">
        <button class="nav-link text-bold tab-link-color"  onclick="redirectToURL('{{ route('attorney_offical_form', ['id' => $val['id']]) }}')"
            id="uploaded-docs-tab" data-bs-toggle="pill" data-bs-target="#uploaded-docs" type="button" role="tab" aria-controls="uploaded-docs" aria-selected="true">Petition Preparation System</button>
    </li>
    @endif
    @endif
    <li class="nav-item" role="presentation">
        <button class="nav-link text-bold {{ $type == 'signed' ? 'active' : 'tab-link-color' }}"  onclick="redirectToURL('{{ route('attorney_signed_doc', ['id' => $val['id']]) }}')"
            id="uploaded-docs-tab" data-bs-toggle="pill" data-bs-target="#uploaded-docs" type="button" role="tab" aria-controls="uploaded-docs" aria-selected="true">
            Attorney/Client DOC Portal

        </button>
        @if (isset($unreadcount) && $unreadcount > 0)
                <span class="noti_count blink text-c-white">{{ __('New Document(s) Received') }}</span>
        @endif
    </li>
</ul>

<style>

    /* Ensure the parent container allows vertical overflow */
    .scrollable-tabs {
      overflow-x: auto;
      overflow-y: visible;
      white-space: nowrap; /* Prevent tabs from wrapping */
    }

    /* Add some padding to the tabs container */
    .nav-pills {
      padding-bottom: 20px; /* Add space for the badge */
    }
    .scrollable-tabs {
  position: relative;
}

.scrollable-tabs::after {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  width: 20px;
  background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
  pointer-events: none;
}

.noti_count.blink.text-c-white{
    color: #fff;
}
</style>
