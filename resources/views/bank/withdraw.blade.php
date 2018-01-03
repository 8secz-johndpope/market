<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.bank')

@section('title', 'Page Title')

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
            <form method="post" action="/wallet/send/money">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="amount" placeholder="95 (£50 minimum)">
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Bank Account</label>
                    <select name="account" class="form-control" id="exampleFormControlSelect1">
                        @foreach($accounts as $account)
                            <option value="{{$account->id}}">{{$account->bank_name}}- {{$account->last4}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary" value="Withdraw">
                    </div>
                    <div class="col">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection