@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <!--[ Recent Users ] start-->
    <div class="col-xl-12 col-md-12">
        <div class="card listing-card">
            <div class="card-header">
            <div class="col-md-12">
            <div class="row">
                 <h4>Creditor Matrix Settings </h4>
            </div>
            </div>
            </div>
            <div class="card-block px-0 py-0">
                <form id="add_form" action="{{route('district_crediter_setting_store')}}" method="post">
                    @csrf
                    <div class="container">
                    <div class="row">
                            <div class="col-md-6">
                        <div class="form-group district_group">
                            <label>District</label>
							<select value="{{ old('destrict_id') }}" name="destrict_id" class="assign-forms form-control">
                                @foreach($district_names as $key => $district)
									<option value="{{$district->id}}">{{$district->district_name}}</option>
								@endforeach
                            </select>
                            @if ($errors->has('destrict_id'))
                            <p class="help-block text-danger">{{ $errors->first('destrict_id') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Text Content</label>
                            <select required value="{{ old('text_content_field') }}" name="text_content_field" class="assign-forms form-control">
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                            </select>
                            @if ($errors->has('text_content_field'))
                            <p class="help-block text-danger">{{ $errors->first('text_content_field') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Text Align</label>
                            <select required value="{{ old('text_align_field') }}" name="text_align_field" class="assign-forms form-control">
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                            </select>
                            @if ($errors->has('text_align_field'))
                                <p class="help-block text-danger">{{ $errors->first('text_align_field') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Line Spacing</label>
                            <select required value="{{ old('text_spacing') }}" name="text_spacing" class="assign-forms form-control">
                           <?php  echo ArrayHelper::getTextSpacingSelection(); ?>
                            </select>
                            @if ($errors->has('text_spacing'))
                                <p class="help-block text-danger">{{ $errors->first('text_spacing') }}</p>
                            @endif
                        </div>

                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Font Size</label>
                            <select required value="{{ old('font_size') }}" name="font_size" class="assign-forms form-control">
                           <?php  echo ArrayHelper::getFontSizeSelection(); ?>
                            </select>
                            @if ($errors->has('font_size'))
                                <p class="help-block text-danger">{{ $errors->first('font_size') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Font Style</label>
                            <select required value="{{ old('text_capitalize') }}" name="text_capitalize" class="assign-forms form-control">
                           <?php  echo ArrayHelper::getFontStyleSelection(); ?>
                            </select>
                            @if ($errors->has('text_capitalize'))
                                <p class="help-block text-danger">{{ $errors->first('text_capitalize') }}</p>
                            @endif
                        </div>
                        </div>
                        </div>

                        <a href="{{route('district_crediter_setting_index')}}" class="btn btn-theme-black">Back</a>
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                        <br><br>
                    </div>
                </form>
            </div>
            <style>
            </style>
            <script>
                $(document).ready(function(){
                    
                   
                });
            </script>
        </div>
    </div>
    <!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection
