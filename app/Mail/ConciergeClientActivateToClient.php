<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ConciergeClientActivateToClient extends Mailable
{
    public function __construct()
    {

    }

    public function build()
    {
        return $this->view('emails.concierge_client_activate_to_client', [])->subject('Case Submitted');
    }
}
