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

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/ads"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
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



            @if($sale->advert->urgent_expires())
                <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
            @endif


        </div>
    </div>
    <h4 class="bold-text">Tracking Info</h4>
    <form method="post" action="/user/order/update/tracking">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">Tracking</label>
            <input type="hidden" name="id" value="{{$sale->id}}">
            <input type="text" name="tracking" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Tracking ID">
            <small id="emailHelp" class="form-text text-muted">Tracking ID is mandatory if shipping type specified in advert has tracking</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection