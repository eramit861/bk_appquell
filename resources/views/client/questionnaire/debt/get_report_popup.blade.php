
<!-- Credit Reports Modal -->
<div class="modal fade creditor-report-get-modal" id="creditReportsModal" tabindex="-1" aria-labelledby="creditReportsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow border-radius-default">

      <!-- Header -->
       <div class="modal-header bg-info-subtle border-0 ">
            <h5 class="modal-title fw-bold text-info-emphasis d-flex-ai-center w-100" id="creditorPopupLabel">
                <i class="bi bi-file-text"></i>&nbsp;Get Your Free Credit Reports
            </h5>
            <!-- <a class="float-right btn btn-primary-green shadow-2" onclick="confirmAllAIPendingToInclsude()" href="javascript:void(0)">Confirm & Import Debts to Questionnaire</a> -->

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

      <!-- Body -->
      <div class="modal-body text-center">
        <p class="mb-2 fw-semibold">Watch one of these short videos to see how to get your free credit reports:</p>
        <ul class="list-unstyled mb-4">
          <li>How to get your credit reports absolutely free</li>
          <li>How to have BKQ Import all of your creditors from your report(s) into the system for you</li>
        </ul>

        <div class="video-btn-div mt-3">
            <p class="fw-semibold">Tap/select your device to continue:</p>
            <div class="d-flex justify-content-center flex-wrap">
                @if(isset($getCreditReportVideos) && !empty($getCreditReportVideos))
                    @foreach($getCreditReportVideos as $key => $value)
                        @php $path = 'assets/img/' . $key . '.png'; @endphp
                        <div class="guide-video-div form-group text-center border-0 shadow-sm mx-2 {{ $key }} d-grid" >
                            <a href="javascript:void(0)" class="download-forms text-center d-flex flex-column align-items-center justify-content-between" title="Venmo {{$key}} Guide Video" 
                                onclick="videoPreviewFunction(this)"
                                data-video="{{ Helper::validate_key_value('en', $value) }}"
                                data-video2="{{ Helper::validate_key_value('sp', $value) }}">
                                <img src="{{ url($path) }}" width="{{ $key == 'desktop_laptop' ? '70px' : '70px' }}" alt="Device Icon" class="mx-auto mb-2">
                                <small class="mt-auto">{!! VideoHelper::getVideoButtonLabel($key) !!}</small>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="video-preview-div d-none my_div mt-3 text-center">
            <div class="video-container">
                <iframe class="rumble" src="" allowfullscreen></iframe>
            </div>
            <p class="mt-3 w-100 copy_cc_r"><strong>Select Below to Get a Free Copy of your Credit Report here:</strong></p>
            <a class="btn btn-primary report_video_link border-radius-default text-center m-0" style="background:grey; border:none;pointer-events: none; color: lightgrey;" target="_blank" href="https://www.annualcreditreport.com/index.action">
                <span class="small_font_link">Click Here</span>
            </a>
            <p class="text-c-red must_watch_text">You have to watch the video first to get the reports</p>
        </div>      

      </div>
    </div>
  </div>
</div>

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/get_report_popup.css') }}">
@endpush