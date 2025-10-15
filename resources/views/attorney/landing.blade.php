@extends('layouts.app')
@section('content')
@include("layouts.flash")
<link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}?v=1.2">
<link rel="stylesheet" href="{{ asset('assets/css/guest-css.css')}}">

<div class="sign_up_bg">
   <div class="container-fluid">
      <div class="row py-0 page-flex">
         <div class="page-flex__left col-md-6">
            <div class="form_image_colm">
               <div class="form_image_moble">   
                  <img src="{{ asset('assets/images/sign-up-img.jpg')}}" alt="Sign up">
               </div>
            </div>
			<div class="page-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
    <div class="socials-icons">
        <ul>
        </ul>
    </div>
</div>
<div class="col-auto pr-0">
    <p class="mb-0">Copyright © <?php echo date('Y'); ?> {{ __('BK Assistant') }}</p>
</div>            </div>
        </div>
         </div>
         <div class="col-md-6 page-flex__right">
            <div class="form_colm px-md-5 py-4">
            <div class="form_bg">
            <div class="login-title- mt-3">
                    @include("terms", ['company' => $company])
            </div>
            <div class="modal-footer">
                <form action="{{ route('attorney_landing',['package_id'=>(isset($_REQUEST['package_id'])?$_REQUEST['package_id']:'')]) }}" method="post">
                @csrf
                <input required class="required" type="checkbox" name="agreed" value="1" />
                    By clicking continue you agree to the terms of service contained herein.
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn font-weight-bold border-blue-big" data-bs-dismiss="modal">{{ __('Continue') }}</button>
                </form>
            </div>
            </div>







         </div>
      </div>
   </div>
</div>
</div>
<style>
    .page-flex__right{max-height:816px; overflow-y: scroll;display:block;padding:0px;}
    .form_colm{padding-left:3rem !important;padding-right:3rem !important;}
</style>
@endsection