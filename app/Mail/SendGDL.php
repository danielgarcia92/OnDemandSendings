<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendGDL extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /** @return void */
    public function __construct($data)
    {
        $this->data = $data;
        $this->subject = 'Asignación de vuelos GDL';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sendGDL');
    }
}
