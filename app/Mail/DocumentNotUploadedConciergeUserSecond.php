<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentNotUploadedConciergeUserSecond extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $username;
    protected $url;
    public $subject;
    protected $attorney_name;

    public function __construct($username, $attorney_name, $url, $subject)
    {

        $this->username = $username;
        $this->url = $url;
        $this->subject = $subject;
        $this->attorney_name = $attorney_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.document_not_uploaded_concierge_client_second', ['username' => $this->username,'attorney_name' => $this->attorney_name, 'url' => $this->url])->subject($this->subject);
    }
}
