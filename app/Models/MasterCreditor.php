<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class MasterCreditor extends Model
{
    protected $table = 'tbl_master_creditors';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'creditor_name','creditor_address','creditor_city','creditor_state','creditor_zip','creditor_contact','creditor_website','added_by_id','active_status','category'
    ];

    public static function autosuggest($keyword)
    {
        $creditorcompanies = \App\Models\MasterCreditor::where("creditor_name", "!=", null)->where('active_status', '=', 1)->orderBy('creditor_name', 'asc');
        $creditorcompanies->Where(function ($query) use ($keyword) {
            $query->Where('creditor_name', 'like', '%' . $keyword . '%');
        });
        $creditorcompanies = $creditorcompanies->paginate(10);
        $creditorcompanies = $creditorcompanies->toArray();
        $creditorcompanies = $creditorcompanies['data'];
        $json = null;
        foreach ($creditorcompanies as $val) {
            $zips = explode("-", $val['creditor_zip']);
            $zip = $zips[0];
            $val['creditor_zip'] = $zip;
            $placeholder = Helper::commonCreditorPlaceholder($val);
            $json[] = [
            'placeholder' => $placeholder,
            'value' => strip_tags(html_entity_decode($val['creditor_name'], ENT_QUOTES, 'UTF-8')),
            'address' => isset($val['creditor_address']) ? strip_tags(html_entity_decode($val['creditor_address'], ENT_QUOTES, 'UTF-8')) : '',
            'city' => strip_tags(html_entity_decode($val['creditor_city'], ENT_QUOTES, 'UTF-8')),
            'state' => strip_tags(html_entity_decode($val['creditor_state'], ENT_QUOTES, 'UTF-8')),
            'zip' => strip_tags(html_entity_decode($zip, ENT_QUOTES, 'UTF-8'))
        ];
        }

        return $json;
    }

}
