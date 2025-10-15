<div class="light-gray-div bankruptcy_clone bankruptcy_clone_{{ $j }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $j + 1 }}</div> Bankruptcy Case Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('bankruptcy_clone', {{ $j }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-lg-6 col-12">
                @php $groups = []; @endphp
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label>In which district of which state was the case filed?</label>
                        <select class="form-control case_filed_state required" name="part3[case_filed_state][{{ $j }}]">
                            @foreach ($district_names as $district_name)
                                @if (!in_array($district_name->short_name, $groups))
                            <optgroup label="{{ $district_name->short_name }}"></optgroup>
                                    @php array_push($groups, $district_name->short_name); @endphp
                                @endif
                            <option {{ Helper::validate_key_loop_value('case_filed_state', $BasicInfo_PartC, $j) == $district_name->district_name ? 'selected' : '' }} value="{{ $district_name->district_name }}" data-name="{{ $district_name->short_name }}" data-id="{{ $district_name->id }}" class="form-control">
                                {{ str_replace('Of', 'of', $district_name->district_name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label>Case Number</label>
                        <input type="text" class="form-control required case_number " name="part3[case_number][{{ $j }}]" placeholder="Case Number" value="{{ Helper::validate_key_loop_value('case_number', $BasicInfo_PartC, $j) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label>Date Filed</label>
                        <input type="text" class="form-control case_date_filed max-today-date" name="part3[date_filed][{{ $j }}]" placeholder="MM/DD/YYYY" value="{{ Helper::validate_key_loop_value('date_filed', $BasicInfo_PartC, $j) }}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="label-div question-area border-0">
                    <label> Was the case dismissed in the last year?</label>
                    <div class="custom-radio-group form-group mb-0">
                        <input type="radio" class="is_case_dismissed_option d-none" id="is_case_dismissed_no_{{ $j }}" name="part3[is_case_dismissed][{{ $j }}]" {{ Helper::validate_key_loop_toggle('is_case_dismissed', $BasicInfo_PartC, 0, $j) }} value="0">
                        <label for="is_case_dismissed_no_{{ $j }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('is_case_dismissed', $BasicInfo_PartC, 0, $j) }}">No</label>

                        <input type="radio" class="is_case_dismissed_option d-none" id="is_case_dismissed_yes_{{ $j }}" name="part3[is_case_dismissed][{{ $j }}]" {{ Helper::validate_key_loop_toggle('is_case_dismissed', $BasicInfo_PartC, 1, $j) }} value="1">
                        <label for="is_case_dismissed_yes_{{ $j }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('is_case_dismissed', $BasicInfo_PartC, 1, $j) }}">Yes</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>