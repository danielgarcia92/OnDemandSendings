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
        $this->baseLocation  = env('BASE_LOCATION');
    }

    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'jt' || Auth::user()->rol == 'ccv') {
            //try{

                date_default_timezone_set('America/Monterrey');				

		$params = array(
			'UN'  => $this->AIMSUser,
            		'PSW' => $this->AIMSPass,
			'PM'  => array(
				'DepArrMode' => "0",
            	'FromHH'     => "06",
            	'FromMin'    => "00",
				'FromDD'     => date('d'),
				'FromMonth'  => date('m'),
				'FromYYYY'   => date('Y'),
            	'ToHH'       => "21",
            	'ToMin'      => "00",
				'ToDD'       => date('d'),
				'ToMonth'    => date('m'),
				'ToYYYY'     => date('Y')
			)
        	);

		$options = array('location'=> $this->baseLocation);
		$soapClient = new \soapclient($this->baseUri, $options);
		$response = $soapClient->__soapCall("FlightDetails", array($params));
		//print_r($response);

               	$this->flightsWS = json_decode(json_encode($response), true);
                $this->flightsFW = \DB::table('bdAzureDM.vbmxods-infomgt.dbo.tbl_NewOTP AS FL')
                    ->select(['FL.Flight'
                        , 'PortFrom'
                        , 'PortTo'
                        , 'Rego'
                        , 'Dep'
                        , 'STDZulu'
                        , 'Demora FWBCG'
                        , 'Rango Demora FWBCG0'
                        , 'Rango Demora FWBCG15'
                    ])
                    ->where('FL.FW-BCG', '=', '1')
                    ->where('FL.SectorDate', '=', \DB::raw("CAST(GETDATE() AS DATE)"))
                    ->orderBy('FL.PortFrom')
                    ->orderBy('FL.Flight')
                    ->get();

                return view('livewire.f-w');
            //}catch(Exception $e){
                //return view('livewire.f-w');
            //}
        } else {
            return view('livewire.redirect');
        }
    }

    public function sendAction()
    {
        $data = request()->validate([
            'FW'    => 'required',
            'FWD'   => 'required',
            'FWD15' => 'required',
            'REG'   => 'required',
            'FLT'   => 'required',
            'DEP'   => 'required',
            'ARR'   => 'required',
            'STD'   => 'required',
            'COD'   => 'required',
            'MIN'   => 'required',
            'user'  => 'required',
            'BJX'   => 'required',
            'CUN'   => 'required',
            'GDL'   => 'required',
            'MEX'   => 'required',
            'MID'   => 'required',
            'MTY'   => 'required',
            'TIJ'   => 'required',
            'TLC'   => 'required',
            'BJXD'  => 'required',
            'CUND'  => 'required',
            'GDLD'  => 'required',
            'MEXD'  => 'required',
            'MIDD'  => 'required',
            'MTYD'  => 'required',
            'TIJD'  => 'required',
            'TLCD'  => 'required',
            'BJXD15' => 'required',
            'CUND15' => 'required',
            'GDLD15' => 'required',
            'MEXD15' => 'required',
            'MIDD15' => 'required',
            'MTYD15' => 'required',
            'TIJD15' => 'required',
            'TLCD15' => 'required',
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
