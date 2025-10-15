@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
       
        <div class="card listing-card">
            <div class="card-header">
                <h4>Edit Division,District & Zipcodes</h4>
            </div>
            <div class="card-block">
                <form action="{{route('admin_zipcode_update', $zip_code->id)}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group">
                            <label>District Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('district_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter district name here " name="district_name"
                                value="{{old('district_name', $zip_code->district_name)}}">
                            @if ($errors->has('district_name'))
                            <p class="help-block text-danger">{{ $errors->first('district_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Division Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('division_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter division name here " name="division_name"
                                value="{{old('division_name', $zip_code->division_name)}}">
                            @if ($errors->has('division_name'))
                            <p class="help-block text-danger">{{ $errors->first('division_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>ZipCode</label>
                            <textarea type="text"
                                class="form-control {{ $errors->has('zip_code') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter zipcode here "
                                name="zip_code">{{old('zip_code', implode(',',$zip_code->zip_code))}}</textarea>
                            @if ($errors->has('zip_code'))
                            <p class="help-block text-danger">{{ $errors->first('zip_code') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Assign Forms</label>
                            <select id="multiple" name="assign_forms[]" class="assign-forms form-control" multiple>
                                @foreach ($local_forms as $form)
                                <option value="{{$form->form_id}}" @if(!empty($zip_code->assign_forms)) {{in_array(
                                    $form->form_id, $zip_code->assign_forms) ? 'selected' : '' }}@endif>{{
                                    $form->form_name
                                    }}</option>
                                @endforeach


                            </select>
                            @if ($errors->has('assign_forms'))
                            <p class="help-block text-danger">{{ $errors->first('assign_forms') }}</p>
                            @endif
                        </div>
                        <a href="{{route('admin_zipcode_index')}}" class="btn btn-theme-black">Back</a>
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection
