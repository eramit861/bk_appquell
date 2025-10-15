

<?php $doc_type = '';
if (in_array($data['document_name'], ['Current Mortgage Statements', 'Current Auto Loan Statements'])) {
    if ($data['document_name'] == 'Current Mortgage Statements') {
        $doc_type = 'Mortgage_property_value';
    }
    if ($data['document_name'] == 'Current Auto Loan Statements') {
        $doc_type = 'Autoloan_property_value';
    }

    $docv_ides = [];
    foreach ($propertyValueDocType as $index => $documentData) {
        if ($documentData['document_type'] == $doc_type) {
            if (!empty($documentData['document_file'])) {
                $docv_ides[] = $documentData['id'];
            }
        }
    }
    ?>
    
    <a href="javascript:void(0)" onclick="both_upload_modal('<?php echo $doc_type; ?>',$(this).data('text'))" data-text="<?php echo str_replace('_', ' ', ($doc_type == 'Autoloan_property_value' ? 'Vehicle_Value(s)' : $doc_type)); ?>" data-type="<?php echo $doc_type; ?>" title="Select to upload Property Value Document"  class="pvdpending view_client_btn">  <i class="fa fa-upload" aria-hidden="true"></i> <?php echo str_replace('_', ' ', ($doc_type == 'Autoloan_property_value' ? 'Vehicle_Value(s)' : $doc_type)); ?></a>
    <?php if (!empty($docv_ides)) {

        foreach ($docv_ides as $pd_id) { ?>
    <a class="font-weight-bold dnpv view_client_btn" href="<?php echo route('client_doc_download', ['id' => $pd_id]); ?>" title="Select to Download Property Value Document"> <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i> <?php echo $doc_type == 'Autoloan_property_value' ? 'Vehicle Value' : 'Property Value'; ?></a>
   <button type="button" onclick="deleteDocDocument('<?php echo $doc_type; ?>','<?php echo route('client_document_delete'); ?>','<?php echo $client_id; ?>', this, '', '<?php echo $pd_id; ?>')" class="delete-div" title="Delete">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
		<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
		</path>
	</svg>
	Delete
</button>
    <?php }
        } ?>
   

<?php } ?>
<?php
$statement_month_array = DateTimeHelper::getBankStatementMonthArray($bank_statement_months ?? 3);
$acceptType = '.heic, .png, .jpg, .jpeg, .pdf, .doc, .docx';
?>
<?php if (!in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) { ?>
<a class="float-left <?php echo empty($combinedForm) ? 'd-none' : '';?> view_client_btn delete_doc_btn p4px hide-data" data-item="{{$data['document_type']}}" data-url="<?php echo route('delete_bulk_documents', ['id' => $val['id'], 'type' => $data['document_type']]);?>" id="bulkdelete_{{$data['document_type']}}" href="javascript:void(0)" ><i class="fa fa-file-trash fa-lg" aria-hidden="true"></i> Delete Selected</a>
<?php } ?>

    
<?php if (empty($doclasscs)) { ?>
       @include("attorney.doc_mgmt.btn_actions")
<?php } ?>
