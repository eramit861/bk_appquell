<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function fetch_user_notifications()
    {
        $client_id = Auth::user()->id;
        $notifications = Notifications::orderBy('id', 'DESC')->where('client_id', $client_id)->paginate(10000);

        return view('client.notifications', ['notifications' => $notifications])->render();
    }
    public function read_user_notifications(Request $request)
    {
        $client_id = Auth::user()->id;
        $input = $request->all();
        $id = $input['id'];
        Notifications::where(["client_id" => $client_id, "id" => $id])->update(['unotification_is_read' => 1]);
        $data = Notifications::where("id", $id)->first()->toArray();
        switch ($data['unotification_type']) {
            case Notifications::DOCUMENT_TYPE:
                return view('client.notification_popup', ['notification' => $data])->render();
                break;
            default:
                # code...

                break;
        }
    }
}
