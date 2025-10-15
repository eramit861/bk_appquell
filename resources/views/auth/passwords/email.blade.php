@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/guest-css.css')}}">
<div>
   <div class="container-fluid">
      <div class="row py-0 page-flex">
         <div class="page-flex__left col-md-6" style="padding: 0px">
            <div class="form_image_colm">
               <div class="form_image_moble" style="display: block">
                  <img src="{{ asset('assets/images/att-pw.jpg')}}" alt="att-pw" style="width: 100%">
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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                    <div>
                     @csrf
                     <div class="form_bg">
                     <div class="login-title">
					        <h1 class="mb-3 mt-3 fs-30 h1-color">Reset Password</h1>

				        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="email" placeholder="Enter Email address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="login-btn action-auth">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
@endsection
