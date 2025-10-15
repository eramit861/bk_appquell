// Pay Check Calculation New JavaScript

$(function() {
    var selectedFiles = [];

    function replaceAll(str, term, replacement) {
        return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
    }

    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    paystubUploadBtnClick = function(anchorElement, input_id) {
        if (!$(anchorElement).hasClass('upload-active')) {
            $(anchorElement).addClass('upload-active');
        }

        let fileInput = $('#' + input_id);

        $('#' + input_id).click(); // Trigger the hidden file input

        setTimeout(function() {
            if (!fileInput[0].files.length) {
                $(anchorElement).removeClass('upload-active');
            }
        }, 3000);
    }

    paystubChangeSelect = function(event, employer_id, selectdocId) {
        var selectedDocToMove = '';
        selectedDateToMove = event.target.value;
        var client_id = window.__payCheckCalculationData.clientId;
        var ajaxURL = window.__payCheckCalculationRoutes.paystubDateChange;
        var formData = new FormData();
        formData.append('employer_id', employer_id);
        formData.append('new_date', selectedDateToMove);
        formData.append('document_id', selectdocId);
        formData.append('client_id', client_id);

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
                selectedFiles = [];
                if (response.status == 1) {
                    $.systemMessage(response.msg, 'alert--success', true);
                    setTimeout(function() {
                        location.reload(true);
                    }, 800);
                }
                if (response.status == 0) {
                    $.systemMessage(response.msg, 'alert--danger', true);
                }
            },
            error: function(response) {
                console.log("error", response.status, response.msg);
            }
        });
    }

    paystubFileSelect = function(event, pay_date, employer_id, span_class, dataType, uploadType = '', isNotAssigned = false, dataFor) {
        var inputDT = false;
        if (dataType == "" || dataType == undefined) {
            dataType = $('#document_types').val();
            inputDT = true;
        }
        var formData = new FormData();
        formData.append('document_type', dataType);

        var autoloan_id = $('#autoloan_id').val(); // Get the autoloan ID
        formData.append('autoloan_id', autoloan_id);

        var isPaystubStatus = 1; // Replace with actual logic to determine status
        var client_id = window.__payCheckCalculationData.clientId; // Get the client ID from global data
        formData.append('client_id', client_id);

        formData.append('employer_id', employer_id);

        formData.append('isNotAssigned', isNotAssigned);
        if (event.target.type == "select-one") {
            var selectedFiles = [];
            var selectedDocToMove = event.target.value;
            formData.append('paystub_date[]', pay_date);
        } else {
            var selectedFiles = event.target.files;
            var selectedDocToMove = '';
        }

        if (uploadType == 'custom') {
            if (inputDT) {
                pay_date = $('#' + employer_id + '-').val();
                if (pay_date == '') {
                    $('#' + employer_id + '-').focus();
                    $.systemMessage('Pay Stub date should not be empty.', 'alert--danger', true);
                    return;
                }
            } else {
                pay_date = $('#' + employer_id + '-' + dataType).val();
                if (pay_date == '') {
                    $('#' + employer_id + '-' + dataType).focus();
                    $.systemMessage('Pay Stub date should not be empty.', 'alert--danger', true);
                    return;
                }
            }
        }

        formData.append('selectedDocToMove', selectedDocToMove);
        // Loop through the selected files
        for (var i = 0; i < selectedFiles.length; i++) {
            var imageFile = selectedFiles[i]; // Get the selected file
            var newName = replaceAll(imageFile.name, "_", " ");

            formData.append('document_file[]', imageFile, newName);
            formData.append('paystub_date[]', pay_date);
        }
        if (uploadType != 'custom') {
            $('.' + span_class).html('<span class="text-bold ">Uploading...</span>');
        }

        const isAdmin = window.__payCheckCalculationData.isAdmin;
        if (isAdmin == '1') {
            $.systemMessage(
                `BKQ AI is pulling all of the ${dataFor}'s payroll data from the uploaded pay stubs and importing it to Payroll Assistant with AI. Please be patient the magic takes a few minutes.`,
                'alert--process');
        } else {
            $.systemMessage("Uploading document..", 'alert--process');
        }

        var ajaxURL = window.__payCheckCalculationData.route || window.__payCheckCalculationRoutes.clientDocumentUploads;

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
                selectedFiles = [];
                if (response.status == 1) {
                    $.systemMessage(response.msg, 'alert--success', true);
                    if (uploadType == 'custom') {
                        // $('#upload_btn_'+client_id+'_'+dataType).click();                        
                        setTimeout(function() {
                            localStorage.setItem('triggerUpload', 'true');
                            localStorage.setItem('cardId', 'upload_btn_' + client_id + '_' + dataType);
                            location.reload(true);
                        }, 800);
                    } else {
                        $(event.target)
                            .closest('.payslip-item')
                            .find('.upload-btn')
                            .removeClass('upload-active')
                            .html(
                                '<i class="bi bi-cloud-arrow-up me-2"></i>&nbsp;Replace&nbsp;Pay&nbsp;Stub'
                            );

                        $(event.target)
                            .closest('.payslip-item')
                            .find('.no-paystub-label')
                            .addClass('hide-data');
                        $(event.target)
                            .closest('.payslip-item')
                            .find('.delete-paystub-label')
                            .removeClass('hide-data')
                            .attr('onclick', response.deleteFunction);

                        $(event.target)
                            .closest('.payslip-item')
                            .find('.status')
                            .removeClass('missing').addClass('uploaded')
                            .text('Uploaded');
                    }
                }
                if (response.status == 0) {
                    $.systemMessage(response.msg, 'alert--danger', true);
                }
            },
            error: function(response) {
                console.log("error", response.status, response.msg);
            }
        });
    }

});
