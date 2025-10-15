<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentNotification extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $username;
    protected $messagestring;
    protected $message_title;
    protected $documentDeclineReason;
    protected $attorneyEmail;
    protected $attorney_company;

    public function __construct($username, $messagestring, $message_title, $attorneyEmail, $attorney_company, $documentDeclineReason = '')
    {
        $this->username = $username;
        $this->messagestring = $messagestring;
        $this->message_title = $message_title;
        $this->documentDeclineReason = $documentDeclineReason;
        $this->attorneyEmail = $attorneyEmail;
        $this->attorney_company = $attorney_company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.document_notification', ['username' => $this->username, 'messagestring' => $this->messagestring, 'message_title' => $this->message_title,'attorney_email' => $this->attorneyEmail,'attorney_company' => $this->attorney_company,'documentDeclineReason' => $this->documentDeclineReason])->subject($this->message_title);
    }
}
