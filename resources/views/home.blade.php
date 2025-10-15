@extends('layouts.landing-page', ['include_banner' => true])
@section('content')

<?php
$language = Config::get('app.locale');
$videos = VideoHelper::getAdminVideos();
?>


<section class="bk-section-padd pt-0 bk-full-height-section bk-10-reasons d-block" id="10-reasons-why">
  <div class="container ">
    <div class="row pt-70px">
      <div class="col-md-12 ">
        <h2 class="text-c-black text-center" style="font-size: 1.25rem;">
          Empower your clients with unmatched flexibility!
        </h2>
        <p class="text-c-black text-center" style="font-size: 1.25rem; margin: 0;">
          Whether they're on a phone, tablet, or computer, our intuitive apps and responsive website provide seamless access anytime, anywhere, and even across multiple devices <u>simultaneously</u>
        </p>
      </div>
    </div>
  </div>
  <div class=" pt-70px pb-70px">
    <div class="col-md-12 text-center">
      <?php
      $tutorialIphone = $videos[Helper::DOCUMENT_PAGE_IPHONE_VIDEO_GUIDE] ?? [];
$videoiPhone = VideoHelper::getVideos($tutorialIphone);

$tutorialAndroid = $videos[Helper::DOCUMENT_PAGE_ANDROID_VIDEO_GUIDE] ?? [];
$videoAndroid = VideoHelper::getVideos($tutorialAndroid);

$tutorialDesktop = $videos[Helper::DOCUMENT_PAGE_DESKTOP_VIDEO_GUIDE] ?? [];
$videoDesktop = VideoHelper::getVideos($tutorialDesktop);
?>
      <div style="width:150px;display:inline-block;">
        <img src="{{url('assets/img/iphone.png')}}" alt="BK Assistant iPhone App Icon" width="100px"><br> <strong class="text-c-blue">Apple</strong>
      </div>
      <div style="width:150px;display:inline-block;">
        <img src="{{url('assets/img/android.png')}}" alt="BK Assistant Android App Icon" width="100px"><br> <strong class="text-c-blue ">Android</strong>
      </div>
      <div style="width:150px;display:inline-block;">
        <img src="{{url('assets/img/desktop_laptop.png')}}" alt="BK Assistant Desktop Website Icon" width="160px"><br><strong class="text-c-blue">Website</strong>
      </div>
    </div>
    <div class="bk-installation-are bk-installation-are-btn mt-5 align-items-center">
      <div class="">
        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.bkassistant.scannerapp"><img src="{{ asset('assets/img/Frame_1.png')}}" alt="Download BK Assistant from Google Play Store" class="play_store" style="width:167px"></a>
      </div>
      <div class="">
        <img class="d-flex flex-column flex-md-row" src="{{ asset('assets/img/App-tile.png')}}" alt="BK Assistant Mobile App Screenshot">
      </div>
      <div class="">
        <a target="_blank" href="https://apps.apple.com/us/app/bk-assistant/id1619964805"><img src="{{ asset('assets/img/Frame_2.png')}}" alt="Download BK Assistant from Apple App Store" class="app_store" style="width:167px"></a>
      </div>
    </div>
  </div>

  <div class="tittle_heading mt-4 mb-0 tri_merge_txt text-center liner-bg ">
    <h2 class="bk-font-48 text-bold  text-c-black liner-h2 custom-eight">8</h2>
    <h2 class="bk-font-48 text-bold text-c-black mt-4 pt-70px">{{ __('landingpage.reason_box_title') }}</h2>
    <ul class="ul-style-disc custom-dash-style_icon bk-check-mark_icon ps-4 secttwocolm_ul">
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_1_head') }}</li>
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_2_head') }}</li>
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_3_head') }}</li>
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_4_head') }}</li>
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_5_head') }}</li>
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_6_head') }}</li>
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_7_head') }}</li>
      <li class="text-c-blue-bold"><i class="bi bi-check"></i>{{ __('landingpage.reason_box_8_head') }}</li>
    </ul>
  </div>
  <div class="container">
    <div class="row reasonBox mt-3 bk-number-list-reset"></div>
    <div class="row reasonBox mt-3 bk-number-list-reset">
      <div class="col-md-6">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">1</span>{{ __('landingpage.reason_box_1_head') }}</h3>
        <span>{{ __('landingpage.reason_box_1') }}</span>
        <div class="reason-video-div mt-2">
          <?php
    $tutorial = $videos[Helper::LANDING_PAGE_10_REASON_AUTOMATED_DOCUMENT_COLLECTION] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
        <!-- <br> -->
      </div>
      <div class="col-md-6">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">5</span>{{ __('landingpage.reason_box_2_head') }}</h3>
        <span>{{ __('landingpage.reason_box_2') }}</span>
        <div class="reason-video-div mt-2">
          <?php
$tutorial = $videos[Helper::LANDING_PAGE_10_REASON_DYNAMIC_QUESTIONING] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="row reasonBox mt-3 bk-number-list-reset">
      <div class="col-md-6">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">2</span>{{ __('landingpage.reason_box_3_head') }}</h3>
        <span>{{ __('landingpage.reason_box_3') }}</span>
        <div class="reason-video-div mt-2">
          <?php
$tutorial = $videos[Helper::LANDING_PAGE_10_REASON_DOCUMENT_MANAGMENT] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
      </div>

      <div class="col-md-6">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">6</span>{{ __('landingpage.reason_box_4_head') }}</h3>
        <span>{{ __('landingpage.reason_box_4') }}</span>
        <div class="reason-video-div mt-2">
          <?php
$tutorial = $videos[Helper::LANDING_PAGE_10_REASON_DETAILED_PROPERTY_TAB] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
      </div>


    </div>
    <div class="row reasonBox mt-3 bk-number-list-reset">
      <div class="col-md-6 reason-box">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">3</span>{{ __('landingpage.reason_box_5_head') }}</h3>
        <span>{{ __('landingpage.reason_box_5') }}</span>
        <div class="reason-video-div mt-2">
          <?php
$tutorial = $videos[Helper::LANDING_PAGE_10_REASON_BUILT_IN_REVOLUTIONARY_FOLLOW_UP_SYSTEM] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-md-6 reason-box">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">7</span>{{ __('landingpage.reason_box_6_head') }}</h3>
        <span>{{ __('landingpage.reason_box_6') }}</span>
        <div class="reason-video-div mt-2">
          <?php
$tutorial = $videos[Helper::LANDING_PAGE_10_REASON_COLLABORATIVE_CLIENT_ENGAGEMENT] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="row reasonBox mt-3 bk-number-list-reset">
      <div class="col-md-6 reason-box">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">4</span>{{ __('landingpage.reason_box_7_head') }}</h3>
        <span>{{ __('landingpage.reason_box_7') }}</span>
        <div class="reason-video-div mt-2">
          <?php
$tutorial = $videos[Helper::LANDING_PAGE_10_REASON_BUILT_IN_COMMON_CREDITOR_LISTS] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-md-6 reason-box">

        <h3 class="text-c-blue-bold" style="font-size: 1.25rem;"><span class="sno">8</span>{{ __('landingpage.reason_box_8_head') }}</h3>
        <span>{{ __('landingpage.reason_box_8') }}</span>
        <div class="reason-video-div mt-2">
          <?php
$tutorial = $videos[Helper::LANDING_PAGE_10_REASON_AUTOMATED_DOCUMENT_CONVERSION_TOPDF] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
          <iframe class="rumble" width="100%" height="100%" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
        </div>
      </div>

    </div>

  </div>
  <div class="container">
    <div class="col-md-12 mt-5 reason-box">
      <h2 class="text-bold text-black bk-font-48">Why BK Questionnaire is a Game Changer for You, Your Clients, and Your Firm:</h2>
      <h3 class="text-bold  text-center  text-c-blue pt-2">In general in the bankruptcy business we have 3 kinds of clients:</h3>
      <!-- .text-c-blue{color:#012cae;} -->
      <div class="d-flex justify-content-around p-4">
        <div class="text-success text-bold  text-center fs-4">20% Rock Stars:</div>
        <div class="text-bold  text-center fs-4">70% Average Clients:</div>
        <div class="text-danger text-bold  text-center fs-4">10% Challenging Clients:</div>
      </div>



      <div>
        <div class="ul text-danger text-bold fs-5 mb-2"><u>
            Most Process Issues:</u>
        </div>
      </div>
      <!-- </li> -->

      <ol class="fw-600 fs-16">

        <li class="fs-6 mb-1">
          <div class="d-flex">
            <span class="w-100">
              Many law firms focus on optimizing procedures for their top 20% of clients (rock stars). Yet, they often
              underestimate the significant amount of time and effort their staff spends managing the other 80% of clients
              who drive the core of their business.
            </span>
          </div>
        </li>

        <li class="fs-6 mb-1">
          <div class="d-flex">
            <div class="w-100">
              <span class="w-100">
                Most bankruptcy software falls short, offering little to no real timesaving or cost-cutting solutions for your bankruptcy process or practice.
              </span>
            </div>
          </div>
        </li>

        <li class="fs-6 mb-1">
          <div class="d-flex">
            <div class="w-100">
              <span>
                Most bankruptcy software doesn't save you any money or time at all. This is because most bankruptcy
                software companies cater to law firms and attorneys since they are the purchasers of their products.
              </span>
            </div>
          </div>
        </li>
        <li class="fs-6 mb-1">
          <div class="d-flex">
            <div class="w-100">
              <span>
                Anything in your process and/or software that’s difficult for your clients will eventually make it difficult for you and your staff as well.
              </span>
            </div>
          </div>
        </li>

        <li class="fs-6 mb-1">
          <div class="d-flex">
            <div class="w-100">
              <span>
                Beyond the Rock Star clients, most others simply need clear direction and simplicity. It’s not that they’re not
                smart or lazy, it’s that they’re under immense stress. And when we're overwhelmed, even the simplest tasks
                can feel daunting, as stress clouds judgment and common sense becomes harder to reach.
              </span>
            </div>
          </div>
        </li>

      </ol>

      <div class="text-bold pt-3 pb-2 fs-5 text-c-blue">
        <u>BK Questionnaire Is The Solution:</u>
      </div>

      <div class="bk-sol-section">
        <p>BK Questionnaire targets the 70% of clients that make up most of your business. Streamlining this largest segment is the most effective way to optimize operations and achieve significant savings for you and your firm.</p>
        <p class="mb-2"><strong>How we do this:</strong></p>
        <p class="mb-2">Our system integrates data entry for petitions and document requests into a single streamlined workflow, allowing seamless import into your existing petition preparation software. By automating tedious tasks like document handling, client follow-ups, and tracking required documents needed to file your client(s) case, our solution simplifies the entire process, including sending trustee documents, into one efficient system.</p>
        <p class="mb-2">BK Questionnaire addresses the significant time investment that isn't reflected in your profit/loss statement, yet it's this time that it incurs the highest costs, particularly in terms of support staff and your own time.</p>
        <p class="">We believe the average total time spent at BK Questionnaire by support staff is roughly 10-12 hours nationally in our estimation for very efficient law firms.</p>
        <p class="mb-2"><strong>All the research and even every AI model backs that up:</strong></p>
        <div class="row">
          <div class="col-6">
            <p><span style="color:blueviolet">Chat GPT</span> AI average time = 9-18 hours Don't believe us <a href="javascript:void(0)" style="text-decoration: underline !important;" onclick="openImagePopup('chat-gpt-ai-popup', 'fullWidth');">Click Here</a></p>
            <div class="hide-data chat-gpt-ai-popup">
              <img class="webkit_fill" src="{{url('assets/img/chat-gpt-ai-popup.png')}}" alt="ChatGPT AI Bankruptcy Processing Time Analysis" />
            </div>
          </div>
          <div class="col-6">
            <p><span style="color:blueviolet">GROK AI</span> average time = 10-20 hours Don't believe us <a href="javascript:void(0)" style="text-decoration: underline !important;" onclick="openImagePopup('grok-ai-popup', 'fullWidth');">Click Here</a></p>
            <div class="hide-data grok-ai-popup">
              <img class="webkit_fill" src="{{url('assets/img/grok-ai-popup.png')}}" alt="Grok AI Bankruptcy Case Time Estimate" />
            </div>
          </div>
        </div>
        <p class="mb-2"><strong>Here is how to see how much time you’re not accounting for:</strong></p>
        <p class="mb-2">Examples:</p>
        <p class="mb-2">If you file <span style="color:green;">120 cases per month</span> and you have 10 support staff = <span style="color:red;">10 hours a case</span>.</p>
        <p class="mb-2">If you file <span style="color:green;">50 cases per month</span> and have 4 support staff = <span style="color:red;">12.5 hours a case</span>.</p>
        <p>Schedule a demo and discover how BK Questionnaire can save you more money per case than its cost—making it a solution that pays for itself.</p>
        <p class="text-center">
          <a target="_blank" class="bk-main-button button-blue" href="<?php echo Helper::CALENDY_BOOK_A_MEETING_URL . "?month=" . date('Y-m'); ?>">SCHEDULE A DEMO HERE</a>
        </p>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>

<section class="section_our_client bk-section-padd bk-full-height-section">
  <div class="container">
    <div class="tittle_heading text-center">

      <h2 class="bk-font-40">
        <strong> {{ __('landingpage.section2_heading1') }} </strong>
      </h2>
    </div>
    <?php
    $tutorial = $videos[Helper::LANDING_PAGE_BIG_TAB_VIDEO] ?? [];
$video = VideoHelper::getVideos($tutorial);
?>
    <div class="row">
      <div class="bk-video-image">
        <iframe class="rumble" width="930" height="523" src="<?php echo $language == 'en' ? $video['en'] : $video['sp']; ?>" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>




<section class="bk-section-padd bk-full-height-section bk-why-our-software">
  <div class="container">
    <h2 class="bk-font-48 text-c-black text-center text-bold">
      These next two optional items are coming soon:
    </h2>
    <div class="row align-items-center_1 pt-5">

      <div class="col-md-12 col-lg-6 col-xl-6 mb-4 mb-xl-0">
        <div class="Challenges_box_1 bk-challenge-box-white">
          <div class="Challengesbs">
            <h3 class="text-c-black link-underline">Tax Dischargeability Assistant:</h3>
            <h5 class="text-c-black mt-4">With built in 4506T we pull your clients:</h5>
            <ul class="Challenges_box">

              <li>Last 5 years of Tax Transcripts</li>
              <li>A Dischargeability report directly from the IRS</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-xl-6 mb-4 mb-xl-0">
        <div class="w-100">
          <img src="{{ asset('assets/img/tax.png')}}" class="w-100" alt="Tax Dischargeability Assistant Feature">
        </div>
      </div>
    </div>

    <div class="row align-items-center_1 pt-5 mt-5">

      <div class="col-md-12 col-lg-6 col-xl-6 mb-4 mb-xl-0">
        <div class="Challenges_box_1 bk-challenge-box-blue">
          <div class="Challengesbdd">
            <h3 class="text-c-black link-underline">Automated Payroll Assistant:</h3>
            <ul class="Challenges_box">
              <li>With just one click, our system harnesses OCR and AI technology to pull data directly
                from each pay stub within the current CMI, automatically filling out the means test and Schedule I.
                Each paycheck is processed individually, simplifying the means test, Schedule I, and income calculation.
                This data is then be imported with the rest of the questionnaire into your preparation software</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-xl-6 mb-4 mb-xl-0 bk-group-benifit-section">

        <div class="bk-blue-secttion bk-blue-secttion_box text-center ">
          <img src="{{ asset('assets/img/coming.png')}}" alt="Automated Payroll Assistant Coming Soon">
          <h6 class="bk-font-24">Coming Soon</h6>
          <p>Ask us about</p>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<!-- Bank Statement Asisstant -->

@include("layouts.common_pricing",['is_price_table' => false])

<!-- Review Section -->

@include("layouts.review")


<!--  secttwocolm   -->
<section class="secttwocolm triangle_bg bk-full-access-section bk-section-padd bk-full-height-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="tri_merge_txt">
          <h2 class="bk-font-48 text-center">{{ __('landingpage.secttwocolm_col4_heading') }}</h2>
          <ul class="ul-style-disc custom-dash-style_icon bk-check-mark_icon ps-4 secttwocolm_ul">
            <li><i class="bi bi-check"></i>{{ __('landingpage.secttwocolm_col4_point1_desc') }}</li>
            <li><i class="bi bi-check"></i>{{ __('landingpage.secttwocolm_col4_point2_desc') }}</li>
            <li><i class="bi bi-check"></i>{{ __('landingpage.secttwocolm_col4_point3_desc') }}</li>
            <li><i class="bi bi-check"></i>{{ __('landingpage.secttwocolm_col4_point4_desc') }}</li>
            <li><i class="bi bi-check"></i>{{ __('landingpage.secttwocolm_col4_point5_desc') }}</li>
            <li><i class="bi bi-check"></i>{{ __('landingpage.secttwocolm_col4_point6_desc') }}</li>
            <li><i class="bi bi-check"></i>{{ __('landingpage.secttwocolm_col4_point9_desc') }}</li>
          </ul>
          <div class="tri_merge_btn mt-5">
          </div>


          <div class="row footer_mobile">

            <div class="col-md-6"></div>

            <div class="col-md-6 d-flex flex-column justify-content-center">
              <h2 class="fw-bolderbk-font-48 text-center pb-0">Leading the Way with Innovative Industry-First Client Apps</h2>
              <div class="bk-installation-are bk-installation-are-btn my-5 py-3">
                <div class="play_store_sec">
                  <a target="_blank" href="https://play.google.com/store/apps/details?id=com.bkassistant.scannerapp"><img src="{{ asset('assets/img/Frame_1.png')}}" alt="Download BK Assistant from Google Play Store" class="play_store" style="width:167px"></a>
                </div>
                <div class="app_store_sec">
                  <a target="_blank" href="https://apps.apple.com/us/app/bk-assistant/id1619964805"><img src="{{ asset('assets/img/Frame_2.png')}}" alt="Download BK Assistant from Apple App Store" class="app_store" style="width:167px"></a>
                </div>
              </div>
              <h2 class="fw-bolderbk-font-48 text-center ">Included in all packages</h2>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- <div class="images-9"></div> -->



<div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
    <div class="modal-content">
      <div class="container absolute-swich-btn">
        <div class="col-md-12 ug english">
          <div class="card popup-video bg-light">
            <div class="card-body text-center">
              <iframe class="embed-responsive-item" id="video" allow="autoplay"></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-12 mt-5 phd spanish" style="display: none">
          <div class="card bg-primaryp popup-video spanish-desktop-video">
            <div class="card-body text-center">
              <iframe id="player1" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="image-outer hide-data">
  <div class="image p-3">
    <div class="">
      @include("pricing_table")
    </div>
  </div>
</div>

@include("layouts.flash")

@endsection