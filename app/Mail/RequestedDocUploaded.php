<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;

class RequestedDocUploaded extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $attorneyname;
    protected $docname;

    public function __construct(User $user, $attorneyname, $docname)
    {
        $this->user = $user;
        $this->attorneyname = $attorneyname;
        $this->docname = $docname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.requested_document_upload', ['user' => $this->user,'attorneyname' => $this->attorneyname,'doc_type' => $this->docname]);
    }
}
