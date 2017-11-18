<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <ul class="nav nav-tabs top-main-nav">

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/ads"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp; Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; My Details</a>
                </li>
                @if($user->contract!==null)
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp; Financials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp; Metrics</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/favorites"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span> &nbsp;&nbsp; Search Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support"><span class="glyphicon glyphicon-earphone"></span> &nbsp;&nbsp; Support</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row" style="margin-bottom: 30px">
        <div class="col-md-6 col-md-offset-3">
   @if(count($user->buying)>0)
        <h4>Buying</h4>
       @foreach($user->buying as $sale)
                    <div class="product">
                        <div class="listing-side">
                            <div class="listing-thumbnail">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($sale->advert->param('images'))>0?$sale->advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

                                @if($sale->advert->featured_expires())
                                    <span class="ribbon-featured">
<strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
</span>
                                @endif

                                <div class="listing-meta txt-sub">
                                    <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($sale->advert->param('images'))}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info">


                            <a class="listing-product" href="/p/{{$sale->advert->param('category')}}/{{$sale->advert->id}}"> <h4 class="product-title">{{$sale->advert->param('title')}}</h4></a>

                            <span class="listing-location">
                                    {{$sale->advert->param('location_name')}}
                                </span>
                            <p class="listing-description">
                                {!! $sale->advert->param('description') !!}}
                            </p>

                            @if($sale->advert->meta('price')>=0)
                                <span class="product-price">£ {{$sale->advert->meta('price')/100}}{{$sale->advert->meta('price_frequency')}}
                                </span>
                            @endif



                            @if($sale->advert->urgent_expires())
                                <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                            @endif
                            <div class="row">
                          @if($sale->type===2)
                                    <div class="col-sm-3"><span class="green-text">Order Completed</span> </div> <div class="col-sm-3">  <a href="/user/reply/{{$sale->advert->id}}" class="btn btn-default">Contact Seller</a></div>

                            @elseif($sale->type===1)
                                    <div class="col-sm-3">
                                        @if($sale->status===1)
                                        <span class="yellow-text">Waiting for Dispatch</span>
                                        @elseif($sale->status===2)
                                            <span class="green-text">Shipped</span>
                                        @if($sale->tracking)
                                            <p class="bold-text">Tracking No: {{$sale->tracking}} </p>
                                            @endif
                                        @elseif($sale->status==3)
                                            <span class="red-text">Canceled</span>
                                        @endif
                                        <p class="bold-text">Shipping Address</p>
                                        <p>{{$sale->address->line1}}</p>
                                        <p>{{$sale->address->city}}</p>
                                        <p>{{$sale->address->postcode}}</p>

                                    </div> <div class="col-sm-3">  <a href="/user/reply/{{$sale->advert->id}}" class="btn btn-default">Contact Seller</a></div>

                            @else
                                    <div class="col-sm-3">
                                        @if($sale->status===1)
                                        <span class="yellow-text">Waiting for Delivery</span>
                                        @elseif($sale->status===2)
                                            <span class="green-text">Delivered</span>
                                        @elseif($sale->status==3)
                                            <span class="red-text">Canceled</span>
                                        @endif
                                        <p class="bold-text">Delivery Address</p>
                                        <p>{{$sale->address->line1}}</p>
                                        <p>{{$sale->address->city}}</p>
                                        <p>{{$sale->address->postcode}}</p>
                                    </div> <div class="col-sm-3">   <a href="/user/reply/{{$sale->advert->id}}" class="btn btn-default">Contact Seller</a> @if($sale->status===1)<p>to fix a delivery time.</p>  <a class="btn btn-primary" href="/user/order/mark/received/{{$sale->id}}">Mark Received</a>@endif</div>
                            @endif
                            </div>

                        </div>
                    </div>
           @endforeach

    @endif
            <br>
       <br><br>
    @if(count($user->orders)>0)
        <h4>Orders Received</h4>
           @foreach($user->orders as $sale)
               <div class="product">
                   <div class="listing-side">
                       <div class="listing-thumbnail">
                           <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($sale->advert->param('images'))>0?$sale->advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

                           @if($sale->advert->featured_expires())
                               <span class="ribbon-featured">
<strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
</span>
                           @endif

                           <div class="listing-meta txt-sub">
                               <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($sale->advert->param('images'))}}</span>
                           </div>
                       </div>
                   </div>

                   <div class="info">


                       <a class="listing-product" href="/p/{{$sale->advert->param('category')}}/{{$sale->advert->id}}"> <h4 class="product-title">{{$sale->advert->param('title')}}</h4></a>

                       <span class="listing-location">
                                    {{$sale->advert->param('location_name')}}
                                </span>
                       <p class="listing-description">
                           {{$sale->advert->param('description')}}
                       </p>

                       @if($sale->advert->meta('price')>=0)
                           <span class="product-price">£ {{$sale->advert->meta('price')/100}}{{$sale->advert->meta('price_frequency')}}
                                </span>
                       @endif
                       <div class="row">

                       @if($sale->type===2)
                               <div class="col-sm-3"> <span class="green-text">Completed</span>    </div> <div class="col-sm-3">                    <a href="/user/breply/{{$sale->id}}" class="btn btn-default">Contact Buyer</a></div>
                       @elseif($sale->type===1)
                               <div class="col-sm-3">
                                   @if($sale->status===1)
                                   <span class="yellow-text">Need to be Shipped</span>
                                   @elseif($sale->status===2)
                                       <span class="green-text">Shipped</span>
                                   @elseif($sale->status==3)
                                       <span class="red-text">Canceled</span>
                                   @endif
                                   <p class="bold-text">Shipping Address</p>
                                   <p>{{$sale->user->name.' '.$sale->user->last}}</p>
                                   <p>{{$sale->address->line1}}</p>
                                   <p>{{$sale->address->city}}</p>
                                   <p>{{$sale->address->postcode}}</p>
                               </div> <div class="col-sm-3">                                   @if($sale->status===1)<a class="btn btn-primary" href="/user/order/mark/shipped/{{$sale->id}}">Mark Shipped</a>   <br> @endif
                                   <a href="/user/breply/{{$sale->id}}" class="btn btn-default">Contact Buyer</a> <br>

                                   @if($sale->status===1) <a class="btn btn-danger" href="/user/order/cancel/sale/{{$sale->id}}">Cancel Order</a>           </div> @endif
                       @else
                               <div class="col-sm-3">
                                   @if($sale->status===1)
                                   <span class="yellow-text">Need to be Delivered</span>
                                   @elseif($sale->status===2)
                                       <span class="green-text">Delivered</span>
                                   @elseif($sale->status==3)
                                           <span class="red-text">Canceled</span>
                                       @endif
                                   <p class="bold-text">Delivery Address</p>
                                   <p>{{$sale->user->name.' '.$sale->user->last}}</p>
                                   <p>{{$sale->address->line1}}</p>
                                   <p>{{$sale->address->city}}</p>
                                   <p>{{$sale->address->postcode}}</p>
                               </div>  <div class="col-sm-3"> <a href="/user/breply/{{$sale->id}}" class="btn btn-default">Contact Buyer</a> @if($sale->status===1) <p>to fix a delivery time.</p>      <a class="btn btn-danger" href="/user/order/cancel/sale/{{$sale->id}}">Cancel Order</a> @endif </div>
                       @endif
                       </div>

                       <br>

                       @if($sale->advert->urgent_expires())
                           <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                       @endif
                   </div>
               </div>
           @endforeach
    @endif
        </div>
    </div>
@endsection