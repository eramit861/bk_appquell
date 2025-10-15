<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentNotUploaded extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $username;
    protected $attorney;
    protected $attorneyEmail;
    protected $attorney_company;
    protected $day;
    public $subject;

    public function __construct($username, $attorney, $attorneyEmail, $attorney_company, $day = '', $subject)
    {

        $this->username = $username;
        $this->attorney = $attorney;
        $this->attorneyEmail = $attorneyEmail;
        $this->attorney_company = $attorney_company;
        $this->day = $day;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.document_not_uploaded', ['username' => $this->username,'attorney' => $this->attorney, 'attorney_email' => $this->attorneyEmail,'attorney_company' => $this->attorney_company, 'day' => $this->day])->subject($this->subject);
    }
}
