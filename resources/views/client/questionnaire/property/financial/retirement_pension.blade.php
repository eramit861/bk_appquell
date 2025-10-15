@php $selected = isset($retirement_pension['type_of_account']) && isset($retirement_pension['type_of_account'][$i]) ? $retirement_pension['type_of_account'][$i] : ''; @endphp

<div class="light-gray-div retirement_pension_mutisec retirement_pension_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Retirement Account <span class="hide_mobile"> Details </span>
            <i class="bi bi-patch-question-fill ms-2" onclick="openPopup('retirement-pension')"></i>
        </h2>
		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('retirement_pension_mutisec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('retirement_pension_mutisec', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xxl-4">
                <label class="font-weight-bold">
                    Type of Account:
                    <span class="font-weight-normal">{{ ArrayHelper::accountTypeArray($selected) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xxl-4">
                <label class="font-weight-bold">
                    Institution Name:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $retirement_pension, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xxl-4">
                <label class="font-weight-bold">
                    Current balance of account:
                    <span class="font-weight-normal">{{ (Helper::validate_key_loop_value('unknown', $retirement_pension, $i) == 1) ? 'Unknown' : '$ '. (!empty(Helper::validate_key_loop_value('property_value', $retirement_pension, $i)) ? Helper::validate_key_loop_value('property_value', $retirement_pension, $i) : 0.00) }}</span>
                </label>
            </div>
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
            <div class="col-12 col-sm-6  col-lg-3 col-xxl-4">
                <div class="label-div">
                    <div class="form-group">
                        <label for="">Type of Account</label>
                        <select class="form-control retirement_pension_type_of_account" name="retirement_pension[data][type_of_account][{{ $i }}]" required>
                            <option selected disabled hidden>Type of account</option>
                            @php
                            echo ArrayHelper::accountTypeSelection($selected);
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6  col-lg-3 col-xxl-4">
                <div class="label-div">
                    <div class="form-group">
                        <label for="">Institution Name</label>
                        <input name="retirement_pension[data][description][{{ $i }}]" class="form-control input_capitalize required retirement_pension_description" placeholder="Institution name"
                            value="{{ Helper::validate_key_loop_value('description',$retirement_pension,$i) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xxl-4">
                <div class="label-div">
                    <div class="form-group">
                        <label>Current balance of account:
                            <input style="margin-top: 5px;margin-right: 5px;"
                                type="checkbox"
                                onchange="checkUnknownRetirement(this, {{ $i }})"
                                value="1"
                                class="ml-1 retirement_pension_unknown"
                                name="retirement_pension[data][unknown][{{ $i }}]"
                                {{ (Helper::validate_key_loop_value('unknown', $retirement_pension, $i) == 1) ? 'checked=checked' : '' }}>
                            Unknown
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="retirement_pension[data][property_value][{{ $i }}]" class="price-field form-control {{ (Helper::validate_key_loop_value('unknown', $retirement_pension, $i) == 1) ? '' : 'required' }} retirement_pension_property_value retirement_pension_property_value_is_unknown_{{ $i }}" placeholder="Value" value="{{ Helper::validate_key_loop_value('property_value',$retirement_pension,$i) }}"
                                {{ (Helper::validate_key_loop_value('unknown', $retirement_pension, $i) == 1) ? 'disabled=true' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('retirement_pension','retirement_pension_mutisec', 'retirement_pension_data', 'parent_retirement_pension', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>