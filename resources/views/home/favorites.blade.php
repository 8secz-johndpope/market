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
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
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
<table class="table">

    @foreach($user->favorites as $advert)
        <tr><td>
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
                        <div class="favor">
                                <span class="glyphicon glyphicon-heart favroite-icon" data-id="{{$advert->sid}}"></span>
                        </div>

                        <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->id}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>

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

            </td>
        </tr>
    @endforeach
</table>

@endsection