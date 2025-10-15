@extends('layouts.app')
@section('content')
@include("layouts.flash")

<link rel="stylesheet" href="{{ asset('assets/css/guest-css.css')}}">

<div class="containerr">
    <div class="row m-0 py-0">
        <div class="page-flex">
            <div class="page-flex__left col-md-6">
                <div class="page-map">
                    <img class="attorney_login_img" alt="Bankruptcy Software for Law Firms" src="{{ asset('assets/img/attorney-login.png')}}">
                </div>
                <div class="form_image_colm">
                    <div class="form_image_moble">
                        <img alt="Bankruptcy Software for Law Firms" src="{{ asset('assets/img/attorney-login.png')}}">
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
                        <div class="col-auto">
                            <p class="mb-0">Copyright © <?php echo date('Y'); ?> BK Assistant</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 page-flex__right">
                <div class="form_colm px-md-5 py-4">
                    <form id="attorney_login_form" method="POST" action="{{ route('login') }}">
                        <div>
                            @csrf
                            <div class="form_bg">
                                <div class="login-title">
                                    <h1 class="mb-3 mt-3 fs-30 h1-color">Law Firm Login</h1>

                                </div>
                                <div class="input-group mb-3 form-group">
                                    <input required id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                </div>
                                <input id="uuid_token" type="hidden" class="form-control" name="uuid_token" value="">
                                @if ($errors->has('email'))
                                <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                                @endif
                                <div class="input-group mb-4 form-group">
                                    <input required id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                    <i class="fas fa-eye" id="togglePassword" style="margin: auto;font-size:16px;width:5%;text-align:center;color:#012cae; cursor: pointer;"></i>
                                </div>
                                @if ($errors->has('password'))
                                <p class="help-block text-danger">{{ $errors->first('password') }}</p>
                                @endif
                                <div class="login-btn action-auth">
                                    <button class="btn btn-primary shadow-2 mb-4" type="submit">Login</button>
                                </div>
                                <div class="forget-pass">
                                    <p class="mb-0 text-muted"> <a href="{{ route('password.request') }}">Click here to change your password</a></p>
                                </div>
                                <div class="or-test text-center ">
                                    <p class="mb-0 text-muted">Or </p>
                                </div>
                                <div class="no-account">
                                    <p class="mb-0 text-muted">Don’t have an account? <a href="<?php echo route('register', ['package_id' => 'standard']); ?>">Signup</a></p>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <style>
                    label.error {
                        color: red;
                        font-style: italic;
                        font-weight: normal;
                    }
                    #register_form .form-group,
                    .scales_p label {
                        margin-bottom: 0px;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
@endsection