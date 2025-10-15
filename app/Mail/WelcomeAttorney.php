<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;

class WelcomeAttorney extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;
    protected $attorney;
    protected $clientLoginUrl;
    protected $flag;
    protected $attorneycompany;

    public function __construct(
        User $user,
        $flag = false,
        $attorney = null,
        $clientLoginUrl = ''
    ) {
        $this->user = $user;
        $this->attorney = $attorney;
        $this->clientLoginUrl = $clientLoginUrl;
        $this->flag = $flag;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.attorney-welcome', ['user' => $this->user]);
    }
}
