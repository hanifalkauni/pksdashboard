<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Export Member Data</title>
    </head>
    <body>
    <table>
            <thead>
                <tr>
                    <th><b>No</b></th>
                    <th><b>NIK</b></th>
                    <th><b>Name</b></th>
                    <th><b>Gender</b></th>
                    <th><b>Birthday</b></th>
                    <th><b>Address</b></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
            @php $no=1;@endphp
            <tr>
                <td>{{$no++}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->name}}</td>
                <td>
                    @if ($item->gender == "L")
                        Laki-Laki
                    @else
                        Perempuan
                    @endif  
                </td>
                <td>{{$item->birthday}}</td>
                <td>{{$item->address}}</td>
            </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>