<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100">
            Edit Paystub
        </h5>
    </div>
    <?php
    $amountRemaining = 0;
    $amountRemaining = $paystub_data['gross_pay_amount'] - ($paystub_data['total_taxes'] + $paystub_data['total_deductions']);
    $amountRemaining = $amountRemaining - $paystub_data['net_pay_amount'];

    if ($amountRemaining > 0) {
        $paystub_data_taxes[] = [
            'name' => '',
            'amount' => $amountRemaining
        ];
    }
    //echo "<pre>";print_r($paystub_data_taxes);
    ?>

    <div class="modal-body p-1">
        <div class="card-body b-0-i">
            <form id="add_form" action="{{route('save_new_paystub')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="paystub_data_id" value="<?php echo $paystub_data['id']; ?>">
                <input type="hidden" name="client_id" value="<?php echo $paystub_data['client_id']; ?>">
                <input type="hidden" name="document_name" value="<?php echo $paystub_data['document']; ?>">
                <input type="hidden" name="created_at" value="<?php echo $paystub_data['created_at']; ?>">
                <input type="hidden" name="client_type" value="<?php echo $client_type; ?>">
                <input type="hidden" name="edit_popup" value="1">

                <div class="light-gray-div mt-3">
                    <h2>Paystub Details</h2>
                    <div class="row gx-3">

                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="pay_date">Employer</label>
                                    <select class="form-control required" name="paystub_employer">
                                        <option value="">Please Select Type</option>
                                        <?php foreach ($employerList as $index => $data) {  ?>
                                            <option value="<?php echo $data['id']; ?>" <?php echo ($data['id'] == $paystub_data['employer_id']) ? 'selected' : ''; ?>><?php echo $data['employer_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="pay_period_start">Pay Period Start:</label>
                                    <input type="date" name="pay_period_start" class="required form-control " placeholder="Pay Period Start:" value="<?php echo $paystub_data['pay_period_start']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="pay_period_end">Pay Period End:</label>
                                    <input type="date" name="pay_period_end" class="required form-control " placeholder="Pay Period End:" value="<?php echo $paystub_data['pay_period_end']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="pay_date">Pay Date:</label>
                                    <input type="date" name="pay_date" class="required form-control " placeholder="Pay Date:" value="<?php echo $paystub_data['pay_date']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="light-gray-div mt-3 mb-3">
                    <h2>Gross pay amounts</h2>
                    <div class="row gx-3">

                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="regularPayAmount" class="">Regular pay amount</label>
                                    <input type="number" name="regularPayAmount" class="price-field required form-control  regularPayAmount" placeholder="Regular pay amount" value="<?php echo number_format((float)Helper::validate_key_value('regular_pay_amount', $paystub_data), 2, '.', ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="overtimePayAmount" class="">Overtime pay amount</label>
                                    <?php
                                    // Ensure Helper is imported or defined, or use number_format directly
                                    $overtimePay = isset($paystub_data['overtime_pay_amount']) ? $paystub_data['overtime_pay_amount'] : 0;

    ?>
                                    <input type="number" name="overtimePayAmount" class="price-field required form-control  overtimePayAmount" placeholder="Overtime pay amount" value="<?php echo number_format((float)$overtimePay, 2, '.', ''); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="overtimePayAmount" class="">Gross pay amount</label>
                                    <span class="form-control gross-pay-span">$ <?php echo Helper::priceFormt($paystub_data['gross_pay_amount']); ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="grossPayAmount" class="price-field required form-control  grossPayAmount" value="<?php echo number_format((float)$paystub_data['gross_pay_amount'], 2, '.', ''); ?>">
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="light-gray-div mt-3">
                            <h2>Taxes</h2>
                            <?php
                            $i = 0;
    if (!empty($paystub_data_taxes)) {
        foreach ($paystub_data_taxes as $index => $paystubData) {
            ?>
                                    <!-- add more div -->
                                    <div class="row gx-3 tax-addmore tax-addmore-div-<?php echo $i; ?>">
                                        <div class="col-5 col-md-5">
                                            <div class="label-div">
                                                <div class="form-group">
                                                    <label for="Taxes[typeMore][<?php echo $i; ?>]" class="tax-type-label">Tax Type:</label>
                                                    <select class="form-control <?php if ($paystubData['name'] == '') {
                                                        echo "red_border";
                                                    } ?> tax-type-select" onchange="this.classList.remove('red_border')" name="Taxes[typeMore][<?php echo $i; ?>]">
                                                        <option value="">Please Select Type</option>
                                                        <?php foreach ($taxList as $index => $label) { ?>
                                                            <option value="<?php echo $index; ?>" <?php echo ($label == $paystubData['name']) ? 'selected="selected"' : ''; ?>><?php echo $label ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 col-md-5">
                                            <div class="label-div">
                                                <div class="form-group mb-0 ">
                                                    <label for="Taxes[amountMore][<?php echo $i; ?>]" class="tax-amount-label">Amount:</label>
                                                    <input type="number" name="Taxes[amountMore][<?php echo $i; ?>]" class="price-field form-control  tax-amount" placeholder="Amount:" value="<?php echo number_format((float)$paystubData['amount'], 2, '.', ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 m-0 p-0">
                                            <div class="label-div">
                                                <label for="">&nbsp;</label>
                                                <div class="pt-1">
                                                    <button onclick="removeTaxDiv('<?php echo $i; ?>')" type="button" class="delete-div" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $i++;
        }
    } else {
        ?>
                                <!-- add more div -->
                                <div class="row tax-addmore tax-addmore-div-<?php echo $i; ?>">
                                    <div class="col-md-5">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label for="Taxes[typeMore][<?php echo $i; ?>]" class="tax-type-label">Tax Type:</label>
                                                <select class="form-control tax-type-select" name="Taxes[typeMore][<?php echo $i; ?>]">
                                                    <option value="">Please Select Type</option>
                                                    <?php foreach ($taxList as $index => $label) { ?>
                                                        <option value="<?php echo $index; ?>"><?php echo $label ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="label-div">
                                            <div class="form-group mb-0 ">
                                                <label for="Taxes[amountMore][<?php echo $i; ?>]" class="tax-amount-label">Amount:</label>
                                                <input type="number" name="Taxes[amountMore][<?php echo $i; ?>]" class="price-field form-control  tax-amount" placeholder="Amount:" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 m-0 p-0">
                                        <div class="label-div">
                                            <label for="">&nbsp;</label>
                                            <div class="pt-1">
                                                <a class="btn-delete" onclick="removeTaxDiv('<?php echo $i; ?>')"><button type="button" class="delete-div" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                        Delete
                                                    </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>


                            <!-- add new div -->
                            <div class="row tax-addnew tax-addnew-div-0 d-none">
                                <div class="col-md-5">
                                    <div class=" label-div">
                                        <div class=" form-group ">
                                            <label for="Taxes[typeNew][0]" class="tax-type-label">Tax Type:</label>
                                            <input type="text" name="Taxes[typeNew][0]" class="form-control  tax-type" placeholder="Tax Type:">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="label-div">
                                        <div class=" form-group mb-0 ">
                                            <label for="Taxes[amountNew][0]" class="tax-amount-label">Amount:</label>
                                            <input type="number" name="Taxes[amountNew][0]" class="price-field form-control  tax-amount" placeholder="Amount:">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 m-0 p-0">
                                    <div class="label-div">
                                        <label for="">&nbsp;</label>
                                        <div class="pt-1">
                                            <a class="btn-delete" onclick="removeNewTaxDiv('0')"><button type="button" class="delete-div" title="Delete">
                                                    <i class="bi bi-trash3"></i>
                                                    Delete
                                                </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" mt-1">
                                <a class="btn-new-ui-default is_active p-2 cursor-pointer" onclick="addMoreTaxDiv()"><i class="feather icon-plus mr-0"></i> Add More</a>
                            </div>
                            <div class=" mt-3 label-div">
                                <div class="form-control summary-section d-flex align-items-center">
                                    <label class="text-c-red font-weight-bold w-100 mb-0">Total Taxes:</label>
                                    <div class="">
                                        <label class="font-weight-bold  text-c-red mb-0 d-flex align-items-center">$ <span class="total-tax ml-2">0.00</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="light-gray-div mt-3">
                            <h2>Deductions</h2>
                            <?php
                            $i = 0;
    $mainDeductions = ArrayHelper::getDeductionArrayForPaystub();
    if (!empty($paystub_data_deductions)) {
        foreach ($paystub_data_deductions as $index => $paystubData) {
            ?>
                                    <!-- add more div -->
                                    <div class="row deduction-addmore deduction-addmore-div-{{$i}}">
                                        <?php
                        $deducations = !empty($deductionList) ? $deductionList : [];
            $deducationlist = array_column($deducations, 'deduction_label');
            ?>
                                        <div class="col-5 col-md-5">
                                            <div class="label-div">
                                                <label class="">Deduction Type</label>
                                                <div class="custom-dropdown custom-dropdown-0 border-0">
                                                    <div class="select form-control h-unset d-flex align-items-center py-2">
                                                        <span><?php echo $paystubData['name']; ?></span>
                                                        <i class="fa fa-chevron-down"></i>
                                                    </div>
                                                    <?php
                        foreach ($deductionList as $index => $data) {
                            if ($data['deduction_label'] == $paystubData['name']) {
                                ?>
                                                            <input type="hidden" class="deduction-type-select" name="Deductions[typeMore][<?php echo $i; ?>]" value="<?php echo $data['id']; ?>">
                                                    <?php
                            }
                        }
            ?>
                                                    <ul class="custom-dropdown-menu">
                                                        <?php foreach ($deductionList as $index => $data) { ?>
                                                            <li data-index="0" id="<?php echo $data['id']; ?>" <?php echo (array_key_exists($data['id'], $mainDeductions)) ? 'class="text-bold"' : '' ?>><?php echo $data['deduction_label'] ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 col-md-5">
                                            <div class="form-group mb-0">
                                                <div class="  ">
                                                    <label for="Deductions[amountMore][<?php echo $i; ?>]" class="ml-3 deduction-amount-label">Amount:</label>
                                                    <input type="number" name="Deductions[amountMore][<?php echo $i; ?>]" class="deduction-price-field form-control  deduction-amount" placeholder="Amount:" value="<?php echo number_format((float)$paystubData['amount'], 2, '.', ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 m-0 p-0">
                                            <div class="label-div">
                                                <label for="">&nbsp;</label>
                                                <div class="pt-1">
                                                    <a class="btn-delete" onclick="removeDeductionDiv('<?php echo $i; ?>')"><button type="button" class="delete-div" title="Delete">
                                                            <i class="bi bi-trash3"></i>
                                                            Delete
                                                        </button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $i++;
        }
    } else {
        ?>
                                <!-- add more div -->
                                <div class="row deduction-addmore deduction-addmore-div-{{$i}}">
                                    <div class="col-md-5">
                                        <div class="label-div">
                                            <div class="form-group ">
                                                <label for="Deductions[typeMore][<?php echo $i; ?>]" class="deduction-type-label">Deduction Type:</label>
                                                <select class="form-control deduction-type-select" name="Deductions[typeMore][<?php echo $i; ?>]">
                                                    <option value="">Please Select Type</option>
                                                    <?php foreach ($deductionList as $index => $data) { ?>
                                                        <option value="<?php echo $data['id']; ?>" <?php echo (array_key_exists($data['id'], $mainDeductions)) ? 'style="font-weight: bold;"' : '' ?>><?php echo $data['deduction_label'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="label-div">
                                            <div class=" form-group mb-0 ">
                                                <label for="Deductions[amountMore][<?php echo $i; ?>]" class="ml-3 deduction-amount-label">Amount:</label>
                                                <input type="number" name="Deductions[amountMore][<?php echo $i; ?>]" class="deduction-price-field form-control  deduction-amount" placeholder="Amount:" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 m-0 p-0">
                                        <div class="label-div">
                                            <label for="">&nbsp;</label>
                                            <div class="pt-1">
                                                <a class="btn-delete" onclick="removeDeductionDiv('<?php echo $i; ?>')"><button type="button" class="delete-div" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                        Delete
                                                    </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                            <!-- add new div -->
                            <div class="row deduction-addnew deduction-addnew-div-0 d-none">
                                <div class="col-md-5">
                                    <div class=" label-div ">
                                        <div class=" form-group ">
                                            <label for="Deductions[typeNew][0]" class=" deduction-type-label">Deduction Type:</label>
                                            <input type="text" name="Deductions[typeNew][0]" class="form-control  deduction-type" placeholder="Deduction Type:">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="label-div ">
                                        <div class=" form-group mb-0 ">
                                            <label for="Deductions[amountNew][0]" class=" deduction-amount-label">Amount:</label>
                                            <input type="number" name="Deductions[amountNew][0]" class="deduction-price-field form-control  deduction-amount" placeholder="Amount:">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 m-0 p-0">
                                    <div class="label-div">
                                        <label for="">&nbsp;</label>
                                        <div class="pt-1">
                                            <a class="btn-delete" onclick="removeNewDeductionDiv('0')"><button type="button" class="delete-div" title="Delete">
                                                    <i class="bi bi-trash3"></i>
                                                    Delete
                                                </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" mt-1">
                                <a class="btn-new-ui-default is_active green p-2 cursor-pointer" onclick="addNewDeductionDiv()"><i class="feather icon-plus mr-0"></i> Add New</a>
                                <a class="btn-new-ui-default is_active p-2 cursor-pointer ml-2" onclick="addMoreDeductionDiv()"><i class="feather icon-plus mr-0"></i> Add More</a>
                            </div>
                            <div class=" mt-3 label-div">
                                <div class="form-control summary-section d-flex align-items-center">
                                    <label class="text-c-red font-weight-bold w-100 mb-0">Total Deductions:</label>
                                    <div class="">
                                        <label class="font-weight-bold  text-c-red mb-0 d-flex align-items-center">$ <span class="total-deduction ml-2">0.00</span></label>
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
                                    <label class="font-weight-bold  text-c-dgreen mb-0 d-flex align-items-center">$ <span class="net-pay ml-2">0.00</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="label-div mb-0">
                                <div class="form-group mb-0">
                                    <label class=" mt-2 mb-0">
                                        <input type="checkbox" name="is_checked" value="1" id="is_checked" required class="required" <?php echo (Helper::validate_key_value('is_calculated', $paystub_data) == 1) ? 'checked' : ''; ?>>
                                        I agree that paystub is calculated.
                                    </label>
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
    $(document).ready(function() {

        $(document).on('click', '.custom-dropdown', function(event) {
            event.stopPropagation();
            var $dropdownMenu = $(this).find('.custom-dropdown-menu');
            if ($dropdownMenu.is(':visible')) {
                // $dropdownMenu.slideUp(300);
            } else {
                $('.custom-dropdown-menu').hide();
                $dropdownMenu.slideToggle(300);
            }
        });

        // Function to close the dropdown when clicking outside
        $(document).on('click', function() {
            $('.custom-dropdown-menu').slideUp(300);;
        });

        // Function to close the dropdown on focusout
        $(document).on('focusout', '.custom-dropdown-menu', function(event) {
            var $dropdown = $(this).closest('.custom-dropdown');

            setTimeout(function() {
                // Check if the active element is outside the dropdown
                if (!$(document.activeElement).closest('.custom-dropdown').length) {
                    $dropdown.find('.custom-dropdown-menu').slideUp(300);
                }
            }, 0);
        });

        $(document).on('click', '.custom-dropdown-menu li', function(event) {
            var $dropdownMenu = $(this).parent('ul');
            $(this).parents('.custom-dropdown').find('span').text($(this).text());
            const liId = $(this).attr('id');
            $(this).parents('.custom-dropdown').find('input').val(liId);
            if ($dropdownMenu.is(':visible')) {
                $dropdownMenu.slideUp(300);
            }
        });

        var grossPayMain = $('input[name="grossPayAmount"]').val();
        var totalTaxAmountMain = 0;
        $('.tax-amount').each(function() {
            totalTaxAmountMain += Number($(this).val());
        });
        $('.total-tax').text(totalTaxAmountMain.toFixed(2));
        var totalDeductionAmountMain = 0;
        $('.deduction-amount').each(function() {
            totalDeductionAmountMain += Number($(this).val());
        });
        $('.total-deduction').text(totalDeductionAmountMain.toFixed(2));
        var newTotalMain = grossPayMain - totalTaxAmountMain - totalDeductionAmountMain;
        $('.net-pay').text(newTotalMain.toFixed(2));

        $("#add_form").validate({
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
        $('#add_form').on("keyup", ".regularPayAmount, .overtimePayAmount ", function() {
            var regularPayAmount = parseFloat($('input[name="regularPayAmount"]').val()) || 0;
            var overtimePayAmount = parseFloat($('input[name="overtimePayAmount"]').val()) || 0;
            var grossPay = regularPayAmount + overtimePayAmount;
            $('.gross-pay-span').html("$ " + grossPay.toFixed(2));
            $("input[name='grossPayAmount']").val(grossPay);
            var totalTaxAmount = $('.total-tax').html();
            var totalDeductionAmount = $('.total-deduction').html();
            var total = grossPay - totalTaxAmount - totalDeductionAmount;
            $('.net-pay').text(total);
        });

        $(document).on("keyup", ".tax-amount", function() {
            var sum = 0;
            $('.tax-amount').each(function() {
                sum += Number($(this).val());
            });
            $('.total-tax').text(sum.toFixed(2));
            var grossPay = $('input[name="grossPayAmount"]').val();
            var prevTotalAmount = $('.total-deduction').html();
            var newTotal = '';

            if (typeof prevTotalAmount === "undefined") {
                newTotal = grossPay - sum;
            } else {
                newTotal = grossPay - sum - prevTotalAmount;
            }

            $('.net-pay').text(newTotal.toFixed(2));
        });
        $(document).on("keyup", ".deduction-amount", function() {
            var sum = 0;
            $('.deduction-amount').each(function() {
                sum += Number($(this).val());
            });
            $('.total-deduction').text(sum.toFixed(2));
            var grossPay = $('input[name="grossPayAmount"]').val();
            var prevTotalAmount = $('.total-tax').html();
            var newTotal = '';

            if (typeof prevTotalAmount === "undefined") {
                newTotal = grossPay - sum;
            } else {
                newTotal = grossPay - sum - prevTotalAmount;
            }

            $('.net-pay').text(newTotal.toFixed(2));
        });

        $("#both-licence").on('change', function(data) {
            var imageFile = data.target.files[0];
            var type = data.target.files[0].type;
            var name = data.target.files[0].name;

            var reader = new FileReader();
            reader.readAsDataURL(imageFile);
            reader.onload = function(evt) {
                $("#drop_file_name").html(name + " has been selected");
                $("#drop_file_name").show();
            }
        });



    });

    $(document).on('change blur', '.deduction-amount, .tax-amount, .regularPayAmount, .overtimePayAmount', function() {
        var price = parseFloat($(this).val()).toFixed(2);
        $(this).val(price);
    });

    addMoreTaxDiv = function() {
        var item = $(document).find(".tax-addmore").last();
        var index_value = $(item).index() + 1;
        var clone = $(item).clone();
        $(clone).each(function() {
            $(this).attr('class', 'row tax-addmore tax-addmore-div-' + index_value + '');
        });
        // for select
        var type_select = clone.find('.tax-type-select');
        var type_label = clone.find('.tax-type-label');
        $(type_select).each(function() {
            $(this).attr('name', 'Taxes[typeMore][' + index_value + ']');
            $(this).val('');
        });
        // $("#myDropdown option:selected").prop("selected", false);
        $(type_label).each(function() {
            $(this).attr('for', 'Taxes[typeMore][' + index_value + ']');
        });
        // for amount
        var amount = clone.find('.tax-amount');
        var amount_label = clone.find('.tax-amount-label');
        $(amount).each(function() {
            $(this).attr('name', 'Taxes[amountMore][' + index_value + ']');
            $(this).val('');
        });
        $(amount_label).each(function() {
            $(this).attr('for', 'Taxes[amountMore][' + index_value + ']');
        });
        // for buttons
        var btn_delete = clone.find('.btn-delete');
        $(btn_delete).each(function() {
            $(this).attr('onclick', 'removeTaxDiv("' + index_value + '")');
        });
        // updating value to empty
        clone.find('input[type="text"]').val('');
        $(item).after(clone);
    }

    addNewTaxDiv = function() {
        var item = $(document).find(".tax-addnew").last();
        var index_value = $(item).index();
        var clone = $(item).clone();
        $(clone).each(function() {
            $(this).attr('class', 'row tax-addnew tax-addnew-div-' + index_value + '');
        });
        // for select
        var type_select = clone.find('.tax-type');
        var type_label = clone.find('.tax-type-label');
        $(type_select).each(function() {
            $(this).attr('name', 'Taxes[typeNew][' + index_value + ']');
        });
        $(type_label).each(function() {
            $(this).attr('for', 'Taxes[typeNew][' + index_value + ']');
        });
        // for amount
        var amount = clone.find('.tax-amount');
        var amount_label = clone.find('.tax-amount-label');
        $(amount).each(function() {
            $(this).attr('name', 'Taxes[amountNew][' + index_value + ']');
            $(this).val('');
        });
        $(amount_label).each(function() {
            $(this).attr('for', 'Taxes[amountNew][' + index_value + ']');
        });
        // for buttons
        var btn_delete = clone.find('.btn-delete');
        $(btn_delete).each(function() {
            $(this).attr('onclick', 'removeNewTaxDiv("' + index_value + '")');
        });
        // updating value to empty
        clone.find('input[type="text"]').val('');
        $(item).after(clone);
    }

    removeTaxDiv = function(index) {
        var clnlnMore = $(document).find(".tax-addmore").length;
        var clnlnNew = $(document).find(".tax-addnew").length;
        var totalLength = clnlnMore + clnlnNew;
        var prevTotalAmount = $('.total-tax').html();
        var deletedAmount = $('input[name="Taxes[amountMore][' + index + ']"]').val();
        var newTotal = prevTotalAmount - deletedAmount;


        var grossPay = $('input[name="grossPayAmount"]').val();
        var prevTotalDeductionAmount = $('.total-deduction').html();
        var netPay = '';

        if (typeof prevTotalDeductionAmount === "undefined") {
            netPay = grossPay - newTotal;
        } else {
            netPay = grossPay - newTotal - prevTotalDeductionAmount;
        }


        if (totalLength > 2 && clnlnMore > 1) {
            $(".tax-addmore-div-" + index).remove();
            $('.total-tax').text(newTotal.toFixed(2));
            $('.net-pay').text(netPay.toFixed(2));
        } else {
            alert("You cannot remove last entry.");
            return false;
        }
    }
    removeNewTaxDiv = function(index) {
        var clnlnMore = $(document).find(".tax-addmore").length;
        var clnlnNew = $(document).find(".tax-addnew").length;
        var totalLength = clnlnMore + clnlnNew;
        var prevTotalAmount = $('.total-tax').html();
        var deletedAmount = $('input[name="Taxes[amountNew][' + index + ']"]').val();
        var newTotal = prevTotalAmount - deletedAmount;

        var grossPay = $('input[name="grossPayAmount"]').val();
        var prevTotalDeductionAmount = $('.total-deduction').html();
        var netPay = '';

        if (typeof prevTotalDeductionAmount === "undefined") {
            netPay = grossPay - newTotal;
        } else {
            netPay = grossPay - newTotal - prevTotalDeductionAmount;
        }

        if (totalLength > 1) {
            $(".tax-addnew-div-" + index).remove();
            $('.total-tax').text(newTotal.toFixed(2));
            $('.net-pay').text(netPay.toFixed(2));
        } else {
            alert("You cannot remove last entry.");
            return false;
        }
    }

    addMoreDeductionDiv = function() {
        var item = $(document).find(".deduction-addmore").last();
        var index_value = $(item).index() + 1;
        var clone = $(item).clone();
        $(clone).each(function() {
            $(this).attr('class', 'row deduction-addmore deduction-addmore-div-' + index_value + '');
        });

        var custom_dropdown = clone.find('.custom-dropdown');
        $(custom_dropdown).each(function() {
            $(this).attr('class', 'custom-dropdown custom-dropdown-' + index_value + ' mb-3 border-0');
        });

        var custom_dropdown = clone.find('.select');
        $(custom_dropdown).each(function() {
            $(this).find("span").html("Please Select Type");
        });

        var custom_dropdown_menu = clone.find('.custom-dropdown-menu li');
        $(custom_dropdown_menu).each(function() {
            $(this).attr('data-index', index_value);
        });

        // for select
        var type_select = clone.find('.deduction-type-select');
        var type_label = clone.find('.deduction-type-label');
        $(type_select).each(function() {
            $(this).attr('name', 'Deductions[typeMore][' + index_value + ']');
            $(this).val('');
        });
        $(type_label).each(function() {
            $(this).attr('for', 'Deductions[typeMore][' + index_value + ']');
        });
        // for amount
        var amount = clone.find('.deduction-amount');
        var amount_label = clone.find('.deduction-amount-label');
        $(amount).each(function() {
            $(this).attr('name', 'Deductions[amountMore][' + index_value + ']');
            $(this).val('');
        });
        $(amount_label).each(function() {
            $(this).attr('for', 'Deductions[amountMore][' + index_value + ']');
        });
        // for buttons
        var btn_delete = clone.find('.btn-delete');
        $(btn_delete).each(function() {
            $(this).attr('onclick', 'removeDeductionDiv("' + index_value + '")');
        });
        // updating value to empty
        clone.find('input').val('');
        $(item).after(clone);
    }

    addNewDeductionDiv = function() {
        var item = $(document).find(".deduction-addnew").last();
        var index_value = $(item).index() + 1;
        var clone = $(item).clone();
        $(clone).each(function() {
            $(this).attr('class', 'row deduction-addnew deduction-addnew-div-' + index_value);
        });
        // for select
        var type_select = clone.find('.deduction-type');
        var type_label = clone.find('.deduction-type-label');
        $(type_select).each(function() {
            $(this).attr('name', 'Deductions[typeNew][' + index_value + ']');
        });
        $(type_label).each(function() {
            $(this).attr('for', 'Deductions[typeNew][' + index_value + ']');
        });
        // for amount
        var amount = clone.find('.deduction-amount');
        var amount_label = clone.find('.deduction-amount-label');
        $(amount).each(function() {
            $(this).attr('name', 'Deductions[amountNew][' + index_value + ']');
            $(this).val('');
        });
        $(amount_label).each(function() {
            $(this).attr('for', 'Deductions[amountNew][' + index_value + ']');
        });
        // for buttons
        var btn_delete = clone.find('.btn-delete');
        $(btn_delete).each(function() {
            $(this).attr('onclick', 'removeNewDeductionDiv("' + index_value + '")');
        });
        // updating value to empty
        clone.find('input[type="text"]').val('');
        $(item).after(clone);
    }

    removeDeductionDiv = function(index) {
        var clnlnMore = $(document).find(".deduction-addmore").length;
        var prevTotalAmount = $('.total-deduction').html();
        var deletedAmount = $('input[name="Deductions[amountMore][' + index + ']"]').val();
        var newTotal = prevTotalAmount - deletedAmount;

        var grossPay = $('input[name="grossPayAmount"]').val();
        var prevTotalDeductionAmount = $('.total-deduction').html();
        var netPay = '';

        if (typeof prevTotalDeductionAmount === "undefined") {
            netPay = grossPay - newTotal;
        } else {
            netPay = grossPay - newTotal - prevTotalDeductionAmount;
        }

        if (clnlnMore > 1) {
            $(".deduction-addmore-div-" + index).remove();
            $('.total-deduction').text(newTotal);
            $('.net-pay').text(netPay.toFixed(2));
        } else {
            alert("You cannot remove last entry.");
            return false;
        }

    }
    removeNewDeductionDiv = function(index) {
        var clnlnNew = $(document).find(".deduction-addnew").length;
        var prevTotalAmount = $('.total-deduction').html();
        var deletedAmount = $('input[name="Deductions[amountNew][' + index + ']"]').val();
        var newTotal = prevTotalAmount - deletedAmount;

        var grossPay = $('input[name="grossPayAmount"]').val();
        var prevTotalDeductionAmount = $('.total-deduction').html();
        var netPay = '';

        if (typeof prevTotalDeductionAmount === "undefined") {
            netPay = grossPay - newTotal;
        } else {
            netPay = grossPay - newTotal - prevTotalDeductionAmount;
        }

        if (clnlnNew > 1) {
            $(".deduction-addnew-div-" + index).remove();
            $('.total-deduction').text(newTotal);
            $('.net-pay').text(netPay.toFixed(2));
        } else {
            alert("You cannot remove last entry.");
            return false;
        }
    }
</script>
<style>
    label.error {
        color: red;
        font-style: italic;
    }

    th {
        border-top: 1px solid #eaeaea;
        border-bottom: 1px solid #eaeaea;
        color: #414141;
    }

    table thead {
        background-color: #EDEEF0;
    }

    table thead th {
        padding: 5px 10px 5px 10px;
    }

    table tbody td {
        padding: 5px 10px 5px 10px;
    }

    table tbody td {
        border-top: 1px solid #eaeaea;
    }

    .id-control {
        padding: 3px 12px;
    }

    #facebox .content.fbminwidth {

        min-width: 1200px;
        min-height: 400px;
    }

    .card .card-block,
    .card .card-body {
        padding: 30px 15px;
    }

    .update {
        color: #012cae;
        cursor: pointer;
    }

    .fs-30px {
        font-size: 30px;
    }

    .red_border {
        border: 1px solid red !important;
    }

    .fs-unset {
        font-size: unset;
    }

    .h-38px {
        height: 38px !important;
    }

        {
        height: 44px !important;
    }

    .popup-table {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        border-spacing: 0;
        width: 100%;
    }

    .popup-table th {
        background-color: #edeef0;
    }

    .popup-table th,
    td {
        padding: 0.5rem !important;
    }

    .border-collapse-unset {
        border-collapse: unset !important;
    }

    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    /*Styling Selectbox*/
    .custom-dropdown {
        display: inline-block;
        /* box-shadow: 0 0 2px rgb(204, 204, 204); */
        transition: all .5s ease;
        position: relative;
        font-size: 14px;
        /* height: 100%; */
        text-align: left;

        display: inline-block;
        width: 100%;
        /* padding: .375rem .75rem; */
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .custom-dropdown .select {
        cursor: pointer;
        display: block;
        padding: 10px
    }

    .custom-dropdown .select>i {
        font-size: 13px;
        color: #888;
        cursor: pointer;
        transition: all .3s ease-in-out;
        float: right;
        line-height: 20px
    }

    .custom-dropdown:hover {
        box-shadow: 0 0 4px rgb(204, 204, 204)
    }

    .custom-dropdown.active .select>i {
        transform: rotate(-90deg)
    }

    .custom-dropdown .custom-dropdown-menu {
        position: absolute;
        background-color: #fff;
        width: 100%;
        left: 0;
        margin-top: 1px;
        /* box-shadow: 0 1px 2px rgb(204, 204, 204); */
        border-radius: 0 1px 2px 2px;
        overflow: hidden;
        display: none;
        max-height: 200px;
        overflow-y: auto;
        z-index: 9;
        border: 1px solid #ced4da;
    }

    .custom-dropdown .custom-dropdown-menu li {
        padding: 4px 12px;
        transition: all .2s ease-in-out;
        cursor: pointer
    }

    .custom-dropdown .custom-dropdown-menu {
        padding: 0;
        list-style: none
    }

    .custom-dropdown .custom-dropdown-menu li:hover {
        background-color: #f2f2f2
    }

    .custom-dropdown .custom-dropdown-menu li:active {
        background-color: #e2e2e2
    }

    .deduction-type-label-custom {
        opacity: 1 !important;
        transform: scale(1) translateY(-.5rem) translateX(.15rem) !important;
        color: #012cae;
        font-size: 13.5px;
        width: auto;
        height: 20.8px;
        padding: 0px 8px 0px 8px;
        margin: 0px 8px 0px 8px;
        background: white;
        transition: 0.2s ease-in-out;
        top: -3px !important;
        position: absolute;
        left: -8px;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
    }
</style>