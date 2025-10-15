@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card mb-0">
			<div class="card-header">
				<div class="search-list">
					<div class="col-md-12">
						<form action="{{route('admin_fips_index')}}" method="GET">
							<div class="row">
								<div class="col-md-4 pl-0">
									<h4>County FIPS Management</h4>
								</div>
								<div class="col-md-8">
									<div class="d-flex float_right">
										<div class="">
											<div class="input-group mb-0 width_fit_content">
												<?php if (!empty($stateList)) { ?>
													<select onchange="this.form.submit()" class="form-control" name="state_id">
														<?php foreach ($stateList as $val) { ?>
															<option <?php if ($val->state_id == $stateId) {
															    echo "selected";
															} ?> value="{{$val->state_id}}" >{{$val->state_name}}</option>
														<?php } ?>
													</select>
												<?php } ?>
											</div>
										</div>
										<div class="">
											<div class="input-group mb-0 ml-3">
												<input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
												<button type="submit" class="nmp">
													<span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
												</button>
											</div>
										</div>
										
										<div class="">
											<a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal" data-bs-target="#add_county_fips"><i class="feather icon-plus"></i> <span class="card-title-text">Add</span></a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-xl-12 col-md-12">
		<div class="card-block px-0 py-0">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>
								State Name
							</th>
							<th>
								County Name
							</th>
							<th>
								FIPS Code
							</th>
							<th>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<input type="hidden" value="" id="stateId">
						<?php if (!empty($countyFipsData)) { ?>
							<?php foreach ($countyFipsData as $val) { ?>
								<tr class="unread state-<?php echo $val['id']; ?>">
									<td><span>{{$val['state_name']}}</span></td>
									<td><span>{{$val['county_name']}}</span></td>
									<td><span>{{$val['fips_code']}}</h6></span></td>
									<td>
										<a href="{{route('admin_fips_edit',['id'=>$val['id']])}}" class="label theme-bg text-white f-12">Edit</a>
										<a href="javascript:void(0)" onclick='deleteCountyFIPS("<?php echo route("admin_fips_delete", $val["id"]); ?>", "<?php echo $val["id"] ?>")' class="label theme-bg text-white f-12">Delete</a>
									</td>
								</tr>
						<?php }
							} ?>
					</tbody>
				</table>
			</div>
			<div class="pagination px-2">
				<?php if (!empty($countyFipsData)) { ?>
					{{ $countyFipsData->appends(['q' => $keyword,'state_id' => $stateId])->links() }}
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!--[ Recent Users ] end-->


@if ($errors->any())
<script>
	$(document).ready(function() {
		$("#add_county_fips").modal('show');
	});
</script>
@endif
<!-- Modal -->
<div id="add_county_fips" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add County FIPS</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<form id="add_county_fips_form" action="{{route('admin_fips_create')}}" method="post" novalidate>
				@csrf
				<div class="modal-body">
					<div class="row ">
						<div class="col-sm-12">
							<div class="form-group">
								<select class="form-control" name="state_name">
									<?php foreach ($stateList as $val) { ?>
										<option <?php if ($val->state_id == $stateId) {
										    echo "selected";
										} ?> value="{{$val->state_id}}" >{{$val->state_name}}</option>
									<?php } ?>
								</select>
							</div>
							@if ($errors->has('state_name'))
							<p class="help-block text-danger">{{ $errors->first('state_name') }}</p>
							@endif
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<input required type="text" value="{{ old('county_name') }}" class="form-control mb-4 {{ $errors->has('county_name') ? 'btn-outline-danger' : '' }}" placeholder="County Name" name="county_name">
							</div>
							@if ($errors->has('county_name'))
							<p class="help-block text-danger">{{ $errors->first('county_name') }}</p>
							@endif
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<input required type="text" value="{{ old('fips_code') }}" class="form-control mb-4 {{ $errors->has('fips_code') ? 'btn-outline-danger' : '' }}" placeholder="FIPS Code " name="fips_code">
							</div>
							@if ($errors->has('fips_code'))
							<p class="help-block text-danger">{{ $errors->first('fips_code') }}</p>
							@endif
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-theme-black">Submit</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
			</form>
		</div>

		<style>
			label.error {
				color: red;
				font-style: italic;
			}
		</style>
		<script>
			$(document).ready(function() {

				$("#add_county_fips_form").validate({

					errorPlacement: function(error, element) {
						if ($(element).parents(".form-group").next('label').hasClass('error')) {

							$(element).parents(".form-group").next('label').remove();
							$(element).parents(".form-group").after($(error)[0].outerHTML);
						} else {

							$(element).parents(".form-group").after($(error)[0].outerHTML);
						}
					},
					success: function(label, element) {
						label.parent().removeClass('error');

						$(element).parents(".form-group").next('label').remove();
					},
				});
			});

			stateSelected = function(stateId, stateName) {
				document.getElementById('stateId').value = stateId;
				document.getElementById('stateName').value = stateName;
			}
		</script>

	</div>
</div>
<!-- [ Main Content ] end -->
@endsection