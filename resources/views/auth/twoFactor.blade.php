@extends('layouts.app')
@section('content')
@include("layouts.flash")
<link rel="stylesheet" href="{{ asset('assets/css/guest-css.css')}}">
<div class="at_signup">

      <div class="row py-0">
      <div class="page-flex">
         <div class="page-flex__left col-md-6 pr-0">

         <div class="page-map">
         <img src="{{ asset('assets/img/attorney-signup.png')}}" alt="attorney-signup">
             </div>
            <div class="form_image_colm">
               <div class="form_image_moble">
                  <img src="{{ asset('assets/img/attorney-signup.png')}}" alt="attorney-signup">
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
    <p class="mb-0">Copyright © <?php echo date('Y'); ?> BK Assistant</p>
</div>            </div>
        </div>
         </div>
         <div class="col-md-6 page-flex__right">
            <div class="px-md-5 py-4">
               <form method="POST" id="register_form" action="{{ route('verify.store') }}">
                  <div>
                     @csrf
                     <div class="form_bg">
                        <div class="login-title">
                           <h3 class="text-center">Two Factor Verification</h3>
                            <p class="text-center">
                                You have received an email which contains two factor login code.
                                If you haven't received it, press <a href="{{ route('verify.resend') }}">here</a>.
                            </p>
                        </div>



                        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-lock"></i>
            </span>
        </div>
        <input name="two_factor_code" type="text"
            class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}"
            required autofocus placeholder="Two Factor Code">
        @if($errors->has('two_factor_code'))
            <div class="invalid-feedback">
                {{ $errors->first('two_factor_code') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-6">
            <button type="submit" class="btn btn-primary px-4">
                Verify
            </button>
        </div>
    </div>


                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
label.error {
    color: red;
    font-style: italic;
    font-weight: normal;
}
#register_form .form-group,.scales_p label{margin-bottom: 0px;}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type=number]{
    -moz-appearance: textfield;
}
</style>

@endsection
