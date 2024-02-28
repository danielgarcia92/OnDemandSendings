<!DOCTYPE html>
<html>
    <head>
        <title>Correo FW</title>
        <style>
            #customers { font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%; }
            #customers td, #customers th { border: 1px solid #ddd; padding: 8px; }
            #customers tr:nth-child(even){ background-color: #f2f2f2; }
            #customers tr:hover { background-color: #f2f2f2; color: #000; }
            #customers th { padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #04AA6D; color: white; }
        </style>
    </head>
    <body>
        @php date_default_timezone_set('America/Monterrey'); @endphp
        <h1>FWD Diario {{ date("d/m/Y") }}</h1>

        <div class="overflow-x-auto relative">
            <table id='customers'>
                <tr>
                    <th> {{ $data['FW'] }} Vuelos </th>
                    <th> {{ $data['FWD'] }} Vuelos Demorados </th>
                    <th> FWD 0  <br> {{ round(100 - $data['FWD']*100/$data['FW'], 2) }}% </th>
                    <th> FWD 15 <br> {{ round(100 - $data['FWD15']*100/$data['FW'], 2) }}% </th>
                </tr>
            </table>
        </div>
        <br>
        <div class="py-4 overflow-x-auto relative">
            <table id='customers'>
                <tr>
                    <th> Base </th>
                    <th> Vuelos Totales </th>
                    <th> Vuelos Demorados </th>
                    <th> %FWD 0 </th>
                    <th> %FWD 15 </th>
                </tr>
                <tr>
                    <td> BJX </td>
                    <td> {{ $data['BJX'] }} </td>
                    <td> {{ $data['BJXD'] }} </td>
                    @if($data['BJX'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['BJXD']*100/$data['BJX'], 2) }}% </td>
                        <td> {{ round(100 - $data['BJXD15']*100/$data['BJX'], 2) }}% </td>
                    @endif
                </tr>
                <tr>
                    <td> CUN </td>
                    <td> {{ $data['CUN'] }} </td>
                    <td> {{ $data['CUND'] }} </td>
                    @if($data['CUN'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['CUND']*100/$data['CUN'], 2) }}% </td>
                        <td> {{ round(100 - $data['CUND15']*100/$data['CUN'], 2) }}% </td>
                    @endif
                </tr>
                <tr>
                    <td> GDL </td>
                    <td> {{ $data['GDL'] }} </td>
                    <td> {{ $data['GDLD'] }} </td>
                    @if($data['GDL'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['GDLD']*100/$data['GDL'], 2) }}% </td>
                        <td> {{ round(100 - $data['GDLD15']*100/$data['GDL'], 2) }}% </td>
                    @endif
                </tr>
                <tr>
                    <td> MEX </td>
                    <td> {{ $data['MEX'] }} </td>
                    <td> {{ $data['MEXD'] }} </td>
                    @if($data['MEX'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['MEXD']*100/$data['MEX'], 2) }}% </td>
                        <td> {{ round(100 - $data['MEXD15']*100/$data['MEX'], 2) }}% </td>
                    @endif
                </tr>
                <tr>
                    <td> MID </td>
                    <td> {{ $data['MID'] }} </td>
                    <td> {{ $data['MIDD'] }} </td>
                    @if($data['MID'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['MIDD']*100/$data['MID'], 2) }}% </td>
                        <td> {{ round(100 - $data['MIDD15']*100/$data['MID'], 2) }}% </td>
                    @endif
                </tr>
                <tr>
                    <td> MTY </td>
                    <td> {{ $data['MTY'] }} </td>
                    <td> {{ $data['MTYD'] }} </td>
                    @if($data['MTY'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['MTYD']*100/$data['MTY'], 2) }}% </td>
                        <td> {{ round(100 - $data['MTYD15']*100/$data['MTY'], 2) }}% </td>
                    @endif
                </tr>
                <tr>
                    <td> TIJ </td>
                    <td> {{ $data['TIJ'] }} </td>
                    <td> {{ $data['TIJD'] }} </td>
                    @if($data['TIJ'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['TIJD']*100/$data['TIJ'], 2) }}% </td>
                        <td> {{ round(100 - $data['TIJD15']*100/$data['TIJ'], 2) }}% </td>
                    @endif
                </tr>
                <tr>
                    <td> TLC </td>
                    <td> {{ $data['TLC'] }} </td>
                    <td> {{ $data['TLCD'] }} </td>
                    @if($data['TLC'] == 0)
                        <td>{{ 100 }}%</td>
                        <td>{{ 100 }}%</td>
                    @else
                        <td> {{ round(100 - $data['TLCD']*100/$data['TLC'], 2) }}% </td>
                        <td> {{ round(100 - $data['TLCD15']*100/$data['TLC'], 2) }}%</td>
                    @endif
                    <td> </td>
                    <td>  </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="py-4 overflow-x-auto relative">
            <table id='customers'>
                <tr>
                    <th>Estación</th>
                    <th>Vuelo</th>
                    <th>Código</th>
                    <th>Minutos</th>
                    <th>Matrícula</th>
                    <th>Comentarios</th>
                </tr>
                @foreach($data['DEP'] as $key => $d)
                    <tr>
                        <td> {{ $data['DEP'][$key] }} </td>
                        <td> {{ $data['FLT'][$key] }} </td>
                        <td> {{ $data['COD'][$key] }} </td>
                        <td> {{ $data['MIN'][$key] }} </td>
                        <td> {{ $data['REG'][$key] }} </td>
                        <td> {{ $data['Comentarios'][$key] }} </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
