<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Invoice')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('styles')
<link href="{{ asset('/css/pay-invoice.css?q=874') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="body">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="invoice-container clearfix">
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
                                    <h2 class="seller-name">{{$seller->name}}</h2>
                                </div>
                                <div>
                                    {{$seller->address->line1}}
                                </div>
                                <div>
                                    {{$seller->address->city}} {{$seller->address->postcode}}
                                </div>
                                <div>
                                    United Kingdom
                                </div>
                                <div>
                                    {{$seller->phone}}
                                </div>
                                <div>
                                    {{$seller->email}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="invoice-details">
                                <ul>
                                    <li>
                                        <div class="details-l">
                                            <strong>Invoice number</strong>
                                        </div>
                                        <div class="details-r">{{$invoice->id}}</div>
                                    </li>
                                    <li>
                                        <div class="details-l">
                                            <strong>Invoice date</strong>
                                        </div>
                                        <div class="details-r">{{$invoice->created_at}}</div>
                                    </li>
                                    <li>
                                        <div class="details-l">
                                            <strong>Payment terms</strong>
                                        </div>
                                        <div class="details-r">Due on receipt</div>
                                    </li>
                                    <li>
                                        <div class="details-l">
                                            <strong>Due date</strong>
                                        </div>
                                        <div class="details-r">{{$invoice->created_at}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h2>Sent to</h2>
                            <div class="buyer-info">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <table class="items table-bordered">
                                <thead><th>Description</th><th class="cell-amount">Amount</th></thead>
                                <tbody>
                                @foreach($invoice->items as $item)
                                    <tr><td>{{$item->title}}</td><td class="cell-amount">{{$item->amount/100}}</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="total">
                                <table class="w100p amount_total">
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-right">£{{$invoice->amount()}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-right"></td>
                                        </tr>
                                        <tr class="row-total">
                                            <td>Total</td>
                                            <td class="text-right">£{{$invoice->amount()}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pay-container">
                            <form>
                                <button class="btn btn-submit">Pay Now</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                            <thead><th>Description</th><th>Amount</th></thead>
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