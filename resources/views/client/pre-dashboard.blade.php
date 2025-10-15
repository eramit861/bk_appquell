@extends('layouts.client')
@section('content')
@include("layouts.flash")

<!-- [ Main Content ] start -->
@php
    $progress_percentage = $progress['all_percentage'];
    $progress_percentage = ($progress_percentage + (int) ($docsProgress['progress'] ?? 0)) / 2;

    $class = '';
    if ($progress_percentage == 0) {
        $class = "bg-danger";
    }
    if ($progress_percentage > 0 && $progress_percentage < 50) {
        $class = "bg-warning";
    }
    if ($progress_percentage > 50 && $progress_percentage < 75) {
        $class = "bg-warning";
    }
    if ($progress_percentage > 75 && $progress_percentage < 90) {
        $class = "bg-info";
    }
    if ($progress_percentage == 100) {
        $class = "bg-success";
    }

    $msg = $progress_percentage . '%';
    if ($progress_percentage == 100) {
        $msg = "100%";
    }
    $width = $progress_percentage;
    if ($progress_percentage == 0) {
        $width = 100;
    }
    $web_view = Session::get('web_view');
    $removepadding = 'pl-0 pr-0';
@endphp

<div class="row" style="height:100%;">
  <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
    @include('client.left-navigation')
  </div>
</div>

@endsection

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/pre_dashboard.css') }}">
@endpush