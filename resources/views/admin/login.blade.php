<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bankruptcy</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}?v=3.10">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}?v=1.2">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <div class="auth-header">
        <header class="site-header">
            <div class="container">
                <nav class="navbar">
                    <div class="brand header-brand">
                        <a href="{{url('/')}}">
                            <img src="{{ url('assets/images/logo.png')}}" alt="Logo">
                        </a>
                    </div>                    
                </nav>
            </div>
        </header>
    </div>
	@include("layouts.flash")
	<form action="{{route('authenticate_admin')}}" method="post" novalidate>
    <div class="auth-wrapper">
		@csrf
        <div class="auth-content">
            <div class="card-wrapper">
                <div class="card-body">
                    <div class="login-title">
                        <h3 class="mb-3 mt-3">Admin Login</h3>
                       
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name ="email" class="form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email">
                    </div>
					@if ($errors->has('email'))
						<p class="help-block text-danger">{{ $errors->first('email') }}</p>
					@endif
                    <input id="uuid_token" type="hidden" class="form-control" name="uuid_token" value="">
                    <div class="input-group mb-4">
                        <input type="password" name ="password" class="form-control {{ $errors->has('password') ? 'btn-outline-danger' : '' }}" placeholder="password">
                    </div>
					@if ($errors->has('password'))
						<p class="help-block text-danger">{{ $errors->first('password') }}</p>			
					@endif
                    <div class="login-btn action-auth">
                        <button class="btn btn-primary shadow-2 mb-4" type="submit">Login</button>
                    </div>
                    <div class="forget-pass">
                        <p class="mb-0 text-muted"><a href="{{route('password.request')}}">Click here to change your password</a></p>
                    </div>                    
                    
                </div>
            </div>
        </div>
    </div>
	</form>
    <footer class="site-footer">
        <div class="site-footer-inner has-top-divider">
            <div class="footer-copyright">© <?php echo date('Y'); ?> {{config('app.name') }} All rights reserved.</div>
            <ul class="footer-social-links list-reset">
                <li>
                    <a href="#">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z"
                                fill="#FFFFFF"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z"
                                fill="#FFFFFF"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.9 7v2.4H12c-.2 1-1.2 3-4 3-2.4 0-4.3-2-4.3-4.4 0-2.4 2-4.4 4.3-4.4 1.4 0 2.3.6 2.8 1.1l1.9-1.8C11.5 1.7 9.9 1 8 1 4.1 1 1 4.1 1 8s3.1 7 7 7c4 0 6.7-2.8 6.7-6.8 0-.5 0-.8-.1-1.2H7.9z"
                                fill="#FFFFFF"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>

    <script>

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
            navigator.serviceWorker.register('/firebase-messaging-sw.js');
            });
        }
        const firebaseConfig = {
                apiKey: "AIzaSyB4qmcvN2S_7UdbqTbKrvYlwAjNYeqm02o",
                authDomain: "bk-assistant-58ee3.firebaseapp.com",
                projectId: "bk-assistant-58ee3",
                storageBucket: "bk-assistant-58ee3.appspot.com",
                messagingSenderId: "305713688279",
                appId: "1:305713688279:web:e127af73828f04a0440a92",
                measurementId: "G-3R6KQFJRZ2"
            };

        firebase.initializeApp(firebaseConfig);
        const messaging=firebase.messaging();
        function IntitalizeFireBaseMessaging() {
            messaging
                .requestPermission()
                .then(function () {
                    // console.log("Notification Permission");
                    return messaging.getToken();
                })
                .then(function (token) {
                    // console.log("Token : "+token);
                    document.getElementById("uuid_token").value=token;
                })
                .catch(function (reason) {
                    console.log(reason);
                });
        }

        messaging.onMessage(function (payload) {
            // console.log(payload);
            const notificationOption={
                body:payload.notification.body,
                icon:payload.notification.icon
            };

            if(Notification.permission==="granted"){
                var notification=new Notification(payload.notification.title,notificationOption);

                notification.onclick=function (ev) {
                    ev.preventDefault();
                    window.open(payload.notification.click_action,'_blank');
                    notification.close();
                }
            }

        });
        messaging.onTokenRefresh(function () {
            messaging.getToken()
            .then(function (newtoken) {
                    console.log("New Token : "+ newtoken);
                    document.getElementById("uuid_token").value=newtoken;
                })
                .catch(function (reason) {
                    console.log(reason);
                    //alert(reason);
                })
        })
        IntitalizeFireBaseMessaging();


    </script>
</body>

</html>