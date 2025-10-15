<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class PasswordResetToClientMail extends Mailable
{
    protected $name;
    protected $email;
    protected $password;
    protected $clientLoginUrl;

    public function __construct($name, $email, $password, $clientLoginUrl)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->clientLoginUrl = $clientLoginUrl;
    }

    public function build()
    {
        return $this->view('emails.password_reset_to_client', [ 'name' => $this->name, 'email' => $this->email, 'password' => $this->password, 'clientLoginUrl' => $this->clientLoginUrl ])->subject('Password Reset');
    }

}
