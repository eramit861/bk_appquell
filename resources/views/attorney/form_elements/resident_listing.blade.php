@php
    $property = [
        1 => 'Single family home',
        2 => 'Duplex or multi-unit building',
        3 => 'Condominium or cooperative',
        4 => 'Manufactured or mobile home',
        5 => 'Land',
        6 => 'Investment property',
        7 => 'Timeshare',
        8 => 'Other'
    ];
    $ownRent = Helper::validate_key_value('currently_lived', $resident, 'radio');
    $isPrimaryProperty = Helper::validate_key_value('not_primary_address', $resident, 'radio');
    $primary_text = (($ownRent == 1 && $isPrimaryProperty == 0) || ($ownRent == 0)) ? 'Primary Residence' : 'Non-Primary Residence';
@endphp

<div class="outline-gray-border-area mt-4">
    <div class="light-gray-div {{ ($i == 1) ? 'mt-2' : '' }}">
        <div class="light-gray-box-form-area">
            <h2>
                <div class="circle-number-div ">{{ $i + 1 }}</div> {{ $primary_text }}
            </h2>
            <!-- summary -->
            <div class="row gx-3 residence_form_summary mb-3 {{ (!isset($resident['id']) || empty($resident['id'])) ? 'hide-data' : '' }} residence_form_summary_{{ $i }}">
                @if (!empty($resident))
                    @include('attorney.form_elements.property-primary', ['hide_docs' => @$hide_docs, 'primary_text' => $primary_text, 'i' => $i+1])
                @endif
            </div>
        </div>
    </div>
</div>