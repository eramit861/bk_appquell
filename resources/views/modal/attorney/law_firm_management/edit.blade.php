<div class="modal-content modal-content-div">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
            Edit Law Firm
        </h5>
    </div>
    <div class="modal-body p-0">
        <div class="card-body b-0-i">

            <form action="{{ route('law_firm_associate_edit_save', ['id' => $user['id']]) }}" id="edit_attorny_form"
                method="post" novalidate>
                @csrf

                <div class="light-gray-div mt-3">
                    <h2>Law Firm details</h2>
                    <div class="row gx-3">

                        <div class="col-6">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">First Name</label>
                                    <input required type="text"
                                        class="input_capitalize form-control {{ $errors->has('firstName') ? 'btn-outline-danger' : '' }}"
                                        placeholder="First Name" name="firstName" value="{{ !empty($user['firstName']) ? $user['firstName'] : '' }}">
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
                                    <input required type="text"
                                        class="input_capitalize form-control {{ $errors->has('lastName') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Last Name" name="lastName" value="{{ !empty($user['lastName']) ? $user['lastName'] : '' }}">
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
                                    <input readonly type="text"
                                        class="form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Email " name="email" value="{{ !empty($user['email']) ? $user['email'] : '' }}">
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
                                    <input type="text"
                                        class="form-control {{ $errors->has('phone_no') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Phone Number" name="phone_no" value="{{ !empty($user['phone_no']) ? $user['phone_no'] : '' }}">
                                </div>
                                @if ($errors->has('phone_no'))
                                    <p class="help-block text-danger mt-2">{{ $errors->first('phone_no') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom-btn-div">
                    <button type="submit"
                        class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0">Submit</button>
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
    $(document).ready(function() {

        // Ensure phone number is formatted when value is changed
        $('input[name="phone_no"]').on('blur change input', function() {
            let phoneNumber = $(this).val();
            phoneNumber = phoneNumber.replace(/\D/g, '').substring(0, 10);
            phoneNumber = formatPhoneNumber(phoneNumber);
            $(this).val(phoneNumber);
        });

        function formatPhoneNumber(phoneNumber) {
            // Remove all non-numeric characters
            phoneNumber = phoneNumber.replace(/\D/g, '');

            // Check if the phone number has 10 digits
            if (phoneNumber.length === 10) {
                return phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            }

            return phoneNumber;
        }

        $.validator.addMethod("phoneUS", function(phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(
                    /^(?:\+?1[-.●]?|1[-.●]?)?\(?([2-9][0-9]{2})\)?[-.●]?([2-9][0-9]{2})[-.●]?([0-9]{4})$/
                    );
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
            rules: {
                firstName: {
                    required: true
                },
                lastName: {
                    required: true
                },
                phone_no: {
                    required: true,
                    phoneUS: true //or look at the additional-methods.js to see available phone validations
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true
                },
                appointment_link: {
                    required: false,
                    validURL: true
                }

            },
            messages: {
                firstName: {
                    required: "Please enter paralegal first name."
                },
                lastName: {
                    required: "Please enter paralegal last name."
                },
                phone_no: {
                    required: "Please enter valid paralegal phone number."
                },
                email: {
                    required: "Please enter valid paralegal email address."
                },
                enquiry: {
                    required: "Please enter paralegal address."
                },
                appointment_link: {
                    validURL: "Please enter a valid URL for the appointment link."
                }
            },
            onfocusout: function(element) {
                if ($(element).attr('name') === 'phone_no') {
                    $(element).val(formatPhoneNumber($(element).val()));
                }
            },

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
