<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortFormConditionalFields extends Model
{
    protected $table = 'tbl_short_form_conditional_fields';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'attorney_id',
        'question_to_show',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    public static function getConditionalQuestionArray()
    {
        $array = [
            "debtor_ssn" => "Debtor SSN",
            "codebtor_ssn" => "Co-Debtor SSN",
            "licence_or_id" => "Driver's Lic/Gov. ID",
            "estimated_total_credit_card_debt" => "Estimated Total Credit Card debt",
            "estimated_total_medical_debt" => "Estimated Total Medical debt",
            "estimated_total_student_loans" => "Estimated Total Student loans",
            "estimated_law_suit_judgement" => "Estimated Law Suit / Judgement",
            "estimated_total_personal_loans" => "Estimated Total Personal Loans",
            "estimated_total_credit_union_loans" => "Estimated Total Credit Union Loans",
            "estimated_total_loans_from_family" => "Estimated Total loans from family",
            "estimated_misc_loans" => "Estimated Misc. loans",
            "emergency_checks" => "Emergency Assessment",
            "discover_us" => "Discover Us",
            "other_property" => "Other Property",
        ];

        return $array;
    }

    public static function returnActiveOrNot($array, $key)
    {
        if (!empty($array) && is_array($array) && in_array($key, $array)) {
            return "";
        } else {
            return "d-none";
        }
    }
}
