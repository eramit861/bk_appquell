@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
            <div class="card-header">
                <h4>Edit State Tax</h4>
            </div>
            <div class="card-block">
                <form id="debtstax-form" action="{{route('admin_debtstaxes_update', $debtstax->id)}}" method="post">
                    @csrf
                    <div class="container">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>State Name</label>
                            <input type="text" required
                                class="form-control  {{ $errors->has('stax_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter State name here " name="stax_name"
                                value="{{old('stax_name', $debtstax->stax_name)}}">
                            @if ($errors->has('stax_name'))
                            <p class="help-block text-danger">{{ $errors->first('stax_name') }}</p>
                            @endif
                        </div>
                        </div>
                       
                        </div>
                        <div class="form-group">
                            <label>Address Line 1</label>
                            <input type="text" 
                                class="form-control  {{ $errors->has('stax_address1') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Address Line 1 here " name="stax_address1"
                                value="{{old('stax_address1', $debtstax->stax_address1)}}">
                            @if ($errors->has('stax_address1'))
                            <p class="help-block text-danger">{{ $errors->first('stax_address1') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Address Line 2</label>
                            <input type="text" 
                                class="form-control  {{ $errors->has('stax_address2') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Address Line 2 here " name="stax_address2"
                                value="{{old('stax_address2', $debtstax->stax_address2)}}">
                            @if ($errors->has('stax_address2'))
                            <p class="help-block text-danger">{{ $errors->first('stax_address2') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Address Line 3</label>
                            <input type="text" 
                                class="form-control  {{ $errors->has('stax_address3') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Address Line 3 here " name="stax_address3"
                                value="{{old('stax_address3', $debtstax->stax_address3)}}">
                            @if ($errors->has('stax_address3'))
                            <p class="help-block text-danger">{{ $errors->first('stax_address3') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('stax_city') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter City here " name="stax_city"
                                value="{{old('stax_city', $debtstax->stax_city)}}">
                            @if ($errors->has('stax_city'))
                            <p class="help-block text-danger">{{ $errors->first('stax_city') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('stax_state') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state here " name="stax_state"
                                value="{{old('stax_state', $debtstax->stax_state)}}">
                            @if ($errors->has('stax_state'))
                            <p class="help-block text-danger">{{ $errors->first('stax_state') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" required
                                class="form-control allow-5digit {{ $errors->has('stax_zip') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Zip code here " name="stax_zip"
                                value="{{old('stax_zip', $debtstax->stax_zip)}}">
                            @if ($errors->has('stax_zip'))
                            <p class="help-block text-danger">{{ $errors->first('stax_zip') }}</p>
                            @endif
                        </div>

                        
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text"
                                class="form-control {{ $errors->has('stax_contact') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Website here " name="stax_contact"
                                value="{{old('stax_contact', $debtstax->stax_contact)}}">
                            @if ($errors->has('stax_contact'))
                            <p class="help-block text-danger">{{ $errors->first('stax_contact') }}</p>
                            @endif
                        </div>
                         <a href="{{route('admin_debtstaxes_index')}}" class="btn btn-theme-black">Back</a>
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--[ Recent Users ] end-->
</div>
<style>
            label.error {
                color: red;
                font-style: italic;
            }
            </style>
            <script>
                $(document).ready(function(){
                    
                    $("#debtstax-form").validate({
                        
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
<!-- [ Main Content ] end -->
@endsection
