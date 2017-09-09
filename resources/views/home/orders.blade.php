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
                    <a class="nav-link " href="/user/manage/ads">Manage My ads</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Orders</a>
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
            <div class="well">

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
                                @if($order->tracking==='')
                                <button class="btn-default btn update-shipping" data-id="{{$order->id}}">Enter Shipping Info</button>
                                    @else
                                    <p>{{$order->tracking}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <h4>Shipping Address</h4>
                        <ul class="list-group">
                            <li class="list-group-item">{{$order->buyer->name}}</li>
                            <li class="list-group-item">{{$order->address->line1}}</li>
                            <li class="list-group-item">{{$order->address->city}}</li>
                            <li class="list-group-item">{{$order->address->postcode}}</li>

                        </ul>
                    </div>
                </div>



            @endforeach
        </div>
    </div>
    <div class="modal fade" id="tracking-info">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tracking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="tracking_id" type="text" placeholder="Tracking Info">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update-tracking">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection