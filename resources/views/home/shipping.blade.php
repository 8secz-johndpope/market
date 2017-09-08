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
                    <div class="item listing">
                        <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}">
                            <div class="listing-img">
                                <div class="main-img">
                                    <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">


                                    <div class="listing-meta">
                                    </div>
                                </div>
                            </div>
                            <div class="items-box-body listing-content">

                                <div class="row top-row">
                                    <div class="col-sm-11">
                                        <h4 class="items-box-name font-2">{{$product['title']}}</h4>
                                    </div>
                                    <div class="col-sm-1">

                                    </div>
                                </div>

                                <div class="listing-location">
                                <span class="truncate-line">
                                    {{$product['location_name']}}
                                </span>
                                </div>
                                <p class="listing-description">
                                    {{$product['description']}}
                                </p>
                                <ul class="listing-attributes inline-list">

                                </ul>

                                <div class="items-box-num clearfix">
                                    @if($product['meta']['price']>=0)
                                        <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </a>


                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group" >
                                @foreach($addresses as $address)
                                    <li class="list-group-item">
                                        <div class="radio">
                                            <label><input type="radio" name="address" value="{{$address->id}}">
                                            <table class="table">
                                                <tr><td>{{$address->line1}}</td></tr>
                                                <tr><td>{{$address->city}}</td></tr>
                                                <tr><td>{{$address->postcode}}</td></tr>
                                            </table>
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <button class="btn btn-default add-address">Add New Address</button>

                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="display-cards" @if(count($cards)===0) style="display: none" @endif>
                        <h4>Amount to Pay</h4>
                        <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}</div>
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