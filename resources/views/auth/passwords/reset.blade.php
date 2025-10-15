@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/guest-css.css')}}">
<div>
   <div class="container-fluid">
      <div class="row py-0 page-flex">
         <div class="page-flex__left col-md-6" style="padding: 0px">
            <div class="form_image_colm">
               <div class="form_image_moble" style="display: block">
                  <img src="{{ asset('assets/img/attorney-login.png')}}" style="width: 100%" alt="background">
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
                </div>
            </div>
            </div>
         </div>
         <div class="col-md-6 page-flex__right">
            <div class="form_colm px-md-5 py-4">
            <form method="POST" id="reset_password" action="{{ route('password.update') }}">
    @csrf
    <div class="form_bg">
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="login-title text-center">
            <h3 class="mb-3 mt-3">Reset Password</h3>
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label text-md-right">Enter the email address you received the password reset email below:</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label">Enter new password below:</br><span class="instruct-message">(Your password needs to be at least 8 numbers and/or characters long)</span></label>
            <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePasswordVisibility('password')">
                        <i class="fa fa-eye" id="togglePassword"></i>
                    </span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-form-label">Confirm your new password below:</br><span class="instruct-message">(Your password needs to be at least 8 numbers and/or characters long)</span></label>
            <div class="input-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePasswordVisibility('password-confirm')">
                        <i class="fa fa-eye" id="togglePasswordConfirm"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group mb-0">
            <div class="offset-md-40">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
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
    label.error{color:red;font-weight:normal;}
    span.instruct-message {
        color: #00000099;
        font-size: 12px;
    }
    .input-group-text {
    cursor: pointer;
    background-color: #fff;
    border-left: none;
}
.input-group-text:hover {
    background-color: #f8f9fa;
}
.input-group-text{
    border: none;
}
</style>
<script>
   
    function togglePasswordVisibility(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(`toggle${fieldId.charAt(0).toUpperCase() + fieldId.slice(1)}`);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

$(document).ready(function(){


$("#reset_password").validate({

    errorPlacement: function (error, element) {

        if($(element).parents(".form-group").next('label').hasClass('error')){

            $(element).parents(".form-group").next('label').remove();

            $(element).parents(".form-group").after($(error)[0].outerHTML);

        }else{

            $(element).parents(".form-group").after($(error)[0].outerHTML);

        }

    },

    success: function(label,element) {

        label.parent().removeClass('error');

        $(element).parents(".form-group").next('label').remove();

    },

});
});
</script>
@endsection
