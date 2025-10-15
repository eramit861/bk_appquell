@extends("layouts.admin")
@section('content')
@include("layouts.flash")

<?php
$trusteePopupRoute = route('list_trustee');
$divisionPopupRoute = route('list_divisions');
?>

<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card mb-0">
			<div class="card-header">
				<div class="search-list">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 pl-0">
								<h4>State Management</h4>
							</div>
							<div class="col-md-6">
								<div class="d-flex float_right">
									<div class="search-form">
										<form action="{{route('admin_state_index')}}" method="GET">
											<div class="input-group mb-0">
												<input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
												<button type="submit" class="nmp">
													<span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
												</button>
											</div>
										</form>
									</div>
									<div class="">
										<a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal" data-bs-target="#add_state">
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


		</div>
		<div class="card-block px-0 py-0">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>
								Name
							</th>
							<th>
								code
							</th>
							<th>
								Status
							</th>
							<th>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($states)) { ?>
							<?php foreach ($states as $val) { ?>
								<tr class="unread state-<?php echo $val['state_id']; ?>">
									<td><span>{{$val['state_name']}}</span></td>
									<td><span>{{$val['state_code']}}</span></td>
									<td>
										<span style="color: {{($val['state_status'] ==1) ? 'green' : 'red'}}">{{($val['state_status'] ==1) ? 'Active' : 'In-Active'}}</h6></span>
									</td>
									<td>
										<a href="javascript:void(0);" onclick="openSeperatePopup('<?php echo $val['state_code']; ?>', '<?php echo $trusteePopupRoute; ?>')" class="label theme-bg text-white f-12">Trustee</a>
										<a href="javascript:void(0);" onclick="openSeperatePopup('<?php echo $val['state_code']; ?>', '<?php echo $divisionPopupRoute; ?>')" class="label theme-bg text-white f-12">Divisions</a>
										<a href="{{route('admin_state_edit',['state_id'=>$val['state_id']])}}" class="label theme-bg text-white f-12">Edit</a>
										<a href="javascript:void(0)" onclick='deleteState("<?php echo route("admin_state_delete", $val['state_id']); ?>", "<?php echo $val['state_id'] ?>")' class="label theme-bg text-white f-12">Delete</a>
									</td>
								</tr>
						<?php }
							} ?>
					</tbody>
				</table>
			</div>
			<div class="pagination px-2">
				<?php if (!empty($states)) { ?>
					{{ $states->appends(['q' => $keyword])->links() }}
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!--[ Recent Users ] end-->

</div>
@if ($errors->any())
<script>
	$(document).ready(function() {
		$("#add_state").modal('show');
	});
</script>
@endif
<!-- Modal -->
<div id="add_state" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add State</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<form id="add_state_form" action="{{route('admin_state_create')}}" method="post" novalidate>
				@csrf
				<div class="modal-body">
					<div class="row ">
						<div class="col-sm-12">
							<div class="form-group">
								<input required type="text" value="{{ old('state_name') }}" class="form-control mb-4 {{ $errors->has('state_name') ? 'btn-outline-danger' : '' }}" placeholder="State Name " name="state_name">
							</div>
							@if ($errors->has('state_name'))
							<p class="help-block text-danger">{{ $errors->first('state_name') }}</p>
							@endif
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<input required type="text" value="{{ old('state_code') }}" class="form-control mb-4 {{ $errors->has('state_code') ? 'btn-outline-danger' : '' }}" placeholder="State Code " name="state_code">
							</div>
							@if ($errors->has('state_code'))
							<p class="help-block text-danger">{{ $errors->first('state_code') }}</p>
							@endif
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<select required class="form-control" id="state_status" name="state_status" value="{{ old('state_status') }}">
									<option value="">State Status</option>
									<option value="1">Active</option>
									<option value="0">In-Active</option>
								</select>
							</div>
							@if ($errors->has('state_status'))
							<p class="help-block text-danger">{{ $errors->first('state_status') }}</p>
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

			#facebox .content.fbminwidth {
				min-width: 550px;
				min-height: 400px;
			}
		</style>
		<script>
			$(document).ready(function() {

				$("#add_state_form").validate({

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

			openSeperatePopup = function(state_code, ajaxurl) {
				laws.ajax(ajaxurl, {
					state_code: state_code
				}, function(response) {
					laws.updateFaceboxContent(response, 'large-fb-width bg-unset');
				});
			}
		</script>

	</div>
</div>
<!-- [ Main Content ] end -->
@endsection