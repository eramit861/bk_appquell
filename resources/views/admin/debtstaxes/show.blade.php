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
                        <h4>State Taxes</h4>
                     </div>
                     <div class="col-md-6">
                        <div class="d-flex float_right">
                           <div class="search-form">
                              <form action="{{route('admin_debtstaxes_index')}}" method="GET">
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
                        <th>Address Line 1</th>
                        <th>Address Line 2</th>
                        <th>Address Line 3</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $list = $debtstaxes->toArray()['data'];
                     if (!empty($list)) {?>
                     <?php foreach ($list as $val) {?>
                     <tr class="unread state-<?php echo $val['id']; ?>">
                        <td><span>{{$val['stax_name']}}</span></td>
                        <td><span>{{$val['stax_address1']}}</span></td>
                        <td><span>{{$val['stax_address2']}}</span></td>
                        <td><span>{{$val['stax_address3']}}</span></td>
                        <td><span>{{$val['stax_city']}}</span></td>
                        <td><span>{{$val['stax_state']}}</span></td>
                        <td><span>{{$val['stax_zip']}}</span></td>
                        
                        <td>
                           <a href="{{route('admin_debtstaxes_edit',['id'=>$val['id']])}}" class="label theme-bg text-white f-12">Edit</a>
                           <a href="javascript:void(0)"  onclick='deleteCourthouses("<?php echo route("admin_debtstaxes_delete", $val['id']); ?>", "<?php echo $val['id'] ?>")'><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a>
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
               <?php if (!empty($debtstaxes)) {?>
               {{ $debtstaxes->appends(['q' => $keyword])->links() }}
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
         <form id="add_stax" action="{{route('admin_debtstaxes_create')}}" method="post" novalidate>
            @csrf			
            <div class="modal-body">
               <div class="row ">
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control mb-4 {{ $errors->has('stax_name') ? 'btn-outline-danger' : '' }}" placeholder="State Name " name="stax_name" value="{{ old('stax_name') }}">
                  </div>
                  @if ($errors->has('stax_name'))
                     <p class="help-block text-danger">{{ $errors->first('stax_name') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input  type="text" class="form-control mb-4 {{ $errors->has('stax_address1') ? 'btn-outline-danger' : '' }}" placeholder="Address Line 1" name="stax_address1" value="{{ old('stax_address1') }}">
                  </div>
                  @if ($errors->has('stax_address1'))
                     <p class="help-block text-danger">{{ $errors->first('stax_address1') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input  type="text" class="form-control mb-4 {{ $errors->has('stax_address2') ? 'btn-outline-danger' : '' }}" placeholder="Address Line 2" name="stax_address2" value="{{ old('stax_address2') }}">
                  </div>
                  @if ($errors->has('stax_address2'))
                     <p class="help-block text-danger">{{ $errors->first('stax_address2') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input  type="text" class="form-control mb-4 {{ $errors->has('stax_address3') ? 'btn-outline-danger' : '' }}" placeholder="Address Line 3" name="stax_address3" value="{{ old('stax_address3') }}">
                  </div>
                  @if ($errors->has('stax_address3'))
                     <p class="help-block text-danger">{{ $errors->first('stax_address3') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control mb-4 {{ $errors->has('stax_city') ? 'btn-outline-danger' : '' }}" placeholder="City" name="stax_city" value="{{ old('stax_city') }}">
                  </div>
                  @if ($errors->has('stax_city'))
                     <p class="help-block text-danger">{{ $errors->first('stax_city') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control mb-4 {{ $errors->has('stax_state') ? 'btn-outline-danger' : '' }}" placeholder="State" name="stax_state" value="{{ old('stax_state') }}">
                  </div>
                  @if ($errors->has('stax_state'))
                     <p class="help-block text-danger">{{ $errors->first('stax_state') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                  <div class="form-group">
                  <input required type="text" class="form-control allow-5digit mb-4 {{ $errors->has('stax_zip') ? 'btn-outline-danger' : '' }}" placeholder="Zip" name="stax_zip" value="{{ old('stax_zip') }}">
                  </div>
                  @if ($errors->has('stax_zip'))
                     <p class="help-block text-danger">{{ $errors->first('stax_zip') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <input type="text" class="form-control mb-4 {{ $errors->has('stax_contact') ? 'btn-outline-danger' : '' }}" placeholder="Contact" name="stax_contact" value="{{ old('stax_contact') }}">
                     @if ($errors->has('stax_contact'))
                     <p class="help-block text-danger">{{ $errors->first('stax_contact') }}</p>
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
				
				$("#add_stax").validate({
					
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