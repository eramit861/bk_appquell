<div class="modal-content modal-content-div conditional-ques">

    <div class="modal-header align-items-center py-2">
        <div class="row w-100 m-0">
            <div class="col-12">
                <h5 class="modal-title d-flex">
                    Resend Appointment Reminder
                </h5>
            </div>
        </div>
    </div>
    <form id="resend_appointment_form" name="resend_appointment_form" action="{{route('attorney_resend_reminder_send')}}" method="post" novalidate>
    @csrf
    <div class="modal-body">
        <div class="card-body light-gray-div mb-0">
            <h2>Appointment Details</h2>
            <input type="hidden" name="client_id" value="{{ $client_id }}">
            <div class="row ">
                <div class="col-12 col-md-6">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label >Date <small>(MM/DD/YYYY)</small></label>
                            <input name="date" type="text" value="<?php echo Helper::validate_key_value('date', $latestReminder);?>" class="date_filed form-control required " placeholder="MM/DD/YYYY">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 position-relative">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label>Time</label>
                            <input name="time" type="text" id="time" 
                                value="<?php echo Helper::validate_key_value('time', $latestReminder); ?>" 
                                class="form-control required" 
                                placeholder="Time" 
                                autocomplete="off" 
                                readonly>

                            <!-- Custom dropdown -->
                            <ul class="custom-time-dropdown" id="timeDropdown">
                                <li class="dropdown-option">Choose Time</li>
                                <?php foreach ($times as $time): ?>
                                    <li class="dropdown-option"><?php echo $time; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label >Location</label>
                            <select name="location" class="form-control required " >
                                <option disabled selected>Choose Location</option>
                                <option value="Zoom Call"   <?php echo Helper::validate_key_value('location', $latestReminder) == 'Zoom Call' ? 'selected' : ''; ?>  >Zoom Call</option>
                                <option value="Phone Call"  <?php echo Helper::validate_key_value('location', $latestReminder) == 'Phone Call' ? 'selected' : ''; ?> >Phone Call</option>
                                <option value="In person"   <?php echo Helper::validate_key_value('location', $latestReminder) == 'In person' ? 'selected' : ''; ?>  >In person</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer border-0 pt-2">
        <div class="bottom-btn-div">
            <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3" onclick="$.facebox.close();">Close</button>
            <button type="submit" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 " >Send</button>
        </div>
    </div>
    </form>

</div>

<script>
    $(document).ready(function () {

        const $input = $('#time');
        const $dropdown = $('#timeDropdown');

        // Show dropdown on input focus/click
        $input.on('focus click', function () {
            $dropdown.show();
        });

        // Set input value when an option is clicked
        $dropdown.on('click', '.dropdown-option', function () {
            if($(this).text() == 'Choose Time'){
                $input.val('');
            }else{
                $input.val($(this).text());
            }
            
            $dropdown.hide();
        });

        // Hide dropdown when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#time, #timeDropdown').length) {
                $dropdown.hide();
            }
        });


        // Validation rules
        $("#resend_appointment_form").validate({
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
