<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientQuestionnaireReview extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_questionnaire_review';
    public $timestamps = false;


    public static function addReviewForSection($client_id, $reviewed_for, $reviewed_by, $name, $label)
    {
        $timeStamp = date('Y-m-d H:i:s');

        $dataToUpdate = [
            "client_id" => $client_id,
            "reviewed_for" => $reviewed_for,
            "reviewed_status" => 1,
            "reviewed_by" => $reviewed_by,
            "reviewed_by_name" => $name,
            "reviewed_at" => $timeStamp,
            "created_at" => $timeStamp,
            "updated_at" => $timeStamp,
        ];
        \App\Models\ClientQuestionnaireReview::updateOrCreate(['client_id' => $client_id, "reviewed_for" => $reviewed_for], $dataToUpdate);

        $noteForView = "Reviewed By: ".$name." on: Date ".\Carbon\Carbon::parse($timeStamp)->format('m/d/Y @ h:i A');
        $subject = "Questionnaire " .$label." Reviewed";
        $note = $label. ' '.$noteForView;
        $noteDataToUpdate = [
            "client_id" => $client_id,
            "subject" => $subject,
            "note" => $note,
            "created_at" => $timeStamp,
            "updated_at" => $timeStamp,
            "added_by_id" => $reviewed_by,
        ];
        \App\Models\ConciergeServiceNotes::create($noteDataToUpdate);

        return $noteForView;
    }
}
