<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditRequest extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $username;
    protected $message_info;
    protected $attorney_company;
    protected $attorney_name;
    protected $attorney_email;

    public function __construct($username, $message_info, $attorney_company, $attorney_name, $attorney_email)
    {
        $this->username = $username;
        $this->message_info = $message_info;
        $this->attorney_company = $attorney_company;
        $this->attorney_name = $attorney_name;
        $this->attorney_email = $attorney_email;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.editrequest', ['username' => $this->username,'message_info' => $this->message_info,'attorney_company' => $this->attorney_company,'attorney_name' => $this->attorney_name,'attorney_email' => $this->attorney_email])->subject('BKQ Edit Request Access');
    }
}
