
@extends('layouts.app')

@section('title', 'Checkout')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('styles')
<link href="{{ asset('/css/sale.css?q=874') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="body background-body">
    <div class="container">
    <div class="row">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Pay with</h3>
                    <div class="pay-methods" id="pay-method-ctr">
                        <fieldset>
                            <legend>
                                Select a payment option
                            </legend>
                            @if(count($cards) > 0)
                            <div class="pay-method">
                                <div class="col-l-p">
                                    <div class="radio-l">
                                        <input type="radio" name="pay-meth-radio" id="saved-card">
                                        <span class="custom-radio"></span>
                                    </div>
                                    <div class="radio-r">
                                        <label class="mt-label" for="new-card">
                                            <span class="mt-cc"></span>
                                            xxxx-xxx-xxxx-{{$cards[0]['last4']}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-r-p">
                                    <label class="mt-label" for="saved-card">
                                        <span class="mt-scc"></span>
                                    </label>
                                </div>
                            </div>
                            @endif
                            <div class="pay-method" data-mp-id="new-cc">
                                <div class="col-l-p">
                                    <div class="radio-l">
                                        <input type="radio" name="pay-meth-radio" id="new-card">
                                        <span class="custom-radio">
                                        </span>
                                    </div>
                                    <div class="radio-r">
                                        <label class="mt-label" for="new-card">
                                            <span class="mt-cc"></span>
                                            Add credit or debit card
                                        </label>
                                    </div>
                                </div>
                                <div class="col-r-p">
                                    <div id="funding-source">
                                        <div class="fs-summary fade in">
                                            <ul class="cc-logos">
                                                <li class="visa"></li>
                                                <li class="mastercard"></li>
                                                <li class="discover"></li>
                                                <li class="am-ex"></li>
                                                <li class="maestro"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="fs-edit">
                                        <button type="button fs-edit-btn img-btn">
                                            <span class=""></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="cc-new-ctr">
                                <div id="inst-details" class="bdr-btm">
                                    <div id="inst-error"></div>
                                    <div id="card-fields">
                                        <div class="cf-form">
                                            <div class="row">
                                                <span class="floating-label">
                                                    <label for="card">Card Number</label>
                                                    <input type="text" class="input-field cf-card-number" id="cardNumber" name="card" placeholder="">
                                                    <ul class="cc-logos">
                                                        <li class="visa small"></li>
                                                        <li class="mastercard small"></li>
                                                        <li class="discover small"></li>
                                                        <li class="am-ex small"></li>
                                                        <li class="maestro small"></li>
                                                    </ul>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="floating-label">
                                                    <label for="expiry">Expiry date:</label>
                                                    <input type="text" class="form-control" name="expiry" placeholder="Expiry MM/YYYY">
                                                </span>
                                                <span class="floating-label">
                                                    <label for="cvc">CVC:</label>
                                                    <input type="text" class="form-control" name="cvc" placeholder="cvc (3 digits)">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pay-method" data-mp-id="paypal">
                                <div class="col-l-p">
                                    <div class="radio-l">
                                        <input type="radio" name="pay-meth-radio" id="paypal">
                                        <span class="custom-radio">
                                        </span>
                                    </div>
                                    <div class="radio-r">
                                        <label class="mt-label" for="paypal">
                                        <span class="mt-logo paypal"></span>
                                    </label>
                                    </div>
                                </div>
                                <div class="col-r-p">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h3>Post to</h3>
                    <div class="postage-address">
                        <div class="main-pa">
                        </div>
                        <div id="sa-change-link">
                            <a href="javascript:;">Change</a>
                        </div>
                        <div class="sa-edit">
                            <button type="button"><span></span></button>
                        </div>
                    </div>
                    <div class="sa-edit-ctr">
                        <div id="shipping-address">
                            <fieldset class="sa-radiogroup">
                                <legend></legend>

                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="checkout-summry">
                <div class="checkout-details">
                    <table class="table">
                        <tr>
                            <td>Price:</td>
                            <td><span class="bold-text">£<span id="sale-price">{{$sale->advert->price()}}</span></span></td>
                        </tr>
                        <tr class="post-price" id="del-address-price">
                            <td>Delivery:</td>
                            <td><span class="bold-text">£<span class="col-post-price">{{$sale->advert->delivery()}}</span></span></td>
                        </tr>
                        <tr class="post-price" id="ship-address-price">
                            <td>Shipping:</td>
                            <td><span class="bold-text">£<span class="col-post-price">{{$sale->advert->shipping_cost()}}</span></span></td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td><span class="bold-text">£<span id="sale-total-price">{{$sale->amount()}}</span></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row all-divs">
        <div class="col-sm-8 col-sm-offset-2">

            <div class="row">
                <div class="col-sm-8">
                    <form action="/user/payment/sale/stripe/{{$sale->id}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" value="2" name="type" id="type">
                    <h4>Your Order</h4>

                    <div class="product">
                        <div class="listing-side">
                            <div class="listing-thumbnail">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

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
                    <div class="postage-options">
                        <div id="card-element"></div>
                        <h4>Select delivery</h4>
                        <label>
                            Collection in person
                        </label>
                        <input type="radio" name="post-option" data-href="collect" checked value="2">
                        <br>
                        <label>
                            Local delivery
                        </label>
                        <input type="radio" name="post-option" data-href="del-address" value="0">
                        <br>
                        <label>
                            United Kingdom Shipping
                        </label>
                        <input type="radio" name="post-option" data-href="ship-address" value="1">
                    </div>
                    <div class="post-address" id="ship-address">
                            <h4>Shipping Address</h4>
                            @foreach($user->addresses as $address)
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="shipping_address" id="exampleRadios1"  @if($user->default_address===$address->id) checked @endif  value="{{$address->id}}">
                                        {{$address->line1}},{{$address->city}},{{$address->postcode}}
                                    </label>
                                </div>
                            @endforeach
                    </div>
                    <div class="post-address" id="del-address"> 
                        <h4>Delivery Address</h4>
                        @foreach($user->addresses as $address)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="delivery_address" id="exampleRadios1" value="{{$address->id}}" @if(!$advert->can_deliver_to($address->zip)) disabled @endif>
                                {{$address->line1}},{{$address->city}},{{$address->postcode}}<br>@if(!$advert->can_deliver_to($address->zip))<span class="red-text"> Outside of the delivery area</span> @else <span class="green-text" > Can Deliver </span> @endif --- {{$advert->distance($address->zip) }} Miles
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <h4>Billing Address</h4>
                    @foreach($user->addresses as $address)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="billing_address" id="exampleRadios1" value="{{$address->id}}" @if($user->default_address===$address->id) checked @endif required>
                                {{$address->line1}},{{$address->city}},{{$address->postcode}}
                            </label>
                        </div>
                    @endforeach

                </div>
                <div class="col-sm-4">
                    <table class="table">
                        <tr>
                            <td>Price:</td>
                            <td><span class="bold-text">£<span id="sale-price">{{$sale->advert->price()}}</span></span></td>
                        </tr>
                        <tr class="post-price" id="del-address-price">
                            <td>Delivery:</td>
                            <td><span class="bold-text">£<span class="col-post-price">{{$sale->advert->delivery()}}</span></span></td>
                        </tr>
                        <tr class="post-price" id="ship-address-price">
                            <td>Shipping:</td>
                            <td><span class="bold-text">£<span class="col-post-price">{{$sale->advert->shipping_cost()}}</span></span></td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td><span class="bold-text">£<span id="sale-total-price">{{$sale->amount()}}</span></span></td>
                        </tr>
                    </table>
                    <div class="display-cards" @if(count($cards)===0) style="display: none" @endif>
                        <h4>Pay by Card</h4>

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
                                //amount: {{$sale->amount()}}, // Required
                                amount: parseInt($('#sale-total-price').text()),
                                currency: 'GBP', // Required
                            },
                            onPaymentMethodReceived: function (obj) {
                                //  doSomethingWithTheNonce(obj.nonce);
                                document.location.href = '/user/payment/sale/paypal/{{$sale->id}}?nonce='+obj.nonce

                            }
                        });
                    </script>

                    
                </div>
            </div>
        </div>
    </div>
    <div class="add-card-form" style="display: none">
        <div class="cross-mark-add-card">
            X
        </div>
        <form action="/user/cards/add" method="post" >
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
</form>
    <script>
        $(".add-card").click(function () {
            $(".all-divs").hide();
            $(".add-card-form").show();
        });
        $(".cross-mark-add-card ").click(function () {
            $(".all-divs").show();
            $(".add-card-form").hide();
        });
        $('input[type=radio][name=post-option]').change(function(){
            var idDiv = $(this).attr('data-href');
            var total = parseInt($('#sale-price').text());
            var type = $(this).val();
            if(idDiv != "collect"){
                $('.post-address').hide();
                $('.post-price').hide();
                $('.post-address input').attr('required', false);
                $('#'+idDiv).show();
                $('#'+idDiv +' input').attr('required', true);
                $('#' + idDiv + '-price').show();
                total += parseInt($('#' + idDiv + '-price .col-post-price').text());
            }
            else{
                $('.post-address').hide();
                $('.post-address input').attr('required', false);
                $('.post-price').hide()
            }
            console.log(type);
            $("#type").val(type);
            $('#sale-total-price').text(total);
        });
    </script>
@endsection