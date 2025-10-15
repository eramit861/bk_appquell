<div class="col-12 light-gray-div deduction_section deduction_section_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Deduction Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('deduction_section', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
                <div class="label-div">
                    <div class="input-group">
                        @php $otherDeductionArray = Helper::getOtherDeductionsArray(); @endphp
                        <select class="form-control other_deduction_type other_deduction_type_{{$i}}" name="other_deduction_type[{{ $i }}]" onchange="deductionChange('{{$i}}')">
                            <option value="" selected disabled>Select Deduction</option>
                            @foreach($otherDeductionArray as $key => $value)
                                <option value="{{$key}}" {{ (!empty($debtormonthlyincome['other_deduction_type'][$i]) && $debtormonthlyincome['other_deduction_type'][$i] == $key) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 label-div other_deduction_specify_{{$i}} {{ (!empty($debtormonthlyincome['other_deduction_type'][$i]) && $debtormonthlyincome['other_deduction_type'][$i] == 16) ? '' : 'hide-data' }}">
                <div class="input-group">
                    <input type="text"
                        class="input_capitalize form-control required other_deduction_specify"
                        placeholder="Specify deduction"
                        name="other_deduction_specify[{{ $i }}]"
                        value="{{ !empty($debtormonthlyincome['other_deduction_specify'][$i]) ? $debtormonthlyincome['other_deduction_specify'][$i] : '' }}" />
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
                <div class="label-div">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control price-field required no_dup_inp other_deduction" placeholder="0.00" name="other_deduction[{{ $i }}]" value="{{ !empty($debtormonthlyincome['other_deduction'][$i]) ? $debtormonthlyincome['other_deduction'][$i] : '' }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>