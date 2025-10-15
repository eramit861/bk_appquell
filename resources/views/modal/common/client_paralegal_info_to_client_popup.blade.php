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
    <form id="send_paralegal_info_to_client" name="send_paralegal_info_to_client" action="{{ $formRoute }}"
        method="post" novalidate>
        @csrf
        <div class="modal-body">
            <div class="card-body light-gray-div mb-0">
                <h2>Paralegal Details</h2>

                <input type="hidden" name="client_id" value="{{ $client_id }}">
                <input type="hidden" name="paralegal_id" value="{{ $paralegal_id }}">
                <input type="hidden" name="attorney_id" value="{{ $attorney_id }}">

                <input type="hidden" name="name" value="{{ $paralegal->name }}">
                <input type="hidden" name="phone_no" value="{{ $paralegal->phone_no }}">
                <input type="hidden" name="email" value="{{ $paralegal->email }}">
                <input type="hidden" name="appointment_link" value="{{ $paralegal->appointment_link }}">

                <div class="row ">
                    <div class="col-12 col-md-6">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Name: <span class="text-bold">{{ $paralegal->name }}</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Phone No: <span class="text-bold">{{ $paralegal->phone_no }}</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Email: <span class="text-bold">{{ $paralegal->email }}</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Appointment Link: <span
                                        class="text-bold">{{ $paralegal->appointment_link }}</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="label-div mb-0">
                            <div class="form-group">
                                <label>Message:</label>
                                <textarea name="extra_message" class="form-control" placeholder="Message" rows="3">Please find below the details of the paralegal assigned to your case.</textarea>
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
        $("#send_paralegal_info_to_client").validate({
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
