<div class="light-gray-div form-main property_transferred_data property_transferred_data_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Property Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('property_transferred_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('property_transferred_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('property_transferred_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @isset($isEmpty) @if($isEmpty) hide-data @endif @endisset">
            <div class="col-12 col-sm-6 col-xl-3">
                <label class="font-weight-bold">
                    Name & address of person paid:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_street', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-2">
                <label class="font-weight-bold">
                    Address line 2:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_address_line2', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_paid_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Person who made the payment, if not you:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_made_payment', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Email or website address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('person_email_or_website', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xl-4 col-lg-12 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transferred_value', $finacial_affairs, $i) }}</span>
                </label>
            </div>			
			<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Date of payment or transfer:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transferred_date', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Amount of payment:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('property_transferred_payment', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('property_transferred_payment', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @isset($isEmpty) @if($isEmpty) @else hide-data @endif @else hide-data @endisset">
            
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Name & address of person paid</label>
                            <input type="text" name="property_transferred_data[person_paid][{{$i}}]" class="input_capitalize form-control required person_paid" placeholder="Name and Address of Person Paid" value="{{ Helper::validate_key_loop_value('person_paid', $finacial_affairs, $i) }}">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group ">
                            <label>Street address</label>
                            <input type="text" class="input_capitalize form-control required person_paid_street" name="property_transferred_data[person_paid_street][{{$i}}]" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('person_paid_street', $finacial_affairs, $i) }}">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group ">
                            <label>Address line 2</label>
                            <input type="text" class="input_capitalize form-control person_paid_address_line2" name="property_transferred_data[person_paid_address_line2][{{$i}}]" placeholder="Address Line 2" value="{{ Helper::validate_key_loop_value('person_paid_address_line2', $finacial_affairs, $i) }}">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="input_capitalize form-control required person_paid_city" name="property_transferred_data[person_paid_city][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('person_paid_city', $finacial_affairs, $i) }}">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-1 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control required person_paid_state" name="property_transferred_data[person_paid_state][{{$i}}]">
                                <option disabled="">Please select state or territory</option>
                                {!! AddressHelper::getStatesList(@$finacial_affairs['person_paid_state'][$i]) !!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-1 mr-0  ml-0 pl-0 col-xl-1 col-lg-1 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Zip</label>
                            <input type="number" class="form-control allow-5digit required person_paid_zip" name="property_transferred_data[person_paid_zip][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('person_paid_zip', $finacial_affairs, $i) }}">
                        </div>
                    
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of person who made the payment, if not you</label>
                        <input type="text" class="input_capitalize form-control required person_made_payment" name="property_transferred_data[person_made_payment][{{$i}}]" value="{{ Helper::validate_key_loop_value('person_made_payment', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xl-36 col-lg-6 col-md-4">
                <div class="label-div">
                    <div class="form-group">
                        <label>Email or website address</label>
                        <input type="text" class="form-control required person_email_or_website" name="property_transferred_data[person_email_or_website][{{$i}}]" value="{{ Helper::validate_key_loop_value('person_email_or_website', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-lg-6">
                <div class="label-div">
                    <div class="form-group">
                        <label> Description and value of any property transferred</label>
                        <textarea name="property_transferred_data[property_transferred_value][{{$i}}]" class="input_capitalize form-control required property_transferred_value h-unset" cols="30"
                            rows="2"
                            placeholder="Description of Property Transferred">{{ Helper::validate_key_loop_value('property_transferred_value', $finacial_affairs, $i) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-lg-3 col-sm-6">
                <div class="label-div">
                    <div class="form-group">
                        <label> Date of payment or transfer</label>
                        <input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed required property_transferred_date" name="property_transferred_data[property_transferred_date][{{$i}}]" value="{{ Helper::validate_key_loop_value('property_transferred_date', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-lg-3 col-sm-6">
                <div class="label-div">
                    <div class="form-group">
                        <label>Amount of payment</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field required property_transferred_payment" name="property_transferred_data[property_transferred_payment][{{$i}}]" value="{{ Helper::validate_key_loop_value('property_transferred_payment', $finacial_affairs, $i) }}">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('property_transferred','property_transferred_data', 'property-transferred-data', 'parent_property_transferred', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>