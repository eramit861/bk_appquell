<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SignedDocument extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $client;
    protected $attorney_name;
    protected $attorneycompany;
    public function __construct(User $client, $attorney_name, $attorneycompany)
    {
        $this->client = $client;

        $this->attorney_name = $attorney_name;
        $this->attorneycompany = $attorneycompany;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sign_doc_submission', ['client' => $this->client,'attorney_name' => $this->attorney_name,'attorney_company' => $this->attorneycompany])->subject("Documents Sent To You By Your Attorney");
    }
}
