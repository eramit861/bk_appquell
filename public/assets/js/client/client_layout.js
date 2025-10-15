$(function() {
    // Global functions for client layout
    window.onUploadClick = function() {
        var ajaxurl = window.__clientLayoutRoutes.addUploadClientNote;
        var client_id = window.__clientLayoutData.clientId;
        laws.ajax(ajaxurl, {
            client_id: client_id
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.facebox.close();
                window.location.href = window.__clientLayoutRoutes.listUploadedDocuments;
            }
        });
    };

    window.showHideRequestedForm = function() {
        var requestform = $('.request-edit-access-form');
        requestform.attr('class', 'request-edit-access-form');
        $('.request-edit-access-main-btn').addClass('hide-data');
    };

    window.loadNotifications = function(url) {
        laws.ajax(url, '', function(response) {
            $("#notificationList-header").toggleClass("hide-data");
            $("#notificationList-header").html(response);
        });
    };

    window.googleTranslateElementInit = function() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'es,en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    };

    window.showSignedDocPopup = function() {
        var myModal = new bootstrap.Modal(document.getElementById('signed_doc_modal'));
        // Show the modal
        myModal.show();
        $('#signed_doc_modal .signed-upload-sec').addClass('hide-data');
        $('#signed_doc_modal .signed-doc-div-parent').removeClass('hide-data');

        $(".signed_other_than_paystubs").removeClass('hide-data');
        $('.signed-input-with-image').remove();
        window.signedSelectedFiles = [];
        $('.signed-doc-name-sec').addClass('hide-data');
        $("#signed-both-licence").attr('multiple', 'multiple');
    };

    window.run_tutorial_videos = function(obj, element) {
        var video_src = $(obj).attr('data-video');
        var video_src2 = $(obj).attr('data-video2');
        $("#video").attr('src', video_src);
        $("#player1").attr('src', video_src2);
        var myModal = new bootstrap.Modal(element);
        // Show the modal
        myModal.show();
    };

    window.isValid = function(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    };

    window.finalSubmitToAttorney = function() {
        var submitModal = new bootstrap.Modal(document.getElementById('submitConfirmationModal'));
        submitModal.show();

        // Handle the confirm button click
        document.getElementById('confirmSubmitBtn').onclick = function() {
            window.location.href = window.__clientLayoutRoutes.clientFinalSubmit;
        };
    };

    // Document ready functions
    $(document).ready(function() {
        document.getElementById('video_modal').addEventListener('hidden.bs.modal', function() {
            var backdrops = document.getElementsByClassName('modal-backdrop');
            while (backdrops[0]) {
                backdrops[0].parentNode.removeChild(backdrops[0]);
            }
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            document.body.classList.remove('modal-open');
        });

        // hide #back-top first
        $(".back-to-top").hide();

        // fade in #back-top
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.back-to-top').fadeIn();
                } else {
                    $('.back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('.back-to-top a').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 50);
                return false;
            });
        });

        $('[name="graduate"]').change(function() {
            if ($('[name="graduate"]:checked').is(":checked")) {
                $('.ug').hide();
                $iframe = $('.ug').find("iframe");
                $iframe.attr("src", $iframe.attr("src"));
                $('.phd').show();
            } else {
                $('.ug').show();
                $('.phd').hide();
                $iframe = $('.phd').find("iframe");
                $iframe.attr("src", $iframe.attr("src"));
            }
        });

        // Only alphanumeric keypress validation
        $(".only_alphanumeric").keypress(function(event) {
            var character = String.fromCharCode(event.keyCode);
            return window.isValid(character);
        });

        // Session timeout and tab editability logic
        var sessionLifetime = window.__clientLayoutData.sessionLifetime * 60 * 1000;
        var warningTime = 1 * 60 * 1000;

        setTimeout(function() {
            var myModal = new bootstrap.Modal(document.getElementById('sessionTimeOutPopup'));
            myModal.show();
        }, sessionLifetime);

        var editableTab1 = window.__clientLayoutData.editableTab1;
        var editableTab2 = window.__clientLayoutData.editableTab2;
        var editableTab3 = window.__clientLayoutData.editableTab3;
        var editableTab4 = window.__clientLayoutData.editableTab4;
        var editableTab5 = window.__clientLayoutData.editableTab5;
        var editableTab6 = window.__clientLayoutData.editableTab6;

        var isBasicTab = window.__clientLayoutData.isBasicTab;
        var isPropertyTab = window.__clientLayoutData.isPropertyTab;
        var isDebtTab = window.__clientLayoutData.isDebtTab;
        var isIncomeTab = window.__clientLayoutData.isIncomeTab;
        var isExpTab = window.__clientLayoutData.isExpTab;
        var isSofaTab = window.__clientLayoutData.isSofaTab;

        var isDocumentScreen = window.__clientLayoutData.isDocumentScreen;

        if ((isBasicTab && editableTab1 != 1) || (isPropertyTab && editableTab2 != 1) || (isDebtTab && editableTab3 != 1) ||
            (isIncomeTab && editableTab4 != 1) || (isExpTab && editableTab5 != 1) || (isSofaTab && editableTab6 != 1)) {
            setTimeout(function() {
                if (isDocumentScreen == "0") {
                    var myModal = new bootstrap.Modal(document.getElementById('editRequestWarning'));
                    // Show the modal
                    myModal.show();
                }
            }, 0);
        }

        // Price field validation
        $(document).on('keyup', ".negative-price-field", function(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode != 35 && charCode != 45 && charCode != 36 && charCode != 190 &&
                    charCode != 37 && charCode != 38 && charCode != 39 && charCode != 40) &&
                (charCode < 48 || (charCode > 57 && charCode < 96 && charCode > 105)))
                e.target.value = '';
            var count = 2;
            if (e.target.value.indexOf('.') == -1 && e.keyCode != 8) {
                if (e.target.value.length >= 7) {
                    e.target.value = parseFloat(e.target.value).toFixed(count);
                }
                return;
            }
            if (((e.target.value.length - e.target.value.indexOf('.')) > count) && e.keyCode != 8) {
                if (e.target.value.length >= 7) {
                    var firstseven = e.target.value.substring(0, 10);
                    e.target.value = parseFloat(firstseven).toFixed(count);
                } else {
                    e.target.value = parseFloat(e.target.value).toFixed(count);
                }
            }
        });
        $(document).on("blur", ".negative-price-field", function(evt) {
            evt.target.value = parseFloat(evt.target.value).toFixed(2);
        });
    });
});
