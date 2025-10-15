@extends('layouts.guest', ['title' => 'Payroll Assistant - BK AppQuell'])

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="max-w-2xl w-full text-center">
        <div class="bg-white rounded-2xl shadow-xl p-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-6">
                <i class="fas fa-money-check-alt text-primary-600 text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Payroll Assistant</h1>
            <p class="text-gray-600 mb-8">Welcome to the Payroll Assistant portal. This feature will be available soon.</p>
            
            <a href="{{ route('client_dashboard') }}" class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-colors">
                Go to Dashboard
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection

