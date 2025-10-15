<section class="hero_banner">
            <div class="container">
                <div class="row position-relative">
                    <div class="col-md-9 col-sm-6 banner_txt">
                        <div class="hero_banner_txt">
                            <h1>{{ __('landingpage.hero_heading') }}</h1>
                            <div class="banner_mid_txt1">
                                <h3>
                                    <em>{{ __('landingpage.hero_desc') }}</em><br>
                                </h3>
                            </div>
                            <div class="v_container">
                                <iframe  class="rumble responsive_iframe lpvi mt-2" style="" src="<?php echo $lpvideo['en']; ?>" frameborder="0" autoplay allowfullscreen></iframe>
                            </div>
                            <p class="morein"> <a class="theme_btn rounded-pill btn_land" href="/">Click here for more information</a></p>
                        </div>
                        
                        

                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="banner_img text-center">
                            <div class="video_frame">
                                <video class="elementor-video masked w-100" autoplay="autoplay"
                                    loop="" muted="" defaultmuted="" playsinline="" style=" -webkit-mask-image: url({{ asset('assets/img/Phone_BKAssistant_mask_730.png')}});
                                     mask-image: url({{ asset('assets/img/Phone_BKAssistant_mask_730.png')}});">
                                    <source src="{{ asset('assets/img/BK_Phone.mp4')}}" type="video/mp4">

                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>