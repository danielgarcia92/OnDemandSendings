<?php

namespace App\Http\Livewire;

use App\Mail\SendASA;
use App\Models\Emails;
use App\Models\LegMain;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ASA extends Component
{
    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'jt' || Auth::user()->rol == 'ccv' || Auth::user()->rol == 'asa'  || Auth::user()->rol == 'acdm' ) {
            try{
                $OQAD = LegMain::select([\DB::raw("VIV.dbo.fn_ToAimsDate(CONVERT(datetime, GETDATE(), 103)) DATE")])->first();

                $this->flights = \DB::table('AIMSPROD.VIV.dbo.LEGMAIN AS FL')
                    ->select(['FL.REG'
                        , \DB::raw("CASE WHEN (SELECT TOP 1 FL2.FLT FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'MEX' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) IS NULL THEN 'HGR' ELSE (SELECT TOP 1 CAST(FL2.FLT AS varchar) FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'MEX' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) END 'Llegada'")
                        , \DB::raw("CASE WHEN (SELECT TOP 1 FL2.DEP FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'MEX' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) IS NULL THEN 'HGR' ELSE (SELECT TOP 1 CAST(FL2.DEP AS varchar) FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'MEX' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) END 'Origen'")
                        , \DB::raw("(SELECT TOP 1 CONVERT(VARCHAR(16),VIV_CORE.dbo.GetStartTimeStrViv_V5(FL2.DAY, FL2.STA, FL2.ARR), 120) FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'MEX' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) 'STA'")
                        , 'FL.FLT'
                        , 'FL.ARR'
                        , \DB::raw("FORMAT(DATEADD(MINUTE, -5, VIV_CORE.dbo.GetStartTimeStrViv_V5(FL.DAY, FL.STD, FL.DEP)), 'yyyy-MM-dd HH:mm') STD")
                    ])
                    ->where('FL.DEP', '=', 'MEX')
                    ->where('FL.CARRIER', '=', 1)
                    ->where('FL.CANCELLED', '=', 0)
                    ->whereBetween('FL.DAY', [$OQAD->DATE, $OQAD->DATE + 1])
                    ->where(\DB::raw("CONVERT(VARCHAR(16),VIV_CORE.dbo.GetStartTimeStrViv_V5(FL.DAY, FL.STD, FL.DEP), 120)"), '>=', \DB::raw("CAST(GETDATE() AS DATE)"))
                    ->where(function($query) use ($OQAD) {
                        $query->where('FL.DAY', '<', $OQAD->DATE + 1)
                            ->orWhere('FL.STA', '<=', 600);
                    })
                    ->orderBy('FL.DAY')
                    ->orderBy('FL.STD')
                    ->get();

                $this->flightsHGR = \DB::table('AIMSPROD.VIV.dbo.LEGMAIN AS FL')
                    ->select(['FL.REG'
                        , 'FL.FLT AS Llegada'
                        , 'FL.DEP AS Origen'
                        , \DB::raw('CONVERT(VARCHAR(16),VIV_CORE.dbo.GetStartTimeStrViv_V5(FL.DAY, FL.STA, FL.ARR), 120) STA')
                        , \DB::raw("'HGR' AS FLT")
                        , \DB::raw("'HGR' AS ARR")
                        , \DB::raw("'HGR' AS STD")
                    ])
                    ->where('FL.ARR', '=', 'MEX')
                    ->where('FL.CARRIER', '=', 1)
                    ->where('FL.CANCELLED', '=', 0)
                    ->whereBetween('FL.DAY', [$OQAD->DATE, $OQAD->DATE + 1])
                    ->whereNull(\DB::raw("(SELECT TOP 1 FL2.FLT FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.DEP = 'MEX' AND ((FL2.DAY = FL.DAY AND FL2.STD > FL.STD) OR (FL2.DAY > FL.DAY)) AND ((FL2.DAY > ".$OQAD->DATE." OR FL2.STD > 300) AND (FL2.DAY < ".$OQAD->DATE." + 1 OR FL2.STD < 400)) AND CANCELLED = 0 ORDER BY FL2.DAY, FL2.STD)"))
                    ->where(\DB::raw("CONVERT(VARCHAR(16),VIV_CORE.dbo.GetStartTimeStrViv_V5(FL.DAY, FL.STA, FL.ARR), 120)"), '>=', \DB::raw("CAST(GETDATE() AS DATE)"))
                    ->where(function($query) use ($OQAD) {
                        $query->where('FL.DAY', '<', $OQAD->DATE + 1)
                            ->orWhere('FL.STA', '<=', 600);
                    })
                    ->orderBy('FL.DAY')
                    ->orderBy('FL.STA')
                    ->get();

            }catch(Exception $e){
                return view('livewire.redirect');
            }

            return view('livewire.a-s-a');
        }

        return view('livewire.redirect');
    }

    public function sendAction()
    {
        $data = request()->validate([
            'KEY'   => 'required',
            'REG'  => 'required',
            'Llegada'  => 'required',
            'Origen'  => 'required',
            'STA'  => 'required',
            'FLT'  => 'required',
            'ARR'  => 'required',
            'STD' => 'required'
        ]);

        $to = [];

        $emails = Emails::where('active', 1)
            ->where(function($query) {
                $query->where('apps_id', '=', 1)
                    ->orWhere('apps_id', '=', 6);
            })
            ->get('email');

        foreach ($emails as $email)
            array_push($to, $email->email);

        array_push($to, Auth::user()->email);

        Mail::to($to)->queue(new SendASA($data));

        return redirect()->route('dashboard');
    }

}
