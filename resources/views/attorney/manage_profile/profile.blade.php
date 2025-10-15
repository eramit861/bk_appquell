<form name="company_profile_frm" id="company_profile_frm" action="{{route('attorney_company_profile')}}" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <input type="hidden" name="company_id" value="{{ !empty($attorney_company->id) ? $attorney_company->id : '' }}">
    <div class="light-gray-div mt-3">
        <h2>Update Profile Logo</h2>
        @php $enable_custom_login_page_slug = isset($attorney_settings->custom_login_slug) && !empty($attorney_settings->custom_login_slug) ? 1 : 0; @endphp
        <div class="row gx-3">
            <div class="col-12">
                <div class="align-items-center row">
                    <div class="questionnaire-logo text-center mb-3 p-0 col-12 col-md-3 col-lg-2 col-xxl-1">
                        @if (!empty($attorney_company->company_logo) && file_exists(public_path() . '/' . $attorney_company->company_logo))
                            <img class="w-auto" src="{{url($attorney_company->company_logo)}}" alt="{{ __('User profile picture') }}">
                        @else
                            <img class="w-auto" src="{{url('assets/images/user/avatar-2.jpg')}}" alt="{{ __('User profile picture') }}">
                        @endif
                    </div>

                    <div class="avatar-edit  col-sm-6 col-md-5 col-lg-4 col-xl-3">
                        <input type='file' name="company_logo" id="imageUpload" accept=".png, .jpg, .jpeg" class="hide-data" />
                        <input type='hidden' name="cropCompanyLogoImage" id="cropCompanyLogoImage" />
                        <label class="btn font-weight-bold border-blue-big btn-new-ui-default w-md-less-100" for="imageUpload"><span class="">{{ __('Upload Picture') }}</span></label>
                        <br><span>{{ __('JPG, GIF or PNG. Max size of 5MB') }}</span>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-3 col-xl-2 ">
                        <button type="submit" class="btn font-weight-bold border-blue-big btn-new-ui-default w-md-less-100 btn-green"><span class="">Save Uploaded Logo</span>
                        </button>
                        <br><span>&nbsp;</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="light-gray-div mt-3">
        <h2>Update Profile</h2>
        <div class="row gx-3">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Law Firm Name') }} </label>
                        <input required type="text" class="form-control" maxlength="50" name="company_name" value="{{old('company_name',(!empty($attorney_company->company_name))?$attorney_company->company_name:'')}}"
                            placeholder="{{ __('Law Firm Name') }} ">
                    </div>
                    @if ($errors->has('company_name'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('company_name') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class=""> {{ __('Attorney Name') }} </label>
                        <input required type="text" class="form-control " maxlength="50" name="attorney_name" value="{{old('card_name',(!empty(auth()->user()->name))?auth()->user()->name:'')}}"
                            placeholder="{{ __('Attorney Name') }} ">
                    </div>
                    @if ($errors->has('attorney_name'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_name') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('State Bar #') }} </label>
                        <input type="text" class="form-control " maxlength="17" name="state_bar" value="{{old('card_name',(!empty($attorney_company->state_bar))?$attorney_company->state_bar:'')}}"
                            placeholder="{{ __('State Bar') }} ">
                    </div>
                    @if ($errors->has('state_bar'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('state_bar') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Address 1') }}</label>
                        <input type="text" class="form-control " maxlength="150" name="attorney_address"
                            placeholder="{{ __('Address 1') }}" value="{{old('attorney_address',(!empty($attorney_company->attorney_address))?$attorney_company->attorney_address:'')}}">
                    </div>
                    @if ($errors->has('attorney_address'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_address') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Address 2') }}</label>
                        <input type="text" class="form-control " maxlength="150" name="attorney_address2"
                            placeholder="{{ __('Address 2') }} " value="{{old('attorney_address2',(!empty($attorney_company->attorney_address2))?$attorney_company->attorney_address2:'')}}">
                    </div>
                    @if ($errors->has('attorney_address2'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_address2') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('City') }} </label>
                        <input type="text" class="form-control " maxlength="50" name="attorney_city" value="{{old('attorney_city',(!empty($attorney_company->attorney_city))?$attorney_company->attorney_city:'')}}"
                            placeholder="{{ __('City') }} ">
                    </div>
                    @if ($errors->has('attorney_city'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_city') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('State') }} </label>
                        <select class="form-control required" name="attorney_state">
                            <option value="">{{ __('Please Select State') }}</option>
                            {!! AddressHelper::getStatesList(@$attorney_company->attorney_state) !!}
                        </select>
                    </div>
                    @if ($errors->has('attorney_state'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_state') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Zip') }} </label>
                        <input type="text" class="form-control " name="attorney_zip" value="{{old('attorney_zip',(!empty($attorney_company->attorney_zip))?$attorney_company->attorney_zip:'')}}"
                            placeholder="{{ __('Zip') }} ">
                    </div>
                    @if ($errors->has('attorney_zip'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_zip') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Phone #') }}</label>
                        <input required type="text" class="phone-number-field form-control " name="attorney_phone" value="{{old('attorney_phone',(!empty($attorney_company->attorney_phone))?$attorney_company->attorney_phone:'')}}"
                            placeholder="{{ __('Phone') }} ">
                    </div>
                    @if ($errors->has('attorney_phone'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_phone') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Fax #') }} </label>
                        <input type="text" class="phone-number-field form-control " name="attorney_fax" value="{{old('attorney_fax',(!empty($attorney_company->attorney_fax))?$attorney_company->attorney_fax:'')}}"
                            placeholder="{{ __('Fax') }} ">
                    </div>
                    @if ($errors->has('attorney_fax'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_fax') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">{{ __('Attorney Email') }} </label>
                        <input required type="text" class="form-control " maxlength="255" name="attorney_email" value="{{old('card_name',(!empty(auth()->user()->email))?auth()->user()->email:'')}}"
                            placeholder="{{ __('Email') }} ">
                    </div>
                    @if ($errors->has('attorney_email'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_email') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">Additional Notice Email 1:</label>
                        <input type="text" class="form-control " maxlength="255" name="attorney_notice_email_1" value="{{old('card_name',(!empty(auth()->user()->attorney_notice_email_1))?auth()->user()->attorney_notice_email_1:'')}}"
                            placeholder="{{ __('Email') }} ">
                    </div>
                    @if ($errors->has('attorney_notice_email_1'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_notice_email_1') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">Additional Notice Email 2:</label>
                        <input type="text" class="form-control " maxlength="255" name="attorney_notice_email_2" value="{{old('card_name',(!empty(auth()->user()->attorney_notice_email_2))?auth()->user()->attorney_notice_email_2:'')}}"
                            placeholder="{{ __('Email') }} ">
                    </div>
                    @if ($errors->has('attorney_notice_email_2'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_notice_email_2') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">Attorney Appointment Link</label>
                        <input type="text" class="form-control " name="attorney_appointment_url" value="{{old('attorney_appointment_url',(!empty($attorney_company->attorney_appointment_url))?$attorney_company->attorney_appointment_url:'')}}"
                            placeholder="Attorney Appointment Link">
                    </div>
                    @if ($errors->has('attorney_appointment_url'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_appointment_url') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Client Welcome Guide Video Link</label>
                        <input type="text" class="form-control" name="attorney_welcome_video_url" value="{{old('attorney_welcome_video_url',(!empty($attorney_company->attorney_welcome_video_url))?$attorney_company->attorney_welcome_video_url:'')}}"
                            placeholder="Client Welcome Guide Video Link">
                    </div>
                </div>
                @if ($errors->has('attorney_welcome_video_url'))
                <p class="help-block text-danger">{{ $errors->first('attorney_welcome_video_url') }}</p>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="label-div ">
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Upload Client Welcome Guide Mobile Video</label>
                        <input type="file" class="form-control" name="attorney_welcome_mobile_video_url" accept="video/*">
                    </div>
                </div>
                @if ($errors->has('attorney_welcome_mobile_video_url'))
                <p class="help-block text-danger">{{ $errors->first('attorney_welcome_mobile_video_url') }}</p>
                @endif
            </div>
            @if($attorney_company->attorney_welcome_mobile_video_url)
            <div class="col-sm-4">
                <div class="form-group m-auto w-100 video_preview">

                    <video width="240" height="160" controls>
                        <source src="{{ Storage::disk('s3')->temporaryUrl($attorney_company->attorney_welcome_mobile_video_url, now()->addHour(), ['ResponseContentDisposition' => 'attachment;filename= ' . rawurlencode('mp4')]) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <button style="vertical-align: top;" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default" type="button" onclick="deleteMobileVideo('{{ Auth::user()->id }}')"><i class="fas fa-trash fa-lg" aria-hidden="true"></i>&nbsp; Delete Video</button>

                </div>
            </div>
            @endif
            
            <div class="col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">Attorney Review Link</label>
                        <input type="text" class="form-control " name="attorney_review_url" value="{{old('attorney_review_url',(!empty($attorney_company->attorney_review_url))?$attorney_company->attorney_review_url:'')}}"
                            placeholder="Attorney Review Link">
                    </div>
                    @if ($errors->has('attorney_review_url'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_review_url') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="">Attorney Privacy Policy Link</label>
                        <input type="text" class="form-control " name="attorney_privacy_policy_url" value="{{old('attorney_privacy_policy_url',(!empty($attorney_company->attorney_privacy_policy_url))?$attorney_company->attorney_privacy_policy_url:'')}}"
                            placeholder="Attorney Privacy Policy Link">
                    </div>
                    @if ($errors->has('attorney_privacy_policy_url'))
                    <p class="help-block text-danger mt-2">{{ $errors->first('attorney_privacy_policy_url') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-12">

                <div class="label-div">
                    <label class="">Use Custom (White labeled) Client Log in Page(s)</label>

                    <div class="d-flex align-items-center">
                        <div class="form-group w-auto mb-0">
                            <div class="toggle-switch">
                                <div class="d-flex">
                                    <span class="pr-1">Off</span>
                                    <input
                                        onchange="checkUncheck(this)"
                                        type="checkbox"
                                        id="flexSwitchCheckSug"
                                        name="enable_custom_login_page_slug"
                                        value="{{ $enable_custom_login_page_slug == 1 ? 1 : 0 }}"
                                        {{ $enable_custom_login_page_slug == 1 ? 'checked' : '' }}>
                                    <label for="flexSwitchCheckSug" class="mb-0"></label>
                                    <span class="pl-1">ON</span>
                                </div>
                                <div class="custom_login_link {{$enable_custom_login_page_slug == 1 ? '' : 'hide-data'}}">{{ url(route('client_login')) . '/' . ($attorney_settings->custom_login_slug ?? '') }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save Profile Information</span></button>
    </div>
</form>

<script>
    function checkUncheck(checkbox) {
        // Get the current checked state
        var isChecked = checkbox.checked;

        if (!confirm("Are you sure you want to " + (isChecked ? "enable" : "disable") + " custom login URL?")) {
            // Revert the checkbox state if user cancels
            checkbox.checked = !isChecked;
            // Update the hidden input value accordingly
            document.querySelector('input[name="enable_custom_login_page_slug"]').value = isChecked ? 0 : 1;
            $(".custom_login_link").removeClass('hide-data');
        } else {
            // Update the hidden input value if user confirms
            document.querySelector('input[name="enable_custom_login_page_slug"]').value = isChecked ? 1 : 0;
            $(".custom_login_link").addClass('hide-data');
        }
    }
</script>