<div class="modal-content modal-content-div conditional-ques" id="automated_notification_template_preview">
    <div class="modal-header align-items-center py-2">
        <div class="row w-100 m-0">
            <div class="col-12">
                <h5 class="modal-title d-flex">
                    <label for="template_preview_label">Preview - {{ $templateType == 1 ? 'Not Logged In Client(s)' : 'Questionnaire not completed Client(s)' }}</label>
                </h5>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <div class="template_preview">
            @include('emails.automated_notification_template_logged_in_user', ['name' => '{client_name}', 'emailMessage' => $message])
        </div>
    </div>
</div>