<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp; Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;My Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Company</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-gbp"></span>&nbsp; &nbsp;Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span>&nbsp; &nbsp;Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/favorites"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span> &nbsp;&nbsp; Search Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support"><span class="glyphicon glyphicon-earphone"></span> &nbsp;&nbsp;Support</a>
                </li>
            </ul>
            <h4>Invoices</h4>
            <table class="table">
                <tr><th>Title</th><th>Amount</th><th>Status</th></tr>
                @foreach($user->invoices as $invoice)
                    <tr><td>{{$invoice->title}}</td><td>{{$invoice->amount()}}</td><td>@if($invoice->status===1) <span class="green-text">Paid</span> @elseif(strtotime($invoice->due_date)<time()) <span class="red-text">Unpaid</span> @else <span class="yellow-text">Pending</span> @endif</td></tr>
                @endforeach
            </table>
        </div>
    </div>


@endsection