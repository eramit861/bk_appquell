<nav class="bg-c-blue pcoded-navbar bg-gradient sidenavbar position-relative w-auto sidenavar-1">
	<?php if (Auth::user()->id != 1) { ?>
	<ul class="nav sidebar-list p-0" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link" id="sidebar-logo-tab" data-bs-toggle="tab" href="{{route('attorney_dashboard')}}" role="tab" aria-controls="sidebar-logo" aria-selected="true">
				<img src="{{ asset('assets/img/bk_sidebar_logo.png')}}" alt="sidebar-logo" />
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ request()->routeIs('attorney_dashboard') ? 'active' : ''}}" id="Dashboard-tab" data-bs-toggle="tab" href="{{ route('attorney_dashboard')}}" role="tab" aria-controls="Dashboard" aria-selected="false">
			<div class="">
			<img src="{{ asset('assets/img/smart-home-1.png')}}" alt="Dashboard" />
				<div class="mt-1"><span class="small-txt">Dashboard</span></div>
			</div>
			</a>
		</li>
		<li class="nav-item">
			<?php $cmRoute = !empty(Auth::user()->parent_attorney_id) ? route('attorney_client_management', 'assigned_to_me') : route('attorney_client_management', 'active'); ?>
			<a class="nav-link {{ (request()->routeIs('attorney_client_management') ||request()->routeIs('attorney_client_uploaded_documents')) ? 'active' : ''}}" id="profile-tab" data-bs-toggle="tab" href="{{ $cmRoute }}" role="tab" aria-controls="profile" aria-selected="false">
				<img src="{{ asset('assets/img/briefcase.png')}}" alt="briefcase" />
				<div class="mt-1"><span>Client Management</span></div>
			</a>
		</li>

        @if(empty(Auth::user()->parent_attorney_id))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('questionnaire_index') ? 'active' : ''}}" id="listcheck-tab" data-bs-toggle="tab" href="{{ route('questionnaire_index',['active'=> 0])}}" role="tab" aria-controls="contact" aria-selected="false">
                    <img src="{{ asset('assets/img/listcheck.png')}}" alt="listcheck" />
                    <div class="mt-1"><span>Client Intake Form (Imports to Client Questionnaire)</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attorney_profile') ? 'active' : ''}}" id="profile-tab" data-bs-toggle="tab" href="{{ route('attorney_profile')}}" role="tab" aria-controls="contact" aria-selected="false">
                <img src="{{ asset('assets/img/lawyer.svg')}}" alt="Manage Profile" />
                <div class="mt-1"><span>Manage Profile</span></div>
                </a>
            </li>
			<li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attorney_settings') ? 'active' : ''}}" id="settings-tab" data-bs-toggle="tab" href="{{ route('attorney_settings')}}" role="tab" aria-controls="contact" aria-selected="false">
                <img src="{{ asset('assets/img/settings.png')}}" alt="Manage Settings" />
                <div class="mt-1"><span>Manage Settings</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attorney_paralegal_management') ? 'active' : ''}}" id="profile-tab" data-bs-toggle="tab" href="{{ route('attorney_paralegal_management','active')}}" role="tab" aria-controls="profile" aria-selected="false">
                    <img src="{{ asset('assets/img/lawyer.svg')}}" alt="briefcase" />
                    <div class="mt-1"><span>Paralegals Management</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attorney_transactions_consumed') || request()->routeIs('attorney_transactions_consumed') ? 'active' : ''}}" id="coin-tab" data-bs-toggle="tab" href="{{ route('attorney_transactions_consumed')}}" role="tab" aria-controls="contact" aria-selected="false">
                <img src="{{ asset('assets/img/coin.png')}}" alt="coin" />
                <div class="mt-1"><span>Transactions</span></div>
                </a>
            </li>
        @endif
		<li class="nav-item">
			<a class="nav-link {{ request()->routeIs('attorney_template_management') ? 'active' : ''}}" id="contact-tab" data-bs-toggle="tab" href="{{ route('attorney_template_management')}}" role="tab" aria-controls="contact" aria-selected="false">
			<img src="{{ asset('assets/img/template_icon.png')}}" alt="files" />
			<div class="mt-1"><span>Customize Property Sectiont</span></div>
			</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link {{ request()->routeIs('notification_template_list') ? 'active' : ''}}" id="contact-tab" data-bs-toggle="tab" href="{{ route('notification_template_list', ['id'=>Auth::user()->id])}}" role="tab" aria-controls="contact" aria-selected="false">
			<img src="{{ asset('assets/img/template_icon.png')}}" alt="files" />
			<div class="mt-1"><span>Notification Template</span></div>
			</a>
		</li>
	</ul>
	<?php } ?>
	<?php if (Auth::user()->role == 1) { ?>
		@include("layouts.admin.sidebar")
	<?php } ?>
</nav>

<style>
	.pcoded-navbar .header-logo{padding-left: 10px;}
	.pcoded-navbar .header-logo img {width: 86%;}
</style>

<script>
	$(document).ready(function () {
		$(".nav-link").click(function () {
			$(".nav-link").removeClass("active");
			// $(".tab").addClass("active"); // instead of this do the below
			$(this).addClass("active");
		});
	});
</script>
