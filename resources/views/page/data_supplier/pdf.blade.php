<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
</head>
<body>
    <h2 align="center">DATA SUPPLIER</h2>
    <hr>
    <table style="width: 100%" cellpadding="6">
        <tbody>
            @foreach ($supplier as $item => $value)
            <tr>
                <th style="width: 30%;text-align:left">Nama</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->nama}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">No Telp</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->no_telp}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Email</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->email}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Fax</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->fax}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">UP</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->up}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Alamat</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->alamat}}</th>
            </tr>
            @endforeach
    </tbody>
    </table>
</body>
</html>