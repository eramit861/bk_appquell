<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class welcomeAboardAttorneyAdminNotify extends Mailable
{
    protected $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->view('emails.welcomeAboardAttorneyAdminNotify', ['data' => $this->mailData])->subject('Attorney Signed Up');
    }
}
