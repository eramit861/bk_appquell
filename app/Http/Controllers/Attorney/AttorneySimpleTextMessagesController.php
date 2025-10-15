<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\AddressHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttorneySimpleTextMessagesController extends AttorneyController
{
    public function attorney_simpletext_messages(Request $request)
    {
        $client_id = $request->client_id;
        $user = \App\Models\User::where('id', $client_id)
                ->select(['phone_no', 'name', 'email'])
                ->first();

        $client_phone = AddressHelper::getSimplifiedPhoneNo($user->phone_no);
        $adminPhone = env('ADMIN_PHONE_SIMPLETEXT');
        $apiurl = env('SMS_API_URL');

        $client = new Client();
        $content = [];

        try {
            // First update the contact information with native fields
            $updateResponse = $client->request(
                'PUT',
                $apiurl."/contacts/".$client_phone,
                [
                    'body' => json_encode([
                        "firstName" => $user->name,
                        "email" => $user->email
                    ]),
                    'headers' => [
                        'Authorization' => 'Bearer '.env('SMS_API_TOKEN'),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );

            \Log::info('create/update user in simpletext:', [
                'status_code' => $updateResponse->getStatusCode(),
                'body' => $updateResponse->getBody()->getContents()
            ]);
            // Then get the messages
            $messageResponse = $client->request('GET', $apiurl."/messages", [
                'query' => [
                    'contactPhone' => $client_phone,
                    'accountPhone' => $adminPhone
                ],
                'headers' => [
                    'Authorization' => "Bearer ".env('SMS_API_TOKEN'),
                    'Accept' => 'application/json'
                ]
            ]);

            $res = json_decode($messageResponse->getBody(), true);
            $content = $res['content'] ?? [];

        } catch (\Exception $e) {
            // Log the error but continue to load the view
            \Log::error('SimpleTexting API Error (Attorney): '.$e->getMessage());
        }

        // Update seen status for attorney
        \App\Models\SimpleTextWebhook::where("client_id", $client_id)
            ->update(["seen_by_attorney" => 1]);

        return view('admin.concierge_service_clients.simpletext_messages')
            ->with([
                'client_id' => $client_id,
                'name' => $user->name,
                'senderName' => Auth::user()->name,
                'content' => $content
            ]);
    }

    public function attorney_simpletext_messages_send(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $message = $input['message'];
            $client_id = $input['client_id'];

            // Validate required fields
            if (empty($message) || empty($client_id)) {
                return redirect()->back()->with('error', 'Message and client ID are required.');
            }

            $user = \App\Models\User::where('id', $client_id)->select(['phone_no','name','email'])->first();

            // Validate user exists
            if (!$user) {
                return redirect()->back()->with('error', 'Client not found.');
            }

            $client_phone = AddressHelper::getSimplifiedPhoneNo($user->phone_no);
            $client = new Client();

            try {
                $baseUrl = env('SMS_API_URL');

                // First, update/create the contact
                $contactResponse = $client->request('PUT', $baseUrl."/contacts/$client_phone", [
                    'body' => json_encode([
                        "firstName" => $user->name,
                        "email" => $user->email
                    ]),
                    'headers' => [
                        'Authorization' => 'Bearer '.env('SMS_API_TOKEN'),
                        'Content-Type' => 'application/json'
                    ]
                ]);

                \Log::info('Attorney create/update user in simpletext:', [
                    'status_code' => $contactResponse->getStatusCode(),
                    'body' => $contactResponse->getBody()->getContents(),
                    'client_id' => $client_id,
                    'attorney_id' => Auth::id()
                ]);

                // Prepare message payload
                $messagePayload = [
                    "contactPhone" => $client_phone,
                    "mode" => "AUTO",
                    "subject" => "Message from Attorney ".Auth::user()->name,
                    "text" => $message
                ];

                $response = $client->request('POST', $baseUrl."/messages", [
                    'body' => json_encode($messagePayload),
                    'headers' => [
                        'Authorization' => 'Bearer '.env('SMS_API_TOKEN'),
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ],
                    'http_errors' => true
                ]);

                $res = json_decode($response->getBody(), true);

                if (isset($res['id']) && !empty($res['id'])) {
                    \Log::info('Attorney message sent successfully:', [
                        'message_id' => $res['id'],
                        'client_phone' => $client_phone,
                        'attorney_id' => Auth::id()
                    ]);

                    return redirect()->back()->with('success', 'Message has been sent successfully.');
                }

                return redirect()->back()->with('error', 'Unexpected response from SMS service.');

            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBody = $response->getBody()->getContents();
                $errorData = json_decode($responseBody, true);

                // Handle specific 409 Conflict error
                if ($e->getCode() === 409 && isset($errorData['code']) && $errorData['code'] === 'LOCAL_OPT_OUT') {
                    \Log::warning('Attorney message not sent - phone number has opted out:', [
                        'client_phone' => $client_phone,
                        'client_id' => $client_id,
                        'attorney_id' => Auth::id(),
                        'error' => $errorData
                    ]);

                    return redirect()->back()->with('error', 'This client has opted out of receiving messages.');
                }

                // Log other API errors
                \Log::error('Attorney error sending message:', [
                    'error' => $e->getMessage(),
                    'response' => $responseBody,
                    'trace' => $e->getTraceAsString(),
                    'client_phone' => $client_phone,
                    'attorney_id' => Auth::id()
                ]);

                return redirect()->back()->with('error', 'Failed to send message: ' . $e->getMessage());

            } catch (\Exception $e) {
                \Log::error('Attorney general error sending message:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'client_phone' => $client_phone,
                    'attorney_id' => Auth::id()
                ]);

                return redirect()->back()->with('error', 'Failed to send message. Please try again.');
            }
        }
    }

}
