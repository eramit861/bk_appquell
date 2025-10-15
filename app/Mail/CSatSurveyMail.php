<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;

class CSatSurveyMail extends Mailable
{
    public $subject;
    protected $message;
    protected $link;

    public function __construct($subject, $message, $link)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.c_sat_survey_mail',['html'=> $this->message, 'link'=> $this->link ])->subject($this->subject);
    }
}
