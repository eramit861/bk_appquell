@extends('layouts.intake_form')
@section('content')


    <form name="one_page_questionnaire" id="one_page_questionnaire" action="{{route('intake_form_save', ['stepNo' => $stepNo, 'userId' => $userId])}}" method="post" novalidate>
        @csrf

        <input type="hidden" name="a_token" value="{{ $token ?? '' }}">

        @include('intake_form.sections.consultation_instructions')
        
        @include('intake_form.sections.timer')
        
        @include('intake_form.sections.notice')

        @include('intake_form.sections.secured_loan')

        @include('intake_form.sections.back_tax')

        @include('intake_form.sections.other_debt')

        @include('intake_form.sections.submit')

    </form>

    <script>
        $(document).ready(function () {
            var msValue = "{{ $martial_status }}";
            updateD2InfoClasses(msValue)
        });
    </script>

@endsection