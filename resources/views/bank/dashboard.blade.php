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
            <h4 style="text-align: center">Your Balance: £{{number_format($user->balance()/100,2)}}</h4>
            <br>
            <p style="text-align: center"><strong>Need some cash? Your referral code is <span style="color: green;font-weight: bolder;">{{$user->referral_code}}</span> Share with your friends, you get £3 for each friend you introduce </strong></p>
            <br>
            <div style="margin: auto;    width: 400px;">
                <a href="/wallet/send" class="btn btn-primary">Send Money</a>
                <a href="/wallet/request" class="btn btn-secondary">Receive Money</a>
                <a href="/wallet/withdraw" class="btn btn-success">Withdraw</a>

            </div>
            <br><br>
            <h4>Requests</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->money_requests as $money_request)
                    <tr>
                        @if($money_request->user_id===$user->id)
                        <td>Money Request for {{$money_request->other->name}}</td>
                        <td>£{{number_format($money_request->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($money_request->created_at))}}</td>
                            <td>
                                @if($money_request->status===0)
                                    <button type="button" class="btn btn-outline-warning">Pending</button>
                            @else
                                    <button type="button" class="btn btn-outline-success">Complete</button>
                                @endif
                            </td>
                            @else
                            <td>Money Request from {{$money_request->user->name}}</td>
                            <td>£{{number_format($money_request->amount/100,2)}}</td>
                            <td>{{date('d/m/Y',strtotime($money_request->created_at))}}</td>
                            <td>
                                @if($money_request->status===0)
                                <a href="/wallet/pay/request/{{$money_request->id}}" class="btn btn-primary">Pay Now</a>
                                @else
                                    <button type="button" class="btn btn-outline-success">Paid</button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                </tbody>
            </table>
        </div>
    </div>


@endsection