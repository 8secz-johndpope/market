
@extends('layouts.app')

@section('title', 'Adverts by '. $advertiser->display_name .' | '. env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp

@section('styles')
<link href="{{ asset("/css/ad_by_user.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="body background-body">
    <div class="container-fluid">
        <div class="row container-img-mcontact">
            <div class="col-sm-12">
                <a class="btn btn-make-contact" href="/make-contact/{{$advertiser->id}}">MAKE CONTACT</a>
            </div>
        </div>
        <div class="row container-info">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="container-img-advertiser">
                            <div class="img-advertiser">
                                <img class="circle image-advertiser" src="{{env('AWS_WEB_IMAGE_URL')}}/{{$advertiser->image}}"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="container-info-advertiser">
                            <p class="advertiser-name"><strong>{{$advertiser->name}}</strong></p>
                            @if($advertiser->address)
                            <address>
                                {{$advertiser->address->city}}
                            </address>
                            @endif
                            <span>
                                <span class="glyphicon glyphicon-earphone"></span>
                                {{substr($advertiser->phone,0,5)}}XXXXXX
                            </span>
                            <p><a href="#">Send Message</a></p>
                            <p><a href="#">VideoCall</a></p>
                            <p><a href="#">Call</a></p>
                            @if(isset($advertiser->business))
                            <p><a href="/company/{{$advertiser->id}}" class="btn btn-advertiser">Learn more about the Advertiser</a></p> 
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 back">
                <a href="{{url()->previous()}}">< Go back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="products">
               @foreach($advertiser->adverts as $advert)
               <div class="listing-max-pro">
                    <div class="product">
                        @if(!$advert->category->can_apply())
                        <div class="listing-side">
                            <div class="listing-thumbnail">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

                                @if($advert->featured_expires())
                                    <span class="ribbon-featured">
                                        <strong class="ribbon" data-q="featuredProduct">
                                            <span class="hide-visually">This ad is</span>
                                            Featured
                                        </strong>
                                    </span>
                                @endif

                                <div class="listing-meta txt-sub">
                                    <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($advert->param('images'))}}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="info{{$advert->category->can_apply() ? ' margin-left' : ''}}">
                            <div class="favor">
                                @if (in_array($advert->id,$sids))
                                    <span class="heart favroite-icon" data-id="$advert->id"></span>
                                    <span  class="favor-text" style="display: none">SAVE</span>
                                @else
                                    <span class="heart-empty favroite-icon" data-id="{{$advert->id}}">
                                    </span>
                                    <span  class="favor-text">SAVE</span>
                                @endif
                            </div>
                            <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->sid}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>
                            <span class="listing-location">
                                {{$advert->param('location_name')}}
                            </span>
                            @if(!$advert->category->can_apply())
                            <div class="listing-description">
                                {!! $advert->param('description') !!}
                            </div>
                            @else
                                <div class="link-details">
                                    <a href="/p/{{$advert->category_id}}/{{$advert->id}}">> VIEW FULL POSTING</a>
                                </div>
                            @endif
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
                    <div class="clearfix extra-info">
                        <hr>
                        <div class="ribbons">
                            @if($advert->isSold())
                                <span class="ribbon sold">
                                   Sold
                                </span>
                            @else
                                @if($advert->spotlight_expires())
                                <span class="ribbon ribbon-spotlight">
                                    <strong class="" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Spotlight</strong> 
                                </span>
                                @endif
                                @if($advert->featured_expires())
                                <span class="ribbon ribbon-featured">
                                    <strong class="" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong> 
                                </span>
                                @endif
                                @if($advert->urgent_expires())
                                    <span class="ribbon urgent-span">
                                        <span class="ribbon-text">
                                        Urgent
                                        </span>
                                    </span>
                                @endif
                                @if($advert->canShip())
                                    <span class="ribbon ribbon-shipping">
                                        <strong class="ship-ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Can Ship</strong>
                                    </span>
                                @endif
                                @if($advert->canLocalDelivery())
                                    <span class="ribbon ribbon-delivery">
                                        <strong class="deliver-ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Local Delivery</strong>
                                    </span>
                                @endif
                            @endif
                        </div>
                        <div class="extra-options">
                            @if($advert->category->can_apply())
                            <div class="link-details">
                                <a href="/p/{{$advert->category_id}}/{{$advert->id}}">> LEARN MORE ABOUT THIS ADVERTISER</a>
                            </div>
                            @else
                            <div class="make-offer">
                                <a href="#">
                                <div class="circle">
                                    <div class="text-offer">
                                        <span>Make an offer</span>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="ratings">
                                <div class="stars">
                                    <span>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                        <i class="fullstar"></i>
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
               @endforeach
               </div> 
            </div>
        </div>
    </div>
</div>

@endsection