<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SimpleTextMessageMail extends Mailable
{
    public $subject;
    protected $message;

    public function __construct($subject, $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    public function build()
    {
        return $this->view('emails.concierge_auto_generated', ['html' => $this->message ,'hideEmail' => false])->subject($this->subject);
    }
}
