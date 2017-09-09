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

                <li class="nav-item">
                    <a class="nav-link " href="#">Manage My ads</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/favorites">Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Details</a>
                </li>
            </ul>
            @foreach($orders as $order)

                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($order->product['images'])>0?$order->product['images'][0]:"noimage.png"}}" class="lazyload" alt="">

                            </div>
                            <div class="col-sm-8">
                                <a class="listing-product" href="/p/{{$order->product['category']}}/{{$order->product['source_id']}}">
                                    <h4 class="items-box-name font-2">{{$order->product['title']}}</h4>
                                </a>
                                @if($order->product['meta']['price']>=0)
                                    <div class="items-box-price font-5">£ {{$order->product['meta']['price']/100}}{{isset($order->product['meta']['price_frequency']) ? $order->product['meta']['price_frequency']:''}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <ul class="list-group">
                            <li class="list-group-item">{{$order->address->line1}}</li>
                            <li class="list-group-item">{{$order->address->city}}</li>
                            <li class="list-group-item">{{$order->address->postcode}}</li>

                        </ul>
                    </div>
                </div>



            @endforeach
        </div>
    </div>


@endsection