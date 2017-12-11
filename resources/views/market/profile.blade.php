
@extends('layouts.app')

@section('title', 'Adverts by '. $user->display_name .' | '. env('APP_NAME'))

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
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="products">
               @foreach($user->adverts as $advert)
               <div class="listing-max-pro">
                    <div class="product">
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
                        <div class="info">
                            <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->sid}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>
                            <span class="listing-location">
                                        {{$advert->param('location_name')}}
                                    </span>
                            <div class="listing-description">
                                {!! $advert->param('description')!!}
                            </div>
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

                            @endif
                        </div>
                        <div class="extra-options">
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
                        </div>
                    </div>
                </div>
               @endforeach
               </div> 
            </div>
            <div class="col-sm-4">
                <div class="details-user-container">
                    <div class="row">
                        <div class="col-xs-12">
                          <div class="profile-picutre-big">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}">
                                <h4 class="profile-name-big">{{$user->name}}</h4>
                          </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row" style="display: none">
        <div class="col-sm-8 col-sm-offset-2">
@foreach($user->adverts as $advert)

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


                        <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->sid}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>

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
    @endforeach
        </div>
    </div>
    </div>
</div>

@endsection