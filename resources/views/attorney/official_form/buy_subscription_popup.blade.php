<?php $package_id = $needPackage;  ?>
<?php $packageDetailedLabel = \App\Models\AttorneySubscription::addonNameArrayForBuyPopup($needPackage); ?>

<div class="modal-content modal-content-div profitlosspopup profitpopup conditional-ques">
    <div class="modal-header align-items-center py-2">
        <div class="row w-100 m-0">
            <div class="col-12">
                <h5 class="modal-title d-flex">
                    {{$packageName}}
                </h5>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <div class="card-body light-gray-div mt-2 mb-1">
            <h2>Subscription/Add-On Info</h2>
            <div class="row ">
                <?php if (!empty($packageDetailedLabel)) { ?>
                <div class="col-12 col-md-12">
                    <h4 class="text-c-blue text-bold text-center mb-3"><?php echo $packageDetailedLabel; ?></h4>
                </div>
                <?php } ?>
                <div class="col-12 col-md-12">
                    <div class="availabe mb-3" style="border-radius: 8px;">
                        <h4 class="text-bold text-center mb-0">You have {{$availableCount}} available to add {{$packageName}}</h4>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <?php if ($availableCount > 0) { ?>
                        <form method="post" id="subscription_purchase_popup" action="{{route('add_package_to_client')}}">
                            @csrf
                            <input type="hidden" name="package_id" value="{{$needPackage}}">
                            <input type="hidden" name="package_name" value="{{$packageName}}">
                            <input type="hidden" name="package_count" value="1">
                            <input type="hidden" name="client_id" value="{{$client_id}}">
                            <div class="d-flex">
                                <button type="submit" class=" btn-new-ui-default print-hide submitButton cursor-pointer mb-0 ml-auto">{{ __('Click to add') }}</button>
                            </div>
                        </form>
                    <?php } else {
                        $url = route('attorney_profile', ['tab' => 4, 'package' => $needPackage]); ?>
                        <div class="d-flex">
                            <a href="javascript:void(0)" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 ml-auto purchase-btn">
                                <span>Click to purchase</span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    purchasePackage = function(event) {
        event.preventDefault();
        var $this = $(this);

        if ($this.hasClass('disabled')) return; // Prevent multiple clicks
        $this.addClass('disabled').text('Processing…'); // Change text & disable

        ajaxurl = "<?php echo route('purchase_package_add_to_client'); ?>";
        laws.ajax(ajaxurl, {
            client_id: '<?php echo $client_id; ?>',
            package_id: '<?php echo $package_id; ?>'
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
                $this.removeClass('disabled').text('Click to purchase'); // Re-enable on failure
            } else if (res.status == 1) {
                $(document).trigger('close.facebox');
                $.systemMessage(res.msg, 'alert--success', true);
                window.location.reload();
            }
        });
    };

    // Bind the click event properly
    $(document).on('click', '.purchase-btn', purchasePackage);
</script>
<style>
    #facebox .content.fbminwidth {
        min-width: 450px;
        min-height: 350px;
    }

    .availabe {
        padding: 20px;
        background: #efefef;
        color: #000;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
    }

    .float-right {
        float: right;
    }

    .subscription_heading {
        color: #012cae;
        font-size: 24px;
    }

    .popup {
        margin-top: 30px;
    }
</style>