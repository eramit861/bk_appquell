
<div class="row">
    <div class="col-md-12">
        <form action="{{route('attorney_subscription')}}" method="post" novalidate enctype="multipart/form-data"  id="subscripion_new_addons">
        @csrf
        <div class="row px-3">
                <div class="col-md-12">
                    <h5><span class="border-bottom-light-blue">Please select questionnaire(s) and/or add-on features</span></h5>
                </div>
                @php $i = 1; @endphp
                @foreach ($package_array as $packageId => $packageData)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                    <label class="custom-card package package-{{ $packageId }} mt-2">
                        <input  onclick="calculateandaddPrice(this,'package-amount','{{ $packageData[$packageId] }}','1')" class="packages" data-packclass="package-amount" data-packageamount="{{ $packageData[$packageId] }}" type="radio" name="package" value="{{ $packageId }}">
                        <span class="radio-btn sub-package">
                        <i class="fas fa-check"></i>
                        <div class="package-desc">
                            <p class="text-bold">
                                {{ \App\Models\AttorneySubscription::allPackageNameByIdArray($packageId) }}
                                (${{ $packageData[$packageId] }})
                            </p>
                            <input type="hidden" name="package-price-{{ $packageId }}" value="{{ $packageData[$packageId] }}">
                        </div>
                        </span>
                    </label>
                </div>
                @php $i++; @endphp
                @endforeach
                <div class="col-md-11 addon-radio-btn pr-custom pl-4">
                    <div class="radio_btn mb-3 mt-3">
                        <div class="d-flex">
                            <div class="">
                                <label class="mb-0">Do you want to purchase additional features/options (such as Joint Questionnaire, Payroll Assistant, Concierge service etc.)</label>
                            </div>
                            <div class=" w-30">
                                <div class=" float-end">
                                    <input type="radio" name="addons" class=" mr-1" id="yes" value="1">
                                    <label class="mb-0 " for="yes">Yes</label>
                                    <input type="radio" name="addons" class=" ml-4 mr-1" id="no" value="0">
                                    <label class="mb-0" for="no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row addon-package hide-data mt-1"></div>
                </div>
                <div class="col-md-12 p-3">
                    <table class="w-100">
                        <tr>
                            <td class="text-bold w-83"><span class="float-right">Please Select Number of Client(s):</span></td>
                            <td class=""><span class="float-right"></span>
                                <select class="required form-control w-auto float-right no-select h-auto" name="no_of_clients" id="no_of_clients">
                                    <!-- <option disabled>How many?</option> -->
                                    @for ($i = 1; $i <= 50; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Package:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price package-amount">0.00</span></span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-bold"><span class="float-right">Joint Married Total:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price joint-married-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Paralegal Assistant:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price paralegal-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Petition Prepration:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price petition-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Payroll Assistant:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price payroll-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Bank Statement Assistant:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price bank-statement-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Bank Statement Assistant Premium:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price bank-statement-premium-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Profit Loss Assistant:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price profit-loss-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Standard Concierge Service:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="addon_price concierge-service-amount">0.00</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><span class="float-right">Total:</span></td>
                            <td class="">
                                <span class="float-right ">$<span class="total-amount">0.00</span></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12  scales_p ">
                <div class="form-group">
                    <input type="checkbox" id="scales" name="scales" required>

                    <label for="scales" >
                        <a class="link-underline text-blue" href="{{route('terms_of_services')}}" target="_blank">
                            By purchase, you confirm that you've read and accepted our Terms of Service
                        </a>
                    </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="align-right pr-3">
                        <input type="hidden" name="subscribe" value="1">
                        <a href="javascript:void(0)" onclick="submit()"  class="btn font-weight-bold border-blue-big w-200 font-lg-18 mr-0"><span class="border-bottom-light-blue">Pay for Additional Questionnaire(s) and/or Features </span></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    submit = function(){
        if(!$("input[name='package']:checked").val()){
            alert('Please select at least 1 questionnaire.');
            return false;
        }else if(!$("#scales").prop('checked')){
            alert('Please accept terms and condition.');
            return false;
        }else{
            $("#subscripion_new_addons").submit();
        }
    }
  calculatePrice = function(thisobj,classname,pack_price,frommain=0){
      if(thisobj.checked){
        var clients = $("#no_of_clients").find(":selected").val();

        var total = parseFloat(pack_price)*clients;
        $("."+classname).html(total);
        calculateTotal();
      }else{
        $("."+classname).html("0.00");
        calculateTotal();
      }
  }

  calculateandaddPrice =  function(thisobj,classname,pack_price,frommain=0){
    if($("input[name='addons']").prop('checked')){
        var val = $('input[name="addons"]:checked').val();
        if(val==1){
            var val =  $("input[name='package']:checked").val();
            getAddonPackage(val);
            $(".addon_price").each(function() {
                $(this).html("0.00")
            });
        }
    }else{
        $(".addon_price").each(function() {
            $(this).html("0.00")
        });
    }
      if(thisobj.checked){
        var clients = $("#no_of_clients").find(":selected").val();
        var total = parseFloat(parseFloat(pack_price)*clients).toFixed(2);
        $("."+classname).html(total);
        calculateTotal();
      }else{
        $("."+classname).html("0.00");
        calculateTotal();
      }
  }

        $(document).ready(function(){

        $("input[name='addons']").change(function() {
            if (this.value == "0") {
                $('.addon-package').addClass('hide-data');
                $(".addon-package").empty();
                $(".addon_price").each(function() {
                    if(!$(this).hasClass('package-amount')){
                $(this).html("0.00");
                    }
            });
                calculateTotal();
            } else {
                $('.addon-package').removeClass('hide-data');
                var val =  $("input[name='package']:checked").val();
                getAddonPackage(val);

            }
        });

        calculateTotal = function(){
            var total = 0;
            $(".addon_price").each(function() {
                total += +parseFloat($(this).html());
            });
            $(".total-amount").html(parseFloat(total).toFixed(2));
        }

        $('#no_of_clients').on('change', function() {
            $(".packages").each(function() {
                if($(this).is(':checked')){
                    calculatePrice(this,$(this).data('packclass'),$(this).data('packageamount'));
                }

            });

        });

        getAddonPackage = function(packageId) {
            var url = "{{ route('settingsPopupSubPackageArray') }}";
            laws.ajax(url, { packageId: packageId }, function(response) {
                var res = JSON.parse(response);
                if (res.status == 0) {
                    $('.addon-package').addClass('hide-data');
                } else {
                    $('.addon-package').removeClass('hide-data');
                    $(".addon-package").html(res.returnHTML);
                }
            });
        }

    });

</script>
