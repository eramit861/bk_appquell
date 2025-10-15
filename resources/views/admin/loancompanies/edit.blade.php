@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        
        <div class="card listing-card">
            <div class="card-header pl-3">
                <h4>Edit Audo Loan Company</h4>
            </div>
            <div class="card-block">
                <form action="{{route('admin_loancompanies_update', $company->id)}}" method="post">
                    @csrf
                    <div class="container">
                    <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('alcomp_name') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter company name here " name="alcomp_name"
                                value="{{old('alcomp_name', $company->alcomp_name)}}">
                            @if ($errors->has('alcomp_name'))
                            <p class="help-block text-danger">{{ $errors->first('alcomp_name') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Is OCR Available for this?</label><br>
                            <div class="d-inline radio-primary">
                                <input type="radio" <?php if ($company->is_ocr_available == 1) {
                                    echo "checked='checked'";
                                }?>  id="is_ocr_available_yes" name="is_ocr_available" value="1" class="required is_ocr_available" required />
                                <label for="is_ocr_available_yes" class="cr pt-2 ml-2">Yes</label>
                            </div>
                            <div class="d-inline radio-primary">
                                <input type="radio" <?php if ($company->is_ocr_available == 0) {
                                    echo "checked='checked'";
                                }?> id="is_ocr_available_no" name="is_ocr_available" value="0" class="required is_ocr_available" required />
                                <label for="is_ocr_available_no" class="cr pt-2 ml-2">No</label>
                            </div>
                            @if ($errors->has('is_ocr_available'))
                            <p class="help-block text-danger">{{ $errors->first('is_ocr_available') }}</p>
                            @endif
                        </div>
                        </div>

                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Company Address</label>
                            <input type="text"
                                class="form-control {{ $errors->has('alcomp_address') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state code here " name="alcomp_address"
                                value="{{old('alcomp_address', $company->alcomp_address)}}">
                            @if ($errors->has('alcomp_address'))
                            <p class="help-block text-danger">{{ $errors->first('alcomp_address') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text"
                                class="form-control {{ $errors->has('alcomp_city') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter City here " name="alcomp_city"
                                value="{{old('alcomp_city', $company->alcomp_city)}}">
                            @if ($errors->has('alcomp_city'))
                            <p class="help-block text-danger">{{ $errors->first('alcomp_city') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-5">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text"
                                class="form-control {{ $errors->has('alcomp_state') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter state here " name="alcomp_state"
                                value="{{old('alcomp_state', $company->alcomp_state)}}">
                            @if ($errors->has('alcomp_state'))
                            <p class="help-block text-danger">{{ $errors->first('alcomp_state') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-2">
                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text"
                                class="form-control allow-5digit {{ $errors->has('alcomp_zip') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Zip code here " name="alcomp_zip"
                                value="{{old('alcomp_zip', $company->alcomp_zip)}}">
                            @if ($errors->has('alcomp_zip'))
                            <p class="help-block text-danger">{{ $errors->first('alcomp_zip') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-5">
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text"
                                class="form-control {{ $errors->has('alcomp_website') ? 'btn-outline-danger' : '' }}"
                                placeholder="Enter Website Url here " name="alcomp_website"
                                value="{{old('alcomp_website', $company->alcomp_website)}}">
                            @if ($errors->has('alcomp_website'))
                            <p class="help-block text-danger">{{ $errors->first('alcomp_website') }}</p>
                            @endif
                        </div>
                        </div>
                      
                        
                        </div>
                     
                        <a href="{{route('admin_loancompanies_index')}}" class="btn btn-theme-black">Back</a>
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
