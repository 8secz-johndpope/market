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

        <ul class="nav nav-tabs">

            <li class="nav-item active">
                <a class="nav-link " href="#">Manage My ads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/manage/orders">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/user/manage/buying">Buying</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/manage/messages">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/manage/favorites">Favorites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/manage/details">My Details</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-sm-10">

            </div>
            <div class="col-sm-2">
                <a class="btn btn-primary" href="/user/ads/post">Post an Ad</a>

            </div>
        </div>

    @foreach($user->adverts as $advert)
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
        <div class="controls">
            <table class="table"><tr><td><a>Edit</a></td><td><a class="stats-click" data-id="{{$advert->id}}">Stats</a></td><td><a class="red-color" href="/user/advert/delete/{{$advert->id}}">Delete</a></td></tr></table>

        </div>

        @endforeach
    </div>
</div>


    @endsection