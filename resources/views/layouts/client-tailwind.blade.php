<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Client Portal - BK AppQuell' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:400,500,600,700" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Bootstrap (temporary for old forms) -->
    <link rel="stylesheet" href="{{ asset('assets/css/new/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vite Assets (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/client/client_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new/dashboard.css') }}">
    
    @stack('styles')
    @stack('tab_styles')
    @yield('dashboard_styles')
</head>
<body class="bg-gray-50 antialiased" x-data="{ sidebarOpen: false }">
    @php
        $authUser = auth()->user();
        $progress_percentage = $progress['all_percentage'] ?? 0;
    @endphp
    
    <div class="min-h-screen">
        <!-- Mobile Top Header Bar -->
        <div class="fixed top-0 left-0 right-0 z-40 lg:hidden bg-primary-600 shadow-lg">
            <div class="flex items-center justify-between px-4 py-3">
                <button type="button" 
                        data-bs-toggle="offcanvas" 
                        data-bs-target="#offcanvasExample" 
                        aria-controls="offcanvasExample"
                        class="text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <span class="sr-only">Open sidebar</span>
                </button>
                <div class="flex-1 flex justify-center">
                    <img src="{{ asset('assets/img/new/sidebar/logo-light-bg.png') }}" alt="Logo" class="h-8">
                </div>
                <div class="w-6"></div> <!-- Spacer for centering -->
            </div>
        </div>
        
        <!-- Sidebar -->
        @include('layouts.client.new.sidebar')
        
        <!-- Main Content -->
        <div class="content-page">
            <main class="p-4 lg:p-8">
                @include('layouts.flash-tailwind')
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- jQuery (for old forms) -->
    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js') }}"></script>
    
    <!-- jQuery UI (for interactions) -->
    <script src="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.js') }}"></script>
    
    <!-- Bootstrap JS (for old forms) -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Form validation and utilities -->
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/facebox.js') }}"></script>
    <script src="{{ asset('assets/js/autocomplete.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.tablednd.js') }}"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    
    <!-- Alpine.js (for Tailwind interactivity) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('scripts')
    @stack('tab_scripts')
    @yield('dashboard_scripts')
</body>
</html>

