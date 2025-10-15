@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header">
				<div class="add-btn">
					<div class="search-list">
						<div class="pcoded-header">
							<div class="main-search open">
								<div class="input-group">
									<input type="text" class="form-control"
										placeholder="{{ __('Search . . .') }}">
									<span
										class="input-group-append search-btn btn font-weight-bold border-blue-big">
										<i class="feather icon-search input-group-text"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<a href="#" class="btn font-weight-bold border-blue-big f-12" data-bs-toggle="modal"
						data-bs-target="#add_attorney"><i class="feather icon-plus"></i> <span
							class="card-title-text">Add</span></a>
				</div>
			</div>
			<div class="card-block px-0 py-0">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>
									{{ __('Name') }}
								</th>
								<th>
									{{ __('Email') }}
								</th>
								<th>
									{{ __('Antorney') }}
								</th>
								<th>
									{{ __('Action') }}
								</th>
							</tr>
						</thead>
						<tbody>
						<?php if (!empty($client) && count($client) > 0) {?>
						<?php foreach ($client as $val) {?>
							<tr class="unread">
								<td><span>{{$val['name']}}</span></td>
								<td><span>{{$val['email']}}</span></td>
								<td>
									<span>{{$val['attorney_name']}}</h6></span>
								</td>
								<td><a href="{{route('admin_client_view',['id'=>$val['id']])}}" class="btn font-weight-bold border-blue-big f-12">{{ __('View') }}</a>
									<a href="{{route('admin_client_edit',['id'=>$val['id']])}}" class="label theme-bg text-white f-12">{{ __('Edit') }}</a>
								</td>
							</tr>
						<?php }
						} else {?>
						<tr class="unread">
							<td colspan="4">{{ __('No Record Found.') }}</td>
						</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
					<?php if (!empty($client) && count($client) > 0) {?>
					{{ $client->links() }}
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
	$("#add_attorney").modal('show');
});
</script>
@endif
    <!-- Modal -->
<div id="add_attorney" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{ __('Add Client') }}</h4>
				<button type="button" class="close" data-bs-dismiss="modal">{{ __('&times;') }}</button>
			</div>
			<form action="{{route('admin_client_add')}}" method="post" novalidate>
			@csrf
			<div class="modal-body">
				<div class="row ">
					<div class="col-sm-12">
						<input type="text" class="form-control mb-4 {{ $errors->has('name') ? 'btn-outline-danger' : '' }}" placeholder="{{ __('Name') }} " name="name">
					@if ($errors->has('name'))
						<p class="help-block text-danger">{{ $errors->first('name') }}</p>
					@endif
					</div>
					<div class="col-sm-12">
						<input type="text" class="form-control mb-4 {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="{{ __('Email') }} " name="email">
					@if ($errors->has('email'))
						<p class="help-block text-danger">{{ $errors->first('email') }}</p>
					@endif
					</div>
					<div class="col-sm-12">
						<div class="choose-file">
							<div class="form-group">
								<select class="form-control" id="client_attorney" name="client_attorney">
									<option value="">{{ __('Choose Attorney') }}</option>
									<?php if (!empty($attorney)) {?>
									<?php foreach ($attorney as $val) {?>
									<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
									<?php }
									}?>
								</select>
							</div>
						</div>
						@if ($errors->has('client_attorney'))
							<p class="help-block text-danger">{{ $errors->first('client_attorney') }}</p>
						@endif
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn font-weight-bold border-blue-big" >{{ __('Submit') }}</button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Close') }}</button>
			</div>
			</form>
		</div>

	</div>
</div>
<!-- [ Main Content ] end -->
@endsection