@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
   <!--[ Recent Users ] start-->
   <div class="col-xl-12 col-md-12">
      <div class="card attorney-listing">
         <div class="card-header">
            <div class="search-list">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-6 pl-0">
                        <h4>Master Creditors Management</h4>
                     </div>
                     <div class="col-md-6">
                        <div class="d-flex float_right">
                           <div class="search-form">
                              <form action="{{route('admin_creditors_index')}}" method="GET">
                                 <div class="input-group mb-0">
                                    <input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
                                    <button type="submit" class="nmp">
                                    <span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
                                    </button>
                                 </div>
                              </form>
                           </div>
                           <div class="">
                              <a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal" data-bs-target="#add_company">
                                 <i class="feather icon-plus"></i> 
                                 <span class="card-title-text">Add</span>
                              </a>
                           </div>
                           <div class="">
                              <button id="deleteSelectedButton" style="display:none;" class="ml-3 btn btn-danger" onclick="deleteSelectedEntries('<?php echo route('creditors_multiple_delete'); ?>', 'Are you sure you want to delete the selected creditors?')">
                                 Delete Selected (<span>0</span>)
                              </button>
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
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $list = $creditors->toArray()['data'];
                              $creditorCategory = Helper::getCreditorCategories();
                              if (!empty($list)) {?>
                     <?php foreach ($list as $val) {
                         $id = $val['creditor_id']; ?>
                     <tr class="unread state-<?php echo $id; ?>">
                        <td><span>{{$val['creditor_name']}}</span></td>
                        <td><span>{{$val['creditor_address']}}</span></td>
                        <td><span>{{$val['creditor_city']}}</span></td>
                        <td><span>{{$val['creditor_state']}}</span></td>
                        <td><span>{{$val['creditor_zip']}}</span></td>
                        <td>
                           <select class="category-select" name="category" onchange="updateCategory(this, <?php echo $id;?>)">
                              <option value="">Select Category</option>
                              <?php foreach ($creditorCategory as $key => $category) { ?>
                                 <option value="<?php echo $key; ?>" <?php echo ($key == $val['category']) ? 'selected' : ''; ?>><?php echo $category; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td>
                           <span>
                              <?php
                                  // not active
                                  if ($val['active_status'] == 0) {
                                      ?>
                                 <a  
                                    href="{{route('creditor_activate',['id'=>$id])}}"
                                    class="pending"
                                    onclick='activateCreditor()'
                                 >
                                    Waiting for approval
                                 </a>
                              <?php
                                  }
                         // active
                         if ($val['active_status'] == 1) {
                             ?>
                                 <span class="statusdone">Active</span>
                              <?php
                         }
                         ?>
                           </span>
                        </td>
                        <td class="d-flex align-items-center">
                           <a href="{{route('admin_creditors_edit',['id'=>$val['creditor_id']])}}" class="label mb-0 theme-bg text-white f-12">Edit</a>
                           <a href="javascript:void(0)" class="ml-2" onclick='deleteCreditors("<?php echo route("admin_creditors_delete", $val['creditor_id']); ?>", "<?php echo $val['creditor_id'] ?>")'><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                           <input type="checkbox" class="float_right ml-auto select-row" value="<?php echo $id; ?>">
                        </td>
                     </tr>
                     <?php }
                     } else {?>	
							<tr><td colspan="7" class="text-center">No record found</td></tr>
						<?php } ?>
                  </tbody>
               </table>
            </div>
            <div class="pagination px-2">
               <?php if (!empty($creditors)) {?>
               {{ $creditors->appends(['q' => $keyword])->links() }}
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
   	$("#add_company").modal('show');
   });
</script>
@endif
<!-- Modal -->
<div id="add_company" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add Company</h4>
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
         </div>
         <form id="add_master_creditor_form" action="{{route('admin_creditors_create')}}" method="post" novalidate>
            @csrf			
            <div class="modal-body">
               <div class="row ">
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('creditor_name') ? 'btn-outline-danger' : '' }}" placeholder="Company Name " name="creditor_name" value="{{ old('creditor_name') }}">
                     </div>
                     @if ($errors->has('creditor_name'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_name') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('creditor_address') ? 'btn-outline-danger' : '' }}" placeholder="Company Address" name="creditor_address" value="{{ old('creditor_address') }}">
                     </div>
                     @if ($errors->has('creditor_address'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_address') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('creditor_city') ? 'btn-outline-danger' : '' }}" placeholder="City" name="creditor_city" value="{{ old('creditor_city') }}">
                     </div>
                     @if ($errors->has('creditor_city'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_city') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('creditor_state') ? 'btn-outline-danger' : '' }}" placeholder="State" name="creditor_state" value="{{ old('creditor_state') }}">
                     </div>
                     @if ($errors->has('creditor_state'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_state') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required type="text" class="form-control mb-4 allow-5digit {{ $errors->has('creditor_zip') ? 'btn-outline-danger' : '' }}" placeholder="Zip" name="creditor_zip" value="{{ old('creditor_zip') }}">
                     </div>
                     @if ($errors->has('creditor_zip'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_zip') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required type="text" class="form-control phone-field mb-4 {{ $errors->has('creditor_contact') ? 'btn-outline-danger' : '' }}" placeholder="Contact" name="creditor_contact" value="{{ old('creditor_contact') }}">
                     </div>
                     @if ($errors->has('creditor_contact'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_contact') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                        <input type="text" class="form-control mb-4 {{ $errors->has('creditor_website') ? 'btn-outline-danger' : '' }}" placeholder="Website" name="creditor_website" value="{{ old('creditor_website') }}">
                     @if ($errors->has('creditor_website'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_website') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <select class="form-control {{ $errors->has('category') ? 'btn-outline-danger' : '' }} " name="category" >
                        <option value="">Select Category</option>
                        <?php foreach (Helper::getCreditorCategories() as $key => $category) { ?>
                           <option value="<?php echo $key; ?>" ><?php echo $category; ?></option>
                        <?php } ?>
                     </select>
                     @if ($errors->has('creditor_website'))
                        <p class="help-block text-danger">{{ $errors->first('creditor_website') }}</p>
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

      .category-select{
         display: block;
         width: auto;
         padding: .25rem .3rem;
         line-height: 1.5;
         color: #495057;
         border: 1px solid #ced4da;
         border-radius: .25rem;
         transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      }
		</style>
		<script>
			$(document).ready(function(){
				
				$("#add_master_creditor_form").validate({
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

         activateCreditor = function () {
            event.preventDefault();
            if (confirm("Are you sure you want to activate this Creditor?")) {
               window.location.href = event.target.href;
            }
         };

         updateCategory = function (element, creditor_id) {
            if (!confirm("Do you want to update record?")) {
               $(element).val("");
               return;
            }
            var category = $(element).val();
            var url = "<?php echo route('admin_creditors_category_update'); ?>";
            laws.ajax(url, { creditor_id: creditor_id, category: category }, function (response) {
               var res = JSON.parse(response);
               if (res.status == 0) {
                  $.systemMessage(res.msg, 'alert--danger', true);
               } else {
                  $.systemMessage(res.msg, 'alert--success', true);
               }
            });
         };

		</script>

   </div>
</div>
<!-- [ Main Content ] end -->
@endsection