<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OnePageQuesRequestSuccessToClient extends Mailable
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->view('emails.one_page_ques_request_success_to_client', ['name' => $this->name])->subject('Submission Confirmation: Intake Form Received');
    }

}
