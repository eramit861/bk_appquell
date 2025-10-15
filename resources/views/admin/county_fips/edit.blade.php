@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        
        <div class="card listing-card">
            <div class="card-header pl-3">
                <h4>Edit County FIPS</h4>
            </div>
            <div class="card-block">
                <form action="{{route('admin_fips_update', $stateCounty->id)}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group">
                            <label>State Name</label>
                            <input readonly type="text"
                                class="form-control {{ $errors->has('state_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state name here " name="state_name"
                                value="{{old('state_name', $stateCounty->state_name)}}">
                            @if ($errors->has('state_name'))
                            <p class="help-block text-danger">{{ $errors->first('state_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>County Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('county_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter county name here " name="county_name"
                                value="{{old('county_name', $stateCounty->county_name)}}">
                            @if ($errors->has('county_name'))
                            <p class="help-block text-danger">{{ $errors->first('county_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>FIPS Code</label>
                            <input type="text"
                                class="form-control {{ $errors->has('fips_code') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter FIPS Code here " name="fips_code"
                                value="{{old('fips_code', $stateCounty->fips_code)}}">
                            @if ($errors->has('fips_code'))
                            <p class="help-block text-danger">{{ $errors->first('fips_code') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Select Division</label>
                            <select name="fips_division" class="form-control">
                                <option>Select division</option>
                                <?php foreach ($divisions as $div) { ?>
                                    <option <?php if ($stateCounty->fips_division == $div['id']) {
                                        echo "selected";
                                    } ?> value="{{$div['id']}}">{{$div['division_name']}}</div>
                                <?php } ?>
                            </select>
                            @if ($errors->has('fips_division'))
                            <p class="help-block text-danger">{{ $errors->first('fips_division') }}</p>
                            @endif
                        </div>

                        <a href="{{route('admin_fips_index')}}" class="btn btn-theme-black">Back</a>
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
