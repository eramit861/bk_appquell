<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($attribute, $value)
    {
        $client = new Client([ 'verify' => false ]);
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => config('services.recaptcha.secret'),
                        'response' => $value
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        return $body->success;
    }
}
