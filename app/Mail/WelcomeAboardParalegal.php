<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class WelcomeAboardParalegal extends Mailable
{
    protected $user;
    protected $isLawFirmAssigned;

    public function __construct($user, $isLawFirmAssigned = false)
    {
        $this->user = $user;
        $this->isLawFirmAssigned = $isLawFirmAssigned;
    }

    public function build()
    {
        return $this->view('emails.welcomeAboardParalegal', [
            'user' => $this->user,
            'attorney' => $this->user['attorney'],
            'regiser' => $this->user['pass_flag'],
            'isLawFirmAssigned' => $this->isLawFirmAssigned,
        ])->subject('Welcome to BK Questionnaire');
    }
}
