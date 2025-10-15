<div id="add_company" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add {!! VideoHelper::getVideoTitleTypes($selected_media_type) !!}</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <form id="add_stax" action="{{ route('admin_webvideos_create') }}" method="post" novalidate enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="light-gray-div m-0 border-0 p-0">
                        <div class="row gx-3">

                            <input type="hidden" name="media_type" value="{{ $selected_media_type }}">

                            <div class="col-sm-12">

                                <div
                                    class="label-div question-area border-0 p-0 mobile_types {{ $selected_media_type != 'mobile' ? 'hide-data' : '' }}">
                                    <div class="form-group">
                                        <label class="">Choose Section</label>
                                        <select class="form-control" name="section_mobile">
                                            <option value="">Choose one</option>
                                            {!! VideoHelper::getMobileVideoTypeSelection(old('section')) !!}
                                        </select>
                                    </div>
                                </div>

                                <div
                                    class="label-div question-area border-0 p-0 website_types {{ $selected_media_type != 'website' ? 'hide-data' : '' }}">
                                    <div class="form-group">
                                        <label class="">Choose Section</label>
                                        <select class="form-control" name="section_website">
                                            <option value="">Choose one</option>
                                            {!! VideoHelper::getWebVideoTypeSelection(old('section')) !!}
                                        </select>
                                    </div>
                                </div>

                                <div
                                    class="label-div question-area border-0 p-0 website_attorny_types {{ $selected_media_type != 'attorney' ? 'hide-data' : '' }}">
                                    <div class="form-group">
                                        <label class="">Choose Section</label>
                                        <select class="form-control" name="section_attorney">
                                            <option value="">Choose one</option>
                                            {!! VideoHelper::getAttorneyVideosTypeSelection(old('section')) !!}
                                        </select>
                                    </div>
                                </div>

                                <div
                                    class="label-div question-area border-0 p-0 website_misc_types {{ $selected_media_type != 'misc' ? 'hide-data' : '' }}">
                                    <div class="form-group">
                                        <label class="">Choose Section</label>
                                        <select class="form-control" name="section_misc">
                                            <option value="">Choose one</option>
                                            {!! VideoHelper::getMiscVideosTypeSelection(old('section')) !!}
                                        </select>
                                    </div>
                                </div>

                                <div
                                    class="label-div question-area border-0 p-0 website_payroll_types {{ $selected_media_type != 'payroll' ? 'hide-data' : '' }}">
                                    <div class="form-group">
                                        <label class="">Choose Section</label>
                                        <select class="form-control" name="section_payroll">
                                            <option value="">Choose one</option>
                                            {!! VideoHelper::getPayrollVideosTypeSelection(old('section')) !!}
                                        </select>
                                    </div>
                                </div>

                                <div
                                    class="label-div question-area border-0 p-0 website_videolp_types {{ $selected_media_type != 'videolp' ? 'hide-data' : '' }}">
                                    <div class="form-group">
                                        <label class="">Choose Section</label>
                                        <select class="form-control" name="section_videolp">
                                            <option value="">Choose one</option>
                                            {!! VideoHelper::getExtraLPVideosTypeSelection(old('section')) !!}
                                        </select>
                                    </div>
                                </div>

                                @if ($errors->has('section'))
                                    <p class="help-block text-danger">{{ $errors->first('section') }}</p>
                                @endif
                            </div>

                            <div class="col-sm-12">
                                <div class="label-div question-area">
                                    <label class="">Choose Video Type</label>
                                    <!-- Radio Buttons -->
                                    <div class="custom-radio-group form-group">
                                        <input type="radio" id="video_type_no" class="d-none" name="video_type"
                                            value="1">
                                        <label for="video_type_no" class="btn-toggle" onclick="setVideoType(1)">URL</label>

                                        <input type="radio" id="video_type_yes" class="d-none" name="video_type"
                                            value="2">
                                        <label for="video_type_yes" class="btn-toggle" onclick="setVideoType(2)">Upload New Video</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label class="">{{ $selected_media_type == 'website' ? 'English Website Client Video Url' : 'English Video Url' }}</label>
                                        <input type="text" class="form-control input-video-file-url {{ $errors->has('english_video') ? 'btn-outline-danger' : '' }}"
                                            name="english_video" value="{{ old('english_video') }}" placeholder="English Video Url"
                                            >
                                        <input type="file" class="form-control input-video-file-upload hide-data {{ $errors->has('english_video') ? 'btn-outline-danger' : '' }}"
                                            name="english_video" accept="video/*">
                                    </div>
                                    @if ($errors->has('english_video'))
                                        <p class="help-block text-danger">{{ $errors->first('english_video') }}</p>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-12 webview {{ $selected_media_type != 'website' ? 'hide-data' : '' }}">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label class="">{{ $selected_media_type == 'website' ? 'English Mobile Client Video Url' : 'English Webview Video Url (If required)' }}</label>
                                        <input type="text" class="form-control input-video-file-url {{ $errors->has('webview_english_video') ? 'btn-outline-danger' : '' }}"
                                            name="webview_english_video" value="{{ old('webview_english_video') }}" placeholder="English Webview Video Url">
                                        <input type="file" class="form-control input-video-file-upload hide-data {{ $errors->has('webview_english_video') ? 'btn-outline-danger' : '' }}"
                                            name="webview_english_video" accept="video/*">
                                    </div>
                                    @if ($errors->has('webview_english_video'))
                                        <p class="help-block text-danger">{{ $errors->first('webview_english_video') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label class="">{{ $selected_media_type == 'website' ? 'Spanish Website Client Video Url' : 'Spanish Video Url' }}</label>
                                        <input type="text" class="form-control input-video-file-url {{ $errors->has('spanish_video') ? 'btn-outline-danger' : '' }}"
                                            name="spanish_video" value="{{ old('spanish_video') }}" placeholder="Spanish Video Url">
                                        <input type="file" class="form-control input-video-file-upload hide-data {{ $errors->has('spanish_video') ? 'btn-outline-danger' : '' }}"
                                            name="spanish_video" accept="video/*">
                                    </div>
                                    @if ($errors->has('spanish_video'))
                                        <p class="help-block text-danger">{{ $errors->first('spanish_video') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 webview {{ $selected_media_type != 'website' ? 'hide-data' : '' }}">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label class="">{{ $selected_media_type == 'website' ? 'Spanish Mobile Client Video Url' : 'Spanish Webview Video Url (If required)' }}</label>
                                        <input type="text" class="form-control input-video-file-url {{ $errors->has('webview_spanish_video') ? 'btn-outline-danger' : '' }}"
                                            name="webview_spanish_video" value="{{ old('webview_spanish_video') }}" placeholder="Spanish Webview Video Url">
                                        <input type="file" class="form-control input-video-file-upload hide-data {{ $errors->has('webview_spanish_video') ? 'btn-outline-danger' : '' }}"
                                            name="webview_spanish_video" accept="video/*">
                                    </div>
                                    @if ($errors->has('webview_spanish_video'))
                                        <p class="help-block text-danger">{{ $errors->first('webview_spanish_video') }}</p>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-12 iphone_videos {{ $selected_media_type != 'mobile' ? 'hide-data' : '' }}">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label class="">iPhone English Video Url</label>
                                        <input type="text" class="form-control input-video-file-url {{ $errors->has('iphone_english_video') ? 'btn-outline-danger' : '' }}"
                                            name="iphone_english_video" value="{{ old('iphone_english_video') }}" placeholder="iPhone English Video Url">
                                        <input type="file" class="form-control input-video-file-upload hide-data {{ $errors->has('iphone_english_video') ? 'btn-outline-danger' : '' }}"
                                            name="iphone_english_video" accept="video/*">
                                    </div>
                                    @if ($errors->has('iphone_english_video'))
                                        <p class="help-block text-danger">{{ $errors->first('iphone_english_video') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 iphone_videos {{ $selected_media_type != 'mobile' ? 'hide-data' : '' }}">
                                <div class="label-div">
                                    <div class="form-group mb-0">
                                        <label class="">iPhone Spanish Video Url</label>
                                        <input type="text" class="form-control input-video-file-url {{ $errors->has('iphone_spanish_video') ? 'btn-outline-danger' : '' }}"
                                            name="iphone_spanish_video" value="{{ old('iphone_spanish_video') }}" placeholder="iPhone Spanish Video Url">
                                        <input type="file" class="form-control input-video-file-upload hide-data {{ $errors->has('iphone_spanish_video') ? 'btn-outline-danger' : '' }}"
                                            name="iphone_spanish_video" accept="video/*">
                                    </div>
                                    @if ($errors->has('iphone_spanish_video'))
                                        <p class="help-block text-danger">{{ $errors->first('iphone_spanish_video') }}</p>
                                    @endif
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-theme-black">Submit</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>