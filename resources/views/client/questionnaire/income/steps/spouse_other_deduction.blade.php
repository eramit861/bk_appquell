<div class="col-12 light-gray-div spouse_deduction_section spouse_deduction_section_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Deduction Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('spouse_deduction_section', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            @php $otherDeductionArray = Helper::getOtherDeductionsArray(); @endphp
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
                <div class="label-div">
                    <div class="input-group">
                        <select class="form-control joints_other_deduction_type joints_other_deduction_type_{{$i}}" name="joints_other_deduction_type[{{ $i }}]" onchange="deductionChange('{{$i}}', true)">
                            <option value="" selected disabled>Select Deduction</option>
                            @foreach($otherDeductionArray as $key => $value)
                                <option value="{{$key}}" {{ (!empty($debtorspousemonthlyincome['joints_other_deduction_type'][$i]) && $debtorspousemonthlyincome['joints_other_deduction_type'][$i] == $key) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 joints_other_deduction_specify_{{$i}} {{ (!empty($debtorspousemonthlyincome['joints_other_deduction_type'][$i]) && $debtorspousemonthlyincome['joints_other_deduction_type'][$i] == 16) ? '' : 'hide-data' }}">
                <div class="label-div">
                    <div class="input-group ">
                        <input type="text"
                            class="input_capitalize form-control required joint_other_deduction_specify"
                            placeholder="Specify deduction"
                            name="other_deduction_specify[{{ $i }}]"
                            value="{{ !empty($debtorspousemonthlyincome['other_deduction_specify'][$i]) ? $debtorspousemonthlyincome['other_deduction_specify'][$i] : '' }}" />
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
                <div class="label-div">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control price-field required no_dup_inp joints_other_deduction" placeholder="0.00" name="joints_other_deduction[{{ $i }}]" value="{{ !empty($debtorspousemonthlyincome['joints_other_deduction'][$i]) ? $debtorspousemonthlyincome['joints_other_deduction'][$i] : '' }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>