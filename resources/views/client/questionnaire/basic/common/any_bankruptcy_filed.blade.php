<div class="light-gray-div any_bankruptcy_filed_before_data any_bankruptcy_filed_before_data_{{ $j }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $j + 1 }}</div> Previous
            Cases Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('any_bankruptcy_filed_before_data', {{ $j }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Cases Name</label>
                        <input placeholder="Case Name" type="text" class="input_capitalize form-control case_name required" name="part3[any_bankruptcy_filed_before_data][case_name][{{ $j }}]" placeholder="" value="{{ Helper::validate_key_loop_value('case_name', $BasicInfo_PartD, $j) }}" aria-invalid="true">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Date Filed</label>
                        <input placeholder="MM/DD/YYYY" type="text" class="form-control any_case_date_filed max-today-date" name="part3[any_bankruptcy_filed_before_data][data_field][{{ $j }}]" value="{{ Helper::validate_key_loop_value('data_field', $BasicInfo_PartD, $j) }}" aria-invalid="true">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Cases Number</label>
                        <input placeholder="Case Number" type="text" class="form-control case_numbers" name="part3[any_bankruptcy_filed_before_data][case_numbers][{{ $j }}]" value="{{ Helper::validate_key_loop_value('case_numbers', $BasicInfo_PartD, $j) }}" aria-invalid="true">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Date Discharged</label>
                        <input placeholder="MM/DD/YYYY" type="text" class="form-control max-today-date date_discharged" name="part3[any_bankruptcy_filed_before_data][date_discharged][{{ $j }}]" value="{{ Helper::validate_key_loop_value('date_discharged', $BasicInfo_PartD, $j) }}" aria-invalid="true">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    @php $groups = []; @endphp
                    <div class="form-group">
                        <label>District if (known)</label>
                        <select class="form-control district_if_known required" name="part3[any_bankruptcy_filed_before_data][district_if_known][{{ $j }}]">
                            @foreach ($district_names as $district_name)
                                @if (!in_array($district_name->short_name, $groups))
                            <optgroup label="{{ $district_name->short_name }}"></optgroup>
                                    @php array_push($groups, $district_name->short_name); @endphp
                                @endif
                            <option {{ Helper::validate_key_loop_value('district_if_known', $BasicInfo_PartD, $j) == $district_name->district_name ? 'selected' : '' }} value="{{ $district_name->district_name }}" data-name="{{ $district_name->short_name }}" data-id="{{ $district_name->id }}" class="form-control">
                                {{ str_replace('Of', 'of', $district_name->district_name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>