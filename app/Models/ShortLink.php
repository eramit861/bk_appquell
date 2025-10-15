<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortLink extends Model
{
    use HasFactory;

    public const CUSTOM_INTAKE_LINK = 'custom_intake_link';

    protected $table = 'short_links';
    protected $fillable = [
        'code',
        'link',
        'manual_link',
        'custom_intake_link',
        'attorney_id'
    ];


    public static function getSetLink($input, $attorney_id)
    {
        $arrayPref = ['attorney_id' => $attorney_id];
        if (!empty($input['link_for']) && $input['link_for'] == self::CUSTOM_INTAKE_LINK) {
            $arrayPref = ['attorney_id' => $attorney_id, 'custom_intake_link' => $input['custom_intake_link']];
        }
        if (!empty($input['link_for']) && $input['link_for'] == 'manual') {
            $arrayPref = ['attorney_id' => $attorney_id, 'manual_link' => $input['manual_link']];
        }

        $record = \App\Models\ShortLink::where($arrayPref)->where('code', '!=', '')->first();

        // Ensure custom_intake_link and manual_link have default values if not provided
        if (!isset($input['custom_intake_link'])) {
            $input['custom_intake_link'] = null;
        }
        if (!isset($input['manual_link'])) {
            $input['manual_link'] = null;
        }

        if (empty($record)) {
            $input['code'] = Str::random(6);
            \App\Models\ShortLink::updateOrCreate($arrayPref, $input);
        } else {
            \App\Models\ShortLink::updateOrCreate($arrayPref, $input);
        }


        $url = \App\Models\ShortLink::where($arrayPref)->first();
        if (!empty($input['link_for']) && $input['link_for'] == self::CUSTOM_INTAKE_LINK) {
            return route('shorten.link.custom', ['code' => $url->code]);
        }
        if (!empty($input['link_for']) && $input['link_for'] == 'manual') {
            return route('manual.shorten.link', ['code' => $url->code]);
        }

        return route('shorten.link', ['code' => $url->code]);
    }





}
