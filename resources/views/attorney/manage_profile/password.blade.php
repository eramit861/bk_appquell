<form name="update_password_frm" id="update_password_frm" action="{{route('attorney_update_password')}}" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="light-gray-div mt-3">
        <h2>Change Password</h2>
        <div class="row gx-3">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Old Password') }} </label>
                        <input type="password" class="form-control required"
                            placeholder="{{ __('Old Password') }} " name="password" value="">
                    </div>
                    @if ($errors->has('password'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('New Password') }} </label>
                        <input type="password" class="form-control required"
                            placeholder="{{ __('New Password') }} " name="new_password" value="">
                    </div>
                    @if ($errors->has('new_password'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('new_password') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Re-Enter New Password') }} </label>
                        <input type="password" class="form-control required"
                            placeholder="{{ __('Re-Enter New Password') }} " name="confirm_password" value="">
                    </div>
                    @if ($errors->has('confirm_password'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('confirm_password') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Update Password</span></button>
    </div>
</form>