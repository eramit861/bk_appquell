<?php

namespace App\Http\Controllers;

use App\Models\ClientSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UnsubscribeController extends Controller
{
    /**
     * Show the unsubscribe page
     */
    public function show($token)
    {
        try {
            // Decrypt the token to get client information
            $decryptedData = Crypt::decryptString($token);
            $data = json_decode($decryptedData, true);

            if (!$data || !isset($data['client_id']) || !isset($data['email'])) {
                return view('unsubscribe.error', [
                    'message' => 'Invalid unsubscribe link. Please contact support if you continue to receive emails.'
                ]);
            }

            $client = User::where('id', $data['client_id'])
                         ->where('email', $data['email'])
                         ->first();

            if (!$client) {
                return view('unsubscribe.error', [
                    'message' => 'Client not found. Please contact support if you continue to receive emails.'
                ]);
            }

            // Check if already unsubscribed
            $clientSettings = ClientSettings::where('client_id', $data['client_id'])->first();
            $isUnsubscribed = $clientSettings && $clientSettings->auto_mail_unsubscribed == 1;

            return view('unsubscribe.form', [
                'client' => $client,
                'token' => $token,
                'isUnsubscribed' => $isUnsubscribed
            ]);

        } catch (\Exception $e) {
            Log::error('Unsubscribe token decryption failed', [
                'token' => $token,
                'error' => $e->getMessage()
            ]);

            return view('unsubscribe.error', [
                'message' => 'Invalid unsubscribe link. Please contact support if you continue to receive emails.'
            ]);
        }
    }

    /**
     * Process the unsubscribe request
     */
    public function unsubscribe(Request $request, $token)
    {
        try {
            // Decrypt the token to get client information
            $decryptedData = Crypt::decryptString($token);
            $data = json_decode($decryptedData, true);

            if (!$data || !isset($data['client_id']) || !isset($data['email'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid unsubscribe link.'
                ], 400);
            }

            $client = User::where('id', $data['client_id'])
                         ->where('email', $data['email'])
                         ->first();

            if (!$client) {
                return response()->json([
                    'success' => false,
                    'message' => 'Client not found.'
                ], 404);
            }

            DB::beginTransaction();

            // Update or create client settings to mark as unsubscribed
            $clientSettings = ClientSettings::where('client_id', $data['client_id'])->first();

            if (!$clientSettings) {
                $clientSettings = new ClientSettings();
                $clientSettings->client_id = $data['client_id'];
                $clientSettings->auto_mail_unsubscribed = 1;
                $clientSettings->created_at = now();
                $clientSettings->updated_at = now();
                $clientSettings->save();
            } else {
                $clientSettings->auto_mail_unsubscribed = 1;
                $clientSettings->updated_at = now();
                $clientSettings->save();
            }

            DB::commit();

            Log::info('Client unsubscribed from automated emails', [
                'client_id' => $data['client_id'],
                'email' => $data['email']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'You have been successfully unsubscribed from automated emails.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Unsubscribe process failed', [
                'token' => $token,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request. Please try again or contact support.'
            ], 500);
        }
    }

    /**
     * Generate unsubscribe token for a client
     */
    public static function generateUnsubscribeToken($clientId, $email)
    {
        $data = [
            'client_id' => $clientId,
            'email' => $email,
            'timestamp' => time()
        ];

        return Crypt::encryptString(json_encode($data));
    }
}
