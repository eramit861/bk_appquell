<h3 class="col-md-12 text-center">VEHICLE INFORMATION</h3>

<h3 class="underline">PLEASE LIST ALL VEHICLES REGISTERED IN YOUR NAME</h3>

<p>Vehicles include all cars, trucks, motorcycles, RVs, ATVs, and trailers (anything that is required to be titled and/or
    registered with the MVD). Do NOT list leased vehicles. List all vehicles even if there is a lien against the vehicle.
    You can obtain the trade-in Kelley Blue Book value from KBB.com.</p>

<p class="underline m-1 p-0 text_italic">Examples</p>
<div class="col-md-12 row text_italic">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-2 w-auto">Year:</div>
            <div class="col-md-4 w-auto underline">2006</div>
            <div class="col-md-2 w-auto">Make:</div>
            <div class="col-md-4 w-auto underline">Toyota</div>
        </div>

        <div class="row col-md-12">
            <div>Model:</div>
            <div class="col-md-2 w-auto underline">Camry</div>
        </div>

        <div class="row col-md-12">
            <div>Trim/Style/Body:</div>
            <div class="col-md-4 w-auto underline">SE, Sedan</div>
        </div>

        <div class="row col-md-12">
            <div>Month/Year purchased:</div>
            <div class="col-md-4 w-auto underline">10/07</div>
        </div>

        <div class="row col-md-12">
            <div>Mileage:</div>
            <div class="col-md-4 w-auto underline">36,524</div>
        </div>

        <div class="col-md-12">
            <div class="row">Condition (Circle 1): Good <span class="underline mx-3">Fair</span> Poor </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-2 w-auto">Year:</div>
            <div class="col-md-4 w-auto underline">2008</div>
            <div class="col-md-2 w-auto">Make:</div>
            <div class="col-md-4 w-auto underline">Ford</div>
        </div>

        <div class="row col-md-12">
            <div>Model:</div>
            <div class="col-md-4 w-auto underline">F150 Super Cab</div>
        </div>

        <div class="row col-md-12">
            <div>Trim/Style/Body:</div>
            <div class="col-md-4 w-auto underline">XL, 4 Door, 6 ½ ft bed</div>
        </div>

        <div class="row col-md-12">
            <div>Month/Year purchased:</div>
            <div class="col-md-4 w-auto underline">6/10</div>
        </div>

        <div class="row col-md-12">
            <div>Mileage:</div>
            <div class="col-md-4 w-auto underline">62,876</div>
        </div>

        <div class="col-md-12">
            <div class="row">Condition (Circle 1): <span class="underline">Good</span><span class="mx-3">Fair</span> Poor </div>
        </div>
    </div>
</div>

<div class="mt-4 row col-md-12">
    <?php $property = !empty(Helper::validate_key_value(0, $propertyvehicle)) ? Helper::validate_key_value(0, $propertyvehicle) : [];?>
    <div class="col-md-6 border_1px p-3 bb-0">
        <div class="underline text-bold mb-2">VEHICLE #1</div>
        <div class="row mb-2">
            <div class="col-md-3">Year:</div>
            <div class="col-md-3"><input class="form-control" type="text" name="<?php echo base64_encode('text1'); ?>" value="<?php echo Helper::validate_key_value('property_year', $property); ?>"></div>
            <div class="col-md-2">Make:</div>
            <div class="col-md-4"><input class="form-control" type="text" name="<?php echo base64_encode('text2'); ?>" value="<?php echo Helper::validate_key_value('property_make', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">Model:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text3'); ?>" value="<?php echo Helper::validate_key_value('property_model', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Trim/Style/Body:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text4'); ?>" value="<?php echo Helper::validate_key_value('property_other_info', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Month/Year purchased:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text5'); ?>" value="<?php echo Helper::validate_key_value('', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Mileage:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text6'); ?>" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">KBB Value:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text7'); ?>" value="<?php echo Helper::validate_key_value('property_estimated_value', $property); ?>"></div>
        </div>
        <div class="row">
            <div class="col-md-12">Condition (Circle 1): Good <span class="mx-3">Fair</span>Poor</div>
        </div>
    </div>
    <?php $property = !empty(Helper::validate_key_value(1, $propertyvehicle)) ? Helper::validate_key_value(1, $propertyvehicle) : []; ?>
    <div class="col-md-6 border_1px p-3 bb-0 bl-0">
        <div class="underline text-bold mb-2">VEHICLE #2</div>
        <div class="row mb-2">
            <div class="col-md-3">Year:</div>
            <div class="col-md-3"><input class="form-control" type="text" name="<?php echo base64_encode('text8'); ?>" value="<?php echo Helper::validate_key_value('property_year', $property); ?>"></div>
            <div class="col-md-2">Make:</div>
            <div class="col-md-4"><input class="form-control" type="text" name="<?php echo base64_encode('text9'); ?>" value="<?php echo Helper::validate_key_value('property_make', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">Model:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text10'); ?>" value="<?php echo Helper::validate_key_value('property_model', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Trim/Style/Body:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text11'); ?>" value="<?php echo Helper::validate_key_value('property_other_info', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Month/Year purchased:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text12'); ?>" value="<?php echo Helper::validate_key_value('', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Mileage:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text13'); ?>" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">KBB Value:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text14'); ?>" value="<?php echo Helper::validate_key_value('property_estimated_value', $property); ?>"></div>
        </div>
        <div class="row">
            <div class="col-md-12">Condition (Circle 1): Good <span class="mx-3">Fair</span> Poor</div>
        </div>
    </div>
    <?php $property = !empty(Helper::validate_key_value(2, $propertyvehicle)) ? Helper::validate_key_value(2, $propertyvehicle) : []; ?>
    <div class="col-md-6 border_1px p-3 bb-0">
        <div class="underline text-bold mb-2">VEHICLE #3</div>
        <div class="row mb-2">
            <div class="col-md-3">Year:</div>
            <div class="col-md-3"><input class="form-control" type="text" name="<?php echo base64_encode('text15'); ?>" value="<?php echo Helper::validate_key_value('property_year', $property); ?>"></div>
            <div class="col-md-2">Make:</div>
            <div class="col-md-4"><input class="form-control" type="text" name="<?php echo base64_encode('text16'); ?>" value="<?php echo Helper::validate_key_value('property_make', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">Model:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text17'); ?>" value="<?php echo Helper::validate_key_value('property_model', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Trim/Style/Body:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text18'); ?>" value="<?php echo Helper::validate_key_value('property_other_info', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Month/Year purchased:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text19'); ?>" value="<?php echo Helper::validate_key_value('', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Mileage:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text20'); ?>" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">KBB Value:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text21'); ?>" value="<?php echo Helper::validate_key_value('property_estimated_value', $property); ?>"></div>
        </div>
        <div class="row">
            <div class="col-md-12">Condition (Circle 1): Good <span class="mx-3">Fair</span> Poor</div>
        </div>
    </div>
    <?php $property = !empty(Helper::validate_key_value(3, $propertyvehicle)) ? Helper::validate_key_value(3, $propertyvehicle) : []; ?>
    <div class="col-md-6 border_1px p-3 bb-0 bl-0">
        <div class="underline text-bold mb-2">VEHICLE #4</div>
        <div class="row mb-2">
            <div class="col-md-3">Year:</div>
            <div class="col-md-3"><input class="form-control" type="text" name="<?php echo base64_encode('text22'); ?>" value="<?php echo Helper::validate_key_value('property_year', $property); ?>"></div>
            <div class="col-md-2">Make:</div>
            <div class="col-md-4"><input class="form-control" type="text" name="<?php echo base64_encode('text23'); ?>" value="<?php echo Helper::validate_key_value('property_make', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">Model:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text24'); ?>" value="<?php echo Helper::validate_key_value('property_model', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Trim/Style/Body:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text25'); ?>" value="<?php echo Helper::validate_key_value('property_other_info', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Month/Year purchased:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text26'); ?>" value="<?php echo Helper::validate_key_value('', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Mileage:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text27'); ?>" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">KBB Value:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text28'); ?>" value="<?php echo Helper::validate_key_value('property_estimated_value', $property); ?>"></div>
        </div>
        <div class="row">
            <div class="col-md-12">Condition (Circle 1): Good <span class="mx-3">Fair</span> Poor</div>
        </div>
    </div>
    <?php $property = !empty(Helper::validate_key_value(4, $propertyvehicle)) ? Helper::validate_key_value(4, $propertyvehicle) : []; ?>
    <div class="col-md-6 border_1px p-3">
        <div class="underline text-bold mb-2">VEHICLE #5</div>
        <div class="row mb-2">
            <div class="col-md-3">Year:</div>
            <div class="col-md-3"><input class="form-control" type="text" name="<?php echo base64_encode('text29'); ?>" value="<?php echo Helper::validate_key_value('property_year', $property); ?>"></div>
            <div class="col-md-2">Make:</div>
            <div class="col-md-4"><input class="form-control" type="text" name="<?php echo base64_encode('text30'); ?>" value="<?php echo Helper::validate_key_value('property_make', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">Model:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text31'); ?>" value="<?php echo Helper::validate_key_value('property_model', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Trim/Style/Body:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text32'); ?>" value="<?php echo Helper::validate_key_value('property_other_info', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Month/Year purchased:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text33'); ?>" value="<?php echo Helper::validate_key_value('', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Mileage:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text34'); ?>" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">KBB Value:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text35'); ?>" value="<?php echo Helper::validate_key_value('property_estimated_value', $property); ?>"></div>
        </div>
        <div class="row">
            <div class="col-md-12">Condition (Circle 1): Good <span class="mx-3">Fair</span> Poor</div>
        </div>
    </div>
    <?php $property = !empty(Helper::validate_key_value(5, $propertyvehicle)) ? Helper::validate_key_value(5, $propertyvehicle) : []; ?>
    <div class="col-md-6 border_1px p-3 bl-0">
        <div class="underline text-bold mb-2 mb-2">VEHICLE #6</div>
        <div class="row mb-2">
            <div class="col-md-3">Year:</div>
            <div class="col-md-3"><input class="form-control" type="text" name="<?php echo base64_encode('text36'); ?>" value="<?php echo Helper::validate_key_value('property_year', $property); ?>"></div>
            <div class="col-md-2">Make:</div>
            <div class="col-md-4"><input class="form-control" type="text" name="<?php echo base64_encode('text37'); ?>" value="<?php echo Helper::validate_key_value('property_make', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">Model:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text38'); ?>" value="<?php echo Helper::validate_key_value('property_model', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Trim/Style/Body:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text39'); ?>" value="<?php echo Helper::validate_key_value('property_other_info', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Month/Year purchased:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text40'); ?>" value="<?php echo Helper::validate_key_value('', $property); ?>"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Mileage:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text41'); ?>" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">KBB Value:</div>
            <div class="col-md-9"><input class="form-control" type="text" name="<?php echo base64_encode('text42'); ?>" value="<?php echo Helper::validate_key_value('property_estimated_value', $property); ?>"></div>
        </div>
        <div class="row">
            <div class="col-md-12">Condition (Circle 1): Good <span class="mx-3">Fair</span> Poor</div>
        </div>
    </div>
</div>