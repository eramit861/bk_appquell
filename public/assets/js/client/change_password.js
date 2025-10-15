// Change Password Page JavaScript

setupNewPassword = function(url){
    var password = $("#new_password").val();
    var re_password = $("#re_new_password").val();
    laws.ajax(url, { new_password: password,confirm_password:re_password }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.message, 'alert--danger', true);
        } else {
            $.systemMessage(res.message, 'alert--success', true);
            $.facebox.close();
        }
    });
}
