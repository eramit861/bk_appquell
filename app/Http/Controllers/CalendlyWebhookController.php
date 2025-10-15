<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendlyWebhookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('calendly_webhook_url');
    }

    public function calendly_webhook_url(Request $request)
    {
        if ($request->isMethod('post')) {
            $timestamp = date("Y-m-d H:i:s");
            $response = file_get_contents('php://input');
            $json = $response;
            $payload = json_decode($json, 1);
            if (isset($payload['event']) && $payload['event'] == 'invitee.canceled') {
                $payloadData = $payload['payload'];
                $cancellation = $payload['payload']['cancellation'];
                $scheduled_event = $payload['payload']['scheduled_event'];
                $client = \App\Models\User::where(['email' => $payloadData['email'],'role' => 3])->select('id')->first();
                $client_id = 0;
                if (!empty($client)) {
                    $client_id = $client->id;
                }
                $dataToSave = [
                    'event_type' => 'canceled',
                    'client_id' => $client_id,
                    'event_invitte_url' => $payloadData['uri'],
                    'user_name' => $payloadData['name'],
                    'user_email' => $payloadData['email'],
                    'event_url' => $payloadData['event'],
                    'event_status' => $payloadData['status'],
                    'cancel_url' => $payloadData['cancel_url'],
                    'cancel_reason' => $cancellation['reason'],
                    'canceled_by' => $cancellation['canceled_by'],
                    'rescheduled' => $payloadData['rescheduled'],
                    'cancel_created_at' => $cancellation['created_at'],
                    'reschedule_url' => $payloadData['reschedule_url'],
                    'scheduled_event_name' => $scheduled_event['name'],
                ];
            }

            if (isset($payload['event']) && $payload['event'] == 'invitee.created') {
                $payloadData = $payload['payload'];
                $scheduled_event = $payload['payload']['scheduled_event'];
                $client = \App\Models\User::where(['email' => $payloadData['email'],'role' => 3])->select('id')->first();
                $client_id = 0;
                if (!empty($client)) {
                    $client_id = $client->id;
                }
                $dataToSave = [
                    'event_type' => $payloadData['status'],
                    'client_id' => $client_id,
                    'event_invitte_url' => $payloadData['uri'],
                    'user_name' => $payloadData['name'],
                    'user_email' => $payloadData['email'],
                    'event_url' => $payloadData['event'],
                    'cancel_url' => $payloadData['cancel_url'],
                    'event_status' => $payloadData['status'],
                    'rescheduled' => $payloadData['rescheduled'],
                    'reschedule_url' => $payloadData['reschedule_url'],
                    'scheduled_event_name' => $scheduled_event['name'],
                    'scheduled_event_start_time' => $scheduled_event['start_time'],
                    'scheduled_event_end_time' => $scheduled_event['end_time'],
                ];
            }


            $dataToSave['webhook_json'] = $json;
            $dataToSave['created_at'] = $timestamp;
            $dataToSave['updated_at'] = $timestamp;
            $dataToSave['event_read'] = 0;

            \App\Models\CalendlyWebhook::create($dataToSave);
        }
    }
}
