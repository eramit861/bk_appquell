<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'client/appredirect',
        'ccc/webhook',
        'mastercard/webhook',
        'calendly/webhook',
        'home',
        'simpletext/message/webhook',
        'aiapi/webhook',
        'aiapi/webhook/*'
    ];
}
