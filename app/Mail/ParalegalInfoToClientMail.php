<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ParalegalInfoToClientMail extends Mailable
{
    protected $client_name;
    protected $name;
    protected $email;
    protected $phone_no;
    protected $appointment_link;
    protected $extra_message;

    public function __construct($client_name, $name, $email, $phone_no, $appointment_link, $extra_message)
    {
        $this->client_name = $client_name;
        $this->name = $name;
        $this->email = $email;
        $this->phone_no = $phone_no;
        $this->appointment_link = $appointment_link;
        $this->extra_message = $extra_message;
    }

    public function build()
    {
        return $this->view('emails.paralegal_info_to_client', [ 'client_name' => $this->client_name, 'name' => $this->name, 'email' => $this->email, 'phone_no' => $this->phone_no, 'appointment_link' => $this->appointment_link, 'extra_message' => $this->extra_message ])->subject('Paralegal Information');
    }

}
