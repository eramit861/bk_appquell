<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;

class SignDocViewStatEmail extends Mailable
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
    protected $clientId;

    public function __construct(User $user, $attorneyname, $docname, $clientId)
    {
        $this->user = $user;
        $this->attorneyname = $attorneyname;
        $this->docname = $docname;
        $this->clientId = $clientId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sign_doc_view_stat_email', ['user' => $this->user,'attorneyname' => $this->attorneyname,'doc_type' => $this->docname, 'clientId' => $this->clientId])->subject($this->user->name.' just viewed sign document sent by you.');
    }
}
