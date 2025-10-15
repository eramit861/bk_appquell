<div class="light-gray-div other_name_frm other_name_frm_{{ $k }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $k + 1 }}</div> Other Name
            Details
        </h2>
        <button type="button" class="delete-div" title="Delete"
            onclick="remove_div_common('other_name_frm', {{ $k }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="input_capitalize form-control any_other_fname required"
                            name="part1[any_other_name][name][{{ $k }}]" placeholder="First Name"
                            value="{{ Helper::validate_key_loop_value('name', $BasicInfo_AnyOtherName, $k) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="input_capitalize form-control any_other_mname"
                            name="part1[any_other_name][middle_name][{{ $k }}]" placeholder="Middle Name"
                            value="{{ Helper::validate_key_loop_value('middle_name', $BasicInfo_AnyOtherName, $k) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="input_capitalize form-control any_other_lname required"
                            name="part1[any_other_name][last_name][{{ $k }}]" placeholder="Last Name"
                            value="{{ Helper::validate_key_loop_value('last_name', $BasicInfo_AnyOtherName, $k) }}">
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
                        <select name="part1[any_other_name][suffix][{{ $k }}]"
                            class="form-control any_other_suffix">
                            <option value="">None</option>
                            @foreach ($suffixArray as $key => $val)
                                <option value="{{ $key }}"
                                    {{ Helper::validate_key_option_loop('suffix', $BasicInfo_AnyOtherName, $k, $key) }}>
                                    {{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
