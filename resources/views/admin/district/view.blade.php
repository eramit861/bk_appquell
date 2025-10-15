@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
   <!--[ Recent Users ] start-->
   <div class="col-xl-12 col-md-12">
      <div class="card attorney-listing mb-0">
         <div class="card-header">
            <div class="search-list">
               <div class="col-md-12">
                  <form action="{{route('admin_districtform_index')}}" method="GET">
                     <div class="row">
                        <div class="col-md-4">
                           <h4>Official Form Stack Ordering</h4>
                        </div>
                        <?php $groups = []; ?>
                        <div class="col-md-8"> 
                           <div class="d-flex float_right">
                              <div class="">
                                 <div class="input-group mb-0">
                                    <select class="form-control" onchange="this.form.submit()" name="district" >
                                    <?php foreach ($district_names as $thisdistrict) {
                                        if (!in_array($thisdistrict->short_name, $groups)) {?>
                                          <optgroup label="{{$thisdistrict->short_name}}"></optgroup><?php array_push($groups, $thisdistrict->short_name); ?><?php } ?>
                                    <option <?php if ($district == $thisdistrict->id) {
                                        echo "selected";
                                    } ?> value="{{$thisdistrict->id}}">{{$thisdistrict->district_name}}</option>
                                    <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="m-l-30">
                                 <div class="input-group mb-0">
                                    <select class="form-control" onchange="this.form.submit()" name="form_type">
                                       <option <?php if ($form_type == 'default') {
                                           echo "selected";
                                       } ?> value="default">Default Forms</option>
                                       <option  <?php if ($form_type == 'local') {
                                           echo "selected";
                                       } ?> value="local">Local Forms</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="m-l-30">
                                 <button type="submit" class="nmp">
                                    <span class="input-group-append form-control search-btn btn font-weight-bold border-blue mb-0">Search</span>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
         <div class="card-block px-0 py-0">
            <div class="table-responsive">
               <table class="table table-hover" id="pageList">
                  <thead>
                     <tr>
                        <th></th>
                        <th>Form Name</th>
                        <th>Sort Order</th>
                        <th>Type</th>
                        <!--th>Action</th-->
                     </tr>
                  </thead>
                  <tbody>
                  <?php
                     $list = $forms->toArray();
                        if (!empty($list)) {?>
                     <?php foreach ($list as $val) {?>
                     <tr id="<?php echo $val['form_id']; ?>" class="unread state-<?php echo $val['form_id']; ?>">
                     <td class="dragHandle"><i class="feather icon-move"></i></td>
                        <td><span><b>{{$val['form_name']}}</b> {{$val['form_tab_description']}}</span></td>
                        <td><span>{{$val['sorting_order']}}</span></td>
                        <td><span><?php echo $val['type'] == 'local' ? "Local Form" : "Default Form"; ?></span></td>
      
                        <!--td>
                           <a href="javascript:void(0)" onclick="editDistrictForm('<?php echo route('district_form_edit', ['district_id' => $val['form_id']]);?>')" class="label theme-bg text-white f-12">Edit</a>
                        </td-->
                     </tr>
                     <?php }
                     } else {?>	
							<tr><td colspan="3" class="text-center">No record found</td></tr>
						<?php } ?>
                  </tbody>
               </table>
            </div>
          
         </div>
      </div>
   </div>
   <!-- save_district_form_order -->
   <!--[ Recent Users ] end-->
</div>
<!-- [ Main Content ] end -->


<script>
     
        $('#pageList').tableDnD({
            onDrop: function(table, row) {
                var order = $.tableDnD.serialize('id');
                
                laws.ajax('<?php echo route('save_district_form_order'); ?>', order, function(res) {
                   
                    var ans = $.parseJSON(res);
                    if (ans.status == 1) {
                     $.systemMessage(ans.msg, 'alert--success', true);
                     } else {
                        $.systemMessage(ans.msg, 'alert--danger', true);

                    }
                });
            },
            dragHandle: ".dragHandle",
        });
   
</script>

@endsection