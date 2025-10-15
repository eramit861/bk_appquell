<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblPropertyDetailApiRequest extends Model
{
    protected $table = 'tbl_property_detail_api_requests';

    protected $fillable = [
        'client_id',
        'parameter',
        'response',
        'type',
    ];

    public static function logRequest($client_id, $type, $parameter, $response)
    {
        return self::create([
            'client_id' => $client_id,
            'type' => $type,
            'parameter' => $parameter,
            'response' => is_array($response) ? json_encode($response) : $response,
        ]);
    }

}
