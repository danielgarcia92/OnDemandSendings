<?php

namespace App\Http\Livewire;

use App\Mail\SendFW;
use App\Models\Emails;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FW extends Component
{
    public function __construct()
    {
        $this->baseUri  = env('BASE_URI');
        $this->AIMSUser = env('AIMS_USER');
        $this->AIMSPass = env('AIMS_Pass');
    }

    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'jt' || Auth::user()->rol == 'ccv') {
            try{
                date_default_timezone_set('America/Monterrey');
                $soapClient = new \soapclient($this->baseUri);
                $response = $soapClient->FlightDetails($this->AIMSUser, $this->AIMSPass, date('d'), date('m'), date('Y'), '07', '00', date('d'), date('m'), date('Y'), '16', '00');
                $this->flights = json_decode(json_encode($response), true);

                return view('livewire.f-w');
            }catch(Exception $e){
                //$e->getMessage();
                return view('livewire.f-w');
            }
        } else {
            return view('livewire.redirect');
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

        $to = [];

        $emails = Emails::where('active', 1)
            ->where(function($query) {
                $query->where('apps_id', '=', 1)
                      ->orWhere('apps_id', '=', 2);
            })
            ->get('email');

        foreach ($emails as $email)
            array_push($to, $email->email);

        array_push($to, Auth::user()->email);

        Mail::bcc($to)->queue(new SendFW($data));

        return redirect()->route('dashboard');
    }
}
