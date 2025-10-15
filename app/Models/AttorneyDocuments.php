<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyDocuments extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_attorney_documents';
    public $timestamps = false;

    public static function getSignedDocuments($clientId, $attorneyId = '')
    {

        $listOfFiles = [];

        if (empty($attorneyId)) {
            $client_attorney_id = ClientsAttorney::where("client_id", $clientId)->first();
            $attorneyId = $client_attorney_id->attorney_id;
        }

        $path_pre = "/attorney/".$attorneyId."/signed_document/".$clientId;
        $adminpath_pre = "/attorney/1/signed_document/".$clientId;

        try {
            $files = \Storage::disk('s3')->files($path_pre);
        } catch (\Exception $e) {
            \Log::error('Error fetching client files from S3: ' . $e->getMessage());
            $files = [];
        }

        try {
            $adminfiles = \Storage::disk('s3')->files($adminpath_pre);
        } catch (\Exception $e) {
            \Log::error('Error fetching admin files from S3: ' . $e->getMessage());
            $adminfiles = [];
        }

        $allFiles = array_filter(array_merge($files, $adminfiles));

        foreach ($allFiles as $file) {
            $filename = basename($file);
            $path = \Storage::disk('s3')->temporaryUrl($file, now()->addDays(2));
            $listOfFiles[] = ['name' => $filename, 'path' => $path, 'file' => $file];
        }

        return $listOfFiles;
    }

}
