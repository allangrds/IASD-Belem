<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
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
        $address = 'iasdbelem.comunicacao@gmail.com';
        $subject = 'Contato do site';

        return $this->view('emails.contact')
            ->from($address)
            ->subject($subject)
            ->with([
                'emailMessage' => $this->data['emailMessage'],
                'name' => $this->data['name'],
                'email' => $this->data['email'],
            ]);
    }
}
