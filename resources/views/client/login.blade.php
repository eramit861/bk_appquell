@extends('layouts.guest', ['title' => 'Client Login - BK AppQuell'])

@section('content')
<div class="min-h-screen flex">
    @if(empty($logourl))
    <!-- Left Side - Branding Section (Hidden on mobile when no custom logo) -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 to-primary-800 relative overflow-hidden">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">
            <!-- Logo/Branding -->
            <div>
                <img src="{{ asset('assets/img/logo-white.png') }}" alt="BK AppQuell Logo" class="h-12 w-auto" 
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <h1 class="text-3xl font-bold hidden">BK AppQuell</h1>
            </div>
            
            <!-- Main Image -->
            <div class="flex items-center justify-center py-12">
                <img src="{{ asset('assets/img/client-login.png') }}" 
                     alt="Client Portal" 
                     class="max-w-md w-full drop-shadow-2xl"
                     onerror="this.style.display='none'">
            </div>
            
            <!-- Footer -->
            <div class="flex items-center justify-between text-sm">
                <div class="flex space-x-4">
                    <!-- Social Icons Placeholder -->
                </div>
                <p class="text-white/80">Copyright © {{ date('Y') }} BK AppQuell</p>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Right Side - Login Form -->
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12 {{ empty($logourl) ? 'lg:w-1/2' : 'w-full' }}">
        <div class="w-full max-w-md space-y-8">
            <!-- Attorney Logo (if custom slug) -->
            @if(!empty($logourl))
            <div class="text-center space-y-4">
                <img src="{{ $logourl }}" alt="Law Firm Logo" class="mx-auto h-20 w-auto object-contain">
                <img src="{{ asset('assets/img/bkq_logo.png') }}" alt="BKQ Logo" class="mx-auto h-8 w-auto object-contain">
            </div>
            @endif
            
            <!-- Login Header -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Client Login</h1>
                <p class="mt-2 text-sm text-gray-600">Access your bankruptcy case portal</p>
            </div>
            
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="rounded-lg bg-success-50 border border-success-200 p-4 animate-fade-in">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-success-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-success-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            @if(session('error'))
            <div class="rounded-lg bg-danger-50 border border-danger-200 p-4 animate-fade-in">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-danger-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-danger-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Login Form -->
            <form id="client_login_form" method="POST" action="{{ route('client_login') }}" class="mt-8 space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            autofocus
                            value="{{ old('email') }}"
                            class="block w-full pl-10 pr-3 py-3 border @error('email') border-danger-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                            placeholder="Enter your email"
                        >
                    </div>
                    @error('email')
                    <p class="mt-2 text-sm text-danger-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                </div>
                
                <!-- Hidden Token Field -->
                <input id="uuid_token" type="hidden" name="uuid_token" value="">
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required
                            class="block w-full pl-10 pr-12 py-3 border @error('password') border-danger-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                            placeholder="Enter your password"
                        >
                        <button 
                            type="button" 
                            id="togglePassword" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-2 text-sm text-danger-600">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </button>
                </div>
                
                <!-- Forgot Password Link -->
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                        <i class="fas fa-key mr-1"></i>
                        Click here to change your password
                    </a>
                </div>
                
                <!-- Support Information -->
                <div class="bg-info-50 border border-info-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-info-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-info-800">
                                For login issues or technical support, please call: 
                                <a href="tel:1-888-356-5777" class="font-semibold hover:underline">1-888-356-5777</a>
                                or text 
                                <a href="tel:(949) 994-4190" class="font-semibold hover:underline">(949) 994-4190</a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
            
            <!-- Mobile Branding Footer (shown only on mobile when no custom logo) -->
            @if(empty($logourl))
            <div class="lg:hidden text-center text-sm text-gray-500 pt-6 border-t">
                <p>Copyright © {{ date('Y') }} BK AppQuell</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Password Toggle Functionality
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            if (type === 'text') {
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    }
    
    // Login Data for Firebase or other integrations
    window.__loginData = {
        logourl: '{{ $logourl ?? '' }}'
    };
    
    // Form validation enhancement (optional)
    const loginForm = document.getElementById('client_login_form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }
</script>
@endpush
@endsection
