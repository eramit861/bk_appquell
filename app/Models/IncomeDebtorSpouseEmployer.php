<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Services\Client\CacheIncome;

class IncomeDebtorSpouseEmployer extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_income_debtor_spouse_employer';
    public $timestamps = false;

    public static function isDebtorEmployed($client_id)
    {
        $employed = CacheIncome::getIncomeData($client_id);
        $employed = Helper::validate_key_value('debtorspouseemployer', $employed, 'array');
        $return = false;
        if (Helper::validate_key_value('current_employed', $employed) == 1 || Helper::validate_key_value('spouse_any_other_jobs', $employed) == 1) {
            $return = true;
        }

        return $return;
    }
}
