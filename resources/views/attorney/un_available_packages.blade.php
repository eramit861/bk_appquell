<div class="profitlosspopup  profitpopup" style="padding:30px;"> 
    <div class="row no-border-elements" >
        <div class="col-md-12 align-center d-flex pop_tile_main">
            <h1 class="subscription_heading"><strong>{{ __('Please Buy below subscriptions before invite client') }}</strong></h1>
        </div>
        
    </div>

    <div class="row no-border-elements mt-3">
        <!-- First half-->
        <div class="col-md-12 align-left">
                <div class="availabe mt-3 mb-3">
                    <table width='100%'><tr>
                        <th>{{ __('Package Name') }}</th><th>{{ __('Quantity') }}</th><th>SubTotal</th>
                </tr>
                        <?php
                        $tottalPriceTobeCharge = 0;
                        $packages = array_filter($notAvailablePackages);
                        foreach ($notAvailablePackages as $package) {
                            $price = 0;
                            if (isset($package['id']) && $package['id'] > 0) {
                                $price = \App\Models\AttorneySubscription::allPackagePriceArray($package['id']);
                                $price = $price * $package['unit'];
                                $tottalPriceTobeCharge = $tottalPriceTobeCharge + (float)$price;
                                echo "<tr><td>".$package['name']."</td><td>".$package['unit']."</td><td>".$price."</td></tr>";
                            }
                        }
                        ?>
                        <tr><td colspan='4'>&nbsp;</td></tr>
                        <tr style="font-weight:bold;"><td colspan='2'>{{ __('Total Price Payble:') }} </td><td>${{$tottalPriceTobeCharge}}</td></tr>

                    </table>
                </div>
               
            </div>
            <div class="col-md-12 align-right">
            <a href="javascript:void(0)" onclick="submitInviteForm()" class="btn font-weight-bold border-blue-big f-12 float-right">{{ __('Click to purchase') }}</a>    
           </div>
        </div>
</div>


<style>

.subscription_heading{color:#012cae; font-size: 24px;}
.popup{margin-top: 30px;}
.float-right{float:right;}
#facebox .content.fbminwidth {
    min-width: 450px;
min-height: 350px;
}
    .availabe{padding:20px;background:#efefef;color:#000; text-align:left;}
</style>
<script>
    submitInviteForm = function(){
        	
	ajaxurl = "<?php echo route('purchase_package_for_attorney'); ?>";
	laws.ajax(ajaxurl, { packages:'<?php echo json_encode($packages);?>'}, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        }else if(res.status == 1){
            $.systemMessage(res.msg, 'alert--success', true);
            $(document).trigger('close.facebox');
            $("#invite_form").submit();
        }
	});
      
    }
</script>