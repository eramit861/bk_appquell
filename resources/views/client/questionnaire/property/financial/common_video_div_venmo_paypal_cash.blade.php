<div class="label-div">
    @php
    $paypalshowHide = 'hide-data';
    if (in_array($accType, ['paypal_account_1', 'paypal_account_2', 'paypal_account_3'])) {
        $paypalshowHide = '';
    }
    @endphp
    @if(isset($paypalVideos) && !empty($paypalVideos))
        <label class="w-100 mb-0 pb-2 {{ @$web_view ? 'text-center' : '' }} guide-video-div paypalVideo-{{ $i }} {{ $paypalshowHide }}"><span class="blink text-c-red font-weight-bold mb-0">How to get PayPal statements:</span>
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tap/select device type button to view Paypal guide video">
                <i class="bi bi-question-circle"></i>
            </div>
            @foreach($paypalVideos as $key => $value)
                @php
                $path = 'assets/img/' . $key . '.png';
                @endphp
                <span class="paypal_div mt-1 mt-sm-0 {{ @$web_view ? 'mt-2' : '' }}  btn-new-ui-default d-inline-block guide-video-btn px-1 py-1">
                    <a href="javascript:void(0)" class="download-forms " title="Paypal {{ $key }} Video"
                        data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                        data-video="{{ Helper::validate_key_value('en', $value) }}"
                        data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                        @if($key == 'iphone')
                            <i class="bi bi-apple"></i>
                        @elseif($key == 'android')
                            <i class="bi bi-android2"></i>
                        @elseif($key == 'desktop_laptop')
                            <i class="bi bi-pc-display-horizontal"></i>
                        @endif
                        {!! VideoHelper::getVideoButtonLabel($key) !!}
                    </a>
                </span>
            @endforeach
        </label>
    @endif

    @php
    $cashappshowHide = 'hide-data';
    if (in_array($accType, ['cash_account_1', 'cash_account_2', 'cash_account_3'])) {
        $cashappshowHide = '';
    }
    @endphp
    @if(isset($cashAppVideos) && !empty($cashAppVideos))
        <label class="w-100 mb-0 pb-2 {{ @$web_view ? 'text-center' : '' }} guide-video-div cashVideo-{{ $i }} {{ $cashappshowHide }}"><span class="blink text-c-red font-weight-bold mb-0">How to get Cash App statements:</span>
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tap/select device type button to view Cashapp guide video">
                <i class="bi bi-question-circle"></i>
            </div>
            @foreach($cashAppVideos as $key => $value)
                @php
                $path = 'assets/img/' . $key . '.png';
                @endphp
                <span class="cash_app_div mt-1 mt-sm-0 {{ @$web_view ? 'mt-2' : '' }}  btn-new-ui-default d-inline-block guide-video-btn px-1 py-1">
                    <a href="javascript:void(0)" class="download-forms " title="Cashapp {{ $key }} Guide Video"
                        data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                        data-video="{{ Helper::validate_key_value('en', $value) }}"
                        data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                        @if($key == 'iphone')
                            <i class="bi bi-apple"></i>
                        @elseif($key == 'android')
                            <i class="bi bi-android2"></i>
                        @elseif($key == 'desktop_laptop')
                            <i class="bi bi-pc-display-horizontal"></i>
                        @endif
                        {!! VideoHelper::getVideoButtonLabel($key) !!}
                    </a>
                </span>
            @endforeach
        </label>
    @endif

    @php
    $venmoshowHide = 'hide-data';
    if (in_array($accType, ['venmo_account_1', 'venmo_account_2', 'venmo_account_3'])) {
        $venmoshowHide = '';
    }
    @endphp
    @if(isset($venmoVideo) && !empty($venmoVideo))
        <label class="w-100 mb-0 pb-2 {{ @$web_view ? 'text-center' : '' }} guide-video-div venmoVideo-{{ $i }} {{ $venmoshowHide }}"><span class="blink text-c-red font-weight-bold mb-0">How to get Venmo statements:</span>
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tap/select device type button to view Venmo guide video">
                <i class="bi bi-question-circle"></i>
            </div>
            @foreach($venmoVideo as $key => $value)
                @php
                $path = 'assets/img/' . $key . '.png';
                @endphp
                <span class="venmo_div mt-1 mt-sm-0 {{ @$web_view ? 'mt-2' : '' }}  btn-new-ui-default d-inline-block guide-video-btn px-1 py-1">
                    <a href="javascript:void(0)" class="download-forms " title="Venmo {{ $key }} Guide Video"
                        data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                        data-video="{{ Helper::validate_key_value('en', $value) }}"
                        data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                        @if($key == 'iphone')
                            <i class="bi bi-apple"></i>
                        @elseif($key == 'android')
                            <i class="bi bi-android2"></i>
                        @elseif($key == 'desktop_laptop')
                            <i class="bi bi-pc-display-horizontal"></i>
                        @endif
                        {!! VideoHelper::getVideoButtonLabel($key) !!}
                    </a>
                </span>
            @endforeach
        </label>
    @endif
</div>