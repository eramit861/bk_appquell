<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class DocumentNotificationController extends AttorneyController
{
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function update_notification_type(Request $request)
    {
        $client_id = $request->input('client_id');
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $document_email_notification = $request->input('document_email_notification');
        $document_pushed_notification = $request->input('document_pushed_notification');
        \App\Models\User::where('id', $client_id)->update(['document_email_notification' => $document_email_notification,'document_pushed_notification' => $document_pushed_notification]);

        return response()->json(Helper::renderJsonSuccess('Notification Settings Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }
    public function post_submission_documents_enabled(Request $request)
    {
        $client_id = $request->input('client_id');
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $post_submission_documents_enabled = $request->input('post_submission_documents_enabled');
        \App\Models\ClientSettings::updateOrCreate(['client_id' => $client_id], ['post_submission_documents_enabled' => $post_submission_documents_enabled]);

        return response()->json(Helper::renderJsonSuccess('Document Settings Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }


}
