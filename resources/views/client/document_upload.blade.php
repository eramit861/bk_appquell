@extends('layouts.client')
@section('content')
   @include('layouts.flash')
   @php
      $refreenceParent = Session::get('refrence_parent');
      $refreenceAdmin = Session::get('refrence_admin');
      $client_id = Auth::user()->id;
      $user = Auth::user();
   @endphp

   @if (@$refreenceParent > 0)
      <div class="row">
         @if (@\App\Models\User::where('id', $refreenceParent)->value('role') != 1)
               <div class="col-md-12">
                  <p class="py-3 mb-0" style="text-align:right;">You're logged in to your client questionnaire. <a
                           class="go-back-to-parent-btn"
                           href="{{ route('attorney_login_dashboard', ['id' => $refreenceParent]) . '?q=' . Auth::user()->id }}">CLICK
                           HERE</a> to go back in your attorney side.</p>
               </div>
         @endif
         @if (@\App\Models\User::where('id', $refreenceAdmin)->value('role') == 1)
               <div class="col-md-12">
                  <p class="py-3 mb-0" style="text-align:right;">You're logged in to your client questionnaire. <a
                           class="go-back-to-parent-btn"
                           href="{{ route('admin_login_dashboard', ['id' => $refreenceAdmin]) . '?q=' . Auth::user()->id }}">CLICK
                           HERE</a> to go back in your admin side.</p>
               </div>
         @endif
      </div>
   @endif
   <div class="row mb-2">
      <div class=" col-md-6 col-lg-6 col-sm-12 col-xs-12 mb-0 mt-1 text-left">
         <h3 class="mb-0 text-c-blue">Welcome, {{ auth()->user()->name }}</h3>
      </div>
      <div class=" col-md-6 col-lg-6 col-sm-12 col-xs-12  mb-0 mt-1  text-right pt-1">
         <a class="btn-new-ui-default mt-3 text-bold" href="{{ route('client_dashboard') }}">Go to your Questionnaire</a>
      </div>
   </div>
   @include('client.doc_upload_layout')
   @include('client.common_client_upload_view', [
      'docsUploadInfo' => $docsUploadInfo,
      'client_id' => $client_id,
      'isManualPage' => false,
   ])

   <!-- modal -->
   @include('client.uploaddoc_mode', ['max_size' => 200, 'isManual' => false])

   <!-- default popup shows each time -->
   @include('modal.common.document_screen_notice_prompt')

   @push('tab_styles')
       <link rel="stylesheet" href="{{ asset('assets/css/client/document_upload.css') }}">
   @endpush

   @push('tab_scripts')
       <script src="{{ asset('assets/js/client/document_upload.js') }}"></script>
   @endpush
@endsection
