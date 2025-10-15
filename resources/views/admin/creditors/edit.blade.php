@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        
        <div class="card listing-card">
            <div class="card-header">
                <h4>Edit Master Creditors</h4>
            </div>
            <div class="card-block">
                <form action="{{route('admin_creditors_update', $creditor->creditor_id)}}" method="post">
                    @csrf
                    <div class="container">

                        <div class="form-group">
                            <label>creditor Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('creditor_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter creditor name here " name="creditor_name"
                                value="{{old('creditor_name', $creditor->creditor_name)}}">
                            @if ($errors->has('creditor_name'))
                            <p class="help-block text-danger">{{ $errors->first('creditor_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>creditor Address</label>
                            <input type="text"
                                class="form-control {{ $errors->has('creditor_address') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state code here " name="creditor_address"
                                value="{{old('creditor_address', $creditor->creditor_address)}}">
                            @if ($errors->has('creditor_address'))
                            <p class="help-block text-danger">{{ $errors->first('creditor_address') }}</p>
                            @endif
                        </div>


                        <div class="form-group">
                            <label>City</label>
                            <input type="text"
                                class="form-control {{ $errors->has('creditor_city') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter City here " name="creditor_city"
                                value="{{old('creditor_city', $creditor->creditor_city)}}">
                            @if ($errors->has('creditor_city'))
                            <p class="help-block text-danger">{{ $errors->first('creditor_city') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <input type="text"
                                class="form-control {{ $errors->has('creditor_state') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state here " name="creditor_state"
                                value="{{old('creditor_state', $creditor->creditor_state)}}">
                            @if ($errors->has('creditor_state'))
                            <p class="help-block text-danger">{{ $errors->first('creditor_state') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text"
                                class="form-control allow-5digit {{ $errors->has('creditor_zip') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Zip code here " name="creditor_zip"
                                value="{{old('creditor_zip', $creditor->creditor_zip)}}">
                            @if ($errors->has('creditor_zip'))
                            <p class="help-block text-danger">{{ $errors->first('creditor_zip') }}</p>
                            @endif
                        </div>

                        
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text"
                                class="form-control phone-field {{ $errors->has('creditor_contact') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Contact here " name="creditor_contact"
                                value="{{old('creditor_contact', $creditor->creditor_contact)}}">
                            @if ($errors->has('creditor_contact'))
                            <p class="help-block text-danger">{{ $errors->first('creditor_contact') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Website</label>
                            <input type="text"
                                class="form-control {{ $errors->has('creditor_website') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Website Url here " name="creditor_website"
                                value="{{old('creditor_website', $creditor->creditor_website)}}">
                            @if ($errors->has('creditor_website'))
                            <p class="help-block text-danger">{{ $errors->first('creditor_website') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control {{ $errors->has('category') ? 'btn-outline-danger' : '' }} " name="category" >
                                <option value="">Select Category</option>
                                <?php foreach (Helper::getCreditorCategories() as $key => $category) { ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($key == $creditor->category) ? 'selected' : ''; ?>><?php echo $category; ?></option>
                                <?php } ?>
                            </select>
                            @if ($errors->has('category'))
                            <p class="help-block text-danger">{{ $errors->first('category') }}</p>
                            @endif
                        </div>

                    
                     
                        <a href="{{route('admin_creditors_index')}}" class="btn btn-theme-black">Back</a>
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
