@extends('layouts.intake_form')
@section('content')


    <form name="one_page_questionnaire" id="one_page_questionnaire" action="{{route('intake_form_save', ['stepNo' => $stepNo, 'userId' => $userId])}}" method="post" novalidate enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="a_token" value="{{ $token ?? '' }}">
        <input type="hidden" name="session_id" value="{{ session()->getId() }}">

        @include('intake_form.sections.consultation_instructions')
        
        @include('intake_form.sections.timer')
        
        @include('intake_form.sections.notice')
        
        @include('intake_form.sections.monthly_income_debtor')

        @include('intake_form.sections.monthly_income_spouse')
        
        @include('intake_form.sections.mortgage')
        
        @include('intake_form.sections.vehicles')

        @include('intake_form.sections.other_property')

        @include('intake_form.sections.submit')

    </form>

    <script>
        $(document).ready(function () {
            var msValue = "{{ $martial_status }}";
            updateD2InfoClasses(msValue)
        });
    </script>

@endsection