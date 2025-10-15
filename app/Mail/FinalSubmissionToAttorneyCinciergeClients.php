<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinalSubmissionToAttorneyCinciergeClients extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user_name;
    protected $attorney_name;
    protected $url;
    public function __construct($user_name, $attorney_name, $url)
    {
        $this->user_name = $user_name;
        $this->attorney_name = $attorney_name;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.final_submission_to_attorney_concierge_clients', ['user_name' => $this->user_name,'attorney_name' => $this->attorney_name, 'url' => $this->url]);
    }
}
