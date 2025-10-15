<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\AdminHelper;
use App\Mail\SimpleTextMessageMail;
use App\Models\ClientsAssociate;
use App\Models\User;

class SimpleTextMessageController extends Controller
{
    public function simpletext_message_webhook(Request $request)
    {
        if (!$request->isMethod('post')) {
            abort(404, "Page not found");
        }

        $response = $request->all();
        $request_type = Helper::validate_key_value('type', $response);

        if ($request_type == 'INCOMING_MESSAGE') {
            $request_data = Helper::validate_key_value('values', $response) ?? [];
            $contactPhone = Helper::validate_key_value('contactPhone', $request_data);
            $message = Helper::validate_key_value('text', $request_data);
            $contactPhone = AdminHelper::formatPhoneNumber($contactPhone);
            $client = User::where(['role' => User::CLIENT, 'phone_no' => $contactPhone])->select(['id', 'concierge_service', 'name'])->first();
            if (!$client) {
                return response()->json(['error' => 'Client not found'], 404);
            }
            $client_id = Helper::validate_key_value('id', $client);

            $dataToSave = [
                'client_id' => $client_id,
                'seen_by_admin' => 0,
                'seen_by_attorney' => 0,
                'json' => json_encode($response),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            \App\Models\SimpleTextWebhook::updateOrCreate(["client_id" => $client_id], $dataToSave);
            // send mail here

            $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
            if (!$attorney) {
                return; // or handle the case appropriately
            }
            $attorney_id = $attorney->attorney_id;
            $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
            $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
            $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
            $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate])->select(['enable_text_msg_notification_email', 'text_text_msg_notification_email'])->first();
            if (
                isset($attorneySettings->enable_text_msg_notification_email) &&
                ($attorneySettings->enable_text_msg_notification_email == 1) &&
                isset($attorneySettings->text_text_msg_notification_email) &&
                !empty($attorneySettings->text_text_msg_notification_email)
            ) {

                // Determine recipient email
                $email = $attorneySettings->text_text_msg_notification_email;
                if ($client->concierge_service == 1) {
                    $email = env('CONC_SER_MAIL_ID', 'info@bkassistant.net');
                }

                // Get attorney info safely
                $attorneyInfo = User::where(['role' => User::ATTORNEY, 'id' => $attorney_id])
                    ->select(['id', 'name'])
                    ->first();

                $attorneyName = $attorneyInfo ? $attorneyInfo->name : 'N/A';
                $clientName = !empty($client->name) ? $client->name : 'N/A';

                // Build email body
                $emailBody = "Client Name: {$clientName} ({$client_id})<br>"
                    . "Client Phone: {$contactPhone}<br>"
                    . "Attorney: {$attorneyName}<br>"
                    . "{$message}";

                $subject = 'You received a new message from ' . ($clientName !== 'N/A' ? $clientName : $contactPhone);

                // Send email
                Mail::to($email)->send(new SimpleTextMessageMail($subject, $emailBody));
            }
        }
    }
}
