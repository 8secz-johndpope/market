<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Invoice')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body">
    <div class="container">
        <div class="row">
            <div class="invoice-container">
                <div class="col-sm-12">
                    <div class="logo-container">
                        <div class="logo-img">
                            <img src="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="seller-info">
                        <div>
                            <h2 class="seller-name">{{$user->name}}</h2>
                        </div>
                        <div>
                            {{$user->address->line1}}
                        </div>
                        <div>
                            {{$user->address->city}} {{$user->address->postcode}}
                        </div>
                        <div>
                            United Kingdom
                        </div>
                        <div>
                            {{$user->phone}}
                        </div>
                        <div>
                            {{$user->email}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6"></div>
                <div class="col-sm-12"></div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
    <div class="row all-divs" style="display: none;">
        <div class="col-sm-8 col-sm-offset-2">
            <form action="/user/payment/invoice/stripe/{{$invoice->id}}" method="post">

            <div class="row">
                <div class="col-sm-8">
                    <h4>{{$invoice->title}}</h4>

                        <table class="table">
                            <thead><th>Title</th><th>Amount</th></thead>
                            @foreach($invoice->items as $item)
                                <tr><td>{{$item->title}}</td><td>{{$item->amount/100}}</td></tr>
                            @endforeach
                        </table>

                    <div>
                        @foreach($user->addresses as $address)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="billing_address" id="exampleRadios1" value="{{$address->id}}" @if($user->default_address===$address->id) checked @endif required>
                                    {{$address->line1}},{{$address->city}},{{$address->postcode}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-sm-4">
                    <table class="table">

                            <tr><td colspan="2"><p>Amount to pay</p></td> </tr>
                       <tr><td>Total:</td><td><span class="bold-text">£{{$invoice->amount()}}</span></td></tr>
                    </table>
                    <div class="display-cards" @if(count($cards)===0) style="display: none" @endif>
                    <h4>Pay by Card</h4>
                        {{ csrf_field() }}
                    <ul class="list-group" >
                        @foreach($cards as $card)
                            <li class="list-group-item">
                                <div class="radio">
                                    <label><input type="radio" name="card" value="{{$card['id']}}" required @if($card['id']===$def['id']) checked @endif>{{$card['brand']}}--{{$card['last4']}}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                        <button type="submit" class="btn btn-primary">Make Payment</button>


                    </div>
                    <a class="btn btn-default add-card">Add New Card</a>

                    <p>Or</p>

                        <div id="paypal-container"></div>


                    <script type="text/javascript">
                        braintree.setup('{{$token}}', 'custom', {
                            paypal: {
                                container: 'paypal-container',
                                singleUse: true, // Required
                                amount: {{$invoice->amount()}}, // Required
                                currency: 'GBP', // Required
                            },
                            onPaymentMethodReceived: function (obj) {
                              //  doSomethingWithTheNonce(obj.nonce);
                                document.location.href = '/user/payment/invoice/paypal/{{$invoice->id}}?nonce='+obj.nonce

                            }
                        });
                    </script>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="add-card-form" style="display: none">
        <div class="cross-mark-add-card">
            X
        </div>
        <form action="/user/cards/add" method="post">
            <input name="redirect" type="hidden" value="/pay/invoice/{{$invoice->id}}">
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
</div>
<script>
    $(".add-card").click(function () {
        $(".all-divs").hide();
        $(".add-card-form").show();
    });
    $(".cross-mark-add-card ").click(function () {
        $(".all-divs").show();
        $(".add-card-form").hide();
    });
</script>
@endsection