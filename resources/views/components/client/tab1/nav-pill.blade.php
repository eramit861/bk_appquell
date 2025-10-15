@props([
    'active' => false,
    'route' => '#',
    'icon' => '',
    'label' => '',
    'value' => 0,
    'max' => 100,
    'liClass' => '',
    'buttonId' => '',
    'dataTarget' => '',
])

<li class="nav-item {{ $liClass }}" role="presentation">
    <button class="nav-link tab-ui-new {{ $active ? 'active' : '' }}" onclick="redirectToURL('{{ $route }}')"
        id="{{ $buttonId }}" data-bs-toggle="pill" data-bs-target="{{ $dataTarget }}" type="button" role="tab"
        aria-controls="{{ ltrim($dataTarget, '#') }}" aria-selected="{{ $active ? 'true' : 'false' }}">
        @if (!empty($icon))
            <span>{!! $icon !!}</span>
        @endif
        <span>{{ $label }}</span>
        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ (int) $value }}"
            aria-valuemin="0" aria-valuemax="{{ (int) $max }}">
            <div class="progress-bar" style="width:{{ (int) $value }}%">
                <div class="progress_text_{{ (int) $value }}">{{ (int) $value }}%</div>
            </div>
        </div>
    </button>
</li>
