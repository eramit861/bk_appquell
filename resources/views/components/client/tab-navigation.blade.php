@props([
    'tabData' => [],
    'debtorTabName' => 'Debtor',
    'codebtorTabName' => 'Co-Debtor',
    'authUser' => null,
])

<ul class="nav nav-pills nav-fill w-100 p-0 with-progress" id="pills-tab" role="tablist">
    @foreach($tabData as $stepKey => $stepData)
        @php
            // Skip step if condition is not met
            if (isset($stepData['condition']) && !$stepData['condition']) {
                continue;
            }
            
            $percentDone = $stepData['percentDone'] ?? 0;
            $percentTotal = $stepData['percentTotal'] ?? 100;
            $tabClass = $stepData['tabClass'] ?? '';
            $routeName = $stepData['routeName'] ?? '';
            $icon = $stepData['icon'] ?? '';
            $label = $stepData['label'] ?? '';
            $tabId = $stepData['tabId'] ?? '';
            $targetId = $stepData['targetId'] ?? '';
            
            // Tab visibility logic
            $isActive = request()->routeIs($routeName);
            $visibilityClass = $isActive ? 'mobile-mr-0' : 'hide-tab';
        @endphp
        
        <li class="nav-item {{ $visibilityClass }} {{ $tabClass }}" role="presentation">
            <button class="nav-link tab-ui-new {{ $isActive ? 'active' : '' }}"
                onclick="redirectToURL('{{ route($routeName) }}')"
                id="{{ $tabId }}"
                data-bs-toggle="pill"
                data-bs-target="#{{ $targetId }}"
                type="button" role="tab" 
                aria-controls="{{ $targetId }}" 
                aria-selected="{{ $isActive ? 'true' : 'false' }}">
                
                @if($icon)
                    <span>{!! $icon !!}</span>
                @endif
                
                <span>{{ $label }}</span>
                
                <div class="progress" role="progressbar" 
                     aria-label="Basic example" 
                     aria-valuenow="{{ $percentDone }}" 
                     aria-valuemin="0" 
                     aria-valuemax="{{ $percentTotal }}">
                    <div class="progress-bar" style="width:{{ $percentDone }}%">
                        <div class="progress_text_{{ $percentDone }}">{{ $percentDone }}%</div>
                    </div>
                </div>
            </button>
        </li>
    @endforeach
</ul>
