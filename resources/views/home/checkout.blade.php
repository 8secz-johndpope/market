
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
        <div class="col-sm-8">
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
                                        <input type="radio" name="pay-meth-radio" id="saved-card" checked="true">
                                        <span class="custom-radio custom-ctr custom-rb"></span>
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
                                        <span class="custom-radio custom-ctr custom-rb">
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
                                        <div class="fs-edit">
                                            <button type="button" class="fs-edit-btn img-btn">
                                                <span class="glyphicon glyphicon-menu-down"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cc-new-ctr">
                                <div id="inst-details" class="bdr-btm">
                                    <form action="/user/cards/add" method="post">
                                    <input name="redirect" type="hidden" value="/user/manage/order">
                                    {{ csrf_field() }} 
                                    <div id="inst-error"></div>
                                    <div id="card-fields">
                                        <div class="cf-form">
                                            <div class="row">
                                                <span class="floating-label">
                                                    <label for="cardNumber">Card Number</label>
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
                                                    <input type="text" class="input-field cf-card-exp" id="expiry" name="expiry">
                                                </span>
                                                <span class="floating-label">
                                                    <label for="cvc">CVC:</label>
                                                    <input type="text" class="input-field cf-card-sec" id="cvc" name="cvc">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bill-add-ctr">
                                        @if($user->default_address != 0)
                                        <div id="bill-head">
                                            <div class="cc-title-text">
                                                Billing Address
                                            </div>
                                        </div>
                                        <div id="bill-edit-ctr">
                                            <div class="addr-read-version">
                                                {{$user->address->line1}}<br> 
                                                {{$user->address->city}} {{$user->address->postcode}}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="cta-wrapper">
                                        <div class="action col-p">
                                            <a href="#" class="cf-cancel">Cancel</a>
                                            <button type="button" class="btn btn-cta-save">Done</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="pay-method" data-mp-id="paypal">
                                <div class="col-l-p">
                                    <div class="radio-l">
                                        <input type="radio" name="pay-meth-radio" id="paypal">
                                        <span class="custom-radio custom-ctr">
                                        </span>
                                    </div>
                                    <div class="radio-r">
                                        <label class="mt-label" for="paypal">
                                        <span class="mt-logo paypal" id="paypal-container"></span>
                                    </label>
                                    </div>
                                </div>
                                <div class="col-r-p">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div id="shipping-address-ctr" class="col-sm-12">
                    <h3>Post to</h3>
                    <div class="postage-address">
                        <div class="main-pa">
                            <div class="main-pa-inf col-l-p">
                                <div>
                                    <div>{{$user->name}}</div>
                                    <div>{{$user->address->line1}}</div>
                                    <div>{{$user->address->city}} {{$user->address->postcode}}</div>
                                    <div>United Kingdom</div>
                                </div>
                                <div id="sa-change-link">
                                    <a href="javascript:;">Change</a>
                                </div>
                            </div>
                             <div class="sa-edit col-r-p">
                                <button type="button" class="sa-edit-btn"><span class="glyphicon glyphicon-menu-down"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="sa-edit-ctr">
                        <div id="shipping-address">
                            <fieldset class="sa-radiogroup">
                                <legend></legend>
                                @foreach($user->addresses as $address)
                                <div id="{{$address->id}}" class="sa-opt">
                                    <div class="sa-addr">
                                        <div class="radio-l">
                                            <input type="radio" name="addrs-post-radio" id="rdo-{{$address->id}}"  @if($user->default_address===$address->id) checked="true" @endif>
                                            <span class="custom-radio custom-ctr"></span>
                                        </div> 
                                        <label class="lbl" for="rdo-{{$address->id}}">
                                            @if($user->default_address===$address->id)
                                                <div class="pr-addr-lbl"> Primary address</div>
                                            @endif
                                            <span>{{$address->line1}}</span>
                                            <span>{{$user->address->city}} {{$address->postcode}}</span>
                                            <span>United Kingdom</span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </fieldset>
                            <div class="sa-cta clearfix">
                                <div class="sa-addr-addr"></div>
                                <div  class=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="cart-details-ctr" class="col-sm-12">
                    <h3>Review item and postage</h3>
                    <div class="seller-row">
                        <div class="seller-container">
                            <div id="seller-info" class="seller-info clearfix">
                                <div class="seller-name">
                                    <span>
                                        <span class="lbl">Seller:</span>
                                        {{$user->display_name}}
                                    </span>
                                </div>
                            </div>
                            <div class="seller-item-group">
                                <div class="dtls-table">
                                    <div class="dtls-tcell">
                                        <div class="item-row">
                                            <div class="dtls-table">
                                                <div class="item-img-ctr">
                                                    <div class="item-img">
                                                        <span class="img-ctr">
                                                             <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="item-info dtls-tcell">
                                                    <div class="row item-details">
                                                        <div class="col-xs-9 item-title">
                                                            {{$advert->param('title')}}
                                                        </div>
                                                        <div class="item-price-group col-xs-3">
                                                            <div class="item-price">
                                                                <span>£ {{$advert->meta('price')/100}}{{$advert->meta('price_frequency')}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="item-shipping clearfix">
                                                            <fieldset>
                                                                <legend>Select a delivery service</legend>
                                                                <div class="row">
                                                                    <div class="col-xs-9 shp-row">
                                                                        <div class="is-rdo col-l-p">
                                                                            <input type="radio" name="del-opt" id="is-col-person" checked="true" value="2">
                                                                            <span class="custom-radio custom-ctr"></span>
                                                                        </div>
                                                                        <label for="is-col-person" class="lbl col-r-p">
                                                                            <span class="shp-serv">
                                                                                Collection in person <span class="shp-opt"> - <span>Free</span></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-xs-3 shp-price show">
                                                                        <span>Free</span>
                                                                    </div>
                                                                </div>
                                                                @if($advert->has_param('candeliver')&&$advert->param('candeliver')===1)
                                                                <div class="row">
                                                                    <div class="col-xs-9 shp-row">
                                                                        <div class="is-rdo col-l-p">
                                                                            <input type="radio" name="del-opt" id="is-local-del" value="0">
                                                                            <span class="custom-radio custom-ctr"></span>
                                                                        </div>
                                                                        <label for="is-local-del" class="lbl col-r-p">
                                                                            <span class="shp-serv">
                                                                                Local delivery <span class="shp-opt show"> - <span>£{{$sale->advert->delivery()}}</span></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-xs-3 shp-price">
                                                                        <span>£{{$sale->advert->delivery()}}</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if($advert->has_param('canship')&&$advert->param('canship')===1)
                                                                <div class="row">
                                                                    <div class="col-xs-9 shp-row">
                                                                        <div class="is-rdo col-l-p">
                                                                            <input type="radio" name="del-opt" id="is-shipping" value="0">
                                                                            <span class="custom-radio custom-ctr"></span>
                                                                        </div>
                                                                        <label for="is-shipping" class="lbl col-r-p">
                                                                            <span class="shp-serv">
                                                                                United Kingdom Shipping <span class="shp-opt show"> - <span>£{{$sale->advert->shipping_cost()}}</span></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-xs-3 shp-price">
                                                                        <span>£{{$sale->advert->shipping_cost()}}</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 checkout-top">
            <div class="checkout-summry">
                <div class="checkout-details">
                    <table class="w100p">
                        <tr>
                            <td class="text-left">Price:</td>
                            <td><span class="bold-text">£<span id="sale-price">{{$sale->advert->price()}}</span></span></td>
                        </tr>
                        <tr class="post-price" id="post-price">
                            <td class="text-left">Postage:</td>
                            <td><span class="bold-text"><span class="col-post-price">Free</span></span></td>
                        </tr>
                    </table>
                </div>
                <div class="checkout-order">
                    <div id="order-total" class="order-total">
                        <table class="w100p">
                            <tbody>
                                <tr>
                                    <td class="text-left">Total:</td>
                                    <td><span class="bold-text">£<span id="sale-total-price">{{$sale->amount()}}</span></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="call-to-action">
                        <form >
                            {{ csrf_field() }}
                            <input name="nonce" value="xyz" type="hidden" id="nonce">
                            <input type="hidden" name="type" id="type" value="2">
                            <input type="hidden" name="shipping_address" id="shipping_address" value="">
                            <button type="submit" class="btn btn-submit">Confirm and pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script>
        $(".add-card").click(function () {
            $(".all-divs").hide();
            $(".add-card-form").show();
        });
        $(".cross-mark-add-card ").click(function () {
            $(".all-divs").show();
            $(".add-card-form").hide();
        });
        $('input[type=radio][name=del-opt]').change(function(){
            $('.shp-opt').addClass('show');
            $('label[for=' + this.id + '] .shp-opt').removeClass('show');
            $('.shp-price.show').removeClass('show');
            var parent = $('label[for=' + this.id + '] .shp-opt').closest('.shp-row');
            parent.next().addClass('show');
            var stringPrice = parent.next().find('span').text();
            var total = parseInt($('#sale-price').text());
            if(this.id != "is-col-person"){ 
                var price = parseInt(stringPrice.substring(1, stringPrice.length));
                $('.col-post-price').text('£'+ price);
                total = parseInt($('#sale-price').text()) + price;
            }
            else{
                $('.col-post-price').text(stringPrice);
            }
            $('#type').val($(this).val());
            $('#sale-total-price').text(total);
        });
         $('input[type=radio][name=pay-meth-radio]').change(function(){
            if(this.id == 'new-card'){
                $('#shipping-address-ctr .postage-address').toggleClass('expanded');
                $('.fs-edit-btn span').toggleClass('expanded');
            }
            else if(this.id == 'paypal')
                $('#braintree-paypal-button').click();  
         });
        $('#card-fields input').focus(function(){
            var label = $('label[for="' + this.id + '"]');
            if(this.id == 'expiry'){
                $(this).attr('placeholder', 'MM/YYYY')
            }
            label.css('top', '8px');
        });
        $('#card-fields input').focusout(function(){
            var label = $('label[for="' + this.id + '"]');
            if($(this).val() == ''){
                label.css('top', '27px');
                $(this).removeAttr('placeholder');
            }
        });
        $('.sa-edit button').click(function(){
            $('#shipping-address-ctr .postage-address').toggleClass('expanded');
            $('.sa-edit-btn span').toggleClass('expanded');
            if($('.sa-edit-btn span').hasClass('expanded')){
                $('#sa-change-link').hide();
                $('#shipping-address').show()
            }
            else{
                $('#sa-change-link').show();
                $('#shipping-address').hide();
            }
        });
        $('button.fs-edit-btn').click(function(){
            $('.fs-edit-btn span').toggleClass('expanded');
            if($('.fs-edit-btn span').hasClass('expanded')){
                $('#cc-new-ctr').show()
                $('input#new-card').prop('checked', true);
            }
            else{
                $('#cc-new-ctr').hide();
            }
        });
        $(window).scroll(function(e) {
            console.log($(document).scrollTop());
            if ($(document).scrollTop() > $('#pay-method-ctr').position().top) {
                console.log($('.checkout-summry').position().top);
                $('.checkout-summry').css('position', 'fixed');
                $('.checkout-summry').css('top', '24px');
                $('.checkout-summry').css('width', '320px');
            }
            else{
                $('.checkout-summry').css('position', 'relative');
                $('.checkout-summry').css('top', '0px');
            }
        });

    </script>
@endsection