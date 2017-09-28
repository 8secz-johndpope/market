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

                <li class="nav-item active">
                    <a class="nav-link " href="#">Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/details">My Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/business/manage/company">Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/finance">Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/metrics">Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/support">Support</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-10">

                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary" href="/user/ads/post">Post an Ad</a>

                </div>
            </div>
            <form action="/business/manage/bump" method="post">
                {{ csrf_field() }}
<table class="table">
    <tr><th></th><th>Views</th><th>Last Posted</th><th>Featured(3 days)</th><th>Featured(7 days)</th><th>Featured(14 days)</th><th>Urgent</th><th>Spotlight</th><td>Bump</td></tr>
            @foreach($user->adverts as $advert)
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
                    <table class="table"><tr><td><a>Edit</a></td><td><a>Stats</a></td><td><a>Delete</a></td></tr></table>
                    </td><td>0</td><td> <span class="posted">{{$advert->posted()}}</span></td>@if($advert->featured_expires()) <td colspan="3"><span class="bold-text">{{$advert->featured_expires()}} days left</span> </td> @else<td><input name="matrix[{{$advert->id}}][featured_3]" type="checkbox" value="1"></td><td><input name="matrix[{{$advert->id}}][featured]" type="checkbox" value="1"></td><td><input name="matrix[{{$advert->id}}][featured_14]" type="checkbox" value="1"></td>@endif<td> @if($advert->urgent_expires())<span class="bold-text">{{$advert->urgent_expires()}} days left</span>  @else <input name="matrix[{{$advert->id}}][urgent]" type="checkbox" value="1"> @endif</td><td>@if($advert->spotlight_expires())<span class="bold-text">{{$advert->spotlight_expires()}} days left</span>  @else<input name="matrix[{{$advert->id}}][spotlight]" type="checkbox" value="1"> @endif</td><td><input name="matrix[{{$advert->id}}][bump]" type="checkbox" value="1"></td></tr>
            @endforeach
</table>
                <button class="btn-primary btn" type="submit">Continue</button>

            </form>
        </div>
    </div>


@endsection