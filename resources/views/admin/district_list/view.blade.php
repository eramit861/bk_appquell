@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
   <!--[ Recent Users ] start-->
   <div class="col-xl-12 col-md-12">
      <div class="card listing-card">
         <div class="card-header">
                <div class="search-list">
                    <div class="col-md-12">
                        <form action="{{route('admin_districtform_index')}}" method="GET">
                            <div class="row">   
                                <div class="col-md-12">
                                    <h4>District Order</h4>
                                </div>
                            </div>
                        </form>
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
                        <th>Region</th>
                        <th>Chapter 13 </th>
                        <!--th>Action</th-->
                     </tr>
                  </thead>
                  <tbody>
                  <?php
                     $list = $district_names->toArray();
                  if (!empty($list)) {
                      $i = 1;?>
                     <?php foreach ($list as $val) {?>
                     <tr id="<?php echo $val['id']; ?>" class="unread state-<?php echo $val['id']; ?>">
                     <td class="dragHandle"><i class="feather icon-move"></i></td>
                     <td><span><b>{{$val['district_name']}}</b></span></td>
                     <td><span>{{$val['sort_order']}}</span></td>
                     <td class="pt-2 pb-2">
                        <select class="form-control width_fit_content py-3px-i h-auto" id="regionSelect_{{$i}}" onchange="change_region('<?php echo $val['id']; ?>', '{{$i}}')">
                           <option value="">Select Region</option>
                           <?php
                               if (!empty($regionList)) {
                                   foreach ($regionList as $region) {
                                       ?>
                              <option <?php if ($val['region_id'] == $region['id']) {
                                  echo "selected";
                              }?> value="{{$region['id']}}">{{$region['region_name']}}</option>
                           <?php
                                   }
                               }
                         ?>
                        </select>
                     </td>
                     <td class="pt-2 pb-2">
                        <select class="form-control width_fit_content py-3px-i h-auto" onchange="change_status('<?php echo $val['id']; ?>','<?php echo $val['is_chapter_thirteen_enable']; ?>')">
                           <option <?php if ($val['is_chapter_thirteen_enable'] == 0) {
                               echo "selected";
                           }?> value="0">No</option>
                           <option <?php if ($val['is_chapter_thirteen_enable'] == 1) {
                               echo "selected";
                           }?> value="1">Yes</option>
                        </select>
                     </td>
      
                        
                     </tr>
                     <?php $i++;
                     }
                  } else {?>	
							<tr><td colspan="2" class="text-center">No record found</td></tr>
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

         change_status = function(id,t_stattus){
            laws.ajax('<?php echo route('chapter_thirteen_status'); ?>', {id:id,status:t_stattus}, function(res) {
                           
                  var ans = $.parseJSON(res);
                  if (ans.status == 1) {
                  $.systemMessage(ans.msg, 'alert--success', true);
                  } else {
                     $.systemMessage(ans.msg, 'alert--danger', true);

                  }
            });
         }

         change_region = function(id, i){
            var region_id = $("#regionSelect_"+i).find(':selected').attr('value');
            laws.ajax('<?php echo route('region_update'); ?>', {id:id,region_id:region_id}, function(res) { 
               var ans = $.parseJSON(res);
               if (ans.status == 1) {
                  $.systemMessage(ans.msg, 'alert--success', true);
               } else {
                  $.systemMessage(ans.msg, 'alert--danger', true);
               }
            });
         }
     
        $('#pageList').tableDnD({
            onDrop: function(table, row) {
                var order = $.tableDnD.serialize('id');
                
                laws.ajax('<?php echo route('save_district_order'); ?>', order, function(res) {
                   
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