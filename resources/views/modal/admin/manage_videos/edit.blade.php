<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="dynamicModalLabel">Edit Videos</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="light-gray-div m-0 border-0 p-0">
                <form id="webvideo-form" action="{{ route('admin_webvideos_update', $webvideo->id) }}" method="post" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="label-div question-area border-0 p-0">
                                <div class="form-group">
                                    <label class="">Device Type</label>
                                    <select class="form-control required" name="media_type"
                                        onchange="changeVideoMediaType(this)">
                                        <option value="">Choose one</option>
                                        <option {{ $webvideo->media_type == 'mobile' ? 'selected' : '' }}
                                            value="mobile">Mobile App</option>
                                        <option {{ $webvideo->media_type == 'website' ? 'selected' : '' }}
                                            value="website">Website Client Side</option>
                                        <option {{ $webvideo->media_type == 'attorney' ? 'selected' : '' }}
                                            value="attorney"> Attorney Videos</option>
                                        <option {{ $webvideo->media_type == 'misc' ? 'selected' : '' }} value="misc">
                                            Landing Page/Misc Videos</option>
                                        <option {{ $webvideo->media_type == 'payroll' ? 'selected' : '' }}
                                            value="payroll">Payroll assistant Videos</option>
                                        <option {{ $webvideo->media_type == 'videolp' ? 'selected' : '' }}
                                            value="videolp">Video Landing pages Videos</option>
                                    </select>
                                    @if ($errors->has('media_type'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('media_type') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div
                                class="label-div question-area border-0 p-0 mobile_types {{ $webvideo->media_type != 'mobile' ? 'hide-data' : '' }}">
                                <div class="form-group">
                                    <label>Choose Section</label>
                                    <select name="section_mobile" class="form-control">
                                        <option value="">Choose one</option>
                                        {!! VideoHelper::getMobileVideoTypeSelection($webvideo->section) !!}
                                    </select>
                                </div>
                            </div>

                            <div
                                class="label-div question-area border-0 p-0 website_types {{ $webvideo->media_type != 'website' ? 'hide-data' : '' }}">
                                <div class="form-group">
                                    <label>Choose Section</label>
                                    <select name="section_website" class="form-control">
                                        <option value="">Choose one</option>
                                        {!! VideoHelper::getWebVideoTypeSelection($webvideo->section) !!}
                                    </select>
                                </div>
                            </div>

                            <div
                                class="label-div question-area border-0 p-0 website_attorny_types {{ $webvideo->media_type != 'attorney' ? 'hide-data' : '' }}">
                                <div class="form-group">
                                    <label>Choose Section</label>
                                    <select name="section_attorney" class="form-control">
                                        <option value="">Choose one</option>
                                        {!! VideoHelper::getAttorneyVideosTypeSelection($webvideo->section) !!}
                                    </select>
                                </div>
                            </div>

                            <div
                                class="label-div question-area border-0 p-0 website_misc_types {{ $webvideo->media_type != 'misc' ? 'hide-data' : '' }}">
                                <div class="form-group">
                                    <label>Choose Section</label>
                                    <select name="section_misc" class="form-control">
                                        <option value="">Choose one</option>
                                        {!! VideoHelper::getMiscVideosTypeSelection($webvideo->section) !!}
                                    </select>
                                </div>
                            </div>

                            <div
                                class="label-div question-area border-0 p-0 website_payroll_types {{ $webvideo->media_type != 'payroll' ? 'hide-data' : '' }}">
                                <div class="form-group">
                                    <label>Choose Section</label>
                                    <select name="section_payroll" class="form-control">
                                        <option value="">Choose one</option>
                                        {!! VideoHelper::getPayrollVideosTypeSelection($webvideo->section) !!}
                                    </select>
                                </div>
                            </div>

                            <div
                                class="label-div question-area border-0 p-0 website_videolp_types {{ $webvideo->media_type != 'videolp' ? 'hide-data' : '' }}">
                                <div class="form-group">
                                    <label>Choose Section</label>
                                    <select name="section_videolp" class="form-control">
                                        <option value="">Choose one</option>
                                        {!! VideoHelper::getExtraLPVideosTypeSelection($webvideo->section) !!}
                                    </select>
                                </div>
                            </div>


                            @if ($errors->has('section'))
                                <p class="help-block text-danger">{{ $errors->first('section') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-12">
                            <div class="label-div question-area">
                                <label class="">Choose Video Type</label>
                                <!-- Radio Buttons -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" id="video_type_no_edit" class="d-none video_type_edit"
                                        name="video_type" value="1"
                                        {{ $webvideo->video_type != 2 ? 'checked' : '' }}>
                                    <label for="video_type_no_edit"
                                        class="btn-toggle {{ $webvideo->video_type != 2 ? 'active' : '' }}"
                                        onclick="setVideoTypeEdit(1)">URL</label>

                                    <input type="radio" id="video_type_yes_edit" class="d-none video_type_edit"
                                        name="video_type" value="2"
                                        {{ $webvideo->video_type == 2 ? 'checked' : '' }}>
                                    <label for="video_type_yes_edit"
                                        class="btn-toggle {{ $webvideo->video_type == 2 ? 'active' : '' }}"
                                        onclick="setVideoTypeEdit(2)">Upload New Video</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label>{{ $webvideo->media_type == 'website' ? 'English Website Client Video Url' : 'English Video Url' }}</label>
                                    <input type="text"
                                        class="form-control input-video-file-url-edit {{ $errors->has('english_video') ? 'btn-outline-danger' : '' }}"
                                        placeholder="English video Url" name="english_video"
                                        value="{{ $webvideo->video_type != 2 ? old('english_video', $webvideo->english_video) : '' }}">
                                    <input type="file"
                                        class="form-control input-video-file-upload-edit hide-data {{ $errors->has('english_video') ? 'btn-outline-danger' : '' }}"
                                        name="english_video" accept="video/*">
                                    <small class="text-muted input-video-file-upload-edit hide-data">{{ !empty($webvideo->english_video) ? 'Uploaded Video: '.$webvideo->english_video : 'No Video Uploaded Yet.' }}</small>
                                    @if ($errors->has('english_video'))
                                        <p class="help-block text-danger">{{ $errors->first('english_video') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($webvideo->media_type == 'website')
                            <div class="col-12">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label>{{ $webvideo->media_type == 'website' ? 'English Mobile Client Video Url' : 'English Webview Video Url (If required)' }}</label>
                                        <input type="text"
                                            class="form-control input-video-file-url-edit {{ $errors->has('webview_english_video') ? 'btn-outline-danger' : '' }}"
                                            placeholder="English Webview video Url" name="webview_english_video"
                                            value="{{ $webvideo->video_type != 2 ? old('webview_english_video', $webvideo->webview_english_video) : '' }}">
                                        <input type="file"
                                            class="form-control input-video-file-upload-edit hide-data {{ $errors->has('webview_english_video') ? 'btn-outline-danger' : '' }}"
                                            name="webview_english_video" accept="video/*">
                                        <small class="text-muted input-video-file-upload-edit hide-data">{{ !empty($webvideo->webview_english_video) ? 'Uploaded Video: '.$webvideo->webview_english_video : 'No Video Uploaded Yet.' }}</small>
                                        @if ($errors->has('webview_english_video'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('webview_english_video') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="col-12">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label>{{ $webvideo->media_type == 'website' ? 'Spanish Website Client Video Url' : 'Spanish Video Url' }}</label>
                                    <input type="text"
                                        class="form-control input-video-file-url-edit {{ $errors->has('spanish_video') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Spanish video Url" name="spanish_video"
                                        value="{{ $webvideo->video_type != 2 ? old('spanish_video', $webvideo->spanish_video) : '' }}">
                                    <input type="file"
                                        class="form-control input-video-file-upload-edit hide-data {{ $errors->has('spanish_video') ? 'btn-outline-danger' : '' }}"
                                        name="spanish_video" accept="video/*">
                                    <small class="text-muted input-video-file-upload-edit hide-data">{{ !empty($webvideo->spanish_video) ? 'Uploaded Video: '.$webvideo->spanish_video : 'No Video Uploaded Yet.' }}</small>
                                    @if ($errors->has('spanish_video'))
                                        <p class="help-block text-danger">{{ $errors->first('spanish_video') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($webvideo->media_type == 'website')
                            <div class="col-12">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label>{{ $webvideo->media_type == 'website' ? 'Spanish Mobile Client Video Url' : 'Spanish Webview Video Url (If required)' }}</label>
                                        <input type="text"
                                            class="form-control input-video-file-url-edit {{ $errors->has('webview_spanish_video') ? 'btn-outline-danger' : '' }}"
                                            placeholder="Spanish Webview video Url" name="webview_spanish_video"
                                            value="{{ $webvideo->video_type != 2 ? old('webview_spanish_video', $webvideo->webview_spanish_video) : '' }}">
                                        <input type="file"
                                            class="form-control input-video-file-upload-edit hide-data {{ $errors->has('webview_spanish_video') ? 'btn-outline-danger' : '' }}"
                                            name="webview_spanish_video" accept="video/*">
                                        <small class="text-muted input-video-file-upload-edit hide-data">{{ !empty($webvideo->webview_spanish_video) ? 'Uploaded Video: '.$webvideo->webview_spanish_video : 'No Video Uploaded Yet.' }}</small>
                                        @if ($errors->has('webview_spanish_video'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('webview_spanish_video') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <div
                                class="label-div iphone_fields {{ $webvideo->media_type != 'mobile' ? 'hide-data' : '' }}">
                                <div class="form-group mb-0">
                                    <label>iPhone English Video Url</label>
                                    <input type="text"
                                        class="form-control input-video-file-url-edit {{ $errors->has('iphone_english_video') ? 'btn-outline-danger' : '' }}"
                                        placeholder="iPhone English Video Url" name="iphone_english_video"
                                        value="{{ $webvideo->video_type != 2 ? old('iphone_english_video', $webvideo->iphone_english_video) : '' }}">
                                    <input type="file"
                                        class="form-control input-video-file-upload-edit hide-data {{ $errors->has('iphone_english_video') ? 'btn-outline-danger' : '' }}"
                                        name="iphone_english_video" accept="video/*">
                                    <small class="text-muted input-video-file-upload-edit hide-data">{{ !empty($webvideo->iphone_english_video) ? 'Uploaded Video: '.$webvideo->iphone_english_video : 'No Video Uploaded Yet.' }}</small>
                                    @if ($errors->has('iphone_english_video'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('iphone_english_video') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div
                                class="label-div iphone_fields {{ $webvideo->media_type != 'mobile' ? 'hide-data' : '' }}">
                                <div class="form-group mb-0">
                                    <label>iPhone Spanish Video Url</label>
                                    <input type="text"
                                        class="form-control input-video-file-url-edit {{ $errors->has('iphone_spanish_video') ? 'btn-outline-danger' : '' }}"
                                        placeholder="iPhone Spanish Video Url" name="iphone_spanish_video"
                                        value="{{ $webvideo->video_type != 2 ? old('iphone_spanish_video', $webvideo->iphone_spanish_video) : '' }}">
                                    <input type="file"
                                        class="form-control input-video-file-upload-edit hide-data {{ $errors->has('iphone_spanish_video') ? 'btn-outline-danger' : '' }}"
                                        name="iphone_spanish_video" accept="video/*">
                                    <small class="text-muted input-video-file-upload-edit hide-data">{{ !empty($webvideo->iphone_spanish_video) ? 'Uploaded Video: '.$webvideo->iphone_spanish_video : 'No Video Uploaded Yet.' }}</small>
                                    @if ($errors->has('iphone_spanish_video'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('iphone_spanish_video') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-theme-black" onclick="document.getElementById('webvideo-form').submit();">Submit</button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>


<style>
    i.fa-desktop,
    i.fa-mobile {
        color: #012cae;
    }

    label.error {
        color: red;
        font-style: italic;
    }
</style>
<script>
    $(document).ready(function() {

        $("#webvideo-form").validate({

            errorPlacement: function(error, element) {
                if ($(element).parents(".form-group").next('label').hasClass('error')) {

                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                } else {

                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function(label, element) {
                label.parent().removeClass('error');

                $(element).parents(".form-group").next('label').remove();
            },
        });
    });

    changeVideoMediaType = function(thisobj) {
        var val = thisobj.value;
        if (val == 'mobile') {
            $(".mobile_types").removeClass('hide-data');
            $(".website_types").addClass('hide-data');
            $(".website_misc_types").addClass('hide-data');
            $(".website_videolp_types").addClass('hide-data');
            $(".website_payroll_types").addClass('hide-data');
            $(".website_attorny_types").addClass('hide-data');

            $(".mobile_types").removeClass('hide-data');
            $(".iphone_fields").removeClass('hide-data');
        }
        if (val == 'website') {
            $(".mobile_types").addClass('hide-data');
            $(".website_types").removeClass('hide-data');
            $(".website_misc_types").addClass('hide-data');
            $(".website_videolp_types").addClass('hide-data');
            $(".website_payroll_types").addClass('hide-data');
            $(".website_attorny_types").addClass('hide-data');
            $(".iphone_fields").addClass('hide-data');
        }

        if (val == 'attorney') {
            $(".mobile_types").addClass('hide-data');
            $(".website_types").addClass('hide-data');
            $(".website_misc_types").addClass('hide-data');
            $(".website_videolp_types").addClass('hide-data');
            $(".website_payroll_types").addClass('hide-data');
            $(".website_attorny_types").removeClass('hide-data');
            $(".iphone_fields").addClass('hide-data');
        }
        if (val == 'misc') {
            $(".mobile_types").addClass('hide-data');
            $(".website_types").addClass('hide-data');
            $(".website_misc_types").removeClass('hide-data');
            $(".website_videolp_types").addClass('hide-data');
            $(".website_payroll_types").addClass('hide-data');
            $(".website_attorny_types").addClass('hide-data');
            $(".iphone_fields").addClass('hide-data');
        }
        if (val == 'payroll') {
            $(".mobile_types").addClass('hide-data');
            $(".website_types").addClass('hide-data');
            $(".website_misc_types").addClass('hide-data');
            $(".website_videolp_types").addClass('hide-data');
            $(".website_payroll_types").removeClass('hide-data');
            $(".website_attorny_types").addClass('hide-data');
            $(".iphone_fields").addClass('hide-data');
        }
        if (val == 'videolp') {
            $(".mobile_types").addClass('hide-data');
            $(".website_types").addClass('hide-data');
            $(".website_misc_types").addClass('hide-data');
            $(".website_videolp_types").removeClass('hide-data');
            $(".website_payroll_types").addClass('hide-data');
            $(".website_attorny_types").addClass('hide-data');
            $(".iphone_fields").addClass('hide-data');
        }
    }

    setVideoTypeEdit = function(type) {
        if (type == 1) {
            // URL selected - show URL input fields, hide upload fields
            $('.input-video-file-url-edit').removeClass('hide-data');
            $('.input-video-file-upload-edit').addClass('hide-data');

            // Update radio button state
            $('#video_type_no_edit').prop('checked', true);
            $('#video_type_yes_edit').prop('checked', false);
        } else if (type == 2) {
            // Upload selected - hide URL input fields, show upload fields
            $('.input-video-file-url-edit').addClass('hide-data');
            $('.input-video-file-upload-edit').removeClass('hide-data');

            // Update radio button state
            $('#video_type_no_edit').prop('checked', false);
            $('#video_type_yes_edit').prop('checked', true);
        }
    }

    // Initialize video type on page load
    $(document).ready(function() {
        var selectedType = $('input.video_type_edit[name="video_type"]:checked').val();
        if (selectedType) {
            setVideoTypeEdit(selectedType);
        }
    });
</script>
<!-- [ Main Content ] end -->
