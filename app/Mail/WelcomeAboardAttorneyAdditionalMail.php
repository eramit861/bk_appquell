<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class WelcomeAboardAttorneyAdditionalMail extends Mailable
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->view('emails.welcomeAboardAttorneyAdditionalMail', ['name' => $this->name])->subject('Welcome to BK Questionnaire – How Can I Help?');
    }
}
