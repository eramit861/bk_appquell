@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
            <div class="card-header">
                <h4>Edit Mortgage</h4>
            </div>
            <div class="card-block">
                <form id="mortgage-form" action="{{route('admin_mortgages_update', $mortgage->mortgage_id)}}" method="post">
                    @csrf
                    <div class="container">
                    <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Mortgage Name</label>
                            <input type="text" required
                                class="form-control  {{ $errors->has('mortgage_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter mortgage name here " name="mortgage_name"
                                value="{{old('mortgage_name', $mortgage->mortgage_name)}}">
                            @if ($errors->has('mortgage_name'))
                            <p class="help-block text-danger">{{ $errors->first('mortgage_name') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Is OCR Available for this?</label><br>
                            <div class="d-inline radio-primary">
                                <input type="radio" <?php if ($mortgage->is_ocr_available == 1) {
                                    echo "checked='checked'";
                                }?>  id="is_ocr_available_yes" name="is_ocr_available" value="1" class="required is_ocr_available" required />
                                <label for="is_ocr_available_yes" class="cr pt-2 ml-2">Yes</label>
                            </div>
                            <div class="d-inline radio-primary">
                                <input type="radio" <?php if ($mortgage->is_ocr_available == 0) {
                                    echo "checked='checked'";
                                }?> id="is_ocr_available_no" name="is_ocr_available" value="0" class="required is_ocr_available" required />
                                <label for="is_ocr_available_no" class="cr pt-2 ml-2">No</label>
                            </div>
                            @if ($errors->has('is_ocr_available'))
                            <p class="help-block text-danger">{{ $errors->first('is_ocr_available') }}</p>
                            @endif
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Mortgage Address</label>
                            <input type="text" required
                                class="form-control  {{ $errors->has('mortgage_address') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state code here " name="mortgage_address"
                                value="{{old('mortgage_address', $mortgage->mortgage_address)}}">
                            @if ($errors->has('mortgage_address'))
                            <p class="help-block text-danger">{{ $errors->first('mortgage_address') }}</p>
                            @endif
                        </div>


                        <div class="form-group">
                            <label>City</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('mortgage_city') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter City here " name="mortgage_city"
                                value="{{old('mortgage_city', $mortgage->mortgage_city)}}">
                            @if ($errors->has('mortgage_city'))
                            <p class="help-block text-danger">{{ $errors->first('mortgage_city') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <input type="text" required
                                class="form-control {{ $errors->has('mortgage_state') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state here " name="mortgage_state"
                                value="{{old('mortgage_state', $mortgage->mortgage_state)}}">
                            @if ($errors->has('mortgage_state'))
                            <p class="help-block text-danger">{{ $errors->first('mortgage_state') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" required
                                class="form-control allow-5digit {{ $errors->has('mortgage_zip') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Zip code here " name="mortgage_zip"
                                value="{{old('mortgage_zip', $mortgage->mortgage_zip)}}">
                            @if ($errors->has('mortgage_zip'))
                            <p class="help-block text-danger">{{ $errors->first('mortgage_zip') }}</p>
                            @endif
                        </div>

                        
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text"
                                class="form-control {{ $errors->has('mortgage_webiste') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Website here " name="mortgage_webiste"
                                value="{{old('mortgage_webiste', $mortgage->mortgage_webiste)}}">
                            @if ($errors->has('mortgage_webiste'))
                            <p class="help-block text-danger">{{ $errors->first('mortgage_webiste') }}</p>
                            @endif
                        </div>
                         <a href="{{route('admin_mortgages_index')}}" class="btn btn-theme-black">Back</a>
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
                    
                    $("#mortgage-form").validate({
                        
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
