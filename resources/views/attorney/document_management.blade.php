<!-- [ Main Content ] start -->
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class=" attorney-listing">
			<div class="card-block px-0 py-0">
				<div class="short_div pb-1">
					<div class="search-field ">

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12">
		<div class="card-title-header">
			<div class="row ">
				<div class="col-sm-6 col-12 d-flex align-items-center">
					<h4 class="card-title pb-0 mb-0 bb-0-i ">
						<i class="bi bi-files-alt"></i> Documents
					</h4>
				</div>
				<div class="col-sm-6 col-12 d-flex align-items-center">
					<a href="#" class="btn font-weight-bold border-blue-big f-12 m-0 ml-auto float_right btn-new-ui-default btn-green" data-bs-toggle="modal" data-bs-target="#add_document">
						<i class="bi bi-plus-lg"></i>
						<span class=""> Add New Document Name</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 ">
		<div class="card mt-2 bg-transparent b-0-i">
			<div class="card-body card-body-padding">
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th>Document ID</th>
								<th>Name</th>
								<th></th>
								<th>Action</th>
							</tr>
							@if (!empty($documents) && count($documents) > 0)
								@php
									$is_associate = Helper::validate_key_value('is_associate', $associate_data);
									$associate_id = Helper::validate_key_value('associate_id', $associate_data);
								@endphp
								@foreach ($documents as $val)
									<tr class="unread row-{{ $val['id'] }}">
										<td><span>{{ $val['id'] }}</span></td>
										<td><span>{{ $val['document_name'] }}</span></td>
										<td><a href="javascript:void(0);"
												class="view_client_btn"
												data-bs-toggle="modal" onclick="edit_document(this, {{ $val['id'] }});"><i class="feather icon-edit"></i>&nbsp;{{ __('Edit Document') }}</a></td>
										<td class="align-center">
											<button 
												onclick='deleteDocument(
													"{{ $delete_route }}",
													{{ $val["id"] }},
													"{{ Helper::validate_doc_type($val["document_name"]) }}",
													"{{ $is_associate }}",
													"{{ $associate_id }}"
													)'
												type="button" data-id="{{ $delete_route }}" class="delete-div" title="Delete">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
													<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
													</path>
												</svg>
												Delete
											</button>
										</td>
									</tr>
								@endforeach
							@else
								<tr class="unread">
									<td colspan="6">{{ __('No Record Found.') }}</td>
								</tr>
							@endif
						</tbody>
					</table>
					<div class="d-flex justify-content-between align-items-center px-2 paginationb add-doc-pagination" id="the_table">
						@if ($documents->count())
						<div class="shoing">
							@if ($documents->count())
							Showing {{ $documents->firstItem() }} to {{ $documents->lastItem() }} of {{ $documents->total() }} entries
							@endif
						</div>
						<div>
							{{ $documents->links() }}
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<style>
	.add-btn a,
	.add-btn button {
		height: 41px;
	}

	.doc_selection {
		display: flex;
		float: right;

	}

	.mh-unset {
		min-height: unset !important;
	}

	.table th:nth-child(2),
	/* "Name" column */
	.table td:nth-child(2) {
		max-width: 60%;
		/* Adjust as needed */
		white-space: normal;
		/* Allow text to wrap */
		word-wrap: break-word;
		/* Break long words if necessary */
	}
</style>

<script>
	$(document).ready(function() {
		$('#document_selection').SumoSelect({
			placeholder: 'Select options to make active'
		});
	});

	function edit_document(obj, id) {
		var main_parent = $(obj).parents(".unread");
		var document_name = $(main_parent).find('td:eq(1)>span').text();
		console.log(document_name);
		$("#document_id").val(id);
		$("#document_name").val(document_name);

		$("#edit_document").modal('show');
	}
</script>
@include('modal.attorney.document_management.add', ['route' => route('attorney_document_mgt'), 'associate_data' => $associate_data, 'modelid' => 'add_document'])
@include('modal.attorney.document_management.edit', ['route' => route('attorney_document_edit'), 'associate_data' => $associate_data, 'modelid' => 'edit_document'])