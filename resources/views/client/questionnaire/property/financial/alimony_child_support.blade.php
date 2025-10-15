@php
$clientType = $client->client_type;
$data_for = Helper::validate_key_loop_value('data_for', $alimony_child_support, $i);
@endphp
<div class="light-gray-div alimony_child_support_mutisec alimony_child_support_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}" rowNo="{{ $i }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Family Support Details
        </h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('alimony_child_support_mutisec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('alimony_child_support_mutisec', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-md-2">
                <label class="font-weight-bold">
                    Type:
                    <span class="font-weight-normal">{{ !empty(Helper::validate_key_loop_value('account_type', $alimony_child_support, $i)) ? ArrayHelper::getFinancialProp(Helper::validate_key_loop_value('account_type', $alimony_child_support, $i)) : '' }}</span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="font-weight-bold">
                    Belongs to:
                    <span class="font-weight-normal">
                        @if ($clientType == 1)
                            {{ ($data_for == 'debtor') ? 'Debtor' : '' }}
                        @endif
                        @if ($clientType == 2)
                            {{ ($data_for == 'debtor') ? 'Debtor' : '' }}
                            {{ ($data_for == 'codebtor') ? 'Non-Filing Spouse' : '' }}
                        @endif
                        @if ($clientType == 3)
                            {{ ($data_for == 'debtor') ? 'Debtor' : '' }}
                            {{ ($data_for == 'codebtor') ? 'Co-Debtor' : '' }}
                        @endif
                    </span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('state', $alimony_child_support, $i) }}</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="font-weight-bold">
                    Amount of Ordered Support:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('description', $alimony_child_support, $i)) ? Helper::validate_key_loop_value('description', $alimony_child_support, $i) : 0.00 }}</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="font-weight-bold">
                    Property Value:
                    <span class="font-weight-normal">{{ (Helper::validate_key_loop_value('property_value_unknown', $alimony_child_support, $i) == 1) ? 'Unknown' : '$ ' . (!empty(Helper::validate_key_loop_value('property_value', $alimony_child_support, $i)) ? Helper::validate_key_loop_value('property_value', $alimony_child_support, $i) : 0.00) }}</span>
                </label>
            </div>
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
            <div class="col-xl-2 col-md-4">
                <div class="label-div">
                    <div class="form-group">
                        <label> Type of Support:</label>
                        <select onchange="checkUnique(this)" class="form-control alimony_property_account required" required name="alimony_child_support[data][account_type][{{ $i }}]"
                            onfocus="storePreviousAlimonyValue(this)"
                            onchange="selectVPCAAlimonyccount(this)"
                            data-previousvalue=''
                            data-index='{{ $i }}'>
                            {!! ArrayHelper::getFinancialPropTypeSelection(Helper::validate_key_loop_value('account_type', $alimony_child_support, $i)) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Belongs to:</label>
                        <select class="form-control alimony_child_support_data_for required" required name="alimony_child_support[data][data_for][{{ $i }}]">
                            <!-- Single Not Married -->
                            @if ($clientType == 1)
                                <option value="debtor" {{ ($data_for == 'debtor') ? 'selected' : '' }} selected>Debtor</option>
                            @endif
                            <!-- Married Not Filing Jointly -->
                            @if ($clientType == 2)
                                <option disabled>Select Debtor Type</option>
                                <option value="debtor" {{ ($data_for == 'debtor') ? 'selected' : '' }}>Debtor</option>
                                <option value="codebtor" {{ ($data_for == 'codebtor') ? 'selected' : '' }}>Non-Filing Spouse</option>
                            @endif
                            <!-- Married Filing Joint -->
                            @if ($clientType == 3)
                                <option disabled>Select Debtor Type</option>
                                <option value="debtor" {{ ($data_for == 'debtor') ? 'selected' : '' }}>Debtor</option>
                                <option value="codebtor" {{ ($data_for == 'codebtor') ? 'selected' : '' }}>Co-Debtor</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-5">
                <div class="label-div">
                    <label>Which State is the Court Order:</label>

                    <select class="form-control alimony_property_state required" required name="alimony_child_support[data][state][{{ $i }}]">
                        <option value="">Please Select State</option>
                        {!! AddressHelper::getStatesList(Helper::validate_key_loop_value('state', $alimony_child_support, $i)) !!}
                    </select>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="label-div">
                    <div class="form-group">
                        <label>Amount of Ordered Support:</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" placeholder="Amount of Ordered Support" name="alimony_child_support[data][description][{{ $i }}]" class="form-control price-field alimony_description" value="{{ Helper::validate_key_loop_value('description', $alimony_child_support, $i) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-8">
                <div class="label-div">
                    <div class="form-group">
                        <div class="form-check mb-1 px-0">
                            <label class="mb-0 form-check-label ">
                                <span class="me-4">Arrears/Past Due Amount of Support</span>
                                <input type="checkbox" onchange="checkUnknown(this, {{ $i }},'child')" value="1" class="unknown form-check-input top-auto" name="alimony_child_support[data][property_value_unknown][{{ $i }}]" {{ (Helper::validate_key_loop_value('property_value_unknown', $alimony_child_support, $i) == 1) ? 'checked=checked' : '' }}>
                                <span class="">Unknown</span>
                            </label>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="alimony_child_support[data][property_value][{{ $i }}]" class=" {{ (Helper::validate_key_loop_value('property_value_unknown', $alimony_child_support, $i) == 1) ? '' : 'required' }} price-field form-control alimony_property_value is_child_unknown_{{ $i }}" placeholder="Property value"
                                value="{{ Helper::validate_key_loop_value('property_value', $alimony_child_support, $i) }}"
                                {{ (Helper::validate_key_loop_value('property_value_unknown', $alimony_child_support, $i) == 1) ? 'disabled=true' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('alimony_child_support','alimony_child_support_mutisec', 'alimony_child_data', 'parent_alimony_child_support', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>