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
<link href="{{ asset('\'/css/pay-invoice.css?q='. $dateMs .'874\'') }}" rel="stylesheet" type="text/css">
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
                                        <p>Full refund within 60 days after purchase.</p>
                                    </div>
                                    <div class="notes-container">
                                        <p><strong>Note to recipient</strong></p>
                                        <p>Thank for your business. Enjoy</p>
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
                            <button class="btn btn-submit" type="submit" disabled="true">Pay Now</button>
                        </div>
                        <div class="col-sm-12 invoice-pay-logo">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="container-print">
                                        <button class="btn btn-print">Print</button>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-4">
                                    <div class="container-img-invoice">
                                        <div class="img-invoice">
                                            <img src="/css/icons/icon-invoice-ww.svg">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-3 col-xs-4">
                                    <div class="secure-stripe-container">
                                        <div class="secure-stripe-img">
                                            <img src="/css/icons/stripe-secure.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-4">
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
                <div class="">
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="cc-new-ctr">
                                <div id="inst-details" class="bdr-btm">
                                    <h2>Credit or debit card</h2>
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
                                            <div class="row">
                                                <span class="floating-label">
                                                    <label for="name">First name:</label>
                                                    <input type="text" class="input-field cf-card-fname" id="name" name="name">
                                                </span>
                                                <span class="floating-label">
                                                    <label for="surname">Surname:</label>
                                                    <input type="text" class="input-field cf-card-sname" id="surname" name="surname">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bill-add-ctr">
                                        <div id="bill-head">
                                            <div class="cc-title-text">
                                                Billing Address
                                            </div>
                                        </div>
                                        <div id="bill-edit-ctr">
                                            <div class="addr-fields-ctr">
                                                <div id="address-fields" class="addr-info form">
                                                    <div id="af-error-wrapper">
                                                    </div>
                                                    <div class="af-row">
                                                        <span class="floating-label">
                                                            <label for="af-country" class="floated-always">Country or region</label>
                                                            <select name="af-country" id="af-country" class="af-country" disabled="true">
                                                                <option value="GB" selected="selected" >United Kingdom</option>
                                                                <option value="CA">Canada</option><option value="US">United States</option><option value="AA">APO/FPO</option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan Republic</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BR">Brazil</option><option value="VG">British Virgin Islands</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde Islands</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CD">Congo, Democratic Republic of the</option><option value="CG">Congo, Republic of the</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote d Ivoire (Ivory Coast)</option><option value="HR">Croatia, Republic of</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Islas Malvinas)</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="GA">Gabon Republic</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IE">Ireland</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KR">Korea, South</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="SH">Saint Helena</option><option value="KN">Saint Kitts-Nevis</option><option value="LC">Saint Lucia</option><option value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SR">Suriname</option><option value="SJ">Svalbard</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TG">Togo</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican City State</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="VI">Virgin Islands (U.S.)</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara</option><option value="WS">Western Samoa</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select>
                                                        </span>
                                                    </div>
                                                    <div class="row">
                                                        <span class="floating-label">
                                                            <label for="address1" class="floated">Street address</label>
                                                            <input type="text" name="address1" id="address1" class="input-field" required>
                                                        </span>
                                                        <span class="floating-label">
                                                            <label for="address2" class="floated">Street address 2(optional)</label>
                                                            <input type="text" name="address2" id="address2" class="input-field">
                                                        </span>
                                                    </div>
                                                    <div class="row">
                                                        <span class="floating-label">
                                                            <label for="city" class="floated">City</label>
                                                            <input type="text" name="city" id="city" class="input-field" required>
                                                        </span>
                                                        <span class="floating-label postcode">
                                                            <label for="postcode" class="floated">Postcode</label>
                                                            <input type="text" name="postcode" id="postcode" class="input-field" required>
                                                        </span>
                                                    </div>
                                                    <div class="row">
                                                        <span class="floating-label">
                                                            <label for="telephone" class="floated">Phone number</label>
                                                            <input type="tel" name="telephone" id="telephone" class="input-field telephone" required>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="row">
                    <div class="col-sm-12 hidden-xs hidden-sm">
                        <div class="pay-container">
                            <form id="payment-form" action="/user/payment/invoice/stripe/{{$invoice->id}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="card" value="" id="card">
                                <input type="hidden" name="nonce" id="nonce">
                                <button class="btn btn-submit" type="submit" disabled="true">Pay Now</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h2>Pay with</h2>
                        <div class="pay-methods logout" id="pay-method-ctr">
                            <fieldset>
                                <legend>
                                    Select a payment option
                                </legend>
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
                                                Pay with credit or debit card
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
                                                </ul>-->
                                            </div>
                                            <div class="fs-edit">
                                                <button type="button" class="fs-edit-btn img-btn">
                                                    <span class="glyphicon glyphicon-menu-down"></span>
                                                </button>
                                            </div>
                                        </div>
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
<script>
    $('input[type=radio][name=pay-meth-radio]').change(function(){
        if(this.id == 'paypal'){
            $('.btn.btn-submit').prop('disabled', true);
            if($('button.fs-edit-btn span').hasClass('expanded')){
                $('button.fs-edit-btn').toggleClass('expanded');
                $('#cc-new-ctr').css('display', 'none');
            }
            $('#braintree-paypal-button').click();
        }
        else if(this.id == 'new-card'){
            $('.btn.btn-submit').prop('disabled', false);
            $('#cc-new-ctr').show();
            if(!($('button.fs-edit-btn span').hasClass('expanded'))){
                $('.fs-edit-btn span').toggleClass('expanded');
            }
        }
    });
    $('button.fs-edit-btn').click(function(){
        var span = $(this).find('span');
        $(span).toggleClass('expanded');
        if($(span).hasClass('expanded')){
            $('#cc-new-ctr').show();
            $('html, body').animate({scrollTop:  $('#cc-new-ctr').offset().top - 80}, 500);
        }
        else
           $('#cc-new-ctr').hide(); 
    });
    $('.buttons-bottom .btn-submit').click(function(){
        $('#payment-form').submit();
    });
    $('#card-fields input, #address-fields input').focus(function(){
        var label = $('label[for="' + this.id + '"]');
        if(this.id == 'expiry'){
            $(this).attr('placeholder', 'MM/YYYY')
        }
        label.css('top', '8px');
    });
    $('#card-fields input, #address-fields input').focusout(function(){
        var label = $('label[for="' + this.id + '"]');
        if($(this).val() == ''){
            label.css('top', '27px');
            $(this).removeAttr('placeholder');
        }
    });
    $('.action .cf-cancel').click(function(e){
        e.preventDefault();
        $('html, body').animate({scrollTop: 80}, 500);
        $('.fs-edit-btn span').toggleClass('expanded');
        $('#cc-new-ctr').hide();

    });
</script>
@endsection