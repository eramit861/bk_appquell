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
						<h3>Client document status</h3>
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
								Client Name
							</th>
							<th>
								File Path
							</th>
							<th>
								Updated name
							</th>
							<th>
								Is uploaded to S3
							</th>
                            <th>
								Date
							</th>
                            <th>
								S3 URL
							</th>
						</tr>
					</thead>
					<tbody>
						<input type="hidden" value="" id="stateId">
						<?php if (!empty($list)) { ?>
							<?php foreach ($list as $val) { ?>
								<tr class="unread state-<?php echo $val['id']; ?>">
									<td><span>{{$val['name']}}</span></td>
									<td><span>{{$val['document_file']}}</span></td>
									<td><span>{{$val['updated_name']}}</h6></span></td>
                                    <td><span>{{$val['is_uploaded_to_s3']}}</h6></span></td>
                                    <td><span><?php echo DateTimeHelper::dbDateToDisplay($val['created_on'], true, true); ?></h6></span></td>
                                    <td><span>{{$val['file_s3_url']}}</h6></span></td>
								</tr>
						<?php }
							} ?>
					</tbody>
				</table>
			</div>
			<div class="pagination px-2">
				<?php if (!empty($list)) { ?>
					{{ $list->links() }}
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!--[ Recent Users ] end-->
@endsection