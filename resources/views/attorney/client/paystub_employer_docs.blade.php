<form id="{{$employer_id}}_{{$mainData['document_type']}}"
                        action="<?php echo route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => $employer_id]); ?>"
                        method="GET">
<table width="100%" id="pageList_{{$employer_id}}_<?php echo str_replace(" ", "_", $mainData['document_type']); ?>">  
    
    <tr style="border-bottom:1px solid #50cbcb"><td colspan='4'>
  
    <?php if (($paystbcount > 0) || in_array($mainData['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) { ?>
                    <input class="ml-2 parent_{{$employer_id}}_<?php echo $mainData['document_type']; ?>" type="checkbox" onclick="checkChildCheckboxes(this,'<?php echo $mainData['document_type']; ?>',{{$employer_id}})" value="1" id="label_for_{{$employer_id}}_{{$mainData['document_type']}}"> <label for="label_for_{{$employer_id}}_{{$mainData['document_type']}}" class="click_all_docs">Click to Select All Doc(s) </label> 
                <?php } ?>
    <a class="float-right  view_client_btn delete_doc_btn p4px hide-data" data-item="{{$employer_id}}_{{$mainData['document_type']}}" data-url="<?php echo route('delete_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => $employer_id]);?>" id="bulkdelete_{{$employer_id}}_{{$mainData['document_type']}}" href="javascript:void(0)" ><i class="fa fa-file-trash fa-lg" aria-hidden="true"></i> Delete Selected</a>
    <a href="javascript:void(0)" class="ml-5 view_client_btn p4px accept_all dnpv hide-data" data-item="{{$employer_id}}_{{$mainData['document_type']}}" data-url="<?php echo route('accept_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => $employer_id]);?>" id="bulkaccept_{{$employer_id}}_{{$mainData['document_type']}}" href="javascript:void(0)"> Accept All</a> <a class="ml-1 view_client_btn btn-danger p4px decline_all hide-data" data-item="{{$employer_id}}_{{$mainData['document_type']}}" data-url="<?php echo route('decline_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'],'employer_id' => $employer_id]);?>" id="bulkdecline_{{$employer_id}}_{{$mainData['document_type']}}" href="javascript:void(0)">Decline All</a>
                   
            </td></tr>
          
            
            @include("attorney.client_uploaded_multiple_document",["documentuploaded" => $mainData['multiple']??[], 'documentsAddedForThisEmployer' => $docForThisEmployer, 'employer_id' => $employer_id])
           
            </table>
            </form>