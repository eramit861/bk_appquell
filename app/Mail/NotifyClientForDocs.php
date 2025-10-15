<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class NotifyClientForDocs extends Mailable
{
    protected $clientName;
    protected $list;
    protected $notifyMessage;
    protected $category;

    public function __construct($clientName, $list, $notifyMessage, $category)
    {
        $this->clientName = $clientName;
        $this->list = $list;
        $this->notifyMessage = $notifyMessage;
        $this->category = $category;
    }

    public function build()
    {
        return $this->view('emails.notify_client_for_docs', [
                        'clientName' => $this->clientName,
                        'list' => $this->list,
                        'notifyMessage' => $this->notifyMessage,
                        'category' => $this->category])
                    ->subject('Document resend notification');
    }
}
