<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OnePageQuesRequest extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $name;
    protected $email;
    protected $attorneyname;

    public function __construct($name, $email, $attorneyname)
    {
        $this->name = $name;
        $this->email = $email;
        $this->attorneyname = $attorneyname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.one_page_ques_request', ['name' => $this->name,'email' => $this->email,'attorneyname' => $this->attorneyname])->subject('Short Form Questionnaire Request Received');
    }
}
