<?php

namespace App\Mail;

class WelcomeAboard extends WelcomeAttorney
{
    // use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->user->role != 2) {
            return $this->view(
                'emails.welcome',
                [
                   'user' => $this->user,
                   'attorney' => $this->attorney,
                   'clientLoginUrl' => $this->clientLoginUrl,
                   'regiser' => $this->flag,
                ]
            )->subject('Welcome — Let’s Get You the Financial Stress Relief You Need');
        }
        parent::build();
    }
}
