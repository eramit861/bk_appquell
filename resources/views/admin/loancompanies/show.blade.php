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
                        <h4>Auto Loan Companies Management</h4>
                     </div>
                     <div class="col-md-6">
                        <div class="d-flex float_right">
                           <div class="search-form">
                              <form action="{{route('admin_loancompanies_index')}}" method="GET">
                                 <div class="input-group mb-0">
                                    <input type="text" name="q" class="form-control" value="{{@$keyword}}" placeholder="Search . . .">
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
                              <button id="deleteSelectedButton" style="display:none;" class="ml-3 btn btn-danger" onclick="deleteSelectedEntries('<?php echo route('companies_multiple_delete'); ?>', 'Are you sure you want to delete the selected companies?')">
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
                        <th>Website</th>
                        <th>Availale&nbsp;For&nbsp;OCR</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $list = $companies->toArray()['data'];
                              if (!empty($list)) {?>
                     <?php foreach ($list as $val) {?>
                     <tr class="unread state-<?php echo $val['id']; ?>">
                        <td><span>{{$val['alcomp_name']}}</span></td>
                        <td><span>{{$val['alcomp_address']}}</span></td>
                        <td><span>{{$val['alcomp_city']}}</span></td>
                        <td><span>{{$val['alcomp_state']}}</span></td>
                        <td><span>{{$val['alcomp_zip']}}</span></td>
                        <td><span>{{$val['alcomp_website']}}</span></td>
                        <td><span><?php echo ArrayHelper::getYesNoArray($val['is_ocr_available']); ?></span></td>
                        <td>
                           <span>
                              <?php
                                          // not active
                                          if ($val['active_status'] == 0) {
                                              ?>
                                 <a  
                                    href="{{route('auto_loan_activate',['id'=>$val['id']])}}"
                                    class="pending"
                                    onclick='activateAutoLoan()'
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
                           <a href="{{route('admin_loancompanies_edit',['id'=>$val['id']])}}" class="label mb-0 theme-bg text-white f-12">Edit</a>
                           <a href="javascript:void(0)" class="ml-2" onclick='deleteCompany("<?php echo route("admin_loancompanies_delete", $val['id']); ?>", "<?php echo $val['id'] ?>")'><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                           <input type="checkbox" class="float_right ml-auto select-row" value="<?php echo $val['id']; ?>">
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
               <?php if (!empty($companies)) {?>
               {{ $companies->appends(['q' => $keyword])->links() }}
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
         <form id="add_loan_company_form" action="{{route('admin_loancompanies_create')}}" method="post" novalidate>
            @csrf			
            <div class="modal-body">
               <div class="row ">
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required value="{{ old('alcomp_name') }}" type="text" class="form-control mb-4 {{ $errors->has('alcomp_name') ? 'btn-outline-danger' : '' }}" placeholder="Company Name " name="alcomp_name">
                     </div>
                        @if ($errors->has('alcomp_name'))
                        <p class="help-block text-danger">{{ $errors->first('alcomp_name') }}</p>
                        @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required value="{{ old('alcomp_address') }}" type="text" class="form-control mb-4 {{ $errors->has('alcomp_address') ? 'btn-outline-danger' : '' }}" placeholder="Company Address" name="alcomp_address">
                     </div>
                        @if ($errors->has('alcomp_address'))
                        <p class="help-block text-danger">{{ $errors->first('alcomp_address') }}</p>
                        @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required value="{{ old('alcomp_city') }}" type="text" class="form-control mb-4 {{ $errors->has('alcomp_city') ? 'btn-outline-danger' : '' }}" placeholder="City" name="alcomp_city">
                     </div>
                        @if ($errors->has('alcomp_city'))
                        <p class="help-block text-danger">{{ $errors->first('alcomp_city') }}</p>
                        @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required value="{{ old('alcomp_state') }}" type="text" class="form-control mb-4 {{ $errors->has('alcomp_state') ? 'btn-outline-danger' : '' }}" placeholder="State" name="alcomp_state">
                     </div>
                        @if ($errors->has('alcomp_state'))
                        <p class="help-block text-danger">{{ $errors->first('alcomp_state') }}</p>
                        @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input required value="{{ old('alcomp_zip') }}" type="text" class="form-control allow-5digit mb-4 {{ $errors->has('alcomp_zip') ? 'btn-outline-danger' : '' }}" placeholder="Zip" name="alcomp_zip">
                     </div>
                        @if ($errors->has('alcomp_zip'))
                        <p class="help-block text-danger">{{ $errors->first('alcomp_zip') }}</p>
                        @endif
                  </div>
                  <div class="col-sm-12">
      					<div class="form-group">
                        <input  value="{{ old('alcomp_website') }}" type="text" class="form-control mb-4 {{ $errors->has('alcomp_website') ? 'btn-outline-danger' : '' }}" placeholder="Website" name="alcomp_website">
                     </div>
                        @if ($errors->has('alcomp_website'))
                        <p class="help-block text-danger">{{ $errors->first('alcomp_website') }}</p>
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
				
				$("#add_loan_company_form").validate({
					
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

         activateAutoLoan = function () {
            event.preventDefault();
            if (confirm("Are you sure you want to activate this Auto loan Company?")) {
               window.location.href = event.target.href;
            }
         };
		</script>
   </div>
</div>
<!-- [ Main Content ] end -->
@endsection