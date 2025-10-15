
@php $web_view = Session::get('web_view'); @endphp

<div class="row">
<div class="col step-video-div  ml-3 mb-xl-0 text-left">

        @if(isset($video) && !empty($video) && !($tab=='tab1' && $step6))
            <h3>
                <a href="javascript:void(0)" class="download-forms text-black" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
                    Step-by-step<img src="{{url('assets/img/video-icon.jpg')}}" alt="Video icon" style="height: 50px;">
                </a>
            </h3>
        @endif
      </div>
	<div class="col {{ @$web_view ? 'mb-4' : '' }} mb-xl-0 text-right">
	<div class="language-select">
		<div id="google_translate_element">
			
		</div>
	</div>
	</div>
</div>
