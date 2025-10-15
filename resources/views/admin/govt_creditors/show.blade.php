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
                     <div class="col-md-5 pl-0">
                        <h4>Govt Creditors Management 
                           <?php if (!empty($latestSyncedAt)) {?>
                           <span class="fs-14px">( Last synced with API: <?php echo $latestSyncedAt; ?> )</span>
                           <?php } ?>
                        </h4>
                     </div>
                     <div class="col-md-7">
                        <div class="d-flex float_right">
                           <div class="search-form">
                              <form action="{{route('admin_govt_creditors_index')}}" method="GET">
                                 <div class="input-group mb-0">
                                    <input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
                                    <button type="submit" class="nmp">
                                    <span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
                                    </button>
                                 </div>
                              </form>
                           </div>
                           <!-- <div class="">
                              <a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal" data-bs-target="#govt_creditor_create">
                                 <i class="feather icon-plus"></i> 
                                 <span class="card-title-text">Add</span>
                              </a>
                           </div> -->
                           <div class="">
                              <a href="javascript:void(0)" class="ml-3 btn font-weight-bold border-blue f-12" onclick="syncWithApi('<?php echo route('admin_govt_creditors_sync_with_api'); ?>')" >
                                 <i class="feather icon-refresh-cw"></i> 
                                 <span class="card-title-text">Sync With API</span>
                              </a>
                           </div>
                           <!-- <div class="">
                              <button id="deleteSelectedButton" style="display:none;" class="ml-3 btn btn-danger" onclick="deleteSelectedEntries('<?php echo route('admin_govt_creditors_multiple_delete'); ?>', 'Are you sure you want to delete the selected creditors?')">
                                 Delete Selected (<span>0</span>)
                              </button>
                           </div> -->
                           <div class="">
                              <button id="importToCreditorButton"  class="ml-3 btn btn-info" onclick="deleteSelectedEntries('<?php echo route('admin_govt_creditors_import_to_creditor'); ?>', 'Are you sure you want to import the selected creditors to Common Creditors?')">
                                 Import to Creditor (<span>0</span>)
                              </button>
                           </div>
                           <!-- <div class="">
                              <button id="importToMortgageButton" style="display:none;" class="ml-3 btn btn-info" onclick="deleteSelectedEntries('<?php echo route('admin_govt_creditors_import_to_mortgage'); ?>', 'Are you sure you want to import the selected creditors to Mortgages?')">
                                 Import to Mortgage (<span>0</span>)
                              </button>
                           </div> -->
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
                        <th>Imported to creditors</th>
                        <th>Imported to mortgages</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $list = $creditors->toArray()['data'];
                           $creditorCategory = Helper::getCreditorCategories();
                           if (!empty($list)) {?>
                     <?php foreach ($list as $val) {
                         $id = $val['id']; ?>
                     <tr class="unread state-<?php echo $id; ?>">
                        <td><span><?php echo Helper::validate_key_value('creditor_name', $val); ?></span></td>
                        <td><span><?php echo Helper::validate_key_value('creditor_address', $val); ?></span></td>
                        <td><span><?php echo Helper::validate_key_value('creditor_city', $val); ?></span></td>
                        <td><span><?php echo Helper::validate_key_value('creditor_state', $val); ?></span></td>
                        <td><span><?php echo Helper::validate_key_value('creditor_zip', $val); ?></span></td>
                        <td><?php echo Helper::validate_key_value('is_imported_to_common_creditors', $val, 'radio') == 1 ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>'; ?></td>
                        <td><?php echo Helper::validate_key_value('is_imported_to_mortgage', $val, 'radio') == 1 ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>'; ?></td>
                        <td>
                           <!-- <a href="{{route('admin_creditors_edit',['id'=>$val['id']])}}" class="label mb-0 theme-bg text-white f-12">Edit</a> -->
                           <!-- <a href="javascript:void(0)" class="ml-2" onclick='deleteCreditors("<?php echo route("admin_govt_creditors_delete", $val['id']); ?>", "<?php echo $val['id'] ?>")'><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a> -->
                           <?php if (Helper::validate_key_value('is_imported_to_common_creditors', $val, 'radio') == 0 || Helper::validate_key_value('is_imported_to_mortgage', $val, 'radio') == 0) { ?>
                              <input type="checkbox" class=" select-govt-row" value="<?php echo $id; ?>">
                           <?php } else {
                               echo '-';
                           } ?>                           
                        </td>
                     </tr>
                     <?php }
                     } else {?>	
							<tr><td colspan="8" class="text-center">No record found</td></tr>
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
   	$("#govt_creditor_create").modal('show');
   });
</script>
@endif
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
   .fs-14px{
      font-size: 14px;
   }
</style>
<script>

   syncWithApi = function (url) {
      if (!confirm("Do you want to sync creditors with api?")) {
         return;
      }
      $.systemMessage("Syncing..", 'alert--process');
      laws.ajax(url, {  }, function (response) {
         var res = JSON.parse(response);
         if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
         } else {
            $.systemMessage(res.msg, 'alert--success', true);
            setTimeout(function () {
               location.reload();
            }, 1500);
         }
      });
   };

</script>
@endsection