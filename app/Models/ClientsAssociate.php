<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientsAssociate extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_clients_associate';
    public $timestamps = false;

    public static function getAssociateId($client_id)
    {
        $associate = self::where('client_id', $client_id)->exists();
        $associateId = '';

        // return associate_id if associate exists, '' otherwise
        if ($associate) {
            $associate = self::where('client_id', $client_id)->first();
            $associateId = $associate->associate_id;
        }

        return $associateId;

    }

}
