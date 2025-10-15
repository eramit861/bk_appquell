<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class IntakeFormStepSubmit extends Mailable
{
    protected $name;
    protected $stepNo;
    protected $nextStepUrl;
    protected $lawFirmName;

    public function __construct($name, $stepNo, $nextStepUrl, $lawFirmName)
    {
        $this->name = $name;
        $this->stepNo = $stepNo;
        $this->nextStepUrl = $nextStepUrl;
        $this->lawFirmName = $lawFirmName;
    }

    public function build()
    {

        $subject = 'Submission Confirmation: Intake Form Received';
        if ($this->stepNo == 1) {
            $subject = 'Step 1 Done! Let’s Move on to Step 2';
        } elseif ($this->stepNo == 2) {
            $subject = 'Step 2 Done! Let’s Move on to Step 3';
        }

        return $this->view('emails.intake_form_step_submit', ['name' => $this->name, 'stepNo' => $this->stepNo, 'nextStepUrl' => $this->nextStepUrl, 'lawFirmName' => $this->lawFirmName])->subject($subject);
    }

}
