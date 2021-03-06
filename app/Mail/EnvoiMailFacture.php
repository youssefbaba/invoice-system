<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvoiMailFacture extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->data['objet_email'];
        return $this->subject($subject)->markdown('email.envoiemailfacture');
    }
}
