<?php

namespace App\Helpers;

use App\Models\ClientDocumentUploaded;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminHelper
{
    public static function dashboardEntityCount()
    {

        $stats = DB::select("        
                SELECT 
                    (SELECT COUNT(*) FROM users WHERE role = ? AND parent_attorney_id = 0) as attorney_count,
                    (SELECT COALESCE(SUM(amount), 0) / 100 FROM tbl_client_application_payments) as payment_sum,
                    (SELECT COUNT(*) FROM users WHERE role = ?) as client_count
            ", [User::ATTORNEY, User::CLIENT]);

        $attorney_count = 0;
        $payment_sum = 0;
        $client_count = 0;

        if (!empty($stats)) {
            $attorney_count = $stats[0]->attorney_count;
            $payment_sum = $stats[0]->payment_sum;
            $client_count = $stats[0]->client_count;
        }

        $documentuploaded = ClientDocumentUploaded::select('client_id', 'document_type')->get()->toArray();
        $documentuploaded_final = [];
        if (!empty($documentuploaded)) {
            foreach ($documentuploaded as $documents) {
                $documentuploaded_final[$documents['client_id']][] = $documents['document_type'];
            }
        }
        $signed_documents = 0;
        if (!empty($documentuploaded_final)) {
            foreach ($documentuploaded_final as $val) {
                $signed_documents += count($val);
            }
        }

        $pending_documents = ($client_count * 9) - $signed_documents;

        return compact('attorney_count', 'client_count', 'signed_documents', 'pending_documents', 'payment_sum');
    }

    public static function formatPhoneNumber($phoneNumber)
    {
        // Remove all non-digit characters
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Add the desired formatting
        if (strlen($phoneNumber) == 10) {
            return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $phoneNumber);
        } elseif (strlen($phoneNumber) == 11) {
            return preg_replace('/(\d)(\d{3})(\d{3})(\d{4})/', '$1 ($2) $3-$4', $phoneNumber);
        } else {
            return $phoneNumber;
        }
    }

}
