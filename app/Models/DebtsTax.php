<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Services\Client\CacheDebt;
use Illuminate\Database\Eloquent\Model;

class DebtsTax extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_debts_taxes';
    public $timestamps = false;

    public static function getLawsuitDebts($client_id)
    {
        $lawsuitDebts = [];
        $allDebts = CacheDebt::getDebtData($client_id);
        if (!empty($allDebts)) {
            if (Helper::validate_key_value('does_not_have_additional_creditor', $allDebts, 'radio') == "1") {
                $unsecuredDebts = Helper::validate_key_value('debt_tax', $allDebts, 'array');
                // sort unsecuredDebts based on creditor_name
                usort($unsecuredDebts, function ($a, $b) {
                    $nameA = isset($a['creditor_name']) ? $a['creditor_name'] : '';
                    $nameB = isset($b['creditor_name']) ? $b['creditor_name'] : '';

                    return strnatcasecmp($nameA, $nameB);
                });
                // filter debts where cards_collections equals 6
                $lawsuitDebts = array_filter($unsecuredDebts, function ($debt) {
                    return isset($debt['cards_collections']) && $debt['cards_collections'] == "6";
                });
                $lawsuitDebts = array_values($lawsuitDebts);
            }
        }

        return $lawsuitDebts;
    }
}
