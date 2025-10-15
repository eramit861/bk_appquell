// Upload Document Form Signed Docs JavaScript

var signedSelectedFiles = [];
var currentIndex = 0;

$(function() {

    // Set CSS custom property for background image
    if (window.__uploadDocSignedData && window.__uploadDocSignedData.bigDocLinkImage) {
        document.documentElement.style.setProperty('--big-doc-link-image', `url("${window.__uploadDocSignedData.bigDocLinkImage}")`);
    }

    $(document).on('input', '.signed-rename-field', function() {
        // Check if the trimmed value is empty
        if ($(this).val().trim() === "") {
            // Add the 'border-red' class if the value is empty
            $(this).addClass('border-red');
        } else {
            // Remove the 'border-red' class if the value is not empty
            $(this).removeClass('border-red');
        }
    });

    function signedFetchMonthResponse(document_type) {
        return new Promise((resolve, reject) => {
            laws.ajax(window.__uploadDocSignedRoutes.getStatementMonthOption, {
                document_type: document_type,
                bank_statement_months: window.__uploadDocSignedData.bankStatementMonthNos,
                id: window.__uploadDocSignedData.clientId
            }, function(response) {
                try {
                    var res = JSON.parse(response);
                    if (res.message === 'success') {
                        resolve(res.data); // Resolve with the response data
                    } else {
                        reject("Failed to fetch data"); // Reject if something goes wrong
                    }
                } catch (error) {
                    reject("Invalid JSON response"); // Catch JSON parsing errors
                }
            });
        });
    }

    $(document).on('change', '#signed-both-licence', async function(data) {
        var files = data.target.files;

        if (!files.length) {
            signedSelectedFiles = [];
            return;
        }

        var document_type = $('#signed_document_type').val();
        if (document_type == '') {
            document_type = $('#signed_document_types').val();
        }

        var month_response = '';

        try {
            month_response = await signedFetchMonthResponse(document_type);
        } catch (error) {
            console.error("AJAX request failed: ", error);
        }

        var multipleFilesAllowed = $("#signed-both-licence").prop('multiple');

        if (!multipleFilesAllowed && signedSelectedFiles.length > 0) {
            signedSelectedFiles = [];
            $(".signed-doc-name-sec").empty();
        }
        
        $('.signed-doc-name-sec').removeClass('hide-data');
        var allowedMaxFileSize = window.__uploadDocSignedData.maxSize;
        $.each(files, function(index, value) {
            var imageFile = files[index];
            var type = files[index].type;
            var name = files[index].name;
            var size = (files[index].size / 1024 / 1024).toFixed(2);

            if (size > allowedMaxFileSize) {
                $(this).val('');
                alert('The document file must not be greater than 350 MB.');
                $('.signed-doc-name-sec').addClass('hide-data');
                return;
            }

            var showSelect = 'd-none';
            var showDateInput = 'd-none';
            var showStatementMonth = 'd-none';
            var showPayDateLabel = 'd-none';
            var nonSelectField = '';
            var forStatementMonth = '';
            var customSelect = '';
            var inputW70 = '';
            var inputW100 = '';
            var inputPr0 = '';
            var divStart = $(
                "<div class='signed-input-with-image' id='signed_input-obj-" +
                currentIndex + "'>");
            var inputPlaceholder = "Rename File";
            var inputValue = name;
            var extraClass = "";
            var inputNameLabel = "";
            var readOnly = "";
            let inputMB = "mb-3"
            let header_label_text = $('.signed-header-label').text().trim();
            var dataIndex = $('.signed-cancel-icon').length;

            var imgField = $(
                "<img src='" + window.__uploadDocSignedData.assetUrl + "' alt='icon' class='icon doc-icon'>"
            );

            var inputField = $(
                "<div class='signed-rename-field-div " + inputW100 + " " +
                inputW70 + " " + inputPr0 + " " + forStatementMonth +
                " label-div mb-0'><input " + readOnly +
                " type='text' class='only_alphanumeric form-control required signed-rename-field " +
                nonSelectField + " " + inputMB + " " + inputW100 + " " +
                extraClass + " ' data-inputindex='" +
                currentIndex + "' required placeholder='" + inputPlaceholder +
                "' value='" + inputValue + "'>" + inputNameLabel + "</div>");

            var selectField = ''

            divStart.append(imgField);
            divStart.append(inputField);

            var fileData = {
                file: imageFile,
                nameInput: inputField,
            };

            if ((document_type != 'Debtor_Pay_Stubs' && document_type !=
                    'Co_Debtor_Pay_Stubs')) {
                selectField = $("<div class='statement-month-div " +
                    showStatementMonth +
                    " label-div'><select name='statement-month' id='statement-month-" +
                    currentIndex +
                    "' class='form-control ml-4 w-auto  statement-month-select required" +
                    showSelect +
                    "'><option value=''>Choose month</option></select></div>");
                divStart.append(selectField);
                fileData['monthSelect'] = selectField;
            }

            var debtorSelectField = '';
            var dateField = $("");
            var orLabel = $(
                "<div class='label-div d-flex align-items-center'><label class='ml-3 mb-0 " +
                showDateInput + "'>OR</label></div>");

            var cancelImgField = $(
                "<i class='fa fa-times-circle icon signed-cancel-icon ' data-index='" +
                currentIndex + "' aria-hidden='true'></i>");

            var divDateEnd = $("</div>");
            var divEnd = $("</div>");

            var dateDive = $("<div class='date-div d-inline-flex'>");
            dateDive.append(dateField);
            dateDive.append(cancelImgField);
            dateDive.append(divDateEnd);

            divStart.append(dateDive);
            divStart.append(divEnd);
            $(".signed-doc-name-sec").append(divStart);
            fileData['dateInput'] = dateField;
            signedSelectedFiles.push(fileData);
            currentIndex++;
        });

        // remove error message
        if (signedSelectedFiles.length > 0) {
            $('#signed_input_file_error_label').removeClass('error').addClass('d-none');
        }
    });

    $(document).on('click', '.signed-cancel-icon', function() {
        var indexToRemove = $(this).data('index');
        signedSelectedFiles.splice(indexToRemove, 1);

        $('#signed_input-obj-' + indexToRemove).next('small').remove();
        $('#signed_input-obj-' + indexToRemove).remove();
        $('.signed-input-with-image').each(function(indexKey) {
            $(this).attr('id', 'signed_input-obj-' + indexKey);
            $(this).find('.signed-rename-field').attr('data-inputindex', indexKey);
            $(this).find('.signed-cancel-icon').attr('data-index', indexKey);
        });
    });

    if (localStorage.getItem('signedTriggerUpload') === 'true' && localStorage.getItem('signedCardId') !=
        '') {
        $('#' + localStorage.getItem('signedCardId')).click();
        setTimeout(function() {
            localStorage.removeItem('signedTriggerUpload');
            localStorage.removeItem('signedCardId');
        }, 300);
    }
});

signedSubmitUploadDoc = function(ajax_url = '') {
    var type = $('#signed_document_types').val();
    var autoloan_id = $('#autoloan_id').val();

    if (signedSelectedFiles.length == '0') {
        $('#signed_input_file_error_label').addClass('error');
        $('#signed_input_file_error_label').removeClass('d-none');
        return;
    }

    $('#signed_input_file_error_label').removeClass('error');
    $('#signed_input_file_error_label').addClass('d-none');

    var formData = new FormData();
    formData.append('document_type', type);
    formData.append('autoloan_id', autoloan_id);

    for (var i = 0; i < signedSelectedFiles.length; i++) {
        var imageFile = signedSelectedFiles[i].file;
        var nameInput = $(signedSelectedFiles[i].nameInput[0]).find('input');
        var newName = nameInput.val();
        var original_extention = signedSelectedFiles[i].file.name.split('.').pop();
        var targetInput = $("input.signed-rename-field[data-inputindex='" + i + "']");

        if (newName == '') {
            $.systemMessage("Document name should not be empty.", 'alert--danger', true);
            targetInput.addClass("border-red");
            targetInput.focus();
            return false;
        } else {
            targetInput.removeClass("border-red");
        }
        if (!newName.toLowerCase().endsWith('.' + original_extention.toLowerCase())) {
            newName = newName + '.' + original_extention;
        }
        console.log("document_file ===>", imageFile, newName);
        formData.append('document_file[]', imageFile, newName);
        formData.append('client_id', window.__uploadDocSignedData.clientId);
    }

    $.systemMessage("Uploading document..", 'alert--process');
    var ajaxURL = window.__uploadDocSignedData.route || window.__uploadDocSignedRoutes.clientDocumentUploads;
    if (ajax_url != '') {
        ajaxURL = ajax_url;
    }
    console.log("ajaxURL ===>", ajaxURL);
    $.ajax({
        url: ajaxURL,
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: false,
        processData: false,
        success: function(response) {
            signedSelectedFiles = [];
            $(".signed-doc-name-sec").empty();
            $("#signed_both_document_upload_modal").modal('hide');
            if (response.status == 1) {
                $.systemMessage(response.msg, 'alert--success', true);
                setTimeout(function() {
                    location.reload(true);
                }, 1500);
            }
            if (response.status == 0) {
                $.systemMessage(response.msg, 'alert--danger', true);
            }
        },
        error: function(response) {
            console.log("error", response.status, response.msg);
            $.systemMessage("Upload failed. Please try again.", 'alert--danger', true);
        }
    });
};

signedIsValid = function(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}

function signedReplaceAll(str, term, replacement) {
    return str.replace(new RegExp(signedEscapeRegExp(term), 'g'), replacement);
}

function signedEscapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}
