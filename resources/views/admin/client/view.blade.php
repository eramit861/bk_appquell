@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header pl-3">
				<h4>Client Details</h4>
			</div>
			<div class="card-block">
				<div class="container ">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control {{ $errors->has('name') ? 'btn-outline-danger' : '' }}" placeholder="Name " name="name" value="<?php echo (!empty($User['name'])) ? $User['name'] : "";?>" readonly>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email " name="email" value="<?php echo (!empty($User['email'])) ? $User['email'] : "";?>" readonly>
					</div>

					<div class="form-group">
						<label>Antorney Name</label>
						<input type="text" class="form-control {{ $errors->has('company') ? 'btn-outline-danger' : '' }}" placeholder="Company Name " name="company" value="<?php echo (!empty($User->ClientsAttorneybyclient->getuserattorney->name)) ? $User->ClientsAttorneybyclient->getuserattorney->name : "";?>" readonly>
					</div>
					<a href="{{route('admin_client_list')}}" class="btn btn-theme-black">Back</a>
				</div>
			</div>
		</div>
	</div>
	<!--[ Recent Users ] end-->
</div>

<!-- [ Main Content ] end -->
@endsection
