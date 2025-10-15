@php
use App\Helpers\ArrayHelper;
@endphp

<div class="light-gray-div form-main list_lawsuits list_lawsuits_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Case Details
        </h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete "
            onclick="edit_div_common('list_lawsuits', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete"
            onclick="seperate_remove_div_common('list_lawsuits', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if(isset($isEmpty) && $isEmpty) hide-data @endif">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Case Title:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('case_title', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Case Number:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('case_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Nature of the Case:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('case_nature', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Status or Disposition:
                    <span class="font-weight-normal">
                        @if(Helper::validate_key_loop_value('disposition', $finacial_affairs, $i) == 1) Pending @endif
                        @if(Helper::validate_key_loop_value('disposition', $finacial_affairs, $i) == 2) On Appeal @endif
                        @if(Helper::validate_key_loop_value('disposition', $finacial_affairs, $i) == 3) Concluded @endif
                    </span>
                </label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <label class="font-weight-bold">
                    Court or Agency:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('agency_location', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <label class="font-weight-bold">
                    Address:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('agency_street', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    City:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('agency_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    State:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('agency_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    Zip code:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('agency_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            @if(!empty($lawsuitDebts))
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Relate to debt:
                    <span class="font-weight-normal">
                        @php
                            $selectedValue = isset($finacial_affairs['related_to'][$i]) ? $finacial_affairs['related_to'][$i] : '';
                            $selectedData = $lawsuitDebts[$selectedValue] ?? [];
                            echo !empty($selectedData) ? $selectedData['creditor_name'] : '';
                        @endphp
                    </span>
                </label>
            </div>
            @endif

        </div>

        @php
            // Get current case title value
            $caseTitle = Helper::validate_key_loop_value('case_title', $finacial_affairs, $i);
            // Normalize case for matching
            $caseTitleLower = strtolower($caseTitle);
            $debtorChecked = (!empty($debtorname) && strpos($caseTitleLower, strtolower($debtorname)) !== false) ? 'checked' : '';
            $spouseChecked = (!empty($spousename) && strpos($caseTitleLower, strtolower($spousename)) !== false) ? 'checked' : '';
        @endphp
        <div class="row gx-3 edit_section @if(isset($isEmpty) && $isEmpty) @else hide-data @endif">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-flex align-items-center">
                            <span class="">Case Title</span>
                            <div class="form-check ms-auto mb-0" style="min-height: unset;">
                                <input class="form-check-input debtor" type="checkbox" id="add_debtor_{{ $i }}"
                                    data-name="{{ $debtorname }}" onclick="toggleNameToLawSuit(this)" {{ $debtorChecked }}>
                                <label class="form-check-label form-label mb-0"
                                    for="add_debtor_{{ $i }}">Debtor</label>
                            </div>
                            @if(!empty($spousename) && $client_type == 3)
                            <div class="form-check ms-2 mb-0" style="min-height: unset;">
                                <input class="form-check-input codebtor" type="checkbox"
                                    id="add_codebtor_{{ $i }}" data-name="{{ $spousename }}"
                                    onclick="toggleNameToLawSuit(this)" {{ $spouseChecked }}>
                                <label class="form-check-label form-label mb-0"
                                    for="add_codebtor_{{ $i }}">{{ ($client_type == 2) ? "Non-Filing Spouse" : "Co-Debtor" }}</label>
                            </div>
                            @endif
                        </label>
                        <input type="text" name="list_lawsuits_data[case_title][{{$i}}]"
                            class="input_capitalize form-control required case_title" placeholder="Case Title"
                            value="{{ Helper::validate_key_loop_value('case_title', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Case Number</label>
                        <input type="text" name="list_lawsuits_data[case_number][{{$i}}]"
                            class="form-control required case_number" placeholder="Case Number"
                            value="{{ Helper::validate_key_loop_value('case_number', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                @php $nature_of_case = ArrayHelper::getNatureOfCase(); @endphp
                <div class="label-div">
                    <div class="form-group">
                        <label>Nature of the Case</label>
                        <select class="form-control required case_nature"
                            name="list_lawsuits_data[case_nature][{{$i}}]">
                            <option value="">Please Select Nature of the Case</option>
                            @foreach($nature_of_case as $us_key => $usa_vl)
                                <option value="{{ $us_key }}" {{($us_key == @$finacial_affairs['case_nature'][$i]) ? 'selected' : ''}}>{{ $usa_vl }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>
                            <small class="blink text-c-red mb-0">
                                Type the name of the <u>CITY</u> of the courthouse the lawsuit is filed in: </br>
                                Then select the courthouse from the drop down
                            </small>
                        </label>
                        <input type="text"
                            class="input_capitalize form-control required agency_location agency_location_autocomplete autocomplete "
                            placeholder="Enter Name Of City Of Courthouse For List Of Addresses"
                            name="list_lawsuits_data[agency_location][{{$i}}]"
                            value="{{ Helper::validate_key_loop_value('agency_location', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Street Address</label>
                        <input type="text" class="input_capitalize form-control required agency_street"
                            name="list_lawsuits_data[agency_street][{{$i}}]" placeholder="Street Address"
                            value="{{ Helper::validate_key_loop_value('agency_street', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required agency_city"
                            name="list_lawsuits_data[agency_city][{{$i}}]" placeholder="City"
                            value="{{ Helper::validate_key_loop_value('agency_city', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required agency_state"
                            name="list_lawsuits_data[agency_state][{{$i}}]">
                            <option disabled="">Please Select State or Territory</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['agency_state'][$i]) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="number" class="form-control allow-5digit required agency_zip"
                            name="list_lawsuits_data[agency_zip][{{$i}}]" placeholder="Zip"
                            value="{{ Helper::validate_key_loop_value('agency_zip', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="label-div question-area border-0 pb-0">
                    <label class="fs-13px">
                        Status or Disposition
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                        <input type="radio" id="list-lawsuits_disposition_pending-{{ $i }}" class="d-none disposition"
                            name="list_lawsuits_data[disposition][{{$i}}]" required {{ Helper::validate_key_loop_toggle('disposition', $finacial_affairs, 1, $i) }} value="1">
                        <label for="list-lawsuits_disposition_pending-{{ $i }}"
                            class="btn-toggle {{ Helper::validate_key_loop_toggle_active('disposition', $finacial_affairs, 1, $i) }}">Pending</label>

                        <input type="radio" id="list-lawsuits_disposition_appeal-{{ $i }}" class="d-none disposition"
                            name="list_lawsuits_data[disposition][{{$i}}]" required {{ Helper::validate_key_loop_toggle('disposition', $finacial_affairs, 2, $i) }} value="2">
                        <label for="list-lawsuits_disposition_appeal-{{ $i }}"
                            class="btn-toggle {{ Helper::validate_key_loop_toggle_active('disposition', $finacial_affairs, 2, $i) }}">On
                            Appeal</label>

                        <input type="radio" id="list-lawsuits_disposition_concluded-{{ $i }}" class="d-none disposition"
                            name="list_lawsuits_data[disposition][{{$i}}]" required {{ Helper::validate_key_loop_toggle('disposition', $finacial_affairs, 3, $i) }} value="3">
                        <label for="list-lawsuits_disposition_concluded-{{ $i }}"
                            class="btn-toggle {{ Helper::validate_key_loop_toggle_active('disposition', $finacial_affairs, 3, $i) }}">Concluded</label>

                    </div>

                </div>
            </div>

            <div class="col-xxl-6 align-left col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12 mt-4"> <span
                    class="pt-2 blink text-c-red font-weight-bold">We need a copy of the lawsuit so it can be listed in your bankruptcy and all parties are notified, protecting you after your case is complete.</span></div>

            @if(!empty($lawsuitDebts))
            <div class="col-xxl-3 align-left col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 mt-4 text-right mb-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Relate to debt</label>
                        <select class="form-control related_to" name="list_lawsuits_data[related_to][{{$i}}]">
                            <option value="">Choose Creditor</option>
                            @foreach($lawsuitDebts as $index => $debt)
                            <option data-il='{{$caseTitleLower}}' value="{{ $index }}" {{ (str_contains($caseTitleLower, strtolower($debt['creditor_name']))) ? 'selected' : '' }}>{{ ($index + 1) . '. ' . $debt['creditor_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    data-url="{{ route('sofa_seperate_save') }}"
                    onclick="seperate_save('list_lawsuits','list_lawsuits', 'list-lawsuits-data', 'parent_list_lawsuits', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>