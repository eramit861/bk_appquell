<div class="modal invitemodel fade" id="add_attorney" tabindex="-1" aria-labelledby="invitemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-div">
            <div class="modal-header align-items-center py-2">
                <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i> Add Paralegal
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body b-0-i">

                    <form id="add_attorny_form" name="add_attorny_form" action="{{route('attorney_paralegal_add')}}" method="post" novalidate>
                        @csrf

                        <div class="light-gray-div mt-3">
                            <h2>Paralegal details</h2>
                            <div class="row gx-3">

                                <div class="col-sm-6 col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label for="">First Name</label>
                                            <input required type="text" id="paralegal_first_name" class="input_capitalize form-control {{ $errors->has('firstName') ? 'btn-outline-danger' : '' }}" placeholder="First Name" name="firstName" value="{{ old('firstName') }}">
                                        </div>
                                        @if ($errors->has('firstName'))
                                        <p class="help-block text-danger mt-2">{{ $errors->first('firstName') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label for="">Last Name</label>
                                            <input required type="text" class="input_capitalize form-control {{ $errors->has('lastName') ? 'btn-outline-danger' : '' }}" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}">
                                        </div>
                                        @if ($errors->has('lastName'))
                                        <p class="help-block text-danger mt-2">{{ $errors->first('lastName') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label for="">Email</label>
                                            <input required type="email" id="paralegal_email" class="form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email " name="email" value="{{ old('email') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                        <p class="help-block text-danger mt-2">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label for="">Phone Number</label>
                                            <input required type="text" class="form-control phone-field {{ $errors->has('phone_no') ? 'btn-outline-danger' : '' }}" placeholder="Phone Number " name="phone_no" value="{{ old('phone_no') }}">
                                        </div>
                                        @if ($errors->has('phone_no'))
                                        <p class="help-block text-danger mt-2">{{ $errors->first('phone_no') }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if ($isLawFirmManagementEnabled && !empty($associates))
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="label-div">
                                            <div class="form-group mb-0">
                                                <label class="">Choose Law Firms</label>
                                                <select class="form-control " name="paralegal_law_firm_id" id="paralegal_law_firm_id">
                                                    <option value="">None</option>
                                                    @foreach ($associates as $key => $associate)
                                                        <option data-email="{{ $associate['email'] }}" value="{{ $associate['id'] }}" {{ old('paralegal_law_firm_id') == $associate['id'] ? 'selected' : '' }}>{{ $associate['firstName'] }} {{ $associate['lastName'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-9 col-sm-6 col-12">
                                    <div class="label-div">
                                        <div class="form-group mb-0">
                                            <label for="">Appointment Link</label>
                                            <input type="text" class="form-control {{ $errors->has('appointment_link') ? 'btn-outline-danger' : '' }}" placeholder="Appointment Link " name="appointment_link" value="{{ old('appointment_link') }}">
                                        </div>
                                        @if ($errors->has('appointment_link'))
                                        <p class="help-block text-danger mt-2">{{ $errors->first('appointment_link') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="label-div">
                                        <div class="form-check form-group">
                                            <input type="checkbox" name="send_all_mails_to_attorney" id="send_all_mails_to_attorney" class="form-check-input" value="1" {{ old('send_all_mails_to_attorney') === '1' ? 'checked="true"' : '' }}>
                                            <label class="form-check-label pt-1" for="send_all_mails_to_attorney">Send All Emails/Text/Notification to Attorney</label>
                                        </div>
                                        @if ($errors->has('send_all_mails_to_attorney'))
                                        <p class="help-block text-danger mt-2">{{ $errors->first('send_all_mails_to_attorney') }}</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="bottom-btn-div">
                            <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    label.error {
        color: red !important;
        font-style: italic;
    }
</style>

<script>
    $(document).ready(function() {


        @if ($isLawFirmManagementEnabled && !empty($associates))
            document.getElementById('paralegal_law_firm_id').addEventListener('change', function() {
                const selectedValue = this.value;
                const selectedOption = this.options[this.selectedIndex];
                const modalTitle = document.getElementById('invitemodalLabel');
                const email = selectedOption.getAttribute('data-email');
                const emailField = document.getElementById('paralegal_email');

                if (selectedValue !== '') {
                    modalTitle.innerHTML = '<i class="bi bi-person-plus-fill me-2"></i> Add Law Firm';
                    $("#paralegal_email").val(email);
                    emailField.value = email;
                    emailField.readOnly = true;
                    $("#paralegal_email").addClass('disabled');
                }

                if (selectedValue == '') {
                    modalTitle.innerHTML = '<i class="bi bi-person-plus-fill me-2"></i> Add Paralegal';
                    emailField.value = '';
                    emailField.readOnly = false;
                    $("#paralegal_email").removeClass('disabled');
                }
            });
        @endif


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

        $("#add_attorny_form").validate({
            errorPlacement: function(error, element) {
                if ($(element).parents(".form-group").next('label').hasClass('error')) {

                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                } else {

                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
                $(element).parents(".form-group").addClass('mb-0');
            },
            success: function(label, element) {
                label.parent().removeClass('error');

                $(element).parents(".form-group").removeClass('mb-0');
                $(element).parents(".form-group").next('label').remove();
            },
        });


    });

    confirmdemo = function(demo, url) {
        if (demo == 1) {
            if (!confirm('Are you sure you want to remove this attorney from demo list?')) {
                return;
            }
            window.location.href = url;

        }
        if (demo == 0) {
            if (!confirm('Are you sure you want to add this attorney in demo attorney list?')) {
                return;
            }
            window.location.href = url;
        }
    }

    generateUrl = function(link_url, attorney_id, linkFor = '') {
        var ajaxurl = "{{ route('generate.shorten.link.post') }}";
        laws.ajax(ajaxurl, {
            attorney_id: attorney_id,
            link: link_url,
            link_for: linkFor
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                navigator.clipboard.writeText(res.url);
                prompt("Please Copy Below Url:", res.url);
            }
        });
    }
    enableFree = function(ajax_url, attorney_id, status) {
        laws.ajax(ajax_url, {
            attorney_id: attorney_id,
            status: status
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.href = '{{ route('admin_attorney_list') }}';
                }, 1000);
            }
        });
    }

    updateInviteDocSelectionStatus = function(attorney_id, status_to_update) {
        var ajax_url = "{{ route('update_invite_doc_selection_status') }}";
        laws.ajax(ajax_url, {
            attorney_id: attorney_id,
            status: status_to_update
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.href = '{{ route('admin_attorney_list') }}';
                }, 1000);
            }
        });
    }
</script>