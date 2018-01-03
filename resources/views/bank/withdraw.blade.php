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

                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
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