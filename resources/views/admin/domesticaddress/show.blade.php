@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header ">
				<div class="search-list row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-5">
								<h4>Domestic Address Managmanet</h4>
							</div>
							<div class="col-md-7">
								<div class="d-flex float_right">
									<div class="search-form">
										<form action="{{route('admin_domestic_index')}}" method="GET">
											<div class="input-group mb-0">
												<input type="text" name="q" class="form-control" value="{{@$keyword}}" placeholder="Search . . .">
												<button type="submit" class="nmp">
												<span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
												</button>
											</div>
										</form>
									</div>
									<div class="">
										<a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal" data-bs-target="#add_domestic">
											<i class="feather icon-plus"></i>
											<span class="card-title-text">Add</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="card-block px-0 py-0">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Address line 1</th>
								<th>Address line 2</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

						<?php if (!empty($addresses)) {?>
						<?php foreach ($addresses as $val) {?>
							<tr class="unread row-<?php echo $val['id']; ?>">
								<td><span>{{$val['address_name']}}</span></td>
								<td><span>{{$val['address_street']}}</span></td>
								<td><span>{{$val['address_line2']}}</span></td>
								<td><span>{{$val['address_city']}}</span></td>
								<td><span>{{$val['address_state']}}</span></td>
								<td><span>{{$val['address_zip']}}</span></td>
								<td>
									<a href="{{route('admin_domestic_edit',['id'=>$val['id']])}}" class="label theme-bg text-white f-12">Edit</a>
									<a href="javascript:void(0)"  onclick='deleteDomestic("<?php echo route("admin_domestic_delete", $val["id"]); ?>", "<?php echo $val["id"] ?>")'>
										<i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i>
									</a>
								</td>
							</tr>
						<?php }
						}?>
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
					<?php if (!empty($addresses)) {?>
						{{ $addresses->appends(['q' => $keyword])->links() }}
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<!--[ Recent Users ] end-->

</div>
@if ($errors->any())
<script>
$(document).ready(function(){
	$("#add_domestic").modal('show');
});
</script>
@endif
    <!-- Modal -->
<div id="add_domestic" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Domestic</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<form id="add_domestic_address" action="{{route('admin_domestic_create')}}" method="post" novalidate>
			@csrf
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-6">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<h5>Domestic Address</h5>								
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('address_name') ? 'btn-outline-danger' : '' }}" placeholder="Enter Name " name="address_name" value="{{ old('address_name') }}" required>
								</div>
								@if ($errors->has('address_name'))
									<p class="help-block text-danger">{{ $errors->first('address_name') }}</p>
								@endif
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('address_street') ? 'btn-outline-danger' : '' }}" placeholder="Address Line 1" name="address_street" value="{{ old('address_street') }}" required>
								</div>
								@if ($errors->has('address_street'))
									<p class="help-block text-danger">{{ $errors->first('address_street') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('address_line2') ? 'btn-outline-danger' : '' }}" placeholder="Address Line 2" name="address_line2" value="{{ old('address_line2') }}">
								</div>
								@if ($errors->has('address_line2'))
									<p class="help-block text-danger">{{ $errors->first('address_line2') }}</p>
								@endif
							</div>


							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('address_city') ? 'btn-outline-danger' : '' }}" placeholder="City" name="address_city" value="{{ old('address_city') }}" required>
								</div>
								@if ($errors->has('address_city'))
									<p class="help-block text-danger">{{ $errors->first('address_city') }}</p>
								@endif
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<select class="form-control mb-4" id="address_state" name="address_state" required>
										<option value="">Select State</option>
										<?php echo AddressHelper::getStatesList(old('address_state')); ?>
									</select>
								</div>
							@if ($errors->has('address_state'))
								<p class="help-block text-danger">{{ $errors->first('address_state') }}</p>
							@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control allow-5digit mb-4 {{ $errors->has('address_zip') ? 'btn-outline-danger' : '' }}" placeholder="Zip" name="address_zip" value="{{ old('address_zip') }}" required>
								</div>
								@if ($errors->has('address_zip'))
									<p class="help-block text-danger">{{ $errors->first('address_zip') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control phone-field mb-4 {{ $errors->has('address_phone') ? 'btn-outline-danger' : '' }}" placeholder="Phone" name="address_phone" value="{{ old('address_phone') }}">
								</div>
								@if ($errors->has('address_phone'))
									<p class="help-block text-danger">{{ $errors->first('address_phone') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control phone-field mb-4 {{ $errors->has('address_fax') ? 'btn-outline-danger' : '' }}" placeholder="Fax" name="address_fax" value="{{ old('address_fax') }}">
								</div>
								@if ($errors->has('address_fax'))
									<p class="help-block text-danger">{{ $errors->first('address_fax') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="email" class="form-control mb-4 {{ $errors->has('address_email') ? 'btn-outline-danger' : '' }}" placeholder="Email" name="address_email" value="{{ old('address_email') }}">
								</div>
								@if ($errors->has('address_email'))
									<p class="help-block text-danger">{{ $errors->first('address_email') }}</p>
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<h5>BK Service Address</h5>								
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('notify_address_name') ? 'btn-outline-danger' : '' }}" placeholder="Enter Name " name="notify_address_name" value="{{ old('notify_address_name') }}" required>
								</div>
								@if ($errors->has('notify_address_name'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_name') }}</p>
								@endif
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('notify_address_street') ? 'btn-outline-danger' : '' }}" placeholder="Address Line 1" name="notify_address_street" value="{{ old('notify_address_street') }}" required>
								</div>
								@if ($errors->has('notify_address_street'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_street') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('notify_address_line2') ? 'btn-outline-danger' : '' }}" placeholder="Address Line 2" name="notify_address_line2" value="{{ old('notify_address_line2') }}">
								</div>
								@if ($errors->has('notify_address_line2'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_line2') }}</p>
								@endif
							</div>


							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control mb-4 {{ $errors->has('notify_address_city') ? 'btn-outline-danger' : '' }}" placeholder="City" name="notify_address_city" value="{{ old('notify_address_city') }}" required>
								</div>
								@if ($errors->has('notify_address_city'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_city') }}</p>
								@endif
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control allow-5digit mb-4 {{ $errors->has('notify_address_zip') ? 'btn-outline-danger' : '' }}" placeholder="Zip" name="notify_address_zip" value="{{ old('notify_address_zip') }}" required>
								</div>
								@if ($errors->has('notify_address_zip'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_zip') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control phone-field mb-4 {{ $errors->has('notify_address_phone') ? 'btn-outline-danger' : '' }}" placeholder="Phone" name="notify_address_phone" value="{{ old('notify_address_phone') }}">
								</div>
								@if ($errors->has('notify_address_phone'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_phone') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="text" class="form-control phone-field mb-4 {{ $errors->has('notify_address_fax') ? 'btn-outline-danger' : '' }}" placeholder="Fax" name="notify_address_fax" value="{{ old('notify_address_fax') }}">
								</div>
								@if ($errors->has('notify_address_fax'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_fax') }}</p>
								@endif
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="email" class="form-control mb-4 {{ $errors->has('notify_address_email') ? 'btn-outline-danger' : '' }}" placeholder="Email" name="notify_address_email" value="{{ old('notify_address_email') }}">
								</div>
								@if ($errors->has('notify_address_email'))
									<p class="help-block text-danger">{{ $errors->first('notify_address_email') }}</p>
								@endif
							</div>
						</div>
					</div>
					

				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-theme-black">Submit</button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
			</div>
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
			</form>
		</div>

		<style>
		label.error {
			color: red;
			font-style: italic;
		}
		.modal-dialog {
			max-width: 750px;
			margin: 1.75rem auto;
		}
		</style>
		<script>
			$(document).ready(function(){

				$("#add_domestic_address").validate({

					errorPlacement: function (error, element) {
						if($(element).parents(".form-group").next('label').hasClass('error')){

							$(element).parents(".form-group").next('label').remove();
							$(element).parents(".form-group").after($(error)[0].outerHTML);
						}else{

							$(element).parents(".form-group").after($(error)[0].outerHTML);
						}
					},
					success: function(label,element) {
						label.parent().removeClass('error');

						$(element).parents(".form-group").next('label').remove();
					},
				});
				});
		</script>

	</div>
</div>
<!-- [ Main Content ] end -->
@endsection
