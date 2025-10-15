@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card ">
		

			<div class="card-header">
            <div class="search-list">
               <div class="col-md-12">
                  <div class="row">
						<div class="col-md-6 pl-0">
							<h4>Paralegal Management</h4>
						</div>
                        <div class="col-md-6 text-right">
							<div class="d-flex float_right">
								<div class="search-form">
									<form action="{{route('admin_paralegal_list')}}" method="GET">
										<div class="input-group mb-0">
											<input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
											<button type="submit" class="nmp">
											<span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
											</button>
										</div>
									</form>
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
									Email
								</th>
								<th>
                                    Phone
								</th>
								<th>
                                    Attorney Name
								</th>
								<th>
									Created at
								</th>


								<th>
									Action
								</th>
							</tr>
						</thead>
						<tbody>
						<?php if (!empty($attorney)) {?>
						<?php foreach ($attorney as $val) {
						    ?>

							<tr class="unread attorney-<?php echo $val['id']; ?>">
								<td><span>{{$val['name']}}</span></td>
								<td><span>{{$val['email']}}</span></td>
								<td>
									<span>{{$val['phone_no']}}</h6></span>
								</td>
								<td>
									<span>{{$val['parent_attorney']}}</h6></span>
								</td>
								<td>
									 {{DateTimeHelper::dbDateToDisplay($val['created_at'],true)}}</h6></span>
								</td>


								<td>
									<div class="">
										<!-- login btn -->
										<a class="green link-unerline" href="<?php echo route("admin_attorney_login", ['id' => $val["id"]]); ?>">Login as Paralegal  <i class="fas fa-sign-in-alt fa-lg"  title="Login into your paralegal dashboard"></i></a>
										<!-- view btn -->
										<!-- edit btn -->
										<a href="{{route('admin_paralegal_edit',['id'=>$val['id']])}}" class="label theme-bg text-white f-12">Edit</a>
										<!-- delete btn -->
										<a href="javascript:void(0)"  onclick='deleteAttorney("<?php echo route("admin_attorney_delete"); ?>",<?php echo $val["id"]?>,"<?php echo $val["name"]; ?>")' class="label theme-bg text-white f-12">Delete</a>
										<!-- mark demo btn -->
										
									</div>
									
                                   
								</td>
							</tr>
						<?php }
						}?>
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
					<?php if (!empty($attorney)) {?>
					{{ $attorney->appends(['q' => $keyword])->links() }}
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
				<h4 class="modal-title">Add Attorney</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>
			<form id="add_attorny_form" name="add_attorny_form" action="{{route('admin_attorney_add')}}" method="post" novalidate>
			@csrf
			<div class="modal-body">
				<div class="row ">
					<div class="col-sm-12">
					<div class="form-group">
						<input required type="text" class="form-control mb-4 {{ $errors->has('name') ? 'btn-outline-danger' : '' }}" placeholder="Name " name="name" value="{{ old('name') }}">
</div>
						@if ($errors->has('name'))
						<p class="help-block text-danger">{{ $errors->first('name') }}</p>
					@endif
					</div>
					<div class="col-sm-12">
					<div class="form-group">
						<input required type="text" class="form-control mb-4 {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email " name="email" value="{{ old('email') }}">
</div>
						@if ($errors->has('email'))
						<p class="help-block text-danger">{{ $errors->first('email') }}</p>
					@endif
					</div>
					<div class="col-sm-12">
					<div class="form-group">
						<input required  type="text" class="form-control mb-4 {{ $errors->has('company') ? 'btn-outline-danger' : '' }}" placeholder="Company Name " name="company" value="{{ old('company') }}">
</div>
						@if ($errors->has('company'))
						<p class="help-block text-danger">{{ $errors->first('company') }}</p>
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

	</div>
</div>


<style>
label.error {
    color: red;
    font-style: italic;
}
</style>
<script>
	$(document).ready(function(){

		$("#add_attorny_form").validate({

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

		confirmdemo = function(demo, url){
			if(demo==1){
				if (!confirm('Are you sure you want to remove this attorney from demo list?')) {
      			return;
				}
				window.location.href = url;

			}
			if(demo==0){
				if (!confirm('Are you sure you want to add this attorney in demo attorney list?')) {
      			return;
				}
				window.location.href = url;
			}
		}

		generateUrl = function(link_url,attorney_id,linkFor=''){
			var ajaxurl = "<?php echo route("generate.shorten.link.post"); ?>";
			laws.ajax(ajaxurl, { attorney_id:attorney_id,link: link_url, link_for:linkFor }, function (response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
			} else {
				navigator.clipboard.writeText(res.url);
				prompt("Please Copy Below Url:",res.url);
			}
			});
		}
		enableFree = function(ajax_url,attorney_id,status){
			laws.ajax(ajax_url, { attorney_id:attorney_id,status:status}, function (response) {
			var res = JSON.parse(response);
			if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
			} else {
				$.systemMessage(res.msg, 'alert--success', true);
				setTimeout(function() {
                  window.location.href = '<?php echo route('admin_paralegal_list'); ?>';
               }, 1000);
			}
			});
		}

		updateInviteDocSelectionStatus = function( attorney_id, status_to_update){
			var ajax_url = "<?php echo route('update_invite_doc_selection_status'); ?>";
			laws.ajax(ajax_url, { attorney_id:attorney_id,status:status_to_update}, function (response) {
				var res = JSON.parse(response);
				if (res.status == 0) {
					$.systemMessage(res.msg, 'alert--danger', true);
				} else {
					$.systemMessage(res.msg, 'alert--success', true);
					setTimeout(function() {
						window.location.href = '<?php echo route('admin_paralegal_list'); ?>';
					}, 1000);
				}
			});
		}



</script>

<!-- [ Main Content ] end -->
@endsection
