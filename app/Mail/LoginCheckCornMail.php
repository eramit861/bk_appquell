<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class LoginCheckCornMail extends Mailable
{
    protected $attorney_name;
    protected $client_name;

    public function __construct($client_name, $attorney_name = null)
    {
        $this->client_name = $client_name;
        $this->attorney_name = $attorney_name;
    }

    public function build()
    {
        return $this->view('emails.login_check', ['client_name' => $this->client_name, 'attorney_name' => $this->attorney_name])->subject("Let's get right to it!");
    }
}
