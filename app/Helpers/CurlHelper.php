<?php

namespace App\Helpers;

class CurlHelper extends Helper
{
    private const FCM_API_ACCESS_KEY = 'AAAARy30rtc:APA91bE7A8-Ktws0QtPJ8jpXYDZ9GV788pNkIiSkcK0dB2Rx1-bUh3a7lxMsf-6b75-T_NDGExFSpzPWBZLq-w8rp1FdqsDZr6M7bMK0lPy3oBpE6zL6MP4s0KLJdS2PnpsGL39Aw24g';
    private const FCM_URL = 'https://fcm.googleapis.com/fcm/send';

    private static function sendCurlRequest(string $url, array $headers, array $body)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $result = curl_exec($ch);
        if ($result === false) {
            \Log::info('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }

    public static function sendAndroidNotification(string $deviceToken, string $messageTitle, string $message, string $notifyMessage, string $notiType = "")
    {
        $notificationData = [
            'sound' => 1,
            'message' => [
                "noti_type" => $notiType,
                "notifykey" => $notifyMessage,
                'title' => $messageTitle,
            ],
            'notifykey' => $notifyMessage,
            'body' => $message,
            'title' => $messageTitle,
        ];

        $fields = [
            'registration_ids' => [$deviceToken],
            'alert' => $message,
            'sound' => 'default',
            'Notifykey' => $notiType,
            "click_action" => "HOME_KEY",
            'data' => $notificationData,
            "android" => ['priority' => "high"],
        ];

        $headers = [
            'Authorization: key=' . self::FCM_API_ACCESS_KEY,
            'Content-Type: application/json'
        ];

        return self::sendCurlRequest(self::FCM_URL, $headers, $fields);
    }

    public static function sendWebPushNotification(string $deviceToken, string $message, string $title, string $icon = '', string $clickAction = '')
    {
        $body = [
            "to" => $deviceToken,
            "notification" => [
                "body" => $message,
                "title" => $title,
                "icon" => $icon,
                "click_action" => $clickAction
            ]
        ];

        $headers = [
            'Authorization: key=' . self::FCM_API_ACCESS_KEY,
            'Content-Type: application/json'
        ];

        return self::sendCurlRequest(self::FCM_URL, $headers, $body);
    }

    public static function sendIphoneNotification(string $deviceToken, string $messageTitle, string $message, string $notifyMessage, string $notiType = "", int $totalNotiRecord = 0)
    {
        $pemFile = public_path('pemfile/Push.pem');
        $pemSecret = '123456';
        $apnsTopic = 'com.mind.bkassistant';

        $alert = [
            'title' => $messageTitle,
            'subtitle' => $message,
            'message' => $message,
        ];

        $body = [
            'title' => $messageTitle,
            'subtitle' => $message,
            'Notifykey' => $notifyMessage,
            'noti_type' => $notiType,
            'aps' => [
                'alert' => $alert,
                'badge' => $totalNotiRecord,
                'sound' => 'default',
                'details' => [
                    'title' => $messageTitle,
                    'subtitle' => $message,
                    'Notifykey' => $notifyMessage,
                    'noti_type' => $notiType,
                ],
            ],
        ];

        $url = "https://api.push.apple.com/3/device/$deviceToken";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["apns-topic: $apnsTopic"]);
        curl_setopt($ch, CURLOPT_SSLCERT, $pemFile);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $pemSecret);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode;
    }
}
