<?php

namespace App\Mail;

use App\Http\Controllers\UnsubscribeController;
use Illuminate\Mail\Mailable;

class AutomatedNotificationTemplateLoggedInUser extends Mailable
{
    protected $name;
    protected $mailSubject;
    protected $emailMessage;
    protected $fromEmail;
    protected $clientId;
    protected $clientEmail;

    public function __construct($name, $mailSubject, $emailMessage, $fromEmail = null, $clientId = null, $clientEmail = null)
    {
        $this->name = $name;
        $this->mailSubject = $mailSubject;
        $this->emailMessage = $emailMessage;
        $this->fromEmail = $fromEmail;
        $this->clientId = $clientId;
        $this->clientEmail = $clientEmail;
    }

    public function build()
    {
        // Generate unsubscribe URL if client information is available
        $unsubscribeUrl = null;
        if ($this->clientId && $this->clientEmail) {
            $unsubscribeToken = UnsubscribeController::generateUnsubscribeToken($this->clientId, $this->clientEmail);
            $unsubscribeUrl = route('unsubscribe.show', $unsubscribeToken);
        }

        $mail = $this->view('emails.automated_notification_template_logged_in_user', [
            'name' => $this->name,
            'emailMessage' => $this->emailMessage,
            'unsubscribeUrl' => $unsubscribeUrl
        ])->subject($this->mailSubject);

        if ($this->fromEmail) {
            $mail->from($this->fromEmail);
        }

        return $mail;
    }
}
