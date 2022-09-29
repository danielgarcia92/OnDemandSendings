<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('ASA') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <button type="button" wire:click="openDiv" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center hover:bg-blue-200 focus:text-blue-700 focus:bg-blue-200 focus:outline-none focus:ring-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hand-click" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#5BAD34" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 13v-8.5a1.5 1.5 0 0 1 3 0v7.5" />
                    <path d="M11 11.5v-2a1.5 1.5 0 0 1 3 0v2.5" />
                    <path d="M14 10.5a1.5 1.5 0 0 1 3 0v1.5" />
                    <path d="M17 11.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7l-.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47" />
                    <path d="M5 3l-1 -1" />
                    <path d="M4 7h-1" />
                    <path d="M14 3l1 -1" />
                    <path d="M15 6h1" />
                </svg>
                <span style="color: #5BAD34"> Día Actual / Día Siguiente </span>
            </button>
            @if ($showDiv)
                <div>
                    <form method="POST" onSubmit="if(!confirm('¿Realmente desea enviar la asignación del día siguiente?')){return false;}" action="{{ url("ASA/SendEmail") }}" validate>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="overflow-x-auto relative">
                            @php date_default_timezone_set('America/Monterrey'); @endphp
                            <h1 class="text-center py-4 font-semibold text-2xl text-gray-800 leading-tight"> Asignación de vuelos de MEX para ASA {{ date("d-m-Y", strtotime("+1 day")) }}</h1>
                            <input type="hidden" name="date" value="{{ date("d-m-Y", strtotime("+1 day")) }}" />
                            <table class="w-full py-12 text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Matrícula
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Llegada
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Origen
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        STA
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Salida
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
                                @foreach ($flights2 as $key => $flight)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            {{ $key + 1 }}
                                            <input type="hidden" name="KEY[]" value="{{ $key + 1 }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->REG }}
                                            <input type="hidden" name="REG[]" value="{{ $flight->REG }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->Llegada }}
                                            <input type="hidden" name="Llegada[]" value="{{ $flight->Llegada }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->Origen }}
                                            <input type="hidden" name="Origen[]" value="{{ $flight->Origen }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($flight->STA)
                                                {{ $flight->STA }}
                                                <input type="hidden" name="STA[]" value="{{ $flight->STA }}" />
                                            @else
                                                {{ 'HGR' }}
                                                <input type="hidden" name="STA[]" value="{{ 'HGR' }}" />
                                            @endif

                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->FLT }}
                                            <input type="hidden" name="FLT[]" value="{{ $flight->FLT }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->ARR }}
                                            <input type="hidden" name="ARR[]" value="{{ $flight->ARR }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->STD }}
                                            <input type="hidden" name="STD[]" value="{{ $flight->STD }}" />
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($flightsHGR2 as $keyHGR => $flightHGR)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            {{ $keyHGR + $key + 2 }}
                                            <input type="hidden" name="KEY[]" value="{{ $keyHGR + $key + 2 }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->REG }}
                                            <input type="hidden" name="REG[]" value="{{ $flightHGR->REG }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->Llegada }}
                                            <input type="hidden" name="Llegada[]" value="{{ $flightHGR->Llegada }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->Origen }}
                                            <input type="hidden" name="Origen[]" value="{{ $flightHGR->Origen }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->STA }}
                                            <input type="hidden" name="STA[]" value="{{ $flightHGR->STA }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->FLT }}
                                            <input type="hidden" name="FLT[]" value="{{ $flightHGR->FLT }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->ARR }}
                                            <input type="hidden" name="ARR[]" value="{{ $flightHGR->ARR }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->STD }}
                                            <input type="hidden" name="STD[]" value="{{ $flightHGR->STD }}" />
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
                                        <span style="color: #5BAD34">  Enviar Asignación</span>
                                    </button>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            @else
                <div>
                    <form method="POST" onSubmit="if(!confirm('¿Realmente desea enviar la asignación del día actual?')){return false;}" action="{{ url("ASA/SendEmail") }}" validate>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="overflow-x-auto relative">
                            @php date_default_timezone_set('America/Monterrey'); @endphp
                            <h1 class="text-center py-4 font-semibold text-2xl text-gray-800 leading-tight"> Asignación de vuelos de MEX para ASA {{ date("d-m-Y") }}</h1>
                            <input type="hidden" name="date" value="{{ date("d-m-Y") }}" />
                            <table class="w-full py-12 text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Matrícula
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Llegada
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Origen
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        STA
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Salida
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
                                @foreach ($flights1 as $key => $flight)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            {{ $key + 1 }}
                                            <input type="hidden" name="KEY[]" value="{{ $key + 1 }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->REG }}
                                            <input type="hidden" name="REG[]" value="{{ $flight->REG }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->Llegada }}
                                            <input type="hidden" name="Llegada[]" value="{{ $flight->Llegada }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->Origen }}
                                            <input type="hidden" name="Origen[]" value="{{ $flight->Origen }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($flight->STA)
                                                {{ $flight->STA }}
                                                <input type="hidden" name="STA[]" value="{{ $flight->STA }}" />
                                            @else
                                                {{ 'HGR' }}
                                                <input type="hidden" name="STA[]" value="{{ 'HGR' }}" />
                                            @endif

                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->FLT }}
                                            <input type="hidden" name="FLT[]" value="{{ $flight->FLT }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->ARR }}
                                            <input type="hidden" name="ARR[]" value="{{ $flight->ARR }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flight->STD }}
                                            <input type="hidden" name="STD[]" value="{{ $flight->STD }}" />
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($flightsHGR1 as $keyHGR => $flightHGR)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            {{ $keyHGR + $key + 2 }}
                                            <input type="hidden" name="KEY[]" value="{{ $keyHGR + $key + 2 }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->REG }}
                                            <input type="hidden" name="REG[]" value="{{ $flightHGR->REG }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->Llegada }}
                                            <input type="hidden" name="Llegada[]" value="{{ $flightHGR->Llegada }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->Origen }}
                                            <input type="hidden" name="Origen[]" value="{{ $flightHGR->Origen }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->STA }}
                                            <input type="hidden" name="STA[]" value="{{ $flightHGR->STA }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->FLT }}
                                            <input type="hidden" name="FLT[]" value="{{ $flightHGR->FLT }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->ARR }}
                                            <input type="hidden" name="ARR[]" value="{{ $flightHGR->ARR }}" />
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $flightHGR->STD }}
                                            <input type="hidden" name="STD[]" value="{{ $flightHGR->STD }}" />
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
                                        <span style="color: #5BAD34">  Enviar Asignación</span>
                                    </button>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
