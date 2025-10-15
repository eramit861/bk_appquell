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
            <h4>Creditor Matrix Settings - {{$setting->district->district_name}}</h4>
            </div>
            </div>
            </div>
            <div class="card-block">
                <form action="{{route('district_crediter_setting_update',$setting->id)}}" method="post">
                    @csrf
                    <div class="container">
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group custom_select">
                                    <label>Text Content</label>
                                    <select required value="{{ old('text_content_field') }}" name="text_content_field" class="assign-forms form-control">
                                        <option value="left" {{('left' == $setting->text_content_field ? 'selected' : '')}}>Left</option>
                                        <option value="center" {{('center' == $setting->text_content_field ? 'selected' : '')}}>Center</option>
                                        <option value="right" {{('right' == $setting->text_content_field ? 'selected' : '')}}>Right</option>
                                    </select>
                                    @if ($errors->has('text_content_field'))
                                    <p class="help-block text-danger">{{ $errors->first('text_content_field') }}</p>
                                    @endif
                                </div>
                            </div>
                    <div class="col-md-6">
                        <div class="form-group custom_select">
                            <label>Text Align</label>
                            <select required value="{{ old('text_align_field') }}" name="text_align_field" class="assign-forms form-control">
                                <option value="left" {{('left' == $setting->text_align_field ? 'selected' : '')}}>Left</option>
                                <option value="center" {{('center' == $setting->text_align_field ? 'selected' : '')}}>Center</option>
                                <option value="right" {{('right' == $setting->text_align_field ? 'selected' : '')}}>Right</option>
                            </select>
                            @if ($errors->has('text_align_field'))
                                <p class="help-block text-danger">{{ $errors->first('text_align_field') }}</p>
                            @endif
                        </div>
                    </div>
                   
                        <div class="col-md-6">
                        <div class="form-group custom_select">
                            <label>Line Spacing</label>
                            <select required value="{{ old('text_spacing') }}" name="text_spacing" class="assign-forms form-control">
                           <?php  echo ArrayHelper::getTextSpacingSelection($setting->text_spacing); ?>
                            </select>
                            @if ($errors->has('text_spacing'))
                                <p class="help-block text-danger">{{ $errors->first('text_spacing') }}</p>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group custom_select">
                            <label>Font Size</label>
                            <select required value="{{ old('font_size') }}" name="font_size" class="assign-forms form-control">
                           <?php  echo ArrayHelper::getFontSizeSelection($setting->font_size); ?>
                            </select>
                            @if ($errors->has('font_size'))
                                <p class="help-block text-danger">{{ $errors->first('font_size') }}</p>
                            @endif
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group custom_select">
                            <label>Font Style</label>
                            <select required value="{{ old('text_capitalize') }}" name="text_capitalize" class="assign-forms form-control">
                           <?php  echo ArrayHelper::getFontStyleSelection($setting->text_capitalize); ?>
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
