<?php if (@$logourl == '') { ?>
<div class="auth-header">
        <header class="site-header">
            <div class="container">
                <nav class="navbar">
                    <div class="brand header-brand">
                       
                         <a href="{{url('/')}}">
                            <img src="{{ url('assets/images/logo.png')}}" alt="logo">
                        </a>
                       
                    </div>
                    <div class="navbar-content">
                        <ul class="pcoded-inner-navbar">
						@if (Auth::check())
							<li class="nav-item">
                                <a href="{{route('logout')}}" class="nav-link "><span
                                        class="pcoded-mtext">Logout</span></a>
                            </li>
						@else
							<?php if (!empty($client) && $client == true) {?>
							<?php } else {?>

                            <li class="nav-item hide-mobile">
                                <a href="{{route('login')}}" class="nav-link "><span
                                        class="pcoded-mtext">Law Firm Login</span></a>
                            </li>
                            <li class="nav-item  hide-mobile">
                                <a href="{{route('register',['package_id' => 'standard'])}}" class="nav-link "><span
                                        class="pcoded-mtext">SignUp</span></a>
                            </li>

							<?php }?>
						@endif
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
    </div>
    <?php } ?>
    <script>
function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

      // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }

    if (/android/i.test(userAgent)) {
        return "Android";
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }

    return "unknown";
}
    </script>
