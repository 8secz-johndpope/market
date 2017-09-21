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
                    <a class="nav-link " href="/business/manage/ads">Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/details">My Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/business/manage/company">Company</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/metrics">Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/support">Support</a>
                </li>
            </ul>

        </div>
    </div>

    <h4>Payment Schedule</h4>
    <table class="table">
        <tr><th>Reference</th><th>Payment Date</th><th>Amount</th></tr>
        @foreach($user->contract->payments as $payment)
            <tr><td>{{$payment->reference}}</td><td>{{$payment->nice_date()}}</td><td> £{{$payment->nice_amount()}}</td></tr>
        @endforeach
    </table>
@endsection