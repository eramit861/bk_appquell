<div class="light-gray-div tax_refunds_mutisec tax_refunds_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Tax Refund/Return <span class="hide_mobile"> Details</span>
        </h2>
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('tax_refunds_mutisec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('tax_refunds_mutisec', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        @php
        $refund_whats_year = Helper::validate_key_loop_value('year', $tax_refunds, $i);
$selectedYearsArray = explode(" ", $refund_whats_year);
$typeValue = ($tax_refunds && array_key_exists('description', $tax_refunds)) ? $tax_refunds['description'][$i] : '';
$savedDescription = Helper::validate_key_value('description', $tax_refunds);
$prevValue = strtolower($typeValue);
$federalSelect = '';
$stateSelect = '';
$localSelect = '';
if (!empty($prevValue)) {
    if ($prevValue == 'federal' || $typeValue == "Federal tax refund (IRS)") {
        $federalSelect = 'selected';
    }
    if ($prevValue == 'state' || $typeValue == "State tax refund") {
        $stateSelect = 'selected';
    }
    if ($prevValue == 'local' || $typeValue == "Local government refund") {
        $localSelect = 'selected';
    }
}
@endphp

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-12 col-sm-5 col-md-5 col-lg-3 col-xxl-3">
                <label class="font-weight-bold">
                    Type:
                    <span class="font-weight-normal">{{ $typeValue }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-7 col-md-7 col-lg-4 col-xxl-6">
                <label class="font-weight-bold">
                    For what year or years:
                    <span class="font-weight-normal">{{ $refund_whats_year }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-5 col-lg-5 col-xxl-3">
                <label class="font-weight-bold">
                    Property Value:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('property_value', $tax_refunds, $i)) ? Helper::validate_key_loop_value('property_value', $tax_refunds, $i) : 0.00 }}</span>
                </label>
            </div>
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">

            <div class="col-12 col-sm-5 col-md-5 col-lg-3 col-xxl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Type </label>
                        <select class="form-control tax_refunds_description required" name="tax_refunds[data][description][{{ $i }}]"
                            onfocus="storePreviousValue(this)"
                            onchange="selectTaxRefundType(this)"
                            data-previousvalue=''>
                            <option value="Federal tax refund (IRS)" {{ $federalSelect }}>Federal tax refund (IRS)</option>
                            <option value="State tax refund" {{ $stateSelect }}>State tax refund</option>
                            <option value="Local government refund" {{ $localSelect }}>Local government refund</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7 col-md-7 col-lg-5 col-xxl-6">
                <p class="mb-2">For what year or years</p>
                <div class="label-div">
                    <div class="form-group d-flex">
                        <div class="dropdown me-2">
                            <button class="year-btn form-control dropdown-toggle mb-0" type="button" data-bs-auto-close="outside" data-bs-toggle="dropdown"><span class="dropdown-text">Select Years</span>
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu py-2">
                                <li>
                                    <label class="justone-label" for="{{ 'select_all_' . $i }}">
                                        <input type="checkbox" class="selectall" id="{{ 'select_all_' . $i }}" data-inputname="tax_refunds[data][year][{{ $i }}]" data-inputfor="refund_{{ $i }}" onchange="setSelectAll(this, '{{ $i }}')" />
                                        <span class="selectText select-text-{{$i}}"> Select</span> All
                                    </label>
                                </li>
                                <li class="divider"></li>
                                @foreach ($last5Years as $index => $year)
                                    <li class="justone-li">
                                        <label class="justone-label" for="{{ 'refund_for_' . $year . '_' . $i }}">
                                            <input type="checkbox" class="option justone refund_{{ $i }}" data-inputname="tax_refunds[data][year][{{ $i }}]" data-inputfor="refund_{{ $i }}" id="{{ 'refund_for_' . $year . '_' . $i }}" value='{{ $year }}'
                                                {{ in_array($year, $selectedYearsArray) ? 'checked' : '' }} onchange="setJustOne(this,'{{ $i }}')" />
                                            {{ $year }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="w-100">
                            <input type="text" class="form-control refund_whats_year refund_whats_year_{{$i}} required" readonly name="tax_refunds[data][year][{{ $i }}]" placeholder="Whats Year" value="{{ $refund_whats_year }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-4 col-xxl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label class="w-100">Expected or already refunded amount:</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input
                                type="number"
                                name="tax_refunds[data][property_value][{{$i}}]"
                                class="price-field form-control tax_refunds_property_value"
                                placeholder="Property value"
                                value="{{ Helper::validate_key_loop_value('property_value',$tax_refunds,$i) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('tax_refunds','tax_refunds_mutisec', 'tax_refunds_MainRow', 'parent_tax_refund', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>