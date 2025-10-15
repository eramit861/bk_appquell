<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyCommonDocuments extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_attorney_common_documents';
    public $timestamps = false;

    public static function getPostSubmissionDocList($attorneyId)
    {
        $parentLabels = [];
        $attPSDocuments = self::orderBy('id', 'DESC')
            ->where([
                'attorney_id' => $attorneyId,
            ])
            ->where('document_type', 'like', 'post_submission_doc_%')
            ->get();
        if ($attPSDocuments) {
            foreach ($attPSDocuments as $key => $document) {
                $parentLabels[$document->document_type] = $document->document_name;
            }
        }

        return $parentLabels;
    }
}
