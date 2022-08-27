<?php

namespace App\Http\Livewire;

use App\Models\LegMain;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GDL extends Component
{
    public function __construct()
    {
        $this->baseUri  = env('BASE_URI');
        $this->AIMSUser = env('AIMS_USER');
        $this->AIMSPass = env('AIMS_Pass');
    }

    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'jt' || Auth::user()->rol == 'ccv' || Auth::user()->rol == 'gdl') {
            try{
                $OQAD = LegMain::select([\DB::raw("VIV.dbo.fn_ToAimsDate(CONVERT(datetime, GETDATE() + 1, 103)) DATE")])->first();

                $this->flights = \DB::table('AIMSPROD.VIV.dbo.LEGMAIN AS FL')
                    ->select(['FL.REG'
                        , \DB::raw("CASE WHEN (SELECT TOP 1 FL2.FLT FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'GDL' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) IS NULL THEN 'HGR' ELSE (SELECT TOP 1 CAST(FL2.FLT AS varchar) FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'GDL' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) END 'Llegada'")
                        , \DB::raw("CASE WHEN (SELECT TOP 1 FL2.DEP FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'GDL' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) IS NULL THEN 'HGR' ELSE (SELECT TOP 1 CAST(FL2.DEP AS varchar) FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'GDL' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) END 'Origen'")
                        , \DB::raw("(SELECT TOP 1 CONVERT(VARCHAR(16),VIV_CORE.dbo.GetStartTimeStrViv_V5(FL2.DAY, FL2.STA, FL2.ARR), 120) FROM AIMSPROD.VIV.dbo.LEGMAIN FL2 WITH (NOLOCK) WHERE FL2.DAY BETWEEN ".$OQAD->DATE." - 1 AND ".$OQAD->DATE." + 1 AND FL2.REG = FL.REG AND FL2.ARR = 'GDL' AND ((FL2.DAY = FL.DAY AND FL2.STD < FL.STD) OR (FL2.DAY < FL.DAY)) AND CARRIER = 1 AND CANCELLED = 0 ORDER BY DAY DESC, STD DESC) 'STA'")
                        , 'FL.FLT'
                        , 'FL.ARR'
                        , \DB::raw('CONVERT(VARCHAR(16),VIV_CORE.dbo.GetStartTimeStrViv_V5(FL.DAY, FL.STD, FL.DEP), 120) STD')
                    ])
                    //->where('STD', '>', 300)
                    ->where('FL.DEP', '=', 'GDL')
                    ->where('FL.CARRIER', '=', 1)
                    ->where('FL.CANCELLED', '=', 0)
                    ->where(function($query) use ($OQAD) {
                        $query->where('FL.DAY', '<', $OQAD->DATE + 1)
                            ->orWhere('FL.STA', '<=', 600);
                    })
                    ->whereBetween('FL.DAY', [$OQAD->DATE, $OQAD->DATE + 1])
                    ->where(\DB::raw("CONVERT(VARCHAR(16),VIV_CORE.dbo.GetStartTimeStrViv_V5(FL.DAY, FL.STD, FL.DEP), 120)"), '>=', \DB::raw("CAST(GETDATE() + 1 AS DATE)"))
                    ->orderBy('FL.DAY')
                    ->orderBy('FL.STD')
                    ->get();

            }catch(Exception $e){
                return view('livewire.redirect');
            }

            return view('livewire.g-d-l');
        }

        return view('livewire.redirect');
    }

}
