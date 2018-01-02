<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.bank')

@section('title', 'Dashboard')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <br><br><br>
            <h4 style="text-align: center">Your Balance: £{{$user->balance()}}</h4>
            <br><br><br>
            <div style="margin: auto;    width: 400px;">
                <a class="btn btn-primary">Send Money</a>
                <a class="btn btn-secondary">Receive Money</a>
                <a class="btn btn-success">Withdraw</a>

            </div>
            <br><br><br>
            <h4>Transactions</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->transactions as $transaction)
                <tr>
                    <td><img src="@if($transaction->direction===1) /css/left.png @else /css/right.png @endif" style="width: 30px"> </td>
                    <td>{{$transaction->description}}</td>
                    <td>£{{number_format($transaction->amount/100,2)}}</td>
                    <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                </tr>
                @endforeach
                <tr>
                    <td><img src="/css/left.png" style="width: 30px"> </td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <td><img src="/css/right.png" style="width: 30px"> </td>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


@endsection