<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <div class="row">
                <div class="col-sm-8">
                    <h4>Your Order</h4>
                    @if($order->type==='bump')
                    <table class="table">
                        @foreach($order->items as $item)
                        <tr><td>{{$item->title}}</td><td>£{{$item->amount}}</td></tr>
                            @endforeach
                            <tr><td>Total:</td><td>£{{$order->amount}}</td></tr>
                    </table>
                    @elseif($order->type==='contract')
                        <table class="table">
                            <thead><th>Title</th><th>Category</th><th>Location</th><th>Quantity</th><th>Price</th></thead>
                            @foreach($order->contract->packs as $pack)
                                <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td><td>{{$order->contract->count}}</td><td>£{{$pack->amount/100}}</td></tr>
                            @endforeach
                            <tr><td><span class="bold-text">Total</span></td><td></td><td></td><td><span class="bold-text">{{count($order->contract->packs)*$order->contract->count}}</span></td><td><span class="bold-text"> £{{$order->contract->packs->sum('amount')/100}}</span></td></tr>
                        </table>
                    @endif
                    <p>Amount you will be paying now to secure the contract</p>
                    <span class="bold-text">£{{(1-$order->contract->discount/100)*0.05*$order->contract->packs->sum('amount')/100}}</span>
                </div>
                <div class="col-sm-4">
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
                    <div class="add-card-div" style="display: none">
                    <form action="/user/cards/add" method="post" id="payment-form">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <button>Add Card</button>
                    </form>
                    </div>
                    <p>Or</p>

                        <div id="paypal-container"></div>


                    <script type="text/javascript">
                        braintree.setup('{{$token}}', 'custom', {
                            paypal: {
                                container: 'paypal-container',
                                singleUse: true, // Required
                                amount: {{$order->amount}}, // Required
                                currency: 'GBP', // Required
                            },
                            onPaymentMethodReceived: function (obj) {
                              //  doSomethingWithTheNonce(obj.nonce);
                                document.location.href = '/user/payment/paypal?nonce='+obj.nonce

                            }
                        });
                    </script>

                    <script>
                        var stripe = Stripe('pk_test_pSP0FdEAje47JIrZx4H8ActS');
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
                        $(".add-card").click(function () {
                           $(".add-card-div").show();
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>


@endsection