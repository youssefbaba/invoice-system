<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class CreateNewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password = null;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = " Votre email et mot de passe pour l'authentification  sur l'application Fatoura";
        return $this
            ->subject($subject)->markdown('email.emailforloginuser');
    }
}
