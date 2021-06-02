<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvoiMailFeedback extends Mailable
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
        return $this->from($this->data['email_employe'])
        ->subject($this->data['objet'])->markdown('email.envoiemailfeedback')
        ->attach($this->data['file']->getRealPath(), [
            'as' => $this->data['file']->getClientOriginalName(),
        ]);
    }
}
