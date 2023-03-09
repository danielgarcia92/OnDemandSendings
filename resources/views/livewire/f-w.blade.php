<x-slot name="header">
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
                    @php $FW=0; $CUN=0;  $GDL=0; $MEX=0; $MTY=0; $TIJ=0; @endphp
                    @php $FWD=0; $CUND=0; $GDLD=0; $MEXD=0; $MTYD=0; $TIJD=0; @endphp
                    @php $FWD15=0; $CUND15=0; $GDLD15=0; $MEXD15=0; $MTYD15=0; $TIJD15=0; @endphp

                    @foreach($flights['FlightList'] as $key => $flight)
                        @if($flights['FlightList'][$key]["Flags"] == 2 || $flights['FlightList'][$key]["Flags"] == 18)
                            @php $FW += 1; @endphp
                            @if(isset($flights['FlightList'][$key]["FlightDepDelays"][0]))
                                @php $FWD += 1; @endphp
                                @php
                                    $time = explode(':', $flights['FlightList'][$key]["FlightDepDelays"][0]["DelayTime"]);
                                    $time = ($time[0]*60) + ($time[1]);
                                    if($time > 15)
                                        $FWD15 += 1;
                                @endphp
                            @endif
                            @if($flights['FlightList'][$key]["FlightDep"] == 'CUN')
                                @php $CUN += 1; @endphp
                                @if(isset($flights['FlightList'][$key]["FlightDepDelays"][0]))
                                    @php $CUND += 1; @endphp
                                    @php
                                        $time = explode(':', $flights['FlightList'][$key]["FlightDepDelays"][0]["DelayTime"]);
                                        $time = ($time[0]*60) + ($time[1]);
                                        if($time > 15)
                                            $CUND15 += 1;
                                    @endphp
                                @endif
                            @endif
                            @if($flights['FlightList'][$key]["FlightDep"] == 'GDL')
                                @php $GDL += 1; @endphp
                                @if(isset($flights['FlightList'][$key]["FlightDepDelays"][0]))
                                    @php $GDLD += 1; @endphp
                                    @php
                                        $time = explode(':', $flights['FlightList'][$key]["FlightDepDelays"][0]["DelayTime"]);
                                        $time = ($time[0]*60) + ($time[1]);
                                        if($time > 15)
                                            $GDLD15 += 1;
                                    @endphp
                                @endif
                            @endif
                            @if($flights['FlightList'][$key]["FlightDep"] == 'MEX')
                                @php $MEX += 1; @endphp
                                @if(isset($flights['FlightList'][$key]["FlightDepDelays"][0]))
                                    @php $MEXD += 1; @endphp
                                    @php
                                        $time = explode(':', $flights['FlightList'][$key]["FlightDepDelays"][0]["DelayTime"]);
                                        $time = ($time[0]*60) + ($time[1]);
                                        if($time > 15)
                                            $MEXD15 += 1;
                                    @endphp
                                @endif
                            @endif
                            @if($flights['FlightList'][$key]["FlightDep"] == 'MTY')
                                @php $MTY += 1; @endphp
                                @if(isset($flights['FlightList'][$key]["FlightDepDelays"][0]))
                                    @php $MTYD += 1; @endphp
                                    @php
                                        $time = explode(':', $flights['FlightList'][$key]["FlightDepDelays"][0]["DelayTime"]);
                                        $time = ($time[0]*60) + ($time[1]);
                                        if($time > 15)
                                            $MTYD15 += 1;
                                    @endphp
                                @endif
                            @endif
                            @if($flights['FlightList'][$key]["FlightDep"] == 'TIJ')
                                @php $TIJ += 1; @endphp
                                @if(isset($flights['FlightList'][$key]["FlightDepDelays"][0]))
                                    @php $TIJD += 1; @endphp
                                    @php
                                        $time = explode(':', $flights['FlightList'][$key]["FlightDepDelays"][0]["DelayTime"]);
                                        $time = ($time[0]*60) + ($time[1]);
                                        if($time > 15)
                                            $TIJD15 += 1;
                                    @endphp
                                @endif
                            @endif
                        @endif
                    @endforeach
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
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
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
                        @foreach($flights['FlightList'] as $key => $flight)
                            @if($flights['FlightList'][$key]["Flags"] == 2 || $flights['FlightList'][$key]["Flags"] == 18)
                                @if(isset($flights['FlightList'][$key]["FlightDepDelays"][0]))
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $flights['FlightList'][$key]["FlightReg"] }}
                                            <input type="hidden" name="REG[]" value="{{ $flights['FlightList'][$key]["FlightReg"] }}" />
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $flights['FlightList'][$key]["FlightDesc"] }}
                                            <input type="hidden" name="FLT[]" value="{{ $flights['FlightList'][$key]["FlightDesc"] }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flights['FlightList'][$key]["FlightDep"] }}
                                            <input type="hidden" name="DEP[]" value="{{ $flights['FlightList'][$key]["FlightDep"] }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flights['FlightList'][$key]["FlightArr"] }}
                                            <input type="hidden" name="ARR[]" value="{{ $flights['FlightList'][$key]["FlightArr"] }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flights['FlightList'][$key]["FlightYY"] ."/". $flights['FlightList'][$key]["FlightMM"] ."/". $flights['FlightList'][$key]["FlightDD"] ."  ". $flights['FlightList'][$key]["FlightStd"] }}
                                            <input type="hidden" name="STD[]" value="{{ $flights['FlightList'][$key]["FlightYY"] ."/". $flights['FlightList'][$key]["FlightMM"] ."/". $flights['FlightList'][$key]["FlightDD"] ."  ". $flights['FlightList'][$key]["FlightStd"] }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flights['FlightList'][$key]["FlightDepDelays"][0]['DelayCode'] }}
                                            <input type="hidden" name="COD[]" value="{{ $flights['FlightList'][$key]["FlightDepDelays"][0]['DelayCode'] }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flights['FlightList'][$key]["FlightDepDelays"][0]['DelayTime'] }}
                                            <input type="hidden" name="MIN[]" value="{{ $flights['FlightList'][$key]["FlightDepDelays"][0]['DelayTime'] }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flights['FlightList'][$key]['DelayRemarks'] }}
                                            <input type="hidden" name="Comentarios[]" value="{{ $flights['FlightList'][$key]['DelayRemarks'] }}" />
                                        </td>
                                    </tr>
                                @endif
                            @endif
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
