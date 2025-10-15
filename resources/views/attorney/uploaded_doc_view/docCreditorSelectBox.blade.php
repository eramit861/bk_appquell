@php
$debt_tax = Helper::validate_key_value('debt_tax', $final_debts);
$back_tax_own = Helper::validate_key_value('back_tax_own', $final_debts);
$domestic_tax = Helper::validate_key_value('domestic_tax', $final_debts);
$additional_liens_data = Helper::validate_key_value('additional_liens_data', $final_debts);
$creditor_value = $doc['creditor_value'] ?? '';
$select_show = '';
$related_to_show = 'd-none';
$creditorType = '';
$creditorName = '';

if (!empty($creditor_value)) {
    $creditorType = substr($creditor_value, 0, -2);
    $creditorTypeIndex = substr($creditor_value, -1) - 1;
    $creditorName = '';
    $select_show = 'd-none';
    $related_to_show = '';
    switch ($creditorType) {
        case 'Debt':
            $debt_d = Helper::validate_key_value($creditorTypeIndex, $debt_tax);
            $creditorName = Helper::validate_key_value('creditor_name', $debt_d);
            break;
        case 'Back_Taxes':
            $Back_Taxes_d = Helper::validate_key_value($creditorTypeIndex, $back_tax_own);
            $Back_Taxes_item = AddressHelper::getStateTaxAddress(Helper::validate_key_value('debt_state', $Back_Taxes_d));
            $creditorName = Helper::validate_key_value('address_heading', $Back_Taxes_item);
            break;
        case 'IRS':
            $creditorName = 'Internal Revenue Service';
            break;
        case 'DSO':
            $dso_d = Helper::validate_key_value($creditorTypeIndex, $domestic_tax);
            $creditorName = Helper::validate_key_value('domestic_support_name', $dso_d);
            break;
        case 'Additonal_liens':
            $additional_liens_d = Helper::validate_key_value($creditorTypeIndex, $additional_liens_data);
            $creditorName = Helper::validate_key_value('domestic_support_name', $additional_liens_d);
            break;
        default:
            $creditorName = '';
            break;
    }
    $creditorType = str_replace('_', ' ', $creditor_value);
}
@endphp

<div class="label-div mb-0 creditor-select" style="min-width: 174px;">

    <small class="text-bold creditor-selected d-flex-ai-center related_section_{{$docId}} lh-10px {{ $related_to_show }}">
        <span class="text-center w-100">Related to {{ $creditorType }}: {{ $creditorName }}</span>
        <i onclick="edit_creditors_to_doc('{{$docId}}')" class="fas fa-pencil-square-o ms-1 edit related_section_{{$docId}} "></i>
    </small>

    <select class="form-control height-unset select-custom-padding document_creditor_{{ $docId }} {{ $select_show }}" onchange="update_creditors_to_doc('{{$docId}}','{{$creditor_value}}','{{$client_id}}')" id="creditor" name="document_creditor">
        <option disabled selected>Choose Creditor</option>
        <!-- debt taxes -->
        @if (!empty($debt_tax))
            <optgroup label="Unsecured Debts"></optgroup>
            @php $i = 1; @endphp
            @foreach ($debt_tax as $debt_data)
                <option value="Debt_{{ $i }}" {{ $creditor_value == 'Debt_' . $i ? 'selected' : '' }}>{{ $i }}. {{ Helper::validate_key_value('creditor_name', $debt_data) }}</option>
                @php $i++; @endphp
            @endforeach
        @endif
        <!-- back taxes -->
        @if (!empty($back_tax_own))
            <optgroup label="State Back Taxes"></optgroup>
            @php $i = 1; @endphp
            @foreach ($back_tax_own as $bt_data)
                @php $item = AddressHelper::getStateTaxAddress(Helper::validate_key_value('debt_state', $bt_data)); @endphp
                <option value="Back_Taxes_{{ $i }}" {{ $creditor_value == 'Back_Taxes_' . $i ? 'selected' : '' }}>{{ Helper::validate_key_value('address_heading', $item) }}</option>
                @php $i++; @endphp
            @endforeach
        @endif
        <!-- irs -->
        <optgroup label="IRS"></optgroup>
        <option value="IRS_1" {{ $creditor_value == 'IRS_1' ? 'selected' : '' }}>Internal Revenue Service</option>
        <!-- domestic support -->
        @if (!empty($domestic_tax))
            <optgroup label="Domestic Support Debts"></optgroup>
            @php $i = 1; @endphp
            @foreach ($domestic_tax as $dt_data)
                <option value="DSO_{{ $i }}" {{ $creditor_value == 'DSO_' . $i ? 'selected' : '' }}>{{ Helper::validate_key_value('domestic_support_name', $dt_data) }}</option>
                @php $i++; @endphp
            @endforeach
        @endif
        <!-- additional liens -->
        @if (!empty($additional_liens_data))
            <optgroup label="Additional Liens"></optgroup>
            @php $i = 1; @endphp
            @foreach ($additional_liens_data as $al_data)
                <option value="Additonal_liens_{{ $i }}" {{ $creditor_value == 'Additonal_liens_' . $i ? 'selected' : '' }}>{{ Helper::validate_key_value('domestic_support_name', $al_data) }}</option>
                @php $i++; @endphp
            @endforeach
        @endif
    </select>
</div>