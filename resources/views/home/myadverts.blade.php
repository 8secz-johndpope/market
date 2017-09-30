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
            <div class="item listing">
                <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->sid}}">
                    <div class="listing-img">
                        <div class="main-img">
                            <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">
                            <div class="listing-meta">
                            </div>
                        </div>
                    </div>
                    <div class="items-box-body listing-content">
                        <h4 class="items-box-name font-2">{{$advert->param('title')}}</h4>
                        <div class="listing-location">
                                <span class="truncate-line">
                                    {{$advert->param('location_name')}}
                                </span>
                        </div>
                        <p class="listing-description">
                            {{$advert->param('description')}}
                        </p>
                        <ul class="listing-attributes inline-list">

                        </ul>
                        <div class="items-box-num clearfix">

                            @if($advert->meta('price')>=0)
                                <span class="product-price">£ {{$advert->meta('price')/100}}{{$advert->meta('price_frequency')}}
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
                <a class="glyphicon glyphicon-trash delete-icon" href="/user/advert/delete/{{$advert->sid}}"></a>
            </div>

        @endforeach
    </div>
</div>


    @endsection