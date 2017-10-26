<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row all-divs">
        <div class="col-sm-8 col-sm-offset-2">

            <div class="row">
                <div class="col-sm-8">
                    <form action="/user/payment/stripe" method="post">

                    <h4>Your Order</h4>

                    <div class="product">
                        <div class="listing-side">
                            <div class="listing-thumbnail">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

                                @if($advert->featured_expires())
                                    <span class="ribbon-featured">
<strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
</span>
                                @endif

                                <div class="listing-meta txt-sub">
                                    <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($advert->param('images'))}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info">


                            <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->id}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>

                            <span class="listing-location">
                                    {{$advert->param('location_name')}}
                                </span>
                            <p class="listing-description">
                                {{$advert->param('description')}}
                            </p>

                            @if($advert->meta('price')>=0)
                                <span class="product-price">£ {{$advert->meta('price')/100}}{{$advert->meta('price_frequency')}}
                                </span>
                            @endif



                            @if($advert->urgent_expires())
                                <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                            @endif
                        </div>
                    </div>
                    <h4>Delivery Address</h4>
                    @foreach($user->addresses as $address)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="delivery_address" id="exampleRadios1" value="option1" @if(!$advert->can_deliver_to($address->zip)) disabled @endif required>
                            {{$address->line1}},{{$address->city}},{{$address->postcode}}<br>@if(!$advert->can_deliver_to($address->zip))<span class="red-text"> Outside of the delivery area</span> @else <span class="green-text" > Can Deliver </span> @endif --- {{$advert->distance($address->zip) }} Miles
                        </label>
                    </div>
                    @endforeach
                    <h4>Billing Address</h4>
                    @foreach($user->addresses as $address)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="billing_address" id="exampleRadios1" value="option1" @if($user->default_address===$address->id) checked @endif required>
                                {{$address->line1}},{{$address->city}},{{$address->postcode}}
                            </label>
                        </div>
                    @endforeach

                </div>
                <div class="col-sm-4">
                    <table class="table">
                        <tr><td>Price:</td><td><span class="bold-text">£{{$sale->advert->price()}}</span></td></tr>
                        @if($sale->type===0)
                            <tr><td>Delivery:</td><td><span class="bold-text">£{{$sale->advert->delivery()}}</span></td></tr>

                        @endif

                        <tr><td>Total:</td><td><span class="bold-text">£{{$sale->amount()}}</span></td></tr>
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
                                amount: {{$sale->amount()}}, // Required
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