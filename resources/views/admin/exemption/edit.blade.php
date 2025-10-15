@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
   <!--[ Recent Users ] start-->
   <div class="col-xl-12 col-md-12">
      <div class="card listing-card">
         <div class="card-header">
            <h4>Edit Exemption</h4>
         </div>
         <div class="card-block ">
            <form action="{{route('exemption_update', $exemption->id)}}" id="exemption_form" method="post">
               @csrf
               <div class="container">
                  <div class="form-group">
                     <label>Choose district</label>
                     <select class="form-control" name="state_name" id="state_name">
                     <?php echo AddressHelper::getStatesList($exemption->state_name); ?>
                     </select>
                     @if ($errors->has('state_name'))
                     <p class="help-block text-danger">{{ $errors->first('state_name') }}</p>
                     @endif
                  </div>
                  <div class="form-group cs-check-inh">
                     <label>Choose Exemptions Type:</label><br>
                     <div class="d-inline radio-primary">
                        <input type="radio" <?php if ($exemption->exemption_type == 'State') {
                            echo "checked='checked'";
                        } ?> id="is_exemptions_state" name="exemption_type" value="State" class="required is_exemptions" required />
                        <label for="is_exemptions_state" class="cr">State</label>
                     </div>
                     <div class="d-inline radio-primary">
                        <input type="radio" <?php if ($exemption->exemption_type == 'Federal') {
                            echo "checked='checked'";
                        } ?> id="is_exemptions_federal" name="exemption_type" value="Federal" class="required is_exemptions" required />
                        <label for="is_exemptions_federal" class="cr">Federal</label>
                     </div>
                     @if ($errors->has('exemption_type'))
                     <p class="help-block text-danger">{{ $errors->first('exemption_type') }}</p>
                     @endif
                  </div>
                  <div class="form-group">
                     <label>Exemption description</label>
                     <input required type="text" class="form-control {{ $errors->has('exemption_description') ? 'btn-outline-danger' : '' }}" placeholder="Exemption description" name="exemption_description" value="{{old('exemption_description', $exemption->exemption_description)}}">
                     @if ($errors->has('exemption_description'))
                     <p class="help-block text-danger">{{ $errors->first('exemption_description') }}</p>
                     @endif
                  </div>
                  <div class="form-group">
                     <label>Exemption statute</label>
                     <input required type="text" class="form-control {{ $errors->has('exemption_statute') ? 'btn-outline-danger' : '' }}" placeholder="Exemption statute" name="exemption_statute" value="{{old('exemption_statute', $exemption->exemption_statute)}}">
                     @if ($errors->has('exemption_statute'))
                     <p class="help-block text-danger">{{ $errors->first('exemption_statute') }}</p>
                     @endif
                  </div>
                  <div class="col-sm-12 pl-0 pr-0">
                     <div class="form-check ltd-opti">
                        <label>Exemption Limit:</label>
                        <div class="check_pnts"><input class="form-check-input position-static" type="checkbox" id="unlimited" value="unlimited" aria-label="..."> <label for="inputEmail4">Unlimited</label> </div>
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="inputEmail4">Individial:</label>
                           <div class="input-group d-flex">
                              <span class="input-group-text" id="basic-addon2" style="margin-left: 0px;">$</span>
                              <input name="exemption_limit_individual" id="individual" type="text" value="{{old('exemption_limit_individual', $exemption->exemption_limit_individual)}}" class="price-field-exemption form-control {{ $errors->has('exemption_limit_individual') ? 'btn-outline-danger' : '' }}" style="margin-right: 0px;">
                              @if ($errors->has('exemption_limit_individual'))
                              <p class="help-block text-danger">{{ $errors->first('exemption_limit_individual') }}</p>
                              @endif
                           </div>

                           <!-- <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputPassword4">Joint:</label>
                           <div class="input-group d-flex">
                              <span class="input-group-text" id="basic-addon2" style="margin-left: 0px;">$</span>
                              <input name="exemption_limit_joint" id="joint" type="text" value="{{old('exemption_limit_joint', $exemption->exemption_limit_joint)}}" class="price-field-exemption form-control {{ $errors->has('exemption_limit_joint') ? 'btn-outline-danger' : '' }}" style="margin-right: 0px;">
                              @if ($errors->has('exemption_limit_joint'))
                              <p class="help-block text-danger">{{ $errors->first('exemption_limit_joint') }}</p>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  
                     <div class="form-group">
                        <label>Relate:</label>
                        <input value="{{old('relate', $exemption->relate)}}" type="text" class="form-control mb-4" placeholder="" name="relate">
                     </div>

                 
                  <!-- <div class="form-group">
                     <label>Exemption Limit</label>
                     <input required type="text" class="form-control {{ $errors->has('exemption_limit') ? 'btn-outline-danger' : '' }}" placeholder="Exemption Limit" name="exemption_limit" value="{{old('exemption_limit', $exemption->exemption_limit)}}">
                     @if ($errors->has('exemption_limit'))
                     <p class="help-block text-danger">{{ $errors->first('exemption_limit') }}</p>
                     @endif
                  </div> -->
                  <div class="form-group">
                     <a href="{{route('exemption_list')}}" class="btn btn-theme-black">Back</a>
                     <button type="submit" class="btn btn-theme-black">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--[ Recent Users ] end-->
</div>
<script>
   $(document).ready(function() {

      $("#exemption_form").validate({

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
<style>
   label.error {
      color: red;
      font-style: italic;
   }
   .form-check.ltd-opti {
	display: flex;
	align-items: center;
	gap: 10px;
	padding-left: 0;
	justify-content: space-between;
	padding-right: 5px;
}
.form-group.cs-check-inh .radio-primary label {
	margin-bottom: 0;
	margin-left: .3rem;
}
</style>
<!-- [ Main Content ] end -->
@endsection