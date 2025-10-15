<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class FinalSubmissionToClient extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $attorney;
    protected $attorneycompany;
    public function __construct(User $attorney, User $user, $attorneycompany)
    {
        $this->user = $user;
        $this->attorney = $attorney;
        $this->attorneycompany = $attorneycompany;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.final_submission_client', ['user' => $this->user,'attorney' => $this->attorney, 'attorney_company' => $this->attorneycompany])->subject('Questionnaire Submission to Attorney');
    }
}
