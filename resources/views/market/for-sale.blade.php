<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', $product['title'] . ' | '. env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('styles')
<link href="{{ asset('/css/for-sale.css?q=874') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<script src="/js/imageviewer.min.js"></script>
<script src="/js/carousel.js"></script>
<div class=" body background-body">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-6 back">
                <a class="" href="/{{$category->slug}}">< Back to search</a>
            </div>
            <div class="col-md-8 col-sm-6 hidden-xs">
                <ol class="breadcrumb">
                    @foreach($parents as $parent)
                    <li class="breadcrumb-item"><a href="/{{$parent->slug}}">{{$parent->title}}</a></li>
                    @endforeach
                    <li class="breadcrumb-item"><a href="/{{$category->slug}}">{{$category->title}}</a></li>
                </ol>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 prev-next">
                @if($advert->prevAdvert() !== null)
                    <a href="/p/{{$category->id}}/{{$advert->prevAdvert()->id}}"> < Prev</a>
                @endif
                @if($advert->nextAdvert() !== null)
                    <a href="/p/{{$category->id}}/{{$advert->nextAdvert()->id}}"> Next > </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h2 class="item-name header">{{$product['title']}}</h2>
                <div class="location-name">
                    <p>{{$product['location_name']}}</p>
                </div>
                <div class="box-price">
                    @if($product['meta']['price']>=0)
                    <div class="items-box-price font-5">£ {{number_format($product['meta']['price'] / 100, 0, '.', ',')}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                    <div id="current-image">
                        <img id="image-active" data-index="1" src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image}}?1500586448" alt="Los Angeles" data-high-res-src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image}}?1500586448" class="gallery-items">
                        @if(count($product['images']) > 0)
                        <div class="images-info">
                            <div class="col-sm-4 start-animation">
                                <a href="javascript:void(0)" class="icon-before">Start slideshow</a>
                            </div>

                            <div class="col-sm-4 images-nav">
                                <p><span class="prev"> <a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-left"></span></a></span>
                                    <span class="index">1</span> of {{count($product['images'])}}
                                    <span class="next"><a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a></span>
                                </p>
                            </div>
                            <div class="col-sm-4 images-current">
                                <a href="#"><p><span class="glyphicon glyphicon-zoom-in"></span>Enlarge</p></a>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if(count($product['images']) > 0)
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @for($i=0; $i< count($product['images']); $i++)
                            <div class="item">
                                @for($j=0; $j < 5 && ($i+$j) < count($product['images']); $j++)
                                <div class="small-image">
                                    <a href="javascript:void(0)" data-index="{{$i+$j+1}}">
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$product['images'][$i+$j]}}?1500586448" alt="Los Angeles">
                                    </a>
                                </div>
                                @endfor
                                @php
                                    $i = $i + $j - 1
                                @endphp
                            </div>
                            @endfor
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    @endif
                    <div class="request-details">
                        <a href="/download-mobile-apps/" class="btn btn-default">Call</a>
                        <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a>
                        
                        <a href="/download-mobile-apps/" class="btn btn-default">VideoCall</a>
                    </div>
                    
                    <div id="tabs"> 
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
                        <li><a data-toggle="tab" href="#tap-postage">Postage & Returns</a></li>
                        <li><a data-toggle="tab" href="#tap-pay">Payment</a></li>
                        <li><a data-toggle="tab" href="#tap-map">Map & Street View</a></li>
                        <li><a data-toggle="tab" href="#tap-terms">Terms of Seller</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-description" class="clearfix tab-pane fade in active">
                            <div class="content">
                                <div class="col-sm-12 left-content">
                                    <div class="row meta">
                                        @foreach($metas as $meta)
                                            <div class="col-sm-6 meta-bold">
                                                {{$meta->title}}:
                                            </div>
                                            <div class="col-sm-6 meta-info">
                                                {{$meta->value}}
                                            </div>
                                        @endforeach
                                            <div class="col-sm-6 meta-bold">
                                                Added on {{env('APP_NAME')}}:
                                            </div>
                                            <div class="col-sm-6 meta-info">
                                                {{$advert->created_at->format('d F Y')}}
                                            </div>
                                    </div>
                                    @if($advert->has_meta('key_features'))
                                        <div class="row key-features">
                                            <h3>Key features</h3> 
                                            <ul class="list-two-col list-style-square">
                                            @foreach($advert->meta('key_features') as $key)
                                                <li class="col-sm-6">{{$key}}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="description">
                                        <h3>Full Description</h3>
                                        @if($advert->isPropertyForSale() && $advert->has_meta('property_tenure'))
                                        <div class="sec">
                                            <p><strong>Tenure: </strong>{{$advert->meta('property_tenure')}}</p>
                                        </div>
                                        @endif

                                      {!! $product['description'] !!}

                                    </div>
                                </div>
                                <!-- <div class="col-sm-4 right-content">
                                    <div class="map-image">
                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={!! $lat !!},{!! $lng !!}&zoom=12&size=190x222&markers=color:blue%7Clabel:S%7C{!! $lat !!},{!! $lng !!}&key=AIzaSyCe5IY6S4WvKrjmvpgTwHyO1oiX4pRUUD8">
                                    </div>
                                    <div class="color-grey">
                                        <a href="#tap-map"> <span class="glyphicon glyphicon-zoom-in"></span>Enlarge this map</a>
                                    </div>
                                    <div class="color-grey nearest-stations">
                                        <h4>Nearest stations</h4>
                                        <ul class="stations-list">

                                        </ul>
                                        <small class="disclaimer">
                                            Distances are straight line measurements from centre of postcode
                                        </small>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div id="tap-map" class="tab-pane fade">           
                            <div class="row mapframe">
                        <div class="col-sm-12">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                    <input type="radio" name="options" id="option-map" autocomplete="off" checked> map view
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="options" id="option-view" autocomplete="off">
                                    street view
                                </label>
                            </div>
                            <div class="info-map">
                                <div id="map"></div>
                                <small>Note: The pin shows the centre of the property's postcode, and does not pinpoint the exact address</small>
                                <div>
                                    <h4>Nearest stations</h4>
                                    <ul class="stations-list">

                                    </ul>
                                    <small>Distances are straight line measurements from centre of postcode
</small>
                                </div>
                            </div>
                            <div class="info-pano">
                                <div id="pano"></div>
                                <small>Note: Start exploring the local area from here.</small>
                            </div>
                            
                            <script>
                                var map;
                                var panorama;
                                var service;
                                function initMap() {
                                    var uluru = {lat: {!! $lat !!}, lng: {!! $lng !!}};
                                     map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 18,
                                        center: uluru
                                    });
                                    var marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map
                                    });
                                    var pos = new google.maps.LatLng(uluru.lat, uluru.lng);
                                    getTransport({!! $lat !!},{!! $lng !!});
                                    panorama = new google.maps.StreetViewPanorama(
                                        document.getElementById('pano'), {
                                            position: uluru,
                                            pov: {heading: 165, pitch: 0},
                                            motionTrackingControlOptions: {
                                            position: google.maps.ControlPosition.LEFT_BOTTOM
                                        }
                                    });
                                }
                                $(document).ready(function() {
                                    initMap();
                                    activeFirstItem();
                                });
                            </script>

                        </div>
                    </div>
                        </div>
                        <div id="tap-postage" class="tab-pane fade">
                            <div class="row">           
                                <div class="col-sm-12">
                                    <p>Seller assumes all responsibility for this listing</p>
                                    <div class="des-postage">
                                        <h3>Postage and packaging</h3>
                                        <div class="postage-info">
                                            <p><strong>Item location: </strong>{{$product['location_name']}}</p>
                                            <div class="info-type">
                                                <h4>Collection in person</h4>
                                                <p>FREE</p>
                                            </div>
                                            @if($advert->has_param('canship')&&$advert->param('canship')===1)
                                            <div class="info-type">
                                                <h4>Shipping</h4>
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>To</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>United Kingdom</td>
                                                            <td>£{{ $advert->shipping_cost() }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endif
                                            @if($advert->has_param('candeliver')&&$advert->param('candeliver')===1)
                                            <div class="info-type">
                                                <h4>Local Delivery</h4>
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Distance</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Within {{$advert->meta('distance')}}  Miles</td>
                                                            <td>£{{ $advert->delivery() }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="check-distance">
                                                    <label for="postcode">
                                                       Check if it can be delivered to you
                                                    </label>
                                                    <input type="text" name="postcode" id="postcode">
                                                    <input type="hidden" id="id" value="{{$advert->id}}">
                                                    <button id="check-button" class="btn btn-check">Check</button>
                                                    <div id="sorry-info">
                                                        <p><span class="glyphicon glyphicon-info-sign"></span> Sorry, the item can't be delivered to your location</p>
                                                    </div>
                                                    <div id="can-info">
                                                        <p><span class="glyphicon glyphicon-ok-circle"></span> Can be delivered to <span id="write-postcode"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="des-postage">
                                        <h3>Returns policy</h3>
                                        <div class="postage-info">
                                            <p>Returns accepted</p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>After receiving the item, cancel the purchase within</th>
                                                        <th>Return postage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>30 days</td>
                                                        <td>Buyer pays return postage</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tap-pay" class="tab-pane fade">
                            <div class="row">
                                 <div class="col-sm-12">
                                    <h3>Payments</h3>
                                    <div class="col-sm-3 meta-bold">
                                                    Payments:
                                    </div>
                                    <div class="col-sm-9 meta-info">
                                        <p>
                                            @if($advert->user!==null)
                                            <a href="/download-mobile-apps/">
                                                <img class="payments-methods" src="/css/payments.png">
                                            </a> or 
                                            @endif
                                            Cash on collection
                                        </p>
                                    </div>
                                </div>
                                @if($advert->user!==null)
                                <div class="col-sm-12">
                                    <form action="/user/ad/sale">
                                        <input name="id" type="hidden" value="3471510">
                                        <button type="submit" class="btn-info btn">Buy it now</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div id="tap-terms" class="tab-pane fade">
                            <div class="row">           
                                <div class="col-sm-12">
                                    <h3>Terms and conditions of the sale</h3>
                                    <div class="terms-info">
                                        <p>Your shipping address must match your PayPal address. Please note once you complete the checkout process, we will not be able to amend or cancel your order.<br>
                                        If you want change shipping address,please change it before you make payment as we can not change the address later.  We can not check your messsages on order notes regarding address change or other information.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="reviews-ratings">
                        <div class="row click-title">
                            <div class="col-sm-offset-6 col-sm-6">
                                <p>Click below to:</p>
                            </div>
                        </div>
                        <div class="row section-title">
                            <div class="col-md-6 col-sm-6 title">
                                <h3>Ratings and reviews</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 tab-buttons">
                                <a class="btn btn-default btn-review" href="#make-review">
                                    Write reviews
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-3 tab-buttons">
                                <a class="btn btn-default btn-rate" href="#make-rate">
                                    Rate
                                </a>
                            </div>
                        </div>
                            <div id="make-rate">
                                <div class="row">
                                    <form id="reviews-form" autocomplete="off">
                                    <div class="col-md-5">
                                        <h2>Rate this Advertiser(required)</h2>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="reviews-stars-widget">
                                            <div class="rating">
                                                <fieldset>
                                                    <legend class="clipped full">
                                                        Rate this Advertiser (required)
                                                    </legend>
                                                    <input type="radio" title="Excellent" id="star5" name="rating" value="5" class="full">
                                                    <label for="star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="star4" name="rating" value="4" class="full">
                                                    <label for="star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="star3" name="rating" value="3" class="full">
                                                    <label for="star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="star2" name="rating" value="2" class="full">
                                                    <label for="star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="star1" name="rating" value="1" class="full">
                                                    <label for="star1" title="Terrible" class="full">
                                                        <span class="clipped">1 stars</span>
                                                    </label>
                                                </fieldset>
                                            </div>
                                            <span class="star-text"></span>
                                            <span class="star-posted">posted</span>
                                            <span class="star-posting">posting...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Tell us more</h3>
                                        <div class="aspects-fieldset">
                                            <div class="aspects-questions">
                                                <span>Feedback</span>
                                                <div class="actions feedback">
                                                    <input type="radio" name="question1" id="question1-pos">
                                                    <label class="btn-gry" for="question1-pos">Positive</label>
                                                    <input type="radio" name="question1" id="question1-neu">
                                                    <label class="btn-gry" for="question1-neu">Neutral</label>
                                                    <input type="radio" name="question1" id="question1-ne">
                                                    <label class="btn-gry" for="question1-ne">Negative</label>
                                                </div>
                                                <div class="reviews-divider"></div>
                                            </div>
                                            <div class="aspects-questions">
                                                <span>Overall Rating</span>
                                                <div class="actions">
                                                    <fieldset>
                                                    <legend class="clipped full">
                                                        Overall Rating (required)
                                                    </legend>
                                                    <input type="radio" title="Excellent" id="over-star5" name="over-rating" value="5" class="full">
                                                    <label for="over-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="over-star4" name="over-rating" value="4" class="full">
                                                    <label for="over-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="over-star3" name="over-rating" value="3" class="full">
                                                    <label for="over-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="over-star2" name="over-rating" value="2" class="full">
                                                    <label for="over-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="over-star1" name="over-rating" value="1" class="full">
                                                    <label for="over-star1" title="Terrible" class="full">
                                                        <span class="clipped">1 stars</span>
                                                    </label>
                                                </fieldset>
                                                </div>
                                                <div class="reviews-divider"></div>
                                            </div>
                                            <div class="aspects-questions">
                                                <span>Fees</span>
                                                <div class="actions">
                                                    <fieldset>
                                                    <legend class="clipped full">
                                                        Fees
                                                    </legend>
                                                    <input type="radio" title="Excellent" id="fees-star5" name="fees-rating" value="5" class="full">
                                                    <label for="fees-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="fees-star4" name="fees-rating" value="4" class="full">
                                                    <label for="fees-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="fees-star3" name="fees-rating" value="3" class="full">
                                                    <label for="fees-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="fees-star2" name="fees-rating" value="2" class="full">
                                                    <label for="fees-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="fees-star1" name="fees-rating" value="1" class="full">
                                                    <label for="fees-star1" title="Terrible" class="full">
                                                        <span class="clipped">1 stars</span>
                                                    </label>
                                                </fieldset>
                                                </div>
                                                <div class="reviews-divider"></div>
                                            </div>
                                            <div class="aspects-questions">
                                                <span>Professional</span>
                                                <div class="actions">
                                                    <fieldset>
                                                    <legend class="clipped full">
                                                        Professional
                                                    </legend>
                                                    <input type="radio" title="Excellent" id="pro-star5" name="pro-rating" value="5" class="full">
                                                    <label for="pro-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="pro-star4" name="pro-rating" value="4" class="full">
                                                    <label for="pro-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="pro-star3" name="pro-rating" value="3" class="full">
                                                    <label for="pro-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="pro-star2" name="pro-rating" value="2" class="full">
                                                    <label for="pro-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="pro-star1" name="pro-rating" value="1" class="full">
                                                    <label for="pro-star1" title="Terrible" class="full">
                                                        <span class="clipped">1 stars</span>
                                                    </label>
                                                </fieldset>
                                                </div>
                                                <div class="reviews-divider"></div>
                                            </div>
                                            <div class="aspects-questions">
                                                <span>Speed of Service</span>
                                                <div class="actions">
                                                    <fieldset>
                                                    <legend class="clipped full">
                                                        Speed of Service
                                                    </legend>
                                                    <input type="radio" title="Excellent" id="speed-star5" name="speed-rating" value="5" class="full">
                                                    <label for="speed-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="speed-star4" name="speed-rating" value="4" class="full">
                                                    <label for="speed-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="speed-star3" name="speed-rating" value="3" class="full">
                                                    <label for="speed-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="speed-star2" name="speed-rating" value="2" class="full">
                                                    <label for="speed-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="speed-star1" name="speed-rating" value="1" class="full">
                                                    <label for="speed-star1" title="Terrible" class="full">
                                                        <span class="clipped">1 stars</span>
                                                    </label>
                                                </fieldset>
                                                </div>
                                                <div class="reviews-divider"></div>
                                            </div>
                                            <div class="aspects-questions">
                                                <span>Knowledgeable</span>
                                                <div class="actions">
                                                    <fieldset>
                                                    <legend class="clipped full">
                                                        Knowledgeable
                                                    </legend>
                                                    <input type="radio" title="Excellent" id="kwon-star5" name="know-rating" value="5" class="full">
                                                    <label for="kwon-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="kwon-star4" name="know-rating" value="4" class="full">
                                                    <label for="kwon-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="kwon-star3" name="know-rating" value="3" class="full">
                                                    <label for="kwon-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="kwon-star2" name="know-rating" value="2" class="full">
                                                    <label for="kwon-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="kwon-star1" name="know-rating" value="1" class="full">
                                                    <label for="kwon-star1" title="Terrible" class="full">
                                                        <span class="clipped">1 stars</span>
                                                    </label>
                                                </fieldset>
                                                </div>
                                                <div class="reviews-divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <div  class="row">
                                    <div class="col-sm-12 submit">
                                        <a href="#" class="cancel-review">Cancel</a>
                                        <button class="btn btn-default btn-submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="make-review">
                                <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>Write your review</h2>
                                        <div class="review-content-section">
                                            <div class="input-elem-textbox">
                                                <span class="title-counter">150</span>
                                                <input name="wr-title" type="text" maxlength="150" size="150" placeholder="Title your review" title="Title your review">
                                            </div>
                                            <div class="input-elem-textbox">
                                                <span class="content-counter">500</span>
                                                <textarea name="wr-content" contenteditable="true" tabindex="0" spellcheck="true" maxlength="5000" placeholder="Write your review" title="Write your review" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="row">
                                    <div class="col-sm-12 submit">
                                        <a href="#" class="cancel-review">Cancel</a>
                                        <button class="btn btn-default btn-submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="ratings">
                            <div class="row content-reviews border-top-transparent">
                                <div class="col-md-6 col-sm-6 col-xs-12 rating-stars">
                                <div class="col-lg-4 col-md-12 col-sm-5 col-ratings rating-avg">
                                    <h1>5.0</h1>
                                    <div class="stars">
                                        <span>
                                            <i class="fullstar"></i>
                                            <i class="fullstar"></i>
                                            <i class="fullstar"></i>
                                            <i class="fullstar"></i>
                                            <i class="fullstar"></i>
                                        </span>
                                    </div>
                                    <span class="reviews-count">
                                        Reviews ratings
                                    </span>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-7 col-ratings histogram">
                                    <ul class="reviews-list">
                                        <li>
                                            <div class="reviews-item">
                                                <!-- <i class="empty-star"></i> -->
                                                <div class="reviews-item-l">
                                                    <p>Overall Rating</p>
                                                </div>
                                                <div class="reviews-item-r">
                                                    <div class="stars">
                                                        <span>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                        </span>
                                                    </div>
                                                    <span>3</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="reviews-item">
                                                <!-- <i class="empty-star"></i> -->
                                                 <div class="reviews-item-l">
                                                    <p>Fees</p>
                                                </div>
                                                <div class="reviews-item-r">
                                                    <div class="stars">
                                                        <span>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                        </span>
                                                    </div>
                                                    <span>3</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="reviews-item">
                                                <!-- <i class="empty-star"></i> -->
                                                 <div class="reviews-item-l">
                                                    <p>Professional</p>
                                                </div>
                                                <div class="reviews-item-r">
                                                    <div class="stars">
                                                        <span>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                        </span>
                                                    </div>
                                                    <span>3</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="reviews-item">
                                                <!-- <i class="empty-star"></i> -->
                                                 <div class="reviews-item-l">
                                                    <p>Speed of Service</p>
                                                </div>
                                                <div class="reviews-item-r">
                                                    <div class="stars">
                                                        <span>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                        </span>
                                                    </div>
                                                    <span>3</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="reviews-item">
                                                <!-- <i class="empty-star"></i> -->
                                                 <div class="reviews-item-l">
                                                    <p>Knowledgeable</p>
                                                </div>
                                                <div class="reviews-item-r">
                                                    <div class="stars">
                                                        <span>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                            <i class="fullstar"></i>
                                                        </span>
                                                    </div>
                                                    <span>3</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-ratings all-ratings">
                                    <div class="per-wrpr">
                                        <div class="per" data-percent="100%">
                                            <div class="left">
                                                <span style="transform: rotateZ(0deg);"></span>
                                            </div>
                                            <div class="right">
                                                <span></span>
                                            </div>
                                        </div>
                                        <p class="per-title">
                                            Positive
                                        </p>
                                    </div>
                                    <div class="per-wrpr">
                                        <div class="per" data-percent="0%">
                                            <div class="left">
                                                <span style="transform: rotateZ(-180deg);"></span>
                                            </div>
                                            <div class="right">
                                                <span style="transform: rotateZ(-180deg);"></span>
                                            </div>
                                        </div>
                                        <p class="per-title">
                                            Neutral
                                        </p>
                                    </div>
                                    <div class="per-wrpr">
                                        <div class="per" data-percent="0%">
                                            <div class="left">
                                                <span style="transform: rotateZ(-180deg);"></span>
                                            </div>
                                            <div class="right">
                                                <span style="transform: rotateZ(-180deg);"></span>
                                            </div>
                                        </div>
                                        <p class="per-title">
                                            Negative
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reviews">    
                        <div class="row">
                            <div class="col-md-12 title">
                                <h3>Most relevant reviews</h3> 
                            </div>
                            <div class="col-md-4 review">
                                <h4>Excellent Agency</h4>
                                <p>Good services and communication</p>
                                <div class="stars">
                                    <span>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                    </span>
                                </div>
                                <span class="author-by">by</span>
                                <a href="#" class="reviews-item-author">James</a>
                                <span class="review-item-date">15 Apr, 2017</span>
                            </div>
                            <div class="col-md-4 review">
                                <h4>Excellent Agency</h4>
                                <p>Good services and communication</p>
                                <div class="stars">
                                    <span>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                    </span>
                                </div>
                                <span class="author-by">by</span>
                                <a href="#" class="reviews-item-author">Anthony</a>
                                <span class="review-item-date">08 Jun, 2017</span>
                            </div>
                            <div class="col-md-4 review">
                                <h4>Excellent Agency</h4>
                                <p>Good services and communication</p>
                                <div class="stars">
                                    <span>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                    </span>
                                </div>
                                <span class="author-by">by</span>
                                <a href="#" class="reviews-item-author">Sophie</a>
                                <span class="review-item-date">08 Sep, 2017</span>
                            </div>
                            <div class="col-md-12 read-more-reviews">
                                <h3>Read more<span class="glyphicon glyphicon-chevron-down"></span></h3>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            <div class="col-md-4 col-sm-12">
                <div class="row">
                @if($advert->has_param('sold'))
                <div class="sold-div">
                    <!-- <img class="sold-picture" src="/css/sold.jpg"> -->
                    SOLD
                </div>
                @elseif($advert->category->can_ship())
                <div class="title-advert">
                    <h2 class="item-name">{{$product['title']}}</h2>
                </div>
                <div class="delivery-options">
                        @if($advert->category->has_price())
                            <div class="collection-options">
                                <div class="items-box-price font-5">£ {{number_format($product['meta']['price'] / 100, 0, '.', ',')}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                                </div>
                                @if($advert->user !== null)
                                <form action="/user/ad/sale">
                                    <input name="id" type="hidden" value="{{$advert->id}}">
                                    <button type="submit" class="btn-info btn">Buy it now</button>
                                </form>
                                <hr>
                                @endif
                                <a href="#" class="btn btn-info">Make offer</a>
                            </div>
                        @endif
                </div>
                <div class="seller-options">
                    <ul>
                        <li>Zero customs charges</li>
                        <li>Located in United Kindom</li>
                        <li>Best Offer available</li>
                    </ul>
                </div>
                @endif
                </div>
                <div class="row">
                    <div class="shipping-r">
                        <h3>Postage options</h3>
                        <div class="shipping-options">
                            <p><strong>Location:</strong> {{$product['location_name']}}</p>
                            <div class="postage-option">
                                <span class="postage-price">
                                    FREE
                                </span>
                                <span class="postage-type">Collection in person</span>
                            </div>
                            @if($advert->has_param('candeliver')&&$advert->param('candeliver')===1)
                            <div class="postage-option">
                                <span class="postage-price">
                                    £{{$advert->delivery()}}
                                </span>
                                <span class="postage-type">Local Delivery</span>
                            </div>
                            @endif
                            @if($advert->has_param('canship')&&$advert->param('canship')===1)
                            <div class="postage-option">
                                <span class="postage-price">
                                    £{{$advert->shipping_cost()}}
                                </span>
                                <span class="postage-type">United Kingdom Shipping</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="payments-r">
                        <h3>Payments</h3>
                        <div class="payment-options">
                            @if($advert->user!==null)
                            <div class="payment-option cards">
                                <img class="payments-methods" src="/css/payments.png">
                            </div>
                            <hr>
                            @endif
                            <div class="payment-option hands">
                                <h4>Cash on collection</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="buttons">
                    <div class="details">
                        <h3>This advert is by</h3>
                        @if($advert->user!==null)
                            <div class="profile-picutre">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$advert->user->image}}">
                            </div>
                        @endif
                            <div class="user-details">
                                <p><strong>{{$product['username']}}</strong></p>
                                <address>
                                    {{$product['location_name']}}  
                                </address>
                                @if($advert->user!==null)
                                    <p><a class="advert-user" href="/userads/{{$advert->user->id}}">View other adverts from this Advertiser</a></p>
                                @endif
                            </div>
                    </div>
                    <div class="contact">
                        <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a>
                        <p>Or</p>
                        <a href="/download-mobile-apps/" class="btn btn-default">Call</a>
                    </div>
                    <ul class="list-group">
                        @if($advert->has_param('phone'))
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-earphone"></span>
                            @if($srn)
                                {{$advert->param('phone')}}
                            @else
                                {{substr($advert->param('phone'),0,5)}}XXXXXX
                                <span class="reveal-phone">
                                    <a class="btn btn-default" href="/p/r/{{$advert->category_id}}/{{$advert->id}}">Reveal</a>
                                </span>
                            @endif
                        </li>
                        @endif
                        <li class="list-group-item">
                            <span class="@if(!Auth::guest()&&Auth::user()->is_favorite($advert->id)) heart @else heart-empty @endif favroite-icon" data-id="{{$advert->id}}"></span>Save
                        </li>
                        <!-- <li class="list-group-item">
                            <span class="glyphicon glyphicon-pencil"></span>
                            Add notes
                        </li> -->
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-print"></span>
                            Print
                        </li>
                        <li class="list-group-item">
                            <span class="email-icon"><img src="/css/icons/email.svg"></span>

                            Email to friend
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="share">
                    <h3>Share this advert</h3>
                    <div class=" media">
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/facebook.svg"></a></div>
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/twitter.svg"></a></div>
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/instagram.png"></a></div>
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/pinterest.svg"></a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="report">
                    <h3>Report this Ad</h3>
                    <a href="#" class="btn btn-default">Report</a>
                </div>
            </div>
            <div class="row">
                <div class="similar-adverts">
                    <h3>Similar Adverts</h3>
                    <div class="clearfix listings-adverts">
                    @foreach($products as $product)
                    <a href="/p/{{$category->id}}/{{$product['source_id']}}">
                        <div class="col-sm-6">
                            <div class="advert-img">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{isset($product['images'][0]) ? $product['images'][0] : 'noimage.png' }}?1500586448">
                            </div>
                            <div class="advert-details">
                                <h4>{{$product['title']}}</h4>
                                @if($product['meta']['price'] > 0)
                                    <h4 class="items-box-price font-6">£{{number_format($product['meta']['price'] / 100)}} {{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</h4>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    var timer = null;

    $("#check-button").click(function () {
        var id =$('#id').val();
        var postcode=$('#postcode').val();
        axios.get('/user/p/deliver/'+id, {
            params: {postcode: postcode}
        })
            .then(function (response) {
                console.log(response);
                if(response.data.can){
                    $('#can-info').show();
                    $('#write-postcode').html(postcode);
                    $('#sorry-info').hide();
                }else{
                    $('#sorry-info').show();
                    $('#can-info').hide();
                }

            })
            .catch(function (error) {
                console.log(error);

            });
    });
    $('#edit-post').click(function () {
        $('#check-div').show();
        $('#delivery-info').hide();
    });
    
    $('a[href="#tap-map"]').click(function(e){
        e.preventDefault();
        $('.nav-tabs a[href="#tap-map"]').tab('show');
    });
    $('a[href="#tap-map"]').on('shown.bs.tab', function () {
        console.log("load maps tab");
        x = map.getZoom();
        c = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        google.maps.event.trigger(panorama, 'resize');
        map.setZoom(x);
        map.setCenter(c);
    });
    $('input[type=radio][name=options]').change(function(){
        if(this.id == "option-view"){
            console.log("change to panorama");
            $('.info-map').hide();
            $('.info-pano').show();
            google.maps.event.trigger(panorama, 'resize');
        }
        else{
           console.log("change to map");
            $('.info-map').show();
            $('.info-pano').hide(); 
        }
        
    })
    $('#tap-marketinfo input[type=radio][name=options]').change(function(){
        $('.nearby-tabs-content .tab-active').removeClass('tab-active');
        $('.' + this.id).addClass('tab-active');
    })
    $('.tab-buttons .btn-default').click(function(e){
        var div = $(this).attr('href');
        e.preventDefault();
        $('.tab-buttons .btn-default.active').removeClass('active');
        $(this).addClass('active');
        $('.active-make').removeClass('active-make');   
        $('.row.content-reviews').removeClass('border-top-transparent');
        
        //Is best add class active, need change
        $(div).addClass('active-make');
    });
    $('.cancel-review').click(function(e){
        e.preventDefault();
        $('.actions input:radio').prop('checked', false);
        $('.active-make').removeClass('active-make');
        $('.tab-buttons .btn-default.active').removeClass('active');
        $('.row.content-reviews').addClass('border-top-transparent');
    })
    
    $('.input-elem-textbox input, .input-elem-textbox textarea').focus(function(){
        $(this).prev().css('visibility','visible');
    });
    $('.input-elem-textbox input, .input-elem-textbox textarea').focusout(function(){
        $(this).prev().css('visibility','hidden');
    });
    $('.input-elem-textbox input').keydown(function(e){
            var value = $(this).val();
            var lessCount = 150 - value.length;
            $(this).prev().text(lessCount);
    });
    $('.input-elem-textbox textarea').keydown(function(e){
           var value = $(this).val();
            var lessCount = 5000 - value.length;
            $(this).prev().text(lessCount);
    });
    
    
    function isUnderground(types){
        return types.indexOf('tube') != -1;
    }
    function isRail(types){
        for (var i = 0; i < types.length; i++) {
            if(types[i].modeName == "national-rail" || types[i].modeName == "tflrail")
                return true;
        }
        return false;
    }
    function isOverground(types){
        return types.indexOf('overground') != -1;
    }
    function isBus(types){
        return types.indexOf('bus') != -1;
    }
    function isDlr(types){
        return types.indexOf('dlr') != -1;
    }
    function getStationHtml(dict){
        var textHtml = "";
        for(key in dict){
            textHtml += dict[key] + "\n";
        }
        return textHtml;
    }
    function processStops(stops){
        var aux;
        var stations = [];
        var distance;
        console.log(stops);
        for(i = 0; i < stops.length; i++){
            aux = "";
            if(isRail(stops[i].lineModeGroups)){
                aux += "<i class=\"icon-transport icon-rail\"></i>";
            }
            if(isUnderground(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-underground\"></i>";
            }
            if(isOverground(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-overground\"></i>";
            }
            if(isDlr(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-dlr\"></i>";
            }
            if(isBus(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-bus\"></i>";
            }
            distance = parseFloat(stops[i].distance / 1600).toFixed(2);
            aux = "<li>" + aux + "<span>" + stops[i].commonName + " <small>(" + distance + " mi)</small></span></li>";
            var length;
            if(typeof(stations[stops[i].commonName]) != "undefined"){
                length = stations[stops[i].commonName].length
                if(aux.length > length){
                    stations[stops[i].commonName] = aux;
                }
            }
            else
                stations[stops[i].commonName] = aux;
        }
        var stationsList = getStationHtml(stations);
        $('.stations-list').html(stationsList);
    }

    function getTransport(lat, lng) {
    // See Parsing the Results for
    // the basics of a callback function.
        $.ajax({
            url: "https://api.tfl.gov.uk/Place?type=NaptanMetroStation,NaptanRailStation&lat=" + lat + "&lon=" + lng + "&categories=Description&radius=1500&app_id=2d80416f&app_key=31f4c6d3a317c8de56f699bb3aff9af2",
            dataType: "json",
            type: "GET",
        }).done(function(data, textStatus){
            var places = data.places;
            processStops(places);
        }).fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) {
                console.log( "Error get stations: " +  textStatus);
            }
        });
    }
    $(function () {
        var viewer = ImageViewer();
        $('.small-image').first().addClass('selected');
        $('.images-current').click(function (e) {
            e.preventDefault();
            if(timer != null){
                var element = $('.icon-before');
                stopAnimationGallery(element);
            }
            var imgSrc = $('#image-active').attr('src'),
                highResolutionImage = $('image-active').data('high-res-img');
            viewer.show(imgSrc, highResolutionImage);
        });
    });


</script>




@endsection
