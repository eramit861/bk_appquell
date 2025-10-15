<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'status',
        'type',
        'sent_at',
        'received_at',
        'read_at',
        'deleted_by'
    ];

    public static function getMessageCount($clients, $attorneyId)
    {
        $messageCount = [];
        if (!empty($clients)) {

            foreach ($clients as $clientId) {
                $messageCount[$clientId] = \App\Models\Message::where(['to_user_id' => $attorneyId, 'from_user_id' => $clientId,'status' => 1])->count();
            }
        }

        return $messageCount;
    }
}
