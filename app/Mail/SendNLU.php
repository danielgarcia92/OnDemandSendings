<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNLU extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**  @return void */
    public function __construct($data)
    {
        $this->data = $data;
        $this->subject = 'Asignación de vuelos NLU';
    }

    /** @return $this */
    public function build()
    {
        return $this->view('emails.sendNLU')
            ->attach(storage_path('app\public\NLU.csv'), [
                'mime' => 'text/csv',
            ]);
    }

}
