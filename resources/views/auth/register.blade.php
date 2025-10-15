@extends('layouts.app')
@section('content')
@include("layouts.flash")
<link rel="stylesheet" href="{{ asset('assets/css/guest-css.css')}}">

<div class="at_signup">
   <div class="row m-0 py-0">
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
                  <div class="col-auto">
                     <p class="mb-0">Copyright © <?php echo date('Y'); ?> BK Assistant</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 page-flex__right">
            <div class="px-md-5 py-4">
               <form method="POST" id="register_form" action="{{ route('register',['package_id'=> basename(request()->path())]) }}">
                  <div>
                     @csrf
                     <div class="form_bg">
                        <div class="login-title">
                           <h3 class="text-center">Welcome To BK Assistant, Inc.</h3>
                           <p class="text-center">
                              <em>Bringing 21st Century Technology To The Bankruptcy Business</em>
                           </p>
                        </div>
                        <h1 class="text-center fs-26 mb-2">
                           Create an account
                        </h1>
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <label for="name-f">Attorney Name</label>
                              <div class="form-group">
                                 <input id="name" type="text" maxlength="50" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Username">
                              </div>
                              @if ($errors->has('name'))
                              <p class="help-block text-danger">{{ $errors->first('name') }}</p>
                              @endif
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="name-f">Email</label>
                              <div class="form-group">
                                 <input id="email" type="email" maxlength="255" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                              </div>
                              @if ($errors->has('email'))
                              <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                              @endif
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="name-f">Law Firm Name</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" maxlength="50" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" placeholder="Company Name">
                              </div>
                              @if ($errors->has('company_name'))
                              <p class="help-block text-danger">{{ $errors->first('company_name') }}</p>
                              @endif
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="name-f">Password</label>
                              <div class="form-group">
                                 <input id="password" type="password" maxlength="50" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">
                              </div>
                              @if ($errors->has('password'))
                              <p class="help-block text-danger">{{ $errors->first('password') }}</p>
                              @endif
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="font-weight-bold">Address 1</label>
                                 <input type="text" class="form-control mb-4" maxlength="150" name="attorney_address" placeholder="Address 1" value="{{old('attorney_address')}}">
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <label class="font-weight-bold">Address 2</label>
                              <input type="text" class="form-control mb-4" maxlength="150" name="attorney_address2" placeholder="Address 2" value="{{old('attorney_address2')}}">
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="font-weight-bold">City </label>
                                 <input type="text" class="form-control mb-4 required" maxlength="50" name="attorney_city" required value="{{old('attorney_city')}}"
                                    placeholder="City ">
                              </div>
                              @if ($errors->has('attorney_city'))
                              <p class="help-block text-danger">{{ $errors->first('attorney_city') }}</p>
                              @endif
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="font-weight-bold">State </label>

                                 <select class="form-control required" required name="attorney_state">
                                    <option value="">Please Select State</option>
                                    <?php echo AddressHelper::getStatesList(old('attorney_state')); ?>

                                 </select>
                              </div>
                              @if ($errors->has('attorney_state'))
                              <p class="help-block text-danger">{{ $errors->first('attorney_state') }}</p>
                              @endif
                           </div>
                           <div class="col-sm-3">
                              <div class="form-group">
                                 <label class="font-weight-bold">Zip </label>
                                 <input type="number" class="form-control required allow-5digit mb-4" required name="attorney_zip" value="{{old('attorney_zip')}}"
                                    placeholder="Zip ">
                              </div>
                              @if ($errors->has('attorney_zip'))
                              <p class="help-block text-danger">{{ $errors->first('attorney_zip') }}</p>
                              @endif
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="font-weight-bold">Phone #</label>
                                 <input required type="text" required class="phone-number-field required form-control mb-4" name="attorney_phone" value="{{old('attorney_phone')}}"
                                    placeholder="Phone ">
                              </div>
                              @if ($errors->has('attorney_phone'))
                              <p class="help-block text-danger">{{ $errors->first('attorney_phone') }}</p>
                              @endif
                           </div>
                           <div class="col-sm-4">
                              <label class="font-weight-bold">Fax # </label>
                              <input type="text" class="phone-number-field form-control mb-4" name="attorney_fax" value="{{old('attorney_fax')}}"
                                 placeholder="Fax ">
                              @if ($errors->has('attorney_fax'))
                              <p class="help-block text-danger">{{ $errors->first('attorney_fax') }}</p>
                              @endif
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label class="font-weight-bold">State Bar # </label>
                                 <input type="text" class="form-control mb-4 required" name="state_bar" maxlength="17" required value="{{old('state_bar')}}"
                                    placeholder="State Bar ">
                              </div>
                              @if ($errors->has('state_bar'))
                              <p class="help-block text-danger">{{ $errors->first('state_bar') }}</p>
                              @endif
                           </div>
                        </div>
                        @if(config('services.recaptcha.key'))
                        <div class="col-md-12 form-group mb-4 g-recaptcha"
                           data-sitekey="{{config('services.recaptcha.key')}}">
                        </div>
                        @endif
                        @if ($errors->has('g-recaptcha-response'))
                        <p class="help-block text-danger">
                           <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </p>
                        @endif
                        <div class="col-md-12  scales_p  mb-4">
                           <div class="form-group">
                              <input type="checkbox" id="scales" name="scales" required>

                              <label for="scales">
                                 <a class="link-underline text-blue" href="{{route('terms_of_services')}}" target="_blank">
                                    By signing up, you confirm that you've read and accepted our Terms of Service
                                 </a>
                              </label>
                           </div>
                        </div>
                        <div class="col-md-12 form-group mb-4">
                           <div class="login-btn action-auth">
                              <button class="btn btn-primary shadow-2" type="submit">Sign up</button>
                              <p class="mb-0 text-muted">Already have an account? <a href="{{ route('login') }}"> Log in</a></p>
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

   #register_form .form-group,
   .scales_p label {
      margin-bottom: 0px;
   }

   input::-webkit-outer-spin-button,
   input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
   }

   input[type=number] {
      -moz-appearance: textfield;
   }
</style>
@endsection