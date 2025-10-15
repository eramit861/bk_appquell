<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ConciergeClientWelcome extends Mailable
{
    protected $clientName;
    protected $attorneyName;
    protected $url;

    public function __construct($clientName, $attorneyName, $url)
    {
        $this->clientName = $clientName;
        $this->attorneyName = $attorneyName;
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('emails.concierge_client_welcome', [ 'clientName' => $this->clientName, 'attorneyName' => $this->attorneyName, 'url' => $this->url ])->subject('Client Concierge Service');
    }
}
