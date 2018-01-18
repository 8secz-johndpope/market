<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', $product['title'] . ' | '. env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('styles')
<link href="{{ asset('/css/property.css?q=874') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<script src="/js/imageviewer.min.js"></script>
<div class="body background-body">
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
                <h2 class="item-name">{{$product['title']}}</h2>
                <div class="col-sm-9 location-name">
                    <p>{{$product['location_name']}}</p>
                </div>
                <div class="col-sm-3">
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
                    </div>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators 
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                           @foreach($counts as $number)
                                <li data-target="#myCarousel" data-slide-to="{{$number}}"></li>
                            @endforeach
                        </ol> -->

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
                        <div class="request-details">
                            <a href="/download-mobile-apps/" class="btn btn-default">Call</a>
                            <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a>
                            
                            <a href="/download-mobile-apps/" class="btn btn-default">VideoCall</a>
                        </div>
                    </div>
                    <div id="tabs"> 
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
                        <li><a data-toggle="tab" href="#tap-floorplan">Floorplan</a></li>
                        <li><a data-toggle="tab" href="#tap-map">Map & Street View</a></li>
                        @if($advert->category->is_property_for_sale())
                            <li><a data-toggle="tab" href="#tap-marketinfo">Market Info</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div id="tab-description" class="tab-pane fade in active">
                            <div class="content">
                                <div class="col-sm-8 left-content">
                                    @if($category->can_rent())
                                        <h3>Letting information:</h3>
                                    @endif
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
                                            <div class="col-sm-6 meta-bold">
                                                Payments:
                                            </div>
                                            <div class="col-sm-6 meta-info">
                                                <a href="/download-mobile-apps/"> <img class="payments-methods" src="/css/payments.png"></a>
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
                                        @if($advert->category->is_property_for_sale() && $advert->has_meta('property_tenure'))
                                        <div class="sec">
                                            <p><strong>Tenure: </strong>{{$advert->meta('property_tenure')}}</p>
                                        </div>
                                        @endif

                                      {!! $product['description'] !!}

                                    </div>
                                </div>
                                <div class="col-sm-4 right-content">
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
                                </div>
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
                        <div id="tap-floorplan" class="tab-pane fade">
                            <div class="row">           
                                <div class="col-sm-12 foorplan">
                                    @if($advert->has_meta('property_floorplan'))    
                                    <img src="{{$advert->meta('property_floorplan')}}">
                                    @else
                                    <h3>This advert does not have a floor plan</h3>
                                     @endif
                                </div>
                            </div>
                        </div>
                        @if($advert->category->is_property_for_sale())
                        <div id="tap-marketinfo" class="tab-pane fade">
                            <div class="row history-sale">           
                                <div class="col-sm-12  marketinfo">
                                    <h3>This property's sale history</h3>
                                    <div class="table-history">
                                        <table class="nearby-similar-history-table">
                                            <thead>
                                                <tr>
                                                    <th>Date Sold</th>
                                                    <th>Sold Price</th>
                                                    <th class="text-center">Price Difference</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>25 Oct 2006</td>
                                                    <td>£ 385,000</td>
                                                    <td class="text-center price-difference">+6%</td>
                                                </tr>
                                                <tr>
                                                    <td>23 Jul 2001</td>
                                                    <td>£ 360,000</td>
                                                    <td class="text-center price-difference"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="acknowledgment">  
                                        <small>
                                            Source acknowledgement: House price data producted by the Land Registry.
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row similar-nearby">           
                                <div class="col-sm-12 ">
                                    <h3>Similar nearby properties</h3>
                                    <div class="options-buttons">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary active">
                                                <input type="radio" name="options" id="option-sale" autocomplete="off" checked="">For sale
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" id="option-under" autocomplete="off">
                                                Under offer
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" id="option-sold" autocomplete="off">
                                                Sold
                                            </label>
                                        </div>
                                    </div>
                                    <div class="nearby-tabs-content">
                                        <div class="nearby-properties-list option-sale tab-active">
                                             <span>These are the nearset properties on the market with the same number of bedrooms.</span>
                                             <div class="nearby-list">
                                            @foreach($similar as $product)
                                                <div class="col-sm-12 nearby-item">
                                                    <a href="/p/{{$category->id}}/{{$product['source_id']}}">
                                                        <div class="advert-details">
                                                            @if($product['meta']['price'] > 0)
                                                                <span class="items-box-price font-7">£{{number_format($product['meta']['price'] / 100)}} {{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</span>
                                                            @endif
                                                            <h4>{{$product['location_name']}}</h4>
                                                            <span class="nearby-distance">Within {{number_format($product['distance'], 2,'.', ',')}} miles</span>
                                                        </div>
                                                    </a>
                                                    <div id="car-{{$product['source_id']}}" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @if(isset($product['images'][0]))
                                                            <div class="item active">
                                                                <div class="advert-img">
                                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$product['images'][0]}}?1500586448">
                                                                </div>
                                                            </div>

                                                            @for($i=1; $i < count($product['images']); $i++)
                                                                <div class="item">
                                                                    <div class="advert-img">
                                                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$product['images'][$i]}}?1500586448">
                                                                    </div>
                                                                </div>
                                                            @endfor
                                                            @else
                                                             <div class="item">
                                                                <div class="advert-img">
                                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{isset($product['images'][0]) ? $product['images'][0] : 'noimage.png' }}?1500586448">
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="nearby-img-navigation">
                                                            <a href="#car-{{$product['source_id']}}" class="left"><span class="glyphicon glyphicon-chevron-left"></a>
                                                            <span><span class="index">1</span> of {{count($product['images'])}}</span>
                                                            <a href="#car-{{$product['source_id']}}" class="right"><span class="glyphicon glyphicon-chevron-right"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="nearby-properties-list option-under">
                                             <span>These are the nearest properties with the same number of bedrooms which are sold subject to contract.</span>
                                             <div class="nearby-list">
                                            @foreach($similarUnder as $product)
                                                <div class="col-sm-12 nearby-item">
                                                    <a href="/p/{{$category->id}}/{{$product['source_id']}}">
                                                        <div class="advert-details">
                                                            @if($product['meta']['price'] > 0)
                                                                <span class="items-box-price font-7">£{{number_format($product['meta']['price'] / 100)}} {{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</span>
                                                            @endif
                                                            <h4>{{$product['location_name']}}</h4>
                                                            <span class="nearby-distance">Within {{number_format($product['distance'], 2,'.', ',')}} miles</span>
                                                        </div>
                                                    </a>
                                                    <div id="car-{{$product['source_id']}}" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @if(isset($product['images'][0]))
                                                            <div class="item active">
                                                                <div class="advert-img">
                                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$product['images'][0]}}?1500586448">
                                                                </div>
                                                            </div>

                                                            @for($i=1; $i < count($product['images']); $i++)
                                                                <div class="item">
                                                                    <div class="advert-img">
                                                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$product['images'][$i]}}?1500586448">
                                                                    </div>
                                                                </div>
                                                            @endfor
                                                            @else
                                                             <div class="item">
                                                                <div class="advert-img">
                                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{isset($product['images'][0]) ? $product['images'][0] : 'noimage.png' }}?1500586448">
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="nearby-img-navigation">
                                                            <a href="#car-{{$product['source_id']}}" class="left"><span class="glyphicon glyphicon-chevron-left"></a>
                                                            <span><span class="index">1</span> of {{count($product['images'])}}</span>
                                                            <a href="#car-{{$product['source_id']}}" class="right"><span class="glyphicon glyphicon-chevron-right"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        @endif
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
                                    Write a review
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
                                    <div class="col-md-5">
                                        <h2>Rate this Advertiser(required)</h2>
                                    </div>
                                    <div class="col-md-5">

                                    </div>
                                </div>
                                <div class="row">
                                    <form action="/user/rate/ad" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$advert->user_id}}">
                                    <div class="col-md-12">
                                        <h3>Tell us more</h3>
                                        <div class="aspects-fieldset">
                                            <div class="aspects-questions">
                                                <span>Feedback</span>
                                                <div class="actions feedback">
                                                    <input type="radio" name="feedback" id="question1-pos" value="1">
                                                    <label class="btn-gry" for="question1-pos">Positive</label>
                                                    <input type="radio" name="feedback" id="question1-neu" value="2">
                                                    <label class="btn-gry" for="question1-neu">Neutral</label>
                                                    <input type="radio" name="feedback" id="question1-ne" value="3">
                                                    <label class="btn-gry" for="question1-ne">Negative</label>
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
                                                    <input type="radio" title="Excellent" id="fees-star5" name="fees_rating" value="5" class="full">
                                                    <label for="fees-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="fees-star4" name="fees_rating" value="4" class="full">
                                                    <label for="fees-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="fees-star3" name="fees_rating" value="3" class="full">
                                                    <label for="fees-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="fees-star2" name="fees_rating" value="2" class="full">
                                                    <label for="fees-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="fees-star1" name="fees_rating" value="1" class="full">
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
                                                    <input type="radio" title="Excellent" id="pro-star5" name="professional_rating" value="5" class="full">
                                                    <label for="pro-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="pro-star4" name="professional_rating" value="4" class="full">
                                                    <label for="pro-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="pro-star3" name="professional_rating" value="3" class="full">
                                                    <label for="pro-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="pro-star2" name="professional_rating" value="2" class="full">
                                                    <label for="pro-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="pro-star1" name="professional_rating" value="1" class="full">
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
                                                    <input type="radio" title="Excellent" id="speed-star5" name="speed_rating" value="5" class="full">
                                                    <label for="speed-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="speed-star4" name="speed_rating" value="4" class="full">
                                                    <label for="speed-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="speed-star3" name="speed_rating" value="3" class="full">
                                                    <label for="speed-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="speed-star2" name="speed_rating" value="2" class="full">
                                                    <label for="speed-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="speed-star1" name="speed_rating" value="1" class="full">
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
                                                    <input type="radio" title="Excellent" id="kwon-star5" name="knowledge_rating" value="5" class="full">
                                                    <label for="kwon-star5" title="Excellent" class="full">
                                                        <span class="clipped">5 stars</span>
                                                    </label>
                                                    <input type="radio" title="Good" id="kwon-star4" name="knowledge_rating" value="4" class="full">
                                                    <label for="kwon-star4" title="Good" class="full">
                                                        <span class="clipped">4 stars</span>
                                                    </label>
                                                    <input type="radio" title="Okay" id="kwon-star3" name="knowledge_rating" value="3" class="full">
                                                    <label for="kwon-star3" title="Okay" class="full">
                                                        <span class="clipped">3 stars</span>
                                                    </label>
                                                    <input type="radio" title="Unsatisfactory" id="kwon-star2" name="knowledge_rating" value="2" class="full">
                                                    <label for="kwon-star2" title="Unsatisfactory" class="full">
                                                        <span class="clipped">2 stars</span>
                                                    </label>
                                                    <input type="radio" title="Terrible" id="kwon-star1" name="knowledge_rating" value="1" class="full">
                                                    <label for="kwon-star1" title="Terrible" class="full">
                                                        <span class="clipped">1 stars</span>
                                                    </label>
                                                </fieldset>
                                                </div>
                                                <div class="reviews-divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="row">
                                    <div class="col-sm-12 submit">
                                        <a href="#" class="cancel-review">Cancel</a>
                                        <button class="btn btn-default btn-submit" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                </form>

                            </div>
                            <div id="make-review">
                                <form action="/user/write/review" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$advert->user_id}}">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <h2>Write your review</h2>
                                        <div class="review-content-section">
                                            <div class="input-elem-textbox">
                                                <span class="title-counter">150</span>
                                                <input name="title" type="text" maxlength="150" size="150" placeholder="Title your review" title="Title your review">
                                            </div>
                                            <div class="input-elem-textbox">
                                                <span class="content-counter">500</span>
                                                <textarea name="review" contenteditable="true" tabindex="0" spellcheck="true" maxlength="5000" placeholder="Write your review" title="Write your review" ></textarea>
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
                                @if($advert->user_id>0&&$advert->user->ratings()->count()>0)

                                <div class="row content-reviews border-top-transparent">

                                <div class="col-md-6 col-sm-6 col-xs-12 rating-stars">
                                <div class="col-lg-4 col-md-12 col-sm-5 col-ratings rating-avg">
                                    <h1>{{number_format(((int)($advert->user->ratings()->sum('overall_rating')/$advert->user->ratings()->count()))/10, 1)}}</h1>
                                    <div class="stars">
                                        <span>
                                            @for($i=0; $i < ((int)($advert->user->ratings()->sum('overall_rating')/$advert->user->ratings()->count()))/10; $i++)
                                                <i class="fullstar"></i>
                                            @endfor
                                            @for($i; $i < 5; $i++)
                                                <i class="emptystar"></i>
                                            @endfor
                                            <!-- <i class="fullstar"></i>
                                            <i class="fullstar"></i>
                                            <i class="fullstar"></i> -->
                                        </span>
                                    </div>
                                    <span class="reviews-count">
                                        Overall Rating
                                    </span>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-7 col-ratings histogram">
                                    <ul class="reviews-list">
                                        <li>
                                            <div class="reviews-item">
                                                <!-- <i class="empty-star"></i> -->
                                                 <div class="reviews-item-l">
                                                    <p>Fees</p>
                                                </div>
                                                <div class="reviews-item-r">
                                                    <div class="stars">
                                                        <span>
                                                            @for($i=0; $i < ((int)($advert->user->ratings()->sum('fees_rating')/$advert->user->ratings()->count()))/10; $i++)
                                                            <i class="fullstar"></i>
                                                            @endfor
                                                            @for($i; $i < 5; $i++)
                                                               <i class="emptystar"></i> 
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <span>{{((int)($advert->user->ratings()->sum('fees_rating')/$advert->user->ratings()->count()))/10}}</span>
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
                                                            @for($i=0; $i < ((int)($advert->user->ratings()->sum('professional_rating')/$advert->user->ratings()->count()))/10; $i++)
                                                            <i class="fullstar"></i>
                                                            @endfor
                                                            @for($i; $i < 5; $i++)
                                                                <i class="emptystar"></i>
                                                            @endfor
                                                            
                                                        </span>
                                                    </div>
                                                    <span>{{((int)($advert->user->ratings()->sum('professional_rating')/$advert->user->ratings()->count()))/10}}</span>
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
                                                            @for($i=0; $i < ((int)($advert->user->ratings()->sum('speed_rating')/$advert->user->ratings()->count()))/10; $i++)
                                                                <i class="fullstar"></i>
                                                            @endfor
                                                            @for($i; $i < 5; $i++)
                                                                <i class="emptystar"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <span>{{((int)($advert->user->ratings()->sum('speed_rating')/$advert->user->ratings()->count()))/10}}</span>
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
                                                            @for($i = 0; $i < ((int)($advert->user->ratings()->sum('knowledge_rating')/$advert->user->ratings()->count()))/10; $i++)
                                                                <i class="fullstar"></i>
                                                            @endfor
                                                            @for($i; $i < 5; $i++)
                                                                <i class="emptystar"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <span>{{((int)($advert->user->ratings()->sum('knowledge_rating')/$advert->user->ratings()->count()))/10}}</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-ratings all-ratings">
                                    <div class="per-wrpr">
                                        @php
                                            $per = 100*$advert->user->ratings()->where('feedback',1)->count()/$advert->user->ratings()->count();
                                            $deg = ($per * 360) / 100;
                                        @endphp
                                        <div class="per" data-percent="{{$per}}%">
                                            <div class="left">
                                                <span style="transform: rotateZ({{$deg}}deg);"></span>
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
                                        <div class="per" data-percent="{{100*$advert->user->ratings()->where('feedback',2)->count()/$advert->user->ratings()->count()}}%">
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
                                        <div class="per" data-percent="{{100*$advert->user->ratings()->where('feedback',3)->count()/$advert->user->ratings()->count()}}%">
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
                                @else
                                    <p>No Ratings</p>
                                @endif
                        </div>
                        <div class="reviews">    
                        <div class="row">
                            @if($advert->user_id>0)

                            <div class="col-md-12 title">
                                <h3>Most relevant reviews</h3> 
                            </div>
                            @foreach($advert->user->reviews as $review)
                            <div class="col-md-4 review">
                                <h4>{{$review->title}}</h4>
                                <p>{{$review->review}}</p>

                                <span class="author-by">by</span>
                                <a href="#" class="reviews-item-author">{{$review->author->name}}</a>
                                <span class="review-item-date">{{date('d/m/Y',strtotime($review->created_at))}}</span>
                            </div>
                                @endforeach
                            <div class="col-md-12 read-more-reviews">
                                <h3>Read more<span class="glyphicon glyphicon-chevron-down"></span></h3>
                            </div>
                                @else
                                <p>No Reviews</p>
                                @endif
                        </div>
                    </div>
                    </div>
                </div>
            <div class="col-md-4 col-sm-12">
                <div class="row">
                @if($advert->has_param('sold'))
                    <div class="sold-div">
                        <img class="sold-picture" src="/css/sold.jpg">

                    </div>

                @elseif($advert->category->can_ship())
                <div class="delivery-options">
                    @if($advert->has_param('candeliver')&&$advert->param('candeliver')===1)
                        <div id="check-div" @if (!Auth::guest()&& Auth::user()->default_address>0) style="display: none" @endif>
                        <p class="bold-text">Check if it can be delivered to you</p>
                        <span class="red-text" id="sorry-info" style="display: none">Sorry, the item can't be delivered to your location</span>
                        <input class="form-control" placeholder="SW153AZ" name="postcode" id="postcode">
                        <input type="hidden" id="id" value="{{$advert->id}}">
                    <button class="btn btn-default" id="check-button">Check</button>
                        </div>
                    <br>
                        @if (Auth::guest()|| Auth::user()->default_address===0)
                            @else
                            <span><span id="delivery-info" @if(!$advert->can_deliver_to(Auth::user()->address->zip)) style="display: none" @endif>Can be delivered to </span> <span class="red-text" id="s-info" @if($advert->can_deliver_to(Auth::user()->address->zip)) style="display: none" @endif>Cannot be delivered to </span>  <span class="bold-text" id="postcode-text">{{ Auth::user()->address->postcode}} </span>
                           <a id="edit-post">Edit</a></span>

                        @endif
                            <h4>Can Delivery Locally(Within {{$advert->meta('distance')}}  Miles)</h4>
                        <p>Price</p>
                        <span class="bold-text">£{{$advert->price()}}</span><span>+£{{$advert->delivery()}}&nbsp;&nbsp; Delivery</span>
                    <br><br>
                        <form action="/user/ad/sale" method="post">
                            <input name="id" type="hidden" value="{{$advert->id}}">
                            <input name="type" type="hidden" value="0">
                            {{ csrf_field() }}
                        <button type="submit" class="btn-primary btn">Order to Deliver</button>
                        </form>
                        @endif
                        @if($advert->has_param('canship')&&$advert->param('canship')===1)
                            <h4>Can Ship Nationwide</h4>
                            <p>Price</p>
                            <span class="bold-text">£{{$advert->price()}}</span><span>+£{{$advert->shipping()}}&nbsp;&nbsp; Shipping</span>
                            <br><br>
                            <form action="/user/ad/sale" method="post">
                                <input name="id" type="hidden" value="{{$advert->id}}">
                                <input name="type" type="hidden" value="1">
                                {{ csrf_field() }}
                            <button type="submit"  class="btn-success btn">Order to Ship</button>
                            </form>

                        @endif

                        @if($advert->category->has_price())

                            <div class="collection-options">
                                <h4>Near to Seller, liked the item?</h4>
                                <form action="/user/ad/sale" method="post">
                                    <input name="id" type="hidden" value="{{$advert->id}}">
                                    <input name="type" type="hidden" value="2">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn-info btn">Purchase</button>
                                </form>
                                <p>Once you agree to buy, the seller will handover the item and get paid</p>
                            </div>
                        @endif
                </div>
                @endif
                    @if($advert->category->can_apply())
                        <div class="apply-options">
                            @if (Auth::guest())
                                <br>
                            <br>
                            You need to login to apply.
                                <a href="/user/redirect/{{$advert->id}}" class="btn btn-primary">Login</a>
                                @elseif(Auth::user()->has_applied($advert->id))
                                <br>
                            <br>
                            <br>
                                <button class="btn-primary btn" disabled>Application Sent</button>
                                @else
                                <form action="/user/jobs/apply" method="post">
                                    <input name="redirect" type="hidden" value="{{$advert->url()}}">
                                    <input name="id" type="hidden" value="{{$advert->id}}">
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="cv">Select a CV</label>
                                    @if(count(Auth::user()->cvs)>0)
                                    <select class="form-control" name="cv" required>
                                        <option value="0">Select</option>
                                        @foreach(Auth::user()->cvs as $cv)
                                            <option value="{{$cv->id}}">{{$cv->title}}</option>
                                        @endforeach
                                    </select>
                                        @else
                                        <input type="hidden" id="title" value="{{$advert->category->title}}">

                                        <input type="hidden" id="category" value="{{$advert->category_id}}">
                                        <input type="file" class="form-control-file" id="upload-cv">
                                    @endif
                                </div>
                                    <div class="form-group">
                                        @if(count(Auth::user()->covers)>0)

                                        <label for="cover">Select a Cover Letter</label>
                                        <select class="form-control" name="cover" required>
                                            <option value="0">Select</option>
                                            @foreach(Auth::user()->covers as $cover)
                                                <option value="{{$cover->id}}">{{$cover->title}}</option>
                                            @endforeach
                                        </select>
                                            @else
                                            <label for="cover">Cover Letter</label>
                                            <input type="hidden" name="ctitle" value="{{$advert->category->title}}">
                                            <textarea name="ctext" class="form-control" rows="3"></textarea>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </form>


                            @endif
                        </div>
                            @endif


                <div class="buttons">
                    <div class="details">
                        <h3>This property is marketed by</h3>
                        @if($advert->user!==null)
                        <div class="profile-picutre">
                            <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{isset($advert->user->bussines) ? $advert->user->business->logo : $advert->user->image}}">
                        </div>
                        <div class="user-details">
                            <p><strong>{{$advert->user->name}}</strong></p>
                            <address>
                            @if(isset($advert->user->address))
                            {{$advert->user->address->line1}}, {{$advert->user->address->city}}, {{$advert->user->address->postcode}}  
                            @endif    
                            </address>
                            @if(isset($advert->user->business))
                            <p class="link-about"><a class="btn btn-default" href="/agent/{{$advert->user->id}}">Learn more about the Advertiser</a></p>
                            @endif
                            <p><a class="advert-user" href="/userads/{{$advert->user->id}}">View other adverts from this Advertiser</a></p>
                        </div>
                        @else
                        <ul class="list-group">
                            <li class="list-group-item"><h4>{{$product['username']}}</h4></li>
                        </ul>
                        @endif
                    </div>
                    <div class="contact">
                        <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a>
                        <p>Or</p>
                        <a href="/download-mobile-apps/" class="btn btn-default">Call</a>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item" data-toggle="modal" data-target="#smsModal">
                            <a href="#" class="action-sms">
                                <span class="sms-icon"><img src="/css/icons/sms.svg"></span></span>
                                Send to Phone
                            </a>
                        </li>
                        <li class="list-group-item">
                            <span class="@if(!Auth::guest()&&Auth::user()->is_favorite($advert->id)) heart @else heart-empty @endif favroite-icon" data-id="{{$advert->id}}"></span>Save property
                        </li>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-pencil"></span>
                            Add notes
                        </li>
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
                    <h3>Share this property</h3>
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
                    <div class="listings-adverts">
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
                    $('#delivery-info').show();
                    $('#postcode-text').html(postcode);
                    $('#check-div').hide();
                    $('#s-info').hide();
                }else{
                    $('#sorry-info').show();
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
    $('#upload-cv').change(function () {
        upload_cv();
    });
    $('.carousel').carousel({
      interval: false
    })
    $('.small-image>a').click(function () {
        if(timer != null){
            var element = $('.icon-before');
            stopAnimationGallery(element);
        }
        var src = $(this).children().first().attr('src');
        $('.selected').removeClass('selected');
        $(this).parent().addClass('selected');
        $('#image-active').attr('src', src);
        var index = $(this).attr('data-index');
        $('#image-active').attr('data-index', index);
        $('.index').text(index);
        var indexCarousel = $('.carousel-inner .item.active').index();
        var firsElementCarousel = indexCarousel * 5; 
        var lastElementCarousel = firsElementCarousel + 5;

        if(lastElementCarousel < (index-1)){
            $("#myCarousel").carousel("next");
        }else if(firsElementCarousel > (index-1)){
            $("#myCarousel").carousel("prev");
        }
    });
    $('.prev>a').click(function () {
        if(timer != null){
            var element = $('.icon-before');
            stopAnimationGallery(element);
        }
        var index = $('#image-active').attr('data-index');
        if(index > 1){
            var children = $('.carousel-inner .item').children();
            $('.selected').removeClass('selected');
            var child = children.eq(index - 2);
            child.addClass('selected');
            var prevImage = child.find('img').attr('src');
            index -= 1
            $('#image-active').attr('data-index', index);
            $('#image-active').attr('src', prevImage);
            $('.index').text(index);
            var indexCarousel = $('.carousel-inner .item.active').index();
            var firsElementCarousel = indexCarousel * 5; 
            var lastElementCarousel = firsElementCarousel + 5;
            if(firsElementCarousel > (index-1)){
                $("#myCarousel").carousel("prev");
            }
        }
    });
    $('.next>a').click(function () {
        if(timer != null){
            var element = $('.icon-before');
            stopAnimationGallery(element);
        }
        changeImageGallery(false);
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

    function addListenerCarousel(parent){
        $(parent + ' .nearby-img-navigation a.left').click(function(e){
            e.preventDefault();
            var carousel = $(this).attr('href');
            $(parent + " " + carousel).carousel("prev");
        });
        $(parent +' .nearby-img-navigation a.right').click(function(e){
            e.preventDefault();
            var carousel = $(this).attr('href');
            $(parent + " " + carousel).carousel("next");
        });
    }
    addListenerCarousel('.option-under');
    addListenerCarousel('.option-sale');

    $('.nearby-item .carousel').on('slid.bs.carousel', function(){
        var index =  $(this).find('.item.active').index();
        $(this).find('.index').text(index + 1);
    });
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
    $('.icon-before').click(function(e){
        e.preventDefault();
        if($(this).hasClass('active-sld')){
            stopAnimationGallery(this);
        }
        else{
            $(this).addClass('active-sld');
            $(this).text('Stop slideshow');
            timer = setInterval(changeImageGallery, 2000);
        }
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
    function stopAnimationGallery(element){
        clearInterval(timer);
        timer = null;
        $(element).removeClass('active-sld');
        $(element).text('Start slideshow');
        console.log('stop animation');
    }
    function changeImageGallery(cycle = true){
        var index = parseInt($('#image-active').attr('data-index'));
        var children = $('.carousel-inner .item').children();
        var numImg = children.length
        console.log("is actived timer");
        if( cycle || index < numImg ){
            $('.selected').removeClass('selected');
            index = index %  (numImg);
            console.log("current: " + index);
            var child = children.eq(index);
            child.addClass('selected');
            var nextImage = child.find('img').attr('src');
            index = index + 1;
            if(cycle && index == 1){
                $("#myCarousel").carousel("next");
            }
            console.log("next: " + index);
            $('#image-active').attr('data-index', index);
            $('#image-active').attr('src', nextImage);
            $('.index').text(index);
            var indexCarousel = $('.carousel-inner .item.active').index();
            var firsElementCarousel = indexCarousel * 5; 
            var lastElementCarousel = firsElementCarousel + 5;
            if(lastElementCarousel < (index)){
                $("#myCarousel").carousel("next");
            }
        }
    }
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
