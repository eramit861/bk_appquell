<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SignedDocToAttorneyMail extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    protected $attorneyName;
    protected $clientName;
    protected $clientId;

    public function __construct($attorneyName, $clientName, $clientId)
    {
        $this->attorneyName = $attorneyName;
        $this->clientName = $clientName;
        $this->clientId = $clientId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.signed_doc_to_attorney', ['attorneyName' => $this->attorneyName,'clientName' => $this->clientName,'clientId' => $this->clientId])->subject('Recieved signed documents');
    }
}
