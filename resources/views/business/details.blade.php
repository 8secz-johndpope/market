<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row all-divs">
        <div class="col-sm-12">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp; Messages</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;My Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp;Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp;Metrics</a>
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
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2 class="bold-text">{{$user->name}}</h2>
                    <div class="row">
                        <div class="col-sm-4">
                        <div class="gray-color">
                          <strong>Login email:</strong>
                        </div>
                            <div class="detail-text">
                                {{$user->email}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="gray-color">
                                <strong>Password:</strong>
                            </div>
                            <div class="detail-text">
                                <p>*************</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        <a><span class="glyphicon glyphicon-edit"></span>Edit </a>
                        </div>
                    </div>
                    <h2 class="bold-text">Contact Details</h2>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="gray-color">
                                <strong>Contact number:</strong>
                            </div>
                            <div class="detail-text">
                                {{$user->phone}}
                            </div>
                            <div class="gray-color">
                                <strong>Display name:</strong>
                            </div>
                            <div class="detail-text">
                                {{$user->display_name}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="gray-color">
                                <strong>Primary Email:</strong>
                            </div>
                            <div class="detail-text">
                                {{$user->email}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <a><span class="glyphicon glyphicon-edit"></span>Edit </a>
                        </div>
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
                                <span class="glyphicon glyphicon-piggy-bank"></span>
                            <p class="bank-name">{{$account->bank_name}}</p>
                                <div class="last-4">
                                    X- {{$account->last4}}
                                </div>
                            </div>

                        @endforeach
                        <div class="card-div add-card-div">
                            <a class="add-bank-link"><div class="center-add-card">
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
                <input class="form-control" name="sortcode" placeholder="208534">
            </div>
            <div class="form-group">
                <label for="expiry">Account Number:</label>
                <input class="form-control" name="number" placeholder="12345678">
            </div>

            <button type="submit" class="btn btn-success">Save </button>
        </form>
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
    $(".add-bank-link").click(function () {
        $(".all-divs").hide();
        $(".add-account-form").show();
    });
    $(".cross-mark-add-bank ").click(function () {
        $(".all-divs").show();
        $(".add-account-form").hide();
    });
</script>
@endsection