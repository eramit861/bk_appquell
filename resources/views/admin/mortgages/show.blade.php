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
                        <h4>Mortgage Management</h4>
                     </div>
                     <div class="col-md-6">
                        <div class="d-flex float_right">
                           <div class="search-form">
                              <form action="{{route('admin_mortgages_index')}}" method="GET">
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
                              <button id="deleteSelectedButton" style="display:none;" class="ml-3 btn btn-danger" onclick="deleteSelectedEntries('<?php echo route('mortgage_multiple_delete'); ?>', 'Are you sure you want to delete the selected creditors?')">
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
                        <th>Availale For OCR</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $list = $mortgages->toArray()['data'];
                              if (!empty($list)) {?>
                     <?php foreach ($list as $val) {?>
                     <tr class="unread state-<?php echo $val['mortgage_id']; ?>">
                        <td><span>{{$val['mortgage_name']}}</span></td>
                        <td><span>{{$val['mortgage_address']}}</span></td>
                        <td><span>{{$val['mortgage_city']}}</span></td>
                        <td><span>{{$val['mortgage_state']}}</span></td>
                        <td><span>{{$val['mortgage_zip']}}</span></td>
                        <td><span><?php echo ArrayHelper::getYesNoArray($val['is_ocr_available']); ?></span></td>
                        <td>
                           <span>
                              <?php
                                          // not active
                                          if ($val['active_status'] == 0) {
                                              ?>
                                 <a  
                                    href="{{route('admin_mortgages_activate',['id'=>$val['mortgage_id']])}}"
                                    class="pending"
                                    onclick='activateMortgage()'
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
                           <a href="{{route('admin_mortgages_edit',['id'=>$val['mortgage_id']])}}" class="label mb-0 theme-bg text-white f-12">Edit</a>
                           <a href="javascript:void(0)" class="ml-2" onclick='deleteCourthouses("<?php echo route("admin_mortgages_delete", $val['mortgage_id']); ?>", "<?php echo $val['mortgage_id'] ?>")'><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                           <input type="checkbox" class="float_right ml-auto select-row" value="<?php echo $val['mortgage_id']; ?>">
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
               <?php if (!empty($mortgages)) {?>
               {{ $mortgages->appends(['q' => $keyword])->links() }}
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
            <h4 class="modal-title">Add Mortgage</h4>
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
         </div>
         <form id="add_mortage" action="{{route('admin_mortgages_create')}}" method="post" novalidate>
            @csrf			
            <div class="modal-body">
               <div class="row ">
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control mb-4 {{ $errors->has('mortgage_name') ? 'btn-outline-danger' : '' }}" placeholder="Company Name " name="mortgage_name" value="{{ old('mortgage_name') }}">
                  </div>
                  @if ($errors->has('mortgage_name'))
                     <p class="help-block text-danger">{{ $errors->first('mortgage_name') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control mb-4 {{ $errors->has('mortgage_address') ? 'btn-outline-danger' : '' }}" placeholder="Company Address" name="mortgage_address" value="{{ old('mortgage_address') }}">
                  </div>
                  @if ($errors->has('mortgage_address'))
                     <p class="help-block text-danger">{{ $errors->first('mortgage_address') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control mb-4 {{ $errors->has('mortgage_city') ? 'btn-outline-danger' : '' }}" placeholder="City" name="mortgage_city" value="{{ old('mortgage_city') }}">
                  </div>
                  @if ($errors->has('mortgage_city'))
                     <p class="help-block text-danger">{{ $errors->first('mortgage_city') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control mb-4 {{ $errors->has('mortgage_state') ? 'btn-outline-danger' : '' }}" placeholder="State" name="mortgage_state" value="{{ old('mortgage_state') }}">
                  </div>
                  @if ($errors->has('mortgage_state'))
                     <p class="help-block text-danger">{{ $errors->first('mortgage_state') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control allow-5digit mb-4 {{ $errors->has('mortgage_zip') ? 'btn-outline-danger' : '' }}" placeholder="Zip" name="mortgage_zip" value="{{ old('mortgage_zip') }}">
                  </div>
                  @if ($errors->has('mortgage_zip'))
                     <p class="help-block text-danger">{{ $errors->first('mortgage_zip') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <input type="text" class="form-control mb-4 {{ $errors->has('mortgage_webiste') ? 'btn-outline-danger' : '' }}" placeholder="Website" name="mortgage_webiste" value="{{ old('mortgage_webiste') }}">
                     @if ($errors->has('mortgage_webiste'))
                     <p class="help-block text-danger">{{ $errors->first('mortgage_webiste') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                        <label>Is OCR Available for this?</label><br>
                        <div class="d-inline radio-primary">
                           <input type="radio"  id="is_ocr_available_yes" name="is_ocr_available" value="1" class="required is_ocr_available" required />
                           <label for="is_ocr_available_yes" class="cr">Yes</label>
                        </div>
                        <div class="d-inline radio-primary">
                           <input type="radio"  id="is_ocr_available_no" name="is_ocr_available" value="0" class="required is_ocr_available" required />
                           <label for="is_ocr_available_no" class="cr">No</label>
                        </div>
                     </div>
                     @if ($errors->has('is_ocr_available'))
                     <p class="help-block text-danger">{{ $errors->first('is_ocr_available') }}</p>
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
				
				$("#add_mortage").validate({
					
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
         activateMortgage = function () {
            event.preventDefault();
            if (confirm("Are you sure you want to activate this Mortgage?")) {
               window.location.href = event.target.href;
            }
         };
		</script>
   </div>
</div>
<!-- [ Main Content ] end -->
@endsection