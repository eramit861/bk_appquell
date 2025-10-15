// Common Landing Page JavaScript

$(function() {
    // Check if password popup should be shown
    if (window.__commonLandingData && window.__commonLandingData.shouldShowPasswordPopup) {
        passwordChangePopup();
    }
});

passwordChangePopup = function() {
    var url = window.__commonLandingRoutes.changePasswordPopup;
    laws.ajax(url, '', function(response) {
        laws.updateFaceboxContent(response, 'medium-fb-width');
    });
}

function showSocuments() {
    if ($(".doc-required").hasClass("hide-data")) {
        $(".main-div").removeClass("col-md-12");
        $(".main-div").addClass("col-md-9");
        $(".doc-required").removeClass("hide-data");

    } else {
        $(".main-div").removeClass("col-md-9");
        $(".main-div").addClass("col-md-12");
        $(".doc-required").addClass("hide-data");
    }
}

showTaxPayingPopup = function(url) {
    laws.ajax(url, '', function(response) {
        laws.updateFaceboxContent(response, 'productQuickView');
    });
};

showVehiclePopup = function(url) {
    laws.ajax(url, '', function(response) {
        laws.updateFaceboxContent(response, 'productQuickView');
    });
};

$(function() {
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

    $('#video_modal').on('hidden.bs.modal', function(e) {
        $iframe = $(this).find("iframe");
        $iframe.attr("src", $iframe.attr("src"));
    });
});

function run_tutorial_videos(obj, element) {
    $(element).modal('show');
    var video_src = $(obj).attr('data-video');
    var video_src2 = $(obj).attr('data-video2');
    $("#video").attr('src', video_src);
    $("#player1").attr('src', video_src2);
}
