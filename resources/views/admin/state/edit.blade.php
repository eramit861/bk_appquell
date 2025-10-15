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
                <form action="{{route('admin_state_update', $state->state_id)}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group">
                            <label>State Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('state_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state name here " name="state_name"
                                value="{{old('state_name', $state->state_name)}}">
                            @if ($errors->has('state_name'))
                            <p class="help-block text-danger">{{ $errors->first('state_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>State Code</label>
                            <input type="text"
                                class="form-control {{ $errors->has('state_code') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state code here " name="state_code"
                                value="{{old('state_code', $state->state_code)}}">
                            @if ($errors->has('state_code'))
                            <p class="help-block text-danger">{{ $errors->first('state_code') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select id="multiple" name="state_status" class="assign-forms form-control" >
                               <option value="1" <?php if ($state->state_status == 1) {
                                   echo 'selected';
                               } ?> > Active</option>
                               <option value="0" <?php if ($state->state_status == 0) {
                                   echo 'selected';
                               } ?> > In-Active</option>
                            </select>
                            @if ($errors->has('state_status'))
                            <p class="help-block text-danger">{{ $errors->first('state_status') }}</p>
                            @endif
                        </div>
                        <a href="{{route('admin_state_index')}}" class="btn btn-theme-black">Back</a>
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
