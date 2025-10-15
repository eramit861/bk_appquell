<div class="sign_up_bgs">
   <div class="container-fluid">
      <div class="row py-0 page-flex">
         <div class="col-md-12">
            <div class="form_colm row px-md-5 py-4">
               <div class="col-md-12 mb-3">
                  <div class="title-h mt-1 d-flex">
                     <h4><strong>Change password (Recommended): </strong></h4>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="align-left">
                            <form method="POST" action="">
                            <div>
	                            @csrf
	                            <div class="form_bgp">
                                    <div class="input-group mb-3">
                                        <input id="new_password" placeholder= "New Password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="" autofocus>
                                    </div>
                                    @if ($errors->has('new_password'))
                                        <p class="help-block text-danger">{{ $errors->first('new_password') }}</p>
                                    @endif
                                    <div class="input-group mb-4">
                                        <input id="re_new_password" placeholder= "Confirm New Password" type="password" class="form-control @error('re_new_password') is-invalid @enderror" name="re_new_password">
                                    </div>
                                    @if ($errors->has('re_new_password'))
                                        <p class="help-block text-danger">{{ $errors->first('re_new_password') }}</p>
                                    @endif
                                    @php
                                        $setup_new_password_route = route('setup_new_password');
                                    @endphp
                                    <div class="login-btn action-auth">
                                        <a href="javascript:void(0)" onclick="setupNewPassword('{{ $setup_new_password_route }}')" class="btn btn-primary shadow-2 mb-4">Submit</a>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>