@if(session('success'))
<div class="mb-6 rounded-lg bg-success-50 border border-success-200 p-4 animate-fade-in">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-success-500 text-xl"></i>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-success-800">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.parentElement.remove()" class="ml-auto flex-shrink-0 text-success-500 hover:text-success-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('error'))
<div class="mb-6 rounded-lg bg-danger-50 border border-danger-200 p-4 animate-fade-in">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-danger-500 text-xl"></i>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-danger-800">{{ session('error') }}</p>
        </div>
        <button onclick="this.parentElement.parentElement.remove()" class="ml-auto flex-shrink-0 text-danger-500 hover:text-danger-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('warning'))
<div class="mb-6 rounded-lg bg-warning-50 border border-warning-200 p-4 animate-fade-in">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-warning-500 text-xl"></i>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-warning-800">{{ session('warning') }}</p>
        </div>
        <button onclick="this.parentElement.parentElement.remove()" class="ml-auto flex-shrink-0 text-warning-500 hover:text-warning-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('info'))
<div class="mb-6 rounded-lg bg-info-50 border border-info-200 p-4 animate-fade-in">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-info-500 text-xl"></i>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-info-800">{{ session('info') }}</p>
        </div>
        <button onclick="this.parentElement.parentElement.remove()" class="ml-auto flex-shrink-0 text-info-500 hover:text-info-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

