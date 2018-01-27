<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row all-divs">
            <div class="col-sm-12">
                <div class="row" style="margin-bottom: 30px">
                    <div class="col-md-6 col-md-offset-3">
                        @if(count($accounts)===0)
                            <h4>Add Bank Account</h4>
                            <a class="btn btn-primary add-bank-link-btn" >Add Bank Account</a>
                        @endif
                        <div class="balances">
                            <h4>Balances</h4>
                            <table class="table">
                                @foreach($balance['available'] as $item)
                                    <tr><td>Available</td><td><strong>{{number_format($item['amount']/100,2)}}  &nbsp;<span class="currency">{{$item['currency']}}</span></strong> </td></tr>
                                @endforeach
                                    @foreach($balance['pending'] as $item)
                                        <tr><td>Pending</td><td><strong>{{number_format($item['amount']/100,2)}}&nbsp; <span class="currency">{{$item['currency']}}</span> </strong></td></tr>
                                    @endforeach

                            </table>
                            @if($account->legal_entity->verification->status==='verified')

                            <h4>Withdraw</h4>
                            <form class="form-inline" method="post" action="/user/money/withdraw">
                                {{ csrf_field() }}
                                <label class="sr-only" for="inlineFormInputName2">Amount</label>
                                <input type="number" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInputName2" name="amount" required placeholder="100.00" >

                                <label class="sr-only" for="inlineFormInputGroupUsername2">Bank Account</label>
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <select name="account" class="form-control">
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->bank_name}}- {{$account->last4}}</option>
                                    @endforeach
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                                @endif
                        </div>
                        <div class="credit-debit-cards">
                            <h4 class="bold-text">Credit and Debit Cards</h4>
                            @foreach($cards as $card)
                            <div class="card-div">
                                <div class="last-4">
                                    X- {{$card->last4}}
                                </div>
                                <div class="card-logo">
                                    @if($card->brand==='Visa')
                                        <img src="/css/visa-logo.png">
                                        @elseif($card->brand==='American Express')
                                        <img src="/css/amex.png">
                                        @else
                                        <img src="/css/mastercard.png">
                                    @endif
                                </div>
                            </div>
                                @endforeach
                            <div class="card-div add-card-div">
                                <a class="card-div-link"><div class="center-add-card">
                                        <p>+</p>
                                        <p>Add Card</p>
                                    </div> </a>
                            </div>

                        </div>
                        <div class="bank-accounts">
                            <h4 class="bold-text">Bank Accounts</h4>
                            @foreach($accounts as $account)
                                <div class="bank-div">
                                    <span class="glyphicon glyphicon-gbp"></span>
                                <p class="bank-name">{{$account->bank_name}}</p>
                                    <div class="last-4">
                                        X- {{$account->last4}}
                                    </div>
                                </div>

                            @endforeach
                            <div class="card-div add-card-div">
                                <a class="add-bank-link add-bank-link-btn"><div class="center-add-card">
                                        <p>+</p>
                                        <p>Add Bank Account</p>
                                    </div> </a>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="add-card-form" style="display: none">
            <div class="cross-mark-add-card">
                X
            </div>
            <form action="/user/cards/add" method="post">
                <input name="redirect" type="hidden" value="/user/manage/details">
                {{ csrf_field() }}
                <div class="form-group" style="margin-top: 25px">
                    <label for="card">Card Number:</label>
                    <input class="form-control" name="card" placeholder="Card number">
                </div>
                <div class="form-group">
                    <label for="expiry">Expiry date:</label>
                    <input class="form-control" name="expiry" placeholder="Expiry MM/YYYY">
                </div>
                <div class="form-group">
                    <label for="cvc">CVC:</label>
                    <input class="form-control" name="cvc" placeholder="cvc (3 digits)">
                </div>
                <div class="form-group">
                    <label for="address">Billing Address:</label>
                    <select class="form-control" name="address">
                        @foreach($user->addresses as $address)
                            <option value="{{$address->id}}">{{$address->line1}}, {{$address->city}}, {{$address->postcode}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Save </button>
            </form>
        </div>
        <div class="add-account-form" style="display: none">
            <div class="cross-mark-add-bank">
                X
            </div>
            <form action="/user/accounts/add" method="post">
                <input name="redirect" type="hidden" value="/user/manage/details">

                {{ csrf_field() }}
                <div class="form-group" style="margin-top: 25px">
                    <label for="card">Sort Code:</label>
                    <input class="form-control" name="sortcode" placeholder="108800">
                </div>
                <div class="form-group">
                    <label for="expiry">Account Number:</label>
                    <input class="form-control" name="number" placeholder="00012345">
                </div>

                <button type="submit" class="btn btn-success">Save </button>
            </form>
        </div>
    </div>
</div>

<script>
    $(".card-div-link").click(function () {
        $(".all-divs").hide();
       $(".add-card-form").show();
    });
    $(".cross-mark-add-card ").click(function () {
        $(".all-divs").show();
        $(".add-card-form").hide();
    });
    $(".add-bank-link-btn").click(function () {
        $(".all-divs").hide();
        $(".add-account-form").show();
    });
    $(".cross-mark-add-bank ").click(function () {
        $(".all-divs").show();
        $(".add-account-form").hide();
    });
    $('.add-address-link').click(function () {
        $(".all-divs").hide();
        $(".add-address-form").show();
    });
    $(".cross-mark-add-address ").click(function () {
        $(".all-divs").show();
        $(".add-address-form").hide();
    });
</script>
@endsection