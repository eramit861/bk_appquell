@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        
        <div class="card listing-card">
            <div class="card-header">
                <h4>Edit Domestic Address</h4>
            </div>
            <div class="card-block ">
                <form id="edit_domestic_address" action="{{route('admin_domestic_update', $address->id)}}" method="post">
                    @csrf
                    <div class="container">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <h5>Domestic Address</h5>								
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input required type="text"
                                                class="form-control {{ $errors->has('address_name') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter name here " name="address_name"
                                                value="{{old('address_name', $address->address_name)}}">
                                            @if ($errors->has('address_name'))
                                            <p class="help-block text-danger">{{ $errors->first('address_name') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Address line 1</label>
                                            <input required type="text"
                                                class="form-control {{ $errors->has('address_street') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter address line 1 " name="address_street"
                                                value="{{old('address_street', $address->address_street)}}">
                                            @if ($errors->has('address_street'))
                                            <p class="help-block text-danger">{{ $errors->first('address_street') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label> Address Line 2</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('address_line2') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter address line 2 " name="address_line2"
                                                value="{{old('address_line2', $address->address_line2)}}">
                                            @if ($errors->has('address_line2'))
                                            <p class="help-block text-danger">{{ $errors->first('address_line2') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>City</label>
                                            <input required type="text"
                                                class="form-control {{ $errors->has('address_city') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter city here " name="address_city"
                                                value="{{old('address_city', $address->address_city)}}">
                                            @if ($errors->has('address_city'))
                                            <p class="help-block text-danger">{{ $errors->first('address_city') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group state_box">
                                            <label>State</label>
                                            <select required name="address_state" class="assign-forms form-control" >
                                            <?php echo AddressHelper::getStatesList($address->address_state); ?>
                                            </select>
                                            @if ($errors->has('address_states'))
                                            <p class="help-block text-danger">{{ $errors->first('address_state') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Zip</label>
                                            <input required type="text"
                                                class="form-control allow-5digit {{ $errors->has('address_zip') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter zip here " name="address_zip"
                                                value="{{old('address_zip', $address->address_zip)}}">
                                            @if ($errors->has('address_zip'))
                                            <p class="help-block text-danger">{{ $errors->first('address_zip') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text"
                                                class="form-control phone-field {{ $errors->has('address_phone') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter phone here " name="address_phone"
                                                value="{{old('address_phone', $address->address_phone)}}">
                                            @if ($errors->has('address_phone'))
                                            <p class="help-block text-danger">{{ $errors->first('address_phone') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text"
                                                class="form-control phone-field {{ $errors->has('address_fax') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter phone here " name="address_fax"
                                                value="{{old('address_fax', $address->address_fax)}}">
                                            @if ($errors->has('address_fax'))
                                            <p class="help-block text-danger">{{ $errors->first('address_fax') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email"
                                                class="form-control {{ $errors->has('address_email') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter email here " name="address_email"
                                                value="{{old('address_email', $address->address_email)}}">
                                            @if ($errors->has('address_email'))
                                            <p class="help-block text-danger">{{ $errors->first('address_email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <h5>BK Service Address</h5>								
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input required type="text"
                                                class="form-control {{ $errors->has('notify_address_name') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter name here " name="notify_address_name"
                                                value="{{old('notify_address_name', $address->notify_address_name)}}">
                                            @if ($errors->has('notify_address_name'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_name') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Address line 1</label>
                                            <input required type="text"
                                                class="form-control {{ $errors->has('notify_address_street') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter address line 1 " name="notify_address_street"
                                                value="{{old('notify_address_street', $address->notify_address_street)}}">
                                            @if ($errors->has('notify_address_street'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_street') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label> Address Line 2</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('notify_address_line2') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter address line 2 " name="notify_address_line2"
                                                value="{{old('notify_address_line2', $address->notify_address_line2)}}">
                                            @if ($errors->has('notify_address_line2'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_line2') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>City</label>
                                            <input required type="text"
                                                class="form-control {{ $errors->has('notify_address_city') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter city here " name="notify_address_city"
                                                value="{{old('notify_address_city', $address->notify_address_city)}}">
                                            @if ($errors->has('notify_address_city'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_city') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Zip</label>
                                            <input required type="text"
                                                class="form-control allow-5digit {{ $errors->has('notify_address_zip') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter zip here " name="notify_address_zip"
                                                value="{{old('notify_address_zip', $address->notify_address_zip)}}">
                                            @if ($errors->has('notify_address_zip'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_zip') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text"
                                                class="form-control phone-field {{ $errors->has('notify_address_phone') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter phone here " name="notify_address_phone"
                                                value="{{old('notify_address_phone', $address->notify_address_phone)}}">
                                            @if ($errors->has('notify_address_phone'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_phone') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text"
                                                class="form-control phone-field {{ $errors->has('notify_address_fax') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter phone here " name="notify_address_fax"
                                                value="{{old('notify_address_fax', $address->notify_address_fax)}}">
                                            @if ($errors->has('notify_address_fax'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_fax') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email"
                                                class="form-control {{ $errors->has('notify_address_email') ? 'btn-outline-danger' : '' }}"
                                                placeholder="Enter email here " name="notify_address_email"
                                                value="{{old('notify_address_email', $address->notify_address_email)}}">
                                            @if ($errors->has('notify_address_email'))
                                            <p class="help-block text-danger">{{ $errors->first('notify_address_email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <a href="{{route('admin_domestic_index')}}" class="btn btn-theme-black">Back</a>
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                        <br><br>
                    </div>
                </form>
            </div>
            <style>
            label.error {
                color: red;
                font-style: italic;
            }
            </style>
            <script>
                $(document).ready(function(){

                    $("#edit_domestic_address").validate({

                        errorPlacement: function (error, element) {
                            if($(element).parents(".form-group").next('label').hasClass('error')){

                                $(element).parents(".form-group").next('label').remove();
                                $(element).parents(".form-group").after($(error)[0].outerHTML);
                            }else{

                                $(element).parents(".form-group").after($(error)[0].outerHTML);
                            }
                        },
                        success: function(label,element) {
                            label.parent().removeClass('error');

                            $(element).parents(".form-group").next('label').remove();
                        },
                    });
                    });
            </script>
        </div>
    </div>
    <!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection
