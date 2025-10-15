// Pinwheel Calculation Form JavaScript

setupPinwheelCalculation = function () {
    var ajaxurl = window.__pinwheelCalculationRoutes.submitRouteUrl;

    var priceCount = window.__pinwheelCalculationData.priceCount;
    var count = 0;
    let post = [];
    let obj = {};

    $('.typ_det').each(function () {
        if ($(this).val() != '') {
            count++;
        }
    });

    if (count != parseInt(priceCount)) {
        $.systemMessage("Please select all option", 'alert--danger');
        return false;
    }

    var string = "";
    var dname = '';
    var dvalue = '';
    var other_ded = [];
    $('.typ_det').each(function () {
        var price = $(this).attr('id');
        var key = $(this).val();

        if (key == 'other_deduction') {
            dname = $(this).data('type');
            dvalue = $(this).attr('id');
            post.push({ 'key': key, 'name': dname, "value": parseFloat(dvalue) });
        } else {
            post.push({ 'key': key, 'name': 'title', "value": parseFloat(price) });
        }

    });
    var client_id = window.__pinwheelCalculationData.clientId;
    setTimeout(function () {
        laws.ajax(ajaxurl, { items: JSON.stringify(post), client_id: client_id }, function (response) {

            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger');
            } else {
                $.systemMessage(res.msg, 'alert--success');
                $.facebox.close();

                setTimeout(function () {

                    location.reload(true);
                }, 2000);
            }
        });
    }, 2000);
}

$(function () {
    $("#pinwheel_cal_form").validate({
        errorPlacement: function (error, element) {
            if ($(element).parents(".form-group").next("label").hasClass("error")) {
                $(element).parents(".form-group").next("label").remove();
                $(element).parents(".form-group").after($(error)[0].outerHTML);
            } else {
                $(element).parents(".form-group").after($(error)[0].outerHTML);
            }
        },
        success: function (label, element) {
            label.parent().removeClass("error");

            $(element).parents(".form-group").next("label").remove();
        },
    });
});
