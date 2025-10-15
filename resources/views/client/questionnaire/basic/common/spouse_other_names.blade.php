@php $j = !isset($j) ? 0 : $j; @endphp
<div class="light-gray-div spouse_other_name_frm spouse_other_name_frm_{{ $j }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $j + 1 }}</div> Other Name Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('spouse_other_name_frm', {{ $j }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>        
        <div class="row gx-3">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>First Name</label>
						<input type="text" class="input_capitalize form-control spouse_other_name required" name="part2[spouse_other_name][{{ $j ?? '' }}]" placeholder="First Name" value="{{ Helper::validate_key_loop_value('spouse_other_name', $BasicInfoPartB, $j ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Middle Name</label>
						<input type="text" class="input_capitalize form-control spouse_other_middle_name" name="part2[spouse_other_middle_name][{{ $j ?? '' }}]" placeholder="Middle Name" value="{{ Helper::validate_key_loop_value('spouse_other_middle_name', $BasicInfoPartB, $j ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Last Name</label>
						<input type="text" class="input_capitalize form-control spouse_other_last_name required" name="part2[spouse_other_last_name][{{ $j ?? '' }}]" placeholder="Last Name" value="{{ Helper::validate_key_loop_value('spouse_other_last_name', $BasicInfoPartB, $j ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    @php $suffixArray = ArrayHelper::getSuffixArray(); @endphp
                    <div class="form-group">
                        <label>Suffix
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-html="true"
                                data-bs-original-title="• Jr. (Junior) → Son of someone with the same full name<br>• Sr. (Senior) → The father when the son is “Jr.”<br>• II, III, IV → Second, third, fourth with the same name in the family"
                            >
                                <i class="bi bi-question-circle"></i>
                            </div>
                        </label>
						<select name="part2[spouse_other_suffix][{{ $j }}]" class="form-control spouse_other_suffix">
							<option value="">None</option>
							@foreach ($suffixArray as $jey => $val)
								<option value="{{ $jey }}" {{ Helper::validate_key_option_loop('spouse_other_suffix', $BasicInfoPartB, $j, $jey) }} >{{ $val }}</option>
							@endforeach
						</select>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>