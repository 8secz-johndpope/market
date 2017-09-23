<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sumra') }}</title>


    <style>
        .page-break {
            page-break-after: always;
        }
        .customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .customers td, .customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .customers tr:nth-child(even){background-color: #f2f2f2;}

        .customers tr:hover {background-color: #ddd;}

        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        body{
            font-size: 0.8em;
        }
        .header-brand,.footer-brand{
            width: 100%;
        }
        .header-brand{
            margin-top: -50px;
        }

    </style>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <img src="https://sumra.net/css/brand.png" style="width: 100%">

        <table class="customers" >
            <tr><td>Name </td><td>{{$user->name}}</td></tr>
            <tr><td>Company</td><td>{{$user->business->name}}</td></tr>
            <tr><td>Email</td><td>{{$user->email}}</td></tr>
            <tr><td>Phone</td><td>{{$user->business->phone}}</td></tr>
            <tr><td>Billing Address</td><td>{{$user->business->address->line1}}</td></tr>
        </table>
        <table class="customers">
            <tr><th>Title</th><th>Category</th><th>Location</th></tr>
            @foreach($payment->contract->packs as $pack)
                <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td></tr>
            @endforeach
            <tr><td><span class="bold-text">VAT @ 20%</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$payment->vat()}}</span></td></tr>
            <tr><td><span class="bold-text">Total</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$payment->before_vat()}}</span></td></tr>
        </table>
    </div>
</div>
</body>
</html>