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
                     <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-md-12 ">
                        <h4>Tax/Deduction label Management</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-block px-0 py-0">
            <div class="row">
               <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-md-12 mt-3">
                  <form action="{{route('admin_deduction_create')}}" method="post" class="px-3">
                     @csrf
                     <div class="row">
                        <div class="col-xxl-3 col-xl-2 col-lg-2 col-sm-12 col-md-6">
                           <label for="" class="pt-2 text-bold">Insert New Label:</label>
                        </div>
                        <div class="col-xxl-4 col-xl-5 col-lg-5 col-sm-12 col-md-6 mt-custom">
                           <div class="form-group mb-0 ">
                              <div class=" form-floating ">
                                 <input type="text" required name="newLabel" class="form-control bg-white h-41px" placeholder="Label">
                                 <label for="newLabel" class="ml-3">Enter label here</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-xxl-3 col-xl-5 col-lg-5 col-sm-12 col-md-6 mt-custom">
                           <div class="form-group radio_btn h-41px">
                                 <label class="mb-0 form-label">Type:</label>
                                 <div class="float_right">
                                    <div class="input-group d-inline bg-white">
                                       <input type="radio" required name="labelType" class="mr-1" id="taxes" value="1" checked>
                                       <label for="taxes">Taxes</label>
                                       <input type="radio" required name="labelType" class="ml-4 mr-1" id="deductions" value="2">
                                       <label for="deductions">Deductions</label>
                                    </div>
                                 </div>
                           </div>
                        </div>
                        <div class="col-xxl-2 col-xl-12 col-lg-12 col-sm-12 col-md-6 mt-custom">
                           <button  type="submit" class="h-41px btn font-weight-bold border-blue f-12 float-right mr-0">
                              <i class="feather icon-plus"></i>
                              <span class="card-title-text">Add new label</span>
                           </button >
                        </div> 
                     </div>
                  </form>
               </div>
               <div class="col-md-6">
                  <div class="pl-3 py-3">
                     <h5 class="text-c-blue">Tax Labels</h5>
                     <div class="table-responsive tablep">
                        <table class="table table-hover mb-0">
                           <thead>
                              <tr>
                                 <th class="w-80">Label</th>
                                 <th class="w-20"><span class="float_right">Action</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($taxList)) {
                                  foreach ($taxList as $index => $data) {
                                      $id = $data["id"];
                                      $label = $data["deduction_label"];
                                      $type = $data["deduction_type"];
                                      ?>
                              <tr class="label_row_{{$id}}">
                                 <td>
                                    <input type="text" name="" class="form-control-none edit_label_input_{{$id}} " value="<?php echo $label; ?>" readonly="true" >
                                 </td>
                                 <td class="">
                                    <span class="float_right">
                                       <a href="javascript:void(0)" onclick='edit_label("<?php echo $id;?>")' class=""><i class=" fas fs-6 fa-edit edit_label_edit_{{$id}}"></i></a>
                                       <a href="javascript:void(0)" onclick='update_label("<?php echo $id ?>", "<?php echo $label; ?>", "<?php echo $type;?>")' class=""><i class=" fas fs-6 fa-check edit_label_submit_{{$id}} d-none"></i></a>
                                       <a href="javascript:void(0)" onclick='delete_label("<?php echo $id;?>")' class="ml-3"><i class="fas fa-trash fa-lg"></i></a>
                                    </span>
                                 </td>
                              </tr>
                              <?php
                                  }
                              } else { ?>
                              <tr>
                                 <td colspan="2" class="text-center">No record found</td>
                              </tr>
                              <?php } ?>
                           </tbody>

                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="pr-3 py-3">
                     <h5 class="text-c-blue">Deduction Labels</h5>
                     <div class="table-responsive tablep">
                        <table class="table table-hover mb-0">
                           <thead>
                              <tr>
                                 <th class="w-80">Label</th>
                                 <th class="w-20"><span class="float_right">Action</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($deductionList)) {
                                  foreach ($deductionList as $index => $data) {
                                      $id = $data["id"];
                                      $label = $data["deduction_label"];
                                      $type = $data["deduction_type"];
                                      ?>
                              <tr class="label_row_{{$id}}">
                                 <td>
                                    <input type="text" name="" class="form-control-none edit_label_input_{{$id}} " value="<?php echo $label; ?>" readonly="true" >
                                 </td>
                                 <td class="">
                                    <span class="float_right">
                                       <a href="javascript:void(0)"  onclick='edit_label("<?php echo $id;?>")' class=""><i class=" fas fs-6 fa-edit edit_label_edit_{{$id}}"></i></a>
                                       <a href="javascript:void(0)"  onclick='update_label("<?php echo $id ?>", "<?php echo $label; ?>", "<?php echo $type;?>")' class=""><i class=" fas fs-6 fa-check edit_label_submit_{{$id}} d-none"></i></a>
                                       <a href="javascript:void(0)"  onclick='delete_label("<?php echo $id;?>")' class="ml-3"><i class="fas fa-trash fa-lg"></i></a>
                                    </span>
                                 </td>
                              </tr>
                              <?php
                                  }
                              } else { ?>
                              <tr>
                                 <td colspan="2" class="text-center">No record found</td>
                              </tr>
                              <?php } ?>
                           </tbody>

                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--[ Recent Users ] end-->
</div>
<div class="whole-page-overlay d-none" id="page_loader">
   <img class="center-loader"  style="width:30px;" alt="loading" src="{{url('/assets/img/loading2.gif')}}"/>
</div>
<style>
   label.error {
      color: red;
      font-style: italic;
   }
   .tablep{
      border: 2px solid #edeef0;
      border-radius: 5px;
   }
</style>
<script>
   
   update_label = function(id, old_label, type){
      var url = "<?php echo route('admin_deduction_update'); ?>";
      var new_label = $(".edit_label_input_"+id).val();
      if(old_label == new_label){
         updateclasses(id);
         return;
      }
      if (!confirm("Do you want to update label?")) {
         return;
      }
      $('#page_loader').show();
      laws.ajax(url, {label_id:id, new_label: new_label, type:type}, function(res) { 
         var ans = $.parseJSON(res);
         if (ans.status == 1) {
            $('#page_loader').hide();
            $.systemMessage(ans.msg, 'alert--success', true);
            
            $(".edit_label_input_"+id).val(new_label);
            updateclasses(id);
         } else {
            $('#page_loader').hide();
            $.systemMessage(ans.msg, 'alert--danger', true);
         }
      });
   }

   edit_label = function(id){
      if($(".edit_label_input_"+id).hasClass("form-control-none") == true) {
         $(".edit_label_input_"+id).removeClass('form-control-none');
         $(".edit_label_input_"+id).addClass('form-control');
         $(".edit_label_input_"+id).addClass('py-0');
         $(".edit_label_input_"+id).addClass('form-control-custom-padding');
         $(".edit_label_input_"+id).attr('readonly',false);
         $(".edit_label_edit_"+id).addClass('d-none');
         $(".edit_label_submit_"+id).removeClass('d-none');
      }
   }

   updateclasses = function(id){
      $(".edit_label_input_"+id).removeClass('form-control');
      $(".edit_label_input_"+id).addClass('form-control-none');
      $(".edit_label_input_"+id).attr('readonly',true);
      $(".edit_label_input_"+id).removeClass('py-0');
      $(".edit_label_submit_"+id).addClass('d-none');
      $(".edit_label_edit_"+id).removeClass('d-none');
   }
 
   delete_label = function(id){
      var url = "<?php echo route('admin_deduction_delete'); ?>";
      if (!confirm("Do you want to delete the label?")) {
         return;
      }
      laws.ajax(url, {label_id:id}, function(res) { 
         var ans = $.parseJSON(res);
         if (ans.status == 1) {
            $.systemMessage(ans.msg, 'alert--success', true);
            $(".label_row_"+id).remove();
         } else {
            $.systemMessage(ans.msg, 'alert--danger', true);
         }
      });
   }

   
</script>

@endsection