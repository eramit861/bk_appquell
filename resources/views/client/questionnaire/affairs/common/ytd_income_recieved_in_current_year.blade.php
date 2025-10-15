<div class="row gx-3">
    <div class="col-12">
        <div class="border-bottom-default mb-3">
            <div class="row">

                <div class="col-8">
                    <label class="fs-16px"><span class="text-c-blue"><strong>YTD:</strong></span> What you have received
                        so far in the current year?</label>
                </div>

                <div class="col-4">
                    <div class="video-div float_right d-flex align-items-center">
                        <button type="button" class="video-btn" data-bs-toggle="modal" data-bs-target="#video_modal"
                            onclick="run_tutorial_videos(this,'#video_modal')" data-video="{{ $video3['en'] }}"
                            data-video2="{{ $video3['sp'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29">
                                <g id="vds-btn" transform="translate(-299 -55)">
                                    <rect id="Rectangle_27" data-name="Rectangle 27" width="29" height="29"
                                        rx="14.5" transform="translate(299 55)" fill="#0b01aa"></rect>
                                    <path id="screen-play"
                                        d="M13.42,0H3.532A3.536,3.536,0,0,0,0,3.532V9.182a3.536,3.536,0,0,0,3.532,3.532H13.42a3.536,3.536,0,0,0,3.532-3.532V3.532A3.536,3.536,0,0,0,13.42,0ZM15.54,9.182A2.122,2.122,0,0,1,13.42,11.3H3.532A2.122,2.122,0,0,1,1.413,9.182V3.532A2.122,2.122,0,0,1,3.532,1.413H13.42A2.122,2.122,0,0,1,15.54,3.532ZM7.063,15.54a1.413,1.413,0,1,1-1.413-1.413A1.412,1.412,0,0,1,7.063,15.54ZM10.828,4.951,8,3.382a1.618,1.618,0,0,0-2.39,1.406V7.925A1.619,1.619,0,0,0,8,9.331l2.824-1.569a1.62,1.62,0,0,0,0-2.812Zm-.687,1.577L7.318,8.1a.2.2,0,0,1-.291-.171V4.788a.186.186,0,0,1,.1-.169.2.2,0,0,1,.1-.029.2.2,0,0,1,.1.026l2.823,1.569a.2.2,0,0,1,0,.343Zm6.811,9.011a.706.706,0,0,1-.706.706H9.182a.706.706,0,1,1,0-1.413h7.063A.706.706,0,0,1,16.952,15.539Zm-14.127,0a.706.706,0,0,1-.706.706H.706a.706.706,0,1,1,0-1.413H2.119A.706.706,0,0,1,2.825,15.539Z"
                                        transform="translate(305 61)" fill="#fff"></path>
                                </g>
                            </svg>
                            <div>Step-by-Step Guide</div>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="text-bold text-center">
                        <span class="text-c-blue">Gross Income is before taxes (its best to get the above previous two
                            years from your tax returns)</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-{{ $client_type == 3 ? '6' : '12' }} col-12">
        @include('client.questionnaire.affairs.common.other_income_received_income')
    </div>
    @if ($client_type == 3)
        <div class="col-xl-6 col-12">
            @include('client.questionnaire.affairs.common.other_income_received_income_spouse')
        </div>
    @endif

</div>
