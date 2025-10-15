<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php
        $metaService = new \App\Services\MetaTagsService();
        $meta = $metaService->getTitleAndDescription();
    @endphp
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    @if(!empty($meta['keywords']))
        <meta name="keywords" content="{{ $meta['keywords'] }}">
    @endif
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!--slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

    <!-- main.css -->
    <script src='https://www.google.com/recaptcha/api.js' defer></script>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v=3.14">
    <link rel="stylesheet" href="{{ asset('assets/css/facebox.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(\Request::route()->getName() == "home")
    <link rel="canonical" href="https://www.bkquestionnaire.com">
    @else
    <link rel="canonical" href="https://www.bkquestionnaire.com/{{Route::current()->uri()}}">
    @endif
    <link rel="stylesheet" href="{{asset('assets/css/customstyle.css')}}?v=3.13">
    <?php $language = Config::get('app.locale'); ?>
    @include("analytics")
    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js' )}}"></script>
    <?php if (\Request::route()->getName() == "home") { ?>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/facebox.js' )}}"></script>
        <script src="{{ asset('assets/js/custom.js')}}"></script>
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('assets/js/new/home.js')}}"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/system_messages.css')}}">
    <?php } ?>
    <?php if (request()->routeIs('about') || request()->routeIs('resources') || request()->routeIs('terms_of_services')) {  ?>
        <link rel="stylesheet" href="{{ asset('assets/css/new/web.css')}}?v=3.12">
    <?php }?>
    <script src="{{ asset('assets/js/new/web.js')}}?v=3.12"></script>
</head>

<body class="{{Route::currentRouteName()}} bk-update-style">

    <!-- header -->
    <header class="bk-main-header <?php echo request()->routeIs('terms_of_services') ? 'tos-header' : ''; ?> ">
        <div class="bk-top-nav-bar">
            <div class="bk-nav-container">
                <div class="bk-nav-items">
                    <div class="call_btn">
                        <p>Call us: <a href="tel:1-888-356-5777">1-888-356-5777</a> &nbsp;&nbsp;&nbsp; Or Text us at: <a href="tel:(949) 994-4190">(949) 994-4190</a></p>
                    </div>
                    <div class="gmail_btn">
                        <a href="mailto:contact@bkquestionnaire.com">contact@bkquestionnaire.com</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="bk-main-navigation">
            <div class="container">
                <div class="d-flex bk-header-mobile">
                    <div class="bk-logo-mob"><a href="/"><img src="{{asset('assets/img/logo-white-new.png')}}" alt="BK logo white"></a></div>
                    <div class="mobileNavOpner">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" class="">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </div>
                </div>
                <div class="header_flex">

                    <div class="nav_bar">
                        <div class="logo"><a href="/"><img src="{{asset('assets/img/color_logo.png')}}" alt="BK logo white"></a></div>
                    </div>

                    <div class="nav_bar">
                        <div class="contact_btn"><a class="text-c-blue" href="/">Home</a></div>
                        <div class="contact_btn"><a class="text-c-blue" href="{{route('pricing')}}">{{ __('landingpage.pricing') }}</a></div>

                        <div class="contact_btn mobile_screen"><a href="/">Home</a></div>
                        <!-- <div class="contact_btn mobile_screen"><a href="{{route('about')}}">{{ __('landingpage.about_us') }}</a></div> -->
                        <!-- <div class="contact_btn mobile_screen"><a href="{{route('resources')}}">{{ __('landingpage.benefits') }}</a></div> -->
                        <!-- <div class="contact_btn mobile_screen"><a href="{{route('pricing')}}">{{ __('landingpage.pricing') }}</a></div> -->

                        <div class="contact_btn"><a class="text-c-blue" href="{{route('client_login')}}">{{ __('landingpage.client_login') }}</a></div>
                        <div class="contact_btn"><a class="text-c-blue" href="{{route('login')}}">{{ __('landingpage.attorney_login') }}</a></div>
                        <div class="contact_btn"><a class="text-success" href="<?php echo route("register", ['package_id' => 'standard']); ?>">{{ __('landingpage.sign_up') }}</a></div>




                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?php if (isset($include_banner) && $include_banner == true) { ?>
        <section class="hero_banner heading_titles mb-0 pb-0">
            <div class="tittle_heading text-center">
                <!-- <h3 class="light_head"></h3> -->
                <h1 class="bold_head pt-70px pb-70px mb-0">{{ __('landingpage.hero_heading') }} <br> {{ __('landingpage.hero_li_heading') }}</h1>
            </div>
            <section class="hero_banner pt-0 bk-hero-banner-section">
                <div class="container">

                    <div class="row position-relative">
                        <div class="">
                            <div class="video-banner">
                                <div class="px-3 mobile_img ">
                                    <!-- <video class="elementor-video masked w-100" autoplay loop muted playsinline>
                                    <source src="{{ asset('assets/img/BK_Phone.mp4')}}" type="video/mp4">
                                </video> -->
                                    <div class="position-relative phone-border">
                                        <img alt="iPhone Frame Border for Video Demo" src="{{asset('assets/img/iphone_border_flat.png')}}" class="position-absolute w-100">
                                    </div>
                                    <video class="elementor-video mask-flat w-100" autoplay loop muted playsinline>
                                        <source src="{{ asset('assets/img/My_project.mp4')}}" type="video/mp4">
                                    </video>


                                    <!-- <img src="{{asset('assets/img/banner-iPhone.png')}}" class="banner_iphone w-100"> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="test">
                                <div class="banner-bg">
                                    <label class="home-laptop-label bradly-heading headind-laptop">Automate Data Collection, Boost Efficiency, and Enhance The Client Experience with key features like:</label>
                                    <div class="row mt-3">
                                        <div class="col-md-5 col-sm-12">
                                            <div class="hero_banner_txt">
                                                <div class="banner_mid_txt">
                                                    <ul class="text-c-black lp-laptop-screen">
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_1_title") }}</label>
                                                            {{ __("landingpage.hero_li_1") }}
                                                        </li>
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_2_title") }}</label>
                                                            {{ __("landingpage.hero_li_2") }}
                                                        </li>
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_3_title") }}</label>
                                                            {{ __("landingpage.hero_li_3") }}
                                                        </li>
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_4_title") }}</label>
                                                            {{ __("landingpage.hero_li_4") }}
                                                        </li>
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_5_title") }}</label>
                                                            {{ __("landingpage.hero_li_5") }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5 col-sm-12">
                                            <div class="hero_banner_txt">
                                                <div class="banner_mid_txt">
                                                    <ul class="text-c-black lp-laptop-screen">
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_6_title") }}</label>
                                                            {{ __("landingpage.hero_li_6") }}
                                                        </li>
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_7_title") }}</label>
                                                            {{ __("landingpage.hero_li_7") }}
                                                        </li>
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_8_title") }}</label>
                                                            {{ __("landingpage.hero_li_8") }}
                                                        </li>
                                                        <li>
                                                            <label class="hero-li-title">{{ __("landingpage.hero_li_9_title") }}</label>
                                                            {{ __("landingpage.hero_li_9") }}
                                                        </li>
                                                        <!-- <li>{{ __("landingpage.hero_li_10") }}</li> -->
                                                        <!-- <li>{{ __("landingpage.hero_li_11") }}</li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="jubliee_partner_list ">
                                                <div class="jubliee_partner text-center">
                                                    <span class="bradly-heading fs-20 text-c-blue">We proudly partner with:</span>
                                                    <img width="150px" alt="jubilee by legalpro logo" src="{{asset('assets/img/jubliee_logo_home.png')}}" />
                                                    <span class="bradly-heading fs-20 text-c-blue">You can import your cases FREE</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-20">
                        <div class="bk-banner-button hide_on_desktop text-center">
                            <a href="#10-reasons-why" class="bk-main-button button-black">{{ __('landingpage.hero_demo_text') }}</a>
                        </div>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-4"> </div>
                    <!-- <div class="col-md-12 position-relative">
                        <div class="position-absolute bottom-0">
                        <img src="{{asset('assets/img/Seperate-Stone-cropped.png')}}" style="width: 100%;">
                        </div>
                    </div> -->
                </div>
                <!-- <div class="bk-banner-button hide_on_mobile text-center">
                    <a href="#10-reasons-why" class="bk-main-button button-black">Click here to see why our<br/>questionnaire actually works</a>
                </div> -->

                </div>
            </section>
        </section>

    <?php } ?>
    <?php if (isset($include_video) && $include_video == true) { ?>
        @include("layouts.videolp_content",['lpvideo' => $lpvideo])
    <?php } ?>

    <?php if (isset($include_video) && $include_video == true) { ?>
    <?php } else { ?>
        <div class="wraper">
            @yield('content')
        </div>
    <?php } ?>



    <!-- footer -->
    <section class="main_footer bk-lets-talk" id="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="footer_heading">
                        <h3 class="fw-bold text-black bk-font-48">
                            <span class="d-block mb-4">{{ __('landingpage.footer_heading') }} {{ __('landingpage.footer_heading2') }} {{ __('landingpage.footer_main_heading') }}</span>
                        </h3>
                        <!-- <h2></h2> -->
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12 mb-4 mb-xl-0">
                    <form method="POST" class="contact_form" action="{{ route('contact') }}">
                        @csrf
                        <div class="row">

                            <div class="col-md-4">
                                <div class="custom_input-1">
                                    <label class="lable-1">Full Name<span class="str">*</span></lable>
                                        <input type="text" name="name" class="@error('name') is-invalid @enderror" required value="" placeholder="Enter name">
                                </div>
                                @if ($errors->has('name'))
                                <p class="help-block text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <!-- <div class="row"> -->
                            <div class="col-md-4">
                                <div class="custom_input-1">
                                    <label class="lable-1">Email<span class="str">*</span></lable>
                                        <input type="email" class="@error('email') is-invalid @enderror" required name="email" value="" placeholder="Enter email">
                                </div>
                                @if ($errors->has('email'))
                                <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="custom_input-1">
                                    <label class="lable-1">Phone Number<span class="str">*</span></lable>
                                        <input type="tel" class="@error('phone') is-invalid @enderror phone-field required" required name="phone" value="" placeholder="Enter Phone Number">
                                </div>
                            </div>
                            @if ($errors->has('phone'))
                            <p class="help-block text-danger">{{ $errors->first('phone') }}</p>
                            @endif
                            <!-- </div> -->
                            <div class="col-md-8">

                                <div class="custom_input-1">
                                    <label class="lable-1">Massage<span class="str">*</span> </lable>
                                        <textarea class="@error('comment') is-invalid @enderror mt-2" required onblur="checkWords()" id="textarea" name="comment" placeholder="Write here..."></textarea>
                                </div>
                                @if ($errors->has('comment'))
                                <p class="help-block text-danger">{{ $errors->first('comment') }}</p>
                                @endif
                            </div>


                            <div class="col-md-4 mt-2">
                                    <!-- recaptcha -->
                                    @if(config('services.recaptcha.key'))
                                    <div class="form-group  g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}">
                                        @if ($errors->has('g-recaptcha-response'))
                                        <p class="help-block text-danger">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </p>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="custom_input-1 mt-3">
                                        <button class="sbt-cnt mobile_block sub_btn" type="submit">Submit</button>
                                    </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bk-main-footer">
        <div class="container">
            <div class="row">


                <div class="col-xl-2 col-lg-2 col-md-6 col-xs-12 title mb-md-0 mb-4 col-6 ">
                    <h6 class="text-capitalize mb-md-4 mb-4">Quick Links</h6>
                    <ul class="bk-foot-nav">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>
                            <a href="{{route('about')}}">{{ __('landingpage.about_us') }}</a>
                        </li>
                        <li>
                            <a href="{{route('resources')}}">{{ __('landingpage.benefits') }}</a>
                        </li>
                        <li>
                            <a href="{{route('pricing')}}">{{ __('landingpage.pricing') }}</a>
                        </li>

                    </ul>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-xs-12 title mb-md-0 mb-4 col-6">
                    <h6 class="text-capitalize mb-md-4 mb-4">login links</h6>
                    <ul class="bk-foot-nav">
                        <li>
                            <a href="{{route('client_login')}}">{{ __('landingpage.client_login') }}</a>
                        </li>
                        <li>
                            <a href="{{route('login')}}">{{ __('landingpage.attorney_login') }}</a>
                        </li>
                        <li>
                            <a href="<?php echo route("register", ['package_id' => 'standard']); ?>">{{ __('landingpage.sign_up') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-4 text-center col-md-12 col-xs-12 logo">
                    <a href="/"><img src="{{asset('assets/img/color_logo.png')}}" class="" alt="BK Assistant Logo"></a>
                </div>
                <!-- logo -->
                <div class="col-xl-2 col-md-6 col-lg-2 col-xs-12 title mb-md-0 mb-4  col-6">
                    <h6 class="text-capitalize mb-md-4 mb-4">policy</h6>
                    <ul class="bk-foot-nav">
                        <li><a href="{{route('terms_of_services')}}" class="terms">Terms of Services</a></li>
                        <li><a href="#contact-form" class="terms text-bold">Contact Us</a></li>
                        <li><a href="mailto:info@bkassistant.net" class="terms">info@bkassistant.net</a></li>
                        <li><a href="tel:1-888-356-5777" class="terms"> 1-888-356-5777</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-xs-12 title-1 mb-md-0 mb-4  col-6">
                    <h6 class="text-capitalize text-white mb-md-4 mb-4">Office</h6>
                    <div class="bk-foot-nav">
                        <span class="text-c-black text-left text-bold">BK Assistant, Inc.<br /> 1901 E 4th Street #310<br /> Santa Ana, CA 92705</span>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4">
                <p class="Copyright-text mb-0">Copyright © <?php echo date('Y'); ?> BK Assistant, Inc.</p>
            </div>
        </div>
    </footer>
    @stack('scripts')
    <script>
        $(document).ready(function() {

            $(".mobileNavOpner").click(function() {
                $(".nav_bar").toggleClass("active_ham");
            });


        });
        $(document).on("input", ".phone-field", function(evt) {

            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
            var first10 = $(this).val().substring(0, 14);
            if (this.value.length > 14) {
                this.value = first10;
            }


        });

        function checkWords() {
            var my_textarea = document.getElementById('textarea').value;
            var pattern = /fox|dog|fuck|pussy|dick|lick|http|cock|penish|watering|fuck|xbebz.freelovehere|abbo|abo|abortion|abuse|addict|addicts|adult|africa|african|alla|allah|alligatorbait|amateur|american|anal|analannie|analsex|angie|angry|anus|arab|arabs|areola|argie|aroused|arse|arsehole|asian|ass|assassin|assassinate|assassination|assault|assbagger|assblaster|assclown|asscowboy|asses|assfuck|assfucker|asshat|asshole|assholes|asshore|assjockey|asskiss|asskisser|assklown|asslick|asslicker|asslover|assman|assmonkey|assmunch|assmuncher|asspacker|asspirate|asspuppies|assranger|asswhore|asswipe|athletesfoot|attack|australian|babe|babies|backdoor|backdoorman|backseat|badfuck|balllicker|balls|ballsack|banging|baptist|barelylegal|barf|barface|barfface|bast|bastard |bazongas|bazooms|beaner|beast|beastality|beastial|beastiality|beatoff|beat-off|beatyourmeat|beaver|bestial|bestiality|bi|biatch|bible|bicurious|bigass|bigbastard|bigbutt|bigger|bisexual|bi-sexual|bitch|bitcher|bitches|bitchez|bitchin|bitching|bitchslap|bitchy|biteme|black|blackman|blackout|blacks|blind|blow|blowjob|boang|bogan|bohunk|bollick|bollock|bomb|bombers|bombing|bombs|bomd|bondage|boner|bong|boob|boobies|boobs|booby|boody|boom|boong|boonga|boonie|booty|bootycall|bountybar|bra|brea5t|breast|breastjob|breastlover|breastman|brothel|bugger|buggered|buggery|bullcrap|bulldike|bulldyke|bullshit|bumblefuck|bumfuck|bunga|bunghole|buried|burn|butchbabes|butchdike|butchdyke|butt|buttbang|butt-bang|buttface|buttfuck|butt-fuck|buttfucker|butt-fucker|buttfuckers|butt-fuckers|butthead|buttman|buttmunch|buttmuncher|buttpirate|buttplug|buttstain|byatch|cacker|cameljockey|cameltoe|canadian|cancer|carpetmuncher|carruth|catholic|catholics|cemetery|chav|cherrypopper|chickslick|chin|chinaman|chinamen|chinese|chink|chinky|choad|chode|christ|christian|church|cigarette|cigs|clamdigger|clamdiver|clit|clitoris|clogwog|cocaine|cock|cockblock|cockblocker|cockcowboy|cockfight|cockhead|cockknob|cocklicker|cocklover|cocknob|cockqueen|cockrider|cocksman|cocksmith|cocksmoker|cocksucer|cocksuck |cocksucked |cocksucker|cocksucking|cocktail|cocktease|cocky|cohee|coitus|color|colored|coloured|commie|communist|condom|conservative|conspiracy|coolie|cooly|coon|coondog|copulate|cornhole|corruption|cra5h|crabs|crack|crackpipe|crackwhore|crack-whore|crap|crapola|crapper|crappy|crash|creamy|crime|crimes|criminal|criminals|crotch|crotchjockey|crotchmonkey|crotchrot|cum|cumbubble|cumfest|cumjockey|cumm|cummer|cumming|cumquat|cumqueen|cumshot|cunilingus|cunillingus|cunn|cunnilingus|cunntt|cunt|cunteyed|cuntfuck|cuntfucker|cuntlick |cuntlicker |cuntlicking |cuntsucker|cybersex|cyberslimer|dago|dahmer|dammit|damn|damnation|damnit|darkie|darky|datnigga|dead|deapthroat|death|deepthroat|defecate|dego|demon|deposit|desire|destroy|deth|devil|devilworshipper|dick|dickbrain|dickforbrains|dickhead|dickless|dicklick|dicklicker|dickman|dickwad|dickweed|diddle|die|died|dies|dike|dildo|dingleberry|dink|dipshit|dipstick|dirty|disease|diseases|disturbed|dive|dix|dixiedike|dixiedyke|doggiestyle|doggystyle|dong|doodoo|doo-doo|doom|dope|dragqueen|dragqween|dripdick|drug|drunk|drunken|dumb|dumbass|dumbbitch|dumbfuck|dyefly|dyke|easyslut|eatballs|eatme|eatpussy|ecstacy|ejaculate|ejaculated|ejaculating |ejaculation|enema|enemy|erect|erection|ero|escort|ethiopian|ethnic|european|evl|excrement|execute|executed|execution|executioner|explosion|facefucker|faeces|fag|fagging|faggot|fagot|failed|failure|fairies|fairy|faith|fannyfucker|fart|farted |farting |farty |fastfuck|fat|fatah|fatass|fatfuck|fatfucker|fatso|fckcum|fear|feces|felatio |felch|felcher|felching|fellatio|feltch|feltcher|feltching|fetish|fight|filipina|filipino|fingerfood|fingerfuck |fingerfucked |fingerfucker |fingerfuckers|fingerfucking |fire|firing|fister|fistfuck|fistfucked |fistfucker |fistfucking |fisting|flange|flasher|flatulence|floo|flydie|flydye|fok|fondle|footaction|footfuck|footfucker|footlicker|footstar|fore|foreskin|forni|fornicate|foursome|fourtwenty|fraud|freakfuck|freakyfucker|freefuck|fu|fubar|fuc|fucck|fuck|fucka|fuckable|fuckbag|fuckbuddy|fucked|fuckedup|fucker|fuckers|fuckface|fuckfest|fuckfreak|fuckfriend|fuckhead|fuckher|fuckin|fuckina|fucking|fuckingbitch|fuckinnuts|fuckinright|fuckit|fuckknob|fuckme |fuckmehard|fuckmonkey|fuckoff|fuckpig|fucks|fucktard|fuckwhore|fuckyou|fudgepacker|fugly|fuk|fuks|funeral|funfuck|fungus|fuuck|gangbang|gangbanged |gangbanger|gangsta|gatorbait|gay|gaymuthafuckinwhore|gaysex |geez|geezer|geni|genital|german|getiton|gin|ginzo|gipp|girls|givehead|glazeddonut|gob|god|godammit|goddamit|goddammit|goddamn|goddamned|goddamnes|goddamnit|goddamnmuthafucker|goldenshower|gonorrehea|gonzagas|gook|gotohell|goy|goyim|greaseball|gringo|groe|gross|grostulation|gubba|gummer|gun|gyp|gypo|gypp|gyppie|gyppo|gyppy|hamas|handjob|hapa|harder|hardon|harem|headfuck|headlights|hebe|heeb|hell|henhouse|heroin|herpes|heterosexual|hijack|hijacker|hijacking|hillbillies|hindoo|hiscock|hitler|hitlerism|hitlerist|hiv|ho|hobo|hodgie|hoes|hole|holestuffer|homicide|homo|homobangers|homosexual|honger|honk|honkers|honkey|honky|hook|hooker|hookers|hooters|hore|hork|horn|horney|horniest|horny|horseshit|hosejob|hoser|hostage|hotdamn|hotpussy|hottotrot|hummer|husky|hussy|hustler|hymen|hymie|iblowu|idiot|ikey|illegal|incest|insest|intercourse|interracial|intheass|inthebuff|israel|israeli|israel|italiano|itch|jackass|jackoff|jackshit|jacktheripper|jade|jap|japanese|japcrap|jebus|jeez|jerkoff|jesus|jesuschrist|jew|jewish|jiga|jigaboo|jigg|jigga|jiggabo|jigger |jiggy|jihad|jijjiboo|jimfish|jism|jiz |jizim|jizjuice|jizm |jizz|jizzim|jizzum|joint|juggalo|jugs|junglebunny|kaffer|kaffir|kaffre|kafir|kanake|kid|kigger|kike|kill|killed|killer|killing|kills|kink|kinky|kissass|kkk|knife|knockers|kock|kondum|koon|kotex|krap|krappy|kraut|kum|kumbubble|kumbullbe|kummer|kumming|kumquat|kums|kunilingus|kunnilingus|kunt|ky|kyke|lactate|laid|lapdance|latin|lesbain|lesbayn|lesbian|lesbin|lesbo|lez|lezbe|lezbefriends|lezbo|lezz|lezzo|liberal|libido|licker|lickme|lies|limey|limpdick|limy|lingerie|liquor|livesex|loadedgun|lolita|looser|loser|lotion|lovebone|lovegoo|lovegun|lovejuice|lovemuscle|lovepistol|loverocket|lowlife|lsd|lubejob|lucifer|luckycammeltoe|lugan|lynch|macaca|mad|mafia|magicwand|mams|manhater|manpaste|marijuana|mastabate|mastabater|masterbate|masterblaster|mastrabator|masturbate|masturbating|mattressprincess|meatbeatter|meatrack|meth|mexican|mgger|mggor|mickeyfinn|mideast|milf|minority|mockey|mockie|mocky|mofo|moky|moles|molest|molestation|molester|molestor|moneyshot|mooncricket|mormon|moron|moslem|mosshead|mothafuck|mothafucka|mothafuckaz|mothafucked |mothafucker|mothafuckin|mothafucking |mothafuckings|motherfuck|motherfucked|motherfucker|motherfuckin|motherfucking|motherfuckings|motherlovebone|muff|muffdive|muffdiver|muffindiver|mufflikcer|mulatto|muncher|munt|murder|murderer|muslim|naked|narcotic|nasty|nastybitch|nastyho|nastyslut|nastywhore|nazi|necro|negro|negroes|negroid|negro|nig|niger|nigerian|nigerians|nigg|nigga|niggah|niggaracci|niggard|niggarded|niggarding|niggardliness|niggardliness|niggardly|niggards|niggard|niggaz|nigger|niggerhead|niggerhole|niggers|nigger|niggle|niggled|niggles|niggling|nigglings|niggor|niggur|niglet|nignog|nigr|nigra|nigre|nip|nipple|nipplering|nittit|nlgger|nlggor|nofuckingway|nook|nookey|nookie|noonan|nooner|nude|nudger|nuke|nutfucker|nymph|ontherag|oral|orga|orgasim |orgasm|orgies|orgy|osama|paki|palesimian|palestinian|pansies|pansy|panti|panties|payo|pearlnecklace|peck|pecker|peckerwood|pee|peehole|pee-pee|peepshow|peepshpw|pendy|penetration|peni5|penile|penis|penises|penthouse|period|perv|phonesex|phuk|phuked|phuking|phukked|phukking|phungky|phuq|pi55|picaninny|piccaninny|pickaninny|piker|pikey|piky|pimp|pimped|pimper|pimpjuic|pimpjuice|pimpsimp|pindick|piss|pissed|pisser|pisses |pisshead|pissin |pissing|pissoff |pistol|pixie|pixy|playboy|playgirl|pocha|pocho|pocketpool|pohm|polack|pom|pommie|pommy|poo|poon|poontang|poop|pooper|pooperscooper|pooping|poorwhitetrash|popimp|porchmonkey|porn|pornflick|pornking|porno|pornography|pornprincess|pot|poverty|premature|pric|prick|prickhead|primetime|propaganda|pros|prostitute|protestant|pu55i|pu55y|pube|pubic|pubiclice|pud|pudboy|pudd|puddboy|puke|puntang|purinapricness|puss|pussie|pussies|pussy|pussycat|pussyeater|pussyfucker|pussylicker|pussylips|pussylover|pussypounder|pusy|quashie|queef|queer|quickie|quim|ra8s|rabbi|racial|racist|radical|radicals|raghead|randy|rape|raped|raper|rapist|rearend|rearentry|rectum|redlight|redneck|reefer|reestie|refugee|reject|remains|rentafuck|republican|rere|retard|retarded|ribbed|rigger|rimjob|rimming|roach|robber|roundeye|rump|russki|russkie|sadis|sadom|samckdaddy|sandm|sandnigger|satan|scag|scallywag|scat|schlong|screw|screwyou|scrotum|scum|semen|seppo|servant|sex|sexed|sexfarm|sexhound|sexhouse|sexing|sexkitten|sexpot|sexslave|sextogo|sextoy|sextoys|sexual|sexually|sexwhore|sexy|sexymoma|sexy-slim|shag|shaggin|shagging|shat|shav|shawtypimp|sheeney|shhit|shinola|shit|shitcan|shitdick|shite|shiteater|shited|shitface|shitfaced|shitfit|shitforbrains|shitfuck|shitfucker|shitfull|shithapens|shithappens|shithead|shithouse|shiting|shitlist|shitola|shitoutofluck|shits|shitstain|shitted|shitter|shitting|shitty |shoot|shooting|shortfuck|showtime|sick|sissy|sixsixsix|sixtynine|sixtyniner|skank|skankbitch|skankfuck|skankwhore|skanky|skankybitch|skankywhore|skinflute|skum|skumbag|slant|slanteye|slapper|slaughter|slav|slave|slavedriver|sleezebag|sleezeball|slideitin|slime|slimeball|slimebucket|slopehead|slopey|slopy|slut|sluts|slutt|slutting|slutty|slutwear|slutwhore|smack|smackthemonkey|smut|snatch|snatchpatch|snigger|sniggered|sniggering|sniggers|snigger|sniper|snot|snowback|snownigger|sob|sodom|sodomise|sodomite|sodomize|sodomy|sonofabitch|sonofbitch|sooty|sos|soviet|spaghettibender|spaghettinigger|spank|spankthemonkey|sperm|spermacide|spermbag|spermhearder|spermherder|spic|spick|spig|spigotty|spik|spit|spitter|splittail|spooge|spreadeagle|spunk|spunky|squaw|stagg|stiffy|strapon|stringer|stripclub|stroke|stroking|stupid|stupidfuck|stupidfucker|suck|suckdick|sucker|suckme|suckmyass|suckmydick|suckmytit|suckoff|suicide|swallow|swallower|swalow|swastika|sweetness|syphilis|taboo|taff|tampon|tang|tantra|tarbaby|tard|teat|terror|terrorist|teste|testicle|testicles|thicklips|thirdeye|thirdleg|threesome|threeway|timbernigger|tinkle|tit|titbitnipply|titfuck|titfucker|titfuckin|titjob|titlicker|titlover|tits|tittie|titties|titty|tnt|toilet|tongethruster|tongue|tonguethrust|tonguetramp|tortur|torture|tosser|towelhead|trailertrash|tramp|trannie|tranny|transexual|transsexual|transvestite|triplex|trisexual|trojan|trots|tuckahoe|tunneloflove|turd|turnon|twat|twink|twinkie|twobitwhore|uck|uk|unfuckable|upskirt|uptheass|upthebutt|urinary|urinate|urine|usama|uterus|vagina|vaginal|vatican|vibr|vibrater|vibrator|vietcong|violence|virgin|virginbreaker|vomit|vulva|wab|wank|wanker|wanking|waysted|weapon|weenie|weewee|welcher|welfare|wetb|wetback|wetspot|whacker|whash|whigger|whiskey|whiskeydick|whiskydick|whit|whitenigger|whites|whitetrash|whitey|whiz|whop|whore|whorefucker|whorehouse|wigger|willie|williewanker|willy|wn|wog|women|wop|wtf|wuss|wuzzie|xtc|xxx|yankee|yellowman|zigabo|zipperhead/ig;

            if (my_textarea.match(pattern)) {
                alert("Website url and bad words not allowed!");
                document.getElementById('textarea').value = '';
            }

        }
    </script>
    <style>
        #facebox .close {
            top: 10px;
        }
    </style>
</body>

</html>