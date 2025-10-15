<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ClientFirstLogin extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $attorneyname;

    public function __construct(User $user, $attorneyname)
    {
        $this->user = $user;
        $this->attorneyname = $attorneyname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.client_first_login', ['user' => $this->user,'attorneyname' => $this->attorneyname]);
    }
}
