// Left Navigation JavaScript

$(function() {
    $("#image-licence").on('change', function(data) {
        var imageFile = data.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function(evt) {
            $('#img__preview__DL').removeClass('hide_img_preview');
            $('#image-licence-imagePreview').attr('src', evt.target.result);
            $('#image-licence-imagePreview').hide();
            $('#image-licence-imagePreview').fadeIn(650);
        }
    });
    
    $("#pdf-licence").on('change', function(data) {
        var imageFile = data.target.files[0];
        var count_val = data.target.files.length;
        // console.log(count_val);
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function(evt) {
            $("#dropmutiple_file_name").html(count_val + " files has been selected");
            $("#dropmutiple_file_name").show();
        }
    });
});

$(".edit-img").click(function() {
    $(".doc-preview").addClass("hide_img_preview");
});

function file_upload_modal(type) {
    $("#image_document_upload_modal").find("#document_type").val(type);
    $("#image_document_upload_modal").modal('show');
}

function pdf_upload_modal(type) {
    $("#pdf_document_upload_modal").find("#document_type").val(type);
    $("#pdf_document_upload_modal").modal('show');
}

function mutiple_upload_modal(type) {
    $("#mutiple_document_upload_modal").find("#document_type").val(type);
    $("#mutiple_document_upload_modal").modal('show');
}

function finalSubmitToAttorney() {
    // Create the modal HTML
    var modalHTML = `
    <div class="modal fade" id="submitConfirmationModal" tabindex="-1" aria-labelledby="submitConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitConfirmationModalLabel">Submit Questionnaire Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit questionnaire and uploaded documents to the attorney?</p>
                    <div class="dialog-msg-warning">
                        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
                        Once you submit Your questionnaire you will not be able to make any changes
                    </div>
                    <div class="dialog-msg-warning">
                        unless your attorney gives you edit permission, You can still upload any documents!!!
                    </div>
                    <p class="mt-3">
                        I/We declare under penalty of perjury the information contained within this questionnaire 
                        as well as the uploaded documents hereto are true and correct to the best of my/our knowledge.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">I would like to make additional changes</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Yes I would like to submit everything</button>
                </div>
            </div>
        </div>
    </div>`;

    // Add the modal to the DOM
    $('body').append(modalHTML);

    // Initialize the modal
    var submitModal = new bootstrap.Modal(document.getElementById('submitConfirmationModal'));

    // Show the modal
    submitModal.show();

    // Handle the confirm button click
    $('#confirmSubmitBtn').on('click', function() {
        window.location.href = window.__leftNavigationRoutes.clientFinalSubmit;
    });

    // Clean up the modal when it's closed
    $('#submitConfirmationModal').on('hidden.bs.modal', function() {
        $(this).remove();
    });
}
