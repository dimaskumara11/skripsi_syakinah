<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
</head>
<body>
    <h2 align="center">DATA HUTANG SUPPLIER</h2>
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
                <th style="width: 30%;text-align:left">No Invoice</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->no_invoice}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Tgl Invoice</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->tgl_invoice}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Tgl Terima Invoice</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->tgl_terima_invoice}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Jatuh Tempo</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->jatuh_tempo}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Total Tagihan</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{number_format($value->total_tagihan,0)}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Status Pembayaran</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$value->status_pembayaran==0?"Cicil":"Lunas"}}</th>
            </tr>
            @endforeach
    </tbody>
    </table>
</body>
</html>