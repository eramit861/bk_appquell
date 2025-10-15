
<?php
    $i = 1;
foreach ($sub_package_array as $packageId => $packageData) {
    ?>
    <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6">
        <label class="custom-card addon package-<?php echo $packageId;?> mt-2">
            <input data-packclass="<?php echo $sub_package_class_array[$packageId]; ?>" onclick="calculatePrice(this,'<?php echo $sub_package_class_array[$packageId]; ?>','<?php echo $packageData; ?>')" data-packageamount="<?php echo $packageData; ?>"  type="checkbox" name="sub_package[]" class="packages" value="<?php echo $packageId;?>">
            <span class="radio-btn sub-package">
            <i class="fas fa-check"></i>
            <div class="package-desc">
                <p class="text-bold">
                    <?php echo \App\Models\AttorneySubscription::allPackageNameByIdArray($packageId);?> 
                    ($<?php echo $packageData;?>)
                </p>
                <input type="hidden" name="addon-price" value="<?php echo $packageData;?>">
            </div>
            </span>
        </label>

    </div>
      
<?php
        $i++;
}
?>




