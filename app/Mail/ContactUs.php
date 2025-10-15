<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $name;
    protected $email;
    protected $comment;
    protected $phone;
    protected $company;

    public function __construct($name, $email, $comment, $phone, $company)
    {
        $this->name = $name;
        $this->email = $email;
        $this->comment = $comment;
        $this->phone = $phone;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactus', ['name' => $this->name,'email' => $this->email,'comment' => $this->comment,'phone' => $this->phone,'company' => $this->company]);
    }
}
