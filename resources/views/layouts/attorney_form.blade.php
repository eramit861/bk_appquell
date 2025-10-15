<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Bankruptcy</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!------ Include the above in your HEAD tag ---------->
	<link rel="stylesheet" href="{{ asset('assets/css/official_form.css')}}" media='all'>
	<link rel="stylesheet" href="{{ asset('assets/css/system_messages.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/facebox.css')}}">
	
    <!-- vendor css -->
	  <!-- fontawesome icon -->
	  <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200&display=swap"
		rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="{{ asset('assets/js/facebox.js' )}}"></script>
	<script src="{{ asset('assets/js/custom.js')}}?v=11"></script> 
	<script src="{{ asset('assets/js/jQuery.print.js')}}"></script>
	
</head>

<body>
<div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>

	<!-- header section -->
	<header class="hide-print">
		<div class="law-header">
			<div class=" row">
				<div class="colsm12 col-md-12 col-lg-3 vertical_center navbar_logo">
					<a class="navbar-brand" href="{{route('attorney_dashboard')}}">
						<div class="questionnaire-logo text-center">
							<img src="{{ asset('assets/img/bktextlogo.png')}}" alt="logo" class="w-auto">
						</div>
					</a>
				</div>
				<div class="colsm12 col-md-5 col-lg-3 vertical_center navbar_video">
					<?php
                        $chapterName = !isset($chapterName) ? 'Chapter 7' : $chapterName;
					$ch13v = $ch13video['en'] ?? '';
					$ch7v = $ch7video['en'] ?? '';
					?>
					<a style="display:none;" href="javascript:void(0)" class="ch7_guide <?php if ($chapterName != 'Chapter 7') {
					    echo "hide-data";
					} ?>" onclick="openvideoPopup('<?php echo $ch7v; ?>')" >
						<img src="{{ asset('assets/img/video_ch7_logo.png') }}" alt="ch7 logo" class="w-auto">
					</a>
					<a style="display:none;" href="javascript:void(0)" class="ch13_guide <?php if ($chapterName != 'Chapter 13') {
					    echo "hide-data";
					} ?>" onclick="openvideoPopup('<?php echo $ch13v; ?>')" >
						<img src="{{ asset('assets/img/video_ch13_logo.png') }}" alt="ch13 logo" class="w-auto">
					</a>
				</div>
				<div class="colsm12 col-md-2 col-lg-1 vertical_center navbar_lang">
					<div class="language-select ">
						<div class="input-group">
							<select class=" form-control w-auto p-selectBox" onchange="changeLanguage(this)" id="change-language" >
								<option value="en" class="form-control" @if (Session::get('locale') == 'en') selected="selected" @endif >English</option> 					
								<option value="es" class="form-control" @if (Session::get('locale') == 'es') selected="selected" @endif >Spanish</option> 
							</select>
						</div>
					</div>
				</div>
				<div class="colsm12 col-md-5 col-lg-5 vertical_center navbar_back">
					<?php $clientId = last(request()->segments()); ?>
					<div class="collapse navbar-collapse " id="navbarSupportedContent">
						<ul class="navbar-nav back_nav">
							<li class="nav-item logut-btn">
								<a class="nav-link font-lg-18 text-black nav_back_btn "
									href="<?php echo route('attorney_form_submission_view', ['id' => $clientId]);?>">
									<span class="back_img">
									<img src="{{ asset('assets/img/back.svg') }}" height="15px" width="15px" alt="back" /></span>
									&nbsp;Back to client Questionnaire
								</a>
								&nbsp;&nbsp;
								<a class="nav-link font-lg-18 text-black blue-btn" href="{{ route('attorney_logout')}}">Logout </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
	</header>
     @yield('content')
</body>

<script>
	window.onscroll = function () {
		fixedPressNav(window.innerWidth)
	};
	function fixedPressNav(windowWidth) {
		let width = windowWidth.toString();
		if (width > 768) {
			if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 210) {
				document.getElementById("sidebar").className = "nav flex-column nav-pills fixed-topbar";
			} else {
				document.getElementById("sidebar").className = "nav flex-column nav-pills";
			}
		} else {
			return
		}
	}

        $(document).ready(function () {
			var chaptername = "<?php echo $chapterName; ?>";
			if(chaptername == 'Chapter 7'){
				$(".ch7_guide").removeAttr('style');
				$(".ch7_guide").removeClass("hide-data");
			}
			if(chaptername == 'Chapter 13'){
				$(".ch13_guide").removeAttr('style');
				$(".ch13_guide").removeClass("hide-data");
			}

    // hide #back-top first
    $(".back-to-top").hide();

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('.back-to-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 50);
            return false;
        });
    });
});
$(document).bind('close.facebox', function(){
	$("#videoiframe").attr("src","");
}); 
openvideoPopup = function(vurl){
	laws.updateFaceboxContent('<div class="contetbv"><iframe class="embed-responsive-item" src="'+vurl+'" id="videoiframe"  allowscriptaccess="always" allow="autoplay"></iframe></div>', 'large-fb-width');
}
    </script>
	<style>.contetbv{width:100% !important;}.contetbv iframe{width:100% !important;height:530px !important;}</style>
   <div class="back-to-top">
            <a href="#top">
                <svg class="svg">
                    <use xlink:href="{{ asset('assets/img/sprite.svg#up-arrow')}}" href="{{ asset('assets/img/sprite.svg#up-arrow')}}"></use>
                </svg>
                <span>Top</span>
            </a>
        </div>
</html>
