<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendlyWebhook extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_calendly_webhook';
    public $timestamps = false;

    public static function getClandleyEventdata($client_id)
    {
        $event = CalendlyWebhook::where('client_id', '=', $client_id)->orderBy('id', 'DESC')->first();

        return !empty($event) ? $event->toArray() : [];
    }

    public static function getClandleyEventDataForClients($clients)
    {
        $clientClendly = [];
        foreach ($clients as $val) {
            $clientClendly[$val['id']] = \App\Models\CalendlyWebhook::getClandleyEventdata($val['id']);
        }

        return $clientClendly;
    }
}
