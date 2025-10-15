<div class="modal-content modal-content-div conditional-ques">
    
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" >
            Monthly Pay by Month
        </h5>
    </div>

    <div class="modal-body p-0">
        <div class="card-body b-0-i">
            <form id="monthly_pay_form" action="{{ route('save_monthly_pay_form') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                <input type="hidden" name="client_type" value="<?php echo $client_type; ?>">
                <?php
                    $defaultDate = new DateTime('first day of next month');
                $defaultDateStr = $defaultDate->format('m/d/Y');
                ?>

                <div class="light-gray-div mt-3">
                    <h2>Monthly Pay Details</h2>
                    <div class="row gx-3 w-100 m-0">	

                        <div class="col-12 col-sm-6 col-md-3 ">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="pay_date">Please enter expected filing date</label>
                                    <input type="text" name="pay_date" required class="required date_picker pay_date form-control " placeholder="Pay Date:" value="<?php echo $defaultDateStr; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div mb-0">
                                <div class="form-group mb-0">
                                    <label>6 individual months</label>
                                </div>
                            </div>
                            <div class="card information-area calculation">
                                <div class="table-responsive">
                                    <table class="table table-responsive months_table" id="months_table">
                                        <thead class="bg-unset">
                                            <tr>
                                                <th class="w-10">Month</th>
                                                <th class="w-20">Income</th>
                                                <th class="w-70">Employer <span class="ad_em_notice">If you did not find your employer in the below list you can add by click <a href="javascript:void(0)" onclick="manageEmployer('<?php echo $client_id; ?>', '<?php echo $client_type; ?>')" class="new-employer-btn"><i class="feather icon-plus"></i> <span class="border-bottom-light-blue">Add New Employer</span></a>.</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be added here by jQuery -->
                                        </tbody>
                                        <tfoot>
                                            <tr style="border-top:1px solid #ededed;">
                                                <td>Total:</td>
                                                <td class="font-weight-bold" id="total_income">$ 0.00</td>
                                                <td><input type="hidden" name="total"></td>
                                            </tr>
                                            <tr>
                                                <td>Average:</td>
                                                <td class="font-weight-bold" id="average_income">$ 0.00</td>
                                                <td><input type="hidden" name="average"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    initializeDatepicker();

    $("#monthly_pay_form").validate({
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
    
    const payDateInput = $('.pay_date');
    const monthsTableBody = $('#months_table tbody');
    const totalIncomeCell = $('#total_income');
    const averageIncomeCell = $('#average_income');
    const employerList = <?php echo json_encode($employerList); ?>; // PHP array to JavaScript object
    const payFrequencyLabels = <?php echo json_encode(Helper::getPayFrequencyLabel()); ?>;

    function createRow(index, monthYear, employerCellContent) {
        return `
            <tr>
                <td>${monthYear}<input type="hidden" name="month[${index}]" value="${monthYear}"></td>
                <td><div class="label-div mb-0"><div class="form-group mb-0"><input type="number" name="income[${index}]" placeholder="0.00" class="price-field required form-control w-auto  income-input"></div></div></td>
                <td><div class="label-div mb-0"><div class="form-group w-auto mb-0 employer-cell"><div class="d-flex"><div class="w-auto">${employerCellContent}</div><div class="w-100 d-flex align-items-center"><span class="invalid-employer text-bold text-danger ml-3 d-none" ></span></div></div></div></div></td>
            </tr>
        `;
    }

    function getEmployerCellContent(index) {
        if (employerList.length === 1) {
            return `${employerList[0].employer_name}<input type="hidden" name="employer[${index}]" value="${employerList[0].employer_id}">`
        } else if (employerList.length > 1) {
            let selectOptions = '<option value="" data-frequency="">Select Employer</option>';
            employerList.forEach(employer => {
                selectOptions += `<option value="${employer.employer_id}" data-frequency="${employer.frequency}">${employer.employer_name}</option>`;
            });
            return `<select name="employer[${index}]" class="form-control required w-auto employer-select">${selectOptions}</select>`;
        }
        return '';
    }

    function updateMonths(selectedDate) {
        // Clear the table body, except for Total and Average rows
        monthsTableBody.empty();

        if (!selectedDate) {
            const index = 0; // Index starting from 1
            const employerCellContent = getEmployerCellContent(index);
            const row = createRow(index, 'MM/YYYY', employerCellContent);
            monthsTableBody.append(row);
        } else {
            const date = new Date(selectedDate);
            for (let i = 0; i < 6; i++) {
                date.setMonth(date.getMonth() - 1);
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Add leading zero
                const year = date.getFullYear();
                const index = i; // Index starting from 0
                const employerCellContent = getEmployerCellContent(index);
                const row = createRow(index, `${month}/${year}`, employerCellContent);
                monthsTableBody.append(row);
            }
        }

        // Recalculate total and average on income input change
        $('.income-input').on('change blur input', function() {
            calculateTotalAndAverage();
        });
        $('.income-input').on('change blur', function() {
            const price = parseFloat($(this).val()).toFixed(2);
            $(this).val(price);
        });

        

        // Attach change event listener to employer select boxes
        $('.employer-select').on('change', function() {
            validateEmployer($(this));
        });

    }
    
    function validateEmployer(selectElement) {
        const selectedOption = selectElement.find('option:selected');
        const selectedValue = selectedOption.val();
        const invalidEmployerMessage = selectElement.closest('.employer-cell').find('.invalid-employer');
        
        if (selectedValue === '') {
            invalidEmployerMessage.addClass('d-none');
            return;
        }
        
        const selectedFrequency = selectedOption.data('frequency');
        const frequencyLabel = payFrequencyLabels[selectedFrequency];

        let errorMsg = `<i class="fa text-c-red blink fa-exclamation-triangle" aria-hidden="true"></i>Note: This employer paid the Co-Debtor <span class="text-decoration-underline">${frequencyLabel}</span> this will import as total pay for the month.`;
        const client_type = <?php echo json_encode($client_type); ?>; // Convert PHP variable to JSON
        
        if (client_type === 'debtor') {
            errorMsg = `<i class="fa text-c-red blink fa-exclamation-triangle" aria-hidden="true"></i>Note: This employer paid the Debtor <span class="text-decoration-underline">${frequencyLabel}</span> this will import as total pay for the month.`;
        }
        
        if (selectedFrequency === '' || selectedFrequency != 4) {
            invalidEmployerMessage.removeClass('d-none');
            invalidEmployerMessage.html(errorMsg);
        } else {
            invalidEmployerMessage.addClass('d-none');
            invalidEmployerMessage.html('');
        }
    }

    function calculateTotalAndAverage() {
        let total = 0;
        let count = 0;
        $('.income-input').each(function() {
            const income = parseFloat($(this).val()) || 0;
            total += income;
            if (income) {
                count++;
            }
        });
        const average = total / (count || 1);
        totalIncomeCell.text('$ '+(total.toFixed(2)).toLocaleString());
        averageIncomeCell.text('$ '+ (average.toFixed(2)).toLocaleString());
        $('input[name="total"]').val(total.toFixed(2));
        $('input[name="average"]').val(average.toFixed(2));
    }

    // Initialize the table with the default date
    updateMonths(payDateInput.val());

    // Update the table when the date input changes
    payDateInput.on('change', function() {
        updateMonths(this.value);
    });

    function initializeDatepicker() {
        $("input.date_picker").bind("paste", function (e) {
            e.preventDefault();
        });
        
        $("input.date_picker").datepicker({
            dateFormat: "mm/dd/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "0",
        });
    }

});
</script>

<style>
label.error { color: red; font-style: italic; }
th {
    border-top: 1px solid #eaeaea;
    border-bottom: 1px solid #eaeaea;
    color: #414141;
}
table thead {
    background-color: #EDEEF0;
} 
table thead th, table tbody td, table tfoot td {
    padding: 5px 10px;
}
table tbody td {
    border-top: 1px solid #eaeaea;
}
.id-control {
    padding: 3px 12px;
}
#facebox .content.fbminwidth {
    margin-top: 40px !important;
    min-width: 1200px;
    min-height: 300px;
}
.card .card-block, .card .card-body {
    padding: 30px 15px;
}
.update {
    color: #012cae;
    cursor: pointer;
}
.fs-30px {
    font-size: 30px;
}
.fs-unset {
    font-size: unset;
}
.h-38px {
    height: 38px !important;
}

.bt-none {
    border-top: none !important;
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
.popup-table th, td {
    padding: 0.5rem !important;
}
.border-collapse-unset {
    border-collapse: unset !important;
}
.h-44px {
    height: 44px !important;
}
.h-90px {
    height: 90px !important;
}
.fs-42px {
    font-size: 42px;
}
input[type=number] {
  -moz-appearance: textfield;
}
.ad_em_notice {
    font-size: 10px;
    float: right;
    line-height: 22px;
}
.invalid-employer {
    font-size: 10px;
    display: block;
    float: right !important;
}
</style>
