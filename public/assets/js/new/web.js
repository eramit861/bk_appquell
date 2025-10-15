$(document).ready(function () {

    $('[name="graduate"]').change(function () {
        if ($('[name="graduate"]:checked').is(":checked")) {
            $('.ug').hide();
            $('.phd').show();
            $iframe = $('.ug').find("iframe");
            var srcrc = $iframe.attr("src");

            $iframe.attr("src", srcrc);
        } else {
            $('.ug').show();
            $('.phd').hide();
            $iframe = $('.phd').find("iframe");
            var srcrc = $iframe.attr("src");

            $iframe.attr("src", srcrc);
        }
    });


});

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function DetectAndServe() {
    const isWebParam = getParameterByName('web') == 1;
    const os = getMobileOperatingSystem();

    $(".body-class").removeClass("hide-data");

    if (isWebParam) return;

    $(".hide-mobile").hide();

    const btnApp = document.querySelector('#clientLoginNoticePromptModal .btn-app');

    if (os === "Android") {
        // Set Play Store link
        btnApp.href = "https://play.google.com/store/apps/details?id=com.bkassistant.scannerapp";

        let noticeModal = document.getElementById('clientLoginNoticePromptModal');
        var documentNoticeModal = new bootstrap.Modal(noticeModal);
        documentNoticeModal.show();
    }
    else if (os === "iOS") {
        // Set App Store link
        btnApp.href = "https://apps.apple.com/us/app/bk-assistant/id1619964805";

        let noticeModal = document.getElementById('clientLoginNoticePromptModal');
        var documentNoticeModal = new bootstrap.Modal(noticeModal);
        documentNoticeModal.show();
    }
}

function openFullPricing(url) {
    laws.updateFaceboxContent($(".image-outer").html(), 'large-fb-width');
    //window.open(url, "width=500,height=500,top=100,left=500")
}

$(document).ready(function () {
    $('[name="graduate"]').change(function () {
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
});


$(function () {
    $('#video_modal').on('hidden.bs.modal', function (e) {
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

$(function () {
    $('#sub_video_modal').on('hidden.bs.modal', function (e) {
        $iframe = $(this).find("iframe");
        $iframe.attr("src", $iframe.attr("src"));
    });
});

function run_tutorial_videos_sub(obj, element) {
    $(element).modal('show');
    var video_src = $(obj).attr('data-video');

    $("#sub_video").attr('src', video_src);


}

openImagePopup = function (divclass, extraclass = "") {
    var htmldiv = $("." + divclass).html();

    var html =
        '<div class="sign_up_bgs"><div class="container-fluid"><div class="row py-0 page-flex"><div class="col-md-12 pr-0 pl-0"><div class="form_colm red-flag row p-4"><div class="col-md-12 main-div"><div class="row"><div class="col-md-12"><div class="align-left">' +
        htmldiv;

    html += "</div></div></div></div></div></div></div></div></div>";
    laws.updateFaceboxContent(html, "productQuickView quickinfor " + extraclass);
};

jQuery(document).ready(function () {

    $('.price_table.pt1, .price_table.pt3').hover(

        function () {
            $('.pt2').removeClass('hover_active');
        },
        function () {
            $('.pt2').addClass('hover_active');
        }
    );

    jQuery(document).on("click", ".view_more_button", function (e) {
        e.preventDefault();
        jQuery(this).closest(".price_table").css("height", "100%").css("max-height", "100%");
        jQuery(this).addClass("view_less_button");
        jQuery(this).removeClass("view_more_button");
        jQuery(this).find("a").text("Show Less");
    });

    jQuery(document).on("click", ".view_less_button", function (e) {
        e.preventDefault();
        jQuery(this).closest(".price_table").css("height", "900px").css("max-height", "900px");
        jQuery(this).addClass("view_more_button");
        jQuery(this).removeClass("view_less_button");
        jQuery(this).find("a").text("Show More");
    });
});
