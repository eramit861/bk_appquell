<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class WelcomeAboardAttorney extends Mailable
{
    protected $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->view('emails.welcomeAboardAttorney', ['data' => $this->mailData])->subject('Welcome to BK Questionnaire');
    }
}
