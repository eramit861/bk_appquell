@if (in_array(env('APP_ENV'), ['local']))
    @php
        $extraClass = isset($extraClass) ? ' ' . $extraClass : '';
        $anchorClass = isset($anchorClass) ? ' ' . $anchorClass : '';
    @endphp
    <a href="javascript:void(0)" onclick="openQueEditModal('{{ $route }}')" class="{{ $anchorClass }}">
        <span class="{{ !$isEdited ? 'text-c-red' : 'text-c-green' }} {{ $extraClass }}"
            style="min-width: 80px !important;">
            <i class="fas fa-pencil-square-o ml-1 {{ !$isEdited ? 'text-c-red' : 'text-c-green' }} cursor-pointer">Atty
                Edit</i>
        </span>
    </a>
@endif
