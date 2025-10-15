@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <h3>Add New Division & District</h3>
        <div class="card listing-card">
            <div class="card-header">
                
            </div>
            <div class="card-block px-0 py-0">
                <form id="add_zip_form" action="{{route('admin_zipcode_store')}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group">
                            <label>District Name</label>
                            <input type="text" required value="{{ old('district_name') }}"
                                class="form-control {{ $errors->has('district_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter district name here " name="district_name">
                            @if ($errors->has('district_name'))
                            <p class="help-block text-danger">{{ $errors->first('district_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Division Name</label>
                            <input type="text" required value="{{ old('division_name') }}"
                                class="form-control {{ $errors->has('division_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter division name here " name="division_name">
                            @if ($errors->has('division_name'))
                            <p class="help-block text-danger">{{ $errors->first('division_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>ZipCode</label>
                            <textarea type="text" required value="{{ old('zip_code') }}"
                                class="form-control {{ $errors->has('zip_code') ? 'btn-outline-danger' : '' }}"
                                placeholder="Please Note: Add zipcode with comma separated values. Example: 90001,89721,45678" name="zip_code"></textarea>
                            @if ($errors->has('zip_code'))
                            <p class="help-block text-danger">{{ $errors->first('zip_code') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Assign Forms</label>
                            <select required value="{{ old('assign_forms') }}" id="multiple" name="assign_forms[]" class="assign-forms form-control" multiple>
                                <option value=""> select form </option>
                                @foreach ($local_forms as $form)
                                <option value="{{$form->form_id}}">{{$form->form_name}}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('assign_forms'))
                            <p class="help-block text-danger">{{ $errors->first('assign_forms') }}</p>
                            @endif
                        </div><br>
                        <a href="{{route('admin_zipcode_index')}}" class="btn btn-theme-black">Back</a>
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
				
				$("#add_zip_form").validate({
					
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
