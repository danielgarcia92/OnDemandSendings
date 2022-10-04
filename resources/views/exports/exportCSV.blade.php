<table id='customers'>
    <tr>
        <th> Matricula </th>
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
