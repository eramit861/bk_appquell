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
                     <div class="col-md-4 pl-0">
                        <h4>Courthouses Management</h4>
                     </div>
                     <div class="col-md-8">
                        <div class="d-flex float_right">
                           <div class="search-form">
                              <form action="{{route('admin_courthouses_index')}}" method="GET">
                                 <div class="d-flex float_right">
                                    <div class="input-group mb-0">
                                       <select name="per_page" class="form-control w-auto" id="per_page" onchange="this.form.submit()">
                                          <option value="10" {{ (isset($per_page) && $per_page == 10) ? 'selected' : '' }}>10 per page</option>
                                          <option value="25" {{ (isset($per_page) && $per_page == 25) ? 'selected' : '' }}>25 per page</option>
                                          <option value="50" {{ (isset($per_page) && $per_page == 50) ? 'selected' : '' }}>50 per page</option>
                                          <option value="100" {{ (isset($per_page) && $per_page == 100) ? 'selected' : '' }}>100 per page</option>
                                       </select>
                                    </div>
                                    <div class="input-group mb-0 m-l-30">
                                       <select name="search_courthouse_state" class="form-control w-auto" id="search_courthouse_state" onchange="this.form.submit()">
                                          <option value="">Select State</option>
                                          <?php echo \App\Helpers\AddressHelper::getStatesList($search_courthouse_state); ?>
                                       </select>
                                    </div>
                                    <div class="input-group mb-0 m-l-30">
                                       <input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
                                       <button type="submit" class="nmp">
                                       <span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="">
                              <a href="#" class="m-l-30 btn font-weight-bold border-blue f-12 mr-0" data-bs-toggle="modal" data-bs-target="#add_company">
                                 <i class="feather icon-plus"></i>
                                 <span class="card-title-text">Add</span>
                              </a>
                           </div>
                           <div class="">
                              <a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal" data-bs-target="#import_excel_modal">
                                 <i class="feather icon-upload"></i>
                                 <span class="card-title-text">Import</span>
                              </a>
                           </div>
                           <div class="">
                              <button id="deleteSelectedButton" style="display:none;" class="ml-3 btn btn-danger" onclick="deleteSelectedEntries('<?php echo route('courthouse_multiple_delete'); ?>', 'Are you sure you want to delete the selected creditors?')">
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
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $list = $courthouses->toArray()['data'];
                                          if (!empty($list)) {?>
                     <?php foreach ($list as $val) {?>
                     <tr class="unread state-<?php echo $val['courthouse_id']; ?>">
                        <td><span>{{$val['courthouse_name']}}</span></td>
                        <td><span>{{$val['courthouse_address']}}</span></td>
                        <td><span>{{$val['courthouse_city']}}</span></td>
                        <td><span>{{$val['courthouse_state']}}</span></td>
                        <td><span>{{$val['courthouse_zip']}}</span></td>
                        <td class="d-flex align-items-center">
                           <a href="{{ route('admin_courthouses_edit', ['id' => $val['courthouse_id']]) }}{{ request()->getQueryString() ? ('?' . request()->getQueryString()) : '' }}" class="label mb-0 theme-bg text-white f-12">Edit</a>
                           <a href="javascript:void(0)" class="ml-2" onclick='deleteCourthouses("<?php echo route("admin_courthouses_delete", $val['courthouse_id']); ?>", "<?php echo $val['courthouse_id'] ?>")'><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                           <input type="checkbox" class="float_right ml-auto select-row" value="<?php echo $val['courthouse_id']; ?>">
                        </td>
                     </tr>
                     <?php }
                     } else {?>	
							<tr><td colspan="6" class="text-center">No record found</td></tr>
						<?php } ?>
                  </tbody>
               </table>
            </div>
            <div class="pagination px-2">
               <?php if (!empty($courthouses)) {?>
               {{ $courthouses->appends(request()->query())->links() }}
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
<div id="import_excel_modal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Import Excel</h4>
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
         </div>
         <form id="import_excel_form" action="{{ route('admin_courthouses_import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="excel_file">Upload Excel File:</label>
                  <input type="file" class="form-control" name="excel_file" id="excel_file" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-theme-black">Import</button>
               <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Modal -->
<div id="add_company" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add Company</h4>
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
         </div>
         <form id="add_courthouse" action="{{route('admin_courthouses_create')}}" method="post" novalidate>
            @csrf			
            <div class="modal-body">
               <div class="row ">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('courthouse_name') ? 'btn-outline-danger' : '' }}" placeholder="Company Name " name="courthouse_name" value="{{old('courthouse_name')}}">
                     </div>
                     @if ($errors->has('courthouse_name'))
                     <p class="help-block text-danger">{{ $errors->first('courthouse_name') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('courthouse_address') ? 'btn-outline-danger' : '' }}" placeholder="Company Address" name="courthouse_address" value="{{old('courthouse_address')}}">
                     </div>
                     @if ($errors->has('courthouse_address'))
                     <p class="help-block text-danger">{{ $errors->first('courthouse_address') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('courthouse_city') ? 'btn-outline-danger' : '' }}" placeholder="City" name="courthouse_city" value="{{old('courthouse_city')}}">
                     </div>
                     @if ($errors->has('courthouse_city'))
                     <p class="help-block text-danger">{{ $errors->first('courthouse_city') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <input required type="text" class="form-control mb-4 {{ $errors->has('courthouse_state') ? 'btn-outline-danger' : '' }}" placeholder="State" name="courthouse_state" value="{{old('courthouse_state')}}">
                     </div>
                     @if ($errors->has('courthouse_state'))
                     <p class="help-block text-danger">{{ $errors->first('courthouse_state') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <input required type="text" class="form-control allow-5digit mb-4 {{ $errors->has('courthouse_zip') ? 'btn-outline-danger' : '' }}" placeholder="Zip" name="courthouse_zip" value="{{old('courthouse_zip')}}">
                     </div>
                     @if ($errors->has('courthouse_zip'))
                     <p class="help-block text-danger">{{ $errors->first('courthouse_zip') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <input type="text" class="form-control mb-4 {{ $errors->has('courthouse_contact') ? 'btn-outline-danger' : '' }}" placeholder="Contact" name="courthouse_contact" value="{{old('courthouse_contact')}}">
                     </div>
                     @if ($errors->has('courthouse_contact'))
                     <p class="help-block text-danger">{{ $errors->first('courthouse_contact') }}</p>
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
				$(document).ready(function(){
					
					$("#add_courthouse").validate({
						
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