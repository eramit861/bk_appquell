<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ClientAppointmentReminderMail extends Mailable
{
    protected $name;
    protected $date;
    protected $time;
    protected $location;

    public function __construct($name, $date, $time, $location)
    {
        $this->name = $name;
        $this->date = $date;
        $this->time = $time;
        $this->location = $location;
    }

    public function build()
    {
        return $this->view('emails.client_appointment_reminder', [ 'name' => $this->name, 'date' => $this->date, 'time' => $this->time, 'location' => $this->location ])->subject('Appointment Reminder');
    }

}
