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
								<h4>Common Notes Category Management</h4>
							</div>
							<div class="col-md-7">
								<div class="d-flex float_right">
									<div class="search-form">
										<form action="{{route('admin_common_notes_category_index')}}" method="GET">
											<div class="input-group mb-0">
												<input type="text" name="q" class="form-control" value="{{@$keyword}}" placeholder="Search . . .">
												<button type="submit" class="nmp">
												<span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
												</button>
											</div>
										</form>
									</div>
									<div class="">
										<a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal" data-bs-target="#add_note_category">
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
								<!-- <th>S.No</th> -->
								<th class="w-90">Note Category</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

						<?php if (!empty($notes)) {
						    $i = 1;?>
						<?php foreach ($notes as $val) {?>
							<tr class="unread row-<?php echo $val['id']; ?>">
								<!-- <td><span>{{$i}}</span></td> -->
								<td>
									<span class="span_category_{{$val['id']}}">{{$val['category']}}</span>
									<input type="text" name="note_category_{{$val['id']}}" class="input_category_{{$val['id']}} form-control hide-data" value="{{$val['category']}}">
								</td>
								<td>
									<a href="javascript:void(0)" class="edit_category_{{$val['id']}}">
										<i onclick="edit_category('<?php echo $val['id'];?>')" class="fas text-c-blue fa-pencil-square-o mr-2 edit  pt-1"></i>
									</a>
									<a href="javascript:void(0)" class="edit_category_submit_{{$val['id']}} hide-data">
										<i onclick="update_category('<?php echo $val['id'];?>', '<?php echo $val['category'];?>')" class="fas fa-check mr-2 submit "></i>
									</a>
									<a href="javascript:void(0)"  onclick='delete_category("<?php echo $val["id"] ?>")'>
										<i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i>
									</a>
								</td>
							</tr>
						<?php $i++;
						}
						}?>
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
					<?php if (!empty($notes)) {?>
						{{ $notes->appends(['q' => $keyword])->links() }}
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
	$("#add_note_category").modal('show');
});
</script>
@endif
    <!-- Modal -->
<div id="add_note_category" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Note Category</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<form id="add_note_category_form" action="{{route('admin_common_notes_category_create')}}" method="post" novalidate>
			@csrf
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-12">
						<div class="form-group mb-0">
							<input type="text" class="form-control  {{ $errors->has('note_category') ? 'btn-outline-danger' : '' }}" placeholder="Enter Note Category " name="note_category" value="{{ old('note_category') }}" required>
						</div>
						@if ($errors->has('note_category'))
							<p class="help-block text-danger">{{ $errors->first('note_category') }}</p>
						@endif
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

				$("#add_note_category_form").validate({

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
			edit_category = function(id){
				$(".span_category_"+id).addClass('hide-data');
				$(".input_category_"+id).removeClass('hide-data');
				$(".edit_category_"+id).addClass('hide-data');
				$(".edit_category_submit_"+id).removeClass('hide-data');
			}

			update_category = function(id, prev_category){
				var url = "<?php echo route('admin_common_notes_category_update'); ?>";
				var updated_category = $(".input_category_"+id).val();
				if( prev_category == updated_category){
					updateInputClasses(id);
					return;
				}
				if (!confirm("Do you want to update note category?")) {
					return;
				}
				
				laws.ajax(url, {id:id, updated_category: updated_category}, function(res) { 
					var ans = $.parseJSON(res);
					if (ans.status == 1) {
						$.systemMessage(ans.msg, 'alert--success', true);
						$(".span_category_"+id).html(updated_category);
						updateInputClasses(id);
					} else {
						$.systemMessage(ans.msg, 'alert--danger', true);
					}
				});
			}
			
			delete_category = function(id){
				var url = "<?php echo route('admin_common_notes_category_delete'); ?>";
				if (!confirm("Do you want to delete this note category?")) {
					return;
				}
				laws.ajax(url, {id:id}, function(res) { 
					var ans = $.parseJSON(res);
					if (ans.status == 1) {
						$.systemMessage(ans.msg, 'alert--success', true);
						$('.row-'+id).remove();
					} else {
						$.systemMessage(ans.msg, 'alert--danger', true);
					}
				});
			}

			updateInputClasses = function(id){
				$(".span_category_"+id).removeClass('hide-data');
				$(".input_category_"+id).addClass('hide-data');
				$(".edit_category_"+id).removeClass('hide-data');
				$(".edit_category_submit_"+id).addClass('hide-data');
			}
		</script>

	</div>
</div>
<!-- [ Main Content ] end -->
@endsection
