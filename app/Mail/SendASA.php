<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendASA extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /** @return void */
    public function __construct($data)
    {
        $this->data = $data;
        $this->subject = 'Asignación de vuelos ASA';
    }

    /** @return $this */
    public function build()
    {
        return $this->view('emails.sendASA');
    }

}
