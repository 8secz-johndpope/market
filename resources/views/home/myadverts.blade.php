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
        <a class="btn btn-primary" href="/user/ads/post">Post an Ad</a>

    @foreach($products as $product)
            <div class="item listing">
                <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}">
                    <div class="listing-img">
                        <div class="main-img">
                            <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">
                            <div class="listing-meta">
                            </div>
                        </div>
                    </div>
                    <div class="items-box-body listing-content">
                        <h4 class="items-box-name font-2">{{$product['title']}}</h4>
                        <div class="listing-location">
                                <span class="truncate-line">
                                    {{$product['location_name']}}
                                </span>
                        </div>
                        <p class="listing-description">
                            {{$product['description']}}
                        </p>
                        <ul class="listing-attributes inline-list">

                        </ul>
                        <div class="items-box-num clearfix">
                            @if($product['meta']['price']>=0)
                                <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
                <a class="glyphicon glyphicon-trash delete-icon" href="/user/advert/delete/{{$product['source_id']}}"></a>
            </div>

        @endforeach
    </div>
</div>


    @endsection