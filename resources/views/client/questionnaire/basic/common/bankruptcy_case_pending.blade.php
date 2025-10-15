<div class="light-gray-div addOther_bankruptcypending_clone addOther_bankruptcypending_clone_{{ $i }}">
    @php $i = !isset($i) ? 0 : $i; @endphp
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Bankruptcy Case Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('addOther_bankruptcypending_clone', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>   
        <div class="row gx-3">
            <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of Debtor</label>
                        <input type="text" class="input_capitalize form-control debtor_name required" name="part3[any_bankruptcy_cases_pending_data][debator_name][{{ $i }}]" placeholder="Name of Debtor" value="{{ Helper::validate_key_loop_value('debator_name', $BasicInfo_PartD, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Relationship to you</label>
                        <input type="text" class="input_capitalize form-control relanship required" name="part3[any_bankruptcy_cases_pending_data][your_relationship][{{ $i }}]" placeholder="Relationship to you" value="{{ Helper::validate_key_loop_value('your_relationship', $BasicInfo_PartD, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Case Number</label>
                        <input type="text" class="form-control case_nmbr required" name="part3[any_bankruptcy_cases_pending_data][partner_case_number][{{ $i }}]" placeholder="Case Number" value="{{ Helper::validate_key_loop_value('partner_case_number', $BasicInfo_PartD, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Date Filed</label>
                        <input type="text" class="form-control pending_cae_file_date max-today-date" name="part3[any_bankruptcy_cases_pending_data][partner_date_filed][{{ $i }}]" placeholder="MM/DD/YYYY" value="{{ Helper::validate_key_loop_value('partner_date_filed', $BasicInfo_PartD, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    @php $groups = []; @endphp
                    <div class="form-group">
                        <label>District if (known)</label>
                        <select class="form-control dsitrct required" name="part3[any_bankruptcy_cases_pending_data][district][{{ $i }}]">
                            @foreach ($district_names as $district_name)
                                @if (!in_array($district_name->short_name, $groups))
                            <optgroup label="{{ $district_name->short_name }}"></optgroup>
                                    @php array_push($groups, $district_name->short_name); @endphp
                                @endif
                            <option {{ Helper::validate_key_loop_value('district', $BasicInfo_PartD, $i) == $district_name->district_name ? 'selected' : '' }} value="{{ $district_name->district_name }}" data-name="{{ $district_name->short_name }}" data-id="{{ $district_name->id }}" class="form-control">
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