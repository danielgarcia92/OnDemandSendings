<?php

namespace App\Http\Livewire;

use App\Mail\SendFW;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class FW extends Component
{
    public function __construct()
    {
        $this->baseUri  = config('app.base_uri');
        $this->AIMSUser = config('app.AIMS_User');
        $this->AIMSPass = config('app.AIMS_Pass');
    }

    public function render()
    {
        try{
            date_default_timezone_set('America/Monterrey');
            $soapClient = new \soapclient($this->baseUri);
            $response = $soapClient->FlightDetails($this->AIMSUser, $this->AIMSPass, date('d'), date('m'), date('Y'), '07', '00', date('d'), date('m'), date('Y'), '16', '00');
            $this->flights = json_decode(json_encode($response), true);

            return view('livewire.f-w');
        }catch(Exception $e){
            $e->getMessage();
        }
    }

    public function sendAction()
    {
        $data = request()->validate([
            'FW'   => 'required',
            'FWD'  => 'required',
            'REG'  => 'required',
            'FLT'  => 'required',
            'DEP'  => 'required',
            'ARR'  => 'required',
            'STD'  => 'required',
            'COD'  => 'required',
            'MIN'  => 'required',
            'user' => 'required',
            'CUN'  => 'required',
            'GDL'  => 'required',
            'MEX'  => 'required',
            'MTY'  => 'required',
            'TIJ'  => 'required',
            'CUND' => 'required',
            'GDLD' => 'required',
            'MEXD' => 'required',
            'MTYD' => 'required',
            'TIJD' => 'required',
            'Comentarios' => 'required'
        ]);

        Mail::to(['daniel.garciav@vivaaerobus.com', 'filiberto.olachea@vivaaerobus.com'])->queue(new SendFW($data));

        return redirect()->route('dashboard');
    }
}
