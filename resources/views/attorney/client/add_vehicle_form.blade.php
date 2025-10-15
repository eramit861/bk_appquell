<div class="modal-content modal-content-div conditional-ques">
   <div class="modal-header align-items-center py-2">
      <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
         Add new Vehicle
      </h5>
   </div>

   <form name="client_vehicle_step1" id="client_vehicle_step1" action="{{route('manual_vehicle_setup')}}" method="post">
      @csrf
      <div class="light-gray-div  mt-4 mx-3 ">
         <h2>Vehicle details</h2>
         <?php $i = 0; ?>
         <input type="hidden" name="report_id" value="{{@$report_id}}" />
         <input type="hidden" name="client_id" value="{{@$client_id}}" />
         <input type="hidden" name="property_vehicle[own_any_property][<?php echo $i; ?>]" value="1">
         <div class="row gx-3 getOwnTypeProperty">
            <div class="col-7">
               <div class="label-div">
                  <div class="form-group">
                     <label>{{ __('Vehicle') }} <span class="vehicleno"></span></label>
                     <select id="vehicle_<?php echo $i; ?>" onchange="changeVehicle(this, <?php echo $i; ?>)" class="form-control property_type required" name="property_vehicle[property_type][<?php echo $i; ?>]">
                        <option value=""></option>
                        <?php echo Helper::getVehiclesClientSelections(); ?>
                     </select>
                  </div>
               </div>
            </div>
            <div class="col-5">
               <div class="label-div">
                  <div class="form-group mb-0">
                     <label>{{ __('Estimated') }} <strong> {{ __('Value of') }} </strong>{{ __('Property') }}</label>
                     <input type="number" class="form-control price-field required vehicle_property_estimated_value"
                        placeholder="{{ __('Property value') }}" name="property_vehicle[property_estimated_value][<?php echo $i; ?>]" value="">
                  </div>
                  <label for="">
                     <small>
                        <span>
                           {{ __('You can find out the value of your car here') }} <a target="_blank" href="https://www.kbb.com">{{ __('kbb.com') }}</a> and/or <a href="https://www.nada.com" target="_blank">nada.com</a>
                        </span>
                     </small>
                  </label>
               </div>
            </div>

            <div class="col-12 ">
               <div class="light-gray-box-tittle-div mb-3 pb-1">
                  <h2>Description</h2>
               </div>
            </div>

            <div class="col-7">
               <div class="label-div">
                  <div class="form-group mb-0">
                     <label for="">VIN number</label>
                     <input type="text" placeholder="{{ __('Enter VIN number') }}" value="" name="property_vehicle[vin_number][<?php echo $i; ?>]" id="vin_<?php echo $i; ?>" class="form-control vin_number">
                  </div>
                  <a class="w-100 link_vin mt-1" href="javascript:void(0)" id="link_vin_<?php echo $i; ?>" onclick="checkVinNumber(this)">{{ __('Fetch info from vin number') }}</a>
               </div>
            </div>

            <div class="col-5"></div>

            <div class="col-2">
               <div class="label-div">
                  <div class="form-group">
                     <label>{{ __('Year') }}
                     </label>
                     <input type="text" class="form-control required vehicle_property_year"
                        placeholder="{{ __('Year') }}" name="property_vehicle[property_year][<?php echo $i; ?>]" value="">
                  </div>
               </div>
            </div>
            <div class="col-3">
               <div class="label-div">
                  <div class="form-group">
                     <label>{{ __('Make') }}
                     </label>
                     <input type="text" class="form-control required vehicle_property_make"
                        placeholder="{{ __('Make') }}" name="property_vehicle[property_make][<?php echo $i; ?>]" value="">
                  </div>
               </div>
            </div>
            <div class="col-3">
               <div class="label-div">
                  <div class="form-group">
                     <label>{{ __('Model') }}
                     </label>
                     <input type="text" class="form-control required vehicle_property_model"
                        placeholder="{{ __('Model') }}" name="property_vehicle[property_model][<?php echo $i; ?>]" value="">
                  </div>
               </div>
            </div>
            <div class="col-2">
               <div class="label-div">
                  <div class="form-group">
                     <label>{{ __('Mileage') }}
                     </label>
                     <input type="text" class="form-control required mileage_field vehicle_property_mileage"
                        placeholder="{{ __('Mileage') }}" name="property_vehicle[property_mileage][<?php echo $i; ?>]" value="">
                  </div>
               </div>
            </div>
            <div class="col-2">
               <div class="label-div">
                  <div class="form-group">
                     <label>{{ __('Style of vehicle') }}
                     </label>
                     <input type="text" class="form-control required vehicle_property_other_info"
                        placeholder="{{ __('Other information') }}" name="property_vehicle[property_other_info][<?php echo $i; ?>]" value="">
                  </div>
               </div>
            </div>

            <div class="col-4">
               <div class="label-div">
                  <div class="form-group">
                     <label class="d-block">{{ __('Would you like to retain the above property?') }}
                     </label>
                     <div class="d-inline-flex radio-primary">
                        <input type="radio" required id="retain_above_property_yes_<?php echo $i; ?>"
                           class="currently_lived" name="property_vehicle[retain_above_property][<?php echo $i; ?>]" value="1">
                        <label for="retain_above_property_yes_<?php echo $i; ?>" class="cr">{{ __('Yes') }}</label>
                     </div>
                     <div class="d-inline-flex radio-primary">
                        <input type="radio" required id="retain_above_property_no_<?php echo $i; ?>"
                           class="currently_lived" name="property_vehicle[retain_above_property][<?php echo $i; ?>]" value="0">
                        <label for="retain_above_property_no_<?php echo $i; ?>" class="cr">{{ __('No') }}</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-8 vehile_own_by">
               <div class="label-div">
                  <div class="form-group">
                     <label class="d-block"><strong> {{ __('Owned by:') }}</strong>
                        <span style="font-size:12px;">{{ __('You, your spouse, both you and your spouse, you and at least one person other than your spouse.') }}</span>
                     </label>
                     <div class="d-inline-flex radio-primary">
                        <input onchange="vehicle_toggle_own_by(1,this)" type="radio" required id="owned_by_vehicle_you"
                           class="own_by_property" name="property_vehicle[own_by_property][<?php echo $i; ?>]" value="1">
                        <label for="owned_by_vehicle_you" class="cr">
                           {{ __('You') }}</label>
                     </div>
                     <div class="d-inline-flex radio-primary">
                        <input onchange="vehicle_toggle_own_by(2,this)" type="radio" required id="owned_by_vehicle_spouse"
                           class="own_by_property" name="property_vehicle[own_by_property][<?php echo $i; ?>]" value="2">
                        <label for="owned_by_vehicle_spouse" class="cr">
                           {{ __('Spouse') }}</label>
                     </div>
                     <div class="d-inline-flex radio-primary">
                        <input onchange="vehicle_toggle_own_by(3,this)" type="radio" required id="owned_by_vehicle_joint"
                           class="own_by_property" name="property_vehicle[own_by_property][<?php echo $i; ?>]" value="3">
                        <label for="owned_by_vehicle_joint" class="cr">
                           {{ __('Joint') }}</label>
                     </div>
                     <div class="d-inline-flex radio-primary">
                        <input onchange="vehicle_toggle_own_by(4,this)" type="radio" required id="owned_by_vehicle_other"
                           class="own_by_property" name="property_vehicle[own_by_property][<?php echo $i; ?>]" value="4">
                        <label for="owned_by_vehicle_other" class="cr">
                           {{ __('Other') }}</label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-12 vehicle_codebtor_cosigner_data hide-data" id="vehicle_codebtor_cosigner_data">
               <div class="row">
                  <div class="col-4">
                     <div class="label-div">
                        <div class="form-group">
                           <label>{{ __('Codebtor Name') }} </label>
                           <input type="text" class="form-control cosigner_vehicle_creditor_name required" name="property_vehicle[codebtor_creditor_name][<?php echo $i; ?>]" placeholder="{{ __('Codebtor Name') }}" value="">
                        </div>
                     </div>
                  </div>
                  <div class="col-8">
                     <div class="label-div">
                        <div class="form-group">
                           <label>{{ __('Street Address') }}</label>
                           <input type="text" class="form-control cosigner_vehicle_creditor_name_addresss required" name="property_vehicle[codebtor_creditor_name_addresss][<?php echo $i; ?>]" placeholder="{{ __('Street Address') }}" value="">
                        </div>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="label-div">
                        <div class="form-group">
                           <label>{{ __('City') }}</label>
                           <input type="text" class="form-control cosigner_vehicle_creditor_city required" name="property_vehicle[codebtor_creditor_city][<?php echo $i; ?>]" placeholder="{{ __('City') }}" value="">
                        </div>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="label-div">
                        <div class="form-group">
                           <label>{{ __('State') }}</label>
                           <select class="form-control cosigner_vehicle_creditor_state required" name="property_vehicle[codebtor_creditor_state][<?php echo $i; ?>]">
                              <option value="">{{ __('Please Select State') }}</option>
                              <?php echo AddressHelper::getStatesList(); ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="label-div">
                        <div class="form-group">
                           <label>{{ __('Zip Code') }}</label>
                           <input type="number" class="form-control allow-5digit cosigner_vehicle_creditor_zip required" name="property_vehicle[codebtor_creditor_zip][<?php echo $i; ?>]" placeholder="Zip" value="">
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
      <div class="bottom-btn-div mx-3 mb-3 w-auto">
         <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default"><span class="">Save</span></button>
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
   function vehicle_toggle_own_by(value, obj) {
      if (value == 2 || value == 4) {
         $(obj).parents('.vehile_own_by').next('.vehicle_codebtor_cosigner_data').removeClass("hide-data");
         $("input[name='property_vehicle[codebtor_creditor_name][0]']").prop('required', true);
         $("input[name='property_vehicle[codebtor_creditor_name_addresss][0]']").prop('required', true);
         $("input[name='property_vehicle[codebtor_creditor_city][0]']").prop('required', true);
         $("select[name='property_vehicle[codebtor_creditor_state][0]']").prop('required', true);
         $("input[name='property_vehicle[codebtor_creditor_zip][0]']").prop('required', true);
         // document.getElementById('own_property_data').classList.remove("hide-data");
      } else if (value == 1 || value == 3) {
         $(obj).parents('.vehile_own_by').next('.vehicle_codebtor_cosigner_data').addClass("hide-data");
         // document.getElementById('own_property_data').classList.add("hide-data");
         $("input[name='property_vehicle[codebtor_creditor_name][0]']").prop('required', false);
         $("input[name='property_vehicle[codebtor_creditor_name_addresss][0]']").prop('required', false);
         $("input[name='property_vehicle[codebtor_creditor_city][0]']").prop('required', false);
         $("select[name='property_vehicle[codebtor_creditor_state][0]']").prop('required', false);
         $("input[name='property_vehicle[codebtor_creditor_zip][0]']").prop('required', false);
      }
   }


   $(document).ready(function() {


      $("#client_vehicle_step1").validate({

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
   });

   function checkVinNumber(cobj) {
      var this_id = $(cobj).attr('id');

      var attri = this_id.split('_');
      var thisnum = attri[2];

      var vin_number = $("input[name='property_vehicle[vin_number][" + thisnum + "]']").val();
      if (vin_number == '') {
         alert("VIN Number is required");
         return false;
      }

      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: '<?php echo route("attorney_fetch_vin_number"); ?>',
         data: {
            vin_number: vin_number
         },
         dataType: 'json',
         type: 'post',
         success: function(json) {
            if (json.status == false) {
               alert(json.message);
            } else {
               $("input[name='property_vehicle[property_year][" + thisnum + "]']").val(json.data.year);
               $("input[name='property_vehicle[property_make][" + thisnum + "]']").val(json.data.make);
               $("input[name='property_vehicle[property_model][" + thisnum + "]']").val(json.data.model);
               $("input[name='property_vehicle[property_other_info][" + thisnum + "]']").val(json.data.trim);

            }

         },
      });



   }
</script>