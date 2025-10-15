function getMobileOperatingSystem() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;

    // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }

    if (/android/i.test(userAgent)) {
        return "Android";
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }

    return "unknown";
}

$(document).ready(function () {

    $("#client_login_form").validate({

        errorPlacement: function (error, element) {
            if ($(element).parents(".form-group").next('label').hasClass('error')) {

                $(element).parents(".form-group").next('label').remove();
                $(element).parents(".form-group").after($(error)[0].outerHTML);
            } else {

                $(element).parents(".form-group").after($(error)[0].outerHTML);
            }
        },
        success: function (label, element) {
            label.parent().removeClass('error');

            $(element).parents(".form-group").next('label').remove();
        },
    });
    loginEye();
});

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/firebase-messaging-sw.js');
    });
}
const firebaseConfig = {
    apiKey: "AIzaSyB4qmcvN2S_7UdbqTbKrvYlwAjNYeqm02o",
    authDomain: "bk-assistant-58ee3.firebaseapp.com",
    projectId: "bk-assistant-58ee3",
    storageBucket: "bk-assistant-58ee3.appspot.com",
    messagingSenderId: "305713688279",
    appId: "1:305713688279:web:e127af73828f04a0440a92",
    measurementId: "G-3R6KQFJRZ2"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

function IntitalizeFireBaseMessaging() {
    messaging
        .requestPermission()
        .then(function () {
            // console.log("Notification Permission");
            return messaging.getToken();
        })
        .then(function (token) {
            // console.log("Token : "+token);
            document.getElementById("uuid_token").value = token;
        })
        .catch(function (reason) {
            console.log(reason);
        });
}

messaging.onMessage(function (payload) {
    // console.log(payload);
    const notificationOption = {
        body: payload.notification.body,
        icon: payload.notification.icon
    };

    if (Notification.permission === "granted") {
        var notification = new Notification(payload.notification.title, notificationOption);

        notification.onclick = function (ev) {
            ev.preventDefault();
            window.open(payload.notification.click_action, '_blank');
            notification.close();
        }
    }

});
messaging.onTokenRefresh(function () {
    messaging.getToken()
        .then(function (newtoken) {
            console.log("New Token : " + newtoken);
            document.getElementById("uuid_token").value = newtoken;
        })
        .catch(function (reason) {
            console.log(reason);
            //alert(reason);
        })
})
IntitalizeFireBaseMessaging();