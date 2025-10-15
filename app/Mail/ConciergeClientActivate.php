<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ConciergeClientActivate extends Mailable
{
    protected $attorneyName;
    protected $clientName;
    protected $clientId;

    public function __construct($attorneyName, $clientName, $clientId)
    {
        $this->attorneyName = $attorneyName;
        $this->clientName = $clientName;
        $this->clientId = $clientId;
    }

    public function build()
    {
        return $this->view('emails.concierge_client_activate', [
                        'attorneyName' => $this->attorneyName,
                        'clientId' => $this->clientId,
                        'clientName' => $this->clientName])
                    ->subject('Concierge Service Completed for Your Client – '.$this->clientName);
    }
}
