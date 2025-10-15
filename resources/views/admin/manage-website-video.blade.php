@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header">
                <h4>Manage Website Video</h4>
			</div>
			<div class="card-block px-0 py-0 mt-3">
				<form id="edit_payment" action="{{route('admin_manage_video_create')}}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="container">

                        @if($websiteVideos->isNotEmpty())
                            @foreach($websiteVideos as $websiteVideo)
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <label><b>English Video</b></label>
                                    </div>
                                </div>
                                <div class="row video-section-container">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label>Video Type</label>
                                            <select name="englishVideoType" id="englishVideoType" class="videoType form-control {{ $errors->has('englishVideoType') ? 'btn-outline-danger' : '' }}">
                                                <option value="url" {{ ($websiteVideo->english_video_type == 'url') ? "selected" : "" }}>URL</option>
                                                <option value="upload-video" {{ ($websiteVideo->english_video_type == 'upload-video') ? "selected" : "" }}>Upload New Video</option>
                                            </select>
                                            @if ($errors->has('englishVideoType'))
                                                <p class="help-block text-danger">{{ $errors->first('englishVideoType') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group url-container {{ ($websiteVideo->english_video_type == 'upload-video') ? 'd-lg-none' : '' }}">
                                            <label>URl</label>
                                            <input type="url"
                                                   class="form-control {{ $errors->has('url') ? 'btn-outline-danger' : '' }}"
                                                   placeholder="Video Url"
                                                   name="englishUrl"
                                                   value="{{$websiteVideo->english_video}}"
                                            >
                                            @if ($errors->has('englishUrl'))
                                                <p class="help-block text-danger">{{ $errors->first('englishUrl') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group video-input-container {{ ($websiteVideo->english_video_type != 'upload-video') ? 'd-lg-none' : '' }}">
                                            <label>Upload Video</label>
                                            <input type="file"
                                                   class="form-control price-field {{ $errors->has('englishVideo') ? 'btn-outline-danger' : '' }}"
                                                   name="englishVideo"
                                                   accept="video/*"
                                            >
                                            @if ($errors->has('englishVideo'))
                                                <p class="help-block text-danger">{{ $errors->first('englishVideo') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <label><b>Spanish Video</b></label>
                                    </div>
                                </div>
                                <div class="row video-section-container">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label>Video Type</label>
                                            <select name="spanishVideoType" id="spanishVideoType" class="videoType form-control {{ $errors->has('spanishVideoType') ? 'btn-outline-danger' : '' }}">
                                                <option value="url" {{ ($websiteVideo->spanish_video_type == 'url') ? "selected" : "" }}>URL</option>
                                                <option value="upload-video" {{ ($websiteVideo->spanish_video_type == 'upload-video') ? "selected" : "" }}>Upload New Video</option>
                                            </select>
                                            @if ($errors->has('spanishVideoType'))
                                                <p class="help-block text-danger">{{ $errors->first('spanishVideoType') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group url-container {{ ($websiteVideo->spanish_video_type == 'upload-video') ? 'd-lg-none' : '' }}">
                                            <label>URL</label>
                                            <input type="url"
                                                   class="form-control {{ $errors->has('spanishUrl') ? 'btn-outline-danger' : '' }}"
                                                   placeholder="Video Url"
                                                   name="spanishUrl"
                                                   value="{{$websiteVideo->spanish_video}}"
                                            >
                                            @if ($errors->has('spanishUrl'))
                                                <p class="help-block text-danger">{{ $errors->first('spanishUrl') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group video-input-container {{ ($websiteVideo->spanish_video_type != 'upload-video') ? 'd-lg-none' : '' }}">
                                            <label>Upload Video</label>
                                            <input type="file"
                                                   class="form-control price-field {{ $errors->has('spanishVideo') ? 'btn-outline-danger' : '' }}"
                                                   name="spanishVideo"
                                                   accept="video/*"
                                            >
                                            @if ($errors->has('spanishVideo'))
                                                <p class="help-block text-danger">{{ $errors->first('spanishVideo') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="section" value="client-landing-page">
                                <br>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <label><b>English Video</b></label>
                                </div>
                            </div>
                            <div class="row video-section-container">
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label>Video Type</label>
                                        <select name="englishVideoType" id="englishVideoType" class="videoType form-control {{ $errors->has('englishVideoType') ? 'btn-outline-danger' : '' }}">
                                            <option value="url" selected>URL</option>
                                            <option value="upload-video">Upload New Video</option>
                                        </select>
                                        @if ($errors->has('englishVideoType'))
                                            <p class="help-block text-danger">{{ $errors->first('englishVideoType') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group url-container">
                                        <label>URl</label>
                                        <input type="url"
                                               class="form-control {{ $errors->has('url') ? 'btn-outline-danger' : '' }}"
                                               placeholder="Video Url"
                                               name="englishUrl"
                                               value=""
                                        >
                                        @if ($errors->has('englishUrl'))
                                            <p class="help-block text-danger">{{ $errors->first('englishUrl') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group video-input-container" style="display: none">
                                        <label>Upload Video</label>
                                        <input type="file"
                                               accept="video/*"
                                               class="form-control price-field {{ $errors->has('englishVideo') ? 'btn-outline-danger' : '' }}"
                                               name="englishVideo"
                                               value=""
                                        >
                                        @if ($errors->has('englishVideo'))
                                            <p class="help-block text-danger">{{ $errors->first('englishVideo') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <label><b>Spanish Video</b></label>
                                </div>
                            </div>
                            <div class="row video-section-container">
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label>Video Type</label>
                                        <select name="spanishVideoType" id="spanishVideoType" class="videoType form-control {{ $errors->has('spanishVideoType') ? 'btn-outline-danger' : '' }}">
                                            <option value="url" selected>URL</option>
                                            <option value="upload-video">Upload New Video</option>
                                        </select>
                                        @if ($errors->has('spanishVideoType'))
                                            <p class="help-block text-danger">{{ $errors->first('spanishVideoType') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group url-container">
                                        <label>URL</label>
                                        <input type="url"
                                               class="form-control {{ $errors->has('spanishUrl') ? 'btn-outline-danger' : '' }}"
                                               placeholder="Video Url"
                                               name="spanishUrl"
                                               value=""
                                        >
                                        @if ($errors->has('spanishUrl'))
                                            <p class="help-block text-danger">{{ $errors->first('spanishUrl') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group video-input-container" style="display: none">
                                        <label>Upload Video</label>
                                        <input type="file"
                                               accept="video/*"
                                               class="form-control price-field {{ $errors->has('spanishVideo') ? 'btn-outline-danger' : '' }}"
                                               name="spanishVideo"
                                        >
                                        @if ($errors->has('spanishVideo'))
                                            <p class="help-block text-danger">{{ $errors->first('spanishVideo') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="section" value="client-landing-page">
                        @endif
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                    </div>
				</form>
			</div>
			<style>
				label.error {
					color: red;
					font-style: italic;
				}
			</style>
			<script>
				$(document).ready(function(){
                    $(document).on('change', '.videoType', function() {
                        if ($(this).val() == "url") {
                            $(this).closest('.video-section-container').find('.url-container').show();
                            $(this).closest('.video-section-container').find('.video-input-container').hide();
                        } else if($(this).val() == "upload-video") {
                            console.log($(this).val());
                            $(this).closest('.video-section-container').find('.url-container').hide();
                            $(this).closest('.video-section-container').find('.video-input-container').show();
                        }
                    });
				});
			</script>
		</div>
	</div>
	<!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection
