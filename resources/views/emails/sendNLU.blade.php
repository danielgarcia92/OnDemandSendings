<!DOCTYPE html>
<html>
    <head>
        <title>Asignación NLU</title>
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
        <h1>Asignación de vuelos NLU {{ $data['date'] }}</h1>
        <h4>Este es un correo de prueba del nuevo sitio de envío de las asignaciones a demanda, favor de hacer caso omiso</h4>

        <div class="py-4 overflow-x-auto relative">
            <table id='customers'>
                <tr>
                    <th> Matrícula </th>
                    <th> Llegada </th>
                    <th> Origen </th>
                    <th> STA </th>
                    <th> Salida </th>
                    <th> Destino </th>
                    <th> STD </th>
                </tr>
                @foreach($data['KEY'] as $key => $d)
                    <tr>
                        <td> {{ $data['REG'][$key] }}</td>
                        <td> {{ $data['Llegada'][$key] }} </td>
                        <td> {{ $data['Origen'][$key] }} </td>
                        <td> {{ $data['STA'][$key] }} </td>
                        <td> {{ $data['FLT'][$key] }} </td>
                        <td> {{ $data['ARR'][$key] }} </td>
                        <td> {{ $data['STD'][$key] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
