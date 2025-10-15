<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;

class WelcomeAboardDescriptionCronMail extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    protected $attorney;
    protected $user;
    protected $clientLoginUrl;

    public function __construct(
        User $user,
        $attorney = null,
        $clientLoginUrl = ''
    ) {
        $this->user = $user;
        $this->attorney = $attorney;
        $this->clientLoginUrl = $clientLoginUrl;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome', ['user' => $this->user,'attorney' => $this->attorney,'clientLoginUrl' => $this->clientLoginUrl])->subject("Welcome — Let’s Get You the Financial Stress Relief You Need");
    }
}
