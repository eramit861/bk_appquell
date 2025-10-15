<div class="modal-content modal-content-div conditional-ques">

    <div class="modal-header align-items-center py-2">
        <div class="row w-100 m-0">
            <div class="col-12">
                <h5 class="modal-title d-flex">
                    {{ $formLabel }}
                </h5>
            </div>
        </div>
    </div>
    <form id="password_reset_popup_form" name="password_reset_popup_form" action="{{ $formRoute }}" method="post"
        novalidate>
        @csrf
        <div class="modal-body">
            <div class="card-body light-gray-div mb-0">
                <h2>New Password</h2>
                <input type="hidden" name="client_id" value="{{ $client_id }}">
                <div class="row ">
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label> Enter New Password:</label>
                                <div class="input-group">
                                    <input name="password" type="password" class="form-control required"
                                        placeholder="Enter New Password">
                                    <span class="input-group-text percent toggle-password cursor-pointer"><i
                                            class="bi bi-eye-fill"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label> Re-Enter New Password:</label>
                                <div class="input-group">
                                    <input name="password_confirmation" type="password" class="form-control required"
                                        placeholder="Re-Enter New Password">
                                    <span class="input-group-text percent toggle-password cursor-pointer"><i
                                            class="bi bi-eye-fill"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer border-0 pt-2">
            <div class="bottom-btn-div">
                <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 mr-3"
                    onclick="$.facebox.close();">Close</button>
                <button type="submit"
                    class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 ">Send</button>
            </div>
        </div>
    </form>

</div>

<script>
    $(document).ready(function() {

        // Toggle password visibility
        $(".toggle-password").on("click", function() {
            const $icon = $(this).find("i");
            const $input = $(this).siblings("input");

            if ($input.attr("type") === "password") {
                $input.attr("type", "text");
                $icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
            } else {
                $input.attr("type", "password");
                $icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
            }
        });

        // Validation rules
        $("#password_reset_popup_form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "[name='password']"
                }
            },
            messages: {
                password: {
                    required: "Please enter a new password",
                    minlength: "Password must be at least 6 characters"
                },
                password_confirmation: {
                    required: "Please confirm the password",
                    equalTo: "Passwords do not match"
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
