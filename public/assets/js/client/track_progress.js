// Track Progress JavaScript

function run_tutorial_videos(obj, element) {
    var video_src = $(obj).attr('data-video');
    var video_src2 = $(obj).attr('data-video2');
    $("#video").attr('src', video_src);
    $("#player1").attr('src', video_src2);
    $(".rumble").attr('src', video_src2);

    $(element).modal('show');
}

$(function() {
    if (window.__trackProgressData && window.__trackProgressData.userJustLogin) {
        $("#signed_doc_modal").modal('show');
    }

    $(".signed-popup-close--js").click(function() {
        // Session update handled server-side
    });

    if (!window.__trackProgressData || !window.__trackProgressData.webView) {
        $("#questionnaire-section-tab").on('click', 'a', function(evt) {
            $("#questionnaire-section-tab").find('a').removeClass('active');
            $("#questionnaire-section-tab").find('a').attr('aria-selected', false);
            var parent = $("#questionnaire-section-tab").find('a');
            $(parent).each(function() {
                var aria_id = $(this).attr('aria-controls');
                $("#" + aria_id).removeClass('active , show');
            });
            $(evt.currentTarget).addClass('active');
            $(evt.currentTarget).attr('aria-selected', true);
            var current_id = $(evt.currentTarget).attr('aria-controls');
            $("#" + current_id).addClass('active , show');
        });
    }
});

// Fixed navigation functionality
if (window.__trackProgressData && !window.__trackProgressData.webView) {
    window.onscroll = function() {
        fixedPressNav(window.innerWidth)
    };

    function fixedPressNav(windowWidth) {
        let width = windowWidth.toString();
        if (width > 768) {
            if (document.body.scrollTop > 210 || document.documentElement.scrollTop > 210) {
                document.getElementById("questionnaire-section-tab").className =
                    "nav flex-column nav-pills fixed-topbar";
            } else {
                document.getElementById("questionnaire-section-tab").className = "nav flex-column nav-pills";
            }
        } else {
            return
        }
    }
}

$(function() {
    $('[name="graduate"]').change(function() {
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

$(function() {
    $('#video_modal').on('hidden.bs.modal', function(e) {
        $iframe = $(this).find("iframe");
        $iframe.attr("src", $iframe.attr("src"));
    });
});

// File input functionality
'use strict';
(function(document, window, index) {
    var inputs = document.querySelectorAll('.inputfile');
    Array.prototype.forEach.call(inputs, function(input) {
        var label = input.nextElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener('change', function(e) {
            var fileName = '';
            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}',
                    this.files.length);
            else
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                label.querySelector('span').innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener('focus', function() {
            input.classList.add('has-focus');
        });
        input.addEventListener('blur', function() {
            input.classList.remove('has-focus');
        });
    });
}(document, window, 0));
