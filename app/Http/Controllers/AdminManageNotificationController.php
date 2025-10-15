<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminManageNotificationController extends Controller
{
    public function index()
    {
        $admin_id = Auth::user()->id;
        $settings = \App\Models\AttorneySettings::where([ 'attorney_id' => $admin_id, 'is_associate' => 0])->first();

        return view('admin.manage_notification.show', ['attorneySettings' => $settings]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $admin_id = Auth::user()->id;

        $notification_status = Helper::validate_key_value('notification_status', $input);
        $input['notification_status'] = json_encode($notification_status);
        $input['attorney_id'] = $admin_id;

        unset($input['_token']);

        \App\Models\AttorneySettings::updateOrCreate(["attorney_id" => $admin_id, 'is_associate' => 0], $input);

        return redirect()->route('admin_manage_notification_index')->with('success', 'Settings updated successfully');
    }

}
