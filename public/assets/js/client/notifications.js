// Notifications Page JavaScript

markNotificationRead = function(id) {
    var url = window.__notificationsRoutes.readUserNotifications;
    if ($(".row-" + id).hasClass("unread-notification")) {
        $(".row-" + id).removeClass("unread-notification");
        $(".row-bold-" + id).removeClass("font-weight-bold");
        var counts = $(".count-notificaton-text").text();
        $(".count-notificaton-text").text('');
        if (parseInt(counts) > 0) {
            counts = parseInt(parseInt(counts) - 1);
        }
        $(".count-notificaton-text").text(counts);
    }
    laws.ajax(url, {
        id: id
    }, function(response) {
        laws.updateFaceboxContent(response, 'noti-popup');
    });
};
