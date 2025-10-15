
@php
    $splitName = \App\Helpers\Helper::splitName($user['name']);
@endphp

<div class="modal-content modal-content-div">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="edit_invitemodalLabel">
        <i class="bi bi-person-plus-fill me-2"></i> Edit Paralegal
        </h5>
    </div>
    <div class="modal-body p-0">
        <div class="card-body b-0-i">

            <form action="{{route('attorney_paralegal_edit',['id'=>$user['id']])}}" id="edit_attorny_form" method="post" novalidate>
                @csrf

                <div class="light-gray-div mt-3">
                    <h2>Paralegal details</h2>
                    <div class="row gx-3">

                        <div class="col-6">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">First Name</label>
                                    <input required type="text" class="input_capitalize form-control {{ $errors->has('firstName') ? 'btn-outline-danger' : '' }}" placeholder="First Name" name="firstName" value="{{ !empty($splitName[0]) ? $splitName[0] : '' }}">
                                </div>
                                @if ($errors->has('firstName'))
                                    <p class="help-block text-danger mt-2">{{ $errors->first('firstName') }}</p>
                                @endif
                            </div>
                        </div>
                                                    
                        <div class="col-6">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">Last Name</label>
                                    <input required type="text" class="input_capitalize form-control {{ $errors->has('lastName') ? 'btn-outline-danger' : '' }}" placeholder="Last Name" name="lastName" value="{{ !empty($splitName[1]) ? $splitName[1] : '' }}">
                                </div>
                                @if ($errors->has('lastName'))
                                    <p class="help-block text-danger mt-2">{{ $errors->first('lastName') }}</p>
                                @endif
                            </div>
                        </div>
                                                    
                        <div class="col-6">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">Email</label>
                                    <input @if (!empty($user['paralegal_law_firm_id'])) readonly @endif id="edit_paralegal_email" type="text" class="@if (!empty($user['paralegal_law_firm_id'])) disabled @endif form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email " name="email" value="{{ !empty($user['email']) ? $user['email'] : '' }}">
                                </div>
                                @if ($errors->has('email'))
                                    <p class="help-block text-danger mt-2">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                                                    
                        <div class="col-6">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control {{ $errors->has('phone_no') ? 'btn-outline-danger' : '' }}" placeholder="Phone Number" name="phone_no" value="{{ !empty($user['phone_no']) ? $user['phone_no'] : '' }}">
                                    </div>
                                @if ($errors->has('phone_no'))
                                    <p class="help-block text-danger mt-2">{{ $errors->first('phone_no') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- @if ($isLawFirmManagementEnabled && !empty($associates)) -->
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="label-div">
                                            <div class="form-group mb-0">
                                                <label class="">Choose Law Firms</label>
                                                <select class="form-control " name="paralegal_law_firm_id" id="edit_paralegal_law_firm_id">
                                                    <option value="">None</option>
                                                    @foreach ($associates as $key => $associate)
                                                        <option data-eemail="{{ $associate['email'] }}" value="{{ $associate['id'] }}" {{ $user['paralegal_law_firm_id'] == $associate['id'] ? 'selected' : '' }}>{{ $associate['firstName'] }} {{ $associate['lastName'] }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <!-- @endif -->
                                                    
                                <div class="col-md-9 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">Appointment Link</label>
                                    <input type="text" class="form-control {{ $errors->has('appointment_link') ? 'btn-outline-danger' : '' }}" placeholder="Appointment Link " name="appointment_link" value="{{ !empty($user['appointment_link']) ? $user['appointment_link'] : '' }}">
                                </div>
                                @if ($errors->has('appointment_link'))
                                    <p class="help-block text-danger mt-2">{{ $errors->first('appointment_link') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="send_all_mails_to_attorney" id="send_all_mails_to_attorney_edit" class="form-check-input {{ $errors->has('send_all_mails_to_attorney') ? 'btn-outline-danger' : '' }}" value="1" {{ ($user['send_all_mails_to_attorney'] == 1) ? 'checked="true"' : '' }}>
                                    <label class="form-check-label pt-1" for="send_all_mails_to_attorney_edit">Send All Emails/Text/Notification to Attorney</label>
                                </div>                                
                                @if ($errors->has('send_all_mails_to_attorney'))
                                    <p class="help-block text-danger mt-2">{{ $errors->first('send_all_mails_to_attorney') }}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bottom-btn-div">
                    <button type="submit" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    label.error {
        color: red;
        font-style: italic;
    }
</style>

<script>

document.getElementById('edit_paralegal_law_firm_id').addEventListener('change', function () {
                const selectedValue = this.value;
                const selectedOption = this.options[this.selectedIndex];
                const modalTitle = document.getElementById('edit_invitemodalLabel');
                const email = selectedOption.getAttribute('data-eemail');
                const emailField = document.getElementById('edit_paralegal_email');
                
                if (selectedValue !== '') {
                    modalTitle.innerHTML = '<i class="bi bi-person-plus-fill me-2"></i> Edit Law Firm';
                    $("#edit_paralegal_email").val(email);
                    emailField.value = email;
                    emailField.readOnly = true;
                    $("#edit_paralegal_email").addClass('disabled');
                } 
                
                if (selectedValue == '') {
                    modalTitle.innerHTML = '<i class="bi bi-person-plus-fill me-2"></i> Edit Paralegal';
                    emailField.value = '';
                    emailField.readOnly = false;
                    $("#edit_paralegal_email").removeClass('disabled');
                }
            });


    $(document).ready(function(){

       
        $.validator.addMethod("phoneUS", function(phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(?:\+?1[-.●]?|1[-.●]?)?\(?([2-9][0-9]{2})\)?[-.●]?([2-9][0-9]{2})[-.●]?([0-9]{4})$/);
        }, "Please specify a valid phone number");

        $.validator.addMethod("validURL", function(value, element) {
            if (this.optional(element)) {
                return true;
            }
            var url = value;
            // If the value doesn't start with http:// or https://, add http://
            if (!/^https?:\/\//i.test(url)) {
                url = 'http://' + url;
            }
            // Use a regular expression to check if it's a valid URL
            var pattern = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-]*)*(\?[\w\-=&]*)?$/;
            return pattern.test(url);
        }, "Please enter a valid URL for the appointment link.");

        $("#edit_attorny_form").validate({
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