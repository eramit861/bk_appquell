// Upload Document Form JavaScript

$(document).ready(function() {
    
    function initializeDatepicker() {
        $("input.date_picker").bind("paste", function(e) {
            e.preventDefault();
        });

        $("input.date_picker").datepicker({
            dateFormat: "mm/dd/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "0",
        });
    }

    var selectedFiles = [];
    var currentIndex = 0;
    var isPaystubStatus = 0;
    var isStatementsStatus = 0;
    var isW2Status = 0;
    var clientType = "";
    var selectedEmployerId = "";
    var isUnsecuredPage = window.__uploadDocFormData.isUnsecuredPage;
    var isAttorneyDocPage = window.__uploadDocFormData.isAttorneyDocPage;
    var progressAnimationInterval;
    var isUploading = false;

    // Function to update progress status with animated dots
    function updateProgressStatus(uploadedCount, totalCount) {
        var dots = '';
        var dotCount = (uploadedCount % 3) + 1;
        for (var i = 0; i < dotCount; i++) {
            dots += '.';
        }

        var statusText = uploadedCount + ' of ' + totalCount + ' files uploaded' + dots;
        $('.progress-status-span').text(statusText);

        // Animate dots every 500ms
        clearInterval(progressAnimationInterval);
        progressAnimationInterval = setInterval(function() {
            var currentDots = $('.progress-status-span').text();
            var baseText = currentDots.replace(/\.+$/, ''); // Remove existing dots
            var newDotCount = (currentDots.match(/\./g) || []).length + 1;
            if (newDotCount > 3) newDotCount = 1;

            var newDots = '';
            for (var i = 0; i < newDotCount; i++) {
                newDots += '.';
            }

            $('.progress-status-span').text(baseText + newDots);
        }, 500);
    }

    // Function to disable form interactions during upload
    function disableFormDuringUpload() {
        isUploading = true;

        // Disable all rename input fields
        $('.rename-field').prop('disabled', true).addClass('input-disabled');

        // Disable all cancel icons
        $('.cancel-icon').addClass('icon-disabled').css('pointer-events', 'none');

        // Disable file input
        $('#both-licence').prop('disabled', true).addClass('input-disabled');

        // Disable date inputs
        $('.paystub-date-input').prop('disabled', true).addClass('input-disabled');

        // Disable select dropdowns
        $('.statement-month-select, .debtor-select').prop('disabled', true).addClass('input-disabled');

        // Disable employer selection dropdowns
        $('.pay-date-select-button').prop('disabled', true).addClass('input-disabled');
    }

    // Function to re-enable form interactions after upload
    function enableFormAfterUpload() {
        isUploading = false;

        // Re-enable all rename input fields
        $('.rename-field').prop('disabled', false).removeClass('input-disabled');

        // Re-enable all cancel icons
        $('.cancel-icon').removeClass('icon-disabled').css('pointer-events', 'auto');

        // Re-enable file input
        $('#both-licence').prop('disabled', false).removeClass('input-disabled');

        // Re-enable date inputs
        $('.paystub-date-input').prop('disabled', false).removeClass('input-disabled');

        // Re-enable select dropdowns
        $('.statement-month-select, .debtor-select').prop('disabled', false).removeClass('input-disabled');

        // Re-enable employer selection dropdowns
        $('.pay-date-select-button').prop('disabled', false).removeClass('input-disabled');
    }

    if (isUnsecuredPage) {
        $("#both-licence").removeAttr('multiple');
    }

    $(document).on('input', '.simple_date_format', function(e) {
        var input = $(this).val();
        var formattedInput = input.replace(/\D/g, '');
        if (formattedInput.length > 2) {
            formattedInput = formattedInput.slice(0, 2) + '/' + formattedInput.slice(2);
        }
        if (formattedInput.length > 5) {
            formattedInput = formattedInput.slice(0, 5) + '/' + formattedInput.slice(5, 9);
        }
        $(this).val(formattedInput);
    });

    function formatSimpleDate(date) {
        if (!date) return '';

        let parsedDate = new Date(date);

        if (isNaN(parsedDate)) return '';

        let month = parsedDate.getMonth() + 1; // Months are 0-based
        let day = parsedDate.getDate();
        let year = parsedDate.getFullYear();

        month = month < 10 ? '0' + month : month;
        day = day < 10 ? '0' + day : day;

        return `${month}/${day}/${year}`;
    }

    addCustomSelectPayDate = function() {
        var date = $(event.target).data('date');
        var currentIndex = $(event.target).data('index');
        var employerName = $(event.target).data('employer');
        var employerId = $(event.target).data('employerid');

        var formattedInput = formatSimpleDate(date);
        $('#paystub-date-' + currentIndex).val(formattedInput);
        $('#paystub-date-' + currentIndex).attr("data-employerid", employerId);

        var dropdownMenu = $(event.target).closest('.dropdown-menu');
        dropdownMenu.find('.dropdown-item').removeClass('selected');
        $(event.target).addClass('selected');

        dropdownMenu.prev('.dropdown-toggle').html($(event.target).html());
    }

    removeCustomSelectPayDate = function() {
        var dropdownMenu = $(event.target).closest('.dropdown-menu');
        dropdownMenu.find('.dropdown-item').removeClass('selected');
        dropdownMenu.prev('.dropdown-toggle').html("Select Pay Date ");

        var currentIndex = $(event.target).data('index');
        $('#paystub-date-' + currentIndex).removeAttr("data-employerid");
    }
    
    $(document).on('input', '.rename-field', function() {
        // Check if the trimmed value is empty
        if ($(this).val().trim() === "") {
            // Add the 'border-red' class if the value is empty
            $(this).addClass('border-red');
        } else {
            // Remove the 'border-red' class if the value is not empty
            $(this).removeClass('border-red');
        }
    });

    function fetchMonthResponse(document_type) {
        return new Promise((resolve, reject) => {
            laws.ajax(window.__uploadDocFormRoutes.getStatementMonthOption, {
                document_type: document_type,
                bank_statement_months: window.__uploadDocFormData.bankStatementMonthNos,
                id: window.__uploadDocFormData.clientId
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

    $(document).on('change', '#both-licence', async function(data) {
        // Prevent file selection during upload
        if (isUploading) {
            $(this).val(''); // Clear the file input
            $.systemMessage(
                "Please wait for current upload to complete before selecting new files.",
                'alert--warning', true);
            return;
        }

        var files = data.target.files;
        if (!files.length) {
            selectedFiles = [];
            return;
        }

        var document_type = $('#document_type').val();
        if (document_type == '') {
            document_type = $('#document_types').val();
        }

        var month_response = '';
        if (!['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report', 'Debtor_Pay_Stubs',
                'Co_Debtor_Pay_Stubs'
            ].includes(document_type)) {
            try {
                month_response = await fetchMonthResponse(document_type);
            } catch (error) {
                console.error("AJAX request failed: ", error);
            }

        }

        var multipleFilesAllowed = $("#both-licence").prop('multiple');

        if (!multipleFilesAllowed && selectedFiles.length > 0) {
            selectedFiles = [];
            $(".doc-name-sec").empty();
            $('.no_data').removeClass('hide-data');
        }

        $('.doc-name-sec').removeClass('hide-data');
        $('.no_data').addClass('hide-data');
        var allowedMaxFileSize = window.__uploadDocFormData.maxSize;
        $.each(files, function(index, value) {
            var imageFile = files[index];
            var type = files[index].type;
            var name = files[index].name;
            var size = (files[index].size / 1024 / 1024).toFixed(2);

            if (size > allowedMaxFileSize) {
                $(this).val('');
                alert('The document file must not be greater than 350 MB.');
                $('.doc-name-sec').addClass('hide-data');
                $('.no_data').removeClass('hide-data');
                return;
            }

            var cancelIconExtraClass = 'default-cancel-icon';
            var showSelect = 'd-none';
            var showDateInput = 'd-none';
            var showStatementMonth = 'd-none';
            var showPayDateLabel = 'd-none';
            var nonSelectField = '';
            var forStatementMonth = '';
            if (isStatementsStatus == 1) {
                cancelIconExtraClass = 'statement-cancel-icon';
                showSelect = 'required';
                showStatementMonth = '';
                forStatementMonth = 'for-statement';
                nonSelectField = 'input-with-select';
            }
            var employerSelectBox = '';

            var customSelect = '';
            var addCustomSelect = 'false';
            if (isPaystubStatus == 1) {
                showDateInput = 'required'
                showPayDateLabel = '';
                nonSelectField = 'input-with-select';
                if (clientType === "Co_Debtor_Pay_Stubs") {
                    var addCustomSelect = window.__uploadDocFormData.isCodebtorPayCheckData;
                    employerSelectBox = $("#codebtor-employer-select").html()
                    customSelect = $($("#codebtor-pay-date-select").html());
                    customSelect.find("a.dropdown-item").each(function() {
                        $(this).attr("data-index",
                            currentIndex); // Add data-index attribute
                    });
                }
                if (clientType === "Debtor_Pay_Stubs") {
                    var addCustomSelect = window.__uploadDocFormData.isDebtorPayCheckData;
                    employerSelectBox = $("#debtor-employer-select").html()
                    selecthtml = $("#debtor-pay-date-select").html();
                    customSelect = $($("#debtor-pay-date-select").html());
                    customSelect.find("a.dropdown-item").each(function() {
                        $(this).attr("data-index",
                            currentIndex); // Add data-index attribute
                    });
                    var empA = $(
                            `.dropdown-item[data-employerid="${selectedEmployerId}"]`)
                        .trigger('click');
                }
            }

            var inputW70 = '';
            var inputW100 = '';
            var inputPr0 = '';
            if (
                isStatementsStatus != 1
                // && isPaystubStatus != 1
            ) {
                var inputW100 = 'w-100';
                var inputPr0 = 'pr-0';
            }

            if (document_type == 'W2_Last_Year' || document_type == 'W2_Year_Before' ||
                document_type == 'Pre_Filing_Bankruptcy_Certificate_CCC') {
                forStatementMonth = 'for-statement';
                inputW100 = '';
            }



            var divStart = $(
                "<div class='input-with-image input-object-div' id='input-obj-" +
                currentIndex + "'>");

            var inputPlaceholder = "Rename File";
            var inputValue = name;
            var extraClass = "";
            var inputNameLabel = "";
            var readOnly = "";
            let readOnlyDocType = ["Drivers_License", "Co_Debtor_Drivers_License",
                "Social_Security_Card", "Co_Debtor_Social_Security_Card"
            ];
            let docTypeCheck = ["Debtor_Pay_Stubs", "Co_Debtor_Pay_Stubs",
                "Other_Misc_Documents", "Miscellaneous_Documents",
                "Vehicle_Registration"
            ];
            let inputMB = ""
            let header_label_text = $('.header-label').text().trim();
            let retirement_pension_docs = window.__uploadDocFormData.retirementPensionDocs;

            if (docTypeCheck.includes(document_type)) {
                inputValue = "";
                if (document_type == "Debtor_Pay_Stubs" || document_type ==
                    "Co_Debtor_Pay_Stubs") {
                    inputValue = name;
                }
                extraClass = "border-red";
                inputNameLabel =
                    "<small class='input-with-image mt-1 ' style='color: #7e7e7e;'>Selected File: " +
                    name + "</small>";
                inputMB = "";
            }

            if (document_type == "Other_Misc_Documents") {
                $(".collection_agent_label").removeClass('hide-data');
                inputPlaceholder =
                    "Please enter creditor/collection agent name to upload Document(s)";
            }

            if (document_type == "Miscellaneous_Documents") {
                inputPlaceholder =
                    "Please enter the name of the misc. document your uploading";
            }

            if (document_type == "Vehicle_Registration") {
                inputPlaceholder =
                    "Please enter the name of the vehicle reg. document your uploading";
            }

            if (readOnlyDocType.includes(document_type)) {
                readOnly = "readonly";
                inputValue = header_label_text.replace(/\s+/g, ' ').replace(/\//g, '')
                    .replace(/\./g, '').replace(/\:/g, '');
            }

            if (retirement_pension_docs.includes(document_type)) {
                readOnly = "readonly";
                inputValue = header_label_text.replace(/\s+/g, ' ').replace(/\//g, '')
                    .replace(/\./g, '').replace(/^[^:]*:\s*/, '').replace(/\:/g, '');
            }

            if (document_type == 'Pre_Filing_Bankruptcy_Certificate_CCC') {
                readOnly = "readonly";
                inputValue = "Credit Counseling Certificate";
            }

            var dataIndex = $('.cancel-icon').length;


            var imgField = $(
                "<img src='" + window.__uploadDocFormData.assetUrl + "' alt='icon' class='icon doc-icon'>"
            );



            if (document_type == "Other_Misc_Documents") {
                $(".collection_agent_label").removeClass('hide-data');
                inputPlaceholder =
                    "Please enter creditor/collection agent name to upload Document(s)";
                inputValue = "";
                extraClass = "border-red";
            }

            if (isW2Status == 1) {
                inputPr0 = 'pr-0';
                inputW70 = 'w-70';
            }

            if (document_type.startsWith("Vehicle_Registration")) {
                readOnly = "readonly";
                inputValue = header_label_text.replace(/\s+/g, ' ').replace(/\//g, '')
                    .replace(/\./g, '').replace(/:/g, '');
            }

            if (document_type.startsWith("Mortgage_property_value") || document_type
                .startsWith("Autoloan_property_value") || document_type.startsWith(
                    "Current_Mortgage_Statement") || document_type.startsWith(
                    "Current_Auto_Loan_Statement") || document_type.startsWith(
                    "Other_Loan_Statement")) {
                readOnly = "readonly";
                inputValue = header_label_text.replace(/\s+/g, ' ').replace(/\//g, '')
                    .replace(/\./g, '').replace(/:/g, '');
            }

            if (header_label_text.startsWith("Title For ")) {
                const isYear = /^\d{4}/.test(
                    document_type); // Checks if it starts with 4 digits
                const year = parseInt(document_type.slice(0, 4), 10);
                const isValidYear = year >= 1900 && year <= new Date().getFullYear();
                if (isYear && isValidYear) {
                    readOnly = "readonly";
                    inputValue = header_label_text.replace(/\s+/g, ' ').replace(/\//g,
                        '').replace(/\./g, '').replace(/:/g, '');
                }

            }
            console.log(document_type, '::: on both licence change');
            if (document_type == "Co_Debtor_Pay_Stubs" || document_type ==
                "Debtor_Pay_Stubs") {
                cancelIconExtraClass = '';
                var inputField = $(
                    "<div class='rename-field-div " + inputW100 + " " + inputW70 +
                    " " + inputPr0 + " " + forStatementMonth + " label-div mb-0'>" +
                    employerSelectBox +
                    "<input type='hidden' class='only_alphanumeric form-control required rename-field' data-inputindex='" +
                    currentIndex + "' required placeholder='' value='" +
                    inputValue + "'><div>" + inputNameLabel + "</div></div>"
                );
                var dateField = $(
                    "<div class='paystub-date-div pay-date-select-input bg-unset ml-3 input-group " +
                    showDateInput +
                    " label-div'><input type='text' name='paystub-date' id='paystub-date-" +
                    currentIndex +
                    "' class='form-control paystub-date-input date_picker " +
                    showDateInput + "' placeholder='Enter Pay Date'> </div>");
            } else {
                var inputField = $(
                    "<div class='rename-field-div " + inputW100 + " " + inputW70 +
                    " " + inputPr0 + " " + forStatementMonth +
                    " label-div mb-0'><input " + readOnly +
                    " type='text' class='only_alphanumeric form-control required rename-field " +
                    nonSelectField + " " + inputMB + " " + inputW100 + " " +
                    extraClass + " ' data-inputindex='" +
                    currentIndex + "' required placeholder='" + inputPlaceholder +
                    "' value='" + inputValue + "'>" + inputNameLabel + "</div>");
                var dateField = $(
                    "<div class='paystub-date-div pay-date-select-input bg-unset ml-3 " +
                    showDateInput +
                    " label-div'><input type='text' name='paystub-date' id='paystub-date-" +
                    currentIndex +
                    "' class='form-control simple_date_format paystub-date-input " +
                    showDateInput + "' placeholder='Enter Pay Date' ></div>");
            }

            var selectField = ''

            divStart.append(imgField);
            divStart.append(inputField);

            // Add progress bar for each file
            var progressBar = $(
                "<div class='file-progress-container' style='display: none;'><div class='progress-bar-wrapper'><div class='progress-bar'><div class='progress-fill' style='width: 0%;'></div></div><div class='progress-text'>0%</div></div></div>"
            );


            var fileData = {
                file: imageFile,
                nameInput: inputField,
                progressBar: progressBar,
                index: currentIndex
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
                if (month_response != "" && month_response != undefined) {
                    $.each(month_response, function(month, name) {
                        if (isStatementsStatus == 1) {
                            var option = $("<option></option>").attr("value",
                                month).text(name);
                            selectField.find('select').append(option);
                        }
                    });
                }
                divStart.append(selectField);
                fileData['monthSelect'] = selectField;
            }

            var debtorSelectField = ''
            if (document_type == 'W2_Last_Year' || document_type == 'W2_Year_Before' ||
                document_type == 'Pre_Filing_Bankruptcy_Certificate_CCC') {
                var userClientType = window.__uploadDocFormData.userClientType;
                var debtorSelectOptions = "<option value=''></option>";
                if (userClientType == 1) {
                    debtorSelectOptions =
                        "<option value='Debtor' selected>Debtor</option>";
                }
                if (userClientType == 2) {
                    debtorSelectOptions =
                        "<option value=''>Choose debtor</option><option value='Debtor'>Debtor</option><option value='Non-filing Spouse'>Non-filing Spouse</option>";
                }
                if (userClientType == 3) {
                    debtorSelectOptions =
                        "<option value=''>Choose debtor</option><option value='Debtor'>Debtor</option><option value='Co-Debtor'>Co-Debtor</option>";
                }

                debtorSelectField = $(
                    "<div class='debtor-select-div label-div'><select name='debtor_select' id='debtor-select-" +
                    currentIndex +
                    "' class='form-control ml-4 w-auto debtor-select '>" +
                    debtorSelectOptions + "</select></div>");
                divStart.append(debtorSelectField);
                fileData['debtorSelect'] = debtorSelectField;
            }


            var orLabel = $(
                "<div class='label-div d-flex l-div mt-2'><label class='ml-3 mb-0 " +
                showDateInput + "'>OR</label></div>");

            var cancelImgField = $(
                "<i class='fa fa-times-circle icon cancel-icon " +
                cancelIconExtraClass + " ' data-index='" +
                currentIndex + "' aria-hidden='true'></i>");


            var divDateEnd = $("</div>");

            var divEnd = $("</div>");


            var dateDive = $("<div class='date-div d-inline-flex d-div'>");
            if (addCustomSelect == 'true') {
                dateDive.append(customSelect);
                dateDive.append(orLabel);
            }
            dateDive.append(dateField);
            dateDive.append(cancelImgField);
            dateDive.append(divDateEnd);




            // inputField.val(name);

            // divStart.append(paystubLabel);
            divStart.append(dateDive);
            divStart.append(progressBar);
            divStart.append(divEnd);
            // divStart.append(inputNameLabel);
            $('.no_data').addClass('hide-data');
            $(".doc-name-sec").append(divStart);

            if (isPaystubStatus == 1) {
                if (clientType === "Co_Debtor_Pay_Stubs") {
                    $(`.dropdown-item[data-employerid="${selectedEmployerId}"]`)
                        .trigger('click');
                }
                if (clientType === "Debtor_Pay_Stubs") {
                    $(`.dropdown-item[data-employerid="${selectedEmployerId}"]`)
                        .trigger('click');
                }
            }

            // $(".doc-name-sec").append(inputNameLabel);
            fileData['dateInput'] = dateField;
            selectedFiles.push(fileData);
            currentIndex++;
        });

        // remove error message
        if (selectedFiles.length > 0) {
            $('#input_file_error_label').removeClass('error').addClass('d-none');
        }

        initializeDatepicker();

    });


    function escapeSelector(id) {
        return id.replace(/([ #;&,.+*~':"!^$[\]()=>|\/@])/g, '\\$1');
    }

    $(document).on('click', '.cancel-icon', function() {
        // Prevent removal during upload
        if (isUploading) {
            $.systemMessage("Please wait for upload to complete before removing files.",
                'alert--warning', true);
            return;
        }

        var indexToRemove = $(this).data('index');
        selectedFiles.splice(indexToRemove, 1);

        $('#input-obj-' + indexToRemove).next('small').remove();
        $('#input-obj-' + indexToRemove).remove();
        $('.input-with-image').each(function(indexKey) {
            $(this).attr('id', 'input-obj-' + indexKey);
            $(this).find('.rename-field').attr('data-inputindex', indexKey);
            $(this).find('.cancel-icon').attr('data-index', indexKey);
            // Update progress bar index reference
            var progressBar = $(this).find('.file-progress-container');
            if (progressBar.length) {
                var fileData = selectedFiles.find(f => f.index === indexKey);
                if (fileData) {
                    fileData.progressBar = progressBar;
                }
            }
        });
    });

    submitUploadDoc = function(ajax_url = '') {
        var isclintSide = window.__uploadDocFormData.isclintSide;
        if (isclintSide == "1") {
            var type = $('#document_types').val();
        } else {
            var type = $('#document_type').val();
        }
        isW2Status = 0;

        if (['W2_Last_Year', 'W2_Year_Before', 'Pre_Filing_Bankruptcy_Certificate_CCC'].includes(
                type)) {
            isW2Status = 1;
        }


        var autoloan_id = $('#autoloan_id').val();



        if (selectedFiles.length == '0') {
            $('#input_file_error_label').addClass('error');
            $('#input_file_error_label').removeClass('d-none');
            return;
        }

        $('#input_file_error_label').removeClass('error');
        $('#input_file_error_label').addClass('d-none');

        var formData = new FormData();
        formData.append('document_type', type);
        formData.append('autoloan_id', autoloan_id);


        for (var i = 0; i < selectedFiles.length; i++) {
            var imageFile = selectedFiles[i].file;
            var nameInput = $(selectedFiles[i].nameInput[0]).find('input');
            var newName = nameInput.val();
            var original_extention = selectedFiles[i].file.name.split('.').pop();
            var targetInput = $("input.rename-field[data-inputindex='" + i + "']");

            if (newName == '') {
                $.systemMessage("Document name should not be empty.", 'alert--danger', true);
                targetInput.addClass("border-red");
                targetInput.focus();
                return false;
            } else {
                targetInput.removeClass("border-red");
            }
            if (newName.indexOf(original_extention) == -1) {
                newName = newName + '.' + original_extention;
            }
            if (isStatementsStatus == 1) {
                var monthSelectBox = $(selectedFiles[i].monthSelect[0]).find('select');
                var monthSelect = monthSelectBox.val();
                var monthSelectHtml = monthSelectBox.find('option:selected').html();
                if (monthSelect == '' && monthSelectHtml !== 'Current Month Stmt ') {
                    $.systemMessage("Document month should not be empty.", 'alert--danger', true);
                    $("#statement-month-" + i).addClass("border-red");
                    $("#statement-month-" + i).focus();
                    return false;
                } else {
                    $("#statement-month-" + i).removeClass("border-red");
                }
                // append data to formdata
                formData.append('statement_month[]', monthSelect);
            }
            if (isPaystubStatus == 1) {
                var dateInput = $(selectedFiles[i].dateInput[0]).find('input').val();
                var employer_id = $(selectedFiles[i].dateInput[0]).find('input').data('employerid');
                if (dateInput == '') {
                    $.systemMessage("Paystub date should not be empty.", 'alert--danger', true);
                    $("#paystub-date-" + i).addClass("border-red");
                    $("#paystub-date-" + i).focus();
                    return false;
                } else {
                    $("#paystub-date-" + i).removeClass("border-red");
                }
                // append data to formdata
                formData.append('paystub_date[]', dateInput);
                if (employer_id != undefined || employer_id != '') {
                    formData.append('employer_id[]', employer_id);
                } else {
                    formData.append('employer_id[]', '');
                }
                formData.append('isNotAssigned', 'true');
            }

            if (isW2Status == 1) {
                var debtorSelect = $(selectedFiles[i].debtorSelect[0]).find('select').val();
                if (debtorSelect == '') {
                    $.systemMessage("Debtor Type should not be empty.", 'alert--danger', true);
                    $("#debtor-select-" + i).addClass("border-red");
                    $("#debtor-select-" + i).focus();
                    return false;
                } else {
                    $("#debtor-select-" + i).removeClass("border-red");
                }
                // append data to formdata
                formData.append('debtor_select[]', debtorSelect);
            }
            console.log("document_file ===>", imageFile, newName);
            formData.append('document_file[]', imageFile, newName);
            formData.append('client_id', window.__uploadDocFormData.clientId);
        }

        // Disable upload button and show progress in status span
        $('#uploadbtn_att').prop('disabled', true).addClass('btn-disabled');
        updateProgressStatus(0, selectedFiles.length);

        // Disable form interactions during upload
        disableFormDuringUpload();

        // Hide all progress bars initially
        selectedFiles.forEach(function(fileData) {
            fileData.progressBar.hide();
            fileData.progressBar.find('.progress-fill').css('width', '0%');
            fileData.progressBar.find('.progress-text').text('0%');
        });

        $.systemMessage("Uploading document..", 'alert--process');
        var ajaxURL = window.__uploadDocFormData.route || window.__uploadDocFormRoutes.clientDocumentUploads;
        if (ajax_url != '') {
            ajaxURL = ajax_url;
        }
        console.log("ajaxURL ===>", ajaxURL);

        // Upload files one by one with individual progress
        uploadFilesSequentially(selectedFiles, 0, type, autoloan_id, ajaxURL);
    };

    function uploadFilesSequentially(files, currentIndex, documentType, autoloanId, ajaxURL) {
        if (currentIndex >= files.length) {
            // All files uploaded successfully
            selectedFiles = [];
            $(".doc-name-sec").empty();

            // Re-enable upload button and clear progress status
            clearInterval(progressAnimationInterval);
            $('#uploadbtn_att').prop('disabled', false).removeClass('btn-disabled');
            $('.progress-status-span').text('');

            // Re-enable form interactions
            enableFormAfterUpload();

            $("#both_document_upload_modal").modal('hide');
            $.systemMessage("All documents uploaded successfully!", 'alert--success', true);
            if (isAttorneyDocPage) {
                updateUploadedDocsHtml(documentType, window.__uploadDocFormData.clientId);
            } else {
                setTimeout(function() {
                    location.reload(true);
                }, 1500);
            }
            return;
        }

        // Function to handle upload completion (success or failure)
        function handleUploadCompletion() {
            // Get current progress from status span
            var statusText = $('.progress-status-span').text();
            var match = statusText.match(/(\d+) of (\d+) files uploaded/);
            var currentCount = match ? parseInt(match[1]) : 0;
            var totalCount = match ? parseInt(match[2]) : selectedFiles.length;

            // Update progress status
            updateProgressStatus(currentCount + 1, totalCount);

            // Continue with next file
            setTimeout(function() {
                uploadFilesSequentially(files, currentIndex + 1, documentType, autoloanId, ajaxURL);
            }, 1000);
        }

        var currentFile = files[currentIndex];

        // Update UI to show which file is currently uploading
        $('.input-with-image').removeClass('uploading-current');
        $('#input-obj-' + currentFile.index).addClass('uploading-current');

        // Show only current file's progress bar
        currentFile.progressBar.show();
        currentFile.progressBar.find('.progress-text').text('Uploading...');

        var formData = new FormData();

        // Prepare form data for current file
        formData.append('document_type', documentType);
        formData.append('autoloan_id', autoloanId);
        formData.append('client_id', window.__uploadDocFormData.clientId);

        // Add current file
        var nameInput = $(currentFile.nameInput[0]).find('input');
        var newName = nameInput.val();
        var original_extention = currentFile.file.name.split('.').pop();

        if (newName.indexOf(original_extention) == -1) {
            newName = newName + '.' + original_extention;
        }

        formData.append('document_file[]', currentFile.file, newName);

        // Add additional data based on document type
        if (isStatementsStatus == 1 && currentFile.monthSelect) {
            var monthSelectBox = $(currentFile.monthSelect[0]).find('select');
            var monthSelect = monthSelectBox.val();
            formData.append('statement_month[]', monthSelect);
        }

        if (isPaystubStatus == 1 && currentFile.dateInput) {
            var dateInput = $(currentFile.dateInput[0]).find('input').val();
            var employer_id = $(currentFile.dateInput[0]).find('input').data('employerid');
            formData.append('paystub_date[]', dateInput);
            if (employer_id != undefined && employer_id != '') {
                formData.append('employer_id[]', employer_id);
            } else {
                formData.append('employer_id[]', '');
            }
            formData.append('isNotAssigned', 'true');
        }

        if (isW2Status == 1 && currentFile.debtorSelect) {
            var debtorSelect = $(currentFile.debtorSelect[0]).find('select').val();
            formData.append('debtor_select[]', debtorSelect);
        }

        // Create XMLHttpRequest for current file
        var xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                var percentComplete = Math.round((e.loaded / e.total) * 100);

                // Format uploaded size
                var uploadedSize, uploadedUnit;
                if (e.loaded < 1024 * 1024) {
                    uploadedSize = (e.loaded / 1024).toFixed(2);
                    uploadedUnit = ' KB';
                } else {
                    uploadedSize = (e.loaded / (1024 * 1024)).toFixed(2);
                    uploadedUnit = ' MB';
                }

                // Format total size
                var totalSize, totalUnit;
                if (e.total < 1024 * 1024) {
                    totalSize = (e.total / 1024).toFixed(2);
                    totalUnit = ' KB';
                } else {
                    totalSize = (e.total / (1024 * 1024)).toFixed(2);
                    totalUnit = ' MB';
                }

                // Update only current file's progress bar with size info
                currentFile.progressBar.find('.progress-fill').css('width', percentComplete + '%');
                currentFile.progressBar.find('.progress-text').text(percentComplete + '% (' +
                    uploadedSize + uploadedUnit + ' / ' + totalSize + totalUnit + ')');
            }
        });

        xhr.addEventListener('load', function() {
            try {
                var response = JSON.parse(xhr.responseText);

                if (response.status == 1) {
                    // Current file uploaded successfully
                    var fileSize, fileUnit;
                    if (currentFile.file.size < 1024 * 1024) {
                        fileSize = (currentFile.file.size / 1024).toFixed(2);
                        fileUnit = ' KB';
                    } else {
                        fileSize = (currentFile.file.size / (1024 * 1024)).toFixed(2);
                        fileUnit = ' MB';
                    }
                    currentFile.progressBar.find('.progress-fill').css('width', '100%');
                    currentFile.progressBar.find('.progress-text').text('100% (' + fileSize +
                        fileUnit + ')');

                    // Change progress bar color to light green for completed files
                    currentFile.progressBar.find('.progress-fill').css('background', '#90EE90')
                        .addClass('completed');

                    // Change cancel icon to green check icon for successfully uploaded files
                    var cancelIcon = $('#input-obj-' + currentFile.index).find('.cancel-icon');
                    cancelIcon.removeClass('fa-times-circle fa-disabled icon-disabled').addClass(
                        'fa-check-circle');
                    cancelIcon.css('color', '#28a745');

                    // Set cursor to default for disabled inputs after successful upload
                    $('#input-obj-' + currentFile.index).find('.rename-field').css('cursor',
                        'default');
                    $('#input-obj-' + currentFile.index).find('.paystub-date-input').css('cursor',
                        'default');
                    $('#input-obj-' + currentFile.index).find('.statement-month-select').css(
                        'cursor', 'default');
                    $('#input-obj-' + currentFile.index).find('.debtor-select').css('cursor',
                        'default');
                    $('#input-obj-' + currentFile.index).find('.pay-date-select-button').css(
                        'cursor', 'default');

                    // Keep progress bar visible for successfully uploaded files
                    // currentFile.progressBar.hide(); // Removed this line to keep progress bar visible

                    // Change background color of the entire div to light green for completed files
                    $('#input-obj-' + currentFile.index).css('background-color', '#cef2ce');

                    // Upload next file after a short delay
                    setTimeout(function() {
                        handleUploadCompletion();
                    }, 500);

                } else {
                    // Current file failed
                    var fileSize, fileUnit;
                    if (currentFile.file.size < 1024 * 1024) {
                        fileSize = (currentFile.file.size / 1024).toFixed(2);
                        fileUnit = ' KB';
                    } else {
                        fileSize = (currentFile.file.size / (1024 * 1024)).toFixed(2);
                        fileUnit = ' MB';
                    }
                    currentFile.progressBar.find('.progress-fill').css('background', '#dc3545');
                    currentFile.progressBar.find('.progress-text').text('Failed (' + fileSize +
                        fileUnit + ')');

                    $.systemMessage(response.msg || "Upload failed for " + currentFile.file.name,
                        'alert--danger', true);

                    // Continue with next file
                    handleUploadCompletion();
                }

            } catch (error) {
                console.error("Error parsing response:", error);
                var fileSizeMB = (currentFile.file.size / (1024 * 1024)).toFixed(2);
                currentFile.progressBar.find('.progress-fill').css('background', '#dc3545');
                currentFile.progressBar.find('.progress-text').text('Error (' + fileSizeMB +
                    ' MB)');

                // Continue with next file
                handleUploadCompletion();
            }
        });

        xhr.addEventListener('error', function() {
            // Current file failed
            var fileSize, fileUnit;
            if (currentFile.file.size < 1024 * 1024) {
                fileSize = (currentFile.file.size / 1024).toFixed(2);
                fileUnit = ' KB';
            } else {
                fileSize = (currentFile.file.size / (1024 * 1024)).toFixed(2);
                fileUnit = ' MB';
            }
            currentFile.progressBar.find('.progress-fill').css('background', '#dc3545');
            currentFile.progressBar.find('.progress-text').text('Failed (' + fileSize + fileUnit +
                ')');

            console.log("Upload error for file:", currentFile.file.name, xhr.status, xhr
                .statusText);

            // Continue with next file
            handleUploadCompletion();
        });

        // Start upload for current file
        xhr.open('POST', ajaxURL, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.send(formData);
    };

    isValid = function(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }

    addCustomSelectEmployer = function(clickedAnchor) {
        const employerId = clickedAnchor.getAttribute('data-employerid');
        const selectedText = clickedAnchor.textContent.trim();

        // Find the parent .input-with-image container
        const parentDiv = clickedAnchor.closest('.input-with-image');
        if (!parentDiv) {
            console.error('Parent container not found');
            return;
        }

        parentDiv.querySelectorAll('.dropdown-item').forEach(item => {
            item.classList.remove('selected');
        });
        clickedAnchor.classList.add('selected');

        // Hide all .employer-paydates elements inside this container
        parentDiv.querySelectorAll('.employer-paydates').forEach(el => {
            el.style.display = 'none';
        });

        const btnGroup = parentDiv.querySelector('.employer-paydates').closest('.btn-group');
        if (btnGroup) {
            const payDateButton = btnGroup.querySelector('.pay-date-select-button.dropdown-toggle');
            if (payDateButton) {
                payDateButton.innerHTML = 'Select Pay Date';
            }
        }

        // Show the one with matching data-employer-id
        const match = parentDiv.querySelector(`.employer-paydates[data-employer-id="${employerId}"]`);
        if (match) {
            match.style.display = 'block';
        }

        const spanToUpdate = parentDiv.querySelector('.dropdown-toggle .ml-2');
        if (!spanToUpdate) {
            console.error('Dropdown toggle span not found');
            return;
        }
        spanToUpdate.textContent = selectedText;

        const payDateInput = parentDiv.querySelector('input.paystub-date-input');
        if (payDateInput) {
            payDateInput.value = '';
        }
    }

    showPopupUploadArea = function(empId) {
        $(".other_than_paystubs").removeClass('hide-data');
        selectedEmployerId = empId;
        if (clientType == "Debtor_Pay_Stubs") {
            $(".client_Debtor_Pay_Stubs").addClass('hide-data');
        }
        if (clientType == "Co_Debtor_Pay_Stubs") {
            $(".client_Co_Debtor_Pay_Stubs").addClass('hide-data');
        }
    }

    both_upload_modal = function(type, doc_name, thisclass, autoloan_id = 0, isStatements = 0, isPaystub =
        0, isW2 = 0, empId = "") {
        $isW2 = 0;
        if (['W2_Last_Year', 'W2_Year_Before'].includes(type)) {
            $isW2 = 1;
        }
        var newname = replaceAll(doc_name, "_", " ");
        newname = replaceAll(doc_name, "Tap or Click to upload: ", "");
        $('.misc-doc-div').addClass('d-none');
        $("#doc_name_uploaded").html(
            "You are Uploading Documents under: <div class='text-bold d-inline w-auto header-label " +
            thisclass + " b-none'> " + newname + "</div>");
        if (type === 'Miscellaneous_Documents') {
            $('.misc-doc-div').removeClass('d-none')
        }
        $(".collection_agent_label").addClass('hide-data');
        $(".client_Co_Debtor_Pay_Stubs").addClass('hide-data');
        $(".client_Debtor_Pay_Stubs").addClass('hide-data');
        $(".other_than_paystubs").removeClass('hide-data');
        var isclintSide = window.__uploadDocFormData.isclintSide;
        var isDebtorIncomePage = window.__uploadDocFormData.isDebtorIncomePage;
        var isCoDebtorIncomePage = window.__uploadDocFormData.isCoDebtorIncomePage;
        selectedEmployerId = empId;
        if (type == "Co_Debtor_Pay_Stubs") {
            // do this for client side
            if (isclintSide == "1" && isCoDebtorIncomePage == "1") {
                $(".other_than_paystubs").addClass('hide-data');
                $(".client_Co_Debtor_Pay_Stubs").removeClass('hide-data');
            }
            document.querySelectorAll('.employer-paydates').forEach(el => {
                el.style.display = 'none';
            });
            const match = document.querySelector(
                `.employer-paydates[data-employer-id="${selectedEmployerId}"]`);
            if (match) {
                match.style.display = 'block';
            }
            clientType = "Co_Debtor_Pay_Stubs";
        }
        if (type == "Debtor_Pay_Stubs") {
            // do this for client side
            if (isclintSide == "1" && isDebtorIncomePage == "1") {
                $(".other_than_paystubs").addClass('hide-data');
                $(".client_Debtor_Pay_Stubs").removeClass('hide-data');
            }
            document.querySelectorAll('.employer-paydates').forEach(el => {
                el.style.display = 'none';
            });
            const match = document.querySelector(
                `.employer-paydates[data-employer-id="${selectedEmployerId}"]`);
            if (match) {
                match.style.display = 'block';
            }
            clientType = "Debtor_Pay_Stubs";
        }

        $("#autoloan_id").val(autoloan_id);

        if (isclintSide == "1") {
            $("#both_document_upload_modal").find("#document_types").val(type);
        } else {
            $("#both_document_upload_modal").find("#document_type").val(type);
        }

        $('.input-with-image').remove();
        selectedFiles = [];
        $('.doc-name-sec').addClass('hide-data');
        $('.no_data').removeClass('hide-data');
        $("#both_document_upload_modal").modal('show');
        var names_arr = ['Drivers_License', 'Co_Debtor_Drivers_License', 'Social_Security_Card',
            'Co_Debtor_Social_Security_Card'
        ];

        if (names_arr.indexOf(type) > -1) {
            $("#both-licence").removeAttr('multiple');
        } else {
            $("#both-licence").attr('multiple', 'multiple');
        }

        if (isUnsecuredPage == true) {
            $("#both-licence").removeAttr('multiple');
        }

        if (autoloan_id != 0) {
            $("#both-licence").removeAttr('multiple');
        }

        if (isStatements == 1) {
            isStatementsStatus = 1;
            $(".statement-month-select").removeClass('d-none');
        } else {
            isStatementsStatus = 0;
            $(".statement-month-select").addClass('d-none');
        }

        if (isW2 == 1) {
            isW2Status = 1;
            $(".debtor-select").removeClass('d-none');
        } else {
            isW2Status = 0;
            $(".debtor-select").addClass('d-none');
        }

        if (isPaystub == 1) {
            isPaystubStatus = 1;
            $(".paystub-date-input").removeClass('d-none');
        } else {
            isPaystubStatus = 0;
            $(".paystub-date-input").addClass('d-none');
        }
    }

    function replaceAll(str, term, replacement) {
        return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
    }

    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    if (localStorage.getItem('triggerUpload') === 'true' && localStorage.getItem('cardId') != '') {
        $('#' + localStorage.getItem('cardId')).click();
        setTimeout(function() {
            localStorage.removeItem('triggerUpload');
            localStorage.removeItem('cardId');
        }, 300);
    }

});
