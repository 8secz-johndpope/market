<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Invoice')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/pay-invoice.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="invoice-container clearfix">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <div class="logo-container">
                                <div class="logo-img">
                                    @if(isset($seller->business))
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$seller->business->logo}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-6 co-xs-6">
                            <div class="title-inv-container">
                                <div class="title-invoice">
                                    <h3>INVOICE</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        var_dump("ok2");die;
                    @endphp
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="seller-info">
                                @if(isset($seller->business))
                                    <div>
                                        <h2 class="seller-name">{{$seller->business->name}}</h2>
                                    </div>
                                    <div>
                                        {{$seller->business->address->line1}}
                                    </div>
                                    <div>
                                        {{$seller->business->address->city}} {{$seller->business->address->postcode}}
                                    </div>
                                    <div>
                                        United Kingdom
                                    </div>
                                    <div>
                                        {{$seller->business->phone}}
                                    </div>
                                    <div>
                                        {{$seller->business->email}}
                                    </div>
                                    @if($invoice->show_vat == 1)
                                    <div>
                                        VAT Registation No. {{$seller->business->vat}}
                                    </div>
                                    @endif
                                @else
                                    <div>
                                        <h2 class="seller-name">{{$seller->name}}</h2>
                                    </div>
                                    <div>
                                        {{$seller->email}}
                                    </div>
                                @endif
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
                                        <div class="details-r">{{$invoice->created_at->format('d/m/Y')}}</div>
                                    </li>
                                    <li>
                                        <div class="details-l">
                                            <strong>Payment terms</strong>
                                        </div>
                                        <div class="details-r">Due Immediately</div>
                                    </li>
                                    <li>
                                        <div class="details-l">
                                            <strong>Due date</strong>
                                        </div>
                                        <div class="details-r">{{$invoice->created_at->format('d/m/Y')}}</div>
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
                        <div class="col-sm-12">
                            <div class="row total-terms-container">
                                <div class="col-sm-6">
                                    <div class="terms-container">
                                        <p><strong>Terms</strong></p>
                                        @if($invoice->terms !== null)
                                            <p>{{$invoice->terms}}</p>
                                        @else
                                            <p>Full refund within 60 days after purchase.</p>
                                        @endif
                                    </div>
                                    <div class="notes-container">
                                        <p><strong>Note to recipient</strong></p>
                                        @if($invoice->notes !== null)
                                            <p>{{$invoice->notes}}</p>
                                        @else
                                            <p>Thank for your business. Enjoy</p>
                                        @endif
                                    </div>
                                </div>
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

                        <div class="col-sm-offset-6 col-sm-6 button-pay">
                            <button class="btn btn-submit" type="submit">Pay Now</button>
                        </div>
                        <div class="col-sm-12 invoice-pay-logo">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="container-print">
                                        <button class="btn btn-print">Print</button>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="container-img-invoice">
                                        <div class="img-invoice">
                                            <img src="/css/icons/icon-invoice-ww.svg">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-3 col-xs-6">
                                    <div class="secure-stripe-container">
                                        <div class="secure-stripe-img">
                                            <img src="/css/icons/stripe-secure.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="secure-paypal-container">
                                        <div class="secure-paypal-img">
                                            <img src="/css/icons/paypal-secure.svg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons-bottom hidden-xs">
                    <div class="row">
                        
                        <!-- <div class="col-sm-3">
                            <div class="container-img-invoice">
                                <div class="img-invoice">
                                    <img src="/css/icons/icon-invoice-ww.svg">
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-3">
                            <div class="secure-stripe-container">
                                <div class="secure-stripe-img">
                                    <img src="/css/icons/stripe-secure.png">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="secure-paypal-container">
                                <div class="secure-paypal-img">
                                    <img src="/css/icons/paypal-secure.svg">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="row">
                    <div class="col-sm-12 hidden-xs hidden-sm">
                        <div class="pay-container">
                            <form id="payment-form" action="/user/payment/invoice/stripe/{{$invoice->id}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="card" value="{{$def['id']}}" id="card">
                                <input type="hidden" name="nonce" id="nonce">
                                <button class="btn btn-submit" type="submit">Pay Now</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h2>Pay with</h2>
                        <div class="pay-methods" id="pay-method-ctr">
                            <fieldset>
                                <legend>
                                    Select a payment option
                                </legend>
                                @if(count($cards) > 0)
                                <div class="pay-method">
                                    <div class="col-l-p cc-logo">
                                        <div class="radio-l">
                                            <input type="radio" name="pay-meth-radio" id="saved-card" checked="true" value="{{$def['id']}}">
                                            <span class="custom-radio custom-ctr custom-rb"></span>
                                        </div>
                                        <div class="radio-r">
                                            <label class="mt-label" for="saved-card">
                                                <span class="mt-cc"></span>
                                                xxxx-xxx-xxxx-{{$def['last4']}}
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-r-p cc-logo">
                                        <div id="funding-cc">
                                            <div class="fs-summary fade in">
                                                <ul class="cc-logos ui-sortable">
                                                    <li class="{{str_replace(" ", "", strtolower($def['brand']))}} ui-sortable-handle"></li>
                                                    <!-- <li class="mastercard ui-sortable-handle"></li>
                                                    <li class="discover ui-sortable-handle"></li>
                                                    <li class="am-ex ui-sortable-handle"></li>
                                                    <li class="maestro ui-sortable-handle"></li> -->
                                                </ul>
                                            </div>
                                            <div class="fs-edit">
                                                <button type="button" class="fs-change-cc-btn img-btn">
                                                    <span class="glyphicon glyphicon-menu-down"></span>
                                                </button>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                                <div id="cc-change-ctr">
                                    <div id="ccs-info" class="bdr-btm">
                                        <fieldset>
                                            <legend></legend>
                                            @foreach($cards as $card)
                                            <div class="sa-opt">
                                                <div class="sa-cc">
                                                    <div class="radio-l">
                                                        <input type="radio" name="cc-saved-radio" id="rdo-{{$card['id']}}" value={{$card['id']}} @if($card['id'] == $def['id']) checked="true" @endif>
                                                        <span class="custom-radio custom-ctr"></span>
                                                    </div> 
                                                    <label class="lbl" for="rdo-{{$card['id']}}">
                                                        <span>xxxx-xxx-xxxx-{{$card['last4']}}</span>
                                                        <span class="t-cc {{str_replace(" ", "", strtolower($card['brand']))}}"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </fieldset>
                                    </div>
                                </div>
                                @endif
                                @php
                                        var_dump("ok3");
                                @endphp
                                <!-- <div class="pay-method" data-mp-id="new-cc">
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
                                                <!-- <ul class="cc-logos">
                                                    <li class="visa"></li>
                                                    <li class="mastercard"></li>
                                                    <li class="discover"></li>
                                                    <li class="americaexpress"></li>
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
                                        <input name="redirect" type="hidden" value="/pay/invoice/{{$invoice->id}}">
                                        <input name="address" type="hidden" value="{{$user->address->id}}">
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
                                                            <li class="americaexpress small"></li>
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
                            -->
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
                    <!--<div class="col-sm-12">
                        <div class="secure-stripe-container">
                            <div class="secure-stripe-img">
                                <img src="/css/icons/stripe-secure.svg">
                            </div>
                        </div>
                    -->
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
                                $('#nonce').val(obj.nonce);
                                $('.btn.btn-submit').prop('disabled', false);
                                $("#payment-form").attr("action", '/user/payment/invoice/paypal/{{$invoice->id}}');
                                /*document.location.href = '/user/payment/invoice/paypal/{{$invoice->id}}?nonce='+obj.nonce*/

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
    $('input[type=radio][name=pay-meth-radio]').change(function(){
        if(this.id == 'paypal'){
            $('#braintree-paypal-button').click();
            $('.btn.btn-submit').prop('disabled', true);
        }
        else if(this.id == 'saved-card'){
            $('.btn.btn-submit').prop('disabled', false);
        }
        if($('.fs-edit-btn span').hasClass('expanded')) {
            $('.fs-edit-btn span').toggleClass('expanded');
        } 
    });
    $('button.fs-change-cc-btn').click(function(){
        var span = $(this).find('span');
        $(span).toggleClass('expanded');
        if($(span).hasClass('expanded')){
            $('#cc-change-ctr').show();
            $('#saved-card').prop('checked', true);
        }
        else
           $('#cc-change-ctr').hide(); 
    });
    $('input[type=radio][name=cc-saved-radio]').change(function(){
        var val = $(this).val();
        $('#saved-card').val(val);
        $('#card').val(val);
        $('button.fs-change-cc-btn span').toggleClass('expanded');
        $('#cc-change-ctr').hide();
        $('label[for=saved-card]').text($('label[for='+ this.id +']').text());
        $('#funding-cc li').attr('class', '');
        $('#funding-cc li').addClass($('label[for='+ this.id +'] .t-cc').attr('class'));  
    });
    $('.buttons-bottom .btn-submit').click(function(){
        $('#payment-form').submit();
    })
</script>
@endsection