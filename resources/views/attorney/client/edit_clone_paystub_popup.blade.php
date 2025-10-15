<?php
$paystubs = [];
foreach ($paystubDocuments as $payst) {
    $thisdate = 1;
    $payst['updated_name'] = rtrim($payst['updated_name'], ".");
    $payst['updated_name'] = rtrim($payst['updated_name'], ".pdf");
    $dates = explode(".", $payst['updated_name']);
    if (isset($dates[0]) && isset($dates[1]) && isset($dates[2])) {
        $month = $dates[0];
        $day = $dates[1];
        $year = $dates[2];
        $thisdate = $year.'/'. $month.'/'.$day;
        $thisdate = strtotime($thisdate);
    }
    $payst['compare_date'] = $thisdate;
    $paystubs[] = $payst;
}
$paystubDocuments = $paystubs;
usort($paystubDocuments, function ($a, $b) {
    return $b['compare_date'] <=> $a['compare_date'];
});

$documentArray = \App\Models\PayStubs::where(['client_id' => $paystub_data['client_id']])->where('document_id', '!=', null)->select('document_id')->get();
$documentArray = !empty($documentArray) ? $documentArray->toArray() : [];
$assignedDocumentIds = array_column($documentArray, 'document_id');

$unassignedDocs = [];
$totalpaydocIds = array_column($paystubDocuments, 'id');
foreach ($paystubDocuments as $key => $doc) {
    if (!in_array($doc['id'], $assignedDocumentIds)) {
        array_push($unassignedDocs, $doc);
        unset($paystubDocuments[$key]);
    }
}
?>

<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" >
            Clone Paystub
        </h5>
    </div>

    <div class="modal-body p-1">
        <div class="card-body b-0-i">
            <form id="clone_form" action="{{route('clone_save_new_paystub')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="paystub_data_id" value="<?php echo $paystub_data['id']; ?>">
                <input type="hidden" name="client_id" value="<?php echo $paystub_data['client_id']; ?>">
                <input type="hidden" name="client_type" value="<?php echo $client_type; ?>">
                
                <div class="light-gray-div mt-3">
                    <h2>Paystub Details</h2>
                    <div class="row gx-3">	

                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="pay_date">Employer</label>
                                    <select class="form-control required " name="paystub_employer">
                                        <option value="">Please Select Type</option>
                                        <?php foreach ($employerList as $index => $data) {  ?>
                                        <option value="<?php echo $data['id'];?>" <?php echo ($data['id'] == $paystub_data['employer_id']) ? 'selected' : '';?>><?php echo $data['employer_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="pay_period_start">Pay Period Start:</label>
                                    <input type="date" name="pay_period_start" class="required form-control " placeholder="Pay Period Start:" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="pay_period_end">Pay Period End:</label>
                                    <input type="date" name="pay_period_end" class="required form-control " placeholder="Pay Period End:" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="pay_date">Pay Date:</label>
                                    <input type="date" name="pay_date" class="required form-control " placeholder="Pay Date:" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="light-gray-div mt-3">
                    <h2>Gross pay amounts</h2>
                    <?php
                        $regular_pay_amount = Helper::validate_key_value('regular_pay_amount', $paystub_data);
$overtime_pay_amount = Helper::validate_key_value('overtime_pay_amount', $paystub_data);
?>
                    <div class="row gx-3">	

                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="regularPayAmount" class="">Regular pay amount</label>
                                    <span class="form-control"><?php echo number_format((float)$regular_pay_amount, 2, '.', '');?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="overtimePayAmount" class="">Overtime pay amount</label>
                                    <span class="form-control"><?php echo number_format((float)$overtime_pay_amount, 2, '.', '');?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="overtimePayAmount" class="">Gross pay amount</label>
                                    <span class="form-control gross-pay-span"><?php echo number_format((float)$paystub_data['gross_pay_amount'], 2, '.', '');?></span>
                                </div>
                            </div>
                            <input type="hidden" name="grossPayAmount" class="price-field required form-control grossPayAmount" >
                        </div>

                    </div>
                </div>

                <div class="light-gray-div mt-3 mb-3">
                    <h2>Document</h2>
                    <div class="row gx-3">	

                        <div class="col-6 col-sm-6 col-md-4">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="regularPayAmount" class="">Document</label>
                                    <select class="form-control" name="document_id" id="document_id">
                                        <option value="">Select Document</option>
                                        <?php if (!empty($unassignedDocs)) { ?>
                                            <optgroup label="Unassigned documents"></optgroup>
                                            <?php } ?>
                                            <?php foreach ($unassignedDocs as $data) { ?>
                                            <option value="<?php echo $data['id'];?>"><?php echo $data['name']?></option>
                                            <?php }  ?>
                                            <?php if (!empty($paystubDocuments)) {?>
                                            <optgroup label="Assigned documents"></optgroup>
                                            <?php }  ?>
                                            <?php foreach ($paystubDocuments as $data) { ?>
                                            <?php if (in_array($data['id'], $assignedDocumentIds)) { ?>
                                            <option value="<?php echo $data['id'];?>"><?php echo $data['name']?></option>
                                            <?php }
                                            } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="label-div upload-area__drop-zoon drop-zoon text-center" id="dropZone">    
                                <div class="doc-upload d-flex">
                                    <span class="drop-zoon__icon fs-unset pb-0 pt-2 h-90px w-100">
                                        <i class="fa fa-cloud-upload-alt fs-42px"></i>
                                    </span>
                                    <div class="form-group c_paystub mb-0">
                                        <div class="doc-edit">
                                            <input required type='file' class="required" name="document_file" id="both-licence" accept=".pdf"/>
                                            <label class="mb-0 text-bold" style="bottom: 10px;" for="driving-licence">
                                            Drag and Drop or Select a PDF file to upload</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-5 d-flex align-items-center">
                            <div class="mb-3">
                                <label id="drop_file_name" class="drop_file_name mt-1"></label>
                            </div>
                        </div>                        

                    </div>
                </div>

                <div class="card information-area ">
                    <div class="row ">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="light-gray-div mb-0 mt-3">
                                <h2>Taxes</h2>
                                <div class="row gx-3">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th class="bt-none">Tax Type</th>
                                                        <th class="bt-none">Amount</th>
                                                    </tr> 
                                                    <?php foreach ($paystub_data_taxes as $index => $paystubData) { ?>
                                                    <tr>
                                                        <td><?php echo $paystubData['name'];?></td>
                                                        <td><?php echo number_format((float)$paystubData['amount'], 2, '.', '');?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td class="text-bold text-c-red">Total Taxes:</td>
                                                        <td class="text-bold text-c-red">$ <span class="total-tax"><?php echo number_format((float)$paystub_data['total_taxes'], 2, '.', '');?></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="light-gray-div mb-0 mt-3">
                                <h2>Deductions</h2>
                                <div class="row gx-3">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th class="bt-none">Deduction Type</th>
                                                        <th class="bt-none">Amount</th>
                                                    </tr> 
                                                    <?php foreach ($paystub_data_deductions as $index => $paystubData) { ?>
                                                    <tr>
                                                        <td><?php echo $paystubData['name'];?></td>
                                                        <td><?php echo number_format((float)$paystubData['amount'], 2, '.', '');?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td class="text-bold text-c-red">Total Deductions:</td>
                                                        <td class="text-bold text-c-red">$ <span class="total-tax"><?php echo number_format((float)$paystub_data['total_deductions'], 2, '.', '');?></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="light-gray-div mt-3 mb-3">
                    <h2>Net Pay</h2>
                    <div class="row gx-3">	
                        
                        <div class="col-6 label-div">
                            <div class="form-control summary-section d-flex align-items-center">
                                <label class="text-c-dgreen font-weight-bold w-100 mb-0">Net Pay:</label>    
                                <div class="">
                                    <label class="font-weight-bold  text-c-dgreen mb-0 d-flex align-items-center">$ <span class="net-pay ml-2"><?php echo number_format((float)$paystub_data['net_pay_amount'], 2, '.', '');?></span></label>   
                                </div>
                            </div>
                        </div>
                                                
                    </div>
                </div>

                <div class="bottom-btn-div">
                    <button type="submit" class="btn-new-ui-default cursor-pointer mb-0">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#document_id').on('change', function() {
            var id = this.value;
            if(id != ''){
                var name = $(this).find('option:selected').html();
                $("#both-licence").removeClass('required');
                $("#dropZone").addClass('hide-data');
            }else{
                $("#both-licence").addClass('required');
                $("#dropZone").removeClass('hide-data');
            }
        });

        var dropZone = document.getElementById('dropZone');

        dropZone.addEventListener('dragover', handleDragOver, false);
        dropZone.addEventListener('drop', handleFileSelect, false);
        
        function handleDragOver(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'copy';
        }

        function handleFileSelect(event) {
            event.preventDefault();
            var files = event.dataTransfer.files;

            for (var i = 0, f; f = files[i]; i++) {
                console.log(f.type);
                if (f.type === 'application/pdf' || f.type ===  'image/png' || f.type ===  'image/jpg' || f.type ===  'image/jpeg') {
                    var type = f.type;
                    var name = f.name;
                    var reader = new FileReader();

                    reader.readAsDataURL(f);
                    reader.onload = function (evt) {
                        $("#drop_file_name").html(name + " has been selected");
                        $("#drop_file_name").show();
                    }
                    // Update the file input value with the selected file
                    $("#both-licence")[0].files = files;

                    // Trigger the change event on the file input
                    $("#both-licence").trigger('change');

                    
                } else {
                    alert('Please drop a valid PDF file.');
                }
            }
        }

        $("#clone_form").validate({
            errorPlacement: function (error, element) {
                if($(element).parents(".form-group").next('label').hasClass('error')){
                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }else{
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function(label,element) {
                label.parent().removeClass('error');
                $(element).parents(".form-group").next('label').remove();
            },
        });
        $("#both-licence").on('change',function (data) {
            var imageFile = data.target.files[0];
            var type = data.target.files[0].type;
            var name = data.target.files[0].name;
            var reader = new FileReader();
            reader.readAsDataURL(imageFile);
            reader.onload = function (evt) {
                $("#drop_file_name").html(name+" has been selected");
                $("#drop_file_name").show();
            }
       });
    }); 
</script>
<style>
label.error {color: red;font-style: italic;  }
th{
border-top: 1px solid #eaeaea;
border-bottom: 1px solid #eaeaea;
color: #414141;
}
table thead {
background-color: #EDEEF0;
} 
table thead th{
padding: 5px 10px 5px 10px;
}
table tbody td{
padding: 5px 10px 5px 10px;
}
table tbody td{
border-top: 1px solid #eaeaea;
}
.id-control{
padding: 3px 12px;
}
#facebox .content.fbminwidth {
min-width: 1200px;
min-height: 400px;
}
.card .card-block, .card .card-body {
padding: 30px 15px;
}
.update{
color: #012cae;
cursor: pointer;
}
.fs-30px{
    font-size: 30px;
}
.fs-unset{
    font-size: unset;
}
.h-38px {
  height: 38px !important;
}

.bt-none{
    border-top: none !important;
}
.popup-table{
    border: 1px solid #ced4da ;
    border-radius: 0.25rem;
    border-spacing:0;
    width: 100%;
}
.popup-table th{
    background-color: #edeef0;
}
.popup-table th,td{
    padding: 0.5rem !important;
}
.border-collapse-unset{
    border-collapse: unset !important;
}
. {
  height: 44px !important;
}
.h-90px {
  height: 90px !important;
}
.fs-42px{
    font-size: 42px;
}
</style>
