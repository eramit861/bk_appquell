<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\VideoHelper;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Message;

class AttorneyChatController extends Controller
{
    public function clientchat(Request $request)
    {
        $client_id = $request->input('id');

        if ($client_id > 0 && !Helper::isClientBelongsToAttorney($client_id, Auth::user()->id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        $attorney_id = Auth::user()->id;
        $chatavailable = Message::where('from_user_id', $client_id)->orWhere('to_user_id', $client_id)->first();
        if ($client_id > 0 && $attorney_id > 0 && empty($chatavailable)) {
            $timeStamp = date("Y-m-d H:i:s");
            Message::insert(['created_at' => $timeStamp,'updated_at' => $timeStamp,'sent_at' => $timeStamp,'from_user_id' => $client_id,'to_user_id' => $attorney_id,'original_language' => 1,'message' => null,'translated_message' => null]);
        }
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CHAT_MANAGEMENT);

        return view('attorney.chat_management', ['video' => $video]);
    }

    public function Attachment_upload(Request $request)
    {
        return Helper::Attachment_upload($request);
    }

    public function SendNotification(Request $request)
    {
        // return $request->all();
        $user_find = User::whereId($request->to_user_id)->first();
        $message = $request->message;
        $image_extension = ['heic', 'jpg', 'jpeg','png'];
        $ext = explode(".", $message);
        if (count($ext) == 2) {
            if (in_array($ext[1], $image_extension)) {
                $message = 'Image';
            }
        }
        $message_title = 'Attorney send a new message';
        $this->sendNotificationOnDevices($user_find, $message_title, $message);
        if ($user_find->device_type == 'Web' && strlen($user_find->device_token) > 20) {
            $user = User::whereId($request->from_user_id)->first();
            // $icon = url('assets/images/logo.png');
            $icon = false;
            $self_web_url = url('attorney/clientchat');
            $message_title = $this->getMessageString($user, $user_find);
            // $message_title = $user->name . ' send a new message';
            $this->send_web_push_notification($user_find->device_token, $message, $message_title, $icon, $self_web_url);
        }

        return 'succdddddddddess';
    }

    private function sendNotificationOnDevices($user_find, $message_title, $message)
    {
        //$total_noti_record = Message::whereToUserId($user_find->id)->whereStatus(1)->count();
        if ($user_find->device_type == 'Ios' && strlen($user_find->device_token) > 20) {
            $this->send_iphone_notification($user_find->device_token, $message_title, $message, "New Message Notification", 1);
        }

        if ($user_find->device_type == 'Android' && strlen($user_find->device_token) > 20) {
            $this->send_android_notification_new($user_find->device_token, $message_title, $message, "New Message Notification", 1);
        }
    }

    private function getMessageString($user, $user_find)
    {
        if ($user->role == 1 && $user_find->role == 2) {
            $message_title = 'Admin send a new message';
        } elseif ($user->role == 2 && $user_find->role == 1) {
            $message_title = $user->name . ' send a new message';
        } elseif ($user->role == 2 && $user_find->role == 3) {
            $message_title = 'Attorney send a new message';
        } elseif ($user->role == 3 && $user_find->role == 2) {
            $message_title = $user->name . ' send a new message';
        } else {
            $message_title = 'Attorney send a new message';
        }

        return $message_title;
    }

}
