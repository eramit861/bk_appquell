  
 	<label for="">{{ $label }}</label>
  	<input name="{{ $name }}" type="{{$type}}" id="{{@$id}}" value="{{ $value }}" class="form-control {{$inputClass ?? ''}}" placeholder="{{ $placeholder ?? '' }}" {{$require ?? ''}} >

