﻿<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('FW') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <form method="POST" onSubmit="if(!confirm('¿Realmente desea enviar el correo FW?')){return false;}" action="{{ url("FW/SendEmail") }}" validate>
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="overflow-x-auto relative">
                    @php $FW=0; $BJX=0; $CUN=0;  $GDL=0; $MEX=0; $MID=0; $MTY=0; $NLU=0; $TIJ=0; $TLC=0; @endphp
                    @php $FWD=0; $BJXD=0; $CUND=0; $GDLD=0; $MEXD=0; $MIDD=0; $MTYD=0; $NLUD=0; $TIJD=0; $TLCD=0; @endphp
                    @php $FWD15=0; $BJXD15=0; $CUND15=0; $GDLD15=0; $MEXD15=0; $MIDD15=0; $MTYD15=0; $NLUD15=0; $TIJD15=0; $TLCD15=0; @endphp
                    <input type="hidden" name="BJX"  value="{{ $BJX }}" />
                    <input type="hidden" name="BJXD" value="{{ $BJXD }}"/>
                    <input type="hidden" name="BJXD15" value="{{ $BJXD15 }}"/>
                    <input type="hidden" name="CUN"  value="{{ $CUN }}" />
                    <input type="hidden" name="CUND" value="{{ $CUND }}"/>
                    <input type="hidden" name="CUND15" value="{{ $CUND15 }}"/>

                    @for($x = 0; $x < count($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight']); $x++)
                        
                        @for($y = 0; $y < count($flightsFW); $y++)
                            @if($flightsFW[$y]->Flight == $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightNo"] && $flightsFW[$y]->PortFrom == $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] && $flightsFW[$y]->ActTo == $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightArr"])
                                @php
                                    $FW += 1;
                                
                                    if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]) ) {
                                    
                                        $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];

                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                            
                                            $minutes = 0;

                                            if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $FWD += 1;
                                                }

                                            foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P'){
                                                    $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                }
                                            }
                                        }else{
                                            if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                $FWD += 1;
                                                
                                                $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                            }   
                                        }
                                        
                                        if($minutes > 15)
                                            $FWD15 += 1;                                        

                                        while ($minutes >= 60) {
                                            if ($minutes >= 1440) {
                                                $time['days']++;
                                                $minutes = $minutes - 1440;
                                            } else if ($minutes >= 60) {
                                                $time['hours']++;
                                                $minutes = $minutes - 60;
                                            }
                                        }

                                        $time['minutes'] = $minutes;

                                        //$time = explode(':', $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"]);
                                        //$time = ($time[0]*60) + ($time[1]);
                                    }    
                                    
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'BJX') {
                                        
                                        $BJX += 1;
                                        
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];

                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;
                                                
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $BJXD += 1;
                                                }

                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor) {
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P'){
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $BJXD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }
                                            
                                            if($minutes > 15)
                                                $BJXD15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                    
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'CUN') {

                                        $CUN += 1;
                                        
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])){
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;

                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $CUND += 1;
                                                }
                                                
                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"] as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P'){
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $CUND += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }

                                            if($minutes > 15)
                                                $CUND15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'GDL') {
                                    
                                        $GDL += 1;
                                        
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;

                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $GDLD += 1;
                                                }
                                                
                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P') {
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $GDLD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }

                                            if($minutes > 15)
                                                $GDLD15 += 1;
                                            
                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'MEX') {
                                    
                                        $MEX += 1;
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;

                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $MEXD += 1;
                                                }
                                                
                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P') {
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $MEXD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }

                                            if($minutes > 15)
                                                $MEXD15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'MID') {
                                    
                                        $MID += 1;
                                        
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])){
                                                
                                                $minutes = 0;
                                                
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $MIDD += 1;
                                                }

                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P'){
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }
                                            else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $MIDD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }

                                            if($minutes > 15)
                                                $MIDD15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'MTY') {
                                    
                                        $MTY += 1;
                                        
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;
                                                
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $MTYD += 1;
                                                }

                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P'){
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }
                                            else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $MTYD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }

                                            if($minutes > 15)
                                                $MTYD15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'NLU') {
                                        
                                        $NLU += 1;
                                        
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;
                                                
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $NLUD += 1;
                                                }

                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P') {
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }
                                            else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $NLUD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                                
                                            }

                                            if($minutes > 15)
                                                $NLUD15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'TIJ') {
                                    
                                        $TIJ += 1;
                                    
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;

                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $TIJD += 1;
                                                }
                                                
                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P') {
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }
                                            else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $TIJD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }

                                            if($minutes > 15)
                                                $TIJD15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                
                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] == 'TLC') {
                                    
                                        $TLC += 1;
                                        
                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"])) {
                                        
                                            $time = ['days' => 0, 'hours' => 0, 'minutes' => 0];
                                            
                                            if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])) {
                                                
                                                $minutes = 0;
                                                
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] != 'P' || $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] != 'P') {
                                                    $TLCD += 1;
                                                }

                                                foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                    if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["SubDelayCode"] != 'P') {
                                                        $minutes += $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"];
                                                    }
                                                }
                                            }
                                            else{
                                                if($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] != 'P'){
                                                    $TLCD += 1;

                                                    $minutes = $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["FDelayTime"];
                                                }
                                            }

                                            if($time > 15)
                                                $TLCD15 += 1;

                                            while ($minutes >= 60) {
                                                if ($minutes >= 1440) {
                                                    $time['days']++;
                                                    $minutes = $minutes - 1440;
                                                } else if ($minutes >= 60) {
                                                    $time['hours']++;
                                                    $minutes = $minutes - 60;
                                                }
                                            }

                                            $time['minutes'] = $minutes;
                                        }
                                    }
                                @endphp
                            @endif
                        @endfor
                    @endfor

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Base
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Vuelos
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Vuelos Demorados
                            </th>
                            <th scope="col" class="py-3 px-6">
                                FWD 0
                            </th>
                            <th scope="col" class="py-3 px-6">
                                FWD 15
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($BJX != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                BJX
                            </th>
                            <td class="py-4 px-6">
                                {{ $BJX }}
                                <input type="hidden" name="BJX"  value="{{ $BJX }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $BJXD }}
                                <input type="hidden" name="BJXD" value="{{ $BJXD }}"/>
                                <input type="hidden" name="BJXD15" value="{{ $BJXD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $BJXD*100/$BJX, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $BJXD15*100/$BJX, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($CUN != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                CUN
                            </th>
                            <td class="py-4 px-6">
                                {{ $CUN }}
                                <input type="hidden" name="CUN"  value="{{ $CUN }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $CUND }}
                                <input type="hidden" name="CUND" value="{{ $CUND }}"/>
                                <input type="hidden" name="CUND15" value="{{ $CUND15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $CUND*100/$CUN, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $CUND15*100/$CUN, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($GDL != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                GDL
                            </th>
                            <td class="py-4 px-6">
                                {{ $GDL }}
                                <input type="hidden" name="GDL"  value="{{ $GDL }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $GDLD }}
                                <input type="hidden" name="GDLD" value="{{ $GDLD }}"/>
                                <input type="hidden" name="GDLD15" value="{{ $GDLD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $GDLD*100/$GDL, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $GDLD15*100/$GDL, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($MEX != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                MEX
                            </th>
                            <td class="py-4 px-6">
                                {{ $MEX }}
                                <input type="hidden" name="MEX"  value="{{ $MEX }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $MEXD }}
                                <input type="hidden" name="MEXD" value="{{ $MEXD }}"/>
                                <input type="hidden" name="MEXD15" value="{{ $MEXD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $MEXD*100/$MEX, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $MEXD15*100/$MEX, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($MID != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                MID
                            </th>
                            <td class="py-4 px-6">
                                {{ $MID }}
                                <input type="hidden" name="MID"  value="{{ $MID }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $MIDD }}
                                <input type="hidden" name="MIDD" value="{{ $MIDD }}"/>
                                <input type="hidden" name="MIDD15" value="{{ $MIDD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $MIDD*100/$MID, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $MIDD15*100/$MID, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($MTY != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                MTY
                            </th>
                            <td class="py-4 px-6">
                                {{ $MTY }}
                                <input type="hidden" name="MTY"  value="{{ $MTY }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $MTYD }}
                                <input type="hidden" name="MTYD" value="{{ $MTYD }}"/>
                                <input type="hidden" name="MTYD15" value="{{ $MTYD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $MTYD*100/$MTY, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $MTYD15*100/$MTY, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($NLU != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                NLU
                            </th>
                            <td class="py-4 px-6">
                                {{ $NLU }}
                                <input type="hidden" name="NLU"  value="{{ $NLU }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $NLUD }}
                                <input type="hidden" name="NLUD" value="{{ $NLUD }}"/>
                                <input type="hidden" name="NLUD15" value="{{ $NLUD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $NLUD*100/$NLU, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $NLUD15*100/$NLU, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($TIJ != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                TIJ
                            </th>
                            <td class="py-4 px-6">
                                {{ $TIJ }}
                                <input type="hidden" name="TIJ"  value="{{ $TIJ }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $TIJD }}
                                <input type="hidden" name="TIJD" value="{{ $TIJD }}"/>
                                <input type="hidden" name="TIJD15" value="{{ $TIJD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $TIJD*100/$TIJ, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $TIJD15*100/$TIJ, 2) }}%
                            </td>
                        </tr>
                        @endif
                        @if($TLC != 0)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                TLC
                            </th>
                            <td class="py-4 px-6">
                                {{ $TLC }}
                                <input type="hidden" name="TLC"  value="{{ $TLC }}" />
                            </td>
                            <td class="py-4 px-6">
                                {{ $TLCD }}
                                <input type="hidden" name="TLCD" value="{{ $TLCD }}"/>
                                <input type="hidden" name="TLCD15" value="{{ $TLCD15 }}"/>
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $TLCD*100/$TLC, 2) }}%
                            </td>
                            <td class="py-4 px-6">
                                {{ round(100 - $TLCD15*100/$TLC, 2) }}%
                            </td>
                        </tr>
                        @endif
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <B>Total</B>
                            </th>
                            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <B>{{ $FW }}</B>
                                <input type="hidden" name="FW"   value="{{ $FW }}"  />
                            </th>
                            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <B>{{ $FWD }}</B>
                                <input type="hidden" name="FWD"  value="{{ $FWD }}" />
                                <input type="hidden" name="FWD15"  value="{{ $FWD15 }}" />
                            </th>
                            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <B>{{ round(100 - $FWD*100/$FW, 2) }}%</B>
                            </th>
                            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <B>{{ round(100 - $FWD15*100/$FW, 2) }}%</B>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <br>
                <div class="py-4 overflow-x-auto relative">
                    <center><h1>Vuelos Demorados</h1></center>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                #
                            </th>
                            <th scope="col" class="py-3 px-6">
                                REG
                            </th>
                            <th scope="col" class="py-3 px-6">
                                FLT
                            </th>
                            <th scope="col" class="py-3 px-6">
                                DEP
                            </th>
                            <th scope="col" class="py-3 px-6">
                                ARR
                            </th>
                            <th scope="col" class="py-3 px-6">
                                STD
                            </th>
                            <th scope="col" class="py-3 px-6">
                                COD
                            </th>
                            <th scope="col" class="py-3 px-6">
                                MIN
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Comentarios
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $contdel = 0; @endphp
                        @for($x = 0; $x < count($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight']); $x++)
                            @for($y = 0; $y < count($flightsFW); $y++)
                                @if($flightsFW[$y]->Flight == $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightNo"] && $flightsFW[$y]->PortFrom == $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] && $flightsFW[$y]->ActTo == $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightArr"])
                                    @if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]))
                                        
                                        @if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"]) && $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]["SubDelayCode"] == 'P')
                                            {{ "" }}
                                        @elseif(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"]) && $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["SubDelayCode"] == 'P')
                                            {{ "" }}
                                        @elseif(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"]) && $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][1]["SubDelayCode"] == 'P')
                                            {{ "" }}
                                        @else
                                            @php $contdel += 1; @endphp
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $contdel }}
                                                </th>
                                                <td class="py-4 px-6">
                                                    {{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightReg"] }}
                                                    <input type="hidden" name="REG[]" value="{{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightReg"] }}" />
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDesc"] }}
                                                    <input type="hidden" name="FLT[]" value="{{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDesc"] }}" />
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] }}
                                                    <input type="hidden" name="DEP[]" value="{{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDep"] }}" />
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightArr"] }}
                                                    <input type="hidden" name="ARR[]" value="{{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightArr"] }}" />
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightYY"] ."/". $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightMM"] ."/". $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDD"] ."  ". $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightStd"] }}
                                                    <input type="hidden" name="STD[]" value="{{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightYY"] ."/". $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightMM"] ."/". $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDD"] ."  ". $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightStd"] }}" />
                                                </td>
                                                <td class="py-4 px-6">
                                                    @php
                                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayCode"])){
                                                            foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                                echo($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayCode"]) . " / ";
                                                            }
                                                        }
                                                        else{
                                                            echo($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]['FDelayCode']);
                                                        }
                                                            
                                                    @endphp
                                                    
                                                        
                                                    @php
                                                        echo "<input type='hidden' name='COD[]' value='";
                                                        
                                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayCode"])){
                                                        
                                                            foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                            
                                                                echo ($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayCode"]) . " / ";
                                                            }
                                                        }
                                                        else{
                                                            echo($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]['FDelayCode']);
                                                        }
                                                        
                                                        echo "'/>";
                                                    @endphp
                                                        
                                                </td>
                                                <td class="py-4 px-6">
                                                    @php
                                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])){
                                                            foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                            
                                                                echo($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"]) . " / ";
                                                            }
                                                        }
                                                        else{
                                                            echo($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]['FDelayTime']);
                                                        }
                                                    @endphp

                                                    @php
                                                        echo "<input type='hidden' name='MIN[]' value='";
                                                        if(isset($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][0]["FDelayTime"])){
                                                            foreach($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]  as $clave => $valor){
                                                            
                                                                echo($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"][$clave]["FDelayTime"]) . " / ";
                                                            }
                                                        }
                                                        else{
                                                            echo($flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]["FlightDepDelays"]["FlightDelay"]['FDelayTime']);
                                                        }
                                                        echo "'/>";
                                                    @endphp
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]['DelayRemarks'] }}
                                                    <input type="hidden" name="Comentarios[]" value="{{ $flightsWS['FlightDetailsResult']['FlightList']['TAIMSFlight'][$x]['DelayRemarks'] }}" />
                                                </td>
                                            </tr>
                                        @endif

                                        
                                    @endif
                                @endif
                            @endfor
                        @endfor
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <br>
                <div class="py-4 overflow-x-auto relative">
                    <center><h1>Total Vuelos FW</h1></center>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                #
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Vuelo
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Origen
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Destino
                            </th>
                            <th scope="col" class="py-3 px-6">
                                STD
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($flightsFW as $key => $flight)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $key + 1 }}
                                </th>
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @php print_r($flightsFW[$key]->Flight) @endphp
                                </th>
                                <td class="py-4 px-6">
                                    @php print_r($flightsFW[$key]->PortFrom) @endphp
                                </td>
                                <td class="py-4 px-6">
                                    @php print_r($flightsFW[$key]->PortTo) @endphp
                                </td>
                                <td class="py-4 px-6">
                                    @php print_r(substr($flightsFW[$key]->STDZulu, 0, 16)) @endphp
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-4 overflow-x-auto relative content-center">
                    <center>
                        <input type="hidden" name="user" value="{{Auth::user()->getAuthIdentifier()}}"/>
                        <div id="form1">
                            <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#5BAD34" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="10" y1="14" x2="21" y2="3" />
                                    <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                                </svg>
                                <span style="color: #5BAD34">  Enviar Correo</span>
                            </button>
                        </div>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>
