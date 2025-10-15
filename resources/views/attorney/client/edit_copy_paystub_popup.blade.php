<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" >
            Copy Paystub
        </h5>
    </div>

    <div class="modal-body p-1">
        <div class="card-body b-0-i">
            <form id="copy_form" action="{{route('copy_save_new_paystub')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="paystub_data_id" value="<?php echo $paystub_data['id']; ?>">
                <input type="hidden" name="client_id" value="<?php echo $paystub_data['client_id']; ?>">
                <input type="hidden" name="client_type" value="<?php echo $client_type; ?>">
                <input type="hidden" name="pay_period_start" placeholder="Pay Period Start:" value="<?php echo $paystub_data['pay_period_start']; ?>">
                <input type="hidden" name="pay_period_end" placeholder="Pay Period End:" value="<?php echo $paystub_data['pay_period_end']; ?>">
                                
                <div class="light-gray-div mt-3">
                    <h2>Paystub Details</h2>
                    <div class="row gx-3">	

                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="pay_date">Pay Date to Copy</label>
                                    <input type="date" name="pay_date" required class="required form-control" placeholder="Pay Date:" value="<?php echo $paystub_data['pay_date']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="pay_frequency">Frequency:</label>
                                    <select required class="form-control required" name="pay_frequency" id="pay_frequency">
                                        <option value="" >Please Select Frequency</option>
                                        <option value="1" >Once a week</option>
                                        <option value="2" >Every two weeks</option>
                                        <option value="3" >Twice a month</option>
                                        <option value="4" >Once a Month</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="direction">Direction:</label>
                                    <select required class="form-control required" name="direction">
                                        <option value="" disabled selected >Select One</option>
                                        <option value="0" >After</option>
                                        <option value="1" >Before</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="times">Number of Times:</label>
                                    <select required class="form-control required" name="times" id="times">
                                        <option value="" disabled selected >Select One</option>
                                        <?php for ($i = 1; $i < 13; $i++) { ?>
                                            <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
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

        function updateTimesDropdown(maxValue) {
            const timesDropdown = $('#times');
            timesDropdown.empty();
            timesDropdown.append('<option value="" disabled selected>Select One</option>');
            for (let i = 1; i <= maxValue; i++) {
                timesDropdown.append('<option value="' + i + '">' + i + '</option>');
            }
        }

        $('#pay_frequency').on('change', function() {
            const selectedFrequency = $(this).val();
            let maxValue;

            if (selectedFrequency == 1) { maxValue = 24; } else { maxValue = 12; }

            updateTimesDropdown(maxValue);
        });

        if ($('#pay_frequency').val() !== "") {
            $('#pay_frequency').trigger('change');
        }

        $("#copy_form").validate({
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
        
    }); 
</script>
<style>
label.error {color: red;font-style: italic;  }
#facebox .content.fbminwidth {
min-width: 1200px;
min-height: 300px;
}
</style>
