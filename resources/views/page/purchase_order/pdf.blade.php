<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
</head>
<body>
    <h2 align="center">PURCHASE ORDER</h2>
    <hr>
    <table style="width: 100%" cellpadding="6">
        <tbody>
            <tr>
                <th style="width: 30%;text-align:left">No Purchase Order</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$purchase->no_purchase_order}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">Tanggal PO</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$purchase->tanggal_purchase_order}}</th>
            </tr>
            <tr>
                <th style="width: 30%;text-align:left">No Request Order</th>
                <th style="width: 5%;text-align:left">:</th>
                <th style="width: 65%;text-align:left">{{$purchase->no_request_order}}</th>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%" cellpadding="6" border="1" cellspacing="0">
        <tbody>
            <tr>
                <th style="width: 10%;text-align:left">No.</th>
                <th style="width: 45%;text-align:left">Description</th>
                <th style="width: 15%;text-align:left">Qty</th>
                <th style="width: 15%;text-align:left">Unit Price</th>
                <th style="width: 15%;text-align:left">Amount</th>
            </tr>
            @foreach ($purchase_product as $item => $value)
            <tr>
                <td>{{$item+1}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->qty}}</td>
                <td>{{number_format($value->unit_price,0)}}</td>
                <td>{{number_format($value->amount,0)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>