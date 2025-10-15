@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
   <!--[ Recent Users ] start-->
   <div class="col-xl-12 col-md-12">
      <div class="card attorney-listing all_distt-lisitng">
         <div class="card-header">
            <div class="search-list">
               <div class="col-md-12">
                  <div class="row">



                     <div class="col-md-12">
                        <form action="{{route('exemption_list')}}" method="GET">
                           <div class="row">
                              <div class="col-md-2 pl-0">
                                 <h4>Exemptions</h4>
                              </div>
                              <div class="col-md-10">
                                 <div class="d-flex float_right">
                                    <div class="">
                                       <div class="input-group mb-0">
                                          <select class="form-control mb-0 " onchange="this.form.submit()" name="district">
                                          <?php echo AddressHelper::getStatesList($district); ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="m-l-30">
                                       <div class="input-group mb-0">
                                          <select class="form-control mb-0" onchange="this.form.submit()" name="exemption_type">
                                             <option <?php if ($exemption_type == 'State') {
                                                 echo "selected";
                                             } ?> value="State">State</option>
                                             <option <?php if ($exemption_type == 'Federal') {
                                                 echo "selected";
                                             } ?> value="Federal">Federal</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="m-l-30">
                                       <div class="input-group mb-0">
                                          <input type="text" name="q" class="form-control" value="{{@$keyword}}" placeholder="Search . . .">
                                          <button type="submit" class="nmp">
                                             <span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
                                          </button>
                                       </div>
                                    </div>
                                    <div class="m-l-30">
                                       <a href="#" class=" btn font-weight-bold border-blue f-12 mt-1px" data-bs-toggle="modal" data-bs-target="#add_exemption">
                                          <i class="feather icon-plus"></i>
                                          <span class="card-title-text">Add</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
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
                        <th>District Name</th>
                        <th>Exemption Type</th>
                        <th>Description</th>
                        <th>Statute</th>
                        <th>Relate to</th>
                        <th>Exemption limit Individual</th>
                        <th>Exemption limit Joint</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $list = $exemptions->toArray();
                                          if (!empty($list)) { ?>
                        <?php foreach ($list as $val) { ?>
                           <tr class="unread exemption-<?php echo $val['id']; ?>">
                              <td><span>  <?php echo AddressHelper::getSelectedStateName($val['state_name']); ?></span></td>
                              <td><span>{{$val['exemption_type']}}</span></td>
                              <td><span>{{$val['exemption_description']}}</span></td>
                              <td><span>{{$val['exemption_statute']}}</span></td>
                              <td><span>{{$val['relate']}}</span></td>
                              <td class="exm-lmt"><span>{{$val['exemption_limit_individual']}}</span></td>
                              <td class="exm-lmt"><span>{{$val['exemption_limit_joint']}}</span></td>
                              <td>
                                 <div class="d-flex">
                                    <a href="{{route('exemption_edit',['id'=>$val['id']])}}" class="label theme-bg text-white f-12">Edit</a>
                                    <a href="javascript:void(0)" onclick='deleteExemption("<?php echo route("exemption_delete", $val['id']); ?>", "<?php echo $val['id'] ?>")'><i class="fas fa-trash fa-lg" data-bs-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                                 </div>
                              </td>
                           </tr>
                        <?php }
                        } else { ?>
                        <tr>
                           <td colspan="5" class="text-center">No record found</td>
                        </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
            <div class="pagination px-2">
               <?php if (!empty($exemptions)) { ?>

               <?php } ?>
            </div>
         </div>
      </div>
   </div>
   <!--[ Recent Users ] end-->
</div>
@if ($errors->any())
<script>
   $(document).ready(function() {
      $("#add_exemption").modal('show');
   });
</script>
@endif
<!-- Modal -->
<div id="add_exemption" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add Exemption</h4>
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
         </div>
         <form id="add_exemption_form" action="{{route('exemption_create')}}" method="post" novalidate>
            @csrf
            <div class="modal-body">
               <div class="row ">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label>Choose district:</label>
                        <select class="form-control" name="state_name" id="district_name_first"> 
                        <?php echo AddressHelper::getStatesList(); ?>
                        </select>
                     </div>
                     @if ($errors->has('state_name'))
                     <p class="help-block text-danger">{{ $errors->first('state_name') }}</p>
                     @endif
                  </div>

                  <div class="col-sm-12">
                     <div class="form-group">
                        <label>Choose Exemptions Type:</label><br>
                        <div class="d-inline radio-primary">
                           <input type="radio" id="is_exemptions_state" name="exemption_type" value="State" class="required is_exemptions" required />
                           <label for="is_exemptions_state" class="cr">State</label>
                        </div>
                        <div class="d-inline radio-primary">
                           <input type="radio" id="is_exemptions_federal" name="exemption_type" value="Federal" class="required is_exemptions" required />
                           <label for="is_exemptions_federal" class="cr">Federal</label>
                        </div>
                     </div>
                     @if ($errors->has('exemption_type'))
                     <p class="help-block text-danger">{{ $errors->first('exemption_type') }}</p>
                     @endif
                  </div>

                  <div class="col-sm-12">
                     <div class="form-group">
                        <label>Exemption Description:</label>
                        <input required value="{{ old('exemption_description') }}" type="text" class="form-control mb-4 {{ $errors->has('exemption_description') ? 'btn-outline-danger' : '' }}" placeholder="Exemption Description" name="exemption_description">
                     </div>
                     @if ($errors->has('exemption_description'))
                     <p class="help-block text-danger">{{ $errors->first('exemption_description') }}</p>
                     @endif
                  </div>

                  <div class="col-sm-12">
                     <div class="form-group">
                        <label>Exemption Statute:</label>
                        <input required value="{{ old('exemption_statute') }}" type="text" class="form-control mb-4 {{ $errors->has('exemption_statute') ? 'btn-outline-danger' : '' }}" placeholder="Statute" name="exemption_statute">
                     </div>
                     @if ($errors->has('exemption_statute'))
                     <p class="help-block text-danger">{{ $errors->first('exemption_statute') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12">
                     <div class="form-check ltd-opti">
                        <label>Exemption Limit:</label>
                        <div class="check_pnts"><input class="form-check-input position-static" type="checkbox" id="unlimited" value="unlimited" aria-label="..."> <label for="inputEmail4">Unlimited</label></div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="inputEmail4">Individual:</label>
                           <div class="input-group d-flex">
                              <span class="input-group-text" id="basic-addon2" style="margin-left: 0px;">$</span>
                              <input name="exemption_limit_individual" id="individual" type="text" value=" " class="price-field-exemption form-control {{ $errors->has('exemption_limit_individual') ? 'btn-outline-danger' : '' }}" style="margin-right: 0px;">
                           </div>

                           <!-- <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputPassword4">Joint:</label>
                           <div class="input-group d-flex">
                              <span class="input-group-text" id="basic-addon2" style="margin-left: 0px;">$</span>
                              <input name="exemption_limit_joint" id="joint" type="text" value=" " class="price-field-exemption form-control {{ $errors->has('exemption_limit_joint') ? 'btn-outline-danger' : '' }}" style="margin-right: 0px;">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label>Relate:</label>
                        <input value="" type="text" class="form-control mb-4" placeholder="" name="relate">
                     </div>

                  </div>
                  <!-- <div class="col-sm-12">
      					<div class="form-group">
                     <label>Exemption Limit:</label>
                        <input  value="{{ old('exemption_limit') }}" type="text" class="form-control mb-4 {{ $errors->has('exemption_limit') ? 'btn-outline-danger' : '' }}" placeholder="Exemption Limit" name="exemption_limit" required>
                     </div>
                        @if ($errors->has('exemption_limit'))
                        <p class="help-block text-danger">{{ $errors->first('exemption_limit') }}</p>
                        @endif
                  </div> -->
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
         .form-check.ltd-opti {
	padding-left: 0;
	display: flex;
	justify-content: space-between;
	padding-right: 5px;
	gap: 10px;
}

.modal-content .form-group .radio-primary .cr {
	margin-bottom: 0;
	margin-left: .3rem;
}
      </style>
      <script>
         $(document).ready(function() {

            $("#add_exemption_form").validate({

               errorPlacement: function(error, element) {
                  if ($(element).parents(".form-group").next('label').hasClass('error')) {

                     $(element).parents(".form-group").next('label').remove();
                     $(element).parents(".form-group").after($(error)[0].outerHTML);
                  } else {

                     $(element).parents(".form-group").after($(error)[0].outerHTML);
                  }
               },
               success: function(label, element) {
                  label.parent().removeClass('error');

                  $(element).parents(".form-group").next('label').remove();
               },
            });
            $("#unlimited:checkbox").change(function() {
               var ischecked = $(this).is(':checked');
               if (!ischecked)
                  $('#individual').val('') && $('#joint').val('')
               else
                  $('#individual').val('unlimited') && $('#joint').val('unlimited')

            });

            $(".price-field-exemption").on({
               keyup: function() {
                  formatCurrency($(this));
               },
               blur: function() {
                  formatCurrency($(this), "blur");
               }
            });


            function formatCurrency(input, blur) {
               // appends $ to value, validates decimal side
               // and puts cursor back in right position.
               // get input value
               var input_val = input.val();
               // don't validate empty input
               if (input_val === "") {
                  return;
               }
               // original length
               var original_len = input_val.length;
               // initial caret position
               var caret_pos = input.prop("selectionStart");
               // check for decimal
               if (input_val.indexOf(".") >= 0) {
                  // get position of first decimal
                  // this prevents multiple decimals from
                  // being entered
                  var decimal_pos = input_val.indexOf(".");
                  // split number by decimal point
                  var left_side = input_val.substring(0, decimal_pos);
                  var right_side = input_val.substring(decimal_pos);
                  // add commas to left side of number
                  left_side = formatNumber(left_side);
                  // validate right side
                  right_side = formatNumber(right_side);
                  // On blur make sure 2 numbers after decimal
                  if (blur === "blur") {
                     right_side += "00";
                  }
                  // Limit decimal to only 2 digits
                  right_side = right_side.substring(0, 2);
                  // join number by .
                  input_val = left_side + "." + right_side;
               } else {
                  // no decimal entered
                  // add commas to number
                  // remove all non-digits
                  input_val = formatNumber(input_val);
                  // final formatting
                  if (blur === "blur") {
                     input_val += ".00";
                  }
               }
               // send updated string to input
               input.val(input_val);
               // put caret back in the right position
               var updated_len = input_val.length;
               caret_pos = updated_len - original_len + caret_pos;
               input[0].setSelectionRange(caret_pos, caret_pos);
            }

            function formatNumber(n) {
               return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
         });
      </script>
   </div>
</div>
<!-- [ Main Content ] end -->
@endsection