<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;

class SubscriptionCreditedToAttorney extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    protected $user;
    protected $packageName;
    protected $no_of_questionnaire;
    protected $admin_remark;

    public function __construct(User $user, $packageName, $no_of_questionnaire, $admin_remark)
    {
        $this->user = $user;
        $this->packageName = $packageName;
        $this->no_of_questionnaire = $no_of_questionnaire;
        $this->admin_remark = $admin_remark;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.package_credited', ['user' => $this->user,'packageName' => $this->packageName,'no_of_questionnaire' => $this->no_of_questionnaire,'admin_remark' => $this->admin_remark])->subject('Subscriptions Credited by admin');
    }
}
