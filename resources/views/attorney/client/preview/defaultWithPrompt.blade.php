@php
    $step1Submitted = Helper::validate_key_value('step1', $clientCompletedSteps, 'radio');
    $step2Submitted = Helper::validate_key_value('step2', $clientCompletedSteps, 'radio');
    $step3Submitted = Helper::validate_key_value('step3', $clientCompletedSteps, 'radio');
    $step4Submitted = Helper::validate_key_value('step4', $clientCompletedSteps, 'radio');
    $step5Submitted = Helper::validate_key_value('step5', $clientCompletedSteps, 'radio');
    $step6Submitted = Helper::validate_key_value('step6', $clientCompletedSteps, 'radio');
@endphp
<div class="tab-pane fade show active" id="preview-view-all" role="tabpanel" aria-labelledby="view-all-tab" tabindex="0">
    <div class="attorney_form_submission --" id="printableArea">
        <div id="logo-img" class="col-md-12 align-center mb-4 d-none">
            @if (!empty($attorneyCompany->company_logo) && file_exists(public_path() . '/' . $attorneyCompany->company_logo))
                <img width="325px" src="{{ url($attorneyCompany->company_logo) }}" alt="Logo" />
            @else
                <img width="325px" src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
            @endif
        </div>
        @if ($step1Submitted)
            @include("attorney.form_elements.basic_info",[$basic_info,$financialaffairs_info])
        @endif
        @if ($step2Submitted)
            @include('attorney.client.preview.preview_real_property')
            @include('attorney.client.preview.preview_vehicle')
            @include('attorney.client.preview.preview_client_property')
        @endif
        @if ($step3Submitted)
            @include('attorney.client.preview.preview_debts')
        @endif
        @if ($step4Submitted)
            @include('attorney.client.preview.preview_income')
        @endif
        @if ($step5Submitted)
            @include('attorney.client.preview.preview_expense')
        @endif
        @if ($step6Submitted)
            @include('attorney.client.preview.preview_financial_affairs')
        @endif
        @if (!$step1Submitted && !$step2Submitted && !$step3Submitted && !$step4Submitted && !$step5Submitted && !$step6Submitted)
            @include('attorney.client.preview.common_not_submitted')
        @endif        
    </div>
    <ul id="questionnaire-sidebar-nav" class="nav nav-list card-body ">
        <li>
            <div class="outline-gray-border-area ">
                <label class="subtitle mb-0 font-weight-bold">{{ __('Jump to:') }}</label>
            </div>
        </li>
        <li><a class="border-bottom-light-blue text-c-black text-bold" href="#real-property">{{ __('Real Property') }}</a></li>
        <li><a class="border-bottom-light-blue text-c-black text-bold" href="#vehicles">{{ __('Vehicles') }}</a></li>
        <li><a class="border-bottom-light-blue text-c-black text-bold" href="#personal-property">Client Property</a></li>
        <li><a class="border-bottom-light-blue text-c-black text-bold" href="#scroll-debts">{{ __('Debts') }}</a></li>
        <li><a class="border-bottom-light-blue text-c-black text-bold" href="#current-income">{{ __('Income') }}</a></li>
        <li><a class="border-bottom-light-blue text-c-black text-bold" href="#current-expenses">{{ __('Expenses') }}</a></li>
        <li><a class="border-bottom-light-blue text-c-black text-bold" href="#financial-affairs">{{ __('Financial Affairs') }}</a></li>
    </ul>
</div>
<div class="tab-pane fade" id="preview-basic-information" role="tabpanel" aria-labelledby="basic-information-tab" tabindex="0">
    @if ($step1Submitted)
        @include("attorney.form_elements.basic_info",[$basic_info,$financialaffairs_info])
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>
@if (!empty($attorney_company->company_logo))
    <div class="w-100 align-center print_asset_logo d-none">
        <div class="">
            <img width="325px" src="{{url($attorney_company->company_logo)}}" alt="Logo">
        </div>
    </div>
@endif
<div class="tab-pane fade" id="preview-real-property" role="tabpanel" aria-labelledby="real-property-tab" tabindex="0">
    @if ($step2Submitted)
        @include('attorney.client.preview.preview_real_property')
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>
<div class="tab-pane fade" id="preview-vehicles" role="tabpanel" aria-labelledby="vehicles-tab" tabindex="0">
    @if ($step2Submitted)
        @include('attorney.client.preview.preview_vehicle')
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>
<div class="tab-pane fade" id="preview-personal-property" role="tabpanel" aria-labelledby="personal-property-tab" tabindex="0">
    @if ($step2Submitted)
        @include('attorney.client.preview.preview_client_property')
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>
<div class="tab-pane fade" id="preview-scroll-debts" role="tabpanel" aria-labelledby="scroll-debts-tab" tabindex="0">
    @if ($step3Submitted)
        @include('attorney.client.preview.preview_debts')
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>
<div class="tab-pane fade" id="preview-current-income" role="tabpanel" aria-labelledby="current-income-tab" tabindex="0">
    @if ($step4Submitted)
        @include('attorney.client.preview.preview_income')
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>
<div class="tab-pane fade" id="preview-current-expenses" role="tabpanel" aria-labelledby="current-expenses-tab" tabindex="0">
    @if ($step5Submitted)
        @include('attorney.client.preview.preview_expense')
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>
<div class="tab-pane fade" id="preview-financial-affairs" role="tabpanel" aria-labelledby="pills-show-hide-documents-tab" tabindex="0">
    @if ($step6Submitted)
        @include('attorney.client.preview.preview_financial_affairs')
    @else
        @include('attorney.client.preview.common_not_submitted')
    @endif
</div>