@extends('layouts.intake_form')
@section('content')
@php
    $showDebtorSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'debtor_ssn');
    $showDebtorDL = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'licence_or_id');
    $showSpouseSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'codebtor_ssn');
    $showEmergencySection = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'emergency_checks');
    $showDiscoverUsSection = \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'discover_us');
    $attorney_privacy_policy_url = Helper::validate_key_value('attorney_privacy_policy_url', $attorney_company);
@endphp

    <form name="one_page_questionnaire" id="one_page_questionnaire" action="{{route('intake_form_save', ['stepNo' => $stepNo, 'userId' => $userId])}}" method="post" novalidate>
        @csrf

        <input type="hidden" name="a_token" value="{{ $token ?? '' }}">

        @include('intake_form.sections.consultation_instructions')
        
        @include('intake_form.sections.consent')
        
        @include('intake_form.sections.timer')
        
        @include('intake_form.sections.notice')
        
        @include('intake_form.sections.basic_info_debtor')

        @include('intake_form.sections.marital_status')

        @include('intake_form.sections.basic_info_spouse')

        @include('intake_form.sections.emergency_checks')

        @include('intake_form.sections.discover_us')

        @include('intake_form.sections.submit')

    </form>

    <script>
        $(document).ready(function () {
            var msValue = "{{ $martial_status }}";
            updateD2InfoClasses(msValue)
        });
    </script>
    
@endsection