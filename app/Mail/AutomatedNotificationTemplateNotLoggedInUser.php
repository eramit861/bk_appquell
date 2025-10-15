<?php

namespace App\Mail;

use App\Http\Controllers\UnsubscribeController;
use Illuminate\Mail\Mailable;

class AutomatedNotificationTemplateNotLoggedInUser extends Mailable
{
    protected $name;
    protected $mailSubject;
    protected $fromEmail;
    protected $clientId;
    protected $clientEmail;

    public function __construct($name, $mailSubject, $fromEmail = null, $clientId = null, $clientEmail = null)
    {
        $this->name = $name;
        $this->mailSubject = $mailSubject;
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

        $mail = $this->view('emails.automated_notification_template_not_logged_in_user', [
            'name' => $this->name,
            'unsubscribeUrl' => $unsubscribeUrl
        ])->subject($this->mailSubject);

        if ($this->fromEmail) {
            $mail->from($this->fromEmail);
        }

        return $mail;
    }
}
