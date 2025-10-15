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
                     <div class="col-md-8 pl-0">
                        <h4>Scanned Data</h4>
                     </div>
                     <div class="col-md-4 d-flex">
                        <div class="search-form">
                           <form action="{{route('admin_creditors_index')}}" method="GET">
                              <div class="input-group">
                                 <input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
                                 <button type="submit" class="nmp">
                                 <span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
                                 </button>
                              </div>
                           </form>
                        </div>
                    <a href="#" class="m-l-30 btn font-weight-bold border-blue f-12" data-bs-toggle="modal"
                        data-bs-target="#add_company"><i class="feather icon-plus"></i> <span
                        class="card-title-text">Add</span></a>
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
                     <th>Document type</th>
                        <th>Is Imported</th>
                        <th>Scanned Data</th>
                        <th>VIN number</th>
                        <th>VIN data</th>
                    
                        <th>Created at</th>
                      
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     if (!empty($list)) {?>
                     <?php foreach ($list as $val) {?>
                     <tr class="unread state-<?php echo $val['id']; ?>">
                        
                        <td><span>{{$val['document_type']}}</span></td>
                        <td><span>{{ArrayHelper::getYesNoArray($val['is_imported'])}}</span></td>
                        <td><span>{{$val['data']}}</span></td>
                        <td><span>{{$val['vin_number']}}</span></td>
                        <td><span>{{$val['vin_data']}}</span></td>
                        
                        <td><span>{{$val['updated_at']}}</span></td>  
                     </tr>
                     <?php }
                     } else {?>	
							<tr><td colspan="7" class="text-center">No record found</td></tr>
						<?php } ?>
                  </tbody>
               </table>
            </div>
         
         </div>
      </div>
   </div>
   <!--[ Recent Users ] end-->
</div>

@endsection