<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @php
        $metaService = new \App\Services\MetaTagsService();
        $meta = $metaService->getTitleAndDescription();
    @endphp
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    @if(!empty($meta['keywords']))
        <meta name="keywords" content="{{ $meta['keywords'] }}">
    @endif
    @if(request()->routeIs('login'))
        <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    @endif
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js' )}}"></script>
    <script src="{{ asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js' )}}"></script>
    <!-- main.css -->
    <script src='https://www.google.com/recaptcha/api.js' defer></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/facebox.js' )}}"></script>
    <script src="{{ asset('assets/js/new/web.js')}}?v=3.12"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="{{ asset('assets/js/custom.js')}}?v=12.1"></script>
    <?php if (request()->routeIs('client_login')) { ?>
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
        <script src="{{ asset('assets/js/new/client_login.js')}}"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <?php }?>
    <?php if (request()->routeIs('login')) { ?>
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
        <script src="{{ asset('assets/js/new/attorney_login.js')}}"></script>
    <?php }?>
    <?php if (request()->routeIs('register')) {  ?>
        <script src="{{ asset('assets/js/new/attorney_register.js')}}"></script>
    <?php }?>
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/facebox.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/system_messages.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}?v=3.11">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}?v=1.21">
    <link rel="stylesheet" href="{{ asset('assets/css/new/web.css')}}?v=3.12">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @stack('tab_styles')
    @include("analytics")

    <?php if (request()->routeIs('attorney_price_table')) { ?>
        <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" /> 
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!--slick CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}" />

        <!-- main.css -->
    
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v=2.12" />
        <link rel="stylesheet" href="{{ asset('assets/css/facebox.css') }}" />
        <link rel="styleshhet" href="{{asset('assets/css/customstyle.css')}}">
        <script src="{{ asset('assets/js/custom.js')}}"></script> 
        <script src="{{ asset('assets/js/facebox.js' )}}"></script>
    <?php } ?>
</head>
<body <?php if (request()->routeIs('client_login')) { ?> class="body-class hide-data" onload="DetectAndServe()" <?php } ?>>
    @include('modal.common.client_login_screen_notice_prompt')
    @include("layouts.app.navbar",['logourl' => @$logourl])
    @yield('content')
    @stack('tab_scripts')
</body>
</html>