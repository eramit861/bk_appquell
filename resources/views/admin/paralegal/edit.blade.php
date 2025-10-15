@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header pl-3">
				<h4>Paralegal Details</h4>
			</div>
			<div class="card-block">				
				<form action="{{route('admin_paralegal_edit',['id'=>$User['id']])}}" method="post" novalidate>
				@csrf	
				<div class="container ">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control {{ $errors->has('name') ? 'btn-outline-danger' : '' }}" placeholder="Name " name="name" value="<?php echo (!empty($User['name'])) ? $User['name'] : "";?>">
					@if ($errors->has('name'))
						<p class="help-block text-danger">{{ $errors->first('name') }}</p>
					@endif
					</div>
					<div class="form-group">
						<label>Email</label>
						<input readonly type="text" class="form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email " name="email" value="<?php echo (!empty($User['email'])) ? $User['email'] : "";?>">
					@if ($errors->has('email'))
						<p class="help-block text-danger">{{ $errors->first('email') }}</p>
					@endif
					</div>
					<div class="form-group">
						<label>Phone No</label>
						<input type="text" class="form-control {{ $errors->has('phone_no') ? 'btn-outline-danger' : '' }}" placeholder="Phone No " name="phone_no" value="<?php echo (!empty($User['phone_no'])) ? $User['phone_no'] : "";?>">
					@if ($errors->has('phone_no'))
						<p class="help-block text-danger">{{ $errors->first('phone_no') }}</p>
					@endif
					</div>
					<?php //dump($payment_settings->discount_percentage);?>					
					
					<a href="{{route('admin_paralegal_list')}}" class="btn btn-theme-black">Back</a>
					<button type="submit" class="btn btn-theme-black">Submit</button>
				</div>			
				</form>							
			</div>
		</div>
	</div>
	<!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection