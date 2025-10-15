<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ParalegalAssignedNotification extends Mailable
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.paralegal_assigned_notification', ['data' => $this->data,])->subject('Great News!! Bankruptcy Case Assigned');
    }
}
