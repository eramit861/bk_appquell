@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <h3>Edit Courthouses</h3>
        <div class="card listing-card">
            <div class="card-header">

            </div>
            <div class="card-block px-0 py-0">
                <form id="courthouse-form" action="{{ route('admin_courthouses_update', $courthouse->courthouse_id) }}{{ request()->getQueryString() ? ('?' . request()->getQueryString()) : '' }}" method="post">
                    @csrf
                    @if(request()->has('per_page'))
                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                    @endif
                    @if(request()->has('search_courthouse_state'))
                    <input type="hidden" name="search_courthouse_state" value="{{ request('search_courthouse_state') }}">
                    @endif
                    @if(request()->has('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    <div class="container">

                        <div class="form-group">
                            <label>Courthouse Name</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('courthouse_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter courthouse name here " name="courthouse_name"
                                value="{{old('courthouse_name', $courthouse->courthouse_name)}}">
                            @if ($errors->has('courthouse_name'))
                            <p class="help-block text-danger">{{ $errors->first('courthouse_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Courthouse Address</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('courthouse_address') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state code here " name="courthouse_address"
                                value="{{old('courthouse_address', $courthouse->courthouse_address)}}">
                            @if ($errors->has('courthouse_address'))
                            <p class="help-block text-danger">{{ $errors->first('courthouse_address') }}</p>
                            @endif
                        </div>


                        <div class="form-group">
                            <label>City</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('courthouse_city') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter City here " name="courthouse_city"
                                value="{{old('courthouse_city', $courthouse->courthouse_city)}}">
                            @if ($errors->has('courthouse_city'))
                            <p class="help-block text-danger">{{ $errors->first('courthouse_city') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('courthouse_state') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state here " name="courthouse_state"
                                value="{{old('courthouse_state', $courthouse->courthouse_state)}}">
                            @if ($errors->has('courthouse_state'))
                            <p class="help-block text-danger">{{ $errors->first('courthouse_state') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" required
                                class="form-control allow-5digit {{ $errors->has('courthouse_zip') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Zip code here " name="courthouse_zip"
                                value="{{old('courthouse_zip', $courthouse->courthouse_zip)}}">
                            @if ($errors->has('courthouse_zip'))
                            <p class="help-block text-danger">{{ $errors->first('courthouse_zip') }}</p>
                            @endif
                        </div>

                        
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" 
                                class="form-control phone-field {{ $errors->has('courthouse_contact') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Contact here " name="courthouse_contact"
                                value="{{old('courthouse_contact', $courthouse->courthouse_contact)}}">
                            @if ($errors->has('courthouse_contact'))
                            <p class="help-block text-danger">{{ $errors->first('courthouse_contact') }}</p>
                            @endif
                        </div>
                         <a href="{{ route('admin_courthouses_index', request()->query()) }}" class="btn btn-theme-black">Back</a>
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
                    
                    $("#courthouse-form").validate({
                        
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
