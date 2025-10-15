<?php
$client_id = Helper::validate_key_value('client_id', $data);
$client_type = Helper::validate_key_value('client_type', $data);
$monthYear = Helper::validate_key_value('monthYear', $data);
$months = Helper::validate_key_value('months', $data);
$monthYearText = Helper::validate_key_value($monthYear, $months);
$descriptionAmountData = Helper::validate_key_value('descriptionAmountData', $data);
$descriptionAmountData = !empty($descriptionAmountData) ? $descriptionAmountData : [] ; //echo "<pre>";print_r($descriptionAmountData);
$categories = Helper::validate_key_value('categories', $data);
$isImportedForThisMonth = Helper::validate_key_value('isImportedForThisMonth', $data);
$categories = !empty($categories) ? $categories : [] ;
$popupHeading = "Debtor's Profit/Loss Calculation:";
$noDocText = "Debtor has no bank statements for ".$monthYearText;
if ($client_type == "codebtor") {
    $popupHeading = "Co-debtor's Profit/Loss Calculation:";
    $noDocText = "Co-debtor has no bank statements for ".$monthYearText;
}
$route = route('import_client_bank_statement_save');
if ($isClient == 1) {
    $route = route('save_bank_statement_import_popup');
}
?>
<form action="{{$route}}" method="POST" id="bank_statement_calculation_form" name="bank_statement_calculation_form">
    @csrf
    <input type="hidden" name="client_id"   value="<?php echo $client_id;   ?>" >
    <input type="hidden" name="client_type" value="<?php echo $client_type; ?>" >
    <input type="hidden" name="monthYear"   value="<?php echo $monthYear;   ?>" >
    <div class="row bank_statement_calculation">
        <div class="col-md-8">
            <div class="title-h mt-2 mb-3">
                <h4 class="mb-0"><strong><?php echo $popupHeading; ?></strong></h4>
                <?php if ($data['isImportedForThisMonth'] == true && count($descriptionAmountData) > 0) { ?>
                    <small class="my-0 text-success"><?php echo "(Bank statements IMPORTED for ".$monthYearText.")"; ?></small>
                <?php } ?>
            </div>
        </div>

        <div class="col-md-4">
            <select class="form-control w-auto float_right mt-1 required mb-4" name="monthYear" onchange="bankStatementImport(1,'{{$client_id}}','{{$client_type}}',this.value)" id="monthYearSelect">
                <?php foreach ($months as $key => $month) { ?>
                    <option value="{{ $key }}" <?php echo ($monthYear == $key) ? 'selected' : '';?>>{{$month}}</option>
                <?php } ?>
            </select>
        </div>
        
        <?php if (count($descriptionAmountData) > 0) {
            $i = 0;
            foreach ($descriptionAmountData as $key => $value) { ?>
        <div class="col-md-6">
            <p class="mb-0 pt-2">
                <?php echo  $key;?> : <span class="text-bold float_ri">$<?php echo $value;?> </span>
            </p>
        </div>
        
        <div class="col-md-6">
            <div class="form-group mb-0">
                <select class="form-control required" name="expense_type[{{$key}}]" onchange="" id="">
                    <option value="">Select Expense</option>
                    <?php foreach ($categories as $key => $value) { ?>
                        <option value="{{ $key }}"><?php echo $value;?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <?php $i++;
            } ?>
        <div class="col-md-12 align-right login-btn">
            <a href ="javascript:void(0)" onclick="$('#bank_statement_calculation_form').submit();" class="btn btn-primary shadow-2 mt-3 mr-0">Import</a>
        </div>
        <?php } else { ?>
        <div class="col-md-12">
            <p><?php echo $noDocText; ?></p>
        </div>
        <?php } ?>
    </div>
</form>

<style>
    .content{
        width: 800px !important; 
        min-height: 100px !important; 
    }
    label.error {
        color: red;
        font-size: 10px;
        font-weight: bold;
        margin-top: 0.25rem;
        margin-bottom: 0px;
    }
    .bank_statement_calculation select, .bank_statement_calculation p{ 
        margin-top: 1rem;
    }
</style>

<script>
    $(document).ready(function() {
        $("#bank_statement_calculation_form").validate({
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
    });
</script>
