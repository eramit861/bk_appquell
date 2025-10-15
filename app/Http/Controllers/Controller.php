<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\CurlHelper;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function send_iphone_notification($device_token, $message_title, $message, $notfy_message, $noti_type = "", int $total_noti_record = 0)
    {
        return CurlHelper::sendIphoneNotification($device_token, $message_title, $message, $notfy_message, $noti_type, $total_noti_record);
    }

    public function send_android_notification_new($device_token, $message_title, $message, $notfy_message, $noti_type = "")
    {
        return CurlHelper::sendAndroidNotification($device_token, $message_title, $message, $notfy_message, $noti_type);
    }

    public function send_web_push_notification($device_token, $message, $title, $icon = false, $self_web_url = '')
    {
        return CurlHelper::sendWebPushNotification($device_token, $message, $title, $icon = false, $self_web_url);
    }
}
