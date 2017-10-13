<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>&nbspManage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;My Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/company">Company</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#">Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/metrics">Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support">Support</a>
                </li>
            </ul>
            <h4>Payment Schedule</h4>
            <table class="table">
                <tr><th>Reference</th><th>Payment Date</th><th>Amount</th><th></th></tr>
                @foreach($user->contract->payments as $payment)
                    <tr><td>{{$payment->reference}}</td><td>{{$payment->nice_date()}}</td><td> £{{$payment->nice_amount()}}</td><td>@if($payment->status==='done') <span class="green-text">Paid</span> @else<a href="/business/invoice/pay/{{$payment->id}}">Pay Now</a>@endif</td></tr>
                @endforeach
            </table>
        </div>
    </div>


@endsection