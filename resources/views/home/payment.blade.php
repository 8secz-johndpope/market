<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body">
    <div class="row all-divs">
        <div class="col-sm-8 col-sm-offset-2">

            <div class="row">
                <div class="col-sm-8">
                    <h4>Your Order</h4>
                    @if($order->type==='bump')
                    <table class="table">
                        <tr><th>Ad</th><th>Ad ID</th><th>Item</th><th>Price</th></tr>
                        @foreach($order->items as $item)
                        <tr><td><h4>{{$item->advert->param('title')}}</h4></td><td>{{$item->advert->id}}</td><td>{{$item->type->stitle}}</td><td>@if($item->price()===0) Included in Package @else£{{$item->price()}}@endif</td></tr>
                            @endforeach
                        <tr><td><span class="bold-text">Total:</span></td><td><td></td><td><span class="bold-text">£{{$order->amount()}}</span></td></tr>
                    </table>
                    @elseif($order->type==='contract')
                        <table class="table">
                            <thead><th>Title</th><th>Category</th><th>Location</th><th>Quantity</th><th>Price</th></thead>
                            @foreach($order->contract->packs as $pack)
                                <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td><td>{{$order->contract->count}}</td><td>£{{$pack->amount/100}}</td></tr>
                            @endforeach
                            <tr><td><span class="bold-text">Subtotal</span></td><td></td><td></td><td><span class="bold-text">{{count($order->contract->packs)*$order->contract->count}}</span></td><td><span class="bold-text"> £{{$order->contract->total_before_discount()}}</span></td></tr>
                            <tr><td><span class="bold-text">Discount</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$order->contract->total_discount()}}</span></td></tr>
                            <tr><td><span class="bold-text">Subtotal after Discount</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$order->contract->total_after_discount()}}</span></td></tr>
                            <tr><td><span class="bold-text">VAT @ 20%</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$order->contract->total_vat()}}</span></td></tr>
                            <tr><td><span class="bold-text">Total</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$order->contract->total_after_vat()}}</span></td></tr>
                        </table>
                        <h4>Payment Schedule</h4>
                        <table class="table">
                            <tr><th>Payment Date</th><th>Amount</th></tr>
                            @foreach($order->contract->future_payments() as $payment)
                                <tr><td>{{$payment->nice_date()}}</td><td> £{{$payment->nice_amount()}}</td></tr>
                            @endforeach
                        </table>
                    @elseif($order->type==='invoice')
                        <table class="table">
                            <thead><th>Title</th><th>Category</th><th>Location</th></thead>
                            @foreach($order->invoice->contract->packs as $pack)
                                <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td></tr>
                            @endforeach
                        </table>
                    @endif

                </div>
                <div class="col-sm-4">
                    <table class="table">
                    @if($order->type==='contract')
                    <tr><td colspan="2"><p>Amount you will be paying now to secure the contract</p></td> </tr>
                        @if($user->contract!==null)
                     <tr><td>Settlement Fees: </td><td><span class="bold-text">£{{$user->contract->settlement_amount()/100}}</span></td></tr>
                                <tr><td>Deposit: </td><td><span class="bold-text">£{{$order->contract->deposit()}}</span></td></tr>
                            @endif
                    @elseif($order->type==='invoice')
                            <tr><td colspan="2"><p>Amount to pay</p></td> </tr>
                    @endif
                       <tr><td>Total:</td><td><span class="bold-text">£{{$order->amount()}}</span></td></tr>
                    </table>
                    <div class="display-cards" @if(count($cards)===0) style="display: none" @endif>
                    <h4>Pay by Card</h4>
                    <form action="/user/payment/stripe" method="post">
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

                    </form>
                    </div>
                    <button class="btn btn-default add-card">Add New Card</button>

                    <p>Or</p>

                        <div id="paypal-container"></div>


                    <script type="text/javascript">
                        braintree.setup('{{$token}}', 'custom', {
                            paypal: {
                                container: 'paypal-container',
                                singleUse: true, // Required
                                amount: {{$order->amount()}}, // Required
                                currency: 'GBP', // Required
                            },
                            onPaymentMethodReceived: function (obj) {
                              //  doSomethingWithTheNonce(obj.nonce);
                                document.location.href = '/user/payment/paypal?nonce='+obj.nonce

                            }
                        });
                    </script>

                    <script>
                        var stripe = Stripe('{{env('STRIPE_KEY')}}');
                        var elements = stripe.elements();
                        // Render the button into the container element
                        // Custom styling can be passed to options when creating an Element.
                        var style = {
                            base: {
                                // Add your base input styles here. For example:
                                fontSize: '16px',
                                lineHeight: '24px'
                            }
                        };

                        // Create an instance of the card Element
                        var card = elements.create('card', {style: style});

                        // Add an instance of the card Element into the `card-element` <div>
                        card.mount('#card-element');
                        card.addEventListener('change', function(event) {
                            var displayError = document.getElementById('card-errors');
                            if (event.error) {
                                displayError.textContent = event.error.message;
                            } else {
                                displayError.textContent = '';
                            }
                        });
                        // Create a token or display an error when the form is submitted.
                        var form = document.getElementById('payment-form');
                        form.addEventListener('submit', function(event) {
                            event.preventDefault();

                            stripe.createToken(card).then(function(result) {
                                if (result.error) {
                                    // Inform the user if there was an error
                                    var errorElement = document.getElementById('card-errors');
                                    errorElement.textContent = result.error.message;
                                } else {
                                    // Send the token to your server
                                    stripeTokenHandler(result.token);
                                }
                            });
                        });
                        function stripeTokenHandler(token) {
                            // Insert the token ID into the form so it gets submitted to the server
                            var form = document.getElementById('payment-form');
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'stripeToken');
                            hiddenInput.setAttribute('value', token.id);
                            form.appendChild(hiddenInput);

                            // Submit the form
                            form.submit();
                        }


                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="add-card-form" style="display: none">
        <div class="cross-mark-add-card">
            X
        </div>
        <form action="/user/cards/add" method="post">
            <input name="redirect" type="hidden" value="/user/manage/order">
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