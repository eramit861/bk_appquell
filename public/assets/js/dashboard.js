/* Client Dashboard JS - extracted from dashboard.blade.php */
function run_tutorial_videos(obj, element) {
    var video_src = $(obj).attr('data-video');
    var video_src2 = $(obj).attr('data-video2');
    $("#video").attr('src', video_src);
    $("#player1").attr('src', video_src2);
    $(".rumble").attr('src', video_src2);
    $(element).modal('show');
}

$(document).ready(function () {
    if (window.userJustLogin) {
        $("#signed_doc_modal").modal('show');
    }

    $(".signed-popup-close--js").click(function () {
        // no-op placeholder for session flag clear
    });

    if (!window.web_view) {
        $("#questionnaire-section-tab").on('click', 'a', function (evt) {
            $("#questionnaire-section-tab").find('a').removeClass('active');
            $("#questionnaire-section-tab").find('a').attr('aria-selected', false);
            var parent = $("#questionnaire-section-tab").find('a');
            $(parent).each(function () {
                var aria_id = $(this).attr('aria-controls');
                $("#" + aria_id).removeClass('active , show');
            });
            $(evt.currentTarget).addClass('active');
            $(evt.currentTarget).attr('aria-selected', true);
            var current_id = $(evt.currentTarget).attr('aria-controls');
            $("#" + current_id).addClass('active , show');
        });
    }

    didSpouseLiveWithYou = function (checkValue, index) {
        if (checkValue == 1) {
            $('.spouse-live-section-' + index).removeClass('hide-data');
        }
        if (checkValue == 0) {
            $('.spouse-live-section-' + index).addClass('hide-data');
        }
    };
});

var num = 0;
function changeStep() {
    num = num + 1;
    if (num == 1) {
        var partA = document.getElementById("basic-info-part-a");
        var partB = document.getElementById("basic-info-part-b");
        partA.classList.add('hidestep');
        partB.classList.remove('hidestep');
    }
    if (num == 2) {
        var partB = document.getElementById("basic-info-part-b");
        var partC = document.getElementById("basic-info-part-c");
        partB.classList.add('hidestep');
        partC.classList.remove('hidestep');
    }
    if (num == 3) {
        var partC = document.getElementById("basic-info-part-c");
        var partD = document.getElementById("basic-info-part-d");
        partC.classList.add('hidestep');
        partD.classList.remove('hidestep');
    }
    if (num == 4) {
        var partD = document.getElementById("basic-info-part-d");
        var partE = document.getElementById("basic-info-part-e");
        partD.classList.add('hidestep');
        partE.classList.remove('hidestep');
    }
    if (num == 5) {
        var partE = document.getElementById("basic-info-part-e");
        var partF = document.getElementById("basic-info-part-f");
        partE.classList.add('hidestep');
        partF.classList.remove('hidestep');
    }
}

function reviewDocClicked(form_url) {
    $('.signed-upload-sec').removeClass('hide-data');
    $('.signed-doc-div-parent').addClass('hide-data');
    $("#form-both").attr("action", form_url);
    $("#uploadbtn_att").attr("onclick", "signedSubmitUploadDoc('" + form_url + "')");
}

function updateDocViewStatus(client_id, file_name) {
    var ajax_url = window.update_attorney_doc_view_status_url;
    laws.ajax(ajax_url, { client_id: client_id, file_name: file_name }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else {
            $.systemMessage(res.msg, 'alert--success', true);
        }
    });
}

// TOGGLE VIDEO QUERY and inputs
$(document).ready(function () {
    if (typeof googleTranslateElementInit === 'function') {
        googleTranslateElementInit();
    }

    $('[name="graduate"]').change(function () {
        if ($('[name="graduate"]:checked').is(":checked")) {
            $('.ug').hide();
            $('.phd').show();
            var $iframe = $('.ug').find("iframe");
            var srcrc = $iframe.attr("src");
            $iframe.attr("src", srcrc);
        } else {
            $('.ug').show();
            $('.phd').hide();
            var $iframe2 = $('.phd').find("iframe");
            var srcrc2 = $iframe2.attr("src");
            $iframe2.attr("src", srcrc2);
        }
    });

    $('#video_modal').on('hidden.bs.modal', function (e) {
        var $iframe = $(this).find("iframe");
        $iframe.attr("src", $iframe.attr("src"));
    });

    (function (document, window, index) {
        var inputs = document.querySelectorAll('.inputfile');
        Array.prototype.forEach.call(inputs, function (input) {
            var label = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener('change', function (e) {
                var fileName = '';
                if (this.files && this.files.length > 1)
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                else
                    fileName = e.target.value.split('\\').pop();

                if (fileName)
                    label.querySelector('span').innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });

            input.addEventListener('focus', function () { input.classList.add('has-focus'); });
            input.addEventListener('blur', function () { input.classList.remove('has-focus'); });
        });
    }(document, window, 0));
});

function showConfirmationPrompt(formId, title) {
    let smtModal = document.getElementById('questionnaireSubmitConfirmationModal');
    var submitModal = new bootstrap.Modal(smtModal);
    let onClickButtonFunction = `$("#${formId}").submit()`;
    if (formId == 'isDebtTab') {
        onClickButtonFunction = `submitdebtForms('client_debts_step2_al')`;
    }
    $(smtModal).find('.modal-title').html(`<i class="bi bi-ui-checks me-2"></i> Submit Questionnaire Confirmation - ${title}`)
    $(smtModal).find('.confirm-question').html(`Submit the <span class="text-dark text-bold">${title}</span> section? Please ensure the information is accurate and complete.`)
    $(smtModal).find('#questionnaireConfirmSubmitBtn').attr(`onclick`, onClickButtonFunction)
    submitModal.show();
}

function financialContinutedSubmit(formId, showPrompt = false) {
    var isBusinessPropertyChecked = $("[name='is_business_property[type_value]']:checked").val() === "1";
    var isFarmPropertyChecked = $("[name='is_farm_property[type_value]']:checked").val() === "1";

    if ((!isBusinessPropertyChecked || !isFarmPropertyChecked) && showPrompt) {
        showConfirmationPrompt(formId, 'Property');
    } else {
        $("#" + formId).submit();
    }
} 
