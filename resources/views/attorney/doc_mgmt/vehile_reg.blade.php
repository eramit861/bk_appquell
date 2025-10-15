<?php if (in_array($data['document_type'], $autoloankeys)) {
    if (!empty($vehicleRegistration)) {?>
        <select class="w-max-content ml-4 p-2" onchange="changeRelateToRegistration($(this).val(), '<?php echo $data['id']; ?>', '<?php echo $client_id; ?>','<?php echo route('relate_vehicle_reg_to_autoloan'); ?>')">
        <option value="">Choose Registartion</option>
            <?php foreach ($vehicleRegistration as $regis) {?>
                <option <?php echo $data['relate_to_document'] == $regis['id'] ? "selected" : ''; ?> value="<?php echo $regis['id']; ?>"><?php echo $regis['updated_name']; ?></option>
            <?php } ?>
        </select>
        <?php if (!empty($data['relate_to_document'])) { ?>
            <a title="Select to Download" href="<?php echo route('client_doc_download', ['id' => $data['relate_to_document']]);?>"><i class="view_client_btn fa fa-download" aria-hidden="true"></i></a>
        <?php } ?>
        <!--a class="view_client_btn" onclick="both_upload_modal('<?php //echo \App\Models\ClientDocumentUploaded::VEHICLE_REGISTRATION;?>',$(this).data('text'),'', '<?php //echo $data['id'];?>')" data-type="<?php //echo \App\Models\ClientDocumentUploaded::VEHICLE_REGISTRATION;?>" data-text="<?php //echo "Vehile Registration";?>">Add Registration</a-->

    <?php }
    } ?>