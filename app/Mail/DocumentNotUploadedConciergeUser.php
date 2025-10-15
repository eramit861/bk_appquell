<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentNotUploadedConciergeUser extends Mailable
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
    protected $document_list;

    public function __construct($username, $url, $subject, $document_list)
    {

        $this->username = $username;
        $this->url = $url;
        $this->subject = $subject;
        $this->document_list = $document_list;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.document_not_uploaded_concierge_client', ['username' => $this->username,'document_list' => $this->document_list, 'url' => $this->url])->subject($this->subject);
    }
}
